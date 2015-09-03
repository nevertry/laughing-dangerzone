<?php

class CharmapSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$charmap_group = [

			// Riddles
			'alphabet' => [
				['letter' => 'A', 'symbol' => '&alpha;'],
				['letter' => 'B', 'symbol' => '&beta;'],
				['letter' => 'C', 'symbol' => '&gamma;'],
				['letter' => 'D', 'symbol' => '&delta;'],
				['letter' => 'E', 'symbol' => '&epsilon;'],
				['letter' => 'F', 'symbol' => '&zeta;'],
				['letter' => 'G', 'symbol' => '&eta;'],
				['letter' => 'H', 'symbol' => '&theta;'],
				['letter' => 'I', 'symbol' => '&iota;'],
				['letter' => 'J', 'symbol' => '&kappa;'],
				['letter' => 'K', 'symbol' => '&lambda;'],
				['letter' => 'L', 'symbol' => '&mu;'],
				['letter' => 'M', 'symbol' => '&nu;'],
				['letter' => 'N', 'symbol' => '&xi;'],
				['letter' => 'O', 'symbol' => '&omicron;'],
				['letter' => 'P', 'symbol' => '&pi;'],
				['letter' => 'Q', 'symbol' => '&rho;'],
				['letter' => 'R', 'symbol' => '&sigmaf;'],
				['letter' => 'S', 'symbol' => '&sigma;'],
				['letter' => 'T', 'symbol' => '&tau;'],
				['letter' => 'U', 'symbol' => '&upsilon;'],
				['letter' => 'V', 'symbol' => '&phi;'],
				['letter' => 'W', 'symbol' => '&chi;'],
				['letter' => 'X', 'symbol' => '&psi;'],
				['letter' => 'Y', 'symbol' => '&omega;'],
				['letter' => 'Z', 'symbol' => '&thetasym;'],
			],
		];

		foreach ($charmap_group as $k_group => $group)
		{
			foreach ($group as $item) {
				Charmap::create([
					'letter' => $item['letter'],
					'symbol' => $item['symbol'],
				]);
			}
		}
	}
}