<!doctype html>
	<html>
	<head>
		<meta charset="utf-8">
		<title>Log in Form</title>
	</head>
	<body>
		<h1>Log in form</h1>
		<?php
		define('filepath',"data.txt");
		$uname=$pass=$unameErr=$passErr="";
		$flag=false;
		$loginflag=false;
		if($_SERVER['REQUEST_METHOD']==="POST")
		{
			
			$uname=$_POST['uname'];
			$pass=$_POST['pass'];
			if(empty($uname ))
			{
				$unameErr="username should be 8 characters 2 numerical";
				$flag= true;
			}

			    if(empty($pass ))
			{
				$passErr="password should be 8 charcter";
				$flag= true;
			}
			    
			    if($flag)
			{
				$exist_data = read();
	    		 $fileDataExplode = json_decode($exist_data,true);
	    		 
		    	foreach((object)$fileDataExplode as $candidate) {
				    if($candidate['uname'] === $uname and $candidate['password'] === $pass)
				    {
				    	$logFlag = True;
				    	header('location:C:\xampp\htdocs\a1\log_in.php');
				    	

				    	
				    }
			    }

			    if(!$logFlag)
			    {
			    	$errorMessage = "log-in failed";
			    }
			    
			}
		}
		function test_input($data)
		{
			$data=trim($data);
			$data=stripcslashes($data);
			$data=htmlspecialchars($data);
		}
		
		function read()
		{
			$filename="data.txt";
			$filesize=filesize($filename);
			$fr="";
			if($filesize>0)
			{


			$resource=fopen($filename,"r");
			$fr=fread($resource,$filesize);
			fclose($resource);
			return $fr;
		}
		}
			?>
			<div style = "position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
			<form action="<?php htmlspecialchars($_SERVER['PHP_SELF'])?>" method="POST">
			<fieldset>
			<legend> Account Information:</legend>
			<label for="uname">Username<span style="color: red;">*</span>:</label>
			<input type="text" id="uname" name="uname" >
			<span style="color: red"><?php echo $unameErr;?></span>
			<br>
			<br>
			
			<br>
			<label for="pass">Password<span style="color: red;">*</span>:</label>
			<input type="Password" id="pass" name="pass" >
			<span style="color: red"><?php echo $passErr;?></span>
			

			



		</fieldset>
		<br>
		<input type="Submit" name="submit" value="log in">

	</form>
	

	</body>
	</html>
			

