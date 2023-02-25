#!/usr/bin/env php
<?php

$threads = [];
$threadResults = [];
$threadCount = 8;

for ($i = 0; $i < $threadCount; $i++) {
	$threads[$i] = new parallel\Runtime(__DIR__ . '/empty.php'); // without bootstrap, the bug does not occur
	$threadResults[$i] = $threads[$i]->run(
		static function () {
			spl_autoload_register(static function (string $className) {
				$map = [
					EnvironmentInterface::class => __DIR__ . '/EnvironmentInterface.php',
					Environment::class => __DIR__ . '/Environment.php',
				];

				require $map[$className];
			});

			if (!class_exists(Environment::class)) {
				echo "MISSING CLASS\n";
				return false;
			}

			return true;
		},
	);
}

foreach ($threads as $thread) {
	$thread->close();
}

echo "OK\n";
