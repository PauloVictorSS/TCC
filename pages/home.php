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
				<h2> Bem-vindo! </h2>
				<h3> A experiência completa do Salão de Beleza Mãe e Filhas</h3>
			</div>
			
		</div>
			
		<div class="corpo" id="galeria">
			<div class="galeria">

				<section class="banner-principal">

					<?php include "php/galeria_imagens.php";  ?>

					<div class="overlay"></div>
					<div class="bullets">
					
					</div>
				</section>
			</div>
			<div class="clear"></div>
			<div id="sobre">
				<div class="w50 left">
					<img src="images/fotoQuemSomos.jpg" id="imgQuemSomos">
				</div>
				<div class="w50 right">
					<h1>SOBRE NÓS</h1>
					<p><br>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Facilis officia ratione quam obcaecati iusto incidunt dolorem laborum atque ducimus deleniti, cumque distinctio, animi hic fugiat soluta cum. Id, neque saepe. Lorem ipsum dolor sit amet consectetur adipisicing elit. Animi laboriosam omnis tempora, numquam sint deserunt temporibus placeat, reprehenderit illum saepe voluptatibus? Laboriosam quas quidem nam nulla. Nostrum mollitia amet dolorem.</p>
				</div>
			</div>
			<div class="clear"></div>
		</div>
	
		<div id="contato">
			<div id="divForm">
				<h1>_</h1>
				<h1>Faça um visita</h1><br>
				<p>Rua Santiago, 537 Sumaré, SP</p>
				<p>maefilhasoficial@gmail.com</p>
				<p>Tel: (19) 3838-4424</p><br>
				<p>HORÁRIO DE FUNCIONAMENTO</p>
				<p>Ter - Sex: 8:00 - 20:00<br>Sábado: 8:00 - 22:00</p><br>
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