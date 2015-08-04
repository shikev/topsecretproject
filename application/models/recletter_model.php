<?php
class Recletter_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }


        //Gets the name of the school based on the school id
        public function get_letter_by_target($username = null){
            if($username == null){
                return null;
            }
            $query = $this->db->query("SELECT * FROM `recletters` WHERE `target`='$username'");
            if($query->num_rows() > 0){
                return $query->row_array();
            }
        }


        public function get_letter_by_source($username = null){
            if($username == null){
                return null;
            }
        	$query = $this->db->query("SELECT * FROM `recletters` WHERE `source`='$username'");
        	if($query->num_rows() > 0){
                return $query->row_array();
                
            }
        }
        //source and target must be usernames
        public function set_recletter($source, $target, $filename){
            $this->db->query("INSERT INTO `recletters`(`source`, `target`, `message`) VALUES ('$source','$target','$filename')");
        }

}
