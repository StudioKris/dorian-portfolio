module.exports = function(grunt) {

	// Project configuration.
	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),
		less: {
			development: {
				options: {
					paths: ["www/css"]
				},
				files: {
					"www/css/portfolio.css": "www/css/portfolio.less"
				}
			},
			production: {
				options: {
					paths: ["www/css"],
					yuicompress: true
				},
				files: {
					"www/css/portfolio.css": "www/css/portfolio.less"
				}
			}
		}
	});

	grunt.loadNpmTasks('grunt-contrib-less');

	// Default task(s).
	grunt.registerTask('default', ['less']);

};