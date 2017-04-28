<!DOCTYPE html>
<html lang = 'en'>
  <head>
    <!-- Not sure what final title will be -->
    <title>Physical User Agreement</title>
    <!-- Import dependencies, CSS, JS -->
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="shortcut icon" href="http://library.marist.edu/archives/icon/box.png" />
    <link rel="stylesheet" type="text/css" href="http://library.marist.edu/css/library.css" />
    <link rel="stylesheet" type="text/css" href="http://library.marist.edu/css/library_child.css" />
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="http://code.jquery.com/jquery-1.10.2.js"></script>
    <script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <link rel="stylesheet" type="text/css" href="http://library.marist.edu/archives/mainpage/mainStyles/style.css" />
    <link rel="stylesheet" type="text/css" href="http://library.marist.edu/archives/mainpage/mainStyles/main.css" />
    <link rel="stylesheet" type="text/css" href="../../styles/researchAgreementForm.css" />
    <script type="text/javascript" src="http://library.marist.edu/archives/mainpage/scripts/archivesChildMenu.js"></script>
    <script type="text/javascript" src="../../js/cloneRequests.js"></script>
    <link rel="stylesheet" type="text/css" href="../../styles/useagreement.css"/>
    <!-- Creating JS file to use specifically for this page -->
    <script type = "text/javascript" src = "../../js/physicalUserAgreement.js"></script>

    <!-- Not sure what JS I need to add here from the other page. But most likely at least some of the js from initiateUseAgreement.php -->

  </head>
  <body>
    <div id = "headerContainer">
      <div id = "header">
        <div id = "logo"></div>
      </div> <!-- header -->
    </div> <!-- headerContainer -->
    <div id = "menu">
      <div id = "menuItems"></div>
    </div> <!-- menu -->

    <div class = "content_container">
      <div class = "container_home_child">
        <div class = "ref_box">
          <table>
            <th class = "search_drop_header" colspan="4">Library Resources</th>
            <tr>
              <td class = "search_drop">
                <a href="http://voyager.marist.edu/vwebv/searchBasic"><img src ="http://library.marist.edu/images/library_catalog_red.png" title="Library Catalog"></a>
              </td>
              <td class = "search_drop">
                <a href="http://libguides.marist.edu/"><img src ="http://library.marist.edu/images/library_pathfinders_red.png" title="Pathfinders"></a>
              </td>
              <td class = "search_drop">
                <a href="http://library.marist.edu/forms/ask.php"> <img src ="http://library.marist.edu/images/ask_a_librarian_red.png" title="Ask A Librarian"></a>
              </td>
              <td class = "search_drop_last">
                <a href="http://site.ebrary.com.online.library.marist.edu/lib/marist/home.action"><img src ="http://library.marist.edu/images/ebrary_small.png" title ="ebrary"></a>
              </td>
            </tr>
          </table>
        </div> <!--ref_box  -->

        <div class = "content">
          <p class = "breadcrumb">
            <a href="http://library.marist.edu" class="map_link"><img src="http://library.marist.edu/images/home.png" class="fox2"/></a>
            > Forms > Research Agreement Forms
          </p>

          <!-- Dan Mopsick - This is where the research form becomes different than the initiateUseAgreementForm -->

          <div id = "researcherInfo">
            <h1 class = "page_head" style = "float:none;">Physical User Agreement Form</h1>

            <!-- Is there a message that should be displayed here similiar to the pdf version of the form? -->


            <!-- All of the inputs are in a form element for validaiton purposes (ex: required) -->
            <form style = "float:none; margin-left:0;" action="javascript:void(0);">
              <div class = "formcontents">
              <!-- Should the date be time stamped by the datbase? If the person is in the library... the time they are using the archive material is now -->
                <label class = "label">Confirmation Number:</label><br/><input type = "text" id = "confirmation" class = "sizable_input" size = "10" minLength = "10" maxLength = "10" required autofocus/>
              </div> <!-- formcontents -->

              <div class="accordion" id="3"><h4 id="3">Section 2: Conditions of use</h4><span class="click">Click to Open/Close</span></div>
      					<div id="3-contents" class="formcontents">
      						<div style="height: 200px; border-bottom: 1px solid #e0e0e0; border-width: 75%; overflow-y: auto; padding: 10px; margin-bottom: 1px;">
      							<ul>
      								<li>(1) To use the image(s), audio, or video only for the purpose or project stated above. Later and different use constitutes reuse and is
      									prohibited. Subsequent requests for permission to reuse image(s), audio, or video must be made in writing. A reuse fee may apply</li><br/>
      								<li>(2) To give proper credit for the image(s), audio, or video. Unless otherwise stated on the photographic copy, the credit line should
      								read: James A. Cannavino Library, Archives &amp; Special Collections, Marist College, USA. When the name of the photographer
      								or collection is supplied, this should also be included in the credit. The placement of credit should be as follows:<br/><br/>
    									  <ul>a) Printed material - Preferably the credit line should appear on the same page as the printed copy of the image and
      									           immediately adjacent to it. The credit may appear elsewhere in the publication if done in such a way that readers
                          can quickly match individual images with their respective credit.
                        </ul><br/>
                        <ul>b) Films, filmstrips, video, or electronic media (including Internet productions) - The credit line should appear
                          on the film, filmstrip, video, or electronic media where other sources are listed. If manuals accompany films or
                          filmstrips, the credit should appear where the subject of the illustration is discussed in the text.
                        </ul><br/>
                        <ul>
                          c) Public exhibitions - The credit should appear within the exhibit area.
                        </ul><br/>
                        <ul>
                          d) Audio broadcasts – The credit should be read at the end of the broadcast or given when other sources are listed.
                        </ul><br/>
      			          </li>
      								<li>(3) Not to digitize images at a resolution higher than 72 dots per inch for use on the Internet, or distribute image(s), audio, or
                        video without written authorization from the Marist College Archives &amp; Special Collections.
                      </li><br/>
                      <li>(4) To assume all responsibility for questions of copyright and invasion of privacy that may arise in the copying and in the use of
                        the image(s), audio, or video and to assume responsibility for obtaining all necessary permissions pertaining to use.
                      </li><br/>
                      <li>(5) To defend and indemnify and save and hold harmless Marist College, its Archives &amp; Special Collections, its employees or
                        designates, and the donors and former owners of Marist College Archives or Special Collections, from any and all costs,
                        expense, damage and liability arising because of any claim whatsoever which may be presented by anyone for loss or damage or
                        other relief occasioned or caused by the release of image(s), audio, or video to the undersigned applicant and their use in any
                        manner, including inspection, publication, reproduction, duplication or printing by anyone for any purpose whatsoever.
                      </li><br/>
                      <li>(6) To supply the Marist College Archives &amp; Special Collections with one complimentary copy of any printed, broadcast, or
                        published work in which one or more image(s), audio, or video appear.
                      </li><br/>
                      <li>(7) Not to permit others to reproduce the image(s), audio, or video; to destroy any digitized copies of image(s) audio, or
                        video following their use.
                      </li><br/>
                      <li>(8) Not to place the image(s), audio, or video in another institution, repository, or collection--public or private.</li><br/>
                      <li>(9) To return to the Marist College Archives &amp; Special Collections the supplied copies of any image(s), audio, or video if they are
                        designated by the Archives &amp; Special Collections for return.
                      </li><br/>
                      <li>(10) That the Marist College Archives &amp; Special Collections in no way surrenders its own right to publish or otherwise use the image(s),
                        audio, or video, or to grant permission for others to do so. That the Marist College Archives &amp; Special Collections reserves the right
                        to make exceptions or additions to the conditions stated herein.
                      </li><br/>
    							  </ul>
      							<p>As a patron of Marist College Archives &amp; Special Collections, I agree to abide by all copyright laws as they are applicable to my work, including intellectual rights, privacy of
                      individuals, corporate privacy rights and federal and state laws. I agree to abide by all donor and/or
                      informant restrictions placed on the items that I request to use, and agree that this material will not be misquoted, misused, or mishandled. I
                      also agree that these reproductions are solely for my personal use, and I will not resell or donate them.
                    </p>
                    <p>All reproductions are handled by the Marist College Archives &amp; Special Collections staff (unless noted otherwise) and are dependent on the
                      physical condition of the item. Reproductions are limited to 10% of a book, article, or folder unless otherwise authorized by a curator.
                      Orders are completed in the order that they are received.
                    </p>
      						</div>
              </div>
              <br/>

              <div id="numcheck">
        				<input type="checkbox" style="background-color: #f6f5f7" id="condofuse" value="condofuse" name = "condofuse"  required>
                  <span id="cond_of_use" style="color: #ff082b; font-weight: bold;">I accept the 10 Conditions of use agreement of Marist College Archives and Special Collection</span>
                </input>
  							<br/>
    						<p>
                  <label style="font-weight: bold;">Copyright Notice: </label>
                    The individual requesting reproductions expressly assumes the responsibility for compliance with all pertinent provisions of
        						the Copyright Act, 17 U.S.C. ss101 et seq. The patron further agrees to indemnify and hold harmless the Marist College Archives &amp; Special
        						Collections and its staff in connection with any disputes arising from the Copyright Act, over the reproduction of material at the request of the
        						patron.
                </p>

                <input type="checkbox" id="accept" value="Accept"  name = "accept" class="condofuse" required>
                  <span id="accept-cond" style="color: #ff082b; font-weight: bold;">I accept and agree with the copyright notice.</span>
                </input>
      					<br/><br/>

      					<label>Applicant's Initials:</label><input type="text" id="initials" size = "3" minLength = "2" maxLength = "3" class="sizable_input" required/>
      				</div>

              <div class="accordion" id="requests"><h4 id ="requests">Section 3: Requests:</h4><span class="click">Click to Open/Close</span></div>
                <div class="formcontents" id="formcontents">
    							<h3 id="addOrRem">Add/Remove Requests (Optional):</h3><br/>
    							<button id="buttonAdd-request" >+</button>
    							<button id="buttonRemove-request" disabled style="opacity: 0.5;">-</button>

    							<div id="request_input" style="border-bottom: 1px solid; padding: 10px; display: none;">
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
    									<!--label class="label" for="boxno">Box Number:</label><br/><input type="text" id="request_boxno" class="textinput" /-->
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
    									<input type="checkbox" name="avformat" value="hd" class="checkbox">HD</input>
    									<input type="checkbox" name="avformat" value="mov" class="checkbox">MOV</input>
    									<br/><br/>
    									<label class="label" for="desc">Description of Use (Provided by the researcher):</label><br/><textarea id="request_desc" rows="4" cols="4"/></textarea>
    								</div><!-- request_input template -->

                    <h3 align="center">(OR)</h3><br/></br>
    						    <div>
        							<h3 id="att">Attachements (if any):</h3></br>
        							<h3 id="requestsReadOnly" style="display:none"> Requests:</h3></br>
        							<input class='btn' type="file" name="uploaded_file" onchange= uploadedFile() id="uploaded_file"><br/></br>
    							    <div id="fileInfo"></div>
    						    </div>

    						    <?php if($attachment !=null){?>
    							    </br>
                      <div align="left" id='attachment'>
    								    <h3 style="color:#b31b1b">Previously Attached files:</h3></br></br>
    							      <a href="<?php echo $attachemntLink;?>"><?php echo $attachment ?></a></br><!--label --><!--?php echo $fileAttachment; ?></label-->
    							    </div></br></br>
    						    <?php } ?>

    						   <div align="left" id="messages">
    							   <label class="label" >Message (If any) : </label><br/>
    							   <div id="textarea_feedback"></div>
                     <textarea maxlength="140"  id="message" rows="5" cols="2000" style="display: inline-block;  margin-bottom: 10px;" placeholder="Write your message here." ></textarea>
                   </div>
                 </div>

                <!-- The submit button that will send the email and handle the form info. -->
                <input type = "submit" class="btn" id="initiate" value = "Initiate Use Agreement &amp; Send email">
              </div> <!-- researcherInfo -->
          </form>
        </div> <!-- content -->
      </div> <!-- container_home_child -->

      <div class = "bottom_container">
        <p class = "foot">
          James A. Cannavino Library, 3399 North Road, Poughkeepsie, NY 12601; 845.575.3199
          <br/>
          &#169; Copyright 2007-2017 Marist College. All Rights Reserved.

          <a href="http://www.marist.edu/disclaimers.html" target="_blank" >Disclaimers</a> | <a href="http://www.marist.edu/privacy.html" target="_blank" >Privacy Policy</a> |
          <a href='<?php echo base_url("?c=usragr&m=ack");?>' target="_blank">Acknowledgements</a>
        </p>
      </div> <!-- bottom_container -->
    </div> <!-- content_container -->
  </body>
</html>
