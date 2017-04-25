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
            <h1 class = "page_head" style + "float:none;">Research Agreement Form</h1>
          </div> <!-- researcherInfo -->

          <!-- Is there a message that should be displayed here similiar to the pdf version of the form? -->

          <div class = "formcontents">
            <!-- Should the date be time stamped by the datbase? If the person is in the library... the time they are using the archive material is now -->
            <label class = "label">Name:</label><br/><input type = "text" id = "name" class = "textinput" size = "35" maxLength = "70" required autofocus/>
            <label class="label">Address:</label><br/><input type="text" id="address" class="textinput" required/>
            <label class="label">City/State:</label><br/><input type="text" id="citystate" class="textinput" required/>
            <label class="label">Zip:</label><br/><input type="text" id="zip" class="textinput" required/>
            <label class="label">Email:</label><br/><input type="text" id="email" class="textinput" required/>
            <label class="label">Phone Number:</label><br/><input type="text" id="phoneNo" class="textinput" required/>
            <label class = "label">Institutional Affiliation (if any):</label><br/><input type = "text" id = "affiliation" class ="textinput"/>

            <!-- Create checkboxes for user to select their academic status -->
            <label class = "label">Academic Status:</label><br/><br/>
              <input type = "checkbox" name = "status" value = "undergrad" class = "checkbox">Undergraduate Student</input>
              <input type = "checkbox" name = "status" value = "Faculty" class = "checkbox">Faculty</input>
              <input type = "checkbox" name = "status" value = "alumni" class = "checkbox">Alumni</input>
              <br/><br/>
              <input type = "checkbox" name = "status" value = "gradStudent" class = "checkbox">Graduate Student</input>
              <input type = "checkbox" name = "status" value = "staff" class = "checkbox">Staff</input>
              <input type = "checkbox" name = "status" value = "visiting" class = "checkbox">Visiting Researcher</input> <br/><br/>

              <!-- Create checkboxes for user to select how they learned about the Marist Archives -->
              <!-- When parsing this form, will I need to assign each of these inputs an id?? -->
            <label class = "label">How did you learn about our Archives and Special Collections holdings?</label> <br/><br/>
              <input type = "checkbox" name = "howArchives" value = "socialmedia" class = "checkbox">Social Media</input>
              <input type = "checkbox" name = "howArchives" value = "catalog" class = "checkbox">Online catalog</input>
              <input type = "checkbox" name = "howArchives" value = "foxhunt" class = "checkbox">Fox Hunt Search</input>
              <br/><br/>
              <input type = "checkbox" name = "howArchives" value = "internet" class = "checkbox">Internet</input>
              <input type = "checkbox" name = "howArchives" value = "instructor" class = "checkbox">Instructor</input>
              <input type = "checkbox" name = "howArchives" value = "citation" class = "checkbox" required>Citation in published work</input>
              <br/><br/>
              <input type = "checkbox" name = "howArchives" value = "referral" class = "checkbox">Referral from another institution</input>
              <input type = "checkbox" name = "howArchives" value = "other" class = "checkbox">Other</input>

            <br/><br/>
            <label class = "label">Subject of Research:</label><br/><input type = "text" class = "textinput" id = "subject" required/>

            <label class = "label">Collection (if any):</label><input type = "text" class = "textinput" id = "collection"/>

            <label class = "label">Purpose of Research (Check all that apply):</label>
              <br/><br/>
              <input type = "checkbox" id = "purpose" value - "localHistory" class = "checkbox">Local History</input>
              <input type = "checkbox" id = "purpose" value - "genealogy" class = "checkbox">Genealogy</input>
              <input type = "checkbox" id = "purpose" value - "thesis" class = "checkbox">Dissertation/Thesis</input>
              <br/></br/>
              <input type = "checkbox" id = "purpose" value - "literary" class = "checkbox">Literary Research</input>
              <input type = "checkbox" id = "purpose" value - "pictorial" class = "checkbox">Pictorial research</input>
              <input type = "checkbox" id = "purpose" value - "class" class = "checkbox">Class Project</input>
              <br/></br/>
              <input type = "checkbox" id = "purpose" value - "historical" class = "checkbox">Historical Research</input>
              <input type = "checkbox" id = "purpose" value - "discographical" class = "checkbox">Discographical research</input>
              <br/></br/>
              <input type = "checkbox" id = "purpose" value - "administrative" class = "checkbox">Marist administrative research</input>
              <input type = "checkbox" id = "purpose" value - "other" class = "checkbox">Other</input>
          </div> <!-- formcontents -->

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
