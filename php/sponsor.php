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
        GetAllSponsorInfos($isGet);
        break;
    case 'Get':
        GetByCallNo($isGet);
        break;
    case 'Create':
        CreateSponsorInfo($isGet);
        break;
    case 'Update':
        UpdateSponsorInfo($isGet);
        break;

    case 'delete':
        deleteSponsor($isGet);
        break;

        
}

// GetAll
function GetAllSponsorInfos($isGet)
{
    $sql = "SELECT * FROM sponsor";
    echo GetAll($sql, ($isGet ? $_GET['page'] : $_POST['page']), ($isGet ? $_GET['limit'] : $_POST['limit']));
}

// 
function GetByCallNo($isGet)
{
    $callNo = ($isGet ? $_GET['id'] : $_POST['id']);
    $sql = "SELECT * FROM sponsor WHERE id = '$callNo'";
    echo Get($sql);
}

// CreateSponsor
function CreateSponsorInfo($isGet)
{
    $id = ($isGet ? $_GET['id'] : $_POST['id']);
    $name = $isGet ? $_GET['name'] : $_POST['name'];
    $type = $isGet ? $_GET['type'] : $_POST['type'];
    $expense = $isGet ? $_GET['expense'] : $_POST['expense'];

    $sql = "INSERT INTO sponsor
            (id, name, type, expense)
            VALUES
            ('$id', '$name', '$type', '$expense')";
    echo Create($sql);
}


// Update
function UpdateSponsorInfo($isGet)
{
    $id = ($isGet ? $_GET['id'] : $_POST['id']);
    $name = $isGet ? $_GET['name'] : $_POST['name'];
    $type = $isGet ? $_GET['type'] : $_POST['type'];
    $expense = $isGet ? $_GET['expense'] : $_POST['expense'];

    if ($id == null) {
        echo Error("Can not be null");
        return;
    }

    if ($name == null) {
        echo Error("Can not be null");
        return;
    }

    if ($type == null) {
        echo Error("Can not be null");
        return;
    }

    if ($expense == null) {
        echo Error("Can not be null");
        return;
    }

    $sql = "UPDATE sponsor SET name = '$name', type = '$type' WHERE id = '$id'";
    echo Update($sql);
}

function deleteSponsor($isGet)
{
//       $id = $isGet ? $_GET['expense'] : $_POST['expense'];
// //     #$disabled = $isGet ? $_GET['disabled'] : $_POST['disabled'];
//       $sql = "DELETE FROM `sponsor` WHERE `sponsor`.`expense` = '$id'";
// //    # $sql = "DELETE table  `sponsor`";
// //    # $sql = "UPDATE Readers SET Disabled = $disabled WHERE  Number = '$number'";
// //    # $sql = "DELETE FROM Readers";
//         echo Delete($sql);

    $number = $isGet ? $_GET['number'] : $_POST['number'];
    #$disabled = $isGet ? $_GET['disabled'] : $_POST['disabled'];
    $sql = "DELETE FROM `readers` WHERE `readers`.`Number` = '$number'";
    echo Delete($sql);
}
