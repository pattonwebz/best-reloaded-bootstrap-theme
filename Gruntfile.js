module.exports = function(grunt) {

  require('jit-grunt')(grunt);

    grunt.initConfig({
        less: {
            dev: {
                options: {
                    compress: false,
                },

                files: {
                    "style.css": "less/style.less" // destination file and source file
                }
            },
            production: {
                options: {
                    compress: true,
                    yuicompress: true,
                    optimization: 2,
		        },
                files: {
                    "style.min.css": "less/style.less" // destination file and source file
                }
            }
        },
        postcss: {
            options: {
                map: true,
                processors: [
                    require('autoprefixer-core')({browsers: ['last 99 version']})
                ]
            },
            dev: {
                src: 'style.css',
            },
            production: {
                src: 'style.min.css',
            }
        },
        watch: {
            styles: {
                files: ['less/**/*.less'], // which files to watch
                tasks: ['less'],
                options: {
                    nospawn: true
                }
            },
        }
    });

    grunt.registerTask('default', ['less', 'postcss', 'watch']);
    grunt.registerTask('dev', ['less:dev', 'postcss:dev']);
};
