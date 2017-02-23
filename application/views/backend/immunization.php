 
    <!-- Google web fonts -->
<link href="http://fonts.googleapis.com/css?family=PT+Sans+Narrow:400,700" rel='stylesheet' />
<link rel="stylesheet" href='<?php echo base_url("assets/plugins/datatables/jquery.dataTables.min.css");?>'>
<link rel="stylesheet" href='<?php echo base_url("assets/plugins/datatables/jquery.dataTables_themeroller.css");?>'>
<link rel="stylesheet" href='<?php echo base_url("assets/plugins/datatables/dataTables.bootstrap.css");?>'>
<link rel="stylesheet" href='<?php echo base_url("assets/plugins/datatables/extensions/Select/scroller.dataTables.min.css");?>'>
<link rel="stylesheet" href='<?php echo base_url("assets/css/style.css");?>'>
<link rel="stylesheet" href='<?php echo base_url("assets/css/upload.css");?>'>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Patients immunization information
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Patient</a></li>
        <li class="active">Patient Immunization Information</li>
      </ol>
    </section>

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

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>New Orders</b> <a class="pull-right">1</a>
                </li>
                <li class="list-group-item">
                  <b>Unconfirmed Orders</b> <a class="pull-right">0</a>
                </li>
                <li class="list-group-item">
                  <b>Invoices</b> <a class="pull-right">0</a>
                </li>
              </ul>

              <a href="patientrefill" class="btn btn-primary btn-block"><b>View Patient Payments</b></a>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- About Me Box -->
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
              <li class="active"><a href="#activity" data-toggle="tab">Patients list</a></li>
            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="activity">
                <!-- Post -->
                <div class="post">           


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
                   <div id ="popupheading" > <h4>Add a new patient</h4> </div>


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
        		<script src='<?php echo base_url("assets/plugins/bootstrap/js/bootstrap.min.js");?>'></script>
                <script src='<?php echo base_url("assets/plugins/datepicker/bootstrap-datepicker.js");?>'></script>
                <script src='<?php echo base_url("assets/plugins/input-mask/jquery.inputmask.js");?>'></script>
                <script src='<?php echo base_url("assets/plugins/input-mask/jquery.inputmask.date.extensions.js");?>'></script>
                <script src='<?php echo base_url("assets/plugins/input-mask/jquery.inputmask.extensions.js");?>'></script>
        		<script src="<?php echo base_url('assets/plugins/datatables/jquery.dataTables.min.js')?>"></script>
        		<script src="<?php echo base_url('assets/plugins/datatables/dataTables.bootstrap.min.js')?>"></script>

            <script src="<?php echo base_url('assets/plugins/datatables/extensions/Select/dataTables.select.min.js')?>"></script> 

                <script src="<?php echo base_url('assets/plugins/uploadplugin/jquery.knob.js')?>"></script> 
                <script src="<?php echo base_url('assets/plugins/uploadplugin/jquery.ui.widget.js')?>"></script> 
                <script src="<?php echo base_url('assets/plugins/uploadplugin/jquery.iframe-transport.js')?>"></script> 
                <script src="<?php echo base_url('assets/plugins/uploadplugin/jquery.fileupload.js')?>"></script> 


        		<script src="<?php echo base_url('assets/js/immunization.js')?>"></script> 
                </div>
                <!-- /.post -->

                <!-- Post -->
                <div class="post clearfix">
                  <div class="user-block">
                    <img class="img-circle img-bordered-sm" src='<?php echo base_url("assets/img/prescription1.jpg");?>' alt="">
                        <span class="username">
                          <a href="#">Patient's Immunization Details</a>
                        </span>
                    <span class="description">History of patient immunization</span>
                  </div>

                  <div class="rowr">
                   <div class="user-block">
                    <div class="btn-group">
                      <button type="button" onClick = "addInsu()" class="btn btn-danger">Save</button>
                      <button type="button" onClick = "clearInsu()" class="btn btn-danger">Clear</button>
                      <button type="button" onClick = "deleteInsu()" class="btn btn-danger">Delete</button>
                    </div>

                   </div> 

                  </div>
                  <!-- /.user-block -->
                  <p>
                  	<div class="row">
                     <div class="col-md-6">


                            <form role="form">
                              <div class="box-body">

                                <div class="form-group">
                                  <label for="initial">Nature/Type of Immunization</label>
                                  <input type="input" class="form-control" id="immunization" placeholder="Type of immunisation">
                                  <input type="hidden" class="form-control" id="immun_id" placeholder="1">
                                </div>

                                <div class="form-group">
                                  <label for="firstname">Immunization date</label>
                                  <input type="input" class="form-control" id="immundate" placeholder="Date">
                                </div>
                                <div class="form-group">
                                  <label for="secondname">Clinic attended</label>
                                  <input type="input" class="form-control" id="clinicattended" placeholder="Clinic attended">
                                </div>

                               

                              </div>      
                            </form>

                     </div> 

                     <div class="col-md-6">

                   
                      <table id="prescriptiontable" class="cdataTable" cellspacing="0" width="100%">
                              <thead>
                                  <tr>
                                      <th>Id</th>                                
                                      <th>Nature/Type</th>
                                      <th>Date</th>
                                      <th>Clinic</th>                                                                 
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
                  </p>
       
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