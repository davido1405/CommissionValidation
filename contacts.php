<?php
// Inclure les fichiers nécessaires
require_once 'init.php';

// Initialiser les variables
$name = '';
$email = '';
$subject = '';
$message = '';
$successMsg = '';
$errorMsg = '';

// Traiter le formulaire de contact
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupérer les données du formulaire
    $name = isset($_POST['name']) ? trim($_POST['name']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $subject = isset($_POST['subject']) ? trim($_POST['subject']) : '';
    $message = isset($_POST['message']) ? trim($_POST['message']) : '';
    
    // Vérifier que les champs obligatoires ne sont pas vides
    if (empty($name) || empty($email) || empty($message)) {
        $errorMsg = "Veuillez remplir tous les champs obligatoires.";
    } 
    // Vérifier que l'email est valide
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errorMsg = "Veuillez entrer une adresse email valide.";
    } 
    else {
        // En production, vous pourriez envoyer un email ici
        // Pour l'instant, simulations d'un envoi réussi
        $successMsg = "Votre message a été envoyé avec succès. Nous vous répondrons dans les plus brefs délais.";
        
        // Réinitialiser les champs du formulaire
        $name = '';
        $email = '';
        $subject = '';
        $message = '';
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact - BDCOV</title>
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
                        <a class="nav-link" href="indexfoc.php">Fonctionnalités</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="contacts.php">Contact</a>
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
            <h1 class="page-title">Contactez-nous</h1>
            <p class="page-description">Une question, une suggestion ou un problème ? N'hésitez pas à nous contacter. Notre équipe est là pour vous aider.</p>
        </div>
    </section>

    <!-- Section Contact -->
    <section class="content-section">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-7">
                    <h2 class="section-title">Envoyez-nous un message</h2>
                    <p class="mb-4">Remplissez le formulaire ci-dessous et nous vous répondrons dans les plus brefs délais.</p>
                    
                    <?php if (!empty($successMsg)): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle me-2"></i>
                        <?php echo $successMsg; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <?php endif; ?>
                    
                    <?php if (!empty($errorMsg)): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-circle me-2"></i>
                        <?php echo $errorMsg; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <?php endif; ?>
                    
                    <div class="contact-form">
                        <form method="POST" action="">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label">Nom complet <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="subject" class="form-label">Sujet</label>
                                <input type="text" class="form-control" id="subject" name="subject" value="<?php echo htmlspecialchars($subject); ?>">
                            </div>
                            
                            <div class="mb-4">
                                <label for="message" class="form-label">Message <span class="text-danger">*</span></label>
                                <textarea class="form-control" id="message" name="message" rows="5" required><?php echo htmlspecialchars($message); ?></textarea>
                            </div>
                            
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-paper-plane me-2"></i>Envoyer le message
                            </button>
                        </form>
                    </div>
                </div>
                
                <div class="col-lg-5">
                    <h2 class="section-title">Informations de contact</h2>
                    <p class="mb-4">Vous préférez nous contacter directement ? Voici nos coordonnées.</p>
                    
                    <div class="contact-info-card mb-4">
                        <div class="contact-info-item">
                            <div class="contact-icon">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div>
                                <h5>Adresse</h5>
                                <p class="mb-0">Campus Universitaire, Abidjan, Côte d'Ivoire</p>
                            </div>
                        </div>
                        
                        <div class="contact-info-item">
                            <div class="contact-icon">
                                <i class="fas fa-phone-alt"></i>
                            </div>
                            <div>
                                <h5>Téléphone</h5>
                                <p class="mb-0">+225 07 XX XX XX XX</p>
                            </div>
                        </div>
                        
                        <div class="contact-info-item">
                            <div class="contact-icon">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div>
                                <h5>Email</h5>
                                <p class="mb-0">contact@bdcov.edu</p>
                            </div>
                        </div>
                        
                        <div class="contact-info-item">
                            <div class="contact-icon">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div>
                                <h5>Heures d'ouverture</h5>
                                <p class="mb-0">Lundi - Vendredi: 8h00 - 16h30</p>
                            </div>
                        </div>
                        
                        <div class="mt-4">
                            <h5>Suivez-nous</h5>
                            <div class="d-flex gap-3 mt-2">
                                <a href="#" class="btn btn-outline-primary">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                <a href="#" class="btn btn-outline-primary">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a href="#" class="btn btn-outline-primary">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                                <a href="#" class="btn btn-outline-primary">
                                    <i class="fab fa-instagram"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section Carte -->
    <section class="content-section bg-light">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title">Notre emplacement</h2>
                <p class="lead text-muted">Venez nous rendre visite</p>
            </div>
            
            <div class="map-container">
                <!-- Remplacer par une carte Google Maps ou OpenStreetMap -->
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d254174.64186760566!2d-4.120483086885967!3d5.348485598094748!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xfc1ea5311959121%3A0x3fe70ddce19221a6!2sAbidjan%2C%20C%C3%B4te%20d'Ivoire!5e0!3m2!1sen!2sgh!4v1715076258628!5m2!1sen!2sgh" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </section>

    <!-- Section FAQ -->
    <section class="content-section">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title">Questions fréquentes</h2>
                <p class="lead text-muted">Réponses aux questions les plus courantes</p>
            </div>
            
            <div class="row">
                <div class="col-lg-6">
                    <div class="faq-item">
                        <div class="faq-question">
                            <i class="fas fa-question-circle me-2"></i>Comment puis-je obtenir un compte sur BDCOV ?
                        </div>
                        <div class="faq-answer">
                            Les comptes sont créés par l'administration de votre université. Contactez votre secrétariat pédagogique pour obtenir vos identifiants de connexion.
                        </div>
                    </div>
                    
                    <div class="faq-item">
                        <div class="faq-question">
                            <i class="fas fa-question-circle me-2"></i>Quels formats de fichiers sont acceptés pour le dépôt des rapports ?
                        </div>
                        <div class="faq-answer">
                            BDCOV accepte les rapports au format PDF, DOC et DOCX. La taille maximale du fichier est de 20 Mo.
                        </div>
                    </div>
                    
                    <div class="faq-item">
                        <div class="faq-question">
                            <i class="fas fa-question-circle me-2"></i>Comment savoir si mon rapport a été validé ?
                        </div>
                        <div class="faq-answer">
                            Vous recevrez une notification par email à chaque étape de validation. Vous pouvez également suivre l'état d'avancement de votre rapport dans votre espace étudiant.
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-6">
                    <div class="faq-item">
                        <div class="faq-question">
                            <i class="fas fa-question-circle me-2"></i>Que faire si j'ai oublié mon mot de passe ?
                        </div>
                        <div class="faq-answer">
                            Sur la page de connexion, cliquez sur "Mot de passe oublié" et suivez les instructions pour réinitialiser votre mot de passe. Si le problème persiste, contactez l'administration.
                        </div>
                    </div>
                    
                    <div class="faq-item">
                        <div class="faq-question">
                            <i class="fas fa-question-circle me-2"></i>Comment sont constitués les jurys de soutenance ?
                        </div>
                        <div class="faq-answer">
                            Les jurys sont constitués par la commission en fonction des spécialités des enseignants et de la thématique de votre rapport. Votre encadreur fait automatiquement partie du jury.
                        </div>
                    </div>
                    
                    <div class="faq-item">
                        <div class="faq-question">
                            <i class="fas fa-question-circle me-2"></i>BDCOV est-il accessible depuis un appareil mobile ?
                        </div>
                        <div class="faq-answer">
                            Oui, BDCOV est entièrement responsive et peut être utilisé depuis n'importe quel appareil connecté à internet (ordinateur, tablette, smartphone).
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="text-center mt-4">
                <p>Vous n'avez pas trouvé réponse à votre question ? N'hésitez pas à nous contacter.</p>
                <a href="#contact-form" class="btn btn-outline-primary">
                    <i class="fas fa-envelope me-2"></i>Contactez-nous
                </a>
            </div>
        </div>
    </section>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
