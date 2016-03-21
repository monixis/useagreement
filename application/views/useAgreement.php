<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Use Agreement Form</title>
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
				
				$('button#initiate').click(function(){
					alert($("div#request_input2 input#request_collection").val());
					
					$.each($("input:checked"), function(){            
                		alert($(this).val());
            		});
            		
				});
				
				$('div#request_input').clone();			
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
					<div id="researcherInfo"><h1 class="page_head" style="float: none;">Use Agreement Form</h1>
							<h2>Researcher's Information:</h2>
							<div class="formcontents">
								<label class="label">Date:</label><br/><input type="text" id="datepicker" class="textinput" style="width: 100px;"/>		
								<label class="label">Researcher's Name:</label><br/><input type="text" id="name" class="textinput"/>
								<label class="label">Address:</label><br/><input type="text" id="address" class="textinput" />
								<label class="label">City/State:</label><br/><input type="text" id="citystate" class="textinput" />
								<label class="label">Zip:</label><br/><input type="text" id="zip" class="textinput" />
								<!--p><label class="label">City/State:</label><input type="text" id="citystate" class="textinputinline" style="margin-right: 20px;"/><label class="label">Zip:</label><input type="text" id="zip" class="textinputinline" style="width:125px;"/></p-->
								<label class="label">Email:</label><br/><input type="text" id="email" class="textinput" />
								<label class="label">Comments (optional):</label><br/><textarea id="comments" rows="4" cols="50" style="display: block; margin-bottom: 10px;"></textarea>
							</div>
							<h2>Conditions of use</h2>
							<div class="formcontents" style="height: 100px; border:1px solid black; overflow-y: auto; padding: 10px;">
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
							<input type="checkbox" value="Accept" class="checkbox">I accept and agree with the conditions of use.</input><br/>
							<label>Applicant's Initials</label><input type="text" id="name" class="textinput"/>
							
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
		<script>
			
		</script>
	</body>
</html>
