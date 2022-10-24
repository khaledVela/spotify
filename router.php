<?php

use App\controllers\GeneroController;
use App\controllers\ArtistaController;
use App\controllers\AlbumController;
use App\controllers\CancionController;

$controller = "genero";
$action = "list";
if (isset($_REQUEST["controller"])) {
    $controller = $_REQUEST["controller"];
}
if (isset($_REQUEST["action"])) {
    $action = $_REQUEST["action"];
}
switch ($controller) {
    case "genero":
        switch ($action) {
            case "list":
                if ($_SERVER["REQUEST_METHOD"] != "GET") {
                    http_response_code(405);
                    die("Error 405: Method Not Allowed");
                }
                GeneroController::index();
                break;
            case "store":
                if ($_SERVER["REQUEST_METHOD"] != "POST") {
                    http_response_code(405);
                    die("Error 405: Method Not Allowed");
                }
                $body = file_get_contents("php://input");
                GeneroController::store($body);
                break;
            case "update":
                if ($_SERVER["REQUEST_METHOD"] == "PUT") {
                    $body = file_get_contents("php://input");
                    GeneroController::updatePut($_REQUEST["id"], $body);

                    return;
                }
                if ($_SERVER["REQUEST_METHOD"] == "PATCH") {
                    $body = file_get_contents("php://input");
                    GeneroController::updatePatch($_REQUEST["id"], $body);

                    return;
                }
                http_response_code(405);
                die("Error 405: Method Not Allowed");
                break;
            case "delete":
                if ($_SERVER["REQUEST_METHOD"] != "DELETE") {
                    http_response_code(405);
                    die("Error 405: Method Not Allowed");
                }
                GeneroController::delete($_GET["id"]);
                break;
            case "detail":
                if ($_SERVER["REQUEST_METHOD"] != "GET") {
                    http_response_code(405);
                    die("Error 405: Method Not Allowed");
                }
                GeneroController::detail($_GET["id"]);
                break;
            case "photo":
                if ($_SERVER["REQUEST_METHOD"] != "POST") {
                    http_response_code(405);
                    die("Error 405: Method Not Allowed");
                }
                GeneroController::photo($_GET["id"], $_FILES);
                break;
        }
        break;
    case "artista":
        switch ($action) {
            case "generos":
                if ($_SERVER["REQUEST_METHOD"] != "GET") {
                    http_response_code(405);
                    die("Error 405: Method Not Allowed");
                }
                ArtistaController::GetByGeneros($_GET["id"]);
                break;
            case "list":
                if ($_SERVER["REQUEST_METHOD"] != "GET") {
                    http_response_code(405);
                    die("Error 405: Method Not Allowed");
                }
                ArtistaController::index();
                break;
            case "store":
                if ($_SERVER["REQUEST_METHOD"] != "POST") {
                    http_response_code(405);
                    die("Error 405: Method Not Allowed");
                }
                $body = file_get_contents("php://input");
                ArtistaController::store($body);
                break;
            case "update":
                if ($_SERVER["REQUEST_METHOD"] == "PUT") {
                    $body = file_get_contents("php://input");
                    ArtistaController::updatePut($_REQUEST["id"], $body);

                    return;
                }
                if ($_SERVER["REQUEST_METHOD"] == "PATCH") {
                    $body = file_get_contents("php://input");
                    ArtistaController::updatePatch($_REQUEST["id"], $body);

                    return;
                }
                http_response_code(405);
                die("Error 405: Method Not Allowed");
                break;
            case "delete":
                if ($_SERVER["REQUEST_METHOD"] != "DELETE") {
                    http_response_code(405);
                    die("Error 405: Method Not Allowed");
                }
                ArtistaController::delete($_GET["id"]);
                break;
            case "detail":
                if ($_SERVER["REQUEST_METHOD"] != "GET") {
                    http_response_code(405);
                    die("Error 405: Method Not Allowed");
                }
                ArtistaController::detail($_GET["id"]);
                break;
            case "photo":
                if ($_SERVER["REQUEST_METHOD"] != "POST") {
                    http_response_code(405);
                    die("Error 405: Method Not Allowed");
                }
                ArtistaController::photo($_GET["id"], $_FILES);
                break;
        }
        break;
    case "album":
        switch ($action) {
            case "artista":
                if ($_SERVER["REQUEST_METHOD"] != "GET") {
                    http_response_code(405);
                    die("Error 405: Method Not Allowed");
                }
                AlbumController::GetByArtista($_GET["id"]);
                break;
            case "list":
                if ($_SERVER["REQUEST_METHOD"] != "GET") {
                    http_response_code(405);
                    die("Error 405: Method Not Allowed");
                }
                AlbumController::index();
                break;
            case "store":
                if ($_SERVER["REQUEST_METHOD"] != "POST") {
                    http_response_code(405);
                    die("Error 405: Method Not Allowed");
                }
                $body = file_get_contents("php://input");
                AlbumController::store($body);
                break;
            case "update":
                if ($_SERVER["REQUEST_METHOD"] == "PUT") {
                    $body = file_get_contents("php://input");
                    AlbumController::updatePut($_REQUEST["id"], $body);

                    return;
                }
                if ($_SERVER["REQUEST_METHOD"] == "PATCH") {
                    $body = file_get_contents("php://input");
                    AlbumController::updatePatch($_REQUEST["id"], $body);

                    return;
                }
                http_response_code(405);
                die("Error 405: Method Not Allowed");
                break;
            case "delete":
                if ($_SERVER["REQUEST_METHOD"] != "DELETE") {
                    http_response_code(405);
                    die("Error 405: Method Not Allowed");
                }
                AlbumController::delete($_GET["id"]);
                break;
            case "detail":
                if ($_SERVER["REQUEST_METHOD"] != "GET") {
                    http_response_code(405);
                    die("Error 405: Method Not Allowed");
                }
                AlbumController::detail($_GET["id"]);
                break;
            case "photo":
                if ($_SERVER["REQUEST_METHOD"] != "POST") {
                    http_response_code(405);
                    die("Error 405: Method Not Allowed");
                }
                AlbumController::photo($_GET["id"], $_FILES);
                break;
        }
        break;
    case "cancion":
        switch ($action) {
            case "list":
                if ($_SERVER["REQUEST_METHOD"] != "GET") {
                    http_response_code(405);
                    die("Error 405: Method Not Allowed");
                }
                CancionController::index();
                break;
            case "store":
                if ($_SERVER["REQUEST_METHOD"] != "POST") {
                    http_response_code(405);
                    die("Error 405: Method Not Allowed");
                }
                $body = file_get_contents("php://input");
                CancionController::store($body);
                break;
            case "update":
                if ($_SERVER["REQUEST_METHOD"] == "PUT") {
                    $body = file_get_contents("php://input");
                    CancionController::updatePut($_REQUEST["id"], $body);
                    return;
                }
                if ($_SERVER["REQUEST_METHOD"] == "PATCH") {
                    $body = file_get_contents("php://input");
                    CancionController::updatePatch($_REQUEST["id"], $body);

                    return;
                }
                http_response_code(405);
                die("Error 405: Method Not Allowed");
                break;
            case "delete":
                if ($_SERVER["REQUEST_METHOD"] != "DELETE") {
                    http_response_code(405);
                    die("Error 405: Method Not Allowed");
                }
                CancionController::delete($_GET["id"]);
                break;
            case "detail":
                if ($_SERVER["REQUEST_METHOD"] != "GET") {
                    http_response_code(405);
                    die("Error 405: Method Not Allowed");
                }
                CancionController::detail($_GET["id"]);
                break;
            case "photo":
                if ($_SERVER["REQUEST_METHOD"] != "POST") {
                    http_response_code(405);
                    die("Error 405: Method Not Allowed");
                }
                CancionController::song($_GET["id"], $_FILES);
                break;
        }
        break;
}