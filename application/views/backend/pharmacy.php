 
    <!-- Google web fonts -->
<link href="http://fonts.googleapis.com/css?family=PT+Sans+Narrow:400,700" rel='stylesheet' />
<link rel="stylesheet" href='<?php echo base_url("assets/plugins/datatables/jquery.dataTables.min.css");?>'>
<link rel="stylesheet" href='<?php echo base_url("assets/plugins/datatables/jquery.dataTables_themeroller.css");?>'>
<link rel="stylesheet" href='<?php echo base_url("assets/plugins/datatables/dataTables.bootstrap.css");?>'>
<link rel="stylesheet" href='<?php echo base_url("assets/css/style.css");?>'>
<link rel="stylesheet" href='<?php echo base_url("assets/css/upload.css");?>'>


<link href="http://fonts.googleapis.com/css?family=PT+Sans+Narrow:400,700" rel='stylesheet' />
<link rel="stylesheet" href='<?php echo base_url("assets/plugins/datatables/jquery.dataTables.min.css");?>'>
<link rel="stylesheet" href='<?php echo base_url("assets/plugins/selectator/fm.selectator.jquery.min.css");?>'>
<link rel="stylesheet" href='<?php echo base_url("assets/plugins/datatables/jquery.dataTables_themeroller.css");?>'>
<link rel="stylesheet" href='<?php echo base_url("assets/plugins/datatables/dataTables.bootstrap.css");?>'>

<link rel="stylesheet" href='<?php echo base_url("assets/plugins/jqueryfileupload/css/jquery.fileupload.css");?>'>
<link rel="stylesheet" href='<?php echo base_url("assets/plugins/jqueryfileupload/css/jquery.fileupload-ui.css");?>'>

<link rel="stylesheet" href='<?php echo base_url("assets/plugins/jqueryfileupload/css/jquery.fileupload-noscript.css");?>'>
<link rel="stylesheet" href='<?php echo base_url("assets/plugins/jqueryfileupload/css/jquery.fileupload-ui-noscript.css");?>'>

<link rel="stylesheet" href='<?php echo base_url("assets/css/style.css");?>'>
<link rel="stylesheet" href='<?php echo base_url("assets/css/gallery.css");?>'>
<link rel="stylesheet" href='<?php echo base_url("assets/css/upload.css");?>'>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Subscribed pharmacy
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Pharmacy</a></li>
        <li class="active">Services</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">      
        <div class="col-md-12">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#activity" data-toggle="tab">List of Pharmacies/Stores</a></li>    
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
				                    <th>Store Name</th>
				                    <th>Telephone</th>
                            <th>Email</th>
				                    <th>Location</th>
				                    <th>Latitude</th>
				                    <th>Longitude</th>
                            <th>Additional Services</th>				            
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
                   <div id ="popupheading" > <h4>Add a new patient</h4> </div>


                      <div class="col-md-6">
                            <!-- general form elements -->
                          <div class="box box-primary"> 
                            <!-- form start -->
                            <form role="form">
                              <div class="box-body">


                                <div class="form-group">
                                  <label for="storename">Store Name</label>
                                  <input type="input" class="form-control" id="storename" placeholder="Store Name">
                                  <input type="hidden" class="form-control" id="id" placeholder="1">
                                </div>

                                <div class="form-group">
                                  <label for="address">Address</label>
                                  <input type="email" class="form-control" id="address" placeholder="Address">
                                </div>

                                <div class="form-group">
                                  <label for="telephone">Telephone</label>
                                  <input type="email" class="form-control" id="telephone" placeholder="Telephone">
                                </div>


                                <div class="form-group">
                                  <label for="email">Email</label>
                                  <input type="email" class="form-control" id="email" placeholder="Email">
                                </div>

                                <div class="form-group">
                                  <label for="location">Location</label>
                                  <input type="input" class="form-control" id="location" placeholder="Location">
                                </div>

                              </div>      
                            </form>
                          </div>

                          </div> 

                           <div class="col-md-6">
                                      <!-- general form elements -->
                                      <div class="box box-primary">                    
                                        <!-- form start -->
                                        <form role="form">
                                          <div class="box-body">                                      
                                            <div class="form-group">
                                              <label for="latitude">Latitude</label>
                                              <input type="input" class="form-control" id="latitude" placeholder="Latitude">
                                            </div>
                                            <div class="form-group">
                                              <label for="longitude">Longitude</label>
                                              <input type="input" class="form-control" id="longitude" placeholder="Longitude">
                                            </div>

                                          <div class="form-group">
                                            <label for="additionalservices">Additional Services</label>
                                            <input type="input" class="form-control" id="additionalservices" placeholder="Additional Services">
                                          </div>

                                            <div class="form-group">
                                              <label for="comments">Comments</label>
                                              <input type="input" class="form-control" id="comments" placeholder="Comments">
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
                  <script id="template-upload" type="text/x-tmpl">
                  {% for (var i=0, file; file=o.files[i]; i++) { %}
                      <tr class="template-upload fade">
                          <td>
                              <span class="preview"></span>
                          </td>
                          <td>
                              <p class="name">{%=file.name%}</p>
                              <strong class="error text-danger"></strong>
                          </td>
                          <td>
                              <p class="size">Processing...</p>
                              <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="progress-bar progress-bar-success" style="width:0%;"></div></div>
                          </td>
                          <td>
                              {% if (!i && !o.options.autoUpload) { %}
                                  <button class="btn btn-primary start" disabled>
                                      <i class="glyphicon glyphicon-upload"></i>
                                      <span>Start</span>
                                  </button>
                              {% } %}
                              {% if (!i) { %}
                                  <button class="btn btn-warning cancel">
                                      <i class="glyphicon glyphicon-ban-circle"></i>
                                      <span>Cancel</span>
                                  </button>
                              {% } %}
                          </td>
                      </tr>
                  {% } %}
                  </script>
                  <!-- The template to display files available for download -->
                  <script id="template-download" type="text/x-tmpl">
                  {% for (var i=0, file; file=o.files[i]; i++) { %}
                      <tr class="template-download fade">
                          <td>
                              <span class="preview">
                                  {% if (file.thumbnailUrl) { %}
                                      <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery><img src="{%=file.thumbnailUrl%}"></a>
                                  {% } %}
                              </span>
                          </td>
                          <td>
                              <p class="name">
                                  {% if (file.url) { %}
                                      <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" {%=file.thumbnailUrl?'data-gallery':''%}>{%=file.name%}</a>
                                  {% } else { %}
                                      <span>{%=file.name%}</span>
                                  {% } %}
                              </p>
                              {% if (file.error) { %}
                                  <div><span class="label label-danger">Error</span> {%=file.error%}</div>
                              {% } %}
                          </td>
                          <td>
                              <span class="size">{%=o.formatFileSize(file.size)%}</span>
                          </td>
                          <td>
                              {% if (file.deleteUrl) { %}
                                  <button class="btn btn-danger delete" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
                                      <i class="glyphicon glyphicon-trash"></i>
                                      <span>Delete</span>
                                  </button>
                                  <input type="checkbox" name="delete" value="1" class="toggle">
                              {% } else { %}
                                  <button class="btn btn-warning cancel">
                                      <i class="glyphicon glyphicon-ban-circle"></i>
                                      <span>Cancel</span>
                                  </button>
                              {% } %}
                          </td>
                      </tr>
                  {% } %}
                  </script>

				 
        				<!--<script src="<?php echo base_url('assets/plugins/jQuery/jquery-2.2.3.min.js')?>"></script>
        				<script src='<?php echo base_url("assets/plugins/jquery-popup-overlay-gh-pages/jquery.popupoverlay.js");?>'></script>
        				<script src='<?php echo base_url("assets/plugins/bootstrap/js/bootstrap.min.js");?>'></script>
                <script src='<?php echo base_url("assets/plugins/datepicker/bootstrap-datepicker.js");?>'></script>
                <script src='<?php echo base_url("assets/plugins/input-mask/jquery.inputmask.js");?>'></script>
                <script src='<?php echo base_url("assets/plugins/input-mask/jquery.inputmask.date.extensions.js");?>'></script>
                <script src='<?php echo base_url("assets/plugins/input-mask/jquery.inputmask.extensions.js");?>'></script>
        				<script src="<?php echo base_url('assets/plugins/datatables/jquery.dataTables.min.js')?>"></script>
        				<script src="<?php echo base_url('assets/plugins/datatables/dataTables.bootstrap.min.js')?>"></script> 

                <script src="<?php echo base_url('assets/plugins/uploadplugin/jquery.knob.js')?>"></script> 
                <script src="<?php echo base_url('assets/plugins/uploadplugin/jquery.ui.widget.js')?>"></script> 
                <script src="<?php echo base_url('assets/plugins/uploadplugin/jquery.iframe-transport.js')?>"></script> 
                <script src="<?php echo base_url('assets/plugins/uploadplugin/jquery.fileupload.js')?>"></script> -->


                <script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyCvLjXCDMebLLpmMPylPUTM3b4h7cpGnyo"></script> 
                <link rel="stylesheet" href='<?php echo base_url("assets/plugins/jquery_lat_long/css/jquery-gmaps-latlon-picker.css");?>'>                        
                <script src='<?php echo base_url("assets/plugins/jquery_lat_long/js/jquery-gmaps-latlon-picker.js");?>'></script>


               <!-- <script src="<?php echo base_url('assets/plugins/jqueryfileupload/js/tmpl.min.js')?>"></script> 
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
                <script src="<?php echo base_url('assets/plugins/jqueryfileupload/js/jquery.fileupload-ui.js')?>"></script>  -->


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

     


        				<script src="<?php echo base_url('assets/js/pharmacy.js')?>"></script> 
                </div>
                <!-- /.post -->

                <!-- Post -->
                <div class="post clearfix">
                  <div class="user-block">
                    <img class="img-circle img-bordered-sm" src='<?php echo base_url("assets/img/pharmacy1.jpg");?>' alt="">
                        <span class="username">
                          <a href="#">Pharmacy details</a>
                          <a href="#" class="pull-right btn-box-tool"><i class="fa fa-times"></i></a>
                        </span>
                    <span class="description">Information</span>
                  </div>
                  <!-- /.user-block -->                 
                  <form class="form-horizontal">
                    <div class="form-group margin-bottom-none">
                      <div class="col-sm-9">
                        <p><input class="form-control input-sm" placeholder="Store Name">
                        <p><input class="form-control input-sm" placeholder="Telephone">
                        <p><input class="form-control input-sm" placeholder="Email">
                        <p><input class="form-control input-sm" placeholder="Location">
                      </div>
                      <div class="col-sm-3">
                       <!--  <button type="submit" class="btn btn-danger pull-right btn-block btn-sm">Save</button> -->
                      </div>
                    </div>
                  </form>
                </div>
                <!-- /.post -->

                <!-- Post -->
                <div class="post">
                  <div class="user-block">
                    <img class="img-circle img-bordered-sm" src='<?php echo base_url("assets/img/pharmacy2.png");?>' alt="">
                        <span class="username">
                          <a href="#">Pharmacy images upload</a>
                          <a href="#" class="pull-right btn-box-tool"><i class="fa fa-times"></i></a>
                        </span>
                    <span class="description">Upload pharmacy images for preview</span>
                  </div>
                  <!-- /.user-block -->
                  <div class="row margin-bottom">
                    <div class="col-sm-6">
                      <img class="img-responsive" id="pharmacyholder" style="width:100%; height:20%;" src='<?php echo base_url("assets/img/pharmacy3.jpg");?>' alt=""><br>
                      <div class="col-sm-3">
                       <p> <button type="submit" class="btn btn-danger pull-right btn-block btn-sm" onClick="uploadimage(this)">Upload Image</button>
                      </div>

                     
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-6">
                      <div class="row">
                           <div class="latlong" id="latlong" ></div>

                            <fieldset class="gllpLatlonPicker">
                                <input type="text" class="gllpSearchField">
                                <input type="button" class="gllpSearchButton" value="search">
                                <div class="gllpMap">Google Maps</div>
                                <input type="hidden" id="mylatitude" class="gllpLatitude" value="20"/>
                                <input type="hidden" id="mylongitude" class="gllpLongitude" value="20"/>
                                <input type="hidden" class="gllpZoom" value="15"/>
                             </fieldset>

                     
                        <!-- /.col -->
                      </div>
                      <!-- /.row -->
                    </div>
                    <!-- /.col -->
                  </div>
                  <!-- /.row -->


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