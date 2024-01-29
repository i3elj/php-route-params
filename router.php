<?php

require_once "lib.php";
require_once "user.php";
require_once "home.php";

$path = $_SERVER['REQUEST_URI'];

$routes = [
	['path' => '/home', 'controller' => '\Pages\Home'],
	['path' => '/api/user/:id(int)', 'controller' => '\Pages\User'],
	['path' => '/api/username/:name(string)', 'controller' => '\Pages\User'],
];

foreach ($routes as $route) {
	$clean_path = clear_path($route['path']);

	if (preg_match($clean_path, $path, $matches)) {
		$endpoint = new $route['controller'](
			path: $path,
			params: array_slice($matches, 1)
		);
		$endpoint->handler();
	}
}

function clear_path(string $dirty_path)
{
	$new_path = preg_replace("/\//", "\/", $dirty_path);
	$regex = "/:([a-z]+)\((int|string)\)/";
	preg_match($regex, $new_path, $matches);

	$type = match ($matches[2]) {
		"int" => "(\d+)",
		"string" => "([A-Za-z]+)",
		default => ""
	};

	$result = preg_replace($regex, $type, $new_path);
	return "/$result/";
}
