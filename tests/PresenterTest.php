<?php namespace Tests;

use PHPUnit_Framework_TestCase;
use Zaltana\Presenters\Presentable;
use Zaltana\Presenters\PresenterException;

class PresenterTest extends PHPUnit_Framework_TestCase {


	/** @test */
	public function it_fetches_a_default_presenter()
	{
		$entity = new PresentedClass();

		$this->assertInstanceOf(PresentedClassPresenter::class, $entity->present());
	}
	
	/** @test */
	public function it_fetches_a_custom_presenter()
	{
		$entity = new PresentedClassWithCustomPresenterName();

		$this->assertInstanceOf(PresentedClassPresenter::class, $entity->present());
	}
	
	/** @test */
	public function it_throws_an_exception_on_invalid_presenter()
	{
		$entity = new PresentedClass();
		$entity->presenter = 'InvalidPresenterClass';

		$this->expectException(PresenterException::class);

		$entity->present();
	}

	/** @test */
	public function it_caches_the_presenter_for_future_use()
	{
		$entity = new PresentedClass();

		$first = $entity->present();
		$other = $entity->present();

		$this->assertEquals($first, $other, "Presenters of a same object should be cached.");
	}

}

class PresentedClass {

	use Presentable;

}

class PresentedClassWithCustomPresenterName {

	use Presentable;

	protected $presenter = PresentedClassPresenter::class;

}

class PresentedClassPresenter {}
