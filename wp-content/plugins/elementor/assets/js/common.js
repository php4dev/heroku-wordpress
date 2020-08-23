/*! elementor - v2.9.14 - 21-07-2020 */
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
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
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
/******/ 	__webpack_require__.p = "";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 605);
/******/ })
/************************************************************************/
/******/ ([
/* 0 */
/***/ (function(module, exports) {

function _interopRequireDefault(obj) {
  return obj && obj.__esModule ? obj : {
    "default": obj
  };
}

module.exports = _interopRequireDefault;

/***/ }),
/* 1 */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(148);

/***/ }),
/* 2 */
/***/ (function(module, exports) {

function _classCallCheck(instance, Constructor) {
  if (!(instance instanceof Constructor)) {
    throw new TypeError("Cannot call a class as a function");
  }
}

module.exports = _classCallCheck;

/***/ }),
/* 3 */
/***/ (function(module, exports, __webpack_require__) {

var _Object$defineProperty = __webpack_require__(1);

function _defineProperties(target, props) {
  for (var i = 0; i < props.length; i++) {
    var descriptor = props[i];
    descriptor.enumerable = descriptor.enumerable || false;
    descriptor.configurable = true;
    if ("value" in descriptor) descriptor.writable = true;

    _Object$defineProperty(target, descriptor.key, descriptor);
  }
}

function _createClass(Constructor, protoProps, staticProps) {
  if (protoProps) _defineProperties(Constructor.prototype, protoProps);
  if (staticProps) _defineProperties(Constructor, staticProps);
  return Constructor;
}

module.exports = _createClass;

/***/ }),
/* 4 */
/***/ (function(module, exports, __webpack_require__) {

var _Object$create = __webpack_require__(123);

var setPrototypeOf = __webpack_require__(118);

function _inherits(subClass, superClass) {
  if (typeof superClass !== "function" && superClass !== null) {
    throw new TypeError("Super expression must either be null or a function");
  }

  subClass.prototype = _Object$create(superClass && superClass.prototype, {
    constructor: {
      value: subClass,
      writable: true,
      configurable: true
    }
  });
  if (superClass) setPrototypeOf(subClass, superClass);
}

module.exports = _inherits;

/***/ }),
/* 5 */
/***/ (function(module, exports, __webpack_require__) {

var _Reflect$construct = __webpack_require__(93);

var getPrototypeOf = __webpack_require__(14);

var isNativeReflectConstruct = __webpack_require__(131);

var possibleConstructorReturn = __webpack_require__(163);

function _createSuper(Derived) {
  var hasNativeReflectConstruct = isNativeReflectConstruct();
  return function _createSuperInternal() {
    var Super = getPrototypeOf(Derived),
        result;

    if (hasNativeReflectConstruct) {
      var NewTarget = getPrototypeOf(this).constructor;
      result = _Reflect$construct(Super, arguments, NewTarget);
    } else {
      result = Super.apply(this, arguments);
    }

    return possibleConstructorReturn(this, result);
  };
}

module.exports = _createSuper;

/***/ }),
/* 6 */
/***/ (function(module, exports) {

var core = module.exports = { version: '2.6.11' };
if (typeof __e == 'number') __e = core; // eslint-disable-line no-undef


/***/ }),
/* 7 */
/***/ (function(module, exports, __webpack_require__) {

var global = __webpack_require__(8);
var core = __webpack_require__(6);
var ctx = __webpack_require__(30);
var hide = __webpack_require__(24);
var has = __webpack_require__(19);
var PROTOTYPE = 'prototype';

var $export = function (type, name, source) {
  var IS_FORCED = type & $export.F;
  var IS_GLOBAL = type & $export.G;
  var IS_STATIC = type & $export.S;
  var IS_PROTO = type & $export.P;
  var IS_BIND = type & $export.B;
  var IS_WRAP = type & $export.W;
  var exports = IS_GLOBAL ? core : core[name] || (core[name] = {});
  var expProto = exports[PROTOTYPE];
  var target = IS_GLOBAL ? global : IS_STATIC ? global[name] : (global[name] || {})[PROTOTYPE];
  var key, own, out;
  if (IS_GLOBAL) source = name;
  for (key in source) {
    // contains in native
    own = !IS_FORCED && target && target[key] !== undefined;
    if (own && has(exports, key)) continue;
    // export native or passed
    out = own ? target[key] : source[key];
    // prevent global pollution for namespaces
    exports[key] = IS_GLOBAL && typeof target[key] != 'function' ? source[key]
    // bind timers to global for call from export context
    : IS_BIND && own ? ctx(out, global)
    // wrap global constructors for prevent change them in library
    : IS_WRAP && target[key] == out ? (function (C) {
      var F = function (a, b, c) {
        if (this instanceof C) {
          switch (arguments.length) {
            case 0: return new C();
            case 1: return new C(a);
            case 2: return new C(a, b);
          } return new C(a, b, c);
        } return C.apply(this, arguments);
      };
      F[PROTOTYPE] = C[PROTOTYPE];
      return F;
    // make static versions for prototype methods
    })(out) : IS_PROTO && typeof out == 'function' ? ctx(Function.call, out) : out;
    // export proto methods to core.%CONSTRUCTOR%.methods.%NAME%
    if (IS_PROTO) {
      (exports.virtual || (exports.virtual = {}))[key] = out;
      // export proto methods to core.%CONSTRUCTOR%.prototype.%NAME%
      if (type & $export.R && expProto && !expProto[key]) hide(expProto, key, out);
    }
  }
};
// type bitmap
$export.F = 1;   // forced
$export.G = 2;   // global
$export.S = 4;   // static
$export.P = 8;   // proto
$export.B = 16;  // bind
$export.W = 32;  // wrap
$export.U = 64;  // safe
$export.R = 128; // real proto method for `library`
module.exports = $export;


/***/ }),
/* 8 */
/***/ (function(module, exports) {

// https://github.com/zloirock/core-js/issues/86#issuecomment-115759028
var global = module.exports = typeof window != 'undefined' && window.Math == Math
  ? window : typeof self != 'undefined' && self.Math == Math ? self
  // eslint-disable-next-line no-new-func
  : Function('return this')();
if (typeof __g == 'number') __g = global; // eslint-disable-line no-undef


/***/ }),
/* 9 */
/***/ (function(module, exports) {

module.exports = function (it) {
  return typeof it === 'object' ? it !== null : typeof it === 'function';
};


/***/ }),
/* 10 */
/***/ (function(module, exports, __webpack_require__) {

var store = __webpack_require__(71)('wks');
var uid = __webpack_require__(51);
var Symbol = __webpack_require__(8).Symbol;
var USE_SYMBOL = typeof Symbol == 'function';

var $exports = module.exports = function (name) {
  return store[name] || (store[name] =
    USE_SYMBOL && Symbol[name] || (USE_SYMBOL ? Symbol : uid)('Symbol.' + name));
};

$exports.store = store;


/***/ }),
/* 11 */
/***/ (function(module, exports, __webpack_require__) {

var store = __webpack_require__(63)('wks');
var uid = __webpack_require__(64);
var Symbol = __webpack_require__(15).Symbol;
var USE_SYMBOL = typeof Symbol == 'function';

var $exports = module.exports = function (name) {
  return store[name] || (store[name] =
    USE_SYMBOL && Symbol[name] || (USE_SYMBOL ? Symbol : uid)('Symbol.' + name));
};

$exports.store = store;


/***/ }),
/* 12 */
/***/ (function(module, exports, __webpack_require__) {

var isObject = __webpack_require__(9);
module.exports = function (it) {
  if (!isObject(it)) throw TypeError(it + ' is not an object!');
  return it;
};


/***/ }),
/* 13 */
/***/ (function(module, exports, __webpack_require__) {

// Thank's IE8 for his funny defineProperty
module.exports = !__webpack_require__(20)(function () {
  return Object.defineProperty({}, 'a', { get: function () { return 7; } }).a != 7;
});


/***/ }),
/* 14 */
/***/ (function(module, exports, __webpack_require__) {

var _Object$getPrototypeOf = __webpack_require__(150);

var _Object$setPrototypeOf = __webpack_require__(112);

function _getPrototypeOf(o) {
  module.exports = _getPrototypeOf = _Object$setPrototypeOf ? _Object$getPrototypeOf : function _getPrototypeOf(o) {
    return o.__proto__ || _Object$getPrototypeOf(o);
  };
  return _getPrototypeOf(o);
}

module.exports = _getPrototypeOf;

/***/ }),
/* 15 */
/***/ (function(module, exports) {

// https://github.com/zloirock/core-js/issues/86#issuecomment-115759028
var global = module.exports = typeof window != 'undefined' && window.Math == Math
  ? window : typeof self != 'undefined' && self.Math == Math ? self
  // eslint-disable-next-line no-new-func
  : Function('return this')();
if (typeof __g == 'number') __g = global; // eslint-disable-line no-undef


/***/ }),
/* 16 */
/***/ (function(module, exports, __webpack_require__) {

var anObject = __webpack_require__(12);
var IE8_DOM_DEFINE = __webpack_require__(111);
var toPrimitive = __webpack_require__(69);
var dP = Object.defineProperty;

exports.f = __webpack_require__(13) ? Object.defineProperty : function defineProperty(O, P, Attributes) {
  anObject(O);
  P = toPrimitive(P, true);
  anObject(Attributes);
  if (IE8_DOM_DEFINE) try {
    return dP(O, P, Attributes);
  } catch (e) { /* empty */ }
  if ('get' in Attributes || 'set' in Attributes) throw TypeError('Accessors not supported!');
  if ('value' in Attributes) O[P] = Attributes.value;
  return O;
};


/***/ }),
/* 17 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";

// 22.1.3.8 Array.prototype.find(predicate, thisArg = undefined)
var $export = __webpack_require__(32);
var $find = __webpack_require__(119)(5);
var KEY = 'find';
var forced = true;
// Shouldn't skip holes
if (KEY in []) Array(1)[KEY](function () { forced = false; });
$export($export.P + $export.F * forced, 'Array', {
  find: function find(callbackfn /* , that = undefined */) {
    return $find(this, callbackfn, arguments.length > 1 ? arguments[1] : undefined);
  }
});
__webpack_require__(78)(KEY);


/***/ }),
/* 18 */
/***/ (function(module, exports, __webpack_require__) {

var isObject = __webpack_require__(26);
module.exports = function (it) {
  if (!isObject(it)) throw TypeError(it + ' is not an object!');
  return it;
};


/***/ }),
/* 19 */
/***/ (function(module, exports) {

var hasOwnProperty = {}.hasOwnProperty;
module.exports = function (it, key) {
  return hasOwnProperty.call(it, key);
};


/***/ }),
/* 20 */
/***/ (function(module, exports) {

module.exports = function (exec) {
  try {
    return !!exec();
  } catch (e) {
    return true;
  }
};


/***/ }),
/* 21 */
/***/ (function(module, exports, __webpack_require__) {

// to indexed object, toObject with fallback for non-array-like ES3 strings
var IObject = __webpack_require__(104);
var defined = __webpack_require__(56);
module.exports = function (it) {
  return IObject(defined(it));
};


/***/ }),
/* 22 */
/***/ (function(module, exports, __webpack_require__) {

var _Object$getOwnPropertyDescriptor = __webpack_require__(137);

var _Reflect$get = __webpack_require__(195);

var superPropBase = __webpack_require__(198);

function _get(target, property, receiver) {
  if (typeof Reflect !== "undefined" && _Reflect$get) {
    module.exports = _get = _Reflect$get;
  } else {
    module.exports = _get = function _get(target, property, receiver) {
      var base = superPropBase(target, property);
      if (!base) return;

      var desc = _Object$getOwnPropertyDescriptor(base, property);

      if (desc.get) {
        return desc.get.call(receiver);
      }

      return desc.value;
    };
  }

  return _get(target, property, receiver || target);
}

module.exports = _get;

/***/ }),
/* 23 */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(199);

/***/ }),
/* 24 */
/***/ (function(module, exports, __webpack_require__) {

var dP = __webpack_require__(16);
var createDesc = __webpack_require__(43);
module.exports = __webpack_require__(13) ? function (object, key, value) {
  return dP.f(object, key, createDesc(1, value));
} : function (object, key, value) {
  object[key] = value;
  return object;
};


/***/ }),
/* 25 */
/***/ (function(module, exports, __webpack_require__) {

// Thank's IE8 for his funny defineProperty
module.exports = !__webpack_require__(28)(function () {
  return Object.defineProperty({}, 'a', { get: function () { return 7; } }).a != 7;
});


/***/ }),
/* 26 */
/***/ (function(module, exports) {

module.exports = function (it) {
  return typeof it === 'object' ? it !== null : typeof it === 'function';
};


/***/ }),
/* 27 */
/***/ (function(module, exports, __webpack_require__) {

var dP = __webpack_require__(44);
var createDesc = __webpack_require__(91);
module.exports = __webpack_require__(25) ? function (object, key, value) {
  return dP.f(object, key, createDesc(1, value));
} : function (object, key, value) {
  object[key] = value;
  return object;
};


/***/ }),
/* 28 */
/***/ (function(module, exports) {

module.exports = function (exec) {
  try {
    return !!exec();
  } catch (e) {
    return true;
  }
};


/***/ }),
/* 29 */,
/* 30 */
/***/ (function(module, exports, __webpack_require__) {

// optional / simple context binding
var aFunction = __webpack_require__(42);
module.exports = function (fn, that, length) {
  aFunction(fn);
  if (that === undefined) return fn;
  switch (length) {
    case 1: return function (a) {
      return fn.call(that, a);
    };
    case 2: return function (a, b) {
      return fn.call(that, a, b);
    };
    case 3: return function (a, b, c) {
      return fn.call(that, a, b, c);
    };
  }
  return function (/* ...args */) {
    return fn.apply(that, arguments);
  };
};


/***/ }),
/* 31 */
/***/ (function(module, exports, __webpack_require__) {

// 7.1.13 ToObject(argument)
var defined = __webpack_require__(56);
module.exports = function (it) {
  return Object(defined(it));
};


/***/ }),
/* 32 */
/***/ (function(module, exports, __webpack_require__) {

var global = __webpack_require__(15);
var core = __webpack_require__(45);
var hide = __webpack_require__(27);
var redefine = __webpack_require__(33);
var ctx = __webpack_require__(58);
var PROTOTYPE = 'prototype';

var $export = function (type, name, source) {
  var IS_FORCED = type & $export.F;
  var IS_GLOBAL = type & $export.G;
  var IS_STATIC = type & $export.S;
  var IS_PROTO = type & $export.P;
  var IS_BIND = type & $export.B;
  var target = IS_GLOBAL ? global : IS_STATIC ? global[name] || (global[name] = {}) : (global[name] || {})[PROTOTYPE];
  var exports = IS_GLOBAL ? core : core[name] || (core[name] = {});
  var expProto = exports[PROTOTYPE] || (exports[PROTOTYPE] = {});
  var key, own, out, exp;
  if (IS_GLOBAL) source = name;
  for (key in source) {
    // contains in native
    own = !IS_FORCED && target && target[key] !== undefined;
    // export native or passed
    out = (own ? target : source)[key];
    // bind timers to global for call from export context
    exp = IS_BIND && own ? ctx(out, global) : IS_PROTO && typeof out == 'function' ? ctx(Function.call, out) : out;
    // extend global
    if (target) redefine(target, key, out, type & $export.U);
    // export
    if (exports[key] != out) hide(exports, key, exp);
    if (IS_PROTO && expProto[key] != out) expProto[key] = out;
  }
};
global.core = core;
// type bitmap
$export.F = 1;   // forced
$export.G = 2;   // global
$export.S = 4;   // static
$export.P = 8;   // proto
$export.B = 16;  // bind
$export.W = 32;  // wrap
$export.U = 64;  // safe
$export.R = 128; // real proto method for `library`
module.exports = $export;


/***/ }),
/* 33 */
/***/ (function(module, exports, __webpack_require__) {

var global = __webpack_require__(15);
var hide = __webpack_require__(27);
var has = __webpack_require__(54);
var SRC = __webpack_require__(64)('src');
var $toString = __webpack_require__(126);
var TO_STRING = 'toString';
var TPL = ('' + $toString).split(TO_STRING);

__webpack_require__(45).inspectSource = function (it) {
  return $toString.call(it);
};

(module.exports = function (O, key, val, safe) {
  var isFunction = typeof val == 'function';
  if (isFunction) has(val, 'name') || hide(val, 'name', key);
  if (O[key] === val) return;
  if (isFunction) has(val, SRC) || hide(val, SRC, O[key] ? '' + O[key] : TPL.join(String(key)));
  if (O === global) {
    O[key] = val;
  } else if (!safe) {
    delete O[key];
    hide(O, key, val);
  } else if (O[key]) {
    O[key] = val;
  } else {
    hide(O, key, val);
  }
// add fake Function#toString for correct work wrapped methods / constructors with methods like LoDash isNative
})(Function.prototype, TO_STRING, function toString() {
  return typeof this == 'function' && this[SRC] || $toString.call(this);
});


/***/ }),
/* 34 */
/***/ (function(module, exports) {

module.exports = {};


/***/ }),
/* 35 */
/***/ (function(module, exports, __webpack_require__) {

var _Object$defineProperty = __webpack_require__(1);

function _defineProperty(obj, key, value) {
  if (key in obj) {
    _Object$defineProperty(obj, key, {
      value: value,
      enumerable: true,
      configurable: true,
      writable: true
    });
  } else {
    obj[key] = value;
  }

  return obj;
}

module.exports = _defineProperty;

/***/ }),
/* 36 */
/***/ (function(module, exports) {

// 7.2.1 RequireObjectCoercible(argument)
module.exports = function (it) {
  if (it == undefined) throw TypeError("Can't call method on  " + it);
  return it;
};


/***/ }),
/* 37 */
/***/ (function(module, exports) {

var toString = {}.toString;

module.exports = function (it) {
  return toString.call(it).slice(8, -1);
};


/***/ }),
/* 38 */
/***/ (function(module, exports, __webpack_require__) {

// 19.1.2.14 / 15.2.3.14 Object.keys(O)
var $keys = __webpack_require__(113);
var enumBugKeys = __webpack_require__(73);

module.exports = Object.keys || function keys(O) {
  return $keys(O, enumBugKeys);
};


/***/ }),
/* 39 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var _interopRequireDefault = __webpack_require__(0);

var _Object$defineProperty = __webpack_require__(1);

_Object$defineProperty(exports, "__esModule", {
  value: true
});

exports.default = void 0;

var _typeof2 = _interopRequireDefault(__webpack_require__(40));

var _classCallCheck2 = _interopRequireDefault(__webpack_require__(2));

var _createClass2 = _interopRequireDefault(__webpack_require__(3));

var _assertThisInitialized2 = _interopRequireDefault(__webpack_require__(49));

var _inherits2 = _interopRequireDefault(__webpack_require__(4));

var _createSuper2 = _interopRequireDefault(__webpack_require__(5));

var _defineProperty2 = _interopRequireDefault(__webpack_require__(35));

var _argsObject = _interopRequireDefault(__webpack_require__(210));

var CommandBase = /*#__PURE__*/function (_ArgsObject) {
  (0, _inherits2.default)(CommandBase, _ArgsObject);

  var _super = (0, _createSuper2.default)(CommandBase);

  /**
   * Current component.
   *
   * @type {Component}
   */

  /**
   * Function constructor().
   *
   * Create Commands Base.
   *
   * @param [args={}]
   * @param [commandsAPI={}]
   */
  function CommandBase(args) {
    var _this;

    var commandsAPI = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : $e.commands;
    (0, _classCallCheck2.default)(this, CommandBase);
    _this = _super.call(this, args); // Acknowledge self about which command it run.

    (0, _defineProperty2.default)((0, _assertThisInitialized2.default)(_this), "component", void 0);
    _this.currentCommand = commandsAPI.getCurrentLast(); // Assign instance of current component.

    _this.component = commandsAPI.getComponent(_this.currentCommand); // Who ever need do something before without `super` the constructor can use `initialize` method.

    _this.initialize(args); // Refresh args, maybe the changed via `initialize`.


    args = _this.args; // Validate args before run.

    _this.validateArgs(args);

    return _this;
  }
  /**
   * Function requireContainer().
   *
   * Validate `arg.container` & `arg.containers`.
   *
   * @param {{}} args
   *
   * @throws {Error}
   */


  (0, _createClass2.default)(CommandBase, [{
    key: "requireContainer",
    value: function requireContainer() {
      var _this2 = this;

      var args = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : this.args;

      if (!args.container && !args.containers) {
        throw Error('container or containers are required.');
      }

      if (args.container && args.containers) {
        throw Error('container and containers cannot go together please select one of them.');
      }

      var containers = args.containers || [args.container];
      containers.forEach(function (container) {
        _this2.requireArgumentInstance('container', elementorModules.editor.Container, {
          container: container
        });
      });
    }
    /**
     * Function initialize().
     *
     * Initialize command, called after construction.
     *
     * @param [args={}]
     */

  }, {
    key: "initialize",
    value: function initialize() {
      var args = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : {};
    } // eslint-disable-line no-unused-vars

    /**
     * Function validateArgs().
     *
     * Validate command arguments.
     *
     * @param [args={}]
     */

  }, {
    key: "validateArgs",
    value: function validateArgs() {
      var args = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : {};
    } // eslint-disable-line no-unused-vars

    /**
     * Function isDataChanged().
     *
     * Whether the editor needs to set change flag on/off.
     *
     * @returns {boolean}
     */

  }, {
    key: "isDataChanged",
    value: function isDataChanged() {
      return false;
    }
    /**
     * Function apply().
     *
     * Do the actual command.
     *
     * @param [args={}]
     *
     * @returns {*}
     */

  }, {
    key: "apply",
    value: function apply() {
      var args = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : {};
      // eslint-disable-line no-unused-vars
      elementorModules.ForceMethodImplementation();
    }
    /**
     * Function run().
     *
     * Run command with history & hooks.
     *
     * @returns {*}
     */

  }, {
    key: "run",
    value: function run() {
      var _this3 = this;

      var result; // For UI Hooks.

      this.onBeforeRun(this.args);

      try {
        // For Data hooks.
        this.onBeforeApply(this.args);
        result = this.apply(this.args);
      } catch (e) {
        this.onCatchApply(e); // Catch 'Hook-Break' that comes from hooks base.

        if (e instanceof $e.modules.HookBreak) {
          // Bypass.
          return false;
        }
      }

      var onAfter = function onAfter(_result) {
        _this3.onAfterApply(_this3.args, _result);

        if (_this3.isDataChanged()) {
          $e.internal('document/save/set-is-modified', {
            status: true
          });
        } // For UI hooks.


        _this3.onAfterRun(_this3.args, _result);
      }; // TODO: Temp code determine if it's a jQuery deferred object.


      if (result && 'object' === (0, _typeof2.default)(result) && result.promise && result.then && result.fail) {
        result.fail(this.onCatchApply.bind(this));
        result.done(onAfter);
      } else {
        onAfter(result);
      }

      return result;
    }
    /**
     * Function onBeforeRun.
     *
     * Called before run().
     *
     * @param [args={}]
     */

  }, {
    key: "onBeforeRun",
    value: function onBeforeRun() {
      var args = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : {};
      $e.hooks.runUIBefore(this.currentCommand, args);
    }
    /**
     * Function onAfterRun.
     *
     * Called after run().
     *
     * @param [args={}]
     * @param [result={*}]
     */

  }, {
    key: "onAfterRun",
    value: function onAfterRun() {
      var args = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : {};
      var result = arguments.length > 1 ? arguments[1] : undefined;
      $e.hooks.runUIAfter(this.currentCommand, args, result);
    }
    /**
     * Function onBeforeApply.
     *
     * Called before apply().
     *
     * @param [args={}]
     */

  }, {
    key: "onBeforeApply",
    value: function onBeforeApply() {
      var args = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : {};
      $e.hooks.runDataDependency(this.currentCommand, args);
    }
    /**
     * Function onAfterApply.
     *
     * Called after apply().
     *
     * @param [args={}]
     * @param [result={*}]
     */

  }, {
    key: "onAfterApply",
    value: function onAfterApply() {
      var args = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : {};
      var result = arguments.length > 1 ? arguments[1] : undefined;
      $e.hooks.runDataAfter(this.currentCommand, args, result);
    }
    /**
     * Function onCatchApply.
     *
     * Called after apply() failed.
     *
     * @param {Error} e
     */

  }, {
    key: "onCatchApply",
    value: function onCatchApply(e) {
      $e.hooks.runDataCatch(this.currentCommand, this.args, e);
      elementorCommon.helpers.consoleError(e);
      $e.hooks.runUICatch(this.currentCommand, this.args, e);
    }
  }]);
  return CommandBase;
}(_argsObject.default);

exports.default = CommandBase;

/***/ }),
/* 40 */
/***/ (function(module, exports, __webpack_require__) {

var _Symbol$iterator = __webpack_require__(138);

var _Symbol = __webpack_require__(105);

function _typeof(obj) {
  "@babel/helpers - typeof";

  if (typeof _Symbol === "function" && typeof _Symbol$iterator === "symbol") {
    module.exports = _typeof = function _typeof(obj) {
      return typeof obj;
    };
  } else {
    module.exports = _typeof = function _typeof(obj) {
      return obj && typeof _Symbol === "function" && obj.constructor === _Symbol && obj !== _Symbol.prototype ? "symbol" : typeof obj;
    };
  }

  return _typeof(obj);
}

module.exports = _typeof;

/***/ }),
/* 41 */
/***/ (function(module, exports, __webpack_require__) {

// 7.1.15 ToLength
var toInteger = __webpack_require__(50);
var min = Math.min;
module.exports = function (it) {
  return it > 0 ? min(toInteger(it), 0x1fffffffffffff) : 0; // pow(2, 53) - 1 == 9007199254740991
};


/***/ }),
/* 42 */
/***/ (function(module, exports) {

module.exports = function (it) {
  if (typeof it != 'function') throw TypeError(it + ' is not a function!');
  return it;
};


/***/ }),
/* 43 */
/***/ (function(module, exports) {

module.exports = function (bitmap, value) {
  return {
    enumerable: !(bitmap & 1),
    configurable: !(bitmap & 2),
    writable: !(bitmap & 4),
    value: value
  };
};


/***/ }),
/* 44 */
/***/ (function(module, exports, __webpack_require__) {

var anObject = __webpack_require__(18);
var IE8_DOM_DEFINE = __webpack_require__(116);
var toPrimitive = __webpack_require__(108);
var dP = Object.defineProperty;

exports.f = __webpack_require__(25) ? Object.defineProperty : function defineProperty(O, P, Attributes) {
  anObject(O);
  P = toPrimitive(P, true);
  anObject(Attributes);
  if (IE8_DOM_DEFINE) try {
    return dP(O, P, Attributes);
  } catch (e) { /* empty */ }
  if ('get' in Attributes || 'set' in Attributes) throw TypeError('Accessors not supported!');
  if ('value' in Attributes) O[P] = Attributes.value;
  return O;
};


/***/ }),
/* 45 */
/***/ (function(module, exports) {

var core = module.exports = { version: '2.6.11' };
if (typeof __e == 'number') __e = core; // eslint-disable-line no-undef


/***/ }),
/* 46 */
/***/ (function(module, exports) {

module.exports = true;


/***/ }),
/* 47 */
/***/ (function(module, exports, __webpack_require__) {

// 19.1.2.2 / 15.2.3.5 Object.create(O [, Properties])
var anObject = __webpack_require__(12);
var dPs = __webpack_require__(128);
var enumBugKeys = __webpack_require__(73);
var IE_PROTO = __webpack_require__(70)('IE_PROTO');
var Empty = function () { /* empty */ };
var PROTOTYPE = 'prototype';

// Create object with fake `null` prototype: use iframe Object with cleared prototype
var createDict = function () {
  // Thrash, waste and sodomy: IE GC bug
  var iframe = __webpack_require__(92)('iframe');
  var i = enumBugKeys.length;
  var lt = '<';
  var gt = '>';
  var iframeDocument;
  iframe.style.display = 'none';
  __webpack_require__(129).appendChild(iframe);
  iframe.src = 'javascript:'; // eslint-disable-line no-script-url
  // createDict = iframe.contentWindow.Object;
  // html.removeChild(iframe);
  iframeDocument = iframe.contentWindow.document;
  iframeDocument.open();
  iframeDocument.write(lt + 'script' + gt + 'document.F=Object' + lt + '/script' + gt);
  iframeDocument.close();
  createDict = iframeDocument.F;
  while (i--) delete createDict[PROTOTYPE][enumBugKeys[i]];
  return createDict();
};

module.exports = Object.create || function create(O, Properties) {
  var result;
  if (O !== null) {
    Empty[PROTOTYPE] = anObject(O);
    result = new Empty();
    Empty[PROTOTYPE] = null;
    // add "__proto__" for Object.getPrototypeOf polyfill
    result[IE_PROTO] = O;
  } else result = createDict();
  return Properties === undefined ? result : dPs(result, Properties);
};


/***/ }),
/* 48 */
/***/ (function(module, exports) {

exports.f = {}.propertyIsEnumerable;


/***/ }),
/* 49 */
/***/ (function(module, exports) {

function _assertThisInitialized(self) {
  if (self === void 0) {
    throw new ReferenceError("this hasn't been initialised - super() hasn't been called");
  }

  return self;
}

module.exports = _assertThisInitialized;

/***/ }),
/* 50 */
/***/ (function(module, exports) {

// 7.1.4 ToInteger
var ceil = Math.ceil;
var floor = Math.floor;
module.exports = function (it) {
  return isNaN(it = +it) ? 0 : (it > 0 ? floor : ceil)(it);
};


/***/ }),
/* 51 */
/***/ (function(module, exports) {

var id = 0;
var px = Math.random();
module.exports = function (key) {
  return 'Symbol('.concat(key === undefined ? '' : key, ')_', (++id + px).toString(36));
};


/***/ }),
/* 52 */
/***/ (function(module, exports, __webpack_require__) {

var def = __webpack_require__(16).f;
var has = __webpack_require__(19);
var TAG = __webpack_require__(10)('toStringTag');

module.exports = function (it, tag, stat) {
  if (it && !has(it = stat ? it : it.prototype, TAG)) def(it, TAG, { configurable: true, value: tag });
};


/***/ }),
/* 53 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var anObject = __webpack_require__(18);
var toObject = __webpack_require__(81);
var toLength = __webpack_require__(41);
var toInteger = __webpack_require__(50);
var advanceStringIndex = __webpack_require__(109);
var regExpExec = __webpack_require__(89);
var max = Math.max;
var min = Math.min;
var floor = Math.floor;
var SUBSTITUTION_SYMBOLS = /\$([$&`']|\d\d?|<[^>]*>)/g;
var SUBSTITUTION_SYMBOLS_NO_NAMED = /\$([$&`']|\d\d?)/g;

var maybeToString = function (it) {
  return it === undefined ? it : String(it);
};

// @@replace logic
__webpack_require__(90)('replace', 2, function (defined, REPLACE, $replace, maybeCallNative) {
  return [
    // `String.prototype.replace` method
    // https://tc39.github.io/ecma262/#sec-string.prototype.replace
    function replace(searchValue, replaceValue) {
      var O = defined(this);
      var fn = searchValue == undefined ? undefined : searchValue[REPLACE];
      return fn !== undefined
        ? fn.call(searchValue, O, replaceValue)
        : $replace.call(String(O), searchValue, replaceValue);
    },
    // `RegExp.prototype[@@replace]` method
    // https://tc39.github.io/ecma262/#sec-regexp.prototype-@@replace
    function (regexp, replaceValue) {
      var res = maybeCallNative($replace, regexp, this, replaceValue);
      if (res.done) return res.value;

      var rx = anObject(regexp);
      var S = String(this);
      var functionalReplace = typeof replaceValue === 'function';
      if (!functionalReplace) replaceValue = String(replaceValue);
      var global = rx.global;
      if (global) {
        var fullUnicode = rx.unicode;
        rx.lastIndex = 0;
      }
      var results = [];
      while (true) {
        var result = regExpExec(rx, S);
        if (result === null) break;
        results.push(result);
        if (!global) break;
        var matchStr = String(result[0]);
        if (matchStr === '') rx.lastIndex = advanceStringIndex(S, toLength(rx.lastIndex), fullUnicode);
      }
      var accumulatedResult = '';
      var nextSourcePosition = 0;
      for (var i = 0; i < results.length; i++) {
        result = results[i];
        var matched = String(result[0]);
        var position = max(min(toInteger(result.index), S.length), 0);
        var captures = [];
        // NOTE: This is equivalent to
        //   captures = result.slice(1).map(maybeToString)
        // but for some reason `nativeSlice.call(result, 1, result.length)` (called in
        // the slice polyfill when slicing native arrays) "doesn't work" in safari 9 and
        // causes a crash (https://pastebin.com/N21QzeQA) when trying to debug it.
        for (var j = 1; j < result.length; j++) captures.push(maybeToString(result[j]));
        var namedCaptures = result.groups;
        if (functionalReplace) {
          var replacerArgs = [matched].concat(captures, position, S);
          if (namedCaptures !== undefined) replacerArgs.push(namedCaptures);
          var replacement = String(replaceValue.apply(undefined, replacerArgs));
        } else {
          replacement = getSubstitution(matched, S, position, captures, namedCaptures, replaceValue);
        }
        if (position >= nextSourcePosition) {
          accumulatedResult += S.slice(nextSourcePosition, position) + replacement;
          nextSourcePosition = position + matched.length;
        }
      }
      return accumulatedResult + S.slice(nextSourcePosition);
    }
  ];

    // https://tc39.github.io/ecma262/#sec-getsubstitution
  function getSubstitution(matched, str, position, captures, namedCaptures, replacement) {
    var tailPos = position + matched.length;
    var m = captures.length;
    var symbols = SUBSTITUTION_SYMBOLS_NO_NAMED;
    if (namedCaptures !== undefined) {
      namedCaptures = toObject(namedCaptures);
      symbols = SUBSTITUTION_SYMBOLS;
    }
    return $replace.call(replacement, symbols, function (match, ch) {
      var capture;
      switch (ch.charAt(0)) {
        case '$': return '$';
        case '&': return matched;
        case '`': return str.slice(0, position);
        case "'": return str.slice(tailPos);
        case '<':
          capture = namedCaptures[ch.slice(1, -1)];
          break;
        default: // \d\d?
          var n = +ch;
          if (n === 0) return match;
          if (n > m) {
            var f = floor(n / 10);
            if (f === 0) return match;
            if (f <= m) return captures[f - 1] === undefined ? ch.charAt(1) : captures[f - 1] + ch.charAt(1);
            return match;
          }
          capture = captures[n - 1];
      }
      return capture === undefined ? '' : capture;
    });
  }
});


/***/ }),
/* 54 */
/***/ (function(module, exports) {

var hasOwnProperty = {}.hasOwnProperty;
module.exports = function (it, key) {
  return hasOwnProperty.call(it, key);
};


/***/ }),
/* 55 */
/***/ (function(module, exports, __webpack_require__) {

var pIE = __webpack_require__(48);
var createDesc = __webpack_require__(43);
var toIObject = __webpack_require__(21);
var toPrimitive = __webpack_require__(69);
var has = __webpack_require__(19);
var IE8_DOM_DEFINE = __webpack_require__(111);
var gOPD = Object.getOwnPropertyDescriptor;

exports.f = __webpack_require__(13) ? gOPD : function getOwnPropertyDescriptor(O, P) {
  O = toIObject(O);
  P = toPrimitive(P, true);
  if (IE8_DOM_DEFINE) try {
    return gOPD(O, P);
  } catch (e) { /* empty */ }
  if (has(O, P)) return createDesc(!pIE.f.call(O, P), O[P]);
};


/***/ }),
/* 56 */
/***/ (function(module, exports) {

// 7.2.1 RequireObjectCoercible(argument)
module.exports = function (it) {
  if (it == undefined) throw TypeError("Can't call method on  " + it);
  return it;
};


/***/ }),
/* 57 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";

var $at = __webpack_require__(165)(true);

// 21.1.3.27 String.prototype[@@iterator]()
__webpack_require__(94)(String, 'String', function (iterated) {
  this._t = String(iterated); // target
  this._i = 0;                // next index
// 21.1.5.2.1 %StringIteratorPrototype%.next()
}, function () {
  var O = this._t;
  var index = this._i;
  var point;
  if (index >= O.length) return { value: undefined, done: true };
  point = $at(O, index);
  this._i += point.length;
  return { value: point, done: false };
});


/***/ }),
/* 58 */
/***/ (function(module, exports, __webpack_require__) {

// optional / simple context binding
var aFunction = __webpack_require__(79);
module.exports = function (fn, that, length) {
  aFunction(fn);
  if (that === undefined) return fn;
  switch (length) {
    case 1: return function (a) {
      return fn.call(that, a);
    };
    case 2: return function (a, b) {
      return fn.call(that, a, b);
    };
    case 3: return function (a, b, c) {
      return fn.call(that, a, b, c);
    };
  }
  return function (/* ...args */) {
    return fn.apply(that, arguments);
  };
};


/***/ }),
/* 59 */
/***/ (function(module, exports) {

var toString = {}.toString;

module.exports = function (it) {
  return toString.call(it).slice(8, -1);
};


/***/ }),
/* 60 */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(167);
var global = __webpack_require__(8);
var hide = __webpack_require__(24);
var Iterators = __webpack_require__(34);
var TO_STRING_TAG = __webpack_require__(10)('toStringTag');

var DOMIterables = ('CSSRuleList,CSSStyleDeclaration,CSSValueList,ClientRectList,DOMRectList,DOMStringList,' +
  'DOMTokenList,DataTransferItemList,FileList,HTMLAllCollection,HTMLCollection,HTMLFormElement,HTMLSelectElement,' +
  'MediaList,MimeTypeArray,NamedNodeMap,NodeList,PaintRequestList,Plugin,PluginArray,SVGLengthList,SVGNumberList,' +
  'SVGPathSegList,SVGPointList,SVGStringList,SVGTransformList,SourceBufferList,StyleSheetList,TextTrackCueList,' +
  'TextTrackList,TouchList').split(',');

for (var i = 0; i < DOMIterables.length; i++) {
  var NAME = DOMIterables[i];
  var Collection = global[NAME];
  var proto = Collection && Collection.prototype;
  if (proto && !proto[TO_STRING_TAG]) hide(proto, TO_STRING_TAG, NAME);
  Iterators[NAME] = Iterators.Array;
}


/***/ }),
/* 61 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var _interopRequireDefault = __webpack_require__(0);

var _Object$defineProperty = __webpack_require__(1);

_Object$defineProperty(exports, "__esModule", {
  value: true
});

exports.default = void 0;

__webpack_require__(53);

var _keys = _interopRequireDefault(__webpack_require__(23));

__webpack_require__(68);

var _slicedToArray2 = _interopRequireDefault(__webpack_require__(85));

var _entries = _interopRequireDefault(__webpack_require__(66));

var _classCallCheck2 = _interopRequireDefault(__webpack_require__(2));

var _createClass2 = _interopRequireDefault(__webpack_require__(3));

var _inherits2 = _interopRequireDefault(__webpack_require__(4));

var _createSuper2 = _interopRequireDefault(__webpack_require__(5));

var ComponentBase = /*#__PURE__*/function (_elementorModules$Mod) {
  (0, _inherits2.default)(ComponentBase, _elementorModules$Mod);

  var _super = (0, _createSuper2.default)(ComponentBase);

  function ComponentBase() {
    (0, _classCallCheck2.default)(this, ComponentBase);
    return _super.apply(this, arguments);
  }

  (0, _createClass2.default)(ComponentBase, [{
    key: "__construct",
    value: function __construct() {
      var args = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : {};

      if (args.manager) {
        this.manager = args.manager;
      }

      this.commands = this.defaultCommands();
      this.commandsInternal = this.defaultCommandsInternal();
      this.hooks = this.defaultHooks();
      this.routes = this.defaultRoutes();
      this.tabs = this.defaultTabs();
      this.shortcuts = this.defaultShortcuts();
      this.utils = this.defaultUtils();
      this.defaultRoute = '';
      this.currentTab = '';
    }
  }, {
    key: "registerAPI",
    value: function registerAPI() {
      var _this = this;

      (0, _entries.default)(this.getTabs()).forEach(function (tab) {
        return _this.registerTabRoute(tab[0]);
      });
      (0, _entries.default)(this.getRoutes()).forEach(function (_ref) {
        var _ref2 = (0, _slicedToArray2.default)(_ref, 2),
            route = _ref2[0],
            callback = _ref2[1];

        return _this.registerRoute(route, callback);
      });
      (0, _entries.default)(this.getCommands()).forEach(function (_ref3) {
        var _ref4 = (0, _slicedToArray2.default)(_ref3, 2),
            command = _ref4[0],
            callback = _ref4[1];

        return _this.registerCommand(command, callback);
      });
      (0, _entries.default)(this.getCommandsInternal()).forEach(function (_ref5) {
        var _ref6 = (0, _slicedToArray2.default)(_ref5, 2),
            command = _ref6[0],
            callback = _ref6[1];

        return _this.registerCommandInternal(command, callback);
      });
      (0, _entries.default)(this.getHooks()).forEach(function (_ref7) {
        var _ref8 = (0, _slicedToArray2.default)(_ref7, 2),
            hook = _ref8[0],
            instance = _ref8[1];

        return _this.registerHook(instance);
      }); // eslint-disable-line no-unused-vars
    }
  }, {
    key: "getNamespace",
    value: function getNamespace() {
      elementorModules.ForceMethodImplementation();
    }
  }, {
    key: "getRootContainer",
    value: function getRootContainer() {
      var parts = this.getNamespace().split('/');
      return parts[0];
    }
  }, {
    key: "defaultTabs",
    value: function defaultTabs() {
      return {};
    }
  }, {
    key: "defaultRoutes",
    value: function defaultRoutes() {
      return {};
    }
  }, {
    key: "defaultCommands",
    value: function defaultCommands() {
      return {};
    }
  }, {
    key: "defaultCommandsInternal",
    value: function defaultCommandsInternal() {
      return {};
    }
  }, {
    key: "defaultHooks",
    value: function defaultHooks() {
      return {};
    }
  }, {
    key: "defaultShortcuts",
    value: function defaultShortcuts() {
      return {};
    }
  }, {
    key: "defaultUtils",
    value: function defaultUtils() {
      return {};
    }
  }, {
    key: "getCommands",
    value: function getCommands() {
      return this.commands;
    }
  }, {
    key: "getCommandsInternal",
    value: function getCommandsInternal() {
      return this.commandsInternal;
    }
  }, {
    key: "getHooks",
    value: function getHooks() {
      return this.hooks;
    }
  }, {
    key: "getRoutes",
    value: function getRoutes() {
      return this.routes;
    }
  }, {
    key: "getTabs",
    value: function getTabs() {
      return this.tabs;
    }
  }, {
    key: "getShortcuts",
    value: function getShortcuts() {
      return this.shortcuts;
    }
  }, {
    key: "registerCommand",
    value: function registerCommand(command, callback) {
      $e.commands.register(this, command, callback);
    }
    /**
     * @param {HookBase} instance
     */

  }, {
    key: "registerHook",
    value: function registerHook(instance) {
      return instance.register();
    }
  }, {
    key: "registerCommandInternal",
    value: function registerCommandInternal(command, callback) {
      $e.commandsInternal.register(this, command, callback);
    }
  }, {
    key: "registerRoute",
    value: function registerRoute(route, callback) {
      $e.routes.register(this, route, callback);
    }
  }, {
    key: "unregisterRoute",
    value: function unregisterRoute(route) {
      $e.routes.unregister(this, route);
    }
  }, {
    key: "registerTabRoute",
    value: function registerTabRoute(tab) {
      var _this2 = this;

      this.registerRoute(tab, function () {
        return _this2.activateTab(tab);
      });
    }
  }, {
    key: "dependency",
    value: function dependency() {
      return true;
    }
  }, {
    key: "open",
    value: function open() {
      return true;
    }
  }, {
    key: "close",
    value: function close() {
      if (!this.isOpen) {
        return false;
      }

      this.isOpen = false;
      this.inactivate();
      $e.routes.clearCurrent(this.getNamespace());
      $e.routes.clearHistory(this.getRootContainer());
      return true;
    }
  }, {
    key: "activate",
    value: function activate() {
      $e.components.activate(this.getNamespace());
    }
  }, {
    key: "inactivate",
    value: function inactivate() {
      $e.components.inactivate(this.getNamespace());
    }
  }, {
    key: "isActive",
    value: function isActive() {
      return $e.components.isActive(this.getNamespace());
    }
  }, {
    key: "onRoute",
    value: function onRoute(route) {
      this.toggleRouteClass(route, true);
      this.toggleHistoryClass();
      this.activate();
      this.trigger('route/open', route);
    }
  }, {
    key: "onCloseRoute",
    value: function onCloseRoute(route) {
      this.toggleRouteClass(route, false);
      this.inactivate();
      this.trigger('route/close', route);
    }
  }, {
    key: "setDefaultRoute",
    value: function setDefaultRoute(route) {
      this.defaultRoute = this.getNamespace() + '/' + route;
    }
  }, {
    key: "getDefaultRoute",
    value: function getDefaultRoute() {
      return this.defaultRoute;
    }
  }, {
    key: "removeTab",
    value: function removeTab(tab) {
      delete this.tabs[tab];
      this.unregisterRoute(tab);
    }
  }, {
    key: "hasTab",
    value: function hasTab(tab) {
      return !!this.tabs[tab];
    }
  }, {
    key: "addTab",
    value: function addTab(tab, args, position) {
      var _this3 = this;

      this.tabs[tab] = args; // It can be 0.

      if ('undefined' !== typeof position) {
        var newTabs = {};
        var ids = (0, _keys.default)(this.tabs); // Remove new tab

        ids.pop(); // Add it to position.

        ids.splice(position, 0, tab);
        ids.forEach(function (id) {
          newTabs[id] = _this3.tabs[id];
        });
        this.tabs = newTabs;
      }

      this.registerTabRoute(tab);
    }
  }, {
    key: "getTabsWrapperSelector",
    value: function getTabsWrapperSelector() {
      return '';
    }
  }, {
    key: "getTabRoute",
    value: function getTabRoute(tab) {
      return this.getNamespace() + '/' + tab;
    }
  }, {
    key: "renderTab",
    value: function renderTab(tab) {} // eslint-disable-line

  }, {
    key: "activateTab",
    value: function activateTab(tab) {
      var _this4 = this;

      this.currentTab = tab;
      this.renderTab(tab);
      jQuery(this.getTabsWrapperSelector() + ' .elementor-component-tab').off('click').on('click', function (event) {
        $e.route(_this4.getTabRoute(event.currentTarget.dataset.tab));
      }).removeClass('elementor-active').filter('[data-tab="' + tab + '"]').addClass('elementor-active');
    }
  }, {
    key: "getActiveTabConfig",
    value: function getActiveTabConfig() {
      return this.tabs[this.currentTab] || {};
    }
  }, {
    key: "getBodyClass",
    value: function getBodyClass(route) {
      return 'e-route-' + route.replace(/\//g, '-');
    }
    /**
     * If command includes uppercase character convert it to lowercase and add `-`.
     * e.g: `CopyAll` is converted to `copy-all`.
     */

  }, {
    key: "normalizeCommandName",
    value: function normalizeCommandName(commandName) {
      return commandName.replace(/[A-Z]/g, function (match, offset) {
        return (offset > 0 ? '-' : '') + match.toLowerCase();
      });
    }
  }, {
    key: "importCommands",
    value: function importCommands(commandsFromImport) {
      var _this5 = this;

      var commands = {}; // Convert `Commands` to `ComponentBase` workable format.

      (0, _entries.default)(commandsFromImport).forEach(function (_ref9) {
        var _ref10 = (0, _slicedToArray2.default)(_ref9, 2),
            className = _ref10[0],
            Class = _ref10[1];

        var command = _this5.normalizeCommandName(className);

        commands[command] = function (args) {
          return new Class(args).run();
        };
      });
      return commands;
    }
  }, {
    key: "importHooks",
    value: function importHooks(hooksFromImport) {
      var hooks = {};

      for (var key in hooksFromImport) {
        var hook = new hooksFromImport[key]();
        hooks[hook.getId()] = hook;
      }

      return hooks;
    }
  }, {
    key: "toggleRouteClass",
    value: function toggleRouteClass(route, state) {
      elementorCommon.elements.$body.toggleClass(this.getBodyClass(route), state);
    }
  }, {
    key: "toggleHistoryClass",
    value: function toggleHistoryClass() {
      elementorCommon.elements.$body.toggleClass('e-routes-has-history', !!$e.routes.getHistory(this.getRootContainer()).length);
    }
  }]);
  return ComponentBase;
}(elementorModules.Module);

exports.default = ComponentBase;

/***/ }),
/* 62 */
/***/ (function(module, exports, __webpack_require__) {

var _Object$getOwnPropertyDescriptor = __webpack_require__(137);

var _Object$defineProperty = __webpack_require__(1);

var _typeof = __webpack_require__(40);

var _WeakMap = __webpack_require__(274);

function _getRequireWildcardCache() {
  if (typeof _WeakMap !== "function") return null;
  var cache = new _WeakMap();

  _getRequireWildcardCache = function _getRequireWildcardCache() {
    return cache;
  };

  return cache;
}

function _interopRequireWildcard(obj) {
  if (obj && obj.__esModule) {
    return obj;
  }

  if (obj === null || _typeof(obj) !== "object" && typeof obj !== "function") {
    return {
      "default": obj
    };
  }

  var cache = _getRequireWildcardCache();

  if (cache && cache.has(obj)) {
    return cache.get(obj);
  }

  var newObj = {};
  var hasPropertyDescriptor = _Object$defineProperty && _Object$getOwnPropertyDescriptor;

  for (var key in obj) {
    if (Object.prototype.hasOwnProperty.call(obj, key)) {
      var desc = hasPropertyDescriptor ? _Object$getOwnPropertyDescriptor(obj, key) : null;

      if (desc && (desc.get || desc.set)) {
        _Object$defineProperty(newObj, key, desc);
      } else {
        newObj[key] = obj[key];
      }
    }
  }

  newObj["default"] = obj;

  if (cache) {
    cache.set(obj, newObj);
  }

  return newObj;
}

module.exports = _interopRequireWildcard;

/***/ }),
/* 63 */
/***/ (function(module, exports, __webpack_require__) {

var core = __webpack_require__(45);
var global = __webpack_require__(15);
var SHARED = '__core-js_shared__';
var store = global[SHARED] || (global[SHARED] = {});

(module.exports = function (key, value) {
  return store[key] || (store[key] = value !== undefined ? value : {});
})('versions', []).push({
  version: core.version,
  mode: __webpack_require__(100) ? 'pure' : 'global',
  copyright: '© 2019 Denis Pushkarev (zloirock.ru)'
});


/***/ }),
/* 64 */
/***/ (function(module, exports) {

var id = 0;
var px = Math.random();
module.exports = function (key) {
  return 'Symbol('.concat(key === undefined ? '' : key, ')_', (++id + px).toString(36));
};


/***/ }),
/* 65 */,
/* 66 */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(229);

/***/ }),
/* 67 */
/***/ (function(module, exports, __webpack_require__) {

// 7.1.15 ToLength
var toInteger = __webpack_require__(72);
var min = Math.min;
module.exports = function (it) {
  return it > 0 ? min(toInteger(it), 0x1fffffffffffff) : 0; // pow(2, 53) - 1 == 9007199254740991
};


/***/ }),
/* 68 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var isRegExp = __webpack_require__(120);
var anObject = __webpack_require__(18);
var speciesConstructor = __webpack_require__(143);
var advanceStringIndex = __webpack_require__(109);
var toLength = __webpack_require__(41);
var callRegExpExec = __webpack_require__(89);
var regexpExec = __webpack_require__(83);
var fails = __webpack_require__(28);
var $min = Math.min;
var $push = [].push;
var $SPLIT = 'split';
var LENGTH = 'length';
var LAST_INDEX = 'lastIndex';
var MAX_UINT32 = 0xffffffff;

// babel-minify transpiles RegExp('x', 'y') -> /x/y and it causes SyntaxError
var SUPPORTS_Y = !fails(function () { RegExp(MAX_UINT32, 'y'); });

// @@split logic
__webpack_require__(90)('split', 2, function (defined, SPLIT, $split, maybeCallNative) {
  var internalSplit;
  if (
    'abbc'[$SPLIT](/(b)*/)[1] == 'c' ||
    'test'[$SPLIT](/(?:)/, -1)[LENGTH] != 4 ||
    'ab'[$SPLIT](/(?:ab)*/)[LENGTH] != 2 ||
    '.'[$SPLIT](/(.?)(.?)/)[LENGTH] != 4 ||
    '.'[$SPLIT](/()()/)[LENGTH] > 1 ||
    ''[$SPLIT](/.?/)[LENGTH]
  ) {
    // based on es5-shim implementation, need to rework it
    internalSplit = function (separator, limit) {
      var string = String(this);
      if (separator === undefined && limit === 0) return [];
      // If `separator` is not a regex, use native split
      if (!isRegExp(separator)) return $split.call(string, separator, limit);
      var output = [];
      var flags = (separator.ignoreCase ? 'i' : '') +
                  (separator.multiline ? 'm' : '') +
                  (separator.unicode ? 'u' : '') +
                  (separator.sticky ? 'y' : '');
      var lastLastIndex = 0;
      var splitLimit = limit === undefined ? MAX_UINT32 : limit >>> 0;
      // Make `global` and avoid `lastIndex` issues by working with a copy
      var separatorCopy = new RegExp(separator.source, flags + 'g');
      var match, lastIndex, lastLength;
      while (match = regexpExec.call(separatorCopy, string)) {
        lastIndex = separatorCopy[LAST_INDEX];
        if (lastIndex > lastLastIndex) {
          output.push(string.slice(lastLastIndex, match.index));
          if (match[LENGTH] > 1 && match.index < string[LENGTH]) $push.apply(output, match.slice(1));
          lastLength = match[0][LENGTH];
          lastLastIndex = lastIndex;
          if (output[LENGTH] >= splitLimit) break;
        }
        if (separatorCopy[LAST_INDEX] === match.index) separatorCopy[LAST_INDEX]++; // Avoid an infinite loop
      }
      if (lastLastIndex === string[LENGTH]) {
        if (lastLength || !separatorCopy.test('')) output.push('');
      } else output.push(string.slice(lastLastIndex));
      return output[LENGTH] > splitLimit ? output.slice(0, splitLimit) : output;
    };
  // Chakra, V8
  } else if ('0'[$SPLIT](undefined, 0)[LENGTH]) {
    internalSplit = function (separator, limit) {
      return separator === undefined && limit === 0 ? [] : $split.call(this, separator, limit);
    };
  } else {
    internalSplit = $split;
  }

  return [
    // `String.prototype.split` method
    // https://tc39.github.io/ecma262/#sec-string.prototype.split
    function split(separator, limit) {
      var O = defined(this);
      var splitter = separator == undefined ? undefined : separator[SPLIT];
      return splitter !== undefined
        ? splitter.call(separator, O, limit)
        : internalSplit.call(String(O), separator, limit);
    },
    // `RegExp.prototype[@@split]` method
    // https://tc39.github.io/ecma262/#sec-regexp.prototype-@@split
    //
    // NOTE: This cannot be properly polyfilled in engines that don't support
    // the 'y' flag.
    function (regexp, limit) {
      var res = maybeCallNative(internalSplit, regexp, this, limit, internalSplit !== $split);
      if (res.done) return res.value;

      var rx = anObject(regexp);
      var S = String(this);
      var C = speciesConstructor(rx, RegExp);

      var unicodeMatching = rx.unicode;
      var flags = (rx.ignoreCase ? 'i' : '') +
                  (rx.multiline ? 'm' : '') +
                  (rx.unicode ? 'u' : '') +
                  (SUPPORTS_Y ? 'y' : 'g');

      // ^(? + rx + ) is needed, in combination with some S slicing, to
      // simulate the 'y' flag.
      var splitter = new C(SUPPORTS_Y ? rx : '^(?:' + rx.source + ')', flags);
      var lim = limit === undefined ? MAX_UINT32 : limit >>> 0;
      if (lim === 0) return [];
      if (S.length === 0) return callRegExpExec(splitter, S) === null ? [S] : [];
      var p = 0;
      var q = 0;
      var A = [];
      while (q < S.length) {
        splitter.lastIndex = SUPPORTS_Y ? q : 0;
        var z = callRegExpExec(splitter, SUPPORTS_Y ? S : S.slice(q));
        var e;
        if (
          z === null ||
          (e = $min(toLength(splitter.lastIndex + (SUPPORTS_Y ? 0 : q)), S.length)) === p
        ) {
          q = advanceStringIndex(S, q, unicodeMatching);
        } else {
          A.push(S.slice(p, q));
          if (A.length === lim) return A;
          for (var i = 1; i <= z.length - 1; i++) {
            A.push(z[i]);
            if (A.length === lim) return A;
          }
          q = p = e;
        }
      }
      A.push(S.slice(p));
      return A;
    }
  ];
});


/***/ }),
/* 69 */
/***/ (function(module, exports, __webpack_require__) {

// 7.1.1 ToPrimitive(input [, PreferredType])
var isObject = __webpack_require__(9);
// instead of the ES6 spec version, we didn't implement @@toPrimitive case
// and the second argument - flag - preferred type is a string
module.exports = function (it, S) {
  if (!isObject(it)) return it;
  var fn, val;
  if (S && typeof (fn = it.toString) == 'function' && !isObject(val = fn.call(it))) return val;
  if (typeof (fn = it.valueOf) == 'function' && !isObject(val = fn.call(it))) return val;
  if (!S && typeof (fn = it.toString) == 'function' && !isObject(val = fn.call(it))) return val;
  throw TypeError("Can't convert object to primitive value");
};


/***/ }),
/* 70 */
/***/ (function(module, exports, __webpack_require__) {

var shared = __webpack_require__(71)('keys');
var uid = __webpack_require__(51);
module.exports = function (key) {
  return shared[key] || (shared[key] = uid(key));
};


/***/ }),
/* 71 */
/***/ (function(module, exports, __webpack_require__) {

var core = __webpack_require__(6);
var global = __webpack_require__(8);
var SHARED = '__core-js_shared__';
var store = global[SHARED] || (global[SHARED] = {});

(module.exports = function (key, value) {
  return store[key] || (store[key] = value !== undefined ? value : {});
})('versions', []).push({
  version: core.version,
  mode: __webpack_require__(46) ? 'pure' : 'global',
  copyright: '© 2019 Denis Pushkarev (zloirock.ru)'
});


/***/ }),
/* 72 */
/***/ (function(module, exports) {

// 7.1.4 ToInteger
var ceil = Math.ceil;
var floor = Math.floor;
module.exports = function (it) {
  return isNaN(it = +it) ? 0 : (it > 0 ? floor : ceil)(it);
};


/***/ }),
/* 73 */
/***/ (function(module, exports) {

// IE 8- don't enum bug keys
module.exports = (
  'constructor,hasOwnProperty,isPrototypeOf,propertyIsEnumerable,toLocaleString,toString,valueOf'
).split(',');


/***/ }),
/* 74 */
/***/ (function(module, exports, __webpack_require__) {

exports.f = __webpack_require__(10);


/***/ }),
/* 75 */
/***/ (function(module, exports, __webpack_require__) {

var global = __webpack_require__(8);
var core = __webpack_require__(6);
var LIBRARY = __webpack_require__(46);
var wksExt = __webpack_require__(74);
var defineProperty = __webpack_require__(16).f;
module.exports = function (name) {
  var $Symbol = core.Symbol || (core.Symbol = LIBRARY ? {} : global.Symbol || {});
  if (name.charAt(0) != '_' && !(name in $Symbol)) defineProperty($Symbol, name, { value: wksExt.f(name) });
};


/***/ }),
/* 76 */,
/* 77 */
/***/ (function(module, exports, __webpack_require__) {

var META = __webpack_require__(51)('meta');
var isObject = __webpack_require__(9);
var has = __webpack_require__(19);
var setDesc = __webpack_require__(16).f;
var id = 0;
var isExtensible = Object.isExtensible || function () {
  return true;
};
var FREEZE = !__webpack_require__(20)(function () {
  return isExtensible(Object.preventExtensions({}));
});
var setMeta = function (it) {
  setDesc(it, META, { value: {
    i: 'O' + ++id, // object ID
    w: {}          // weak collections IDs
  } });
};
var fastKey = function (it, create) {
  // return primitive with prefix
  if (!isObject(it)) return typeof it == 'symbol' ? it : (typeof it == 'string' ? 'S' : 'P') + it;
  if (!has(it, META)) {
    // can't set metadata to uncaught frozen object
    if (!isExtensible(it)) return 'F';
    // not necessary to add metadata
    if (!create) return 'E';
    // add missing metadata
    setMeta(it);
  // return object ID
  } return it[META].i;
};
var getWeak = function (it, create) {
  if (!has(it, META)) {
    // can't set metadata to uncaught frozen object
    if (!isExtensible(it)) return true;
    // not necessary to add metadata
    if (!create) return false;
    // add missing metadata
    setMeta(it);
  // return hash weak collections IDs
  } return it[META].w;
};
// add metadata on freeze-family methods calling
var onFreeze = function (it) {
  if (FREEZE && meta.NEED && isExtensible(it) && !has(it, META)) setMeta(it);
  return it;
};
var meta = module.exports = {
  KEY: META,
  NEED: false,
  fastKey: fastKey,
  getWeak: getWeak,
  onFreeze: onFreeze
};


/***/ }),
/* 78 */
/***/ (function(module, exports, __webpack_require__) {

// 22.1.3.31 Array.prototype[@@unscopables]
var UNSCOPABLES = __webpack_require__(11)('unscopables');
var ArrayProto = Array.prototype;
if (ArrayProto[UNSCOPABLES] == undefined) __webpack_require__(27)(ArrayProto, UNSCOPABLES, {});
module.exports = function (key) {
  ArrayProto[UNSCOPABLES][key] = true;
};


/***/ }),
/* 79 */
/***/ (function(module, exports) {

module.exports = function (it) {
  if (typeof it != 'function') throw TypeError(it + ' is not a function!');
  return it;
};


/***/ }),
/* 80 */
/***/ (function(module, exports, __webpack_require__) {

// 19.1.2.9 / 15.2.3.2 Object.getPrototypeOf(O)
var has = __webpack_require__(19);
var toObject = __webpack_require__(31);
var IE_PROTO = __webpack_require__(70)('IE_PROTO');
var ObjectProto = Object.prototype;

module.exports = Object.getPrototypeOf || function (O) {
  O = toObject(O);
  if (has(O, IE_PROTO)) return O[IE_PROTO];
  if (typeof O.constructor == 'function' && O instanceof O.constructor) {
    return O.constructor.prototype;
  } return O instanceof Object ? ObjectProto : null;
};


/***/ }),
/* 81 */
/***/ (function(module, exports, __webpack_require__) {

// 7.1.13 ToObject(argument)
var defined = __webpack_require__(36);
module.exports = function (it) {
  return Object(defined(it));
};


/***/ }),
/* 82 */
/***/ (function(module, exports) {

exports.f = Object.getOwnPropertySymbols;


/***/ }),
/* 83 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var regexpFlags = __webpack_require__(110);

var nativeExec = RegExp.prototype.exec;
// This always refers to the native implementation, because the
// String#replace polyfill uses ./fix-regexp-well-known-symbol-logic.js,
// which loads this file before patching the method.
var nativeReplace = String.prototype.replace;

var patchedExec = nativeExec;

var LAST_INDEX = 'lastIndex';

var UPDATES_LAST_INDEX_WRONG = (function () {
  var re1 = /a/,
      re2 = /b*/g;
  nativeExec.call(re1, 'a');
  nativeExec.call(re2, 'a');
  return re1[LAST_INDEX] !== 0 || re2[LAST_INDEX] !== 0;
})();

// nonparticipating capturing group, copied from es5-shim's String#split patch.
var NPCG_INCLUDED = /()??/.exec('')[1] !== undefined;

var PATCH = UPDATES_LAST_INDEX_WRONG || NPCG_INCLUDED;

if (PATCH) {
  patchedExec = function exec(str) {
    var re = this;
    var lastIndex, reCopy, match, i;

    if (NPCG_INCLUDED) {
      reCopy = new RegExp('^' + re.source + '$(?!\\s)', regexpFlags.call(re));
    }
    if (UPDATES_LAST_INDEX_WRONG) lastIndex = re[LAST_INDEX];

    match = nativeExec.call(re, str);

    if (UPDATES_LAST_INDEX_WRONG && match) {
      re[LAST_INDEX] = re.global ? match.index + match[0].length : lastIndex;
    }
    if (NPCG_INCLUDED && match && match.length > 1) {
      // Fix browsers whose `exec` methods don't consistently return `undefined`
      // for NPCG, like IE8. NOTE: This doesn' work for /(.?)?/
      // eslint-disable-next-line no-loop-func
      nativeReplace.call(match[0], reCopy, function () {
        for (i = 1; i < arguments.length - 2; i++) {
          if (arguments[i] === undefined) match[i] = undefined;
        }
      });
    }

    return match;
  };
}

module.exports = patchedExec;


/***/ }),
/* 84 */
/***/ (function(module, exports, __webpack_require__) {

// most Object methods by ES6 should accept primitives
var $export = __webpack_require__(7);
var core = __webpack_require__(6);
var fails = __webpack_require__(20);
module.exports = function (KEY, exec) {
  var fn = (core.Object || {})[KEY] || Object[KEY];
  var exp = {};
  exp[KEY] = exec(fn);
  $export($export.S + $export.F * fails(function () { fn(1); }), 'Object', exp);
};


/***/ }),
/* 85 */
/***/ (function(module, exports, __webpack_require__) {

var arrayWithHoles = __webpack_require__(218);

var iterableToArrayLimit = __webpack_require__(221);

var unsupportedIterableToArray = __webpack_require__(184);

var nonIterableRest = __webpack_require__(228);

function _slicedToArray(arr, i) {
  return arrayWithHoles(arr) || iterableToArrayLimit(arr, i) || unsupportedIterableToArray(arr, i) || nonIterableRest();
}

module.exports = _slicedToArray;

/***/ }),
/* 86 */
/***/ (function(module, exports, __webpack_require__) {

var ctx = __webpack_require__(30);
var call = __webpack_require__(133);
var isArrayIter = __webpack_require__(134);
var anObject = __webpack_require__(12);
var toLength = __webpack_require__(67);
var getIterFn = __webpack_require__(114);
var BREAK = {};
var RETURN = {};
var exports = module.exports = function (iterable, entries, fn, that, ITERATOR) {
  var iterFn = ITERATOR ? function () { return iterable; } : getIterFn(iterable);
  var f = ctx(fn, that, entries ? 2 : 1);
  var index = 0;
  var length, step, iterator, result;
  if (typeof iterFn != 'function') throw TypeError(iterable + ' is not iterable!');
  // fast case for arrays with default iterator
  if (isArrayIter(iterFn)) for (length = toLength(iterable.length); length > index; index++) {
    result = entries ? f(anObject(step = iterable[index])[0], step[1]) : f(iterable[index]);
    if (result === BREAK || result === RETURN) return result;
  } else for (iterator = iterFn.call(iterable); !(step = iterator.next()).done;) {
    result = call(iterator, f, step.value, entries);
    if (result === BREAK || result === RETURN) return result;
  }
};
exports.BREAK = BREAK;
exports.RETURN = RETURN;


/***/ }),
/* 87 */,
/* 88 */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(24);


/***/ }),
/* 89 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var classof = __webpack_require__(103);
var builtinExec = RegExp.prototype.exec;

 // `RegExpExec` abstract operation
// https://tc39.github.io/ecma262/#sec-regexpexec
module.exports = function (R, S) {
  var exec = R.exec;
  if (typeof exec === 'function') {
    var result = exec.call(R, S);
    if (typeof result !== 'object') {
      throw new TypeError('RegExp exec method returned something other than an Object or null');
    }
    return result;
  }
  if (classof(R) !== 'RegExp') {
    throw new TypeError('RegExp#exec called on incompatible receiver');
  }
  return builtinExec.call(R, S);
};


/***/ }),
/* 90 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";

__webpack_require__(182);
var redefine = __webpack_require__(33);
var hide = __webpack_require__(27);
var fails = __webpack_require__(28);
var defined = __webpack_require__(36);
var wks = __webpack_require__(11);
var regexpExec = __webpack_require__(83);

var SPECIES = wks('species');

var REPLACE_SUPPORTS_NAMED_GROUPS = !fails(function () {
  // #replace needs built-in support for named groups.
  // #match works fine because it just return the exec results, even if it has
  // a "grops" property.
  var re = /./;
  re.exec = function () {
    var result = [];
    result.groups = { a: '7' };
    return result;
  };
  return ''.replace(re, '$<a>') !== '7';
});

var SPLIT_WORKS_WITH_OVERWRITTEN_EXEC = (function () {
  // Chrome 51 has a buggy "split" implementation when RegExp#exec !== nativeExec
  var re = /(?:)/;
  var originalExec = re.exec;
  re.exec = function () { return originalExec.apply(this, arguments); };
  var result = 'ab'.split(re);
  return result.length === 2 && result[0] === 'a' && result[1] === 'b';
})();

module.exports = function (KEY, length, exec) {
  var SYMBOL = wks(KEY);

  var DELEGATES_TO_SYMBOL = !fails(function () {
    // String methods call symbol-named RegEp methods
    var O = {};
    O[SYMBOL] = function () { return 7; };
    return ''[KEY](O) != 7;
  });

  var DELEGATES_TO_EXEC = DELEGATES_TO_SYMBOL ? !fails(function () {
    // Symbol-named RegExp methods call .exec
    var execCalled = false;
    var re = /a/;
    re.exec = function () { execCalled = true; return null; };
    if (KEY === 'split') {
      // RegExp[@@split] doesn't call the regex's exec method, but first creates
      // a new one. We need to return the patched regex when creating the new one.
      re.constructor = {};
      re.constructor[SPECIES] = function () { return re; };
    }
    re[SYMBOL]('');
    return !execCalled;
  }) : undefined;

  if (
    !DELEGATES_TO_SYMBOL ||
    !DELEGATES_TO_EXEC ||
    (KEY === 'replace' && !REPLACE_SUPPORTS_NAMED_GROUPS) ||
    (KEY === 'split' && !SPLIT_WORKS_WITH_OVERWRITTEN_EXEC)
  ) {
    var nativeRegExpMethod = /./[SYMBOL];
    var fns = exec(
      defined,
      SYMBOL,
      ''[KEY],
      function maybeCallNative(nativeMethod, regexp, str, arg2, forceStringMethod) {
        if (regexp.exec === regexpExec) {
          if (DELEGATES_TO_SYMBOL && !forceStringMethod) {
            // The native String method already delegates to @@method (this
            // polyfilled function), leasing to infinite recursion.
            // We avoid it by directly calling the native @@method method.
            return { done: true, value: nativeRegExpMethod.call(regexp, str, arg2) };
          }
          return { done: true, value: nativeMethod.call(str, regexp, arg2) };
        }
        return { done: false };
      }
    );
    var strfn = fns[0];
    var rxfn = fns[1];

    redefine(String.prototype, KEY, strfn);
    hide(RegExp.prototype, SYMBOL, length == 2
      // 21.2.5.8 RegExp.prototype[@@replace](string, replaceValue)
      // 21.2.5.11 RegExp.prototype[@@split](string, limit)
      ? function (string, arg) { return rxfn.call(string, this, arg); }
      // 21.2.5.6 RegExp.prototype[@@match](string)
      // 21.2.5.9 RegExp.prototype[@@search](string)
      : function (string) { return rxfn.call(string, this); }
    );
  }
};


/***/ }),
/* 91 */
/***/ (function(module, exports) {

module.exports = function (bitmap, value) {
  return {
    enumerable: !(bitmap & 1),
    configurable: !(bitmap & 2),
    writable: !(bitmap & 4),
    value: value
  };
};


/***/ }),
/* 92 */
/***/ (function(module, exports, __webpack_require__) {

var isObject = __webpack_require__(9);
var document = __webpack_require__(8).document;
// typeof document.createElement is 'object' in old IE
var is = isObject(document) && isObject(document.createElement);
module.exports = function (it) {
  return is ? document.createElement(it) : {};
};


/***/ }),
/* 93 */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(160);

/***/ }),
/* 94 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";

var LIBRARY = __webpack_require__(46);
var $export = __webpack_require__(7);
var redefine = __webpack_require__(88);
var hide = __webpack_require__(24);
var Iterators = __webpack_require__(34);
var $iterCreate = __webpack_require__(166);
var setToStringTag = __webpack_require__(52);
var getPrototypeOf = __webpack_require__(80);
var ITERATOR = __webpack_require__(10)('iterator');
var BUGGY = !([].keys && 'next' in [].keys()); // Safari has buggy iterators w/o `next`
var FF_ITERATOR = '@@iterator';
var KEYS = 'keys';
var VALUES = 'values';

var returnThis = function () { return this; };

module.exports = function (Base, NAME, Constructor, next, DEFAULT, IS_SET, FORCED) {
  $iterCreate(Constructor, NAME, next);
  var getMethod = function (kind) {
    if (!BUGGY && kind in proto) return proto[kind];
    switch (kind) {
      case KEYS: return function keys() { return new Constructor(this, kind); };
      case VALUES: return function values() { return new Constructor(this, kind); };
    } return function entries() { return new Constructor(this, kind); };
  };
  var TAG = NAME + ' Iterator';
  var DEF_VALUES = DEFAULT == VALUES;
  var VALUES_BUG = false;
  var proto = Base.prototype;
  var $native = proto[ITERATOR] || proto[FF_ITERATOR] || DEFAULT && proto[DEFAULT];
  var $default = $native || getMethod(DEFAULT);
  var $entries = DEFAULT ? !DEF_VALUES ? $default : getMethod('entries') : undefined;
  var $anyNative = NAME == 'Array' ? proto.entries || $native : $native;
  var methods, key, IteratorPrototype;
  // Fix native
  if ($anyNative) {
    IteratorPrototype = getPrototypeOf($anyNative.call(new Base()));
    if (IteratorPrototype !== Object.prototype && IteratorPrototype.next) {
      // Set @@toStringTag to native iterators
      setToStringTag(IteratorPrototype, TAG, true);
      // fix for some old engines
      if (!LIBRARY && typeof IteratorPrototype[ITERATOR] != 'function') hide(IteratorPrototype, ITERATOR, returnThis);
    }
  }
  // fix Array#{values, @@iterator}.name in V8 / FF
  if (DEF_VALUES && $native && $native.name !== VALUES) {
    VALUES_BUG = true;
    $default = function values() { return $native.call(this); };
  }
  // Define iterator
  if ((!LIBRARY || FORCED) && (BUGGY || VALUES_BUG || !proto[ITERATOR])) {
    hide(proto, ITERATOR, $default);
  }
  // Plug for library
  Iterators[NAME] = $default;
  Iterators[TAG] = returnThis;
  if (DEFAULT) {
    methods = {
      values: DEF_VALUES ? $default : getMethod(VALUES),
      keys: IS_SET ? $default : getMethod(KEYS),
      entries: $entries
    };
    if (FORCED) for (key in methods) {
      if (!(key in proto)) redefine(proto, key, methods[key]);
    } else $export($export.P + $export.F * (BUGGY || VALUES_BUG), NAME, methods);
  }
  return methods;
};


/***/ }),
/* 95 */
/***/ (function(module, exports, __webpack_require__) {

// 7.2.2 IsArray(argument)
var cof = __webpack_require__(59);
module.exports = Array.isArray || function isArray(arg) {
  return cof(arg) == 'Array';
};


/***/ }),
/* 96 */
/***/ (function(module, exports, __webpack_require__) {

// to indexed object, toObject with fallback for non-array-like ES3 strings
var IObject = __webpack_require__(102);
var defined = __webpack_require__(36);
module.exports = function (it) {
  return IObject(defined(it));
};


/***/ }),
/* 97 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";

// 19.1.3.6 Object.prototype.toString()
var classof = __webpack_require__(103);
var test = {};
test[__webpack_require__(11)('toStringTag')] = 'z';
if (test + '' != '[object z]') {
  __webpack_require__(33)(Object.prototype, 'toString', function toString() {
    return '[object ' + classof(this) + ']';
  }, true);
}


/***/ }),
/* 98 */
/***/ (function(module, exports, __webpack_require__) {

var isObject = __webpack_require__(26);
var document = __webpack_require__(15).document;
// typeof document.createElement is 'object' in old IE
var is = isObject(document) && isObject(document.createElement);
module.exports = function (it) {
  return is ? document.createElement(it) : {};
};


/***/ }),
/* 99 */,
/* 100 */
/***/ (function(module, exports) {

module.exports = false;


/***/ }),
/* 101 */
/***/ (function(module, exports, __webpack_require__) {

// 19.1.2.7 / 15.2.3.4 Object.getOwnPropertyNames(O)
var $keys = __webpack_require__(113);
var hiddenKeys = __webpack_require__(73).concat('length', 'prototype');

exports.f = Object.getOwnPropertyNames || function getOwnPropertyNames(O) {
  return $keys(O, hiddenKeys);
};


/***/ }),
/* 102 */
/***/ (function(module, exports, __webpack_require__) {

// fallback for non-array-like ES3 and non-enumerable old V8 strings
var cof = __webpack_require__(37);
// eslint-disable-next-line no-prototype-builtins
module.exports = Object('z').propertyIsEnumerable(0) ? Object : function (it) {
  return cof(it) == 'String' ? it.split('') : Object(it);
};


/***/ }),
/* 103 */
/***/ (function(module, exports, __webpack_require__) {

// getting tag from 19.1.3.6 Object.prototype.toString()
var cof = __webpack_require__(37);
var TAG = __webpack_require__(11)('toStringTag');
// ES3 wrong here
var ARG = cof(function () { return arguments; }()) == 'Arguments';

// fallback for IE11 Script Access Denied error
var tryGet = function (it, key) {
  try {
    return it[key];
  } catch (e) { /* empty */ }
};

module.exports = function (it) {
  var O, T, B;
  return it === undefined ? 'Undefined' : it === null ? 'Null'
    // @@toStringTag case
    : typeof (T = tryGet(O = Object(it), TAG)) == 'string' ? T
    // builtinTag case
    : ARG ? cof(O)
    // ES3 arguments fallback
    : (B = cof(O)) == 'Object' && typeof O.callee == 'function' ? 'Arguments' : B;
};


/***/ }),
/* 104 */
/***/ (function(module, exports, __webpack_require__) {

// fallback for non-array-like ES3 and non-enumerable old V8 strings
var cof = __webpack_require__(59);
// eslint-disable-next-line no-prototype-builtins
module.exports = Object('z').propertyIsEnumerable(0) ? Object : function (it) {
  return cof(it) == 'String' ? it.split('') : Object(it);
};


/***/ }),
/* 105 */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(169);

/***/ }),
/* 106 */
/***/ (function(module, exports) {



/***/ }),
/* 107 */
/***/ (function(module, exports, __webpack_require__) {

// getting tag from 19.1.3.6 Object.prototype.toString()
var cof = __webpack_require__(59);
var TAG = __webpack_require__(10)('toStringTag');
// ES3 wrong here
var ARG = cof(function () { return arguments; }()) == 'Arguments';

// fallback for IE11 Script Access Denied error
var tryGet = function (it, key) {
  try {
    return it[key];
  } catch (e) { /* empty */ }
};

module.exports = function (it) {
  var O, T, B;
  return it === undefined ? 'Undefined' : it === null ? 'Null'
    // @@toStringTag case
    : typeof (T = tryGet(O = Object(it), TAG)) == 'string' ? T
    // builtinTag case
    : ARG ? cof(O)
    // ES3 arguments fallback
    : (B = cof(O)) == 'Object' && typeof O.callee == 'function' ? 'Arguments' : B;
};


/***/ }),
/* 108 */
/***/ (function(module, exports, __webpack_require__) {

// 7.1.1 ToPrimitive(input [, PreferredType])
var isObject = __webpack_require__(26);
// instead of the ES6 spec version, we didn't implement @@toPrimitive case
// and the second argument - flag - preferred type is a string
module.exports = function (it, S) {
  if (!isObject(it)) return it;
  var fn, val;
  if (S && typeof (fn = it.toString) == 'function' && !isObject(val = fn.call(it))) return val;
  if (typeof (fn = it.valueOf) == 'function' && !isObject(val = fn.call(it))) return val;
  if (!S && typeof (fn = it.toString) == 'function' && !isObject(val = fn.call(it))) return val;
  throw TypeError("Can't convert object to primitive value");
};


/***/ }),
/* 109 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";

var at = __webpack_require__(181)(true);

 // `AdvanceStringIndex` abstract operation
// https://tc39.github.io/ecma262/#sec-advancestringindex
module.exports = function (S, index, unicode) {
  return index + (unicode ? at(S, index).length : 1);
};


/***/ }),
/* 110 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";

// 21.2.5.3 get RegExp.prototype.flags
var anObject = __webpack_require__(18);
module.exports = function () {
  var that = anObject(this);
  var result = '';
  if (that.global) result += 'g';
  if (that.ignoreCase) result += 'i';
  if (that.multiline) result += 'm';
  if (that.unicode) result += 'u';
  if (that.sticky) result += 'y';
  return result;
};


/***/ }),
/* 111 */
/***/ (function(module, exports, __webpack_require__) {

module.exports = !__webpack_require__(13) && !__webpack_require__(20)(function () {
  return Object.defineProperty(__webpack_require__(92)('div'), 'a', { get: function () { return 7; } }).a != 7;
});


/***/ }),
/* 112 */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(153);

/***/ }),
/* 113 */
/***/ (function(module, exports, __webpack_require__) {

var has = __webpack_require__(19);
var toIObject = __webpack_require__(21);
var arrayIndexOf = __webpack_require__(158)(false);
var IE_PROTO = __webpack_require__(70)('IE_PROTO');

module.exports = function (object, names) {
  var O = toIObject(object);
  var i = 0;
  var result = [];
  var key;
  for (key in O) if (key != IE_PROTO) has(O, key) && result.push(key);
  // Don't enum bug & hidden keys
  while (names.length > i) if (has(O, key = names[i++])) {
    ~arrayIndexOf(result, key) || result.push(key);
  }
  return result;
};


/***/ }),
/* 114 */
/***/ (function(module, exports, __webpack_require__) {

var classof = __webpack_require__(107);
var ITERATOR = __webpack_require__(10)('iterator');
var Iterators = __webpack_require__(34);
module.exports = __webpack_require__(6).getIteratorMethod = function (it) {
  if (it != undefined) return it[ITERATOR]
    || it['@@iterator']
    || Iterators[classof(it)];
};


/***/ }),
/* 115 */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(254);

/***/ }),
/* 116 */
/***/ (function(module, exports, __webpack_require__) {

module.exports = !__webpack_require__(25) && !__webpack_require__(28)(function () {
  return Object.defineProperty(__webpack_require__(98)('div'), 'a', { get: function () { return 7; } }).a != 7;
});


/***/ }),
/* 117 */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(219);

/***/ }),
/* 118 */
/***/ (function(module, exports, __webpack_require__) {

var _Object$setPrototypeOf = __webpack_require__(112);

function _setPrototypeOf(o, p) {
  module.exports = _setPrototypeOf = _Object$setPrototypeOf || function _setPrototypeOf(o, p) {
    o.__proto__ = p;
    return o;
  };

  return _setPrototypeOf(o, p);
}

module.exports = _setPrototypeOf;

/***/ }),
/* 119 */
/***/ (function(module, exports, __webpack_require__) {

// 0 -> Array#forEach
// 1 -> Array#map
// 2 -> Array#filter
// 3 -> Array#some
// 4 -> Array#every
// 5 -> Array#find
// 6 -> Array#findIndex
var ctx = __webpack_require__(58);
var IObject = __webpack_require__(102);
var toObject = __webpack_require__(81);
var toLength = __webpack_require__(41);
var asc = __webpack_require__(140);
module.exports = function (TYPE, $create) {
  var IS_MAP = TYPE == 1;
  var IS_FILTER = TYPE == 2;
  var IS_SOME = TYPE == 3;
  var IS_EVERY = TYPE == 4;
  var IS_FIND_INDEX = TYPE == 6;
  var NO_HOLES = TYPE == 5 || IS_FIND_INDEX;
  var create = $create || asc;
  return function ($this, callbackfn, that) {
    var O = toObject($this);
    var self = IObject(O);
    var f = ctx(callbackfn, that, 3);
    var length = toLength(self.length);
    var index = 0;
    var result = IS_MAP ? create($this, length) : IS_FILTER ? create($this, 0) : undefined;
    var val, res;
    for (;length > index; index++) if (NO_HOLES || index in self) {
      val = self[index];
      res = f(val, index, O);
      if (TYPE) {
        if (IS_MAP) result[index] = res;   // map
        else if (res) switch (TYPE) {
          case 3: return true;             // some
          case 5: return val;              // find
          case 6: return index;            // findIndex
          case 2: result.push(val);        // filter
        } else if (IS_EVERY) return false; // every
      }
    }
    return IS_FIND_INDEX ? -1 : IS_SOME || IS_EVERY ? IS_EVERY : result;
  };
};


/***/ }),
/* 120 */
/***/ (function(module, exports, __webpack_require__) {

// 7.2.8 IsRegExp(argument)
var isObject = __webpack_require__(26);
var cof = __webpack_require__(37);
var MATCH = __webpack_require__(11)('match');
module.exports = function (it) {
  var isRegExp;
  return isObject(it) && ((isRegExp = it[MATCH]) !== undefined ? !!isRegExp : cof(it) == 'RegExp');
};


/***/ }),
/* 121 */
/***/ (function(module, exports, __webpack_require__) {

var isObject = __webpack_require__(9);
module.exports = function (it, TYPE) {
  if (!isObject(it) || it._t !== TYPE) throw TypeError('Incompatible receiver, ' + TYPE + ' required!');
  return it;
};


/***/ }),
/* 122 */
/***/ (function(module, exports) {

module.exports = {};


/***/ }),
/* 123 */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(156);

/***/ }),
/* 124 */
/***/ (function(module, exports, __webpack_require__) {

var hide = __webpack_require__(24);
module.exports = function (target, src, safe) {
  for (var key in src) {
    if (safe && target[key]) target[key] = src[key];
    else hide(target, key, src[key]);
  } return target;
};


/***/ }),
/* 125 */
/***/ (function(module, exports) {

module.exports = function (it, Constructor, name, forbiddenField) {
  if (!(it instanceof Constructor) || (forbiddenField !== undefined && forbiddenField in it)) {
    throw TypeError(name + ': incorrect invocation!');
  } return it;
};


/***/ }),
/* 126 */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(63)('native-function-to-string', Function.toString);


/***/ }),
/* 127 */
/***/ (function(module, exports, __webpack_require__) {

var shared = __webpack_require__(63)('keys');
var uid = __webpack_require__(64);
module.exports = function (key) {
  return shared[key] || (shared[key] = uid(key));
};


/***/ }),
/* 128 */
/***/ (function(module, exports, __webpack_require__) {

var dP = __webpack_require__(16);
var anObject = __webpack_require__(12);
var getKeys = __webpack_require__(38);

module.exports = __webpack_require__(13) ? Object.defineProperties : function defineProperties(O, Properties) {
  anObject(O);
  var keys = getKeys(Properties);
  var length = keys.length;
  var i = 0;
  var P;
  while (length > i) dP.f(O, P = keys[i++], Properties[P]);
  return O;
};


/***/ }),
/* 129 */
/***/ (function(module, exports, __webpack_require__) {

var document = __webpack_require__(8).document;
module.exports = document && document.documentElement;


/***/ }),
/* 130 */
/***/ (function(module, exports) {

// fast apply, http://jsperf.lnkit.com/fast-apply/5
module.exports = function (fn, args, that) {
  var un = that === undefined;
  switch (args.length) {
    case 0: return un ? fn()
                      : fn.call(that);
    case 1: return un ? fn(args[0])
                      : fn.call(that, args[0]);
    case 2: return un ? fn(args[0], args[1])
                      : fn.call(that, args[0], args[1]);
    case 3: return un ? fn(args[0], args[1], args[2])
                      : fn.call(that, args[0], args[1], args[2]);
    case 4: return un ? fn(args[0], args[1], args[2], args[3])
                      : fn.call(that, args[0], args[1], args[2], args[3]);
  } return fn.apply(that, args);
};


/***/ }),
/* 131 */
/***/ (function(module, exports, __webpack_require__) {

var _Reflect$construct = __webpack_require__(93);

function _isNativeReflectConstruct() {
  if (typeof Reflect === "undefined" || !_Reflect$construct) return false;
  if (_Reflect$construct.sham) return false;
  if (typeof Proxy === "function") return true;

  try {
    Date.prototype.toString.call(_Reflect$construct(Date, [], function () {}));
    return true;
  } catch (e) {
    return false;
  }
}

module.exports = _isNativeReflectConstruct;

/***/ }),
/* 132 */
/***/ (function(module, exports) {

module.exports = function (done, value) {
  return { value: value, done: !!done };
};


/***/ }),
/* 133 */
/***/ (function(module, exports, __webpack_require__) {

// call something on iterator step with safe closing on error
var anObject = __webpack_require__(12);
module.exports = function (iterator, fn, value, entries) {
  try {
    return entries ? fn(anObject(value)[0], value[1]) : fn(value);
  // 7.4.6 IteratorClose(iterator, completion)
  } catch (e) {
    var ret = iterator['return'];
    if (ret !== undefined) anObject(ret.call(iterator));
    throw e;
  }
};


/***/ }),
/* 134 */
/***/ (function(module, exports, __webpack_require__) {

// check on default Array iterator
var Iterators = __webpack_require__(34);
var ITERATOR = __webpack_require__(10)('iterator');
var ArrayProto = Array.prototype;

module.exports = function (it) {
  return it !== undefined && (Iterators.Array === it || ArrayProto[ITERATOR] === it);
};


/***/ }),
/* 135 */,
/* 136 */,
/* 137 */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(193);

/***/ }),
/* 138 */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(164);

/***/ }),
/* 139 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";

// ECMAScript 6 symbols shim
var global = __webpack_require__(8);
var has = __webpack_require__(19);
var DESCRIPTORS = __webpack_require__(13);
var $export = __webpack_require__(7);
var redefine = __webpack_require__(88);
var META = __webpack_require__(77).KEY;
var $fails = __webpack_require__(20);
var shared = __webpack_require__(71);
var setToStringTag = __webpack_require__(52);
var uid = __webpack_require__(51);
var wks = __webpack_require__(10);
var wksExt = __webpack_require__(74);
var wksDefine = __webpack_require__(75);
var enumKeys = __webpack_require__(170);
var isArray = __webpack_require__(95);
var anObject = __webpack_require__(12);
var isObject = __webpack_require__(9);
var toObject = __webpack_require__(31);
var toIObject = __webpack_require__(21);
var toPrimitive = __webpack_require__(69);
var createDesc = __webpack_require__(43);
var _create = __webpack_require__(47);
var gOPNExt = __webpack_require__(171);
var $GOPD = __webpack_require__(55);
var $GOPS = __webpack_require__(82);
var $DP = __webpack_require__(16);
var $keys = __webpack_require__(38);
var gOPD = $GOPD.f;
var dP = $DP.f;
var gOPN = gOPNExt.f;
var $Symbol = global.Symbol;
var $JSON = global.JSON;
var _stringify = $JSON && $JSON.stringify;
var PROTOTYPE = 'prototype';
var HIDDEN = wks('_hidden');
var TO_PRIMITIVE = wks('toPrimitive');
var isEnum = {}.propertyIsEnumerable;
var SymbolRegistry = shared('symbol-registry');
var AllSymbols = shared('symbols');
var OPSymbols = shared('op-symbols');
var ObjectProto = Object[PROTOTYPE];
var USE_NATIVE = typeof $Symbol == 'function' && !!$GOPS.f;
var QObject = global.QObject;
// Don't use setters in Qt Script, https://github.com/zloirock/core-js/issues/173
var setter = !QObject || !QObject[PROTOTYPE] || !QObject[PROTOTYPE].findChild;

// fallback for old Android, https://code.google.com/p/v8/issues/detail?id=687
var setSymbolDesc = DESCRIPTORS && $fails(function () {
  return _create(dP({}, 'a', {
    get: function () { return dP(this, 'a', { value: 7 }).a; }
  })).a != 7;
}) ? function (it, key, D) {
  var protoDesc = gOPD(ObjectProto, key);
  if (protoDesc) delete ObjectProto[key];
  dP(it, key, D);
  if (protoDesc && it !== ObjectProto) dP(ObjectProto, key, protoDesc);
} : dP;

var wrap = function (tag) {
  var sym = AllSymbols[tag] = _create($Symbol[PROTOTYPE]);
  sym._k = tag;
  return sym;
};

var isSymbol = USE_NATIVE && typeof $Symbol.iterator == 'symbol' ? function (it) {
  return typeof it == 'symbol';
} : function (it) {
  return it instanceof $Symbol;
};

var $defineProperty = function defineProperty(it, key, D) {
  if (it === ObjectProto) $defineProperty(OPSymbols, key, D);
  anObject(it);
  key = toPrimitive(key, true);
  anObject(D);
  if (has(AllSymbols, key)) {
    if (!D.enumerable) {
      if (!has(it, HIDDEN)) dP(it, HIDDEN, createDesc(1, {}));
      it[HIDDEN][key] = true;
    } else {
      if (has(it, HIDDEN) && it[HIDDEN][key]) it[HIDDEN][key] = false;
      D = _create(D, { enumerable: createDesc(0, false) });
    } return setSymbolDesc(it, key, D);
  } return dP(it, key, D);
};
var $defineProperties = function defineProperties(it, P) {
  anObject(it);
  var keys = enumKeys(P = toIObject(P));
  var i = 0;
  var l = keys.length;
  var key;
  while (l > i) $defineProperty(it, key = keys[i++], P[key]);
  return it;
};
var $create = function create(it, P) {
  return P === undefined ? _create(it) : $defineProperties(_create(it), P);
};
var $propertyIsEnumerable = function propertyIsEnumerable(key) {
  var E = isEnum.call(this, key = toPrimitive(key, true));
  if (this === ObjectProto && has(AllSymbols, key) && !has(OPSymbols, key)) return false;
  return E || !has(this, key) || !has(AllSymbols, key) || has(this, HIDDEN) && this[HIDDEN][key] ? E : true;
};
var $getOwnPropertyDescriptor = function getOwnPropertyDescriptor(it, key) {
  it = toIObject(it);
  key = toPrimitive(key, true);
  if (it === ObjectProto && has(AllSymbols, key) && !has(OPSymbols, key)) return;
  var D = gOPD(it, key);
  if (D && has(AllSymbols, key) && !(has(it, HIDDEN) && it[HIDDEN][key])) D.enumerable = true;
  return D;
};
var $getOwnPropertyNames = function getOwnPropertyNames(it) {
  var names = gOPN(toIObject(it));
  var result = [];
  var i = 0;
  var key;
  while (names.length > i) {
    if (!has(AllSymbols, key = names[i++]) && key != HIDDEN && key != META) result.push(key);
  } return result;
};
var $getOwnPropertySymbols = function getOwnPropertySymbols(it) {
  var IS_OP = it === ObjectProto;
  var names = gOPN(IS_OP ? OPSymbols : toIObject(it));
  var result = [];
  var i = 0;
  var key;
  while (names.length > i) {
    if (has(AllSymbols, key = names[i++]) && (IS_OP ? has(ObjectProto, key) : true)) result.push(AllSymbols[key]);
  } return result;
};

// 19.4.1.1 Symbol([description])
if (!USE_NATIVE) {
  $Symbol = function Symbol() {
    if (this instanceof $Symbol) throw TypeError('Symbol is not a constructor!');
    var tag = uid(arguments.length > 0 ? arguments[0] : undefined);
    var $set = function (value) {
      if (this === ObjectProto) $set.call(OPSymbols, value);
      if (has(this, HIDDEN) && has(this[HIDDEN], tag)) this[HIDDEN][tag] = false;
      setSymbolDesc(this, tag, createDesc(1, value));
    };
    if (DESCRIPTORS && setter) setSymbolDesc(ObjectProto, tag, { configurable: true, set: $set });
    return wrap(tag);
  };
  redefine($Symbol[PROTOTYPE], 'toString', function toString() {
    return this._k;
  });

  $GOPD.f = $getOwnPropertyDescriptor;
  $DP.f = $defineProperty;
  __webpack_require__(101).f = gOPNExt.f = $getOwnPropertyNames;
  __webpack_require__(48).f = $propertyIsEnumerable;
  $GOPS.f = $getOwnPropertySymbols;

  if (DESCRIPTORS && !__webpack_require__(46)) {
    redefine(ObjectProto, 'propertyIsEnumerable', $propertyIsEnumerable, true);
  }

  wksExt.f = function (name) {
    return wrap(wks(name));
  };
}

$export($export.G + $export.W + $export.F * !USE_NATIVE, { Symbol: $Symbol });

for (var es6Symbols = (
  // 19.4.2.2, 19.4.2.3, 19.4.2.4, 19.4.2.6, 19.4.2.8, 19.4.2.9, 19.4.2.10, 19.4.2.11, 19.4.2.12, 19.4.2.13, 19.4.2.14
  'hasInstance,isConcatSpreadable,iterator,match,replace,search,species,split,toPrimitive,toStringTag,unscopables'
).split(','), j = 0; es6Symbols.length > j;)wks(es6Symbols[j++]);

for (var wellKnownSymbols = $keys(wks.store), k = 0; wellKnownSymbols.length > k;) wksDefine(wellKnownSymbols[k++]);

$export($export.S + $export.F * !USE_NATIVE, 'Symbol', {
  // 19.4.2.1 Symbol.for(key)
  'for': function (key) {
    return has(SymbolRegistry, key += '')
      ? SymbolRegistry[key]
      : SymbolRegistry[key] = $Symbol(key);
  },
  // 19.4.2.5 Symbol.keyFor(sym)
  keyFor: function keyFor(sym) {
    if (!isSymbol(sym)) throw TypeError(sym + ' is not a symbol!');
    for (var key in SymbolRegistry) if (SymbolRegistry[key] === sym) return key;
  },
  useSetter: function () { setter = true; },
  useSimple: function () { setter = false; }
});

$export($export.S + $export.F * !USE_NATIVE, 'Object', {
  // 19.1.2.2 Object.create(O [, Properties])
  create: $create,
  // 19.1.2.4 Object.defineProperty(O, P, Attributes)
  defineProperty: $defineProperty,
  // 19.1.2.3 Object.defineProperties(O, Properties)
  defineProperties: $defineProperties,
  // 19.1.2.6 Object.getOwnPropertyDescriptor(O, P)
  getOwnPropertyDescriptor: $getOwnPropertyDescriptor,
  // 19.1.2.7 Object.getOwnPropertyNames(O)
  getOwnPropertyNames: $getOwnPropertyNames,
  // 19.1.2.8 Object.getOwnPropertySymbols(O)
  getOwnPropertySymbols: $getOwnPropertySymbols
});

// Chrome 38 and 39 `Object.getOwnPropertySymbols` fails on primitives
// https://bugs.chromium.org/p/v8/issues/detail?id=3443
var FAILS_ON_PRIMITIVES = $fails(function () { $GOPS.f(1); });

$export($export.S + $export.F * FAILS_ON_PRIMITIVES, 'Object', {
  getOwnPropertySymbols: function getOwnPropertySymbols(it) {
    return $GOPS.f(toObject(it));
  }
});

// 24.3.2 JSON.stringify(value [, replacer [, space]])
$JSON && $export($export.S + $export.F * (!USE_NATIVE || $fails(function () {
  var S = $Symbol();
  // MS Edge converts symbol values to JSON as {}
  // WebKit converts symbol values to JSON as null
  // V8 throws on boxed symbols
  return _stringify([S]) != '[null]' || _stringify({ a: S }) != '{}' || _stringify(Object(S)) != '{}';
})), 'JSON', {
  stringify: function stringify(it) {
    var args = [it];
    var i = 1;
    var replacer, $replacer;
    while (arguments.length > i) args.push(arguments[i++]);
    $replacer = replacer = args[1];
    if (!isObject(replacer) && it === undefined || isSymbol(it)) return; // IE8 returns string on undefined
    if (!isArray(replacer)) replacer = function (key, value) {
      if (typeof $replacer == 'function') value = $replacer.call(this, key, value);
      if (!isSymbol(value)) return value;
    };
    args[1] = replacer;
    return _stringify.apply($JSON, args);
  }
});

// 19.4.3.4 Symbol.prototype[@@toPrimitive](hint)
$Symbol[PROTOTYPE][TO_PRIMITIVE] || __webpack_require__(24)($Symbol[PROTOTYPE], TO_PRIMITIVE, $Symbol[PROTOTYPE].valueOf);
// 19.4.3.5 Symbol.prototype[@@toStringTag]
setToStringTag($Symbol, 'Symbol');
// 20.2.1.9 Math[@@toStringTag]
setToStringTag(Math, 'Math', true);
// 24.3.3 JSON[@@toStringTag]
setToStringTag(global.JSON, 'JSON', true);


/***/ }),
/* 140 */
/***/ (function(module, exports, __webpack_require__) {

// 9.4.2.3 ArraySpeciesCreate(originalArray, length)
var speciesConstructor = __webpack_require__(141);

module.exports = function (original, length) {
  return new (speciesConstructor(original))(length);
};


/***/ }),
/* 141 */
/***/ (function(module, exports, __webpack_require__) {

var isObject = __webpack_require__(26);
var isArray = __webpack_require__(142);
var SPECIES = __webpack_require__(11)('species');

module.exports = function (original) {
  var C;
  if (isArray(original)) {
    C = original.constructor;
    // cross-realm fallback
    if (typeof C == 'function' && (C === Array || isArray(C.prototype))) C = undefined;
    if (isObject(C)) {
      C = C[SPECIES];
      if (C === null) C = undefined;
    }
  } return C === undefined ? Array : C;
};


/***/ }),
/* 142 */
/***/ (function(module, exports, __webpack_require__) {

// 7.2.2 IsArray(argument)
var cof = __webpack_require__(37);
module.exports = Array.isArray || function isArray(arg) {
  return cof(arg) == 'Array';
};


/***/ }),
/* 143 */
/***/ (function(module, exports, __webpack_require__) {

// 7.3.20 SpeciesConstructor(O, defaultConstructor)
var anObject = __webpack_require__(18);
var aFunction = __webpack_require__(79);
var SPECIES = __webpack_require__(11)('species');
module.exports = function (O, D) {
  var C = anObject(O).constructor;
  var S;
  return C === undefined || (S = anObject(C)[SPECIES]) == undefined ? D : aFunction(S);
};


/***/ }),
/* 144 */
/***/ (function(module, exports, __webpack_require__) {

// 0 -> Array#forEach
// 1 -> Array#map
// 2 -> Array#filter
// 3 -> Array#some
// 4 -> Array#every
// 5 -> Array#find
// 6 -> Array#findIndex
var ctx = __webpack_require__(30);
var IObject = __webpack_require__(104);
var toObject = __webpack_require__(31);
var toLength = __webpack_require__(67);
var asc = __webpack_require__(236);
module.exports = function (TYPE, $create) {
  var IS_MAP = TYPE == 1;
  var IS_FILTER = TYPE == 2;
  var IS_SOME = TYPE == 3;
  var IS_EVERY = TYPE == 4;
  var IS_FIND_INDEX = TYPE == 6;
  var NO_HOLES = TYPE == 5 || IS_FIND_INDEX;
  var create = $create || asc;
  return function ($this, callbackfn, that) {
    var O = toObject($this);
    var self = IObject(O);
    var f = ctx(callbackfn, that, 3);
    var length = toLength(self.length);
    var index = 0;
    var result = IS_MAP ? create($this, length) : IS_FILTER ? create($this, 0) : undefined;
    var val, res;
    for (;length > index; index++) if (NO_HOLES || index in self) {
      val = self[index];
      res = f(val, index, O);
      if (TYPE) {
        if (IS_MAP) result[index] = res;   // map
        else if (res) switch (TYPE) {
          case 3: return true;             // some
          case 5: return val;              // find
          case 6: return index;            // findIndex
          case 2: result.push(val);        // filter
        } else if (IS_EVERY) return false; // every
      }
    }
    return IS_FIND_INDEX ? -1 : IS_SOME || IS_EVERY ? IS_EVERY : result;
  };
};


/***/ }),
/* 145 */,
/* 146 */
/***/ (function(module, exports, __webpack_require__) {

// false -> Array#indexOf
// true  -> Array#includes
var toIObject = __webpack_require__(96);
var toLength = __webpack_require__(41);
var toAbsoluteIndex = __webpack_require__(186);
module.exports = function (IS_INCLUDES) {
  return function ($this, el, fromIndex) {
    var O = toIObject($this);
    var length = toLength(O.length);
    var index = toAbsoluteIndex(fromIndex, length);
    var value;
    // Array#includes uses SameValueZero equality algorithm
    // eslint-disable-next-line no-self-compare
    if (IS_INCLUDES && el != el) while (length > index) {
      value = O[index++];
      // eslint-disable-next-line no-self-compare
      if (value != value) return true;
    // Array#indexOf ignores holes, Array#includes - not
    } else for (;length > index; index++) if (IS_INCLUDES || index in O) {
      if (O[index] === el) return IS_INCLUDES || index || 0;
    } return !IS_INCLUDES && -1;
  };
};


/***/ }),
/* 147 */
/***/ (function(module, exports) {

// IE 8- don't enum bug keys
module.exports = (
  'constructor,hasOwnProperty,isPrototypeOf,propertyIsEnumerable,toLocaleString,toString,valueOf'
).split(',');


/***/ }),
/* 148 */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(149);
var $Object = __webpack_require__(6).Object;
module.exports = function defineProperty(it, key, desc) {
  return $Object.defineProperty(it, key, desc);
};


/***/ }),
/* 149 */
/***/ (function(module, exports, __webpack_require__) {

var $export = __webpack_require__(7);
// 19.1.2.4 / 15.2.3.6 Object.defineProperty(O, P, Attributes)
$export($export.S + $export.F * !__webpack_require__(13), 'Object', { defineProperty: __webpack_require__(16).f });


/***/ }),
/* 150 */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(151);

/***/ }),
/* 151 */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(152);
module.exports = __webpack_require__(6).Object.getPrototypeOf;


/***/ }),
/* 152 */
/***/ (function(module, exports, __webpack_require__) {

// 19.1.2.9 Object.getPrototypeOf(O)
var toObject = __webpack_require__(31);
var $getPrototypeOf = __webpack_require__(80);

__webpack_require__(84)('getPrototypeOf', function () {
  return function getPrototypeOf(it) {
    return $getPrototypeOf(toObject(it));
  };
});


/***/ }),
/* 153 */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(154);
module.exports = __webpack_require__(6).Object.setPrototypeOf;


/***/ }),
/* 154 */
/***/ (function(module, exports, __webpack_require__) {

// 19.1.3.19 Object.setPrototypeOf(O, proto)
var $export = __webpack_require__(7);
$export($export.S, 'Object', { setPrototypeOf: __webpack_require__(155).set });


/***/ }),
/* 155 */
/***/ (function(module, exports, __webpack_require__) {

// Works with __proto__ only. Old v8 can't work with null proto objects.
/* eslint-disable no-proto */
var isObject = __webpack_require__(9);
var anObject = __webpack_require__(12);
var check = function (O, proto) {
  anObject(O);
  if (!isObject(proto) && proto !== null) throw TypeError(proto + ": can't set as prototype!");
};
module.exports = {
  set: Object.setPrototypeOf || ('__proto__' in {} ? // eslint-disable-line
    function (test, buggy, set) {
      try {
        set = __webpack_require__(30)(Function.call, __webpack_require__(55).f(Object.prototype, '__proto__').set, 2);
        set(test, []);
        buggy = !(test instanceof Array);
      } catch (e) { buggy = true; }
      return function setPrototypeOf(O, proto) {
        check(O, proto);
        if (buggy) O.__proto__ = proto;
        else set(O, proto);
        return O;
      };
    }({}, false) : undefined),
  check: check
};


/***/ }),
/* 156 */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(157);
var $Object = __webpack_require__(6).Object;
module.exports = function create(P, D) {
  return $Object.create(P, D);
};


/***/ }),
/* 157 */
/***/ (function(module, exports, __webpack_require__) {

var $export = __webpack_require__(7);
// 19.1.2.2 / 15.2.3.5 Object.create(O [, Properties])
$export($export.S, 'Object', { create: __webpack_require__(47) });


/***/ }),
/* 158 */
/***/ (function(module, exports, __webpack_require__) {

// false -> Array#indexOf
// true  -> Array#includes
var toIObject = __webpack_require__(21);
var toLength = __webpack_require__(67);
var toAbsoluteIndex = __webpack_require__(159);
module.exports = function (IS_INCLUDES) {
  return function ($this, el, fromIndex) {
    var O = toIObject($this);
    var length = toLength(O.length);
    var index = toAbsoluteIndex(fromIndex, length);
    var value;
    // Array#includes uses SameValueZero equality algorithm
    // eslint-disable-next-line no-self-compare
    if (IS_INCLUDES && el != el) while (length > index) {
      value = O[index++];
      // eslint-disable-next-line no-self-compare
      if (value != value) return true;
    // Array#indexOf ignores holes, Array#includes - not
    } else for (;length > index; index++) if (IS_INCLUDES || index in O) {
      if (O[index] === el) return IS_INCLUDES || index || 0;
    } return !IS_INCLUDES && -1;
  };
};


/***/ }),
/* 159 */
/***/ (function(module, exports, __webpack_require__) {

var toInteger = __webpack_require__(72);
var max = Math.max;
var min = Math.min;
module.exports = function (index, length) {
  index = toInteger(index);
  return index < 0 ? max(index + length, 0) : min(index, length);
};


/***/ }),
/* 160 */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(161);
module.exports = __webpack_require__(6).Reflect.construct;


/***/ }),
/* 161 */
/***/ (function(module, exports, __webpack_require__) {

// 26.1.2 Reflect.construct(target, argumentsList [, newTarget])
var $export = __webpack_require__(7);
var create = __webpack_require__(47);
var aFunction = __webpack_require__(42);
var anObject = __webpack_require__(12);
var isObject = __webpack_require__(9);
var fails = __webpack_require__(20);
var bind = __webpack_require__(162);
var rConstruct = (__webpack_require__(8).Reflect || {}).construct;

// MS Edge supports only 2 arguments and argumentsList argument is optional
// FF Nightly sets third argument as `new.target`, but does not create `this` from it
var NEW_TARGET_BUG = fails(function () {
  function F() { /* empty */ }
  return !(rConstruct(function () { /* empty */ }, [], F) instanceof F);
});
var ARGS_BUG = !fails(function () {
  rConstruct(function () { /* empty */ });
});

$export($export.S + $export.F * (NEW_TARGET_BUG || ARGS_BUG), 'Reflect', {
  construct: function construct(Target, args /* , newTarget */) {
    aFunction(Target);
    anObject(args);
    var newTarget = arguments.length < 3 ? Target : aFunction(arguments[2]);
    if (ARGS_BUG && !NEW_TARGET_BUG) return rConstruct(Target, args, newTarget);
    if (Target == newTarget) {
      // w/o altered newTarget, optimization for 0-4 arguments
      switch (args.length) {
        case 0: return new Target();
        case 1: return new Target(args[0]);
        case 2: return new Target(args[0], args[1]);
        case 3: return new Target(args[0], args[1], args[2]);
        case 4: return new Target(args[0], args[1], args[2], args[3]);
      }
      // w/o altered newTarget, lot of arguments case
      var $args = [null];
      $args.push.apply($args, args);
      return new (bind.apply(Target, $args))();
    }
    // with altered newTarget, not support built-in constructors
    var proto = newTarget.prototype;
    var instance = create(isObject(proto) ? proto : Object.prototype);
    var result = Function.apply.call(Target, instance, args);
    return isObject(result) ? result : instance;
  }
});


/***/ }),
/* 162 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";

var aFunction = __webpack_require__(42);
var isObject = __webpack_require__(9);
var invoke = __webpack_require__(130);
var arraySlice = [].slice;
var factories = {};

var construct = function (F, len, args) {
  if (!(len in factories)) {
    for (var n = [], i = 0; i < len; i++) n[i] = 'a[' + i + ']';
    // eslint-disable-next-line no-new-func
    factories[len] = Function('F,a', 'return new F(' + n.join(',') + ')');
  } return factories[len](F, args);
};

module.exports = Function.bind || function bind(that /* , ...args */) {
  var fn = aFunction(this);
  var partArgs = arraySlice.call(arguments, 1);
  var bound = function (/* args... */) {
    var args = partArgs.concat(arraySlice.call(arguments));
    return this instanceof bound ? construct(fn, args.length, args) : invoke(fn, args, that);
  };
  if (isObject(fn.prototype)) bound.prototype = fn.prototype;
  return bound;
};


/***/ }),
/* 163 */
/***/ (function(module, exports, __webpack_require__) {

var _typeof = __webpack_require__(40);

var assertThisInitialized = __webpack_require__(49);

function _possibleConstructorReturn(self, call) {
  if (call && (_typeof(call) === "object" || typeof call === "function")) {
    return call;
  }

  return assertThisInitialized(self);
}

module.exports = _possibleConstructorReturn;

/***/ }),
/* 164 */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(57);
__webpack_require__(60);
module.exports = __webpack_require__(74).f('iterator');


/***/ }),
/* 165 */
/***/ (function(module, exports, __webpack_require__) {

var toInteger = __webpack_require__(72);
var defined = __webpack_require__(56);
// true  -> String#at
// false -> String#codePointAt
module.exports = function (TO_STRING) {
  return function (that, pos) {
    var s = String(defined(that));
    var i = toInteger(pos);
    var l = s.length;
    var a, b;
    if (i < 0 || i >= l) return TO_STRING ? '' : undefined;
    a = s.charCodeAt(i);
    return a < 0xd800 || a > 0xdbff || i + 1 === l || (b = s.charCodeAt(i + 1)) < 0xdc00 || b > 0xdfff
      ? TO_STRING ? s.charAt(i) : a
      : TO_STRING ? s.slice(i, i + 2) : (a - 0xd800 << 10) + (b - 0xdc00) + 0x10000;
  };
};


/***/ }),
/* 166 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";

var create = __webpack_require__(47);
var descriptor = __webpack_require__(43);
var setToStringTag = __webpack_require__(52);
var IteratorPrototype = {};

// 25.1.2.1.1 %IteratorPrototype%[@@iterator]()
__webpack_require__(24)(IteratorPrototype, __webpack_require__(10)('iterator'), function () { return this; });

module.exports = function (Constructor, NAME, next) {
  Constructor.prototype = create(IteratorPrototype, { next: descriptor(1, next) });
  setToStringTag(Constructor, NAME + ' Iterator');
};


/***/ }),
/* 167 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";

var addToUnscopables = __webpack_require__(168);
var step = __webpack_require__(132);
var Iterators = __webpack_require__(34);
var toIObject = __webpack_require__(21);

// 22.1.3.4 Array.prototype.entries()
// 22.1.3.13 Array.prototype.keys()
// 22.1.3.29 Array.prototype.values()
// 22.1.3.30 Array.prototype[@@iterator]()
module.exports = __webpack_require__(94)(Array, 'Array', function (iterated, kind) {
  this._t = toIObject(iterated); // target
  this._i = 0;                   // next index
  this._k = kind;                // kind
// 22.1.5.2.1 %ArrayIteratorPrototype%.next()
}, function () {
  var O = this._t;
  var kind = this._k;
  var index = this._i++;
  if (!O || index >= O.length) {
    this._t = undefined;
    return step(1);
  }
  if (kind == 'keys') return step(0, index);
  if (kind == 'values') return step(0, O[index]);
  return step(0, [index, O[index]]);
}, 'values');

// argumentsList[@@iterator] is %ArrayProto_values% (9.4.4.6, 9.4.4.7)
Iterators.Arguments = Iterators.Array;

addToUnscopables('keys');
addToUnscopables('values');
addToUnscopables('entries');


/***/ }),
/* 168 */
/***/ (function(module, exports) {

module.exports = function () { /* empty */ };


/***/ }),
/* 169 */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(139);
__webpack_require__(106);
__webpack_require__(172);
__webpack_require__(173);
module.exports = __webpack_require__(6).Symbol;


/***/ }),
/* 170 */
/***/ (function(module, exports, __webpack_require__) {

// all enumerable object keys, includes symbols
var getKeys = __webpack_require__(38);
var gOPS = __webpack_require__(82);
var pIE = __webpack_require__(48);
module.exports = function (it) {
  var result = getKeys(it);
  var getSymbols = gOPS.f;
  if (getSymbols) {
    var symbols = getSymbols(it);
    var isEnum = pIE.f;
    var i = 0;
    var key;
    while (symbols.length > i) if (isEnum.call(it, key = symbols[i++])) result.push(key);
  } return result;
};


/***/ }),
/* 171 */
/***/ (function(module, exports, __webpack_require__) {

// fallback for IE11 buggy Object.getOwnPropertyNames with iframe and window
var toIObject = __webpack_require__(21);
var gOPN = __webpack_require__(101).f;
var toString = {}.toString;

var windowNames = typeof window == 'object' && window && Object.getOwnPropertyNames
  ? Object.getOwnPropertyNames(window) : [];

var getWindowNames = function (it) {
  try {
    return gOPN(it);
  } catch (e) {
    return windowNames.slice();
  }
};

module.exports.f = function getOwnPropertyNames(it) {
  return windowNames && toString.call(it) == '[object Window]' ? getWindowNames(it) : gOPN(toIObject(it));
};


/***/ }),
/* 172 */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(75)('asyncIterator');


/***/ }),
/* 173 */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(75)('observable');


/***/ }),
/* 174 */
/***/ (function(module, exports, __webpack_require__) {

var DESCRIPTORS = __webpack_require__(13);
var getKeys = __webpack_require__(38);
var toIObject = __webpack_require__(21);
var isEnum = __webpack_require__(48).f;
module.exports = function (isEntries) {
  return function (it) {
    var O = toIObject(it);
    var keys = getKeys(O);
    var length = keys.length;
    var i = 0;
    var result = [];
    var key;
    while (length > i) {
      key = keys[i++];
      if (!DESCRIPTORS || isEnum.call(O, key)) {
        result.push(isEntries ? [key, O[key]] : O[key]);
      }
    }
    return result;
  };
};


/***/ }),
/* 175 */,
/* 176 */,
/* 177 */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(280);

/***/ }),
/* 178 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";

var addToUnscopables = __webpack_require__(78);
var step = __webpack_require__(258);
var Iterators = __webpack_require__(122);
var toIObject = __webpack_require__(96);

// 22.1.3.4 Array.prototype.entries()
// 22.1.3.13 Array.prototype.keys()
// 22.1.3.29 Array.prototype.values()
// 22.1.3.30 Array.prototype[@@iterator]()
module.exports = __webpack_require__(259)(Array, 'Array', function (iterated, kind) {
  this._t = toIObject(iterated); // target
  this._i = 0;                   // next index
  this._k = kind;                // kind
// 22.1.5.2.1 %ArrayIteratorPrototype%.next()
}, function () {
  var O = this._t;
  var kind = this._k;
  var index = this._i++;
  if (!O || index >= O.length) {
    this._t = undefined;
    return step(1);
  }
  if (kind == 'keys') return step(0, index);
  if (kind == 'values') return step(0, O[index]);
  return step(0, [index, O[index]]);
}, 'values');

// argumentsList[@@iterator] is %ArrayProto_values% (9.4.4.6, 9.4.4.7)
Iterators.Arguments = Iterators.Array;

addToUnscopables('keys');
addToUnscopables('values');
addToUnscopables('entries');


/***/ }),
/* 179 */
/***/ (function(module, exports, __webpack_require__) {

var def = __webpack_require__(44).f;
var has = __webpack_require__(54);
var TAG = __webpack_require__(11)('toStringTag');

module.exports = function (it, tag, stat) {
  if (it && !has(it = stat ? it : it.prototype, TAG)) def(it, TAG, { configurable: true, value: tag });
};


/***/ }),
/* 180 */,
/* 181 */
/***/ (function(module, exports, __webpack_require__) {

var toInteger = __webpack_require__(50);
var defined = __webpack_require__(36);
// true  -> String#at
// false -> String#codePointAt
module.exports = function (TO_STRING) {
  return function (that, pos) {
    var s = String(defined(that));
    var i = toInteger(pos);
    var l = s.length;
    var a, b;
    if (i < 0 || i >= l) return TO_STRING ? '' : undefined;
    a = s.charCodeAt(i);
    return a < 0xd800 || a > 0xdbff || i + 1 === l || (b = s.charCodeAt(i + 1)) < 0xdc00 || b > 0xdfff
      ? TO_STRING ? s.charAt(i) : a
      : TO_STRING ? s.slice(i, i + 2) : (a - 0xd800 << 10) + (b - 0xdc00) + 0x10000;
  };
};


/***/ }),
/* 182 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";

var regexpExec = __webpack_require__(83);
__webpack_require__(32)({
  target: 'RegExp',
  proto: true,
  forced: regexpExec !== /./.exec
}, {
  exec: regexpExec
});


/***/ }),
/* 183 */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(273);

/***/ }),
/* 184 */
/***/ (function(module, exports, __webpack_require__) {

var _Array$from = __webpack_require__(203);

var arrayLikeToArray = __webpack_require__(205);

function _unsupportedIterableToArray(o, minLen) {
  if (!o) return;
  if (typeof o === "string") return arrayLikeToArray(o, minLen);
  var n = Object.prototype.toString.call(o).slice(8, -1);
  if (n === "Object" && o.constructor) n = o.constructor.name;
  if (n === "Map" || n === "Set") return _Array$from(o);
  if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return arrayLikeToArray(o, minLen);
}

module.exports = _unsupportedIterableToArray;

/***/ }),
/* 185 */
/***/ (function(module, exports, __webpack_require__) {

var ITERATOR = __webpack_require__(10)('iterator');
var SAFE_CLOSING = false;

try {
  var riter = [7][ITERATOR]();
  riter['return'] = function () { SAFE_CLOSING = true; };
  // eslint-disable-next-line no-throw-literal
  Array.from(riter, function () { throw 2; });
} catch (e) { /* empty */ }

module.exports = function (exec, skipClosing) {
  if (!skipClosing && !SAFE_CLOSING) return false;
  var safe = false;
  try {
    var arr = [7];
    var iter = arr[ITERATOR]();
    iter.next = function () { return { done: safe = true }; };
    arr[ITERATOR] = function () { return iter; };
    exec(arr);
  } catch (e) { /* empty */ }
  return safe;
};


/***/ }),
/* 186 */
/***/ (function(module, exports, __webpack_require__) {

var toInteger = __webpack_require__(50);
var max = Math.max;
var min = Math.min;
module.exports = function (index, length) {
  index = toInteger(index);
  return index < 0 ? max(index + length, 0) : min(index, length);
};


/***/ }),
/* 187 */,
/* 188 */
/***/ (function(module, exports, __webpack_require__) {

// 19.1.2.14 / 15.2.3.14 Object.keys(O)
var $keys = __webpack_require__(209);
var enumBugKeys = __webpack_require__(147);

module.exports = Object.keys || function keys(O) {
  return $keys(O, enumBugKeys);
};


/***/ }),
/* 189 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var _interopRequireDefault = __webpack_require__(0);

var _Object$defineProperty = __webpack_require__(1);

_Object$defineProperty(exports, "__esModule", {
  value: true
});

exports.default = exports.After = void 0;

var _classCallCheck2 = _interopRequireDefault(__webpack_require__(2));

var _createClass2 = _interopRequireDefault(__webpack_require__(3));

var _inherits2 = _interopRequireDefault(__webpack_require__(4));

var _createSuper2 = _interopRequireDefault(__webpack_require__(5));

var _base = _interopRequireDefault(__webpack_require__(242));

var After = /*#__PURE__*/function (_Base) {
  (0, _inherits2.default)(After, _Base);

  var _super = (0, _createSuper2.default)(After);

  function After() {
    (0, _classCallCheck2.default)(this, After);
    return _super.apply(this, arguments);
  }

  (0, _createClass2.default)(After, [{
    key: "register",
    value: function register() {
      $e.hooks.registerDataAfter(this);
    }
  }]);
  return After;
}(_base.default);

exports.After = After;
var _default = After;
exports.default = _default;

/***/ }),
/* 190 */,
/* 191 */,
/* 192 */,
/* 193 */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(194);
var $Object = __webpack_require__(6).Object;
module.exports = function getOwnPropertyDescriptor(it, key) {
  return $Object.getOwnPropertyDescriptor(it, key);
};


/***/ }),
/* 194 */
/***/ (function(module, exports, __webpack_require__) {

// 19.1.2.6 Object.getOwnPropertyDescriptor(O, P)
var toIObject = __webpack_require__(21);
var $getOwnPropertyDescriptor = __webpack_require__(55).f;

__webpack_require__(84)('getOwnPropertyDescriptor', function () {
  return function getOwnPropertyDescriptor(it, key) {
    return $getOwnPropertyDescriptor(toIObject(it), key);
  };
});


/***/ }),
/* 195 */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(196);

/***/ }),
/* 196 */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(197);
module.exports = __webpack_require__(6).Reflect.get;


/***/ }),
/* 197 */
/***/ (function(module, exports, __webpack_require__) {

// 26.1.6 Reflect.get(target, propertyKey [, receiver])
var gOPD = __webpack_require__(55);
var getPrototypeOf = __webpack_require__(80);
var has = __webpack_require__(19);
var $export = __webpack_require__(7);
var isObject = __webpack_require__(9);
var anObject = __webpack_require__(12);

function get(target, propertyKey /* , receiver */) {
  var receiver = arguments.length < 3 ? target : arguments[2];
  var desc, proto;
  if (anObject(target) === receiver) return target[propertyKey];
  if (desc = gOPD.f(target, propertyKey)) return has(desc, 'value')
    ? desc.value
    : desc.get !== undefined
      ? desc.get.call(receiver)
      : undefined;
  if (isObject(proto = getPrototypeOf(target))) return get(proto, propertyKey, receiver);
}

$export($export.S, 'Reflect', { get: get });


/***/ }),
/* 198 */
/***/ (function(module, exports, __webpack_require__) {

var getPrototypeOf = __webpack_require__(14);

function _superPropBase(object, property) {
  while (!Object.prototype.hasOwnProperty.call(object, property)) {
    object = getPrototypeOf(object);
    if (object === null) break;
  }

  return object;
}

module.exports = _superPropBase;

/***/ }),
/* 199 */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(200);
module.exports = __webpack_require__(6).Object.keys;


/***/ }),
/* 200 */
/***/ (function(module, exports, __webpack_require__) {

// 19.1.2.14 Object.keys(O)
var toObject = __webpack_require__(31);
var $keys = __webpack_require__(38);

__webpack_require__(84)('keys', function () {
  return function keys(it) {
    return $keys(toObject(it));
  };
});


/***/ }),
/* 201 */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(222);

/***/ }),
/* 202 */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(224);

/***/ }),
/* 203 */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(226);

/***/ }),
/* 204 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";

var $defineProperty = __webpack_require__(16);
var createDesc = __webpack_require__(43);

module.exports = function (object, index, value) {
  if (index in object) $defineProperty.f(object, index, createDesc(0, value));
  else object[index] = value;
};


/***/ }),
/* 205 */
/***/ (function(module, exports) {

function _arrayLikeToArray(arr, len) {
  if (len == null || len > arr.length) len = arr.length;

  for (var i = 0, arr2 = new Array(len); i < len; i++) {
    arr2[i] = arr[i];
  }

  return arr2;
}

module.exports = _arrayLikeToArray;

/***/ }),
/* 206 */,
/* 207 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var _Object$defineProperty = __webpack_require__(1);

_Object$defineProperty(exports, "__esModule", {
  value: true
});

exports.default = void 0;
var userAgent = navigator.userAgent;
var _default = {
  webkit: -1 !== userAgent.indexOf('AppleWebKit'),
  firefox: -1 !== userAgent.indexOf('Firefox'),
  ie: /Trident|MSIE/.test(userAgent),
  edge: -1 !== userAgent.indexOf('Edge'),
  mac: -1 !== userAgent.indexOf('Macintosh')
};
exports.default = _default;

/***/ }),
/* 208 */,
/* 209 */
/***/ (function(module, exports, __webpack_require__) {

var has = __webpack_require__(54);
var toIObject = __webpack_require__(96);
var arrayIndexOf = __webpack_require__(146)(false);
var IE_PROTO = __webpack_require__(127)('IE_PROTO');

module.exports = function (object, names) {
  var O = toIObject(object);
  var i = 0;
  var result = [];
  var key;
  for (key in O) if (key != IE_PROTO) has(O, key) && result.push(key);
  // Don't enum bug & hidden keys
  while (names.length > i) if (has(O, key = names[i++])) {
    ~arrayIndexOf(result, key) || result.push(key);
  }
  return result;
};


/***/ }),
/* 210 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var _interopRequireDefault = __webpack_require__(0);

var _Object$defineProperty = __webpack_require__(1);

_Object$defineProperty(exports, "__esModule", {
  value: true
});

exports.default = void 0;

var _typeof2 = _interopRequireDefault(__webpack_require__(40));

var _classCallCheck2 = _interopRequireDefault(__webpack_require__(2));

var _createClass2 = _interopRequireDefault(__webpack_require__(3));

var ArgsObject = /*#__PURE__*/function () {
  /**
   * Function constructor().
   *
   * Create ArgsObject.
   *
   * @param {{}} args
   */
  function ArgsObject(args) {
    (0, _classCallCheck2.default)(this, ArgsObject);
    this.args = args;
  }
  /**
   * Function requireArgument().
   *
   * Validate property in args.
   *
   * @param {string} property
   * @param {{}} args
   *
   * @throws {Error}
   *
   */


  (0, _createClass2.default)(ArgsObject, [{
    key: "requireArgument",
    value: function requireArgument(property) {
      var args = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : this.args;

      if (!args.hasOwnProperty(property)) {
        throw Error("".concat(property, " is required."));
      }
    }
    /**
     * Function requireArgumentType().
     *
     * Validate property in args using `type === typeof(args.whatever)`.
     *
     * @param {string} property
     * @param {string} type
     * @param {{}} args
     *
     * @throws {Error}
     *
     */

  }, {
    key: "requireArgumentType",
    value: function requireArgumentType(property, type) {
      var args = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : this.args;
      this.requireArgument(property, args);

      if ((0, _typeof2.default)(args[property]) !== type) {
        throw Error("".concat(property, " invalid type: ").concat(type, "."));
      }
    }
    /**
     * Function requireArgumentInstance().
     *
     * Validate property in args using `args.whatever instanceof instance`.
     *
     * @param {string} property
     * @param {instanceof} instance
     * @param {{}} args
     *
     * @throws {Error}
     *
     */

  }, {
    key: "requireArgumentInstance",
    value: function requireArgumentInstance(property, instance) {
      var args = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : this.args;
      this.requireArgument(property, args);

      if (!(args[property] instanceof instance)) {
        throw Error("".concat(property, " invalid instance."));
      }
    }
    /**
     * Function requireArgumentConstructor().
     *
     * Validate property in args using `type === args.whatever.constructor`.
     *
     * @param {string} property
     * @param {*} type
     * @param {{}} args
     *
     * @throws {Error}
     *
     */

  }, {
    key: "requireArgumentConstructor",
    value: function requireArgumentConstructor(property, type) {
      var args = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : this.args;
      this.requireArgument(property, args);

      if (args[property].constructor !== type) {
        throw Error("".concat(property, " invalid constructor type."));
      }
    }
  }]);
  return ArgsObject;
}();

exports.default = ArgsObject;

/***/ }),
/* 211 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var _interopRequireDefault = __webpack_require__(0);

var _Object$defineProperty = __webpack_require__(1);

_Object$defineProperty(exports, "__esModule", {
  value: true
});

exports.default = void 0;

var _classCallCheck2 = _interopRequireDefault(__webpack_require__(2));

var _inherits2 = _interopRequireDefault(__webpack_require__(4));

var _createSuper2 = _interopRequireDefault(__webpack_require__(5));

var _commandBase = _interopRequireDefault(__webpack_require__(39));

var CommandInternalBase = /*#__PURE__*/function (_CommandBase) {
  (0, _inherits2.default)(CommandInternalBase, _CommandBase);

  var _super = (0, _createSuper2.default)(CommandInternalBase);

  function CommandInternalBase(args) {
    var commandsAPI = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : $e.commandsInternal;
    (0, _classCallCheck2.default)(this, CommandInternalBase);
    return _super.call(this, args, commandsAPI);
  }

  return CommandInternalBase;
}(_commandBase.default);

exports.default = CommandInternalBase;

/***/ }),
/* 212 */,
/* 213 */,
/* 214 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";

var global = __webpack_require__(8);
var $export = __webpack_require__(7);
var meta = __webpack_require__(77);
var fails = __webpack_require__(20);
var hide = __webpack_require__(24);
var redefineAll = __webpack_require__(124);
var forOf = __webpack_require__(86);
var anInstance = __webpack_require__(125);
var isObject = __webpack_require__(9);
var setToStringTag = __webpack_require__(52);
var dP = __webpack_require__(16).f;
var each = __webpack_require__(144)(0);
var DESCRIPTORS = __webpack_require__(13);

module.exports = function (NAME, wrapper, methods, common, IS_MAP, IS_WEAK) {
  var Base = global[NAME];
  var C = Base;
  var ADDER = IS_MAP ? 'set' : 'add';
  var proto = C && C.prototype;
  var O = {};
  if (!DESCRIPTORS || typeof C != 'function' || !(IS_WEAK || proto.forEach && !fails(function () {
    new C().entries().next();
  }))) {
    // create collection constructor
    C = common.getConstructor(wrapper, NAME, IS_MAP, ADDER);
    redefineAll(C.prototype, methods);
    meta.NEED = true;
  } else {
    C = wrapper(function (target, iterable) {
      anInstance(target, C, NAME, '_c');
      target._c = new Base();
      if (iterable != undefined) forOf(iterable, IS_MAP, target[ADDER], target);
    });
    each('add,clear,delete,forEach,get,has,set,keys,values,entries,toJSON'.split(','), function (KEY) {
      var IS_ADDER = KEY == 'add' || KEY == 'set';
      if (KEY in proto && !(IS_WEAK && KEY == 'clear')) hide(C.prototype, KEY, function (a, b) {
        anInstance(this, C, KEY);
        if (!IS_ADDER && IS_WEAK && !isObject(a)) return KEY == 'get' ? undefined : false;
        var result = this._c[KEY](a === 0 ? 0 : a, b);
        return IS_ADDER ? this : result;
      });
    });
    IS_WEAK || dP(C.prototype, 'size', {
      get: function () {
        return this._c.size;
      }
    });
  }

  setToStringTag(C, NAME);

  O[NAME] = C;
  $export($export.G + $export.W + $export.F, O);

  if (!IS_WEAK) common.setStrong(C, NAME, IS_MAP);

  return C;
};


/***/ }),
/* 215 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";

// https://tc39.github.io/proposal-setmap-offrom/
var $export = __webpack_require__(7);

module.exports = function (COLLECTION) {
  $export($export.S, COLLECTION, { of: function of() {
    var length = arguments.length;
    var A = new Array(length);
    while (length--) A[length] = arguments[length];
    return new this(A);
  } });
};


/***/ }),
/* 216 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";

// https://tc39.github.io/proposal-setmap-offrom/
var $export = __webpack_require__(7);
var aFunction = __webpack_require__(42);
var ctx = __webpack_require__(30);
var forOf = __webpack_require__(86);

module.exports = function (COLLECTION) {
  $export($export.S, COLLECTION, { from: function from(source /* , mapFn, thisArg */) {
    var mapFn = arguments[1];
    var mapping, A, n, cb;
    aFunction(this);
    mapping = mapFn !== undefined;
    if (mapping) aFunction(mapFn);
    if (source == undefined) return new this();
    A = [];
    if (mapping) {
      n = 0;
      cb = ctx(mapFn, arguments[2], 2);
      forOf(source, false, function (nextItem) {
        A.push(cb(nextItem, n++));
      });
    } else {
      forOf(source, false, A.push, A);
    }
    return new this(A);
  } });
};


/***/ }),
/* 217 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var _interopRequireDefault = __webpack_require__(0);

var _Object$defineProperty = __webpack_require__(1);

_Object$defineProperty(exports, "__esModule", {
  value: true
});

exports.default = exports.After = void 0;

var _classCallCheck2 = _interopRequireDefault(__webpack_require__(2));

var _createClass2 = _interopRequireDefault(__webpack_require__(3));

var _inherits2 = _interopRequireDefault(__webpack_require__(4));

var _createSuper2 = _interopRequireDefault(__webpack_require__(5));

var _base = _interopRequireDefault(__webpack_require__(272));

var After = /*#__PURE__*/function (_Base) {
  (0, _inherits2.default)(After, _Base);

  var _super = (0, _createSuper2.default)(After);

  function After() {
    (0, _classCallCheck2.default)(this, After);
    return _super.apply(this, arguments);
  }

  (0, _createClass2.default)(After, [{
    key: "register",
    value: function register() {
      $e.hooks.registerUIAfter(this);
    }
  }]);
  return After;
}(_base.default);

exports.After = After;
var _default = After;
exports.default = _default;

/***/ }),
/* 218 */
/***/ (function(module, exports, __webpack_require__) {

var _Array$isArray = __webpack_require__(117);

function _arrayWithHoles(arr) {
  if (_Array$isArray(arr)) return arr;
}

module.exports = _arrayWithHoles;

/***/ }),
/* 219 */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(220);
module.exports = __webpack_require__(6).Array.isArray;


/***/ }),
/* 220 */
/***/ (function(module, exports, __webpack_require__) {

// 22.1.2.2 / 15.4.3.2 Array.isArray(arg)
var $export = __webpack_require__(7);

$export($export.S, 'Array', { isArray: __webpack_require__(95) });


/***/ }),
/* 221 */
/***/ (function(module, exports, __webpack_require__) {

var _getIterator = __webpack_require__(201);

var _isIterable = __webpack_require__(202);

var _Symbol = __webpack_require__(105);

function _iterableToArrayLimit(arr, i) {
  if (typeof _Symbol === "undefined" || !_isIterable(Object(arr))) return;
  var _arr = [];
  var _n = true;
  var _d = false;
  var _e = undefined;

  try {
    for (var _i = _getIterator(arr), _s; !(_n = (_s = _i.next()).done); _n = true) {
      _arr.push(_s.value);

      if (i && _arr.length === i) break;
    }
  } catch (err) {
    _d = true;
    _e = err;
  } finally {
    try {
      if (!_n && _i["return"] != null) _i["return"]();
    } finally {
      if (_d) throw _e;
    }
  }

  return _arr;
}

module.exports = _iterableToArrayLimit;

/***/ }),
/* 222 */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(60);
__webpack_require__(57);
module.exports = __webpack_require__(223);


/***/ }),
/* 223 */
/***/ (function(module, exports, __webpack_require__) {

var anObject = __webpack_require__(12);
var get = __webpack_require__(114);
module.exports = __webpack_require__(6).getIterator = function (it) {
  var iterFn = get(it);
  if (typeof iterFn != 'function') throw TypeError(it + ' is not iterable!');
  return anObject(iterFn.call(it));
};


/***/ }),
/* 224 */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(60);
__webpack_require__(57);
module.exports = __webpack_require__(225);


/***/ }),
/* 225 */
/***/ (function(module, exports, __webpack_require__) {

var classof = __webpack_require__(107);
var ITERATOR = __webpack_require__(10)('iterator');
var Iterators = __webpack_require__(34);
module.exports = __webpack_require__(6).isIterable = function (it) {
  var O = Object(it);
  return O[ITERATOR] !== undefined
    || '@@iterator' in O
    // eslint-disable-next-line no-prototype-builtins
    || Iterators.hasOwnProperty(classof(O));
};


/***/ }),
/* 226 */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(57);
__webpack_require__(227);
module.exports = __webpack_require__(6).Array.from;


/***/ }),
/* 227 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";

var ctx = __webpack_require__(30);
var $export = __webpack_require__(7);
var toObject = __webpack_require__(31);
var call = __webpack_require__(133);
var isArrayIter = __webpack_require__(134);
var toLength = __webpack_require__(67);
var createProperty = __webpack_require__(204);
var getIterFn = __webpack_require__(114);

$export($export.S + $export.F * !__webpack_require__(185)(function (iter) { Array.from(iter); }), 'Array', {
  // 22.1.2.1 Array.from(arrayLike, mapfn = undefined, thisArg = undefined)
  from: function from(arrayLike /* , mapfn = undefined, thisArg = undefined */) {
    var O = toObject(arrayLike);
    var C = typeof this == 'function' ? this : Array;
    var aLen = arguments.length;
    var mapfn = aLen > 1 ? arguments[1] : undefined;
    var mapping = mapfn !== undefined;
    var index = 0;
    var iterFn = getIterFn(O);
    var length, result, step, iterator;
    if (mapping) mapfn = ctx(mapfn, aLen > 2 ? arguments[2] : undefined, 2);
    // if object isn't iterable or it's array with default iterator - use simple case
    if (iterFn != undefined && !(C == Array && isArrayIter(iterFn))) {
      for (iterator = iterFn.call(O), result = new C(); !(step = iterator.next()).done; index++) {
        createProperty(result, index, mapping ? call(iterator, mapfn, [step.value, index], true) : step.value);
      }
    } else {
      length = toLength(O.length);
      for (result = new C(length); length > index; index++) {
        createProperty(result, index, mapping ? mapfn(O[index], index) : O[index]);
      }
    }
    result.length = index;
    return result;
  }
});


/***/ }),
/* 228 */
/***/ (function(module, exports) {

function _nonIterableRest() {
  throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.");
}

module.exports = _nonIterableRest;

/***/ }),
/* 229 */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(230);
module.exports = __webpack_require__(6).Object.entries;


/***/ }),
/* 230 */
/***/ (function(module, exports, __webpack_require__) {

// https://github.com/tc39/proposal-object-values-entries
var $export = __webpack_require__(7);
var $entries = __webpack_require__(174)(true);

$export($export.S, 'Object', {
  entries: function entries(it) {
    return $entries(it);
  }
});


/***/ }),
/* 231 */,
/* 232 */,
/* 233 */,
/* 234 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var _interopRequireDefault = __webpack_require__(0);

var _Object$defineProperty = __webpack_require__(1);

_Object$defineProperty(exports, "__esModule", {
  value: true
});

exports.default = void 0;

var _classCallCheck2 = _interopRequireDefault(__webpack_require__(2));

var _createClass2 = _interopRequireDefault(__webpack_require__(3));

var _get2 = _interopRequireDefault(__webpack_require__(22));

var _getPrototypeOf2 = _interopRequireDefault(__webpack_require__(14));

var _inherits2 = _interopRequireDefault(__webpack_require__(4));

var _createSuper2 = _interopRequireDefault(__webpack_require__(5));

var _componentBase = _interopRequireDefault(__webpack_require__(61));

var ComponentModalBase = /*#__PURE__*/function (_ComponentBase) {
  (0, _inherits2.default)(ComponentModalBase, _ComponentBase);

  var _super = (0, _createSuper2.default)(ComponentModalBase);

  function ComponentModalBase() {
    (0, _classCallCheck2.default)(this, ComponentModalBase);
    return _super.apply(this, arguments);
  }

  (0, _createClass2.default)(ComponentModalBase, [{
    key: "registerAPI",
    value: function registerAPI() {
      var _this = this;

      (0, _get2.default)((0, _getPrototypeOf2.default)(ComponentModalBase.prototype), "registerAPI", this).call(this);
      $e.shortcuts.register('esc', {
        scopes: [this.getNamespace()],
        callback: function callback() {
          return _this.close();
        }
      });
    }
  }, {
    key: "defaultCommands",
    value: function defaultCommands() {
      var _this2 = this;

      return {
        open: function open() {
          return $e.route(_this2.getNamespace());
        },
        close: function close() {
          return _this2.close();
        },
        toggle: function toggle() {
          if (_this2.isOpen) {
            _this2.close();
          } else {
            $e.route(_this2.getNamespace());
          }
        }
      };
    }
  }, {
    key: "defaultRoutes",
    value: function defaultRoutes() {
      return {
        '': function _() {
          /* Nothing to do, it's already rendered. */
        }
      };
    }
  }, {
    key: "open",
    value: function open() {
      var _this3 = this;

      if (!this.layout) {
        var layout = this.getModalLayout();
        this.layout = new layout({
          component: this
        });
        this.layout.getModal().on('hide', function () {
          return _this3.close();
        });
      }

      this.layout.showModal();
      return true;
    }
  }, {
    key: "close",
    value: function close() {
      if (!(0, _get2.default)((0, _getPrototypeOf2.default)(ComponentModalBase.prototype), "close", this).call(this)) {
        return false;
      }

      this.layout.getModal().hide();
      return true;
    }
  }, {
    key: "getModalLayout",
    value: function getModalLayout() {
      elementorModules.ForceMethodImplementation();
    }
  }]);
  return ComponentModalBase;
}(_componentBase.default);

exports.default = ComponentModalBase;

/***/ }),
/* 235 */,
/* 236 */
/***/ (function(module, exports, __webpack_require__) {

// 9.4.2.3 ArraySpeciesCreate(originalArray, length)
var speciesConstructor = __webpack_require__(237);

module.exports = function (original, length) {
  return new (speciesConstructor(original))(length);
};


/***/ }),
/* 237 */
/***/ (function(module, exports, __webpack_require__) {

var isObject = __webpack_require__(9);
var isArray = __webpack_require__(95);
var SPECIES = __webpack_require__(10)('species');

module.exports = function (original) {
  var C;
  if (isArray(original)) {
    C = original.constructor;
    // cross-realm fallback
    if (typeof C == 'function' && (C === Array || isArray(C.prototype))) C = undefined;
    if (isObject(C)) {
      C = C[SPECIES];
      if (C === null) C = undefined;
    }
  } return C === undefined ? Array : C;
};


/***/ }),
/* 238 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";

// 19.1.2.1 Object.assign(target, source, ...)
var DESCRIPTORS = __webpack_require__(13);
var getKeys = __webpack_require__(38);
var gOPS = __webpack_require__(82);
var pIE = __webpack_require__(48);
var toObject = __webpack_require__(31);
var IObject = __webpack_require__(104);
var $assign = Object.assign;

// should work with symbols and should have deterministic property order (V8 bug)
module.exports = !$assign || __webpack_require__(20)(function () {
  var A = {};
  var B = {};
  // eslint-disable-next-line no-undef
  var S = Symbol();
  var K = 'abcdefghijklmnopqrst';
  A[S] = 7;
  K.split('').forEach(function (k) { B[k] = k; });
  return $assign({}, A)[S] != 7 || Object.keys($assign({}, B)).join('') != K;
}) ? function assign(target, source) { // eslint-disable-line no-unused-vars
  var T = toObject(target);
  var aLen = arguments.length;
  var index = 1;
  var getSymbols = gOPS.f;
  var isEnum = pIE.f;
  while (aLen > index) {
    var S = IObject(arguments[index++]);
    var keys = getSymbols ? getKeys(S).concat(getSymbols(S)) : getKeys(S);
    var length = keys.length;
    var j = 0;
    var key;
    while (length > j) {
      key = keys[j++];
      if (!DESCRIPTORS || isEnum.call(S, key)) T[key] = S[key];
    }
  } return T;
} : $assign;


/***/ }),
/* 239 */
/***/ (function(module, exports, __webpack_require__) {

var $iterators = __webpack_require__(178);
var getKeys = __webpack_require__(188);
var redefine = __webpack_require__(33);
var global = __webpack_require__(15);
var hide = __webpack_require__(27);
var Iterators = __webpack_require__(122);
var wks = __webpack_require__(11);
var ITERATOR = wks('iterator');
var TO_STRING_TAG = wks('toStringTag');
var ArrayValues = Iterators.Array;

var DOMIterables = {
  CSSRuleList: true, // TODO: Not spec compliant, should be false.
  CSSStyleDeclaration: false,
  CSSValueList: false,
  ClientRectList: false,
  DOMRectList: false,
  DOMStringList: false,
  DOMTokenList: true,
  DataTransferItemList: false,
  FileList: false,
  HTMLAllCollection: false,
  HTMLCollection: false,
  HTMLFormElement: false,
  HTMLSelectElement: false,
  MediaList: true, // TODO: Not spec compliant, should be false.
  MimeTypeArray: false,
  NamedNodeMap: false,
  NodeList: true,
  PaintRequestList: false,
  Plugin: false,
  PluginArray: false,
  SVGLengthList: false,
  SVGNumberList: false,
  SVGPathSegList: false,
  SVGPointList: false,
  SVGStringList: false,
  SVGTransformList: false,
  SourceBufferList: false,
  StyleSheetList: true, // TODO: Not spec compliant, should be false.
  TextTrackCueList: false,
  TextTrackList: false,
  TouchList: false
};

for (var collections = getKeys(DOMIterables), i = 0; i < collections.length; i++) {
  var NAME = collections[i];
  var explicit = DOMIterables[NAME];
  var Collection = global[NAME];
  var proto = Collection && Collection.prototype;
  var key;
  if (proto) {
    if (!proto[ITERATOR]) hide(proto, ITERATOR, ArrayValues);
    if (!proto[TO_STRING_TAG]) hide(proto, TO_STRING_TAG, NAME);
    Iterators[NAME] = ArrayValues;
    if (explicit) for (key in $iterators) if (!proto[key]) redefine(proto, key, $iterators[key], true);
  }
}


/***/ }),
/* 240 */
/***/ (function(module, exports, __webpack_require__) {

// 19.1.2.2 / 15.2.3.5 Object.create(O [, Properties])
var anObject = __webpack_require__(18);
var dPs = __webpack_require__(261);
var enumBugKeys = __webpack_require__(147);
var IE_PROTO = __webpack_require__(127)('IE_PROTO');
var Empty = function () { /* empty */ };
var PROTOTYPE = 'prototype';

// Create object with fake `null` prototype: use iframe Object with cleared prototype
var createDict = function () {
  // Thrash, waste and sodomy: IE GC bug
  var iframe = __webpack_require__(98)('iframe');
  var i = enumBugKeys.length;
  var lt = '<';
  var gt = '>';
  var iframeDocument;
  iframe.style.display = 'none';
  __webpack_require__(241).appendChild(iframe);
  iframe.src = 'javascript:'; // eslint-disable-line no-script-url
  // createDict = iframe.contentWindow.Object;
  // html.removeChild(iframe);
  iframeDocument = iframe.contentWindow.document;
  iframeDocument.open();
  iframeDocument.write(lt + 'script' + gt + 'document.F=Object' + lt + '/script' + gt);
  iframeDocument.close();
  createDict = iframeDocument.F;
  while (i--) delete createDict[PROTOTYPE][enumBugKeys[i]];
  return createDict();
};

module.exports = Object.create || function create(O, Properties) {
  var result;
  if (O !== null) {
    Empty[PROTOTYPE] = anObject(O);
    result = new Empty();
    Empty[PROTOTYPE] = null;
    // add "__proto__" for Object.getPrototypeOf polyfill
    result[IE_PROTO] = O;
  } else result = createDict();
  return Properties === undefined ? result : dPs(result, Properties);
};


/***/ }),
/* 241 */
/***/ (function(module, exports, __webpack_require__) {

var document = __webpack_require__(15).document;
module.exports = document && document.documentElement;


/***/ }),
/* 242 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var _interopRequireDefault = __webpack_require__(0);

var _Object$defineProperty = __webpack_require__(1);

_Object$defineProperty(exports, "__esModule", {
  value: true
});

exports.default = exports.Base = void 0;

var _classCallCheck2 = _interopRequireDefault(__webpack_require__(2));

var _createClass2 = _interopRequireDefault(__webpack_require__(3));

var _inherits2 = _interopRequireDefault(__webpack_require__(4));

var _createSuper2 = _interopRequireDefault(__webpack_require__(5));

var _hookBase = _interopRequireDefault(__webpack_require__(250));

var Base = /*#__PURE__*/function (_HookBase) {
  (0, _inherits2.default)(Base, _HookBase);

  var _super = (0, _createSuper2.default)(Base);

  function Base() {
    (0, _classCallCheck2.default)(this, Base);
    return _super.apply(this, arguments);
  }

  (0, _createClass2.default)(Base, [{
    key: "getType",
    value: function getType() {
      return 'data';
    }
  }]);
  return Base;
}(_hookBase.default);

exports.Base = Base;
var _default = Base;
exports.default = _default;

/***/ }),
/* 243 */,
/* 244 */,
/* 245 */,
/* 246 */,
/* 247 */,
/* 248 */,
/* 249 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";

var global = __webpack_require__(8);
var core = __webpack_require__(6);
var dP = __webpack_require__(16);
var DESCRIPTORS = __webpack_require__(13);
var SPECIES = __webpack_require__(10)('species');

module.exports = function (KEY) {
  var C = typeof core[KEY] == 'function' ? core[KEY] : global[KEY];
  if (DESCRIPTORS && C && !C[SPECIES]) dP.f(C, SPECIES, {
    configurable: true,
    get: function () { return this; }
  });
};


/***/ }),
/* 250 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var _interopRequireDefault = __webpack_require__(0);

var _Object$defineProperty = __webpack_require__(1);

_Object$defineProperty(exports, "__esModule", {
  value: true
});

exports.default = void 0;

var _classCallCheck2 = _interopRequireDefault(__webpack_require__(2));

var _createClass2 = _interopRequireDefault(__webpack_require__(3));

var _defineProperty2 = _interopRequireDefault(__webpack_require__(35));

var HookBase = /*#__PURE__*/function () {
  /**
   * Callback type, eg ( hook, event ).
   *
   * @type {string}
   */

  /**
   * Full command address, that will hook the callback.
   *
   * @type (string)
   */

  /**
   * Unique id of the callback.
   *
   * @type {string}
   */

  /**
   * Function constructor().
   *
   * Create callback base.
   */
  function HookBase() {
    (0, _classCallCheck2.default)(this, HookBase);
    (0, _defineProperty2.default)(this, "type", void 0);
    (0, _defineProperty2.default)(this, "command", void 0);
    (0, _defineProperty2.default)(this, "id", void 0);
    this.initialize();
    this.type = this.getType();
    this.command = this.getCommand();
    this.id = this.getId();
  }
  /**
   * Function initialize().
   *
   * Called after creation of the base, used for initialize extras.
   * Without expending constructor.
   */


  (0, _createClass2.default)(HookBase, [{
    key: "initialize",
    value: function initialize() {}
    /**
     * Function register().
     *
     * Used to register the callback.
     *
     * @throws {Error}
     */

  }, {
    key: "register",
    value: function register() {
      elementorModules.ForceMethodImplementation();
    }
    /**
     * Function getType().
     *
     * Get type eg: ( hook, event, etc ... ).
     *
     * @returns {string}
     *
     * @throws {Error}
     */

  }, {
    key: "getType",
    value: function getType() {
      elementorModules.ForceMethodImplementation();
    }
    /**
     * Function getCommand().
     *
     * Returns the full command path for callback binding.
     *
     * Supports array of strings ( commands ).
     *
     * @returns {string}
     *
     * @throws {Error}
     */

  }, {
    key: "getCommand",
    value: function getCommand() {
      elementorModules.ForceMethodImplementation();
    }
    /**
     * Function getId().
     *
     * Returns command id for the hook (should be unique).
     *
     * @returns {string}
     *
     * @throws {Error}
     */

  }, {
    key: "getId",
    value: function getId() {
      elementorModules.ForceMethodImplementation();
    }
    /**
     * Function getContainerType().
     *
     * Bind eContainer type to callback.
     *
     * Used to gain performance.
     *
     * @return {string} type
     */

  }, {
    key: "getContainerType",
    value: function getContainerType() {}
    /**
     * Function getConditions().
     *
     * Condition for running the callback, if true, call to apply().
     *
     * @param [args={}]
     *
     * @returns {boolean}
     */

  }, {
    key: "getConditions",
    value: function getConditions() {
      var args = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : {};
      // eslint-disable-line no-unused-vars
      return true;
    }
    /**
     * Function apply().
     *
     * Apply the callback, ( The actual affect of the callback ).
     *
     * @param [args={}]
     *
     * @returns {*}
     */

  }, {
    key: "apply",
    value: function apply(args) {
      // eslint-disable-line no-unused-vars
      elementorModules.ForceMethodImplementation();
    }
    /**
     * Function run().
     *
     * Run the callback.
     *
     * @param {*} args
     *
     * @returns {boolean}
     */

  }, {
    key: "run",
    value: function run() {
      var _ref = arguments.length <= 0 ? undefined : arguments[0],
          _ref$options = _ref.options,
          options = _ref$options === void 0 ? {} : _ref$options; // Disable callback if requested by args.options.


      if (options.callbacks && false === options.callbacks[this.id]) {
        return true;
      }

      if (this.getConditions(arguments.length <= 0 ? undefined : arguments[0])) {
        if ($e.devTools) {
          $e.devTools.log.callbacks().active(this.type, this.command, this.id);
        }

        return this.apply.apply(this, arguments);
      }

      return true;
    }
  }]);
  return HookBase;
}();

exports.default = HookBase;

/***/ }),
/* 251 */,
/* 252 */,
/* 253 */,
/* 254 */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(255);
module.exports = __webpack_require__(6).Object.values;


/***/ }),
/* 255 */
/***/ (function(module, exports, __webpack_require__) {

// https://github.com/tc39/proposal-object-values-entries
var $export = __webpack_require__(7);
var $values = __webpack_require__(174)(false);

$export($export.S, 'Object', {
  values: function values(it) {
    return $values(it);
  }
});


/***/ }),
/* 256 */,
/* 257 */,
/* 258 */
/***/ (function(module, exports) {

module.exports = function (done, value) {
  return { value: value, done: !!done };
};


/***/ }),
/* 259 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";

var LIBRARY = __webpack_require__(100);
var $export = __webpack_require__(32);
var redefine = __webpack_require__(33);
var hide = __webpack_require__(27);
var Iterators = __webpack_require__(122);
var $iterCreate = __webpack_require__(260);
var setToStringTag = __webpack_require__(179);
var getPrototypeOf = __webpack_require__(262);
var ITERATOR = __webpack_require__(11)('iterator');
var BUGGY = !([].keys && 'next' in [].keys()); // Safari has buggy iterators w/o `next`
var FF_ITERATOR = '@@iterator';
var KEYS = 'keys';
var VALUES = 'values';

var returnThis = function () { return this; };

module.exports = function (Base, NAME, Constructor, next, DEFAULT, IS_SET, FORCED) {
  $iterCreate(Constructor, NAME, next);
  var getMethod = function (kind) {
    if (!BUGGY && kind in proto) return proto[kind];
    switch (kind) {
      case KEYS: return function keys() { return new Constructor(this, kind); };
      case VALUES: return function values() { return new Constructor(this, kind); };
    } return function entries() { return new Constructor(this, kind); };
  };
  var TAG = NAME + ' Iterator';
  var DEF_VALUES = DEFAULT == VALUES;
  var VALUES_BUG = false;
  var proto = Base.prototype;
  var $native = proto[ITERATOR] || proto[FF_ITERATOR] || DEFAULT && proto[DEFAULT];
  var $default = $native || getMethod(DEFAULT);
  var $entries = DEFAULT ? !DEF_VALUES ? $default : getMethod('entries') : undefined;
  var $anyNative = NAME == 'Array' ? proto.entries || $native : $native;
  var methods, key, IteratorPrototype;
  // Fix native
  if ($anyNative) {
    IteratorPrototype = getPrototypeOf($anyNative.call(new Base()));
    if (IteratorPrototype !== Object.prototype && IteratorPrototype.next) {
      // Set @@toStringTag to native iterators
      setToStringTag(IteratorPrototype, TAG, true);
      // fix for some old engines
      if (!LIBRARY && typeof IteratorPrototype[ITERATOR] != 'function') hide(IteratorPrototype, ITERATOR, returnThis);
    }
  }
  // fix Array#{values, @@iterator}.name in V8 / FF
  if (DEF_VALUES && $native && $native.name !== VALUES) {
    VALUES_BUG = true;
    $default = function values() { return $native.call(this); };
  }
  // Define iterator
  if ((!LIBRARY || FORCED) && (BUGGY || VALUES_BUG || !proto[ITERATOR])) {
    hide(proto, ITERATOR, $default);
  }
  // Plug for library
  Iterators[NAME] = $default;
  Iterators[TAG] = returnThis;
  if (DEFAULT) {
    methods = {
      values: DEF_VALUES ? $default : getMethod(VALUES),
      keys: IS_SET ? $default : getMethod(KEYS),
      entries: $entries
    };
    if (FORCED) for (key in methods) {
      if (!(key in proto)) redefine(proto, key, methods[key]);
    } else $export($export.P + $export.F * (BUGGY || VALUES_BUG), NAME, methods);
  }
  return methods;
};


/***/ }),
/* 260 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";

var create = __webpack_require__(240);
var descriptor = __webpack_require__(91);
var setToStringTag = __webpack_require__(179);
var IteratorPrototype = {};

// 25.1.2.1.1 %IteratorPrototype%[@@iterator]()
__webpack_require__(27)(IteratorPrototype, __webpack_require__(11)('iterator'), function () { return this; });

module.exports = function (Constructor, NAME, next) {
  Constructor.prototype = create(IteratorPrototype, { next: descriptor(1, next) });
  setToStringTag(Constructor, NAME + ' Iterator');
};


/***/ }),
/* 261 */
/***/ (function(module, exports, __webpack_require__) {

var dP = __webpack_require__(44);
var anObject = __webpack_require__(18);
var getKeys = __webpack_require__(188);

module.exports = __webpack_require__(25) ? Object.defineProperties : function defineProperties(O, Properties) {
  anObject(O);
  var keys = getKeys(Properties);
  var length = keys.length;
  var i = 0;
  var P;
  while (length > i) dP.f(O, P = keys[i++], Properties[P]);
  return O;
};


/***/ }),
/* 262 */
/***/ (function(module, exports, __webpack_require__) {

// 19.1.2.9 / 15.2.3.2 Object.getPrototypeOf(O)
var has = __webpack_require__(54);
var toObject = __webpack_require__(81);
var IE_PROTO = __webpack_require__(127)('IE_PROTO');
var ObjectProto = Object.prototype;

module.exports = Object.getPrototypeOf || function (O) {
  O = toObject(O);
  if (has(O, IE_PROTO)) return O[IE_PROTO];
  if (typeof O.constructor == 'function' && O instanceof O.constructor) {
    return O.constructor.prototype;
  } return O instanceof Object ? ObjectProto : null;
};


/***/ }),
/* 263 */,
/* 264 */,
/* 265 */,
/* 266 */,
/* 267 */,
/* 268 */,
/* 269 */,
/* 270 */,
/* 271 */,
/* 272 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var _interopRequireDefault = __webpack_require__(0);

var _Object$defineProperty = __webpack_require__(1);

_Object$defineProperty(exports, "__esModule", {
  value: true
});

exports.default = exports.Base = void 0;

var _classCallCheck2 = _interopRequireDefault(__webpack_require__(2));

var _createClass2 = _interopRequireDefault(__webpack_require__(3));

var _inherits2 = _interopRequireDefault(__webpack_require__(4));

var _createSuper2 = _interopRequireDefault(__webpack_require__(5));

var _hookBase = _interopRequireDefault(__webpack_require__(250));

var Base = /*#__PURE__*/function (_HookBase) {
  (0, _inherits2.default)(Base, _HookBase);

  var _super = (0, _createSuper2.default)(Base);

  function Base() {
    (0, _classCallCheck2.default)(this, Base);
    return _super.apply(this, arguments);
  }

  (0, _createClass2.default)(Base, [{
    key: "getType",
    value: function getType() {
      return 'ui';
    }
  }]);
  return Base;
}(_hookBase.default);

exports.Base = Base;
var _default = Base;
exports.default = _default;

/***/ }),
/* 273 */
/***/ (function(module, exports, __webpack_require__) {

var core = __webpack_require__(6);
var $JSON = core.JSON || (core.JSON = { stringify: JSON.stringify });
module.exports = function stringify(it) { // eslint-disable-line no-unused-vars
  return $JSON.stringify.apply($JSON, arguments);
};


/***/ }),
/* 274 */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(275);

/***/ }),
/* 275 */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(106);
__webpack_require__(60);
__webpack_require__(276);
__webpack_require__(278);
__webpack_require__(279);
module.exports = __webpack_require__(6).WeakMap;


/***/ }),
/* 276 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";

var global = __webpack_require__(8);
var each = __webpack_require__(144)(0);
var redefine = __webpack_require__(88);
var meta = __webpack_require__(77);
var assign = __webpack_require__(238);
var weak = __webpack_require__(277);
var isObject = __webpack_require__(9);
var validate = __webpack_require__(121);
var NATIVE_WEAK_MAP = __webpack_require__(121);
var IS_IE11 = !global.ActiveXObject && 'ActiveXObject' in global;
var WEAK_MAP = 'WeakMap';
var getWeak = meta.getWeak;
var isExtensible = Object.isExtensible;
var uncaughtFrozenStore = weak.ufstore;
var InternalMap;

var wrapper = function (get) {
  return function WeakMap() {
    return get(this, arguments.length > 0 ? arguments[0] : undefined);
  };
};

var methods = {
  // 23.3.3.3 WeakMap.prototype.get(key)
  get: function get(key) {
    if (isObject(key)) {
      var data = getWeak(key);
      if (data === true) return uncaughtFrozenStore(validate(this, WEAK_MAP)).get(key);
      return data ? data[this._i] : undefined;
    }
  },
  // 23.3.3.5 WeakMap.prototype.set(key, value)
  set: function set(key, value) {
    return weak.def(validate(this, WEAK_MAP), key, value);
  }
};

// 23.3 WeakMap Objects
var $WeakMap = module.exports = __webpack_require__(214)(WEAK_MAP, wrapper, methods, weak, true, true);

// IE11 WeakMap frozen keys fix
if (NATIVE_WEAK_MAP && IS_IE11) {
  InternalMap = weak.getConstructor(wrapper, WEAK_MAP);
  assign(InternalMap.prototype, methods);
  meta.NEED = true;
  each(['delete', 'has', 'get', 'set'], function (key) {
    var proto = $WeakMap.prototype;
    var method = proto[key];
    redefine(proto, key, function (a, b) {
      // store frozen objects on internal weakmap shim
      if (isObject(a) && !isExtensible(a)) {
        if (!this._f) this._f = new InternalMap();
        var result = this._f[key](a, b);
        return key == 'set' ? this : result;
      // store all the rest on native weakmap
      } return method.call(this, a, b);
    });
  });
}


/***/ }),
/* 277 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";

var redefineAll = __webpack_require__(124);
var getWeak = __webpack_require__(77).getWeak;
var anObject = __webpack_require__(12);
var isObject = __webpack_require__(9);
var anInstance = __webpack_require__(125);
var forOf = __webpack_require__(86);
var createArrayMethod = __webpack_require__(144);
var $has = __webpack_require__(19);
var validate = __webpack_require__(121);
var arrayFind = createArrayMethod(5);
var arrayFindIndex = createArrayMethod(6);
var id = 0;

// fallback for uncaught frozen keys
var uncaughtFrozenStore = function (that) {
  return that._l || (that._l = new UncaughtFrozenStore());
};
var UncaughtFrozenStore = function () {
  this.a = [];
};
var findUncaughtFrozen = function (store, key) {
  return arrayFind(store.a, function (it) {
    return it[0] === key;
  });
};
UncaughtFrozenStore.prototype = {
  get: function (key) {
    var entry = findUncaughtFrozen(this, key);
    if (entry) return entry[1];
  },
  has: function (key) {
    return !!findUncaughtFrozen(this, key);
  },
  set: function (key, value) {
    var entry = findUncaughtFrozen(this, key);
    if (entry) entry[1] = value;
    else this.a.push([key, value]);
  },
  'delete': function (key) {
    var index = arrayFindIndex(this.a, function (it) {
      return it[0] === key;
    });
    if (~index) this.a.splice(index, 1);
    return !!~index;
  }
};

module.exports = {
  getConstructor: function (wrapper, NAME, IS_MAP, ADDER) {
    var C = wrapper(function (that, iterable) {
      anInstance(that, C, NAME, '_i');
      that._t = NAME;      // collection type
      that._i = id++;      // collection id
      that._l = undefined; // leak store for uncaught frozen objects
      if (iterable != undefined) forOf(iterable, IS_MAP, that[ADDER], that);
    });
    redefineAll(C.prototype, {
      // 23.3.3.2 WeakMap.prototype.delete(key)
      // 23.4.3.3 WeakSet.prototype.delete(value)
      'delete': function (key) {
        if (!isObject(key)) return false;
        var data = getWeak(key);
        if (data === true) return uncaughtFrozenStore(validate(this, NAME))['delete'](key);
        return data && $has(data, this._i) && delete data[this._i];
      },
      // 23.3.3.4 WeakMap.prototype.has(key)
      // 23.4.3.4 WeakSet.prototype.has(value)
      has: function has(key) {
        if (!isObject(key)) return false;
        var data = getWeak(key);
        if (data === true) return uncaughtFrozenStore(validate(this, NAME)).has(key);
        return data && $has(data, this._i);
      }
    });
    return C;
  },
  def: function (that, key, value) {
    var data = getWeak(anObject(key), true);
    if (data === true) uncaughtFrozenStore(that).set(key, value);
    else data[that._i] = value;
    return that;
  },
  ufstore: uncaughtFrozenStore
};


/***/ }),
/* 278 */
/***/ (function(module, exports, __webpack_require__) {

// https://tc39.github.io/proposal-setmap-offrom/#sec-weakmap.of
__webpack_require__(215)('WeakMap');


/***/ }),
/* 279 */
/***/ (function(module, exports, __webpack_require__) {

// https://tc39.github.io/proposal-setmap-offrom/#sec-weakmap.from
__webpack_require__(216)('WeakMap');


/***/ }),
/* 280 */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(281);
module.exports = __webpack_require__(6).Object.assign;


/***/ }),
/* 281 */
/***/ (function(module, exports, __webpack_require__) {

// 19.1.3.1 Object.assign(target, source)
var $export = __webpack_require__(7);

$export($export.S + $export.F, 'Object', { assign: __webpack_require__(238) });


/***/ }),
/* 282 */,
/* 283 */,
/* 284 */,
/* 285 */,
/* 286 */,
/* 287 */,
/* 288 */,
/* 289 */,
/* 290 */,
/* 291 */,
/* 292 */,
/* 293 */,
/* 294 */
/***/ (function(module, exports, __webpack_require__) {

var _Object$create = __webpack_require__(123);

var _Map = __webpack_require__(346);

var getPrototypeOf = __webpack_require__(14);

var setPrototypeOf = __webpack_require__(118);

var isNativeFunction = __webpack_require__(355);

var construct = __webpack_require__(356);

function _wrapNativeSuper(Class) {
  var _cache = typeof _Map === "function" ? new _Map() : undefined;

  module.exports = _wrapNativeSuper = function _wrapNativeSuper(Class) {
    if (Class === null || !isNativeFunction(Class)) return Class;

    if (typeof Class !== "function") {
      throw new TypeError("Super expression must either be null or a function");
    }

    if (typeof _cache !== "undefined") {
      if (_cache.has(Class)) return _cache.get(Class);

      _cache.set(Class, Wrapper);
    }

    function Wrapper() {
      return construct(Class, arguments, getPrototypeOf(this).constructor);
    }

    Wrapper.prototype = _Object$create(Class.prototype, {
      constructor: {
        value: Wrapper,
        enumerable: false,
        writable: true,
        configurable: true
      }
    });
    return setPrototypeOf(Wrapper, Class);
  };

  return _wrapNativeSuper(Class);
}

module.exports = _wrapNativeSuper;

/***/ }),
/* 295 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var _interopRequireDefault = __webpack_require__(0);

var _Object$defineProperty = __webpack_require__(1);

_Object$defineProperty(exports, "__esModule", {
  value: true
});

exports.default = exports.Dependency = void 0;

var _classCallCheck2 = _interopRequireDefault(__webpack_require__(2));

var _createClass2 = _interopRequireDefault(__webpack_require__(3));

var _inherits2 = _interopRequireDefault(__webpack_require__(4));

var _createSuper2 = _interopRequireDefault(__webpack_require__(5));

var _base = _interopRequireDefault(__webpack_require__(242));

var Dependency = /*#__PURE__*/function (_Base) {
  (0, _inherits2.default)(Dependency, _Base);

  var _super = (0, _createSuper2.default)(Dependency);

  function Dependency() {
    (0, _classCallCheck2.default)(this, Dependency);
    return _super.apply(this, arguments);
  }

  (0, _createClass2.default)(Dependency, [{
    key: "register",
    value: function register() {
      $e.hooks.registerDataDependency(this);
    }
  }]);
  return Dependency;
}(_base.default);

exports.Dependency = Dependency;
var _default = Dependency;
exports.default = _default;

/***/ }),
/* 296 */,
/* 297 */,
/* 298 */,
/* 299 */,
/* 300 */,
/* 301 */,
/* 302 */,
/* 303 */,
/* 304 */,
/* 305 */,
/* 306 */,
/* 307 */,
/* 308 */,
/* 309 */,
/* 310 */,
/* 311 */,
/* 312 */,
/* 313 */,
/* 314 */,
/* 315 */,
/* 316 */,
/* 317 */,
/* 318 */,
/* 319 */,
/* 320 */,
/* 321 */,
/* 322 */,
/* 323 */,
/* 324 */,
/* 325 */,
/* 326 */,
/* 327 */,
/* 328 */,
/* 329 */,
/* 330 */,
/* 331 */,
/* 332 */,
/* 333 */,
/* 334 */,
/* 335 */,
/* 336 */,
/* 337 */,
/* 338 */,
/* 339 */,
/* 340 */,
/* 341 */,
/* 342 */,
/* 343 */,
/* 344 */,
/* 345 */,
/* 346 */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(347);

/***/ }),
/* 347 */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(106);
__webpack_require__(57);
__webpack_require__(60);
__webpack_require__(348);
__webpack_require__(350);
__webpack_require__(353);
__webpack_require__(354);
module.exports = __webpack_require__(6).Map;


/***/ }),
/* 348 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";

var strong = __webpack_require__(349);
var validate = __webpack_require__(121);
var MAP = 'Map';

// 23.1 Map Objects
module.exports = __webpack_require__(214)(MAP, function (get) {
  return function Map() { return get(this, arguments.length > 0 ? arguments[0] : undefined); };
}, {
  // 23.1.3.6 Map.prototype.get(key)
  get: function get(key) {
    var entry = strong.getEntry(validate(this, MAP), key);
    return entry && entry.v;
  },
  // 23.1.3.9 Map.prototype.set(key, value)
  set: function set(key, value) {
    return strong.def(validate(this, MAP), key === 0 ? 0 : key, value);
  }
}, strong, true);


/***/ }),
/* 349 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";

var dP = __webpack_require__(16).f;
var create = __webpack_require__(47);
var redefineAll = __webpack_require__(124);
var ctx = __webpack_require__(30);
var anInstance = __webpack_require__(125);
var forOf = __webpack_require__(86);
var $iterDefine = __webpack_require__(94);
var step = __webpack_require__(132);
var setSpecies = __webpack_require__(249);
var DESCRIPTORS = __webpack_require__(13);
var fastKey = __webpack_require__(77).fastKey;
var validate = __webpack_require__(121);
var SIZE = DESCRIPTORS ? '_s' : 'size';

var getEntry = function (that, key) {
  // fast case
  var index = fastKey(key);
  var entry;
  if (index !== 'F') return that._i[index];
  // frozen object case
  for (entry = that._f; entry; entry = entry.n) {
    if (entry.k == key) return entry;
  }
};

module.exports = {
  getConstructor: function (wrapper, NAME, IS_MAP, ADDER) {
    var C = wrapper(function (that, iterable) {
      anInstance(that, C, NAME, '_i');
      that._t = NAME;         // collection type
      that._i = create(null); // index
      that._f = undefined;    // first entry
      that._l = undefined;    // last entry
      that[SIZE] = 0;         // size
      if (iterable != undefined) forOf(iterable, IS_MAP, that[ADDER], that);
    });
    redefineAll(C.prototype, {
      // 23.1.3.1 Map.prototype.clear()
      // 23.2.3.2 Set.prototype.clear()
      clear: function clear() {
        for (var that = validate(this, NAME), data = that._i, entry = that._f; entry; entry = entry.n) {
          entry.r = true;
          if (entry.p) entry.p = entry.p.n = undefined;
          delete data[entry.i];
        }
        that._f = that._l = undefined;
        that[SIZE] = 0;
      },
      // 23.1.3.3 Map.prototype.delete(key)
      // 23.2.3.4 Set.prototype.delete(value)
      'delete': function (key) {
        var that = validate(this, NAME);
        var entry = getEntry(that, key);
        if (entry) {
          var next = entry.n;
          var prev = entry.p;
          delete that._i[entry.i];
          entry.r = true;
          if (prev) prev.n = next;
          if (next) next.p = prev;
          if (that._f == entry) that._f = next;
          if (that._l == entry) that._l = prev;
          that[SIZE]--;
        } return !!entry;
      },
      // 23.2.3.6 Set.prototype.forEach(callbackfn, thisArg = undefined)
      // 23.1.3.5 Map.prototype.forEach(callbackfn, thisArg = undefined)
      forEach: function forEach(callbackfn /* , that = undefined */) {
        validate(this, NAME);
        var f = ctx(callbackfn, arguments.length > 1 ? arguments[1] : undefined, 3);
        var entry;
        while (entry = entry ? entry.n : this._f) {
          f(entry.v, entry.k, this);
          // revert to the last existing entry
          while (entry && entry.r) entry = entry.p;
        }
      },
      // 23.1.3.7 Map.prototype.has(key)
      // 23.2.3.7 Set.prototype.has(value)
      has: function has(key) {
        return !!getEntry(validate(this, NAME), key);
      }
    });
    if (DESCRIPTORS) dP(C.prototype, 'size', {
      get: function () {
        return validate(this, NAME)[SIZE];
      }
    });
    return C;
  },
  def: function (that, key, value) {
    var entry = getEntry(that, key);
    var prev, index;
    // change existing entry
    if (entry) {
      entry.v = value;
    // create new entry
    } else {
      that._l = entry = {
        i: index = fastKey(key, true), // <- index
        k: key,                        // <- key
        v: value,                      // <- value
        p: prev = that._l,             // <- previous entry
        n: undefined,                  // <- next entry
        r: false                       // <- removed
      };
      if (!that._f) that._f = entry;
      if (prev) prev.n = entry;
      that[SIZE]++;
      // add to index
      if (index !== 'F') that._i[index] = entry;
    } return that;
  },
  getEntry: getEntry,
  setStrong: function (C, NAME, IS_MAP) {
    // add .keys, .values, .entries, [@@iterator]
    // 23.1.3.4, 23.1.3.8, 23.1.3.11, 23.1.3.12, 23.2.3.5, 23.2.3.8, 23.2.3.10, 23.2.3.11
    $iterDefine(C, NAME, function (iterated, kind) {
      this._t = validate(iterated, NAME); // target
      this._k = kind;                     // kind
      this._l = undefined;                // previous
    }, function () {
      var that = this;
      var kind = that._k;
      var entry = that._l;
      // revert to the last existing entry
      while (entry && entry.r) entry = entry.p;
      // get next entry
      if (!that._t || !(that._l = entry = entry ? entry.n : that._t._f)) {
        // or finish the iteration
        that._t = undefined;
        return step(1);
      }
      // return step by kind
      if (kind == 'keys') return step(0, entry.k);
      if (kind == 'values') return step(0, entry.v);
      return step(0, [entry.k, entry.v]);
    }, IS_MAP ? 'entries' : 'values', !IS_MAP, true);

    // add [@@species], 23.1.2.2, 23.2.2.2
    setSpecies(NAME);
  }
};


/***/ }),
/* 350 */
/***/ (function(module, exports, __webpack_require__) {

// https://github.com/DavidBruant/Map-Set.prototype.toJSON
var $export = __webpack_require__(7);

$export($export.P + $export.R, 'Map', { toJSON: __webpack_require__(351)('Map') });


/***/ }),
/* 351 */
/***/ (function(module, exports, __webpack_require__) {

// https://github.com/DavidBruant/Map-Set.prototype.toJSON
var classof = __webpack_require__(107);
var from = __webpack_require__(352);
module.exports = function (NAME) {
  return function toJSON() {
    if (classof(this) != NAME) throw TypeError(NAME + "#toJSON isn't generic");
    return from(this);
  };
};


/***/ }),
/* 352 */
/***/ (function(module, exports, __webpack_require__) {

var forOf = __webpack_require__(86);

module.exports = function (iter, ITERATOR) {
  var result = [];
  forOf(iter, false, result.push, result, ITERATOR);
  return result;
};


/***/ }),
/* 353 */
/***/ (function(module, exports, __webpack_require__) {

// https://tc39.github.io/proposal-setmap-offrom/#sec-map.of
__webpack_require__(215)('Map');


/***/ }),
/* 354 */
/***/ (function(module, exports, __webpack_require__) {

// https://tc39.github.io/proposal-setmap-offrom/#sec-map.from
__webpack_require__(216)('Map');


/***/ }),
/* 355 */
/***/ (function(module, exports) {

function _isNativeFunction(fn) {
  return Function.toString.call(fn).indexOf("[native code]") !== -1;
}

module.exports = _isNativeFunction;

/***/ }),
/* 356 */
/***/ (function(module, exports, __webpack_require__) {

var _Reflect$construct = __webpack_require__(93);

var setPrototypeOf = __webpack_require__(118);

var isNativeReflectConstruct = __webpack_require__(131);

function _construct(Parent, args, Class) {
  if (isNativeReflectConstruct()) {
    module.exports = _construct = _Reflect$construct;
  } else {
    module.exports = _construct = function _construct(Parent, args, Class) {
      var a = [null];
      a.push.apply(a, args);
      var Constructor = Function.bind.apply(Parent, a);
      var instance = new Constructor();
      if (Class) setPrototypeOf(instance, Class.prototype);
      return instance;
    };
  }

  return _construct.apply(null, arguments);
}

module.exports = _construct;

/***/ }),
/* 357 */,
/* 358 */,
/* 359 */,
/* 360 */,
/* 361 */,
/* 362 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var _interopRequireDefault = __webpack_require__(0);

var _Object$defineProperty = __webpack_require__(1);

_Object$defineProperty(exports, "__esModule", {
  value: true
});

exports.default = void 0;

var _keys = _interopRequireDefault(__webpack_require__(23));

var _classCallCheck2 = _interopRequireDefault(__webpack_require__(2));

var _createClass2 = _interopRequireDefault(__webpack_require__(3));

var _inherits2 = _interopRequireDefault(__webpack_require__(4));

var _createSuper2 = _interopRequireDefault(__webpack_require__(5));

var HooksBase = /*#__PURE__*/function (_elementorModules$Mod) {
  (0, _inherits2.default)(HooksBase, _elementorModules$Mod);

  var _super = (0, _createSuper2.default)(HooksBase);

  /**
   * Function constructor().
   *
   * Create hooks base.
   *
   * @param {{}} args
   */
  function HooksBase() {
    var _this;

    (0, _classCallCheck2.default)(this, HooksBase);

    for (var _len = arguments.length, args = new Array(_len), _key = 0; _key < _len; _key++) {
      args[_key] = arguments[_key];
    }

    _this = _super.call.apply(_super, [this].concat(args));
    /**
     * Current command.
     *
     * @type {string}
     */

    _this.current = '';
    /**
     * Array of ids which in use.
     *
     * @type {Array}
     */

    _this.usedIds = [];
    /**
     * Object of callbacks that was bound by container type.
     *
     * @type {{}}
     */

    _this.callbacks = {
      after: {},
      catch: {}
    };
    /**
     * Object of depth.
     *
     * @type {{}}
     */

    _this.depth = {
      after: {},
      catch: {}
    };
    _this.callbacksFlatList = [];
    return _this;
  }

  (0, _createClass2.default)(HooksBase, [{
    key: "activate",
    value: function activate() {
      this.getAll(true).forEach(function (callback) {
        callback.isActive = true;
      });
    }
  }, {
    key: "deactivate",
    value: function deactivate() {
      this.getAll(true).forEach(function (callback) {
        callback.isActive = false;
      });
    }
    /**
     * Function getType().
     *
     * Returns type eg: ( event, hook, etc ... ).
     *
     * @returns {string} type
     */

  }, {
    key: "getType",
    value: function getType() {
      elementorModules.forceMethodImplementation();
    }
    /**
     * Function getAll().
     *
     * Return all possible callbacks.
     *
     * @param {boolean} flat
     *
     * @returns {{}}
     */

  }, {
    key: "getAll",
    value: function getAll() {
      var _this2 = this;

      var flat = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : false;

      if (flat) {
        return this.callbacksFlatList;
      }

      var result = {};
      (0, _keys.default)(this.callbacks).forEach(function (event) {
        if (!result[event]) {
          result[event] = [];
        }

        (0, _keys.default)(_this2.callbacks[event]).forEach(function (command) {
          result[event].push({
            command: command,
            callbacks: _this2.callbacks[event][command]
          });
        });
      });
      return result;
    }
    /**
     * Function getCurrent();
     *
     * Return current command.
     *
     * @returns {string}
     */

  }, {
    key: "getCurrent",
    value: function getCurrent() {
      return this.current;
    }
    /**
     * Function getUsedIds().
     *
     * Returns the current used ids.
     *
     * @returns {Array}
     */

  }, {
    key: "getUsedIds",
    value: function getUsedIds() {
      return this.usedIds;
    }
    /**
     * Function getCallbacks().
     *
     * Get available callbacks for specific event and command.
     *
     * @param {string} event
     * @param {string} command
     *
     * @returns {(array|boolean)} callbacks
     */

  }, {
    key: "getCallbacks",
    value: function getCallbacks(event, command, args) {
      var _args$containers = args.containers,
          containers = _args$containers === void 0 ? [args.container] : _args$containers,
          containerType = containers[0] ? containers[0].type : false;
      var callbacks = [];

      if (this.callbacks[event] && this.callbacks[event][command]) {
        if (containerType && this.callbacks[event][command][containerType]) {
          callbacks = callbacks.concat(this.callbacks[event][command][containerType]);
        }

        if (this.callbacks[event][command].all) {
          callbacks = callbacks.concat(this.callbacks[event][command].all);
        }
      }

      if (callbacks.length) {
        return callbacks;
      }

      return false;
    }
    /**
     * function checkEvent().
     *
     * Validate if the event is available.
     *
     * @param {string} event
     */

  }, {
    key: "checkEvent",
    value: function checkEvent(event) {
      if (-1 === (0, _keys.default)(this.callbacks).indexOf(event)) {
        throw Error("".concat(this.getType(), ": '").concat(event, "' is not available."));
      }
    }
    /**
     * Function checkInstance().
     *
     * Validate given instance.
     *
     * @param {HookBase} instance
     */

  }, {
    key: "checkInstance",
    value: function checkInstance(instance) {
      if (instance.getType() !== this.getType()) {
        throw new Error("invalid instance, please use: 'elementor-api/modules/hook-base.js'. ");
      }
    }
    /**
     * Function checkId().
     *
     * Validate if the id is not used before.
     *
     * @param {string} id
     */

  }, {
    key: "checkId",
    value: function checkId(id) {
      if (-1 !== this.usedIds.indexOf(id)) {
        throw Error("id: '".concat(id, "' is already in use."));
      }
    }
    /**
     * Function shouldRun().
     *
     * Determine if the event should run.
     *
     * @param {array} callbacks
     *
     * @return {boolean}
     *
     * @throw {Error}
     */

  }, {
    key: "shouldRun",
    value: function shouldRun(callbacks) {
      return !!callbacks && callbacks.length;
    }
    /**
     * Function register().
     *
     * Register the callback instance.
     *
     * @param {string} event
     * @param {HookBase} instance
     *
     * @returns {{}} Created callback
     */

  }, {
    key: "register",
    value: function register(event, instance) {
      var command = instance.getCommand(),
          id = instance.getId(),
          containerType = instance.getContainerType();
      this.checkEvent(event);
      this.checkInstance(instance);
      this.checkId(id);
      return this.registerCallback(id, event, command, instance, containerType);
    }
    /**
     * Function registerCallback().
     *
     * Register callback.
     *
     * @param {string} id
     * @param {string} event
     * @param {string} command
     * @param {HookBase} instance
     * @param {string} containerType
     *
     * TODO: Consider replace with typedef.
     * @returns {{callback: *, id: *, isActive: boolean}}
     */

  }, {
    key: "registerCallback",
    value: function registerCallback(id, event, command, instance, containerType) {
      if (!this.callbacks[event][command]) {
        this.callbacks[event][command] = [];
      } // Save used id(s).


      this.usedIds.push(id);

      if (!this.callbacks[event][command]) {
        this.callbacks[event][command] = {};
      }

      var callback = {
        id: id,
        callback: instance.run.bind(instance),
        isActive: true
      };

      if (containerType) {
        if (!this.callbacks[event][command][containerType]) {
          this.callbacks[event][command][containerType] = [];
        }

        this.callbacks[event][command][containerType].push(callback);
      } else {
        if (!this.callbacks[event][command].all) {
          this.callbacks[event][command].all = [];
        }

        this.callbacks[event][command].all.push(callback);
      }

      this.callbacksFlatList.push(callback);
      return callback;
    }
    /**
     * Function run().
     *
     * Run the callbacks.
     *
     * @param {string} event
     * @param {string} command
     * @param {{}} args
     * @param {*} result
     *
     * @returns {boolean}
     */

  }, {
    key: "run",
    value: function run(event, command, args) {
      var result = arguments.length > 3 && arguments[3] !== undefined ? arguments[3] : undefined;
      var callbacks = this.getCallbacks(event, command, args);

      if (this.shouldRun(callbacks)) {
        this.current = command;
        this.onRun(command, args, event);
        this.runCallbacks(event, command, callbacks, args, result);
        return true;
      }

      return false;
    }
    /**
     * Function runCallbacks().
     *
     * Run's the given callbacks.
     *
     * @param {string} event
     * @param {string} command
     * @param {array} callbacks
     * @param {{}} args
     * @param {*} result
     */

  }, {
    key: "runCallbacks",
    value: function runCallbacks(event, command, callbacks, args, result) {
      for (var i in callbacks) {
        var callback = callbacks[i];

        if (!callback.isActive) {
          continue;
        } // If not exist, set zero.


        if (undefined === this.depth[event][callback.id]) {
          this.depth[event][callback.id] = 0;
        }

        this.depth[event][callback.id]++; // Prevent recursive hooks.

        if (1 === this.depth[event][callback.id]) {
          this.onCallback(command, args, event, callback.id);

          try {
            if (!this.runCallback(event, callback, args, result)) {
              throw Error("Callback failed, event: '".concat(event, "'"));
            }
          } catch (e) {
            // If its 'Hook-Break' then parent `try {}` will handle it.
            if (e instanceof $e.modules.HookBreak) {
              throw e;
            }

            elementorCommon.helpers.consoleError(e);
          }
        }

        this.depth[event][callback.id]--;
      }
    }
    /**
     * Function runCallback().
     *
     * Run's the given callback.
     *
     * @param {string} event
     * @param {{}} callback
     * @param {{}} args
     * @param {*} result
     *
     * @returns {boolean}
     *
     * @throw {Error}
     */

  }, {
    key: "runCallback",
    value: function runCallback(event, callback, args, result) {
      // eslint-disable-line no-unused-vars
      elementorModules.forceMethodImplementation();
    }
    /**
     * Function onRun().
     *
     * Called before run a set of callbacks.
     *
     * @param {string} command
     * @param {{}} args
     * @param {string} event
     *
     * @throw {Error}
     */

  }, {
    key: "onRun",
    value: function onRun(command, args, event) {
      // eslint-disable-line no-unused-vars
      elementorModules.forceMethodImplementation();
    }
    /**
     * Function onCallback().
     *
     * Called before a single callback.
     *
     * @param {string} command
     * @param {{}} args
     * @param {string} event
     * @param {string} id
     *
     * @throw {Error}
     */

  }, {
    key: "onCallback",
    value: function onCallback(command, args, event, id) {
      // eslint-disable-line no-unused-vars
      elementorModules.forceMethodImplementation();
    }
  }]);
  return HooksBase;
}(elementorModules.Module);

exports.default = HooksBase;

/***/ }),
/* 363 */,
/* 364 */,
/* 365 */,
/* 366 */,
/* 367 */,
/* 368 */,
/* 369 */,
/* 370 */,
/* 371 */,
/* 372 */,
/* 373 */,
/* 374 */,
/* 375 */,
/* 376 */,
/* 377 */,
/* 378 */,
/* 379 */,
/* 380 */,
/* 381 */,
/* 382 */,
/* 383 */,
/* 384 */,
/* 385 */,
/* 386 */,
/* 387 */,
/* 388 */,
/* 389 */,
/* 390 */,
/* 391 */,
/* 392 */,
/* 393 */,
/* 394 */,
/* 395 */,
/* 396 */,
/* 397 */,
/* 398 */,
/* 399 */,
/* 400 */,
/* 401 */,
/* 402 */,
/* 403 */,
/* 404 */,
/* 405 */,
/* 406 */,
/* 407 */,
/* 408 */,
/* 409 */,
/* 410 */,
/* 411 */,
/* 412 */,
/* 413 */,
/* 414 */,
/* 415 */,
/* 416 */,
/* 417 */,
/* 418 */,
/* 419 */,
/* 420 */,
/* 421 */,
/* 422 */,
/* 423 */,
/* 424 */,
/* 425 */,
/* 426 */,
/* 427 */,
/* 428 */,
/* 429 */,
/* 430 */,
/* 431 */,
/* 432 */,
/* 433 */,
/* 434 */,
/* 435 */,
/* 436 */,
/* 437 */,
/* 438 */,
/* 439 */,
/* 440 */,
/* 441 */,
/* 442 */,
/* 443 */,
/* 444 */,
/* 445 */,
/* 446 */,
/* 447 */,
/* 448 */,
/* 449 */,
/* 450 */,
/* 451 */,
/* 452 */,
/* 453 */,
/* 454 */,
/* 455 */,
/* 456 */,
/* 457 */,
/* 458 */,
/* 459 */,
/* 460 */,
/* 461 */,
/* 462 */,
/* 463 */,
/* 464 */,
/* 465 */,
/* 466 */,
/* 467 */,
/* 468 */,
/* 469 */,
/* 470 */,
/* 471 */,
/* 472 */,
/* 473 */,
/* 474 */,
/* 475 */,
/* 476 */,
/* 477 */,
/* 478 */,
/* 479 */,
/* 480 */,
/* 481 */,
/* 482 */,
/* 483 */,
/* 484 */,
/* 485 */,
/* 486 */,
/* 487 */,
/* 488 */,
/* 489 */,
/* 490 */,
/* 491 */,
/* 492 */,
/* 493 */,
/* 494 */,
/* 495 */,
/* 496 */,
/* 497 */,
/* 498 */,
/* 499 */,
/* 500 */,
/* 501 */,
/* 502 */,
/* 503 */,
/* 504 */,
/* 505 */,
/* 506 */,
/* 507 */,
/* 508 */,
/* 509 */,
/* 510 */,
/* 511 */,
/* 512 */,
/* 513 */,
/* 514 */,
/* 515 */,
/* 516 */,
/* 517 */,
/* 518 */,
/* 519 */,
/* 520 */,
/* 521 */,
/* 522 */,
/* 523 */,
/* 524 */,
/* 525 */,
/* 526 */,
/* 527 */,
/* 528 */,
/* 529 */,
/* 530 */,
/* 531 */,
/* 532 */,
/* 533 */,
/* 534 */,
/* 535 */,
/* 536 */,
/* 537 */,
/* 538 */,
/* 539 */,
/* 540 */,
/* 541 */,
/* 542 */,
/* 543 */,
/* 544 */,
/* 545 */,
/* 546 */,
/* 547 */,
/* 548 */,
/* 549 */,
/* 550 */,
/* 551 */,
/* 552 */,
/* 553 */,
/* 554 */,
/* 555 */,
/* 556 */,
/* 557 */,
/* 558 */,
/* 559 */,
/* 560 */,
/* 561 */,
/* 562 */,
/* 563 */,
/* 564 */,
/* 565 */,
/* 566 */,
/* 567 */,
/* 568 */,
/* 569 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var _interopRequireDefault = __webpack_require__(0);

var _Object$defineProperty = __webpack_require__(1);

_Object$defineProperty(exports, "__esModule", {
  value: true
});

exports.default = void 0;

var _stringify = _interopRequireDefault(__webpack_require__(183));

var _keys = _interopRequireDefault(__webpack_require__(23));

var _classCallCheck2 = _interopRequireDefault(__webpack_require__(2));

var _createClass2 = _interopRequireDefault(__webpack_require__(3));

var _inherits2 = _interopRequireDefault(__webpack_require__(4));

var _createSuper2 = _interopRequireDefault(__webpack_require__(5));

var _default = /*#__PURE__*/function (_elementorModules$Mod) {
  (0, _inherits2.default)(_default, _elementorModules$Mod);

  var _super = (0, _createSuper2.default)(_default);

  function _default() {
    (0, _classCallCheck2.default)(this, _default);
    return _super.apply(this, arguments);
  }

  (0, _createClass2.default)(_default, [{
    key: "get",
    value: function get(key, options) {
      options = options || {};
      var storage;

      try {
        storage = options.session ? sessionStorage : localStorage;
      } catch (e) {
        return key ? undefined : {};
      }

      var elementorStorage = storage.getItem('elementor');

      if (elementorStorage) {
        elementorStorage = JSON.parse(elementorStorage);
      } else {
        elementorStorage = {};
      }

      if (!elementorStorage.__expiration) {
        elementorStorage.__expiration = {};
      }

      var expiration = elementorStorage.__expiration;
      var expirationToCheck = [];

      if (key) {
        if (expiration[key]) {
          expirationToCheck = [key];
        }
      } else {
        expirationToCheck = (0, _keys.default)(expiration);
      }

      var entryExpired = false;
      expirationToCheck.forEach(function (expirationKey) {
        if (new Date(expiration[expirationKey]) < new Date()) {
          delete elementorStorage[expirationKey];
          delete expiration[expirationKey];
          entryExpired = true;
        }
      });

      if (entryExpired) {
        this.save(elementorStorage, options.session);
      }

      if (key) {
        return elementorStorage[key];
      }

      return elementorStorage;
    }
  }, {
    key: "set",
    value: function set(key, value, options) {
      options = options || {};
      var elementorStorage = this.get(null, options);
      elementorStorage[key] = value;

      if (options.lifetimeInSeconds) {
        var date = new Date();
        date.setTime(date.getTime() + options.lifetimeInSeconds * 1000);
        elementorStorage.__expiration[key] = date.getTime();
      }

      this.save(elementorStorage, options.session);
    }
  }, {
    key: "save",
    value: function save(object, session) {
      var storage;

      try {
        storage = session ? sessionStorage : localStorage;
      } catch (e) {
        return;
      }

      storage.setItem('elementor', (0, _stringify.default)(object));
    }
  }]);
  return _default;
}(elementorModules.Module);

exports.default = _default;

/***/ }),
/* 570 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var _interopRequireDefault = __webpack_require__(0);

var _Object$defineProperty = __webpack_require__(1);

_Object$defineProperty(exports, "__esModule", {
  value: true
});

exports.default = void 0;

var _values = _interopRequireDefault(__webpack_require__(115));

__webpack_require__(239);

__webpack_require__(178);

__webpack_require__(97);

var _keys = _interopRequireDefault(__webpack_require__(23));

var _classCallCheck2 = _interopRequireDefault(__webpack_require__(2));

var _createClass2 = _interopRequireDefault(__webpack_require__(3));

var _inherits2 = _interopRequireDefault(__webpack_require__(4));

var _createSuper2 = _interopRequireDefault(__webpack_require__(5));

var Commands = /*#__PURE__*/function (_elementorModules$Mod) {
  (0, _inherits2.default)(Commands, _elementorModules$Mod);

  var _super = (0, _createSuper2.default)(Commands);

  /**
   * Function constructor().
   *
   * Create `$e.commands` API.
   *
   * @param {{}} args
   */
  function Commands() {
    var _this;

    (0, _classCallCheck2.default)(this, Commands);

    for (var _len = arguments.length, args = new Array(_len), _key = 0; _key < _len; _key++) {
      args[_key] = arguments[_key];
    }

    _this = _super.call.apply(_super, [this].concat(args));
    _this.current = {};
    _this.currentArgs = {};
    _this.currentTrace = [];
    _this.commands = {};
    _this.components = {};
    return _this;
  }
  /**
   * Function getAll().
   *
   * Receive all loaded commands.
   *
   * @returns {string[]}
   */


  (0, _createClass2.default)(Commands, [{
    key: "getAll",
    value: function getAll() {
      return (0, _keys.default)(this.commands).sort();
    }
    /**
     * Function register().
     *
     * Register new command.
     *
     * @param {ComponentBase|string} component
     * @param {string} command
     * @param {function()} callback
     *
     * @returns {Commands}
     */

  }, {
    key: "register",
    value: function register(component, command, callback) {
      var _this2 = this;

      var namespace;

      if ('string' === typeof component) {
        namespace = component;
        component = $e.components.get(namespace);

        if (!component) {
          this.error("'".concat(namespace, "' component is not exist."));
        }
      } else {
        namespace = component.getNamespace();
      }

      var fullCommand = namespace + (command ? '/' + command : '');

      if (this.commands[fullCommand]) {
        this.error("`".concat(fullCommand, "` is already registered."));
      }

      this.commands[fullCommand] = callback;
      this.components[fullCommand] = namespace;
      var shortcuts = component.getShortcuts(),
          shortcut = shortcuts[command];

      if (shortcut) {
        shortcut.command = fullCommand;

        shortcut.callback = function (event) {
          return _this2.runShortcut(fullCommand, event);
        };

        $e.shortcuts.register(shortcut.keys, shortcut);
      }

      return this;
    }
  }, {
    key: "unregister",
    value: function unregister(component, command) {
      var namespace;

      if ('string' === typeof component) {
        namespace = component;
        component = $e.components.get(namespace);

        if (!component) {
          this.error("'".concat(namespace, "' component is not exist."));
        }
      } else {
        namespace = component.getNamespace();
      }

      var fullCommand = namespace + (command ? '/' + command : '');

      if (!this.commands[fullCommand]) {
        this.error("`".concat(fullCommand, "` not exist."));
      }

      delete this.commands[fullCommand];
      delete this.components[fullCommand];
      var shortcuts = component.getShortcuts(),
          shortcut = shortcuts[command];

      if (shortcut) {
        $e.shortcuts.unregister(shortcut.keys, shortcut);
      }

      return this;
    }
    /**
     * Function getComponent().
     *
     * Receive Component of the command.
     *
     * @param {string} command
     *
     * @returns {Component}
     */

  }, {
    key: "getComponent",
    value: function getComponent(command) {
      var namespace = this.components[command];
      return $e.components.get(namespace);
    }
    /**
     * Function is().
     *
     * Checks if current running command is the same parameter command.
     *
     * @param {string} command
     *
     * @returns {boolean}
     */

  }, {
    key: "is",
    value: function is(command) {
      var component = this.getComponent(command);

      if (!component) {
        return false;
      }

      return command === this.current[component.getRootContainer()];
    }
    /**
     * Function isCurrentFirstTrace().
     *
     * Checks if parameter command is the first command in trace that currently running.
     *
     * @param {string} command
     *
     * @returns {boolean}
     */

  }, {
    key: "isCurrentFirstTrace",
    value: function isCurrentFirstTrace(command) {
      return command === this.getCurrentFirstTrace();
    }
    /**
     * Function getCurrent().
     *
     * Receive currently running components and its commands.
     *
     * @param {string} container
     *
     * @returns {{}|boolean|*}
     */

  }, {
    key: "getCurrent",
    value: function getCurrent() {
      var container = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : '';

      if (container) {
        if (!this.current[container]) {
          return false;
        }

        return this.current[container];
      }

      return this.current;
    }
    /**
     * Function getCurrentArgs().
     *
     * Receive currently running command args.
     *
     * @param {string} container
     *
     * @returns {{}|boolean|*}
     */

  }, {
    key: "getCurrentArgs",
    value: function getCurrentArgs() {
      var container = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : '';

      if (container) {
        if (!this.currentArgs[container]) {
          return false;
        }

        return this.currentArgs[container];
      }

      return this.currentArgs;
    }
    /**
     * Function getCurrentFirst().
     *
     * Receive first command that currently running.
     *
     * @returns {string}
     */

  }, {
    key: "getCurrentFirst",
    value: function getCurrentFirst() {
      return (0, _values.default)(this.current)[0];
    }
    /**
     * Function getCurrentLast().
     *
     * Receive last command that currently running.
     *
     * @returns {string}
     */

  }, {
    key: "getCurrentLast",
    value: function getCurrentLast() {
      var current = (0, _values.default)(this.current);
      return current[current.length - 1];
    }
    /**
     * Function getCurrentFirstTrace().
     *
     * Receive first command in trace that currently running
     *
     * @returns {string}
     */

  }, {
    key: "getCurrentFirstTrace",
    value: function getCurrentFirstTrace() {
      return this.currentTrace[0];
    }
    /**
     * Function beforeRun().
     *
     * @param {string} command
     * @param {} args
     *
     * @returns {boolean} dependency result
     */

  }, {
    key: "beforeRun",
    value: function beforeRun(command) {
      var args = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : {};

      if (!this.commands[command]) {
        this.error("`".concat(command, "` not found."));
      }

      this.currentTrace.push(command);
      return this.getComponent(command).dependency(command, args);
    }
    /**
     * Function run().
     *
     * Runs a command.
     *
     * @param {string} command
     * @param {{}} args
     *
     * @returns {boolean|*} results
     */

  }, {
    key: "run",
    value: function run(command) {
      var args = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : {};

      if (!this.beforeRun(command, args)) {
        return false;
      }

      var component = this.getComponent(command),
          container = component.getRootContainer();
      this.current[container] = command;
      this.currentArgs[container] = args;
      this.trigger('run', component, command, args);

      if (args.onBefore) {
        args.onBefore.apply(component, [args]);
      }

      var results = this.commands[command].apply(component, [args]); // TODO: Consider add results to `$e.devTools`.

      if (args.onAfter) {
        args.onAfter.apply(component, [args, results]);
      }

      this.afterRun(command);

      if (false === args.returnValue) {
        return true;
      }

      return results;
    }
    /**
     * Function runShortcut().
     *
     * Run shortcut.
     *
     * It's separated in order to allow override.
     *
     * @param {string} command
     * @param {*} event
     *
     * @returns {boolean|*}
     */

  }, {
    key: "runShortcut",
    value: function runShortcut(command, event) {
      return this.run(command, event);
    }
    /**
     * Function afterRun().
     *
     * Method fired before the command runs.
     *
     * @param {string} command
     */

  }, {
    key: "afterRun",
    value: function afterRun(command) {
      var component = this.getComponent(command),
          container = component.getRootContainer();
      this.currentTrace.pop();
      delete this.current[container];
      delete this.currentArgs[container];
    }
    /**
     * Function error().
     *
     * Throws error.
     *
     * @throw {Error}
     *
     * @param {string} message
     */

  }, {
    key: "error",
    value: function error(message) {
      throw Error("Commands: ".concat(message));
    }
  }]);
  return Commands;
}(elementorModules.Module);

exports.default = Commands;

/***/ }),
/* 571 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var _interopRequireDefault = __webpack_require__(0);

var _Object$defineProperty = __webpack_require__(1);

_Object$defineProperty(exports, "__esModule", {
  value: true
});

exports.default = void 0;

var _classCallCheck2 = _interopRequireDefault(__webpack_require__(2));

var _inherits2 = _interopRequireDefault(__webpack_require__(4));

var _createSuper2 = _interopRequireDefault(__webpack_require__(5));

var _wrapNativeSuper2 = _interopRequireDefault(__webpack_require__(294));

var HookBreak = /*#__PURE__*/function (_Error) {
  (0, _inherits2.default)(HookBreak, _Error);

  var _super = (0, _createSuper2.default)(HookBreak);

  function HookBreak() {
    (0, _classCallCheck2.default)(this, HookBreak);
    return _super.call(this, 'HookBreak');
  }

  return HookBreak;
}( /*#__PURE__*/(0, _wrapNativeSuper2.default)(Error));

exports.default = HookBreak;

/***/ }),
/* 572 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var _interopRequireDefault = __webpack_require__(0);

var _Object$defineProperty = __webpack_require__(1);

_Object$defineProperty(exports, "__esModule", {
  value: true
});

exports.default = exports.Before = void 0;

var _classCallCheck2 = _interopRequireDefault(__webpack_require__(2));

var _createClass2 = _interopRequireDefault(__webpack_require__(3));

var _inherits2 = _interopRequireDefault(__webpack_require__(4));

var _createSuper2 = _interopRequireDefault(__webpack_require__(5));

var _base = _interopRequireDefault(__webpack_require__(272));

var Before = /*#__PURE__*/function (_Base) {
  (0, _inherits2.default)(Before, _Base);

  var _super = (0, _createSuper2.default)(Before);

  function Before() {
    (0, _classCallCheck2.default)(this, Before);
    return _super.apply(this, arguments);
  }

  (0, _createClass2.default)(Before, [{
    key: "register",
    value: function register() {
      $e.hooks.registerUIBefore(this);
    }
  }]);
  return Before;
}(_base.default);

exports.Before = Before;
var _default = Before;
exports.default = _default;

/***/ }),
/* 573 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var _interopRequireDefault = __webpack_require__(0);

var _Object$defineProperty = __webpack_require__(1);

_Object$defineProperty(exports, "__esModule", {
  value: true
});

exports.default = exports.Catch = void 0;

var _classCallCheck2 = _interopRequireDefault(__webpack_require__(2));

var _createClass2 = _interopRequireDefault(__webpack_require__(3));

var _inherits2 = _interopRequireDefault(__webpack_require__(4));

var _createSuper2 = _interopRequireDefault(__webpack_require__(5));

var _base = _interopRequireDefault(__webpack_require__(272));

var Catch = /*#__PURE__*/function (_Base) {
  (0, _inherits2.default)(Catch, _Base);

  var _super = (0, _createSuper2.default)(Catch);

  function Catch() {
    (0, _classCallCheck2.default)(this, Catch);
    return _super.apply(this, arguments);
  }

  (0, _createClass2.default)(Catch, [{
    key: "register",
    value: function register() {
      $e.hooks.registerUICatch(this);
    }
  }]);
  return Catch;
}(_base.default);

exports.Catch = Catch;
var _default = Catch;
exports.default = _default;

/***/ }),
/* 574 */,
/* 575 */,
/* 576 */,
/* 577 */,
/* 578 */,
/* 579 */,
/* 580 */,
/* 581 */,
/* 582 */,
/* 583 */,
/* 584 */,
/* 585 */,
/* 586 */,
/* 587 */,
/* 588 */,
/* 589 */,
/* 590 */,
/* 591 */,
/* 592 */,
/* 593 */,
/* 594 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var _interopRequireDefault = __webpack_require__(0);

var _Object$defineProperty = __webpack_require__(1);

_Object$defineProperty(exports, "__esModule", {
  value: true
});

exports.default = void 0;

var _values = _interopRequireDefault(__webpack_require__(115));

var _classCallCheck2 = _interopRequireDefault(__webpack_require__(2));

var _createClass2 = _interopRequireDefault(__webpack_require__(3));

var _inherits2 = _interopRequireDefault(__webpack_require__(4));

var _createSuper2 = _interopRequireDefault(__webpack_require__(5));

var _item = _interopRequireDefault(__webpack_require__(613));

var _itemModel = _interopRequireDefault(__webpack_require__(614));

var _default = /*#__PURE__*/function (_Marionette$Composite) {
  (0, _inherits2.default)(_default, _Marionette$Composite);

  var _super = (0, _createSuper2.default)(_default);

  function _default() {
    (0, _classCallCheck2.default)(this, _default);
    return _super.apply(this, arguments);
  }

  (0, _createClass2.default)(_default, [{
    key: "className",
    value: function className() {
      return 'elementor-finder__results__category';
    }
  }, {
    key: "getTemplate",
    value: function getTemplate() {
      return '#tmpl-elementor-finder__results__category';
    }
  }, {
    key: "getChildView",
    value: function getChildView() {
      return _item.default;
    }
  }, {
    key: "initialize",
    value: function initialize() {
      this.childViewContainer = '.elementor-finder__results__category__items';
      this.isVisible = true;
      var items = this.model.get('items');

      if (items) {
        items = (0, _values.default)(items);
      }

      this.collection = new Backbone.Collection(items, {
        model: _itemModel.default
      });
    }
  }, {
    key: "filter",
    value: function filter(childModel) {
      var textFilter = this.getTextFilter();

      if (childModel.get('title').toLowerCase().indexOf(textFilter) >= 0) {
        return true;
      }

      return childModel.get('keywords').some(function (keyword) {
        return keyword.indexOf(textFilter) >= 0;
      });
    }
  }, {
    key: "getTextFilter",
    value: function getTextFilter() {
      return elementorCommon.finder.channel.request('filter:text').trim().toLowerCase();
    }
  }, {
    key: "toggleElement",
    value: function toggleElement() {
      var isCurrentlyVisible = !!this.children.length;

      if (isCurrentlyVisible !== this.isVisible) {
        this.isVisible = isCurrentlyVisible;
        this.$el.toggle(isCurrentlyVisible);
        this.triggerMethod('toggle:visibility');
      }
    }
  }, {
    key: "onRender",
    value: function onRender() {
      this.listenTo(elementorCommon.finder.channel, 'filter:change', this.onFilterChange.bind(this));
    }
  }, {
    key: "onFilterChange",
    value: function onFilterChange() {
      this._renderChildren();
    }
  }, {
    key: "onRenderCollection",
    value: function onRenderCollection() {
      this.toggleElement();
    }
  }]);
  return _default;
}(Marionette.CompositeView);

exports.default = _default;

/***/ }),
/* 595 */,
/* 596 */,
/* 597 */,
/* 598 */,
/* 599 */,
/* 600 */,
/* 601 */,
/* 602 */,
/* 603 */,
/* 604 */,
/* 605 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var _interopRequireDefault = __webpack_require__(0);

__webpack_require__(53);

var _classCallCheck2 = _interopRequireDefault(__webpack_require__(2));

var _createClass2 = _interopRequireDefault(__webpack_require__(3));

var _get2 = _interopRequireDefault(__webpack_require__(22));

var _getPrototypeOf2 = _interopRequireDefault(__webpack_require__(14));

var _inherits2 = _interopRequireDefault(__webpack_require__(4));

var _createSuper2 = _interopRequireDefault(__webpack_require__(5));

var _helpers = _interopRequireDefault(__webpack_require__(606));

var _storage = _interopRequireDefault(__webpack_require__(569));

var _ajax = _interopRequireDefault(__webpack_require__(607));

var _finder = _interopRequireDefault(__webpack_require__(608));

var _connect = _interopRequireDefault(__webpack_require__(616));

var _api = _interopRequireDefault(__webpack_require__(617));

var ElementorCommonApp = /*#__PURE__*/function (_elementorModules$Vie) {
  (0, _inherits2.default)(ElementorCommonApp, _elementorModules$Vie);

  var _super = (0, _createSuper2.default)(ElementorCommonApp);

  function ElementorCommonApp() {
    (0, _classCallCheck2.default)(this, ElementorCommonApp);
    return _super.apply(this, arguments);
  }

  (0, _createClass2.default)(ElementorCommonApp, [{
    key: "setMarionetteTemplateCompiler",
    value: function setMarionetteTemplateCompiler() {
      Marionette.TemplateCache.prototype.compileTemplate = function (rawTemplate, options) {
        options = {
          evaluate: /<#([\s\S]+?)#>/g,
          interpolate: /{{{([\s\S]+?)}}}/g,
          escape: /{{([^}]+?)}}(?!})/g
        };
        return _.template(rawTemplate, options);
      };
    }
  }, {
    key: "getDefaultElements",
    value: function getDefaultElements() {
      return {
        $window: jQuery(window),
        $document: jQuery(document),
        $body: jQuery(document.body)
      };
    }
  }, {
    key: "initComponents",
    value: function initComponents() {
      this.helpers = new _helpers.default();
      this.storage = new _storage.default();
      this.dialogsManager = new DialogsManager.Instance();
      this.api = new _api.default();
      this.initModules();
    }
  }, {
    key: "initModules",
    value: function initModules() {
      var _this = this;

      var activeModules = this.config.activeModules;
      var modules = {
        ajax: _ajax.default,
        finder: _finder.default,
        connect: _connect.default
      };
      activeModules.forEach(function (name) {
        if (modules[name]) {
          _this[name] = new modules[name](_this.config[name]);
        }
      });
    }
  }, {
    key: "compileArrayTemplateArgs",
    value: function compileArrayTemplateArgs(template, templateArgs) {
      return template.replace(/%(?:(\d+)\$)?s/g, function (match, number) {
        if (!number) {
          number = 1;
        }

        number--;
        return undefined !== templateArgs[number] ? templateArgs[number] : match;
      });
    }
  }, {
    key: "compileObjectTemplateArgs",
    value: function compileObjectTemplateArgs(template, templateArgs) {
      return template.replace(/{{(?:([ \w]+))}}/g, function (match, name) {
        return templateArgs[name] ? templateArgs[name] : match;
      });
    }
  }, {
    key: "compileTemplate",
    value: function compileTemplate(template, templateArgs) {
      return jQuery.isPlainObject(templateArgs) ? this.compileObjectTemplateArgs(template, templateArgs) : this.compileArrayTemplateArgs(template, templateArgs);
    }
  }, {
    key: "translate",
    value: function translate(stringKey, context, templateArgs, i18nStack) {
      if (context) {
        i18nStack = this.config[context].i18n;
      }

      if (!i18nStack) {
        i18nStack = this.config.i18n;
      }

      var string = i18nStack[stringKey];

      if (undefined === string) {
        string = stringKey;
      }

      if (templateArgs) {
        string = this.compileTemplate(string, templateArgs);
      }

      return string;
    }
  }, {
    key: "onInit",
    value: function onInit() {
      (0, _get2.default)((0, _getPrototypeOf2.default)(ElementorCommonApp.prototype), "onInit", this).call(this);
      this.config = elementorCommonConfig;
      this.setMarionetteTemplateCompiler();
    }
  }]);
  return ElementorCommonApp;
}(elementorModules.ViewModule);

window.elementorCommon = new ElementorCommonApp();
elementorCommon.initComponents();

/***/ }),
/* 606 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var _interopRequireDefault = __webpack_require__(0);

var _Object$defineProperty = __webpack_require__(1);

_Object$defineProperty(exports, "__esModule", {
  value: true
});

exports.default = void 0;

__webpack_require__(53);

var _stringify = _interopRequireDefault(__webpack_require__(183));

var _classCallCheck2 = _interopRequireDefault(__webpack_require__(2));

var _createClass2 = _interopRequireDefault(__webpack_require__(3));

var Helpers = /*#__PURE__*/function () {
  function Helpers() {
    (0, _classCallCheck2.default)(this, Helpers);
  }

  (0, _createClass2.default)(Helpers, [{
    key: "softDeprecated",
    value: function softDeprecated(name, version, replacement) {
      if (elementorCommon.config.isDebug) {
        this.deprecatedMessage('soft', name, version, replacement);
      }
    }
  }, {
    key: "hardDeprecated",
    value: function hardDeprecated(name, version, replacement) {
      this.deprecatedMessage('hard', name, version, replacement);
    }
  }, {
    key: "deprecatedMessage",
    value: function deprecatedMessage(type, name, version, replacement) {
      var message = "%c   %c`".concat(name, "` is ").concat(type, " deprecated since ").concat(version);

      if (replacement) {
        message += " - Use `".concat(replacement, "` instead");
      }

      this.consoleWarn(message);
    }
  }, {
    key: "consoleWarn",
    value: function consoleWarn() {
      var _console;

      var style = "font-size: 12px; background-image: url(\"".concat(elementorCommon.config.urls.assets, "images/logo-icon.png\"); background-repeat: no-repeat; background-size: contain;");

      for (var _len = arguments.length, args = new Array(_len), _key = 0; _key < _len; _key++) {
        args[_key] = arguments[_key];
      }

      args.push(style, '');

      (_console = console).warn.apply(_console, args); // eslint-disable-line no-console

    }
  }, {
    key: "consoleError",
    value: function consoleError(message) {
      // TODO: function is part of $e.
      // Show an error if devTools is available.
      if ($e.devTools) {
        $e.devTools.log.error(message);
      } // If not a 'Hook-Break' then show error.


      if (!(message instanceof $e.modules.HookBreak)) {
        // eslint-disable-next-line no-console
        console.error(message);
      }
    }
  }, {
    key: "deprecatedMethod",
    value: function deprecatedMethod(methodName, version, replacement) {
      this.deprecatedMessage('hard', methodName, version, replacement); // This itself is deprecated.

      this.softDeprecated('elementorCommon.helpers.deprecatedMethod', '2.8.0', 'elementorCommon.helpers.softDeprecated || elementorCommon.helpers.hardDeprecated');
    }
  }, {
    key: "cloneObject",
    value: function cloneObject(object) {
      return JSON.parse((0, _stringify.default)(object));
    }
  }, {
    key: "upperCaseWords",
    value: function upperCaseWords(string) {
      return (string + '').replace(/^(.)|\s+(.)/g, function ($1) {
        return $1.toUpperCase();
      });
    }
  }]);
  return Helpers;
}();

exports.default = Helpers;

/***/ }),
/* 607 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var _interopRequireDefault = __webpack_require__(0);

var _Object$defineProperty = __webpack_require__(1);

_Object$defineProperty(exports, "__esModule", {
  value: true
});

exports.default = void 0;

var _values = _interopRequireDefault(__webpack_require__(115));

var _slicedToArray2 = _interopRequireDefault(__webpack_require__(85));

var _entries = _interopRequireDefault(__webpack_require__(66));

var _stringify = _interopRequireDefault(__webpack_require__(183));

var _classCallCheck2 = _interopRequireDefault(__webpack_require__(2));

var _assertThisInitialized2 = _interopRequireDefault(__webpack_require__(49));

var _createClass2 = _interopRequireDefault(__webpack_require__(3));

var _inherits2 = _interopRequireDefault(__webpack_require__(4));

var _createSuper2 = _interopRequireDefault(__webpack_require__(5));

var _default = /*#__PURE__*/function (_elementorModules$Mod) {
  (0, _inherits2.default)(_default, _elementorModules$Mod);

  var _super = (0, _createSuper2.default)(_default);

  (0, _createClass2.default)(_default, [{
    key: "getDefaultSettings",
    value: function getDefaultSettings() {
      return {
        ajaxParams: {
          type: 'POST',
          url: elementorCommon.config.ajax.url,
          data: {},
          dataType: 'json'
        },
        actionPrefix: 'elementor_'
      };
    }
  }]);

  function _default() {
    var _this;

    (0, _classCallCheck2.default)(this, _default);

    for (var _len = arguments.length, args = new Array(_len), _key = 0; _key < _len; _key++) {
      args[_key] = arguments[_key];
    }

    _this = _super.call.apply(_super, [this].concat(args));
    _this.requests = {};
    _this.cache = {};

    _this.initRequestConstants();

    _this.debounceSendBatch = _.debounce(_this.sendBatch.bind((0, _assertThisInitialized2.default)(_this)), 500);
    return _this;
  }

  (0, _createClass2.default)(_default, [{
    key: "initRequestConstants",
    value: function initRequestConstants() {
      this.requestConstants = {
        _nonce: this.getSettings('nonce')
      };
    }
  }, {
    key: "addRequestConstant",
    value: function addRequestConstant(key, value) {
      this.requestConstants[key] = value;
    }
  }, {
    key: "getCacheKey",
    value: function getCacheKey(request) {
      return (0, _stringify.default)({
        unique_id: request.unique_id,
        data: request.data
      });
    }
  }, {
    key: "loadObjects",
    value: function loadObjects(options) {
      var _this2 = this;

      var dataCollection = {};
      var deferredArray = [];

      if (options.before) {
        options.before();
      }

      options.ids.forEach(function (objectId) {
        deferredArray.push(_this2.load({
          action: options.action,
          unique_id: options.data.unique_id + objectId,
          data: jQuery.extend({
            id: objectId
          }, options.data)
        }).done(function (data) {
          return dataCollection = jQuery.extend(dataCollection, data);
        }));
      });
      jQuery.when.apply(jQuery, deferredArray).done(function () {
        return options.success(dataCollection);
      });
    }
  }, {
    key: "load",
    value: function load(request, immediately) {
      var _this3 = this;

      if (!request.unique_id) {
        request.unique_id = request.action;
      }

      if (request.before) {
        request.before();
      }

      var deferred;
      var cacheKey = this.getCacheKey(request);

      if (_.has(this.cache, cacheKey)) {
        deferred = jQuery.Deferred().done(request.success).resolve(this.cache[cacheKey]);
      } else {
        deferred = this.addRequest(request.action, {
          data: request.data,
          unique_id: request.unique_id,
          success: function success(data) {
            return _this3.cache[cacheKey] = data;
          }
        }, immediately).done(request.success);
      }

      return deferred;
    }
  }, {
    key: "addRequest",
    value: function addRequest(action, options, immediately) {
      options = options || {};

      if (!options.unique_id) {
        options.unique_id = action;
      }

      options.deferred = jQuery.Deferred().done(options.success).fail(options.error).always(options.complete);
      var request = {
        action: action,
        options: options
      };

      if (immediately) {
        var requests = {};
        requests[options.unique_id] = request;
        options.deferred.jqXhr = this.sendBatch(requests);
      } else {
        this.requests[options.unique_id] = request;
        this.debounceSendBatch();
      }

      return options.deferred;
    }
  }, {
    key: "sendBatch",
    value: function sendBatch(requests) {
      var actions = {};

      if (!requests) {
        requests = this.requests; // Empty for next batch.

        this.requests = {};
      }

      (0, _entries.default)(requests).forEach(function (_ref) {
        var _ref2 = (0, _slicedToArray2.default)(_ref, 2),
            id = _ref2[0],
            request = _ref2[1];

        return actions[id] = {
          action: request.action,
          data: request.options.data
        };
      });
      return this.send('ajax', {
        data: {
          actions: (0, _stringify.default)(actions)
        },
        success: function success(data) {
          (0, _entries.default)(data.responses).forEach(function (_ref3) {
            var _ref4 = (0, _slicedToArray2.default)(_ref3, 2),
                id = _ref4[0],
                response = _ref4[1];

            var options = requests[id].options;

            if (options) {
              if (response.success) {
                options.deferred.resolve(response.data);
              } else if (!response.success) {
                options.deferred.reject(response.data);
              }
            }
          });
        },
        error: function error(data) {
          return (0, _values.default)(requests).forEach(function (args) {
            if (args.options) {
              args.options.deferred.reject(data);
            }
          });
        }
      });
    }
  }, {
    key: "prepareSend",
    value: function prepareSend(action, options) {
      var _this4 = this;

      var settings = this.getSettings(),
          ajaxParams = elementorCommon.helpers.cloneObject(settings.ajaxParams);
      options = options || {};
      action = settings.actionPrefix + action;
      jQuery.extend(ajaxParams, options);
      var requestConstants = elementorCommon.helpers.cloneObject(this.requestConstants);
      requestConstants.action = action;
      var isFormData = ajaxParams.data instanceof FormData;
      (0, _entries.default)(requestConstants).forEach(function (_ref5) {
        var _ref6 = (0, _slicedToArray2.default)(_ref5, 2),
            key = _ref6[0],
            value = _ref6[1];

        if (isFormData) {
          ajaxParams.data.append(key, value);
        } else {
          ajaxParams.data[key] = value;
        }
      });
      var successCallback = ajaxParams.success,
          errorCallback = ajaxParams.error;

      if (successCallback || errorCallback) {
        ajaxParams.success = function (response) {
          if (response.success && successCallback) {
            successCallback(response.data);
          }

          if (!response.success && errorCallback) {
            errorCallback(response.data);
          }
        };

        if (errorCallback) {
          ajaxParams.error = function (data) {
            return errorCallback(data);
          };
        } else {
          ajaxParams.error = function (xmlHttpRequest) {
            if (xmlHttpRequest.readyState || 'abort' !== xmlHttpRequest.statusText) {
              _this4.trigger('request:unhandledError', xmlHttpRequest);
            }
          };
        }
      }

      return ajaxParams;
    }
  }, {
    key: "send",
    value: function send(action, options) {
      return jQuery.ajax(this.prepareSend(action, options));
    }
  }, {
    key: "addRequestCache",
    value: function addRequestCache(request, data) {
      var cacheKey = this.getCacheKey(request);
      this.cache[cacheKey] = data;
    }
  }, {
    key: "invalidateCache",
    value: function invalidateCache(request) {
      var cacheKey = this.getCacheKey(request);
      delete this.cache[cacheKey];
    }
  }]);
  return _default;
}(elementorModules.Module);

exports.default = _default;

/***/ }),
/* 608 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var _interopRequireDefault = __webpack_require__(0);

var _Object$defineProperty = __webpack_require__(1);

_Object$defineProperty(exports, "__esModule", {
  value: true
});

exports.default = void 0;

var _classCallCheck2 = _interopRequireDefault(__webpack_require__(2));

var _createClass2 = _interopRequireDefault(__webpack_require__(3));

var _inherits2 = _interopRequireDefault(__webpack_require__(4));

var _createSuper2 = _interopRequireDefault(__webpack_require__(5));

var _component = _interopRequireDefault(__webpack_require__(609));

var _default = /*#__PURE__*/function (_elementorModules$Mod) {
  (0, _inherits2.default)(_default, _elementorModules$Mod);

  var _super = (0, _createSuper2.default)(_default);

  function _default() {
    (0, _classCallCheck2.default)(this, _default);
    return _super.apply(this, arguments);
  }

  (0, _createClass2.default)(_default, [{
    key: "onInit",
    value: function onInit() {
      this.channel = Backbone.Radio.channel('ELEMENTOR:finder');
      $e.components.register(new _component.default({
        manager: this
      }));
    }
  }]);
  return _default;
}(elementorModules.Module);

exports.default = _default;

/***/ }),
/* 609 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var _interopRequireDefault = __webpack_require__(0);

var _Object$defineProperty = __webpack_require__(1);

_Object$defineProperty(exports, "__esModule", {
  value: true
});

exports.default = void 0;

var _assign = _interopRequireDefault(__webpack_require__(177));

var _classCallCheck2 = _interopRequireDefault(__webpack_require__(2));

var _createClass2 = _interopRequireDefault(__webpack_require__(3));

var _get2 = _interopRequireDefault(__webpack_require__(22));

var _getPrototypeOf2 = _interopRequireDefault(__webpack_require__(14));

var _inherits2 = _interopRequireDefault(__webpack_require__(4));

var _createSuper2 = _interopRequireDefault(__webpack_require__(5));

var _componentModalBase = _interopRequireDefault(__webpack_require__(234));

var _modalLayout = _interopRequireDefault(__webpack_require__(610));

var Component = /*#__PURE__*/function (_ComponentModalBase) {
  (0, _inherits2.default)(Component, _ComponentModalBase);

  var _super = (0, _createSuper2.default)(Component);

  function Component() {
    (0, _classCallCheck2.default)(this, Component);
    return _super.apply(this, arguments);
  }

  (0, _createClass2.default)(Component, [{
    key: "getNamespace",
    value: function getNamespace() {
      return 'finder';
    }
  }, {
    key: "defaultShortcuts",
    value: function defaultShortcuts() {
      var _this = this;

      return {
        '': {
          keys: 'ctrl+e'
        },
        'navigate/down': {
          keys: 'down',
          scopes: [this.getNamespace()],
          dependency: function dependency() {
            return _this.getItemsView();
          }
        },
        'navigate/up': {
          keys: 'up',
          scopes: [this.getNamespace()],
          dependency: function dependency() {
            return _this.getItemsView();
          }
        },
        'navigate/select': {
          keys: 'enter',
          scopes: [this.getNamespace()],
          dependency: function dependency() {
            return _this.getItemsView().$activeItem;
          }
        }
      };
    }
  }, {
    key: "defaultCommands",
    value: function defaultCommands() {
      var _this2 = this;

      return (0, _assign.default)((0, _get2.default)((0, _getPrototypeOf2.default)(Component.prototype), "defaultCommands", this).call(this), {
        'navigate/down': function navigateDown() {
          return _this2.getItemsView().activateNextItem();
        },
        'navigate/up': function navigateUp() {
          return _this2.getItemsView().activateNextItem(true);
        },
        'navigate/select': function navigateSelect(event) {
          return _this2.getItemsView().goToActiveItem(event);
        }
      });
    }
  }, {
    key: "getModalLayout",
    value: function getModalLayout() {
      return _modalLayout.default;
    }
  }, {
    key: "getItemsView",
    value: function getItemsView() {
      return this.layout.modalContent.currentView.content.currentView;
    }
  }]);
  return Component;
}(_componentModalBase.default);

exports.default = Component;

/***/ }),
/* 610 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var _interopRequireDefault = __webpack_require__(0);

var _Object$defineProperty = __webpack_require__(1);

_Object$defineProperty(exports, "__esModule", {
  value: true
});

exports.default = void 0;

var _classCallCheck2 = _interopRequireDefault(__webpack_require__(2));

var _createClass2 = _interopRequireDefault(__webpack_require__(3));

var _get4 = _interopRequireDefault(__webpack_require__(22));

var _getPrototypeOf2 = _interopRequireDefault(__webpack_require__(14));

var _inherits2 = _interopRequireDefault(__webpack_require__(4));

var _createSuper2 = _interopRequireDefault(__webpack_require__(5));

var _modalContent = _interopRequireDefault(__webpack_require__(611));

var _default = /*#__PURE__*/function (_elementorModules$com) {
  (0, _inherits2.default)(_default, _elementorModules$com);

  var _super = (0, _createSuper2.default)(_default);

  function _default() {
    (0, _classCallCheck2.default)(this, _default);
    return _super.apply(this, arguments);
  }

  (0, _createClass2.default)(_default, [{
    key: "getModalOptions",
    value: function getModalOptions() {
      return {
        id: 'elementor-finder__modal',
        draggable: true,
        effects: {
          show: 'show',
          hide: 'hide'
        },
        position: {
          enable: false
        }
      };
    }
  }, {
    key: "getLogoOptions",
    value: function getLogoOptions() {
      return {
        title: elementorCommon.translate('finder', 'finder')
      };
    }
  }, {
    key: "initialize",
    value: function initialize() {
      var _get2;

      for (var _len = arguments.length, args = new Array(_len), _key = 0; _key < _len; _key++) {
        args[_key] = arguments[_key];
      }

      (_get2 = (0, _get4.default)((0, _getPrototypeOf2.default)(_default.prototype), "initialize", this)).call.apply(_get2, [this].concat(args));

      this.showLogo();
      this.showContentView();
    }
  }, {
    key: "showContentView",
    value: function showContentView() {
      this.modalContent.show(new _modalContent.default());
    }
  }, {
    key: "showModal",
    value: function showModal() {
      var _get3;

      for (var _len2 = arguments.length, args = new Array(_len2), _key2 = 0; _key2 < _len2; _key2++) {
        args[_key2] = arguments[_key2];
      }

      (_get3 = (0, _get4.default)((0, _getPrototypeOf2.default)(_default.prototype), "showModal", this)).call.apply(_get3, [this].concat(args));

      this.modalContent.currentView.ui.searchInput.focus();
    }
  }]);
  return _default;
}(elementorModules.common.views.modal.Layout);

exports.default = _default;

/***/ }),
/* 611 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var _interopRequireDefault = __webpack_require__(0);

var _Object$defineProperty = __webpack_require__(1);

_Object$defineProperty(exports, "__esModule", {
  value: true
});

exports.default = void 0;

var _classCallCheck2 = _interopRequireDefault(__webpack_require__(2));

var _createClass2 = _interopRequireDefault(__webpack_require__(3));

var _inherits2 = _interopRequireDefault(__webpack_require__(4));

var _createSuper2 = _interopRequireDefault(__webpack_require__(5));

var _categories = _interopRequireDefault(__webpack_require__(612));

var _default = /*#__PURE__*/function (_Marionette$LayoutVie) {
  (0, _inherits2.default)(_default, _Marionette$LayoutVie);

  var _super = (0, _createSuper2.default)(_default);

  function _default() {
    (0, _classCallCheck2.default)(this, _default);
    return _super.apply(this, arguments);
  }

  (0, _createClass2.default)(_default, [{
    key: "id",
    value: function id() {
      return 'elementor-finder';
    }
  }, {
    key: "getTemplate",
    value: function getTemplate() {
      return '#tmpl-elementor-finder';
    }
  }, {
    key: "ui",
    value: function ui() {
      return {
        searchInput: '#elementor-finder__search__input'
      };
    }
  }, {
    key: "events",
    value: function events() {
      return {
        'input @ui.searchInput': 'onSearchInputInput'
      };
    }
  }, {
    key: "regions",
    value: function regions() {
      return {
        content: '#elementor-finder__content'
      };
    }
  }, {
    key: "showCategoriesView",
    value: function showCategoriesView() {
      this.content.show(new _categories.default());
    }
  }, {
    key: "onSearchInputInput",
    value: function onSearchInputInput() {
      var value = this.ui.searchInput.val();

      if (value) {
        elementorCommon.finder.channel.reply('filter:text', value).trigger('filter:change');

        if (!(this.content.currentView instanceof _categories.default)) {
          this.showCategoriesView();
        }
      }

      this.content.currentView.$el.toggle(!!value);
    }
  }]);
  return _default;
}(Marionette.LayoutView);

exports.default = _default;

/***/ }),
/* 612 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var _interopRequireDefault = __webpack_require__(0);

var _Object$defineProperty = __webpack_require__(1);

_Object$defineProperty(exports, "__esModule", {
  value: true
});

exports.default = void 0;

var _values = _interopRequireDefault(__webpack_require__(115));

var _classCallCheck2 = _interopRequireDefault(__webpack_require__(2));

var _createClass2 = _interopRequireDefault(__webpack_require__(3));

var _inherits2 = _interopRequireDefault(__webpack_require__(4));

var _createSuper2 = _interopRequireDefault(__webpack_require__(5));

var _category = _interopRequireDefault(__webpack_require__(594));

var _dynamicCategory = _interopRequireDefault(__webpack_require__(615));

var _default = /*#__PURE__*/function (_Marionette$Composite) {
  (0, _inherits2.default)(_default, _Marionette$Composite);

  var _super = (0, _createSuper2.default)(_default);

  function _default() {
    (0, _classCallCheck2.default)(this, _default);
    return _super.apply(this, arguments);
  }

  (0, _createClass2.default)(_default, [{
    key: "id",
    value: function id() {
      return 'elementor-finder__results-container';
    }
  }, {
    key: "ui",
    value: function ui() {
      return {
        noResults: '#elementor-finder__no-results',
        categoryItem: '.elementor-finder__results__item'
      };
    }
  }, {
    key: "events",
    value: function events() {
      return {
        'mouseenter @ui.categoryItem': 'onCategoryItemMouseEnter'
      };
    }
  }, {
    key: "getTemplate",
    value: function getTemplate() {
      return '#tmpl-elementor-finder-results-container';
    }
  }, {
    key: "getChildView",
    value: function getChildView(childModel) {
      return childModel.get('dynamic') ? _dynamicCategory.default : _category.default;
    }
  }, {
    key: "initialize",
    value: function initialize() {
      this.$activeItem = null;
      this.childViewContainer = '#elementor-finder__results';
      this.collection = new Backbone.Collection((0, _values.default)(elementorCommon.finder.getSettings('data')));
    }
  }, {
    key: "activateItem",
    value: function activateItem($item) {
      if (this.$activeItem) {
        this.$activeItem.removeClass('elementor-active');
      }

      $item.addClass('elementor-active');
      this.$activeItem = $item;
    }
  }, {
    key: "activateNextItem",
    value: function activateNextItem(reverse) {
      var $allItems = jQuery(this.ui.categoryItem.selector);
      var nextItemIndex = 0;

      if (this.$activeItem) {
        nextItemIndex = $allItems.index(this.$activeItem) + (reverse ? -1 : 1);

        if (nextItemIndex >= $allItems.length) {
          nextItemIndex = 0;
        } else if (nextItemIndex < 0) {
          nextItemIndex = $allItems.length - 1;
        }
      }

      var $nextItem = $allItems.eq(nextItemIndex);
      this.activateItem($nextItem);
      $nextItem[0].scrollIntoView({
        block: 'nearest'
      });
    }
  }, {
    key: "goToActiveItem",
    value: function goToActiveItem(event) {
      var $a = this.$activeItem.children('a'),
          isControlClicked = $e.shortcuts.isControlEvent(event);

      if (isControlClicked) {
        $a.attr('target', '_blank');
      }

      $a[0].click();

      if (isControlClicked) {
        $a.removeAttr('target');
      }
    }
  }, {
    key: "onCategoryItemMouseEnter",
    value: function onCategoryItemMouseEnter(event) {
      this.activateItem(jQuery(event.currentTarget));
    }
  }, {
    key: "onChildviewToggleVisibility",
    value: function onChildviewToggleVisibility() {
      var allCategoriesAreEmpty = this.children.every(function (child) {
        return !child.isVisible;
      });
      this.ui.noResults.toggle(allCategoriesAreEmpty);
    }
  }]);
  return _default;
}(Marionette.CompositeView);

exports.default = _default;

/***/ }),
/* 613 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var _interopRequireDefault = __webpack_require__(0);

var _Object$defineProperty = __webpack_require__(1);

_Object$defineProperty(exports, "__esModule", {
  value: true
});

exports.default = void 0;

var _classCallCheck2 = _interopRequireDefault(__webpack_require__(2));

var _createClass2 = _interopRequireDefault(__webpack_require__(3));

var _inherits2 = _interopRequireDefault(__webpack_require__(4));

var _createSuper2 = _interopRequireDefault(__webpack_require__(5));

var _default = /*#__PURE__*/function (_Marionette$ItemView) {
  (0, _inherits2.default)(_default, _Marionette$ItemView);

  var _super = (0, _createSuper2.default)(_default);

  function _default() {
    (0, _classCallCheck2.default)(this, _default);
    return _super.apply(this, arguments);
  }

  (0, _createClass2.default)(_default, [{
    key: "className",
    value: function className() {
      return 'elementor-finder__results__item';
    }
  }, {
    key: "getTemplate",
    value: function getTemplate() {
      return '#tmpl-elementor-finder__results__item';
    }
  }]);
  return _default;
}(Marionette.ItemView);

exports.default = _default;

/***/ }),
/* 614 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var _interopRequireDefault = __webpack_require__(0);

var _Object$defineProperty = __webpack_require__(1);

_Object$defineProperty(exports, "__esModule", {
  value: true
});

exports.default = void 0;

var _classCallCheck2 = _interopRequireDefault(__webpack_require__(2));

var _createClass2 = _interopRequireDefault(__webpack_require__(3));

var _inherits2 = _interopRequireDefault(__webpack_require__(4));

var _createSuper2 = _interopRequireDefault(__webpack_require__(5));

var _default = /*#__PURE__*/function (_Backbone$Model) {
  (0, _inherits2.default)(_default, _Backbone$Model);

  var _super = (0, _createSuper2.default)(_default);

  function _default() {
    (0, _classCallCheck2.default)(this, _default);
    return _super.apply(this, arguments);
  }

  (0, _createClass2.default)(_default, [{
    key: "defaults",
    value: function defaults() {
      return {
        description: '',
        icon: 'settings',
        url: '',
        keywords: [],
        actions: []
      };
    }
  }]);
  return _default;
}(Backbone.Model);

exports.default = _default;

/***/ }),
/* 615 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var _interopRequireDefault = __webpack_require__(0);

var _Object$defineProperty = __webpack_require__(1);

_Object$defineProperty(exports, "__esModule", {
  value: true
});

exports.default = void 0;

var _classCallCheck2 = _interopRequireDefault(__webpack_require__(2));

var _createClass2 = _interopRequireDefault(__webpack_require__(3));

var _get2 = _interopRequireDefault(__webpack_require__(22));

var _getPrototypeOf2 = _interopRequireDefault(__webpack_require__(14));

var _inherits2 = _interopRequireDefault(__webpack_require__(4));

var _createSuper2 = _interopRequireDefault(__webpack_require__(5));

var _category = _interopRequireDefault(__webpack_require__(594));

var _default = /*#__PURE__*/function (_Category) {
  (0, _inherits2.default)(_default, _Category);

  var _super = (0, _createSuper2.default)(_default);

  function _default() {
    (0, _classCallCheck2.default)(this, _default);
    return _super.apply(this, arguments);
  }

  (0, _createClass2.default)(_default, [{
    key: "className",
    value: function className() {
      return (0, _get2.default)((0, _getPrototypeOf2.default)(_default.prototype), "className", this).call(this) + ' elementor-finder__results__category--dynamic';
    }
  }, {
    key: "ui",
    value: function ui() {
      return {
        title: '.elementor-finder__results__category__title'
      };
    }
  }, {
    key: "fetchData",
    value: function fetchData() {
      var _this = this;

      this.ui.loadingIcon.show();
      elementorCommon.ajax.addRequest('finder_get_category_items', {
        data: {
          category: this.model.get('name'),
          filter: this.getTextFilter()
        },
        success: function success(data) {
          if (_this.isDestroyed) {
            return;
          }

          _this.collection.set(data);

          _this.toggleElement();

          _this.ui.loadingIcon.hide();
        }
      });
    }
  }, {
    key: "filter",
    value: function filter() {
      return true;
    }
  }, {
    key: "onFilterChange",
    value: function onFilterChange() {
      this.fetchData();
    }
  }, {
    key: "onRender",
    value: function onRender() {
      (0, _get2.default)((0, _getPrototypeOf2.default)(_default.prototype), "onRender", this).call(this);
      this.ui.loadingIcon = jQuery('<i>', {
        class: 'eicon-loading eicon-animation-spin'
      });
      this.ui.title.after(this.ui.loadingIcon);
      this.fetchData();
    }
  }]);
  return _default;
}(_category.default);

exports.default = _default;

/***/ }),
/* 616 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var _interopRequireDefault = __webpack_require__(0);

var _Object$defineProperty = __webpack_require__(1);

_Object$defineProperty(exports, "__esModule", {
  value: true
});

exports.default = void 0;

var _classCallCheck2 = _interopRequireDefault(__webpack_require__(2));

var _createClass2 = _interopRequireDefault(__webpack_require__(3));

var _get2 = _interopRequireDefault(__webpack_require__(22));

var _getPrototypeOf2 = _interopRequireDefault(__webpack_require__(14));

var _inherits2 = _interopRequireDefault(__webpack_require__(4));

var _createSuper2 = _interopRequireDefault(__webpack_require__(5));

var _default = /*#__PURE__*/function (_elementorModules$Vie) {
  (0, _inherits2.default)(_default, _elementorModules$Vie);

  var _super = (0, _createSuper2.default)(_default);

  function _default() {
    (0, _classCallCheck2.default)(this, _default);
    return _super.apply(this, arguments);
  }

  (0, _createClass2.default)(_default, [{
    key: "addPopupPlugin",
    value: function addPopupPlugin() {
      var counter = 0;

      jQuery.fn.elementorConnect = function (options) {
        var settings = jQuery.extend({
          // These are the defaults.
          success: function success() {
            return location.reload();
          },
          error: function error() {
            elementor.notifications.showToast({
              message: elementor.translate('connect_error')
            });
          }
        }, options);
        this.each(function () {
          counter++;
          var $this = jQuery(this),
              callbackId = 'cb' + counter;
          $this.attr({
            target: '_blank',
            href: $this.attr('href') + '&mode=popup&callback_id=' + callbackId
          });
          elementorCommon.elements.$window.on('elementor/connect/success/' + callbackId, settings.success).on('elementor/connect/error/' + callbackId, settings.error);
        });
        return this;
      };
    }
  }, {
    key: "getDefaultSettings",
    value: function getDefaultSettings() {
      return {
        selectors: {
          connectButton: '#elementor-template-library-connect__button'
        }
      };
    }
  }, {
    key: "getDefaultElements",
    value: function getDefaultElements() {
      return {
        $connectButton: jQuery(this.getSettings('selectors.connectButton'))
      };
    }
  }, {
    key: "applyPopup",
    value: function applyPopup() {
      this.elements.$connectButton.elementorConnect();
    }
  }, {
    key: "onInit",
    value: function onInit() {
      (0, _get2.default)((0, _getPrototypeOf2.default)(_default.prototype), "onInit", this).call(this);
      this.addPopupPlugin();
      this.applyPopup();
    }
  }]);
  return _default;
}(elementorModules.ViewModule);

exports.default = _default;

/***/ }),
/* 617 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var _interopRequireWildcard = __webpack_require__(62);

var _interopRequireDefault = __webpack_require__(0);

var _Object$defineProperty = __webpack_require__(1);

_Object$defineProperty(exports, "__esModule", {
  value: true
});

exports.default = void 0;

var _classCallCheck2 = _interopRequireDefault(__webpack_require__(2));

var _createClass2 = _interopRequireDefault(__webpack_require__(3));

var _backwardsCompatibility = _interopRequireDefault(__webpack_require__(618));

var _commandBase = _interopRequireDefault(__webpack_require__(39));

var _commandInternalBase = _interopRequireDefault(__webpack_require__(211));

var _commands = _interopRequireDefault(__webpack_require__(570));

var _commandsInternal = _interopRequireDefault(__webpack_require__(619));

var _componentBase = _interopRequireDefault(__webpack_require__(61));

var _componentModalBase = _interopRequireDefault(__webpack_require__(234));

var _components = _interopRequireDefault(__webpack_require__(620));

var _hookBreak = _interopRequireDefault(__webpack_require__(571));

var _hooks = _interopRequireDefault(__webpack_require__(621));

var _routes = _interopRequireDefault(__webpack_require__(624));

var _shortcuts = _interopRequireDefault(__webpack_require__(625));

var hookData = _interopRequireWildcard(__webpack_require__(626));

var hookUI = _interopRequireWildcard(__webpack_require__(628));

/* Alphabetical order */
var API = /*#__PURE__*/function () {
  /**
   * Function constructor().
   *
   * Create's 'elementor' api.
   */
  function API() {
    (0, _classCallCheck2.default)(this, API);
    this.bc = new _backwardsCompatibility.default();
    this.components = new _components.default();
    this.commands = new _commands.default();
    this.commandsInternal = new _commandsInternal.default();
    this.hooks = new _hooks.default();
    this.routes = new _routes.default();
    this.shortcuts = new _shortcuts.default(jQuery(window));
    this.modules = {
      CommandBase: _commandBase.default,
      CommandInternalBase: _commandInternalBase.default,
      ComponentBase: _componentBase.default,
      ComponentModalBase: _componentModalBase.default,
      HookBreak: _hookBreak.default,
      hookData: hookData,
      hookUI: hookUI
    };
    window.$e = this;
  }
  /**
   * Function run().
   *
   * Alias of `$e.commands.run()`.
   *
   * @param {string} command
   * @param [args={}]
   *
   * @returns {*}
   */


  (0, _createClass2.default)(API, [{
    key: "run",
    value: function run(command) {
      var args = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : {};
      return $e.commands.run(command, args);
    }
    /**
     * Function internal().
     *
     * Alias of `$e.commandsInternal.run()`.
     *
     * @param {string} command
     * @param [args={}]
     *
     * @returns {boolean}
     */

  }, {
    key: "internal",
    value: function internal(command) {
      var args = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : {};
      return $e.commandsInternal.run(command, args);
    }
    /**
     * Function route().
     *
     * Alias of `$e.routes.to()`.
     *
     * @param {string} route
     * @param [args={}]
     */

  }, {
    key: "route",
    value: function route(_route) {
      var args = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : {};
      return $e.routes.to(_route, args);
    } // TODO: shortcut();

  }]);
  return API;
}();

exports.default = API;

/***/ }),
/* 618 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var _interopRequireDefault = __webpack_require__(0);

var _Object$defineProperty = __webpack_require__(1);

_Object$defineProperty(exports, "__esModule", {
  value: true
});

exports.default = void 0;

var _inherits2 = _interopRequireDefault(__webpack_require__(4));

var _createSuper2 = _interopRequireDefault(__webpack_require__(5));

var _classCallCheck2 = _interopRequireDefault(__webpack_require__(2));

var _createClass2 = _interopRequireDefault(__webpack_require__(3));

var _componentBase = _interopRequireDefault(__webpack_require__(61));

var BackwardsCompatibility = /*#__PURE__*/function () {
  function BackwardsCompatibility() {
    (0, _classCallCheck2.default)(this, BackwardsCompatibility);
  }

  (0, _createClass2.default)(BackwardsCompatibility, [{
    key: "ensureTab",
    value: function ensureTab(namespace, tabSlug) {
      var page = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : '';
      var component = $e.components.get(namespace);

      if (!component) {
        var Component = /*#__PURE__*/function (_ComponentBase) {
          (0, _inherits2.default)(Component, _ComponentBase);

          var _super = (0, _createSuper2.default)(Component);

          function Component() {
            (0, _classCallCheck2.default)(this, Component);
            return _super.apply(this, arguments);
          }

          (0, _createClass2.default)(Component, [{
            key: "getNamespace",
            value: function getNamespace() {
              return namespace;
            }
          }, {
            key: "renderTab",
            value: function renderTab(tab) {
              elementor.getPanelView().setPage(page).activateTab(tab);
            }
          }]);
          return Component;
        }(_componentBase.default);

        component = $e.components.register(new Component());
      }

      if (!component.hasTab(tabSlug) && elementor.config.tabs[tabSlug]) {
        component.addTab(tabSlug, {
          title: elementor.config.tabs[tabSlug]
        });
      }
    }
  }]);
  return BackwardsCompatibility;
}();

exports.default = BackwardsCompatibility;

/***/ }),
/* 619 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var _interopRequireDefault = __webpack_require__(0);

var _Object$defineProperty = __webpack_require__(1);

_Object$defineProperty(exports, "__esModule", {
  value: true
});

exports.default = void 0;

var _classCallCheck2 = _interopRequireDefault(__webpack_require__(2));

var _createClass2 = _interopRequireDefault(__webpack_require__(3));

var _inherits2 = _interopRequireDefault(__webpack_require__(4));

var _createSuper2 = _interopRequireDefault(__webpack_require__(5));

var _commands = _interopRequireDefault(__webpack_require__(570));

var CommandsInternal = /*#__PURE__*/function (_Commands) {
  (0, _inherits2.default)(CommandsInternal, _Commands);

  var _super = (0, _createSuper2.default)(CommandsInternal);

  function CommandsInternal() {
    (0, _classCallCheck2.default)(this, CommandsInternal);
    return _super.apply(this, arguments);
  }

  (0, _createClass2.default)(CommandsInternal, [{
    key: "error",
    value: function error(message) {
      throw Error('Commands internal: ' + message);
    }
  }]);
  return CommandsInternal;
}(_commands.default);

exports.default = CommandsInternal;

/***/ }),
/* 620 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var _interopRequireDefault = __webpack_require__(0);

var _Object$defineProperty = __webpack_require__(1);

_Object$defineProperty(exports, "__esModule", {
  value: true
});

exports.default = void 0;

var _keys = _interopRequireDefault(__webpack_require__(23));

var _classCallCheck2 = _interopRequireDefault(__webpack_require__(2));

var _createClass2 = _interopRequireDefault(__webpack_require__(3));

var _inherits2 = _interopRequireDefault(__webpack_require__(4));

var _createSuper2 = _interopRequireDefault(__webpack_require__(5));

var _default = /*#__PURE__*/function (_elementorModules$Mod) {
  (0, _inherits2.default)(_default, _elementorModules$Mod);

  var _super = (0, _createSuper2.default)(_default);

  function _default() {
    var _this;

    (0, _classCallCheck2.default)(this, _default);

    for (var _len = arguments.length, args = new Array(_len), _key = 0; _key < _len; _key++) {
      args[_key] = arguments[_key];
    }

    _this = _super.call.apply(_super, [this].concat(args));
    _this.components = {};
    _this.activeComponents = {};
    return _this;
  }

  (0, _createClass2.default)(_default, [{
    key: "getAll",
    value: function getAll() {
      return (0, _keys.default)(this.components).sort();
    }
  }, {
    key: "register",
    value: function register(component) {
      if (this.components[component.getNamespace()]) {
        return;
      }

      component.registerAPI();
      this.components[component.getNamespace()] = component;
      return component;
    }
    /**
     * @returns {Component}
     */

  }, {
    key: "get",
    value: function get(id) {
      return this.components[id];
    }
  }, {
    key: "getActive",
    value: function getActive() {
      return this.activeComponents;
    }
  }, {
    key: "activate",
    value: function activate(namespace) {
      // Add as last.
      this.inactivate(namespace);
      this.activeComponents[namespace] = true;
    }
  }, {
    key: "inactivate",
    value: function inactivate(namespace) {
      delete this.activeComponents[namespace];
    }
  }, {
    key: "isActive",
    value: function isActive(namespace) {
      return !!this.activeComponents[namespace];
    }
  }]);
  return _default;
}(elementorModules.Module);

exports.default = _default;

/***/ }),
/* 621 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var _interopRequireDefault = __webpack_require__(0);

var _Object$defineProperty = __webpack_require__(1);

_Object$defineProperty(exports, "__esModule", {
  value: true
});

exports.default = void 0;

__webpack_require__(17);

var _classCallCheck2 = _interopRequireDefault(__webpack_require__(2));

var _createClass2 = _interopRequireDefault(__webpack_require__(3));

var _defineProperty2 = _interopRequireDefault(__webpack_require__(35));

var _data = _interopRequireDefault(__webpack_require__(622));

var _ui = _interopRequireDefault(__webpack_require__(623));

var Hooks = /*#__PURE__*/function () {
  function Hooks() {
    (0, _classCallCheck2.default)(this, Hooks);
    (0, _defineProperty2.default)(this, "data", new _data.default());
    (0, _defineProperty2.default)(this, "ui", new _ui.default());
  }

  (0, _createClass2.default)(Hooks, [{
    key: "activate",

    /**
     * Function activate().
     *
     * Activate all hooks.
     */
    value: function activate() {
      this.getTypes().forEach(function (hooksType) {
        hooksType.activate();
      });
    }
    /**
     * Function deactivate().
     *
     * Deactivate all hooks.
     */

  }, {
    key: "deactivate",
    value: function deactivate() {
      this.getTypes().forEach(function (hooksType) {
        hooksType.deactivate();
      });
    }
  }, {
    key: "getAll",
    value: function getAll() {
      var flat = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : false;
      var result = {};
      this.getTypes().forEach(function (hooksType) {
        result[hooksType.getType()] = hooksType.getAll(flat);
      });
      return result;
    }
  }, {
    key: "getTypes",
    value: function getTypes() {
      return [this.data, this.ui];
    }
  }, {
    key: "getType",
    value: function getType(type) {
      return this.getTypes().find(function (hooks) {
        return type === hooks.getType();
      });
    }
    /**
     * Function register().
     *
     * Register hook.
     *
     * @param {string} type
     * @param {string} event
     * @param {HookBase} instance
     *
     * @returns {{}} Created callback
     */

  }, {
    key: "register",
    value: function register(type, event, instance) {
      return this.getType(type).register(event, instance);
    }
    /**
     * Function run().
     *
     * Run's a hook.
     *
     * @param {string} type
     * @param {string} event
     * @param {string} command
     * @param {{}} args
     * @param {*} result
     *
     * @returns {boolean}
     */

  }, {
    key: "run",
    value: function run(type, event, command, args) {
      var result = arguments.length > 4 && arguments[4] !== undefined ? arguments[4] : undefined;
      return this.getType(type).run(event, command, args, result);
    }
    /**
     * Function registerDataAfter().
     *
     * Register data hook that's run after the command.
     *
     * @param {HookBase} instance
     *
     * @returns {{}}
     */

  }, {
    key: "registerDataAfter",
    value: function registerDataAfter(instance) {
      return this.register('data', 'after', instance);
    }
    /**
     * Function registerDataCatch().
     *
     * Register data hook that's run when the command fails.
     *
     * @param {HookBase} instance
     *
     * @returns {{}}
     */

  }, {
    key: "registerDataCatch",
    value: function registerDataCatch(instance) {
      return this.register('data', 'catch', instance);
    }
    /**
     * Function registerDataDependency().
     *
     * Register data hook that's run before the command as dependency.
     *
     * @param {HookBase} instance
     *
     * @returns {{}}
     */

  }, {
    key: "registerDataDependency",
    value: function registerDataDependency(instance) {
      return this.register('data', 'dependency', instance);
    }
    /**
     * Function registerUIAfter().
     *
     * Register UI hook that's run after the commands run.
     *
     * @param {HookBase} instance
     *
     * @returns {{}}
     */

  }, {
    key: "registerUIAfter",
    value: function registerUIAfter(instance) {
      return this.register('ui', 'after', instance);
    }
    /**
     * Function registerUICatch().
     *
     * Register UI hook that's run when the command fails.
     *
     * @param {HookBase} instance
     *
     * @returns {{}}
     */

  }, {
    key: "registerUICatch",
    value: function registerUICatch(instance) {
      return this.register('ui', 'catch', instance);
    }
    /**
     * Function registerUIBefore().
     *
     * Register UI hook that's run before the command.
     *
     * @param {HookBase} instance
     *
     * @returns {{}}
     */

  }, {
    key: "registerUIBefore",
    value: function registerUIBefore(instance) {
      return this.register('ui', 'before', instance);
    }
    /**
     * Function runDataAfter().
     *
     * Run data hook that's run after the command.
     *
     * @param {string} command
     * @param {{}} args
     * @param {*} result
     *
     * @returns {boolean}
     */

  }, {
    key: "runDataAfter",
    value: function runDataAfter(command, args, result) {
      return this.run('data', 'after', command, args, result);
    }
    /**
     * Function runDataCatch().
     *
     * Run data hook that's run when the command fails.
     *
     * @param {string} command
     * @param {{}} args
     * @param {*} error
     *
     * @returns {boolean}
     */

  }, {
    key: "runDataCatch",
    value: function runDataCatch(command, args, error) {
      return this.run('data', 'catch', command, args, error);
    }
    /**
     * Function runDataDependency().
     *
     * Run data hook that's run before the command as dependency.
     *
     * @param {string} command
     * @param {{}} args
     *
     * @returns {boolean}
     */

  }, {
    key: "runDataDependency",
    value: function runDataDependency(command, args) {
      return this.run('data', 'dependency', command, args);
    }
    /**
     * Function runUIAfter().
     *
     * Run UI hook that's run after the commands run.
     *
     * @param {string} command
     * @param {{}} args
     * @param {*} result
     *
     * @returns {boolean}
     */

  }, {
    key: "runUIAfter",
    value: function runUIAfter(command, args, result) {
      return this.run('ui', 'after', command, args, result);
    }
    /**
     * Function runUICatch().
     *
     * Run UI hook that's run when the command fails.
     *
     * @param {string} command
     * @param {{}} args
     * @param {*} e
     *
     * @returns {boolean}
     */

  }, {
    key: "runUICatch",
    value: function runUICatch(command, args, e) {
      return this.run('ui', 'catch', command, args, e);
    }
    /**
     * Function runUIBefore().
     *
     * Run UI hook that's run before the command.
     *
     * @param {string} command
     * @param {{}} args
     *
     * @returns {boolean}
     */

  }, {
    key: "runUIBefore",
    value: function runUIBefore(command, args) {
      return this.run('ui', 'before', command, args);
    }
  }]);
  return Hooks;
}();

exports.default = Hooks;

/***/ }),
/* 622 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var _interopRequireDefault = __webpack_require__(0);

var _Object$defineProperty = __webpack_require__(1);

_Object$defineProperty(exports, "__esModule", {
  value: true
});

exports.default = void 0;

var _classCallCheck2 = _interopRequireDefault(__webpack_require__(2));

var _createClass2 = _interopRequireDefault(__webpack_require__(3));

var _get2 = _interopRequireDefault(__webpack_require__(22));

var _getPrototypeOf2 = _interopRequireDefault(__webpack_require__(14));

var _inherits2 = _interopRequireDefault(__webpack_require__(4));

var _createSuper2 = _interopRequireDefault(__webpack_require__(5));

var _base = _interopRequireDefault(__webpack_require__(362));

var Data = /*#__PURE__*/function (_HooksBase) {
  (0, _inherits2.default)(Data, _HooksBase);

  var _super = (0, _createSuper2.default)(Data);

  function Data() {
    var _this;

    (0, _classCallCheck2.default)(this, Data);

    for (var _len = arguments.length, args = new Array(_len), _key = 0; _key < _len; _key++) {
      args[_key] = arguments[_key];
    }

    _this = _super.call.apply(_super, [this].concat(args));
    _this.callbacks.dependency = {};
    _this.depth.dependency = {};
    return _this;
  }

  (0, _createClass2.default)(Data, [{
    key: "getType",
    value: function getType() {
      return 'data';
    }
  }, {
    key: "runCallback",
    value: function runCallback(event, callback, args, result) {
      switch (event) {
        case 'dependency':
          {
            // If callback returns false and its dependency, then 'Hook-Break'.
            if (!callback.callback(args)) {
              this.depth[event][callback.id]--; // Throw custom break to be catch by the base for 'Safe' exit.

              throw new $e.modules.HookBreak();
            }
          }
          break;

        case 'catch':
        case 'after':
          {
            callback.callback(args, result);
          }
          break;

        default:
          return false;
      }

      return true;
    }
  }, {
    key: "shouldRun",
    value: function shouldRun(callbacks) {
      return (0, _get2.default)((0, _getPrototypeOf2.default)(Data.prototype), "shouldRun", this).call(this, callbacks) && elementor.documents.getCurrent().history.getActive();
    }
  }, {
    key: "onRun",
    value: function onRun(command, args, event) {
      if (!$e.devTools) {
        return;
      }

      $e.devTools.log.hookRun(this.getType(), command, args, event);
    }
  }, {
    key: "onCallback",
    value: function onCallback(command, args, event, id) {
      if (!$e.devTools) {
        return;
      }

      $e.devTools.log.hookCallback(this.getType(), command, args, event, id);
    }
  }]);
  return Data;
}(_base.default);

exports.default = Data;

/***/ }),
/* 623 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var _interopRequireDefault = __webpack_require__(0);

var _Object$defineProperty = __webpack_require__(1);

_Object$defineProperty(exports, "__esModule", {
  value: true
});

exports.default = void 0;

var _classCallCheck2 = _interopRequireDefault(__webpack_require__(2));

var _createClass2 = _interopRequireDefault(__webpack_require__(3));

var _inherits2 = _interopRequireDefault(__webpack_require__(4));

var _createSuper2 = _interopRequireDefault(__webpack_require__(5));

var _base = _interopRequireDefault(__webpack_require__(362));

var Ui = /*#__PURE__*/function (_HooksBase) {
  (0, _inherits2.default)(Ui, _HooksBase);

  var _super = (0, _createSuper2.default)(Ui);

  function Ui() {
    var _this;

    (0, _classCallCheck2.default)(this, Ui);

    for (var _len = arguments.length, args = new Array(_len), _key = 0; _key < _len; _key++) {
      args[_key] = arguments[_key];
    }

    _this = _super.call.apply(_super, [this].concat(args));
    _this.callbacks.before = {};
    _this.depth.before = {};
    return _this;
  }

  (0, _createClass2.default)(Ui, [{
    key: "getType",
    value: function getType() {
      return 'ui';
    }
  }, {
    key: "runCallback",
    value: function runCallback(event, callback, args, result) {
      switch (event) {
        case 'before':
          callback.callback(args);
          break;

        case 'catch':
        case 'after':
          callback.callback(args, result);
          break;

        default:
          return false;
      }

      return true;
    }
  }, {
    key: "onRun",
    value: function onRun(command, args, event) {
      if (!$e.devTools) {
        return;
      }

      $e.devTools.log.hookRun(this.getType(), command, args, event);
    }
  }, {
    key: "onCallback",
    value: function onCallback(command, args, event, id) {
      if (!$e.devTools) {
        return;
      }

      $e.devTools.log.hookCallback(this.getType(), command, args, event, id);
    }
  }]);
  return Ui;
}(_base.default);

exports.default = Ui;

/***/ }),
/* 624 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var _interopRequireDefault = __webpack_require__(0);

var _Object$defineProperty = __webpack_require__(1);

_Object$defineProperty(exports, "__esModule", {
  value: true
});

exports.default = void 0;

__webpack_require__(68);

var _classCallCheck2 = _interopRequireDefault(__webpack_require__(2));

var _createClass2 = _interopRequireDefault(__webpack_require__(3));

var _get2 = _interopRequireDefault(__webpack_require__(22));

var _getPrototypeOf2 = _interopRequireDefault(__webpack_require__(14));

var _inherits2 = _interopRequireDefault(__webpack_require__(4));

var _createSuper2 = _interopRequireDefault(__webpack_require__(5));

var _commands = _interopRequireDefault(__webpack_require__(570));

var Routes = /*#__PURE__*/function (_Commands) {
  (0, _inherits2.default)(Routes, _Commands);

  var _super = (0, _createSuper2.default)(Routes);

  function Routes() {
    var _this;

    (0, _classCallCheck2.default)(this, Routes);

    for (var _len = arguments.length, args = new Array(_len), _key = 0; _key < _len; _key++) {
      args[_key] = arguments[_key];
    }

    _this = _super.call.apply(_super, [this].concat(args));
    _this.savedStates = {};
    _this.historyPerComponent = {};
    return _this;
  }

  (0, _createClass2.default)(Routes, [{
    key: "refreshContainer",
    value: function refreshContainer(container) {
      var currentRoute = this.getCurrent(container),
          currentArgs = this.getCurrentArgs(container);
      this.clearCurrent(container);
      this.to(currentRoute, currentArgs);
    }
  }, {
    key: "getHistory",
    value: function getHistory() {
      var namespaceRoot = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : '';

      if (namespaceRoot) {
        return this.historyPerComponent[namespaceRoot] || [];
      }

      return this.historyPerComponent;
    }
  }, {
    key: "clearHistory",
    value: function clearHistory(namespaceRoot) {
      delete this.historyPerComponent[namespaceRoot];
    }
  }, {
    key: "clearCurrent",
    value: function clearCurrent(container) {
      var route = this.current[container];

      if (!route) {
        return;
      }

      delete this.current[container];
      delete this.currentArgs[container];
      this.getComponent(route).onCloseRoute(route);
    }
  }, {
    key: "saveState",
    value: function saveState(container) {
      this.savedStates[container] = {
        route: this.current[container],
        args: this.currentArgs[container]
      };
      return this;
    }
  }, {
    key: "restoreState",
    value: function restoreState(container) {
      if (!this.savedStates[container]) {
        return false;
      }

      this.to(this.savedStates[container].route, this.savedStates[container].args);
      return true;
    }
  }, {
    key: "beforeRun",
    value: function beforeRun(route, args) {
      if (!(0, _get2.default)((0, _getPrototypeOf2.default)(Routes.prototype), "beforeRun", this).call(this, route, args)) {
        return false;
      }

      if (this.is(route, args) && !args.refresh) {
        return false;
      }

      var component = this.getComponent(route),
          container = component.getRootContainer(),
          oldRoute = this.current[container];

      if (oldRoute) {
        this.getComponent(oldRoute).onCloseRoute(oldRoute);
      }

      if (!component.isOpen || args.reOpen) {
        component.isOpen = component.open(args);
      }

      return component.isOpen;
    }
  }, {
    key: "to",
    value: function to(route, args) {
      this.run(route, args);
      var namespaceRoot = this.getComponent(route).getRootContainer();

      if (!this.historyPerComponent[namespaceRoot]) {
        this.historyPerComponent[namespaceRoot] = [];
      }

      this.historyPerComponent[namespaceRoot].push({
        route: route,
        args: args
      });
    }
  }, {
    key: "back",
    value: function back(namespaceRoot) {
      var history = this.getHistory(namespaceRoot); // Remove current;

      history.pop();
      var last = history.pop();

      if (!last) {
        return;
      }

      this.to(last.route, last.args);
    } // Don't use the event object.

  }, {
    key: "runShortcut",
    value: function runShortcut(command) {
      this.to(command);
    } // Don't clear current route.

  }, {
    key: "afterRun",
    value: function afterRun(route, args) {
      this.getComponent(route).onRoute(route, args);
    }
  }, {
    key: "is",
    value: function is(route) {
      var args = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : {};

      if (!(0, _get2.default)((0, _getPrototypeOf2.default)(Routes.prototype), "is", this).call(this, route)) {
        return false;
      }

      var container = this.getComponent(route).getRootContainer();
      return _.isEqual(args, this.currentArgs[container]);
    }
  }, {
    key: "isPartOf",
    value: function isPartOf(route) {
      /**
       * Check against current command hierarchically.
       * For example `is( 'panel' )` will be true for `panel/elements`
       * `is( 'panel/editor' )` will be true for `panel/editor/style`
       */
      var parts = route.split('/'),
          container = parts[0],
          toCheck = [],
          currentParts = this.current[container] ? this.current[container].split('/') : [];
      var match = false;
      currentParts.forEach(function (part) {
        toCheck.push(part);

        if (toCheck.join('/') === route) {
          match = true;
        }
      });
      return match;
    }
  }, {
    key: "error",
    value: function error(message) {
      throw Error('Routes: ' + message);
    }
  }]);
  return Routes;
}(_commands.default);

exports.default = Routes;

/***/ }),
/* 625 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var _interopRequireDefault = __webpack_require__(0);

var _Object$defineProperty = __webpack_require__(1);

_Object$defineProperty(exports, "__esModule", {
  value: true
});

exports.default = void 0;

var _keys = _interopRequireDefault(__webpack_require__(23));

__webpack_require__(53);

__webpack_require__(68);

var _classCallCheck2 = _interopRequireDefault(__webpack_require__(2));

var _createClass2 = _interopRequireDefault(__webpack_require__(3));

var _environment = _interopRequireDefault(__webpack_require__(207));

var Shortcuts = /*#__PURE__*/function () {
  function Shortcuts($window) {
    (0, _classCallCheck2.default)(this, Shortcuts);
    this.specialKeys = {
      13: 'enter',
      27: 'esc',
      38: 'up',
      40: 'down',
      46: 'del',
      191: '?'
    };
    this.component = '';
    this.handlers = {};
    this.bindListener($window);
  }

  (0, _createClass2.default)(Shortcuts, [{
    key: "bindListener",
    value: function bindListener($window) {
      var _this = this;

      $window.on('keydown', function (event) {
        return _this.handle(event);
      });
    }
  }, {
    key: "getAll",
    value: function getAll() {
      var shortcuts = {};
      jQuery.each(this.handlers, function (key, handler) {
        jQuery.each(handler, function (index, config) {
          shortcuts[config.command] = key;
        });
      });
      return shortcuts;
    }
    /**
     * @param shortcuts
     * @param {{callback: (function(): boolean), scopes: [void]}} args
     * @param {callback} args.callback Required
     * @param {string} args.component Optional
     * @param {callback} args.dependency Optional
     * @param {array} args.exclude Optional
     * @param {bool} args.allowAltKey Optional
     */

  }, {
    key: "register",
    value: function register(shortcuts, args) {
      var _this2 = this;

      shortcuts.replace(' ', '').split(',').forEach(function (shortcut) {
        if (!_this2.handlers[shortcut]) {
          _this2.handlers[shortcut] = [];
        }

        _this2.handlers[shortcut].push(args);
      });
    }
  }, {
    key: "unregister",
    value: function unregister(shortcuts, args) {
      var _this3 = this;

      shortcuts.replace(' ', '').split(',').forEach(function (shortcut) {
        _this3.handlers[shortcut].forEach(function (index, handler) {
          if (args === handler) {
            delete _this3.handlers[shortcut][index];
          }
        });
      });
    }
  }, {
    key: "handle",
    value: function handle(event) {
      var handlers = this.getHandlersByPriority(event);

      if (!handlers) {
        return;
      }

      var filteredHandlers = handlers.filter(function (handler) {
        if (handler.exclude && -1 !== handler.exclude.indexOf('input')) {
          var $target = jQuery(event.target);

          if ($target.is(':input, .elementor-input') || $target.closest('[contenteditable="true"]').length) {
            return false;
          }
        }

        if (handler.dependency && !handler.dependency(event)) {
          return false;
        } // Fix for some keyboard sources that consider alt key as ctrl key


        if (!handler.allowAltKey && event.altKey) {
          return false;
        }

        return true;
      });

      if (!filteredHandlers.length) {
        return;
      }

      if (1 < filteredHandlers.length && elementorCommon.config.isDebug) {
        elementorCommon.helpers.consoleWarn('Multiple handlers for shortcut.', filteredHandlers, event);
      }

      event.preventDefault();
      filteredHandlers[0].callback(event);
    }
  }, {
    key: "isControlEvent",
    value: function isControlEvent(event) {
      return event[_environment.default.mac ? 'metaKey' : 'ctrlKey'];
    }
  }, {
    key: "getEventShortcut",
    value: function getEventShortcut(event) {
      var shortcut = [];

      if (event.altKey) {
        shortcut.push('alt');
      }

      if (this.isControlEvent(event)) {
        shortcut.push('ctrl');
      }

      if (event.shiftKey) {
        shortcut.push('shift');
      }

      if (this.specialKeys[event.which]) {
        shortcut.push(this.specialKeys[event.which]);
      } else {
        shortcut.push(String.fromCharCode(event.which).toLowerCase());
      }

      return shortcut.join('+');
    }
  }, {
    key: "isActiveScope",
    value: function isActiveScope(scopes) {
      var activeComponents = (0, _keys.default)($e.components.activeComponents),
          activeComponent = activeComponents[activeComponents.length - 1],
          component = $e.components.get(activeComponent);

      if (!component) {
        return false;
      }

      var namespace = component.getNamespace(),
          namespaceRoot = component.getRootContainer();
      var filteredByNamespace = scopes.some(function (scope) {
        return namespace === scope;
      });

      if (filteredByNamespace) {
        return true;
      } // Else filter by namespaceRoot.


      return scopes.some(function (scope) {
        return namespaceRoot === scope;
      });
    }
  }, {
    key: "getHandlersByPriority",
    value: function getHandlersByPriority(event) {
      var _this4 = this;

      var handlers = this.handlers[this.getEventShortcut(event)];

      if (!handlers) {
        return false;
      } // TODO: Prioritize current scope before roo scope.


      var inCurrentScope = handlers.filter(function (handler) {
        return handler.scopes && _this4.isActiveScope(handler.scopes);
      });

      if (inCurrentScope.length) {
        return inCurrentScope;
      }

      var noScope = handlers.filter(function (handler) {
        return !handler.scopes;
      });

      if (noScope.length) {
        return noScope;
      }
    }
  }]);
  return Shortcuts;
}();

exports.default = Shortcuts;

/***/ }),
/* 626 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var _Object$defineProperty = __webpack_require__(1);

_Object$defineProperty(exports, "__esModule", {
  value: true
});

_Object$defineProperty(exports, "After", {
  enumerable: true,
  get: function get() {
    return _after.After;
  }
});

_Object$defineProperty(exports, "Base", {
  enumerable: true,
  get: function get() {
    return _base.Base;
  }
});

_Object$defineProperty(exports, "Catch", {
  enumerable: true,
  get: function get() {
    return _catch.Catch;
  }
});

_Object$defineProperty(exports, "Dependency", {
  enumerable: true,
  get: function get() {
    return _dependency.Dependency;
  }
});

var _after = __webpack_require__(189);

var _base = __webpack_require__(242);

var _catch = __webpack_require__(627);

var _dependency = __webpack_require__(295);

/***/ }),
/* 627 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var _interopRequireDefault = __webpack_require__(0);

var _Object$defineProperty = __webpack_require__(1);

_Object$defineProperty(exports, "__esModule", {
  value: true
});

exports.default = exports.Catch = void 0;

var _classCallCheck2 = _interopRequireDefault(__webpack_require__(2));

var _createClass2 = _interopRequireDefault(__webpack_require__(3));

var _inherits2 = _interopRequireDefault(__webpack_require__(4));

var _createSuper2 = _interopRequireDefault(__webpack_require__(5));

var _base = _interopRequireDefault(__webpack_require__(242));

var Catch = /*#__PURE__*/function (_Base) {
  (0, _inherits2.default)(Catch, _Base);

  var _super = (0, _createSuper2.default)(Catch);

  function Catch() {
    (0, _classCallCheck2.default)(this, Catch);
    return _super.apply(this, arguments);
  }

  (0, _createClass2.default)(Catch, [{
    key: "register",
    value: function register() {
      $e.hooks.registerDataCatch(this);
    }
  }]);
  return Catch;
}(_base.default);

exports.Catch = Catch;
var _default = Catch;
exports.default = _default;

/***/ }),
/* 628 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var _Object$defineProperty = __webpack_require__(1);

_Object$defineProperty(exports, "__esModule", {
  value: true
});

_Object$defineProperty(exports, "After", {
  enumerable: true,
  get: function get() {
    return _after.After;
  }
});

_Object$defineProperty(exports, "Base", {
  enumerable: true,
  get: function get() {
    return _base.Base;
  }
});

_Object$defineProperty(exports, "Before", {
  enumerable: true,
  get: function get() {
    return _before.Before;
  }
});

_Object$defineProperty(exports, "Catch", {
  enumerable: true,
  get: function get() {
    return _catch.Catch;
  }
});

var _after = __webpack_require__(217);

var _base = __webpack_require__(272);

var _before = __webpack_require__(572);

var _catch = __webpack_require__(573);

/***/ })
/******/ ]);
//# sourceMappingURL=common.js.map