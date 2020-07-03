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
    <div class="top_wrapper">
      <div class="top_wrapper_back">
      </div>
      <div class="top_wrapper_text">
        <div class="top_wrapper_text_sub">頻度順に覚える英単語学習サイト</div>
      </div>
      <div class="top_wrapper_logo">
        <img src="../images/logo_l.png" alt="頻度順英単語" height="110px;">
      </div>
      <div class="top_wrapper_share">
        <div class="top_wrapper_share_facebook">

        </div>
        <div class="top_wrapper_share_twitter">
          <a href="https://twitter.com/share?ref_src=twsrc%5Etfw" class="twitter-share-button" data-show-count="false">Tweet</a><script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
        </div>
      </div>
    </div>
    <main>
      <div class="back_home_or_go">
        <div class="btn back_home_from_sentence">
          <button class="movebtn" onclick="location.href='{{ url('/') }}'"><i class="fas fa-angle-left fa-position-left"></i>ホームに戻る</button>
        </div>
        <div class="btn go_to_list">
          <button class="movebtn" onclick="location.href='{{ url('/sentence/list/0/0/0') }}'">単語カードリストをみる<i class="fas fa-angle-right fa-position-right"></i></button>
        </div>
      </div>
      <div class="sentence_about about">
        <div class="sentence_about_1">
          <h4>単語カード機能について</h4>
          <div>・単語カードを簡単に自作できる</div>
          <div>・他人が作った単語カードも追加できる</div>
          <div>・日→英、英→日どちらでも暗記可能</div>
          <div>・仕分けやシャッフルもできて暗記に最適！</div>
        </div>
        <div class="sentence_about_2">
          <h4>作成の注意点</h4>
          <div>・見出し語・意味・英文・訳のすべての項目を正確に入力してください</div>
          <div>・不適切な言葉、暴言、無意味な言葉の羅列、目的に反する書き込みは禁止です</div>
        </div>
      </div>
      <div class="create_sentence_wrap">
        <div class="create_sentence_head">単語カードを作成する</div>
        <div class="create_sentence_main">
          <div class="create_sentence_text">
            <div class="create_sentence_lemma create_sentence_content">見出し語：<input id="create_sentence_lemma" class="create_sentence_input" type="text" name="lemma" value="{{ old('lemma') }}" autocomplete="off"></div>
            <div class="create_sentence_meaning create_sentence_content">　　意味：<input id="create_sentence_meaning" class="create_sentence_input" type="text" name="meaning" value="{{ old('meaning') }}" autocomplete="off"></div>
            <div class="create_sentence_english create_sentence_content">　　英文：<input id="create_sentence_english" class="create_sentence_input" type="text" name="sentence_english" value="{{ old('sentence_english') }}" autocomplete="off"></div>
            <div class="create_sentence_japanese create_sentence_content">　　　訳：<input id="create_sentence_japanese" class="create_sentence_input" type="text" name="sentence_japanese" value="{{ old('sentence_japanese') }}" autocomplete="off"></div>
          </div>
          <button class="btn create_sentence_button" name="sentence" type="submit">作成</button>
        </div>
        <div id="create_sentence_alert" class="alert-danger" style="display: none;">すべての項目を入力して下さい。</div>
      </div>
      <div class="sentences">
        <div class="sentences_top">最近作成された単語カード</div>
        <div class="sentence_wrap sentence_model" style="display:none;">
          <div class="sentence_head">
            <div class="sentence_lemma"></div>
            <div class="sentence_meaning" style="visibility: hidden;"></div>
            <div class="sentence_user" style="color: #FF4705;"></div>
          </div>
          <div class="sentence_main">
            <div class="sentence_english"></div>
            <div class="sentence_japanese" style="visibility: hidden;"></div>
            <button class="btn index_sentence_japanese_show sentence_japanese_show" type="button">訳を表示</button>
            <button class="btn index_sentence_japanese_hide sentence_japanese_hide" type="button" style="display: none;">訳を非表示</button>
            <button class="btn index_sentence_save sentence_save sentence_saved" type="button">追加済み</button>
          </div>
        </div>
        <div id="sentence_wrap_p">
          @foreach ($sentences as $sentence)
          <div class="sentence_wrap">
            <input id="sentence_hidden_user_id" type="hidden" value="{{ $sentence->create_user_id }}">
            <input id="sentence_hidden_sentence_id" type="hidden" value="{{ $sentence->id }}">
            <div class="sentence_head">
              <div class="sentence_lemma">{{ $sentence->lemma }}　</div>
              <div class="sentence_meaning" style="visibility: hidden;">{{ $sentence->meaning }}</div>
              <div class="sentence_user">{{ $sentence->create_user_name }}</div>
            </div>
            <div class="sentence_main">
              <div class="sentence_english">{{ $sentence->sentence_english }}</div>
              <div class="sentence_japanese" style="visibility: hidden;">{{ $sentence->sentence_japanese }}</div>
              <button class="btn index_sentence_japanese_show sentence_japanese_show" type="button">訳を表示</button>
              <button class="btn index_sentence_japanese_hide sentence_japanese_hide" type="button" style="display: none;">訳を非表示</button>
              <button class="btn index_sentence_save sentence_save sentence_not_saved" type="button">リストに追加</button>
              <span id="save_true" class="index_sentence_balloon sentence_balloon sentence_balloon_save_true" style="display: none;">リストに追加しました</span>
              <span id="save_false" class="index_sentence_balloon sentence_balloon sentence_balloon_save_false" style="display: none;">すでにリストに存在します</span>
            </div>
          </div>
          @endforeach
        </div>
      </div>
      {{ $sentences->links() }}
    </main>
    <footer>
      <div class="footer_terms">
        <a class="btn" href="{{ url('/terms') }}">利用規約・プライバシーポリシー</a>
      </div>
    </footer>
    <script type="text/javascript">
      const User = @json(Auth::user());
    </script>
    <script src='https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js?ver=1.12.4'></script>
    <script src="{{ asset('js/sentence.js') }}"></script>
  <body>
</html>
