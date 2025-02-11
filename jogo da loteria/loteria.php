<?php

$jogo = 0;
$total_apostas = 0;
$lucro = 0;
$maior_quantidade_acertos = 0;
$aposta_maior_acerto = [];

while ($jogo != 1 && $jogo != 2 && $jogo != 3 && $jogo != 4 && $jogo != 5) {
    menu();
}

function menu() {
    global $jogo;
    system('clear');
    echo "\nMenu da Loteria\n";
    div(15);
    echo "\n\n[1] Mega-sena\n[2] Quina\n[3] Lotofácil\n[4] Lotomania\n[5] Sair\n";
    div(15);
    echo "\n\nEscolha um jogo: ";
    $jogo = readline("");

    if ($jogo == 1) {
        qapostas("megasena");
    } elseif ($jogo == 2) {
        qapostas("quina");
    } elseif ($jogo == 3) {
        qapostas("lotofacil");
    } elseif ($jogo == 4) {
        qapostas("lotomania");
    } elseif ($jogo == 5) {
        sair();
    }
}

function qapostas($tipo) {
    global $total_apostas, $maior_quantidade_acertos, $aposta_maior_acerto, $jogo;
    
    // Sorteio dos números premiados antes das apostas
    $numeros_premiados = sorteio_premiados($tipo);
    
    do {
        system('clear');
        $n_apostas = readline("Quantas apostas você deseja comprar?: ");
        if (!is_numeric($n_apostas)) {
            echo "Por favor, insira um número inteiro.\n";
        }
    } while (!is_numeric($n_apostas) || intval($n_apostas) != $n_apostas);

    echo "Você comprou $n_apostas apostas.\n";
    $total_apostas += $n_apostas;

    // O código para escolher quantas dezenas aqui permanece o mesmo
    $opcao_qdezenas = 0;
    if ($jogo != 4) {
        while ($opcao_qdezenas != 1 && $opcao_qdezenas != 2) {
            system('clear');
            div(32);
            echo ("\n\n[1] Comprar a mesma quantidade de dezenas para todas as apostas\n\n[2] Comprar dezenas manualmente para cada aposta\n\n");
            div(32);
            echo ("\n\n");
            $opcao_qdezenas = readline("Sua escolha: ");
        }
    } else {
        $quantidade_dezenas = 50;
        $opcao_qdezenas = 1;
    }

    $valor_total = 0;
    $quantidade_dezenas_por_aposta = [];
    global $min_dezenas, $max_dezenas;

    if ($jogo == 1) {
        $min_dezenas = 6;
        $max_dezenas = 20;
    } elseif ($jogo == 2) {
        $min_dezenas = 5;
        $max_dezenas = 15;
    } elseif ($jogo == 3) {
        $min_dezenas = 15;
        $max_dezenas = 20;
    } elseif ($jogo == 4) {
        $quantidade_dezenas = 50;
    }

    if ($opcao_qdezenas == 1) {
        if ($jogo == 4) {
            $valor_total = $n_apostas * obter_valor_aposta($tipo, $quantidade_dezenas);
            $quantidade_dezenas_por_aposta = array_fill(0, $n_apostas, $quantidade_dezenas);
        } else {
            while (!($quantidade_dezenas >= $min_dezenas && $quantidade_dezenas <= $max_dezenas)) {
                comprando_dezenas();
                $quantidade_dezenas = readline("Quantas dezenas para todas as apostas? ");
            }

            $valor_total = $n_apostas * obter_valor_aposta($tipo, $quantidade_dezenas);
            $quantidade_dezenas_por_aposta = array_fill(0, $n_apostas, $quantidade_dezenas);
        }
    } elseif ($opcao_qdezenas == 2) {
        for ($i = 0; $i < $n_apostas; $i++) {
            $quantidade_dezenas = 0;
            while (!($quantidade_dezenas >= $min_dezenas && $quantidade_dezenas <= $max_dezenas)) {
                comprando_dezenas();
                $quantidade_dezenas = readline("Quantas dezenas para a aposta " . ($i + 1) . "? ");
                $valor_total += obter_valor_aposta($tipo, $quantidade_dezenas);
            }

            $quantidade_dezenas_por_aposta[] = $quantidade_dezenas;
        }
    }

    echo "\nValor total: R$ " . number_format($valor_total, 2, ',', '.') . "\n";

    // Chama o sorteio após a compra
    sorteio($tipo, $quantidade_dezenas_por_aposta, $numeros_premiados, $valor_total);
}

function obter_valor_aposta($tipo, $quantidade_dezenas) {
    // Tabelas de valores para cada tipo de jogo
    $valores_apostas = [
        "megasena" => [
            6 => 5.00,
            7 => 35.00,
            8 => 140.00,
            9 => 420.00,
            10 => 1050.00,
            11 => 2310.00,
            12 => 4620.00,
            13 => 8580.00,
            14 => 15015.00,
            15 => 25025.00,
            16 => 40040.00,
            17 => 61880.00,
            18 => 92820.00,
            19 => 135660.00,
            20 => 193800.00,
        ],
        "quina" => [
            5 => 2.50,
            6 => 15.00,
            7 => 52.50,
            8 => 140.00,
            9 => 315.00,
            10 => 630.00,
            11 => 1155.00,
            12 => 1980.00,
            13 => 3217.50,
            14 => 5005.00,
            15 => 7507.50,
        ],
        "lotofacil" => [
            15 => 3.00,
            16 => 48.00,
            17 => 408.00,
            18 => 2448.00,
            19 => 11628.00,
            20 => 46512.00,
        ],
        "lotomania" => [
            50 => 3.00,
            51 => 5.00,
            52 => 7.00,
            53 => 10.00,
            54 => 12.00,
            55 => 15.00,
            56 => 18.00,
            57 => 20.00,
            58 => 25.00,
            59 => 30.00,
            60 => 35.00,
        ]
    ];

    return isset($valores_apostas[$tipo][$quantidade_dezenas]) ? $valores_apostas[$tipo][$quantidade_dezenas] : 0;
}

function sorteio($tipo, $quantidade_dezenas_por_aposta, $numeros_premiados, $valor_total) {
    global $maior_quantidade_acertos, $aposta_maior_acerto;
    
    foreach ($quantidade_dezenas_por_aposta as $i => $quantidade_dezenas) {
        // Sorteio dos números da aposta
        $numeros_sorteados = sorteio_numeros($tipo, $quantidade_dezenas);
        
        // Verifica os acertos
        $acertos = count(array_intersect($numeros_sorteados, $numeros_premiados));
        
        // Exibe os detalhes da aposta com 1 segundo de intervalo
        system('clear');  // Limpa o terminal para mostrar a aposta de forma isolada
        echo "\nAposta " . ($i + 1) . " - Sorteadas " . $quantidade_dezenas . " dezenas:\n";
        echo "Números sorteados: " . implode(" - ", $numeros_sorteados) . "\n";
        echo "Acertos: $acertos\n";

        // Atualiza a maior quantidade de acertos
        if ($acertos > $maior_quantidade_acertos) {
            $maior_quantidade_acertos = $acertos;
            $aposta_maior_acerto = $numeros_sorteados;
        }

        // Pausa de 1 segundo entre as apostas
        sleep(1);
    }

    // Limpa a tela após todas as apostas
    system('clear');
    
    // Exibe os números premiados e as informações finais
    echo "\nSorteio dos números premiados: " . implode(" - ", $numeros_premiados) . "\n";
    echo "\nMaior quantidade de acertos: $maior_quantidade_acertos\n";
    echo "Aposta com mais acertos: " . implode(" - ", $aposta_maior_acerto) . "\n";
    echo "Total gasto: R$ " . number_format($valor_total, 2, ',', '.') . "\n";
}

function sorteio_numeros($tipo, $quantidade_dezenas) {
    // Determinando o limite máximo de acordo com o tipo de jogo
    if ($tipo == "megasena") {
        $max_dezenas = 60;
    } elseif ($tipo == "quina") {
        $max_dezenas = 80;
    } elseif ($tipo == "lotofacil") {
        $max_dezenas = 25;
    } elseif ($tipo == "lotomania") {
        $max_dezenas = 100;
    }

    $numeros_sorteados = [];
    while (count($numeros_sorteados) < $quantidade_dezenas) {
        $sorteado = rand(1, $max_dezenas);
        if (!in_array($sorteado, $numeros_sorteados)) {
            $numeros_sorteados[] = $sorteado;
        }
    }

    // Ordena os números sorteados de forma crescente
    sort($numeros_sorteados);

    return $numeros_sorteados;
}

function sorteio_premiados($tipo) {
    // Determinando o limite máximo de acordo com o tipo de jogo
    if ($tipo == "megasena") {
        $max_dezenas = 60;
        $quantidade_dezenas = 6;  // Mega-Sena sorteia 6 números
    } elseif ($tipo == "quina") {
        $max_dezenas = 80;
        $quantidade_dezenas = 5;  // Quina sorteia 5 números
    } elseif ($tipo == "lotofacil") {
        $max_dezenas = 25;
        $quantidade_dezenas = 15; // Lotofácil sorteia 15 números
    } elseif ($tipo == "lotomania") {
        $max_dezenas = 100;
        $quantidade_dezenas = 20; // Lotomania sorteia 20 números
    }

    // Sorteio dos números premiados
    $numeros_premiados = [];
    while (count($numeros_premiados) < $quantidade_dezenas) {
        $sorteado = rand(1, $max_dezenas);
        if (!in_array($sorteado, $numeros_premiados)) {
            $numeros_premiados[] = $sorteado;
        }
    }

    // Ordena os números sorteados de forma crescente
    sort($numeros_premiados);

    echo "\nSorteio dos números premiados: " . implode(" - ", $numeros_premiados) . "\n";

    return $numeros_premiados;
}

function sair() {
    global $lucro, $total_apostas;
    system('clear');
    div(17);
    echo("\n\nObrigado por jogar! Código desenvolvido pelas alunas Milena e Brenda do 1°TDS.\n");
    div(17);
    echo "\n\n";
    exit;
}

function div($tamanho) {
    for ($i = 0; $i < $tamanho; $i++) {
        echo "_ ";
    }
}

function comprando_dezenas() {
    global $min_dezenas, $max_dezenas;
    system('clear');
    div(29);
    echo ("\n\nComprando dezenas \u{1F4B2}\u{1F3B2}\n\nEscolha um número entre $min_dezenas e $max_dezenas.\nQuanto maior o valor inserido, mais alto o valor da aposta.\n\n");
    div(29);
    echo "\n\n";
}
