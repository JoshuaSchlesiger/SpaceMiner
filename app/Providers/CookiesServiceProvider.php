<?php

namespace App\Providers;

use Whitecube\LaravelCookieConsent\Consent;
use Whitecube\LaravelCookieConsent\Facades\Cookies;
use Whitecube\LaravelCookieConsent\CookiesServiceProvider as ServiceProvider;

class CookiesServiceProvider extends ServiceProvider
{
    /**
     * Define the cookies users should be aware of.
     */
    protected function registerCookies(): void
    {
        // Register Laravel's base cookies under the "required" cookies section:
        Cookies::essentials()
            ->session()
            ->csrf();

        // Register all Analytics cookies at once using one single shorthand method:
        // Cookies::analytics()
        //     ->google(env('GOOGLE_ANALYTICS_ID'));

        // Register custom cookies under the pre-existing "optional" category:
        Cookies::optional()
            ->name('password_remember')
            ->description('Dieses Cookie hilft dir, dass du dein Passwort nicht wieder eintippen musst')
            ->duration(43800)
            ->accepted(fn(Consent $consent) => $consent->cookie(value: true));
    }
}
