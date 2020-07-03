<!DOCTYPE html>
<html lang="ja" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('/css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/responsive.css') }}">
    <link rel="shortcut icon" href="{{ asset('/favicon.ico') }}">
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/42fabf92ce.js" crossorigin="anonymous"></script>
  </head>
  <body>
    <header>
      <div class="user_bar">
        <nav class="my-navbar">
          <a href="{{ url('/') }}" class="logo">
            <img src="{{ asset('images/logo.png') }}" alt="頻度順英単語" height="30px;">
          </a>
          <div class="my-navbar-control">
            @if(Auth::check())
              <span class="my-navbar-item">{{ Auth::user()->name }}さん</span>
              ｜
              <a href="#" id="logout" class="my-navbar-item">ログアウト</a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
              </form>
            @else
              <a class="my-navbar-item" href="{{ route('login') }}">ログイン</a>
              ｜
              <a class="my-navbar-item" href="{{ route('register') }}">新規登録</a>
            @endif
          </div>
        </nav>
      </div>
    </header>
    <main>
      <div class="user_page">
        <div class="user_page_back">
          <a href="{{ url('/') }}">←ホームに戻る</a>
        </div>
        <div class="user_page_title">パスワード再発行</div>
        <form action="{{ route('password.email') }}" method="POST">
          @csrf
          <table class="user_page_table">
            <tr>
              <td class="td_left"><div>メールアドレス</div></td>
              <td class="td_right"><input type="text" class="form-control" id="email" name="email" /></td>
            </tr>
          </table>
          @if($errors->any())
            <div class="alert alert-danger">
              @foreach($errors->all() as $message)
                <div>{{ $message }}</div>
              @endforeach
            </div>
          @endif
          @if (session('status'))
            <div class="alert alert-success" role="alert">
              {{ session('status') }}
            </div>
          @endif
          <div class="user_page_submit_wrap">
            <button type="submit" class="user_page_submit btn">再発行リンクを送る</button>
          </div>
        </form>
      </div>
    </main>
  <body>
</html>
