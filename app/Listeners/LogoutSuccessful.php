<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Logout;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogoutSuccessful {
    public function __construct() {

    }

    public function handle(Logout $event) {
        setcookie("@id", "", time() - 3600, "/");
    }
}
