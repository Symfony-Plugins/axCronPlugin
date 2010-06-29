<?php

class axcronRunTask extends sfBaseTask
{
  protected function configure()
  {
    // // add your own arguments here
    // $this->addArguments(array(
    //   new sfCommandArgument('my_arg', sfCommandArgument::REQUIRED, 'My argument'),
    // ));

    $this->addOptions(array(
      new sfCommandOption('application', null, sfCommandOption::PARAMETER_REQUIRED, 'The application name'),
      new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'dev'),
      new sfCommandOption('connection', null, sfCommandOption::PARAMETER_REQUIRED, 'The connection name', 'propel'),
      // add your own options here
    ));

    $this->namespace        = 'axcron';
    $this->name             = 'run';
    $this->briefDescription = '';
    $this->detailedDescription = <<<EOF
The [axcron:run|INFO] task does things.
Call it with:

  [php symfony axcron:run|INFO]
EOF;
  }

  protected function execute($arguments = array(), $options = array())
  {
    // initialize the database connection
    $databaseManager = new sfDatabaseManager($this->configuration);
    $connection = $databaseManager->getDatabase($options['connection'])->getConnection();

    // add your code here
	$tasks = axCronTaskQuery::create()
		->filterActive()
		->find();
		
	foreach ($tasks as $task) {
		if ($task->hasToRun()) {
			echo 'Eseguo: '.$task->getCommand()."\n";
		
			system($task->getCommand());
		} else {
			echo 'Non eseguo: '.$task->getCommand()."\n";
		}
	}
  }
}