USE `messaging`;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `roles`, `enabled`, `deleted`) VALUES
  (1, 'admin', '$2a$08$oO8eIg/iogVvz7tIBNmEZ.mIKEiRoJxKd4tpDUxBK8lVcwuQAheTu', 'ROLE_ADMIN', 1, 0);

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `recipient`, `sender`, `sent_date`, `is_read`, `deleted`, `subject`, `content`) VALUES
(1, 1, 1, '2017-01-01 00:00:00', 0, 0, 'Welcome Admin', 'Welcome to heig-messaging.');