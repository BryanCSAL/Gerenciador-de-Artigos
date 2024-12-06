<?php
/*
OBSERVAÇÃO: MODIFICAR OS VARIAVEIS DE REFERNCIA AO BANCO DE DADOS NO CODIGO, QUANDO CRIAR O NOVO

SUGESTÃO: TABELA USUARIO: ID_USUARIO (CHAVE PRIMÁRIA e AUTO INCREASE), LOGIN_USUARIO, SENHA_USUARIO
*/

session_start();

$servername = "localhost";
$username = "root";
$password = ""; // Senha do MySQL (se houver)
$dbname = "projeto_jonas";

// Criar conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['login_usuario'];
    $password = $_POST['senha_usuario'];

    // Consultar usuário pelo email
    $sql = "SELECT * FROM usuario WHERE login_usuario = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    // Verificar se o usuário existe e se a senha corresponde
    if ($user && $password === $user['senha_usuario']) {
        $_SESSION['user_id'] = $user['id_usuario'];
        // Caso o login seja efetuado, redirecionar o usuário para a página principal
        header("Location: http://localhost/PHP_fatec/_Projeto_Jonatas/ProjetoDEFINITIVO_Jonas/home.php");
        exit();
    } else {
        // Caso o usuario e/ou senha estejam incorretos, lançar um pop-up de erro
        echo "<script type='text/javascript'>
            alert('Senha ou email incorretos!');
            window.location.href = 'index.php';
          </script>";
    }

}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="styles_login.css">
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <form action="" method="post">
            <label for="username">Username</label>
            <input type="text" id="login_usuario" name="login_usuario" required>

            <label for="password">Password</label>
            <input type="password" id="senha_usuario" name="senha_usuario" required>

            <button type="submit">Login</button>
        </form>
        <!-- Não Funciona, é só para ter-->
        <p class="register-link">Don't have an account? <a href="register.html">Register here</a></p>
    </div>
</body>
</html>
