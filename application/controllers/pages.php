<?php
class Pages extends CI_Controller{
	public function __construct()
	{
		parent::__construct();

		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		//$this->load->library('security');
		$this->load->library('tank_auth');
		$this->lang->load('tank_auth');
		$this->load->model('user_model');

		}

	public function index(){
		$this->load->view('templates/header.php');
		$this->load->view('templates/navbar.php');

		$this->load->view('content/home');
		$this->load->view('templates/footer.php');

	}


	public function listings(){
		if(isset($_POST['listing_search_submit'])){
			$this->load->model('listing_model');
			$this->load->model('school_model');
			$search = $this->input->post('listings');
			$items = explode(" ", $search);
			$school = $this->user_model->get_school($this->tank_auth->get_username());
			$data['schoolName'] = $this->school_model->get_school_name($school);
			$data['listingArray'] = $this->listing_model->search($items, $school);
			$this->load->view('templates/navbar.php');
			$this->load->view('templates/header.php');
			$this->load->view('content/listings.php', $data);
			$this->load->view('templates/footer.php');
		}
		else{
			$this->load->model('listing_model');
			$this->load->model('school_model');
			$school = $this->user_model->get_school($this->tank_auth->get_username());
			$data['listingArray'] = $this->listing_model->get_listings($school);
			$data['schoolName'] = $this->school_model->get_school_name($school);
			$this->load->view('templates/navbar.php');
			$this->load->view('templates/header.php');
			$this->load->view('content/listings.php', $data);
			$this->load->view('templates/footer.php');
		}
		
	}

	//add in logic for out of schoolers/own profile
	public function profile($username = null){
		if($username == null){
			redirect('');
		}
		else{
			$data['email'] = $this->user_model->get_email($username);
			$data['phone'] = $this->user_model->get_phonenumber($username);
			$data['name'] = $this->user_model->get_name($username);
			$usertype = $this->user_model->get_usertype($username);
			$data['usertype'] = $usertype;
			$extrainfo = $this->user_model->get_extrainfo($username);
			$xml = simplexml_load_string($extrainfo);
			if($usertype == 'user' && $xml != null) {
				$data['gradyear'] = $xml->gradyear;
				$data['bio'] = $xml->bio;
				$data['interests'] = $xml->interests;
				$data['skills'] = $xml->skills;
				$data['linkedin'] = $xml->linkedin;
				$data['resume'] = $xml->resume;
				$data['additional'] = $xml->additional;
				$this->load->view('templates/header.php');
				$this->load->view('templates/navbar.php');
				$this->load->view('user/users/viewprofile',$data);
				$this->load->view('templates/footer.php');
			}
			else{
				//figure out after redoing professor's profile
			}
		}
	}

	public function usersearch(){
		if(isset($_POST['users_search_submit'])){
			$this->load->model('school_model');
			$search = $this->input->post('users');
			$items = explode(" ", $search);
			$school = $this->user_model->get_school($this->tank_auth->get_username());
			$data['schoolName'] = $this->school_model->get_school_name($school);
			$data['userArray'] = $this->user_model->search_professors($items, $school);
			$this->load->view('templates/navbar.php');
			$this->load->view('templates/header.php');
			$this->load->view('content/usersearch.php', $data);
			$this->load->view('templates/footer.php');
		}
		else{
			$this->load->model('school_model');
			$school = $this->user_model->get_school($this->tank_auth->get_username());
			$data['userArray'] = null;
			$data['schoolName'] = $this->school_model->get_school_name($school);
			$this->load->view('templates/navbar.php');
			$this->load->view('templates/header.php');
			$this->load->view('content/listings.php', $data);
			$this->load->view('templates/footer.php');
		}
	}

	// public function changeusertype(){
	// 	$newtype = $this->input->post('type');
	// 	public function set_usertype($username = null, $usertype = null){
	// 	    // $data = array(
	// 	    //     'xmlinfo' => $xmlIn
	// 	    // );

	// 	    // return $this->db->update('userpages', $data);

 //                $data = array('usertype => $usertype');
 //                return $this->db->update('userinfo', $data, array('username'=>'$username'));
 //        }
	// }
}
