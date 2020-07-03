@extends('layouts.listDefault')

@section('main')
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
      <div class="sentence_english sentence_english_style" style="visibility: hidden;">{{ $sentence->sentence_english }}</div>
      <div class="sentence_japanese" style="visibility: hidden;">{{ $sentence->sentence_japanese }}</div>
      <button class="btn sentence_english_show" type="button">例文を表示</button>
      <button class="btn sentence_english_hide" type="button" style="display: none;">例文を非表示</button>
      <button class="btn sentence_japanese_show" type="button">訳を表示</button>
      <button class="btn sentence_japanese_hide" type="button" style="display: none;">訳を非表示</button>
      <button class="btn sentence_achieve sentence_achieve_{{ $sentence->id }}" type="button">覚えた</button>
      <button class="btn sentence_delete" type="button">削除</button>
      <span id="achieve" class="sentence_balloon sentence_balloon_achieve" style="display: none;">覚えた単語に移しました</span>
      <span id="forget" class="sentence_balloon sentence_balloon_forget" style="display: none;">覚えていない単語に移しました</span>
      <span id="delete" class="sentence_balloon_delete" style="display: none;">
        <div>削除してもよろしいですか？</div>
        <button class="btn delete_true" type="button">はい</button>
        <button class="btn delete_false" type="button">いいえ</button>
      </span>
    </div>
  </div>
  @endforeach
</div>
@endsection
