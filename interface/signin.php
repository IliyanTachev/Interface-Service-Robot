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
                <h3>Login</h3>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
            		<div class="formCheck"></div>
                <form class="form" role="form" autocomplete="off" id="formLogin" action="index.php?cmd=login" method="POST">
                    <div class="form-group">
                        <a href="signup.php" class="float-right">New user?</a>
                        <label for="uname1">Username</label>
                        <input type="text" class="form-control form-control-lg" name="username" id="uname" required="">
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control form-control-lg" name="password" id="pwd" required="" autocomplete="new-password">
                    </div>
                    <div class="form-group py-4">
                        <button class="btn btn-outline-secondary btn-lg" data-dismiss="modal" aria-hidden="true">Cancel</button>
                        <button type="submit" class="btn btn-success btn-lg float-right" id="btnLogin" name="login-btn">Login</button>
                        <input type="hidden" name="submitLogin" value="1">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>