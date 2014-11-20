<?php 

//TODO just imported from past project, can be used or discarded if not
class UserViewFragment extends ViewFragment {

	private $template = ' ';
	private $values = [];


	public function __set($property_name, $value) {
		$this->values[$property_name] = $value;

	}

	public function render() {
		return parent::fill($this->values, $this->template);
	}
}




?>



















