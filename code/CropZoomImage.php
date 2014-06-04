<?php

class CropZoomImage extends DataExtension {

	private static $db = array(
	);

	private static $defaults = array(
	);
	
	public function updateCMSFields(FieldList $fields) {
		$f = new CropZoomField(
			$name = "CropZoom",
			$title = "Crop point",
			$value = null,
			$imageID = $this->owner->ID
		);
		$fields->addFieldToTab("Root.Main", $f);
	}
	
	public function onBeforeWrite() {
		parent::onBeforeWrite();
	}
}