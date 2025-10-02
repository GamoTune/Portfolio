<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site en maintenance</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            height: 100vh;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 25%, #f093fb 50%, #f5576c 75%, #4facfe 100%);
            background-size: 400% 400%;
            animation: gradientShift 8s ease infinite;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
        }

        @keyframes gradientShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .maintenance-container {
            text-align: center;
            padding: 40px;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            width: 90%;
        }

        .maintenance-title {
            font-size: clamp(2rem, 5vw, 3.5rem);
            font-weight: 700;
            margin-bottom: 20px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
            animation: pulse 2s ease-in-out infinite;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.8; }
        }

        .maintenance-subtitle {
            font-size: clamp(1.1rem, 3vw, 1.5rem);
            font-weight: 400;
            opacity: 0.9;
            margin-bottom: 30px;
            line-height: 1.6;
        }

        .maintenance-icon {
            font-size: 2rem;
            margin-bottom: 20px;
            font-weight: 600;
            opacity: 0.9;
        }

        .maintenance-message {
            font-size: 1.1rem;
            opacity: 0.8;
            margin-bottom: 20px;
            line-height: 1.5;
        }

        .maintenance-footer {
            font-size: 0.9rem;
            opacity: 0.7;
            margin-top: 30px;
        }

        .sparkle {
            position: absolute;
            width: 4px;
            height: 4px;
            background: white;
            border-radius: 50%;
            animation: sparkle 2s ease-in-out infinite;
        }

        @keyframes sparkle {
            0%, 100% { opacity: 0; transform: scale(0); }
            50% { opacity: 1; transform: scale(1); }
        }

        .sparkle:nth-child(1) { top: 20%; left: 20%; animation-delay: 0s; }
        .sparkle:nth-child(2) { top: 30%; right: 25%; animation-delay: 0.5s; }
        .sparkle:nth-child(3) { bottom: 40%; left: 30%; animation-delay: 1s; }
        .sparkle:nth-child(4) { bottom: 20%; right: 20%; animation-delay: 1.5s; }
    </style>
</head>
<body>
    <div class="sparkle"></div>
    <div class="sparkle"></div>
    <div class="sparkle"></div>
    <div class="sparkle"></div>
    
    <div class="maintenance-container">
        <div class="maintenance-icon">MAINTENANCE</div>
        <h1 class="maintenance-title">Refonte du site</h1>
        <p class="maintenance-subtitle">Je travaille actuellement sur un nouveau portfolio</p>
        <div class="maintenance-footer">
            Merci pour votre patience ! ✨
        </div>
    </div>
</body>
</html>
