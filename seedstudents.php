<?php
    // CO551 CW2 - Tasks 1 & 7

    include("_includes/config.inc");
    include("_includes/dbconnect.inc");
    include("_includes/functions.inc");

    // Account login check
    if (isset($_SESSION['id'])) {
        // Create student entries
        $array_students = array(
            array(
                "studentid" => "20000001",
                "password" => password_hash("password1", PASSWORD_DEFAULT),
                "dob" => "1980-08-25",
                "firstname" => "Terry",
                "lastname" => "Walker",
                "house" => "25 Maine Way",
                "town" => "High Wycombe",
                "county" => "Bucks",
                "country" => "UK",
                "postcode" => "HP12 1ZZ"
            ),
            array(
                "studentid" => "20000002",
                "password" => password_hash("password2", PASSWORD_DEFAULT),
                "dob" => "1970-05-23",
                "firstname" => "Elizabeth",
                "lastname" => "Wayne",
                "house" => "7 Dry Avenue",
                "town" => "Henley-on-Thames",
                "county" => "Oxfordshire",
                "country" => "UK",
                "postcode" => "RG11 2FE"
            ),
            array(
                "studentid" => "20000003",
                "password" => password_hash("password3", PASSWORD_DEFAULT),
                "dob" => "1982-03-15",
                "firstname" => "Max",
                "lastname" => "Turner",
                "house" => "12 River Drive",
                "town" => "Henley-on-Thames",
                "county" => "Oxfordshire",
                "country" => "UK",
                "postcode" => "RG15 5ES"
            ),
            array(
                "studentid" => "20000004",
                "password" => password_hash("password4", PASSWORD_DEFAULT),
                "dob" => "1980-08-25",
                "firstname" => "Sarah",
                "lastname" => "Reed",
                "house" => "9 Hill Road",
                "town" => "High Wycombe",
                "county" => "Bucks",
                "country" => "UK",
                "postcode" => "HP17 3HE"
            ),
            array(
                "studentid" => "20000005",
                "password" => password_hash("password5", PASSWORD_DEFAULT),
                "dob" => "1986-02-12",
                "firstname" => "Chloe",
                "lastname" => "Hart",
                "house" => "15 Rain Street",
                "town" => "Henley-on-Thames",
                "county" => "Oxfordshire",
                "country" => "UK",
                "postcode" => "RG22 7WQ"
            ),
        );

        // Build prepared statements to insert 5 student records into the database
        foreach ($array_students as $key => $student_array) {
            $stmt = $conn->prepare("INSERT INTO student VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?);");
            $stmt->bind_param("ssssssssss", $student_array["studentid"], $student_array["password"], $student_array["firstname"], $student_array["lastname"], 
                $student_array["house"], $student_array["town"], $student_array["county"], $student_array["country"], $student_array["postcode"]);
            $stmt->execute();
            $result = $stmt->get_result();
        }
    }
?>