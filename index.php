<!DOCTYPE html>
<html>
 <head>
 	<meta charset="utf-8">
 	<title>VTOBETA LOGIN</title>

 	<style>
body
{
	background:url(login_background4.jpg);
	margin:0;
	padding:0;
	background-size: cover;
	background-repeat: no-repeat;
}
.logo
{
	margin-left: 250px;
	margin-top: 220px;
	z-index: 1;
	height:300px;
	width:450px;
}

.login,.signup
{
	position: absolute;
	top:50%;
	left: 75%;
	transform:translate(-50%,-50%);
	width:350px;
	height:430px;
	padding: 80px 40px;
	box-sizing: border-box;
	background: rgba(0,0,0,.5);
}
.signup
{
	height:490px;
}

.user
{
	width: 100px;
	height:100px;
	border-radius: 50%;
	overflow: hidden;
	position:absolute;
	top:calc(-100px/2);/* "-" means shift top and + means shift down*/
	left: calc(50% - 50px)

}

h2
{
	margin: 0;
	padding: 0 0 20px;
	text-align: center;
	color: #ffffff;
}

.login p,.signup p
{
	margin: 0;
	padding: 0;
	font-weight: bold;
	font-family: serif;
	color: #ffffff;
}

.login input[type="username"],.signup input[type="username"]
{
	border: none;
	border-bottom: 1px solid #fff;
	background: transparent;
	outline: none;
	height: 40px;
	color: #ffffff;
	font-size: 16px;
	width: 100%;
	margin-bottom:20px;
}
.login input[type="password"],.signup input[type="password"]
{
	border: none;
	border-bottom: 1px solid #fff;
	background: transparent;
	outline: none;
	height: 40px;
	color: #ffffff;
	font-size: 16px;
	width: 100%;
	margin-bottom:20px;
}

::placeholder
{
	color: rgba(255,255,255,0.5);
}

.login button[type="submit"],.signup button[type="submit"]
{
	border: none;
	outline: none;
	height: 40px;
	color: #fff;
	font-size: 16px;
	background:#6A5ACD;
	cursor:pointer;
	border-radius: 20px;
	width: 100%;
	margin-bottom:20px;

}
.login button[type="submit"]:hover,.signup button[type="submit"]:hover
{
	background:#ffffff;
	color: #6A5ACD;
	font-size: 18px;
	font-weight: bold;
	text-decoration: none;
}
a
{
	color:white;
}
.login a[type="text"]:hover,.signup a[type="text"]:hover
{
	cursor:pointer;
	color:#fff;
}


 </style>
 </head>
 

 <body>
 	<?php 
   $a=array();
   $errorMessage="";

   function check($reg,$password)
   {
   	if(preg_match("/^[1][4-7][a-zA-Z]{3}[0-9]{4}$/", $reg))
  		{
  			if(preg_match("/[a-z]+[A-Z]+[0-9]+{8,}/", $password))
  				return true;
  			else
  			{
  			global $errorMessage;
  			$errorMessage= "Password must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters";
  			return false;  		
  		     }
  	    }
  	else
  	{
  		global $errorMessage;
  		$errorMessage= "Invalid Username";
  		return false;
  	}
   }

   function signup()
   {
  if($_SERVER["REQUEST_METHOD"=="POST"])
  {
  	$c=0;
  	$flag=false;
  	$regno=$_POST["reg"];
  	$password=$_POST["pass"];
  	$conf=$_POST["pass2"];
  	global $a;
  	if($conf==$password)
  	{
  		foreach($a as $key=>$value)
  	    {
  		if(strcasecmp($regno,$key)==0)
  			if(strcmp($password,$value)==0)
  			{
  				$c=1;
  				global $errorMessage;
  				$errorMessage= "You have already registered";
  				break;
  			}
  		}
  		if($c==0)
  		{
  		$flag=check($regno,$password);
  		if($flag)
  		{
  			global $a;
  			$a[$regno]=$password;
  			global $errorMessage;
  			$errorMessage= "You have succesfully registered.";
  		}
    }
    else
    {
    	global $errorMessage;
    	$errorMessage= "Passwords do not match";
    }
}
 }
}

 function login()
 {
  if($_SERVER["REQUEST_METHOD"=="GET"])
  {
  	$c=0;
    $regno=$_POST["username"];
  	$password=$_POST["password"];	
  	global $a;
  	foreach($a as $key=>$value)
  	{
  		if(strcasecmp($regno,$key)==0)
  			if(strcmp($password,$value)==0)
  			{
  				$c=1;
  				header('Location:Home.html');
  			}
  		global $errorMessage;
  		$errorMessage= "Incorrect username ans password";
  	}
  	if($c==0)
  	{
  		global $errorMessage;
  		$errorMessage= "Account does not exist";
  	}
  }
}

?>
 	<img src="logo.png" class="logo">
 	<div class="signup">
 		<img src="2.jpg" class="user">
 		<h2><font face="comic sans">SIGN-UP Here</font></h2>
 		<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
 			<p>Username*</p>
 			<input type="username" name="reg" placeholder="Username" pattern="^[1][4-7][a-zA-Z]{3}[0-9]{4}$" title="Example:17BME0753" required>
 			<p>Password*</p>
 			<input type="password" name="pass" placeholder="*********" pattern="[a-z]+[A-Z]+[0-9]+{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
 			<p>Confirm Password*</p>
 			<input type="password" name="pass2" placeholder="*********">
 			<button type="submit" onclick="<?php signup();?>">Sign Up</button>
 			<p href="#"><font color="white"><a type="text" onclick="transfer('none','block')">Login Here</a></font></p>
 			<div color="red"><?php echo $errorMessage;?></div>
 		</form>
 	</div>

 	<div class="login">
 		<img src="2.jpg" class="user">
 		<h2><font face="comic sans">Login Here</font></h2>
 		<form method="get" action="<?php echo $_SERVER['PHP_SELF'];?>">
 			<p>Username*</p>
 			<input type="username" name="username" placeholder="Username" pattern="^[1-9][0-9][a-zA-Z]{3}[0-9]{4}$" title="Example:17BME0753" required>
 			<p>Password*</p>
 			<input type="password" name="password" placeholder="*********" pattern="[a-z]+[A-Z]+[0-9]+{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
 			<button type="submit" onclick="<?php login();?>">Sign In</button>
 			<p href="#"><font color="white"><a type="text" onclick="transfer('block','none')">Sign Up Here</a></font></p>
 			<div color="red"><?php echo $errorMessage; ?></div>
 		</form>
 		</div>
 	
<script>
var content=document.getElementsByClassName("login");
    for (var i=0;i<content.length; i++) 
    {
        content[i].style.display="none";
    }
function transfer(x,y)
{
	var box1=document.getElementsByClassName("signup");
    for (var i=0;i<content.length; i++) 
    {
        box1[i].style.display=x;
    }
    var box2=document.getElementsByClassName("login");
    for (var i=0;i<content.length; i++) 
    {
        content[i].style.display=y;
    }
}
</script>


 </body>
</html>