<?php

class Group extends \Eloquent {

	protected $softDelete = true;

	/* Eloquent */
	protected $table = "groups";
	public $timestamps = true;
		
}