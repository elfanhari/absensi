<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
      Gate::define('admin', function(User $user) {
        return $user->role === 'admin' ?? '';
      });

      Gate::define('guru', function(User $user) {
          return $user->role === 'guru' ?? '';
      });

      Gate::define('gurumapel', function(User $user) {
          return $user->guru->pembelajaran ?? '';
      });

      Gate::define('walikelas', function(User $user) {
          return $user->guru->kelas ?? '';
      });

      Gate::define('siswa', function(User $user) {
          return $user->role === 'siswa' ?? '';
      });

      Gate::define('piket', function(User $user) {
          return $user->role === 'piket' ?? '';
      });
    }
}
