/**
 *
 * Gulp
 *
 * @since      1.0.0
 *
 * @package    Tipi Components
 * @subpackage tipi-components/
 */

var pkg                     = require('./package.json');
var project                 = pkg.realName;
var slug                    = pkg.slug;

var styleSRC                = './assets/scss/style.scss';
var styleAdminSRC           = './assets/admin-scss/admin-style.scss';
var styleDestination        = './assets/css/';

var styleWatchFiles         = './assets/scss/**/*.scss';
var styleAdminWatchFiles    = './assets/admin-scss/**/*.scss';
var phpWatchFiles           = './**/*.php';

var gulp                    = require('gulp');
var sass                    = require('gulp-sass');
var minifycss               = require('gulp-uglifycss');
var autoprefixer            = require('gulp-autoprefixer');
var mmq                     = require('gulp-merge-media-queries');

var concat                  = require('gulp-concat');
var uglify                  = require('gulp-uglify');

var rename                  = require('gulp-rename');
var lineec                  = require('gulp-line-ending-corrector');
var filter                  = require('gulp-filter');
var notify                  = require('gulp-notify');
var browserSync             = require('browser-sync').create();
var reload                  = browserSync.reload;
var wpPot                   = require('gulp-wp-pot');
var sort                    = require('gulp-sort');

var text_domain             = pkg.slug;
var destFile                = slug + '.pot';
var packageName             = project;
var bugReport               = pkg.bug_reports;
var lastTranslator          = pkg.author;
var team                    = pkg.author;
var translationPath           = './languages';

/**
 *
 * Task: Browser Sync
 *
*/
gulp.task( 'browser-sync', function() {
	browserSync.init( {
		proxy: 'http://127.0.0.1/plugcb/',
		open: true,
		injectChanges: true,
        snippetOptions: {
            whitelist: ["/wp-admin/admin-ajax.php"],
            blacklist: ["/wp-admin/**"]
        },
	} );
});

/**
 *
 * Task: Watcher
 *
*/
gulp.task( 'default', ['styles', 'stylesAdmin', 'browser-sync'], function () {
    gulp.watch( phpWatchFiles, reload );
    gulp.watch( styleWatchFiles, [ 'styles' ] );
    gulp.watch( styleAdminWatchFiles, [ 'stylesAdmin' ] );
});

/**
 *
 * Task: Styles
 *
*/
 gulp.task('styles', function () {
    gulp.src( styleSRC )
    .pipe( sass( {
        errLogToConsole: true,
        outputStyle: 'expanded',
        precision: 10
    } ) )
    .on('error', console.error.bind(console))
    .pipe( autoprefixer( [ 'last 2 version', '> 1%', 'ie >= 9', 'ie_mob >= 10', 'ff >= 30', 'chrome >= 34', 'safari >= 7', 'opera >= 23', 'ios >= 7', 'android >= 4', 'bb >= 10'] ) )

    .pipe( lineec() )
    .pipe( gulp.dest( styleDestination ) )

    .pipe( filter( '**/*.css' ) )
    .pipe( mmq( { log: true } ) )

    .pipe( browserSync.stream() )

    .pipe( rename( { suffix: '.min' } ) )
    .pipe( minifycss( { cuteComments: true }) )
    .pipe( lineec() )
    .pipe( gulp.dest( styleDestination ) )

    .pipe( filter( '**/*.css' ) )
    .pipe( browserSync.stream() )
    .pipe( notify( { message: 'styles done.', onLast: true } ) );
 });

/**
 *
 * Task: Styles
 *
*/
 gulp.task('stylesAdmin', function () {
    gulp.src( styleAdminSRC )
    .pipe( sass( {
        errLogToConsole: true,
        outputStyle: 'expanded',
        precision: 10
    } ) )
    .on('error', console.error.bind(console))
    .pipe( autoprefixer( [ 'last 2 version', '> 1%', 'ie >= 9', 'ie_mob >= 10', 'ff >= 30', 'chrome >= 34', 'safari >= 7', 'opera >= 23', 'ios >= 7', 'android >= 4', 'bb >= 10'] ) )

    .pipe( lineec() )
    .pipe( gulp.dest( styleDestination ) )

    .pipe( filter( '**/*.css' ) )
    .pipe( mmq( { log: true } ) )

    .pipe( browserSync.stream() )

    .pipe( rename( { suffix: '.min' } ) )
    .pipe( minifycss( { cuteComments: true }) )
    .pipe( lineec() )
    .pipe( gulp.dest( styleDestination ) )

    .pipe( filter( '**/*.css' ) )
    .pipe( browserSync.stream() )
    .pipe( notify( { message: 'styles done.', onLast: true } ) );
 });

/**
 *
 * Task: Translation
 *
*/
 gulp.task( 'translation', function () {
    gulp.src( phpWatchFiles )
    .pipe(sort())
    .pipe(wpPot( {
         domain        : text_domain,
         destFile      : destFile,
         package       : packageName,
         bugReport     : bugReport,
         lastTranslator: lastTranslator,
         team          : team
    } ))
    .pipe(gulp.dest(translationPath))
    .pipe( notify( { message: 'translation done.', onLast: true } ) );
});