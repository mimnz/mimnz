programa
{
	inclua biblioteca Graficos --> g
	inclua biblioteca Teclado --> t
	
	funcao inicio()
	{
		g.iniciar_modo_grafico(verdadeiro)
		g.entrar_modo_tela_cheia()
		labirinto()
	}
	funcao labirinto(inteiro ponto)
	{
		inteiro esgoto = g.carregar_imagem("/home/lab/milena/jogo_do_cachorro/esgoto.jpg")
		enquanto (verdadeiro)
		{
			g.desenhar_imagem(0, 0, esgoto)
			g.renderizar()
			se (ponto == 0)
				{
					se (t.tecla_pressionada(t.TECLA_W))
					{
						ponto = 3
					}
					se (t.tecla_pressionada(t.TECLA_A))
					{
						ponto = 2
					}
					se (t.tecla_pressionada(t.TECLA_D))
					{
						ponto = 1	
					}
				}
				se (ponto == 1)
				{
					se (t.tecla_pressionada(t.TECLA_W))
					{
						ponto = 3
					}
					se (t.tecla_pressionada(t.TECLA_A))
					{
						ponto = 2
					}
					se (t.tecla_pressionada(t.TECLA_S))
					{
						
					}
					se (t.tecla_pressionada(t.TECLA_D))
					{
						ponto = 1	
					}
				}
				
		
			
		}
	}
}
