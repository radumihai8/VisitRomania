<?php

if (isset($_POST['register']))
	{
		if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['email']) )
		{
		global $conn;
		$errors = array();
		if(!isValidUserName($_POST['username']))
			$errors[]=$translate['error-username'];
		if(!isValidUserPassword($_POST['password']))
			$errors[]=$translate['error-password'];
		if(!isValidEmail($_POST['email']))
			$errors[]=$translate['error-email'];
		if(checkUserName($_POST['username']))
			$errors[]=$translate['error-already'];
		if(empty($_POST['g-recaptcha-response']))
				$errors[]=$translate['error-captcha'];

		foreach($errors as $error)
		{
			echo $error;
		}

		if(!count($errors))
			{
			$username = $_POST['username'];
			$email = $_POST['email'];
			$password =gethash($_POST['password']);
			$result=register($username, $email, $password);
			}
		}
		else {
			echo $translate['error-complete'];
		}
	}

?>

    <div class="container" style="padding-bottom: 20%; padding-top: 10%;">
        <form method="post" action="">
            <div class="form-group">
                <label for="inlineFormInputGroup"><?php echo $translate['username']; ?></label>
                <input type="text" class="form-control" name="username" aria-describedby="emailHelp" placeholder="Username">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1"><?php echo $translate['email']; ?></label>
                <input type="email" class="form-control" name="email" aria-describedby="emailHelp" placeholder="example@visitromania.ro">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1"><?php echo $translate['password']; ?></label>
                <input type="password" class="form-control" name="password" placeholder="Password">
            </div>
            <div class="form-group">
                <div id="captcha" class="g-recaptcha" data-sitekey="6Ld51fUUAAAAAMF0KBmLmr8TAbUTL4M69JXOMBAX"></div>
            </div>
            <button type="submit" class="btn btn-primary" name="register"><?php echo $translate['submit']; ?></button>
        </form>
    </div>
