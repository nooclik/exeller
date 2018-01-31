-- phpMyAdmin SQL Dump
-- version 4.4.15.7
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Янв 15 2018 г., 18:35
-- Версия сервера: 5.7.13
-- Версия PHP: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `location`
--

-- --------------------------------------------------------

--
-- Структура таблицы `auth_assignment`
--

CREATE TABLE IF NOT EXISTS `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `auth_assignment`
--

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('admin', '1', NULL),
('customer', '10', 1502214833);

-- --------------------------------------------------------

--
-- Структура таблицы `auth_item`
--

CREATE TABLE IF NOT EXISTS `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `auth_item`
--

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('admin', 1, NULL, NULL, NULL, NULL, NULL),
('contractor', 1, NULL, NULL, NULL, NULL, NULL),
('customer', 1, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `auth_item_child`
--

CREATE TABLE IF NOT EXISTS `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `auth_rule`
--

CREATE TABLE IF NOT EXISTS `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `auth_rule`
--

INSERT INTO `auth_rule` (`name`, `data`, `created_at`, `updated_at`) VALUES
('admin', NULL, NULL, NULL),
('contractor', NULL, NULL, NULL),
('customer', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `category_product`
--

CREATE TABLE IF NOT EXISTS `category_product` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `disabled` int(1) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `category_product`
--

INSERT INTO `category_product` (`id`, `name`, `disabled`) VALUES
(1, 'Компьютерная техника', NULL),
(2, 'Автозапчасти', NULL),
(3, 'Электроника', NULL),
(4, 'Бытовая техника', NULL),
(5, 'Стройка и ремонт', NULL),
(6, 'Красота и спорт', NULL),
(7, 'Детям и мамам', NULL),
(8, 'Работа и офис', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `category_service`
--

CREATE TABLE IF NOT EXISTS `category_service` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `section_id` int(11) DEFAULT NULL,
  `disabled` int(1) DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=161 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `category_service`
--

INSERT INTO `category_service` (`id`, `name`, `section_id`, `disabled`) VALUES
(1, 'Услуги пешего курьера', 1, 0),
(2, 'Услуги курьера на легковом авто', 1, 0),
(3, 'Купить и доставить', 1, 0),
(4, 'Срочная доставка', 1, 0),
(5, 'Доставка продуктов', 1, 0),
(6, 'Курьер на день', 1, 0),
(7, 'Мастер на час', 2, 0),
(8, 'Ремонт под ключ', 2, 0),
(9, 'Сантехнические работы', 2, 0),
(10, 'Электромонтажные работы', 2, 0),
(11, 'Отделочные работы', 2, 0),
(12, 'Потолки', 2, 0),
(13, 'Полы', 2, 0),
(14, 'Плиточные работы', 2, 0),
(15, 'Сборка и ремонт мебели', 2, 0),
(16, 'Установка и ремонт дверей, замков', 2, 0),
(17, 'Окна, остекление, балконы', 2, 0),
(18, 'Кровельные и фасадные работы', 2, 0),
(19, 'Отопление, водоснабжение, канализация', 2, 0),
(20, 'Изоляционные работы', 2, 0),
(21, 'Строительно-монтажные работы', 2, 0),
(22, 'Крупное строительство', 2, 0),
(23, 'Охранные системы', 2, 0),
(24, 'Что-то другое', 2, 0),
(25, 'Перевозка вещей, переезды', 3, 0),
(26, 'Пассажирские перевозки', 3, 0),
(27, 'Строительные грузы и оборудование', 3, 0),
(28, 'Вывоз мусора', 3, 0),
(29, 'Эвакуаторы', 3, 0),
(30, 'Междугородные перевозки', 3, 0),
(31, 'Услуги грузчиков', 3, 0),
(32, 'Перевозка продуктов', 3, 0),
(33, 'Услуги манипулятора', 3, 0),
(34, 'Другой груз', 3, 0),
(35, 'Поддерживающая уборка', 4, 0),
(36, 'Генеральная уборка', 4, 0),
(37, 'Мытье окон', 4, 0),
(38, 'Вынос мусора', 4, 0),
(39, 'Помощь швеи', 4, 0),
(40, 'Приготовление еды', 4, 0),
(41, 'Глажение белья', 4, 0),
(42, 'Химчистка', 4, 0),
(43, 'Уход за животными', 4, 0),
(44, 'Работы в саду, огороде, на участке', 4, 0),
(45, 'Сиделки', 4, 0),
(46, 'Няни', 4, 0),
(47, 'Что-то другое', 4, 0),
(48, 'Ремонт компьютеров и ноутбуков', 6, 0),
(49, 'Установка и настройка операц. систем, программ', 6, 0),
(50, 'Удаление вирусов', 6, 0),
(51, 'Настройка интернета и Wi-Fi', 6, 0),
(52, 'Ремонт и замена комплектующих', 6, 0),
(53, 'Восстановление данных', 6, 0),
(54, 'Настройка и ремонт оргтехники', 6, 0),
(55, 'Консультация и обучение', 6, 0),
(56, 'Что-то другое', 6, 0),
(57, 'Холодильники и морозильные камеры', 11, 0),
(58, 'Стиральные и сушильные машины', 11, 0),
(59, 'Посудомоечные машины', 11, 0),
(60, 'Электрические плиты и панели', 11, 0),
(61, 'Газовые плиты', 11, 0),
(62, 'Духовые шкафы', 11, 0),
(63, 'Вытяжки', 11, 0),
(64, 'Климатическая техника', 11, 0),
(65, 'Водонагреватели, бойлеры, котлы, колонки', 11, 0),
(66, 'Швейные машины', 11, 0),
(67, 'Пылесосы и очистители', 11, 0),
(68, 'Утюги и уход за одеждой', 11, 0),
(69, 'Кофемашины', 11, 0),
(70, 'СВЧ печи', 11, 0),
(71, 'Мелкая кухонная техника', 11, 0),
(72, 'Уход за телом и здоровьем', 11, 0),
(73, 'Работа с текстом, копирайтинг, переводы', 5, 0),
(74, 'Поиск и обработка информации', 5, 0),
(75, 'Работа в Excel, Power Point и т.д.', 5, 0),
(76, 'Расшифровка аудио- и видеозаписей', 5, 0),
(77, 'Размещение объявлений', 5, 0),
(78, 'Реклама и продвижение в интернете', 5, 0),
(79, 'Обзвон по базе', 5, 0),
(80, 'Что-то другое', 5, 0),
(81, 'Помощь в проведении мероприятий', 7, 0),
(82, 'Раздача промо-материалов', 7, 0),
(83, 'Тайный покупатель', 7, 0),
(84, 'Разнорабочий', 7, 0),
(85, 'Промоутер', 7, 0),
(86, 'Тамада, ведущий, аниматор', 7, 0),
(87, 'Промо-модель', 7, 0),
(88, 'Что-то другое', 7, 0),
(89, 'Фирменный стиль, логотипы, визитки', 8, 0),
(90, 'Полиграфический дизайн', 8, 0),
(91, 'Иллюстрации, живопись, граффити', 8, 0),
(92, 'Дизайн сайтов и приложений', 8, 0),
(93, 'Интернет баннеры, оформление соц.сетей', 8, 0),
(94, '3d-графика, анимация', 8, 0),
(95, 'Инфографика, презентации, иконки', 8, 0),
(96, 'Наружная реклама, стенды, pos-материалы', 8, 0),
(97, 'Архитектура, интерьер, ландшафт', 8, 0),
(98, 'Что-то другое', 8, 0),
(99, 'Сайт под ключ', 9, 0),
(100, 'Доработка и поддержка сайта', 9, 0),
(101, 'Программирование и разработка ПО', 9, 0),
(102, 'Программирование и разработка ПО', 9, 0),
(103, 'Верстка', 9, 0),
(104, 'Разработка мобильных приложений', 9, 0),
(105, 'Что-то другое', 9, 0),
(106, 'Фотосъемка', 10, 0),
(107, 'Видеосъемка', 10, 0),
(108, 'Ретушь фотографий', 10, 0),
(109, 'Создание видеороликов под ключ', 10, 0),
(110, 'Монтаж и цветокоррекция видео', 10, 0),
(111, 'Оцифровка', 10, 0),
(112, 'Что-то другое', 10, 0),
(113, 'Парикмахерские услуги', 12, 0),
(114, 'Ногтевой сервис', 12, 0),
(115, 'Массаж', 12, 0),
(116, 'Косметология, макияж', 12, 0),
(117, 'Стилисты и имиджмейкеры', 12, 0),
(118, 'Персональный тренер', 12, 0),
(119, 'Что-то другое', 12, 0),
(120, 'Планшеты и телефоны', 13, 0),
(121, 'Аудиотехника и системы', 13, 0),
(122, 'Телевизоры и мониторы', 13, 0),
(123, 'Автомобильная электроника', 13, 0),
(124, 'Видео/фототехника', 13, 0),
(125, 'Игровые приставки', 13, 0),
(126, 'Спутниковые и эфирные антенны', 13, 0),
(127, 'Часы и хронометры', 13, 0),
(128, 'Что-то другое', 13, 0),
(129, 'Юридическая консультация', 14, 0),
(130, 'Составление и проверка договоров', 14, 0),
(131, 'Составление и подача жалоб, исков', 14, 0),
(132, 'Оформление документов', 14, 0),
(133, 'Регистрация, ликвидация компаний', 14, 0),
(134, 'Что-то другое', 14, 0),
(135, 'Иностранные языки', 15, 0),
(136, 'Подготовка к школе', 15, 0),
(137, 'Начальная школа', 15, 0),
(138, 'Средняя школа, выпускные классы', 15, 0),
(139, 'Подготовка к ГИА', 15, 0),
(140, 'Подготовка к ЕГЭ', 15, 0),
(141, 'Вузовская программа', 15, 0),
(142, 'Логопеды', 15, 0),
(143, 'Музыка', 15, 0),
(144, 'Спорт', 15, 0),
(145, 'Красота и уход за собой', 15, 0),
(146, 'Рукоделие и хобби', 15, 0),
(147, 'Что-то другое', 15, 0),
(148, 'Техническое обслуживание автомобиля', 16, 0),
(149, 'Диагностика и ремонт двигателя, КПП и ходовой част', 16, 0),
(150, 'Обслуживание системы кондиционирования', 16, 0),
(151, 'Кузовной ремонт', 16, 0),
(152, 'Автоэлектрика', 16, 0),
(153, 'Автостекла и тонировка', 16, 0),
(154, 'Шиномонтаж', 16, 0),
(155, 'Мойка и химчистка', 16, 0),
(156, 'Тюнинг (внешний и внутренний)', 16, 0),
(157, 'Помощь на дороге', 16, 0),
(158, 'Мотосервис', 16, 0),
(159, 'Что-то другое', 16, 0),
(160, 'Другая посылка', 1, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `category_work`
--

CREATE TABLE IF NOT EXISTS `category_work` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `disabled` int(1) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `category_work`
--

INSERT INTO `category_work` (`id`, `name`, `disabled`) VALUES
(1, 'Автомобильный бизнес', NULL),
(2, 'Административный персонал', NULL),
(3, 'Банки, инвестиции, лизинг', NULL),
(4, 'Безопасность', NULL),
(5, 'Бухгалтерия, управленческий учет, финансы предприятия', NULL),
(6, 'Высший менеджмент', NULL),
(7, 'Государственная служба, некоммерческие организации', NULL),
(8, 'Добыча сырья', NULL),
(9, 'Домашний персонал', NULL),
(10, 'Закупки', NULL),
(11, 'Инсталляция и сервис', NULL),
(12, 'Информационные технологии, интернет, телеком', NULL),
(13, 'Искусство, развлечения, масс-медиа', NULL),
(14, 'Консультирование', NULL),
(15, 'Маркетинг, реклама, PR', NULL),
(16, 'Медицина, фармацевтика', NULL),
(17, 'Наука, образование', NULL),
(18, 'Начало карьеры, студенты', NULL),
(19, 'Продажи', NULL),
(20, 'Производство', NULL),
(21, 'Рабочий персонал', NULL),
(22, 'Спортивные клубы, фитнес, салоны красоты', NULL),
(23, 'Страхование', NULL),
(24, 'Строительство, недвижимость', NULL),
(25, 'Транспорт, логистика', NULL),
(26, 'Туризм, гостиницы, рестораны', NULL),
(27, 'Управление персоналом, тренинги', NULL),
(28, 'Юристы', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `city`
--

CREATE TABLE IF NOT EXISTS `city` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `region` varchar(50) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `city`
--

INSERT INTO `city` (`id`, `name`, `region`) VALUES
(1, 'Ошмяны', 'Гродненская'),
(2, 'Сморгонь', 'Гродненская'),
(3, 'Минск', 'Минская'),
(4, 'Гродно', 'Гродненская'),
(5, 'Витебск', 'Витебская'),
(6, 'Могилев', 'Могилевская'),
(7, 'Брест', 'Брестская'),
(8, 'Молодечно', 'Минская');

-- --------------------------------------------------------

--
-- Структура таблицы `complaint`
--

CREATE TABLE IF NOT EXISTS `complaint` (
  `id` int(11) NOT NULL,
  `post_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `motive` varchar(255) DEFAULT NULL,
  `publish` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `complaint`
--

INSERT INTO `complaint` (`id`, `post_id`, `user_id`, `motive`, `publish`) VALUES
(8, 10, 1, 'Задевает права человека', '2017-08-04 11:55:24');

-- --------------------------------------------------------

--
-- Структура таблицы `deal`
--

CREATE TABLE IF NOT EXISTS `deal` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `contractor_id` int(11) DEFAULT NULL,
  `request_id` int(11) DEFAULT NULL,
  `status` varchar(25) DEFAULT NULL,
  `message` longtext,
  `publish` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `deal`
--

INSERT INTO `deal` (`id`, `customer_id`, `contractor_id`, `request_id`, `status`, `message`, `publish`) VALUES
(7, 1, 1, 12, NULL, NULL, NULL),
(8, 1, 1, 13, 'Выполнено', 'Тоже готов выполнить', NULL),
(18, 1, 2, 14, 'Исполнитель выбран', 'Готов выполнить быстро и качественно', '2017-09-12 14:34:47'),
(19, 1, 8, 14, 'Выполнено', 'Тоже могу зрабить', '2017-09-11 14:33:11'),
(20, 1, 8, 1, NULL, 'Могу выполнить в срок!', '2017-09-26 14:17:22'),
(21, 1, 2, 1, 'Исполнитель выбран', 'Могу сделать дешевле', '2017-09-26 14:18:38'),
(22, 1, 8, 10, NULL, 'Возьмусь за работу, сделаю за день', '2017-10-14 10:33:40'),
(23, 1, 2, 10, 'Выполнено', 'я сгоняю', '2017-10-14 16:04:35'),
(25, 1, 2, 15, 'Выполнена', 'Сделаю', '2017-10-18 18:17:57');

-- --------------------------------------------------------

--
-- Структура таблицы `delivery`
--

CREATE TABLE IF NOT EXISTS `delivery` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `delivery`
--

INSERT INTO `delivery` (`id`, `name`) VALUES
(1, 'Доставка курьером'),
(2, 'Самовывоз');

-- --------------------------------------------------------

--
-- Структура таблицы `message`
--

CREATE TABLE IF NOT EXISTS `message` (
  `id` int(11) NOT NULL,
  `user_id_from` int(11) DEFAULT NULL,
  `user_id_to` int(11) DEFAULT NULL,
  `text` longtext,
  `attachment` varchar(50) DEFAULT NULL,
  `publish` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `message`
--

INSERT INTO `message` (`id`, `user_id_from`, `user_id_to`, `text`, `attachment`, `publish`) VALUES
(7, 2, 8, 'Привет, тестовое сообщение', NULL, '2017-09-16 16:31:50'),
(11, 1, 1, '<p>Привет, давай дружить</p>\r\n', '', '2017-10-14 10:39:00');

-- --------------------------------------------------------

--
-- Структура таблицы `migration`
--

CREATE TABLE IF NOT EXISTS `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1498299321),
('m130524_201442_init', 1498299326),
('m140506_102106_rbac_init', 1502205570);

-- --------------------------------------------------------

--
-- Структура таблицы `notice_user`
--

CREATE TABLE IF NOT EXISTS `notice_user` (
  `id` int(11) NOT NULL,
  `notice` varchar(25) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `notice_user`
--

INSERT INTO `notice_user` (`id`, `notice`, `user_id`) VALUES
(7, 'Товары', 2),
(42, 'Услуги', 1),
(43, 'Резюме', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `payment`
--

CREATE TABLE IF NOT EXISTS `payment` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `payment`
--

INSERT INTO `payment` (`id`, `name`) VALUES
(1, 'Наличный'),
(2, 'Безналичный');

-- --------------------------------------------------------

--
-- Структура таблицы `request_product`
--

CREATE TABLE IF NOT EXISTS `request_product` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `category` int(11) DEFAULT NULL,
  `short_description` varchar(255) DEFAULT NULL,
  `full_description` varchar(255) DEFAULT NULL,
  `condition` varchar(25) DEFAULT NULL,
  `price` decimal(19,2) DEFAULT NULL,
  `delivery_id` int(11) DEFAULT NULL,
  `status` varchar(25) DEFAULT NULL,
  `count_view` int(11) NOT NULL DEFAULT '0',
  `publish` datetime DEFAULT NULL,
  `update` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `request_product`
--

INSERT INTO `request_product` (`id`, `user_id`, `category`, `short_description`, `full_description`, `condition`, `price`, `delivery_id`, `status`, `count_view`, `publish`, `update`) VALUES
(1, 1, 1, 'Ноутбук Lenovo', 'Описание товара, его характеристики', 'Новое', '12.00', 1, 'Не актуально', 0, '2017-09-25 15:51:25', '2017-10-14 16:10:02'),
(2, 1, 3, 'Часы электронные', '\r\nОписание товара, его характеристики', 'Новое', '12.00', 2, 'Актуально', 0, '2017-09-25 16:10:32', '2017-10-14 16:20:50');

-- --------------------------------------------------------

--
-- Структура таблицы `request_service`
--

CREATE TABLE IF NOT EXISTS `request_service` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `category` int(11) DEFAULT NULL,
  `short_description` varchar(255) DEFAULT NULL,
  `description` longtext,
  `date_to_date_before` date DEFAULT NULL,
  `date_to_date_after` date DEFAULT NULL,
  `date_to_time_before` time DEFAULT NULL,
  `date_to_time_after` time DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `customer_info` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `payment_id` int(11) unsigned DEFAULT NULL,
  `price` decimal(19,2) DEFAULT NULL,
  `attachment` varchar(255) DEFAULT NULL,
  `status` varchar(25) DEFAULT NULL,
  `publish` datetime DEFAULT NULL,
  `update` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `request_service`
--

INSERT INTO `request_service` (`id`, `user_id`, `category`, `short_description`, `description`, `date_to_date_before`, `date_to_date_after`, `date_to_time_before`, `date_to_time_after`, `city`, `customer_info`, `address`, `payment_id`, `price`, `attachment`, `status`, `publish`, `update`) VALUES
(10, 1, 48, 'Замена матрицы', 'Разбит экран ноутбука', '2017-09-26', '2017-10-31', NULL, NULL, 'Ошмяны', NULL, 'Советская, 100', 1, '120.00', 'matrica.jpg', 'Закрыта', '2017-09-26 16:23:09', '2017-10-14 16:06:25'),
(14, 1, 1, 'Сгонять за пивасом', 'ghgfhgfhgf', '2017-11-05', NULL, '15:17:00', '15:17:00', 'Ошмяны', NULL, 'Советская', 1, '5.00', NULL, 'Активна', '2017-10-27 15:41:22', '2017-10-27 15:41:29');

-- --------------------------------------------------------

--
-- Структура таблицы `resume`
--

CREATE TABLE IF NOT EXISTS `resume` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `category` int(11) DEFAULT NULL,
  `post` varchar(255) DEFAULT NULL,
  `salary` decimal(5,2) DEFAULT NULL,
  `experience` decimal(5,2) DEFAULT NULL,
  `skills` varchar(255) DEFAULT NULL,
  `education` varchar(25) DEFAULT NULL,
  `institution` longtext,
  `age` int(2) DEFAULT NULL,
  `sex` varchar(10) DEFAULT NULL,
  `city` varchar(25) DEFAULT NULL,
  `details` longtext,
  `status` varchar(25) DEFAULT NULL,
  `publish` datetime DEFAULT NULL,
  `update` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='у';

--
-- Дамп данных таблицы `resume`
--

INSERT INTO `resume` (`id`, `user_id`, `category`, `post`, `salary`, `experience`, `skills`, `education`, `institution`, `age`, `sex`, `city`, `details`, `status`, `publish`, `update`) VALUES
(1, 1, 12, 'Программист', '650.00', '5.00', 'a:3:{i:0;s:3:"Css";i:1;s:10:"JavaScript";i:2;s:3:"PHP";}', 'Высшее', 'a:4:{s:11:"place_study";s:10:"БарГУ";s:7:"faculty";s:20:"Инженерный";s:10:"speciality";s:67:"Информационные системы и технологии";s:4:"year";s:4:"2015";}', 28, 'Мужской', 'Ошмяны', NULL, 'Актуально', '2017-09-26 08:39:18', '2017-10-12 11:24:54');

-- --------------------------------------------------------

--
-- Структура таблицы `review`
--

CREATE TABLE IF NOT EXISTS `review` (
  `id` int(11) NOT NULL,
  `contractor_id` int(11) DEFAULT NULL,
  `post_id` int(11) DEFAULT NULL,
  `rewiew` varchar(255) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  `publish` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `review`
--

INSERT INTO `review` (`id`, `contractor_id`, `post_id`, `rewiew`, `rating`, `publish`) VALUES
(2, 1, 12, 'Пришел пьяным', 2, NULL),
(3, 2, 14, 'Норм исполнитель', 4, NULL),
(4, 2, 18, 'jkuiutyuyt', NULL, NULL),
(5, 1, 13, 'Толковы', 4, NULL),
(6, NULL, NULL, 'Выполнено качественно', 5, '2017-09-16 17:14:00'),
(7, NULL, NULL, 'Все норм сделал', 3, '2017-09-16 17:36:24'),
(8, NULL, NULL, 'отзыв', 4, '2017-10-14 16:06:25'),
(9, NULL, NULL, 'gdfh', 5, '2017-10-14 17:22:00'),
(10, NULL, NULL, 'hkl;lkjhgfd', 5, '2017-10-14 17:23:59'),
(11, NULL, NULL, 'dtrfghfd', 5, '2017-10-14 17:25:23'),
(12, NULL, NULL, '12уавыавыа', 4, '2017-10-18 19:10:29');

-- --------------------------------------------------------

--
-- Структура таблицы `section_service`
--

CREATE TABLE IF NOT EXISTS `section_service` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `thumbnail` varchar(50) DEFAULT NULL,
  `disabled` int(1) unsigned DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `section_service`
--

INSERT INTO `section_service` (`id`, `name`, `thumbnail`, `disabled`) VALUES
(1, 'Курьерские услуги', '', 0),
(2, 'Бытовой ремонт', NULL, 0),
(3, 'Грузоперевозки', NULL, 0),
(4, 'Уборка и помощь по хозяйству', NULL, 0),
(5, 'Виртуальный помощник', NULL, 0),
(6, 'Компьютерная помощь', NULL, 0),
(7, 'Мероприятия и промо-акции', NULL, 0),
(8, 'Дизайн', NULL, 0),
(9, 'Web-разработка', NULL, 0),
(10, 'Фото- и видео-услуги', NULL, 0),
(11, 'Установка и ремонт техники', NULL, 0),
(12, 'Красота и здоровье', NULL, 0),
(13, 'Ремонт цифровой техники', NULL, 0),
(14, 'Юридическая помощь', NULL, 0),
(15, 'Репетиторы и образование', NULL, 0),
(16, 'Ремонт транспорта', NULL, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `track`
--

CREATE TABLE IF NOT EXISTS `track` (
  `id` int(11) NOT NULL,
  `start` varchar(50) DEFAULT NULL,
  `finish` varchar(50) DEFAULT NULL,
  `date_start` date DEFAULT NULL,
  `points` varchar(255) DEFAULT NULL,
  `detail` varchar(255) DEFAULT NULL,
  `action` varchar(25) DEFAULT NULL,
  `status` varchar(25) DEFAULT NULL,
  `use_id` int(11) DEFAULT NULL,
  `update` datetime DEFAULT NULL,
  `publish` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nicename` varchar(55) COLLATE utf8_unicode_ci DEFAULT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `activity_data` longtext COLLATE utf8_unicode_ci,
  `personal_data` longtext COLLATE utf8_unicode_ci,
  `contractor` tinyint(1) DEFAULT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `username`, `nicename`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `phone`, `city`, `activity_data`, `personal_data`, `contractor`, `status`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'Дашкевич Евгений', 'YdfBzmcy1077xig-EERyMAUBKof_rJ4p', '$2y$13$RWIYQDQdUkAoC9UZ4DJ25eVVHEkVzmPpWj9L5J96Cfk38B.Bqf282', NULL, 'admin@mail.ru', '+375291397144', 'Ошмяны', 'a:4:{s:3:"UNN";N;s:13:"legal_address";N;s:8:"activity";N;s:17:"organization_form";s:31:"Юридическое лицо";}', 'a:13:{s:14:"actual_address";N;s:4:"name";s:14:"Евгений";s:7:"surname";s:16:"Дашкевич";s:3:"age";i:28;s:3:"sex";s:14:"Мужской";s:18:"url_social_network";N;s:8:"category";s:1:"1";s:6:"region";s:18:"Брестская";s:6:"street";s:18:"Советская";s:3:"day";s:1:"5";s:5:"month";s:2:"08";s:4:"year";s:4:"1989";s:9:"thumbnail";s:7:"get.jpg";}', 1, 10, 1498300276, 1506436004),
(2, 'new user', 'Степанико Степан', 'FcyMz-R14jnlirfUDWAKEP-81PvhTUlw', '$2y$13$KmQg.HvWtv7cm8I/0bZ9lesJr40ApJvY43ytetYl9tvrLW3f01m0u', NULL, 'admin@mail.ruq', NULL, NULL, NULL, NULL, NULL, 10, 1498550511, 1498550511),
(8, 'new user1222r', 'Иванов Иван', 'chRz_5y3Xrsku8I44OT2YchLosNBEhTy', '$2y$13$TQkCufMKIBJy5vd.Q7cYou3GRRG52f1sRyirGnuHBIo1x8P4JmNoq', NULL, 'noocli5k@gmail.com', 'admin', NULL, NULL, NULL, NULL, 10, 1502208005, 1502208005),
(9, 'new user12', NULL, 'uXsmYjH3HHy8F8aYpzdgHDv7lXknYRhk', '$2y$13$Ni1i3ZNlvAcwfedBLhFWV.IjDQqm.1wj5u20DEXbKL.aHr4HMtMxC', NULL, 'dadada@mail.ru', 'admin', NULL, NULL, NULL, NULL, 10, 1502208044, 1502208044),
(10, 'new user1222', NULL, 'EP_5rMlhuxi5zWHIn8sikCBVYjmr2eBB', '$2y$13$HxqmU9yQ4zsOYZc2BTxoYeJSnV3fr0YPvoFnpXeorhi1Jfo7KHEZy', NULL, 'dfsdfsdfsd@mail.ru', '+375291397144', NULL, NULL, NULL, NULL, 10, 1502208098, 1502208098);

-- --------------------------------------------------------

--
-- Структура таблицы `user_section`
--

CREATE TABLE IF NOT EXISTS `user_section` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `section_id` int(11) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `vacancy`
--

CREATE TABLE IF NOT EXISTS `vacancy` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `category` int(11) DEFAULT NULL,
  `price` decimal(19,2) DEFAULT NULL,
  `description` longtext,
  `post` varchar(25) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `experience` decimal(5,2) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `status` varchar(25) DEFAULT NULL,
  `publish` datetime DEFAULT NULL,
  `update` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `vacancy`
--

INSERT INTO `vacancy` (`id`, `name`, `category`, `price`, `description`, `post`, `city`, `experience`, `user_id`, `status`, `publish`, `update`) VALUES
(1, 'БПС-Банк', 3, '500.00', 'a:7:{s:4:"type";s:6:"ООО";s:4:"sait";s:0:"";s:11:"description";s:40:"<p>Отличные условия</p>\r\n";s:5:"email";s:14:"dadada@mail.ru";s:5:"phone";s:13:"+375296325451";s:14:"contact_person";s:2:"я";s:6:"charge";s:49:"<p>Работа с бухгалтерией</p>\r\n";}', 'Бухгалтер', 'Ошмяны', '2.00', 1, 'Актуальная', '2017-09-26 08:42:39', '2017-09-26 08:42:39'),
(2, 'Хуитчик', 8, '350.00', 'a:7:{s:4:"type";s:6:"ОАО";s:4:"sait";s:0:"";s:11:"description";s:101:"<ul>\r\n	<li>бусплатное пойло</li>\r\n	<li>бесплатный хавчик</li>\r\n</ul>\r\n";s:5:"email";s:17:"nooclik@gmail.com";s:5:"phone";s:13:"+375291397144";s:14:"contact_person";s:2:"Я";s:6:"charge";s:0:"";}', 'Добытчик', 'Сморгонь', '3.00', 1, 'Актуальная', '2017-10-14 16:11:26', '2017-10-14 16:21:47');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD PRIMARY KEY (`item_name`,`user_id`);

--
-- Индексы таблицы `auth_item`
--
ALTER TABLE `auth_item`
  ADD PRIMARY KEY (`name`),
  ADD KEY `rule_name` (`rule_name`),
  ADD KEY `idx-auth_item-type` (`type`);

--
-- Индексы таблицы `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD PRIMARY KEY (`parent`,`child`),
  ADD KEY `child` (`child`);

--
-- Индексы таблицы `auth_rule`
--
ALTER TABLE `auth_rule`
  ADD PRIMARY KEY (`name`);

--
-- Индексы таблицы `category_product`
--
ALTER TABLE `category_product`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `category_service`
--
ALTER TABLE `category_service`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `category_work`
--
ALTER TABLE `category_work`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `complaint`
--
ALTER TABLE `complaint`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `deal`
--
ALTER TABLE `deal`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `delivery`
--
ALTER TABLE `delivery`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Индексы таблицы `notice_user`
--
ALTER TABLE `notice_user`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `request_product`
--
ALTER TABLE `request_product`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `request_service`
--
ALTER TABLE `request_service`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `resume`
--
ALTER TABLE `resume`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `section_service`
--
ALTER TABLE `section_service`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `track`
--
ALTER TABLE `track`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`);

--
-- Индексы таблицы `user_section`
--
ALTER TABLE `user_section`
  ADD PRIMARY KEY (`id`,`user_id`);

--
-- Индексы таблицы `vacancy`
--
ALTER TABLE `vacancy`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `category_product`
--
ALTER TABLE `category_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT для таблицы `category_service`
--
ALTER TABLE `category_service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=161;
--
-- AUTO_INCREMENT для таблицы `category_work`
--
ALTER TABLE `category_work`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT для таблицы `city`
--
ALTER TABLE `city`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT для таблицы `complaint`
--
ALTER TABLE `complaint`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT для таблицы `deal`
--
ALTER TABLE `deal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT для таблицы `delivery`
--
ALTER TABLE `delivery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT для таблицы `notice_user`
--
ALTER TABLE `notice_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=44;
--
-- AUTO_INCREMENT для таблицы `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `request_product`
--
ALTER TABLE `request_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `request_service`
--
ALTER TABLE `request_service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT для таблицы `resume`
--
ALTER TABLE `resume`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT для таблицы `review`
--
ALTER TABLE `review`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT для таблицы `section_service`
--
ALTER TABLE `section_service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT для таблицы `track`
--
ALTER TABLE `track`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT для таблицы `user_section`
--
ALTER TABLE `user_section`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `vacancy`
--
ALTER TABLE `vacancy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `auth_item`
--
ALTER TABLE `auth_item`
  ADD CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
