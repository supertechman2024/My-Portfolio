<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Staff Member</title>
</head>
<body>
    <h1>Edit Staff Member</h1>

    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "Summ1";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
        $id = $_GET['id'];

        $sql = "SELECT * FROM staff WHERE id = $id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $name = $row["name"];
            $email = $row["email"];
            $position = $row["position"];
        } else {
            echo "Staff member not found.";
        }
    } elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
        $id = $_POST["id"];
        $name = $_POST["name"];
        $email = $_POST["email"];
        $position = $_POST["position"];

        $updateSql = "UPDATE staff SET name='$name', email='$email', position='$position' WHERE id=$id";

        if ($conn->query($updateSql) === TRUE) {
            echo "Staff member updated successfully.";
            
            header("Location: index.php");
            exit();
        } else {
            echo "Error updating record: " . $conn->error;
        }
    }

    $conn->close();
    ?>

    <h2>Edit staff details below...</h2>

    <form action="edit.php" method="post">
        <input type="hidden" name="id" value="<?php echo $id; ?>">

        <label for="name">Name:</label>
        <br>
        <input type="text" name="name" value="<?php echo $name; ?>" required>
        <br>

        <label for="email">Email:</label>
        <br>
        <input type="email" name="email" value="<?php echo $email; ?>" required>
        <br>

        <label for="position">Position:</label>
        <br>
        <select name="position" required>
            <option value="Lecturer" <?php echo ($position == 'Lecturer') ? 'selected' : ''; ?>>Lecturer</option>
            <option value="Reader" <?php echo ($position == 'Reader') ? 'selected' : ''; ?>>Reader</option>
            <option value="Senior Lecturer" <?php echo ($position == 'Senior Lecturer') ? 'selected' : ''; ?>>Senior Lecturer</option>
            <option value="Professor" <?php echo ($position == 'Professor') ? 'selected' : ''; ?>>Professor</option>
        </select>
        <br>
        <br>
        <button type="submit">Update Staff Member</button>
    </form>
</body>
</html>


