<?php

namespace App\Http\Controllers;

use App\Models\Contributor;
use Exception;
use Illuminate\Support\Facades\Crypt;

class CookieController {
    /**
     * Each time this system is accessed, use this function to check the validity of the cookie.
     */
    public static function checkCookie() {
        CookieController::cookieIsNotSetOrChangedOrDeleted();
    }

    /**
     * Try to decrypt "c_id" cookie value.
     * If it was not set, or it was changed or deleted, catch exception and create new cookie again.
     */
    public static function cookieIsNotSetOrChangedOrDeleted() {
        try {
            Crypt::decrypt($_COOKIE["c_id"]);
        } catch (Exception $e) {
            CookieController::setNewContributorCookie();
            return true;
        }
        return false;
    }

    /**
     * Set a default encrypted contributor-id cookie value.
     */
    public static function setNewContributorCookie() {
        $contributor = Contributor::create([
            'name' => 'New User'
        ]);
        $cookie = Crypt::encrypt($contributor->id);
        setcookie("c_id", $cookie, time() + 86400 * 365, "/");
        session()->flash('c_id', $cookie);
    }
}
