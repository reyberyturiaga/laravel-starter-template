webpackJsonp([1],{

/***/ 14:
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(15);
module.exports = __webpack_require__(39);


/***/ }),

/***/ 15:
/***/ (function(module, exports, __webpack_require__) {

/* WEBPACK VAR INJECTION */(function(__webpack_provided_window_dot_jQuery, __webpack_provided_window_dot_$) {/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

window._ = __webpack_require__(4);

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

__webpack_provided_window_dot_$ = __webpack_provided_window_dot_jQuery = __webpack_require__(1);

__webpack_require__(5);

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = __webpack_require__(6);

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Next we will register the CSRF Token as a common header with Axios so that
 * all outgoing HTTP requests automatically have it attached. This is just
 * a simple convenience so we don't have to attach every token manually.
 */

var token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
  window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
  console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

window.Vue = __webpack_require__(13);

__webpack_require__(37);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

var app = new Vue({
  el: '#app'
});

/**
 * Lastly, we will load other javascript plugins and libraries
 * that the application will be needing as dependencies.
 */

__webpack_require__(38);
/* WEBPACK VAR INJECTION */}.call(exports, __webpack_require__(1), __webpack_require__(1)))

/***/ }),

/***/ 37:
/***/ (function(module, exports) {

/**
 * This file contains vue component definitions.
 */

/***/ }),

/***/ 38:
/***/ (function(module, exports) {

/**
 * Import application's plugins and libraries on this file.
 */

/***/ }),

/***/ 39:
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ })

},[14]);