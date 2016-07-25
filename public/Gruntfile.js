/**
 * Created by neil on 13/06/2016.
 */
module.exports = function(grunt) {
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        autoprefixer: {
            options: {
                browsers: ['last 2 versions']
            },
            dist: {
                files: {
                    'build/css/prefix-main.css': 'css/main.css'
                }
            }
        },
        watch: {
            styles: {
                files: ['css/main.css'],
                tasks: ['autoprefixer']
            }
        },
        browserSync: {
            dev: {
                bsFiles: {
                src: ["css/main.css",
                     "../templates/*.html.twig"]
            },
                options: {
                    proxy: "http://127.0.0.1:8888"
                }
            }
        },
        imagemin: {
            dynamic: {
                options: {
                    optimizationLevel: 7,
                    progressive: true
                },
                files: [{
                    expand: true,
                    cwd: 'images/',
                    src: ['**/*.{png,jpg,gif}'],
                    dest: 'build/images/'
                }]
            }
        }
    });
    grunt.loadNpmTasks('grunt-contrib-imagemin');
    grunt.loadNpmTasks('grunt-autoprefixer');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-browser-sync');
    grunt.registerTask('default', ['browserSync']);
};
