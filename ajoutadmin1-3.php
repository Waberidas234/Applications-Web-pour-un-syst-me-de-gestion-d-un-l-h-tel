<?php
session_start();

// Vérification si l'utilisateur est connecté et s'il est un superadmin
if (!isset($_SESSION['admin_id'])) {
    // Si l'utilisateur n'est pas connecté, rediriger vers la page de connexion
    header("Location: connexion4.php");
    exit();
}

// Connexion à la base de données
$conn = new mysqli("localhost", "root", "", "gestionhotel");

// Vérifiez si la connexion à la base a échoué
if ($conn->connect_error) {
    die("Erreur de connexion à la base de données : " . $conn->connect_error);
}

// Traitement du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'];
    $prenom = $_POST['pre'];
    $email = $_POST['em'];
    $adresse = $_POST['ad'];
    $num_hotel = $_POST['num'];
    $role = $_POST['role'];

    // Vérification si l'email est déjà utilisé
    $query = $conn->prepare("SELECT * FROM adminstrateur WHERE email = ?");
    $query->bind_param("s", $email);
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows > 0) {
        $error = "Cet email est déjà utilisé.";
    } else {
        // Vérification si le numéro de l'hôtel existe dans la base de données
        $query = $conn->prepare("SELECT * FROM hotel WHERE num_hotel = ?");
        $query->bind_param("s", $num_hotel);
        $query->execute();
        $result = $query->get_result();

        if ($result->num_rows === 0) {
            $error = "L'attribut de l'hôtel n'existe pas. Veuillez attribuer un hôtel valide.";
        } else {
            // Générer un mot de passe aléatoire
            $password = bin2hex(random_bytes(8));  // Mot de passe aléatoire de 16 caractères
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);  // Hachage du mot de passe

            // Insertion de l'administrateur dans la base de données
            $query = $conn->prepare("INSERT INTO adminstrateur (nom_admin, prenom_admin, adresse_admin, email, num_hotel, Rolee, Motdepasse) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $query->bind_param("sssssss", $nom, $prenom, $adresse, $email, $num_hotel, $role, $hashed_password);
            $query->execute();

            // Envoi de l'email avec le mot de passe généré
            require 'vendor/autoload.php';

            $mail = new PHPMailer\PHPMailer\PHPMailer();
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'votremail@gmail.com';  // Remplacez par votre adresse Gmail
            $mail->Password = 'motdepasse_application';  // Remplacez par le mot de passe d'application
            $mail->SMTPSecure = PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Débogage
            $mail->SMTPDebug = 2; // Affiche les détails du processus SMTP pour déboguer

            // Informations sur le destinataire et l'email
            $mail->setFrom('votremail@gmail.com', 'Gestion Hôtel');
            $mail->addAddress($email, $prenom);
            $mail->Subject = "Votre mot de passe d'administrateur";
            $mail->Body    = "Bonjour $prenom,\n\nVoici votre mot de passe par défaut pour vous connecter à votre compte d'administrateur : $password\n\nCordialement,\nL'équipe de gestion.";

            if ($mail->send()) {
                $success = "L'administrateur a été ajouté et un email a été envoyé à $email.";
            } else {
                $error = "Erreur lors de l'envoi de l'email : " . $mail->ErrorInfo;
            }
        }
    }
    $query->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation - Ajout Administrateur</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 60%;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h1 {
            font-size: 24px;
            color: #4CAF50;
            margin-bottom: 20px;
        }

        .error {
            color: red;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .success {
            color: green;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .btn {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
        }

        .btn:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Résultat de l'ajout d'administrateur</h1>

        <?php
        if (isset($error)) {
            echo "<p class='error'>$error</p>";
        }
        if (isset($success)) {
            echo "<p class='success'>$success</p>";
        }
        ?>

        <a href="superadmin.php" class="btn">Retour au tableau de bord</a>
    </div>

</body>
</html>
