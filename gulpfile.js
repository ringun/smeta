var gulp        = require('gulp');
var browserSync = require('browser-sync').create();
var sass        = require('gulp-sass');

// Compile sass into CSS & auto-inject into browsers
gulp.task('sass', function() {
    return gulp.src("app/sass/*.scss")
        .pipe(sass())
        .pipe(gulp.dest("./css"))
        .pipe(browserSync.stream());
});

gulp.task('default', function() {
    browserSync.init({
        proxy: "smeta03.local"
    });

    gulp.watch("app/sass/*.scss", gulp.series('sass'));
    gulp.watch("*.php").on('change', browserSync.reload);
    gulp.watch("js/*.js").on('change', browserSync.reload);
});