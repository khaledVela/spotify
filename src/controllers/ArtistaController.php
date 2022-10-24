<?php

namespace App\controllers;

use App\models\bll\ArtistaBLL;
use App\utils\ValidationUtils;

class ArtistaController
{
    static function index()
    {
        $listaArtista = ArtistaBLL::selectAll();
        echo json_encode($listaArtista);
    }

    static function GetByGeneros($id)
    {
        $objArtista = ArtistaBLL::selectByGeneros($id);
        echo json_encode($objArtista);
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
        if (!ValidationUtils::validarRequest($request, "genero")) {
            return;
        }
        $genero = $request->genero;
        $id = ArtistaBLL::insert($nombre, $genero);
        $objArtista = ArtistaBLL::selectById($id);
        echo json_encode($objArtista);
    }

    static function updatePatch($id, $body)
    {
        $objArtista = ArtistaBLL::selectById($id);
        if ($objArtista == null) {
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
            $objArtista->setNombre($request->nombre);
        }
        if (property_exists($request, "genero")) {
            $objArtista->setGenero($request->genero);
        }
        ArtistaBLL::update($objArtista->getNombre(), $objArtista->getGenero(), $objArtista->getId());
        $objArtista = ArtistaBLL::selectById($id);
        echo json_encode($objArtista);
    }

    static function updatePut($id, $body)
    {
        $objArtista = ArtistaBLL::selectById($id);
        if ($objArtista == null) {
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
        if (!ValidationUtils::validarRequest($request, "genero")) {
            return;
        }
        $genero = $request->genero;
        ArtistaBLL::update($nombre, $genero, $id);
        $objArtista = ArtistaBLL::selectById($id);
        echo json_encode($objArtista);
    }
    
    static function delete($id)
    {
        $objArtista = ArtistaBLL::selectById($id);
        if ($objArtista == null) {
            http_response_code(404);
            die("Error 404: Not Found");
        }
        ArtistaBLL::delete($id);
        echo json_encode(["res" => "ok"]);
    }
    
    static function detail($id)
    {
        $objArtista = ArtistaBLL::selectById($id);
        if ($objArtista == null) {
            http_response_code(404);
            die("Error 404: Not Found");
        }
        $objArtista = ArtistaBLL::selectById($id);
        echo json_encode($objArtista);
    }

    public static function photo($id, array $files)
    {
        $objArtista = ArtistaBLL::selectById($id);
        if ($objArtista == null) {
            http_response_code(404);
            die("Error 404: Not Found");
        }
        $file = $files["imagen"];
        $tmp = $file["tmp_name"];
        $ext = pathinfo($file["name"], PATHINFO_EXTENSION);
        $newName = $id.".".$ext;
        $newPath = "img/artista/".$newName;
        move_uploaded_file($tmp, $newPath);
        echo "{\"res\":\"ok\"}";
    }
}