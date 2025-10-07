<?php

require './partials/header.php'





?>
        <div>
            <div class="greeting">
                <div><h1>Hi, <?= $user_details_record['fullname'] ?></h1></div>
                <div class="profile_div"><a href="#" class="profile"><i class="bi bi-person-circle"></i></a></div>
            </div>
<?php if($user_details_record['account_status'] == 'frozen'):?>
            <div>
                <p>Your Account is Frozen, Contact us to restore your account</p>
            </div>
<?php endif;?>
            <div class="balance">
                <div>
                    <p>Your Balance</p>
                    <h1>$<?= $user_details_record['balance']?></h1>
                </div>
                <div>
                    <p>Quick Actions</p>
<?php if($user_details_record['account_status'] == 'frozen'):?>
                    <a href="#" class="disabled_buttons">Transfer</a>
                    <a href="#" class="disabled_buttons">Deposit</a>
<?php else:?>
                    <a href="<?= ROOT_URL?>transfer.php" class="buttons">Transfer</a>
                    <a href="<?= ROOT_URL?>deposit.php" class="buttons">Deposit</a>
<?php endif;?>
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