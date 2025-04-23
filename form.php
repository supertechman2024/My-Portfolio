<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Staff Member</title>
</head>
<body>
    <h1>Add Staff Member</h1>

    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "Summ1";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST["name"];
        $email = $_POST["email"];
        $position = $_POST["position"];

        if (empty($name) || empty($email) || empty($position)) {
            echo "Please fill in all fields.";
        } else {
            $sql = "INSERT INTO staff (name, email, position) VALUES ('$name', '$email', '$position')";

            if ($conn->query($sql) === TRUE) {
                echo "New staff member added successfully";
                
                
                header("Location: index.php");
                exit();
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }

    $conn->close();
    ?>

    <h2>Please enter new staff member below...</h2>

    <form action="form.php" method="post">
        <label for="name">Name:</label>
        <br>
        <input type="text" name="name" required>
        <br>

        <label for="email">Email:</label>
        <br>
        <input type="email" name="email" required>
        <br>

        <label for="position">Position:</label>
        <br>
        <select name="position" required>
            <option value="Lecturer">Lecturer</option>
            <option value="Reader">Reader</option>
            <option value="Senior Lecturer">Senior Lecturer</option>
            <option value="Professor">Professor</option>
        </select>
        <br>
        <br>
        <button type="submit">Add Staff Member</button>
    </form>
</body>
</html>
