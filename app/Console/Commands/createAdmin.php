<?php

namespace App\Console\Commands;
use App\Models\User;
use Illuminate\Console\Command;

class createAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
     protected $signature = 'user:admin {email : The email of the user to change}';



    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Change the user type to admin';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
     
        $email = $this->argument('email');
        $user = User::where('email', $email)->first();

        if (!$user) {
            $this->error("User with email {$email} not found");
            return;
        }

        $user->type = 'admin';
        $user->save();

        $this->info("User with email {$email} is now an admin");
    }
}
