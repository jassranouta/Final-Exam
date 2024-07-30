<!-- showAll.php -->
<?php include 'header.php'; ?>

<h2>All Records</h2>

<?php
// Connect to the database
$conn = new mysqli('localhost', 'root', '', 'final');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch and display records
$sql = "SELECT string_id, message FROM string_info";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "ID: " . $row["string_id"]. " - Message: " . $row["message"]. "<br>";
    }
} else {
    echo "0 results";
}

$conn->close();
?>

<form action="showAll.php" method="post">
    <label for="delete_id">Enter ID to delete:</label>
    <input type="number" id="delete_id" name="delete_id" required>
    <button type="submit" name="delete">Delete</button>
</form>

<?php
if (isset($_POST['delete'])) {
    $delete_id = $_POST['delete_id'];

    // Connect to the database
    $conn = new mysqli('localhost', 'root', '', 'final');

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and bind
    $stmt = $conn->prepare("DELETE FROM string_info WHERE string_id = ?");
    $stmt->bind_param("i", $delete_id);

    // Execute and close
    if ($stmt->execute()) {
        echo "Record deleted successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

</body>
</html>
