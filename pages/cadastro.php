
		<div id="divCadastro">
			<h1>_</h1>
			<h1>Crie um Cadastro!</h1><br><br>
			<form action="#" method="GET" id="formCadastro">
				<label for='nome'>Nome:</label>
				<input type="text" name="nomeForm" placeholder="Nome" class="inputCadastro" id="nome"><br><br>
				<label for='tel'>Telefone:</label>
				<input type="text" name="telForm" placeholder="Telefone" class="inputCadastro" id="tel"><br><br>
				<label for='email'>Email:</label>
				<input type="text" name="emailForm" placeholder="Email" class="inputCadastro" id="email"><br><br>
				<label for='senha'>Senha:</label>
				<input type="text" name="senhaForm" placeholder="Senha" class="inputCadastro" id="senha">
				<br><br><br>
				<input type="submit" id="btnCadastro" value="Cadastrar">
			</form>
			<br><br>
			<a href="<?php echo INCLUDE_PATH; ?>login" id="aCadastro">Fazer Login</a><br><br>
		</div>
