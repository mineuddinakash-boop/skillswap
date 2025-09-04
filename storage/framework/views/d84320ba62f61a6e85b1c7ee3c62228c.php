<!DOCTYPE html>
<html>
<head>
    <title>Available Skills</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h3 class="mb-3">Available Skills</h3>

    
    <div class="mb-4">
        <div class="card">
            <div class="card-header bg-primary text-white">
                Top Rated Users
            </div>
            <div class="card-body">
                <?php if(isset($topRated) && $topRated->isNotEmpty()): ?>
                    <div class="row">
                        <?php $__currentLoopData = $topRated; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-md-4 mb-2">
                                <div class="p-2 border rounded">
                                    <strong><?php echo e($t->name); ?></strong><br>
                                    <small class="text-muted">Avg rating: <?php echo e(number_format($t->avg_rating, 1)); ?> / 5</small>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php else: ?>
                    <p class="mb-0 text-muted">No ratings yet.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    
    <form method="GET" action="<?php echo e(route('skills.view')); ?>" class="mb-3 d-flex">
        <input type="text" name="search" value="<?php echo e($search ?? ''); ?>" class="form-control me-2" placeholder="Search by skill (have or want)...">

        <select name="category" class="form-select me-2" style="max-width:220px;">
            <option value="">All Categories</option>
            <option value="hard skill" <?php echo e((request('category') == 'hard skill' || (isset($category) && $category == 'hard skill')) ? 'selected' : ''); ?>>Hard Skill</option>
            <option value="soft skill" <?php echo e((request('category') == 'soft skill' || (isset($category) && $category == 'soft skill')) ? 'selected' : ''); ?>>Soft Skill</option>
        </select>

        <button type="submit" class="btn btn-primary">Apply</button>
    </form>

    
    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    
    <table class="table table-bordered table-striped align-middle">
        <thead class="table-light">
            <tr>
                <th>User Name</th>
                <th>Average Rating</th>
                <th>Skill Category</th>
                <th>Skill Have</th>
                <th>Skill Source</th>
                <th>Skill Want</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $swapRequests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
                <td><?php echo e($sr->user_name); ?></td>
                <td><?php echo e(number_format($sr->average_rating ?? 0, 1)); ?> / 5</td>
                <td><?php echo e(ucfirst($sr->skill_category)); ?></td>
                <td><?php echo e($sr->skill_have); ?></td>
                <td><?php echo e($sr->skill_source); ?></td>
                <td><?php echo e($sr->skill_want); ?></td>
                <td>
                    <form action="<?php echo e(route('add.swap', $sr->id)); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="btn btn-success btn-sm">Add</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr>
                <td colspan="7" class="text-center">No available skills found.</td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <a href="<?php echo e(route('profile')); ?>" class="btn btn-secondary">Back to Profile</a>
</div>
</body>
</html>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/cse470project/resources/views/view-skills.blade.php ENDPATH**/ ?>