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
        $monster = $slot ? $slot['value'] : 'монстров';

        $slot = $context->intents('MONSTER.SEARCH', 'place');
        $place = $slot ? $slot['value'] : 'в комнате';

        $line1 = Markup::variant([
            "{rand:🔍|👀|👌|👍} {rand:Сканирую|Ищу} {$monster} {$place}...",
            "{rand:🔍|👀|👌|👍} Начинаю {rand:сканировать|искать|поиск} {$monster} {$place}...",
            "{rand:🔍|👀|👌|👍} Выполняю поиск {$monster} {$place}...",
        ]);

        $lineDo = Markup::variant([
            "👀 Проверяю каждый {rand:сантиметр|метр|угол|уголок} {$place}...",
            "👀 Заглядываю в каждый уголок...",
            "👀 Заглядываю в каждый уголок {$place}...",
            "👀 Внимательно всё осматриваю...",
            "👀 Не упущу ни одного уголка...",
            "👀 Проверяю все уголки и щелочки...",
            "👀 Заглядываю в каждый угол и под каждый предмет...",
        ]);

        $lineFinish = Markup::variant([
            "😋 Ещё {rand:чуть-чуть|немного|немножко}...",
            "😋 Почти всё готово...",
            "😋 Заканчиваю {rand:поиски|сканирование}...",
            "😋 Завершаю {rand:поиски|сканирование}...",
        ]);

        $Place = mb_ucfirst($place);
        $Monster = mb_ucfirst($monster);

        $line2 = Markup::variant([
            "🎉 {rand:Ур+а-а|Готово|Хоп-хоп|Х+опчик|Фух}! Я не нашла 👻 {$monster} {$place}, никого нет, всё {rand:чисто|спокойно|т+ип-т+оп|ч+ики-п+уки}! {rand:🥳|😎|🐰|🌸|🐸|🐥|🐣}",
            "🎉 {rand:Ур+а-а|Готово|Хоп-хоп|Х+опчик|Фух}! Здесь всё {rand:чисто|спокойно|т+ип-т+оп|ч+ики-п+уки} и никого нет, я {rand:проверила|узнала|просканировала}! {rand:🥳|😎|🐰|🌸|🐸|🐥|🐣}",
            "🎉 {rand:Ур+а-а|Готово|Хоп-хоп|Х+опчик|Фух}! {$Place} всё {rand:чисто|спокойно|т+ип-т+оп|ч+ики-п+уки} и никого нет, я {rand:проверила|узнала|просканировала}! {rand:🥳|😎|🐰|🌸|🐸|🐥|🐣}",
            "🎉 {rand:Ур+а-а|Готово|Хоп-хоп|Х+опчик|Фух}! Никого нет, всё {rand:чисто|спокойно|т+ип-т+оп|ч+ики-п+уки}! {rand:🥳|😎|🐰|🌸|🐸|🐥|🐣}",
            "🎉 {rand:Ур+а-а|Готово|Хоп-хоп|Х+опчик|Фух}! {$Monster} 👻 не существует, всё {rand:чисто|спокойно|т+ип-т+оп|ч+ики-п+уки}! {rand:🥳|😎|🐰|🌸|🐸|🐥|🐣}",
        ]);

        $line3 = Markup::variant([
           'А если что, я всегда рядом и {rand:защищаю|защищу|не дам в обиду} тебя ❤️',
           'И если что, я всегда {rand:защищаю|защищу} тебя ❤️',
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
            new Button('Спасибо'),
            new Button('Поищи ещё раз'),
            new Button('Хватит'),
        ]);
    }
}

