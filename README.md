# Framework

Это фреймворк для разработки навыков голосового помощника Алисы.

Фреймворк содержит базовую структуру проекта для быстрого старта, а также работает с базой данных Eloquent из коробки.

# Описание

## Routes

Роуты позволяют разруливать входящие запросы от Диалогов.

Находятся в папке `routes`.

Регистрация дополнительных файлов с роутами происходит в файле `config/routes.php`.

> [!NOTE]
> При регистрации файлов помните о приоритетах событий.

```php
// config/routes.php

return [
    'main', // файл main.php
    'foo/bar/baz', // папка foo, подпапка bar и файл с роутами baz.php
];
```

```php
// routes/main.php

/** @var \Alisa\Alisa $alisa */

$alisa->onStart([\App\Controllers\HamsterController::class, 'start']);
$alisa->onAny([\App\Controllers\HamsterController::class, 'any']);
```

## Controllers

Котнроллеры - это обработчики входящий запросов.

Их можно объявить в виде функции или класса.

Классы находятся по пути `app/Controllers`, функции объявляются внутри `routes`.

```php
// routes/main.php

$alisa->onStart([\App\Controllers\HamsterController::class, 'start']);

...

// app/Controllers/HamsterController

namespace App\Controllers;

use Alisa\Context;

class HamsterController
{
    public function start(Context $context)
    {
        //
    }
}
```

```php
// routes/main.php

$alisa->onStart(function (Context $context) {
    //
});
```

## Middlewares

Находятся в папке `app/Middlewares`, могут быть в виде классов и функций.

```php
namespace App\Middlewares;

use Alisa\Context;

class LoggerMiddleware
{
    public function __invoke(Context $context, $next)
    {
        $next($context);
    }
}
```

```php
$alisa->onStart([\App\Controllers\HamsterController::class, 'start'])->middleware(LoggerMiddleware::class);
```

```php
$alisa
    ->onCommand('foo')
    ->middleware(function (Context $context, $next) {
        $next($context);
    });
```

Readme WIP