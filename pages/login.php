<section class="login">
	<h1>Login</h1>
	<form action="#" method="GET" id="formLogin">
		<div class="input-box">
			<label for='email'>Email:</label>
			<input type="text" name="emailForm" placeholder="email" id="email">
		</div>
		<div class="input-box">
			<label for='senha'>Senha:</label>
			<input type="text" name="senhaForm" placeholder="senha" id="senha">
		</div>
		<input type="submit" id="btnLogin" value="Logar">
	</form>
	<a href="<?php echo INCLUDE_PATH; ?>cadastro" id="aLogin">Não possui um cadastro? Crie um aqui!</a>
</section>
