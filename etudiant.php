<?php
echo"espace d'etudiant";
session_start();
// On appelle la session


// On affiche une phrase résumant les infos sur l'utilisateur courant
echo 'Pseudo : ',$_SESSION['Nom'],'<br />
     Age : ',$_SESSION['Prenom'],'<br />
     Sexe : ',$_SESSION['DateN'],'<br />
     Ville : ',$_SESSION['Email'],'<br />';


?>