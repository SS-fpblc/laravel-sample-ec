@extends('layouts.immigration')
 
@section('content')
    <div class="container">
        <div class="bind-height row align-items-center">
            <div class="col-auto mx-auto text-center logo">
                <a class="logo_tall" href="{{ route('top') }}">CodeCamp Market</a>
                <p class="fnt_tall fnt_red fnt_bold">Market for Engineers</p>
            </div>
            <section id="immigration" class="col text-center">
                <h1 class="fnt_red">サインアップ</h1>
                
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="input-field text-end">
                        <label class="w-100">
                            ユーザー名:<input class="w-50" type="text" name="name">
                        </label>
                        <div class="error-field">
                            @if ($errors->first('name'))
                                <p class="text-end fnt_min error">※{{ $errors->first('name') }}</p>
                            @endif
                        </div>
                    </div>
                    
                    <div class="input-field text-end">
                        <label class="w-100">
                            メールアドレス:<input class="w-50" type="email" name="email">
                        </label>
                        <div class="error-field">
                            @if ($errors->first('email'))
                                <p class="fnt_min error">※{{ $errors->first('email') }}</p>
                            @endif
                        </div>
                    </div>
                    
                    <div class="input-field text-end">
                        <label class="w-100">
                            パスワード:<input class="w-50" type="password" name="password">
                        </label>
                        <div class="error-field">
                            @if ($errors->first('password'))
                                <p class="fnt_min error">※{{ $errors->first('password') }}</p>
                            @endif
                        </div>
                    </div>
                    
                    <div class="input-field text-end">
                        <label class="w-100">
                            パスワード（確認用）:<input class="w-50" type="password" name="password_confirmation" >
                        </label>
                    </div>
                    
                    <input class="button btn_red fnt_bold fnt_mid" type="submit" value="ユーザーアカウントを登録する">
                </form>
                <p>既にユーザーアカウントをお持ちですか？</p>
                <p class="fnt_bold"><a href="{{ route('login') }}">ログイン</a></p>
            </section>
        </div>
    </div>
@endsection
