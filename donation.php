<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Donation Page</title>
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
    button[type="submit"]:hover {
      background-color: #555;
    }
    
    .popup h2 {
      margin-bottom: 1rem;
    }
    .popup button {
      padding: 0.5rem 1rem;
      background-color: #333;
      color: #fff;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }
    .back-btn {
    display: inline-block;
    padding: 10px 20px;
    background-color: #1653b4; 
    color: white;
    text-align: center;
    text-decoration: none;
    font-size: 13px;
    border-radius: 5px;
    border: none;
    cursor: pointer;
    position: absolute;
    top: 10px; /* Adjust top position */
    left: 10px; /* Adjust right position */
}

.back-btn:hover {
    background-color: #164da5; 
}
  </style>
</head>
<body>
  <div class="container">
    <h2>Make a Donation</h2>
    <a class='back-btn'  href='homePage.html'  > Back </a>

    <form id="donation-form" action="#" method="POST">
      <label for="donorName">Name of Donor:</label>
      <input type="text" id="donorName" name="donorName" required>

      <label for="donorPhone">Phone Number </label>
      <input type="text" id="donorPhone" name="donorPhone" required>

      <label for="donorAddress">Address:</label>
      <input type="text" id="donorAddress" name="donorAddress" required>

      <label for="donationAmount">Donation Amount:</label>
      <input type="text" id="donationAmount" name="donationAmount" required>

      <label for="paymentMode">Mode of Payment:</label>
      <select id="paymentMode" name="paymentMode" required>
        <option value="credit">Credit Card</option>
        <option value="paypal">UPI</option>
        <option value="bank">Bank Transfer</option>
      </select>

      <button type="submit">Submit</button>
    </form>

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
      
            // Handle Habitue Details form submission
            if (isset($_POST['donorName']) && isset($_POST['donorPhone']) && isset($_POST['donorAddress']) ) {
              $donorName = $_POST['donorName'];
              $donorPhone = $_POST['donorPhone'];
              $donorAddress = $_POST['donorAddress'];

              //check whether this person already exists
               $habitueSql = "SELECT hid from  habitue where lower(h_name) like lower('$donorName') and h_phno='$donorPhone' and lower(h_address) like lower('$donorAddress')";
               if($conn->query($habitueSql)){
                $res=$conn->query($habitueSql);
                
                $number=mysqli_num_rows($res);
                // echo $number;
                if(!$number){
                        $h_Sql = "INSERT INTO habitue (h_name, h_phno, h_address) VALUES ('$donorName', '$donorPhone', '$donorAddress')";
                        if ($conn->query($h_Sql) === TRUE) {
                            echo " Dear $donorName, Thank you for your donation";
                            $fetch_hid="SELECT LAST_INSERT_ID() FROM habitue";
                            $hid=$conn->query($fetch_hid);
                            $hid = $hid->fetch_array();
                            $hid2 = intval($hid[0]);
                            // echo $hid2;
                        }
                }
                else{
                    echo "user already exists";
                    while($row = mysqli_fetch_assoc($res))
                    {
                        echo "hid: " .$row["hid"]. "<br>";
                        $hid2=$row["hid"];
                    }
                }
               }
            }

            if (isset($_POST['donationAmount']) && isset($_POST['paymentMode']))  {
                $donationAmount = $_POST['donationAmount'];
                $paymentMode = $_POST['paymentMode'];
                $donationsql = "INSERT INTO donation (hid, amount, mode_of_payment ) VALUES ('$hid2','$donationAmount','$paymentMode')";
                if ($conn->query($donationsql) === TRUE) {
                    // echo "Donation successfully<br>";
                } else {
                        echo "Error inserting Rescue Details: " . $conn->error . "<br>";
                }
            }
             
            $conn->close();
        }     
    
    ?>

    
  </div>

  
</body>
</html>