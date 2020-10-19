<div class="content">
    <div class="container-fluid">     
      
        <?php if($this->session->flashdata('msg')){ 
          
          echo $this->session->flashdata('msg');
      
        } 
        
        ?>
          
          
         <div class="row">
          <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-info card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">autorenew</i>
                  </div>
                  <h4 class="card-title">Patients Appointment List</h4>
                </div>
                <div class="card-body">
                  <div class="toolbar">
                    <!--        Here you can write extra buttons/actions for the toolbar              -->
                  </div>
                  <div class="material-datatables">
                    <table id="datatable" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                      <thead>
                        <tr>
                          <th>S#</th>
                          <th>Patient ID</th>  
                          <th>Name</th>
                          <th>Phone</th>
                          <th>Symptoms</th>
                          <th>Prescription</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                       <?php $s_no = 1; foreach($patient as $pt): ?>
                        <tr>
                           <td> <?=$s_no;?> </td>
                           <td> MC-<?=$pt->patient_id;?> </td>
                           <td> <?=$pt->patient_name;?> </td>
                           <td> <?=$pt->patient_phone;?> </td>
                           <td> <?=$controller->bring_symptoms($pt->app_id);?> </td>
                           <td> <?=$controller->bring_presciptions($pt->app_id);?>  </td>
                           <td> <a onClick="update_med_status(<?=$pt->app_id;?>);" href="#" class='btn btn-sm btn-primary'> Checked </a>  </td>    
                        </tr>
                        
                       <?php $s_no++; endforeach;?>  
                
                      </tbody>
                      <tfoot>
                        <tr>
                          <th>S#</th>
                          <th>Patient ID</th>  
                          <th>Name</th>
                          <th>Phone</th>
                          <th>Symptoms</th>
                          <th>Prescription</th>
                          <th>Actions</th>
                        </tr>
                      </tfoot>
                      <tbody>
                      </tbody>
                    </table>
                  </div>
                </div>
                <!-- end content-->
              </div>
              <!--  end card  -->
            </div>
            <!-- end col-md-12 -->   
        </div>
    </div>  <!-- container-fluid -->
</div>      

<script>
   
   function update_med_status(id) {

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
       // $("#for").submit();
        


       $.ajax({
                            url: '<?=base_url();?>patient/update_med_status/',
                            type: "post",
                            dataType:"json",
                            data: { c_id:id },
                            success: function(data) 
                            {
                                
                              location.reload(true);
                                    
                            }
                           
                    });


      }
    
    });


   }
    

</script>