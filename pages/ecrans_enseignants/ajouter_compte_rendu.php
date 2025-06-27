<?php
$stmt = $pdo->prepare("INSERT INTO rendre (id_rapport, id_ens, date_rendre, contenu) VALUES (?, ?, NOW(), ?)");
$stmt->execute([$id_rapport, $id_ens, $contenu]);

?>