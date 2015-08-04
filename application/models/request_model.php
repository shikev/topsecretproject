<?php
class Request_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }


        //Gets the name of the school based on the school id
        public function get_requests_by_target($username = null){
            if($username == null){
                return null;
            }
            $query = $this->db->query("SELECT * FROM `requests` WHERE `target`='$username'");
            if($query->num_rows() > 0){
                return $query->result_array();
            }
        }


        public function get_requests_by_source($username = null){
            if($username == null){
                return null;
            }
            $query = $this->db->query("SELECT * FROM `requests` WHERE `source`='$username'");
            if($query->num_rows() > 0){
                return $query->result_array();
                
            }
        }
        //source and target MUST be usernames
        public function set_request($source, $target, $message, $type){
            $this->db->query("INSERT INTO `requests`(`source`, `target`, `message`,`type`) VALUES ('$source','$target','$message','$type')");
        }

}
