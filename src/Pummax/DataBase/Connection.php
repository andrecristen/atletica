<?php

namespace Pummax\DataBase;


use Doctrine\ORM\EntityManager;

class Connection
{
    /** @var $entityManager EntityManager */
    private static $entityManager;

    /**
     * @return EntityManager
     */
    public static function getEntityManager()
    {
        return self::$entityManager;
    }

    /**
     * @param EntityManager $entityManager
     */
    public static function setEntityManager($entityManager)
    {
        self::$entityManager = $entityManager;
    }

}