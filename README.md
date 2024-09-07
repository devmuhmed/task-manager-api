
## How could you install and make a project working After Clone
update .env file your database with it's your own credentials and generate your app_key

first make sure to install the composer requirements
```php
composer install
```
second run the migrations this application
```php
php artisan migrate
```
third run seeder this step will generate four users and 100 tasks per user random except one user we will use for login the application

```php
php artisan db:seed
```


the credentials of the user to login
```php
email => "mohamed@admin.com"
Password => "123456"
```

I'm using the Laravel Sanctum for authentication and the API routes are protected with the middleware auth:sanctum
to make sure tasks created by the user who created it I'm using the user_id in the tasks table. 
I'm using the Laravel Eloquent ORM to make the relationship between the user and the tasks

```php
Route::group(['middleware' => 'auth:sanctum'], static function () {
    Route::apiResource('tasks', TaskController::class);
    Route::put('change-priority/{task}', [TaskController::class, 'changePriority']);
    Route::post('/logout', [AuthController::class,'logout'])->name('logout');
});
```

Using the Laravel Resource to make the response more readable and clean
```php
public function index(Request $request)
    {
        $tasks = $this->taskService->filter($request->all());
        return TaskResource::collection($tasks);
    }
```
Using the Laravel Request to validate the request and make the code clean and readable
```php
public function store(TaskRequest $request)
    {
        $task = $this->taskService->create($request->all());
        return new TaskResource($task);
    }
```
Using the Laravel Service to make the code clean and readable and separate the business logic from the controller
```php
public function changePriority($id, $data)
    {
        $task = $this->find($id);
        if ($task->user_id != auth()->id() && !$task->assignedUsers->contains(auth()->id())) {
            abort(403, 'Unauthorized action.');
        }

        $task->update(['priority' => $data['priority']]);

        return $task;
    }
```
I'm using Spatie Enum to make the code clean and readable and make the code more maintainable
```php
TaskPriorityEnum::values()
```
