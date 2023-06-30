<!DOCTYPE html>
<html>
<head>
    <title>Public Phonebook</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.view-details').click(function(e) {
                e.preventDefault();
                var contactId = $(this).data('contact-id');
                
                $.ajax({
                    url: 'get_contact_details.php',
                    type: 'POST',
                    data: { contactId: contactId },
                    success: function(response) {
                        $('#contact-details').html(response);
                    }
                });
            });
        });
    </script>
</head>
<body>
    <h1>Public Phonebook</h1>
    <h2>Shared Contacts</h2>
    <ul>
        <?php
       
        $contacts = getSharedContacts();
        foreach ($contacts as $contact) {
            echo '<li>' . $contact['first_name'] . ' ' . $contact['last_name'] . ' ';
            echo '<a href="#" class="view-details" data-contact-id="' . $contact['id'] . '">View Details</a></li>';
        }
        ?>
    </ul>
    <div id="contact-details"></div>
</body>
</html>
