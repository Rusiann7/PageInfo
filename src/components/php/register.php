<?php

require './config.php';
require './function.php';

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

$data = json_decode(file_get_contents('php://input'), true) ?? [];
$action = $data['action'] ?? '';


if($action === "register"){

    $email = $data['email'];
    $password = $data['password'];
    $confirmPassword = $data['confirmpassword'];
    $firstname = $data['flname'];
    $lastname = $data['lnname'];
    $reset = getRandomString(10);
    $verify = getRandomString(10);

    if($password != $confirmPassword){
        echo json_encode(["success" => false, "message" => "Password did not match"]);
        exit;
    }

    $sql = "SELECT * FROM Users WHERE email = '$email'";
    $result = $conn->query($sql);

    if($result && $result->num_rows === 0){

        $hash = password_hash($password, PASSWORD_DEFAULT);

        $sql1 = "INSERT INTO Users (email, password, reset, verified, is_admin, is_deleted)
        VALUES ('$email', '$hash', '$reset', '$verify', 0, 0)";

        if($conn->query($sql1) === true){

            $fkId = $conn->insert_id;

            $sql2 = "INSERT INTO Names (firstname, lastname, usr_id)
            VALUES ('$firstname', '$lastname', $fkId)";

            if($conn->query($sql2) === true){
                echo json_encode(["success" => true,]);
            }else{
                echo json_encode(["sucess" => false, "message" => "DB error" .$sql2]);
            }

        }else{
            echo json_encode(["success" => false, "message" => "DB error" .$sql1]);
        }

    }else{
        echo json_encode(["success" => false, "message" => "User already exist"]);
    }

}else{
    echo json_encode(["success" => false, "message" => "Unknown action"]);
}