CREATE TABLE `transactions` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `transaction_id` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
 `amount` int NOT NULL,
 `currency_code` varchar(4) NOT NULL,
 `date` datetime NOT NULL,
 `status` enum('A','R','D') NOT NULL DEFAULT 'R',
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;