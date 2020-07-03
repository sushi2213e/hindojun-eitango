$(function(){

  // var quizContainer = $('#quiz_container');
  var quizArea = $('#quiz_area');
  var clickedId;
  var clickedIdOrder;
  var firstWordId;
  var word;
  var wordId;
  var correctness = [];
  var success;
  var wordIth;
  var score;
  var scoreText;
  var wordTextBox = document.getElementById('word_text_box');
  var clearDataBinary = CurrentFolderClearData.toString(2);
  var clearDataClicked;
  var userData = Number(clearDataBinary.substr(-51 , 1));
  var newClearData;
  var clearRate = [0, 0, 0, 0, 0, 0];
  var clearDataBinaryN;

  for (var i = 0; i < clearRate.length; i++) {
    clearDataBinaryN = ClearData[i].toString(2);
    for (var j = 1; j <= 50; j++) {
      if (Number(clearDataBinaryN.substr(j * -1 , 1))) {
        clearRate[i] += 2;
      }
    }
  }

  for (var i = 0; i < 5; i++) {
    if (clearRate[i] < 20) {
      $(`.bar_${i + 2}`).on('click', function(){
        return false;
      });
      document.querySelector(`.bar_${i + 2}`).style.background='rgba(0, 0, 0, 0.5)';
      document.querySelector(`.bar_${i + 2}`).style.borderColor='rgba(0, 0, 0, 0.2)';
      document.querySelector(`.bar_${i + 2}`).style.opacity='1';
    }
  }

  for (var i = 1; i <= 50; i++) {
    if (Number(clearDataBinary.substr(i * -1 , 1))) {
      document.getElementById(`medal_${i}`).style.color="#ec7";
    }
  }

  if (Folder['id'] !== 1 && clearRate[Folder['id'] - 2] < 20) {
    for (var i = Folder['id'] * 50 - 49; i <= Folder['id'] * 50; i++) {
      $(`#select_minifolder_${i}`).removeClass('select_nth');
      document.getElementById(`select_minifolder_${i}`).style.background='rgba(0, 0, 0, 0.5)';
      document.getElementById(`select_minifolder_${i}`).style.borderColor='rgba(0, 0, 0, 0.2)';
      document.getElementById(`select_minifolder_${i}`).style.opacity='1';
    }
  }

  if (userData === 0 && Folder['id'] === 1) {
    for (var i = 2; i <= 50; i++) {
      $(`#select_minifolder_${i}`).removeClass('select_nth');
      document.getElementById(`select_minifolder_${i}`).style.background='rgba(0, 0, 0, 0.5)';
      document.getElementById(`select_minifolder_${i}`).style.borderColor='rgba(0, 0, 0, 0.2)';
      document.getElementById(`select_minifolder_${i}`).style.opacity='1';
      document.getElementById(`medal_${i}`).style.color="rgba(0, 0, 0, 0)";
    }
  }

  $('.select_nth').on('click', function(){
    clickedId =  $(this).data('id');
    console.log(clickedId);
    firstWordId = Words.find(function(word){
      return word.minifolder_id === clickedId
    })['id'];
    console.log(firstWordId);
    document.getElementById('modal').style.display="block";
    document.getElementById('start_no').textContent=`No. ${firstWordId}〜${firstWordId + 19}`;
    document.querySelector('header').style.display='none';
  });

  $('#start').on('click', function(){
    correctness = [];
    wordId = firstWordId;
    console.log(wordId);
    document.getElementById('start').style.display="none";
    document.getElementById('quiz_area').style.display="block";
    showQuiz();
    $('#start').addClass('')
    if (clickedId % 50 === 0) {
      clickedIdOrder = 50;
    } else {
      clickedIdOrder = clickedId % 50;
    }
    clearDataClicked = Number(clearDataBinary.substr(clickedIdOrder * -1 , 1));
    console.log(clearDataClicked);
  });

  function showQuiz(){
    console.log(wordId);
    word = Words.find(function(word){
      return word.id === wordId
    });
    console.log(word);
    quizArea.find('.word_no').text(word['id']);
    quizArea.find('.word_japanese').text(word['japanese']);
    quizArea.find('.word_lemma_head').text(word['lemma'].slice(0, 1));
    success = Words[word['id']]['lemma'];
    wordTextBox.value = '';
    wordTextBox.focus();
  }

  quizArea.keydown(function() {
    if( event.keyCode == 13 ) {
      $('.word_text_answer').click();
    }
  });

  $('.word_text_answer').on('click', function(){
    if (wordTextBox.value.toLowerCase() === word['lemma'].toLowerCase()) {
      right();
      correctness.push('r');
      nextQuiz();
    } else {
      wrong();
    }
  });

  function right(){
    console.log('r');
  };

  function wrong(){
    console.log('w');
    $('#word_text_box').addClass('shake');
    setTimeout(function(){
      $('#word_text_box').removeClass('shake');
    },300);
  };

  $('.word_text_next').on('click', function(){
    correctness.push('w');
    nextQuiz();
  });

  function nextQuiz(){
    wordId++;
    console.log(wordId);
    if (wordId === firstWordId + 20) {
      showResult();
    } else {
      showQuiz();
    }
  }

  function showResult(){
    console.log(correctness);
    document.getElementById('quiz_area').style.display="none";
    document.getElementById('quiz_result').style.display="flex";
    document.getElementById('quiz_bottom').style.display="flex";
    document.getElementById('words').textContent=`No. ${firstWordId}〜${firstWordId + 19}`;
    if (clickedId % 50 === 0) {
      document.getElementById('quiz_score_next').style.display="none";
    }
    for (var i = 0; i < 20; i++) {
      wordIth = Words.find(function(word){
        return word.id === firstWordId + i
      });
      document.querySelector(`#quiz_result li:nth-child(${i + 1}) > .quiz_result_lemma`).textContent=wordIth['lemma'];
      document.querySelector(`#quiz_result li:nth-child(${i + 1}) > .quiz_result_japanese`).textContent=wordIth['japanese'];
      $(`#quiz_result > li:nth-child(${i + 1}) > .quiz_result_r`).addClass(correctness[i]);
      $(`#quiz_result > li:nth-child(${i + 1}) > .quiz_result_w`).addClass(correctness[i]);
    }
    score = 0;
    for (var i = 0; i < 20; i++) {
      if (correctness[i] === 'r') {
        score++;
      }
    }
    if (score === 20) {
      scoreText = "Excellent!!";
    } else {
      scoreText = `20問中${score}問正解です`
    }
    document.getElementById('quiz_score').textContent=scoreText;
    if (userData === 0) {
      document.querySelector('.quiz_bottom_register').style.display="block";
      document.getElementById('quiz_score_next').style.display="none";
    }
  }

  $('.word_text_answer_or_next').on('click', function(){
    newClearData = CurrentFolderClearData + 2 ** (clickedIdOrder - 1);
    if (wordId === firstWordId + 20 && userData === 1 && clearDataClicked === 0 && score === 20) {
      $.ajax({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          url: "/clear/" + Folder['id'] + "/" + newClearData,
          type: 'post'
      })
      .done(function(data) {

      })
      .fail(function(data) {

      });
    }
  });

  $('#replay').on('click', function(){
    reset();
  });

  $('#next').on('click', function(){
    clickedId++;
    clickedIdOrder++;
    firstWordId += 20;
    reset();
  });

  function reset(){
    word = null;
    wordId = null;
    correctness = [];
    success = null;
    wordIth = null;
    score = null;
    scoreText = null;
    clearDataClicked = null;
    newClearData = null;
    document.getElementById('start').style.display="block";
    document.getElementById('start_no').textContent=`No. ${firstWordId}〜${firstWordId + 20}`;
    document.getElementById('quiz_area').style.display="none";
    document.getElementById('quiz_result').style.display="none";
    document.getElementById('quiz_bottom').style.display="none";
    document.getElementById('words').textContent="";
    $('#quiz_result div').removeClass('r');
    $('#quiz_result div').removeClass('w');
  }

  // console.log(CurrentFolderClearData);
  // console.log(CurrentFolderClearData.toString(2));
  // console.log(ClearData.toString(2).substr(-1, 1));
  // console.log(ClearData.toString(2).substr(-42, 1));
  // console.log(ClearData.toString(2).substr(-46, 1));
  // console.log(ClearData.toString(2).substr(-47, 1));
  // console.log(Number(ClearData.toString(2).substr(-50, 1)));

});
