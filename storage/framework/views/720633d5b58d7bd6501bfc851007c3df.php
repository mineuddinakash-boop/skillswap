<!DOCTYPE html>
<html>
<head>
    <title>Chat with <?php echo e($chatWith->name); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h4>Chat with <?php echo e($chatWith->name); ?></h4>
    <div class="card shadow mb-3 p-3" style="height:400px; overflow-y:scroll;">
        <?php $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $msg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="mb-2">
                <strong><?php echo e($msg->from_user == session('user')->id ? 'You' : $chatWith->name); ?>:</strong>
                <?php echo e($msg->message); ?>

                <small class="text-muted float-end"><?php echo e($msg->created_at); ?></small>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <form action="<?php echo e(route('chat.send', $chatWith->id)); ?>" method="POST" class="d-flex">
        <?php echo csrf_field(); ?>
        <input type="text" name="message" class="form-control me-2" placeholder="Type a message..." required>
        <button type="submit" class="btn btn-success">Send</button>
    </form>
    <a href="<?php echo e(route('chat.list')); ?>" class="btn btn-secondary mt-3">Back to Users</a>
</div>
</body>
</html>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/cse470project/resources/views/chat.blade.php ENDPATH**/ ?>