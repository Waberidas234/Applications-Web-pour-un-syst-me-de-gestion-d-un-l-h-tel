<?php
session_start();

// Vérification si l'utilisateur est connecté
if (!isset($_SESSION['admin_id'])) {
    // Si l'utilisateur n'est pas connecté, rediriger vers la page de connexion
    header("Location: connexion4.php");
    exit();
}

// Si l'utilisateur est connecté, récupérer le nom de l'administrateur
$admin_name = $_SESSION['admin_name']; // Récupérer le nom de l'administrateur depuis la session
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Super Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        h1 {
            color: #4CAF50;
            font-size: 30px;
        }
        .btn {
            display: inline-block;
            margin: 10px 20px;
            padding: 15px 25px;
            font-size: 18px;
            color: #fff;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            cursor: pointer;
        }
        .btn:hover {
            background-color: #0056b3;
        }
        .logout-btn {
            background-color: #ff4d4d;
        }
        .logout-btn:hover {
            background-color: #d43f3f;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Bienvenue, <?php echo htmlspecialchars($admin_name); ?> (Super Admin)</h1>
        <p>Vous êtes connecté en tant que Super Admin.</p>

        <!-- Boutons d'actions disponibles pour le superadmin -->
        <a href="ajoutadmin.php" class="btn">Ajouter un administrateur</a>
        <a href="add_hotel.php" class="btn">Ajouter un hôtel</a>
        <a href="modifierhotel.php" class="btn">Modifier un hotel</a>
        <a href="supprimerhotel.php" class="btn">suppreimer un hotel</a>


        <!-- Bouton de déconnexion -->
        <a href="deconnexion.php" class="btn logout-btn">Déconnexion</a>
    </div>

</body>
</html>
