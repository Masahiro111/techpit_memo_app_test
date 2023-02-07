<?php

namespace App\Http\Controllers;

use App\Models\Memo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MemoController extends Controller
{
    public function index()
    {
        $memos = Memo::query()
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        $select_memo = session()->get('select_memo');

        return view('dashboard', compact('memos', 'select_memo'));
    }

    public function store()
    {
        Memo::query()
            ->create([
                'user_id' => Auth::id(),
                'title' => '新規メモ',
                'content' => 'content',
            ]);

        return to_route('dashboard');
    }

    public function select(Request $request)
    {
        $memo = Memo::query()
            ->findOrFail($request->id);
        session()->put('select_memo', $memo);

        return to_route('dashboard');
    }

    public function update(Request $request)
    {
        $memo = Memo::find($request->edit_id);
        $memo->title = $request->edit_title;
        $memo->content = $request->edit_content;

        if ($memo->update()) {
            session()->put('select_memo', $memo);
        } else {
            session()->remove('select_memo');
        }

        return to_route('dashboard');
    }
}
