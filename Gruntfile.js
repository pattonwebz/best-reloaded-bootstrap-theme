module.exports = function(grunt) {

  require('jit-grunt')(grunt);

    grunt.initConfig({

		pkg: grunt.file.readJSON('package.json'),

		sass: {

			theme: {
                options: {
                    style: 'expanded',
                },
                files: {
                    // the first path is the output and the second is the input
					'assets/src/css/style.css': 'assets/src/scss/style.scss'
                }
            },

			build: {
                options: {
                    style: 'expanded',
                },
                files: {
                    // the first path is the output and the second is the input
                    'assets/src/css/bootstrap.css'	: 'assets/src/scss/bootstrap/bootstrap.scss',
					'assets/src/css/style.css'		: 'assets/src/scss/style.scss'
                }
            }

        },

        postcss: {
            options: {
                map: false,
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
					'assets/css/bootstrap.css'	: 'assets/src/css/bootstrap.css',
					'assets/css/style.css'		: 'assets/src/css/style.css'
				}
			},
			buildminify: {
				options:{
					sourceMap:false,
					processors: [
						require('postcss-clean')
	                ]
				},
				files: {
					'assets/css/bootstrap.min.css': 'assets/css/bootstrap.css',
					'assets/css/style.min.css': 'assets/src/css/style.css'
				}
			},
			theme: {
				files: {
					'assets/css/style.css': 'assets/src/css/style.css'
				}
			},
			thememinify: {
				options:{
					sourceMap:false,
					processors: [
						require('postcss-clean')
	                ]
				},
				files: {
					'assets/css/style.min.css': 'assets/css/style.css'
				}
			},
        },


		// configure a babel
		babel: {
			build: {
				options: {
					sourceMap: true
				},
				files: {
					'assets/js/util.js'      : 'assets/src/js/bootstrap/util.js',
					'assets/js/alert.js'     : 'assets/src/js/bootstrap/alert.js',
					'assets/js/button.js'    : 'assets/src/js/bootstrap/button.js',
					'assets/js/carousel.js'  : 'assets/src/js/bootstrap/carousel.js',
					'assets/js/collapse.js'  : 'assets/src/js/bootstrap/collapse.js',
					'assets/js/dropdown.js'  : 'assets/src/js/bootstrap/dropdown.js',
					'assets/js/modal.js'     : 'assets/src/js/bootstrap/modal.js',
					'assets/js/scrollspy.js' : 'assets/src/js/bootstrap/scrollspy.js',
					'assets/js/tab.js'       : 'assets/src/js/bootstrap/tab.js',
					'assets/js/tooltip.js'   : 'assets/src/js/bootstrap/tooltip.js',
					'assets/js/popover.js'   : 'assets/src/js/bootstrap/popover.js'
				}
			},
			dist: {
		        options: {
					presets: [
					    [
					    	"es2015",
					    	{
					        	"modules": false,
					        	"loose": true
					    	}
					    ]
					],
					"plugins": [
					    "transform-es2015-modules-strip"
					]
		        },
		        files: {
		          	'<%= concat.bootstrap.dest %>' : '<%= concat.bootstrap.dest %>'
		        }
		    }

		},

		concat: {
		    options: {
		        // Custom function to remove all export and import statements
		        process: function (src) {
		          return src.replace(/^(export|import).*/gm, '')
		        }
			},
		    bootstrap: {
		        src: [
		          'assets/js/util.js',
		          'assets/js/alert.js',
		          'assets/js/button.js',
		          'assets/js/carousel.js',
		          'assets/js/collapse.js',
		          'assets/js/dropdown.js',
		          'assets/js/modal.js',
		          'assets/js/scrollspy.js',
		          'assets/js/tab.js',
		          'assets/js/tooltip.js',
		          'assets/js/popover.js'
		        ],
		        //dest: 'dist/js/<%= pkg.name %>.js'
		        dest: 'assets/js/bootstrap.js'
		    }
	    },

		// configure an uglify task
		uglify: {
			// this is the "dev" config - used with "grunt watch" command
			dev: {
				files: [
					{ src: 'assets/js/bootstrap.js', dest: 'assets/js/bootstrap.min.js' }, // All the Bootstrap JS
					{ src: 'assets/js/scripts.js', dest: 'assets/js/scripts.min.js'}
				]
			},
			theme: {
				files: [
					{ src: 'assets/js/scripts.js', dest: 'assets/js/scripts.min.js'}
				]
			}

		},

		// Bootstrap is added to the devDependencies and installed with npm,
		// copy the appropriate files to the /src/ folder
		copy: {
			build: {
			    files: [
			    	{expand: true, cwd: 'node_modules/bootstrap/scss/', src: ['**'], dest: 'assets/src/scss/bootstrap/'},
					{expand: true, cwd: 'node_modules/bootstrap/js/src/', src: ['**'], dest: 'assets/src/js/bootstrap/', filter: 'isFile'},
					{src: ['assets/src/js/scripts.js'], dest: 'assets/js/scripts.js', filter: 'isFile'},
			    ],
			},
			theme: {
			    files: [
					{src: ['assets/src/js/scripts.js'], dest: 'assets/js/scripts.js', filter: 'isFile'},
			    ],
			},
			// configuration to get the WPORG friendly verion - IE no unneeded files
			dist: {
				files: [
					// only the needed files from root
					// style.css is copied seporately
					{
						expand: true,
						src: ['*.php', 'changelog', 'readme.txt', 'screenshot.png'],
						dest: 'dist/best-reloaded/'
					},
					// all files inside /inc/
					{
						expand: true,
						src: ['inc/**'],
						dest: 'dist/best-reloaded/'
					},
					// only css files - no maps
					// note the unminifide style.css file is copied seporately
					{
						expand: true,
						src: ['assets/css/style.min.css', 'assets/css/bootstrap.css', 'assets/css/bootstrap.min.css'],
						dest: 'dist/best-reloaded/'
					},
					// only combined scripts, no individuals
					{
						expand: true,
						src: ['assets/js/scripts.js', 'assets/js/scripts.min.js', 'assets/js/bootstrap.js', 'assets/js/bootstrap.min.js', 'assets/js/tether.js', 'assets/js/tether.min.js'],
						dest: 'dist/best-reloaded/'
					},
					// copy img directory
					{
						expand: true,
						src: ['assets/img/**'],
						dest: 'dist/best-reloaded/'
					},
				],
			},
			versionReplace: {
				files:[
					// copy stylesheets and insert version number from package.json
					{
						expand: true,
						src: ['style.css', 'assets/css/style.css'],
						dest: 'dist/best-reloaded/'
					},
				],
				options: {
					process: function (content, srcpath) {
						console.log('processing');
						var pkgVersion = grunt.file.readJSON('package.json').version;
						return content.replace('{{ VERSION }}', pkgVersion);
					},
				},
			}

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

    grunt.registerTask('default', ['sass:theme', 'postcss:theme', 'postcss:thememinify', 'copy:theme', 'uglify:theme']);
	grunt.registerTask('build', ['copy:build', 'sass:build', 'postcss:build', 'postcss:buildminify', 'babel:build', 'concat', 'babel:dist', 'uglify:dev']);
	grunt.registerTask('theme', ['sass:theme', 'postcss:theme', 'postcss:thememinify', 'copy:theme', 'uglify:theme']);
	grunt.registerTask('dist', ['copy:dist', 'copy:versionReplace']);
};
