<div class="sf_admin_list">
  <?php if (!count($logs)): ?>
    <p><?php echo __('No result', array(), 'sf_admin') ?></p>
  <?php else: ?>
    <table cellspacing="0">
      <thead>
        <tr>
        	<th><?php echo __('Started at') ?></th>
        	<th><?php echo __('Ended at') ?></th>
        	<th><?php echo __('Log') ?></th>
        	<th><?php echo __('Return code') ?></th>
        	<th><?php echo __('Pid') ?></th>
        </tr>
      </thead>
      <tfoot>
        <tr>
          <th colspan="7">
            <?php echo format_number_choice('[0] no result|[1] 1 result|(1,+Inf] %1% results', array('%1%' => count($logs)), count($logs), 'sf_admin') ?>
          </th>
        </tr>
      </tfoot>
      <tbody>
        <?php foreach ($logs as $i => $log): $odd = fmod(++$i, 2) ? 'odd' : 'even' ?>
          <tr class="sf_admin_row <?php echo $odd ?>">
          	<td><?php echo $log->getStartedAt() ?></td>
          	<td><?php echo $log->getEndedAt() ?></td>
          	<td><?php echo nl2br($log->getLog()) ?></td>
          	<td><?php echo $log->getReturnCode() ?></td>
          	<td><?php echo $log->getPid() ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  <?php endif; ?>
</div>