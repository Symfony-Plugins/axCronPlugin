<?php

/**
 * axCronTask form.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 */
class axCronTaskForm extends BaseaxCronTaskForm {
	public function configure() {
		$this->embedRelation('axCronTaskParameter');
		$this->embedRelation('axCronTaskSchedule');
		
		unset($this->validatorSchema['created_at'], $this->validatorSchema['updated_at']);
		
		$this->widgetSchema['created_at'] = new sfWidgetFormPlain();
		$this->widgetSchema['updated_at'] = new sfWidgetFormPlain();
	}
}
