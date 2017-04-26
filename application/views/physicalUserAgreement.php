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


                <label class = "label">Confirmation Number:</label><br/><input type = "text" id = "name" class = "textinput" size = "10" maxLength = "10" required autofocus/>

              </div> <!-- formcontents -->

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
