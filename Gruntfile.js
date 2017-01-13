module.exports = function(grunt) {

  require('jit-grunt')(grunt);

    grunt.initConfig({

		sass: {
            // this is the "dev" config - used with "grunt watch" command
            dev: {
                options: {
                    style: 'expanded',
					sourcemap: 'none',
                },
                files: {
                    // the first path is the output and the second is the input
                    'assets/css/bootstrap.css': 'assets/src/sass/bootstrap/bootstrap.scss',
					'assets/css/theme-style.css': 'assets/src/sass/style.scss'
                }
            },
			theme: {
                options: {
                    style: 'expanded',
					sourcemap: 'none',
                },
                files: {
                    // the first path is the output and the second is the input
					'css/theme-style.css': 'assets/src/sass/style.scss'
                }
            },
			build: {
                options: {
                    style: 'expanded',
                },
                files: {
                    // the first path is the output and the second is the input
                    'assets/src/css/bootstrap.css': 'assets/src/scss/bootstrap/bootstrap.scss',
					'assets/src/css/bootstrap.min.css': 'assets/src/scss/bootstrap/bootstrap.scss'
                }
            },
        },

        postcss: {
            options: {
                map: true,
                processors: [
					require('postcss-flexbugs-fixes'),
                    require('autoprefixer')({
						browsers: [
					      //
					      // Official browser support policy:
					      // https://v4-alpha.getbootstrap.com/getting-started/browsers-devices/#supported-browsers
					      //
					      'Chrome >= 35', // Exact version number here is kinda arbitrary
					      // Rather than using Autoprefixer's native "Firefox ESR" version specifier string,
					      // we deliberately hardcode the number. This is to avoid unwittingly severely breaking the previous ESR in the event that:
					      // (a) we happen to ship a new Bootstrap release soon after the release of a new ESR,
					      //     such that folks haven't yet had a reasonable amount of time to upgrade; and
					      // (b) the new ESR has unprefixed CSS properties/values whose absence would severely break webpages
					      //     (e.g. `box-sizing`, as opposed to `background: linear-gradient(...)`).
					      //     Since they've been unprefixed, Autoprefixer will stop prefixing them,
					      //     thus causing them to not work in the previous ESR (where the prefixes were required).
					      'Firefox >= 38', // Current Firefox Extended Support Release (ESR); https://www.mozilla.org/en-US/firefox/organizations/faq/
					      // Note: Edge versions in Autoprefixer & Can I Use refer to the EdgeHTML rendering engine version,
					      // NOT the Edge app version shown in Edge's "About" screen.
					      // For example, at the time of writing, Edge 20 on an up-to-date system uses EdgeHTML 12.
					      // See also https://github.com/Fyrd/caniuse/issues/1928
					      'Edge >= 12',
					      'Explorer >= 10',
					      // Out of leniency, we prefix these 1 version further back than the official policy.
					      'iOS >= 8',
					      'Safari >= 8',
					      // The following remain NOT officially supported, but we're lenient and include their prefixes to avoid severely breaking in them.
					      'Android 2.3',
					      'Android >= 4',
					      'Opera >= 12'
					    ]
					})
                ]
            },
			build: {
				files: {
					'assets/css/bootstrap.css': 'assets/src/css/bootstrap.css'
				}
			},
			buildminify: {
				options:{
					processors: [
						require('postcss-clean')
	                ]
				},
				files: {
					'assets/css/bootstrap.min.css': 'assets/css/bootstrap.css'
				}
			},
            dev: {
                src: 'style.css',
            },
            production: {
                src: 'style.min.css',
            }
        },

		copy: {
			build: {
			    files: [

			    	{expand: true, cwd: 'node_modules/bootstrap/scss/', src: ['**'], dest: 'assets/src/scss/bootstrap/'},
					{expand: true, cwd: 'node_modules/bootstrap/js/src/', src: ['**'], dest: 'assets/src/js/bootstrap/', filter: 'isFile'},
			    ],
			},
		},

        watch: {
            styles: {
                files: ['assets/scss/**/*.scss'], // which files to watch
                tasks: ['default'],
                options: {
                    nospawn: true
                }
            },
        }

    });

    grunt.registerTask('default', ['less', 'postcss', 'githubChanges', 'watch']);
    grunt.registerTask('dev', ['less:dev', 'postcss:dev']);
    grunt.registerTask('production', ['less:production', 'postcss:production']);
	grunt.registerTask('build', ['copy:build', 'sass:build', 'postcss:build', 'postcss:buildminify']);
};
