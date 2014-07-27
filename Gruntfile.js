/* jshint node: true */
'use strict';

module.exports = function (grunt) {

    // Load grunt tasks automatically
    require('load-grunt-tasks')(grunt);

    // Time how long tasks take. Can help when optimizing build times
    require('time-grunt')(grunt);

    require('matchdep').filterDev('grunt-*').forEach(grunt.loadNpmTasks);

    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),

        config: {
            staticCss: 'static/css',
            staticJs: 'static/js',
        },

        cssmin: {
            combine: {
                options: {
                    'banner': '/* <%= pkg.name %> - v<%= pkg.version %> - ' + '<%= grunt.template.today(\'yyyy-mm-dd\') %> */\n',
                },
                files: {
                    '<%= config.staticCss %>/min/script.css': ['<%= config.staticCss %>/*.css']
                }
            }
        },

        uglify: {
            options: {
                'banner': '/* <%= pkg.name %> - v<%= pkg.version %> - ' + '<%= grunt.template.today(\'yyyy-mm-dd\') %> */\n',
                'preserveComments': false
            },
            js: {
                files: [{
                    src: '<%= config.staticJs %>/*.js',
                    dest: '<%= config.staticJs %>/min/script.js'
                }]
            }
        },

        jshint: {
            options: {
                'node': true,
                'browser': true,
                'esnext': true,
                'bitwise': true,
                'camelcase': true,
                'curly': true,
                'eqeqeq': true,
                'immed': true,
                'indent': 2,
                'latedef': false,
                'newcap': true,
                'noarg': true,
                'quotmark': 'single',
                'regexp': true,
                'undef': true,
                'unused': false,
                'strict': false,
                'trailing': true,
                'smarttabs': true,
                'globals': {
                    'angular': false
                },
                reporter: require('jshint-stylish')
            },
            js: ['Gruntfile.js', '<%= config.staticJs %>/*.js']
        }

    });

    grunt.registerTask('default', ['jshint', 'uglify', 'cssmin']);

};