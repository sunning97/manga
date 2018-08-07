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
/******/ 	return __webpack_require__(__webpack_require__.s = 103);
/******/ })
/************************************************************************/
/******/ ({

/***/ 103:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(104);


/***/ }),

/***/ 104:
/***/ (function(module, exports) {

var app = new Vue({
    el: '#app',
    data: {
        provinces: [],
        districts: [],
        wards: [],
        isAddress: false,
        isProvince: false,
        isDistrict: false,
        isPassword: false,
        email: '',
        isEmail: false,
        emailCheckMess: ''
    },
    mounted: function mounted() {
        this.getProvinces();
    },

    watch: {
        email: function email() {
            console.log(this.email);
        }
    },
    methods: {
        getProvinces: function getProvinces() {
            var _this = this;

            axios.get('/admin/axios/provinces').then(function (response) {
                _this.provinces = response.data;
            });
        },
        getDistricts: function getDistricts(e) {
            var _this2 = this;

            axios.get('/admin/axios/districts/' + $(e.path[0]).val()).then(function (response) {
                _this2.districts = response.data;
                _this2.isProvince = true;
                _this2.wards = [];
            });
        },
        getWards: function getWards(e) {
            var _this3 = this;

            axios.get('/admin/axios/wards/' + $(e.path[0]).val()).then(function (response) {
                _this3.wards = response.data;
                _this3.isDistrict = true;
            });
        },
        checkEmail: function checkEmail() {
            var _this4 = this;

            this.isEmail = false;
            axios.post('/admin/axios/admin/check-email', {
                email: this.email
            }).then(function (response) {
                if (response.data == 'used') {
                    _this4.isEmail = true;
                    _this4.emailCheckMess = response.data;
                } else _this4.emailCheckMess = response.data;
            });
        },
        submit: function submit(e) {
            if (this.isEmail) e.preventDefault();
        }
    }
});

$("#signupForm").validate({
    rules: {
        f_name: "required",
        l_name: "required",
        password: {
            required: true,
            minlength: 6
        },
        confirm_password: {
            required: true,
            minlength: 6,
            equalTo: "#password"
        },
        province: "required",
        district: "required",
        ward: "required",
        street: "required",
        email: {
            required: true,
            email: true
        }
    },
    messages: {
        f_name: "Họ không được để trống!",
        l_name: "Tên không được để trống",
        password: {
            required: "Nhập mật khẩu",
            minlength: "Mật khẩu phải nhiều hơn 5 kí tự"
        },
        confirm_password: {
            required: "Nhập mật khẩu",
            minlength: "Mật khẩu phải nhiều hơn 5 kí tự",
            equalTo: "Mật khẩu không khớp!"
        },
        province: "Vui lòng chọn Tỉnh/Thành phố",
        district: "Vui lòng chọn Quận/Huyện",
        ward: "Vui lòng chọn Phường/Xã",
        street: "Vui lòng nhập tên đường, số nhà",
        email: "Vui lòng nhập email!"
    },
    errorPlacement: function errorPlacement(label, element) {
        label.addClass('mt-2 text-danger');
        label.insertAfter(element);
    },
    highlight: function highlight(element, errorClass) {
        $(element).parent().addClass('has-danger');
        $(element).addClass('form-control-danger');
    }
});

/***/ })

/******/ });