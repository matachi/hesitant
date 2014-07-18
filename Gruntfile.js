'use strict';

var LIVERELOAD_PORT = 35729;

module.exports = function(grunt) {

  /**
   * Dynamically load npm tasks
   */
  require('matchdep').filterDev('grunt-*').forEach(grunt.loadNpmTasks);

  grunt.initConfig({

    pkg: grunt.file.readJSON('package.json'),

    /**
     * Project info
     */
    project: {
      src: 'src',
      dist: 'dist',
      css: ['<%= project.src %>/less/style.less'],
      js: ['<%= project.src %>/js/*.js'],
    },

    /**
     * Project banner
     * Dynamically appended to CSS and JS files
     * Inherits text from package.json
     */
    tag: {
      banner:
        '/*!\n' +
        ' * <%= pkg.title %> <%= pkg.version %> (<%= pkg.homepage %>)\n' +
        ' * Copyright <%= pkg.copyright %> <%= pkg.author.name %> (<%= pkg.author.url %>)\n' +
        ' * Licensed under <%= pkg.license.type %> (<%= pkg.license.url %>).\n' +
        ' */\n',
    },

    /**
     * Clean files and folders
     * https://github.com/gruntjs/grunt-contrib-clean
     * Remove generated files for clean deploy
     */
    clean: {
      prod: [
        '<%= project.dist %>/css/style.unprefixed.css',
        '<%= project.dist %>/css/style.prefixed.css',
      ]
    },

    /**
     * Copy static HTML files
     * https://github.com/gruntjs/grunt-contrib-copy
     */
    copy: {
      html: {
        expand: true,
        cwd: '<%= project.src %>/',
        src: '**.html',
        dest: '<%= project.dist %>/',
      },
    },

    /**
     * JSHint
     * https://github.com/gruntjs/grunt-contrib-jshint
     * Manage the options inside .jshintrc file
     */
    jshint: {
      options: {
        jshintrc: '.jshintrc',
      },
      files: [
        '<%= project.js %>',
        'Gruntfile.js',
      ],
    },

    /**
     * Concatenate JavaScript files
     * https://github.com/gruntjs/grunt-contrib-concat
     * Imports all .js files and appends project banner
     */
    concat: {
      options: {
        stripBanners: true,
        nonull: true,
        banner: '<%= tag.banner %>',
      },
      dev: {
        files: {
          '<%= project.dist %>/js/scripts.min.js': '<%= project.js %>',
        },
      },
    },

    /**
     * Minify JavaScript files
     * https://github.com/gruntjs/grunt-contrib-uglify
     * Compresses and minifies all JavaScript files into one
     */
    uglify: {
      options: {
        banner: '<%= tag.banner %>',
      },
      prod: {
        files: {
          '<%= project.dist %>/js/scripts.min.js': '<%= project.js %>',
        },
      },
    },

    /**
     * Compile Less files
     * https://github.com/gruntjs/grunt-contrib-less
     */
    less: {
      dev: {
        files: {
          '<%= project.dist %>/css/style.unprefixed.css': '<%= project.css %>',
        },
      },
      prod: {
        files: {
          '<%= project.dist %>/css/style.unprefixed.css': '<%= project.css %>',
        },
      },
    },

    /**
     * Remove unused CSS
     * https://github.com/addyosmani/grunt-uncss
     */
    uncss: {
      prod: {
        options: {
          stylesheets: ['css/style.unprefixed.css'],
          ignore: [
            /.*\.toggled-on/,
          ],
        },
        files: {
          '<%= project.dist %>/css/style.unprefixed.css': [
            '<%= project.dist %>/index.html',
          ],
        },
      },
    },

    /**
     * Add and remove CSS vendor prefixes
     * https://github.com/nDmitry/grunt-autoprefixer
     */
    autoprefixer: {
      options: {
        browsers: [
          'last 2 version',
          'safari 6',
          'ie 9',
          'opera 12.1',
          'ios 6',
          'android 4',
        ],
      },
      dev: {
        src: '<%= project.dist %>/css/style.unprefixed.css',
        dest: '<%= project.dist %>/css/style.min.css',
      },
      prod: {
        src: '<%= project.dist %>/css/style.unprefixed.css',
        dest: '<%= project.dist %>/css/style.prefixed.css',
      },
    },

    /**
     * CSS minification
     * https://github.com/t32k/grunt-csso
     * CSSO's `restructure` feature is pretty powerful and useful
     */
    csso: {
      prod: {
        src: '<%= project.dist %>/css/style.prefixed.css',
        dest: '<%= project.dist %>/css/style.min.css',
      },
    },

    /**
     * CSS minification
     * https://github.com/gruntjs/grunt-contrib-cssmin
     */
    cssmin: {
      prod: {
        options: {
          banner: '<%= tag.banner %>',
          keepSpecialComments: 0,
        },
        src: '<%= project.dist %>/css/style.min.css',
        dest: '<%= project.dist %>/css/style.min.css',
      },
    },

    /**
     * Connect port/livereload
     * https://github.com/gruntjs/grunt-contrib-connect
     * Starts a local webserver and injects livereload snippet
     */
    connect: {
      options: {
        port: 9000,
        hostname: '*',
      },
      livereload: {
        options: {
          middleware: function(connect) {
            return [
              require('connect-livereload')({
                port: LIVERELOAD_PORT
              }),
              (function(connect, dir) {
                return connect.static(require('path').resolve(dir));
              })(connect, 'dist'),
            ];
          },
        },
      },
    },

    /**
     * Opens the web server in the browser
     * https://github.com/jsoverson/grunt-open
     */
    open: {
      server: {
        path: 'http://localhost:<%= connect.options.port %>',
      },
    },

    /**
     * Runs tasks against changed watched files
     * https://github.com/gruntjs/grunt-contrib-watch
     * Watching development files and run concat/compile tasks
     * Livereload the browser once complete
     */
    watch: {
      gruntfile: {
        files: 'Gruntfile.js',
        tasks: ['jshint'],
      },
      js: {
        files: '<%= project.src %>/js/{,*/}*.js',
        tasks: ['jshint', 'concat:dev'],
      },
      less: {
        files: '<%= project.src %>/less/{,*/}*.less',
        tasks: ['less:dev', 'autoprefixer:dev'],
      },
      html: {
        files: '<%= project.src %>/**.html',
        tasks: ['copy:html'],
      },
      livereload: {
        options: {
          livereload: LIVERELOAD_PORT,
        },
        files: [
          '<%= project.dist %>/{,*/}*.html',
          '<%= project.dist %>/css/style.min.css',
          '<%= project.dist %>/js/scripts.min.js',
          '<%= project.dist %>/{,*/}*.{png,jpg,gif,svg}',
        ],
      },
    },
  });

  /**
   * Development task
   * Run `grunt` on the command line
   */
  grunt.registerTask('default', [
    'copy',
    'less:dev',
    'autoprefixer:dev',
    'jshint',
    'concat:dev',
    'connect:livereload',
    'open',
    'watch',
  ]);

  /**
   * Build task
   * Run `grunt build` on the command line
   */
  grunt.registerTask('build', [
    'copy',
    'less:prod',
    'uncss:prod',
    'autoprefixer:prod',
    'csso:prod',
    'cssmin:prod',
    'clean:prod',
    'jshint',
    'uglify',
  ]);

};
