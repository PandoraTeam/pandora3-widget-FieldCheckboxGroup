<?php
/**
 * @var array $value
 * @var string $name
 * @var array $options
 */
$class = $class ?? '';
$label = $label ?? '';
$attribs = $attribs ?? '';
$disabled = $disabled ?? false;

?><div class="checkbox-group <?= $class ?> <?= $disabled ? 'disabled' : '' ?>" <?= $attribs ?>><?php
	if ($label):
		?><div class="label"><?= htmlentities($label) ?></div><?php
	endif;
	/* ?><select name="<?= $name ?>" <?= ($class) ? 'class="'.$class.'"' : '' ?> <?= $attribs ?>><?php */
	foreach ($options as $optionValue => $optionParams):
		if (is_scalar($optionParams)) {
			$optionParams = ['title' => $optionParams];
		}
		$optionParams = (object) $optionParams;
		$optionAttribs = $optionParams->attribs ?? '';
		$optionDisabled = $optionParams->disabled ?? false;
		if ($optionDisabled) {
			$optionAttribs .= ' disabled';
		}
		$isChecked = in_array(''.$optionValue,$value);
		?><label><?php
			?><div class="checkbox-wrap <?= $optionDisabled ? 'disabled' : '' ?>"><?php
				?><input class="checkbox" type="checkbox" name="<?= $name ?>[<?= $optionValue ?>]" value="1" <?= ($isChecked) ? 'checked' : '' ?> <?= $optionAttribs ?>><?php
				?><i class="checkbox-icon"></i><?php
				?><span class="checkbox-label"><?= htmlentities($optionParams->title) ?></span><?php
			?></div><?php
		?></label><?php
	endforeach;

?></div><?php
