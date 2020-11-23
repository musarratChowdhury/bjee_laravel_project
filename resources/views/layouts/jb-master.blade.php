<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="">
<!--<![endif]-->

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>@yield('title-tag') Bangladesh Journal of Extension Education</title>
  <meta name="description" content="Ela Admin - HTML5 Admin Template">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="apple-touch-icon" href="{{ asset('/journal-backend') }}/images/favicon.png">
  <link rel="shortcut icon" href="{{ asset('/journal-backend') }}/images/favicon.png">
  <link rel="stylesheet" href="{{ asset('/journal-backend') }}/assets/css/normalize.css">
  <link rel="stylesheet" href="{{ asset('/journal-backend') }}/assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="{{ asset('/journal-backend') }}/assets/css/font-awesome.min.css">
  <link rel="stylesheet" href="{{ asset('/journal-backend') }}/assets/css/themify-icons.css">
  <link rel="stylesheet" href="{{ asset('/journal-backend') }}/assets/css/pe-icon-7-filled.css">
  <link rel="stylesheet" href="{{ asset('/journal-backend') }}/assets/css/flag-icon.min.css">
  <link rel="stylesheet" href="{{ asset('/journal-backend') }}/assets/css/cs-skin-elastic.css">
  <link href="//cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="{{ asset('/journal-backend') }}/assets/css/style.css">
  <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

</head>

<body>

  <aside id="left-panel" class="left-panel">
    <nav class="navbar navbar-expand-sm navbar-default">
      <div id="main-menu" class="main-menu collapse navbar-collapse">
        <ul class="nav navbar-nav">
          <li>
            <a href="{{ route('editor.journals') }}"><i class="menu-icon fa fa-laptop"></i>Dashboard </a>
          </li>

          <li class="menu-title">Menu Links</li>

          <li class="menu-item-has-children dropdown">
            <a href="{{ route('editor.journals') }}" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-table"></i>Articles</a>
            <ul class="sub-menu children dropdown-menu">
              <li><i class="fa fa-table"></i><a href="{{ route('editor.journals') }}">Articles</a></li>
              <li><i class="fa fa-plus"></i><a href="{{ route('editor.create-journal') }}"> Add New Article</a></li>
              <!-- <li><i class="fa fa-cogs"></i><a href="journal-types.blade.html"> Journal Types</a></li> -->
            </ul>
          </li>
          
          <li class="menu-item-has-children dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-table"></i>Volumes</a>
            <ul class="sub-menu children dropdown-menu">
              <li><i class="fa fa-table"></i><a href="{{ route('editor.volumes') }}">Volumes</a></li>
              <li><i class="fa fa-plus"></i><a href="{{ route('editor.create-volume') }}"> Add New Volumes</a></li>
              <!--<li><i class="fa fa-cogs"></i><a href="news-category.blade.html"> News Category</a></li>-->
            </ul>
          </li>
          
           <li class="menu-item-has-children dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-table"></i>Article Authors</a>
            <ul class="sub-menu children dropdown-menu">
              <li><i class="fa fa-table"></i><a href="{{ route('editor.article-author') }}">Article Authors</a></li>
              <li><i class="fa fa-plus"></i><a href="{{ route('editor.create-article-author') }}"> Add New Article Authors</a></li>
              <!--<li><i class="fa fa-cogs"></i><a href="news-category.blade.html"> News Category</a></li>-->
            </ul>
          </li>
          

          <li class="menu-item-has-children dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-table"></i>News</a>
            <ul class="sub-menu children dropdown-menu">
              <li><i class="fa fa-table"></i><a href="news.blade.html">News</a></li>
              <li><i class="fa fa-plus"></i><a href="add-news.blade.html"> Add New News</a></li>
              <li><i class="fa fa-cogs"></i><a href="news-category.blade.html"> News Category</a></li>
            </ul>
          </li>

          <li class="menu-item-has-children dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-table"></i>Users</a>      
                <ul class="sub-menu children dropdown-menu">
                    <li><i class="fa fa-table"></i><a href="#">Users</a></li>
                    <li><i class="fa fa-plus"></i><a href="#"> Add New User</a></li>
                    <li><i class="fa fa-cogs"></i><a href="#"> User Role</a></li>
                    <li><i class="fa fa-check-square"></i><a href="#"> User Permission</a></li>
                </ul>                 
            </li>
          <li>
            <a href="{{ route('editor.journals') }}"><i class="menu-icon fa fa-cog"></i>Settings </a>
          </li>
        </ul>
      </div>
    </nav>
  </aside>

  <div id="right-panel" class="right-panel">

    <header id="header" class="header">
      <div class="top-left">
        <div class="navbar-header">
          <a class="navbar-brand" href="{{ route('editor.journals') }}"><img src="{{ asset('/journal-backend') }}/images/logo.png" alt="Logo"></a>
          <a class="navbar-brand hidden" href="{{ route('editor.journals') }}"><img src="{{ asset('journal-backend/') }}/images/logo2.png" alt="Logo"></a>
          <a id="menuToggle" class="menutoggle"><i class="fa fa-bars"></i></a>
        </div>
      </div>
      <div class="top-right">
        <div class="header-menu">
          <div class="header-left">
          </div>
          <div class="user-area dropdown float-right">
            <a href="#" class="dropdown-toggle active" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <img class="user-avatar rounded-circle" src="{{ asset('/journal-backend') }}/images/admin.jpg" alt="User Avatar">
            </a>
            <div class="user-menu dropdown-menu">
              <a class="nav-link" href="#"><i class="fa fa-user"></i>My Profile</a>
              <a class="nav-link" href="#"><i class="fa fa-cog"></i>Settings</a>
              <a class="nav-link" href="#"><i class="fa fa-power-off"></i>Logout</a>
            </div>
          </div>
        </div>
      </div>
    </header>

    @yield('content')

    <div class="clearfix"></div>

    <footer class="site-footer">
      <div class="footer-inner bg-white">
        <div class="row">
          <div class="col-sm-6">
            Copyright &copy; 2018 Bjee
          </div>
          <div class="col-sm-6 text-right">
            Designed by <a href="http://jbee.com.bd/">Jbee</a>
          </div>
        </div>
      </div>
    </footer>
  </div>

  <script src="{{ asset('/journal-backend') }}/assets/js/vendor/jquery-2.1.4.min.js" type="text/javascript"></script>
  <script src="{{ asset('/journal-backend') }}/assets/js/popper.min.js" type="text/javascript"></script>
  <script src="{{ asset('/journal-backend') }}/assets/js/plugins.js" type="text/javascript"></script>
  <script src="//cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
  <script src="{{ asset('/journal-backend') }}/assets/js/main.js" type="text/javascript"></script>
  <script src="{{ asset('/journal-backend') }}/assets/js/rocket-loader.min.js"></script>
  
  @yield('script')



 





</body>

</html>