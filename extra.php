<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de Publicações</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <header>
        <h1>Gerenciamento de Publicações</h1>
    </header>
    
    <nav>
        <ul>
            <li><a href="http://localhost/PHP_fatec/_Projeto_Jonatas/ProjetoDEFINITIVO_Jonas/home.php">Home</a></li>
        </ul>
    </nav>
    
    <section>
        <h2>Adicionar Nova Publicação</h2>
        <form action="" method="POST">
            <label for="nome_publicacao">Título:</label><br>
            <input type="text" id="comando" name="comando" required><br>

            <input type="submit" value="Avaliar por mínimo">
            <input type="submit" value="Adicionar Publicação">
        </form>
    </section>

    <section>
        <h2>Gerenciar Publicações Existentes</h2>
        <table>
            <thead>
                <tr>
                    <th>Título</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Conexão com o banco de dados usando PDO
                $dsn = "mysql:host=localhost;dbname=projeto_jonas;charset=utf8mb4";
                $username = "root";
                $password = "";

                try {
                    $pdo = new PDO($dsn, $username, $password);
                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    // Query para buscar publicações
                    $sql = "SELECT id_publicacao, nome_publicacao FROM publicacao";
                    $stmt = $pdo->query($sql);

                    if ($stmt->rowCount() > 0) {
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row['nome_publicacao']) . "</td>";
                            echo "<td>
                                    <a href='editar.php?id=" . $row['id_publicacao'] . "'>Editar</a> |
                                    <a href='remover_publicacao.php?id=" . $row['id_publicacao'] . "' onclick='return confirm(\"Tem certeza que deseja remover esta publicação?\")'>Remover</a>
                                  </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='2'>Nenhuma publicação encontrada.</td></tr>";
                    }
                } catch (PDOException $e) {
                    echo "Erro na conexão ou execução: " . $e->getMessage();
                }

                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    // Captura os dados do formulário
                    $valor_inserido = $_POST['comando'];

                    // Exemplo de inserção com PDO (caso necessário)
                    try {
                        $sqlInsert = "INSERT INTO publicacao (nome_publicacao) VALUES (:nome_publicacao)";
                        $stmtInsert = $pdo->prepare($sqlInsert);
                        $stmtInsert->bindParam(':nome_publicacao', $valor_inserido);
                        $stmtInsert->execute();

                        echo "<p>Publicação adicionada com sucesso!</p>";
                    } catch (PDOException $e) {
                        echo "Erro ao inserir publicação: " . $e->getMessage();
                    }
                }

                
                // Uso de CLASSES E HERANÇA
                class Artigo {
                    public $nome;
                    public $nome_autor;
                    public $nome_colaborador;
                    public $data_emissao;
                    public $data_aprovacao;
                    

                    public function __construct($nome, $nome_autor,$nome_colaborador, $data_emissao, $data_aprovacao){
                        $this->nome = $nome;
                        $this->nome_autor = $nome_autor;
                        $this->nome_colaborador = $nome_colaborador;
                        $this->data_emissao = $data_emissao;
                        $this->data_aprovacao = $data_aprovacao;
                    }

                    // Executanto função que utiliza OPERADORES TERNARIOS
                    public function calcularTempoAprovacao($data_emissao, $data_aprovacao){
                        // Regex para validar o formato DD/MM/YYYY
                        $regex = "/^(0[1-9]|[12]\d|3[01])\/(0[1-9]|1[0-2])\/\d{4}$/";

                        // Validação das datas com operador ternário
                        $data_emissao_correta = preg_match($regex, $data_emissao) ? true : false;
                        $data_aprovacao_correta = preg_match($regex, $data_aprovacao) ? true : false;

                        // Condicional para prosseguir ou retornar erro
                        return ($data_emissao_correta && $data_aprovacao_correta) ? 
                            (function() use ($data_emissao, $data_aprovacao) {
                                // Divide e converte as datas para objetos DateTime
                                [$dia_emissao, $mes_emissao, $ano_emissao] = explode("/", $data_emissao);
                                [$dia_aprovacao, $mes_aprovacao, $ano_aprovacao] = explode("/", $data_aprovacao);

                                $data1 = DateTime::createFromFormat("Y-m-d", "$ano_emissao-$mes_emissao-$dia_emissao");
                                $data2 = DateTime::createFromFormat("Y-m-d", "$ano_aprovacao-$mes_aprovacao-$dia_aprovacao");

                                // Calcula diferença ou retorna erro se conversão falhar
                                return ($data1 && $data2) ? 
                                    $data1->diff($data2)->format('%a dias') : 
                                    "Erro ao converter datas para DateTime.";
                            })() 
                            : "Uma ou ambas as datas estão em formato inválido.";
                    }

                    // Função que utiliza FOR, SWITCH e ARRAY
                    public function detalharAprovacao() {
                        // Cria um array com informações sobre o artigo
                        $detalhes = [
                            'Título' => $this->nome,
                            'Autor' => $this->nome_autor,
                            'Colaborador' => $this->nome_colaborador,
                            'Data de Emissão' => $this->data_emissao,
                            'Data de Aprovação' => $this->data_aprovacao,
                        ];

                        // Itera sobre os detalhes usando for
                        $chaves = array_keys($detalhes);
                        $valores = array_values($detalhes);

                        for ($i = 0; $i < count($detalhes); $i++) {
                            // Usa switch para categorizar as informações
                            switch ($chaves[$i]) {
                                case 'Título':
                                    echo "📝 " . $chaves[$i] . ": " . $valores[$i] . "\n";
                                    break;

                                case 'Autor':
                                    echo "✍️ " . $chaves[$i] . ": " . $valores[$i] . "\n";
                                    break;

                                case 'Colaborador':
                                    echo "🤝 " . $chaves[$i] . ": " . $valores[$i] . "\n";
                                    break;

                                case 'Data de Emissão':
                                    echo "📅 " . $chaves[$i] . ": " . $valores[$i] . "\n";
                                    break;

                                case 'Data de Aprovação':
                                    echo "✅ " . $chaves[$i] . ": " . $valores[$i] . "\n";
                                    break;

                                default:
                                    echo "⚠️ Informação desconhecida: " . $valores[$i] . "\n";
                                    break;
                            }
                        }
                    }
                }

                class Monografia extends Artigo {

                    public function nomeAutor(){
                        echo $this->nome_autor;
                    }
                    
                }

                $agua_cuca = new Monografia("Águas de cuca", "Mario Eretun", "Enzum Bitchola", "21/02/2023", "21/03/2023");

                //Exemplo do uso de FUNCAO COM PARAMETRO, OPERADORES ARITIMÉTICOS, INCREMENTO e FOREACH
                function avaliar_quantidade_minima($pdo, $quantidade) {
                    try {
                        // Consulta para obter os dados da tabela
                        $sql = "SELECT id_publicacao FROM publicacao";
                        $stmt = $pdo->query($sql); // Executa a consulta diretamente
                        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC); // Busca todas as linhas como array associativo
                
                        // Verifica se há resultados
                        if (count($resultados) > 0) {
                            $num_publicacao = 0; // Inicializa o contador de publicações
                
                            // Itera sobre os resultados
                            foreach ($resultados as $row) {
                                $num_publicacao++; // Incrementa o contador para cada publicação
                
                                // Verifica se a quantidade é maior que a definida
                                if (($num_publicacao - 1) > $quantidade) {
                                    echo "O valor mínimo foi atingido ou ultrapassado.\n";
                                    break; // Encerra o loop, pois a condição já foi satisfeita
                                }
                            }
                
                            // Exibe a quantidade total de publicações, caso não tenha ultrapassado
                            echo "Quantidade total de publicações: $num_publicacao.\n";
                        } else {
                            echo "Nenhuma publicação encontrada.\n";
                        }
                    } catch (PDOException $e) {
                        echo "Erro ao avaliar a quantidade mínima: " . $e->getMessage();
                    }
                }

                ?>
            </tbody>
        </table>

        <h3><?php $agua_cuca -> nomeAutor(); ?></h3>
        <h3><?php avaliar_quantidade_minima($pdo, 2) ?></h3>
    </section>

</body>
</html>
<?php $pdo = null; // Fecha a conexão com o banco de dados ?>
