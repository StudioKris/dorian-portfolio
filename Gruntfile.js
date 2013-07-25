module.exports = function(grunt) {

	// Project configuration.
	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),
		less: {
			development: {
				options: {
					paths: ["build/www/css"]
				},
				files: {
					"build/www/css/portfolio.css": "build/www/css/portfolio.less"
				}
			},
			production: {
				options: {
					paths: ["build/css"],
					yuicompress: true
				},
				files: {
					"build/www/css/portfolio.css": "build/www/css/portfolio.less"
				}
			}
		},
		copy: {
			development: {
				files: [{
						src: ['www/**'],
						dest: 'build/'
					}
				]
			}
		},
		includereplace: {
			development: {
				options: {
					globals: grunt.file.readJSON('i18n/fr.properties'),
					prefix: '@@',
      				suffix: '@@'
				},
				src: 'build/www/*.html'
			}
		}
	});

	grunt.loadNpmTasks('grunt-contrib-less');
	grunt.loadNpmTasks('grunt-contrib-copy');
	grunt.loadNpmTasks('grunt-include-replace');

	// Default task(s).
	grunt.registerTask('development', ['copy:development', 'includereplace:development', 'less:development']);

};