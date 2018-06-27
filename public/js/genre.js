/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 50);
/******/ })
/************************************************************************/
/******/ ({

/***/ 50:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(51);


/***/ }),

/***/ 51:
/***/ (function(module, exports) {

var app = new Vue({
    el: '#app',
    data: {
        name: '',
        searchResult: []
    },
    watch: {
        name: function name() {
            this.getSearch();
        }
    },
    methods: {
        getSearch: function getSearch() {
            var app = this;
            if (app.name.length > 0) {
                axios.post('/manga/axios/search-genres', {
                    name: app.name
                }).then(function (rs) {
                    if (rs.data.length == 0) {
                        app.searchResult = [];
                    } else {
                        app.searchResult = rs.data;
                    }
                }).catch(function (e) {});
            } else {
                app.searchResult = [];
            }
        },
        date_format: function (_date_format) {
            function date_format(_x) {
                return _date_format.apply(this, arguments);
            }

            date_format.toString = function () {
                return _date_format.toString();
            };

            return date_format;
        }(function (str) {
            return date_format(str);
        }),
        showDelete: function showDelete(event) {
            swal({
                title: "Bạn có chắc chắn Xóa?",
                text: "bạn sẽ không thể phục hồi lại thể loại này",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Xóa",
                closeOnConfirm: true
            }, function () {
                axios.delete($(event.path[0]).data('href')).then(function (rs) {
                    swal("Đã xóa!", rs.data + " dã được xóa bỏ", "success");
                    location.reload();
                }).catch(function (e) {});
            });
        }
    }
});

/***/ })

/******/ });