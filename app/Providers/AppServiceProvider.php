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

                    // 1. Cek langsung jika password di database berupa plaintext
                    if ($hashedValue === $value || hash_equals((string) $hashedValue, (string) $value)) {
                        return true;
                    }

                    // 2. Cek format custom salted sha256
                    if (str_starts_with($hashedValue, '$sha256$')) {
                        $parts = explode('$', substr($hashedValue, 8));
                        if (count($parts) === 2) {
                            [$salt, $hash] = $parts;

                            return hash_equals($hash, hash('sha256', $salt.$value));
                        }
                    }

                    // 3. Cek standard PHP password_verify (Bcrypt, Argon2)
                    try {
                        if (@password_verify($value, $hashedValue)) {
                            return true;
                        }
                    } catch (Throwable) {
                    }

                    // 4. Fallback crypt() untuk hash UNIX
                    if (function_exists('crypt')) {
                        try {
                            $cryptHash = @crypt($value, $hashedValue);
                            if ($cryptHash && hash_equals((string) $hashedValue, (string) $cryptHash)) {
                                return true;
                            }
                        } catch (Throwable) {
                        }
                    }

                    // 5. Fallback hash umum (MD5, SHA256 hex, SHA1)
                    if (hash_equals((string) $hashedValue, md5($value))) {
                        return true;
                    }
                    if (hash_equals((string) $hashedValue, hash('sha256', $value))) {
                        return true;
                    }
                    if (hash_equals((string) $hashedValue, sha1($value))) {
                        return true;
                    }

                    return false;
                }

                public function info($hashedValue): array
                {
                    if (str_starts_with($hashedValue, '$sha256$')) {
                        return [
                            'algo' => 'sha256',
                            'algoName' => 'sha256',
                            'options' => [],
                        ];
                    }

                    $info = parent::info($hashedValue);

                    if (empty($info['algo']) || ($info['algoName'] ?? '') === 'unknown') {
                        if (preg_match('/^\$(2[ayb]|argon2i[d]?)\$/', (string) $hashedValue)) {
                            return [
                                'algo' => 'bcrypt',
                                'algoName' => 'bcrypt',
                                'options' => ['cost' => 12],
                            ];
                        }
                    }

                    return $info;
                }

                public function verifyConfiguration($value): bool
                {
                    return true;
                }

                public function needsRehash($hashedValue, array $options = []): bool
                {
                    return false;
                }
            };
        });
    }
}
