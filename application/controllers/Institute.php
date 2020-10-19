<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Institute extends MY_Controller {

   public function __construct() {
        parent::__construct();
		
		 date_default_timezone_set('Asia/Karachi');

			 if($this->session->userdata('user_id')){
					 //
				}else{
				 redirect(base_url() . 'users/login');
			}
    }

   //Add Class ..........................................
   public function add_institute(){
	  
			   $this->header();
			  // $data['inst'] = $this->general->fetch_records("institutes");

			    $join_tables = array("districts" => "districts.id = institutes.districts_id");

			    $data['inst'] = $this->general->join_mutitple_table("institutes", $join_tables);

			   $data['district']  = $this->general->fetch_records("districts");
			   $this->load->view('generals/institute', $data);
			   $this->footer();
	   
   }
   //Insert into database................................
   public function create_ins(){            
		
		 extract($_POST);

              $dt = date("Y-m-d H:i:s");
				
				 if($this->input->post('ins_id') != "") {
                      // echo "updated";
                  $comapny_dataArray = array(
			
										"districts_id"               =>   $this->input->post('district'),
										"type"                       =>   $this->input->post('type'),
										"inst_name"                  =>   $this->input->post('ins_name'),
										"ddo_code"                   =>   $this->input->post('ddo_code'),
										"UPDATED_DATE"               =>   $dt,
										"UPDATED_USERID"             =>   $this->session->userdata('user_id')
					   
					   );

         		$this->general->update_record($comapny_dataArray, array("inst_id" => $ins_id),"institutes");

         		$this->general->set_msg("Record Updated Successfully",1);

				

				 }  else {
				 
				 //	echo "inserted";
				          
					   $comapny_dataArray = array(
					   
										"districts_id"               =>   $this->input->post('district'),
										"type"                       =>   $this->input->post('type'),
										"inst_name"                  =>   $this->input->post('ins_name'),
										"ddo_code"                   =>   $this->input->post('ddo_code'),
										"CREATED_DATE"               =>   $dt,
										"CREATED_USERID"             =>   $this->session->userdata('user_id')
					   
					   );

         			 $this->general->create_record($comapny_dataArray, "institutes");

     				 $this->general->set_msg("Record Added Successfully",1);
	

				 }

		
				 redirect(base_url().'institute/add_institute');
				   
   
   }
   
   //Delete Company from Database..................................
   public function delete_ins($id){
               
			   $whr             = array(
					      
						                "inst_id"         =>   $id
						  
					   );
               $this->general->delete_record("institutes", $whr);
               $this->general->set_msg('Deleted Successfully',3);
			   redirect(base_url().'institute/add_institute');
   
   }
   
   
   
   
   
   
   //Edit Class Form..........................................
   public function edit_class($class_id){
	  
			   $this->header();
			   $data['class_detail'] = $this->general->fetch_bysinglecol("CLASS_ID", "curriculum_class", $class_id);
			   $this->load->view('students/edit_class', $data);
			   $this->footer();
	   
   }
   //Update into database................................
   public function update_class(){
                       $dt              = date("Y-m-d H:i:s");
					   $class_dataArray = array(
					   
										"CLASS_NAME"         =>   $this->input->post('class_name'),
										"UPDATED_DATE"       =>   $dt,
										"UPDATED_USERID"     =>   $this->session->userdata("user_id") 
					   
					   );
					   $whr             = array(
					      
						                "CLASS_ID"         =>   $this->input->post('class_id')
						  
					   );
				 
				 $this->general->update_record($class_dataArray, $whr, "curriculum_class");
				 $this->session->set_flashdata('msg', 'Updated Successfully');
				 redirect(base_url().'students/add_class');
				   
   
   }
   
   
    //Add Class ..........................................
   public function add_section(){
	  
			   $this->header();
			   $data['section'] = $this->general->fetch_records("curriculum_section");
			   $this->load->view('students/add_section', $data);
			   $this->footer();
	   
   }
   
   
   //Insert into database................................
   public function create_section(){
   
				$dt        = date("Y-m-d H:i:s");
				
				//Upload Img and Get Name of Img....
				$maxId    = $this->general->find_maxid("SECTION_ID", "curriculum_section");
				foreach($maxId as $maxId_row){        $maxId_row->CLASS_ID;           } 
				
					   $section_dataArray = array(
					   
										"SECTION_ID"           =>   $maxId_row->SECTION_ID, 
										"SECTION_NAME"         =>   $this->input->post('section_name'),
										"CREATED_DATE"         =>   $dt,
										"CREATED_USERID"       =>   $this->session->userdata("user_id") 
					   
					   );
					   
				 $this->general->create_record($section_dataArray, "curriculum_section");
				 $this->session->set_flashdata('msg', 'Add Successfully');
				 redirect(base_url().'students/add_section');
				   
   
   }
   //Edit Section Form..........................................
   public function edit_section($section_id){
	  
			   $this->header();
			   $data['section_detail'] = $this->general->fetch_bysinglecol("SECTION_ID", "curriculum_section", $section_id);
			   $this->load->view('students/edit_section', $data);
			   $this->footer();
	   
   }
   //Update into database................................
   public function update_section(){
                       $dt              = date("Y-m-d H:i:s");
					   $class_dataArray = array(
					   
										"SECTION_NAME"         =>   $this->input->post('section_name'),
										"UPDATED_DATE"       =>   $dt,
										"UPDATED_USERID"     =>   $this->session->userdata("user_id") 
					   
					   );
					   $whr             = array(
					      
						                "SECTION_ID"         =>   $this->input->post('section_id')
						  
					   );
				 
				 $this->general->update_record($class_dataArray, $whr, "curriculum_section");
				 $this->session->set_flashdata('msg', 'Updated Successfully');
				 redirect(base_url().'students/add_section');
				   
   
   }
   //Delete Section from Database..................................
   public function delete_section($section_id){
               
			   $whr             = array(
					      
						                "SECTION_ID"         =>   $section_id
						  
					   );
               $this->general->delete_record("curriculum_section", $whr);
               $this->session->set_flashdata('msg', 'Deleted Successfully');
			   redirect(base_url().'students/add_section');
   
   }

		///////////////////////////////////////////////////////
		
		//                 SCHOOL FEE HEAD                   //
		
		//////////////////////////////////////////////////////
  
  
  
   //Add School Fee Head ..........................................
   public function add_schoolfeehead(){
	  
			   $this->header();
			   $data['feehead']  = $this->general->fetch_records("curriculum_feehead");
			   $data['coa_head'] = $this->general->fetch_CoustomQuery("SELECT * FROM coa_head WHERE SUB_CODE='00' AND TR_CODE='0000'");
			   $this->load->view('students/add_schoolfeehead', $data);
			   $this->footer();
	   
   }
   //Insert into database................................
   public function create_schoolfeehead(){
   
				$dt        = date("Y-m-d H:i:s");
				$maxId    = $this->general->find_maxid("FEEHEAD_ID", "curriculum_feehead");
				foreach($maxId as $maxId_row){        $maxId_row->FEEHEAD_ID;           } 
				
					   $feehead_dataArray = array(
					   
										"FEEHEAD_ID"           =>   $maxId_row->FEEHEAD_ID, 
										"FEEHEAD_NAME"         =>   $this->input->post('feehead_name'),
										"FEEHEAD_STATUS"       =>   'Active',
										"MAIN_CODE"            =>   $this->input->post('main_code'),
										"SUB_CODE"             =>   $this->input->post('sub_code'),
										"TR_CODE"              =>   $this->input->post('tr_code'),
										"CREATED_DATE"         =>   $dt,
										"CREATED_USERID"       =>   $this->session->userdata("user_id") 
					   
					   );
					   
				 $this->general->create_record($feehead_dataArray, "curriculum_feehead");
				 $this->session->set_flashdata('msg', 'Add Successfully');
				 redirect(base_url().'students/add_schoolfeehead');
				 
   
   }   
   //Edit SCHOOL FEE-HEAD Form..........................................
   public function edit_schoolfeehead($feehead_id){
	  
			   $this->header();
			   $data['schoolfeehead_detail'] = $this->general->fetch_bysinglecol("FEEHEAD_ID", "prm_schoolfeehead", $feehead_id);
			   $this->load->view('students/edit_schoolfeehead', $data);
			   $this->footer();
	   
   }
   //Update into database................................
   public function update_schoolfeehead(){
                       $dt              = date("Y-m-d H:i:s");
					   $feehead_dataArray = array(
					   
										"FEEHEAD_NAME"         =>   $this->input->post('feehead_name'),
										"FEEHEAD_STATUS"       =>   $this->input->post('feehead_status'),
										"UPDATED_DATE"         =>   $dt,
										"UPDATED_USERID"       =>   $this->session->userdata("user_id") 
					   
					   );
					   $whr             = array(
					      
										"FEEHEAD_ID"           =>   $this->input->post('feehead_id') 
						  
					   );
				 
				 $this->general->update_record($feehead_dataArray, $whr, "prm_schoolfeehead");
				 $this->session->set_flashdata('msg', 'Updated Successfully');
				 redirect(base_url().'students/add_schoolfeehead');
				   
   
   }

        ///////////////////////////////////////////////////////
		
		//             STUDENT INFORMATON                    //
		
		//////////////////////////////////////////////////////
  
  
  
   //Add School Fee Head ..........................................
   public function add_studentInfo(){
	  
			   $this->header();
			   $data['st_info'] = $this->general->fetch_records("student_information");
			   $data['class']   = $this->general->fetch_records("curriculum_class");
			   $data['section'] = $this->general->fetch_records("curriculum_section");
			   $this->load->view('students/add_studentinfo', $data);
			   $this->footer();
	   
   }
   //Insert into database................................
   public function create_studentInfo(){
   
				$dt        = date("Y-m-d H:i:s");
				$maxId    = $this->general->find_maxid("STUDENT_ID", "student_information");
				foreach($maxId as $maxId_row){        $maxId_row->STUDENT_ID;           } 
				
					   $student_dataArray = array(
					   
										"STUDENT_ID"	         =>   $maxId_row->STUDENT_ID,
										"STUDENT_NAME"	         =>   $this->input->post('STUDENT_NAME'),
										"STUDENT_FNAME"          =>   $this->input->post('STUDENT_FNAME'),
										"STUDENT_ADDRESS"        =>   $this->input->post('STUDENT_ADDRESS'),
										"STUDENT_GENDER"	     =>   $this->input->post('STUDENT_GENDER'),
										"STUDENT_CELL"	         =>   $this->input->post('STUDENT_MOBILE_NO'),
										"ADDMISSION_NO"	         =>   $this->input->post('ADDMISSION_NO'),
										"ROLL_NO"	             =>   $this->input->post('ROLL_NO'),
										"CLASS_ID"	             =>   $this->input->post('CLASS_ID'),
										"SECTION_ID"	         =>   $this->input->post('SECTION_ID'),
										"DOB"	                 =>   $this->input->post('DOB'),
										"ADDMISSION_DATE"	     =>   $this->input->post('ADDMISSION_DATE'),
										"STUDENT_EMAIL"          =>   $this->input->post('STUDENT_EMAIL'),
										"FATHER_OCCUPATION"      =>   $this->input->post('FATHER_OCCUPATION'),
										"FATHER_MOBILE_NO"	     =>   $this->input->post('FATHER_MOBILE_NO'),
										"STUDENT_MNAME"	         =>   $this->input->post('STUDENT_MNAME'),
										"MOTHER_OCCUPATION"	     =>   $this->input->post('MOTHER_OCCUPATION'),
										"MOTHER_MOBILE_NO"       =>   $this->input->post('MOTHER_MOBILE_NO'),
										"STUDENT_GUARDIAN_NAME"	 =>   $this->input->post('STUDENT_GUARDIAN_NAME'),
										"GUARDIAN_OCCUPATION"	 =>   $this->input->post('GUARDIAN_OCCUPATION'),
										"GUARDIAN_MOBILE_NO"     =>   $this->input->post('GUARDIAN_MOBILE_NO'),
										"RELIGION"	             =>   $this->input->post('RELIGION'),
										"CREATED_DATE"           =>   $dt,
										"CREATED_USERID"         =>   $this->session->userdata("user_id")
										
					   
					   );
					   
					   
					   
				 $this->general->create_record($student_dataArray, "student_information");
				 $this->session->set_flashdata('msg', 'Add Successfully');
				 redirect(base_url().'students/add_studentInfo');
				 
   
   }   
   
   
   
   
     //Student Details ..........................................
   public function detail(){
	  
			   $this->header();
			   $data['st_info'] = $this->general->fetch_records("student_information");
			   $data['class'] = $this->general->fetch_records("curriculum_class");
			   $data['section'] = $this->general->fetch_records("curriculum_section");
			   $this->load->view('students/student_detail', $data);
			   $this->footer();
	   
   }
   
   
     //Search Student Details ..........................................
   public function search_student_detail(){
	  
	  
	           $CLASS_ID	             =   $this->input->post('CLASS_ID');
	           $data['CLASS_ID']         =   $this->input->post('CLASS_ID');
			   $SECTION_ID	             =   $this->input->post('SECTION_ID');
			   $data['SECTION_ID']       =   $this->input->post('SECTION_ID');
	  
	           
			   $data['student_list'] = $this->general->fetch_CoustomQuery("SELECT * FROM student_information WHERE CLASS_ID = '$CLASS_ID' AND SECTION_ID='$SECTION_ID'"); 
			   $this->header();
			   $data['class'] = $this->general->fetch_records("curriculum_class");
			   $data['section'] = $this->general->fetch_records("curriculum_section");
			   $data['students'] = $this;
			   $this->load->view('students/search_student_detail', $data);
			   $this->footer();
	   
   }
   
    //Delete Class from Database..................................
   public function delete_student($std_id){
               
			   $whr             = array(
					      
						                "STUDENT_ID"         =>   $std_id
						  
					   );
               $this->general->delete_record("student_information", $whr);
               $this->session->set_flashdata('msg', 'Deleted Successfully');
			   redirect(base_url().'students/detail');
			   
			   
			   
			   
			   
   
   }
   
   //Edit Student Infomartion Form..........................................
   public function edit_studentInfo($st_id){
	  
			   $this->header();
			   $data['st_detail'] = $this->General->fetch_bysinglecol("STUDENT_ID", "student_information", $st_id);
			   $this->load->view('students/edit_studentinfo', $data);
			   $this->footer();
	   
   }
   //Update into database................................
   public function update_studentInfo(){
                       $dt              = date("Y-m-d H:i:s");
					   $student_dataArray = array(
					   
										"STUDENT_NAME"           =>   $this->input->post('st_name'),
										"STUDENT_FNAME"          =>   $this->input->post('st_fname'),
										"STUDENT_ADDRESS"        =>   $this->input->post('st_address'),
										"STUDENT_GENDER"         =>   $this->input->post('st_gender'),
										"STUDENT_CELL"           =>   $this->input->post('st_cell'),
										"UPDATED_DATE"           =>   $dt,
										"UPDATED_USERID"         =>   $this->session->userdata("user_id") 
					   
					   );
					   $whr             = array(
					      
										"STUDENT_ID"             =>   $this->input->post('student_id') 
						  
					   );
				 
				 $this->general->update_record($student_dataArray, $whr, "student_information");
				 $this->session->set_flashdata('msg', 'Updated Successfully');
				 redirect(base_url().'students/add_studentInfo');
   
   }
         ///////////////////////////////////////////////////////
		
		 //             ADD FEEHEAD IN CLASS                  //
		
		 //////////////////////////////////////////////////////
	public function add_feeheadInclass(){ 
	
	           $this->header();
			   //$data['st_info'] = $this->General->fetch_records("student_information");
			   $this->load->view('students/add_feeheadInclass');
			   $this->footer();
			   
	}	 
		 
		  
         ///////////////////////////////////////////////////////
		
		 //             ADD STUDENT IN CLASS                  //
		
		 //////////////////////////////////////////////////////
   
   //Add Student In Class .............................................................
   public function add_studentclassdetail(){
	  
			   $this->header();
			   $data['class']   = $this->general->fetch_records("prm_class");
			   $data['st_info'] = $this->general->fetch_records("student_information");
			   //$data['st_classdetail'] = $this->General->fetch_records("student_class_detail");
			   $this->load->view('students/add_studentclassdetail', $data);
			   $this->footer();
	   
   }
   
 public function fetch_bysinglecoldetail($col, $tbl, $id){
        
         $where = array(
            $col => $id
        );

        $this->db->select()->from($tbl)->where($where);
        $query = $this->db->get();
        return $result = $query->result();
    }
   
   
 public function sendSMS($CLASS_ID, $SECTION_ID, $action, $student_id){
	 
	 
	    $this->header();

         //SEND SMS TO ALL;

        if($action == "ALL"){
			 $data['student_nos'] = $this->general->fetch_CoustomQuery("SELECT * FROM student_information WHERE CLASS_ID = '$CLASS_ID' AND SECTION_ID='$SECTION_ID'"); 
			 $this->load->view('students/sendSMSALL', $data);


			
		}	
		
		
		if($action == "SINGLE"){
			 $data['student_no'] = $this->general->fetch_CoustomQuery("SELECT FATHER_MOBILE_NO FROM student_information WHERE STUDENT_ID = '$student_id'"); 
			 $this->load->view('students/sendSMS', $data);
			
		}	
		
	    $this->footer();
	   
	 
 }
 
 
  
  
  public function sendTEXTsingle(){

  
        $mobile_no  =   $this->input->post('mobile_no');
        $text       =   $this->input->post('messageBody');
            
			
		 //file_get_contents('https://bulksms.vsms.net/eapi/submission/send_sms/2/2.0?username=sameerali355&password=khansam123&message='.$text.'&msisdn='.$mobile_no);
		 redirect('https://bulksms.vsms.net/eapi/submission/send_sms/2/2.0?username=sameerali355&password=khansam123&message='.$text.'&msisdn='.$mobile_no);
  
	  
  }
 
 
 
  public function sendTEXTAll(){

  
        $mobile_no  =   $this->input->post('mobile_no');
        $text       =   $this->input->post('messageBody');
            
			
		 //file_get_contents('https://bulksms.vsms.net/eapi/submission/send_sms/2/2.0?username=sameerali355&password=khansam123&message='.$text.'&msisdn='.$mobile_no);
		 redirect('https://bulksms.vsms.net/eapi/submission/send_sms/2/2.0?username=sameerali355&password=khansam123&message='.$text.'&msisdn='.$mobile_no);
  
	  
  }
 
  
  public function get_ins() {
  	 
  	  extract($_POST);
  	  
   	 $qry = $this->general->fetch_bysinglecol("inst_id", "institutes", $c_id);

  	  $data_events;
      
     
           foreach($qry as $result):
          
          $data_events[] = array(
             "inst_name"             => $result->inst_name,
             "ddo_code"              => $result->ddo_code,
             "type"                  => $result->type,
             "districts_id"          => $result->districts_id,
             "inst_id"               => $result->inst_id
            ); 


        endforeach;           
     
         
         print json_encode($data_events);
  

  }

 
}



?>