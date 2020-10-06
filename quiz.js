$(function() {
  'use strict';

  $('.answer').on('click', function() {
    var $selected = $(this);
    if ($selected.hasClass('correct') || $selected.hasClass('wrong')) {
      return;
    }
    $selected.addClass('selected');
    var answer = $selected.text();

    $.post('/_answer.php', {
      answer: answer,
      token: $('#token').val()
    }).done(function(res) {
      $('.answer').each(function() {
        if ($(this).text() === res.correct_answer) {
          $(this).addClass('correct');
        } else {
          $(this).addClass('wrong');
        }
      });
      // alert(res.correct_answer);
      if (answer === res.correct_answer) {
        // correct!
        $selected.text(answer + ' ... 正解!');
      } else {
        // wrong!
        $selected.text(answer + ' ... 残念!');
      }
      $('#btn').removeClass('disabled');
    });
  });

  $('#btn').on('click', function() {
    if (!$(this).hasClass('disabled')) {
      location.reload();
    }
  });

});