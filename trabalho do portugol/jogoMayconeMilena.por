programa
{
	inclua biblioteca Teclado
	inclua biblioteca Util --> u
	
	funcao inicio()
	{
	inteiro jogo, valorAdivinha, copiaDiv, tentativa
	inteiro numTentativas = 0
	escreva("Escolha um jogo a seguir:\n\n")
	escreva("[1] Adivinhe o Número\n")
	escreva("[2] Desafio da Tabuada\n")
	escreva("[3] QUIZ\n")
	escreva("[4] Jogo da Forca\n")
	escreva("Jogo escolhido: ")
		leia(jogo)
		se (jogo == 1)
		{
			limpa()
			valorAdivinha = u.sorteia(1, 10000)
			para (copiaDiv = valorAdivinha; copiaDiv >= 1; numTentativas++)
			{
			copiaDiv = copiaDiv/2
			limpa()
			escreva("Seu número de tentativas : ", numTentativas, "\n")
			escreva("Escolha um número: ")
			leia(tentativa)
			se (tentativa < valorAdivinha)
			{
				escreva("O número secreto é maior do que o número sugerido!\n Pressione a tecla \'espaço\' para tentar novamente.")
			}
			se (tentativa > valorAdivinha)
			{
				escreva("O número secreto é menor do que o número sugerido!\n Pressione a tecla \'espaço\' para tentar novamente.")
			}
			se (tentativa == valorAdivinha)
			{
				limpa()
				escreva("Você acertou!")
			}
			
			}
			
	}

	}
}
