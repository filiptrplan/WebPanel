SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `hwid` text,
  `ban` int(11) NOT NULL DEFAULT '0',
  `type` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

INSERT INTO `users` (
  `id`,
  `username`,
  `password`,
  `hwid`,
  `ban`,
  `type`
  ) VALUES (
  NULL,
  'admin',
  '$2y$14$FSbl7AzNenEmcWV1V7UnAupxfEpChbjIYR0CjAQZJvZpDjtbC5Iua',
  NULL,
  '0',
  '100');

COMMIT;

