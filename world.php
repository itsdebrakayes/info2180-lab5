<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $country = isset($_GET['country']) ? $_GET['country'] : '';
    $lookup = isset($_GET['lookup']) ? $_GET['lookup'] : '';

    if ($lookup == 'cities') {
        $stmt = $conn->prepare("SELECT cities.name, cities.district, cities.population 
                                FROM cities 
                                JOIN countries ON cities.country_code = countries.code 
                                WHERE countries.name LIKE ?");
        $stmt->execute(["%$country%"]);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo "<table border='1'><tr><th>City</th><th>District</th><th>Population</th></tr>";
        foreach ($results as $row) {
            echo "<tr><td>".$row['name']."</td><td>".$row['district']."</td><td>".$row['population']."</td></tr>";
        }
        echo "</table>";
    } else {
        $stmt = $conn->prepare("SELECT name, continent, independence_year, head_of_state 
                                FROM countries WHERE name LIKE ?");
        $stmt->execute(["%$country%"]);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo "<table border='1'><tr><th>Country</th><th>Continent</th><th>Independence Year</th><th>Head of State</th></tr>";
        foreach ($results as $row) {
            echo "<tr><td>".$row['name']."</td><td>".$row['continent']."</td><td>".$row['independence_year']."</td><td>".$row['head_of_state']."</td></tr>";
        }
        echo "</table>";
    }
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
