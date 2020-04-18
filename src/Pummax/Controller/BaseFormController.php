<?php


namespace Pummax\Controller;

use Pummax\Response\FormResponse;
use Pummax\Response\MessageResponse;
use Pummax\Util\StringUtil;
use Pummax\View\Form\AbstractForm;

abstract class BaseFormController extends BaseController
{

    protected $model;

    protected $modelIsLoaded;

    protected $view;

    protected $data = [];

    protected $formBean;

    public function __construct()
    {
        parent::__construct();
        $this->setView($this->createInstanceView());
        $this->setModel($this->createInstanceModel());
    }

    /**
     * @return AbstractForm
     */
    abstract public function createInstanceView();

    /**
     * @return object
     */
    abstract public function createInstanceModel();


    public function add(){
        if($this->isPost()){
            try{
                $this->getEntityManager()->beginTransaction();
                $this->addPost();
                $this->getEntityManager()->commit();
                $success = true;
                $message = 'Sucesso ao realizar operação';
            }catch (\Exception $exception){
                if($this->getEntityManager()->getConnection()->isTransactionActive()){
                    $this->getEntityManager()->rollback();
                }
                $success = false;
                $message = 'Erro ao realizar operação, erro recebido: '.$exception->getMessage();
            }
            return new MessageResponse($success, $message);
        }else{
            return new FormResponse($this->getView(), $this->getView()->getButtons());
        }
    }

    protected function addPost()
    {
        $this->beanPost();
        $this->getEntityManager()->persist($this->getModel());
        $this->getEntityManager()->flush();
    }


    public function edit(){
        if($this->isPost()){
            try{
                $this->getEntityManager()->beginTransaction();
                $this->editPost();
                $this->getEntityManager()->commit();
                $success = true;
                $message = 'Sucesso ao realizar operação';
            }catch (\Exception $exception){
                if($this->getEntityManager()->getConnection()->isTransactionActive()){
                    $this->getEntityManager()->rollback();
                }
                $success = false;
                $message = 'Erro ao realizar operação, erro recebido: '.$exception->getMessage();
            }
            return new MessageResponse($success, $message);
        }else{
            $data['params'] = $this->getData();
            $this->loadModelByKeys($this->getRow(), $this->getModel());
            $data['form'] = $this->beanForm();
            return new FormResponse($this->getView(), $this->getView()->getButtons(), $data);
        }
    }

    protected function editPost()
    {
        if (!$this->getModelIsLoaded()) {
            $this->loadModelByKeys($this->getFormData());
        }
        $this->beanPost();
        $this->getEntityManager()->persist($this->getModel());
        $this->getEntityManager()->flush();
    }


    public function view(){
        $data['params'] = $this->getData();
        $this->loadModelByKeys($this->getRow(), $this->getModel());
        $data['form'] = $this->beanForm();
        $this->getView()->setIsView(true);
        return new FormResponse($this->getView(), $this->getView()->getButtons(), $data);
    }


    public function delete(){
        if($this->isPost()){
            try{
                $this->getEntityManager()->beginTransaction();
                $this->deletePost();
                $this->getEntityManager()->commit();
                $success = true;
                $message = 'Sucesso ao excluir registro';
            }catch (\Exception $exception){
                if($this->getEntityManager()->getConnection()->isTransactionActive()){
                    $this->getEntityManager()->rollback();
                }
                $success = false;
                $message = 'Erro ao excluir registro, tente novamente';
            }
            return new MessageResponse($success, $message);
        }else{
            return new MessageResponse(true, 'Deseja realmente excluir o registro selecionado?', MessageResponse::TIPO_CONFIRM);
        }
    }

    public function deletePost(){
        $formData = $this->getFormData();
        $this->loadModelByKeys($this->formatRowResponse($formData), $this->getModel());
        $this->getEntityManager()->remove($this->getModel());
        $this->getEntityManager()->flush();
    }

    protected function loadModelByKeys(Array $keys)
    {
        $this->modelIsLoaded = true;
        $this->model = $this->createModelByKeys($keys);
    }


    final protected function createModelByKeys(Array $keys)
    {
        $className = get_class($this->getModel());
        $formatedKeys = $this->removeModelNameFromAlias($keys);
        $objectId = $this->getClassIdentifiers($formatedKeys, $className);
        $repositorio = $this->getEntityManager()->getRepository($className);
        return $repositorio->findOneBy($objectId);
    }

    public function removeModelNameFromAlias($keys){
        $formatedKeys = [];
        $className = get_class($this->getModel());
        foreach ($keys as $key => $valueKey){
            $modelName = StringUtil::toModelName($className);
            $formatedKeys[str_replace($modelName.'_', '', $key)] = $valueKey;
        }
        return $formatedKeys;
    }

    /**
     * Invoca o método do beanModel
     */
    protected function beanPost()
    {
        $this->beanModel();
    }

    /**
     * seta os valores da tela para o modelo
     */
    protected function beanModel()
    {
        $this->getFormBean()->beanModel($this->getModel(), null);
    }

    protected function getClassIdentifiers($keys, $className = null, $targetClass = null)
    {
        $className = ($className == null) ? get_class($this->getModel()) : $className;
        $metaData = $this->getEntityManager()->getClassMetadata($className);
        $identificadores = $metaData->getIdentifierFieldNames();
        $associacoes = $metaData->getAssociationNames();
        foreach ($identificadores as $key => $identificador) {
            if (in_array($identificador, $associacoes)) {
                $target = $associacoes[array_search($identificador, $associacoes)];
                $associacao = $metaData->getAssociationTargetClass($identificador);
                //fazemos isso para encontrar o valor setado na consulta
                $identificadoresAssociacao = $this->getClassIdentifiers($keys, $associacao, $target);
                if (is_object($identificadoresAssociacao) && get_class($identificadoresAssociacao) == $associacao) {
                    $referencia = $identificadoresAssociacao;
                } else {
                    $referencia = $this->getEntityManager()->find($associacao, $identificadoresAssociacao);
                }
                $identificadores[$identificador] = $referencia;
                unset($identificadores[$key]);
            } else {
                //aqui sempre estamos buscando os dados com base na chave passada pela consulta
                if (!$this->isPost()) {
                    $nameFind = ($targetClass !== null) ? $targetClass . '/' . $identificador : $identificador;
                    if (isset($keys[$nameFind])) {
                        $identificadores[$identificador] = $keys[$nameFind];
                        unset($identificadores[$key]);
                    }
                    // Se não achou pelo nome do modelo, vamos procurar pelo nome
                    // da coluna no banco de dados, feito para as consultas em sql
                    else {
                        if (isset($metaData->fieldMappings[$nameFind])) {
                            $dbColumnName = $metaData->fieldMappings[$nameFind]['columnName'];
                            if (isset($keys[$dbColumnName])) {
                                $identificadores[$identificador] = $keys[$dbColumnName];
                                unset($identificadores[$key]);
                            }
                        }
                    }
                } else {
                    //aqui sempre estamos buscando os dados com base nos dados da tela
                    $nameFind = ($targetClass !== null) ? $targetClass : $identificador;
                    if (isset($keys[$nameFind])) {
                        $value = $keys[$nameFind];
                        if (is_object($value)) {
                            return $value;
                        } else {
                            $identificadores[$identificador] = $value;
                        }
                        unset($identificadores[$key]);
                    }
                }
            }
        }
        // Validação
        foreach ($identificadores as $key => $value) {
            if ($value === null || $value === '') {
                throw new \Exception('Não identificado o id (' . $key . ') para a Classe (' . $className . ')');
            }
        }
        return $identificadores;
    }

    /**
     * Passa os dados do modelo para a tela
     */
    public function beanForm(){
        return $this->getFormBean()->loadDataBeanForm($this->getView()->getDataMappingArray(), $this->getModel());
    }


    /**
     * @param $model
     * @return \Doctrine\Common\Persistence\ObjectRepository|\Doctrine\ORM\EntityRepository
     */
    public function getRepositoryModel($model = null){
        if(!$model){
            $model = $this->getModel();
        }
        return $this->getEntityManager()->getRepository($class = get_class($model));
    }

    /**
     * @return mixed
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * @param mixed $model
     */
    public function setModel($model)
    {
        $this->model = $model;
    }

    /**
     * @return AbstractForm
     */
    public function getView()
    {
        return $this->view;
    }

    /**
     * @param AbstractForm $view
     */
    public function setView($view)
    {
        $this->view = $view;
    }

    /**
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param mixed $data
     */
    public function addData($key, $data)
    {
        $this->data[$key] = $data;
    }

    /**
     * @param array $data
     */
    public function setData($data)
    {
        $this->data = $data;
    }

    /**
     * @return FormBean
     */
    public function getFormBean()
    {
        if(!$this->formBean){
            $this->formBean = new FormBean();
        }
        return $this->formBean;
    }

    /**
     * @param mixed $formBean
     */
    public function setFormBean($formBean)
    {
        $this->formBean = $formBean;
    }

    /**
     * @return mixed
     */
    public function getModelIsLoaded()
    {
        return $this->modelIsLoaded;
    }

    /**
     * @param mixed $modelIsLoaded
     */
    public function setModelIsLoaded($modelIsLoaded)
    {
        $this->modelIsLoaded = $modelIsLoaded;
    }

}