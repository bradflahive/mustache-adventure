<?php 


class CommentViewFragment extends ViewFragment {


  private $template =<<<html
    <div class="post" data-comment-id="{{comment_id}}">
      <img src="/images/profile-brad.jpg">
      <input type="hidden" name="comment_id" value="{{comment_id}}">
      <input type="hidden" name="user_id" value="{{user_id}}">
      <div class="body">
        <div class="user_name">{{user_name}}</div>
        <div class="message">{{message}}</div>
        <div class="remove" {{remove_hidden}} >X</div>
        <form {{points_hidden}} action="">
          <select name="points_awarded" id="">
            <option value="0">0</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
          </select>
        </form>
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


















