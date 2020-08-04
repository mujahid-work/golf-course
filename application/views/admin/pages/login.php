<div class="container">
    <div class="row">
        <div class="col-md-5 mx-auto">
            <div id="first">
                <div class="myform form ">
                    <div class="logo mb-3">
                            <div class="col-md-12 text-center">
                            <h1>Login</h1>
                            </div>

                            <?php
                                if(isset($_SESSION['login_err'])) {
                            ?>
                                    <div class="alert alert-danger"><?php echo $_SESSION['login_err'] ?></div>
                            <?php 
                                }
                            ?>
                    </div>
                    <form action="<?php echo base_url() ?>login/adminLoginValidate" method="post" name="login">
                        <div class="form-group">
                            <label>Email address</label>
                            <input type="email" name="email_field" required  class="form-control" placeholder="Enter email">
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password_field" required class="form-control" placeholder="Enter Password">
                        </div>
                        <div class="col-md-12 text-center ">
                            <button type="submit" name="admin_login" class=" btn btn-block mybtn btn-primary tx-tfm">Login</button>
                        </div>
                        <div class="form-group">
                            <p class="text-center">Forgot Password? <a href="#" id="signup">Reset your password</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>