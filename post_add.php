<?php
include_once 'class.php';
include_once 'dbConfig.php';

session_start();
$firstV = "visible";
$secondV = "hidden";
$thirdV = "hidden";
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
        $firstV = "hidden";
        $secondV = "visible";
    } elseif ($_POST["btnNext"] == "backToPageOne") {
        $firstV = "visible";
        $secondV = "hidden";
        $subCategory = null;
    } elseif ($_POST["btnNext"] == "submitPageTwo") {
        $firstV = "hidden";
        $secondV = "hidden";
        $thirdV = "visible";
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
        
        $target_dir = str_replace('\\', '/', __DIR__)."/images/";
        echo $target_dir;
        for ($i = 1; $i <= $temp; $i ++) {

            $uploadOK = 1;
            $imageFileType = strtolower(pathinfo($_FILES["image$i"]["name"], PATHINFO_EXTENSION));

            $check = getimagesize($_FILES["image$i"]["tmp_name"]);

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
            $p_id = PaymentLog::getID($con);
            $payment = new PaymentLog($adID, $money + ($extraPic * 0.5), date("Y-m-d"), $p_id, $_SESSION["User"]);
            $payment->create($con);
        }
    }
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
		<div style="visibility: <?php echo $firstV?>">
			<div class="input-group mb-3">
				<div class="input-group-prepend">
					<span class="input-group-text">Title</span>
				</div>
				<input type="text" class="form-control" name="title"
					value="<?php echo $title?>" />
			</div>

			<div class="input-group mb-3">
				<div class="input-group-prepend">
					<span class="input-group-text">Category</span>
				</div>
				<select class="custom-select" name="category">
					<option value="0" <?php if($category == 0){echo "selected";}?>>Please
						Select one category</option>
					<?php
    foreach (Category::readAll($con) as $item) {
        echo $item->toOptionE($category);
    }
    ?>
				</select>
			</div>


			<div class="input-group mb-3">
				<div class="input-group-prepend">
					<span class="input-group-text">Do you want to pay your ad</span>
				</div>
				<select class="custom-select" name="payment">
					<option value="0" <?php if($money == 0){echo "selected";}?>>Free</option>
					<option value="5" <?php if($money == 5){echo "selected";}?>>5 $</option>
					<option value="10" <?php if($money == 10){echo "selected";}?>>10 $</option>
					<option value="15" <?php if($money == 15){echo "selected";}?>>15 $</option>
				</select>
			</div>

			<div class="input-group mb-3">
				<div class="input-group-prepend">
					<span class="input-group-text">Do you want to get extra picture for
						0.5$? Only availeble for 15$ option</span>
				</div>
				<input name="extraPic" type="number" class="form-control"
					value="<?php echo $extraPic?>" />
			</div>

			<div class="btn-group">
				<button type="submit" class="btn btn-primary" name="btnNext"
					value="submitPageOne">Next</button>
				<button type="reset" class="btn btn-primary">Clear</button>
			</div>
		</div>
		<div style="visibility: <?php echo $secondV?>">
			<div class="input-group mb-3">
				<div class="input-group-prepend">
					<span class="input-group-text">Sub-Category</span>
				</div>
				<select class="custom-select" name="sub-category">
					<option value="<?php echo $subCategory?>">Please Select one
						sub-category</option>
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
		<p>Price will be <?php echo ($money + ($extraPic * 0.5))?></p>
			<div class="btn-group">
				<button type="submit" class="btn btn-primary" name="btnNext"
					value="submitPageTwo">Pay Now</button>
				<button type="submit" class="btn btn-primary" name="btnNext"
					value="backToPageOne">Back</button>
			</div>
		</div>
		<div style="visibility: <?php echo $thirdV?>">
			<div class="btn-group">
				<button type="button" class="btn btn-primary" onclick="location.href = 'index.php'">Back</button>
					</div>
		</div>
	</form>



</body>
</html>
