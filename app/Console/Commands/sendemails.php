<?php

namespace App\Console\Commands;

use App\Support\Scheduler;
use Illuminate\Console\Command;

class sendemails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:emails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send scheduler reminder emails';

    protected $scheduler;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Scheduler $scheduler)
    {
        parent::__construct();

        $this->scheduler = $scheduler;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->scheduler->sendEmail();
    }
}
