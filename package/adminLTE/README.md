# adminLTE
AdminPanel and RolePermission system

laravel 8+

install with  composer
```
composer require javad/adminlte
```
========================================

setup 
````
php artisan migrate
php artisan vendor:publish
add 'mobile','super_admin','phone_verify','phone_verify_at' to user model in $fillable 
use UserTrate;#in user model 
````
in AuthServiceProvider on boot  method add this lines
```
        foreach (Permission::all() as $permission) {
            Gate::define($permission->name , function($user) use ($permission){
                return $user->hasPermission($permission);
            });
        }
```
namespace is `MrjavadSeydi\AdminLTE`
