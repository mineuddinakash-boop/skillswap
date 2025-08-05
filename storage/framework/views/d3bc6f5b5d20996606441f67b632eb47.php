<?php use Illuminate\Support\Facades\Auth; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Profile</title>
</head>
<body>
    <h2 style="text-align:center;">Edit Profile</h2>
    <form method="POST" action="<?php echo e(route('profile.update')); ?>" style="width: 300px; margin: 0 auto;">
        <?php echo csrf_field(); ?>

        <label>Name:</label><br>
        <input type="text" name="name" value="<?php echo e($user->name); ?>" required><br><br>

        <label>Phone:</label><br>
        <input type="text" name="phone" value="<?php echo e($user->phone); ?>" required><br><br>

        <label>Email:</label><br>
        <input type="email" name="email" value="<?php echo e($user->email); ?>" required><br><br>

        <label>Skill:</label><br>
        <input type="text" name="skill" value="<?php echo e($user->skill); ?>" required><br><br>

        <button type="submit">Update</button>
    </form>
</body>
</html>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/skillswap/resources/views/edit-profile.blade.php ENDPATH**/ ?>