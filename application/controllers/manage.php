<?php
class Manage extends CI_Controller{
	public function __construct()
	{
		parent::__construct();

		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		//$this->load->library('security');
		$this->load->library('tank_auth');
		$this->lang->load('tank_auth');
		$this->load->model('user_model');
		$this->load->model('info_model');
		$this->load->model('request_model');

		}

	public function index(){
		if(!$this->tank_auth->is_logged_in()){
			redirect(base_url(), 'refresh');
		}
		else{
			$usertype = $this->user_model->get_usertype($this->tank_auth->get_username());
			
			//If the user is a professor
			if($usertype == 'professor'){
				//handling profile submission
				if(isset($_POST['profile_submit'])){
					$this->form_validation->set_rules('personName', 'Name', 'trim|required|xss_clean');
					$this->form_validation->set_rules('email', 'Email', 'valid_email|trim|required|xss_clean');
					$this->form_validation->set_rules('phonenumber', 'Phone Number', 'required|trim|xss_clean');
					if ($this->form_validation->run() == FALSE)
					{
						$issave['saved'] = false;
						$data = $this->info_model->prepare_prof_data();
						$this->load->view('templates/manageheader.php', $issave);
						$this->load->view('templates/navbar.php');
						$this->load->view('user/professors/profmanage.php', $data);
						$this->load->view('templates/footer.php');
					}
					else{
						$email = $this->input->post('email');
						$name = $this->input->post('personName');
						$phone = $this->input->post('phonenumber');
						$this->user_model->set_email($email);
						$this->user_model->set_name($name);
						$this->user_model->set_phone($phone);
						$issave['saved'] = true;
						$data = $this->info_model->prepare_prof_data();
						$this->load->view('templates/manageheader.php', $issave);
						$this->load->view('templates/navbar.php');
						$this->load->view('user/professors/profmanage.php', $data);
						$this->load->view('templates/footer.php');
					}
				}
				//handling info submission
				else if(isset($_POST['info_submit'])){
					$this->form_validation->set_rules('department', 'Department', 'trim|xss_clean');
					$this->form_validation->set_rules('bio', 'Bio', 'trim|xss_clean');
					$this->form_validation->set_rules('interests', 'Interests', 'trim|xss_clean');
					$this->form_validation->set_rules('additionalinfo', 'Additional Info', 'trim|xss_clean');
					if ($this->form_validation->run() == FALSE)
					{
						$issave['saved'] = false;
						$data = $this->info_model->prepare_prof_data();
						$this->load->view('templates/manageheader.php', $issave);
						$this->load->view('templates/navbar.php');
						$this->load->view('user/professors/profmanage.php', $data);
						$this->load->view('templates/footer.php');
					}
					else{
						$department = $this->input->post('department');
						$bio = $this->input->post('bio');
						$interests = $this->input->post('interests');
						$additionalinfo = $this->input->post('additionalinfo');
						$toinsert = "<info>
									<department>$department</department>
									<bio>$bio</bio>
									<interests>$interests</interests>
									<additionalinfo>$additionalinfo</additionalinfo>
									</info>";
						$this->user_model->set_extrainfo($toinsert);
						$issave['saved'] = true;
						$data = $this->info_model->prepare_prof_data();
						$this->load->view('templates/manageheader.php', $issave);
						$this->load->view('templates/navbar.php');
						$this->load->view('user/professors/profmanage.php', $data);
						$this->load->view('templates/footer.php');

						//$this->load->view('content/saved.php');
					}
				}

				else{
					$issave['saved'] = false;
					$username = $this->tank_auth->get_username();
					$xmlstring = $this->user_model->get_extrainfo($username);
					$xml = simplexml_load_string($xmlstring);
					$data = $this->info_model->prepare_prof_data();
					$this->load->view('templates/manageheader.php', $issave);
					$this->load->view('templates/navbar.php');
					$this->load->view('user/professors/profmanage.php', $data);
					$this->load->view('templates/footer.php');
				}
			}
			////////////////////////////
			//If the user is a student//
			////////////////////////////
			else if($usertype == 'user'){

				//$data['submitpath'] = base_url() . 'manage/userupdate';
				if(isset($_POST['profile_submit'])){
					$this->form_validation->set_rules('personName', 'Name', 'trim|required|xss_clean');
					$this->form_validation->set_rules('email', 'Email', 'valid_email|trim|required|xss_clean');
					$this->form_validation->set_rules('phonenumber', 'Phone Number', 'required|trim|xss_clean');
					if ($this->form_validation->run() == FALSE)
					{
						$issave['saved'] = false;
						$data = $this->info_model->prepare_user_data();
						$this->load->view('templates/manageheader.php', $issave);
						$this->load->view('templates/navbar.php');
						$this->load->view('user/users/usermanage.php', $data);
						$this->load->view('templates/footer.php');
					}
					else{
						$email = $this->input->post('email');
						$name = $this->input->post('personName');
						$phone = $this->input->post('phonenumber');
						$this->user_model->set_email($email);
						$this->user_model->set_name($name);
						$this->user_model->set_phone($phone);
						$issave['saved'] = true;
						$username = $this->tank_auth->get_username();
						$xmlstring = $this->user_model->get_extrainfo($username);
						$xml = simplexml_load_string($xmlstring);
						if($xml == false){
							$data['gradyear'] = '';
							$data['bio'] = '';
							$data['interests'] = '';
							$data['skills'] = '';
							$data['linkedin'] = '';
							$data['resume'] = '';
							$data['additionalinfo'] = '';
							$data['name'] = '';
							$data['email'] = '';
							$data['phonenumber'] = '';
						}
						else{
							$data['gradyear'] = $xml->gradyear;
							$data['bio'] = $xml->bio;
							$data['interests'] = $xml->interests;
							$data['skills'] = $xml->skills;
							$data['linkedin'] = $xml->linkedin;
							$data['resume'] = $xml->resume;
							$data['additionalinfo'] = $xml->additionalinfo;
							$data['name'] = $this->user_model->get_name($username);
							$data['email'] = $this->user_model->get_email($username);
							$data['phonenumber'] = $this->user_model->get_phonenumber($username);
						}
						$this->load->view('templates/manageheader.php', $issave);
						$this->load->view('templates/navbar.php');
						$this->load->view('user/users/usermanage.php', $data);
						$this->load->view('templates/footer.php');
					}
				}
				else if(isset($_POST['info_submit'])){
					$this->form_validation->set_rules('gradyear', 'Graduation Year', 'trim|xss_clean');
					$this->form_validation->set_rules('bio', 'Bio', 'trim|xss_clean');
					$this->form_validation->set_rules('interests', 'Interests', 'trim|xss_clean');
					$this->form_validation->set_rules('skills', 'Skills', 'trim|xss_clean');
					$this->form_validation->set_rules('linkedin', 'LinkedIn Profile', 'trim|xss_clean');
					$this->form_validation->set_rules('resume', 'Resume', 'trim|xss_clean');
					$this->form_validation->set_rules('additionalinfo', 'Additional Info', 'trim|xss_clean');
					if ($this->form_validation->run() == FALSE)
					{
						$issave['saved'] = false;
						$data = $this->info_model->prepare_user_data();
						$this->load->view('templates/manageheader.php', $issave);
						$this->load->view('templates/navbar.php');
						$this->load->view('user/users/usermanage.php', $data);
						$this->load->view('templates/footer.php');
					}
					else{
						$gradyear = $this->input->post('gradyear');
						$bio = $this->input->post('bio');
						$interests = $this->input->post('interests');
						$skills = $this->input->post('skills');
						$linkedin = $this->input->post('linkedin');
						$resume = $this->input->post('resume');
						$additionalinfo = $this->input->post('additionalinfo');
						$toinsert = "<info>
									<gradyear>$gradyear</gradyear>
									<bio>$bio</bio>
									<interests>$interests</interests>
									<skills>$skills</skills>
									<linkedin>$linkedin</linkedin>
									<resume>$resume</resume>
									<additionalinfo>$additionalinfo</additionalinfo>
									</info>";
						$this->user_model->set_extrainfo($toinsert);
						$issave['saved'] = true;
						$data = $this->info_model->prepare_user_data();
						$this->load->view('templates/manageheader.php', $issave);
						$this->load->view('templates/navbar.php');
						$this->load->view('user/users/usermanage.php', $data);
						$this->load->view('templates/footer.php');

						//$this->load->view('content/saved.php');
					}
				}
				//handle endorsement submit
				else if(isset($_POST['endorse_submit'])){
					$this->form_validation->set_rules('endorseFacultyName', 'Faculty Email', 'trim|required|xss_clean|callback_sameschool_check|callback_endorsementsent_check');
					$this->form_validation->set_rules('endorsementMessage', 'Message', 'trim|xss_clean');
					if ($this->form_validation->run() == FALSE)
					{
						$issave['saved'] = false;
						$data = $this->info_model->prepare_user_data();
					}
					else{
						$issave['saved'] = false;
						$username = $this->tank_auth->get_username();
						$email = $this->input->post('endorseFacultyName');
						$target = $this->user_model->get_username_by_email($email);
						$source = $this->tank_auth->get_username();
						$message = $this->input->post('endorsementMessage');
						$type = 'endorsement';
						
						$this->request_model->set_request($source, $target, $message, $type);
						$data = $this->info_model->prepare_user_data();
					}
					$this->load->view('templates/manageheader.php', $issave);
					$this->load->view('templates/navbar.php');
					$this->load->view('user/users/usermanage.php', $data);
					$this->load->view('templates/footer.php');
				}

				//handle recletter submit
				else if(isset($_POST['recletter_submit'])){
					$this->form_validation->set_rules('endorseFacultyName', 'Faculty Email', 'trim|required|xss_clean|callback_sameschool_check|callback_recsent_check');
					$this->form_validation->set_rules('endorsementMessage', 'Message', 'trim|xss_clean');
					if ($this->form_validation->run() == FALSE)
					{
						$issave['saved'] = false;
						$data = $this->info_model->prepare_user_data();
					}
					else{
						$issave['saved'] = false;
						$username = $this->tank_auth->get_username();
						$email = $this->input->post('recFacultyName');
						$message = $this->input->post('recMessage');
						$target = $this->user_model->get_username_by_email($email);
						$source = $this->tank_auth->get_username();
						$type = 'recletter';
						
						$this->request_model->set_request($source, $target, $message, $type);
						$data = $this->info_model->prepare_user_data();
					}
					$this->load->view('templates/manageheader.php', $issave);
					$this->load->view('templates/navbar.php');
					$this->load->view('user/users/usermanage.php', $data);
					$this->load->view('templates/footer.php');

				}
				//handle nothing submitted
				else{
					$data = $this->info_model->prepare_user_data();
					$this->load->view('templates/manageheader.php', $issave);
					$this->load->view('templates/navbar.php');
					$this->load->view('user/users/usermanage.php', $data);
					$this->load->view('templates/footer.php');
				}
				
				
			}
			else if($usertype == 'admin'){

			}
			else if($usertype == 'pendingprof'){

			}
			else if($usertype == null){

			}
			else{
				var_dump($usertype);
			}
		}

	}

	public function createlisting(){
		if(!$this->tank_auth->is_logged_in()){
			redirect(base_url(), 'refresh');
		}
		else{
			$usertype = $this->user_model->get_usertype($this->tank_auth->get_username());
			if($usertype !== 'professor'){
				redirect(base_url(), 'refresh');
			}
			else{
				$this->form_validation->set_rules('listingName', 'Name', 'trim|required|xss_clean');
				$this->form_validation->set_rules('requirements', 'Requirements', 'trim|required|xss_clean');
				$this->form_validation->set_rules('description', 'Description', 'trim|required|xss_clean');
				$this->form_validation->set_rules('time', 'Time', 'trim|required|xss_clean');
				if ($this->form_validation->run() == FALSE)
				{
					$this->load->view('templates/header.php');
					$this->load->view('user/professors/createlisting.php');
				}
				else{
					$this->load->model('listing_model');
					$name = $this->input->post('listingName');
					$reqs = $this->input->post('requirements');
					$description = $this->input->post('description');

					$time = $this->input->post('time');
					$username = $this->tank_auth->get_username();
					$school = $this->user_model->get_school($username);
					$isChem = $this->input->post('categoryChem');
					$isBio = $this->input->post('categoryBio');
					$isPhys = $this->input->post('categoryPhysics');
					$isEcon = $this->input->post('categoryEcon');
					var_dump($isPhys);
					$categories = array($isChem, $isBio, $isPhys, $isEcon);
					$this->listing_model->create_listing($name, $reqs, $description, $pay, $time, $school, $username, $categories);
				}
			}
		}
	}

	public function listings(){
		if(!$this->tank_auth->is_logged_in()){
			redirect(base_url(), 'refresh');
		}
		else{
			$usertype = $this->user_model->get_usertype($this->tank_auth->get_username());
			if($usertype !== 'professor'){
				redirect(base_url(), 'refresh');
			}
			else{
				$this->load->model('listing_model');
				$data['listingArray'] = $this->listing_model->get_listings_by_username($this->tank_auth->get_username());
				$this->load->view('content/managelistings',$data);
			}
		}
	}

	public function editlisting($id){
		if(!$this->tank_auth->is_logged_in()){
			redirect(base_url(), 'refresh');
		}
		else{
			$usertype = $this->user_model->get_usertype($this->tank_auth->get_username());
			if($usertype !== 'professor'){
				redirect(base_url(), 'refresh');
			}
			else{
				$this->form_validation->set_rules('listingName', 'Name', 'trim|required|xss_clean');
				$this->form_validation->set_rules('requirements', 'Requirements', 'trim|required|xss_clean');
				$this->form_validation->set_rules('description', 'Description', 'trim|required|xss_clean');
				$this->form_validation->set_rules('time', 'Time', 'trim|required|xss_clean');
				if ($this->form_validation->run() == FALSE)
				{
					$this->load->model('listing_model');
					$data = $this->listing_model->prep_update($id);
					//deal with null case
					$this->load->view('templates/header.php');
					$this->load->view('user/professors/editlisting.php',$data);
				}
				else{
					$this->load->model('listing_model');
					$name = $this->input->post('listingName');
					$reqs = $this->input->post('requirements');
					$description = $this->input->post('description');
					$time = $this->input->post('time');
					$username = $this->tank_auth->get_username();
					$school = $this->user_model->get_school($username);
					$isChem = $this->input->post('categoryChem');
					$isBio = $this->input->post('categoryBio');
					$isPhys = $this->input->post('categoryPhysics');
					$isEcon = $this->input->post('categoryEcon');
					var_dump($isPhys);
					$categories = array($isChem, $isBio, $isPhys, $isEcon);
					$this->listing_model->update($name, $reqs, $description, $time, $school, $username, $categories, $id);
				}
			}
		}
	}

	public function changeusertype(){
		$newtype = $this->input->post('type');
		// public function set_usertype($username = null, $usertype = null){
		//     // $data = array(
		//     //     'xmlinfo' => $xmlIn
		//     // );

		//     // return $this->db->update('userpages', $data);

  //               $data = array('usertype => $usertype');
  //               return $this->db->update('userinfo', $data, array('username'=>'$username'));
  //       }
	}

	//callback checks
	private function sameschool_check($str){
		$username = $this->user_model->get_username_by_email($str);
		if($username == null){
			$this->form_validation->set_message('sameschool_check', 'Could not find this professor in our system');
			return FALSE;
		}
		else{
			$targetschool = $this->user_model->get_school($username);
			$sourceschool = $this->user_model->get_school($this->tank_auth->get_username());
			if($targetschool != $sourceschool){
				$this->form_validation->set_message('sameschool_check', 'This professor is from a different school');
				return FALSE;
			}
			else{
				return TRUE;
			}
		}
	}
	private function recsent_check($str){
		$username = $this->user_model->get_username_by_email($str);
		$query = $this->db->query("SELECT * FROM `requests` WHERE `target`='$username' AND `source`='$this->tank_auth->get_username()' AND `type`='recletter'");
		if($query->num_rows() > 0){
            $this->form_validation->set_message('recsent_check', 'You have already sent a request.');
        }
	}
	private function endorsementsent_check($str){
		$username = $this->user_model->get_username_by_email($str);
		$query = $this->db->query("SELECT * FROM `requests` WHERE `target`='$username' AND `source`='$this->tank_auth->get_username()' AND `type`='endorsement'");
		if($query->num_rows() > 0){
            $this->form_validation->set_message('endorsementsent_check', 'You have already sent a request.');
        }
	}
	private function prepare_prof_data(){
            $username = $this->tank_auth->get_username();
            $xmlstring = $this->user_model->get_extrainfo($username);
            $xml = simplexml_load_string($xmlstring);
            if($xml == false){
                $data['department'] = '';
                $data['bio'] = '';
                $data['interests'] = '';
                $data['additionalinfo'] = '';
                $data['name'] = $this->user_model->get_name($username);
                $data['email'] = $this->user_model->get_email($username);
                $data['phonenumber'] = $this->user_model->get_phonenumber($username);
                $data['requestsArray'] = $this->request_model->get_requests_by_target($this->tank_auth->get_username());
            }
            else{
                $data['department'] = $xml->department;
                $data['bio'] = $xml->bio;
                $data['interests'] = $xml->interests;
                $data['additionalinfo'] = $xml->additionalinfo;
                $data['name'] = $this->user_model->get_name($username);
                $data['email'] = $this->user_model->get_email($username);
                $data['phonenumber'] = $this->user_model->get_phonenumber($username);
                $data['requestsArray'] = $this->request_model->get_requests_by_target($this->tank_auth->get_username());
            }
            return $data;
        }

    // private function prepare_user_data(){
    //     $username = $this->tank_auth->get_username();
    //     $xmlstring = $this->user_model->get_extrainfo($username);
    //     $xml = simplexml_load_string($xmlstring);
    //     if($xml == false){
    //         $data['gradyear'] = '';
    //         $data['bio'] = '';
    //         $data['interests'] = '';
    //         $data['skills'] = '';
    //         $data['linkedin'] = '';
    //         $data['resume'] = '';
    //         $data['additionalinfo'] = '';
    //         $data['name'] = '';
    //         $data['email'] = '';
    //         $data['phonenumber'] = '';
    //     }
    //     else{
    //         $data['gradyear'] = $xml->gradyear;
    //         $data['bio'] = $xml->bio;
    //         $data['interests'] = $xml->interests;
    //         $data['skills'] = $xml->skills;
    //         $data['linkedin'] = $xml->linkedin;
    //         $data['resume'] = $xml->resume;
    //         $data['additionalinfo'] = $xml->additionalinfo;
    //         $data['name'] = $this->user_model->get_name($username);
    //         $data['email'] = $this->user_model->get_email($username);
    //         $data['phonenumber'] = $this->user_model->get_phonenumber($username);
    //     }
    //     return $data;
    // }
}
