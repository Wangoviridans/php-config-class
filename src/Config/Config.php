<?php

namespace Wangoviridans\Config;

/**
 * Class Config
 * @package Wangoviriadns\Config
 */
class Config extends Nested {
	protected $container;

	/**
	 * @param array $container
	 */
	public function __construct(array $container = array()) {
		$this->container = $container;
	}

	/**
	 * @param string $option
	 * @param mixed $value
	 * @return $this
	 */
	public function setOption($option, $value) {
		self::setNestedOption($this->container, $option, $value);
	}

	/**
	 * @param array $options
	 * @return $this
	 */
	public function setOptions(array $options) {
		foreach($options as $option => $value) {
			$this->setOption($option, $value);
		}
	}

	/**
	 * @param string $option
	 * @param mixed|null $default
	 * @return mixed
	 */
	public function getOption($option, $default = null) {
		return self::getNestedOption($this->container, $option, $default);
	}

	/**
	 * @param array $options
	 * @return array
	 */
	public function getOptions(array $options) {
		$result = array();
		foreach($options as $option => $default) {
			if (is_numeric($option)) {
				$option = $default;
				$default = null;
			}
			$result[] = $this->getOption($option, $default);
		}

		return $result;
	}

	/**
	 * @param $option
	 */
	public function unsetOption($option) {
		self::unsetNestedOption($this->container, $option);
	}

	/**
	 * @param array $options
	 */
	public function unsetOptions(array $options) {
		foreach($options as $option) {
			$this->unsetOption($option);
		}
	}

	/**
	 * @param $option
	 * @return bool
	 */
	public function hasOption($option) {
		return self::hasNestedOption($this->container, $option);
	}

	/**
	 * @return array
	 */
	public function toArray() {
		return $this->container;
	}
}