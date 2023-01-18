<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class updateAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:update {username} {email} {password}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Updates blog admin/editor details';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        return Command::SUCCESS;
    }
}
