@extends('layouts.default')

@section('content')
<div>
  <div class="">

  </div>
  <form class="" action="{{ url()->current() }}" method="post">
    @csrf
    <button type="submit" name="submit" value="remember">登録</button>
  </form>
</div>
@endsection
