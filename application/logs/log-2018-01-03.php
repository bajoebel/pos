<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2018-01-03 13:24:18 --> Severity: error --> Exception: Unable to locate the model you have specified: M_general /var/www/html/grosir/system/core/Loader.php 314
ERROR - 2018-01-03 13:25:47 --> Severity: Error --> Call to undefined method Auth_model::tampil_data_perfield() /var/www/html/grosir/application/controllers/Profile.php 24
ERROR - 2018-01-03 13:26:47 --> Query error: Table 'db_toko_ok.pmi_users' doesn't exist - Invalid query: SELECT *
FROM `pmi_users`
WHERE `username` = 'admin'
ERROR - 2018-01-03 13:32:15 --> Severity: Error --> Call to undefined method Auth_model::save() /var/www/html/grosir/application/controllers/Profile.php 49
ERROR - 2018-01-03 13:52:21 --> Severity: Error --> Call to undefined method Users::_file_upload() /var/www/html/grosir/application/controllers/Users.php 84
ERROR - 2018-01-03 13:53:45 --> Severity: Notice --> Undefined variable: error /var/www/html/grosir/application/controllers/Users.php 158
ERROR - 2018-01-03 13:58:32 --> Severity: Notice --> Undefined variable: error /var/www/html/grosir/application/controllers/Users.php 158
ERROR - 2018-01-03 14:00:24 --> Severity: Notice --> Undefined variable: password /var/www/html/grosir/application/controllers/Users.php 102
ERROR - 2018-01-03 14:00:24 --> Query error: Unknown column 'user_password1' in 'field list' - Invalid query: INSERT INTO `users` (`user_password1`, `user_nama_lengkap`, `user_jekel`, `user_alamat`, `user_email`, `user_kontak`, `user_status`, `user_photo`, `admin`, `user_group_id`) VALUES (NULL, 'wanhar', 'Laki-Laki', 'alamat', 'bajoebel@gmail.com', '0813-1046-0892', 'Aktif', '', 'Y', '1')
ERROR - 2018-01-03 14:01:50 --> Query error: Field 'username' doesn't have a default value - Invalid query: INSERT INTO `users` (`user_password`, `user_nama_lengkap`, `user_jekel`, `user_alamat`, `user_email`, `user_kontak`, `user_status`, `user_photo`, `admin`, `user_group_id`) VALUES ('fd52150cae9cd60f6465d182d501f819', 'wanhar azri', 'Laki-Laki', 'alamat', 'test@gmail.com', '0813-1046-0892', 'Aktif', '', 'Y', '1')
ERROR - 2018-01-03 14:03:01 --> Severity: Notice --> Undefined variable: error /var/www/html/grosir/application/controllers/Users.php 159
ERROR - 2018-01-03 14:03:20 --> Severity: Notice --> Undefined variable: error /var/www/html/grosir/application/controllers/Users.php 159
ERROR - 2018-01-03 14:07:35 --> Severity: Notice --> Undefined variable: error /var/www/html/grosir/application/controllers/Users.php 159
ERROR - 2018-01-03 14:08:36 --> Severity: Notice --> Undefined variable: error /var/www/html/grosir/application/controllers/Users.php 159
ERROR - 2018-01-03 14:08:56 --> Severity: Notice --> Undefined variable: error /var/www/html/grosir/application/controllers/Users.php 159
ERROR - 2018-01-03 14:10:38 --> Query error: Unknown column 'user_nama_lengkap1' in 'field list' - Invalid query: UPDATE `users` SET `user_nama_lengkap1` = 'testing', `user_jekel` = 'Laki-Laki', `user_alamat` = 'test', `user_email` = 'test', `user_kontak` = '0813-1046-0892', `user_status` = 'Aktif', `user_photo` = '', `admin` = 'Y', `user_group_id` = '1'
WHERE `username` IS NULL
