<?php 
function toFeminineSurname(string $surname): string {
    // Исключения (не изменяются)
    $exceptions = [
        'Аксененко', 'Акуленок', 'Бондаренко', 
        'Шевченко', 'Коваленко', 'Ткаченко'
    ];
    
    if (in_array($surname, $exceptions)) {
        return $surname;
    }
    
    // Правила преобразования
    $rules = [
        '/ов$/' => 'ова',
        '/ев$/' => 'ева',
        '/ин$/' => 'ина',
        '/ын$/' => 'ына',
        '/ий$/' => 'ая',
        '/ой$/' => 'ая',
        '/ец$/' => 'ец' // Не изменяется (как "Кулец")
    ];
    
    foreach ($rules as $pattern => $replacement) {
        if (preg_match($pattern, $surname)) {
            return preg_replace($pattern, $replacement, $surname);
        }
    }
    
    // Стандартное правило для остальных случаев
    if (mb_substr($surname, -1) === 'н') {
        return $surname . 'а';
    }
    
    return $surname;
}


function findStudent($group, $name) {
    foreach($group as $user) {
        if(in_array($name, $user)) {
            return $user;
        }
    }
    return null;
}


function phpStudents($group) {
    $phpStudents = [];
    foreach ($group as $user) {
        if(in_array('PHP', $user['course'])) {
            $phpStudents []= $user; 
        }
    }
    return $phpStudents;
}