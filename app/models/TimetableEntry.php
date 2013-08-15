<?php


class TimetableEntry extends Eloquent {

	protected $table = 'timetable_entries';

	
	public function instructor()
	{
		return $this->belongsTo('Employee', 'employee_id');
	}

	public function batch()
	{
		return $this->belongsTo('Batch','batch_id');
	}

	public function subject()
	{
		return $this->belongsTo('Subject','subject_id');
	}

}