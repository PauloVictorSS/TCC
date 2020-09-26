<?php 
    if(isset($_POST["btn_action"])){

        $email = $_POST["email"];
        $senha = hash("sha512", $_POST["senha"]);

        $verifica = "SELECT * FROM cliente WHERE email= '$email' and senha= '$senha'";

        $resultado = mysqli_query($conexao, $verifica);

        if(mysqli_num_rows($resultado) == 1){
			$url = INCLUDE_PATH."pages/area_do_usuario.php";

			$inf_usuario = mysqli_fetch_array($resultado);

			$_SESSION["id_user"] = $inf_usuario['id'];

			echo "<div class='mensagem green'>Logado com sucesso! <br>ID do Usuário -> ".$_SESSION["id_user"]."</div>";
			
			header("Location: $url");
        }
        else{
            echo "<div class='mensagem red'>E-mail ou senha incorretos!</div>";
        }
    }
?>


<section class="login">
	<h1>Login</h1>
	<form action="#" method="POST" id="formLogin">
		<div class="input-box">
			<label for='email'>Email:</label>
			<input type="email" name="email" placeholder="email" id="email" required>
		</div>
		<div class="input-box">
			<label for='senha'>Senha:</label>
			<input type="password" name="senha" placeholder="senha" id="senha" required>
		</div>
		<input type="submit" id="btnLogin" name="btn_action" value="Logar">
	</form>
	<a href="<?php echo INCLUDE_PATH; ?>cadastro" id="aLogin">Não possui um cadastro?</a>
</section>

