<?php
/*
  // Para utilização em hospedagem web
    
    $ref = explode('://', $_SERVER['HTTP_REFERER']);
    $ref = $ref[0].'://';
    $url = $ref.$_SERVER['HTTP_HOST'].'/views/';  
*/
$url = 'http://localhost/Controle-de-Estoque-em-PHP/views/'; // Remova em caso de utilizar o código para hospedagem web 

$head = '<!DOCTYPE html>
<html>
<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta http-equiv="content-language" content="pt-br" /> 
  <title>AdminLTE 2 | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="' . $url . 'bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="' . $url . 'plugins/datatables/dataTables.bootstrap.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="' . $url . 'dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="' . $url . 'dist/css/skins/_all-skins.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="' . $url . 'plugins/iCheck/flat/blue.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="' . $url . 'plugins/morris/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="' . $url . 'plugins/jvectormap/jquery-jvectormap-1.2.2.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="' . $url . 'plugins/datepicker/datepicker3.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="' . $url . 'plugins/daterangepicker/daterangepicker.css">

  <link rel="stylesheet" href="' . $url . 'plugins/datatables/dataTables.bootstrap.css">
  
  
  
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="' . $url . 'plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <script src="https://apis.google.com/js/platform.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <!-- Lista Cliente CPF -->

<script type="text/javascript">
 
 $(document).ready(function(){  
  
      $("#cpfCliente").keyup(function(){  
           var query = $(this).val();  
           if(query != "")  
           {  
                $.ajax({  
                     url:"' . $url . '../App/Database/search.php",  
                     method:"POST",  
                     data:{query:query},  
                     success:function(data)  
                     {  
                          
                          $(\'#Listdata\').fadeIn();  
                          $(\'#Listdata\').html(data);  
                     }  
                });  
           }  
      });  


      $(\'#Listdata\').on("click","li", function(){  
           $(\'#cpfCliente\').val($(this).text());  
           $(\'#Listdata\').fadeOut();
           <!-- console.log(event.target);-->
      });
  });  
 </script>

<!-- List products -->
<script type="text/javascript">
 
 $(document).ready(function(){  
  
      $("#idItem").keyup(function(){  
           var idItem = $(this).val();  
           console.log(idItem);
           if(idItem != "")  
           {  
                $.ajax({  
                     url:"' . $url . '../App/Database/searchproducts.php",  
                     method:"POST",  
                     data:{idItem:idItem},  
                     success:function(data)  
                     {  
                          console.log(data);
                          $(\'#ListProd\').fadeIn();  
                          $(\'#ListProd\').html(data); 
                           
                     }  
                });  
           }  
      });  


      $(\'#ListProd\').on("click","li", function(){  
           $(\'#idItem\').val($(this).text());  
           $(\'#ListProd\').fadeOut();
           <!-- console.log(event.target);-->
      });
  });  
 </script>
<!-- Fim List products -->


 <!-- FIM Lista Cliente CPF --> 

 <!-- Consulta Qtd venda -->

<script type="text/javascript">

 $(document).ready(function(){

      $("#prodSubmit").click(function()  {
    var prodSubmit = $("#prodSubmit").val();
    var idItens = $("#idItem").val();
    var idItens = idItens.split(\' - \');
    var idItem = idItens[0];
    var nameprod = idItens[1];
    var qtde = $("#qtd").val();

    console.log(idItem);
    
    $.ajax({
      type: "POST",
      url: "' . $url . '../App/Database/carrinho.php",
      data: {prodSubmit: prodSubmit, idItem: idItem, nameprod: nameprod, qtde:qtde},
      success: function(data){
              $(\'#listable\').fadeIn();  
              $(\'#listable\').html(data);
              document.getElementById(\'idItem\').value = null;
                          document.getElementById(\'qtd\').value = null;

          }
      });
    }); 

    $(\'#listable\').on("click","li", function(){  
           $(\'#idItem\').val($(data).text());
           $(\'#qtd\').val($(data).text());  
           $(\'#listable\').fadeOut();
          
            return false;

           <!-- console.log(event.target);-->
      });           
            
    
 });  
 </script>

<!-- Imprimir Venda -->

  <script type="text/javascript">
    
    function cont(){
       var conteudo = document.getElementById(\'print\').innerHTML;
       tela_impressao = window.open(\'about:blank\');
       tela_impressao.document.write(conteudo);
       tela_impressao.window.print();
       tela_impressao.window.close(); 
    }

</script>

<!-- Imprimir Venda --> 

  <script type="text/javascript">
    $(document).ready(function(){
    $("input[name=\'status[]\']").click(function(){
      var $this = $( this );//guardando o ponteiro em uma variavel, por performance


      var status = $this.attr(\'checked\') ? 1 : 0;
      var id = $this.next(\'input\').val();


      $.ajax({
        url: \'action.php\',
        type: \'GET\',
        data: \'status=\'+status+\'&id=\'+id,
        success: function( data ){
          alert( data );
        }
      });
    });
  }); 
  </script>



 <script type="text/javascript">
(function ($) {

    RemoveTableRow = function (handler) {
        var tr = $(handler).closest(\'tr\');

        tr.fadeOut(400, function () {
            tr.remove();
        });

        return false;
    };

    AddTableRow = function () {

        var newRow = $("<tr>");
        var cols = \'<td></td>\';
        var tabela = document.getElementById(\'products-table\');
        var a = (tabela.getElementsByTagName(\'tr\'));
        var b = a.length;
        var i = b - 2;
        var cont = 7 + i;

        cols += \'<td><input type="text" class="form-control" id="idItem" name="idItem[]" autocomplete="off" /></td>\';
        cols += \'<td><input type="text" class="form-control" id="qtd" name="qtd[]" autocomplete="off" /><span id="stv" name="stv[]"></span></td>\';
        cols += \'<td class="actions">\';
        cols += \'<button class="btn btn-danger btn-xs" onclick="RemoveTableRow(this)" type="button"><i class="fa fa-trash"></i></button>\';
        cols += \'</td>\';

        newRow.append(cols);
        $("#products-table").append(newRow);
        return false;
    };


})(jQuery);
</script>

<!-- Consulta Qtd Vendas -->

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn\'t work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->


</head>
<body class="skin-blue sidebar-mini" style="height: auto; min-height: 100%;">
<div class="wrapper" style="height: auto; min-height: 100%;">';

$header = '<header class="main-header">
    <!-- Logo -->
    <a href="' . $url . '" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>A</b>LT</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Admin</b>LTE</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          <li class="dropdown messages-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-envelope-o"></i>
              <span class="label label-success">4</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 4 messages</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li><!-- start message -->
                    <a href="#">
                      <div class="pull-left">
                        <img src="' . $url . 'dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Support Team
                        <small><i class="fa fa-clock-o"></i> 5 mins</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                  <!-- end message -->
                  <li>
                    <a href="#">
                      <div class="pull-left">
                        <img src="' . $url . 'dist/img/user3-128x128.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        AdminLTE Design Team
                        <small><i class="fa fa-clock-o"></i> 2 hours</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="pull-left">
                        <img src="' . $url . 'dist/img/user4-128x128.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Developers
                        <small><i class="fa fa-clock-o"></i> Today</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="pull-left">
                        <img src="' . $url . 'dist/img/user3-128x128.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Sales Department
                        <small><i class="fa fa-clock-o"></i> Yesterday</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="pull-left">
                        <img src="' . $url . 'dist/img/user4-128x128.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Reviewers
                        <small><i class="fa fa-clock-o"></i> 2 days</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="footer"><a href="#">See All Messages</a></li>
            </ul>
          </li>
          <!-- Notifications: style can be found in dropdown.less -->
          <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning">10</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 10 notifications</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li>
                    <a href="#">
                      <i class="fa fa-users text-aqua"></i> 5 new members joined today
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-warning text-yellow"></i> Very long description here that may not fit into the
                      page and may cause design problems
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-users text-red"></i> 5 new members joined
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-shopping-cart text-green"></i> 25 sales made
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-user text-red"></i> You changed your username
                    </a>
                  </li>
                </ul>
              </li>
              <li class="footer"><a href="#">View all</a></li>
            </ul>
          </li>
          <!-- Tasks: style can be found in dropdown.less -->
          <li class="dropdown tasks-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-flag-o"></i>
              <span class="label label-danger">9</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 9 tasks</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li><!-- Task item -->
                    <a href="#">
                      <h3>
                        Design some buttons
                        <small class="pull-right">20%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">20% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <!-- end task item -->
                  <li><!-- Task item -->
                    <a href="#">
                      <h3>
                        Create a nice theme
                        <small class="pull-right">40%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-green" style="width: 40%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">40% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <!-- end task item -->
                  <li><!-- Task item -->
                    <a href="#">
                      <h3>
                        Some task I need to do
                        <small class="pull-right">60%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-red" style="width: 60%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">60% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <!-- end task item -->
                  <li><!-- Task item -->
                    <a href="#">
                      <h3>
                        Make beautiful transitions
                        <small class="pull-right">80%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-yellow" style="width: 80%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">80% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <!-- end task item -->
                </ul>
              </li>
              <li class="footer">
                <a href="#">View all tasks</a>
              </li>
            </ul>
          </li>
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="' . $url . '' . $foto . '" class="user-image" alt="User Image">
              <span class="hidden-xs">' . $username . '</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="' . $url . '' . $foto . '" class="img-circle" alt="User Image">

                <p>
                  ' . $username . ' - ';
switch ($perm) {

  case 0:
    $header .= 'Cliente';
    break;
  case 1:
    $header .= 'Administrador';
    break;
  case 2:
    $header .= 'Vendedor';
    break;
}

$header .= ' <small>Member since Nov. 2012</small>
                </p>
              </li>
              <!-- Menu Body -->
              <li class="user-body">
                <div class="row">
                  <div class="col-xs-4 text-center">
                    <a href="#">Followers</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Sales</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Friends</a>
                  </div>
                </div>
                <!-- /.row -->
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="' . $url . 'usuarios/profile.php" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="' . $url . 'destroy.php" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>
    </nav>
  </header>';

$aside = '<!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="' . $url . '' . $foto . '" class="img-circle" style="height:50px; width:50px;" alt="User Image">
         
        </div>
        <div class="pull-left info">
          <p>' . $username . '</p>
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
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
        <li class="active treeview">
          <a href="' . $url . '">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            
          </a>
          
        </li>
        
<!-- Produtos -->

        <li class="treeview">
          <a href="#">
            <i class="fa fa-table"></i>
            <span>Produtos</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="' . $url . 'prod/"><i class="fa fa-circle-o"></i>Produtos</a></li>
            <li><a href="' . $url . 'prod/addprod.php"><i class="fa fa-circle-o"></i>Add Produtos</a></li>
            <li><a href="' . $url . 'itens/"><i class="fa fa-circle-o"></i>Itens</a></li>
             <li><a href="' . $url . 'itens/totalitens.php"><i class="fa fa-circle-o"></i>Total Itens</a></li>
            <li><a href="' . $url . 'itens/additens.php"><i class="fa fa-circle-o"></i>Add Itens</a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-table"></i>
            <span>Relatorios</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="' . $url . 'relatorios/"><i class="fa fa-circle-o"></i>Relatorios Produtos</a></li>
            <!--<li><a href="' . $url . 'relatorios/compclientes.php"><i class="fa fa-circle-o"></i>Relatorios Clientes</a></li>-->
            
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-table"></i>
            <span>Fabricante</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="' . $url . 'fabricante/"><i class="fa fa-circle-o"></i>Fabricantes</a></li>
            <li><a href="' . $url . 'fabricante/addfabricante.php"><i class="fa fa-circle-o"></i>Add Fabricante</a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-table"></i>
            <span>Representante</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="' . $url . 'representante/"><i class="fa fa-circle-o"></i>Representantes</a></li>            
            <li><a href="' . $url . 'representante/addrepresentante.php"><i class="fa fa-circle-o"></i>Add Representante</a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-table"></i>
            <span>Usuários</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="' . $url . 'usuarios/"><i class="fa fa-circle-o"></i>Lista</a></li>
            <li><a href="' . $url . 'usuarios/addusuarios.php"><i class="fa fa-circle-o"></i>Add Usuários</a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-table"></i>
            <span>Cliente</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="' . $url . 'cliente/"><i class="fa fa-circle-o"></i>Lista</a></li>
            <li><a href="' . $url . 'cliente/addcliente.php"><i class="fa fa-circle-o"></i>Add Cliente</a></li>
            
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-table"></i>
            <span>Vendas</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="' . $url . 'vendas/"><i class="fa fa-circle-o"></i>Vendas</a></li>
            
          </ul>
        </li>

        
        <li><a href="documentation/index.html"><i class="fa fa-book"></i> <span>Documentation</span></a></li>
        <li class="header">LABELS</li>
        <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Important</span></a></li>
        <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Warning</span></a></li>
        <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>';

$footer = '<footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.3.8
    </div>
    <strong>Copyright &copy; 2014-2016 <a href="http://almsaeedstudio.com">Almsaeed Studio</a>.</strong> All rights
    reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">Recent Activity</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-birthday-cake bg-red"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Langdon\'s Birthday</h4>

                <p>Will be 23 on April 24th</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-user bg-yellow"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

                <p>New phone +1(800)555-1234</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

                <p>nora@example.com</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-file-code-o bg-green"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

                <p>Execution time 5 seconds</p>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

        <h3 class="control-sidebar-heading">Tasks Progress</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Custom Template Design
                <span class="label label-danger pull-right">70%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Update Resume
                <span class="label label-success pull-right">95%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-success" style="width: 95%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Laravel Integration
                <span class="label label-warning pull-right">50%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Back End Framework
                <span class="label label-primary pull-right">68%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

      </div>
      <!-- /.tab-pane -->
      <!-- Stats tab content -->
      <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Report panel usage
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Some information about this general settings option
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Allow mail redirect
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Other sets of options are available
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Expose author name in posts
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Allow the user to show his name in blog posts
            </p>
          </div>
          <!-- /.form-group -->

          <h3 class="control-sidebar-heading">Chat Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Show me as online
              <input type="checkbox" class="pull-right" checked>
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Turn off notifications
              <input type="checkbox" class="pull-right">
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Delete chat history
              <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
            </label>
          </div>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar\'s background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>';

$javascript = '

  </div>
<!-- jQuery 2.2.3 -->
<script src="https://code.jquery.com/jquery-2.2.3.js"></script>

<!-- jQuery UI 1.11.4 -->
<script src="http://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge(\'uibutton\', $.ui.button);
</script>
<!-- Bootstrap 3.3.6 -->
<script src="' . $url . 'bootstrap/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="' . $url . 'plugins/morris/morris.min.js"></script>
<!-- Sparkline -->
<script src="' . $url . 'plugins/sparkline/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="' . $url . 'plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="' . $url . 'plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="' . $url . 'plugins/knob/jquery.knob.js"></script>
<!-- daterangepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="' . $url . 'plugins/datatables/jquery.dataTables.min.js"></script>
<script src="' . $url . 'plugins/datatables/dataTables.bootstrap.min.js"></script>

<script src="' . $url . 'plugins/daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="' . $url . 'plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="' . $url . 'plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="' . $url . 'plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="' . $url . 'plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="' . $url . 'dist/js/app.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="' . $url . 'dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="' . $url . 'dist/js/demo.js"></script>
<script>
  
  $(function () {
    $(\'#example1\').DataTable()
    $(\'#example2\').DataTable({
      \'paging\'      : true,
      \'lengthChange\': false,
      \'searching\'   : false,
      \'ordering\'    : true,
      \'info\'        : true,
      \'autoWidth\'   : false
    })
})
</script>

</body>
</html>
';
