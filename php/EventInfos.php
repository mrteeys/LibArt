<?php
/**
 * Event API
 */

include "./DbBase.php";
$isGet = isset($_GET['action']);
$action = ($isGet ? $_GET['action'] : $_POST['action']);

if ($_SESSION['Number'] == null) {
    echo Error("Please Login!");
    return;
}

switch ($action) {
    case 'GetAll':
        GetAllEventInfos($isGet);
        break;
    case 'Get':
        GetByCallNo($isGet);
        break;
    case 'Create':
        CreateEventInfo($isGet);
        break;
    case 'Update':
        UpdateEventInfo($isGet);
        break;
}

// GetAll
function GetAllEventInfos($isGet)
{
    $sql = "SELECT * FROM event";
    echo GetAll($sql, ($isGet ? $_GET['page'] : $_POST['page']), ($isGet ? $_GET['limit'] : $_POST['limit']));
}

// 通过索书号获取图书信息
function GetByCallNo($isGet)
{
    $callNo = ($isGet ? $_GET['callNo'] : $_POST['callNo']);
    $sql = "SELECT * FROM BookInfos WHERE CallNo = '$callNo'";
    echo Get($sql);
}

// CreateEvent
function CreateEventInfo($isGet)
{

    $id = ($isGet ? $_GET['id'] : $_POST['id']);
    $name = $isGet ? $_GET['name'] : $_POST['name'];
    $typeNumber = $isGet ? $_GET['type'] : $_POST['type'];
    $start_date = $isGet ? $_GET['startdate'] : $_POST['startdate'];
    $stop_date = $isGet ? $_GET['stopdate'] : $_POST['stopdate'];

    if ($id == null) {
        echo Error("invalid");
        return;
    }

    if ($name == null) {
        echo Error("invalid");
        return;
    }

    if ($typeNumber == null) {
        echo Error("invalid");
        return;
    }

    if ($startdate == null) {
        echo Error("invalid");
        return;
    }
    if ($stopdate == null) {
        echo Error("invalid");
        return;
    }


    $sql = "INSERT INTO event
            (id, name, TypeNumber, Start_DATE, Stop_DATE)
            VALUES
            ('$id', '$name', '$typeNumber', '$start_date', '$stop_date')";

    // $otherSql = "INSERT INTO BookStatistics
    //             (BookCallNo, NumOfLoans, Surplus, Total)
    //             VALUES
    //             ('$callNo', 0, 0, 0)";
    $result = Create($sql);

    $temp = json_decode($result);
    // if ($temp->code == 0) {
    //     Create($otherSql);
    // }

    echo $result;
}


// Update
function UpdateEventInfo($isGet)
{
    $id = ($isGet ? $_GET['id'] : $_POST['id']);
    $name1 = $isGet ? $_GET['name'] : $_POST['name'];
    $typeNumber = $isGet ? $_GET['typeNumber'] : $_POST['typeNumber'];
    $startdate = $isGet ? $_GET['startdate'] : $_POST['startdate'];
    $stopdate = $isGet ? $_GET['stopdate'] : $_POST['stopdate'];

    if ($id == null) {
        echo Error("Can not be null");
        return;
    }

    if ($name1 == null) {
        echo Error("Can not be null");
        return;
    }

    if ($typeNumber == null) {
        echo Error("Can not be null");
        return;
    }

    if ($startdate == null) {
        echo Error("Can not be null");
        return;
    }

    if ($stopdate == null) {
        echo Error("Can not be null");
        return;
    }

    $sql = "UPDATE event SET name1 = '$name', typeNumber = '$typeNumber' WHERE id = '$id'";
    echo Update($sql);
}
