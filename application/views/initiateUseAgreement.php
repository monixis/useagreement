<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Reserve Forms</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<link rel="shortcut icon" href="http://library.marist.edu/archives/icon/box.png" />
		<link rel="stylesheet" type="text/css" href="http://library.marist.edu/css/library.css" />
		<link rel="stylesheet" type="text/css" href="http://library.marist.edu/css/library_child.css" />
		<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  		<script src="//code.jquery.com/jquery-1.10.2.js"></script>
	  	<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
		<link rel="stylesheet" type="text/css" href="http://library.marist.edu/archives/mainpage/mainStyles/style.css" />
		<link rel="stylesheet" type="text/css" href="http://library.marist.edu/archives/mainpage/mainStyles/main.css" />
		<link rel="stylesheet" type="text/css" href="styles/useagreement.css" />
		<script type="text/javascript" src="http://library.marist.edu/archives/mainpage/scripts/archivesChildMenu.js"></script> 
		<script type="text/javascript" src="js/cloneRequests.js"></script>
		<script type="text/javascript">
			$(document).ready(function(){
				
				$('#datepicker').datepicker();
				$("#datepicker").datepicker( "setDate", new Date());
				$('div#request_input').clone();	
		
				var inputname = 0;
				var inputemail = 0;
				
			/* Validation */		
				$('input#name').keydown(function(e){
					if((e.which == 9) && ($(this).val().length == 0)){
						$(this).css('border','1px solid red');
						inputname = 0;
					}else{
						$(this).css('border','1px solid #ccc');
						inputname = 1;
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
			/* validation ends */
				
				$('button#initiate').click(function(){
					if (inputname == 0){
						$('input#name').css('border','1px solid red');
					}else if (inputemail == 0){
						$('input#email').css('border','1px solid red');
					}else{
					var date = $('input#datepicker').val();	
					var userName = $('input#name').val();
					var address = $('input#address').val();
					var citystate = $('input#citystate').val();
					var zipCode = $('input#zip').val();
					var emailId = $('input#email').val();
					var comments = $('textarea#comments').val();
					var phoneNumber = $('input#phoneNo').val();
					var requestCount= $("#formcontents > div").length-1 ;
					var requestList= [];
					//alert (requestCount);
					//iterating multiple requests.
					for(var i=1; i<=requestCount; i++) {
						var checked = [];
						var imageResolutions = "";
						var fileFormats = "";
						var avFormats = "";
						var str1 = "div#request_input";
						var str2 = str1.concat(i);
						var request = [];
						var reqCollection = $(str2.concat(" input#request_collection")).val();
						var boxNumber = $(str2.concat(" input#request_boxno")).val();
						var itemNumber = $(str2.concat(" input#request_itemno")).val();
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
						requestList.push(request);
					}
					//alert(requestList);
					$.post("<?php echo base_url("?c=usragr&m=insertNewResearcher");?>", {
						date:date,
						userName: userName,
						address : address,
						zipCode : zipCode,
						citystate: citystate,
						emailId: emailId,
						comments:comments,
						phoneNumber:phoneNumber,
						requestCount:requestCount,
						requestList:requestList
					}).done(function (userId) {
						if (userId > 0) {
							$('#requestStatus').show().css('background','#66cc00').append("#" + userId + ": A User Agreement Form has been sent to "+ userName);
						}else
						{
							$('#requestStatus').show().css('background','#b31b1b').append("Something wrong with the form. Contact Administrator");
					
						}
					});
					}
				});
				
			
			});
		</script>
	
	</head>
	<body>
		<div id="headerContainer">
			<div id="header">
				<div id="logo">

				</div><!-- /logo -->
			</div>
			<!-- /header -->
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
					<div id="researcherInfo"><h1 class="page_head" style="float: none;">User Agreement Initiation Form</h1>
						
					<div id="requestStatus" style="width: auto; height:30px; margin-bottom: 7px; margin-top: -15px; color:#000000; font-size: 12pt; text-align: center; padding-top: 10px; display: none;">
						
					</div>	
							<h2>Researcher's Information:</h2>
							<div class="formcontents">
								<label class="label">Date:</label><br/><input type="text" id="datepicker" class="textinput" style="width: 100px;"/>		
								<label class="label">Researcher's Name:</label><br/><input type="text" id="name" class="textinput"/>
								<label class="label">Address:</label><br/><input type="text" id="address" class="textinput" />
								<label class="label">City/State:</label><br/><input type="text" id="citystate" class="textinput" />
								<label class="label">Zip:</label><br/><input type="text" id="zip" class="textinput" />
								<label class="label">Phone Number:</label></br><input type="text" id="phoneNo" class="textinput" />
								<!--p><label class="label">City/State:</label><input type="text" id="citystate" class="textinputinline" style="margin-right: 20px;"/><label class="label">Zip:</label><input type="text" id="zip" class="textinputinline" style="width:125px;"/></p-->
								<label class="label">Email:</label><br/><input type="text" id="email" class="textinput" />
								<label class="label">Comments (optional):</label><br/><textarea id="comments" rows="4" cols="50" style="display: block; margin-bottom: 10px;"></textarea>
							</div>
							<h2>Requests:</h2>
							<div class="formcontents" id="formcontents">
								<label>Add/Remove Requests</label><br/>
								<button id="buttonAdd-request">+</button>
								<button id="buttonRemove-request" disabled style="opacity: 0.5;">-</button></br>
								<div id="request_input" style="border-bottom: 1px solid; padding: 10px; display: none;">
										<label class="label" for="collection">Collection:</label><br/><input type="text" id="request_collection" class="textinput"/>
										<label class="label" for="boxno">Box Number:</label><br/><input type="text" id="request_boxno" class="textinput"/>
										<label class="label" for="itemno">Item Numbers:</label><br/><input type="text" id="request_itemno" class="textinput"/>
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

								</div><!-- request_input template -->

							</div> <!-- formcontents -->
					  <button class="btn" type="button" id="initiate">Initiate agreement</button>
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
	</body>
</html>
