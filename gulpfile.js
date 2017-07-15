var gulp = require('gulp');
var sass = require('gulp-sass');
var autoprefixer = require('gulp-autoprefixer');
var plumber = require('gulp-plumber');
var rename = require('gulp-rename');
var cssnano = require('gulp-cssnano');
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var watch = require('gulp-watch');
var notify = require('gulp-notify');


gulp.task('sass', function() {
  gulp.src('./sass/*.scss')
    .pipe(plumber({errorHandler: notify.onError('<%= error.message %>')}))
    .pipe(sass())
    .pipe(autoprefixer())
    .pipe(gulp.dest('./assets/css'))
    .pipe(rename({suffix: '.min'}))
    .pipe(cssnano({discardComments: {removeAll: true}}))
    .pipe(gulp.dest('./assets/css'));
});

gulp.task('scripts', function() {
  var scripts = [
    './js/ex-app.js'
  ];
  gulp.src(scripts)
    .pipe(plumber({errorHandler: notify.onError('<%= error.message %>')}))
    .pipe(concat('ex-app.min.js'))
    .pipe(uglify())
    .pipe(gulp.dest('./assets/js'));

  gulp.src(scripts)
    .pipe(plumber({errorHandler: notify.onError('<%= error.message %>')}))
    .pipe(concat('ex-app.js'))
    .pipe(gulp.dest('./assets/js'));
});

//total
gulp.task('go', ['sass', 'scripts'], function () { });

//watch
gulp.task('watch', () => {
  gulp.watch('./sass/*',      ['sass']);
  gulp.watch('./js/*',        ['scripts']);
});
