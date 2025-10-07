<?php 
require './partials/header.php';


?>





        <div>
            <div class="greeting">
                <div><h1>Hi <?= $user_details_record['fullname'] ?></h1></div>
                <div class="profile_div"><a href="#" class="profile"><i class="bi bi-person-circle"></i></a></div>
            </div>

            <div class="transaction_pin">
                

<?php if(isset($_SESSION['error_message'])): ?>
      <div class="error_message">
            <p>
                <?= $_SESSION['error_message'] ;
                unset($_SESSION['error_message']); ?>
            </p>
        </div>
<?php endif; ?>      


<?php if(isset($_SESSION['success_message'])): ?>
      <div class="success_message">
            <p>
                <?= $_SESSION['success_message'] ;
                unset($_SESSION['success_message']); ?>
            </p>
        </div>
<?php endif; ?> 

<?php if($user_details_record['transaction_pin'] == ""): ?>



            <h2>Set Transaction Pin</h2>

            <form action="<?= ROOT_URL?>set_transactionpin_logic.php" method="POST">
                    <p>Enter Transaction Pin</p>
                    <input type="number" class="input" name="transaction_pin">

                    <p>Confirm Transaction Pin</p>
                    <input type="number" class="input" name="confirm_transaction_pin">
                    <input type="text" value="<?= $user_details_record['id']?>" hidden name="user_id">

                    <input type="submit"class="submit_button" name="submit">
                </form>

<?php else: ?>


                <h2>Reset Transaction Pin</h2>


                <form action="<?= ROOT_URL ?>reset_transactionpin_logic.php" method="POST">
                    <p>Enter your Password</p>
                    <input type="password" class="input" name="password">

                    <p>Enter New Transaction Pin</p>
                    <input type="number" class="input" name="transaction_pin">
                

                    <p>Confirm New Transaction Pin</p>
                    <input type="number" class="input" name="confirm_transaction_pin">

                    <input type="text" value="<?= $user_details_record['id']; ?>" name="user_id" hidden>
                    <input type="text" value="<?= $user_details_record['password']; ?>" name="user_password" hidden>

                    <input type="submit"class="submit_button" name="submit">
                </form>

<?php endif; ?>

            </div>
        </div>
    </div>
</body>
</html>