@extends('layouts.default')

@section('content')
<div class="main">
  <div class="center">
    <div class="center_about_p">
      <div class="center_about">
        <div class="center_about_1">
          このサイトについて
          <div class="center_about_text">
            英単語学習サイト「頻度順英単語」とは、コーパス（実際に話されたり書かれたりした言葉を大量に収集したデータベース。本サイトでは「ANC単語頻度準拠_英和辞典」をもとに作成。）の基準に基づいた使用頻度の高いものから順に、英単語の意味およびスペルを暗記することができるサイトです。大学入試に必要と言われる5000語以上の英単語を、無駄なくスピーディーに暗記することができます。まずはステージ１からお試しください。
          </div>
        </div>
        <div class="center_about_2">
          レベル一覧
          <table>
            <tr>
              <td class="td_left">Stage1</td>
              <td class="td_right">中学在学レベル（新規登録後解放）</td>
            </tr>
            <tr>
              <td class="td_left">Stage2</td>
              <td class="td_right">中学卒業レベル（Stage1クリア後解放）</td>
            </tr>
            <tr>
              <td class="td_left">Stage3</td>
              <td class="td_right">高校在学レベル（Stage2クリア後解放）</td>
            </tr>
            <tr>
              <td class="td_left">Stage4</td>
              <td class="td_right">高校卒業レベル（Stage3クリア後解放）</td>
            </tr>
            <tr>
              <td class="td_left">Stage5</td>
              <td class="td_right">大学入学共通テストレベル（Stage4クリア後解放）</td>
            </tr>
            <tr>
              <td class="td_left">Stage6</td>
              <td class="td_right">難関大学入試レベル（Stage5クリア後解放）</td>
            </tr>
          </table>
        </div>
      </div>

    </div>
    <div class="back_home_or_go">
      <div class="btn">
        <button class="movebtn" onclick="location.href='{{ url('/') }}'"><i class="fas fa-angle-left fa-position-left"></i>ホームに戻る</button>
      </div>
      <div class="">
        <div class="btn">
          <button class="movebtn movebtn_continue">続きから<i class="fas fa-angle-right fa-position-right"></i></button>
        </div>
        <div class="btn">
          <button class="movebtn" onclick="location.href='{{ url('/sentence') }}'">単語カードを作成する<i class="fas fa-angle-right fa-position-right"></i></button>
        </div>
      </div>
    </div>
    <div class="center_p">
      @foreach($folders as $folder)
      <div class="center_n_wrap">
        <div id="center_{{ $folder->id }}" class="center_n center_{{ $folder->id }}">
          <div class="">
            <div class="level level_{{ $folder->id }}"></div>
            <div class="count">{{ $folder->id * 1000 - 999 }}〜{{ $folder->id * 1000 }} words</div>
          </div>
          <div class="progress_bar">
            <div id="progress_bar_{{ $folder->id }}_true" class="progress_bar_true progress_bar_true_or_false"></div>
            <div id="progress_bar_{{ $folder->id }}_false" class="progress_bar_false progress_bar_true_or_false"></div>
            <div id="progress_bar_{{ $folder->id }}_value" class="progress_bar_value"></div>
          </div>
          <a class="btn center_n_btn center_{{ $folder->id }}_btn" href="{{ route('show.folder', [$folder]) }}">
            <div class="start">このステージをみる</div>
          </a>
        </div>
      </div>
      @endforeach
    </div>
  </div>
  <div class="right">
  </div>
</div>
@endsection

@section('script')
<script src='https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js?ver=1.12.4'></script>
<script type="text/javascript">
const ClearData = @json($clear_data);

$(function(){
  var clearRate = [0, 0, 0, 0, 0, 0];
  var clearDataBinary;
  var continue_num = 1;

  for (var i = 0; i < clearRate.length; i++) {
    clearDataBinary = ClearData[i].toString(2);
    for (var j = 1; j <= 50; j++) {
      if (Number(clearDataBinary.substr(j * -1 , 1))) {
        clearRate[i] += 2;
      }
      document.getElementById(`progress_bar_${i + 1}_true`).style.width=`${clearRate[i] * 0.8}%`;
      document.getElementById(`progress_bar_${i + 1}_false`).style.width=`${(100 - clearRate[i]) * 0.8}%`;
      document.getElementById(`progress_bar_${i + 1}_value`).textContent=`${clearRate[i]}%`;
    }
  }

  for (var i = 0; i < 5; i++) {
    if (clearRate[i] < 20) {
      $(`.center_${i + 2}_btn`).on('click', function(){
        return false;
      });
      document.getElementById(`center_${i + 2}`).style.background='rgba(0, 0, 0, 0.5)';
      document.getElementById(`center_${i + 2}`).style.borderColor='rgba(0, 0, 0, 0.2)';
      document.querySelector(`#center_${i + 2} > .progress_bar > .progress_bar_true`).style.borderColor='rgba(0, 0, 0, 0.1)';
      document.querySelector(`#center_${i + 2} > .progress_bar > .progress_bar_false`).style.borderColor='rgba(0, 0, 0, 0.1)';
      document.querySelector(`.center_${i + 2}_btn `).style.background='rgba(0, 0, 0, 0.1)';
      document.querySelector(`.center_${i + 2}_btn `).style.borderColor='rgba(0, 0, 0, 0.1)';
      document.querySelector(`.center_${i + 2}_btn `).style.opacity='1';
    }
  }

  for (var i = 0; i < clearRate.length - 1; i++) {
    if (clearRate[1] === 100) {
      continue_num = i + 2;
    }
  }
  $('.movebtn_continue').on('click', function(){
    window.location.href = `/${continue_num}`;
  })
});
</script>
@endsection
