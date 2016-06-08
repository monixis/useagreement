<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
	<style>
		table, tr {
			border: 1px solid red;
		}

	</style>

	<title>Use Agreement Form</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<link rel="shortcut icon" href="http://library.marist.edu/archives/icon/box.png" />
	<link rel="stylesheet" type="text/css" href="http://library.marist.edu/css/library.css" />
	<link rel="stylesheet" type="text/css" href="http://library.marist.edu/css/library_child.css" />
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
	<script src="//code.jquery.com/jquery-1.10.2.js"></script>
	<script type="text/javascript" src="js/cloneRequests.js"></script>
	<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
	<link rel="stylesheet" type="text/css" href="http://library.marist.edu/archives/mainpage/mainStyles/style.css" />
	<link rel="stylesheet" type="text/css" href="http://library.marist.edu/archives/mainpage/mainStyles/main.css" />
	<link rel="stylesheet" type="text/css" href="styles/useagreement.css" />
	<script type="text/javascript" src="http://library.marist.edu/archives/mainpage/scripts/archivesChildMenu.js"></script>

	<?php
	$userId= $_GET['userId'];
	//researcher info
	$sizeofRequests = sizeof($requests);
	$userName = $researcher[0];
	$citystate = $researcher[1];
	$address =$researcher[2];
	$emailId = $researcher[3];
	$zipCode = $researcher[4];
	$date = $researcher[5];
	$phoneNumber = $researcher[6];
	$status = $researcher[7];
	$attachment = $researcher[8];
	$userInitials = $researcher[9];
	$termsAndCond = $researcher[10];
	$requestAddedBy = $researcher[11];

	if($status == 0){
		$formStatus = "Initiated";
	}elseif($status == 1){
		$formStatus = "Returned";
	}
	elseif($status == 2){
		$formStatus = "Submitted";
	}
	elseif($status == 3){

		$formStatus = "Approved";
	}
	$researcherUrl = base_url("index.php/usragr/getResearcher?userId=").$userId;
	?>

	<script type="text/javascript">
		$(document).ready(function(){
			var inputemail = 1;
			var inputaccept = 0;
			$('#2-contents, #3-contents, #formcontents').hide();
			var text_max = 140;
			$('#textarea_feedback').html(text_max + ' characters remaining');

			$('#message').keyup(function() {
				var text_length = $('#message').val().length;
				var text_remaining = text_max - text_length;

				$('#textarea_feedback').html(text_remaining + ' characters remaining');
			});

			<?php  if($status == 2 || $status ==3 ) {?>
			document.getElementById("save").style.display = "none";
			document.getElementById("submit").style.display = "none";
			//document.getElementById("submit").disabled = true;
			//document.getElementById("save").disabled = true;

			<?php } ?>

			<?php if ($status == 3) {?>
			//document.getElementById("formcontents").style.display = "none";
			document.getElementById("save").style.display = "none";
			document.getElementById("submit").style.display = "none";
			document.getElementById("uploaded_file").style.display = "none";
			document.getElementById("messages").style.display = "none";
            document.getElementById("att").style.display="none";
			document.getElementById("buttonAdd-request").style.display="none";
			document.getElementById("buttonRemove-request").style.display="none";
			document.getElementById("addOrRem").style.display="none";
	        <?php if($sizeofRequests>0){ ?>
			for(var i=0;i <= <?php echo $sizeofRequests?>;i++ ){

				var str1 = "#request_input";
				var str2 = str1.concat(i);
				var str3 = str2.concat(" :input");
                $(str3).attr('readonly',true);
			}
			document.getElementById("requestsReadOnly").style.display="";
            <?php } ?>
			//requestsReadOnly
			//document.getElementById("submitInfo").style.display = "none";

			<?php } ?>

			/* Validation */
			$('input#name').keydown(function(e){
				if((e.which == 9) && ($(this).val().length == 0)){
					$(this).css('border','1px solid red');
				}else{
					$(this).css('border','1px solid #ccc');
				}
			});

			$('input#initials').keydown(function(e){
				if((e.which == 9) && ($(this).val().length == 0)){
					$(this).css('border','1px solid red');
				}else{
					$(this).css('border','1px solid #ccc');
				}
			});

			$('input#email').keydown(function(e){
				var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
				if((e.which == 9) && ($(this).val().length == 0)){
					$(this).css('border','1px solid red');
					inputemail = 0;
				}else if (filter.test($(this).val())){
					$(this).css('border','1px solid #ccc');
					inputemail = 1;
				}
				else{
					$(this).css('border','1px solid red');
					inputemail = 0;
				}
			});

			$('input#accept[type="checkbox"]').click(function(){
				if($(this).prop("checked") == true){
					$('#accept-cond').css({'color':'green', 'font-weight':'bold'});
					inputaccept = 1
				}
				else if($(this).prop("checked") == false){
					$('#accept-cond').css({'color':'#b31b1b', 'font-weight':'bold'});
					inputaccept = 0;
				}
			});
			/* validation ends */
			$('#datepicker').datepicker();
			var requestsCnt = 0;
			var reqSize = "<?php echo sizeof($requests)?>";
			var fields = $('div#request_input').html();
			for (var j = 0; j < reqSize; j++) {
				var request_input = "";
				requestsCnt = requestsCnt + 1;
				request_input = "request_input" + requestsCnt + "";
				var requests = "<div id=" + request_input + " style='border-bottom: 1px solid; padding: 10px;'>" + fields;
				$('div#formcontents').append(requests);

			}
			requestsCnt = 0;
			var tNc = '<?php echo $termsAndCond ?>';
			if(tNc =="true"){
				$('#accept').prop('checked',true)    ;
				$('#accept-cond').css({'color':'green', 'font-weight':'bold'});
				inputaccept = 1

			}
			<?php if($sizeofRequests>0){ ?>
			<?php foreach($requests as $request){ ?>
			var requestId= '<?php echo $request[0]?>';
			requestsCnt++;
			var str1 = "div#request_input";
			var str2 = str1.concat(requestsCnt);
			var requestIds = [];
			requestIds.push(str2.concat(" select#collection"));
			requestIds.push(str2.concat(" input#request_boxno"));
			requestIds.push(str2.concat(" input#request_itemno"));
			requestIds.push(str2.concat(" input:not(:checked)[name='dpi'][value='72']"));
			requestIds.push(str2.concat(" input:not(:checked)[name='dpi'][value='300']"));
			requestIds.push(str2.concat(" input:not(:checked)[name='dpi'][value='600']"));
			requestIds.push(str2.concat(" input:not(:checked)[name='dpi'][value='1200']"));
			requestIds.push(str2.concat(" input:not(:checked)[name='format'][value='pdf']"));
			requestIds.push(str2.concat(" input:not(:checked)[name='format'][value='jpeg']"));
			requestIds.push(str2.concat(" input:not(:checked)[name='format'][value='tiff']"));
			requestIds.push(str2.concat(" input:not(:checked)[name='avformat'][value='wav']"));
			requestIds.push(str2.concat(" input:not(:checked)[name='avformat'][value='mp3']"));
			requestIds.push(str2.concat(" input:not(:checked)[name='avformat'][value='mpeg']"));
			requestIds.push(str2.concat(" input:not(:checked)[name='avformat'][value='hd']"));
			requestIds.push(str2.concat(" textarea#request_desc"));

			$(requestIds[0]).val('<?php echo $request[1]?>');
			$(requestIds[1]).val('<?php echo $request[2]?>');
			$(requestIds[2]).val('<?php echo $request[3]?>');
			$(requestIds[14]).val('<?php echo $request[4]?>');

			<?php foreach($request[5] as $dpi) {?>

			if ("<?php echo $dpi ?>" == "72") {
				$(requestIds[3]).attr('checked', true);
			} else if ("<?php echo $dpi ?>" == "300") {
				$(requestIds[4]).attr('checked', true);
			} else if ("<?php echo $dpi ?>" == "600") {
				$(requestIds[5]).attr('checked', true);
			} else if ("<?php echo $dpi ?>" == "1200") {
				$(requestIds[6]).attr('checked', true);
			}
			<?php }?>
			<?php foreach($request[6] as $format) {?>

			if ("<?php echo $format ?>" == "pdf") {
				$(requestIds[7]).attr('checked', true);
			} else if ("<?php echo $format ?>" == "jpeg") {
				$(requestIds[8]).attr('checked', true);
			} else if ("<?php echo $format ?>" == "tiff") {
				$(requestIds[9]).attr('checked', true);
			}
			<?php }?>
			<?php foreach($request[7] as $avformat) {?>

			if ("<?php echo $avformat ?>" == "wav") {
				$(requestIds[10]).attr('checked', true);
			} else if ("<?php echo $avformat ?>" == "mp3") {
				$(requestIds[11]).attr('checked', true);
			} else if ("<?php echo $avformat ?>" == "mpeg") {
				$(requestIds[12]).attr('checked', true);
			} else if ("<?php echo $avformat ?>" == "hd") {
				$(requestIds[13]).attr('checked', true);
			}
			<?php }?>

			<?php } ?>
			<?php } ?>
			//alert(requestsCnt);
			$('button#save').click(function(){
				var date = $('input#datepicker').val();
				var userName = $('input#name').val();
				var address = $('input#address').val();
				var citystate = $('input#citystate').val();
				var zipCode = $('input#zip').val();
				var emailId = $('input#email').val();
				var phoneNumber = $('input#phoneNo').val();
				var requestCount= $("#formcontents > div").length-1;
				var file = $('input#uploaded_file')[0].files[0];
				var userInitials = $('input#initials').val();
				var termsAndConditions = "false";
				var message = $('textarea#message').val();
				if($('#accept').prop('checked')){
					termsAndConditions = "true";
				}
				var files =[];
				files.push(file);
				var requestList= [];
				//iterating multiple requests.
				for(var i=1; i<=requestCount; i++) {
					var checked = [];
					var imageResolutions = "";
					var fileFormats = "";
					var avFormats = "";
					var str1 = "div#request_input";
					var str2 = str1.concat(i);
					var request = [];
					var reqCollection = $(str2.concat(" select#collection")).val();
					var boxNumber = $(str2.concat(" input#request_boxno")).val();
					var itemNumber = $(str2.concat(" input#request_itemno")).val();
					var descOfUse = $(str2.concat(" textarea#request_desc")).val();

					$.each($(str2.concat(" input:checked[name='dpi']")), function () {
						imageResolutions = imageResolutions.concat($(this).val());
						imageResolutions = imageResolutions.concat(":");
					});
					imageResolutions = imageResolutions.slice(0, -1);
					$.each($(str2.concat(" input:checked[name= 'format']")), function () {
						checked.push($(this).val());
						fileFormats = fileFormats.concat($(this).val());
						fileFormats = fileFormats.concat(":");
					});
					fileFormats = fileFormats.slice(0, -1);

					$.each($(str2.concat(" input:checked[name= 'avformat']")), function () {
						checked.push($(this).val());
						avFormats = avFormats.concat($(this).val());
						avFormats = avFormats.concat(":");
					});
					avFormats = avFormats.slice(0, -1);
					request.push(reqCollection);
					request.push(boxNumber);
					request.push(itemNumber);
					request.push(imageResolutions);
					request.push(fileFormats);
					request.push(avFormats);
					request.push(descOfUse);
					requestList.push(request);
				}
				$.post("<?php echo base_url("?c=usragr&m=saveResearcher&userId=".$userId);?>", {
					date:date,
					userName: userName,
					address : address,
					zipCode : zipCode,
					citystate: citystate,
					emailId: emailId,
					phoneNumber:phoneNumber,
					userInitials:userInitials ,
					termsAndConditions:termsAndConditions,
					requestCount:requestCount,
					requestList:requestList,
					message:message
				}).done(function (userId) {
					if (userId > 0) {
						$('#requestStatus').show().css('background','#66cc00').append("#" + userId + ": Form saved successfully. Please submit for approval");
						//	alert("Form saved successfully for UserId:"  + userId);
					}else
					{
						$('#requestStatus').show().css('background','#b31b1b').append("Something wrong with the form. Contact Administrator");
						// alert("Falied to save use agreement form"+userId);
					}
					$("html, body").animate({ scrollTop: 0}, 600);
				});
			});

			$('button#submit').click(function(){
				//validations
				if ($('input#name').val() == ""){
					$('input#name').css('border','1px solid red');
					$('div#2-contents').show();
					$("html, body").animate({ scrollTop: 0}, 600);
				}else if (inputemail == 0){
					$('input#email').css('border','1px solid red');
					$('div#2-contents').show();
					$("html, body").animate({ scrollTop: 0}, 600);
				}else if ($('input#initials').val() == "" ){
					$('input#initials').css('border','1px solid red');
					$('div#3-contents').show();
				}else if ($(this).prop("checked") == false){
					$('#accept-cond').css({'color':'#b31b1b', 'font-weight':'bold'});
					$('div#3-contents').show();
				}
				else{

					<?php  if($status == 0 || $status == 1) {?>
					var date = $('input#datepicker').val();
					var userName = $('input#name').val();
					var address = $('input#address').val();
					var citystate = $('input#citystate').val();
					var zipCode = $('input#zip').val();
					var emailId = $('input#email').val();
					var phoneNumber = $('input#phoneNo').val();
					var requestCount = $("#formcontents > div").length - 1;
					var file = $('input#uploaded_file')[0].files[0];
					var userInitials = $('input#initials').val();
					var termsAndConditions = "false";
					var message = $('textarea#message').val();
					var instructions = $('textarea#instructions').val();
					if($('#accept').prop('checked')){
						termsAndConditions = "true";
					}

					var files = [];
					files.push(file);
					var requestList = [];
					//iterating multiple requests.
					for (var i = 1; i <= requestCount; i++) {
						var checked = [];
						var imageResolutions = "";
						var fileFormats = "";
						var avFormats = "";
						var str1 = "div#request_input";
						var str2 = str1.concat(i);
						var request = [];
						var reqCollection = $(str2.concat(" select#collection")).val();
						var boxNumber = $(str2.concat(" input#request_boxno")).val();
						var itemNumber = $(str2.concat(" input#request_itemno")).val();
						var descOfUse = $(str2.concat(" textarea#request_desc")).val();

						$.each($(str2.concat(" input:checked[name='dpi']")), function () {
							imageResolutions = imageResolutions.concat($(this).val());
							imageResolutions = imageResolutions.concat(":");
						});
						imageResolutions = imageResolutions.slice(0, -1);
						$.each($(str2.concat(" input:checked[name= 'format']")), function () {
							checked.push($(this).val());
							fileFormats = fileFormats.concat($(this).val());
							fileFormats = fileFormats.concat(":");
						});
						fileFormats = fileFormats.slice(0, -1);

						$.each($(str2.concat(" input:checked[name= 'avformat']")), function () {
							checked.push($(this).val());
							avFormats = avFormats.concat($(this).val());
							avFormats = avFormats.concat(":");
						});

						avFormats = avFormats.slice(0, -1);
						if(reqCollection == 0 || descOfUse == 0){
							$(reqCollection).css('border','1px solid red');

							$(descOfUse).css('border','1px solid red');

						}
						request.push(reqCollection);
						request.push(boxNumber);
						request.push(itemNumber);
						request.push(imageResolutions);
						request.push(fileFormats);
						request.push(avFormats);
						request.push(descOfUse);
						requestList.push(request);

					}
					$.post("<?php echo base_url("?c=usragr&m=submitResearcher&userId=".$userId);?>", {
						date: date,
						userName: userName,
						address: address,
						zipCode: zipCode,
						citystate: citystate,
						emailId: emailId,
						phoneNumber: phoneNumber,
						userInitials:userInitials ,
						termsAndConditions:termsAndConditions ,
						requestCount: requestCount,
						requestList: requestList,
						message:message,
						instructions:instructions
					}).done(function (userId) {
						if (userId > 0) {

							$('#requestStatus').show().css('background','#66cc00').append("#" + userId + ": Form submitted successfully. We'll get back to you shortly");
							$('#stat').show().css("font-weight","Bold").append("Status: Submitted");
							$('#statusInfo').html().replace(/<br\s?\/?>/,'');
							$('#statusInfo').hide();

							//alert("Form Submitted successfully for UserId:" + userId);
						} else {
							$('#requestStatus').show().css('background','#b31b1b').append("Something wrong with the form. Contact Administrator");
						}
						$("html, body").animate({ scrollTop: 0}, 600);
					});

					var m_data = new FormData();
					m_data.append('user_name', $('input#name').val());
					m_data.append('user_email', $('input#email').val());
					m_data.append('phone_number', $('input#phoneNo').val());
					m_data.append('file_attach', $('input#uploaded_file')[0].files[0]);
					m_data.append('date', $('input#datepicker').val());
					$.ajax({
						type: "POST",
						url: "<?php echo base_url("?c=usragr&m=mailAttachment&userId=".$userId);?>",
						data: m_data,
						processData: false,
						contentType: false,
						cache: false,
						success: function (response) {
							//load json data from server and output message
							if (response.type == 'error') { //load json data from server and output message
								output = '<div class="error">' + response.text + '</div>';
							} else {
								output = '<div class="success">' + response.text + '</div>';
							}
							$("#contact_form #contact_results").hide().html(output).slideDown();
						}
					});
					document.getElementById("submit").disabled = true;
					document.getElementById("save").disabled = true;

					<?php }else{ ?>
					alert("you cannot edit the form..! as the form submitted already");
					<?php } ?>
				}
			}); //end of submit function
			$('div#request_input').clone();
		}); // end of document function
	</script>
</head>
<body>
<div id="headerContainer">
	<div id="header">
		<div id="logo">
		</div><!-- /logo -->
	</div>
</div>
<div id="menu">
	<div id="menuItems">
	</div><!-- /menuItems -->
</div><!-- /menu -->
<div class= "content_container">
	<div class = "container_home_child" >
		<div class = "ref_box">
			<table>
				<th class = "search_drop_header" colspan="4">Library Resources</th>
				<tr>
					<td class = "search_drop"><a href="http://voyager.marist.edu/vwebv/searchBasic"><img src ="http://library.marist.edu/images/library_catalog_red.png" title="Library Catalog"></a></td>
					<td class = "search_drop"><a href="http://libguides.marist.edu/"><img src ="http://library.marist.edu/images/library_pathfinders_red.png" title="Pathfinders"></a></td>
					<td class = "search_drop"><a href="http://library.marist.edu/forms/ask.php"> <img src ="http://library.marist.edu/images/ask_a_librarian_red.png" title="Ask A Librarian"></a></td>
					<td class = "search_drop_last"><a href="http://site.ebrary.com.online.library.marist.edu/lib/marist/home.action"><img src ="http://library.marist.edu/images/ebrary_small.png" title ="ebrary"></a></td>
				</tr>
			</table>
		</div>
		<div class="content">
			<p class="breadcrumb">
				<a href="http://library.marist.edu" class="map_link"><img src="http://library.marist.edu/images/home.png" class="fox2"/></a>
				> Forms > Reserve Forms
			</p>

			<div id="researcherInfo"><h1 class="page_head" style="float: none;">Use Agreement Form</h1>

				<div id="requestStatus" style="width: auto; height:40px; margin-bottom: 7px; margin-top: -15px; color:#000000; font-size: 12pt; text-align: center; padding-top: 10px; display: none;">
				</div></br>

				<div id="statusInfo">

					<h3 align="right">Status: <?php echo $formStatus ?></h3></br></br>

				</div>
				<div id="stat" style="width: auto; height:40px; margin-bottom: 7px; margin-top: -15px; font-size: 12pt; text-align: right; padding-top: 10px; display: none;">
				</div>
				<?php if ($status != 3) {?>
					<?php
					if(sizeof($chatList)>0){
						?><h4 align="left" id="1" class="accordion">Conversations</h4>
					<?php  }?>
					<div id="1-contents">

						<!--table style="border: none; margin-top: -10px; margin-bottom: 10px; padding-left: 15px;"-->
						<?php foreach ($chatList as $chat){ ?>
							<!--tr>
							<?php echo "<td ><strong>".$chat['commentType'] . "</strong></p></td>";?>
							<?php echo "<td ><strong>DATE</strong></p></td>";?>
							<?php echo "<td ><strong>TIME</strong></p></td>";?>

						</tr>
						<tr>
							<?php echo "<td aria-autocomplete='inline'>".$chat['comment'] . "</td>";?>
							<?php echo "<td aria-autocomplete='inline'>".$chat['comment_add_date'] . "</td>";?>
							<?php echo "<td>".$chat['comment_add_time'] . "</td>";?>
						</tr-->
							<div class="conversations">
								<strong><?php echo "<td>".$chat['commentType']." - ". $chat['comment_add_date']." ". $chat['comment_add_time'] .": </td>";?></strong><br/>
								<?php echo "<td aria-autocomplete='inline'>".$chat['comment'] . "</td>";?>
							</div>

						<?php } ?>
					</div>
				<?php } ?>
				<h4 id="2" class="accordion">Section 1: Researcher's Information:</h4>
				<div class="formcontents" id="2-contents">
					<?php if ($status ==3) { ?>
					<label class="label">Date:</label><br/><input type="text" id="datepicker" class="textinput" value = "<?php echo $date; ?>" style="width: 100px;" readonly/>
					<label class="label">Researcher's Name:</label><br/><input type="text" id="name" class="textinput" value = "<?php echo $userName; ?>" readonly/>
					<label class="label">Address:</label><br/><input type="text" id="address" class="textinput" value = "<?php echo $address; ?>"  readonly />
					<label class="label">City/State:</label><br/><input type="text" id="citystate" class="textinput" value = "<?php echo $citystate; ?>" readonly />
					<label class="label">Zip:</label><br/><input type="text" id="zip" class="textinput" value = "<?php echo $zipCode; ?>"  readonly/>
					<label class="label">Phone Number:</label><br/><input type="text" id="phoneNo" class="textinput" value = "<?php echo $phoneNumber; ?>" readonly />
					<!--p><label class="label">City/State:</label><input type="text" id="citystate" class="textinputinline" style="margin-right: 20px;"/><label class="label">Zip:</label><input type="text" id="zip" class="textinputinline" style="width:125px;"/></p-->
					<label class="label">Email:</label><br/><input type="text" id="email" class="textinput" value = "<?php echo $emailId; ?>"  readonly/>
					<?php } else {?>

					<label class="label">Date:</label><br/><input type="text" id="datepicker" class="textinput" value = "<?php echo $date; ?>" style="width: 100px;"/>
					<label class="label">Researcher's Name:</label><br/><input type="text" id="name" class="textinput" value = "<?php echo $userName; ?>"/>
					<label class="label">Address:</label><br/><input type="text" id="address" class="textinput" value = "<?php echo $address; ?>" />
					<label class="label">City/State:</label><br/><input type="text" id="citystate" class="textinput" value = "<?php echo $citystate; ?>" />
					<label class="label">Zip:</label><br/><input type="text" id="zip" class="textinput" value = "<?php echo $zipCode; ?>" />
					<label class="label">Phone Number:</label><br/><input type="text" id="phoneNo" class="textinput" value = "<?php echo $phoneNumber; ?>" />
					<!--p><label class="label">City/State:</label><input type="text" id="citystate" class="textinputinline" style="margin-right: 20px;"/><label class="label">Zip:</label><input type="text" id="zip" class="textinputinline" style="width:125px;"/></p-->
					<label class="label">Email:</label><br/><input type="text" id="email" class="textinput" value = "<?php echo $emailId; ?>" />
					<?php }?>

					<!--label class="label">Comments (optional):</label><br/><textarea id="comments" rows="4" cols="50" style="display: block; margin-bottom: 10px;" --><!--?php echo $comments; ?--><!--/textarea-->
				</div>

				<h4 id="3" class="accordion">Section 2: Conditions of use</h2>
					<div id="3-contents" class="formcontents">
						<div style="height: 100px; border-bottom: 1px solid #e0e0e0; border-width: 75%; overflow-y: auto; padding: 10px; margin-bottom: 1px;">
							<ul>
								<li>(1) To use the image(s), audio, or video only for the purpose or project stated above. Later and different use constitutes reuse and is
									prohibited. Subsequent requests for permission to reuse image(s), audio, or video must be made in writing. A reuse fee may apply</li><br/>
								<li>(2) To give proper credit for the image(s), audio, or video. Unless otherwise stated on the photographic copy, the credit line should
									read: James A. Cannavino Library, Archives & Special Collections, Marist College, USA. When the name of the photographer
									or collection is supplied, this should also be included in the credit. The placement of credit should be as follows:</li>
							</ul>
						</div>
						<p><label style="font-weight: bold;">Copyright Notice: </label>The individual requesting reproductions expressly assumes the responsibility for compliance with all pertinent provisions of
							the Copyright Act, 17 U.S.C. ss101 et seq. The patron further agrees to indemnify and hold harmless the Marist College Archives & Special
							Collections and its staff in connection with any disputes arising from the Copyright Act, over the reproduction of material at the request of the
							patron.</p>
						<?php if ($status ==3) { ?>

						<input type="checkbox" id="accept" value="Accept"  name = "accept" class="checkbox" disabled="disabled"><span id="accept-cond" style="color: #b31b1b; font-weight: bold;">I accept and agree with the conditions of use.</span></input>
						<br/><br/>
						<label>Applicant's Initials:</label><input type="text" id="initials" value ="<?php echo $userInitials ?>" class="textinput" readonly/>

						<?php } else {?>
							<input type="checkbox" id="accept" value="Accept"  name = "accept" class="checkbox"><span id="accept-cond" style="color: #b31b1b; font-weight: bold;">I accept and agree with the conditions of use.</span></input>
							<br/><br/>
							<label>Applicant's Initials:</label><input type="text" id="initials" value ="<?php echo $userInitials ?>" class="textinput"/>


						<?php } ?>
					</div>

					<h4 id ="requests" class="accordion">Section 3: Requests:</h2>
						<div class="formcontents" id="formcontents">
							<?php if($attachment !=null){?>
								<div id='attachment'>
									<h3 style="color:#b31b1b">Attached files:</h3></br>
									<label class="label"> <?php echo $attachment;?></label></br><!--label ><!--?php echo $fileAttachment; ?></label-->
								</div>
							<?php } ?>
							</br>
							<h3 id="att">Attachements (if any):</h3></br>
							<h3 id="requestsReadOnly" style="display:none"> Requests:</h3></br>
							<input class='btn' type="file" name="uploaded_file" id="uploaded_file"><br/>
							<h3 id="addOrRem">Add/Remove Requests (Optional):</h3><br/>
							<button id="buttonAdd-request" >+</button>
							<button id="buttonRemove-request" disabled style="opacity: 0.5;">-</button>
							<div id="request_input" style="border-bottom: 1px solid; padding: 10px; display: none;">
								<?php if ($status ==3) { ?>

								<label class="label" for="collection">Collection:</label><br/>
								<select id ="collection" style="width: 500px;"  disabled="disabled" >
									<option value="Lowell Thomas Papers" class="selectinput">Lowell Thomas Papers</option>
									<option value="Lowell Thomas Capital Cities" class="selectinput">Lowell Thomas Capital Cities</option>
									<option value="Emmy Award Winning Video Collection">Emmy Award Winning Video Collection</option>
									<option value="Walt Hawver Collection">Walt Hawver Collection</option>
									<option value="John Tillman Collection">John Tillman Collection</option>
									<option value="George Carroll Papers">George Carroll Papers</option>
									<option value="Fred Crawford Papers">Fred Crawford Papers</option>
									<option value="Cornwall Pumped Storage Project Collection">Cornwall Pumped Storage Project Collection</option>
									<option value="Duggan Family Papers">Duggan Family Papers</option>
									<option value="Henry Dain Papers">Henry Dain Papers</option>
									<option value="The Arthur Glowka Papers">The Arthur Glowka Papers</option>
									<option value="John Grim Collection">John Grim Collection</option>
									<option value="Hudson River Conservation Society, Inc. Collection">Hudson River Conservation Society, Inc. Collection</option>
									<option value="Hudson River Environmental Society Collection">Hudson River Environmental Society Collection</option>
									<option value="Hudson River Environmental Society Library">Hudson River Environmental Society Library</option>
									<option value="Hudson River Sloop Clearwater, Inc. Collection">Hudson River Sloop Clearwater, Inc. Collection</option>
									<option value="Hudson River Valley Commission Collection Records Relating to the Storm King Case 1966-1967">Hudson River Valley Commission Collection: Records Relating to the Storm King Case, 1966 - 1967</option>
									<option value="Hudson River Valley Commission Collection Records Relating to the 1965-1970 Surveys">Hudson River Valley Commission Collection: Records Relating to the 1965 - 1970 Surveys</option>
									<option value="Hudson River Valley Greenway Council Collection">Hudson River Valley Greenway Council Collection</option>
									<option value="Hudson Valley GREEN Collection">Hudson Valley GREEN Collection</option>
									<option value="On the River Collection">On the River Collection</option>
									<option value="Alexander Saunders Papers">Alexander Saunders Papers</option>
									<option value="Scenic Hudson Collection: Records Relating to the Storm King Case, 1963 - 1981">Scenic Hudson Collection: Records Relating to the Storm King Case, 1963 - 1981</option>
									<option value="Scenic Hudson Decision Hearings Transcripts Collection">Scenic Hudson Decision Hearings Transcripts Collection</option>
									<option value="Scenic Hudson, Inc. Administrative History Collection">Scenic Hudson, Inc. Administrative History Collection</option>
									<option value="Whitney N. Seymour Jr. Papers">Whitney N. Seymour Jr. Papers</option>
									<option value="The Fred Starner Collection">The Fred Starner Collection</option>
									<option value="Edvard Bech Collection">Edvard Bech Collection</option>
									<option value="Annia F. Booth Papers">Annia F. Booth Papers</option>
									<option value="Cathedral College Collection: Class of 1924">Cathedral College Collection: Class of 1924</option>
									<option value="Catholic Studies Collection">Catholic Studies Collection</option>
									<option value="Coffin Family Papers">Coffin Family Papers</option>
									<option value="Community Experimental Repertory Theatre (C.E.R.T.) Collection">Community Experimental Repertory Theatre (C.E.R.T.) Collection</option>
									<option value="Cunneen-Hackett Family Papers">Cunneen-Hackett Family Papers</option>
									<option value="Henry and Elizabeth Eugle Collection">Henry and Elizabeth Eugle Collection</option>
									<option value="Hudson River Ships and Commerce Collection">Hudson River Ships and Commerce Collection</option>
									<option value="Hyde Park Stone Wall Restoration Project Collection">Hyde Park Stone Wall Restoration Project Collection</option>
									<option value="Intercollegiate Rowing Association Collection">Intercollegiate Rowing Association Collection</option>
									<option value="McCann Postcard Collections">McCann Postcard Collections</option>
									<option value="Reese Family Papers">Reese Family Papers</option>
									<option value="Scrapbook Collection">Scrapbook Collection</option>
									<option value="Stewart Newburgh Airport Records">Stewart Newburgh Airport Records</option>
									<option value="College Archives - Photograph Collection">College Archives - Photograph Collection</option>
									<option value="Stanley Becchetti Collection">Stanley Becchetti Collection</option>
									<option value="Brother Cornelius Russell Papers">Brother Cornelius Russell Papers</option>
									<option value="Student Newspapers: The Record and The Circle">Student Newspapers: The Record and The Circle</option>
									<option value="Brother Gerard Matthew Weiss Papers">Brother Gerard Matthew Weiss Papers</option>
									<option value="Thomas Steininger Collection">Thomas Steininger Collection</option>
									<option value="Joseph (Joe) McHugh, Jr. Collection">Joseph (Joe) McHugh, Jr. Collection</option>
									<option value="Student Theatre Collection">Student Theatre Collection</option>
									<option value="Nelly Goletti Papers">Nelly Goletti Papers</option>
									<option value="Rick Whitesell Collection">Rick Whitesell Collection</option>
									<option value="James T. Cox Collection">James T. Cox Collection</option>
									<option value="Gill Family Fore-Edge Painting Collections">Gill Family Fore-Edge Painting Collections</option>
									<option value="Geraldine Geller Collection">Geraldine Geller Collection</option>
									<option value="Blaise Pascal Collection">Blaise Pascal Collection</option>
									<option value="Other">Other</option>
								</select></br></br>
								<label class="label" for="boxno">Box Number:</label><br/><input type="text" id="request_boxno" class="textinput" readonly/>
								<label class="label" for="itemno">Item Numbers:</label><br/><input type="text" id="request_itemno" class="textinput" readonly/>
								<label class="label" for="dpi">Requested Resolution (dpi):</label><br/>
								<input type="checkbox" name="dpi" value="72" class="checkbox" disabled="disabled">72</input>
								<input type="checkbox" name="dpi" value="300" class="checkbox" disabled="disabled">300</input>
								<input type="checkbox" name="dpi" value="600" class="checkbox" disabled="disabled">600</input>
								<input type="checkbox" name="dpi" value="1200" class="checkbox" disabled="disabled">1200</input><br/><br/>
								<label class="label" for="format">Requested File Format:</label><br/>
								<input type="checkbox" name="format" value="pdf" class="checkbox" disabled="disabled">PDF</input>
								<input type="checkbox" name="format" value="jpeg" class="checkbox" disabled="disabled" >JPEG</input>
								<input type="checkbox" name="format" value="tiff" class="checkbox" disabled="disabled">TIFF</input><br/><br/>
								<label class="label" for="avformat">Audio/Video File Format:</label><br/>
								<input type="checkbox" name="avformat" value="wav" class="checkbox" disabled="disabled">WAV</input>
								<input type="checkbox" name="avformat" value="mp3" class="checkbox" disabled="disabled">MP3</input>
								<input type="checkbox" name="avformat" value="mpeg" class="checkbox" disabled="disabled">MPEG</input>
								<input type="checkbox" name="avformat" value="hd" class="checkbox" disabled="disabled">HD</input><br/><br/>
								<label class="label" for="desc">Description of Use (Provided by the researcher):</label><br/><textarea id="request_desc" rows="4" cols="4" readonly/></textarea>
						<?php } else { ?>

									<label class="label" for="collection">Collection:</label><br/>
									<select id ="collection" style="width: 500px;" >
										<option value="Lowell Thomas Papers" class="selectinput">Lowell Thomas Papers</option>
										<option value="Lowell Thomas Capital Cities" class="selectinput">Lowell Thomas Capital Cities</option>
										<option value="Emmy Award Winning Video Collection">Emmy Award Winning Video Collection</option>
										<option value="Walt Hawver Collection">Walt Hawver Collection</option>
										<option value="John Tillman Collection">John Tillman Collection</option>
										<option value="George Carroll Papers">George Carroll Papers</option>
										<option value="Fred Crawford Papers">Fred Crawford Papers</option>
										<option value="Cornwall Pumped Storage Project Collection">Cornwall Pumped Storage Project Collection</option>
										<option value="Duggan Family Papers">Duggan Family Papers</option>
										<option value="Henry Dain Papers">Henry Dain Papers</option>
										<option value="The Arthur Glowka Papers">The Arthur Glowka Papers</option>
										<option value="John Grim Collection">John Grim Collection</option>
										<option value="Hudson River Conservation Society, Inc. Collection">Hudson River Conservation Society, Inc. Collection</option>
										<option value="Hudson River Environmental Society Collection">Hudson River Environmental Society Collection</option>
										<option value="Hudson River Environmental Society Library">Hudson River Environmental Society Library</option>
										<option value="Hudson River Sloop Clearwater, Inc. Collection">Hudson River Sloop Clearwater, Inc. Collection</option>
										<option value="Hudson River Valley Commission Collection Records Relating to the Storm King Case 1966-1967">Hudson River Valley Commission Collection: Records Relating to the Storm King Case, 1966 - 1967</option>
										<option value="Hudson River Valley Commission Collection Records Relating to the 1965-1970 Surveys">Hudson River Valley Commission Collection: Records Relating to the 1965 - 1970 Surveys</option>
										<option value="Hudson River Valley Greenway Council Collection">Hudson River Valley Greenway Council Collection</option>
										<option value="Hudson Valley GREEN Collection">Hudson Valley GREEN Collection</option>
										<option value="On the River Collection">On the River Collection</option>
										<option value="Alexander Saunders Papers">Alexander Saunders Papers</option>
										<option value="Scenic Hudson Collection: Records Relating to the Storm King Case, 1963 - 1981">Scenic Hudson Collection: Records Relating to the Storm King Case, 1963 - 1981</option>
										<option value="Scenic Hudson Decision Hearings Transcripts Collection">Scenic Hudson Decision Hearings Transcripts Collection</option>
										<option value="Scenic Hudson, Inc. Administrative History Collection">Scenic Hudson, Inc. Administrative History Collection</option>
										<option value="Whitney N. Seymour Jr. Papers">Whitney N. Seymour Jr. Papers</option>
										<option value="The Fred Starner Collection">The Fred Starner Collection</option>
										<option value="Edvard Bech Collection">Edvard Bech Collection</option>
										<option value="Annia F. Booth Papers">Annia F. Booth Papers</option>
										<option value="Cathedral College Collection: Class of 1924">Cathedral College Collection: Class of 1924</option>
										<option value="Catholic Studies Collection">Catholic Studies Collection</option>
										<option value="Coffin Family Papers">Coffin Family Papers</option>
										<option value="Community Experimental Repertory Theatre (C.E.R.T.) Collection">Community Experimental Repertory Theatre (C.E.R.T.) Collection</option>
										<option value="Cunneen-Hackett Family Papers">Cunneen-Hackett Family Papers</option>
										<option value="Henry and Elizabeth Eugle Collection">Henry and Elizabeth Eugle Collection</option>
										<option value="Hudson River Ships and Commerce Collection">Hudson River Ships and Commerce Collection</option>
										<option value="Hyde Park Stone Wall Restoration Project Collection">Hyde Park Stone Wall Restoration Project Collection</option>
										<option value="Intercollegiate Rowing Association Collection">Intercollegiate Rowing Association Collection</option>
										<option value="McCann Postcard Collections">McCann Postcard Collections</option>
										<option value="Reese Family Papers">Reese Family Papers</option>
										<option value="Scrapbook Collection">Scrapbook Collection</option>
										<option value="Stewart Newburgh Airport Records">Stewart Newburgh Airport Records</option>
										<option value="College Archives - Photograph Collection">College Archives - Photograph Collection</option>
										<option value="Stanley Becchetti Collection">Stanley Becchetti Collection</option>
										<option value="Brother Cornelius Russell Papers">Brother Cornelius Russell Papers</option>
										<option value="Student Newspapers: The Record and The Circle">Student Newspapers: The Record and The Circle</option>
										<option value="Brother Gerard Matthew Weiss Papers">Brother Gerard Matthew Weiss Papers</option>
										<option value="Thomas Steininger Collection">Thomas Steininger Collection</option>
										<option value="Joseph (Joe) McHugh, Jr. Collection">Joseph (Joe) McHugh, Jr. Collection</option>
										<option value="Student Theatre Collection">Student Theatre Collection</option>
										<option value="Nelly Goletti Papers">Nelly Goletti Papers</option>
										<option value="Rick Whitesell Collection">Rick Whitesell Collection</option>
										<option value="James T. Cox Collection">James T. Cox Collection</option>
										<option value="Gill Family Fore-Edge Painting Collections">Gill Family Fore-Edge Painting Collections</option>
										<option value="Geraldine Geller Collection">Geraldine Geller Collection</option>
										<option value="Blaise Pascal Collection">Blaise Pascal Collection</option>
										<option value="Other">Other</option>
									</select></br></br>
									<label class="label" for="boxno">Box Number:</label><br/><input type="text" id="request_boxno" class="textinput" <!--value="--><--?php /*echo $boxNumber */?> "/>
									<label class="label" for="itemno">Item Numbers:</label><br/><input type="text" id="request_itemno" class="textinput" <!--value="--><--?php /*echo $itemNumber */?> "/>
									<label class="label" for="dpi">Requested Resolution (dpi):</label><br/>
									<input type="checkbox" name="dpi" value="72" class="checkbox">72</input>
									<input type="checkbox" name="dpi" value="300" class="checkbox">300</input>
									<input type="checkbox" name="dpi" value="600" class="checkbox">600</input>
									<input type="checkbox" name="dpi" value="1200" class="checkbox">1200</input><br/><br/>
									<label class="label" for="format">Requested File Format:</label><br/>
									<input type="checkbox" name="format" value="pdf" class="checkbox">PDF</input>
									<input type="checkbox" name="format" value="jpeg" class="checkbox">JPEG</input>
									<input type="checkbox" name="format" value="tiff" class="checkbox">TIFF</input><br/><br/>
									<label class="label" for="avformat">Audio/Video File Format:</label><br/>
									<input type="checkbox" name="avformat" value="wav" class="checkbox">WAV</input>
									<input type="checkbox" name="avformat" value="mp3" class="checkbox">MP3</input>
									<input type="checkbox" name="avformat" value="mpeg" class="checkbox">MPEG</input>
									<input type="checkbox" name="avformat" value="hd" class="checkbox">HD</input><br/><br/>
									<label class="label" for="desc">Description of Use (Provided by the researcher):</label><br/><textarea id="request_desc" rows="4" cols="4"/></textarea>


								<?php }?>
								</div><!-- request_input template -->
						</div> <!-- formcontents -->

						<div id="messages"  >
							<label class="label" >Message (If any) : </label><br/>
							<div id="textarea_feedback"></div><textarea maxlength="140"  id="message" rows="5" cols="2000" style="display: inline-block;  margin-bottom: 10px; " ><?php echo null ; ?></textarea>
						</div >


						<button class="btn" type="submit" id="submit">Submit</button>
						<button class="btn" type="button" id="save">Save</button>

			</div> <!-- researcherInfo -->

		</div> <!-- content -->
	</div>

	<div class="bottom_container">
		<p class = "foot">
			James A. Cannavino Library, 3399 North Road, Poughkeepsie, NY 12601; 845.575.3199
			<br />
			&#169; Copyright 2007-2016 Marist College. All Rights Reserved.

			<a href="http://www.marist.edu/disclaimers.html" target="_blank" >Disclaimers</a> | <a href="http://www.marist.edu/privacy.html" target="_blank" >Privacy Policy</a> | <a href="http://library.marist.edu/ack.html?iframe=true&width=50%&height=62%" rel="prettyphoto[iframes]">Acknowledgements</a>
		</p>
	</div>
	<script>
		$('h4').click(function(){
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
	</script>
</body>
</html>