# Hesitant

WordPress theme that adheres to those classic blog conventions and hesitantly
looks at the new trends.

Author: Daniel Jonsson, [matachi.se](http://matachi.se)  
License: [GPLv3](LICENSE) †

† See the section `License` for further information.

## Prerequisites

Instructions to install Docker, nodejs, npm and Grunt on Fedora:

    $ sudo dnf install docker nodejs npm
    $ sudo npm install -g grunt-cli

Start Docker:

    $ sudo systemctl start docker

## Set up

Install build tools and dependencies:

    $ npm install

For a complete list of packages being installed, see
[package.json](package.json) and [bower.json](bower.json).

The following two steps will create a Docker container with a complete LAMP
stack and a WordPress blog running within it:

    $ sudo docker build -t wordpress .
    $ sudo docker run -i -t -p 80:80 -v `pwd`/dist:/var/www/html/wordpress/wp-content/themes/hesitant wordpress

The blog is then accessible at <http://localhost/wordpress> in your browser.
The username is `admin` and the password is `123`.

## Continually build development version

    $ grunt

This will start a local webserver, open the index page in your browser and
watch for file changes to livereload the browser page. The complete source code
of the theme can be found in the directory `dist/`. Note that this requires the
Docker container to be running.

## Build deployment version

This option won't start any development environment but only build a deployable
version of the theme.

    $ grunt build

This will build a deployment version of the WordPress theme. The result can be
found in the directory `dist/`. This Grunt task has minification of CSS and JS
turned on and some additional cleaning, which the development task doesn't.

## Build POT file

Attach to the Docker container and run the following command inside it:

    $ php /var/www/html/wordpress/tools/i18n/makepot.php wp-theme /var/www/html/wordpress/wp-content/themes/hesitant/ /var/www/html/wordpress/wp-content/themes/hesitant/hesitant.pot

The POT file is accessible outside the Docker container at `dist/hesitant.pot`.

## Export the SQL tables

First attach to the Docker container and then run:

    $ mysqldump -u root --password="" wordpress | sed 's$),($),\n($g' > db.sql

## License

This project was originally licensed under the MIT License. However, due to
Cookie Consent now being included as a dependency, which is licensed under the
GPL, the larger program, i.e. this WordPress theme, must also be
distributed under the GPL due to [GPL's viral
nature](https://en.wikipedia.org/wiki/Viral_license).

However, code contributed to this project specifically is still licensed under
the MIT License. But as long as the project depends on at least one GPL
licensed library, the larger program is distributed under the GPL. [Read
more](http://www.gnu.org/licenses/gpl-faq.en.html#GPLWrapper).

## Dependencies

* [Bootstrap](http://getbootstrap.com/), licensed under [The MIT
  License](https://github.com/twbs/bootstrap/blob/master/LICENSE).
* [Cookie Consent](https://silktide.com/tools/cookie-consent/), licensed under
  [GPLv3](https://silktide.com/tools/cookie-consent/docs/license/).

## Additional credits

The header photo is available on
[Flickr](https://www.flickr.com/photos/iamsheep/13956131904/), it's taken by
[iamsheep](https://www.flickr.com/photos/iamsheep/) and it's licensed under [CC
BY 2.0](https://creativecommons.org/licenses/by/2.0/).
