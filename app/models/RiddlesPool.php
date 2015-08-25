<?php

class RiddlesPool extends \Eloquent {
	protected $table = "riddles_pools";

	public $timestamps = true;

	protected $fillable = ['id', 'pool_id', 'riddle_id', 'guest_id', 'status'];

	protected $hidden = ['created_at', 'updated_at'];

	private $pool_buffer = 2;

	private $picked_pool_id = 0;

	protected static $riddle_pool_status = [
		0 => "Published, ready to assign.",
		1 => "Assigned to guest.",
		2 => "Unavailable.",
	];

	/***** Constructor: *****/

	public function __construct()
	{
		# Get minimum pool buffer from Setting Config in database.
		// $this->pool_buffer = 2;
	}

	/***** Main methods below: *****/

	public function populatePool($buffer=0)
	{
		// Get available riddles ids
		$publishedRiddles = Riddle::getPublishedRiddleIds();

		// Check for buffer loop
		if ($buffer <= $this->pool_buffer)
		{
			$buffer = $this->pool_buffer;
		}

		// Mass assign to $table.
		for ($worker=0; $worker < $buffer; $worker++) { 
			// Get largest pool id.
			$newPoolId = self::getNewPoolId();

			// Generate new pool
			$newPool = self::generatePool($newPoolId, $publishedRiddles);
		}
	}

	/***** Getter/Setter methods below: *****/

	public function set_pool_buffer($number=2)
	{
		if ($number < 2)
		{
			$number = 2;
		}

		$this->set_attribute('pool_buffer', $number);
	}

	public function get_pool_buffer()
	{
		return $this->get_attribute('pool_buffer');
	}

	/***** Complementary methods below: *****/

	public function getNewPoolId()
	{
		$lastId = 0;
		$newId = 1;

		// Get highest pool id with value higher than $lastId (0)
		$lastRecord = $this->getHighestPoolId($lastId);

		if ($lastRecord)
		{
			$lastId = (int) $lastRecord->pool_id;
			$newId = $lastId + 1;
		}

		return $newId;
	}

	public function getHighestPoolId($lastId)
	{
		return RiddlesPool::select(['pool_id'])->where('pool_id', '>', $lastId)->orderBy('pool_id', 'desc')->take(1)->get()->first();
	}

	public function generatePool($poolId, $riddles)
	{
		$created_pool = [];

		foreach ($riddles as $k_riddle => $riddle) {
			$data = [
				'pool_id' => $poolId,
				'riddle_id' => $riddle->id,
			];

			// Create new Pool
			$pool = new RiddlesPool();
			$pool->fill($data);
			$pool->save();

			array_push($created_pool, $poolId);
		}

		return $created_pool;
	}
}