<?php

require './partials/header.php'





?>
        <div>
            <div class="greeting">
                <div><h1>Deposit Funds</h1></div>
                <div class="profile_div"><a href="#" class="profile"><i class="bi bi-person-circle"></i></a></div>
            </div>
            <div class="transfer">
                <div class="balance">
                    <h2>Balance</h2>
                    <h2>$<?=$user_details_record['balance'] ?></h2>
                </div>

                <div class="deposit_info">
                    <form action="">
                    <p>Deposit Amount ($)</p>
                    <input type="tel" required inputmode="numeric">

                    <p>Deposit Method</p>
                    <select name="" id="" required>
                        <option value="">Select Method</option>
                        <option value="">Bank Transfer</option>
                        <option value="">Debit/Credit Card</option>
                        <option value="">Cryptocurrency</option>
                    </select>

                    <a href="#" class="deposit_button">Deposit</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>