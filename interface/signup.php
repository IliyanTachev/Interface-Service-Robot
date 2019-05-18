<?php
	include 'head.php';
	//include 'navbar-top.php';
	//include 'nav-side-menu.php'; 
?>

<body style="padding: 0;">

<div id="loginModal" tabindex="-1" role="dialog" aria-hidden="true" class="login-register-dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Register</h3>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form class="form" role="form" autocomplete="off" id="formRegister" action="register.php" method="POST">
                     <div class="form-group">
                        <a href="signin.php" class="float-right">Already have an account?</a>
                        <label for="user_names">Names</label>
                        <input type="text" class="form-control form-control-lg" name="user-names" id="user-names" required="" >
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control form-control-lg" name="username" id="username" required="" >
                        <div class="invalid-feedback">Oops, you missed this one.</div>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control form-control-lg" name="password" id="signup_pass" required="" autocomplete="new-password">
                        <div class="invalid-feedback">Enter your password too!</div>
                    </div>
                    <div class="form-group">
                        <label>Confirm Password</label>
                        <input type="password" class="form-control form-control-lg" name="pass_confirm" id="signup_pass_confirm" required="" autocomplete="new-password">
                        <div class="invalid-feedback">Confirm your password too!</div>
                    </div>
                    <div class="form-group py-4">
                        <button class="btn btn-outline-secondary btn-lg" data-dismiss="modal" aria-hidden="true">Cancel</button>
                        <button type="submit" class="btn btn-success btn-lg float-right" id="btnRegister">Register</button>
                        <input type="hidden" name="submitReg" value="1">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>