<?php
require '../config/database.php';

$users_sql = "SELECT * FROM users";
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
    <link rel="stylesheet" href="../bootstrap-5.3.8-dist/css/bootstrap.min.css">
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
                    <a href="<?= ROOT_URL?>admin/frozen_accounts.php" class="options">Frozen Accounts</a>
                </div>
            </div>

<?php  if(isset($_SESSION['success_message'])):?>
    <div class="success_message">
        <p><?= $_SESSION['success_message']; 
                unset($_SESSION['success_message']);?>
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
                            <form action="<?= ROOT_URL?>admin/manage_users_logic.php" method="POST">

                            <tr>
                                <input type="text" value="<?= $users["id"]?>" name="user_id" hidden>
                                <td><?= $users["id"]; ?></td>
                                <td><?= $users["fullname"]; ?></td>
                                <td><?= $users["email"]; ?></td>
                                <?php if($users['account_status'] == 'frozen'):?>
                                    <td>
                                        <input type="submit" class="frozen" value="Frozen" disabled>
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#<?= $users["id"]?>"> Delete User </button>
                                    </td>
                                <?php else:?>
                                <td>
                                    <input type="submit" class="freeze" value="Freeze" name="freeze">
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#<?= $users["id"]?>"> Delete User </button>
                                </td>
                                <?php endif;?>

                                
                            
                                <!-- Modal -->
                                <div class="modal fade" id="<?= $users["id"]?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Are you sure you want to delete this user?</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body red">
                                        Once a user is deleted, user record can never be restored.
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <a href="<?= ROOT_URL?>admin/manage_users_logic.php?id=<?=$users['id']?>" class="btn btn-primary">Delete</a>
                                    </div>
                                    </div>
                                </div>
                                </div>
                        
                            </tr>




                            </form>           
<?php endwhile;?>



                            

                        </table>
            </div>

        </div>
    </div>

    <script src="../bootstrap-5.3.8-dist/js/bootstrap.min.js"></script>
</body>
</html>