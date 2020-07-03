@extends('layouts.default')

@section('content')
<div>
  <div class="">
    会員登録
  </div>
  <form class="" action="{{ url()->current() }}" method="post">
    @csrf
    <div class="">ユーザー名</div><input type="text" name="regist_name">
    <div class="">メールアドレス</div><input type="email" name="regist_email">
    <div class="">メールアドレス(再入力)</div><input type="email" name="regist_email_reenter">
    <div class="">パスワード</div><input type="password" name="regist_password">
    <div class="">パスワード(再入力)</div><input type="password" name="regist_password_reenter">
    <div class="">現在の単語レベル</div>
    <select class="" name="regist_current_level">
      @for($i = 0; $i <= 12; $i++)
      <option value="{{ $i }}">{{ $i * 500 }}単語</option>
      @endfor
      <option value="13">それ以上</option>
    </select>
    <div class="">目標単語レベル</div>
    <select class="" name="regist_target_level">
      @for($i = 1; $i <= 12; $i++)
      <option value="{{ $i }}">{{ $i * 500 }}単語</option>
      @endfor
      <option value="13">それ以上</option>
    </select>
    <button type="submit" name="submit" value="regist">登録</button>
  </form>
</div>
@endsection
