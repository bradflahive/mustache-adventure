<?php 


class CommentViewFragmentTest extends ViewFragment {


  private $template =<<<html
    <div class="post" data-comment-id="{{comment_id}}">
      <img src="/images/profile-brad.jpg">
      <input type="hidden" name="comment_id" value="{{comment_id}}">
      <input type="hidden" name="user_id" value="{{user_id}}">
      <div class="body">
        <div class="user_name">{{user_name}}</div>
        <div class="message">{{message}}</div>
        <button class="remove" {{remove_hidden}} >Delete</button>
        <div class="points _3" {{points_hidden}} data-name="points_awarded">
          <div class="_5" title="Give 5 points!"></div>
          <div class="_4" title="Give 4 points!"></div>
          <div class="_3" title="Give 3 points!"></div>
          <div class="_2" title="Give 2 points!"></div>
          <div class="_1" title="Give 1 point!"></div>
          <div class="_0" title="Give 0 points!"></div>
        </div>
        <div class="display-points">{{total}}</div>
      </div>
    </div>
html;
					

	//from the controller, put in values into this array by key/value pairs
	//be sure to use the same names used in the template above						
	private $values = [];


	public function __set($property_name, $value) {
		$this->values[$property_name] = $value;

	}

	//This returns a string.  For this to work, will have to have passed key/value pairs.
	public function render() {
		return parent::fill($this->values, $this->template);
	}
}


















