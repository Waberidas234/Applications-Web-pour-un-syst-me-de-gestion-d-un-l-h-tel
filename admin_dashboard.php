<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['admin_id'])) {
    // Si non, rediriger vers la page de connexion
    header("Location: connexion4.php");
    exit(); // Arrêter l'exécution du script pour éviter d'afficher la page d'administration
}

$conn = new mysqli("localhost", "root", "", "gestionhotel");
$hotel_id = $_SESSION['hotel_id'];
$admin_name = $_SESSION['admin_name'];

// Vérification de la connexion à la base de données
if ($conn->connect_error) {
    die("Erreur de connexion à la base de données : " . $conn->connect_error);
}

// Récupérer le nom de l'hôtel à partir de l'ID
$query = $conn->prepare("SELECT nom_hotel FROM hotel WHERE num_hotel = ?");
$query->bind_param("i", $hotel_id);
$query->execute();
$query->bind_result($hotel_name);
$query->fetch();
$query->close();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Gestion Hôtel</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
    <style>
        /* Styles généraux */
        body {
            font-family: 'Montserrat', sans-serif;
            background-color: #f5f7fa;
            margin: 0;
            padding: 0;
            color: #333;
        }

        header {
            background: linear-gradient(90deg, #4caf50, #2e7d32);
            color: white;
            text-align: center;
            padding: 30px 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            position: relative;
        }

        header h1 {
            font-size: 3em;
            margin: 0;
        }

        header p {
            font-size: 1.2em;
            margin-top: 10px;
        }

        /* Bouton de déconnexion */
        .logout-button {
            position: absolute;
            left: 20px;
            top: 30px;
            background-color: #ff4d4d;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 1.1em;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .logout-button:hover {
            background-color: #d43f3f;
            transform: translateY(-3px);
        }

        .container {
            max-width: 1200px;
            margin: 30px auto;
            padding: 30px;
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            font-size: 2.5em;
            color: #333;
            margin-bottom: 30px;
        }

        .card-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
        }

        .card {
            background-color: #ffffff;
            border-radius: 12px;
            padding: 20px;
            text-align: center;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            cursor: pointer;
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }

        .card h3 {
            color: #2e7d32;
            font-size: 1.8em;
            margin-bottom: 15px;
        }

        .card p {
            color: #555;
            font-size: 1.2em;
            margin-bottom: 20px;
        }

        .button {
            background-color: #4caf50;
            color: white;
            padding: 12px 24px;
            font-size: 1.1em;
            border-radius: 8px;
            text-decoration: none;
            display: inline-block;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .button:hover {
            background-color: #388e3c;
            transform: translateY(-3px);
        }

        footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 15px;
            position: fixed;
            width: 100%;
            bottom: 0;
            box-shadow: 0 -4px 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>

<header>
    <!-- Bouton de déconnexion -->
    <a href="deconnexion.php" class="logout-button">Déconnexion</a>
    <h1>Bienvenue, <?php echo htmlspecialchars($admin_name); ?> !</h1>
    <p>Hôtel : <?php echo htmlspecialchars($hotel_name); ?> (ID : <?php echo htmlspecialchars($hotel_id); ?>)</p>
</header>

<div class="container">
    <h2>Gestion de votre Hôtel</h2>

    <!-- Conteneur des cartes -->
    <div class="card-container">

        <!-- Carte pour les chambres -->
        <div class="card">
            <h3>Gérer les Chambres</h3>
            <p>Ajoutez, modifiez ou supprimez des chambres dans votre hôtel.</p>
            <a href="ajouterchambre.php" class="button">Ajouter une Chambre</a>
            <a href="modifierchambre.php" class="button">Modifier une Chambre</a>
            <a href="supprimersheraton.php" class="button">Supprimer une Chambre</a>
            <a href="motdepasse.php" class="button">motdepasse oublier</a>
        </div>

        <!-- Carte pour les réservations -->
        <div class="card">
            <h3>Réservations</h3>
            <p>Voir et gérer les réservations de chambres.</p>
            <a href="reservationsheraton.php" class="button">Voir les Réservations</a>
        </div>

    </div> <!-- Fin du conteneur des cartes -->

</div> <!-- Fin du conteneur principal -->

<footer>
    <p>&copy; 2024 Gestion Hôtel. Tous droits réservés.</p>
</footer>

</body>
</html>
