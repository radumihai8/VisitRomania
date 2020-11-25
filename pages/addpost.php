<?php

if (isset($_POST['submit']))
	{
		if(isset($_POST['title']) && isset($_POST['description']) && isset($_POST['category']) &&  isset($_POST['website']) && isset($_POST['city']))
		{
		$youtube = $_POST['youtube'];
		global $conn;
		$errors = array();
		if(!$_SESSION['username'])
			$errors[]=$translate['error-login'];
		if(!isValidYoutube($youtube))
			$errors[]=$translate['error-youtube'];
		if(!isVaildWebsite($_POST['website']))
			$errors[]=$translate['error-website'];
		if(empty($_POST['g-recaptcha-response']))
			$errors[]=$translate['error-captcha'];
		foreach($errors as $error)
			echo $error;

		if(!count($errors))
			{
			$title = $_POST['title'];
			$description = $_POST['description'];
			$category = $_POST['category'];
			$link = $_POST['fileToUpload'];
			$website = $_POST['website'];
			$youtube = getYoutubeIdFromUrl($youtube);
			$username = $_SESSION['username'];
			$city = $_POST['city'];
			$target_dir = "uploads/";
			$imgid = getlastid() + 1;
			$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
			$renamed_file = $target_dir . $imgid . '.png';
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
					echo "Sorry, your file is too large.5MB";
					$uploadOk = 0;
			}
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" ) {
					echo "Sorry, only JPG, JPEG & PNG files are allowed.";
					$uploadOk = 0;
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
			$result=addpost($title, $description,$website, $link, $category, $youtube, $username,$city);
				if (!$result) {
					die(mysql_error());
				}
				else
				{ echo 'Done!';}
			}
		}
		else {
			echo $translate['error-complete'];

		}
	}

?>

    <div class="container" style="padding-bottom: 20%; padding-top: 10%;">
        <form method="post" action="" enctype="multipart/form-data">
            <div class="form-group">
                <label for="inlineFormInputGroup"><?php echo $translate['title'];?></label>
                <input type="text" class="form-control" name="title" placeholder="KFC">

            </div>
            <div class="form-group">
                <label for="inlineFormInputGroup"><?php echo $translate['description'];?></label>
                <input type="text" class="form-control" name="description" placeholder="Description">
            </div>
            <div class="form-group">
                <label for="inlineFormInputGroup"><?php echo $translate['website'];?></label>
                <input type="url" class="form-control" name="website" placeholder="http://website.ro">
            </div>
            <div class="form-group">
                <label for="inlineFormInputGroup">Banner ( 468 x 190 )</label>
                <input type="file" name="fileToUpload" id="fileToUpload">
                <small id="link" class="form-text text-muted">Show it!</small>
            </div>
            <div class="form-group">
                <label for="category"><?php echo $translate['category'];?></label>
                <select class="form-control" id="category" name="category">
                    <option value="1">Food</option>
                    <option value="2">Drinks</option>
                    <option value="3">Party</option>
                    <option value="4">Landmark</option>
                </select>
            </div>
			<div class="form-group">
                <label for="city">City</label>
                <select class="form-control" id="city" name="city">
                    <option value="1">Alba Iulia</option>
                    <option value="2">Brasov</option>
                    <option value="3">Bucuresti</option>
                    <option value="4">Cluj-Napoca</option>
                    <option value="5">Constanta</option>
                    <option value="6">Craiova</option>
                    <option value="7">Iasi</option>
                    <option value="8">Oradea</option>
                    <option value="9">Sibiu</option>
                    <option value="10">Sighisoara</option>
                    <option value="11">Suceava</option>
                    <option value="12">Targu Mures</option>
                    <option value="13">Timisoara</option>
                    <option value="14">Other</option>
                </select>
            </div>
            <div class="form-group">
                <label for="inlineFormInputGroup">Youtube link</label>
                <input type="url" class="form-control" name="youtube" placeholder="youtube.com">
            </div>
            <div class="form-group">
                <div id="captcha"  data-theme="dark" class="g-recaptcha" data-sitekey="6Ld51fUUAAAAAMF0KBmLmr8TAbUTL4M69JXOMBAX"></div>
                <label for="captcha">Just making sure you`re human :)</label>
            </div>
            <button type="submit" class="btn btn-primary" name="submit"><?php echo $translate['submit'];?></button>
        </form>
    </div>
