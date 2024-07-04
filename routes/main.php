<?php

/** @var \Alisa\Alisa $alisa */

$alisa->onError([\App\Controllers\MainController::class, 'exception']);
$alisa->onStart([\App\Controllers\MainController::class, 'start']);
$alisa->onHelp([\App\Controllers\MainController::class, 'help']);
$alisa->onWhatCanYouDo([\App\Controllers\MainController::class, 'features']);
$alisa->onFallback([\App\Controllers\MainController::class, 'fallback']);
$alisa->onIntent(['MONSTER.SEARCH', 'MONSTER.SEARCH_YET'], [\App\Controllers\MonsterController::class, 'search']);
$alisa->onIntent('THANKS', [\App\Controllers\MainController::class, 'thanks']);