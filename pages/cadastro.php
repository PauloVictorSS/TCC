<section class="cadastro">
	<h1>Crie um Cadastro!</h1>
	<form action="#" method="POST">
		<div class="input-box">
			<label for='nome'>Nome:</label>
			<input type="text" name="nomeForm" placeholder="Nome" id="nome">
		</div>
		<div class="input-box">
			<label for="login">Login:</label>
			<input type="text" name="login" placeholder="Usuário" id="login">
		</div>
		<div class="input-box">
			<label for='senha'>Senha:</label>
			<input type="password" name="senhaForm" placeholder="Senha"id="senha">
		</div>
		<div class="input-box">
			<label for='tel'>Telefone:</label>
			<input type="text" name="telForm" placeholder="Telefone" id="tel">
		</div>
		<div class="input-box">
			<label for='email'>Email:</label>
			<input type="text" name="emailForm" placeholder="Email" id="email">
		</div>
		
		<input type="submit" id="btnCadastro" value="Cadastrar">
	</form>
	<a href="<?php echo INCLUDE_PATH; ?>login" id="aCadastro">Já tem cadastro?</a>
</section>
