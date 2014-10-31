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

}