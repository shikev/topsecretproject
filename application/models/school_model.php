<?php
class School_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }


        //Gets the name of the school based on the school id
        public function get_school_name($schoolid = 1){
            $query = $this->db->query("SELECT `school` FROM `schools` WHERE `id`=$schoolid LIMIT 1");
            return $query->row(0)->school;
        }

        public function check_valid($domain){
        	$query = $this->db->query("SELECT `school` FROM `schools` WHERE `extension`='$domain'");
        	if($query->num_rows() == 0){
        		return false;
        	}
        	else{
        		return true;
        	}
        }

        public function get_school_by_ext($ext){
            $query = $this->db->query("SELECT id FROM `schools` WHERE `extension`='$ext' LIMIT 1");
            if($query->num_rows() == 0){
                $entry = $query->row_array();
                var_dump($entry);
                echo $break;
                return $entry['id'];
            }
            else{
                return null;
            }
        }


}
