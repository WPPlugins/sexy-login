=== Plugin Name ===
Contributors: OptimalDevs, Alejandro Galvez, Andy Hernandez
Donate link: http://optimaldevs.com/
Tags: login, register, sexy, ajax, authentication, captcha, sidebar, widget, user, ssl, secury, admin bar, ReCaptcha, cross browser, lost password
Requires at least: 3.0
Tested up to: 3.6
Stable tag: 2.5
License: GPLv3
License URI: http://www.gnu.org/licenses/gpl-3.0.html

Simple and cool login widget for your WordPress! AJAX, support SSL, show avatar, profile button, register and lost password forms...

== Description ==

This plugin allow you to get a sexy login widget in your WordPress. It’s useful for sites that would like to avoid the normal WordPress login pages. Sexy Login uses AJAX and jQuery effects, but have a fallback mechanism for javascript-disabled browsers.

Features:

* AJAX Login Form.
* AJAX Register Form.
* AJAX Lost Password Form.
* Error handling without refreshing your screen.
* Optional ReCaptcha verification for login and register forms.
* Control forgotten password request.
* Compatible with WordPress 3.0 or higher.
* Compatible with Internet Explorer, Safari, Chrome, Firefox, Opera.
* Work with forced SSL logins.
* Fallback mechanism, still work on javascript-disabled browsers.
* Specific option to show link to profile page and dashboard.
* Customizable redirect URL after log in or log out.
* Option to show or hide avatar and change it size.
* It's responsive!
* Languages: the same of your WordPress! (It’s multi-language). English or spanish in back-end.

[Try Demo](http://optimaldevs.com/demo/ "Try Sexy Login demo.")

Note: A new pro version is coming stay tune in http://optimaldevs.com/

== Installation ==

1. Upload sexy-login folder to wp-content/plugins.
2. Click "Activate" in the WordPress plugins menu.
1. Place "Sexy Login" widget in your sidebar.

== Screenshots ==

1. Sexy Login widget.

== Frequently Asked Questions ==

= Does Sexy Login support SSL mode? =

Yes.

= Login or Register form doesn't display correctly with reCaptcha enabled. =

Check that you've correctly entered both private and public keys in the "Sexy Login" plugin options.

= I have problems with the Sexy Login redirects and i use a cache system plugin.  =

That's one of the problems of cache systems. We can't modify third party plugins.

= I have problems with Captcha.  =

If you are using another plugin that also uses "reCAPTCHA" it is possible that one of the two "reCAPTCHA" doesn't work correctly. The reason is that "reCAPTCHA" only allows one instance on each page.

== Changelog ==

= 2.5 =
* Now it's compatible with WordPres 3.6.
* Fixed javascript error: "blockUI requires jQuery v1.3 or later! You are using v1.10.2".
* Updated blockUI library.
* Fixed problems when user tries to Log on.
* Fixed a few minor bugs.

= 2.4 =
* Fixed javascript error related to the style that produced an error in IE8 and below.

= 2.3 =
* Javascript improved to support wrong themes. ".sexy_login_widget" is no longer used as a handler, instead the plugin uses "#sexy-login-wrap".

= 2.2 =
* Registration form is optional.
* Lost Password form is optional.
* Added verification of form fields with HTML5.
* Improved a few details of style.
* New design on admin side.
* Improved the focus on forms.
* Removed maximum limit for the width of the widget.
* Removed maximum and minimum limit for the width of the Avatar.
* Improved SSL (Special thanks to jason102178).

= 2.1 =
* Added Show Nickname option.
* Fixed Show Avatar issue.
* Fixed some translations.
* Fixed error wrap width.

= 2.0 =
* Added Register Form with Ajax.
* Added Lost Password Form with Ajax.
* Added ReCaptcha Verification.
* Added control for forgotten password request.
* Fixed some few errors.
* Added languages: Spanish in back-end, all Languages in front-end.
* Shift widget options to back-end.
* Remove option to customize the style.
* Added option to resize avatar and wrap div width.
* Added Uninstall.php file.

= 1.0 =
* Initial release.