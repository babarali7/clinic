<?php 
     
     $type = array(
          1 => "GCT",
          2 => "GPI",
          3 => "GTVC",
          4 => "SVTI",
          5 => "HO", 
          6 => "EMP - EXC",
          7 => "SDC" 
      );



	  foreach($inst as $inst){

             $val_t = $type[$inst->type];

	        @$companylistRow .="<tr class=gradeX>
								<td>$inst->inst_name</td>
								<td>$inst->ddo_code</td>
                <td>$inst->name</td>
								<td class=center>$val_t</td>
								<td class=center><a onClick='updateInfo($inst->inst_id);' class='btn btn-link btn-warning btn-just-icon edit'> <i class='material-icons'>dvr</i> </a>   
                <a href='delete_ins/$inst->inst_id' onclick='return confirm(\"Are you sure you want to delete ?\");' class='btn btn-link btn-danger btn-just-icon remove' $My_Controller->deletePermission ><i class='material-icons'>close</i></a></td>";
	     

	  }


?>

			
 <div class="content">
    <div class="container-fluid">     
        
        <?php if($this->session->flashdata('msg')){ 
          
          echo $this->session->flashdata('msg');
      
        } ?>	    
 
      <div class="row">  
        <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-rose card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">contacts</i>
                  </div>
                  <h4 class="card-title">Add Institute</h4>
                </div>
                <div class="card-body">
                  <form method="post" action="create_ins">
                    <div class="row">
                      <div class="col-md-4">
                    <div class="form-group">
                      <select class="selectpicker" data-live-search="true" data-style="btn btn-primary btn-round" title="Single Select" searchable="Search here.." name="district" id="district">
                            <option disabled selected>Select District</option>
                             <?php foreach($district as $ds): ?>
                              <option value="<?=$ds->id;?>"> <?=$ds->name;?> </option>
                             <?php endforeach; ?>   

                      </select>
                    </div>
                    <div class="form-group">
                      <select class="selectpicker" data-live-search="true" data-style="btn btn-primary btn-round" title="Single Select" name="type" id="type_c">
                            <option disabled selected>Select Type</option>
                            <option value="1">GCT</option>
                            <option value="2">GPI</option>
                            <option value="3">GTVC</option>
                            <option value="4">SVTI</option>
                            <option value="5">HO</option>
                            <option value="6">EMP-EXC</option>
                            <option value="7">SDC</option>
                      </select>
                      
                    </div>
                    </div>

                    <div class="col-md-8">
                    
                    <!--   <div class="form-group">
                        <label for="ins_name" class="bmd-label-floating">Institute Name</label>
                        <input type="text" name="ins_name" class="form-control" id="ins_name">
                      </div>
                      <div class="form-group">
                        <label for="ddo" class="bmd-label-floating">DDO Code</label>
                        <input type="text" name="ddo_code" class="form-control" id="ddo">
                      </div> -->

                     <div class="row">
                      <label class="col-md-3 col-form-label">Institute Name</label>
                      <div class="col-md-9">
                        <div class="form-group has-default">
                          <input type="text" name="ins_name" class="form-control" id="ins_name">
                        </div>
                      </div>
                     </div>

                     <div class="row">
                      <label class="col-md-3 col-form-label">DDO Code</label>
                      <div class="col-md-9">
                        <div class="form-group">
                          <input type="text" name="ddo_code" class="form-control" id="ddo">
                        </div>
                      </div>
                    </div>
                    
                    </div>

                  </div><!-- row-->
                </div>
                <div class="card-footer ">
                    
                    <input type="hidden" name="ins_id" id="ins_id">

                  <!-- <button type="submit" class="btn btn-fill btn-rose">Submit</button> -->
                   <?php //Get Save Button Permission........?>
           <?php echo $My_Controller->savePermission;?>
           <button type="button" class="btn btn-fill" id="reset" onClick="resetValues();" style="display: none"> Cancel </button>
                 
                 </form>
                </div>
              </div>
            </div>

           <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">assignment</i>
                  </div>
                  <h4 class="card-title">List of All Institutes</h4>
                </div>
                <div class="card-body">
                  <div class="toolbar">
                    <!--        Here you can write extra buttons/actions for the toolbar              -->
                  </div>
                  <div class="material-datatables">
                    <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                      <thead>
                        <tr>
                          <th>Name</th>
                          <th>DDO Code</th>
                          <th>District</th>
                          <th>Type</th>
                          <th class="disabled-sorting text-right">Actions</th>
                        </tr>
                      </thead>
                      <tfoot>
                        <tr>
                          <th>Name</th>
                          <th>DDO Code</th>
                          <th>District</th>
                          <th>Type</th>
                          <th class="text-right">Actions</th>
                        </tr>
                      </tfoot>
                      <tbody>
                       <?=$companylistRow;?>
                      </tbody>
                    </table>
                  </div>
                </div>
                <!-- end content-->
              </div>
              <!--  end card  -->
            </div>
            <!-- end col-md-12 -->


          

   <!-- new theme -->
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
                            url: base_url()+'institute/get_ins/',
                            type: "post",
                            dataType:"json",
                            data: { c_id:id },
                            success: function(data) 
                            {
                                
                              $.each(data,function(i,j){ 
                              //  alert(j.inst_name);
                                $("#ins_name").val(j.inst_name);
                                $("#ddo").val(j.ddo_code);
                                $("#type_c").val(j.type);
                                $("#district").val(j.districts_id);
                                $("#ins_id").val(j.inst_id);
                              
                              });
                                
                                $('.selectpicker').selectpicker('refresh');

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

