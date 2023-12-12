<?php include_once '../app/views/inc/nav.php'; ?>
    <div class="bg-dark">
        <div class="registration-box d-none">
            <div class="alert alert-success text-white text-center registration-success-message"></div>
        </div>
        <div class="row" style="height: 85vh; background-color: #181a1b; overflow:hidden">
            <div id="div-login-form" class="col-md-6 mx-auto bg-dark mt-5 mb-5 text-white border rounded">
                <h2 class="mt-5">Login</h2>
                <p>Please fill in informations to login.</p>

                <form action="<?php echo URLROOT; ?>/users/login" method="post" class="pb-5 text-white" id="login-form">
                    <div class="form-group">
                        <label for="email">Email: <sup>*</sup></label>
                        <input type="email" name="email" class="form-control form-control-lg bg-dark text-white input-Email">
                        <span class="invalid-feedback email-feedback"></span>
                    </div>
                    <div class="form-group">
                        <label for="password">Password: <sup>*</sup></label>
                        <input type="password" name="password" class="form-control form-control-lg bg-dark text-white input-Pwd">
                        <span class="invalid-feedback password-feedback"></span>
                    </div>
                    <div class="row">
                        <div class="col">
                            <input type="submit" value="Login" class="btn btn-success btn-block">
                        </div>
                        <div class="col">
                            <a href="<?php echo URLROOT; ?>/users/register" class="btn btn-dark btn-block text-white border rounded">No account? Register</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php include_once '../app/views/inc/footer.php'; ?>