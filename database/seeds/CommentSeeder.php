<?php

use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Comment::query()
            ->delete();
        factory(\App\Models\Comment::class, 1000)->create();
    }
}
