<?php namespace Tests\Sample;

use Framework\Theme\Theme;
use PHPUnit\Framework\TestCase;

class ThemeTest extends TestCase
{
	/**
	 * @var Theme
	 */
	protected $theme;

	public function setup() : void
	{
		$this->theme = new Theme();
	}

	public function testLang()
	{
		$this->assertEquals('en', $this->theme->getLang());
		$this->theme->setLang('pt');
		$this->assertEquals('pt', $this->theme->getLang());
	}

	public function testMetas()
	{
		$this->assertEquals('', $this->theme->renderMetas());
		$this->theme->setMetas([
			['content' => 'object', 'property' => 'og:type'],
			['content' => 'IE=edge', 'http-equiv' => 'X-UA-Compatible'],
		]);
		$this->assertEquals(<<<EOL
<meta content="object" property="og:type">
<meta content="IE=edge" http-equiv="X-UA-Compatible">

EOL
			, $this->theme->renderMetas());
		$this->theme->addMeta(['charset' => 'utf-8']);
		$this->assertEquals(<<<EOL
<meta content="object" property="og:type">
<meta content="IE=edge" http-equiv="X-UA-Compatible">
<meta charset="utf-8">

EOL
			, $this->theme->renderMetas());
	}

	public function testTitle()
	{
		$this->assertEquals('', $this->theme->getTitle());
		$this->theme->setTitle('Foo Bar');
		$this->assertEquals('Foo Bar', $this->theme->getTitle());
		$this->assertEquals('<title>Foo Bar</title>' . \PHP_EOL, $this->theme->renderTitle());
	}
}
