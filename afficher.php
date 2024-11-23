<?php
$serveur="localhost";
$utilisateur="root";
$motDepasse="";
$base="gestion_hotel";
$myvar=mysqli_connect($serveur,$utilisateur,$motDepasse,$base);

$a=mysqli_query($myvar,"SELECT * FROM hotel");

echo "<table border=1>
<tr>

<th>numero_hotel</th>
<th>nom_hotel</th>
<th>adresse_hotel</th>
<th>contact</th>

</tr>
";

while ($ligne=mysqli_fetch_array($a)) {
    $num_hotel=$ligne[0];
    $nom_hotel=$ligne[1];
    $adresse_hotel=$ligne[2];
    $contact=$ligne[3];
    
    echo "
    <tr>
    <td>$num_hotel</td>
    <td>$nom_hotel</td>
    <td>$adresse_hotel</td>
    <td>$contact</td>
    </tr>
    
    ";
}

echo "voici la table hotel";  

echo" merci monsieur";
 
?>
