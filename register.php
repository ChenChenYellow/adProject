<?php
require_once 'dbConfig.php';
require_once 'class.php';
session_start();
$message = "";
$username = $password = $re_password = $true_name = $address = $city = $state = $phone = "";
if (isset($_POST["btnSubmit"]) && $_POST["btnSubmit"] == "submit") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $re_password = $_POST["re_password"];
    $true_name = $_POST["true_name"];
    $address = $_POST["address"];
    $city = $_POST["city"];
    $state = $_POST["state"];
    $phone = $_POST["phone"];
    echo "Submit";
    if ($_POST["password"] == $_POST["re_password"]) {
        $user = new User($username, $password, $true_name, $address, $city, $state, $phone, "NON-MEMBER");
        if ($user->find($con) == null) {
            $user->create($con);
            $message = "User create Success, click BACK to go to home page";
        } else {
            $message = "Username Exist";
        }
    } else {
        $message = "Please check Password ";
    }
}
if (!isset($_SESSION["Language"])) {
    $_SESSION["Language"] = "English";
}
if ($_SESSION["Language"] == "French") {
    $u = "Nom d'utilisateur";
    $p = "Mot de passe";
    $rp = "Re-Enterer Mot de passe";
    $c = "Ville";
    $s = "Etat";
    $sub = "Soumettre";
    $clear = "Vider";
    $back = "Retour";
    $pn = "Numero de Telephone";
    $n = "Nom";
} else {
    $u = "Username";
    $p = "Password";
    $rp = "Retype Password";
    $c = "City";
    $s = "State";
    $sub = "Submit";
    $clear = "Clear";
    $back = "Back";
    $pn = "Phone Number";
    $n = "Name";
}
?>

<html>
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




	<form action="#" method="post">
		<div class="input-group mb-3">
			<div class="input-group-prepend">
				<span class="input-group-text"><?php echo $u;?></span>

			</div>

			<input type="text" class="form-control" name="username"
				value="<?php echo $username?>" />
		</div>

		<div class="input-group mb-3">
			<div class="input-group-prepend">
				<span class="input-group-text"><?php echo $p;?></span>

			</div>
			<input type="password" class="form-control" name="password"
				value="<?php echo $password?>" />
		</div>

		<div class="input-group mb-3">
			<div class="input-group-prepend">
				<span class="input-group-text"><?php echo $rp;?></span>

			</div>
			<input type="password" class="form-control" name="re_password"
				value="<?php echo $re_password?>" />
		</div>

		<div class="input-group mb-3">
			<div class="input-group-prepend">
				<span class="input-group-text"><?php echo $n;?></span>

			</div>
			<input type="text" class="form-control" name="true_name"
				value="<?php echo $true_name?>" />

		</div>

		<div class="input-group mb-3">
			<div class="input-group-prepend">
				<span class="input-group-text">Address</span>

			</div>
			<input type="text" class="form-control" name="address"
				value="<?php echo $address?>" />

		</div>

		<div class="input-group mb-3">
			<div class="input-group-prepend">
				<span class="input-group-text"><?php echo $c;?></span>

			</div>
			<input type="text" class="form-control" name="city"
				value="<?php echo $city?>" />

		</div>

		<div class="input-group mb-3">
			<div class="input-group-prepend">
				<span class="input-group-text"><?php echo $s;?></span>

			</div>
			<input type="text" class="form-control" name="state"
				value="<?php echo $state?>" />

		</div>

		<div class="input-group mb-3">
			<div class="input-group-prepend">
				<span class="input-group-text"><?php echo $pn;?></span>

			</div>
			<input type="text" class="form-control" name="phone"
				value="<?php echo $phone?>" />
		</div>
		<div class="btn-group">
			<button type="submit" class="btn btn-primary" name="btnSubmit"
				value="submit"><?php echo $sub;?></button>
			<button type="reset" class="btn btn-primary"><?php echo $clear;?></button>
			<button type="button" class="btn btn-info"
				onclick="location.href = 'index.php'"><?php echo $back;?></button>
		</div>
		<p><?php echo $message?></p>

	</form>



</body>
</html>
