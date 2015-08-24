<?php

class RiddleSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$riddles_group = [

			// Riddles
			'riddles' => [
				[
					'type' => 'text',
					'content' => 'Usually it has six different strings.',
					'question' => 'Name an instrument.',
					'answer' => 'GUITAR',
					'clues' => 'G1,U2,I3,T4,A5,R6',
					'publish_status' => "0",
				],
				[
					'type' => 'image',
					'content' => 'http://nusantariddle:8064/img/sample/instrument.jpg',
					'question' => 'What is the main color of the body of the figure?',
					'answer' => 'RED',
					'clues' => 'R1,E2,D3',
					'publish_status' => "0",
				],
				[
					'type' => 'video',
					'content' => 'http://nusantariddle:8064/img/sample/instrument.jpg',
					'question' => 'How many strings this instrument had?',
					'answer' => 'SIX',
					'clues' => 'S1,I2,X3',
					'publish_status' => "0",
				],
				[
					'type' => 'audio',
					'content' => 'http://nusantariddle:8064/img/sample/instrument.jpg',
					'question' => 'In musical notes, C also known as ...?',
					'answer' => 'DO',
					'clues' => 'D1,O2',
					'publish_status' => "0",
				],
			],
		];

		foreach ($riddles_group as $k_group => $riddles)
		{
			foreach ($riddles as $riddle) {
				Riddle::create([
					'type' => $riddle['type'],
					'content' => $riddle['content'],
					'question' => $riddle['question'],
					'answer' => $riddle['answer'],
					'clues' => $riddle['clues'],
					'publish_status' => $riddle['publish_status'],
				]);
			}
		}
	}
}