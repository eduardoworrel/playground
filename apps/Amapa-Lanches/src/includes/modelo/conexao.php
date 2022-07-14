<?php

date_default_timezone_set('America/Sao_Paulo');

class conexao {
    private $host;
    private $login;
    private $senha;
    private $instancia = null;

#METODO DA CLASSE conexão

    public function __construct() {
        $this->host = getenv("connectionString");
        $this->login = getenv("login");
        $this->senha = getenv("senha");
        $this->conecta();
    }

#METODO DA CLASSE conexão

    private function conecta() {
        if (is_null($this->instancia)) {
            $pdo = new PDO($this->host, $this->login, $this->senha, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
            $this->instancia = $pdo;
            return $pdo;
        } else {
            return $this->instancia;
        }
    }

    public function getconexao() {
        return $this->instancia;
    }

    public function getObject($parametrosDeBusca, $nomeDaFuncao) {
        $return = $this->$nomeDaFuncao($parametrosDeBusca, $this->instancia);
        return $return;
    }

    private function denunciaLanchonete($array, $instancia) {
        $id_lanchonete = $array[0];
        $id_usr = $array[1];
        $pst = $instancia->prepare("INSERT INTO denuncia_lanchonete (ID_LANCHONETE,ID_USUARIO)"
                . " VALUES(:idl,:idu)");
        $pst->bindParam(":idl", $id_lanchonete, PDO::PARAM_INT);
        $pst->bindParam(":idu", $id_usr, PDO::PARAM_INT);
        $pst->execute();
        if ($pst->rowCount() > 0) {
            return $pst->rowCount();
        } else {
            return -1;
        }
    }

    private function falsaLanchonete($array, $instancia) {
        if ($array[0] instanceof lanchonete) {
            $lan = $array[0];
            $pst = $instancia->prepare("UPDATE lanchonetes SET STATUS = 2 WHERE ID_LANCHONETE = :id");
            $pst->bindParam(":id", $lan->id);
            $pst->execute();
            if ($pst->rowCount() > 0) {
                return $pst->rowCount();
            } else {
                return -1;
            }
        }
    }

    private function proximas5($array, $instancia) {
        $pst = $instancia->prepare("SELECT *, (6371 *acos(
            cos(radians(:lat)) *
            cos(radians(LATITUDE)) *
            cos(radians(:lng) - radians(LONGITUDE)) +
            sin(radians(:lat)) *
            sin(radians(LATITUDE))
        )) AS distance
        FROM lanchonetes WHERE STATUS = 1 ORDER BY distance ASC LIMIT 5");
        $pst->bindParam(":lat", $array[0], PDO::PARAM_STR);
        $pst->bindParam(":lng", $array[1], PDO::PARAM_STR);
        $pst->execute();
        if ($pst->rowCount() > 0) {
            return $pst->fetchAll();
        } else {
            return -1;
        }
    }

    private function top5($array, $instancia) {
        $pst = $instancia->prepare("SELECT "
                . " al.ID_LANCHONETE,l.* "
                . " FROM"
                . " avaliacao_lanchonete al, lanchonetes l"
                . " WHERE"
                . " 1=1 "
                . " AND l.ID_LANCHONETE = al.ID_LANCHONETE "
                . " AND l.STATUS = 1"
                . " GROUP BY l.ID_LANCHONETE "
                . " ORDER BY AVG(al.AVALIACAO) DESC LIMIT 5");
        $pst->execute();
        if ($pst->rowCount() > 0) {
            return $pst->fetchAll();
        } else {
            return -1;
        }
    }

    private function aleatorioLanches($array, $instancia) {
        $pst = $instancia->prepare("SELECT *, lc.TITULO AS TITULO_LANCHE, l.TITULO AS TITULO_LANCHONETE,"
                . " lc.STATUS AS STATUS_LANCHE FROM lanchonetes l,cardapio c,lanche lc"
                . " WHERE"
                . " lc.ID_LANCHE = c.ID_LANCHE "
                . " AND c.ID_LANCHONETE = l.ID_LANCHONETE "
                . " AND lc.STATUS = 0 "
                . " AND l.STATUS = 1 "
                . "ORDER BY RAND() LIMIT 4");
        $pst->execute();
        if ($pst->rowCount() > 0) {
            return $pst->fetchAll();
        } else {
            return -1;
        }
    }

    private function sugestao($array, $instancia) {
        $pst = $instancia->prepare("SELECT * FROM lanchonetes l ,sugestao s "
                . " WHERE STATUS = 1 "
                . " AND l.ID_LANCHONETE = s.ID_LANCHONETE ORDER BY RAND() LIMIT 4");
        $pst->execute();
        if ($pst->rowCount() > 0) {
            return $pst->fetchAll();
        } else {
            return -1;
        }
    }

    private function caixaDePesquisa($array, $instancia) {
        $word = $array[0];
        $pst = $instancia->prepare("SELECT * from lanchonetes WHERE "
                . "TITULO like :word1 OR SUBTITULO like :word2");
        $pst->bindValue(":word1", "%$word%", PDO::PARAM_STR);
        $pst->bindValue(":word2", "%$word%", PDO::PARAM_STR);
        $pst->execute();
        if ($pst->rowCount() > 0) {
            return $pst->fetchAll();
        } else {
            return -1;
        }
    }

    private function myNear($array, $instancia) {
        $id = $array[0];
        $pst = $instancia->prepare("SELECT LONGITUDE,LATITUDE from lanchonetes WHERE ID_LANCHONETE =:id");
        $pst->bindParam(":id", $id, PDO::PARAM_INT);
        $pst->execute();
        $array = $pst->fetch();
        $pst = $instancia->prepare("SELECT *, (6371 *acos(
            cos(radians(:lat)) *
            cos(radians(LATITUDE)) *
            cos(radians(:lng) - radians(LONGITUDE)) +
            sin(radians(:lat)) *
            sin(radians(LATITUDE))
        )) AS distance
        FROM lanchonetes WHERE STATUS = 1 AND ID_LANCHONETE != :id ORDER BY distance ASC  LIMIT 4");
        $pst->bindParam(":id", $id, PDO::PARAM_STR);
        $pst->bindParam(":lat", $array['LATITUDE'], PDO::PARAM_STR);
        $pst->bindParam(":lng", $array['LONGITUDE'], PDO::PARAM_STR);
        $pst->execute();
        if ($pst->rowCount() > 0) {
            return $pst->fetchAll();
        } else {
            return -1;
        }
    }

    private function delNearAll($array, $instancia) {
        $lat = $array[0];
        $lng = $array[1];
        $pst = $instancia->prepare("SELECT *, (6371 *acos(
            cos(radians(:lat)) *
            cos(radians(LATITUDE)) *
            cos(radians(:lng) - radians(LONGITUDE)) +
            sin(radians(:lat)) *
            sin(radians(LATITUDE))
        )) AS distance
        FROM lanchonetes HAVING distance <= 50/1000 AND STATUS = 0");
        $pst->bindParam(":lat", $lat, PDO::PARAM_STR);
        $pst->bindParam(":lng", $lng, PDO::PARAM_STR);
        $pst->execute();
        $ar = $pst->fetchAll();
        if (is_array($ar)) {
            foreach ($ar as $l) {
                $lan = new lanchonete();
                $lan->id = $l['ID_LANCHONETE'];
                $this->falsaLanchonete([$lan], $instancia);
            }
        }
    }

    private function isNearAll($array, $instancia) {
        $lat = $array[0];
        $lng = $array[1];
        $pst = $instancia->prepare("SELECT *, (6371 *acos(
            cos(radians(:lat)) *
            cos(radians(LATITUDE)) *
            cos(radians(:lng) - radians(LONGITUDE)) +
            sin(radians(:lat)) *
            sin(radians(LATITUDE))
        )) AS distance
        FROM lanchonetes HAVING distance <= 50/1000 AND STATUS = 0");
        $pst->bindParam(":lat", $lat, PDO::PARAM_STR);
        $pst->bindParam(":lng", $lng, PDO::PARAM_STR);
        $pst->execute();
        if ($pst->rowCount() > 0) {
            return $pst->fetch()['ID_LANCHONETE'];
        } else {
            return -1;
        }
    }

    private function haveOther($array, $instancia) {
        $lat = $array[0];
        $lng = $array[1];
        $pst = $instancia->prepare("SELECT *, (6371 *acos(
            cos(radians(:lat)) *
            cos(radians(LATITUDE)) *
            cos(radians(:lng) - radians(LONGITUDE)) +
            sin(radians(:lat)) *
            sin(radians(LATITUDE))
        )) AS distance
        FROM lanchonetes HAVING distance <= 50/1000 AND STATUS = 0");
        $pst->bindParam(":lat", $lat, PDO::PARAM_STR);
        $pst->bindParam(":lng", $lng, PDO::PARAM_STR);
        $pst->execute();
        return $pst->rowCount();
    }

    private function isNear($array, $instancia) {
        $lat = $array[0];
        $lng = $array[1];
        $id = $array[2];
        $pst = $instancia->prepare("SELECT *, (6371 *acos(
            cos(radians(:lat)) *
            cos(radians(LATITUDE)) *
            cos(radians(:lng) - radians(LONGITUDE)) +
            sin(radians(:lat)) *
            sin(radians(LATITUDE))
        )) AS distance
        FROM lanchonetes HAVING distance <= 50/1000 AND STATUS = 0 AND ID_LANCHONETE = :id");
        $pst->bindParam(":lat", $lat, PDO::PARAM_STR);
        $pst->bindParam(":lng", $lng, PDO::PARAM_STR);
        $pst->bindParam(":id", $id, PDO::PARAM_INT);
        $pst->execute();
        return $pst->rowCount();
    }

    private function temLanchonete($array, $instancia) {

        $lat = $array[0];
        $lng = $array[1];
        $pst = $instancia->prepare("SELECT *, (6371 *acos(
            cos(radians(:lat)) *
            cos(radians(LATITUDE)) *
            cos(radians(:lng) - radians(LONGITUDE)) +
            sin(radians(:lat)) *
            sin(radians(LATITUDE))
        )) AS distance
        FROM lanchonetes HAVING distance <= 50/1000 
        AND STATUS = 1
");
        $pst->bindParam(":lat", $lat, PDO::PARAM_STR);
        $pst->bindParam(":lng", $lng, PDO::PARAM_STR);
        $pst->execute();
        return $pst->rowCount();
    }

    private function getAvaliation($array, $instancia) {
        $id = $array[0];
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

    private function salvaComentario($array, $instancia) {
        $comentario = $array[0];
        $id_lanchonete = $array[1];
        $id_usr = $array[2];
        $time = $array[3];
        $pst = $instancia->prepare("INSERT INTO comentario_lanchonete (ID_LANCHONETE,ID_USUARIO,COMENTARIO,DATAHORA,ATIVO)"
                . " VALUES(:idl,:idu,:cm,:dh,:at)");
        $pst->bindParam(":idl", $id_lanchonete, PDO::PARAM_INT);
        $pst->bindParam(":idu", $id_usr, PDO::PARAM_INT);
        $pst->bindParam(":cm", $comentario, PDO::PARAM_INT);
        $pst->bindParam(":dh", $time, PDO::PARAM_INT);
        $pst->bindValue(":at", 0);
        $pst->execute();
        return $pst->rowCount();
    }

    private function autenticaOnego($array, $instancia) {
        
    }

    private function checkKeyMaster($array, $instancia) {
        $keyMaster = $array[0];
        $pst = $instancia->prepare("SELECT * FROM usuario WHERE CHAVE_MESTRA = :KEY");
        $pst->bindParam(":KEY", $keyMaster);
        $pst->execute();
        if ($pst->rowCount() > 0) {
            return 0;
        } else {
            return 1;
        }
    }

    private function salvaUsuario($array, $instancia) {
        $pst = $instancia->prepare("SELECT * FROM usuario WHERE NUMERO = :NUMERO AND ATIVO = 1");
        $pst->bindParam(":NUMERO", $array[2]);
        $pst->execute();

        if ($pst->rowCount() > 0) {
            return -1;
        }
        if (true) {
            $pst = $instancia->prepare("INSERT INTO usuario"
                    . " (ID_USUARIO, SENHA, SALT, NUMERO, SIGNO,NASCIMENTO, CHAVE_MESTRA, ULTIMO_IPV4,  ULTIMO_ACESSO, ATIVO)"
                    . " VALUES"
                    . "(:ID_USUARIO,:SENHA,:SALT,:NUMERO,:SIGNO,:NASCIMENTO,:CHAVE_MESTRA,:ULTIMO_IPV4, :ULTIMO_ACESSO, :ATIVO)");
            $id = null;
            $pst->bindParam(":ID_USUARIO", $id);
            $pst->bindParam(":NUMERO", $array[2], PDO::PARAM_STR);
            $pst->bindParam(":SENHA", $array[3], PDO::PARAM_STR);
            $pst->bindParam(":SALT", $array[4], PDO::PARAM_STR);
            $pst->bindParam(":SIGNO", $array[8], PDO::PARAM_STR);
            $pst->bindParam(":NASCIMENTO", $array[9], PDO::PARAM_STR);
            $pst->bindParam(":CHAVE_MESTRA", $array[5], PDO::PARAM_STR);
            $pst->bindParam(":ULTIMO_IPV4", $array[6], PDO::PARAM_STR);
            $pst->bindParam(":ULTIMO_ACESSO", $array[7], PDO::PARAM_STR);
            $pst->bindValue(":ATIVO", 0);

            $pst->execute();
            $pst = $instancia->query("SELECT LAST_INSERT_ID()");
            $_id = $pst->fetchColumn();
            $pst = $instancia->prepare("INSERT INTO permissao_usuario (ID_PERMISSAO,ID_USUARIO,DATAHORA)"
                    . " VALUES(:ID_PERMISSAO,:ID_USUARIO,:DATAHORA)");
            $int = 2;
            $data = date('Y-m-d H:i');
            $pst->bindParam(":ID_PERMISSAO", $int, PDO::PARAM_INT);
            $pst->bindParam(":ID_USUARIO", $_id, PDO::PARAM_STR);
            $pst->bindParam(":DATAHORA", $data, PDO::PARAM_STR);
            $pst->execute();
            return $pst->rowCount();
        } else {
            return -3;
        }
        return -4;
    }

    private function acoplaLancheAoCardapio($ar, $instancia) {

        $idLanche = $ar[0];
        $idLanchonete = $ar[1];
        $pst = $instancia->prepare("INSERT INTO cardapio (ID_LANCHE,ID_LANCHONETE)"
                . " VALUES(:id_lanche,:id_lanchonete)");
        $pst->bindParam(":id_lanche", $idLanche);
        $pst->bindParam(":id_lanchonete", $idLanchonete);
        $pst->execute();
        return $pst->rowCount();
    }

    private function insereLanche(lanche $l, $instancia) {
        $titulo = $l->titulo;
        $preco = $l->preco;
        $ingredientes = $l->ingredientes;
        $status = 0;
        $sql = "INSERT INTO lanche (TITULO,PRECO,INGREDIENTES,STATUS) VALUES(:titulo, :preco,:ingredientes, :status)";
        $inserir = $instancia->prepare($sql);
        $inserir->bindParam(":titulo", $titulo, PDO::PARAM_LOB);
        $inserir->bindParam(":preco", $preco, PDO::PARAM_LOB);
        $inserir->bindParam(":ingredientes", $ingredientes, PDO::PARAM_LOB);
        $inserir->bindParam(":status", $status, PDO::PARAM_INT);
        $inserir->execute();
        $stmt = $instancia->query("SELECT LAST_INSERT_ID()");
        return $stmt->fetchColumn();
    }

    private function autenticarLanchonete($array, $instancia) {

        $lan = $array[0];
        $status = 1;
        $id = null;
        $lanches = $lan->cardapio->lanches;
        $sql = "INSERT INTO lanchonetes "
                . "(ID_LANCHONETE, TITULO ,SUBTITULO, BAIRRO, INFORMATIVO, TELEFONE, ENTREGA, ACEITA_CARTAO, HORA_ABRE,   HORA_FECHA,STATUS,LONGITUDE,LATITUDE)  "
                . " VALUES(:ID_LANCHONETE,:TITULO,:SUBTITULO,:BAIRRO, :INFORMATIVO, :TELEFONE , :ENTREGA,:CARTAO, :HORA_ABRE , :HORA_FECHA,:STATUS,:LONGITUDE,:LATITUDE)";
        $update = $instancia->prepare($sql);
        $update->bindParam(":ID_LANCHONETE", $id);
        $update->bindParam(":TITULO", $lan->titulo, PDO::PARAM_STR);
        $update->bindParam(":SUBTITULO", $lan->subTitulo, PDO::PARAM_STR);
        $update->bindParam(":BAIRRO", $lan->bairro, PDO::PARAM_STR);
        $update->bindParam(":INFORMATIVO", $lan->informativo, PDO::PARAM_STR);
        $update->bindParam(":TELEFONE", $lan->telefone, PDO::PARAM_STR);
        $update->bindParam(":ENTREGA", $lan->entrega, PDO::PARAM_STR);
        $update->bindParam(":CARTAO", $lan->aceita_cartao, PDO::PARAM_STR);
        $update->bindParam(":HORA_ABRE", $lan->horaAbre, PDO::PARAM_STR);
        $update->bindParam(":HORA_FECHA", $lan->horaFecha, PDO::PARAM_STR);
        $update->bindParam(":STATUS", $status, PDO::PARAM_INT);
        $update->bindParam(":LONGITUDE", $lan->longitude, PDO::PARAM_STR);
        $update->bindParam(":LATITUDE", $lan->latitude, PDO::PARAM_STR);
        $update->execute();
        $pst = $instancia->query("SELECT LAST_INSERT_ID()");
        $_id = $pst->fetchColumn();
        if (count($lanches) > 0) {
            foreach ($lanches as $l) {
                $id_lanche = $this->insereLanche($l, $instancia);
                $this->acoplaLancheAoCardapio([$id_lanche, $_id], $instancia);
            }
        }
        return $update->rowCount();
    }

    private function insereLanchonete($array, $instancia) {
        $lng = $array[0];
        $lat = $array[1];
        $status = 0;
        $sql = "INSERT INTO lanchonetes (LONGITUDE,LATITUDE,STATUS) VALUES(:lng, :lat, :status)";
        $inserir = $instancia->prepare($sql);
        $inserir->bindParam(":lng", $lng, PDO::PARAM_LOB);
        $inserir->bindParam(":lat", $lat, PDO::PARAM_LOB);
        $inserir->bindParam(":status", $status, PDO::PARAM_INT);
        $inserir->execute();
        return $inserir->rowCount();
    }

    private function lanchonetes($array, $instancia) {
        $sql = "SELECT * FROM lanchonetes WHERE STATUS = :s";
        $pst = $instancia->prepare($sql);
        $pst->bindParam(":s", $array[0], PDO::PARAM_INT);
        $pst->execute();
        $results = $pst->fetchAll();
        $ls = [];
        foreach ($results as $lanchonete) {
            $l = new lanchonete();
            $l->id = $lanchonete['ID_LANCHONETE'];
            $l->titulo = $lanchonete['TITULO'];
            $l->longitude = $lanchonete['LONGITUDE'];
            $l->latitude = $lanchonete['LATITUDE'];
            $l->cardapio->lanches = array();
            $l->cardapio->lanches = array_merge($l->cardapio->lanches, $this->lanches([$l->id], $instancia));
            $ls = array_merge($ls, [$l]);
        }

        return $ls;
    }

    //para o adminitstrador
    private function _lanchonetes($array, $instancia) {
        $sql = "SELECT * FROM lanchonetes WHERE STATUS != 0 AND STATUS != 2  ORDER BY STATUS DESC";
        $pst = $instancia->prepare($sql);
        $pst->execute();
        $results = $pst->fetchAll();
        $ls = [];
        foreach ($results as $lanchonete) {
            $l = new lanchonete();
            $l->id = $lanchonete['ID_LANCHONETE'];
            $l->titulo = $lanchonete['TITULO'];
            $l->longitude = $lanchonete['LONGITUDE'];
            $l->latitude = $lanchonete['LATITUDE'];
            $l->cardapio->lanches = array();
            $l->cardapio->lanches = array_merge($l->cardapio->lanches, $this->lanches([$l->id], $instancia));
            $ls = array_merge($ls, [$l]);
        }

        return $ls;
    }

    //para o adminitstrador
    private function _usuarios($array, $instancia) {
        $sql = "SELECT * FROM usuario u ,permissao_usuario pu"
                . "  WHERE u.ID_USUARIO = pu.ID_USUARIO";
        $pst = $instancia->prepare($sql);
        $pst->execute();
        $results = $pst->fetchAll();
        $ls = [];
        foreach ($results as $usuario) {
            $l = new usuario();
            $l->id = $usuario['ID_USUARIO'];
            $l->permissao = $usuario['ID_PERMISSAO'];
            $l->nome = $usuario['APELIDO'];
            $l->email = $usuario['EMAIL'];
            $ls = array_merge($ls, [$l]);
        }

        return $ls;
    }

    private function lanches($array, $instancia) {

        $id = $array[0];

        $sql = "SELECT L.* FROM lanche L WHERE L.ID_LANCHONETE = :id"
                . " ORDER BY CAST(PRECO AS UNSIGNED) ASC";

        $pst = $instancia->prepare($sql);
        $pst->bindParam(":id", $id, PDO::PARAM_INT);
        $pst->execute();
        $results = $pst->fetchAll();
        $ls = [];
        foreach ($results as $lanche) {
            $l = new lanche();
            $l->id = $lanche['ID_LANCHE'];
            $l->titulo = $lanche['TITULO'];
            $l->preco = $lanche['PRECO'];
            $l->ingredientes = $lanche['INGREDIENTES'];
            $l->positivo = $this->positivoLanche($l->id, $id);
            $l->negativo = $this->negativoLanche($l->id, $id);
            $ls[] = $l;
        }
        return $ls;
    }

    private function buscaLanchoneteById($array, $instancia) {
        $sql = "SELECT * FROM lanchonetes WHERE ID_LANCHONETE = :id";
        $pst = $instancia->prepare($sql);
        $pst->bindParam(":id", $array[0], PDO::PARAM_INT);
        $pst->execute();
        $lanchonete = $pst->fetch();
        $l = new lanchonete();
        $l->id = $lanchonete['ID_LANCHONETE'];
        $l->longitude = $lanchonete['LONGITUDE'];
        $l->latitude = $lanchonete['LATITUDE'];
        return $l;
    }

    public function comentariosLanchonete($id) {

        $sql = "SELECT COMENTARIO,ID_USUARIO FROM comentario_lanchonete WHERE ID_LANCHONETE = :id";
        $pst = $this->instancia->prepare($sql);
        $pst->bindParam(":id", $id, PDO::PARAM_INT);
        $pst->execute();
        $result = $pst->fetchAll();
        $arr = array();

        foreach ($result as $comentario) {
            $c = new comentario();
            $c->nomeAutor = $this->getUsuarioById($comentario['ID_USUARIO'])->nome;
            $c->comentario = $comentario['COMENTARIO'];
            $arr = array_merge($arr, [$c]);
        }
        return $arr;
    }

    private function positivoLanchonete($id) {
        $sql = "SELECT * FROM avaliacao_lanchonete WHERE ID_LANCHONETE = :id AND AVALIACAO = 1";
        $pst = $this->instancia->prepare($sql);
        $pst->bindParam(":id", $id, PDO::PARAM_INT);
        $pst->execute();
        return $pst->rowCount();
    }

    private function negativoLanchonete($id) {
        $sql = "SELECT * FROM avaliacao_lanchonete WHERE ID_LANCHONETE = :id AND AVALIACAO = -1";
        $pst = $this->instancia->prepare($sql);
        $pst->bindParam(":id", $id, PDO::PARAM_INT);
        $pst->execute();
        return $pst->rowCount();
    }

    private function positivoLanche($id_che, $id_te) {
        $sql = "SELECT * FROM avaliacao_lanche WHERE ID_LANCHONETE = :id_te AND ID_LANCHE = :id_che  AND AVALIACAO = 1";
        $pst = $this->instancia->prepare($sql);
        $pst->bindParam(":id_che", $id_che, PDO::PARAM_INT);
        $pst->bindParam(":id_te", $id_te, PDO::PARAM_INT);
        $pst->execute();
        return $pst->rowCount();
    }

    private function negativoLanche($id_che, $id_te) {
        $sql = "SELECT * FROM avaliacao_lanche WHERE ID_LANCHONETE = :id_te AND ID_LANCHE = :id_che AND AVALIACAO = -1";
        $pst = $this->instancia->prepare($sql);
        $pst->bindParam(":id_che", $id_che, PDO::PARAM_INT);
        $pst->bindParam(":id_te", $id_te, PDO::PARAM_INT);
        $pst->execute();
        return $pst->rowCount();
    }

    private function getUsuarioById($id) {
        $sql = "SELECT * FROM usuario WHERE ID_USUARIO = :id";
        $pst = $this->instancia->prepare($sql);
        $pst->bindParam(":id", $id, PDO::PARAM_INT);
        $pst->execute();
        $user = $pst->fetch();
        $usuario = new usuario();
        $usuario->nome = $user['APELIDO'];
        return $usuario;
    }

}
