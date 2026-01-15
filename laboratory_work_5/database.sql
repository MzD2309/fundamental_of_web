CREATE DATABASE IF NOT EXISTS lab5_data CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE lab5_data;

DROP TABLE IF EXISTS images;
DROP TABLE IF EXISTS terms;

CREATE TABLE terms (
    id INT AUTO_INCREMENT PRIMARY KEY,
    term VARCHAR(255) NOT NULL,
    definition TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE images (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    img VARCHAR(255) NOT NULL,
    term_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_term FOREIGN KEY (term_id) REFERENCES terms(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO terms (term, definition) VALUES
('HTML', 'Язык разметки гипертекста для структуры страниц.'),
('CSS', 'Каскадные таблицы стилей, отвечают за внешний вид.'),
('JavaScript', 'Язык программирования для поведения и логики на стороне клиента.'),
('PHP', 'Серверный язык для генерации динамических страниц.'),
('MySQL', 'Реляционная система управления базами данных.'),
('API', 'Интерфейс взаимодействия программных компонентов.'),
('REST', 'Архитектурный стиль создания веб-сервисов.'),
('HTTP', 'Протокол передачи гипертекста.'),
('HTTPS', 'Защищённый HTTP поверх TLS.'),
('JSON', 'Лёгкий текстовый формат обмена данными.');

INSERT INTO images (name, img, term_id) VALUES
('HTML Logo', 'html.png', 1),
('CSS Logo', 'css.png', 2),
('JavaScript Logo', 'javascript.png', 3),
('PHP Logo', 'php.png', 4),
('MySQL Logo', 'mysql.png', 5),
('API Icon', 'api.png', 6),
('REST Icon', 'rest.png', 7),
('HTTP Icon', 'http.png', 8),
('HTTPS Icon', 'https.png', 9),
('JSON Icon', 'json.png', 10);

