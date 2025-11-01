<?php

class Menu {
    const MENU = 'default';
    private $conf = [];
    public function __construct($conf)
    {
        $this->conf = $conf;
    }
    public function create() {
        $m = $this->conf[self::MENU]['items'];
        $html = '<ul>';
        foreach($m as $mes) {
            $html .= "<li><a href=\"#{$mes['page']}\" class=\"\">{$mes['label']}</a></li>";
        }
        $html .= '</ul>';
        return $html;
    }
}

$conf = require('conf_menu.php');
$obj = new Menu($conf);
$menu = $obj->create();
?>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>LexiRoRu Admin</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <!-- Меню -->
    <div class="sidebar">
        <?= $menu ?>
    </div>

    <!-- Контент -->
    <div class="main-content">
        <!-- Dashboard -->
        <section id="dashboard" class="tab-content active">
            <h2>Dashboard</h2>
            <div class="stats">
                <p><strong>Всего слов в базе:</strong> <?= $total_words ?></p>
                <p><strong>Активных слов в обучении:</strong> <?= $active_words ?></p>
                <p><strong>Выучено слов:</strong> <?= $mastered_words ?></p>
            </div>
            <div class="calendar">
                <h3>Календарь успехов</h3>
                <div id="calendar-placeholder">
                    <p>Здесь будет отображаться календарь успехов (пока в разработке).</p>
                </div>
            </div>
        </section>

        <!-- Менеджер слов -->
        <section id="wm" class="tab-content">
            <h2>Менеджер слов</h2>
            <p>Здесь будет таблица слов (пока в разработке).</p>
        </section>

        <!-- Настройки -->
        <section id="settings" class="tab-content">
            <h2>Настройки</h2>
            <p>Здесь можно настроить параметры приложения (пока в разработке).</p>
        </section>
    </div>
</div>

<script>
document.querySelectorAll('.sidebar a').forEach(anchor => {
    anchor.addEventListener('click', function(e) {
        e.preventDefault();

        const targetId = this.getAttribute('href').substring(1);
        const targetSection = document.getElementById(targetId);

        // Скрыть все вкладки
        document.querySelectorAll('.tab-content').forEach(tab => tab.classList.remove('active'));
        // Убрать active у всех ссылок
        document.querySelectorAll('.sidebar a').forEach(a => a.classList.remove('active'));

        // Показать нужную вкладку
        targetSection.classList.add('active');
        // Добавить active к текущей ссылке
        this.classList.add('active');
    });
});
</script>

</body>
</html>
