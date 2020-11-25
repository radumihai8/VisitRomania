<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'src/Exception.php';
require 'src/PHPMailer.php';
require 'src/SMTP.php';

if (isset($_POST['forgot']))
	{
		global $conn;
		$errors = array();
		if(empty($_POST['g-recaptcha-response']))
				$errors[]=$translate['error-captcha'];



		$sth = $conn->prepare("SELECT username,email from users where email = ? limit 1");
		$sth->bind_param('s', $_POST['email']);
		$sth->execute();
		$result = $sth->get_result();
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$email = $row['email'];
				$username = $row['username'];
			}
		}
		else 
			$errors[]="This user doesn`t exist";
		
		foreach($errors as $error)
		{
			echo $error;
		}
		if(!count($errors))
		{
				$email = $_POST['email'];
				$mail = new PHPMailer(true);
				$token=gettoken(12);

			settoken($email,$token);
			try {
				//Server settings
				$mail->SMTPDebug = 0;                                       // Enable verbose debug output
				$mail->isSMTP();                                            // Set mailer to use SMTP
				$mail->Host       = '.';  // Specify main and backup SMTP servers
				$mail->SMTPAuth   = true;                                   // Enable SMTP authentication
				$mail->Username   = '.';                     // SMTP username
				$mail->Password   = '.';                               // SMTP password
				$mail->SMTPSecure = 'ssl';                                  // Enable TLS encryption, `ssl` also accepted
				$mail->Port       = 465;                                    // TCP port to connect to

				//Recipients
				$mail->setFrom('noreply@hust.world', 'Visit Romania');
				$mail->addAddress($email, $username);     // Add a recipient

				// Attachments   // Optional name

				// Content
			  $link = $site_url . "?page=reset&key=" . $token;
				$mail->isHTML(true);                                  // Set email format to HTML
				$mail->Subject = 'Visit Romania password reset for '.$username;
				$mail->Body    = "Hello, ".$username." ! Follow this link to reset your password: " . $link;

				$mail->send();
				echo '<div class="alert alert-success" role="alert">The message has been sent!</div>';
			} catch (Exception $e) {
				echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
			}
		}
		else {
			echo $translate['error-complete'];
		}
	}
?>

<div class="container" style="padding-bottom: 20%; padding-top: 10%;">
    <form method="post" action="">
      <h4> Fill in your email and check your inbox / spam for your username and password reset link </h4>
        <div class="form-group">
            <label for="exampleInputEmail1"><?php echo $translate['email']; ?></label>
            <input type="email" class="form-control" name="email" aria-describedby="emailHelp" placeholder="exemplu@hust.world">
        </div>
        <div class="form-group">
            <div id="captcha" data-theme="dark" class="g-recaptcha" data-sitekey="6Ld51fUUAAAAAMF0KBmLmr8TAbUTL4M69JXOMBAX"></div>
        </div>
        <button type="submit" class="btn btn-primary" name="forgot"><?php echo $translate['submit']; ?></button>
    </form>
</div>
