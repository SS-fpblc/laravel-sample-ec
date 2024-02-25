@extends('layouts.kernel')

@section('content')
    <div class="container">
        <h1>管理ダッシュボード</h1>
        
        @include('components.tab', [
            'manage_item' => '',
            'manage_user' => '',
        ])
    </div>
@endsection