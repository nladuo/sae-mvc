<?php
/**
 * Created by PhpStorm.
 * User: kalen
 * Date: 7/3/16
 * Time: 9:14 PM
 */

namespace Core;


class Model
{
    /**
     * @var \MysqliDb
     */
    protected $db;

    function __construct()
    {
        $this->db = new \MysqliDb (DBHOST, DBUSER, DBPASS, DBNAME, DBPORT);
    }

}
