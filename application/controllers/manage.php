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

		}

	public function index(){
		if(!$this->tank_auth->is_logged_in()){
			redirect(base_url(), 'refresh');
		}
		else{
			$usertype = $this->user_model->get_usertype($this->tank_auth->get_username());
			//If the user is a professor
			if($usertype == 'professor'){

				if(isset($_POST['profile_submit'])){
					$this->form_validation->set_rules('personName', 'Name', 'trim|required|xss_clean');
					$this->form_validation->set_rules('email', 'Email', 'valid_email|trim|required|xss_clean');
					$this->form_validation->set_rules('phonenumber', 'Phone Number', 'required|trim|xss_clean');
					if ($this->form_validation->run() == FALSE)
					{
						$issave['saved'] = false;
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
						$this->load->view('user/users/profmanage.php', $data);
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
						$this->load->view('user/users/profmanage.php', $data);
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
						$this->load->view('user/users/profmanage.php', $data);
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
					$this->load->view('user/users/profmanage.php', $data);
					$this->load->view('templates/footer.php');

						//$this->load->view('content/saved.php');
					}
				}
				else{

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
						$issave['saved'] = false;
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
						$issave['saved'] = false;
					}
					$this->load->view('templates/manageheader.php', $issave);
					$this->load->view('templates/navbar.php');
					$this->load->view('user/users/usermanage.php', $data);
					$this->load->view('templates/footer.php');
				}
			}
			//If the user is a student
			else if($usertype == 'user'){

				//$data['submitpath'] = base_url() . 'manage/userupdate';
				if(isset($_POST['profile_submit'])){
					$this->form_validation->set_rules('personName', 'Name', 'trim|required|xss_clean');
					$this->form_validation->set_rules('email', 'Email', 'valid_email|trim|required|xss_clean');
					$this->form_validation->set_rules('phonenumber', 'Phone Number', 'required|trim|xss_clean');
					if ($this->form_validation->run() == FALSE)
					{
						$issave['saved'] = false;
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

						//$this->load->view('content/saved.php');
					}
				}
				else{
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
						$issave['saved'] = false;
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
						$issave['saved'] = false;
					}
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
					$this->load->view('templates/footer.php');
				}
				else{
					$this->load->model('listing_model');
					$name = $this->input->post('listingName');
					$reqs = $this->input->post('requirements');
					$description = $this->input->post('description');
					$pay = $this->input->post('pay');
					$time = $this->input->post('time');
					$username = $this->tank_auth->get_username();
					$school = $this->user_model->get_school($username);
					$isChem = $this->input->post('categoryChem');
					$isBio = $this->input->post('categoryBio');
					$isPhys = $this->input->post('categoryPhysics');
					$categories = array($isChem, $isBio, $isPhys);
					$this->listing_model->create_listing($name, $reqs, $description, $pay, $time, $school, $username, $categories);
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
}
