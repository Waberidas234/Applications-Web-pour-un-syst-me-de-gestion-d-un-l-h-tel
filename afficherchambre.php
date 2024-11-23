<?php

$serveur="localhost";
$utilisateur="root";
$motDepasse="";
$base="gestion_hotel";
$myvar=mysqli_connect($serveur,$utilisateur,$motDepasse,$base);

$a=mysqli_query($myvar,"SELECT * FROM chambre");

echo "<table border=1>
<tr>

<th>numero_chambre</th>
<th>numero_hotel</th>
<th>stat</th>
<th>type de chambre</th>
<th>prix</th>

</tr>
";

while ($ligne=mysqli_fetch_array($a)) {
    $num_chambre=$ligne[0];
    $num_hotel=$ligne[1];
    $statut=$ligne[2];
    $type=$ligne[3];
    $prix=$ligne[4];
    
    echo "
    <tr>
    <td>$num_chambre</td>
    <td>$num_hotel</td>
    <td>$statut</td>
    <td>$type</td>
    <td>$prix</td>
    </tr>
    
    ";
}

echo "voici la table chambre";

echo" merci monsieur";
 
?>