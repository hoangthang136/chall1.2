sudo apt update
apache2: sudo apt install apache2
sudo apt install php8.1
sudo apt install mysql-server
sudo mysql
	CREATE USER 'appuser'@'localhost' IDENTIFIED WITH mysql_native_password BY 'password';
	GRANT ALL PRIVILEGES ON *.* TO 'appuser'@'localhost' WITH GRANT OPTION;
	exit;
cd Downloads
php -r "copy('http://getcomposer.org/installer', 'composer-setup.php');"
	php composer-setup.php
	sudo mv composer.phar /usr/local/bin/composer
sudo apt install git
sudo apt install unzip
sudo apt install php-zip php-mysql php-xml php-curl
cd /var/www/html
sudo rm index.html
sudo chown -R username:username .
git clone https://github.com/hoangthang136/chall1.2.git
cd chall1.2
composer install
cp .env.example .env
sudo chown -R www-data:www-data storage/
php artisan key:generate
mysql -uappuser -p
//nhập 'password'
CREATE DATABASE chall12;
exit;
nano .env
//sửa DB_DATABASE = chall12
//DB_USERNAME = appuser
//DB_PASSWORD = password xong lưu file lại
php artisan migrate
mysql -uappuser -p
	use chall12;
	INSERT INTO `user` (`hoten`, `username`, `password`, `email`, `phone`, `role`, `created_at`, `updated_at`) VALUES
('Hoàng Hưng Thắng', 'hoangthang', '$2y$10$dnR46U3SCMJujjjLIQtceutgbISjRfgjklbPbqqYNWj5VxUW4sJbK', 'thang@gmail', '1234567890', 'Administrator', '2023-10-14 06:11:15', '2023-10-14 09:16:05');