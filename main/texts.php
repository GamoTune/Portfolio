<?php
// Tous les textes du site sont ici
$texts = [
    'site_title' => 'Arthur LABREGERE',
    'projects_title' => 'Projets',
    'skills_title' => 'Compétences',
    'tests_title' => 'Expérimentations',
    'timeline_title' => 'Mon Parcours',
    'about_title' => 'À propos de moi',
    'typing-effect' => 'Développeur • Passionné • Créatif',
    'about_content' => 'Étudiant en deuxième année de BUT Informatique à l\'IUT de Limoges, je suis passionné par le développement et les technologies. Mon parcours m\'a permis d\'acquérir des compétences solides en programmation, notamment en JavaScript, Python, Java et PHP. J\'aime créer des choses utiles, qui servent pour autrui. Que ce soit à travers des projets scolaires comme la recréation du jeu Latice ou des initiatives personnelles comme mon jeu Python, ou mes scripts pour les salles de mon IUT. Je m\'efforce toujours de produire du code propre et efficace. Mon objectif est de continuer à apprendre et à me perfectionner dans le domaine du développement logiciel (back-end principalement).',
    
    // Liens sociaux
    'social_links' => [
        [
            'name' => 'GitHub',
            'url' => 'https://github.com/GamoTune',
            'icon' => 'fab fa-github'
        ],
        [
            'name' => 'LinkedIn',
            'url' => 'https://linkedin.com/in/arthur-labregere',
            'icon' => 'fab fa-linkedin'
        ],
        [
            'name' => 'Email',
            'url' => 'mailto:arthur.labregere@gmail.com',
            'icon' => 'fas fa-envelope'
        ],
        [
            'name' => 'Discord',
            'url' => 'https://discord.com/users/429319137710440449',
            'icon' => 'fab fa-discord'
        ]
    ],
    
    // Ajoute ici d'autres textes si besoin

    // Liste des projets
    'projects' => [
        [
            'title' => 'IUT Room Viewer',
            'date' => '2025',
            'description' => [
                'J\'ai codé un script qui permet de visualiser les salles de l\'IUT Informatique de Limoges, et des informations associées.',
                'Combiné à un bot discord, il permet de voir ce qu\'il se passe dans les salles en temps réel.',
            ],
            'image' => 'https://gamo.one/assets/room_viewer_logo.png',
            'github' => 'https://github.com/gamotune/iut-room-viewer',
            'gallery' => [
                'https://gamo.one/assets/room_viewer/salles_mtn.jpg',
                'https://gamo.one/assets/room_viewer/salles_entre.jpg',
            ],
        ],
        [
            'title' => 'SAE2.01,02,06 - Latice',
            'date' => '2025',
            'description' => [
                'Ce projet à été réalisé dans le cadre d\'une SAE au S2 du BUT Informatique.',
                'En équipe de 4, nous avons recréé le jeu Latice en Java et JavaFX.',
                'J\'ai principalement travaillé sur la logique du jeu et l\'implémentation des règles.'
            ],
            'image' => 'https://raw.githubusercontent.com/GamoTune/Latice/refs/heads/master/src/main/resources/assets/bg_sun.png',
            'github' => 'https://github.com/GamoTune/Latice',
            'gallery' => null,
        ],
        [
            'title' => 'SAE1.03 - Gestion de bibliothèque en Bash',
            'date' => '2024',
            'description' => [
                'Ce projet à été réalisé dans le cadre d\'une SAE en 1ère année de BUT Informatique.',
                'En équipe de 2, nous avons développé des scripts en Bash permettant de gérer une bibliothèque (ajout, suppression, recherche de livres, etc.).'
            ],
            'image' => 'https://gamo.one/assets/bash_logo.png',
            'github' => 'https://github.com/GamoTune/SAE1.03',
            'gallery' => null,
        ],
        [
            'title' => 'Discord Splatoon Webhook',
            'date' => '2024',
            'description' => [
                'J\'ai réalisé un script en JS permettant d\'envoyer des notifications sur un serveur Discord lors de changements de cartes dans le jeu Splatoon 3.',
                'Il utilise une API non officiel pour récupérer les informations de jeu. Ces infos sont transformées en images est sont envoyées via un webhook Discord.'
            ],
            'image' => 'https://gamo.one/assets/judd.png',
            'github' => 'https://github.com/GamoTune/Discord_Webhook_Splatoon_Rotations',
            'gallery' => [
                'https://gamo.one/assets/splatoon/normal.jpg',
                'https://gamo.one/assets/splatoon/event.jpg',
                'https://gamo.one/assets/splatoon/salmon.jpg',
            ],
        ],
        [
            'title' => 'Mini projet BlackJack',
            'date' => '2024',
            'description' => [
                'Ce projet à été réalisé dans le cadre d\'un mini projet en NSI en groupe de 2 personnes.',
                'Je me suis occupé de faire le bot discord (en Node.js) qui permet de jouer au BlackJack en ligne sur un serveur Discord.'
            ],
            'image' => 'https://gamo.one/assets/blackjack_logo.png',
            'github' => 'https://github.com/GamoTune/Mini_Projet_BlackJack/',
            'gallery' => null,
        ],
        [
            'title' => 'After Life',
            'date' => '2023',
            'description' => [
                'After Life est un bot discord que j\'ai développé en Node.js avec la librairie discord.js. Il à été mon premier bot Discord ',
                'Il permettait d\'ajouter des statistiques des matchs CS:GO de mon ancienne équipe, et afficher les informations des joueurs et et des matchs passés.',
                'Malheureusement, le bot n\'est plus en ligne car mon ancienne équipe s\'est dissoute et sa structure n\'est plus d\'actualité.'
            ],
            'image' => 'https://gamo.one/assets/afterlife_logo.png',
            'github' => 'https://github.com/GamoTune/AfterLife',
            'gallery' => null,
        ],
        [
            'title' => 'Electro Cube Adventure',
            'date' => '2023',
            'description' => [
                'Ce jeu est mon tout premier programme. Je l\'ai entièrement développé en Python et je l\'ai réalisé dans le cadre du projet final en NSI au lycée.',
                'Dans ce jeu, vous pouvez jouer un petit cube qui se déplace dans une grille, ou vous pouvez utiliser l\'éditeur pour créer vos propres niveaux.',
                'J\'ai remporté le "Prix de la Creativité (lauréats régionaux NOUVELLE-AQUITAINE)" dans le cadre des <a href="https://trophees-nsi.fr/resultats-2023" target="_blank">Trophées NSI 2023</a>'
            ],
            'image' => 'https://gamo.one/assets/eca_logo.png',
            'github' => 'https://github.com/GamoTune/Electro_Cube_Adventure',
            'gallery' => [
                'https://gamo.one/assets/eca/eca1.png',
                'https://gamo.one/assets/eca/eca2.png',
                'https://gamo.one/assets/eca/eca3.png',
                'https://gamo.one/assets/eca/eca4.png',
                'https://gamo.one/assets/eca/eca5.png',
            ],
        ],


    ],

    // Liste des compétences
    'skills' => [
        [
            'category' => 'Langages',
            'items' => ['Python', 'JavaScript/Node.js', 'TypeScript', 'PHP', 'Java', 'SQL', 'Markdown', 'HTML']
        ],
        [
            'category' => 'Frameworks & Librairies',
            'items' => ['Express.js', 'Discord.js', 'Three.js', 'Vite.js', 'Electron']
        ],
        [
            'category' => 'Bases de données',
            'items' => ['PostgreSQL', 'MySQL', 'MS SQL', 'NoSQL', 'MariaDB']
        ],
        [
            'category' => 'Outils',
            'items' => ['Docker', 'Git', 'Ray', 'Apache2', 'MAMP', 'phpMyAdmin', 'Wine']
        ],
        [
            'category' => 'Logiciels',
            'items' => ['VS Code', 'XCode', 'IntelliJ', 'Eclipse', 'Figma', 'Termius', 'FileZilla', 'UTM', 'MS Office', 'Apple (Pages/Nubers...)']
        ],
        [
            'category' => 'Systèmes d\'exploitation',
            'items' => ['macOS', 'Windows', 'Linux (Ubuntu, Debian, Arch)', 'iOS', 'Android']
        ],
        [
            'category' => 'Langues',
            'items' => ['Français (natif)', 'Anglais (B2)', 'Espagnol (A2)']
        ],
        [
            'category' => 'Compétences personnelles',
            'items' => ['Travail en équipe', 'Résolution de problèmes', 'Adaptabilité', 'Curiosité', 'Créativité']
        ]
    ],

    // Liste des tests et expérimentations
    'tests' => [
        [
            'title' => 'Cluster avec Ray & Netboot',
            'date' => '2025',
            'description' => [
                'Avec mon serveur et 12 autres petits pc physiques, j\'ai mis en place un cluster de calcul distribué avec la librairie Python Ray.',
                'Afin de simplifier la mise en place, j\'ai aussi utilisé un netboot pour démarrer les machines en réseau.',
                ' J\'ai pu expérimenter le calcul parallèle et distribué sur plusieurs machines.',
                'Malheureusement, les machines n\'étaient pas assez puissantes pour des calculs lourds, et le réseau local de la maison limitait les performances.',
            ],
            'image' => 'https://gamo.one/assets/ray/pc_icon.jpg',
            'github' => null,
            'webpage' => null,
            'gallery' => [
                'https://gamo.one/assets/ray/pc.jpeg',
                'https://gamo.one/assets/ray/cable.jpeg',
                'https://gamo.one/assets/ray/stats.jpeg',
                'https://gamo.one/assets/ray/linux_starting.jpeg',
            ],
        ],
        [
            'title' => 'Serveur Ubuntu',
            'date' => '2023',
            'description' => [
                'Machine physique chez moi, utilisant Ubuntu Server 22.04 LTS.',
                'J\'ai configuré divers services comme un serveur web (Apache2), des serveurs de jeux (Minecraft/Satisfactory), et pm2 me permet de gérer mes applications Node.js.',
            ],
            'image' => 'https://gamo.one/assets/server/server_icon.jpeg',
            'github' => null,
            'webpage' => 'https://server.gamo.one',
            'gallery' => [
                'https://gamo.one/assets/server/server.jpeg',
                'https://gamo.one/assets/server/ssh_login.jpeg',
            ],
        ],
    ],

    // Timeline du parcours
    'timeline' => [
        [
            'year' => '2024 - 2027',
            'title' => 'BUT Informatique',
            'institution' => 'IUT du Limousin',
            'description' => 'Bachelor Universitaire de Technologie en Informatique. Spécialisation en développement logiciel.',
            'type' => 'education'
        ],
        [
            'year' => '2024 - Présent',
            'title' => 'Auto-entrepreneur',
            'institution' => 'Limoges',
            'description' => 'Aide aux particuliers et petites entreprises pour la réparation et la maintenance de leurs ordinateurs. Installation de logiciels, configuration de réseaux et conseils en sécurité informatique.',
            'type' => 'work'
        ],
        [
            'year' => '2021 - 2024',
            'title' => 'Bac Général (Maths NSI)',
            'institution' => 'Lycée Turgot Limoges',
            'description' => 'Baccalauréat général avec spécialités en Mathématiques, Numérique et science informatique, et Sciences de l\'Ingénieur (abandonné en terminale).',
            'type' => 'education'
        ]
    ],
];
