<!DOCTYPE html>
<html lang = 'en'>
  <head>
    <!-- Not sure what final title will be -->
    <title>Research Agreement Form</title>
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
    <script type = "text/javascript" src = "../../js/researchAgreementForm.js"></script>

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
            <h1 class = "page_head" style = "float:none;">Research Agreement Form</h1>

            <!-- Is there a message that should be displayed here similiar to the pdf version of the form? -->


            <!-- All of the inputs are in a form element for validaiton purposes (ex: required) -->
            <form style = "float:none; margin-left:0;" action="javascript:void(0);">
              <div class = "formcontents">
              <!-- Should the date be time stamped by the datbase? If the person is in the library... the time they are using the archive material is now -->


                <label class = "label">Name:</label><br/><input type = "text" id = "name" class = "textinput" size = "35" maxLength = "70" required autofocus/>
                <label class="label">Address:</label><br/><input type="text" id="address" class="textinput" required/>
                <label class="label">City/State:</label><br/><input type="text" id="citystate" class="textinput" required/>
                <label class="label">Zip:</label><br/><input type="text" id="zip" class="textinput" required/>
                <label class="label">Email:</label><br/><input type="email" id="email" class="textinput" required/>
                <label class="label">Phone Number:</label><br/><input type="text" id="phoneNo" class="textinput" required/>
                <label class = "label">Institutional Affiliation (If any):</label><br/><input type = "text" id = "affiliation" class ="textinput"/>

                <!-- Create checkboxes for user to select their academic status -->
                <label class = "label">Academic Status (If any):</label><br/><br/>
                  <input type = "radio" id = "status" name = "status" value = "undergrad" class = "checkbox">Undergraduate Student</input>
                  <input type = "radio" id = "status" name = "status" value = "Faculty" class = "checkbox">Faculty</input>
                  <input type = "radio" id = "status" name = "status" value = "alumni" class = "checkbox">Alumni</input>
                  <br/><br/>
                  <input type = "radio" id = "status" name = "status" value = "gradStudent" class = "checkbox">Graduate Student</input>
                  <input type = "radio" id = "status" name = "status" value = "staff" class = "checkbox">Staff</input>
                  <input type = "radio" id = "status" name = "status" value = "visiting" class = "checkbox">Visiting Researcher</input> <br/><br/>

                  <!-- Create checkboxes for user to select how they learned about the Marist Archives -->
                  <!-- When parsing this form, will I need to assign each of these inputs an id?? -->
                <label class = "label">How did you learn about our Archives and Special Collections holdings?</label> <br/><br/>
                  <input type = "checkbox" id = "howArchives" name = "howArchives[]" value = "socialmedia" class = "checkbox">Social Media</input>
                  <input type = "checkbox" id = "howArchives" name = "howArchives[]" value = "catalog" class = "checkbox">Online catalog</input>
                  <input type = "checkbox" id = "howArchives" name = "howArchives[]" value = "foxhunt" class = "checkbox">Fox Hunt Search</input>
                  <br/><br/>
                  <input type = "checkbox" id = "howArchives" name = "howArchives[]" value = "internet" class = "checkbox">Internet</input>
                  <input type = "checkbox" id = "howArchives" name = "howArchives[]" value = "instructor" class = "checkbox">Instructor</input>
                  <input type = "checkbox" id = "howArchives" name = "howArchives[]" value = "citation" class = "checkbox">Citation in published work</input>
                  <br/><br/>
                  <input type = "checkbox" id = "howArchives" name = "howArchives[]" value = "referral" class = "checkbox">Referral from another institution</input>
                  <input type = "checkbox" id = "howArchives" name = "howArchives[]" value = "other" class = "checkbox">Other</input>

                <br/><br/>
                <label class = "label">Subject of Research:</label><br/><input type = "text" class = "textinput" id = "subject" required/>

                <label class = "label">Collection (If any):</label><input type = "text" class = "textinput" id = "collection"/>

                <label class = "label">Purpose of Research (Check all that apply):</label>
                  <br/><br/>
                  <input type = "checkbox" id = "purpose" name = "purpose[]" value - "localHistory" class = "checkbox">Local History</input>
                  <input type = "checkbox" id = "purpose" name = "purpose[]" value - "genealogy" class = "checkbox">Genealogy</input>
                  <input type = "checkbox" id = "purpose" name = "purpose[]" value - "thesis" class = "checkbox">Dissertation/Thesis</input>
                  <br/></br/>
                  <input type = "checkbox" id = "purpose" name = "purpose[]" value - "literary" class = "checkbox">Literary Research</input>
                  <input type = "checkbox" id = "purpose" name = "purpose[]" value - "pictorial" class = "checkbox">Pictorial research</input>
                  <input type = "checkbox" id = "purpose" name = "purpose[]" value - "class" class = "checkbox">Class Project</input>
                  <br/></br/>
                  <input type = "checkbox" id = "purpose" name = "purpose[]" value - "historical" class = "checkbox">Historical Research</input>
                  <input type = "checkbox" id = "purpose" name = "purpose[]" value - "discographical" class = "checkbox">Discographical research</input>
                  <br/></br/>
                  <input type = "checkbox" id = "purpose" name = "purpose[]" value - "administrative" class = "checkbox">Marist administrative research</input>
                  <input type = "checkbox" id = "purpose" name = "purpose[]" value - "other" class = "checkbox">Other</input>
              </div> <!-- formcontents -->

              <!-- Display the terms and conditions of use -->
              <div class="accordion" id="3">
                <h4 id="3">Section 2: Conditions of use</h4><span class="click">Click to Open/Close</span>
              </div>
    					<div id="3-contents" class="formcontents">
      				  <div style="height: 200px; border-bottom: 1px solid #e0e0e0; border-width: 75%; overflow-y: auto; padding: 10px; margin-bottom: 1px;">
      					 <ul>
      					   <li>(1) To use the image(s), audio, or video only for the purpose or project stated above. Later and different use constitutes reuse and is
      						 prohibited. Subsequent requests for permission to reuse image(s), audio, or video must be made in writing. A reuse fee may apply</li><br/>
      						 <li>(2) To give proper credit for the image(s), audio, or video. Unless otherwise stated on the photographic copy, the credit line should
      						  read: James A. Cannavino Library, Archives & Special Collections, Marist College, USA. When the name of the photographer
      							or collection is supplied, this should also be included in the credit. The placement of credit should be as follows:<br/>
      							  <ul>a) Printed material - Preferably the credit line should appear on the same page as the printed copy of the image and
      								immediately adjacent to it. The credit may appear elsewhere in the publication if done in such a way that readers can quickly match individual images with their respective credit.</ul><br/>
                      <ul>b) Films, filmstrips, video, or electronic media (including Internet productions) - The credit line should appear on the film, filmstrip,
                        video, or electronic media where other sources are listed. If manuals accompany films or
                        filmstrips, the credit should appear where the subject of the illustration is discussed in the text.</ul><br/>
                      <ul>c) Public exhibitions - The credit should appear within the exhibit area.</ul><br/>
                      <ul>d) Audio broadcasts – The credit should be read at the end of the broadcast or given when other sources are listed.</ul><br/>
      			        </li>
      							<li>(3) Not to digitize images at a resolution higher than 72 dots per inch for use on the Internet, or distribute image(s), audio, or video without written authorization from the Marist College Archives &amp; Special Collections.</li><br/>
                    <li>(4) To assume all responsibility for questions of copyright and invasion of privacy that may arise in the copying and in the use of
                      the image(s), audio, or video and to assume responsibility for obtaining all necessary permissions pertaining to use.</li><br/>
                    <li>(5) To defend and indemnify and save and hold harmless Marist College, its Archives &amp; Special Collections, its employees or
                      designates, and the donors and former owners of Marist College Archives or Special Collections, from any and all costs,
                      expense, damage and liability arising because of any claim whatsoever which may be presented by anyone for loss or damage or
                      other relief occasioned or caused by the release of image(s), audio, or video to the undersigned applicant and their use in any
                      manner, including inspection, publication, reproduction, duplication or printing by anyone for any purpose whatsoever.</li><br/>
                    <li>(6) To supply the Marist College Archives &amp; Special Collections with one complimentary copy of any printed, broadcast, or
                      published work in which one or more image(s), audio, or video appear.</li><br/>
                    <li>(7) Not to permit others to reproduce the image(s), audio, or video; to destroy any digitized copies of image(s) audio, or
                      video following their use.</li><br/>
                    <li>(8) Not to place the image(s), audio, or video in another institution, repository, or collection--public or private.</li><br/>
                    <li>(9) To return to the Marist College Archives &amp; Special Collections the supplied copies of any image(s), audio, or video if they are
                      designated by the Archives &amp; Special Collections for return.</li><br/>
                    <li>(10) That the Marist College Archives &amp; Special Collections in no way surrenders its own right to publish or otherwise use the image(s),
                      audio, or video, or to grant permission for others to do so. That the Marist College Archives & Special Collections reserves the right
                      to make exceptions or additions to the conditions stated herein.</li><br/>
      						</ul>
      						<p>As a patron of Marist College Archives &amp; Special Collections, I agree to abide by all copyright laws as they are applicable to my work, including intellectual rights, privacy of
                    individuals,   corporate privacy rights and federal and state laws. I agree to abide by all donor and/or
                    informant restrictions placed on the items that I request to use, and agree that this material will not be misquoted, misused, or mishandled. I
                    also agree that these reproductions are solely for my personal use, and I will not resell or donate them.
                  </p>
                  <p>All reproductions are handled by the Marist College Archives &amp; Special Collections staff (unless noted otherwise) and are dependent on the
                    physical condition of the item. Reproductions are limited to 10% of a book, article, or folder unless otherwise authorized by a curator.
                    Orders are completed in the order that they are received.
                  </p>
      					</div><!-- 3-contents (Terms and conditions) -->

                <div id = "numcheck">
                  <input type="checkbox" style="background-color: #f6f5f7" id="condofuse" value="condofuse" name = "condofuse" required/>
                    <span id="cond_of_use" style="color: #ff082b; font-weight: bold;">
  									I accept the 10 Conditions of use agreement of Marist College Archives and Special Collection
                    </span>
                  </input>
                </div>

              </div> <!-- researcherInfo -->
              <!-- The submit button that will send the email and handle the form info. -->
              <input type = "submit" class="btn" id="initiate" value = "Initiate Use Agreement &amp; Send email">
          </form>




        </div> <!-- content -->
      </div> <!-- container_home_child -->

      <div class = "bottom_container">
        <p class = "foot">
          James A. Cannavino Library, 3399 North Road, Poughkeepsie, NY 12601; 845.575.3199
          <br />
          &#169; Copyright 2007-2016 Marist College. All Rights Reserved.

          <a href="http://www.marist.edu/disclaimers.html" target="_blank" >Disclaimers</a> | <a href="http://www.marist.edu/privacy.html" target="_blank" >Privacy Policy</a> |
          <!-- <a href=<?php echo base_url("?c=usragr&m=ack");?> target="_blank">Acknowledgements</a>-->
        </p>
      </div> <!-- bottom_container -->
    </div> <!-- content_container -->
  </body>
</html>
