/**
 * Created by neil on 13/06/2016.
 */
module.exports = function(grunt) {
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
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
        }
    });
    grunt.loadNpmTasks('grunt-browser-sync');
    grunt.registerTask('default', ['browserSync']);
}
