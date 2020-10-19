<div class="content">
    <div class="container-fluid">     
      
        <?php if($this->session->flashdata('msg')){ 
          
          echo $this->session->flashdata('msg');
      
        } 
        
        ?>
          
          
         <div class="row">
          <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">assignment</i>
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
                          <th>Gender</th>
                          <th>Age</th>
                          <th>Phone</th>
                          <th>Address</th>
                          <th>Date Time</th>
                          <th class="disabled-sorting text-right">Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                       <?php $s_no = 1; foreach($patient as $pt): ?>
                        <tr>
                           <td> <?=$s_no;?> </td>
                           <td> MC-<?=$pt->patient_id;?> </td>
                           <td> <?=$pt->patient_name;?> </td>
                           <td> <?=$pt->patient_gender;?> </td>
                           <td> <?=$pt->patient_age;?> </td>
                           <td> <?=$pt->patient_phone;?> </td>
                           <td> <?=$pt->patient_address;?> </td>
                           <td> <span class="text-danger">
                               <?=date("H:i a",strtotime($pt->app_time));?></span></td>
                           <td> 
                           <?php if($this->session->userdata("group_id") == 2 || $this->session->userdata("group_id") == 1) { ?>
                           <a href="<?=base_url();?>patient/review/<?=$pt->app_id;?>/<?=$pt->patient_id;?>" class='btn btn-sm btn-primary'> Review </a> 
                           <?php } ?>
                            <a onClick="del_appointment(<?=$pt->app_id;?>)" class="btn btn-sm btn-link btn-danger"> <i class="fa fa-close"> </i> </a> 
                           </td>    
                        </tr>
                        
                       <?php $s_no++; endforeach;?>  
                
                      </tbody>
                      <tfoot>
                        <tr>
                          <th>S#</th>
                          <th>Patient ID</th>  
                          <th>Name</th>
                          <th>Gender</th>
                          <th>Age</th>
                          <th>Phone</th>
                          <th>Address</th>
                          <th>Address</th>
                          <th class="disabled-sorting text-right">Actions</th>
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
  
  function del_appointment(id) {

    Swal.fire({
      title: 'Are you sure?',
      text: "You want to delete!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      cancelButtonColor: '#3085d6',
      confirmButtonText: 'Yes, Delete It!'
    }).then((result) => {
      if (result.isConfirmed) {
       // $("#for").submit();
        


       $.ajax({
                            url: '<?=base_url();?>patient/del_appointment/',
                            type: "post",
                            dataType:"json",
                            data: { c_id:id },
                            success: function(data) 
                            {

                              Swal.fire(
                                        'Deleted!',
                                        'Appointment has been deleted.',
                                        'success'
                                      )   
                              location.reload(true);
                                    
                            }
                           
                    });


      }
    
    });

  }

</script>

