<?php
	//Start session
	session_start();
	
	//Array to store validation errors
	$errmsg_arr = array();
	
	//Validation error flag
	$errflag = false;
	
	//Connect to mysql server
//	$link = mysql_connect('sertazdb.adamstudio.cl','kampeg','kampegerp');
	// $link = mysql_connect('200.6.99.249','kam837cl','peg791rNo');
	// if(!$link) {
	// 	die('Fallo al conectarse al servidor: ' . mysql_error());
	// }
	
	//ANACONDAWEB
	$link = mysql_connect('localhost','root','Kampeg123');
	if(!$link) {
		die('Fallo al conectarse al servidor: ' . mysql_error());
	}

	//Select database
	$db = mysql_select_db('kampegerp-produccion', $link);
	if(!$db) {
		die("imposible conectarse a la BBDD");
	}
	
	//Function to sanitize values received from the form. Prevents SQL injection
	function clean($str) {
		$str = @trim($str);
		if(get_magic_quotes_gpc()) {
			$str = stripslashes($str);
		}
		return mysql_real_escape_string($str);
	}
	
	//Sanitize the POST values
	$login = clean($_POST['username']);
	$password = clean($_POST['password']);
	
	//Input Validations
	if($login == '') {
		$errmsg_arr[] = 'Usuario incorrecta';
		$errflag = true;
	}
	if($password == '') {
		$errmsg_arr[] = 'Contrase&ntilde;a incorrecta';
		$errflag = true;
	}
	
	//If there are input validations, redirect back to the login form
	if($errflag) {
		$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		session_write_close();
		header("location: index.php");
		exit();
	}
	
	//Create query
	$qry="SELECT * FROM user WHERE username='$login' AND password='$password'";
	$result=mysql_query($qry);
	
	//Check whether the query was successful or not
	if($result) {
		if(mysql_num_rows($result) > 0) {
			//Login Successful
			session_regenerate_id();
			$member = mysql_fetch_assoc($result);
			$_SESSION['SESS_MEMBER_ID'] = $member['id'];
			$_SESSION['SESS_FIRST_NAME'] = $member['name'];
			$_SESSION['SESS_TYPE'] = $member['position'];
			$_SESSION['SESS_EMPRESA_ID'] = $member['empresa_id'];
			$_SESSION['SESS_SUCURSAL_ID'] = $member['sucursal_id'];
			$_SESSION['SESS_USER'] = $member['username'];
			$userposition = $_SESSION['SESS_TYPE'];
			//$_SESSION['SESS_PRO_PIC'] = $member['profImage'];
			session_write_close();
			header("location: intranet/index.php");
			exit();
		}else {
			$errmsg_arr[] = 'Usuario o Contrase&ntilde;a incorrecta';
			$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
			//Login failed
			header("location: index.php");
			exit();
		}
	}else {
		die("Fallo en la consulta a la BBDD");
	}
?>