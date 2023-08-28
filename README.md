# LaravelVueVuexVuetifyOrdersCRUDLumenOrdersMicroservice

## Microservice for orders LaravelVueVuexVuetifyOrdersCRUD on Lumen (Laravel microframework)

### Realization 

- In ```bootstrap\app.php``` registered required providers for access to orders controllers CRUD methods API points (api/orders, api/orders/create, api/orders/update, api/orders/delete)   
```
$app->withFacades();
$app->withEloquent();

$app->register(App\Providers\AppServiceProvider::class);
$app->register(App\Providers\AuthServiceProvider::class);
$app->register(App\Providers\EventServiceProvider::class);
```
- In ```app\Http\Controllers\Api\OrdersController.php``` orders controller
- In main controller ```app\Http\Controllers\Controller.php``` methods ```ApiResponceSuccess``` and ```ApiResponceError``` for unification API responses 
- In ```app\Repositories\OrdersRepository.php``` orders model repository by Eloquent ORM with interface ```app\Repositories\Interfaces\OrdersRepositoryInterface.php``` for another types of orders model repositories
- In ```app\Models\Orders.php``` standard Laravel model for orders. Used in orders model Eloquent ORM repository ```app\Repositories\OrdersRepository.php```
- In ```app\Helpers\DataHelper.php``` static methods for data process in orders controller methods
