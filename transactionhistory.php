<?php

require './partials/header.php'





?>
        <div>
            <div class="greeting">
                <div><h1>Transaction History</h1></div>
                <div class="profile_div"><a href="#" class="profile"><i class="bi bi-person-circle"></i></a></div>
            </div>

                        <div class="table">
                <p>All Transactions</p>
                <div class="table_border">
    <?php if(mysqli_num_rows($user_transactions_all_query) > 0): ?>
                    <table>
                        <tr>
                          <td>Date</td>
                          <td>Description</td>
                          <td class="amount">Amount</td>
                        </tr>

    <?php while($user_t = mysqli_fetch_assoc($user_transactions_all_query)): ?>
                        <tr>
                           <td><?= $user_t['date'] ?></td>
                           <td><?= $user_t['description'] ?></td>
                           <td class="amount">
                            
                           <?php if($user_t['t_type'] == "credit"): ?>

                               <span class="plus">+ $<?= $user_t['amount'] ?> </span>
                        
                            <?php else: ?>

                               <span class="minus"> - $<?= $user_t['amount'] ?> </span>

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
            
        </div>
    </div>
</body>
</html>