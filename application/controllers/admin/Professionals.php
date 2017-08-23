<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Professionals extends CI_Controller {

	
	public function __Construct()
	{
	   	 parent::__Construct();
	   	 $this->load->model(ADMIN_DIR.'/adminLogin','login');
		 $this->login->check_isvalidated();
		 $this->adminProfileInfo = $this->login->adminProfileInfo();
		 $this->load->library('form_validation');
 	     $this->load->model(ADMIN_DIR.'/adminGuests','guest');
		
		
	}
	
	public function index()
	{
		$this->lists();
	}
	
	public function lists()
	{
		$data = array();
		$data['module_heading'] = 'Guests Lists';
		$data['adminProfileInfo'] = $this->adminProfileInfo;
		$this->load->view(ADMIN_DIR.'/'.INC.'/header',$data);		
		$this->load->view(ADMIN_DIR.'/'.INC.'/left-sidebar',$data);		
		$this->load->view(ADMIN_DIR.'/'.GUEST.'/list',$data);		
		$this->load->view(ADMIN_DIR.'/'.INC.'/footer',$data);
	} 
	
	public function get_all_list()
	{
			 if (isset($_REQUEST["customActionType"]) && $_REQUEST["customActionType"] == "group_action") {
				 
					$response = $this->guest->updateStatus($_POST['id'],$_REQUEST['customActionName']);
				 	$status = $response['status'];
					$message = $response['message'];
				
		   }
		   $list = $this->guest->get_datatables();
       	   $data = array();
           $no = $_POST['start'];
		   $data = array();
        	$no = $_POST['start'];
		foreach ($list as $guest) {
			$no++;
            $possible_status_changes = '';
			$row = array();
			$row[] = '<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline"><input name="id[]" type="checkbox" class="checkboxes" value="'.$guest->id.'"/><span></span></label>';
			$row[] = '<img src="'.base_url('uploads/guest/thumb/'.$guest->avatar).'" alt="'.$guest->firstName.'&nbsp;'.$guest->lastName.'">';
			$row[] = $guest->firstName.'&nbsp;'.$guest->lastName;
			$row[] = $guest->email;
			$row[] = $guest->phone;
			$row[] = date(DATE_FORMAT,$guest->createdDate);
			$row[] = date(DATE_FORMAT,$guest->updatedDate);
			if($guest->status=='Pending')
			{
				$row[] = '<button class="btn btn-default">'.$guest->status.'</button>';
			}
			else if($guest->status=='Active')
			{
				$row[] = '<button class="btn btn-success">'.$guest->status.'</button>';
			}
			else if($guest->status=='DeActive')
			{
				$row[] = '<button class="btn btn-warning">'.$guest->status.'</button>';
			}
			else
			{
				$row[] = '<button class="btn btn-danger">'.$guest->status.'</button>';
			}
			//add html for action
			
			$row[] = '<a class="btn btn-primary" href="javascript:void(0);" title="View Guest" onClick="view_guest('.$guest->id.');"><i class="fa fa-eye"></i> View</a>';           
		    $data[] = $row;
        }
 
 		$output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->guest->count_all(),
                        "recordsFiltered" => $this->guest->count_filtered(),
                        "data" => $data,
						
                );
        if (isset($_REQUEST["customActionType"]) && $_REQUEST["customActionType"] == "group_action") {
				 
				$output["customActionStatus"] = $status; // OK for success and NOt OK for fail. pass custom message(useful for getting status of group actions)
				$output["customActionMessage"] = $message; // pass custom message(useful for getting status of group actions)
		   }
		//output to json format
		  echo json_encode($output);
	}
	
	public function view($id)
	{
		$data = $this->guest->viewGuest($id);
		
		/*echo '<pre>';
		print_r($data);
		exit;*/
		
		$all_cards = $this->guest->getCards($data->id);
		
		/*echo '<pre>';
		print_r($all_cards);
		exit;*/
		
		if($data->status=='Pending')
			{
				$status = '<button class="btn btn-default">'.$data->status.'</button>';
			}
			else if($data->status=='Active')
			{
				$status = '<button class="btn btn-success">'.$data->status.'</button>';
			}
			else if($data->status=='DeActive')
			{
				$status = '<button class="btn btn-warning">'.$data->status.'</button>';
			}
			else
			{
				$status = '<button class="btn btn-danger">'.$data->status.'</button>';
			}
		
		$profileDetail = array(
				'firstName'=>$data->firstName,
				'lastName'=> $data->lastName,
				'email'=>$data->email,
				'phone'=>$data->phone,
				'businessNumber'=>$data->businessNumber,
				'avatar'=> '<img src="'.base_url('uploads/guest/thumb/'.$data->avatar).'" alt="'.$data->firstName.'&nbsp;'.$data->lastName.'">',
				'verificationCode'=>$data->verificationCode,
				'paypalEmail'=>$data->paypalEmail,
				'status'=>$status,
				'notificationNumber'=>$data->notificationNumber,
				'numberNotification'=>$data->numberNotification,
				'rentalUpdates'=>$data->rentalUpdates,
				'otherUpdates'=>$data->otherUpdates,
				'generalPromotionalEmail'=>$data->generalPromotionalEmail,
				'rentalReviewReminders'=>$data->rentalReviewReminders,
				'accountActivity'=>$data->accountActivity,
				'reciveCalls'=>$data->reciveCalls,
				'newsLetter'=>$data->newsLetter,
				'card'=>$all_cards
			);
		
		/*echo '<pre>';
		print_r($profileDetail);
		exit;*/
		
		echo json_encode($profileDetail);
	}
	
	}
?>
