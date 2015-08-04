<?php
class Listings extends CI_Controller{
	public function __construct()
	{
		parent::__construct();

		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		//$this->load->library('security');
		$this->load->library('tank_auth');
		$this->load->model('listing_model');
		$this->load->model('user_model');
		$this->lang->load('tank_auth');
	}

	public function index(){
		
		$this->load->view('testing');
		

	}

	public function view($listingid){
		if(!$this->tank_auth->is_logged_in()){
			redirect(base_url());
		}
		$data['listingArray'] = $this->listing_model->get_listing_by_id($listingid, $this->user_model->get_school($this->tank_auth->get_username()));
		$data['professorName'] = $this->user_model->get_name($data['listingArray']['username']);
		$this->load->view('content/detailedlisting',$data);
	}

	public function inquire($listingid){
		if(!$this->tank_auth->is_logged_in()){
			redirect(base_url());
		}
		if(isset($_POST['message_submit'])){
			$this->form_validation->set_rules('personName', 'Name', 'trim|required|xss_clean');
			if ($this->form_validation->run() == FALSE){
				$this->load->view('templates/manageheader.php', $issave);
				$this->load->view('templates/navbar.php');
				$this->load->view('user/users/profmanage.php', $data);
				$this->load->view('templates/footer.php');
			}
			else{
				//send email to professor, which I do not know how to do yet
			}
		}

		$data['listingArray'] = $this->listing_model->get_listing_by_id($listingid, $this->user_model->get_school($this->tank_auth->get_username()));
		$data['professorName'] = $this->user_model->get_name($data['listingArray']['username']);

		$this->load->view('templates/header');
		$this->load->view('content/inquire',$data);
	}
}
