INSERT INTO `sl_manufacturer` (`ID`, `NAME`) VALUES
(1, 'Msi'),
(2, 'Asus'),
(3, 'HP'),
(4, 'Lenovo'),
(5, 'Samsung');
INSERT INTO `sl_model` (`ID`, `NAME`, `MANUFACTURER_ID`) VALUES
(1, 'Modern 15 1', 1),
(2, 'Katana 11SC 2', 1),
(3, 'Air 3', 2),
(4, 'Air M2 4', 2),
(5, 'B1502CG 5', 3),
(6, 'E1504FA-BQ657 6', 3),
(7, 'Pro Sprint M 7', 4),
(8, 'Pro Sprint S 8', 4),
(9, 'Victus 16-d0053ur 9', 5),
(10, 'ThinkBook 16 10', 1),
(11, 'Modern 54 11', 2),
(12, 'BGUAH 12', 3),
(13, 'Modern 13', 1),
(14, 'Katana 11SC 14', 1),
(15, 'Air 15', 2),
(16, 'Air M2 16', 2),
(17, 'B1502CG 17', 3),
(18, 'E1504FA-BQ657 18', 3),
(19, 'Pro Sprint M 19', 4),
(20, 'Pro Sprint S 20', 4),
(21, 'Victus 16-d0053ur 21', 5),
(22, 'ThinkBook 22', 4),
(23, 'Modern 23', 5),
(24, 'BGUAH 24', 1),
(25, 'Modern 25', 1),
(26, 'Katana 11SC 26', 1),
(27, 'Air 27', 2),
(28, 'Air M2 28', 2),
(29, 'B1502CG 29', 3),
(30, 'E1504FA-BQ657 30', 3),
(31, 'Pro Sprint M 31', 4),
(32, 'Pro Sprint S 32', 4),
(33, 'Victus 16-d0053ur 33', 5),
(34, 'ThinkBook 34', 1),
(35, 'Modern 35', 2),
(36, 'BGUAH 36', 3),
(37, 'Modern 37', 1),
(38, 'Katana 11SC 38', 1),
(39, 'Air 39', 2),
(40, 'Air M2 40', 2),
(41, 'B1502CG 41', 3),
(42, 'E1504FA-BQ657 42', 3),
(43, 'Pro Sprint M 43', 4),
(44, 'Pro Sprint S 44', 4),
(45, 'Victus 16-d0053ur 45', 5),
(46, 'ThinkBook 46', 4),
(47, 'Modern 47', 5),
(48, 'BGUAH-12 48', 1),
(49, 'Modern 49', 1),
(50, 'Katana 11SC 50', 1);
INSERT INTO `sl_laptop` (`ID`, `NAME`, `YEAR`, `PRICE`, `MODEL_ID`) VALUES
(1, 'Ноутбук 1', 2024, 15400, 1),
(2, 'Ноутбук 2', 2023, 35400, 2),
(3, 'Ноутбук 3', 2022, 89400, 3),
(4, 'Ноутбук 4', 2021, 65400, 4),
(5, 'Ноутбук 5', 2021, 75400, 5),
(6, 'Ноутбук 6', 2022, 65400, 6),
(7, 'Ноутбук 7', 2023, 45400, 7),
(8, 'Ноутбук 8', 2024, 25440, 8),
(9, 'Ноутбук 9', 2023, 25440, 9),
(10, 'Ноутбук 10', 2022, 75400, 10);
INSERT INTO `sl_option` (`ID`, `NAME`, `VALUE`) VALUES
(1, 'Цвет', 'черный'),
(2, 'Цвет', 'белый'),
(3, 'Игровой ноутбук', 'да'),
(4, 'Игровой ноутбук', 'нет'),
(5, 'Разрешение экрана', '2560x1600'),
(6, 'Сенсорный экран', 'да'),
(7, 'Сенсорный экран', 'нет'),
(8, 'Тип оперативной памяти', 'DDR5'),
(9, 'Тип оперативной памяти', 'DDR4'),
(10, 'Объем видеопамяти', '16 ГБ');
INSERT INTO `sl_option_to_laptop` (`ID`, `OPTION_ID`, `LAPTOP_ID`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 3, 3),
(4, 4, 4),
(5, 5, 5),
(6, 6, 6),
(7, 7, 7),
(8, 8, 8),
(9, 9, 9),
(10, 10, 10),
(11, 1, 2),
(12, 2, 3),
(13, 3, 4),
(14, 4, 5),
(15, 5, 6),
(16, 6, 7),
(17, 7, 8),
(18, 8, 9),
(19, 9, 10),
(20, 10, 1),
(21, 1, 2),
(22, 2, 3),
(23, 3, 4);