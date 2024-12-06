<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "projeto_jonas";

// Conexão com o banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Obtém o ID da publicação da URL
$id = $_GET['id'];

/*
    o operador -> é usado para acessar métodos e propriedades de um objeto. 
    Ele é utilizado quando você trabalha com Programação Orientada a Objetos (POO) em PHP.

    $result: É uma variável que geralmente contém o resultado de uma consulta SQL
    executada usando mysqli_query(). Este resultado pode conter várias linhas.

    query($sql): É um método da classe mysqli usado para executar uma consulta SQL no
    banco de dados. O parâmetro $sql é uma string que contém a consulta SQL que você
    deseja executar.
*/

// Consulta SQL para buscar os detalhes da publicação
$sql = "SELECT * FROM publicacao WHERE id_publicacao = $id";
$result = $conn->query($sql);

// Fecha a conexão
$conn->close();
?>


<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projeto de Publicações</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Projeto de Publicações</h1>
    </header>

    <nav>
        <ul>
            <li><a href="http://localhost/PHP_fatec/_Projeto_Jonatas/ProjetoDEFINITIVO_Jonas/home.php">Home</a></li>
        </ul>
    </nav>

    <?php

        /*
            A expressão $row = $result->fetch_assoc(); é usada para recuperar uma
            linha de resultados de uma consulta SQL como um array associativo,
            É a variável que armazenará a linha atual do resultado da consulta
            em formato de array associativo.
            
            fetch_assoc(): É um método do objeto resultante da consulta SQL.
            Ele recupera a próxima linha de resultados como um array associativo.
            Isso significa que cada coluna da linha será um elemento do array,
            onde a chave do array é o nome da coluna e o valor é o valor da coluna.
        */

        // Verifica se a publicação existe
        if ($result->num_rows > 0) {
            // Exibe os detalhes da publicação
            $row = $result->fetch_assoc();
            echo '<section id="publicacao">' ."<h1>" . htmlspecialchars($row["nome_publicacao"]) . "</h1>" . "</section>";
            echo '<section id="descricao">' ."<p>" ."<p><strong>Descrição:</strong> " . htmlspecialchars($row["descricao_publicacao"]) . "</p>" . "</section>";
            echo '<section id="autores">' ."<p><strong>Autores:</strong> " . htmlspecialchars($row["autores_publicacao"]) . "</p>" . "</section>";
            echo '<section id="classificacao">' ."<p><strong>Classificação:</strong> " . htmlspecialchars($row["classificacao_autores"]) . "</p>" . "</section>";
            echo '<section id="divulgacao">' ."<p><strong>Divulgação:</strong> " . htmlspecialchars($row["divulgacao_publicacao"]) . "</p>" . "</section>";
            echo '<section id="convidados">' ."<p><strong>Convidados:</strong> " . htmlspecialchars($row["convidados_publicacao"]) . "</p>" . "</section>";
        } else {
            echo "<p>Publicação não encontrada.</p>";
        }

        // Alterar o campo divulgação para uma página que irá receber o conteúdo de convidados e etc...
    ?>

    <footer>
        <p>&copy; 2024 Projeto de Publicações</p>
    </footer>
</body>
</html>
