<? 
 session_start();
?>
    
    <meta name="author" content="ProAce International, owner of Movemewithcare.com, the #1 Accredited and certified moving network for USA and Canada." />
    <meta name="Copyright" content="© 2006-2010 Movemewithcare.com.All Rights Reserved" />
    <meta name="language" content="en-us" />
    <meta name="classification" content="nationwide moving and relocation, transportation, loading and unloading, storage and warehousing, packing supplies providers, Canadian Full services movers, Moving between USA and Canada." />
    <meta name="distribution" content="nationwide" />
    <meta name="revisit-after" content="30 days" />
    <meta name="robots" content="ALL" />
    <script src="images/flash.js" type="text/javascript"></script>
    <? 
      include "prerequisites.php";
      #session_register("browser");
      $browser = CheckBrowser();
      //echo $_SESSION['browser'];
      ?>
    <meta name="verify-v1" content="DgZnMTWzdhiG5DvD+2KF83cB48e+P/0ZlJcWweem4KQ=" />
    <? 
      //connect to database
      require ('config.inc.php');
      $link = mysqli_connect($db_host, $db_user, $db_password)
       or die("Could not connect");
      mysqli_select_db($link, $db_locator_name) or die("Could not select database");
      ?>

      <script src="http://www.google-analytics.com/urchin.js" type="text/javascript"></script>
      <script type="text/javascript">
        _uacct = "UA-3315693-1";
        urchinTracker();
      </script>
    <!--[if IE 7]>
    <style type="text/css">
      #rtext{align:top;width:400px;height: 200px!important;height:20px;margin-left:430px;text-align: left;content: "";margin-top:-150px;}    
      #left_green_image{position: relative; bottom: 8px; }
    </style>
    <![endif]-->
    <!--[if IE 6]>
    <style type="text/css">
      #left_green_image{position: relative; bottom: 8px; }
      #right_green_image{margin-top:24px;}
    </style>
    <![endif]-->
    <!--[if IE 5]>
    <style type="text/css">
      #left_green_image{position: relative; bottom: 8px; }
      #right_green_image{margin-top:36px;}
      #lmenu{margin-top:22px!important;margin-top:30px;position:absolute;left:0px;top:346px;height:25px;width:400px;background-repeat: no-repeat;visibility: visible;content: "";}
      #scrollmar{margin-top:0px;margin-bottom:12px;display: inline;height:40px;padding: 0px;background-color:#036AB5;background-image: url(images/midpanel_a.gif);background-repeat:repeat-x;}
    </style>
    <![endif]-->
    <!-- Google Font -->
    <link href='https://fonts.googleapis.com/css?family=Raleway:500,600,700,800,900,400,300' rel='stylesheet' type='text/css'>

    <link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,900,300italic,400italic' rel='stylesheet' type='text/css'>
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Owl Carousel Assets -->
    <link href="css/owl.carousel.css" rel="stylesheet">
    <link href="css/owl.theme.css" rel="stylesheet">


    <!-- Pixeden Icon Font -->
    <link rel="stylesheet" href="css/Pe-icon-7-stroke.css">

    <!-- Font Awesome -->
    <link href="css/font-awesome.min.css" rel="stylesheet">


    <!-- PrettyPhoto -->
    <link href="css/prettyPhoto.css" rel="stylesheet">
    
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />

    <!-- Style -->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/style_becomemember.css" rel="stylesheet">

    <link href="css/animate.css" rel="stylesheet">
    <!-- Responsive CSS -->
    <link href="css/responsive.css" rel="stylesheet">

    <!-- CSS and JS for circle menu -->
    <link rel="stylesheet" type="text/css" href="css/component1.css" />
    <script src="js/modernizr-2.6.2.min.js"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->

    <style type="text/css">
        .component {
            display: none;
        }
    </style>

    <script type="text/javascript">
        $(document).tooltip({show: null});
    </script>
  </head>
  <body>
    <!-- PRELOADER -->
    <div class="spn_hol">
        <div class="spinner">
            <div class="bounce1"></div>
            <div class="bounce2"></div>
            <div class="bounce3"></div>
        </div>
    </div>
    <section class="header parallax home-parallax page" id="HOME">
        <h2></h2>
        <div class="section_overlay">
            <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
                <div class="container">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <div class="navbar-brand">
                            <a class="navbar-brand-link" href="http://www.movemewithcare.com">MOVEMEWITHCARE<small>.com</small></a>
                        </div>
                    </div>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav navbar-right">
                            <!-- NAV -->
                            <li><a>FOR ENQUIRIES CALL 877-963-SAVE(7283)</a> </li>
                            <li><a>OR EMAIL US AT admin@movemewithcare.com</a> </li>
                        </ul>
                    </div>
                    <!-- /.navbar-collapse -->
                </div>
                <!-- /.container- -->
            </nav>

            <div class="container home-container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="logo text-center">
                                <!-- LOGO -->
                            <h1 style="color: #FFF">MOVE<span style="color: #F39C13">ME</span>WITHCARE<small style="color:#FFF">.com</small><h1>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8 col-sm-8 col-xs-12">
                        <div class="home_text">
                            <!-- TITLE AND DESC -->
                            <h1>Next step to become a member with us!</h1>
                            <p style="color: #F39C13">Please fill in your details below</p>

                            <div class="download-btn">
                            <!-- BUTTON -->
                                <a class="tuor btn wow fadeInRight" href="#MEMBER">Continue Below <i class="fa fa-angle-down" aria-hidden="true"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-md-offset-1 col-sm-4">
                        <!--<div class="home-iphone">
                            <img src="images/new/iPhone_Home.png" alt="">
                        </div>-->
                        <div class="menu-container">
                            <nav>
                                    <ul class="mcd-menu">
                                        <li class="menu-header">
                                            <i class="fa fa-bars"></i>
                                            <strong>Menu</strong>
                                        </li>
                                        <li>
                                            <a href="http://www.movemewithcare.com/index_new.php">
                                                <i class="fa fa-home"></i>
                                                <strong>Home</strong>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="">
                                                <i class="fa fa-question"></i>
                                                <strong>FAQs</strong>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="">
                                                <i class="fa fa-info"></i>
                                                <strong>Accredited Associations</strong>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="">
                                                <i class="fa fa-check-square-o"></i>
                                                <strong>Member Login</strong>
                                            </a>
                                        </li>
                                        <li>
                                            <a style="color: #F39C13 !important" class="transition">
                                                <i class="fa fa-thumbs-o-up"></i>
                                                <strong>Become a Member</strong>
                                            </a>
                                        </li>
                                        <li>
                                            <a>
                                                <i class="fa fa-truck"></i>
                                                <strong>Our Services</strong>
                                            </a>
                                            <ul>
                                                <li><a href="#"><i class="fa fa-hand-o-right"></i>Full Service Movers</a></li>
                                                <li><a href="#"><i class="fa fa-hand-o-right"></i>Loading/Unloading Help</a></li>
                                                <li><a href="#"><i class="fa fa-hand-o-right"></i>Transportation Help</a></li>
                                                <li><a href="#"><i class="fa fa-hand-o-right"></i>Storage Facilities</a></li>
                                                <li><a href="#"><i class="fa fa-hand-o-right"></i>Packing Supplies and Materials</a></li>
                                            </ul>
                                        </li>
                                        
                                    </ul>
                                </nav>
                            </div>
                    </div>
                    
                </div>

            </div>
            
    </section>