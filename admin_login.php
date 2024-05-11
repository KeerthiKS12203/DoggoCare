<?php
    // Check if the form is submitted
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

      // Handle Habitue Details form submission
      if (isset($_POST['id']) && isset($_POST['pwd']) ) {
        $id = $_POST['id'];
        $pwd = $_POST['pwd'];
        echo $id, $pwd;
       

// Insert Habitue Details into the database      
           $adminSql = "SELECT * from  admin where id='$id' and pwd='$pwd'";
             if($conn->query($adminSql)){
              $res=$conn->query($adminSql);
              
              $number=mysqli_num_rows($res);
                if($number!=0){
                    echo "Login successful";
                    header("location: adminHomePage.html");
                    exit;
                }
                else{
                    echo $id, $pwd."does not exist";
                    header("location: adminHomePage.html");
                exit;
                }

             }
            }
            else{
                
                header("location: adminHomePage.html");
                exit;
            }
            $conn->close();
        }
              ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Administrator Sign In</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f5f5f5;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
    }
    .container {
      max-width: 400px;
      padding: 2rem;
      background-color: #fff;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      border-radius: 10px;
      text-align: center;
    }
    h2 {
      margin-bottom: 1rem;
    }
    label {
      display: block;
      font-weight: bold;
      margin-bottom: 0.5rem;
    }
    input[type="text"], input[type="password"] {
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
      transition: background-color 0.3s ease;
    }
    button[type="submit"]:hover {
      background-color: #555;
    }
  </style>
</head>
<body>
  <div class="container" >
    <h2>Administrator Sign In</h2>
    <form action="#" method="post">
      <label for="id">Administrator ID:</label>
      <input type="text" id="id" name="id" required>

      <label for="pwd">Password:</label>
      <input type="password" id="pwd" name="pwd" required>

      <button type="submit">Sign In</button>
    
      

    </form>
    
  </div>
  
</body>
</html>