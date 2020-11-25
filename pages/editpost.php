<?php
$editid=$_GET['editid'];
$editid=mysqli_real_escape_string($conn, $editid);
$sth = $conn->prepare("SELECT * from servers where id = ? and username = ? LIMIT 1");
								$sth->bind_param("is", $editid, $_SESSION['username']);
								$sth->execute();
								$result = $sth->get_result();
	if ($result->num_rows > 0)
								{
									while($row = $result->fetch_assoc())
									{
										$title=$row['title'];
										$description=$row['description'];
										$website=$row['website'];
										$category=$row['category'];
										$language=$row['language'];
										$level=$row['level'];
										$youtube=$row['youtube'];
										$oldimage=$row['banner'];
										$username=$row['username'];

									}
								}
		else {
			echo '<meta http-equiv="refresh" content="0;url=index.php?page=home">';
		}

if (isset($_POST['submit']))
	{
		if(isset($_POST['title']) && isset($_POST['description']) && isset($_POST['category']) && isset($_POST['language']) && isset($_POST['level']) && isset($_POST['website']) && $username==$_SESSION['username'])
		{
		$youtube = $_POST['youtube'];
		global $conn;
		$errors = array();
		if(!$_SESSION['username'])
			$errors[]='<div class="alert alert-danger" role="alert">You must log in first!</div>';
		if(!isValidYoutube($youtube))
			$errors[]='<div class="alert alert-danger" role="alert">The youtube link is not valid!</div>';
		if(empty($_POST['g-recaptcha-response']))
			$errors[]='<div class="alert alert-danger" role="alert">Please check if you`re not a robot!</div>';
		foreach($errors as $error)
			echo $error;

		if(!count($errors))
			{
			$title = $_POST['title'];
			$description = $_POST['description'];
			$category = $_POST['category'];
			$language = $_POST['language'];
			$level = $_POST['level'];
			$link = $_POST['fileToUpload'];
			$website = $_POST['website'];
			$youtube = getYoutubeIdFromUrl($youtube);
			$username =$_SESSION['username'];
			$target_dir = "uploads/";
			$imgid = getlastid() + 1;
			$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
			$renamed_file = $target_dir . $editid . '.png';
			$uploadOk = 1;
			$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
			if(isset($_POST["submit"])) {
					$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
					if($check !== false) {
							$uploadOk = 1;
					} else {
							$uploadOk = 0;
					}
			}
			if ($_FILES["fileToUpload"]["size"] > 5*1048576) {
					echo "Sorry, your file is too large.";
					$uploadOk = 0;
			}
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" ) {
					echo "Sorry, only JPG, JPEG & PNG files are allowed.";
					$uploadOk = 0;
			}
			else {
				$url = "uploads/" . $_POST['editid'] . ".png";
				unlink($url);
			}
			if ($uploadOk == 0) {
					echo "Sorry, your file was not uploaded.";
			} else {
					if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $renamed_file)) {
					} else {
							echo "Sorry, there was an error uploading your file.";
					}
			}
			$link =  $site_url.$renamed_file;
			$result=editpost($title, $description,$website,$link, $category, $language, $level, $youtube, $editid);
				if (!$result) {
					die(mysql_error());
				}
				else
				{ echo 'Done!';}
			}
		}
		else {
			echo '<div class="alert alert-danger" role="alert">You must complete all the fields!</div>';
		}
	}

?>

    <div class="container" style="padding-bottom: 20%; padding-top: 10%;">
        <form method="post" action="" enctype="multipart/form-data">
            <div class="form-group">
                <label for="inlineFormInputGroup"><?php echo $translate['title'];?></label>
                <input type="text" class="form-control" name="title" value="<?php echo $title; ?>">
            </div>
            <div class="form-group">
                <label for="inlineFormInputGroup"><?php echo $translate['description'];?></label>
                <input type="text" class="form-control" name="description" value="<?php echo $description; ?>">
            </div>
            <div class="form-group">
                <label for="inlineFormInputGroup"><?php echo $translate['website'];?></label>
                <input type="url" class="form-control" name="website" value="<?php echo $website; ?>">
            </div>
            <div class="form-group">
                <label for="inlineFormInputGroup">Banner ( 468 x 190 )</label>
                <input type="file" name="fileToUpload" id="fileToUpload">
                <small id="link" class="form-text text-muted">Show it!</small>
            </div>
            <div class="form-group">
                <label for="category"><?php echo $translate['category'];?></label>
                <select class="form-control" id="category" name="category" value="<?php echo $category; ?>">
                    <option value="1">Oldschool</option>
                    <option value="2">Middleschool</option>
                    <option value="3">Newschool</option>
                </select>
            </div>
            <div class="form-group">
                <label for="language"><?php echo $translate['main-language'];?></label>
                <select class="form-control" id="language" name="language">
                    <option value="1">Global</option>
                    <option value="2">English</option>
                    <option value="3">Romanian</option>
                    <option value="4">Espagnol</option>
                    <option value="5">French</option>
                    <option value="6">German</option>
                    <option value="7">Italian</option>
                    <option value="8">Hungarian</option>
                    <option value="9">Turkish</option>
                    <option value="10">Other</option>
                </select>
            </div>
            <div class="form-group">
                <label for="inlineFormInputGroup"><?php echo $translate['level-max'];?></label>
                <input type="number" class="form-control" name="level" value="<?php echo $level;?>">
            </div>
            <div class="form-group">
                <label for="inlineFormInputGroup">Youtube link</label>
                <input type="url" class="form-control" name="youtube" value="https://www.youtube.com/watch?v=<?php echo $youtube; ?>">
                <small id="youtube" class="form-text text-muted">Show it!</small>
            </div>
            <div class="form-group">
                <div id="captcha" class="g-recaptcha" data-sitekey="6LfsiqcUAAAAAFlrgvxQKh8Zj3_ZD4pp9h_rJmP2"></div>
                <label for="captcha">Just making sure you`re human :)</label>
            </div>
            <button type="submit" class="btn btn-primary" name="submit"><?php echo $translate['submit'];?></button>
        </form>
    </div>
