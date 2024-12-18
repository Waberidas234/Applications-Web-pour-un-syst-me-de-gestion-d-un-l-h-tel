<?php
session_start(); // Démarre la session
session_unset();  // Supprime toutes les variables de session
session_destroy();  // Détruit la session

// Redirige vers la page de connexion
header("Location: connexion4.php");
exit(); // Assurez-vous d'arrêter l'exécution du script après la redirection
?>
