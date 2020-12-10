<?php namespace Framework\Theme;

class Theme
{
	protected string $lang = 'en';
	/**
	 * @var array|array[]
	 */
	protected array $metas = [];
	protected string $title = '';
	protected string $body = '';
	/**
	 * @var array|string[]
	 */
	protected array $styles = [];
	/**
	 * @var array|string[]
	 */
	protected array $scripts = [];

	public function getLang() : string
	{
		return $this->lang;
	}

	/**
	 * @param string $lang
	 *
	 * @return $this
	 */
	public function setLang(string $lang)
	{
		$this->lang = $lang;
		return $this;
	}

	/**
	 * @return array|array[]
	 */
	public function getMetas() : array
	{
		return $this->metas;
	}

	/**
	 * @param array|array[] $metas
	 *
	 * @return $this
	 */
	public function setMetas(array $metas)
	{
		$this->metas = $metas;
		return $this;
	}

	/**
	 * @param array|string[] $meta
	 *
	 * @return $this
	 */
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

	/**
	 * @param string $title
	 *
	 * @return $this
	 */
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

	/**
	 * @param string $body
	 *
	 * @return $this
	 */
	public function setBody(string $body)
	{
		$this->body = $body;
		return $this;
	}

	/**
	 * @return array|string[]
	 */
	public function getStyles() : array
	{
		return $this->styles;
	}

	/**
	 * @param array|string[] $styles
	 *
	 * @return $this
	 */
	public function setStyles(array $styles)
	{
		$this->styles = $styles;
		return $this;
	}

	/**
	 * @param array|string[] $styles
	 *
	 * @return $this
	 */
	public function appendStyles(array $styles)
	{
		\array_push($this->styles, ...$styles);
		return $this;
	}

	/**
	 * @param array|string[] $styles
	 *
	 * @return $this
	 */
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

	/**
	 * @return array|string[]
	 */
	public function getScripts() : array
	{
		return $this->scripts;
	}

	/**
	 * @param array|string[] $scripts
	 *
	 * @return $this
	 */
	public function setScripts(array $scripts)
	{
		$this->scripts = $scripts;
		return $this;
	}

	/**
	 * @param array|string[] $scripts
	 *
	 * @return $this
	 */
	public function appendScripts(array $scripts)
	{
		\array_push($this->scripts, ...$scripts);
		return $this;
	}

	/**
	 * @param array|string[] $scripts
	 *
	 * @return $this
	 */
	public function prependScripts(array $scripts)
	{
		\array_unshift($this->scripts, ...$scripts);
		return $this;
	}

	public function renderScripts() : string
	{
		$content = '';
		foreach ($this->getScripts() as $script) {
			$content .= '<script src="' . $this->escape($script) . '"></script>' . \PHP_EOL;
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
