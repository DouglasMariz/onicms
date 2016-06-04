var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {

	// Admin
    mix.styles([
		'bootstrap.css',
		'font-awesome.css',
		'animate.min.css',
		'ionicons.css',
		'bootstrap-switch.css',
		'bootstrap-tokenfield.css',
		'sweetalert.css',
		'trumbowyg.css',
    	'dashboard.css',
    	'_admin.css'
	], 'public/assets/admin/css/admin.min.css', 'resources/assets/admin/css')
	.scripts([
        'jquery.min.js',
        'bootstrap.js',
        'light-bootstrap-dashboard.js',
        'jquery.maskedinput.min.js',
        'bootstrap-tokenfield.js',
        'bootstrap-table.js',
        'bootstrap-switch.js',
        'sweetalert.min.js',
        'trumbowyg.js',
        'trumbowyg.pt.min.js',
        'jquery.autocomplete.js',
        '_admin.js',
    ], 'public/assets/admin/js/admin.min.js', 'resources/assets/admin/js')

    // Copiando os assets para public
   	.copy(
       'resources/assets/admin/img', 'public/assets/admin/img'
    ).copy(
       'resources/assets/fonts', 'public/assets/fonts'
    );
    
});
