<?php     

    include "config.php";
    include "conexao/conexao_mysql.php";     

?>

<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Salão de Beleza Mãe e Filhas</title>
		<meta name="description" content="Salão de Beleza">
		<meta name="robots" content="index, follow">
		<link rel="stylesheet" href="<?php echo INCLUDE_PATH; ?>css/style.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;700&family=Noto+Sans&display=swap" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&display=swap" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville&display=swap" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css2?family=Rubik:ital@1&display=swap" rel="stylesheet"> 
		<link href="https://fonts.googleapis.com/css2?family=Yellowtail&display=swap" rel="stylesheet"> 
		<link href="https://fonts.googleapis.com/css2?family=Raleway:wght@200&family=Yellowtail&display=swap" rel="stylesheet">
	</head>
	
	<body>
        <header>
        <div class="center">
            <div class="left"><a href="<?php echo INCLUDE_PATH; ?>"><h1 class="logo">Mãe e Filhas</h1></a></div>
            <nav class="desktop right">
                <ul>
                <li><a href="<?php echo INCLUDE_PATH; ?>">HOME</a></li>
					<li><a href="<?php echo INCLUDE_PATH; ?>galeria" class="a_galeria">GALERIA</a></li>
					<li><a href="<?php echo INCLUDE_PATH; ?>sobre" class="a_sobre">SOBRE</a></li>
					<li><a href="<?php echo INCLUDE_PATH; ?>contato" class="a_contato">CONTATO</a></li>
					<li><a href="<?php echo INCLUDE_PATH; ?>lista_servicos">AGENDE</a></li>
					<li><a href="<?php echo INCLUDE_PATH; ?>login">ENTRAR</a></li>
                </ul>
            </nav>
            <nav class="mobile right">
                <div class="botao-menu-mobile">
                    <i class="fa fa-bars" aria-hidden="true"></i>
                </div>
                <div class="clear"></div>
                <ul>
                    <li><a href="<?php echo INCLUDE_PATH; ?>">HOME</a></li>
					<li><a href="<?php echo INCLUDE_PATH; ?>galeria" class="a_galeria">GALERIA</a></li>
					<li><a href="<?php echo INCLUDE_PATH; ?>sobre" class="a_sobre">SOBRE</a></li>
					<li><a href="<?php echo INCLUDE_PATH; ?>contato" class="a_contato">CONTATO</a></li>
					<li><a href="<?php echo INCLUDE_PATH; ?>lista_servicos">AGENDE</a></li>
					<li><a href="<?php echo INCLUDE_PATH; ?>login">ENTRAR</a></li>
                </ul>
            </nav>
        </div>
        <div class="clear"></div>
    </header>
        <?php

            //Retornando a url do site
            $url = isset($_GET['url']) ? $_GET['url'] : 'home';

            /* Verificando se uma das âncoras foi selecionada */

            switch ($url) {
                //De acordo com a url utilizada cria um elemento com esse nome para a
                //futura manipulação pelo JavaScript com o JQuery
                case 'galeria':
                    echo "<target target='galeria'>";
                    break;

                case 'sobre':
                    echo "<target target='sobre'>";
                    break;

                case 'contato':
                    echo "<target target='contato'>";
                    break;

            } 

            //Verificando se a url escolhida existe
            if(file_exists('pages/'.$url.'.php'))
                include('pages/'.$url.'.php'); //incluindo a página da url
            else{
                if($url != 'galeria' && $url != 'sobre' && $url != 'contato')
                    header("Location: pages/404.php");
                else
                    include('pages/home.php');
            }
                
        ?>
        
		<footer>
            <p class="tituloRod">Todos os direitos reservados</p><br>
            <p class="tituloRod">Instituto Federal <br>Câmpus Hortolândia</p>
        </footer>

		<script src="http://code.jquery.com/jquery-1.12.0.min.js"></script>
        <script src="<?php echo INCLUDE_PATH; ?>js/galeria.js"></script>
        <script src="<?php echo INCLUDE_PATH; ?>js/jquery.js"></script>
        <script src="<?php echo INCLUDE_PATH; ?>js/scripts.js"></script>
        <script src="<?php echo INCLUDE_PATH; ?>js/menu.js"></script>
	</body>
</html>