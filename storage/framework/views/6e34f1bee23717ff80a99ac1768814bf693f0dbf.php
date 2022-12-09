<?php $__env->startSection('title', 'Dashboard'); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><?php echo e(__('nav_menu.your_groups')); ?></h3>
            </div>
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th class="text-center"><?php echo e(trans('app.table_no')); ?></th>
                        <th><?php echo e(trans('group.name')); ?></th>
                        <th class="text-center"><?php echo e(trans('group.members')); ?></th>
                        <th class="text-right"><?php echo e(trans('group.payment_amount')); ?></th>
                        <th class="text-center"><?php echo e(trans('app.status')); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td class="text-center"><?php echo e(1 + $key); ?></td>
                        <td><?php echo e($group->nameLink()); ?></td>
                        <td class="text-center"><?php echo e($group->members_count); ?></td>
                        <td class="text-right"><?php echo e($group->currency); ?> <?php echo e(formatNo($group->payment_amount)); ?></td>
                        <td class="text-center"><?php echo e($group->status); ?></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr><td colspan="5" class="text-center bg-warning"><?php echo e(__('group.empty')); ?></td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><?php echo e(__('nav_menu.your_outstanding_payments')); ?></h3>
            </div>
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th class="text-center"><?php echo e(trans('app.table_no')); ?></th>
                        <th><?php echo e(trans('group.name')); ?></th>
                        <th class="text-center"><?php echo e(trans('meeting.number')); ?></th>
                        <th class="text-right"><?php echo e(trans('payment.payment')); ?></th>
                        <th class="text-center"><?php echo e(trans('app.status')); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php if($outstandingPayments->isEmpty()): ?>
                        <tr><td colspan="5" class="text-center bg-warning"><?php echo e(__('user.no_outstanding_payment')); ?></td></tr>
                    <?php endif; ?>
                    <?php $__currentLoopData = $outstandingPayments->groupBy('group_id'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $groupId => $groupedMeetings): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $no = 0;
                            $outstandingPaymentsTotal = 0;
                        ?>

                        <?php $__currentLoopData = $groupedMeetings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $meeting): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <?php
                                $payment = $meeting->payments->where('membership_id', $membershipIds[$meeting->group_id])->first();
                            ?>

                            <?php if (! ($payment)): ?>
                                <tr>
                                    <td class="text-center"><?php echo e(++$no); ?></td>
                                    <td><?php echo e($meeting->group->nameLink()); ?></td>
                                    <td class="text-center"><?php echo e(link_to_route('meetings.show', $meeting->number, $meeting)); ?></td>
                                    <td class="text-right">
                                        <?php echo e(formatNo($paymentAmount = $meeting->group->payment_amount)); ?>

                                    </td>
                                    <td class="text-center"><?php echo e(__('payment.not_yet')); ?></td>
                                </tr>
                                <?php $outstandingPaymentsTotal += $paymentAmount; ?>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <th colspan="3"><?php echo e(__('app.total')); ?></th>
                            <th class="text-right"><?php echo e(formatNo($outstandingPaymentsTotal)); ?></th>
                            <th>&nbsp;</th>
                        </tr>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>