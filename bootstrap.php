<?php
// bootstrap.php
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

require_once "vendor/autoload.php";
date_default_timezone_set("America/Sao_Paulo");
$config = Setup::createAnnotationMetadataConfiguration(array(__DIR__."/src/Model"), \Pummax\Configuration\DataBase::isDevMode());
$entityManager = EntityManager::create(\Pummax\Configuration\DataBase::getConnectionConfiguration(), $config);
$conection = new \Pummax\DataBase\Connection();
$conection::setEntityManager($entityManager);