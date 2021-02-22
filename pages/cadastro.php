<?php

    include "../config.php";
    include "../database/conexao_mysql.php";

    if(isset($_POST["btn_action"])){
        
        $nome = clear($_POST["nome"]);
        $senha = hash("sha512", clear($_POST["senha"]));
        $conf_senha = hash("sha512", clear($_POST["conf_senha"]));
        $tel = clear($_POST["tel"]);
        $email = clear($_POST["email"]);
        $conf_email = clear($_POST["conf_email"]);

        if($senha == $conf_senha){
            if($email == $conf_email){
                $verifica = "SELECT * FROM cliente WHERE email= '$email'";
                $resultado = mysqli_query($conexao, $verifica);
                
                if(mysqli_num_rows($resultado) == 0){

                    $comando = "INSERT INTO cliente (nome, senha, telefone, email) VALUES ('$nome','$senha','$tel','$email')";

                    $resultado2 = mysqli_query($conexao, $comando);
                    
                    echo "<div class='mensagem green'>Cadastro feito com sucesso</div>";
                }
                else
                    echo "<div class='mensagem red'>Este e-mail já cadastrado! Insira outro</div>";
            }
            else
                echo "<div class='mensagem red'>Os campos 'Email' e 'Confirme seu email' devem ser iguais</div>";
        }
        else
            echo "<div class='mensagem red'>Os campos 'Senha' e 'Confirme sua senha' devem ser iguais</div>"; 
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Salão de Beleza Mãe e Filhas</title>
		<meta name="description" content="Salão de Beleza">
        <meta name="robots" content="index, follow">
        
		<link rel="stylesheet" href="<?php echo INCLUDE_PATH; ?>css/page-login-cadastro.css">
        <?php
            if(isset($_SESSION["alternative_main"]))
                echo '<link rel="stylesheet" href="'.INCLUDE_PATH.'css/alternative_main.css">';
            else
                echo '<link rel="stylesheet" href="'.INCLUDE_PATH.'css/main.css">';
        ?>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        
		<link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;700&family=Noto+Sans&display=swap" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&display=swap" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville&display=swap" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css2?family=Rubik:ital@1&display=swap" rel="stylesheet"> 
		<link href="https://fonts.googleapis.com/css2?family=Yellowtail&display=swap" rel="stylesheet"> 
        <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@200&family=Yellowtail&display=swap" rel="stylesheet">
        <link rel="icon" href="<?php echo INCLUDE_PATH; ?>images/favicon.ico" type="image/x-icon">
	</head>
	
	<body class="body">
        <section class="cadastro">
            <a href="<?php echo INCLUDE_PATH; ?>" class="logo"><img src="../images/favicon.ico" alt="Mãe e Filhas"></a>
            <h1>Crie um Cadastro</h1>
            <form action="#" method="POST">

                <input type="email" name="email" placeholder="Email" id="email" required>
                <input type="email" name="conf_email" placeholder="Confirme seu email" id="conf_email" required>
                <input type="text" name="nome" placeholder="Nome" id="nome" required>
                <input type="password" name="senha" placeholder="Senha" id="senha" required>
                <input type="password" name="conf_senha" placeholder="Confirme sua senha" id="conf_senha" required>
                <input type="text" name="tel" placeholder="Telefone" id="tel" required>
                
                <input type="submit" id="btnCadastro" name="btn_action" value="Cadastrar">

            </form>
            <a href="<?php echo INCLUDE_PATH; ?>pages/login.php" id="aCadastro">Já tem cadastro?</a>
        </section>
    </body>
</html>

