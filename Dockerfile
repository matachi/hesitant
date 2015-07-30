FROM ubuntu

RUN apt-get update

# Install MySQL
RUN apt-get install -y mysql-server
RUN mysql_install_db
COPY wordpress/db.sql /tmp/db.sql
RUN /usr/sbin/mysqld & sleep 10s &&\
  mysqladmin -u root -p CREATE wordpress &&\
  mysql -u root --password="" wordpress < /tmp/db.sql

# Install Apache 2
RUN apt-get install -y apache2
RUN a2enmod rewrite

# Install PHP
RUN apt-get install -y php5 php5-mysql

# Install WordPress
RUN apt-get install -y wget
RUN wget https://wordpress.org/wordpress-4.2.3.tar.gz -O /tmp/wordpress.tar.gz
RUN mkdir /var/www/html/wordpress
RUN tar xfz /tmp/wordpress.tar.gz -C /var/www/html/wordpress --strip 1
COPY wordpress/wp-config.php /var/www/html/wordpress/wp-config.php

# Download WordPress' i18n tools
# http://codex.wordpress.org/I18n_for_WordPress_Developers#Translating_Plugins_and_Themes
# gettext is necessary for the tools to work
RUN apt-get install -y subversion gettext
RUN svn co http://develop.svn.wordpress.org/trunk/tools/ /var/www/html/wordpress/tools/
RUN ln -s /var/www/html/wordpress /var/www/html/wordpress/src

# Fix ownership of the WordPress directory
RUN chown -R www-data /var/www/html/wordpress

CMD /etc/init.d/mysql start && /etc/init.d/apache2 start && bash
