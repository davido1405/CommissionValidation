<?php
// Inclure les fichiers nécessaires
require_once 'init.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>À propos - BDCOV</title>
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
                        <a class="nav-link" href="index.php">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="apropos.php">À propos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="indexfonc.php">Fonctionnalités</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contacts.php">Contact</a>
                    </li>
                    <li class="nav-item ms-lg-3">
                        <a class="btn btn-secondary login-btn" href="login.php">
                            <i class="fas fa-sign-in-alt me-2"></i>Connexion
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Page Header -->
    <section class="page-header text-center">
        <div class="container">
            <h1 class="page-title">À propos de BDCOV</h1>
            <p class="page-description">Découvrez notre mission, notre équipe et notre engagement pour améliorer le processus de validation des soutenances universitaires.</p>
        </div>
    </section>

    <!-- Section Mission & Vision -->
    <section class="content-section">
        <div class="container">
            <div class="row">
                <div class="col-md-6 mb-4 mb-md-0">
                    <div class="mission-card h-100">
                        <h3><i class="fas fa-bullseye me-2"></i>Notre Mission</h3>
                        <p>BDCOV a été créé pour simplifier et optimiser le processus de gestion des soutenances universitaires. Notre mission est de fournir une plateforme moderne, efficace et transparente qui connecte étudiants, enseignants et administrateurs dans un écosystème numérique cohérent.</p>
                        <p>Nous sommes déterminés à transformer une procédure administrative traditionnellement complexe en une expérience fluide et productive pour toutes les parties prenantes.</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mission-card h-100">
                        <h3><i class="fas fa-eye me-2"></i>Notre Vision</h3>
                        <p>Nous envisageons un avenir où la technologie élimine les barrières administratives et permet aux étudiants et aux enseignants de se concentrer sur ce qui compte vraiment : la qualité académique et l'excellence de la recherche.</p>
                        <p>BDCOV aspire à devenir la référence en matière de solutions numériques pour la gestion des procédures académiques, en commençant par les soutenances de fin d'études, puis en élargissant son champ d'action à d'autres domaines de la vie universitaire.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section Notre Histoire -->
    <section class="content-section bg-light">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title">Notre Histoire</h2>
                <p class="lead text-muted">L'évolution de BDCOV à travers le temps</p>
            </div>
            
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="history-item">
                        <div class="history-year">2023</div>
                        <h5>Conception et développement</h5>
                        <p>Face aux difficultés rencontrées dans la gestion manuelle des soutenances, une équipe d'enseignants et d'étudiants en informatique lance le projet BDCOV pour digitaliser ce processus crucial.</p>
                    </div>
                    
                    <div class="history-item">
                        <div class="history-year">2024</div>
                        <h5>Phase de test et déploiement</h5>
                        <p>Après plusieurs mois de développement, la première version de BDCOV est déployée auprès d'un groupe pilote d'utilisateurs pour tester ses fonctionnalités et recueillir des retours d'expérience.</p>
                    </div>
                    
                    <div class="history-item">
                        <div class="history-year">2025</div>
                        <h5>Lancement officiel</h5>
                        <p>Suite au succès de la phase de test, BDCOV est officiellement lancé et adopté par l'ensemble de l'université comme solution de gestion des soutenances de fin d'études.</p>
                    </div>
                    
                    <div class="history-item">
                        <div class="history-year">Aujourd'hui</div>
                        <h5>Amélioration continue</h5>
                        <p>BDCOV continue d'évoluer grâce aux retours des utilisateurs et à l'intégration de nouvelles fonctionnalités pour répondre toujours mieux aux besoins de la communauté universitaire.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section Nos Valeurs -->
    <section class="content-section">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title">Nos Valeurs</h2>
                <p class="lead text-muted">Les principes qui guident notre démarche</p>
            </div>
            
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="value-card">
                        <div class="value-icon">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <h4>Excellence</h4>
                        <p>Nous visons l'excellence dans tous les aspects de notre service, en cherchant constamment à améliorer notre plateforme pour offrir la meilleure expérience possible.</p>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="value-card">
                        <div class="value-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <h4>Collaboration</h4>
                        <p>Nous croyons au pouvoir de la collaboration entre étudiants, enseignants et administrateurs pour créer un environnement universitaire plus efficace et harmonieux.</p>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="value-card">
                        <div class="value-icon">
                            <i class="fas fa-lock"></i>
                        </div>
                        <h4>Confiance</h4>
                        <p>La confiance est au cœur de notre démarche. Nous assurons la sécurité des données et la transparence des processus pour maintenir cette confiance.</p>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="value-card">
                        <div class="value-icon">
                            <i class="fas fa-lightbulb"></i>
                        </div>
                        <h4>Innovation</h4>
                        <p>Nous embrassons l'innovation technologique pour résoudre les défis administratifs et améliorer continuellement notre plateforme.</p>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="value-card">
                        <div class="value-icon">
                            <i class="fas fa-universal-access"></i>
                        </div>
                        <h4>Accessibilité</h4>
                        <p>Nous nous efforçons de rendre notre plateforme accessible à tous, quelle que soit leur expertise technique ou leurs contraintes.</p>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="value-card">
                        <div class="value-icon">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <h4>Amélioration continue</h4>
                        <p>Nous croyons au principe d'amélioration continue, en apprenant de nos erreurs et en nous adaptant aux besoins changeants de nos utilisateurs.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section Notre Équipe -->
    <section class="content-section bg-light">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title">Notre Équipe</h2>
                <p class="lead text-muted">Les personnes qui font de BDCOV une réalité</p>
            </div>
            
            <div class="row">
                <div class="col-md-4">
                    <div class="team-card">
                        <div class="team-avatar">
                            <i class="fas fa-user"></i>
                        </div>
                        <h4 class="team-name">Prof. Martin DIALLO</h4>
                        <div class="team-role">Directeur du projet</div>
                        <p>Professeur en informatique, spécialisé dans les systèmes d'information, il a initié le projet BDCOV en 2023.</p>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="team-card">
                        <div class="team-avatar">
                            <i class="fas fa-user"></i>
                        </div>
                        <h4 class="team-name">Dr. Sophie KONATE</h4>
                        <div class="team-role">Responsable académique</div>
                        <p>Enseignante-chercheuse, elle assure la conformité de la plateforme avec les exigences pédagogiques de l'université.</p>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="team-card">
                        <div class="team-avatar">
                            <i class="fas fa-user"></i>
                        </div>
                        <h4 class="team-name">Ing. Thomas KOUASSI</h4>
                        <div class="team-role">Lead Developer</div>
                        <p>Ingénieur en développement web, il dirige l'équipe technique responsable de la conception et du développement de la plateforme.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="content-section">
        <div class="container text-center">
            <h2 class="section-title mb-4">Rejoignez-nous</h2>
            <p class="lead mb-4">Prêt à découvrir comment BDCOV peut transformer votre expérience de soutenance ?</p>
            <div class="d-flex justify-content-center gap-3 flex-wrap">
                <a href="login.php" class="btn btn-primary btn-lg">
                    <i class="fas fa-sign-in-alt me-2"></i>Se connecter
                </a>
                <a href="contact.php" class="btn btn-outline-primary btn-lg">
                    <i class="fas fa-envelope me-2"></i>Nous contacter
                </a>
            </div>
        </div>
    </section>

    

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
