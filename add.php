<?php
require 'connect.php';

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $starttime = $_POST['starttime'];
    $endtime = $_POST['endtime'];
    $venueid = $_POST['venue'];

    $sql = "INSERT INTO event (name, description, starttime, endtime, venueid)
            VALUES ('$name', '$description', '$starttime', '$endtime', $venueid)";

    $result = pg_query($con, $sql);
    if ($result) {
        //echo "Data inserted successfully";
        header('location:display.php');
        exit();
    } else {
        die(pg_last_error($con));
    }
}

// Retrieve available venues
$venueSql = "SELECT id, name FROM venue";
$venueResult = pg_query($con, $venueSql);
$venues = pg_fetch_all($venueResult);
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Event</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
</head>

<body>
    <div class="container my-5">
        <form method="post">
            <div class="mb-3">
                <label>Name</label>
                <input type="text" class="form-control" placeholder="Enter name" name="name" autocomplete="off">
            </div>
            <div class="mb-3">
                <label>Description</label>
                <input type="text" class="form-control" placeholder="Enter description" name="description" autocomplete="off">
            </div>
            <div class="mb-3">
                <label>StartTime</label>
                <input type="time" class="form-control" placeholder="Enter start time" name="starttime" autocomplete="off">
            </div>
            <div class="mb-3">
                <label>EndTime</label>
                <input type="time" class="form-control" placeholder="Enter end time" name="endtime" autocomplete="off">
            </div>
            <div class="mb-3">
                <label>Venue</label>
                <select class="form-control" name="venue">
                    <?php
                    foreach ($venues as $venue) {
                        $venueId = $venue['id'];
                        $venueName = $venue['name'];
                        echo "<option value='$venueId'>$venueName</option>";
                    }
                    ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
</body>

</html>






























