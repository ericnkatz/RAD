//	Initialize gulp and dependencies
var gulp		= require('gulp');
var gutil		= require('gulp-util');
var sass		= require('gulp-ruby-sass');
var autoprefix	= require('gulp-autoprefixer');
var rename		= require('gulp-rename');


//	Some Constants for Project Directories
var sassDirectory	= 'resources/scss';
var cssDirectory	= 'public/css';


//	Gulp Tasks
gulp.task('css', function() {
	return gulp.src(sassDirectory + '/main.scss')
		// .pipe(sass({ style: 'nested'}))
		// .pipe(autoprefix('last 6 version'))
		// .pipe(gulp.dest(cssDirectory))

  		// .pipe(rename('main.min.css'))
		.pipe(sass({ style: 'compressed'}))
		.pipe(autoprefix('last 6 version'))
		.pipe(gulp.dest(cssDirectory));
});

gulp.task('watch', function() {
	gulp.watch(sassDirectory + '/**/*.scss', ['css']);
});

gulp.task('default', ['css','watch']);