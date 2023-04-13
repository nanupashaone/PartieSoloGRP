<?php

session_start();

require_once "../config.php";
require_once "../model/ContactModel.php";
require_once "../model/InstrumentModel.php";
require_once "../model/UserModel.php";

try {
    $connectPDO = new PDO(DB_TYPE.':host='.DB_HOST.';port='.DB_PORT.';dbname='.DB_NAME.';charset='.DB_CHARSET,DB_USER,
    DB_PWD
    );

    // Environnement dev/test pour l'activation des erreurs
    if(ENV=="dev"||ENV=="test"){
        // affichage des erreurs
        $connectPDO->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    }

}catch(Exception $e){
    die($e->getMessage());

}

# Router

// connected
if(isset($_SESSION['ID'])&&$_SESSION['ID']==session_id()){
    require_once "../controller/privateController.php";

// public || disconnected
}else{
    require_once "../controller/publicController.php";
}


$connectPDO = null;