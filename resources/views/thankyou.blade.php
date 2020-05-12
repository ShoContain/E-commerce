@extends('layout')

@section('title','お支払い確認終了')

@section('extra-css')
@endsection

@section('content')
    <div class="thank-you-section">
        <h2>お支払いありがとうございます、間も無く確認メールをお送りいたします</h2>
        <div>
            <a href="{{ url('/') }}">
                <svg fill="currentColor" xmlns="http://www.w3.org/2000/svg" height="40" width="40" viewBox="0 0 48 48"><path d="M20 40V28h8v12h10V24h6L24 6 4 24h6v16z"></path><path d="M0 0h48v48H0z" fill="none"></path></svg>
                <h3 class="thank-you-to-home">ホーム</h3>
            </a>
        </div>
    </div>
@endsection
