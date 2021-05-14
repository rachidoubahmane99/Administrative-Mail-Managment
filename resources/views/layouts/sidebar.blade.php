<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{url('adminlte/dist/img/admindefaultprofile.png')}}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{session('FullName')}}</p>
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
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MENU DE  NAVIGATION</li>
        <li class="">
        <a href="/mails">
          <i class="fa fa-envelope-o"></i></i> <span>Tous les EMails</span>
          </a>

        </li>
        <li class="">
          <a href="/emails/encours">
            <i class="fa fa-circle" style="color:#90EE90"></i> <span> Email En cours</span>
          </a>
          
        </li>
        <li class="">
          <a href="/emails/traited">
            <i class="fa fa-circle" style="color:green"></i> <span> Email Traite</span>
          </a>

        </li>
        <li class="">
          <a href="/emails/notTraited">
            <i class="fa fa-circle" style="color: red"></i> <span> Email Non Traite</span>
          </a>

        </li>
        <li class="">
          <a href="/departements">
            <i class="fa fa-building" style="color: white"></i> <span>Services</span>
          </a>

        </li>
        <li class=" ">
          <a href="/admins">
            <i class="fa fa-user" style="color: white"></i> <span>Administrateurs</span>
          </a>

        </li>
        <li class="">
          <a href="/users">
            <i class="fa fa-users" style="color: white"></i> <span>{{'Personnel'}}</span>
          </a>

        </li>
        

        <!-- <li class="header">USERS</li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-stethoscope"></i>
            <span>Doctor</span>
            <span class="pull-right-container">
              <span class="label label-danger pull-right">21</span>
            </span>
          </a>
          <a href="#">
            <i class="fa fa-users"></i>
            <span>Patient</span>
            <span class="pull-right-container">
              <span class="label label-primary pull-right">4</span>
            </span>
          </a>
        </li> -->

        <!-- <li class="header">EBOOK</li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-book"></i>
            <span>E-Journal</span>
            <span class="pull-right-container">
              <span class="label label-danger pull-right">21</span>
            </span>
          </a>
          <a href="#">
            <i class="fa fa-umbrella"></i>
            <span>E-Policy</span>
            <span class="pull-right-container">
              <span class="label label-warning pull-right">7</span>
            </span>
          </a>
          <a href="#">
            <i class="fa fa-newspaper-o"></i>
            <span>E-Magazine</span>
            <span class="pull-right-container">
              <span class="label label-default pull-right">4</span>
            </span>
          </a>          
        </li>

        <li class="header">OTHERS</li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-navicon"></i>
            <span>Article</span>
            <span class="pull-right-container">
              <span class="label label-danger pull-right">21</span>
            </span>
          </a>
          <a href="#">
            <i class="fa fa-clock-o"></i>
            <span>News</span>
            <span class="pull-right-container">
              <span class="label label-warning pull-right">7</span>
            </span>
          </a>
          <a href="#">
            <i class="fa fa-calendar"></i>
            <span>Event</span>
            <span class="pull-right-container">
              <span class="label label-success pull-right">4</span>
            </span>
          </a>
          <a href="#">
            <i class="fa fa-image"></i>
            <span>Slider</span>
            <span class="pull-right-container">
              <span class="label label-primary pull-right">4</span>
            </span>
          </a>                      
        </li>                           -->
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
