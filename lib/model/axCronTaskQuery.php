<?php



/**
 * Skeleton subclass for performing query and update operations on the 'axcron_task' table.
 *
 * 
 *
 * This class was autogenerated by Propel 1.5.3-dev on:
 *
 * Mon Jun 28 10:38:23 2010
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.plugins.axCronPlugin.lib.model
 */
class axCronTaskQuery extends BaseaxCronTaskQuery {
	public function filterActive() {
		$this->filterByIsActive(true);
		
		return $this;
	}
} // axCronTaskQuery
