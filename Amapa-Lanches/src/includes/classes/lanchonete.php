<?php

include_once 'cardapio.php';

class lanchonete {

    private $id = null;
    private $isOpen = 0;
    private $titulo;
    private $subTitulo;
    private $bairro;
    private $informativo;
    private $horaAbre;
    private $horaFecha;
    private $telefone;
    private $entrega;
    private $aceita_cartao;
    private $longitude;
    private $latitude;
    private $endereco; //objeto da classe endereco
    private $cardapio;
    private $positivo;
    private $negativo;
    private $comentarios;
    private $view;

    public function __construct() {
        $this->cardapio = new cardapio();
    }

    public function __set($atributo, $value) {
        $this->{$atributo} = $value;
    }

    public function &__get($atributo) {
        return $this->{$atributo};
    }

    public static function visto($idl, $instancia) {
        $sql = "SELECT * FROM lanchonete_vista WHERE 1=1"
                . " AND ID_LANCHONETE = :ID_LANCHONETE";
        $pst = $instancia->prepare($sql);
        $pst->bindParam(":ID_LANCHONETE", $idl, PDO::PARAM_INT);
        $pst->execute();
        return $pst->rowCount();
    }

    public static function salvaAvaliacao($array, $instancia) {
        $avaliacao = $array[0];
        $id_lanchonete = $array[1];
        $id_usr = $array[2];
        $time = $array[3];
        $sql = "SELECT AVALIACAO FROM avaliacao_lanchonete WHERE 1=1"
                . " AND ID_USUARIO = :ID_USUARIO AND ID_LANCHONETE = :ID_LANCHONETE";
        $pst = $instancia->prepare($sql);
        $pst->bindParam(":ID_USUARIO", $id_usr, PDO::PARAM_INT);
        $pst->bindParam(":ID_LANCHONETE", $id_lanchonete, PDO::PARAM_INT);
        $pst->execute();
        if ($pst->rowCount() < 1) {
            $pst = $instancia->prepare("INSERT INTO avaliacao_lanchonete (ID_LANCHONETE,ID_USUARIO,AVALIACAO)"
                    . " VALUES(:idl,:idu,:av)");
            $pst->bindParam(":idl", $id_lanchonete, PDO::PARAM_INT);
            $pst->bindParam(":idu", $id_usr, PDO::PARAM_INT);
            $pst->bindParam(":av", $avaliacao, PDO::PARAM_INT);
            $pst->execute();
            return $pst->rowCount();
        } else {
            if ($pst->fetch()["AVALIACAO"] !== $avaliacao) {
                $pst = $instancia->prepare("UPDATE avaliacao_lanchonete SET AVALIACAO = :av WHERE ID_LANCHONETE = :idl"
                        . " AND ID_USUARIO = :idu");
                $pst->bindParam(":idl", $id_lanchonete, PDO::PARAM_INT);
                $pst->bindParam(":idu", $id_usr, PDO::PARAM_INT);
                $pst->bindParam(":av", $avaliacao, PDO::PARAM_INT);
                $pst->execute();
            }
        }
        return 0;
    }

    public static function vistoByUsuario($idss, $idl, $instancia) {
        $sql = "SELECT * FROM lanchonete_vista WHERE 1=1"
                . " AND ID_SESSAO = :ID_SESSAO AND ID_LANCHONETE = :ID_LANCHONETE";
        $pst = $instancia->prepare($sql);
        $pst->bindParam(":ID_SESSAO", $idss, PDO::PARAM_STR);
        $pst->bindParam(":ID_LANCHONETE", $idl, PDO::PARAM_INT);
        $pst->execute();
        $results = $pst->rowCount();
        if (!($results > 0)) {
            $time = date('Y-m-d H:i:s') . "." . round(microtime(true) * 1000);
            $sql = "INSERT INTO lanchonete_vista (ID_SESSAO,ID_LANCHONETE,DATAHORA)"
                    . " VALUES (:IDS,:IDL,:DH)";
            $pst = $instancia->prepare($sql);
            $pst->bindParam(":IDS", $idss, PDO::PARAM_STR);
            $pst->bindParam(":IDL", $idl, PDO::PARAM_INT);
            $pst->bindParam(":DH", $time, PDO::PARAM_STR);
            $pst->execute();
        }
    }

    public static function todas($instancia) {
        $sql = "SELECT * FROM lanchonetes WHERE 1=1 AND STATUS = 1 ORDER BY rand()";
        $pst = $instancia->prepare($sql);
        $pst->execute();
        $results = $pst->fetchAll();
        $ls = [];
        foreach ($results as $lanchonete) {
            $l = new lanchonete();
            $l->id = $lanchonete['ID_LANCHONETE'];
            $l->titulo = $lanchonete['TITULO'];
            $l->subTitulo = $lanchonete['SUBTITULO'];
            $l->horaAbre = $lanchonete['HORA_ABRE'];
            $l->horaFecha = $lanchonete['HORA_FECHA'];
            $l->longitude = $lanchonete['LONGITUDE'];
            $l->latitude = $lanchonete['LATITUDE'];
            $l->bairro = $lanchonete['BAIRRO'];
            $l->bairro = $lanchonete['BAIRRO'];
            $l->aceita_cartao = $lanchonete['ACEITA_CARTAO'];
            $l->entrega = $lanchonete['ENTREGA'];
          $ls = array_merge($ls, [$l]);
        }

        return $ls;
    }

    public static function countComentario($id, $instancia) {
        $pst = $instancia->prepare("SELECT COUNT(*) AS COUNT FROM comentario_lanchonete c, usuario u WHERE 1=1 "
                . "AND u.ID_USUARIO = c.ID_USUARIO AND ID_LANCHONETE =:id AND u.ativo = 1");
        $pst->bindParam(":id", $id, PDO::PARAM_INT);
        $pst->execute();
        return $pst->fetch()['COUNT'];
    }

    public static function avaliacao($id, $instancia) {
        $pst = $instancia->prepare("SELECT * FROM avaliacao_lanchonete WHERE ID_LANCHONETE =:id");
        $pst->bindParam(":id", $id, PDO::PARAM_INT);
        $pst->execute();
        $count = 0;
        $int = 0;
        foreach ($pst->fetchAll() as $uno) {
            $int += $uno["AVALIACAO"];
            $count ++;
        }
        if ($count > 0 && $int > 0) {
            return $int / $count;
        } else {
            return -1;
        }
    }

    public static function lanches($id, $instancia) {
        $sql = "SELECT L.* FROM lanche L WHERE L.ID_LANCHONETE = :id"
                . " ORDER BY CAST(L.PRECO AS DECIMAL) ASC";

        $pst = $instancia->prepare($sql);
        $pst->bindParam(":id", $id, PDO::PARAM_INT);
        $pst->execute();
        $results = $pst->fetchAll();
        $ls = array();
        foreach ($results as $lanche) {
            $l = new lanche();
            $l->id = $lanche['ID_LANCHE'];
            $l->titulo = $lanche['TITULO'];
            $l->preco = $lanche['PRECO'];
            $l->ingredientes = $lanche['INGREDIENTES'];
            $ls[] = (array(
                "id" => $l->id,
                "titulo" => $l->titulo,
                "preco" => $l->preco,
                "ingredientes" => $l->ingredientes,
            ));
        }
        return $ls;
    }

    public static function comentarios(int $id, int $limit, $instancia) {
        include_once '../timeAgo.php';
        if ($limit == 3) {
            $s = 0;
            $sql = "SELECT"
                    . " c.COMENTARIO,c.DATAHORA, u.SIGNO,u.NASCIMENTO FROM comentario_lanchonete c,usuario u "
                    . "WHERE"
                    . " ID_LANCHONETE = :id "
                    . " AND c.ID_USUARIO = u.ID_USUARIO"
                    . " AND u.ATIVO = 1 ORDER BY DATAHORA DESC LIMIT 0,:E ";
            $pst = $instancia->prepare($sql);
            $pst->bindParam(":id", $id, PDO::PARAM_INT);
            $pst->bindParam(":E", $limit, PDO::PARAM_INT);
        } else {
            $s = $limit - 3;
            $sql = "SELECT c.COMENTARIO,c.DATAHORA, u.SIGNO,u.NASCIMENTO FROM comentario_lanchonete c,usuario u WHERE ID_LANCHONETE = :id "
                    . " AND c.ID_USUARIO = u.ID_USUARIO  AND u.ATIVO = 1 ORDER BY DATAHORA DESC LIMIT :S,:E ";
            $pst = $instancia->prepare($sql);
            $pst->bindParam(":id", $id, PDO::PARAM_INT);
            $pst->bindParam(":S", $s, PDO::PARAM_INT);
            $pst->bindValue(":E", 3, PDO::PARAM_INT);
        }
        $pst->execute();
        $result = $pst->fetchAll();
        $arr = array();

        foreach ($result as $comentario) {

            $arr[] = array("limit" => $s,
                "signo" => $comentario['SIGNO'],
                "comentario" => $comentario['COMENTARIO'],
                "dataHora" => time_elapsed_string($comentario['DATAHORA']),
                "idade" => time_elapsed_string($comentario['NASCIMENTO'], false, true)
            );
        }
        return $arr;
    }

    public static function detalhe($id, $instancia) {
        $sql = "SELECT"
                . " ID_LANCHONETE,"
                . "TITULO,"
                . "SUBTITULO,"
                . "INFORMATIVO,"
                . "ENTREGA,"
                . "TELEFONE,"
                . "HORA_ABRE,"
                . "HORA_FECHA,"
                . "LONGITUDE,"
                . "LATITUDE,"
                . "ACEITA_CARTAO"
                . " FROM lanchonetes WHERE ID_LANCHONETE = :id";
        $pst = $instancia->prepare($sql);
        $pst->bindParam(":id", $id, PDO::PARAM_INT);
        $pst->execute();
        $lanchonete = $pst->fetch();
        $l = new lanchonete();
        $l->id = $lanchonete['ID_LANCHONETE'];
        $l->titulo = $lanchonete['TITULO'];
        $l->subTitulo = $lanchonete['SUBTITULO'];
        $l->informativo = $lanchonete['INFORMATIVO'];
        $l->bairro = $lanchonete['BAIRRO'];
        $l->telefone = $lanchonete['TELEFONE'];
        $hra = explode(":", $lanchonete['HORA_ABRE']);
        $l->horaAbre = $hra[0] . ":" . $hra[1];
        $hrf = explode(":", $lanchonete['HORA_FECHA']);
        $l->horaFecha = $hrf[0] . ":" . $hrf[1];
        $l->longitude = $lanchonete['LONGITUDE'];
        $l->latitude = $lanchonete['LATITUDE'];
        $l->aceita_cartao = $lanchonete['ACEITA_CARTAO'];
        $l->entrega = $lanchonete['ENTREGA'];
        return $l;
    }

}
