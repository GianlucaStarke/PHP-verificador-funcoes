<?php

try{
    str_replace('-', '_', $_GET['funcao'])();
}
catch(Exception $e){
    echo json_encode([
        'error' => $e->getMessage()
    ]);
}
catch(Error $e){
    echo json_encode([
        'error' => $e->getMessage()
    ]);
}
finally{
    die();
}

function teste(){
    echo json_encode([
        'result' => 'teste'
    ]);
}

function teste_replace(){
    echo json_encode([
        'result' => 'teste_replace'
    ]);
}

?>