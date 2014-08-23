module.exports = function(grunt) {

	// Project configuration.
	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),
		less: {
			main: {
				options: {
					paths: ["build_tmp/www/css"]
				},
				files: {
					"build_tmp/www/css/portfolio.css": "www/css/portfolio.less",
					"build_tmp/www/admin/css/admin.css": "www/admin/css/admin.less"
				}
			},
			production: {
				options: {
					paths: ["build_tmp/www/css"],
					yuicompress: true
				},
				files: {
					"build_tmp/www/css/portfolio.css": "www/css/portfolio.less",
					"build_tmp/www/admin/css/admin.css": "www/admin/css/admin.less"
				}
			}
		},
		copy: {
			first: {
				files: [{
					src: ['www/**', '!**/*.less'],
					dest: 'build_tmp/'
				}]
			},
			last: {
				expand: true,
				cwd: 'www/',
				src: '**/img/*',
				dest: 'build/fr/'
			}
		},
		i18n: {
			main: {
				src: ['build_tmp/www/**/*'],
				options: {
					locales: 'i18n/*.json',
					output: 'build',
					base: 'build_tmp/www'
				}
			}
		}
	});

	grunt.loadNpmTasks('grunt-contrib-less');
	grunt.loadNpmTasks('grunt-contrib-copy');
	grunt.loadNpmTasks('grunt-i18n');

	// Default task(s).
	grunt.registerTask('development', ['copy:first', 'less', 'i18n', 'copy:last']);
	grunt.registerTask('default', ['copy:first', 'less:production', 'i18n', 'copy:last']);

};