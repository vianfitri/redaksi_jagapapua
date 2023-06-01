<?php defined('SYSPATH') or die('No direct script access.');

class Kohana_Foto {

	public static function validation($post) {
		
		$validation = Validation::factory($post)
						->rule('title', 'not_empty')
						->rule('title', 'max_length', array(':value', '65'))
						->rule('description', 'not_empty')
						->rule('description', 'max_length', array(':value', '165'))
						->rule('detail', 'not_empty')
						;
						
		if($validation->check()) {
			
			$return = TRUE;
		
		} else {
		
			$return = $validation->errors('validation');
		
		}
		
		return $return;
	}
    
	public static function select_list($dom_name = '', $status = '', $id_selected = '', $custom = '', $version='') {
		/*$session = Session::instance();
		$return = '';
		
		$exec = DB::select(
					array('eccaId', 'id'),
					array('eccaName', 'name')
				)
				->from('foto_category');
				
		if($status === 0 OR $status === 1) {
			$exec = $exec->where('eccaStatus', '=', $status);
		}
		
		$exec = $exec->order_by('eccaName', 'ASC')
				->execute()
				->as_array();

		if($version=='lite'){
			$return .= '<div style="width: 200px;float: left;">
					<select ' . $custom . ' class="form-control" name="' . $dom_name . '" required>
							<option value="">-- ' . __('Choose Category') . ' --</option>';
		}else{
			$return .= '<div class="form-group">
						<label>' . __('Category') . '</label>
						<select ' . $custom . ' class="form-control" name="' . $dom_name . '" required>
							<option value="">-- ' . __('Choose Category') . ' --</option>';
		}

		$status=0;
		if(!empty($exec)) {
			foreach($exec as $v_exec) {
				$selected_val = '';
				if($id_selected == $v_exec['id']) {
					$selected_val = 'selected';
				}
				$return .= '<option value="' . $v_exec['id'] . '" ' . $selected_val . '>' . $v_exec['name'] . '</option>';
			}
		}

		$return .= '	</select></div>';
		return $return;*/

	}
    
}