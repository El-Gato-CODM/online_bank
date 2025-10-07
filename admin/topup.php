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
    <link rel="stylesheet" href="topup_style.css">
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
            </div>

<?php if(isset($_SESSION['top_success'])): ?>
      <div>
            <p>
                <?= $_SESSION['top_success'] ;
                unset($_SESSION['top_success']); ?>
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
                          <td>Balance</td>
                          <td>Options</td>
                        </tr>
<?php while($users = mysqli_fetch_assoc($users_query)):?>
                        <tr>
                            <td><?= $users["id"]; ?></td>
                           <td><?= $users["fullname"]; ?></td>
                           <td><?= $users["email"]; ?></td>
                           <td>$<?= $users["balance"]; ?></td>
                           <td>
                              <a href="topup_logic.php?id=<?= $users['id']?>&value=credit&amn=<?= $users['balance'] ?>" class="deposit_button">Credit</a>
                              <a href="topup_logic.php?id=<?= $users['id']?>&value=debit&amn=<?= $users['balance'] ?>" class="deposit_button">Debit</a>
                           </td>
                        </tr>
<?php endwhile;?>
                </table>
            </div>

        </div>
    </div>
</body>
</html>