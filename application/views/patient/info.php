<div class="content">
    <div class="container-fluid">     
      
        <?php if($this->session->flashdata('msg')){ 
          
          echo $this->session->flashdata('msg');
      
        } 
        
        ?>
         
         <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-icon card-header-rose">
                  <div class="card-icon">
                    <i class="material-icons">perm_identity</i>
                  </div>
                  <h4 class="card-title">Add Patient
                  </h4>
                </div>
                <div class="card-body">
                  <form method="post" action="<?=base_url();?>patient/add_patient">
                    <div class="row">
                      <div class="col-md-3">
                        <div class="form-group">
                          <input type="text" name="p_name" class="form-control" id="p_name" required="required" placeholder="Name">
                        </div>
                      </div>
                      <div class="col-md-1">
                        <div class="form-group">
                          <input type="text" name="age" id="age" class="form-control" placeholder="Age">
                        </div>
                      </div>
                      <div class="col-md-2">
                      <div class="checkbox-radios">
                        <div class="form-check form-check-inline" style="padding:0px 0px; margin:10px 0px;">
                          <label class="form-check-label">
                            <input class="form-check-input" type="radio" name="gender"  id="male" value="Male"> Male
                            <span class="circle">
                              <span class="check"></span>
                            </span>
                          </label>
                        </div>
                        <div class="form-check form-check-inline" style="padding:0px 0px; margin:10px 0px;">
                          <label class="form-check-label">
                            <input class="form-check-input" type="radio" name="gender" id="female" value="Female"> Female
                            <span class="circle">
                              <span class="check"></span>
                            </span>
                          </label>
                        </div>
                       </div>               
                      </div>
                      <div class="col-md-2">
                        <div class="form-group">
                          <input type="number" name="phone" id="phone" class="form-control" placeholder="Phone">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <input type="text" name="address" id="address" class="form-control" placeholder="Address">
                        </div>
                      </div>
                    </div>
                    <input type="hidden" name="pat_id" id="pat_id">
                    <input type="submit" class="btn btn-rose pull-left" value="Add patient" id="save">
                    <button type="button" class="btn btn-fill" id="reset" onClick="resetValues();" style="display: none"> Cancel </button>
                    <div class="clearfix"></div>
                  </form>
                </div>
              </div>
            </div>
          </div>   
          
         <div class="row">
          <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">assignment</i>
                  </div>
                  <h4 class="card-title">List of All Patients</h4>
                </div>
                <div class="card-body">
                  <div class="toolbar">
                    <!--        Here you can write extra buttons/actions for the toolbar              -->
                  </div>
                  <div class="material-datatables">
                    <table id="patien" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                      <thead>
                        <tr>
                          <th>S#</th>
                          <th>Patient ID</th>  
                          <th>Name</th>
                          <th>Gender</th>
                          <th>Age</th>
                          <th>Phone</th>
                          <th>Address</th>
                          <th class="disabled-sorting text-right">Actions</th>
                        </tr>
                      </thead>
                      <tfoot>
                        <tr>
                          <th>S#</th>
                          <th>Patient ID</th>  
                          <th>Name</th>
                          <th>Gender</th>
                          <th>Age</th>
                          <th>Phone</th>
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
            
             <!-- Classic Modal -->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h4 class="modal-title">Set Appointment</h4>
                              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                <i class="material-icons">clear</i>
                              </button>
                            </div>
                            <div class="modal-body">
                              <form method="post" action="#" id="appointment">
                              <div class="row">
                                <label class="col-md-3 col-form-label">Patient ID</label>
                                  <div class="col-md-9">
                                    <div class="form-group has-default">
                                      <input type="text" name="patt_id" class="form-control" id="patt_id" readonly="readonly">
                                    </div>
                                  </div>
                              </div>

                              <div class="row">
                                <label class="col-md-3 col-form-label"> Name</label>
                                  <div class="col-md-9">
                                    <div class="form-group has-default">
                                      <input type="text" name="patt_name" class="form-control" id="patt_name" readonly="readonly">
                                    </div>
                                  </div>
                              </div> 
                            
                             <div class="row">
                               <label class="col-md-3 col-form-label">Date</label>
                                <div class="col-md-9">
                                  <div class="form-group has-default">
                                    <input type="text" name="app_date" class="form-control datepicker" id="app_date" value="<?=date("d-m-Y");?>">
                                  </div>
                                </div>
                              </div>

                              <div class="row">
                                <label class="col-md-3 col-form-label">Time</label>
                                <div class="col-md-9">
                                  <div class="form-group">
                                    <input type="text" name="app_time" class="form-control timepicker" id="app_time" value="<?=date("H:i");?>">
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="modal-footer">
                            <input type="hidden" name="pat_id" class="form-control" id="user_id">  
                            <button type="button" onClick="get_form();" class="btn btn-link" data-dismiss="modal">Make Appointment</button>
                              <button type="button" class="btn btn-danger btn-link" data-dismiss="modal">Close</button>
                            </div>
                            </form>
                          </div>
                        </div>
                      </div>
                      <!--  End Modal -->

          </div>

    </div>  <!-- container-fluid -->
</div>      

<script type="text/javascript">
       function base_url() {
         return "<?=base_url();?>";
       }
         
    
       function updateInfo(id) {
          
         // alert(id);
         var gend;
             
          $.ajax({
                            url: base_url()+'patient/get_info/',
                            type: "post",
                            dataType:"json",
                            data: { c_id:id },
                            success: function(data) 
                            {
                                
                              $.each(data,function(i,j){ 
                              //  alert(j.inst_name);
                                $("#p_name").val(j.patient_name);
                                $("#age").val(j.patient_age);
                                gend = j.patient_gender;
                                $("#phone").val(j.patient_phone);
                                $("#address").val(j.patient_address);
                                $("#pat_id").val(j.patient_id);
                              
                              });

                               //alert(gend); 
                               if(gend == "Male") {
                                $("#male").prop("checked", true);
                               } else {
                                $("#female").prop("checked", true);
                               }

                                $("#save").val("UPDATE");
                                $("#reset").show();

                                    
                            }
                           
                    });           
     
          } 

     
   function resetValues() {
         // alert("reset clicked");
         $("input").val("");
         $("#save").val("Add Patient");
         $("#reset").hide();
         $(".form-check-input").prop('checked', false);

   }

   function fetch_id(id, p_name) {
      $("#patt_name").val(p_name);
       $("#user_id").val(id);
       $("#patt_id").val("MC-"+id);
     }     
 

    function get_form() {

     // $('#patien').DataTable().ajax.reload();
      var url1 = base_url()+"patient/make_appointment"; 
   // exit();
   var datastring = $("#appointment").serialize();
   swal.showLoading();
   
    $.ajax({
        type: "POST",
        url: url1,
        data: datastring,
        dataType: "json",
        success: function(data) {
            //var obj = jQuery.parseJSON(data); if the dataType is not specified as json uncomment this
            // do what ever you want with the server response
               
                 if(data == "true") {   
                    
                     Swal.fire({
                      position: 'center',
                      icon: 'success',
                      title: 'Saved Successfully',
                      showConfirmButton: false,
                      timer: 3000
                    });
                   $('#patien').DataTable().ajax.reload();
                   } else {
                    
                    Swal.fire({
                      position: 'center',
                      icon: 'error',
                      title: "Something Went Wrong !",
                      showConfirmButton: false,
                      timer: 3000
                    });

                   }
           
        },
        error: function() {
             Swal.fire({
                  position: 'center',
                  icon: 'danger',
                  title: 'Error in processing',
                  showConfirmButton: false,
                  timer: 3000
                });
        }
    });



    }

    </script>

<script>
   $(document).ready(function(){  
    $('#patien').DataTable({
        // Processing indicator
        "processing": true,
        // DataTables server-side processing mode
        "serverSide": true,
        // Initial no order.
        "order": [],
        // Load data from an Ajax source
        "ajax": {
            "url": "<?php echo base_url('patient/fetch_user/'); ?>",
            "type": "POST"
        },
        //Set column definition initialisation properties
        "columnDefs": [{ 
            "targets": [0],
            "orderable": false
        }]
    });
  

  oTable = $('#patien').DataTable();   //pay attention to capital D, which is mandatory to retrieve "api" datatables' object, as @Lionel said
    $('#p_name').keyup(function(){
      oTable.search($(this).val()).draw() ;
   });
 

 });  
     
  
  </script>