<?php

class RiddlesAnswer extends \Eloquent {
	protected $table = "riddles_answers";

	public $timestamps = true;

	protected $fillable = ['id', 'guest_id', 'riddle_id', 'answer', 'status'];

	protected $hidden = ['created_at', 'updated_at'];

	protected static $statuses = [
		0 => 'Incorrect Answer',
		1 => 'Correct Answer'
	];
}