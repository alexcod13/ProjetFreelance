<!DOCTYPE html>
<?php
	session_start();

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
	    $email = $_POST["email"];
	    $nom = $_POST["nom"];
	    $contenu = $_POST["contenu"];
	    $date = date('Y-m-d H:i:s');

	    $server_name = "185.98.131.148";
		$db_name = "doubl2145394";
		$user = "doubl2145394";
		$password = "vbdbsmwgpq";

		try {
			$db = new PDO('mysql:host=' . $server_name . ';dbname=' . $db_name . ';charset=utf8', $user, $password);
			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			$sql = "INSERT INTO messages (Date, Email, Nom, Content) VALUES (:Date, :Email, :Nom, :Content)";
		    $requete = $db->prepare($sql);
		    $requete->bindValue(':Date', $date);
		    $requete->bindValue(':Email', $email);
		    $requete->bindValue(':Nom', $nom);
		    $requete->bindValue(':Content', $contenu);
		    $requete->execute();
		}
		catch(Exception $e)
		{
		        $_SESSION["message_validation"] = '<div class="message_validation" style="background-color: #E74C3C">Une erreur s\'est produite lors de l\'enregistrement de votre message.</div>';
		}

		$db = null;


	    $to = "alexandre.limpalaer@gmail.com";

	    $subject = "Nouveau message du formulaire de contact";

	    $template = file_get_contents('email_template.html');

	    $template = str_replace('[NAME]', htmlspecialchars($nom), $template);
        $template = str_replace('[EMAIL]', htmlspecialchars($email), $template);
        $template = str_replace('[CONTENT]', nl2br((htmlspecialchars($contenu))), $template);

        $from = "notif.contact@double-a-dev.com";

        $headers = "From: " . $from . "\r\n";
        $headers .= "Reply-To: " . $email . "\r\n";
        $headers .= "Content-type: text/html\r\n";

		if (mail($to, $subject, $template, $headers)) {
	        $_SESSION["message_validation"] = '<div class="message_validation" style="background-color: #2ECC71;">Votre e-mail a été envoyé avec succès.</div>';
	    } else {
	        $_SESSION["message_validation"] = '<div class="message_validation" style="background-color: #E74C3C">Une erreur s\'est produite lors de l\'envoi de l\'e-mail.</div>';
	    }

	    header("Location: " . $_SERVER["PHP_SELF"]);
		exit;
	}
?>

<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="styleIndex.css">
	<link rel="icon" href="img/logo.svg">
	<title>Double-A Dev.</title>
</head>
<body>
	<header id="divMenu">
			<div class="logo"><a href="."><img src="img/logo.svg"></a></div>
			<nav>
				<ul>
					<li><a href="#firstWrapper">Présentation</a></li>
					<li><a href="#secondWrapper">Qui somme nous ?</a></li>
					<li><a href="#thirdWrapper">Services et Tarifs</a></li>
					<li><a href="#fourthWrapper">Contact</a></li>
				</ul>
				<div class="hamburger">
					<img src="img/burger-menu.svg" class="ouvrir">
					<img src="img/burger-menu-close.svg" class="fermer">
				</div>
			</nav>
	</header>
	<div id="blurMenu"></div>
	<div id="topBackground"></div>
	<div id="firstWrapper">
		<div>
			<h1>Développement <span class="blueText">Web</span> et <span class="blueText">Mobile</span></h1>
			<p>Vous avez besoin d'un site web ou d'une application mobile ?</p>
			<p>Double-A Dev. est là pour transformer vos idées en réalité digitale, avec expertise et passion.</p>
		</div>
		<img src="img/devWebMobile.png">
	</div>
	<div id="secondWrapper">
		<h1><span class="blueText">Qui</span> sommes nous ?</h1>
		<p>Nous sommes un duo : Alexandre et Armand, passionnés par le développement depuis plusieurs années maintenant.</p>
		<p>Nous poursuivons actuellement nos études et, afin de générer des revenus complémentaires, nous développons sur notre temps libre.</p>
	</div>
	<div id="thirdWrapper">
		<h1>Nos <span class="blueText">services</span></h1>
		<div class="services">
			<div class="serviceContainer">
				<ul>
					<li class="serviceTypeTitle">Site Web</li>
					<li class="blueText"><span class="price">70<sup>€ TTC*</sup><sup id="sup_sub">par pages</sup></span></li>
					<li>Compatible avec<br>tout les navigateurs</li>
					<li>Développé avec<br>HTML, CSS, JavaScript et PHP</li>
				</ul>
			</div>
			<div class="serviceContainer">
				<ul>
					<li class="serviceTypeTitle">Application Mobile</li>
					<li class="blueText"><span class="price">300<sup>€ TTC*</sup></span></li>
					<li>Compatible avec<br>IOS et Android</li>
					<li>Développé avec<br>React Native</li>
				</ul>
			</div>
		</div>
		<a href="#fourthWrapper"><button>Faire un devis</button></a><br>
		<div id="price_indication">
			<span class="blueText">*</span>Les prix indiqués sont des moyennes qui servent à donner une estimation du coût final. Toutefois, il est important de noter que les prix peuvent varier en fonction de la complexité et du temps requis pour réaliser le projet. C'est pourquoi <strong>il convient de nous contacter afin d'obtenir un devis personnalisé.</strong>
		</div>
	</div>
	<div id="fourthWrapper">
		<h1>Nous <span class="blueText">contacter</span></h1>
		<p>Si vous avez besoin d'un devis ou de plus d'informations, veuillez remplir le formulaire ci-dessous. Nous vous contacterons par email dans les plus brefs délais.</p>
		<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" id="contactForm">
			<div class="NameEmail_Form">
				<div>
					<label for="email">Adresse e-mail :</label>
					<input type="email" id="email" name="email" required maxlength="50">
				</div>
				<div>
					<label for="nom">Nom :</label>
					<input type="text" id="nom" name="nom" required maxlength="50">
				</div>
			</div>
			<div class="text_Form">
				<label for="contenu">Votre Message :</label>
				<textarea id="contenu" name="contenu" rows="5" required></textarea>
			</div>
			<button type="submit">Envoyer</button>
		</form>
		<?php
            if (isset($_SESSION["message_validation"])) {
                echo $_SESSION["message_validation"];
                unset($_SESSION["message_validation"]);
            }
        ?>
	</div>
	<footer class="footer">
        <div class="footer-content">
			<?php 
			/*
			<ul>
				<li class="titleLiFooter">Navigation :</li>
				<li class="contentLi"><a href="#">Qui somme nous ?</a></li>
				<li class="contentLi"><a href="#">Nos création</a></li>
				<li class="contentLi"><a href="#">Services et Tarifs</a></li>
				<li class="contentLi"><a href="#">Contact</a></li>
			</ul>
        	<ul>
        		<li class="titleLiFooter">Nous Contacter :</li>
        		<li class="contentLi">Envoyer un message</li>
        		<li class="contentLi"><b>Email : </b><a href="mailto:alexandre.limpalaer@gmail.com">alexandre.limpalaer@gmail.com</a></li>
        		<li class="contentLi"><b>Téléphone : </b><a href="tel:0649079052">06 49 07 90 52</a></li>
        		<li class="contentLi"><b>Instagram : </b><a href="https://www.instagram.com/alexandre.limp/">alexandre.limp</a></li>
        	</ul>
        	*/
        	?>
        </div>
        <p>&copy; 2023 Double-A Dev. Tous droits réservés.</p>
    </footer>
	<script type="text/javascript" src="app.js"></script>
</body>
</html>