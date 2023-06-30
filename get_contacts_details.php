<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $contactId = $_POST['contactId'];
    $contactDetails = getContactDetails($contactId);
    if ($contactDetails) {
        echo '<h3>Contact Details</h3>';
        echo '<p><strong>First Name:</strong> ' . $contactDetails['first_name'] . '</p>';
        echo '<p><strong>Last Name:</strong> ' . $contactDetails['last_name'] . '</p>';
        echo '<p><strong>Email:</strong> ' . $contactDetails['email'] . '</p>';
        echo '<p><strong>Phone:</strong> ' . $contactDetails['phone'] . '</p>';
    } else {
        echo 'Contact not found';
    }
}


function getSharedContacts()
{
    return [
        ['id' => 1, 'first_name' => 'John', 'last_name' => 'Doe'],
        ['id' => 2, 'first_name' => 'Jane', 'last_name' => 'Smith'],
        ['id' => 3, 'first_name' => 'Michael', 'last_name' => 'Johnson'],
    ];
}

function getContactDetails($contactId)
{
    $contacts = [
        1 => ['id' => 1, 'first_name' => 'John', 'last_name' => 'Doe', 'email' => 'john@example.com', 'phone' => '123456789'],
        2 => ['id' => 2, 'first_name' => 'Jane', 'last_name' => 'Smith', 'email' => 'jane@example.com', 'phone' => '987654321'],
        3 => ['id' => 3, 'first_name' => 'Michael', 'last_name' => 'Johnson', 'email' => 'michael@example.com', 'phone' => '567890123'],
    ];

    if (isset($contacts[$contactId])) {
        return $contacts[$contactId];
    }

    return null;
}