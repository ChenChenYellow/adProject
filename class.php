<?php

class Category
{

    private static $idCounter;

    private $id, $desc_e, $desc_f;

    private $arr_sub_cat;

    public function getArrSubCat()
    {
        return $this->arr_sub_cat;
    }

    public function __construct($id = null, $desc_e = null, $desc_f = null)
    {
        $this->id = $id;
        $this->desc_e = $desc_e;
        $this->desc_f = $desc_f;
    }

    public function create($connection)
    {
        $sql = "insert into category(cat_id, desc_e, desc_f) values($this->id, '$this->desc_e', '$this->desc_f')";
        $connection->exec($sql);
    }

    public static function readAll($connection)
    {
        $sql = "select * from category";
        $counter = 0;
        $arr;
        foreach ($connection->query($sql) as $one) {
            $temp = new Category($one["cat_id"], $one["desc_e"], $one["desc_f"]);
            $sub_counter = 0;
            $subSQL = "select * from sub_category where cat_id = " . $one["cat_id"];
            foreach ($connection->query($subSQL) as $subOne) {
                $temp->arr_sub_cat[$sub_counter ++] = new SubCategory($subOne["subcat_id"], $subOne["desc_e"], $subOne["desc_f"], $subOne["cat_id"]);
            }
            $arr[$counter ++] = $temp;
        }
        return $arr;
    }

    public function update($connection)
    {
        $sql = "update category set desc_e = '$this->desc_e', desc_f = '$this->desc_f' where cat_id = $this->id";
        return $connection->exec($sql);
    }

    public function delete($connection)
    {
        $sql = "delete from category where cat_id =$this->id";
        return $connection->exec($sql);
    }

    public function find($connection)
    {
        $sql = "select * from category where cat_id = $this->id";
        foreach ($connection->query($sql) as $one) {
            $ret = new Category($one["cat_id"], $one["desc_e"], $one["desc_f"]);
            break;
        }
        return $ret;
    }

    public function toOptionF($cat)
    {
        if ($cat == $this->id) {
            return "<option value=\"$this->id\" selected>$this->desc_f</option>";
        } else {
            return "<option value=\"$this->id\">$this->desc_f</option>";
        }
    }

    public function toOptionE($cat)
    {
        if ($cat == $this->id) {
            return "<option value=\"$this->id\" selected>$this->desc_e</option>";
        } else {
            return "<option value=\"$this->id\">$this->desc_e</option>";
        }
    }

    public static function deleteAll($connection)
    {
        $sql = "delete from category";
        return $connection->exec($sql);
    }

    public function getDesc_E()
    {
        return $this->desc_e;
    }

    public function getDesc_F()
    {
        return $this->desc_f;
    }

    public function getCat_ID()
    {
        return $this->id;
    }
}

class User
{

    private $username, $password, $true_name, $address, $city, $state, $phone, $member;

    public function __construct($username = null, $password = null, $true_name = null, $address = null, $city = null, $state = null, $phone = null, $member = null)
    {
        $this->username = $username;
        $this->password = $password;
        $this->true_name = $true_name;
        $this->address = $address;
        $this->city = $city;
        $this->state = $state;
        $this->phone = $phone;
        $this->member = $member;
    }

    public function create($connection)
    {
        $sql = "insert into web_user(username, pswd, true_name, address, city, state, phone, member) values('$this->username', '$this->password', '$this->true_name', '$this->address', '$this->city', '$this->state', '$this->phone', '$this->member')";
        return $connection->exec($sql);
    }

    public static function readAll($connection)
    {
        $sql = "select * from web_user";
        $counter = 0;
        $arr;
        foreach ($connection->query($sql) as $one) {
            $arr[$counter ++] = new User($one["username"], $one["pswd"], $one["true_name"], $one["address"], $one["city"], $one["state"], $one["phone"], $one["member"]);
        }
        return $arr;
    }

    public function update($connection)
    {
        $sql = "update web_user set pswd = '$this->password', true_name = '$this->true_name', address = '$this->address', city = '$this->city', state = '$this->state', phone = '$this->phone', member = '$this->member' where username = '$this->username'";
        return $connection->exec($sql);
    }

    public function delete($connection)
    {
        $sql = "delete web_user where username = '$this->username'";
        return $connection->exec($sql);
    }

    public function find($connection)
    {
        $ret = null;
        $sql = "select * from web_user where username = '$this->username' and pswd = '$this->password'";
        foreach ($connection->query($sql) as $one) {
            $ret = new User($one["username"], $one["pswd"], $one["true_name"], $one["address"], $one["city"], $one["state"], $one["phone"], $one["member"]);
            break;
        }
        return $ret;
    }

    public function __toString()
    {
        return $this->username;
    }
}

class SubCategory
{

    private static $idCounter;

    private $id, $desc_e, $desc_f, $cat_id;

    public function __construct($id = null, $desc_e = null, $desc_f = null, $cat_id = null)
    {
        if ($id == null) {
            self::$idCounter += 1;
            $this->id = self::$idCounter;
        } else {
            $this->id = $id;
        }
        $this->desc_e = $desc_e;
        $this->desc_f = $desc_f;
        $this->cat_id = $cat_id;
    }

    public function create($connection)
    {
        $sql = "insert into sub_category(subcat_id, cat_id, desc_e, desc_f) values($this->id, $this->cat_id, '$this->desc_e', '$this->desc_f')";
        return $connection->exec($sql);
    }

    public static function readAll($connection)
    {
        $sql = "select * from sub_category";
        $counter = 0;
        $arr;
        foreach ($connection->query($sql) as $one) {
            $arr[$counter ++] = new SubCategory($one["subcat_id"], $one["desc_e"], $one["desc_f"], $one["cat_id"]);
        }
        return $arr;
    }

    public function update($connection)
    {
        $sql = "update sub_category set desc_e = '$this->desc_e', desc_f = '$this->desc_f', cat_id = $this->cat_id where subcat_id = $this->id";
        return $connection->exec($sql);
    }

    public function delete($connection)
    {
        $sql = "delete from sub_category where subcat_id = $this->id";
        return $connection->exec($sql);
    }

    public function find($connection)
    {
        $sql = "select * from sub_category where subcat_id = $this->id";
        foreach ($connection->query($sql) as $one) {
            $ret = new SubCategory($one["subcat_id"], $one["desc_e"], $one["desc_f"], $one["cat_id"]);
            break;
        }
        return $ret;
    }

    public function toOptionF($cat)
    {
        if ($cat == $this->cat_id) {
            return "<option value=\"$this->id\">$this->desc_f</option>";
        } else {
            return "";
        }
    }

    public function toOptionE($cat)
    {
        if ($cat == $this->cat_id) {
            return "<option value=\"$this->id\">$this->desc_e</option>";
        } else {
            return "";
        }
    }

    public static function deleteAll($connection)
    {
        $sql = "delete from sub_category";
        return $connection->exec($sql);
    }

    /**
     *
     * @return string
     */
    public function getDesc_e()
    {
        return $this->desc_e;
    }

    /**
     *
     * @param string $desc_e
     */
    public function setDesc_e($desc_e)
    {
        $this->desc_e = $desc_e;
    }

    public function getDesc_f()
    {
        return $this->desc_f;
    }

    public function getSubCat_ID()
    {
        return $this->id;
    }
}

class Ad
{

    private $ad_id, $title, $description, $cat_id, $subcat_id, $startDate, $endDate, $paid, $username;

    private $arr_url;

    public function getArr_Url()
    {
        return $this->arr_url;
    }

    /**
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     *
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     *
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getStartDate()
    {
        return $this->startDate;
    }

    public function __construct($ad_id = null, $title = null, $description = null, $cat_id = null, $subcat_id = null, $startDate = null, $endDate = null, $paid = null, $username = null)
    {
        $this->ad_id = $ad_id;
        $this->description = $description;
        $this->cat_id = $cat_id;
        $this->endDate = $endDate;
        $this->paid = $paid;
        $this->startDate = $startDate;
        $this->subcat_id = $subcat_id;
        $this->title = $title;
        $this->username = $username;
    }

    public function create($connection)
    {
        $sql = "insert into ad(ad_id, title, description, cat_id, subcat_id, startDate, endDate, paid, username) values($this->ad_id, '$this->title', '$this->description', $this->cat_id, $this->subcat_id, '$this->startDate', '$this->endDate', $this->paid, '$this->username')";
        $connection->exec($sql);
        return $sql;
    }

    public static function readAll($connection)
    {
        $sql = "select * from ad order by startDate desc";
        $counter = 0;
        $arr;
        foreach ($connection->query($sql) as $one) {
            $arr[$counter ++] = new Ad($one["ad_id"], $one["title"], $one["description"], $one["cat_id"], $one["subcat_id"], $one["startDate"], $one["endDate"], $one["paid"], $one["username"]);
        }
        return $arr;
    }

    public static function getPaidFromArr($connection, $arr, $value)
    {
        $counter = 0;
        $ret = null;
        foreach ($arr as $one) {
            if ($one->paid == $value) {
                $urlCounter = 0;
                $urlSQL = "select p_url from picture where ad_id = " . $one->ad_id;
                foreach ($connection->query($urlSQL) as $p) {
                    $one->arr_url[$urlCounter ++] = $p["p_url"];
                }
                $ret[$counter ++] = $one;
            }
        }
        return $ret;
    }

    public static function getCategoryFromArr($connection, $arr, $value)
    {
        $counter = 0;
        $ret = null;
        foreach ($arr as $one) {
            if ($one->cat_id == $value) {
                $urlCounter = 0;
                $urlSQL = "select p_url from picture where ad_id = " . $one->ad_id;
                foreach ($connection->query($urlSQL) as $p) {
                    $one->arr_url[$urlCounter ++] = $p["p_url"];
                }
                $ret[$counter ++] = $one;
            }
        }
        return $ret;
    }

    public static function getSubCategoryFromArr($connection, $arr, $value)
    {
        $counter = 0;
        $ret = null;
        foreach ($arr as $one) {
            if ($one->subcat_id == $value) {
                $urlCounter = 0;
                $urlSQL = "select p_url from picture where ad_id = " . $one->ad_id;
                foreach ($connection->query($urlSQL) as $p) {
                    $one->arr_url[$urlCounter ++] = $p["p_url"];
                }
                $ret[$counter ++] = $one;
            }
        }
        return $ret;
    }

    public function update($connection)
    {
        $sql = "update ad set description = '$this->description', paid = $this->paid, title = '$this->title', cat_id = $this->cat_id, subcat_id = $this->subcat_id, startDate = $this->startDate, endDate = $this->endDate, username = $this->username where ad_id = $this->ad_id";
        return $connection->exec($sql);
    }

    public function delete($connection)
    {
        $sql = "delete from ad where ad_id = $this->ad_id";
        return $connection->exec($sql);
    }

    public function find($connection)
    {
        $sql = "select * from ad where ad_id = $this->ad_id";
        foreach ($connection->query($sql) as $one) {
            $ret = new Ad($one["ad_id"], $one["title"], $one["description"], $one["cat_id"], $one["subcat_id"], $one["startDate"], $one["endDate"], $one["paid"], $one["username"]);
            break;
        }
        return $ret;
    }

    public static function getID($connection)
    {
        $sql = "select * from ad";
        $ret = 1;
        foreach ($connection->query($sql) as $one) {
            if ($one["ad_id"] > $ret) {
                $ret = $one["ad_id"];
            }
        }
        return $ret;
    }

    public static function deleteAll($connection)
    {
        $sql = "delete from ad";
        return $connection->exec($sql);
    }

    public static function searchFor($arr, $search)
    {
        $ret = null;
        $counter = 0;
        foreach ($arr as $value) {
            if (stripos($value->getTitle(), $search) !== false) {
                $ret[$counter ++] = $value;
            }
        }
        return $ret;
    }
}

class Discount
{

    private $username, $percentage, $startDate, $endDate;

    public function __construct($username = null, $percentage = null, $startDate = null, $endDate = null)
    {
        $this->username = $username;
        $this->percentage = $percentage;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function create($connection)
    {
        $sql = "insert into discount(username, percentage, startDate, endDate) values('$this->username', $this->percentage, '$this->startDate', '$this->endDate')";
        return $connection->exec($sql);
    }

    public static function readAll($connection)
    {
        $sql = "select * from discount";
        $counter = 0;
        $arr;
        foreach ($connection->query($sql) as $one) {
            $arr[$counter ++] = new Discount($one["username"], $one["percentage"], $one["startDate"], $one["endDate"]);
        }
        return $arr;
    }

    public function update($connection)
    {
        $sql = "update discount set percentage = $this->percentage, startDate = $this->startDate, endDate = $this->endDate where username = '$this->username'";
        return $connection->exec($sql);
    }

    public function delete($connection)
    {
        $sql = "delete from discount where username = '$this->username'";
        return $connection->exec($sql);
    }

    public function find($connection)
    {
        $ret = null;
        $sql = "select * from discount where username = '$this->username'";
        foreach ($connection->query($sql) as $one) {
            $ret = new Discount($one["username"], $one["percentage"], $one["startDate"], $one["endDate"]);
            break;
        }
        return $ret;
    }

    public function getPercentage()
    {
        return $this->percentage;
    }
}

class Picture
{

    private $ad_id, $p_url;

    public function __construct($ad_id, $p_url)
    {
        $this->ad_id = $ad_id;
        $this->p_url = $p_url;
    }

    public function create($connection)
    {
        $sql = "insert into picture (ad_id, p_url) values($this->ad_id, '$this->p_url')";
        $connection->exec($sql);
    }

    public static function readAll($connection)
    {
        $sql = "select * from picture";
        $counter = 0;
        $arr;
        foreach ($connection->query($sql) as $one) {
            $arr[$counter ++] = new Picture($one["ad_id"], $one["p_url"]);
        }
        return $arr;
    }

    public function delete($connection)
    {
        $sql = "delete picture where ad_id =$this->ad_id";
        return $connection->exec($sql);
    }

    public function find($connection)
    {
        $sql = "select * from picture where ad_id = $this->ad_id";
        $counter = 0;
        $arr;
        foreach ($connection->query($sql) as $one) {
            $arr[$counter ++] = new Picture($one["ad_id"], $one["p_url"]);
        }
        return $arr;
    }

    public static function deleteAll($connection)
    {
        $sql = "delete from picture";
        return $connection->exec($sql);
    }
}

class PaymentLog
{

    private $ad_id, $amount, $paymentDate, $p_id, $username;

    public function __construct($ad_id = null, $amount = null, $paymentDate = null, $p_id = null, $username = null)
    {
        $this->ad_id = $ad_id;
        $this->amount = $amount;
        $this->p_id = $p_id;
        $this->paymentDate = $paymentDate;
        $this->username = $username;
    }

    public function create($connection)
    {
        $sql = "insert into paymentLog (ad_id, amount, paymentDate, p_id, username) values($this->ad_id, $this->amount, '$this->paymentDate', $this->p_id, '$this->username')";
        $connection->exec($sql);
    }

    public static function getID($connection)
    {
        $sql = "select * from paymentLog";
        $ret = 1;
        foreach ($connection->query($sql) as $one) {
            if ($one["p_id"] > $ret) {
                $ret = $one["p_id"];
            }
        }
        return ++ $ret;
    }

    public function __toString()
    {
        return "P_ID " . $this->p_id . " Ad_id " . $this->ad_id . " Date " . $this->paymentDate . " amount " . $this->amount . " username " . $this->username;
    }
}
?>
