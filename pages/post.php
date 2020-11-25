<?php
$postid = $_GET['id'];

if (isset($_POST['post']))
	{
		if(isset($_POST['text']))
		{
			global $conn;
			$errors = array();
			if(!isValidPostComment($_POST['text']))
				$errors[]=$translate['error-long'];
			if(empty($_POST['g-recaptcha-response']))
				$errors[]=$translate['error-captcha'];

			foreach($errors as $error)
				echo $error;

			if(!count($errors))
				{
				$text = $_POST['text'];
				$author=$_SESSION['username'];
				$result=addcomm($author, $text, $postid);
					if (!$result) {
						die(mysql_error());
					}
					else
					{ echo $translate['comment-added'];}
				}
		}
	}

?>

    <?php

		 $sth = $conn->prepare("SELECT * from servers where id = ?");
 										$sth->bind_param("i", $postid);
 										$sth->execute();
										$result = $sth->get_result();

				if ($result->num_rows > 0) :
				while($row = mysqli_fetch_assoc($result)) :
					$keywords = $row['title'] . "," . $row['website'] . "," . $row['youtube'] . "," . $row['description'];
					$rating = ($row['rating']/$row['votes']);
					?>
<head>
	<meta name="description" content="<?php echo $row['description'];?>">
</head>
        <!---<head>
            <meta name="keywords" content="<?php echo $keywords; ?>">
        </head>
        <script>
            var paragraph = document.getElementById("keywords").content;
            var text = document.createTextNode("<?php echo $keywords; ?>");
            paragraph.appendChild(text);
        </script>-->
        <div class="card mb-4">
            <a href="<?php echo $row['website'];?>"><img class="img-fluid" src="<?php echo $row['banner'] ?>" alt="<?php echo $row['title'];?>"></a>
            <div class="card-body">
                <h2 class="card-title"><?php print $row['title']; ?></h2>
                <p class="card-text">
                    <?php print $row['description']; ?>
                </p>
							<table style="width:100%">
							<tr>
								<td style="width:50%;" class="server-desc">
								<br>
								<span ><?php echo $translate['website'];?>: </span> <a class='website' style="color:#39575;"ping="<?php print $site_url;?>?page=ping&id=<?php echo $row['id'];?>" href="<?php echo $row['website']; ?>"><i class="fas fa-globe-europe"></i> <?php echo $row['website']; ?></a>
								<br>
								<span><?php echo $translate['category'];?>: </span><?php getcategoryname($row['category']);?><br>
								<span><?php echo $translate['city'];?>: </span><?php getcity($row['city']);?><br>
								<span><?php echo $translate['clicks'];?>: </span><?php echo $row['clicks'];?> <br>
								<span><?php echo $translate['votes'];?>: </span><?php echo $row['votes'];?> <br>
								<span><?php echo $translate['rating'];?>: </span><?php echo number_format($rating, 2, ",", " ");?> / 5<br>
								<a style="margin-top:5%;"onclick="openWindow('<?php echo $site_url;?>vote.php?id=<?php echo $row['id']; ?>')" class="button vote"></i>Vote</a><br>
								<a href="<?php print $row['website']; ?>" style="margin-top:3%;" ping="<?php print $site_url;?>?page=ping&id=<?php echo $row['id'];?>" class="button phone"></i>Website</a>

								</td>
								<td>
								<div class="embed-responsive embed-responsive-16by9" style="max-width:560px;max-height:315px;">
                <iframe class="embed-responsive-item" width="560" height="315" src="https://www.youtube.com/embed/<?php echo $row['youtube'];?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
								</div>
							</td>
						</tr>
							</table>
						<br>
						<a href="<?php print $site_url.'?page=post&id='.$row['id'];?>" title="Metin2" target="_blank"><img src="<?php print $site_url?>img/logo1.png" border="0" alt="Metin2" width="200" height="65"></a><br>

						<b>HTML Code (website, blogs etc):</b><br>
						<br>
						<textarea class="area" rows="4" cols="64" style="max-width: 100%;" name="S2">&lt;a href="<?php print $site_url.'?page=post&id='.$row['id'];?>" title="Metin2" target="_blank"&gt;&lt;img src="<?php print $site_url?>img/logo1.png" border="0" alt="Metin2" width="200" height="65"&gt;&lt;/a&gt;</textarea>
						<br>						<br>
						<b>BBCode (forums and signatures):</b><br>
												<br>
						<textarea class="area" rows="2" cols="64" name="S3" style="max-width: 100%; margin: 0px; height: 53px; width: 423px;">[URL="<?php print $site_url.'?page=post&id='.$row['id'];?>"][IMG]<?php print $site_url?>img/logo1.png[/IMG][/URL]</textarea>
						<div class="card-footer text-muted">
                <?
					if(isadmin($uid))
					{
					echo'<form action="" method="POST" value="';echo $id;  echo'">
					<button type = "submit" value = "';echo $id; echo'" name="delete"class="btn btn-danger">'; echo'<i class="fa fa-ban"></i></button>
					</form>';
					}

	?>
					<p class="tags" style="padding:2%;">
							<span class="badge badge-info"><?php getcity($row['city']);?></span>
							<span class="badge badge-dark"><?php getcategoryname($row['category']);?></span>

                    Author
                    <a href="<?php print $site_url; ?>?page=user&username=<?php print $row['username'];?>">
                        <?php print $row['username']; $id=$row['id']; ?>
                    </a>
                    <?php getcomments($postid); ?>					</p>
            </div>

            <div style="padding:2%;">
                <form method="post" action="">

                    <div class="form-group">
                        <label for="inlineFormInputGroup">Text</label>
                        <input type="text" class="form-control" name="text" placeholder="Comment">
                    </div>
                    <button type="submit" class="btn btn-primary" name="post"><?php echo $translate['submit'];?></button><br><br>
                <div id="captcha" class="g-recaptcha"  data-theme="dark" data-sitekey="6Ld51fUUAAAAAMF0KBmLmr8TAbUTL4M69JXOMBAX"></div>
                </form>
            </div>
        </div>
        <?php endwhile; endif;
		?>

            <!-- Pagination -->

            </div>
