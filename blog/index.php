<?php

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>

    <!--Configs HTML -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Feed - Blog</title>


    <link rel="stylesheet" href="assets/css/home.css">
    <link rel="stylesheet" href="includes/header/header.css">

    <script src="includes/header/header.js" defer></script>
</head>
<body>
    <?php include('includes/header/index.php'); ?>
    
    <div class="container">
        <div class="destaques">
            <!--Anuncios mai relevantes-->
        </div>

        <p class="title">Feed</p>

        <main class="list-publi">
            <?php
                $dados = array(
                    'operacao' => 'carregar-posts',
                    'page' => 0,
                    'max_com'=>2
                );

                if(!isset($_GET['list']) || empty($_GET['list']) || $_GET['list'] < 1){
                    $dados['page'] = 1;
                }else{
                    $dados['page'] = $_GET['list'];
                }

                // Inicializa uma sessão cURL
                $ses_ch = curl_init('http://localhost/webinfo/blog/acoes.php');
                
                // Configura cURL para enviar uma requisição POST
                curl_setopt($ses_ch, CURLOPT_POST, 1);
                curl_setopt($ses_ch, CURLOPT_POSTFIELDS, http_build_query($dados));

                // Configura cURL para retornar a resposta
                curl_setopt($ses_ch, CURLOPT_RETURNTRANSFER, true);

                // Executa a requisição e captura a resposta
                $resposta_json = curl_exec($ses_ch);

                // Verifica se houve algum erro
                if(curl_errno($ses_ch)) {
                    echo 'Erro: ' . curl_error($ses_ch);
                } else {
                    // Exibe a resposta
                    $resposta_obj = json_decode($resposta_json);
                    /*echo "<pre>";
                        var_dump($resposta_obj);
                    echo "</pre>";*/  
                    
                    //
                    $total_posts = $resposta_obj->total_posts;

                    if($resposta_obj->sucess){
                        foreach($resposta_obj->dados as $item){ ?>
                            <a href='publi/?id=<?=$item->id?>'><?=$item->titulo?></a><br>

                    <?php } ?>

                            <div id='pagination'> 
                                <?php 
                                    echo "<br><br>";

                                    for($i = 1; $i <= $resposta_obj->num_pages; $i++){
                                        if($dados['page'] == $i){
                                            echo "<a href='?list=$i' class='selected btn-pagination'>" .$i. "</a>";
                                        }else{
                                            echo "<a href='?list=$i' class='btn-pagination'>" .$i. "</a>";
                                        }
                                    } 
                                ?> 
                            </div>
                        <?php
                    }
                }

                // Fecha a sessão cURL
                curl_close($ses_ch);
            ?>
        </main>

        <div id="pagination"></div>

    </div>

    <footer id="footer">
        Direitos reservados
    </footer>

</body>
</html>
