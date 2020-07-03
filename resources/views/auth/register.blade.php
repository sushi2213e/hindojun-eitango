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
          <a href="./">←ホームに戻る</a>
        </div>
        <div class="user_page_title">
          新規登録
        </div>
        <div class="register_about">すべての機能が無料で利用可能です！<br>利用規約・プライバシーポリシーは<a class="btn" href="{{ url('/terms') }}">こちら</a>をお読みください。</div>
        <form class="" action="{{ route('register') }}" method="post">
          @csrf
          <table class="user_page_table">
            <tr>
              <td class="td_left"><div class="">ユーザー名<br>(ニックネーム)</div></td>
              <td class="td_right"><input type="text" name="name" value="{{ old('name') }}"></td>
            </tr>
            <tr>
              <td class="td_left"><div class="">メールアドレス</div></td>
              <td class="td_right"><input type="email" name="email" value="{{ old('email') }}"></td>
            </tr>
            <tr>
              <td class="td_left"><div class="">パスワード<br>(8文字以上)</div></td>
              <td class="td_right"><input type="password" name="password" value="{{ old('password') }}"></td>
            </tr>
            <tr>
              <td class="td_left"><div class="">パスワード(確認)</div></td>
              <td class="td_right"><input type="password" name="password_confirmation" value="{{ old('password_confirmation') }}"></td>
            </tr>
            <tr>
              <td class="td_left"><div class="">現在の単語レベル</div></td>
              <td class="td_right">
                <select class="" name="current_level">
                  @for($i = 0; $i <= 12; $i++)
                  <option value="{{ $i }}">{{ $i * 500 }}単語</option>
                  @endfor
                  <option value="13">それ以上</option>
                </select>
              </td>
            </tr>
            <tr>
              <td class="td_left"><div class="">目標単語レベル</div></td>
              <td class="td_right">
                <select class="" name="target_level">
                  @for($i = 1; $i <= 12; $i++)
                  <option value="{{ $i }}">{{ $i * 500 }}単語</option>
                  @endfor
                  <option value="13">それ以上</option>
                </select>
              </td>
            </tr>
          </table>
          <div class="">
            @if($errors->any())
              <div class="alert alert-danger">
                @foreach($errors->all() as $message)
                  <div>{{ $message }}</div>
                @endforeach
              </div>
            @endif
          </div>
          <div class="user_page_submit_wrap">
            <button class="user_page_submit btn" type="submit" name="submit">登録</button>
          </div>
        </form>
      </div>
    </main>
  <body>
</html>
