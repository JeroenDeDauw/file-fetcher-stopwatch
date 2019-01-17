<?php

declare( strict_types = 1 );

namespace FileFetcher\Stopwatch\Tests\Integration;

use FileFetcher\Stopwatch\Factory;
use FileFetcher\StubFileFetcher;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Stopwatch\Stopwatch;

/**
 * @covers \FileFetcher\Stopwatch\Factory
 *
 * @licence BSD-3-Clause
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
class FactoryTest extends TestCase {

	public function testNewStopwatchFetcherReturnsFetcherThatUsesStopwatch() {
		$stopwatch = $this->createMock( Stopwatch::class );
		$stopwatch->expects( $this->once() )->method( 'start' );
		$stopwatch->expects( $this->once() )->method( 'stop' );

		$fetcher = ( new Factory() )->newStopwatchFetcher(
			new StubFileFetcher( '' ),
			$stopwatch
		);

		$fetcher->fetchFile( 'whatever' );
	}

}
