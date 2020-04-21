<?php


namespace Repository;


use Model\Usuario;
use Pummax\Repository\BaseRepository;

class UsuarioRepository extends BaseRepository
{

    public function createQueryConsulta()
    {
        $query = parent::createQueryConsulta();
        $query->andWhere('Usuario.tipo = :admin');
        $query->setParameter('admin', Usuario::TIPO_ADMIN);
        return $query;
    }

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