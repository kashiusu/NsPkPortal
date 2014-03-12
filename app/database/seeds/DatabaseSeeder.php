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

class leaguetypesTableSeeder extends Seeder {

    public function run()
    {
        DB::table('leaguetypes')->delete();

        leaguetype::create(array(            
            "id"    => "NONE", 
            "name"  => "Custom games"
            ));
        leaguetype::create(array(            
            "id"    => "NORMAL", 
            "name"  => "Normal 5v5"
            ));
        leaguetype::create(array(            
            "id"    => "NORMAL_3x3", 
            "name"  => "Normal 3v3"
            ));
        leaguetype::create(array(            
            "id"    => "ODIN_UNRANKED", 
            "name"  => "Dominion"
            ));
        leaguetype::create(array(            
            "id"    => "ARAM_UNRANKED_5x5", 
            "name"  => "ARAM"
            ));
        leaguetype::create(array(            
            "id"    => "BOT", 
            "name"  => "Co-op vs AI 5v5"
            ));
        leaguetype::create(array(            
            "id"    => "BOT_3x3", 
            "name"  => "Co-op vs AI 3v3"
            ));
        leaguetype::create(array(            
            "id"    => "RANKED_SOLO_5x5", 
            "name"  => "Ranked solo 5v5"
            ));
        leaguetype::create(array(            
            "id"    => "RANKED_TEAM_3x3", 
            "name"  => "Ranked team 3v3"
            ));
        leaguetype::create(array(            
            "id"    => "RANKED_TEAM_5x5", 
            "name"  => "Ranked team 5v5"
            ));
        leaguetype::create(array(            
            "id"    => "ONEFORALL_5x5", 
            "name"  => "One for All"
            ));
        leaguetype::create(array(            
            "id"    => "FIRSTBLOOD_1x1", 
            "name"  => "Normal 1v1"
            ));
        leaguetype::create(array(            
            "id"    => "FIRSTBLOOD_2x2", 
            "name"  => "Normal 2v2"
            ));
        leaguetype::create(array(            
            "id"    => "SR_6x6", 
            "name"  => "Hexakill"
            ));
    }

}