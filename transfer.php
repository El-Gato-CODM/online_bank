<?php

require './partials/header.php'





?>
        <div>
            <div class="greeting">
                <div><h1>Transfer</h1></div>
                <div class="profile_div"><a href="#" class="profile"><i class="bi bi-person-circle"></i></a></div>
            </div>
            <div class="transfer">
                <div class="balance">
                    <h2>Balance</h2>
                    <h2>$<?=$user_details_record['balance'] ?></h2>
                </div>

                <div class="transfer_info">
<?php  if(isset($_SESSION['error_message'])):?>
    <div>
        <p class = "error_message"><?= $_SESSION['error_message']; 
               unset($_SESSION['error_message']);?>
        </p>
    </div>
<?php endif; ?>    
                    <form action="<?php ROOT_URL?>transfer_logic.php" method="post">
                    <p>Recipient Account Number</p>
                    <input type="text" name="account_number">

                    <p>Amount</p>
                    <input type="number" placeholder="$" name="amount" inputmode="numeric" pattern="\s{4}" oninput="this.value = this.value.replace(/[^0-9]/g, '')">

                    <p>Description</p>
                    <input type="text"  name="description">

                    <p>Transaction PIN</p>
                    <input type="text" placeholder="Enter your PIN" name="transaction_pin" inputmode="numeric" minlength="1" maxlength="4" pattern="\d{4}" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 4)">

                    <input type="text" value="<?= $user_details_record['id'] ?>" name="user_id" hidden>

                    <input type="submit" class="transfer_button" value="Transfer" name="transfer">
                </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>