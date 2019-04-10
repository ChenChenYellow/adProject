<?php
session_start();
require_once 'dbConfig.php';
require_once 'class.php';
if(isset($_POST["btnLogin"]) && $_POST["btnLogin"] == "Login"){
    $user = new User($_POST["username"], $_POST["password"]);
    $temp = $user->find($con);
    echo $temp;
    if($temp == null){
        $_SESSION["Login"] = "Failed to Login";
    }else{
        $_SESSION["Login"] = null;
        $_SESSION["User"] = $user->__toString();
        header("location:profile.php");
    }
}




?>
<html>
<head>
<link rel="stylesheet"
	href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
	integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
	crossorigin="anonymous">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
		integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
		crossorigin="anonymous"></script>
	<script
		src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
		integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
		crossorigin="anonymous"></script>
	<script
		src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
		integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
		crossorigin="anonymous"></script>
		</head>


<body>
	<form method="post" action="#">
	<!-- <form action="logining.php" method="post"> -->
		<div class="input-group mb-3">
			<div class="input-group-prepend">
				<span class="input-group-text">Username</span>

			</div>

			<input type="text" class="form-control" name="username" />
		</div>

		<div class="input-group mb-3">
			<div class="input-group-prepend">
				<span class="input-group-text">Password</span>

			</div>
			<input type="password" class="form-control" name="password" />
		</div>
		
		<div class="btn-group">
			<button type="submit" class="btn btn-primary" name="btnLogin" id="btnLogin" value="Login">Login</button>
			<button type="reset" class="btn btn-primary">Clear</button>
			<button type="button" class="btn btn-info" onclick="location.href = 'index.php'">Back</button>
		</div>
		<p id="ptext" name="ptext"><?php echo $_SESSION["Login"]; $_SESSION["Login"] = null?></p>
	</form>



</body>
</html>