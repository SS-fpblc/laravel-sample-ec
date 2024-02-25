@extends('layouts.immigration')
 
@section('content')
    <div class="container">
        <div class="bind-height row align-items-center">
            <div class="col-auto mx-auto text-center logo">
                <a class="logo_tall" href="{{ route('top') }}">CodeCamp Market</a>
                <p class="fnt_tall fnt_red fnt_bold">Market for Engineers</p>
            </div>
            <div id="immigration" class="col text-center">
                <h1 class="fnt_red">ログイン</h1>
                
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="input-field text-end">
                        <label class="w-100">
                            メールアドレス:<input class="w-50" type="email" name="email">
                        </label>
                        <div class="w-100 error-field">
                            @if ($errors->first('email'))
                                <p class="text-end fnt_min error">※{{ $errors->first('email') }}</p>
                            @endif
                        </div>
                    </div>
                    
                    <div class="input-field text-end">
                        <label class="w-100">
                            パスワード:<input class="w-50" type="password" name="password">
                        </label>
                        <div class="error-field">
                            @if ($errors->first('password'))
                                <p class="w-100 fnt_min error">※{{ $errors->first('password') }}</p>
                            @endif
                        </div>
                    </div>
                    
                    <input class="button btn_red fnt_bold fnt_mid" type="submit" value="ログインする">
                </form>
                <p>ユーザーアカウントをお持ちではありませんか？</p>
                <p class="fnt_bold"><a href="{{ route('register') }}">サインアップ</a></p>
            </div>
        </div>
    </div>
@endsection
