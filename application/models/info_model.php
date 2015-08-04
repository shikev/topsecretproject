<?php
class Info_model extends CI_Model {

        public function __construct()
        {
            $this->load->model('user_model');
            $this->load->model('request_model');
        }

        public function prepare_prof_data(){
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

        public function prepare_user_data(){
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
            return $data;
        }
        

}
