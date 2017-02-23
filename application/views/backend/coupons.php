 
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
        Coupons and Discounts
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
        <div class="col-md-6">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#activity" data-toggle="tab">Product list</a></li>            
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
				                    <th>Drug description</th>
				                    <th>Tax</th>
				                    <th>Trade Price</th>					            
				                </tr>
				            </thead>
				            <tbody>
				            </tbody>
				 
				            <tfoot>
				                <tr>
				         
				                </tr>
				            </tfoot>
				        </table>	  

				 
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
        				<script src="<?php echo base_url('assets/js/coupons.js')?>"></script> 
                </div>
                <!-- /.post -->

                <!-- Post -->
                <div class="post clearfix">
                  <div class="user-block">
                    <img class="img-circle img-bordered-sm" src='<?php echo base_url("assets/img/drug1.jpg");?>' alt="">
                        <span class="username">
                          <a href="#">Product Coupons</a>
                          <a href="#" class="pull-right btn-box-tool"><i class="fa fa-times"></i></a>
                        </span>
                    <span class="description">Generate  Coupon Codes</span>
                  </div>

                 <div class="user-block">


                    <div class="btn-group">
                      <button type="button" onClick = "generatecoupons()" class="btn btn-danger">Generate Coupons</button>
                      <button type="button" onClick = "clearCoupons()" class="btn btn-danger">Clear</button>              
                    </div>


                  </div>  

                <table id="coupontable" class="cdataTable" cellspacing="0" width="100%">
                              <thead>
                                  <tr>
                                      <th>Id</th>                                
                                      <th>Coupon Code</th>
                                      <th>Amount</th> 
                                      <th>Status</th>                                                                                                    
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









                <div class="col-md-3">


                  <!-- Drug dosage-->
                  <div class="box box-primary">
                    <div class="box-body box-profile">
                       <div class="user-block">
                          <img class="img-circle img-bordered-sm" src='<?php echo base_url("assets/img/drug2.jpg");?>' alt="">
                              <span class="username">
                                <a href="#">Discount</a>
                                <a href="#" class="pull-right btn-box-tool"><i class="fa fa-times"></i></a>
                              </span>
                          <span class="description">Set product discount.</span>
                        </div>
                    </div>


                                <form role="form" id="dosageform" name="dosageform">
                                    <div class="box-body">
                                      <div class="form-group">
                                        <label for="dosename">Qty purchased (Set ( * ) for all qty)</label>
                                        <input type="text" class="form-control" id="qty" name="qty" placeholder="Qty purchased, set * for all quantities">
                                      </div>

                                      <div class="form-group">
                                        <label for="dose">Discount amount</label>
                                        <input type="text" class="form-control" id="amount" name="amount"  placeholder="Amount">
                                      </div>
                                    </div>
                                    <!-- /.box-body -->
                                    <div class="box-footer">
                                      <button type="button" id="dosSave" name="dosSave" class="btn btn-primary" onClick="saveDiscount(this)">Submit</button>
                                    </div>
                                  </form>

                    <!-- /.box-body -->
                  </div>                
                 
                 
                  <!-- /.box -->
                </div>

              </div>
              <!-- /.row -->
            </section>
            <!-- /.content -->
          </div>
          <!-- /.content-wrapper -->       
                
                
                
        <div id="dialogpopupcoupon" class="well" style="visibility:hidden;">
                   <div id ="popupheading" > <h4>Generate Coupons</h4> </div>

                      <div class="col-md-12">
                            <!-- general form elements -->
                          <div class="box box-primary"> 
                            <!-- form start -->
                            <form role="form">
                              <div class="box-body">


                                <div class="form-group">
                                  <label for="couponumber">Number of Coupons</label>
                                  <input type="input" class="form-control" id="couponumber" placeholder="Number of Coupons">
                                  <input type="hidden" class="form-control" id="couponid" placeholder="1">
                                </div>

                                <div class="form-group">
                                  <label for="couponamount">Amount (ksh)</label>
                                  <input type="couponamount" class="form-control" id="couponamount" placeholder="0.00">
                                </div>


                              </div>      
                            </form>
                          </div>
                          </div>                           
                          <div class="col-md-4"></div> 
                          <div class="col-md-4">  </div> 
                          <div class="col-md-4"><button type="button" id="createCoupons" onClick="createCoupons()" class="btn btn-block btn-danger enabled">Generate</button> </div> 

                </div>

