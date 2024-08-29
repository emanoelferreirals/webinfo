<?php   
    require_once('../conexao_bd.php');
?>      

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <!--Configs HTML -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title></title>

    <!--Styles e Scripts da página-->
    <link rel="stylesheet" href="../assets/css/publi.css">
    <link rel="stylesheet" href="../includes/view_publi/view_publi.css">

    <!--Styles e Scripts - Header-->
    <link rel="stylesheet" href="../includes/header/header.css">
    <script src="../includes/header/header.js" defer></script>

    <!--Outros-->
    <link rel="stylesheet" href="../includes/style-elements.css">
</head>
<body>
    <?php 
        include('../includes/header/index.php');
    ?>
    
    <div class="container">
        <?php
            // verificação se i ID da publicação existe e se foi passado com parametro
            if(isset($_GET['id']) && !empty($_GET['id'])){
                global $conn;
                $query = "SELECT * FROM publicacoes WHERE id_publi = ?;";
                $stmt = $conn->prepare($query); // Preparando a Intrução
                // Inicializando o s parametros
                $id = $_GET['id'];
                $stmt->bind_param('i', $id);
                $stmt->execute();
                $result = $stmt->get_result(); // Result recebe um objeto mysqli
                //
                $dados_result = $result->fetch_assoc();
        
                // Verificação se a publicação existe
                if($result->num_rows > 0){
                    //instanciando as variaveis antes de chamar os elementos(obrigatório)
                    $data = date("d/m/Y",strtotime($dados_result['data_publicacao'])) . " às " . date("H:i", strtotime($dados_result['data_publicacao']));
                    $titulo = $dados_result['titulo'];
                    $subtitulo = $dados_result['descricao'];
                    $conteudo = $dados_result['conteudo'];
                    include_once('../includes/view_publi/index.php');
                }else{
                    echo '<h1 class="erro-page-titulo">Error 404: Page Not Found</h1>';
                    echo '<div class="erro-page-text"><p>Ops, não foi possivel encontrar este site :(</p>
                    <p>Publicação inexistente</p></div>';
                    // var_dump($result); // Escreve o objeto formatado na tela
                }
                $stmt->close();
            }else{
                echo '<h1 class="erro-page-titulo">Error 404: Page Not Found</h1>';
                echo '<div class="erro-page-text"><p>Ops, não foi possivel encontrar este site :(</p>
                <p>Nenhuma publicação indicada na URL da pagina  </p></div>';
            }
        ?>
    </div>

                    
</body>
</html>