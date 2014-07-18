# Dunham 2036

Classy WordPress theme that follows those classic blog conventions.

Author: Daniel "MaTachi" Jonsson, [matachi.se](http://matachi.se)  
License: [MIT License](LICENSE.md)

## Prerequisites

Instructions to install npm and Grunt on a Debian based system (for example
Ubuntu):

    $ sudo apt-get install nodejs
    $ sudo npm install -g grunt-cli
    $ sudo chown -R `whoami`:`whoami` ~/.npm ~/tmp

## Set up

Install build tools and dependencies:

    $ npm install

For a complete list of packages being installed, see
[package.json](package.json) and [bower.json](bower.json).

## Start development environment

    $ grunt

This will start a local webserver, open the index page in your browser and
watch for file changes to livereload the browser page. The complete source code
of the site being presented in the browser can be found in the directory
`dist/`.

## Build deployment version

    $ grunt build

This will build a deployment version of the WordPress theme. The result can be
found in the directory `dist/`. This Grunt task has minification of CSS and JS
turned on and some additional cleaning, which the development task doesn't.

## Dependencies

* [Bootstrap](http://getbootstrap.com/), licensed under [The Mit
  License](https://github.com/twbs/bootstrap/blob/master/LICENSE).
