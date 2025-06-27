<?php
// Inclure les fichiers nécessaires
require_once('../init.php');
require_once('../includes/slider_functions.php');
//require_once('../auth/gestionlogin.php');

// Affiche le message d'erreur s'il existe
$error = $_SESSION['error'] ?? '';
unset($_SESSION['error']);


// Récupérer les images du slider
$slider_images = get_slider_images();

// Initialiser les variables
$error = '';
$login = '';


?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BDCOV - Connexion</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/stylesLog.css">
</head>
<body>
    <div class="login-container">
        <!-- Slider Section -->
        <div class="login-slider-container">
            <div class="login-slider">
               <?php foreach ($slider_images as $index => $image): ?>
    <div class="login-slide <?php echo $index === 0 ? 'active' : ''; ?>" 
         style="background-image: url('../<?php echo htmlspecialchars($image['chemin_image']); ?>');">
        <div class="slider-overlay"></div>
        <div class="slider-content">
            <div class="slider-heading">Système de Gestion des Soutenances</div>
            <div class="slider-caption"><?php echo htmlspecialchars($image['description']); ?></div>
            <div class="slider-user">
                <div class="slider-avatar">
                    <i class="fas fa-university"></i>
                </div>
                <div>
                    <div class="fw-medium">BDCOV</div>
                    <div class="small opacity-75">Commission de validation</div>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

            </div>
            <div class="slider-nav">
                <div class="slider-nav-btn prev-slide">
                    <i class="fas fa-arrow-left"></i>
                </div>
                <div class="slider-nav-btn next-slide">
                    <i class="fas fa-arrow-right"></i>
                </div>
            </div>
        </div>
        
        <!-- Login Form Section -->
        <div class="login-form-container">
            <div class="login-header">
                <div class="login-logo">BDCOV</div>
                <div class="login-header-buttons">
                    <a href="../index.php" class="home-link">
                        <i class="fas fa-home"></i> Accueil
                    </a>
                </div>
            </div>
            
            <h1 class="login-title">Connectez-vous</h1>
            <p class="login-subtitle">Bienvenue sur la plateforme BDCOV</p>
            
            <?php if (!empty($error)): ?>
            <div class="error-message">
                <i class="fas fa-exclamation-circle"></i>
                <?php echo $error; ?>
            </div>
            <?php endif; ?>
            
            <form method="POST" action="../auth/gestionlogin.php" class="login-form">
                <div class="mb-4">
                    <label for="login" class="form-label">Identifiant</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                        <input type="text" class="form-control" id="login" name="login" placeholder="Votre identifiant" value="<?php echo htmlspecialchars($login); ?>" required>
                    </div>
                </div>
                
                <div class="mb-4">
                    <label for="password" class="form-label">Mot de passe</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Votre mot de passe" required>
                    </div>
                </div>
                
                <div class="forgot-password">
                    <a href="forgot_password.php">Mot de passe oublié ?</a>
                </div>
                
                <button type="submit" class="login-btn btn w-100">
                    <i class="fas fa-sign-in-alt me-2"></i>Connexion
                </button>
            </form>
            
            <div class="mt-auto text-center">
                <small class="text-muted">© <?php echo date('Y'); ?> BDCOV - Tous droits réservés</small>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Gestion du slider
            const slides = document.querySelectorAll('.login-slide');
            const prevBtn = document.querySelector('.prev-slide');
            const nextBtn = document.querySelector('.next-slide');
            let currentSlide = 0;
            let slideInterval;
            
            // Fonction pour afficher un slide spécifique
            function showSlide(index) {
                // Masquer tous les slides
                slides.forEach(slide => slide.classList.remove('active'));
                
                // Afficher le slide demandé
                currentSlide = (index + slides.length) % slides.length;
                slides[currentSlide].classList.add('active');
            }
            
            // Fonction pour passer au slide suivant
            function nextSlide() {
                showSlide(currentSlide + 1);
            }
            
            // Fonction pour passer au slide précédent
            function prevSlide() {
                showSlide(currentSlide - 1);
            }
            
            // Ajouter les écouteurs d'événements
            prevBtn.addEventListener('click', prevSlide);
            nextBtn.addEventListener('click', nextSlide);
            
            // Démarrer le défilement automatique
            function startSlideInterval() {
                slideInterval = setInterval(nextSlide, 5000); // Changer de slide toutes les 5 secondes
            }
            
            // Arrêter le défilement automatique lorsque l'utilisateur interagit
            function stopSlideInterval() {
                clearInterval(slideInterval);
                setTimeout(startSlideInterval, 10000); // Redémarrer après 10 secondes d'inactivité
            }
            
            prevBtn.addEventListener('click', stopSlideInterval);
            nextBtn.addEventListener('click', stopSlideInterval);
            
            // Démarrer le défilement automatique au chargement
            startSlideInterval();
        });
    </script>
</body>
</html>
