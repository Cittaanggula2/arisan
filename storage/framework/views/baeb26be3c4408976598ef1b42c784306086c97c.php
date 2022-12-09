<?php $__env->startSection('title', trans('group.list')); ?>

<?php $__env->startSection('content'); ?>
<h1 class="page-header">
    <div class="pull-right">
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create', new App\Group)): ?>
        <?php echo e(link_to_route('groups.create', trans('group.create'), [], ['class' => 'btn btn-success'])); ?>

    <?php endif; ?>
    </div>
    <?php echo e(trans('group.list')); ?>

    <small><?php echo e(trans('app.total')); ?> : <?php echo e($groups->total()); ?> <?php echo e(trans('group.group')); ?></small>
</h1>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default table-responsive">
            <div class="panel-heading">
                <?php echo e(Form::open(['method' => 'get','class' => 'form-inline'])); ?>

                <?php echo FormField::text('q', ['value' => request('q'), 'label' => trans('group.search'), 'class' => 'input-sm']); ?>

                <?php echo e(Form::submit(trans('group.search'), ['class' => 'btn btn-sm'])); ?>

                <?php echo e(link_to_route('groups.index', trans('app.reset'))); ?>

                <?php echo e(Form::close()); ?>

            </div>
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th class="text-center"><?php echo e(trans('app.table_no')); ?></th>
                        <th><?php echo e(trans('group.name')); ?></th>
                        <th class="text-center"><?php echo e(trans('group.members')); ?></th>
                        <th class="text-right"><?php echo e(trans('group.payment_amount')); ?></th>
                        <th class="text-center"><?php echo e(trans('app.status')); ?></th>
                        <th><?php echo e(trans('group.creator')); ?></th>
                        <th class="text-center"><?php echo e(trans('app.action')); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td class="text-center"><?php echo e($groups->firstItem() + $key); ?></td>
                        <td><?php echo e($group->nameLink()); ?></td>
                        <td class="text-center"><?php echo e($group->members_count); ?></td>
                        <td class="text-right"><?php echo e($group->currency); ?> <?php echo e(formatNo($group->payment_amount)); ?></td>
                        <td class="text-center"><?php echo e($group->status); ?></td>
                        <td><?php echo e($group->creator->name); ?></td>
                        <td class="text-center">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view', $group)): ?>
                            <?php echo link_to_route(
                                'groups.show',
                                trans('app.show'),
                                [$group],
                                ['class' => 'btn btn-default btn-xs', 'id' => 'show-group-' . $group->id]
                            ); ?>

                        <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
            <div class="panel-body"><?php echo e($groups->appends(Request::except('page'))->render()); ?></div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>