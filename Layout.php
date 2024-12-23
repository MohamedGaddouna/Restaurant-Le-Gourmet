<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Web Application</title>
    <!-- Link to the CSS file -->
    <link rel="stylesheet" href="./../../../phpProject/public/css/common.css">
    <style>
        .center {
            display: flex;
            justify-content: center;
            /* Horizontally center */
            align-items: center;
            /* Vertically center */
            height: 100vh;
            /* Full viewport height */
            margin: 0;
            /* Remove default margin */
            background-color: #f5f5f5;
        }

        .container {
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
            padding: 10px 20px;
            transition: transform 0.2s;
            width: 500px;
            text-align: center;
        }

        .container label {
            display: block;
            width: 100%;
            margin-top: 10px;
            margin-bottom: 5px;
            text-align: left;
            color: #555;
            font-weight: bold;
        }

        .container button {
            padding: 15px;
            border-radius: 10px;
            margin-top: 15px;
            margin-bottom: 15px;
            border: none;
            color: white;
            cursor: pointer;
            background-color: #308acf;
            width: 100%;
            font-size: 16px;
        }

        .container span {
            color: #ff4d4f;
            font-size: 0.9rem;
            font-weight: bold;
            margin-top: 5px;
            display: block;
        }

        .inputField {
            display: block;
            width: 100%;
            margin-bottom: 15px;
            padding: 10px;
            box-sizing: border-box;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
    </style>
</head>

<body>
    <header>
        <nav>
            <ul>
                <li><a href="/phpProject/public/add-item">Add Item</a></li>
                <li><a href="/phpProject/public/delete-item">Delete Item</a></li>
                <li><a href="/phpProject/public/add-user">Add User</a></li>
                <li><a href="/phpProject/public/delete-user">Delete User</a></li>
                <li><a href="http://localhost/phpProject/public/">Home</a></li>
            </ul>
        </nav>

    </header>
    <main class="center">
        <!-- Dynamically include specific views here -->
        <?php include $view; ?>
    </main>

    <footer>
        <p> Restaurant Le Gourmet</p>
    </footer>

</body>

</html>