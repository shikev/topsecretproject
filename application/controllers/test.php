<?php
class Test extends CI_Controller{
	public function __construct()
	{
		parent::__construct();

		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		//$this->load->library('security');
		$this->load->library('tank_auth');
		$this->lang->load('tank_auth');
	}

	public function index(){
		
		$this->load->view('testing');

	}
}
