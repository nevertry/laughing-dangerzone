<?php

namespace Api\v1;

/**
* Class: ApiGuestController
*/
class ApiRiddleController extends BaseApiController
{
	private static $answer_rules = [
		'email' => 'required|email',
		'riddle_id' => 'required',
		'answer' => 'required',
	];

	private static $statuses = [
		'riddle_solved' => 'solved',
		'riddle_not_solved' => 'unsolved',
	];

	/**
	 * Answer Riddle
	 * @return 0 ONLY if Success.
	 * @return >0 if failed or error.
	 */
	public function postAnswer()
	{
		$inputData = [
			'email' => \Input::get('email'),
			'riddle_id' => \Input::get('riddle_id'),
			'answer' => \Input::get('answer'),
		];

		$validate = self::validateAnswer($inputData);

		if ($validate->passes())
		{
			// Retrieve User data to get riddle id.
			$guest = \Guest::whereEmail($inputData['email'])->first();
			if ($guest)
			{
				// Check user riddle id with given riddle id.

				if (!empty($guest->riddle_id) && ($guest->riddle_id == $inputData['riddle_id']))
				{
					$riddle = \Riddle::whereId($guest->riddle_id)->first();
					if ($riddle)
					{
						// // IF equal, get Riddle with answer
						// // // IF riddle_answer = given_answer
						// // // // Success!
						if (!empty($riddle->answer) && (strtolower($riddle->answer) == strtolower($inputData['answer'])))
						{
							self::$message = trans('codeapi.riddle.answer.correct');
							$inputData['status'] = self::$statuses['riddle_solved'];
							self::$data    = $inputData;
						}
						else
						{
							self::$error = 1;
							self::$message = trans('codeapi.riddle.answer.wrong');
							$inputData['status'] = self::$statuses['riddle_not_solved'];
							self::$data    = $inputData;
						}
					}
					else
					{
						self::$error   = 5000;
						self::$message = trans('codeapi.riddle.answer.guest_no_riddle');
						self::$data    = $inputData;
					}
				}
				else
				{
					self::$error   = 5000;
					self::$message = trans('codeapi.riddle.answer.invalid_riddle');
					self::$data    = $inputData;
				}
			}
			else
			{
				self::$error   = 5000;
				self::$message = trans('codeapi.riddle.answer.invalid_guest');
				self::$data    = $inputData;
			}
		}
		else
		{
				self::$error   = 5000;
				self::$message = trans('codeapi.riddle.answer.invalid_parameter');
				self::$data    = $inputData;
		}

		return self::response();
	}

	static function validateAnswer($data, $external_rules=array())
	{
		$rules = (count($external_rules)) ? $external_rules : self::$answer_rules;
		return \Validator::make($data, $rules);
	}
}