<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up Form</title>
</head>
<body>
<form method="post" action="../includes/signup.inc.php">
    <!-- To distinguish from other inputs -->
    <input type="hidden" name="type" value="register">
    <h3 class="text-muted mb-3 pb-3" style="letter-spacing: 1px;">Righter</h3>

    <div class="form-outline mb-4">
        <label class="text-muted" for="form2Example18">Name</label>
        <input type="text" id="form2Example18" class="form-control form-control-lg" name="userName" />
    </div>

    <div class="form-outline mb-4">
        <label class="text-muted" for="form2Example19">Email address</label>
        <input type="email" id="form2Example19" class="form-control form-control-lg" name="userEmail" required/>
    </div>

    <div class="form-outline mb-4">
        <label class="text-muted" for="form2Example20">User Name</label>
        <input type="text" id="form2Example20" class="form-control form-control-lg" name="userId" placeholder="mamba_007" />
    </div>

    <div class="form-outline mb-4">
        <label class="text-muted" for="form2Example21">Password</label>
        <input type="password" id="form2Example21" class="form-control form-control-lg" name="userPwd" />
    </div>

    <div class="form-outline mb-4">
        <label class="text-muted" for="form2Example22">Repeat Password</label>
        <input type="password" id="form2Example22" class="form-control form-control-lg" name="repeatPwd" />
    </div>

    <div class="pt-1 mb-4">
        <button class="btn btn-info btn-lg btn-block" type="submit">Sign Up</button>
    </div>

    <p class="form text-white">have an account? <a href="index.php?action=login" class="link-info">login here</a></p>
</form>
</body>
</html>
<?php
