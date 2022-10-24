<?php

namespace App\controllers;

use App\models\bll\AlbumBLL;
use App\utils\ValidationUtils;

class AlbumController
{
    static function index()
    {
        $listaAlbum = AlbumBLL::selectAll();
        echo json_encode($listaAlbum);
    }

    static function GetByArtista($id)
    {
        $objAlbum = AlbumBLL::selectByArtista($id);
        echo json_encode($objAlbum);
    }

    static function store($body)
    {
        $request = json_decode($body);
        if ($request == null) {
            http_response_code(400);
            echo("Error 400: Bad Request");
            return;
        }
        if (!ValidationUtils::validarRequest($request, "nombre")) {
            return;
        }
        $nombre = $request->nombre;
        if (!ValidationUtils::validarRequest($request, "artista_id")) {
            return;
        }
        $artista_id = $request->artista_id;
        $id = AlbumBLL::insert($nombre,$artista_id);
        $objAlbum = AlbumBLL::selectById($id);
        echo json_encode($objAlbum);
    }

    static function updatePatch($id, $body)
    {
        $objAlbum = AlbumBLL::selectById($id);
        if ($objAlbum == null) {
            http_response_code(404);
            die("Error 404: Not Found");
        }
        $request = json_decode($body);
        if ($request == null) {
            http_response_code(400);
            echo("Error 400: Bad Request");
            return;
        }
        if (property_exists($request, "nombre")) {
            $objAlbum->setNombre($request->nombre);
        }
        if (property_exists($request, "artista_id")) {
            $objAlbum->setArtista($request->artista_id);
        }
        AlbumBLL::update($objAlbum->getNombre(), $objAlbum->getArtista(), $objAlbum->getId());
        $objAlbum = AlbumBLL::selectById($id);
        echo json_encode($objAlbum);
    }

    static function updatePut($id, $body)
    {
        $objAlbum = AlbumBLL::selectById($id);
        if ($objAlbum == null) {
            http_response_code(404);
            die("Error 404: Not Found");
        }
        $request = json_decode($body);
        if ($request == null) {
            http_response_code(400);
            echo("Error 400: Bad Request");
            return;
        }
        if (!ValidationUtils::validarRequest($request, "nombre")) {
            return;
        }
        $nombre = $request->nombre;
        if (!ValidationUtils::validarRequest($request, "artista_id")) {
            return;
        }
        $artista_id = $request->artista_id;
        AlbumBLL::update($nombre, $artista_id, $id);
        $objAlbum = AlbumBLL::selectById($id);
        echo json_encode($objAlbum);
    }
    
    static function delete($id)
    {
        $objAlbum = AlbumBLL::selectById($id);
        if ($objAlbum == null) {
            http_response_code(404);
            die("Error 404: Not Found");
        }
        AlbumBLL::delete($id);
        echo json_encode(["res" => "ok"]);
    }
    
    static function detail($id)
    {
        $objAlbum = AlbumBLL::selectById($id);
        if ($objAlbum == null) {
            http_response_code(404);
            die("Error 404: Not Found");
        }
        $objAlbum = AlbumBLL::selectById($id);
        echo json_encode($objAlbum);
    }

    public static function photo($id, array $files)
    {
        $objAlbum = AlbumBLL::selectById($id);
        if ($objAlbum == null) {
            http_response_code(404);
            die("Error 404: Not Found");
        }
        $file = $files["imagen"];
        $tmp = $file["tmp_name"];
        $ext = pathinfo($file["name"], PATHINFO_EXTENSION);
        $newName = $id.".".$ext;
        $newPath = "img/album/".$newName;
        move_uploaded_file($tmp, $newPath);
        echo "{\"res\":\"ok\"}";
    }
}