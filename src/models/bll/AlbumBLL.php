<?php

namespace App\models\bll;

use App\models\dal\Connection;
use App\models\dto\Album;

class AlbumBLL
{
    public static function insert($nombre, $artista_id):int
    {
        $conn = new Connection();
        $sql = "Call InsertAlbum(:varNombres, :varArtista)";
        $conn->queryWithParams($sql, array(
            ":varNombres" => $nombre,
            ":varArtista" => $artista_id
        ));
        return $conn->getLastInsertedId();
    }

    public static function update($nombre, $artista_id, $id)
    {
        $conn = new Connection();
        $sql = "Call UpdateAlbum(:varNombres, :varArtista, :varId)";
        $conn->queryWithParams($sql, array(
            ":varNombres" => $nombre,
            ":varArtista" => $artista_id,
            ":varId" => $id
        ));
    }

    public static function delete($id)
    {
        $conn = new Connection();
        $sql = "Call DeleteAlbum(:varId)";
        $conn->queryWithParams($sql, array(
            ":varId" => $id
        ));
    }

    public static function selectAll(): array
    {
        $conn = new Connection();
        $sql = "Call SelectAllAlbum()";
        $res = $conn->query($sql);
        while ($row = $res->fetch(\PDO::FETCH_ASSOC)) {
            $obj = self::rowToDto($row);
            $lista[] = $obj;
        }
        return $lista;
    }

    public static function selectByArtista($id): array
    {
        $conn = new Connection();
        $sql = "Call SelectByArtista(:varId)";
        $res = $conn->queryWithParams($sql, array(
            ":varId"=>$id
        ));
        while ($row = $res->fetch(\PDO::FETCH_ASSOC)) {
            $obj = self::rowToDto($row);
            $lista[] = $obj;
        }
        return $lista;
    }

    public static function selectById($id): ?Album
    {
        $conn = new Connection();
        $sql = "Call SelectByIdAlbum(:id)";
        $res = $conn->queryWithParams($sql, array(
            ":id" => $id
        ));
        $row = $res->fetch(\PDO::FETCH_ASSOC);
        $obj = self::rowToDto($row);
        return $obj;
    }

    public static function rowToDto($row): Album
    {
        $obj = new Album();
        $obj->setId($row["id"]);
        $obj->setNombre($row["nombre"]);
        $obj->setArtista($row["artista_id"]);
        return $obj;
    }
}