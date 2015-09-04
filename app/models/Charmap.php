<?php

class Charmap extends \Eloquent {
	protected $table = "charmaps";

	public $timestamps = true;

	protected $fillable = ['letter', 'symbol'];

	protected $hidden = ['created_at', 'updated_at'];

	protected static $rules = [
		'letter' => 'required',
		'symbol' => 'required',
	];

	public static function validate($data, $external_rules=array())
	{
		$rules = (count($external_rules)) ? $external_rules : self::$rules;

		return Validator::make($data, $rules);
	}

	/**
	 * Generate Clues
	 *
	 * @param integer riddleId string.
	 * @return string Automated clues.
	 */
	public static function generateClues($riddleId)
	{
		try
		{
			$riddle = Riddle::findOrFail($riddleId);
			$riddle->clues = self::getAutoClues($riddle->answer, false, true);
			$riddle->save();
		}
		catch (Exception $e)
		{
			$riddle = false;
		}

		return $riddle;
	}


	/**
	 * Get Autoclues
	 *
	 * @param string Original string.
	 * @return string Automated clues.
	 */
	public static function getAutoClues($string, $asHtml=false, $implode=false)
	{
		$str_split = str_split($string);
		$symbolCollections = array();

		if (count($str_split))
		{
			foreach ($str_split as $key => $value) {
				$currentSymbol = self::getSymbol($value, $asHtml);

				if (!empty($currentSymbol) )
				{
					$currentSymbol = $currentSymbol;
				}
				else
				{
					$currentSymbol = '_';
				}

				array_push($symbolCollections, $currentSymbol);
			}
		}

		if ($implode && ($implode !== true))
		{
			$symbolCollections = implode($implode, $symbolCollections);
		}
		elseif ($implode === true)
		{
			$symbolCollections = implode(',', $symbolCollections);
		}
		else
		{
			// Stay Still
			// $symbolCollections = $symbolCollections;
		}

		return $symbolCollections;
	}

	/**
	 * Get symbol of a letter.
	 *
	 * @param string $letter Letter of symbol to find.
	 * @param boolean $asHtml Return as HTML entities?
	 * @return string Symbolic
	 */
	public static function getSymbol($letter, $asHtml=false)
	{
		$charmap = self::getCharmapData($letter, false);
		$symbol = '';

		if ($charmap)
		{
			$symbol = $charmap->symbol;
		}

		return ($asHtml ? htmlentities($symbol) : $symbol);
	}

	/**
	 * Get Charmap Data by letter
	 *
	 * @param string $letter
	 * @param boolean $redirect Use redirect if error?
	 */
	public static function getCharmapData($letter, $redirect=true)
	{
		try
		{
			$charmap = self::whereLetter($letter)->first();
		}
		catch (Exception $e)
		{
			if ($redirect)
				return Redirect::route('dashboard.charmaps.index')->withErrors($e->getMessage());
			else
				return false;
		}

		return $charmap;
	}

}