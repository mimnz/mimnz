MODE_ENCRYPT = 1
MODE_DECRYPT = 0

def caesar(data, key, mode):
    alphabet = 'abcdefghijklmnopqrstuvwyzàáãâéêóôõíúçABCDEFGHIJKLMNOPQRSTUVWYZÀÁÃÂÉÊÓÕÍÚÇ'
    new_data = ''
    for c in data:
        index = alphabet.find(c)
        if index == -1:  # Se o caractere não estiver no alfabeto, mantenha-o sem alterações
            new_data += c
        else:
            new_index = index + key if mode == MODE_ENCRYPT else index - key
            new_index = new_index % len(alphabet)
            new_data += alphabet[new_index:new_index+1]
    return new_data

def try_all_shifts(data):
    alphabet = 'abcdefghijklmnopqrstuvwyzàáãâéêóôõíúçABCDEFGHIJKLMNOPQRSTUVWYZÀÁÃÂÉÊÓÕÍÚÇ'
    results = []
    for key in range(len(alphabet)):
        shifted_text = caesar(data, key, MODE_DECRYPT)
        results.append(f'Deslocamento {key}: {shifted_text}')
    return results

def main():
    print("Escolha uma opção:")
    print("1. Escolher chave (deslocamento específico)")
    print("2. Tentar todos os deslocamentos")

    choice = input("Digite o número da sua escolha: ").strip()

    original = input("Digite a mensagem que deseja converter: ")

    if choice == '1':  # Escolher chave
        try:
            key = int(input("Digite a chave (número de deslocamento): "))
            mode_choice = input("Escolha o modo: 'e' para criptografar ou 'd' para descriptografar: ").strip().lower()
            mode = MODE_ENCRYPT if mode_choice == 'e' else MODE_DECRYPT
            result = caesar(original, key, mode)
            print(f"Resultado: {result}")
        except ValueError:
            print("Erro: A chave deve ser um número inteiro.")
    
    elif choice == '2':  # Todos os deslocamentos
        all_shifts = try_all_shifts(original)
        for shift in all_shifts:
            print(shift)
    
    else:
        print("Opção inválida. Tente novamente.")

# Chama a função principal
if __name__ == "__main__":
    main()
