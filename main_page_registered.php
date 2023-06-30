<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: index.php");
    exit();
}

if (isset($_SESSION['loggedin'])) {
    $loggedin = $_SESSION['loggedin'];
} else {
    $loggedin = false;
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Main Page - Registered Users</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f1f1f1;
        }
        
        h1 {
            text-align: center;
            color: #333;
        }
        
        #main_page ul {
            list-style-type: none;
            padding: 0;
        }
        
        #main_page li {
            display: inline-block;
            margin-right: 10px;
        }
        
        #main_page a {
            text-decoration: none;
            color: #333;
        }
        
        #main_page a:hover {
            color: #555;
        }
        
        #block {
            margin-top: 20px;
            border: 1px solid #ccc;
            padding: 10px;
            background-color: #fff;
        }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            function loadPage(page) {
                $.ajax({
                    url: page,
                    success: function(result) {
                        $('#block').html(result);
                    }
                });
            }

           
            $('#logoutMenu').click(function() {
                loadPage('login.php');
            });

            $('#contactsMenu').click(function() {
                loadPage('contacts.php');
            });

            
            $('#phonebookMenu').click(function() {
                loadPage('phonebook.php');
            });
        });
    </script>
</head>
<body>
    <h1>Main Page - Registered Users</h1>

    <div id="main_page">
        <ul id="pages">
            <li><a id="logoutMenu" href="#">Logout</a></li>
            <li><a id="contactsMenu" href="#">My Contacts</a></li>
            <li><a id="phonebookMenu" href="#">Public Phonebook</a></li>
        </ul>
    </div>
    
    <div id="block">
    </div>
</body>
</html>
