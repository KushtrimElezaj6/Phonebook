
<?php
function getCountries() {
   

   
    $conn = new mysqli('localhost', 'username', 'password', 'database_name');
    if ($conn->connect_errno) {
        echo 'Failed to connect to MySQL: ' . $conn->connect_error;
        exit;
    }

    
    $query = "SELECT id, name FROM countries";
    $result = $conn->query($query);

    $countries = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $countries[] = $row;
        }
    }

    
    $result->close();
    $conn->close();

    return $countries;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Contact</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#add-phone').click(function(e) {
                e.preventDefault();
                var phoneHtml = '<input type="text" name="phone[]" placeholder="Phone Number" /><br>';
                $('#phone-container').append(phoneHtml);
            });

           
            $('#add-email').click(function(e) {
                e.preventDefault();
                var emailHtml = '<input type="text" name="email[]" placeholder="Email Address" /><br>';
                $('#email-container').append(emailHtml);
            });
        });
    </script>
</head>
<body>
    <h1>My Contact</h1>
    <form action="save_contact.php" method="post">
        <label for="first_name">First Name:</label>
        <input type="text" name="first_name" required><br>
        
        <label for="last_name">Last Name:</label>
        <input type="text" name="last_name" required><br>
        
        <label for="country">Country:</label>
        <select name="country">
            <?php
            $countries = getCountries();
            foreach ($countries as $country) {
                echo '<option value="' . $country['id'] . '">' . $country['name'] . '</option>';
            }
            ?>
        </select><br>
        
        <label for="publish">Publish Contact:</label>
        <input type="checkbox" name="publish"><br>
        
        <label for="hide_phone">Hide Phone Numbers:</label>
        <input type="checkbox" name="hide_phone"><br>
        
        <label for="hide_email">Hide Email Addresses:</label>
        <input type="checkbox" name="hide_email"><br>
        
        <label for="phone">Phone Numbers:</label>
        <div id="phone-container">
            <input type="text" name="phone[]" placeholder="Phone Number"><br>
        </div>
        <button id="add-phone">Add Phone Number</button><br>
        
        <label for="email">Email Addresses:</label>
        <div id="email-container">
            <input type="text" name="email[]" placeholder="Email Address"><br>
        </div>
        <button id="add-email">Add Email Address</button><br>
        
        <input type="submit" value="Save">
    </form>
</body>
</html>
