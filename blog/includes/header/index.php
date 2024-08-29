<!--Importar 'header.js' em assets/js-->
<!--Iportar 'header.css' em assets/css-->

<?php
   
?>

<header>
    <div class="logo">
        <p class="text-logo">Blog</>
    </div>
    <div class="menu-bar">
        <div class="menu-t"></div>
        <div class="menu-t"></div>
        <div class="menu-t"></div>
    </div>
</header>
<div class="options-menu-open">
    <?php 
        if(isset($_SESSION['login-admin']) && $_SESSION['login-admin'] === true){ ?>
            <a href="../adm/editor-admin.php" class="option">
                Painel Administrador
                
            </a>
    <?php } else if(isset($_SESSION['login']) && $_SESSION['login'] === true){  ?>
            <a href="../account" class="option">
                Minha Conta
                
            </a>
    <?php } else { ?>
            <a href="../login" class="option">
                Login | Cadastrar-se
            </a>
    <?php } ?>

    <a href="blog" class="option">Home</a>
    <a href="admin" class="option">Admin</a>
    <a href="conta" class="option">Conta</a>
    <a href="newslater" class="option">Newslater</a>
    <a href="publi" class="option">Publi</a>
    <a href="search" class="option">Search</a>
    <a href="sobre" class="option">Sobre</a>

    <div class="option" id="toggle-theme">
        <div class="theme-switcher-area">
            <form action="" method="post" id="form-theme">
                <input type="checkbox" id="theme-switcher" name="theme" value="dark" <?= isset($_COOKIE['dark-theme']) && $_COOKIE['dark-theme'] == 'true' ? 'checked' : '' ?>>
                <label for="theme-switcher" class="theme-switcher-button"></label>
            </form>
        </div>
    </div>
</div>