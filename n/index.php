<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Index</title>
	<link  rel="stylesheet" href="css/bootstrap.min.css"/>
 	<link  rel="stylesheet" href="css/bootstrap.rtl.min.css"/>    
 	<!-- <link rel="stylesheet" href="css/main.css">
 	<link  rel="stylesheet" href="css/font.css"> -->
 	<script src="js/jquery-3.5.1.min.js" type="text/javascript"></script>
 	<script src="js/bootstrap.bundle.min.js"  type="text/javascript"></script>
 	<style type="text/css">
 		.modal-header {
   
    justify-content: center;
}
		body .modal{
			text-align: -webkit-center;
		}
		textarea,input{
			margin: 4% 0;
		}
 	</style>
</head>
<!-- <?php
include_once 'dbConnection.php';
include_once 'cookie.php';
?> -->

	<script>
function validateForm() {var y = document.forms["form"]["name"].value;  var letters = /^[A-Za-z]+$/;if (y == null || y == "") {alert("Name must be filled out.");return false;}var x = document.forms["form"]["email"].value;var atpos = x.indexOf("@");
var dotpos = x.lastIndexOf(".");if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length) {alert("Not a valid e-mail address.");return false;}var a = document.forms["form"]["pass"].value;if(a == null || a == ""){alert("Password must be filled out");return false;}if(a.length<5 || a.length>25){alert("Password is too short! Length should be greater than 5!");return false;}
var m = document.forms["form"]["mob"].value;if(m.length<9||m.length>12){alert("Enter Valid length Mobile Number!");return false;}
var b = document.forms["form"]["pass2"].value;if (a!=b){alert("Passwords must match.");return false;}
var r = document.forms["form"]["role"].value;if(r==null || r == ""){alert("Role must be Selected");return false;}}

</script>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
	 <div class="container-fluid">
	    <a class="navbar-brand" href="#">Project</a>
	    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
	      <span class="navbar-toggler-icon"></span>
	    </button>
	    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
	      <ul class="navbar-nav ">
	        <li class="nav-item">
	          <a class="nav-link active" aria-current="page" data-bs-toggle="modal" data-bs-target="#signup" href="#signup">Signup</a>
	        </li>
	        <li class="nav-item">
	          <a class="nav-link" href="#feed" data-bs-toggle="modal" data-bs-target="#feed">Feedback</a>
	        </li>
	        <li class="nav-item">
	          <a class="nav-link" href="#login" data-bs-toggle="modal" data-bs-target="#login">Login</a>
	        </li>
	      </ul>
	    </div>
	  </div>
</nav>
<div class="modal fade"   id="login">
  	<div class="modal-dialog modal-dialog-centered">
	    <div class="modal-content">
	      	<div class="modal-header">
	        	<h4 class="modal-title" ><span  style="color:#f4511e;font-family:Montserrat, sans-serif; font-size: 20px !important;letter-spacing: 4px;"><b>LOGIN</b></span></h4>
	     	</div>
			<div class="modal-body title1" >
				<div class="col-md-9">
					<form role="form" method="post" action="login.php?q=index.php">
						<div class="form-group">
							<input type="text" name="email" maxlength="20"  placeholder="Email Id" class="form-control"/> 
						</div>
						
						<div class="form-group">
							<input type="password" name="password" maxlength="15" placeholder="Password" class="form-control"/>
						</div>
						
						<div class="form-group">
							<input type="checkbox" name="remb" placeholder="Remember Me"  />
							<span>Remember Me</span>
						</div>
						
						<div class="form-group" align="center">
							<input type="submit" name="login" value="Login" class="btn btn-primary" />
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>



<div class="modal fade "   id="feed">
  <div class="modal-dialog modal-dialog-centered">
	    <div class="modal-content">
	      	<div class="modal-header">
	        	<h4 class="modal-title" ><span  style="color:#f4511e;font-family:Montserrat, sans-serif; font-size: 20px !important;letter-spacing: 4px;"><b>FEEDBACK</b></span></h4>
	     	</div>
			<div class="modal-body title1" >
				<div class="col-md-9">
					<form role="form" method="post"   action="update.php">
						<div class="form-group">
							<input type="text" name="name" placeholder="Full Name" required="required" class="form-control"/> 
						</div>
						
						<div class="form-group">
							<input type="email" name="email" placeholder="Email ID" required="required" class="form-control"/>
						</div>
						
						<div class="form-group">
							<input type="text" name="sub" placeholder="Subject" required="required" class="form-control" />
						</div>
						
						<div class="form-group">
							<!-- <input type="textbox" name="feed"  required="required" class="form-control" /> -->
							<textarea class="form-control" name="feed" placeholder="Feedback" required></textarea>
						</div>
						
						<div class="form-group" align="center">
							<input type="submit" name="button12" value="Submit" class="btn btn-primary" />
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade "   id="signup">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
	    <div class="modal-content">
	      	<div class="modal-header">
	        	<h4 class="modal-title" ><span  style="color:#f4511e;font-family:Montserrat, sans-serif; font-size: 20px !important;letter-spacing: 4px;"><b>SIGN UP</b></span></h4>
	     	</div>
			<div class="modal-body title1" >
				<div class="col-md-9">
					<form role="form" name="form" onSubmit="return validateForm()" action="update.php" method="post">
						<div class="form-group">
							<input type="text" name="name" placeholder="Full Name"  class="form-control"/> 
						</div>
						
						<div class="form-group">
							<input type="email" name="email" placeholder="Email ID"  class="form-control"/>
						</div>
						
						<div class="form-group">
							<input type="number" name="mob"  placeholder="Mobile Number"  class="form-control" />
						</div>
						
						<div class="form-group">
							<input type="password" name="pass" placeholder="Enter Suitable Password" class="form-control" >
						</div>
						
						<div class="form-group">
							<input type="password" name="pass2" placeholder="Confirm Password" class="form-control" >
						</div>
						<span>Role : </span>
						<div class="form-check-inline" >
							<input type="radio" name="role" value="Teacher" id="tchrradio" class="form-check-input" >
							<label class="form-check-label" for="tchrradio">Teacher</label>
						</div>
						<div class="form-check-inline">
							<input type="radio" name="role" value="Student" id="stdradio" class="form-check-input" >
							<label class="form-check-label" for="stdradio">Student</label>
						</div>
						<br>
						<div class="form-group" align="center">
							<input type="submit" name="button11" value="Submit" class="btn btn-primary" />
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- 
<form method="POST" name="form" onSubmit="return validateForm()" action="update.php">
	<input type="text" name="name" placeholder="Full Name" />
	<input type="email" name="email" placeholder="Email ID" />
	<input type="number" name="mob"  placeholder="Mobile Number" />
	<input type="password" name="pass" placeholder="Enter Suitable Password" />
	<input type="password" name="pass2" placeholder="Confirm Password" />
	<input type="radio" name="role" value="Teacher" placeholder="Teacher" />Teacher
	<input type="radio" name="role" value="Student" placeholder="Student" />Student
	<button type= "submit" name="button11" value="1">Submit</button>
</form>


 -->
</body>


</html>





