<?php

declare( strict_types = 1 );

namespace FileFetcher\Stopwatch;

use FileFetcher\FileFetcher;
use FileFetcher\Stopwatch\PackagePrivate\StopwatchFileFetcher;
use Symfony\Component\Stopwatch\Stopwatch;

/**
 * Public interface of jeroen/file-fetcher-stopwatch.
 *
 * @licence BSD-3-Clause
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
class Factory {

	public const STOPWATCH_CATEGORY = 'file_fetcher';

	/**
	 * Decorator for FileFetcher objects that profiles file fetching calls using Symfony Stopwatch.
	 *
	 * https://packagist.org/packages/symfony/stopwatch
	 * https://symfony.com/doc/current/components/stopwatch.html
	 */
	public function newStopwatchFetcher( FileFetcher $fileFetcher, Stopwatch $stopwatch, string $category = self::STOPWATCH_CATEGORY ): FileFetcher {
		return new StopwatchFileFetcher(
			$fileFetcher,
			$stopwatch,
			$category
		);
	}

}
