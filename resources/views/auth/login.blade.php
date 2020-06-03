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
                    {{ __('Forgot Your Password?') }}
                </a>
            @endif
            <div>
                <a href="{{ route('guestCheckout.index') }}">登録せずにお支払いに進む</a>
            </div>
        </div>

    </form>
</div>


{{--<div class="container">--}}
{{--    <div class="row justify-content-center">--}}
{{--        <div class="col-md-8">--}}
{{--            <div class="card">--}}
{{--                <div class="card-header">ログイン</div>--}}

{{--                <div class="card-body">--}}
{{--                    <form method="POST" action="{{ route('login') }}">--}}
{{--                        @csrf--}}

{{--                        <div class="form-group row">--}}
{{--                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>--}}

{{--                                @error('email')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="form-group row">--}}
{{--                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">--}}

{{--                                @error('password')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="form-group row">--}}
{{--                            <div class="col-md-6 offset-md-4">--}}
{{--                                <div class="form-check">--}}
{{--                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>--}}

{{--                                    <label class="form-check-label" for="remember">--}}
{{--                                        {{ __('Remember Me') }}--}}
{{--                                    </label>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="form-group row mb-0">--}}
{{--                            <div class="col-md-8 offset-md-4">--}}
{{--                                <button type="submit" class="btn btn-primary">--}}
{{--                                    {{ __('Login') }}--}}
{{--                                </button>--}}

{{--                                @if (Route::has('password.request'))--}}
{{--                                    <a class="btn btn-link" href="{{ route('password.request') }}">--}}
{{--                                        {{ __('Forgot Your Password?') }}--}}
{{--                                    </a>--}}
{{--                                @endif--}}
{{--                                <div>--}}
{{--                                 <a href="{{ route('guestCheckout.index') }}">登録せずにお支払いに進む</a>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </form>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
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
