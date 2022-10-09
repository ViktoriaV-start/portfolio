<?php
session_start();

require_once "../vendor/autoload.php"; 

use app\engine\App;

$config = include "../config/config.php";

try {
    App::call()->run($config);
}
catch (\PDOException $e) {
    var_dump($e);
} 
 catch (\Exception $e) {
     var_dump($e->getTrace());
 }
