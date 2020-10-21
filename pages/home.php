<?php

    // Import PHPMailer classes into the global namespace
    // These must be at the top of your script, not inside a function

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    // Load Composer's autoloader
    require 'vendor/autoload.php';

    if(isset($_POST["action"])){

		$nome = $_POST["nome"];
		$email = $_POST["email"];
		$tel = $_POST["tel"];
        $mens = str_replace("\n", "<br>",$_POST["mens"]);

        // Instantiation and passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {

            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );
            //Server settings
            //$mail->SMTPDebug = 3;                      // Enable verbose debug output
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = 'paulovictorsantos0@gmail.com';                     // SMTP username
            $mail->Password   = 'zcnnckhjposdwziy';                               // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

            //Recipients
            $mail->setFrom("$email", "$nome");
            $mail->addAddress('paulovictorsantos0@gmail.com');

            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Sugestão ou dúvida de '.$nome;
            $mail->Body    = "<br>Nome: $nome<br>Email: $email<br>Tel: $tel<hr>$mens";
            $mail->AltBody = "$mens";

            $mail->send();
            echo "<div class='mensagem green'>E-mail enviado com sucesso</div>";
        } catch (Exception $e) {
            echo "<div class='mensagem red'>Erro ao enviar o e-mail, por favor tente mais tarde</div>";
        }
    }

?>

<section class="home">
		<div class="banner">
			<div class="text">
				<?php
					$consulta = "SELECT * FROM textos WHERE id = 7";
					$limite = mysqli_query($conexao, $consulta);
					if(mysqli_num_rows($limite) != 0){

						while($num_rows = mysqli_fetch_array($limite)){
							$titulo = $num_rows['titulo'];
							$texto = $num_rows['texto'];							
						}
					
						echo "<h2>$titulo</h2>";
						echo "<h3>$texto</h3>";
					}
				?>
			</div>
			
		</div>
			
		<div class="corpo" id="galeria">

			<?php

				$sql = "SELECT * FROM `fotos` WHERE statu = 1";
				$resultado = mysqli_query($conexao, $sql);

				if(mysqli_num_rows($resultado) != 0){
			
			?>

				<div class="galeria">

					<section class="banner-principal">

						<?php include "php/galeria_imagens.php";  ?>

						<div class="overlay"></div>
						<div class="bullets">
						
						</div>
					</section>
				</div>
				<div class="clear"></div>

			<?php } ?>

			<div id="sobre">
				<div class="w50 left">
					<img src="images/fotoQuemSomos.jpg" id="imgQuemSomos">
				</div>
				<div class="w50 right">
					<?php
						$consulta = "SELECT * FROM textos WHERE id = 1";
						$limite = mysqli_query($conexao, $consulta);
						if(mysqli_num_rows($limite) != 0){

							while($num_rows = mysqli_fetch_array($limite)){
								$titulo = $num_rows['titulo'];
								$texto = $num_rows['texto'];							
							}
						
							echo "<h1>$titulo</h1>";
							echo "<p><br>$texto</p>";
						}
					?>
				</div>
			</div>
			<div class="clear"></div>
		</div>
	
		<div id="contato">
			<div id="divForm">
				<h1>_</h1>
				<h1>Faça um visita</h1><br>
				<?php
					$consulta = "SELECT * FROM textos WHERE id BETWEEN 2 AND 6";
					$limite = mysqli_query($conexao, $consulta);
					if(mysqli_num_rows($limite) != 0){

						while($num_rows = mysqli_fetch_array($limite)){
							$texto = $num_rows['texto'];

							echo "<p>";
							if($num_rows['id'] == 4){
								echo "Tel: ";
							}	
							echo "$texto</p>";
						}
                    }
                ?>
                <br>
                <p>Horários de funcionamento</p>
                <p>Terça - Sexta</p>
                <p>08:00 - 20:00</p>
                <p>Sábado</p>
                <p>08:00 - 22:00</p>
                <br>
				<form action="<?php echo INCLUDE_PATH; ?>" method="POST">
					<div id="divInput" class="w50 left">
						<input type="text" name="nome" placeholder="Nome" class="left">
						<input type="text" name="email" placeholder="Email" class="left">
						<input type="text" name="tel" placeholder="Telefone" class="left">
					</div>
					<textarea id="mensagem" class="w50 right" name="mens" placeholder="Digite sua mensagem aqui..."></textarea>
					<div class="clear"></div>
					<input type="submit" name="action" value='Enviar' class="right">
				</form>
				<div class="clear"></div>
				<a href="<?php echo INCLUDE_PATH; ?>mapa">Como chegar?</a>
			</div>
		</div>
	
</section>