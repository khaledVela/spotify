<?php

namespace App\models\bll;

use App\models\dal\Connection;
use App\models\dto\Artista;
use PDO;
use PDOException;

class ArtistaBLL
{
    public static function insert($nombre, $genero_id):int
    {
        $conn = new Connection();
        $sql = "Call InsertArtista(:varNombres, :varGenero)";
        $conn->queryWithParams($sql, array(
            ":varNombres" => $nombre,
            ":varGenero" => $genero_id
        ));
        return $conn->getLastInsertedId();
    }
    public static function update($nombre, $genero_id, $id)
    {
        $conn = new Connection();
        $sql = "Call UpdateArtista(:varNombres, :varGenero, :varId)";
        $conn->queryWithParams($sql, array(
            ":varNombres" => $nombre,
            ":varGenero" => $genero_id,
            ":varId"=>$id
        ));
    }
    public static function delete($id)
    {
        $conn = new Connection();
        $sql = "Call DeleteArtista(:varId)";
        $conn->queryWithParams($sql, array(
            ":varId"=>$id
        ));
    }
    public static function selectAll(): array
    {
        $conn = new Connection();
        $sql = "Call SelectAllArtista()";
        $res = $conn->query($sql);
        while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
            $obj = self::rowToDto($row);
            $lista[] = $obj;
        }
        return $lista;
    }

    public static function selectByGeneros($id): array
    {
        $conn = new Connection();
        $sql = "Call SelectByGeneros(:varId)";
        $res = $conn->queryWithParams($sql, array(
            ":varId"=>$id
        ));
        while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
            $obj = self::rowToDto($row);
            $lista[] = $obj;
        }
        return $lista;
    }

    public static function selectById($id):?Artista
    {
        $conn = new Connection();
        $sql = "Call SelectByIdArtista(:id)";
        $res = $conn->queryWithParams($sql, array(
            ":id" => $id
        ));
        $row = $res->fetch(PDO::FETCH_ASSOC);
        $obj = self::rowToDto($row);
        return $obj;
    }
    public static function rowToDto($row):Artista
    {
        $obj = new Artista();
        $obj->setId($row["id"]);
        $obj->setNombre($row["nombre"]);
        $obj->setGenero($row["genero"]);
        return $obj;
    }
}