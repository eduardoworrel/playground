<?php

class comentario {

    private $nomeAutor;
    private $comentario;
    private $dataHora;

    public function __set($name, $value) {
        $this->$name = $value;
    }

    public function __get($name) {
        return $this->$name;
        
    }

}
