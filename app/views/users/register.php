<?php include_once '../app/views/inc/nav.php'; ?>
    <div class="row" style="height: 85vh; background-color: #181a1b">
        <div class="col-md-5 mx-auto d-flex mb-5">
            <div id="sub-register-form" class="card card-body bg-dark text-white mt-5" style="width: 300%">
                <h2>Create An Account</h2>
                <p>Please fill out this form to register with us</p>
                <form action="<? print URLROOT; ?>/users/register" id="register-form">
                    <div class="form-group">
                        <label for="name">Name: <sup>*</sup></label>
                        <input type="text" name="name" class="form-control form-control-lg bg-dark text-white input-Name">
                        <span class="invalid-feedback username-feedback"></span>
                    </div>
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
                    <div class="form-group">
                        <label for="confirm_password">Confirm Password: <sup>*</sup></label>
                        <input type="password" name="confirm_password" class="form-control form-control-lg bg-dark text-white inputConfirm-Pwd">
                        <span class="invalid-feedback confirm-password-feedback"></span>
                    </div>
                    <div class="row">
                        <div class="col">
                            <input type="submit" value="Register" class="btn btn-success btn-block">
                        </div>
                        <div class="col">
                            <a href="<?php echo URLROOT; ?>/users/login" class="btn btn-light btn-block bg-dark text-white border rounded">Have an account? Login</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include_once '../app/views/inc/footer.php'; ?>