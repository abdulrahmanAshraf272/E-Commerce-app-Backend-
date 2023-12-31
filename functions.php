<?php
define("MB", 1048576);

function filterRequest($requestName)
{
    return htmlspecialchars(strip_tags($_POST[$requestName]));
}

function getAllData($table, $where = null, $values = null, $json = true)
{
    global $con;
    $data = array();
    if ($where == null) {
        $stmt = $con->prepare("SELECT * FROM $table");
    } else {
        $stmt = $con->prepare("SELECT * FROM $table WHERE $where");
    }

    $stmt->execute($values);
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $count = $stmt->rowCount();
    if ($json == true) {
        if ($count > 0) {
            echo json_encode(array("status" => "success", "data" => $data));
        } else {
            echo json_encode(array("status" => "failure"));
        }
    } else {
        if ($count > 0) {
            return $data;
        } else {
            echo json_encode(array("status" => "failure"));
        }
    }

    return $count;
}

function getData($table, $where = null, $values = null, $json = true)
{
    global $con;
    $data = array();
    $stmt = $con->prepare("SELECT * FROM $table WHERE $where");
    $stmt->execute($values);
    $data = $stmt->fetch(PDO::FETCH_ASSOC);
    $count = $stmt->rowCount();
    if ($json = true) {
        if ($count > 0) {
            echo json_encode(array("status" => "success", "data" => $data));
        } else {
            echo json_encode(array("status" => "failure"));
        }
    } else {
        return $count;
    }
}


function insertData($table, $data, $json = true)
{
    global $con;
    foreach ($data as $field => $v) {
        $ins[] = ":" . $field;
    }
    $ins = implode(',', $ins);
    $fields = implode(',', array_keys($data));
    $sql = "INSERT INTO $table ($fields) VALUES ($ins)";

    $stmt = $con->prepare($sql);
    foreach ($data as $f => $v) {
        $stmt->bindValue(':' . $f, $v);
    }

    $stmt->execute();
    $count = $stmt->rowCount();
    if ($json == true) {
        if ($count > 0) {
            echo json_encode(array("status" => "success"));
        } else {
            echo json_encode(array("status" => "failure"));
        }
    }
    return $count;
}





function updateData($table, $data, $where, $json = true)
{
    global $con;
    $cols = array();
    $vals = array();

    foreach ($data as $key => $val) {
        $vals[] = "$val";
        $cols[] = "`$key` =  ? ";
    }
    $sql = "UPDATE $table SET " . implode(', ', $cols) . " WHERE $where";

    echo 'the SQL:  ' . $sql;

    $stmt = $con->prepare($sql);
    $stmt->execute($vals);
    $count = $stmt->rowCount();
    if ($json == true) {
        if ($count > 0) {
            echo json_encode(array("status" => "success"));
        } else {
            echo json_encode(array("status" => "failure"));
        }
    }
    return $count;
}

function deleteData($table, $where, $json = true)
{
    global $con;
    $stmt = $con->prepare("DELETE FROM $table WHERE $where");
    $stmt->execute();
    $count = $stmt->rowCount();
    if ($json == true) {
        if ($count > 0) {
            echo json_encode(array("status" => "success"));
        } else {
            echo json_encode(array("status" => "failure"));
        }
    }

    return $count;
}

function imageUpload($imageRequest)
{
    global $msgError;
    $imagename = rand(1000, 10000) . $_FILES[$imageRequest]['name'];
    $imagetmp = $_FILES[$imageRequest]['tmp_name'];
    $imagesize = $_FILES[$imageRequest]['size'];

    $allowExt = array("jpg", "png", "gif", "mp3", "pdf");
    $strToArray = explode(".", $imagename);
    $ext = end($strToArray);
    $ext = strtolower($ext);

    if (!empty($imagename) && in_array($ext, $allowExt)) {
        $msgError = "EXT";
    }
    if ($imagesize > 2 * MB) {
        $msgError = "size";
    }

    if (empty($msgError)) {
        move_uploaded_file($imagetmp, "../upload/" . $imagename);
        return $imagename;
    } else {
        return "fail";
    }
}

function deleteFile($dir, $imagename)
{
    if (file_exists($dir, "/" . $imagename)) {
        unlink($dir, "/" . $imagename);
    }
}

function checkAuthenticate()
{
    if (isset($_SERVER['PHP_AUTH_USER'])  && isset($_SERVER['PHP_AUTH_PW'])) {
        if ($_SERVER['PHP_AUTH_USER'] != "abdo" ||  $_SERVER['PHP_AUTH_PW'] != "abdo682") {
            header('WWW-Authenticate: Basic realm="My Realm"');
            header('HTTP/1.0 401 Unauthorized');
            echo 'Page Not Found';
            exit;
        }
    } else {
        exit;
    }
}

function sendResult($count)
{
    if ($count > 0) {
        printSuccess();
    } else {
        printFailure();
    }
}

function printFailure($message = "none")
{
    echo json_encode(array("status" => "failure", "message" => "$message"));
}

function printSuccess($message = "none")
{
    echo json_encode(array("status" => "success", "message" => $message));
}



function sendEmail($to, $title, $body)
{
    $header = "From: support@abdo.com" . "\n" . "CC: abdo@gmail.com";
    mail($to, $title, $body, $header);
    echo "success";
}






// define('MB', 1048576);

// function filterRequest($requestName)
// {
//     return htmlspecialchars(strip_tags($_POST[$requestName]));
// }

// function imageUpload($imageRequest)
// {
//     global $msgError;

//     $imageName = rand(100, 1000) . $_FILES[$imageRequest]['name'];
//     $imageTmp = $_FILES[$imageRequest]['tmp_name'];
//     $imageSize = $_FILES[$imageRequest]['size'];

//     $allowExt = array("jpg", "png", "gif", "mp3", "pdf");
//     $strToArray = explode(".", $imageName);
//     $ext = end($strToArray);
//     $ext  = strtolower($ext);

//     if (!empty($imageName) && !in_array($ext, $allowExt)) {
//         $msgError[] = "Ext";
//     }
//     if ($imageSize > 2 * MB) {
//         $msgError[] = "size";
//     }
//     if (empty($msgError)) {
//         move_uploaded_file($imageTmp, "../upload/" . $imageName);
//         return $imageName;
//     } else {
//         return "fail";
//     }
// }

// function deleteFile($filePath, $imageName)
// {
//     if (file_exists($filePath . "/" . $imageName)) {
//         unlink($filePath . "/" . $imageName);
//     }
// }

// function checkAuthenticate()
// {
//     if (isset($_SERVER['PHP_AUTH_USER'])  && isset($_SERVER['PHP_AUTH_PW'])) {
//         if ($_SERVER['PHP_AUTH_USER'] != "abdo" ||  $_SERVER['PHP_AUTH_PW'] != "abdo682") {
//             header('WWW-Authenticate: Basic realm="My Realm"');
//             header('HTTP/1.0 401 Unauthorized');
//             echo 'Page Not Found';
//             exit;
//         }
//     } else {
//         exit;
//     }
// }
