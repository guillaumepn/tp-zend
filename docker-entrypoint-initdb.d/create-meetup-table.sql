CREATE TABLE `meetup` (
  `id` varchar(36) PRIMARY KEY,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `date_start` date NOT NULL,
  `date_end` date NOT NULL
);