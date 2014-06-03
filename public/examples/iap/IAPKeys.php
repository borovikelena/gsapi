<?php
class IAPKeys
{
    public $dp;

    static $FIELDS = array('product_id', 'version');

    function __construct()
    {
          $this->dp = new DB_PDO_MySQL();
      
    }

       /**
     *
     * @param string $product_id {@type string}{@required true}{@min 1}{@max 10}
     * @param integer $version {@type string}{@required true}{@min 3}{@max 5}
     * @url GET /keys/*
     * @url GET /keys/{product_id}/{version}
     */

    function keys($product_id, $version)
    {
        return $this->dp->getKey($product_id, $version);
    }
}

