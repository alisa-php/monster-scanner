<?php

namespace App\Controllers;

use Alisa\Context;
use Alisa\Support\Markup;
use Alisa\Yandex\Types\Button;

use function Alisa\Support\Helpers\mb_ucfirst;

class MonsterController
{
    public function search(Context $context)
    {
        user()->increment('monster_search_count');

        $slot = $context->intents('MONSTER.SEARCH', 'monster');

        $slot = $context->intents('MONSTER.SEARCH', 'place');
        $place = $slot ? $slot['value'] : 'рядом с тобой';

        $line1 = Markup::variant([
            "{rand:🔍|👀|👌|👍} {rand:Сканирую|Ищу} {$place}...",
            "{rand:🔍|👀|👌|👍} Начинаю {rand:сканировать|искать|поиск} {$place}...",
            "{rand:🔍|👀|👌|👍} Выполняю поиск {$place}...",
        ]);

        $lineDo = Markup::variant([
            "👀 Проверяю каждый {rand:сантиметр|метр|угол|уголок} {$place}...",
            "👀 Заглядываю в каждый {rand:угол|уголок} вокруг...",
            "👀 Заглядываю в каждый {rand:угол|уголок} вокруг {$place}...",
            "👀 Внимательно всё осматриваю вокруг...",
            "👀 Проверяю все {rand:углы|уголоки} и {rand:щёлки|щёлочки}...",
            "👀 Осмтриваю каждый {rand:угол|уголок}...",
        ]);

        $lineFinish = Markup::variant([
            "😋 Ещё {rand:чуть-чуть|немного|немножко}...",
            "😋 Я почти закончила...",
            "😋 Почти всё готово...",
            "😋 Ещё пару секунд...",
            "😋 Заканчиваю {rand:поиски|сканирование|искать}...",
            "😋 Завершаю {rand:поиски|сканирование}...",
        ]);

        $Place = mb_ucfirst($place);

        $line2 = Markup::variant([
            "🎉 {rand:Ур+а-а|Готово|Хоп-хоп|Х+опчик|Фух}! Я не нашла никого {$place}, всё {rand:чисто|спокойно|т+ип-т+оп|ч+ики-п+уки}! {rand:🥳|😎|🐰|🌸|🐸|🐥|🐣}",
            "🎉 {rand:Ур+а-а|Готово|Хоп-хоп|Х+опчик|Фух}! {$Place} всё {rand:чисто|спокойно|т+ип-т+оп|ч+ики-п+уки} и никого нет. {rand:🥳|😎|🐰|🌸|🐸|🐥|🐣}",
            "🎉 {rand:Ур+а-а|Готово|Хоп-хоп|Х+опчик|Фух}! {$Place} никого нет, всё {rand:чисто|спокойно|т+ип-т+оп|ч+ики-п+уки}! {rand:🥳|😎|🐰|🌸|🐸|🐥|🐣}",
            "🎉 {rand:Ур+а-а|Готово|Хоп-хоп|Х+опчик|Фух}! Всё {rand:чисто|спокойно|т+ип-т+оп|ч+ики-п+уки} и никого {$place}! {rand:🥳|😎|🐰|🌸|🐸|🐥|🐣}",
        ]);

        $line3 = Markup::variant([
           'А если что, я всегда рядом и {rand:защищаю|защищу|не дам в обиду|оберегаю} тебя ❤️',
           'И если что, я всегда {rand:защищаю|защищу|оберегаю} тебя ❤️',
        ]);

        $context->reply("
            {$line1}

            🎶🎶🎶

            {audio:alice-music-tambourine-80bpm-1}

            {$lineDo}

            🎶🎶🎶

            {audio:alice-music-tambourine-80bpm-1}

            {$lineFinish}

            {audio:alice-music-tambourine-100bpm-1}

            🎶🎶🎶

            {audio:alice-sounds-human-kids-1}

            {$line2}

            {$line3}
        ", buttons: [
            new Button('Спасибо ❤️'),
            new Button('Поищи ещё раз!'),
            new Button('Хватит'),
        ]);
    }
}

