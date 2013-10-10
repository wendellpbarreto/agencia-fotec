<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('form_file'))
{
	function form_file($attr)
	{
		$parameters = array();
		foreach ($attr as $key => $value) {
			$parameters[] = $key . '="' . $value . '"';
		}
		$parameters = implode(' ', $parameters);

		$form = '<label class="cabinet"><input type="file" ' . $parameters . '></label>';

		return $form;
	}
}

if ( ! function_exists('form_dropdown_std'))
{
	function form_dropdown_std($options = array(), $attr = array(), $objValue = 'name', $selected = FALSE, $multiple = FALSE, $key_id = 'id')
	{
		if ($selected)
		{		
			if ( ! is_array($selected))
			{
				$selected = array($selected);
			}
			if (is_array($selected))
			{
				if (count($selected) > 1)
				{
					$multiple = TRUE;
				}
				if ($selected[0] instanceof stdClass)
				{
					for ($i = 0; $i < count($selected); $i++) { 
						$selected[$i] = $selected[$i]->$key_id;
					}
				}
			}
		}
		else
		{
			$selected = array();
		}

		$parameters = array();
		foreach ($attr as $key => $value) {
			$parameters[] = $key . '="' . $value . '"';
		}
		$parameters = implode(' ', $parameters);

		$multiple = ($multiple) ? ' multiple' : '';
		$form = '<select ' . $parameters . $multiple . '>';

		if (empty($multiple))
		{
			$form .= '<option value=""></option>';
		}

		foreach ($options as $option)
		{
			$select = in_array($option->id, $selected) ? ' selected' : '';
			$form .= '<option value="' . $option->id . '"'. $select . '>' . $option->$objValue . '</option>';
		}

		$form .= '</select>';

		return $form;
	}
}
/* End of file form_extended_helper.php */
/* Location: ./application/helpers/form_extended_helper.php */