<?php
include_once('src/functions.php');

$breedId = isset($_GET['breedId']) ? $_GET['breedId'] : null;

if (!$breedId) {
    die('Breed ID is missing or invalid.');
}

$breedDetails = getCatBreedDetails($breedId); 
$breedImages = getCatImages($breedId); 

if (!$breedDetails || !$breedImages) {
    die('Failed to fetch breed details or images.');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Cat Carousel</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3">
</head>
<body>
    <!-- Responsive navbar-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">Cat Carousel</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            </div>
        </div>
    </nav>

    <!-- Page content-->
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-6 mb-4">
                <div class="carousel-wrapper">
                    <div id="catCarousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-indicators">
                            <?php foreach ($breedImages as $index => $image): ?>
                                <button type="button" data-bs-target="#catCarousel" data-bs-slide-to="<?= $index ?>" class="<?= $index === 0 ? 'active' : '' ?>" aria-current="true" aria-label="Slide <?= $index + 1 ?>"></button>
                            <?php endforeach; ?>
                        </div>
                        <div class="carousel-inner">
                            <?php foreach ($breedImages as $index => $image): ?>
                                <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                                    <img src="<?= $image['url'] ?>" class="d-block w-100" alt="Cat Image">
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#catCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#catCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <h2><?= htmlspecialchars($breedDetails['name']) ?></h2>
                <p><strong>Temperament:</strong> <?= htmlspecialchars($breedDetails['temperament']) ?></p>
                <p><strong>Origin:</strong> <?= htmlspecialchars($breedDetails['origin']) ?></p>
                <p><strong>Description:</strong> <?= htmlspecialchars($breedDetails['description']) ?></p>
                <p><strong>Affection:</strong> <?= getStarRating($breedDetails['affection_level']) ?></p>
                <p><strong>Energy:</strong> <?= getStarRating($breedDetails['energy_level']) ?></p>
                <p><strong>Dog Friendly:</strong> <?= getStarRating($breedDetails['dog_friendly']) ?></p>
                <p><strong>Health Issues:</strong> <?= getStarRating($breedDetails['health_issues']) ?></p>
            </div>
        </div>

        <div class="mt-4">
            <a href="index.php" class="btn btn-secondary">Back to Breeds</a>
        </div>
    </div>

    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>

    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
</body>
</html>