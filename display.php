<?php
require 'connect.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <title>Crud operation</title>
</head>
<body>
<div class="container">
    <button class="btn btn-primary my-5"><a href="add.php" class="text-light">Add</a></button>
    <table class="table">
        <thead>
            <tr>
            <th scope="col">No</th>
            <th scope="col">Name</th>
            <th scope="col">Description</th>
            <th scope="col">Time</th>
            <th scope="col">Venue</th>
            <th scope="col">Operations</th>
            </tr>
        </thead>
        <tbody>
<?php
$sql = "SELECT e.id, e.name, e.description, CONCAT(e.starttime, ' - ', e.endtime) AS time, CONCAT(v.name, ', ', c.name) AS venue_info
        FROM event e
        INNER JOIN venue v ON e.venueid = v.id
        INNER JOIN city c ON v.cityid = c.id";
$result = pg_query($con, $sql);
if ($result) {
    while ($row = pg_fetch_assoc($result)) {
        $id = $row['id'];
        $name = $row['name'];
        $description = $row['description'];
        $time = $row['time'];
        $venueInfo = $row['venue_info'];
        echo '<tr>
                <th scope="row">'.$id.'</th>
                <td>'.$name.'</td>
                <td>'.$description.'</td>
                <td>'.$time.'</td>
                <td>'.$venueInfo.'</td>
                <td>
                    <button class="btn btn-primary">
                        <a href="update.php?updateid='.$id.'" class="text-light">Update</a>
                    </button>
                    <button class="btn btn-danger">
                        <a href="delete.php?deleteid='.$id.'" class="text-light">Delete</a>
                    </button>
                </td>
            </tr>';
    }
}
?>
        </tbody>
    </table>
</div>    
</body>
</html>




















































































































































































































































































































































































































































































































































