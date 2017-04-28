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

  var howArchives = "";
  var purpose = "";

  /* Parses the value of the check boxes for "How did you learn about our archives and Special Collections holdings?" */
  $('#howDiv input').each(function(){
    var tis = $(this);
    var value = tis.val();
    tis.click(function(){
      if(tis.is(':checked')){
        howArchives +=  (value + " ");
        // alert("Check!" + howArchives);
      }
      else{
        howArchives = howArchives.replace(value + " ", "");
        // alert("Uncheck!" + howArchives);
      }
    });
  });

  /* Parses the value of the check boxes for "What is the purpose of your research?" */
  $('#purposeDiv input').each(function(){
    var tis = $(this);
    var value = tis.val();
    tis.click(function(){
      if(tis.is(':checked')){
        purpose += (value + " ");
        // alert("Check!" + purpose);
      }
      else{
        purpose = purpose.replace(value + " ", "");
        // alert("Uncheck!" + purpose);
      }
    });
  });

  $("form").submit(function(){

    // Check to see that the required checkboxes have at least one option checked
    var purposeChecked = $("input[id=purpose]:checked").length;
    var howArchivesChecked = $("input[id=howArchives]:checked").length;


    if(!howArchivesChecked && !purposeChecked){
      alert("Please select at least one Purpose of Research and one way in which you learned about the archives.");
      return false;
    }
    else if(!howArchivesChecked){
      alert("Please select at least one way in which you learned about the archives.");
      return false;
    }
    else if(!purposeChecked){
      alert("Please select at least one Purpose of Research.");
      return false;
    }
    // Code that will operate only if the page is validated
    else{
         var confirmationNum = generateConfirmationNum(10);
         alert("dad");
    //   var userName = $('input#name').val();
    //   var address = $('input#address').val();
    //   var citystate = $('input#citystate').val();
    //   var zipCode = $('input#zip').val();
    //   var emailId = $('input#email').val();
    //   var phoneNumber = $('input#phoneNo').val();
    //   var affiliation = $('input#affiliation').val();
    //   var status = $('input#status').val();
    //   var subject = $('input#subject').val();
    //   var collection = $('input#collection').val();
    //
    //   // I think I will need to use PHP for this, I would like to live PHP for it all
    //   var howArchives = $('input[name=howArchives]').val();
    //   var purpose = $('input[name=purpose]').val();
    //
    //   $.post("<?php echo base_url("?c=usragr&m=insertNewResearcher");?>", {
    //       date: date,
    //       userName: userName,
    //       address: address,
    //       zipCode: zipCode,
    //       citystate: citystate,
    //       emailId: emailId,
    //       comments: comments,
    //       phoneNumber: phoneNumber,
    //     }).done(function (userId) {
    //       if(userId > 0){
    //       var m_data = new FormData();
    //       m_data.append('user_name', $('input#name').val());
    //       m_data.append('user_email', $('input#email').val());
    //       m_data.append('phone_number', $('input#phoneNo').val());
    //       m_data.append('date', $('input#datepicker').val());
    //       m_data.append('comments', $('textarea#comments').val());
    //       var pcdone = 0;
    //       $.ajax({
    //         type: "POST",
    //         url: "<?php echo base_url("?c=usragr&m=InitiateWithMailAttachment&userId=");?>" + userId,
    //         data: m_data,
    //         processData: false,
    //         contentType: false,
    //         cache: false,
    //
    //         success: function (response) {
    //             //load json data from server and output message
    //             if (response.type == 'error') { //load json data from server and output message
    //                 output = '<div class="error">' + response.text + '</div>';
    //             } else{
    //               $('#requestStatus').show().css('background', '#66cc00').append("#" + userId + ": A User Agreement Form has been sent to " + userName);
    //             }
    //             $("#contact_form #contact_results").hide().html(output).slideDown();
    //           }
    //       });
    //     }
    //     else{
    //         $('#requestStatus').show().css('background', '#b31b1b').append("Something wrong with the form. Contact Administrator");
    //     }
    //       $("html, body").animate({scrollTop: 0}, 600);
    //     });
    }


  });
});

/* This function generates a random alphanumeric of the specified length of the parameter */
function generateConfirmationNum(idLength){
  var characters = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";

  var confirmationNum = "";

  // Holds the highest possible value to select a character from the string
  var max = characters.length - 1;

  for(var i = 0; i < idLength; i ++){
    confirmationNum += characters.charAt((Math.random() * max));
  }

  return confirmationNum;
}
