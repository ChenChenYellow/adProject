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
    $_SESSION["all_ads"] = Ad::readAll($con);
    $_SESSION["paid_ads"] = Ad::getPaidFromArr($con, $_SESSION["all_ads"], 1);
    $_SESSION["categorys"] = Category::readAll($con);
    $page_index = 0;
}
if (isset($_POST["btnSearch"]) && $_POST["btnSearch"] == "search") {
    $_SESSION["search_result"] = Ad::searchFor($_SESSION["all_ads"], $_POST["txtSearch"]);
    header("Location:ad_list_page.php?id=0&paid=search_result");
}
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
    $reg = "Enregistrer";
    $go = "Chercher";
    $login = "Connecter";
    $search = "Cherche";
} else {
    $f = "French";
    $e = "English";
    $reg = "Register";
    $go = "Go";
    $login = "Login";
    $search = "Search";
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
			<button class="btn btn-primary" type="submit" name="btnLanguage"
				value="French"><?php echo $f;?></button>
			<button class="btn btn-primary" type="submit" name="btnLanguage"
				value="English"><?php echo $e;?></button>
			<button class="btn btn-primary"
				onclick="location.href = 'register.php'" type="button"><?php echo $reg;?></button>
			<button class="btn btn-primary" onclick="location.href = 'login.php'"
				type="button"><?php echo $login;?></button>
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
			<input type="text" class="form-control"
				placeholder="<?php echo $search;?>" name="txtSearch" />

			<div class="input-group-append">
				<button class="btn btn-success" type="sumbit" value="search"
					name="btnSearch"><?php echo $go;?></button>
			</div>
		</div>

<?php
$temp = 0;
if ($_SESSION["Language"] == "French") {
    foreach ($_SESSION["categorys"] as $cat) {
        if ($temp == 0) {
            echo "<div class='row'>
			<div class='col-md-1'></div>";
        }
        echo "<div class='col-md-3'>";
        echo "<h3><a href='ad_list_page.php?cat_id=" . $cat->getCat_ID() . "&paid=cat_ads'>" . $cat->getDesc_F() . "</a></h3>";
        foreach ($cat->getArrSubCat() as $subcat) {
            echo "<p><a href='ad_list_page.php?subcat_id=" . $subcat->getSubCat_ID() . "&paid=subcat_ads'>" . $subcat->getDesc_f() . "</a></p>";
        }
        echo "</div>";
        if ($temp == 2) {
            echo "<div class='col-md-1'></div></div>";
            $temp = 0;
        } else {
            $temp ++;
        }
    }
} else {
    foreach ($_SESSION["categorys"] as $cat) {
        if ($temp == 0) {
            echo "<div class='row'>
			<div class='col-md-1'></div>";
        }
        echo "<div class='col-md-3'>";
        echo "<h3><a href='ad_list_page.php?cat_id=" . $cat->getCat_ID() . "&paid=cat_ads'>" . $cat->getDesc_E() . "</a></h3>";
        foreach ($cat->getArrSubCat() as $subcat) {
            echo "<p><a href='ad_list_page.php?subcat_id=" . $subcat->getSubCat_ID() . "&paid=subcat_ads'>" . $subcat->getDesc_e() . "</a></p>";
        }
        echo "</div>";
        if ($temp == 2) {
            echo "<div class='col-md-1'></div></div>";
            $temp = 0;
        } else {
            $temp ++;
        }
    }
}
?>
	</form>
</body>

</html>