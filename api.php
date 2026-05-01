<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

$raca = $_GET['raca'] ?? "";

if ($raca == "") {
    $url = "https://dog.ceo/api/breeds/image/random";
} else {
    $url = "https://dog.ceo/api/breed/$raca/images/random";
}

$response = @file_get_contents($url);

if ($response === FALSE) {
    echo json_encode([
        'success' => false,
        'mensagem' => 'Erro ao acessar a API.'
    ]);
    exit;
}

$dados = json_decode($response, true);

if ($dados && $dados['status'] == 'success') {

    $imagem = $dados['message'];

    $partes = explode("/", $imagem);
    $raca_nome = $partes[4];

    echo json_encode([
        'success' => true,
        'imagem' => $imagem,
        'raca' => ucfirst($raca_nome),
        'url' => $imagem
    ]);

} else {
    echo json_encode([
        'success' => false,
        'mensagem' => 'Raça não encontrada.'
    ]);
}
?>