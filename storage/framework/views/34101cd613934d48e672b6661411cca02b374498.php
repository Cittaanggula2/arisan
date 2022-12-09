<?php $__env->startSection('title', __('group.create')); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <div class="panel panel-default">
            <div class="panel-heading"><h3 class="panel-title"><?php echo e(__('group.create')); ?></h3></div>
            <?php echo Form::open(['route' => 'groups.store']); ?>

            <div class="panel-body">
                <?php echo FormField::text('name', ['required' => true, 'label' => __('group.name')]); ?>

                <div class="row">
                    <div class="col-md-4">
                        <?php echo FormField::text('capacity', [
                            'min' => 0,
                            'type' => 'number',
                            'required' => true,
                            'label' => __('group.capacity'),
                        ]); ?>

                    </div>
                    <div class="col-md-4">
                        <?php echo FormField::text('currency', [
                            'required' => true,
                            'value' => old('currency', 'IDR'),
                            'label' => __('group.currency')
                        ]); ?>

                    </div>
                    <div class="col-md-4">
                        <?php echo FormField::price('payment_amount', [
                            'required' => true,
                            'label' => __('group.payment_amount')
                        ]); ?>

                    </div>
                </div>
                <?php echo FormField::textarea('description', ['label' => __('group.description')]); ?>

            </div>
            <div class="panel-footer">
                <?php echo Form::submit(__('group.create'), ['class' => 'btn btn-success']); ?>

                <?php echo e(link_to_route('groups.index', __('app.cancel'), [], ['class' => 'btn btn-default'])); ?>

            </div>
            <?php echo Form::close(); ?>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>