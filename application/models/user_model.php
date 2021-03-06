<?php
class User_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
                $this->load->library('tank_auth');
        }

        public function set_user($username = null, $email = null){
        	if($username == null){
        	       return null;
        	}
            $domain = substr(strrchr($email, "@"), 1);
            $query = $this->db->query("SELECT `id` FROM `schools` WHERE `extension`='$domain' LIMIT 1");
            //var_dump("SELECT `id` FROM `schools` WHERE `extension`='$domain' LIMIT 1");
            if($query->num_rows() != 0){
                $row = $query->row_array();
                $schoolid = $row['id'];
            }

           // $this->db->query("sejfioejaioah");
        	$query = $this->db->query("INSERT INTO `userinfo`(`username`,`email`, `usertype`, `school`) VALUES('$username','$email', 'user', $schoolid);");
        }

        public function set_usertype($usertype = null){
		    // $data = array(
		    //     'xmlinfo' => $xmlIn
		    // );

		    // return $this->db->update('userpages', $data);

                $data = array('usertype' => '$usertype');
                return $this->db->update('userinfo', $data, array('username'=>$this->tank_auth->get_username()));
        }

        public function set_name($name = null){
                $data = array('name' =>$name);
                $this->db->update('userinfo', $data, array('username'=>$this->tank_auth->get_username()));
                //return $this->db->update('userinfo', $data, array('username'=>'$username'));
        }

        public function set_email($email = null){
                $data = array('email' =>$email);
                $this->db->update('userinfo', $data, array('username'=>$this->tank_auth->get_username()));
        }

        public function set_phone($phone = null){
                $data = array('phonenumber' =>$phone);
                $this->db->update('userinfo', $data, array('username'=>$this->tank_auth->get_username()));
        }

        public function get_usertype($username = null){
                if($username != null){
                        $query = $this->db->query("SELECT `usertype` FROM `userinfo` WHERE `username`='$username' LIMIT 1;");
                        if($query->num_rows() > 0){
                                $row = $query->row_array();
                                return $row['usertype'];
                        }
                }
        }

        public function get_username_by_email($email = null){
            if($email != null){
                        $query = $this->db->query("SELECT `username` FROM `userinfo` WHERE `email`='$email' LIMIT 1;");
                        if($query->num_rows() > 0){
                                $row = $query->row_array();
                                return $row['username'];
                        }
                }
            else{
                return null;
            }
        }

        public function get_name($username = null){
                if($username != null){
                      $query = $this->db->query("SELECT `name` FROM `userinfo` WHERE `username`='$username' LIMIT 1;");
                        if($query->num_rows() > 0){
                                $row = $query->row_array();
                                return $row['name'];
                        }  
                }
                else{
                    return null;
                }
        }

        public function get_email($username = null){
                if($username != null){
                   $query = $this->db->query("SELECT `email` FROM `userinfo` WHERE `username`='$username' LIMIT 1;");
                        if($query->num_rows() > 0){
                                $row = $query->row_array();
                                return $row['email'];
                        }     
                }
                else{
                    return null;
                }
        }

        public function get_school($username = null){
                if($username != null){
                   $query = $this->db->query("SELECT `school` FROM `userinfo` WHERE `username`='$username' LIMIT 1;");
                        if($query->num_rows() > 0){
                                $row = $query->row_array();
                                return $row['school'];
                        }     
                }
                else{
                    return null;
                }
        }

        public function get_phonenumber($username = null){
                if($username != null){
                   $query = $this->db->query("SELECT `phonenumber` FROM `userinfo` WHERE `username`='$username' LIMIT 1;");
                        if($query->num_rows() > 0){
                                $row = $query->row_array();
                                return $row['phonenumber'];
                        }     
                }
                else{
                    return null;
                }
        }

        public function get_extrainfo($username = null){
                if($username == false){
                       return null;
                }

                $query = $this->db->query("SELECT `extrainfo` FROM `userinfo` WHERE `username` = '$username'");
                if($query->num_rows() == 0){
                        //creates a user profile if one doesn`t exist
                        // $this->db->query("INSERT INTO `userpages`(`username`, `xmlinfo`) VALUES('$username', '')");
                        // $query = $this->db->query("SELECT `xmlinfo` FROM `userpages` WHERE `username` = '$username'");
                        return false;
                }
                $row = $query->row_array();
                return $row['extrainfo'];
        }

        public function set_extrainfo($xmlIn){
            // $query = $this->db->query("SELECT `userinfo` FROM `userpages` WHERE `username` = '$this->tank_auth->get_username()'");
            // if($query->num_rows() == 0){
            //             //should not reach here, if it does we fucked up
            //              return null;
            // }
                $data = array(
                    'extrainfo' => $xmlIn
                );
                $where = array('username'=>$this->tank_auth->get_username());
                $this->db->update('userinfo', $data, $where);
        }

        public function search_professors($itemArray, $school){
            $qrystring = "SELECT * FROM `userinfo` WHERE `school`='$school' AND `usertype`='professor'";
            for($i = 0; $i < count($itemArray); $i++){
                $qrystring = $qrystring . ' AND `name` LIKE \'%' . $itemArray[$i] . '%\'';
            }
            $query = $this->db->query($qrystring);
            return $query->result_array();
        }

        public function search_users($itemArray, $school){
            $qrystring = "SELECT * FROM `userinfo` WHERE `school`='$school'";
            for($i = 0; $i < count($itemArray); $i++){
                $qrystring = $qrystring . ' AND `name` LIKE \'%' . $itemArray[$i] . '%\'';
            }
            $query = $this->db->query($qrystring);
            return $query->result_array();
        }

}
