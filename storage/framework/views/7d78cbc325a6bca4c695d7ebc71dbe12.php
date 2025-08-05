<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h2 style="text-align:center;">Sign In</h2>
    <form method="POST" action="<?php echo e(route('login.submit')); ?>" style="width: 300px; margin: 0 auto;">
        <?php echo csrf_field(); ?>

        <?php if($errors->any()): ?>
            <div style="color: red;">
                <?php echo e($errors->first()); ?>

            </div>
        <?php endif; ?>

        <label>Email:</label><br>
        <input type="email" name="email" required><br><br>

        <label>Password:</label><br>
        <input type="password" name="password" required><br><br>

        <button type="submit">Login</button>
    </form>
</body>
</html>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/skillswap/resources/views/login.blade.php ENDPATH**/ ?>