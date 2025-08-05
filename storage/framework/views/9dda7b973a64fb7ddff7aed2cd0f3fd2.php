<!DOCTYPE html>
<html>
<head>
    <title>Profile</title>
</head>
<body>
    
    
    <?php use Illuminate\Support\Facades\Auth; ?>

    <form method="POST" action="<?php echo e(route('logout')); ?>" style="text-align:right; margin: 10px;">
        <?php echo csrf_field(); ?>
        <button type="submit">Logout</button>
    </form>
    
    <form method="POST" action="<?php echo e(route('search')); ?>" style="text-align:center; margin-top: 20px;">
        <?php echo csrf_field(); ?>
        <input type="text" name="skill" placeholder="Search by skill" required>
        <button type="submit">Search</button>
    </form>


    <h2 style="text-align:center;">Welcome, <?php echo e(Auth::user()->name); ?></h2>
    <p style="text-align:center;">Email: <?php echo e(Auth::user()->email); ?></p>
    <p style="text-align:center;">Phone: <?php echo e(Auth::user()->phone); ?></p>
    <p style="text-align:center;">Skill: <?php echo e(Auth::user()->skill); ?></p>

    <div style="text-align:center; margin-top: 20px;">
        <a href="<?php echo e(route('profile.edit')); ?>">
            <button>Edit Profile</button>
        </a>
        <a href="<?php echo e(route('skills')); ?>">
            <button>View Available Skills</button>
        </a>
        <a href="<?php echo e(route('dashboard')); ?>">
            <button>Dashboard</button>
        </a>
        <a href="<?php echo e(route('chat')); ?>">
            <button>Chat</button>
        </a>
    </div>
    
</body>
</html><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/skillswap/resources/views/profile.blade.php ENDPATH**/ ?>