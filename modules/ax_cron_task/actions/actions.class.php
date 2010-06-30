<?php

require_once dirname(__FILE__).'/../lib/ax_cron_taskGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/ax_cron_taskGeneratorHelper.class.php';

/**
 * ax_cron_task actions.
 *
 * @package    deelrs.com
 * @subpackage ax_cron_task
 * @author     Axura Srl
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class ax_cron_taskActions extends autoAx_cron_taskActions {
	public function executeLog(sfWebRequest $request) {
		$this->axCronTask = $this->getRoute()->getObject();
		
		$this->logs = axCronTaskLogQuery::create()
			->filterByaxCronTask($this->axCronTask)
			->orderByCreatedAt(Criteria::DESC)
			->find();
	}
}
