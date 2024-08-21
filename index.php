<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta name="description" content="FIO Interview">
    <meta name="author" content="Ondrej Hajek">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Oscar winning actors & movies</title>


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="stylesheet" href="style.css">


</head>

<!-- HTML CONTENT ----------------------------->
<!-------------------------------------------->


<body class="d-flex flex-column min-vh-100 mt-0 mb-0">


    <!-- HEADER ---------------------------------->
    <!-------------------------------------------->


    <header class="bg-primary-subtle pt-4 pb-4 sticky-top">

        <h1 class="d-flex justify-content-center align-items-center">
            Oscar winning actors & movies
        </h1>

    </header>


    <!-- FROM ------------------------------------>
    <!-------------------------------------------->

    <main class="bg-light mt-5 mb-5 ms-3 flex-fill">

        <div class="mt-4 mb-4">
            <form method="post" enctype="multipart/form-data" action="./oscars_by_year.php" target="blank">
                <div class="mt-3 mb-3">
                    <label for="formUpload" class="form-label fw-bold">Import files and sort oscar awarded movies by year</label>
                    <input class="form-control" type="file" id="formUpload" name="csv_files[]" accept=".csv" required multiple>
                </div>

                <input type="submit" name="submit" value="Upload & process" class="btn btn-primary">
            </form>
        </div>
        <hr>
        <div class="mt-4 mb-4">

            <form method="post" enctype="multipart/form-data" action="./oscars_by_movie.php" target="blank">
                <div class="mt-3 mb-3">
                    <label for="formUpload" class="form-label fw-bold">Import files and filter Oscar awarded movies in both main categories</label>
                    <input class="form-control" type="file" id="formUpload" name="csv_files[]" accept=".csv" required multiple>
                </div>

                <input type="submit" name="submit" value="Upload & process" class="btn btn-primary">
            </form>

        </div>
    </main>

    <!-- FOOTER ---------------------------------->
    <!-------------------------------------------->

    <footer class="bg-dark pt-5 pb-5 position-relative">
        <p class="text-light d-flex justify-content-center align-items-center">
            &#169 2024 Ondrej Hajek
        </p>

    </footer>


    <!-- SCRIPT SECTION -------------------------->
    <!-------------------------------------------->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>

</html>