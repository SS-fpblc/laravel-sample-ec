@extends('layouts.kernel')

@section('content')
    <div class="container">
        <h1>管理ダッシュボード</h1>
        
        @include('components.tab', [
            'manage_item' => '',
            'manage_user' => 'active',
        ])
        
        <div id="user_table" class="section">
            <h2>ユーザー一覧</h2>
            <table>
                <thead>
                    <tr>
                        <th class="col-1 text-center" scope="col">ユーザーID</th>
                        <th class="col-1 text-center" scope="col">メールアドレス</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr>
                            <th class="text-center" scope="col">{{ $user->id }}</th>
                            <td class="text-center">{{ $user->email }}</td>
                        </tr>
                    @empty
                        <p>ユーザーはいません。</p>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection