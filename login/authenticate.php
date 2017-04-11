<?php 
	require 'database-config.php';

	session_start();

	$username = "";
	$password = "";
	
	if(isset($_POST['username'])){
		$username = $_POST['username'];
	}
	if (isset($_POST['password'])) {
		$password = $_POST['password'];

	}
	
	echo $username ." : ".$password;

	$q = 'SELECT * FROM emp_info WHERE username=:username AND password=:password';

	$query = $dbh->prepare($q);

	$query->execute(array(':username' => $username, ':password' => $password));


	if($query->rowCount() == 0){
		header('Location: index.php?err=1');
	}else{

		$row = $query->fetch(PDO::FETCH_ASSOC);

		session_regenerate_id();
		$_SESSION['sess_emp_id'] = $row['emp_id'];
		$_SESSION['sess_username'] = $row['username'];
        $_SESSION['sess_userrole'] = $row['role'];

        echo $_SESSION['sess_userrole'];
		session_write_close();

		if( $_SESSION['sess_userrole'] == "admin"){
			header('Location: adminhome.php');
		}
		else if($_SESSION['sess_userrole'] == "hod" ) {
			header('Location: hodhome.php');
		}
		else if($_SESSION['sess_userrole'] == "principal" ) {
			header('Location: ../Employee/principal_apporve.php');
		}
		else if($_SESSION['sess_userrole'] == "registerar" ) {
			header('Location: ../Employee/registerar_apporve.php');
		}
		else{
			header('Location: userhome.php');
		}
		
		
	}


?>