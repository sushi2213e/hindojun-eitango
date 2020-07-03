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
    <main>
      <div class="user_page">
        @if(Auth::check())
        <div class="user_page_back">
          <a href="{{ url('/') }}">←ホームに戻る</a>
        </div>
        @else
        <div class="user_page_back">
          <a href="{{ route('register') }}">←新規登録</a>
        </div>
        @endif
        <div class="terms">
          <div>
            <h3>利用規約・プライバシーポリシー</h3>
            <div>当サイト「頻度順英単語」は管理人matoが個人で運営しているサイトです。この規約は、ご利用者様が当サイトを閲覧・利用いただく際の取り扱いにつき定めるものです。本規約に同意した場合のみ、当サイトをご利用することができます。もし同意いただけない場合は速やかに当サイトの閲覧・利用を中止してください。</div>
            <ul>
              <li>本サイトの利用者は、ご自身の責任につき本サイトを利用するものとし、利用者が本サイトを利用して行ったすべての行為およびその結果について一切の責任とリスクを負うものとします。</li>
              <li>本サイトを利用したことにより、利用者が何らかの被害・損害を被ったとしても、運営者は一切の責任を負わないものとします。本サイトの内容、コンテンツの動作についても一切の保証はなく、運営者はいつでもコンテンツの停止、変更、データの削除を行うことができるものとします。</li>
              <li>サーバ に過度な負荷をかけたり、サイト運営の妨げや他のユーザーの迷惑になるような行為、サイトの趣旨に反するような外部ツールの使用、法律に触れるような行為は禁止します。</li>
              <li>本サイトのコンテンツを許可なく転載、改変、二次使用する行為は禁止します。</li>
              <li>本サイトのコンテンツを利用しての第三者とのトラブル、あるいはそれらに起因または関連する損害が発生した場合はすべて第三者とユーザーとの間で解決するものとし、当サイトは一切関知いたしません。</li>
              <li>htmlファイルにリンクをはることは禁止します。</li>
              <li>データの保存、アクセス解析のためにCookie等を使用してユーザーのコンピュータにデータを保存することがあります。</li>
              <li>当サイトでは第三者配信による広告サービスを利用することがあります。 広告配信事業者はユーザーの興味に応じた内容の広告を表示するために、当サイトや他サイトへのユーザのアクセスに関する情報（氏名・住所・メールアドレス・電話番号は含まれません）を使用することがあります。</li>
              <li>メールアドレスについてはユーザとの連絡以外に使用したり第三者への開示をすることはありません。（※法律に基づいて開示を求められた場合や警察・裁判所等の公的な機関から開示を求められた場合などを除きます)</li>
            </ul>
            <div class="fin">以上</div>
          </div>
        </div>
      </div>
    </main>
    <footer>
      <div class="footer_terms">
        <a class="btn" href="{{ url('/terms') }}">利用規約・プライバシーポリシー</a>
      </div>
    </footer>
  <body>
</html>
