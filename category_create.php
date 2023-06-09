<!DOCTYPE HTML>
<html>

<head>
    <title>PDO - Create a Record - PHP CRUD Tutorial</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>

<body>
    <?php
    //check if it login or not
    session_start();
    if (!isset($_SESSION["user"])) {
        $_SESSION["warning"] = "You must be logged in to access this page.";
        header("Location: login.php");
    }
    include 'navbar.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

    <!-- container -->
    <div class="container">
        <div class="page-header">
            <h1>Create Category</h1>
        </div>

        <?php
        if ($_POST) {
            try {
                // include database connection
                include 'config/database.php';

                // posted values
                $category_name = htmlspecialchars(strip_tags($_POST['category_name']));
                $description = htmlspecialchars(strip_tags($_POST['description']));

                if (empty($category_name)) {
                    $category_name_error = "Please fill the category name";
                } else {
                    // check if category already exists
                    $query = "SELECT * FROM categories WHERE category_name = :category_name";
                    $stmt = $con->prepare($query);
                    $stmt->bindParam(':category_name', $category_name);
                    $stmt->execute();


                    // Check the category name already exist or not?
                    if ($stmt->rowCount() > 0) {
                        $category_name_error = "Category name already exists. Please choose a different name.";
                    }
                }

                if (empty($description)) {
                    $description_error = "Please fill the description";
                }

                //check if there are any errors
                if (!isset($category_name_error) && !isset($description_error)) {
                    // insert query
                    $query = "INSERT INTO categories SET category_name=:category_name, description=:description";

                    // prepare query for execution
                    $stmt = $con->prepare($query);

                    // bind the parameters
                    $stmt->bindParam(':category_name', $category_name);
                    $stmt->bindParam(':description', $description);

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
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <table class='table table-hover table-responsive table-bordered'>
                <tr>
                    <td>category_name</td>
                    <td><input type='text' name='category_name' class='form-control' value="<?php echo isset($category_name) ? htmlspecialchars($category_name) : ''; ?>" />
                        <?php if (isset($category_name_error)) { ?><span class="text-danger"><?php echo $category_name_error; ?></span><?php } ?></<td>
                </tr>
                <tr>
                    <td>description</td>
                    <td><input type='text' name='description' class='form-control' value="<?php echo isset($description) ? htmlspecialchars($description) : ''; ?>" />
                        <?php if (isset($description_error)) { ?><span class="text-danger"><?php echo $description_error; ?></span><?php } ?></<td>
                </tr>

                <tr>
                    <td></td>
                    <td>
                        <input type='submit' value='Save' class='btn btn-primary' />
                        <a href='category_read.php' class='btn btn-danger'>Back to read category</a>
                    </td>
                </tr>
            </table>
        </form>

    </div>
    <!-- end .container -->
</body>

</html>