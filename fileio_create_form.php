<!doctype html>
	<html>
	<head>
		<meta charset="utf-8">
		<title>File IO</title>
	</head>
	<body >

		<h1>File IO</h1>

		<?php
		define("filepath","data.txt");
		$fname=$lname=$DoB=$religion=$email=$uname=$pass=$presentaddress=$permanentaddress=$phonono="";
		$fnameErr=$lnameErr=$genderErr=$DoBErr=$religionErr=$emailErr=$unameErr=$passErr="";
		$flag=false;
		$successfulMessage ="";
		$errorMessage="";
		$gender="";

		if($_SERVER['REQUEST_METHOD']==="POST")
		{
			$fname=$_POST['fname'];
			$lname=$_POST['lname'];
			$gender=$_POST['gender'];
			$DoB=$_POST['DoB'];
			$religion=$_POST['religion'];
			$email=$_POST['email'];
			$uname=$_POST['uname'];
			$pass=$_POST['pass'];
			$presentaddress=$_POST['comment'];
			$permanentaddress=$_POST['comment0'];
			$phonono=$_POST['phone'];
			if(empty($fname ))
			{
				$fnameErr="first name cannot be empty";
				$flag= true;
			}
			if(empty($lname))
			{
				$lnameErr="last name cannot be empty";
				$flag= true;
			}
			if(empty($gender ))
			{
				$genderErr= "required";
				$flag= true;
			}
			if(empty($DoB ))
			{
				$DoBErr="required";
				$flag= true;
			}
			if(empty($religion ))
			{
				$religionErr="it's require";
				$flag=true;
			}
			if(empty($email ))
			{
				$emailErr="email canno be invalid";
				$flag= true;
			}
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
			if(!$flag)
			{ 
			 $exist_data=read();
			 if(empty($exist_data))
			 {
			 	$arr[]=array("firstname"=>$fname,"lastname"=>$lname,"gender"=>$gender,"dob"=>$DoB,"religion"=>$religion,"presentaddress"=>$presentaddress,"permanentaddress"=>$permanentaddress,"phonno"=>$phonono,"username"=>$uname,"password"=>$pass,"email"=>$email);
			 }

				else
				{
					$arr=json_decode($exist_data);
					$arr2=array("firstname"=>$fname,"lastname"=>$lname,"gender"=>$gender,"dob"=>$DoB,"religion"=>$religion,"presentaddress"=>$presentaddress,"permanentaddress"=>$permanentaddress,"phonno"=>$phonono,"username"=>$uname,"password"=>$pass,"email"=>$email);

			 
					array_push($arr, $arr2);
				}
				$arr_encode=json_encode($arr);
				write("");
				$result=write($arr_encode);
				if($result)
				{
					$successfulMessage="succesfully received";
				}
				else
				{
                   $errorMessage="error ";
				}
			}
		}
		function test_input($data)
		{
			$data=trim($data);
			$data=stripcslashes($data);
			$data=htmlspecialchars($data);
		}
		function write($content)
		{

				$filename="data.txt";
				$resource=fopen($filename,"w");
				$fw=fwrite($resource,$content);
				fclose($resource);
				return $fw;
		}


		?>


		<form action="<?php htmlspecialchars($_SERVER['PHP_SELF'])?>" method="POST">
		<fieldset>
			<legend>Basic Information :</legend>
			<label for="fname">First Name<span style="color: darkred;">*</span>:</label>
			<input type="text" id="fname" name="fname" >
			<span style="color: darkred"><?php echo $fnameErr; ?></span>

		
			
			<label for="lname">Last Name<span style="color: darkred;">*</span> :</label>
			<input type="text" id="lname" name="lname" >
			<span style="color: darkred"><?php echo $lnameErr; ?></span>
			<br>


			<label for="gender">Gender<span style="color: darkred;">*</span>:</label>
			
			<br>
			<input type="radio" id="gender" name="gender">
			<label for="male">Male</label>
			<br>
			<input type="radio" id="gender" name="gender">
			<label for="female">Female</label>
			<br>
			<input type="radio" id="gender" name="gender">
			<label for="other"> other</label>
			<span style="color: darkred"><?php echo $genderErr; ?></span>
			<br>
			<label for="DoB">DoB<span style="color: darkred;">*</span>:</label>
			<input type="date" id="DoB" name="DoB">
			<span style="color: darkred"><?php echo $DoBErr; ?></span>
			<br>
			<label for="religion">Religion<span style="color: darkred;">*</span>:: </label>
			<span style="color: darkred"><?php echo $religionErr; ?></span>
			<select id="religion" name="religion"> 
				
			<option value="muslim">Muslim</option>
			
			<option value="hindu">Hindu</option>
			
			
		</select>
	</fieldset>
        <fieldset>
			<legend>Contact Information :</legend>
			<label for="comment">Present Address</label>
			<textarea id="comment" name="comment" rows="3" cols="15" value="<?php echo $presentaddress;?>"></textarea>
			<br> <br>
			<label for="comment0">Permanent  Address</label>
			<textarea id="comment0" name="comment0" rows="3" cols="15" value="<?php echo $permanentaddress;?>">></textarea>
			<br><br>
			<label for="phone">Enter your phone number:</label>
			<input type="tel" id="phone" name="phone">
			<br><br>
			<label for="email">Email<span style="color: darkred;">*</span>: </label>
			<input type="email" id="email" name="email" >
			<span style="color: darkred"><?php echo $emailErr;?></span>
			<br><br>
			<a href="https://github.com" target="_blank">Personal Website</a>
		</fieldset>
		<fieldset>
			<legend> Account Information:</legend>
			<label for="uname">Username<span style="color: darkred;">*</span>:</label>
			<input type="text" id="uname" name="uname" >
			<span style="color: darkred"><?php echo $unameErr;?></span>
			
			<br><br>
			<label for="pass">Password<span style="color: darkred;">*</span>:</label>
			<input type="Password" id="pass" name="pass" >
			<span style="color: darkred"><?php echo $passErr;?></span>
			



		</fieldset>
		<br><br>
		<input type="Submit" name="submit" value="submit">

	</form>
	<span style="color:blue;"><?php echo $successfulMessage;?></span>
	<span style="color:darkred;"><?php echo $errorMessage ;?></span>
	<?php

	 

		function read()
		{
			$resource=fopen(filepath,"r");
			$fz=filesize(filepath);
			$fr="";
			if($fz>0)

			{
				$fr=fread($resource,$fz);
			}


			
			fclose($resource);
			return $fr;
		
		}
		?>
	
		
	</body>

	</html> 
 