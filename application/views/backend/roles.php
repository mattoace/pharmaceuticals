 
    <!-- Google web fonts -->
<link href="http://fonts.googleapis.com/css?family=PT+Sans+Narrow:400,700" rel='stylesheet' />
<link rel="stylesheet" href='<?php echo base_url("assets/plugins/selectator/fm.selectator.jquery.min.css");?>'>
<link rel="stylesheet" href='<?php echo base_url("assets/plugins/datatables/jquery.dataTables.min.css");?>'>
<link rel="stylesheet" href='<?php echo base_url("assets/plugins/datatables/jquery.dataTables_themeroller.css");?>'>
<link rel="stylesheet" href='<?php echo base_url("assets/plugins/datatables/dataTables.bootstrap.css");?>'>
<link rel="stylesheet" href='<?php echo base_url("assets/css/style.css");?>'>
<style>
.bg-yellow, .callout.callout-warning, .alert-warning, .label-warning, .modal-warning .modal-body {
    background-color: #16a9ef !important;
}
</style>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Assign System Roles
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Roles</a></li>
        <li class="active">List View</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
     <!-- column here -->



        <div class="col-md-3">         

          <!-- About Me Box -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">System Users</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <h4>Select a user below</h4>
             <select id="select1" name="select1" style="width:100%;" onchange="reloadRoles(userJsTree)">
              <?php 
               $query = $this->db->query('SELECT * FROM users'); 
                    $i = 1;                                        
                  foreach ($query->result() as $row)
                      {
                      print('<option value="'.$row->id.'" data-right="'.$i.'"  data-left=" <img src='.base_url("assets/img/avatar5.png").' >"  >'.$row->username.'</option>'); 
                      $i++;
                      }

              ?>      
            </select>
            <input value="activate selectator" id="activate_selectator1" type="button" style="visibility:hidden;">

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->







        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#activity" data-toggle="tab">System Roles</a></li>
           <!--    <li><a href="#timeline" data-toggle="tab">Contact person</a></li>
              <li><a href="#settings" data-toggle="tab">Additional details</a></li> -->
               </ul>
                <div class="tab-content">
                <div class="active tab-pane" id="activity">
                <!-- Post -->
                <div class="post">
                 <div class="user-block">
                    <div class="btn-group">
                      <button type="button" onClick = "selectall(userJsTree)" class="btn btn-danger">Select all</button>
                      <button type="button" onClick = "unselectall(userJsTree)" class="btn btn-danger">Unselect All</button>
                      <button type="button" id="savingroles" name="savingroles" onClick = "saveRoles()" class="btn btn-danger">Save Roles</button>
                      <button type="button" id="assignpharmacy" name="assignpharmacy" onClick = "assignpharmacy()" class="btn btn-danger">Assign User to Store/Pharmacy</button>
                    </div>

                   </div> 
                                       <div class="grid_3 grid_5">                                                                              
                                                <div class="alert alert-warning " role="alert">                                                
                                                    <div id="treeView" class="demo"></div>
                                               </div>
                                        </div>        


                 <script src="<?php echo base_url('assets/plugins/jQuery/jquery-2.2.3.min.js')?>"></script>


                <script src='<?php echo base_url("assets/plugins/jquery-popup-overlay-gh-pages/jquery.popupoverlay.js");?>'></script>
                <script src='<?php echo base_url("assets/plugins/bootstrap/js/bootstrap.min.js");?>'></script>
                <script src='<?php echo base_url("assets/plugins/datepicker/bootstrap-datepicker.js");?>'></script>
                <script src='<?php echo base_url("assets/plugins/input-mask/jquery.inputmask.js");?>'></script>
                <script src='<?php echo base_url("assets/plugins/input-mask/jquery.inputmask.date.extensions.js");?>'></script>
                <script src='<?php echo base_url("assets/plugins/input-mask/jquery.inputmask.extensions.js");?>'></script>
                <script src="<?php echo base_url('assets/plugins/datatables/jquery.dataTables.min.js')?>"></script>
                <script src="<?php echo base_url('assets/plugins/datatables/dataTables.bootstrap.min.js')?>"></script> 

                <script src="<?php echo base_url('assets/plugins/selectator/fm.selectator.jquery.js')?>"></script> 
                <script src="<?php echo base_url('assets/plugins/datatables/dataTables.bootstrap.min.js')?>"></script> 


                <script src="<?php echo base_url('assets/plugins/uploadplugin/jquery.knob.js')?>"></script> 
                <script src="<?php echo base_url('assets/plugins/uploadplugin/jquery.ui.widget.js')?>"></script> 
        


                <script src="<?php echo base_url('assets/plugins/jqueryfileupload/js/tmpl.min.js')?>"></script> 
                <script src="<?php echo base_url('assets/plugins/jqueryfileupload/js/load-image.all.min.js')?>"></script> 
                <script src="<?php echo base_url('assets/plugins/jqueryfileupload/js/canvas-to-blob.min.js')?>"></script>           
                <script src="<?php echo base_url('assets/plugins/jqueryfileupload/js/jquery.blueimp-gallery.min.js')?>"></script>  
                <script src="<?php echo base_url('assets/plugins/jqueryfileupload/js/jquery.iframe-transport.js')?>"></script>
                <script src="<?php echo base_url('assets/plugins/jqueryfileupload/js/jquery.fileupload.js')?>"></script>
                <script src="<?php echo base_url('assets/plugins/jqueryfileupload/js/jquery.fileupload-process.js')?>"></script>
                <script src="<?php echo base_url('assets/plugins/jqueryfileupload/js/jquery.fileupload-image.js')?>"></script>
                <script src="<?php echo base_url('assets/plugins/jqueryfileupload/js/jquery.fileupload-audio.js')?>"></script>
                <script src="<?php echo base_url('assets/plugins/jqueryfileupload/js/jquery.fileupload-video.js')?>"></script> 
                <script src="<?php echo base_url('assets/plugins/jqueryfileupload/js/jquery.fileupload-validate.js')?>"></script> 
                <script src="<?php echo base_url('assets/plugins/jqueryfileupload/js/jquery.fileupload-ui.js')?>"></script> 
                <link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/plugins/vakata-jstree-8ea6ce7/dist/themes/default/style.min.css");?>">
                <script type="text/javascript" src="<?php echo base_url("assets/plugins/vakata-jstree-8ea6ce7/dist/jstree.min.js");?>"></script>

                <script src="<?php echo base_url('assets/js/roles.js')?>"></script> 
                </div>
                <!-- /.post -->         

              </div>  
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>




        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


    <div id="dialogpopupimage" class="well" style="visibility:hidden;">   

              <div id="uploadpopupimage" class="well" style="visibility:hidden;">
                <!-- The file upload form used as target for the file upload widget -->
                <form id="fileuploadimage" action="//jquery-file-upload.appspot.com/" method="POST" enctype="multipart/form-data">
                  <input type="hidden" name="selId" id="selId">
                    <!-- Redirect browsers with JavaScript disabled to the origin page -->
                    <noscript><input type="hidden" name="redirect" value="https://blueimp.github.io/jQuery-File-Upload/"></noscript>
                    <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
                    <div class="row fileupload-buttonbar">
                        <div class="col-lg-7">
                            <!-- The fileinput-button span is used to style the file input field as button -->
                            <span class="btn btn-success fileinput-button">
                                <i class="glyphicon glyphicon-plus"></i>
                                <span>Add files...</span>
                                <input type="file" name="files[]" multiple>
                            </span>
                            <button type="submit" class="btn btn-primary start">
                                <i class="glyphicon glyphicon-upload"></i>
                                <span>Start upload</span>
                            </button>
                            <button type="reset" class="btn btn-warning cancel">
                                <i class="glyphicon glyphicon-ban-circle"></i>
                                <span>Cancel upload</span>
                            </button>
                            <button type="button" class="btn btn-danger delete">
                                <i class="glyphicon glyphicon-trash"></i>
                                <span>Delete</span>
                            </button>
                            <input type="checkbox" class="toggle">
                            <!-- The global file processing state -->
                            <span class="fileupload-process"></span>
                        </div>
                        <!-- The global progress state -->
                        <div class="col-lg-5 fileupload-progress fade">
                            <!-- The global progress bar -->
                            <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                                <div class="progress-bar progress-bar-success" style="width:0%;"></div>
                            </div>
                            <!-- The extended global progress state -->
                            <div class="progress-extended">&nbsp;</div>
                        </div>
                    </div>
                    <!-- The table listing the files available for upload/download -->
                    <table role="presentation" class="table table-striped"><tbody class="files"></tbody></table>
                     </form>
                </div>

           </div>













            <div id="assignuserspopup" class="well" style="visibility:hidden;width:50%;height: 70%; overflow-x: hidden;overflow-y: auto;background-color:#ECF0F5;">
               <div class="row"> 
                 <div class="col-md-12" style="background-color:#DFF0D8"> 



                  <div class="row">


                        <div class="box box-primary">
                          <div class="box-body box-profile">                       
                          <label for="select2">
                            Search user you want to give rights to :
                          </label>
                          <select id="select2" name="select2" style="width:100%;" onchange="reloadAssigned()">
                            <?php 
                             $query = $this->db->query('SELECT * FROM users'); 
                                  $i = 1;                                        
                                foreach ($query->result() as $row)
                                    {
                                    print('<option value="'.$row->id.'" data-right="'.$i.'"  data-left=" <img src='.base_url("assets/img/logo1.png").' >"  >'.$row->username.'</option>'); 
                                    $i++;
                                    }

                            ?>      
                          </select>
                          <input value="activate selectator" id="activate_selectator2" type="button" style="visibility:hidden;">                      
                        </div>
                      </div>

                </div>



                  <div class="col-md-5"> 


                      <table id="pharmacylist" class="cdataTable" cellspacing="0"  style="">
                            <thead>
                                <tr>
                                    <th></th>                                  
                                    <th>Pharmacy list</th>                                                          
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                 
                            <tfoot>
                                <tr>
                         
                                </tr>
                            </tfoot>
                        </table>    

                   </div>
                   <div class="col-md-2"> 
                          <div class="row" style="margin-top: 150%;">
                          <button type="button" onClick = "assignSelected(this)" class="btn btn-danger">>></button>
                          </div>
                          <div class="clear"><hr></div>
                          <div class="row">
                          <button type="button" onClick = "deassignSelected(this)" class="btn btn-danger"><<</button>
                          </div>
                   </div>

                   <div class="col-md-5"> 

                     <table id="assignedlist" class="cdataTable" cellspacing="0"  style="">
                            <thead>
                                <tr>
                                    <th></th>                                 
                                    <th>Assigned</th>                                                          
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                 
                            <tfoot>
                                <tr>
                         
                                </tr>
                            </tfoot>
                        </table>  

                   </div>             

                </div>
             </div>

             </div> 
