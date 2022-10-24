<?php

namespace App\controllers;

use App\models\bll\CancionBLL;
use App\utils\ValidationUtils;


class CancionController
{
    static function index()
    {
        $listaCancion = CancionBLL::selectAll();
        echo json_encode($listaCancion);
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
        if (!ValidationUtils::validarRequest($request, "album_id")) {
            return;
        }
        $album_id = $request->album_id;
        $id = CancionBLL::insert($nombre,$album_id);
        $objCancion = CancionBLL::selectById($id);
        echo json_encode($objCancion);
    }

    static function updatePatch($id, $body)
    {
        $objCancion = CancionBLL::selectById($id);
        if ($objCancion == null) {
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
            $objCancion->setNombre($request->nombre);
        }
        if (property_exists($request, "album_id")) {
            $objCancion->setAlbum($request->album_id);
        }
        CancionBLL::update($objCancion->getNombre(), $objCancion->getAlbum(), $objCancion->getId());
        $objCancion = CancionBLL::selectById($id);
        echo json_encode($objCancion);
    }

    static function updatePut($id,$body){
        $objCancion = CancionBLL::selectById($id);
        if ($objCancion == null) {
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
        if (!ValidationUtils::validarRequest($request, "album_id")) {
            return;
        }
        $album_id = $request->album_id;
        CancionBLL::update($nombre,$album_id,$id);
        $objCancion = CancionBLL::selectById($id);
        echo json_encode($objCancion);
    }

    static function delete($id){
        $objCancion = CancionBLL::selectById($id);
        if ($objCancion == null) {
            http_response_code(404);
            die("Error 404: Not Found");
        }
        CancionBLL::delete($id);
        echo json_encode(["res"=>"OK"]);
    }

    static function detail($id){
        $objCancion = CancionBLL::selectById($id);
        if ($objCancion == null) {
            http_response_code(404);
            die("Error 404: Not Found");
        }
        $objCancion = CancionBLL::selectById($id);
        echo json_encode($objCancion);
    }

    public static function song($id, array $files)
    {
        $objAlbum = CancionBLL::selectById($id);
        if ($objAlbum == null) {
            http_response_code(404);
            die("Error 404: Not Found");
        }
        $file = $files["imagen"];
        $tmp = $file["tmp_name"];
        $ext = pathinfo($file["name"], PATHINFO_EXTENSION);
        $newName = $id.".".$ext;
        $newPath = "img/cancion/".$newName;
        move_uploaded_file($tmp, $newPath);
        echo "{\"res\":\"ok\"}";
    }
}