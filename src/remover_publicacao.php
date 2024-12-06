<?php
// Verifica se o ID foi passado na URL
if (isset($_GET['id'])) {
    $id_publicacao = $_GET['id'];

    // Conexão com o banco de dados
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "projeto_jonas";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verifica se a conexão foi bem-sucedida
    if ($conn->connect_error) {
        die("Falha na conexão: " . $conn->connect_error);
    }

    // Prepara a consulta SQL para excluir a publicação
    $stmt = $conn->prepare("DELETE FROM publicacao WHERE id_publicacao = ?");
    $stmt->bind_param("i", $id_publicacao);

    // Executa a consulta
    if ($stmt->execute()) {
        echo "Publicação removida com sucesso.";
    } else {
        echo "Erro ao remover publicação: " . $stmt->error;
    }

    // Fecha a conexão
    $stmt->close();
    $conn->close();

    // Redireciona de volta para a página de gerenciamento
    header("Location: gerenciar.php");
    exit();
} else {
    echo "ID de publicação inválido.";
}
?>
