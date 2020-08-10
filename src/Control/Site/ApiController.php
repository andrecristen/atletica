<?php


namespace Control\Site;


use Model\Carteira;
use Model\Usuario;
use Pummax\Configuration\DataBase;
use Pummax\Controller\BaseApiController;
use Pummax\Response\ApiResponse;
use Repository\UsuarioRepository;

class ApiController extends BaseApiController
{

    public function login()
    {
        $request = $this->getRequest();
        if (isset($request['login']) && isset($request['password'])) {
            /** @var $repositorio UsuarioRepository*/
            $repositorio = $this->getEntityManager()->getRepository(Usuario::class);
            $usuario = $repositorio->validaLogin($request['login'], $request['password']);
            if($usuario && isset($usuario[0])){
                /** @var $usuarioModel Usuario*/
                $usuarioModel = $repositorio->find($usuario[0]['usu_id']);
                /** @var $carteiraModel Carteira*/
                $carteiraModel = $this->getEntityManager()->getRepository(Carteira::class)->findOneBy(['usuario' => $usuarioModel]);
                $id = null;
                $dataVencimento = null;
                $imagem = null;
                $curso = null;
                if($carteiraModel){
                    $id = $carteiraModel->getId();
                    $dataVencimento =  $carteiraModel->getDataVencimento()->format('d/m/Y');
                    $imagem = DataBase::URL_SITE."utils/".$carteiraModel->getImagem()->getPatch();
                    $curso = $carteiraModel->getCurso()->getNome();
                }
                $data = [
                    'id' => $id,
                    'curso' => $curso,
                    'usuario' => [
                        'id' => $usuarioModel->getId(),
                        'login' => $usuarioModel->getLogin(),
                        'pessoa' => [
                            'nome' => $usuarioModel->getPessoa()->getNome(),
                            'sobrenome' => $usuarioModel->getPessoa()->getSobrenome(),
                            'cpf' => $usuarioModel->getPessoa()->getCpf(),
                            'matricula' => $usuarioModel->getPessoa()->getMatricula(),
                            'dataNascimento' => $usuarioModel->getPessoa()->getDataNascimento()->format('d/m/Y'),
                        ],
                        'token' => $usuarioModel->getToken(),
                        'tipo' => $usuarioModel->getTipo(),
                    ],
                    'dataVencimento' => $dataVencimento,
                    'imagem' => $imagem
                ];
                return new ApiResponse(true, "Login efetuado com sucesso", $data);
            }else{
                return new ApiResponse(false, "Não localizado usuário para os parâmetros informados");
            }
        } else {
            return new ApiResponse(false, "Não localizado parâmetros para execução da requisição");
        }
    }

}