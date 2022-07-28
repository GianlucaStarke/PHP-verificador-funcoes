<?php

try{
    echo json_encode(
        str_replace('-', '_', $_GET['funcao'])()
    );
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
    return [
        'result' => 'teste'
    ];
}

function teste_replace(){
    return [
        'result' => 'teste_replace'
    ];
}

?>
