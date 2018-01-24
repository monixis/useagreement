<?php
class usragr extends CI_Controller
{


    private $limit = 10;

    public function index()
    {
        $this->load->model('usragr_model');
        $data['title'] = "COPY REQUEST/USE AGREEMENT FORM";
        $date = date_default_timezone_set('US/Eastern');
        $this->load->view('initiateUseAgreement', $data);
    }

    public function __construct()
    {

  		parent::__construct();
  		if(!isset($_SESSION))
      {
          session_start();
  				//$_SESSION['id'] = session_id();
      }
    }

	 public function ack(){
	 	$this->load->view('ack');
	 }

    /*
     *Function to create new researcher.
     *
     */

    public function insertNewResearcher()
    {
        date_default_timezone_set('US/Eastern');
        $date = date("m/d/Y");

        $data = array(
            'userName'   => $_POST['userName'],
            'emailId'    => $_POST['emailId'],
            //'citystate'  => $_POST['citystate'],
            'address'    => $_POST['address'],
            'country'  => $_POST['country'],
            'state'  => $_POST['state'],
            'city'  => $_POST['city'],
            'zipCode'    => $_POST['zipCode'],
            'date'       => $_POST['date'],
            'phoneNumber'=> $_POST['phoneNumber'],
            'status'     => 0
        );
        $this->load->model('usragr_model');
        $result = $this->usragr_model->insert_researcher($data, 'researcher');
        if($_POST['comments']>0 ||$_POST['comments']!= null) {
            $data = array(
                'comment' => $_POST['comments'],
                'commentType' => "INSTRUCTIONS",
                'userId' => $result
            );
            $this->load->model('usragr_model');
            $chat_result = $this->usragr_model->saveChat($data, 'chat');
            if ($chat_result > 0) {
            }
            }
        if ($result > 0) {

            $userId = $result; // As the result from model returns maximum value of research table
            $requestCount = $_POST['requestCount'];
            //check if there is any requests
            if ($requestCount != 0) {
                $requestList = array($_POST['requestList']);

                //processiong array of requests
                foreach ($requestList as $request) {
                    foreach ($request as $row) {
                        $usageDesc = $str = str_replace("\n", ' ',$row[6] );

                        //data of request row
                        $data = array(
                            'collection'      => $row[0],
                            'boxNumber'       => $row[1],
                            'itemNumber'      => $row[2],
                            'imageResolution' => $row[3],
                            'fileFormat'      => $row[4],
                            'audOrVidFileFormat' => $row[5],
                            'usageDescription' => $usageDesc,
                            'userId'          => $userId
                        );
                        //insert the request
                        $response = $this->usragr_model->insertUserRequest($data, 'request');
                        if ($response > 0) {

                        }else{
                            return 0;
                        }
                    }}// end of processing requests
            }
        }

            echo $result;

        //}else{

          //  $rollback = $this->usragr_model->deleteUser($result);
            //echo $rollback;
       // }

    }

    /*
     * function to fetch the researcher with userId.
     * loads useAgreement view form
     */
    public function useagreement()
    {
        /*WORKING*/
        $this->load->model('usragr_model');
        $userId = $this->input->get('userId');
        $userId=substr($userId,6,-6);

        $result = $this->usragr_model->getresearcher($userId);
        $chat_array =  $this->usragr_model -> getChat($userId);
        if($chat_array>0) {
            $chat_list = json_decode(json_encode($chat_array), true);
            //   print_r($chat_list);
            $data['chatList'] = $chat_list;
            }
        if($result!=null) {
            //  $rscrAndReqInfo= array();
            $researcher = array();
            // foreach($result as $row){
            //   echo sizeof($row);
            $info = json_decode(json_encode($result), true);
               $data['user_Id'] = $userId;
            foreach ($info as $row) {
                //  $data['userName'] =
                $request = array();
                if (sizeof($researcher) == 0) {
                    array_push($researcher,$row['userName'], $row['country'],$row['state'],$row['city'],
                        $row['address'], $row['emailId'], $row['zipCode'],
                         $row['date'], $row['phoneNumber'], $row['status'], $row['attachment'], $row['userInitials'], $row['termsAndCond'], $row['requestAddedBy'],$row['attachmentLink']);
                    $data['researcher'] = $researcher;
                }

                if ($row['requestId'] != null) {
                    //$usageDesc = $str = str_replace("\n", ' ',$row['usageDescription'] );
					$usageDesc = str_replace("\n", ' ',$row['usageDescription'] );
					$usageDesc = preg_replace("/'/", '\&#39;',$usageDesc);
					$usageDesc = preg_replace('/"/', '\&#34;', $usageDesc);

                    $request[] = $row['requestId'];
                    $request[] = $row['collection'];
                    $request[] = $row['boxNumber'];
                    $request[] = $row['itemNumber'];
                    $request[] = $usageDesc;
                    $request[] = explode(':', $row['imageResolution']);
                    $request[] = explode(':', $row['fileFormat']);
                    $request[] = explode(':', $row['audOrVidFileFormat']);
                    //  print_r($request);
                    $requests[] = $request;

                    $data['requests'] = $requests;
                }else{
                    $data['requests'] = null;

                }
            }
            $this->load->view('useAgreement', $data);
        }else{
            echo '<html>', "\n"; // I'm sure there's a better way!
            echo '<head>', "\n";
            echo '</head>', "\n";
            echo '<body>', "\n";
            echo '<h1 align="center">404: User Not Found</h1>', "\n";
            echo '</body>', "\n";
            echo '</html>', "\n";
        }
    }
    /*
     * function to fetch the researcher with userId
     * loads reviewUseAgreement view form
     */
    public function reviewRequest()
    {
        /*WORKING*/
        $this->load->model('usragr_model');
        $userId = $this->input->get('userId');
        $result = $this->usragr_model->getresearcher($userId);
        $chat_array =  $this->usragr_model -> getChat($userId);
        if($chat_array>0) {
            $chat_list = json_decode(json_encode($chat_array), true);
            //   print_r($chat_list);
            $data['chatList'] = $chat_list;
        }
        if ($result != null) {
            //  $rscrAndReqInfo= array();
            $researcher = array();
            // foreach($result as $row){
            //   echo sizeof($row);
            $info = json_decode(json_encode($result), true);
      $data['user_id'] = $userId;
            foreach ($info as $row) {
                //  $data['userName'] =
                $request = array();
                if (sizeof($researcher) == 0) {
                    array_push($researcher, $row['userName'], $row['country'], $row['state'], $row['city'],
                        $row['address'], $row['emailId'], $row['zipCode'],
                        $row['date'], $row['phoneNumber'], $row['status'],$row['attachment'], $row['userInitials'], $row['termsAndCond'], $row['emailSubject'], $row['receiver'], $row['requestAddedBy'],$row['attachmentLink'],$row['copies_sent']);
                    $data['researcher'] = $researcher;
                }
                if ($row['requestId'] != null) {
                    $usageDesc = str_replace("\n", ' ',$row['usageDescription'] );
					$usageDesc = preg_replace("/'/", '\&#39;',$usageDesc);
					$usageDesc = preg_replace('/"/', '\&#34;', $usageDesc);
                    $request[] = $row['requestId'];
                    $request[] = $row['collection'];
                    $request[] = $row['boxNumber'];
                    $request[] = $row['itemNumber'];
                    $request[] = $usageDesc;
                    $request[] = explode(':', $row['imageResolution']);
                    $request[] = explode(':', $row['fileFormat']);
                    $request[] = explode(':', $row['audOrVidFileFormat']);
                    //  print_r($request);
                    $requests[] = $request;
                    $data['requests'] = $requests;
                }                else {
                    $data['requests'] = null;

                }
            }
            //print_r($data);
            //  print_r(sizeof($rscrAndReqInfo));
            $this->load->view('reviewUseAgreement', $data);
        }else{
            echo "please provide valid userId";

        }
    }
    /*
     * Function to save/update researcher.
     * to update the existing researcher and request.
     */
    public function saveResearcher()
    {
        $userId = $this->input->get('userId');
        $userId=substr($userId,6,-6);
        //  $id= $this->input->post($researcherId);
        date_default_timezone_set('US/Eastern');
        $date = date("m/d/Y");
        $this->load->model('usragr_model');

        //updating researcher information
        $result = $this->usragr_model->update_researcher($_POST['userName'], $_POST['country'], $_POST['state'], $_POST['city'], $_POST['address'], $_POST['emailId'],
            $_POST['zipCode'], $_POST['date'], $_POST['phoneNumber'], $_POST['userInitials'],$_POST['termsAndConditions'],$userId);

        if($result>0) {   //Deleting existing requests
            $result = $this->usragr_model->deleteRequests($userId);
        }
        //echo $result;
        if ($result > 0) { //Inserting New Requests
            // $userId = $result; // As the result from model returns maximum value of research table
            $requestCount = $_POST['requestCount'];
            //check if there is any requests
            if ($requestCount != 0) {
                $requestList = array($_POST['requestList']);
                //processiong array of requests
                foreach ($requestList as $request) {
                    foreach ($request as $row) {

                        $usageDesc = $str = str_replace("\n", ' ',$row[6] );
                        //data of request row
                        $data = array(
                            'collection'         => $row[0],
                            'boxNumber'          => $row[1],
                            'itemNumber'         => $row[2],
                            'imageResolution'    => $row[3],
                            'fileFormat'         => $row[4],
                            'audOrVidFileFormat' => $row[5],
                            'usageDescription' =>$usageDesc,
                            'userId'             => $userId
                        );
                        //insert the request
                        $result = $this->usragr_model->insertUserRequest($data, 'request');
                    }
                }// end of processing requests
            }
/*                $six_digit_random_number = mt_rand(100000, 999999);
               $userId = $six_digit_random_number.$userId;*/
            $six_digit_random_string =  $this -> generateRandomString();
            $UUID=$six_digit_random_string.$userId;
            $six_digit_random_string =  $this -> generateRandomString();
            $UUID = $UUID.$six_digit_random_string;
            echo $UUID;
        }
    }
    /*
     * Function to submit/update researcher.
     * Function update researcher and request details.
     * Updates the status of the transaction to 2.That indicates that user submitted the form for approval.
     * Trigger email to librarian with URL to review the request.
     */
    public function submitResearcher()
    {
        $userId = $this->input->get('userId');
        $userId=substr($userId,6,-6);
        //  $id= $this->input->post($researcherId);
        date_default_timezone_set('US/Eastern');
        $date = date("m/d/Y");
        $this->load->model('usragr_model');


        if($_POST['message']>0 ||$_POST['message']!= null) {
                $data = array(
                    'comment' => $_POST['message'],
                    'commentType' => "MESSAGE",
                    'userId' => $userId
                );
                $this->load->model('usragr_model');
                $chat_result = $this->usragr_model->saveChat($data, 'chat');
                if ($chat_result > 0) {
                }
        }

        //updating researcher information
            $result = $this->usragr_model->update_researcherWithStatus($_POST['userName'], $_POST['country'], $_POST['state'], $_POST['city'], $_POST['address'], $_POST['emailId'],
                $_POST['zipCode'], $_POST['date'], $_POST['phoneNumber'], 2, $_POST['userInitials'], $_POST['termsAndConditions'], $userId);

        if($result>0) {   //Deleting existing requests
            $result = $this->usragr_model->deleteRequests($userId);
        }
        //echo $result;
        if ($result > 0) { //Inserting New Requests
            // $userId = $result; // As the result from model returns maximum value of research table
            $requestCount = $_POST['requestCount'];
            //check if there is any requests
            if ($requestCount != 0) {
                $requestList = array($_POST['requestList']);
                //processiong array of requests
                foreach ($requestList as $request) {
                    foreach ($request as $row) {
                        $usageDesc = $str = str_replace("\n", ' ',$row[6] );

                        //data of request row
                        $data = array(
                            'collection'         => $row[0],
                            'boxNumber'          => $row[1],
                            'itemNumber'         => $row[2],
                            'imageResolution'    => $row[3],
                            'fileFormat'         => $row[4],
                            'audOrVidFileFormat' => $row[5],
                            'usageDescription' =>$usageDesc,
                            'userId'             => $userId
                        );
                        //insert the request
                        $result = $this->usragr_model->insertUserRequest($data, 'request');
                    }}// end of processing requests
            }
            if($result>0){

                $six_digit_random_string =  $this -> generateRandomString();
                $UUID=$six_digit_random_string.$userId;
                $six_digit_random_string =  $this -> generateRandomString();
                $UUID = $UUID.$six_digit_random_string;
                echo $UUID;

            }
        }
    }

    /*
     * Function to disapprove request.
     * Change the transactions status to 1. That enables the user to edit66 and resubmit the request.
     * Adds Instructions to the user.
     */
    public function disapproveRequest()
    {
        $userId = $this->input->get('userId');
        // $id= $this->input->post($researcherId);
        date_default_timezone_set('US/Eastern');
        $date = date("m/d/Y");
        $this->load->model('usragr_model');
        //updating researcher information
        $result = $this->usragr_model->approveOrDisapprove_request($_POST['date'],1,$userId);

        //Deleting existing requests
        //echo $result;

        if( $_POST['instructions'] != null){
            $data = array(
                'comment' => $_POST['instructions'],
                'commentType' => "INSTRUCTIONS",
                'userId' => $userId
            );
            $this->load->model('usragr_model');
            $chat_result = $this->usragr_model->saveChat($data, 'chat');
            if ($chat_result > 0) {
                echo "success";
            }
        }

        if($result){
            $this->load->library('email');
            $config['protocol'] = "sendmail";
            $config['smtp_host'] = "tls://smtp.gmail.com";
            $config['smtp_port'] = "465";
            $config['smtp_user'] = "maristarchives@gmail.com";
            $config['smtp_pass'] = "redfoxesArchives";
            $config['charset'] = "utf-8";
            $config['mailtype'] = "html";
            $config['newline'] = "\r\n";
            $this->email->initialize($config);
            $this->email->from('maristarchives@gmail.com', ' Marist Archives');
            $this->email->to($_POST['emailId']);
          //  $this->email->cc('dheeraj.karnati1@marist.edu');
            //  $this->email->cc('another@another-example.com');
            //$this->email->bcc('them@their-example.com');
            $this->email->subject('Returned for review');
            $greeting        = "Dear ".$_POST['userName'];
            $messageOne     = "As we found some errors in the form, we have returned it for review. Please click on the below link to resubmit the form (Please follow the instructions provided in the bottom of the form) ";
            $six_digit_random_string =  $this -> generateRandomString();
            $UUID=$six_digit_random_string.$userId;
            $six_digit_random_string =  $this -> generateRandomString();
            $UUID = $UUID.$six_digit_random_string;
            $url = base_url()."?c=usragr&m=useagreement&userId=".$UUID ;
            $instructions = $_POST['instructions'];
            $message = '<html><body>';

            $message .= '<table width="100%"; rules="all" style="border:1px solid #3A5896;" cellpadding="10">';

            $message .= "<tr ><td align='center'><img src='https://s.graphiq.com/sites/default/files/10/media/images/Marist_College_2_220374.jpg'  /><h3> Marist Archives and Special Collection </h3><h3>COPY/USE AGREEMENT REQUEST</h3> ";

            $message .= "<br/><br/> <h4>$greeting ,<br /><br />As we found some errors in the form, we have returned it for review.  Please click on the below link to resubmit the form (Please follow the instructions provided in the bottom of the form)</h4><br/> <I>Link:</I><br/><a href='$url'>$url</a>  </></tr>";

            //$message .= "<tr><td colspan=2 font='colr:#3A5896;'><I>Link:<br></I> $url </td></tr>";
            $message .= "<tr><td colspan=2 font='colr:#3A5896;'><I>Instructions:<br></I><h4>$instructions</h4></td></tr>";
            $message .= "</table>";

            $message .= "</body></html>";


            $this->email->message($message);
            if(  $this->email->send()){
                echo $userId;

            }else{

                echo "failed to send email";
            }

        }
    }

    /*
     *Function to approve request.
     *Trigger email to user about the approval status.
     */
    public function approveRequest()
    {
        $userId = $this->input->get('userId');

        //  $id= $this->input->post($researcherId);
        date_default_timezone_set('US/Eastern');
        $date = date("m/d/Y");
        $this->load->model('usragr_model');
        //updating researcher information
        $result = $this->usragr_model->approveOrDisapprove_request($_POST['date'],3,$userId);

        if($result>0){
            $this->load->library('email');
            $config['protocol'] = "sendmail";
            $config['smtp_host'] = "tls://smtp.gmail.com";
            $config['smtp_port'] = "465";
            $config['smtp_user'] = "maristarchives@gmail.com";
            $config['smtp_pass'] = "redfoxesArchives";
            $config['charset'] = "utf-8";
            $config['mailtype'] = "html";
            $config['newline'] = "\r\n";
            $this->email->initialize($config);
            $this->email->from('maristarchives@gmail.com', ' Marist Archives');
            $this->email->to($_POST['emailId']);
            $this->email->cc('ann.sandri@marist.edu');
            //  $this->email->cc('another@another-example.com');
            //$this->email->bcc('them@their-example.com');
            $this->email->subject('Approved');
            $greeting        = "Dear ".$_POST['userName'];
            $six_digit_random_string =  $this -> generateRandomString();
            $UUID=$six_digit_random_string.$userId;
            $six_digit_random_string =  $this -> generateRandomString();
            $UUID = $UUID.$six_digit_random_string;
            $url = base_url()."?c=usragr&m=useagreement&userId=".$UUID ;
            $instructions = $_POST['instructions'];
            $message = '<html><body>';

            $message .= '<table width="100%"; rules="all" style="border:1px solid #3A5896;" cellpadding="10">';

            $message .= "<tr ><td align='center'><img src='https://s.graphiq.com/sites/default/files/10/media/images/Marist_College_2_220374.jpg'  /><h3> Marist Archives and Special Collection </h3> <br/><h3>COPY/USE AGREEMENT REQUEST</h3> ";

            $message .= "<br/><br/> <h4>$greeting ,<br/><br/> Your COPY/USEAGREEMENT Request has been appproved, we will send you the requested copies shortly</h4><br/> <I>Link:</I><br/><a href='$url'> $url </a>  </></tr>";

   //$message .= "<tr><td colspan=2 font='colr:#3A5896;'><I>Link:<br></I> $url </td></tr>";
            $message .= "<tr><td colspan=2 font='colr:#3A5896;'><I>Instructions:<br></I><h4>$instructions</h4></td></tr>";
            $message .= "</table>";

            $message .= "</body></html>";


            //$message        = "Dear ".$_POST['userName'].",";
            //$messageOne        = "Your COPY/USEAGREEMENT Request has been appproved, we will send you the requested copies shortly";
            $this->email->message($message);
            $this->email->send();
            echo $userId;

        }
    }
    public function saveChat(){
        date_default_timezone_set('US/Eastern');
        $date = date("m/d/Y");
        $time = time();
        $data = array(
            'instructions'   => $_POST['comments'],
            'instructions_added_date'    => $date,
            'instructions_added_time'  => $time,
            'userId' => $_POST['userId']
        );
        $this->load->model('usragr_model');
        $result = $this->usragr_model->saveChat($data, 'chat');
        if ($result > 0) {

        }
    }


    public function mailAttachment()
    {

        //$file_attached = false;
        $date = date("m/d/Y");

        $userId = $this->input->get('userId');
        $userId= substr($userId,6,-6);
        $user_name = filter_var($_POST["user_name"], FILTER_SANITIZE_STRING);
        $url = base_url()."?c=usragr&m=reviewRequest&userId=". $userId;
        $message = '<html><body>';

        $message .= '<table width="100%"; rules="all" style="border:1px solid #3A5896;" cellpadding="10">';

        $message .= "<tr ><td align='center'><img src='https://s.graphiq.com/sites/default/files/10/media/images/Marist_College_2_220374.jpg'  /><h3> Marist Archives and Special Collection </h3><h3>COPY/USE AGREEMENT REQUEST</h3> ";

        $message .= "<br/><br/> <h4>Hi,<br /><br />$user_name has submitted the new use agreement request. Please click on the below link to review and approve/disapprove the request</h4><br/> <I>Link:</I><br/> <a href='$url' >$url </a></></tr>";

        //$message .= "<tr><td colspan=2 font='colr:#3A5896;'><I>Link:<br></I> $url </td></tr>";
        //$message .= "<tr><td colspan=2 font='colr:#3A5896;'><I>Instructions:<br></I><h4>$instructions</h4></td></tr>";
        $message .= "</table>";

        $message .= "</body></html>";
       // $message = "<html><body>";
        //$messageOne = "$user_name.\".\n\r has submitted the new use agreement request. Please click on the below link to review and approve/disapprove the request";
        $messageTwo = "Please find the below link to review the submitted request";
        $message_body = $message ;
        $file_attached = false;
        if (isset($_FILES['file_attach'])) //check uploaded file
        {

            //get file details we need
            $file_tmp_name = $_FILES['file_attach']['tmp_name'];
            $file_name = $_FILES['file_attach']['name'];
            $file_error = $_FILES['file_attach']['error'];
            $file_size = $_FILES['file_attach']['size'];
            $file_type = $_FILES['file_attach']['type'];

            //exit script and output error if we encounter any
            if ($file_error > 0) {
                $mymsg = array(
                    1 => "The uploaded file exceeds the upload_max_filesize directive in php.ini",
                    2 => "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form",
                    3 => "The uploaded file was only partially uploaded",
                    4 => "No file was uploaded",
                    6 => "Missing a temporary folder");
                $output = json_encode(array('type' => 'error', 'text' => $mymsg[$file_error]));
                die($output);
            }

            $file_attached = true;
        }

        $ci = get_instance();
        $ci->load->library('email');
        $config['protocol'] = "sendmail";
        $config['smtp_host'] = "tls://smtp.gmail.com";
        $config['smtp_port'] = "465";
        $config['smtp_user'] = "maristarchives@gmail.com";
        $config['smtp_pass'] = "redfoxesArchives";
        $config['charset'] = "utf-8";
        $config['mailtype'] = "html";
        $config['newline'] = "\r\n";

        $ci->email->initialize($config);

        $ci->email->from('maristarchives@gmail.com', "Marist Archives");
       // $list = array('maristarchives@gmail.com');

        $ci->email->to('john.ansley@marist.edu');
		$ci->email->cc('maristarchives@gmail.com');
        $this->email->reply_to($_POST["user_email"], $user_name);
        $ci->email->message($message_body);

        //If the attached file in requested format
        if ($file_attached) {
            $ds= "/data/library/htdocs/archives/useagreement/";
            $this->load->model('usragr_model');
            $ci->email->subject($userId.'_Use Agreement Request(Attachment)');
              $storeFolder = 'uploads/';//2

                $targetPath =  $ds.$storeFolder ;  //4
                // $targetFile =  $targetPath. $_FILES['file_attach']['name'];  //5
                $file_info = pathinfo($_FILES['file_attach']['name']);
                  $six_digit_random_string = $this-> generateRandomString();
                $six_digit_random_string2 = $this-> generateRandomString();
                $filename = 'useagreement_request' . '_' .$six_digit_random_string2. $userId . $six_digit_random_string .'.' . $file_info['extension'];
                $targetFile =  $targetPath. $filename;
                // $result = $this->usragr_model->update_attachment($filename, $userId);
                $ci->email->attach($file_tmp_name, 'attachment', $filename);
                if($ci->email->send()){
                    $filepath= "http://library.marist.edu/archives/useagreement/uploads/$filename";
                    if($this->usragr_model->update_attachment($filename,$filepath, $userId)){
                        move_uploaded_file($file_tmp_name,$targetFile); //6
                    }
                }


            echo $file_type;
/*            if ($file_type == "application/pdf") {
                $result = $this->usragr_model->update_attachment('UseAgreement_Request_' . $userId . "(" . $date . ")" . '.pdf', $userId);
                if ($result > 0) {
                    $ci->email->attach($file_tmp_name, 'attachment', 'UseAgreement_Request_' . $userId . "(" . $date . ")" . '.pdf');
                    $ci->email->send();
                }
            } else if ($file_type == "image/jpeg") {
                $result = $this->usragr_model->update_attachment('UseAgreement_Request_' . $userId . "(" . $date . ")" . '.jpeg', $userId);
                if ($result > 0) {
                    $ci->email->attach($file_tmp_name, 'attachment', 'UseAgreement_Request_' . $userId . "(" . $date . ")" . '.jpeg');
                    $ci->email->send();
                }
            } else if ($file_type == "image/png") {
                $result = $this->usragr_model->update_attachment('UseAgreement_Request_' . $userId . "(" . $date . ")" . '.png', $userId);
                if ($result > 0) {
                    $ci->email->attach($file_tmp_name, 'attachment', 'UseAgreement_Request_' . $userId . "(" . $date . ")" . '.png');
                    $ci->email->send();
                }
            }
            else if($file_type == "application/msword"){

                $result = $this->usragr_model->update_attachment('UseAgreement_Request_' . $userId . "(" . $date . ")" . '.doc', $userId);
                if ($result > 0) {
                    $ci->email->attach($file_tmp_name, 'attachment', 'UseAgreement_Request_' . $userId . "(" . $date . ")" . '.doc');
                    $ci->email->send();
                }

            } else if($file_type == "application/vnd.openxmlformats-officedocument.wordprocessingml.document"){

                $result = $this->usragr_model->update_attachment('UseAgreement_Request_' . $userId . "(" . $date . ")" . '.docx', $userId);
                if ($result > 0) {
                    $ci->email->attach($file_tmp_name, 'attachment', 'UseAgreement_Request_' . $userId . "(" . $date . ")" . '.docx');
                    $ci->email->send();
                }

            }
            else{
                $result = $this->usragr_model->update_attachment('UseAgreement_Request_' . $userId . "(" . $date . ")", $userId);
                if ($result > 0) {
                    $ci->email->attach($file_tmp_name, 'attachment', 'UseAgreement_Request_' . $userId . "(" . $date . ")");
                    $ci->email->send();
                }

            }*/

        } // Mail without attachment
        else {
            $ci->email->subject($userId.'_Use Agreement Request');
            $ci->email->send();

        }
    }

    public function InitiateWithMailAttachment()
    {

        //$file_attached = false;
        $date = date("m/d/Y");
        $userId = $this->input->get('userId');
        $userId = (string)$userId;
        $six_digit_random_number = mt_rand(100000, 999999);
        $six_digit_random_string =  $this -> generateRandomString();
        $UUID=$six_digit_random_string.$userId;
        $six_digit_random_string =  $this -> generateRandomString();
        $UUID = $UUID.$six_digit_random_string;
        echo $UUID;
        $comments = $_POST['comments'];
        $user_name = filter_var($_POST['user_name'], FILTER_SANITIZE_STRING);
        $url = base_url()."?c=usragr&m=useagreement&userId=". $UUID;
        $message = '<html><body>';

        $message .= '<table width="100%"; rules="all" style="border:1px solid #3A5896;" cellpadding="10">';

        $message .= "<tr ><td align='center'><img src='https://s.graphiq.com/sites/default/files/10/media/images/Marist_College_2_220374.jpg'  /><h3> Marist Archives and Special Collection </h3><h3>COPY/USE AGREEMENT REQUEST</h3> ";

        $message .= "<br/><br/> <h4> Dear $user_name ,<br /><br />We have initiated use agreement form for you. Please click on the below link to edit and submit the request.</h4><br/> <I>Link:</I><br/><a href='$url'> $url </a></></tr>";

//$message .= "<tr><td colspan=2 font='colr:#3A5896;'><I>Link:<br></I> $url </td></tr>";
        $message .= "<tr><td colspan=2 font='colr:#3A5896;'><I>Comments/Instructions:<br></I><h4>$comments</h4></td></tr>";
        $message .= "</table>";

        $message .= "</body></html>";
        // $message = "<html><body>";
        //$messageOne = "$user_name.\".\n\r has submitted the new use agreement request. Please click on the below link to review and approve/disapprove the request";
        $messageTwo = "Please find the below link to review the submitted request";
        $message_body = $message ;
        $file_attached = false;
        if (isset($_FILES['file_attach'])) //check uploaded file
        {

            //get file details we need
            $file_tmp_name = $_FILES['file_attach']['tmp_name'];
            $file_name = $_FILES['file_attach']['name'];
            $file_error = $_FILES['file_attach']['error'];
            $file_size = $_FILES['file_attach']['size'];
            $file_type = $_FILES['file_attach']['type'];

            //exit script and output error if we encounter any
            if ($file_error > 0) {
                $mymsg = array(
                    1 => "The uploaded file exceeds the upload_max_filesize directive in php.ini",
                    2 => "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form",
                    3 => "The uploaded file was only partially uploaded",
                    4 => "No file was uploaded",
                    6 => "Missing a temporary folder");
                $output = json_encode(array('type' => 'error', 'text' => $mymsg[$file_error]));
                die($output);
            }

            $file_attached = true;
        }

        $ci = get_instance();
        $ci->load->library('email');
        $config['protocol'] = "sendmail";
        $config['smtp_host'] = "tls://smtp.gmail.com";
        $config['smtp_port'] = "465";
        $config['smtp_user'] = "maristarchives@gmail.com";
        $config['smtp_pass'] = "redfoxesArchives";
        $config['charset'] = "utf-8";
        $config['mailtype'] = "html";
        $config['newline'] = "\r\n";

        $ci->email->initialize($config);

        $ci->email->from('maristarchives@gmail.com', "Marist Archives");
        //$ci->email->cc('dheeraj.karnati1@marist.edu');
        $ci->email->to($_POST['user_email']);
        $ci->email->reply_to('maristarchives@gmail.com', "Marist Archives");
        $ci->email->message($message_body);
        //If the attached file in requested format
        if ($file_attached) {

            $this->load->model('usragr_model');
        //    $this->email->subject('UseAgreement Initiated');

            $ci->email->subject("UseAgreement Initiated");


            $ds= "/data/library/htdocs/archives/useagreement/";

            $storeFolder = 'uploads/';//2
            if (!empty($_FILES)) {

                $targetPath =  $ds.$storeFolder ;  //4
                // $targetFile =  $targetPath. $_FILES['file_attach']['name'];  //5
                $file_info = pathinfo($_FILES['file_attach']['name']);
                $six_digit_random_number = mt_rand(100000, 999999);
                $filename = 'useagreement_request' . '_' . $userId. $six_digit_random_number .'.' . $file_info['extension'];
                $targetFile =  $targetPath. $filename;
                // $result = $this->usragr_model->update_attachment($filename, $userId);
                $ci->email->attach($file_tmp_name, 'attachment', $filename);
                if($ci->email->send()){
                    $filepath= "http://library.marist.edu/archives/useagreement/uploads/$filename";
                    if($this->usragr_model->update_attachment($filename,$filepath, $userId)){
                        move_uploaded_file($file_tmp_name,$targetFile); //6
                    }
                }

            }

        }
        // Mail without attachment
        else {
            $ci->email->subject("UseAgreement Initiated");
            $ci->email->send();

        }
    }

  function generateRandomString($length = 6) {
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHI0123456789JKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
/*
 * Verifies admin passcode input with passcode saved in db
 *
 */
    public function admin_verify(){
        $apasscode = $this->input->get('pass');
        $this->load->model('usragr_model');
        $passcode = $this->usragr_model -> getPasscode(1);
        if($passcode == $apasscode){

          $authorized =1;

         }else{

          $authorized=0;
        }
          echo $authorized;
    }


    public function admin(){
      if (isset($_SESSION['LAST_SESSION']) && (time() - $_SESSION['LAST_SESSION'] > 900)) {
					 if(!isset($_SESSION['CAS'])) {
							 $_SESSION['CAS'] = false; // set the CAS session to false
					 }
			 }
		$authenticated = $_SESSION['CAS'];
		$_SESSION['id'] = session_id();
			 //URL accessable when the authentication works
	  //$casurl = "http%3A%2F%2Flocalhost%2Frepository%2F%3Fc%3Dauth%26m%3DdbAuth";
	  //$casurl = "http://localhost/redfoxes/Discussion/createDiscussion_view";
		//$casurl = "http%3A%2F%2Fdev.library.marist.edu%2Fredfoxes%2F%3Fc%3DDiscussion%26m%3DcreateDiscussion_view"; //-uncomment for dev
		$casurl = "http%3A%2F%2Flocalhost%2Fuseagreement%2F%3Fc%3Dusragr%26m%3Dadmin";
		if (!$authenticated) {
					 $_SESSION['LAST_SESSION'] = time(); // update last activity time stamp
					 $_SESSION['CAS'] = true;
					 echo '<META HTTP-EQUIV="Refresh" Content="0; URL=https://login.marist.edu/cas/?service='.$casurl.'">';
					 exit;
				 }
		if ($authenticated) {
		 //$this->session->set_userdata('ad', true); // this needs to be set when the user access is accepted by CAS
		 if (isset($_GET["ticket"])) {
			 //set up validation URL to ask CAS if ticket is good
			 $_url = "https://login.marist.edu/cas/validate";
			 //  $serviceurl = "http://localhost:9090/repository-2.0/?c=repository&m=cas_admin";
			 // $cassvc = 'IU'; //search kb.indiana.edu for "cas application code" to determine code to use here in place of "appCode"
			 $params = "ticket=$_GET[ticket]&service=$casurl";
			 $urlNew = "$_url?$params";
			// $urlNew = "$_url";

			 //CAS sending response on 2 lines. First line contains "yes" or "no". If "yes", second line contains username (otherwise, it is empty).
			 $ch = curl_init();
			 $timeout = 5; // set to zero for no timeout
			 curl_setopt ($ch, CURLOPT_URL, $urlNew);
			 curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
			 ob_start();
			 curl_exec($ch);
			 curl_close($ch);
			 $cas_answer = ob_get_contents();
			 ob_end_clean();

			 //split CAS answer into access and user
			 list($access,$user) = preg_split("/\n/",$cas_answer,2);
			 $access = trim($access);
			 $user = trim($user);


       /*$emptype = trim($emptype);
			 $udc_id = trim($udc_id);
       $cn = trim($cn);
       $email = trim($email);
       $id = trim($id);*/
			 //set user and session variable if CAS says YES
			 if ($access == "yes") {
        /* $unameurl = "http://ldap.geminiodyssey.org/login-test/casattributes.php";
         //getting userName
         $chuname = curl_init();
  			 $timeout = 5; // set to zero for no timeout
  			 curl_setopt ($chuname, CURLOPT_URL, $unameurl);
  			 curl_setopt ($chuname, CURLOPT_CONNECTTIMEOUT, $timeout);
  			 ob_start();
  			 curl_exec($chuname);
  			 curl_close($chuname);
  			 $user_info = ob_get_contents();
  			 ob_end_clean();

  			 //split CAS answer into access and user
  			 $array = preg_split("/<li>/",$user_info,-1,PREG_SPLIT_DELIM_CAPTURE);
         var_dump($array);*/
					 $user= str_replace('@marist.edu','',$user);
					// $_SESSION['user'] = $cn;
					 $_SESSION['access'] = $access;
					 $_SESSION['cas_answer'] = $cas_answer;
					 //$data['cwid'] = $_SESSION['user'];
					 //$data['uname'] = $_GET['username'];
					 $data['cas_answer'] = $_SESSION['cas_answer'];
           $this->load->model('usragr_model');
           $query = $this->usragr_model->allRequests($this->limit);
           $total_rows = $this->usragr_model->count();
           $this->load->helper('app');
           $pagination_links = pagination($total_rows, $this->limit);
           $this->load->view('admin', compact('query', 'pagination_links','total_rows'));
           //add cas auth here very very carefully

					 } else {
						 echo "<h1>UnAuthorized Access</h1>";
					 }
				 }//END SESSION user
				 else{
					 echo '<META HTTP-EQUIV="Refresh" Content="0; URL=https://login.marist.edu/cas?service='.$casurl.'">';
				 }
			 } else  {
				 echo '<META HTTP-EQUIV="Refresh" Content="0; URL=https://login.marist.edu/cas?service='.$casurl.'">';
			 }

    }

    public function adminbackup(){

        $this->load->model('usragr_model');
        $query = $this->usragr_model->allRequests($this->limit);

        $total_rows = $this->usragr_model->count();
        $this->load->helper('app');
        $pagination_links = pagination($total_rows, $this->limit);
        //add cas auth here very very carefully
        $this->load->view('admin_view', compact('query', 'pagination_links','total_rows'));
    }

    public function pages(){

        $this->load->model('usragr_model');
        $query = $this->usragr_model->allRequests($this->limit);
        $total_rows = $this->usragr_model->count();
        $this->load->helper('app');
        $pagination_links = pagination($total_rows, $this->limit);
        $this->load->view('page_view', compact('query', 'pagination_links','total_rows'));

    }
    public function useAgreementRequests(){
        $status = $this ->input -> get('status');
        if($status != null) {
            $url = base_url("?c=usragr&m=useAgreementRequests&status=$status");
        }
        else{
            $url = null;
        }
        $this->load->model('usragr_model');
        $query = $this->usragr_model ->RequestsWithStatus($this->limit,$status);
        $total_rows = $this->usragr_model->countWithStatus($status);
        $this->load->helper('status');
        $pagination_links = pagination($total_rows, $this->limit,$url);
        $this->load->view('page_view', compact('query', 'pagination_links','total_rows'));
    }
    public function getRequests(){
        //$apasscode= $this-> input-> get('pass');
        $this->load->model('usragr_model');
        //$passcode = $this->usragr_model -> getPasscode(1);
        //if($passcode == $apasscode){
        $this->load->model('usragr_model');
        $query = $this->usragr_model->allRequests($this->limit);
        $total_rows = $this->usragr_model->count();
        $this->load->helper('app');
        $pagination_links = pagination($total_rows, $this->limit);
        $this->load->view('admin', compact('query', 'pagination_links','total_rows'));

      /*  } else{
            echo "<h1 align='center' style=\"color:#B31B1B;\" >401 - Unauthorized access</h1>";


        }*/
    }

//used this method before CAS login setup
    public function getRequestsbackup(){
        $apasscode= $this-> input-> get('pass');
        $this->load->model('usragr_model');
        $passcode = $this->usragr_model -> getPasscode(1);
        if($passcode == $apasscode){
        $this->load->model('usragr_model');
        $query = $this->usragr_model->allRequests($this->limit);
        $total_rows = $this->usragr_model->count();
        $this->load->helper('app');
        $pagination_links = pagination($total_rows, $this->limit);
        $this->load->view('admin', compact('query', 'pagination_links','total_rows'));

        } else{
            echo "<h1 align='center' style=\"color:#B31B1B;\" >401 - Unauthorized access</h1>";


        }
    }

/*    public function uploadFile(){
      //  $ds          = DIRECTORY_SEPARATOR;
        $ds= "/data/library/htdocs";  //1
        $storeFolder = 'uploads';   //2
        if (!empty($_FILES)) {

            $tempFile = $_FILES['file']['tmp_name'];          //3

            $targetPath = dirname( __FILE__ ) . $ds. $storeFolder . $ds;  //4

            $targetFile =  $targetPath. $_FILES['file']['name'];  //5

            move_uploaded_file($tempFile,$targetFile); //6

        }

    }*/
    public function update_status(){
        $userId=$this->input->get('userId');
        $status = $this->input->get('status');
      //  $files = array();
        if($this ->input -> get('files')) {
            $files = $this->input->get('files');
            $this->load->model('usragr_model');
            $response = $this->usragr_model->updateStatus($status,$userId,$files);
        }else{
            $files= "";
            $this->load->model('usragr_model');
            $response = $this->usragr_model->updateStatus($status,$userId,$files);

        }
        echo $response;

    }

 public function completetransaction()
 {

     $comment = $_POST["message"];
     $userName = $_POST['user_name'];
     $emailId = $_POST['user_email'];
     $userId = $this->input->get('userId');
     $status = 4;
     $files = "";
     $this->load->model('usragr_model');
     $response = $this->usragr_model->updateStatus($status, $userId, $files);
     if ($response == 1){
         $message = '<html><body>';

     $message .= '<table width="100%"; rules="all" style="border:1px solid #3A5896;" cellpadding="10">';

     $message .= "<tr ><td align='center'><img src='https://s.graphiq.com/sites/default/files/10/media/images/Marist_College_2_220374.jpg'  /><h3> Marist Archives and Special Collection </h3><h3>COPY/USE AGREEMENT REQUEST</h3> ";

     $message .= "<br/><br/> <h4> Dear $userName ,<br /><br />We have sent you the requested copies through Marist Dropbox. Please verify them and let us know in case of any issues.</h4></tr>";

//$message .= "<tr><td colspan=2 font='colr:#3A5896;'><I>Link:<br></I> $url </td></tr>";
     /*         $filestring = "";
             $i=0;
             for ($i=0;$i<sizeof($files);$i++){
                 $message.= "<tr><td><I>Link: </I><a href='$files[$i]'> $files[$i]</a> </td></tr>";
                 $filestring =$filestring.$files[$i];
                 if($i<(sizeof($files)-1)){
                     $filestring= $filestring.'||';
                 }
             }*/
     /*        foreach($files as $file){
                 $message.= "<tr><td><I>Link:</I></br>$file </td></tr>";
                 $filestring =$filestring.$file;
                 $filestring= $filestring.'||';
             }*/

     $message .= "<tr><td colspan=2 font='colr:#3A5896;'><I>Comments/Instructions:<br></I><h4>$comment</h4></td></tr>";
     $message .= "</table>";

     $message .= "</body></html>";
     // }
     $message_body = $message;
     $ci = get_instance();
     $ci->load->library('email');
     $config['protocol'] = "sendmail";
     $config['smtp_host'] = "tls://smtp.gmail.com";
     $config['smtp_port'] = "465";
     $config['smtp_user'] = "maristarchives@gmail.com";
     $config['smtp_pass'] = "redfoxesArchives";
     $config['charset'] = "utf-8";
     $config['mailtype'] = "html";
     $config['newline'] = "\r\n";

     $ci->email->initialize($config);

     $ci->email->from('maristarchives@gmail.com', "Marist Archives");
    // $ci->email->cc('dheeraj.karnati1@marist.edu');
     $ci->email->to($emailId);
     $ci->email->reply_to('maristarchives@gmail.com', "Marist Archives");
     $ci->email->message($message_body);
     $ci->email->subject("UseAgreement Request Copies Available");
     if ($ci->email->send()) {

         echo 1;
     }

 }
 }
}

?>
