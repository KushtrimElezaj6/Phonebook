<?php
session_start();
require_once 'db.php';  


$error = '';
$username = '';


if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    header("Location: publicPhonebook.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM user WHERE username = '$username' AND password='password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        echo "inside";
        $row = $result->fetch_assoc();
        $storedPassword = $row['password'];
        
     
        if ($password === $storedPassword) {
   

           
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $username;

            
            header("Location: main_page_registered.php");
            exit();
        } else {
            $error = 'Invalid username or password.';
        }
    } else {
        $error = 'Invalid username or password.';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <style>
       #login_page { 
        display: flex;
        justify-content: center;
        align-items: center;
            width: 100%;
            padding: 20px;
            background-color: #fff;
        }
        form {
            width: 300px;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ccc; 

            
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 5px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #4caf50;
            color: #fff;
            border: none;
            cursor: pointer;
        }

        .error {
            color: red;
            margin-top: 10px;
            text-align: center;
        }
    </style>
</head>
<body>
    <h1>Login</h1>
    <div id="login_page">
        <form method="POST" action="">
            <div>
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" value="<?php echo $username; ?>" required>
            </div>
            <div>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div>
                <input type="submit" value="Login">
            </div>
            <?php if (!empty($error)) { ?>
                <p class="error"><?php echo $error; ?></p>
            <?php } ?>
        </form>
    </div>
</body>
</html>
