<?php
// Inclure les fichiers nécessaires
require_once 'init.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fonctionnalités - BDCOV</title>
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
                        <a class="nav-link" href="apropos.php">À propos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="indexfonc.php">Fonctionnalités</a>
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
            <h1 class="page-title">Nos Fonctionnalités</h1>
            <p class="page-description">Découvrez les outils puissants que BDCOV met à votre disposition pour simplifier la gestion des soutenances universitaires.</p>
        </div>
    </section>

    <!-- Section Fonctionnalités principales -->
    <section class="content-section">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title">Fonctionnalités clés</h2>
                <p class="lead text-muted">Une solution complète pour tous les aspects de la gestion des soutenances</p>
            </div>
            
            <div class="row g-4">
                <div class="col-md-6 col-lg-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-cloud-upload-alt"></i>
                        </div>
                        <h4 class="feature-title">Dépôt de rapports en ligne</h4>
                        <p>Les étudiants peuvent soumettre leurs rapports de stage ou mémoires directement via la plateforme, avec suivi en temps réel du statut de validation.</p>
                    </div>
                </div>
                
                <div class="col-md-6 col-lg-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <h4 class="feature-title">Validation multi-niveaux</h4>
                        <p>Processus de validation transparent impliquant l'encadreur, la commission et l'administration, avec notifications automatiques à chaque étape.</p>
                    </div>
                </div>
                
                <div class="col-md-6 col-lg-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-users-cog"></i>
                        </div>
                        <h4 class="feature-title">Gestion des jurys</h4>
                        <p>Attribution automatique ou manuelle des membres du jury, en tenant compte des spécialités et de la charge de travail des enseignants.</p>
                    </div>
                </div>
                
                <div class="col-md-6 col-lg-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                        <h4 class="feature-title">Planification des soutenances</h4>
                        <p>Calendrier interactif pour la planification des soutenances, avec gestion des salles, des horaires et des disponibilités des jurys.</p>
                    </div>
                </div>
                
                <div class="col-md-6 col-lg-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-chart-bar"></i>
                        </div>
                        <h4 class="feature-title">Statistiques et rapports</h4>
                        <p>Tableau de bord avec statistiques détaillées sur les soutenances, les taux de réussite, les délais de traitement et autres indicateurs clés.</p>
                    </div>
                </div>
                
                <div class="col-md-6 col-lg-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-bell"></i>
                        </div>
                        <h4 class="feature-title">Notifications automatiques</h4>
                        <p>Système de notifications par email et dans l'application pour informer les utilisateurs des mises à jour importantes concernant leurs dossiers.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section Fonctionnalités par rôle -->
    <section class="content-section bg-light">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title">Fonctionnalités par rôle</h2>
                <p class="lead text-muted">Des outils adaptés à chaque utilisateur de la plateforme</p>
            </div>
            
            <div class="row">
                <div class="col-md-3">
                    <div class="user-role-tab active" data-role="student">
                        <div class="role-icon">
                            <i class="fas fa-user-graduate"></i>
                        </div>
                        <div>
                            <h5 class="mb-0">Étudiants</h5>
                        </div>
                    </div>
                    
                    <div class="user-role-tab" data-role="teacher">
                        <div class="role-icon">
                            <i class="fas fa-chalkboard-teacher"></i>
                        </div>
                        <div>
                            <h5 class="mb-0">Enseignants</h5>
                        </div>
                    </div>
                    
                    <div class="user-role-tab" data-role="committee">
                        <div class="role-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <div>
                            <h5 class="mb-0">Commission</h5>
                        </div>
                    </div>
                    
                    <div class="user-role-tab" data-role="admin">
                        <div class="role-icon">
                            <i class="fas fa-user-cog"></i>
                        </div>
                        <div>
                            <h5 class="mb-0">Administration</h5>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-9">
                    <div class="user-role-content active" data-role="student">
                        <h3 class="mb-4">Fonctionnalités pour les étudiants</h3>
                        <p>Les étudiants bénéficient d'un espace personnel intuitif pour gérer leur parcours de soutenance du début à la fin.</p>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <ul class="feature-list">
                                    <li>Dépôt de rapports en version numérique</li>
                                    <li>Suivi en temps réel de l'état d'avancement</li>
                                    <li>Visualisation des commentaires des évaluateurs</li>
                                    <li>Calendrier des soutenances à venir</li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <ul class="feature-list">
                                    <li>Notifications des changements de statut</li>
                                    <li>Accès aux historiques des dépôts précédents</li>
                                    <li>Téléchargement des documents administratifs</li>
                                    <li>Messagerie avec l'encadreur et le jury</li>
                                </ul>
                            </div>
                        </div>
                        
                        <img src="assets/img/student-dashboard.jpg" alt="Dashboard étudiant" class="img-fluid rounded mt-4">
                    </div>
                    
                    <div class="user-role-content" data-role="teacher">
                        <h3 class="mb-4">Fonctionnalités pour les enseignants</h3>
                        <p>Les enseignants disposent d'outils puissants pour encadrer, évaluer et participer aux jurys de soutenance de manière efficace.</p>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <ul class="feature-list">
                                    <li>Liste des étudiants encadrés</li>
                                    <li>Validation des rapports soumis</li>
                                    <li>Ajout de commentaires et annotations</li>
                                    <li>Gestion du calendrier des soutenances</li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <ul class="feature-list">
                                    <li>Interface d'évaluation pendant la soutenance</li>
                                    <li>Historique des jurys précédents</li>
                                    <li>Statistiques sur les étudiants encadrés</li>
                                    <li>Gestion des disponibilités pour les jurys</li>
                                </ul>
                            </div>
                        </div>
                        
                        <img src="assets/img/teacher-dashboard.jpg" alt="Dashboard enseignant" class="img-fluid rounded mt-4">
                    </div>
                    
                    <div class="user-role-content" data-role="committee">
                        <h3 class="mb-4">Fonctionnalités pour la commission</h3>
                        <p>La commission de validation dispose d'une interface complète pour superviser l'ensemble du processus de soutenance.</p>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <ul class="feature-list">
                                    <li>Validation finale des rapports</li>
                                    <li>Constitution des jurys de soutenance</li>
                                    <li>Planification des sessions de soutenance</li>
                                    <li>Gestion des salles et ressources</li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <ul class="feature-list">
                                    <li>Tableau de bord des statistiques globales</li>
                                    <li>Gestion des exceptions et cas particuliers</li>
                                    <li>Génération automatique des convocations</li>
                                    <li>Archivage des soutenances passées</li>
                                </ul>
                            </div>
                        </div>
                        
                        <img src="assets/img/committee-dashboard.jpg" alt="Dashboard commission" class="img-fluid rounded mt-4">
                    </div>
                    
                    <div class="user-role-content" data-role="admin">
                        <h3 class="mb-4">Fonctionnalités pour l'administration</h3>
                        <p>Les administrateurs bénéficient d'un accès complet à la plateforme pour gérer tous les aspects du système.</p>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <ul class="feature-list">
                                    <li>Gestion des comptes utilisateurs</li>
                                    <li>Configuration des paramètres du système</li>
                                    <li>Supervision de toutes les soutenances</li>
                                    <li>Gestion des années académiques</li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <ul class="feature-list">
                                    <li>Rapports d'activité et statistiques</li>
                                    <li>Gestion des droits d'accès</li>
                                    <li>Sauvegarde et restauration des données</li>
                                    <li>Personnalisation de l'interface</li>
                                </ul>
                            </div>
                        </div>
                        
                        <img src="assets/img/admin-dashboard.jpg" alt="Dashboard administrateur" class="img-fluid rounded mt-4">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section Processus de soutenance -->
    <section class="content-section">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title">Processus de soutenance</h2>
                <p class="lead text-muted">Comment BDCOV simplifie chaque étape du processus</p>
            </div>
            
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="process-step">
                        <div class="process-number">1</div>
                        <div class="process-content">
                            <h4>Dépôt du rapport</h4>
                            <p>L'étudiant téléverse son rapport sur la plateforme. Le système vérifie automatiquement le format, la taille et la structure du document. Un accusé de réception est envoyé à l'étudiant.</p>
                        </div>
                    </div>
                    
                    <div class="process-step">
                        <div class="process-number">2</div>
                        <div class="process-content">
                            <h4>Validation par l'encadreur</h4>
                            <p>L'encadreur reçoit une notification et peut consulter le rapport en ligne. Il peut ajouter des commentaires, suggérer des modifications ou valider le document. L'étudiant est informé de la décision.</p>
                        </div>
                    </div>
                    
                    <div class="process-step">
                        <div class="process-number">3</div>
                        <div class="process-content">
                            <h4>Validation par la commission</h4>
                            <p>Après validation par l'encadreur, la commission examine le rapport. Elle vérifie la conformité aux règles académiques et peut demander des ajustements ou valider le document pour la soutenance.</p>
                        </div>
                    </div>
                    
                    <div class="process-step">
                        <div class="process-number">4</div>
                        <div class="process-content">
                            <h4>Constitution du jury</h4>
                            <p>La commission constitue le jury en fonction des spécialités des enseignants, de leur charge de travail et de leurs disponibilités. Les membres du jury sont notifiés automatiquement.</p>
                        </div>
                    </div>
                    
                    <div class="process-step">
                        <div class="process-number">5</div>
                        <div class="process-content">
                            <h4>Planification de la soutenance</h4>
                            <p>La date, l'heure et le lieu de la soutenance sont déterminés en fonction des disponibilités des membres du jury et des salles. Tous les participants reçoivent une notification avec les détails.</p>
                        </div>
                    </div>
                    
                    <div class="process-step">
                        <div class="process-number">6</div>
                        <div class="process-content">
                            <h4>Évaluation et notation</h4>
                            <p>Pendant la soutenance, les membres du jury peuvent saisir leurs notes et commentaires directement dans l'application. Le système calcule automatiquement la note finale selon les critères établis.</p>
                        </div>
                    </div>
                    
                    <div class="process-step">
                        <div class="process-number">7</div>
                        <div class="process-content">
                            <h4>Archivage et statistiques</h4>
                            <p>Après la soutenance, tous les documents et notes sont archivés dans le système. Des statistiques sont générées pour analyse par la commission et l'administration.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section Avantages -->
    <section class="content-section bg-light">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title">Avantages de BDCOV</h2>
                <p class="lead text-muted">Pourquoi choisir notre plateforme ?</p>
            </div>
            
            <div class="row">
                <div class="col-lg-6 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Comparaison avec le processus manuel</h4>
                            
                            <table class="comparison-table">
                                <thead>
                                    <tr>
                                        <th>Critère</th>
                                        <th>Processus Manuel</th>
                                        <th>BDCOV</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Temps de traitement</td>
                                        <td>Plusieurs semaines</td>
                                        <td>Quelques jours</td>
                                    </tr>
                                    <tr>
                                        <td>Risque d'erreurs</td>
                                        <td>Élevé <i class="fas fa-times"></i></td>
                                        <td>Minimal <i class="fas fa-check"></i></td>
                                    </tr>
                                    <tr>
                                        <td>Suivi en temps réel</td>
                                        <td>Non disponible <i class="fas fa-times"></i></td>
                                        <td>Disponible 24/7 <i class="fas fa-check"></i></td>
                                    </tr>
                                    <tr>
                                        <td>Coordination des acteurs</td>
                                        <td>Complexe</td>
                                        <td>Automatisée</td>
                                    </tr>
                                    <tr>
                                        <td>Archivage</td>
                                        <td>Physique (encombrant)</td>
                                        <td>Numérique (illimité)</td>
                                    </tr>
                                    <tr>
                                        <td>Statistiques et rapports</td>
                                        <td>Manuels et limités</td>
                                        <td>Automatiques et détaillés</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-6">
                    <div class="card h-100">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Avantages clés</h4>
                            
                            <ul class="feature-list">
                                <li><strong>Gain de temps considérable</strong> : Réduction des délais de traitement à chaque étape du processus.</li>
                                <li><strong>Transparence totale</strong> : Tous les acteurs peuvent suivre l'évolution de leur dossier en temps réel.</li>
                                <li><strong>Réduction des erreurs</strong> : Les vérifications automatiques minimisent les risques d'erreurs humaines.</li>
                                <li><strong>Accessibilité</strong> : Accès à la plateforme 24h/24 et 7j/7, depuis n'importe quel appareil connecté.</li>
                                <li><strong>Centralisation des informations</strong> : Toutes les données sont stockées au même endroit, facilitant leur accès et leur traitement.</li>
                                <li><strong>Communication simplifiée</strong> : Échanges directs entre étudiants, enseignants et administration via la plateforme.</li>
                                <li><strong>Réduction de l'empreinte écologique</strong> : Diminution significative de la consommation de papier grâce à la dématérialisation.</li>
                                <li><strong>Sécurité des données</strong> : Protection des informations personnelles et des documents confidentiels.</li>
                                <li><strong>Aide à la décision</strong> : Génération de statistiques et de rapports pour optimiser le processus de soutenance.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="content-section">
        <div class="container text-center">
            <h2 class="section-title mb-4">Prêt à commencer ?</h2>
            <p class="lead mb-4">Rejoignez les centaines d'utilisateurs qui simplifient leur processus de soutenance grâce à BDCOV.</p>
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Gestion des onglets de rôles utilisateurs
            const roleTabs = document.querySelectorAll('.user-role-tab');
            const roleContents = document.querySelectorAll('.user-role-content');
            
            roleTabs.forEach(tab => {
                tab.addEventListener('click', function() {
                    const role = this.getAttribute('data-role');
                    
                    // Désactiver tous les onglets et contenus
                    roleTabs.forEach(t => t.classList.remove('active'));
                    roleContents.forEach(c => c.classList.remove('active'));
                    
                    // Activer l'onglet et le contenu cliqué
                    this.classList.add('active');
                    document.querySelector(`.user-role-content[data-role="${role}"]`).classList.add('active');
                });
            });
        });
    </script>
</body>
</html>
