<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

    <title>Pet Details</title>
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
    <div class="container my-5" style="font-family: Arial, sans-serif; font-size: xx-large; text-align: center;">
        PET DETAILS
        </div>
        
    <div class="container">
    <a class='btn btn-primary btn-sm'  href='adminHomePage.html'  > Back </a>
        <table cellspacing="20" cellpadding="5" style="background-color:; font-size:12; align-items: center; align-self: center;">
      <thead>
        
          <th>Pet ID</th>
          <th>Pet Name</th>
          <th>Breed</th>
          <th>Gender</th>
          <th>Color</th>
          <th>Date IN</th>
          <th></th>
          <th></th>
        </tr>
      </thead>
      <tbody><tr>
        <?php
          
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

          $searchSql = "SELECT pet_id, pet_name, breed, gender, color, date_in from pet"; 
          $result=$conn->query($searchSql);

              if(!$result){
                die("Invalid query: ".$conn->error);
              }

              while ($row = $result->fetch_assoc()) {
                echo "
                <tr>
                  <td>$row[pet_id]</td>
                  <td>$row[pet_name]</td>
                  <td>$row[breed]</td>
                  <td>$row[gender]</td>
                  <td>$row[color]</td>
                  <td>$row[date_in]</td>
                  <td>
                  <a class='btn btn-primary btn-sm'  href='pet_edit.php?pet_id=$row[pet_id]'> Edit </a>
                  </td>
                  <td>
                  <a class='btn btn-primary btn-sm'  href='pet_veternary.php?pet_id=$row[pet_id]'> Veternary care </a>
                  </td>
                </tr>
                ";
              }
        
        ?>
    </div>
</body>
</html>

