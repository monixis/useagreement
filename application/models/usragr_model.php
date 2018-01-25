<?php
class usragr_model extends CI_Model
{

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->database();
    }


    /*
     * Create New Researcher
     */
    public function insert_researcher($data, $table)
    {
        $this ->db ->trans_start();

        // $sql = "INSERT INTO researcher(userName,emailId) VALUES ('$userName', '$emailId');";
        $this->db->insert($table, $data);

        if ($this->db->affected_rows() > 0) {
            $userId = 'userId';
            $this->db->trans_complete();
            $maxval = $this->getmaxid($userId, $table);
            return $maxval;
        } else {
            return $this->db->_error_message().print_r("");
        }

    }

    /*
     * Fetch the maximum value of the researcher
     */
    public function getmaxid($col, $table)
    {
        $this->db->select_max($col);
        $query = $this->db->get($table);
        foreach ($query->result() as $row) {
            $maxval = $row->$col;

        }
        return $maxval;
    }

    /*
     * Function insert the user request
     */
    public function insertUserRequest($data, $table)
    {
        $this->db->insert($table, $data);
        if ($this->db->affected_rows() > 0) {
            return 1;
        } else {
            return $this->db->_error_message() . print_r("");
        }

    }
    /*
     * Fetch the researcher with $userId
     */
    public function getresearcher($userId)
    {
        $sql = "SELECT * FROM researcher LEFT JOIN request ON researcher.userId = request.userId where researcher.userId = $userId ;";
        $results = $this->db->query($sql, array($userId));
        return $results->result();
    }


    /*
     * Function to update researcher table
     */
    public function update_researcher($userName, $country, $state, $city, $address, $emailId, $zipCode, $date, $phoneNumber,$userInitials, $termsAndConditions,$userId)
    {

        $sql = "UPDATE researcher SET userName='$userName', country= '$country', state= '$state', city= '$city', address = '$address',
                                 emailId ='$emailId',phoneNumber='$phoneNumber', zipCode='$zipCode', date ='$date' , userInitials = '$userInitials' ,termsAndCond ='$termsAndConditions' WHERE userId='$userId' ;";

        $this->db->query($sql);

        if ($this->db->affected_rows() > 0) {

            return 1;
        } else {
            // return 0;
            return $this->db->_error_message() . print_r("");
        }
    }
    /*
     * Function to update researcher table
     */
    public function update_attachment($attachment,$filepath,$userId)
    {
        $sql = "UPDATE researcher SET  attachment = '$attachment' ,attachmentLink='$filepath' WHERE userId='$userId' ;";
        $this->db->query($sql);

        // $this->db->where('userId', "15");
        //$this->db->update('researcher', $data);
        if ($this->db->affected_rows() > 0) {
            return 1;
        } else {
            // return 0;
            return $this->db->_error_message() . print_r("");
        }
    }
   /*
    * Function to update researcher table
    */
    public function update_researcherWithStatus($status,$userInitials, $termsAndConditions,$userId)
    {
        $sql = "UPDATE researcher SET status= '$status' , userInitials = '$userInitials' ,termsAndCond ='$termsAndConditions' WHERE userId='$userId' ;";
        $this->db->query($sql);

        // $this->db->where('userId', "15");
        //$this->db->update('researcher', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            // return 0;
            return $this->db->_error_message() . print_r("");
        }
    }

    /*
     * Function to update researcher table
     */
    public function approveOrDisapprove_request($date,$status,$userId)
    {
        $sql = "UPDATE researcher SET  date ='$date' , status= '$status' WHERE userId='$userId' ;";
        $this->db->query($sql);

        // $this->db->where('userId', "15");
        //$this->db->update('researcher', $data);
        if ($this->db->affected_rows() > 0) {
            return 1;
        } else {
            // return 0;
            return $this->db->_error_message() . print_r("");
        }
    }

    /*
     *  Insert the Use Agreement Information for user in request table
     */
    public function insertUseAgreementInformation($requestName, $requestDescription, $boxNumber, $itemNumber, $fileType, $imageResolution, $fileFormat, $audOrVidFileFormat, $userId)
    {

        $this->db->trans_start();
        $this->db->query("INSERT INTO request(requestId,requestName,requestDescription,boxNumber,itemNumber,fileType,imageResolution,fileFormat,audOrVidFileFormat,userId) Values
       (null,$requestName , $requestDescription , $boxNumber,$itemNumber ,$fileType,$imageResolution,$fileFormat,$audOrVidFileFormat,$userId );");

        $this->db->trans_complete();
        if ($this->db->affected_rows() > 0) {
            return 1;
        } else {
            return 0;
        }
    }
     /*
      * Function to delete the requests.
      */
    public function deleteRequests($userId)
    {
        $this ->db ->trans_start();
        $this -> db -> where('userId', $userId);
        $result= $this -> db -> delete('request');
        // $sql = "DELETE FROM request WHERE userId= '$userId'";
        //delete existing requests
        //  $result =  $this->db->query($sql);
        if($result>0){
            $this->db->trans_complete();
        }
        else{
            $this->db->trans_rollback();
        }
        return $result;
    }
public function deleteUser($userId){

    $this ->db ->trans_start();
    $this->db-> where('userId', $userId);
    $result= $this -> db -> delete('request');
    if($result>0){
        $this->db->trans_complete();
        $this->db-> where('userId', $userId);
        $result= $this -> db -> delete('researcher');
        if($result>0){
            $this->db->trans_complete();
        }
        else{
            $this->db->trans_rollback();
        }
    }
    else{
        $this->db->trans_rollback();
    }
    return $result;


}

public function saveChat($data, $table){

    $this ->db ->trans_start();
    $this->db->insert($table, $data);
    if ($this->db->affected_rows() > 0) {
        $chatId = 'chat_id';
        $this->db->trans_complete();
        return $chatId;
    }else{
        return $this->db->_error_message().print_r("");
    }

}
  public function getUseagreementForms(){

        $this ->db ->trans_start();
        $sql = "SELECT userId,userName, attachment, status from researcher where status in (1,2,3);";
        $results = $this->db->query($sql);
      if($results != null) {
          return $results->result();
      }
      else{

          return 0;
      }
    }
 public function getUseagreementRequests($status){
     $this ->db ->trans_start();
     $sql = "SELECT userId,userName, attachment, status from researcher where status in ('$status');";
     $results = $this->db->query($sql);
     if($results != null) {
         return $results->result();
     }
     else{

         return 0;
     }

 }


    public function allRequests($limit = 0)
    {
        $this->db->limit($limit);
        $this->db->offset($this ->input ->get('per_page'));
        $this->db-> order_by('userId','desc');
        return $this->db->get('researcher');
    }
    public function count()
    {
        return $this->db->count_all_results('researcher');
    }

public function RequestsWithStatus($limit = 0, $status){
    $this->db->limit($limit);
    $this->db->offset($this ->input ->get('per_page'));
    $this->db-> where('status',$status);
    $this->db-> order_by('userId','desc');
    return $this->db->get('researcher');

}
    public function getPasscode($id){
        $this ->db ->trans_start();
       // $this ->db ->where('type','admin');
       // $results =   $this ->db ->get('passcode');
        $type ='admin';
        $sql="SELECT pass FROM passcode WHERE id='$id';";
         $results = $this->db->query($sql);
     //   print_r($results-> result());
        if($results != null) {
            foreach($results->result() as $row) {
                $passcode = $row-> pass;
                return $passcode;
            }
        }
        else{
            return 0;
        }

    }
public function countWithStatus($status){
    $this ->db -> select('userId');
    $this->db-> from('researcher');
    $this->db-> where('status',$status);
    return $this->db->count_all_results();

}

    public function getChat($userId){


        $this ->db ->trans_start();
        $sql = "SELECT * FROM chat where chat.userId = '$userId' ORDER BY chat.chatId DESC";
        $results = $this->db->query($sql, array($userId));
        if($results != null) {
            return $results->result();
        }
        else{

            return 0;
        }
    }
    public function updateStatus($status,$userId,$files){
        $this ->db ->trans_start();
        $sql = "UPDATE researcher SET status ='$status',copies_sent ='$files' where userId='$userId'";
        $this->db->query($sql);
        if ($this->db->affected_rows() > 0) {

            return 1;
        } else {
            // return 0;
            return $this->db->_error_message() . print_r("");
        }

}


}
?>
