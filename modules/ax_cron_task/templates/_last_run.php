<?php use_helper('Date') ?>
<?php echo distance_of_time_in_words($axCronTask->getRawValue()->getLastRun()->format('U')) ?> <?php echo __('ago') ?>
