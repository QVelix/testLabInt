<?php
$uri = parse_url($_SERVER['REQUEST_URI']. PHP_URL_PATH);
$uri = explode('/', $uri);
if ((isset($uri[2]) && $uri[2] != 'user') || !isset($uri[3])) {
    header("HTTP/1.1 404 Not Found");
    exit();
}
require $_SERVER["DOCUMENT_ROOT"]."/Models/User.php";
switch($_SERVER['REQUEST_METHOD']){
    case 'GET':
        $user = new User();
        if(isset($_GET["id"])){
            echo json_encode($user->getUser($_GET["id"]), JSON_UNESCAPED_SLASHES |  JSON_UNESCAPED_UNICODE);
        }
        if(isset($_GET["password"])&&isset($_GET["login"])){
            echo json_encode($user->auth($_GET["login"], $_GET["password"]), JSON_UNESCAPED_SLASHES |  JSON_UNESCAPED_UNICODE);
        }
        break;
    case 'POST':
        $user = new User();
        $u = [
            "id" => $_POST["id"],
            "name" => $_POST["name"],
            "login" => $_POST["login"],
            "password" => $_POST["password"]
        ];
        $user->pushUser($u);
        echo json_encode("Done", JSON_UNESCAPED_SLASHES |  JSON_UNESCAPED_UNICODE);
        break;
    case 'PUT':
        parse_str(file_get_contents('php://input'), $_PUT);
        $user = new User();
        $u = [
            "id" => $_POST["id"],
            "name" => $_POST["name"],
            "login" => $_POST["login"],
            "password" => $_POST["password"]
        ];
        $result = $user->changeUser($_PUT['id'], $u);
        echo json_encode($result, JSON_UNESCAPED_SLASHES |  JSON_UNESCAPED_UNICODE);
        break;
    case 'DELETE':
        parse_str(file_get_contents('php://input'), $_DELETE);
        $user = new User();
        $user->deleteUser($_DELETE["id"]);
        echo json_encode("Done", JSON_UNESCAPED_SLASHES |  JSON_UNESCAPED_UNICODE);
        break;
}
exit();
?>