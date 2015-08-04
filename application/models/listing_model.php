<?php
class Listing_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }

        public function create_listing($name, $reqs, $description, $time, $school, $username, $categories){
            $this->db->query("INSERT INTO `listings`(`name`, `requirements`, `description`, `workschedule`, `school`, `username`) VALUES ('$name', '$reqs', '$description', '$time', '$school', '$username');");
            for($i = 0; $i < count($categories); ++$i){
                if($categories[$i] == 'true'){
                    $this->db->query("INSERT INTO `listing_categories`(`listing_id`, `category`) VALUES (LAST_INSERT_ID(),$i)");
                }
            }
        }

        public function update($name, $reqs, $description, $time, $school, $username, $categories, $id){
            $this->db->query("UPDATE `listings` SET `name`='$name', `requirements`='$reqs',`description`='$description',
                `workschedule`='$time',`school`=$school,`username`='$username' WHERE `id`=$id");
            $this->db->query("DELETE FROM `listing_categories` WHERE `listing_id`=$id");
            for($i = 0; $i < count($categories); ++$i){
                if($categories[$i] == 'true'){
                    $this->db->query("INSERT INTO `listing_categories`(`listing_id`, `category`, `school_id`) VALUES ($id,$i,$school)");
                }
            }
        }

        public function prep_update($id){
            $query = $this->db->query("SELECT * FROM `listings` WHERE `id`=$id LIMIT 1");
            if($query->num_rows() > 0){
                return $query->row_array();
            }
            else{
                return null;
            }
        }
        

        public function get_listing_by_id($id, $schoolid){
            $query = $this->db->query("SELECT * FROM `listings` WHERE `school`=$schoolid AND `id`=$id LIMIT 1");
            if($query->num_rows() > 0){
                return $query->row_array();
            }
            else{
                return null;
            }
        }

        
        //Gets all the listings for a specific school
        public function get_listings($school){
            $query = $this->db->query("SELECT * FROM `listings` WHERE `school`=$school");
            return $query->result_array();
        }

        public function get_listings_by_category($categories, $schoolid){
            $querystr = null;
            $count = 0;
            for($i = 0; $i < count($categories); ++$i){

                if($categories[$i] == 'true'){
                    if($count == 0){
                        $querystr = "SELECT DISTINCT `listing_id` FROM `listing_categories` WHERE `school_id`='$schoolid' AND (`category`='$i'";
                        $count = 1;
                    }
                    else{
                        $querystr = $querystr . " OR `category`='$i'";
                    }
                }
            }

            if($querystr != null){
                $querystr = $querystr . ')';
                $query = $this->db->query($querystr);
                 var_dump($query->result_array());
                $listings = array();
                $listingids = $query->result_array();
                
                foreach($listingids as $id){

                    $lid = $id['listing_id'];
                    $query = $this->db->query("SELECT * FROM `listings` WHERE `id`='$lid' LIMIT 1");
                    var_dump($query->num_rows());
                    if($query->num_rows > 0){
                        array_push($listings, $query->result_array()[0]);
                    }
                    

                }

                return $listings;
            }
            else{
                return null;
            }
            
        }

        public function get_listings_by_username($username = null){
            if($username == null){
                return null;
            }
            else{
                $query = $this->db->query("SELECT * FROM `listings` WHERE `username`='$username'");
               
                return $query->result_array();
            }
        }

        public function search($itemArray, $school){
            $qrystring = "SELECT * FROM `listings` WHERE `school`='$school'";
            for($i = 0; $i < count($itemArray); $i++){
                $qrystring = $qrystring . ' AND `name` LIKE \'%' . $itemArray[$i] . '%\'';
            }
            $query = $this->db->query($qrystring);
            return $query->result_array();
        }

}
