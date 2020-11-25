<?php
include 'config.php';
	error_reporting(0);
	if($_POST['delete'])
	{
		$id=$_POST['delete'];
		postdelete($id);
	}
	function getdescription($id)
	{
		global $conn;
		$sth = $conn->prepare("SELECT * from servers where id = ? order by votes limit 1");
									$sth->bind_param('i', $id);
									 $sth->execute();
									 $result = $sth->get_result();

			 if ($result->num_rows > 0){
			 while($row = mysqli_fetch_assoc($result))
			 		$tags = $row['title']." " . $row['description'];
					return $tags;}
	}
	function gettoken($n) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';

    for ($i = 0; $i < $n; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $randomString .= $characters[$index];
    }

    return $randomString;
}

	function resetpassword($password,$token)
	{
		global $conn;
		$query = $conn->prepare("UPDATE users set password = ? WHERE passwordkey=?");
		$query->bind_param('ss', $password, $token);
		$query->execute();
	}
	function settoken($email,$token)
	{
		global $conn;
		$query = $conn->prepare("UPDATE users set passwordkey = ? WHERE email=?");
		$query->bind_param('ss', $token, $email);
		$query->execute();
	}
	function getcategoryname($catid)
	{
		if($catid==1)
			return 'food';
		elseif($catid==2)
			return 'drinks';
		elseif($catid==3)
			return 'party';
		elseif($catid==4)
			return 'landmark';
	}

	function getposition1()
	{
		global $conn;
		$result = $conn->query("SELECT COUNT(*) FROM servers");
		$row = $result->fetch_row();
		return $row[0];
	}

	function getposition($votes)
	{
		global $conn;
		$result = $conn->query("SELECT COUNT(*) FROM servers where votes<=$votes");
		$row = $result->fetch_row();
		echo (getposition1()-$row[0])+1;
	}

	function getcity($id)
	{
			if($id==1)
				echo 'Alba Iulia';
			elseif($id==2)
				echo 'Brasov';
			elseif($id==3)
				echo 'Bucuresti';
			elseif($id==4)
				echo 'Cluj-Napoca';
			elseif($id==5)
				echo 'Constanta';
			elseif($id==6)
				echo 'Craiova';
			elseif($id==7)
				echo 'Iasi';
			elseif($id==8)
				echo 'Oradea';
			elseif($id==9)
				echo 'Sibiu';
			elseif($id==10)
				echo 'Sighisoara';
			elseif($id==11)
				echo 'Suceava';
			elseif($id==12)
				echo 'Targu Mures';
			elseif($id==13)
				echo 'Timisoara';
			elseif($id==14)
				echo 'Alt oras';
	}
	function getsortname($sort)
	{
		if($sort==0 || $sort==null)
			echo 'fresh';
		elseif($sort==2)
			echo 'hot';
		elseif($sort==3)
			echo 'top';

	}

	function getRegisteredUsers()
	{
		global $conn;
		$count = 0;
		$query="SELECT id from users";
		$result=$conn->query($query);
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
			$count = $count+1;
			}
		}
			echo $count;
	}

	function getPostCount()
	{
		global $conn;
		$count = 0;
		$query="SELECT id from servers";
		$result=$conn->query($query);
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
			$count = $count+1;
			}
		}
			echo $count;
	}

	function getusername($token)
	{
		global $conn;
		$sth = $conn->prepare("SELECT username from users where passwordkey = ?");
										$sth->bind_param("s", $token);
										$sth->execute();
										$result = $sth->get_result();

	if ($result->num_rows > 0)
	{
		while($row = $result->fetch_assoc())
		{
			return $row['username'];
		}
	}
	}
	function getmaxpost($category)
	{
		global $conn;
		$count = 0;
		if($category == 0)
{		$query="SELECT id from servers";
		$result=$conn->query($query);}
		else
		{
			$sth = $conn->prepare("SELECT * from servers where category = ?");
										$sth->bind_param("i", $category);
										$sth->execute();
										$result = $sth->get_result();
		}

		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
			$count = $count+1;
			}
		}
			return $count;
	}

	function getCommCount()
	{
		global $conn;
		$count = 0;
		$query="SELECT commentid from comments";
		$result=$conn->query($query);
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
			$count = $count+1;
			}
		}
			echo $count;
	}

	function gethash($password)
	{
		$hash = "*".sha1(sha1($password, true));
		return strtoupper($hash);
	}

	function register($username, $email, $password)
	{
			global $conn;

			$username=mysqli_real_escape_string($conn,$username);
			$email=mysqli_real_escape_string($conn,$email);

			$query = $conn->prepare("INSERT INTO users (username, email, password, level) VALUES (?, ?, ?, '0')");
			$query->bind_param('sss', $username, $email, $password);
			$query->execute();

			echo'<div class="alert alert-success" role="alert">Te ai inregistrat cu succes!</div>';
			echo '<meta http-equiv="refresh" content="3;url=index.php?page=home">';
	}
	function isValidYoutube($url)
	{
		if (preg_match("/^(http(s)?:\/\/)?((w){3}.)?youtu(be|.be)?(\.com)?\/.+/i", $url, $match))
		{
		  return true;
		}
		else {
		  return false;
		}
	}
	function getYoutubeIdFromUrl($url) {
	    $parts = parse_url($url);
	    if(isset($parts['query'])){
	        parse_str($parts['query'], $qs);
	        if(isset($qs['v'])){
	            return $qs['v'];
	        }else if(isset($qs['vi'])){
	            return $qs['vi'];
	        }
	    }
	    if(isset($parts['path'])){
	        $path = explode('/', trim($parts['path'], '/'));
	        return $path[count($path)-1];
	    }
	    return false;
	}

	function getlastid()
	{
		global $conn;
		$query="SELECT id from servers order by id desc limit 1";
		$result=$conn->query($query);
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
			$lastid=$row['id'];
			}
		}
			return $lastid;
	}
	function addpost($title, $description, $website,$link, $category, $youtube, $username, $city)
	{
			global $conn;

			$date=date("Y-m-d H:i:s");

			$description=mysqli_real_escape_string($conn,$description);
			$title=mysqli_real_escape_string($conn,$title);
			$category=mysqli_real_escape_string($conn,$category);

			$query = $conn->prepare("INSERT INTO servers (title, description,website, banner, category, youtube, username, date, city) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
			$query->bind_param('ssssssssi', $title, $description,$website, $link, $category, $youtube, $username,$date, $city);
			$query->execute();
			echo '<meta http-equiv="refresh" content="0;url=index.php?page=home">';
	}

	function editpost($title, $description, $website,$link, $category, $language, $level, $youtube, $id)
	{
			global $conn;


			$description=mysqli_real_escape_string($conn,$description);
			$title=mysqli_real_escape_string($conn,$title);
			$category=mysqli_real_escape_string($conn,$category);

			$query = $conn->prepare("UPDATE servers set title = ?, description = ?, website = ?,banner = ?, category = ?, language = ?, level = ?, youtube = ? WHERE id=?");
			$query->bind_param('ssssssssi', $title, $description,$website,$link, $category, $language, $level, $youtube, $id);
			$query->execute();
			echo $link;
			echo '<meta http-equiv="refresh" content="0;url=index.php?page=home">';
	}

	function isValidUserName($name) {
		if(preg_match('/^[0-9a-zA-Z]*$/', $name, $matches) && strlen($name)>=5 && strlen($name)<=16)
			return true;

		else return false;
	}

	function isValidUserPassword($password) {
		if(preg_match('/^[a-zA-Z0-9 @!#$%&(){}*+,\-.\/:;<>=?[\\]\^_|~]*$/', $password) && strlen($password)>=5 && strlen($password)<=16)
			return true;

		else return false;
	}

	function isValidUrl($url)
	{
		if (filter_var($url, FILTER_VALIDATE_URL))
			return true;

		else return false;
	}

	function check($id)
	{
		global $conn;
		$sth = $conn->prepare("SELECT id from servers where id=?");
											$sth->bind_param("i", $id);
											$sth->execute();
											$result = $sth->get_result();

			if ($result->num_rows > 0) {
				return 0;
			}
			else return 1;

	}

	function invalidtoken($token) {
		global $conn;
			$sth = $conn->prepare("SELECT * from users where passwordkey=?");
												$sth->bind_param("s", $token);
												$sth->execute();
												$result = $sth->get_result();

				if ($result->num_rows > 0) {
					return false;
				}
				else return true;
	}

	function isVaildWebsite($website) {
			global $conn;
			$sth = $conn->prepare("SELECT * from servers where website=?");
												$sth->bind_param("s", $website);
												$sth->execute();
												$result = $sth->get_result();

				if ($result->num_rows > 5) {
					return false;
				}
				else return true;

	}

	function isValidEmail($email) {
		global $conn;
		if(filter_var($email, FILTER_VALIDATE_EMAIL) && strlen($email)<=64)
		{
			$sth = $conn->prepare("SELECT * from users where email=?");
												$sth->bind_param("s", $email);
												$sth->execute();
												$result = $sth->get_result();

				if ($result->num_rows > 0) {
					return false;
				}
				else return true;
			}

		else return false;
	}

	function isValidTitle($title) {
		if(preg_match('/^[a-zA-Z0-9 @!#$%&(){}*+,\-.\/:;<>=?[\\]\^_|~]*$/', $name, $matches) && strlen($title)>=3 && strlen($title)<=16)
			return true;

		else return false;
	}

	function isValidPostText($title) {
		if(preg_match('/^[a-zA-Z0-9 @!#$%&(){}*+,\-.\/:;<>=?[\\]\^_|~]*$/', $name, $matches) && strlen($title)>=3 && strlen($title)<=2000)
			return true;

		else return false;
	}

	function isValidPostComment($title) {
		if(preg_match('/^[a-zA-Z0-9 @!#$%&(){}*+,\-.\/:;<>=?[\\]\^_|~]*$/', $name, $matches) && strlen($title)>=3 && strlen($title)<=200)
			return true;

		else return false;
	}

	function checkUserName($username)
	{
		global $conn;
		$sth = $conn->prepare("SELECT * from users where username = ?");
										$sth->bind_param("s", $username);
										$sth->execute();
										$result = $sth->get_result();

		if ($result->num_rows > 0) {
			return true;
		}
		 else return false;
	}

	function login($username, $password)
	{
		global $conn;

		$username=mysqli_real_escape_string($conn,$username);
		$password=gethash($password);

			$sth = $conn->prepare("SELECT * from users where username = ?");
											$sth->bind_param("s", $username);
											$sth->execute();
											$result = $sth->get_result();

		if ($result->num_rows > 0)
		{
			while($row = $result->fetch_assoc())
			{
				if($password==$row['password'])
				{
				  $_SESSION['username'] = $username;
					echo '<meta http-equiv="refresh" content="0;url=index.php?page=home">';
				}
				else
				{
					echo 'Wrong name or password!';
					echo $password;
				}
			}
		}
	}

	function voted ($ip, $id)
	{
		global $conn;
		$date1=date("Y-m-d H:i:s");
		$date1=strtotime($date1);
		$sth = $conn->prepare("SELECT * from votes where id = ? and ip = ? order by vid DESC");
										$sth->bind_param("is", $id, $ip);
										$sth->execute();
										$result = $sth->get_result();
		if ($result->num_rows > 0){
		while($row = $result->fetch_assoc())
			{

				$date2=$row['date'];
				$date2=strtotime($date2);
				$diff = abs($date1 - $date2);

				if($diff>86000)
				 return true;
				else {
					return false;
				}
			}
		}
		else
			return true;
	}

	function addvote($ip,$id,$rating)
	{
		global $conn;

			if(!voted($ip,$id))
				echo "You already voted";
			else
			{
					$date=date("Y-m-d H:i:s");
					$id=mysqli_real_escape_string($conn,$id);
					$update = $conn->prepare("UPDATE servers SET votes = votes + 1, rating = rating + ? where id = ?");
					$update->bind_param('is', $rating, $id);
					$update->execute();

					if ($conn->query($update) === FALSE)
						{
						echo "Error updating record: " . $conn->error;
						}
					else
						{
							$query = $conn->prepare("INSERT INTO votes (ip, id,date) VALUES (?,?,?)");
							$query->bind_param('sss', $ip, $id, $date);
							$query->execute();
						}
						//echo '<meta http-equiv="refresh" content="0">';
				}

	}
	function addclick($id)
	{
		global $conn;

				$id=mysqli_real_escape_string($conn,$id);
				$update = $conn->prepare("UPDATE servers SET clicks = clicks + 1 where id = ?");
				$update->bind_param('i', $id);
				$update->execute();

				$conn->query($update);

	}

	function dislike($id,$uid)
	{
		global $conn;
		$pid=mysqli_real_escape_string($conn,$id);
		$update = "UPDATE servers set `likes` = `likes`-1 where `id` ='$pid'";
		if ($conn->query($update) === FALSE)
			{
			echo "Error updating record: " . $conn->error;
			}
		else
		{
		$sth = $conn->prepare("DELETE from likes where uid = ? and pid = ?");
										$sth->bind_param("ii", $uid, $pid);
										$sth->execute();
										$result = $sth->get_result();
			$result=$conn->query($query);
			if(!$result)
			  {
				echo "Error!";
			  }
		}
		echo '<meta http-equiv="refresh" content="0">';
	}

	function checklike($username,$pid)
	{
		global $conn;
		$sth = $conn->prepare("SELECT * from likes where uid = ? and pid= ?");
											$sth->bind_param("ii", $username, $pid);
											$sth->execute();
											$result = $sth->get_result();

		if ($result->num_rows > 0)
		{
			return false;
		}
		 else
		{
			return true;
		}
	}

	function approve($id)
	{

		global $conn;
		$query = "UPDATE servers SET `state`=1 WHERE `id`='$id'";
		$result = $conn -> query($query);

	}
	function postdelete($id)
	{

		global $conn;
		$sth = $conn->prepare("DELETE from servers where id = ? ");
											$sth->bind_param("i", $id);
											$sth->execute();
											$result = $sth->get_result();

	}
	function isadmin($user)
	{
		global $conn;
		$sth = $conn->prepare("SELECT * from users where username = ? and level=9");
											$sth->bind_param("i", $user);
											$sth->execute();
											$result = $sth->get_result();
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
			return true;
			}
		}
	}
	function getcomments($id)
	{
		global $conn,$site_url;

		$id=mysqli_real_escape_string($conn,$id);

		$sth = $conn->prepare("SELECT * from comments where postid = ?");
										$sth->bind_param("i", $id);
										$sth->execute();
										$result = $sth->get_result();

		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
		 print

						'<article class="row" style="padding-left: 2%;">
								<img class="img-fluid" src="'.$site_url.'/img/default.png" style="max-height:10vh"/>
							<div class="col-md-10 col-sm-10">
							  <div class="panel panel-default left">
								<div class="panel-body">
								  <header class="text-left">
									<div class="comment-user"><i class="fa fa-user"></i> '. $row['username'].'</div>
									<time class="comment-date" datetime="16-12-2014 01:05"><i class="fa fa-clock-o"></i> '. $row['date'].'</time>
								  </header>
								  <div class="comment-post">
									<p>'.
									$row['comment'].
									'</p>
								  </div>

								</div>
							  </div>
							</div>
						  </article>' ;
			}
		}
	}

	function addcomm($author, $text, $id)
	{
			global $conn;

			$author=mysqli_real_escape_string($conn,$author);
			$text=mysqli_real_escape_string($conn,$text);
			$id=mysqli_real_escape_string($conn,$id);

			$date=date("Y-m-d H:i:s");

			$query = $conn->prepare("INSERT INTO comments (username, comment, postid, date) VALUES (?, ?, ?, ?)");
			$query->bind_param('ssss', $author, $text, $id ,$date);
			$query->execute();
			echo '<meta http-equiv="refresh" content="0">';

	}
?>
