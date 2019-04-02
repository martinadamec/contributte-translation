<?php

/**
 * This file is part of the Translette/Translation
 */

declare(strict_types=1);

namespace Translette\Translation\Tests\Tests\LocalesResolvers;

use Nette;
use Tester;
use Translette;

$container = require __DIR__ . '/../../bootstrap.php';


/**
 * @author Ales Wita
 */
class Parameter extends Translette\Translation\Tests\AbstractTest
{
	public function test01(): void
	{
		Tester\Assert::same('', $this->resolve(''));
		Tester\Assert::same('en', $this->resolve('en'));
		Tester\Assert::same('cs', $this->resolve('cs'));
	}


	/**
	 * @internal
	 *
	 * @param string|null $locale
	 * @return string|null
	 */
	private function resolve(?string $locale): ?string
	{
		$request = new Nette\Http\Request(new Nette\Http\UrlScript('https://www.example.com/?' . Translette\Translation\LocalesResolvers\Parameter::$parameter . '=' . $locale));

		$resolver = new Translette\Translation\LocalesResolvers\Parameter($request);
		$translatorMock = \Mockery::mock(Translette\Translation\Translator::class);

		return $resolver->resolve($translatorMock);
	}


	public function test02(): void
	{
		$request = new Nette\Http\Request(new Nette\Http\UrlScript('https://www.example.com'));

		$resolver = new Translette\Translation\LocalesResolvers\Parameter($request);
		$translatorMock = \Mockery::mock(Translette\Translation\Translator::class);

		Tester\Assert::null($resolver->resolve($translatorMock));
	}
}


(new Parameter($container))->run();
