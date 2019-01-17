<?php

declare( strict_types = 1 );

namespace FileFetcher\Stopwatch\PackagePrivate;

use FileFetcher\FileFetcher;
use FileFetcher\FileFetchingException;
use Symfony\Component\Stopwatch\Stopwatch;

/**
 * This class is package private and should not be bound to from outside this library.
 *
 * @licence BSD-3-Clause
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
class StopwatchFileFetcher implements FileFetcher {

	private $fileFetcher;
	private $stopwatch;
	private $category;

	public function __construct( FileFetcher $fileFetcher, Stopwatch $stopwatch, string $category ) {
		$this->fileFetcher = $fileFetcher;
		$this->stopwatch = $stopwatch;
		$this->category = $category;
	}

	public function fetchFile( string $fileUrl ): string {
		$this->stopwatch->start( $fileUrl, $this->category );

		try {
			$fileContent = $this->fileFetcher->fetchFile( $fileUrl );
		}
		catch ( FileFetchingException $ex ) {
			throw $ex;
		}
		finally {
			$this->stopwatch->stop( $fileUrl );
		}

		return $fileContent;
	}

}
