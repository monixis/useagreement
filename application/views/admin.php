<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
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
    <!-- Bootstrap -->
    <link href="styles/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
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
    <button id="logout"><span class="glyphicon glyphicon-log-out"></span> Logout</button>

</div>
<div class="container">


    <div class="row bs-wizard" style="border-bottom:0;">

        <div id="step1" class="col-xs-3 bs-wizard-step disabled">
            <div class="text-center bs-wizard-stepnum">Step 1</div>
            <div class="progress"><div class="progress-bar"></div></div>
            <div class="bs-wizard-dot"></div>
            <div class="bs-wizard-info text-center">Initiated</div>
        </div>

        <div id="step2" class="col-xs-3 bs-wizard-step disabled"><!-- complete -->
            <div class="text-center bs-wizard-stepnum">Step 2</div>
            <div class="progress"><div class="progress-bar"></div></div>
            <div class="bs-wizard-dot"></div>
            <div class="bs-wizard-info text-center">Submitted</div>
        </div>

        <div id="step3" class="col-xs-3 bs-wizard-step disabled"><!-- complete -->
            <div class="text-center bs-wizard-stepnum">Step 3</div>
            <div class="progress"><div class="progress-bar"></div></div>
            <div class="bs-wizard-dot"></div>
            <div class="bs-wizard-info text-center">Returned.<p>(If the submitted request is incomplete/any changes reuqired)</p></div>
        </div>

        <div id="step4" class="col-xs-3 bs-wizard-step disabled"><!-- active -->
            <div class="text-center bs-wizard-stepnum">Step 4</div>
            <div class="progress"><div class="progress-bar"></div></div>
            <div class="bs-wizard-dot"></div>
            <div class="bs-wizard-info text-center">Approved </div>
        </div>



    </div>

</div>
</div>
<div id="container" class="container">

    <div class="page-header">
        <h3 align="center">Use Agreement Requests</h3>
    </div>

    <label class="label" for="collection">Filter By Status:</label><br/>
    <select id ="status" style="width: 100px;" >
        <option value="All" class="selectinput">All</option>
        <option value="Initiated" class="selectinput">Initiated</option>
        <option value="Submitted" class="selectinput">Submitted</option>
        <option value="Returned" class="selectinput">Returned</option>
        <option value="Approved" class="selectinput">Approved</option>
        <option value="Completed" class="selectinput">Completed</option>

    </select></br></br>


    <div class="table-responsive" id="the-content">


        <table align="center" class="table table-striped table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Attachments(if any)</th>
                <th>Status</th>
                <th>Date</th>

            </tr>
            </thead>
            <tbody>
            <?php $offset = $this->uri->segment(3, 0) + 1; ?>
            <?php foreach ($query->result() as $row): ?>
                <tr>
                    <td><a target="_blank" href="<?php echo base_url("?c=usragr&m=reviewRequest&userId=").$row ->userId?>"><?php echo $row ->userId ?></a></td>
                    <td><?php echo $row->userName; ?></td>
                    <td><?php echo $row->attachment ?></td>
                    <td><?php if($row->status == 1){ ?>
                            Returned
                        <?php } else if($row->status == 2){ ?>

                            Submitted
                        <?php } else if($row->status == 3){ ?>
                            Approved
                        <?php } else if($row->status == 0){ ?>
                            Initiated

                        <?php }else if($row->status == 4){?>
                            Completed
                        <?php } ?>

                    </td>
                    <td><?php echo $row->date; ?></td>


                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <div align="right" id="NumRecords">
            <label class="label" for="collection">Total:<?php echo $total_rows?></label>
        </div>
        <nav class='text-center'>
            <?php echo $pagination_links; ?>


        </nav>

    </div>
</div>
<div class="bottom_container">
    <p class = "foot">
        James A. Cannavino Library, 3399 North Road, Poughkeepsie, NY 12601; 845.575.3199
        <br />
        &#169; Copyright 2007-2016 Marist College. All Rights Reserved.
	<a href="http://www.marist.edu/disclaimers.html" target="_blank" >Disclaimers</a> | <a href="http://www.marist.edu/privacy.html" target="_blank" >Privacy Policy</a> | <a href=<?php echo base_url("?c=usragr&m=ack");?> target="_blank">Acknowledgements</a>
    </p>
</div>
<script>
    $("#logout").click(function(){
      //window.location.replace = "http://localhost/redfoxes/Discussion/createDiscussion_view";

      window.location = "https://login.marist.edu/cas/logout";
      //window.location.replace = "http://localhost/redfoxes/Discussion/createDiscussion_view";
    });
    $("#status").change(function(){
        if ($(this).val() == "Submitted") {
            var url = "<?php echo base_url("?c=usragr&m=useAgreementRequests&status=2")?>";
            document.getElementById('step1').className= "col-xs-3 bs-wizard-step complete";
            document.getElementById('step2').className= "col-xs-3 bs-wizard-step complete";
            document.getElementById('step3').className= "col-xs-3 bs-wizard-step disabled";
            document.getElementById('step4').className= "col-xs-3 bs-wizard-step disabled";

            $("#the-content").load(url);
        }else if($(this).val() == "Approved"){
            document.getElementById('step1').className= "col-xs-3 bs-wizard-stepp complete";
            document.getElementById('step2').className= "col-xs-3 bs-wizard-stepp complete";
            document.getElementById('step3').className= "col-xs-3 bs-wizard-stepp complete";
            document.getElementById('step4').className= "col-xs-3 bs-wizard-stepp complete";

            var url = "<?php echo base_url("?c=usragr&m=useAgreementRequests&status=3")?>";
            $("#the-content").load(url);

        }else if($(this).val() == "Returned"){
            document.getElementById('step1').className= "col-xs-3 bs-wizard-stp complete";
            document.getElementById('step2').className= "col-xs-3 bs-wizard-stp complete";
            document.getElementById('step3').className= "col-xs-3 bs-wizard-stp complete";
            document.getElementById('step4').className= "col-xs-3 bs-wizard-stp disabled";

            var url = "<?php echo base_url("?c=usragr&m=useAgreementRequests&status=1")?>";
            $("#the-content").load(url);
        }
        else if($(this).val() == "All"){
            document.getElementById('step1').className= "col-xs-3 bs-wizard-step disabled";
            document.getElementById('step2').className= "col-xs-3 bs-wizard-step disabled";
            document.getElementById('step3').className= "col-xs-3 bs-wizard-step disabled";
            document.getElementById('step4').className= "col-xs-3 bs-wizard-step disabled";

            var url = "<?php echo base_url("?c=usragr&m=pages")?>";
            $("#the-content").load(url);
        }else if($(this).val() == "Initiated"){
            var url = "<?php echo base_url("?c=usragr&m=useAgreementRequests&status=0")?>";
            document.getElementById('step1').className= "col-xs-3 bs-wizard-step complete";
            document.getElementById('step2').className= "col-xs-3 bs-wizard-step disabled";
            document.getElementById('step3').className= "col-xs-3 bs-wizard-step disabled";
            document.getElementById('step4').className= "col-xs-3 bs-wizard-step disabled";

            $("#the-content").load(url);
        }else if($(this).val() == "Completed"){
            document.getElementById('step1').className= "col-xs-3 bs-wizard-stp complete";
            document.getElementById('step2').className= "col-xs-3 bs-wizard-stp complete";
            document.getElementById('step3').className= "col-xs-3 bs-wizard-stp complete";
            document.getElementById('step4').className= "col-xs-3 bs-wizard-stp complete";

            var url = "<?php echo base_url("?c=usragr&m=useAgreementRequests&status=4")?>";
            $("#the-content").load(url);
        }else if($(this).val() == "Completed"){



        }
    });
</script>

</body>
</html>
