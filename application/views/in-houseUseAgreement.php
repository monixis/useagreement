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

    <link rel="stylesheet" type="text/css" href="styles/researchAgreementForm.css" />
    <script type="text/javascript" src="http://library.marist.edu/archives/mainpage/scripts/archivesChildMenu.js"></script>
    <script type="text/javascript" src="js/cloneRequests.js"></script>
    <link rel="stylesheet" type="text/css" href="styles/useagreement.css"/>

    <!-- Not sure what JS I need to add here from the other page. But most likely at least some of the js from initiateUseAgreement.php -->
  <script type = "text/javascript">
    uploadedFile = function() {
      $('#message').remove();
      var input = document.getElementById('uploaded_file');
      var output = document.getElementById('fileInfo');

      output.innerHTML = '<ul>';

    //  for (var i = 0; i < input.files.length; ++i) {
          if(input.files.item(0).size> 2000000){

              output.innerHTML += '<li>' + input.files.item(0).name + "<h4 style='color: red'>(Exceeded 2 MB File size limit)<h4>"+'</li>';

          }else {
             // output.innerHTML += '<li>' + input.files.item(i).name + '</li>';
              //output.innerHTML += '<li>' + input.files.item(i).size + '</li>';
          }
   //   }
      output.innerHTML += '</ul>';

  }

  $(document).ready(function(){
    $('div#request_input').clone();


    function progress(e) {

        if (e.lengthComputable) {
            var max = e.total;
            var current = e.loaded;

            var Percentage = (current * 100) / max;
            console.log(Percentage);


            if (Percentage >= 100) {
                // process completed
            }
        }
    }

    /* Handles the drop down for the terms and conditions */
    $('div.accordion').click(function(){
      var div = $(this).attr('id');
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

    $("form").submit(function(){
      var filesize = 0;
      if($('input#uploaded_file')[0].files[0]) {
          filesize  = $('input#uploaded_file')[0].files[0].size / 1024 / 1024;
      }

      /* Success case for making a request */
      if(filesize <= 2){
        var date = generateDate();
        var researchAgreementNumber = $('input#researchAgreementNumber').val();
        var userInitials = $('input#initials').val();
        var requestCount = $("#formcontents > div").length - 1;
        var requestList = [];
        var termsAndConditions = "false";
        if ($('#accept').prop('checked') && $('#condofuse').prop('checked')) {
          termsAndConditions = "true";
        }

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
            //var reqCollection = $(str2.concat(" input#request_collection")).val();

            var boxNumber = "";//$(str2.concat(" input#request_boxno")).val()
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

        // Verify that the user exists in the database based on their researchAgreementNumber
        $.post("<?php echo base_url("?c=usragr&m=verifyResearcher");?>", {
            researchAgreementNumber: researchAgreementNumber,
            userInitials: userInitials
        }).done(function (verifiedUser) {
          alert(verifiedUser);
          if(verifiedUser == 1 ){
            alert("User is validated");
            if($('input#uploaded_file')[0].files[0]){
              var m_data = new FormData();
              m_data.append('file_attach', $('input#uploaded_file')[0].files[0]);
              m_data.append('researchAgreementNumber', researchAgreementNumber);
              m_data.append('date', date);
              var pcdone = 0;
              $.ajax({
                  xhr: function () {
                      var xhr = new window.XMLHttpRequest();
                      xhr.upload.addEventListener("progress", function (evt) {
                          if (evt.lengthComputable) {
                              var percentComplete = evt.loaded / evt.total;
                              console.log(percentComplete);
                              pcdone = percentComplete;
                              $('.progress').css({
                                  width: percentComplete * 100 + '%'

                              });
                              if (percentComplete === 1) {
                                  $("#progressstatus").html("<p color='black'>File Upload is in progress</p>");

                              }
                          }
                      }, false);
                      return xhr;
                  },

                  type: "POST",
                  url: "<?php echo base_url("?c=usragr&m=InitiateWithMailAttachmentByResearchNum");?>",
                  data: m_data,
                  processData: false,
                  contentType: false,
                  cache: false,

                  success: function (response) {
                      //load json data from server and output message
                      if (response.type == 'error') { //load json data from server and output message
                          output = '<div class="error">' + response.text + '</div>';
                      } else {
                          setTimeout(function () {
                              $('.progress').addClass('hide');
                              $("#progressstatus").html("<p color='black'></p>");
                              $('#requestStatus').show().css('background', '#66cc00').append("#" + userId + ": A User Agreement Form has been sent to " + userName);

                          }, 5000);


                          // output = '<div class="success">' + response.text + '</div>';
                      }
                      $("#contact_form #contact_results").hide().html(output).slideDown();
                  }
              });
            }
            else{

            }


            /* Disable the submit button to prevent the user from sending multiple emails to themselves and creating multiple duplicated entries */
            $('.btn').attr('disabled', true);
          }
          else{
            alert("user is not validated");
          }
        });


      }
      /* Uploaded file is too big */
      else{
        $('#requestStatus').show().css('background', '#b31b1b').append("<div id='message'>Uploaded file size should be less than 2 MB</div>");
      }
      /* Make the page scroll to the top to show either a success or error message */
      $("html, body").animate({scrollTop: 0}, 600);
    });

});

/* This function generates the current date */
function generateDate(){
  var today = new Date();
  var month = today.getMonth() + 1;
  var day = today.getDate();
  var year = today.getFullYear();

  // Add a zero in front of the day and month if single digits
  if(day < 10){
    day = "0" + day;
  }

  if(month < 10){
    month = "0" + month;
  }

  return (month + "/" + day + "/" + year);
}
  </script>
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
            <h1 class = "page_head" style = "float:none;">In-House Use Agreement</h1>

            <!-- Is there a message that should be displayed here similiar to the pdf version of the form? -->


            <!-- All of the inputs are in a form element for validaiton purposes (ex: required) -->
            <form style = "float:none; margin-left:0;" action="javascript:void(0);">
              <div class = "formcontents">
              <!-- Should the date be time stamped by the datbase? If the person is in the library... the time they are using the archive material is now -->
                <label class = "label">Confirmation Number:</label><br/><input type = "text" id = "researchAgreementNumber" class = "sizable_input" size = "10" minLength = "10" maxLength = "10" required autofocus/>
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

              <div id="requests">
                  <h2>Requests:</h2>
                  <div class="formcontents" id="formcontents">
                      <h3>Add/Remove Requests</h3><br/></br>
                      <button id="buttonAdd-request">+</button>
                      <button id="buttonRemove-request" disabled style="opacity: 0.5;">-</button></br>
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
                              <option value="Hudson River Valley Commission Collection: Records Relating to the Storm King Case, 1966 - 1967">Hudson River Valley Commission Collection: Records Relating to the Storm King Case, 1966 - 1967</option>
                              <option value="Hudson River Valley Commission Collection: Records Relating to the 1965 - 1970 Surveys">Hudson River Valley Commission Collection: Records Relating to the 1965 - 1970 Surveys</option>
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
                              <option value="College Archives">College Archives</option>
                              <option value="College Archives - Audio-Visual Collection">College Archives - Audio-Visual Collection</option>
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
                          </select><!--input type="text" id="request_collection" class="textinput"/-->
                          </br></br><!--label class="label" for="boxno">Box Number:</label><br/><input type="text" id="request_boxno" class="textinput"/-->
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
                          <input type="checkbox" name="avformat" value="hd" class="checkbox">HD</input>
                          <input type="checkbox" name="avformat" value="mov" class="checkbox">MOV</input>
                          <br/><br/>
                          <label class="label" for="desc">Description of Use (Provided by the researcher):</label><br/><textarea id="request_desc" rows="4" cols="4"/></textarea>

                      </div><!-- request_input template -->
                  </div>
                  <h3 align="center">(OR)</h3><br/>
                  <h3>Add Attachment</h3><br/></br>
                  <input align="center" class='btn' type="file" name="uploaded_file" onchange="uploadedFile()" id="uploaded_file"><br/></br>
                     <div id="fileInfo"></div>
              </div><!-- formcontents -->

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
