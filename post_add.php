<?php
include_once 'class.php';
include_once 'dbConfig.php';

session_start();
$firstV = "";
$secondV = "display:none";
$thirdV = "display:none";
$errorMessage = "";
$title = $category = $money = $description = $subCategory = null;
$extraPic = 0;
if (isset($_POST["extraPic"])) {
    $extraPic = $_POST["extraPic"];
}
if (isset($_POST["title"])) {
    $title = $_POST["title"];
}
if (isset($_POST["category"])) {
    $category = $_POST["category"];
}
if (isset($_POST["payment"])) {
    $money = $_POST["payment"];
    if ($money <= 0) {
        $extraPic = 0;
        $_POST["extraPic"] = 0;
    }
}
if (isset($_POST["description"])) {
    $description = $_POST["description"];
}
if (isset($_POST["sub-category"])) {
    $subCategory = $_POST["sub-category"];
}
if (isset($_POST["btnNext"])) {
    if ($_POST["btnNext"] == "submitPageOne") {
        if ($_POST["category"] > 0 && $_POST["title"] != "") {
            $firstV = "display:none";
            $secondV = "";
        } else {
            $errorMessage = "Title cannot be empty neither can category";
        }
    } elseif ($_POST["btnNext"] == "backToPageOne") {
        $firstV = "";
        $secondV = "display:none";
        $subCategory = null;
    } elseif ($_POST["btnNext"] == "submitPageTwo") {
        if ($_POST["sub-category"] > 0 && $_POST["description"] != "") {
            $firstV = "display:none";
            $secondV = "display:none";
            $thirdV = "";
            $adID = Ad::getID($con) + 1;
            $paid = 1;
            if ($money == 0) {
                $temp = 0;
                $temptime = "+10 day";
                $paid = 0;
            } elseif ($money == 5) {
                $temp = 1;
                $temptime = "+1 week";
            } elseif ($money == 10) {
                $temp = 5;
                $temptime = "+2 week";
            } elseif ($money == 15) {
                $temp = 10 + $extraPic;
                $temptime = "+1 month";
            }

            $ad = new Ad($adID, $title, $description, $category, $subCategory, date("Y-m-d"), date("Y-m-d", strtotime($temptime)), $paid, $_SESSION["User"]);
            $ad->create($con);

            $target_dir = str_replace('\\', '/', __DIR__) . "/images/";
            for ($i = 1; $i <= $temp; $i ++) {
                $imageFileType = strtolower(pathinfo($_FILES["image$i"]["name"], PATHINFO_EXTENSION));
                $target_file = $target_dir . basename($_FILES["image$i"]["tmp_name"], ".tmp") . "." . $imageFileType;

                if (move_uploaded_file($_FILES["image$i"]["tmp_name"], $target_file)) {
                    echo "The file " . basename($_FILES["image$i"]["name"]) . " has been uploaded.";
                    $tempPic = new Picture($adID, $target_file);
                    $tempPic->create($con);
                } else {
                    echo "ERROR";
                }
            }
            if ($money > 0) {
                $discount = new Discount($_SESSION["User"]);
                $discount = $discount->find($con);
                if ($discount != null) {
                    echo "asdfasdf";
                    $percentage = $discount->getPercentage();
                    echo ($money + ($extraPic * 0.5)) * (100 - $percentage) / 100;
                    $p_id = PaymentLog::getID($con);
                    $payment = new PaymentLog($adID, ($money + ($extraPic * 0.5)) * (100 - $percentage) / 100, date("Y-m-d"), $p_id, $_SESSION["User"]);
                    echo $payment;
                    $payment->create($con);

                    $discount->delete($con);
                } else {
                    $p_id = PaymentLog::getID($con);
                    $payment = new PaymentLog($adID, $money + ($extraPic * 0.5), date("Y-m-d"), $p_id, $_SESSION["User"]);
                    $payment->create($con);
                }
            }
        } else {
            $firstV = "display:none";
            $secondV = "";
            $errorMessage = "Sub Category cannot be empty, neither can Description";
        }
    }
}

if (! isset($_SESSION["Language"])) {
    $_SESSION["Language"] = "English";
}
if ($_SESSION["Language"] == "French") {
    $t = "Titre";
    $c = "Categorie";
    $doYouPay = "Voulez Vous Payer Votre Ad?";
    $doYouPayExtra = "Extra Photo Pour 0.5$? Seulement Pour l'option de 15$";
    $sc = "Sub-Categorie";
    $next = "Suivant";
    $clear = "Vider";
    $back = "Retour";
    $payNow = "Payer Maintenant";
    $free = "Gratuit";
} else {
    $t = "Title";
    $c = "Category";
    $doYouPay = "Do You Want To Pay Your Ad";
    $doYouPayExtra = "Extra Picture For 0.5$? Only Available For 15$ Option";
    $sc = "Sub-Category";
    $next = "Next";
    $clear = "Clear";
    $back = "Back";
    $payNow = "Pay Now";
    $free = "Free";
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
	<form action="#" method="post" enctype="multipart/form-data">
		<div style="<?php echo $firstV?>">
			<div class="input-group mb-3">
				<div class="input-group-prepend">
					<span class="input-group-text"><?php echo $t;?></span>
				</div>
				<input type="text" class="form-control" name="title"
					value="<?php echo $title?>" />
			</div>

			<div class="input-group mb-3">
				<div class="input-group-prepend">
					<span class="input-group-text"><?php echo $c;?></span>
				</div>
				<select class="custom-select" name="category">
					<option value="0" <?php if($category == 0){echo "selected";}?>>Please
						Select one category</option>
					<?php
    if ($_SESSION["Language"] == "French") {
        foreach (Category::readAll($con) as $item) {
            echo $item->toOptionF($category);
        }
    } else {
        foreach (Category::readAll($con) as $item) {
            echo $item->toOptionE($category);
        }
    }
    ?>
				</select>
			</div>


			<div class="input-group mb-3">
				<div class="input-group-prepend">
					<span class="input-group-text"><?php echo $doYouPay;?></span>
				</div>
				<select class="custom-select" name="payment">
					<option value="0" <?php if($money == 0){echo "selected";}?>><?php echo $free;?></option>
					<option value="5" <?php if($money == 5){echo "selected";}?>>5 $</option>
					<option value="10" <?php if($money == 10){echo "selected";}?>>10 $</option>
					<option value="15" <?php if($money == 15){echo "selected";}?>>15 $</option>
				</select>
			</div>

			<div class="input-group mb-3">
				<div class="input-group-prepend">
					<span class="input-group-text"><?php echo $doYouPayExtra;?></span>
				</div>
				<input name="extraPic" type="number" class="form-control"
					value="<?php echo $extraPic?>" />
			</div>

			<div class="btn-group">
				<button type="submit" class="btn btn-primary" name="btnNext"
					value="submitPageOne"><?php echo $next;?></button>
				<button type="reset" class="btn btn-primary"><?php echo $clear;?></button>
			</div>
		</div>
		<div style="<?php echo $secondV?>">
			<div class="input-group mb-3">
				<div class="input-group-prepend">
					<span class="input-group-text">Sub-Category</span>
				</div>
				<select class="custom-select" name="sub-category">
					<option value="<?php echo $subCategory?>"><?php echo $sc;?></option>
					<?php
    foreach (SubCategory::readAll($con) as $item) {
        echo $item->toOptionE($category);
    }
    ?>
				</select>
			</div>
			<p>Description</p>
			<textarea name='description' class="form-control" cols="60" rows="6"><?php echo $description;?></textarea>
		
<?php

if ($money == 0) {} elseif ($money == 5) {
    echo "<div class='input-group mb-3'>
				<div class='input-group-prepend'>
					<span class='input-group-text'>Image 1</span>
				</div><input type='file' name='image1' class='form-control'/></div>";
} elseif ($money == 10) {
    for ($i = 1; $i <= 5; $i ++) {
        echo "<div class='input-group mb-3'>
				<div class='input-group-prepend'>
					<span class='input-group-text'>Image $i</span>
				</div><input type='file' name='image$i' class='form-control'/></div>";
    }
} elseif ($money == 15) {
    for ($i = 1; $i <= 10 + $extraPic; $i ++) {
        echo "<div class='input-group mb-3'>
				<div class='input-group-prepend'>
					<span class='input-group-text'>Image $i</span>
				</div><input type='file' name='image$i' class='form-control'/></div>";
    }
}
?>
<?php
if ($_SESSION["Language"] == "French") {
    $priceWillBe = "Prix va etre ";
    $youHaveDiscount = "Vous avez un Rabais, ";
    $save = "Economisez ";
} else {
    $priceWillBe = "Price will be ";
    $youHaveDiscount = "You have Discount, ";
    $save = "Save ";
}
echo "<p>$priceWillBe" . ($money + ($extraPic * 0.5)) . " $</p>";
if ($money != 0) {
    $discount = new Discount($_SESSION["User"]);
    $discount = $discount->find($con);
    if ($discount != null) {
        echo "<p>$youHaveDiscount" . $discount->getPercentage() . "%</p>";
        echo "<p>$save" . ($discount->getPercentage() * ($money + ($extraPic * 0.5)) / 100) . "$</p>";
        echo "<p>$priceWillBe" . ((100 - $discount->getPercentage()) * ($money + ($extraPic * 0.5)) / 100) . "$</p>";
    }
}
?>
			<div class="btn-group">
				<button type="submit" class="btn btn-primary" name="btnNext"
					value="submitPageTwo"><?php echo $payNow;?></button>
				<button type="submit" class="btn btn-primary" name="btnNext"
					value="backToPageOne"><?php echo $back;?></button>
			</div>
		</div>
		<div style="<?php echo $thirdV?>">
			<div class="btn-group">
				<button type="button" class="btn btn-primary"
					onclick="location.href = 'index.php'"><?php echo $back;?></button>
			</div>
		</div>
		<p><?php if(isset($errorMessage)){echo $errorMessage;}?></p>
	</form>



</body>
</html>
