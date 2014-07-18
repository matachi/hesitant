FROM ubuntu

RUN apt-get update

# Install MySQL
RUN apt-get install -y mysql-server
RUN mysql_install_db
RUN /usr/sbin/mysqld & sleep 10s && mysqladmin -u root -p CREATE wordpress

# Install Apache 2
RUN apt-get install -y apache2
RUN a2enmod rewrite

# Install PHP
RUN apt-get install -y php5 php5-mysql

# Install WordPress
RUN apt-get install -y wget
RUN wget http://wordpress.org/latest.tar.gz -O /tmp/wordpress.tar.gz
RUN mkdir /var/www/html/wordpress
RUN tar xfz /tmp/wordpress.tar.gz -C /var/www/html/wordpress --strip 1
RUN chown -R www-data /var/www/html/wordpress
