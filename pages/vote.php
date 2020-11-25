<?php

$id=$_GET['id'];
$id=mysqli_real_escape_string($conn,$id);
if(check($id)==1)
{
  echo '<meta http-equiv="refresh" content="0;url=index.php?page=home">';
}
$sth = $conn->prepare("SELECT * from servers where id = ?");
               $sth->bind_param("i", $postid);
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
  if(!voted($ip,$id))
{$rating = $_POST['rating'];
addvote($ip,$id,$rating);}
  else {
    echo "You already voted today!";
  }
}

if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
    $ip = $_SERVER['REMOTE_ADDR'];
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
</head>
<form action="" method="POST" value="16">
<button type = "submit" value = "16" name="vote" style="margin-top:1%;"class="button-upvote" id="upvote">Vote<i class="fa fa-chevron-up"></i></button>
<select class="form-control" id="rating" name="rating">
    <option value="5">The best</option>
    <option value="4">Good</option>
    <option value="3">OK</option>
    <option value="2">Bad</option>
    <option value="1">Worst</option>
</select>
</form>
