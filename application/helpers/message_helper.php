<?php 
// Send email from the user
function sendMail($email,$subject,$smsmessage)
{
    $to       = $email;
    $message  ="&nbsp;".$smsmessage."\r\n";
    $message .="Note - This is a System Generated Mail, please do not reply.\r\n";
    $headers  = "From:"."Popin@Popin.com"."\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=utf-8\r\n";
    mail($to,$subject,'<pre style="font-size:14px;">'.$message.'</pre>',$headers);
    return 1;
}
function sendMailAdmin($email,$subjectTitle,$smsmessage,$from)
{
    $to       = $email;
    $subject  = $subjectTitle;
    $message  = $smsmessage."\r\n";
    $message .="Note - This is a System Generated Mail, please do not reply.\r\n";
    $headers  = "From:".$from."\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=utf-8\r\n";
    //echo $message;
    mail($to,$subject,'<pre style="font-size:14px;">'.$message.'</pre>',$headers);
    return 1;
}
function getSingleRecord($table,$column,$condition,$select = "*"){
    $tableRecord =& get_instance();
    $tableRecord->load->database();
    return $tableRecord->db->select($select)->get_where($table,array($column=>$condition))->row();
}
function getMultiRecord($table,$column,$condition,$orderBy='',$orderType=''){
    $tableRecord =& get_instance();
    $tableRecord->load->database();
     if (!empty($orderBy)) {
         $tableRecord->db->order_by($orderBy,$orderType);
     }
    return $tableRecord->db->get_where($table,array($column=>$condition))->result_array();
}
 function generate_unique_code(){
        return substr(str_shuffle("1234567890"),'0','4');   
    }
 function returnColumnValue($table,$column,$condition,$columnValue){
    $tableRecord =& get_instance();
    $tableRecord->load->database();
    $query = $tableRecord->db->get_where($table,array($column=>$condition))->row_array();   
    return $query[$columnValue];
 }
 function ratingValueConvert($rating){
     if (strlen($rating) < 3) {
          return $rating;
      }else{
         $getRating = explode(".",$rating);
         if ($getRating[1] < 5 ) {
          return $getRating[0];  
         }else if ($getRating[1] >= 5 ) {
          return $getRating[0].'.5';
         }
      }
 }
 function createHTMLRating($spaceID){
    $rating  = returnColumnValue('spaces','id',$spaceID,'totalRating');
    $html = '';
    $html ='<fieldset class="rating1">
                <input type="radio"  value="5" '.($rating == '5'?'checked':'').' />
                <label class = "full"  title="Awesome - 5 stars">    
                </label>
                <input type="radio"  value="4.5" '.($rating == '4.5'?'checked':'').' /><label class="half"  title="4.5 stars"></label>
                <input type="radio"  value="4" '.($rating == '4'?'checked':'').' /><label class = "full" title="4 stars"></label>
                <input type="radio"   value="3.5" '.($rating == '3.5'?'checked':'').'  /><label class="half" title="3.5 stars"></label>
                <input type="radio"  value="3" '.($rating == '3'?'checked':'').' /><label class = "full"  title="3 stars"></label>
                <input type="radio"   value="2.5" '.($rating == '2.5'?'checked':'').'  /><label class="half"  title="2.5 stars"></label>
                <input type="radio"   value="2" '.($rating == '2'?'checked':'').'  /><label class = "full" title="2 stars"></label>
                <input type="radio"   value="1.5" '.($rating == '1.5'?'checked':'').' /><label class="half"  title="1.5 stars"></label>
                <input type="radio"   value="1" '.($rating == '1'?'checked':'').' /><label class = "full" title="1 star"></label>
                <input type="radio"  value="0.5" '.($rating == '0.5'?'checked':'').' /><label class="half" title="0.5 stars"></label>
            </fieldset>';
    return $html;
 }
 function totalReivewsGet($spaceID){
    $tableRecord =& get_instance();
    $tableRecord->load->database();
    return count($tableRecord->db->get_where('space_ratings',array('space'=>$spaceID,'status'=>'Approved'))->result_array());
 }
?>