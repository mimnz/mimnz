<?php

// Globais
$contas = [];

// Função para carregar contas do arquivo
function carregarContas(&$contas) {
    if (file_exists('contas.txt')) {
        $contasData = file('contas.txt', FILE_IGNORE_NEW_LINES);
        foreach ($contasData as $contaData) {
            $contas[] = json_decode($contaData, true);
        }
    }
}

// Função para salvar as contas no arquivo
function salvarContas($contas) {
    $contasJson = array_map('json_encode', $contas);
    $result = file_put_contents('contas.txt', implode(PHP_EOL, $contasJson) . PHP_EOL);
    if ($result === false) {
        echo "Erro ao salvar as contas no arquivo.\n";
    }
}

// Função para validar CPF
function validarCPF($cpf): bool {
    return strlen($cpf) == 11 && is_numeric($cpf);
}

// Função para cadastrar conta
function cadastrarConta(&$contas) {
    system('clear');
    
    $nome = readline("Digite o nome do cliente: ");
    $telefone = readline("Digite o telefone do cliente (com DDD): ");
    
    // Validar CPF
    $cpf = readline("Digite o CPF do cliente (11 dígitos): ");
    while (!validarCPF($cpf)) {
        system('clear');
        print "CPF inválido! O CPF deve ter exatamente 11 dígitos numéricos.\n";
        $cpf = readline("Digite o CPF do cliente (11 dígitos): ");
    }

    // Senha de 6 dígitos para a conta
    $senha = readline("Digite uma senha de 6 dígitos para a conta: ");
    while (strlen($senha) != 6 || !is_numeric($senha)) {
        system('clear');
        print "Senha inválida. A senha deve ter exatamente 6 dígitos numéricos.\n";
        $senha = readline("Digite uma senha de 6 dígitos para a conta: ");
    }

    // Senha de 4 dígitos para transações
    $senhaTransacao = readline("Digite uma senha de 4 dígitos para realizar depósitos e saques: ");
    while (strlen($senhaTransacao) != 4 || !is_numeric($senhaTransacao)) {
        system('clear');
        print "Senha de transação inválida. A senha deve ter exatamente 4 dígitos numéricos.\n";
        $senhaTransacao = readline("Digite uma senha de 4 dígitos para realizar depósitos e saques: ");
    }

    // Criando número da conta
    $numeroConta = uniqid(); // Gerar ID único para a conta

    // Criar a conta
    $conta = [
        "numeroConta" => $numeroConta,
        "cpf" => $cpf,
        "nome" => $nome,
        "telefone" => $telefone,
        "saldo" => 0,
        "senha" => $senha,
        "senhaTransacao" => $senhaTransacao
    ];

    // Salvar a conta
    $contas[] = $conta;
    salvarContas($contas);
    system('clear');
    print "Conta criada com sucesso!\n";
    print "Número da conta: $numeroConta\n";
    sleep(3); // Pausa de 3 segundos
}

// Função para buscar conta por CPF e senha
function buscarContaPorCpfESenha(&$contas, $cpf, $senha) {
    foreach ($contas as &$conta) {
        if ($conta['cpf'] == $cpf && $conta['senha'] == $senha) {
            return $conta;
        }
    }
    return null;
}

// Função para buscar conta por CPF e senha de transação
function buscarContaPorCpfESenhaDeTransacao(&$contas, $cpf, $senhaTransacao) {
    foreach ($contas as &$conta) {
        if ($conta['cpf'] == $cpf && $conta['senhaTransacao'] == $senhaTransacao) {
            return $conta;
        }
    }
    return null;
}

// Função para realizar depósito
function depositar(&$contas, $cpf, $senhaTransacao, $quantia) {
    if ($quantia <= 0) {
        system('clear');
        print "Valor de depósito inválido. O valor deve ser positivo.\n";
        sleep(3); // Pausa de 3 segundos
        return;
    }

    // Buscar a conta pela combinação CPF e senha de transação
    $conta = buscarContaPorCpfESenhaDeTransacao($contas, $cpf, $senhaTransacao);
    if ($conta) {
        $conta['saldo'] += $quantia;  // Somando o valor depositado ao saldo
        system('clear');
        print "Depósito de R$ {$quantia} realizado com sucesso na conta.\n";
        print "Novo saldo: R$ {$conta['saldo']}\n";  // Exibindo o saldo atualizado
        sleep(3); // Pausa de 3 segundos

        // Atualiza as informações no arquivo de contas
        salvarContas($contas); // Salva as contas com o saldo atualizado
        return;
    }

    system('clear');
    print "Conta não encontrada ou senha de transação incorreta.\n";
    sleep(3); // Pausa de 3 segundos
}

// Função para realizar saque
function sacar(&$contas, $cpf, $senhaTransacao, $quantia) {
    if ($quantia <= 0) {
        system('clear');
        print "Valor de saque inválido. O valor deve ser positivo.\n";
        sleep(3); // Pausa de 3 segundos
        return;
    }

    $conta = buscarContaPorCpfESenhaDeTransacao($contas, $cpf, $senhaTransacao);
    if ($conta) {
        if ($quantia > $conta['saldo']) {
            system('clear');
            print "Saldo insuficiente para o saque de R$ {$quantia}.\n";
            sleep(3); // Pausa de 3 segundos
            return;
        }
        $conta['saldo'] -= $quantia;
        system('clear');
        print "Saque de R$ {$quantia} realizado com sucesso da conta.\n";
        sleep(3); // Pausa de 3 segundos

        // Atualiza as informações no arquivo
        salvarContas($contas);
        return;
    }

    system('clear');
    print "Conta não encontrada ou senha de transação incorreta.\n";
    sleep(3); // Pausa de 3 segundos
}

// Função para imprimir as informações do cliente
function imprimirInformacoesCliente(&$contas, $cpf, $senha) {
    $conta = buscarContaPorCpfESenha($contas, $cpf, $senha);
    if ($conta) {
        system('clear');
        print "Informações do cliente:\n";
        print "Nome: {$conta['nome']}\n";
        print "Telefone: {$conta['telefone']}\n";
        print "CPF: {$conta['cpf']}\n";
        print "ID: {$conta['numeroConta']}\n";
        print "Saldo: R$ {$conta['saldo']}\n";
        print "\nPressione 0 para sair ou qualquer tecla para voltar ao menu.\n";
        
        $input = readline("Escolha uma opção: ");
        if ($input == '0') {
            return;
        } else {
            // Retorna ao menu
            return;
        }
    } else {
        system('clear');
        print "Conta não encontrada ou senha incorreta.\n";
        sleep(3); // Pausa de 3 segundos
    }
}

// Função para acessar conta
function acessarConta(&$contas) {
    $cpf = readline("Digite o CPF da conta: ");
    $senha = readline("Digite a senha de 6 dígitos da conta: ");
    
    while (!validarCPF($cpf) || strlen($senha) != 6 || !is_numeric($senha)) {
        system('clear');
        print "CPF ou senha inválidos. O CPF deve ter 11 dígitos numéricos e a senha deve ter 6 dígitos numéricos.\n";
        $cpf = readline("Digite o CPF da conta: ");
        $senha = readline("Digite a senha de 6 dígitos da conta: ");
    }

    $conta = buscarContaPorCpfESenha($contas, $cpf, $senha);
    if ($conta) {
        while (true) {
            system('clear');
            print "\nMENU DA CONTA\n";
            print "1. Depositar\n";
            print "2. Sacar\n";
            print "3. Imprimir informações do cliente\n";
            print "4. Sair\n";
            $opcaoConta = readline("Escolha uma opção: ");
            
            switch ($opcaoConta) {
                case 1:
                    $senhaTransacao = readline("Digite a senha de 4 dígitos para depósito: ");
                    while (strlen($senhaTransacao) != 4 || !is_numeric($senhaTransacao)) {
                        system('clear');
                        print "Senha de transação inválida. A senha deve ter exatamente 4 dígitos numéricos.\n";
                        $senhaTransacao = readline("Digite a senha de 4 dígitos para depósito: ");
                    }
                    $quantia = readline("Digite o valor para depósito: ");
                    depositar($contas, $cpf, $senhaTransacao, (float)$quantia);
                    break;
                case 2:
                    $senhaTransacao = readline("Digite a senha de 4 dígitos para saque: ");
                    while (strlen($senhaTransacao) != 4 || !is_numeric($senhaTransacao)) {
                        system('clear');
                        print "Senha de transação inválida. A senha deve ter exatamente 4 dígitos numéricos.\n";
                        $senhaTransacao = readline("Digite a senha de 4 dígitos para saque: ");
                    }
                    $quantia = readline("Digite o valor para saque: ");
                    sacar($contas, $cpf, $senhaTransacao, (float)$quantia);
                    break;
                case 3:
                    imprimirInformacoesCliente($contas, $cpf, $senha);
                    break;
                case 4:
                    return;
                default:
                    system('clear');
                    print "Opção inválida. Tente novamente.\n";
                    sleep(3); // Pausa de 3 segundos
            }
        }
    } else {
        system('clear');
        print "Conta não encontrada ou senha incorreta.\n";
        sleep(3); // Pausa de 3 segundos
    }
}

// Função do menu principal
function menu() {
    global $contas;
    print "\nMENU PRINCIPAL\n";
    print "1. Cadastrar conta do cliente\n";
    print "2. Acessar conta do cliente\n";
    print "3. Sair\n";
    
    $opcao = readline("Escolha uma opção: ");
    
    switch ($opcao) {
        case 1:
            cadastrarConta($contas);
            break;
        case 2:
            acessarConta($contas);
            break;
        case 3:
            print "Saindo...\n";
            exit;
            break;
        default:
            system('clear');
            print "Opção inválida! Tente novamente.\n";
            sleep(3); // Pausa de 3 segundos
    }
}

// Carregar as contas no início do programa
carregarContas($contas);

// Loop principal do programa
while (true) {
    system('clear');
    menu();
}

?>
