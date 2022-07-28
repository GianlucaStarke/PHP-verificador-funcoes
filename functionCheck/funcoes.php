<?php

try{
    $res = str_replace('-', '_', $_GET['funcao'])();
    
    echo json_encode($res);
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
