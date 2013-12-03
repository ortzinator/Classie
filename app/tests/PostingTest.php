<?php

use Ortzinator\Classie\Models\Posting;
use Mockery as m;
use Way\Tests\Factory;
use Carbon\Carbon;

class PostingTest extends TestCase {
	use Way\Tests\ModelHelpers;

	public function setUp()
	{
		parent::setUp();
		Carbon::setTestNow(Carbon::create(2001, 6, 12, 12));
	}

	public function tearDown()
	{
		m::close();
		Carbon::setTestNow();
	}

	public function testExtendsArdent()
	{
		$posting = Factory::make('Ortzinator\Classie\Models\Posting');

		$this->assertInstanceOf('\LaravelBook\Ardent\Ardent', $posting);
	}

	public function testIsInvalidWithoutUser()
	{
		$posting = Factory::make('Ortzinator\Classie\Models\Posting', ['user_id' => NULL]);

		$this->assertNotValid($posting);
	}

	public function testIsClosedWhenExpiresAtIsPast()
	{
		$posting = Factory::make('Ortzinator\Classie\Models\Posting', ['expires_at' => Carbon::yesterday()]);

		$this->assertTrue($posting->closed);
	}

	public function testIsNoClosedWhenExpiresAtIsFuture()
	{
		$posting = Factory::make('Ortzinator\Classie\Models\Posting', ['expires_at' => Carbon::tomorrow()]);

		$this->assertFalse($posting->closed);
	}

	public function testExpiresAtSetWithNoneSet()
	{
		$posting = new Ortzinator\Classie\Models\Posting;
		$posting->beforeSave();
		$posting->save();

		$this->assertInstanceOf('\Carbon\Carbon', $posting->expires_at);
		$this->assertTrue($posting->expires_at->isFuture());
	}

	public function testExpiresAtSetWithDays()
	{
		$posting = new Ortzinator\Classie\Models\Posting;
		$posting->days = 4;

		$this->assertInstanceOf('\Carbon\Carbon', $posting->expires_at);
		print_r($posting->expires_at->day);
		$this->assertTrue($posting->expires_at->day == 16);
	}
}