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
<script>
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