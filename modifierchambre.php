<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: connexion.php");
    exit;
}

$conn = new mysqli("localhost", "root", "", "gestionhotel");
$hotel_id = $_SESSION['hotel_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $num_chambre = $_POST['num_chambre'];
    $prix = $_POST['prix'];
    $type_chambre = $_POST['type_chambre'];
    $statut = $_POST['statut'];

    $stmt = $conn->prepare("UPDATE chambre SET prix = ?, type_chambre = ?, statut = ? WHERE num_chambre = ? AND num_hotel = ?");
    $stmt->bind_param("issii", $prix, $type_chambre, $statut, $num_chambre, $hotel_id);
    $stmt->execute();
    $stmt->close();

    echo "<p style='color: green;'>Chambre modifiée avec succès !</p>";
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier une Chambre</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f7fc;
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
            margin: 30px auto;
            padding: 20px;
            background-color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        h2 {
            color: #4CAF50;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"], input[type="number"], select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1em;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 1.2em;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
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
    <h1>Modifier une Chambre</h1>
</header>

<div class="container">
    <h2>Formulaire de modification de chambre</h2>
    <form method="POST">
        <div class="form-group">
            <label for="num_chambre">Numéro de Chambre</label>
            <input type="number" name="num_chambre" id="num_chambre" required>
        </div>
        <div class="form-group">
            <label for="prix">Prix (en DJF)</label>
            <input type="number" name="prix" id="prix" required>
        </div>
        <div class="form-group">
            <label for="type_chambre">Type de Chambre</label>
            <input type="text" name="type_chambre" id="type_chambre" required>
        </div>
        <div class="form-group">
            <label for="statut">Statut de Chambre</label>
            <select name="statut" id="statut" required>
                <option value="Disponible">Disponible</option>
                <option value="Occupée">Occupée</option>
                <option value="Réservée">Réservée</option>
            </select>
        </div>
        <button type="submit">Modifier Chambre</button>
    </form>
    <a href="admin_dashboard.php" class="back-btn">Retour au Dashboard</a>
</div>

</body>
</html>
