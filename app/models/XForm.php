<?php

/**
 * Form class for admin theme.
 */
class XForm extends \Form {

	private static $html = '';

	public static function tetot()
	{
		return "TETTTOT";
	}

	public static function text($name, $value = null, $options = array(), $label)
	{
		self::$html .= parent::label($name, $label);
		self::$html .= parent::text($name, $value, $options);

		return self::$html;
	}

	public static function generate($viewData=array())
	{
		$defaultData = array(
			// container
			'cc_use'         => true,
			'cc_row'         => false,
			'cc_class'       => 'form-group',
			// html field
			'type'           => 'text',
			'id'             => (!empty($viewData['name'])) ? $viewData['name'] : wordSlugger($viewData['label']),
			'label'          => '',
			'value'          => '',
			'name'           => (!empty($viewData['name'])) ? $viewData['name'] : wordSlugger($viewData['label']),
			'required'       => false,
			// map dropdown
			'dd_index_key'   => '',
			'dd_index_value' => '',
			'dd_extra_attr_key'   => '',
			'dd_extra_attr_value' => '',
			'dd_selected' => '',
			// tw-bootstrap element
			'width'          => 9,
			'tip'            => '',
			'group_id'       => '',
			// type: date
			'autojs'         => true,
			);
		$data = arrayPairs($defaultData, $viewData);

		// static string sets attributes

		$required = ($data['required']) ? 'required' : '';
		// $required_string = ($data['required']) ? 'required="required"' : '';

		$tip = ($data['tip']) ? '<small>'.$data['tip'].'</small>' : '';

		$group_id = ($data['group_id']) ? ' id="'.$data['group_id'].'" ' : '';

		// custom attributes, for any attributes other than defaultData
		$custom_attributes = self::customAttributes($defaultData, $viewData);

		// Prepare outputs
		$output = '';

		/** HTML START **/
		$output .= parent::label($data['name'], $data['label']);

		switch ($data['type']) {
			/*
			case 'dropdown':
				$output .=
					'<div class="col-sm-'.$data['width'].'">'
						.'<select name="'.$data['name'].'" class="form-control" id="'.$data['name'].'" '.$custom_attributes.'>';

				if (!empty($data['dd_index_key']) && !empty($data['dd_index_value']))
				{
					$dd_values = explode(',', $data['dd_index_value']);

					$values = $data['value'];

					$counter = 0;
					foreach ($values as $key => $value) {
						$output .= '<option value="'.$value[$data['dd_index_key']].'"';

						// single dimension array of extra attribute
						if (!empty($data['dd_extra_attr_key']) && count($data['dd_extra_attr_value']))
						{
							$output .= ' '.$data['dd_extra_attr_key'].'="'.$data['dd_extra_attr_value'][$counter].'" ';
						}

						if ($data['dd_selected'] == $value[$data['dd_index_key']])
						{
							$output .= " selected=\"selected\" ";
						}

						$output .= '>';

						$texts = array();
						foreach ($dd_values as $dd_k => $dd_v) {
							array_push($texts, $value[$dd_v]);
						}

						$output .= implode(' - ', $texts);
						$output .= '</option>';
						$counter++;
					}
				}
				else
				{
					foreach ($data['value'] as $k_k => $k_v) {
						$output .= '<option value="'.$k_k.'"';

						if ($data['dd_selected'] == $k_k)
						{
							$output .= " selected=\"selected\" ";
						}

						$output .= '>';
						$output .= $k_v.'</option>';
					}

				}

				$output .=
						'</select>'.
					'</div>';
				break;

			case 'textarea':
				$output .=
						'<div class="col-sm-'.$data['width'].'">'.
							'<textarea name="'.$data['name'].'" class="form-control" rows="5" id="'.$data['name'].'" '.$custom_attributes.'>'.$data['value'].'</textarea>'.
						'</div>';
				break;

			case 'date':
				$container_id = 'dtp-dt-'.$data['name'];
				$output .=
						'<div class="col-sm-'.$data['width'].'">'.
							'<div class="input-group date dtp-dt" id="'.$container_id.'">'.
								'<input type="text" name="'.$data['name'].'" class="form-control" id="'.$data['name'].'" value="'.$data['value'].'" '.
									$custom_attributes.'/>'.
								'<span class="input-group-addon">'.
									'<span class="glyphicon glyphicon-calendar"></span>'.
								'</span>'.
							'</div>'.
						'</div>';

					// use internal js script?
					if ($data['autojs'])
						$output .= '<script type="text/javascript">$(function () {$("#'.$container_id.'").datetimepicker();});</script>';
				break;

			case 'number':
				$output .=
						'<div class="col-sm-'.$data['width'].'">'.
							'<input type="number" name="'.$data['name'].'" class="form-control" id="'.$data['name'].'" value="'.$data['value'].'" '.
								$custom_attributes.'/>'.
						'</div>';
				break;
			*/
			case 'text':
			default:
				$output .= Form::text($data['name'], $data['value'], $custom_attributes);
				break;
		}


		// $output semi-final
		if ($tip)
		{
			$output .= $tip;
		}

		// $output finalizer
		// NOTE: No more appending! .=
		// Use Container? Yes, by default.
		if ($data['cc_use'])
		{
			$output = '<div class="form-group '.$required.'"'.$group_id.'>'.$output.'</div>';
		}

		// Use Row?
		if ($data['cc_row'])
		{
			$output = '<div class="row">'.$output.'</div>';
		}

		return $output;
	}

	/**
	 * Set array of unfiltered attributes
	 *
	 * @param array $defaultData excluding attribute.
	 * @param array $viewData mixed attributes.
	 * @return string html element attributes.
	 */
	public static function customAttributes($defaultData, $viewData)
	{
		$custom_attributes = array();
		foreach ($viewData as $custom_att_key => $custom_att_val) {
			if (!array_key_exists($custom_att_key, $defaultData))
			{
				$custom_att_val = (empty($custom_att_val) && (strlen($custom_att_val) < 1)) ? $custom_att_key : $custom_att_val;
				array_push($custom_attributes, "{$custom_att_key}=\"{$custom_att_val}\"");
			}
		}

		return $custom_attributes;
	}

}