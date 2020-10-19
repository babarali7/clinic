<?php 

    foreach($list as $result){
    
          @$listRow .="<tr>
                <td>".$result->prescription."</td>
                <td>".$result->price."</td> 
                <td>
                <a href='#' onClick='updateInfo($result->pres_id);'class='btn btn-primary'>Edit</a>
                </td>";
    
    
    }

?>

<div class="content">
    <div class="container-fluid">     
        
        <?php if($this->session->flashdata('msg')){ 
          
          echo $this->session->flashdata('msg');
      
          } ?>    
     <div class="row"> 
      
      <div class="col-md-4">        
          <form method="post" action="create_category">  
            <div class="card ">
                <div class="card-header card-header-rose card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">mail_outline</i>
                  </div>
                  <h4 class="card-title">Add Prescription</h4>
                </div>
                <div class="card-body ">
                    <div class="form-group">
                      <input type="text" name="pres_name" class="form-control" id="pres_name" placeholder="Prescription Name">
                    </div>
                    <div class="form-group">
                      <input type="number" name="price" class="form-control" id="price" placeholder="Price">
                    </div>
                </div>
                <div class="card-footer ">
                  <input type="hidden" name="pres_id" id="pres_id">
                  <?php echo $My_Controller->savePermission;?>
                    <button type="button" class="btn btn-fill" id="reset" onClick="resetValues();" style="display: none"> Cancel </button>
                </div>
            </div>     
         </form>      
       </div>

        <div class="col-md-8">
              <div class="card">
                <div class="card-header card-header-primary card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">assignment</i>
                  </div>
                  <h4 class="card-title">List of Prescription</h4>
                </div>
                <div class="card-body">
                  <div class="toolbar">
                    <!--        Here you can write extra buttons/actions for the toolbar              -->
                  </div>
                  <div class="material-datatables">
                    <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                      <thead>
                        <tr>
                          <th>Prescription Name</th>
                          <th>Price</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tfoot>
                        <tr>
                          <th>Prescription Name</th>
                          <th>Price</th>
                          <th>Actions</th>
                        </tr>
                      </tfoot>
                      <tbody>
                       <?=$listRow;?>
                      </tbody>
                    </table>
                  </div>
                </div>
                <!-- end content-->
              </div>
              <!--  end card  -->
            </div>

       
 
     </div>
   </div>
</div>

<script type="text/javascript">
       function base_url() {
         return "<?=base_url();?>";
       }
         
    
       function updateInfo(id) {
          
        //  alert(id);
                
          $.ajax({
                            url: base_url()+'generals/get_cat/',
                            type: "post",
                            dataType:"json",
                            data: { c_id:id },
                            success: function(data) 
                            {
                                
                              $.each(data,function(i,j){ 
                              //  alert(j.inst_name);
                                $("#pres_name").val(j.pres_NAME);
                                $("#price").val(j.price);
                                $("#pres_id").val(j.pres_ID);
                              
                              });
                                
                              
                                $("#save").val("UPDATE");
                                $("#reset").show();

                                    
                            }
                           
                    });
           
     
          } 

   function resetValues() {
         // alert("reset clicked");
         $("input").val("");
         $("#save").val("save");
         $("#reset").hide();

   }

    </script>