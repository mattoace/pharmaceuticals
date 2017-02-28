 <?php  
 if($_SERVER['HTTPS']){
  $protocol = 'https'; 
 }else{ $protocol = 'http'; }
 ?>
    <!-- Google web fonts -->
<link href="http://fonts.googleapis.com/css?family=PT+Sans+Narrow:400,700" rel='stylesheet' />
<link rel="stylesheet" href='<?php echo base_url("assets/plugins/datatables/jquery.dataTables.min.css");?>'>
<link rel="stylesheet" href='<?php echo base_url("assets/plugins/datatables/jquery.dataTables_themeroller.css");?>'>
<link rel="stylesheet" href='<?php echo base_url("assets/plugins/datatables/dataTables.bootstrap.css");?>'>
<link rel="stylesheet" href='<?php echo base_url("assets/css/style.css");?>'>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       System SMTP Settings
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Settings</a></li>
        <li class="active">List View</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
     <!-- column here -->

        <div class="col-md-12">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#activity" data-toggle="tab">Configure Default Mailing</a></li>
           <!--    <li><a href="#timeline" data-toggle="tab">Contact person</a></li>
              <li><a href="#settings" data-toggle="tab">Additional details</a></li> -->
               </ul>
                <div class="tab-content">
                <div class="active tab-pane" id="activity">
                <!-- Post -->
                <div class="post">
                 <div class="user-block">
                    <div class="btn-group">
                      <button type="button" onClick = "add()" class="btn btn-danger">Add</button>
                      <button type="button" onClick = "edit()" class="btn btn-danger">Edit</button>
                      <button type="button" onClick = "deleteRecord()" class="btn btn-danger">Delete</button>
                    </div>

                   </div> 
                    <table id="persontable" class="display" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>No</th>
                            <th>Host</th>
                            <th>Port</th>
                            <th>Username</th>
                            <th>Pass</th>
                            <th>Default Email</th>
                            <th>Default</th>                                                                     
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
         
                    <tfoot>
                        <tr>
                 
                        </tr>
                    </tfoot>
                </table>   
                <!-- Fade & scale -->
                <div id="dialogpopup" class="well" style="visibility:hidden;">
                   <div id ="popupheading" > <h4>Add a new user</h4> </div>


                      <div class="col-md-12">
                            <!-- general form elements -->
                          <div class="box box-primary"> 
                            <!-- form start -->
                            <form role="form">
                              <div class="box-body">


                                <div class="form-group">
                                  <label for="clinicname">SMTP Host</label>
                                  <input type="input" class="form-control" id="host" placeholder="Enter host">
                                  <input type="hidden" class="form-control" id="id" placeholder="1">
                                </div>

                                <div class="form-group">
                                  <label for="address">Port</label>
                                  <input type="email" class="form-control" id="port" placeholder="Enter port">
                                </div>
                                <div class="form-group">
                                  <label for="location">Username</label>
                                  <input type="input" class="form-control" id="username" placeholder="Enter Username">
                                </div>

                                <div class="form-group">
                                  <label for="town">Password</label>
                                  <input type="input" class="form-control" id="pass" placeholder="Enter password">
                                </div>

                                <div class="form-group">
                                  <label for="town">Default Email</label>
                                  <input type="input" class="form-control" id="defaultemail" placeholder="Default Email">
                                </div>


                                <div class="form-group" syle="width:10% !important;">
                                  <label for="town">Default</label>
                                  <input type="checkbox" class="form-controls" id="def" placeholder="" syle="width:10% !important;">
                                </div> 

                              </div>      
                            </form>
                          </div>
                          </div> 
                         
                         <!--  <button type="button" onClick="createNew()" class="btn btn-primary">Save</button>  -->
                          <div class="col-md-4"></div> 
                          <div class="col-md-4">  </div> 
                          <div class="col-md-4"><button style="visibility:hidden;" type="button" id="saveRecord" onClick="saveRecord()" class="btn btn-block btn-danger enabled">Save</button><button type="button" id="createNew" onClick="createNew()" class="btn btn-block btn-danger enabled">Save</button> </div> 

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
                <!-- The template to display files available for upload --> 
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
                <script src="<?php echo base_url('assets/js/settings.js')?>"></script> 
                </div>
                <!-- /.post -->

                <!-- Post -->
                <div class="post clearfix">
                  <div class="user-block">
                    <img class="img-circle img-bordered-sm" src='<?php echo base_url("assets/img/clinic1.jpg");?>' alt="">
                        <span class="username">
                          <a href="#">Smtp details</a>
                          <a href="#" class="pull-right btn-box-tool"><i class="fa fa-times"></i></a>
                        </span>
                    <span class="description">form view</span>
                  </div>
                  <!-- /.user-block -->
                        <span class="description">Host / Ip Address / Domain</span>
                        <p><input id="host1" class="form-control input-sm" placeholder="Host / IP / Domain">
                        <span class="description">Port</span>
                        <p><input id="port1" class="form-control input-sm" placeholder="Enter port">
                        <span class="description">User Name</span>
                        <p><input id="username1" class="form-control input-sm" placeholder="Enter Username">
                        <span class="description">Password</span>
                        <p><input id="pass1" class="form-control input-sm" placeholder="Enter password">
                        <span class="description">Default Email</span>
                        <p><input id="defaultemail1" class="form-control input-sm" placeholder="Enter default email">  
            
                </div>
                <!-- /.post -->
               
                <!-- /.post -->
              </div>  
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>

    
        <!-- /.col -->


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