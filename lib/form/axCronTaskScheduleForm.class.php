<?php

/**
 * axCronTaskSchedule form.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 */
class axCronTaskScheduleForm extends BaseaxCronTaskScheduleForm {
	public function configure() {
		unset($this->validatorSchema['created_at'], $this->validatorSchema['updated_at']);
		unset($this->widgetSchema['created_at'], $this->widgetSchema['updated_at']);
	}
}
