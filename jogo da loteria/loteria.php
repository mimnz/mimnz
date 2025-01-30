<?php

$jogo = 0;
$total_apostas = 0;
$lucro = 0;

while ($jogo != 1 && $jogo != 2 && $jogo != 3 && $jogo != 4 && $jogo != 5)
{
    menu();
}

function menu()
{
	system('clear');
	echo "\nMenu da Loteria\n";
	div(15);
	echo "\n\n[1] Mega-sena\n[2] Quina\n[3] Lotofácil\n[4] Lotomania\n[5] Sair\n";
	div(15);
	echo "\n\nEscolha um jogo: ";
	$jogo = readline("");
    if ($jogo == 1)
    {
        megasena();
    }
    elseif ($jogo == 2)
    {
        quina();
    }
    elseif ($jogo == 3)
    {
        lotofacil();
    }
    elseif ($jogo == 4)
    {
        lotomania();
    }
    elseif ($jogo == 5)
    {
        sair();
    }
}

function megasena()
{
    qapostas();
}

function quina()
{
    qapostas();
}

function lotofacil()
{
    qapostas();
}

function lotomania()
{
    qapostas();
}

function sair()
{
    global $lucro, $total_apostas;
    limpa();
    div(15);
    echo("\nObrigado por jogar! Volte sempre.\nSeu lucro: R$ $lucro\nApostou $total_apostas vezes.\n");
    div(15);
    exit;
}

function qapostas()
{
    global $total_apostas;
    do 
    {
	    limpa();
        $n_apostas = readline("Quantas apostas você deseja comprar?: ");
	    if (!is_numeric($n_apostas))
	      {
		        print "Por favor, insira um número inteiro.\n";
	      }
    } while (!is_numeric($n_apostas) || intval($n_apostas) != $n_apostas);
    
    echo "Você comprou $n_apostas apostas.";
    $total_apostas += $n_apostas;
}
function div($tamanho)
{
	for ($i = 0; $i < $tamanho; $i++)
	{
		echo "_";
	}
}
function limpa()
{
    system('clear');
    system('cls');
}
?>
