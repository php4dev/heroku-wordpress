<?php
/**
 * Model class for a WordPress theme or plugin.
 *
 * @author Mike Ems
 * @package Mvied
 */
class Mvied_Model {

	/**
	 * Post
	 *
	 * @var Mvied_Post
	 */
	protected $_post;

	/**
	 * Post ID
	 *
	 * @var int
	 */
	public $ID;

	/**
	 * Name
	 *
	 * @var string
	 */
	public $name;

	/**
	 * Instantiate Model from ID
	 *
	 * @param int $id
	 * @return void
	 */
	public function __construct( $id = null ) {
		if ($id > 0) {
			$this->setPost(new Mvied_Post($id));
		}
	}

	/**
	 * Getter
	 *
	 * @param string $property
	 * @return mixed
	 */
	public function __get( $property ) {
		return $this->getPost()->getPostMeta($property);
	}

	/**
	 * Get Columns (Meta Data)
	 * @return array $columns
	 */
	public function getColumns() {
		$columns = array();
		$reflect = new ReflectionClass($this);
		$properties = $reflect->getProperties(ReflectionProperty::IS_PUBLIC);
		foreach($properties as $property) {
			if (strpos($property, '_') !== 0) {
				$columns[] = $property->getName();
			}
		}
		return $columns;
	}

	/**
	 * Get Post
	 *
	 * @param none
	 * @return Mvied_Post
	 */
	public function getPost() {
		if (!$this->_post && !$this->ID) {
			$this->setPost(new Mvied_Post);
		} else if ($this->ID) {
			$this->setPost(new Mvied_Post($this->ID));
		}
		return $this->_post;
	}

	/**
	 * Set Post
	 *
	 * @param Mvied_Post $post
	 * @return Mvied_Model
	 */
	public function setPost( Mvied_Post $post ) {
		$this->_post = $post;
		$this->ID = $post->ID;
		$this->name = $post->post_title;
		foreach($this->getColumns() as $column) {
			if ($this->$column == null) {
				$this->$column = $post->getPostMeta($column);
			}
		}
		return $this;
	}

	/**
	 * Load from Array
	 *
	 * @param array $array
	 * @return mixed
	 */
	public function load( $array = array() ) {
		foreach($array as $key => $value) {
			//if model has this column
			if ( in_array($key, $this->getColumns()) ) {
				$this->$key = $value;
			}
		}
	}

	/**
	 * Save
	 *
	 * @param none
	 * @return void
	 */
	public function save() {
		$this->_post->save();
		foreach($this->getColumns() as $column) {
			if ( !in_array($column, array('ID','name')) ) {
				$this->_post->updatePostMeta($column, $this->$column);
			}
		}
	}

}