<?php


namespace Repository;


use Pummax\Repository\BaseRepository;

class UsuarioRepository extends BaseRepository
{

    public function validaLogin($login, $senha){
        $sql = "SELECT * 
                  FROM usuarios 
                 WHERE usu_login = :login 
                   AND usu_senha = :senha";
        $params = [
            'login' => $login,
            'senha' => $senha,
        ];
        $st = $this->getEntityManager()->getConnection()->executeQuery($sql, $params);
        $result = $st->fetchAll();
        $st->closeCursor();
        return $result;
    }
}