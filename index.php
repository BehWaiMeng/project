<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>Home Page</title>
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
    <!--navbar-->
    <ul>
        <li><a class="active" href="index.php">Home</a></li>
        <li><a href="product_create.php">Create Product</a></li>
        <li><a href="product_read.php">Read All Product</a></li>
        <li><a href="product_read_one.php">Read One Product</a></li>
        <li><a href="customers_create.php">Create Customers</a></li>
        <li><a href="customer_read.php">Read All Customers</a></li>
        <li><a href="customer_read_one.php">Read One Customers</a></li>
        <li><a href="contact.php">Contact</a></li>
    </ul>
    </nav>
    <main>
        Home Page
    </main>
</body>

</html>