/*
Author: Weon Yuan
Original Author: Tristan Denyer (based on Charlie Griefer's original clone code)
Date: August 27, 2013
*/
$(document).ready(function() {
    $('#buttonAdd-request').click(function () {
        var num1     = $('.clonedInput1').length - 1, // how many "duplicable" input fields we currently have
       	newNum1  = new Number(num1 + 1),      // the numeric ID of the new input field being added
        newElem1 = $('#request_input0').clone().attr('id', 'request_input' + newNum1).attr('name', 'Request_Input' + '[' + newNum1 + ']').val(''); // create the new element via clone(), and manipulate it's ID using newNum value
    // manipulate the name/id values of the input inside the new element
    	newElem1.find('label').attr('for', 'collection' + '[' + newNum1 + ']');
        newElem1.find('input').attr('id', 'request_collection' + '[' + newNum1 + ']').attr('name', 'request_collection' + '[' + newNum1 + ']').val('');
        
        newElem1.find('label').attr('for', 'boxno' + '[' + newNum1 + ']');
        newElem1.find('input').attr('id', 'request_boxno' + '[' + newNum1 + ']').attr('name', 'request_boxno' + '[' + newNum1 + ']').val('');
        
        newElem1.find('label').attr('for', 'itemno' + '[' + newNum1 + ']');
        newElem1.find('input').attr('id', 'request_itemno' + '[' + newNum1 + ']').attr('name', 'request_itemno' + '[' + newNum1 + ']').val('');
     
		newElem1.find('label').attr('for', 'dpi' + '[' + newNum1 + ']');
        newElem1.find('input').attr('name', 'request_dpi' + '[' + newNum1 + ']').attr('name', 'request_dpi' + '[' + newNum1 + ']').val('');
        
        newElem1.find('label').attr('for', 'format' + '[' + newNum1 + ']');
        newElem1.find('input').attr('name', 'request_format' + '[' + newNum1 + ']').attr('name', 'request_format' + '[' + newNum1 + ']').val('');
        
        newElem1.find('label').attr('for', 'avformat' + '[' + newNum1 + ']');
        newElem1.find('input').attr('name', 'request_avformat' + '[' + newNum1 + ']').attr('name', 'request_avformat' + '[' + newNum1 + ']').val('');
    // insert the new element after the last "duplicatable" input field
        $(newElem1).after(newElem1).appendTo('#formcontents');
		
		$('#buttonRemove-request').attr('disabled', false).css('opacity', 1);
		
    // right now you can only add 3 sections. change '3' below to the max number of times the form can be duplicated
        if (newNum1 == 1) {
        	$('.empty').remove();
        }
        
        if (newNum1 == 10) {
        	$('#buttonAdd-request').attr('disabled', true).prop('value', "+").css('opacity', 0.5);
        	alert("You have reached the maximum limit for Books.");
        }
        
        if (!$.trim( $('#content').html() ).length) {
        	$('#submit').attr('disabled', true);
    	} else {
			$('#submit').attr('disabled', false);
		}
    });
	
	$('#buttonDelete-book').click(function () {
    // confirmation
        if (confirm("Are you sure you wish to remove a Book?"))
            {
                var num1 = ($('.clonedInput1').length) - 1;
                // how many "duplicatable" input fields we currently have
                $('#content #book_input' + num1).slideUp('fast', function () {$(this).remove(); 
                
                if (!$.trim( $('#content').html() ).length) {
		        	$('#submit').attr('disabled', true);
		    	} else {
					$('#submit').attr('disabled', false);
				}
                
                // if only one element remains, disable the "remove" button
                    if (num1 === 1)
                $('#buttonDelete-book').attr('disabled', true).css('opacity', 0.5);
                // enable the "add" button
                $('#buttonAdd-book').attr('disabled', false).prop('value', "+").css('opacity', 1);
                });
            }
        return false;
             // remove the last element
    // enable the "add" button
        $('#buttonAdd-book').attr('disabled', false).css('opacity', 1);
        
        
    });
	
    $('#buttonDelete-book').attr('disabled', true).css('opacity', 0.5);
});