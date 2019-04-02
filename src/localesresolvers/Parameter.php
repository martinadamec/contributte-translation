<?php

/**
 * This file is part of the Translette/Translation
 */

declare(strict_types=1);

namespace Translette\Translation\LocalesResolvers;

use Nette;
use Translette;


/**
 * @author Ales Wita
 * @author Filip Prochazka
 */
class Parameter implements ResolverInterface
{
	use Nette\SmartObject;

	/** @var string */
	public static $parameter = 'locale';

	/** @var Nette\Http\IRequest */
	private $request;


	/**
	 * @param Nette\Http\IRequest $request
	 */
	public function __construct(Nette\Http\IRequest $request)
	{
		$this->request = $request;
	}


	/**
	 * @param Translette\Translation\Translator $translator
	 * @return string|null
	 */
	public function resolve(Translette\Translation\Translator $translator): ?string
	{
		return $this->request->getQuery(self::$parameter);
	}
}
