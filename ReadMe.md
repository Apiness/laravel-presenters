# Zaltana Presenters

[![Build Status](https://travis-ci.org/marfurt/zaltana-presenters.svg?branch=master)](https://travis-ci.org/marfurt/zaltana-presenters)

> **Note:** This package is part of the _Zaltana components_, a serie of small packages made to provide useful features to Laravel projects.

This package provides a view presenter layer for models when a bit of logic needs to be performed before some data is displayed.


## Requirements

- PHP 5.6+


## Installation
	

Pull this package in through Composer, by updating the `composer.json` as follows:


```json
"repositories" : [
	{
		"type": "vcs",
		"url": "https://github.com/marfurt/zaltana-presenters"
	}
],
"require" : {
	"zaltana/presenters": "~1.0"
}
```


## Usage

You can create a Presenter as follows:

```php
use Zaltana\Presenters\Presenter;

class ProfilePresenter extends Presenter {

	public function fullName()
	{
		return $this->first . ' ' . $this->last;
	}

	public function birthdate()
    {
		return $this->entity->birthdate->formatLocalized('%e %B %Y');
	}

}
```

You need to pull in the `Zaltana\Presenters\Presentable` trait on your class, which will automatically instantiate your presenter class.

```php
use Zaltana\Presenters\Presentable;

class Profile {

	use Presentable;

}
```

The Presenter class doesn't need to be set if you follow the convention `<Class>Presenter`. If you prefer to choose another name, you have to set the `presenter` property.
	

```php
protected $presenter = CustomProfilePresenter::class;
```

Now, you can use it within your view as follows:

```blade
<p>Hello {{ $profile->present()->fullName }}, welcome to the World!</p>
```


## License

This library is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
