<!DOCTYPE html>
<html>
<head>
    <title>Search Results</title>
</head>
<body>
    <h2 style="text-align:center;">Search Results</h2>

    <?php if($results->isEmpty()): ?>
        <p style="text-align:center;">No users found with that skill.</p>
    <?php else: ?>
        <table border="1" style="margin: 0 auto; text-align: center;">
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Skill</th>
                <th>Action</th>
            </tr>
            <?php $__currentLoopData = $results; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($user->name); ?></td>
                    <td><?php echo e($user->email); ?></td>
                    <td><?php echo e($user->phone); ?></td>
                    <td><?php echo e($user->skill); ?></td>
                    <td>
                        <form method="POST" action="<?php echo e(route('send-request', ['toUserId' => $user->id])); ?>">
                            <?php echo csrf_field(); ?>
                            <button type="submit">Add</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </table>
    <?php endif; ?>

    <div style="text-align:center; margin-top: 20px;">
        <a href="<?php echo e(route('profile')); ?>"><button>Back to Profile</button></a>
    </div>
</body>
</html><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/skillswap/resources/views/search-results.blade.php ENDPATH**/ ?>