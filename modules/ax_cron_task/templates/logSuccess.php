<?php use_helper('I18N', 'Date') ?>
<?php include_partial('ax_cron_task/assets') ?>

<div id="sf_admin_container">
  <h1><?php echo __('Ax cron task logs', array(), 'messages') ?></h1>

  <?php include_partial('ax_cron_task/flashes') ?>

  <div id="sf_admin_content">
    <form action="<?php echo url_for('ax_cron_task_collection', array('action' => 'batch')) ?>" method="post">
    <?php include_partial('ax_cron_task/log', array('logs' => $logs)) ?>
    </form>
  </div>
</div>
