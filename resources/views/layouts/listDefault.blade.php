<!DOCTYPE html>
<html lang="ja" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('/css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/sentence.css') }}">
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
              <a href="{{ url('/') }}" id="logout" class="my-navbar-item">ログアウト</a>
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
    <div class="list_radio_wrap_p">
      <div class="list_radio_wrap">
        <div class="btn back_to_sentence">
          <button class="movebtn" onclick="location.href='{{ url('/sentence') }}'"><i class="fas fa-angle-left fa-position-left"></i>新しい単語カードを作る</button>
        </div>
        <div class="list_radio">
          <ul>
            <li class="list_item">
              <label><input type="radio" class="option-input" name="lang"  value='0'><span id="option_lang_0">英語→日本語</span></label>
            </li>
            <li class="list_item">
              <label><input type="radio" class="option-input" name="lang" value='1'><span id="option_lang_1">日本語→英語</span></label>
            </li>
          </ul>
        </div>
        <div class="list_radio">
          <ul>
            <li class="list_item">
              <label><input type="radio" class="option-input" name="achieved" value='0'><span id="option_achieved_0">覚えていない単語</span></label>
            </li>
            <li class="list_item">
              <label><input type="radio" class="option-input" name="achieved" value='1'><span id="option_achieved_1">覚えた単語</span></label>
            </li>
            <li class="list_item">
              <label><input type="radio" class="option-input" name="achieved" value='2'><span id="option_achieved_2">すべての単語</span></label>
            </li>
          </ul>
        </div>
        <div class="list_radio">
          <ul>
            <li class="list_item">
              <label><input type="radio" class="option-input" name="order" value='0'>新しいものから</label>
            </li>
            <li class="list_item">
              <label><input type="radio" class="option-input" name="order" value='1'>古いものから</label>
            </li>
            <li class="list_item">
              <label><input type="radio" class="option-input" name="order" value='2'>シャッフル</label>
            </li>
          </ul>
        </div>
        <button class="btn list_button" type="button" name="list_button">変更</button>
      </div>
    </div>
    <main>
      <div class="sentences list_wrap">
        <div class="no_list" style="display: none;">ここには単語カードはありません</div>
        @yield('main')
      </div>
    </main>
    <script type="text/javascript">
      const User = @json(Auth::user());
      const Sentences = @json($sentences);
      const Lang = @json($lang);
      const Achieved = @json($achieved);
      const Order = @json($order);
      const CountListData = @json($count_list_data);
    </script>
    <script src='https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js?ver=1.12.4'></script>
    <script src="{{ asset('js/sentence.js') }}"></script>
  <body>
</html>
