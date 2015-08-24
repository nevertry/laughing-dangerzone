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
			# Retrieve User data to get riddle id.
			$guest = \Guest::whereEmail($inputData['email'])->first();
			if ($guest)
			{
				# Check user riddle id with given riddle id.

				if (!empty($guest->riddle_id) && ($guest->riddle_id == $inputData['riddle_id']))
				{
					$riddle = \Riddle::whereId($guest->riddle_id)->first();
					if ($riddle)
					{
						# # IF equal, get Riddle with answer
						# # # IF riddle_answer = given_answer
						# # # # Success!
						if (!empty($riddle->answer) && (strtolower($riddle->answer) == strtolower($inputData['answer'])))
						{
							self::$message = "Awesome! You're answer is correct. Congratulation! \xF0\x9F\x91\x8D";
							$inputData['status'] = 'solved';
							self::$data    = $inputData;
						}
						else
						{
							self::$error = 1;
							self::$message = "Sorry, wrong answer!";
							$inputData['status'] = 'unsolved';
							self::$data    = $inputData;
						}
					}
					else
					{
						self::$error   = 5000;
						self::$message = "Answer Error: Guest doesn't have riddle, sign in first.";
						self::$data    = $inputData;
					}
				}
				else
				{
					self::$error   = 5000;
					self::$message = "Answer Error: Invalid riddle id.";
					self::$data    = $inputData;
				}
			}
			else
			{
				self::$error   = 5000;
				self::$message = "Answer Error: Invalid guest or guest is not registered.";
				self::$data    = $inputData;
			}
		}
		else
		{
				self::$error   = 5000;
				self::$message = "Answer Error: Parameters validation failed.";
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