 
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

<link rel="stylesheet" type="text/css" href='<?php echo base_url("assets/plugins/dhxtree/codebase/dhtmlxtree.css");?>'>
<link rel="stylesheet" type="text/css" href='<?php echo base_url("assets/plugins/dhxtree/codebase/fonts/font_roboto/roboto.css");?>'>
<link rel="stylesheet" type="text/css" href='<?php echo base_url("assets/plugins/dhxtree/codebase/dhtmlxmenu.css");?>'>
<link rel="stylesheet" type="text/css" href='<?php echo base_url("assets/plugins/dhxmessage/codebase/themes/message_growl_shiny.css");?>'>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Edit Banners / Sliders
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Category</a></li>
        <li class="active">Sliders</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
                                                        
      <div class="row">


        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">

             Product Categories  - 


            <label for="select1">
              select your category below:
            </label>          

              <div class="user-block">
                       <div id="treeBox" style="width:100%;height:500"></div>  
                  </div>  
            <br>

          </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->  
        </div>


        <!-- /.col -->
        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#activity" data-toggle="tab">Add Image(s) to a Category</a></li>
               <li><a href="#homepage" data-toggle="tab">Home Page Images</a></li>
              <!--<li><a href="#settings" data-toggle="tab">Re-Order Due</a></li>  -->            
            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="activity" style="background-color:;">
                <!-- Post -->
                          <!-- Post -->
                <div class="post">
                 <h6><b>Category images</b></h6>
                  <div class="user-block" style="background-color:#EEEEEE;">
                     <img class="img-circle img-bordered-sm" src='<?php echo base_url("assets/img/drug2.png");?>' alt=""> 
                   <div class="col-sm-9">
                        <span class="username" style="margin-left: 0px;">
                          <a href="#">Preview Images</a>
                          <a href="#" class="pull-left btn-box-tool"><i class="fa fa-times4"></i></a>
                        </span>
                    <span class="description" style="margin-left: 0px;">Preview uploaded images for the medicines</span>
                     </div>
                   <div class="col-sm-3">
                        <button type="submit" class="btn btn-danger pull-right btn-block btn-sm" onClick="uploadimage(this)">Upload Image</button>
                      </div>
                  </div>
                  <!-- /.user-block -->
                  <div class="row margin-bottom"> 

                            <div id="images-box" class="col-sm-8">
                            </div> 

                              <div id="files" class="col-sm-4">

                                   <div class="box box-primary">
                                                      <div class="box-header with-border">                      
                                                      </div>                   
                                                      <div class="box-body">
                                                        <strong><i class="fa fa-book margin-r-5"></i> Files uploaded</strong>
                                                        <p class="text-muted">
                                                            <table id="filestable" class="display" cellspacing="0" width="100%">
                                                                  <thead>
                                                                      <tr>
                                                                          <th>Id</th>
                                                                          <th>No</th>
                                                                          <th>Filename</th>
                                                                          <th>Delete</th>                                                 
                                                                      </tr>
                                                                  </thead>
                                                                  <tbody>
                                                                  </tbody>
                                                       
                                                                  <tfoot>
                                                                      <tr>
                                                               
                                                                      </tr>
                                                                  </tfoot>
                                                              </table>
                                                        </p>
                                                      </div>                    
                                                    </div> 


                              </div>     
                   
                    <!-- /.col -->
                  </div>
                  <!-- /.row -->


                 <div class="row margin-bottom"> 
                    <div class="box box-primary">  <label for="storename">Slider text</label>                  
                            <form role="form">
                              <div class="box-body">                               
                                 <button type="submit" class="btn btn-danger pull-right btn-block btn-sm" style = "width:20%;margin-bottom:2%;s" onClick="saveSliderText(this)">Save text</button>                      
                                 <div class="form-group">
                                  <input type="input" class="form-control" id="slidertext" placeholder="Slidertext">
                                  <input type="hidden" class="form-control" id="idslider" placeholder="1">
                                </div>
                              </div>
                              </form>
                       </div>
                 </div>
                </div>
                <!-- /.post -->     


            
				 
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
                <script src="<?php echo base_url('assets/plugins/dhxtree/codebase/dhtmlxmenu.js')?>"></script>  
                <script src="<?php echo base_url('assets/plugins/dhxtree/codebase/dhtmlxtree.js')?>"></script>
                <script src="<?php echo base_url('assets/plugins/dhxmessage/codebase/message.js')?>"></script>   
        		<script src="<?php echo base_url('assets/js/banners.js')?>"></script> 

              </div>
              <!-- /.tab-pane -->

             <div class="tab-pane" id="homepage" style="background-color:;"> 
                  <h6><b>Homapage Images</b></h6>

                  <div class="user-block" style="background-color:#EEEEEE;">
                                     <img class="img-circle img-bordered-sm" src='<?php echo base_url("assets/img/drug2.png");?>' alt=""> 
                                   <div class="col-sm-9">
                                        <span class="username" style="margin-left: 0px;">
                                          <a href="#">Preview Images</a>
                                          <a href="#" class="pull-left btn-box-tool"><i class="fa fa-times4"></i></a>
                                        </span>
                                    <span class="description" style="margin-left: 0px;">Preview uploaded images for the medicines</span>
                                     </div>
                                   <div class="col-sm-3">
                                        <button type="submit" class="btn btn-danger pull-right btn-block btn-sm" onClick="uploadimageHome(this)">Upload Image</button>
                                      </div>
                                  </div>




                                <!-- /.user-block -->
                                <div class="row margin-bottom"> 

                                          <div id="images-boxhome" class="col-sm-8">
                                          </div> 

                                            <div id="fileshomepage" class="col-sm-4">

                                                 <div class="box box-primary">
                                                                    <div class="box-header with-border">                      
                                                                    </div>                   
                                                                    <div class="box-body">
                                                                      <strong><i class="fa fa-book margin-r-5"></i> Files uploaded</strong>
                                                                      <p class="text-muted">
                                                                          <table id="filestablehome" class="display" cellspacing="0" width="100%">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th>Id</th>
                                                                                        <th>No</th>
                                                                                        <th>Filename</th>
                                                                                        <th>Delete</th>                                                 
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                </tbody>
                                                                     
                                                                                <tfoot>
                                                                                    <tr>
                                                                             
                                                                                    </tr>
                                                                                </tfoot>
                                                                            </table>
                                                                      </p>
                                                                    </div>                    
                                                                  </div> 


                                            </div>     
                                 
                                  <!-- /.col -->
                                </div>
                                <!-- /.row -->
               
                              <div class="box box-primary" style="margin-top-20%;">  <label for="storename">Slider text</label>                  
                                      <form role="form">
                                        <div class="box-body">                               
                                           <button type="submit" class="btn btn-danger pull-right btn-block btn-sm" style = "width:20%;margin-bottom:2%;s" onClick="saveSliderTextHome(this)">Save text</button>                      
                                           <div class="form-group">
                                            <input type="input" class="form-control" id="slidertexthome" placeholder="Slidertext">
                                            <input type="hidden" class="form-control" id="idslider" placeholder="1">
                                          </div>
                                        </div>
                                        </form>
                                 </div>
                           



             </div>

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


             <div id="categoriespopup" class="well" style="visibility:hidden;width:50%;height: 70%; overflow-x: hidden;overflow-y: auto;background-color:#ECF0F5;">
               <div class="row"> 
                 <div class="col-md-12" style="background-color:#DFF0D8"> 



                  <div class="row">


                        <div class="box box-primary">
                          <div class="box-body box-profile">                       
                          <label for="select2">
                            Search category you want to assign drugs to.
                          </label>
                          <select id="select2" name="select2" style="width:100%;" onchange="selectChangedCategory(this)">
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
                          <input value="activate selectator" id="activate_selectator2" type="button" style="visibility:hidden;">                      
                        </div>
                      </div>

                </div>



                  <div class="col-md-5"> 


                      <table id="checkdrugtable" class="cdataTable" cellspacing="0"  style="">
                            <thead>
                                <tr>
                                    <th></th>                                  
                                    <th>Products list</th>                                                          
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

                     <table id="assigneddrugtable" class="cdataTable" cellspacing="0"  style="">
                            <thead>
                                <tr>
                                    <th></th>                                 
                                    <th>Products assigned</th>                                                          
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










