<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  <title>Pet Search and Donation</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f5f5f5;
    }
    .container {
      max-width: 800px;
      margin: 2rem auto;
      padding: 2rem;
      background-color: #fff;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      border-radius: 10px;
    }
    form {
      margin-bottom: 2rem;
    }
    label {
      display: block;
      font-weight: bold;
      margin-bottom: 0.5rem;
    }
    input[type="text"], select {
      width: 100%;
      padding: 0.5rem;
      border: 1px solid #ccc;
      border-radius: 5px;
      margin-bottom: 1rem;
    }
    button[type="submit"] {
      padding: 0.5rem 1rem;
      background-color: #333;
      color: #fff;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }
    .aclass{
      padding: 0.5rem 1rem;
      background-color: #333;
      color: #fff;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }
    button[type="submit"]:hover {
      background-color: #555;
    }
    table{
      max-width: 800px;
      margin: 2rem auto;
      padding: 2rem;
      background-color: #fff;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      border-radius: 10px;
      width:100%;
    }
    
    tbody.tr{
      background-color:rgb(184, 218, 222);
      padding: 0.5rem;
      border: 1px solid #ccc;
      border-radius: 5px;
      margin-bottom: 1rem;

    }
    thead{
      background-color:rgb(161, 229, 236);
      padding: 0.7rem;
      border: 2px solid #ccc;
      border-radius: 5px;
      margin-bottom: 2rem;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>Search for a Pet</h2>
    <form  action="#" method="POST">
      <label for="breed">Breed Name: </label>
      <select name="breed">
        <option value="Any" name="Any">Any</option>
        <option value="Indian Pariah Dog">Indian Pariah Dog</option>
        <option value="Indian Spitz">Indian Spitz</option>
        <option value="Golden Retriever">Golden Retriever</option>
        <option value="Labrador">Labrador</option>
        <option value="Combai">Combai</option>
        <option value="Chippiparai">Chippiparai(Kanni)</option>
        <option value="Rajapalyam">Rajapalyam</option>
        <option value="Rampur Hound">Rampur Hound</option>
        <option value="Rottweiler">Rottweiler</option>
        <option value="German Shepherd">German Shepherd</option>
        <option value="Beagle">Beagle</option>
        <option value="Pug">Pug</option>
        <option value="Pomeranian">Pomeranian</option>
        <option value="Doberman">Doberman</option>
        </select>

      <label for="color">Color:</label>
      <input type="text" id="color" name="color">

      <label for="gender">Gender:</label>
      <select id="gender" name="gender">
        <option value="Any" name="Any">Any</option>
        <option value="male" name="male">Male</option>
        <option value="female" name="female">Female</option>
      </select>

      <button type="submit">Search</button>
      <a class="aclass" href="homePage.html" role="button">Back</a>
  </form>
  </div>
  </div class="container" style="align">
    <table cellspacing="20" cellpadding="5" style="background-color:; font-size:12; align-items: center; align-self: center;">
      <thead>
        
          <th>Pet ID</th>
          <th>Pet Name</th>
          <th>Breed</th>
          <th>Gender</th>
          <th>Color</th>
          <th></th>
        </tr>
      </thead>
      <tbody><tr>
        <?php
          if ($_SERVER["REQUEST_METHOD"] == "POST") {
          $servername = 'localhost';
          $username = 'root';
          $password ='tiger';
          $dbname = 'output';

          // Create connection
          $conn = new mysqli($servername, $username, $password, $dbname);

          // Check connection
          if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
          }
          

          if (isset($_POST['breed']) && isset($_POST['color']) && isset($_POST['gender'])) {
            $breed = $_POST['breed'];
            $color = $_POST['color'];
            $gender = $_POST['gender'];

              // search pets Details from the database
              if($breed=="Any" && $gender=="Any" && $color=="" ){
                $searchSql = "SELECT pet_id, pet_name, breed, gender, color from pet where pet_id not in (select pet_id from pet_adoption )";
              }              
              else if($breed=="Any" && $gender=="Any"  && $color!=""){
                $searchSql = "select pet_id, pet_name, breed, gender, color from pet where lower(color) like lower('$color') and pet_id not in (select pet_id from pet_adoption )";
              }
              else if($breed=="Any" && $color=="" && $gender!="Any"){
                $searchSql = "select pet_id, pet_name, breed, gender, color from pet where lower(gender) like lower('$gender') and pet_id not in (select pet_id from pet_adoption )";
              }
              else if($breed=="Any" && $gender!="Any"  && $color!=""){
                $searchSql = "select pet_id, pet_name, breed, gender, color from pet where lower(color) like lower('$color') and lower(gender) like lower('$gender') and pet_id not in (select pet_id from pet_adoption )";
            }
              else if($breed!="Any" && $gender=="Any" && $color==""){
                $searchSql = "select pet_id, pet_name, breed, gender, color from pet where lower(breed) like lower('$breed') and pet_id not in (select pet_id from pet_adoption )";
              }
              else if($breed!="Any" && $gender=="Any" && $color!=""){
                // echo "101";
                $searchSql = "select pet_id, pet_name, breed, gender, color from pet where lower(breed) like lower('$breed') and lower(color) like lower('$color' ) and pet_id not in (select pet_id from pet_adoption )";
              }
              else if($breed!="Any" && $gender!="Any" && $color==""){
                $searchSql = "select pet_id, pet_name, breed, gender, color from pet where lower(breed) like lower('$breed') and lower(gender) like lower('$gender' ) and pet_id not in (select pet_id from pet_adoption )";
              }
                else{          
                $searchSql = "select pet_id, pet_name, breed, gender, color from pet where lower(breed) like lower('$breed') and lower(color) like lower('$color') and lower(gender) like lower('$gender' ) and pet_id not in (select pet_id from pet_adoption )";
              }
              $result=$conn->query($searchSql);

              if(!$result){
                die("Invalid query: ".$conn->error);
              }
              else{
                $numRows = $result->num_rows;
                // Output the number of rows
                if($numRows==0){
                  echo "Sorry! We don't have a furry friend of your desired combination! \n Please try a different combination...";
                }
              }

              while ($row = $result->fetch_assoc()) {
                echo "
                <tr>
                  <td>$row[pet_id]</td>
                  <td>$row[pet_name]</td>
                  <td>$row[breed]</td>
                  <td>$row[gender]</td>
                  <td>$row[color]</td>
                  <td>
                  <a class='btn btn-primary btn-sm'  href='adoption_form.php?pet_id=$row[pet_id]'> Adopt </a>
                  </td>
                </tr>
                ";
              }
          }
          $conn->close();
        }
      ?>

        <!-- display donation if the user adopts pet-->
  


</body>
</html>