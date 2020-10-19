
<script type="text/javascript" src="<?=base_url();?>assets/tags/typehead.js"></script>
<link rel="stylesheet" href="<?=base_url();?>assets/tags/bootstrap-tagsinput.css">
<link rel="stylesheet" href="<?=base_url();?>assets/tags/app.css">
         
<script src="<?=base_url();?>assets/tags/bootstrap-tagsinput.min.js"></script>
         
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
          
           $app_id    = $pt->app_id;
           $date      = date("d-m-Y",strtotime($pt->app_date)); 
           $time      = date("H:i a",strtotime($pt->app_time));
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
                       <th>Date Time</th>
                    </tr>
                   </thead>
                   <tbody>
                     
                    <tr>   
                       <td><?=$pa_name;?></td>
                       <td><?=$gender;?></td>
                       <td><?=$age;?></td>
                       <td><?=$phone;?></td>
                       <td><?=$adrress;?></td>
                       <td><?=$time;?> , <?=$date;?> </td>
                    </tr>
                   </tbody>
                 </table>
              
               </div>
             </div>    
            </div>  
         </section>
        
       
         <section id="genereral_recommendation">
           <div class="col-md-12">
             <h3 class="title text-center">SECTION II: PATIENT REVIEW</h3>
             <div class="card">
               <form method="post" action="<?=base_url();?>patient/add_checkup" id="for"> 
                <div class="card-body">
                   <div class="row">
                     <div class="col-md-6">
                      
                     <div class="form-group">
                      <label>Add Symptoms:</label><br/>
                      <input type="text" class="form-control tagsinput" id="txtSkills" name="symptom" data-role="tagsinput" data-color="info"  />
                        
                      </div>
                     </div>
                     <div class="col-md-6">
                       <div class="form-group">
                        <label>Add Prescriptions:</label><br/>
                        <input type="text" class="form-control tagsinput" id="prescrip" name="prescription" data-role="tagsinput">
                       </div>
                     </div>  
                   </div>
                 </div>
                <div class="card-footer">
                   <input type="hidden" name="app_id" value="<?=$app_id;?>">
                   <input type="hidden" name="pat_id" value="<?=$pa_id;?>">
                   <input type="button" onclick="check_it();" class="btn btn-next btn-fill btn-rose btn-wd" value="Submit">
                </div>
               </form> 
             </div>
            
           </div>    
         </section>

         <section id="genereral_recommendation">
           <div class="col-md-12">
             <h3 class="title text-center">SECTION III: PATIENT HISTORY</h3>
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
        
         
        
 <script>
  
  localStorage.clear();
  
  // Get the reference to the input field
var elt = $('#txtSkills'); 

var skills = new Bloodhound({
      datumTokenizer: Bloodhound.tokenizers.obj.whitespace('id'),
      queryTokenizer: Bloodhound.tokenizers.whitespace,
      remote: {
              url: '<?=base_url();?>patient/get_symptoms?keyword=%QUERY%',
              wildcard: '%QUERY%',                
      }
});
skills.initialize();

$('#txtSkills').tagsinput({
      itemValue : 'id',
      itemText  : 'name',
      maxChars: 10,
      trimValue: true,
      allowDuplicates : false,     
      freeInput: true,
      focusClass: 'form-control',
      onTagExists: function(item, $tag) {
          $tag.hide().fadeIn();
      },
      typeaheadjs: [{
                        hint: false,
                        highlight: true
                    },
                    {
                    name: 'skills',
                    itemValue: 'id',
                    displayKey: 'name',
                    limit: 10,
                    source: skills.ttAdapter(),
                    templates: {
                        empty: [
                            '<ul class="list-group"><li class="list-group-item">Nothing found.</li></ul>'
                        ],
                        header: [
                            '<ul class="list-group">'
                        ],
                        suggestion: function (data) {
                            return '<li class="list-group-item">' + data.name + '</li>'
                          }
                    }
        }]           
});

 // prscripotion one goes here

 var elt_1 = $('#prescrip'); 

 var skills_1 = new Bloodhound({
      datumTokenizer: Bloodhound.tokenizers.obj.whitespace('id'),
      queryTokenizer: Bloodhound.tokenizers.whitespace,
      remote: {
              url: '<?=base_url();?>patient/get_prescription?keyword=%QUERY%',
              wildcard: '%QUERY%',                
      }
});
skills_1.initialize();

$('#prescrip').tagsinput({
      itemValue : 'id',
      itemText  : 'name',
      maxChars: 10,
      trimValue: true,
      allowDuplicates : false,     
      freeInput: true,
      focusClass: 'form-control',
      onTagExists: function(item, $tag) {
          $tag.hide().fadeIn();
      },
      typeaheadjs: [{
                        hint: false,
                        highlight: true
                    },
                    {
                    name: 'skills_1',
                    itemValue: 'id',
                    displayKey: 'name',
                    limit: 10,
                    source: skills_1.ttAdapter(),
                    templates: {
                        empty: [
                            '<ul class="list-group"><li class="list-group-item">Nothing found.</li></ul>'
                        ],
                        header: [
                            '<ul class="list-group">'
                        ],
                        suggestion: function (data) {
                            return '<li class="list-group-item">' + data.name + '</li>'
                          }
                    }
        }]           
});
  


function check_it() {
   
      Swal.fire({
      title: 'Are you sure?',
      text: "You want to submit!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, submit!'
    }).then((result) => {
      if (result.isConfirmed) {
        $("#for").submit();
      }
    });

}
    
</script>
     
     
 
   
 
       </div>
    <!-- new theme -->
      
     </div>
  </div>
   
 
 
 
 
 
 
  