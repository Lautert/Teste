<?php
	require_once '../basics.php';

	require_once 'Composite.php';
	require_once 'Component.php';
	require_once 'ComponentIterator.php';
	require_once 'Element.php';
	require_once 'ElementIterator.php';

	$paragraph = new Element('Paragraph');
	$text = new Element('Text');
	$font = new Element('Font');
	$img = new Element('Image');

	pr($font->getElements());

	$elements1 = new ElementIterator([
		$img,
	]);

	$component1 = new Component($elements1);
	pr($component1->getElements());

	$elements2 = new ElementIterator([
		$paragraph,
		$text,
		$font,
	]);
	$component2 = new Component($elements2);
	pr($component2->getElements());

	$components = new ComponentIterator([
		$component1,
		$component2,
	]);

	$composite = new Composite($components);
	pr($composite->getElements());


