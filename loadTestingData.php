<?php

include_once 'dbConfig.php';
include_once 'class.php';

echo Picture::deleteAll($con);
echo Ad::deleteAll($con);
echo Category::deleteAll($con);
echo SubCategory::deleteAll($con);

echo "sadf";

$c_id = 1;
$sc_id = 1;

$cat = new Category($c_id, "Electronic", "Electronique");
$cat->create($con);

$subcat = new SubCategory($sc_id, "Phone", "Cellulaire", $c_id);
$subcat->create($con);
$sc_id++;
$subcat = new SubCategory($sc_id, "Pad", "Tablelette", $c_id);
$subcat->create($con);
$sc_id++;
$subcat = new SubCategory($sc_id, "Laptop", "Ordinateur Portable", $c_id);
$subcat->create($con);
$sc_id++;
$subcat = new SubCategory($sc_id, "Television", "Television", $c_id);
$subcat->create($con);
$sc_id++;
$c_id++;


$cat = new Category($c_id, "Pet", "Animaux");
$cat->create($con);

$subcat = new SubCategory($sc_id, "Cat", "Chat", $c_id);
$subcat->create($con);
$sc_id++;
$subcat = new SubCategory($sc_id, "Dog", "Chien", $c_id);
$subcat->create($con);
$sc_id++;
$subcat = new SubCategory($sc_id, "Monkey", "Singe", $c_id);
$subcat->create($con);
$sc_id++;
$subcat = new SubCategory($sc_id, "Squirrel", "Equirueil", $c_id);
$subcat->create($con);
$sc_id++;
$c_id++;


$cat = new Category($c_id, "Food", "Nourriture");
$cat->create($con);

$subcat = new SubCategory($sc_id, "Fast-Food", "Fast-Food", $c_id);
$subcat->create($con);
$sc_id++;
$subcat = new SubCategory($sc_id, "Meat", "Viande", $c_id);
$subcat->create($con);
$sc_id++;
$subcat = new SubCategory($sc_id, "Vegetable", "Vegetable", $c_id);
$subcat->create($con);
$sc_id++;
$subcat = new SubCategory($sc_id, "Fruit", "Fruit", $c_id);
$subcat->create($con);
$sc_id++;
$c_id++;

$cat = new Category($c_id, "Furniture", "Furniture");
$cat->create($con);

$subcat = new SubCategory($sc_id, "Table and Chair", "Table et chaise", $c_id);
$subcat->create($con);
$sc_id++;
$c_id++;



$ad_id = Ad::getID($con);
$ad = new Ad($ad_id, "IPhone", "New Iphone for sale", 1, 1, date("Y-m-d", strtotime("today")), date("Y-m-d", strtotime("+7 day")), true, "uu");
$ad->create($con);
$pic = new Picture($ad_id, "C:/xampp/htdocs/adProject/images/iphone.png");
$pic->create($con);
$ad_id++;
$ad = new Ad($ad_id, "Huawei P30", "New Huawei P30 for sale", 1, 1, date("Y-m-d", strtotime("today")), date("Y-m-d", strtotime("+7 day")), true, "uu");
$ad->create($con);
$pic = new Picture($ad_id, "C:/xampp/htdocs/adProject/images/huaweip30.jpg");
$pic->create($con);
$ad_id++;
$ad = new Ad($ad_id, "Samsung Galaxy S10", "New Iphone for sale", 1, 1, date("Y-m-d", strtotime("today")), date("Y-m-d", strtotime("+7 day")), true, "uu");
$ad->create($con);
$pic = new Picture($ad_id, "C:/xampp/htdocs/adProject/images/galaxys10.jpg");
$pic->create($con);
$ad_id++;
$ad = new Ad($ad_id, "Broccoli", "New Broccoli for sale", 3, 11, date("Y-m-d", strtotime("-5 day")), date("Y-m-d", strtotime("+2 day")), true, "uu");
$ad->create($con);
$pic = new Picture($ad_id, "C:/xampp/htdocs/adProject/images/broccoli.jpg");
$pic->create($con);
$ad_id++;
$ad = new Ad($ad_id, "Marijuana", "New Marijuana for sale", 3, 11, date("Y-m-d", strtotime("today")), date("Y-m-d", strtotime("+7 day")), true, "uu");
$ad->create($con);
$pic = new Picture($ad_id, "C:/xampp/htdocs/adProject/images/marijuana.jpg");
$pic->create($con);
$ad_id++;
$ad = new Ad($ad_id, "Cat", "New Cat for sale", 2, 5, date("Y-m-d", strtotime("-6 day")), date("Y-m-d", strtotime("+1 day")), true, "uu");
$ad->create($con);
$pic = new Picture($ad_id, "C:/xampp/htdocs/adProject/images/cat.jpg");
$pic->create($con);
$ad_id++;
$ad = new Ad($ad_id, "Cat 2", "New Cat 2 for sale", 2, 5, date("Y-m-d", strtotime("-3 day")), date("Y-m-d", strtotime("+4 day")), true, "uu");
$ad->create($con);
$pic = new Picture($ad_id, "C:/xampp/htdocs/adProject/images/cat2.jpg");
$pic->create($con);
$ad_id++;
$ad = new Ad($ad_id, "Cat 3", "New Cat 3 for sale", 2, 5, date("Y-m-d", strtotime("-4 day")), date("Y-m-d", strtotime("+3 day")), true, "uu");
$ad->create($con);
$pic = new Picture($ad_id, "C:/xampp/htdocs/adProject/images/cat3.jpg");
$pic->create($con);
$ad_id++;
$ad = new Ad($ad_id, "Chair", "New Chair for sale", 4, 13, date("Y-m-d", strtotime("-1 day")), date("Y-m-d", strtotime("+6 day")), true, "uu");
$ad->create($con);
$pic = new Picture($ad_id, "C:/xampp/htdocs/adProject/images/chair.jpg");
$pic->create($con);
$ad_id++;

$ad = new Ad($ad_id, "Laptop", "New Laptop for sale", 1, 3, date("Y-m-d", strtotime("today")), date("Y-m-d", strtotime("+1 month")), true, "uu");
$ad->create($con);
$pic = new Picture($ad_id, "C:/xampp/htdocs/adProject/images/laptop.jpg");
$pic->create($con);
$pic = new Picture($ad_id, "C:/xampp/htdocs/adProject/images/laptop2.jpg");
$pic->create($con);
$pic = new Picture($ad_id, "C:/xampp/htdocs/adProject/images/laptop3.jpg");
$pic->create($con);
$pic = new Picture($ad_id, "C:/xampp/htdocs/adProject/images/laptop4.jpg");
$pic->create($con);
$ad_id++;

$ad = new Ad($ad_id, "laptop cat", "New laptop cat for sale", 2, 5, date("Y-m-d", strtotime("-2 day")), date("Y-m-d", strtotime("+5 day")), true, "uu");
$ad->create($con);
$pic = new Picture($ad_id, "C:/xampp/htdocs/adProject/images/laptop_cat.jpg");
$pic->create($con);
$ad_id++;
$ad = new Ad($ad_id, "table", "New table for sale", 4, 13, date("Y-m-d", strtotime("today")), date("Y-m-d", strtotime("+7 day")), true, "uu");
$ad->create($con);
$pic = new Picture($ad_id, "C:/xampp/htdocs/adProject/images/table.jpg");
$pic->create($con);
$ad_id++;
?>