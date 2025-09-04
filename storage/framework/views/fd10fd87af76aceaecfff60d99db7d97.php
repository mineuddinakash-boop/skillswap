<!DOCTYPE html>
<html>
<head>
    <title>Chat History</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h3>Chat History</h3>
    <table class="table table-bordered table-striped">
        <thead class="table-light">
            <tr>
                <th>Name</th>
                <th>Done On</th>
                <th>Rating</th>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $history; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $h): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
                <td><?php echo e($h->name); ?></td>
                <td><?php echo e($h->created_at); ?></td>
                <td>
                    <?php if($h->rating): ?>
                        <?php echo e($h->rating); ?> / 5
                    <?php else: ?>
                        <form action="<?php echo e(route('history.rate', $h->id)); ?>" method="POST" class="d-flex gap-2">
                            <?php echo csrf_field(); ?>
                            <select name="rating" class="form-select form-select-sm" required>
                                <option value="" disabled selected>Rate</option>
                                <?php for($i=1; $i<=5; $i++): ?>
                                    <option value="<?php echo e($i); ?>"><?php echo e($i); ?></option>
                                <?php endfor; ?>
                            </select>
                            <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                        </form>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr>
                <td colspan="3" class="text-center">No history available.</td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>
    <a href="<?php echo e(route('profile')); ?>" class="btn btn-secondary">Back to Profile</a>
</div>
</body>
</html>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/cse470project/resources/views/history.blade.php ENDPATH**/ ?>