<?php
    // CO551 CW2 - Task 1

    include("_includes/config.inc");
    include("_includes/dbconnect.inc");
    include("_includes/functions.inc");

    // Account login check
    if (isset($_SESSION['id'])) {
        // Insert 5 student records into the database
        $sql = "INSERT INTO student VALUES ";
        $sql .= "('20000001', '" . password_hash("password1", PASSWORD_DEFAULT) . "', '1980-08-25', 
            'Terry', 'Walker', '25 Maine Way', 'High Wycombe', 'Bucks', 'UK', 'HP12 1ZZ'), ";
        $sql .= "('20000002', '" . password_hash("password2", PASSWORD_DEFAULT) . "', '1970-05-23', 
            'Elizabeth', 'Wayne', '7 Dry Avenue', 'Henley-on-Thames', 'Oxfordshire', 'UK', 'RG11 2FE'), ";
        $sql .= "('20000003', '" . password_hash("password3", PASSWORD_DEFAULT) . "', '1982-03-15', 
            'Max', 'Turner', '12 River Drive', 'Henley-on-Thames', 'Oxfordshire', 'UK', 'RG15 5ES'), ";
        $sql .= "('20000004', '" . password_hash("password4", PASSWORD_DEFAULT) . "', '1980-08-25', 
            'Sarah', 'Reed', '9 Hill Road', 'High Wycombe', 'Bucks', 'UK', 'HP17 3HE'), ";
        $sql .= "('20000005', '" . password_hash("password5", PASSWORD_DEFAULT) . "', '1980-08-25', 
            'Chloe', 'Hart', '15 Rain Street', 'Henley-on-Thames', 'Oxfordshire', 'UK', 'RG22 7WQ');";

        $result = mysqli_query($conn, $sql);
    }
?>