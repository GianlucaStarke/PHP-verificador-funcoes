<?php

$acao = str_replace('-', '_', $_GET['funcao']);
$acoes = [
    'teste',
    'teste_replace'
];

try{
    if(!in_array($acao, $acoes)) throw new Exception('Ação inválida.');
    echo json_encode($acao($conexao));
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
