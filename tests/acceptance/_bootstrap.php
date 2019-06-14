<?php
use Dotenv\Dotenv;

$env = Dotenv::create( codecept_root_dir(), '.env.testing' );
$env->load();

