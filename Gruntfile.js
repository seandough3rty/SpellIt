/* global module, require */
/* jshint maxlen: 130 */
module.exports = function(grunt) {
    'use strict';

    //TODO read http://quickleft.com/blog/grunt-js-tips-tricks
    var ifProdBuild, ifDevBuild;
    require('load-grunt-config')(grunt);
    require('time-grunt')(grunt);

    //set with command line
    ifProdBuild = grunt.option('production');
    ifDevBuild = !grunt.option('production');

    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),

        less: {
            site: {
                options: {
                    compress: true,
                    sourceMap: true,
                    outputSourceFiles: true,
                    sourceMapURL: '/css/site.css.map',
                    sourceMapFilename: 'web/css/site.css.map'
                },
                files: {
                    'web/css/site.css': 'less/**/*.less',
                    'web/css/vendor.css': [
                        'bower_components/bootstrap/less/bootstrap.less',
                        'bower_components/fontawesome/less/font-awesome.less'
                    ]
                }
            }
        },

        jshint: {
            // HACK The following bit of merge wtf! is to allow loading the existing
            // .jshintrc file and then apply development-only options to prevent
            // warnings when using, for example, "console.log()".
            options: grunt.util._.merge(
                grunt.file.readJSON('./.jshintrc'),
                {
                    devel: ifDevBuild,
                    reporter: require('jshint-stylish')
                }
            ),
            all: ['js/**/*.js', 'js/**/*.js', 'Gruntfile.js']
        },

        uglify: {
            vendor: {
                files: {
                    'web/js/vendor.min.js': [
                        'bower_components/jquery/dist/jquery.js',
                        'bower_components/select2/dist/js/select2.js',
                        'bower_components/bootstrap/dist/js/bootstrap.js'
                    ]
                }
            },
            global: {
                files: {
                    'web/js/site.min.js': 'js/**/*.js'
                }
            },
            pages: {
                files: [{
                    expand: true,
                    cwd: 'js',
                    src: 'js/**/*.js',
                    dest: 'web/js'
                }, {
                    expand: true,
                    cwd: 'js',
                    src: 'global/*.js',
                    dest: 'web/js'
                }]
            }
        },

        copy: {
            fonts: {
                expand: true,
                flatten: true,
                filter: 'isFile',
                src: [
                    'bower_components/fontawesome/fonts/*'
                ],
                dest: 'web/fonts/'
            },
            animate: {
                src: 'bower_components/animate.css/animate.min.css',
                dest: 'web/css/animate.min.css'
            }
        },
        watch: {
            css: {
                files: 'less/**/*.less',
                tasks: ['less']
            },
            js: {
                files: ['js/**/*.js'],
                tasks: ['jshint', 'uglify:pages', 'uglify:global']
            }
        }
    });

    // Task aliases

    grunt.registerTask(
        'default',
        'Recompile css and javascript when changes detected',
        ['watch']
    );

    grunt.registerTask('build', 'Build project', [
        'jshint',
        'copy',
        'less',
        'uglify'
    ]);

};