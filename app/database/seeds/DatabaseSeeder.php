<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		// $this->call('UserTableSeeder');
	}

}

class Utf8PinyinSeeder extends Seeder{
	public function run()
	{
		Eloquent::unguard();

		$this->command->info('Seeding Utf8Pinyin!');
		$Uni2PinyinFh = fopen('assets/Uni2Pinyin','r');
		if( !$Uni2PinyinFh )
			throw new Exception("Can't find file \"assets/Uni2Pinyin\".");
		$cnt = array('c'=>0,'n'=>50);
		while( $line = stream_get_line( $Uni2PinyinFh, 1000, "\n" ))
		{
			$line = trim($line);
			if( strlen($line)==0 || $line[0]=='#' )
				continue;
			$pinyins = explode("\t",trim($line));
			$utf8 = trim(array_shift($pinyins));
			$utf8 = mb_convert_encoding(pack('H*', $utf8), 'UTF-8', 'UCS-2');
			foreach( $pinyins as $pinyin )
			{
				$Utf8Pinyin = DspaceNAZHTW\Utf8Pinyin::firstOrCreate(array(
					'utf8' => $utf8,
					'pinyin'=>trim($pinyin),
				));
				$cnt['c']++;
				if( $cnt['c']>=$cnt['n'] )
				{
					$cnt['n']+=50;
					$this->command->info('import count: '.$cnt['c']);
				}
			}
		}
		$this->command->info('import count: '.$cnt['c']);
		$this->command->info('Seeding Utf8Pinyin Success!');
	}
}
