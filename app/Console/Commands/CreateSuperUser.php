<?php

namespace App\Console\Commands;

use App\Models\Role;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CreateSuperUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new super user';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        while (true) {
            $name = $this->ask('What is the your name?');
            $email = $this->ask('What is your email?');
            $password = $this->secret('What is your password?');
            $password_confirmation = $this->secret('Type your password again');
            $user = new User();
            $user->name = $name;
            $user->email = $email;
            $user->password = $password;
            $user->password_confirmation = $password_confirmation;
            $this->info('Validating user...');
            $user->makeVisible('password');
            $validator = Validator::make($user->toArray(), User::rules());
            if ($validator->fails()) {
                $this->error('Validation failed');
                $this->error($validator->errors()->first());
                continue;
            }
            break;
        }
        $this->info('Creating user...');
        $save = new User();
        $save->name = $user->name;
        $save->email = $user->email;
        $save->password = Hash::make($user->password);
        $save->role_id = 1;
        $save->save();
        $this->info('User created successfully!');
        return 0;
    }
}
