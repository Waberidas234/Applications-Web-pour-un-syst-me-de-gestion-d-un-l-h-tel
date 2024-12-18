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

    $stmt = $conn->prepare("DELETE FROM chambre WHERE num_chambre = ? AND num_hotel = ?");
    $stmt->bind_param("ii", $num_chambre, $hotel_id);
    $stmt->execute();
    $stmt->close();

    echo "<p style='color: red;'>Chambre supprimée avec succès !</p>";
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supprimer une Chambre</title>
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

        input[type="number"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1em;
        }

        button {
            background-color: #F44336;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 1.2em;
            cursor: pointer;
        }

        button:hover {
            background-color: #e53935;
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
    <h1>Supprimer une Chambre</h1>
</header>

<div class="container">
    <h2>Formulaire de suppression de chambre</h2>
    <form method="POST">
        <div class="form-group">
            <label for="num_chambre">Numéro de Chambre</label>
            <input type="number" name="num_chambre" id="num_chambre" required>
        </div>
        <button type="submit">Supprimer Chambre</button>
    </form>
    <a href="dashboard.php" class="back-btn">Retour au Dashboard</a>
</div>

</body>
</html>
