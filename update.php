<?php
require 'connect.php';

$id = $_GET['updateid'];

// Retrieve the event details and associated venue and city
$sql = "SELECT e.*, v.name AS venue_name, v.id AS venue_id, c.name AS city_name
        FROM event e
        JOIN venue v ON e.venueid = v.id
        JOIN city c ON v.cityid = c.id
        WHERE e.id = $id";
$result = pg_query($con, $sql);
$row = pg_fetch_assoc($result);
$name = $row['name'];
$description = $row['description'];
$starttime = $row['starttime'];
$endtime = $row['endtime'];
$venueId = $row['venue_id'];
$venueName = $row['venue_name'];
$cityName = $row['city_name'];

// Retrieve the available venues
$sqlVenues = "SELECT id, name FROM venue";
$resultVenues = pg_query($con, $sqlVenues);
$venues = pg_fetch_all($resultVenues);

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $starttime = $_POST['starttime'];
    $endtime = $_POST['endtime'];
    $venueId = $_POST['venue'];

    $sql = "UPDATE event SET name = '$name', description = '$description', starttime = '$starttime', endtime = '$endtime', venueid = $venueId WHERE id = $id";
    $result = pg_query($con, $sql);
    if ($result) {
        header('location:display.php');
        exit();
    } else {
        die(pg_last_error($con));
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Log in</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
</head>
<body>
    <div class="container my-5">
        <form method="post">
            <div class="mb-3">
                <label>Name</label>
                <input type="text" class="form-control" placeholder="Enter your name" name="name" autocomplete="off" value="<?php echo $name; ?>">
            </div>
            <div class="mb-3">
                <label>Description</label>
                <input type="text" class="form-control" placeholder="Enter description" name="description" autocomplete="off" value="<?php echo $description; ?>">
            </div>
            <div class="mb-3">
                <label>StartTime</label>
                <input type="time" class="form-control" placeholder="Enter start time" name="starttime" autocomplete="off" value="<?php echo $starttime; ?>">
            </div>
            <div class="mb-3">
                <label>EndTime</label>
                <input type="time" class="form-control" placeholder="Enter end time" name="endtime" value="<?php echo $endtime; ?>">
            </div>
            <div class="mb-3">
                <label>Venue</label>
                <select class="form-control" name="venue">
                    <?php
                    foreach ($venues as $venue) {
                        $venueName = $venue['name'];
                        $venueId = $venue['id'];
                        $selected = ($venueId == $venueId) ? 'selected' : '';
                        echo "<option value='$venueId' $selected>$venueName</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label>City</label>
                <input type="text" class="form-control" placeholder="City" name="city" readonly value="<?php echo $cityName; ?>">
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Update</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>

</body>
</html>



































































































