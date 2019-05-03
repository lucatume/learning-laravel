<?php

namespace App\Console\Commands\Code\PHP;

use Illuminate\Console\Command;
use Symfony\Component\Console\Output\ConsoleOutput;
use Symfony\Component\Process\Process;

class Fix extends Command {

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'code:php:fix';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fixes PHP code style using PHP Code Sniffer and Laravel coding standard.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle() {
        $output  = new ConsoleOutput();
        $root    = dirname( __DIR__, 5 );
        $arr     = [
            'vendor/bin/phpcbf',
            '--standard=vendor/pragmarx/laravelcs/Standards/Laravel',
            'app',
        ];
        $process = new Process( $arr );
        $process->setWorkingDirectory( $root );
        $process->run( function ( $type, $buffer ) use ( $output ) {
            if ( $type === Process::ERR ) {
                $output->writeln( 'Error: ' . $buffer );

                return;
            }
            $output->writeln( $buffer );
        } );
    }
}
