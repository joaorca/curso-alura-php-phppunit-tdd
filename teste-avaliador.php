<?php

use Alura\Leilao\Model\Lance;
use Alura\Leilao\Model\Leilao;
use Alura\Leilao\Model\Usuario;
use Alura\Leilao\Service\Avaliador;

require_once 'vendor/autoload.php';

// Arrumo a casa para o test
// Arrange - Given
$leilao = new Leilao('Fiat 147 0Km');

$maria = new Usuario('Maria');
$joao = new Usuario('João');

$leilao->recebeLance(new Lance($joao, 2000));
$leilao->recebeLance(new Lance($maria, 2500));

$leiloeiro = new Avaliador();

// Executo código a ser testado
// Act - When
$leiloeiro->avalia($leilao);

$maiorValor = $leiloeiro->getMaiorValor();

// Verifico se a saída é a esperada
// Assert - Then
$valoEsperado = 2500.0;

if ($valoEsperado === $maiorValor){
    echo "TESTE OK";
}else {
    echo "TESTE FALHOU";
}