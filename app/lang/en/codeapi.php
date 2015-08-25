<?php

return array(
	# System
	'system.routes.list' => "Listed available APIs.",

	# Guest
	# # Sign In
	'guest.signin.success_name_different' => "Success, continuing session. Registered name: :attr_name",
	'guest.signin.invalid_parameter' => "Sign In Error: Cannot validate inputted data.",
	# # Register
	'guest.register.invalid_parameter' => "Register Error: Cannot validate inputted data.",

	# Riddles
	# # Result
	'riddle.answer.correct' => "Awesome! You're answer is correct. Congratulation! \xF0\x9F\x91\x8D",
	'riddle.answer.wrong' => "Sorry, wrong answer!",
	# # Invalid
	'riddle.answer.guest_no_riddle' => "Answer Error: Guest doesn't have riddle, sign in first.",
	'riddle.answer.invalid_riddle' => "Answer Error: Invalid riddle id.",
	'riddle.answer.invalid_guest' => "Answer Error: Invalid guest or guest is not registered.",
	'riddle.answer.invalid_parameter' => "Answer Error: Parameters validation failed.",
);