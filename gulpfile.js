var gulp = require('gulp'),
browserSync = require('browser-sync'),
reload = browserSync.reload,
browserify = require('browserify'),
source = require('vinyl-source-stream'),
buffer = require('vinyl-buffer'),
cssnano = require('cssnano'),
sourcemaps = require('gulp-sourcemaps'),
postcss = require('gulp-postcss'),
autoprefixer = require('autoprefixer'),
uglify = require('gulp-uglify');
jsonSass = require('json-sass');
rename = require('gulp-rename');
fs = require('fs');
const sass = require('gulp-sass')(require('sass'));

// Change the url in the proxy field to the url of the .local site you are working on. 
// To use, the command is 'gulp watch bs' and then your changes will be automatically synced in the browser on save
gulp.task('bs', function () {
	browserSync.init(null, {
		proxy: 'http://localhost:8888'
	});
});

// Compile all .scss files into usable style.css and editor-styles.css based on what is included in the style.scss file.
// Uses gulp-sourcemaps to generate the final .css and .map files
gulp.task('styles', function () {
	return gulp.src('sass/**/*.scss')
		.pipe(sourcemaps.init())
		.pipe(sass())
		.on("error", sass.logError)
		.pipe(postcss([autoprefixer(), cssnano()]))
		.pipe(sourcemaps.write('./'))
		.pipe(gulp.dest('./'))
		.pipe(reload({ stream: true }));
});

// Generate the theme.scss from the theme.json
gulp.task('theme', function() {
	return fs.createReadStream('theme.json')
		.pipe(jsonSass({
			prefix: '$theme: '
		}))
		.pipe(source('theme.json'))
		.pipe(rename('_theme.scss'))
		.pipe(gulp.dest('./sass'))
});

// Compile all .js files into a usable and minified main.js
gulp.task('js', function () {
	return browserify({
		extensions: ['.js'],
		entries: ['./js/scripts.js'],
		sourceType: 'module',
		debug: true
	})
		.transform('babelify', {
			sourceMaps: true,
			presets: ["@babel/preset-env"]
		})
		.bundle()
		.pipe(source('main.min.js'))
		.pipe(buffer())
		.pipe(uglify())
		.pipe(gulp.dest('js'))
		.pipe(reload({ stream: true }));
});

gulp.task('editor-js', function() {
	return browserify({
		extensions: ['.js', '.jsx'],
		entries: ['./editor-js/scripts.js'],
		sourceType: 'module',
		debug: true
	})
		.transform('babelify', {
			sourceMaps: true,
			presets: ["@babel/preset-env", "@babel/preset-react"]
		})
		.bundle()
		.pipe(source('editor.min.js'))
		.pipe(buffer())
		.pipe(uglify())
		.pipe(gulp.dest('editor-js'))
		.pipe(reload({ stream: true }));
});


// configure which files to watch and what tasks to use on file changes
gulp.task('watch', function () {
	gulp.watch(['js/**/*.js', '!js/main.min.js'], gulp.series('js'));
	gulp.watch('sass/**/*.scss', gulp.series('styles'));
	gulp.watch('theme.json', gulp.series('theme')); 
	gulp.watch(['editor-js/**/*.js', '!editor-js/editor.min.js'], gulp.series('editor-js'));
});

gulp.task('default', gulp.series(gulp.parallel('watch', 'styles', 'js', 'editor-js'), function () { }));

// 'build' task runs the different compiling tasks above to generate the needed files without watching for a new change
gulp.task('build', gulp.series(gulp.parallel('styles', 'js', 'editor-js')));