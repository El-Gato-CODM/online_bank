<?php

require './partials/header.php'





?>
        <div>
            <div class="greeting">
                <div><h1>KYC Verification</h1></div>
                <div class="profile_div"><a href="#" class="profile"><i class="bi bi-person-circle"></i></a></div>
            </div>

            <div>
                <p>Please Upload your document to verify your account.</p>

<?php  if(isset($_SESSION['error_message'])):?>
    <div class="error_message">
        <p><?= $_SESSION['error_message']; 
               unset($_SESSION['error_message']);?>
        </p>
    </div>
<?php endif; ?>    


<?php  if(isset($_SESSION['success_message'])):?>
    <div class="success_message">
        <p><?= $_SESSION['success_message']; 
               unset($_SESSION['success_message']);?>
        </p>
    </div>
<?php endif; ?>



<?php if($user_details_record['kyc_status'] == 'pending'):?>

                <p class="success_message">KYC request submitted successfully</p>
                
                <div class="kyc_info">
                    <form action="<?= ROOT_URL?>kyc_logic.php" method="POST"  enctype="multipart/form-data">
                    <p>Full Name</p>
                    <input type="text" class="kyc_input" value="<?= $user_details_record['fullname'] ?>" name="fullname" disabled>

                    <p>Date of Birth</p>
                    <input type="text" placeholder="DD/MM/YY" class="kyc_input" maxlength="15" name="dob" required disabled>

                    <p>Address</p>
                    <input type="text" class="kyc_input" name="address" required placeholder='House number, town and city' disabled>

                    <p>
                        ID card upload
                        <input type="file" name="id_card" required disabled>
                    </p>

                    <p>
                        Proof of Address upload
                        <input type="file" name="poa"  required disabled>
                    </p>

                    <div>
                      <input type="submit" name="submit" value="Submit For Verification" class="submit_button" disabled>
                    </div>

                    <input type="text" value="<?= $user_details_record['id'] ?>" hidden name="user_id">
                    </form>
                </div>



        <?php elseif($user_details_record['kyc_status'] == 'approved'):?>


                <p class="success_message">Congratulations, KYC Verified</p>

                <div class="kyc_info">
                    <form action="<?= ROOT_URL?>kyc_logic.php" method="POST"  enctype="multipart/form-data">
                    <p>Full Name</p>
                    <input type="text" class="kyc_input" value="<?= $user_details_record['fullname'] ?>" name="fullname" disabled>

                    <p>Date of Birth</p>
                    <input type="text" placeholder="DD/MM/YY" class="kyc_input" maxlength="15" name="dob" required disabled>

                    <p>Address</p>
                    <input type="text" class="kyc_input" name="address" required placeholder='House number, town and city' disabled>

                    <p>
                        ID card upload
                        <input type="file" name="id_card" required disabled>
                    </p>

                    <p>
                        Proof of Address upload
                        <input type="file" name="poa"  required disabled>
                    </p>

                    <div>
                      <input type="submit" name="submit" value="Submit For Verification" class="submit_button" disabled>
                    </div>

                    <input type="text" value="<?= $user_details_record['id'] ?>" hidden name="user_id">
                    </form>
                </div>


            <?php else: ?>


                <div class="kyc_info">
                    <form action="<?= ROOT_URL?>kyc_logic.php" method="POST"  enctype="multipart/form-data">
                    <p>Full Name</p>
                    <input type="text" class="kyc_input" value="<?= $user_details_record['fullname'] ?>" name="fullname" readonly>

                    <p>Date of Birth</p>
                    <input type="text" placeholder="DD/MM/YY" class="kyc_input" maxlength="15" name="dob" required>

                    <p>Address</p>
                    <input type="text" class="kyc_input" name="address" required placeholder='House number, town and city'>

                    <p>
                        ID card upload
                        <input type="file" name="id_card" required>
                    </p>

                    <p>
                        Proof of Address upload
                        <input type="file" name="poa"  required>
                    </p>

                    <div>
                      <input type="submit" name="submit" value="Submit For Verification" class="submit_button">
                    </div>

                    <input type="text" value="<?= $user_details_record['id'] ?>" hidden name="user_id">
                    </form>
            
                </div>


        <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>