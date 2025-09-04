<!DOCTYPE html>
<html>
<head>
    <title>Chat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h3>Users to Chat With</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($u->name); ?></td>
                <td class="d-flex gap-2">
                    <a href="<?php echo e(route('chat.start', $u->id)); ?>" class="btn btn-primary btn-sm">Start Chat</a>
                    <form action="<?php echo e(route('chat.done', $u->id)); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="btn btn-success btn-sm">Done</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
    <a href="<?php echo e(route('profile')); ?>" class="btn btn-secondary">Back to Profile</a>
</div>
</body>
</html><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/cse470project/resources/views/chat-list.blade.php ENDPATH**/ ?>