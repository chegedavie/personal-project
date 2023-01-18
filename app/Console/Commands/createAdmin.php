<?php

namespace App\Console\Commands;
use App\Models\User;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class createAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:create 
    { username : The username for the Admin} 
    { email : Admin\'s email} {password : Admin\'s password} 
    {role=Admin}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates a blog admin/editor';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $username=$this->argument('username');
        $email=$this->argument('email');
        $password=Hash::make($this->argument('password'));
        $role=$this->argument('role');
        $done=false;
        if($username && $email && $password){
            $created=User::create([
                'name'=>$username,
                'email'=>$email,
                'password'=>$password
            ]);
            $created->assignRole('Admin');
            $done=true;
        }
        if($done) $this->info($role.' created successfully');
        else $this->error('Failed to create '.$role);
        return Command::SUCCESS;
    }
}


