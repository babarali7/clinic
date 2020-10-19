<?php 

    foreach($list as $result){
    
          @$listRow .="<tr>
                <td>".$result->SUB_NAME."</td>
                <td>".$result->CAT_NAME."</td>
                <td>".$result->SUB_SORT_ORDER."</td> 
                <td>
                <a href='#' onClick='updateInfo($result->SUB_CAT_ID);'class='btn btn-primary btn-sm'>Edit</a>
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
          <form method="post" action="create_sub_category">  
            <div class="card ">
                <div class="card-header card-header-rose card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">mail_outline</i>
                  </div>
                  <h4 class="card-title">Add Sub Category</h4>
                </div>
                <div class="card-body ">
                    <div class="form-group">
                      <select class="selectpicker" data-live-search="true" data-style="btn btn-primary" title="Single Select" searchable="Search here.." name="parent" id="parent" required="required">
                            <option disabled selected>Select Parent Category</option>
                             <?php foreach($cat as $menu): ?>
                               <option value="<?=$menu->CAT_ID;?>"> <?=$menu->CAT_NAME;?> </option>
                             <?php endforeach; ?>   

                      </select>
                    </div> 
                    <div class="form-group">
                      <input type="text" name="sub_name" class="form-control" id="sub_name" placeholder="Sub Category Name" required="required">
                    </div>
                    <div class="form-group">
                      <input type="number" name="sort_order" class="form-control" id="sort_order" placeholder="Sort Order" required="required">
                    </div>
                </div>
                <div class="card-footer ">
                  <input type="hidden" name="sub_cat_id" id="sub_cat_id">
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
                  <h4 class="card-title">List of Sub Categories</h4>
                </div>
                <div class="card-body">
                  <div class="toolbar">
                    <!--        Here you can write extra buttons/actions for the toolbar              -->
                  </div>
                  <div class="material-datatables">
                    <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                      <thead>
                        <tr>
                          <th>Sub Category</th>
                          <th>Parent Category</th>
                          <th>Sort Order</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tfoot>
                        <tr>
                          <th>Sub Category</th>
                          <th>Parent Category</th>
                          <th>Sort Order</th>
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
                            url: base_url()+'generals/get_sub_cat/',
                            type: "post",
                            dataType:"json",
                            data: { c_id:id },
                            success: function(data) 
                            {
                                
                              $.each(data,function(i,j){ 
                              //  alert(j.inst_name);
                                $("#sub_name").val(j.SUB_NAME);
                                $("#sort_order").val(j.SUB_SORT_ORDER);
                                $("#parent").val(j.CAT_ID);
                                $("#sub_cat_id").val(j.SUB_ID);
                              
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