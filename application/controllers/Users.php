<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Users extends My_controller {

    public function __construct() {
        parent::__construct();
      

    }

	
    public function login() {
       
     
        $this->load->view('users/login');
		
    }
	 
	 public function Logout() {
	 
         $this->user->logout();
		 
    }


    public function login_authen() {

        $email    = $this->input->post('u_email');
        $password = $this->input->post('u_password');
         // exit();
        $login    = $this->user->AuthLogin($email, $password);
			 
			 if($login){
					
						//DEFINE, VARIABLES IN SESSIONS.................
						$this->session->set_userdata("user_id",  $login['USER_ID']);	
						$this->session->set_userdata("group_id", $login['GROUP_ID']);	
						$this->session->set_userdata("username", $login['USER_NAME']);	
					//	$this->session->set_userdata("ins_id", $login['INS_ID']);
						
					
							//Set Admin View & Other users.....
							 if($login['GROUP_ID'] == 1){
							 
								   redirect(base_url() . 'dashboard');
							 
							 }else{
							 
								  redirect(base_url() . 'dashboard');
								  
							 }
					
				} else {

				   $this->session->set_flashdata('msg', 'Username & Password is Invalid');
				   redirect(base_url() . 'users/login');
				
				}
		
		
    }

	//Load View Form For User Creation.........
	public function add_user(){
	
	    //Get employee list for drop down menu..................................
	    $data['ins'] = $this->general->fetch_records("clinic_profile");
	    $data['grouplist']    = $this->general->fetch_records("usr_group");
        //Get user's list........................................................
		$data['userlist']     = $this->general->fetch_CoustomQuery("SELECT uu.*, i.clinic_name, ug.GROUP_NAME 
								FROM 
								`usr_user` as uu, clinic_profile as i, usr_group as ug 
								WHERE
								uu.`GROUP_ID` = ug.GROUP_ID
								AND
								uu.`INS_ID` = i.clinic_id");
        $this->header();
        $this->load->view('users/add_user', $data);
        $this->footer();
	
	}
	
	//Get values and Create User................
	public function create_user() {

        $record    = $this->general->fetch_maxid("usr_user");
        foreach ($record as $record) {  $MaxGroup = $record->USER_ID; }
        $user_no   = $MaxGroup + 1;
        $dt        = date("Y-m-d H:i:s");
        
        $userid    = $this->session->userdata('user_id');
        $password  = md5($this->input->post('password'));
        $username  = $this->input->post('username');
		  
		$whr_grp   = array("INS_ID" => 1,"GROUP_ID" => $this->input->post('group'));
		
		$validate_grp = $this->general->validate_bymultipleconditions("usr_user",$whr_grp);
		 
		if($validate_grp == 1 ) {
			$this->general->set_msg('Account already exist of the selected Institute and Group !',2);
			redirect(base_url()."users/add_user");
		}

		

        $validate = $this->general->validate_value("USER_NAME","usr_user",$username);
     
           if($validate == 0 ) {

         	$data_user = array(
				 
				 'USER_ID'            => $user_no,
				 "USER_NAME"          => $username,
				 "U_PASSWORD"         => $password,
				 "GROUP_ID"           => $this->input->post('group'),
				 "IS_ACTIVE"          => 1,
				 "INS_ID"             => 1,
				 "CREATED_DATE"       => $dt,
				 "CREATED_USERID"     => $userid
			 
			 );
			 
				$this->db->insert('usr_user', $data_user); 
				$this->general->set_msg('User Added Successfully',1);

            } else {
		
               $this->general->set_msg('Username already exist',2);               
				
            }
          
          redirect(base_url()."users/add_user");
    
    }
    

   public function reset_pass($id,$username) {
     
     $pass = md5("12345678");

     $update = array("U_PASSWORD" => $pass );
     $whr    = array("USER_ID" => $id);

       $this->general->update_record($update,$whr,"usr_user");

       $this->general->set_msg("The password has been reset to default for username : {$username}", 3);

       redirect(base_url()."users/add_user");   


   }

   public function change_password() {
    if(!$this->session->userdata('user_id')){ 
        
        	 redirect(base_url() . 'users/login');

       }
         $this->header();
			  // $data['inst'] = $this->general->fetch_records("institutes");
	      $this->load->view('users/change_password');
	
	    $this->footer();


   }
   
   
   public function edit_password() {
     
    extract($_POST);
     
    $username = $this->session->userdata("username");

     $whr = array(
                   "USER_NAME"  => $this->session->userdata("username"),
                   "U_PASSWORD" => md5($this->input->post('old_password'))
     	         );

    $validate = $this->general->validate_bymultipleconditions("usr_user",$whr);
   
    
	    if($validate == 0 ) {

	         $this->general->set_msg('The current password is incorrect ! Please enter correct password',2);

	     
	    } else {
		 
		  	$data_user = array(
					 
					 "U_PASSWORD"         => md5($this->input->post('new_password')),
					 "UPDATED_DATE"       => date("Y-m-d H:i:s"),
					 "UPDATED_USERID"     => $this->session->userdata('user_id')
				 
				 );
				 
					$this->general->update_record($data_user,array("USER_NAME" => $this->session->userdata('username')),'usr_user'); 
					$this->general->set_msg('Password Updated Successfully',1);	
	                      
					
	    } 
    

      redirect(base_url()."users/change_password");


    } 

  
  


}  // end of class
 
?>