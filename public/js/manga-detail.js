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
/******/ 	return __webpack_require__(__webpack_require__.s = 136);
/******/ })
/************************************************************************/
/******/ ({

/***/ 0:
/***/ (function(module, exports) {

/* globals __VUE_SSR_CONTEXT__ */

// IMPORTANT: Do NOT use ES2015 features in this file.
// This module is a runtime utility for cleaner component module output and will
// be included in the final webpack user bundle.

module.exports = function normalizeComponent (
  rawScriptExports,
  compiledTemplate,
  functionalTemplate,
  injectStyles,
  scopeId,
  moduleIdentifier /* server only */
) {
  var esModule
  var scriptExports = rawScriptExports = rawScriptExports || {}

  // ES6 modules interop
  var type = typeof rawScriptExports.default
  if (type === 'object' || type === 'function') {
    esModule = rawScriptExports
    scriptExports = rawScriptExports.default
  }

  // Vue.extend constructor export interop
  var options = typeof scriptExports === 'function'
    ? scriptExports.options
    : scriptExports

  // render functions
  if (compiledTemplate) {
    options.render = compiledTemplate.render
    options.staticRenderFns = compiledTemplate.staticRenderFns
    options._compiled = true
  }

  // functional template
  if (functionalTemplate) {
    options.functional = true
  }

  // scopedId
  if (scopeId) {
    options._scopeId = scopeId
  }

  var hook
  if (moduleIdentifier) { // server build
    hook = function (context) {
      // 2.3 injection
      context =
        context || // cached call
        (this.$vnode && this.$vnode.ssrContext) || // stateful
        (this.parent && this.parent.$vnode && this.parent.$vnode.ssrContext) // functional
      // 2.2 with runInNewContext: true
      if (!context && typeof __VUE_SSR_CONTEXT__ !== 'undefined') {
        context = __VUE_SSR_CONTEXT__
      }
      // inject component styles
      if (injectStyles) {
        injectStyles.call(this, context)
      }
      // register component module identifier for async chunk inferrence
      if (context && context._registeredComponents) {
        context._registeredComponents.add(moduleIdentifier)
      }
    }
    // used by ssr in case component is cached and beforeCreate
    // never gets called
    options._ssrRegister = hook
  } else if (injectStyles) {
    hook = injectStyles
  }

  if (hook) {
    var functional = options.functional
    var existing = functional
      ? options.render
      : options.beforeCreate

    if (!functional) {
      // inject component registration as beforeCreate hook
      options.beforeCreate = existing
        ? [].concat(existing, hook)
        : [hook]
    } else {
      // for template-only hot-reload because in that case the render fn doesn't
      // go through the normalizer
      options._injectStyles = hook
      // register for functioal component in vue file
      options.render = function renderWithStyleInjection (h, context) {
        hook.call(context)
        return existing(h, context)
      }
    }
  }

  return {
    esModule: esModule,
    exports: scriptExports,
    options: options
  }
}


/***/ }),

/***/ 136:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(137);


/***/ }),

/***/ 137:
/***/ (function(module, exports, __webpack_require__) {


Vue.component('comment', __webpack_require__(138));
var app = new Vue({
    el: '#app',
    data: {}
});

/***/ }),

/***/ 138:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
var normalizeComponent = __webpack_require__(0)
/* script */
var __vue_script__ = __webpack_require__(139)
/* template */
var __vue_template__ = __webpack_require__(155)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = null
/* scopeId */
var __vue_scopeId__ = null
/* moduleIdentifier (server only) */
var __vue_module_identifier__ = null
var Component = normalizeComponent(
  __vue_script__,
  __vue_template__,
  __vue_template_functional__,
  __vue_styles__,
  __vue_scopeId__,
  __vue_module_identifier__
)
Component.options.__file = "resources\\assets\\js\\components\\site\\manga-comments\\MangaComments.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-1e6f2527", Component.options)
  } else {
    hotAPI.reload("data-v-1e6f2527", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ 139:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__ListComment__ = __webpack_require__(140);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__ListComment___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_0__ListComment__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__Pagination__ = __webpack_require__(149);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__Pagination___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_1__Pagination__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2__WriteComment__ = __webpack_require__(152);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2__WriteComment___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_2__WriteComment__);
//
//
//
//
//
//
//




/* harmony default export */ __webpack_exports__["default"] = ({
    props: {
        manga: {
            type: Object,
            default: null,
            required: true
        },
        url: {
            type: String,
            default: ''
        },
        user: {
            type: Object,
            default: null
        }
    },
    data: function data() {
        return {
            comments: [],
            pagination: {},
            offset: 5,
            totalComments: 0,
            isPage: false
        };
    },
    mounted: function mounted() {
        this.getComment(1);
        this.getTotalComments();
    },

    methods: {
        getComment: function getComment(page) {
            var _this = this;

            this.isPage = true;
            this.comments = [];
            this.pagination = {};
            axios.post('/axios/get-comment?page=' + page, {
                manga_id: this.manga.id
            }).then(function (response) {
                _this.comments = response.data.data;
                _this.pagination = response.data;
                _this.isPage = false;
            }).catch(function (error) {
                console.log(error.response.data.message);
            });
        },
        getTotalComments: function getTotalComments() {
            var _this2 = this;

            axios.post('/axios/get-total-comments', {
                manga_id: this.manga.id
            }).then(function (response) {
                _this2.totalComments = response.data;
            });
        },
        postComment: function postComment(comment) {
            var _this3 = this;

            axios.post('/axios/save-comment', {
                manga_id: this.manga.id,
                comment: comment
            }).then(function (response) {
                _this3.comments.unshift(response.data);
                _this3.totalComments++;
            }).catch(function (error) {});
        },
        refreshComment: function refreshComment() {
            this.getComment(1);
            this.getTotalComments();
        }
    },
    components: {
        'list-comment': __WEBPACK_IMPORTED_MODULE_0__ListComment___default.a,
        'pagination': __WEBPACK_IMPORTED_MODULE_1__Pagination___default.a,
        'write-comment': __WEBPACK_IMPORTED_MODULE_2__WriteComment___default.a
    }
});

/***/ }),

/***/ 140:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(158)
}
var normalizeComponent = __webpack_require__(0)
/* script */
var __vue_script__ = __webpack_require__(141)
/* template */
var __vue_template__ = __webpack_require__(160)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = "data-v-0af16c80"
/* moduleIdentifier (server only) */
var __vue_module_identifier__ = null
var Component = normalizeComponent(
  __vue_script__,
  __vue_template__,
  __vue_template_functional__,
  __vue_styles__,
  __vue_scopeId__,
  __vue_module_identifier__
)
Component.options.__file = "resources\\assets\\js\\components\\site\\manga-comments\\ListComment.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-0af16c80", Component.options)
  } else {
    hotAPI.reload("data-v-0af16c80", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ 141:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__comment_ParentComment__ = __webpack_require__(142);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__comment_ParentComment___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_0__comment_ParentComment__);
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//


/* harmony default export */ __webpack_exports__["default"] = ({
    props: {
        comments: {
            type: Array,
            default: []
        },
        url: {
            type: String,
            default: ''
        },
        totalComments: {
            type: Number,
            default: 0
        },
        isPage: {
            type: Boolean,
            default: false
        },
        manga: {
            type: Object,
            default: {}
        }
    },
    mounted: function mounted() {
        $('#commnent').slimScroll({
            height: '500px'
        });
    },

    methods: {
        refreshComment: function refreshComment() {
            this.$emit('refreshComment');
        }
    },
    components: {
        'parent-comment': __WEBPACK_IMPORTED_MODULE_0__comment_ParentComment___default.a
    }
});

/***/ }),

/***/ 142:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
var normalizeComponent = __webpack_require__(0)
/* script */
var __vue_script__ = __webpack_require__(143)
/* template */
var __vue_template__ = __webpack_require__(147)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = null
/* scopeId */
var __vue_scopeId__ = null
/* moduleIdentifier (server only) */
var __vue_module_identifier__ = null
var Component = normalizeComponent(
  __vue_script__,
  __vue_template__,
  __vue_template_functional__,
  __vue_styles__,
  __vue_scopeId__,
  __vue_module_identifier__
)
Component.options.__file = "resources\\assets\\js\\components\\site\\manga-comments\\comment\\ParentComment.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-4a112012", Component.options)
  } else {
    hotAPI.reload("data-v-4a112012", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ 143:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__ChildComment__ = __webpack_require__(144);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__ChildComment___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_0__ChildComment__);
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//


/* harmony default export */ __webpack_exports__["default"] = ({
    props: {
        comment: {
            type: Object,
            default: {}
        },
        url: {
            type: String,
            default: ''
        },
        manga: {
            type: Object,
            default: {},
            require: true
        }
    },
    data: function data() {
        return {
            comments: [],
            isReply: false,
            content: '',
            isEmpty: false,
            isPassTime: true,
            isSpam: false
        };
    },
    mounted: function mounted() {
        this.childComments();
    },

    methods: {
        childComments: function childComments() {
            var _this = this;

            axios.post('/axios/get-child-comment', {
                parent_comment: this.comment.comment_id
            }).then(function (response) {
                _this.comments = response.data;
            }).catch(function (error) {
                _this.comments = [];
            });
        },
        date_format: function date_format(str) {
            return $.format.date(str, "dd-MM-yyyy");
        },
        reply: function reply() {
            this.isReply = !this.isReply;
        },
        postComment: function postComment() {
            var tmp = this;
            event.preventDefault();

            if (!tmp.isPassTime) {
                tmp.isSpam = true;
                return;
            }

            if (tmp.content == '') {
                tmp.isEmpty = true;
                return false;
            }

            tmp.isPassTime = false;
            setTimeout(function () {
                tmp.isPassTime = true;tmp.isSpam = false;
            }, 5000);
            axios.post('/axios/save-comment', {
                parent_id: tmp.comment.comment_id,
                comment: tmp.content,
                manga_id: tmp.manga.id
            }).then(function (response) {
                tmp.comments.push(response.data);
            }).catch(function (error) {});
            tmp.content = '';
        }
    },
    components: {
        'child-comment': __WEBPACK_IMPORTED_MODULE_0__ChildComment___default.a
    }
});

/***/ }),

/***/ 144:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
var normalizeComponent = __webpack_require__(0)
/* script */
var __vue_script__ = __webpack_require__(145)
/* template */
var __vue_template__ = __webpack_require__(146)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = null
/* scopeId */
var __vue_scopeId__ = null
/* moduleIdentifier (server only) */
var __vue_module_identifier__ = null
var Component = normalizeComponent(
  __vue_script__,
  __vue_template__,
  __vue_template_functional__,
  __vue_styles__,
  __vue_scopeId__,
  __vue_module_identifier__
)
Component.options.__file = "resources\\assets\\js\\components\\site\\manga-comments\\comment\\ChildComment.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-ced8f81e", Component.options)
  } else {
    hotAPI.reload("data-v-ced8f81e", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ 145:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//

/* harmony default export */ __webpack_exports__["default"] = ({
    props: {
        comments: {
            type: Array,
            default: []
        },
        url: {
            type: String,
            default: ''
        }
    },
    methods: {
        date_format: function date_format(str) {
            return $.format.date(str, "dd-MM-yyyy");
        }
    }
});

/***/ }),

/***/ 146:
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "div",
    _vm._l(_vm.comments, function(comment) {
      return _c("ul", { staticClass: "post__comments-children mb-5" }, [
        _c("li", { staticClass: "post__comments-item" }, [
          _c("div", { staticClass: "row" }, [
            _c("div", { staticClass: "col-md-2" }, [
              _c("img", {
                staticClass: "img-responsive",
                attrs: {
                  src: _vm.url + "/" + comment.avatar,
                  alt: "Comment Author"
                }
              })
            ]),
            _vm._v(" "),
            _c(
              "div",
              {
                staticClass: "col-md-10",
                staticStyle: { "background-color": "rgb(214, 214, 214)" }
              },
              [
                _c("div", { staticClass: "post__comments-item-info" }, [
                  _c(
                    "div",
                    { staticClass: "post__comments-item-info-author" },
                    [
                      _c("span", [
                        _c("a", { attrs: { href: "#" } }, [
                          _vm._v(_vm._s(comment.f_name + " " + comment.l_name))
                        ])
                      ])
                    ]
                  ),
                  _vm._v(" "),
                  _c("div", { staticClass: "post__comments-item-info-date" }, [
                    _c("span", [
                      _c("a", { attrs: { href: "#" } }, [
                        _vm._v(_vm._s(_vm.date_format(comment.created_at)))
                      ])
                    ])
                  ])
                ]),
                _vm._v(" "),
                _c("div", {}, [_c("p", [_vm._v(_vm._s(comment.content))])])
              ]
            )
          ]),
          _vm._v(" "),
          _c("hr")
        ])
      ])
    })
  )
}
var staticRenderFns = []
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-ced8f81e", module.exports)
  }
}

/***/ }),

/***/ 147:
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "div",
    [
      _c("div", { staticClass: "row mb-5" }, [
        _c("div", { staticClass: "col-md-2" }, [
          _c("img", {
            staticClass: "img-responsive",
            attrs: {
              src: _vm.url + "/" + _vm.comment.avatar,
              alt: _vm.comment.f_name + " " + _vm.comment.l_name
            }
          })
        ]),
        _vm._v(" "),
        _c("div", { staticClass: "col-md-10 bg-info rounded" }, [
          _c("div", { staticClass: "post__comments-item-reply" }, [
            _c(
              "span",
              { staticClass: "btn btn-default", on: { click: _vm.reply } },
              [_vm._v("Reply")]
            )
          ]),
          _vm._v(" "),
          _c("div", { staticClass: "post__comments-item-info" }, [
            _c("div", { staticClass: "post__comments-item-info-author" }, [
              _c("span", [
                _c("a", { attrs: { href: "#" } }, [
                  _vm._v(_vm._s(_vm.comment.f_name + " " + _vm.comment.l_name))
                ])
              ])
            ]),
            _vm._v(" "),
            _c("div", { staticClass: "post__comments-item-info-date" }, [
              _c("span", [
                _c("a", { attrs: { href: "#" } }, [
                  _vm._v(_vm._s(_vm.date_format(_vm.comment.created_at)))
                ])
              ])
            ])
          ]),
          _vm._v(" "),
          _c("div", { staticClass: "post__comments-item-post" }, [
            _c("p", [_vm._v(_vm._s(_vm.comment.content))])
          ])
        ]),
        _vm._v(" "),
        _vm.isReply
          ? _c("div", { staticClass: "row" }, [
              _c("div", { staticClass: "col-md-11 col-md-push-1" }, [
                _c("div", { staticClass: "post__comments-respond" }, [
                  _c("form", { attrs: { action: "", method: "post" } }, [
                    _c("p", { staticClass: "post__comments-respond-comment" }, [
                      _c("textarea", {
                        directives: [
                          {
                            name: "model",
                            rawName: "v-model",
                            value: _vm.content,
                            expression: "content"
                          }
                        ],
                        attrs: {
                          id: "comment",
                          name: "comment",
                          cols: "30",
                          "aria-required": "true"
                        },
                        domProps: { value: _vm.content },
                        on: {
                          focus: function($event) {
                            _vm.isEmpty = false
                          },
                          input: function($event) {
                            if ($event.target.composing) {
                              return
                            }
                            _vm.content = $event.target.value
                          }
                        }
                      }),
                      _vm._v(" "),
                      _vm.isEmpty
                        ? _c("span", { staticClass: "text-danger" }, [
                            _c("strong", [
                              _vm._v("Bình luận không được để trống")
                            ])
                          ])
                        : _vm._e(),
                      _vm._v(" "),
                      _vm.isSpam
                        ? _c("span", { staticClass: "text-danger" }, [
                            _c("strong", [
                              _vm._v(
                                "Để tránh spam vui lòng bình luận lại sau 5 giây"
                              )
                            ])
                          ])
                        : _vm._e()
                    ]),
                    _vm._v(" "),
                    _c("p", { staticClass: "post__comments-respond-submit" }, [
                      _c("input", {
                        attrs: {
                          id: "submit",
                          type: "submit",
                          name: "submit",
                          size: "30",
                          value: "Đăng"
                        },
                        on: { click: _vm.postComment }
                      })
                    ])
                  ])
                ])
              ])
            ])
          : _vm._e()
      ]),
      _vm._v(" "),
      _c("hr"),
      _vm._v(" "),
      _vm.comments.length > 0
        ? _c("child-comment", {
            attrs: { comments: _vm.comments, url: _vm.url }
          })
        : _vm._e(),
      _vm._v(" "),
      _c("hr")
    ],
    1
  )
}
var staticRenderFns = []
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-4a112012", module.exports)
  }
}

/***/ }),

/***/ 149:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
var normalizeComponent = __webpack_require__(0)
/* script */
var __vue_script__ = __webpack_require__(150)
/* template */
var __vue_template__ = __webpack_require__(151)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = null
/* scopeId */
var __vue_scopeId__ = null
/* moduleIdentifier (server only) */
var __vue_module_identifier__ = null
var Component = normalizeComponent(
  __vue_script__,
  __vue_template__,
  __vue_template_functional__,
  __vue_styles__,
  __vue_scopeId__,
  __vue_module_identifier__
)
Component.options.__file = "resources\\assets\\js\\components\\site\\manga-comments\\Pagination.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-9478d46a", Component.options)
  } else {
    hotAPI.reload("data-v-9478d46a", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ 150:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//

/* harmony default export */ __webpack_exports__["default"] = ({
    props: {
        pagination: {
            type: Object,
            require: true
        },
        offset: {
            type: Number,
            default: 5
        }
    },
    computed: {
        pagesNumber: function pagesNumber() {
            if (!this.pagination.to) {
                return [];
            }

            var from = this.pagination.current_page - this.offset;
            if (from < 1) {
                from = 1;
            }
            var to = this.pagination.current_page + this.offset;
            if (to >= this.pagination.last_page) {
                to = this.pagination.last_page;
            }

            var pagesArray = [];
            for (var i = from; i <= to; i++) {
                pagesArray.push(i);
            }
            return pagesArray;
        }
    },
    methods: {
        changePage: function changePage(page) {
            this.pagination.current_page = page;
        }
    }
});

/***/ }),

/***/ 151:
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("nav", { staticClass: "col-12 text-center" }, [
    _c(
      "ul",
      { staticClass: "pagination" },
      [
        _vm.pagination.current_page > 3
          ? _c("li", { staticClass: "page-item" }, [
              _c(
                "a",
                {
                  staticClass: "page-link",
                  attrs: { href: "" },
                  on: {
                    click: function($event) {
                      $event.preventDefault()
                      _vm.changePage(1)
                    }
                  }
                },
                [_vm._v("<<")]
              )
            ])
          : _vm._e(),
        _vm._v(" "),
        _vm.pagination.current_page > 2
          ? _c("li", { staticClass: "page-item" }, [
              _c(
                "a",
                {
                  staticClass: "page-link",
                  attrs: { href: "" },
                  on: {
                    click: function($event) {
                      $event.preventDefault()
                      _vm.changePage(_vm.pagination.current_page - 1)
                    }
                  }
                },
                [_vm._v("<")]
              )
            ])
          : _vm._e(),
        _vm._v(" "),
        _vm._l(_vm.pagesNumber, function(n) {
          return _c(
            "li",
            {
              staticClass: "page-item",
              class: _vm.pagination.current_page == n ? "active" : ""
            },
            [
              _c(
                "a",
                {
                  staticClass: "page-link",
                  attrs: { href: "" },
                  on: {
                    click: function($event) {
                      $event.preventDefault()
                      _vm.changePage(n)
                    }
                  }
                },
                [_vm._v(_vm._s(n))]
              )
            ]
          )
        }),
        _vm._v(" "),
        _vm.pagination.current_page < _vm.pagination.last_page
          ? _c("li", { staticClass: "page-item" }, [
              _c(
                "a",
                {
                  staticClass: "page-link",
                  attrs: { href: "" },
                  on: {
                    click: function($event) {
                      $event.preventDefault()
                      _vm.changePage(_vm.pagination.current_page + 1)
                    }
                  }
                },
                [_vm._v(">")]
              )
            ])
          : _vm._e(),
        _vm._v(" "),
        _vm.pagination.last_page - _vm.pagination.current_page > 3
          ? _c("li", { staticClass: "page-item" }, [
              _c(
                "a",
                {
                  staticClass: "page-link",
                  attrs: { href: "" },
                  on: {
                    click: function($event) {
                      $event.preventDefault()
                      _vm.changePage(_vm.pagination.last_page)
                    }
                  }
                },
                [_vm._v(">>")]
              )
            ])
          : _vm._e()
      ],
      2
    )
  ])
}
var staticRenderFns = []
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-9478d46a", module.exports)
  }
}

/***/ }),

/***/ 152:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
var normalizeComponent = __webpack_require__(0)
/* script */
var __vue_script__ = __webpack_require__(153)
/* template */
var __vue_template__ = __webpack_require__(154)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = null
/* scopeId */
var __vue_scopeId__ = null
/* moduleIdentifier (server only) */
var __vue_module_identifier__ = null
var Component = normalizeComponent(
  __vue_script__,
  __vue_template__,
  __vue_template_functional__,
  __vue_styles__,
  __vue_scopeId__,
  __vue_module_identifier__
)
Component.options.__file = "resources\\assets\\js\\components\\site\\manga-comments\\WriteComment.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-0dd79e71", Component.options)
  } else {
    hotAPI.reload("data-v-0dd79e71", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ 153:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//

/* harmony default export */ __webpack_exports__["default"] = ({
    props: {
        user: {
            type: Object,
            default: null
        }
    },
    data: function data() {
        return {
            comment: '',
            isCommentEmpty: false,
            isPassTime: true,
            isSpam: false
        };
    },
    mounted: function mounted() {},

    methods: {
        postComment: function postComment() {
            var tmp = this;
            event.preventDefault();
            if (!this.isPassTime) {
                this.isSpam = true;
                return;
            }

            if (this.comment == '') {
                this.isCommentEmpty = true;
                return;
            }

            this.isPassTime = false;
            this.$emit('postComment', this.comment);
            setTimeout(function () {
                tmp.isPassTime = true;tmp.isSpam = false;
            }, 5000);
            this.comment = '';
        }
    }
});

/***/ }),

/***/ 154:
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div", { staticClass: "post__comments-respond" }, [
    _c("div", {}, [
      _c("h5", [_vm._v("Viết bình luận của bạn")]),
      _vm._v(" "),
      _vm.user
        ? _c("form", { attrs: { action: "", method: "post" } }, [
            _c("p", { staticClass: "post__comments-respond-comment" }, [
              _c("label", { attrs: { for: "comment" } }, [_vm._v("Comment")]),
              _vm._v(" "),
              _c("textarea", {
                directives: [
                  {
                    name: "model",
                    rawName: "v-model",
                    value: _vm.comment,
                    expression: "comment"
                  }
                ],
                staticClass: "form-control",
                attrs: {
                  id: "comment",
                  name: "comment",
                  cols: "45",
                  "aria-required": "true"
                },
                domProps: { value: _vm.comment },
                on: {
                  focus: function($event) {
                    _vm.isCommentEmpty = false
                  },
                  input: function($event) {
                    if ($event.target.composing) {
                      return
                    }
                    _vm.comment = $event.target.value
                  }
                }
              }),
              _vm._v(" "),
              _vm.isCommentEmpty
                ? _c(
                    "span",
                    { staticClass: "text-danger", attrs: { role: "alert" } },
                    [_c("strong", [_vm._v("Bình luận không được để trống")])]
                  )
                : _vm._e(),
              _vm._v(" "),
              _vm.isSpam
                ? _c(
                    "span",
                    { staticClass: "text-danger", attrs: { role: "alert" } },
                    [
                      _c("strong", [
                        _vm._v(
                          "Để tránh spam vui lòng bình luận lại sau 5 giây"
                        )
                      ])
                    ]
                  )
                : _vm._e()
            ]),
            _vm._v(" "),
            _c("p", { staticClass: "post__comments-respond-submit" }, [
              _c("input", {
                attrs: {
                  id: "submit",
                  type: "submit",
                  name: "submit",
                  size: "30",
                  value: "Đăng"
                },
                on: { click: _vm.postComment }
              })
            ])
          ])
        : _c("div", [_c("b", [_vm._v("Vui lòng đăng nhập để viết bình luận")])])
    ])
  ])
}
var staticRenderFns = []
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-0dd79e71", module.exports)
  }
}

/***/ }),

/***/ 155:
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "div",
    {
      staticClass: "post__comments bg-dark",
      staticStyle: { "background-color": "rgba(212, 212, 212, 0.24)" }
    },
    [
      _c("list-comment", {
        staticClass: "border border-secondary",
        attrs: {
          comments: _vm.comments,
          url: _vm.url,
          totalComments: _vm.totalComments,
          isPage: _vm.isPage,
          manga: _vm.manga
        },
        on: { refreshComment: _vm.refreshComment }
      }),
      _vm._v(" "),
      _c("pagination", {
        attrs: { pagination: _vm.pagination, offset: _vm.offset },
        nativeOn: {
          click: function($event) {
            _vm.getComment(_vm.pagination.current_page)
          }
        }
      }),
      _vm._v(" "),
      _c("write-comment", {
        attrs: { user: _vm.user },
        on: { postComment: _vm.postComment }
      })
    ],
    1
  )
}
var staticRenderFns = []
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-1e6f2527", module.exports)
  }
}

/***/ }),

/***/ 158:
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(159);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(5)("758d5a0a", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../../node_modules/css-loader/index.js!../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-0af16c80\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./ListComment.vue", function() {
     var newContent = require("!!../../../../../../node_modules/css-loader/index.js!../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-0af16c80\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./ListComment.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ 159:
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(4)(false);
// imports


// module
exports.push([module.i, "\n.click[data-v-0af16c80]{\n    cursor: pointer;\n}\n", ""]);

// exports


/***/ }),

/***/ 160:
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div", [
    _c("div", { staticClass: "row" }, [
      _c("div", { staticClass: "col-md-8" }, [
        _vm.comments.length > 0
          ? _c("h5", [
              _c("b", [_vm._v(_vm._s(_vm.totalComments) + " Bình luận")])
            ])
          : _c("h5", { staticClass: "text-center" }, [
              _c("b", [_vm._v("Không có bình luận nào")])
            ])
      ]),
      _vm._v(" "),
      _c("div", { staticClass: "col-md-4" }, [
        _c(
          "span",
          { staticClass: "click", on: { click: _vm.refreshComment } },
          [_c("b", [_vm._v("Làm mới bình luận")])]
        )
      ])
    ]),
    _vm._v(" "),
    _c(
      "ul",
      { staticClass: "post__comments-list", attrs: { id: "commnent" } },
      [
        _vm.comments.length == 0 && _vm.isPage
          ? _c("div", { staticClass: "text-center" }, [_vm._v("Đang tải...")])
          : _vm._e(),
        _vm._v(" "),
        _vm._l(_vm.comments, function(comment) {
          return _c(
            "li",
            { staticClass: "post__comments-item" },
            [
              _c("parent-comment", {
                attrs: { comment: comment, url: _vm.url, manga: _vm.manga }
              })
            ],
            1
          )
        })
      ],
      2
    )
  ])
}
var staticRenderFns = []
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-0af16c80", module.exports)
  }
}

/***/ }),

/***/ 4:
/***/ (function(module, exports) {

/*
	MIT License http://www.opensource.org/licenses/mit-license.php
	Author Tobias Koppers @sokra
*/
// css base code, injected by the css-loader
module.exports = function(useSourceMap) {
	var list = [];

	// return the list of modules as css string
	list.toString = function toString() {
		return this.map(function (item) {
			var content = cssWithMappingToString(item, useSourceMap);
			if(item[2]) {
				return "@media " + item[2] + "{" + content + "}";
			} else {
				return content;
			}
		}).join("");
	};

	// import a list of modules into the list
	list.i = function(modules, mediaQuery) {
		if(typeof modules === "string")
			modules = [[null, modules, ""]];
		var alreadyImportedModules = {};
		for(var i = 0; i < this.length; i++) {
			var id = this[i][0];
			if(typeof id === "number")
				alreadyImportedModules[id] = true;
		}
		for(i = 0; i < modules.length; i++) {
			var item = modules[i];
			// skip already imported module
			// this implementation is not 100% perfect for weird media query combinations
			//  when a module is imported multiple times with different media queries.
			//  I hope this will never occur (Hey this way we have smaller bundles)
			if(typeof item[0] !== "number" || !alreadyImportedModules[item[0]]) {
				if(mediaQuery && !item[2]) {
					item[2] = mediaQuery;
				} else if(mediaQuery) {
					item[2] = "(" + item[2] + ") and (" + mediaQuery + ")";
				}
				list.push(item);
			}
		}
	};
	return list;
};

function cssWithMappingToString(item, useSourceMap) {
	var content = item[1] || '';
	var cssMapping = item[3];
	if (!cssMapping) {
		return content;
	}

	if (useSourceMap && typeof btoa === 'function') {
		var sourceMapping = toComment(cssMapping);
		var sourceURLs = cssMapping.sources.map(function (source) {
			return '/*# sourceURL=' + cssMapping.sourceRoot + source + ' */'
		});

		return [content].concat(sourceURLs).concat([sourceMapping]).join('\n');
	}

	return [content].join('\n');
}

// Adapted from convert-source-map (MIT)
function toComment(sourceMap) {
	// eslint-disable-next-line no-undef
	var base64 = btoa(unescape(encodeURIComponent(JSON.stringify(sourceMap))));
	var data = 'sourceMappingURL=data:application/json;charset=utf-8;base64,' + base64;

	return '/*# ' + data + ' */';
}


/***/ }),

/***/ 5:
/***/ (function(module, exports, __webpack_require__) {

/*
  MIT License http://www.opensource.org/licenses/mit-license.php
  Author Tobias Koppers @sokra
  Modified by Evan You @yyx990803
*/

var hasDocument = typeof document !== 'undefined'

if (typeof DEBUG !== 'undefined' && DEBUG) {
  if (!hasDocument) {
    throw new Error(
    'vue-style-loader cannot be used in a non-browser environment. ' +
    "Use { target: 'node' } in your Webpack config to indicate a server-rendering environment."
  ) }
}

var listToStyles = __webpack_require__(6)

/*
type StyleObject = {
  id: number;
  parts: Array<StyleObjectPart>
}

type StyleObjectPart = {
  css: string;
  media: string;
  sourceMap: ?string
}
*/

var stylesInDom = {/*
  [id: number]: {
    id: number,
    refs: number,
    parts: Array<(obj?: StyleObjectPart) => void>
  }
*/}

var head = hasDocument && (document.head || document.getElementsByTagName('head')[0])
var singletonElement = null
var singletonCounter = 0
var isProduction = false
var noop = function () {}
var options = null
var ssrIdKey = 'data-vue-ssr-id'

// Force single-tag solution on IE6-9, which has a hard limit on the # of <style>
// tags it will allow on a page
var isOldIE = typeof navigator !== 'undefined' && /msie [6-9]\b/.test(navigator.userAgent.toLowerCase())

module.exports = function (parentId, list, _isProduction, _options) {
  isProduction = _isProduction

  options = _options || {}

  var styles = listToStyles(parentId, list)
  addStylesToDom(styles)

  return function update (newList) {
    var mayRemove = []
    for (var i = 0; i < styles.length; i++) {
      var item = styles[i]
      var domStyle = stylesInDom[item.id]
      domStyle.refs--
      mayRemove.push(domStyle)
    }
    if (newList) {
      styles = listToStyles(parentId, newList)
      addStylesToDom(styles)
    } else {
      styles = []
    }
    for (var i = 0; i < mayRemove.length; i++) {
      var domStyle = mayRemove[i]
      if (domStyle.refs === 0) {
        for (var j = 0; j < domStyle.parts.length; j++) {
          domStyle.parts[j]()
        }
        delete stylesInDom[domStyle.id]
      }
    }
  }
}

function addStylesToDom (styles /* Array<StyleObject> */) {
  for (var i = 0; i < styles.length; i++) {
    var item = styles[i]
    var domStyle = stylesInDom[item.id]
    if (domStyle) {
      domStyle.refs++
      for (var j = 0; j < domStyle.parts.length; j++) {
        domStyle.parts[j](item.parts[j])
      }
      for (; j < item.parts.length; j++) {
        domStyle.parts.push(addStyle(item.parts[j]))
      }
      if (domStyle.parts.length > item.parts.length) {
        domStyle.parts.length = item.parts.length
      }
    } else {
      var parts = []
      for (var j = 0; j < item.parts.length; j++) {
        parts.push(addStyle(item.parts[j]))
      }
      stylesInDom[item.id] = { id: item.id, refs: 1, parts: parts }
    }
  }
}

function createStyleElement () {
  var styleElement = document.createElement('style')
  styleElement.type = 'text/css'
  head.appendChild(styleElement)
  return styleElement
}

function addStyle (obj /* StyleObjectPart */) {
  var update, remove
  var styleElement = document.querySelector('style[' + ssrIdKey + '~="' + obj.id + '"]')

  if (styleElement) {
    if (isProduction) {
      // has SSR styles and in production mode.
      // simply do nothing.
      return noop
    } else {
      // has SSR styles but in dev mode.
      // for some reason Chrome can't handle source map in server-rendered
      // style tags - source maps in <style> only works if the style tag is
      // created and inserted dynamically. So we remove the server rendered
      // styles and inject new ones.
      styleElement.parentNode.removeChild(styleElement)
    }
  }

  if (isOldIE) {
    // use singleton mode for IE9.
    var styleIndex = singletonCounter++
    styleElement = singletonElement || (singletonElement = createStyleElement())
    update = applyToSingletonTag.bind(null, styleElement, styleIndex, false)
    remove = applyToSingletonTag.bind(null, styleElement, styleIndex, true)
  } else {
    // use multi-style-tag mode in all other cases
    styleElement = createStyleElement()
    update = applyToTag.bind(null, styleElement)
    remove = function () {
      styleElement.parentNode.removeChild(styleElement)
    }
  }

  update(obj)

  return function updateStyle (newObj /* StyleObjectPart */) {
    if (newObj) {
      if (newObj.css === obj.css &&
          newObj.media === obj.media &&
          newObj.sourceMap === obj.sourceMap) {
        return
      }
      update(obj = newObj)
    } else {
      remove()
    }
  }
}

var replaceText = (function () {
  var textStore = []

  return function (index, replacement) {
    textStore[index] = replacement
    return textStore.filter(Boolean).join('\n')
  }
})()

function applyToSingletonTag (styleElement, index, remove, obj) {
  var css = remove ? '' : obj.css

  if (styleElement.styleSheet) {
    styleElement.styleSheet.cssText = replaceText(index, css)
  } else {
    var cssNode = document.createTextNode(css)
    var childNodes = styleElement.childNodes
    if (childNodes[index]) styleElement.removeChild(childNodes[index])
    if (childNodes.length) {
      styleElement.insertBefore(cssNode, childNodes[index])
    } else {
      styleElement.appendChild(cssNode)
    }
  }
}

function applyToTag (styleElement, obj) {
  var css = obj.css
  var media = obj.media
  var sourceMap = obj.sourceMap

  if (media) {
    styleElement.setAttribute('media', media)
  }
  if (options.ssrId) {
    styleElement.setAttribute(ssrIdKey, obj.id)
  }

  if (sourceMap) {
    // https://developer.chrome.com/devtools/docs/javascript-debugging
    // this makes source maps inside style tags work properly in Chrome
    css += '\n/*# sourceURL=' + sourceMap.sources[0] + ' */'
    // http://stackoverflow.com/a/26603875
    css += '\n/*# sourceMappingURL=data:application/json;base64,' + btoa(unescape(encodeURIComponent(JSON.stringify(sourceMap)))) + ' */'
  }

  if (styleElement.styleSheet) {
    styleElement.styleSheet.cssText = css
  } else {
    while (styleElement.firstChild) {
      styleElement.removeChild(styleElement.firstChild)
    }
    styleElement.appendChild(document.createTextNode(css))
  }
}


/***/ }),

/***/ 6:
/***/ (function(module, exports) {

/**
 * Translates the list format produced by css-loader into something
 * easier to manipulate.
 */
module.exports = function listToStyles (parentId, list) {
  var styles = []
  var newStyles = {}
  for (var i = 0; i < list.length; i++) {
    var item = list[i]
    var id = item[0]
    var css = item[1]
    var media = item[2]
    var sourceMap = item[3]
    var part = {
      id: parentId + ':' + i,
      css: css,
      media: media,
      sourceMap: sourceMap
    }
    if (!newStyles[id]) {
      styles.push(newStyles[id] = { id: id, parts: [part] })
    } else {
      newStyles[id].parts.push(part)
    }
  }
  return styles
}


/***/ })

/******/ });