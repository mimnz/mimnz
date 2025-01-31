<?php

$jogo = 0;
$total_apostas = 0;
$lucro = 0;

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
    global $total_apostas;

    do {
        system('clear');
        $n_apostas = readline("Quantas apostas você deseja comprar?: ");
        if (!is_numeric($n_apostas)) {
            echo "Por favor, insira um número inteiro.\n";
        }
    } while (!is_numeric($n_apostas) || intval($n_apostas) != $n_apostas);

    echo "Você comprou $n_apostas apostas.\n";
    $total_apostas += $n_apostas;

    // Menu para escolher como definir as dezenas
    $opcao_qdezenas = 0;
    while ($opcao_qdezenas != 1 && $opcao_qdezenas != 2) {
        system('clear');
        div(15);
        echo ("\n\n[1] Comprar a mesma quantidade de dezenas para todas as apostas\n\n[2] Comprar dezenas manualmente para cada aposta\n\n");
        div(15);
        $opcao_qdezenas = readline("Sua escolha: ");
    }

    $valor_total = 0; // Inicializando o valor total
    $quantidade_dezenas_por_aposta = [];

    if ($opcao_qdezenas == 1) {
        // Definir a mesma quantidade de dezenas para todas as apostas
        $quantidade_dezenas = readline("Quantas dezenas para todas as apostas? ");
        $valor_total = $n_apostas * obter_valor_aposta($tipo, $quantidade_dezenas);
        // Preenche todas as apostas com a mesma quantidade de dezenas
        $quantidade_dezenas_por_aposta = array_fill(0, $n_apostas, $quantidade_dezenas);
    } elseif ($opcao_qdezenas == 2) {
        // Definir a quantidade de dezenas manualmente para cada aposta
        for ($i = 0; $i < $n_apostas; $i++) {
            $quantidade_dezenas = readline("Quantas dezenas para a aposta " . ($i + 1) . "? ");
            $valor_total += obter_valor_aposta($tipo, $quantidade_dezenas); // Somando o valor total
            $quantidade_dezenas_por_aposta[] = $quantidade_dezenas;
        }
    }

    // Exibir o valor total de todas as apostas
    echo "\nValor total de todas as apostas: R$ " . number_format($valor_total, 2, ',', '.') . "\n";

    // Chama o sorteio após a compra
    sorteio($tipo, $quantidade_dezenas_por_aposta);
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

function sorteio($tipo, $quantidade_dezenas_por_aposta) {
    // Para o sorteio, vamos usar as informações passadas
    foreach ($quantidade_dezenas_por_aposta as $i => $quantidade_dezenas) {
        echo "\nAposta " . ($i + 1) . " - Sorteando " . $quantidade_dezenas . " dezenas:\n";
        $numeros_sorteados = sorteio_numeros($tipo, $quantidade_dezenas);
        echo "Números sorteados: " . implode(", ", $numeros_sorteados) . "\n";
    }
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

    // Gerando os números sorteados
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

function sair() {
    global $lucro, $total_apostas;
    system('clear');
    div(15);
    echo("\nObrigado por jogar! Volte sempre.\nSeu lucro: R$ $lucro\nApostou $total_apostas vezes.\n");
    div(15);
    exit;
}

function div($tamanho) {
    for ($i = 0; $i < $tamanho; $i++) {
        echo "_ ";
    }
}
