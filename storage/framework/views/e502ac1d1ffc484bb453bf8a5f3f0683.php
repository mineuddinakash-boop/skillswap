<!DOCTYPE html>
<html>
<head>
    <title>Incoming Swap Requests</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-lg">
                <div class="card-header bg-primary text-white text-center">
                    <h3>Incoming Swap Requests</h3>
                </div>
                <div class="card-body">
                    <?php if($requests->isEmpty()): ?>
                        <p class="text-center text-muted">No incoming requests.</p>
                    <?php else: ?>
                        <table class="table table-bordered table-striped">
                            <thead class="table-light">
                                <tr>
                                    <th>Name</th>
                                    <th>Skill Have</th>
                                    <th>Source</th>
                                    <th>Skill Want</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $requests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $req): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($req->requester_name); ?></td>
                                    <td><?php echo e($req->skill_have); ?></td>
                                    <td><?php echo e($req->skill_source); ?></td>
                                    <td><?php echo e($req->skill_want); ?></td>
                                    <td class="d-flex gap-2">
                                        <form action="<?php echo e(route('requests.accept', $req->user_swap_id)); ?>" method="POST">
                                            <?php echo csrf_field(); ?>
                                            <button type="submit" class="btn btn-success btn-sm">Accept</button>
                                        </form>
                                        <form action="<?php echo e(route('requests.reject', $req->user_swap_id)); ?>" method="POST">
                                            <?php echo csrf_field(); ?>
                                            <button type="submit" class="btn btn-danger btn-sm">Reject</button>
                                        </form>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
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
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/cse470project/resources/views/incoming-requests.blade.php ENDPATH**/ ?>