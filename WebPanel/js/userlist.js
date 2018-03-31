$(document).ready(function () {
  $('.banbtn').click(function (e) {
    e.preventDefault();
    var id = $(this).data('id');
    $('.id-input').attr('value', id);
  });
  $('#search-input').keyup(function (e) { 
    let searchString = $('#search-input').val();
    if(searchString != ''){
      $('tbody tr').hide();
      for(let node of $('tbody tr')){
        node = $(node);
        let username = node.find('.username-field');
        if($(username).html().includes(searchString)){
          node.show();
        }
      }
    }else{
      $('tbody tr').show();
    }
  });
});