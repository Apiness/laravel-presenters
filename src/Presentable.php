<?php namespace Zaltana\Presenters;

trait Presentable {

	protected $presenterInstance; // Define one presenter per instance

	/**
	 * Return the presenter.
	 */
	public function present()
	{
		if (!isset($this->presenter)) {
			$this->presenter = $this->presenterClass();
		}

		if (!class_exists($this->presenter)) {
			throw new PresenterException('Unknown presenter class! You have to set or check the property for the presenter class, or create a '.$this->presenterClass().' class.');
		}

		if (!$this->presenterInstance) {
			$this->presenterInstance = new $this->presenter($this);
		}

		return $this->presenterInstance;
	}

	private function presenterClass()
	{
		return static::class.'Presenter';
	}

}
