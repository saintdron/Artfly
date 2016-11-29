<?php

## Ссылки на объекты.
#
define("pups", 456, true);

// Объявляем новый класс.
class AgentSmith {

    public $mind = 3;

    public function __toString() {
        //settype($this->mind, "string");
        return "" . $this->mind;
    }

}

// Создаем новый объект класса AgentSmith.
$first = new AgentSmith();
// Присваиваем значение атрибуту класса.
$first->mind = 0.123;
// Копируем объекты.
$second = $first;
// Изменяем "разумность" у копии!
$second->mind = 100;


// Выводим оба значения.
echo "First mind: {$first->mind}, second: {$second->mind}";
echo "</br>" . $first;
if (defined("pups")) {
    echo "</br>выв" . sin(puPs / 2);
}
$a = ['ds' => 'ds2',
    'dwe' => 'fdw'
];
echo "<pre>";
var_export($first);
"</pre>";
