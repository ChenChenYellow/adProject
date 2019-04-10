<?php
include_once 'dbConfig.php';
include_once 'class.php';
session_start();

if (isset($_POST["btnNext"])) {
    $page_index = $_POST["btnNext"];
    if (isset($_SESSION["paid_ads"][$page_index + 5])) {
        $page_index = $page_index + 5;
    }
} elseif (isset($_POST["btnPrev"])) {
    $page_index = $_POST["btnPrev"];
    if ($page_index - 5 >= 0) {
        $page_index = $page_index - 5;
    }
} else {
    $_SESSION["paid_ads"] = Ad::readAllPaid($con);
    $_SESSION["categorys"] = Category::readAll($con);
    $page_index = 0;
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
			<button class="btn btn-primary" type="submit">Francais</button>
			<button class="btn btn-primary" type="submit">English</button>
			<button class="btn btn-primary"
				onclick="location.href = 'register.php'" type="button">Register</button>
			<button class="btn btn-primary"
				onclick="location.href = 'post_add.php'" type="button">Post Ad</button>
			<button class="btn btn-primary" onclick="location.href = 'login.php'"
				type="button">Log IN</button>
		</div>
		<br /> <br /> <br />

		<div id="ad-section1" class="row">
			<div class="col-sm-1">
				<button class="btn btn-primary" type="submit" name="btnPrev"
					value="<?php echo $page_index?>">prev</button>
			</div>
		<?php
for ($i = $page_index; $i < $page_index + 5; $i ++) {
    if (isset($_SESSION["paid_ads"][$i])) {
        echo "<div class='col-sm-2 paid-ad'>
            <a href='ad_page.php?selectedValue=" . $i . "&paid=paid_ads'><image width='100%' src='" . $_SESSION["paid_ads"][$i]->getArr_Url()[0] . "'/></a>
			<h5>" . $_SESSION["paid_ads"][$i]->getTitle() . "</h5>
		</div>";
    } else {
        echo "<div class='col-sm-1 paid-ad'>
		</div>";
    }
}
?>
		<div class="col-sm-1">
				<button class="btn btn-primary" type="submit" name="btnNext"
					value="<?php echo $page_index?>">next</button>
			</div>
		</div>

		<div id="search" class="input-group mb-3">
			<input type="text" class="form-control" placeholder="Search" />

			<div class="input-group-append">
				<button class="btn btn-success" type="submit">Go</button>
			</div>
		</div>

<?php
$temp = 0;
foreach ($_SESSION["categorys"] as $cat) {
    if ($temp == 0) {
        echo "<div class='row'>
			<div class='col-md-1'></div>";
    }
    echo "<div class='col-md-3'>";
    echo "<h3><a href='#'>" . $cat->getDesc_E() . "</a></h3>";
    foreach ($cat->getArrSubCat() as $subcat) {
        echo "<p><a href='#'>" . $subcat->getDesc_e() . "</a></p>";
    }
    echo "</div>";
    if ($temp == 2) {
        echo "<div class='col-md-1'></div></div>";
        $temp = 0;
    } else {
        $temp ++;
    }
}
?>
<!-- 
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-3">
				<h3>
					<a href="#">a0</a>
				</h3>
				<p>
					<a href="#">a1</a>
				</p>
				<p>
					<a href="#">a2</a>
				</p>
				<p>
					<a href="#">a3</a>
				</p>
				<p>
					<a href="#">a4</a>
				</p>
				<p>
					<a href="#">a5</a>
				</p>
			</div>
			<div class="col-md-3">
				<p>
					<a href="#">b1</a>
				</p>
				<p>
					<a href="#">b2</a>
				</p>
				<p>
					<a href="#">b3</a>
				</p>
				<p>
					<a href="#">b4</a>
				</p>
				<p>
					<a href="#">b5</a>
				</p>

			</div>
			<div class="col-md-3">
				<p>
					<a href="#">c1</a>
				</p>
				<p>
					<a href="#">c2</a>
				</p>
				<p>
					<a href="#">c3</a>
				</p>
				<p>
					<a href="#">c4</a>
				</p>
				<p>
					<a href="#">c5</a>
				</p>

			</div>
			<div class="col-md-2"></div>
		</div> -->
	</form>
</body>

</html>