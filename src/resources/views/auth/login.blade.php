@extends('layout')

@section('content')

<div class="container">
    <h2 class="login-title">ログイン</h2>
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="login-wrap">
            <input id="email" class="login-textbox" type="email" name="email" required autocomplete="email">
            <label class="login-label" for="email">メールアドレス</label>
            @error('email')
                <span class="alert-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="login-wrap">
            <input id="password" class="login-textbox" type="password" name="password"
            value="{{ old('password') }}" required>
            <label class="login-label" for="password">パスワード</label>
            @error('password')
            <span class="alert-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="remember-me-box">
            <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
            <span>ログイン情報を保存</span>
        </div>

        <div class="login-button-section">
            <button type="submit" class="button">
                {{ __('Login') }}
            </button>
        </div>

        <div class="login-options-section">
            @if (Route::has('password.request'))
                <a class="" href="{{ route('password.request') }}">
                    パスワードを忘れましたか？
                </a>
            @endif
            <div>
                <a href="{{ route('guestCheckout.index') }}">登録せずにお支払いに進む</a>
            </div>
        </div>

    </form>
</div>
@endsection

@section('extra-js')
    <script>
        $(document).ready(function () {
            $('.login-textbox').blur(function () {
                if ($(this).val().length === 0) {
                    $('.login-label').removeClass("focus");
                } else {
                    return;
                }
            })
                .focus(function () {
                    $('.login-label').addClass("focus")
                });
        });
    </script>
@endsection
