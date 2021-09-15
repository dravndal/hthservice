<?php
// En klasse som kan instansieres for å koble opp til databasen.
class mysqlPDO extends PDO {
  public function __construct() {
    $config = require 'config.php'; // Hent konfigurasjonsvariablene
    $drv = $config['db_driver'];
    $hst = $config['db_host'];
    $sch = $config['db_schema'];
    $usr = $config['db_user'];
    $pwd = $config['db_password'];
    $dsn = $drv . ':host=' . $hst . ';dbname=' . $sch;
    parent::__construct($dsn,$usr,$pwd); // Constructoren som blir avfyrt når du lager en instans.
  }
}
