<?php defined('SYSPATH') or die('No direct script access.');

class Model_Home extends Model {

	public function count_all($table='',$column='') {
		$return = 0;
		
		$results = DB::select(array('COUNT('.$column.')', 'total'))->from($table)->execute();
		// $results = DB::select($column)->from($table)->execute();
		$exec = $results->as_array();

		if(!empty($exec[0]['total'])) {
			$return = $exec[0]['total'];
		}
		
		return $return;
	}

	public function count_all_two($table='',$column='') {
		$return = 0;
		
		$results = DB::select(array('COUNT('.$column.')', 'total'))->from($table)->where($column, '=', 1)->execute();
		// $results = DB::select($column)->from($table)->execute();
		$exec = $results->as_array();

		if(!empty($exec[0]['total'])) {
			$return = $exec[0]['total'];
		}
		
		return $return;
	}
	
}