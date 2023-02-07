<?php

namespace App\Http\Controllers;

use App\Models\Memo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MemoController extends Controller
{
    public function index()
    {
        return view('dashboard');
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
}
