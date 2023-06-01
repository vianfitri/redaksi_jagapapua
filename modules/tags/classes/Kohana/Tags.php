<?php defined('SYSPATH') or die('No direct script access.');

class Kohana_Tags {
	
	public static function multiple($dom_name = '', $status = '', $selected = '', $is_hidden = false, $custom = '') {
		
		$return = '';
		
		$exec = DB::select(
					array('mstgId', 'id'),
					array('mstgName', 'name')
				)
				->from('master_tags');
				
		if($status === 0 OR $status === 1) {
			$exec = $exec->where('mstgActive', '=', $status);
		}
				
		$exec = $exec->order_by('mstgName', 'ASC')
				->execute()
				->as_array();
		
		$options = '';
		if(!empty($exec)) {
			foreach($exec as $v_exec) {
				$selected_val = '';
				if(!empty($selected)) {
					if(in_array($v_exec['id'], $selected)) {
						$selected_val = 'selected';
                                                $options .= '<option value="' . $v_exec['id'] . '" ' . $selected_val . '>' . $v_exec['name'] . '</option>';
					}
				}
			}
		}
		if(!empty($dom_name)) { // For multiple insert data name must array tag []
			$dom_name = $dom_name . '[]';
		}
		
		$hide_dom = '';
		$select2 = 'select2'; // Multiple select jika hidden maka hilangkan tag select2
		if($is_hidden !== false) {
			$hide_dom = 'style="display:none;"';
			$select2 = '';
		}
		
		$return = 	'<select ' . $hide_dom . ' ' . $custom . ' class="form-control ' . $select2 . '" name="' . $dom_name . '" multiple="multiple" data-placeholder="Select a Tags" style="width: 100%;">
						' . $options . '
					</select>';
		
		return $return;
		
	}
	
}