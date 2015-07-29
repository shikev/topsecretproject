<?php
class Listing_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }

        public function create_listing($name, $reqs, $description, $pay, $time, $school, $username, $categories){
            $this->db->query("INSERT INTO `listings`(`name`, `requirements`, `description`, `pay`, `workschedule`, `school`, `username`) VALUES ('$name', '$reqs', '$description', '$pay', '$time', '$school', '$username');");
            for($i = 0; $i < count($categories); ++$i){
                if($categories[$i] == 'true'){
                    $this->db->query("INSERT INTO `listing_categories`(`listing_id`, `category`) VALUES (LAST_INSERT_ID(),$i)");
                }
            }
            

        }
        //Gets all the listings for a specific school
        public function get_listings($school){
            $query = $this->db->query("SELECT * FROM `listings` WHERE `school`='$school'");
            return $query->result_array();
        }

        public function search($itemArray, $school){
            $qrystring = "SELECT * FROM `listings` WHERE `school`='$school'";
            for($i = 0; $i < count($itemArray); $i++){
                $qrystring = $qrystring . ' AND `name` LIKE \'%' . $itemArray[$i] . '%\'';
            }
            var_dump($qrystring);
            $query = $this->db->query($qrystring);
            return $query->result_array();
        }

}
