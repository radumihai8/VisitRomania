    <div class="container">

      <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">

          <h1 class="my-4">Posted By: <a href="#"><?php print  $_GET['username']; ?></a>

          </h1>

          <!-- Blog Post -->

		<?php
		$user = $_GET['username'];
     $sth = $conn->prepare("SELECT * from servers where username = ? ORDER BY date DESC");
                     $sth->bind_param("s", $user);
                     $sth->execute();
                     $result = $sth->get_result();


				if ($result->num_rows > 0) :
				while($row = mysqli_fetch_assoc($result)) : ?>
        <div class="card mb-4">

            <div class="row">
            <div class="col-md-2">
              <div class="card-b ">
              <table border="0" class="btbg3" cellpadding="2" style="border-collapse: collapse" width="84" height="34"><tbody><tr><td align="center"><img src="https://www.metin2pserver.info/Bilder/home.png" width="12" height="12" alt="Clicks" title="Clicks" style="margin-top:2px"> <font color="#CCCCCC"><?php echo $row['votes'];?></font></td></tr></tbody></table>
              <table border="0" cellpadding="2" style="border-collapse: collapse" width="84" height="34" class="btbg2"><tbody><tr><td align="center"><img src="https://www.metin2pserver.info/Bilder/like.png" width="12" height="12" alt="Votes" title="Votes" style="margin-top:2px"> <font color="#66FF66"><?php echo $row['clicks'];?></font></td></tr></tbody></table>

              <?
        $uid=$_SESSION['username'];
        if(voted($ip,$row['id']))
        {

        echo'<form action="" method="POST" value="'; print $row['id'];  echo'">
        <button type = "submit" value = "'; print $row['id']; echo'" name="vote" style="min-width: 100%;padding-left: 10%;padding-right: 10%;padding-top:3%;padding-bottom:3%;margin-top:1%;"class="button-upvote" id="upvote"><i class="fa fa-chevron-up"></i></button>
        </form>';
        }
        else {
        echo '<button name="vote" style="min-width: 100%;padding-left: 10%;padding-right: 10%;padding-top:3%;padding-bottom:3%;margin-top:1%;"class="button-voted" id="voted">Voted!</button>
        ';
        }?>

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
                <a href="<?php print $site_url; ?>?page=post&id=<?php print $row['id'] ?> "><img class="img-fluid" src="<?php echo $row['banner'] ?>" alt="Card image cap"></a>
                <h2 class="card-title"><?php print $row['title']; ?></h2>
                <p class="card-text">
                    <?php print $row['description']; ?>
                </p>
                <a href="<?php print $site_url; ?>?page=post&id=<?php print $row['id'] ?> " class="button  arrow">Read More </a>

                <a href="<?php print $row['website']; ?>" ping="<?php print $site_url;?>?page=ping&id=<?php echo $row['id'];?>" class="button phone"><i class="fas fa-globe-europe"></i>Website</a>
                <?php if($row['username']==$_SESSION['username']){
$url = $site_url . "?page=editpost&editid=" . $row['id'];
$show= "<a href='" .$url. "'>
<button name='Edit' style='padding-left: 5%;padding-right: 5%;padding-top:2%;padding-bottom:2%;margin-top:1%;'
class='btn btn-info'>Edit this post!</button></a>";
echo $show; }?>


                    <p class="tags">
                        <span class="badge badge-danger">Level <?php print $row['level'];?></span>
                        <span class="badge badge-info"><?php getlanguage($row['language']);?></span>
                        <span class="badge badge-dark"><?php getcategoryname($row['category']);?></span>
                    </p>
                    By
                    <a href="<?php print $site_url; ?>?page=user&username=<?php print $row['username'];?>">
                        <?php print $row['username']; $id=$row['id']; ?>
                    </a>
            </div>
        </div>
        </div>

		<?php endwhile; endif;
				//Like start
						if($_POST['like'])
						{
						$id=$_POST['like'];
							if(checklike($uid,$id))
								{
								addlike($id,$uid);
								}
							else
							{
								dislike($id,$uid);
							}
						}
				//Like sfarsit
		?>
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container -->
