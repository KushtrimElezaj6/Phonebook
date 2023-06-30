<?php

require_once 'db.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $countryId = $_POST['country'];
    $publish = isset($_POST['publish']) ? 1 : 0;
    $hidePhone = isset($_POST['hide_phone']) ? 1 : 0;
    $hideEmail = isset($_POST['hide_email']) ? 1 : 0;
    $phoneNumbers = $_POST['phone'];
    $emailAddresses = $_POST['email'];

    
    $conn = require 'db.php';
    $stmt = $conn->prepare('INSERT INTO contacts (first_name, last_name, country_id, publish, hide_phone, hide_email) VALUES (?, ?, ?, ?, ?, ?)');
    $stmt->bind_param('aa', $firstName, $lastName, $countryId, $publish, $hidePhone, $hideEmail);
    $stmt->execute();

   
    $contactId = $stmt->insert_id;

    
    foreach ($phoneNumbers as $phoneNumber) {
        $stmt = $conn->prepare('INSERT INTO phone_numbers (contact_id, phone_number) VALUES (?, ?)');
        $stmt->bind_param('is', $contactId, $phoneNumber);
        $stmt->execute();
    }

   
    foreach ($emailAddresses as $emailAddress) {
        $stmt = $conn->prepare('INSERT INTO email_addresses (contact_id, email_address) VALUES (?, ?)');
        $stmt->bind_param('is', $contactId, $emailAddress);
        $stmt->execute();
    }

   
    $stmt->close();
    $conn->close();

    echo 'Contact saved successfully!';
}
?>
