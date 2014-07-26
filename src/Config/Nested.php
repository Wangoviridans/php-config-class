<?php

namespace Wangoviridans\Config;

/**
 * Class Nested
 * @package Wangoviridans\Config
 */
abstract class Nested {
	/**
	 * @param array $context
	 * @param string $option
	 * @param mixed|null $default
	 * @return mixed
	 */
	public static function getNestedOption(&$context, $option, $default = null) {
		$pieces = explode('.', $option);
		foreach($pieces as $piece) {
			if (!is_array($context) || !array_key_exists($piece, $context)) {
				return $default;
			}
			$context = &$context[$piece];
		}
		return $context;
	}

	/**
	 * @param array $context
	 * @param string $option
	 * @param mixed $value
	 */
	public static function setNestedOption(&$context, $option, $value) {
		$pieces = explode('.', $option);
		$total = count($pieces)-1;
		for($i=0; $i<=$total; $i++) {
			if (!is_array($context) || !array_key_exists($pieces[$i], $context)) {
				$context[$pieces[$i]] = $i == $total ? $value : array();
				if ($i == $total) {
					$context[$pieces[$i]] = $value;
				} else {
					$context[$pieces[$i]] = array();
				}
			}
			$context = &$context[$pieces[$i]];
		}
	}

	/**
	 * @param array $context
	 * @param mixed $option
	 */
	public static function unsetNestedOption(&$context, $option) {
		$pieces = explode('.', $option);
		$total = count($pieces)-1;
		for($i=0; $i<=$total; $i++) {
			if (is_array($context) && array_key_exists($pieces[$i], $context)) {
				if ($i == $total) {
					unset($context[$pieces[$i]]);
				} else {
					$context = &$context[$pieces[$i]];
				}
			}
		}
	}

	/**
	 * @param array $context
	 * @param mixed $option
	 * @return bool
	 */
	public static function hasNestedOption(&$context, $option) {
		$pieces = explode('.', $option);
		foreach($pieces as $piece) {
			if (!array_key_exists($piece, $context)) {
				return false;
			}
		}
		return true;
	}

	/**
	 * @param $input
	 * @param string $separator
	 * @return string
	 */
	public static function fromСamelСase($input, $separator = '_') {
		preg_match_all('!([A-Z][A-Z0-9]*(?=$|[A-Z][a-z0-9])|[A-Za-z][a-z0-9]+)!', $input, $matches);
		$ret = $matches[0];
		foreach ($ret as &$match) {
			$match = $match == strtoupper($match) ? strtolower($match) : lcfirst($match);
		}
		return implode($separator, $ret);
	}
}