<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
// Inclure les fichiers nécessaires
require_once 'init.php';
require_once 'includes/slider_functions.php';

// Récupérer les images du slider
$slider_images = get_slider_images();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BDCOV - Système de Gestion des Soutenances</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
   <link rel="stylesheet" href="assets/css/indexstyles.css">
  
</head>
<body>
    <!-- Header et Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light sticky-top">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                BDCOV
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="#heroCarousel">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="apropos.php">À propos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="indexfonc.php">Fonctionnalités</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contacts.php">Contact</a>
                    </li>
                    <li class="nav-item ms-lg-3">
                        <a class="btn btn-secondary login-btn" href="pages/login.php">
                            <i class="fas fa-sign-in-alt me-2"></i>Connexion
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Section Hero avec Carousel -->
    <section class="hero-section">
        <!-- Carousel -->
        <div id="heroCarousel" class="carousel slide hero-carousel" data-bs-ride="carousel">
            <!-- Indicateurs du carousel -->
            <div class="carousel-indicators">
                <?php foreach ($slider_images as $index => $image): ?>
                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="<?php echo $index; ?>" <?php echo $index === 0 ? 'class="active"' : ''; ?> aria-current="<?php echo $index === 0 ? 'true' : 'false'; ?>" aria-label="Slide <?php echo $index + 1; ?>"></button>
                <?php endforeach; ?>
            </div>
            
            <!-- Contenu du carousel -->
            <div class="carousel-inner">
                <?php foreach ($slider_images as $index => $image): ?>
                <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
                    <img src="<?php echo $image['chemin_image']; ?>" class="d-block w-100" alt="<?php echo $image['nom_image']; ?>">
                </div>
                <?php endforeach; ?>
            </div>
            
            <!-- Contrôles du carousel -->
            <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Précédent</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Suivant</span>
            </button>
        </div>
        
        <!-- Overlay semi-transparent -->
        <div class="carousel-overlay"></div>
        
        <!-- Contenu de la section Hero -->
        <div class="hero-content">
            <h1 class="hero-title">Système de Gestion des Soutenances Universitaires</h1>
            <p class="hero-subtitle">Une plateforme complète pour gérer efficacement les rapports et les soutenances de fin d'études.</p>
            <div class="hero-buttons d-flex justify-content-center gap-3">
                <a href="indexfonc.php" class="btn btn-secondary btn-lg">
                    <i class="fas fa-info-circle me-2"></i>En savoir plus
                </a>
                <a href="pages/login.php" class="btn btn-light btn-lg">
                    <i class="fas fa-sign-in-alt me-2"></i>Se connecter
                </a>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features-section">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title">Nos Fonctionnalités</h2>
                <p class="lead text-muted">Découvrez les outils qui facilitent la gestion des soutenances</p>
            </div>
            
            <div class="row g-4">
                <div class="col-md-6 col-lg-3">
                    <div class="card feature-card">
                        <div class="card-header text-center py-3">
                            Pour les Étudiants
                        </div>
                        <div class="card-body text-center">
                            <div class="feature-icon">
                                <i class="fas fa-user-graduate"></i>
                            </div>
                            <h5 class="card-title">Dépôt des Rapports</h5>
                            <p class="card-text">Soumettez votre rapport en ligne et suivez son statut en temps réel jusqu'à la soutenance.</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6 col-lg-3">
                    <div class="card feature-card">
                        <div class="card-header text-center py-3">
                            Pour les Enseignants
                        </div>
                        <div class="card-body text-center">
                            <div class="feature-icon">
                                <i class="fas fa-chalkboard-teacher"></i>
                            </div>
                            <h5 class="card-title">Validation et Jury</h5>
                            <p class="card-text">Validez les rapports de vos étudiants et participez aux jurys de soutenance.</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6 col-lg-3">
                    <div class="card feature-card">
                        <div class="card-header text-center py-3">
                            Pour la Commission
                        </div>
                        <div class="card-body text-center">
                            <div class="feature-icon">
                                <i class="fas fa-tasks"></i>
                            </div>
                            <h5 class="card-title">Planification</h5>
                            <p class="card-text">Organisez et planifiez les soutenances avec une gestion optimale des ressources.</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6 col-lg-3">
                    <div class="card feature-card">
                        <div class="card-header text-center py-3">
                            Pour l'Administration
                        </div>
                        <div class="card-body text-center">
                            <div class="feature-icon">
                                <i class="fas fa-chart-line"></i>
                            </div>
                            <h5 class="card-title">Suivi et Statistiques</h5>
                            <p class="card-text">Générez des rapports et analysez les données pour améliorer votre processus.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Process Section -->
    <section class="process-section">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title">Notre Processus</h2>
                <p class="lead text-muted">Un parcours simplifié de la soumission à la soutenance</p>
            </div>
            
            <div class="row">
                <div class="col-md-3">
                    <div class="process-step">
                        <div class="process-icon">
                            <i class="fas fa-file-upload"></i>
                        </div>
                        <h5 class="process-title">Dépôt</h5>
                        <p>L'étudiant soumet son rapport via la plateforme</p>
                    </div>
                </div>
                
                <div class="col-md-3">
                    <div class="process-step">
                        <div class="process-icon">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <h5 class="process-title">Validation</h5>
                        <p>L'encadreur et la commission valident le rapport</p>
                    </div>
                </div>
                
                <div class="col-md-3">
                    <div class="process-step">
                        <div class="process-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <h5 class="process-title">Jury</h5>
                        <p>Attribution des membres du jury de soutenance</p>
                    </div>
                </div>
                
                <div class="col-md-3">
                    <div class="process-step">
                        <div class="process-icon">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                        <h5 class="process-title">Soutenance</h5>
                        <p>Planification et passage de la soutenance finale</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats-section">
        <div class="container">
            <div class="row">
                <div class="col-6 col-md-3">
                    <div class="stat-item">
                        <div class="stat-number">500+</div>
                        <div class="stat-label">Étudiants</div>
                    </div>
                </div>
                
                <div class="col-6 col-md-3">
                    <div class="stat-item">
                        <div class="stat-number">100+</div>
                        <div class="stat-label">Enseignants</div>
                    </div>
                </div>
                
                <div class="col-6 col-md-3">
                    <div class="stat-item">
                        <div class="stat-number">1000+</div>
                        <div class="stat-label">Rapports Déposés</div>
                    </div>
                </div>
                
                <div class="col-6 col-md-3">
                    <div class="stat-item">
                        <div class="stat-number">98%</div>
                        <div class="stat-label">Satisfaction</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="testimonials-section">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title">Témoignages</h2>
                <p class="lead text-muted">Ce que nos utilisateurs disent de notre plateforme</p>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="testimonial-card">
                        <div class="d-flex align-items-center mb-4">
                            <div class="testimonial-avatar">
                                <i class="fas fa-user"></i>
                            </div>
                            <div>
                                <h5 class="mb-0">Thomas M.</h5>
                                <p class="text-muted mb-0">Étudiant en Master Informatique</p>
                            </div>
                        </div>
                        <p class="testimonial-quote">"Le système a simplifié tout le processus de dépôt et de suivi de mon mémoire. J'ai pu voir en temps réel l'avancement de mon dossier et les commentaires de mon encadreur."</p>
                        <div class="text-warning">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="testimonial-card">
                        <div class="d-flex align-items-center mb-4">
                            <div class="testimonial-avatar">
                                <i class="fas fa-user"></i>
                            </div>
                            <div>
                                <h5 class="mb-0">Prof. Sarah L.</h5>
                                <p class="text-muted mb-0">Enseignante-chercheuse</p>
                            </div>
                        </div>
                        <p class="testimonial-quote">"En tant qu'encadrante, ce système m'a permis de gérer efficacement les rapports de mes étudiants. La plateforme est intuitive et m'a fait gagner un temps précieux."</p>
                        <div class="text-warning">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="contact-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <h2 class="section-title">Commencez Maintenant</h2>
                    <p class="mb-4">Rejoignez notre plateforme pour une gestion efficace des soutenances. Connectez-vous ou contactez-nous pour plus d'informations.</p>
                    <div class="d-flex flex-column flex-md-row gap-3">
                        <a href="../pages/login.php" class="btn btn-primary btn-lg">
                            <i class="fas fa-sign-in-alt me-2"></i>Se connecter
                        </a>
                        <a href="contacts.php" class="btn btn-outline-primary btn-lg">
                            <i class="fas fa-envelope me-2"></i>Nous contacter
                        </a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body p-4">
                            <h5 class="card-title mb-4">Des questions ? Contactez-nous</h5>
                            <div class="mb-3 contact-info">
                                <i class="fas fa-envelope"></i>
                                <span>contact@bdcov.edu</span>
                            </div>
                            <div class="mb-3 contact-info">
                                <i class="fas fa-phone"></i>
                                <span>+225 07 XX XX XX XX</span>
                            </div>
                            <div class="mb-3 contact-info">
                                <i class="fas fa-map-marker-alt"></i>
                                <span>Campus Universitaire, Abidjan</span>
                            </div>
                            <div class="mb-3 contact-info">
                                <i class="fas fa-clock"></i>
                                <span>Lun-Ven: 8h00 - 16h30</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4 mb-md-0">
                    <h5 class="footer-title">BDCOV</h5>
                    <p>Système de gestion des soutenances universitaires par la commission de validation.</p>
                    <div class="mt-3">
                        <a href="#" class="me-3"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="me-3"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="me-3"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
                
                <div class="col-md-2 mb-4 mb-md-0">
                    <h5 class="footer-title">Liens</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#heroCarousel">Accueil</a></li>
                        <li class="mb-2"><a href="apropos.php">À propos</a></li>
                        <li class="mb-2"><a href="indexfonc.php">Fonctionnalités</a></li>
                        <li class="mb-2"><a href="contacts.php">Contact</a></li>
                    </ul>
                </div>
                
                <div class="col-md-3 mb-4 mb-md-0">
                    <h5 class="footer-title">Accès rapide</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="login.php">Connexion</a></li>
                        <li class="mb-2"><a href="guides.php">Guides d'utilisation</a></li>
                        <li class="mb-2"><a href="faq.php">FAQ</a></li>
                        <li class="mb-2"><a href="help.php">Support</a></li>
                    </ul>
                </div>
                
                <div class="col-md-3">
                    <h5 class="footer-title">Contact</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><i class="fas fa-map-marker-alt me-2"></i> Campus Universitaire, Abidjan</li>
                        <li class="mb-2"><i class="fas fa-phone me-2"></i> +225 07 XX XX XX XX</li>
                        <li class="mb-2"><i class="fas fa-envelope me-2"></i> contact@bdcov.edu</li>
                    </ul>
                </div>
            </div>
            
            <div class="footer-bottom text-center">
                <p class="mb-0">&copy; <?php echo date('Y'); ?> BDCOV. Tous droits réservés.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        // Activer tous les tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });
        
        // Configurer le carousel pour automatiser les transitions
        var myCarousel = document.getElementById('heroCarousel');
        var carousel = new bootstrap.Carousel(myCarousel, {
            interval: 5000, // Changer d'image toutes les 5 secondes
            wrap: true,     // Revenir à la première image après la dernière
            touch: true     // Activer le défilement tactile
        });
    </script>
</body>
</html>
