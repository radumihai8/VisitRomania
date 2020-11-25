<?php
include 'config.php';

global $conn;
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

$date=date("Y-m-d H:i:s");

$description=mysqli_real_escape_string($conn,$description);
$title=mysqli_real_escape_string($conn,$title);
$category=mysqli_real_escape_string($conn,$category);

$link=$target_file;

$title = $_POST['title'];
$description = $_POST['description'];
$category = $_POST['category'];
$language = $_POST['language'];
$level = $_POST['level'];
$youtube = $_POST['youtube'];

$query = $conn->prepare("INSERT INTO servers (title, description, banner, category, language, level, youtube, username, date) VALUES (?, ?, ?, ?, ?, ?, ?, ?,?)");
$query->bind_param('sssssssss', $title, $description, $link, $category, $language, $level, $youtube, $username,$date);
$query->execute();

echo'<div class="alert alert-success" role="alert">Ai adaugat postul cu succes! Asteapta aprobarea acestuia!</div>';
echo '<meta http-equiv="refresh" content="3;url=index.php?page=home">';
?>
