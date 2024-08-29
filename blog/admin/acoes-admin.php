<?php
    require_once('../conexao_bd.php');

if(isset($_POST['operacao']) && !empty($_POST['operacao'])){
    $oper = $_POST['operacao'];

    switch($oper){
        case 'publicar': publicar();  break;
        case 'editar': editar(); break;
        case 'deletar': deletar(); break;
        case 'deletar': deletar(); break;
        case 'upload': uploadFile(); break;
    }
}


function publicar(){
    global $conn;

    if(isset($_POST['titulo']) &&
        !empty($_POST['titulo']) && 

        isset($_POST['descricao']) &&
        !empty($_POST['descricao']) && 

        isset($_POST['conteudo']) && 
        !empty($_POST['conteudo'])) {
    
            $titulo = $_POST['titulo'];
            $conteudo = $_POST['conteudo'];
            $descricao = $_POST['descricao'];
            $data = date("Y-m-d H:i:s");

            $query = "INSERT INTO publicacoes (titulo,descricao,conteudo,data_publicacao) VALUES (? , ?, ? , ?);";
            $stmt = $conn->prepare($query);
            $stmt->bind_param('sssd',$titulo,$descricao,$conteudo,$data);

            
            $result = $stmt->execute();

            if($result) {
                echo "Cadastrado";
            } else {
                echo "Erro ao cadastrar";
            }

    }else{
        echo "cade os arquivos?";
    }
}

function editar(){
    global $conn;

    if(isset($_POST['titulo-edit']) &&
        !empty($_POST['titulo-edit']) && 

        isset($_POST['descricao-edit']) && 
        !empty($_POST['descricao-edit']) && 

        isset($_POST['conteudo-edit']) && 
        !empty($_POST['conteudo-edit']) && 

        isset($_POST['id_edit']) &&
        !empty($_POST['id_edit'])) {
    
            $titulo = $_POST['titulo-edit'];
            $descricao = $_POST['descricao-edit'];
            $conteudo = $_POST['conteudo-edit'];
            $data = date("Y-m-d H:i:s");
            $id_edit = $_POST['id_edit'];

            $query = "UPDATE publicacoes SET titulo= ?,descricao= ?,conteudo= ?,data_publicacao= ? WHERE id_publi= ? ;";
            $stmt = $conn->prepare($query);

            if($stmt === FALSE){
                echo "Erro ao preparar a consulta: " . $conn->error;
                exit(); 
            }

            $stmt->bind_param('sssdi',$titulo, $descricao, $conteudo, $data, $id_edit);

            if($stmt->execute()) {   
                header('Location: view/?id='.$id_edit);
            } else {
                echo "Erro ao editar: " . $stmt->error;
            }

            $stmt->close();
        }
}

function deletar(){
    global $conn;

    if(isset($_POST['id_del']) &&
        !empty($_POST['id_del'])) {

            $id_del = $_POST['id_del'];

            $query = "DELETE FROM publicacoes WHERE id_publi=$id_del;";

            $result = mysqli_query($conn,$query);

            if($result) {
                echo "Excluir";
            } else {
                echo "Erro ao excluir";
            }
    }
}


function uploadFile(){
    if(!empty($_FILES['arquivo'])) {

        //RECOLHENDO INFOS DO ARQUIVO
        $nomeArquivo = $_FILES['arquivo']['name'];
        $tamanhoArquivo = $_FILES['arquivo']['size'];
        $extensaoArquivo = pathinfo($nomeArquivo,PATHINFO_EXTENSION);

        $maxTamanho = 10 *1024 * 1024;//2 megabytes
        $tiposPermitidos = array('jpg','png','pdf','gif','mp4','mp3');

        if($tamanhoArquivo <= $maxTamanho){
            if(in_array($extensaoArquivo,$tiposPermitidos)){

                if(move_uploaded_file($_FILES['arquivo']['tmp_name'],"../uploads/".$nomeArquivo)){
                    header('Location: editor-admin.php');
                    exit;
                }else {
                    echo 'Erro ao mover o arquivo para o diretório de destino.';
                }     
            }else{
                echo 'Apenas arquivos JPG, JPEG e PNG são permitidos.';
            }
        }else{
            echo 'O tamanho do arquivo é muito grande. O tamanho máximo permitido é de 10MB.';
        }

           
    }else{
        echo 'Nenhum arquivo selecionado';
    }
}

?>