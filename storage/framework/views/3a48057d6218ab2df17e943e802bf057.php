<!DOCTYPE html>
<html>
<head>
    <title>Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-9">
            
            <!-- Header -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="fw-bold">👋 Welcome, <?php echo e($user->name); ?></h2>
                <div>
                    <a href="<?php echo e(route('notifications.view')); ?>" class="btn btn-warning me-2">
                        <i class="bi bi-bell"></i> Notifications
                    </a>
                    <a href="<?php echo e(route('logout')); ?>" class="btn btn-danger">
                        <i class="bi bi-box-arrow-right"></i> Logout
                    </a>
                </div>
            </div>

            <!-- User Profile Card -->
            <div class="card shadow-lg mb-4">
                <div class="card-header bg-dark text-white text-center">
                    <h4 class="mb-0"><i class="bi bi-person-circle"></i> User Profile</h4>
                </div>
                <div class="card-body">
                    <?php if(session('success')): ?>
                        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
                    <?php endif; ?>

                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><strong>Name:</strong> <?php echo e($user->name); ?></li>
                        <li class="list-group-item"><strong>Email:</strong> <?php echo e($user->email); ?></li>
                        <li class="list-group-item"><strong>Phone:</strong> <?php echo e($user->phone); ?></li>
                    </ul>
                </div>
                <div class="card-footer text-center">
                    <div class="d-flex flex-wrap justify-content-center gap-2">
                        <a href="<?php echo e(route('home')); ?>" class="btn btn-secondary"><i class="bi bi-house-door"></i> Home</a>
                        <a href="<?php echo e(route('profile.edit')); ?>" class="btn btn-warning"><i class="bi bi-pencil-square"></i> Edit Profile</a>
                        <a href="<?php echo e(route('swap.form')); ?>" class="btn btn-primary"><i class="bi bi-plus-circle"></i> Create Swap</a>
                        <a href="<?php echo e(route('skills.view')); ?>" class="btn btn-info"><i class="bi bi-people"></i> View Skills</a>
                        <a href="<?php echo e(route('requests.incoming')); ?>" class="btn btn-success"><i class="bi bi-inbox"></i> Requests</a>
                        <a href="<?php echo e(route('chat.list')); ?>" class="btn btn-dark"><i class="bi bi-chat-dots"></i> Chat</a>
                        <a href="<?php echo e(route('history.view')); ?>" class="btn btn-secondary"><i class="bi bi-clock-history"></i> History</a>
                    </div>
                </div>
            </div>

            <!-- User Swap Requests -->
            <div class="card shadow-lg">
                <div class="card-header bg-info text-white text-center">
                    <h4 class="mb-0"><i class="bi bi-list-task"></i> Your Swap Requests</h4>
                </div>
                <div class="card-body">
                    <?php if($swapRequests->isEmpty()): ?>
                        <p class="text-center text-muted">No swap requests created yet.</p>
                    <?php else: ?>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead class="table-light text-center">
                                    <tr>
                                        <th>Category</th>
                                        <th>Skill Have</th>
                                        <th>Skill Source</th>
                                        <th>Skill Want</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $swapRequests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $swap): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e(ucfirst($swap->skill_category)); ?></td>
                                        <td><?php echo e($swap->skill_have); ?></td>
                                        <td><?php echo e($swap->skill_source); ?></td>
                                        <td><?php echo e($swap->skill_want); ?></td>
                                        <td class="text-center">
                                            <form action="<?php echo e(route('swap.delete', $swap->id)); ?>" method="POST" onsubmit="return confirm('Are you sure?');">
                                                <?php echo csrf_field(); ?>
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <i class="bi bi-trash"></i> Remove
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

        </div>
    </div>
</div>

</body>
</html>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/cse470project/resources/views/profile.blade.php ENDPATH**/ ?>