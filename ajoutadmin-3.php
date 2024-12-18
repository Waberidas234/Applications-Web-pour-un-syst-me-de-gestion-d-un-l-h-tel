<?php
session_start();

// Vérification si l'utilisateur est connecté et s'il est un superadmin
if (!isset($_SESSION['admin_id'])) {
    // Si l'utilisateur n'est pas connecté, rediriger vers la page de connexion
    header("Location: connexion4.php");
    exit();
}

$admin_name = $_SESSION['admin_name']; // Récupérer le nom de l'administrateur depuis la session
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Administrateur</title>
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

        .form-group {
            margin-bottom: 15px;
        }

        input[type="text"], input[type="email"], input[type="password"], select {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
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
    </style>
</head>
<body>

    <div class="container">
        <h1>Ajouter un Administrateur</h1>

        <form method="POST" action="ajoutadmin1.php">
            <div class="form-group">
                <label for="nom">Nom de l'Administrateur :</label>
                <input type="text" id="nom" name="nom" required>
            </div>

            <div class="form-group">
                <label for="pre">Prénom de l'Administrateur :</label>
                <input type="text" id="pre" name="pre" required>
            </div>

            <div class="form-group">
                <label for="ad">Adresse de l'Administrateur :</label>
                <input type="text" id="ad" name="ad" required>
            </div>

            <div class="form-group">
                <label for="num">Numéro de l'Hôtel :</label>
                <input type="text" id="num" name="num" required>
            </div>

            <div class="form-group">
                <label for="em">Email de l'Administrateur :</label>
                <input type="email" id="em" name="em" required>
            </div>

            <div class="form-group">
                <label for="role">Rôle :</label>
                <select id="role" name="role" required>
                    <option value="admin">Admin</option>
                    <option value="superadmin">Super Admin</option>
                </select>
            </div>

            <div class="form-group">
                <input type="submit" value="Ajouter l'Administrateur">
            </div>
        </form>
    </div>

</body>
</html>
