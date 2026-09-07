<?php

namespace App\Providers;

use Illuminate\Hashing\BcryptHasher;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use SensitiveParameter;
use Throwable;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (app()->environment('production') || config('app.env') === 'production') {
            URL::forceScheme('https');
        }

        Hash::extend('bcrypt', function ($app) {
            return new class($app['config']['hashing.bcrypt'] ?? []) extends BcryptHasher
            {
                public function make(#[SensitiveParameter] $value, array $options = []): string
                {
                    try {
                        return parent::make($value, $options);
                    } catch (Throwable) {
                        if (defined('PASSWORD_ARGON2ID')) {
                            try {
                                return password_hash($value, PASSWORD_ARGON2ID);
                            } catch (Throwable) {
                            }
                        }

                        if (defined('PASSWORD_DEFAULT')) {
                            try {
                                return password_hash($value, PASSWORD_DEFAULT);
                            } catch (Throwable) {
                            }
                        }

                        $salt = bin2hex(random_bytes(16));

                        return '$sha256$'.$salt.'$'.hash('sha256', $salt.$value);
                    }
                }

                public function check(#[SensitiveParameter] $value, $hashedValue, array $options = []): bool
                {
                    if (is_null($hashedValue) || (string) $hashedValue === '') {
                        return false;
                    }

                    if (str_starts_with($hashedValue, '$sha256$')) {
                        $parts = explode('$', substr($hashedValue, 8));
                        if (count($parts) === 2) {
                            [$salt, $hash] = $parts;

                            return hash_equals($hash, hash('sha256', $salt.$value));
                        }
                    }

                    try {
                        return password_verify($value, $hashedValue);
                    } catch (Throwable) {
                        return false;
                    }
                }
            };
        });
    }
}
