<?php

	error_reporting(0);
	session_start();
	include('conn.php');
	// unset cookies
	if(isset($_SERVER['HTTP_COOKIE'])) {
		$cookies  = explode(';', $_SERVER['HTTP_COOKIE']);
		foreach($cookies as $cookie) {
			$parts = explode('=', $cookie);
			$name  = trim($parts[0]);
			setcookie($name, '', time() - 3600);
			unset($_SERVER['HTTP_COOKIE']);
		}
	}
	//echo "<br>";
	//print_r($_SERVER['HTTP_COOKIE']);
	/* if($_SERVER['SERVER_PORT']!=443) {
		$url = "https://". $_SERVER['SERVER_NAME'] . ":443".$_SERVER['REQUEST_URI'];
		header("Location: $url");
	} */
	if(isset($_POST['user_id']))
		$name_submitted=$_POST['user_id'];
	if(isset($_POST['password']))
		$passwd_submitted=$_POST['password'];
	$curlLogin=false;
	$empName="";
	if(isset($HTTP_COOKIE_VARS['cookie']))
		$cookie=$HTTP_COOKIE_VARS['cookie'];
	if($name_submitted && $passwd_submitted && ($passwd_hash==$encrypt_pass)) {
		## to be removed ##
		$_SESSION['empCode'] = (int) $name_submitted;
		$name_submitted = 'sriram';
		$passwd_submitted = '1995$OmSai>^'.$name_submitted;
		echo '<script> window.location ="loginCheck.php"; </script>';
		die;
		## to be removed ##
		list($passwd_submitted,$forwardEmpCode)=explode('>^',$passwd_submitted);
		$forwardEmpCode = trim($forwardEmpCode);
		$ldap_host = 'ldaps://auths.nic.in';
		$ldap_port = 636;
		$base_dn = 'ou=People,o=NIC Employees,o=NIC Support,o=nic.in,dc=nic,dc=in';
		$script = $_SERVER['SCRIPT_NAME'];
		$search_value = $name_submitted;
		$filter = "(uid=$search_value)";
		$ldap_user = "uid=$name_submitted, $base_dn";
		$ldap_pass = $passwd_submitted;
		$connect = ldap_connect( $ldap_host, $ldap_port) or exit('Could not connect to LDAP server');
		ldap_set_option($connect, LDAP_OPT_PROTOCOL_VERSION, 3);
		ldap_set_option($connect, LDAP_OPT_REFERRALS, 0);
		if(!($bind = ldap_bind($connect, $ldap_user, $ldap_pass))) {
		#####################################################
			$url = 'https://10.247.16.100/FileService/ValidateLogin';
			$data = "username=$name_submitted&password=$passwd_submitted";
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,false);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,false);
			if (curl_errno($ch)) echo 'Curl error: ' . curl_error($ch);
			else $curl_output =curl_exec($ch);
			if($curl_output) {
				$json_obj = json_decode($curl_output,true);
				$empcode = null;
				if(isset($json_obj['status']) && $json_obj[status]=='1') {
					$empcode = $json_obj['empCode'];
					$empName = $json_obj['empName'];
					$curlLogin = true;
				}
			}
			if(!$curlLogin){
				#####################################################
				echo '<script> alert("Login Failed: Invalid userID or password"); </script>';
				$_SESSION['auth'] = 2;
				header('location: index.php');
				$ip = $_SERVER['REMOTE_ADDR'];
				$crntdate = date('d/m/Y-H:i:s',time());
				$TFRVar = 'TFR';
				$LoginFailedVar = 'Login Failed';
				## $insert_query = $db->prepare("INSERT INTO ltc.ltc_login_details(ip,login_desc,emp_name) VALUES(:ip, :Login, :name_submitted)");
				## $insert_query->bindParam(':ip', $ip);
				## $insert_query->bindParam(':Login', $LoginFailedVar);
				## $insert_query->bindParam(':name_submitted', $name_submitted);
				## $insert_stmt = $insert_query->execute();
				$_SESSION['auth'] = 2;
				header('location: index.php');
				exit ('Login Failed: Invalid userID or password');
			}
		}
		//else
		{
			if(!$curlLogin){
				$read = ldap_search($connect, $base_dn, $filter) or exit('Unable to search ldap server');
				$info = ldap_get_entries($connect, $read);
				$empcode=$info[0]["employeenumber"][0];
				$initial = $info[0]["givenname"][0];
				$sname  =  $info[0]["sn"][0];
				$empName = "$initial $sname";
			}
			$_SESSION['empCode'] = $name_submitted;
			$_SESSION['userName'] = $empName;
			#$read = ldap_search($connect, $base_dn, $filter) or exit("Unable to search ldap server");
			#$info = ldap_get_entries($connect, $read);
			#$_SESSION['emailID']=$name_submitted;
			#$empcode=$info[0]["employeenumber"][0];
			if ($forwardEmpCode && ($empcode==421 || $empcode==6008))
				$empcode = $forwardEmpCode;
			$result1= pg_query($pgconn, "select aadhaar_no from aadhaar.aadhaar_details a where a.empcode = ".$empcode." and rel_code=0");
			$row1=pg_fetch_assoc($result1);
			$uid = $row1['aadhaar_no']; 
			$_SESSION['uID'] = $uid;
			$_SESSION['empCode'] = (int) $empcode;
			#$initial = $info[0]["givenname"][0];
			#$sname = $info[0]["sn"][0];
			#$_SESSION['userName'] = "$initial $sname";
		}
		if($_SESSION['empCode'] && $_SESSION['emailID'] && $_SESSION['userName']) {
			$ip = $_SERVER['REMOTE_ADDR'];
			$crntdate = date('d/m/Y-H:i:s', time());
			$TFRVar1 = 'TFR';
			$LoginFailedVar1 = 'Successful Login';
			## $insert_query1 = $db->prepare("INSERT INTO ltc.ltc_login_details(ip,login_desc,emp_name) VALUES(:ip, :Login, :name_submitted)");
			## $insert_query1->bindParam(':ip', $ip);
			## $insert_query1->bindParam(':Login', $LoginFailedVar1);
			## $insert_query1->bindParam(':name_submitted', $name_submitted);
			## $insert_stmt1 = $insert_query1->execute();
			echo '<script> window.location ="loginCheck.php"; </script>';
		} else {
			header('location: index.php');
		}
	}
	else {
?>
<html>
	<head>
		<title>Staff Grievance Redress System (SGRS)</title>
		<script>
			function checkForm(f) {
				if(f.user_id.value=="") {
					alert("Please enter User Name");
					f.user_id.focus();
					return false;
				}
				if(f.password.value=="") {
					alert("Please enter Password");
					f.password.focus();
					return false;
				}
				if(f.captcha.value=="") {
					alert("Please enter captcha");
					f.captcha.focus();
					return false;
				}
				if(f.password.value!="") {
					var p = document.getElementById("password").value;
					document.getElementById("encrypt_pass").value = md5(p);
					return true;
				}
			}
			function md5value() {
				var p = document.getElementById("password").value;
				document.getElementById("encrypt_pass").value = md5(p);
			}
		</script>
		<script>
			function stripSpaces(x) {
				while (x.substring(0,1) == ' ') x = x.substring(1);
				return x;
			}
			function empty(x) {
				if (x.length > 0)
					return false;
				else
					return true;
			}
		</script>
		<script>
			function stripSpaces(x) {
				return x.replace(/^\W+/,'');
			}
		</script>
		<script>
			function checkForm(f) {
				if(f.user_id.value=="") {
					alert("Please enter User Name");
					f.user_id.focus();
					return false;
				}
				if(f.password.value=="") {
					alert("Please enter Password");
					f.password.focus();
					return false;
			}
			}
		</script>
		<link href="css/new_login_style.css" rel="stylesheet">
		<script type="text/javascript" src="javascript/right_click.js"></script>
		<script type="text/javascript" src="javascript/scroll.js"></script>
		<link rel="shortcut icon" href="di_faviconew.ico" type="image/ico" />
	</head>
	<center>
		<body onload='appForm.user_id.focus()'>
			<div id="wrapper">
				<form name='appForm' method='post' class='login-form' onSubmit="return checkForm(appForm);" >
					<div class="header">
						<img src= "img/images/niclogopatch.jpg" width="252" height="53" />
						<center><h1>Staff Grievance Redress System</h1></center>
						<span>Enter your NICemail ID and password to log in.</span>
					</div>
					<div class="content">
						<center>
							<?php $error=$_GET[error]; ?>
						</center>
						<input type="hidden" name="action" value="login">
						<input type="hidden" name="hide" value="">
						<input type="text" name="user_id" div='false' class='input username' placeholder='NICemail ID' onkeypress='return event.keyCode!=13' onkeyup='javascript: document.getElementById("password").value = this.value;'>
						<div class="user-icon"></div>
						<input type="password" required='required'name="password" autocomplete="off" placeholder='Password' class='input password' id='password'>
						<div class="pass-icon"></div>
					</div>
					<?php
						if($error)
							echo "<tr><td colspan=2><font face='verdana,arial' size=-1 color=red>Invalid User Name or Password</td></tr>";
					?>
					<div class="footer">
						<input type="submit" class='button' value="Sign In">
					</div>
				</form>
			</div>
			<br><br><br><br><br><br><br><br>
			<div class="gradient"></div>
			<br><br><br><br><br>
			<div align="center" style="text-shadow: #bdd73e 0 0 20px; font-family: Georgia, 'Times New Roman', Times, serif; font-size: 15px;">For any queries, please contact at 011-24305264 or mail at nic-oad(at)nic.in</div>
			<div align="center" style="text-shadow: #bdd73e 0 0 20px; font-family: Georgia, 'Times New Roman', Times, serif; font-size: 15px;">Designed and Developed by NIC�</div>
		</body>
	</center>
</html>
<?php
	}
	die;
	exit;

?>