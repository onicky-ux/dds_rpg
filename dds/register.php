<?php
// Inclua o arquivo de conexão com o banco de dados (db.php)
include 'db.php';

// Verifique se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capture os dados do formulário
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Dados do personagem
    $nome_personagem = $_POST['nome_personagem'];
    $idade = $_POST['idade'];
    $genero = $_POST['genero'];
    $aparencia = $_POST['aparencia'];
    $historia = $_POST['historia'];
    $raca = $_POST['raca'];
    $habilidade1 = $_POST['habilidade1'];
    $habilidade2 = $_POST['habilidade2'];
    $habilidade3 = $_POST['habilidade3'];
    $poder1 = $_POST['poder1'];
    $poder2 = $_POST['poder2'];
    $poder_unico = $_POST['poder_unico'];
    $arma_descricao = $_POST['arma_descricao'];
    $arma_poder = $_POST['arma_poder'];
    $pet_aparencia = $_POST['pet_aparencia'];
    $pet_poder = $_POST['pet_poder'];

    // Validação básica
    if (empty($username) || empty($email) || empty($password)) {
        echo "Por favor, preencha todos os campos obrigatórios.";
        exit;
    }

    // Verifique se o nome de usuário já existe no banco de dados
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->bindParam(':username', $username);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        echo "Nome de usuário já existe. Escolha outro.";
    } else {
        // Criptografe a senha antes de salvar no banco de dados
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Iniciar transação para garantir que ambos registros (usuário e personagem) sejam inseridos corretamente
        try {
            $pdo->beginTransaction();

            // Inserir os dados do usuário
            $stmt = $pdo->prepare("INSERT INTO users (username, email, password_hash) VALUES (:username, :email, :password_hash)");
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password_hash', $hashed_password);
            $stmt->execute();

            // Obtenha o ID do usuário recém-criado
            $user_id = $pdo->lastInsertId();

            // Inserir os dados do personagem
            $stmt = $pdo->prepare("
                INSERT INTO personagens 
                (nome, idade, genero, aparencia, historia, raca, habilidade1, habilidade2, habilidade3, poder1, poder2, poder_unico, arma_descricao, arma_poder, pet_aparencia, pet_poder) 
                VALUES 
                (:nome_personagem, :idade, :genero, :aparencia, :historia, :raca, :habilidade1, :habilidade2, :habilidade3, :poder1, :poder2, :poder_unico, :arma_descricao, :arma_poder, :pet_aparencia, :pet_poder)
            ");
            $stmt->bindParam(':nome_personagem', $nome_personagem);
            $stmt->bindParam(':idade', $idade);
            $stmt->bindParam(':genero', $genero);
            $stmt->bindParam(':aparencia', $aparencia);
            $stmt->bindParam(':historia', $historia);
            $stmt->bindParam(':raca', $raca);
            $stmt->bindParam(':habilidade1', $habilidade1);
            $stmt->bindParam(':habilidade2', $habilidade2);
            $stmt->bindParam(':habilidade3', $habilidade3);
            $stmt->bindParam(':poder1', $poder1);
            $stmt->bindParam(':poder2', $poder2);
            $stmt->bindParam(':poder_unico', $poder_unico);
            $stmt->bindParam(':arma_descricao', $arma_descricao);
            $stmt->bindParam(':arma_poder', $arma_poder);
            $stmt->bindParam(':pet_aparencia', $pet_aparencia);
            $stmt->bindParam(':pet_poder', $pet_poder);

            // Execute a inserção dos dados do personagem
            $stmt->execute();

            // Confirma a transação
            $pdo->commit();

            echo "Registro realizado com sucesso!";
            // Redireciona para a página de login ou a tela inicial do RPG
            header("Location: login.php");
            exit;
        } catch (Exception $e) {
            // Se algo der errado, reverte a transação
            $pdo->rollBack();
            echo "Erro ao registrar. Tente novamente: " . $e->getMessage();
        }
    }
}
?>
