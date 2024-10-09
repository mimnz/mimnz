programa
{
	inclua biblioteca Graficos --> g
	inclua biblioteca Teclado --> t
	
	funcao inicio()
	{
		g.iniciar_modo_grafico(verdadeiro)
		g.entrar_modo_tela_cheia()
		labirinto(0)
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
						ponto = 0
					}
					se (t.tecla_pressionada(t.TECLA_D))
					{
						ponto = 13
					}
				}
				se (ponto == 2)
				{
					se (t.tecla_pressionada(t.TECLA_W))
					{
						ponto = 3
					}
					se (t.tecla_pressionada(t.TECLA_S))
					{
						ponto = 0
					}
					se (t.tecla_pressionada(t.TECLA_D))
					{
						ponto = 1	
					}
				}
				se (ponto == 3)
				{
					se (t.tecla_pressionada(t.TECLA_W))
					{
						ponto = 4
					}
					se (t.tecla_pressionada(t.TECLA_A))
					{
						ponto = 2
					}
					se (t.tecla_pressionada(t.TECLA_S))
					{
						ponto = 0
					}
					se (t.tecla_pressionada(t.TECLA_D))
					{
						ponto = 1	
					}
				}
				se (ponto == 4)
				{
					se (t.tecla_pressionada(t.TECLA_W))
					{
						ponto = 5
					}
					se (t.tecla_pressionada(t.TECLA_A))
					{
						ponto = 3
					}
					se (t.tecla_pressionada(t.TECLA_S))
					{
						ponto = 3
					}
					se (t.tecla_pressionada(t.TECLA_D))
					{
						ponto = 7
					}
				}
				se (ponto == 5)
				{
					se (t.tecla_pressionada(t.TECLA_A))
					{
						ponto = 6
					}
					se (t.tecla_pressionada(t.TECLA_S))
					{
						ponto = 4
					}
					se (t.tecla_pressionada(t.TECLA_D))
					{
						ponto = 7
					}
				}
				se (ponto == 6)
				{
					se (t.tecla_pressionada(t.TECLA_W))
					{
						ponto = 5
					}
					se (t.tecla_pressionada(t.TECLA_D))
					{
						ponto = 5
					}
				}
				se (ponto == 7)
				{
					se (t.tecla_pressionada(t.TECLA_A))
					{
						ponto = 5
					}
					se (t.tecla_pressionada(t.TECLA_S))
					{
						ponto = 8
					}
					se (t.tecla_pressionada(t.TECLA_D))
					{
						ponto = 9
					}
				}
				se (ponto == 8)
				{
					se (t.tecla_pressionada(t.TECLA_W))
					{
						ponto = 9
					}
					se (t.tecla_pressionada(t.TECLA_A))
					{
						ponto = 7
					}
					se (t.tecla_pressionada(t.TECLA_S))
					{
						ponto = 11
					}
					se (t.tecla_pressionada(t.TECLA_D))
					{
						ponto = 10
					}
				}
				se (ponto == 9)
				{
					se (t.tecla_pressionada(t.TECLA_A))
					{
						ponto = 7
					}
					se (t.tecla_pressionada(t.TECLA_S))
					{
						ponto = 8
					}
					se (t.tecla_pressionada(t.TECLA_D))
					{
						ponto = 10
					}
				}
				se (ponto == 10)
				{
					se (t.tecla_pressionada(t.TECLA_A))
					{
						ponto = 9
					}
					se (t.tecla_pressionada(t.TECLA_S))
					{
						ponto = 11
					}
				}
				se (ponto == 11)
				{
					se (t.tecla_pressionada(t.TECLA_W))
					{
						ponto = 11
					}
					se (t.tecla_pressionada(t.TECLA_A))
					{
						ponto = 8
					}
					se (t.tecla_pressionada(t.TECLA_S))
					{
						ponto = 12
					}
				}
				se (ponto == 12)
				{
					se (t.tecla_pressionada(t.TECLA_W))
					{
						ponto = 11
					}
					se (t.tecla_pressionada(t.TECLA_A))
					{
						ponto = 13
					}
					se (t.tecla_pressionada(t.TECLA_S))
					{
						ponto = 13
					}
				}
				se (ponto == 13)
				{
					se (t.tecla_pressionada(t.TECLA_W))
					{
						ponto = 12
					}
					se (t.tecla_pressionada(t.TECLA_A))
					{
						ponto = 1
					}
					se (t.tecla_pressionada(t.TECLA_D))
					{
						ponto = 12
					}
				}
		}
	}
}
