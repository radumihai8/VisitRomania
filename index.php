<?php
session_start();
include 'pages/functions.php';
include 'pages/languages.php';
$id=$_GET['id'];
$meta1=getdescription($id);
$page=$_GET['page'];
$page=mysqli_real_escape_string($conn,$page);
$sort=$_GET['sort'];
$sort=mysqli_real_escape_string($conn,$sort);
$city=$_GET['city'];
$city=mysqli_real_escape_string($conn,$city);


  	$category = $_GET['category'];
	if ($category == null) { $category = 0;}
    if($city == null)
      {
        $city=15;
      }

		  if($page == null && $sort == null)
		  { $page = 'home';
			$sort = 3;
		  }

      if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
          $ip = $_SERVER['HTTP_CLIENT_IP'];
      } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
          $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
      } else {
          $ip = $_SERVER['REMOTE_ADDR'];
      }
?>

<html lang="en">

<head>


        <title>Visit Romania</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="Top places to visit in Romania">
        <meta id="keywords" name="keywords" content="mancare,food,drinks,bauturi,bar,restaurant,obiectiv,turism">
        <meta name="author" content="Metin2 Top">

        <link rel='shortcut icon' type='image/x-icon' href='<?php print $site_url;?>favicon.ico' />
        <script src="https://kit.fontawesome.com/748051aed3.js" crossorigin="anonymous"></script>
        <link href="<?php print $site_url; ?>css/general.css" rel="stylesheet">
        <link type="text/css" rel="stylesheet" media="all" href="" id="theme_css" />
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>

    <body>

        <div class="header" style="height:15vh;">
        </div>
        <!-- Navigation -->

        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
          <a class="navbar-brand " href="<?php echo $site_url;?>">
          <img class="img-fluid" style="max-height: 6vh;"alt="Metin2 Top Logo" src="img/logo1.png">
          </a>
            <div class="container">
                <a class="navbar-brand" href="#">
                    <?php echo $_row['email']; ?>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="<?php print $site_url; ?>?page=home"><?php echo $translate['home'];?>
                <span class="sr-only">(current)</span>
              </a>
                        </li>
                        <li class="nav-item">
                            <?php if($_SESSION['username']) {echo '<a class="nav-link" href="'; echo $site_url;  echo'?page=user&username='; echo $_SESSION['username'];  echo '">'; echo $_SESSION['username']; echo'</a>';}
			  else
			  {
			  echo '<a class="nav-link" href="'; print $site_url;echo'?page=register">';echo $translate['register']; echo'</a>';
			  }
			  ?>
                        </li>
                        <?php if($_SESSION['username']){
            echo '<li class="nav-item">
              <a class="nav-link" href="';print $site_url; echo '?page=addpost" style="color:red;font-weight: bold;">';echo $translate['addpost'];echo '</a>
            </li>';} ?>
                            <li class="nav-item">
                                <?php if(isadmin($_SESSION['username'])) {echo '<a class="nav-link" href="'; print $site_url;echo'?page=admin">Administrare</a>';}
			  ?>
                            </li>
                            <li class="nav-item">
                                <?php if($_SESSION['username']) {echo '<a class="nav-link" href="'; print $site_url;echo'?page=logout">';echo $translate['logout'];echo'</a>';}
			  else
			  {
			  echo '<a class="nav-link" href="'; print $site_url;echo'?page=login">';echo $translate['login'];echo'</a>';
			  }
			  ?>                       <li class="nav-item active">
                                </li>
                            </li>
                            <button id="themetoggle" class="" style="margin-left:3%;margin-right:3%;"> </button>
                            <li>
                              <div class="dropdown">
                                <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                  <?php print $translate['language']; ?>
                                  <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                  <li><? print '<a href="'.$site_url.'?page=home&lang_set=ro">Ro</a>';?></li>
                                  <li><? print '<a href="'.$site_url.'?page=home&lang_set=en">En</a>';?></li>
                                </ul>
                              </div>
                            </li>

                    </ul>
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <div class="container">
            <?php include 'pages/'.$page.'.php'; ?>
        </div>

        <!-- Footer -->
        <footer class="py-5 bg-dark">
            <div class="container2">
                <p class="m-0 text-center text-white">
                    © <?php echo date("Y"); ?> Copyright: Visit Romania. All sites and places are added by users. Trademarks are the property of their respective owners.
                </p>
				<p class="m-0 text-center text-white">
					Designed and coded by Radu Mihai
				</p>
            </div>
            <!-- /.container -->
        </footer>
        <script>

        function getCookie(cname) {
                    var name = cname + "=";
                    var ca = document.cookie.split(';');
                    for(var i = 0; i < ca.length; i++) {
                      var c = ca[i];
                      while (c.charAt(0) == ' ') {
                        c = c.substring(1);
                      }
                      if (c.indexOf(name) == 0) {
                        return c.substring(name.length, c.length);
                      }
                    }
                    return "";
                  }


        document.getElementById('themetoggle').onclick = function()
        {
          if(getCookie("theme")=="bootstrap.min.css")
          {
            document.cookie = "theme=bootstrap.light.min.css;expires=Thu, 18 Dec 2020 12:00:00 UTC;";
            var result = '<?php print $site_url; ?>' + 'vendor/bootstrap/css/bootstrap.light.min.css';
            document.getElementById('theme_css').href = result;

            document.getElementById("themetoggle").innerHTML = "Dark Mode";
            document.getElementById("themetoggle").className = "btn btn-night";
          }
          else {
            document.cookie = "theme=bootstrap.min.css;expires=Thu, 18 Dec 2020 12:00:00 UTC;";
            var result = '<?php print $site_url; ?>' + 'vendor/bootstrap/css/bootstrap.min.css';
            document.getElementById('theme_css').href = result;
            document.getElementById("themetoggle").innerHTML = "Light Mode";
            document.getElementById("themetoggle").className = "btn btn-day";
          }
        }

        if(getCookie("theme")=="bootstrap.min.css")
        {
          var result = '<?php print $site_url; ?>' + 'vendor/bootstrap/css/bootstrap.min.css';
          document.getElementById('theme_css').href = result;
          document.getElementById("themetoggle").innerHTML = "Light Mode";
          document.getElementById("themetoggle").className = "btn btn-day";
        }
        else if(getCookie("theme")=="bootstrap.light.min.css")
        {
          var result = '<?php print $site_url; ?>' + 'vendor/bootstrap/css/bootstrap.light.min.css';
          document.getElementById('theme_css').href = result;
          document.getElementById("themetoggle").innerHTML = "Dark Mode";
          document.getElementById("themetoggle").className = "btn btn-day";
        }

        if(getCookie("theme")!="bootstrap.min.css" && getCookie("theme")!="bootstrap.light.min.css")
        {
          var result = '<?php print $site_url; ?>' + 'vendor/bootstrap/css/bootstrap.min.css';
          document.getElementById('theme_css').href = result;
          document.getElementById("themetoggle").innerHTML = "Light Mode";
          document.getElementById("themetoggle").className = "btn btn-day";
        }
        </script>
        <script language="JavaScript">
            function openWindow(url)
            {
                window.open(url, '_blank', 'menubar=no,height=480,width=490,scrollbars=no,top=200,left=200');
            }
        </script>
        <!-- Bootstrap core JavaScript -->
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    </body>

    </html>
