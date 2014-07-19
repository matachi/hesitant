'use strict';

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
      wordpress:
        '/*\n' +
        'Theme Name: <%= pkg.title %>\n' +
        'Theme URI: <%= pkg.homepage %>\n' +
        'Author: <%= pkg.author.name %>\n' +
        'Author URI: <%= pkg.author.url %>\n' +
        'Description: <%= pkg.description %>\n' +
        'Version: <%= pkg.version %>\n' +
        'License: <%= pkg.license.type %>\n' +
        'License URI: <%= pkg.license.url %>\n' +
        '*/\n',
    },

    /**
     * Clean files and folders
     * https://github.com/gruntjs/grunt-contrib-clean
     * Remove generated files for clean deploy
     */
    clean: {
      prod: [
        '<%= project.dist %>/style.unprefixed.css',
        '<%= project.dist %>/style.prefixed.css',
        '<%= project.dist %>/style.min.css',
      ]
    },

    /**
     * Copy static PHP files
     * https://github.com/gruntjs/grunt-contrib-copy
     */
    copy: {
      php: {
        expand: true,
        cwd: '<%= project.src %>/',
        src: '**.php',
        dest: '<%= project.dist %>/',
      },
    },

    /**
     * Add the livereload script to the footer
     * https://github.com/yoniholmes/grunt-text-replace
     */
    replace: {
      livereload: {
        src: '<%= project.dist %>/footer.php',
        overwrite: true,
        replacements: [{
          from: '</body>',
          to: function() {
            return '<script src="http://localhost:35729/livereload.js"></script></body>';
          }
        }],
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
     * 140719: Using the git version because v0.11.4-pre has the `banner`
     * option
     */
    less: {
      dev: {
        options: {
          banner: '<%= tag.wordpress %>',
        },
        files: {
          '<%= project.dist %>/style.unprefixed.css': '<%= project.css %>',
        },
      },
      prod: {
        files: {
          '<%= project.dist %>/style.unprefixed.css': '<%= project.css %>',
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
          stylesheets: ['style.unprefixed.css'],
          ignore: [
            /.*\.toggled-on/,
          ],
          urls: ['http://localhost/wordpress'],
        },
        files: {
          '<%= project.dist %>/style.unprefixed.css': [
            'dist/*.php',
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
        src: '<%= project.dist %>/style.unprefixed.css',
        dest: '<%= project.dist %>/style.css',
      },
      prod: {
        src: '<%= project.dist %>/style.unprefixed.css',
        dest: '<%= project.dist %>/style.prefixed.css',
      },
    },

    /**
     * CSS minification
     * https://github.com/t32k/grunt-csso
     * CSSO's `restructure` feature is pretty powerful and useful
     */
    csso: {
      prod: {
        src: '<%= project.dist %>/style.prefixed.css',
        dest: '<%= project.dist %>/style.min.css',
      },
    },

    /**
     * CSS minification
     * https://github.com/gruntjs/grunt-contrib-cssmin
     */
    cssmin: {
      prod: {
        options: {
          banner: '<%= tag.wordpress %>',
          keepSpecialComments: 0,
        },
        src: '<%= project.dist %>/style.min.css',
        dest: '<%= project.dist %>/style.css',
      },
    },

    /**
     * Opens the web server in the browser
     * https://github.com/jsoverson/grunt-open
     */
    open: {
      server: {
        path: 'http://localhost/wordpress',
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
      php: {
        files: '<%= project.src %>/**.php',
        tasks: ['copy:php', 'replace:livereload'],
      },
      livereload: {
        options: {
          livereload: true,
        },
        files: [
          '<%= project.dist %>/{,*/}*.php',
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
    'replace:livereload',
    'less:dev',
    'autoprefixer:dev',
    'jshint',
    'concat:dev',
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
