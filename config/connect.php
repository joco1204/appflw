<?php
//Clase de conexión a MySQL
class Connect extends PDO
{
    private $type = 'mysql';
    private $host = '172.246.126.64';
    private $user = 'root';
    private $pass = 'Sm4rtS0lut10nS3rv1c3*2018';
    private $base = 'dev_appdb';
    //Constructor de conexión a la pase de datos
    public function __construct()
    {
        //Definicion del string de conexión a la base de datos
        $strc = $this->type.':host='.$this->host.';dbname='.$this->base;
        $user = $this->user;
        $pass = $this->pass;
        //conexión a la base de datos
        try {
            $conn = parent::__construct($strc, $user, $pass);
        } catch (PDOException $e) {
            $conn = "Error al conectar la base de datos: " . $e->getMessage() . "<br>";
        }
        return $conn;
    }
}
