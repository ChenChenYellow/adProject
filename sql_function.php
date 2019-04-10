<?php
$web_user_cols = array(
    "username",
    "pswd",
    "true_name",
    "address",
    "city",
    "state",
    "phone",
    "member"
);

function select($myCon, $tableName, $col_id, $value)
{
    $sql = "Select * from " . $tableName . " where " . $col_id ." = '" . $value."'"; 
    $qid = $myCon->query($sql);
    if ($qid->num_rows > 0) {
        return $qid;
        //while ($row = $qid->fetch_assoc()) {
        //    echo $row["username"];
        //}
    }
    return NULL;
}

function insert_into($myCon, $tableName, $arrTableCols, $arrValues)
{
    $sql = "Insert into " . $tableName . "(";
    $temp = $sql;
    foreach ($arrTableCols as $col) {
        $temp = $temp . $col;
        $sql = $temp;
        $temp .= ",";
    }
    $sql .= ") values (";
    $temp = $sql;
    foreach ($arrValues as $value) {
        $temp .= "'" . $value . "'";
        $sql = $temp;
        $temp .= ",";
    }
    $sql .= ")";
    echo $sql;

    $qid = $myCon->query($sql);
    if ($qid == true) {
        echo "One Row Added <br/>";
    } else {
        echo "Error";
    }
}

?>