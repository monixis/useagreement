$(document).ready(function(){
  $('div.accordion').click(function(){
    var div =$(this).attr('id');
    if(div == '1'){
      $('div#1-contents').toggle();
    }else if (div == '2'){
      $('div#2-contents').toggle();
    }else if (div == '3'){
      $('div#3-contents').toggle();
    }else if (div == 'requests'){
      $('div#formcontents').toggle();
    }

  });
});
