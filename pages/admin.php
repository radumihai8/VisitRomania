<? if(!isadmin($_SESSION['username']))
{
	echo 'Nu esti administrator!';
	echo '<meta http-equiv="refresh" content="0;url=index.php?page=home">';
	
	die();
}
?>
<div class="container">
    <div class="row">
        <!-- Blog Entries Column -->
        <div class="col-md-8">
          <h1 class="my-4"><?php print strtoupper($page) ?></h1>		
		<?php 
		 $result = $conn->query("SELECT * FROM servers ORDER BY date ASC");


			
				if ($result->num_rows > 0) :
				while($row = mysqli_fetch_assoc($result)) : ?>
				  <div class="card mb-4">
						<img class="card-img-top" src="<?php echo $row['banner'] ?>" alt="Card image">
						
						<div class="card-body">
						  <h2 class="card-title"><?php print $row['title']; ?></h2>
						  <p class="card-text"><?php print $row['description'];; ?></p>
						  <a href="#" class="btn btn-primary">Read More &rarr;</a>
						</div>

						<div class="card-footer text-muted">
				
						Posted on <?php print $row['date'] ?> by <a href="#"><?php print $row['author']; $id=$row['id']; ?> </a>
						
						<?php 
						echo'<form action="" method="POST" value="';echo $id;  echo'">
							<button onclick="reload()" type = "submit" value = "';echo $id; echo'" name="approve"class="btn btn-success">'; echo'<i class="fa fa-thumbs-o-up"></i>
							</form>';
						echo'<form action="" method="POST" value="';echo $id;  echo'">
							<button onclick="reload()" type = "submit" value = "';echo $id; echo'" name="delete"class="btn btn-danger">'; echo'<i class="fa fa-ban"></i>
							</form>';
						?>
						</div>
				  </div>
		<?php endwhile; endif; 
			if($_POST['approve']) 
				{
					$id=$_POST['approve'];
					approve($id);
				}
			if($_POST['delete']) 
				{
					$id=$_POST['delete'];
					postdelete($id);
				}	
		?>
		</div>
    </div>
</div>