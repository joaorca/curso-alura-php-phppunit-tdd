<?php

namespace Alura\Leilao\Tests\Model;

use Alura\Leilao\Model\Lance;
use Alura\Leilao\Model\Leilao;
use Alura\Leilao\Model\Usuario;
use PHPUnit\Framework\TestCase;

class LeilaoTest extends TestCase
{
    public function testLeilaoNaoDeveReceberLancesRepetidos()
    {
        $this->expectException(\DomainException::class);
        $this->expectExceptionMessage('Usuário não pode propor 2 lances consecutivos');

        $leilao = new Leilao('Variante');
        $ana = new Usuario('Ana');

        $leilao->recebeLance(new Lance($ana, 1000));
        $leilao->recebeLance(new Lance($ana, 1500));
    }

    public function testLeilaoNaoDeveAceitarMaisDe5LancesPorUsuario()
    {
        $this->expectException(\DomainException::class);
        $this->expectExceptionMessage('Usuário não pode propor mais que cinco lances por leilão');

        $leiao = new Leilao('Brasília Amarela');
        $joao = new Usuario('João');
        $maria = new Usuario('Maria');

        $leiao->recebeLance(new Lance($joao, 1000));
        $leiao->recebeLance(new Lance($maria, 1500));
        $leiao->recebeLance(new Lance($joao, 2000));
        $leiao->recebeLance(new Lance($maria, 2500));
        $leiao->recebeLance(new Lance($joao, 3000));
        $leiao->recebeLance(new Lance($maria, 3500));
        $leiao->recebeLance(new Lance($joao, 4000));
        $leiao->recebeLance(new Lance($maria, 4500));
        $leiao->recebeLance(new Lance($joao, 5000));
        $leiao->recebeLance(new Lance($maria, 5500));
        $leiao->recebeLance(new Lance($joao, 6000));
        $leiao->recebeLance(new Lance($maria, 6500));
    }

    /**
     * @dataProvider gerLances
     * @param int $qtdLances
     * @param Leilao $leilao
     * @param array $valores
     */
    public function testLeilaoDeveReceberLances(
        int $qtdLances,
        Leilao $leilao,
        array $valores
    ) {
        $this->assertCount($qtdLances, $leilao->getLances());
        foreach ($valores as $i => $valorEsperado) {
            $this->assertEquals($valorEsperado, $leilao->getLances()[$i]->getValor());
        }
    }

    public function gerLances()
    {
        $joao = new Usuario('João');
        $maria = new Usuario('Maria');

        $leilaoCom2Lances = new Leilao('Fiat 147 0Km');
        $leilaoCom2Lances->recebeLance(new Lance($joao, 1000));
        $leilaoCom2Lances->recebeLance(new Lance($maria, 2000));

        $leilaoCom1Lance = new Leilao('Fusca 1972 0Km');
        $leilaoCom1Lance->recebeLance(new Lance($maria, 5000));

        return [
            '2-lances' => [2, $leilaoCom2Lances, [1000, 2000]],
            '1-lances' => [1, $leilaoCom1Lance, [5000]]
        ];
    }

}