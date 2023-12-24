/**
 *
 * You can write your JS code here, DO NOT touch the default style file
 * because it will make it harder for you to update.
 *
 */

"use strict";

// modal detail pesanan
$("#modal-buy").fireModal({
  title: 'Detail Pesanan',
  body: $('#modal-buy-part'),
  buttons: [
    {
      text: 'Beli Sekarang',
      submit: true,
      class: 'btn btn-red',
    }
  ],
  center: true
});


// $('.topup_btn').click(function (e) {
//     e.preventDefault();
//     alert("opke")
//     // $('.object_games').val($(this).data('games'))
//     // $('.form_object_games').submit();
// });