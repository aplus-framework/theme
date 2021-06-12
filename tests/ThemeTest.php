<?php namespace Tests\Theme;

use Framework\Theme\Theme;
use PHPUnit\Framework\TestCase;

final class ThemeTest extends TestCase
{
	protected Theme $theme;

	public function setup() : void
	{
		$this->theme = new Theme();
	}

	public function testLang() : void
	{
		self::assertSame('en', $this->theme->getLang());
		$this->theme->setLang('pt');
		self::assertSame('pt', $this->theme->getLang());
	}

	public function testMetas() : void
	{
		self::assertSame('', $this->theme->renderMetas());
		$this->theme->setMetas([
			['content' => 'object', 'property' => 'og:type'],
			['content' => 'IE=edge', 'http-equiv' => 'X-UA-Compatible'],
		]);
		self::assertSame(
			<<<'EOL'
				<meta content="object" property="og:type">
				<meta content="IE=edge" http-equiv="X-UA-Compatible">

				EOL,
			$this->theme->renderMetas()
		);
		$this->theme->addMeta(['charset' => 'utf-8']);
		self::assertSame(
			<<<'EOL'
				<meta content="object" property="og:type">
				<meta content="IE=edge" http-equiv="X-UA-Compatible">
				<meta charset="utf-8">

				EOL,
			$this->theme->renderMetas()
		);
	}

	public function testTitle() : void
	{
		self::assertSame('', $this->theme->getTitle());
		$this->theme->setTitle('Foo Bar');
		self::assertSame('Foo Bar', $this->theme->getTitle());
		self::assertSame('<title>Foo Bar</title>' . \PHP_EOL, $this->theme->renderTitle());
	}
}
