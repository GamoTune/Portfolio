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

    // Liste des projets
    'projects' => [
        [
            'title' => 'IUT Room Viewer',
            'date' => '2025',
            'description' => [
                'J\'ai codé un script qui permet de visualiser les salles de l\'IUT Informatique de Limoges, et des informations associées.',
                'Combiné à un bot discord, il permet de voir ce qu\'il se passe dans les salles en temps réel.',
                'https://iut-room-viewer.gamo.one'
            ],
            'image' => 'https://gamo.one/assets/room_viewer_logo.png',
            'github' => 'https://github.com/gamotune/iut-room-viewer',
            'gallery' => [
                'https://gamo.one/assets/room_viewer/salles_mtn.jpg',
                'https://gamo.one/assets/room_viewer/salles_entre.jpg',
            ],
            'academic' => [
                'skill' => [
                    'AC21.01' => 'Niveau 3 - Élaboration et implémentation des spécifications fonctionnelles pour une application web temps réel.',
                    'AC23.01' => 'Niveau 3 - Conception et développement d\'applications communicantes (API, bot Discord).',
                    'AC24.02' => 'Niveau 2 - Mise en œuvre de mesures basiques de sécurité et confidentialité des données.',
                    'AC31.02' => 'Niveau 2 - Capacité à faire évoluer une application existante et gérer ses dépendances.',
                    'AC32.02' => 'Niveau 2 - Analyse et diagnostic des performances pour flux en temps réel.',
                    'Analyse' => 'La question de comment récuperé les données des EDT et comment les présentées on été des défis majeurs : gérer le temps de traitement, assurer la cohérence des données entre les PDF et l\'affichage. J\'ai acquis une compréhension approfondie de la conception d\'interfaces communicantes fiables, la création de base de données complexe, de la gestion robuste des erreurs réseau et de la mise en place de stratégies de mise à jour asynchrone et résilientes.'
                ]
            ]
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
            'academic' => [
                'skill' => [
                    'AC21.01' => 'Niveau 3 - Définition et implémentation des spécifications fonctionnelles du jeu.',
                    'AC21.03' => 'Niveau 3 - Application de bonnes pratiques de conception et architecture logicielle (Java/JavaFX).',
                    'AC11.03' => 'Niveau 2 - Réalisation d\'essais et validation des résultats (tests unitaires et manuels).',
                    'AC31.02' => 'Niveau 2 - Adaptation et évolution d\'une application collaborative en équipe.',
                    'AC26.04' => 'Niveau 2 - Rendre compte et documenter le travail en équipe (gestion Git, rapport).',
                    'Analyse' => 'La modélisation complète des règles du jeu a posé un véritable défi, particulièrement la séparation claire entre la logique métier et l\'interface de présentation en JavaFX, ainsi que la gestion des interactions complexes entre les éléments de plateau. Le travail en équipe de 4 a également demandé une synchronisation étroite sur l\'architecture du code pour éviter les conflits. Ce projet m\'a permis de maîtriser l\'architecture modulaire et la séparation des responsabilités, la gestion des états complexes et l\'importance cruciale de la coordination d\'équipe.'
                ]
            ]
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
            'academic' => [
                'skill' => [
                    'AC11.01' => 'Niveau 2 - Implémentation de conceptions simples en scripts shell robustes.',
                    'AC11.03' => 'Niveau 2 - Réalisation d\'essais et validation (gestion d\'erreurs et cas limites).',
                    'AC21.03' => 'Niveau 2 - Adoption de bonnes pratiques de programmation pour la maintenabilité.',
                    'AC14.01' => 'Niveau 2 - Conception et utilisation d\'une structure de données simple via fichiers pour une application.',
                    'AC16.04' => 'Niveau 1 - Développement des compétences interpersonnelles pour travailler en binôme.',
                    'Analyse' => 'Le scripting Bash m\'a confronté à des difficultés prégnantes concernant la robustesse du code : gérer les entrées/sorties de manière fiable, manipuler différents encodages, gérer les permissions système et traiter les cas limites. Déboguer des scripts shell s\'est avéré moins intuitif qu\'un langage compilé, exigeant une compréhension fine des redirections et des codes de retour. Ce projet m\'a enseigné comment automatiser efficacement les tâches système, structurer les scripts pour la maintenabilité et développer des stratégies de débogage shell adapté.'
                ]
            ]
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
            'academic' => [
                'skill' => [
                    'AC21.01' => 'Niveau 3 - Élaboration et implémentation des spécifications fonctionnelles pour un service webhook.',
                    'AC23.01' => 'Niveau 3 - Développement d\'applications communicantes (consommation d\'API et envoi via webhook).',
                    'AC21.04' => 'Niveau 2 - Prise en compte basique d\'ergonomie et clarté des notifications pour les utilisateurs.',
                    'AC24.02' => 'Niveau 2 - Gestion des aspects de sécurité et confidentialité liés aux API externes.',
                    'AC11.03' => 'Niveau 2 - Tests et évaluation des comportements face aux cas limites (API indisponible, erreurs).',
                    'Analyse' => 'L\'utilisation d\'une API non officielle a présenté des défis majeurs : assurer la fiabilité des données qui pouvaient être indisponibles, instables ou au format inattendu, respecter les limites de taux d\'appel, et gérer les optimisations nécessaires pour la génération d\'images. La dépendance à une source non officielle demandait une gestion rigoureuse des erreurs. J\'ai développé une expertise dans la création de services résilients, la programmation asynchrone pour gérer les appels API de manière non-bloquante, et le formatage approprié des données pour les webhooks Discord.'
                ]
            ]
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
            'academic' => [
                'skill' => [
                    'AC21.01' => 'Niveau 2 - Conception et implémentation des spécifications fonctionnelles du bot de jeu.',
                    'AC11.01' => 'Niveau 2 - Implémentation de fonctionnalités simples et fiables (mécanique du BlackJack).',
                    'AC21.03' => 'Niveau 2 - Application de bonnes pratiques de programmation pour la clarté et la maintenabilité.',
                    'AC11.03' => 'Niveau 2 - Réalisation de tests fonctionnels et corrections basées sur retours utilisateurs.',
                    'AC26.03' => 'Niveau 2 - Mobilisation des compétences interpersonnelles pour coordonner le travail en binôme.',
                    'Analyse' => 'Développer un bot de jeu sur Discord a soulevé des questions architecturales complexes : gérer cohérent l\'état des parties simultanées, traiter les commandes concurrentes d\'utilisateurs différents sans créer de conflits ou de pertes de données, et assurer que le jeu reste accessible et réactif. Implémenter une bonne expérience utilisateur en Discord demands aussi une attention à la clarté des messages et à la rapidité des réponses. Ce projet m\'a apporté une véritable expertise dans la structuration des commandes Discord, la gestion prévisible d\'états complexes et la mise en place de persistance minimale pour les sessions de jeu.'
                ]
            ]
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
            'academic' => [
                'skill' => [
                    'AC21.01' => 'Niveau 3 - Conception et implémentation d\'un bot riche en fonctionnalités.',
                    'AC23.01' => 'Niveau 3 - Développement d\'interfaces communicantes et intégration d\'API externes.',
                    'AC21.03' => 'Niveau 3 - Application de bonnes pratiques (modularité, gestion d\'erreurs).',
                    'AC24.02' => 'Niveau 2 - Mise en place de bonnes pratiques pour la sécurité des données utilisateur.',
                    'AC31.03' => 'Niveau 2 - Intégration et déploiement du bot en environnement de production.',
                    'Analyse' => 'En tant que premier bot Discord complet de mon portfolio, After Life m\'a enseigné le véritable défi de la maintenance à long terme : la qualité du code doit être irréprochable dès le départ pour éviter une accumulation de dette technique, et la gestion des données historiques des matchs demande une architecture robuste et des migrations bien pensées. Déployer en production m\'a révélé des aspects non triviaux de la stabilité et de la supervision continue. J\'ai consolidé ma compréhension de la modularisation pour la maintenabilité, l\'importance cruciale des tests automatisés et des meilleures pratiques de déploiement en environnement de production.'
                ]
            ]
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
                'https://gamo.one/assets/eca/ECA.png',
                'https://gamo.one/assets/eca/eca_editor.mp4',
                'https://gamo.one/assets/eca/eca_demo_next.mp4',
                'https://gamo.one/assets/eca/eca_demo_key_tp.mp4',
                'https://gamo.one/assets/eca/eca_demo_finish.mp4',
            ],
            'academic' => [
                'skill' => [
                    'AC11.01' => 'Niveau 3 - Implémentation complète d\'un jeu et d\'un éditeur (logique et IHM).',
                    'AC21.03' => 'Niveau 3 - Application de bonnes pratiques de conception pour la robustesse du jeu.',
                    'AC31.01' => 'Niveau 2 - Choix d\'architecture adaptée pour un jeu indépendant multiplateforme.',
                    'AC11.03' => 'Niveau 3 - Tests approfondis et itérations selon retours (gameplay et éditeur).',
                    'AC32.03' => 'Niveau 2 - Utilisation de méthodes dédiées au domaine (gestion de collision, rendu).',
                    'Analyse' => 'Ce premier grand projet personnel m\'a confronté à des défis techniques significatifs : implémenter une détection de collisions performante en Python, créer un éditeur de niveaux intuitif et ergonomique (ce qui a demandé plusieurs itérations), et optimiser globalement le jeu pour assurer une fluidité suffisante grâce au profilage. La réception positive aux Trophées NSI a validé ma vision créative. J\'ai développé une approche de conception itérative basée sur les retours utilisateurs, maîtrisé les techniques de détection de collisions et d\'optimisation de rendus, et compris l\'importance capitale des tests utilisateurs avant de publier une version stable.'
                ]
            ]
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
            'items' => ['Express.js', 'Discord.js', 'Vite.js', 'Prisma',]
        ],
        [
            'category' => 'Bases de données',
            'items' => ['PostgreSQL', 'MySQL/MariaDB', 'SQL Server', 'MongoDB']
        ],
        [
            'category' => 'Outils',
            'items' => ['Docker', 'Git', 'Apache2', 'MAMP', 'phpMyAdmin', 'Wine']
        ],
        [
            'category' => 'Logiciels',
            'items' => ['VS Code', 'XCode', 'IntelliJ', 'DataGrip', 'Figma', 'Termius', 'FileZilla', 'UTM', 'MS Office', 'iWork']
        ],
        [
            'category' => 'Systèmes d\'exploitation',
            'items' => ['macOS', 'Windows', 'Linux (Ubuntu, Debian, Arch)', 'iOS', 'Android', 'Proxmox VE/BS']
        ],
        [
            'category' => 'Langues',
            'items' => ['Français (natif)', 'Anglais (B2)', 'Espagnol (A2)']
        ],
        [
            'category' => 'Compétences personnelles',
            'items' => ['Curiosité', 'Créativité', 'Travail en équipe', 'Adaptabilité', 'Résolution de problèmes']
        ]
    ],

    // Liste des tests et expérimentations
    'tests' => [
        [
            'title' => 'Serveur Proxmox',
            'date' => '2025',
            'description' => [
                'Configuration d\'un serveur Proxmox VE pour la gestion de machines virtuelles et conteneurs LXC.',
                'J\'ai configuré un réseau interne pour les VM et les LXC, et installer TailScale pour un accès sécurisé à distance.',
                'Sur cette machine, il y a aussi un LXC AdGuard Home qui me permet de filtrer les publicités et trackers sur tous les appareils de mon réseau domestique.',
                'Et pour finir en beauté, une VM OpenMediavault qui me sert de NAS pour stocker mes fichiers.',
                'Configuration de la machine :',
                '- CPU : Intel Core i5-12400F',
                '- RAM : 2x8Go DDR4 3200MHz',
                '- Stockage : SSD NVMe 1To 4x2To HDD (NAS)',
            ],
            'image' => 'https://gamo.one/assets/ubuntu/server_icon.jpeg',
            'github' => null,
            'webpage' => null,
            'gallery' => [
                'https://gamo.one/assets/proxmox/pve1.png',
                'https://gamo.one/assets/proxmox/pve2.png',
                'https://gamo.one/assets/proxmox/pve3.png',
                'https://gamo.one/assets/proxmox/pve4.png',
                'https://gamo.one/assets/proxmox/pve5.png',
            ],
            'academic' => [
                'skill' => [
                    'AC23.02' => 'Niveau 3 - Utilisation et déploiement de services et serveurs virtualisés (Proxmox, LXC, VM).',
                    'AC23.03' => 'Niveau 3 - Sécurisation des services et des accès réseaux (Tailscale, règles firewall).',
                    'AC13.03' => 'Niveau 2 - Installation et configuration du système d\'exploitation et des outils associés.',
                    'AC24.02' => 'Niveau 2 - Prise en compte de la confidentialité et prévention des fuites de données.',
                    'AC32.01' => 'Niveau 2 - Anticipation des métriques (ressources, stockage, sauvegardes) pour maintien en conditions opérationnelles.',
                    'Analyse' => 'La configuration d\'un hyperviseur Proxmox m\'a présenté plusieurs défis interconnectés : assurer la compatibilité entre les conteneurs LXC et les machines virtuelles, gérer efficacement un système de stockage avec RAID et sauvegardes incrémentielles pour éviter les pertes de données, et concevoir une segmentation réseau sécurisée intégrant Tailscale pour l\'accès externe. J\'ai acquis une compréhension complète du déploiement et de la gestion d\'un hyperviseur professionnel, la conception d\'une architecture réseau segmentée et sécurisée, et la mise en place de procédures automatisées pour les sauvegardes et la surveillance continue de l\'infrastructure.'
                ]
            ]
        ],
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
            'academic' => [
                'skill' => [
                    'AC32.01' => 'Niveau 3 - Anticipation et mesure des performances (temps d\'exécution, occupation mémoire) pour cluster distribué.',
                    'AC32.03' => 'Niveau 3 - Utilisation de bibliothèques et méthodes dédiées (Ray) pour le calcul parallèle.',
                    'AC23.02' => 'Niveau 2 - Déploiement et gestion de services réseau et images pour netboot et provisionnement.',
                    'AC22.02' => 'Niveau 2 - Application de techniques algorithmiques adaptées pour problèmes distribués.',
                    'AC12.01' => 'Niveau 2 - Analyse méthodique du problème et découpage en tâches algorithmiques simples.',
                    'Analyse' => 'La mise en place d\'un cluster de calcul distribué a révélé les limites pratiques du calcul distribué sur infrastructure limitée : les machines disponibles avaient des ressources matérielles restreintes, la latence du réseau local impactait fortement les performances et l\'orchestration de multiples nœuds via netboot demandait une coordination précise et fiable. Ces contraintes ont montré les limites réelles du parallélisme naïf. J\'ai appris à déployer et orchestrer un cluster, à utiliser Ray pour le calcul parallèle en Python, à implémenter le provisionnement via netboot, et comprendre l\'importance de la bande passante et de la latence dans les systèmes distribués.'
                ]
            ]
        ],
        [
            'title' => 'Parallax Canvas JS',
            'date' => '2023',
            'description' => [
                'Petit projet personnel pour expérimenter avec le HTML5 Canvas et le JavaScript. J\'ai créé un effet de parallaxe avec plusieurs couches d\'images qui se déplacent à des vitesses différentes en fonction de leur profondeur.',
                'L\'effet est contrôlé par le clic de la souris qui permet de cliquer sur une planete, afin de recentrer la vue dessus avec une animation fluide. J\'ai aussi ajouté un déplacement au clavier pour naviguer dans l\'espace.',
            ],
            'image' => 'https://gamo.one/assets/parallax_logo.png',
            'github' => null,
            'webpage' => null,
            'gallery' => [
                'https://gamo.one/assets/parallax/video.mov',
            ],
            'academic' => [
                'skill' => [
                    'AC11.01' => 'Niveau 2 - Implémentation d\'éléments graphiques et logique interactive sur Canvas.',
                    'AC11.03' => 'Niveau 2 - Tests et évaluation des comportements (réactivité, collisions simples).',
                    'AC32.03' => 'Niveau 2 - Application de méthodes dédiées à l\'imagerie et rendu performant.',
                    'AC21.04' => 'Niveau 1 - Prise en compte d\'aspects d\'ergonomie et d\'accessibilité simples.',
                    'AC21.03' => 'Niveau 2 - Adoption de bonnes pratiques de conception et structuration du code.',
                    'Analyse' => 'Créer un effet de parallaxe fluide avec HTML5 Canvas a demandé une optimisation minutieuse du rendu pour éviter les ralentissements et les saccades. Gérer plusieurs couches d\'images se déplaçant à des vitesses différentes tout en maintenant une interactivité fluide (événements souris et clavier) a présenté un véritable défi de performance et de timing. J\'ai acquis une maîtrise profonde des transformations Canvas et de l\'optimisation du rendu, une compréhension approfondie de l\'animation et du timing JavaScript, et la capacité à mettre en place des contrôles utilisateurs réactifs et fluides.'
                ]
            ]
        ],
        [
            'title' => 'Serveur Ubuntu',
            'date' => '2023',
            'description' => [
                'Machine physique chez moi, utilisant Ubuntu Server 22.04 LTS.',
                'J\'ai configuré divers services comme un serveur web (Apache2), des serveurs de jeux (Minecraft/Satisfactory), et pm2 me permet de gérer mes applications Node.js.',
            ],
            'image' => 'https://gamo.one/assets/ubuntu/server_icon.jpeg',
            'github' => null,
            'webpage' => null,
            'gallery' => [
                'https://gamo.one/assets/ubuntu/server.jpeg',
                'https://gamo.one/assets/ubuntu/ssh_login.jpeg',
            ],
            'academic' => [
                'skill' => [
                    'AC13.03' => 'Niveau 3 - Installation et configuration d\'Ubuntu Server et services (Apache2, pm2).',
                    'AC13.02' => 'Niveau 2 - Utilisation des fonctionnalités multi-utilisateurs et gestion des comptes.',
                    'AC23.02' => 'Niveau 2 - Déploiement et gestion de services réseaux (serveurs de jeux, web).',
                    'AC23.03' => 'Niveau 2 - Sécurisation des services exposés et gestion des accès.',
                    'AC31.03' => 'Niveau 2 - Maintien en conditions opérationnelles et gestion des déploiements.',
                    'Analyse' => 'L\'administration d\'un serveur Ubuntu en production a montré la complexité réelle du maintien des services : assurer que les mises à jour n\'interrompent pas les services actifs, implémenter une sécurité adéquate contre les accès non autorisés, gérer la vie des données sensibles en production et superviser discrètement mais efficacement l\'état du système. La stabilité requiert une prévention permanente plutôt qu\'une intervention réactive. J\'ai consolidé ma compréhension de la gestion des services en production avec systemd et pm2, mis en place des procédures efficaces de supervision et de monitoring avec les logs, et développé des procédures saines et testées de sauvegarde et de redéploiement des applications.'
                ]
            ]
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
