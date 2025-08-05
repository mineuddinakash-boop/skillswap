<h2>Incoming Requests</h2>
<?php $__currentLoopData = $incoming; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $req): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <p><?php echo e($req->fromUser->name); ?> (<?php echo e($req->fromUser->skill); ?>)
        <form method="POST" action="<?php echo e(route('request-action', ['id' => $req->id, 'action' => 'accepted'])); ?>" style="display:inline"><?php echo csrf_field(); ?> <button>Accept</button></form>
        <form method="POST" action="<?php echo e(route('request-action', ['id' => $req->id, 'action' => 'rejected'])); ?>" style="display:inline"><?php echo csrf_field(); ?> <button>Reject</button></form>
    </p>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<h2>Outgoing Requests</h2>
<?php $__currentLoopData = $outgoing; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $req): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <p>To: <?php echo e($req->toUser->name); ?> - Status: <?php echo e($req->status); ?>

        <form method="POST" action="<?php echo e(route('unsend-request', $req->id)); ?>" style="display:inline"><?php echo csrf_field(); ?> <button>Unsend</button></form>
    </p>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/skillswap/resources/views/dashboard.blade.php ENDPATH**/ ?>