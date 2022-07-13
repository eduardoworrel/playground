<?php

class lanche {
    private $id;
    protected $titulo;
    protected $preco;
    protected $ingredientes;
    protected $nota;
    protected $positivo;
    protected $negativo;

    public function __set($name, $value) {
        $this->$name = $value;
    }

    public function __get($name) {
        return $this->$name;
    }

}
