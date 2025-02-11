<?php

// Variável global para armazenar as contas
$contas = [];

// Carregar contas do arquivo
function carregarContas() {
    global $contas;
    if (file_exists('contas.txt')) {
        $contasData = file('contas.txt', FILE_IGNORE_NEW_LINES);
        foreach ($contasData as $contaData) {
            $contas[] = json_decode($contaData, true);
        }
    }
}

// Salvar contas no arquivo
function salvarContas() {
    global $contas;
    file_put_contents('contas.txt', ""); // Limpa o arquivo antes de salvar
    foreach ($contas as $conta) {
        file_put_contents('contas.txt', json_encode($conta) . PHP_EOL, FILE_APPEND);
    }
}

// Função para validar CPF
function validarCPF($cpf) {
    return strlen($cpf) == 11 && is_numeric($cpf);
}

// Criar conta
function cadastrarConta() {
    global $contas;
    
    echo "\nCadastro de conta:\n";
    $nome = readline("Nome: ");
    $telefone = readline("Telefone (com DDD): ");
    
    do {
        system('clear');
        $cpf = readline("CPF (11 dígitos): ");
    } while (!validarCPF($cpf));
    
    do {
        system('clear');
        $senha = readline("Senha (6 dígitos numéricos): ");
    } while (strlen($senha) != 6 || !is_numeric($senha));
    
    do {
        system('clear');
        $senhaTransacao = readline("Senha de transação (4 dígitos numéricos): ");
    } while (strlen($senhaTransacao) != 4 || !is_numeric($senhaTransacao));
    
    $numeroConta = uniqid();
    $contas[] = [
        "numeroConta" => $numeroConta,
        "cpf" => $cpf,
        "nome" => $nome,
        "telefone" => $telefone,
        "saldo" => 0,
        "senha" => $senha,
        "senhaTransacao" => $senhaTransacao
    ];
    salvarContas();
    system('clear');
    echo "\nConta criada com sucesso! Número da conta: $numeroConta\n";
    sleep(3);
}

// Buscar conta por CPF e senha
function acessarConta() {
    global $contas;
    system('clear');
    echo "\nAcessar Conta:\n";
    $cpf = readline("CPF: ");
    $senha = readline("Senha: ");
    
    foreach ($contas as &$conta) {
        if ($conta['cpf'] == $cpf && $conta['senha'] == $senha) {
            system('clear');
            echo "\nBem-vindo, {$conta['nome']}\n";
            while (true) {
                echo "\n========= MENU DA CONTA =========\n";
                echo "1. Depositar\n";
                echo "2. Sacar\n";
                echo "3. Consultar conta\n";
                echo "Pressione Enter para sair\n";
                $opcao = readline("Escolha uma opção: ");
                
                if ($opcao == "") {
                    break;
                }
                
                switch ($opcao) {
                    case 1:
                        depositar($conta);
                        break;
                    case 2:
                        sacar($conta);
                        break;
                    case 3:
                        imprimirInformacoesCliente($conta);
                        break;
                    default:
                        echo "\nOpção inválida. Tente novamente.\n";
                        sleep(3);
                        system('clear');
                }
            }
            return;
        }
    }
    system('clear');
    echo "\nConta não encontrada ou senha incorreta.\n";
    sleep(3);
}

// Depositar
function depositar(&$conta) {
    system('clear');
    echo "\nDepósito:\n";
    $senhaTransacao = readline("Senha de transação: ");
    if ($senhaTransacao !== $conta['senhaTransacao']) {
        system('clear');
        echo "\nSenha de transação incorreta.\n";
        sleep(3);
        return;
    }
    $quantia = (float) readline("Valor a depositar: ");
    $conta['saldo'] += $quantia;
    salvarContas();
    system('clear');
    echo "\nDepósito realizado! Novo saldo: R$ {$conta['saldo']}\n";
    sleep(3);
}

// Sacar
function sacar(&$conta) {
    system('clear');
    echo "\nSaque:\n";
    $senhaTransacao = readline("Senha de transação: ");
    if ($senhaTransacao !== $conta['senhaTransacao']) {
        system('clear');
        echo "\nSenha de transação incorreta.\n";
        sleep(3);
        return;
    }
    $quantia = (float) readline("Valor a sacar: ");
    if ($conta['saldo'] >= $quantia) {
        $conta['saldo'] -= $quantia;
        salvarContas();
        echo "\nSaque realizado! Novo saldo: R$ {$conta['saldo']}\n";
    } else {
        echo "\nSaldo insuficiente!\n";
    }
    sleep(3);
}

// Exibir informações
function imprimirInformacoesCliente($conta) {
    system('clear');
    echo "\nInformações:\n";
    echo "Nome: {$conta['nome']}\n";
    echo "Telefone: {$conta['telefone']}\n";
    echo "Saldo: R$ {$conta['saldo']}\n";
}

// Menu
function menu() {
    carregarContas();
    while (true) {
        system('clear');
        echo "\n========= MENU =========\n";
        echo "1. Criar nova conta\n";
        echo "2. Acessar conta\n";
        echo "3. Sair\n";
        $opcao = readline("Escolha uma opção: ");
        
        switch ($opcao) {
            case 1:
                cadastrarConta();
                break;
            case 2:
                acessarConta();
                break;
            case 3:
                system('clear');
                exit("\nSaindo...\n");
            default:
                system('clear');
                echo "\nOpção inválida. Tente novamente.\n";
                sleep(3);
        }
    }
}

menu();
