<!DOCTYPE HTML>
<html>

<head>
    <title>PDO - Read One Record - PHP CRUD Tutorial</title>
    <!-- Latest compiled and minified Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <style>
        ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            overflow: hidden;
            background-color: #333;
        }

        li {
            float: left;
        }

        li a {
            display: block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        li a:hover {
            background-color: #111;
        }
    </style>
</head>

<body>

    <ul>
        <li><a class="active" href="index.php">Home</a></li>
        <li><a href="product_create.php">Create Product</a></li>
        <li><a href="product_read.php">Read All Product</a></li>
        <li><a href="customers_create.php">Create Customers</a></li>
        <li><a href="customer_read.php">Read All Customers</a></li>
        <li><a href="contact.php">Contact</a></li>
    </ul>
    <!-- container -->
    <div class="container">
        <div class="page-header">
            <h1>Read Customers</h1>
        </div>

        <!-- PHP read one record will be here -->
        <?php


        // get passed parameter value, in this case, the record ID
        // isset() is a PHP function used to verify if a value is there or not
        $username = isset($POST['username']) ? $POST['username'] : die('ERROR: Record Username not found.');

        //include database connection
        include 'config/database.php';


        // read current record's data
        try {
            // prepare select query
            $query = "SELECT * FROM customers WHERE username =? LIMIT 0,1";
            $stmt = $con->prepare($query);

            // this is the first question mark
            $stmt->bindParam(1, $username);

            // execute our query
            $stmt->execute();

            // store retrieved row to a variable
            $row = $stmt->fetch(PDO::FETCH_ASSOC);


            if (!$row) {
                die('ERROR: Record not found.');
            }

            // values to fill up our form
            $username = $row['username'];
            $Password = $row['Password'];
            $fname = $row['fname'];
            $lname = $row['lname'];
            $gender = $row['gender'];
            $dob = $row['dob'];
            $status = $row['status'];
        }

        // show error
        catch (PDOException $exception) {
            die('ERROR: ' . $exception->getMessage());
        }
        ?>



        <!-- HTML read one record table will be here -->
        <!--we have our html table here where the record will be displayed-->
        <table class='table table-hover table-responsive table-bordered'>
            <tr>
                <td>username</td>
                <td><?php echo htmlspecialchars($username, ENT_QUOTES);  ?></td>
            </tr>
            <tr>
                <td>Password</td>
                <td><?php echo htmlspecialchars($Password, ENT_QUOTES);  ?></td>
            </tr>
            <tr>
                <td>fname</td>
                <td><?php echo htmlspecialchars($fname, ENT_QUOTES);  ?></td>
            </tr>
            <tr>
                <td>lname</td>
                <td><?php echo htmlspecialchars($lname, ENT_QUOTES);  ?></td>
            </tr>
            <tr>
                <td>gender</td>
                <td><?php echo htmlspecialchars($gender, ENT_QUOTES);  ?></td>
            </tr>
            <tr>
                <td>dob</td>
                <td><?php echo htmlspecialchars($dob, ENT_QUOTES);  ?></td>
            </tr>
            <tr>
                <td>status</td>
                <td><?php echo htmlspecialchars($status, ENT_QUOTES);  ?></td>
            </tr>



            <tr>
                <td></td>
                <td>
                    <a href='index.php' class='btn btn-danger'>Back to read products</a>
                </td>
            </tr>
        </table>



    </div> <!-- end .container -->

</body>

</html>