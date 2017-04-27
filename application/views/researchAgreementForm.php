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
                <div id = "howDiv">
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
                </div>
                <br/><br/>
                <label class = "label">Subject of Research:</label><br/><input type = "text" class = "textinput" id = "subject" required/>

                <label class = "label">Collection (If any):</label><input type = "text" class = "textinput" id = "collection"/>

                <div id = "purposeDiv">
                  <label class = "label">Purpose of Research (Check all that apply):</label>
                  <br/><br/>
                  <input type = "checkbox" id = "purpose" name = "purpose[]" value = "localHistory" class = "checkbox">Local History</input>
                  <input type = "checkbox" id = "purpose" name = "purpose[]" value = "genealogy" class = "checkbox">Genealogy</input>
                  <input type = "checkbox" id = "purpose" name = "purpose[]" value = "thesis" class = "checkbox">Dissertation/Thesis</input>
                  <br/></br/>
                  <input type = "checkbox" id = "purpose" name = "purpose[]" value = "literary" class = "checkbox">Literary Research</input>
                  <input type = "checkbox" id = "purpose" name = "purpose[]" value = "pictorial" class = "checkbox">Pictorial research</input>
                  <input type = "checkbox" id = "purpose" name = "purpose[]" value = "class" class = "checkbox">Class Project</input>
                  <br/></br/>
                  <input type = "checkbox" id = "purpose" name = "purpose[]" value = "historical" class = "checkbox">Historical Research</input>
                  <input type = "checkbox" id = "purpose" name = "purpose[]" value = "discographical" class = "checkbox">Discographical research</input>
                  <br/></br/>
                  <input type = "checkbox" id = "purpose" name = "purpose[]" value = "administrative" class = "checkbox">Marist administrative research</input>
                  <input type = "checkbox" id = "purpose" name = "purpose[]" value = "other" class = "checkbox">Other</input>
                </div>
              </div> <!-- formcontents -->

              <!-- Display the terms and conditions of use -->
              <div class="accordion" id="3">
                <h4 id="3">Section 2: Conditions of use</h4><span class="click">Click to Open/Close</span>
              </div>
    					<div id="3-contents" class="formcontents">
      				  <div style="height: 200px; border-bottom: 1px solid #e0e0e0; border-width: 75%; overflow-y: auto; padding: 10px; margin-bottom: 1px;">
      					 <ul>
                   <li>
                      <h3>In order to preserve the irreplaceable and often fragile materials in the collections, we ask our patrons to adhere to the following rules regarding care, handling, and security.</h3>
                   </li><br/><br/>
      					   <li>No food or beverages (including water bottles) are allowed in the Reading Room.
                   </li><br/>
                   <li>No pens are allowed. Complimentary pencils are available in the Reading Room.
                   </li><br/>
                   <li>No bags, purses, laptop cases, backpacks, briefcases, etc. are allowed in the Reading Room.
                   </li><br/>
                   <li>Lockers are provided for your convenience.
                   </li><br/>
                   <li>Archives &amp; Special Collections materials may only be used in the Reading Room (LB 134) during department hours.
                   </li><br/>
                   <li>Do not leave the Reading Room with any Archive or Special Collections materials.
                   </li><br/>
                   <li>Return all items to the Archives &amp; Special Collections staff member on duty.
                   </li><br/>
                   <li>Please keep the documents and/or materials flat on the table and do not place any items (e.g. laptops, note cards, etc.) on top of the research materials.
                   </li><br/>
                   <li>Please bring any misfiled items to the attention of the Archives &amp; Special Collections staff, but do not re-file items on your own.
                   </li><br/>
                   <li>Personal scanners and cameras (video, digital, still) are allowed in the Reading Room with permission from Archives &amp; Special Collections staff.
                   </li><br/>
                   <li>Copies are made for research and reference only. The Archives &amp; Special Collections staff must inspect any item you wish to copy before any copying is done. We reserve the right to refuse a copy request if copying will harm the item or violates copyright or other restrictions.
                   </li><br/>
                   <li>The Archives &amp; Special Collections staff will remove any metal fasteners (e.g. staples, paper clips) from the manuscripts. Please do not remove them yourself, and do not re-fasten items with metal clips or staples.
                   </li><br/>
                   <li>Materials (including manuscripts, sound recordings, photographs, moving image materials, and artifacts) housed in the College Archives &amp; Special Collections may be protected under copyright law (Title 17, U.S.C.).
                   </li><br/>
                   <li>An Archives &amps; Special Collections staff member may examine any items (notes, note cards, etc.) you bring in or out of the search room.
                   </li>
                 </ul>
                </div>

      					</div><!-- 3-contents (Terms and conditions) -->
                <br/>
                <div id = "numcheck">
                  <input type="checkbox" style="background-color: #f6f5f7" id="condofuse" value="condofuse" name = "condofuse" required/>
                    <span id="cond_of_use" style="color: #ff082b; font-weight: bold;">
  									I have read, understood, and by my initials below, agree to comply with the regulations set forth above, in order to use material in the custody of the Marist College Archives & Special Collections, James A. Cannavino Library, Marist College.
                    </span>
                  </input>
                  <br/><br/>
                  <label class = "label">Applicant's Initials:</label><input type = "text" id = "initials" size = "3" class = "sizable_input" maxLength = "3" required/>
                </div>

                <!-- The submit button that will send the email and handle the form info. -->
                <input type = "submit" class="btn" id="initiate" value = "Confirm Resarch Agreement &amp; Send Email">
              </div> <!-- researcherInfo -->
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
