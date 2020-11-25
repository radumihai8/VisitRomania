<?php

if($_SESSION['username'])
{
echo 'You`re already logged in!';
echo '<meta http-equiv="refresh" content="0;url=index.php?page=home">'; }
else
{
if (isset($_POST['login']))
	{
		if(isset($_POST['username']) && isset($_POST['password']) )
		{
			global $conn;
			$errors = array();
			if(!isValidUserName($_POST['username']))
				$errors[]='Username must be formed only with 5-16 numbers/letters!';
			if(!isValidUserPassword($_POST['password']))
				$errors[]='Password must be formed only with 5-16 numbers/letter/symbols !';
			if(empty($_POST['g-recaptcha-response']))
				$errors[]='<div class="alert alert-danger" role="alert">Please check if you`re not a robot!</div>';

		foreach($errors as $error)
			echo $error;

		if(!count($errors))
			{
			$username = $_POST['username'];
			$password =$_POST['password'];
			$result=login($username, $password);
			}
		}
	}
echo $_SESSION['logged_in'];
}
?>

    <div class="container" style="padding-bottom: 20%; padding-top: 10%;">
        <form method="post" action="">
            <div class="form-group">
                <label for="inlineFormInputGroup"><?php echo $translate['username'];?></label>
                <input type="text" class="form-control" name="username" aria-describedby="emailHelp" placeholder="Username">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1"><?php echo $translate['password'];?></label>
                <input type="password" class="form-control" name="password" placeholder="Password">
            </div>
            <div class="form-group">
                <div id="captcha" date-theme="dark" class="g-recaptcha" data-sitekey="6Ld51fUUAAAAAMF0KBmLmr8TAbUTL4M69JXOMBAX"></div>
            </div>
            <button type="submit" class="btn btn-primary" name="login"><?php echo $translate['login'];?></button><br>
						<label for="login"><a style="color:#fff;"href="<?php echo $site_url;?>?page=forgot">Forgot username/password.</a></label>
        </form>
    </div>
