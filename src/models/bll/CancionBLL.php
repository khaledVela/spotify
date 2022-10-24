<?php

namespace App\models\bll;

use App\models\dal\Connection;
use App\models\dto\Cancion;
use PDO;
use PDOException;

class CancionBLL
{
    public static function insert($nombre, $album_id): int
    {
        $conn = new Connection();
        $sql = "Call InsertCancion(:varNombres, :varAlbum)";
        $conn->queryWithParams($sql, array(
            ":varNombres" => $nombre,
            ":varAlbum" => $album_id
        ));
        return $conn->getLastInsertedId();
    }

    public static function update($nombre, $album_id, $id)
    {
        $conn = new Connection();
        $sql = "Call UpdateCancion(:varNombres, :varAlbum, :varId)";
        $conn->queryWithParams($sql, array(
            ":varNombres" => $nombre,
            ":varAlbum" => $album_id,
            ":varId" => $id
        ));
    }

    public static function delete($id)
    {
        $conn = new Connection();
        $sql = "Call DeleteCancion(:varId)";
        $conn->queryWithParams($sql, array(
            ":varId" => $id
        ));
    }

    public static function selectAll(): array
    {
        $conn = new Connection();
        $sql = "Call SelectAllCancion();";
        $res = $conn->query($sql);
        while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
            $obj = self::rowToDto($row);
            $lista[] = $obj;
        }
        return $lista;
    }

    public static function selectById($id): ?Cancion
    {
        $conn = new Connection();
        $sql = "Call SelectByIdCancion(:id);";
        $res = $conn->queryWithParams($sql, array(
            ":id" => $id
        ));
        $row = $res->fetch(PDO::FETCH_ASSOC);
        $obj = self::rowToDto($row);
        return $obj;
    }

    public static function rowToDto($row): ?Cancion
    {
        $obj = new Cancion();
        $obj->setId($row["id"]);
        $obj->setNombre($row["nombre"]);
        $obj->setAlbum($row["album_id"]);
        return $obj;
    }
}
