<?php

use Ortzinator\Classie\Models\Posting;
use Mockery as m;
use Way\Tests\Factory;

class PostingTest extends TestCase {
	use Way\Tests\ModelHelpers;

	private function prepareForTests()
	{
		Artisan::call('migrate', ['--package' => 'cartalyst/sentry']);
		Artisan::call('migrate');
	}

	public function setUp()
	{
		parent::setUp();

		$this->prepareForTests();
	}

	public function tearDown()
	{
		m::close();
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

	// public function testIsValidWithValidData()
	// {
	// 	$posting = Factory::make('Ortzinator\Classie\Models\Posting');

	// 	$mock = m::mock('Illuminate\Validation\PresenceVerifierInterface');
	// 	$mock->shouldReceive('getCount')->once()->with('users', 'id', $posting->user_id, 
	// 		null, null, array())->andReturn(true);
	// 	$mock->shouldReceive('getCount')->once()->with('categories', 'id', $posting->category_id, 
	// 		null, null, array())->andReturn(true);

	// 	$v = Validator::make($posting->getAttributes(), $posting::$rules);
	// 	$v->setPresenceVerifier($mock);

	// 	$this->assertTrue($v->passes());
	// }

	// public function testIsInvalidWithInvalidCategoryId()
	// {
	// 	$posting = Factory::make('Ortzinator\Classie\Models\Posting');

	// 	$mock = m::mock('Illuminate\Validation\PresenceVerifierInterface');
	// 	$mock->shouldReceive('getCount')->once()->with('users', 'id', $posting->user_id, 
	// 		null, null, array())->andReturn(true);
	// 	$mock->shouldReceive('getCount')->once()->with('categories', 'id', $posting->category_id, 
	// 		null, null, array())->andReturn(false);

	// 	$v = Validator::make($posting->getAttributes(), $posting::$rules);
	// 	$v->setPresenceVerifier($mock);

	// 	$this->assertFalse($v->passes());
	// }

	// public function testIsInvalidWithInvalidUserId()
	// {
	// 	$posting = Factory::make('Ortzinator\Classie\Models\Posting');

	// 	$mock = m::mock('Illuminate\Validation\PresenceVerifierInterface');
	// 	$mock->shouldReceive('getCount')->once()->with('users', 'id', $posting->user_id, 
	// 		null, null, array())->andReturn(false);
	// 	$mock->shouldReceive('getCount')->once()->with('categories', 'id', $posting->category_id, 
	// 		null, null, array())->andReturn(true);

	// 	$v = Validator::make($posting->getAttributes(), $posting::$rules);
	// 	$v->setPresenceVerifier($mock);

	// 	$this->assertFalse($v->passes());
	// }

	public function testIsClosedWhenExpiresAtIsPast()
	{
		$posting = Factory::make('Ortzinator\Classie\Models\Posting', ['expires_at' => \Carbon\Carbon::yesterday()]);

		$this->assertTrue($posting->closed);
	}

	public function testIsNoClosedWhenExpiresAtIsFuture()
	{
		$posting = Factory::make('Ortzinator\Classie\Models\Posting', ['expires_at' => \Carbon\Carbon::tomorrow()]);

		$this->assertFalse($posting->closed);
	}
}