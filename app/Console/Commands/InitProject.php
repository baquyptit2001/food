<?php

namespace App\Console\Commands;

use App\Models\Category;
use App\Models\Role;
use Illuminate\Console\Command;

class InitProject extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'init:project';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run when a new project is created';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Role::create(['name' => 'ADMIN']);
        Role::create(['name' => 'MODERATOR']);
        Role::create(['name' => 'USER']);
        Category::create(['name' => 'Món Việt']);
        Category::create(['name' => 'Cơm', 'parent_id' => 1]);
        Category::create(['name' => 'Bún, Phở', 'parent_id' => 1]);
        return 0;
    }
}
