<?php
namespace Mouf\Utils\Common\MoufHelpers;

/**
 * This class contains utility functions to draw common Mouf elements (dropdowns of instances, etc...)
 *
 */
class MoufHtmlHelper {
	
	private static $cnt = 0;
	
	/**
	 * Outputs the HTML to draw a dropdown of all instances that extend/implement the class/interface passed in parameter. 
	 * 
	 * @param string $label The label of the dropdown
	 * @param string $name The name of the input widget
	 * @param string $class The class that must be implemented
	 * @param bool $canBeNull Whether an empty value can be selected or not
	 * @param string $selectedInstance
	 * @param string $selfedit Either "true" or "false", as a string
	 */
	public static function drawInstancesDropDown($label, $name, $class, $canBeNull = false, $selectedInstance = null,  $selfedit = "false") {
		
		$instanceList = MoufProxy::request("src/direct/get_instances.php", array("class"=>$class, "selfedit"=>$selfedit, "encode"=>"php"));
		
		echo '<div class="control-group">';
		echo "<label class='control-label' for='moufwidget".self::$cnt."'>".$label."</label>";
		echo '<div class="controls">';
		echo '<select id="moufwidget'.self::$cnt.'" name="'.$name.'" >';
		if ($canBeNull) {
			echo '<option value=""></option>';
		}
		for ($i=0; $i<count($instanceList); $i++) {
			if ($instanceList[$i] == $selectedInstance) {
				$selected = 'selected="true"';
			} else {
				$selected = '';
			}
			echo '<option value="'.plainstring_to_htmlprotected($instanceList[$i]).'" '.$selected.'>'.$instanceList[$i].'</option>';
		}
		echo '</select>';
		echo "</div>";
		echo "</div>";
		self::$cnt++;
	}
}