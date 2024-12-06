<?php
// Conexão com o banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "projeto_jonas";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Verifica se o ID da publicação foi passado via GET
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Busca os dados da publicação no banco de dados
    $sql = "SELECT nome_publicacao, descricao_publicacao, autores_publicacao, classificacao_autores, divulgacao_publicacao,  convidados_publicacao FROM publicacao WHERE id_publicacao = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Carrega os dados da publicação em variáveis
        $row = $result->fetch_assoc();
        $nome_publicacao = $row['nome_publicacao'];
        $descricao_publicacao = $row['descricao_publicacao'];
        $autores_publicacao = $row['autores_publicacao'];
        $classificacao_autores = $row['classificacao_autores'];
        $divulgacao_publicacao = $row['divulgacao_publicacao'];
        $convidados_publicacao = $row['convidados_publicacao'];
    } else {
        echo "Publicação não encontrada.";
        exit;
    }
}

/* 
    Passa os dados captados nos campos da página e envia para o BD
*/

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $nome_publicacao = $_POST['nome_publicacao'];
    $descricao_publicacao = $_POST['descricao_publicacao'];
    $autores_publicacao = $_POST['autores_publicacao'];
    $classificacao_autores = $_POST['classificacao_autores'];
    $divulgacao_publicacao = $_POST['divulgacao_publicacao'];
    $convidados_publicacao = $_POST['convidados_publicacao'];

    // Atualiza os dados da publicação no banco de dados
    $sql = "UPDATE publicacao SET nome_publicacao='$nome_publicacao', descricao_publicacao='$descricao_publicacao', autores_publicacao='$autores_publicacao', classificacao_autores='$classificacao_autores',  divulgacao_publicacao='$divulgacao_publicacao', convidados_publicacao='$convidados_publicacao' WHERE id_publicacao=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Publicação atualizada com sucesso.";
    } else {
        echo "Erro ao atualizar a publicação: " . $conn->error;
    }

    $conn->close();
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Publicação</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Editar Publicação</h1>
    </header>

    <!-- Trazendo o texto do próprio campo no BD, para facilitar a leitura e alteração --> 
    <section>
        <form action="" method="POST">
            <input type="hidden" name="id" value="<?php echo $id; ?>">

            <label for="nome_publicacao">Título:</label><br>
            <input type="text" id="nome_publicacao" name="nome_publicacao" value="<?php echo $nome_publicacao; ?>" required><br>

            <label for="descricao_publicacao">Descricao:</label><br>
            <textarea id="descricao_publicacao" name="descricao_publicacao" required><?php echo $descricao_publicacao; ?></textarea><br>

            <label for="autores_publicacao">Autores:</label><br>
            <textarea id="autores_publicacao" name="autores_publicacao" required><?php echo $autores_publicacao; ?></textarea><br>

            <label for="classificacao_autores">Classificação:</label><br>
            <textarea id="classificacao_autores" name="classificacao_autores" required><?php echo $classificacao_autores; ?></textarea><br>

            <label for="divulgacao_publicacao">Divulgação:</label><br>
            <textarea id="divulgacao_publicacao" name="divulgacao_publicacao" required><?php echo $divulgacao_publicacao; ?></textarea><br>

            <label for="convidados_publicacao">Convidados:</label><br>
            <textarea id="convidados_publicacao" name="convidados_publicacao" required><?php echo $convidados_publicacao; ?></textarea><br>
            <input type="submit" value="Salvar Alterações">
        </form>
    </section>

</body>
</html>
