<?php
if (isset($_POST['search'])){
	$keyword=$_POST['keyword'];
$link='<meta http-equiv="refresh" content="3;url=index.php?page=search&keyword=' .$keyword.'">';
	echo $link;

}
?>
    <div class="row">
				<div class="col-xl-auto" style="margin:auto; padding-top:5%;padding-bottom:5%;">
					<div align="center" style="margin-top: 2%;">
						<a href="<?php print $site_url; ?>?page=<?php echo $page; ?>&sort=0&category=<?php echo $category ?>">
							<span class="input-group-btn"><button class="btn btn-secondary sort-new" type="button"><?php echo $translate['fresh'];?></button>
						</a></span>
						<a href="<?php print $site_url; ?>?page=<?php echo $page; ?>&sort=3&category=<?php echo $category ?>">
							<span class="input-group-btn"><button class="btn btn-secondary sort-top" type="button"><?php echo $translate['top'];?></button></span>
					  </a>
					</div>
				</div>
    </div>

    <div class="row" >
        <div class="col-md-8" >
            <?php
		$post = $_GET['post'];
		global $conn;
		if ($post == null) { $post=0;}
		if ($category == null) { $category = 0;}
		if ($sort == null ) {$sort = 3;}
		if($city==15)
					{
						if($category>0)
									{
										if($sort==3)
										{
											$sth = $conn->prepare("SELECT * from servers where category = ? order by votes desc LIMIT 200");
											                $sth->bind_param("i", $category);
																			$sth->execute();
																			$result = $sth->get_result();
										}
										else
										{
											$sth = $conn->prepare("SELECT * from servers where category=? order by date desc LIMIT 200");
											                $sth->bind_param("i", $category);
																			$sth->execute();
																			$result = $sth->get_result();
										}
									}
									else {
										if($sort==3)
										{$result = $conn->query("SELECT * FROM servers order by votes desc");
										}
										else
										{$result = $conn->query("SELECT * FROM servers order by date desc");}
									}
						}
				else {
					if($category>0)
								{
									if($sort==3)
									{
										$sth = $conn->prepare("SELECT * from servers where category = ? and city = ? order by votes desc LIMIT 200");
																		$sth->bind_param("ii", $category, $city);
																		$sth->execute();
																		$result = $sth->get_result();
									}
									else
									{
										$sth = $conn->prepare("SELECT * from servers where category=? and city = ? order by date desc LIMIT 200");
																		$sth->bind_param("ii", $category, $city);
																		$sth->execute();
																		$result = $sth->get_result();
									}
								}
								else {
									if($sort==3)
									{

										$sth = $conn->prepare("SELECT * from servers where city = ? order by votes desc LIMIT 200");
																		$sth->bind_param("i", $city);
																		$sth->execute();
																		$result = $sth->get_result();

									}
									else
									{										$sth = $conn->prepare("SELECT * from servers where city = ? order by date desc LIMIT 200");
																											$sth->bind_param("i", $city);
																											$sth->execute();
																											$result = $sth->get_result();
									}
								}
						}

				if ($result->num_rows > 0) :
				while($row = mysqli_fetch_assoc($result)) :
				$position = $position +1;

					?>
								<?php	include 'postitem.php'; ?>


                <?php endwhile; endif;?>
                    <!-- Pagination 
                    <ul class="pagination justify-content-center mb-4">
                        <li class="page-item">
                            <a class="page-link" href="<?php print $site_url; ?>?page=<?php echo $page; ?>&sort=<?php if ($sort != null)echo '&sort='; echo $sort;?>&post=<?php if ($post === null){$post = 1; } if($post-10<0) { echo $post; } else {$post-10;}?>&category=<?php echo $category; ?>">&larr; Inapoi</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="<?php print $site_url; ?>?page=<?php echo $page; ?>&sort=<?php if ($sort != null)echo '&sort='; echo $sort;?>&post=<?php if ($post === null){$post = 1; } if($post+10>getmaxpost($category)) {echo $post;} else {echo $post+10;}?>&category=<?php echo $category; ?>">Inainte &rarr;</a>
                        </li>
                    </ul> -->
        </div>

        <!-- Sidebar Widgets Column -->
        <div class="col-md-4">
            <!-- Search Widget -->
            <div class="card my-4">
                <h5 class="card-header"><?php echo $translate['search'];?></h5>
                <div class="card-body">
                    <form action="" method="POST">
                        <div class="input-group">
                            <input name="keyword" type="text" class="form-control" placeholder="<?php echo $translate['i-want-to-see'];?>">
                            <span class="input-group-btn">
                  <button type="submit" class="btn btn-secondary" name="search" type="button"><?php echo $translate['search'];?></button>
                </span>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Categories Widget -->
						<div class="card my-4">
								<h5 class="card-header"><?php echo $translate['customise'];?></h5>
								<div class="card-body">
										<div class="row">
												<ul class="list-unstyled mb-0" style="margin-left:5%;">
														<li>
																<a><h3><?php echo $translate['style'];?>:</h3></a>
																<div class="option">
																<a href="<?php print $site_url; ?>?page=<?php echo $page; ?>&sort=<?php echo $sort; ?>&category=1"><?php echo $translate['food'];?></a><br>
																<a href="<?php print $site_url; ?>?page=<?php echo $page; ?>&sort=<?php echo $sort; ?>&category=2"><?php echo $translate['drinks'];?></a><br>
																<a href="<?php print $site_url; ?>?page=<?php echo $page; ?>&sort=<?php echo $sort; ?>&category=3"><?php echo $translate['party'];?></a><br>
																<a href="<?php print $site_url; ?>?page=<?php echo $page; ?>&sort=<?php echo $sort; ?>&category=4"><?php echo $translate['landmark'];?></a><br>
																<a href="<?php print $site_url; ?>?page=<?php echo $page; ?>&sort=<?php echo $sort; ?>&category=0"><?php echo $translate['all'];?></a></div><br>
														</li>
														<li role="separator" class="divider"></li>
														<li>
																<a><h3>City: </h3></a>
																<a href="<?php print $site_url; ?>?page=<?php echo $page; ?>&sort=<?php echo $sort; ?>&category=<?php echo $category;?>&city=1">Alba Iulia</a><br>
																<a href="<?php print $site_url; ?>?page=<?php echo $page; ?>&sort=<?php echo $sort; ?>&category=<?php echo $category;?>&city=2">Brasov</a><br>
																<a href="<?php print $site_url; ?>?page=<?php echo $page; ?>&sort=<?php echo $sort; ?>&category=<?php echo $category;?>&city=3">Bucuresti</a><br>
																<a href="<?php print $site_url; ?>?page=<?php echo $page; ?>&sort=<?php echo $sort; ?>&category=<?php echo $category;?>&city=4">Cluj-Napoca</a><br>
																<a href="<?php print $site_url; ?>?page=<?php echo $page; ?>&sort=<?php echo $sort; ?>&category=<?php echo $category;?>&city=5">Constanta</a><br>
																<a href="<?php print $site_url; ?>?page=<?php echo $page; ?>&sort=<?php echo $sort; ?>&category=<?php echo $category;?>&city=6">Craiova</a><br>
																<a href="<?php print $site_url; ?>?page=<?php echo $page; ?>&sort=<?php echo $sort; ?>&category=<?php echo $category;?>&city=7">Iasi</a><br>
																<a href="<?php print $site_url; ?>?page=<?php echo $page; ?>&sort=<?php echo $sort; ?>&category=<?php echo $category;?>&city=8">Oradea</a><br>
																<a href="<?php print $site_url; ?>?page=<?php echo $page; ?>&sort=<?php echo $sort; ?>&category=<?php echo $category;?>&city=9">Sibiu</a><br>
																<a href="<?php print $site_url; ?>?page=<?php echo $page; ?>&sort=<?php echo $sort; ?>&category=<?php echo $category;?>&city=10">Sighisoara</a><br>
																<a href="<?php print $site_url; ?>?page=<?php echo $page; ?>&sort=<?php echo $sort; ?>&category=<?php echo $category;?>&city=11">Suceava</a><br>
																<a href="<?php print $site_url; ?>?page=<?php echo $page; ?>&sort=<?php echo $sort; ?>&category=<?php echo $category;?>&city=12">Targu Mures</a><br>
																<a href="<?php print $site_url; ?>?page=<?php echo $page; ?>&sort=<?php echo $sort; ?>&category=<?php echo $category;?>&city=13">Timisoara</a><br>
																<a href="<?php print $site_url; ?>?page=<?php echo $page; ?>&sort=<?php echo $sort; ?>&category=<?php echo $category;?>&city=14">Alte orase</a><br>
																<a href="<?php print $site_url; ?>?page=<?php echo $page; ?>&sort=<?php echo $sort; ?>&category=<?php echo $category;?>&city=14">Toate</a><br>
														</li>
												</ul>
										</div>
								</div>
						</div>

            <div class="card my-4">
                <h5 class="card-header"><?php echo $translate['stats'];?></h5>
                <div class="card-body">
                    <div class="row">
                        <ul class="list-unstyled mb-0" style="margin-left:5%;">
                            <li>
                                <a><?php echo $translate['registered-users'];?>:     <?php getRegisteredUsers() ?></a>
                            </li>
                            <li>
                                <a><?php echo $translate['registered-servers'];?>:    <?php getPostCount() ?></a>
                            </li>
                            <li>
                                <a><?php echo $translate['registered-comments'];?>:      <?php getCommCount() ?></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- /.row -->
