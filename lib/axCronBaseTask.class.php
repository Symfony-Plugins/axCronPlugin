<?php

abstract class axCronBaseTask extends sfBaseTask {
	private $task;
	protected $task_log;
	
	protected function configure() {
		$this->addOptions(array(
			new sfCommandOption('application', null, sfCommandOption::PARAMETER_REQUIRED, 'The application name'),
			new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'dev'),
			new sfCommandOption('connection', null, sfCommandOption::PARAMETER_REQUIRED, 'The connection name', 'propel'),
			// add your own options here
		));
		
		$this->addOptions($this->getTaskOptions());

		$this->briefDescription = '';
		$this->detailedDescription = <<<EOF
EOF;
		
		$this->namespace = $this->getTaskNamespace();
		$this->name = $this->getTaskName();
	}
	
	protected function execute($arguments = array(), $options = array()) {
		set_error_handler(array("axCronException", "errorHandlerCallback"), E_ALL);
		
		$databaseManager = new sfDatabaseManager($this->configuration);
		$connection = $databaseManager->getDatabase($options['connection'])->getConnection();

		$this->task = axCronTaskQuery::create()->findOneByName($this->namespace . ':' . $this->name);
		
		if ($this->task->isRunning()) {
			throw new Exception('This task is already running.');
		}
		
		$this->task_log = new axCronTaskLog();
		$this->task_log->setaxCronTask($this->task);
		$this->task_log->setStartedAt(time());
		$this->task_log->setPid(getmypid());
		$this->task_log->save();
		
		try {
			ob_start();
			
			$this->doExecute();
			
			$this->task_log->setLog(ob_get_contents());
			$this->task_log->setReturnCode(0);
		} catch (Exception $e) {
			$this->task_log->setReturnCode(-1);
			$this->task_log->setLog(serialize($e));
			
			if ($to = sfConfig::get('app_axcron_email_to', false)) {
				$this->getMailer()->composeAndSend(
					sfConfig::get('app_axcron_email_from', 'noone@axcron.nowhere'),
					$to,
					sfConfig::get('app_axcron_email_subjectpre', '[axcron] exception in task '.$this->task->getName()),
					$e->__toString()
				);
			}
		}
		
		$this->task_log->setEndedAt(time());
		$this->task_log->save();
	}
	
	protected function doExecute($arguments = array(), $options = array()) {
		throw new Exception('You must create doExecute method.');
	}
	
	protected function getTaskOptions() {
		return array();
	}
	
	protected function getTaskNamespace() {
		throw new Exception('You must create getNamespace method.');
	}
	
	protected function getTaskName() {
		throw new Exception('You must create getName method.');
	}
}