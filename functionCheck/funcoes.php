<?php

try{
    $_GET['funcao']();
}
catch(Error $e){
    echo json_encode([
        'error' => $e->getMessage()
    ]);
}
catch(Exception $e){
    echo json_encode([
        'error' => $e->getMessage()
    ]);
}
finally{
    die();
}

function a(){
    echo json_encode([
        'result' => 'teste'
    ]);
}

?>