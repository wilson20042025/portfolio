<?php include('includes/header.php'); ?>
<link rel="stylesheet" href="css/gallery.css">

<main class="gallery-page">

    <section class="gallery-filters">
        <button class="filter-button active" data-category="all">All</button>
        <button class="filter-button" data-category="Portrait">Portrait</button>
        <button class="filter-button" data-category="Nature">Nature</button>
        <button class="filter-button" data-category="Events">Events</button>
    </section>

    <section class="gallery-grid">
        <?php
        require_once 'db.php'; // ✅ You forgot this

        // ✅ Fetch images from the database
        $sql = "SELECT image, imagename, category FROM images ORDER BY id DESC";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0):
            while ($row = $result->fetch_assoc()):
                $imagePath = $row['image'];
                $altText = htmlspecialchars($row['imagename']);
                $category = htmlspecialchars($row['category']);
        ?>
            <div class="gallery-item" data-category="<?= $category ?>">
                <img src="<?= htmlspecialchars($imagePath) ?>" alt="<?= $altText ?>">
            </div>
        <?php
            endwhile;
        else:
            echo '<p class="no-images">No images found in the gallery.</p>';
        endif;

        $conn->close();
        ?>
    </section>

    <!-- Lightbox -->
    <div id="lightbox" class="lightbox">
        <span class="close-lightbox" role="button" aria-label="Close lightbox">&times;</span>
        <span class="prev-slide" role="button" aria-label="Previous image">&#10094;</span>
        <img class="lightbox-image" src="" alt="Expanded View">
        <span class="next-slide" role="button" aria-label="Next image">&#10095;</span>
    </div>

</main>

<?php include('includes/footer.php'); ?>

