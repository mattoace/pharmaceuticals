<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>PHARM</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href='<?php echo base_url("assets/plugins/bootstrap/css/bootstrap.min.css");?>'>
  <!-- Font Awesome -->
 <link rel="stylesheet" href='<?php echo base_url("assets/plugins/font-awesome/font-awesome.min.css");?>'>
  <!-- Ionicons -->
   <link rel="stylesheet" href='<?php echo base_url("assets/plugins/font-awesome/ionicons.min.css");?>'>
  <link rel="stylesheet" href='<?php echo base_url("assets/css/AdminLTE.min.css");?>'>
  <link rel="stylesheet" href='<?php echo base_url("assets/css/skins/_all-skins.min.css");?>'>
  <!-- iCheck -->
  <link rel="stylesheet" href='<?php echo base_url("assets/plugins/iCheck/flat/blue.css");?>'>
  <!-- Morris chart -->
  <link rel="stylesheet" href='<?php echo base_url("assets/plugins/morris/morris.css");?>'>
  <!-- jvectormap -->
  <link rel="stylesheet" href='<?php echo base_url("assets/plugins/jvectormap/jquery-jvectormap-1.2.2.css");?>'>
  <!-- Date Picker -->
  <link rel="stylesheet" href='<?php echo base_url("assets/plugins/datepicker/datepicker3.css");?>'>
  <!-- Daterange picker -->
  <link rel="stylesheet" href='<?php echo base_url("assets/plugins/daterangepicker/daterangepicker.css");?>'>
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href='<?php echo base_url("assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css");?>'>

  <link rel="stylesheet" href='<?php echo base_url("assets/css/style.css");?>'>

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js");?>'></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js");?>'></script>
  <![endif]-->
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="admin" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b></b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg" style="font-size:12px"><b style="font-size:16px">tiba</b>moja | <b>ADMIN</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">          
       
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <?php
               $userid = $_COOKIE['userlogin'];
               $query = $this->db->query('SELECT * FROM users u, persons p WHERE u.personid = p.id AND u.id = "'.$userid.'"'); 
               $row = $query->result();
             ?> 
              <img src='<?php echo base_url($row[0]->img);?>' class="user-image" alt="">
              <span class="hidden-xs"><?php echo $row[0]->firstname ." " . $row[0]->secondname; ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src='<?php echo base_url($row[0]->img);?>' class="img-circle" alt="">

                <p>
                  <?php echo $row[0]->firstname ." " . $row[0]->secondname; ?>
                  <small><?php echo  $row[0]->address; ?></small>
                </p>
              </li>
              <!-- Menu Body -->
              <li class="user-body">
                <div class="row">
                  <div class="col-xs-4 text-center">
                    <a href="#"><?php echo  $row[0]->phone; ?></a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#"><?php echo  $row[0]->town; ?></a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#"><?php echo  $row[0]->email; ?></a>
                  </div>
                </div>
                <!-- /.row -->
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">                
                <div class="pull-right">
                  <a href="alogin" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <!--<li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li> -->
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <?php
         $userid = $_COOKIE['userlogin'];
         $query = $this->db->query('SELECT * FROM users u, persons p WHERE u.personid = p.id AND u.id = "'.$userid.'"'); 
         $row = $query->result();
       ?> 
      <div class="user-panel">
        <div class="pull-left image">
          <img  src='<?php echo base_url($row[0]->img);?>' class="img-circle" alt="" style="width:200px;height:50px;">
        </div>
        <div class="pull-left info">
      <p><?php echo $row[0]->firstname ." " . $row[0]->secondname; ?></p>
      <a href="#"><i class="fa fa-circle text-success"></i> Online</a>



        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->  
      <ul class="sidebar-menu">
    <li class="header">MAIN NAVIGATION</li>

<script>

function getCookie(c_name)
{
    var i, x, y, ARRcookies = document.cookie.split(";");
    for (i = 0; i < ARRcookies.length; i++)
    {
        x = ARRcookies[i].substr(0, ARRcookies[i].indexOf("="));
        y = ARRcookies[i].substr(ARRcookies[i].indexOf("=") + 1);
        x = x.replace(/^\s+|\s+$/g, "");
        if (x == c_name)
        {
            return unescape(y);
        }
    }
}

function setCookie(c_name, value, exdays)
{
    var exdate = new Date();
    exdate.setDate(exdate.getDate() + exdays);
    var c_value = escape(value) + ((exdays == null) ? "" : "; expires=" + exdate.toUTCString());
    document.cookie = c_name + "=" + c_value;
}

function setActiveLink(obj){
  var pathname = new URL(obj).pathname;
  var splitUrl = pathname.split('/');
  setCookie("url", splitUrl[1], 1); 
  if(splitUrl[1]) window.location = pathname;
  return this;
}
</script>
<style>
.treeview-menu > li {
    background-color: #357ca5;
}
.activesubtree{
  background-color: #00A65A !important;
  font-weight: 900;
}
</style>
<?php  
     // get the roes configurations from the database
     $queryUsers = $this->db->query('SELECT moduleid FROM roles WHERE userid = "'.$userid.'"'); 
     $rowUsers = $queryUsers->result();

    if(count($rowUsers) > 0 ){

     foreach ($rowUsers as $roleId) { 

        $modarray = explode("_",$roleId->moduleid); 

        if($modarray[0]== "main"){
          $moduleid[] = $modarray[1];
        }else{
         //get the main parent
           $queryParent = $this->db->query('SELECT parentid FROM menu WHERE id = "'.$modarray[2].'"');
           $rowParent = $queryParent->result(); 
           $moduleid[] = $rowParent[0]->parentid;
           $moduleid[] = $modarray[2];
        } 
      }
     $moduleid = array_unique($moduleid);
     $modules = implode(",", $moduleid);

     }else{
        print('<b><i>no access!</i></b>');
       $modules = 0;
     }

     $query = $this->db->query('SELECT * FROM menu WHERE parentid is null AND id IN ('.$modules .')');

     $row = $query->result();
     $indx = 0; $subindx = 0;
      foreach ($row as $menu) {          
            print('<li id="mainmenu_'.$indx.'" class="'.$setactive.'">');
          // if($menu->url){
             //   print('<a  href="#">'); 
           // }else{
                print('<a onClick="setActiveLink(this)" href="'.base_url($menu->url).'">'); 
           // }          
           
            print(' <i class="'.$menu->class.'"></i>');
            print(' <span>'.$menu->menuname.'</span>');          
            print($menu->option);         
            print(' </a>');              

                $querychild = $this->db->query('SELECT * FROM menu WHERE parentid = "'.$menu->id.'" AND id IN ('.$modules .')'); 
                $rowchild = $querychild->result();
                 print('<ul class="treeview-menu">');
                    foreach ($rowchild as $submenu) {
                            print('<li id="submenu_'.$subindx.'"><a onClick="setActiveLink(this)" href="'.base_url($submenu->url).'"><i class="'.$submenu->class.'"></i>'.$submenu->menuname.'</a></li>');
                    if($_COOKIE['url'] == $submenu->url){        
                            print('
                              <script>
                                var list = document.getElementById("mainmenu_'.$indx.'");
                                list.className = "active treeview"; 

                                var sublist = document.getElementById("submenu_'.$subindx.'");
                                sublist.className = "activesubtree"; 
                              </script>
                              ');
                          }else{


                          }
                           $subindx++;
                      }
                 print('</ul>');


            print(' </li>');
         $indx++;
        }

 ?>
    </section>
    <!-- /.sidebar -->
  </aside>