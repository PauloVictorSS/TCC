<?php
    if(isset($_POST["btn_action"])){
        
        $nome = clear($_POST["nome"]);
        $senha = hash("sha512", clear($_POST["senha"]));
        $tel = clear($_POST["tel"]);
        $email = clear($_POST["email"]);

        $verifica = "SELECT * FROM cliente WHERE email= '$email'";
        $resultado = mysqli_query($conexao, $verifica);
        
        if(mysqli_num_rows($resultado) == 0){

            $comando = "INSERT INTO cliente (nome, senha, telefone, email) VALUES ('$nome','$senha','$tel','$email')";

			$resultado2 = mysqli_query($conexao, $comando);
			
			echo "<div class='mensagem green'>Cadastro feito com sucesso</div>";

        }
        else{
            echo "<div class='mensagem red'>Este e-mail já cadastrado! Insira outro</div>";
        }
    }
?>

<section class="cadastro">
	<h1>Crie um Cadastro!</h1>
	<form action="#" method="POST">

		<div class="input-box">
			<label for='email'>Email:</label>
			<input type="email" name="email" placeholder="Email" id="email" required>
		</div>
		<div class="input-box">
			<label for='nome'>Nome:</label>
			<input type="text" name="nome" placeholder="Nome" id="nome" required>
		</div>
		<div class="input-box">
			<label for='senha'>Senha:</label>
			<input type="password" name="senha" placeholder="Senha" id="senha" required>
		</div>
		<div class="input-box">
			<label for='tel'>Telefone:</label>
			<input type="text" name="tel" placeholder="Telefone" id="tel" required>
		</div>
		
		<input type="submit" id="btnCadastro" name="btn_action" value="Cadastrar">

	</form>
	<a href="<?php echo INCLUDE_PATH; ?>login" id="aCadastro">Já tem cadastro?</a>
</section>

