$(document).ready(function () {
  $('.pardonbtn').click(function (e) {
    e.preventDefault();
    var id = $(this).data('id');
    $('.id-input').attr('value', id);
  });
  $('.removebtn').click(function (e) {
    e.preventDefault();
    var id = $(this).data('id');
    $('.id-input').attr('value', id);
  });
});