<!DOCTYPE html>
<html>
<head>
    <title>Notifications</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg">
                <div class="card-header bg-warning text-white text-center">
                    <h3>Your Notifications</h3>
                </div>
                <div class="card-body">
                    <?php if($notifications->isEmpty()): ?>
                        <p class="text-center text-muted">No notifications.</p>
                    <?php else: ?>
                        <ul class="list-group">
                            <?php $__currentLoopData = $notifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $note): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="list-group-item">
                                    <?php echo e($note->message); ?> <span class="text-muted float-end"><?php echo e($note->created_at); ?></span>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    <?php endif; ?>
                </div>
                <div class="card-footer text-center">
                    <a href="<?php echo e(route('profile')); ?>" class="btn btn-secondary">Back to Profile</a>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/cse470project/resources/views/notifications.blade.php ENDPATH**/ ?>