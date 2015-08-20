<?php

class Riddle extends \Eloquent {
	protected $table = "riddles";

	public $timestamps = true;

	protected $fillable = ['id', 'type', 'content', 'question', 'answer', 'clues', 'publish_status', 'creator_id', 'editor_id'];

	protected $appends = array('publish_text', 'clues_box');

	protected static $allowed_content_types = [
		'text' => "Text",
		'image' => "Image",
		'video' => "Video",
		'audio' => "Audio"
	];

	protected static $allowed_publish_status = [
		0 => "Not Published",
		1 => "Published",
	];

	private static $rules = [
		'type' => 'required|in:text,image,video,audio',
		'publish_status' => 'required|integer|min:0|max:1',
		'content' => 'required',
		'question' => 'required',
		'answer' => 'required',
		'clues' => 'required',
	];

	protected $hidden = ['clues', 'answer', 'creator_id', 'editor_id', 'created_at', 'updated_at', 'publish_text', 'publish_status'];

	public function getCluesBoxAttribute()
	{
		$clues = $this->clues;
		$clues_box = array();

		if (!empty($clues))
		{
			return explode(',', $clues);
		}

		return $clues_box;
	}

	public function getPublishTextAttribute()
	{
		if (array_key_exists($this->publish_status, self::$allowed_publish_status))
		{
			return self::$allowed_publish_status[$this->publish_status];
		}

		return '(unknown)';
	}

	public static function getContentTypes()
	{
		return self::$allowed_content_types;
	}

	public static function getPublishStatuses()
	{
		return self::$allowed_publish_status;
	}

	public static function validate($data, $external_rules=array())
	{
		$rules = (count($external_rules)) ? $external_rules : self::$rules;

		return Validator::make($data, $rules);
	}

	public static function getAllRiddles($parameters=array())
	{
		$model = new Riddle();
		extract($parameters);

		if (isset($limit))
			$model = $model->limit($limit);

		if (isset($offset))
			$model = $model->offset($offset);

		if (isset($orderBy) && isset($orderByField))
			$model = $model->orderBy($orderByField, $orderBy);
		else
			$model = $model->orderBy('created_at', 'desc');

		$model = $model->get();

		return $model;
	}
}