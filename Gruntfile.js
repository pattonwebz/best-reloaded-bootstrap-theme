module.exports = function(grunt) {

  require('jit-grunt')(grunt);

    grunt.initConfig({
        less: {
            development: {
                options: {
                    compress: false,
		            plugins: [
        		        new require('less-plugin-autoprefix')({browsers: ["last 2 versions"]}),
      		        ],
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
		            plugins: [
                        new require('less-plugin-autoprefix')({browsers: ["last 2 versions"]}),
                    ],
                },
                files: {
                    "style.min.css": "less/style.less" // destination file and source file
                }
            }
        },
        watch: {
            styles: {
                files: ['less/**/*.less'], // which files to watch
                tasks: ['less'],
                options: {
                    nospawn: true
                }
            }
        }
    });

    grunt.registerTask('default', ['less', 'watch']);
};
