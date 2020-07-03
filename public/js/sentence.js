$(function(){

$('.create_sentence_button').on('click', function(){
  var lemma = document.getElementById('create_sentence_lemma').value;
  var meaning = document.getElementById('create_sentence_meaning').value;
  var sentence_english = document.getElementById('create_sentence_english').value;
  var sentence_japanese = document.getElementById('create_sentence_japanese').value;
  if(lemma == "" || meaning == "" || sentence_english == "" || sentence_japanese == ""){
    document.getElementById('create_sentence_alert').style.display='block';
  } else {
    var json_create_sentence = {
      "lemma": lemma,
      "meaning": meaning,
      "sentence_english": sentence_english,
      "sentence_japanese": sentence_japanese,
      "create_user_id": User['id'],
      "create_user_name": User['name']
    };
    console.log(JSON.stringify(json_create_sentence));
    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      url: "/sentence/create",
      type: 'post',
      data: JSON.stringify(json_create_sentence),
      contentType: 'application/json',
      dataType:"json",
    })
    .done(function(data) {
      console.log(true);
      document.getElementById('create_sentence_lemma').value = "";
      document.getElementById('create_sentence_meaning').value = "";
      document.getElementById('create_sentence_english').value = "";
      document.getElementById('create_sentence_japanese').value = "";
      $('.sentence_model').clone().insertAfter('.sentence_model').addClass('sentence_wrap_new');
      document.querySelector('.sentence_wrap_new').style.display='block';
      document.querySelector('.sentence_wrap_new .sentence_lemma').textContent=lemma;
      document.querySelector('.sentence_wrap_new .sentence_meaning').textContent=meaning;
      document.querySelector('.sentence_wrap_new .sentence_user').textContent=User['name'];
      document.querySelector('.sentence_wrap_new .sentence_english').textContent=sentence_english;
      document.querySelector('.sentence_wrap_new .sentence_japanese').textContent=sentence_japanese;
      $('.sentence_wrap_new').removeClass('sentence_model').removeClass('sentence_wrap_new');
      sentence_japanese_show_or_hide();
    })
  }
})

function sentence_english_show_or_hide(){
  $('.sentence_english_show').on('click', function(){
    $(this).parent().children('.sentence_english').css('visibility', 'visible');
    $(this).parent().children('.sentence_english_show').css('display', 'none');
    $(this).parent().children('.sentence_english_hide').css('display', 'block');
  });
  $('.sentence_english_hide').on('click', function(){
    $(this).parent().children('.sentence_english').css('visibility', 'hidden');
    $(this).parent().children('.sentence_english_hide').css('display', 'none');
    $(this).parent().children('.sentence_english_show').css('display', 'block');
  });
}
sentence_english_show_or_hide();

function sentence_japanese_show_or_hide(){
  $('.sentence_japanese_show').on('click', function(){
    $(this).parent().parent().children('.sentence_head').children('.sentence_meaning').css('visibility', 'visible');
    $(this).parent().children('.sentence_japanese').css('visibility', 'visible');
    $(this).parent().children('.sentence_japanese_show').css('display', 'none');
    $(this).parent().children('.sentence_japanese_hide').css('display', 'block');
  });
  $('.sentence_japanese_hide').on('click', function(){
    $(this).parent().parent().children('.sentence_head').children('.sentence_meaning').css('visibility', 'hidden');
    $(this).parent().children('.sentence_japanese').css('visibility', 'hidden');
    $(this).parent().children('.sentence_japanese_hide').css('display', 'none');
    $(this).parent().children('.sentence_japanese_show').css('display', 'block');
  });
}
sentence_japanese_show_or_hide();

$('.sentence_japanese_show_e').on('click', function(){
  $(this).parent().children('.sentence_japanese_e').css('visibility', 'visible');
  $(this).parent().children('.sentence_japanese_show_e').css('display', 'none');
  $(this).parent().children('.sentence_japanese_hide_e').css('display', 'block');
});
$('.sentence_japanese_hide_e').on('click', function(){
  $(this).parent().children('.sentence_japanese_e').css('visibility', 'hidden');
  $(this).parent().children('.sentence_japanese_hide_e').css('display', 'none');
  $(this).parent().children('.sentence_japanese_show_e').css('display', 'block');
});

$('.sentence_english_show_e').on('click', function(){
  $(this).parent().parent().children('.sentence_head').children('.sentence_lemma').css('visibility', 'visible');
  $(this).parent().children('.sentence_english_e').css('visibility', 'visible');
  $(this).parent().children('.sentence_english_show_e').css('display', 'none');
  $(this).parent().children('.sentence_english_hide_e').css('display', 'block');
});
$('.sentence_english_hide_e').on('click', function(){
  $(this).parent().parent().children('.sentence_head').children('.sentence_lemma').css('visibility', 'hidden');
  $(this).parent().children('.sentence_english_e').css('visibility', 'hidden');
  $(this).parent().children('.sentence_english_hide_e').css('display', 'none');
  $(this).parent().children('.sentence_english_show_e').css('display', 'block');
});

var sentence_wrap_count = document.getElementById('sentence_wrap_p').childElementCount;
if (sentence_wrap_count === 0) {
  $('.no_list').css('display', 'block');
}
for (var i = 1; i <= sentence_wrap_count; i++) {
  if (document.querySelector(`#sentence_wrap_p div:nth-of-type(${i}) > #sentence_hidden_user_id`).value == User['id']) {
    document.querySelector(`#sentence_wrap_p div:nth-of-type(${i}) .sentence_user`).style.color="#FF4705";
  }
}

$('.sentence_not_saved').on('click', function(){
  var class_sentence_not_saved = $(this);
  $(this).addClass('sentence_saved');
  $(this).text('追加済み');
  var json_save = {
    "sentence_id": Number($(this).parent().parent().children('#sentence_hidden_sentence_id').val()),
    "user_id": User['id'],
  };
  $.ajax({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    url: `/sentence/save`,
    type: 'post',
    data: JSON.stringify(json_save),
    contentType: 'application/json',
    dataType:"json",
  })
  .done(function(data) {
    console.log(data.save);
    if (data.save) {
      class_sentence_not_saved.parent().children('#save_true').css('display', 'block');
      setTimeout(function(){
        class_sentence_not_saved.parent().children('#save_true').css('display', 'none');
      }, 3000);
    } else {
      class_sentence_not_saved.parent().children('#save_false').css('display', 'block');
      setTimeout(function(){
        class_sentence_not_saved.parent().children('#save_false').css('display', 'none');
      }, 3000);
    }
  })
})

$('#option_lang_0').text(`英語→日本語（${CountListData[0]}/${CountListData[0] + CountListData[1]}）`);
$('#option_lang_1').text(`日本語→英語（${CountListData[2]}/${CountListData[2] + CountListData[3]}）`);
if (Lang === 0) {
  for (var i = 0; i < Sentences.length; i++) {
    if (Sentences[i]['pivot']['achieve']) {
      $(`.sentence_achieve_${Sentences[i]['id']}`).addClass('sentence_achieved');
    } else {
      $(`.sentence_achieve_${Sentences[i]['id']}`).addClass('sentence_not_achieved');
    }
  }
  $('#option_achieved_0').text(`覚えていない単語(${CountListData[1]})`);
  $('#option_achieved_1').text(`覚えた単語(${CountListData[0]})`);
  $('#option_achieved_2').text(`すべての単語(${CountListData[0] + CountListData[1]}）`);
} else if (Lang === 1) {
  for (var i = 0; i < Sentences.length; i++) {
    if (Sentences[i]['pivot']['accomplish']) {
      $(`.sentence_accomplish_${Sentences[i]['id']}`).addClass('sentence_accomplished');
    } else {
      $(`.sentence_accomplish_${Sentences[i]['id']}`).addClass('sentence_not_accomplished');
    }
  }
  $('#option_achieved_0').text(`覚えていない単語(${CountListData[3]})`);
  $('#option_achieved_1').text(`覚えた単語(${CountListData[2]})`);
  $('#option_achieved_2').text(`すべての単語(${CountListData[2] + CountListData[3]})`);
}

$('.sentence_not_achieved').on('click', function(){
  var class_sentence_not_achieved = $(this);
  var json_achieve = {
    "sentence_id": Number($(this).parent().parent().children('#sentence_hidden_sentence_id').val()),
    "user_id": User['id'],
  };
  $.ajax({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    url: `/sentence/achieve`,
    type: 'post',
    data: JSON.stringify(json_achieve),
    contentType: 'application/json',
    dataType:"json",
  })
  .done(function(data){
    class_sentence_not_achieved.parent().children('#achieve').css('display', 'block');
    class_sentence_not_achieved.removeClass('sentence_not_achieved').addClass('sentence_achieved');
    setTimeout(function(){
      class_sentence_not_achieved.parent().children('#achieve').css('display', 'none');
    }, 3000);
  })
})

$('.sentence_not_accomplished').on('click', function(){
  var class_sentence_not_accomplished = $(this);
  var json_accomplished = {
    "sentence_id": Number($(this).parent().parent().children('#sentence_hidden_sentence_id').val()),
    "user_id": User['id'],
  };
  $.ajax({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    url: `/sentence/accomplish`,
    type: 'post',
    data: JSON.stringify(json_accomplished),
    contentType: 'application/json',
    dataType:"json",
  })
  .done(function(data){
    class_sentence_not_accomplished.parent().children('#accomplish').css('display', 'block');
    class_sentence_not_accomplished.removeClass('sentence_not_accomplished').addClass('sentence_accomplished');
    setTimeout(function(){
      class_sentence_not_accomplished.parent().children('#accomplish').css('display', 'none');
    }, 3000);
  })
})

$('.sentence_achieved').on('click', function(){
  var class_sentence_not_achieved = $(this);
  var json_forget = {
    "sentence_id": Number($(this).parent().parent().children('#sentence_hidden_sentence_id').val()),
    "user_id": User['id'],
  };
  $.ajax({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    url: `/sentence/forget`,
    type: 'post',
    data: JSON.stringify(json_forget),
    contentType: 'application/json',
    dataType:"json",
  })
  .done(function(data){
    class_sentence_not_achieved.parent().children('#forget').css('display', 'block');
    class_sentence_not_achieved.removeClass('sentence_achieved').addClass('sentence_not_achieved');
    setTimeout(function(){
      class_sentence_not_achieved.parent().children('#forget').css('display', 'none');
    }, 3000);
  })
})

$('.sentence_accomplished').on('click', function(){
  var class_sentence_not_accomplished = $(this);
  var json_unlearn = {
    "sentence_id": Number($(this).parent().parent().children('#sentence_hidden_sentence_id').val()),
    "user_id": User['id'],
  };
  $.ajax({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    url: `/sentence/unlearn`,
    type: 'post',
    data: JSON.stringify(json_unlearn),
    contentType: 'application/json',
    dataType:"json",
  })
  .done(function(data){
    class_sentence_not_accomplished.parent().children('#unlearn').css('display', 'block');
    class_sentence_not_accomplished.removeClass('sentence_accomplished').addClass('sentence_not_accomplished');
    setTimeout(function(){
      class_sentence_not_accomplished.parent().children('#unlearn').css('display', 'none');
    }, 3000);
  })
})

$('.sentence_delete').on('click', function(){
  $(this).parent().children('.sentence_balloon_delete').css('display', 'block');
})
$('.delete_true').on('click', function(){
  var class_delete_true = $(this);
  var json_delete = {
    "sentence_id": Number($(this).parent().parent().parent().children('#sentence_hidden_sentence_id').val()),
    "user_id": User['id'],
  };
  $.ajax({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    url: `/sentence/delete`,
    type: 'post',
    data: JSON.stringify(json_delete),
    contentType: 'application/json',
    dataType:"json",
  })
  .done(function(data){
    class_delete_true.parent().parent().parent().css('display', 'none');
  })
})
$('.delete_false').on('click', function(){
  $(this).parent().css('display', 'none');
})

var elements_lang = document.getElementsByName('lang');
var elements_achieved = document.getElementsByName('achieved');
var elements_order = document.getElementsByName('order');
elements_lang[Lang].checked = true ;
elements_achieved[Achieved].checked = true ;
elements_order[Order].checked = true ;
$('.list_button').on('click', function(){
  var checked_lang = $('input[name=lang]:checked').val();
  var checked_achieved = $('input[name=achieved]:checked').val();
  var checked_order = $('input[name=order]:checked').val();
  window.location.href = `/sentence/list/${checked_lang}/${checked_achieved}/${checked_order}`;
})

});
