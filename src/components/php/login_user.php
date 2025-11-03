<?php

require './config.php';

use Firebase\JWT\JWT;
//use Firebase\JWT\Key;

define('JWT_SECRET_KEY', 'eval');
define('JWT_EXPIRE_TIME', 3600);


if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

$data = json_decode(file_get_contents('php://input'), true) ?? [];
$action = $data['action'] ?? '';

if($action === 'login'){
    
    $email = $data['email'];
    $password = $data['password'];

    $sql = "SELECT n.id AS name_id,
    n.firstname,
    n.lastname, 
    u.id AS user_id,
    u.email,
    u.password
    FROM Users u 
    INNER JOIN Names n ON u.id = n.usr_id 
    WHERE u.email = '$email' AND 
    u.is_deleted = 0";

    $result = $conn->query($sql);

    if($result && $result->num_rows > 0){

        $userData = $result->fetch_assoc();

        if(password_verify($password, $userData['password'])){
                        
            $tokenPayload=[
                'user_id' => $userData['user_id'],
                'email' => $userData['email'],
                'iat' => time(),
                'exp' => time() + JWT_EXPIRE_TIME
            ];

            $token = JWT::encode($tokenPayload, JWT_SECRET_KEY, 'HS256');

            echo json_encode([
                "success" => true,
                "userData" => [
                    "id" => $userData['user_id'],
                    "email" => $userData['email'],
                    "firstname" => $userData['firstname'],
                    "lastname" => $userData['lastname']
                ]
            ]);

            exit;
        }else{
            echo json_encode(["success" => false, "message" => "Password did not match"]);
        }
    }else{
        echo json_encode(["success" => false, "message" => "User not found"]);
    }
}else{
    echo json_encode(["success" => false, "message" => "Unknown action"]);
}