<?

$token = $_GET['key'];

if(invalidtoken($token))
{
	echo '<meta http-equiv="refresh" content="0;url=index.php?page=home">';
}

if (isset($_POST['reset']) && !(invalidtoken($token)))
	{
		if(isset($_POST['password']))
		{
		global $conn;
		$errors = array();
		if(!isValidUserPassword($_POST['password']))
			$errors[]=$translate['error-password'];
		if(empty($_POST['g-recaptcha-response']))
				$errors[]=$translate['error-captcha'];

		foreach($errors as $error)
		{
			echo $error;
		}

		if(!count($errors))
			{
			$password =gethash($_POST['password']);
			$result=resetpassword($password, $token);
			}
		}
		else {
			echo $translate['error-complete'];
		}
	}
  ?>

<div class="container" style="padding-bottom: 20%; padding-top: 10%;">
    <form method="post" action="">
        <h4> Choose your new password </h4>
        <div class="form-group">
            <label for="exampleInputPassword1"><?php echo $translate['password']; ?></label>
            <input type="password" class="form-control" name="password" placeholder="Password">
        </div>
        <div class="form-group">
            <div id="captcha" class="g-recaptcha" data-sitekey="6Ld51fUUAAAAAMF0KBmLmr8TAbUTL4M69JXOMBAX"></div>
        </div>
        <button type="submit" class="btn btn-primary" name="reset"><?php echo $translate['submit']; ?></button>
    </form>
</div>
