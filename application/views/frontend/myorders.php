
  <link rel="stylesheet" href='<?php echo base_url("assets/plugins/bootstrap/css/bootstrap.min.css");?>'>
  <link rel="shortcut icon" href="<?php echo base_url("assets/img/favicon.ico");?>" type="image/x-icon">
  <link rel="stylesheet" href='<?php echo base_url("assets/plugins/font-awesome/font-awesome.min.css");?>'> 
  <link rel="stylesheet" href='<?php echo base_url("assets/plugins/font-awesome/ionicons.min.css");?>'>
  <link rel="stylesheet" href='<?php echo base_url("assets/css/AdminLTE.min.css");?>'>
  <link rel="stylesheet" href='<?php echo base_url("assets/css/skins/_all-skins.min.css");?>'>
  <link rel="stylesheet" href='<?php echo base_url("assets/plugins/iCheck/flat/blue.css");?>'>
  <link rel="stylesheet" href='<?php echo base_url("assets/plugins/morris/morris.css");?>'>
  <link rel="stylesheet" href='<?php echo base_url("assets/plugins/jvectormap/jquery-jvectormap-1.2.2.css");?>'>
  <link rel="stylesheet" href='<?php echo base_url("assets/plugins/datepicker/datepicker3.css");?>'>
  <link rel="stylesheet" href='<?php echo base_url("assets/plugins/daterangepicker/daterangepicker.css");?>'>
  <link rel="stylesheet" href='<?php echo base_url("assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css");?>'>
  <link rel="stylesheet" href='<?php echo base_url("assets/plugins/datatables/jquery.dataTables.min.css");?>'>
  <link rel="stylesheet" href='<?php echo base_url("assets/plugins/datatables/jquery.dataTables_themeroller.css");?>'>
  <link rel="stylesheet" href='<?php echo base_url("assets/plugins/datatables/dataTables.bootstrap.css");?>'>
  <link rel="stylesheet" href='<?php echo base_url("assets/plugins/datatables/extensions/Select/scroller.dataTables.min.css");?>'>
  <link rel="stylesheet" href='<?php echo base_url("assets/css/style.css");?>'>
  <link rel="stylesheet" href='<?php echo base_url("assets/css/upload.css");?>'>
  <style>
 .container {
    width: 95%;
}
.content-wrapper, .right-side {
    background-color: transparent !important;
}
.content-wrapper, .right-side {
     background-color: transparent !important;  
}
.content-wrapper {
    min-height: 0 !important;
}
.dataTables_processing {
    background-color: transparent !important;
}

.dataTables_wrapper .dataTables_paginate { 
    visibility: hidden;
}
.dataTables_info {
    visibility: hidden;
}
.cDatatable{

}
</style>
<?php
               $userid = $_COOKIE['userlogin'];
               $query = $this->db->query('SELECT p.* FROM users u, persons p WHERE u.personid = p.id AND u.id = "'.$userid.'"'); 
               $row = $query->result();
?>
<script>
var userid = "<?php  echo $row[0]->id; ?>"; 
</script>
<div class="container">
  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h4>
       My Orders
      </h4>     
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-md-3">
          <!-- Profile Image -->
          <div class="box box-primary">
           <div class="box box-primary">
            <div class="box-body box-profile">

             <?php
               $userid = $_COOKIE['userlogin'];
               $query = $this->db->query('SELECT * FROM users u, persons p WHERE u.personid = p.id AND u.id = "'.$userid.'"'); 
               $row = $query->result();
             ?>             

              <img class="profile-user-img img-responsive img-circle" id="personimageholder" src='<?php echo base_url($row[0]->img);?>' alt="">            

              <h5><span class="hidden-xs"><?php echo $row[0]->firstname ." " . $row[0]->secondname; ?></span></h5>


            </div>
            <!-- /.box-body -->
          </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

     
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#activity" data-toggle="tab">Orders</a></li>          
            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="activity">
                <!-- Post -->
                <div class="post">
                  <div class="user-block">
                  
                  </div>
                  <!-- /.user-block -->
 
                    <table id="orderstable" class="cDatatable" cellspacing="0" width="100%" style="line-height:none !important;">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Order Date</th>
                            <th>Order No.</th>
                            <th>Store</th>
                            <th>F.Name</th>
                            <th>S.Name</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>Order Status</th>  
                            <th>File</th>   
                            <th>Raw Path</th>                        
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
</div>
      <div id="uploadpopup" class="well" style="visibility:hidden;">  
            <form id="upload" method="post" action="user-file-upload" enctype="multipart/form-data">
              <input type="hidden" class="form-control" id="selid" name = "selid" placeholder="1">
              <div id="drop">
                  Drop Here
                <a>Browse</a>
                <input type="file" name="upl" multiple />
              </div>

              <ul>                                   
              </ul>
            </form>                     
         </div>

<script src='<?php echo base_url("assets/plugins/jQuery/jquery-ui.min.js");?>'></script>
<script src='<?php echo base_url("assets/plugins/jquery-popup-overlay-gh-pages/jquery.popupoverlay.js");?>'></script>
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<script src='<?php echo base_url("assets/plugins/bootstrap/js/bootstrap.min.js");?>'></script>
<script src='<?php echo base_url("assets/plugins/sparkline/jquery.sparkline.min.js");?>'></script>
<script src='<?php echo base_url("assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js");?>'></script>
<script src='<?php echo base_url("assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js");?>'></script>
<script src='<?php echo base_url("assets/plugins/moments/moment.min.js");?>'></script>
<script src='<?php echo base_url("assets/plugins/daterangepicker/daterangepicker.js");?>'></script>
<script src='<?php echo base_url("assets/plugins/datepicker/bootstrap-datepicker.js");?>'></script>
<script src='<?php echo base_url("assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js");?>'></script>
<script src='<?php echo base_url("assets/plugins/slimScroll/jquery.slimscroll.min.js");?>'></script>
<script src='<?php echo base_url("assets/plugins/fastclick/fastclick.js");?>'></script>
<script src='<?php echo base_url("assets/js/app.min.js");?>'></script>
<script src="<?php echo base_url('assets/plugins/datatables/jquery.dataTables.min.js')?>"></script>
<script src="<?php echo base_url('assets/plugins/datatables/dataTables.bootstrap.min.js')?>"></script>
<script src="<?php echo base_url('assets/plugins/datatables/extensions/Select/dataTables.select.min.js')?>"></script>
<script src="<?php echo base_url('assets/plugins/uploadplugin/jquery.knob.js')?>"></script> 
<script src="<?php echo base_url('assets/plugins/uploadplugin/jquery.ui.widget.js')?>"></script> 
<script src="<?php echo base_url('assets/plugins/uploadplugin/jquery.iframe-transport.js')?>"></script> 
<script src="<?php echo base_url('assets/plugins/uploadplugin/jquery.fileupload.js')?>"></script>  
<script src='<?php echo base_url("assets/js/front/myorders.js");?>'></script>
