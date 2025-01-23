<?php

$jogo = 0;

while ($jogo != 1 && $jogo != 2 && $jogo != 3)
{
	system('clear');
	echo "\nMenu da Loteria\n";
	div(15);
	echo "\n\n[1] Mega-sena\n[2] Quina\n[3] Lotofácil\n[4] Lotomania\n";
	div(15);
	echo "\n\nEscolha um jogo: ";
	$jogo = readline("");
}

if ($jogo == 1)
{
	$max = 6; 
}
else if ($jogo == 2)
{
	$max = 8;
}
else if ($jogo == 3)
{
	$max = 15;
}
else if ($jogo == 4)
{
	$max = 50;
}

$lista = [];

for ($valor = 1; $valor <= $max; $valor++)
{
	$lista[$valor-1] = readline("Escolha o $valor º item: ");
	while ($lista[$valor-1] < 0 && $lista[$valor] > 99) 
	{
		$lista[$valor-1] = readline("Escolha o $valor º item: ");
		array_push($lista);
	}
}
print_r($lista);

function div($tamanho)
{
	for ($i = 0; $i < $tamanho; $i++)
	{
		echo "_";
	}
}
