<?php
include_once 'class.php';
include_once 'dbConfig.php';

session_start();
$paid = $_GET["paid"];

if (isset($_SESSION["Language"])) {
    $_SESSION["Language"] = "English";
}
if ($_SESSION["Language"] == "French") {
    $home = "Acceuil";
} else {
    $home = "Home";
}
?>

<html>
<head>

<link rel="stylesheet"
	href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
	integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
	crossorigin="anonymous">

<style type="text/css">
</style>
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

	<form action="#" method="get">

		<input name="paid" value="<?php echo $paid?>"
			style="visibility: hidden" />
		<div class="row">
			<p class="col-xl-12" style="text-align: center">Ad Website</p>
		</div>
		<div class="row">
			<button class="col-xl-12 btn btn-primary" data-toggle="collapse"
				type="button" data-target="#menu">MENU</button>
		</div>


		<div id="menu" class="collapse button-group row">
			<button type="button" class="btn btn-primary"
				onclick="location.href='index.php'"><?php echo $home;?></button>
		</div>

		<div class="float-left">
			<button class="btn btn-primary" type="submit" name="selectedValue"
				value="<?php
    if ($_GET["selectedValue"] == 0) {
        echo $_GET["selectedValue"];
    } else {
        echo ($_GET["selectedValue"] - 1);
    }
    ?>">Prev</button>
		</div>
		<div class="float-right">
			<button class="btn btn-primary" type="submit" name="selectedValue"
				value="<?php
    if (isset($_SESSION[$paid][$_GET["selectedValue"] + 1])) {
        echo ($_GET["selectedValue"] + 1);
    } else {
        echo $_GET["selectedValue"];
    }
    ?>">Next</button>

		</div>
		<div class="row">
<?php echo "<h5 class='col-12'>".$_SESSION[$paid][$_GET["selectedValue"]]->getTitle()."</h5>"?>
		
	</div>
		<div class="row">
	<?php echo "<p class='col-12'>".$_SESSION[$paid][$_GET["selectedValue"]]->getDescription()."</p>"?>
		
	</div>

		<div id="carou" class="carousel slide" data-ride="carousel"
			width='100%'>
			<ul class="carousel-indicators bg-dark">
		
		<?php
if ($_SESSION[$paid][$_GET["selectedValue"]]->getArr_Url() != null) {
    $active = "class='active'";
    $count = 0;
    foreach ($_SESSION[$paid][$_GET["selectedValue"]]->getArr_Url() as $item) {
        echo "<li data-target='#carou' data-slide-to='$count++' $active></li>";
        $active = "";
    }
}
?>
		<!-- 
			<li data-target="#carou" data-slide-to="0" class="active">
			<li>
			
			<li data-target="#carou" data-slide-to="1">
			<li>
			
			<li data-target="#carou" data-slide-to="2">
			<li>
		 -->
			</ul>

			<div class="carousel-inner">
		<?php
if ($_SESSION[$paid][$_GET["selectedValue"]]->getArr_Url() != null) {
    $active = "active";
    foreach ($_SESSION[$paid][$_GET["selectedValue"]]->getArr_Url() as $item) {
        echo "<div class='carousel-item $active'><img width='100%'  src='" . $item . "'></div>";
        $active = "";
    }
}
?>
		</div>

			<a class="carousel-control-prev bg-dark" href="#carou"
				data-slide="prev"><span class="carousel-control-prev-icon"></span></a>
			<a class="carousel-control-next bg-dark" href="#carou"
				data-slide="next"><span class="carousel-control-next-icon"></span></a>
		</div>




	</form>




</body>
</html>
