<?php
session_start();
$userName = $_SESSION["userName"];
$teamName = $_SESSION["teamName"];
$fileType = $_SESSION["fileType"];

$binary = "";
?>
<!DOCTYPE html>
<html>
<head>
<style>
.grid-container {
  grid-template-columns: 50% 50%;
  display: grid;
  grid-gap: 5px;
  background-color: #2196F3;
  padding: 10px;
  border-radius: 25px;
}
.grid-item {
  background-color: rgba(255, 255, 255, 0.8);
  text-align: center;
  padding: 20px;
  font-size: 15px;
  border-radius: 25px;
}
.item1 {
  grid-column: 1 / span 2;
  grid-row: 1;
}
.item2 {
  grid-column: 1;
  grid-row: 2;
}
.item3 {
  grid-column: 2;
  grid-row: 2;
}
.item3a {
  grid-column: 2;
  grid-row: 6 / span 4;
}
.item4 {
  grid-column: 1;
  grid-row: 3;
}
.item5 {
  grid-column: 1;
  grid-row: 4;
}
.item6 {
  grid-column: 1;
  grid-row: 5;
}
.item7 {
  grid-column: 1;
  grid-row: 6;
}
.item8 {
  grid-column: 1;
  grid-row: 7;
}
.item9 {
  grid-column: 1;
  grid-row: 8;
}

.item10 {
  grid-column: 1 / span 2;
  grid-row: 11;
}

</style>
</head>
<body>
<?php
//Calendar info to database
$eventDescription = $_POST["eventDescription"];
$eventDate = $_POST["eventDate"];
$eventTime = $_POST["eventTime"];
$eventLocation = $_POST["eventLocation"];
$deleteItem = $_POST["deleteItem"];

$servername = "localhost";
$dbusername = "debian-sys-maint";
$password = "bvjwgkcdZl64H808";
$dbname = "ccog";
// Create connection
$conn = new mysqli($servername, $dbusername, $password, $dbname);
// Check connection
if ($conn->connect_error) {
   die("Connection failed: " . $conn->connect_error);
}
if ($eventDescription){






$sql = "INSERT INTO event (eventDescription, eventDate, eventTime, eventLocation)
VALUES ('$eventDescription', '$eventDate', '$eventTime', 'eventLocation')";
}
if ($conn->query($sql) === TRUE) {
    //echo "<div align='center'>";
    //echo "<br><br>";
   //echo "New record created successfully";
   //echo "<br>";echo "<br>";

header('location: calendar.php');
   echo "</div>";
}


if ($deleteItem) {
  $sql = "DELETE FROM event WHERE id=$deleteItem";

if ($conn->query($sql) === TRUE) {
    echo "Record deleted successfully";
} else {
    echo "Error deleting record: " . $conn->error;
}
}



?>

<div class="grid-container">
  <div  class="grid-item item1">
    <h1>CCOG Calendar</h1>
  </div>
<form action="calendar.php" method="POST">


  <div class="grid-item item2">
    <h3>Schedule a New Event at CCOG</h3>
    <label for="eventDescription">Event Description</label><br><textarea rows="4" cols="50" name="eventDescription" required>event info here....</textarea><br><br>


    <label for="eventLocation">Event Location</label><br><select name="eventLocation" required><br>
    <option></option>
    <option value="sanctuary">Sanctuary</option>
    <option value="childrenChurch">Children"s Church</option>
    <option value="fellowshipHall">Fellowship Hall</option>
    <option value="seminaryRoom">Seminary Room</option>
    <option value="Gym">Gym</option>

    </select>
    <br><br>


          <label for="eventDate">Event Date</label><br><input type="date" name="eventDate" required><br><br>


      <label for="eventTime">Event Time</label><br><input type="time" name="eventTime" required><br><br>


      <input type="submit" value="Submit"><br>
  </div>
</form>

  <div class="grid-item item3">
    <h3>Upcoming Events at CCOG</h3>
    <?php
    $sql = "SELECT id, eventDescription, eventDate, eventTime
    FROM event ORDER BY eventDate";
    $result = $conn->query($sql);

    if ($result->num_rows > 0)
              {

        // output data of each row
        while($row = $result->fetch_assoc()) {
$eventDate = $row["eventDate"];
$eDate = strtotime($eventDate);
$today = date('F d, Y');
$today = strtotime($today);



            if ($today < $eDate){

           // $totalwordcount = str_word_count($row["essay"]);
            $eventDescription = $row["eventDescription"];
            $eventDate = $row["eventDate"];
            $eventDate = date('F d, Y',strtotime($eventDate));
            $eventTime = $row["eventTime"];
            $eventTime = date('g:iA',strtotime($eventTime));
            $eventTodayDate = date('F d, Y');
            $rowId = $row["id"];



              echo "<br>";
              echo $eventDate;
              echo "<br>";
              echo $eventTime;
              echo "<br>";
              echo nl2br($eventDescription);
              echo "<br>";
              echo $row["id"];
              echo"<br>";              ?>
              <form action="calendar.php" method="POST">
              <?php
              echo "<td><input type='submit' name='deleteItem' value='".$rowId."'/>Delete</td>";
              ?>
              </form>
              <?php

echo "<br>";
echo "<br>";
}
}
}

?>
</body>
</html>
