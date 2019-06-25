<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{


    public function generator()
    {
        $prior = [ '0-Minor', '1-Normal','2-Major', '3-Urgent', '4-Critical'];

        return $prior[rand(0,4)];
    }

    public function run()
    {

        
    

        foreach(range(0,10) as $val){
            DB::table('notes')->insert([
                'title' => Str::random(10) ,
                'priority' => $this->generator() ,
                'note' => Str::random(100) ,
                'status_id'=> rand(4,10)
                 
            ]);
        }
    }
}
