<?php

namespace App\models\bll;

use App\models\dal\Connection;
use App\models\dto\Genero;
use PDO;
use PDOException;

class GeneroBLL
{
    public static function insert($nombre): int
    {
        $conn = new Connection();
        $sql = "Call InsertGenero(:nombre);";
        $conn->queryWithParams($sql, array(
            ":nombre" => $nombre
        ));
        return $conn->getLastInsertedId();
    }

    public static function update($nombre, $id)
    {
        $conn = new Connection();
        $sql = "Call UpdateGenero(:nombre,:id);";
        $conn->queryWithParams($sql, array(
            ":nombre" => $nombre,
            ":id" => $id
        ));
    }

    public static function delete($id)
    {
        $conn = new Connection();
        $sql = "Call DeleteGenero(:id);";
        $conn->queryWithParams($sql, array(
            ":id" => $id
        ));
    }

    public static function selectAll(): array
    {
        try{
            $lista=[];
            $conn = new Connection();
            $sql = "Call SelectAllGenero();";
            $res = $conn->query($sql);
            while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
                $obj = self::rowToDto($row);
                $lista[] = $obj;
            }
            return $lista;
        }catch (PDOException $e){
            $_SESSION['error'] = $e->getMessage();
        }
        return [];
    }

    public static function selectById($id):?Genero
    {
        $conn = new Connection();
        $sql = "Call SelectByIdGenero(:id);";
        $res = $conn->queryWithParams($sql, array(
            ":id" => $id
        ));
        $row = $res->fetch(PDO::FETCH_ASSOC);
        $obj = self::rowToDto($row);
        return $obj;
    }

    private static function rowToDto($row):Genero
    {
        $obj = new Genero();
        $obj->setId($row["id"]);
        $obj->setNombre($row["nombre"]);
        return $obj;
    }
}