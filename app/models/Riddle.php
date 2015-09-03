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

	public static function getStatusIdByText($status)
	{
		foreach (self::$allowed_publish_status as $key => $value) {
			if (strtolower($value) == strtolower($status))
			{
				return $key;
			}
		}
		return -1;
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

	public function getRandomRiddle()
	{
		# TRY = 0;
		# GET_ONE: Select 1 riddle from riddles_pools where taken_status = 0
		# # IF [Not Found], update riddles_pools set taken_status = 0
		# # # goto: GET_ONE (TRY+1)
		# # ELSE, return riddle_id.

		# PREPARE_NEXT:
		# # CEK_LEFTOVER: Is there ANY riddles_pools with status = 0?
		# # # IF [Not Found], POPULATE_POOLS

		# POPULATE_POOLS: truncate table, insert Every_Riddles into Riddle_Pools.
	}

	public static function getPublishedRiddleIds()
	{
		Log::info('getPublishedRiddleIds: Getting published riddle ids...');

		return self::select('id')->where('publish_status', '=', 1)->get()->keyBy('id');
	}

	public static function getCount($status='Published')
	{
		if (strtolower($status) == 'all')
		{
			return self::count();
		}

		return self::where('publish_status', '=', self::getStatusIdByText($status))->count();
	}
}