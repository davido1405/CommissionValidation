<?php


/**
 * Fonction pour récupérer les images du slider depuis la base de données
 * @return array Images du slider
 */
function get_slider_images() {
    return [
        [
            'id' => 1,
            'nom_image' => 'Image 1',
            'chemin_image' => 'assets/img/slider/UN1.jpg',
            'description' => 'Description de votre image 1'
        ],
        [
            'id' => 2,
            'nom_image' => 'Image 2',
            'chemin_image' => 'assets/img/slider/UN2.JPEG',
            'description' => 'Description de votre image 2'
        ],
        [
            'id' => 3,
            'nom_image' => 'Image 3',
            'chemin_image' => 'assets/img/slider/UN3.jpg',
            'description' => 'Description de votre image 3'
        ]
    ];
}


        //
        //  Ajoutez d'autres images selon vos besoins
    
