<?php
// bootstrap.php
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

require_once "vendor/autoload.php";

$config = Setup::createAnnotationMetadataConfiguration(array(__DIR__."/src/Model"), \Pummax\Configuration\DataBase::isDevMode());
$entityManager = EntityManager::create(\Pummax\Configuration\DataBase::getConnectionConfiguration(), $config);
$conection = new \Pummax\DataBase\Connection();
$conection::setEntityManager($entityManager);