<?php


namespace Repository;


use Model\Curso;
use Pummax\Repository\BaseRepository;

class CursoRepository extends BaseRepository
{
    public function getList(){
        /** @var $cursos Curso[]*/
        $cursos = $this->findAll();
        $list = [];
        foreach ($cursos as $curso){
            $list[] = [
               'id' => $curso->getId(),
               'nome' => $curso->getNome(),
            ];
        }
        return $list;
    }

}