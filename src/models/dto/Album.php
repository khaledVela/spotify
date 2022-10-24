<?php

namespace App\models\dto;

class Album
{
    public $id;
    public $nombre;
    public $artista;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function getArtista()
    {
        return $this->artista;
    }

    public function setArtista($artista)
    {
        $this->artista = $artista;
    }
}