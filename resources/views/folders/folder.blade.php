@extends('layouts.default')

@section('content')
<div class="bar">
  @foreach($folders as $folder)
  <a class="btn bar_n bar_{{ $folder->id }}" href="{{ route('show.folder', [$folder]) }}">
    <div class="level_{{ $folder->id}}"></div>
    <div class="number">{{ $folder->id * 1000 - 999 }}〜{{ $folder->id * 1000 }}</div>
  </a>
  @endforeach
</div>
<div class="back_home_or_go">
  <div class="btn">
    <button class="movebtn" onclick="location.href='{{ url('/') }}'"><i class="fas fa-angle-left fa-position-left"></i>ホームに戻る</button>
  </div>
  <div>
    <div class="balloon1-right">
      <p>間違えた単語は例文を使って覚えましょう</p>
    </div>
    <div class="btn">
      <button class="movebtn" onclick="location.href='{{ url('/sentence') }}'">単語カードを作成する<i class="fas fa-angle-right fa-position-right"></i></button>
    </div>
  </div>
</div>
<div class="main">
  <div class="center">
    <div class="select">
      @foreach($minifolders as $minifolder)
      <div data-id="{{ $minifolder->id }}" id="select_minifolder_{{ $minifolder->id }}" class="btn select_n select_nth select_{{ $current_folder->id }}">
        <i class="fas fa-medal" id="medal_{{ $minifolder->id - ($current_folder->id - 1) * 50 }}"></i>
        <div class="select_box">No. {{ $minifolder->id * 20 - 19 }}〜{{ $minifolder->id * 20 }}</div>
      </div>
      @endforeach
    </div>
  </div>
  <div class="right">
  </div>
</div>
@endsection

@section('modal_content')
<div id="modal" class="modal" style="display: none;">
  <div class="modal_bg"></div>
  <div class="modal_content">
    <div>
      <a class="btn btn_quiz btn_return btn-quiz-blue" href="{{ route('show.folder', [$current_folder]) }}">
        一覧に戻る
      </a>
      <div class="quiz_top">
        <div class="level level_{{ $current_folder->id }}"></div>
        <div class="words">（{{ $current_folder->id * 1000 - 999 }}〜{{ $current_folder->id * 1000 }} words）</div>
      </div>
    </div>
    <div class="btn_quiz_wrap" id="start">
      <div id="start_no"></div>
      <a class="btn btn_quiz btn-flat-vertical-border">はじめる</a>
    </div>
    <div id="quiz_area" style="display: none;">
      <div class="word_q">
        <div class="word_no_wrap">No. <span class="word_no"></span>　　</div>
        <div><span class="word_japanese"></span>　</div>
        <div class="word_lemma_head_wrap">( <span class="word_lemma_head"></span> )</div>
      </div>
      <div>
        <input id="word_text_box" type="text" spellcheck="false" autocomplete="off">
        <a class="btn btn_quiz word_text_answer word_text_answer_or_next btn-quiz-blue">解答する</a>
        <a class="btn btn_quiz word_text_next word_text_answer_or_next btn-quiz-red">パス</a>
      </div>
    </div>
    <div id="words"></div>
    <ul id="quiz_result" style="display: none;">
      @for ($i = 0; $i < 20; $i++)
      <li class="quiz_result_n">
        <div class="quiz_result_japanese"></div>
        <div class="quiz_result_lemma"></div>
        <div class="quiz_result_r">正解</div>
        <div class="quiz_result_w">不正解</div>
      </li>
      @endfor
    </ul>
    <div id="quiz_bottom" style="display: none;">
      <div id="quiz_score"></div>
      <div class="replay"><a id="replay" class="btn btn-flat-vertical-border">もう一度</a></div>
      <div id="quiz_score_next" class="next"><a id="next" class="btn btn-flat-vertical-border">次へ</a></div>
      <div class="quiz_bottom_register" style="display: none;"><a href="{{ route('register') }}" class="btn btn-flat-vertical-border">次へ</a></div>
    </div>
  </div>
</div>
@endsection

@section('script')
<script type="text/javascript">
const Folder = @json($current_folder);
const Minifolders = @json($minifolders);
const Words = @json($words);
const ClearData = @json($clear_data);
const CurrentFolderClearData =@json($clear_data[$current_folder->id - 1])
</script>
<script src='https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js?ver=1.12.4'></script>
<script src="{{ asset('js/main.js') }}"></script>
@endsection
