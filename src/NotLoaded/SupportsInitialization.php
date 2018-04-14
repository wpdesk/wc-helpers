<?php

namespace WPDesk;

interface SupportsInitialization {
	const DEFAULT_INIT_PRIORITY = 1;

	public function init();

	/** @return int */
	public function get_init_priority();
}