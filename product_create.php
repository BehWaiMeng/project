<!DOCTYPE HTML>
<html>

<head>
    <title>PDO - Create a Record - PHP CRUD Tutorial</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

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
        <li><a class="active" href="http://localhost/PROJECT/index.php">Home</a></li>
        <li><a href="http://localhost/PROJECT/product_create.php">Create Product</a></li>
        <li><a href="http://localhost/PROJECT/product_read.php">Read All Product</a></li>
        <li><a href="http://localhost/PROJECT/product_read_one.php?id=1">Read One Product</a></li>
        <li><a href="http://localhost/PROJECT/customers_create.php">Create Customers</a></li>
        <li><a href="http://localhost/PROJECT/customer_read.php">Read All Customers</a></li>
        <li><a href="http://localhost/PROJECT/customer_read_one.php?username=Jeffbeh111122222">Read One Customers</a></li>
        <li><a href="http://localhost/PROJECT/contact.php">Contact</a></li>
    </ul>



    <!-- Latest compiled and minified Bootstrap CSS (Apply your Bootstrap here -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

    <!-- container -->
    <div class="container">
        <div class="page-header">
            <h1>Create Product</h1>
        </div>
        <?php
        if ($_POST) {
            // include database connection
            include 'config/database.php';
            try {
                // posted values
                $name = htmlspecialchars(strip_tags($_POST['name']));
                $description = htmlspecialchars(strip_tags($_POST['description']));
                $price = htmlspecialchars(strip_tags($_POST['price']));
                $promotion_price = isset($_POST['promotion_price']) ? htmlspecialchars(strip_tags($_POST['promotion_price'])) : null;
                $manufacture_date = htmlspecialchars(strip_tags($_POST['manufacture_date']));
                $expired_date = isset($_POST['expired_date']) ? htmlspecialchars(strip_tags($_POST['expired_date'])) : null;

                //check if any field is empty
                if (empty($name)) {
                    $name_error = "Please enter product name";
                }
                if (empty($description)) {
                    $description_error = "Please enter product description";
                }
                if (empty($price)) {
                    $price_error = "Please enter product price";
                }
                if (!empty($promotion_price) && $promotion_price >= $price) {
                    $promotion_price_error = "Promotion price must be cheaper than original price";
                }
                if (empty($manufacture_date)) {
                    $manufacture_date_error = "Please enter manufacture_date";
                }
                //check if expired date is later than manufacture date
                if (!empty($expired_date) && strtotime($expired_date) <= strtotime($manufacture_date)) {
                    $expired_date_error = "Expired date should be later than manufacture date";
                }


                //check if there are any errors
                if (!isset($name_error) && !isset($description_error) && !isset($price_error) && !isset($promotion_price_error) && !isset($manufacture_date_error) && !isset($expired_date_error)) {




                    // insert query
                    $query = "INSERT INTO products SET name=:name, description=:description, price=:price, promotion_price=:promotion_price, manufacture_date=:manufacture_date, expired_date=:expired_date , created=:created";

                    // prepare query for execution
                    $stmt = $con->prepare($query);

                    // bind the parameters
                    $stmt->bindParam(':name', $name);
                    $stmt->bindParam(':description', $description);
                    $stmt->bindParam(':price', $price);
                    $stmt->bindParam(':promotion_price', $promotion_price);
                    $stmt->bindParam(':manufacture_date', $manufacture_date);
                    $stmt->bindParam(':expired_date', $expired_date);

                    // specify when this record was inserted to the database
                    $created = date('Y-m-d H:i:s');
                    $stmt->bindParam(':created', $created);

                    // Execute the query
                    if ($stmt->execute()) {
                        echo "<div class='alert alert-success'>Record was saved.</div>";
                    } else {
                        echo "<div class='alert alert-danger'>Unable to save record.</div>";
                    }
                } else {
                    echo "<div class='alert alert-danger'>Please fill up all the empty place.</div>";
                }
            }
            // show error
            catch (PDOException $exception) {
                die('ERROR: ' . $exception->getMessage());
            }
        }
        ?>



        <!-- html form here where the product information will be entered -->
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <table class='table table-hover table-responsive table-bordered'>
                <tr>
                    <td>Name</td>
                    <td><input type="varchar" name="name" class="form-control" value="<?php echo isset($name) ? htmlspecialchars($name) : ''; ?>" />
                        <?php if (isset($name_error)) { ?><span class="text-danger"><?php echo $name_error; ?></span><?php } ?></<td>
                </tr>

                <tr>
                    <td>Description</td>
                    <td><textarea name="description" class="form-control"><?php echo isset($description) ? htmlspecialchars($description) : ''; ?></textarea>
                        <?php if (isset($description_error)) { ?><span class="text-danger"><?php echo $description_error; ?></span><?php } ?></<td>
                </tr>
                <tr>
                    <td>Price</td>
                    <td><input type="double" name='price' class='form-control' value="<?php echo isset($price) ? htmlspecialchars($price) : ''; ?>" />
                        <?php if (isset($price_error)) { ?><span class="text-danger"><?php echo $price_error; ?></span><?php } ?></<td>
                </tr>
                <tr>
                    <td>promotion_price</td>
                    <td><input type='double' name='promotion_price' class='form-control' value="<?php echo isset($promotion_price) ? htmlspecialchars($promotion_price) : ''; ?>" />
                        <?php if (isset($promotion_price_error)) { ?><span class="text-danger"><?php echo $promotion_price_error; ?></span><?php } ?></<td>
                </tr>
                <tr>
                    <td>manufacture_date</td>
                    <td><input type='date' name='manufacture_date' class='form-control' value="<?php echo isset($manufacture_date) ? htmlspecialchars($manufacture_date) : ''; ?>" />
                        <?php if (isset($manufacture_date_error)) { ?><span class="text-danger"><?php echo $manufacture_date_error; ?></span><?php } ?></<td>
                </tr>
                <tr>
                    <td>expired_date</td>
                    <td><input type='date' name='expired_date' class='form-control' value="<?php echo isset($expired_date) ? htmlspecialchars($expired_date) : ''; ?>" />
                        <?php if (isset($expired_date_error)) { ?><span class="text-danger"><?php echo $expired_date_error; ?></span><?php } ?></<td>
                </tr>
                <tr>


                    <td></td>
                    <td>
                        <input type='submit' value='Save' class='btn btn-primary' />
                        <a href='index.php' class='btn btn-danger'>Back to read products</a>
                    </td>
                </tr>
            </table>
        </form>

    </div>
    <!-- end .container -->









</body>

</html>