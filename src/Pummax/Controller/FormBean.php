<?php

namespace Pummax\Controller;

use Pummax\View\Form\AbstractForm;

class FormBean extends BaseController
{

    private $mappingProperty = Array();

    public function addMappingProperty($propertyName, $valueMapping)
    {
        $this->mappingProperty[$propertyName] = $valueMapping;
    }

    public function getMappingProperty($name, $parentName = null)
    {
        $nameFind = ($parentName !== null) ? $parentName . '.' . $name : $name;
        if (array_key_exists($nameFind, $this->mappingProperty)) {
            return $this->mappingProperty[$nameFind];
        }
        return $name;
    }

    /**
     * Seta os valores da tela para o modelo
     */
    public function beanModel($model, $data = null)
    {
        if($data === null){
            $data = $this->getFormData();
        }
        $class = get_class($model);
        $em = $this->getEntityManager();
        $metaData = $em->getClassMetadata($class);
        //vamos transformar nossas associações em referencias de objetos
        foreach($data as $name => $value){
            $name = $this->getMappingProperty($name);
            if ($name === null) {
                continue;
            }
            if($metaData->isAssociationWithSingleJoinColumn($name)){
                //vamos buscar essa associação
                $association = $metaData->getAssociationMapping($name);
                $metaDataAssociation = $em->getClassMetadata($association['targetEntity']);
                $findAssociation = Array();
                $dbalNames = $metaDataAssociation->getIdentifierColumnNames();
                foreach($metaDataAssociation->getIdentifierFieldNames() as $indexBusca => $columnId ){
                    if(!$value || $value == 'null'){
                        break;
                    }
                    $columnIdDbal = $dbalNames[$indexBusca];
                    if(isset($value[$columnId])){
                        //vamos tratar se nosso value de busca da associação também é uma associação
                        //casos em que a associação tem como pk outra associação
                        if($metaDataAssociation->isAssociationWithSingleJoinColumn($columnId)){
                            $associationId = $metaDataAssociation->getAssociationMapping($columnId);
                            $metaDataAssociationId = $em->getClassMetadata($associationId['targetEntity']);
                            foreach($metaDataAssociationId->getIdentifierFieldNames() as $indexBuscaInternal => $columnIdInternal ){
                                if(isset($value[$columnId][$columnIdInternal])){
                                    $findAssociation[$columnId] = $value[$columnId][$columnIdInternal];
                                }
                            }
                        } else {
                            $findAssociation[$columnId] = $value[$columnId];
                        }

                    } elseif(isset($value[$columnIdDbal])){
                        $findAssociation[$columnId] = $value[$columnIdDbal];
                    } else {
                        throw new \Exception('Identificador da associação ' . $name . ' incompleto');
                    }
                }
                if(count($findAssociation) > 0){
                    $associationModel = $em->getRepository($association['targetEntity'])->find($findAssociation);
                    if($model){
                        $data[$name] = $associationModel;
                    } else {
                        throw new \Exception('Não localizado associação ' . $name . '.');
                    }
                    //se não encontrou então essa associação é nula
                } else {
                    $data[$name] = null;
                }
            }
        }
        //agora vamos setar as demais informações no nosso modelo
        foreach ($data as $name => $value){
            $name = $this->getMappingProperty($name);
            if ($name === null) {
                continue;
            }
            //temos mais de um nível
            if($metaData->isAssociationInverseSide($name)){
                $newMethodName = 'new' . ucwords($name);
                $metadata = $this->getEntityManager()->getClassMetadata(get_class($model));
                $methodNew = $metadata->getReflectionClass()->getMethod($newMethodName);
                if(!$methodNew){
                    throw new \Exception('Não localizado o método "' . $newMethodName . '" na classe ' . get_class($model));
                }
                /* @var $currentRows \Doctrine\Common\Collections\ArrayCollection */
                $currentRows = PummaxReflection::callGetter($model, $name);
                $tempRows = new \Doctrine\Common\Collections\ArrayCollection();
                PummaxReflection::callSetter($model, $name, Array($tempRows));
                $posicaoAtual = 0;
                if(is_array($value)){
                    foreach($value as $row){
                        //vamos buscar o identificador desta classe
                        $associationModel = $methodNew->invoke($model);
                        $this->beanModel($associationModel, $row);
                        if ($id = $this->getIndentificadorClasse($associationModel)) {
                            foreach ($currentRows as $idx => $modelAtual) {
                                $temp = $this->getIndentificadorClasse($modelAtual);
                                if ($temp == $id) {
                                    $this->beanModel($modelAtual, $row);
                                    $tempRows->set($posicaoAtual, $modelAtual);
                                    if ($currentRows instanceof \Doctrine\Common\Collections\ArrayCollection) {
                                        $currentRows->remove($idx);
                                    } else {
                                        unset($currentRows[$idx]);
                                    }
                                    break;
                                }
                            }
                        }
                        $posicaoAtual++;
                    }
                }
                //o que sobrou no nosso current model vamos excluir
                foreach ($currentRows as $delete) {
                    $this->getEntityManager()->remove($delete);
                }
            } else {
                $typeField = $metaData->getTypeOfField($name);
                $value = $this->beanTypeField($typeField, $value);
                PummaxReflection::callSetter($model, $name, Array($value));
            }
        }
    }

    private function getIndentificadorClasse($class)
    {
        $identificadores = Array();
        $metaChild = $this->getEntityManager()->getClassMetadata(get_class($class));
        $ids = $metaChild->getIdentifierValues($class);
        foreach ($ids as $name => $id) {
            if (is_object($id)) {
                $identificadores = array_merge($identificadores, $this->getIndentificadorClasse($id));
            } else {
                $identificadores[$name] = $id;
            }
        }
        return $identificadores;
    }

    public function beanTypeField($typeField, $value){
        if($value === "null" ||  (is_string($value) && strlen($value) == 0) ){
            $value = null;
            return $value;
        }
        switch ($typeField){
            case \Doctrine\DBAL\Types\Type::DATETIMETZ:
            case \Doctrine\DBAL\Types\Type::DATETIME:
            case \Doctrine\DBAL\Types\Type::DATE:
                if(!($value instanceof \DateTime)){
                    $value = str_replace('/', '-', $value);
                    $value = new \DateTime($value);
                }
                break;
            case \Doctrine\DBAL\Types\Type::BOOLEAN:
                if(is_null($value) || $value === 'false'){
                    $value = 0;
                }
                break;
            case \Doctrine\DBAL\Types\Type::INTEGER:
            case \Doctrine\DBAL\Types\Type::BIGINT:
                $value = (int) $value;
                break;
            case \Doctrine\DBAL\Types\Type::DECIMAL:
                $value = (float) $value;
                break;
            case \Doctrine\DBAL\Types\Type::TEXT:
            case \Doctrine\DBAL\Types\Type::STRING:
                if($value !== null){
                    $value = trim($value);
                }
                break;
        }
        return $value;
    }

    /**
     * Atribui os valores do model para a tela
     */
    public function beanForm($model, AbstractForm $form)
    {
        $data = $this->loadDataBeanForm($form->getDataMapping(), $model);
        return $data;
    }

    public function loadDataBeanForm($dataMapping, $model){
        $class = get_class($model);
        $em = $this->getEntityManager();
        $metaData = $em->getClassMetadata($class);
        $data = Array();
        foreach($dataMapping as $key => $mapping){
            if(is_array($mapping)){
                $name = $key;
                if($metaData->isAssociationInverseSide($name)){
                    $collection = PummaxReflection::callGetter($model, $name);
                    $collectionData = Array();
                    foreach($collection as $modelMapping){
                        $collectionData[] = $this->loadDataBeanForm($mapping, $modelMapping);
                    }
                    $value = $collectionData;
                } else {
                    $modelMapping = PummaxReflection::callGetter($model, $name);
                    if($modelMapping){
                        $value = $this->loadDataBeanForm($mapping, $modelMapping);
                    } else {
                        $value = null;
                    }
                }

            } else {
                $name = $mapping;
                $value = PummaxReflection::callGetter($model, $mapping);
                if($value instanceof \DateTime){
                    $value = $value->format(\DateTime::W3C);
                }
                //se o value é nulo vamos mandar para o front uma string
                //erro em componentes que n tratam essa situação
                if(is_null($value)){
                    $value = "";
                }
            }
            $data[$name] = $value;
        }
        return $data;

    }

}
