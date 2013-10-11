<?php

use Mockery as m;
use Way\Tests\Factory;

class HelpersTest extends TestCase {

	public function tearDown()
	{
		m::close();
	}

	public function testAddDays()
	{
		$now = new DateTime('2000-01-01');
		$later = new DateTime('2000-01-03');
		$mock = m::mock('DateTime');
		$mock->shouldReceive('add')->once()->andReturn($later);
		$this->assertEquals(addDays($mock, 2), $later);

		$now = new DateTime('2000-01-01');
		$later = new DateTime('2000-01-09');
		$mock = m::mock('DateTime');
		$mock->shouldReceive('add')->once()->andReturn($later);
		$this->assertEquals(addDays($mock, 8), $later);
	}

	public function testNullOrEmpty()
	{
		$this->assertTrue(nullOrEmpty(NULL));
		$this->assertTrue(nullOrEmpty(''));
		$this->assertTrue(nullOrEmpty('   '));
		$this->assertFalse(nullOrEmpty('foobar'));
	}
}