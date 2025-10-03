<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TwentyFirstVisual</title>
    
    <!-- Fonts & Icons -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto&display=swap">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    
    <!-- Theme & Page CSS -->
    <link rel="stylesheet" href="css/theme.css">
    <link rel="stylesheet" href="css/home.css"> <!-- Swap per page -->
    
    <!-- FontAwesome (optional) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

</head>

<body>
    <header class="site-header">
        <div class="logo">
            <a href="index.php" style="text-decoration: none; color: inherit;">
                Twenty First Visuals
            </a>
        </div>

        <nav class="nav">
            <ul class="nav-links" id="nav-links">
                <li><a href="index.php">Home</a></li>
                <li><a href="gallery.php">Gallery</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="contact.php">Contact</a></li>
            </ul>

            <!-- Theme toggle -->
            <button id="theme-toggle" class="icon-button" title="Toggle theme">
                <span class="material-icons">dark_mode</span>
            </button>

            <!-- Burger menu (3 lines) -->
            <div class="burger" id="burger">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </nav>
    </header>
</body>
    <!-- JS -->
    <script src="js/theme-toggle.js" defer></script>
    <script src="js/scripts.js" defer></script>
