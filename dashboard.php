<?php

require './partials/header.php'





?>
        <div>
            <div class="greeting">
                <div><h1>Hi, <?= $user_details_record['fullname'] ?></h1></div>
                <div class="profile_div"><a href="#" class="profile"><i class="bi bi-person-circle"></i></a></div>
            </div>
            <div class="balance">
                <div>
                    <p>Your Balance</p>
                    <h1>$<?= $user_details_record['balance']?></h1>
                </div>
                <div>
                    <p>Quick Actions</p>
                    <a href="transfer.php" class="buttons">Transfer</a>
                    <a href="deposit.php" class="buttons">Deposit</a>
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