<div class="card mb-4">

    <div class="row">
    <div class="col-md-2" style="display:flex;">
      <div class="card-b " style="margin: auto;">
        <table border="0" class="btbg3" cellpadding="2" style="border-collapse: collapse" width="84" height="34"><tbody><tr><td align="center"><font color="#CCCCCC"># <?php echo getposition($row['votes']);?></font></td></tr></tbody></table>
      <table border="0" class="btbg3" cellpadding="2" style="border-collapse: collapse" width="84" height="34"><tbody><tr><td align="center"><img src="<?php echo $site_url;?>img/home.png" width="12" height="12" alt="Clicks" title="Clicks" style="margin-top:2px"> <font color="#CCCCCC"><?php echo $row['clicks'];?></font></td></tr></tbody></table>
      <table border="0" cellpadding="2" style="border-collapse: collapse" width="84" height="34" class="btbg2"><tbody><tr><td align="center"><img src="<?php echo $site_url;?>img/like.png" width="12" height="12" alt="Votes" title="Votes" style="margin-top:2px"> <font color="#66FF66"><?php echo $row['votes'];?></font></td></tr></tbody></table>



<a style="margin-top:5%;"onclick="openWindow('<?php echo $site_url; ?>vote.php?id=<?php echo $row['id']; ?>')"><button  style="min-width: 100%;padding-left: 10%;padding-right: 10%;padding-top:3%;padding-bottom:3%;margin-top:1%;"class="button-upvote"><i class="fa fa-chevron-up"></i></button></a>




  <div class="card-footer text-muted">
      <? if($_SESSION['username'])
{

if(isadmin($uid))
{
echo'<form action="" method="POST" value="';echo $id;  echo'">
<button type = "submit" value = "';echo $id; echo'" name="delete"class="btn btn-danger">'; echo'<i class="fa fa-ban"></i></button>
</form>';
}
}
?> 
</div>
</div>
    </div>
    <div class="col-md">
        <a href="<?php print $site_url; ?>?page=post&id=<?php print $row['id'] ?> "><img class="img-fluid2" src="<?php echo $row['banner'] ?>" alt="Metin2 Top <?php echo $row['title'];?>"></a>
        <h2 class="card-title"><?php print $row['title']; ?></h2>
        <p class="card-text">
            <?php print $row['description']; ?>
        </p>
        <a href="<?php print $site_url; ?>?page=post&id=<?php print $row['id'] ?> " class="button  arrow"><?php echo $translate['read-more'];?></a>

        <a href="<?php print $row['website']; ?>" ping="<?php print $site_url;?>?page=ping&id=<?php echo $row['id'];?>" target="_blank"class="button phone"></i>Website</a>


            <p class="tags">
                <span class="badge badge-info"><?php getcity($row['city']);?></span>
                <span class="badge badge-dark"><?php echo $translate[getcategoryname($row['category'])];?></span>
            </p>
            <?php echo $translate['author'];?>
            <a href="<?php print $site_url; ?>?page=user&username=<?php print $row['username'];?>">
                <?php print $row['username']; $id=$row['id']; ?>
            </a>
    </div>
</div>
</div>
