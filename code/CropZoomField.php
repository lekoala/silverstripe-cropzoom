<?php

class CropZoomField extends FormField {

	public function __construct($name, $title = null, $value = null, $imageID = null, $form = null) {
		$this->setImage($imageID);

		parent::__construct($name, ($title === null) ? $name : $title, $value, $form);
	}

	public function Field($properties = array()) {
		Requirements::javascript(FRAMEWORK_DIR . '/thirdparty/jquery/jquery.js');
		Requirements::javascript(FRAMEWORK_DIR . '/thirdparty/jquery-entwine/dist/jquery.entwine-dist.js');
		Requirements::javascript('cropzoom/javascript/jquery.cropzoom.js');
		Requirements::javascript('cropzoom/javascript/CropZoomField.js');
		Requirements::css('cropzoom/css/jquery.cropzoom.css');

		$obj = ($properties) ? $this->customise($properties) : $this;

		return $obj->renderWith($this->getTemplates());
	}

	public function setImage($imageID) {
		if ($imageID) {
			$this->ImageID = $imageID;
		}
	}

	/**
	 * @return Image
	 */
	public function getImage() {
		if ($this->ImageID) {
			return Image::get()->byID($this->ImageID);
		}
	}
	
	public function ImageID() {
		return $this->ImageID;
	}

	public function JsonOptions() {
		$image = $this->getImage();

		$width = $image->getWidth();
		$height = $image->getHeight();

		$targetWidth = 512;

		if ($width > $targetWidth) {
			$ratio = $width / $targetWidth;
		} else {
			$ratio = $targetWidth / $width;
		}

		$opts = array(
			'width' => $targetWidth,
			'height' => round($height * $ratio),
			'image' => array(
				'source' => $image->Link(),
				'width' => $image->getWidth(),
				'height' => $image->getHeight(),
			)
		);
		return htmlspecialchars(json_encode($opts), ENT_QUOTES, 'UTF-8');
	}

}
