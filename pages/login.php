<?php 

    include "../config.php";
    include "../database/conexao_mysql.php";     

    if(isset($_POST["btn_action"])){

        $email = $_POST["email"];
        $senha = hash("sha512", $_POST["senha"]);

		$verifica = "SELECT * FROM cliente WHERE email= '$email' and senha= '$senha'";
		$verifica2 = "SELECT * FROM funcionario WHERE email= '$email' and senha= '$senha'";

		$resultado = mysqli_query($conexao, $verifica);
		$resultado2 = mysqli_query($conexao, $verifica2);

        if(mysqli_num_rows($resultado) == 1){
			$url = INCLUDE_PATH."pages/area_do_usuario.php";

			$inf_usuario = mysqli_fetch_array($resultado);

			$_SESSION["id_user"] = $inf_usuario['id'];

			echo "<div class='mensagem green'>Logado com sucesso! <br>ID do Usuário -> ".$_SESSION["id_user"]."</div>";
			
			header("Location: $url");
		}
		else if(mysqli_num_rows($resultado2) == 1){
			$url = INCLUDE_PATH_PAINEL;

			$inf_usuario = mysqli_fetch_array($resultado2);

			$_SESSION["id_func"] = $inf_usuario['id'];

			echo "<div class='mensagem green'>Logado com sucesso! <br>ID do Usuário -> ".$_SESSION["id_user"]."</div>";
			
			header("Location: $url");
		}
        else{
            echo "<div class='mensagem red'>E-mail ou senha incorretos!</div>";
        }
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
        <link rel="stylesheet" href="<?php echo INCLUDE_PATH; ?>css/main.css">

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

        <section class="login">
            <a href="<?php echo INCLUDE_PATH; ?>" class="logo"><img src="../images/favicon.ico" alt="Mãe e Filhas"></a>
            <h1>Bem-vindo</h1>
            <form action="#" method="POST" id="formLogin">

                <input type="email" name="email" placeholder="E-mail" id="email" required>
                <input type="password" name="senha" placeholder="Senha" id="senha" required>

                <input type="submit" id="btnLogin" name="btn_action" value="Logar">
            </form>
            <a href="<?php echo INCLUDE_PATH; ?>pages/cadastro.php" id="aLogin">Não possui um cadastro?</a>
        </section>

    </body>
</html>

