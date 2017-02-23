 
    <!-- Google web fonts -->
<link href="http://fonts.googleapis.com/css?family=PT+Sans+Narrow:400,700" rel='stylesheet' />
<link rel="stylesheet" href='<?php echo base_url("assets/plugins/datatables/jquery.dataTables.min.css");?>'>
<link rel="stylesheet" href='<?php echo base_url("assets/plugins/selectator/fm.selectator.jquery.min.css");?>'>
<link rel="stylesheet" href='<?php echo base_url("assets/plugins/datatables/jquery.dataTables_themeroller.css");?>'>
<link rel="stylesheet" href='<?php echo base_url("assets/plugins/datatables/dataTables.bootstrap.css");?>'>
<link rel="stylesheet" href='<?php echo base_url("assets/css/style.css");?>'>
<link rel="stylesheet" href='<?php echo base_url("assets/css/upload.css");?>'>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Staff
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Person</a></li>
        <li class="active">Staff</li>
      </ol>
    </section>  

<script>
var personType = 2;
</script>


    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">

             <a href="#" class="" onClick="changePersonImage()"> <p class="text-muted text-center" id="changeimg">Change image</p>

              <img class="profile-user-img img-responsive img-circle" id="personimageholder" src='<?php echo base_url("assets/img/persondefault.jpg");?>' alt="">

              <h3 class="profile-username text-center" id="personname"></h3>

              <p class="text-muted text-center" id="personaddress"></p></a>
        
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- About Me Box -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">About Me</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <strong><i class="fa fa-book margin-r-5"></i>Education</strong>

              <p class="text-muted">
              
                 <textarea class="textareas" id="emailbody" name="education" placeholder="Education Information" style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                
              </p>

              <hr>

              <strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>

              <p class="text-muted"><input type="text" id="patientlocation" name="emailbody" placeholder="Location" style="width:100%;"></p>             

              <hr>

              <strong><i class="fa fa-file-text-o margin-r-5"></i> Notes</strong>

              <p> <textarea class="textareas" id="emailbody" name="education" placeholder="Notes on health information" style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea></p>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#activity" data-toggle="tab">Staff</a></li>              
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
				                    <th>First Name</th>
				                    <th>Second Name</th>
				                    <th>Phone</th>
				                    <th>Address</th>
				                    <th>Town</th>				            
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
                   <div id ="popupheading" > <h4>Add a new staff</h4> </div>

              
                   <div class="box-body box-profile">                           
                          <label for="select1">
                            Select pharmacy where staff belongs:
                          </label>
                          <select id="select1" name="select1" style="width:100%;" onchange="">
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
                        </div>
                       

                      <div class="col-md-6">
                            <!-- general form elements -->
                          <div class="box box-primary"> 
                            <!-- form start -->
                            <form role="form">
                              <div class="box-body">


                                <div class="form-group">
                                  <label for="initial">Title</label>
                                  <input type="input" class="form-control" id="initial" placeholder="Mr./Mrs./Miss">
                                  <input type="hidden" class="form-control" id="id" placeholder="1">
                                </div>

                                <div class="form-group">
                                  <label for="firstname">First Name</label>
                                  <input type="email" class="form-control" id="firstname" placeholder="First Name">
                                </div>
                                <div class="form-group">
                                  <label for="secondname">Second Name</label>
                                  <input type="input" class="form-control" id="secondname" placeholder="Second Name">
                                </div>

                                <div class="form-group">
                                  <label for="surname">Surname</label>
                                  <input type="input" class="form-control" id="surname" placeholder="Surname">
                                </div>

                                <div class="form-group">
                                  <label for="gender">Gender</label>
                                          <select class="form-control select2" style="width: 100%;" id="gender">
                                            <option selected="selected">Male</option>           
                                            <option>Female</option>
                                          </select>
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
                                              <label for="dob">Date Of Birth</label>
                                                <div class="input-group date">
                                                  <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                  </div>
                                                     <!--   <input type="text" class="form-control pull-right" id="datepickerpop"> -->
                                                     <input type="text" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask id="dob">

                                                </div>
                                            </div>
                                            <div class="form-group">
                                              <label for="nationalid">National Id</label>
                                              <input type="input" class="form-control" id="nationalid" placeholder="National Id / Passort">
                                            </div>
                                            <div class="form-group">
                                              <label for="address">Address</label>
                                              <input type="input" class="form-control" id="address" placeholder="Address">
                                            </div>
                                            <div class="form-group">
                                              <label for="phone">Telephone</label>
                                              <input type="input" class="form-control" id="phone" placeholder="Telephone">
                                            </div>
                                            <div class="form-group">
                                              <label for="town">Town</label>
                                              <input type="input" class="form-control" id="town" placeholder="Town">
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
                <script src="<?php echo base_url('assets/plugins/selectator/fm.selectator.jquery.js')?>"></script> 
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
                <script src="<?php echo base_url('assets/plugins/uploadplugin/jquery.fileupload.js')?>"></script> 


        				<script src="<?php echo base_url('assets/js/patient.js')?>"></script> 
                </div>
                <!-- /.post -->

                <!-- Post -->
                <div class="post clearfix">
                  <div class="user-block">
                    <img class="img-circle img-bordered-sm" src='<?php echo base_url("assets/img/patient1.jpg");?>' alt="">
                        <span class="username">
                          <a href="#">Staff details</a>
                          <a href="#" class="pull-right btn-box-tool"><i class="fa fa-times"></i></a>
                        </span>
                    <span class="description">Form view staff information</span>
                  </div>
                  <!-- /.user-block -->

                      <div class="col-md-6">
                            <!-- general form elements -->
                          <div class="box box-primary"> 
                            <!-- form start -->
                            <form role="form">
                              <div class="box-body">


                                <div class="form-group">
                                  <label for="initial">Title</label>
                                  <input type="input" class="form-control" id="initial1" placeholder="Mr./Mrs./Miss">
                                  <input type="hidden" class="form-control" id="id1" placeholder="1">
                                </div>

                                <div class="form-group">
                                  <label for="firstname">First Name</label>
                                  <input type="email" class="form-control" id="firstname1" placeholder="First Name">
                                </div>
                                <div class="form-group">
                                  <label for="secondname">Second Name</label>
                                  <input type="input" class="form-control" id="secondname1" placeholder="Second Name">
                                </div>

                                <div class="form-group">
                                  <label for="surname">Surname</label>
                                  <input type="input" class="form-control" id="surname1" placeholder="Surname">
                                </div>

                                <div class="form-group">
                                  <label for="gender">Gender</label>
                                          <select class="form-control select2" style="width: 100%;" id="gende1r">
                                            <option selected="selected">Male</option>           
                                            <option>Female</option>
                                          </select>
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
                                              <label for="dob">Date Of Birth</label>
                                                <div class="input-group date">
                                                  <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                  </div>
                                                     <!--   <input type="text" class="form-control pull-right" id="datepickerpop"> -->
                                                     <input type="text" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask id="dob1">

                                                </div>
                                            </div>
                                            <div class="form-group">
                                              <label for="nationalid">National Id</label>
                                              <input type="input" class="form-control" id="nationalid1" placeholder="National Id / Passort">
                                            </div>
                                            <div class="form-group">
                                              <label for="address">Address</label>
                                              <input type="input" class="form-control" id="address1" placeholder="Address">
                                            </div>
                                            <div class="form-group">
                                              <label for="phone">Telephone</label>
                                              <input type="input" class="form-control" id="phone1" placeholder="Telephone">
                                            </div>
                                            <div class="form-group">
                                              <label for="town">Town</label>
                                              <input type="input" class="form-control" id="town1" placeholder="Town">
                                            </div>
                                          </div>                         
                                        </form>
                                      </div>



                          </div>
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
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->



            <div id="uploadpopup" class="well" style="visibility:hidden;">
                   <!-- <div id ="popupheading" > <h5>Picture</h5> </div>   -->                

                          <!--  <div class="col-md-12">  -->

                                    <form id="upload" method="post" action="person-upload" enctype="multipart/form-data">
                                      <input type="hidden" class="form-control" id="selid" name = "selid" placeholder="1">
                                      <div id="drop">
                                          Drop Here
                                        <a>Browse</a>
                                        <input type="file" name="upl" multiple />
                                      </div>

                                      <ul>
                                        <!-- The file uploads will be shown here -->
                                      </ul>

                                    </form>

                        <!--   </div>  -->
                </div>