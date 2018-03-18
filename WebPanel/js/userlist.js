$(document).ready(function () {
  $('.banbtn').click(function (e) {
    e.preventDefault();
    var id = $(this).data('id');
    $('.id-input').attr('value', id);
  });
});