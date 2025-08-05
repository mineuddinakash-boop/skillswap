<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>
    <h2 style="text-align: center;">Register</h2>
    <form method="POST" action="<?php echo e(route('register.submit')); ?>" style="width: 300px; margin: 0 auto;">
        <?php echo csrf_field(); ?>
        <label>Name:</label><br>
        <input type="text" name="name" required><br><br>

        <label>Phone:</label><br>
        <input type="text" name="phone" required><br><br>

        <label>Email:</label><br>
        <input type="email" name="email" required><br><br>

        <label>Skill:</label><br>
        <input type="text" name="skill" required><br><br>

        <label>Password:</label><br>
        <input type="password" name="password" required><br><br>

        <button type="submit">Done</button>
    </form>
</body>
</html>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/skillswap/resources/views/register.blade.php ENDPATH**/ ?>