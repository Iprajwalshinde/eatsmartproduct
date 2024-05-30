$('#tccheck').click(function () {
    //check if checkbox is checked
    if ($(this).is(':checked')) {

      document.getElementById('subtn').removeAttribute('disabled');
      document.getElementById('field01').removeAttribute('disabled');
      document.getElementById('field02').removeAttribute('disabled');
      
    } else {
    
      $('#subtn').attr('disabled', true); //disable input
        $('#field01').attr('disabled', true); //disable input
        $('#field02').attr('disabled', true); //disable input
    }
});