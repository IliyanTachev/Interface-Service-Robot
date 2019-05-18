<?php
	
	if(isset($_POST['submitReg'])){
			
			require 'db_con.php';
			
			$user = mysqli_real_escape_string($conn, $_POST['user-names']);
			$username = mysqli_real_escape_string($conn, $_POST['username']);
			$password = mysqli_real_escape_string($conn, $_POST['password']);
			$passwordRepeat = mysqli_real_escape_string($conn, $_POST['pass_confirm']);
			
			$responseData = array();
			$responseData['error'] = "";
			$responseData['userData'] = "";
			
			if(empty($user) || empty($username) || empty($password) || empty($passwordRepeat)){
				$responseData['error'] = "emptyfields";
				$responseData['userData'] = "&usr=" . $user . "&uid=" . $username;
			}
			else if(!preg_match("/^[a-zA-Z\s]*$/", $user) && !preg_match("/^[a-zA-Z0-9]*$/", $username)){
				$responseData['error'] = "invalidFieldsData";
			}
			else if(!preg_match("/^[a-zA-Z\s]*$/", $user)){
				$responseData['error'] = "invalidnames";
				$responseData['userData'] = "&uid=" . $username;
			}
			else if(!preg_match("/^[a-zA-Z0-9]*$/", $username)){
				$responseData['error'] = "invalid-username";
				$responseData['userData'] = "&usr=" . $user;
			}
			else if($password != $passwordRepeat){
				$responseData['error'] = "passwordCheck";
				$responseData['userData'] = "&usr=" . $user . "&uid=" . $username;
			}
			else{
				$sql = "SELECT username FROM operators WHERE username='$username'";
				$res = mysqli_query($conn, $sql);
				$numRows = mysqli_num_rows($res);
					
				if($numRows > 0){
					$responseData['error'] = "invalid-username-exist";
					$responseData['userData'] = "&usr=" . $user;
				}
				else{
					$salt = "34%qasderfsimplythebestj";
					$hashedpass = sha1(sha1($salt. $password . $salt).$salt);
					$sql = "INSERT INTO operators SET names='$user', username='$username', passw='$hashedpass', create_date=NOW(), user_enabled='1'";
					$res = mysqli_query($conn, $sql);
				}
			}
			mysqli_close($conn);
	}
	else{
		$responseData['error'] = "notsubmit";
	}
	
	if($responseData['error'] == ""){
		header("Location: " . "signin.php?register=success");
	}
	echo json_encode($responseData);
?>

