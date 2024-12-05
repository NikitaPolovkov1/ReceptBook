-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:8889
-- Время создания: Дек 05 2024 г., 10:04
-- Версия сервера: 5.7.39
-- Версия PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `recipes_db`
--

-- --------------------------------------------------------

--
-- Структура таблицы `recipes`
--

CREATE TABLE `recipes` (
                           `id` int(11) NOT NULL,
                           `user_id` int(11) NOT NULL,
                           `name` varchar(255) NOT NULL,
                           `ingredients` text NOT NULL,
                           `instructions` text NOT NULL,
                           `image` varchar(255) DEFAULT NULL,
                           `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `recipes`
--

INSERT INTO `recipes` (`id`, `user_id`, `name`, `ingredients`, `instructions`, `image`, `created_at`) VALUES
                                                                                                          (35, 1, 'Паста Карбонара', 'Спагетти, Яйца, Пармезан, Грудинка', '1. Отварите пасту. 2. Обжарьте грудинку. 3. Смешайте яйца с сыром. 4. Соедините все ингредиенты.', '../uploads/6751742f229eb_pasta.jpg', '2024-12-05 09:34:10'),
                                                                                                          (36, 1, 'Куриное карри', 'Курица, Карри паста, Кокосовое молоко, Специи', '1. Обжарьте курицу. 2. Добавьте пасту карри. 3. Влейте кокосовое молоко. 4. Тушите до готовности.', '../uploads/675174c879fb6_images.jpg', '2024-12-05 09:34:10'),
                                                                                                          (37, 1, 'Шоколадный торт', 'Мука, Какао, Сахар, Яйца, Масло', '1. Смешайте ингредиенты. 2. Выпекайте при 180°C 35 минут. 3. Остудите и подавайте.', '../uploads/675174d079142_торт.jpg', '2024-12-05 09:34:10'),
                                                                                                          (38, 1, 'Салат Цезарь', 'Салат Романо, Сухарики, Соус Цезарь, Пармезан', '1. Нарежьте салат. 2. Добавьте сухарики. 3. Заправьте соусом. 4. Посыпьте пармезаном.', '../uploads/675174d75946c_цезарь.jpg', '2024-12-05 09:34:10'),
                                                                                                          (39, 1, 'Бефстроганов', 'Говядина, Лук, Грибы, Сметана', '1. Обжарьте говядину. 2. Добавьте лук и грибы. 3. Перемешайте со сметаной. 4. Подавайте с пастой.', '../uploads/67517535c1d2f_беф.jpg', '2024-12-05 09:34:10'),
                                                                                                          (40, 1, 'Овощное соте', 'Болгарский перец, Брокколи, Соевый соус, Чеснок', '1. Нарежьте овощи. 2. Обжарьте на масле. 3. Добавьте соевый соус. 4. Подавайте горячим.', '../uploads/6751753d2c455_соте.jpg', '2024-12-05 09:34:10'),
                                                                                                          (41, 1, 'Томатный суп', 'Помидоры, Чеснок, Лук, Базилик', '1. Обжарьте чеснок и лук. 2. Добавьте помидоры и базилик. 3. Тушите и измельчите блендером.', '../uploads/6751754681c26_томат.jpg', '2024-12-05 09:34:10'),
                                                                                                          (42, 1, 'Лосось на гриле', 'Лосось, Лимон, Укроп, Оливковое масло', '1. Замаринуйте лосось. 2. Обжарьте на гриле 8 минут. 3. Подавайте с лимоном.', '../uploads/6751754d71859_лосось.jpg', '2024-12-05 09:34:10'),
                                                                                                          (43, 1, 'Блины', 'Мука, Молоко, Яйца, Сахар, Масло', '1. Смешайте ингредиенты. 2. Жарьте на сковороде. 3. Подавайте с сиропом.', '../uploads/67517555b4ffe_блины.jpg', '2024-12-05 09:34:10'),
                                                                                                          (44, 1, 'Пицца Маргарита', 'Тесто для пиццы, Томатный соус, Моцарелла, Базилик', '1. Нанесите соус на тесто. 2. Добавьте моцареллу. 3. Выпекайте при 220°C 15 минут.', '../uploads/6751755b8ebe7_маргарита.jpg', '2024-12-05 09:34:10');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
                         `id` int(11) NOT NULL,
                         `username` varchar(50) NOT NULL,
                         `email` varchar(255) NOT NULL,
                         `password_hash` varchar(255) NOT NULL,
                         `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password_hash`, `created_at`) VALUES
    (1, 'Никита', 'nikitapolovkov1@gmail.com', '$2y$10$JqZTvAOpcNU//hjGLxyyd.Xqb0DPzYyYKTrWIaLhQFxMn8/UJxnYS', '2024-12-05 06:32:39');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `recipes`
--
ALTER TABLE `recipes`
    ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
    ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `recipes`
--
ALTER TABLE `recipes`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `recipes`
--
ALTER TABLE `recipes`
    ADD CONSTRAINT `recipes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
