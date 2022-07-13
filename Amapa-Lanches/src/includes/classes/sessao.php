<?php

define('SECURITY_HASH', 'Jully Scooby Layssa Eduardo Marina Joseane Raimundo');

class sessao {

    private $ipv4;
    private $userAgent;
    private $ultima_interacao_sessao;
    private $primeiro_token;
    private $ultimo_token;
    private $status = 0;
    private $usuario = 0;

    public function __construct($ar) {
        if (is_array($ar) && count($ar) > 1) {
            $this->primeiro_token = $ar[0];
            $this->ipv4 = $ar[1];
            $this->userAgent = $ar[2];
            $this->ultimo_token = $ar[3];
            $this->ultima_interacao_sessao = $ar[4];
            $this->usuario = $ar[5];
            $this->status = 1;
        } else {
            $this->ipv4 = $_SERVER["REMOTE_ADDR"];
            $this->userAgent = $_SERVER['HTTP_USER_AGENT'];
            $this->usuario = $ar[0];
            $this->status = 0;
        }
    }

    public function check($ins) {
        if ($this->status === 1) {
            $ipv4 = $_SERVER["REMOTE_ADDR"];
            $ua = $_SERVER['HTTP_USER_AGENT'];
            if ($ins !== null) {
                $pst = $ins->prepare("SELECT"
                        . " a.* "
                        . " FROM usuario u, acesso a, permissao_usuario p "
                        . " WHERE u.ID_USUARIO = a.ID_USUARIO"
                        . " AND p.ID_USUARIO = a.ID_USUARIO"
                        . " AND a.ID_USUARIO = :ID_USUARIO ORDER BY ULTIMA_INTERACAO_SESSAO DESC LIMIT 1");
                $pst->bindParam(":ID_USUARIO", $this->usuario->id, PDO::PARAM_INT);
                $pst->execute();
                $r = $pst->fetch();
                if (is_array($r)) {
                    $uis = new DateTime($r['ULTIMA_INTERACAO_SESSAO']);
                    $time = new DateTime(date('Y-m-d H:i:s'));
                    $dif = (int) $uis->diff($time)->format("%i");
                    
                    if ($dif < 30 && $ipv4 == $r['IPV4'] && $ua == $r['USERAGENT']) {
                        return true;
                    } else {
                        return false;
                    }
                }
            }
        } else {
            return false;
        }
    }

    public function __set($name, $value) {
        $this->$name = $value;
    }

    public function &__get($name) {
        return $this->$name;
    }

}
