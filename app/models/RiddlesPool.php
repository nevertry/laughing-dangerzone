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

	protected static $riddle_assign_types = [
		0 => 'Randomized within a pool',
		1 => 'Sequenced within a pool'
	];

	private $riddle_assign_type = 0; // Type 0 = Randomized | Type 1 = Sequenced

	private $max_retry_loop = 3;

/***** Constructor: *****/

	public function __construct()
	{
		# Get minimum pool buffer from Setting Config in database.
		// $this->pool_buffer = 2;

		# Get riddle assign type; Type 0 = Randomized | Type 1 = Sequenced
		// $this->riddle_assign_type = 0;
	}

/***** Main methods below: *****/

	/**
	 * Populate Riddles_Pools table with published riddles.
	 */
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

	/**
	 * Get One Riddle for guest
	 */
	public function getOneRiddle($guestId)
	{
		$riddleId = 0;
		$poolId = $this->getOpenPoolId();
		$riddlesPools = array();

		// Unable to retrieve Riddle ID, maybe because no riddle is published yet?
		if (!$poolId)
		{
			return null;
		}
		else
		{
			# Get Available Riddle List from given $poolId
			$riddlesPools = self::select('id')->where('status', '=', 0)->where('pool_id', '=', $poolId)->get()->keyBy('id');
		}

		if (!$riddlesPools)
		{
			return null;
		}

		switch ($this->riddle_assign_type) {
			case '0':
				$riddlePool = $this->getOneRandomizedRiddle($guestId, $riddlesPools);
				break;
			case '1':
			default:
				$riddlePool = $this->getOneSequencedRiddle($guestId, $riddlesPools);
				break;
		}

		# Assign this riddle pool to guest.
		$riddlePoolData = [
			'guest_id' => $guestId,
			'status' => 1,
		];
		$riddlePool->fill($riddlePoolData);
		$riddlePool->update();

		return $riddlePool->find($riddlePool->id);
	}

	public function getOneRandomizedRiddle($guestId, $riddlesPools)
	{
		$riddlesPools = $riddlesPools->toArray();
		$randomRiddleId = array_rand($riddlesPools, 1);

		$pickedRiddlePool = RiddlesPool::find($randomRiddleId);

		return $pickedRiddlePool;
	}

	public function getOneSequencedRiddle($guestId, $riddlesPools)
	{
		$pickedRiddlePool = $riddlesPools->first();

		return $pickedRiddlePool;
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
		$newId = 1;

		// Get highest pool id with value higher than $lastId (0)
		$lastId = $this->getHighestPoolId();

		if ($lastId)
		{
			$newId = $lastId + 1;
		}

		return $newId;
	}

	/**
	 * Find lowest open pool id.
	 *
	 * @return mixed false/0/n
	 */
	public function getOpenPoolId($retry_loop=0)
	{
		Log::info('Attempt RiddlesPools->getOpenPoolId('.$retry_loop.')');

		# Check loop limitation.
		if ($retry_loop > $this->max_retry_loop)
		{
			return false;
		}

		$riddleId = 0;

		# Find open Pool
		$riddles_pools = RiddlesPool::where('status', '=', 0)->orderBy('pool_id', 'asc')->take(1)->get()->first();

		if ($riddles_pools)
		{
			$riddleId = $riddles_pools->pool_id;
		}
		# Riddle unavailable! Generate NOW!
		else
		{
			// Generate new pools, hoping there are any riddles.
			$this->populatePool();

			// Try Again!
			$try_again = new RiddlesPool();
			$riddleId = $try_again->getOpenPoolId($retry_loop+1);
		}

		Log::info('Got RiddlesPools->getOpenPoolId('.$retry_loop.'): Result: pool_id='.$riddleId);

		return $riddleId;
	}

	public function getHighestPoolId($lastId=0)
	{
		$poolId = 0;

		$highestPoolId = RiddlesPool::select(['pool_id'])->where('pool_id', '>', $lastId)->orderBy('pool_id', 'desc')->take(1)->get()->first();

		if ($highestPoolId)
		{
			$poolId = $highestPoolId->pool_id;
		}

		return (int) $poolId;
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