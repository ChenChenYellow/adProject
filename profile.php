<?php

session_start();
if(isset($_POST["btnLanguage"]) && $_POST["btnLanguage"] == "French"){
    $_SESSION["Language"] = "French";
}else{
    $_SESSION["Language"] = "English";
}
if (isset($_SESSION["Language"])) {
    if (isset($_POST["btnLanguage"])) {
        $_SESSION["Language"] = $_POST["btnLanguage"];
    }
} else {
    $_SESSION["Language"] = "English";
}
if($_SESSION["Language"] == "French"){
    $f = "Francais"; 
    $e = "Anglais";
    $home = "Acceuil";
    $pa = "Poster Ad";
}else{
    $f = "French";
    $e = "English";
    $home = "Home";
    $pa = "Post Ad";
}
?><html>
<head>
<link rel="stylesheet"
	href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
	integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
	crossorigin="anonymous">

</head>


<body>
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
		
		
	<div class="input-group mb-3">
	<form action="#" method="post">
		<div class="input-group-prepend">
			<span class="input-group-text">Username</span>

		</div>

		<span class="input-group-text"> <?php 
		echo $_SESSION["User"];?>
		</span>
	</div>
	
	<div class="row">
		<button class="col-xl-12 btn btn-primary" 
			data-toggle="collapse" data-target="#menu" type="button">MENU</button>
	</div>
	<div id="menu" class="collapse button-group row">
		<button class="btn btn-primary" onclick="location.href = 'index.php'" type="button"><?php echo $home;?></button>
		<button class="btn btn-primary" type="submit" value="French" name="btnLanguage"><?php echo $f;?></button>
		<button class="btn btn-primary" type="submit" value="English" name="btnLanguage"><?php echo $e;?></button>
		<button class="btn btn-primary" onclick="location.href = 'post_add.php'" type="button"><?php echo $pa;?></button>
	</div>
</form>


</body>
</html>