<!-- index.php -->
<?php include 'header.php'; ?>

<form action="index.php" method="post">
    <label for="message">Enter a message:</label>
    <input type="text" id="message" name="message" maxlength="50" required>
    <button type="submit" name="submit">Submit</button>
</form>

<a href="showAll.php">Show all records</a>

<?php
if (isset($_POST['submit'])) {
    $message = $_POST['message'];

    // Connect to the database
    $conn = new mysqli('localhost', 'root', '', 'final');

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO string_info (message) VALUES (?)");
    $stmt->bind_param("s", $message);

    // Execute and close
    if ($stmt->execute()) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

</body>
</html>
