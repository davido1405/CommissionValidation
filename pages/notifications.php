<?php

function envoyerMessage(PDO $pdo, int|array $destinataires, string $contenu, string $type = 'info') {
    $sql = "INSERT INTO message (contenu_msg, type_msg, date_msg, id_util, statut) VALUES (?, ?, NOW(), ?, 'non_lue')";
    $stmt = $pdo->prepare($sql);

    // Si plusieurs destinataires
    if (is_array($destinataires)) {
        foreach ($destinataires as $id_util) {
            $stmt->execute([$contenu, $type, $id_util]);
        }
    } else {
        $stmt->execute([$contenu, $type, $destinataires]);
    }
}
?>
