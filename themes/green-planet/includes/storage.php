<?php
/**
 * Theme storage manipulations
 *
 * @package WordPress
 * @subpackage GREEN_PLANET
 * @since GREEN_PLANET 1.0
 */

// Disable direct call
if ( ! defined( 'ABSPATH' ) ) { exit; }

// Get theme variable
if (!function_exists('green_planet_storage_get')) {
	function green_planet_storage_get($var_name, $default='') {
		global $GREEN_PLANET_STORAGE;
		return isset($GREEN_PLANET_STORAGE[$var_name]) ? $GREEN_PLANET_STORAGE[$var_name] : $default;
	}
}

// Set theme variable
if (!function_exists('green_planet_storage_set')) {
	function green_planet_storage_set($var_name, $value) {
		global $GREEN_PLANET_STORAGE;
		$GREEN_PLANET_STORAGE[$var_name] = $value;
	}
}

// Check if theme variable is empty
if (!function_exists('green_planet_storage_empty')) {
	function green_planet_storage_empty($var_name, $key='', $key2='') {
		global $GREEN_PLANET_STORAGE;
		if (!empty($key) && !empty($key2))
			return empty($GREEN_PLANET_STORAGE[$var_name][$key][$key2]);
		else if (!empty($key))
			return empty($GREEN_PLANET_STORAGE[$var_name][$key]);
		else
			return empty($GREEN_PLANET_STORAGE[$var_name]);
	}
}

// Check if theme variable is set
if (!function_exists('green_planet_storage_isset')) {
	function green_planet_storage_isset($var_name, $key='', $key2='') {
		global $GREEN_PLANET_STORAGE;
		if (!empty($key) && !empty($key2))
			return isset($GREEN_PLANET_STORAGE[$var_name][$key][$key2]);
		else if (!empty($key))
			return isset($GREEN_PLANET_STORAGE[$var_name][$key]);
		else
			return isset($GREEN_PLANET_STORAGE[$var_name]);
	}
}

// Inc/Dec theme variable with specified value
if (!function_exists('green_planet_storage_inc')) {
	function green_planet_storage_inc($var_name, $value=1) {
		global $GREEN_PLANET_STORAGE;
		if (empty($GREEN_PLANET_STORAGE[$var_name])) $GREEN_PLANET_STORAGE[$var_name] = 0;
		$GREEN_PLANET_STORAGE[$var_name] += $value;
	}
}

// Concatenate theme variable with specified value
if (!function_exists('green_planet_storage_concat')) {
	function green_planet_storage_concat($var_name, $value) {
		global $GREEN_PLANET_STORAGE;
		if (empty($GREEN_PLANET_STORAGE[$var_name])) $GREEN_PLANET_STORAGE[$var_name] = '';
		$GREEN_PLANET_STORAGE[$var_name] .= $value;
	}
}

// Get array (one or two dim) element
if (!function_exists('green_planet_storage_get_array')) {
	function green_planet_storage_get_array($var_name, $key, $key2='', $default='') {
		global $GREEN_PLANET_STORAGE;
		if (empty($key2))
			return !empty($var_name) && !empty($key) && isset($GREEN_PLANET_STORAGE[$var_name][$key]) ? $GREEN_PLANET_STORAGE[$var_name][$key] : $default;
		else
			return !empty($var_name) && !empty($key) && isset($GREEN_PLANET_STORAGE[$var_name][$key][$key2]) ? $GREEN_PLANET_STORAGE[$var_name][$key][$key2] : $default;
	}
}

// Set array element
if (!function_exists('green_planet_storage_set_array')) {
	function green_planet_storage_set_array($var_name, $key, $value) {
		global $GREEN_PLANET_STORAGE;
		if (!isset($GREEN_PLANET_STORAGE[$var_name])) $GREEN_PLANET_STORAGE[$var_name] = array();
		if ($key==='')
			$GREEN_PLANET_STORAGE[$var_name][] = $value;
		else
			$GREEN_PLANET_STORAGE[$var_name][$key] = $value;
	}
}

// Set two-dim array element
if (!function_exists('green_planet_storage_set_array2')) {
	function green_planet_storage_set_array2($var_name, $key, $key2, $value) {
		global $GREEN_PLANET_STORAGE;
		if (!isset($GREEN_PLANET_STORAGE[$var_name])) $GREEN_PLANET_STORAGE[$var_name] = array();
		if (!isset($GREEN_PLANET_STORAGE[$var_name][$key])) $GREEN_PLANET_STORAGE[$var_name][$key] = array();
		if ($key2==='')
			$GREEN_PLANET_STORAGE[$var_name][$key][] = $value;
		else
			$GREEN_PLANET_STORAGE[$var_name][$key][$key2] = $value;
	}
}

// Merge array elements
if (!function_exists('green_planet_storage_merge_array')) {
	function green_planet_storage_merge_array($var_name, $key, $value) {
		global $GREEN_PLANET_STORAGE;
		if (!isset($GREEN_PLANET_STORAGE[$var_name])) $GREEN_PLANET_STORAGE[$var_name] = array();
		if ($key==='')
			$GREEN_PLANET_STORAGE[$var_name] = array_merge($GREEN_PLANET_STORAGE[$var_name], $value);
		else
			$GREEN_PLANET_STORAGE[$var_name][$key] = array_merge($GREEN_PLANET_STORAGE[$var_name][$key], $value);
	}
}

// Add array element after the key
if (!function_exists('green_planet_storage_set_array_after')) {
	function green_planet_storage_set_array_after($var_name, $after, $key, $value='') {
		global $GREEN_PLANET_STORAGE;
		if (!isset($GREEN_PLANET_STORAGE[$var_name])) $GREEN_PLANET_STORAGE[$var_name] = array();
		if (is_array($key))
			green_planet_array_insert_after($GREEN_PLANET_STORAGE[$var_name], $after, $key);
		else
			green_planet_array_insert_after($GREEN_PLANET_STORAGE[$var_name], $after, array($key=>$value));
	}
}

// Add array element before the key
if (!function_exists('green_planet_storage_set_array_before')) {
	function green_planet_storage_set_array_before($var_name, $before, $key, $value='') {
		global $GREEN_PLANET_STORAGE;
		if (!isset($GREEN_PLANET_STORAGE[$var_name])) $GREEN_PLANET_STORAGE[$var_name] = array();
		if (is_array($key))
			green_planet_array_insert_before($GREEN_PLANET_STORAGE[$var_name], $before, $key);
		else
			green_planet_array_insert_before($GREEN_PLANET_STORAGE[$var_name], $before, array($key=>$value));
	}
}

// Push element into array
if (!function_exists('green_planet_storage_push_array')) {
	function green_planet_storage_push_array($var_name, $key, $value) {
		global $GREEN_PLANET_STORAGE;
		if (!isset($GREEN_PLANET_STORAGE[$var_name])) $GREEN_PLANET_STORAGE[$var_name] = array();
		if ($key==='')
			array_push($GREEN_PLANET_STORAGE[$var_name], $value);
		else {
			if (!isset($GREEN_PLANET_STORAGE[$var_name][$key])) $GREEN_PLANET_STORAGE[$var_name][$key] = array();
			array_push($GREEN_PLANET_STORAGE[$var_name][$key], $value);
		}
	}
}

// Pop element from array
if (!function_exists('green_planet_storage_pop_array')) {
	function green_planet_storage_pop_array($var_name, $key='', $defa='') {
		global $GREEN_PLANET_STORAGE;
		$rez = $defa;
		if ($key==='') {
			if (isset($GREEN_PLANET_STORAGE[$var_name]) && is_array($GREEN_PLANET_STORAGE[$var_name]) && count($GREEN_PLANET_STORAGE[$var_name]) > 0) 
				$rez = array_pop($GREEN_PLANET_STORAGE[$var_name]);
		} else {
			if (isset($GREEN_PLANET_STORAGE[$var_name][$key]) && is_array($GREEN_PLANET_STORAGE[$var_name][$key]) && count($GREEN_PLANET_STORAGE[$var_name][$key]) > 0) 
				$rez = array_pop($GREEN_PLANET_STORAGE[$var_name][$key]);
		}
		return $rez;
	}
}

// Inc/Dec array element with specified value
if (!function_exists('green_planet_storage_inc_array')) {
	function green_planet_storage_inc_array($var_name, $key, $value=1) {
		global $GREEN_PLANET_STORAGE;
		if (!isset($GREEN_PLANET_STORAGE[$var_name])) $GREEN_PLANET_STORAGE[$var_name] = array();
		if (empty($GREEN_PLANET_STORAGE[$var_name][$key])) $GREEN_PLANET_STORAGE[$var_name][$key] = 0;
		$GREEN_PLANET_STORAGE[$var_name][$key] += $value;
	}
}

// Concatenate array element with specified value
if (!function_exists('green_planet_storage_concat_array')) {
	function green_planet_storage_concat_array($var_name, $key, $value) {
		global $GREEN_PLANET_STORAGE;
		if (!isset($GREEN_PLANET_STORAGE[$var_name])) $GREEN_PLANET_STORAGE[$var_name] = array();
		if (empty($GREEN_PLANET_STORAGE[$var_name][$key])) $GREEN_PLANET_STORAGE[$var_name][$key] = '';
		$GREEN_PLANET_STORAGE[$var_name][$key] .= $value;
	}
}

// Call object's method
if (!function_exists('green_planet_storage_call_obj_method')) {
	function green_planet_storage_call_obj_method($var_name, $method, $param=null) {
		global $GREEN_PLANET_STORAGE;
		if ($param===null)
			return !empty($var_name) && !empty($method) && isset($GREEN_PLANET_STORAGE[$var_name]) ? $GREEN_PLANET_STORAGE[$var_name]->$method(): '';
		else
			return !empty($var_name) && !empty($method) && isset($GREEN_PLANET_STORAGE[$var_name]) ? $GREEN_PLANET_STORAGE[$var_name]->$method($param): '';
	}
}

// Get object's property
if (!function_exists('green_planet_storage_get_obj_property')) {
	function green_planet_storage_get_obj_property($var_name, $prop, $default='') {
		global $GREEN_PLANET_STORAGE;
		return !empty($var_name) && !empty($prop) && isset($GREEN_PLANET_STORAGE[$var_name]->$prop) ? $GREEN_PLANET_STORAGE[$var_name]->$prop : $default;
	}
}
?>