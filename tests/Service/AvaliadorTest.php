<?php

namespace Alura\Leilao\Tests\Service;

use Alura\Leilao\Model\Lance;
use Alura\Leilao\Model\Leilao;
use Alura\Leilao\Model\Usuario;
use Alura\Leilao\Service\Avaliador;
use PHPUnit\Framework\TestCase;

class AvaliadorTest extends TestCase
{

    public function testAvaliadorDeveEncontrarOMaiorValorDeLancesEmOrdemCrescente()
    {
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
        $this->assertEquals(2500.0, $maiorValor);
    }

    public function testAvaliadorDeveEncontrarOMaiorValorDeLancesEmOrdemDecrescente()
    {
        // Arrumo a casa para o test
        // Arrange - Given
        $leilao = new Leilao('Fiat 147 0Km');

        $maria = new Usuario('Maria');
        $joao = new Usuario('João');

        $leilao->recebeLance(new Lance($maria, 2500));
        $leilao->recebeLance(new Lance($joao, 2000));

        $leiloeiro = new Avaliador();

        // Executo código a ser testado
        // Act - When
        $leiloeiro->avalia($leilao);

        $maiorValor = $leiloeiro->getMaiorValor();

        // Verifico se a saída é a esperada
        // Assert - Then
        $this->assertEquals(2500.0, $maiorValor);
    }

    public function testAvaliadorDeveEncontrarOMenorValorDeLancesEmOrdemCrescente()
    {
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

        $menorValor = $leiloeiro->getMenorValor();

        // Verifico se a saída é a esperada
        // Assert - Then
        $this->assertEquals(2000.0, $menorValor);
    }

    public function testAvaliadorDeveEncontrarOMenorValorDeLancesEmOrdemDecrescente()
    {
        // Arrumo a casa para o test
        // Arrange - Given
        $leilao = new Leilao('Fiat 147 0Km');

        $maria = new Usuario('Maria');
        $joao = new Usuario('João');

        $leilao->recebeLance(new Lance($maria, 2500));
        $leilao->recebeLance(new Lance($joao, 2000));

        $leiloeiro = new Avaliador();

        // Executo código a ser testado
        // Act - When
        $leiloeiro->avalia($leilao);

        $menorValor = $leiloeiro->getMenorValor();

        // Verifico se a saída é a esperada
        // Assert - Then
        $this->assertEquals(2000.0, $menorValor);
    }

    public function testAvaliadorDeveBuscar3MaioresValores()
    {
        $leilao = new Leilao('Fiat 147 0Km');
        $joao = new Usuario('João');
        $maria = new Usuario('Maria');
        $ana = new Usuario('Ana');
        $jorge = new Usuario('Jorge');

        $leilao->recebeLance(new Lance($ana, 1500));
        $leilao->recebeLance(new Lance($joao, 1000));
        $leilao->recebeLance(new Lance($maria, 2000));
        $leilao->recebeLance(new Lance($jorge, 1700));

        $leioeiro = new Avaliador();
        $leioeiro->avalia($leilao);

        /** @var Lance[] $maioresLances */
        $maioresLances = $leioeiro->getMaioresLances();
        $this->assertCount(3, $maioresLances);
        $this->assertEquals(2000, $maioresLances[0]->getValor());
        $this->assertEquals(1700, $maioresLances[1]->getValor());
        $this->assertEquals(1500, $maioresLances[2]->getValor());
    }

}