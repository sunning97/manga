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
/******/ 	return __webpack_require__(__webpack_require__.s = 118);
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

/***/ 118:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(119);


/***/ }),

/***/ 119:
/***/ (function(module, exports, __webpack_require__) {


Vue.component('comment', __webpack_require__(120));
var app = new Vue({
    el: '#app',
    data: {}
});

/***/ }),

/***/ 120:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
var normalizeComponent = __webpack_require__(0)
/* script */
var __vue_script__ = __webpack_require__(121)
/* template */
var __vue_template__ = __webpack_require__(137)
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
Component.options.__file = "resources\\assets\\js\\site\\components\\manga-comments\\MangaComments.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-96a04b2e", Component.options)
  } else {
    hotAPI.reload("data-v-96a04b2e", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ 121:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__ListComment__ = __webpack_require__(122);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__ListComment___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_0__ListComment__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__Pagination__ = __webpack_require__(131);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__Pagination___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_1__Pagination__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2__WriteComment__ = __webpack_require__(134);
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
            totalComments: 0
        };
    },
    mounted: function mounted() {
        this.getComment(1);
        this.getTotalComments();
    },

    methods: {
        getComment: function getComment(page) {
            var _this = this;

            this.comments = [];
            this.pagination = {};
            axios.post('/axios/get-comment?page=' + page, {
                manga_id: this.manga.id
            }).then(function (response) {
                _this.comments = response.data.data;
                _this.pagination = response.data;
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
        }
    },
    components: {
        'list-comment': __WEBPACK_IMPORTED_MODULE_0__ListComment___default.a,
        'pagination': __WEBPACK_IMPORTED_MODULE_1__Pagination___default.a,
        'write-comment': __WEBPACK_IMPORTED_MODULE_2__WriteComment___default.a
    }
});

/***/ }),

/***/ 122:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
var normalizeComponent = __webpack_require__(0)
/* script */
var __vue_script__ = __webpack_require__(123)
/* template */
var __vue_template__ = __webpack_require__(130)
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
Component.options.__file = "resources\\assets\\js\\site\\components\\manga-comments\\ListComment.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-3dfaeb7c", Component.options)
  } else {
    hotAPI.reload("data-v-3dfaeb7c", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ 123:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__comment_ParentComment__ = __webpack_require__(124);
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
        }
    },
    mounted: function mounted() {
        $('#commnent').slimScroll({
            height: '500px'
        });
    },

    methods: {},
    components: {
        'parent-comment': __WEBPACK_IMPORTED_MODULE_0__comment_ParentComment___default.a
    }
});

/***/ }),

/***/ 124:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
var normalizeComponent = __webpack_require__(0)
/* script */
var __vue_script__ = __webpack_require__(125)
/* template */
var __vue_template__ = __webpack_require__(129)
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
Component.options.__file = "resources\\assets\\js\\site\\components\\manga-comments\\comment\\ParentComment.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-6550798e", Component.options)
  } else {
    hotAPI.reload("data-v-6550798e", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ 125:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__ChildComment__ = __webpack_require__(126);
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


/* harmony default export */ __webpack_exports__["default"] = ({
    props: {
        comment: {
            type: Object,
            default: {}
        },
        url: {
            type: String,
            default: ''
        }
    },
    data: function data() {
        return {
            comments: [],
            isReply: false
        };
    },
    mounted: function mounted() {
        this.childComments();
    },

    computed: {},
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
        }
    },
    components: {
        'child-comment': __WEBPACK_IMPORTED_MODULE_0__ChildComment___default.a
    }
});

/***/ }),

/***/ 126:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
var normalizeComponent = __webpack_require__(0)
/* script */
var __vue_script__ = __webpack_require__(127)
/* template */
var __vue_template__ = __webpack_require__(128)
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
Component.options.__file = "resources\\assets\\js\\site\\components\\manga-comments\\comment\\ChildComment.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-771ac06f", Component.options)
  } else {
    hotAPI.reload("data-v-771ac06f", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ 127:
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

/***/ 128:
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
    require("vue-hot-reload-api")      .rerender("data-v-771ac06f", module.exports)
  }
}

/***/ }),

/***/ 129:
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
        _vm.isReply ? _c("div", { staticClass: "row" }, [_vm._m(0)]) : _vm._e()
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
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "col-md-11 col-md-push-1" }, [
      _c("div", { staticClass: "post__comments-respond" }, [
        _c("form", { attrs: { action: "", method: "post" } }, [
          _c("p", { staticClass: "post__comments-respond-comment" }, [
            _c("textarea", {
              attrs: {
                id: "comment",
                name: "comment",
                cols: "30",
                "aria-required": "true"
              }
            })
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
              }
            })
          ])
        ])
      ])
    ])
  }
]
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-6550798e", module.exports)
  }
}

/***/ }),

/***/ 130:
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div", [
    _c("h5", [_vm._v(_vm._s(_vm.totalComments) + " Bình luận")]),
    _vm._v(" "),
    _c(
      "ul",
      { staticClass: "post__comments-list", attrs: { id: "commnent" } },
      [
        _vm.comments.length == 0
          ? _c("div", { staticClass: "text-center" }, [_vm._v("Đang tải...")])
          : _vm._e(),
        _vm._v(" "),
        _vm._l(_vm.comments, function(comment) {
          return _c(
            "li",
            { staticClass: "post__comments-item" },
            [
              _c("parent-comment", {
                attrs: { comment: comment, url: _vm.url }
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
    require("vue-hot-reload-api")      .rerender("data-v-3dfaeb7c", module.exports)
  }
}

/***/ }),

/***/ 131:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
var normalizeComponent = __webpack_require__(0)
/* script */
var __vue_script__ = __webpack_require__(132)
/* template */
var __vue_template__ = __webpack_require__(133)
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
Component.options.__file = "resources\\assets\\js\\site\\components\\manga-comments\\Pagination.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-6a16b7c9", Component.options)
  } else {
    hotAPI.reload("data-v-6a16b7c9", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ 132:
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

/***/ 133:
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
    require("vue-hot-reload-api")      .rerender("data-v-6a16b7c9", module.exports)
  }
}

/***/ }),

/***/ 134:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
var normalizeComponent = __webpack_require__(0)
/* script */
var __vue_script__ = __webpack_require__(135)
/* template */
var __vue_template__ = __webpack_require__(136)
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
Component.options.__file = "resources\\assets\\js\\site\\components\\manga-comments\\WriteComment.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-0c2b8e22", Component.options)
  } else {
    hotAPI.reload("data-v-0c2b8e22", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ 135:
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
        user: {
            type: Object,
            default: null
        }
    },
    mounted: function mounted() {},

    methods: {}
});

/***/ }),

/***/ 136:
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
        ? _c(
            "form",
            {
              attrs: {
                action: "http://feelman.info/html/leopold/post.html",
                method: "post"
              }
            },
            [_vm._m(0), _vm._v(" "), _vm._m(1)]
          )
        : _c("div", [_c("b", [_vm._v("Vui lòng đăng nhập để viết bình luận")])])
    ])
  ])
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("p", { staticClass: "post__comments-respond-comment" }, [
      _c("label", { attrs: { for: "comment" } }, [_vm._v("Comment")]),
      _vm._v(" "),
      _c("textarea", {
        attrs: {
          id: "comment",
          name: "comment",
          cols: "45",
          "aria-required": "true"
        }
      })
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("p", { staticClass: "post__comments-respond-submit" }, [
      _c("input", {
        attrs: {
          id: "submit",
          type: "submit",
          name: "submit",
          size: "30",
          value: "Đăng"
        }
      })
    ])
  }
]
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-0c2b8e22", module.exports)
  }
}

/***/ }),

/***/ 137:
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
          totalComments: _vm.totalComments
        }
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
      _c("write-comment", { attrs: { user: _vm.user } })
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
    require("vue-hot-reload-api")      .rerender("data-v-96a04b2e", module.exports)
  }
}

/***/ })

/******/ });