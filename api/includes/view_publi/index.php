    <div class="publi texto theme-background">
        <p class="data">
            <?=$data?>
        </p> 

        <div>
            <h1 class="titulo">
                <?=$titulo?>
            </h1>
            <p class="subtitulo">
                <?=$subtitulo?>
            </p>
            <div class="conteudo">
                <?=$conteudo?>
            </div>
        </div>

        <div class="controls-admin">
            <!-- Adicione controles de administração aqui se necessário -->
        </div>

        <div class="insights">
            <div id="like">
                                        
            </div>
            <div id="open-comentarios">
                <p>🗨️<span id="num-com"></span></p>
            </div>
            <div class="problema">
                <a href="">⚠️<br> Informar problema</a>
            </div>
        </div>
    </div>      

    <!--Area comentarios-->
    <div class="comentarios-area texto theme-background">
        <h1>Comentários</h1>
        <form id="form-coment">
            <input type="hidden" name="operacao" value="comentario">
            <input type="hidden" name="id_publi_com" value="">
            <input type="text" name="comentario" id="comentario" placeholder="Fazer comentário..." minlength="1">

            <button type="submit" class="btn-comentar" id="btn-comentar" class="button">Comentar</button>
        </form>

        <div class="list-comentario texto theme-background" id="list-comentario">
        </div>
        <div id="sppiner">
            <img src="../assets/images/sppiner-transparent.gif" alt="Carregando...">
        </div>
        <button id="mais-com" class="texto">Ver mais</button>
    </div>  

    <div class="background-tela-confirme">
        <div class="area-confirme-excluir">
            <p>Tem certeza que quer excluir seu comentário?</p>
            <div>
                <button id="btn-cancelar">Cancelar</button>
                <button id="btn-confirme-excluir">Excluir</button>
            </div>
        </div>
    </div>
