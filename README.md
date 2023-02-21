# LaravelVueVuexVuetifyOrdersCRUDLumenOrdersMicroservice

## Microservice for orders LaravelVueVuexVuetifyOrdersCRUD on Lumen (Laravel)

[demo](https://orders-crud.alenev.name)

### Realization 

In bootstrap\app.php registered required providers 

$app->withFacades();
$app->withEloquent();

$app->register(App\Providers\AppServiceProvider::class);
$app->register(App\Providers\AuthServiceProvider::class);
$app->register(App\Providers\EventServiceProvider::class);