
<?php if($this->session->flashdata('msg')){ ?>
			
			
			<div class="alert alert-success fade in">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
					<i class="fa-ok alert-icon s24"></i> <strong><?=$this->session->flashdata('msg');?></strong>
			</div>

			
			
<?php } ?>
			
			

	
	  <div class=row>
        <div class=col-lg-12>
          <!-- col-lg-12 start here -->
          <div class="panel panel-default plain toggle panelClose panelRefresh">
            <!-- Start .panel -->
            <div class="panel-heading white-bg">
              <h4 class=panel-title>Data table</h4>
            </div>
            <div class=panel-body>
              <table width="987">
  <tr>
    <th width="337" height="402" scope="col" align="left" valign="top">
      <table width="334" height="401">
         <tr>
           <th width="326" height="191" align="center" valign="middle" scope="col"><div class=col-lg-6><img id=logo src=http://localhost/user_mg/img/logo.png  width="100%" ></th>
         </tr>
         <tr>
           <td align="left" valign="middle"></td>
         </tr>
         <tr>
           <td align="left" valign="middle"><table width="329">
             <tr>
               <th width="91" height="28" scope="col">School</th>
               <th width="226" scope="col">Hudaibia Model School</th>
             </tr>
           </table></td>
         </tr>
         <tr>
           <td align="left" valign="middle"><table width="329">
             <tr>
               <th width="91" height="28" scope="col">Latitude</th>
               <th width="226" scope="col">&nbsp;</th>
             </tr>
           </table></td>
         </tr>
         <tr>
           <td align="left" valign="middle"><table width="329">
             <tr>
               <th width="91" height="28" scope="col">longitude</th>
               <th width="226" scope="col">&nbsp;</th>
             </tr>
           </table></td>
         </tr>
         <tr>
           <td align="left" valign="middle"><table width="329">
             <tr>
               <th width="91" height="28" scope="col">Phone</th>
               <th width="226" scope="col">091 - 2262943, 2260275</th>
             </tr>
           </table></td>
         </tr>
         <tr>
           <td align="left" valign="middle"><table width="329">
             <tr>
               <th width="91" height="28" scope="col">Address</th>
               <th width="226" scope="col">Gulbahar no 4 Peshawar city</th>
             </tr>
           </table></td>
         </tr>
         <tr>
           <td align="left" valign="middle"><table width="329">
             <tr>
               <th width="91" height="28" scope="col">&nbsp;</th>
               <th width="226" scope="col"></th>
             </tr>
           </table></td>
         </tr>
      </table>
    </th>
    <th width="638" scope="col"> <div class="panel panel-default toggle panelMove panelClose panelRefresh">
            <!-- Start .panel -->
            <div class=panel-heading>
              <h4 class=panel-title>Basic map</h4>
            </div>
            <div class=panel-body>
              <div id=gmap style=width:100%;height:300px></div>
            </div>
          </div>
          <!-- End .panel --></th>
  </tr>
</table>
            </div>
          </div>
          <!-- End .panel -->
        </div>
        <!-- col-lg-12 end here -->
		</div>