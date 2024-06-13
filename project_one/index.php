<?php
// Connect to the database
$conn = mysqli_connect("localhost", "username", "password", "drinks_menu");

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Query to retrieve drinks data
$sql = "SELECT * FROM drinks";
$result = mysqli_query($conn, $sql);

// Function to sort the table
function sortTable($col, $dir) {
  $sql = "SELECT * FROM drinks ORDER BY $col $dir";
  $result = mysqli_query($conn, $sql);
  return $result;
}

// Function to add new drink
function addDrink($name, $price) {
  $sql = "INSERT INTO drinks (name, price) VALUES ('$name', '$price')";
  mysqli_query($conn, $sql);
}
?>

<html>
<head>
  <title>Drinks Menu</title>
  <style>
    table {
      border-collapse: collapse;
      width: 50%;
      margin: 40px auto;
    }
    th, td {
      border: 1px solid #ddd;
      padding: 10px;
      text-align: left;
    }
    th {
      background-color: #f0f0f0;
    }
    tr:hover {
      background-color: #f5f5f5;
    }
  </style>
</head>
<body>
  <h1>Drinks Menu</h1>
  <table>
    <thead>
      <tr>
        <th><a href="?sort=name&dir=asc">Drink</a></th>
        <th><a href="?sort=price&dir=asc">Price</a></th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php
      while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row["name"] . "</td>";
        echo "<td>" . $row["price"] . "</td>";
        echo "<td><a href='edit.php?id=" . $row["id"] . "'>Edit</a> | <a href='delete.php?id=" . $row["id"] . "'>Delete</a></td>";