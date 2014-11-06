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

	static public function parentLevelOnly($key_value_fields = array(), $max_level = 2)
	{
		$key_value_fields = (count($key_value_fields) > 0) ? $key_value_fields : ['id', 'name'];
		return self::select($key_value_fields)->where('parent_id', '<', $max_level);
	}

	static public function forDropdownSelect()
	{
		return self::getChildFlat(self::get_child(0,2));
	}

	static public function getChildFlat($nested_array, $passed_array=array(), $levelCurrent=0)
	{
		$my_array_so_far = $passed_array;

		foreach ($nested_array as $key => $value) {
			$current_items = array();

			$current_items['id']          = $nested_array[$key]['id'];
			$current_items['name']        = prependChar($nested_array[$key]['name'], '-', $levelCurrent);

			$current_items['parent_id']   = $nested_array[$key]['parent_id'];
			$current_items['level']       = $nested_array[$key]['level'];

			array_push($my_array_so_far, $current_items);

			if ($nested_array[$key]['child'])
			{
				$my_array_so_far = self::getChildFlat($nested_array[$key]['child'], $my_array_so_far, $levelCurrent+1);
			}
		}
		return $my_array_so_far;
	}

	static public function get_child($parent_id = 0, $levelLimit = 2, $levelCurrent = 0)
	{
		$wilayahs = self::where('parent_id', '=', $parent_id)->get()->toArray();

		if (count($wilayahs)){
			$new_child = array();
			foreach ($wilayahs as $parent_key => $parent_value) {
				// Stop when this level is higher than limit
				$levelCurrent = $parent_value['level'];
				if ($levelCurrent > $levelLimit) break;

				$child_items['id']          = $parent_value['id'];
				$child_items['name']        = prependChar($parent_value['name'], '--', $levelCurrent-1);
				$child_items['parent_id']   = $parent_value['parent_id'];
				$child_items['level']       = $parent_value['level'];

				// Have more children..
				$child_items['child']       = self::get_child($parent_value['id'], $levelLimit, $levelCurrent);

				array_push($new_child, $child_items);
			}

			return $new_child;
		}

		return [];
	}

	static public function setWilayahLevel($parent_id)
	{
		$level = 0;

		if ($parent_id > 0)
		{
			$parent = self::find($parent_id);
			$level = (int) $parent->level + 1;
		}

		return $level;
	}

	static public function validate($fields)
	{
		$rules = array(
			'code'			=> 'required',
			'name'			=> 'required',
			'description'	=> 'required',
			'parent_id'		=> 'required',
			);
		return Validator::make($fields, $rules);
	}

	// public function isValid()
	// {
	// 	return Validator::make(
	// 		$this->toArray,
	// 		[
	// 			'code'			=> 'required',
	// 			'name'			=> 'required',
	// 			'description'	=> 'required',
	// 			'parent_id'		=> 'required'
	// 		])
	// 		->passes();
	// }
}
