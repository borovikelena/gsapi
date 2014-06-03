<?php

/**
 * MySQL DB. All data is stored in data_pdo_mysql database
 * Create an empty MySQL database and set the dbname, username
 * and password below
 *
 * This class will create the table with sample data
 * automatically on first `get` or `get($id)` request
 */
use Luracast\Restler\RestException;

class DB_PDO_MySQL
{
    private $db;

    function __construct()
    {
        try {
            //Make sure you are using UTF-8
            $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');

            //Update the dbname username and password to suit your server
            $this->db = new PDO(
                'mysql:host=localhost;dbname=gameloftshop',
                'root',
                '****',
                $options
            );
            $this->db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,
                PDO::FETCH_ASSOC);

            //If you are using older version of PHP and having issues with Unicode
            //uncomment the following line
            //$this->db->exec("SET NAMES utf8");

        } catch (PDOException $e) {
            throw new RestException(501, 'MySQL: ' . $e->getMessage());
        }
    }

 

    function getKey($product_id='', $version=0)
    {
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        try {
            $sql = $this->db->prepare('
            SELECT 
                public 
            FROM 
                app_keys 
            WHERE 
                product_id = :product_id
            AND 
                version = :version
            LIMIT 1
            ');

            $sql->execute(array(':product_id' => $product_id, ':version' => $version));
            return $sql->fetch();
        } catch (PDOException $e) {
            
            throw new RestException(501, 'MySQL: ' . $e->getMessage());
        }
    }
}

