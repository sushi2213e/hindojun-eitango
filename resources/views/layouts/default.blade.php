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
            <img src="images/logo.png" alt="頻度順英単語" height="30px;">
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
      <div class="top_wrapper">
        <div class="top_wrapper_back">
        </div>
        <div class="top_wrapper_text">
          <div class="top_wrapper_text_sub">頻度順に覚える英単語学習サイト</div>
        </div>
        <div class="top_wrapper_logo">
          <img src="images/logo_l.png" alt="頻度順英単語" height="110px;">
        </div>
        <div class="top_wrapper_share">
          <div class="top_wrapper_share_facebook">

          </div>
          <div class="top_wrapper_share_twitter">
            <a href="https://twitter.com/share?ref_src=twsrc%5Etfw" class="twitter-share-button" data-show-count="false">Tweet</a><script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
          </div>
        </div>
        @if(!Auth::check())
        <div class="top_wrapper_register">
          <div class="top_wrapper_register_text">
            ↓初めての方はこちら
          </div>
          <div class="btn top_wrapper_register_button">
            <a class="btn" href="{{ route('register') }}">新規登録</a>
          </div>
          <div class="top_wrapper_terms">
            <a class="btn" href="{{ url('/terms') }}">ご利用規約</a>
          </div>
        </div>
        @endif
      </div>
      <div class="container">@yield('content')</div>
      <div class="modal_container">@yield('modal_content')</div>
    </main>
    <footer>
      <div class="footer_terms">
        <a class="btn" href="{{ url('/terms') }}">利用規約・プライバシーポリシー</a>
      </div>
    </footer>
    <!-- <script src='https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js?ver=1.12.4'></script> -->
    @if(Auth::check())
      <script>
        document.getElementById('logout').addEventListener('click', function(event) {
          event.preventDefault();
          document.getElementById('logout-form').submit();
        });
      </script>
    @endif
    @yield('script')
    <!-- <script src="{{ asset('js/regist.js') }}"></script>
    <script src="{{ asset('js/remember.js') }}"></script> -->
  </body>
</html>
