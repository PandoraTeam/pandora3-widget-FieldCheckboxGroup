<?php
namespace Pandora3\Widgets\FieldCheckboxGroup;

use Pandora3\Widgets\FormField\FormField;

/**
 * Class FieldCheckboxGroup
 * @package Pandora3\Widgets\FieldCheckboxGroup
 */
class FieldCheckboxGroup extends FormField {

	/** @var array $options */
	protected $options;
	
	/** @var bool $formatFlags */
	protected $formatFlags;

	/**
	 * @param string $name
	 * @param mixed $value
	 * @param array $options
	 * @param array $context
	 *
	 */
	public function __construct(string $name, $value, array $options = [], array $context = []) {
		$this->options = $options;
		$this->formatFlags = $context['flags'] ?? false;
		parent::__construct($name, $value, $context);
	}
	
	/**
	 * @param string $name
	 * @param mixed $value
	 * @param array $context
	 * @return static
	 */
	public static function create(string $name, $value, array $context = []) {
		return new static($name, $value, $context['options'] ?? [], $context);
	}

	/**
	 * {@inheritdoc}
	 */
	protected function getView(): string {
		return __DIR__.'/Views/Widget';
	}

	/**
	 * {@inheritdoc}
	 */
	public function setValue($value): void {
		if (is_bool($value)) {
			$value = (int) $value;
		}
		if (!is_array($value)) {
			if ($this->formatFlags) {
				$flags = (int) $value;
				$value = [];
				for ($i = 1; $i <= $flags; $i *= 2) {
					if ($i & $flags) {
						$value[] = $i;
					}
				}
			} else {
				$value = $value ? [$value] : [];
			}
		}
		parent::setValue($value);
	}

	/**
	 * {@inheritdoc}
	 */
	protected function getContext(): array {
		return array_replace( parent::getContext(), [
			'options' => $this->options
		]);
	}

	/**
	 * {@inheritdoc}
	 */
	protected function beforeRender(array $context): array {
		if ($context['disabled'] ?? false) {
			$attribs = $context['attribs'] ?? '';
			$context['attribs'] = $attribs.' disabled';
		}
		return $context;
	}
	
}