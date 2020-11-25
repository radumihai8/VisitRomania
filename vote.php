<?php
include 'pages/functions.php';
include 'pages/languages.php';
if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
    $ip = $_SERVER['REMOTE_ADDR'];
}
$id=$_GET['id'];
$id=mysqli_real_escape_string($conn,$id);
if(check($id)==1)
{
  echo '<meta http-equiv="refresh" content="3;url=index.php?page=home">';
}
$sth = $conn->prepare("SELECT * from servers where id = ?");
               $sth->bind_param("i", $id);
               $sth->execute();
               $result = $sth->get_result();
        if ($result->num_rows > 0)
           		{
           			while($row = $result->fetch_assoc())
           			{
                  $title=$row['title'];
           			}
           		}
if($_POST['vote'])
{
  if(empty($_POST['g-recaptcha-response']))
      $errors[]=$translate['error-captcha'];
  if(!voted($ip,$id))
     $errors[]=$translate['error-voted'];
  foreach($errors as $error)
  {
  	echo $error;
  }
  if(!count($errors))
    {
      $rating = $_POST['rating'];
      addvote($ip,$id,$rating);
    }
}


?>
<head>
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Metin2 Best Private Servers PvM-PvP">
  <meta id="keywords" name="keywords" content="Metin2, metin, metin2 top, top metin, best metin, new metin server, private metin2, private server, mt2, mt2 top, mt2private, mt2 pvm, mt pvp">
  <meta name="keywords" content="<?php echo $keywords; ?>">
  <meta name="author" content="Metin2 Top">
  <meta charset="utf-8">
  <link rel='shortcut icon' type='image/x-icon' href='<?php print $site_url;?>favicon.ico' />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <title>Metin2 Top P-Servers</title>
  <link href="<?php print $site_url; ?>css/general.css" rel="stylesheet">
  <link type="text/css" rel="stylesheet" media="all" href="" id="theme_css" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
  <link href="<?php print $site_url; ?>css/blog-home.css" rel="stylesheet">
  <style>
  html, body {height:100%;}
  html {display:table; width:100%;}
  body {display:table-cell; text-align:center; vertical-align:middle;background: #6f6d6d;}
  </style>
</head>
<body style="margin:auto;">
  <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- 123 -->
<h2>Vote <?php echo $title; ?> </h2>
<form action="" method="POST" value="16">
<button type = "submit" value = "16" name="vote" style="margin-top:1%;"class="button-upvote" id="upvote">Vote<i class="fa fa-chevron-up"></i></button>
<select class="form-control" id="rating" name="rating">
    <option value="5">The best</option>
    <option value="4">Good</option>
    <option value="3">OK</option>
    <option value="2">Bad</option>
    <option value="1">Worst</option>
</select>
<center><div id="captcha" class="g-recaptcha" data-sitekey="6Ld51fUUAAAAAMF0KBmLmr8TAbUTL4M69JXOMBAX"></div></center>
</form>
</body>
