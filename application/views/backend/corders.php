 
    <!-- Google web fonts -->
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
        Pharmacy system confirmed orders
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Stores</a></li>
        <li class="active">Drugs</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
                                                        
      <div class="row">


        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">

             Pharmacy list box


            <label for="select1">
              Search Pharmacy below:
            </label>
            <select id="select1" name="select1" style="width:100%;" onchange="selectChanged(this)">
              <?php //http://opensource.faroemedia.com/selectator/
               $query = $this->db->query('SELECT * FROM stores'); 
                    $i = 1;                                        
                  foreach ($query->result() as $row)
                      {
                      print('<option value="'.$row->id.'" data-right="'.$i.'"  data-left=" <img src='.base_url("assets/img/pharm.jpg").' >"  >'.$row->storename.'</option>'); 
                      $i++;
                      }

              ?>      
            </select>
            <input value="activate selectator" id="activate_selectator1" type="button" style="visibility:hidden;">
            <br>
            <br>

          </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- About Me Box -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">More</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <strong><i class="fa fa-book margin-r-5"></i> Information</strong>

              <p class="text-muted">
               Details on selected pharmacy
              </p>
              <hr>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->



          <div class="box box-primary">
            <div class="box-body box-profile">  
            <label for="select1">
              Filter drugs using category:
            </label>
                  <select id="select3" name="select3" style="width:100%;" onchange="selectChangedCategoryMain(this)">
                    <?php 
                     $query = $this->db->query('SELECT * FROM category'); 
                          $i = 1;                                        
                        foreach ($query->result() as $row)
                            {
                            print('<option value="'.$row->id.'" data-right="'.$i.'"  data-left=" <img src='.base_url("assets/img/logo1.png").' >"  >'.$row->categoryname.'</option>'); 
                            $i++;
                            }

                    ?>      
                  </select>
            <input value="activate selectator" id="activate_selectator3" type="button" style="visibility:hidden;">
            <br>
            <br>

          </div>
            <!-- /.box-body -->
          </div>


        </div>


        <!-- /.col -->
        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#activity" data-toggle="tab">Confirmed Orders</a></li>
         <!--      <li><a href="#timeline" data-toggle="tab">Drug categories</a></li>
              <li><a href="#settings" data-toggle="tab">Re-Order Due</a></li> -->
            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="activity">
                <!-- Post -->
                <div class="post">


              <div class="user-block">


                    <div class="btn-group">
                      <button type="button" id="confirmingselected" onClick = "sendInvoice()" class="btn btn-danger">Send Invoice</button>
                      <button type="button" onClick = "invoices()" class="btn btn-danger">Invoices</button> 
                      <button type="button" onClick = "generatePDF()" class="btn btn-danger">Generate Pdf</button>           
                    </div>


                  </div>          


                    <table id="persontable" class="display" cellspacing="0" width="100%" style="line-height:none !important;">
				            <thead>
				                <tr>
				                    <th>Id</th>
                            <th>Order No.</th>
				                    <th>Store</th>
				                    <th>F.Name</th>
				                    <th>S.Name</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>Order Status</th> 					            
				                </tr>
				            </thead>
				            <tbody>
				            </tbody>
				 
				            <tfoot>
				                <tr>
				         
				                </tr>
				            </tfoot>
				        </table>	
<br><hr>

               <div class="box box-primary">
                    <div class="box-header with-border">
                      <h3 class="box-title">View more on selected order</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                      <!-- order item grid -->

                <table id="itemtable" class="cdataTable" cellspacing="0" width="100%" style="line-height:none !important;">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Order No.</th>
                            <th>Location</th>
                            <th>Generic Name</th>
                            <th>Price</th>
                            <th>Tax</th>                                                  
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
                    <!-- /.box-body -->
                  </div>

      


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
                                  <label for="genericname">Item Name</label>
                                  <input type="input" class="form-control" id="genericname" placeholder="Generic Name">
                                  <input type="hidden" class="form-control" id="id" placeholder="1">
                                </div>

                                <div class="form-group">
                                  <label for="drugprice">Trade Price</label>
                                  <input type="email" class="form-control" id="drugprice" placeholder="0.00">
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
                                              <label for="tax">Tax</label>
                                              <input type="input" class="form-control" id="tax" placeholder="0.16">
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









            <!-- The blueimp Gallery widget -->
            <div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls" data-filter=":even">
                <div class="slides"></div>
                <h3 class="title"></h3>
                <a class="prev">‹</a>
                <a class="next">›</a>
                <a class="close">×</a>
                <a class="play-pause"></a>
                <ol class="indicator"></ol>
            </div>
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
                 <script src="<?php echo base_url('assets/plugins/pdf/pdfobject.js')?>"></script>    
        				<script src="<?php echo base_url('assets/js/corders.js')?>"></script> 
                </div>
                <!-- /.post -->


              
              </div>
              <!-- /.tab-pane -->

              <!-- /.tab-pane -->

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



            <div id="uploadpopup" class="well" style="visibility:hidden;">
                <!-- The file upload form used as target for the file upload widget -->
                <form id="fileupload" action="//jquery-file-upload.appspot.com/" method="POST" enctype="multipart/form-data">
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
                
                
                
                
        <!-- Fade & scale -->

                <div id="dialogpopupcat" class="well" style="visibility:hidden;">
                   <div id ="popupheadingcat" > <h4>Add a new category</h4> </div>


                      <div class="col-md-6">
                            <!-- general form elements -->
                          <div class="box box-primary"> 
                            <!-- form start -->
                            <form role="form">
                              <div class="box-body">


                                <div class="form-group">
                                  <label for="categoryname">Category Name</label>
                                  <input type="input" class="form-control" id="categoryname" placeholder="Category Name">
                                  <input type="hidden" class="form-control" id="idcat" placeholder="1">
                                </div>




                              </div>      
                            </form>
                          </div>

                          </div> 

                           <div class="col-md-6"> 

                           
                           <div class="box box-secondary"> 
                            <!-- form start -->
                            <form role="form">
                              <div class="box-body">
                                <div class="form-group">
                                  <label for="description">Category Description</label>
                                  <input type="textarea" class="form-control" id="description" placeholder="Additional details">
                                </div>                                 
                              </div>      
                            </form>
                          </div>


                          </div> 
                         <!--  <button type="button" onClick="createNew()" class="btn btn-primary">Save</button>  -->
                          <div class="col-md-4"></div> 
                          <div class="col-md-4">  </div> 
                          <div class="col-md-4"><button style="visibility:hidden;" type="button" id="saveRecord" onClick="saveCatRecord()" class="btn btn-block btn-danger enabled">Save</button><button type="button" id="createNew" onClick="createCatNew()" class="btn btn-block btn-danger enabled">Save</button> </div> 

                </div>




            <div id="dialogpopupimage" class="well" style="visibility:hidden;">   

              <div id="uploadpopupimage" class="well" style="visibility:hidden;">
                <!-- The file upload form used as target for the file upload widget -->
                <form id="fileuploadimage" action="//jquery-file-upload.appspot.com/" method="POST" enctype="multipart/form-data">
                  <input type="hidden" name="selId" id="selIdimg">
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




             <div id="confirmationpopup" class="well" style="visibility:hidden;width:50%;height: 70%; overflow-x: hidden;overflow-y: auto;background-color:#ECF0F5;">
               <div class="row"> 
                    <div class="btn-group">
                      <button type="button" id="confirmingselected" onClick = "confirmSelected()" class="btn btn-danger">Confirm Selected</button>  <br><hr>                             
                    </div>
                 <div class="col-md-12" style="background-color:#DFF0D8"> 
        

                  <div class="col-md-12">

                           <table id="confirmationtable" class="cdataTable" cellspacing="0" width="100%" style="line-height:none !important;">
                              <thead>
                                  <tr>
                                      <th></th>
                                      <th></th>
                                      <th>Location</th>
                                      <th>Generic Name</th>
                                      <th>Price</th>
                                      <th>Tax</th>                                                  
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


             <div id="pdfpopup" class="well" style="visibility:hidden;width:50%;height: 70%; overflow-x: hidden;overflow-y: auto;background-color:#ECF0F5;">             
              <!--   <iframe id="pdfpreview" src="" style="width:100%;height: 100%; "> -->
             </div> 










