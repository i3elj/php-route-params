<?php

namespace Pages;

class User {
	function __construct(private string $path, private array $params) {}

	function handler()
	{
		dd([
			"This is User controller",
			"path:" => $this->path,
			"params:" => $this->params
		]);
	}
}
