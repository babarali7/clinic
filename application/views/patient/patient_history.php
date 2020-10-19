         
<div class="content">
     <div class="container-fluid">
      
 
       <div id="printable">     
         
         <?php if($this->session->flashdata('msg')){ 
           
           echo $this->session->flashdata('msg');
       
         } 
   
       foreach($patient_info as $pt):
           
           $pa_name     = $pt->patient_name;
           $pa_id       = $pt->patient_id;
           $gender      = $pt->patient_gender;
           $age         = $pt->patient_age;
           $phone       = $pt->patient_phone;
           $adrress     = $pt->patient_address;
        
         endforeach; 
 
        
         ?>
 
              
       
       <section id="general_info">
            <div class="col-md-12">
              <h2 class="title text-center">PATIENT ID : <span class="text-primary">MC-<?=$pa_id;?></span></h2>
             <div class="card table-responsive">
               <div class="card-body">  
                 <table class="table table-bordered">
                  <thead>  
                    <tr>
                       <th>Name</th>
                       <th>Gender</th>
                       <th>Age</th>
                       <th>Phone</th>
                       <th>Address</th>
                       
                    </tr>
                   </thead>
                   <tbody>
                     
                    <tr>   
                       <td><?=$pa_name;?></td>
                       <td><?=$gender;?></td>
                       <td><?=$age;?></td>
                       <td><?=$phone;?></td>
                       <td><?=$adrress;?></td>
                      
                    </tr>
                   </tbody>
                 </table>
              
               </div>
             </div>    
            </div>  
         </section>
        
       
         <section id="genereral_recommendation">
           <div class="col-md-12">
             <h3 class="title text-center">PATIENT HISTORY</h3>
             <div class="card">
                <div class="card-body">
                  <div class="material-datatables">
                    <table id="datatable" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                      <thead>
                        <tr>
                          <th>S#</th>
                          <th>Appointment Date</th>  
                          <th>Symptoms</th>
                          <th>Prescription</th>
                        </tr>
                      </thead>
                      <tbody>
                       <?php $s_no = 1; foreach($pat_hist as $pt): ?>
                        <tr>
                           <td> <?=$s_no;?> </td>
                           <td> <?=date("d-m-Y",strtotime($pt->app_date));?> <?=date("H:i a",strtotime($pt->app_time));?> </td>
                           <td> <?=$controller->bring_symptoms($pt->app_id);?> </td>
                           <td> <?=$controller->bring_presciptions($pt->app_id);?> </td>
                        </tr>
                        
                       <?php $s_no++; endforeach;?>  
                
                      </tbody>
                      <tfoot>
                        <tr>
                          <th>S#</th>
                          <th>Appointment Date</th>  
                          <th>Symptoms</th>
                          <th>Prescription</th>
                        </tr>
                      </tfoot>
                      <tbody>
                      </tbody>
                    </table>
                  </div>

                </div>
             </div>
           </div>    
         </section>
        
         
        
 
 
       </div>
    <!-- new theme -->
      
     </div>
  </div>
   
 
 
 
 
 
 
  