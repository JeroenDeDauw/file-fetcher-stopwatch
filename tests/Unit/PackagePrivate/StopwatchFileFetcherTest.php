<?php

declare( strict_types = 1 );

namespace FileFetcher\Stopwatch\Tests\Unit\PackagePrivate;

use FileFetcher\CallbackFileFetcher;
use FileFetcher\FileFetchingException;
use FileFetcher\InMemoryFileFetcher;
use FileFetcher\Stopwatch\PackagePrivate\StopwatchFileFetcher;
use FileFetcher\ThrowingFileFetcher;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Stopwatch\Stopwatch;

/**
 * @covers \FileFetcher\Stopwatch\PackagePrivate\StopwatchFileFetcher
 *
 * @licence BSD-3-Clause
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
class StopwatchFileFetcherTest extends TestCase {

	private const STOPWATCH_CATEGORY = 'file_fetcher';

	public function testReturnsSameValueAsInnerFetcher() {
		$fetcher = new StopwatchFileFetcher(
			new InMemoryFileFetcher( [
				'testFile' => 'MJAU'
			] ),
			new Stopwatch(),
			'category'
		);

		$this->assertSame(
			'MJAU',
			$fetcher->fetchFile( 'testFile' )
		);
	}

	public function testRecordsFetching() {
		$stopwatch = new Stopwatch();

		$fetcher = new StopwatchFileFetcher(
			new InMemoryFileFetcher( [
				'testFile' => 'MJAU'
			] ),
			$stopwatch,
			self::STOPWATCH_CATEGORY
		);

		$fetcher->fetchFile( 'testFile' );

		$this->assertSame(
			self::STOPWATCH_CATEGORY,
			$stopwatch->getEvent( 'testFile' )->getCategory()
		);
	}

	public function testRecordsFetchingWhenAnExceptionIsThrown() {
		$stopwatch = $this->createMock( Stopwatch::class );
		$stopwatch->expects( $this->once() )->method( 'start' );
		$stopwatch->expects( $this->once() )->method( 'stop' );

		$fetcher = new StopwatchFileFetcher(
			new ThrowingFileFetcher(),
			$stopwatch,
			'category'
		);

		$this->expectException( FileFetchingException::class );
		$fetcher->fetchFile( 'testFile' );
	}

	public function testDurationIsRecorded() {
		$stopwatch = new Stopwatch();

		$fetcher = new StopwatchFileFetcher(
			new CallbackFileFetcher( function() {
				usleep( 1000 );
				return '';
			} ),
			$stopwatch,
			'category'
		);

		$fetcher->fetchFile( 'testFile' );

		$this->assertGreaterThanOrEqual(
			1,
			$stopwatch->getEvent( 'testFile' )->getDuration()
		);
	}

	public function testCustomCategoryIsUsed() {
		$stopwatch = new Stopwatch();

		$fetcher = new StopwatchFileFetcher(
			new InMemoryFileFetcher( [
				'testFile' => 'MJAU'
			] ),
			$stopwatch,
			'customCategory'
		);

		$fetcher->fetchFile( 'testFile' );

		$this->assertSame(
			'customCategory',
			$stopwatch->getEvent( 'testFile' )->getCategory()
		);
	}

}
