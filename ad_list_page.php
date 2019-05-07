<?php
include_once 'dbConfig.php';
include_once 'class.php';
session_start();

if (isset($_GET["paid"])) {
    $paid = $_GET["paid"];
}
if ($paid == "cat_ads") {
    $_SESSION[$paid] = Ad::getCategoryFromArr($con, $_SESSION["all_ads"], $_GET["cat_id"]);
} elseif ($paid == "subcat_ads") {
    $_SESSION[$paid] = Ad::getSubCategoryFromArr($con, $_SESSION["all_ads"], $_GET["subcat_id"]);
} elseif ($paid == "search_result") {}

if (isset($_SESSION["Language"])) {
    if (isset($_POST["btnLanguage"])) {
        $_SESSION["Language"] = $_POST["btnLanguage"];
    }
} else {
    $_SESSION["Language"] = "English";
}
if ($_SESSION["Language"] == "French") {
    $f = "Francais";
    $e = "Anglais";
    $home = "Acceuil";
} else {
    $f = "French";
    $e = "English";
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
.menuButton {
	
}
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

	<form action="#" method="post">
		<div class="row">
			<p class="col-xl-12" style="text-align: center">Ad Website</p>
		</div>
		<div class="row">
			<button class="col-xl-12 btn btn-primary" data-toggle="collapse"
				type="button" data-target="#menu">MENU</button>
		</div>

		<div id="menu" class="collapse button-group row">
			<button class="btn btn-primary" onclick="location.href = 'index.php'"
				type="button"><?php echo $home;?></button>
			<button class="btn btn-primary" type="submit" name="btnLanguage"
				value="French"><?php echo $f;?></button>
			<button class="btn btn-primary" type="submit" name="btnLanguage"
				value="English"><?php echo $e;?></button>
		</div>
		<br /> <br /> <br />
		<?php
if ($_SESSION[$paid] != null) {
    $count = 0;
    echo "<div class='list-group'>";
    foreach ($_SESSION[$paid] as $one) {
        echo "<a class='list-group-item list-group-item-action' href='ad_page.php?selectedValue=" . $count ++ . "&paid=$paid'><div><p5>" . $one->getTitle() . "<span class='float-right'>" . $one->getStartDate() . "</span></p5></div></a>";
    }
    echo "</div>";
} else {
    echo "<p>No Result</p>";
}
?>

	</form>
</body>
</html>
