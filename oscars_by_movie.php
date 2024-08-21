<!--- PHP LOGIC SECTION --------------------------->
<!------------------------------------------------->

<?php

require_once './functions.php';

if (isset($_POST['submit'])) {
    // Check if files were uploaded without errors
    if (isset($_FILES['csv_files'])) {
        $fileCount = count($_FILES['csv_files']['name']);

        $mergedData = [];
        $headers = null;

        for ($i = 0; $i < $fileCount; $i++) {
            // Extract file information for each file
            $fileTmpPath = $_FILES['csv_files']['tmp_name'][$i];
            $fileName = $_FILES['csv_files']['name'][$i];
            $fileNameCmps = explode(".", $fileName);
            $fileExtension = strtolower(end($fileNameCmps));

            // Allowed file types
            $allowedfileExtensions = array('csv');

            if (in_array($fileExtension, $allowedfileExtensions)) {
                // Directory in which the uploaded file will be moved
                $uploadFileDir = './uploaded_files/';
                $dest_path = $uploadFileDir . $fileName;

                if (!file_exists($uploadFileDir)) {
                    mkdir($uploadFileDir, 0755, true); // Create directory if not exists
                }

                // Move the file to the specified directory
                if (move_uploaded_file($fileTmpPath, $dest_path)) {
                    // Process and merge the CSV data

                    if (file_exists($dest_path) && filesize($dest_path) > 0) {

                        $fileData = processCSV($dest_path, $headers);

                        if ($headers === null && !empty($fileData)) {
                            $headers = array_keys($fileData[0]);
                        }
                        $mergedData = array_merge($mergedData, $fileData);
                    } else {
                        echo
                        "<div class='alert alert-danger'>
                           <p>The file " . $fileName . " is empty or does not exist.</p>
                           </div>";
                    }
                } else {
                    echo
                    "<div class='alert alert-danger'>
                        <p>There was an error moving the uploaded file " . $fileName . ".</p>
                    </div>";
                }
            } else {
                echo
                "<div class='alert alert-danger'>
                    <p>Upload failed for " . $fileName . ". Allowed file types: " . implode(',', $allowedfileExtensions) . "</p>
                </div>";
            }
        }
    }

?>

    <!--- HTML SECTION ----------------------------------->
    <!---------------------------------------------------->

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">

        <meta name="description" content="FIO Interview">
        <meta name="author" content="Ondrej Hajek">

        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Oscar winning actors</title>


        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

        <link rel="stylesheet" href="style.css">


    </head>

    <body class="d-flex flex-column min-vh-100 mt-0 mb-0">

        <header class="bg-primary-subtle pt-4 pb-4 sticky-top">

            <h1 class="d-flex justify-content-center align-items-center">
                Oscar awarded movies in both main categories
            </h1>

        </header>

        <div class="flex-fill">


            <!--PHP GENERATET CONTENT------------------------------->
            <!------------------------------------------------------>

        <?php

        // Display the merged data in a single table
        if (!empty($mergedData)) {

            echo "
                <div class='ms-3 mt-3 mb-3'>
                <table class='table'>
                <thead>
                  <tr>
                    <th scope='col'>Movie</th>
                    <th scope='col'>Year</th>
                    <th scope='col'>Female actor</th>
                    <th scope='col'>Male actor</th>
                  </tr>
                </thead>
                <tbody>";

            $groupedByMovie = [];

            foreach ($mergedData as $row) {

                $movie = $row['Movie'];

                if (!isset($groupedByMovie[$movie])) {
                    $groupedByMovie[$movie] =
                        array(
                            'Year' => $row['Year'],
                            'Names' => []
                        );
                };


                $groupedByMovie[$movie]['Names'][] = $row['Name'];
            }

            $maxNames = 2;

            // Remove entries with only one name
            foreach ($groupedByMovie as $movie => $data) {
                if (count($data['Names']) <= 1) {
                    unset($groupedByMovie[$movie]);
                }
            }

            // Sort the merged data by movie title
            ksort($groupedByMovie);

            foreach ($groupedByMovie as $movie => $data) {

                echo "<tr>
                <td>{$movie}</td>
                    <td>{$data['Year']}</td>
                    ";

                // Print names, with empty cells if fewer names are available
                $names = $data['Names'];

                for ($i = 0; $i < $maxNames; $i++) {
                    echo "<td>" . (isset($names[$i]) ? $names[$i] : '') . "</td>";
                }

                echo "</tr>";
            }
        }
        echo "</tbody>
              </table>
              </div>";
    } else {
        echo "<div class='alert alert-danger'> 
        <p>No files were uploaded.</p>
        </div>";
    }


        ?>

        </div>

        <!--HTML SECTION - FOOTER-->
        <!-------------------------------------------->

        <footer class="bg-dark mt-3 pt-5 pb-5 position-relative">
            <p class="text-light d-flex justify-content-center align-items-center">
                &#169 2024 Ondrej Hajek
            </p>

        </footer>


        <!--SCRIPT SECTION-->
        <!-------------------------------------------->

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    </body>

    </html>