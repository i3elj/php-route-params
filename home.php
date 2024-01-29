<?php

namespace Pages;

class Home {
	function __construct(private string $path, private array $params) {}

	function handler()
	{
		dd([
			"Hello /home page",
			"path:" => $this->path,
			"params:" => $this->params
		]);
	}
}
