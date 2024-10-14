programa
{
	inclua biblioteca Graficos --> g
	inclua biblioteca Teclado --> t
	inclua biblioteca Util --> u
	
	funcao inicio()
	{
		g.iniciar_modo_grafico(verdadeiro)
		g.entrar_modo_tela_cheia()
		labirinto(0)
	}
	funcao labirinto(inteiro ponto)
	{	
		enquanto (verdadeiro)
		{
			g.limpar()
			se (ponto == 0)
				{
					g.desenhar_imagem(0, 0, g.carregar_imagem("/portas_esgoto/0.jpg"))
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
					u.aguarde(200)
				}
				se (ponto == 1)
				{
					g.desenhar_imagem(0, 0, g.carregar_imagem("/portas_esgoto/1.jpg"))
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
					u.aguarde(200)
				}
				se (ponto == 2)
				{
					g.desenhar_imagem(0, 0, g.carregar_imagem("/portas_esgoto/2.jpg"))
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
					u.aguarde(200)
				}
				se (ponto == 3)
				{
					g.desenhar_imagem(0, 0, g.carregar_imagem("/portas_esgoto/3.jpg"))
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
					u.aguarde(200)
				}
				se (ponto == 4)
				{
					g.desenhar_imagem(0, 0, g.carregar_imagem("/portas_esgoto/4.jpg"))
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
					u.aguarde(200)
				}
				se (ponto == 5)
				{
					g.desenhar_imagem(0, 0, g.carregar_imagem("/portas_esgoto/5.jpg"))
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
					u.aguarde(200)
				}
				se (ponto == 6)
				{
					g.desenhar_imagem(0, 0, g.carregar_imagem("/portas_esgoto/6.jpg"))
					se (t.tecla_pressionada(t.TECLA_W))
					{
						ponto = 5
					}
					se (t.tecla_pressionada(t.TECLA_D))
					{
						ponto = 5
					}
					u.aguarde(200)
				}
				se (ponto == 7)
				{
					g.desenhar_imagem(0, 0, g.carregar_imagem("/portas_esgoto/7.jpg"))
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
					u.aguarde(200)
				}
				se (ponto == 8)
				{
					g.desenhar_imagem(0, 0, g.carregar_imagem("/portas_esgoto/8.jpg"))
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
					u.aguarde(200)
				}
				se (ponto == 9)
				{
					g.desenhar_imagem(0, 0, g.carregar_imagem("/portas_esgoto/9.jpg"))
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
					u.aguarde(200)
				}
				se (ponto == 10)
				{
					g.desenhar_imagem(0, 0, g.carregar_imagem("/portas_esgoto/10.jpg"))
					se (t.tecla_pressionada(t.TECLA_A))
					{
						ponto = 9
					}
					se (t.tecla_pressionada(t.TECLA_S))
					{
						ponto = 11
					}
					u.aguarde(200)
				}
				se (ponto == 11)
				{
					g.desenhar_imagem(0, 0, g.carregar_imagem("/portas_esgoto/11.jpg"))
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
					u.aguarde(200)
				}
				se (ponto == 12)
				{
					g.desenhar_imagem(0, 0, g.carregar_imagem("/portas_esgoto/12.jpg"))
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
					u.aguarde(200)
				}
				se (ponto == 13)
				{
					g.desenhar_imagem(0, 0, g.carregar_imagem("/portas_esgoto/13.jpg"))
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
					u.aguarde(200)
				}
				g.renderizar()
		}
	}
}
/* $$$ Portugol Studio $$$ 
 * 
 * Esta seção do arquivo guarda informações do Portugol Studio.
 * Você pode apagá-la se estiver utilizando outro editor.
 * 
 * @POSICAO-CURSOR = 292; 
 * @PONTOS-DE-PARADA = ;
 * @SIMBOLOS-INSPECIONADOS = ;
 * @FILTRO-ARVORE-TIPOS-DE-DADO = inteiro, real, logico, cadeia, caracter, vazio;
 * @FILTRO-ARVORE-TIPOS-DE-SIMBOLO = variavel, vetor, matriz, funcao;
 */