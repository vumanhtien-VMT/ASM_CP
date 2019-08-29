<?php 
require_once './connect.php';  
if(isset($_POST["aduser"]) && isset($_POST["adpass"]))
{
	$user = $_POST["aduser"];
	$pass = $_POST["adpass"];
	$sql ="SELECT * FROM account WHERE username = '$user' AND pwd= '$pass'";
	$rows = pg_query($sql);
	if(pg_num_rows($rows)==1) { ?>
		<script>
            alert("Login successfully!!");
        </script>
    <?php
    } else { 
        ?>
            <script>
                alert("Wrong Username/Password");
                window.location.href = "/index.php";
            </script>
        <?php }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="add.css">
    <title>Document</title>
</head>

<body>
    <div class="dau">
        <h1 class="ts">TOYS SHOP</h1>
        <div class="lo">
            <button><a href="index.php">Logout</a></button>
        </div>
        <div class="menu"></div>
    </div>
    <div class="than">
        <div class="table">
            <table class="br">
                <h1>Managing Product</h1>
                <tr>
                    <th class="tet">ID</th>
                    <th class="tet">Name</th>
                    <th class="tet">Price ($)</th>
                    <th class="tet">Description</th>
                    <th class="tet">Editing</th>
                </tr>

                <?php
                require_once './database.php';
                $sql = "SELECT * FROM product";
                $stmt = $pdo->prepare($sql);
                foreach ($pdo->query($sql) as $row) {
                ?>
                    <tr>
                        <td class="info"><?php echo $row['productid']?></td> 
                        <td class="info"><?php echo $row['proname']?></td> 
                        <td class="info"><?php echo $row['price']?></td> 
                        <td class="info"><?php echo $row['descrip']?></td> 
                        <td class="info">
                            <form action='/delete.php' method="POST">
                                <input type='hidden' name='productid' value='<?php echo $row['productid']?>'>
                                <input class="edit-btn" type='submit' value='Delete'>
                            </form> <br>

                            <form action="/update.php" method="POST">
                                <input type='hidden' name='productid' value='<?php echo $row['productid']?>'>
                                <input type='hidden' name='name' value='<?php echo $row['proname']?>'>
                                <input type='hidden' name='price' value='<?php echo $row['price']?>'>
                                <input type='hidden' name='descrip' value='<?php echo $row['descrip']?>'>
                                <input class="edit-btn" type='submit' value='Update'>
                            </form>
                        </td>
                    </tr>
                <?php
                }
                ?> 
            </table>
        </div>
        <button><a href="/add.php">Add Product</a></button>
        <br><br>
    </div>
    <div class="wrapper">
        <div></div>
        <div></div>
        <div></div>
    </div>
</body>

</html>