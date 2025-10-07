<?php
require '../config/database.php';

$users_sql = "SELECT * FROM users WHERE account_status = 'frozen'";
$users_query = mysqli_query($conn, $users_sql);
// $users = mysqli_fetch_assoc($users_query);



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="manage_users_style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>
<body>
    <div class="main">
        <div class="menu">
            <div>
                <h2>Orbix Bank</h2>
            </div>
            <div>
                <ul>
                    <li><a href="admin_home.php"><div class="icon"><i class="bi bi-house-fill"></i></div> Dashboard</a></li>
                    <li><a href="topup.php"><div class="icon"><i class="bi bi-person"></i></div> Top up</a></li>
                    <li><a href="manage_users.php"><div class="icon"><i class="bi bi-person"></i></div> Manage Users</a></li>
                    <li><a href="#"><div class="icon"><i class="bi bi-clock-history"></i></div> Transactions</a></li>
                    <li><a href="kyc_request.php"><div class="icon"><i class="bi bi-person-check"></i></div> KYC Requests</a></li>
                    <li><a href="#"><div class="icon"><i class="bi bi-lock-fill"></i></div> Logout</a></li>
                </ul>
            </div>
        </div>
        <div class="body">
            <div class="greeting">
                <div><h1>Welcome Admin</h1></div>
                <div>
                    <a href="<?= ROOT_URL?>admin/manage_users.php" class="options">Back</a>
                </div>
            </div>

<?php  if(isset($_SESSION['unfreeze_message'])):?>
    <div class="unfreeze_message">
        <p><?= $_SESSION['unfreeze_message']; 
                unset($_SESSION['unfreeze_message']);?>
        </p>
    </div>
<?php endif; ?>


            <div class="table">
                <div class="table_border">
                        <table>
                            <tr>
                                <td>ID</td>
                                <td>Name</td>
                                <td>Email</td>
                                <td>Options</td>
                            </tr>
<?php while($users = mysqli_fetch_assoc($users_query)):?>
                            <form action="<?= ROOT_URL?>admin/frozen_account_logic.php" method="POST">
                            <tr>
                                <td><?= $users["id"]; ?> <input type="text" value="<?= $users["id"]?>" name="user_id" hidden></td>
                                <td><?= $users["fullname"]; ?></td>
                                <td><?= $users["email"]; ?></td>
                                <td>
                                    <input type="submit" class="unfreeze" value="UnFreeze" name="unfreeze">
                                </td>
                                </td>
                            </tr>
                            </form>           
<?php endwhile;?>

                            

                        </table>
            </div>

        </div>
    </div>

</body>
</html>