<?php
class Endorse_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }


        //Gets the name of the school based on the school id
        public function get_endorsements_by_target($username = null){
            if($username == null){
                return null;
            }
            $query = $this->db->query("SELECT * FROM `endorsements` WHERE `target`='$username'");
            if($query->num_rows() > 0){
                return $query->row_array();
            }
        }


        public function get_endorsements_by_source($username = null){
            if($username == null){
                return null;
            }
        	$query = $this->db->query("SELECT * FROM `endorsements` WHERE `source`='$username'");
        	if($query->num_rows() > 0){
                return $query->row_array();
                
            }
        }
        //source and target MUST be usernames
        public function set_endorsement($source, $target, $message){
            $this->db->query("INSERT INTO `endorsements`(`source`, `target`, `message`) VALUES ('$source','$target','$message')");
        }

}
