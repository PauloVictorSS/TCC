<?php    
 
    include "../config.php";
    include "../database/conexao_mysql.php";     

    $select = "select * from funcionario where id=".$_SESSION["id_func"];    
    $result = mysqli_query($conexao, $select);

    $func = mysqli_fetch_array($result);
?>

<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Salão de Beleza Mãe e Filhas</title>
		<meta name="description" content="Salão de Beleza">
        <meta name="robots" content="index, follow">

        <link rel="icon" href="<?php echo INCLUDE_PATH; ?>images/favicon.ico" type="image/x-icon">
		<link rel="stylesheet" href="<?php echo INCLUDE_PATH_PAINEL; ?>css/main.css">
        <?php
            if(isset($_SESSION["alternative_main"]))
                echo '<link rel="stylesheet" href="'.INCLUDE_PATH.'css/alternative_main.css">';
            else
                echo '<link rel="stylesheet" href="'.INCLUDE_PATH.'css/main.css">';

            if(isset($_GET['url'])){

                $url = strtolower(str_replace("-", "_", $_GET['url']));
                echo"<link rel='stylesheet' href='".INCLUDE_PATH_PAINEL."css/$url.css'>";
            }  
        ?>

		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;700&family=Noto+Sans&display=swap" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&display=swap" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville&display=swap" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css2?family=Rubik:ital@1&display=swap" rel="stylesheet"> 
		<link href="https://fonts.googleapis.com/css2?family=Yellowtail&display=swap" rel="stylesheet"> 
        <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@200&family=Yellowtail&display=swap" rel="stylesheet">

    </head>
    <body id="body_area_func">
        <section class="area_func">
            <div class="inf-func">
                <div class="avatar-func">
                    <img src="<?php echo INCLUDE_PATH; ?>images/padrao.jpg" class="left">

                    <div class="text-func">
                        <p>Olá <?php echo $func["nome"]; ?></p>
                        <p class="left">Status:   </p>
                        <p id="status"> <div class="bola"></div> Online</p>
                        
                    </div>

                    <div class="clear"></div>
                    <div class="botao-menu-mobile right">
                        <i class="fa fa-bars" aria-hidden="true"></i>
                    </div>
                    <div class="clear"></div>
                </div> 
                <div class="links">
                    <h4>Navegação Principal:</h4>

                    <a href="<?php echo INCLUDE_PATH_PAINEL; ?>Gerenciar-Clientes"><i class="fa fa-pencil-square-o " aria-hidden="true"></i> Gerenciar Clientes</a>

                    <a href="<?php echo INCLUDE_PATH_PAINEL; ?>Gerenciar-Galeria"><i class="fa fa-picture-o " aria-hidden="true"></i> Gerenciar Galeria</a>

                    <a href="<?php echo INCLUDE_PATH_PAINEL; ?>Gerenciar-Paginas"><i class="fa fa-align-right " aria-hidden="true"></i> Gerenciar Páginas</a>

                    <a href="<?php echo INCLUDE_PATH_PAINEL; ?>Gerenciar-Agendamentos"><i class="fa fa-calendar " aria-hidden="true"></i> Gerenciar Agendamentos</a>

                    <a href="<?php echo INCLUDE_PATH_PAINEL; ?>Gerenciar-Servicos"><i class="fa fa-book " aria-hidden="true"></i> Gerenciar Serviços</a>
                    
                    <a href="<?php echo INCLUDE_PATH_PAINEL; ?>Gerenciar-Produtos"><i class="fa fa-shopping-basket" aria-hidden="true"></i> Controle de Estoque</a>

                </div>
                
            </div>
            <div class="clear"></div>
            <div class="titulo">
                <h1 class="left">Area de Trabalho</h1>
                <a href="../php/loggout.php" class="right"> <i class="fa fa-sign-out"></i>Logout</a>
                <a href="<?php echo INCLUDE_PATH; ?>" class="right"><i class="fa fa-home" aria-hidden="true"></i>Home</a>
                <div class="clear"></div>
            </div>
            <div class="page">
                <div class="area_trabalho">
                <?php
               
                    if(isset($_GET['url'])){

                        $url = strtolower(str_replace("-", "_", $_GET['url']));

                        if(file_exists("pages/".$url.".php"))
                            include("pages/".$url.".php");
                        else
                            include("pages/home.php");

                    }else
                        include("pages/home.php");
                    
                ?>
                </div>
            </div>
        </section>  

        <script src="<?php echo INCLUDE_PATH; ?>js/jquery.js"></script>
        <script src="<?php echo INCLUDE_PATH_PAINEL; ?>js/menu.js"></script>
	</body>
</html>