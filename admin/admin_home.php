<?php
require '../config/database.php';


//Fetching Users transactions
$user_transactions_sql = "SELECT * FROM transactions ORDER BY id DESC LIMIT 4 ";
$user_transactions_query = mysqli_query($conn, $user_transactions_sql);




?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="admin_home_style.css">
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

            <div class="users">
                <div class="total_users">
                    <p>Total Users</p>
                    <h2>1,243</h2>
                </div>
                <div class="total_deposits">
                    <p>Total Deposits</p>
                    <h2>$250,000</h2>
                </div>
                <div class="pending_kyc">
                    <p>Pending KYC</p>
                    <h2>47</h2>
                </div>
            </div>

            <div class="table">
                <p>Recent Transactions</p>
                <div class="table_border">
                    
                <?php if(mysqli_num_rows($user_transactions_query) > 0): ?>
                    <table>
                        <tr>
                          <td>Date</td>
                          <td>Description</td>
                          <td class="amount">Amount</td>
                        </tr>

    <?php while($user_t = mysqli_fetch_assoc($user_transactions_query)): ?>
                        <tr>
                           <td><?= $user_t['date'] ?></td>
                           <td><?= $user_t['description'] ?></td>
                           <td class="amount">
                            
                           <?php if($user_t['t_type'] == "credit"): ?>

                               <span class="plus">+ $<?= $user_t['amount'] ?> </span>
                        
                            <?php else: ?>

                                <span class="minus">- $<?= $user_t['amount'] ?> </span>

                             <?php endif ; ?>
                            </td>
                        </tr>
    <?php endwhile; ?>
                </table>
    <?php else: ?>
        <div>
            <p>You dont have any transactions yet</p>
        </div>

    <?php endif; ?>
            </div>


        </div>
    </div>
</body>
</html>