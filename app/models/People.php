<?php
class People extends Eloquent
{
	public $timestamps = false;
	protected $table = "people";
	protected $guarded = array("*");
	protected $fillable = array("Name", "Age", "RecordDate");
}