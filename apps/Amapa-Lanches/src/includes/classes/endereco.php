<?php
class endereco{
    private $numero_casa;
    private $rua;
    private $bairro;
    private $cidade;
    private $estado;
    private $longitude;
    private $latitude;
    function __construct($numero_casa,$rua,$bairro,$cidade,$estado,$longitude,$latitude) {
        $this->numero_casa = $numero_casa;
        $this->rua = $rua;
        $this->bairro = $bairro;
        $this->cidade = $cidade;
        $this->estado = $estado;
        $this->latitude = $latitude;
        $this->longitude = $longitude;
    }
    
    public function __set($atributo, $value) {
        $this->$atributo = $value;
    }
    public function __get($atributo) {
        return $this->$atributo;
    }
}