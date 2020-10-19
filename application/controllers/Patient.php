<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Patient extends MY_Controller {

   public function __construct() {
        parent::__construct();
		
		 date_default_timezone_set('Asia/Karachi');

			 if($this->session->userdata('user_id')){
					 //
				}else{
				 redirect(base_url() . 'users/login');
			}
    }


 public function info() {
     
    $this->header();
      
     // $data['patient'] = $this->general->get_record('patient', "patient_id DESC");
    

      $this->load->view('patient/info');
    
    
    $this->footer();

 }

  

 function fetch_user(){  
 
   $this->load->model("crud_model");  
   $data = $row = array();
        
        // Fetch member's records
        $memData = $this->crud_model->getRows($_POST);
        
        $i = $_POST['start'];
        foreach($memData as $member){
            
             if($this->session->userdata("group_id") == 1 || $this->session->userdata("group_id") == 2 ) {
                $hist = '<a href="'.base_url().'patient/patient_history/'.$member->patient_id.'"  class="btn btn-link btn-primary btn-just-icon"><i class="fa fa-history"></i></a>';
               } else {
                 $hist = "";
               }
          
            $i++;
            $m = "'".$member->patient_name."'";
            $edit = '<a onClick="updateInfo('.$member->patient_id.');" class="btn btn-link btn-warning btn-just-icon edit"> <i class="fa fa-edit"></i>
            <a onClick="fetch_id('.$member->patient_id.' , '.$m.')";  data-toggle="modal" data-target="#myModal" class="btn btn-link btn-info btn-just-icon edit"> <i class="fa fa-user-md"></i> '.$hist; 
            $pat_id = "MC-".$member->patient_id;
            $data[] = array($i, $pat_id, $member->patient_name, $member->patient_gender, $member->patient_age, $member->patient_phone, $member->patient_address, $edit);
        }
        
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->crud_model->countAll(),
            "recordsFiltered" => $this->crud_model->countFiltered($_POST),
            "data" => $data,
        );
        
        // Output to JSON format
        echo json_encode($output);
   }  



 public function get_info() {
   extract($_POST);
    
   $qry = $this->general->fetch_bysinglecol("patient_id", "patient", $c_id);

   $data_events;
  
 
       foreach($qry as $result):
      
      $data_events[] = array(
         "patient_name"           => $result->patient_name,
         "patient_gender"         => $result->patient_gender,
         "patient_age"            => $result->patient_age,
         "patient_phone"          => $result->patient_phone,
         "patient_address"        => $result->patient_address,
         "patient_id"             => $result->patient_id
        ); 


    endforeach;           
 
     
     print json_encode($data_events);


 }

 public function add_patient(){            
		
   extract($_POST);

          $dt = date("Y-m-d H:i:s");
        
         if($this->input->post('pat_id') != "") {
                  // echo "updated";
              $comapny_dataArray = array(
     
                          "patient_name"               =>   $this->input->post('p_name'),
                          "patient_gender"             =>   $this->input->post('gender'),
                          "patient_age"                =>   $this->input->post('age'),
                          "patient_phone"              =>   $this->input->post('phone'),
                          "patient_address"            =>   $this->input->post('address'),
                          "UPDATED_DATE"               =>   $dt,
                          "UPDATED_USERID"             =>   $this->session->userdata('user_id')
              
              );

           $this->general->update_record($comapny_dataArray, array("patient_id" => $pat_id),"patient");

           $this->general->set_msg("Record Updated Successfully",1);

        

         }  else {
         
         //	echo "inserted";
                  
              $comapny_dataArray = array(
              
                           "patient_name"               =>   $this->input->post('p_name'),
                           "patient_gender"             =>   $this->input->post('gender'),
                           "patient_age"                =>   $this->input->post('age'),
                           "patient_phone"              =>   $this->input->post('phone'),
                           "patient_address"            =>   $this->input->post('address'),
                           "CREATED_DATE"               =>   $dt,
                           "CREATED_USERID"             =>   $this->session->userdata('user_id')
              
              );

               $this->general->create_record($comapny_dataArray, "patient");

              $this->general->set_msg("Record Added Successfully",1);


         }
  
         redirect(base_url().'patient/info');
           

}


function make_appointment(){
   
  extract($_POST);
     
    $data = array (
                      "patient_id"     => $pat_id,
                      "app_date"       => date("Y-m-d",strtotime($this->input->post('app_date'))),
                      "app_time"       => date("H:i",strtotime($this->input->post('app_time'))),
                      "app_status"     => 0,
                      "CREATED_DATE"   => date("Y-m-d H:i:s"),
                      "CREATED_USERID" => $this->session->userdata('user_id')
                  );

  $this->general->create_record($data, "appointment");

  if ($this->db->affected_rows() >= 1) {
       print json_encode("true");
    } else {
      print json_encode("false");
   }    

}


  public function appointment() {
      
    $this->header();
      
     $data['patient'] = $this->general->fetch_CoustomQuery("SELECT * FROM `patient` as p, appointment as ap 
     WHERE p.`patient_id` = ap.patient_id AND ap.app_status = 0 order by ap.app_id ASC");
         
     $this->load->view('patient/appointment_list',$data);
   
   
   $this->footer();

  }
 
   
  public function review($app_id, $pat_id = NULL) {
     
    $this->header();
      
    $data['patient_info'] = $this->general->fetch_CoustomQuery("SELECT * FROM `patient` as p, appointment as ap 
                            WHERE
                            p.`patient_id` = ap.patient_id
                            AND
                            ap.app_id = $app_id");

      
     $whr = array("app_status" => 1, "app_med_status" => 1, "patient_id" => $pat_id);

     $data['pat_hist'] = $this->general->fetchby_multiplecolumns("appointment", $whr);   

     $data['controller'] = $this;
                                
    $this->load->view('patient/doctor_review',$data);
  
  
  $this->footer();


  }


   public function get_symptoms() {
     
   $data_events;
    $results = $this->db->like("symptoms",$_REQUEST['keyword'])->get("symptoms",10)->result();
  
     foreach($results as $result):
      
      $data_events[] = array(
        "name"           => $result->symptoms,
        "id"             => $result->symp_id,
        "exist"          => "old"
       ); 
               
     endforeach;
     
     $data_events[] = array(  
      "name"           => $_REQUEST['keyword'],
      "id"             => $_REQUEST['keyword'],
      "exist"          => "new"
     ); 

     
    if(empty($data_events)) {
      $data_events[] = array(  
            "name"           => $_REQUEST['keyword'],
            "id"             => $_REQUEST['keyword'],
            "exist"          => "new"
        );
      }

  
    echo json_encode($data_events);

   }
   
public function get_prescription() {
  
  $data_events;
  $results = $this->db->like("prescription",$_REQUEST['keyword'])->get("prescription",10)->result();

   foreach($results as $result):

    $data_events[] = array(
      "name"           => $result->prescription,
      "id"             => $result->pres_id,
      "exist"          => "old"
     ); 
             
   endforeach; 
    
   $data_events[] = array(  
    "name"           => $_REQUEST['keyword'],
    "id"             => $_REQUEST['keyword'],
    "exist"          => "new"
    );
   
  if(empty($data_events)) {
    $data_events[] = array(  
          "name"           => $_REQUEST['keyword'],
          "id"             => $_REQUEST['keyword'],
          "exist"          => "new"
      );
    }


  echo json_encode($data_events);


}

   public function add_checkup() {
       extract($_POST);
      //  echo "<pre>";
      //  print_r($_POST);

      $sym = explode(",",$symptom);
      $pres = explode(",",$prescription); 


      // insertion in patient_symptoms_history
       foreach($sym as $val):
            
             if(is_numeric($val) ==  1 ) {
                // echo $val. " number ";
               $data[] = array(
                             "app_id"          => $app_id,
                             "symp_id"         => $val,
                             "CREATED_DATE"    => date("Y-m-d H:i:s"),
                             "CREATED_USERID"  => $this->session->userdata('user_id')
                            );
                            
                } else {
                 // echo $val. " stri ";
                 // first insertion in symptoms table, get the id then

               $this->general->create_record(array("symptoms" => $val),"symptoms");

               $new_id = $this->db->insert_id();

               $data_s = array(
                            "app_id"          => $app_id,
                            "symp_id"         => $new_id,
                            "CREATED_DATE"    => date("Y-m-d H:i:s"),
                            "CREATED_USERID"  => $this->session->userdata('user_id')
                           );

               $this->general->create_record($data_s, "patient_symptoms_history");  

             }

       endforeach; 

       if(!empty($data)) {
       
         $this->db->insert_batch('patient_symptoms_history', $data); 
       
       }
        
       // insertion in patient_prescription_history
        foreach($pres as $p_val):
            
          if(is_numeric($p_val) ==  1 ) {
             // echo $val. " number ";
            $data_p[] = array(
                          "app_id"          => $app_id,
                          "pres_id"         => $p_val,
                          "CREATED_DATE"    => date("Y-m-d H:i:s"),
                          "CREATED_USERID"  => $this->session->userdata('user_id')
                         );

             } else {
              // echo $val. " stri ";
              // first insertion in sysmptoms table, get the id then

            $this->general->create_record(array("prescription" => $p_val),"prescription");

            $new_id_p = $this->db->insert_id();

            $data_p_1 = array(
                         "app_id"          => $app_id,
                         "pres_id"         => $new_id_p,
                         "CREATED_DATE"    => date("Y-m-d H:i:s"),
                         "CREATED_USERID"  => $this->session->userdata('user_id')
                        );

            $this->general->create_record($data_p_1, "patient_prescription_history");  

          }

       endforeach;

       if(!empty($data_p)) {
          $this->db->insert_batch('patient_prescription_history', $data_p);
       }
      
       // now finally update the status to 1 in appointment
          $dat_update = array(
                              "app_status"        => 1,
                              "UPDATED_DATE"      => date("Y-m-d H:i:s"),
                              "UPDATED_USERID"    => $this->session->userdata('user_id')
                             );


         $this->general->update_record($dat_update, array("app_id" => $app_id), "appointment");
        
         $this->general->set_msg("Record Added Successfully",1);

         redirect(base_url().'patient/appointment');

   }


  public function medicine_review() {
      
    $this->header();
      
     $data['patient'] = $this->general->fetch_CoustomQuery("SELECT * FROM `patient` as p, appointment as ap 
     WHERE p.`patient_id` = ap.patient_id AND ap.app_status = 1 AND ap.app_med_status = 0 order by ap.app_id ASC");
        
     $data['controller'] = $this;

     $this->load->view('patient/medicine_review',$data);
   
    $this->footer();

  }

 public function bring_symptoms($app_id) {

      
     $sys = $this->general->fetch_CoustomQuery("SELECT s.symp_id, s.symptoms, psh.`app_id`
                                                FROM 
                                                `patient_symptoms_history` as psh, symptoms as s	
                                                WHERE
                                                psh.symp_id = s.symp_id
                                                AND
                                                psh.app_id = $app_id");

       $symtoms = "";
     
      foreach($sys as $syss):
           
        $symtoms .= $syss->symptoms.", ";

      endforeach;  
         
      echo $symtoms;
 }


 public function bring_presciptions($app_id) {
  
  $sys = $this->general->fetch_CoustomQuery("SELECT p.pres_id, p.prescription, psh.`app_id`
                                      FROM 
                                      `patient_prescription_history` as psh, prescription as p	
                                      WHERE
                                      psh.`pres_id` = p.pres_id
                                      AND
                                      psh.`app_id` = $app_id");

    $pres = "";

    foreach($sys as $syss):

    $pres .= $syss->prescription.", ";

    endforeach;  

    echo $pres;
  
}


public function update_med_status() {
    
  extract($_POST);

  
  $dat_update = array(
                      "app_med_status"    => 1,
                      "UPDATED_DATE"      => date("Y-m-d H:i:s"),
                      "UPDATED_USERID"    => $this->session->userdata('user_id')
                     );


    $this->general->update_record($dat_update, array("app_id" => $c_id), "appointment");

    echo true;

}


public function patient_history() {
    
  $this->header();
       
     $pat_id = $this->uri->segment(3);

     $whr = array("app_status" => 1, "app_med_status" => 1, "patient_id" => $pat_id);

     $data['patient_info'] = $this->general->fetchby_multiplecolumns("patient", array("patient_id" => $pat_id));
     
     $data['pat_hist'] = $this->general->fetchby_multiplecolumns("appointment", $whr);

     $data['controller'] = $this;
                                
    $this->load->view('patient/patient_history',$data);
   
    $this->footer();

}


  public function del_appointment() {
     extract($_POST);

      $this->general->delete_record("appointment", array("app_id" => $c_id));

      echo true;

  }


  
  public function prescription_detail() {
    
    $this->header();


     $data["history"]  =  $this->general->fetch_CoustomQuery("SELECT pph.`app_id`, pph.`pres_id`, psh.symp_id, p.prescription, s.symptoms, ap.patient_id, ap.app_date
                          FROM `patient_prescription_history` as pph, patient_symptoms_history as psh, symptoms as s, prescription as p, appointment as ap
                          WHERE
                          pph.app_id = psh.app_id
                          AND
                          pph.pres_id = p.pres_id
                          AND
                          ap.app_id = psh.app_id
                          AND
                          psh.symp_id = s.symp_id
                          AND
                          pph.pres_id = 9");
    
    $this->load->view('patient/patient_history',$data);
   
    $this->footer();

  }


} // end class

