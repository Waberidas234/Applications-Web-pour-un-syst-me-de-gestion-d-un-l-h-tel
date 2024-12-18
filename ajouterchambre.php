<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: connexion.php");
    exit;
}

$conn = new mysqli("localhost", "root", "", "gestionhotel");
$hotel_id = $_SESSION['hotel_id'];

// Vérifiez la connexion à la base de données
if ($conn->connect_error) {
    die("Erreur de connexion à la base de données : " . $conn->connect_error);
}

// Traitement du formulaire d'ajout de chambre
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $prix = $_POST['prix'];
    $type_chambre = $_POST['type_chambre'];
    $statut = $_POST['statut'];
    $image_path = $_FILES['image']['name'];

    // Téléchargez l'image
    if ($image_path) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
    }

    $query = $conn->prepare("INSERT INTO chambre ( num_hotel, prix, type_chambre, statut, image_path) VALUES ( ?, ?, ?, ?, ?)");
    $query->bind_param("issss",  $hotel_id, $prix, $type_chambre, $statut, $target_file);
    $query->execute();
    $query->close();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter Chambre</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        /* Global Styles */
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f7fc;
            color: #333;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            text-align: center;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        h2 {
            font-size: 2em;
            margin-bottom: 30px;
            color: #4CAF50;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            font-size: 1.2em;
            color: #333;
            display: block;
            margin-bottom: 8px;
        }

        input, select {
            width: 100%;
            padding: 10px;
            font-size: 1em;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-top: 5px;
        }

        input[type="file"] {
            padding: 5px;
        }

        .button {
            display: inline-block;
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            font-size: 1.2em;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s ease;
            margin-top: 20px;
        }

        .button:hover {
            background-color: #45a049;
        }

        footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 15px;
            position: fixed;
            width: 100%;
            bottom: 0;
        }
        .back-btn {
            background-color: #ccc;
            color: black;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
        }

        .back-btn:hover {
            background-color: #bbb;
        }

    </style>
</head>
<body>

<header>
    <h1>Ajouter une Chambre</h1>
</header>

<div class="container">
    <h2>Formulaire d'Ajout de Chambre</h2>

    <form method="POST" enctype="multipart/form-data">
        

        <div class="form-group">
            <label for="prix">Prix (en DJF)</label>
            <input type="number" id="prix" name="prix" required>
        </div>

        <div class="form-group">
            <label for="type_chambre">Type de Chambre</label>
            <select id="type_chambre" name="type_chambre" required>
                <option value="Simple">Simple</option>
                <option value="Double">Double</option>
                <option value="Suite">Suite</option>
            </select>
        </div>

        <div class="form-group">
            <label for="statut">Statut</label>
            <select id="statut" name="statut" required>
                <option value="Disponible">Disponible</option>
                <option value="Réservée">Réservée</option>
            </select>
        </div>

        <div class="form-group">
            <label for="image">Image de Chambre</label>
            <input type="file" id="image" name="image">
        </div>

        <button type="submit" class="button">Ajouter Chambre</button>
          <a href="admin_dashboard.php" class="back-btn">Retour au Dashboard</a>
    </form>
</div>

<footer>
    <p>&copy; 2024 Gestion Hôtel. Tous droits réservés.</p>
</footer>

</body>
</html>
