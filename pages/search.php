	<div class="row">
		<div class="col-md-8">
		<h1 class="my-4">Search "<?php echo $_GET['keyword'];?>"</h1>
		<?php
		$keyword = $_GET['keyword'];
		$keyword = mysqli_real_escape_string($conn,$keyword);
		$keyword = "%".$keyword."%";
		 $sth = $conn->prepare("SELECT * from servers where title like ?");
										 $sth->bind_param("s", $keyword);
										 $sth->execute();
										 $result = $sth->get_result();

										 if ($result->num_rows > 0) :
						 				while($row = mysqli_fetch_assoc($result)) : ?>
															<?php include 'postitem.php'; ?>
						                 <?php endwhile; endif;
						 				//Like start
						 						if($_POST['vote'])
						 						{
						 						$id=$_POST['vote'];
						 						addvote($ip,$id);
						 						}
						 				//Like sfarsit
						 		?>
		</div>

          <!-- Categories Widget -->

		</div>
      <!-- /.row -->
