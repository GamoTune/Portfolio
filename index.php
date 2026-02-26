<?php
include 'texts.php';
$category = $_GET['cat'] ?? 'projects';
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $texts['site_title'] ?></title>
    <link rel="stylesheet" href="assets/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>
    <div class="container">
        <header class="main-header">
            <h1><?= $texts['site_title'] ?></h1>
            <div class="header-subtitle">
                <span class="typing-effect"><?= $texts['typing-effect'] ?></span>
            </div>
        </header>

        <nav class="navigation-tabs">
            <a href="?cat=projects" class="nav-btn <?= $category === 'projects' ? 'active' : '' ?>">Projets</a>
            <a href="?cat=tests" class="nav-btn <?= $category === 'tests' ? 'active' : '' ?>">Expérimentations</a>
            <a href="?cat=skills" class="nav-btn <?= $category === 'skills' ? 'active' : '' ?>">Compétences</a>
            <a href="?cat=timeline" class="nav-btn <?= $category === 'timeline' ? 'active' : '' ?>">Parcours</a>
            <a href="?cat=about" class="nav-btn <?= $category === 'about' ? 'active' : '' ?>">À propos</a>
        </nav>

        <main class="main-content"><?php if ($category === 'projects'): ?>
                <section class="projects-block">
                    <h2><?= $texts['projects_title'] ?></h2>
                    <div class="projects-list">
                        <?php foreach (($texts['projects'] ?? []) as $project): ?>
                            <div class="project-card">
                                <div class="project-header">
                                    <div class="project-img">
                                        <img src="<?= htmlspecialchars($project['image']) ?>" alt="Logo <?= htmlspecialchars($project['title']) ?>" loading="lazy" />
                                    </div>
                                    <div class="project-title-info">
                                        <h3><?= htmlspecialchars($project['title']) ?></h3>
                                        <span class="project-date"><?= htmlspecialchars($project['date']) ?></span>
                                    </div>
                                </div>
                                <div class="project-content">
                                    <?php foreach ($project['description'] as $desc): ?>
                                        <p><?= $desc ?></p>
                                    <?php endforeach; ?>
                                    <div class="project-links">
                                        <a href="<?= htmlspecialchars($project['github']) ?>" target="_blank">GitHub</a>
                                        <?php if (!empty($project['webpage'])): ?>
                                            <a href="<?= htmlspecialchars($project['webpage']) ?>" target="_blank">Webpage</a>
                                        <?php endif; ?>
                                        <?php if (!empty($project['gallery'])): ?>
                                            <button class="gallery-btn" onclick="openGallery(<?= htmlspecialchars(json_encode($project['gallery'])) ?>, '<?= htmlspecialchars($project['title']) ?>')">Galerie</button>
                                        <?php endif; ?>
                                        <?php if (!empty($project['academic'])): ?>
                                            <button class="academic-btn" onclick="openAcademic(<?= htmlspecialchars(json_encode($project['academic'])) ?>, '<?= htmlspecialchars($project['title']) ?>')">Compétences IUT</button>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </section>

            <?php elseif ($category === 'tests'): ?>
                <section class="tests-block">
                    <h2><?= $texts['tests_title'] ?></h2>
                    <div class="projects-list">
                        <?php foreach (($texts['tests'] ?? []) as $test): ?>
                            <div class="project-card">
                                <div class="project-header">
                                    <div class="project-img">
                                        <img src="<?= htmlspecialchars($test['image']) ?>" alt="Logo <?= htmlspecialchars($test['title']) ?>" loading="lazy" />
                                    </div>
                                    <div class="project-title-info">
                                        <h3><?= htmlspecialchars($test['title']) ?></h3>
                                        <span class="project-date"><?= htmlspecialchars($test['date']) ?></span>
                                    </div>
                                </div>
                                <div class="project-content">
                                    <?php foreach ($test['description'] as $desc): ?>
                                        <p><?= $desc ?></p>
                                    <?php endforeach; ?>
                                    <div class="project-links">
                                        <?php if (!empty($test['github'])): ?>
                                            <a href="<?= htmlspecialchars($test['github']) ?>" target="_blank">GitHub</a>
                                        <?php endif; ?>
                                        <?php if (!empty($test['webpage'])): ?>
                                            <a href="<?= htmlspecialchars($test['webpage']) ?>" target="_blank">Demo</a>
                                        <?php endif; ?>
                                        <?php if (!empty($test['gallery'])): ?>
                                            <button class="gallery-btn" onclick="openGallery(<?= htmlspecialchars(json_encode($test['gallery'])) ?>, '<?= htmlspecialchars($test['title']) ?>')">Galerie</button>
                                        <?php endif; ?>
                                        <?php if (!empty($test['academic'])): ?>
                                            <button class="academic-btn" onclick="openAcademic(<?= htmlspecialchars(json_encode($test['academic'])) ?>, '<?= htmlspecialchars($test['title']) ?>')">Compétences IUT</button>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </section>

            <?php elseif ($category === 'skills'): ?>
                <section class="skills-block">
                    <h2><?= $texts['skills_title'] ?></h2>
                    <div class="skills-grid">
                        <?php foreach (($texts['skills'] ?? []) as $skillGroup): ?>
                            <div class="skill-category">
                                <h3><?= htmlspecialchars($skillGroup['category']) ?></h3>
                                <div class="skill-items">
                                    <?php foreach ($skillGroup['items'] as $skill): ?>
                                        <span class="skill-tag"><?= htmlspecialchars($skill) ?></span>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </section>

            <?php elseif ($category === 'timeline'): ?>
                <section class="timeline-block">
                    <h2><?= $texts['timeline_title'] ?></h2>
                    <div class="timeline">
                        <div class="timeline-line"></div>
                        <?php foreach (($texts['timeline'] ?? []) as $index => $item): ?>
                            <div class="timeline-item <?= $item['type'] ?>" style="animation-delay: <?= ($index * 0.2) ?>s;">
                                <div class="timeline-content">
                                    <div class="timeline-year"><?= htmlspecialchars($item['year']) ?></div>
                                    <h3><?= htmlspecialchars($item['title']) ?></h3>
                                    <div class="timeline-institution"><?= htmlspecialchars($item['institution']) ?></div>
                                    <p><?= htmlspecialchars($item['description']) ?></p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </section>

            <?php elseif ($category === 'about'): ?>
                <section class="about-block">
                    <h2><?= $texts['about_title'] ?></h2>
                    <p><?= $texts['about_content'] ?></p>
                    
                    <div class="social-links">
                        <?php foreach (($texts['social_links'] ?? []) as $social): ?>
                            <a href="<?= htmlspecialchars($social['url']) ?>" target="_blank" class="social-link">
                                <i class="<?= htmlspecialchars($social['icon']) ?>"></i>
                                <span><?= htmlspecialchars($social['name']) ?></span>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </section>

            <?php endif; ?>
        </main>
    </div>

    <!-- Modal pour la galerie d'images et vidéos -->
    <div id="galleryModal" class="gallery-modal">
        <div class="gallery-modal-content">
            <div class="gallery-modal-header">
                <h3 id="galleryTitle"></h3>
                <button class="gallery-close" onclick="closeGallery()">&times;</button>
            </div>
            <div class="gallery-media-container">
                <button class="gallery-nav gallery-prev" onclick="prevImage()">&#8249;</button>
                <div id="galleryMediaWrapper">
                    <img id="galleryImage" src="" alt="" loading="lazy">
                    <video id="galleryVideo" controls preload="metadata">
                        <source id="galleryVideoSource" src="" type="">
                        Votre navigateur ne supporte pas la lecture de vidéos.
                    </video>
                </div>
                <button class="gallery-nav gallery-next" onclick="nextImage()">&#8250;</button>
            </div>
            <div class="gallery-counter">
                <span id="imageCounter"></span>
            </div>
        </div>
    </div>

    <!-- Modal pour les compétences académiques -->
    <div id="academicModal" class="gallery-modal">
        <div class="gallery-modal-content academic-modal-content">
            <div class="gallery-modal-header">
                <h3 id="academicTitle"></h3>
                <button class="gallery-close" onclick="closeAcademic()">&times;</button>
            </div>
            <div class="academic-content-container">
                <div id="academicList" class="academic-list"></div>
            </div>
        </div>
    </div>

    <script>
        // Auto theme detection based on system preference
        const body = document.body;

        // Function to apply theme
        function applyTheme(theme) {
            body.classList.remove('dark-theme', 'light-theme');
            body.classList.add(theme + '-theme');
        }

        // Check system preference
        function getSystemTheme() {
            return window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
        }

        // Apply initial theme based on system preference
        applyTheme(getSystemTheme());

        // Listen for system theme changes
        window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', (e) => {
            applyTheme(e.matches ? 'dark' : 'light');
        });

        // Galerie d'images et vidéos - Variables globales
        let currentGallery = [];
        let currentImageIndex = 0;
        let currentTitle = '';

        // Fonction pour détecter si un fichier est une vidéo
        function isVideo(filename) {
            const videoExtensions = ['.mp4', '.webm', '.ogg', '.mov', '.avi', '.mkv'];
            return videoExtensions.some(ext => filename.toLowerCase().endsWith(ext));
        }

        // Fonction pour obtenir le type MIME d'une vidéo
        function getVideoType(filename) {
            const ext = filename.toLowerCase();
            if (ext.endsWith('.mp4')) return 'video/mp4';
            if (ext.endsWith('.webm')) return 'video/webm';
            if (ext.endsWith('.ogg')) return 'video/ogg';
            if (ext.endsWith('.mov')) return 'video/quicktime';
            return 'video/mp4'; // Par défaut
        }

        // Ouvrir la galerie
        function openGallery(media, title) {
            currentGallery = media;
            currentTitle = title;
            currentImageIndex = 0;
            
            document.getElementById('galleryTitle').textContent = title;
            document.getElementById('galleryModal').style.display = 'block';
            document.body.style.overflow = 'hidden'; // Empêcher le scroll en arrière-plan
            
            updateGalleryImage();
        }

        // Fermer la galerie
        function closeGallery() {
            // Arrêter la vidéo si elle est en cours de lecture
            const video = document.getElementById('galleryVideo');
            video.pause();
            video.currentTime = 0;
            
            document.getElementById('galleryModal').style.display = 'none';
            document.body.style.overflow = 'auto'; // Rétablir le scroll
        }

        // Image/Vidéo précédente
        function prevImage() {
            currentImageIndex = (currentImageIndex - 1 + currentGallery.length) % currentGallery.length;
            updateGalleryImage();
        }

        // Image/Vidéo suivante
        function nextImage() {
            currentImageIndex = (currentImageIndex + 1) % currentGallery.length;
            updateGalleryImage();
        }

        // Mettre à jour le média affiché
        function updateGalleryImage() {
            const img = document.getElementById('galleryImage');
            const video = document.getElementById('galleryVideo');
            const videoSource = document.getElementById('galleryVideoSource');
            const counter = document.getElementById('imageCounter');
            
            const currentMedia = currentGallery[currentImageIndex];
            
            // Vérifier si c'est une vidéo ou une image
            if (isVideo(currentMedia)) {
                // Afficher la vidéo, cacher l'image
                img.style.display = 'none';
                video.style.display = 'block';
                
                // Arrêter la vidéo précédente si elle jouait
                video.pause();
                video.currentTime = 0;
                
                // Définir la source de la vidéo
                videoSource.src = currentMedia;
                videoSource.type = getVideoType(currentMedia);
                video.load();
            } else {
                // Afficher l'image, cacher la vidéo
                video.style.display = 'none';
                img.style.display = 'block';
                
                // Arrêter la vidéo si elle jouait
                video.pause();
                
                // Définir l'image
                img.src = currentMedia;
                img.alt = `${currentTitle} - Image ${currentImageIndex + 1}`;
            }
            
            counter.textContent = `${currentImageIndex + 1} / ${currentGallery.length}`;
        }

        // Gestion des touches clavier
        document.addEventListener('keydown', function(e) {
            const modal = document.getElementById('galleryModal');
            if (modal.style.display === 'block') {
                switch(e.key) {
                    case 'Escape':
                        closeGallery();
                        break;
                    case 'ArrowLeft':
                        prevImage();
                        break;
                    case 'ArrowRight':
                        nextImage();
                        break;
                    case ' ': // Barre d'espace pour play/pause vidéo
                        e.preventDefault();
                        const video = document.getElementById('galleryVideo');
                        if (video.style.display === 'block') {
                            if (video.paused) {
                                video.play();
                            } else {
                                video.pause();
                            }
                        }
                        break;
                }
            }
        });

        // Fermer la modal en cliquant en dehors de l'image
        document.getElementById('galleryModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeGallery();
            }
        });

        // --- Gestion des compétences académiques ---

        function openAcademic(data, title) {
            const modal = document.getElementById('academicModal');
            const titleEl = document.getElementById('academicTitle');
            const listEl = document.getElementById('academicList');
            
            titleEl.textContent = 'Compétences IUT - ' + title;
            listEl.innerHTML = '';

            if (data && data.skill) {
                for (const [skillName, description] of Object.entries(data.skill)) {
                    const item = document.createElement('div');
                    item.className = 'academic-item';
                    
                    const h4 = document.createElement('h4');
                    h4.textContent = skillName;
                    
                    const p = document.createElement('p');
                    p.textContent = description;
                    
                    item.appendChild(h4);
                    item.appendChild(p);
                    listEl.appendChild(item);
                }
            }

            modal.style.display = 'block';
            document.body.style.overflow = 'hidden';
        }

        function closeAcademic() {
            document.getElementById('academicModal').style.display = 'none';
            document.body.style.overflow = 'auto';
        }

        // Fermer la modal académique en cliquant en dehors
        document.getElementById('academicModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeAcademic();
            }
        });

        // Ajout de la touche Echap pour fermer aussi la modal académique
        document.addEventListener('keydown', function(e) {
            const academicModal = document.getElementById('academicModal');
            if (e.key === 'Escape' && academicModal.style.display === 'block') {
                closeAcademic();
            }
        });
    </script>

</body>

</html>