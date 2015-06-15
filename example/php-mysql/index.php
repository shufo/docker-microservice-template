<?php
// pdo connection
$dbname = getenv('MYSQL_ENV_MYSQL_DATABASE');
$host = getenv('MYSQL_PORT_3306_TCP_ADDR');
$dsn = 'mysql:dbname=' . $dbname . ';host=' . $host;

$user = getenv('MYSQL_ENV_MYSQL_USER');
$password = getenv('MYSQL_ENV_MYSQL_PASSWORD');

// make db handler
try {
    $dbh = new PDO($dsn, $user, $password);
    
    $sql = "CREATE TABLE IF NOT EXISTS `test`"
  	  ."("
  	  . "`id` INT auto_increment primary key,"
  	  . "`text` VARCHAR(128)"
  	  .");";
    $stmt = $dbh -> prepare($sql);
    $stmt -> execute();
} catch (PDOException $e){
	    print('Connection failed:'.$e->getMessage());
		die();
}

// insert value if form posted.
if (!empty($_POST)) {
  if (isset($_POST['value']) && strlen($_POST['value']) > 0) {
     $value = $_POST['value'];
     $stmt = $dbh -> prepare("INSERT INTO test (text) VALUES (:value)");
	 $stmt->bindValue(':value', $value, PDO::PARAM_STR);
	 $stmt->execute();
  }
}

?>

<html>
  <form method="post" action="." name="insert">
	<input type="text" name="value">
    <input type="submit" value="send">
  </form>
  <table>
    <?php
    $stmt = $dbh->query("SELECT * FROM test ORDER BY id ASC");
    while($row = $stmt -> fetch(PDO::FETCH_ASSOC)) {
	 $id = $row["id"];
	 $text = $row["text"];
	 echo "<tr><td>${id}</td><td>${text}</td></tr>";
    }
    ?>
  </table>
</html>
