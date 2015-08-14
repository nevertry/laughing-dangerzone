<?php

class Riddle extends \Eloquent {
	protected $table = "riddles";

	public $timestamps = true;

	protected $fillable = ['id', 'type', 'content', 'question', 'answer', 'clues', 'publish_status', 'creator_id', 'editor_id'];

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
}