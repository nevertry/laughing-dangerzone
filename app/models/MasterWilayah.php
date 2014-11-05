<?php

class MasterWilayah extends \Eloquent {

	protected $table = "master_wilayah";

	protected $fillable = [];

	public $timestamps = true;

	public function parent()
	{
		return $this->belongsTo('MasterWilayah', 'parent_id');
	}

	public function children()
	{
		return $this->hasMany('MasterWilayah', 'parent_id');
	}

	public function parentRecursive()
	{
		return $this->parent()->with('parentRecursive');
	}

	public function childrenRecursive()
	{
		return $this->children()->with('childrenRecursive');
	}

	static public function parentOnly($key_value_fields = array())
	{
		$key_value_fields = (count($key_value_fields) > 0) ? $key_value_fields : ['id', 'name'];
		return self::select($key_value_fields)->where('parent_id', '=', 0);
	}
}