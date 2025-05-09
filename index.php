<?php
include_once('src/functions.php');

$cat_breeds = getCatBreeds(); 

if (!$cat_breeds) {
    die('Failed to fetch cat breeds from the API.');
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
        <form method="GET" action="carousel.php"> 
    <div class="row mb-3">
        <div class="col-md-8">
            <label for="cat_breed" class="form-label">Choose a Cat Breed</label>
            <select class="form-select" id="cat_breed" name="breedId"> 
                <option value="">Select a Breed</option>
                <?php foreach ($cat_breeds as $breed) : ?>
                    <option value="<?= htmlspecialchars($breed['id']) ?>"><?= htmlspecialchars($breed['name']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-md-4 d-flex align-items-end">
            <button type="submit" class="btn btn-primary w-100">Show Cats</button>
        </div>
    </div>
</form>
    </div>

    <script>
        document.querySelector('form').addEventListener('submit', function(event) {
            var breedSelected = document.querySelector('#cat_breed').value;
            if (!breedSelected) {
                alert('Please select a cat breed.');
                event.preventDefault(); 
            }
        });
    </script>

    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
</body>
</html>
