<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;

class LoginSuccessful {
    public function __construct() {

    }

    public function handle(Login $event) {
        $user = Auth::user();
        setcookie("@id", $user->contributor_id, time() + 86400 * 365, "/");
    }
}
