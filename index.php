<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Directory</title>
    <style>
        .action-button {
            background-color: #dc3545;
            color: #fff;
            border: none;
            padding: 6px 10px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        }
        .action-button:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
    <h1>Staff Directory</h1>
    
    <a>A staff database</a>
    <br>
    <br>

    <a href="form.php">Add New Staff Member</a>

    <h2>View Existing Staff Below</h2>

    <form action="" method="post">
        <label for="position">Filter by Position:</label>
        <select name="position" id="position">
            <option value="">All</option>
            <option value="Lecturer">Lecturer</option>
            <option value="Reader">Reader</option>
            <option value="Senior Lecturer">Senior Lecturer</option>
            <option value="Professor">Professor</option>
        </select>
        <button type="submit">Filter</button>
    </form>

    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "Summ1";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['position'])) {
        $filterPosition = $_POST['position'];
        $sql = "SELECT * FROM staff";

        if (!empty($filterPosition)) {
            $sql .= " WHERE position = '$filterPosition'";
        }

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<table border='1'>";
            echo "<tr><th>ID</th><th>Name</th><th>Email</th><th>Position</th><th>Actions</th></tr>";

            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["name"] . "</td>";
                echo "<td>" . $row["email"] . "</td>";
                echo "<td>" . $row["position"] . "</td>";
                echo "<td>
                        <form action='' method='post' style='display: inline;'>
                            <input type='hidden' name='id' value='" . $row["id"] . "'>
                            <button class='action-button' type='submit' name='delete'>Delete</button>
                        </form>
                        <a class='action-button' href='edit.php?id=" . $row["id"] . "'>Edit</a>
                      </td>";
                echo "</tr>";
            }

            echo "</table>";
        } else {
            echo "0 results";
        }
    }

    
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
        $id = $_POST['id'];
        $deleteSql = "DELETE FROM staff WHERE id = $id";

        if ($conn->query($deleteSql) === TRUE) {
            echo "Record deleted successfully.";
        } else {
            echo "Error deleting record: " . $conn->error;
        }
    }

    $conn->close();
    ?>
</body>
</html>



