<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Лабораторная работа №9 – Вариант 10 – Задолинный Михаил, группа 241-361</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<header class="site-header">
    <div class="header-info">
        <h1>Лабораторная работа №9</h1>
        <p>Циклические алгоритмы. Условия в алгоритмах. Табулирование функций.</p>
        <p>Студент: Задолинный Михаил, группа 241-361, вариант 10</p>
    </div>
</header>

<main>
    <?php
    $startX = 0;
    $stepsCount = 15;
    $step = 1;

    $minFuncLimit = -1000000;
    $maxFuncLimit = 1000000;

    $layoutType = 'E';

    function f_variant10($x)
    {
        if ($x <= 10) {
            if ($x == 0) {
                return 'error';
            }
            $y = 3 / $x + $x / 3 - 5;
        } elseif ($x < 20) {
            $y = ($x - 7) * $x / 8;
        } else {
            $y = 3 * $x + 2;
        }

        return $y;
    }

    $rows = [];
    $currentX = $startX;

    $sum = 0.0;
    $minValue = null;
    $maxValue = null;
    $validCount = 0;

    for ($i = 0; $i < $stepsCount; $i++) {
        $x = $currentX;
        $y = f_variant10($x);

        $rows[] = [
            'index' => $i + 1,
            'x' => $x,
            'y' => $y
        ];

        if (is_numeric($y)) {
            if ($y < $minFuncLimit || $y > $maxFuncLimit) {
                break;
            }

            $sum += $y;
            $validCount++;

            if ($minValue === null || $y < $minValue) {
                $minValue = $y;
            }
            if ($maxValue === null || $y > $maxValue) {
                $maxValue = $y;
            }
        }

        $currentX += $step;
    }

    $average = $validCount > 0 ? $sum / $validCount : null;

    function format_value($value)
    {
        if ($value === null) {
            return '—';
        }
        if (!is_numeric($value)) {
            return $value;
        }
        return round((float)$value, 3);
    }

    function layout_name($layoutType)
    {
        switch ($layoutType) {
            case 'A':
                return 'Простой текст с разделителем &lt;br&gt;';
            case 'B':
                return 'Маркированный список (ul, li)';
            case 'C':
                return 'Нумерованный список (ol, li)';
            case 'D':
                return 'Таблица (табличная верстка)';
            case 'E':
                return 'Блочная верстка (div-блоки в ряд)';
            default:
                return 'Неизвестный тип верстки';
        }
    }
    ?>

    <section class="description">
        <h2>Табулирование функции (вариант 10)</h2>
        <p>
            Функция:
        </p>
        <p class="formula">
            f(x) =
            <span>
                &#123;
                <br>3/x + x/3 - 5, при x ≤ 10
                <br>(x - 7)·x / 8, при 10 &lt; x &lt; 20
                <br>3x + 2, при x ≥ 20
            </span>
        </p>
        <p>
            Начальное значение аргумента: <strong><?php echo $startX; ?></strong><br>
            Количество шагов: <strong><?php echo $stepsCount; ?></strong><br>
            Величина шага: <strong><?php echo $step; ?></strong>
        </p>
        <p>
            Тип верстки: <strong><?php echo htmlspecialchars($layoutType); ?></strong>
        </p>
    </section>

    <section class="results">
        <h2>Результаты вычислений</h2>

        <?php if (empty($rows)) : ?>
            <p>Нет рассчитанных значений (проверьте параметры цикла и ограничения функции).</p>
        <?php else : ?>
            <?php
            switch ($layoutType) {
                case 'A':
                    // Простой текст с <br>
                    foreach ($rows as $row) {
                        echo 'f(' . round($row['x'], 3) . ') = ' . format_value($row['y']) . '<br>';
                    }
                    break;

                case 'B':
                    // Маркированный список
                    echo '<ul>';
                    foreach ($rows as $row) {
                        echo '<li>f(' . round($row['x'], 3) . ') = ' . format_value($row['y']) . '</li>';
                    }
                    echo '</ul>';
                    break;

                case 'C':
                    // Нумерованный список
                    echo '<ol>';
                    foreach ($rows as $row) {
                        echo '<li>f(' . round($row['x'], 3) . ') = ' . format_value($row['y']) . '</li>';
                    }
                    echo '</ol>';
                    break;

                case 'D':
                    // Таблица
                    echo '<table class="results-table">';
                    echo '<thead><tr><th>№</th><th>x</th><th>f(x)</th></tr></thead><tbody>';
                    foreach ($rows as $row) {
                        echo '<tr>';
                        echo '<td>' . $row['index'] . '</td>';
                        echo '<td>' . round($row['x'], 3) . '</td>';
                        echo '<td>' . format_value($row['y']) . '</td>';
                        echo '</tr>';
                    }
                    echo '</tbody></table>';
                    break;

                case 'E':
                    // Блочная верстка
                    echo '<div class="blocks-container">';
                    foreach ($rows as $row) {
                        echo '<div class="result-block">';
                        echo '<div>№ ' . $row['index'] . '</div>';
                        echo '<div>x = ' . round($row['x'], 3) . '</div>';
                        echo '<div>f(x) = ' . format_value($row['y']) . '</div>';
                        echo '</div>';
                    }
                    echo '</div>';
                    break;

                default:
                    echo '<p>Неизвестный тип верстки. Проверьте значение переменной <code>$layoutType</code>.</p>';
                    break;
            }
            ?>
        <?php endif; ?>
    </section>

    <section class="statistics">
        <h2>Статистика</h2>
        <ul>
            <li>Максимальное значение: <strong><?php echo format_value($maxValue); ?></strong></li>
            <li>Минимальное значение: <strong><?php echo format_value($minValue); ?></strong></li>
            <li>Сумма значений: <strong><?php echo format_value($sum); ?></strong></li>
            <li>Среднее арифметическое: <strong><?php echo format_value($average); ?></strong></li>
        </ul>
    </section>
</main>

<footer class="site-footer">
    <div class="footer-content">
        <span>Тип верстки: <?php echo layout_name($layoutType); ?></span>
    </div>
</footer>
</body>
</html>


