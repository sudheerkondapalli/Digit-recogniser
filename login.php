





<?php
//header("Location: signUp.html");


foreach (glob("classes/*.php") as $filename)
{
    include $filename;
}


session_start();
$email = $_POST['username'];
$password = $_POST['password'];
// connect to the mysql database
$link = mysqli_connect('localhost','root','','airlinereservation');
//check if user with same username exists in db
$sql = "SELECT password, firstname, lastname FROM user WHERE username = '".$email."';";


$result = mysqli_query($link,$sql);

if($result)
{
	$row = mysqli_fetch_row($result);
	
	
	
	if($row!=null && (strcasecmp($row[1], $password)==0))
	{
		$_SESSION['user_fname'] = $row[2];
		$_SESSION['user_lastname'] = $row[3]; 
 		$_SESSION['username'] = $email;
		session_write_close();
		
		//Redirect to redirecting page 		
				if(isset($_POST['redirurl'])) 
				{
					$url = $_POST['redirurl']; // holds url for last page visited. 
					header("Location:$url");
				}                                
				else                             
				{
					//echo ("Redirected from:". $_POST['redirurl']);
					header("Location: viewReservations.php");
					
				}
	}
}

	
?>





