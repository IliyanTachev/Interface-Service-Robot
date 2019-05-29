<?php
	include 'db_con.php';
	
	$cmd = $_GET['cmd'];
	$user = "";
	$userID = "";
	$setRandCookie="";
	$flag = false;
	function user_logged(){
		global $conn;
		if($_COOKIE['userID'] != ""){
			$curr = $_COOKIE['userID'];
			$sql = "SELECT ID,names FROM operators WHERE cookie='$curr'";
			$res = mysqli_query($conn, $sql);
			if(mysqli_num_rows($res) > 0) {
				$row = mysqli_fetch_assoc($res);
				//$user = $row['names'];
				//$userID = $row['ID'];
				return true;
			}
			return false;
		}
		
		return false;
	}
	
	if($cmd == "login"){ //&& user_logged() == false
		$username = mysqli_real_escape_string($conn, $_POST['username']);
		$password = mysqli_real_escape_string($conn, $_POST['password']);
		
		if(empty($username) || empty($password)){
			header("Location: " . "signin.php?error=emptyfields");
		}
		else{
			$salt = "34%qasderfsimplythebestj";
			$hashedpass = sha1(sha1($salt. $password . $salt).$salt);
			$sql = "SELECT * FROM operators WHERE username='$username' AND passw='$hashedpass' LIMIT 1";
			$res = mysqli_query($conn, $sql);
			$resultRow = mysqli_fetch_assoc($res);
			if(mysqli_num_rows($res) > 0){
				$setRandCookie = md5(rand(1500, 100000000)); 
				$sql = "UPDATE operators SET cookie='$setRandCookie', last_login_date=NOW()  WHERE ID='$resultRow[ID]'";
				mysqli_query($conn, $sql);
				setcookie("userID", $setRandCookie, time() + 3600);
				header("Location: $_SERVER[PHP_SELF]");
				exit;
			}
			else {
				header("Location: " . "signin.php?error=invalidCredentials");
				exit;
			}
		}
	}
	else if($cmd == "logout"){
		$sql = "UPDATE operators SET cookie='' WHERE cookie='$_COOKIE[userID]'";
		mysqli_query($conn, $sql);
		setcookie("userID", '');
		header("Location: " . "signin.php");
		exit;
	}
							
	if(!user_logged()) {
		header("Location: " . "signin.php");
		exit;
	}
	
	mysqli_close($conn);
?>
