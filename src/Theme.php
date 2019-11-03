<?php namespace Framework\Theme;

class Theme
{
	protected $lang = 'en';
	protected $metas = [];
	protected $title = '';
	protected $body = '';
	protected $styles = [];
	protected $scripts = [];

	public function getLang() : string
	{
		return $this->lang;
	}

	public function setLang(string $lang)
	{
		$this->lang = $lang;
		return $this;
	}

	public function getMetas() : array
	{
		return $this->metas;
	}

	public function setMetas(array $metas)
	{
		$this->metas = $metas;
		return $this;
	}

	public function addMeta(array $meta)
	{
		$this->metas[] = $meta;
		return $this;
	}

	public function renderMetas() : string
	{
		$content = '';
		foreach ($this->getMetas() as $meta) {
			$part = '';
			foreach ($meta as $key => $value) {
				$part .= $this->escape($key) . '="' . $this->escape($value) . '" ';
			}
			$content .= '<meta ' . \rtrim($part) . '>' . \PHP_EOL;
		}
		return $content;
	}

	public function getTitle() : string
	{
		return $this->title;
	}

	public function setTitle(string $title)
	{
		$this->title = $title;
		return $this;
	}

	public function renderTitle() : string
	{
		return '<title>' . $this->escape($this->getTitle()) . '</title>' . \PHP_EOL;
	}

	public function getBody() : string
	{
		return $this->body;
	}

	public function setBody(string $body)
	{
		$this->body = $body;
		return $this;
	}

	public function getStyles() : array
	{
		return $this->styles;
	}

	public function setStyles(array $styles)
	{
		$this->styles = $styles;
		return $this;
	}

	public function appendStyles(array $styles)
	{
		\array_push($this->styles, ...$styles);
		return $this;
	}

	public function prependStyles(array $styles)
	{
		\array_unshift($this->styles, ...$styles);
		return $this;
	}

	public function renderStyles() : string
	{
		$content = '';
		foreach ($this->getStyles() as $style) {
			$content .= '<link rel="stylesheet" type="text/css" href="' . $this->escape($style) . '">' . \PHP_EOL;
		}
		return $content;
	}

	public function getScripts() : array
	{
		return $this->scripts;
	}

	public function setScripts(array $scripts)
	{
		$this->scripts = $scripts;
		return $this;
	}

	public function appendScripts(array $scripts)
	{
		\array_push($this->scripts, ...$scripts);
		return $this;
	}

	public function prependScripts(array $scripts)
	{
		\array_unshift($this->scripts, ...$scripts);
		return $this;
	}

	public function renderScripts() : string
	{
		$content = '';
		foreach ($this->getScripts() as $script) {
			$content .= '<script src="' . $this->escape($script)
				. '" type="text/javascript"></script>' . \PHP_EOL;
		}
		return $content;
	}

	public function escape(?string $text, string $encoding = 'UTF-8') : string
	{
		$text = (string) $text;
		return empty($text)
			? $text
			: \htmlspecialchars($text, \ENT_QUOTES | \ENT_HTML5, $encoding);
	}
}
