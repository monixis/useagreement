<?phpclass usragr extends CI_Controller{    public function index()    {        $this->load->model('usragr_model');        $data['title'] = "COPY REQUEST/USE AGREEMENT FORM";        $date = date_default_timezone_set('US/Eastern');        $this->load->view('initiateUseAgreement', $data);    }    /*     *Function to create new researcher.     *     */    public function insertNewResearcher()    {        date_default_timezone_set('US/Eastern');        $date = date("m/d/Y");        $data = array(            'userName'   => $_POST['userName'],            'emailId'    => $_POST['emailId'],            'citystate'  => $_POST['citystate'],            'address'    => $_POST['address'],            'zipCode'    => $_POST['zipCode'],            'date'       => $_POST['date'],            'phoneNumber'=> $_POST['phoneNumber'],            'emailSubject' =>$_POST['emailSubject'],            'receiver'=> $_POST['receivedBy'],            'requestAddedBy' => $_POST['requestAddedBy'],            'status'     => 0        );        $this->load->model('usragr_model');        $result = $this->usragr_model->insert_researcher($data, 'researcher');        if($_POST['comments']>0 ||$_POST['comments']!= null) {            $data = array(                'comment' => $_POST['comments'],                'commentType' => "INSTRUCTIONS",                'userId' => $result            );            $this->load->model('usragr_model');            $chat_result = $this->usragr_model->saveChat($data, 'chat');            if ($chat_result > 0) {            }            }        if ($result > 0) {            $userId = $result; // As the result from model returns maximum value of research table            $requestCount = $_POST['requestCount'];            //check if there is any requests            if ($requestCount != 0) {                $requestList = array($_POST['requestList']);                //processiong array of requests                foreach ($requestList as $request) {                    foreach ($request as $row) {                        //data of request row                        $data = array(                            'collection'      => $row[0],                            'boxNumber'       => $row[1],                            'itemNumber'      => $row[2],                            'imageResolution' => $row[3],                            'fileFormat'      => $row[4],                            'audOrVidFileFormat' => $row[5],                            'usageDescription' => $row[6],                            'userId'          => $userId                        );                        //insert the request                        $response = $this->usragr_model->insertUserRequest($data, 'request');                        if ($response > 0) {                        }else{                            return 0;                        }                    }}// end of processing requests            }        }        $user = $_POST['userName'];        $comments = $_POST['comments'];        $url = base_url(). "?c=usragr&m=useagreement&userId=" . $userId;        $this->load->library('email');         $config['protocol'] = "smtp";         $config['smtp_host'] = "tls://smtp.gmail.com";         $config['smtp_port'] = "465";         $config['smtp_user'] = "maristarchives@gmail.com";         $config['smtp_pass'] = "20MaristArchives15";         $config['charset'] = "utf-8";         $config['mailtype'] = "html";         $config['newline'] = "\r\n";         $this->email->initialize($config);        $this->email->from('maristarchives@gmail.com', ' Marist Archives');        $this->email->to($_POST['emailId']);        $this->email->cc('dheeraj.karnati1@marist.edu');        $this->email->subject('UseAgreement Initiated');        //  $message        = "Dear ".$_POST['userName'].",";        // $messageOne        = "We have initiated use agreement form for you. Please click on the below link to edit and submit the request";        // $messageBody = $message ."\r\n" . $messageOne ."\n" . base_url(). "?c=usragr&m=useagreement&userId=" . $userId;        $message = '<html><body>';        $message .= '<table width="100%"; rules="all" style="border:1px solid #3A5896;" cellpadding="10">';        $message .= "<tr ><td align='center'><img src='https://s.graphiq.com/sites/default/files/10/media/images/Marist_College_2_220374.jpg'  /><h3> Marist Archives and Special Collection </h3><h3>COPY/USE AGREEMENT REQUEST</h3> ";        $message .= "<br/><br/> <h4> Dear $user ,<br /><br />We have initiated use agreement form for you. Please click on the below link to edit and submit the request.</h4><br/> <I>Link:</I><br/> $url </></tr>";//$message .= "<tr><td colspan=2 font='colr:#3A5896;'><I>Link:<br></I> $url </td></tr>";        $message .= "<tr><td colspan=2 font='colr:#3A5896;'><I>Comments/Instructions:<br></I><h4>$comments</h4></td></tr>";        $message .= "</table>";        $message .= "</body></html>";        $this->email->message($message);        if(  $this->email->send()){            echo $result;        }else{            $rollback = $this->usragr_model->deleteUser($result);            echo $rollback;        }    }    /*     * function to fetch the researcher with userId.     * loads useAgreement view form     */    public function useagreement()    {        /*WORKING*/        $this->load->model('usragr_model');        $userId = $this->input->get('userId');        $result = $this->usragr_model->getresearcher($userId);        $chat_array =  $this->usragr_model -> getChat($userId);        if($chat_array>0) {            $chat_list = json_decode(json_encode($chat_array), true);            //   print_r($chat_list);            $data['chatList'] = $chat_list;            }        if($result!=null) {            //  $rscrAndReqInfo= array();            $researcher = array();            // foreach($result as $row){            //   echo sizeof($row);            $info = json_decode(json_encode($result), true);            foreach ($info as $row) {                //  $data['userName'] =                $request = array();                if (sizeof($researcher) == 0) {                    array_push($researcher, $row['userName'], $row['citystate'],                        $row['address'], $row['emailId'], $row['zipCode'],                         $row['date'], $row['phoneNumber'], $row['status'], $row['attachment'], $row['userInitials'], $row['termsAndCond'], $row['requestAddedBy']);                    $data['researcher'] = $researcher;                }                if ($row['requestId'] != null) {                    $request[] = $row['requestId'];                    $request[] = $row['collection'];                    $request[] = $row['boxNumber'];                    $request[] = $row['itemNumber'];                    $request[] = $row['usageDescription'];                    $request[] = explode(':', $row['imageResolution']);                    $request[] = explode(':', $row['fileFormat']);                    $request[] = explode(':', $row['audOrVidFileFormat']);                    //  print_r($request);                    $requests[] = $request;                    $data['requests'] = $requests;                }else{                    $data['requests'] = null;                }            }            $this->load->view('useAgreement', $data);        }else{            echo '<html>', "\n"; // I'm sure there's a better way!            echo '<head>', "\n";            echo '</head>', "\n";            echo '<body>', "\n";            echo '<h1 align="center">404: User Not Found</h1>', "\n";            echo '</body>', "\n";            echo '</html>', "\n";        }    }    /*     * function to fetch the researcher with userId     * loads reviewUseAgreement view form     */    public function reviewRequest()    {        /*WORKING*/        $this->load->model('usragr_model');        $userId = $this->input->get('userId');        $result = $this->usragr_model->getresearcher($userId);        $chat_array =  $this->usragr_model -> getChat($userId);        if($chat_array>0) {            $chat_list = json_decode(json_encode($chat_array), true);            //   print_r($chat_list);            $data['chatList'] = $chat_list;        }        if ($result != null) {            //  $rscrAndReqInfo= array();            $researcher = array();            // foreach($result as $row){            //   echo sizeof($row);            $info = json_decode(json_encode($result), true);            foreach ($info as $row) {                //  $data['userName'] =                $request = array();                if (sizeof($researcher) == 0) {                    array_push($researcher, $row['userName'], $row['citystate'],                        $row['address'], $row['emailId'], $row['zipCode'],                        $row['date'], $row['phoneNumber'], $row['status'],$row['attachment'], $row['userInitials'], $row['termsAndCond'], $row['emailSubject'], $row['receiver'], $row['requestAddedBy']);                    $data['researcher'] = $researcher;                }                if ($row['requestId'] != null) {                    $request[] = $row['requestId'];                    $request[] = $row['collection'];                    $request[] = $row['boxNumber'];                    $request[] = $row['itemNumber'];                    $request[] = $row['usageDescription'];                    $request[] = explode(':', $row['imageResolution']);                    $request[] = explode(':', $row['fileFormat']);                    $request[] = explode(':', $row['audOrVidFileFormat']);                    //  print_r($request);                    $requests[] = $request;                    $data['requests'] = $requests;                }                else {                    $data['requests'] = null;                }            }            //print_r($data);            //  print_r(sizeof($rscrAndReqInfo));            $this->load->view('reviewUseAgreement', $data);        }else{            echo "please provide valid userId";        }    }    /*     * Function to save/update researcher.     * to update the existing researcher and request.     */    public function saveResearcher()    {        $userId = $this->input->get('userId');        //  $id= $this->input->post($researcherId);        date_default_timezone_set('US/Eastern');        $date = date("m/d/Y");        $this->load->model('usragr_model');        //updating researcher information        $result = $this->usragr_model->update_researcher($_POST['userName'], $_POST['citystate'], $_POST['address'], $_POST['emailId'],            $_POST['zipCode'], $_POST['date'], $_POST['phoneNumber'], $_POST['userInitials'],$_POST['termsAndConditions'],$userId);        if($result>0) {   //Deleting existing requests            $result = $this->usragr_model->deleteRequests($userId);        }        //echo $result;        if ($result > 0) { //Inserting New Requests            // $userId = $result; // As the result from model returns maximum value of research table            $requestCount = $_POST['requestCount'];            //check if there is any requests            if ($requestCount != 0) {                $requestList = array($_POST['requestList']);                //processiong array of requests                foreach ($requestList as $request) {                    foreach ($request as $row) {                        $usageDesc = $str = str_replace("\n", '',$row[6] );                        //data of request row                        $data = array(                            'collection'         => $row[0],                            'boxNumber'          => $row[1],                            'itemNumber'         => $row[2],                            'imageResolution'    => $row[3],                            'fileFormat'         => $row[4],                            'audOrVidFileFormat' => $row[5],                            'usageDescription' =>$usageDesc,                            'userId'             => $userId                        );                        //insert the request                        $result = $this->usragr_model->insertUserRequest($data, 'request');                    }                }// end of processing requests            }            echo $userId;        }    }    /*     * Function to submit/update researcher.     * Function update researcher and request details.     * Updates the status of the transaction to 2.That indicates that user submitted the form for approval.     * Trigger email to librarian with URL to review the request.     */    public function submitResearcher()    {        $userId = $this->input->get('userId');        //  $id= $this->input->post($researcherId);        date_default_timezone_set('US/Eastern');        $date = date("m/d/Y");        $this->load->model('usragr_model');        if($_POST['message']>0 ||$_POST['message']!= null) {                $data = array(                    'comment' => $_POST['message'],                    'commentType' => "MESSAGE",                    'userId' => $userId                );                $this->load->model('usragr_model');                $chat_result = $this->usragr_model->saveChat($data, 'chat');                if ($chat_result > 0) {                }        }        //updating researcher information            $result = $this->usragr_model->update_researcherWithStatus($_POST['userName'], $_POST['citystate'], $_POST['address'], $_POST['emailId'],                $_POST['zipCode'], $_POST['date'], $_POST['phoneNumber'], 2, $_POST['userInitials'], $_POST['termsAndConditions'], $userId);        if($result>0) {   //Deleting existing requests            $result = $this->usragr_model->deleteRequests($userId);        }        //echo $result;        if ($result > 0) { //Inserting New Requests            // $userId = $result; // As the result from model returns maximum value of research table            $requestCount = $_POST['requestCount'];            //check if there is any requests            if ($requestCount != 0) {                $requestList = array($_POST['requestList']);                //processiong array of requests                foreach ($requestList as $request) {                    foreach ($request as $row) {                        //data of request row                        $data = array(                            'collection'         => $row[0],                            'boxNumber'          => $row[1],                            'itemNumber'         => $row[2],                            'imageResolution'    => $row[3],                            'fileFormat'         => $row[4],                            'audOrVidFileFormat' => $row[5],                            'usageDescription' =>$row[6],                            'userId'             => $userId                        );                        //insert the request                        $result = $this->usragr_model->insertUserRequest($data, 'request');                    }}// end of processing requests            }            if($result>0){                echo $userId;            }        }    }    /*     * Function to disapprove request.     * Change the transactions status to 1. That enables the user to edit and resubmit the request.     * Adds Instructions to the user.     */    public function disapproveRequest()    {        $userId = $this->input->get('userId');        //  $id= $this->input->post($researcherId);        date_default_timezone_set('US/Eastern');        $date = date("m/d/Y");        $this->load->model('usragr_model');        //updating researcher information        $result = $this->usragr_model->approveOrDisapprove_request($_POST['date'],1,$userId);        //Deleting existing requests        //echo $result;        if( $_POST['instructions'] != null){            $data = array(                'comment' => $_POST['instructions'],                'commentType' => "INSTRUCTIONS",                'userId' => $userId            );            $this->load->model('usragr_model');            $chat_result = $this->usragr_model->saveChat($data, 'chat');            if ($chat_result > 0) {                echo "success";            }        }        if($result){            $this->load->library('email');            $config['protocol'] = "smtp";            $config['smtp_host'] = "tls://smtp.gmail.com";            $config['smtp_port'] = "465";            $config['smtp_user'] = "maristarchives@gmail.com";            $config['smtp_pass'] = "20MaristArchives15";            $config['charset'] = "utf-8";            $config['mailtype'] = "html";            $config['newline'] = "\r\n";            $this->email->initialize($config);            $this->email->from('maristarchives@gmail.com', ' Marist Archives');            $this->email->to($_POST['emailId']);            $this->email->cc('dheeraj.karnati1@marist.edu');            //  $this->email->cc('another@another-example.com');            //$this->email->bcc('them@their-example.com');            $this->email->subject('Disapproved');            $greeting        = "Dear ".$_POST['userName'];            $messageOne     = "We have disapproved your use agreement request.As we found some errors in the form. Please click on the below link to resubmit the form (Please follow the instructions provided in the bottom of the form) ";            $url = base_url()."?c=usragr&m=useagreement&userId=".$userId ;            $instructions = $_POST['instructions'];            $message = '<html><body>';            $message .= '<table width="100%"; rules="all" style="border:1px solid #3A5896;" cellpadding="10">';            $message .= "<tr ><td align='center'><img src='https://s.graphiq.com/sites/default/files/10/media/images/Marist_College_2_220374.jpg'  /><h3> Marist Archives and Special Collection </h3><h3>COPY/USE AGREEMENT REQUEST</h3> ";            $message .= "<br/><br/> <h4>$greeting ,<br /><br />We have disapproved your use agreement request.As we found some errors in the form. Please click on the below link to resubmit the form (Please follow the instructions provided in the bottom of the form)</h4><br/> <I>Link:</I><br/> $url </></tr>";            //$message .= "<tr><td colspan=2 font='colr:#3A5896;'><I>Link:<br></I> $url </td></tr>";            $message .= "<tr><td colspan=2 font='colr:#3A5896;'><I>Instructions:<br></I><h4>$instructions</h4></td></tr>";            $message .= "</table>";            $message .= "</body></html>";            $this->email->message($message);            if(  $this->email->send()){                echo $userId;            }else{                echo "failed to send email";            }        }    }    /*     *Function to approve request.     *Trigger email to user about the approval status.     */    public function approveRequest()    {        $userId = $this->input->get('userId');        //  $id= $this->input->post($researcherId);        date_default_timezone_set('US/Eastern');        $date = date("m/d/Y");        $this->load->model('usragr_model');        //updating researcher information        $result = $this->usragr_model->approveOrDisapprove_request($_POST['date'],3,$userId);        if($result>0){            $this->load->library('email');            $config['protocol'] = "smtp";            $config['smtp_host'] = "tls://smtp.gmail.com";            $config['smtp_port'] = "465";            $config['smtp_user'] = "maristarchives@gmail.com";            $config['smtp_pass'] = "20MaristArchives15";            $config['charset'] = "utf-8";            $config['mailtype'] = "html";            $config['newline'] = "\r\n";            $this->email->initialize($config);            $this->email->from('maristarchives@gmail.com', ' Mairst Archives');            $this->email->to($_POST['emailId']);            $this->email->cc('dheeraj.karnati1@marist.edu');            //  $this->email->cc('another@another-example.com');            //$this->email->bcc('them@their-example.com');            $this->email->subject('Approved');            $greeting        = "Dear ".$_POST['userName'];            $url = base_url()."?c=usragr&m=useagreement&userId=".$userId ;            $instructions = $_POST['instructions'];            $message = '<html><body>';            $message .= '<table width="100%"; rules="all" style="border:1px solid #3A5896;" cellpadding="10">';            $message .= "<tr ><td align='center'><img src='https://s.graphiq.com/sites/default/files/10/media/images/Marist_College_2_220374.jpg'  /><h3> Marist Archives and Special Collection </h3> <br/><h3>COPY/USE AGREEMENT REQUEST</h3> ";            $message .= "<br/><br/> <h4>$greeting ,<br/><br/> Your COPY/USEAGREEMENT Request has been appproved, we will send you the requested copies shortly</h4><br/> <I>Link:</I><br/> $url </></tr>";//$message .= "<tr><td colspan=2 font='colr:#3A5896;'><I>Link:<br></I> $url </td></tr>";            $message .= "<tr><td colspan=2 font='colr:#3A5896;'><I>Instructions:<br></I><h4>$instructions</h4></td></tr>";            $message .= "</table>";            $message .= "</body></html>";            //$message        = "Dear ".$_POST['userName'].",";            //$messageOne        = "Your COPY/USEAGREEMENT Request has been appproved, we will send you the requested copies shortly";            $this->email->message($message);            $this->email->send();            echo $userId;        }    }    /*public function saveChat(){        date_default_timezone_set('US/Eastern');        $date = date("m/d/Y");        $time = time();        $data = array(            'instructions'   => $_POST['comments'],            'instructions_added_date'    => $date,            'instructions_added_time'  => $time,            'userId' => $_POST['userId']        );        $this->load->model('usragr_model');        $result = $this->usragr_model->saveChat($data, 'chat');        if ($result > 0) {        }    }*/    public function mailAttachment()    {        //$file_attached = false;        $date = date("m/d/Y");        $userId = $this->input->get('userId');        $user_name = filter_var($_POST["user_name"], FILTER_SANITIZE_STRING);        $url = base_url()."?c=usragr&m=reviewRequest&userId=". $userId;        $message = '<html><body>';        $message .= '<table width="100%"; rules="all" style="border:1px solid #3A5896;" cellpadding="10">';        $message .= "<tr ><td align='center'><h3> Marist Archives and Special Collection </h3><h3>COPY/USE AGREEMENT REQUEST</h3> ";        $message .= "<br/><br/> <h4>Hi,<br /><br />$user_name has submitted the new use agreement request. Please click on the below link to review and approve/disapprove the request</h4><br/> <I>Link:</I><br/> $url </></tr>";        //$message .= "<tr><td colspan=2 font='colr:#3A5896;'><I>Link:<br></I> $url </td></tr>";        //$message .= "<tr><td colspan=2 font='colr:#3A5896;'><I>Instructions:<br></I><h4>$instructions</h4></td></tr>";        $message .= "</table>";        $message .= "</body></html>";       // $message = "<html><body>";        //$messageOne = "$user_name.\".\n\r has submitted the new use agreement request. Please click on the below link to review and approve/disapprove the request";        $messageTwo = "Please find the below link to review the submitted request";        $message_body = $message ;        $file_attached = false;        if (isset($_FILES['file_attach'])) //check uploaded file        {            //get file details we need            $file_tmp_name = $_FILES['file_attach']['tmp_name'];            $file_name = $_FILES['file_attach']['name'];            $file_error = $_FILES['file_attach']['error'];            $file_size = $_FILES['file_attach']['size'];            $file_type = $_FILES['file_attach']['type'];            //exit script and output error if we encounter any            if ($file_error > 0) {                $mymsg = array(                    1 => "The uploaded file exceeds the upload_max_filesize directive in php.ini",                    2 => "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form",                    3 => "The uploaded file was only partially uploaded",                    4 => "No file was uploaded",                    6 => "Missing a temporary folder");                $output = json_encode(array('type' => 'error', 'text' => $mymsg[$file_error]));                die($output);            }            $file_attached = true;        }        $ci = get_instance();        $ci->load->library('email');        $config['protocol'] = "smtp";        $config['smtp_host'] = "tls://smtp.gmail.com";        $config['smtp_port'] = "465";        $config['smtp_user'] = "maristarchives@gmail.com";        $config['smtp_pass'] = "20MaristArchives15";        $config['charset'] = "utf-8";        $config['mailtype'] = "html";        $config['newline'] = "\r\n";        $ci->email->initialize($config);        $ci->email->from('maristarchives@gmail.com', "Marist Archives");        $list = array('maristarchives@gmail.com', 'dheeraj.karnati1@marist.edu');        $ci->email->to($list);        $this->email->reply_to($_POST["user_email"], $user_name);        $ci->email->message($message_body);        //If the attached file in requested format        if ($file_attached) {            $this->load->model('usragr_model');            $ci->email->subject($userId.'_Use Agreement Request(Attachment)');            echo $file_type;            if ($file_type == "application/pdf") {                $result = $this->usragr_model->update_attachment('UseAgreement_Request_' . $userId . "(" . $date . ")" . '.pdf', $userId);                if ($result > 0) {                    $ci->email->attach($file_tmp_name, 'attachment', 'UseAgreement_Request_' . $userId . "(" . $date . ")" . '.pdf');                    $ci->email->send();                }            } else if ($file_type == "image/jpeg") {                $result = $this->usragr_model->update_attachment('UseAgreement_Request_' . $userId . "(" . $date . ")" . '.jpeg', $userId);                if ($result > 0) {                    $ci->email->attach($file_tmp_name, 'attachment', 'UseAgreement_Request_' . $userId . "(" . $date . ")" . '.jpeg');                    $ci->email->send();                }            } else if ($file_type == "image/png") {                $result = $this->usragr_model->update_attachment('UseAgreement_Request_' . $userId . "(" . $date . ")" . '.png', $userId);                if ($result > 0) {                    $ci->email->attach($file_tmp_name, 'attachment', 'UseAgreement_Request_' . $userId . "(" . $date . ")" . '.png');                    $ci->email->send();                }            }            else if($file_type == "application/msword"){                $result = $this->usragr_model->update_attachment('UseAgreement_Request_' . $userId . "(" . $date . ")" . '.doc', $userId);                if ($result > 0) {                    $ci->email->attach($file_tmp_name, 'attachment', 'UseAgreement_Request_' . $userId . "(" . $date . ")" . '.doc');                    $ci->email->send();                }            } else if($file_type == "application/vnd.openxmlformats-officedocument.wordprocessingml.document"){                $result = $this->usragr_model->update_attachment('UseAgreement_Request_' . $userId . "(" . $date . ")" . '.docx', $userId);                if ($result > 0) {                    $ci->email->attach($file_tmp_name, 'attachment', 'UseAgreement_Request_' . $userId . "(" . $date . ")" . '.docx');                    $ci->email->send();                }            }            else{                $result = $this->usragr_model->update_attachment('UseAgreement_Request_' . $userId . "(" . $date . ")", $userId);                if ($result > 0) {                    $ci->email->attach($file_tmp_name, 'attachment', 'UseAgreement_Request_' . $userId . "(" . $date . ")");                    $ci->email->send();                }            }        } // Mail without attachment        else {            $ci->email->subject($userId.'_Use Agreement Request');            $ci->email->send();        }    }}?>