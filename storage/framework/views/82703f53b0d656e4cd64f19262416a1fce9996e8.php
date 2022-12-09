<?php if(Session::has('flash_notification.message')): ?>
<?php
    $level = Session::get('flash_notification.level');
    if ($level == 'info') {
        $level = 'information';
    }
?>
<script src="<?php echo e(asset('js/plugins/noty.js')); ?>"></script>
<script>
    noty({
        type: '<?php echo e($level); ?>',
        layout: 'bottomRight',
        text: '<?php echo e(Session::get('flash_notification.message')); ?>',
        timeout: 3000
    });
</script>
<?php endif; ?>
