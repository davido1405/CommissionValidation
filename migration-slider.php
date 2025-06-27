<?php
/**
 * Script de migration pour créer la table slider_images
 * À exécuter une seule fois pour configurer la table dans la base de données
 */

// Inclure les fichiers nécessaires
require_once 'init.php';

// Message d'initialisation
echo '<h1>Migration - Création de la table slider_images</h1>';

try {
    // Obtenir une connexion à la base de données
    $db = get_db();
    
    // Vérifier si la table existe déjà
    $query = "SHOW TABLES LIKE 'slider_images'";
    $stmt = $db->prepare($query);
    $stmt->execute();
    $tableExists = $stmt->rowCount() > 0;
    
    if ($tableExists) {
        echo '<div style="color: orange; font-weight: bold;">La table slider_images existe déjà.</div>';
    } else {
        // Créer la table
        $query = "CREATE TABLE `slider_images` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `nom_image` varchar(255) NOT NULL,
            `chemin_image` varchar(255) NOT NULL,
            `description` text,
            `actif` tinyint(1) NOT NULL DEFAULT '1',
            `ordre` int(11) NOT NULL DEFAULT '0',
            PRIMARY KEY (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
        
        $stmt = $db->prepare($query);
        $stmt->execute();
        
        echo '<div style="color: green; font-weight: bold;">La table slider_images a été créée avec succès !</div>';
        
        // Créer le dossier pour les images si nécessaire
        $uploadDir = 'assets/img/slider/';
        if (!file_exists($uploadDir)) {
            if (mkdir($uploadDir, 0777, true)) {
                echo '<div style="color: green;">Le dossier ' . $uploadDir . ' a été créé avec succès.</div>';
            } else {
                echo '<div style="color: red;">Impossible de créer le dossier ' . $uploadDir . '. Veuillez le créer manuellement.</div>';
            }
        } else {
            echo '<div style="color: orange;">Le dossier ' . $uploadDir . ' existe déjà.</div>';
        }
        
        // Insérer quelques images par défaut
        $defaultImages = [
            [
                'nom' => 'Campus universitaire',
                'chemin' => 'assets/img/slider/default1.jpg',
                'description' => 'Vue du campus universitaire',
                'actif' => 1,
                'ordre' => 1
            ],
            [
                'nom' => 'Soutenance',
                'chemin' => 'assets/img/slider/default2.jpg',
                'description' => 'Étudiants lors d\'une soutenance',
                'actif' => 1,
                'ordre' => 2
            ],
            [
                'nom' => 'Bibliothèque',
                'chemin' => 'assets/img/slider/default3.jpg',
                'description' => 'La bibliothèque universitaire',
                'actif' => 1,
                'ordre' => 3
            ]
        ];
        
        // Préparer une image par défaut (une image vide avec un texte)
        foreach ($defaultImages as $index => $image) {
            $defaultImgPath = $uploadDir . 'default' . ($index + 1) . '.jpg';
            
            // Vérifier si l'image existe déjà
            if (!file_exists($defaultImgPath)) {
                // Créer une image vide avec un texte
                $img = imagecreatetruecolor(1200, 600);
                
                // Couleurs
                $bgColor = imagecolorallocate($img, 0, 77, 64); // Vert primaire
                $textColor = imagecolorallocate($img, 255, 255, 255); // Blanc
                
                // Remplir le fond
                imagefill($img, 0, 0, $bgColor);
                
                // Ajouter du texte
                $text = $image['nom'];
                $font = 'arial.ttf'; // Utilisez un chemin absolu vers une police si nécessaire
                
                // Centrer le texte (méthode alternative si GD n'a pas de police TrueType)
                $fontSize = 5; // Taille de la police GD (1-5)
                imagestring($img, $fontSize, 20, 20, $text, $textColor);
                
                // Sauvegarder l'image
                imagejpeg($img, $defaultImgPath, 90);
                imagedestroy($img);
                
                echo '<div style="color: green;">Image par défaut créée : ' . $defaultImgPath . '</div>';
            }
            
            // Insérer dans la base de données
            $query = "INSERT INTO slider_images (nom_image, chemin_image, description, actif, ordre) 
                     VALUES (:nom, :chemin, :description, :actif, :ordre)";
            $stmt = $db->prepare($query);
            $stmt->execute([
                'nom' => $image['nom'],
                'chemin' => $image['chemin'],
                'description' => $image['description'],
                'actif' => $image['actif'],
                'ordre' => $image['ordre']
            ]);
            
            echo '<div style="color: green;">Image ajoutée à la base de données : ' . $image['nom'] . '</div>';
        }
    }
    
    echo '<h2>Opération terminée</h2>';
    echo '<p>Vous pouvez maintenant <a href="index.php">retourner à l\'accueil</a> ou <a href="admin/slider.php">gérer le slider</a>.</p>';
    
} catch (PDOException $e) {
    // Afficher l'erreur
    echo '<div style="color: red; font-weight: bold;">Erreur lors de la migration : ' . $e->getMessage() . '</div>';
}
?>
