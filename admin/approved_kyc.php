<?php
require '../config/database.php';

//Fetching all KYC request from Our Database

$approved_kyc_sql = "SELECT * FROM approved_kyc";
$approved_kyc_sql_query = mysqli_query($conn, $approved_kyc_sql);



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="kyc_request_style.css">
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
                <div><h1>KYC Requests</h1></div>
                <div>
                    <a href="<?= ROOT_URL?>admin/kyc_request.php" class="buttons">Pending Requests</a>
                    <a href="<?= ROOT_URL?>admin/approved_kyc.php" class="buttons">Approved Requests</a>
                    <a href="<?= ROOT_URL?>admin/declined_kyc.php" class="buttons">Declined Requests</a>
                </div>
            </div>



            <div class="table">
                <div class="table_border">
                    <table>
                        <tr>
                          <td>ID</td>
                          <td>Name</td>
                          <td>Date of Birth</td>
                          <td>Address</td>
                          <td>ID Card</td>
                          <td>Proof of Address</td>
                        </tr>


<?php while($approved_kyc = mysqli_fetch_assoc($approved_kyc_sql_query)):?>
                        <form action="<?= ROOT_URL?>admin/kyc_request_logic.php" method="POST">
                            <tr>
                                <td><?= $approved_kyc['user_id']?> <input type="text" value="<?= $approved_kyc['user_id']?>" name="user_id" hidden></td>
                                <td><?= $approved_kyc['fullname']?> <input type="text" value="<?= $approved_kyc['fullname']?>" name="fullname" hidden></td>
                                <td><?= $approved_kyc['dob']?> <input type="text" value="<?= $approved_kyc['dob']?>" name="dob" hidden></td>
                                <td><?= $approved_kyc['address']?> <input type="text" value="<?= $approved_kyc['address']?>" name="address" hidden></td>
                                <td class="id_card">
                                    <img src="../uploads/<?= $approved_kyc['id_card']?>" alt="" width="100px">
                                    <a href="../uploads/<?= $approved_kyc['id_card']?>" class="download" download="../uploads/<?= $approved_kyc['id_card']?>">Download</a>
                                    <input type="text" value="<?= $approved_kyc['id_card']?>" name="id_card" hidden>

                                </td>
                                <td class="poa">
                                    <p><?= $approved_kyc['poa']?></p>
                                    <a href="../uploads/<?= $approved_kyc['poa']?>" class="download" download="../uploads/<?= $approved_kyc['poa']?>">Download</a>
                                    <input type="text" value="<?= $approved_kyc['poa']?>" name="poa" hidden>
                                </td>
                            </tr>
                        </from>    
<?php endwhile; ?>
                    </table>
            </div>


        </div>
    </div>
</body>
</html>