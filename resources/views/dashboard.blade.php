<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">


                <div class="h-100 bg-white">
                    <div class="row h-100 m-0 p-0 flex">

                        <div class="w-72 col-3 h-100 m-0 p-0 border-left border-right border-gray">
                            <div class="left-memo-menu d-flex justify-content-between pt-2">
                                <div class="pl-3 pt-2">
                                    {{ Auth::user()->name }}
                                </div>
                                <div class="pr-1">
                                    <a href="{{ route('dashboard.store') }}" class="btn btn-success">Add memo</i></a>
                                    <a href="{{ route('login') }}" class="btn btn-dark"><i class="fas fa-sign-out-alt"></i></a>
                                </div>
                            </div>
                            <div class="border-b-2 left-memo-title h3 pl-3 pt-3">
                                メモリスト
                            </div>
                            <div class="left-memo-list list-group-flush p-0">
                                @forelse ($memos as $memo)
                                <a
                                   href="{{ route('dashboard.select', ['id' => $memo->id]) }}"
                                   class="border-b-2 block list-group-item list-group-item-action">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h5 class="mb-1">{{ $memo->title }} </h5>
                                        <small>{{ date('Y/m/d H:i', strtotime($memo->updated_at)) }}</small>
                                    </div>
                                    <p class="mb-1">
                                        @if (mb_strlen($memo->content) <= 100)
                                           {{ $memo->content }}
                                            @else
                                            {{ mb_substr($memo->content, 0, 100) . "..." }}
                                            @endif
                                    </p>
                                </a>
                                @empty
                                <div class="pl-3 pt-3 h5 text-info text-center">
                                    <i class="far fa-surprise"></i>メモがありません。
                                </div>
                                @endforelse
                            </div>
                        </div>

                        <div class="w-auto col-9 h-100">
                            @if ($select_memo)
                            <form class="w-100 h-100" method="post">
                                @csrf
                                <input type="hidden" name="edit_id" value="{{ $select_memo->id }}" />
                                <div id="memo-menu">
                                    <button type="submit" class="btn btn-danger" formaction="{{ route('memo.delete') }}"><i class="fas fa-trash-alt"></i>削除する</button>
                                    <button type="submit" class="btn btn-success" formaction="{{ route('dashboard.update')}}"><i class="fas fa-save"></i>更新する</button>
                                </div>
                                <input type="text" id="memo-title" name="edit_title" placeholder="タイトルを入力する..." value="{{ $select_memo->title }}" />
                                <textarea id="memo-content" name="edit_content" placeholder="内容を入力する...">{{ $select_memo->content }}</textarea>
                            </form>
                            @else
                            <div class="mt-3 alert alert-info">
                                <i class="fas fa-info-circle"></i>メモを新規作成するか選択してください。
                            </div>
                            @endif
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
</x-app-layout>