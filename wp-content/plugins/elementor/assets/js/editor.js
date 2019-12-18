/*! elementor - v2.8.2 - 16-12-2019 */
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
/******/ 	return __webpack_require__(__webpack_require__.s = 511);
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

module.exports = __webpack_require__(127);

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

var _Object$getPrototypeOf = __webpack_require__(147);

var _Object$setPrototypeOf = __webpack_require__(97);

function _getPrototypeOf(o) {
  module.exports = _getPrototypeOf = _Object$setPrototypeOf ? _Object$getPrototypeOf : function _getPrototypeOf(o) {
    return o.__proto__ || _Object$getPrototypeOf(o);
  };
  return _getPrototypeOf(o);
}

module.exports = _getPrototypeOf;

/***/ }),
/* 5 */
/***/ (function(module, exports, __webpack_require__) {

var _typeof = __webpack_require__(47);

var assertThisInitialized = __webpack_require__(56);

function _possibleConstructorReturn(self, call) {
  if (call && (_typeof(call) === "object" || typeof call === "function")) {
    return call;
  }

  return assertThisInitialized(self);
}

module.exports = _possibleConstructorReturn;

/***/ }),
/* 6 */
/***/ (function(module, exports, __webpack_require__) {

var _Object$create = __webpack_require__(114);

var setPrototypeOf = __webpack_require__(115);

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
/* 7 */
/***/ (function(module, exports) {

var core = module.exports = { version: '2.6.9' };
if (typeof __e == 'number') __e = core; // eslint-disable-line no-undef


/***/ }),
/* 8 */
/***/ (function(module, exports, __webpack_require__) {

var global = __webpack_require__(10);
var core = __webpack_require__(7);
var ctx = __webpack_require__(55);
var hide = __webpack_require__(26);
var has = __webpack_require__(17);
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
/* 9 */
/***/ (function(module, exports, __webpack_require__) {

var store = __webpack_require__(51)('wks');
var uid = __webpack_require__(52);
var Symbol = __webpack_require__(13).Symbol;
var USE_SYMBOL = typeof Symbol == 'function';

var $exports = module.exports = function (name) {
  return store[name] || (store[name] =
    USE_SYMBOL && Symbol[name] || (USE_SYMBOL ? Symbol : uid)('Symbol.' + name));
};

$exports.store = store;


/***/ }),
/* 10 */
/***/ (function(module, exports) {

// https://github.com/zloirock/core-js/issues/86#issuecomment-115759028
var global = module.exports = typeof window != 'undefined' && window.Math == Math
  ? window : typeof self != 'undefined' && self.Math == Math ? self
  // eslint-disable-next-line no-new-func
  : Function('return this')();
if (typeof __g == 'number') __g = global; // eslint-disable-line no-undef


/***/ }),
/* 11 */
/***/ (function(module, exports, __webpack_require__) {

// Thank's IE8 for his funny defineProperty
module.exports = !__webpack_require__(23)(function () {
  return Object.defineProperty({}, 'a', { get: function () { return 7; } }).a != 7;
});


/***/ }),
/* 12 */
/***/ (function(module, exports, __webpack_require__) {

var store = __webpack_require__(60)('wks');
var uid = __webpack_require__(42);
var Symbol = __webpack_require__(10).Symbol;
var USE_SYMBOL = typeof Symbol == 'function';

var $exports = module.exports = function (name) {
  return store[name] || (store[name] =
    USE_SYMBOL && Symbol[name] || (USE_SYMBOL ? Symbol : uid)('Symbol.' + name));
};

$exports.store = store;


/***/ }),
/* 13 */
/***/ (function(module, exports) {

// https://github.com/zloirock/core-js/issues/86#issuecomment-115759028
var global = module.exports = typeof window != 'undefined' && window.Math == Math
  ? window : typeof self != 'undefined' && self.Math == Math ? self
  // eslint-disable-next-line no-new-func
  : Function('return this')();
if (typeof __g == 'number') __g = global; // eslint-disable-line no-undef


/***/ }),
/* 14 */
/***/ (function(module, exports) {

module.exports = function (it) {
  return typeof it === 'object' ? it !== null : typeof it === 'function';
};


/***/ }),
/* 15 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";

// 22.1.3.8 Array.prototype.find(predicate, thisArg = undefined)
var $export = __webpack_require__(29);
var $find = __webpack_require__(117)(5);
var KEY = 'find';
var forced = true;
// Shouldn't skip holes
if (KEY in []) Array(1)[KEY](function () { forced = false; });
$export($export.P + $export.F * forced, 'Array', {
  find: function find(callbackfn /* , that = undefined */) {
    return $find(this, callbackfn, arguments.length > 1 ? arguments[1] : undefined);
  }
});
__webpack_require__(72)(KEY);


/***/ }),
/* 16 */
/***/ (function(module, exports, __webpack_require__) {

var anObject = __webpack_require__(20);
var IE8_DOM_DEFINE = __webpack_require__(92);
var toPrimitive = __webpack_require__(57);
var dP = Object.defineProperty;

exports.f = __webpack_require__(11) ? Object.defineProperty : function defineProperty(O, P, Attributes) {
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
/***/ (function(module, exports) {

var hasOwnProperty = {}.hasOwnProperty;
module.exports = function (it, key) {
  return hasOwnProperty.call(it, key);
};


/***/ }),
/* 18 */
/***/ (function(module, exports, __webpack_require__) {

// to indexed object, toObject with fallback for non-array-like ES3 strings
var IObject = __webpack_require__(106);
var defined = __webpack_require__(49);
module.exports = function (it) {
  return IObject(defined(it));
};


/***/ }),
/* 19 */
/***/ (function(module, exports, __webpack_require__) {

var isObject = __webpack_require__(24);
module.exports = function (it) {
  if (!isObject(it)) throw TypeError(it + ' is not an object!');
  return it;
};


/***/ }),
/* 20 */
/***/ (function(module, exports, __webpack_require__) {

var isObject = __webpack_require__(14);
module.exports = function (it) {
  if (!isObject(it)) throw TypeError(it + ' is not an object!');
  return it;
};


/***/ }),
/* 21 */
/***/ (function(module, exports, __webpack_require__) {

// Thank's IE8 for his funny defineProperty
module.exports = !__webpack_require__(22)(function () {
  return Object.defineProperty({}, 'a', { get: function () { return 7; } }).a != 7;
});


/***/ }),
/* 22 */
/***/ (function(module, exports) {

module.exports = function (exec) {
  try {
    return !!exec();
  } catch (e) {
    return true;
  }
};


/***/ }),
/* 23 */
/***/ (function(module, exports) {

module.exports = function (exec) {
  try {
    return !!exec();
  } catch (e) {
    return true;
  }
};


/***/ }),
/* 24 */
/***/ (function(module, exports) {

module.exports = function (it) {
  return typeof it === 'object' ? it !== null : typeof it === 'function';
};


/***/ }),
/* 25 */
/***/ (function(module, exports, __webpack_require__) {

var dP = __webpack_require__(35);
var createDesc = __webpack_require__(80);
module.exports = __webpack_require__(21) ? function (object, key, value) {
  return dP.f(object, key, createDesc(1, value));
} : function (object, key, value) {
  object[key] = value;
  return object;
};


/***/ }),
/* 26 */
/***/ (function(module, exports, __webpack_require__) {

var dP = __webpack_require__(16);
var createDesc = __webpack_require__(39);
module.exports = __webpack_require__(11) ? function (object, key, value) {
  return dP.f(object, key, createDesc(1, value));
} : function (object, key, value) {
  object[key] = value;
  return object;
};


/***/ }),
/* 27 */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(179);

/***/ }),
/* 28 */
/***/ (function(module, exports, __webpack_require__) {

var _Object$getOwnPropertyDescriptor = __webpack_require__(118);

var _Reflect$get = __webpack_require__(166);

var superPropBase = __webpack_require__(169);

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
/* 29 */
/***/ (function(module, exports, __webpack_require__) {

var global = __webpack_require__(13);
var core = __webpack_require__(45);
var hide = __webpack_require__(25);
var redefine = __webpack_require__(31);
var ctx = __webpack_require__(70);
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
/* 30 */
/***/ (function(module, exports, __webpack_require__) {

var dP = __webpack_require__(35).f;
var FProto = Function.prototype;
var nameRE = /^\s*function ([^ (]*)/;
var NAME = 'name';

// 19.2.4.2 name
NAME in FProto || __webpack_require__(21) && dP(FProto, NAME, {
  configurable: true,
  get: function () {
    try {
      return ('' + this).match(nameRE)[1];
    } catch (e) {
      return '';
    }
  }
});


/***/ }),
/* 31 */
/***/ (function(module, exports, __webpack_require__) {

var global = __webpack_require__(13);
var hide = __webpack_require__(25);
var has = __webpack_require__(46);
var SRC = __webpack_require__(52)('src');
var $toString = __webpack_require__(112);
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
/* 32 */
/***/ (function(module, exports) {

// 7.2.1 RequireObjectCoercible(argument)
module.exports = function (it) {
  if (it == undefined) throw TypeError("Can't call method on  " + it);
  return it;
};


/***/ }),
/* 33 */
/***/ (function(module, exports, __webpack_require__) {

// 19.1.2.14 / 15.2.3.14 Object.keys(O)
var $keys = __webpack_require__(95);
var enumBugKeys = __webpack_require__(61);

module.exports = Object.keys || function keys(O) {
  return $keys(O, enumBugKeys);
};


/***/ }),
/* 34 */
/***/ (function(module, exports, __webpack_require__) {

// 7.1.13 ToObject(argument)
var defined = __webpack_require__(49);
module.exports = function (it) {
  return Object(defined(it));
};


/***/ }),
/* 35 */
/***/ (function(module, exports, __webpack_require__) {

var anObject = __webpack_require__(19);
var IE8_DOM_DEFINE = __webpack_require__(101);
var toPrimitive = __webpack_require__(88);
var dP = Object.defineProperty;

exports.f = __webpack_require__(21) ? Object.defineProperty : function defineProperty(O, P, Attributes) {
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
/* 36 */
/***/ (function(module, exports) {

var toString = {}.toString;

module.exports = function (it) {
  return toString.call(it).slice(8, -1);
};


/***/ }),
/* 37 */
/***/ (function(module, exports, __webpack_require__) {

// 7.1.15 ToLength
var toInteger = __webpack_require__(40);
var min = Math.min;
module.exports = function (it) {
  return it > 0 ? min(toInteger(it), 0x1fffffffffffff) : 0; // pow(2, 53) - 1 == 9007199254740991
};


/***/ }),
/* 38 */
/***/ (function(module, exports) {

module.exports = {};


/***/ }),
/* 39 */
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
/* 40 */
/***/ (function(module, exports) {

// 7.1.4 ToInteger
var ceil = Math.ceil;
var floor = Math.floor;
module.exports = function (it) {
  return isNaN(it = +it) ? 0 : (it > 0 ? floor : ceil)(it);
};


/***/ }),
/* 41 */
/***/ (function(module, exports) {

module.exports = true;


/***/ }),
/* 42 */
/***/ (function(module, exports) {

var id = 0;
var px = Math.random();
module.exports = function (key) {
  return 'Symbol('.concat(key === undefined ? '' : key, ')_', (++id + px).toString(36));
};


/***/ }),
/* 43 */
/***/ (function(module, exports) {

exports.f = {}.propertyIsEnumerable;


/***/ }),
/* 44 */
/***/ (function(module, exports, __webpack_require__) {

var pIE = __webpack_require__(43);
var createDesc = __webpack_require__(39);
var toIObject = __webpack_require__(18);
var toPrimitive = __webpack_require__(57);
var has = __webpack_require__(17);
var IE8_DOM_DEFINE = __webpack_require__(92);
var gOPD = Object.getOwnPropertyDescriptor;

exports.f = __webpack_require__(11) ? gOPD : function getOwnPropertyDescriptor(O, P) {
  O = toIObject(O);
  P = toPrimitive(P, true);
  if (IE8_DOM_DEFINE) try {
    return gOPD(O, P);
  } catch (e) { /* empty */ }
  if (has(O, P)) return createDesc(!pIE.f.call(O, P), O[P]);
};


/***/ }),
/* 45 */
/***/ (function(module, exports) {

var core = module.exports = { version: '2.6.10' };
if (typeof __e == 'number') __e = core; // eslint-disable-line no-undef


/***/ }),
/* 46 */
/***/ (function(module, exports) {

var hasOwnProperty = {}.hasOwnProperty;
module.exports = function (it, key) {
  return hasOwnProperty.call(it, key);
};


/***/ }),
/* 47 */
/***/ (function(module, exports, __webpack_require__) {

var _Symbol$iterator = __webpack_require__(132);

var _Symbol = __webpack_require__(141);

function _typeof2(obj) { if (typeof _Symbol === "function" && typeof _Symbol$iterator === "symbol") { _typeof2 = function _typeof2(obj) { return typeof obj; }; } else { _typeof2 = function _typeof2(obj) { return obj && typeof _Symbol === "function" && obj.constructor === _Symbol && obj !== _Symbol.prototype ? "symbol" : typeof obj; }; } return _typeof2(obj); }

function _typeof(obj) {
  if (typeof _Symbol === "function" && _typeof2(_Symbol$iterator) === "symbol") {
    module.exports = _typeof = function _typeof(obj) {
      return _typeof2(obj);
    };
  } else {
    module.exports = _typeof = function _typeof(obj) {
      return obj && typeof _Symbol === "function" && obj.constructor === _Symbol && obj !== _Symbol.prototype ? "symbol" : _typeof2(obj);
    };
  }

  return _typeof(obj);
}

module.exports = _typeof;

/***/ }),
/* 48 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var anObject = __webpack_require__(19);
var toObject = __webpack_require__(54);
var toLength = __webpack_require__(37);
var toInteger = __webpack_require__(40);
var advanceStringIndex = __webpack_require__(89);
var regExpExec = __webpack_require__(78);
var max = Math.max;
var min = Math.min;
var floor = Math.floor;
var SUBSTITUTION_SYMBOLS = /\$([$&`']|\d\d?|<[^>]*>)/g;
var SUBSTITUTION_SYMBOLS_NO_NAMED = /\$([$&`']|\d\d?)/g;

var maybeToString = function (it) {
  return it === undefined ? it : String(it);
};

// @@replace logic
__webpack_require__(79)('replace', 2, function (defined, REPLACE, $replace, maybeCallNative) {
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
/* 49 */
/***/ (function(module, exports) {

// 7.2.1 RequireObjectCoercible(argument)
module.exports = function (it) {
  if (it == undefined) throw TypeError("Can't call method on  " + it);
  return it;
};


/***/ }),
/* 50 */
/***/ (function(module, exports, __webpack_require__) {

// 19.1.2.2 / 15.2.3.5 Object.create(O [, Properties])
var anObject = __webpack_require__(20);
var dPs = __webpack_require__(120);
var enumBugKeys = __webpack_require__(61);
var IE_PROTO = __webpack_require__(59)('IE_PROTO');
var Empty = function () { /* empty */ };
var PROTOTYPE = 'prototype';

// Create object with fake `null` prototype: use iframe Object with cleared prototype
var createDict = function () {
  // Thrash, waste and sodomy: IE GC bug
  var iframe = __webpack_require__(93)('iframe');
  var i = enumBugKeys.length;
  var lt = '<';
  var gt = '>';
  var iframeDocument;
  iframe.style.display = 'none';
  __webpack_require__(138).appendChild(iframe);
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
/* 51 */
/***/ (function(module, exports, __webpack_require__) {

var core = __webpack_require__(45);
var global = __webpack_require__(13);
var SHARED = '__core-js_shared__';
var store = global[SHARED] || (global[SHARED] = {});

(module.exports = function (key, value) {
  return store[key] || (store[key] = value !== undefined ? value : {});
})('versions', []).push({
  version: core.version,
  mode: __webpack_require__(90) ? 'pure' : 'global',
  copyright: '© 2019 Denis Pushkarev (zloirock.ru)'
});


/***/ }),
/* 52 */
/***/ (function(module, exports) {

var id = 0;
var px = Math.random();
module.exports = function (key) {
  return 'Symbol('.concat(key === undefined ? '' : key, ')_', (++id + px).toString(36));
};


/***/ }),
/* 53 */
/***/ (function(module, exports, __webpack_require__) {

var def = __webpack_require__(16).f;
var has = __webpack_require__(17);
var TAG = __webpack_require__(12)('toStringTag');

module.exports = function (it, tag, stat) {
  if (it && !has(it = stat ? it : it.prototype, TAG)) def(it, TAG, { configurable: true, value: tag });
};


/***/ }),
/* 54 */
/***/ (function(module, exports, __webpack_require__) {

// 7.1.13 ToObject(argument)
var defined = __webpack_require__(32);
module.exports = function (it) {
  return Object(defined(it));
};


/***/ }),
/* 55 */
/***/ (function(module, exports, __webpack_require__) {

// optional / simple context binding
var aFunction = __webpack_require__(105);
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
/* 56 */
/***/ (function(module, exports) {

function _assertThisInitialized(self) {
  if (self === void 0) {
    throw new ReferenceError("this hasn't been initialised - super() hasn't been called");
  }

  return self;
}

module.exports = _assertThisInitialized;

/***/ }),
/* 57 */
/***/ (function(module, exports, __webpack_require__) {

// 7.1.1 ToPrimitive(input [, PreferredType])
var isObject = __webpack_require__(14);
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
/* 58 */
/***/ (function(module, exports) {

// 7.1.4 ToInteger
var ceil = Math.ceil;
var floor = Math.floor;
module.exports = function (it) {
  return isNaN(it = +it) ? 0 : (it > 0 ? floor : ceil)(it);
};


/***/ }),
/* 59 */
/***/ (function(module, exports, __webpack_require__) {

var shared = __webpack_require__(60)('keys');
var uid = __webpack_require__(42);
module.exports = function (key) {
  return shared[key] || (shared[key] = uid(key));
};


/***/ }),
/* 60 */
/***/ (function(module, exports, __webpack_require__) {

var core = __webpack_require__(7);
var global = __webpack_require__(10);
var SHARED = '__core-js_shared__';
var store = global[SHARED] || (global[SHARED] = {});

(module.exports = function (key, value) {
  return store[key] || (store[key] = value !== undefined ? value : {});
})('versions', []).push({
  version: core.version,
  mode: __webpack_require__(41) ? 'pure' : 'global',
  copyright: '© 2019 Denis Pushkarev (zloirock.ru)'
});


/***/ }),
/* 61 */
/***/ (function(module, exports) {

// IE 8- don't enum bug keys
module.exports = (
  'constructor,hasOwnProperty,isPrototypeOf,propertyIsEnumerable,toLocaleString,toString,valueOf'
).split(',');


/***/ }),
/* 62 */
/***/ (function(module, exports, __webpack_require__) {

exports.f = __webpack_require__(12);


/***/ }),
/* 63 */
/***/ (function(module, exports, __webpack_require__) {

var global = __webpack_require__(10);
var core = __webpack_require__(7);
var LIBRARY = __webpack_require__(41);
var wksExt = __webpack_require__(62);
var defineProperty = __webpack_require__(16).f;
module.exports = function (name) {
  var $Symbol = core.Symbol || (core.Symbol = LIBRARY ? {} : global.Symbol || {});
  if (name.charAt(0) != '_' && !(name in $Symbol)) defineProperty($Symbol, name, { value: wksExt.f(name) });
};


/***/ }),
/* 64 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var _interopRequireDefault = __webpack_require__(0);

var _Object$defineProperty = __webpack_require__(1);

_Object$defineProperty(exports, "__esModule", {
  value: true
});

exports.default = void 0;

__webpack_require__(48);

var _keys = _interopRequireDefault(__webpack_require__(27));

__webpack_require__(68);

var _classCallCheck2 = _interopRequireDefault(__webpack_require__(2));

var _createClass2 = _interopRequireDefault(__webpack_require__(3));

var _possibleConstructorReturn2 = _interopRequireDefault(__webpack_require__(5));

var _getPrototypeOf2 = _interopRequireDefault(__webpack_require__(4));

var _inherits2 = _interopRequireDefault(__webpack_require__(6));

var BaseComponent =
/*#__PURE__*/
function (_elementorModules$Mod) {
  (0, _inherits2.default)(BaseComponent, _elementorModules$Mod);

  function BaseComponent() {
    (0, _classCallCheck2.default)(this, BaseComponent);
    return (0, _possibleConstructorReturn2.default)(this, (0, _getPrototypeOf2.default)(BaseComponent).apply(this, arguments));
  }

  (0, _createClass2.default)(BaseComponent, [{
    key: "__construct",
    value: function __construct() {
      var args = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : {};

      if (args.manager) {
        this.manager = args.manager;
      }

      this.commands = this.defaultCommands();
      this.routes = this.defaultRoutes();
      this.tabs = this.defaultTabs();
      this.shortcuts = this.defaultShortcuts();
      this.defaultRoute = '';
      this.currentTab = '';
    }
  }, {
    key: "onInit",
    value: function onInit() {
      var _this = this;

      jQuery.each(this.getTabs(), function (tab) {
        return _this.registerTabRoute(tab);
      });
      jQuery.each(this.getRoutes(), function (route, callback) {
        return _this.registerRoute(route, callback);
      });
      jQuery.each(this.getCommands(), function (command, callback) {
        return _this.registerCommand(command, callback);
      });
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
    key: "defaultShortcuts",
    value: function defaultShortcuts() {
      return {};
    }
  }, {
    key: "getCommands",
    value: function getCommands() {
      return this.commands;
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
  }, {
    key: "registerRoute",
    value: function registerRoute(route, callback) {
      $e.routes.register(this, route, callback);
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
      elementorCommon.elements.$body.addClass(this.getBodyClass(route));
      this.activate();
      this.trigger('route/open', route);
    }
  }, {
    key: "onCloseRoute",
    value: function onCloseRoute(route) {
      elementorCommon.elements.$body.removeClass(this.getBodyClass(route));
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
    key: "getBodyClass",
    value: function getBodyClass(route) {
      return 'e-route-' + route.replace(/\//g, '-');
    }
  }]);
  return BaseComponent;
}(elementorModules.Module);

exports.default = BaseComponent;

/***/ }),
/* 65 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var _interopRequireDefault = __webpack_require__(0);

__webpack_require__(15);

var _defineProperty2 = _interopRequireDefault(__webpack_require__(69));

var ControlBaseView = __webpack_require__(191),
    TagsBehavior = __webpack_require__(308),
    Validator = __webpack_require__(203),
    ControlBaseDataView;

ControlBaseDataView = ControlBaseView.extend({
  ui: function ui() {
    var ui = ControlBaseView.prototype.ui.apply(this, arguments);

    _.extend(ui, {
      input: 'input[data-setting][type!="checkbox"][type!="radio"]',
      checkbox: 'input[data-setting][type="checkbox"]',
      radio: 'input[data-setting][type="radio"]',
      select: 'select[data-setting]',
      textarea: 'textarea[data-setting]',
      responsiveSwitchers: '.elementor-responsive-switcher',
      contentEditable: '[contenteditable="true"]'
    });

    return ui;
  },
  templateHelpers: function templateHelpers() {
    var controlData = ControlBaseView.prototype.templateHelpers.apply(this, arguments);
    controlData.data.controlValue = this.getControlValue();
    return controlData;
  },
  events: function events() {
    return {
      'input @ui.input': 'onBaseInputTextChange',
      'change @ui.checkbox': 'onBaseInputChange',
      'change @ui.radio': 'onBaseInputChange',
      'input @ui.textarea': 'onBaseInputTextChange',
      'change @ui.select': 'onBaseInputChange',
      'input @ui.contentEditable': 'onBaseInputTextChange',
      'click @ui.responsiveSwitchers': 'onResponsiveSwitchersClick'
    };
  },
  behaviors: function behaviors() {
    var behaviors = {},
        dynamicSettings = this.options.model.get('dynamic');

    if (dynamicSettings && dynamicSettings.active) {
      var tags = _.filter(elementor.dynamicTags.getConfig('tags'), function (tag) {
        return _.intersection(tag.categories, dynamicSettings.categories).length;
      });

      if (tags.length) {
        behaviors.tags = {
          behaviorClass: TagsBehavior,
          tags: tags,
          dynamicSettings: dynamicSettings
        };
      }
    }

    return behaviors;
  },
  initialize: function initialize() {
    ControlBaseView.prototype.initialize.apply(this, arguments);
    this.registerValidators(); // TODO: this.elementSettingsModel is deprecated since 2.8.0.

    var settings = this.container ? this.container.settings : this.elementSettingsModel;
    this.listenTo(settings, 'change:external:' + this.model.get('name'), this.onAfterExternalChange);
  },
  getControlValue: function getControlValue() {
    return this.container.settings.get(this.model.get('name'));
  },
  setValue: function setValue(value) {
    this.setSettingsModel(value);
  },
  setSettingsModel: function setSettingsModel(value) {
    var key = this.model.get('name');
    $e.run('document/elements/settings', {
      container: this.options.container,
      settings: (0, _defineProperty2.default)({}, key, value)
    });
    this.triggerMethod('settings:change');
  },
  applySavedValue: function applySavedValue() {
    this.setInputValue('[data-setting="' + this.model.get('name') + '"]', this.getControlValue());
  },
  getEditSettings: function getEditSettings(setting) {
    var settings = this.getOption('elementEditSettings').toJSON();

    if (setting) {
      return settings[setting];
    }

    return settings;
  },
  setEditSetting: function setEditSetting(settingKey, settingValue) {
    var settings = this.getOption('elementEditSettings');
    settings.set(settingKey, settingValue);
  },
  getInputValue: function getInputValue(input) {
    var $input = this.$(input);

    if ($input.is('[contenteditable="true"]')) {
      return $input.html();
    }

    var inputValue = $input.val(),
        inputType = $input.attr('type');

    if (-1 !== ['radio', 'checkbox'].indexOf(inputType)) {
      return $input.prop('checked') ? inputValue : '';
    }

    if ('number' === inputType && _.isFinite(inputValue)) {
      return +inputValue;
    } // Temp fix for jQuery (< 3.0) that return null instead of empty array


    if ('SELECT' === input.tagName && $input.prop('multiple') && null === inputValue) {
      inputValue = [];
    }

    return inputValue;
  },
  setInputValue: function setInputValue(input, value) {
    var $input = this.$(input),
        inputType = $input.attr('type');

    if ('checkbox' === inputType) {
      $input.prop('checked', !!value);
    } else if ('radio' === inputType) {
      $input.filter('[value="' + value + '"]').prop('checked', true);
    } else {
      $input.val(value);
    }
  },
  addValidator: function addValidator(validator) {
    this.validators.push(validator);
  },
  registerValidators: function registerValidators() {
    this.validators = [];
    var validationTerms = {};

    if (this.model.get('required')) {
      validationTerms.required = true;
    }

    if (!jQuery.isEmptyObject(validationTerms)) {
      this.addValidator(new Validator({
        validationTerms: validationTerms
      }));
    }
  },
  onRender: function onRender() {
    ControlBaseView.prototype.onRender.apply(this, arguments);

    if (this.model.get('responsive')) {
      this.renderResponsiveSwitchers();
    }

    this.applySavedValue();
    this.triggerMethod('ready');
    this.toggleControlVisibility();
    this.addTooltip();
  },
  onBaseInputTextChange: function onBaseInputTextChange(event) {
    this.onBaseInputChange(event);
  },
  onBaseInputChange: function onBaseInputChange(event) {
    clearTimeout(this.correctionTimeout);
    var input = event.currentTarget,
        value = this.getInputValue(input),
        validators = this.validators.slice(0),
        settingsValidators = this.container.settings.validators[this.model.get('name')];

    if (settingsValidators) {
      validators = validators.concat(settingsValidators);
    }

    if (validators) {
      var oldValue = this.getControlValue(input.dataset.setting);
      var isValidValue = validators.every(function (validator) {
        return validator.isValid(value, oldValue);
      });

      if (!isValidValue) {
        this.correctionTimeout = setTimeout(this.setInputValue.bind(this, input, oldValue), 1200);
        return;
      }
    }

    this.updateElementModel(value, input);
    this.triggerMethod('input:change', event);
  },
  onResponsiveSwitchersClick: function onResponsiveSwitchersClick(event) {
    var $switcher = jQuery(event.currentTarget),
        device = $switcher.data('device'),
        $switchersWrapper = this.ui.responsiveSwitchersWrapper,
        selectedOption = $switcher.index();
    $switchersWrapper.toggleClass('elementor-responsive-switchers-open');
    $switchersWrapper[0].style.setProperty('--selected-option', selectedOption);
    this.triggerMethod('responsive:switcher:click', device);
    elementor.changeDeviceMode(device);
  },
  renderResponsiveSwitchers: function renderResponsiveSwitchers() {
    var templateHtml = Marionette.Renderer.render('#tmpl-elementor-control-responsive-switchers', this.model.attributes);
    this.ui.controlTitle.after(templateHtml);
    this.ui.responsiveSwitchersWrapper = this.$el.find('.elementor-control-responsive-switchers');
  },
  onAfterExternalChange: function onAfterExternalChange() {
    this.hideTooltip();
    this.applySavedValue();
  },
  addTooltip: function addTooltip() {
    this.ui.tooltipTargets = this.$el.find('.tooltip-target');

    if (!this.ui.tooltipTargets.length) {
      return;
    } // Create tooltip on controls


    this.ui.tooltipTargets.tipsy({
      gravity: function gravity() {
        // `n` for down, `s` for up
        var gravity = jQuery(this).data('tooltip-pos');

        if (undefined !== gravity) {
          return gravity;
        }

        return 'n';
      },
      title: function title() {
        return this.getAttribute('data-tooltip');
      }
    });
  },
  hideTooltip: function hideTooltip() {
    if (this.ui.tooltipTargets.length) {
      this.ui.tooltipTargets.tipsy('hide');
    }
  },
  updateElementModel: function updateElementModel(value) {
    this.setValue(value);
  }
}, {
  // Static methods
  getStyleValue: function getStyleValue(placeholder, controlValue, controlData) {
    if ('DEFAULT' === placeholder) {
      return controlData.default;
    }

    return controlValue;
  },
  onPasteStyle: function onPasteStyle() {
    return true;
  }
});
module.exports = ControlBaseDataView;

/***/ }),
/* 66 */
/***/ (function(module, exports) {

module.exports = function (it) {
  if (typeof it != 'function') throw TypeError(it + ' is not a function!');
  return it;
};


/***/ }),
/* 67 */
/***/ (function(module, exports, __webpack_require__) {

// 19.1.2.9 / 15.2.3.2 Object.getPrototypeOf(O)
var has = __webpack_require__(17);
var toObject = __webpack_require__(34);
var IE_PROTO = __webpack_require__(59)('IE_PROTO');
var ObjectProto = Object.prototype;

module.exports = Object.getPrototypeOf || function (O) {
  O = toObject(O);
  if (has(O, IE_PROTO)) return O[IE_PROTO];
  if (typeof O.constructor == 'function' && O instanceof O.constructor) {
    return O.constructor.prototype;
  } return O instanceof Object ? ObjectProto : null;
};


/***/ }),
/* 68 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var isRegExp = __webpack_require__(108);
var anObject = __webpack_require__(19);
var speciesConstructor = __webpack_require__(170);
var advanceStringIndex = __webpack_require__(89);
var toLength = __webpack_require__(37);
var callRegExpExec = __webpack_require__(78);
var regexpExec = __webpack_require__(76);
var fails = __webpack_require__(22);
var $min = Math.min;
var $push = [].push;
var $SPLIT = 'split';
var LENGTH = 'length';
var LAST_INDEX = 'lastIndex';
var MAX_UINT32 = 0xffffffff;

// babel-minify transpiles RegExp('x', 'y') -> /x/y and it causes SyntaxError
var SUPPORTS_Y = !fails(function () { RegExp(MAX_UINT32, 'y'); });

// @@split logic
__webpack_require__(79)('split', 2, function (defined, SPLIT, $split, maybeCallNative) {
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
/* 70 */
/***/ (function(module, exports, __webpack_require__) {

// optional / simple context binding
var aFunction = __webpack_require__(66);
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
/* 71 */
/***/ (function(module, exports) {

var toString = {}.toString;

module.exports = function (it) {
  return toString.call(it).slice(8, -1);
};


/***/ }),
/* 72 */
/***/ (function(module, exports, __webpack_require__) {

// 22.1.3.31 Array.prototype[@@unscopables]
var UNSCOPABLES = __webpack_require__(9)('unscopables');
var ArrayProto = Array.prototype;
if (ArrayProto[UNSCOPABLES] == undefined) __webpack_require__(25)(ArrayProto, UNSCOPABLES, {});
module.exports = function (key) {
  ArrayProto[UNSCOPABLES][key] = true;
};


/***/ }),
/* 73 */
/***/ (function(module, exports) {

exports.f = Object.getOwnPropertySymbols;


/***/ }),
/* 74 */
/***/ (function(module, exports, __webpack_require__) {

// most Object methods by ES6 should accept primitives
var $export = __webpack_require__(8);
var core = __webpack_require__(7);
var fails = __webpack_require__(23);
module.exports = function (KEY, exec) {
  var fn = (core.Object || {})[KEY] || Object[KEY];
  var exp = {};
  exp[KEY] = exec(fn);
  $export($export.S + $export.F * fails(function () { fn(1); }), 'Object', exp);
};


/***/ }),
/* 75 */,
/* 76 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var regexpFlags = __webpack_require__(91);

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
/* 77 */,
/* 78 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var classof = __webpack_require__(104);
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
/* 79 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";

__webpack_require__(163);
var redefine = __webpack_require__(31);
var hide = __webpack_require__(25);
var fails = __webpack_require__(22);
var defined = __webpack_require__(32);
var wks = __webpack_require__(9);
var regexpExec = __webpack_require__(76);

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
/* 80 */
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
/* 81 */
/***/ (function(module, exports, __webpack_require__) {

// to indexed object, toObject with fallback for non-array-like ES3 strings
var IObject = __webpack_require__(86);
var defined = __webpack_require__(32);
module.exports = function (it) {
  return IObject(defined(it));
};


/***/ }),
/* 82 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";

var $at = __webpack_require__(134)(true);

// 21.1.3.27 String.prototype[@@iterator]()
__webpack_require__(83)(String, 'String', function (iterated) {
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
/* 83 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";

var LIBRARY = __webpack_require__(41);
var $export = __webpack_require__(8);
var redefine = __webpack_require__(94);
var hide = __webpack_require__(26);
var Iterators = __webpack_require__(38);
var $iterCreate = __webpack_require__(135);
var setToStringTag = __webpack_require__(53);
var getPrototypeOf = __webpack_require__(67);
var ITERATOR = __webpack_require__(12)('iterator');
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
/* 84 */
/***/ (function(module, exports, __webpack_require__) {

// 19.1.2.7 / 15.2.3.4 Object.getOwnPropertyNames(O)
var $keys = __webpack_require__(95);
var hiddenKeys = __webpack_require__(61).concat('length', 'prototype');

exports.f = Object.getOwnPropertyNames || function getOwnPropertyNames(O) {
  return $keys(O, hiddenKeys);
};


/***/ }),
/* 85 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var anObject = __webpack_require__(19);
var toLength = __webpack_require__(37);
var advanceStringIndex = __webpack_require__(89);
var regExpExec = __webpack_require__(78);

// @@match logic
__webpack_require__(79)('match', 1, function (defined, MATCH, $match, maybeCallNative) {
  return [
    // `String.prototype.match` method
    // https://tc39.github.io/ecma262/#sec-string.prototype.match
    function match(regexp) {
      var O = defined(this);
      var fn = regexp == undefined ? undefined : regexp[MATCH];
      return fn !== undefined ? fn.call(regexp, O) : new RegExp(regexp)[MATCH](String(O));
    },
    // `RegExp.prototype[@@match]` method
    // https://tc39.github.io/ecma262/#sec-regexp.prototype-@@match
    function (regexp) {
      var res = maybeCallNative($match, regexp, this);
      if (res.done) return res.value;
      var rx = anObject(regexp);
      var S = String(this);
      if (!rx.global) return regExpExec(rx, S);
      var fullUnicode = rx.unicode;
      rx.lastIndex = 0;
      var A = [];
      var n = 0;
      var result;
      while ((result = regExpExec(rx, S)) !== null) {
        var matchStr = String(result[0]);
        A[n] = matchStr;
        if (matchStr === '') rx.lastIndex = advanceStringIndex(S, toLength(rx.lastIndex), fullUnicode);
        n++;
      }
      return n === 0 ? null : A;
    }
  ];
});


/***/ }),
/* 86 */
/***/ (function(module, exports, __webpack_require__) {

// fallback for non-array-like ES3 and non-enumerable old V8 strings
var cof = __webpack_require__(36);
// eslint-disable-next-line no-prototype-builtins
module.exports = Object('z').propertyIsEnumerable(0) ? Object : function (it) {
  return cof(it) == 'String' ? it.split('') : Object(it);
};


/***/ }),
/* 87 */
/***/ (function(module, exports, __webpack_require__) {

var isObject = __webpack_require__(24);
var document = __webpack_require__(13).document;
// typeof document.createElement is 'object' in old IE
var is = isObject(document) && isObject(document.createElement);
module.exports = function (it) {
  return is ? document.createElement(it) : {};
};


/***/ }),
/* 88 */
/***/ (function(module, exports, __webpack_require__) {

// 7.1.1 ToPrimitive(input [, PreferredType])
var isObject = __webpack_require__(24);
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
/* 89 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";

var at = __webpack_require__(162)(true);

 // `AdvanceStringIndex` abstract operation
// https://tc39.github.io/ecma262/#sec-advancestringindex
module.exports = function (S, index, unicode) {
  return index + (unicode ? at(S, index).length : 1);
};


/***/ }),
/* 90 */
/***/ (function(module, exports) {

module.exports = false;


/***/ }),
/* 91 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";

// 21.2.5.3 get RegExp.prototype.flags
var anObject = __webpack_require__(19);
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
/* 92 */
/***/ (function(module, exports, __webpack_require__) {

module.exports = !__webpack_require__(11) && !__webpack_require__(23)(function () {
  return Object.defineProperty(__webpack_require__(93)('div'), 'a', { get: function () { return 7; } }).a != 7;
});


/***/ }),
/* 93 */
/***/ (function(module, exports, __webpack_require__) {

var isObject = __webpack_require__(14);
var document = __webpack_require__(10).document;
// typeof document.createElement is 'object' in old IE
var is = isObject(document) && isObject(document.createElement);
module.exports = function (it) {
  return is ? document.createElement(it) : {};
};


/***/ }),
/* 94 */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(26);


/***/ }),
/* 95 */
/***/ (function(module, exports, __webpack_require__) {

var has = __webpack_require__(17);
var toIObject = __webpack_require__(18);
var arrayIndexOf = __webpack_require__(136)(false);
var IE_PROTO = __webpack_require__(59)('IE_PROTO');

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
/* 96 */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(139);
var global = __webpack_require__(10);
var hide = __webpack_require__(26);
var Iterators = __webpack_require__(38);
var TO_STRING_TAG = __webpack_require__(12)('toStringTag');

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
/* 97 */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(150);

/***/ }),
/* 98 */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(219);

/***/ }),
/* 99 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";

// 19.1.3.6 Object.prototype.toString()
var classof = __webpack_require__(104);
var test = {};
test[__webpack_require__(9)('toStringTag')] = 'z';
if (test + '' != '[object z]') {
  __webpack_require__(31)(Object.prototype, 'toString', function toString() {
    return '[object ' + classof(this) + ']';
  }, true);
}


/***/ }),
/* 100 */,
/* 101 */
/***/ (function(module, exports, __webpack_require__) {

module.exports = !__webpack_require__(21) && !__webpack_require__(22)(function () {
  return Object.defineProperty(__webpack_require__(87)('div'), 'a', { get: function () { return 7; } }).a != 7;
});


/***/ }),
/* 102 */
/***/ (function(module, exports, __webpack_require__) {

// 7.2.2 IsArray(argument)
var cof = __webpack_require__(71);
module.exports = Array.isArray || function isArray(arg) {
  return cof(arg) == 'Array';
};


/***/ }),
/* 103 */
/***/ (function(module, exports, __webpack_require__) {

var _Object$getOwnPropertyDescriptor = __webpack_require__(118);

var _Object$defineProperty = __webpack_require__(1);

function _interopRequireWildcard(obj) {
  if (obj && obj.__esModule) {
    return obj;
  } else {
    var newObj = {};

    if (obj != null) {
      for (var key in obj) {
        if (Object.prototype.hasOwnProperty.call(obj, key)) {
          var desc = _Object$defineProperty && _Object$getOwnPropertyDescriptor ? _Object$getOwnPropertyDescriptor(obj, key) : {};

          if (desc.get || desc.set) {
            _Object$defineProperty(newObj, key, desc);
          } else {
            newObj[key] = obj[key];
          }
        }
      }
    }

    newObj["default"] = obj;
    return newObj;
  }
}

module.exports = _interopRequireWildcard;

/***/ }),
/* 104 */
/***/ (function(module, exports, __webpack_require__) {

// getting tag from 19.1.3.6 Object.prototype.toString()
var cof = __webpack_require__(36);
var TAG = __webpack_require__(9)('toStringTag');
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
/* 105 */
/***/ (function(module, exports) {

module.exports = function (it) {
  if (typeof it != 'function') throw TypeError(it + ' is not a function!');
  return it;
};


/***/ }),
/* 106 */
/***/ (function(module, exports, __webpack_require__) {

// fallback for non-array-like ES3 and non-enumerable old V8 strings
var cof = __webpack_require__(71);
// eslint-disable-next-line no-prototype-builtins
module.exports = Object('z').propertyIsEnumerable(0) ? Object : function (it) {
  return cof(it) == 'String' ? it.split('') : Object(it);
};


/***/ }),
/* 107 */
/***/ (function(module, exports, __webpack_require__) {

// 7.1.15 ToLength
var toInteger = __webpack_require__(58);
var min = Math.min;
module.exports = function (it) {
  return it > 0 ? min(toInteger(it), 0x1fffffffffffff) : 0; // pow(2, 53) - 1 == 9007199254740991
};


/***/ }),
/* 108 */
/***/ (function(module, exports, __webpack_require__) {

// 7.2.8 IsRegExp(argument)
var isObject = __webpack_require__(24);
var cof = __webpack_require__(36);
var MATCH = __webpack_require__(9)('match');
module.exports = function (it) {
  var isRegExp;
  return isObject(it) && ((isRegExp = it[MATCH]) !== undefined ? !!isRegExp : cof(it) == 'RegExp');
};


/***/ }),
/* 109 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var _interopRequireDefault = __webpack_require__(0);

var _Object$defineProperty = __webpack_require__(1);

_Object$defineProperty(exports, "__esModule", {
  value: true
});

exports.default = void 0;

var _values = _interopRequireDefault(__webpack_require__(111));

var _classCallCheck2 = _interopRequireDefault(__webpack_require__(2));

var _createClass2 = _interopRequireDefault(__webpack_require__(3));

var Helpers =
/*#__PURE__*/
function () {
  function Helpers() {
    (0, _classCallCheck2.default)(this, Helpers);
  }

  (0, _createClass2.default)(Helpers, null, [{
    key: "findViewRecursive",
    value: function findViewRecursive(parent, key, value) {
      var multiple = arguments.length > 3 && arguments[3] !== undefined ? arguments[3] : true;
      var found = [];

      for (var x in parent._views) {
        var view = parent._views[x];

        if (value === view.model.get(key)) {
          found.push(view);

          if (!multiple) {
            return found;
          }
        }

        if (view.children) {
          var views = Helpers.findViewRecursive(view.children, key, value, multiple);

          if (views.length) {
            found = found.concat(views);

            if (!multiple) {
              return found;
            }
          }
        }
      }

      return found;
    }
  }, {
    key: "findViewById",
    value: function findViewById(id) {
      var elements = Helpers.findViewRecursive(elementor.getPreviewView().children, 'id', id, false);
      return elements ? elements[0] : false;
    }
  }, {
    key: "isValidChild",
    value: function isValidChild(childModel, parentModel) {
      var parentElType = parentModel.get('elType'),
          draggedElType = childModel.get('elType'),
          parentIsInner = parentModel.get('isInner'),
          draggedIsInner = childModel.get('isInner'); // Block's inner-section at inner-section column.

      if (draggedIsInner && 'section' === draggedElType && parentIsInner && 'column' === parentElType) {
        return false;
      }

      if (draggedElType === parentElType) {
        return false;
      }

      if ('section' === draggedElType && !draggedIsInner && 'column' === parentElType) {
        return false;
      }

      var childTypes = elementor.helpers.getElementChildType(parentElType);
      return childTypes && -1 !== childTypes.indexOf(childModel.get('elType'));
    }
  }, {
    key: "isValidGrandChild",
    value: function isValidGrandChild(childModel, targetContainer) {
      var result;
      var childElType = childModel.get('elType');

      switch (targetContainer.model.get('elType')) {
        case 'document':
          result = true;
          break;

        case 'section':
          result = 'widget' === childElType;
          break;

        default:
          result = false;
      }

      return result;
    }
  }, {
    key: "isSameElement",
    value: function isSameElement(sourceModel, targetContainer) {
      var targetElType = targetContainer.model.get('elType'),
          sourceElType = sourceModel.get('elType');

      if (targetElType !== sourceElType) {
        return false;
      }

      if ('column' === targetElType && 'column' === sourceElType) {
        return true;
      }

      return targetContainer.model.get('isInner') === sourceModel.get('isInner');
    }
  }, {
    key: "getPasteOptions",
    value: function getPasteOptions(sourceModel, targetContainer) {
      var result = {};
      result.isValidChild = Helpers.isValidChild(sourceModel, targetContainer.model);
      result.isSameElement = Helpers.isSameElement(sourceModel, targetContainer);
      result.isValidGrandChild = Helpers.isValidGrandChild(sourceModel, targetContainer);
      return result;
    }
  }, {
    key: "isPasteEnabled",
    value: function isPasteEnabled(targetContainer) {
      var storage = elementorCommon.storage.get('clipboard'); // No storage? no paste.

      if (!storage || !storage[0]) {
        return false;
      }

      if (!(storage[0] instanceof Backbone.Model)) {
        storage[0] = new Backbone.Model(storage[0]);
      }

      var pasteOptions = Helpers.getPasteOptions(storage[0], targetContainer);
      return (0, _values.default)(pasteOptions).some(function (opt) {
        return !!opt;
      });
    }
  }]);
  return Helpers;
}();

exports.default = Helpers;

/***/ }),
/* 110 */
/***/ (function(module, exports, __webpack_require__) {

var arrayWithHoles = __webpack_require__(205);

var iterableToArrayLimit = __webpack_require__(208);

var nonIterableRest = __webpack_require__(211);

function _slicedToArray(arr, i) {
  return arrayWithHoles(arr) || iterableToArrayLimit(arr, i) || nonIterableRest();
}

module.exports = _slicedToArray;

/***/ }),
/* 111 */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(228);

/***/ }),
/* 112 */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(51)('native-function-to-string', Function.toString);


/***/ }),
/* 113 */
/***/ (function(module, exports, __webpack_require__) {

var META = __webpack_require__(42)('meta');
var isObject = __webpack_require__(14);
var has = __webpack_require__(17);
var setDesc = __webpack_require__(16).f;
var id = 0;
var isExtensible = Object.isExtensible || function () {
  return true;
};
var FREEZE = !__webpack_require__(23)(function () {
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
/* 114 */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(153);

/***/ }),
/* 115 */
/***/ (function(module, exports, __webpack_require__) {

var _Object$setPrototypeOf = __webpack_require__(97);

function _setPrototypeOf(o, p) {
  module.exports = _setPrototypeOf = _Object$setPrototypeOf || function _setPrototypeOf(o, p) {
    o.__proto__ = p;
    return o;
  };

  return _setPrototypeOf(o, p);
}

module.exports = _setPrototypeOf;

/***/ }),
/* 116 */
/***/ (function(module, exports, __webpack_require__) {

var shared = __webpack_require__(51)('keys');
var uid = __webpack_require__(52);
module.exports = function (key) {
  return shared[key] || (shared[key] = uid(key));
};


/***/ }),
/* 117 */
/***/ (function(module, exports, __webpack_require__) {

// 0 -> Array#forEach
// 1 -> Array#map
// 2 -> Array#filter
// 3 -> Array#some
// 4 -> Array#every
// 5 -> Array#find
// 6 -> Array#findIndex
var ctx = __webpack_require__(70);
var IObject = __webpack_require__(86);
var toObject = __webpack_require__(54);
var toLength = __webpack_require__(37);
var asc = __webpack_require__(129);
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
/* 118 */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(164);

/***/ }),
/* 119 */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(206);

/***/ }),
/* 120 */
/***/ (function(module, exports, __webpack_require__) {

var dP = __webpack_require__(16);
var anObject = __webpack_require__(20);
var getKeys = __webpack_require__(33);

module.exports = __webpack_require__(11) ? Object.defineProperties : function defineProperties(O, Properties) {
  anObject(O);
  var keys = getKeys(Properties);
  var length = keys.length;
  var i = 0;
  var P;
  while (length > i) dP.f(O, P = keys[i++], Properties[P]);
  return O;
};


/***/ }),
/* 121 */
/***/ (function(module, exports) {

module.exports = function (done, value) {
  return { value: value, done: !!done };
};


/***/ }),
/* 122 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";

// ECMAScript 6 symbols shim
var global = __webpack_require__(10);
var has = __webpack_require__(17);
var DESCRIPTORS = __webpack_require__(11);
var $export = __webpack_require__(8);
var redefine = __webpack_require__(94);
var META = __webpack_require__(113).KEY;
var $fails = __webpack_require__(23);
var shared = __webpack_require__(60);
var setToStringTag = __webpack_require__(53);
var uid = __webpack_require__(42);
var wks = __webpack_require__(12);
var wksExt = __webpack_require__(62);
var wksDefine = __webpack_require__(63);
var enumKeys = __webpack_require__(143);
var isArray = __webpack_require__(102);
var anObject = __webpack_require__(20);
var isObject = __webpack_require__(14);
var toObject = __webpack_require__(34);
var toIObject = __webpack_require__(18);
var toPrimitive = __webpack_require__(57);
var createDesc = __webpack_require__(39);
var _create = __webpack_require__(50);
var gOPNExt = __webpack_require__(144);
var $GOPD = __webpack_require__(44);
var $GOPS = __webpack_require__(73);
var $DP = __webpack_require__(16);
var $keys = __webpack_require__(33);
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
  __webpack_require__(84).f = gOPNExt.f = $getOwnPropertyNames;
  __webpack_require__(43).f = $propertyIsEnumerable;
  $GOPS.f = $getOwnPropertySymbols;

  if (DESCRIPTORS && !__webpack_require__(41)) {
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
$Symbol[PROTOTYPE][TO_PRIMITIVE] || __webpack_require__(26)($Symbol[PROTOTYPE], TO_PRIMITIVE, $Symbol[PROTOTYPE].valueOf);
// 19.4.3.5 Symbol.prototype[@@toStringTag]
setToStringTag($Symbol, 'Symbol');
// 20.2.1.9 Math[@@toStringTag]
setToStringTag(Math, 'Math', true);
// 24.3.3 JSON[@@toStringTag]
setToStringTag(global.JSON, 'JSON', true);


/***/ }),
/* 123 */
/***/ (function(module, exports) {



/***/ }),
/* 124 */
/***/ (function(module, exports) {

module.exports = {};


/***/ }),
/* 125 */
/***/ (function(module, exports, __webpack_require__) {

// false -> Array#indexOf
// true  -> Array#includes
var toIObject = __webpack_require__(81);
var toLength = __webpack_require__(37);
var toAbsoluteIndex = __webpack_require__(171);
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
/* 126 */
/***/ (function(module, exports) {

// IE 8- don't enum bug keys
module.exports = (
  'constructor,hasOwnProperty,isPrototypeOf,propertyIsEnumerable,toLocaleString,toString,valueOf'
).split(',');


/***/ }),
/* 127 */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(128);
var $Object = __webpack_require__(7).Object;
module.exports = function defineProperty(it, key, desc) {
  return $Object.defineProperty(it, key, desc);
};


/***/ }),
/* 128 */
/***/ (function(module, exports, __webpack_require__) {

var $export = __webpack_require__(8);
// 19.1.2.4 / 15.2.3.6 Object.defineProperty(O, P, Attributes)
$export($export.S + $export.F * !__webpack_require__(11), 'Object', { defineProperty: __webpack_require__(16).f });


/***/ }),
/* 129 */
/***/ (function(module, exports, __webpack_require__) {

// 9.4.2.3 ArraySpeciesCreate(originalArray, length)
var speciesConstructor = __webpack_require__(130);

module.exports = function (original, length) {
  return new (speciesConstructor(original))(length);
};


/***/ }),
/* 130 */
/***/ (function(module, exports, __webpack_require__) {

var isObject = __webpack_require__(24);
var isArray = __webpack_require__(131);
var SPECIES = __webpack_require__(9)('species');

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
/* 131 */
/***/ (function(module, exports, __webpack_require__) {

// 7.2.2 IsArray(argument)
var cof = __webpack_require__(36);
module.exports = Array.isArray || function isArray(arg) {
  return cof(arg) == 'Array';
};


/***/ }),
/* 132 */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(133);

/***/ }),
/* 133 */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(82);
__webpack_require__(96);
module.exports = __webpack_require__(62).f('iterator');


/***/ }),
/* 134 */
/***/ (function(module, exports, __webpack_require__) {

var toInteger = __webpack_require__(58);
var defined = __webpack_require__(49);
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
/* 135 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";

var create = __webpack_require__(50);
var descriptor = __webpack_require__(39);
var setToStringTag = __webpack_require__(53);
var IteratorPrototype = {};

// 25.1.2.1.1 %IteratorPrototype%[@@iterator]()
__webpack_require__(26)(IteratorPrototype, __webpack_require__(12)('iterator'), function () { return this; });

module.exports = function (Constructor, NAME, next) {
  Constructor.prototype = create(IteratorPrototype, { next: descriptor(1, next) });
  setToStringTag(Constructor, NAME + ' Iterator');
};


/***/ }),
/* 136 */
/***/ (function(module, exports, __webpack_require__) {

// false -> Array#indexOf
// true  -> Array#includes
var toIObject = __webpack_require__(18);
var toLength = __webpack_require__(107);
var toAbsoluteIndex = __webpack_require__(137);
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
/* 137 */
/***/ (function(module, exports, __webpack_require__) {

var toInteger = __webpack_require__(58);
var max = Math.max;
var min = Math.min;
module.exports = function (index, length) {
  index = toInteger(index);
  return index < 0 ? max(index + length, 0) : min(index, length);
};


/***/ }),
/* 138 */
/***/ (function(module, exports, __webpack_require__) {

var document = __webpack_require__(10).document;
module.exports = document && document.documentElement;


/***/ }),
/* 139 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";

var addToUnscopables = __webpack_require__(140);
var step = __webpack_require__(121);
var Iterators = __webpack_require__(38);
var toIObject = __webpack_require__(18);

// 22.1.3.4 Array.prototype.entries()
// 22.1.3.13 Array.prototype.keys()
// 22.1.3.29 Array.prototype.values()
// 22.1.3.30 Array.prototype[@@iterator]()
module.exports = __webpack_require__(83)(Array, 'Array', function (iterated, kind) {
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
/* 140 */
/***/ (function(module, exports) {

module.exports = function () { /* empty */ };


/***/ }),
/* 141 */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(142);

/***/ }),
/* 142 */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(122);
__webpack_require__(123);
__webpack_require__(145);
__webpack_require__(146);
module.exports = __webpack_require__(7).Symbol;


/***/ }),
/* 143 */
/***/ (function(module, exports, __webpack_require__) {

// all enumerable object keys, includes symbols
var getKeys = __webpack_require__(33);
var gOPS = __webpack_require__(73);
var pIE = __webpack_require__(43);
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
/* 144 */
/***/ (function(module, exports, __webpack_require__) {

// fallback for IE11 buggy Object.getOwnPropertyNames with iframe and window
var toIObject = __webpack_require__(18);
var gOPN = __webpack_require__(84).f;
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
/* 145 */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(63)('asyncIterator');


/***/ }),
/* 146 */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(63)('observable');


/***/ }),
/* 147 */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(148);

/***/ }),
/* 148 */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(149);
module.exports = __webpack_require__(7).Object.getPrototypeOf;


/***/ }),
/* 149 */
/***/ (function(module, exports, __webpack_require__) {

// 19.1.2.9 Object.getPrototypeOf(O)
var toObject = __webpack_require__(34);
var $getPrototypeOf = __webpack_require__(67);

__webpack_require__(74)('getPrototypeOf', function () {
  return function getPrototypeOf(it) {
    return $getPrototypeOf(toObject(it));
  };
});


/***/ }),
/* 150 */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(151);
module.exports = __webpack_require__(7).Object.setPrototypeOf;


/***/ }),
/* 151 */
/***/ (function(module, exports, __webpack_require__) {

// 19.1.3.19 Object.setPrototypeOf(O, proto)
var $export = __webpack_require__(8);
$export($export.S, 'Object', { setPrototypeOf: __webpack_require__(152).set });


/***/ }),
/* 152 */
/***/ (function(module, exports, __webpack_require__) {

// Works with __proto__ only. Old v8 can't work with null proto objects.
/* eslint-disable no-proto */
var isObject = __webpack_require__(14);
var anObject = __webpack_require__(20);
var check = function (O, proto) {
  anObject(O);
  if (!isObject(proto) && proto !== null) throw TypeError(proto + ": can't set as prototype!");
};
module.exports = {
  set: Object.setPrototypeOf || ('__proto__' in {} ? // eslint-disable-line
    function (test, buggy, set) {
      try {
        set = __webpack_require__(55)(Function.call, __webpack_require__(44).f(Object.prototype, '__proto__').set, 2);
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
/* 153 */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(154);
var $Object = __webpack_require__(7).Object;
module.exports = function create(P, D) {
  return $Object.create(P, D);
};


/***/ }),
/* 154 */
/***/ (function(module, exports, __webpack_require__) {

var $export = __webpack_require__(8);
// 19.1.2.2 / 15.2.3.5 Object.create(O [, Properties])
$export($export.S, 'Object', { create: __webpack_require__(50) });


/***/ }),
/* 155 */
/***/ (function(module, exports, __webpack_require__) {

// getting tag from 19.1.3.6 Object.prototype.toString()
var cof = __webpack_require__(71);
var TAG = __webpack_require__(12)('toStringTag');
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
/* 156 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var _interopRequireDefault = __webpack_require__(0);

var _typeof2 = _interopRequireDefault(__webpack_require__(47));

var ControlBaseDataView = __webpack_require__(65),
    ControlBaseMultipleItemView;

ControlBaseMultipleItemView = ControlBaseDataView.extend({
  applySavedValue: function applySavedValue() {
    var values = this.getControlValue(),
        $inputs = this.$('[data-setting]'),
        self = this;

    _.each(values, function (value, key) {
      var $input = $inputs.filter(function () {
        return key === this.dataset.setting;
      });
      self.setInputValue($input, value);
    });
  },
  getControlValue: function getControlValue(key) {
    var values = this.container.settings.get(this.model.get('name'));

    if (!jQuery.isPlainObject(values)) {
      return {};
    }

    if (key) {
      var value = values[key];

      if (undefined === value) {
        value = '';
      }

      return value;
    }

    return elementorCommon.helpers.cloneObject(values);
  },
  setValue: function setValue(key, value) {
    var values = this.getControlValue();

    if ('object' === (0, _typeof2.default)(key)) {
      _.each(key, function (internalValue, internalKey) {
        values[internalKey] = internalValue;
      });
    } else {
      values[key] = value;
    }

    this.setSettingsModel(values);
  },
  updateElementModel: function updateElementModel(value, input) {
    var key = input.dataset.setting;
    this.setValue(key, value);
  }
}, {
  // Static methods
  getStyleValue: function getStyleValue(placeholder, controlValue) {
    if (!_.isObject(controlValue)) {
      return ''; // invalid
    }

    return controlValue[placeholder.toLowerCase()];
  }
});
module.exports = ControlBaseMultipleItemView;

/***/ }),
/* 157 */
/***/ (function(module, exports) {

module.exports = '\x09\x0A\x0B\x0C\x0D\x20\xA0\u1680\u180E\u2000\u2001\u2002\u2003' +
  '\u2004\u2005\u2006\u2007\u2008\u2009\u200A\u202F\u205F\u3000\u2028\u2029\uFEFF';


/***/ }),
/* 158 */,
/* 159 */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(230);

/***/ }),
/* 160 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";

var addToUnscopables = __webpack_require__(72);
var step = __webpack_require__(212);
var Iterators = __webpack_require__(124);
var toIObject = __webpack_require__(81);

// 22.1.3.4 Array.prototype.entries()
// 22.1.3.13 Array.prototype.keys()
// 22.1.3.29 Array.prototype.values()
// 22.1.3.30 Array.prototype[@@iterator]()
module.exports = __webpack_require__(213)(Array, 'Array', function (iterated, kind) {
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
/* 161 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";

var $export = __webpack_require__(29);
var aFunction = __webpack_require__(66);
var toObject = __webpack_require__(54);
var fails = __webpack_require__(22);
var $sort = [].sort;
var test = [1, 2, 3];

$export($export.P + $export.F * (fails(function () {
  // IE8-
  test.sort(undefined);
}) || !fails(function () {
  // V8 bug
  test.sort(null);
  // Old WebKit
}) || !__webpack_require__(218)($sort)), 'Array', {
  // 22.1.3.25 Array.prototype.sort(comparefn)
  sort: function sort(comparefn) {
    return comparefn === undefined
      ? $sort.call(toObject(this))
      : $sort.call(toObject(this), aFunction(comparefn));
  }
});


/***/ }),
/* 162 */
/***/ (function(module, exports, __webpack_require__) {

var toInteger = __webpack_require__(40);
var defined = __webpack_require__(32);
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
/* 163 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";

var regexpExec = __webpack_require__(76);
__webpack_require__(29)({
  target: 'RegExp',
  proto: true,
  forced: regexpExec !== /./.exec
}, {
  exec: regexpExec
});


/***/ }),
/* 164 */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(165);
var $Object = __webpack_require__(7).Object;
module.exports = function getOwnPropertyDescriptor(it, key) {
  return $Object.getOwnPropertyDescriptor(it, key);
};


/***/ }),
/* 165 */
/***/ (function(module, exports, __webpack_require__) {

// 19.1.2.6 Object.getOwnPropertyDescriptor(O, P)
var toIObject = __webpack_require__(18);
var $getOwnPropertyDescriptor = __webpack_require__(44).f;

__webpack_require__(74)('getOwnPropertyDescriptor', function () {
  return function getOwnPropertyDescriptor(it, key) {
    return $getOwnPropertyDescriptor(toIObject(it), key);
  };
});


/***/ }),
/* 166 */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(167);

/***/ }),
/* 167 */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(168);
module.exports = __webpack_require__(7).Reflect.get;


/***/ }),
/* 168 */
/***/ (function(module, exports, __webpack_require__) {

// 26.1.6 Reflect.get(target, propertyKey [, receiver])
var gOPD = __webpack_require__(44);
var getPrototypeOf = __webpack_require__(67);
var has = __webpack_require__(17);
var $export = __webpack_require__(8);
var isObject = __webpack_require__(14);
var anObject = __webpack_require__(20);

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
/* 169 */
/***/ (function(module, exports, __webpack_require__) {

var getPrototypeOf = __webpack_require__(4);

function _superPropBase(object, property) {
  while (!Object.prototype.hasOwnProperty.call(object, property)) {
    object = getPrototypeOf(object);
    if (object === null) break;
  }

  return object;
}

module.exports = _superPropBase;

/***/ }),
/* 170 */
/***/ (function(module, exports, __webpack_require__) {

// 7.3.20 SpeciesConstructor(O, defaultConstructor)
var anObject = __webpack_require__(19);
var aFunction = __webpack_require__(66);
var SPECIES = __webpack_require__(9)('species');
module.exports = function (O, D) {
  var C = anObject(O).constructor;
  var S;
  return C === undefined || (S = anObject(C)[SPECIES]) == undefined ? D : aFunction(S);
};


/***/ }),
/* 171 */
/***/ (function(module, exports, __webpack_require__) {

var toInteger = __webpack_require__(40);
var max = Math.max;
var min = Math.min;
module.exports = function (index, length) {
  index = toInteger(index);
  return index < 0 ? max(index + length, 0) : min(index, length);
};


/***/ }),
/* 172 */
/***/ (function(module, exports, __webpack_require__) {

var classof = __webpack_require__(155);
var ITERATOR = __webpack_require__(12)('iterator');
var Iterators = __webpack_require__(38);
module.exports = __webpack_require__(7).getIteratorMethod = function (it) {
  if (it != undefined) return it[ITERATOR]
    || it['@@iterator']
    || Iterators[classof(it)];
};


/***/ }),
/* 173 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";

__webpack_require__(235);
var anObject = __webpack_require__(19);
var $flags = __webpack_require__(91);
var DESCRIPTORS = __webpack_require__(21);
var TO_STRING = 'toString';
var $toString = /./[TO_STRING];

var define = function (fn) {
  __webpack_require__(31)(RegExp.prototype, TO_STRING, fn, true);
};

// 21.2.5.14 RegExp.prototype.toString()
if (__webpack_require__(22)(function () { return $toString.call({ source: 'a', flags: 'b' }) != '/a/b'; })) {
  define(function toString() {
    var R = anObject(this);
    return '/'.concat(R.source, '/',
      'flags' in R ? R.flags : !DESCRIPTORS && R instanceof RegExp ? $flags.call(R) : undefined);
  });
// FF44- RegExp#toString has a wrong name
} else if ($toString.name != TO_STRING) {
  define(function toString() {
    return $toString.call(this);
  });
}


/***/ }),
/* 174 */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(195);

/***/ }),
/* 175 */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(227);

/***/ }),
/* 176 */
/***/ (function(module, exports, __webpack_require__) {

// 19.1.2.14 / 15.2.3.14 Object.keys(O)
var $keys = __webpack_require__(184);
var enumBugKeys = __webpack_require__(126);

module.exports = Object.keys || function keys(O) {
  return $keys(O, enumBugKeys);
};


/***/ }),
/* 177 */
/***/ (function(module, exports, __webpack_require__) {

var def = __webpack_require__(35).f;
var has = __webpack_require__(46);
var TAG = __webpack_require__(9)('toStringTag');

module.exports = function (it, tag, stat) {
  if (it && !has(it = stat ? it : it.prototype, TAG)) def(it, TAG, { configurable: true, value: tag });
};


/***/ }),
/* 178 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var _interopRequireDefault = __webpack_require__(0);

__webpack_require__(15);

var _inline = _interopRequireDefault(__webpack_require__(269));

var BaseElementView = __webpack_require__(200);

var DEFAULT_INNER_SECTION_COLUMNS = 2,
    DEFAULT_MIN_COLUMN_SIZE = 2,
    DEFAULT_MAX_COLUMNS = 10;
var SectionView = BaseElementView.extend({
  childViewContainer: '> .elementor-container > .elementor-row',
  template: Marionette.TemplateCache.get('#tmpl-elementor-section-content'),
  addSectionView: null,
  _checkIsFull: function _checkIsFull() {
    // TODO: should be part of $e.events.
    this.$el.toggleClass('elementor-section-filled', this.isCollectionFilled());
  },
  addChildModel: function addChildModel(model) {
    /// TODO: maybe should be part of $e.hooks.
    var isModelInstance = model instanceof Backbone.Model,
        isInner = this.isInner();

    if (isModelInstance) {
      // TODO: change to command.
      model.set('isInner', isInner);
    } else {
      model.isInner = isInner;
    }

    return BaseElementView.prototype.addChildModel.apply(this, arguments);
  },
  className: function className() {
    var classes = BaseElementView.prototype.className.apply(this, arguments),
        type = this.isInner() ? 'inner' : 'top';
    return classes + ' elementor-section elementor-' + type + '-section';
  },
  tagName: function tagName() {
    return this.model.getSetting('html_tag') || 'section';
  },
  behaviors: function behaviors() {
    var behaviors = BaseElementView.prototype.behaviors.apply(this, arguments);

    _.extend(behaviors, {
      Sortable: {
        behaviorClass: __webpack_require__(201),
        elChildType: 'column'
      }
    });

    return elementor.hooks.applyFilters('elements/section/behaviors', behaviors, this);
  },
  initialize: function initialize() {
    BaseElementView.prototype.initialize.apply(this, arguments);
  },
  getEditButtons: function getEditButtons() {
    var elementData = elementor.getElementData(this.model),
        editTools = {};

    if (!this.isInner()) {
      editTools.add = {
        title: elementor.translate('add_element', [elementData.title]),
        icon: 'plus'
      };
    }

    editTools.edit = {
      title: elementor.translate('edit_element', [elementData.title]),
      icon: 'handle'
    };

    if (elementor.getPreferences('edit_buttons')) {
      editTools.duplicate = {
        title: elementor.translate('duplicate_element', [elementData.title]),
        icon: 'clone'
      };
    }

    editTools.remove = {
      title: elementor.translate('delete_element', [elementData.title]),
      icon: 'close'
    };
    return editTools;
  },
  getContextMenuGroups: function getContextMenuGroups() {
    var groups = BaseElementView.prototype.getContextMenuGroups.apply(this, arguments),
        transferGroupIndex = groups.indexOf(_.findWhere(groups, {
      name: 'clipboard'
    }));
    groups.splice(transferGroupIndex + 1, 0, {
      name: 'save',
      actions: [{
        name: 'save',
        title: elementor.translate('save_as_block'),
        callback: this.save.bind(this)
      }]
    });
    return groups;
  },
  getSortableOptions: function getSortableOptions() {
    var sectionConnectClass = this.isInner() ? '.elementor-inner-section' : '.elementor-top-section';
    return {
      connectWith: sectionConnectClass + ' > .elementor-container > .elementor-row',
      handle: '> .elementor-element-overlay .elementor-editor-element-edit',
      items: '> .elementor-column',
      forcePlaceholderSize: true,
      tolerance: 'pointer'
    };
  },
  getColumnPercentSize: function getColumnPercentSize(element, size) {
    return +(size / element.parent().width() * 100).toFixed(3);
  },
  getDefaultStructure: function getDefaultStructure() {
    return this.collection.length + '0';
  },
  getStructure: function getStructure() {
    return this.model.getSetting('structure');
  },
  getColumnAt: function getColumnAt(index) {
    var model = this.collection.at(index);
    return model ? this.children.findByModelCid(model.cid) : null;
  },
  getNextColumn: function getNextColumn(columnView) {
    return this.getColumnAt(this.collection.indexOf(columnView.model) + 1);
  },
  getPreviousColumn: function getPreviousColumn(columnView) {
    return this.getColumnAt(this.collection.indexOf(columnView.model) - 1);
  },
  getNeighborContainer: function getNeighborContainer(container) {
    var parentView = container.parent.view,
        nextView = parentView.getNextColumn(container.view) || parentView.getPreviousColumn(container.view);

    if (!nextView) {
      return false;
    }

    return nextView.getContainer();
  },
  setStructure: function setStructure(structure) {
    var parsedStructure = elementor.presetsFactory.getParsedStructure(structure);

    if (+parsedStructure.columnsCount !== this.collection.length) {
      throw new TypeError('The provided structure doesn\'t match the columns count.');
    }

    $e.run('document/elements/settings', {
      container: this.getContainer(),
      settings: {
        structure: structure
      },
      options: {
        external: true
      }
    });
    this.adjustColumns();
  },
  adjustColumns: function adjustColumns() {
    var preset = elementor.presetsFactory.getPresetByStructure(this.getStructure());
    this.children.each(function (columnView, index) {
      var container = columnView.getContainer();
      $e.run('document/elements/settings', {
        container: container,
        settings: {
          _column_size: preset.preset[index],
          _inline_size: null
        }
      });
    });
  },
  resetLayout: function resetLayout() {
    this.setStructure(this.getDefaultStructure());
  },
  resetColumnsCustomSize: function resetColumnsCustomSize() {
    this.children.each(function (columnView) {
      $e.run('document/elements/settings', {
        container: columnView.getContainer(),
        settings: {
          _inline_size: null
        },
        options: {
          external: true
        }
      });
    });
  },
  isCollectionFilled: function isCollectionFilled() {
    return DEFAULT_MAX_COLUMNS <= this.collection.length;
  },
  showChildrenPercentsTooltip: function showChildrenPercentsTooltip(columnView, nextColumnView) {
    columnView.ui.percentsTooltip.show();
    columnView.ui.percentsTooltip.attr('data-side', elementorCommon.config.isRTL ? 'right' : 'left');
    nextColumnView.ui.percentsTooltip.show();
    nextColumnView.ui.percentsTooltip.attr('data-side', elementorCommon.config.isRTL ? 'left' : 'right');
  },
  hideChildrenPercentsTooltip: function hideChildrenPercentsTooltip(columnView, nextColumnView) {
    columnView.ui.percentsTooltip.hide();
    nextColumnView.ui.percentsTooltip.hide();
  },
  destroyAddSectionView: function destroyAddSectionView() {
    if (this.addSectionView && !this.addSectionView.isDestroyed) {
      this.addSectionView.destroy();
    }
  },
  onRender: function onRender() {
    BaseElementView.prototype.onRender.apply(this, arguments);

    this._checkIsFull();
  },
  onAddButtonClick: function onAddButtonClick() {
    if (this.addSectionView && !this.addSectionView.isDestroyed) {
      this.addSectionView.fadeToDeath();
      return;
    }

    var addSectionView = new _inline.default({
      at: this.model.collection.indexOf(this.model)
    });
    addSectionView.render();
    this.$el.before(addSectionView.$el);
    addSectionView.$el.hide(); // Delaying the slide down for slow-render browsers (such as FF)

    setTimeout(function () {
      addSectionView.$el.slideDown();
    });
    this.addSectionView = addSectionView;
  },
  onChildviewRequestResizeStart: function onChildviewRequestResizeStart(columnView) {
    var nextColumnView = this.getNextColumn(columnView);

    if (!nextColumnView) {
      return;
    }

    this.showChildrenPercentsTooltip(columnView, nextColumnView);
    var $iframes = columnView.$el.find('iframe').add(nextColumnView.$el.find('iframe'));
    elementor.helpers.disableElementEvents($iframes);
  },
  onChildviewRequestResizeStop: function onChildviewRequestResizeStop(columnView) {
    var nextColumnView = this.getNextColumn(columnView);

    if (!nextColumnView) {
      return;
    }

    this.hideChildrenPercentsTooltip(columnView, nextColumnView);
    var $iframes = columnView.$el.find('iframe').add(nextColumnView.$el.find('iframe'));
    elementor.helpers.enableElementEvents($iframes);
  },
  onChildviewRequestResize: function onChildviewRequestResize(columnView, ui) {
    ui.element.css({
      width: '',
      left: 'initial' // Fix for RTL resizing

    });
    $e.run('document/elements/settings', {
      container: columnView.getContainer(),
      settings: {
        _inline_size: this.getColumnPercentSize(ui.element, ui.size.width)
      }
    });
  },
  onDestroy: function onDestroy() {
    BaseElementView.prototype.onDestroy.apply(this, arguments);
    this.destroyAddSectionView();
  }
});
module.exports = SectionView;
module.exports.DEFAULT_INNER_SECTION_COLUMNS = DEFAULT_INNER_SECTION_COLUMNS;
module.exports.DEFAULT_MIN_COLUMN_SIZE = DEFAULT_MIN_COLUMN_SIZE;
module.exports.DEFAULT_MAX_COLUMNS = DEFAULT_MAX_COLUMNS;

/***/ }),
/* 179 */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(180);
module.exports = __webpack_require__(7).Object.keys;


/***/ }),
/* 180 */
/***/ (function(module, exports, __webpack_require__) {

// 19.1.2.14 Object.keys(O)
var toObject = __webpack_require__(34);
var $keys = __webpack_require__(33);

__webpack_require__(74)('keys', function () {
  return function keys(it) {
    return $keys(toObject(it));
  };
});


/***/ }),
/* 181 */
/***/ (function(module, exports, __webpack_require__) {

var DESCRIPTORS = __webpack_require__(11);
var getKeys = __webpack_require__(33);
var toIObject = __webpack_require__(18);
var isEnum = __webpack_require__(43).f;
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
/* 182 */
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
/* 183 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


if (true) {
  module.exports = __webpack_require__(316);
} else {}


/***/ }),
/* 184 */
/***/ (function(module, exports, __webpack_require__) {

var has = __webpack_require__(46);
var toIObject = __webpack_require__(81);
var arrayIndexOf = __webpack_require__(125)(false);
var IE_PROTO = __webpack_require__(116)('IE_PROTO');

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
/* 185 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var ControlBaseDataView = __webpack_require__(65),
    ControlSelect2ItemView;

ControlSelect2ItemView = ControlBaseDataView.extend({
  getSelect2Placeholder: function getSelect2Placeholder() {
    return this.ui.select.children('option:first[value=""]').text();
  },
  getSelect2DefaultOptions: function getSelect2DefaultOptions() {
    return {
      allowClear: true,
      placeholder: this.getSelect2Placeholder(),
      dir: elementorCommon.config.isRTL ? 'rtl' : 'ltr'
    };
  },
  getSelect2Options: function getSelect2Options() {
    return jQuery.extend(this.getSelect2DefaultOptions(), this.model.get('select2options'));
  },
  onReady: function onReady() {
    this.ui.select.select2(this.getSelect2Options());
  },
  onBeforeDestroy: function onBeforeDestroy() {
    if (this.ui.select.data('select2')) {
      this.ui.select.select2('destroy');
    }

    this.$el.remove();
  },
  onAfterExternalChange: function onAfterExternalChange() {
    this.ui.select.select2('destroy');
    this.onReady();
    ControlBaseDataView.prototype.onAfterExternalChange.apply(this, arguments);
  }
});
module.exports = ControlSelect2ItemView;

/***/ }),
/* 186 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var ContextMenu = __webpack_require__(268);

module.exports = Marionette.Behavior.extend({
  defaults: {
    groups: [],
    eventTargets: ['el']
  },
  events: function events() {
    var events = {};
    this.getOption('eventTargets').forEach(function (eventTarget) {
      var eventName = 'contextmenu';

      if ('el' !== eventTarget) {
        eventName += ' ' + eventTarget;
      }

      events[eventName] = 'onContextMenu';
    });
    return events;
  },
  initialize: function initialize() {
    this.listenTo(this.view.options.model, 'request:contextmenu', this.onRequestContextMenu);
  },
  initContextMenu: function initContextMenu() {
    var _this = this;

    var contextMenuGroups = this.getOption('groups'),
        deleteGroup = _.findWhere(contextMenuGroups, {
      name: 'delete'
    }),
        afterGroupIndex = contextMenuGroups.indexOf(deleteGroup);

    if (-1 === afterGroupIndex) {
      afterGroupIndex = contextMenuGroups.length;
    }

    contextMenuGroups.splice(afterGroupIndex, 0, {
      name: 'tools',
      actions: [{
        name: 'navigator',
        title: elementor.translate('navigator'),
        callback: function callback() {
          return $e.route('navigator', {
            reOpen: true,
            model: _this.view.model
          });
        }
      }]
    });
    this.contextMenu = new ContextMenu({
      groups: contextMenuGroups
    });
    this.contextMenu.getModal().on('hide', this.onContextMenuHide);
  },
  getContextMenu: function getContextMenu() {
    if (!this.contextMenu) {
      this.initContextMenu();
    }

    return this.contextMenu;
  },
  onContextMenu: function onContextMenu(event) {
    if ($e.shortcuts.isControlEvent(event) || !elementor.userCan('design')) {
      return;
    }

    if ('edit' !== elementor.channels.dataEditMode.request('activeMode')) {
      return;
    }

    event.preventDefault();
    event.stopPropagation();
    this.getContextMenu().show(event);
    elementor.channels.editor.reply('contextMenu:targetView', this.view);
  },
  onRequestContextMenu: function onRequestContextMenu(event) {
    var modal = this.getContextMenu().getModal(),
        iframe = modal.getSettings('iframe'),
        toolsGroup = _.findWhere(this.contextMenu.getSettings('groups'), {
      name: 'tools'
    });

    toolsGroup.isVisible = false;
    modal.setSettings('iframe', null);
    this.onContextMenu(event);
    toolsGroup.isVisible = true;
    modal.setSettings('iframe', iframe);
  },
  onContextMenuHide: function onContextMenuHide() {
    elementor.channels.editor.reply('contextMenu:targetView', null);
  },
  onDestroy: function onDestroy() {
    if (this.contextMenu) {
      this.contextMenu.destroy();
    }
  }
});

/***/ }),
/* 187 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";

// https://github.com/tc39/Array.prototype.includes
var $export = __webpack_require__(29);
var $includes = __webpack_require__(125)(true);

$export($export.P, 'Array', {
  includes: function includes(el /* , fromIndex = 0 */) {
    return $includes(this, el, arguments.length > 1 ? arguments[1] : undefined);
  }
});

__webpack_require__(72)('includes');


/***/ }),
/* 188 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";
// 21.1.3.7 String.prototype.includes(searchString, position = 0)

var $export = __webpack_require__(29);
var context = __webpack_require__(189);
var INCLUDES = 'includes';

$export($export.P + $export.F * __webpack_require__(190)(INCLUDES), 'String', {
  includes: function includes(searchString /* , position = 0 */) {
    return !!~context(this, searchString, INCLUDES)
      .indexOf(searchString, arguments.length > 1 ? arguments[1] : undefined);
  }
});


/***/ }),
/* 189 */
/***/ (function(module, exports, __webpack_require__) {

// helper for String#{startsWith, endsWith, includes}
var isRegExp = __webpack_require__(108);
var defined = __webpack_require__(32);

module.exports = function (that, searchString, NAME) {
  if (isRegExp(searchString)) throw TypeError('String#' + NAME + " doesn't accept regex!");
  return String(defined(that));
};


/***/ }),
/* 190 */
/***/ (function(module, exports, __webpack_require__) {

var MATCH = __webpack_require__(9)('match');
module.exports = function (KEY) {
  var re = /./;
  try {
    '/./'[KEY](re);
  } catch (e) {
    try {
      re[MATCH] = false;
      return !'/./'[KEY](re);
    } catch (f) { /* empty */ }
  } return true;
};


/***/ }),
/* 191 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var _interopRequireDefault = __webpack_require__(0);

var _defineProperty = _interopRequireDefault(__webpack_require__(1));

var _keys = _interopRequireDefault(__webpack_require__(27));

var _helpers = _interopRequireDefault(__webpack_require__(109));

var ControlBaseView;
ControlBaseView = Marionette.CompositeView.extend({
  ui: function ui() {
    return {
      controlTitle: '.elementor-control-title'
    };
  },
  behaviors: function behaviors() {
    var behaviors = {};
    return elementor.hooks.applyFilters('controls/base/behaviors', behaviors, this);
  },
  getBehavior: function getBehavior(name) {
    return this._behaviors[(0, _keys.default)(this.behaviors()).indexOf(name)];
  },
  className: function className() {
    // TODO: Any better classes for that?
    var classes = 'elementor-control elementor-control-' + this.model.get('name') + ' elementor-control-type-' + this.model.get('type'),
        modelClasses = this.model.get('classes'),
        responsive = this.model.get('responsive');

    if (!_.isEmpty(modelClasses)) {
      classes += ' ' + modelClasses;
    }

    if (!_.isEmpty(responsive)) {
      classes += ' elementor-control-responsive-' + responsive.max;
    }

    return classes;
  },
  templateHelpers: function templateHelpers() {
    var controlData = {
      _cid: this.model.cid
    };
    return {
      view: this,
      data: _.extend({}, this.model.toJSON(), controlData)
    };
  },
  getTemplate: function getTemplate() {
    return Marionette.TemplateCache.get('#tmpl-elementor-control-' + this.model.get('type') + '-content');
  },
  initialize: function initialize(options) {
    var label = this.model.get('label'); // TODO: Temp backwards compatibility. since 2.8.0.

    (0, _defineProperty.default)(this, 'container', {
      get: function get() {
        if (!options.container) {
          var settingsModel = options.elementSettingsModel,
              view = _helpers.default.findViewById(settingsModel.id); // Element control.


          if (view && view.getContainer) {
            options.container = view.getContainer();
          } else {
            if (!settingsModel.id) {
              settingsModel.id = 'bc-' + elementor.helpers.getUniqueID();
            } // Document/General/Other control.


            options.container = new elementorModules.editor.Container({
              type: 'bc-container',
              id: settingsModel.id,
              model: settingsModel,
              settings: settingsModel,
              label: label,
              view: false,
              renderer: false,
              controls: settingsModel.options.controls
            });
          }
        }

        return options.container;
      }
    }); // Use `defineProperty` because `get elementSettingsModel()` fails during the `Marionette.CompositeView.extend`.

    (0, _defineProperty.default)(this, 'elementSettingsModel', {
      get: function get() {
        elementorCommon.helpers.softDeprecated('elementSettingsModel', '2.8.0', 'container.settings');
        return options.container ? options.container.settings : options.elementSettingsModel;
      }
    });
    var controlType = this.model.get('type'),
        controlSettings = jQuery.extend(true, {}, elementor.config.controls[controlType], this.model.attributes);
    this.model.set(controlSettings); // TODO: this.elementSettingsModel is deprecated since 2.8.0.

    var settings = this.container ? this.container.settings : this.elementSettingsModel;
    this.listenTo(settings, 'change', this.toggleControlVisibility);
  },
  toggleControlVisibility: function toggleControlVisibility() {
    // TODO: this.elementSettingsModel is deprecated since 2.8.0.
    var settings = this.container ? this.container.settings : this.elementSettingsModel;
    var isVisible = elementor.helpers.isActiveControl(this.model, settings.attributes);
    this.$el.toggleClass('elementor-hidden-control', !isVisible);
    elementor.getPanelView().updateScrollbar();
  },
  onRender: function onRender() {
    var layoutType = this.model.get('label_block') ? 'block' : 'inline',
        showLabel = this.model.get('show_label'),
        elClasses = 'elementor-label-' + layoutType;
    elClasses += ' elementor-control-separator-' + this.model.get('separator');

    if (!showLabel) {
      elClasses += ' elementor-control-hidden-label';
    }

    this.$el.addClass(elClasses);
    this.toggleControlVisibility();
  }
});
module.exports = ControlBaseView;

/***/ }),
/* 192 */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(209);

/***/ }),
/* 193 */
/***/ (function(module, exports, __webpack_require__) {

var $iterators = __webpack_require__(160);
var getKeys = __webpack_require__(176);
var redefine = __webpack_require__(31);
var global = __webpack_require__(13);
var hide = __webpack_require__(25);
var Iterators = __webpack_require__(124);
var wks = __webpack_require__(9);
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
/* 194 */
/***/ (function(module, exports, __webpack_require__) {

// 19.1.2.2 / 15.2.3.5 Object.create(O [, Properties])
var anObject = __webpack_require__(19);
var dPs = __webpack_require__(215);
var enumBugKeys = __webpack_require__(126);
var IE_PROTO = __webpack_require__(116)('IE_PROTO');
var Empty = function () { /* empty */ };
var PROTOTYPE = 'prototype';

// Create object with fake `null` prototype: use iframe Object with cleared prototype
var createDict = function () {
  // Thrash, waste and sodomy: IE GC bug
  var iframe = __webpack_require__(87)('iframe');
  var i = enumBugKeys.length;
  var lt = '<';
  var gt = '>';
  var iframeDocument;
  iframe.style.display = 'none';
  __webpack_require__(216).appendChild(iframe);
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
/* 195 */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(196);
module.exports = __webpack_require__(7).parseInt;


/***/ }),
/* 196 */
/***/ (function(module, exports, __webpack_require__) {

var $export = __webpack_require__(8);
var $parseInt = __webpack_require__(197);
// 18.2.5 parseInt(string, radix)
$export($export.G + $export.F * (parseInt != $parseInt), { parseInt: $parseInt });


/***/ }),
/* 197 */
/***/ (function(module, exports, __webpack_require__) {

var $parseInt = __webpack_require__(10).parseInt;
var $trim = __webpack_require__(198).trim;
var ws = __webpack_require__(157);
var hex = /^[-+]?0[xX]/;

module.exports = $parseInt(ws + '08') !== 8 || $parseInt(ws + '0x16') !== 22 ? function parseInt(str, radix) {
  var string = $trim(String(str), 3);
  return $parseInt(string, (radix >>> 0) || (hex.test(string) ? 16 : 10));
} : $parseInt;


/***/ }),
/* 198 */
/***/ (function(module, exports, __webpack_require__) {

var $export = __webpack_require__(8);
var defined = __webpack_require__(49);
var fails = __webpack_require__(23);
var spaces = __webpack_require__(157);
var space = '[' + spaces + ']';
var non = '\u200b\u0085';
var ltrim = RegExp('^' + space + space + '*');
var rtrim = RegExp(space + space + '*$');

var exporter = function (KEY, exec, ALIAS) {
  var exp = {};
  var FORCE = fails(function () {
    return !!spaces[KEY]() || non[KEY]() != non;
  });
  var fn = exp[KEY] = FORCE ? exec(trim) : spaces[KEY];
  if (ALIAS) exp[ALIAS] = fn;
  $export($export.P + $export.F * FORCE, 'String', exp);
};

// 1 -> String#trimLeft
// 2 -> String#trimRight
// 3 -> String#trim
var trim = exporter.trim = function (string, TYPE) {
  string = String(defined(string));
  if (TYPE & 1) string = string.replace(ltrim, '');
  if (TYPE & 2) string = string.replace(rtrim, '');
  return string;
};

module.exports = exporter;


/***/ }),
/* 199 */
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

var _possibleConstructorReturn2 = _interopRequireDefault(__webpack_require__(5));

var _getPrototypeOf2 = _interopRequireDefault(__webpack_require__(4));

var _get2 = _interopRequireDefault(__webpack_require__(28));

var _inherits2 = _interopRequireDefault(__webpack_require__(6));

var _component = _interopRequireDefault(__webpack_require__(64));

var ComponentModal =
/*#__PURE__*/
function (_BaseComponent) {
  (0, _inherits2.default)(ComponentModal, _BaseComponent);

  function ComponentModal() {
    (0, _classCallCheck2.default)(this, ComponentModal);
    return (0, _possibleConstructorReturn2.default)(this, (0, _getPrototypeOf2.default)(ComponentModal).apply(this, arguments));
  }

  (0, _createClass2.default)(ComponentModal, [{
    key: "onInit",
    value: function onInit() {
      var _this = this;

      (0, _get2.default)((0, _getPrototypeOf2.default)(ComponentModal.prototype), "onInit", this).call(this);
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
      if (!(0, _get2.default)((0, _getPrototypeOf2.default)(ComponentModal.prototype), "close", this).call(this)) {
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
  return ComponentModal;
}(_component.default);

exports.default = ComponentModal;

/***/ }),
/* 200 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var _interopRequireDefault = __webpack_require__(0);

__webpack_require__(15);

__webpack_require__(30);

var _isArray = _interopRequireDefault(__webpack_require__(119));

var _typeof2 = _interopRequireDefault(__webpack_require__(47));

var _parseInt2 = _interopRequireDefault(__webpack_require__(174));

var _keys = _interopRequireDefault(__webpack_require__(27));

var _environment = _interopRequireDefault(__webpack_require__(182));

var _helpers = _interopRequireDefault(__webpack_require__(109));

var ControlsCSSParser = __webpack_require__(222),
    Validator = __webpack_require__(203),
    BaseContainer = __webpack_require__(241),
    BaseElementView;

BaseElementView = BaseContainer.extend({
  tagName: 'div',
  controlsCSSParser: null,
  allowRender: true,
  toggleEditTools: false,
  renderAttributes: {},
  className: function className() {
    var classes = 'elementor-element elementor-element-edit-mode ' + this.getElementUniqueID();

    if (this.toggleEditTools) {
      classes += ' elementor-element--toggle-edit-tools';
    }

    return classes;
  },
  attributes: function attributes() {
    return {
      'data-id': this.getID(),
      'data-element_type': this.model.get('elType')
    };
  },
  ui: function ui() {
    return {
      tools: '> .elementor-element-overlay > .elementor-editor-element-settings',
      editButton: '> .elementor-element-overlay .elementor-editor-element-edit',
      duplicateButton: '> .elementor-element-overlay .elementor-editor-element-duplicate',
      addButton: '> .elementor-element-overlay .elementor-editor-element-add',
      removeButton: '> .elementor-element-overlay .elementor-editor-element-remove'
    };
  },
  behaviors: function behaviors() {
    var groups = elementor.hooks.applyFilters('elements/' + this.options.model.get('elType') + '/contextMenuGroups', this.getContextMenuGroups(), this);
    var behaviors = {
      contextMenu: {
        behaviorClass: __webpack_require__(186),
        groups: groups
      }
    };
    return elementor.hooks.applyFilters('elements/base/behaviors', behaviors, this);
  },
  getBehavior: function getBehavior(name) {
    return this._behaviors[(0, _keys.default)(this.behaviors()).indexOf(name)];
  },
  events: function events() {
    return {
      mousedown: 'onMouseDown',
      'click @ui.editButton': 'onEditButtonClick',
      'click @ui.duplicateButton': 'onDuplicateButtonClick',
      'click @ui.addButton': 'onAddButtonClick',
      'click @ui.removeButton': 'onRemoveButtonClick'
    };
  },
  getElementType: function getElementType() {
    return this.model.get('elType');
  },
  getIDInt: function getIDInt() {
    return (0, _parseInt2.default)(this.getID(), 16);
  },
  getChildType: function getChildType() {
    return elementor.helpers.getElementChildType(this.getElementType());
  },
  getChildView: function getChildView(model) {
    var ChildView;
    var elType = model.get('elType');

    if ('section' === elType) {
      ChildView = __webpack_require__(178);
    } else if ('column' === elType) {
      ChildView = __webpack_require__(270);
    } else {
      ChildView = elementor.modules.elements.views.Widget;
    }

    return elementor.hooks.applyFilters('element/view', ChildView, model, this);
  },
  getTemplateType: function getTemplateType() {
    return 'js';
  },
  getEditModel: function getEditModel() {
    return this.model;
  },
  getContainer: function getContainer() {
    if (!this.container) {
      var settingsModel = this.model.get('settings');
      this.container = new elementorModules.editor.Container({
        type: this.model.get('elType'),
        id: this.model.id,
        model: this.model,
        settings: settingsModel,
        view: this,
        parent: this._parent.getContainer() || {},
        children: [],
        label: elementor.helpers.getModelLabel(this.model),
        controls: settingsModel.options.controls
      });
    }

    return this.container;
  },
  getContextMenuGroups: function getContextMenuGroups() {
    var _this = this;

    var controlSign = _environment.default.mac ? '⌘' : '^';
    return [{
      name: 'general',
      actions: [{
        name: 'edit',
        icon: 'eicon-edit',
        title: elementor.translate('edit_element', [this.options.model.getTitle()]),
        callback: function callback() {
          return $e.run('panel/editor/open', {
            model: _this.options.model,
            // Todo: remove on merge router
            view: _this,
            // Todo: remove on merge router
            container: _this.getContainer()
          });
        }
      }, {
        name: 'duplicate',
        icon: 'eicon-clone',
        title: elementor.translate('duplicate'),
        shortcut: controlSign + '+D',
        callback: function callback() {
          return $e.run('document/elements/duplicate', {
            container: _this.getContainer()
          });
        }
      }]
    }, {
      name: 'clipboard',
      actions: [{
        name: 'copy',
        title: elementor.translate('copy'),
        shortcut: controlSign + '+C',
        callback: function callback() {
          return $e.run('document/elements/copy', {
            container: _this.getContainer()
          });
        }
      }, {
        name: 'paste',
        title: elementor.translate('paste'),
        shortcut: controlSign + '+V',
        isEnabled: function isEnabled() {
          return _helpers.default.isPasteEnabled(_this.getContainer());
        },
        callback: function callback() {
          return $e.run('document/ui/paste', {
            container: _this.getContainer()
          });
        }
      }, {
        name: 'pasteStyle',
        title: elementor.translate('paste_style'),
        shortcut: controlSign + '+⇧+V',
        isEnabled: function isEnabled() {
          return !!elementorCommon.storage.get('clipboard');
        },
        callback: function callback() {
          return $e.run('document/elements/paste-style', {
            container: _this.getContainer()
          });
        }
      }, {
        name: 'resetStyle',
        title: elementor.translate('reset_style'),
        callback: function callback() {
          return $e.run('document/elements/reset-style', {
            container: _this.getContainer()
          });
        }
      }]
    }, {
      name: 'delete',
      actions: [{
        name: 'delete',
        icon: 'eicon-trash',
        title: elementor.translate('delete'),
        shortcut: '⌦',
        callback: function callback() {
          return $e.run('document/elements/delete', {
            container: _this.getContainer()
          });
        }
      }]
    }];
  },
  getEditButtons: function getEditButtons() {
    return {};
  },
  initialize: function initialize() {
    BaseContainer.prototype.initialize.apply(this, arguments);
    var editModel = this.getEditModel();

    if (this.collection && this.onCollectionChanged) {
      elementorCommon.helpers.softDeprecated('onCollectionChanged', '2.8.0', '$e.events || $e.hooks');
      this.listenTo(this.collection, 'add remove reset', this.onCollectionChanged, this);
    }

    if (this.onSettingsChanged) {
      elementorCommon.helpers.softDeprecated('onSettingsChanged', '2.8.0', '$e.events || $e.hooks');
      this.listenTo(editModel.get('settings'), 'change', this.onSettingsChanged);
    }

    this.listenTo(editModel.get('editSettings'), 'change', this.onEditSettingsChanged).listenTo(this.model, 'request:edit', this.onEditRequest).listenTo(this.model, 'request:toggleVisibility', this.toggleVisibility);
    this.initControlsCSSParser();
  },
  getHandlesOverlay: function getHandlesOverlay() {
    var $handlesOverlay = jQuery('<div>', {
      class: 'elementor-element-overlay'
    }),
        $overlayList = jQuery('<ul>', {
      class: "elementor-editor-element-settings elementor-editor-".concat(this.getElementType(), "-settings")
    });
    jQuery.each(this.getEditButtons(), function (toolName, tool) {
      var $item = jQuery('<li>', {
        class: "elementor-editor-element-setting elementor-editor-element-".concat(toolName),
        title: tool.title
      }),
          $icon = jQuery('<i>', {
        class: "eicon-".concat(tool.icon),
        'aria-hidden': true
      }),
          $a11y = jQuery('<span>', {
        class: 'elementor-screen-only'
      });
      $a11y.text(tool.title);
      $item.append($icon, $a11y);
      $overlayList.append($item);
    });
    $handlesOverlay.append($overlayList);
    return $handlesOverlay;
  },
  attachElContent: function attachElContent(html) {
    this.$el.empty().append(this.getHandlesOverlay(), html);
  },
  startTransport: function startTransport() {
    elementorCommon.helpers.softDeprecated('element.startTransport', '2.8.0', "$e.run( 'document/elements/copy' )");
    $e.run('document/elements/copy', {
      container: this.getContainer()
    });
  },
  copy: function copy() {
    elementorCommon.helpers.softDeprecated('element.copy', '2.8.0', "$e.run( 'document/elements/copy' )");
    $e.run('document/elements/copy', {
      container: this.getContainer()
    });
  },
  cut: function cut() {
    elementorCommon.helpers.softDeprecated('element.cut', '2.8.0');
  },
  paste: function paste() {
    elementorCommon.helpers.softDeprecated('element.paste', '2.8.0', "$e.run( 'document/elements/paste' )");
    $e.run('document/elements/paste', {
      container: this.getContainer(),
      at: this._parent.collection.indexOf(this.model)
    });
  },
  duplicate: function duplicate() {
    elementorCommon.helpers.softDeprecated('element.duplicate', '2.8.0', "$e.run( 'document/elements/duplicate' )");
    $e.run('document/elements/duplicate', {
      container: this.getContainer()
    });
  },
  pasteStyle: function pasteStyle() {
    elementorCommon.helpers.softDeprecated('element.pasteStyle', '2.8.0', "$e.run( 'document/elements/paste-style' )");
    $e.run('document/elements/paste-style', {
      container: this.getContainer()
    });
  },
  resetStyle: function resetStyle() {
    elementorCommon.helpers.softDeprecated('element.resetStyle', '2.8.0', "$e.run( 'document/elements/reset-style' )");
    $e.run('document/elements/reset-style', {
      container: this.getContainer()
    });
  },
  isStyleTransferControl: function isStyleTransferControl(control) {
    if (undefined !== control.style_transfer) {
      return control.style_transfer;
    }

    return 'content' !== control.tab || control.selectors || control.prefix_class;
  },
  toggleVisibility: function toggleVisibility() {
    this.model.set('hidden', !this.model.get('hidden'));
    this.toggleVisibilityClass();
  },
  toggleVisibilityClass: function toggleVisibilityClass() {
    this.$el.toggleClass('elementor-edit-hidden', !!this.model.get('hidden'));
  },
  addElementFromPanel: function addElementFromPanel(options) {
    options = options || {};
    var elementView = elementor.channels.panelElements.request('element:selected'),
        model = {
      elType: elementView.model.get('elType')
    };

    if (elementor.helpers.maybeDisableWidget()) {
      return;
    }

    if ('widget' === model.elType) {
      model.widgetType = elementView.model.get('widgetType');
    } else if ('section' === model.elType) {
      model.isInner = true;
    } else {
      return;
    }

    var customData = elementView.model.get('custom');

    if (customData) {
      jQuery.extend(model, customData);
    }

    return $e.run('document/elements/create', {
      container: this.getContainer(),
      model: model,
      options: options
    });
  },
  // TODO: Unused function.
  addControlValidator: function addControlValidator(controlName, validationCallback) {
    validationCallback = validationCallback.bind(this);
    var validator = new Validator({
      customValidationMethod: validationCallback
    }),
        validators = this.getEditModel().get('settings').validators;

    if (!validators[controlName]) {
      validators[controlName] = [];
    }

    validators[controlName].push(validator);
  },
  addRenderAttribute: function addRenderAttribute(element, key, value, overwrite) {
    var self = this;

    if ('object' === (0, _typeof2.default)(element)) {
      jQuery.each(element, function (elementKey, elementValue) {
        self.addRenderAttribute(elementKey, elementValue, null, overwrite);
      });
      return self;
    }

    if ('object' === (0, _typeof2.default)(key)) {
      jQuery.each(key, function (attributeKey, attributeValue) {
        self.addRenderAttribute(element, attributeKey, attributeValue, overwrite);
      });
      return self;
    }

    if (!self.renderAttributes[element]) {
      self.renderAttributes[element] = {};
    }

    if (!self.renderAttributes[element][key]) {
      self.renderAttributes[element][key] = [];
    }

    if (!(0, _isArray.default)(value)) {
      value = [value];
    }

    if (overwrite) {
      self.renderAttributes[element][key] = value;
    } else {
      self.renderAttributes[element][key] = self.renderAttributes[element][key].concat(value);
    }
  },
  getRenderAttributeString: function getRenderAttributeString(element) {
    if (!this.renderAttributes[element]) {
      return '';
    }

    var renderAttributes = this.renderAttributes[element],
        attributes = [];
    jQuery.each(renderAttributes, function (attributeKey, attributeValue) {
      attributes.push(attributeKey + '="' + _.escape(attributeValue.join(' ')) + '"');
    });
    return attributes.join(' ');
  },
  isInner: function isInner() {
    return !!this.model.get('isInner');
  },
  initControlsCSSParser: function initControlsCSSParser() {
    this.controlsCSSParser = new ControlsCSSParser({
      id: this.model.cid,
      settingsModel: this.getEditModel().get('settings'),
      dynamicParsing: this.getDynamicParsingSettings()
    });
  },
  enqueueFonts: function enqueueFonts() {
    var editModel = this.getEditModel(),
        settings = editModel.get('settings');
    jQuery.each(settings.getFontControls(), function (index, control) {
      var fontFamilyName = editModel.getSetting(control.name);

      if (!fontFamilyName) {
        return;
      }

      elementor.helpers.enqueueFont(fontFamilyName);
    }); // Enqueue Icon Fonts

    jQuery.each(settings.getIconsControls(), function (index, control) {
      var iconType = editModel.getSetting(control.name);

      if (!iconType || !iconType.library) {
        return;
      }

      elementor.helpers.enqueueIconFonts(iconType.library);
    });
  },
  renderStyles: function renderStyles(settings) {
    if (!settings) {
      settings = this.getEditModel().get('settings');
    }

    this.controlsCSSParser.stylesheet.empty();
    this.controlsCSSParser.addStyleRules(settings.getStyleControls(), settings.attributes, this.getEditModel().get('settings').controls, [/{{ID}}/g, /{{WRAPPER}}/g], [this.getID(), '#elementor .' + this.getElementUniqueID()]);
    this.controlsCSSParser.addStyleToDocument();
    var extraCSS = elementor.hooks.applyFilters('editor/style/styleText', '', this);

    if (extraCSS) {
      this.controlsCSSParser.elements.$stylesheetElement.append(extraCSS);
    }
  },
  renderCustomClasses: function renderCustomClasses() {
    var self = this;
    var settings = self.getEditModel().get('settings'),
        classControls = settings.getClassControls(); // Remove all previous classes

    _.each(classControls, function (control) {
      var previousClassValue = settings.previous(control.name);

      if (control.classes_dictionary) {
        if (undefined !== control.classes_dictionary[previousClassValue]) {
          previousClassValue = control.classes_dictionary[previousClassValue];
        }
      }

      self.$el.removeClass(control.prefix_class + previousClassValue);
    }); // Add new classes


    _.each(classControls, function (control) {
      var value = settings.attributes[control.name];
      var classValue = value;

      if (control.classes_dictionary) {
        if (undefined !== control.classes_dictionary[value]) {
          classValue = control.classes_dictionary[value];
        }
      }

      var isVisible = elementor.helpers.isActiveControl(control, settings.attributes);

      if (isVisible && (classValue || 0 === classValue)) {
        self.$el.addClass(control.prefix_class + classValue);
      }
    });

    self.$el.addClass(_.result(self, 'className'));
    self.toggleVisibilityClass();
  },
  renderCustomElementID: function renderCustomElementID() {
    var customElementID = this.getEditModel().get('settings').get('_element_id');
    this.$el.attr('id', customElementID);
  },
  renderUI: function renderUI() {
    this.renderStyles();
    this.renderCustomClasses();
    this.renderCustomElementID();
    this.enqueueFonts();
  },
  runReadyTrigger: function runReadyTrigger() {
    var self = this;

    _.defer(function () {
      elementorFrontend.elementsHandler.runReadyTrigger(self.el);

      if (!elementorFrontend.isEditMode()) {
        return;
      } // In edit mode - handle an external elements that loaded by another elements like shortcode etc.


      self.$el.find('.elementor-element.elementor-' + self.model.get('elType') + ':not(.elementor-element-edit-mode)').each(function () {
        elementorFrontend.elementsHandler.runReadyTrigger(this);
      });
    });
  },
  getID: function getID() {
    return this.model.get('id');
  },
  getElementUniqueID: function getElementUniqueID() {
    return 'elementor-element-' + this.getID();
  },
  renderHTML: function renderHTML() {
    var templateType = this.getTemplateType(),
        editModel = this.getEditModel();

    if ('js' === templateType) {
      this.getEditModel().setHtmlCache();
      this.render();
      editModel.renderOnLeave = true;
    } else {
      editModel.renderRemoteServer();
    }
  },
  renderOnChange: function renderOnChange(settings) {
    if (!this.allowRender) {
      return;
    } // Make sure is correct model


    if (settings instanceof elementorModules.editor.elements.models.BaseSettings) {
      var hasChanged = settings.hasChanged();
      var isContentChanged = !hasChanged,
          isRenderRequired = !hasChanged;

      _.each(settings.changedAttributes(), function (settingValue, settingKey) {
        var control = settings.getControl(settingKey);

        if ('_column_size' === settingKey) {
          isRenderRequired = true;
          return;
        }

        if (!control) {
          isRenderRequired = true;
          isContentChanged = true;
          return;
        }

        if ('none' !== control.render_type) {
          isRenderRequired = true;
        }

        if (-1 !== ['none', 'ui'].indexOf(control.render_type)) {
          return;
        }

        if ('template' === control.render_type || !settings.isStyleControl(settingKey) && !settings.isClassControl(settingKey) && '_element_id' !== settingKey) {
          isContentChanged = true;
        }
      });

      if (!isRenderRequired) {
        return;
      }

      if (!isContentChanged) {
        this.renderUI();
        return;
      }
    } // Re-render the template


    this.renderHTML();
  },
  getDynamicParsingSettings: function getDynamicParsingSettings() {
    var self = this;
    return {
      onServerRequestStart: function onServerRequestStart() {
        self.$el.addClass('elementor-loading');
      },
      onServerRequestEnd: function onServerRequestEnd() {
        self.render();
        self.$el.removeClass('elementor-loading');
      }
    };
  },
  serializeData: function serializeData() {
    var data = BaseContainer.prototype.serializeData.apply(this, arguments);
    data.settings = this.getEditModel().get('settings').parseDynamicSettings(data.settings, this.getDynamicParsingSettings());
    return data;
  },
  save: function save() {
    $e.route('library/save-template', {
      model: this.model
    });
  },
  onBeforeRender: function onBeforeRender() {
    this.renderAttributes = {};
  },
  onRender: function onRender() {
    this.renderUI();
    this.runReadyTrigger();

    if (this.toggleEditTools) {
      var editButton = this.ui.editButton; // Since this.ui.tools does not exist while testing.

      if (this.ui.tools) {
        this.ui.tools.hoverIntent(function () {
          editButton.addClass('elementor-active');
        }, function () {
          editButton.removeClass('elementor-active');
        }, {
          timeout: 500
        });
      }
    }
  },
  onEditSettingsChanged: function onEditSettingsChanged(changedModel) {
    elementor.channels.editor.trigger('change:editSettings', changedModel, this);
  },
  onEditButtonClick: function onEditButtonClick() {
    this.model.trigger('request:edit');
  },
  onEditRequest: function onEditRequest() {
    var options = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : {};

    if ('edit' !== elementor.channels.dataEditMode.request('activeMode')) {
      return;
    }

    var model = this.getEditModel(),
        panel = elementor.getPanelView();

    if ($e.routes.isPartOf('panel/editor') && panel.getCurrentPageView().model === model) {
      return;
    }

    if (options.scrollIntoView) {
      elementor.helpers.scrollToView(this.$el, 200);
    }

    $e.run('panel/editor/open', {
      model: model,
      view: this
    });
  },
  onDuplicateButtonClick: function onDuplicateButtonClick(event) {
    event.stopPropagation();
    $e.run('document/elements/duplicate', {
      container: this.getContainer()
    });
  },
  onRemoveButtonClick: function onRemoveButtonClick(event) {
    event.stopPropagation();
    $e.run('document/elements/delete', {
      container: this.getContainer()
    });
  },

  /* jQuery ui sortable preventing any `mousedown` event above any element, and as a result is preventing the `blur`
   * event on the currently active element. Therefor, we need to blur the active element manually.
   */
  onMouseDown: function onMouseDown(event) {
    if (jQuery(event.target).closest('.elementor-inline-editing').length) {
      return;
    }

    elementorFrontend.elements.window.document.activeElement.blur();
  },
  onDestroy: function onDestroy() {
    this.controlsCSSParser.removeStyleFromDocument();
    this.getEditModel().get('settings').validators = {};
    elementor.channels.data.trigger('element:destroy', this.model);
  }
});
module.exports = BaseElementView;

/***/ }),
/* 201 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var SortableBehavior;
SortableBehavior = Marionette.Behavior.extend({
  defaults: {
    elChildType: 'widget'
  },
  events: {
    sortstart: 'onSortStart',
    sortreceive: 'onSortReceive',
    sortupdate: 'onSortUpdate',
    sortover: 'onSortOver',
    sortout: 'onSortOut'
  },
  initialize: function initialize() {
    this.listenTo(elementor.channels.dataEditMode, 'switch', this.onEditModeSwitched).listenTo(this.view.options.model, 'request:sort:start', this.startSort).listenTo(this.view.options.model, 'request:sort:update', this.updateSort).listenTo(this.view.options.model, 'request:sort:receive', this.receiveSort);
  },
  onEditModeSwitched: function onEditModeSwitched(activeMode) {
    if ('edit' === activeMode) {
      this.activate();
    } else {
      this.deactivate();
    }
  },
  onRender: function onRender() {
    var self = this;

    _.defer(function () {
      self.onEditModeSwitched(elementor.channels.dataEditMode.request('activeMode'));
    });
  },
  onDestroy: function onDestroy() {
    this.deactivate();
  },
  activate: function activate() {
    if (!elementor.userCan('design')) {
      return;
    }

    if (this.getChildViewContainer().sortable('instance')) {
      return;
    }

    var $childViewContainer = this.getChildViewContainer(),
        defaultSortableOptions = {
      connectWith: $childViewContainer.selector,
      placeholder: 'elementor-sortable-placeholder elementor-' + this.getOption('elChildType') + '-placeholder',
      cursorAt: {
        top: 20,
        left: 25
      },
      helper: this._getSortableHelper.bind(this),
      cancel: 'input, textarea, button, select, option, .elementor-inline-editing, .elementor-tab-title'
    },
        sortableOptions = _.extend(defaultSortableOptions, this.view.getSortableOptions());

    $childViewContainer.sortable(sortableOptions);
  },
  _getSortableHelper: function _getSortableHelper(event, $item) {
    var model = this.view.collection.get({
      cid: $item.data('model-cid')
    });
    return '<div style="height: 84px; width: 125px;" class="elementor-sortable-helper elementor-sortable-helper-' + model.get('elType') + '"><div class="icon"><i class="' + model.getIcon() + '"></i></div><div class="elementor-element-title-wrapper"><div class="title">' + model.getTitle() + '</div></div></div>';
  },
  getChildViewContainer: function getChildViewContainer() {
    return this.view.getChildViewContainer(this.view);
  },
  deactivate: function deactivate() {
    var childViewContainer = this.getChildViewContainer();

    if (childViewContainer.sortable('instance')) {
      childViewContainer.sortable('destroy');
    }
  },
  startSort: function startSort(event, ui) {
    event.stopPropagation();
    var model = this.view.collection.get({
      cid: ui.item.data('model-cid')
    });
    elementor.channels.data.reply('dragging:model', model).reply('dragging:view', this.view.children.findByModel(model)).reply('dragging:parent:view', this.view).trigger('drag:start', model).trigger(model.get('elType') + ':drag:start');
  },
  // Move section.
  updateSort: function updateSort(ui) {
    var at = ui.item.parent().children().index(ui.item);
    $e.run('document/elements/move', {
      container: elementor.channels.data.request('dragging:view').getContainer(),
      target: this.view.getContainer(),
      options: {
        at: at
      }
    });
  },
  // Move Column/Widget.
  receiveSort: function receiveSort(event, ui) {
    event.stopPropagation();

    if (this.view.isCollectionFilled()) {
      jQuery(ui.sender).sortable('cancel');
      return;
    }

    var model = elementor.channels.data.request('dragging:model'),
        draggedElType = model.get('elType'),
        draggedIsInnerSection = 'section' === draggedElType && model.get('isInner'),
        targetIsInnerColumn = 'column' === this.view.getElementType() && this.view.isInner();

    if (draggedIsInnerSection && targetIsInnerColumn) {
      jQuery(ui.sender).sortable('cancel');
      return;
    }

    $e.run('document/elements/move', {
      container: elementor.channels.data.request('dragging:view').getContainer(),
      target: this.view.getContainer(),
      options: {
        at: ui.item.index()
      }
    });
  },
  onSortStart: function onSortStart(event, ui) {
    if ('column' === this.options.elChildType) {
      var uiData = ui.item.data('sortableItem'),
          uiItems = uiData.items,
          itemHeight = 0;
      uiItems.forEach(function (item) {
        if (item.item[0] === ui.item[0]) {
          itemHeight = item.height;
          return false;
        }
      });
      ui.placeholder.height(itemHeight);
    }

    this.startSort(event, ui);
  },
  onSortOver: function onSortOver(event) {
    event.stopPropagation();
    var model = elementor.channels.data.request('dragging:model');
    jQuery(event.target).addClass('elementor-draggable-over').attr({
      'data-dragged-element': model.get('elType'),
      'data-dragged-is-inner': model.get('isInner')
    });
    this.$el.addClass('elementor-dragging-on-child');
  },
  onSortOut: function onSortOut(event) {
    event.stopPropagation();
    jQuery(event.target).removeClass('elementor-draggable-over').removeAttr('data-dragged-element data-dragged-is-inner');
    this.$el.removeClass('elementor-dragging-on-child');
  },
  onSortReceive: function onSortReceive(event, ui) {
    this.receiveSort(event, ui);
  },
  onSortUpdate: function onSortUpdate(event, ui) {
    event.stopPropagation();

    if (this.getChildViewContainer()[0] !== ui.item.parent()[0]) {
      return;
    }

    this.updateSort(ui);
  },
  onAddChild: function onAddChild(view) {
    view.$el.attr('data-model-cid', view.model.cid);
  }
});
module.exports = SortableBehavior;

/***/ }),
/* 202 */,
/* 203 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


module.exports = elementorModules.Module.extend({
  errors: [],
  __construct: function __construct(settings) {
    var customValidationMethod = settings.customValidationMethod;

    if (customValidationMethod) {
      this.validationMethod = customValidationMethod;
    }
  },
  getDefaultSettings: function getDefaultSettings() {
    return {
      validationTerms: {}
    };
  },
  isValid: function isValid() {
    var validationErrors = this.validationMethod.apply(this, arguments);

    if (validationErrors.length) {
      this.errors = validationErrors;
      return false;
    }

    return true;
  },
  validationMethod: function validationMethod(newValue) {
    var validationTerms = this.getSettings('validationTerms'),
        errors = [];

    if (validationTerms.required) {
      if (!('' + newValue).length) {
        errors.push('Required value is empty');
      }
    }

    return errors;
  }
});

/***/ }),
/* 204 */
/***/ (function(module, exports, __webpack_require__) {

/**
 * Copyright (c) 2013-present, Facebook, Inc.
 *
 * This source code is licensed under the MIT license found in the
 * LICENSE file in the root directory of this source tree.
 */

if (false) { var throwOnDirectAccess, ReactIs; } else {
  // By explicitly using `prop-types` you are opting into new production behavior.
  // http://fb.me/prop-types-in-prod
  module.exports = __webpack_require__(328)();
}


/***/ }),
/* 205 */
/***/ (function(module, exports, __webpack_require__) {

var _Array$isArray = __webpack_require__(119);

function _arrayWithHoles(arr) {
  if (_Array$isArray(arr)) return arr;
}

module.exports = _arrayWithHoles;

/***/ }),
/* 206 */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(207);
module.exports = __webpack_require__(7).Array.isArray;


/***/ }),
/* 207 */
/***/ (function(module, exports, __webpack_require__) {

// 22.1.2.2 / 15.4.3.2 Array.isArray(arg)
var $export = __webpack_require__(8);

$export($export.S, 'Array', { isArray: __webpack_require__(102) });


/***/ }),
/* 208 */
/***/ (function(module, exports, __webpack_require__) {

var _getIterator = __webpack_require__(192);

function _iterableToArrayLimit(arr, i) {
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
/* 209 */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(96);
__webpack_require__(82);
module.exports = __webpack_require__(210);


/***/ }),
/* 210 */
/***/ (function(module, exports, __webpack_require__) {

var anObject = __webpack_require__(20);
var get = __webpack_require__(172);
module.exports = __webpack_require__(7).getIterator = function (it) {
  var iterFn = get(it);
  if (typeof iterFn != 'function') throw TypeError(it + ' is not iterable!');
  return anObject(iterFn.call(it));
};


/***/ }),
/* 211 */
/***/ (function(module, exports) {

function _nonIterableRest() {
  throw new TypeError("Invalid attempt to destructure non-iterable instance");
}

module.exports = _nonIterableRest;

/***/ }),
/* 212 */
/***/ (function(module, exports) {

module.exports = function (done, value) {
  return { value: value, done: !!done };
};


/***/ }),
/* 213 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";

var LIBRARY = __webpack_require__(90);
var $export = __webpack_require__(29);
var redefine = __webpack_require__(31);
var hide = __webpack_require__(25);
var Iterators = __webpack_require__(124);
var $iterCreate = __webpack_require__(214);
var setToStringTag = __webpack_require__(177);
var getPrototypeOf = __webpack_require__(217);
var ITERATOR = __webpack_require__(9)('iterator');
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
/* 214 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";

var create = __webpack_require__(194);
var descriptor = __webpack_require__(80);
var setToStringTag = __webpack_require__(177);
var IteratorPrototype = {};

// 25.1.2.1.1 %IteratorPrototype%[@@iterator]()
__webpack_require__(25)(IteratorPrototype, __webpack_require__(9)('iterator'), function () { return this; });

module.exports = function (Constructor, NAME, next) {
  Constructor.prototype = create(IteratorPrototype, { next: descriptor(1, next) });
  setToStringTag(Constructor, NAME + ' Iterator');
};


/***/ }),
/* 215 */
/***/ (function(module, exports, __webpack_require__) {

var dP = __webpack_require__(35);
var anObject = __webpack_require__(19);
var getKeys = __webpack_require__(176);

module.exports = __webpack_require__(21) ? Object.defineProperties : function defineProperties(O, Properties) {
  anObject(O);
  var keys = getKeys(Properties);
  var length = keys.length;
  var i = 0;
  var P;
  while (length > i) dP.f(O, P = keys[i++], Properties[P]);
  return O;
};


/***/ }),
/* 216 */
/***/ (function(module, exports, __webpack_require__) {

var document = __webpack_require__(13).document;
module.exports = document && document.documentElement;


/***/ }),
/* 217 */
/***/ (function(module, exports, __webpack_require__) {

// 19.1.2.9 / 15.2.3.2 Object.getPrototypeOf(O)
var has = __webpack_require__(46);
var toObject = __webpack_require__(54);
var IE_PROTO = __webpack_require__(116)('IE_PROTO');
var ObjectProto = Object.prototype;

module.exports = Object.getPrototypeOf || function (O) {
  O = toObject(O);
  if (has(O, IE_PROTO)) return O[IE_PROTO];
  if (typeof O.constructor == 'function' && O instanceof O.constructor) {
    return O.constructor.prototype;
  } return O instanceof Object ? ObjectProto : null;
};


/***/ }),
/* 218 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";

var fails = __webpack_require__(22);

module.exports = function (method, arg) {
  return !!method && fails(function () {
    // eslint-disable-next-line no-useless-call
    arg ? method.call(null, function () { /* empty */ }, 1) : method.call(null);
  });
};


/***/ }),
/* 219 */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(220);
module.exports = __webpack_require__(7).Object.entries;


/***/ }),
/* 220 */
/***/ (function(module, exports, __webpack_require__) {

// https://github.com/tc39/proposal-object-values-entries
var $export = __webpack_require__(8);
var $entries = __webpack_require__(181)(true);

$export($export.S, 'Object', {
  entries: function entries(it) {
    return $entries(it);
  }
});


/***/ }),
/* 221 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var _interopRequireDefault = __webpack_require__(0);

var _Object$defineProperty = __webpack_require__(1);

_Object$defineProperty(exports, "__esModule", {
  value: true
});

exports.default = void 0;

__webpack_require__(173);

__webpack_require__(99);

var _classCallCheck2 = _interopRequireDefault(__webpack_require__(2));

var _createClass2 = _interopRequireDefault(__webpack_require__(3));

var _possibleConstructorReturn2 = _interopRequireDefault(__webpack_require__(5));

var _getPrototypeOf3 = _interopRequireDefault(__webpack_require__(4));

var _inherits2 = _interopRequireDefault(__webpack_require__(6));

var ColorPicker =
/*#__PURE__*/
function (_elementorModules$Mod) {
  (0, _inherits2.default)(ColorPicker, _elementorModules$Mod);

  function ColorPicker() {
    var _getPrototypeOf2;

    var _this;

    (0, _classCallCheck2.default)(this, ColorPicker);

    for (var _len = arguments.length, args = new Array(_len), _key = 0; _key < _len; _key++) {
      args[_key] = arguments[_key];
    }

    _this = (0, _possibleConstructorReturn2.default)(this, (_getPrototypeOf2 = (0, _getPrototypeOf3.default)(ColorPicker)).call.apply(_getPrototypeOf2, [this].concat(args)));

    _this.createPicker();

    return _this;
  }

  (0, _createClass2.default)(ColorPicker, [{
    key: "getColorPickerPalette",
    value: function getColorPickerPalette() {
      return _.pluck(elementor.schemes.getScheme('color-picker').items, 'value');
    }
  }, {
    key: "getDefaultSettings",
    value: function getDefaultSettings() {
      return {
        picker: {
          theme: 'monolith',
          position: 'bottom-' + (elementorCommon.config.isRTL ? 'end' : 'start'),
          components: {
            opacity: true,
            hue: true,
            interaction: {
              input: true,
              clear: true
            }
          },
          strings: {
            clear: elementor.translate('clear')
          }
        },
        classes: {
          active: 'elementor-active',
          swatchTool: 'elementor-color-picker__swatch-tool',
          swatchPlaceholder: 'elementor-color-picker__swatch-placeholder',
          addSwatch: 'elementor-color-picker__add-swatch',
          droppingArea: 'elementor-color-picker__dropping-area',
          plusIcon: 'eicon-plus',
          trashIcon: 'eicon-trash-o',
          dragToDelete: 'elementor-color-picker__dropping-area__drag-to-delete'
        },
        selectors: {
          swatch: '.pcr-swatch'
        }
      };
    }
  }, {
    key: "createPicker",
    value: function createPicker() {
      var _this2 = this;

      var pickerSettings = this.getSettings('picker');
      pickerSettings.default = pickerSettings.default || null;
      this.picker = new Pickr(pickerSettings);

      if (!pickerSettings.default) {
        // Set a default palette. It doesn't affect the selected value
        this.picker.setColor('#000');
      }

      this.color = this.processColor();
      this.picker.on('change', function () {
        return _this2.onPickerChange();
      }).on('clear', function () {
        return _this2.onPickerClear();
      }).on('show', function () {
        return _this2.onPickerShow();
      });
      this.addPlusButton();
      this.addSwatchDroppingArea();
      this.addToolsToSwatches();
    }
  }, {
    key: "processColor",
    value: function processColor() {
      var color = this.picker.getColor();
      var colorRepresentation;

      if (1 === color.a) {
        colorRepresentation = color.toHEXA();
      } else {
        colorRepresentation = color.toRGBA();
      }

      return colorRepresentation.toString(0);
    }
  }, {
    key: "getColor",
    value: function getColor() {
      return this.color;
    }
  }, {
    key: "getSwatches",
    value: function getSwatches() {
      return jQuery(this.picker.getRoot().swatches);
    }
  }, {
    key: "addSwatch",
    value: function addSwatch(color) {
      this.picker.addSwatch(color);
    }
  }, {
    key: "addSwatches",
    value: function addSwatches() {
      var _this3 = this;

      var settings = this.getSettings();
      this.getSwatches().children(settings.selectors.swatch).remove();
      this.picker._swatchColors = [];
      this.getColorPickerPalette().forEach(function (swatch) {
        return _this3.addSwatch(swatch);
      });
      this.getSwatches().sortable({
        items: '.pcr-swatch',
        placeholder: settings.classes.swatchPlaceholder,
        connectWith: this.$droppingArea,
        delay: 200,
        start: function start() {
          return _this3.onSwatchesSortStart.apply(_this3, arguments);
        },
        stop: function stop() {
          return _this3.onSwatchesSortStop();
        },
        update: function update() {
          return _this3.onSwatchesSortUpdate.apply(_this3, arguments);
        }
      });
      this.addToolsToSwatches();
    }
  }, {
    key: "addPlusButton",
    value: function addPlusButton() {
      var _this4 = this;

      var _this$getSettings = this.getSettings(),
          classes = _this$getSettings.classes;

      this.$addButton = jQuery('<button>', {
        class: classes.swatchTool + ' ' + classes.addSwatch
      }).html(jQuery('<i>', {
        class: classes.plusIcon
      }));
      this.$addButton.on('click', function () {
        return _this4.onAddButtonClick();
      });
      this.$addButton.tipsy({
        title: function title() {
          return elementor.translate('add_picked_color');
        },
        gravity: function gravity() {
          return 's';
        }
      });
    }
  }, {
    key: "addSwatchDroppingArea",
    value: function addSwatchDroppingArea() {
      var _this5 = this;

      var _this$getSettings2 = this.getSettings(),
          classes = _this$getSettings2.classes;

      this.$droppingArea = jQuery('<div>', {
        class: classes.droppingArea
      }).html(jQuery('<i>', {
        class: classes.trashIcon
      }));
      this.getSwatches().after(this.$droppingArea);
      this.$droppingArea.sortable({
        cancel: '.eicon-trash-o',
        placeholder: classes.swatchPlaceholder,
        over: function over() {
          return _this5.onDroppingAreaOver();
        },
        out: function out() {
          return _this5.onDroppingAreaOut();
        }
      });

      if (!this.introductionViewed()) {
        var $dragToDelete = jQuery('<div>', {
          class: classes.dragToDelete
        }).text(elementor.translate('drag_to_delete'));
        this.$droppingArea.append($dragToDelete).slideDown();
        elementorCommon.ajax.addRequest('introduction_viewed', {
          data: {
            introductionKey: 'colorPickerDropping'
          }
        });
        ColorPicker.droppingIntroductionViewed = true;
      }
    }
  }, {
    key: "addToolsToSwatches",
    value: function addToolsToSwatches() {
      this.getSwatches().append(this.$addButton);
      this.picker.activateSwatch();
    }
  }, {
    key: "destroy",
    value: function destroy() {
      this.picker.destroyAndRemove();
    }
  }, {
    key: "fixTipsyForFF",
    value: function fixTipsyForFF($button) {
      // There's a bug in FireFox about hiding the tooltip after the button was clicked,
      // So let's force it to hide
      $button.data('tipsy').hide();
    }
  }, {
    key: "introductionViewed",
    value: function introductionViewed() {
      return ColorPicker.droppingIntroductionViewed || elementor.config.user.introduction.colorPickerDropping;
    }
  }, {
    key: "onPickerChange",
    value: function onPickerChange() {
      this.picker.applyColor();
      var newColor = this.processColor();

      if (newColor === this.color) {
        return;
      }

      this.color = newColor;
      var onChange = this.getSettings('onChange');

      if (onChange) {
        onChange();
      }
    }
  }, {
    key: "onPickerClear",
    value: function onPickerClear() {
      this.color = '';
      var onClear = this.getSettings('onClear');

      if (onClear) {
        onClear();
      }
    }
  }, {
    key: "onPickerShow",
    value: function onPickerShow() {
      var _this6 = this;

      this.addSwatches();
      var resultInput = this.picker.getRoot().interaction.result;
      setTimeout(function () {
        resultInput.select();
        _this6.picker._recalc = true;
      }, 100);
    }
  }, {
    key: "onAddButtonClick",
    value: function onAddButtonClick() {
      this.addSwatch(this.color);
      this.addToolsToSwatches();
      elementor.schemes.addSchemeItem('color-picker', {
        value: this.color
      });
      elementor.schemes.saveScheme('color-picker');
      this.fixTipsyForFF(this.$addButton);
    }
  }, {
    key: "onDroppingAreaOver",
    value: function onDroppingAreaOver() {
      this.$droppingArea.addClass(this.getSettings('classes.active'));
    }
  }, {
    key: "onDroppingAreaOut",
    value: function onDroppingAreaOut() {
      this.$droppingArea.removeClass(this.getSettings('classes.active'));
    }
  }, {
    key: "onSwatchesSortStart",
    value: function onSwatchesSortStart(event) {
      var _this7 = this;

      this.sortedSwatchIndex = jQuery(event.srcElement).index();
      this.$droppingArea.slideDown(function () {
        return _this7.$droppingArea.sortable('refresh');
      });
    }
  }, {
    key: "onSwatchesSortStop",
    value: function onSwatchesSortStop() {
      this.$droppingArea.slideUp();
    }
  }, {
    key: "onSwatchesSortUpdate",
    value: function onSwatchesSortUpdate(event) {
      // Sample the scheme before removing
      var sortedScheme = elementor.schemes.getSchemeValue('color-picker', this.sortedSwatchIndex + 1);
      elementor.schemes.removeSchemeItem('color-picker', this.sortedSwatchIndex);
      var $sortedSwatch = jQuery(event.srcElement);

      if ($sortedSwatch.parent().is(this.$droppingArea)) {
        this.picker._swatchColors.splice(this.sortedSwatchIndex, 1);

        $sortedSwatch.remove();
      } else {
        elementor.schemes.addSchemeItem('color-picker', sortedScheme, $sortedSwatch.index());
      }

      elementor.schemes.saveScheme('color-picker');
    }
  }]);
  return ColorPicker;
}(elementorModules.Module);

exports.default = ColorPicker;

/***/ }),
/* 222 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var _interopRequireDefault = __webpack_require__(0);

var _keys = _interopRequireDefault(__webpack_require__(27));

__webpack_require__(239);

__webpack_require__(85);

__webpack_require__(48);

__webpack_require__(15);

__webpack_require__(30);

var Stylesheet = __webpack_require__(240),
    ControlsCSSParser;

ControlsCSSParser = elementorModules.ViewModule.extend({
  stylesheet: null,
  getDefaultSettings: function getDefaultSettings() {
    return {
      id: 0,
      settingsModel: null,
      dynamicParsing: {}
    };
  },
  getDefaultElements: function getDefaultElements() {
    return {
      $stylesheetElement: jQuery('<style>', {
        id: 'elementor-style-' + this.getSettings('id')
      })
    };
  },
  initStylesheet: function initStylesheet() {
    var breakpoints = elementorFrontend.config.breakpoints;
    this.stylesheet = new Stylesheet();
    this.stylesheet.addDevice('mobile', 0).addDevice('tablet', breakpoints.md).addDevice('desktop', breakpoints.lg);
  },
  addStyleRules: function addStyleRules(styleControls, values, controls, placeholders, replacements) {
    var self = this,
        dynamicParsedValues = self.getSettings('settingsModel').parseDynamicSettings(values, self.getSettings('dynamicParsing'), styleControls);

    _.each(styleControls, function (control) {
      if (control.styleFields && control.styleFields.length) {
        self.addRepeaterControlsStyleRules(values[control.name], control.styleFields, controls, placeholders, replacements);
      }

      if (control.dynamic && control.dynamic.active && values.__dynamic__ && values.__dynamic__[control.name]) {
        self.addDynamicControlStyleRules(values.__dynamic__[control.name], control);
      }

      if (!control.selectors) {
        return;
      }

      self.addControlStyleRules(control, dynamicParsedValues, controls, placeholders, replacements);
    });
  },
  addControlStyleRules: function addControlStyleRules(control, values, controls, placeholders, replacements) {
    var _this = this;

    ControlsCSSParser.addControlStyleRules(this.stylesheet, control, controls, function (StyleControl) {
      return _this.getStyleControlValue(StyleControl, values);
    }, placeholders, replacements);
  },
  getStyleControlValue: function getStyleControlValue(control, values) {
    var value = values[control.name];

    if (control.selectors_dictionary) {
      value = control.selectors_dictionary[value] || value;
    }

    if (!_.isNumber(value) && _.isEmpty(value)) {
      return;
    }

    return value;
  },
  addRepeaterControlsStyleRules: function addRepeaterControlsStyleRules(repeaterValues, repeaterControlsItems, controls, placeholders, replacements) {
    var self = this;
    repeaterControlsItems.forEach(function (item, index) {
      var itemModel = repeaterValues.models[index];
      self.addStyleRules(item, itemModel.attributes, controls, placeholders.concat(['{{CURRENT_ITEM}}']), replacements.concat(['.elementor-repeater-item-' + itemModel.get('_id')]));
    });
  },
  addDynamicControlStyleRules: function addDynamicControlStyleRules(value, control) {
    var self = this;
    elementor.dynamicTags.parseTagsText(value, control.dynamic, function (id, name, settings) {
      var tag = elementor.dynamicTags.createTag(id, name, settings);

      if (!tag) {
        return;
      }

      var tagSettingsModel = tag.model,
          styleControls = tagSettingsModel.getStyleControls();

      if (!styleControls.length) {
        return;
      }

      self.addStyleRules(tagSettingsModel.getStyleControls(), tagSettingsModel.attributes, tagSettingsModel.controls, ['{{WRAPPER}}'], ['#elementor-tag-' + id]);
    });
  },
  addStyleToDocument: function addStyleToDocument() {
    elementor.$previewContents.find('head').append(this.elements.$stylesheetElement);
    this.elements.$stylesheetElement.text(this.stylesheet);
  },
  removeStyleFromDocument: function removeStyleFromDocument() {
    this.elements.$stylesheetElement.remove();
  },
  onInit: function onInit() {
    elementorModules.ViewModule.prototype.onInit.apply(this, arguments);
    this.initStylesheet();
  }
});

ControlsCSSParser.addControlStyleRules = function (stylesheet, control, controls, valueCallback, placeholders, replacements) {
  var value = valueCallback(control);

  if (undefined === value) {
    return;
  }

  _.each(control.selectors, function (cssProperty, selector) {
    var outputCssProperty;

    try {
      outputCssProperty = cssProperty.replace(/{{(?:([^.}]+)\.)?([^}| ]*)(?: *\|\| *(?:([^.}]+)\.)?([^}| ]*) *)*}}/g, function (originalPhrase, controlName, placeholder, fallbackControlName, fallbackValue) {
        var externalControlMissing = controlName && !controls[controlName];
        var parsedValue = '';

        if (!externalControlMissing) {
          parsedValue = ControlsCSSParser.parsePropertyPlaceholder(control, value, controls, valueCallback, placeholder, controlName);
        }

        if (!parsedValue && 0 !== parsedValue) {
          if (fallbackValue) {
            parsedValue = fallbackValue;
            var stringValueMatches = parsedValue.match(/^(['"])(.*)\1$/);

            if (stringValueMatches) {
              parsedValue = stringValueMatches[2];
            } else if (!isFinite(parsedValue)) {
              if (fallbackControlName && !controls[fallbackControlName]) {
                return '';
              }

              parsedValue = ControlsCSSParser.parsePropertyPlaceholder(control, value, controls, valueCallback, fallbackValue, fallbackControlName);
            }
          }

          if (!parsedValue && 0 !== parsedValue) {
            if (externalControlMissing) {
              return '';
            }

            throw '';
          }
        }

        return parsedValue;
      });
    } catch (e) {
      return;
    }

    if (_.isEmpty(outputCssProperty)) {
      return;
    }

    var devicePattern = /^(?:\([^)]+\)){1,2}/,
        deviceRules = selector.match(devicePattern),
        query = {};

    if (deviceRules) {
      deviceRules = deviceRules[0];
      selector = selector.replace(devicePattern, '');
      var pureDevicePattern = /\(([^)]+)\)/g,
          pureDeviceRules = [],
          matches;
      matches = pureDevicePattern.exec(deviceRules);

      while (matches) {
        pureDeviceRules.push(matches[1]);
        matches = pureDevicePattern.exec(deviceRules);
      }

      _.each(pureDeviceRules, function (deviceRule) {
        if ('desktop' === deviceRule) {
          return;
        }

        var device = deviceRule.replace(/\+$/, ''),
            endPoint = device === deviceRule ? 'max' : 'min';
        query[endPoint] = device;
      });
    }

    _.each(placeholders, function (placeholder, index) {
      // Check if it's a RegExp
      var regexp = placeholder.source ? placeholder.source : placeholder,
          placeholderPattern = new RegExp(regexp, 'g');
      selector = selector.replace(placeholderPattern, replacements[index]);
    });

    if (!(0, _keys.default)(query).length && control.responsive) {
      query = _.pick(elementorCommon.helpers.cloneObject(control.responsive), ['min', 'max']);

      if ('desktop' === query.max) {
        delete query.max;
      }
    }

    stylesheet.addRules(selector, outputCssProperty, query);
  });
};

ControlsCSSParser.parsePropertyPlaceholder = function (control, value, controls, valueCallback, placeholder, parserControlName) {
  if (parserControlName) {
    control = _.findWhere(controls, {
      name: parserControlName
    });
    value = valueCallback(control);
  }

  return elementor.getControlView(control.type).getStyleValue(placeholder, value, control);
};

module.exports = ControlsCSSParser;

/***/ }),
/* 223 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var ControlsCSSParser = __webpack_require__(222);

module.exports = elementorModules.ViewModule.extend({
  model: null,
  hasChange: false,
  changeCallbacks: {},
  addChangeCallback: function addChangeCallback(attribute, callback) {
    this.changeCallbacks[attribute] = callback;
  },
  bindEvents: function bindEvents() {
    elementor.on('preview:loaded', this.onElementorPreviewLoaded);
    this.model.on('change', this.onModelChange);
  },
  addPanelPage: function addPanelPage() {
    var name = this.getSettings('name');
    elementor.getPanelView().addPage(name + '_settings', {
      view: elementor.settings.panelPages[name] || elementor.settings.panelPages.base,
      title: this.getSettings('panelPage.title'),
      options: {
        editedView: this.getEditedView(),
        model: this.model,
        controls: this.model.controls,
        name: name
      }
    });
  },
  getContainerId: function getContainerId() {
    return this.getSettings('name') + '_settings';
  },
  // Emulate an element view/model structure with the parts needed for a container.
  getEditedView: function getEditedView() {
    var id = this.getContainerId(),
        editModel = new Backbone.Model({
      id: id,
      elType: id,
      settings: this.model
    });
    var container = new elementorModules.editor.Container({
      type: id,
      id: editModel.id,
      model: editModel,
      settings: editModel.get('settings'),
      view: false,
      label: this.getSettings('panelPage').title,
      controls: this.model.controls,
      renderer: false
    });
    return {
      getContainer: function getContainer() {
        return container;
      },
      getEditModel: function getEditModel() {
        return editModel;
      },
      model: editModel
    };
  },
  updateStylesheet: function updateStylesheet(keepOldEntries) {
    var controlsCSS = this.getControlsCSS();

    if (!keepOldEntries) {
      controlsCSS.stylesheet.empty();
    }

    controlsCSS.addStyleRules(this.model.getStyleControls(), this.model.attributes, this.model.controls, [/{{WRAPPER}}/g], [this.getSettings('cssWrapperSelector')]);
    controlsCSS.addStyleToDocument();
  },
  initModel: function initModel() {
    this.model = new elementorModules.editor.elements.models.BaseSettings(this.getSettings('settings'), {
      controls: this.getSettings('controls')
    });
  },
  initControlsCSSParser: function initControlsCSSParser() {
    var controlsCSS;

    this.getControlsCSS = function () {
      if (!controlsCSS) {
        controlsCSS = new ControlsCSSParser({
          id: this.getSettings('name'),
          settingsModel: this.model
        });
      }

      return controlsCSS;
    };
  },
  getDataToSave: function getDataToSave(data) {
    return data;
  },
  save: function save(callback) {
    var self = this;

    if (!self.hasChange) {
      return;
    }

    var settings = this.model.toJSON({
      remove: ['default']
    }),
        data = this.getDataToSave({
      data: settings
    });

    if (!elementorCommonConfig.isTesting) {
      NProgress.start();
    }

    elementorCommon.ajax.addRequest('save_' + this.getSettings('name') + '_settings', {
      data: data,
      success: function success() {
        if (!elementorCommonConfig.isTesting) {
          NProgress.done();
        }

        self.setSettings('settings', settings);
        self.hasChange = false;

        if (callback) {
          callback.apply(self, arguments);
        }
      },
      error: function error() {
        alert('An error occurred');
      }
    });
  },
  onInit: function onInit() {
    this.initModel();
    this.initControlsCSSParser();
    this.addPanelMenuItem();
    this.debounceSave = _.debounce(this.save, 3000);
    elementorModules.ViewModule.prototype.onInit.apply(this, arguments);
  },

  /**
   * BC for custom settings without a JS component.
   */
  addPanelMenuItem: function addPanelMenuItem() {
    var menuSettings = this.getSettings('panelPage.menu');

    if (!menuSettings) {
      return;
    }

    var namespace = 'panel/' + this.getSettings('name') + '-settings',
        menuItemOptions = {
      icon: menuSettings.icon,
      title: this.getSettings('panelPage.title'),
      type: 'page',
      pageName: this.getSettings('name') + '_settings',
      callback: function callback() {
        return $e.route("".concat(namespace, "/settings"));
      }
    };
    $e.bc.ensureTab(namespace, 'settings', menuItemOptions.pageName);
    elementor.modules.layouts.panel.pages.menu.Menu.addItem(menuItemOptions, 'settings', menuSettings.beforeItem);
  },
  onModelChange: function onModelChange(model) {
    var self = this;
    self.hasChange = true;
    this.getControlsCSS().stylesheet.empty();

    _.each(model.changed, function (value, key) {
      if (self.changeCallbacks[key]) {
        self.changeCallbacks[key].call(self, value);
      }
    });

    self.updateStylesheet(true);
    self.debounceSave();
  },
  onElementorPreviewLoaded: function onElementorPreviewLoaded() {
    this.updateStylesheet();
    this.addPanelPage();

    if (!elementor.userCan('design')) {
      $e.route('panel/page-settings/settings');
    }
  }
});

/***/ }),
/* 224 */,
/* 225 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var anObject = __webpack_require__(19);
var sameValue = __webpack_require__(247);
var regExpExec = __webpack_require__(78);

// @@search logic
__webpack_require__(79)('search', 1, function (defined, SEARCH, $search, maybeCallNative) {
  return [
    // `String.prototype.search` method
    // https://tc39.github.io/ecma262/#sec-string.prototype.search
    function search(regexp) {
      var O = defined(this);
      var fn = regexp == undefined ? undefined : regexp[SEARCH];
      return fn !== undefined ? fn.call(regexp, O) : new RegExp(regexp)[SEARCH](String(O));
    },
    // `RegExp.prototype[@@search]` method
    // https://tc39.github.io/ecma262/#sec-regexp.prototype-@@search
    function (regexp) {
      var res = maybeCallNative($search, regexp, this);
      if (res.done) return res.value;
      var rx = anObject(regexp);
      var S = String(this);
      var previousLastIndex = rx.lastIndex;
      if (!sameValue(previousLastIndex, 0)) rx.lastIndex = 0;
      var result = regExpExec(rx, S);
      if (!sameValue(rx.lastIndex, previousLastIndex)) rx.lastIndex = previousLastIndex;
      return result === null ? -1 : result.index;
    }
  ];
});


/***/ }),
/* 226 */,
/* 227 */
/***/ (function(module, exports, __webpack_require__) {

var core = __webpack_require__(7);
var $JSON = core.JSON || (core.JSON = { stringify: JSON.stringify });
module.exports = function stringify(it) { // eslint-disable-line no-unused-vars
  return $JSON.stringify.apply($JSON, arguments);
};


/***/ }),
/* 228 */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(229);
module.exports = __webpack_require__(7).Object.values;


/***/ }),
/* 229 */
/***/ (function(module, exports, __webpack_require__) {

// https://github.com/tc39/proposal-object-values-entries
var $export = __webpack_require__(8);
var $values = __webpack_require__(181)(false);

$export($export.S, 'Object', {
  values: function values(it) {
    return $values(it);
  }
});


/***/ }),
/* 230 */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(231);
module.exports = __webpack_require__(7).Object.assign;


/***/ }),
/* 231 */
/***/ (function(module, exports, __webpack_require__) {

// 19.1.3.1 Object.assign(target, source)
var $export = __webpack_require__(8);

$export($export.S + $export.F, 'Object', { assign: __webpack_require__(232) });


/***/ }),
/* 232 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";

// 19.1.2.1 Object.assign(target, source, ...)
var DESCRIPTORS = __webpack_require__(11);
var getKeys = __webpack_require__(33);
var gOPS = __webpack_require__(73);
var pIE = __webpack_require__(43);
var toObject = __webpack_require__(34);
var IObject = __webpack_require__(106);
var $assign = Object.assign;

// should work with symbols and should have deterministic property order (V8 bug)
module.exports = !$assign || __webpack_require__(23)(function () {
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
/* 233 */
/***/ (function(module, exports, __webpack_require__) {

// call something on iterator step with safe closing on error
var anObject = __webpack_require__(20);
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
/* 234 */
/***/ (function(module, exports, __webpack_require__) {

// check on default Array iterator
var Iterators = __webpack_require__(38);
var ITERATOR = __webpack_require__(12)('iterator');
var ArrayProto = Array.prototype;

module.exports = function (it) {
  return it !== undefined && (Iterators.Array === it || ArrayProto[ITERATOR] === it);
};


/***/ }),
/* 235 */
/***/ (function(module, exports, __webpack_require__) {

// 21.2.5.3 get RegExp.prototype.flags()
if (__webpack_require__(21) && /./g.flags != 'g') __webpack_require__(35).f(RegExp.prototype, 'flags', {
  configurable: true,
  get: __webpack_require__(91)
});


/***/ }),
/* 236 */
/***/ (function(module, exports, __webpack_require__) {

var isObject = __webpack_require__(24);
var setPrototypeOf = __webpack_require__(256).set;
module.exports = function (that, target, C) {
  var S = target.constructor;
  var P;
  if (S !== C && typeof S == 'function' && (P = S.prototype) !== C.prototype && isObject(P) && setPrototypeOf) {
    setPrototypeOf(that, P);
  } return that;
};


/***/ }),
/* 237 */
/***/ (function(module, exports, __webpack_require__) {

var pIE = __webpack_require__(257);
var createDesc = __webpack_require__(80);
var toIObject = __webpack_require__(81);
var toPrimitive = __webpack_require__(88);
var has = __webpack_require__(46);
var IE8_DOM_DEFINE = __webpack_require__(101);
var gOPD = Object.getOwnPropertyDescriptor;

exports.f = __webpack_require__(21) ? gOPD : function getOwnPropertyDescriptor(O, P) {
  O = toIObject(O);
  P = toPrimitive(P, true);
  if (IE8_DOM_DEFINE) try {
    return gOPD(O, P);
  } catch (e) { /* empty */ }
  if (has(O, P)) return createDesc(!pIE.f.call(O, P), O[P]);
};


/***/ }),
/* 238 */
/***/ (function(module, exports, __webpack_require__) {

// 19.1.2.7 / 15.2.3.4 Object.getOwnPropertyNames(O)
var $keys = __webpack_require__(184);
var hiddenKeys = __webpack_require__(126).concat('length', 'prototype');

exports.f = Object.getOwnPropertyNames || function getOwnPropertyNames(O) {
  return $keys(O, hiddenKeys);
};


/***/ }),
/* 239 */
/***/ (function(module, exports, __webpack_require__) {

var global = __webpack_require__(13);
var inheritIfRequired = __webpack_require__(236);
var dP = __webpack_require__(35).f;
var gOPN = __webpack_require__(238).f;
var isRegExp = __webpack_require__(108);
var $flags = __webpack_require__(91);
var $RegExp = global.RegExp;
var Base = $RegExp;
var proto = $RegExp.prototype;
var re1 = /a/g;
var re2 = /a/g;
// "new" creates a new object, old webkit buggy here
var CORRECT_NEW = new $RegExp(re1) !== re1;

if (__webpack_require__(21) && (!CORRECT_NEW || __webpack_require__(22)(function () {
  re2[__webpack_require__(9)('match')] = false;
  // RegExp constructor can alter flags and IsRegExp works correct with @@match
  return $RegExp(re1) != re1 || $RegExp(re2) == re2 || $RegExp(re1, 'i') != '/a/i';
}))) {
  $RegExp = function RegExp(p, f) {
    var tiRE = this instanceof $RegExp;
    var piRE = isRegExp(p);
    var fiU = f === undefined;
    return !tiRE && piRE && p.constructor === $RegExp && fiU ? p
      : inheritIfRequired(CORRECT_NEW
        ? new Base(piRE && !fiU ? p.source : p, f)
        : Base((piRE = p instanceof $RegExp) ? p.source : p, piRE && fiU ? $flags.call(p) : f)
      , tiRE ? this : proto, $RegExp);
  };
  var proxy = function (key) {
    key in $RegExp || dP($RegExp, key, {
      configurable: true,
      get: function () { return Base[key]; },
      set: function (it) { Base[key] = it; }
    });
  };
  for (var keys = gOPN(Base), i = 0; keys.length > i;) proxy(keys[i++]);
  proto.constructor = $RegExp;
  $RegExp.prototype = proto;
  __webpack_require__(31)(global, 'RegExp', $RegExp);
}

__webpack_require__(258)('RegExp');


/***/ }),
/* 240 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var _interopRequireDefault = __webpack_require__(0);

__webpack_require__(173);

__webpack_require__(99);

__webpack_require__(48);

__webpack_require__(85);

__webpack_require__(161);

__webpack_require__(68);

var _keys = _interopRequireDefault(__webpack_require__(27));

(function ($) {
  var Stylesheet = function Stylesheet() {
    var self = this,
        rules = {},
        rawCSS = {},
        devices = {};

    var getDeviceMaxValue = function getDeviceMaxValue(deviceName) {
      var deviceNames = (0, _keys.default)(devices),
          deviceNameIndex = deviceNames.indexOf(deviceName),
          nextIndex = deviceNameIndex + 1;

      if (nextIndex >= deviceNames.length) {
        throw new RangeError('Max value for this device is out of range.');
      }

      return devices[deviceNames[nextIndex]] - 1;
    };

    var queryToHash = function queryToHash(query) {
      var hash = [];
      $.each(query, function (endPoint) {
        hash.push(endPoint + '_' + this);
      });
      return hash.join('-');
    };

    var hashToQuery = function hashToQuery(hash) {
      var query = {};
      hash = hash.split('-').filter(String);
      hash.forEach(function (singleQuery) {
        var queryParts = singleQuery.split('_'),
            endPoint = queryParts[0],
            deviceName = queryParts[1];
        query[endPoint] = 'max' === endPoint ? getDeviceMaxValue(deviceName) : devices[deviceName];
      });
      return query;
    };

    var addQueryHash = function addQueryHash(queryHash) {
      rules[queryHash] = {};
      var hashes = (0, _keys.default)(rules);

      if (hashes.length < 2) {
        return;
      } // Sort the devices from narrowest to widest


      hashes.sort(function (a, b) {
        if ('all' === a) {
          return -1;
        }

        if ('all' === b) {
          return 1;
        }

        var aQuery = hashToQuery(a),
            bQuery = hashToQuery(b);
        return bQuery.max - aQuery.max;
      });
      var sortedRules = {};
      hashes.forEach(function (deviceName) {
        sortedRules[deviceName] = rules[deviceName];
      });
      rules = sortedRules;
    };

    var getQueryHashStyleFormat = function getQueryHashStyleFormat(queryHash) {
      var query = hashToQuery(queryHash),
          styleFormat = [];
      $.each(query, function (endPoint) {
        styleFormat.push('(' + endPoint + '-width:' + this + 'px)');
      });
      return '@media' + styleFormat.join(' and ');
    };

    this.addDevice = function (newDeviceName, deviceValue) {
      devices[newDeviceName] = deviceValue;
      var deviceNames = (0, _keys.default)(devices);

      if (deviceNames.length < 2) {
        return self;
      } // Sort the devices from narrowest to widest


      deviceNames.sort(function (a, b) {
        return devices[a] - devices[b];
      });
      var sortedDevices = {};
      deviceNames.forEach(function (deviceName) {
        sortedDevices[deviceName] = devices[deviceName];
      });
      devices = sortedDevices;
      return self;
    };

    this.addRawCSS = function (key, css) {
      rawCSS[key] = css;
    };

    this.addRules = function (selector, styleRules, query) {
      var queryHash = 'all';

      if (!_.isEmpty(query)) {
        queryHash = queryToHash(query);
      }

      if (!rules[queryHash]) {
        addQueryHash(queryHash);
      }

      if (!styleRules) {
        var parsedRules = selector.match(/[^{]+\{[^}]+}/g);
        $.each(parsedRules, function () {
          var parsedRule = this.match(/([^{]+)\{([^}]+)}/);

          if (parsedRule) {
            self.addRules(parsedRule[1].trim(), parsedRule[2].trim(), query);
          }
        });
        return;
      }

      if (!rules[queryHash][selector]) {
        rules[queryHash][selector] = {};
      }

      if ('string' === typeof styleRules) {
        styleRules = styleRules.split(';').filter(String);
        var orderedRules = {};

        try {
          $.each(styleRules, function () {
            var property = this.split(/:(.*)?/);
            orderedRules[property[0].trim()] = property[1].trim().replace(';', '');
          });
        } catch (error) {
          // At least one of the properties is incorrect
          return;
        }

        styleRules = orderedRules;
      }

      $.extend(rules[queryHash][selector], styleRules);
      return self;
    };

    this.getRules = function () {
      return rules;
    };

    this.empty = function () {
      rules = {};
      rawCSS = {};
    };

    this.toString = function () {
      var styleText = '';
      $.each(rules, function (queryHash) {
        var deviceText = Stylesheet.parseRules(this);

        if ('all' !== queryHash) {
          deviceText = getQueryHashStyleFormat(queryHash) + '{' + deviceText + '}';
        }

        styleText += deviceText;
      });
      $.each(rawCSS, function () {
        styleText += this;
      });
      return styleText;
    };
  };

  Stylesheet.parseRules = function (rules) {
    var parsedRules = '';
    $.each(rules, function (selector) {
      var selectorContent = Stylesheet.parseProperties(this);

      if (selectorContent) {
        parsedRules += selector + '{' + selectorContent + '}';
      }
    });
    return parsedRules;
  };

  Stylesheet.parseProperties = function (properties) {
    var parsedProperties = '';
    $.each(properties, function (propertyKey) {
      if (this) {
        parsedProperties += propertyKey + ':' + this + ';';
      }
    });
    return parsedProperties;
  };

  module.exports = Stylesheet;
})(jQuery);

/***/ }),
/* 241 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var _interopRequireDefault = __webpack_require__(0);

var _keys = _interopRequireDefault(__webpack_require__(27));

var _helpers = _interopRequireDefault(__webpack_require__(109));

module.exports = Marionette.CompositeView.extend({
  templateHelpers: function templateHelpers() {
    return {
      view: this
    };
  },
  getBehavior: function getBehavior(name) {
    return this._behaviors[(0, _keys.default)(this.behaviors()).indexOf(name)];
  },
  initialize: function initialize() {
    this.collection = this.model.get('elements');
  },
  addChildModel: function addChildModel(model, options) {
    return this.collection.add(model, options, true);
  },
  addElement: function addElement(data, options) {
    if (this.isCollectionFilled()) {
      return;
    }

    options = jQuery.extend({
      trigger: false,
      edit: true,
      onBeforeAdd: null,
      onAfterAdd: null
    }, options);
    var childTypes = this.getChildType();
    var newItem, elType;

    if (data instanceof Backbone.Model) {
      newItem = data;
      elType = newItem.get('elType');
    } else {
      newItem = {
        id: elementor.helpers.getUniqueID(),
        elType: childTypes[0],
        settings: {},
        elements: []
      };

      if (data) {
        jQuery.extend(newItem, data);
      }

      elType = newItem.elType;
    }

    if (-1 === childTypes.indexOf(elType)) {
      return this.children.last().addElement(newItem, options);
    }

    if (options.clone) {
      newItem = this.cloneItem(newItem);
    }

    if (options.trigger) {
      elementor.channels.data.trigger(options.trigger.beforeAdd, newItem);
    }

    if (options.onBeforeAdd) {
      options.onBeforeAdd();
    }

    var newModel = this.addChildModel(newItem, {
      at: options.at
    }),
        newView = this.children.findByModel(newModel);

    if (options.onAfterAdd) {
      options.onAfterAdd(newModel, newView);
    }

    if (options.trigger) {
      elementor.channels.data.trigger(options.trigger.afterAdd, newItem);
    }

    if (options.edit && elementor.history.history.getActive()) {
      newModel.trigger('request:edit');
    }

    return newView;
  },
  addChildElement: function addChildElement(data, options) {
    elementorCommon.helpers.softDeprecated('addChildElement', '2.8.0', "$e.run( 'document/elements/create' )");

    if (Object !== data.constructor) {
      data = jQuery.extend({}, data);
    }

    $e.run('document/elements/create', {
      container: this.getContainer(),
      model: data,
      options: options
    });
  },
  cloneItem: function cloneItem(item) {
    var self = this;

    if (item instanceof Backbone.Model) {
      return item.clone();
    }

    item.id = elementor.helpers.getUniqueID();
    item.settings._element_id = '';
    item.elements.forEach(function (childItem, index) {
      item.elements[index] = self.cloneItem(childItem);
    });
    return item;
  },
  lookup: function lookup() {
    var element = this;

    if (element.isDestroyed) {
      element = _helpers.default.findViewById(element.model.id);
    }

    return element;
  },
  isCollectionFilled: function isCollectionFilled() {
    return false;
  }
});

/***/ }),
/* 242 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var _interopRequireDefault = __webpack_require__(0);

var _Object$defineProperty = __webpack_require__(1);

_Object$defineProperty(exports, "__esModule", {
  value: true
});

exports.default = void 0;

var _assign = _interopRequireDefault(__webpack_require__(159));

var _classCallCheck2 = _interopRequireDefault(__webpack_require__(2));

var _createClass2 = _interopRequireDefault(__webpack_require__(3));

var _possibleConstructorReturn2 = _interopRequireDefault(__webpack_require__(5));

var _getPrototypeOf2 = _interopRequireDefault(__webpack_require__(4));

var _inherits2 = _interopRequireDefault(__webpack_require__(6));

var _helpers = _interopRequireDefault(__webpack_require__(109));

var AddSectionBase =
/*#__PURE__*/
function (_Marionette$ItemView) {
  (0, _inherits2.default)(AddSectionBase, _Marionette$ItemView);

  function AddSectionBase() {
    (0, _classCallCheck2.default)(this, AddSectionBase);
    return (0, _possibleConstructorReturn2.default)(this, (0, _getPrototypeOf2.default)(AddSectionBase).apply(this, arguments));
  }

  (0, _createClass2.default)(AddSectionBase, [{
    key: "template",
    value: function template() {
      return Marionette.TemplateCache.get('#tmpl-elementor-add-section');
    }
  }, {
    key: "attributes",
    value: function attributes() {
      return {
        'data-view': 'choose-action'
      };
    }
  }, {
    key: "ui",
    value: function ui() {
      return {
        addNewSection: '.elementor-add-new-section',
        closeButton: '.elementor-add-section-close',
        addSectionButton: '.elementor-add-section-button',
        addTemplateButton: '.elementor-add-template-button',
        selectPreset: '.elementor-select-preset',
        presets: '.elementor-preset'
      };
    }
  }, {
    key: "events",
    value: function events() {
      return {
        'click @ui.addSectionButton': 'onAddSectionButtonClick',
        'click @ui.addTemplateButton': 'onAddTemplateButtonClick',
        'click @ui.closeButton': 'onCloseButtonClick',
        'click @ui.presets': 'onPresetSelected'
      };
    }
  }, {
    key: "behaviors",
    value: function behaviors() {
      return {
        contextMenu: {
          behaviorClass: __webpack_require__(186),
          groups: this.getContextMenuGroups()
        }
      };
    }
  }, {
    key: "className",
    value: function className() {
      return 'elementor-add-section elementor-visible-desktop';
    }
  }, {
    key: "setView",
    value: function setView(view) {
      this.$el.attr('data-view', view);
    }
  }, {
    key: "showSelectPresets",
    value: function showSelectPresets() {
      this.setView('select-preset');
    }
  }, {
    key: "closeSelectPresets",
    value: function closeSelectPresets() {
      this.setView('choose-action');
    }
  }, {
    key: "getTemplatesModalOptions",
    value: function getTemplatesModalOptions() {
      return {
        importOptions: {
          at: this.getOption('at')
        }
      };
    }
  }, {
    key: "getContextMenuGroups",
    value: function getContextMenuGroups() {
      var _this = this;

      var hasContent = function hasContent() {
        return elementor.elements.length > 0;
      };

      return [{
        name: 'paste',
        actions: [{
          name: 'paste',
          title: elementor.translate('paste'),
          isEnabled: function isEnabled() {
            return _helpers.default.isPasteEnabled(elementor.getPreviewContainer());
          },
          callback: function callback() {
            return $e.run('document/ui/paste', {
              container: elementor.getPreviewContainer(),
              options: {
                at: _this.getOption('at'),
                rebuild: true
              },
              onAfter: function onAfter() {
                return _this.onAfterPaste();
              }
            });
          }
        }]
      }, {
        name: 'content',
        actions: [{
          name: 'copy_all_content',
          title: elementor.translate('copy_all_content'),
          isEnabled: hasContent,
          callback: function callback() {
            return $e.run('document/elements/copy-all');
          }
        }, {
          name: 'delete_all_content',
          title: elementor.translate('delete_all_content'),
          isEnabled: hasContent,
          callback: function callback() {
            return $e.run('document/elements/empty');
          }
        }]
      }];
    }
  }, {
    key: "onAddSectionButtonClick",
    value: function onAddSectionButtonClick() {
      this.showSelectPresets();
    }
  }, {
    key: "onAddTemplateButtonClick",
    value: function onAddTemplateButtonClick() {
      $e.run('library/open', this.getTemplatesModalOptions());
    }
  }, {
    key: "onRender",
    value: function onRender() {
      this.$el.html5Droppable({
        axis: ['vertical'],
        groups: ['elementor-element'],
        placeholder: false,
        currentElementClass: 'elementor-html5dnd-current-element',
        hasDraggingOnChildClass: 'elementor-dragging-on-child',
        onDropping: this.onDropping.bind(this)
      });
    }
  }, {
    key: "onPresetSelected",
    value: function onPresetSelected(event) {
      this.closeSelectPresets();
      var selectedStructure = event.currentTarget.dataset.structure,
          parsedStructure = elementor.presetsFactory.getParsedStructure(selectedStructure);
      $e.run('document/elements/create', {
        model: {
          elType: 'section'
        },
        container: elementor.getPreviewContainer(),
        columns: parsedStructure.columnsCount,
        structure: selectedStructure,
        options: (0, _assign.default)({}, this.options)
      });
    }
  }, {
    key: "onDropping",
    value: function onDropping() {
      if (elementor.helpers.maybeDisableWidget()) {
        return;
      }

      var selectedElement = elementor.channels.panelElements.request('element:selected'),
          historyId = $e.run('document/history/start-log', {
        type: 'add',
        title: elementor.helpers.getModelLabel(selectedElement.model)
      }),
          eSection = $e.run('document/elements/create', {
        model: {
          elType: 'section'
        },
        container: elementor.getPreviewContainer(),
        columns: 1,
        options: {
          // BC: Deprecated since 2.8.0 - use `$e.events`.
          trigger: {
            beforeAdd: 'section:before:drop',
            afterAdd: 'section:after:drop'
          }
        }
      }); // Create the element in column.

      eSection.view.children.findByIndex(0).addElementFromPanel();
      $e.run('document/history/end-log', {
        id: historyId
      });
    }
  }, {
    key: "onAfterPaste",
    value: function onAfterPaste() {}
  }]);
  return AddSectionBase;
}(Marionette.ItemView);

var _default = AddSectionBase;
exports.default = _default;

/***/ }),
/* 243 */,
/* 244 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";

// 22.1.3.9 Array.prototype.findIndex(predicate, thisArg = undefined)
var $export = __webpack_require__(29);
var $find = __webpack_require__(117)(6);
var KEY = 'findIndex';
var forced = true;
// Shouldn't skip holes
if (KEY in []) Array(1)[KEY](function () { forced = false; });
$export($export.P + $export.F * forced, 'Array', {
  findIndex: function findIndex(callbackfn /* , that = undefined */) {
    return $find(this, callbackfn, arguments.length > 1 ? arguments[1] : undefined);
  }
});
__webpack_require__(72)(KEY);


/***/ }),
/* 245 */,
/* 246 */,
/* 247 */
/***/ (function(module, exports) {

// 7.2.9 SameValue(x, y)
module.exports = Object.is || function is(x, y) {
  // eslint-disable-next-line no-self-compare
  return x === y ? x !== 0 || 1 / x === 1 / y : x != x && y != y;
};


/***/ }),
/* 248 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var _interopRequireDefault = __webpack_require__(0);

var _keys = _interopRequireDefault(__webpack_require__(27));

module.exports = Marionette.Region.extend({
  storage: null,
  storageSizeKeys: null,
  constructor: function constructor() {
    Marionette.Region.prototype.constructor.apply(this, arguments);
    var savedStorage = elementorCommon.storage.get(this.getStorageKey());
    this.storage = savedStorage ? savedStorage : this.getDefaultStorage();
    this.storageSizeKeys = (0, _keys.default)(this.storage.size);
  },
  saveStorage: function saveStorage(key, value) {
    this.storage[key] = value;
    elementorCommon.storage.set(this.getStorageKey(), this.storage);
  },
  saveSize: function saveSize() {
    this.saveStorage('size', elementor.helpers.getElementInlineStyle(this.$el, this.storageSizeKeys));
  }
});

/***/ }),
/* 249 */
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

var _possibleConstructorReturn2 = _interopRequireDefault(__webpack_require__(5));

var _getPrototypeOf2 = _interopRequireDefault(__webpack_require__(4));

var _inherits2 = _interopRequireDefault(__webpack_require__(6));

var _header = _interopRequireDefault(__webpack_require__(250));

var _logo = _interopRequireDefault(__webpack_require__(251));

var _loading = _interopRequireDefault(__webpack_require__(252));

var _default =
/*#__PURE__*/
function (_Marionette$LayoutVie) {
  (0, _inherits2.default)(_default, _Marionette$LayoutVie);

  function _default() {
    (0, _classCallCheck2.default)(this, _default);
    return (0, _possibleConstructorReturn2.default)(this, (0, _getPrototypeOf2.default)(_default).apply(this, arguments));
  }

  (0, _createClass2.default)(_default, [{
    key: "el",
    value: function el() {
      return this.getModal().getElements('widget');
    }
  }, {
    key: "regions",
    value: function regions() {
      return {
        modalHeader: '.dialog-header',
        modalContent: '.dialog-lightbox-content',
        modalLoading: '.dialog-lightbox-loading'
      };
    }
  }, {
    key: "initialize",
    value: function initialize() {
      this.modalHeader.show(new _header.default(this.getHeaderOptions()));
    }
  }, {
    key: "getModal",
    value: function getModal() {
      if (!this.modal) {
        this.initModal();
      }

      return this.modal;
    }
  }, {
    key: "initModal",
    value: function initModal() {
      var modalOptions = {
        className: 'elementor-templates-modal',
        closeButton: false,
        draggable: false,
        hide: {
          onOutsideClick: false,
          onEscKeyPress: false
        }
      };
      jQuery.extend(true, modalOptions, this.getModalOptions());
      this.modal = elementorCommon.dialogsManager.createWidget('lightbox', modalOptions);
      this.modal.getElements('message').append(this.modal.addElement('content'), this.modal.addElement('loading'));

      if (modalOptions.draggable) {
        this.draggableModal();
      }
    }
  }, {
    key: "showModal",
    value: function showModal() {
      this.getModal().show();
    }
  }, {
    key: "hideModal",
    value: function hideModal() {
      this.getModal().hide();
    }
  }, {
    key: "draggableModal",
    value: function draggableModal() {
      var $modalWidgetContent = this.getModal().getElements('widgetContent');
      $modalWidgetContent.draggable({
        containment: 'parent',
        stop: function stop() {
          $modalWidgetContent.height('');
        }
      });
      $modalWidgetContent.css('position', 'absolute');
    }
  }, {
    key: "getModalOptions",
    value: function getModalOptions() {
      return {};
    }
  }, {
    key: "getLogoOptions",
    value: function getLogoOptions() {
      return {};
    }
  }, {
    key: "getHeaderOptions",
    value: function getHeaderOptions() {
      return {
        closeType: 'normal'
      };
    }
  }, {
    key: "getHeaderView",
    value: function getHeaderView() {
      return this.modalHeader.currentView;
    }
  }, {
    key: "showLoadingView",
    value: function showLoadingView() {
      this.modalLoading.show(new _loading.default());
      this.modalLoading.$el.show();
      this.modalContent.$el.hide();
    }
  }, {
    key: "hideLoadingView",
    value: function hideLoadingView() {
      this.modalContent.$el.show();
      this.modalLoading.$el.hide();
    }
  }, {
    key: "showLogo",
    value: function showLogo() {
      this.getHeaderView().logoArea.show(new _logo.default(this.getLogoOptions()));
    }
  }]);
  return _default;
}(Marionette.LayoutView);

exports.default = _default;

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

var _possibleConstructorReturn2 = _interopRequireDefault(__webpack_require__(5));

var _getPrototypeOf2 = _interopRequireDefault(__webpack_require__(4));

var _inherits2 = _interopRequireDefault(__webpack_require__(6));

var _default =
/*#__PURE__*/
function (_Marionette$LayoutVie) {
  (0, _inherits2.default)(_default, _Marionette$LayoutVie);

  function _default() {
    (0, _classCallCheck2.default)(this, _default);
    return (0, _possibleConstructorReturn2.default)(this, (0, _getPrototypeOf2.default)(_default).apply(this, arguments));
  }

  (0, _createClass2.default)(_default, [{
    key: "className",
    value: function className() {
      return 'elementor-templates-modal__header';
    }
  }, {
    key: "getTemplate",
    value: function getTemplate() {
      return '#tmpl-elementor-templates-modal__header';
    }
  }, {
    key: "regions",
    value: function regions() {
      return {
        logoArea: '.elementor-templates-modal__header__logo-area',
        tools: '#elementor-template-library-header-tools',
        menuArea: '.elementor-templates-modal__header__menu-area'
      };
    }
  }, {
    key: "ui",
    value: function ui() {
      return {
        closeModal: '.elementor-templates-modal__header__close'
      };
    }
  }, {
    key: "events",
    value: function events() {
      return {
        'click @ui.closeModal': 'onCloseModalClick'
      };
    }
  }, {
    key: "templateHelpers",
    value: function templateHelpers() {
      return {
        closeType: this.getOption('closeType')
      };
    }
  }, {
    key: "onCloseModalClick",
    value: function onCloseModalClick() {
      this._parent._parent._parent.hideModal();
    }
  }]);
  return _default;
}(Marionette.LayoutView);

exports.default = _default;

/***/ }),
/* 251 */
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

var _possibleConstructorReturn2 = _interopRequireDefault(__webpack_require__(5));

var _getPrototypeOf2 = _interopRequireDefault(__webpack_require__(4));

var _inherits2 = _interopRequireDefault(__webpack_require__(6));

var _default =
/*#__PURE__*/
function (_Marionette$ItemView) {
  (0, _inherits2.default)(_default, _Marionette$ItemView);

  function _default() {
    (0, _classCallCheck2.default)(this, _default);
    return (0, _possibleConstructorReturn2.default)(this, (0, _getPrototypeOf2.default)(_default).apply(this, arguments));
  }

  (0, _createClass2.default)(_default, [{
    key: "getTemplate",
    value: function getTemplate() {
      return '#tmpl-elementor-templates-modal__header__logo';
    }
  }, {
    key: "className",
    value: function className() {
      return 'elementor-templates-modal__header__logo';
    }
  }, {
    key: "events",
    value: function events() {
      return {
        click: 'onClick'
      };
    }
  }, {
    key: "templateHelpers",
    value: function templateHelpers() {
      return {
        title: this.getOption('title')
      };
    }
  }, {
    key: "onClick",
    value: function onClick() {
      var clickCallback = this.getOption('click');

      if (clickCallback) {
        clickCallback();
      }
    }
  }]);
  return _default;
}(Marionette.ItemView);

exports.default = _default;

/***/ }),
/* 252 */
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

var _possibleConstructorReturn2 = _interopRequireDefault(__webpack_require__(5));

var _getPrototypeOf2 = _interopRequireDefault(__webpack_require__(4));

var _inherits2 = _interopRequireDefault(__webpack_require__(6));

var _default =
/*#__PURE__*/
function (_Marionette$ItemView) {
  (0, _inherits2.default)(_default, _Marionette$ItemView);

  function _default() {
    (0, _classCallCheck2.default)(this, _default);
    return (0, _possibleConstructorReturn2.default)(this, (0, _getPrototypeOf2.default)(_default).apply(this, arguments));
  }

  (0, _createClass2.default)(_default, [{
    key: "id",
    value: function id() {
      return 'elementor-template-library-loading';
    }
  }, {
    key: "getTemplate",
    value: function getTemplate() {
      return '#tmpl-elementor-template-library-loading';
    }
  }]);
  return _default;
}(Marionette.ItemView);

exports.default = _default;

/***/ }),
/* 253 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";
/*
object-assign
(c) Sindre Sorhus
@license MIT
*/


/* eslint-disable no-unused-vars */
var getOwnPropertySymbols = Object.getOwnPropertySymbols;
var hasOwnProperty = Object.prototype.hasOwnProperty;
var propIsEnumerable = Object.prototype.propertyIsEnumerable;

function toObject(val) {
	if (val === null || val === undefined) {
		throw new TypeError('Object.assign cannot be called with null or undefined');
	}

	return Object(val);
}

function shouldUseNative() {
	try {
		if (!Object.assign) {
			return false;
		}

		// Detect buggy property enumeration order in older V8 versions.

		// https://bugs.chromium.org/p/v8/issues/detail?id=4118
		var test1 = new String('abc');  // eslint-disable-line no-new-wrappers
		test1[5] = 'de';
		if (Object.getOwnPropertyNames(test1)[0] === '5') {
			return false;
		}

		// https://bugs.chromium.org/p/v8/issues/detail?id=3056
		var test2 = {};
		for (var i = 0; i < 10; i++) {
			test2['_' + String.fromCharCode(i)] = i;
		}
		var order2 = Object.getOwnPropertyNames(test2).map(function (n) {
			return test2[n];
		});
		if (order2.join('') !== '0123456789') {
			return false;
		}

		// https://bugs.chromium.org/p/v8/issues/detail?id=3056
		var test3 = {};
		'abcdefghijklmnopqrst'.split('').forEach(function (letter) {
			test3[letter] = letter;
		});
		if (Object.keys(Object.assign({}, test3)).join('') !==
				'abcdefghijklmnopqrst') {
			return false;
		}

		return true;
	} catch (err) {
		// We don't expect any of the above to throw, but better to be safe.
		return false;
	}
}

module.exports = shouldUseNative() ? Object.assign : function (target, source) {
	var from;
	var to = toObject(target);
	var symbols;

	for (var s = 1; s < arguments.length; s++) {
		from = Object(arguments[s]);

		for (var key in from) {
			if (hasOwnProperty.call(from, key)) {
				to[key] = from[key];
			}
		}

		if (getOwnPropertySymbols) {
			symbols = getOwnPropertySymbols(from);
			for (var i = 0; i < symbols.length; i++) {
				if (propIsEnumerable.call(from, symbols[i])) {
					to[symbols[i]] = from[symbols[i]];
				}
			}
		}
	}

	return to;
};


/***/ }),
/* 254 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";

var $defineProperty = __webpack_require__(16);
var createDesc = __webpack_require__(39);

module.exports = function (object, index, value) {
  if (index in object) $defineProperty.f(object, index, createDesc(0, value));
  else object[index] = value;
};


/***/ }),
/* 255 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


function checkDCE() {
  /* global __REACT_DEVTOOLS_GLOBAL_HOOK__ */
  if (
    typeof __REACT_DEVTOOLS_GLOBAL_HOOK__ === 'undefined' ||
    typeof __REACT_DEVTOOLS_GLOBAL_HOOK__.checkDCE !== 'function'
  ) {
    return;
  }
  if (false) {}
  try {
    // Verify that the code above has been dead code eliminated (DCE'd).
    __REACT_DEVTOOLS_GLOBAL_HOOK__.checkDCE(checkDCE);
  } catch (err) {
    // DevTools shouldn't crash React, no matter what.
    // We should still report in case we break this code.
    console.error(err);
  }
}

if (true) {
  // DCE check should happen before ReactDOM bundle executes so that
  // DevTools can report bad minification during injection.
  checkDCE();
  module.exports = __webpack_require__(330);
} else {}


/***/ }),
/* 256 */
/***/ (function(module, exports, __webpack_require__) {

// Works with __proto__ only. Old v8 can't work with null proto objects.
/* eslint-disable no-proto */
var isObject = __webpack_require__(24);
var anObject = __webpack_require__(19);
var check = function (O, proto) {
  anObject(O);
  if (!isObject(proto) && proto !== null) throw TypeError(proto + ": can't set as prototype!");
};
module.exports = {
  set: Object.setPrototypeOf || ('__proto__' in {} ? // eslint-disable-line
    function (test, buggy, set) {
      try {
        set = __webpack_require__(70)(Function.call, __webpack_require__(237).f(Object.prototype, '__proto__').set, 2);
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
/* 257 */
/***/ (function(module, exports) {

exports.f = {}.propertyIsEnumerable;


/***/ }),
/* 258 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";

var global = __webpack_require__(13);
var dP = __webpack_require__(35);
var DESCRIPTORS = __webpack_require__(21);
var SPECIES = __webpack_require__(9)('species');

module.exports = function (KEY) {
  var C = global[KEY];
  if (DESCRIPTORS && C && !C[SPECIES]) dP.f(C, SPECIES, {
    configurable: true,
    get: function () { return this; }
  });
};


/***/ }),
/* 259 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var InsertTemplateHandler;
InsertTemplateHandler = Marionette.Behavior.extend({
  ui: {
    insertButton: '.elementor-template-library-template-insert'
  },
  events: {
    'click @ui.insertButton': 'onInsertButtonClick'
  },
  onInsertButtonClick: function onInsertButtonClick() {
    var args = {
      model: this.view.model
    };

    if ('remote' === args.model.get('source') && !elementor.config.library_connect.is_connected) {
      $e.route('library/connect', args);
      return;
    }

    $e.run('library/insert-template', args);
  }
});
module.exports = InsertTemplateHandler;

/***/ }),
/* 260 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var TemplateLibraryInsertTemplateBehavior = __webpack_require__(259),
    TemplateLibraryTemplateView;

TemplateLibraryTemplateView = Marionette.ItemView.extend({
  className: function className() {
    var classes = 'elementor-template-library-template',
        source = this.model.get('source');
    classes += ' elementor-template-library-template-' + source;

    if ('remote' === source) {
      classes += ' elementor-template-library-template-' + this.model.get('type');
    }

    if (this.model.get('isPro')) {
      classes += ' elementor-template-library-pro-template';
    }

    return classes;
  },
  ui: function ui() {
    return {
      previewButton: '.elementor-template-library-template-preview'
    };
  },
  events: function events() {
    return {
      'click @ui.previewButton': 'onPreviewButtonClick'
    };
  },
  behaviors: {
    insertTemplate: {
      behaviorClass: TemplateLibraryInsertTemplateBehavior
    }
  }
});
module.exports = TemplateLibraryTemplateView;

/***/ }),
/* 261 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var _interopRequireDefault = __webpack_require__(0);

__webpack_require__(15);

var _colorPicker = _interopRequireDefault(__webpack_require__(221));

var ControlMultipleBaseItemView = __webpack_require__(156),
    ControlBoxShadowItemView;

ControlBoxShadowItemView = ControlMultipleBaseItemView.extend({
  ui: function ui() {
    var ui = ControlMultipleBaseItemView.prototype.ui.apply(this, arguments);
    ui.sliders = '.elementor-slider';
    ui.colorPickerPlaceholder = '.elementor-color-picker-placeholder';
    return ui;
  },
  initSliders: function initSliders() {
    var _this = this;

    var value = this.getControlValue();
    this.ui.sliders.each(function (index, slider) {
      var $input = jQuery(slider).next('.elementor-slider-input').find('input');
      var sliderInstance = noUiSlider.create(slider, {
        start: [value[slider.dataset.input]],
        step: 1,
        range: {
          min: +$input.attr('min'),
          max: +$input.attr('max')
        },
        format: {
          to: function to(sliderValue) {
            return +sliderValue.toFixed(1);
          },
          from: function from(sliderValue) {
            return +sliderValue;
          }
        }
      });
      sliderInstance.on('slide', function (values) {
        var type = sliderInstance.target.dataset.input;
        $input.val(values[0]);

        _this.setValue(type, values[0]);
      });
    });
  },
  initColors: function initColors() {
    var _this2 = this;

    this.colorPicker = new _colorPicker.default({
      picker: {
        el: this.ui.colorPickerPlaceholder[0],
        default: this.getControlValue('color')
      },
      onChange: function onChange() {
        _this2.setValue('color', _this2.colorPicker.getColor());
      },
      onClear: function onClear() {
        _this2.setValue('color', '');
      }
    });
  },
  onInputChange: function onInputChange(event) {
    var type = event.currentTarget.dataset.setting,
        $slider = this.ui.sliders.filter('[data-input="' + type + '"]');
    $slider[0].noUiSlider.set(this.getControlValue(type));
  },
  onReady: function onReady() {
    this.initSliders();
    this.initColors();
  },
  onBeforeDestroy: function onBeforeDestroy() {
    this.colorPicker.destroy();
  }
});
module.exports = ControlBoxShadowItemView;

/***/ }),
/* 262 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var ControlBaseDataView = __webpack_require__(65),
    ControlChooseItemView;

ControlChooseItemView = ControlBaseDataView.extend({
  ui: function ui() {
    var ui = ControlBaseDataView.prototype.ui.apply(this, arguments);
    ui.inputs = '[type="radio"]';
    return ui;
  },
  events: function events() {
    return _.extend(ControlBaseDataView.prototype.events.apply(this, arguments), {
      'mousedown label': 'onMouseDownLabel',
      'click @ui.inputs': 'onClickInput',
      'change @ui.inputs': 'onBaseInputChange'
    });
  },
  applySavedValue: function applySavedValue() {
    var currentValue = this.getControlValue();

    if (currentValue) {
      this.ui.inputs.filter('[value="' + currentValue + '"]').prop('checked', true);
    } else {
      this.ui.inputs.filter(':checked').prop('checked', false);
    }
  },
  onMouseDownLabel: function onMouseDownLabel(event) {
    var $clickedLabel = this.$(event.currentTarget),
        $selectedInput = this.$('#' + $clickedLabel.attr('for'));
    $selectedInput.data('checked', $selectedInput.prop('checked'));
  },
  onClickInput: function onClickInput(event) {
    if (!this.model.get('toggle')) {
      return;
    }

    var $selectedInput = this.$(event.currentTarget);

    if ($selectedInput.data('checked')) {
      $selectedInput.prop('checked', false).trigger('change');
    }
  }
}, {
  onPasteStyle: function onPasteStyle(control, clipboardValue) {
    return '' === clipboardValue || undefined !== control.options[clipboardValue];
  }
});
module.exports = ControlChooseItemView;

/***/ }),
/* 263 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var ControlBaseMultipleItemView = __webpack_require__(156),
    ControlBaseUnitsItemView;

ControlBaseUnitsItemView = ControlBaseMultipleItemView.extend({
  getCurrentRange: function getCurrentRange() {
    return this.getUnitRange(this.getControlValue('unit'));
  },
  getUnitRange: function getUnitRange(unit) {
    var ranges = this.model.get('range');

    if (!ranges || !ranges[unit]) {
      return false;
    }

    return ranges[unit];
  }
});
module.exports = ControlBaseUnitsItemView;

/***/ }),
/* 264 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


__webpack_require__(193);

__webpack_require__(160);

__webpack_require__(99);

var ControlBaseDataView = __webpack_require__(65),
    RepeaterRowView;

RepeaterRowView = Marionette.CompositeView.extend({
  template: Marionette.TemplateCache.get('#tmpl-elementor-repeater-row'),
  className: 'elementor-repeater-fields',
  ui: {
    duplicateButton: '.elementor-repeater-tool-duplicate',
    editButton: '.elementor-repeater-tool-edit',
    removeButton: '.elementor-repeater-tool-remove',
    itemTitle: '.elementor-repeater-row-item-title'
  },
  behaviors: {
    HandleInnerTabs: {
      behaviorClass: __webpack_require__(265)
    }
  },
  triggers: {
    'click @ui.removeButton': 'click:remove',
    'click @ui.duplicateButton': 'click:duplicate',
    'click @ui.itemTitle': 'click:edit'
  },
  modelEvents: {
    change: 'onModelChange'
  },
  templateHelpers: function templateHelpers() {
    return {
      itemIndex: this.getOption('itemIndex'),
      itemActions: this.getOption('itemActions')
    };
  },
  childViewContainer: '.elementor-repeater-row-controls',
  getChildView: function getChildView(item) {
    var controlType = item.get('type');
    return elementor.getControlView(controlType);
  },
  childViewOptions: function childViewOptions() {
    return {
      container: this.options.container
    };
  },
  updateIndex: function updateIndex(newIndex) {
    this.itemIndex = newIndex;
  },
  setTitle: function setTitle() {
    var titleField = this.getOption('titleField'),
        title = '';

    if (titleField) {
      var values = {};
      this.children.each(function (child) {
        if (!(child instanceof ControlBaseDataView)) {
          return;
        }

        values[child.model.get('name')] = child.getControlValue();
      });
      title = Marionette.TemplateCache.prototype.compileTemplate(titleField)(this.model.parseDynamicSettings());
    }

    if (!title) {
      title = elementor.translate('Item #%s', [this.getOption('itemIndex')]);
    }

    this.ui.itemTitle.html(title);
  },
  initialize: function initialize(options) {
    this.itemIndex = 0; // Collection for Controls list

    this.collection = new Backbone.Collection(_.values(elementor.mergeControlsSettings(options.controlFields)));
  },
  onRender: function onRender() {
    this.setTitle();
  },
  onModelChange: function onModelChange() {
    if (this.getOption('titleField')) {
      this.setTitle();
    }
  },
  onChildviewResponsiveSwitcherClick: function onChildviewResponsiveSwitcherClick(childView, device) {
    if ('desktop' === device) {
      elementor.getPanelView().getCurrentPageView().$el.toggleClass('elementor-responsive-switchers-open');
    }
  }
});
module.exports = RepeaterRowView;

/***/ }),
/* 265 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


__webpack_require__(15);

var InnerTabsBehavior;
InnerTabsBehavior = Marionette.Behavior.extend({
  onRenderCollection: function onRenderCollection() {
    this.handleInnerTabs(this.view);
  },
  handleInnerTabs: function handleInnerTabs(parent) {
    var closedClass = 'elementor-tab-close',
        activeClass = 'elementor-tab-active',
        tabsWrappers = parent.children.filter(function (view) {
      return 'tabs' === view.model.get('type');
    });

    _.each(tabsWrappers, function (view) {
      view.$el.find('.elementor-control-content').remove();
      var tabsId = view.model.get('name'),
          tabs = parent.children.filter(function (childView) {
        return 'tab' === childView.model.get('type') && childView.model.get('tabs_wrapper') === tabsId;
      });

      _.each(tabs, function (childView, index) {
        view._addChildView(childView);

        var tabId = childView.model.get('name'),
            controlsUnderTab = parent.children.filter(function (controlView) {
          return tabId === controlView.model.get('inner_tab');
        });

        if (0 === index) {
          childView.$el.addClass(activeClass);
        } else {
          _.each(controlsUnderTab, function (controlView) {
            controlView.$el.addClass(closedClass);
          });
        }
      });
    });
  },
  onChildviewControlTabClicked: function onChildviewControlTabClicked(childView) {
    var closedClass = 'elementor-tab-close',
        activeClass = 'elementor-tab-active',
        tabClicked = childView.model.get('name'),
        childrenUnderTab = this.view.children.filter(function (view) {
      return 'tab' !== view.model.get('type') && childView.model.get('tabs_wrapper') === view.model.get('tabs_wrapper');
    }),
        siblingTabs = this.view.children.filter(function (view) {
      return 'tab' === view.model.get('type') && childView.model.get('tabs_wrapper') === view.model.get('tabs_wrapper');
    });

    _.each(siblingTabs, function (view) {
      view.$el.removeClass(activeClass);
    });

    childView.$el.addClass(activeClass);

    _.each(childrenUnderTab, function (view) {
      if (view.model.get('inner_tab') === tabClicked) {
        view.$el.removeClass(closedClass);
      } else {
        view.$el.addClass(closedClass);
      }
    });

    elementor.getPanelView().updateScrollbar();
  }
});
module.exports = InnerTabsBehavior;

/***/ }),
/* 266 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var _interopRequireDefault = __webpack_require__(0);

__webpack_require__(68);

var _typeof2 = _interopRequireDefault(__webpack_require__(47));

var ColumnSettingsModel = __webpack_require__(421),
    ElementModel;

ElementModel = Backbone.Model.extend({
  defaults: {
    id: '',
    elType: '',
    isInner: false,
    settings: {},
    defaultEditSettings: {}
  },
  remoteRender: false,
  _htmlCache: null,
  _jqueryXhr: null,
  renderOnLeave: false,
  initialize: function initialize(options) {
    var elType = this.get('elType'),
        elements = this.get('elements');

    if (undefined !== elements) {
      var ElementsCollection = __webpack_require__(267);

      this.set('elements', new ElementsCollection(elements));
    }

    if ('widget' === elType) {
      this.remoteRender = true;
      this.setHtmlCache(options.htmlCache || '');
    } // No need this variable anymore


    delete options.htmlCache; // Make call to remote server as throttle function

    this.renderRemoteServer = _.throttle(this.renderRemoteServer, 1000);
    this.initSettings();
    this.initEditSettings();
    this.on({
      destroy: this.onDestroy,
      'editor:close': this.onCloseEditor
    });
  },
  initSettings: function initSettings() {
    var elType = this.get('elType'),
        settings = this.get('settings'),
        settingModels = {
      column: ColumnSettingsModel
    },
        SettingsModel = settingModels[elType] || elementorModules.editor.elements.models.BaseSettings;

    if (jQuery.isEmptyObject(settings)) {
      settings = elementorCommon.helpers.cloneObject(settings);
    }

    if ('widget' === elType) {
      settings.widgetType = this.get('widgetType');
    }

    settings.elType = elType;
    settings.isInner = this.get('isInner');
    settings = new SettingsModel(settings, {
      controls: elementor.getElementControls(this)
    });
    this.set('settings', settings);
    elementorFrontend.config.elements.data[this.cid] = settings;
  },
  initEditSettings: function initEditSettings() {
    var editSettings = new Backbone.Model(this.get('defaultEditSettings'));
    this.set('editSettings', editSettings);
    elementorFrontend.config.elements.editSettings[this.cid] = editSettings;
  },
  setSetting: function setSetting(key, value) {
    var settings = this.get('settings');

    if ('object' !== (0, _typeof2.default)(key)) {
      var keyParts = key.split('.'),
          isRepeaterKey = 3 === keyParts.length;
      key = keyParts[0];

      if (isRepeaterKey) {
        settings = settings.get(key).models[keyParts[1]];
        key = keyParts[2];
      }
    }

    settings.setExternalChange(key, value);
  },
  getSetting: function getSetting(key) {
    var keyParts = key.split('.'),
        isRepeaterKey = 3 === keyParts.length,
        settings = this.get('settings');
    key = keyParts[0];
    var value = settings.get(key);

    if (undefined === value) {
      return '';
    }

    if (isRepeaterKey) {
      value = value.models[keyParts[1]].get(keyParts[2]);
    }

    return value;
  },
  setHtmlCache: function setHtmlCache(htmlCache) {
    this._htmlCache = htmlCache;
  },
  getHtmlCache: function getHtmlCache() {
    return this._htmlCache;
  },
  getDefaultTitle: function getDefaultTitle() {
    return elementor.getElementData(this).title;
  },
  getTitle: function getTitle() {
    var title = this.getSetting('_title');

    if (!title) {
      title = this.getDefaultTitle();
    }

    return title;
  },
  getIcon: function getIcon() {
    return elementor.getElementData(this).icon;
  },
  createRemoteRenderRequest: function createRemoteRenderRequest() {
    var data = this.toJSON();
    return elementorCommon.ajax.addRequest('render_widget', {
      unique_id: this.cid,
      data: {
        data: data
      },
      success: this.onRemoteGetHtml.bind(this)
    }, true).jqXhr;
  },
  renderRemoteServer: function renderRemoteServer() {
    if (!this.remoteRender) {
      return;
    }

    this.renderOnLeave = false;
    this.trigger('before:remote:render');

    if (this.isRemoteRequestActive()) {
      this._jqueryXhr.abort();
    }

    this._jqueryXhr = this.createRemoteRenderRequest();
  },
  isRemoteRequestActive: function isRemoteRequestActive() {
    return this._jqueryXhr && 4 !== this._jqueryXhr.readyState;
  },
  onRemoteGetHtml: function onRemoteGetHtml(data) {
    this.setHtmlCache(data.render);
    this.trigger('remote:render');
  },
  clone: function clone() {
    var newModel = new this.constructor(elementorCommon.helpers.cloneObject(this.attributes));
    newModel.set('id', elementor.helpers.getUniqueID());
    newModel.setHtmlCache(this.getHtmlCache());
    var elements = this.get('elements');

    if (!_.isEmpty(elements)) {
      newModel.set('elements', elements.clone());
    }

    return newModel;
  },
  toJSON: function toJSON(options) {
    options = options || {}; // Call parent's toJSON method

    var data = Backbone.Model.prototype.toJSON.call(this);

    _.each(data, function (attribute, key) {
      if (attribute && attribute.toJSON) {
        data[key] = attribute.toJSON(options);
      }
    });

    if (options.copyHtmlCache) {
      data.htmlCache = this.getHtmlCache();
    } else {
      delete data.htmlCache;
    }

    if (options.remove) {
      options.remove.forEach(function (key) {
        return delete data[key];
      });
    }

    return data;
  },
  onCloseEditor: function onCloseEditor() {
    if (this.renderOnLeave) {
      this.renderRemoteServer();
    }
  },
  onDestroy: function onDestroy() {
    // Clean the memory for all use instances
    var settings = this.get('settings'),
        elements = this.get('elements');

    if (undefined !== elements) {
      _.each(_.clone(elements.models), function (model) {
        model.destroy();
      });
    }

    settings.destroy();
  }
});
ElementModel.prototype.sync = ElementModel.prototype.fetch = ElementModel.prototype.save = _.noop;
module.exports = ElementModel;

/***/ }),
/* 267 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var ElementModel = __webpack_require__(266);

var ElementsCollection = Backbone.Collection.extend({
  add: function add(models, options, isCorrectSet) {
    if ((!options || !options.silent) && !isCorrectSet) {
      throw 'Call Error: Adding model to element collection is allowed only by the dedicated addChildModel() method.';
    }

    return Backbone.Collection.prototype.add.call(this, models, options);
  },
  model: function model(attrs, options) {
    var ModelClass = Backbone.Model;

    if (attrs.elType) {
      ModelClass = elementor.hooks.applyFilters('element/model', ElementModel, attrs);
    }

    return new ModelClass(attrs, options);
  },
  clone: function clone() {
    var tempCollection = Backbone.Collection.prototype.clone.apply(this, arguments),
        newCollection = new ElementsCollection();
    tempCollection.forEach(function (model) {
      newCollection.add(model.clone(), null, true);
    });
    return newCollection;
  }
});
ElementsCollection.prototype.sync = ElementsCollection.prototype.fetch = ElementsCollection.prototype.save = _.noop;
module.exports = ElementsCollection;

/***/ }),
/* 268 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


__webpack_require__(30);

module.exports = elementorModules.Module.extend({
  getDefaultSettings: function getDefaultSettings() {
    return {
      actions: {},
      classes: {
        list: 'elementor-context-menu-list',
        group: 'elementor-context-menu-list__group',
        groupPrefix: 'elementor-context-menu-list__group-',
        item: 'elementor-context-menu-list__item',
        itemTypePrefix: 'elementor-context-menu-list__item-',
        itemTitle: 'elementor-context-menu-list__item__title',
        itemShortcut: 'elementor-context-menu-list__item__shortcut',
        iconShortcut: 'elementor-context-menu-list__item__icon',
        itemDisabled: 'elementor-context-menu-list__item--disabled',
        divider: 'elementor-context-menu-list__divider',
        hidden: 'elementor-hidden'
      }
    };
  },
  buildActionItem: function buildActionItem(action) {
    var self = this,
        classes = self.getSettings('classes'),
        $item = jQuery('<div>', {
      class: classes.item + ' ' + classes.itemTypePrefix + action.name
    }),
        $itemTitle = jQuery('<div>', {
      class: classes.itemTitle
    }).text(action.title),
        $itemIcon = jQuery('<div>', {
      class: classes.iconShortcut
    });

    if (action.icon) {
      $itemIcon.html(jQuery('<i>', {
        class: action.icon
      }));
    }

    $item.append($itemIcon, $itemTitle);

    if (action.shortcut) {
      var $itemShortcut = jQuery('<div>', {
        class: classes.itemShortcut
      }).html(action.shortcut);
      $item.append($itemShortcut);
    }

    if (action.callback) {
      $item.on('click', function () {
        self.runAction(action);
      });
    }

    action.$item = $item;
    return $item;
  },
  buildActionsList: function buildActionsList() {
    var self = this,
        classes = self.getSettings('classes'),
        groups = self.getSettings('groups'),
        $list = jQuery('<div>', {
      class: classes.list
    });
    groups.forEach(function (group) {
      var $group = jQuery('<div>', {
        class: classes.group + ' ' + classes.groupPrefix + group.name
      });
      group.actions.forEach(function (action) {
        $group.append(self.buildActionItem(action));
      });
      $list.append($group);
      group.$item = $group;
    });
    return $list;
  },
  toggleGroupVisibility: function toggleGroupVisibility(group, state) {
    group.$item.toggleClass(this.getSettings('classes.hidden'), !state);
  },
  toggleActionVisibility: function toggleActionVisibility(action, state) {
    action.$item.toggleClass(this.getSettings('classes.hidden'), !state);
  },
  toggleActionUsability: function toggleActionUsability(action, state) {
    action.$item.toggleClass(this.getSettings('classes.itemDisabled'), !state);
  },
  isActionEnabled: function isActionEnabled(action) {
    if (!action.callback && !action.groups) {
      return false;
    }

    return action.isEnabled ? action.isEnabled() : true;
  },
  runAction: function runAction(action) {
    if (!this.isActionEnabled(action)) {
      return;
    }

    action.callback();
    this.getModal().hide();
  },
  initModal: function initModal() {
    var modal;

    this.getModal = function () {
      if (!modal) {
        modal = elementorCommon.dialogsManager.createWidget('simple', {
          className: 'elementor-context-menu',
          message: this.buildActionsList(),
          iframe: elementor.$preview,
          effects: {
            hide: 'hide',
            show: 'show'
          },
          hide: {
            onOutsideContextMenu: true
          },
          position: {
            my: (elementorCommon.config.isRTL ? 'right' : 'left') + ' top',
            collision: 'fit'
          }
        });
      }

      return modal;
    };
  },
  show: function show(event) {
    var self = this,
        modal = self.getModal();
    modal.setSettings('position', {
      of: event
    });
    self.getSettings('groups').forEach(function (group) {
      var isGroupVisible = false !== group.isVisible;
      self.toggleGroupVisibility(group, isGroupVisible);

      if (isGroupVisible) {
        group.actions.forEach(function (action) {
          var isActionVisible = false !== action.isVisible;
          self.toggleActionVisibility(action, isActionVisible);

          if (isActionVisible) {
            self.toggleActionUsability(action, self.isActionEnabled(action));
          }
        });
      }
    });
    modal.show();
  },
  destroy: function destroy() {
    this.getModal().destroy();
  },
  onInit: function onInit() {
    this.initModal();
  }
});

/***/ }),
/* 269 */
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

var _possibleConstructorReturn2 = _interopRequireDefault(__webpack_require__(5));

var _getPrototypeOf2 = _interopRequireDefault(__webpack_require__(4));

var _get2 = _interopRequireDefault(__webpack_require__(28));

var _inherits2 = _interopRequireDefault(__webpack_require__(6));

var _base = _interopRequireDefault(__webpack_require__(242));

var AddSectionView =
/*#__PURE__*/
function (_BaseAddSectionView) {
  (0, _inherits2.default)(AddSectionView, _BaseAddSectionView);

  function AddSectionView() {
    (0, _classCallCheck2.default)(this, AddSectionView);
    return (0, _possibleConstructorReturn2.default)(this, (0, _getPrototypeOf2.default)(AddSectionView).apply(this, arguments));
  }

  (0, _createClass2.default)(AddSectionView, [{
    key: "className",
    value: function className() {
      return (0, _get2.default)((0, _getPrototypeOf2.default)(AddSectionView.prototype), "className", this).call(this) + ' elementor-add-section-inline';
    }
  }, {
    key: "fadeToDeath",
    value: function fadeToDeath() {
      var self = this;
      self.$el.slideUp(function () {
        self.destroy();
      });
    }
  }, {
    key: "onAfterPaste",
    value: function onAfterPaste() {
      (0, _get2.default)((0, _getPrototypeOf2.default)(AddSectionView.prototype), "onAfterPaste", this).call(this);
      this.destroy();
    }
  }, {
    key: "onCloseButtonClick",
    value: function onCloseButtonClick() {
      this.fadeToDeath();
    }
  }, {
    key: "onPresetSelected",
    value: function onPresetSelected(event) {
      (0, _get2.default)((0, _getPrototypeOf2.default)(AddSectionView.prototype), "onPresetSelected", this).call(this, event);
      this.destroy();
    }
  }, {
    key: "onAddTemplateButtonClick",
    value: function onAddTemplateButtonClick() {
      (0, _get2.default)((0, _getPrototypeOf2.default)(AddSectionView.prototype), "onAddTemplateButtonClick", this).call(this);
      this.destroy();
    }
  }, {
    key: "onDropping",
    value: function onDropping() {
      (0, _get2.default)((0, _getPrototypeOf2.default)(AddSectionView.prototype), "onDropping", this).call(this);
      this.destroy();
    }
  }]);
  return AddSectionView;
}(_base.default);

var _default = AddSectionView;
exports.default = _default;

/***/ }),
/* 270 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var _section = __webpack_require__(178);

var BaseElementView = __webpack_require__(200),
    ColumnEmptyView = __webpack_require__(271),
    ColumnView;

ColumnView = BaseElementView.extend({
  template: Marionette.TemplateCache.get('#tmpl-elementor-column-content'),
  emptyView: ColumnEmptyView,
  childViewContainer: '> .elementor-column-wrap > .elementor-widget-wrap',
  toggleEditTools: true,
  behaviors: function behaviors() {
    var behaviors = BaseElementView.prototype.behaviors.apply(this, arguments);

    _.extend(behaviors, {
      Sortable: {
        behaviorClass: __webpack_require__(201),
        elChildType: 'widget'
      },
      Resizable: {
        behaviorClass: __webpack_require__(272)
      }
    });

    return elementor.hooks.applyFilters('elements/column/behaviors', behaviors, this);
  },
  className: function className() {
    var classes = BaseElementView.prototype.className.apply(this, arguments),
        type = this.isInner() ? 'inner' : 'top';
    return classes + ' elementor-column elementor-' + type + '-column';
  },
  tagName: function tagName() {
    return this.model.getSetting('html_tag') || 'div';
  },
  ui: function ui() {
    var ui = BaseElementView.prototype.ui.apply(this, arguments);
    ui.columnInner = '> .elementor-column-wrap';
    ui.percentsTooltip = '> .elementor-element-overlay .elementor-column-percents-tooltip';
    return ui;
  },
  getEditButtons: function getEditButtons() {
    var elementData = elementor.getElementData(this.model),
        editTools = {};
    editTools.edit = {
      title: elementor.translate('edit_element', [elementData.title]),
      icon: 'column'
    };

    if (elementor.getPreferences('edit_buttons')) {
      editTools.duplicate = {
        title: elementor.translate('duplicate_element', [elementData.title]),
        icon: 'clone'
      };
      editTools.add = {
        title: elementor.translate('add_element', [elementData.title]),
        icon: 'plus'
      };
      editTools.remove = {
        title: elementor.translate('delete_element', [elementData.title]),
        icon: 'close'
      };
    }

    return editTools;
  },
  initialize: function initialize() {
    BaseElementView.prototype.initialize.apply(this, arguments);
  },
  attachElContent: function attachElContent() {
    BaseElementView.prototype.attachElContent.apply(this, arguments);
    var $tooltip = jQuery('<div>', {
      class: 'elementor-column-percents-tooltip'
    });
    this.$el.children('.elementor-element-overlay').append($tooltip);
  },
  getContextMenuGroups: function getContextMenuGroups() {
    var self = this,
        groups = BaseElementView.prototype.getContextMenuGroups.apply(this, arguments),
        generalGroupIndex = groups.indexOf(_.findWhere(groups, {
      name: 'general'
    }));
    groups.splice(generalGroupIndex + 1, 0, {
      name: 'addNew',
      actions: [{
        name: 'addNew',
        icon: 'eicon-plus',
        title: elementor.translate('new_column'),
        callback: this.addNewColumn.bind(this),
        isEnabled: function isEnabled() {
          return self.model.collection.length < _section.DEFAULT_MAX_COLUMNS;
        }
      }]
    });
    return groups;
  },
  isDroppingAllowed: function isDroppingAllowed() {
    var elementView = elementor.channels.panelElements.request('element:selected');

    if (!elementView) {
      return false;
    }

    var elType = elementView.model.get('elType');

    if ('section' === elType) {
      return !this.isInner();
    }

    return 'widget' === elType;
  },
  getPercentsForDisplay: function getPercentsForDisplay() {
    var inlineSize = +this.model.getSetting('_inline_size') || this.getPercentSize();
    return inlineSize.toFixed(1) + '%';
  },
  changeSizeUI: function changeSizeUI() {
    var self = this,
        columnSize = self.model.getSetting('_column_size');
    self.$el.attr('data-col', columnSize);

    _.defer(function () {
      // Wait for the column size to be applied
      if (self.ui.percentsTooltip) {
        self.ui.percentsTooltip.text(self.getPercentsForDisplay());
      }
    });
  },
  getPercentSize: function getPercentSize(size) {
    if (!size) {
      size = this.el.getBoundingClientRect().width;
    }

    return +(size / this.$el.parent().width() * 100).toFixed(3);
  },
  getSortableOptions: function getSortableOptions() {
    return {
      connectWith: '.elementor-widget-wrap',
      items: '> .elementor-element'
    };
  },
  changeChildContainerClasses: function changeChildContainerClasses() {
    var emptyClass = 'elementor-element-empty',
        populatedClass = 'elementor-element-populated';

    if (this.collection.isEmpty()) {
      this.ui.columnInner.removeClass(populatedClass).addClass(emptyClass);
    } else {
      this.ui.columnInner.removeClass(emptyClass).addClass(populatedClass);
    }
  },
  addNewColumn: function addNewColumn() {
    $e.run('document/elements/create', {
      model: {
        elType: 'column'
      },
      container: this.getContainer().parent,
      options: {
        at: this.$el.index() + 1
      }
    });
  },
  onRender: function onRender() {
    var self = this;
    BaseElementView.prototype.onRender.apply(self, arguments);
    self.changeChildContainerClasses();
    self.changeSizeUI();
    self.$el.html5Droppable({
      items: ' > .elementor-column-wrap > .elementor-widget-wrap > .elementor-element, >.elementor-column-wrap > .elementor-widget-wrap > .elementor-empty-view > .elementor-first-add',
      axis: ['vertical'],
      groups: ['elementor-element'],
      isDroppingAllowed: self.isDroppingAllowed.bind(self),
      currentElementClass: 'elementor-html5dnd-current-element',
      placeholderClass: 'elementor-sortable-placeholder elementor-widget-placeholder',
      hasDraggingOnChildClass: 'elementor-dragging-on-child',
      onDropping: function onDropping(side, event) {
        event.stopPropagation(); // Triggering drag end manually, since it won't fired above iframe

        elementor.getPreviewView().onPanelElementDragEnd();
        var newIndex = jQuery(this).index();

        if ('bottom' === side) {
          newIndex++;
        }

        self.addElementFromPanel({
          at: newIndex
        });
      }
    });
  },
  onAddButtonClick: function onAddButtonClick(event) {
    event.stopPropagation();
    this.addNewColumn();
  }
});
module.exports = ColumnView;

/***/ }),
/* 271 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var _interopRequireDefault = __webpack_require__(0);

var _helpers = _interopRequireDefault(__webpack_require__(109));

module.exports = Marionette.ItemView.extend({
  template: '#tmpl-elementor-empty-preview',
  className: 'elementor-empty-view',
  events: {
    click: 'onClickAdd'
  },
  behaviors: function behaviors() {
    return {
      contextMenu: {
        behaviorClass: __webpack_require__(186),
        groups: this.getContextMenuGroups()
      }
    };
  },
  getContextMenuGroups: function getContextMenuGroups() {
    var _this = this;

    return [{
      name: 'general',
      actions: [{
        name: 'paste',
        title: elementor.translate('paste'),
        isEnabled: function isEnabled() {
          return _helpers.default.isPasteEnabled(_this._parent.getContainer());
        },
        callback: function callback() {
          return $e.run('document/ui/paste', {
            container: _this._parent.getContainer()
          });
        }
      }]
    }];
  },
  onClickAdd: function onClickAdd() {
    $e.route('panel/elements/categories');
  }
});

/***/ }),
/* 272 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var ResizableBehavior;
ResizableBehavior = Marionette.Behavior.extend({
  defaults: {
    handles: elementorCommon.config.isRTL ? 'w' : 'e'
  },
  events: {
    resizestart: 'onResizeStart',
    resizestop: 'onResizeStop',
    resize: 'onResize'
  },
  initialize: function initialize() {
    Marionette.Behavior.prototype.initialize.apply(this, arguments);
    this.listenTo(elementor.channels.dataEditMode, 'switch', this.onEditModeSwitched);
  },
  active: function active() {
    if (!elementor.userCan('design')) {
      return;
    }

    this.deactivate();

    var options = _.clone(this.options);

    delete options.behaviorClass;

    var $childViewContainer = this.getChildViewContainer(),
        defaultResizableOptions = {},
        resizableOptions = _.extend(defaultResizableOptions, options);

    $childViewContainer.resizable(resizableOptions);
  },
  deactivate: function deactivate() {
    if (this.getChildViewContainer().resizable('instance')) {
      this.getChildViewContainer().resizable('destroy');
    }
  },
  onEditModeSwitched: function onEditModeSwitched(activeMode) {
    if ('edit' === activeMode) {
      this.active();
    } else {
      this.deactivate();
    }
  },
  onRender: function onRender() {
    var self = this;

    _.defer(function () {
      self.onEditModeSwitched(elementor.channels.dataEditMode.request('activeMode'));
    });
  },
  onDestroy: function onDestroy() {
    this.deactivate();
  },
  onResizeStart: function onResizeStart(event) {
    event.stopPropagation();
    this.view.$el.data('originalWidth', this.view.el.getBoundingClientRect().width);
    this.view.triggerMethod('request:resize:start', event);
  },
  onResizeStop: function onResizeStop(event) {
    event.stopPropagation();
    this.view.triggerMethod('request:resize:stop');
  },
  onResize: function onResize(event, ui) {
    event.stopPropagation();
    this.view.triggerMethod('request:resize', ui, event);
  },
  getChildViewContainer: function getChildViewContainer() {
    return this.$el;
  }
});
module.exports = ResizableBehavior;

/***/ }),
/* 273 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


__webpack_require__(225);

module.exports = Marionette.ItemView.extend({
  template: '#tmpl-elementor-panel-global',
  id: 'elementor-panel-global',
  initialize: function initialize() {
    elementor.getPanelView().getCurrentPageView().search.reset();
  }
});

/***/ }),
/* 274 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


module.exports = Marionette.ItemView.extend({
  template: '#tmpl-elementor-element-library-element',
  className: 'elementor-element-wrapper',
  ui: {
    element: '.elementor-element'
  },
  onRender: function onRender() {
    var _this = this;

    if (!elementor.userCan('design')) {
      return;
    }

    this.ui.element.html5Draggable({
      onDragStart: function onDragStart() {
        elementor.channels.panelElements.reply('element:selected', _this).trigger('element:drag:start');
      },
      onDragEnd: function onDragEnd() {
        elementor.channels.panelElements.trigger('element:drag:end');
      },
      groups: ['elementor-element']
    });
  }
});

/***/ }),
/* 275 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";

/**
 * Handles managing all events for whatever you plug it into. Priorities for hooks are based on lowest to highest in
 * that, lowest priority hooks are fired first.
 */

var _interopRequireDefault = __webpack_require__(0);

var _parseInt2 = _interopRequireDefault(__webpack_require__(174));

var EventManager = function EventManager() {
  var slice = Array.prototype.slice,
      MethodsAvailable;
  /**
   * Contains the hooks that get registered with this EventManager. The array for storage utilizes a "flat"
   * object literal such that looking up the hook utilizes the native object literal hash.
   */

  var STORAGE = {
    actions: {},
    filters: {}
  };
  /**
   * Removes the specified hook by resetting the value of it.
   *
   * @param type Type of hook, either 'actions' or 'filters'
   * @param hook The hook (namespace.identifier) to remove
   *
   * @private
   */

  function _removeHook(type, hook, callback, context) {
    var handlers, handler, i;

    if (!STORAGE[type][hook]) {
      return;
    }

    if (!callback) {
      STORAGE[type][hook] = [];
    } else {
      handlers = STORAGE[type][hook];

      if (!context) {
        for (i = handlers.length; i--;) {
          if (handlers[i].callback === callback) {
            handlers.splice(i, 1);
          }
        }
      } else {
        for (i = handlers.length; i--;) {
          handler = handlers[i];

          if (handler.callback === callback && handler.context === context) {
            handlers.splice(i, 1);
          }
        }
      }
    }
  }
  /**
   * Use an insert sort for keeping our hooks organized based on priority. This function is ridiculously faster
   * than bubble sort, etc: http://jsperf.com/javascript-sort
   *
   * @param hooks The custom array containing all of the appropriate hooks to perform an insert sort on.
   * @private
   */


  function _hookInsertSort(hooks) {
    var tmpHook, j, prevHook;

    for (var i = 1, len = hooks.length; i < len; i++) {
      tmpHook = hooks[i];
      j = i;

      while ((prevHook = hooks[j - 1]) && prevHook.priority > tmpHook.priority) {
        hooks[j] = hooks[j - 1];
        --j;
      }

      hooks[j] = tmpHook;
    }

    return hooks;
  }
  /**
   * Adds the hook to the appropriate storage container
   *
   * @param type 'actions' or 'filters'
   * @param hook The hook (namespace.identifier) to add to our event manager
   * @param callback The function that will be called when the hook is executed.
   * @param priority The priority of this hook. Must be an integer.
   * @param [context] A value to be used for this
   * @private
   */


  function _addHook(type, hook, callback, priority, context) {
    var hookObject = {
      callback: callback,
      priority: priority,
      context: context
    }; // Utilize 'prop itself' : http://jsperf.com/hasownproperty-vs-in-vs-undefined/19

    var hooks = STORAGE[type][hook];

    if (hooks) {
      // TEMP FIX BUG
      var hasSameCallback = false;
      jQuery.each(hooks, function () {
        if (this.callback === callback) {
          hasSameCallback = true;
          return false;
        }
      });

      if (hasSameCallback) {
        return;
      } // END TEMP FIX BUG


      hooks.push(hookObject);
      hooks = _hookInsertSort(hooks);
    } else {
      hooks = [hookObject];
    }

    STORAGE[type][hook] = hooks;
  }
  /**
   * Runs the specified hook. If it is an action, the value is not modified but if it is a filter, it is.
   *
   * @param type 'actions' or 'filters'
   * @param hook The hook ( namespace.identifier ) to be ran.
   * @param args Arguments to pass to the action/filter. If it's a filter, args is actually a single parameter.
   * @private
   */


  function _runHook(type, hook, args) {
    var handlers = STORAGE[type][hook],
        i,
        len;

    if (!handlers) {
      return 'filters' === type ? args[0] : false;
    }

    len = handlers.length;

    if ('filters' === type) {
      for (i = 0; i < len; i++) {
        args[0] = handlers[i].callback.apply(handlers[i].context, args);
      }
    } else {
      for (i = 0; i < len; i++) {
        handlers[i].callback.apply(handlers[i].context, args);
      }
    }

    return 'filters' === type ? args[0] : true;
  }
  /**
   * Adds an action to the event manager.
   *
   * @param action Must contain namespace.identifier
   * @param callback Must be a valid callback function before this action is added
   * @param [priority=10] Used to control when the function is executed in relation to other callbacks bound to the same hook
   * @param [context] Supply a value to be used for this
   */


  function addAction(action, callback, priority, context) {
    if ('string' === typeof action && 'function' === typeof callback) {
      priority = (0, _parseInt2.default)(priority || 10, 10);

      _addHook('actions', action, callback, priority, context);
    }

    return MethodsAvailable;
  }
  /**
   * Performs an action if it exists. You can pass as many arguments as you want to this function; the only rule is
   * that the first argument must always be the action.
   */


  function doAction()
  /* action, arg1, arg2, ... */
  {
    var args = slice.call(arguments);
    var action = args.shift();

    if ('string' === typeof action) {
      _runHook('actions', action, args);
    }

    return MethodsAvailable;
  }
  /**
   * Removes the specified action if it contains a namespace.identifier & exists.
   *
   * @param action The action to remove
   * @param [callback] Callback function to remove
   */


  function removeAction(action, callback) {
    if ('string' === typeof action) {
      _removeHook('actions', action, callback);
    }

    return MethodsAvailable;
  }
  /**
   * Adds a filter to the event manager.
   *
   * @param filter Must contain namespace.identifier
   * @param callback Must be a valid callback function before this action is added
   * @param [priority=10] Used to control when the function is executed in relation to other callbacks bound to the same hook
   * @param [context] Supply a value to be used for this
   */


  function addFilter(filter, callback, priority, context) {
    if ('string' === typeof filter && 'function' === typeof callback) {
      priority = (0, _parseInt2.default)(priority || 10, 10);

      _addHook('filters', filter, callback, priority, context);
    }

    return MethodsAvailable;
  }
  /**
   * Performs a filter if it exists. You should only ever pass 1 argument to be filtered. The only rule is that
   * the first argument must always be the filter.
   */


  function applyFilters()
  /* filter, filtered arg, arg2, ... */
  {
    var args = slice.call(arguments);
    var filter = args.shift();

    if ('string' === typeof filter) {
      return _runHook('filters', filter, args);
    }

    return MethodsAvailable;
  }
  /**
   * Removes the specified filter if it contains a namespace.identifier & exists.
   *
   * @param filter The action to remove
   * @param [callback] Callback function to remove
   */


  function removeFilter(filter, callback) {
    if ('string' === typeof filter) {
      _removeHook('filters', filter, callback);
    }

    return MethodsAvailable;
  }
  /**
   * Maintain a reference to the object scope so our public methods never get confusing.
   */


  MethodsAvailable = {
    removeFilter: removeFilter,
    applyFilters: applyFilters,
    addFilter: addFilter,
    removeAction: removeAction,
    doAction: doAction,
    addAction: addAction
  }; // return all of the publicly available methods

  return MethodsAvailable;
};

module.exports = EventManager;

/***/ }),
/* 276 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var PanelElementsElementModel;
PanelElementsElementModel = Backbone.Model.extend({
  defaults: {
    title: '',
    categories: [],
    keywords: [],
    icon: '',
    elType: 'widget',
    widgetType: ''
  }
});
module.exports = PanelElementsElementModel;

/***/ }),
/* 277 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var PanelElementsElementModel = __webpack_require__(276),
    PanelElementsElementsCollection;

PanelElementsElementsCollection = Backbone.Collection.extend({
  model: PanelElementsElementModel
  /*,
  comparator: 'title'*/

});
module.exports = PanelElementsElementsCollection;

/***/ }),
/* 278 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var childViewTypes = {
  color: __webpack_require__(454),
  typography: __webpack_require__(455)
},
    PanelSchemeBaseView;
PanelSchemeBaseView = Marionette.CompositeView.extend({
  id: function id() {
    return 'elementor-panel-scheme-' + this.getType();
  },
  className: function className() {
    return 'elementor-panel-scheme elementor-panel-scheme-' + this.getUIType();
  },
  childViewContainer: '.elementor-panel-scheme-items',
  getTemplate: function getTemplate() {
    return Marionette.TemplateCache.get('#tmpl-elementor-panel-schemes-' + this.getType());
  },
  getChildView: function getChildView() {
    return childViewTypes[this.getUIType()];
  },
  getUIType: function getUIType() {
    return this.getType();
  },
  ui: function ui() {
    return {
      saveButton: '.elementor-panel-scheme-save .elementor-button',
      discardButton: '.elementor-panel-scheme-discard .elementor-button',
      resetButton: '.elementor-panel-scheme-reset .elementor-button'
    };
  },
  events: function events() {
    return {
      'click @ui.saveButton': 'saveScheme',
      'click @ui.discardButton': 'discardScheme',
      'click @ui.resetButton': 'setDefaultScheme'
    };
  },
  initialize: function initialize() {
    this.model = new Backbone.Model();
    this.resetScheme();
  },
  getType: function getType() {},
  getScheme: function getScheme() {
    return elementor.schemes.getScheme(this.getType());
  },
  changeChildrenUIValues: function changeChildrenUIValues(schemeItems) {
    var self = this;

    _.each(schemeItems, function (value, key) {
      var model = self.collection.findWhere({
        key: key
      }),
          childView = self.children.findByModelCid(model.cid);
      childView.changeUIValue(value);
    });
  },
  discardScheme: function discardScheme() {
    elementor.schemes.resetSchemes(this.getType());
    this.onSchemeChange();
    this.ui.saveButton.prop('disabled', true);

    this._renderChildren();
  },
  setSchemeValue: function setSchemeValue(key, value) {
    elementor.schemes.setSchemeValue(this.getType(), key, value);
    this.onSchemeChange();
  },
  saveScheme: function saveScheme() {
    NProgress.start();
    elementor.schemes.saveScheme(this.getType()).done(NProgress.done);
    this.ui.saveButton.prop('disabled', true);
    this.resetScheme();

    this._renderChildren();
  },
  setDefaultScheme: function setDefaultScheme() {
    var defaultScheme = elementor.config.default_schemes[this.getType()].items;
    this.changeChildrenUIValues(defaultScheme);
  },
  resetItems: function resetItems() {
    this.model.set('items', this.getScheme().items);
  },
  resetCollection: function resetCollection() {
    var self = this,
        items = self.model.get('items');
    self.collection = new Backbone.Collection();

    _.each(items, function (item, key) {
      item.type = self.getType();
      item.key = key;
      self.collection.add(item);
    });
  },
  resetScheme: function resetScheme() {
    this.resetItems();
    this.resetCollection();
  },
  onSchemeChange: function onSchemeChange() {
    elementor.schemes.printSchemesStyle();
  },
  onChildviewValueChange: function onChildviewValueChange(childView, newValue) {
    this.ui.saveButton.removeProp('disabled');
    this.setSchemeValue(childView.model.get('key'), newValue);
  }
});
module.exports = PanelSchemeBaseView;

/***/ }),
/* 279 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var PanelSchemeItemView;
PanelSchemeItemView = Marionette.ItemView.extend({
  getTemplate: function getTemplate() {
    return Marionette.TemplateCache.get('#tmpl-elementor-panel-scheme-' + this.getUIType() + '-item');
  },
  className: function className() {
    return 'elementor-panel-scheme-item';
  }
});
module.exports = PanelSchemeItemView;

/***/ }),
/* 280 */,
/* 281 */,
/* 282 */,
/* 283 */,
/* 284 */,
/* 285 */,
/* 286 */,
/* 287 */,
/* 288 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var _interopRequireDefault = __webpack_require__(0);

var _independent = _interopRequireDefault(__webpack_require__(460));

var _rightClickIntroduction = _interopRequireDefault(__webpack_require__(461));

var _helpers = _interopRequireDefault(__webpack_require__(109));

var BaseSectionsContainerView = __webpack_require__(462);

var Preview = BaseSectionsContainerView.extend({
  template: Marionette.TemplateCache.get('#tmpl-elementor-preview'),
  className: 'elementor-inner',
  childViewContainer: '.elementor-section-wrap',
  behaviors: function behaviors() {
    var parentBehaviors = BaseSectionsContainerView.prototype.behaviors.apply(this, arguments),
        behaviors = {
      contextMenu: {
        behaviorClass: __webpack_require__(186),
        groups: this.getContextMenuGroups()
      }
    }; // TODO: the `2` check is for BC reasons

    if (!elementor.config.user.introduction.rightClick && !elementor.config.user.introduction[2]) {
      behaviors.introduction = {
        behaviorClass: _rightClickIntroduction.default
      };
    }

    return jQuery.extend(parentBehaviors, behaviors);
  },
  getContainer: function getContainer() {
    return elementor.settings.page.getEditedView().getContainer();
  },
  getContextMenuGroups: function getContextMenuGroups() {
    var _this = this;

    var hasContent = function hasContent() {
      return elementor.elements.length > 0;
    };

    return [{
      name: 'paste',
      actions: [{
        name: 'paste',
        title: elementor.translate('paste'),
        isEnabled: function isEnabled() {
          return _helpers.default.isPasteEnabled(_this.getContainer());
        },
        callback: function callback(at) {
          return $e.run('document/ui/paste', {
            container: _this.getContainer(),
            options: {
              at: at,
              rebuild: true
            }
          });
        }
      }]
    }, {
      name: 'content',
      actions: [{
        name: 'copy_all_content',
        title: elementor.translate('copy_all_content'),
        isEnabled: hasContent,
        callback: function callback() {
          return $e.run('document/elements/copy-all');
        }
      }, {
        name: 'delete_all_content',
        title: elementor.translate('delete_all_content'),
        isEnabled: hasContent,
        callback: function callback() {
          return $e.run('document/elements/empty');
        }
      }]
    }];
  },
  onRender: function onRender() {
    if (!elementor.userCan('design')) {
      return;
    }

    var addNewSectionView = new _independent.default();
    addNewSectionView.render();
    this.$el.append(addNewSectionView.$el);
  }
});
module.exports = Preview;

/***/ }),
/* 289 */,
/* 290 */,
/* 291 */,
/* 292 */,
/* 293 */,
/* 294 */,
/* 295 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var _interopRequireDefault = __webpack_require__(0);

__webpack_require__(15);

var _heartbeat = _interopRequireDefault(__webpack_require__(296));

var _navigator = _interopRequireDefault(__webpack_require__(297));

var _hotkeys = _interopRequireDefault(__webpack_require__(303));

var _environment = _interopRequireDefault(__webpack_require__(182));

var _dateTime = _interopRequireDefault(__webpack_require__(307));

var _noticeBar = _interopRequireDefault(__webpack_require__(312));

var _iconsManager = _interopRequireDefault(__webpack_require__(313));

var _color = _interopRequireDefault(__webpack_require__(350));

/* global ElementorConfig */
var App = Marionette.Application.extend({
  loaded: false,
  previewLoadedOnce: false,
  helpers: __webpack_require__(351),
  imagesManager: __webpack_require__(355),
  debug: __webpack_require__(356),
  schemes: __webpack_require__(357),
  presetsFactory: __webpack_require__(358),
  templates: __webpack_require__(359),
  // TODO: BC Since 2.3.0
  ajax: elementorCommon.ajax,
  conditions: __webpack_require__(376),
  history: __webpack_require__(377),
  channels: {
    editor: Backbone.Radio.channel('ELEMENTOR:editor'),
    data: Backbone.Radio.channel('ELEMENTOR:data'),
    panelElements: Backbone.Radio.channel('ELEMENTOR:panelElements'),
    dataEditMode: Backbone.Radio.channel('ELEMENTOR:editmode'),
    deviceMode: Backbone.Radio.channel('ELEMENTOR:deviceMode'),
    templates: Backbone.Radio.channel('ELEMENTOR:templates')
  },

  /**
   * Exporting modules that can be used externally
   * @TODO: All of the following entries should move to `elementorModules.editor`
   */
  modules: {
    // TODO: Deprecated alias since 2.3.0
    get Module() {
      elementorCommon.helpers.hardDeprecated('elementor.modules.Module', '2.3.0', 'elementorModules.Module');
      return elementorModules.Module;
    },

    components: {
      templateLibrary: {
        views: {
          // TODO: Deprecated alias since 2.4.0
          get BaseModalLayout() {
            elementorCommon.helpers.hardDeprecated('elementor.modules.components.templateLibrary.views.BaseModalLayout', '2.4.0', 'elementorModules.common.views.modal.Layout');
            return elementorModules.common.views.modal.Layout;
          }

        }
      },
      saver: {
        behaviors: {
          FooterSaver: __webpack_require__(394)
        }
      }
    },
    controls: {
      Animation: __webpack_require__(185),
      Base: __webpack_require__(191),
      BaseData: __webpack_require__(65),
      BaseMultiple: __webpack_require__(156),
      Box_shadow: __webpack_require__(261),
      Button: __webpack_require__(395),
      Choose: __webpack_require__(262),
      Code: __webpack_require__(396),
      Color: _color.default,
      Date_time: _dateTime.default,
      Dimensions: __webpack_require__(397),
      Exit_animation: __webpack_require__(185),
      Font: __webpack_require__(400),
      Gallery: __webpack_require__(401),
      Hidden: __webpack_require__(402),
      Hover_animation: __webpack_require__(185),
      Icon: __webpack_require__(403),
      Icons: __webpack_require__(404),
      Image_dimensions: __webpack_require__(405),
      Media: __webpack_require__(406),
      Number: __webpack_require__(407),
      Order: __webpack_require__(409),
      Popover_toggle: __webpack_require__(410),
      Repeater: __webpack_require__(411),
      RepeaterRow: __webpack_require__(264),
      Section: __webpack_require__(412),
      Select: __webpack_require__(413),
      Select2: __webpack_require__(185),
      Slider: __webpack_require__(414),
      Structure: __webpack_require__(415),
      Switcher: __webpack_require__(416),
      Tab: __webpack_require__(417),
      Text_shadow: __webpack_require__(261),
      Url: __webpack_require__(418),
      Wp_widget: __webpack_require__(419),
      Wysiwyg: __webpack_require__(420)
    },
    elements: {
      models: {
        // TODO: Deprecated alias since 2.4.0
        get BaseSettings() {
          elementorCommon.helpers.hardDeprecated('elementor.modules.elements.models.BaseSettings', '2.4.0', 'elementorModules.editor.elements.models.BaseSettings');
          return elementorModules.editor.elements.models.BaseSettings;
        },

        Element: __webpack_require__(266)
      },
      views: {
        Widget: __webpack_require__(422)
      }
    },
    layouts: {
      panel: {
        pages: {
          elements: {
            views: {
              Global: __webpack_require__(273),
              Elements: __webpack_require__(426)
            }
          },
          menu: {
            Menu: __webpack_require__(427)
          }
        }
      }
    },
    views: {
      // TODO: Deprecated alias since 2.4.0
      get ControlsStack() {
        elementorCommon.helpers.hardDeprecated('elementor.modules.views.ControlsStack', '2.4.0', 'elementorModules.editor.views.ControlsStack');
        return elementorModules.editor.views.ControlsStack;
      }

    }
  },
  backgroundClickListeners: {
    popover: {
      element: '.elementor-controls-popover',
      ignore: '.elementor-control-popover-toggle-toggle, .elementor-control-popover-toggle-toggle-label, .select2-container'
    },
    tagsList: {
      element: '.elementor-tags-list',
      ignore: '.elementor-control-dynamic-switcher'
    },
    panelFooterSubMenus: {
      element: '.elementor-panel-footer-tool.elementor-toggle-state',
      ignore: '.elementor-panel-footer-tool.elementor-toggle-state, #elementor-panel-saver-button-publish-label',
      callback: function callback($elementsToHide) {
        $elementsToHide.removeClass('elementor-open');
      }
    },
    panelResponsiveSwitchers: {
      element: '.elementor-control-responsive-switchers',
      callback: function callback($elementsToHide) {
        $elementsToHide.removeClass('elementor-responsive-switchers-open');
      }
    }
  },
  userCan: function userCan(capability) {
    return -1 === this.config.user.restrictions.indexOf(capability);
  },
  _defaultDeviceMode: 'desktop',
  addControlView: function addControlView(controlID, ControlView) {
    this.modules.controls[elementorCommon.helpers.upperCaseWords(controlID)] = ControlView;
  },
  checkEnvCompatibility: function checkEnvCompatibility() {
    return _environment.default.firefox || _environment.default.webkit;
  },
  getElementData: function getElementData(model) {
    var elType = model.get('elType');

    if ('widget' === elType) {
      var widgetType = model.get('widgetType');

      if (!this.config.widgets[widgetType]) {
        return false;
      }

      if (!this.config.widgets[widgetType].commonMerged) {
        jQuery.extend(this.config.widgets[widgetType].controls, this.config.widgets.common.controls);
        this.config.widgets[widgetType].commonMerged = true;
      }

      return this.config.widgets[widgetType];
    }

    if (!this.config.elements[elType]) {
      return false;
    }

    var elementConfig = elementorCommon.helpers.cloneObject(this.config.elements[elType]);

    if ('section' === elType && model.get('isInner')) {
      elementConfig.title = this.translate('inner_section');
    }

    return elementConfig;
  },
  getElementControls: function getElementControls(modelElement) {
    var self = this,
        elementData = self.getElementData(modelElement);

    if (!elementData) {
      return false;
    }

    var isInner = modelElement.get('isInner'),
        controls = {};

    _.each(elementData.controls, function (controlData, controlKey) {
      if (isInner && controlData.hide_in_inner || !isInner && controlData.hide_in_top) {
        return;
      }

      controls[controlKey] = controlData;
    });

    return controls;
  },
  mergeControlsSettings: function mergeControlsSettings(controls) {
    var _this = this;

    _.each(controls, function (controlData, controlKey) {
      controls[controlKey] = jQuery.extend(true, {}, _this.config.controls[controlData.type], controlData);
    });

    return controls;
  },
  getControlView: function getControlView(controlID) {
    var capitalizedControlName = elementorCommon.helpers.upperCaseWords(controlID),
        View = this.modules.controls[capitalizedControlName];

    if (!View) {
      var controlData = this.config.controls[controlID],
          isUIControl = controlData && -1 !== controlData.features.indexOf('ui');
      View = this.modules.controls[isUIControl ? 'Base' : 'BaseData'];
    }

    return View;
  },
  getPanelView: function getPanelView() {
    return this.panel.currentView;
  },
  getPreviewView: function getPreviewView() {
    return this.sections.currentView;
  },
  getPreviewContainer: function getPreviewContainer() {
    return this.getPreviewView().getContainer();
  },
  initComponents: function initComponents() {
    var EventManager = __webpack_require__(275),
        DynamicTags = __webpack_require__(430),
        Settings = __webpack_require__(432),
        Saver = __webpack_require__(439),
        Notifications = __webpack_require__(440);

    this.hooks = new EventManager();
    this.saver = new Saver();
    this.settings = new Settings();
    this.dynamicTags = new DynamicTags();
    this.templates.init();
    this.initDialogsManager();
    this.notifications = new Notifications();
    this.hotkeysScreen = new _hotkeys.default();
    this.iconManager = new _iconsManager.default();
    this.noticeBar = new _noticeBar.default();
  },
  // TODO: BC method since 2.3.0
  initDialogsManager: function initDialogsManager() {
    this.dialogsManager = elementorCommon.dialogsManager;
  },
  initElements: function initElements() {
    var ElementCollection = __webpack_require__(267),
        config = this.config.data; // If it's an reload, use the not-saved data


    if (this.elements) {
      config = this.elements.toJSON();
    }

    this.elements = new ElementCollection(config);
    this.elementsModel = new Backbone.Model({
      elements: this.elements
    });
  },
  initPreview: function initPreview() {
    var $ = jQuery;
    this.$previewWrapper = $('#elementor-preview');
    this.$previewResponsiveWrapper = $('#elementor-preview-responsive-wrapper');
    var previewIframeId = 'elementor-preview-iframe'; // Make sure the iFrame does not exist.

    if (!this.$preview) {
      this.$preview = $('<iframe>', {
        id: previewIframeId,
        src: this.config.document.urls.preview,
        allowfullscreen: 1
      });
      this.$previewResponsiveWrapper.append(this.$preview);
    }

    this.$preview.on('load', this.onPreviewLoaded.bind(this));
  },
  initFrontend: function initFrontend() {
    var frontendWindow = this.$preview[0].contentWindow;
    window.elementorFrontend = frontendWindow.elementorFrontend;
    frontendWindow.elementor = this;
    elementorFrontend.init();
    this.trigger('frontend:init');
  },
  initClearPageDialog: function initClearPageDialog() {
    var self = this,
        dialog;

    self.getClearPageDialog = function () {
      if (dialog) {
        return dialog;
      }

      dialog = elementorCommon.dialogsManager.createWidget('confirm', {
        id: 'elementor-clear-page-dialog',
        headerMessage: elementor.translate('clear_page'),
        message: elementor.translate('dialog_confirm_clear_page'),
        position: {
          my: 'center center',
          at: 'center center'
        },
        strings: {
          confirm: elementor.translate('delete'),
          cancel: elementor.translate('cancel')
        },
        onConfirm: function onConfirm() {
          $e.run('document/elements/empty', {
            force: true
          });
        }
      });
      return dialog;
    };
  },
  getCurrentElement: function getCurrentElement() {
    var isPreview = -1 !== ['BODY', 'IFRAME'].indexOf(document.activeElement.tagName) && 'BODY' === elementorFrontend.elements.window.document.activeElement.tagName;

    if (!isPreview && !elementorCommonConfig.isTesting) {
      return false;
    }

    var targetElement = elementor.channels.editor.request('contextMenu:targetView');

    if (!targetElement) {
      var panel = elementor.getPanelView();

      if ($e.routes.isPartOf('panel/editor')) {
        targetElement = panel.getCurrentPageView().getOption('editedElementView');
      }
    }

    if (!targetElement) {
      targetElement = elementor.getPreviewView();
    }

    return targetElement;
  },
  initPanel: function initPanel() {
    this.addRegions({
      panel: __webpack_require__(441)
    }); // Set default page to elements.

    $e.route('panel/elements/categories');
    this.trigger('panel:init');
  },
  initNavigator: function initNavigator() {
    this.addRegions({
      navigator: {
        el: '#elementor-navigator',
        regionClass: _navigator.default
      }
    });
    this.trigger('navigator:init');
  },
  setAjax: function setAjax() {
    elementorCommon.ajax.addRequestConstant('editor_post_id', this.config.document.id);
    elementorCommon.ajax.on('request:unhandledError', function (xmlHttpRequest) {
      elementor.notifications.showToast({
        message: elementor.createAjaxErrorMessage(xmlHttpRequest)
      });
    });
  },
  createAjaxErrorMessage: function createAjaxErrorMessage(xmlHttpRequest) {
    var message;

    if (4 === xmlHttpRequest.readyState) {
      message = this.translate('server_error');

      if (200 !== xmlHttpRequest.status) {
        message += ' (' + xmlHttpRequest.status + ' ' + xmlHttpRequest.statusText + ')';
      }
    } else if (0 === xmlHttpRequest.readyState) {
      message = this.translate('server_connection_lost');
    } else {
      message = this.translate('unknown_error');
    }

    return message + '.';
  },
  preventClicksInsideEditor: function preventClicksInsideEditor() {
    this.$previewContents.on('submit', function (event) {
      event.preventDefault();
    });
    this.$previewContents.on('click', function (event) {
      var $target = jQuery(event.target),
          editMode = elementor.channels.dataEditMode.request('activeMode'),
          isClickInsideElementor = !!$target.closest('#elementor, .pen-menu').length,
          isTargetInsideDocument = this.contains($target[0]);

      if (isClickInsideElementor && 'edit' === editMode || !isTargetInsideDocument) {
        return;
      }

      if ($target.closest('a:not(.elementor-clickable)').length) {
        event.preventDefault();
      }

      if (!isClickInsideElementor) {
        $e.route('panel/elements/categories');
      }
    });
  },
  addBackgroundClickArea: function addBackgroundClickArea(element) {
    element.addEventListener('click', this.onBackgroundClick.bind(this), true);
  },
  addBackgroundClickListener: function addBackgroundClickListener(key, listener) {
    this.backgroundClickListeners[key] = listener;
  },
  removeBackgroundClickListener: function removeBackgroundClickListener(key) {
    delete this.backgroundClickListeners[key];
  },
  showFatalErrorDialog: function showFatalErrorDialog(options) {
    var defaultOptions = {
      id: 'elementor-fatal-error-dialog',
      headerMessage: '',
      message: '',
      position: {
        my: 'center center',
        at: 'center center'
      },
      strings: {
        confirm: this.translate('learn_more'),
        cancel: this.translate('go_back')
      },
      onConfirm: null,
      onCancel: function onCancel() {
        parent.history.go(-1);
      },
      hide: {
        onBackgroundClick: false,
        onButtonClick: false
      }
    };
    options = jQuery.extend(true, defaultOptions, options);
    elementorCommon.dialogsManager.createWidget('confirm', options).show();
  },
  showFlexBoxAttentionDialog: function showFlexBoxAttentionDialog() {
    var _this2 = this;

    var introduction = new elementorModules.editor.utils.Introduction({
      introductionKey: 'flexbox',
      dialogType: 'confirm',
      dialogOptions: {
        id: 'elementor-flexbox-attention-dialog',
        headerMessage: this.translate('flexbox_attention_header'),
        message: this.translate('flexbox_attention_message'),
        position: {
          my: 'center center',
          at: 'center center'
        },
        strings: {
          confirm: this.translate('learn_more'),
          cancel: this.translate('got_it')
        },
        hide: {
          onButtonClick: false
        },
        onCancel: function onCancel() {
          introduction.setViewed();
          introduction.getDialog().hide();
        },
        onConfirm: function onConfirm() {
          return open(_this2.config.help_flexbox_bc_url, '_blank');
        }
      }
    });
    introduction.show();
  },
  checkPageStatus: function checkPageStatus() {
    if (elementor.config.current_revision_id !== elementor.config.document.id) {
      this.notifications.showToast({
        message: this.translate('working_on_draft_notification'),
        buttons: [{
          name: 'view_revisions',
          text: elementor.translate('view_all_revisions'),
          callback: function callback() {
            $e.route('panel/history/revisions');
          }
        }]
      });
    }
  },
  openLibraryOnStart: function openLibraryOnStart() {
    if ('#library' === location.hash) {
      $e.run('library/open');
      location.hash = '';
    }
  },
  enterPreviewMode: function enterPreviewMode(hidePanel) {
    var $elements = elementorFrontend.elements.$body;

    if (hidePanel) {
      $elements = $elements.add(elementorCommon.elements.$body);
    }

    $elements.removeClass('elementor-editor-active').addClass('elementor-editor-preview');
    this.$previewElementorEl.removeClass('elementor-edit-area-active').addClass('elementor-edit-area-preview');

    if (hidePanel) {
      // Handle panel resize
      this.$previewWrapper.css(elementorCommon.config.isRTL ? 'right' : 'left', '');
      this.panel.$el.css('width', '');
    }
  },
  exitPreviewMode: function exitPreviewMode() {
    elementorFrontend.elements.$body.add(elementorCommon.elements.$body).removeClass('elementor-editor-preview').addClass('elementor-editor-active');
    this.$previewElementorEl.removeClass('elementor-edit-area-preview').addClass('elementor-edit-area-active');
  },
  changeEditMode: function changeEditMode(newMode) {
    var dataEditMode = elementor.channels.dataEditMode,
        oldEditMode = dataEditMode.request('activeMode');
    dataEditMode.reply('activeMode', newMode);

    if (newMode !== oldEditMode) {
      dataEditMode.trigger('switch', newMode);
    }
  },
  reloadPreview: function reloadPreview() {
    jQuery('#elementor-preview-loading').show();
    this.$preview[0].contentWindow.location.reload(true);
  },
  changeDeviceMode: function changeDeviceMode(newDeviceMode) {
    var oldDeviceMode = this.channels.deviceMode.request('currentMode');

    if (oldDeviceMode === newDeviceMode) {
      return;
    }

    elementorCommon.elements.$body.removeClass('elementor-device-' + oldDeviceMode).addClass('elementor-device-' + newDeviceMode);
    this.channels.deviceMode.reply('previousMode', oldDeviceMode).reply('currentMode', newDeviceMode).trigger('change');
  },
  enqueueTypographyFonts: function enqueueTypographyFonts() {
    var self = this,
        typographyScheme = this.schemes.getScheme('typography');
    self.helpers.resetEnqueuedFontsCache();

    _.each(typographyScheme.items, function (item) {
      self.helpers.enqueueFont(item.value.font_family);
    });
  },
  translate: function translate(stringKey, templateArgs, i18nStack) {
    // TODO: BC since 2.3.0, it always should be `this.config.i18n`
    if (!i18nStack) {
      i18nStack = this.config.i18n;
    }

    return elementorCommon.translate(stringKey, null, templateArgs, i18nStack);
  },
  logSite: function logSite() {
    var text = '',
        style = '';

    if (_environment.default.firefox) {
      var asciiText = [' ;;;;;;;;;;;;;;; ', ';;;  ;;       ;;;', ';;;  ;;;;;;;;;;;;', ';;;  ;;;;;;;;;;;;', ';;;  ;;       ;;;', ';;;  ;;;;;;;;;;;;', ';;;  ;;;;;;;;;;;;', ';;;  ;;       ;;;', ' ;;;;;;;;;;;;;;; '];
      text += '%c' + asciiText.join('\n') + '\n';
      style = 'color: #C42961';
    } else {
      text += '%c00';
      style = 'font-size: 22px; background-image: url("' + elementorCommon.config.urls.assets + 'images/logo-icon.png"); color: transparent; background-repeat: no-repeat';
    }

    setTimeout(console.log.bind(console, text, style)); // eslint-disable-line

    text = '%cLove using Elementor? Join our growing community of Elementor developers: %chttps://github.com/elementor/elementor';
    setTimeout(console.log.bind(console, text, 'color: #9B0A46', '')); // eslint-disable-line
  },
  requestWidgetsConfig: function requestWidgetsConfig() {
    var _this3 = this;

    var excludeWidgets = {};
    jQuery.each(this.config.widgets, function (widgetName, widgetConfig) {
      if (widgetConfig.controls) {
        excludeWidgets[widgetName] = true;
      }
    });
    elementorCommon.ajax.addRequest('get_widgets_config', {
      data: {
        exclude: excludeWidgets
      },
      success: function success(data) {
        jQuery.each(data, function (widgetName, controlsConfig) {
          var widgetConfig = _this3.config.widgets[widgetName];
          widgetConfig.controls = controlsConfig.controls;
          widgetConfig.tabs_controls = controlsConfig.tabs_controls;
        });

        if (_this3.loaded) {
          _this3.schemes.printSchemesStyle();
        }

        elementorCommon.elements.$body.addClass('elementor-controls-ready');
      }
    });
  },
  getPreferences: function getPreferences(key) {
    var settings = elementor.settings.editorPreferences.model.attributes;

    if (key) {
      return settings[key];
    }

    return settings;
  },
  onStart: function onStart() {
    this.config = ElementorConfig;
    Backbone.Radio.DEBUG = false;
    Backbone.Radio.tuneIn('ELEMENTOR');
    this.initComponents();

    if (!this.checkEnvCompatibility()) {
      this.onEnvNotCompatible();
    }

    this.setAjax();
    this.requestWidgetsConfig();
    this.channels.dataEditMode.reply('activeMode', 'edit');
    this.listenTo(this.channels.dataEditMode, 'switch', this.onEditModeSwitched);
    this.initClearPageDialog();
    this.addBackgroundClickArea(document);
    elementorCommon.elements.$window.trigger('elementor:init');
    this.initPreview();
    this.logSite();
  },
  onPreviewLoaded: function onPreviewLoaded() {
    NProgress.done();
    var previewWindow = this.$preview[0].contentWindow;

    if (!previewWindow.elementorFrontend) {
      this.onPreviewLoadingError();
      return;
    }

    this.$previewContents = this.$preview.contents();
    this.$previewElementorEl = this.$previewContents.find('#elementor');

    if (!this.$previewElementorEl.length) {
      this.onPreviewElNotFound();
      return;
    }

    this.initFrontend();
    this.initElements();
    var iframeRegion = new Marionette.Region({
      // Make sure you get the DOM object out of the jQuery object
      el: this.$previewElementorEl[0]
    });
    this.schemes.init();
    this.schemes.printSchemesStyle();
    this.preventClicksInsideEditor();
    this.addBackgroundClickArea(elementorFrontend.elements.window.document);

    if (this.previewLoadedOnce) {
      $e.route('panel/elements/categories');
    } else {
      this.onFirstPreviewLoaded();
    }

    this.addRegions({
      sections: iframeRegion
    });

    var Preview = __webpack_require__(288);

    this.sections.show(new Preview({
      model: this.elementsModel
    }));
    this.$previewContents.children().addClass('elementor-html');
    var $frontendBody = elementorFrontend.elements.$body;
    $frontendBody.addClass('elementor-editor-active');

    if (!elementor.userCan('design')) {
      $frontendBody.addClass('elementor-editor-content-only');
    }

    this.changeDeviceMode(this._defaultDeviceMode);
    jQuery('#elementor-loading, #elementor-preview-loading').fadeOut(600);

    _.defer(function () {
      elementorFrontend.elements.window.jQuery.holdReady(false);
    });

    this.enqueueTypographyFonts();
    this.onEditModeSwitched();
    $e.shortcuts.bindListener(elementorFrontend.elements.$window);
    this.trigger('preview:loaded', !this.loaded
    /* isFirst */
    );
    this.loaded = true;
  },
  onFirstPreviewLoaded: function onFirstPreviewLoaded() {
    this.initPanel();
    this.heartbeat = new _heartbeat.default();
    this.checkPageStatus();
    this.openLibraryOnStart();
    var isOldPageVersion = this.config.document.version && this.helpers.compareVersions(this.config.document.version, '2.5.0', '<');

    if (!this.config.user.introduction.flexbox && isOldPageVersion) {
      this.showFlexBoxAttentionDialog();
    }

    this.initNavigator();
    this.previewLoadedOnce = true;
  },
  onEditModeSwitched: function onEditModeSwitched() {
    var activeMode = this.channels.dataEditMode.request('activeMode');

    if ('edit' === activeMode) {
      this.exitPreviewMode();
    } else {
      this.enterPreviewMode('preview' === activeMode);
    }
  },
  onEnvNotCompatible: function onEnvNotCompatible() {
    this.showFatalErrorDialog({
      headerMessage: this.translate('device_incompatible_header'),
      message: this.translate('device_incompatible_message'),
      strings: {
        confirm: elementor.translate('proceed_anyway')
      },
      hide: {
        onButtonClick: true
      },
      onConfirm: function onConfirm() {
        this.hide();
      }
    });
  },
  onPreviewLoadingError: function onPreviewLoadingError() {
    var self = this;
    var debugUrl = self.config.document.urls.preview + '&preview-debug',
        previewDebugLinkText = self.config.i18n.preview_debug_link_text,
        previewDebugLink = '<div id="elementor-preview-debug-link-text"><a href="' + debugUrl + '" target="_blank">' + previewDebugLinkText + '</a></div>',
        debugData = elementor.config.preview.debug_data,
        dialogOptions = {
      className: 'elementor-preview-loading-error',
      headerMessage: debugData.header,
      message: debugData.message + previewDebugLink,
      onConfirm: function onConfirm() {
        open(debugData.doc_url, '_blank');
      }
    };

    if (debugData.error) {
      self.showFatalErrorDialog(dialogOptions);
      return;
    }

    jQuery.get(debugUrl, function () {
      self.showFatalErrorDialog(dialogOptions);
    }).fail(function (response) {
      //Iframe can't be loaded
      self.showFatalErrorDialog({
        className: 'elementor-preview-loading-error',
        headerMessage: debugData.header,
        message: response.statusText + ' ' + response.status + ' ' + previewDebugLink,
        onConfirm: function onConfirm() {
          var url = 500 <= response.status ? elementor.config.preview.help_preview_http_error_500_url : elementor.config.preview.help_preview_http_error_url;
          open(url, '_blank');
        }
      });
    });
  },
  onPreviewElNotFound: function onPreviewElNotFound() {
    var args = this.$preview[0].contentWindow.elementorPreviewErrorArgs;

    if (!args) {
      args = {
        headerMessage: this.translate('preview_el_not_found_header'),
        message: this.translate('preview_el_not_found_message'),
        confirmURL: elementor.config.help_the_content_url
      };
    }

    args.onConfirm = function () {
      open(args.confirmURL, '_blank');
    };

    this.showFatalErrorDialog(args);
  },
  onBackgroundClick: function onBackgroundClick(event) {
    jQuery.each(this.backgroundClickListeners, function () {
      var $clickedTarget = jQuery(event.target); // If it's a label that associated with an input

      if ($clickedTarget[0].control) {
        $clickedTarget = $clickedTarget.add($clickedTarget[0].control);
      }

      if (this.ignore && $clickedTarget.closest(this.ignore).length) {
        return;
      }

      var $clickedTargetClosestElement = $clickedTarget.closest(this.element),
          $elementsToHide = jQuery(this.element).not($clickedTargetClosestElement);

      if (this.callback) {
        this.callback($elementsToHide);
        return;
      }

      $elementsToHide.hide();
    });
  },
  compileTemplate: function compileTemplate(template, data) {
    return Marionette.TemplateCache.prototype.compileTemplate(template)(data);
  }
});
module.exports = App;

/***/ }),
/* 296 */
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

var Heartbeat =
/*#__PURE__*/
function () {
  function Heartbeat() {
    var _this = this;

    (0, _classCallCheck2.default)(this, Heartbeat);
    var modal;

    this.getModal = function () {
      if (!modal) {
        modal = _this.initModal();
      }

      return modal;
    };

    jQuery(document).on({
      'heartbeat-send': function heartbeatSend(event, data) {
        data.elementor_post_lock = {
          post_ID: elementor.config.document.id
        };
      },
      'heartbeat-tick': function heartbeatTick(event, response) {
        if (response.locked_user) {
          if (elementor.saver.isEditorChanged()) {
            elementor.saver.saveEditor({
              status: 'autosave'
            });
          }

          _this.showLockMessage(response.locked_user);
        } else {
          _this.getModal().hide();
        }

        elementorCommon.ajax.addRequestConstant('_nonce', response.elementorNonce);
      },
      'heartbeat-tick.wp-refresh-nonces': function heartbeatTickWpRefreshNonces(event, response) {
        var nonces = response['elementor-refresh-nonces'];

        if (nonces) {
          if (nonces.heartbeatNonce) {
            elementorCommon.ajax.addRequestConstant('_nonce', nonces.elementorNonce);
          }

          if (nonces.heartbeatNonce) {
            window.heartbeatSettings.nonce = nonces.heartbeatNonce;
          }
        }
      }
    });

    if (elementor.config.locked_user) {
      this.showLockMessage(elementor.config.locked_user);
    }
  }

  (0, _createClass2.default)(Heartbeat, [{
    key: "initModal",
    value: function initModal() {
      var modal = elementorCommon.dialogsManager.createWidget('lightbox', {
        headerMessage: elementor.translate('take_over')
      });
      modal.addButton({
        name: 'go_back',
        text: elementor.translate('go_back'),
        callback: function callback() {
          parent.history.go(-1);
        }
      });
      modal.addButton({
        name: 'take_over',
        text: elementor.translate('take_over'),
        callback: function callback() {
          wp.heartbeat.enqueue('elementor_force_post_lock', true);
          wp.heartbeat.connectNow();
        }
      });
      return modal;
    }
  }, {
    key: "showLockMessage",
    value: function showLockMessage(lockedUser) {
      var modal = this.getModal();
      modal.setMessage(elementor.translate('dialog_user_taken_over', [lockedUser])).show();
    }
  }]);
  return Heartbeat;
}();

var _default = Heartbeat;
exports.default = _default;

/***/ }),
/* 297 */
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

var _possibleConstructorReturn2 = _interopRequireDefault(__webpack_require__(5));

var _getPrototypeOf2 = _interopRequireDefault(__webpack_require__(4));

var _assertThisInitialized2 = _interopRequireDefault(__webpack_require__(56));

var _inherits2 = _interopRequireDefault(__webpack_require__(6));

var _component = _interopRequireDefault(__webpack_require__(298));

var _layout = _interopRequireDefault(__webpack_require__(299));

var BaseRegion = __webpack_require__(248);

var _default =
/*#__PURE__*/
function (_BaseRegion) {
  (0, _inherits2.default)(_default, _BaseRegion);

  function _default(options) {
    var _this;

    (0, _classCallCheck2.default)(this, _default);
    _this = (0, _possibleConstructorReturn2.default)(this, (0, _getPrototypeOf2.default)(_default).call(this, options));
    $e.components.register(new _component.default({
      manager: (0, _assertThisInitialized2.default)(_this)
    }));
    _this.isDocked = false;
    _this.opened = false;
    _this.indicators = {
      customPosition: {
        title: elementor.translate('custom_positioning'),
        icon: 'cursor-move',
        settingKeys: ['_position', '_element_width'],
        section: '_section_position'
      }
    };
    _this.ensurePosition = _this.ensurePosition.bind((0, _assertThisInitialized2.default)(_this));

    _this.listenTo(elementor.channels.dataEditMode, 'switch', _this.onEditModeSwitched);

    elementor.on('navigator:init', function () {
      if (_this.storage.visible) {
        $e.route('navigator');
      }
    });
    return _this;
  }

  (0, _createClass2.default)(_default, [{
    key: "getStorageKey",
    value: function getStorageKey() {
      return 'navigator';
    }
  }, {
    key: "getDefaultStorage",
    value: function getDefaultStorage() {
      return {
        visible: false,
        size: {
          width: '',
          height: '',
          top: '',
          bottom: '',
          right: '',
          left: ''
        }
      };
    }
  }, {
    key: "getLayout",
    value: function getLayout() {
      return this.currentView;
    }
  }, {
    key: "getDraggableOptions",
    value: function getDraggableOptions() {
      return {
        iframeFix: true,
        handle: '#elementor-navigator__header',
        drag: this.onDrag.bind(this),
        stop: this.onDragStop.bind(this)
      };
    }
  }, {
    key: "getResizableOptions",
    value: function getResizableOptions() {
      var _this2 = this;

      return {
        handles: 'all',
        containment: 'document',
        minWidth: 150,
        maxWidth: 500,
        minHeight: 240,
        start: function start() {
          elementor.$previewWrapper.addClass('ui-resizable-resizing');
        },
        stop: function stop() {
          elementor.$previewWrapper.removeClass('ui-resizable-resizing');

          if (_this2.isDocked) {
            _this2.storage.size.width = elementor.helpers.getElementInlineStyle(_this2.$el, ['width']).width;
            elementorCommon.storage.set('navigator', _this2.storage);
          } else {
            _this2.saveSize();
          }
        }
      };
    }
  }, {
    key: "beforeFirstOpen",
    value: function beforeFirstOpen() {
      this.show(new _layout.default());
      this.$el.draggable(this.getDraggableOptions());
      this.$el.resizable(this.getResizableOptions());
    }
  }, {
    key: "open",
    value: function open(model) {
      if (!this.opened) {
        this.beforeFirstOpen();
        this.opened = true;
      }

      this.$el.show();

      if (this.storage.docked) {
        this.dock();
        this.setDockedSize();
      } else {
        this.setSize();
      }

      if (model) {
        model.trigger('request:edit');
      }

      this.saveStorage('visible', true);
      this.ensurePosition();
      elementorCommon.elements.$window.on('resize', this.ensurePosition);
    }
  }, {
    key: "close",
    value: function close(silent) {
      this.$el.hide();

      if (this.isDocked) {
        this.undock(true);
      }

      if (!silent) {
        this.saveStorage('visible', false);
      }

      elementorCommon.elements.$window.off('resize', this.ensurePosition);
    }
  }, {
    key: "isOpen",
    value: function isOpen() {
      return this.$el.is(':visible');
    }
  }, {
    key: "dock",
    value: function dock() {
      elementorCommon.elements.$body.addClass('elementor-navigator-docked');
      var side = elementorCommon.config.isRTL ? 'left' : 'right',
          resizableOptions = this.getResizableOptions();
      this.$el.css({
        height: '',
        top: '',
        bottom: '',
        left: '',
        right: ''
      });
      elementor.$previewWrapper.css(side, this.storage.size.width);
      this.$el.resizable('destroy');
      resizableOptions.handles = elementorCommon.config.isRTL ? 'e' : 'w';

      resizableOptions.resize = function (event, ui) {
        elementor.$previewWrapper.css(side, ui.size.width);
      };

      this.$el.resizable(resizableOptions);
      this.isDocked = true;
      this.saveStorage('docked', true);
    }
  }, {
    key: "undock",
    value: function undock(silent) {
      elementorCommon.elements.$body.removeClass('elementor-navigator-docked');
      elementor.$previewWrapper.css(elementorCommon.config.isRTL ? 'left' : 'right', '');
      this.setSize();
      this.$el.resizable('destroy');
      this.$el.resizable(this.getResizableOptions());
      this.isDocked = false;

      if (!silent) {
        this.saveStorage('docked', false);
      }
    }
  }, {
    key: "setSize",
    value: function setSize() {
      if (this.storage.size) {
        this.$el.css(this.storage.size);
      }
    }
  }, {
    key: "setDockedSize",
    value: function setDockedSize() {
      this.$el.css('width', this.storage.size.width);
    }
  }, {
    key: "ensurePosition",
    value: function ensurePosition() {
      if (this.isDocked) {
        return;
      }

      var offset = this.$el.offset();

      if (offset.left > innerWidth) {
        this.$el.css({
          left: '',
          right: ''
        });
      }

      if (offset.top > innerHeight) {
        this.$el.css({
          top: '',
          bottom: ''
        });
      }
    }
  }, {
    key: "onDrag",
    value: function onDrag(event, ui) {
      if (this.isDocked) {
        if (ui.position.left === ui.originalPosition.left) {
          if (ui.position.top !== ui.originalPosition.top) {
            return false;
          }
        } else {
          this.undock();
        }

        return;
      }

      if (0 > ui.position.top) {
        ui.position.top = 0;
      }

      var isOutOfLeft = 0 > ui.position.left,
          isOutOfRight = ui.position.left + this.el.offsetWidth > innerWidth;

      if (elementorCommon.config.isRTL) {
        if (isOutOfRight) {
          ui.position.left = innerWidth - this.el.offsetWidth;
        }
      } else if (isOutOfLeft) {
        ui.position.left = 0;
      }

      elementorCommon.elements.$body.toggleClass('elementor-navigator--dock-hint', elementorCommon.config.isRTL ? isOutOfLeft : isOutOfRight);
    }
  }, {
    key: "onDragStop",
    value: function onDragStop(event, ui) {
      if (this.isDocked) {
        return;
      }

      this.saveSize();
      var elementRight = ui.position.left + this.el.offsetWidth;

      if (0 > ui.position.left || elementRight > innerWidth) {
        this.dock();
      }

      elementorCommon.elements.$body.removeClass('elementor-navigator--dock-hint');
    }
  }, {
    key: "onEditModeSwitched",
    value: function onEditModeSwitched(activeMode) {
      if ('edit' === activeMode && this.storage.visible) {
        this.open();
      } else {
        this.close(true);
      }
    }
  }]);
  return _default;
}(BaseRegion);

exports.default = _default;

/***/ }),
/* 298 */
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

var _possibleConstructorReturn2 = _interopRequireDefault(__webpack_require__(5));

var _getPrototypeOf2 = _interopRequireDefault(__webpack_require__(4));

var _get2 = _interopRequireDefault(__webpack_require__(28));

var _inherits2 = _interopRequireDefault(__webpack_require__(6));

var _component = _interopRequireDefault(__webpack_require__(64));

var Component =
/*#__PURE__*/
function (_BaseComponent) {
  (0, _inherits2.default)(Component, _BaseComponent);

  function Component() {
    (0, _classCallCheck2.default)(this, Component);
    return (0, _possibleConstructorReturn2.default)(this, (0, _getPrototypeOf2.default)(Component).apply(this, arguments));
  }

  (0, _createClass2.default)(Component, [{
    key: "getNamespace",
    value: function getNamespace() {
      return 'navigator';
    }
  }, {
    key: "defaultRoutes",
    value: function defaultRoutes() {
      return {
        '': function _() {}
      };
    }
  }, {
    key: "defaultCommands",
    value: function defaultCommands() {
      var _this = this;

      return {
        open: function open() {
          return $e.route(_this.getNamespace());
        },
        close: function close() {
          return _this.close();
        },
        toggle: function toggle() {
          if (_this.isOpen) {
            _this.close();
          } else {
            $e.route(_this.getNamespace());
          }
        }
      };
    }
  }, {
    key: "defaultShortcuts",
    value: function defaultShortcuts() {
      return {
        toggle: {
          keys: 'ctrl+i',
          dependency: function dependency() {
            return 'edit' === elementor.channels.dataEditMode.request('activeMode');
          }
        }
      };
    }
  }, {
    key: "open",
    value: function open(args) {
      var _args$model = args.model,
          model = _args$model === void 0 ? false : _args$model;
      this.manager.open(model);
      return true;
    }
  }, {
    key: "close",
    value: function close() {
      if (!(0, _get2.default)((0, _getPrototypeOf2.default)(Component.prototype), "close", this).call(this)) {
        return false;
      }

      this.manager.close();
      return true;
    }
  }]);
  return Component;
}(_component.default);

exports.default = Component;

/***/ }),
/* 299 */
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

var _possibleConstructorReturn2 = _interopRequireDefault(__webpack_require__(5));

var _getPrototypeOf2 = _interopRequireDefault(__webpack_require__(4));

var _inherits2 = _interopRequireDefault(__webpack_require__(6));

var _element = _interopRequireDefault(__webpack_require__(300));

var _default =
/*#__PURE__*/
function (_Marionette$LayoutVie) {
  (0, _inherits2.default)(_default, _Marionette$LayoutVie);

  function _default() {
    (0, _classCallCheck2.default)(this, _default);
    return (0, _possibleConstructorReturn2.default)(this, (0, _getPrototypeOf2.default)(_default).apply(this, arguments));
  }

  (0, _createClass2.default)(_default, [{
    key: "getTemplate",
    value: function getTemplate() {
      return '#tmpl-elementor-navigator';
    }
  }, {
    key: "id",
    value: function id() {
      return 'elementor-navigator__inner';
    }
  }, {
    key: "ui",
    value: function ui() {
      return {
        toggleAll: '#elementor-navigator__toggle-all',
        close: '#elementor-navigator__close'
      };
    }
  }, {
    key: "events",
    value: function events() {
      return {
        'click @ui.toggleAll': 'toggleAll',
        'click @ui.close': 'onCloseClick'
      };
    }
  }, {
    key: "regions",
    value: function regions() {
      return {
        elements: '#elementor-navigator__elements'
      };
    }
  }, {
    key: "toggleAll",
    value: function toggleAll() {
      var state = 'expand' === this.ui.toggleAll.data('elementor-action'),
          classes = ['eicon-collapse', 'eicon-expand'];
      this.ui.toggleAll.data('elementor-action', state ? 'collapse' : 'expand').removeClass(classes[+state]).addClass(classes[+!state]);
      this.elements.currentView.recursiveChildInvoke('toggleList', state);
    }
  }, {
    key: "activateElementsMouseInteraction",
    value: function activateElementsMouseInteraction() {
      this.elements.currentView.recursiveChildInvoke('activateMouseInteraction');
    }
  }, {
    key: "deactivateElementsMouseInteraction",
    value: function deactivateElementsMouseInteraction() {
      this.elements.currentView.recursiveChildInvoke('deactivateMouseInteraction');
    }
  }, {
    key: "onShow",
    value: function onShow() {
      this.elements.show(new _element.default({
        model: elementor.elementsModel
      }));
    }
  }, {
    key: "onCloseClick",
    value: function onCloseClick() {
      $e.components.get('navigator').close();
    }
  }]);
  return _default;
}(Marionette.LayoutView);

exports.default = _default;

/***/ }),
/* 300 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var _interopRequireDefault = __webpack_require__(0);

var _Object$defineProperty = __webpack_require__(1);

_Object$defineProperty(exports, "__esModule", {
  value: true
});

exports.default = void 0;

__webpack_require__(187);

__webpack_require__(188);

var _keys = _interopRequireDefault(__webpack_require__(27));

var _values = _interopRequireDefault(__webpack_require__(111));

var _classCallCheck2 = _interopRequireDefault(__webpack_require__(2));

var _createClass2 = _interopRequireDefault(__webpack_require__(3));

var _possibleConstructorReturn2 = _interopRequireDefault(__webpack_require__(5));

var _getPrototypeOf2 = _interopRequireDefault(__webpack_require__(4));

var _inherits2 = _interopRequireDefault(__webpack_require__(6));

var _elementEmpty = _interopRequireDefault(__webpack_require__(301));

var _rootEmpty = _interopRequireDefault(__webpack_require__(302));

var _helpers = _interopRequireDefault(__webpack_require__(109));

var _default =
/*#__PURE__*/
function (_Marionette$Composite) {
  (0, _inherits2.default)(_default, _Marionette$Composite);

  function _default() {
    (0, _classCallCheck2.default)(this, _default);
    return (0, _possibleConstructorReturn2.default)(this, (0, _getPrototypeOf2.default)(_default).apply(this, arguments));
  }

  (0, _createClass2.default)(_default, [{
    key: "getTemplate",
    value: function getTemplate() {
      return '#tmpl-elementor-navigator__elements';
    }
  }, {
    key: "ui",
    value: function ui() {
      return {
        item: '> .elementor-navigator__item',
        title: '> .elementor-navigator__item .elementor-navigator__element__title__text',
        toggle: '> .elementor-navigator__item > .elementor-navigator__element__toggle',
        toggleList: '> .elementor-navigator__item > .elementor-navigator__element__list-toggle',
        indicators: '> .elementor-navigator__item > .elementor-navigator__element__indicators',
        indicator: '> .elementor-navigator__item > .elementor-navigator__element__indicators > .elementor-navigator__element__indicator',
        elements: '> .elementor-navigator__elements'
      };
    }
  }, {
    key: "events",
    value: function events() {
      return {
        contextmenu: 'onContextMenu',
        'click @ui.item': 'onItemClick',
        'click @ui.toggle': 'onToggleClick',
        'click @ui.toggleList': 'onToggleListClick',
        'click @ui.indicator': 'onIndicatorClick',
        'dblclick @ui.title': 'onTitleDoubleClick',
        'keydown @ui.title': 'onTitleKeyDown',
        'paste @ui.title': 'onTitlePaste',
        'sortstart @ui.elements': 'onSortStart',
        'sortover @ui.elements': 'onSortOver',
        'sortout @ui.elements': 'onSortOut',
        'sortstop @ui.elements': 'onSortStop',
        'sortupdate @ui.elements': 'onSortUpdate',
        'sortreceive @ui.elements': 'onSortReceive'
      };
    }
  }, {
    key: "getEmptyView",
    value: function getEmptyView() {
      if (this.isRoot()) {
        return _rootEmpty.default;
      }

      if (this.hasChildren()) {
        return _elementEmpty.default;
      }

      return null;
    }
  }, {
    key: "childViewOptions",
    value: function childViewOptions() {
      return {
        indent: this.getIndent() + 10
      };
    }
  }, {
    key: "className",
    value: function className() {
      var elType = this.model.get('elType');
      var classes = 'elementor-navigator__element';

      if (elType) {
        classes += ' elementor-navigator__element-' + elType;
      }

      if (this.hasChildren()) {
        classes += ' elementor-navigator__element--has-children';
      }

      return classes;
    }
  }, {
    key: "attributes",
    value: function attributes() {
      return {
        'data-model-cid': this.model.cid
      };
    }
  }, {
    key: "templateHelpers",
    value: function templateHelpers() {
      var helpers = {};

      if (!this.isRoot()) {
        helpers.title = this.model.getTitle();
        helpers.icon = 'section' === this.model.get('elType') ? '' : this.model.getIcon();
      }

      return helpers;
    }
  }, {
    key: "initialize",
    value: function initialize() {
      this.collection = this.model.get('elements');
      this.childViewContainer = '.elementor-navigator__elements';
      this.listenTo(this.model, 'request:edit', this.onEditRequest).listenTo(this.model, 'change', this.onModelChange).listenTo(this.model.get('settings'), 'change', this.onModelSettingsChange);
    }
  }, {
    key: "getIndent",
    value: function getIndent() {
      return this.getOption('indent') || 0;
    }
  }, {
    key: "isRoot",
    value: function isRoot() {
      return !this.model.get('elType');
    }
  }, {
    key: "hasChildren",
    value: function hasChildren() {
      return 'widget' !== this.model.get('elType');
    }
  }, {
    key: "toggleList",
    value: function toggleList(state, callback) {
      if (!this.hasChildren() || this.isRoot()) {
        return;
      }

      var isActive = this.ui.item.hasClass('elementor-active');

      if (isActive === state) {
        return;
      }

      this.ui.item.toggleClass('elementor-active', state);
      var slideMethod = 'slideToggle';

      if (undefined !== state) {
        slideMethod = 'slide' + (state ? 'Down' : 'Up');
      }

      this.ui.elements[slideMethod](300, callback);
    }
  }, {
    key: "toggleHiddenClass",
    value: function toggleHiddenClass() {
      this.$el.toggleClass('elementor-navigator__element--hidden', !!this.model.get('hidden'));
    }
  }, {
    key: "recursiveChildInvoke",
    value: function recursiveChildInvoke(method) {
      var _arguments = arguments,
          _this = this;

      for (var _len = arguments.length, restArgs = new Array(_len > 1 ? _len - 1 : 0), _key = 1; _key < _len; _key++) {
        restArgs[_key - 1] = arguments[_key];
      }

      this[method].apply(this, restArgs);
      this.children.each(function (child) {
        if (!(child instanceof _this.constructor)) {
          return;
        }

        child.recursiveChildInvoke.apply(child, _arguments);
      });
    }
  }, {
    key: "recursiveParentInvoke",
    value: function recursiveParentInvoke(method) {
      for (var _len2 = arguments.length, restArgs = new Array(_len2 > 1 ? _len2 - 1 : 0), _key2 = 1; _key2 < _len2; _key2++) {
        restArgs[_key2 - 1] = arguments[_key2];
      }

      if (!(this._parent instanceof this.constructor)) {
        return;
      }

      this._parent[method].apply(this._parent, restArgs);

      this._parent.recursiveParentInvoke.apply(this._parent, arguments);
    }
  }, {
    key: "recursiveChildAgreement",
    value: function recursiveChildAgreement(method) {
      for (var _len3 = arguments.length, restArgs = new Array(_len3 > 1 ? _len3 - 1 : 0), _key3 = 1; _key3 < _len3; _key3++) {
        restArgs[_key3 - 1] = arguments[_key3];
      }

      if (!this[method].apply(this, restArgs)) {
        return false;
      }

      var hasAgreement = true;

      for (var _i = 0, _Object$values = (0, _values.default)(this.children._views); _i < _Object$values.length; _i++) {
        var child = _Object$values[_i];

        if (!(child instanceof this.constructor)) {
          continue;
        }

        if (!child.recursiveChildAgreement.apply(child, arguments)) {
          hasAgreement = false;
          break;
        }
      }

      return hasAgreement;
    }
  }, {
    key: "activateMouseInteraction",
    value: function activateMouseInteraction() {
      this.$el.on({
        mouseenter: this.onMouseEnter.bind(this),
        mouseleave: this.onMouseLeave.bind(this)
      });
    }
  }, {
    key: "deactivateMouseInteraction",
    value: function deactivateMouseInteraction() {
      this.$el.off('mouseenter mouseleave');
    }
  }, {
    key: "dragShouldBeIgnored",
    value: function dragShouldBeIgnored(draggedModel) {
      return !_helpers.default.isValidChild(draggedModel, this.model);
    }
  }, {
    key: "addEditingClass",
    value: function addEditingClass() {
      this.ui.item.addClass('elementor-editing');
    }
  }, {
    key: "removeEditingClass",
    value: function removeEditingClass() {
      this.ui.item.removeClass('elementor-editing');
    }
  }, {
    key: "enterTitleEditing",
    value: function enterTitleEditing() {
      this.ui.title.attr('contenteditable', true).focus();
      document.execCommand('selectAll');
      elementor.addBackgroundClickListener('navigator', {
        ignore: this.ui.title,
        callback: this.exitTitleEditing.bind(this)
      });
    }
  }, {
    key: "exitTitleEditing",
    value: function exitTitleEditing() {
      this.ui.title.attr('contenteditable', false);
      var settingsModel = this.model.get('settings'),
          oldTitle = settingsModel.get('_title'),
          newTitle = this.ui.title.text().trim(); // When there isn't an old title and a new title, allow backbone to recognize the `set` as a change

      if (!oldTitle) {
        settingsModel.unset('_title', {
          silent: true
        });
      }

      settingsModel.set('_title', newTitle);
      elementor.removeBackgroundClickListener('navigator');
    }
  }, {
    key: "activateSortable",
    value: function activateSortable() {
      if (!elementor.userCan('design')) {
        return;
      }

      this.ui.elements.sortable({
        items: '> .elementor-navigator__element',
        placeholder: 'ui-sortable-placeholder',
        axis: 'y',
        forcePlaceholderSize: true,
        connectWith: '.elementor-navigator__element-' + this.model.get('elType') + ' ' + this.ui.elements.selector,
        cancel: '[contenteditable="true"]'
      });
    }
  }, {
    key: "renderIndicators",
    value: function renderIndicators() {
      var _this2 = this;

      var settings = this.model.get('settings').attributes;
      this.ui.indicators.empty();
      jQuery.each(elementor.navigator.indicators, function (indicatorName, indicatorSettings) {
        var isShouldBeIndicated = indicatorSettings.settingKeys.some(function (key) {
          return settings[key];
        });

        if (!isShouldBeIndicated) {
          return;
        }

        var $indicator = jQuery('<div>', {
          class: 'elementor-navigator__element__indicator',
          title: indicatorSettings.title
        }).attr('data-section', indicatorSettings.section).html("<i class=\"eicon-".concat(indicatorSettings.icon, "\"></i>"));

        _this2.ui.indicators.append($indicator); // Added delay of 500ms because the indicators bar has a CSS transition attribute of .5s


        $indicator.tipsy({
          delayIn: 300,
          gravity: 's'
        });
      });
    }
  }, {
    key: "onRender",
    value: function onRender() {
      this.activateSortable();

      if (this.isRoot()) {
        return;
      }

      this.ui.item.css('padding-' + (elementorCommon.config.isRTL ? 'right' : 'left'), this.getIndent());
      this.toggleHiddenClass();
      this.renderIndicators();
    }
  }, {
    key: "onModelChange",
    value: function onModelChange() {
      if (undefined !== this.model.changed.hidden) {
        this.toggleHiddenClass();
      }
    }
  }, {
    key: "onModelSettingsChange",
    value: function onModelSettingsChange(settingsModel) {
      var _this3 = this;

      if (undefined !== settingsModel.changed._title) {
        this.ui.title.text(this.model.getTitle());
      }

      jQuery.each(elementor.navigator.indicators, function (indicatorName, indicatorSettings) {
        if ((0, _keys.default)(settingsModel.changed).filter(function (key) {
          return indicatorSettings.settingKeys.includes(key);
        }).length) {
          _this3.renderIndicators();

          return false;
        }
      });
    }
  }, {
    key: "onItemClick",
    value: function onItemClick() {
      this.model.trigger('request:edit', {
        scrollIntoView: true
      });
    }
  }, {
    key: "onToggleClick",
    value: function onToggleClick(event) {
      event.stopPropagation();
      this.model.trigger('request:toggleVisibility');
    }
  }, {
    key: "onTitleDoubleClick",
    value: function onTitleDoubleClick() {
      this.enterTitleEditing();
    }
  }, {
    key: "onTitleKeyDown",
    value: function onTitleKeyDown(event) {
      var ENTER_KEY = 13;

      if (ENTER_KEY === event.which) {
        event.preventDefault();
        this.exitTitleEditing();
      }
    }
  }, {
    key: "onTitlePaste",
    value: function onTitlePaste(event) {
      event.preventDefault();
      document.execCommand('insertHTML', false, event.originalEvent.clipboardData.getData('text/plain'));
    }
  }, {
    key: "onToggleListClick",
    value: function onToggleListClick(event) {
      event.stopPropagation();
      this.toggleList();
    }
  }, {
    key: "onSortStart",
    value: function onSortStart(event, ui) {
      this.model.trigger('request:sort:start', event, ui);
      jQuery(ui.item).children('.elementor-navigator__item').trigger('click');
      elementor.navigator.getLayout().activateElementsMouseInteraction();
    }
  }, {
    key: "onSortStop",
    value: function onSortStop() {
      elementor.navigator.getLayout().deactivateElementsMouseInteraction();
    }
  }, {
    key: "onSortOver",
    value: function onSortOver(event) {
      event.stopPropagation();
      this.$el.addClass('elementor-dragging-on-child');
    }
  }, {
    key: "onSortOut",
    value: function onSortOut(event) {
      event.stopPropagation();
      this.$el.removeClass('elementor-dragging-on-child');
    }
  }, {
    key: "onSortUpdate",
    value: function onSortUpdate(event, ui) {
      event.stopPropagation();

      if (!this.ui.elements.is(ui.item.parent())) {
        return;
      }

      this.model.trigger('request:sort:update', ui);
    }
  }, {
    key: "onSortReceive",
    value: function onSortReceive(event, ui) {
      this.model.trigger('request:sort:receive', event, ui);
    }
  }, {
    key: "onMouseEnter",
    value: function onMouseEnter(event) {
      var _this4 = this;

      event.stopPropagation();
      var dragShouldBeIgnored = this.recursiveChildAgreement('dragShouldBeIgnored', elementor.channels.data.request('dragging:model'));

      if (dragShouldBeIgnored) {
        return;
      }

      this.autoExpandTimeout = setTimeout(function () {
        _this4.toggleList(true, function () {
          _this4.ui.elements.sortable('refreshPositions');
        });
      }, 500);
    }
  }, {
    key: "onMouseLeave",
    value: function onMouseLeave(event) {
      event.stopPropagation();
      clearTimeout(this.autoExpandTimeout);
    }
  }, {
    key: "onContextMenu",
    value: function onContextMenu(event) {
      this.model.trigger('request:contextmenu', event);
    }
  }, {
    key: "onEditRequest",
    value: function onEditRequest() {
      this.recursiveParentInvoke('toggleList', true);
      elementor.navigator.getLayout().elements.currentView.recursiveChildInvoke('removeEditingClass');
      this.addEditingClass();
      elementor.helpers.scrollToView(this.$el, 400, elementor.navigator.getLayout().elements.$el);
    }
  }, {
    key: "onIndicatorClick",
    value: function onIndicatorClick(event) {
      var section = event.currentTarget.dataset.section;
      setTimeout(function () {
        var editor = elementor.getPanelView().currentPageView,
            tab = editor.getControlModel(section).get('tab');
        editor.activateSection(section);
        editor.activateTab(tab);
        editor.render();
      });
    }
  }]);
  return _default;
}(Marionette.CompositeView);

exports.default = _default;

/***/ }),
/* 301 */
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

var _possibleConstructorReturn2 = _interopRequireDefault(__webpack_require__(5));

var _getPrototypeOf2 = _interopRequireDefault(__webpack_require__(4));

var _inherits2 = _interopRequireDefault(__webpack_require__(6));

var _default =
/*#__PURE__*/
function (_Marionette$ItemView) {
  (0, _inherits2.default)(_default, _Marionette$ItemView);

  function _default() {
    (0, _classCallCheck2.default)(this, _default);
    return (0, _possibleConstructorReturn2.default)(this, (0, _getPrototypeOf2.default)(_default).apply(this, arguments));
  }

  (0, _createClass2.default)(_default, [{
    key: "getTemplate",
    value: function getTemplate() {
      return '#tmpl-elementor-navigator__elements--empty';
    }
  }, {
    key: "className",
    value: function className() {
      return 'elementor-empty-view';
    }
  }, {
    key: "onRendr",
    value: function onRendr() {
      this.$el.css('padding-' + (elementorCommon.config.isRTL ? 'right' : 'left'), this.getOption('indent'));
    }
  }]);
  return _default;
}(Marionette.ItemView);

exports.default = _default;

/***/ }),
/* 302 */
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

var _possibleConstructorReturn2 = _interopRequireDefault(__webpack_require__(5));

var _getPrototypeOf2 = _interopRequireDefault(__webpack_require__(4));

var _inherits2 = _interopRequireDefault(__webpack_require__(6));

var _default =
/*#__PURE__*/
function (_Marionette$ItemView) {
  (0, _inherits2.default)(_default, _Marionette$ItemView);

  function _default() {
    (0, _classCallCheck2.default)(this, _default);
    return (0, _possibleConstructorReturn2.default)(this, (0, _getPrototypeOf2.default)(_default).apply(this, arguments));
  }

  (0, _createClass2.default)(_default, [{
    key: "getTemplate",
    value: function getTemplate() {
      return '#tmpl-elementor-navigator__root--empty';
    }
  }, {
    key: "className",
    value: function className() {
      return 'elementor-nerd-box';
    }
  }]);
  return _default;
}(Marionette.ItemView);

exports.default = _default;

/***/ }),
/* 303 */
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

var _possibleConstructorReturn2 = _interopRequireDefault(__webpack_require__(5));

var _getPrototypeOf2 = _interopRequireDefault(__webpack_require__(4));

var _inherits2 = _interopRequireDefault(__webpack_require__(6));

var _component = _interopRequireDefault(__webpack_require__(304));

var _default =
/*#__PURE__*/
function (_elementorModules$Mod) {
  (0, _inherits2.default)(_default, _elementorModules$Mod);

  function _default() {
    (0, _classCallCheck2.default)(this, _default);
    return (0, _possibleConstructorReturn2.default)(this, (0, _getPrototypeOf2.default)(_default).apply(this, arguments));
  }

  (0, _createClass2.default)(_default, [{
    key: "onInit",
    value: function onInit() {
      $e.components.register(new _component.default({
        manager: this
      }));
    }
  }]);
  return _default;
}(elementorModules.Module);

exports.default = _default;

/***/ }),
/* 304 */
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

var _possibleConstructorReturn2 = _interopRequireDefault(__webpack_require__(5));

var _getPrototypeOf2 = _interopRequireDefault(__webpack_require__(4));

var _inherits2 = _interopRequireDefault(__webpack_require__(6));

var _componentModal = _interopRequireDefault(__webpack_require__(199));

var _modalLayout = _interopRequireDefault(__webpack_require__(305));

var Component =
/*#__PURE__*/
function (_ComponentModal) {
  (0, _inherits2.default)(Component, _ComponentModal);

  function Component() {
    (0, _classCallCheck2.default)(this, Component);
    return (0, _possibleConstructorReturn2.default)(this, (0, _getPrototypeOf2.default)(Component).apply(this, arguments));
  }

  (0, _createClass2.default)(Component, [{
    key: "getNamespace",
    value: function getNamespace() {
      return 'shortcuts';
    }
  }, {
    key: "defaultShortcuts",
    value: function defaultShortcuts() {
      return {
        '': {
          keys: 'ctrl+?'
        }
      };
    }
  }, {
    key: "getModalLayout",
    value: function getModalLayout() {
      return _modalLayout.default;
    }
  }]);
  return Component;
}(_componentModal.default);

exports.default = Component;

/***/ }),
/* 305 */
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

var _possibleConstructorReturn2 = _interopRequireDefault(__webpack_require__(5));

var _getPrototypeOf2 = _interopRequireDefault(__webpack_require__(4));

var _get3 = _interopRequireDefault(__webpack_require__(28));

var _inherits2 = _interopRequireDefault(__webpack_require__(6));

var _modalContent = _interopRequireDefault(__webpack_require__(306));

var _default =
/*#__PURE__*/
function (_elementorModules$com) {
  (0, _inherits2.default)(_default, _elementorModules$com);

  function _default() {
    (0, _classCallCheck2.default)(this, _default);
    return (0, _possibleConstructorReturn2.default)(this, (0, _getPrototypeOf2.default)(_default).apply(this, arguments));
  }

  (0, _createClass2.default)(_default, [{
    key: "getModalOptions",
    value: function getModalOptions() {
      return {
        id: 'elementor-hotkeys__modal'
      };
    }
  }, {
    key: "getLogoOptions",
    value: function getLogoOptions() {
      return {
        title: elementor.translate('keyboard_shortcuts')
      };
    }
  }, {
    key: "initialize",
    value: function initialize() {
      var _get2;

      for (var _len = arguments.length, args = new Array(_len), _key = 0; _key < _len; _key++) {
        args[_key] = arguments[_key];
      }

      (_get2 = (0, _get3.default)((0, _getPrototypeOf2.default)(_default.prototype), "initialize", this)).call.apply(_get2, [this].concat(args));

      this.showLogo();
      this.showContentView();
    }
  }, {
    key: "showContentView",
    value: function showContentView() {
      this.modalContent.show(new _modalContent.default());
    }
  }]);
  return _default;
}(elementorModules.common.views.modal.Layout);

exports.default = _default;

/***/ }),
/* 306 */
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

var _possibleConstructorReturn2 = _interopRequireDefault(__webpack_require__(5));

var _getPrototypeOf2 = _interopRequireDefault(__webpack_require__(4));

var _inherits2 = _interopRequireDefault(__webpack_require__(6));

var _environment = _interopRequireDefault(__webpack_require__(182));

var _default =
/*#__PURE__*/
function (_Marionette$LayoutVie) {
  (0, _inherits2.default)(_default, _Marionette$LayoutVie);

  function _default() {
    (0, _classCallCheck2.default)(this, _default);
    return (0, _possibleConstructorReturn2.default)(this, (0, _getPrototypeOf2.default)(_default).apply(this, arguments));
  }

  (0, _createClass2.default)(_default, [{
    key: "id",
    value: function id() {
      return 'elementor-hotkeys';
    }
  }, {
    key: "templateHelpers",
    value: function templateHelpers() {
      return {
        environment: _environment.default
      };
    }
  }, {
    key: "getTemplate",
    value: function getTemplate() {
      return '#tmpl-elementor-hotkeys';
    }
  }]);
  return _default;
}(Marionette.LayoutView);

exports.default = _default;

/***/ }),
/* 307 */
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

var _possibleConstructorReturn2 = _interopRequireDefault(__webpack_require__(5));

var _getPrototypeOf2 = _interopRequireDefault(__webpack_require__(4));

var _inherits2 = _interopRequireDefault(__webpack_require__(6));

var ControlBaseDataView = __webpack_require__(65);

var _default =
/*#__PURE__*/
function (_ControlBaseDataView) {
  (0, _inherits2.default)(_default, _ControlBaseDataView);

  function _default() {
    (0, _classCallCheck2.default)(this, _default);
    return (0, _possibleConstructorReturn2.default)(this, (0, _getPrototypeOf2.default)(_default).apply(this, arguments));
  }

  (0, _createClass2.default)(_default, [{
    key: "onReady",
    value: function onReady() {
      var options = _.extend({
        enableTime: true,
        minuteIncrement: 1
      }, this.model.get('picker_options'));

      this.ui.input.flatpickr(options);
    }
  }, {
    key: "onBeforeDestroy",
    value: function onBeforeDestroy() {
      this.ui.input.flatpickr().destroy();
    }
  }]);
  return _default;
}(ControlBaseDataView);

exports.default = _default;

/***/ }),
/* 308 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var _interopRequireDefault = __webpack_require__(0);

var _defineProperty2 = _interopRequireDefault(__webpack_require__(69));

__webpack_require__(30);

__webpack_require__(15);

var TagPanelView = __webpack_require__(309);

module.exports = Marionette.Behavior.extend({
  tagView: null,
  listenerAttached: false,
  ui: {
    tagArea: '.elementor-control-tag-area',
    dynamicSwitcher: '.elementor-control-dynamic-switcher'
  },
  events: {
    'click @ui.dynamicSwitcher': 'onDynamicSwitcherClick'
  },
  initialize: function initialize() {
    if (!this.listenerAttached) {
      this.listenTo(this.view.options.container.settings, 'change:external:__dynamic__', this.onAfterExternalChange);
      this.listenerAttached = true;
    }
  },
  renderTools: function renderTools() {
    if (this.getOption('dynamicSettings').default) {
      return;
    }

    var $dynamicSwitcher = jQuery(Marionette.Renderer.render('#tmpl-elementor-control-dynamic-switcher'));

    if (this.view.model.get('label_block')) {
      this.ui.controlTitle.after($dynamicSwitcher);
      var $responsiveSwitchers = $dynamicSwitcher.next('.elementor-control-responsive-switchers');

      if ($responsiveSwitchers.length) {
        $responsiveSwitchers.after($dynamicSwitcher);
      }
    } else {
      this.ui.controlTitle.before($dynamicSwitcher);
    }

    this.ui.dynamicSwitcher = this.$el.find(this.ui.dynamicSwitcher.selector);
  },
  toggleDynamicClass: function toggleDynamicClass() {
    this.$el.toggleClass('elementor-control-dynamic-value', this.isDynamicMode());
  },
  isDynamicMode: function isDynamicMode() {
    var dynamicSettings = this.view.container.settings.get('__dynamic__');
    return !!(dynamicSettings && dynamicSettings[this.view.model.get('name')]);
  },
  createTagsList: function createTagsList() {
    var tags = _.groupBy(this.getOption('tags'), 'group'),
        groups = elementor.dynamicTags.getConfig('groups'),
        $tagsList = this.ui.tagsList = jQuery('<div>', {
      class: 'elementor-tags-list'
    }),
        $tagsListInner = jQuery('<div>', {
      class: 'elementor-tags-list__inner'
    });

    $tagsList.append($tagsListInner);
    jQuery.each(groups, function (groupName) {
      var groupTags = tags[groupName];

      if (!groupTags) {
        return;
      }

      var group = this,
          $groupTitle = jQuery('<div>', {
        class: 'elementor-tags-list__group-title'
      }).text(group.title);
      $tagsListInner.append($groupTitle);
      groupTags.forEach(function (tag) {
        var $tag = jQuery('<div>', {
          class: 'elementor-tags-list__item'
        });
        $tag.text(tag.title).attr('data-tag-name', tag.name);
        $tagsListInner.append($tag);
      });
    });
    $tagsListInner.on('click', '.elementor-tags-list__item', this.onTagsListItemClick.bind(this));
    elementorCommon.elements.$body.append($tagsList);
  },
  getTagsList: function getTagsList() {
    if (!this.ui.tagsList) {
      this.createTagsList();
    }

    return this.ui.tagsList;
  },
  toggleTagsList: function toggleTagsList() {
    var $tagsList = this.getTagsList();

    if ($tagsList.is(':visible')) {
      $tagsList.hide();
      return;
    }

    var direction = elementorCommon.config.isRTL ? 'left' : 'right';
    $tagsList.show().position({
      my: "".concat(direction, " top"),
      at: "".concat(direction, " bottom+5"),
      of: this.ui.dynamicSwitcher
    });
  },
  setTagView: function setTagView(id, name, settings) {
    if (this.tagView) {
      this.tagView.destroy();
    }

    var tagView = this.tagView = new TagPanelView({
      id: id,
      name: name,
      settings: settings,
      controlName: this.view.model.get('name'),
      dynamicSettings: this.getOption('dynamicSettings')
    }),
        elementContainer = this.view.options.container,
        tagViewLabel = elementContainer.controls[tagView.options.controlName].label;
    tagView.options.container = new elementorModules.editor.Container({
      type: 'dynamic',
      id: id,
      model: tagView.model,
      settings: tagView.model,
      view: tagView,
      parent: elementContainer,
      label: elementContainer.label + ' ' + tagViewLabel,
      controls: tagView.model.options.controls,
      renderer: elementContainer
    });
    tagView.render();
    this.ui.tagArea.after(tagView.el);
    this.listenTo(tagView, 'remove', this.onTagViewRemove.bind(this));
  },
  setDefaultTagView: function setDefaultTagView() {
    var tagData = elementor.dynamicTags.tagTextToTagData(this.getDynamicValue());
    this.setTagView(tagData.id, tagData.name, tagData.settings);
  },
  tagViewToTagText: function tagViewToTagText() {
    var tagView = this.tagView;
    return elementor.dynamicTags.tagDataToTagText(tagView.getOption('id'), tagView.getOption('name'), tagView.model);
  },
  getDynamicValue: function getDynamicValue() {
    return this.view.container.dynamic.get(this.view.model.get('name'));
  },
  destroyTagView: function destroyTagView() {
    if (this.tagView) {
      this.tagView.destroy();
      this.tagView = null;
    }
  },
  onRender: function onRender() {
    this.$el.addClass('elementor-control-dynamic');
    this.renderTools();
    this.toggleDynamicClass();

    if (this.isDynamicMode()) {
      this.setDefaultTagView();
    }
  },
  onDynamicSwitcherClick: function onDynamicSwitcherClick() {
    this.toggleTagsList();
  },
  onTagsListItemClick: function onTagsListItemClick(event) {
    var $tag = jQuery(event.currentTarget);
    this.setTagView(elementor.helpers.getUniqueID(), $tag.data('tagName'), {});

    if (this.isDynamicMode()) {
      $e.run('document/dynamic/settings', {
        container: this.view.options.container,
        settings: (0, _defineProperty2.default)({}, this.view.model.get('name'), this.tagViewToTagText())
      });
    } else {
      $e.run('document/dynamic/enable', {
        container: this.view.options.container,
        settings: (0, _defineProperty2.default)({}, this.view.model.get('name'), this.tagViewToTagText())
      });
    }

    this.toggleDynamicClass();
    this.toggleTagsList();

    if (this.tagView.getTagConfig().settings_required) {
      this.tagView.showSettingsPopup();
    }
  },
  onTagViewRemove: function onTagViewRemove() {
    $e.run('document/dynamic/disable', {
      container: this.view.options.container,
      settings: (0, _defineProperty2.default)({}, this.view.model.get('name'), this.tagViewToTagText())
    });
    this.toggleDynamicClass();
  },
  onAfterExternalChange: function onAfterExternalChange() {
    this.destroyTagView();

    if (this.isDynamicMode()) {
      this.setDefaultTagView();
    }

    this.toggleDynamicClass();
  },
  onDestroy: function onDestroy() {
    this.destroyTagView();
  }
});

/***/ }),
/* 309 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var _interopRequireDefault = __webpack_require__(0);

__webpack_require__(30);

var _values = _interopRequireDefault(__webpack_require__(111));

var TagControlsStack = __webpack_require__(310);

module.exports = Marionette.ItemView.extend({
  className: 'elementor-dynamic-cover elementor-input-style',
  tagControlsStack: null,
  templateHelpers: function templateHelpers() {
    var helpers = {};

    if (this.model) {
      helpers.controls = this.model.options.controls;
    }

    return helpers;
  },
  ui: {
    remove: '.elementor-dynamic-cover__remove'
  },
  events: function events() {
    var events = {
      'click @ui.remove': 'onRemoveClick'
    };

    if (this.hasSettings()) {
      events.click = 'onClick';
    }

    return events;
  },
  getTemplate: function getTemplate() {
    var config = this.getTagConfig(),
        templateFunction = Marionette.TemplateCache.get('#tmpl-elementor-control-dynamic-cover'),
        renderedTemplate = Marionette.Renderer.render(templateFunction, {
      hasSettings: this.hasSettings(),
      isRemovable: !this.getOption('dynamicSettings').default,
      title: config.title,
      content: config.panel_template
    });
    return Marionette.TemplateCache.prototype.compileTemplate(renderedTemplate.trim());
  },
  getTagConfig: function getTagConfig() {
    return elementor.dynamicTags.getConfig('tags.' + this.getOption('name'));
  },
  initSettingsPopup: function initSettingsPopup() {
    var settingsPopupOptions = {
      className: 'elementor-tag-settings-popup',
      position: {
        my: 'left top+5',
        at: 'left bottom',
        of: this.$el,
        autoRefresh: true
      }
    };
    var settingsPopup = elementorCommon.dialogsManager.createWidget('buttons', settingsPopupOptions);

    this.getSettingsPopup = function () {
      return settingsPopup;
    };
  },
  hasSettings: function hasSettings() {
    return !!(0, _values.default)(this.getTagConfig().controls).length;
  },
  showSettingsPopup: function showSettingsPopup() {
    if (!this.tagControlsStack) {
      this.initTagControlsStack();
    }

    var settingsPopup = this.getSettingsPopup();

    if (settingsPopup.isVisible()) {
      return;
    }

    settingsPopup.show();
  },
  initTagControlsStack: function initTagControlsStack() {
    this.tagControlsStack = new TagControlsStack({
      model: this.model,
      controls: this.model.controls,
      name: this.options.name,
      controlName: this.options.controlName,
      container: this.options.container,
      el: this.getSettingsPopup().getElements('message')[0]
    });
    this.tagControlsStack.render();
  },
  initModel: function initModel() {
    this.model = new elementorModules.editor.elements.models.BaseSettings(this.getOption('settings'), {
      controls: this.getTagConfig().controls
    });
  },
  initialize: function initialize() {
    // The `model` should always be available.
    this.initModel();

    if (!this.hasSettings()) {
      return;
    }

    this.initSettingsPopup();
    this.listenTo(this.model, 'change', this.render);
  },
  onClick: function onClick() {
    this.showSettingsPopup();
  },
  onRemoveClick: function onRemoveClick(event) {
    event.stopPropagation();
    this.destroy();
    this.trigger('remove');
  },
  onDestroy: function onDestroy() {
    if (this.hasSettings()) {
      this.getSettingsPopup().destroy();
    }
  }
});

/***/ }),
/* 310 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var EmptyView = __webpack_require__(311);

module.exports = elementorModules.editor.views.ControlsStack.extend({
  activeTab: 'content',
  template: _.noop,
  emptyView: EmptyView,
  isEmpty: function isEmpty() {
    // Ignore the section control
    return this.collection.length < 2;
  },
  childViewOptions: function childViewOptions() {
    return {
      container: this.options.container
    };
  },
  getNamespaceArray: function getNamespaceArray() {
    var currentPageView = elementor.getPanelView().getCurrentPageView(),
        eventNamespace = currentPageView.getNamespaceArray();
    eventNamespace.push(currentPageView.activeSection);
    eventNamespace.push(this.getOption('controlName'));
    eventNamespace.push(this.getOption('name'));
    return eventNamespace;
  },
  onRenderTemplate: function onRenderTemplate() {
    this.activateFirstSection();
  }
});

/***/ }),
/* 311 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


module.exports = Marionette.ItemView.extend({
  className: 'elementor-tag-controls-stack-empty',
  template: '#tmpl-elementor-tag-controls-stack-empty'
});

/***/ }),
/* 312 */
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

var _possibleConstructorReturn2 = _interopRequireDefault(__webpack_require__(5));

var _getPrototypeOf2 = _interopRequireDefault(__webpack_require__(4));

var _inherits2 = _interopRequireDefault(__webpack_require__(6));

var _default =
/*#__PURE__*/
function (_elementorModules$Vie) {
  (0, _inherits2.default)(_default, _elementorModules$Vie);

  function _default() {
    (0, _classCallCheck2.default)(this, _default);
    return (0, _possibleConstructorReturn2.default)(this, (0, _getPrototypeOf2.default)(_default).apply(this, arguments));
  }

  (0, _createClass2.default)(_default, [{
    key: "getDefaultSettings",
    value: function getDefaultSettings() {
      return {
        selectors: {
          notice: '#elementor-notice-bar',
          close: '#elementor-notice-bar__close'
        }
      };
    }
  }, {
    key: "getDefaultElements",
    value: function getDefaultElements() {
      var settings = this.getSettings();
      return {
        $notice: jQuery(settings.selectors.notice),
        $close: jQuery(settings.selectors.close)
      };
    }
  }, {
    key: "bindEvents",
    value: function bindEvents() {
      this.elements.$close.on('click', this.onCloseClick.bind(this));
    }
  }, {
    key: "onCloseClick",
    value: function onCloseClick() {
      this.elements.$notice.slideUp();
      elementorCommon.ajax.addRequest('notice_bar_dismiss');
    }
  }]);
  return _default;
}(elementorModules.ViewModule);

exports.default = _default;

/***/ }),
/* 313 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var _interopRequireDefault = __webpack_require__(0);

var _Object$defineProperty = __webpack_require__(1);

_Object$defineProperty(exports, "__esModule", {
  value: true
});

exports.default = void 0;

__webpack_require__(48);

var _keys = _interopRequireDefault(__webpack_require__(27));

__webpack_require__(30);

var _classCallCheck2 = _interopRequireDefault(__webpack_require__(2));

var _createClass2 = _interopRequireDefault(__webpack_require__(3));

var _possibleConstructorReturn2 = _interopRequireDefault(__webpack_require__(5));

var _getPrototypeOf2 = _interopRequireDefault(__webpack_require__(4));

var _inherits2 = _interopRequireDefault(__webpack_require__(6));

var _modalLayout = _interopRequireDefault(__webpack_require__(314));

var _iconManager = __webpack_require__(315);

var _iconLibrary = _interopRequireDefault(__webpack_require__(348));

var _store = _interopRequireDefault(__webpack_require__(349));

var _reactDom = __webpack_require__(255);

var _default =
/*#__PURE__*/
function (_elementorModules$Mod) {
  (0, _inherits2.default)(_default, _elementorModules$Mod);

  function _default() {
    (0, _classCallCheck2.default)(this, _default);
    return (0, _possibleConstructorReturn2.default)(this, (0, _getPrototypeOf2.default)(_default).apply(this, arguments));
  }

  (0, _createClass2.default)(_default, [{
    key: "onInit",
    value: function onInit() {
      // Init icon library helper
      this.library = new _iconLibrary.default(); // Init Icon library Storage helper

      this.store = new _store.default(); // Fetch fa4 to fa5 migration data

      elementor.helpers.fetchFa4ToFa5Mapping();
      this.cache = {};
    }
  }, {
    key: "getLayout",
    value: function getLayout() {
      var _this = this;

      if (!this.layout) {
        this.layout = new _modalLayout.default();
        var layoutModal = this.layout.getModal();
        layoutModal.addButton({
          name: 'insert_icon',
          text: elementor.translate('Insert'),
          classes: 'elementor-button elementor-button-success',
          callback: function callback() {
            _this.updateControlValue();

            _this.unMountIconManager();
          }
        });
        layoutModal.on('show', this.onPickerShow.bind(this)).on('hide', this.unMountIconManager);
      }

      return this.layout;
    }
  }, {
    key: "getDefaultSettings",
    value: function getDefaultSettings() {
      return {
        selectedIcon: {}
      };
    }
  }, {
    key: "unMountIconManager",
    value: function unMountIconManager() {
      var containerElement = document.querySelector('#elementor-icons-manager-modal .dialog-content');
      (0, _reactDom.unmountComponentAtNode)(containerElement);
    }
  }, {
    key: "loadIconLibraries",
    value: function loadIconLibraries() {
      if (!this.cache.loaded) {
        elementor.config.icons.libraries.forEach(function (library) {
          if ('all' === library.name) {
            return;
          }

          elementor.iconManager.library.initIconType(library);
        });
        this.cache.loaded = true;
      }
    }
  }, {
    key: "onPickerShow",
    value: function onPickerShow() {
      var controlView = this.getSettings('controlView'),
          loaded = {
        GoPro: true
      },
          iconManagerConfig = {
        recommended: controlView.model.get('recommended') || false
      };
      var selected = controlView.getControlValue(),
          icons = elementor.config.icons.libraries;

      if (!selected.library || !selected.value) {
        selected = {
          value: '',
          library: ''
        };
      }

      iconManagerConfig.selected = selected;
      this.setSettings('selectedIcon', selected);

      if (iconManagerConfig.recommended) {
        var hasRecommended = false;
        icons.forEach(function (library, index) {
          if ('recommended' === library.name) {
            hasRecommended = true;
            icons[index].icons = iconManagerConfig.recommended;
          }
        });

        if (!hasRecommended) {
          icons.unshift({
            name: 'recommended',
            label: 'Recommended',
            icons: iconManagerConfig.recommended,
            labelIcon: 'eicon-star-o',
            native: true
          });
        }
      } else {
        icons = icons.filter(function (library) {
          return 'recommended' !== library.name;
        });
      }

      icons.forEach(function (tab, index) {
        if (-1 === ['all', 'recommended'].indexOf(tab.name)) {
          elementor.iconManager.library.initIconType(tab, function (lib) {
            icons[index] = lib;
          });
        }

        loaded[tab.name] = true;
      });
      iconManagerConfig.loaded = loaded;
      iconManagerConfig.icons = icons; // Set active tab

      var activeTab = selected.library || icons[0].name;

      if ('svg' === selected.library) {
        activeTab = icons[0].name;
      } // selected Library exists


      if (!(0, _keys.default)(icons).some(function (library) {
        return library === activeTab;
      })) {
        activeTab = icons[0].name;
      } // Show recommended tab if selected from it


      if (iconManagerConfig.recommended && '' !== selected.library && '' !== selected.value && iconManagerConfig.recommended.hasOwnProperty(selected.library)) {
        var iconLibrary = icons.filter(function (library) {
          return selected.library === library.name;
        });
        var selectedIconName = selected.value.replace(iconLibrary[0].displayPrefix + ' ' + iconLibrary[0].prefix, '');

        if (iconManagerConfig.recommended[selected.library].some(function (icon) {
          return -1 < icon.indexOf(selectedIconName);
        })) {
          activeTab = icons[0].name;
        }
      }

      iconManagerConfig.customIconsURL = elementor.config.customIconsURL;
      iconManagerConfig.activeTab = activeTab;
      return (0, _iconManager.renderIconManager)(iconManagerConfig);
    }
  }, {
    key: "updateControlValue",
    value: function updateControlValue() {
      var settings = this.getSettings();
      settings.controlView.setValue(settings.selectedIcon);
      settings.controlView.applySavedValue();
    }
  }, {
    key: "show",
    value: function show(options) {
      this.setSettings('controlView', options.view);
      this.getLayout().showModal(options);
    }
  }]);
  return _default;
}(elementorModules.Module);

exports.default = _default;

/***/ }),
/* 314 */
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

var _possibleConstructorReturn2 = _interopRequireDefault(__webpack_require__(5));

var _getPrototypeOf2 = _interopRequireDefault(__webpack_require__(4));

var _get3 = _interopRequireDefault(__webpack_require__(28));

var _inherits2 = _interopRequireDefault(__webpack_require__(6));

var _layout = _interopRequireDefault(__webpack_require__(249));

var _default =
/*#__PURE__*/
function (_BaseModalLayout) {
  (0, _inherits2.default)(_default, _BaseModalLayout);

  function _default() {
    (0, _classCallCheck2.default)(this, _default);
    return (0, _possibleConstructorReturn2.default)(this, (0, _getPrototypeOf2.default)(_default).apply(this, arguments));
  }

  (0, _createClass2.default)(_default, [{
    key: "getModalOptions",
    value: function getModalOptions() {
      return {
        id: 'elementor-icons-manager-modal'
      };
    }
  }, {
    key: "getLogoOptions",
    value: function getLogoOptions() {
      return {
        title: elementor.translate('icon_library')
      };
    }
  }, {
    key: "initialize",
    value: function initialize() {
      var _get2;

      for (var _len = arguments.length, args = new Array(_len), _key = 0; _key < _len; _key++) {
        args[_key] = arguments[_key];
      }

      (_get2 = (0, _get3.default)((0, _getPrototypeOf2.default)(_default.prototype), "initialize", this)).call.apply(_get2, [this].concat(args));

      this.showLogo();
    }
  }]);
  return _default;
}(_layout.default);

exports.default = _default;

/***/ }),
/* 315 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var _interopRequireDefault = __webpack_require__(0);

var _interopRequireWildcard = __webpack_require__(103);

var _Object$defineProperty = __webpack_require__(1);

_Object$defineProperty(exports, "__esModule", {
  value: true
});

exports.renderIconManager = exports.default = void 0;

var _react = _interopRequireWildcard(__webpack_require__(183));

var _extends2 = _interopRequireDefault(__webpack_require__(317));

var _objectSpread2 = _interopRequireDefault(__webpack_require__(318));

__webpack_require__(30);

var _classCallCheck2 = _interopRequireDefault(__webpack_require__(2));

var _createClass2 = _interopRequireDefault(__webpack_require__(3));

var _possibleConstructorReturn2 = _interopRequireDefault(__webpack_require__(5));

var _getPrototypeOf3 = _interopRequireDefault(__webpack_require__(4));

var _assertThisInitialized2 = _interopRequireDefault(__webpack_require__(56));

var _inherits2 = _interopRequireDefault(__webpack_require__(6));

var _defineProperty2 = _interopRequireDefault(__webpack_require__(69));

var _propTypes = _interopRequireDefault(__webpack_require__(204));

var _reactDom = __webpack_require__(255);

var _tab = _interopRequireDefault(__webpack_require__(333));

var _iconsGoPro = _interopRequireDefault(__webpack_require__(347));

var IconsManager =
/*#__PURE__*/
function (_Component) {
  (0, _inherits2.default)(IconsManager, _Component);

  function IconsManager() {
    var _getPrototypeOf2;

    var _this;

    (0, _classCallCheck2.default)(this, IconsManager);

    for (var _len = arguments.length, args = new Array(_len), _key = 0; _key < _len; _key++) {
      args[_key] = arguments[_key];
    }

    _this = (0, _possibleConstructorReturn2.default)(this, (_getPrototypeOf2 = (0, _getPrototypeOf3.default)(IconsManager)).call.apply(_getPrototypeOf2, [this].concat(args)));
    (0, _defineProperty2.default)((0, _assertThisInitialized2.default)(_this), "scrollViewRef", (0, _react.createRef)());
    (0, _defineProperty2.default)((0, _assertThisInitialized2.default)(_this), "state", {
      activeTab: _this.props.activeTab,
      selected: {
        library: '',
        value: ''
      },
      iconTabs: elementor.config.icons.libraries,
      loaded: _this.props.loaded,
      filter: ''
    });
    (0, _defineProperty2.default)((0, _assertThisInitialized2.default)(_this), "cache", {});
    (0, _defineProperty2.default)((0, _assertThisInitialized2.default)(_this), "loadAllTabs", function () {
      var loaded = _this.state.loaded;
      var icons = _this.props.icons;
      icons.forEach(function (tabSettings) {
        if (loaded[tabSettings.name]) {
          return;
        }

        if (-1 < ['all', 'recommended'].indexOf(tabSettings.name)) {
          return;
        }

        elementor.iconManager.library.initIconType((0, _objectSpread2.default)({}, tabSettings), function (library) {
          _this.cache[library.name] = library;
          loaded[tabSettings.name] = true;
        });
      });
      loaded.all = true;
      loaded.recommended = true;

      _this.setState({
        loaded: loaded
      });
    });
    (0, _defineProperty2.default)((0, _assertThisInitialized2.default)(_this), "getActiveTab", function () {
      var activeTab = _this.state.activeTab;
      var loaded = _this.state.loaded,
          icons = _this.props.icons;

      if (!activeTab) {
        if (_this.props.activeTab) {
          activeTab = _this.props.activeTab;
        }
      }

      if ('GoPro' === activeTab) {
        return activeTab;
      }

      if (!loaded[activeTab]) {
        return false;
      }

      var tabSettings = (0, _objectSpread2.default)({}, icons.filter(function (tab) {
        return tab.name === activeTab;
      })[0]);

      if (loaded[activeTab]) {
        return (0, _objectSpread2.default)({}, tabSettings);
      }

      if ('all' === tabSettings.name && !loaded.all) {
        return _this.loadAllTabs();
      }

      elementor.iconManager.library.initIconType((0, _objectSpread2.default)({}, tabSettings), function (library) {
        _this.cache[library.name] = library;

        _this.updateLoaded(library.name);
      });
      return false;
    });
    (0, _defineProperty2.default)((0, _assertThisInitialized2.default)(_this), "getIconTabsLinks", function () {
      var native = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : true;
      return _this.props.icons.map(function (tab) {
        if (native ^ _this.isNativeTab(tab)) {
          return '';
        }

        var isCurrentTab = tab.name === _this.state.activeTab;
        var className = 'elementor-icons-manager__tab-link';

        if (isCurrentTab) {
          className += ' elementor-active';
        }

        return _react.default.createElement("div", {
          className: className,
          key: tab.name,
          onClick: function onClick() {
            if (isCurrentTab) {
              return;
            }

            _this.setState({
              activeTab: tab.name
            });
          }
        }, _react.default.createElement("i", {
          className: tab.labelIcon
        }), tab.label);
      });
    });
    (0, _defineProperty2.default)((0, _assertThisInitialized2.default)(_this), "getActiveTabIcons", function (activeTab) {
      if (activeTab.name) {
        return _this.getActiveTabIcons(activeTab.name);
      }

      if (_this.cache[activeTab]) {
        return _this.cache[activeTab].icons;
      }

      if ('recommended' === activeTab) {
        return _this.state.iconTabs[0].icons;
      }

      if ('all' === activeTab) {
        return _this.getAllIcons();
      }

      if (!_this.state.loaded[activeTab]) {
        var librarySettings = _this.props.icons.filter(function (library) {
          return activeTab === library.name;
        });

        return elementor.iconManager.library.initIconType((0, _objectSpread2.default)({}, librarySettings[0]), function (library) {
          _this.cache[library.name] = library;

          _this.updateLoaded(library.name);
        });
      }

      return elementor.iconManager.store.getIcons(activeTab);
    });
    (0, _defineProperty2.default)((0, _assertThisInitialized2.default)(_this), "getAllIcons", function () {
      if (_this.cache.all) {
        return _this.cache.all.icons;
      }

      var icons = {};

      _this.props.icons.forEach(function (tabSettings) {
        if ('all' === tabSettings.name || 'recommended' === tabSettings.name) {
          return;
        }

        icons[tabSettings.name] = _this.getActiveTabIcons(tabSettings.name);
      });

      _this.cache.all = {
        icons: icons
      };
      return icons;
    });
    (0, _defineProperty2.default)((0, _assertThisInitialized2.default)(_this), "handleSearch", function (event) {
      var filter = event.target.value;

      if (filter && '' !== filter) {
        filter = filter.toLocaleLowerCase();

        if (_this.state.filter === filter) {
          return;
        }
      } else {
        filter = '';
      }

      _this.setState({
        filter: filter
      });
    });
    (0, _defineProperty2.default)((0, _assertThisInitialized2.default)(_this), "setSelected", function (selected) {
      elementor.iconManager.setSettings('selectedIcon', selected);

      _this.setState({
        selected: selected
      });
    });
    (0, _defineProperty2.default)((0, _assertThisInitialized2.default)(_this), "getSelected", function () {
      var selected = _this.state.selected;

      if ('' === selected.value && _this.props.selected && _this.props.selected.value) {
        selected = {
          value: _this.props.selected.value,
          library: _this.props.selected.library
        };
      }

      return selected;
    });
    (0, _defineProperty2.default)((0, _assertThisInitialized2.default)(_this), "render", function () {
      var activeTab = _this.getActiveTab(),
          activeTabName = activeTab.name ? activeTab.name : activeTab,
          _this$props$showSearc = _this.props.showSearch,
          showSearch = _this$props$showSearc === void 0 ? true : _this$props$showSearc,
          filter = _this.state.filter,
          selected = _this.getSelected();

      if ('GoPro' !== activeTab) {
        if (!activeTabName || !_this.state.loaded[activeTabName]) {
          return 'Loading';
        }

        if (activeTab) {
          activeTab.icons = _this.getActiveTabIcons(activeTab);
        }
      }

      return _react.default.createElement(_react.Fragment, null, _react.default.createElement("div", {
        id: "elementor-icons-manager__sidebar",
        className: 'elementor-templates-modal__sidebar'
      }, _react.default.createElement("div", {
        id: "elementor-icons-manager__tab-links"
      }, _this.getIconTabsLinks(), _this.getUploadCustomButton(), _this.getIconTabsLinks(false))), _react.default.createElement("div", {
        id: "elementor-icons-manager__main",
        className: 'elementor-templates-modal__content'
      }, 'GoPro' === activeTabName ? _react.default.createElement(_iconsGoPro.default, null) : _react.default.createElement(_react.Fragment, null, showSearch ? _this.getSearchHTML() : '', _react.default.createElement("div", {
        id: "elementor-icons-manager__tab__wrapper",
        ref: _this.scrollViewRef
      }, _react.default.createElement("div", {
        id: "elementor-icons-manager__tab__title"
      }, activeTab.label), _react.default.createElement("div", {
        id: "elementor-icons-manager__tab__content_wrapper"
      }, _react.default.createElement("input", {
        type: "hidden",
        name: "icon_value",
        id: "icon_value",
        value: selected.value
      }), _react.default.createElement("input", {
        type: "hidden",
        name: "icon_type",
        id: "icon_type",
        value: selected.library
      }), _this.state.loaded[activeTab.name] ? _react.default.createElement(_tab.default, (0, _extends2.default)({
        setSelected: _this.setSelected,
        selected: selected,
        filter: filter,
        key: activeTab.name,
        parentRef: _this.scrollViewRef
      }, activeTab)) : 'Loading')))));
    });
    return _this;
  }

  (0, _createClass2.default)(IconsManager, [{
    key: "updateLoaded",
    value: function updateLoaded(libraryName) {
      var loaded = this.state.loaded;
      loaded[libraryName] = true;
      this.setState({
        loaded: loaded
      });
    }
  }, {
    key: "isNativeTab",
    value: function isNativeTab(tab) {
      return ('all' === tab.name || 'recommended' === tab.name || 'fa-' === tab.name.substr(0, 3)) && tab.native;
    }
  }, {
    key: "getUploadCustomButton",
    value: function getUploadCustomButton() {
      var _this2 = this;

      var onClick = function onClick() {
        if ('GoPro' === _this2.state.activeTab) {
          return;
        }

        _this2.setState({
          activeTab: 'GoPro'
        });
      };

      if (this.props.customIconsURL) {
        onClick = function onClick() {
          window.open(_this2.props.customIconsURL, '_blank');
        };
      }

      return _react.default.createElement("div", {
        id: "elementor-icons-manager__upload"
      }, _react.default.createElement("div", {
        id: "elementor-icons-manager__upload__title"
      }, elementor.translate('my_libraries')), _react.default.createElement("button", {
        id: "elementor-icons-manager__upload__button",
        className: "elementor-button elementor-button-default",
        onClick: onClick
      }, elementor.translate('upload')));
    }
  }, {
    key: "getSearchHTML",
    value: function getSearchHTML() {
      return _react.default.createElement("div", {
        id: "elementor-icons-manager__search"
      }, _react.default.createElement("input", {
        placeholder: 'Filter by name...',
        onInput: this.handleSearch
      }), _react.default.createElement("i", {
        className: 'eicon-search'
      }));
    }
  }]);
  return IconsManager;
}(_react.Component);

var _default = IconsManager;
exports.default = _default;

var renderIconManager = function renderIconManager(props) {
  var containerElement = document.querySelector('#elementor-icons-manager-modal .dialog-content');
  return (0, _reactDom.render)(_react.default.createElement(IconsManager, (0, _extends2.default)({}, props, {
    containerElement: containerElement
  })), containerElement);
};

exports.renderIconManager = renderIconManager;
IconsManager.propTypes = {
  activeTab: _propTypes.default.any,
  customIconsURL: _propTypes.default.string,
  icons: _propTypes.default.any,
  loaded: _propTypes.default.any,
  modalView: _propTypes.default.any,
  recommended: _propTypes.default.oneOfType([_propTypes.default.bool, _propTypes.default.object]),
  selected: _propTypes.default.any,
  showSearch: _propTypes.default.bool
};

/***/ }),
/* 316 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";
/** @license React v16.9.0
 * react.production.min.js
 *
 * Copyright (c) Facebook, Inc. and its affiliates.
 *
 * This source code is licensed under the MIT license found in the
 * LICENSE file in the root directory of this source tree.
 */

var h=__webpack_require__(253),n="function"===typeof Symbol&&Symbol.for,p=n?Symbol.for("react.element"):60103,q=n?Symbol.for("react.portal"):60106,r=n?Symbol.for("react.fragment"):60107,t=n?Symbol.for("react.strict_mode"):60108,u=n?Symbol.for("react.profiler"):60114,v=n?Symbol.for("react.provider"):60109,w=n?Symbol.for("react.context"):60110,x=n?Symbol.for("react.forward_ref"):60112,y=n?Symbol.for("react.suspense"):60113,aa=n?Symbol.for("react.suspense_list"):60120,ba=n?Symbol.for("react.memo"):
60115,ca=n?Symbol.for("react.lazy"):60116;n&&Symbol.for("react.fundamental");n&&Symbol.for("react.responder");var z="function"===typeof Symbol&&Symbol.iterator;
function A(a){for(var b=a.message,d="https://reactjs.org/docs/error-decoder.html?invariant="+b,c=1;c<arguments.length;c++)d+="&args[]="+encodeURIComponent(arguments[c]);a.message="Minified React error #"+b+"; visit "+d+" for the full message or use the non-minified dev environment for full errors and additional helpful warnings. ";return a}var B={isMounted:function(){return!1},enqueueForceUpdate:function(){},enqueueReplaceState:function(){},enqueueSetState:function(){}},C={};
function D(a,b,d){this.props=a;this.context=b;this.refs=C;this.updater=d||B}D.prototype.isReactComponent={};D.prototype.setState=function(a,b){if("object"!==typeof a&&"function"!==typeof a&&null!=a)throw A(Error(85));this.updater.enqueueSetState(this,a,b,"setState")};D.prototype.forceUpdate=function(a){this.updater.enqueueForceUpdate(this,a,"forceUpdate")};function E(){}E.prototype=D.prototype;function F(a,b,d){this.props=a;this.context=b;this.refs=C;this.updater=d||B}var G=F.prototype=new E;
G.constructor=F;h(G,D.prototype);G.isPureReactComponent=!0;var H={current:null},I={suspense:null},J={current:null},K=Object.prototype.hasOwnProperty,L={key:!0,ref:!0,__self:!0,__source:!0};
function M(a,b,d){var c=void 0,e={},g=null,k=null;if(null!=b)for(c in void 0!==b.ref&&(k=b.ref),void 0!==b.key&&(g=""+b.key),b)K.call(b,c)&&!L.hasOwnProperty(c)&&(e[c]=b[c]);var f=arguments.length-2;if(1===f)e.children=d;else if(1<f){for(var l=Array(f),m=0;m<f;m++)l[m]=arguments[m+2];e.children=l}if(a&&a.defaultProps)for(c in f=a.defaultProps,f)void 0===e[c]&&(e[c]=f[c]);return{$$typeof:p,type:a,key:g,ref:k,props:e,_owner:J.current}}
function da(a,b){return{$$typeof:p,type:a.type,key:b,ref:a.ref,props:a.props,_owner:a._owner}}function N(a){return"object"===typeof a&&null!==a&&a.$$typeof===p}function escape(a){var b={"=":"=0",":":"=2"};return"$"+(""+a).replace(/[=:]/g,function(a){return b[a]})}var O=/\/+/g,P=[];function Q(a,b,d,c){if(P.length){var e=P.pop();e.result=a;e.keyPrefix=b;e.func=d;e.context=c;e.count=0;return e}return{result:a,keyPrefix:b,func:d,context:c,count:0}}
function R(a){a.result=null;a.keyPrefix=null;a.func=null;a.context=null;a.count=0;10>P.length&&P.push(a)}
function S(a,b,d,c){var e=typeof a;if("undefined"===e||"boolean"===e)a=null;var g=!1;if(null===a)g=!0;else switch(e){case "string":case "number":g=!0;break;case "object":switch(a.$$typeof){case p:case q:g=!0}}if(g)return d(c,a,""===b?"."+T(a,0):b),1;g=0;b=""===b?".":b+":";if(Array.isArray(a))for(var k=0;k<a.length;k++){e=a[k];var f=b+T(e,k);g+=S(e,f,d,c)}else if(null===a||"object"!==typeof a?f=null:(f=z&&a[z]||a["@@iterator"],f="function"===typeof f?f:null),"function"===typeof f)for(a=f.call(a),k=
0;!(e=a.next()).done;)e=e.value,f=b+T(e,k++),g+=S(e,f,d,c);else if("object"===e)throw d=""+a,A(Error(31),"[object Object]"===d?"object with keys {"+Object.keys(a).join(", ")+"}":d,"");return g}function U(a,b,d){return null==a?0:S(a,"",b,d)}function T(a,b){return"object"===typeof a&&null!==a&&null!=a.key?escape(a.key):b.toString(36)}function ea(a,b){a.func.call(a.context,b,a.count++)}
function fa(a,b,d){var c=a.result,e=a.keyPrefix;a=a.func.call(a.context,b,a.count++);Array.isArray(a)?V(a,c,d,function(a){return a}):null!=a&&(N(a)&&(a=da(a,e+(!a.key||b&&b.key===a.key?"":(""+a.key).replace(O,"$&/")+"/")+d)),c.push(a))}function V(a,b,d,c,e){var g="";null!=d&&(g=(""+d).replace(O,"$&/")+"/");b=Q(b,g,c,e);U(a,fa,b);R(b)}function W(){var a=H.current;if(null===a)throw A(Error(321));return a}
var X={Children:{map:function(a,b,d){if(null==a)return a;var c=[];V(a,c,null,b,d);return c},forEach:function(a,b,d){if(null==a)return a;b=Q(null,null,b,d);U(a,ea,b);R(b)},count:function(a){return U(a,function(){return null},null)},toArray:function(a){var b=[];V(a,b,null,function(a){return a});return b},only:function(a){if(!N(a))throw A(Error(143));return a}},createRef:function(){return{current:null}},Component:D,PureComponent:F,createContext:function(a,b){void 0===b&&(b=null);a={$$typeof:w,_calculateChangedBits:b,
_currentValue:a,_currentValue2:a,_threadCount:0,Provider:null,Consumer:null};a.Provider={$$typeof:v,_context:a};return a.Consumer=a},forwardRef:function(a){return{$$typeof:x,render:a}},lazy:function(a){return{$$typeof:ca,_ctor:a,_status:-1,_result:null}},memo:function(a,b){return{$$typeof:ba,type:a,compare:void 0===b?null:b}},useCallback:function(a,b){return W().useCallback(a,b)},useContext:function(a,b){return W().useContext(a,b)},useEffect:function(a,b){return W().useEffect(a,b)},useImperativeHandle:function(a,
b,d){return W().useImperativeHandle(a,b,d)},useDebugValue:function(){},useLayoutEffect:function(a,b){return W().useLayoutEffect(a,b)},useMemo:function(a,b){return W().useMemo(a,b)},useReducer:function(a,b,d){return W().useReducer(a,b,d)},useRef:function(a){return W().useRef(a)},useState:function(a){return W().useState(a)},Fragment:r,Profiler:u,StrictMode:t,Suspense:y,unstable_SuspenseList:aa,createElement:M,cloneElement:function(a,b,d){if(null===a||void 0===a)throw A(Error(267),a);var c=void 0,e=
h({},a.props),g=a.key,k=a.ref,f=a._owner;if(null!=b){void 0!==b.ref&&(k=b.ref,f=J.current);void 0!==b.key&&(g=""+b.key);var l=void 0;a.type&&a.type.defaultProps&&(l=a.type.defaultProps);for(c in b)K.call(b,c)&&!L.hasOwnProperty(c)&&(e[c]=void 0===b[c]&&void 0!==l?l[c]:b[c])}c=arguments.length-2;if(1===c)e.children=d;else if(1<c){l=Array(c);for(var m=0;m<c;m++)l[m]=arguments[m+2];e.children=l}return{$$typeof:p,type:a.type,key:g,ref:k,props:e,_owner:f}},createFactory:function(a){var b=M.bind(null,a);
b.type=a;return b},isValidElement:N,version:"16.9.0",unstable_withSuspenseConfig:function(a,b){var d=I.suspense;I.suspense=void 0===b?null:b;try{a()}finally{I.suspense=d}},__SECRET_INTERNALS_DO_NOT_USE_OR_YOU_WILL_BE_FIRED:{ReactCurrentDispatcher:H,ReactCurrentBatchConfig:I,ReactCurrentOwner:J,IsSomeRendererActing:{current:!1},assign:h}},Y={default:X},Z=Y&&X||Y;module.exports=Z.default||Z;


/***/ }),
/* 317 */
/***/ (function(module, exports, __webpack_require__) {

var _Object$assign = __webpack_require__(159);

function _extends() {
  module.exports = _extends = _Object$assign || function (target) {
    for (var i = 1; i < arguments.length; i++) {
      var source = arguments[i];

      for (var key in source) {
        if (Object.prototype.hasOwnProperty.call(source, key)) {
          target[key] = source[key];
        }
      }
    }

    return target;
  };

  return _extends.apply(this, arguments);
}

module.exports = _extends;

/***/ }),
/* 318 */
/***/ (function(module, exports, __webpack_require__) {

var _Object$defineProperty = __webpack_require__(1);

var _Object$defineProperties = __webpack_require__(319);

var _Object$getOwnPropertyDescriptors = __webpack_require__(322);

var _Object$getOwnPropertyDescriptor = __webpack_require__(118);

var _Object$getOwnPropertySymbols = __webpack_require__(326);

var _Object$keys = __webpack_require__(27);

var defineProperty = __webpack_require__(69);

function ownKeys(object, enumerableOnly) {
  var keys = _Object$keys(object);

  if (_Object$getOwnPropertySymbols) {
    var symbols = _Object$getOwnPropertySymbols(object);

    if (enumerableOnly) symbols = symbols.filter(function (sym) {
      return _Object$getOwnPropertyDescriptor(object, sym).enumerable;
    });
    keys.push.apply(keys, symbols);
  }

  return keys;
}

function _objectSpread2(target) {
  for (var i = 1; i < arguments.length; i++) {
    var source = arguments[i] != null ? arguments[i] : {};

    if (i % 2) {
      ownKeys(source, true).forEach(function (key) {
        defineProperty(target, key, source[key]);
      });
    } else if (_Object$getOwnPropertyDescriptors) {
      _Object$defineProperties(target, _Object$getOwnPropertyDescriptors(source));
    } else {
      ownKeys(source).forEach(function (key) {
        _Object$defineProperty(target, key, _Object$getOwnPropertyDescriptor(source, key));
      });
    }
  }

  return target;
}

module.exports = _objectSpread2;

/***/ }),
/* 319 */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(320);

/***/ }),
/* 320 */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(321);
var $Object = __webpack_require__(7).Object;
module.exports = function defineProperties(T, D) {
  return $Object.defineProperties(T, D);
};


/***/ }),
/* 321 */
/***/ (function(module, exports, __webpack_require__) {

var $export = __webpack_require__(8);
// 19.1.2.3 / 15.2.3.7 Object.defineProperties(O, Properties)
$export($export.S + $export.F * !__webpack_require__(11), 'Object', { defineProperties: __webpack_require__(120) });


/***/ }),
/* 322 */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(323);

/***/ }),
/* 323 */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(324);
module.exports = __webpack_require__(7).Object.getOwnPropertyDescriptors;


/***/ }),
/* 324 */
/***/ (function(module, exports, __webpack_require__) {

// https://github.com/tc39/proposal-object-getownpropertydescriptors
var $export = __webpack_require__(8);
var ownKeys = __webpack_require__(325);
var toIObject = __webpack_require__(18);
var gOPD = __webpack_require__(44);
var createProperty = __webpack_require__(254);

$export($export.S, 'Object', {
  getOwnPropertyDescriptors: function getOwnPropertyDescriptors(object) {
    var O = toIObject(object);
    var getDesc = gOPD.f;
    var keys = ownKeys(O);
    var result = {};
    var i = 0;
    var key, desc;
    while (keys.length > i) {
      desc = getDesc(O, key = keys[i++]);
      if (desc !== undefined) createProperty(result, key, desc);
    }
    return result;
  }
});


/***/ }),
/* 325 */
/***/ (function(module, exports, __webpack_require__) {

// all object keys, includes non-enumerable and symbols
var gOPN = __webpack_require__(84);
var gOPS = __webpack_require__(73);
var anObject = __webpack_require__(20);
var Reflect = __webpack_require__(10).Reflect;
module.exports = Reflect && Reflect.ownKeys || function ownKeys(it) {
  var keys = gOPN.f(anObject(it));
  var getSymbols = gOPS.f;
  return getSymbols ? keys.concat(getSymbols(it)) : keys;
};


/***/ }),
/* 326 */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(327);

/***/ }),
/* 327 */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(122);
module.exports = __webpack_require__(7).Object.getOwnPropertySymbols;


/***/ }),
/* 328 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";
/**
 * Copyright (c) 2013-present, Facebook, Inc.
 *
 * This source code is licensed under the MIT license found in the
 * LICENSE file in the root directory of this source tree.
 */



var ReactPropTypesSecret = __webpack_require__(329);

function emptyFunction() {}
function emptyFunctionWithReset() {}
emptyFunctionWithReset.resetWarningCache = emptyFunction;

module.exports = function() {
  function shim(props, propName, componentName, location, propFullName, secret) {
    if (secret === ReactPropTypesSecret) {
      // It is still safe when called from React.
      return;
    }
    var err = new Error(
      'Calling PropTypes validators directly is not supported by the `prop-types` package. ' +
      'Use PropTypes.checkPropTypes() to call them. ' +
      'Read more at http://fb.me/use-check-prop-types'
    );
    err.name = 'Invariant Violation';
    throw err;
  };
  shim.isRequired = shim;
  function getShim() {
    return shim;
  };
  // Important!
  // Keep this list in sync with production version in `./factoryWithTypeCheckers.js`.
  var ReactPropTypes = {
    array: shim,
    bool: shim,
    func: shim,
    number: shim,
    object: shim,
    string: shim,
    symbol: shim,

    any: shim,
    arrayOf: getShim,
    element: shim,
    elementType: shim,
    instanceOf: getShim,
    node: shim,
    objectOf: getShim,
    oneOf: getShim,
    oneOfType: getShim,
    shape: getShim,
    exact: getShim,

    checkPropTypes: emptyFunctionWithReset,
    resetWarningCache: emptyFunction
  };

  ReactPropTypes.PropTypes = ReactPropTypes;

  return ReactPropTypes;
};


/***/ }),
/* 329 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";
/**
 * Copyright (c) 2013-present, Facebook, Inc.
 *
 * This source code is licensed under the MIT license found in the
 * LICENSE file in the root directory of this source tree.
 */



var ReactPropTypesSecret = 'SECRET_DO_NOT_PASS_THIS_OR_YOU_WILL_BE_FIRED';

module.exports = ReactPropTypesSecret;


/***/ }),
/* 330 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";
/** @license React v16.9.0
 * react-dom.production.min.js
 *
 * Copyright (c) Facebook, Inc. and its affiliates.
 *
 * This source code is licensed under the MIT license found in the
 * LICENSE file in the root directory of this source tree.
 */

/*
 Modernizr 3.0.0pre (Custom Build) | MIT
*/
var aa=__webpack_require__(183),m=__webpack_require__(253),q=__webpack_require__(331);function t(a){for(var b=a.message,c="https://reactjs.org/docs/error-decoder.html?invariant="+b,d=1;d<arguments.length;d++)c+="&args[]="+encodeURIComponent(arguments[d]);a.message="Minified React error #"+b+"; visit "+c+" for the full message or use the non-minified dev environment for full errors and additional helpful warnings. ";return a}if(!aa)throw t(Error(227));var ba=null,ca={};
function da(){if(ba)for(var a in ca){var b=ca[a],c=ba.indexOf(a);if(!(-1<c))throw t(Error(96),a);if(!ea[c]){if(!b.extractEvents)throw t(Error(97),a);ea[c]=b;c=b.eventTypes;for(var d in c){var e=void 0;var f=c[d],h=b,g=d;if(fa.hasOwnProperty(g))throw t(Error(99),g);fa[g]=f;var k=f.phasedRegistrationNames;if(k){for(e in k)k.hasOwnProperty(e)&&ha(k[e],h,g);e=!0}else f.registrationName?(ha(f.registrationName,h,g),e=!0):e=!1;if(!e)throw t(Error(98),d,a);}}}}
function ha(a,b,c){if(ia[a])throw t(Error(100),a);ia[a]=b;ja[a]=b.eventTypes[c].dependencies}var ea=[],fa={},ia={},ja={};function ka(a,b,c,d,e,f,h,g,k){var l=Array.prototype.slice.call(arguments,3);try{b.apply(c,l)}catch(n){this.onError(n)}}var la=!1,ma=null,na=!1,oa=null,pa={onError:function(a){la=!0;ma=a}};function qa(a,b,c,d,e,f,h,g,k){la=!1;ma=null;ka.apply(pa,arguments)}
function ra(a,b,c,d,e,f,h,g,k){qa.apply(this,arguments);if(la){if(la){var l=ma;la=!1;ma=null}else throw t(Error(198));na||(na=!0,oa=l)}}var sa=null,ta=null,va=null;function wa(a,b,c){var d=a.type||"unknown-event";a.currentTarget=va(c);ra(d,b,void 0,a);a.currentTarget=null}function xa(a,b){if(null==b)throw t(Error(30));if(null==a)return b;if(Array.isArray(a)){if(Array.isArray(b))return a.push.apply(a,b),a;a.push(b);return a}return Array.isArray(b)?[a].concat(b):[a,b]}
function ya(a,b,c){Array.isArray(a)?a.forEach(b,c):a&&b.call(c,a)}var za=null;function Aa(a){if(a){var b=a._dispatchListeners,c=a._dispatchInstances;if(Array.isArray(b))for(var d=0;d<b.length&&!a.isPropagationStopped();d++)wa(a,b[d],c[d]);else b&&wa(a,b,c);a._dispatchListeners=null;a._dispatchInstances=null;a.isPersistent()||a.constructor.release(a)}}function Ba(a){null!==a&&(za=xa(za,a));a=za;za=null;if(a){ya(a,Aa);if(za)throw t(Error(95));if(na)throw a=oa,na=!1,oa=null,a;}}
var Ca={injectEventPluginOrder:function(a){if(ba)throw t(Error(101));ba=Array.prototype.slice.call(a);da()},injectEventPluginsByName:function(a){var b=!1,c;for(c in a)if(a.hasOwnProperty(c)){var d=a[c];if(!ca.hasOwnProperty(c)||ca[c]!==d){if(ca[c])throw t(Error(102),c);ca[c]=d;b=!0}}b&&da()}};
function Da(a,b){var c=a.stateNode;if(!c)return null;var d=sa(c);if(!d)return null;c=d[b];a:switch(b){case "onClick":case "onClickCapture":case "onDoubleClick":case "onDoubleClickCapture":case "onMouseDown":case "onMouseDownCapture":case "onMouseMove":case "onMouseMoveCapture":case "onMouseUp":case "onMouseUpCapture":(d=!d.disabled)||(a=a.type,d=!("button"===a||"input"===a||"select"===a||"textarea"===a));a=!d;break a;default:a=!1}if(a)return null;if(c&&"function"!==typeof c)throw t(Error(231),b,typeof c);
return c}var Ea=Math.random().toString(36).slice(2),Fa="__reactInternalInstance$"+Ea,Ga="__reactEventHandlers$"+Ea;function Ha(a){if(a[Fa])return a[Fa];for(;!a[Fa];)if(a.parentNode)a=a.parentNode;else return null;a=a[Fa];return 5===a.tag||6===a.tag?a:null}function Ia(a){a=a[Fa];return!a||5!==a.tag&&6!==a.tag?null:a}function Ja(a){if(5===a.tag||6===a.tag)return a.stateNode;throw t(Error(33));}function Ka(a){return a[Ga]||null}function La(a){do a=a.return;while(a&&5!==a.tag);return a?a:null}
function Ma(a,b,c){if(b=Da(a,c.dispatchConfig.phasedRegistrationNames[b]))c._dispatchListeners=xa(c._dispatchListeners,b),c._dispatchInstances=xa(c._dispatchInstances,a)}function Na(a){if(a&&a.dispatchConfig.phasedRegistrationNames){for(var b=a._targetInst,c=[];b;)c.push(b),b=La(b);for(b=c.length;0<b--;)Ma(c[b],"captured",a);for(b=0;b<c.length;b++)Ma(c[b],"bubbled",a)}}
function Oa(a,b,c){a&&c&&c.dispatchConfig.registrationName&&(b=Da(a,c.dispatchConfig.registrationName))&&(c._dispatchListeners=xa(c._dispatchListeners,b),c._dispatchInstances=xa(c._dispatchInstances,a))}function Pa(a){a&&a.dispatchConfig.registrationName&&Oa(a._targetInst,null,a)}function Qa(a){ya(a,Na)}var Ra=!("undefined"===typeof window||"undefined"===typeof window.document||"undefined"===typeof window.document.createElement);
function Sa(a,b){var c={};c[a.toLowerCase()]=b.toLowerCase();c["Webkit"+a]="webkit"+b;c["Moz"+a]="moz"+b;return c}var Ta={animationend:Sa("Animation","AnimationEnd"),animationiteration:Sa("Animation","AnimationIteration"),animationstart:Sa("Animation","AnimationStart"),transitionend:Sa("Transition","TransitionEnd")},Ua={},Va={};
Ra&&(Va=document.createElement("div").style,"AnimationEvent"in window||(delete Ta.animationend.animation,delete Ta.animationiteration.animation,delete Ta.animationstart.animation),"TransitionEvent"in window||delete Ta.transitionend.transition);function Wa(a){if(Ua[a])return Ua[a];if(!Ta[a])return a;var b=Ta[a],c;for(c in b)if(b.hasOwnProperty(c)&&c in Va)return Ua[a]=b[c];return a}
var Xa=Wa("animationend"),Ya=Wa("animationiteration"),Za=Wa("animationstart"),ab=Wa("transitionend"),bb="abort canplay canplaythrough durationchange emptied encrypted ended error loadeddata loadedmetadata loadstart pause play playing progress ratechange seeked seeking stalled suspend timeupdate volumechange waiting".split(" "),cb=null,db=null,eb=null;
function fb(){if(eb)return eb;var a,b=db,c=b.length,d,e="value"in cb?cb.value:cb.textContent,f=e.length;for(a=0;a<c&&b[a]===e[a];a++);var h=c-a;for(d=1;d<=h&&b[c-d]===e[f-d];d++);return eb=e.slice(a,1<d?1-d:void 0)}function gb(){return!0}function hb(){return!1}
function y(a,b,c,d){this.dispatchConfig=a;this._targetInst=b;this.nativeEvent=c;a=this.constructor.Interface;for(var e in a)a.hasOwnProperty(e)&&((b=a[e])?this[e]=b(c):"target"===e?this.target=d:this[e]=c[e]);this.isDefaultPrevented=(null!=c.defaultPrevented?c.defaultPrevented:!1===c.returnValue)?gb:hb;this.isPropagationStopped=hb;return this}
m(y.prototype,{preventDefault:function(){this.defaultPrevented=!0;var a=this.nativeEvent;a&&(a.preventDefault?a.preventDefault():"unknown"!==typeof a.returnValue&&(a.returnValue=!1),this.isDefaultPrevented=gb)},stopPropagation:function(){var a=this.nativeEvent;a&&(a.stopPropagation?a.stopPropagation():"unknown"!==typeof a.cancelBubble&&(a.cancelBubble=!0),this.isPropagationStopped=gb)},persist:function(){this.isPersistent=gb},isPersistent:hb,destructor:function(){var a=this.constructor.Interface,
b;for(b in a)this[b]=null;this.nativeEvent=this._targetInst=this.dispatchConfig=null;this.isPropagationStopped=this.isDefaultPrevented=hb;this._dispatchInstances=this._dispatchListeners=null}});y.Interface={type:null,target:null,currentTarget:function(){return null},eventPhase:null,bubbles:null,cancelable:null,timeStamp:function(a){return a.timeStamp||Date.now()},defaultPrevented:null,isTrusted:null};
y.extend=function(a){function b(){}function c(){return d.apply(this,arguments)}var d=this;b.prototype=d.prototype;var e=new b;m(e,c.prototype);c.prototype=e;c.prototype.constructor=c;c.Interface=m({},d.Interface,a);c.extend=d.extend;ib(c);return c};ib(y);function jb(a,b,c,d){if(this.eventPool.length){var e=this.eventPool.pop();this.call(e,a,b,c,d);return e}return new this(a,b,c,d)}
function kb(a){if(!(a instanceof this))throw t(Error(279));a.destructor();10>this.eventPool.length&&this.eventPool.push(a)}function ib(a){a.eventPool=[];a.getPooled=jb;a.release=kb}var lb=y.extend({data:null}),mb=y.extend({data:null}),nb=[9,13,27,32],ob=Ra&&"CompositionEvent"in window,pb=null;Ra&&"documentMode"in document&&(pb=document.documentMode);
var qb=Ra&&"TextEvent"in window&&!pb,sb=Ra&&(!ob||pb&&8<pb&&11>=pb),tb=String.fromCharCode(32),ub={beforeInput:{phasedRegistrationNames:{bubbled:"onBeforeInput",captured:"onBeforeInputCapture"},dependencies:["compositionend","keypress","textInput","paste"]},compositionEnd:{phasedRegistrationNames:{bubbled:"onCompositionEnd",captured:"onCompositionEndCapture"},dependencies:"blur compositionend keydown keypress keyup mousedown".split(" ")},compositionStart:{phasedRegistrationNames:{bubbled:"onCompositionStart",
captured:"onCompositionStartCapture"},dependencies:"blur compositionstart keydown keypress keyup mousedown".split(" ")},compositionUpdate:{phasedRegistrationNames:{bubbled:"onCompositionUpdate",captured:"onCompositionUpdateCapture"},dependencies:"blur compositionupdate keydown keypress keyup mousedown".split(" ")}},vb=!1;
function wb(a,b){switch(a){case "keyup":return-1!==nb.indexOf(b.keyCode);case "keydown":return 229!==b.keyCode;case "keypress":case "mousedown":case "blur":return!0;default:return!1}}function xb(a){a=a.detail;return"object"===typeof a&&"data"in a?a.data:null}var yb=!1;function Ab(a,b){switch(a){case "compositionend":return xb(b);case "keypress":if(32!==b.which)return null;vb=!0;return tb;case "textInput":return a=b.data,a===tb&&vb?null:a;default:return null}}
function Bb(a,b){if(yb)return"compositionend"===a||!ob&&wb(a,b)?(a=fb(),eb=db=cb=null,yb=!1,a):null;switch(a){case "paste":return null;case "keypress":if(!(b.ctrlKey||b.altKey||b.metaKey)||b.ctrlKey&&b.altKey){if(b.char&&1<b.char.length)return b.char;if(b.which)return String.fromCharCode(b.which)}return null;case "compositionend":return sb&&"ko"!==b.locale?null:b.data;default:return null}}
var Cb={eventTypes:ub,extractEvents:function(a,b,c,d){var e=void 0;var f=void 0;if(ob)b:{switch(a){case "compositionstart":e=ub.compositionStart;break b;case "compositionend":e=ub.compositionEnd;break b;case "compositionupdate":e=ub.compositionUpdate;break b}e=void 0}else yb?wb(a,c)&&(e=ub.compositionEnd):"keydown"===a&&229===c.keyCode&&(e=ub.compositionStart);e?(sb&&"ko"!==c.locale&&(yb||e!==ub.compositionStart?e===ub.compositionEnd&&yb&&(f=fb()):(cb=d,db="value"in cb?cb.value:cb.textContent,yb=
!0)),e=lb.getPooled(e,b,c,d),f?e.data=f:(f=xb(c),null!==f&&(e.data=f)),Qa(e),f=e):f=null;(a=qb?Ab(a,c):Bb(a,c))?(b=mb.getPooled(ub.beforeInput,b,c,d),b.data=a,Qa(b)):b=null;return null===f?b:null===b?f:[f,b]}},Db=null,Eb=null,Fb=null;function Gb(a){if(a=ta(a)){if("function"!==typeof Db)throw t(Error(280));var b=sa(a.stateNode);Db(a.stateNode,a.type,b)}}function Hb(a){Eb?Fb?Fb.push(a):Fb=[a]:Eb=a}function Ib(){if(Eb){var a=Eb,b=Fb;Fb=Eb=null;Gb(a);if(b)for(a=0;a<b.length;a++)Gb(b[a])}}
function Jb(a,b){return a(b)}function Kb(a,b,c,d){return a(b,c,d)}function Lb(){}var Mb=Jb,Nb=!1;function Ob(){if(null!==Eb||null!==Fb)Lb(),Ib()}var Pb={color:!0,date:!0,datetime:!0,"datetime-local":!0,email:!0,month:!0,number:!0,password:!0,range:!0,search:!0,tel:!0,text:!0,time:!0,url:!0,week:!0};function Qb(a){var b=a&&a.nodeName&&a.nodeName.toLowerCase();return"input"===b?!!Pb[a.type]:"textarea"===b?!0:!1}
function Rb(a){a=a.target||a.srcElement||window;a.correspondingUseElement&&(a=a.correspondingUseElement);return 3===a.nodeType?a.parentNode:a}function Sb(a){if(!Ra)return!1;a="on"+a;var b=a in document;b||(b=document.createElement("div"),b.setAttribute(a,"return;"),b="function"===typeof b[a]);return b}function Tb(a){var b=a.type;return(a=a.nodeName)&&"input"===a.toLowerCase()&&("checkbox"===b||"radio"===b)}
function Ub(a){var b=Tb(a)?"checked":"value",c=Object.getOwnPropertyDescriptor(a.constructor.prototype,b),d=""+a[b];if(!a.hasOwnProperty(b)&&"undefined"!==typeof c&&"function"===typeof c.get&&"function"===typeof c.set){var e=c.get,f=c.set;Object.defineProperty(a,b,{configurable:!0,get:function(){return e.call(this)},set:function(a){d=""+a;f.call(this,a)}});Object.defineProperty(a,b,{enumerable:c.enumerable});return{getValue:function(){return d},setValue:function(a){d=""+a},stopTracking:function(){a._valueTracker=
null;delete a[b]}}}}function Vb(a){a._valueTracker||(a._valueTracker=Ub(a))}function Wb(a){if(!a)return!1;var b=a._valueTracker;if(!b)return!0;var c=b.getValue();var d="";a&&(d=Tb(a)?a.checked?"true":"false":a.value);a=d;return a!==c?(b.setValue(a),!0):!1}var Xb=aa.__SECRET_INTERNALS_DO_NOT_USE_OR_YOU_WILL_BE_FIRED;Xb.hasOwnProperty("ReactCurrentDispatcher")||(Xb.ReactCurrentDispatcher={current:null});Xb.hasOwnProperty("ReactCurrentBatchConfig")||(Xb.ReactCurrentBatchConfig={suspense:null});
var Yb=/^(.*)[\\\/]/,B="function"===typeof Symbol&&Symbol.for,Zb=B?Symbol.for("react.element"):60103,$b=B?Symbol.for("react.portal"):60106,ac=B?Symbol.for("react.fragment"):60107,bc=B?Symbol.for("react.strict_mode"):60108,cc=B?Symbol.for("react.profiler"):60114,dc=B?Symbol.for("react.provider"):60109,ec=B?Symbol.for("react.context"):60110,fc=B?Symbol.for("react.concurrent_mode"):60111,gc=B?Symbol.for("react.forward_ref"):60112,hc=B?Symbol.for("react.suspense"):60113,ic=B?Symbol.for("react.suspense_list"):
60120,jc=B?Symbol.for("react.memo"):60115,kc=B?Symbol.for("react.lazy"):60116;B&&Symbol.for("react.fundamental");B&&Symbol.for("react.responder");var lc="function"===typeof Symbol&&Symbol.iterator;function mc(a){if(null===a||"object"!==typeof a)return null;a=lc&&a[lc]||a["@@iterator"];return"function"===typeof a?a:null}
function oc(a){if(null==a)return null;if("function"===typeof a)return a.displayName||a.name||null;if("string"===typeof a)return a;switch(a){case ac:return"Fragment";case $b:return"Portal";case cc:return"Profiler";case bc:return"StrictMode";case hc:return"Suspense";case ic:return"SuspenseList"}if("object"===typeof a)switch(a.$$typeof){case ec:return"Context.Consumer";case dc:return"Context.Provider";case gc:var b=a.render;b=b.displayName||b.name||"";return a.displayName||(""!==b?"ForwardRef("+b+")":
"ForwardRef");case jc:return oc(a.type);case kc:if(a=1===a._status?a._result:null)return oc(a)}return null}function pc(a){var b="";do{a:switch(a.tag){case 3:case 4:case 6:case 7:case 10:case 9:var c="";break a;default:var d=a._debugOwner,e=a._debugSource,f=oc(a.type);c=null;d&&(c=oc(d.type));d=f;f="";e?f=" (at "+e.fileName.replace(Yb,"")+":"+e.lineNumber+")":c&&(f=" (created by "+c+")");c="\n    in "+(d||"Unknown")+f}b+=c;a=a.return}while(a);return b}
var qc=/^[:A-Z_a-z\u00C0-\u00D6\u00D8-\u00F6\u00F8-\u02FF\u0370-\u037D\u037F-\u1FFF\u200C-\u200D\u2070-\u218F\u2C00-\u2FEF\u3001-\uD7FF\uF900-\uFDCF\uFDF0-\uFFFD][:A-Z_a-z\u00C0-\u00D6\u00D8-\u00F6\u00F8-\u02FF\u0370-\u037D\u037F-\u1FFF\u200C-\u200D\u2070-\u218F\u2C00-\u2FEF\u3001-\uD7FF\uF900-\uFDCF\uFDF0-\uFFFD\-.0-9\u00B7\u0300-\u036F\u203F-\u2040]*$/,rc=Object.prototype.hasOwnProperty,sc={},tc={};
function uc(a){if(rc.call(tc,a))return!0;if(rc.call(sc,a))return!1;if(qc.test(a))return tc[a]=!0;sc[a]=!0;return!1}function vc(a,b,c,d){if(null!==c&&0===c.type)return!1;switch(typeof b){case "function":case "symbol":return!0;case "boolean":if(d)return!1;if(null!==c)return!c.acceptsBooleans;a=a.toLowerCase().slice(0,5);return"data-"!==a&&"aria-"!==a;default:return!1}}
function wc(a,b,c,d){if(null===b||"undefined"===typeof b||vc(a,b,c,d))return!0;if(d)return!1;if(null!==c)switch(c.type){case 3:return!b;case 4:return!1===b;case 5:return isNaN(b);case 6:return isNaN(b)||1>b}return!1}function D(a,b,c,d,e,f){this.acceptsBooleans=2===b||3===b||4===b;this.attributeName=d;this.attributeNamespace=e;this.mustUseProperty=c;this.propertyName=a;this.type=b;this.sanitizeURL=f}var F={};
"children dangerouslySetInnerHTML defaultValue defaultChecked innerHTML suppressContentEditableWarning suppressHydrationWarning style".split(" ").forEach(function(a){F[a]=new D(a,0,!1,a,null,!1)});[["acceptCharset","accept-charset"],["className","class"],["htmlFor","for"],["httpEquiv","http-equiv"]].forEach(function(a){var b=a[0];F[b]=new D(b,1,!1,a[1],null,!1)});["contentEditable","draggable","spellCheck","value"].forEach(function(a){F[a]=new D(a,2,!1,a.toLowerCase(),null,!1)});
["autoReverse","externalResourcesRequired","focusable","preserveAlpha"].forEach(function(a){F[a]=new D(a,2,!1,a,null,!1)});"allowFullScreen async autoFocus autoPlay controls default defer disabled disablePictureInPicture formNoValidate hidden loop noModule noValidate open playsInline readOnly required reversed scoped seamless itemScope".split(" ").forEach(function(a){F[a]=new D(a,3,!1,a.toLowerCase(),null,!1)});
["checked","multiple","muted","selected"].forEach(function(a){F[a]=new D(a,3,!0,a,null,!1)});["capture","download"].forEach(function(a){F[a]=new D(a,4,!1,a,null,!1)});["cols","rows","size","span"].forEach(function(a){F[a]=new D(a,6,!1,a,null,!1)});["rowSpan","start"].forEach(function(a){F[a]=new D(a,5,!1,a.toLowerCase(),null,!1)});var xc=/[\-:]([a-z])/g;function yc(a){return a[1].toUpperCase()}
"accent-height alignment-baseline arabic-form baseline-shift cap-height clip-path clip-rule color-interpolation color-interpolation-filters color-profile color-rendering dominant-baseline enable-background fill-opacity fill-rule flood-color flood-opacity font-family font-size font-size-adjust font-stretch font-style font-variant font-weight glyph-name glyph-orientation-horizontal glyph-orientation-vertical horiz-adv-x horiz-origin-x image-rendering letter-spacing lighting-color marker-end marker-mid marker-start overline-position overline-thickness paint-order panose-1 pointer-events rendering-intent shape-rendering stop-color stop-opacity strikethrough-position strikethrough-thickness stroke-dasharray stroke-dashoffset stroke-linecap stroke-linejoin stroke-miterlimit stroke-opacity stroke-width text-anchor text-decoration text-rendering underline-position underline-thickness unicode-bidi unicode-range units-per-em v-alphabetic v-hanging v-ideographic v-mathematical vector-effect vert-adv-y vert-origin-x vert-origin-y word-spacing writing-mode xmlns:xlink x-height".split(" ").forEach(function(a){var b=a.replace(xc,
yc);F[b]=new D(b,1,!1,a,null,!1)});"xlink:actuate xlink:arcrole xlink:role xlink:show xlink:title xlink:type".split(" ").forEach(function(a){var b=a.replace(xc,yc);F[b]=new D(b,1,!1,a,"http://www.w3.org/1999/xlink",!1)});["xml:base","xml:lang","xml:space"].forEach(function(a){var b=a.replace(xc,yc);F[b]=new D(b,1,!1,a,"http://www.w3.org/XML/1998/namespace",!1)});["tabIndex","crossOrigin"].forEach(function(a){F[a]=new D(a,1,!1,a.toLowerCase(),null,!1)});
F.xlinkHref=new D("xlinkHref",1,!1,"xlink:href","http://www.w3.org/1999/xlink",!0);["src","href","action","formAction"].forEach(function(a){F[a]=new D(a,1,!1,a.toLowerCase(),null,!0)});
function zc(a,b,c,d){var e=F.hasOwnProperty(b)?F[b]:null;var f=null!==e?0===e.type:d?!1:!(2<b.length)||"o"!==b[0]&&"O"!==b[0]||"n"!==b[1]&&"N"!==b[1]?!1:!0;f||(wc(b,c,e,d)&&(c=null),d||null===e?uc(b)&&(null===c?a.removeAttribute(b):a.setAttribute(b,""+c)):e.mustUseProperty?a[e.propertyName]=null===c?3===e.type?!1:"":c:(b=e.attributeName,d=e.attributeNamespace,null===c?a.removeAttribute(b):(e=e.type,c=3===e||4===e&&!0===c?"":""+c,d?a.setAttributeNS(d,b,c):a.setAttribute(b,c))))}
function Ac(a){switch(typeof a){case "boolean":case "number":case "object":case "string":case "undefined":return a;default:return""}}function Bc(a,b){var c=b.checked;return m({},b,{defaultChecked:void 0,defaultValue:void 0,value:void 0,checked:null!=c?c:a._wrapperState.initialChecked})}
function Cc(a,b){var c=null==b.defaultValue?"":b.defaultValue,d=null!=b.checked?b.checked:b.defaultChecked;c=Ac(null!=b.value?b.value:c);a._wrapperState={initialChecked:d,initialValue:c,controlled:"checkbox"===b.type||"radio"===b.type?null!=b.checked:null!=b.value}}function Dc(a,b){b=b.checked;null!=b&&zc(a,"checked",b,!1)}
function Ec(a,b){Dc(a,b);var c=Ac(b.value),d=b.type;if(null!=c)if("number"===d){if(0===c&&""===a.value||a.value!=c)a.value=""+c}else a.value!==""+c&&(a.value=""+c);else if("submit"===d||"reset"===d){a.removeAttribute("value");return}b.hasOwnProperty("value")?Fc(a,b.type,c):b.hasOwnProperty("defaultValue")&&Fc(a,b.type,Ac(b.defaultValue));null==b.checked&&null!=b.defaultChecked&&(a.defaultChecked=!!b.defaultChecked)}
function Gc(a,b,c){if(b.hasOwnProperty("value")||b.hasOwnProperty("defaultValue")){var d=b.type;if(!("submit"!==d&&"reset"!==d||void 0!==b.value&&null!==b.value))return;b=""+a._wrapperState.initialValue;c||b===a.value||(a.value=b);a.defaultValue=b}c=a.name;""!==c&&(a.name="");a.defaultChecked=!a.defaultChecked;a.defaultChecked=!!a._wrapperState.initialChecked;""!==c&&(a.name=c)}
function Fc(a,b,c){if("number"!==b||a.ownerDocument.activeElement!==a)null==c?a.defaultValue=""+a._wrapperState.initialValue:a.defaultValue!==""+c&&(a.defaultValue=""+c)}var Hc={change:{phasedRegistrationNames:{bubbled:"onChange",captured:"onChangeCapture"},dependencies:"blur change click focus input keydown keyup selectionchange".split(" ")}};function Ic(a,b,c){a=y.getPooled(Hc.change,a,b,c);a.type="change";Hb(c);Qa(a);return a}var Jc=null,Kc=null;function Lc(a){Ba(a)}
function Mc(a){var b=Ja(a);if(Wb(b))return a}function Nc(a,b){if("change"===a)return b}var Oc=!1;Ra&&(Oc=Sb("input")&&(!document.documentMode||9<document.documentMode));function Pc(){Jc&&(Jc.detachEvent("onpropertychange",Qc),Kc=Jc=null)}function Qc(a){if("value"===a.propertyName&&Mc(Kc))if(a=Ic(Kc,a,Rb(a)),Nb)Ba(a);else{Nb=!0;try{Jb(Lc,a)}finally{Nb=!1,Ob()}}}function Rc(a,b,c){"focus"===a?(Pc(),Jc=b,Kc=c,Jc.attachEvent("onpropertychange",Qc)):"blur"===a&&Pc()}
function Sc(a){if("selectionchange"===a||"keyup"===a||"keydown"===a)return Mc(Kc)}function Tc(a,b){if("click"===a)return Mc(b)}function Uc(a,b){if("input"===a||"change"===a)return Mc(b)}
var Vc={eventTypes:Hc,_isInputEventSupported:Oc,extractEvents:function(a,b,c,d){var e=b?Ja(b):window,f=void 0,h=void 0,g=e.nodeName&&e.nodeName.toLowerCase();"select"===g||"input"===g&&"file"===e.type?f=Nc:Qb(e)?Oc?f=Uc:(f=Sc,h=Rc):(g=e.nodeName)&&"input"===g.toLowerCase()&&("checkbox"===e.type||"radio"===e.type)&&(f=Tc);if(f&&(f=f(a,b)))return Ic(f,c,d);h&&h(a,e,b);"blur"===a&&(a=e._wrapperState)&&a.controlled&&"number"===e.type&&Fc(e,"number",e.value)}},Wc=y.extend({view:null,detail:null}),Xc={Alt:"altKey",
Control:"ctrlKey",Meta:"metaKey",Shift:"shiftKey"};function Yc(a){var b=this.nativeEvent;return b.getModifierState?b.getModifierState(a):(a=Xc[a])?!!b[a]:!1}function Zc(){return Yc}
var $c=0,ad=0,bd=!1,cd=!1,dd=Wc.extend({screenX:null,screenY:null,clientX:null,clientY:null,pageX:null,pageY:null,ctrlKey:null,shiftKey:null,altKey:null,metaKey:null,getModifierState:Zc,button:null,buttons:null,relatedTarget:function(a){return a.relatedTarget||(a.fromElement===a.srcElement?a.toElement:a.fromElement)},movementX:function(a){if("movementX"in a)return a.movementX;var b=$c;$c=a.screenX;return bd?"mousemove"===a.type?a.screenX-b:0:(bd=!0,0)},movementY:function(a){if("movementY"in a)return a.movementY;
var b=ad;ad=a.screenY;return cd?"mousemove"===a.type?a.screenY-b:0:(cd=!0,0)}}),ed=dd.extend({pointerId:null,width:null,height:null,pressure:null,tangentialPressure:null,tiltX:null,tiltY:null,twist:null,pointerType:null,isPrimary:null}),fd={mouseEnter:{registrationName:"onMouseEnter",dependencies:["mouseout","mouseover"]},mouseLeave:{registrationName:"onMouseLeave",dependencies:["mouseout","mouseover"]},pointerEnter:{registrationName:"onPointerEnter",dependencies:["pointerout","pointerover"]},pointerLeave:{registrationName:"onPointerLeave",
dependencies:["pointerout","pointerover"]}},gd={eventTypes:fd,extractEvents:function(a,b,c,d){var e="mouseover"===a||"pointerover"===a,f="mouseout"===a||"pointerout"===a;if(e&&(c.relatedTarget||c.fromElement)||!f&&!e)return null;e=d.window===d?d:(e=d.ownerDocument)?e.defaultView||e.parentWindow:window;f?(f=b,b=(b=c.relatedTarget||c.toElement)?Ha(b):null):f=null;if(f===b)return null;var h=void 0,g=void 0,k=void 0,l=void 0;if("mouseout"===a||"mouseover"===a)h=dd,g=fd.mouseLeave,k=fd.mouseEnter,l="mouse";
else if("pointerout"===a||"pointerover"===a)h=ed,g=fd.pointerLeave,k=fd.pointerEnter,l="pointer";var n=null==f?e:Ja(f);e=null==b?e:Ja(b);a=h.getPooled(g,f,c,d);a.type=l+"leave";a.target=n;a.relatedTarget=e;c=h.getPooled(k,b,c,d);c.type=l+"enter";c.target=e;c.relatedTarget=n;d=b;if(f&&d)a:{b=f;e=d;l=0;for(h=b;h;h=La(h))l++;h=0;for(k=e;k;k=La(k))h++;for(;0<l-h;)b=La(b),l--;for(;0<h-l;)e=La(e),h--;for(;l--;){if(b===e||b===e.alternate)break a;b=La(b);e=La(e)}b=null}else b=null;e=b;for(b=[];f&&f!==e;){l=
f.alternate;if(null!==l&&l===e)break;b.push(f);f=La(f)}for(f=[];d&&d!==e;){l=d.alternate;if(null!==l&&l===e)break;f.push(d);d=La(d)}for(d=0;d<b.length;d++)Oa(b[d],"bubbled",a);for(d=f.length;0<d--;)Oa(f[d],"captured",c);return[a,c]}};function hd(a,b){return a===b&&(0!==a||1/a===1/b)||a!==a&&b!==b}var id=Object.prototype.hasOwnProperty;
function jd(a,b){if(hd(a,b))return!0;if("object"!==typeof a||null===a||"object"!==typeof b||null===b)return!1;var c=Object.keys(a),d=Object.keys(b);if(c.length!==d.length)return!1;for(d=0;d<c.length;d++)if(!id.call(b,c[d])||!hd(a[c[d]],b[c[d]]))return!1;return!0}function kd(a,b){return{responder:a,props:b}}new Map;new Map;new Set;new Map;
function ld(a){var b=a;if(a.alternate)for(;b.return;)b=b.return;else{if(0!==(b.effectTag&2))return 1;for(;b.return;)if(b=b.return,0!==(b.effectTag&2))return 1}return 3===b.tag?2:3}function od(a){if(2!==ld(a))throw t(Error(188));}
function pd(a){var b=a.alternate;if(!b){b=ld(a);if(3===b)throw t(Error(188));return 1===b?null:a}for(var c=a,d=b;;){var e=c.return;if(null===e)break;var f=e.alternate;if(null===f){d=e.return;if(null!==d){c=d;continue}break}if(e.child===f.child){for(f=e.child;f;){if(f===c)return od(e),a;if(f===d)return od(e),b;f=f.sibling}throw t(Error(188));}if(c.return!==d.return)c=e,d=f;else{for(var h=!1,g=e.child;g;){if(g===c){h=!0;c=e;d=f;break}if(g===d){h=!0;d=e;c=f;break}g=g.sibling}if(!h){for(g=f.child;g;){if(g===
c){h=!0;c=f;d=e;break}if(g===d){h=!0;d=f;c=e;break}g=g.sibling}if(!h)throw t(Error(189));}}if(c.alternate!==d)throw t(Error(190));}if(3!==c.tag)throw t(Error(188));return c.stateNode.current===c?a:b}function qd(a){a=pd(a);if(!a)return null;for(var b=a;;){if(5===b.tag||6===b.tag)return b;if(b.child)b.child.return=b,b=b.child;else{if(b===a)break;for(;!b.sibling;){if(!b.return||b.return===a)return null;b=b.return}b.sibling.return=b.return;b=b.sibling}}return null}
var rd=y.extend({animationName:null,elapsedTime:null,pseudoElement:null}),sd=y.extend({clipboardData:function(a){return"clipboardData"in a?a.clipboardData:window.clipboardData}}),td=Wc.extend({relatedTarget:null});function ud(a){var b=a.keyCode;"charCode"in a?(a=a.charCode,0===a&&13===b&&(a=13)):a=b;10===a&&(a=13);return 32<=a||13===a?a:0}
var vd={Esc:"Escape",Spacebar:" ",Left:"ArrowLeft",Up:"ArrowUp",Right:"ArrowRight",Down:"ArrowDown",Del:"Delete",Win:"OS",Menu:"ContextMenu",Apps:"ContextMenu",Scroll:"ScrollLock",MozPrintableKey:"Unidentified"},wd={8:"Backspace",9:"Tab",12:"Clear",13:"Enter",16:"Shift",17:"Control",18:"Alt",19:"Pause",20:"CapsLock",27:"Escape",32:" ",33:"PageUp",34:"PageDown",35:"End",36:"Home",37:"ArrowLeft",38:"ArrowUp",39:"ArrowRight",40:"ArrowDown",45:"Insert",46:"Delete",112:"F1",113:"F2",114:"F3",115:"F4",
116:"F5",117:"F6",118:"F7",119:"F8",120:"F9",121:"F10",122:"F11",123:"F12",144:"NumLock",145:"ScrollLock",224:"Meta"},xd=Wc.extend({key:function(a){if(a.key){var b=vd[a.key]||a.key;if("Unidentified"!==b)return b}return"keypress"===a.type?(a=ud(a),13===a?"Enter":String.fromCharCode(a)):"keydown"===a.type||"keyup"===a.type?wd[a.keyCode]||"Unidentified":""},location:null,ctrlKey:null,shiftKey:null,altKey:null,metaKey:null,repeat:null,locale:null,getModifierState:Zc,charCode:function(a){return"keypress"===
a.type?ud(a):0},keyCode:function(a){return"keydown"===a.type||"keyup"===a.type?a.keyCode:0},which:function(a){return"keypress"===a.type?ud(a):"keydown"===a.type||"keyup"===a.type?a.keyCode:0}}),yd=dd.extend({dataTransfer:null}),zd=Wc.extend({touches:null,targetTouches:null,changedTouches:null,altKey:null,metaKey:null,ctrlKey:null,shiftKey:null,getModifierState:Zc}),Ad=y.extend({propertyName:null,elapsedTime:null,pseudoElement:null}),Bd=dd.extend({deltaX:function(a){return"deltaX"in a?a.deltaX:"wheelDeltaX"in
a?-a.wheelDeltaX:0},deltaY:function(a){return"deltaY"in a?a.deltaY:"wheelDeltaY"in a?-a.wheelDeltaY:"wheelDelta"in a?-a.wheelDelta:0},deltaZ:null,deltaMode:null}),Cd=[["blur","blur",0],["cancel","cancel",0],["click","click",0],["close","close",0],["contextmenu","contextMenu",0],["copy","copy",0],["cut","cut",0],["auxclick","auxClick",0],["dblclick","doubleClick",0],["dragend","dragEnd",0],["dragstart","dragStart",0],["drop","drop",0],["focus","focus",0],["input","input",0],["invalid","invalid",0],
["keydown","keyDown",0],["keypress","keyPress",0],["keyup","keyUp",0],["mousedown","mouseDown",0],["mouseup","mouseUp",0],["paste","paste",0],["pause","pause",0],["play","play",0],["pointercancel","pointerCancel",0],["pointerdown","pointerDown",0],["pointerup","pointerUp",0],["ratechange","rateChange",0],["reset","reset",0],["seeked","seeked",0],["submit","submit",0],["touchcancel","touchCancel",0],["touchend","touchEnd",0],["touchstart","touchStart",0],["volumechange","volumeChange",0],["drag","drag",
1],["dragenter","dragEnter",1],["dragexit","dragExit",1],["dragleave","dragLeave",1],["dragover","dragOver",1],["mousemove","mouseMove",1],["mouseout","mouseOut",1],["mouseover","mouseOver",1],["pointermove","pointerMove",1],["pointerout","pointerOut",1],["pointerover","pointerOver",1],["scroll","scroll",1],["toggle","toggle",1],["touchmove","touchMove",1],["wheel","wheel",1],["abort","abort",2],[Xa,"animationEnd",2],[Ya,"animationIteration",2],[Za,"animationStart",2],["canplay","canPlay",2],["canplaythrough",
"canPlayThrough",2],["durationchange","durationChange",2],["emptied","emptied",2],["encrypted","encrypted",2],["ended","ended",2],["error","error",2],["gotpointercapture","gotPointerCapture",2],["load","load",2],["loadeddata","loadedData",2],["loadedmetadata","loadedMetadata",2],["loadstart","loadStart",2],["lostpointercapture","lostPointerCapture",2],["playing","playing",2],["progress","progress",2],["seeking","seeking",2],["stalled","stalled",2],["suspend","suspend",2],["timeupdate","timeUpdate",
2],[ab,"transitionEnd",2],["waiting","waiting",2]],Dd={},Ed={},Fd=0;for(;Fd<Cd.length;Fd++){var Gd=Cd[Fd],Hd=Gd[0],Id=Gd[1],Jd=Gd[2],Kd="on"+(Id[0].toUpperCase()+Id.slice(1)),Ld={phasedRegistrationNames:{bubbled:Kd,captured:Kd+"Capture"},dependencies:[Hd],eventPriority:Jd};Dd[Id]=Ld;Ed[Hd]=Ld}
var Md={eventTypes:Dd,getEventPriority:function(a){a=Ed[a];return void 0!==a?a.eventPriority:2},extractEvents:function(a,b,c,d){var e=Ed[a];if(!e)return null;switch(a){case "keypress":if(0===ud(c))return null;case "keydown":case "keyup":a=xd;break;case "blur":case "focus":a=td;break;case "click":if(2===c.button)return null;case "auxclick":case "dblclick":case "mousedown":case "mousemove":case "mouseup":case "mouseout":case "mouseover":case "contextmenu":a=dd;break;case "drag":case "dragend":case "dragenter":case "dragexit":case "dragleave":case "dragover":case "dragstart":case "drop":a=
yd;break;case "touchcancel":case "touchend":case "touchmove":case "touchstart":a=zd;break;case Xa:case Ya:case Za:a=rd;break;case ab:a=Ad;break;case "scroll":a=Wc;break;case "wheel":a=Bd;break;case "copy":case "cut":case "paste":a=sd;break;case "gotpointercapture":case "lostpointercapture":case "pointercancel":case "pointerdown":case "pointermove":case "pointerout":case "pointerover":case "pointerup":a=ed;break;default:a=y}b=a.getPooled(e,b,c,d);Qa(b);return b}},Nd=Md.getEventPriority,Od=[];
function Pd(a){var b=a.targetInst,c=b;do{if(!c){a.ancestors.push(c);break}var d;for(d=c;d.return;)d=d.return;d=3!==d.tag?null:d.stateNode.containerInfo;if(!d)break;a.ancestors.push(c);c=Ha(d)}while(c);for(c=0;c<a.ancestors.length;c++){b=a.ancestors[c];var e=Rb(a.nativeEvent);d=a.topLevelType;for(var f=a.nativeEvent,h=null,g=0;g<ea.length;g++){var k=ea[g];k&&(k=k.extractEvents(d,b,f,e))&&(h=xa(h,k))}Ba(h)}}var Qd=!0;function G(a,b){Rd(b,a,!1)}
function Rd(a,b,c){switch(Nd(b)){case 0:var d=Sd.bind(null,b,1);break;case 1:d=Td.bind(null,b,1);break;default:d=Ud.bind(null,b,1)}c?a.addEventListener(b,d,!0):a.addEventListener(b,d,!1)}function Sd(a,b,c){Nb||Lb();var d=Ud,e=Nb;Nb=!0;try{Kb(d,a,b,c)}finally{(Nb=e)||Ob()}}function Td(a,b,c){Ud(a,b,c)}
function Ud(a,b,c){if(Qd){b=Rb(c);b=Ha(b);null===b||"number"!==typeof b.tag||2===ld(b)||(b=null);if(Od.length){var d=Od.pop();d.topLevelType=a;d.nativeEvent=c;d.targetInst=b;a=d}else a={topLevelType:a,nativeEvent:c,targetInst:b,ancestors:[]};try{if(c=a,Nb)Pd(c,void 0);else{Nb=!0;try{Mb(Pd,c,void 0)}finally{Nb=!1,Ob()}}}finally{a.topLevelType=null,a.nativeEvent=null,a.targetInst=null,a.ancestors.length=0,10>Od.length&&Od.push(a)}}}var Vd=new ("function"===typeof WeakMap?WeakMap:Map);
function Wd(a){var b=Vd.get(a);void 0===b&&(b=new Set,Vd.set(a,b));return b}function Xd(a){a=a||("undefined"!==typeof document?document:void 0);if("undefined"===typeof a)return null;try{return a.activeElement||a.body}catch(b){return a.body}}function Yd(a){for(;a&&a.firstChild;)a=a.firstChild;return a}
function Zd(a,b){var c=Yd(a);a=0;for(var d;c;){if(3===c.nodeType){d=a+c.textContent.length;if(a<=b&&d>=b)return{node:c,offset:b-a};a=d}a:{for(;c;){if(c.nextSibling){c=c.nextSibling;break a}c=c.parentNode}c=void 0}c=Yd(c)}}function $d(a,b){return a&&b?a===b?!0:a&&3===a.nodeType?!1:b&&3===b.nodeType?$d(a,b.parentNode):"contains"in a?a.contains(b):a.compareDocumentPosition?!!(a.compareDocumentPosition(b)&16):!1:!1}
function ae(){for(var a=window,b=Xd();b instanceof a.HTMLIFrameElement;){try{var c="string"===typeof b.contentWindow.location.href}catch(d){c=!1}if(c)a=b.contentWindow;else break;b=Xd(a.document)}return b}function be(a){var b=a&&a.nodeName&&a.nodeName.toLowerCase();return b&&("input"===b&&("text"===a.type||"search"===a.type||"tel"===a.type||"url"===a.type||"password"===a.type)||"textarea"===b||"true"===a.contentEditable)}
var ce=Ra&&"documentMode"in document&&11>=document.documentMode,de={select:{phasedRegistrationNames:{bubbled:"onSelect",captured:"onSelectCapture"},dependencies:"blur contextmenu dragend focus keydown keyup mousedown mouseup selectionchange".split(" ")}},ee=null,fe=null,ge=null,he=!1;
function ie(a,b){var c=b.window===b?b.document:9===b.nodeType?b:b.ownerDocument;if(he||null==ee||ee!==Xd(c))return null;c=ee;"selectionStart"in c&&be(c)?c={start:c.selectionStart,end:c.selectionEnd}:(c=(c.ownerDocument&&c.ownerDocument.defaultView||window).getSelection(),c={anchorNode:c.anchorNode,anchorOffset:c.anchorOffset,focusNode:c.focusNode,focusOffset:c.focusOffset});return ge&&jd(ge,c)?null:(ge=c,a=y.getPooled(de.select,fe,a,b),a.type="select",a.target=ee,Qa(a),a)}
var je={eventTypes:de,extractEvents:function(a,b,c,d){var e=d.window===d?d.document:9===d.nodeType?d:d.ownerDocument,f;if(!(f=!e)){a:{e=Wd(e);f=ja.onSelect;for(var h=0;h<f.length;h++)if(!e.has(f[h])){e=!1;break a}e=!0}f=!e}if(f)return null;e=b?Ja(b):window;switch(a){case "focus":if(Qb(e)||"true"===e.contentEditable)ee=e,fe=b,ge=null;break;case "blur":ge=fe=ee=null;break;case "mousedown":he=!0;break;case "contextmenu":case "mouseup":case "dragend":return he=!1,ie(c,d);case "selectionchange":if(ce)break;
case "keydown":case "keyup":return ie(c,d)}return null}};Ca.injectEventPluginOrder("ResponderEventPlugin SimpleEventPlugin EnterLeaveEventPlugin ChangeEventPlugin SelectEventPlugin BeforeInputEventPlugin".split(" "));sa=Ka;ta=Ia;va=Ja;Ca.injectEventPluginsByName({SimpleEventPlugin:Md,EnterLeaveEventPlugin:gd,ChangeEventPlugin:Vc,SelectEventPlugin:je,BeforeInputEventPlugin:Cb});function ke(a){var b="";aa.Children.forEach(a,function(a){null!=a&&(b+=a)});return b}
function le(a,b){a=m({children:void 0},b);if(b=ke(b.children))a.children=b;return a}function me(a,b,c,d){a=a.options;if(b){b={};for(var e=0;e<c.length;e++)b["$"+c[e]]=!0;for(c=0;c<a.length;c++)e=b.hasOwnProperty("$"+a[c].value),a[c].selected!==e&&(a[c].selected=e),e&&d&&(a[c].defaultSelected=!0)}else{c=""+Ac(c);b=null;for(e=0;e<a.length;e++){if(a[e].value===c){a[e].selected=!0;d&&(a[e].defaultSelected=!0);return}null!==b||a[e].disabled||(b=a[e])}null!==b&&(b.selected=!0)}}
function ne(a,b){if(null!=b.dangerouslySetInnerHTML)throw t(Error(91));return m({},b,{value:void 0,defaultValue:void 0,children:""+a._wrapperState.initialValue})}function oe(a,b){var c=b.value;if(null==c){c=b.defaultValue;b=b.children;if(null!=b){if(null!=c)throw t(Error(92));if(Array.isArray(b)){if(!(1>=b.length))throw t(Error(93));b=b[0]}c=b}null==c&&(c="")}a._wrapperState={initialValue:Ac(c)}}
function pe(a,b){var c=Ac(b.value),d=Ac(b.defaultValue);null!=c&&(c=""+c,c!==a.value&&(a.value=c),null==b.defaultValue&&a.defaultValue!==c&&(a.defaultValue=c));null!=d&&(a.defaultValue=""+d)}function qe(a){var b=a.textContent;b===a._wrapperState.initialValue&&(a.value=b)}var re={html:"http://www.w3.org/1999/xhtml",mathml:"http://www.w3.org/1998/Math/MathML",svg:"http://www.w3.org/2000/svg"};
function se(a){switch(a){case "svg":return"http://www.w3.org/2000/svg";case "math":return"http://www.w3.org/1998/Math/MathML";default:return"http://www.w3.org/1999/xhtml"}}function te(a,b){return null==a||"http://www.w3.org/1999/xhtml"===a?se(b):"http://www.w3.org/2000/svg"===a&&"foreignObject"===b?"http://www.w3.org/1999/xhtml":a}
var ue=void 0,ve=function(a){return"undefined"!==typeof MSApp&&MSApp.execUnsafeLocalFunction?function(b,c,d,e){MSApp.execUnsafeLocalFunction(function(){return a(b,c,d,e)})}:a}(function(a,b){if(a.namespaceURI!==re.svg||"innerHTML"in a)a.innerHTML=b;else{ue=ue||document.createElement("div");ue.innerHTML="<svg>"+b+"</svg>";for(b=ue.firstChild;a.firstChild;)a.removeChild(a.firstChild);for(;b.firstChild;)a.appendChild(b.firstChild)}});
function we(a,b){if(b){var c=a.firstChild;if(c&&c===a.lastChild&&3===c.nodeType){c.nodeValue=b;return}}a.textContent=b}
var xe={animationIterationCount:!0,borderImageOutset:!0,borderImageSlice:!0,borderImageWidth:!0,boxFlex:!0,boxFlexGroup:!0,boxOrdinalGroup:!0,columnCount:!0,columns:!0,flex:!0,flexGrow:!0,flexPositive:!0,flexShrink:!0,flexNegative:!0,flexOrder:!0,gridArea:!0,gridRow:!0,gridRowEnd:!0,gridRowSpan:!0,gridRowStart:!0,gridColumn:!0,gridColumnEnd:!0,gridColumnSpan:!0,gridColumnStart:!0,fontWeight:!0,lineClamp:!0,lineHeight:!0,opacity:!0,order:!0,orphans:!0,tabSize:!0,widows:!0,zIndex:!0,zoom:!0,fillOpacity:!0,
floodOpacity:!0,stopOpacity:!0,strokeDasharray:!0,strokeDashoffset:!0,strokeMiterlimit:!0,strokeOpacity:!0,strokeWidth:!0},ye=["Webkit","ms","Moz","O"];Object.keys(xe).forEach(function(a){ye.forEach(function(b){b=b+a.charAt(0).toUpperCase()+a.substring(1);xe[b]=xe[a]})});function ze(a,b,c){return null==b||"boolean"===typeof b||""===b?"":c||"number"!==typeof b||0===b||xe.hasOwnProperty(a)&&xe[a]?(""+b).trim():b+"px"}
function Ae(a,b){a=a.style;for(var c in b)if(b.hasOwnProperty(c)){var d=0===c.indexOf("--"),e=ze(c,b[c],d);"float"===c&&(c="cssFloat");d?a.setProperty(c,e):a[c]=e}}var Ce=m({menuitem:!0},{area:!0,base:!0,br:!0,col:!0,embed:!0,hr:!0,img:!0,input:!0,keygen:!0,link:!0,meta:!0,param:!0,source:!0,track:!0,wbr:!0});
function De(a,b){if(b){if(Ce[a]&&(null!=b.children||null!=b.dangerouslySetInnerHTML))throw t(Error(137),a,"");if(null!=b.dangerouslySetInnerHTML){if(null!=b.children)throw t(Error(60));if(!("object"===typeof b.dangerouslySetInnerHTML&&"__html"in b.dangerouslySetInnerHTML))throw t(Error(61));}if(null!=b.style&&"object"!==typeof b.style)throw t(Error(62),"");}}
function Ee(a,b){if(-1===a.indexOf("-"))return"string"===typeof b.is;switch(a){case "annotation-xml":case "color-profile":case "font-face":case "font-face-src":case "font-face-uri":case "font-face-format":case "font-face-name":case "missing-glyph":return!1;default:return!0}}
function Fe(a,b){a=9===a.nodeType||11===a.nodeType?a:a.ownerDocument;var c=Wd(a);b=ja[b];for(var d=0;d<b.length;d++){var e=b[d];if(!c.has(e)){switch(e){case "scroll":Rd(a,"scroll",!0);break;case "focus":case "blur":Rd(a,"focus",!0);Rd(a,"blur",!0);c.add("blur");c.add("focus");break;case "cancel":case "close":Sb(e)&&Rd(a,e,!0);break;case "invalid":case "submit":case "reset":break;default:-1===bb.indexOf(e)&&G(e,a)}c.add(e)}}}function Ge(){}var He=null,Ie=null;
function Je(a,b){switch(a){case "button":case "input":case "select":case "textarea":return!!b.autoFocus}return!1}function Ke(a,b){return"textarea"===a||"option"===a||"noscript"===a||"string"===typeof b.children||"number"===typeof b.children||"object"===typeof b.dangerouslySetInnerHTML&&null!==b.dangerouslySetInnerHTML&&null!=b.dangerouslySetInnerHTML.__html}var Le="function"===typeof setTimeout?setTimeout:void 0,Me="function"===typeof clearTimeout?clearTimeout:void 0;
function Ne(a){for(;null!=a;a=a.nextSibling){var b=a.nodeType;if(1===b||3===b)break}return a}new Set;var Oe=[],Pe=-1;function H(a){0>Pe||(a.current=Oe[Pe],Oe[Pe]=null,Pe--)}function J(a,b){Pe++;Oe[Pe]=a.current;a.current=b}var Qe={},L={current:Qe},M={current:!1},Re=Qe;
function Se(a,b){var c=a.type.contextTypes;if(!c)return Qe;var d=a.stateNode;if(d&&d.__reactInternalMemoizedUnmaskedChildContext===b)return d.__reactInternalMemoizedMaskedChildContext;var e={},f;for(f in c)e[f]=b[f];d&&(a=a.stateNode,a.__reactInternalMemoizedUnmaskedChildContext=b,a.__reactInternalMemoizedMaskedChildContext=e);return e}function N(a){a=a.childContextTypes;return null!==a&&void 0!==a}function Te(a){H(M,a);H(L,a)}function Ue(a){H(M,a);H(L,a)}
function Ve(a,b,c){if(L.current!==Qe)throw t(Error(168));J(L,b,a);J(M,c,a)}function We(a,b,c){var d=a.stateNode;a=b.childContextTypes;if("function"!==typeof d.getChildContext)return c;d=d.getChildContext();for(var e in d)if(!(e in a))throw t(Error(108),oc(b)||"Unknown",e);return m({},c,d)}function Xe(a){var b=a.stateNode;b=b&&b.__reactInternalMemoizedMergedChildContext||Qe;Re=L.current;J(L,b,a);J(M,M.current,a);return!0}
function Ye(a,b,c){var d=a.stateNode;if(!d)throw t(Error(169));c?(b=We(a,b,Re),d.__reactInternalMemoizedMergedChildContext=b,H(M,a),H(L,a),J(L,b,a)):H(M,a);J(M,c,a)}
var Ze=q.unstable_runWithPriority,$e=q.unstable_scheduleCallback,af=q.unstable_cancelCallback,bf=q.unstable_shouldYield,cf=q.unstable_requestPaint,df=q.unstable_now,ef=q.unstable_getCurrentPriorityLevel,ff=q.unstable_ImmediatePriority,hf=q.unstable_UserBlockingPriority,jf=q.unstable_NormalPriority,kf=q.unstable_LowPriority,lf=q.unstable_IdlePriority,mf={},nf=void 0!==cf?cf:function(){},of=null,pf=null,qf=!1,rf=df(),sf=1E4>rf?df:function(){return df()-rf};
function tf(){switch(ef()){case ff:return 99;case hf:return 98;case jf:return 97;case kf:return 96;case lf:return 95;default:throw t(Error(332));}}function uf(a){switch(a){case 99:return ff;case 98:return hf;case 97:return jf;case 96:return kf;case 95:return lf;default:throw t(Error(332));}}function vf(a,b){a=uf(a);return Ze(a,b)}function wf(a,b,c){a=uf(a);return $e(a,b,c)}function xf(a){null===of?(of=[a],pf=$e(ff,yf)):of.push(a);return mf}function O(){null!==pf&&af(pf);yf()}
function yf(){if(!qf&&null!==of){qf=!0;var a=0;try{var b=of;vf(99,function(){for(;a<b.length;a++){var c=b[a];do c=c(!0);while(null!==c)}});of=null}catch(c){throw null!==of&&(of=of.slice(a+1)),$e(ff,O),c;}finally{qf=!1}}}function zf(a,b){if(1073741823===b)return 99;if(1===b)return 95;a=10*(1073741821-b)-10*(1073741821-a);return 0>=a?99:250>=a?98:5250>=a?97:95}function Af(a,b){if(a&&a.defaultProps){b=m({},b);a=a.defaultProps;for(var c in a)void 0===b[c]&&(b[c]=a[c])}return b}
function Bf(a){var b=a._result;switch(a._status){case 1:return b;case 2:throw b;case 0:throw b;default:a._status=0;b=a._ctor;b=b();b.then(function(b){0===a._status&&(b=b.default,a._status=1,a._result=b)},function(b){0===a._status&&(a._status=2,a._result=b)});switch(a._status){case 1:return a._result;case 2:throw a._result;}a._result=b;throw b;}}var Cf={current:null},Df=null,Ef=null,Ff=null;function Gf(){Ff=Ef=Df=null}
function Hf(a,b){var c=a.type._context;J(Cf,c._currentValue,a);c._currentValue=b}function If(a){var b=Cf.current;H(Cf,a);a.type._context._currentValue=b}function Jf(a,b){for(;null!==a;){var c=a.alternate;if(a.childExpirationTime<b)a.childExpirationTime=b,null!==c&&c.childExpirationTime<b&&(c.childExpirationTime=b);else if(null!==c&&c.childExpirationTime<b)c.childExpirationTime=b;else break;a=a.return}}
function Kf(a,b){Df=a;Ff=Ef=null;a=a.dependencies;null!==a&&null!==a.firstContext&&(a.expirationTime>=b&&(Lf=!0),a.firstContext=null)}function Mf(a,b){if(Ff!==a&&!1!==b&&0!==b){if("number"!==typeof b||1073741823===b)Ff=a,b=1073741823;b={context:a,observedBits:b,next:null};if(null===Ef){if(null===Df)throw t(Error(308));Ef=b;Df.dependencies={expirationTime:0,firstContext:b,responders:null}}else Ef=Ef.next=b}return a._currentValue}var Nf=!1;
function Of(a){return{baseState:a,firstUpdate:null,lastUpdate:null,firstCapturedUpdate:null,lastCapturedUpdate:null,firstEffect:null,lastEffect:null,firstCapturedEffect:null,lastCapturedEffect:null}}function Pf(a){return{baseState:a.baseState,firstUpdate:a.firstUpdate,lastUpdate:a.lastUpdate,firstCapturedUpdate:null,lastCapturedUpdate:null,firstEffect:null,lastEffect:null,firstCapturedEffect:null,lastCapturedEffect:null}}
function Qf(a,b){return{expirationTime:a,suspenseConfig:b,tag:0,payload:null,callback:null,next:null,nextEffect:null}}function Rf(a,b){null===a.lastUpdate?a.firstUpdate=a.lastUpdate=b:(a.lastUpdate.next=b,a.lastUpdate=b)}
function Sf(a,b){var c=a.alternate;if(null===c){var d=a.updateQueue;var e=null;null===d&&(d=a.updateQueue=Of(a.memoizedState))}else d=a.updateQueue,e=c.updateQueue,null===d?null===e?(d=a.updateQueue=Of(a.memoizedState),e=c.updateQueue=Of(c.memoizedState)):d=a.updateQueue=Pf(e):null===e&&(e=c.updateQueue=Pf(d));null===e||d===e?Rf(d,b):null===d.lastUpdate||null===e.lastUpdate?(Rf(d,b),Rf(e,b)):(Rf(d,b),e.lastUpdate=b)}
function Tf(a,b){var c=a.updateQueue;c=null===c?a.updateQueue=Of(a.memoizedState):Uf(a,c);null===c.lastCapturedUpdate?c.firstCapturedUpdate=c.lastCapturedUpdate=b:(c.lastCapturedUpdate.next=b,c.lastCapturedUpdate=b)}function Uf(a,b){var c=a.alternate;null!==c&&b===c.updateQueue&&(b=a.updateQueue=Pf(b));return b}
function Vf(a,b,c,d,e,f){switch(c.tag){case 1:return a=c.payload,"function"===typeof a?a.call(f,d,e):a;case 3:a.effectTag=a.effectTag&-2049|64;case 0:a=c.payload;e="function"===typeof a?a.call(f,d,e):a;if(null===e||void 0===e)break;return m({},d,e);case 2:Nf=!0}return d}
function Wf(a,b,c,d,e){Nf=!1;b=Uf(a,b);for(var f=b.baseState,h=null,g=0,k=b.firstUpdate,l=f;null!==k;){var n=k.expirationTime;n<e?(null===h&&(h=k,f=l),g<n&&(g=n)):(Xf(n,k.suspenseConfig),l=Vf(a,b,k,l,c,d),null!==k.callback&&(a.effectTag|=32,k.nextEffect=null,null===b.lastEffect?b.firstEffect=b.lastEffect=k:(b.lastEffect.nextEffect=k,b.lastEffect=k)));k=k.next}n=null;for(k=b.firstCapturedUpdate;null!==k;){var z=k.expirationTime;z<e?(null===n&&(n=k,null===h&&(f=l)),g<z&&(g=z)):(l=Vf(a,b,k,l,c,d),null!==
k.callback&&(a.effectTag|=32,k.nextEffect=null,null===b.lastCapturedEffect?b.firstCapturedEffect=b.lastCapturedEffect=k:(b.lastCapturedEffect.nextEffect=k,b.lastCapturedEffect=k)));k=k.next}null===h&&(b.lastUpdate=null);null===n?b.lastCapturedUpdate=null:a.effectTag|=32;null===h&&null===n&&(f=l);b.baseState=f;b.firstUpdate=h;b.firstCapturedUpdate=n;a.expirationTime=g;a.memoizedState=l}
function Yf(a,b,c){null!==b.firstCapturedUpdate&&(null!==b.lastUpdate&&(b.lastUpdate.next=b.firstCapturedUpdate,b.lastUpdate=b.lastCapturedUpdate),b.firstCapturedUpdate=b.lastCapturedUpdate=null);Zf(b.firstEffect,c);b.firstEffect=b.lastEffect=null;Zf(b.firstCapturedEffect,c);b.firstCapturedEffect=b.lastCapturedEffect=null}function Zf(a,b){for(;null!==a;){var c=a.callback;if(null!==c){a.callback=null;var d=b;if("function"!==typeof c)throw t(Error(191),c);c.call(d)}a=a.nextEffect}}
var $f=Xb.ReactCurrentBatchConfig,ag=(new aa.Component).refs;function bg(a,b,c,d){b=a.memoizedState;c=c(d,b);c=null===c||void 0===c?b:m({},b,c);a.memoizedState=c;d=a.updateQueue;null!==d&&0===a.expirationTime&&(d.baseState=c)}
var fg={isMounted:function(a){return(a=a._reactInternalFiber)?2===ld(a):!1},enqueueSetState:function(a,b,c){a=a._reactInternalFiber;var d=cg(),e=$f.suspense;d=dg(d,a,e);e=Qf(d,e);e.payload=b;void 0!==c&&null!==c&&(e.callback=c);Sf(a,e);eg(a,d)},enqueueReplaceState:function(a,b,c){a=a._reactInternalFiber;var d=cg(),e=$f.suspense;d=dg(d,a,e);e=Qf(d,e);e.tag=1;e.payload=b;void 0!==c&&null!==c&&(e.callback=c);Sf(a,e);eg(a,d)},enqueueForceUpdate:function(a,b){a=a._reactInternalFiber;var c=cg(),d=$f.suspense;
c=dg(c,a,d);d=Qf(c,d);d.tag=2;void 0!==b&&null!==b&&(d.callback=b);Sf(a,d);eg(a,c)}};function gg(a,b,c,d,e,f,h){a=a.stateNode;return"function"===typeof a.shouldComponentUpdate?a.shouldComponentUpdate(d,f,h):b.prototype&&b.prototype.isPureReactComponent?!jd(c,d)||!jd(e,f):!0}
function hg(a,b,c){var d=!1,e=Qe;var f=b.contextType;"object"===typeof f&&null!==f?f=Mf(f):(e=N(b)?Re:L.current,d=b.contextTypes,f=(d=null!==d&&void 0!==d)?Se(a,e):Qe);b=new b(c,f);a.memoizedState=null!==b.state&&void 0!==b.state?b.state:null;b.updater=fg;a.stateNode=b;b._reactInternalFiber=a;d&&(a=a.stateNode,a.__reactInternalMemoizedUnmaskedChildContext=e,a.__reactInternalMemoizedMaskedChildContext=f);return b}
function ig(a,b,c,d){a=b.state;"function"===typeof b.componentWillReceiveProps&&b.componentWillReceiveProps(c,d);"function"===typeof b.UNSAFE_componentWillReceiveProps&&b.UNSAFE_componentWillReceiveProps(c,d);b.state!==a&&fg.enqueueReplaceState(b,b.state,null)}
function jg(a,b,c,d){var e=a.stateNode;e.props=c;e.state=a.memoizedState;e.refs=ag;var f=b.contextType;"object"===typeof f&&null!==f?e.context=Mf(f):(f=N(b)?Re:L.current,e.context=Se(a,f));f=a.updateQueue;null!==f&&(Wf(a,f,c,e,d),e.state=a.memoizedState);f=b.getDerivedStateFromProps;"function"===typeof f&&(bg(a,b,f,c),e.state=a.memoizedState);"function"===typeof b.getDerivedStateFromProps||"function"===typeof e.getSnapshotBeforeUpdate||"function"!==typeof e.UNSAFE_componentWillMount&&"function"!==
typeof e.componentWillMount||(b=e.state,"function"===typeof e.componentWillMount&&e.componentWillMount(),"function"===typeof e.UNSAFE_componentWillMount&&e.UNSAFE_componentWillMount(),b!==e.state&&fg.enqueueReplaceState(e,e.state,null),f=a.updateQueue,null!==f&&(Wf(a,f,c,e,d),e.state=a.memoizedState));"function"===typeof e.componentDidMount&&(a.effectTag|=4)}var kg=Array.isArray;
function lg(a,b,c){a=c.ref;if(null!==a&&"function"!==typeof a&&"object"!==typeof a){if(c._owner){c=c._owner;var d=void 0;if(c){if(1!==c.tag)throw t(Error(309));d=c.stateNode}if(!d)throw t(Error(147),a);var e=""+a;if(null!==b&&null!==b.ref&&"function"===typeof b.ref&&b.ref._stringRef===e)return b.ref;b=function(a){var b=d.refs;b===ag&&(b=d.refs={});null===a?delete b[e]:b[e]=a};b._stringRef=e;return b}if("string"!==typeof a)throw t(Error(284));if(!c._owner)throw t(Error(290),a);}return a}
function mg(a,b){if("textarea"!==a.type)throw t(Error(31),"[object Object]"===Object.prototype.toString.call(b)?"object with keys {"+Object.keys(b).join(", ")+"}":b,"");}
function ng(a){function b(b,c){if(a){var d=b.lastEffect;null!==d?(d.nextEffect=c,b.lastEffect=c):b.firstEffect=b.lastEffect=c;c.nextEffect=null;c.effectTag=8}}function c(c,d){if(!a)return null;for(;null!==d;)b(c,d),d=d.sibling;return null}function d(a,b){for(a=new Map;null!==b;)null!==b.key?a.set(b.key,b):a.set(b.index,b),b=b.sibling;return a}function e(a,b,c){a=og(a,b,c);a.index=0;a.sibling=null;return a}function f(b,c,d){b.index=d;if(!a)return c;d=b.alternate;if(null!==d)return d=d.index,d<c?(b.effectTag=
2,c):d;b.effectTag=2;return c}function h(b){a&&null===b.alternate&&(b.effectTag=2);return b}function g(a,b,c,d){if(null===b||6!==b.tag)return b=pg(c,a.mode,d),b.return=a,b;b=e(b,c,d);b.return=a;return b}function k(a,b,c,d){if(null!==b&&b.elementType===c.type)return d=e(b,c.props,d),d.ref=lg(a,b,c),d.return=a,d;d=qg(c.type,c.key,c.props,null,a.mode,d);d.ref=lg(a,b,c);d.return=a;return d}function l(a,b,c,d){if(null===b||4!==b.tag||b.stateNode.containerInfo!==c.containerInfo||b.stateNode.implementation!==
c.implementation)return b=rg(c,a.mode,d),b.return=a,b;b=e(b,c.children||[],d);b.return=a;return b}function n(a,b,c,d,f){if(null===b||7!==b.tag)return b=sg(c,a.mode,d,f),b.return=a,b;b=e(b,c,d);b.return=a;return b}function z(a,b,c){if("string"===typeof b||"number"===typeof b)return b=pg(""+b,a.mode,c),b.return=a,b;if("object"===typeof b&&null!==b){switch(b.$$typeof){case Zb:return c=qg(b.type,b.key,b.props,null,a.mode,c),c.ref=lg(a,null,b),c.return=a,c;case $b:return b=rg(b,a.mode,c),b.return=a,b}if(kg(b)||
mc(b))return b=sg(b,a.mode,c,null),b.return=a,b;mg(a,b)}return null}function x(a,b,c,d){var e=null!==b?b.key:null;if("string"===typeof c||"number"===typeof c)return null!==e?null:g(a,b,""+c,d);if("object"===typeof c&&null!==c){switch(c.$$typeof){case Zb:return c.key===e?c.type===ac?n(a,b,c.props.children,d,e):k(a,b,c,d):null;case $b:return c.key===e?l(a,b,c,d):null}if(kg(c)||mc(c))return null!==e?null:n(a,b,c,d,null);mg(a,c)}return null}function v(a,b,c,d,e){if("string"===typeof d||"number"===typeof d)return a=
a.get(c)||null,g(b,a,""+d,e);if("object"===typeof d&&null!==d){switch(d.$$typeof){case Zb:return a=a.get(null===d.key?c:d.key)||null,d.type===ac?n(b,a,d.props.children,e,d.key):k(b,a,d,e);case $b:return a=a.get(null===d.key?c:d.key)||null,l(b,a,d,e)}if(kg(d)||mc(d))return a=a.get(c)||null,n(b,a,d,e,null);mg(b,d)}return null}function rb(e,h,g,k){for(var l=null,u=null,n=h,w=h=0,C=null;null!==n&&w<g.length;w++){n.index>w?(C=n,n=null):C=n.sibling;var p=x(e,n,g[w],k);if(null===p){null===n&&(n=C);break}a&&
n&&null===p.alternate&&b(e,n);h=f(p,h,w);null===u?l=p:u.sibling=p;u=p;n=C}if(w===g.length)return c(e,n),l;if(null===n){for(;w<g.length;w++)n=z(e,g[w],k),null!==n&&(h=f(n,h,w),null===u?l=n:u.sibling=n,u=n);return l}for(n=d(e,n);w<g.length;w++)C=v(n,e,w,g[w],k),null!==C&&(a&&null!==C.alternate&&n.delete(null===C.key?w:C.key),h=f(C,h,w),null===u?l=C:u.sibling=C,u=C);a&&n.forEach(function(a){return b(e,a)});return l}function Be(e,h,g,k){var l=mc(g);if("function"!==typeof l)throw t(Error(150));g=l.call(g);
if(null==g)throw t(Error(151));for(var n=l=null,u=h,w=h=0,C=null,p=g.next();null!==u&&!p.done;w++,p=g.next()){u.index>w?(C=u,u=null):C=u.sibling;var r=x(e,u,p.value,k);if(null===r){null===u&&(u=C);break}a&&u&&null===r.alternate&&b(e,u);h=f(r,h,w);null===n?l=r:n.sibling=r;n=r;u=C}if(p.done)return c(e,u),l;if(null===u){for(;!p.done;w++,p=g.next())p=z(e,p.value,k),null!==p&&(h=f(p,h,w),null===n?l=p:n.sibling=p,n=p);return l}for(u=d(e,u);!p.done;w++,p=g.next())p=v(u,e,w,p.value,k),null!==p&&(a&&null!==
p.alternate&&u.delete(null===p.key?w:p.key),h=f(p,h,w),null===n?l=p:n.sibling=p,n=p);a&&u.forEach(function(a){return b(e,a)});return l}return function(a,d,f,g){var k="object"===typeof f&&null!==f&&f.type===ac&&null===f.key;k&&(f=f.props.children);var l="object"===typeof f&&null!==f;if(l)switch(f.$$typeof){case Zb:a:{l=f.key;for(k=d;null!==k;){if(k.key===l){if(7===k.tag?f.type===ac:k.elementType===f.type){c(a,k.sibling);d=e(k,f.type===ac?f.props.children:f.props,g);d.ref=lg(a,k,f);d.return=a;a=d;break a}c(a,
k);break}else b(a,k);k=k.sibling}f.type===ac?(d=sg(f.props.children,a.mode,g,f.key),d.return=a,a=d):(g=qg(f.type,f.key,f.props,null,a.mode,g),g.ref=lg(a,d,f),g.return=a,a=g)}return h(a);case $b:a:{for(k=f.key;null!==d;){if(d.key===k){if(4===d.tag&&d.stateNode.containerInfo===f.containerInfo&&d.stateNode.implementation===f.implementation){c(a,d.sibling);d=e(d,f.children||[],g);d.return=a;a=d;break a}c(a,d);break}else b(a,d);d=d.sibling}d=rg(f,a.mode,g);d.return=a;a=d}return h(a)}if("string"===typeof f||
"number"===typeof f)return f=""+f,null!==d&&6===d.tag?(c(a,d.sibling),d=e(d,f,g),d.return=a,a=d):(c(a,d),d=pg(f,a.mode,g),d.return=a,a=d),h(a);if(kg(f))return rb(a,d,f,g);if(mc(f))return Be(a,d,f,g);l&&mg(a,f);if("undefined"===typeof f&&!k)switch(a.tag){case 1:case 0:throw a=a.type,t(Error(152),a.displayName||a.name||"Component");}return c(a,d)}}var tg=ng(!0),ug=ng(!1),vg={},wg={current:vg},xg={current:vg},yg={current:vg};function zg(a){if(a===vg)throw t(Error(174));return a}
function Ag(a,b){J(yg,b,a);J(xg,a,a);J(wg,vg,a);var c=b.nodeType;switch(c){case 9:case 11:b=(b=b.documentElement)?b.namespaceURI:te(null,"");break;default:c=8===c?b.parentNode:b,b=c.namespaceURI||null,c=c.tagName,b=te(b,c)}H(wg,a);J(wg,b,a)}function Bg(a){H(wg,a);H(xg,a);H(yg,a)}function Cg(a){zg(yg.current);var b=zg(wg.current);var c=te(b,a.type);b!==c&&(J(xg,a,a),J(wg,c,a))}function Dg(a){xg.current===a&&(H(wg,a),H(xg,a))}var Eg=1,Fg=1,Gg=2,P={current:0};
function Hg(a){for(var b=a;null!==b;){if(13===b.tag){if(null!==b.memoizedState)return b}else if(19===b.tag&&void 0!==b.memoizedProps.revealOrder){if(0!==(b.effectTag&64))return b}else if(null!==b.child){b.child.return=b;b=b.child;continue}if(b===a)break;for(;null===b.sibling;){if(null===b.return||b.return===a)return null;b=b.return}b.sibling.return=b.return;b=b.sibling}return null}
var Ig=0,Jg=2,Kg=4,Lg=8,Mg=16,Ng=32,Og=64,Pg=128,Qg=Xb.ReactCurrentDispatcher,Rg=0,Sg=null,Q=null,Tg=null,Ug=null,R=null,Vg=null,Wg=0,Xg=null,Yg=0,Zg=!1,$g=null,ah=0;function bh(){throw t(Error(321));}function ch(a,b){if(null===b)return!1;for(var c=0;c<b.length&&c<a.length;c++)if(!hd(a[c],b[c]))return!1;return!0}
function dh(a,b,c,d,e,f){Rg=f;Sg=b;Tg=null!==a?a.memoizedState:null;Qg.current=null===Tg?eh:fh;b=c(d,e);if(Zg){do Zg=!1,ah+=1,Tg=null!==a?a.memoizedState:null,Vg=Ug,Xg=R=Q=null,Qg.current=fh,b=c(d,e);while(Zg);$g=null;ah=0}Qg.current=hh;a=Sg;a.memoizedState=Ug;a.expirationTime=Wg;a.updateQueue=Xg;a.effectTag|=Yg;a=null!==Q&&null!==Q.next;Rg=0;Vg=R=Ug=Tg=Q=Sg=null;Wg=0;Xg=null;Yg=0;if(a)throw t(Error(300));return b}
function ih(){Qg.current=hh;Rg=0;Vg=R=Ug=Tg=Q=Sg=null;Wg=0;Xg=null;Yg=0;Zg=!1;$g=null;ah=0}function jh(){var a={memoizedState:null,baseState:null,queue:null,baseUpdate:null,next:null};null===R?Ug=R=a:R=R.next=a;return R}function kh(){if(null!==Vg)R=Vg,Vg=R.next,Q=Tg,Tg=null!==Q?Q.next:null;else{if(null===Tg)throw t(Error(310));Q=Tg;var a={memoizedState:Q.memoizedState,baseState:Q.baseState,queue:Q.queue,baseUpdate:Q.baseUpdate,next:null};R=null===R?Ug=a:R.next=a;Tg=Q.next}return R}
function lh(a,b){return"function"===typeof b?b(a):b}
function mh(a){var b=kh(),c=b.queue;if(null===c)throw t(Error(311));c.lastRenderedReducer=a;if(0<ah){var d=c.dispatch;if(null!==$g){var e=$g.get(c);if(void 0!==e){$g.delete(c);var f=b.memoizedState;do f=a(f,e.action),e=e.next;while(null!==e);hd(f,b.memoizedState)||(Lf=!0);b.memoizedState=f;b.baseUpdate===c.last&&(b.baseState=f);c.lastRenderedState=f;return[f,d]}}return[b.memoizedState,d]}d=c.last;var h=b.baseUpdate;f=b.baseState;null!==h?(null!==d&&(d.next=null),d=h.next):d=null!==d?d.next:null;if(null!==
d){var g=e=null,k=d,l=!1;do{var n=k.expirationTime;n<Rg?(l||(l=!0,g=h,e=f),n>Wg&&(Wg=n)):(Xf(n,k.suspenseConfig),f=k.eagerReducer===a?k.eagerState:a(f,k.action));h=k;k=k.next}while(null!==k&&k!==d);l||(g=h,e=f);hd(f,b.memoizedState)||(Lf=!0);b.memoizedState=f;b.baseUpdate=g;b.baseState=e;c.lastRenderedState=f}return[b.memoizedState,c.dispatch]}
function nh(a,b,c,d){a={tag:a,create:b,destroy:c,deps:d,next:null};null===Xg?(Xg={lastEffect:null},Xg.lastEffect=a.next=a):(b=Xg.lastEffect,null===b?Xg.lastEffect=a.next=a:(c=b.next,b.next=a,a.next=c,Xg.lastEffect=a));return a}function oh(a,b,c,d){var e=jh();Yg|=a;e.memoizedState=nh(b,c,void 0,void 0===d?null:d)}
function ph(a,b,c,d){var e=kh();d=void 0===d?null:d;var f=void 0;if(null!==Q){var h=Q.memoizedState;f=h.destroy;if(null!==d&&ch(d,h.deps)){nh(Ig,c,f,d);return}}Yg|=a;e.memoizedState=nh(b,c,f,d)}function qh(a,b){if("function"===typeof b)return a=a(),b(a),function(){b(null)};if(null!==b&&void 0!==b)return a=a(),b.current=a,function(){b.current=null}}function rh(){}
function sh(a,b,c){if(!(25>ah))throw t(Error(301));var d=a.alternate;if(a===Sg||null!==d&&d===Sg)if(Zg=!0,a={expirationTime:Rg,suspenseConfig:null,action:c,eagerReducer:null,eagerState:null,next:null},null===$g&&($g=new Map),c=$g.get(b),void 0===c)$g.set(b,a);else{for(b=c;null!==b.next;)b=b.next;b.next=a}else{var e=cg(),f=$f.suspense;e=dg(e,a,f);f={expirationTime:e,suspenseConfig:f,action:c,eagerReducer:null,eagerState:null,next:null};var h=b.last;if(null===h)f.next=f;else{var g=h.next;null!==g&&
(f.next=g);h.next=f}b.last=f;if(0===a.expirationTime&&(null===d||0===d.expirationTime)&&(d=b.lastRenderedReducer,null!==d))try{var k=b.lastRenderedState,l=d(k,c);f.eagerReducer=d;f.eagerState=l;if(hd(l,k))return}catch(n){}finally{}eg(a,e)}}
var hh={readContext:Mf,useCallback:bh,useContext:bh,useEffect:bh,useImperativeHandle:bh,useLayoutEffect:bh,useMemo:bh,useReducer:bh,useRef:bh,useState:bh,useDebugValue:bh,useResponder:bh},eh={readContext:Mf,useCallback:function(a,b){jh().memoizedState=[a,void 0===b?null:b];return a},useContext:Mf,useEffect:function(a,b){return oh(516,Pg|Og,a,b)},useImperativeHandle:function(a,b,c){c=null!==c&&void 0!==c?c.concat([a]):null;return oh(4,Kg|Ng,qh.bind(null,b,a),c)},useLayoutEffect:function(a,b){return oh(4,
Kg|Ng,a,b)},useMemo:function(a,b){var c=jh();b=void 0===b?null:b;a=a();c.memoizedState=[a,b];return a},useReducer:function(a,b,c){var d=jh();b=void 0!==c?c(b):b;d.memoizedState=d.baseState=b;a=d.queue={last:null,dispatch:null,lastRenderedReducer:a,lastRenderedState:b};a=a.dispatch=sh.bind(null,Sg,a);return[d.memoizedState,a]},useRef:function(a){var b=jh();a={current:a};return b.memoizedState=a},useState:function(a){var b=jh();"function"===typeof a&&(a=a());b.memoizedState=b.baseState=a;a=b.queue=
{last:null,dispatch:null,lastRenderedReducer:lh,lastRenderedState:a};a=a.dispatch=sh.bind(null,Sg,a);return[b.memoizedState,a]},useDebugValue:rh,useResponder:kd},fh={readContext:Mf,useCallback:function(a,b){var c=kh();b=void 0===b?null:b;var d=c.memoizedState;if(null!==d&&null!==b&&ch(b,d[1]))return d[0];c.memoizedState=[a,b];return a},useContext:Mf,useEffect:function(a,b){return ph(516,Pg|Og,a,b)},useImperativeHandle:function(a,b,c){c=null!==c&&void 0!==c?c.concat([a]):null;return ph(4,Kg|Ng,qh.bind(null,
b,a),c)},useLayoutEffect:function(a,b){return ph(4,Kg|Ng,a,b)},useMemo:function(a,b){var c=kh();b=void 0===b?null:b;var d=c.memoizedState;if(null!==d&&null!==b&&ch(b,d[1]))return d[0];a=a();c.memoizedState=[a,b];return a},useReducer:mh,useRef:function(){return kh().memoizedState},useState:function(a){return mh(lh,a)},useDebugValue:rh,useResponder:kd},th=null,uh=null,vh=!1;
function wh(a,b){var c=xh(5,null,null,0);c.elementType="DELETED";c.type="DELETED";c.stateNode=b;c.return=a;c.effectTag=8;null!==a.lastEffect?(a.lastEffect.nextEffect=c,a.lastEffect=c):a.firstEffect=a.lastEffect=c}function yh(a,b){switch(a.tag){case 5:var c=a.type;b=1!==b.nodeType||c.toLowerCase()!==b.nodeName.toLowerCase()?null:b;return null!==b?(a.stateNode=b,!0):!1;case 6:return b=""===a.pendingProps||3!==b.nodeType?null:b,null!==b?(a.stateNode=b,!0):!1;case 13:return!1;default:return!1}}
function zh(a){if(vh){var b=uh;if(b){var c=b;if(!yh(a,b)){b=Ne(c.nextSibling);if(!b||!yh(a,b)){a.effectTag|=2;vh=!1;th=a;return}wh(th,c)}th=a;uh=Ne(b.firstChild)}else a.effectTag|=2,vh=!1,th=a}}function Ah(a){for(a=a.return;null!==a&&5!==a.tag&&3!==a.tag&&18!==a.tag;)a=a.return;th=a}
function Bh(a){if(a!==th)return!1;if(!vh)return Ah(a),vh=!0,!1;var b=a.type;if(5!==a.tag||"head"!==b&&"body"!==b&&!Ke(b,a.memoizedProps))for(b=uh;b;)wh(a,b),b=Ne(b.nextSibling);Ah(a);uh=th?Ne(a.stateNode.nextSibling):null;return!0}function Ch(){uh=th=null;vh=!1}var Dh=Xb.ReactCurrentOwner,Lf=!1;function S(a,b,c,d){b.child=null===a?ug(b,null,c,d):tg(b,a.child,c,d)}
function Eh(a,b,c,d,e){c=c.render;var f=b.ref;Kf(b,e);d=dh(a,b,c,d,f,e);if(null!==a&&!Lf)return b.updateQueue=a.updateQueue,b.effectTag&=-517,a.expirationTime<=e&&(a.expirationTime=0),Fh(a,b,e);b.effectTag|=1;S(a,b,d,e);return b.child}
function Gh(a,b,c,d,e,f){if(null===a){var h=c.type;if("function"===typeof h&&!Hh(h)&&void 0===h.defaultProps&&null===c.compare&&void 0===c.defaultProps)return b.tag=15,b.type=h,Ih(a,b,h,d,e,f);a=qg(c.type,null,d,null,b.mode,f);a.ref=b.ref;a.return=b;return b.child=a}h=a.child;if(e<f&&(e=h.memoizedProps,c=c.compare,c=null!==c?c:jd,c(e,d)&&a.ref===b.ref))return Fh(a,b,f);b.effectTag|=1;a=og(h,d,f);a.ref=b.ref;a.return=b;return b.child=a}
function Ih(a,b,c,d,e,f){return null!==a&&jd(a.memoizedProps,d)&&a.ref===b.ref&&(Lf=!1,e<f)?Fh(a,b,f):Jh(a,b,c,d,f)}function Kh(a,b){var c=b.ref;if(null===a&&null!==c||null!==a&&a.ref!==c)b.effectTag|=128}function Jh(a,b,c,d,e){var f=N(c)?Re:L.current;f=Se(b,f);Kf(b,e);c=dh(a,b,c,d,f,e);if(null!==a&&!Lf)return b.updateQueue=a.updateQueue,b.effectTag&=-517,a.expirationTime<=e&&(a.expirationTime=0),Fh(a,b,e);b.effectTag|=1;S(a,b,c,e);return b.child}
function Lh(a,b,c,d,e){if(N(c)){var f=!0;Xe(b)}else f=!1;Kf(b,e);if(null===b.stateNode)null!==a&&(a.alternate=null,b.alternate=null,b.effectTag|=2),hg(b,c,d,e),jg(b,c,d,e),d=!0;else if(null===a){var h=b.stateNode,g=b.memoizedProps;h.props=g;var k=h.context,l=c.contextType;"object"===typeof l&&null!==l?l=Mf(l):(l=N(c)?Re:L.current,l=Se(b,l));var n=c.getDerivedStateFromProps,z="function"===typeof n||"function"===typeof h.getSnapshotBeforeUpdate;z||"function"!==typeof h.UNSAFE_componentWillReceiveProps&&
"function"!==typeof h.componentWillReceiveProps||(g!==d||k!==l)&&ig(b,h,d,l);Nf=!1;var x=b.memoizedState;k=h.state=x;var v=b.updateQueue;null!==v&&(Wf(b,v,d,h,e),k=b.memoizedState);g!==d||x!==k||M.current||Nf?("function"===typeof n&&(bg(b,c,n,d),k=b.memoizedState),(g=Nf||gg(b,c,g,d,x,k,l))?(z||"function"!==typeof h.UNSAFE_componentWillMount&&"function"!==typeof h.componentWillMount||("function"===typeof h.componentWillMount&&h.componentWillMount(),"function"===typeof h.UNSAFE_componentWillMount&&
h.UNSAFE_componentWillMount()),"function"===typeof h.componentDidMount&&(b.effectTag|=4)):("function"===typeof h.componentDidMount&&(b.effectTag|=4),b.memoizedProps=d,b.memoizedState=k),h.props=d,h.state=k,h.context=l,d=g):("function"===typeof h.componentDidMount&&(b.effectTag|=4),d=!1)}else h=b.stateNode,g=b.memoizedProps,h.props=b.type===b.elementType?g:Af(b.type,g),k=h.context,l=c.contextType,"object"===typeof l&&null!==l?l=Mf(l):(l=N(c)?Re:L.current,l=Se(b,l)),n=c.getDerivedStateFromProps,(z=
"function"===typeof n||"function"===typeof h.getSnapshotBeforeUpdate)||"function"!==typeof h.UNSAFE_componentWillReceiveProps&&"function"!==typeof h.componentWillReceiveProps||(g!==d||k!==l)&&ig(b,h,d,l),Nf=!1,k=b.memoizedState,x=h.state=k,v=b.updateQueue,null!==v&&(Wf(b,v,d,h,e),x=b.memoizedState),g!==d||k!==x||M.current||Nf?("function"===typeof n&&(bg(b,c,n,d),x=b.memoizedState),(n=Nf||gg(b,c,g,d,k,x,l))?(z||"function"!==typeof h.UNSAFE_componentWillUpdate&&"function"!==typeof h.componentWillUpdate||
("function"===typeof h.componentWillUpdate&&h.componentWillUpdate(d,x,l),"function"===typeof h.UNSAFE_componentWillUpdate&&h.UNSAFE_componentWillUpdate(d,x,l)),"function"===typeof h.componentDidUpdate&&(b.effectTag|=4),"function"===typeof h.getSnapshotBeforeUpdate&&(b.effectTag|=256)):("function"!==typeof h.componentDidUpdate||g===a.memoizedProps&&k===a.memoizedState||(b.effectTag|=4),"function"!==typeof h.getSnapshotBeforeUpdate||g===a.memoizedProps&&k===a.memoizedState||(b.effectTag|=256),b.memoizedProps=
d,b.memoizedState=x),h.props=d,h.state=x,h.context=l,d=n):("function"!==typeof h.componentDidUpdate||g===a.memoizedProps&&k===a.memoizedState||(b.effectTag|=4),"function"!==typeof h.getSnapshotBeforeUpdate||g===a.memoizedProps&&k===a.memoizedState||(b.effectTag|=256),d=!1);return Mh(a,b,c,d,f,e)}
function Mh(a,b,c,d,e,f){Kh(a,b);var h=0!==(b.effectTag&64);if(!d&&!h)return e&&Ye(b,c,!1),Fh(a,b,f);d=b.stateNode;Dh.current=b;var g=h&&"function"!==typeof c.getDerivedStateFromError?null:d.render();b.effectTag|=1;null!==a&&h?(b.child=tg(b,a.child,null,f),b.child=tg(b,null,g,f)):S(a,b,g,f);b.memoizedState=d.state;e&&Ye(b,c,!0);return b.child}function Nh(a){var b=a.stateNode;b.pendingContext?Ve(a,b.pendingContext,b.pendingContext!==b.context):b.context&&Ve(a,b.context,!1);Ag(a,b.containerInfo)}
var Oh={};
function Ph(a,b,c){var d=b.mode,e=b.pendingProps,f=P.current,h=null,g=!1,k;(k=0!==(b.effectTag&64))||(k=0!==(f&Gg)&&(null===a||null!==a.memoizedState));k?(h=Oh,g=!0,b.effectTag&=-65):null!==a&&null===a.memoizedState||void 0===e.fallback||!0===e.unstable_avoidThisFallback||(f|=Fg);f&=Eg;J(P,f,b);if(null===a)if(g){e=e.fallback;a=sg(null,d,0,null);a.return=b;if(0===(b.mode&2))for(g=null!==b.memoizedState?b.child.child:b.child,a.child=g;null!==g;)g.return=a,g=g.sibling;c=sg(e,d,c,null);c.return=b;a.sibling=
c;d=a}else d=c=ug(b,null,e.children,c);else{if(null!==a.memoizedState)if(f=a.child,d=f.sibling,g){e=e.fallback;c=og(f,f.pendingProps,0);c.return=b;if(0===(b.mode&2)&&(g=null!==b.memoizedState?b.child.child:b.child,g!==f.child))for(c.child=g;null!==g;)g.return=c,g=g.sibling;e=og(d,e,d.expirationTime);e.return=b;c.sibling=e;d=c;c.childExpirationTime=0;c=e}else d=c=tg(b,f.child,e.children,c);else if(f=a.child,g){g=e.fallback;e=sg(null,d,0,null);e.return=b;e.child=f;null!==f&&(f.return=e);if(0===(b.mode&
2))for(f=null!==b.memoizedState?b.child.child:b.child,e.child=f;null!==f;)f.return=e,f=f.sibling;c=sg(g,d,c,null);c.return=b;e.sibling=c;c.effectTag|=2;d=e;e.childExpirationTime=0}else c=d=tg(b,f,e.children,c);b.stateNode=a.stateNode}b.memoizedState=h;b.child=d;return c}function Qh(a,b,c,d,e){var f=a.memoizedState;null===f?a.memoizedState={isBackwards:b,rendering:null,last:d,tail:c,tailExpiration:0,tailMode:e}:(f.isBackwards=b,f.rendering=null,f.last=d,f.tail=c,f.tailExpiration=0,f.tailMode=e)}
function Rh(a,b,c){var d=b.pendingProps,e=d.revealOrder,f=d.tail;S(a,b,d.children,c);d=P.current;if(0!==(d&Gg))d=d&Eg|Gg,b.effectTag|=64;else{if(null!==a&&0!==(a.effectTag&64))a:for(a=b.child;null!==a;){if(13===a.tag){if(null!==a.memoizedState){a.expirationTime<c&&(a.expirationTime=c);var h=a.alternate;null!==h&&h.expirationTime<c&&(h.expirationTime=c);Jf(a.return,c)}}else if(null!==a.child){a.child.return=a;a=a.child;continue}if(a===b)break a;for(;null===a.sibling;){if(null===a.return||a.return===
b)break a;a=a.return}a.sibling.return=a.return;a=a.sibling}d&=Eg}J(P,d,b);if(0===(b.mode&2))b.memoizedState=null;else switch(e){case "forwards":c=b.child;for(e=null;null!==c;)d=c.alternate,null!==d&&null===Hg(d)&&(e=c),c=c.sibling;c=e;null===c?(e=b.child,b.child=null):(e=c.sibling,c.sibling=null);Qh(b,!1,e,c,f);break;case "backwards":c=null;e=b.child;for(b.child=null;null!==e;){d=e.alternate;if(null!==d&&null===Hg(d)){b.child=e;break}d=e.sibling;e.sibling=c;c=e;e=d}Qh(b,!0,c,null,f);break;case "together":Qh(b,
!1,null,null,void 0);break;default:b.memoizedState=null}return b.child}function Fh(a,b,c){null!==a&&(b.dependencies=a.dependencies);if(b.childExpirationTime<c)return null;if(null!==a&&b.child!==a.child)throw t(Error(153));if(null!==b.child){a=b.child;c=og(a,a.pendingProps,a.expirationTime);b.child=c;for(c.return=b;null!==a.sibling;)a=a.sibling,c=c.sibling=og(a,a.pendingProps,a.expirationTime),c.return=b;c.sibling=null}return b.child}function Sh(a){a.effectTag|=4}
var Th=void 0,Uh=void 0,Vh=void 0,Wh=void 0;Th=function(a,b){for(var c=b.child;null!==c;){if(5===c.tag||6===c.tag)a.appendChild(c.stateNode);else if(20===c.tag)a.appendChild(c.stateNode.instance);else if(4!==c.tag&&null!==c.child){c.child.return=c;c=c.child;continue}if(c===b)break;for(;null===c.sibling;){if(null===c.return||c.return===b)return;c=c.return}c.sibling.return=c.return;c=c.sibling}};Uh=function(){};
Vh=function(a,b,c,d,e){var f=a.memoizedProps;if(f!==d){var h=b.stateNode;zg(wg.current);a=null;switch(c){case "input":f=Bc(h,f);d=Bc(h,d);a=[];break;case "option":f=le(h,f);d=le(h,d);a=[];break;case "select":f=m({},f,{value:void 0});d=m({},d,{value:void 0});a=[];break;case "textarea":f=ne(h,f);d=ne(h,d);a=[];break;default:"function"!==typeof f.onClick&&"function"===typeof d.onClick&&(h.onclick=Ge)}De(c,d);h=c=void 0;var g=null;for(c in f)if(!d.hasOwnProperty(c)&&f.hasOwnProperty(c)&&null!=f[c])if("style"===
c){var k=f[c];for(h in k)k.hasOwnProperty(h)&&(g||(g={}),g[h]="")}else"dangerouslySetInnerHTML"!==c&&"children"!==c&&"suppressContentEditableWarning"!==c&&"suppressHydrationWarning"!==c&&"autoFocus"!==c&&(ia.hasOwnProperty(c)?a||(a=[]):(a=a||[]).push(c,null));for(c in d){var l=d[c];k=null!=f?f[c]:void 0;if(d.hasOwnProperty(c)&&l!==k&&(null!=l||null!=k))if("style"===c)if(k){for(h in k)!k.hasOwnProperty(h)||l&&l.hasOwnProperty(h)||(g||(g={}),g[h]="");for(h in l)l.hasOwnProperty(h)&&k[h]!==l[h]&&(g||
(g={}),g[h]=l[h])}else g||(a||(a=[]),a.push(c,g)),g=l;else"dangerouslySetInnerHTML"===c?(l=l?l.__html:void 0,k=k?k.__html:void 0,null!=l&&k!==l&&(a=a||[]).push(c,""+l)):"children"===c?k===l||"string"!==typeof l&&"number"!==typeof l||(a=a||[]).push(c,""+l):"suppressContentEditableWarning"!==c&&"suppressHydrationWarning"!==c&&(ia.hasOwnProperty(c)?(null!=l&&Fe(e,c),a||k===l||(a=[])):(a=a||[]).push(c,l))}g&&(a=a||[]).push("style",g);e=a;(b.updateQueue=e)&&Sh(b)}};Wh=function(a,b,c,d){c!==d&&Sh(b)};
function $h(a,b){switch(a.tailMode){case "hidden":b=a.tail;for(var c=null;null!==b;)null!==b.alternate&&(c=b),b=b.sibling;null===c?a.tail=null:c.sibling=null;break;case "collapsed":c=a.tail;for(var d=null;null!==c;)null!==c.alternate&&(d=c),c=c.sibling;null===d?b||null===a.tail?a.tail=null:a.tail.sibling=null:d.sibling=null}}
function ai(a){switch(a.tag){case 1:N(a.type)&&Te(a);var b=a.effectTag;return b&2048?(a.effectTag=b&-2049|64,a):null;case 3:Bg(a);Ue(a);b=a.effectTag;if(0!==(b&64))throw t(Error(285));a.effectTag=b&-2049|64;return a;case 5:return Dg(a),null;case 13:return H(P,a),b=a.effectTag,b&2048?(a.effectTag=b&-2049|64,a):null;case 18:return null;case 19:return H(P,a),null;case 4:return Bg(a),null;case 10:return If(a),null;default:return null}}function bi(a,b){return{value:a,source:b,stack:pc(b)}}
var ci="function"===typeof WeakSet?WeakSet:Set;function di(a,b){var c=b.source,d=b.stack;null===d&&null!==c&&(d=pc(c));null!==c&&oc(c.type);b=b.value;null!==a&&1===a.tag&&oc(a.type);try{console.error(b)}catch(e){setTimeout(function(){throw e;})}}function ei(a,b){try{b.props=a.memoizedProps,b.state=a.memoizedState,b.componentWillUnmount()}catch(c){fi(a,c)}}function gi(a){var b=a.ref;if(null!==b)if("function"===typeof b)try{b(null)}catch(c){fi(a,c)}else b.current=null}
function hi(a,b,c){c=c.updateQueue;c=null!==c?c.lastEffect:null;if(null!==c){var d=c=c.next;do{if((d.tag&a)!==Ig){var e=d.destroy;d.destroy=void 0;void 0!==e&&e()}(d.tag&b)!==Ig&&(e=d.create,d.destroy=e());d=d.next}while(d!==c)}}
function ii(a,b){"function"===typeof ji&&ji(a);switch(a.tag){case 0:case 11:case 14:case 15:var c=a.updateQueue;if(null!==c&&(c=c.lastEffect,null!==c)){var d=c.next;vf(97<b?97:b,function(){var b=d;do{var c=b.destroy;if(void 0!==c){var h=a;try{c()}catch(g){fi(h,g)}}b=b.next}while(b!==d)})}break;case 1:gi(a);b=a.stateNode;"function"===typeof b.componentWillUnmount&&ei(a,b);break;case 5:gi(a);break;case 4:ki(a,b)}}
function li(a,b){for(var c=a;;)if(ii(c,b),null!==c.child&&4!==c.tag)c.child.return=c,c=c.child;else{if(c===a)break;for(;null===c.sibling;){if(null===c.return||c.return===a)return;c=c.return}c.sibling.return=c.return;c=c.sibling}}function mi(a){return 5===a.tag||3===a.tag||4===a.tag}
function ni(a){a:{for(var b=a.return;null!==b;){if(mi(b)){var c=b;break a}b=b.return}throw t(Error(160));}b=c.stateNode;switch(c.tag){case 5:var d=!1;break;case 3:b=b.containerInfo;d=!0;break;case 4:b=b.containerInfo;d=!0;break;default:throw t(Error(161));}c.effectTag&16&&(we(b,""),c.effectTag&=-17);a:b:for(c=a;;){for(;null===c.sibling;){if(null===c.return||mi(c.return)){c=null;break a}c=c.return}c.sibling.return=c.return;for(c=c.sibling;5!==c.tag&&6!==c.tag&&18!==c.tag;){if(c.effectTag&2)continue b;
if(null===c.child||4===c.tag)continue b;else c.child.return=c,c=c.child}if(!(c.effectTag&2)){c=c.stateNode;break a}}for(var e=a;;){var f=5===e.tag||6===e.tag;if(f||20===e.tag){var h=f?e.stateNode:e.stateNode.instance;if(c)if(d){f=b;var g=h;h=c;8===f.nodeType?f.parentNode.insertBefore(g,h):f.insertBefore(g,h)}else b.insertBefore(h,c);else d?(g=b,8===g.nodeType?(f=g.parentNode,f.insertBefore(h,g)):(f=g,f.appendChild(h)),g=g._reactRootContainer,null!==g&&void 0!==g||null!==f.onclick||(f.onclick=Ge)):
b.appendChild(h)}else if(4!==e.tag&&null!==e.child){e.child.return=e;e=e.child;continue}if(e===a)break;for(;null===e.sibling;){if(null===e.return||e.return===a)return;e=e.return}e.sibling.return=e.return;e=e.sibling}}
function ki(a,b){for(var c=a,d=!1,e=void 0,f=void 0;;){if(!d){d=c.return;a:for(;;){if(null===d)throw t(Error(160));e=d.stateNode;switch(d.tag){case 5:f=!1;break a;case 3:e=e.containerInfo;f=!0;break a;case 4:e=e.containerInfo;f=!0;break a}d=d.return}d=!0}if(5===c.tag||6===c.tag)if(li(c,b),f){var h=e,g=c.stateNode;8===h.nodeType?h.parentNode.removeChild(g):h.removeChild(g)}else e.removeChild(c.stateNode);else if(20===c.tag)g=c.stateNode.instance,li(c,b),f?(h=e,8===h.nodeType?h.parentNode.removeChild(g):
h.removeChild(g)):e.removeChild(g);else if(4===c.tag){if(null!==c.child){e=c.stateNode.containerInfo;f=!0;c.child.return=c;c=c.child;continue}}else if(ii(c,b),null!==c.child){c.child.return=c;c=c.child;continue}if(c===a)break;for(;null===c.sibling;){if(null===c.return||c.return===a)return;c=c.return;4===c.tag&&(d=!1)}c.sibling.return=c.return;c=c.sibling}}
function oi(a,b){switch(b.tag){case 0:case 11:case 14:case 15:hi(Kg,Lg,b);break;case 1:break;case 5:var c=b.stateNode;if(null!=c){var d=b.memoizedProps,e=null!==a?a.memoizedProps:d;a=b.type;var f=b.updateQueue;b.updateQueue=null;if(null!==f){c[Ga]=d;"input"===a&&"radio"===d.type&&null!=d.name&&Dc(c,d);Ee(a,e);b=Ee(a,d);for(e=0;e<f.length;e+=2){var h=f[e],g=f[e+1];"style"===h?Ae(c,g):"dangerouslySetInnerHTML"===h?ve(c,g):"children"===h?we(c,g):zc(c,h,g,b)}switch(a){case "input":Ec(c,d);break;case "textarea":pe(c,
d);break;case "select":b=c._wrapperState.wasMultiple,c._wrapperState.wasMultiple=!!d.multiple,a=d.value,null!=a?me(c,!!d.multiple,a,!1):b!==!!d.multiple&&(null!=d.defaultValue?me(c,!!d.multiple,d.defaultValue,!0):me(c,!!d.multiple,d.multiple?[]:"",!1))}}}break;case 6:if(null===b.stateNode)throw t(Error(162));b.stateNode.nodeValue=b.memoizedProps;break;case 3:break;case 12:break;case 13:c=b;null===b.memoizedState?d=!1:(d=!0,c=b.child,pi=sf());if(null!==c)a:for(a=c;;){if(5===a.tag)f=a.stateNode,d?(f=
f.style,"function"===typeof f.setProperty?f.setProperty("display","none","important"):f.display="none"):(f=a.stateNode,e=a.memoizedProps.style,e=void 0!==e&&null!==e&&e.hasOwnProperty("display")?e.display:null,f.style.display=ze("display",e));else if(6===a.tag)a.stateNode.nodeValue=d?"":a.memoizedProps;else if(13===a.tag&&null!==a.memoizedState){f=a.child.sibling;f.return=a;a=f;continue}else if(null!==a.child){a.child.return=a;a=a.child;continue}if(a===c)break a;for(;null===a.sibling;){if(null===
a.return||a.return===c)break a;a=a.return}a.sibling.return=a.return;a=a.sibling}qi(b);break;case 19:qi(b);break;case 17:break;case 20:break;default:throw t(Error(163));}}function qi(a){var b=a.updateQueue;if(null!==b){a.updateQueue=null;var c=a.stateNode;null===c&&(c=a.stateNode=new ci);b.forEach(function(b){var d=ri.bind(null,a,b);c.has(b)||(c.add(b),b.then(d,d))})}}var si="function"===typeof WeakMap?WeakMap:Map;
function ti(a,b,c){c=Qf(c,null);c.tag=3;c.payload={element:null};var d=b.value;c.callback=function(){ui||(ui=!0,vi=d);di(a,b)};return c}
function wi(a,b,c){c=Qf(c,null);c.tag=3;var d=a.type.getDerivedStateFromError;if("function"===typeof d){var e=b.value;c.payload=function(){di(a,b);return d(e)}}var f=a.stateNode;null!==f&&"function"===typeof f.componentDidCatch&&(c.callback=function(){"function"!==typeof d&&(null===xi?xi=new Set([this]):xi.add(this),di(a,b));var c=b.stack;this.componentDidCatch(b.value,{componentStack:null!==c?c:""})});return c}
var yi=Math.ceil,zi=Xb.ReactCurrentDispatcher,Ai=Xb.ReactCurrentOwner,T=0,Bi=8,Ci=16,Di=32,Ei=0,Fi=1,Gi=2,Hi=3,Ii=4,U=T,Ji=null,V=null,W=0,X=Ei,Ki=1073741823,Li=1073741823,Mi=null,Ni=!1,pi=0,Oi=500,Y=null,ui=!1,vi=null,xi=null,Pi=!1,Qi=null,Ri=90,Si=0,Ti=null,Ui=0,Vi=null,Wi=0;function cg(){return(U&(Ci|Di))!==T?1073741821-(sf()/10|0):0!==Wi?Wi:Wi=1073741821-(sf()/10|0)}
function dg(a,b,c){b=b.mode;if(0===(b&2))return 1073741823;var d=tf();if(0===(b&4))return 99===d?1073741823:1073741822;if((U&Ci)!==T)return W;if(null!==c)a=1073741821-25*(((1073741821-a+(c.timeoutMs|0||5E3)/10)/25|0)+1);else switch(d){case 99:a=1073741823;break;case 98:a=1073741821-10*(((1073741821-a+15)/10|0)+1);break;case 97:case 96:a=1073741821-25*(((1073741821-a+500)/25|0)+1);break;case 95:a=1;break;default:throw t(Error(326));}null!==Ji&&a===W&&--a;return a}var Xi=0;
function eg(a,b){if(50<Ui)throw Ui=0,Vi=null,t(Error(185));a=Yi(a,b);if(null!==a){a.pingTime=0;var c=tf();if(1073741823===b)if((U&Bi)!==T&&(U&(Ci|Di))===T)for(var d=Z(a,1073741823,!0);null!==d;)d=d(!0);else Zi(a,99,1073741823),U===T&&O();else Zi(a,c,b);(U&4)===T||98!==c&&99!==c||(null===Ti?Ti=new Map([[a,b]]):(c=Ti.get(a),(void 0===c||c>b)&&Ti.set(a,b)))}}
function Yi(a,b){a.expirationTime<b&&(a.expirationTime=b);var c=a.alternate;null!==c&&c.expirationTime<b&&(c.expirationTime=b);var d=a.return,e=null;if(null===d&&3===a.tag)e=a.stateNode;else for(;null!==d;){c=d.alternate;d.childExpirationTime<b&&(d.childExpirationTime=b);null!==c&&c.childExpirationTime<b&&(c.childExpirationTime=b);if(null===d.return&&3===d.tag){e=d.stateNode;break}d=d.return}null!==e&&(b>e.firstPendingTime&&(e.firstPendingTime=b),a=e.lastPendingTime,0===a||b<a)&&(e.lastPendingTime=
b);return e}function Zi(a,b,c){if(a.callbackExpirationTime<c){var d=a.callbackNode;null!==d&&d!==mf&&af(d);a.callbackExpirationTime=c;1073741823===c?a.callbackNode=xf($i.bind(null,a,Z.bind(null,a,c))):(d=null,1!==c&&(d={timeout:10*(1073741821-c)-sf()}),a.callbackNode=wf(b,$i.bind(null,a,Z.bind(null,a,c)),d))}}function $i(a,b,c){var d=a.callbackNode,e=null;try{return e=b(c),null!==e?$i.bind(null,a,e):null}finally{null===e&&d===a.callbackNode&&(a.callbackNode=null,a.callbackExpirationTime=0)}}
function aj(){(U&(1|Ci|Di))===T&&(bj(),cj())}function dj(a,b){var c=a.firstBatch;return null!==c&&c._defer&&c._expirationTime>=b?(wf(97,function(){c._onComplete();return null}),!0):!1}function bj(){if(null!==Ti){var a=Ti;Ti=null;a.forEach(function(a,c){xf(Z.bind(null,c,a))});O()}}function ej(a,b){var c=U;U|=1;try{return a(b)}finally{U=c,U===T&&O()}}function fj(a,b,c,d){var e=U;U|=4;try{return vf(98,a.bind(null,b,c,d))}finally{U=e,U===T&&O()}}
function gj(a,b){var c=U;U&=-2;U|=Bi;try{return a(b)}finally{U=c,U===T&&O()}}
function hj(a,b){a.finishedWork=null;a.finishedExpirationTime=0;var c=a.timeoutHandle;-1!==c&&(a.timeoutHandle=-1,Me(c));if(null!==V)for(c=V.return;null!==c;){var d=c;switch(d.tag){case 1:var e=d.type.childContextTypes;null!==e&&void 0!==e&&Te(d);break;case 3:Bg(d);Ue(d);break;case 5:Dg(d);break;case 4:Bg(d);break;case 13:H(P,d);break;case 19:H(P,d);break;case 10:If(d)}c=c.return}Ji=a;V=og(a.current,null,b);W=b;X=Ei;Li=Ki=1073741823;Mi=null;Ni=!1}
function Z(a,b,c){if((U&(Ci|Di))!==T)throw t(Error(327));if(a.firstPendingTime<b)return null;if(c&&a.finishedExpirationTime===b)return ij.bind(null,a);cj();if(a!==Ji||b!==W)hj(a,b);else if(X===Hi)if(Ni)hj(a,b);else{var d=a.lastPendingTime;if(d<b)return Z.bind(null,a,d)}if(null!==V){d=U;U|=Ci;var e=zi.current;null===e&&(e=hh);zi.current=hh;if(c){if(1073741823!==b){var f=cg();if(f<b)return U=d,Gf(),zi.current=e,Z.bind(null,a,f)}}else Wi=0;do try{if(c)for(;null!==V;)V=jj(V);else for(;null!==V&&!bf();)V=
jj(V);break}catch(rb){Gf();ih();f=V;if(null===f||null===f.return)throw hj(a,b),U=d,rb;a:{var h=a,g=f.return,k=f,l=rb,n=W;k.effectTag|=1024;k.firstEffect=k.lastEffect=null;if(null!==l&&"object"===typeof l&&"function"===typeof l.then){var z=l,x=0!==(P.current&Fg);l=g;do{var v;if(v=13===l.tag)null!==l.memoizedState?v=!1:(v=l.memoizedProps,v=void 0===v.fallback?!1:!0!==v.unstable_avoidThisFallback?!0:x?!1:!0);if(v){g=l.updateQueue;null===g?(g=new Set,g.add(z),l.updateQueue=g):g.add(z);if(0===(l.mode&
2)){l.effectTag|=64;k.effectTag&=-1957;1===k.tag&&(null===k.alternate?k.tag=17:(n=Qf(1073741823,null),n.tag=2,Sf(k,n)));k.expirationTime=1073741823;break a}k=h;h=n;x=k.pingCache;null===x?(x=k.pingCache=new si,g=new Set,x.set(z,g)):(g=x.get(z),void 0===g&&(g=new Set,x.set(z,g)));g.has(h)||(g.add(h),k=kj.bind(null,k,z,h),z.then(k,k));l.effectTag|=2048;l.expirationTime=n;break a}l=l.return}while(null!==l);l=Error((oc(k.type)||"A React component")+" suspended while rendering, but no fallback UI was specified.\n\nAdd a <Suspense fallback=...> component higher in the tree to provide a loading indicator or placeholder to display."+
pc(k))}X!==Ii&&(X=Fi);l=bi(l,k);k=g;do{switch(k.tag){case 3:k.effectTag|=2048;k.expirationTime=n;n=ti(k,l,n);Tf(k,n);break a;case 1:if(z=l,h=k.type,g=k.stateNode,0===(k.effectTag&64)&&("function"===typeof h.getDerivedStateFromError||null!==g&&"function"===typeof g.componentDidCatch&&(null===xi||!xi.has(g)))){k.effectTag|=2048;k.expirationTime=n;n=wi(k,z,n);Tf(k,n);break a}}k=k.return}while(null!==k)}V=lj(f)}while(1);U=d;Gf();zi.current=e;if(null!==V)return Z.bind(null,a,b)}a.finishedWork=a.current.alternate;
a.finishedExpirationTime=b;if(dj(a,b))return null;Ji=null;switch(X){case Ei:throw t(Error(328));case Fi:return d=a.lastPendingTime,d<b?Z.bind(null,a,d):c?ij.bind(null,a):(hj(a,b),xf(Z.bind(null,a,b)),null);case Gi:if(1073741823===Ki&&!c&&(c=pi+Oi-sf(),10<c)){if(Ni)return hj(a,b),Z.bind(null,a,b);d=a.lastPendingTime;if(d<b)return Z.bind(null,a,d);a.timeoutHandle=Le(ij.bind(null,a),c);return null}return ij.bind(null,a);case Hi:if(!c){if(Ni)return hj(a,b),Z.bind(null,a,b);c=a.lastPendingTime;if(c<b)return Z.bind(null,
a,c);1073741823!==Li?c=10*(1073741821-Li)-sf():1073741823===Ki?c=0:(c=10*(1073741821-Ki)-5E3,d=sf(),b=10*(1073741821-b)-d,c=d-c,0>c&&(c=0),c=(120>c?120:480>c?480:1080>c?1080:1920>c?1920:3E3>c?3E3:4320>c?4320:1960*yi(c/1960))-c,b<c&&(c=b));if(10<c)return a.timeoutHandle=Le(ij.bind(null,a),c),null}return ij.bind(null,a);case Ii:return!c&&1073741823!==Ki&&null!==Mi&&(d=Ki,e=Mi,b=e.busyMinDurationMs|0,0>=b?b=0:(c=e.busyDelayMs|0,d=sf()-(10*(1073741821-d)-(e.timeoutMs|0||5E3)),b=d<=c?0:c+b-d),10<b)?(a.timeoutHandle=
Le(ij.bind(null,a),b),null):ij.bind(null,a);default:throw t(Error(329));}}function Xf(a,b){a<Ki&&1<a&&(Ki=a);null!==b&&a<Li&&1<a&&(Li=a,Mi=b)}function jj(a){var b=mj(a.alternate,a,W);a.memoizedProps=a.pendingProps;null===b&&(b=lj(a));Ai.current=null;return b}
function lj(a){V=a;do{var b=V.alternate;a=V.return;if(0===(V.effectTag&1024)){a:{var c=b;b=V;var d=W,e=b.pendingProps;switch(b.tag){case 2:break;case 16:break;case 15:case 0:break;case 1:N(b.type)&&Te(b);break;case 3:Bg(b);Ue(b);d=b.stateNode;d.pendingContext&&(d.context=d.pendingContext,d.pendingContext=null);if(null===c||null===c.child)Bh(b),b.effectTag&=-3;Uh(b);break;case 5:Dg(b);d=zg(yg.current);var f=b.type;if(null!==c&&null!=b.stateNode)Vh(c,b,f,e,d),c.ref!==b.ref&&(b.effectTag|=128);else if(e){var h=
zg(wg.current);if(Bh(b)){c=b;e=void 0;f=c.stateNode;var g=c.type,k=c.memoizedProps;f[Fa]=c;f[Ga]=k;switch(g){case "iframe":case "object":case "embed":G("load",f);break;case "video":case "audio":for(var l=0;l<bb.length;l++)G(bb[l],f);break;case "source":G("error",f);break;case "img":case "image":case "link":G("error",f);G("load",f);break;case "form":G("reset",f);G("submit",f);break;case "details":G("toggle",f);break;case "input":Cc(f,k);G("invalid",f);Fe(d,"onChange");break;case "select":f._wrapperState=
{wasMultiple:!!k.multiple};G("invalid",f);Fe(d,"onChange");break;case "textarea":oe(f,k),G("invalid",f),Fe(d,"onChange")}De(g,k);l=null;for(e in k)k.hasOwnProperty(e)&&(h=k[e],"children"===e?"string"===typeof h?f.textContent!==h&&(l=["children",h]):"number"===typeof h&&f.textContent!==""+h&&(l=["children",""+h]):ia.hasOwnProperty(e)&&null!=h&&Fe(d,e));switch(g){case "input":Vb(f);Gc(f,k,!0);break;case "textarea":Vb(f);qe(f,k);break;case "select":case "option":break;default:"function"===typeof k.onClick&&
(f.onclick=Ge)}d=l;c.updateQueue=d;null!==d&&Sh(b)}else{k=f;c=e;g=b;l=9===d.nodeType?d:d.ownerDocument;h===re.html&&(h=se(k));h===re.html?"script"===k?(k=l.createElement("div"),k.innerHTML="<script>\x3c/script>",l=k.removeChild(k.firstChild)):"string"===typeof c.is?l=l.createElement(k,{is:c.is}):(l=l.createElement(k),"select"===k&&(k=l,c.multiple?k.multiple=!0:c.size&&(k.size=c.size))):l=l.createElementNS(h,k);k=l;k[Fa]=g;k[Ga]=c;c=k;Th(c,b,!1,!1);g=c;var n=d,z=Ee(f,e);switch(f){case "iframe":case "object":case "embed":G("load",
g);d=e;break;case "video":case "audio":for(d=0;d<bb.length;d++)G(bb[d],g);d=e;break;case "source":G("error",g);d=e;break;case "img":case "image":case "link":G("error",g);G("load",g);d=e;break;case "form":G("reset",g);G("submit",g);d=e;break;case "details":G("toggle",g);d=e;break;case "input":Cc(g,e);d=Bc(g,e);G("invalid",g);Fe(n,"onChange");break;case "option":d=le(g,e);break;case "select":g._wrapperState={wasMultiple:!!e.multiple};d=m({},e,{value:void 0});G("invalid",g);Fe(n,"onChange");break;case "textarea":oe(g,
e);d=ne(g,e);G("invalid",g);Fe(n,"onChange");break;default:d=e}De(f,d);k=void 0;l=f;h=g;var x=d;for(k in x)if(x.hasOwnProperty(k)){var v=x[k];"style"===k?Ae(h,v):"dangerouslySetInnerHTML"===k?(v=v?v.__html:void 0,null!=v&&ve(h,v)):"children"===k?"string"===typeof v?("textarea"!==l||""!==v)&&we(h,v):"number"===typeof v&&we(h,""+v):"suppressContentEditableWarning"!==k&&"suppressHydrationWarning"!==k&&"autoFocus"!==k&&(ia.hasOwnProperty(k)?null!=v&&Fe(n,k):null!=v&&zc(h,k,v,z))}switch(f){case "input":Vb(g);
Gc(g,e,!1);break;case "textarea":Vb(g);qe(g,e);break;case "option":null!=e.value&&g.setAttribute("value",""+Ac(e.value));break;case "select":d=g;g=e;d.multiple=!!g.multiple;k=g.value;null!=k?me(d,!!g.multiple,k,!1):null!=g.defaultValue&&me(d,!!g.multiple,g.defaultValue,!0);break;default:"function"===typeof d.onClick&&(g.onclick=Ge)}Je(f,e)&&Sh(b);b.stateNode=c}null!==b.ref&&(b.effectTag|=128)}else if(null===b.stateNode)throw t(Error(166));break;case 6:if(c&&null!=b.stateNode)Wh(c,b,c.memoizedProps,
e);else{if("string"!==typeof e&&null===b.stateNode)throw t(Error(166));c=zg(yg.current);zg(wg.current);Bh(b)?(d=b.stateNode,c=b.memoizedProps,d[Fa]=b,d.nodeValue!==c&&Sh(b)):(d=b,c=(9===c.nodeType?c:c.ownerDocument).createTextNode(e),c[Fa]=b,d.stateNode=c)}break;case 11:break;case 13:H(P,b);e=b.memoizedState;if(0!==(b.effectTag&64)){b.expirationTime=d;break a}d=null!==e;e=!1;null===c?Bh(b):(f=c.memoizedState,e=null!==f,d||null===f||(f=c.child.sibling,null!==f&&(g=b.firstEffect,null!==g?(b.firstEffect=
f,f.nextEffect=g):(b.firstEffect=b.lastEffect=f,f.nextEffect=null),f.effectTag=8)));if(d&&!e&&0!==(b.mode&2))if(null===c&&!0!==b.memoizedProps.unstable_avoidThisFallback||0!==(P.current&Fg))X===Ei&&(X=Gi);else if(X===Ei||X===Gi)X=Hi;if(d||e)b.effectTag|=4;break;case 7:break;case 8:break;case 12:break;case 4:Bg(b);Uh(b);break;case 10:If(b);break;case 9:break;case 14:break;case 17:N(b.type)&&Te(b);break;case 18:break;case 19:H(P,b);e=b.memoizedState;if(null===e)break;f=0!==(b.effectTag&64);g=e.rendering;
if(null===g)if(f)$h(e,!1);else{if(X!==Ei||null!==c&&0!==(c.effectTag&64))for(c=b.child;null!==c;){g=Hg(c);if(null!==g){b.effectTag|=64;$h(e,!1);c=g.updateQueue;null!==c&&(b.updateQueue=c,b.effectTag|=4);b.firstEffect=b.lastEffect=null;for(c=b.child;null!==c;)e=c,f=d,e.effectTag&=2,e.nextEffect=null,e.firstEffect=null,e.lastEffect=null,g=e.alternate,null===g?(e.childExpirationTime=0,e.expirationTime=f,e.child=null,e.memoizedProps=null,e.memoizedState=null,e.updateQueue=null,e.dependencies=null):(e.childExpirationTime=
g.childExpirationTime,e.expirationTime=g.expirationTime,e.child=g.child,e.memoizedProps=g.memoizedProps,e.memoizedState=g.memoizedState,e.updateQueue=g.updateQueue,f=g.dependencies,e.dependencies=null===f?null:{expirationTime:f.expirationTime,firstContext:f.firstContext,responders:f.responders}),c=c.sibling;J(P,P.current&Eg|Gg,b);b=b.child;break a}c=c.sibling}}else{if(!f)if(c=Hg(g),null!==c){if(b.effectTag|=64,f=!0,$h(e,!0),null===e.tail&&"hidden"===e.tailMode){d=c.updateQueue;null!==d&&(b.updateQueue=
d,b.effectTag|=4);b=b.lastEffect=e.lastEffect;null!==b&&(b.nextEffect=null);break}}else sf()>e.tailExpiration&&1<d&&(b.effectTag|=64,f=!0,$h(e,!1),b.expirationTime=b.childExpirationTime=d-1);e.isBackwards?(g.sibling=b.child,b.child=g):(d=e.last,null!==d?d.sibling=g:b.child=g,e.last=g)}if(null!==e.tail){0===e.tailExpiration&&(e.tailExpiration=sf()+500);d=e.tail;e.rendering=d;e.tail=d.sibling;e.lastEffect=b.lastEffect;d.sibling=null;c=P.current;c=f?c&Eg|Gg:c&Eg;J(P,c,b);b=d;break a}break;case 20:break;
default:throw t(Error(156));}b=null}d=V;if(1===W||1!==d.childExpirationTime){c=0;for(e=d.child;null!==e;)f=e.expirationTime,g=e.childExpirationTime,f>c&&(c=f),g>c&&(c=g),e=e.sibling;d.childExpirationTime=c}if(null!==b)return b;null!==a&&0===(a.effectTag&1024)&&(null===a.firstEffect&&(a.firstEffect=V.firstEffect),null!==V.lastEffect&&(null!==a.lastEffect&&(a.lastEffect.nextEffect=V.firstEffect),a.lastEffect=V.lastEffect),1<V.effectTag&&(null!==a.lastEffect?a.lastEffect.nextEffect=V:a.firstEffect=V,
a.lastEffect=V))}else{b=ai(V,W);if(null!==b)return b.effectTag&=1023,b;null!==a&&(a.firstEffect=a.lastEffect=null,a.effectTag|=1024)}b=V.sibling;if(null!==b)return b;V=a}while(null!==V);X===Ei&&(X=Ii);return null}function ij(a){var b=tf();vf(99,nj.bind(null,a,b));null!==Qi&&wf(97,function(){cj();return null});return null}
function nj(a,b){cj();if((U&(Ci|Di))!==T)throw t(Error(327));var c=a.finishedWork,d=a.finishedExpirationTime;if(null===c)return null;a.finishedWork=null;a.finishedExpirationTime=0;if(c===a.current)throw t(Error(177));a.callbackNode=null;a.callbackExpirationTime=0;var e=c.expirationTime,f=c.childExpirationTime;e=f>e?f:e;a.firstPendingTime=e;e<a.lastPendingTime&&(a.lastPendingTime=e);a===Ji&&(V=Ji=null,W=0);1<c.effectTag?null!==c.lastEffect?(c.lastEffect.nextEffect=c,e=c.firstEffect):e=c:e=c.firstEffect;
if(null!==e){f=U;U|=Di;Ai.current=null;He=Qd;var h=ae();if(be(h)){if("selectionStart"in h)var g={start:h.selectionStart,end:h.selectionEnd};else a:{g=(g=h.ownerDocument)&&g.defaultView||window;var k=g.getSelection&&g.getSelection();if(k&&0!==k.rangeCount){g=k.anchorNode;var l=k.anchorOffset,n=k.focusNode;k=k.focusOffset;try{g.nodeType,n.nodeType}catch(zb){g=null;break a}var z=0,x=-1,v=-1,rb=0,Be=0,u=h,w=null;b:for(;;){for(var C;;){u!==g||0!==l&&3!==u.nodeType||(x=z+l);u!==n||0!==k&&3!==u.nodeType||
(v=z+k);3===u.nodeType&&(z+=u.nodeValue.length);if(null===(C=u.firstChild))break;w=u;u=C}for(;;){if(u===h)break b;w===g&&++rb===l&&(x=z);w===n&&++Be===k&&(v=z);if(null!==(C=u.nextSibling))break;u=w;w=u.parentNode}u=C}g=-1===x||-1===v?null:{start:x,end:v}}else g=null}g=g||{start:0,end:0}}else g=null;Ie={focusedElem:h,selectionRange:g};Qd=!1;Y=e;do try{for(;null!==Y;){if(0!==(Y.effectTag&256)){var I=Y.alternate;h=Y;switch(h.tag){case 0:case 11:case 15:hi(Jg,Ig,h);break;case 1:if(h.effectTag&256&&null!==
I){var E=I.memoizedProps,ua=I.memoizedState,gh=h.stateNode,oj=gh.getSnapshotBeforeUpdate(h.elementType===h.type?E:Af(h.type,E),ua);gh.__reactInternalSnapshotBeforeUpdate=oj}break;case 3:case 5:case 6:case 4:case 17:break;default:throw t(Error(163));}}Y=Y.nextEffect}}catch(zb){if(null===Y)throw t(Error(330));fi(Y,zb);Y=Y.nextEffect}while(null!==Y);Y=e;do try{for(I=b;null!==Y;){var A=Y.effectTag;A&16&&we(Y.stateNode,"");if(A&128){var p=Y.alternate;if(null!==p){var r=p.ref;null!==r&&("function"===typeof r?
r(null):r.current=null)}}switch(A&14){case 2:ni(Y);Y.effectTag&=-3;break;case 6:ni(Y);Y.effectTag&=-3;oi(Y.alternate,Y);break;case 4:oi(Y.alternate,Y);break;case 8:E=Y;ki(E,I);E.return=null;E.child=null;E.memoizedState=null;E.updateQueue=null;E.dependencies=null;var K=E.alternate;null!==K&&(K.return=null,K.child=null,K.memoizedState=null,K.updateQueue=null,K.dependencies=null)}Y=Y.nextEffect}}catch(zb){if(null===Y)throw t(Error(330));fi(Y,zb);Y=Y.nextEffect}while(null!==Y);r=Ie;p=ae();A=r.focusedElem;
I=r.selectionRange;if(p!==A&&A&&A.ownerDocument&&$d(A.ownerDocument.documentElement,A)){null!==I&&be(A)&&(p=I.start,r=I.end,void 0===r&&(r=p),"selectionStart"in A?(A.selectionStart=p,A.selectionEnd=Math.min(r,A.value.length)):(r=(p=A.ownerDocument||document)&&p.defaultView||window,r.getSelection&&(r=r.getSelection(),E=A.textContent.length,K=Math.min(I.start,E),I=void 0===I.end?K:Math.min(I.end,E),!r.extend&&K>I&&(E=I,I=K,K=E),E=Zd(A,K),ua=Zd(A,I),E&&ua&&(1!==r.rangeCount||r.anchorNode!==E.node||r.anchorOffset!==
E.offset||r.focusNode!==ua.node||r.focusOffset!==ua.offset)&&(p=p.createRange(),p.setStart(E.node,E.offset),r.removeAllRanges(),K>I?(r.addRange(p),r.extend(ua.node,ua.offset)):(p.setEnd(ua.node,ua.offset),r.addRange(p))))));p=[];for(r=A;r=r.parentNode;)1===r.nodeType&&p.push({element:r,left:r.scrollLeft,top:r.scrollTop});"function"===typeof A.focus&&A.focus();for(A=0;A<p.length;A++)r=p[A],r.element.scrollLeft=r.left,r.element.scrollTop=r.top}Ie=null;Qd=!!He;He=null;a.current=c;Y=e;do try{for(A=d;null!==
Y;){var $a=Y.effectTag;if($a&36){var nc=Y.alternate;p=Y;r=A;switch(p.tag){case 0:case 11:case 15:hi(Mg,Ng,p);break;case 1:var md=p.stateNode;if(p.effectTag&4)if(null===nc)md.componentDidMount();else{var Fj=p.elementType===p.type?nc.memoizedProps:Af(p.type,nc.memoizedProps);md.componentDidUpdate(Fj,nc.memoizedState,md.__reactInternalSnapshotBeforeUpdate)}var Xh=p.updateQueue;null!==Xh&&Yf(p,Xh,md,r);break;case 3:var Yh=p.updateQueue;if(null!==Yh){K=null;if(null!==p.child)switch(p.child.tag){case 5:K=
p.child.stateNode;break;case 1:K=p.child.stateNode}Yf(p,Yh,K,r)}break;case 5:var Gj=p.stateNode;null===nc&&p.effectTag&4&&(r=Gj,Je(p.type,p.memoizedProps)&&r.focus());break;case 6:break;case 4:break;case 12:break;case 13:case 19:case 17:case 20:break;default:throw t(Error(163));}}if($a&128){var nd=Y.ref;if(null!==nd){var Zh=Y.stateNode;switch(Y.tag){case 5:var gf=Zh;break;default:gf=Zh}"function"===typeof nd?nd(gf):nd.current=gf}}$a&512&&(Pi=!0);Y=Y.nextEffect}}catch(zb){if(null===Y)throw t(Error(330));
fi(Y,zb);Y=Y.nextEffect}while(null!==Y);Y=null;nf();U=f}else a.current=c;if(Pi)Pi=!1,Qi=a,Si=d,Ri=b;else for(Y=e;null!==Y;)b=Y.nextEffect,Y.nextEffect=null,Y=b;b=a.firstPendingTime;0!==b?($a=cg(),$a=zf($a,b),Zi(a,$a,b)):xi=null;"function"===typeof pj&&pj(c.stateNode,d);1073741823===b?a===Vi?Ui++:(Ui=0,Vi=a):Ui=0;if(ui)throw ui=!1,a=vi,vi=null,a;if((U&Bi)!==T)return null;O();return null}
function cj(){if(null===Qi)return!1;var a=Qi,b=Si,c=Ri;Qi=null;Si=0;Ri=90;return vf(97<c?97:c,qj.bind(null,a,b))}function qj(a){if((U&(Ci|Di))!==T)throw t(Error(331));var b=U;U|=Di;for(a=a.current.firstEffect;null!==a;){try{var c=a;if(0!==(c.effectTag&512))switch(c.tag){case 0:case 11:case 15:hi(Pg,Ig,c),hi(Ig,Og,c)}}catch(d){if(null===a)throw t(Error(330));fi(a,d)}c=a.nextEffect;a.nextEffect=null;a=c}U=b;O();return!0}
function rj(a,b,c){b=bi(c,b);b=ti(a,b,1073741823);Sf(a,b);a=Yi(a,1073741823);null!==a&&Zi(a,99,1073741823)}function fi(a,b){if(3===a.tag)rj(a,a,b);else for(var c=a.return;null!==c;){if(3===c.tag){rj(c,a,b);break}else if(1===c.tag){var d=c.stateNode;if("function"===typeof c.type.getDerivedStateFromError||"function"===typeof d.componentDidCatch&&(null===xi||!xi.has(d))){a=bi(b,a);a=wi(c,a,1073741823);Sf(c,a);c=Yi(c,1073741823);null!==c&&Zi(c,99,1073741823);break}}c=c.return}}
function kj(a,b,c){var d=a.pingCache;null!==d&&d.delete(b);Ji===a&&W===c?X===Hi||X===Gi&&1073741823===Ki&&sf()-pi<Oi?hj(a,W):Ni=!0:a.lastPendingTime<c||(b=a.pingTime,0!==b&&b<c||(a.pingTime=c,a.finishedExpirationTime===c&&(a.finishedExpirationTime=0,a.finishedWork=null),b=cg(),b=zf(b,c),Zi(a,b,c)))}function ri(a,b){var c=a.stateNode;null!==c&&c.delete(b);c=cg();b=dg(c,a,null);c=zf(c,b);a=Yi(a,b);null!==a&&Zi(a,c,b)}var mj=void 0;
mj=function(a,b,c){var d=b.expirationTime;if(null!==a){var e=b.pendingProps;if(a.memoizedProps!==e||M.current)Lf=!0;else if(d<c){Lf=!1;switch(b.tag){case 3:Nh(b);Ch();break;case 5:Cg(b);if(b.mode&4&&1!==c&&e.hidden)return b.expirationTime=b.childExpirationTime=1,null;break;case 1:N(b.type)&&Xe(b);break;case 4:Ag(b,b.stateNode.containerInfo);break;case 10:Hf(b,b.memoizedProps.value);break;case 13:if(null!==b.memoizedState){d=b.child.childExpirationTime;if(0!==d&&d>=c)return Ph(a,b,c);J(P,P.current&
Eg,b);b=Fh(a,b,c);return null!==b?b.sibling:null}J(P,P.current&Eg,b);break;case 19:d=b.childExpirationTime>=c;if(0!==(a.effectTag&64)){if(d)return Rh(a,b,c);b.effectTag|=64}e=b.memoizedState;null!==e&&(e.rendering=null,e.tail=null);J(P,P.current,b);if(!d)return null}return Fh(a,b,c)}}else Lf=!1;b.expirationTime=0;switch(b.tag){case 2:d=b.type;null!==a&&(a.alternate=null,b.alternate=null,b.effectTag|=2);a=b.pendingProps;e=Se(b,L.current);Kf(b,c);e=dh(null,b,d,a,e,c);b.effectTag|=1;if("object"===typeof e&&
null!==e&&"function"===typeof e.render&&void 0===e.$$typeof){b.tag=1;ih();if(N(d)){var f=!0;Xe(b)}else f=!1;b.memoizedState=null!==e.state&&void 0!==e.state?e.state:null;var h=d.getDerivedStateFromProps;"function"===typeof h&&bg(b,d,h,a);e.updater=fg;b.stateNode=e;e._reactInternalFiber=b;jg(b,d,a,c);b=Mh(null,b,d,!0,f,c)}else b.tag=0,S(null,b,e,c),b=b.child;return b;case 16:e=b.elementType;null!==a&&(a.alternate=null,b.alternate=null,b.effectTag|=2);a=b.pendingProps;e=Bf(e);b.type=e;f=b.tag=sj(e);
a=Af(e,a);switch(f){case 0:b=Jh(null,b,e,a,c);break;case 1:b=Lh(null,b,e,a,c);break;case 11:b=Eh(null,b,e,a,c);break;case 14:b=Gh(null,b,e,Af(e.type,a),d,c);break;default:throw t(Error(306),e,"");}return b;case 0:return d=b.type,e=b.pendingProps,e=b.elementType===d?e:Af(d,e),Jh(a,b,d,e,c);case 1:return d=b.type,e=b.pendingProps,e=b.elementType===d?e:Af(d,e),Lh(a,b,d,e,c);case 3:Nh(b);d=b.updateQueue;if(null===d)throw t(Error(282));e=b.memoizedState;e=null!==e?e.element:null;Wf(b,d,b.pendingProps,
null,c);d=b.memoizedState.element;if(d===e)Ch(),b=Fh(a,b,c);else{e=b.stateNode;if(e=(null===a||null===a.child)&&e.hydrate)uh=Ne(b.stateNode.containerInfo.firstChild),th=b,e=vh=!0;e?(b.effectTag|=2,b.child=ug(b,null,d,c)):(S(a,b,d,c),Ch());b=b.child}return b;case 5:return Cg(b),null===a&&zh(b),d=b.type,e=b.pendingProps,f=null!==a?a.memoizedProps:null,h=e.children,Ke(d,e)?h=null:null!==f&&Ke(d,f)&&(b.effectTag|=16),Kh(a,b),b.mode&4&&1!==c&&e.hidden?(b.expirationTime=b.childExpirationTime=1,b=null):
(S(a,b,h,c),b=b.child),b;case 6:return null===a&&zh(b),null;case 13:return Ph(a,b,c);case 4:return Ag(b,b.stateNode.containerInfo),d=b.pendingProps,null===a?b.child=tg(b,null,d,c):S(a,b,d,c),b.child;case 11:return d=b.type,e=b.pendingProps,e=b.elementType===d?e:Af(d,e),Eh(a,b,d,e,c);case 7:return S(a,b,b.pendingProps,c),b.child;case 8:return S(a,b,b.pendingProps.children,c),b.child;case 12:return S(a,b,b.pendingProps.children,c),b.child;case 10:a:{d=b.type._context;e=b.pendingProps;h=b.memoizedProps;
f=e.value;Hf(b,f);if(null!==h){var g=h.value;f=hd(g,f)?0:("function"===typeof d._calculateChangedBits?d._calculateChangedBits(g,f):1073741823)|0;if(0===f){if(h.children===e.children&&!M.current){b=Fh(a,b,c);break a}}else for(g=b.child,null!==g&&(g.return=b);null!==g;){var k=g.dependencies;if(null!==k){h=g.child;for(var l=k.firstContext;null!==l;){if(l.context===d&&0!==(l.observedBits&f)){1===g.tag&&(l=Qf(c,null),l.tag=2,Sf(g,l));g.expirationTime<c&&(g.expirationTime=c);l=g.alternate;null!==l&&l.expirationTime<
c&&(l.expirationTime=c);Jf(g.return,c);k.expirationTime<c&&(k.expirationTime=c);break}l=l.next}}else h=10===g.tag?g.type===b.type?null:g.child:g.child;if(null!==h)h.return=g;else for(h=g;null!==h;){if(h===b){h=null;break}g=h.sibling;if(null!==g){g.return=h.return;h=g;break}h=h.return}g=h}}S(a,b,e.children,c);b=b.child}return b;case 9:return e=b.type,f=b.pendingProps,d=f.children,Kf(b,c),e=Mf(e,f.unstable_observedBits),d=d(e),b.effectTag|=1,S(a,b,d,c),b.child;case 14:return e=b.type,f=Af(e,b.pendingProps),
f=Af(e.type,f),Gh(a,b,e,f,d,c);case 15:return Ih(a,b,b.type,b.pendingProps,d,c);case 17:return d=b.type,e=b.pendingProps,e=b.elementType===d?e:Af(d,e),null!==a&&(a.alternate=null,b.alternate=null,b.effectTag|=2),b.tag=1,N(d)?(a=!0,Xe(b)):a=!1,Kf(b,c),hg(b,d,e,c),jg(b,d,e,c),Mh(null,b,d,!0,a,c);case 19:return Rh(a,b,c)}throw t(Error(156));};var pj=null,ji=null;
function tj(a){if("undefined"===typeof __REACT_DEVTOOLS_GLOBAL_HOOK__)return!1;var b=__REACT_DEVTOOLS_GLOBAL_HOOK__;if(b.isDisabled||!b.supportsFiber)return!0;try{var c=b.inject(a);pj=function(a){try{b.onCommitFiberRoot(c,a,void 0,64===(a.current.effectTag&64))}catch(e){}};ji=function(a){try{b.onCommitFiberUnmount(c,a)}catch(e){}}}catch(d){}return!0}
function uj(a,b,c,d){this.tag=a;this.key=c;this.sibling=this.child=this.return=this.stateNode=this.type=this.elementType=null;this.index=0;this.ref=null;this.pendingProps=b;this.dependencies=this.memoizedState=this.updateQueue=this.memoizedProps=null;this.mode=d;this.effectTag=0;this.lastEffect=this.firstEffect=this.nextEffect=null;this.childExpirationTime=this.expirationTime=0;this.alternate=null}function xh(a,b,c,d){return new uj(a,b,c,d)}
function Hh(a){a=a.prototype;return!(!a||!a.isReactComponent)}function sj(a){if("function"===typeof a)return Hh(a)?1:0;if(void 0!==a&&null!==a){a=a.$$typeof;if(a===gc)return 11;if(a===jc)return 14}return 2}
function og(a,b){var c=a.alternate;null===c?(c=xh(a.tag,b,a.key,a.mode),c.elementType=a.elementType,c.type=a.type,c.stateNode=a.stateNode,c.alternate=a,a.alternate=c):(c.pendingProps=b,c.effectTag=0,c.nextEffect=null,c.firstEffect=null,c.lastEffect=null);c.childExpirationTime=a.childExpirationTime;c.expirationTime=a.expirationTime;c.child=a.child;c.memoizedProps=a.memoizedProps;c.memoizedState=a.memoizedState;c.updateQueue=a.updateQueue;b=a.dependencies;c.dependencies=null===b?null:{expirationTime:b.expirationTime,
firstContext:b.firstContext,responders:b.responders};c.sibling=a.sibling;c.index=a.index;c.ref=a.ref;return c}
function qg(a,b,c,d,e,f){var h=2;d=a;if("function"===typeof a)Hh(a)&&(h=1);else if("string"===typeof a)h=5;else a:switch(a){case ac:return sg(c.children,e,f,b);case fc:h=8;e|=7;break;case bc:h=8;e|=1;break;case cc:return a=xh(12,c,b,e|8),a.elementType=cc,a.type=cc,a.expirationTime=f,a;case hc:return a=xh(13,c,b,e),a.type=hc,a.elementType=hc,a.expirationTime=f,a;case ic:return a=xh(19,c,b,e),a.elementType=ic,a.expirationTime=f,a;default:if("object"===typeof a&&null!==a)switch(a.$$typeof){case dc:h=
10;break a;case ec:h=9;break a;case gc:h=11;break a;case jc:h=14;break a;case kc:h=16;d=null;break a}throw t(Error(130),null==a?a:typeof a,"");}b=xh(h,c,b,e);b.elementType=a;b.type=d;b.expirationTime=f;return b}function sg(a,b,c,d){a=xh(7,a,d,b);a.expirationTime=c;return a}function pg(a,b,c){a=xh(6,a,null,b);a.expirationTime=c;return a}
function rg(a,b,c){b=xh(4,null!==a.children?a.children:[],a.key,b);b.expirationTime=c;b.stateNode={containerInfo:a.containerInfo,pendingChildren:null,implementation:a.implementation};return b}
function vj(a,b,c){this.tag=b;this.current=null;this.containerInfo=a;this.pingCache=this.pendingChildren=null;this.finishedExpirationTime=0;this.finishedWork=null;this.timeoutHandle=-1;this.pendingContext=this.context=null;this.hydrate=c;this.callbackNode=this.firstBatch=null;this.pingTime=this.lastPendingTime=this.firstPendingTime=this.callbackExpirationTime=0}function wj(a,b,c){a=new vj(a,b,c);b=xh(3,null,null,2===b?7:1===b?3:0);a.current=b;return b.stateNode=a}
function xj(a,b,c,d,e,f){var h=b.current;a:if(c){c=c._reactInternalFiber;b:{if(2!==ld(c)||1!==c.tag)throw t(Error(170));var g=c;do{switch(g.tag){case 3:g=g.stateNode.context;break b;case 1:if(N(g.type)){g=g.stateNode.__reactInternalMemoizedMergedChildContext;break b}}g=g.return}while(null!==g);throw t(Error(171));}if(1===c.tag){var k=c.type;if(N(k)){c=We(c,k,g);break a}}c=g}else c=Qe;null===b.context?b.context=c:b.pendingContext=c;b=f;e=Qf(d,e);e.payload={element:a};b=void 0===b?null:b;null!==b&&
(e.callback=b);Sf(h,e);eg(h,d);return d}function yj(a,b,c,d){var e=b.current,f=cg(),h=$f.suspense;e=dg(f,e,h);return xj(a,b,c,e,h,d)}function zj(a){a=a.current;if(!a.child)return null;switch(a.child.tag){case 5:return a.child.stateNode;default:return a.child.stateNode}}function Aj(a,b,c){var d=3<arguments.length&&void 0!==arguments[3]?arguments[3]:null;return{$$typeof:$b,key:null==d?null:""+d,children:a,containerInfo:b,implementation:c}}
Db=function(a,b,c){switch(b){case "input":Ec(a,c);b=c.name;if("radio"===c.type&&null!=b){for(c=a;c.parentNode;)c=c.parentNode;c=c.querySelectorAll("input[name="+JSON.stringify(""+b)+'][type="radio"]');for(b=0;b<c.length;b++){var d=c[b];if(d!==a&&d.form===a.form){var e=Ka(d);if(!e)throw t(Error(90));Wb(d);Ec(d,e)}}}break;case "textarea":pe(a,c);break;case "select":b=c.value,null!=b&&me(a,!!c.multiple,b,!1)}};
function Bj(a){var b=1073741821-25*(((1073741821-cg()+500)/25|0)+1);b<=Xi&&--b;this._expirationTime=Xi=b;this._root=a;this._callbacks=this._next=null;this._hasChildren=this._didComplete=!1;this._children=null;this._defer=!0}Bj.prototype.render=function(a){if(!this._defer)throw t(Error(250));this._hasChildren=!0;this._children=a;var b=this._root._internalRoot,c=this._expirationTime,d=new Cj;xj(a,b,null,c,null,d._onCommit);return d};
Bj.prototype.then=function(a){if(this._didComplete)a();else{var b=this._callbacks;null===b&&(b=this._callbacks=[]);b.push(a)}};
Bj.prototype.commit=function(){var a=this._root._internalRoot,b=a.firstBatch;if(!this._defer||null===b)throw t(Error(251));if(this._hasChildren){var c=this._expirationTime;if(b!==this){this._hasChildren&&(c=this._expirationTime=b._expirationTime,this.render(this._children));for(var d=null,e=b;e!==this;)d=e,e=e._next;if(null===d)throw t(Error(251));d._next=e._next;this._next=b;a.firstBatch=this}this._defer=!1;b=c;if((U&(Ci|Di))!==T)throw t(Error(253));xf(Z.bind(null,a,b));O();b=this._next;this._next=
null;b=a.firstBatch=b;null!==b&&b._hasChildren&&b.render(b._children)}else this._next=null,this._defer=!1};Bj.prototype._onComplete=function(){if(!this._didComplete){this._didComplete=!0;var a=this._callbacks;if(null!==a)for(var b=0;b<a.length;b++)(0,a[b])()}};function Cj(){this._callbacks=null;this._didCommit=!1;this._onCommit=this._onCommit.bind(this)}Cj.prototype.then=function(a){if(this._didCommit)a();else{var b=this._callbacks;null===b&&(b=this._callbacks=[]);b.push(a)}};
Cj.prototype._onCommit=function(){if(!this._didCommit){this._didCommit=!0;var a=this._callbacks;if(null!==a)for(var b=0;b<a.length;b++){var c=a[b];if("function"!==typeof c)throw t(Error(191),c);c()}}};function Dj(a,b,c){this._internalRoot=wj(a,b,c)}function Ej(a,b){this._internalRoot=wj(a,2,b)}Ej.prototype.render=Dj.prototype.render=function(a,b){var c=this._internalRoot,d=new Cj;b=void 0===b?null:b;null!==b&&d.then(b);yj(a,c,null,d._onCommit);return d};
Ej.prototype.unmount=Dj.prototype.unmount=function(a){var b=this._internalRoot,c=new Cj;a=void 0===a?null:a;null!==a&&c.then(a);yj(null,b,null,c._onCommit);return c};Ej.prototype.createBatch=function(){var a=new Bj(this),b=a._expirationTime,c=this._internalRoot,d=c.firstBatch;if(null===d)c.firstBatch=a,a._next=null;else{for(c=null;null!==d&&d._expirationTime>=b;)c=d,d=d._next;a._next=d;null!==c&&(c._next=a)}return a};
function Hj(a){return!(!a||1!==a.nodeType&&9!==a.nodeType&&11!==a.nodeType&&(8!==a.nodeType||" react-mount-point-unstable "!==a.nodeValue))}Jb=ej;Kb=fj;Lb=aj;Mb=function(a,b){var c=U;U|=2;try{return a(b)}finally{U=c,U===T&&O()}};function Ij(a,b){b||(b=a?9===a.nodeType?a.documentElement:a.firstChild:null,b=!(!b||1!==b.nodeType||!b.hasAttribute("data-reactroot")));if(!b)for(var c;c=a.lastChild;)a.removeChild(c);return new Dj(a,0,b)}
function Jj(a,b,c,d,e){var f=c._reactRootContainer,h=void 0;if(f){h=f._internalRoot;if("function"===typeof e){var g=e;e=function(){var a=zj(h);g.call(a)}}yj(b,h,a,e)}else{f=c._reactRootContainer=Ij(c,d);h=f._internalRoot;if("function"===typeof e){var k=e;e=function(){var a=zj(h);k.call(a)}}gj(function(){yj(b,h,a,e)})}return zj(h)}function Kj(a,b){var c=2<arguments.length&&void 0!==arguments[2]?arguments[2]:null;if(!Hj(b))throw t(Error(200));return Aj(a,b,null,c)}
var Nj={createPortal:Kj,findDOMNode:function(a){if(null==a)a=null;else if(1!==a.nodeType){var b=a._reactInternalFiber;if(void 0===b){if("function"===typeof a.render)throw t(Error(188));throw t(Error(268),Object.keys(a));}a=qd(b);a=null===a?null:a.stateNode}return a},hydrate:function(a,b,c){if(!Hj(b))throw t(Error(200));return Jj(null,a,b,!0,c)},render:function(a,b,c){if(!Hj(b))throw t(Error(200));return Jj(null,a,b,!1,c)},unstable_renderSubtreeIntoContainer:function(a,b,c,d){if(!Hj(c))throw t(Error(200));
if(null==a||void 0===a._reactInternalFiber)throw t(Error(38));return Jj(a,b,c,!1,d)},unmountComponentAtNode:function(a){if(!Hj(a))throw t(Error(40));return a._reactRootContainer?(gj(function(){Jj(null,null,a,!1,function(){a._reactRootContainer=null})}),!0):!1},unstable_createPortal:function(){return Kj.apply(void 0,arguments)},unstable_batchedUpdates:ej,unstable_interactiveUpdates:function(a,b,c,d){aj();return fj(a,b,c,d)},unstable_discreteUpdates:fj,unstable_flushDiscreteUpdates:aj,flushSync:function(a,
b){if((U&(Ci|Di))!==T)throw t(Error(187));var c=U;U|=1;try{return vf(99,a.bind(null,b))}finally{U=c,O()}},unstable_createRoot:Lj,unstable_createSyncRoot:Mj,unstable_flushControlled:function(a){var b=U;U|=1;try{vf(99,a)}finally{U=b,U===T&&O()}},__SECRET_INTERNALS_DO_NOT_USE_OR_YOU_WILL_BE_FIRED:{Events:[Ia,Ja,Ka,Ca.injectEventPluginsByName,fa,Qa,function(a){ya(a,Pa)},Hb,Ib,Ud,Ba,cj,{current:!1}]}};
function Lj(a,b){if(!Hj(a))throw t(Error(299),"unstable_createRoot");return new Ej(a,null!=b&&!0===b.hydrate)}function Mj(a,b){if(!Hj(a))throw t(Error(299),"unstable_createRoot");return new Dj(a,1,null!=b&&!0===b.hydrate)}
(function(a){var b=a.findFiberByHostInstance;return tj(m({},a,{overrideHookState:null,overrideProps:null,setSuspenseHandler:null,scheduleUpdate:null,currentDispatcherRef:Xb.ReactCurrentDispatcher,findHostInstanceByFiber:function(a){a=qd(a);return null===a?null:a.stateNode},findFiberByHostInstance:function(a){return b?b(a):null},findHostInstancesForRefresh:null,scheduleRefresh:null,scheduleRoot:null,setRefreshHandler:null,getCurrentFiber:null}))})({findFiberByHostInstance:Ha,bundleType:0,version:"16.9.0",
rendererPackageName:"react-dom"});var Oj={default:Nj},Pj=Oj&&Nj||Oj;module.exports=Pj.default||Pj;


/***/ }),
/* 331 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


if (true) {
  module.exports = __webpack_require__(332);
} else {}


/***/ }),
/* 332 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";
/** @license React v0.15.0
 * scheduler.production.min.js
 *
 * Copyright (c) Facebook, Inc. and its affiliates.
 *
 * This source code is licensed under the MIT license found in the
 * LICENSE file in the root directory of this source tree.
 */

Object.defineProperty(exports,"__esModule",{value:!0});var d=void 0,e=void 0,g=void 0,m=void 0,n=void 0;exports.unstable_now=void 0;exports.unstable_forceFrameRate=void 0;
if("undefined"===typeof window||"function"!==typeof MessageChannel){var p=null,q=null,r=function(){if(null!==p)try{var a=exports.unstable_now();p(!0,a);p=null}catch(b){throw setTimeout(r,0),b;}};exports.unstable_now=function(){return Date.now()};d=function(a){null!==p?setTimeout(d,0,a):(p=a,setTimeout(r,0))};e=function(a,b){q=setTimeout(a,b)};g=function(){clearTimeout(q)};m=function(){return!1};n=exports.unstable_forceFrameRate=function(){}}else{var t=window.performance,u=window.Date,v=window.setTimeout,
w=window.clearTimeout,x=window.requestAnimationFrame,y=window.cancelAnimationFrame;"undefined"!==typeof console&&("function"!==typeof x&&console.error("This browser doesn't support requestAnimationFrame. Make sure that you load a polyfill in older browsers. https://fb.me/react-polyfills"),"function"!==typeof y&&console.error("This browser doesn't support cancelAnimationFrame. Make sure that you load a polyfill in older browsers. https://fb.me/react-polyfills"));exports.unstable_now="object"===typeof t&&
"function"===typeof t.now?function(){return t.now()}:function(){return u.now()};var z=!1,A=null,B=-1,C=-1,D=33.33,E=-1,F=-1,G=0,H=!1;m=function(){return exports.unstable_now()>=G};n=function(){};exports.unstable_forceFrameRate=function(a){0>a||125<a?console.error("forceFrameRate takes a positive int between 0 and 125, forcing framerates higher than 125 fps is not unsupported"):0<a?(D=Math.floor(1E3/a),H=!0):(D=33.33,H=!1)};var J=function(){if(null!==A){var a=exports.unstable_now(),b=0<G-a;try{A(b,
a)||(A=null)}catch(c){throw I.postMessage(null),c;}}},K=new MessageChannel,I=K.port2;K.port1.onmessage=J;var L=function(a){if(null===A)F=E=-1,z=!1;else{z=!0;x(function(a){w(B);L(a)});var b=function(){G=exports.unstable_now()+D/2;J();B=v(b,3*D)};B=v(b,3*D);if(-1!==E&&.1<a-E){var c=a-E;!H&&-1!==F&&c<D&&F<D&&(D=c<F?F:c,8.33>D&&(D=8.33));F=c}E=a;G=a+D;I.postMessage(null)}};d=function(a){A=a;z||(z=!0,x(function(a){L(a)}))};e=function(a,b){C=v(function(){a(exports.unstable_now())},b)};g=function(){w(C);
C=-1}}var M=null,N=null,O=null,P=3,Q=!1,R=!1,S=!1;
function T(a,b){var c=a.next;if(c===a)M=null;else{a===M&&(M=c);var f=a.previous;f.next=c;c.previous=f}a.next=a.previous=null;c=a.callback;f=P;var l=O;P=a.priorityLevel;O=a;try{var h=a.expirationTime<=b;switch(P){case 1:var k=c(h);break;case 2:k=c(h);break;case 3:k=c(h);break;case 4:k=c(h);break;case 5:k=c(h)}}catch(Z){throw Z;}finally{P=f,O=l}if("function"===typeof k)if(b=a.expirationTime,a.callback=k,null===M)M=a.next=a.previous=a;else{k=null;h=M;do{if(b<=h.expirationTime){k=h;break}h=h.next}while(h!==
M);null===k?k=M:k===M&&(M=a);b=k.previous;b.next=k.previous=a;a.next=k;a.previous=b}}function U(a){if(null!==N&&N.startTime<=a){do{var b=N,c=b.next;if(b===c)N=null;else{N=c;var f=b.previous;f.next=c;c.previous=f}b.next=b.previous=null;V(b,b.expirationTime)}while(null!==N&&N.startTime<=a)}}function W(a){S=!1;U(a);R||(null!==M?(R=!0,d(X)):null!==N&&e(W,N.startTime-a))}
function X(a,b){R=!1;S&&(S=!1,g());U(b);Q=!0;try{if(!a)for(;null!==M&&M.expirationTime<=b;)T(M,b),b=exports.unstable_now(),U(b);else if(null!==M){do T(M,b),b=exports.unstable_now(),U(b);while(null!==M&&!m())}if(null!==M)return!0;null!==N&&e(W,N.startTime-b);return!1}finally{Q=!1}}function Y(a){switch(a){case 1:return-1;case 2:return 250;case 5:return 1073741823;case 4:return 1E4;default:return 5E3}}
function V(a,b){if(null===M)M=a.next=a.previous=a;else{var c=null,f=M;do{if(b<f.expirationTime){c=f;break}f=f.next}while(f!==M);null===c?c=M:c===M&&(M=a);b=c.previous;b.next=c.previous=a;a.next=c;a.previous=b}}var aa=n;exports.unstable_ImmediatePriority=1;exports.unstable_UserBlockingPriority=2;exports.unstable_NormalPriority=3;exports.unstable_IdlePriority=5;exports.unstable_LowPriority=4;
exports.unstable_runWithPriority=function(a,b){switch(a){case 1:case 2:case 3:case 4:case 5:break;default:a=3}var c=P;P=a;try{return b()}finally{P=c}};exports.unstable_next=function(a){switch(P){case 1:case 2:case 3:var b=3;break;default:b=P}var c=P;P=b;try{return a()}finally{P=c}};
exports.unstable_scheduleCallback=function(a,b,c){var f=exports.unstable_now();if("object"===typeof c&&null!==c){var l=c.delay;l="number"===typeof l&&0<l?f+l:f;c="number"===typeof c.timeout?c.timeout:Y(a)}else c=Y(a),l=f;c=l+c;a={callback:b,priorityLevel:a,startTime:l,expirationTime:c,next:null,previous:null};if(l>f){c=l;if(null===N)N=a.next=a.previous=a;else{b=null;var h=N;do{if(c<h.startTime){b=h;break}h=h.next}while(h!==N);null===b?b=N:b===N&&(N=a);c=b.previous;c.next=b.previous=a;a.next=b;a.previous=
c}null===M&&N===a&&(S?g():S=!0,e(W,l-f))}else V(a,c),R||Q||(R=!0,d(X));return a};exports.unstable_cancelCallback=function(a){var b=a.next;if(null!==b){if(a===b)a===M?M=null:a===N&&(N=null);else{a===M?M=b:a===N&&(N=b);var c=a.previous;c.next=b;b.previous=c}a.next=a.previous=null}};exports.unstable_wrapCallback=function(a){var b=P;return function(){var c=P;P=b;try{return a.apply(this,arguments)}finally{P=c}}};exports.unstable_getCurrentPriorityLevel=function(){return P};
exports.unstable_shouldYield=function(){var a=exports.unstable_now();U(a);return null!==O&&null!==M&&M.startTime<=a&&M.expirationTime<O.expirationTime||m()};exports.unstable_requestPaint=aa;exports.unstable_continueExecution=function(){R||Q||(R=!0,d(X))};exports.unstable_pauseExecution=function(){};exports.unstable_getFirstCallbackNode=function(){return M};


/***/ }),
/* 333 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var _interopRequireDefault = __webpack_require__(0);

var _interopRequireWildcard = __webpack_require__(103);

var _Object$defineProperty = __webpack_require__(1);

_Object$defineProperty(exports, "__esModule", {
  value: true
});

exports.default = void 0;

var _react = _interopRequireWildcard(__webpack_require__(183));

__webpack_require__(187);

__webpack_require__(188);

var _slicedToArray2 = _interopRequireDefault(__webpack_require__(110));

__webpack_require__(193);

__webpack_require__(160);

__webpack_require__(99);

var _getIterator2 = _interopRequireDefault(__webpack_require__(192));

var _values = _interopRequireDefault(__webpack_require__(111));

__webpack_require__(30);

__webpack_require__(161);

var _toConsumableArray2 = _interopRequireDefault(__webpack_require__(334));

var _entries = _interopRequireDefault(__webpack_require__(98));

var _classCallCheck2 = _interopRequireDefault(__webpack_require__(2));

var _createClass2 = _interopRequireDefault(__webpack_require__(3));

var _possibleConstructorReturn2 = _interopRequireDefault(__webpack_require__(5));

var _getPrototypeOf3 = _interopRequireDefault(__webpack_require__(4));

var _assertThisInitialized2 = _interopRequireDefault(__webpack_require__(56));

var _inherits2 = _interopRequireDefault(__webpack_require__(6));

var _defineProperty2 = _interopRequireDefault(__webpack_require__(69));

var _propTypes = _interopRequireDefault(__webpack_require__(204));

var _iconList = _interopRequireDefault(__webpack_require__(345));

var _icon = _interopRequireDefault(__webpack_require__(346));

var Tab =
/*#__PURE__*/
function (_Component) {
  (0, _inherits2.default)(Tab, _Component);

  function Tab() {
    var _getPrototypeOf2;

    var _this;

    (0, _classCallCheck2.default)(this, Tab);

    for (var _len = arguments.length, args = new Array(_len), _key = 0; _key < _len; _key++) {
      args[_key] = arguments[_key];
    }

    _this = (0, _possibleConstructorReturn2.default)(this, (_getPrototypeOf2 = (0, _getPrototypeOf3.default)(Tab)).call.apply(_getPrototypeOf2, [this].concat(args)));
    (0, _defineProperty2.default)((0, _assertThisInitialized2.default)(_this), "componentDidMount", function () {
      if (_this.props.selected && _this.props.selected.value) {
        setTimeout(function () {
          var element = document.querySelector('.elementor-selected');

          if (element) {
            element.scrollIntoView(false);
          }
        }, 0);
      }
    });
    (0, _defineProperty2.default)((0, _assertThisInitialized2.default)(_this), "handleFullIconList", function () {
      var fullIconList = [];
      (0, _entries.default)(_this.props.icons).forEach(function (library) {
        if ('recommended' !== library[0]) {
          fullIconList = [].concat((0, _toConsumableArray2.default)(fullIconList), (0, _toConsumableArray2.default)(_this.getIconsOfType(library[0], library[1])));
        }
      });
      return fullIconList.sort(function (a, b) {
        return a.filter === b.filter ? 0 : +(a.filter > b.filter) || -1;
      });
    });
    (0, _defineProperty2.default)((0, _assertThisInitialized2.default)(_this), "getLibrary", function (libraryName) {
      var icons = elementor.config.icons.libraries.filter(function (library) {
        return libraryName === library.name;
      });
      return icons;
    });
    (0, _defineProperty2.default)((0, _assertThisInitialized2.default)(_this), "handleRecommendedList", function () {
      var recommendedIconList = [];
      (0, _entries.default)(_this.props.icons).forEach(function (library) {
        var iconLibrary = _this.getLibrary(library[0]),
            iconsOfType = iconLibrary[0].icons,
            recommendedIconsOfType = {};

        library[1].forEach(function (iconName) {
          if (iconsOfType[iconName]) {
            recommendedIconsOfType[iconName] = iconsOfType[iconName];
          }
        });
        recommendedIconList = [].concat((0, _toConsumableArray2.default)(recommendedIconList), (0, _toConsumableArray2.default)(_this.getIconsOfType(library[0], recommendedIconsOfType)));
      });
      return recommendedIconList;
    });
    (0, _defineProperty2.default)((0, _assertThisInitialized2.default)(_this), "getIconsComponentList", function () {
      var iconsToShow = [];
      var _this$props = _this.props,
          name = _this$props.name,
          icons = _this$props.icons,
          filter = _this$props.filter;

      switch (name) {
        case 'all':
          iconsToShow = _this.handleFullIconList();
          break;

        case 'recommended':
          iconsToShow = _this.handleRecommendedList();
          break;

        default:
          iconsToShow = _this.getIconsOfType(name, icons);
          break;
      }

      if (filter) {
        iconsToShow = (0, _values.default)(iconsToShow).filter(function (icon) {
          return icon.props.data.name.toLowerCase().indexOf(filter) > -1;
        });
      }

      return iconsToShow;
    });
    (0, _defineProperty2.default)((0, _assertThisInitialized2.default)(_this), "render", function () {
      var icons = _this.getIconsComponentList();

      var selectedIndex = -1;
      var _iteratorNormalCompletion = true;
      var _didIteratorError = false;
      var _iteratorError = undefined;

      try {
        for (var _iterator = (0, _getIterator2.default)(icons.entries()), _step; !(_iteratorNormalCompletion = (_step = _iterator.next()).done); _iteratorNormalCompletion = true) {
          var _step$value = (0, _slicedToArray2.default)(_step.value, 2),
              index = _step$value[0],
              icon = _step$value[1];

          if (icon.props.containerClass.includes('elementor-selected')) {
            selectedIndex = index;
            break;
          }
        }
      } catch (err) {
        _didIteratorError = true;
        _iteratorError = err;
      } finally {
        try {
          if (!_iteratorNormalCompletion && _iterator.return != null) {
            _iterator.return();
          }
        } finally {
          if (_didIteratorError) {
            throw _iteratorError;
          }
        }
      }

      return _react.default.createElement(_iconList.default, {
        selectedIndex: selectedIndex,
        items: icons,
        parentRef: _this.props.parentRef
      });
    });
    return _this;
  }

  (0, _createClass2.default)(Tab, [{
    key: "getIconsOfType",
    value: function getIconsOfType(type, icons) {
      var _this2 = this;

      var _this$props2 = this.props,
          selected = _this$props2.selected,
          filter = _this$props2.filter;
      return (0, _entries.default)(icons).map(function (icon) {
        var iconData = icon[1],
            iconName = icon[0],
            className = iconData.displayPrefix + ' ' + iconData.selector;
        var containerClass = 'elementor-icons-manager__tab__item';

        if (selected.value === className) {
          containerClass += ' elementor-selected';
        }

        var key = containerClass + type + '-' + iconName + filter;
        return _react.default.createElement(_icon.default, {
          key: key,
          library: type,
          keyID: iconName,
          containerClass: containerClass,
          className: className,
          setSelectedHandler: _this2.props.setSelected,
          data: iconData
        });
      });
    }
  }]);
  return Tab;
}(_react.Component);

Tab.propTypes = {
  data: _propTypes.default.any,
  filter: _propTypes.default.any,
  icons: _propTypes.default.object,
  name: _propTypes.default.string,
  selected: _propTypes.default.object,
  setSelected: _propTypes.default.func,
  parentRef: _propTypes.default.any
};
var _default = Tab;
exports.default = _default;

/***/ }),
/* 334 */
/***/ (function(module, exports, __webpack_require__) {

var arrayWithoutHoles = __webpack_require__(335);

var iterableToArray = __webpack_require__(336);

var nonIterableSpread = __webpack_require__(344);

function _toConsumableArray(arr) {
  return arrayWithoutHoles(arr) || iterableToArray(arr) || nonIterableSpread();
}

module.exports = _toConsumableArray;

/***/ }),
/* 335 */
/***/ (function(module, exports, __webpack_require__) {

var _Array$isArray = __webpack_require__(119);

function _arrayWithoutHoles(arr) {
  if (_Array$isArray(arr)) {
    for (var i = 0, arr2 = new Array(arr.length); i < arr.length; i++) {
      arr2[i] = arr[i];
    }

    return arr2;
  }
}

module.exports = _arrayWithoutHoles;

/***/ }),
/* 336 */
/***/ (function(module, exports, __webpack_require__) {

var _Array$from = __webpack_require__(337);

var _isIterable = __webpack_require__(341);

function _iterableToArray(iter) {
  if (_isIterable(Object(iter)) || Object.prototype.toString.call(iter) === "[object Arguments]") return _Array$from(iter);
}

module.exports = _iterableToArray;

/***/ }),
/* 337 */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(338);

/***/ }),
/* 338 */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(82);
__webpack_require__(339);
module.exports = __webpack_require__(7).Array.from;


/***/ }),
/* 339 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";

var ctx = __webpack_require__(55);
var $export = __webpack_require__(8);
var toObject = __webpack_require__(34);
var call = __webpack_require__(233);
var isArrayIter = __webpack_require__(234);
var toLength = __webpack_require__(107);
var createProperty = __webpack_require__(254);
var getIterFn = __webpack_require__(172);

$export($export.S + $export.F * !__webpack_require__(340)(function (iter) { Array.from(iter); }), 'Array', {
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
/* 340 */
/***/ (function(module, exports, __webpack_require__) {

var ITERATOR = __webpack_require__(12)('iterator');
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
/* 341 */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(342);

/***/ }),
/* 342 */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(96);
__webpack_require__(82);
module.exports = __webpack_require__(343);


/***/ }),
/* 343 */
/***/ (function(module, exports, __webpack_require__) {

var classof = __webpack_require__(155);
var ITERATOR = __webpack_require__(12)('iterator');
var Iterators = __webpack_require__(38);
module.exports = __webpack_require__(7).isIterable = function (it) {
  var O = Object(it);
  return O[ITERATOR] !== undefined
    || '@@iterator' in O
    // eslint-disable-next-line no-prototype-builtins
    || Iterators.hasOwnProperty(classof(O));
};


/***/ }),
/* 344 */
/***/ (function(module, exports) {

function _nonIterableSpread() {
  throw new TypeError("Invalid attempt to spread non-iterable instance");
}

module.exports = _nonIterableSpread;

/***/ }),
/* 345 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var _interopRequireWildcard = __webpack_require__(103);

var _interopRequireDefault = __webpack_require__(0);

var _Object$defineProperty = __webpack_require__(1);

_Object$defineProperty(exports, "__esModule", {
  value: true
});

exports.default = void 0;

var _classCallCheck2 = _interopRequireDefault(__webpack_require__(2));

var _createClass2 = _interopRequireDefault(__webpack_require__(3));

var _possibleConstructorReturn2 = _interopRequireDefault(__webpack_require__(5));

var _getPrototypeOf3 = _interopRequireDefault(__webpack_require__(4));

var _assertThisInitialized2 = _interopRequireDefault(__webpack_require__(56));

var _inherits2 = _interopRequireDefault(__webpack_require__(6));

var _defineProperty2 = _interopRequireDefault(__webpack_require__(69));

var _propTypes = _interopRequireDefault(__webpack_require__(204));

var _react = _interopRequireWildcard(__webpack_require__(183));

var LazyIconList =
/*#__PURE__*/
function (_Component) {
  (0, _inherits2.default)(LazyIconList, _Component);

  function LazyIconList() {
    var _getPrototypeOf2;

    var _this;

    (0, _classCallCheck2.default)(this, LazyIconList);

    for (var _len = arguments.length, args = new Array(_len), _key = 0; _key < _len; _key++) {
      args[_key] = arguments[_key];
    }

    _this = (0, _possibleConstructorReturn2.default)(this, (_getPrototypeOf2 = (0, _getPrototypeOf3.default)(LazyIconList)).call.apply(_getPrototypeOf2, [this].concat(args)));
    (0, _defineProperty2.default)((0, _assertThisInitialized2.default)(_this), "state", {
      itemSize: {
        width: 0,
        height: 0
      },
      wrapperSize: {
        width: 0,
        height: 0
      },
      firstRowInView: 0
    });
    (0, _defineProperty2.default)((0, _assertThisInitialized2.default)(_this), "selectors", {
      item: '.elementor-icons-manager__tab__item',
      wrapper: 'elementor-icons-manager__tab__wrapper'
    });
    (0, _defineProperty2.default)((0, _assertThisInitialized2.default)(_this), "attachScrollListener", function () {
      var element = document.getElementById(_this.selectors.wrapper);

      if (element) {
        element.addEventListener('scroll', _this.handleScroll);
      }
    });
    (0, _defineProperty2.default)((0, _assertThisInitialized2.default)(_this), "maybeMeasureItem", function () {
      if (_this.state.itemSize.width) {
        return;
      } // CSS Item Padding


      var itemPadding = 20,
          wrapper = document.getElementById(_this.selectors.wrapper),
          testElement = document.querySelector(_this.selectors.item);

      if (!testElement) {
        return;
      }

      var newState = {
        itemSize: {
          width: testElement.offsetWidth + itemPadding,
          height: testElement.offsetHeight + itemPadding
        },
        wrapperSize: {
          width: wrapper.offsetWidth,
          height: wrapper.clientHeight
        }
      };
      return _this.setState(newState, function () {
        _this.maybeScrollToSelected();
      });
    });
    (0, _defineProperty2.default)((0, _assertThisInitialized2.default)(_this), "maybeScrollToSelected", function () {
      if (!_this.hasSelected()) {
        return;
      }

      var selectedIndex = _this.props.selectedIndex,
          _this$state = _this.state,
          wrapperSize = _this$state.wrapperSize,
          itemSize = _this$state.itemSize,
          itemsInRow = Math.floor(wrapperSize.width / itemSize.width),
          selectedItemRow = Math.ceil(selectedIndex / itemsInRow) - 1,
          scrollTop = selectedItemRow * itemSize.height;
      setTimeout(function () {
        _this.props.parentRef.current.scrollTo({
          top: scrollTop,
          left: 0,
          behavior: 'auto'
        });
      }, 0);
    });
    (0, _defineProperty2.default)((0, _assertThisInitialized2.default)(_this), "handleScroll", function () {
      _this.clearDebounceScrollCallback();

      _this._debounce = setTimeout(function () {
        var element = document.getElementById(_this.selectors.wrapper);
        var itemSize = _this.state.itemSize;

        _this.setState({
          firstRowInView: Math.floor(element.scrollTop / itemSize.height)
        });
      }, 10);
    });
    (0, _defineProperty2.default)((0, _assertThisInitialized2.default)(_this), "render", function () {
      var _this$state2 = _this.state,
          itemSize = _this$state2.itemSize,
          wrapperSize = _this$state2.wrapperSize;
      var firstRowInView = _this.state.firstRowInView;

      if (!itemSize.width) {
        return _this.renderFirstElementForMeasurement();
      }

      var items = _this.props.items,
          itemsInRow = Math.floor(wrapperSize.width / itemSize.width),
          totalRows = Math.ceil(items.length / itemsInRow),
          spareRows = 4;
      var rowsInView = Math.ceil(wrapperSize.height / itemSize.height) + spareRows;

      if (rowsInView > totalRows) {
        rowsInView = totalRows;
      } // Prevent scroll overflow


      if (firstRowInView > totalRows - rowsInView) {
        firstRowInView = totalRows - rowsInView;
      }

      var tailRows = totalRows - firstRowInView - rowsInView,
          firstItemIndexInWindow = firstRowInView * itemsInRow,
          lastItemIndexInWindow = (firstRowInView + rowsInView) * itemsInRow - 1,
          itemsInView = items.slice(firstItemIndexInWindow, lastItemIndexInWindow + 1),
          offsetStyle = {
        height: "".concat(firstRowInView * itemSize.height, "px")
      },
          tailStyle = {
        height: "".concat(tailRows * itemSize.height, "px")
      };
      return _react.default.createElement(_react.Fragment, null, _react.default.createElement("div", {
        className: 'elementor-icons-manager__tab__content__offset',
        style: offsetStyle
      }), _react.default.createElement("div", {
        id: 'elementor-icons-manager__tab__content'
      }, itemsInView), _react.default.createElement("div", {
        className: 'elementor-icons-manager__tab__content__tail',
        style: tailStyle
      }));
    });
    return _this;
  }

  (0, _createClass2.default)(LazyIconList, [{
    key: "componentDidMount",
    value: function componentDidMount() {
      this.attachScrollListener();
      this.maybeMeasureItem();
    }
  }, {
    key: "componentWillUnmount",
    value: function componentWillUnmount() {
      this.clearDebounceScrollCallback();
      var element = document.getElementById(this.selectors.wrapper);

      if (element) {
        element.removeEventListener('scroll', this.handleScroll);
      }
    }
  }, {
    key: "clearDebounceScrollCallback",
    value: function clearDebounceScrollCallback() {
      clearTimeout(this._debounce);
    }
  }, {
    key: "renderFirstElementForMeasurement",
    value: function renderFirstElementForMeasurement() {
      return _react.default.createElement("div", {
        id: 'elementor-icons-manager__tab__content'
      }, this.props.items[0]);
    }
  }, {
    key: "hasSelected",
    value: function hasSelected() {
      return -1 !== this.props.selectedIndex;
    }
  }]);
  return LazyIconList;
}(_react.Component);

var _default = LazyIconList;
exports.default = _default;
LazyIconList.propTypes = {
  items: _propTypes.default.array,
  selectedIndex: _propTypes.default.number,
  parentRef: _propTypes.default.any
};

/***/ }),
/* 346 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var _interopRequireDefault = __webpack_require__(0);

var _interopRequireWildcard = __webpack_require__(103);

var _Object$defineProperty = __webpack_require__(1);

_Object$defineProperty(exports, "__esModule", {
  value: true
});

exports.default = void 0;

var _react = _interopRequireWildcard(__webpack_require__(183));

__webpack_require__(30);

var _classCallCheck2 = _interopRequireDefault(__webpack_require__(2));

var _possibleConstructorReturn2 = _interopRequireDefault(__webpack_require__(5));

var _getPrototypeOf3 = _interopRequireDefault(__webpack_require__(4));

var _assertThisInitialized2 = _interopRequireDefault(__webpack_require__(56));

var _inherits2 = _interopRequireDefault(__webpack_require__(6));

var _defineProperty2 = _interopRequireDefault(__webpack_require__(69));

var _propTypes = _interopRequireDefault(__webpack_require__(204));

var Icon =
/*#__PURE__*/
function (_Component) {
  (0, _inherits2.default)(Icon, _Component);

  function Icon() {
    var _getPrototypeOf2;

    var _this;

    (0, _classCallCheck2.default)(this, Icon);

    for (var _len = arguments.length, args = new Array(_len), _key = 0; _key < _len; _key++) {
      args[_key] = arguments[_key];
    }

    _this = (0, _possibleConstructorReturn2.default)(this, (_getPrototypeOf2 = (0, _getPrototypeOf3.default)(Icon)).call.apply(_getPrototypeOf2, [this].concat(args)));
    (0, _defineProperty2.default)((0, _assertThisInitialized2.default)(_this), "setSelected", function () {
      _this.props.setSelectedHandler({
        value: _this.props.data.displayPrefix + ' ' + _this.props.data.selector,
        library: _this.props.library
      });
    });
    (0, _defineProperty2.default)((0, _assertThisInitialized2.default)(_this), "render", function () {
      return _react.default.createElement("div", {
        className: _this.props.containerClass,
        key: _this.props.keyID,
        onClick: _this.setSelected,
        filter: _this.props.data.filter
      }, _react.default.createElement("div", {
        className: "elementor-icons-manager__tab__item__content"
      }, _react.default.createElement("i", {
        className: 'elementor-icons-manager__tab__item__icon ' + _this.props.className
      }), _react.default.createElement("div", {
        className: 'elementor-icons-manager__tab__item__name',
        title: _this.props.data.name
      }, _this.props.data.name)));
    });
    return _this;
  }

  return Icon;
}(_react.Component);

exports.default = Icon;
Icon.propTypes = {
  className: _propTypes.default.string,
  containerClass: _propTypes.default.string,
  data: _propTypes.default.object,
  keyID: _propTypes.default.string,
  library: _propTypes.default.string,
  selector: _propTypes.default.string,
  setSelectedHandler: _propTypes.default.func
};

/***/ }),
/* 347 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var _interopRequireDefault = __webpack_require__(0);

var _interopRequireWildcard = __webpack_require__(103);

var _Object$defineProperty = __webpack_require__(1);

_Object$defineProperty(exports, "__esModule", {
  value: true
});

exports.default = void 0;

var _react = _interopRequireWildcard(__webpack_require__(183));

var _classCallCheck2 = _interopRequireDefault(__webpack_require__(2));

var _possibleConstructorReturn2 = _interopRequireDefault(__webpack_require__(5));

var _getPrototypeOf3 = _interopRequireDefault(__webpack_require__(4));

var _assertThisInitialized2 = _interopRequireDefault(__webpack_require__(56));

var _inherits2 = _interopRequireDefault(__webpack_require__(6));

var _defineProperty2 = _interopRequireDefault(__webpack_require__(69));

var IconsGoPro =
/*#__PURE__*/
function (_Component) {
  (0, _inherits2.default)(IconsGoPro, _Component);

  function IconsGoPro() {
    var _getPrototypeOf2;

    var _this;

    (0, _classCallCheck2.default)(this, IconsGoPro);

    for (var _len = arguments.length, args = new Array(_len), _key = 0; _key < _len; _key++) {
      args[_key] = arguments[_key];
    }

    _this = (0, _possibleConstructorReturn2.default)(this, (_getPrototypeOf2 = (0, _getPrototypeOf3.default)(IconsGoPro)).call.apply(_getPrototypeOf2, [this].concat(args)));
    (0, _defineProperty2.default)((0, _assertThisInitialized2.default)(_this), "render", function () {
      return _react.default.createElement("div", {
        id: "elementor-icons-manager__promotion"
      }, _react.default.createElement("i", {
        id: "elementor-icons-manager__promotion__icon",
        className: "eicon-nerd"
      }), _react.default.createElement("div", {
        id: "elementor-icons-manager__promotion__text"
      }, elementor.translate('icons_promotion')), _react.default.createElement("a", {
        href: elementor.config.icons.goProURL,
        id: "elementor-icons-manager__promotion__link",
        target: "_blank",
        rel: "noopener noreferrer"
      }, elementor.translate('go_pro')));
    });
    return _this;
  }

  return IconsGoPro;
}(_react.Component);

var _default = IconsGoPro;
exports.default = _default;

/***/ }),
/* 348 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var _interopRequireDefault = __webpack_require__(0);

var _Object$defineProperty = __webpack_require__(1);

_Object$defineProperty(exports, "__esModule", {
  value: true
});

exports.default = void 0;

var _keys = _interopRequireDefault(__webpack_require__(27));

__webpack_require__(48);

__webpack_require__(68);

var _entries = _interopRequireDefault(__webpack_require__(98));

var _typeof2 = _interopRequireDefault(__webpack_require__(47));

__webpack_require__(30);

var _classCallCheck2 = _interopRequireDefault(__webpack_require__(2));

var _createClass2 = _interopRequireDefault(__webpack_require__(3));

var _defineProperty2 = _interopRequireDefault(__webpack_require__(69));

var _default =
/*#__PURE__*/
function () {
  function _default() {
    var _this = this;

    (0, _classCallCheck2.default)(this, _default);
    (0, _defineProperty2.default)(this, "loaded", {});
    (0, _defineProperty2.default)(this, "notifyCallback", null);
    (0, _defineProperty2.default)(this, "fetchIcons", function (library) {
      fetch(library.fetchJson, {
        mode: 'cors'
      }).then(function (res) {
        return res.json();
      }).then(function (json) {
        library.icons = json.icons;
        return _this.normalizeIconList(library);
      });
    });
    (0, _defineProperty2.default)(this, "runCallback", function (library) {
      if ('function' !== typeof _this.notifyCallback) {
        return library;
      }

      return _this.notifyCallback(library);
    });
    (0, _defineProperty2.default)(this, "initIconType", function (libraryConfig, callback) {
      _this.notifyCallback = callback;
      var store = elementor.iconManager.store;

      if (_this.loaded[libraryConfig.name]) {
        libraryConfig.icons = store.getIcons(libraryConfig);
        return _this.runCallback(libraryConfig);
      } // Enqueue CSS


      if (libraryConfig.enqueue) {
        libraryConfig.enqueue.forEach(function (assetURL) {
          elementor.helpers.enqueueEditorStylesheet(assetURL);
        });
      }

      if (libraryConfig.url) {
        elementor.helpers.enqueueEditorStylesheet(libraryConfig.url);
      } //already saved an stored


      if (store.isValid(libraryConfig)) {
        var data = store.get(store.getKey(libraryConfig));
        return _this.normalizeIconList(data);
      } // comes with icons


      if (libraryConfig.icons && libraryConfig.icons.length) {
        return _this.normalizeIconList(libraryConfig);
      } // Get icons from via ajax


      if (libraryConfig.fetchJson) {
        return _this.fetchIcons(libraryConfig);
      } // @todo: error handling

    });
  }

  (0, _createClass2.default)(_default, [{
    key: "normalizeIconList",
    value: function normalizeIconList(library) {
      var icons = {};
      var name;
      jQuery.each(library.icons, function (index, icon) {
        name = icon;

        if ('object' === (0, _typeof2.default)(name)) {
          name = (0, _entries.default)(name)[0][0];
        }

        if (!name) {
          return;
        }

        icons[name] = {
          prefix: library.prefix,
          selector: library.prefix + name.trim(':'),
          name: elementorCommon.helpers.upperCaseWords(name).trim(':').split('-').join(' '),
          filter: name.trim(':'),
          displayPrefix: library.displayPrefix || library.prefix.replace('-', '')
        };
      });

      if ((0, _keys.default)(icons).length) {
        library.icons = icons;
        this.loaded[library.name] = true;
        elementor.iconManager.store.save(library);
        this.runCallback(library);
      }
    }
  }]);
  return _default;
}();

exports.default = _default;

/***/ }),
/* 349 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var _interopRequireDefault = __webpack_require__(0);

var _Object$defineProperty = __webpack_require__(1);

_Object$defineProperty(exports, "__esModule", {
  value: true
});

exports.default = void 0;

__webpack_require__(30);

var _classCallCheck2 = _interopRequireDefault(__webpack_require__(2));

var _createClass2 = _interopRequireDefault(__webpack_require__(3));

var Store =
/*#__PURE__*/
function () {
  function Store() {
    (0, _classCallCheck2.default)(this, Store);
  }

  (0, _createClass2.default)(Store, [{
    key: "save",
    value: function save(library) {
      elementorCommon.storage.set(Store.getKey(library), library);
    }
  }, {
    key: "getIcons",
    value: function getIcons(library) {
      var data = this.get(Store.getKey(library));

      if (data && data.icons) {
        return data.icons;
      }

      return false;
    }
  }, {
    key: "get",
    value: function get(key) {
      return elementorCommon.storage.get(key);
    }
  }, {
    key: "isValid",
    value: function isValid(library) {
      var saved = this.get(Store.getKey(library));

      if (!saved) {
        return false;
      }

      if (saved.ver !== library.ver) {
        // @todo: delete from localStorage if version is invalid
        return false;
      }

      return saved.icons && saved.icons.length;
    }
  }], [{
    key: "getKey",
    value: function getKey(library) {
      var name = library.name ? library.name : library;
      return "elementor_".concat(name, "_icons");
    }
  }]);
  return Store;
}();

var _default = Store;
exports.default = _default;

/***/ }),
/* 350 */
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

var _possibleConstructorReturn2 = _interopRequireDefault(__webpack_require__(5));

var _getPrototypeOf2 = _interopRequireDefault(__webpack_require__(4));

var _get2 = _interopRequireDefault(__webpack_require__(28));

var _inherits2 = _interopRequireDefault(__webpack_require__(6));

var _baseData = _interopRequireDefault(__webpack_require__(65));

var _colorPicker = _interopRequireDefault(__webpack_require__(221));

var _default =
/*#__PURE__*/
function (_ControlBaseDataView) {
  (0, _inherits2.default)(_default, _ControlBaseDataView);

  function _default() {
    (0, _classCallCheck2.default)(this, _default);
    return (0, _possibleConstructorReturn2.default)(this, (0, _getPrototypeOf2.default)(_default).apply(this, arguments));
  }

  (0, _createClass2.default)(_default, [{
    key: "ui",
    value: function ui() {
      var ui = (0, _get2.default)((0, _getPrototypeOf2.default)(_default.prototype), "ui", this).call(this);
      ui.pickerContainer = '.elementor-control-input-wrapper';
      return ui;
    }
  }, {
    key: "applySavedValue",
    value: function applySavedValue() {
      if (this.colorPicker) {
        this.colorPicker.picker.setColor(this.getControlValue());
      } else {
        this.initPicker();
      }
    }
  }, {
    key: "initPicker",
    value: function initPicker() {
      var _this = this;

      var options = {
        picker: {
          el: this.ui.pickerContainer[0],
          default: this.getControlValue(),
          components: {
            opacity: this.model.get('alpha')
          }
        },
        onChange: function onChange() {
          return _this.onPickerChange();
        },
        onClear: function onClear() {
          return _this.onPickerClear();
        }
      };
      this.colorPicker = new _colorPicker.default(options);
    }
  }, {
    key: "onPickerChange",
    value: function onPickerChange() {
      this.setValue(this.colorPicker.getColor());
    }
  }, {
    key: "onPickerClear",
    value: function onPickerClear() {
      this.setValue('');
    }
  }, {
    key: "onBeforeDestroy",
    value: function onBeforeDestroy() {
      this.colorPicker.destroy();
    }
  }]);
  return _default;
}(_baseData.default);

exports.default = _default;

/***/ }),
/* 351 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var _interopRequireDefault = __webpack_require__(0);

__webpack_require__(352);

var _typeof2 = _interopRequireDefault(__webpack_require__(47));

__webpack_require__(85);

__webpack_require__(239);

__webpack_require__(68);

__webpack_require__(173);

__webpack_require__(99);

var _keys = _interopRequireDefault(__webpack_require__(27));

__webpack_require__(48);

__webpack_require__(30);

__webpack_require__(15);

var _colorPicker = _interopRequireDefault(__webpack_require__(221));

module.exports = {
  _enqueuedFonts: [],
  _enqueuedIconFonts: [],
  _inlineSvg: [],
  elementsHierarchy: {
    document: {
      section: {
        column: {
          widget: null,
          section: null
        }
      }
    }
  },
  enqueueCSS: function enqueueCSS(url, $document) {
    var selector = 'link[href="' + url + '"]',
        link = '<link href="' + url + '" rel="stylesheet" type="text/css">';

    if (!$document) {
      return;
    }

    if (!$document.find(selector).length) {
      $document.find('link:last').after(link);
    }
  },
  enqueuePreviewStylesheet: function enqueuePreviewStylesheet(url) {
    this.enqueueCSS(url, elementor.$previewContents);
  },
  enqueueEditorStylesheet: function enqueueEditorStylesheet(url) {
    this.enqueueCSS(url, elementorCommon.elements.$document);
  },

  /**
   * @deprecated 2.6.0
   */
  enqueueStylesheet: function enqueueStylesheet(url) {
    elementorCommon.helpers.hardDeprecated('elementor.helpers.enqueueStylesheet()', '2.6.0', 'elementor.helpers.enqueuePreviewStylesheet()');
    this.enqueuePreviewStylesheet(url);
  },
  fetchInlineSvg: function fetchInlineSvg(svgUrl) {
    var callback = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : false;
    fetch(svgUrl).then(function (response) {
      return response.ok ? response.text() : '';
    }).then(function (data) {
      if (callback) {
        callback(data);
      }
    });
  },
  getInlineSvg: function getInlineSvg(value, view) {
    if (!value.id) {
      return;
    }

    if (this._inlineSvg.hasOwnProperty(value.id)) {
      return this._inlineSvg[value.id];
    }

    var self = this;
    this.fetchInlineSvg(value.url, function (data) {
      if (data) {
        self._inlineSvg[value.id] = data; //$( data ).find( 'svg' )[ 0 ].outerHTML;

        if (view) {
          view.render();
        }

        elementor.channels.editor.trigger('svg:insertion', data, value.id);
      }
    });
  },
  enqueueIconFonts: function enqueueIconFonts(iconType) {
    var _this = this;

    if (-1 !== this._enqueuedIconFonts.indexOf(iconType) || !!ElementorConfig['icons_update_needed']) {
      return;
    }

    var iconSetting = this.getIconLibrarySettings(iconType);

    if (!iconSetting) {
      return;
    }

    if (iconSetting.enqueue) {
      iconSetting.enqueue.forEach(function (assetURL) {
        _this.enqueuePreviewStylesheet(assetURL);

        _this.enqueueEditorStylesheet(assetURL);
      });
    }

    if (iconSetting.url) {
      this.enqueuePreviewStylesheet(iconSetting.url);
      this.enqueueEditorStylesheet(iconSetting.url);
    }

    this._enqueuedIconFonts.push(iconType);

    elementor.channels.editor.trigger('fontIcon:insertion', iconType, iconSetting);
  },
  getIconLibrarySettings: function getIconLibrarySettings(iconType) {
    var iconSetting = elementor.config.icons.libraries.filter(function (library) {
      return iconType === library.name;
    });

    if (iconSetting[0] && iconSetting[0].name) {
      return iconSetting[0];
    }

    return false;
  },

  /**
   *
   * @param view - view to refresh if needed
   * @param icon - icon control data
   * @param attributes - default {} - attributes to attach to rendered html tag
   * @param tag - default i - html tag to render
   * @param returnType - default value - retrun type
   * @returns {string|boolean|*}
   */
  renderIcon: function renderIcon(view, icon) {
    var attributes = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : {};
    var tag = arguments.length > 3 && arguments[3] !== undefined ? arguments[3] : 'i';
    var returnType = arguments.length > 4 && arguments[4] !== undefined ? arguments[4] : 'value';

    if (!icon || !icon.library) {
      if ('object' === returnType) {
        return {
          rendered: false
        };
      }

      return;
    }

    var iconType = icon.library,
        iconValue = icon.value;

    if ('svg' === iconType) {
      if ('panel' === returnType) {
        return '<img src="' + iconValue.url + '">';
      }

      return {
        rendered: true,
        value: this.getInlineSvg(iconValue, view)
      };
    }

    var iconSettings = this.getIconLibrarySettings(iconType);

    if (iconSettings && !iconSettings.hasOwnProperty('isCustom')) {
      this.enqueueIconFonts(iconType);

      if ('panel' === returnType) {
        return '<' + tag + ' class="' + iconValue + '"></' + tag + '>';
      }

      var tagUniqueID = tag + this.getUniqueID();
      view.addRenderAttribute(tagUniqueID, attributes);
      view.addRenderAttribute(tagUniqueID, 'class', iconValue);
      var htmlTag = '<' + tag + ' ' + view.getRenderAttributeString(tagUniqueID) + '></' + tag + '>';

      if ('object' === returnType) {
        return {
          rendered: true,
          value: htmlTag
        };
      }

      return htmlTag;
    }

    elementor.channels.editor.trigger('Icon:insertion', iconType, iconValue, attributes, tag, view);

    if ('object' === returnType) {
      return {
        rendered: false
      };
    }
  },
  isIconMigrated: function isIconMigrated(settings, controlName) {
    return settings.__fa4_migrated && settings.__fa4_migrated[controlName];
  },
  fetchFa4ToFa5Mapping: function fetchFa4ToFa5Mapping() {
    var storageKey = 'fa4Tofa5Mapping';
    var mapping = elementorCommon.storage.get(storageKey);

    if (!mapping) {
      jQuery.getJSON(ElementorConfig.fa4_to_fa5_mapping_url, function (data) {
        mapping = data;
        elementorCommon.storage.set(storageKey, data);
      });
    }

    return mapping;
  },
  mapFa4ToFa5: function mapFa4ToFa5(fa4Value) {
    var mapping = this.fetchFa4ToFa5Mapping();

    if (mapping[fa4Value]) {
      return mapping[fa4Value];
    } // every thing else is converted to solid


    return {
      value: 'fas' + fa4Value.replace('fa ', ' '),
      library: 'fa-solid'
    };
  },
  enqueueFont: function enqueueFont(font) {
    if (-1 !== this._enqueuedFonts.indexOf(font)) {
      return;
    }

    var fontType = elementor.config.controls.font.options[font],
        subsets = {
      ru_RU: 'cyrillic',
      uk: 'cyrillic',
      bg_BG: 'cyrillic',
      vi: 'vietnamese',
      el: 'greek',
      he_IL: 'hebrew'
    };
    var fontUrl;

    switch (fontType) {
      case 'googlefonts':
        fontUrl = 'https://fonts.googleapis.com/css?family=' + font + ':100,100italic,200,200italic,300,300italic,400,400italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic';

        if (subsets[elementor.config.locale]) {
          fontUrl += '&subset=' + subsets[elementor.config.locale];
        }

        break;

      case 'earlyaccess':
        var fontLowerString = font.replace(/\s+/g, '').toLowerCase();
        fontUrl = 'https://fonts.googleapis.com/earlyaccess/' + fontLowerString + '.css';
        break;
    }

    if (!_.isEmpty(fontUrl)) {
      this.enqueuePreviewStylesheet(fontUrl);
    }

    this._enqueuedFonts.push(font);

    elementor.channels.editor.trigger('font:insertion', fontType, font);
  },
  resetEnqueuedFontsCache: function resetEnqueuedFontsCache() {
    this._enqueuedFonts = [];
    this._enqueuedIconFonts = [];
  },
  getElementChildType: function getElementChildType(elementType, container) {
    var _this2 = this;

    if (!container) {
      container = this.elementsHierarchy;
    }

    if (undefined !== container[elementType]) {
      if (jQuery.isPlainObject(container[elementType])) {
        return (0, _keys.default)(container[elementType]);
      }

      return null;
    }

    var result = null;
    jQuery.each(container, function (index, type) {
      if (!jQuery.isPlainObject(type)) {
        return;
      }

      var childType = _this2.getElementChildType(elementType, type);

      if (childType) {
        result = childType;
        return false;
      }
    });
    return result;
  },
  getUniqueID: function getUniqueID() {
    return Math.random().toString(16).substr(2, 7);
  },
  getSocialNetworkNameFromIcon: function getSocialNetworkNameFromIcon(iconsControl, fallbackControl) {
    var toUpperCase = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : false;
    var migrated = arguments.length > 3 && arguments[3] !== undefined ? arguments[3] : null;
    var withIcon = arguments.length > 4 && arguments[4] !== undefined ? arguments[4] : false;
    var social = '',
        icon = '';

    if (fallbackControl && !migrated) {
      social = fallbackControl.replace('fa fa-', '');
      icon = '<i class="' + fallbackControl + '"></i>';
    } else if (iconsControl.value && 'svg' !== iconsControl.library) {
      social = iconsControl.value.split(' ')[1];

      if (!social) {
        social = '';
      } else {
        social = social.replace('fa-', '');
      }

      icon = this.renderIcon(null, iconsControl, {}, 'i', 'panel');
    } else {
      icon = this.renderIcon(null, iconsControl, {}, 'i', 'panel');
    }

    if ('' !== social && toUpperCase) {
      social = social.split('-').join(' ');
      social = social.replace(/\b\w/g, function (letter) {
        return letter.toUpperCase();
      });
    }

    social = elementor.hooks.applyFilters('elementor/social_icons/network_name', social, iconsControl, fallbackControl, toUpperCase, withIcon);

    if (withIcon) {
      social = icon + ' ' + social;
    }

    return social;
  },
  getSimpleDialog: function getSimpleDialog(id, title, message, confirmString, onConfirm) {
    return elementorCommon.dialogsManager.createWidget('confirm', {
      id: id,
      headerMessage: title,
      message: message,
      position: {
        my: 'center center',
        at: 'center center'
      },
      strings: {
        confirm: confirmString,
        cancel: elementor.translate('cancel')
      },
      onConfirm: onConfirm
    });
  },
  maybeDisableWidget: function maybeDisableWidget() {
    if (!ElementorConfig['icons_update_needed']) {
      return false;
    }

    var elementView = elementor.channels.panelElements.request('element:selected'),
        widgetType = elementView.model.get('widgetType'),
        widgetData = elementor.config.widgets[widgetType],
        hasControlOfType = function hasControlOfType(controls, type) {
      var has = false;
      jQuery.each(controls, function (controlName, controlData) {
        if (type === controlData.type) {
          has = true;
          return false;
        }

        if ('repeater' === controlData.type) {
          has = hasControlOfType(controlData.fields, type);

          if (has) {
            return false;
          }
        }
      });
      return has;
    };

    if (widgetData) {
      var hasIconsControl = hasControlOfType(widgetData.controls, 'icons');

      if (hasIconsControl) {
        var onConfirm = function onConfirm() {
          window.location.href = ElementorConfig.tools_page_link + '&redirect_to=' + encodeURIComponent(document.location.href) + '#tab-fontawesome4_migration';
        };

        elementor.helpers.getSimpleDialog('elementor-enable-fa5-dialog', elementor.translate('enable_fa5'), elementor.translate('dialog_confirm_enable_fa5'), elementor.translate('update'), onConfirm).show();
        return true;
      }
    }

    return false;
  },

  /*
  * @deprecated 2.0.0
  */
  stringReplaceAll: function stringReplaceAll(string, replaces) {
    var re = new RegExp((0, _keys.default)(replaces).join('|'), 'gi');
    return string.replace(re, function (matched) {
      return replaces[matched];
    });
  },
  isActiveControl: function isActiveControl(controlModel, values) {
    var condition, conditions; // TODO: Better way to get this?

    if (_.isFunction(controlModel.get)) {
      condition = controlModel.get('condition');
      conditions = controlModel.get('conditions');
    } else {
      condition = controlModel.condition;
      conditions = controlModel.conditions;
    } // Multiple conditions with relations.


    if (conditions && !elementor.conditions.check(conditions, values)) {
      return false;
    }

    if (_.isEmpty(condition)) {
      return true;
    }

    var hasFields = _.filter(condition, function (conditionValue, conditionName) {
      var conditionNameParts = conditionName.match(/([a-z_\-0-9]+)(?:\[([a-z_]+)])?(!?)$/i),
          conditionRealName = conditionNameParts[1],
          conditionSubKey = conditionNameParts[2],
          isNegativeCondition = !!conditionNameParts[3],
          controlValue = values[conditionRealName];

      if (values.__dynamic__ && values.__dynamic__[conditionRealName]) {
        controlValue = values.__dynamic__[conditionRealName];
      }

      if (undefined === controlValue) {
        return true;
      }

      if (conditionSubKey && 'object' === (0, _typeof2.default)(controlValue)) {
        controlValue = controlValue[conditionSubKey];
      } // If it's a non empty array - check if the conditionValue contains the controlValue,
      // If the controlValue is a non empty array - check if the controlValue contains the conditionValue
      // otherwise check if they are equal. ( and give the ability to check if the value is an empty array )


      var isContains;

      if (_.isArray(conditionValue) && !_.isEmpty(conditionValue)) {
        isContains = _.contains(conditionValue, controlValue);
      } else if (_.isArray(controlValue) && !_.isEmpty(controlValue)) {
        isContains = _.contains(controlValue, conditionValue);
      } else {
        isContains = _.isEqual(conditionValue, controlValue);
      }

      return isNegativeCondition ? isContains : !isContains;
    });

    return _.isEmpty(hasFields);
  },
  cloneObject: function cloneObject(object) {
    elementorCommon.helpers.hardDeprecated('elementor.helpers.cloneObject', '2.3.0', 'elementorCommon.helpers.cloneObject');
    return elementorCommon.helpers.cloneObject(object);
  },
  disableElementEvents: function disableElementEvents($element) {
    $element.each(function () {
      var currentPointerEvents = this.style.pointerEvents;

      if ('none' === currentPointerEvents) {
        return;
      }

      jQuery(this).data('backup-pointer-events', currentPointerEvents).css('pointer-events', 'none');
    });
  },
  enableElementEvents: function enableElementEvents($element) {
    $element.each(function () {
      var $this = jQuery(this),
          backupPointerEvents = $this.data('backup-pointer-events');

      if (undefined === backupPointerEvents) {
        return;
      }

      $this.removeData('backup-pointer-events').css('pointer-events', backupPointerEvents);
    });
  },
  wpColorPicker: function wpColorPicker($element) {
    elementorCommon.helpers.deprecatedMethod('elementor.helpers.wpColorPicker()', '2.8.0', 'new ColorPicker()');
    return new _colorPicker.default({
      picker: {
        el: $element
      }
    });
  },
  isInViewport: function isInViewport(element, html) {
    var rect = element.getBoundingClientRect();
    html = html || document.documentElement;
    return rect.top >= 0 && rect.left >= 0 && rect.bottom <= (window.innerHeight || html.clientHeight) && rect.right <= (window.innerWidth || html.clientWidth);
  },
  scrollToView: function scrollToView($element, timeout, $parent) {
    if (undefined === timeout) {
      timeout = 500;
    }

    var $scrolled = $parent;
    var $elementorFrontendWindow = elementorFrontend.elements.$window;

    if (!$parent) {
      $parent = $elementorFrontendWindow;
      $scrolled = elementor.$previewContents.find('html, body');
    }

    setTimeout(function () {
      // Sometimes element removed during the timeout.
      if (!$element[0].isConnected) {
        return;
      }

      var parentHeight = $parent.height(),
          parentScrollTop = $parent.scrollTop(),
          elementTop = $parent === $elementorFrontendWindow ? $element.offset().top : $element[0].offsetTop,
          topToCheck = elementTop - parentScrollTop;

      if (topToCheck > 0 && topToCheck < parentHeight) {
        return;
      }

      var scrolling = elementTop - parentHeight / 2;
      $scrolled.stop(true).animate({
        scrollTop: scrolling
      }, 1000);
    }, timeout);
  },
  getElementInlineStyle: function getElementInlineStyle($element, properties) {
    var style = {},
        elementStyle = $element[0].style;
    properties.forEach(function (property) {
      style[property] = undefined !== elementStyle[property] ? elementStyle[property] : '';
    });
    return style;
  },
  cssWithBackup: function cssWithBackup($element, backupState, rules) {
    var cssBackup = this.getElementInlineStyle($element, (0, _keys.default)(rules));
    $element.data('css-backup-' + backupState, cssBackup).css(rules);
  },
  recoverCSSBackup: function recoverCSSBackup($element, backupState) {
    var backupKey = 'css-backup-' + backupState;
    $element.css($element.data(backupKey));
    $element.removeData(backupKey);
  },
  elementSizeToUnit: function elementSizeToUnit($element, size, unit) {
    var window = elementorFrontend.elements.window;

    switch (unit) {
      case '%':
        size = size / ($element.offsetParent().width() / 100);
        break;

      case 'vw':
        size = size / (window.innerWidth / 100);
        break;

      case 'vh':
        size = size / (window.innerHeight / 100);
    }

    return Math.round(size * 1000) / 1000;
  },
  compareVersions: function compareVersions(versionA, versionB, operator) {
    var prepareVersion = function prepareVersion(version) {
      version = version + '';
      return version.replace(/[^\d.]+/, '.-1.');
    };

    versionA = prepareVersion(versionA);
    versionB = prepareVersion(versionB);

    if (versionA === versionB) {
      return !operator || /^={2,3}$/.test(operator);
    }

    var versionAParts = versionA.split('.').map(Number),
        versionBParts = versionB.split('.').map(Number),
        longestVersionParts = Math.max(versionAParts.length, versionBParts.length);

    for (var i = 0; i < longestVersionParts; i++) {
      var valueA = versionAParts[i] || 0,
          valueB = versionBParts[i] || 0;

      if (valueA !== valueB) {
        return elementor.conditions.compare(valueA, valueB, operator);
      }
    }
  },
  getModelLabel: function getModelLabel(model) {
    var result;

    if (!(model instanceof Backbone.Model)) {
      model = new Backbone.Model(model);
    }

    if (model.get('labelSuffix')) {
      result = model.get('title') + ' ' + model.get('labelSuffix');
    } else if ('global' === model.get('widgetType')) {
      if (model.getTitle) {
        result = model.getTitle();
      }
    }

    if (!result) {
      result = elementor.getElementData(model).title;
    }

    return result;
  }
};

/***/ }),
/* 352 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";

var global = __webpack_require__(13);
var has = __webpack_require__(46);
var cof = __webpack_require__(36);
var inheritIfRequired = __webpack_require__(236);
var toPrimitive = __webpack_require__(88);
var fails = __webpack_require__(22);
var gOPN = __webpack_require__(238).f;
var gOPD = __webpack_require__(237).f;
var dP = __webpack_require__(35).f;
var $trim = __webpack_require__(353).trim;
var NUMBER = 'Number';
var $Number = global[NUMBER];
var Base = $Number;
var proto = $Number.prototype;
// Opera ~12 has broken Object#toString
var BROKEN_COF = cof(__webpack_require__(194)(proto)) == NUMBER;
var TRIM = 'trim' in String.prototype;

// 7.1.3 ToNumber(argument)
var toNumber = function (argument) {
  var it = toPrimitive(argument, false);
  if (typeof it == 'string' && it.length > 2) {
    it = TRIM ? it.trim() : $trim(it, 3);
    var first = it.charCodeAt(0);
    var third, radix, maxCode;
    if (first === 43 || first === 45) {
      third = it.charCodeAt(2);
      if (third === 88 || third === 120) return NaN; // Number('+0x1') should be NaN, old V8 fix
    } else if (first === 48) {
      switch (it.charCodeAt(1)) {
        case 66: case 98: radix = 2; maxCode = 49; break; // fast equal /^0b[01]+$/i
        case 79: case 111: radix = 8; maxCode = 55; break; // fast equal /^0o[0-7]+$/i
        default: return +it;
      }
      for (var digits = it.slice(2), i = 0, l = digits.length, code; i < l; i++) {
        code = digits.charCodeAt(i);
        // parseInt parses a string to a first unavailable symbol
        // but ToNumber should return NaN if a string contains unavailable symbols
        if (code < 48 || code > maxCode) return NaN;
      } return parseInt(digits, radix);
    }
  } return +it;
};

if (!$Number(' 0o1') || !$Number('0b1') || $Number('+0x1')) {
  $Number = function Number(value) {
    var it = arguments.length < 1 ? 0 : value;
    var that = this;
    return that instanceof $Number
      // check on 1..constructor(foo) case
      && (BROKEN_COF ? fails(function () { proto.valueOf.call(that); }) : cof(that) != NUMBER)
        ? inheritIfRequired(new Base(toNumber(it)), that, $Number) : toNumber(it);
  };
  for (var keys = __webpack_require__(21) ? gOPN(Base) : (
    // ES3:
    'MAX_VALUE,MIN_VALUE,NaN,NEGATIVE_INFINITY,POSITIVE_INFINITY,' +
    // ES6 (in case, if modules with ES6 Number statics required before):
    'EPSILON,isFinite,isInteger,isNaN,isSafeInteger,MAX_SAFE_INTEGER,' +
    'MIN_SAFE_INTEGER,parseFloat,parseInt,isInteger'
  ).split(','), j = 0, key; keys.length > j; j++) {
    if (has(Base, key = keys[j]) && !has($Number, key)) {
      dP($Number, key, gOPD(Base, key));
    }
  }
  $Number.prototype = proto;
  proto.constructor = $Number;
  __webpack_require__(31)(global, NUMBER, $Number);
}


/***/ }),
/* 353 */
/***/ (function(module, exports, __webpack_require__) {

var $export = __webpack_require__(29);
var defined = __webpack_require__(32);
var fails = __webpack_require__(22);
var spaces = __webpack_require__(354);
var space = '[' + spaces + ']';
var non = '\u200b\u0085';
var ltrim = RegExp('^' + space + space + '*');
var rtrim = RegExp(space + space + '*$');

var exporter = function (KEY, exec, ALIAS) {
  var exp = {};
  var FORCE = fails(function () {
    return !!spaces[KEY]() || non[KEY]() != non;
  });
  var fn = exp[KEY] = FORCE ? exec(trim) : spaces[KEY];
  if (ALIAS) exp[ALIAS] = fn;
  $export($export.P + $export.F * FORCE, 'String', exp);
};

// 1 -> String#trimLeft
// 2 -> String#trimRight
// 3 -> String#trim
var trim = exporter.trim = function (string, TYPE) {
  string = String(defined(string));
  if (TYPE & 1) string = string.replace(ltrim, '');
  if (TYPE & 2) string = string.replace(rtrim, '');
  return string;
};

module.exports = exporter;


/***/ }),
/* 354 */
/***/ (function(module, exports) {

module.exports = '\x09\x0A\x0B\x0C\x0D\x20\xA0\u1680\u180E\u2000\u2001\u2002\u2003' +
  '\u2004\u2005\u2006\u2007\u2008\u2009\u200A\u202F\u205F\u3000\u2028\u2029\uFEFF';


/***/ }),
/* 355 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var _interopRequireDefault = __webpack_require__(0);

var _keys = _interopRequireDefault(__webpack_require__(27));

var ImagesManager;

ImagesManager = function ImagesManager() {
  var self = this;
  var cache = {};
  var debounceDelay = 300;
  var registeredItems = [];

  var getNormalizedSize = function getNormalizedSize(image) {
    var size,
        imageSize = image.size;

    if ('custom' === imageSize) {
      var customDimension = image.dimension;

      if (customDimension.width || customDimension.height) {
        size = 'custom_' + customDimension.width + 'x' + customDimension.height;
      } else {
        return 'full';
      }
    } else {
      size = imageSize;
    }

    return size;
  };

  var viewsToUpdate = {};

  self.updateOnReceiveImage = function () {
    var elementView = elementor.getPanelView().getCurrentPageView().getOption('editedElementView');
    elementView.$el.addClass('elementor-loading'); // Add per cid for multiple images in a single view.

    viewsToUpdate[elementView.cid] = elementView;
    elementor.channels.editor.once('imagesManager:detailsReceived', function () {
      if (!_.isEmpty(viewsToUpdate)) {
        _(viewsToUpdate).each(function (view) {
          view.render();
          view.$el.removeClass('elementor-loading');
        });
      }

      viewsToUpdate = {};
    });
  };

  self.getImageUrl = function (image) {
    // Register for AJAX checking
    self.registerItem(image);
    var imageUrl = self.getItem(image); // If it's not in cache, like a new dropped widget or a custom size - get from settings

    if (!imageUrl) {
      if ('custom' === image.size) {
        if ($e.routes.isPartOf('panel/editor') && image.model) {
          self.updateOnReceiveImage();
        }

        return;
      } // If it's a new dropped widget


      imageUrl = image.url;
    }

    return imageUrl;
  };

  self.getItem = function (image) {
    var size = getNormalizedSize(image),
        id = image.id;

    if (!size) {
      return false;
    }

    if (cache[id] && cache[id][size]) {
      return cache[id][size];
    }

    return false;
  };

  self.registerItem = function (image) {
    if ('' === image.id) {
      // It's a new dropped widget
      return;
    }

    if (self.getItem(image)) {
      // It's already in cache
      return;
    }

    registeredItems.push(image);
    self.debounceGetRemoteItems();
  };

  self.getRemoteItems = function () {
    var requestedItems = [],
        registeredItemsLength = (0, _keys.default)(registeredItems).length,
        image,
        index; // It's one item, so we can render it from remote server

    if (0 === registeredItemsLength) {
      return;
    }

    for (index in registeredItems) {
      image = registeredItems[index];
      var size = getNormalizedSize(image),
          id = image.id,
          isFirstTime = !cache[id] || 0 === (0, _keys.default)(cache[id]).length;
      requestedItems.push({
        id: id,
        size: size,
        is_first_time: isFirstTime
      });
    }

    elementorCommon.ajax.send('get_images_details', {
      data: {
        items: requestedItems
      },
      success: function success(data) {
        var imageId, imageSize;

        for (imageId in data) {
          if (!cache[imageId]) {
            cache[imageId] = {};
          }

          for (imageSize in data[imageId]) {
            cache[imageId][imageSize] = data[imageId][imageSize];
          }
        }

        registeredItems = [];
        elementor.channels.editor.trigger('imagesManager:detailsReceived', data);
      }
    });
  };

  self.debounceGetRemoteItems = _.debounce(self.getRemoteItems, debounceDelay);
};

module.exports = new ImagesManager();

/***/ }),
/* 356 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


__webpack_require__(85);

__webpack_require__(30);

var Debug = function Debug() {
  var self = this,
      errorStack = [],
      settings = {},
      elements = {};

  var initSettings = function initSettings() {
    settings = {
      debounceDelay: 500,
      urlsToWatch: ['elementor/assets']
    };
  };

  var initElements = function initElements() {
    elements.$window = jQuery(window);
  };

  var onError = function onError(event) {
    var originalEvent = event.originalEvent,
        error = originalEvent.error;

    if (!error) {
      return;
    }

    var isInWatchList = false,
        urlsToWatch = settings.urlsToWatch;
    jQuery.each(urlsToWatch, function () {
      if (-1 !== error.stack.indexOf(this)) {
        isInWatchList = true;
        return false;
      }
    });

    if (!isInWatchList) {
      return;
    }

    self.addError({
      type: error.name,
      message: error.message,
      url: originalEvent.filename,
      line: originalEvent.lineno,
      column: originalEvent.colno
    });
  };

  var bindEvents = function bindEvents() {
    elements.$window.on('error', onError);
  };

  var init = function init() {
    initSettings();
    initElements();
    bindEvents();
    self.sendErrors = _.debounce(self.sendErrors, settings.debounceDelay);
  };

  this.addURLToWatch = function (url) {
    settings.urlsToWatch.push(url);
  };

  this.addCustomError = function (error, category, tag) {
    var errorInfo = {
      type: error.name,
      message: error.message,
      url: error.fileName || error.sourceURL,
      line: error.lineNumber || error.line,
      column: error.columnNumber || error.column,
      customFields: {
        category: category || 'general',
        tag: tag
      }
    };

    if (!errorInfo.url) {
      var stackInfo = error.stack.match(/\n {4}at (.*?(?=:(\d+):(\d+)))/);

      if (stackInfo) {
        errorInfo.url = stackInfo[1];
        errorInfo.line = stackInfo[2];
        errorInfo.column = stackInfo[3];
      }
    }

    this.addError(errorInfo);
  };

  this.addError = function (errorParams) {
    var defaultParams = {
      type: 'Error',
      timestamp: Math.floor(new Date().getTime() / 1000),
      message: null,
      url: null,
      line: null,
      column: null,
      customFields: {}
    };
    errorStack.push(jQuery.extend(true, defaultParams, errorParams));
    self.sendErrors();
  };

  this.sendErrors = function () {
    // Avoid recursions on errors in ajax
    elements.$window.off('error', onError);
    jQuery.ajax({
      url: elementorCommon.config.ajax.url,
      method: 'POST',
      data: {
        action: 'elementor_js_log',
        _nonce: elementorCommon.ajax.getSettings('nonce'),
        data: errorStack
      },
      success: function success() {
        errorStack = []; // Restore error handler

        elements.$window.on('error', onError);
      }
    });
  };

  init();
};

module.exports = new Debug();

/***/ }),
/* 357 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var _interopRequireDefault = __webpack_require__(0);

var _keys = _interopRequireDefault(__webpack_require__(27));

var _stringify = _interopRequireDefault(__webpack_require__(175));

__webpack_require__(15);

var Schemes,
    Stylesheet = __webpack_require__(240),
    ControlsCSSParser = __webpack_require__(222);

Schemes = function Schemes() {
  var self = this,
      stylesheet = new Stylesheet(),
      schemes = {},
      settings = {
    selectorWrapperPrefix: '.elementor-widget-'
  },
      elements = {};

  var buildUI = function buildUI() {
    elements.$previewHead.append(elements.$style);
  };

  var initElements = function initElements() {
    elements.$style = jQuery('<style>', {
      id: 'elementor-style-scheme'
    });
    elements.$previewHead = elementor.$previewContents.find('head');
  };

  var initSchemes = function initSchemes() {
    schemes = elementorCommon.helpers.cloneObject(elementor.config.schemes.items);
  };

  var fetchControlStyles = function fetchControlStyles(control, controlsStack, widgetType) {
    ControlsCSSParser.addControlStyleRules(stylesheet, control, controlsStack, function (controlStyles) {
      return self.getSchemeValue(controlStyles.scheme.type, controlStyles.scheme.value, controlStyles.scheme.key).value;
    }, ['{{WRAPPER}}'], [settings.selectorWrapperPrefix + widgetType]);
  };

  var fetchWidgetControlsStyles = function fetchWidgetControlsStyles(widget) {
    var widgetSchemeControls = self.getWidgetSchemeControls(widget);

    _.each(widgetSchemeControls, function (control) {
      fetchControlStyles(control, widgetSchemeControls, widget.widget_type);
    });
  };

  var fetchAllWidgetsSchemesStyle = function fetchAllWidgetsSchemesStyle() {
    _.each(elementor.config.widgets, function (widget) {
      fetchWidgetControlsStyles(widget);
    });
  };

  this.init = function () {
    initElements();
    buildUI();
    initSchemes();
    return self;
  };

  this.getWidgetSchemeControls = function (widget) {
    return _.filter(widget.controls, function (control) {
      return _.isObject(control.scheme);
    });
  };

  this.getSchemes = function () {
    return schemes;
  };

  this.getEnabledSchemesTypes = function () {
    return elementor.config.schemes.enabled_schemes;
  };

  this.getScheme = function (schemeType) {
    return schemes[schemeType];
  };

  this.getSchemeValue = function (schemeType, value, key) {
    if (this.getEnabledSchemesTypes().indexOf(schemeType) < 0) {
      return false;
    }

    var scheme = self.getScheme(schemeType),
        schemeValue = scheme.items[value];

    if (key && _.isObject(schemeValue)) {
      var clonedSchemeValue = elementorCommon.helpers.cloneObject(schemeValue);
      clonedSchemeValue.value = schemeValue.value[key];
      return clonedSchemeValue;
    }

    return schemeValue;
  };

  this.printSchemesStyle = function () {
    stylesheet.empty();
    fetchAllWidgetsSchemesStyle();
    elements.$style.text(stylesheet);
  };

  this.resetSchemes = function (schemeName) {
    schemes[schemeName] = elementorCommon.helpers.cloneObject(elementor.config.schemes.items[schemeName]);
  };

  this.saveScheme = function (schemeName) {
    elementor.config.schemes.items[schemeName].items = elementorCommon.helpers.cloneObject(schemes[schemeName].items);
    var itemsToSave = {};

    _.each(schemes[schemeName].items, function (item, key) {
      itemsToSave[key] = item.value;
    });

    return elementorCommon.ajax.addRequest('apply_scheme', {
      data: {
        scheme_name: schemeName,
        data: (0, _stringify.default)(itemsToSave)
      }
    });
  };

  this.setSchemeValue = function (schemeName, itemKey, value) {
    schemes[schemeName].items[itemKey].value = value;
  };

  this.addSchemeItem = function (schemeName, item, at) {
    var scheme = schemes[schemeName],
        schemeKeys = (0, _keys.default)(scheme.items),
        hasAt = undefined !== at,
        targetIndex = hasAt ? at : +schemeKeys.slice(-1)[0] || 0;

    if (hasAt) {
      var itemIndex = schemeKeys.length + 1;

      for (; itemIndex > at; itemIndex--) {
        scheme.items[itemIndex] = scheme.items[itemIndex - 1];
      }
    }

    scheme.items[targetIndex + 1] = item;
  };

  this.removeSchemeItem = function (schemeName, itemKey) {
    var items = schemes[schemeName].items;

    while (true) {
      itemKey++;
      var nextItem = items[itemKey + 1];

      if (!nextItem) {
        delete items[itemKey];
        break;
      }

      items[itemKey] = nextItem;
    }
  };
};

module.exports = new Schemes();

/***/ }),
/* 358 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var presetsFactory;
presetsFactory = {
  getPresetsDictionary: function getPresetsDictionary() {
    return {
      11: 100 / 9,
      12: 100 / 8,
      14: 100 / 7,
      16: 100 / 6,
      33: 100 / 3,
      66: 2 / 3 * 100,
      83: 5 / 6 * 100
    };
  },
  getAbsolutePresetValues: function getAbsolutePresetValues(preset) {
    var clonedPreset = elementorCommon.helpers.cloneObject(preset),
        presetDictionary = this.getPresetsDictionary();

    _.each(clonedPreset, function (unitValue, unitIndex) {
      if (presetDictionary[unitValue]) {
        clonedPreset[unitIndex] = presetDictionary[unitValue];
      }
    });

    return clonedPreset;
  },
  getPresets: function getPresets(columnsCount, presetIndex) {
    var presets = elementorCommon.helpers.cloneObject(elementor.config.elements.section.presets);

    if (columnsCount) {
      presets = presets[columnsCount];
    }

    if (presetIndex) {
      presets = presets[presetIndex];
    }

    return presets;
  },
  getPresetByStructure: function getPresetByStructure(structure) {
    var parsedStructure = this.getParsedStructure(structure);
    return this.getPresets(parsedStructure.columnsCount, parsedStructure.presetIndex);
  },
  getParsedStructure: function getParsedStructure(structure) {
    structure += ''; // Make sure this is a string

    return {
      columnsCount: structure.slice(0, -1),
      presetIndex: structure.substr(-1)
    };
  },
  getPresetSVG: function getPresetSVG(preset, svgWidth, svgHeight, separatorWidth) {
    svgWidth = svgWidth || 100;
    svgHeight = svgHeight || 50;
    separatorWidth = separatorWidth || 2;

    var absolutePresetValues = this.getAbsolutePresetValues(preset),
        presetSVGPath = this._generatePresetSVGPath(absolutePresetValues, svgWidth, svgHeight, separatorWidth);

    return this._createSVGPreset(presetSVGPath, svgWidth, svgHeight);
  },
  _createSVGPreset: function _createSVGPreset(presetPath, svgWidth, svgHeight) {
    // this is here to avoid being picked up by https re-write systems
    var protocol = 'ht' + 'tp';
    var svg = document.createElementNS(protocol + '://www.w3.org/2000/svg', 'svg');
    svg.setAttributeNS(protocol + '://www.w3.org/2000/xmlns/', 'xmlns:xlink', protocol + '://www.w3.org/1999/xlink');
    svg.setAttribute('viewBox', '0 0 ' + svgWidth + ' ' + svgHeight);
    var path = document.createElementNS(protocol + '://www.w3.org/2000/svg', 'path');
    path.setAttribute('d', presetPath);
    svg.appendChild(path);
    return svg;
  },
  _generatePresetSVGPath: function _generatePresetSVGPath(preset, svgWidth, svgHeight, separatorWidth) {
    var DRAW_SIZE = svgWidth - separatorWidth * (preset.length - 1);
    var xPointer = 0,
        dOutput = '';

    for (var i = 0; i < preset.length; i++) {
      if (i) {
        dOutput += ' ';
      }

      var increment = preset[i] / 100 * DRAW_SIZE;
      xPointer += increment;
      dOutput += 'M' + +xPointer.toFixed(4) + ',0';
      dOutput += 'V' + svgHeight;
      dOutput += 'H' + +(xPointer - increment).toFixed(4);
      dOutput += 'V0Z';
      xPointer += separatorWidth;
    }

    return dOutput;
  }
};
module.exports = presetsFactory;

/***/ }),
/* 359 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var _interopRequireDefault = __webpack_require__(0);

var _typeof2 = _interopRequireDefault(__webpack_require__(47));

var _stringify = _interopRequireDefault(__webpack_require__(175));

var _component = _interopRequireDefault(__webpack_require__(360));

var TemplateLibraryCollection = __webpack_require__(374),
    TemplateLibraryManager;

TemplateLibraryManager = function TemplateLibraryManager() {
  this.modalConfig = {};
  var self = this,
      templateTypes = {};
  var deleteDialog,
      errorDialog,
      templatesCollection,
      config = {},
      filterTerms = {};

  var registerDefaultTemplateTypes = function registerDefaultTemplateTypes() {
    var data = {
      saveDialog: {
        description: elementor.translate('save_your_template_description')
      },
      ajaxParams: {
        success: function success(successData) {
          $e.route('library/templates/my-templates', {
            onBefore: function onBefore() {
              if (templatesCollection) {
                var itemExist = templatesCollection.findWhere({
                  template_id: successData.template_id
                });

                if (!itemExist) {
                  templatesCollection.add(successData);
                }
              }
            }
          });
        },
        error: function error(errorData) {
          self.showErrorDialog(errorData);
        }
      }
    };

    _.each(['page', 'section', elementor.config.document.type], function (type) {
      var safeData = jQuery.extend(true, {}, data, {
        saveDialog: {
          title: elementor.translate('save_your_template', [elementor.translate(type)])
        }
      });
      self.registerTemplateType(type, safeData);
    });
  };

  var registerDefaultFilterTerms = function registerDefaultFilterTerms() {
    filterTerms = {
      text: {
        callback: function callback(value) {
          value = value.toLowerCase();

          if (this.get('title').toLowerCase().indexOf(value) >= 0) {
            return true;
          }

          return _.any(this.get('tags'), function (tag) {
            return tag.toLowerCase().indexOf(value) >= 0;
          });
        }
      },
      type: {},
      subtype: {},
      favorite: {}
    };
  };

  this.init = function () {
    registerDefaultTemplateTypes();
    registerDefaultFilterTerms();
    this.component = $e.components.register(new _component.default({
      manager: this
    }));
    elementor.addBackgroundClickListener('libraryToggleMore', {
      element: '.elementor-template-library-template-more'
    });
  };

  this.getTemplateTypes = function (type) {
    if (type) {
      return templateTypes[type];
    }

    return templateTypes;
  };

  this.registerTemplateType = function (type, data) {
    templateTypes[type] = data;
  };

  this.deleteTemplate = function (templateModel, options) {
    var dialog = self.getDeleteDialog();

    dialog.onConfirm = function () {
      if (options.onConfirm) {
        options.onConfirm();
      }

      elementorCommon.ajax.addRequest('delete_template', {
        data: {
          source: templateModel.get('source'),
          template_id: templateModel.get('template_id')
        },
        success: function success(response) {
          templatesCollection.remove(templateModel, {
            silent: true
          });

          if (options.onSuccess) {
            options.onSuccess(response);
          }
        }
      });
    };

    dialog.show();
  };

  this.importTemplate = function (model) {
    var args = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : {};
    elementorCommon.helpers.softDeprecated('importTemplate', '2.8.0', "$e.run( 'library/insert-template' )");
    args.model = model;
    $e.run('library/insert-template', args);
  };

  this.saveTemplate = function (type, data) {
    var templateType = templateTypes[type];

    _.extend(data, {
      source: 'local',
      type: type
    });

    if (templateType.prepareSavedData) {
      data = templateType.prepareSavedData(data);
    }

    data.content = (0, _stringify.default)(data.content);
    var ajaxParams = {
      data: data
    };

    if (templateType.ajaxParams) {
      _.extend(ajaxParams, templateType.ajaxParams);
    }

    elementorCommon.ajax.addRequest('save_template', ajaxParams);
  };

  this.requestTemplateContent = function (source, id, ajaxOptions) {
    var options = {
      unique_id: id,
      data: {
        source: source,
        edit_mode: true,
        display: true,
        template_id: id
      }
    };

    if (ajaxOptions) {
      jQuery.extend(true, options, ajaxOptions);
    }

    return elementorCommon.ajax.addRequest('get_template_data', options);
  };

  this.markAsFavorite = function (templateModel, favorite) {
    var options = {
      data: {
        source: templateModel.get('source'),
        template_id: templateModel.get('template_id'),
        favorite: favorite
      }
    };
    return elementorCommon.ajax.addRequest('mark_template_as_favorite', options);
  };

  this.getDeleteDialog = function () {
    if (!deleteDialog) {
      deleteDialog = elementorCommon.dialogsManager.createWidget('confirm', {
        id: 'elementor-template-library-delete-dialog',
        headerMessage: elementor.translate('delete_template'),
        message: elementor.translate('delete_template_confirm'),
        strings: {
          confirm: elementor.translate('delete')
        }
      });
    }

    return deleteDialog;
  };

  this.getErrorDialog = function () {
    if (!errorDialog) {
      errorDialog = elementorCommon.dialogsManager.createWidget('alert', {
        id: 'elementor-template-library-error-dialog',
        headerMessage: elementor.translate('an_error_occurred')
      });
    }

    return errorDialog;
  };

  this.getTemplatesCollection = function () {
    return templatesCollection;
  };

  this.getConfig = function (item) {
    if (item) {
      return config[item] ? config[item] : {};
    }

    return config;
  };

  this.requestLibraryData = function (options) {
    if (templatesCollection && !options.forceUpdate) {
      if (options.onUpdate) {
        options.onUpdate();
      }

      return;
    }

    if (options.onBeforeUpdate) {
      options.onBeforeUpdate();
    }

    var ajaxOptions = {
      data: {},
      success: function success(data) {
        templatesCollection = new TemplateLibraryCollection(data.templates);

        if (data.config) {
          config = data.config;
        }

        if (options.onUpdate) {
          options.onUpdate();
        }
      }
    };

    if (options.forceSync) {
      ajaxOptions.data.sync = true;
    }

    elementorCommon.ajax.addRequest('get_library_data', ajaxOptions);
  };

  this.getFilter = function (name) {
    return elementor.channels.templates.request('filter:' + name);
  };

  this.setFilter = function (name, value, silent) {
    elementor.channels.templates.reply('filter:' + name, value);

    if (!silent) {
      elementor.channels.templates.trigger('filter:change');
    }
  };

  this.getFilterTerms = function (termName) {
    if (termName) {
      return filterTerms[termName];
    }

    return filterTerms;
  };

  this.setScreen = function (args) {
    elementor.channels.templates.stopReplying();
    self.setFilter('source', args.source, true);
    self.setFilter('type', args.type, true);
    self.setFilter('subtype', args.subtype, true);
    self.showTemplates();
  };

  this.loadTemplates = function (_onUpdate) {
    self.requestLibraryData({
      onBeforeUpdate: self.layout.showLoadingView.bind(self.layout),
      onUpdate: function onUpdate() {
        self.layout.hideLoadingView();

        if (_onUpdate) {
          _onUpdate();
        }
      }
    });
  };

  this.showTemplates = function () {
    // The tabs should exist in DOM on loading.
    self.layout.setHeaderDefaultParts();
    self.loadTemplates(function () {
      var templatesToShow = self.filterTemplates();
      self.layout.showTemplatesView(new TemplateLibraryCollection(templatesToShow));
    });
  };

  this.filterTemplates = function () {
    var activeSource = self.getFilter('source');
    return templatesCollection.filter(function (model) {
      if (activeSource !== model.get('source')) {
        return false;
      }

      var typeInfo = templateTypes[model.get('type')];
      return !typeInfo || false !== typeInfo.showInLibrary;
    });
  };

  this.showErrorDialog = function (errorMessage) {
    if ('object' === (0, _typeof2.default)(errorMessage)) {
      var message = '';

      _.each(errorMessage, function (error) {
        message += '<div>' + error.message + '.</div>';
      });

      errorMessage = message;
    } else if (errorMessage) {
      errorMessage += '.';
    } else {
      errorMessage = '<i>&#60;The error message is empty&#62;</i>';
    }

    self.getErrorDialog().setMessage(elementor.translate('templates_request_error') + '<div id="elementor-template-library-error-info">' + errorMessage + '</div>').show();
  };
};

module.exports = new TemplateLibraryManager();

/***/ }),
/* 360 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var _interopRequireDefault = __webpack_require__(0);

var _Object$defineProperty = __webpack_require__(1);

_Object$defineProperty(exports, "__esModule", {
  value: true
});

exports.default = void 0;

var _assign = _interopRequireDefault(__webpack_require__(159));

var _classCallCheck2 = _interopRequireDefault(__webpack_require__(2));

var _createClass2 = _interopRequireDefault(__webpack_require__(3));

var _possibleConstructorReturn2 = _interopRequireDefault(__webpack_require__(5));

var _getPrototypeOf2 = _interopRequireDefault(__webpack_require__(4));

var _get2 = _interopRequireDefault(__webpack_require__(28));

var _inherits2 = _interopRequireDefault(__webpack_require__(6));

var _componentModal = _interopRequireDefault(__webpack_require__(199));

var TemplateLibraryLayoutView = __webpack_require__(361);

var Component =
/*#__PURE__*/
function (_ComponentModal) {
  (0, _inherits2.default)(Component, _ComponentModal);

  function Component() {
    (0, _classCallCheck2.default)(this, Component);
    return (0, _possibleConstructorReturn2.default)(this, (0, _getPrototypeOf2.default)(Component).apply(this, arguments));
  }

  (0, _createClass2.default)(Component, [{
    key: "__construct",
    value: function __construct(args) {
      // Before construct because it's used in defaultTabs().
      this.docLibraryConfig = elementor.config.document.remoteLibrary;
      (0, _get2.default)((0, _getPrototypeOf2.default)(Component.prototype), "__construct", this).call(this, args);

      if ('block' === this.docLibraryConfig.type) {
        this.setDefaultRoute('templates/blocks');
      } else {
        this.setDefaultRoute('templates/pages');
      }
    }
  }, {
    key: "getNamespace",
    value: function getNamespace() {
      return 'library';
    }
  }, {
    key: "defaultTabs",
    value: function defaultTabs() {
      return {
        'templates/blocks': {
          title: elementor.translate('blocks'),
          filter: {
            source: 'remote',
            type: 'block',
            subtype: this.docLibraryConfig.category
          }
        },
        'templates/pages': {
          title: elementor.translate('pages'),
          filter: {
            source: 'remote',
            type: 'page'
          }
        },
        'templates/my-templates': {
          title: elementor.translate('my_templates'),
          filter: {
            source: 'local'
          }
        }
      };
    }
  }, {
    key: "defaultRoutes",
    value: function defaultRoutes() {
      var _this = this;

      return {
        import: function _import() {
          _this.manager.layout.showImportView();
        },
        'save-template': function saveTemplate(args) {
          _this.manager.layout.showSaveTemplateView(args.model);
        },
        preview: function preview(args) {
          _this.manager.layout.showPreviewView(args.model);
        },
        connect: function connect(args) {
          args.texts = {
            title: elementor.translate('library/connect:title'),
            message: elementor.translate('library/connect:message'),
            button: elementor.translate('library/connect:button')
          };

          _this.manager.layout.showConnectView(args);
        }
      };
    }
  }, {
    key: "defaultCommands",
    value: function defaultCommands() {
      return (0, _assign.default)((0, _get2.default)((0, _getPrototypeOf2.default)(Component.prototype), "defaultCommands", this).call(this), {
        open: this.show,
        'insert-template': this.insertTemplate
      });
    }
  }, {
    key: "defaultShortcuts",
    value: function defaultShortcuts() {
      return {
        open: {
          keys: 'ctrl+shift+l'
        }
      };
    }
  }, {
    key: "renderTab",
    value: function renderTab(tab) {
      this.manager.setScreen(this.tabs[tab].filter);
    }
  }, {
    key: "activateTab",
    value: function activateTab(tab) {
      $e.routes.saveState('library');
      (0, _get2.default)((0, _getPrototypeOf2.default)(Component.prototype), "activateTab", this).call(this, tab);
    }
  }, {
    key: "open",
    value: function open() {
      (0, _get2.default)((0, _getPrototypeOf2.default)(Component.prototype), "open", this).call(this);

      if (!this.manager.layout) {
        this.manager.layout = this.layout;
      }

      this.manager.layout.setHeaderDefaultParts();
      return true;
    }
  }, {
    key: "close",
    value: function close() {
      if (!(0, _get2.default)((0, _getPrototypeOf2.default)(Component.prototype), "close", this).call(this)) {
        return false;
      }

      this.manager.modalConfig = {};
      return true;
    }
  }, {
    key: "show",
    value: function show(args) {
      this.manager.modalConfig = args;

      if (args.toDefault || !$e.routes.restoreState('library')) {
        $e.route(this.getDefaultRoute());
      }
    }
  }, {
    key: "insertTemplate",
    value: function insertTemplate(args) {
      var _this2 = this;

      var autoImportSettings = elementor.config.document.remoteLibrary.autoImportSettings,
          model = args.model;
      var _args$withPageSetting = args.withPageSettings,
          withPageSettings = _args$withPageSetting === void 0 ? null : _args$withPageSetting;

      if (autoImportSettings) {
        withPageSettings = true;
      }

      if (null === withPageSettings && model.get('hasPageSettings')) {
        var insertTemplateHandler = this.getImportSettingsDialog();
        insertTemplateHandler.showImportDialog(model);
        return;
      }

      this.manager.layout.showLoadingView();
      this.manager.requestTemplateContent(model.get('source'), model.get('template_id'), {
        data: {
          with_page_settings: withPageSettings
        },
        success: function success(data) {
          // Clone the `modalConfig.importOptions` because it deleted during the closing.
          var importOptions = jQuery.extend({}, _this2.manager.modalConfig.importOptions);
          importOptions.withPageSettings = withPageSettings; // Hide for next open.

          _this2.manager.layout.hideLoadingView();

          _this2.manager.layout.hideModal();

          $e.run('document/elements/import', {
            model: model,
            data: data,
            options: importOptions
          });
        },
        error: function error(data) {
          _this2.manager.showErrorDialog(data);
        },
        complete: function complete() {
          _this2.manager.layout.hideLoadingView();
        }
      });
    }
  }, {
    key: "getImportSettingsDialog",
    value: function getImportSettingsDialog() {
      // Moved from ./behaviors/insert-template.js
      var InsertTemplateHandler = {
        dialog: null,
        showImportDialog: function showImportDialog(model) {
          var dialog = InsertTemplateHandler.getDialog();

          dialog.onConfirm = function () {
            $e.run('library/insert-template', {
              model: model,
              withPageSettings: true
            });
          };

          dialog.onCancel = function () {
            $e.run('library/insert-template', {
              model: model,
              withPageSettings: false
            });
          };

          dialog.show();
        },
        initDialog: function initDialog() {
          InsertTemplateHandler.dialog = elementorCommon.dialogsManager.createWidget('confirm', {
            id: 'elementor-insert-template-settings-dialog',
            headerMessage: elementor.translate('import_template_dialog_header'),
            message: elementor.translate('import_template_dialog_message') + '<br>' + elementor.translate('import_template_dialog_message_attention'),
            strings: {
              confirm: elementor.translate('yes'),
              cancel: elementor.translate('no')
            }
          });
        },
        getDialog: function getDialog() {
          if (!InsertTemplateHandler.dialog) {
            InsertTemplateHandler.initDialog();
          }

          return InsertTemplateHandler.dialog;
        }
      };
      return InsertTemplateHandler;
    }
  }, {
    key: "getTabsWrapperSelector",
    value: function getTabsWrapperSelector() {
      return '#elementor-template-library-header-menu';
    }
  }, {
    key: "getModalLayout",
    value: function getModalLayout() {
      return TemplateLibraryLayoutView;
    }
  }]);
  return Component;
}(_componentModal.default);

exports.default = Component;

/***/ }),
/* 361 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var TemplateLibraryHeaderActionsView = __webpack_require__(362),
    TemplateLibraryHeaderMenuView = __webpack_require__(363),
    TemplateLibraryHeaderPreviewView = __webpack_require__(364),
    TemplateLibraryHeaderBackView = __webpack_require__(365),
    TemplateLibraryCollectionView = __webpack_require__(366),
    TemplateLibrarySaveTemplateView = __webpack_require__(370),
    TemplateLibraryImportView = __webpack_require__(371),
    TemplateLibraryConnectView = __webpack_require__(372),
    TemplateLibraryPreviewView = __webpack_require__(373);

module.exports = elementorModules.common.views.modal.Layout.extend({
  getModalOptions: function getModalOptions() {
    return {
      id: 'elementor-template-library-modal'
    };
  },
  getLogoOptions: function getLogoOptions() {
    return {
      title: elementor.translate('library'),
      click: function click() {
        $e.run('library/open', {
          toDefault: true
        });
      }
    };
  },
  getTemplateActionButton: function getTemplateActionButton(templateData) {
    var viewId = '#tmpl-elementor-template-library-' + (templateData.isPro ? 'get-pro-button' : 'insert-button');
    viewId = elementor.hooks.applyFilters('elementor/editor/template-library/template/action-button', viewId, templateData);
    var template = Marionette.TemplateCache.get(viewId);
    return Marionette.Renderer.render(template);
  },
  setHeaderDefaultParts: function setHeaderDefaultParts() {
    var headerView = this.getHeaderView();
    headerView.tools.show(new TemplateLibraryHeaderActionsView());
    headerView.menuArea.show(new TemplateLibraryHeaderMenuView());
    this.showLogo();
  },
  showTemplatesView: function showTemplatesView(templatesCollection) {
    this.modalContent.show(new TemplateLibraryCollectionView({
      collection: templatesCollection
    }));
  },
  showImportView: function showImportView() {
    this.getHeaderView().menuArea.reset();
    this.modalContent.show(new TemplateLibraryImportView());
  },
  showConnectView: function showConnectView(args) {
    this.getHeaderView().menuArea.reset();
    this.modalContent.show(new TemplateLibraryConnectView(args));
  },
  showSaveTemplateView: function showSaveTemplateView(elementModel) {
    this.getHeaderView().menuArea.reset();
    this.modalContent.show(new TemplateLibrarySaveTemplateView({
      model: elementModel
    }));
  },
  showPreviewView: function showPreviewView(templateModel) {
    this.modalContent.show(new TemplateLibraryPreviewView({
      url: templateModel.get('url')
    }));
    var headerView = this.getHeaderView();
    headerView.menuArea.reset();
    headerView.tools.show(new TemplateLibraryHeaderPreviewView({
      model: templateModel
    }));
    headerView.logoArea.show(new TemplateLibraryHeaderBackView());
  }
});

/***/ }),
/* 362 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


module.exports = Marionette.ItemView.extend({
  template: '#tmpl-elementor-template-library-header-actions',
  id: 'elementor-template-library-header-actions',
  ui: {
    import: '#elementor-template-library-header-import i',
    sync: '#elementor-template-library-header-sync i',
    save: '#elementor-template-library-header-save i'
  },
  events: {
    'click @ui.import': 'onImportClick',
    'click @ui.sync': 'onSyncClick',
    'click @ui.save': 'onSaveClick'
  },
  onImportClick: function onImportClick() {
    $e.route('library/import');
  },
  onSyncClick: function onSyncClick() {
    var self = this;
    self.ui.sync.addClass('eicon-animation-spin');
    elementor.templates.requestLibraryData({
      onUpdate: function onUpdate() {
        self.ui.sync.removeClass('eicon-animation-spin');
        $e.routes.refreshContainer('library');
      },
      forceUpdate: true,
      forceSync: true
    });
  },
  onSaveClick: function onSaveClick() {
    $e.route('library/save-template');
  }
});

/***/ }),
/* 363 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


module.exports = Marionette.ItemView.extend({
  template: '#tmpl-elementor-template-library-header-menu',
  id: 'elementor-template-library-header-menu',
  templateHelpers: function templateHelpers() {
    return {
      tabs: $e.components.get('library').getTabs()
    };
  }
});

/***/ }),
/* 364 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var TemplateLibraryInsertTemplateBehavior = __webpack_require__(259);

module.exports = Marionette.ItemView.extend({
  template: '#tmpl-elementor-template-library-header-preview',
  id: 'elementor-template-library-header-preview',
  behaviors: {
    insertTemplate: {
      behaviorClass: TemplateLibraryInsertTemplateBehavior
    }
  }
});

/***/ }),
/* 365 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


module.exports = Marionette.ItemView.extend({
  template: '#tmpl-elementor-template-library-header-back',
  id: 'elementor-template-library-header-preview-back',
  events: {
    click: 'onClick'
  },
  onClick: function onClick() {
    $e.routes.restoreState('library');
  }
});

/***/ }),
/* 366 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


__webpack_require__(161);

var TemplateLibraryTemplateLocalView = __webpack_require__(367),
    TemplateLibraryTemplateRemoteView = __webpack_require__(368),
    TemplateLibraryCollectionView;

TemplateLibraryCollectionView = Marionette.CompositeView.extend({
  template: '#tmpl-elementor-template-library-templates',
  id: 'elementor-template-library-templates',
  childViewContainer: '#elementor-template-library-templates-container',
  reorderOnSort: true,
  emptyView: function emptyView() {
    var EmptyView = __webpack_require__(369);

    return new EmptyView();
  },
  ui: {
    textFilter: '#elementor-template-library-filter-text',
    selectFilter: '.elementor-template-library-filter-select',
    myFavoritesFilter: '#elementor-template-library-filter-my-favorites',
    orderInputs: '.elementor-template-library-order-input',
    orderLabels: 'label.elementor-template-library-order-label'
  },
  events: {
    'input @ui.textFilter': 'onTextFilterInput',
    'change @ui.selectFilter': 'onSelectFilterChange',
    'change @ui.myFavoritesFilter': 'onMyFavoritesFilterChange',
    'mousedown @ui.orderLabels': 'onOrderLabelsClick'
  },
  comparators: {
    title: function title(model) {
      return model.get('title').toLowerCase();
    },
    popularityIndex: function popularityIndex(model) {
      var popularityIndex = model.get('popularityIndex');

      if (!popularityIndex) {
        popularityIndex = model.get('date');
      }

      return -popularityIndex;
    },
    trendIndex: function trendIndex(model) {
      var trendIndex = model.get('trendIndex');

      if (!trendIndex) {
        trendIndex = model.get('date');
      }

      return -trendIndex;
    }
  },
  getChildView: function getChildView(childModel) {
    if ('remote' === childModel.get('source')) {
      return TemplateLibraryTemplateRemoteView;
    }

    return TemplateLibraryTemplateLocalView;
  },
  initialize: function initialize() {
    this.listenTo(elementor.channels.templates, 'filter:change', this._renderChildren);
  },
  filter: function filter(childModel) {
    var filterTerms = elementor.templates.getFilterTerms(),
        passingFilter = true;
    jQuery.each(filterTerms, function (filterTermName) {
      var filterValue = elementor.templates.getFilter(filterTermName);

      if (!filterValue) {
        return;
      }

      if (this.callback) {
        var callbackResult = this.callback.call(childModel, filterValue);

        if (!callbackResult) {
          passingFilter = false;
        }

        return callbackResult;
      }

      var filterResult = filterValue === childModel.get(filterTermName);

      if (!filterResult) {
        passingFilter = false;
      }

      return filterResult;
    });
    return passingFilter;
  },
  order: function order(by, reverseOrder) {
    var comparator = this.comparators[by] || by;

    if (reverseOrder) {
      comparator = this.reverseOrder(comparator);
    }

    this.collection.comparator = comparator;
    this.collection.sort();
  },
  reverseOrder: function reverseOrder(comparator) {
    if ('function' !== typeof comparator) {
      var comparatorValue = comparator;

      comparator = function comparator(model) {
        return model.get(comparatorValue);
      };
    }

    return function (left, right) {
      var l = comparator(left),
          r = comparator(right);

      if (undefined === l) {
        return -1;
      }

      if (undefined === r) {
        return 1;
      }

      if (l < r) {
        return 1;
      }

      if (l > r) {
        return -1;
      }

      return 0;
    };
  },
  addSourceData: function addSourceData() {
    var isEmpty = this.children.isEmpty();
    this.$el.attr('data-template-source', isEmpty ? 'empty' : elementor.templates.getFilter('source'));
  },
  setFiltersUI: function setFiltersUI() {
    var $filters = this.$(this.ui.selectFilter);
    $filters.select2({
      placeholder: elementor.translate('category'),
      allowClear: true,
      width: 150
    });
  },
  setMasonrySkin: function setMasonrySkin() {
    var masonry = new elementorModules.utils.Masonry({
      container: this.$childViewContainer,
      items: this.$childViewContainer.children()
    });
    this.$childViewContainer.imagesLoaded(masonry.run.bind(masonry));
  },
  toggleFilterClass: function toggleFilterClass() {
    this.$el.toggleClass('elementor-templates-filter-active', !!(elementor.templates.getFilter('text') || elementor.templates.getFilter('favorite')));
  },
  onRender: function onRender() {
    if ('remote' === elementor.templates.getFilter('source') && 'page' !== elementor.templates.getFilter('type')) {
      this.setFiltersUI();
    }
  },
  onRenderCollection: function onRenderCollection() {
    this.addSourceData();
    this.toggleFilterClass();

    if ('remote' === elementor.templates.getFilter('source') && 'page' !== elementor.templates.getFilter('type')) {
      this.setMasonrySkin();
    }
  },
  onBeforeRenderEmpty: function onBeforeRenderEmpty() {
    this.addSourceData();
  },
  onTextFilterInput: function onTextFilterInput() {
    elementor.templates.setFilter('text', this.ui.textFilter.val());
  },
  onSelectFilterChange: function onSelectFilterChange(event) {
    var $select = jQuery(event.currentTarget),
        filterName = $select.data('elementor-filter');
    elementor.templates.setFilter(filterName, $select.val());
  },
  onMyFavoritesFilterChange: function onMyFavoritesFilterChange() {
    elementor.templates.setFilter('favorite', this.ui.myFavoritesFilter[0].checked);
  },
  onOrderLabelsClick: function onOrderLabelsClick(event) {
    var $clickedInput = jQuery(event.currentTarget.control),
        toggle;

    if (!$clickedInput[0].checked) {
      toggle = 'asc' !== $clickedInput.data('default-ordering-direction');
    }

    $clickedInput.toggleClass('elementor-template-library-order-reverse', toggle);
    this.order($clickedInput.val(), $clickedInput.hasClass('elementor-template-library-order-reverse'));
  }
});
module.exports = TemplateLibraryCollectionView;

/***/ }),
/* 367 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var TemplateLibraryTemplateView = __webpack_require__(260),
    TemplateLibraryTemplateLocalView;

TemplateLibraryTemplateLocalView = TemplateLibraryTemplateView.extend({
  template: '#tmpl-elementor-template-library-template-local',
  ui: function ui() {
    return _.extend(TemplateLibraryTemplateView.prototype.ui.apply(this, arguments), {
      deleteButton: '.elementor-template-library-template-delete',
      morePopup: '.elementor-template-library-template-more',
      toggleMore: '.elementor-template-library-template-more-toggle',
      toggleMoreIcon: '.elementor-template-library-template-more-toggle i'
    });
  },
  events: function events() {
    return _.extend(TemplateLibraryTemplateView.prototype.events.apply(this, arguments), {
      'click @ui.deleteButton': 'onDeleteButtonClick',
      'click @ui.toggleMore': 'onToggleMoreClick'
    });
  },
  onDeleteButtonClick: function onDeleteButtonClick() {
    var toggleMoreIcon = this.ui.toggleMoreIcon;
    elementor.templates.deleteTemplate(this.model, {
      onConfirm: function onConfirm() {
        toggleMoreIcon.removeClass('eicon-ellipsis-h').addClass('eicon-loading eicon-animation-spin');
      },
      onSuccess: function onSuccess() {
        elementor.templates.showTemplates();
      }
    });
  },
  onToggleMoreClick: function onToggleMoreClick() {
    this.ui.morePopup.show();
  },
  onPreviewButtonClick: function onPreviewButtonClick() {
    open(this.model.get('url'), '_blank');
  }
});
module.exports = TemplateLibraryTemplateLocalView;

/***/ }),
/* 368 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var TemplateLibraryTemplateView = __webpack_require__(260),
    TemplateLibraryTemplateRemoteView;

TemplateLibraryTemplateRemoteView = TemplateLibraryTemplateView.extend({
  template: '#tmpl-elementor-template-library-template-remote',
  ui: function ui() {
    return jQuery.extend(TemplateLibraryTemplateView.prototype.ui.apply(this, arguments), {
      favoriteCheckbox: '.elementor-template-library-template-favorite-input'
    });
  },
  events: function events() {
    return jQuery.extend(TemplateLibraryTemplateView.prototype.events.apply(this, arguments), {
      'change @ui.favoriteCheckbox': 'onFavoriteCheckboxChange'
    });
  },
  onPreviewButtonClick: function onPreviewButtonClick() {
    $e.route('library/preview', {
      model: this.model
    });
  },
  onFavoriteCheckboxChange: function onFavoriteCheckboxChange() {
    var isFavorite = this.ui.favoriteCheckbox[0].checked;
    this.model.set('favorite', isFavorite);
    elementor.templates.markAsFavorite(this.model, isFavorite);

    if (!isFavorite && elementor.templates.getFilter('favorite')) {
      elementor.channels.templates.trigger('filter:change');
    }
  }
});
module.exports = TemplateLibraryTemplateRemoteView;

/***/ }),
/* 369 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var TemplateLibraryTemplatesEmptyView;
TemplateLibraryTemplatesEmptyView = Marionette.ItemView.extend({
  id: 'elementor-template-library-templates-empty',
  template: '#tmpl-elementor-template-library-templates-empty',
  ui: {
    title: '.elementor-template-library-blank-title',
    message: '.elementor-template-library-blank-message'
  },
  modesStrings: {
    empty: {
      title: elementor.translate('templates_empty_title'),
      message: elementor.translate('templates_empty_message')
    },
    noResults: {
      title: elementor.translate('templates_no_results_title'),
      message: elementor.translate('templates_no_results_message')
    },
    noFavorites: {
      title: elementor.translate('templates_no_favorites_title'),
      message: elementor.translate('templates_no_favorites_message')
    }
  },
  getCurrentMode: function getCurrentMode() {
    if (elementor.templates.getFilter('text')) {
      return 'noResults';
    }

    if (elementor.templates.getFilter('favorite')) {
      return 'noFavorites';
    }

    return 'empty';
  },
  onRender: function onRender() {
    var modeStrings = this.modesStrings[this.getCurrentMode()];
    this.ui.title.html(modeStrings.title);
    this.ui.message.html(modeStrings.message);
  }
});
module.exports = TemplateLibraryTemplatesEmptyView;

/***/ }),
/* 370 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var TemplateLibrarySaveTemplateView;
TemplateLibrarySaveTemplateView = Marionette.ItemView.extend({
  id: 'elementor-template-library-save-template',
  template: '#tmpl-elementor-template-library-save-template',
  ui: {
    form: '#elementor-template-library-save-template-form',
    submitButton: '#elementor-template-library-save-template-submit'
  },
  events: {
    'submit @ui.form': 'onFormSubmit'
  },
  getSaveType: function getSaveType() {
    var type;

    if (this.model) {
      type = this.model.get('elType');
    } else if (elementor.config.document.library && elementor.config.document.library.save_as_same_type) {
      type = elementor.config.document.type;
    } else {
      type = 'page';
    }

    return type;
  },
  templateHelpers: function templateHelpers() {
    var saveType = this.getSaveType(),
        templateType = elementor.templates.getTemplateTypes(saveType);
    return templateType.saveDialog;
  },
  onFormSubmit: function onFormSubmit(event) {
    event.preventDefault();
    var formData = this.ui.form.elementorSerializeObject(),
        saveType = this.getSaveType(),
        JSONParams = {
      remove: ['default']
    };
    formData.content = this.model ? [this.model.toJSON(JSONParams)] : elementor.elements.toJSON(JSONParams);
    this.ui.submitButton.addClass('elementor-button-state');
    elementor.templates.saveTemplate(saveType, formData);
  }
});
module.exports = TemplateLibrarySaveTemplateView;

/***/ }),
/* 371 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


__webpack_require__(48);

__webpack_require__(30);

var TemplateLibraryImportView;
TemplateLibraryImportView = Marionette.ItemView.extend({
  template: '#tmpl-elementor-template-library-import',
  id: 'elementor-template-library-import',
  ui: {
    uploadForm: '#elementor-template-library-import-form',
    fileInput: '#elementor-template-library-import-form-input'
  },
  events: {
    'change @ui.fileInput': 'onFileInputChange'
  },
  droppedFiles: null,
  submitForm: function submitForm() {
    var _this = this;

    var file;

    if (this.droppedFiles) {
      file = this.droppedFiles[0];
      this.droppedFiles = null;
    } else {
      file = this.ui.fileInput[0].files[0];
      this.ui.uploadForm[0].reset();
    }

    var fileReader = new FileReader();

    fileReader.onload = function (event) {
      return _this.importTemplate(file.name, event.target.result.replace(/^[^,]+,/, ''));
    };

    fileReader.readAsDataURL(file);
  },
  importTemplate: function importTemplate(fileName, fileData) {
    var layout = elementor.templates.layout;
    var options = {
      data: {
        fileName: fileName,
        fileData: fileData
      },
      success: function success(successData) {
        elementor.templates.getTemplatesCollection().add(successData);
        $e.route('library/templates/my-templates');
      },
      error: function error(errorData) {
        elementor.templates.showErrorDialog(errorData);
        layout.showImportView();
      },
      complete: function complete() {
        layout.hideLoadingView();
      }
    };
    elementorCommon.ajax.addRequest('import_template', options);
    layout.showLoadingView();
  },
  onRender: function onRender() {
    this.ui.uploadForm.on({
      'drag dragstart dragend dragover dragenter dragleave drop': this.onFormActions.bind(this),
      dragenter: this.onFormDragEnter.bind(this),
      'dragleave drop': this.onFormDragLeave.bind(this),
      drop: this.onFormDrop.bind(this)
    });
  },
  onFormActions: function onFormActions(event) {
    event.preventDefault();
    event.stopPropagation();
  },
  onFormDragEnter: function onFormDragEnter() {
    this.ui.uploadForm.addClass('elementor-drag-over');
  },
  onFormDragLeave: function onFormDragLeave(event) {
    if (jQuery(event.relatedTarget).closest(this.ui.uploadForm).length) {
      return;
    }

    this.ui.uploadForm.removeClass('elementor-drag-over');
  },
  onFormDrop: function onFormDrop(event) {
    this.droppedFiles = event.originalEvent.dataTransfer.files;
    this.submitForm();
  },
  onFileInputChange: function onFileInputChange() {
    this.submitForm();
  }
});
module.exports = TemplateLibraryImportView;

/***/ }),
/* 372 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


module.exports = Marionette.ItemView.extend({
  template: '#tmpl-elementor-template-library-connect',
  id: 'elementor-template-library-connect',
  ui: {
    connect: '#elementor-template-library-connect__button',
    thumbnails: '#elementor-template-library-connect-thumbnails'
  },
  templateHelpers: function templateHelpers() {
    return this.getOption('texts');
  },
  onRender: function onRender() {
    var _this = this;

    this.ui.connect.elementorConnect({
      success: function success() {
        elementor.config.library_connect.is_connected = true; // If is connecting during insert template.

        if (_this.getOption('model')) {
          $e.run('library/insert-template', {
            model: _this.getOption('model')
          });
        } else {
          $e.run('library/close');
          elementor.notifications.showToast({
            message: elementor.translate('connected_successfully')
          });
        }
      },
      error: function error() {
        elementor.config.library_connect.is_connected = false;
      }
    });
  }
});

/***/ }),
/* 373 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var TemplateLibraryPreviewView;
TemplateLibraryPreviewView = Marionette.ItemView.extend({
  template: '#tmpl-elementor-template-library-preview',
  id: 'elementor-template-library-preview',
  ui: {
    iframe: '> iframe'
  },
  onRender: function onRender() {
    this.ui.iframe.attr('src', this.getOption('url'));
  }
});
module.exports = TemplateLibraryPreviewView;

/***/ }),
/* 374 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var TemplateLibraryTemplateModel = __webpack_require__(375),
    TemplateLibraryCollection;

TemplateLibraryCollection = Backbone.Collection.extend({
  model: TemplateLibraryTemplateModel
});
module.exports = TemplateLibraryCollection;

/***/ }),
/* 375 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


module.exports = Backbone.Model.extend({
  defaults: {
    template_id: 0,
    title: '',
    source: '',
    type: '',
    subtype: '',
    author: '',
    thumbnail: '',
    url: '',
    export_link: '',
    tags: []
  }
});

/***/ }),
/* 376 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


__webpack_require__(30);

__webpack_require__(85);

var Conditions;

Conditions = function Conditions() {
  var self = this;

  this.compare = function (leftValue, rightValue, operator) {
    switch (operator) {
      /* eslint-disable eqeqeq */
      case '==':
        return leftValue == rightValue;

      case '!=':
        return leftValue != rightValue;

      /* eslint-enable eqeqeq */

      case '!==':
        return leftValue !== rightValue;

      case 'in':
        return -1 !== rightValue.indexOf(leftValue);

      case '!in':
        return -1 === rightValue.indexOf(leftValue);

      case 'contains':
        return -1 !== leftValue.indexOf(rightValue);

      case '!contains':
        return -1 === leftValue.indexOf(rightValue);

      case '<':
        return leftValue < rightValue;

      case '<=':
        return leftValue <= rightValue;

      case '>':
        return leftValue > rightValue;

      case '>=':
        return leftValue >= rightValue;

      default:
        return leftValue === rightValue;
    }
  };

  this.check = function (conditions, comparisonObject) {
    var isOrCondition = 'or' === conditions.relation,
        conditionSucceed = !isOrCondition;
    jQuery.each(conditions.terms, function () {
      var term = this,
          comparisonResult;

      if (term.terms) {
        comparisonResult = self.check(term, comparisonObject);
      } else {
        var parsedName = term.name.match(/(\w+)(?:\[(\w+)])?/),
            value = comparisonObject[parsedName[1]];

        if (parsedName[2]) {
          value = value[parsedName[2]];
        }

        comparisonResult = self.compare(value, term.value, term.operator);
      }

      if (isOrCondition) {
        if (comparisonResult) {
          conditionSucceed = true;
        }

        return !comparisonResult;
      }

      if (!comparisonResult) {
        return conditionSucceed = false;
      }
    });
    return conditionSucceed;
  };
};

module.exports = new Conditions();

/***/ }),
/* 377 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var _interopRequireDefault = __webpack_require__(0);

var _component = _interopRequireDefault(__webpack_require__(378));

var HistoryPageView = __webpack_require__(379),
    Manager;

Manager = function Manager() {
  var self = this;

  var addPanelPage = function addPanelPage() {
    elementor.getPanelView().addPage('historyPage', {
      view: HistoryPageView,
      title: elementor.translate('history')
    });
  };

  var init = function init() {
    elementor.on('preview:loaded', addPanelPage);
    $e.components.register(new _component.default({
      manager: self
    }));
    self.history = __webpack_require__(387);
    self.revisions = __webpack_require__(390);
    self.revisions.init();
  };

  jQuery(window).on('elementor:init', init);
};

module.exports = new Manager();

/***/ }),
/* 378 */
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

var _possibleConstructorReturn2 = _interopRequireDefault(__webpack_require__(5));

var _getPrototypeOf2 = _interopRequireDefault(__webpack_require__(4));

var _inherits2 = _interopRequireDefault(__webpack_require__(6));

var _component = _interopRequireDefault(__webpack_require__(64));

var Component =
/*#__PURE__*/
function (_BaseComponent) {
  (0, _inherits2.default)(Component, _BaseComponent);

  function Component() {
    (0, _classCallCheck2.default)(this, Component);
    return (0, _possibleConstructorReturn2.default)(this, (0, _getPrototypeOf2.default)(Component).apply(this, arguments));
  }

  (0, _createClass2.default)(Component, [{
    key: "getNamespace",
    value: function getNamespace() {
      return 'panel/history';
    }
  }, {
    key: "defaultTabs",
    value: function defaultTabs() {
      return {
        actions: {
          title: elementor.translate('actions')
        },
        revisions: {
          title: elementor.translate('revisions')
        }
      };
    }
  }, {
    key: "defaultShortcuts",
    value: function defaultShortcuts() {
      return {
        actions: {
          keys: 'ctrl+shift+h'
        }
      };
    }
  }, {
    key: "renderTab",
    value: function renderTab(tab) {
      elementor.getPanelView().setPage('historyPage').showView(tab);
    }
  }, {
    key: "activate",
    value: function activate() {
      // Activate the tab component itself.
      $e.components.activate(this.getTabRoute(this.currentTab));
    }
  }, {
    key: "getTabsWrapperSelector",
    value: function getTabsWrapperSelector() {
      return '#elementor-panel-elements-navigation';
    }
  }]);
  return Component;
}(_component.default);

exports.default = Component;

/***/ }),
/* 379 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var _interopRequireDefault = __webpack_require__(0);

var _loading = _interopRequireDefault(__webpack_require__(380));

var _panelTab = _interopRequireDefault(__webpack_require__(381));

var _empty = _interopRequireDefault(__webpack_require__(383));

var TabHistoryView = __webpack_require__(384);

module.exports = Marionette.LayoutView.extend({
  template: '#tmpl-elementor-panel-history-page',
  regions: {
    content: '#elementor-panel-history-content'
  },
  ui: {
    tabs: '.elementor-panel-navigation-tab'
  },
  regionViews: {},
  currentTab: null,
  initialize: function initialize() {
    this.initRegionViews();
  },
  initRegionViews: function initRegionViews() {
    var historyItems = elementor.history.history.getItems();
    this.regionViews = {
      actions: {
        view: function view() {
          return TabHistoryView;
        },
        options: {
          collection: historyItems
        }
      },
      revisions: {
        view: function view() {
          var revisionsItems = elementor.history.revisions.getItems();

          if (!revisionsItems) {
            return _loading.default;
          }

          if (1 === revisionsItems.length && 'current' === revisionsItems.models[0].get('type')) {
            return _empty.default;
          }

          return _panelTab.default;
        }
      }
    };
  },
  getCurrentTab: function getCurrentTab() {
    return this.currentTab;
  },
  showView: function showView(viewName) {
    var viewDetails = this.regionViews[viewName],
        options = viewDetails.options || {},
        View = viewDetails.view();

    if (this.currentTab && this.currentTab.constructor === View) {
      return;
    }

    this.currentTab = new View(options);
    this.content.show(this.currentTab);
  }
});

/***/ }),
/* 380 */
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

var _possibleConstructorReturn2 = _interopRequireDefault(__webpack_require__(5));

var _getPrototypeOf2 = _interopRequireDefault(__webpack_require__(4));

var _inherits2 = _interopRequireDefault(__webpack_require__(6));

var _default =
/*#__PURE__*/
function (_Marionette$ItemView) {
  (0, _inherits2.default)(_default, _Marionette$ItemView);

  function _default() {
    (0, _classCallCheck2.default)(this, _default);
    return (0, _possibleConstructorReturn2.default)(this, (0, _getPrototypeOf2.default)(_default).apply(this, arguments));
  }

  (0, _createClass2.default)(_default, [{
    key: "getTemplate",
    value: function getTemplate() {
      return '#tmpl-elementor-panel-revisions-loading';
    }
  }, {
    key: "id",
    value: function id() {
      return 'elementor-panel-revisions-loading';
    }
  }, {
    key: "onRender",
    value: function onRender() {
      elementor.history.revisions.requestRevisions(function () {
        setTimeout(function () {
          return $e.routes.refreshContainer('panel');
        });
      });
    }
  }]);
  return _default;
}(Marionette.ItemView);

exports.default = _default;

/***/ }),
/* 381 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


module.exports = Marionette.CompositeView.extend({
  id: 'elementor-panel-revisions',
  template: '#tmpl-elementor-panel-revisions',
  childView: __webpack_require__(382),
  childViewContainer: '#elementor-revisions-list',
  ui: {
    discard: '.elementor-panel-scheme-discard .elementor-button',
    apply: '.elementor-panel-scheme-save .elementor-button'
  },
  events: {
    'click @ui.discard': 'onDiscardClick',
    'click @ui.apply': 'onApplyClick'
  },
  isRevisionApplied: false,
  currentPreviewId: null,
  currentPreviewItem: null,
  initialize: function initialize() {
    this.collection = elementor.history.revisions.getItems();
    this.listenTo(elementor.channels.editor, 'saved', this.onEditorSaved);
    this.currentPreviewId = elementor.config.current_revision_id;
  },
  getRevisionViewData: function getRevisionViewData(revisionView) {
    var self = this;
    elementor.history.revisions.getRevisionDataAsync(revisionView.model.get('id'), {
      success: function success(data) {
        elementor.history.revisions.setEditorData(data.elements);
        elementor.settings.page.model.set(data.settings);
        self.setRevisionsButtonsActive(true);
        revisionView.$el.removeClass('elementor-revision-item-loading');
        self.enterReviewMode();
      },
      error: function error(errorMessage) {
        revisionView.$el.removeClass('elementor-revision-item-loading');
        self.currentPreviewItem = null;
        self.currentPreviewId = null;
        alert(errorMessage);
      }
    });
  },
  setRevisionsButtonsActive: function setRevisionsButtonsActive(active) {
    this.ui.apply.add(this.ui.discard).prop('disabled', !active);
  },
  enterReviewMode: function enterReviewMode() {
    elementor.changeEditMode('review');
  },
  exitReviewMode: function exitReviewMode() {
    elementor.changeEditMode('edit');
  },
  navigate: function navigate(reverse) {
    if (!this.currentPreviewId || !this.currentPreviewItem || this.children.length <= 1) {
      return;
    }

    var currentPreviewItemIndex = this.collection.indexOf(this.currentPreviewItem.model),
        requiredIndex = reverse ? currentPreviewItemIndex - 1 : currentPreviewItemIndex + 1;

    if (requiredIndex < 0) {
      requiredIndex = this.collection.length - 1;
    }

    if (requiredIndex >= this.collection.length) {
      requiredIndex = 0;
    }

    this.children.findByIndex(requiredIndex).ui.detailsArea.trigger('click');
  },
  onEditorSaved: function onEditorSaved() {
    this.exitReviewMode();
    this.setRevisionsButtonsActive(false);
    this.currentPreviewId = elementor.config.current_revision_id;
  },
  onApplyClick: function onApplyClick() {
    elementor.saver.setFlagEditorChange(true);
    elementor.saver.saveAutoSave();
    this.isRevisionApplied = true;
    this.currentPreviewId = null;
    elementor.history.history.getItems().reset();
  },
  onDiscardClick: function onDiscardClick() {
    elementor.history.revisions.setEditorData(elementor.config.data);
    elementor.saver.setFlagEditorChange(this.isRevisionApplied);
    this.isRevisionApplied = false;
    this.setRevisionsButtonsActive(false);
    this.currentPreviewId = null;
    this.exitReviewMode();

    if (this.currentPreviewItem) {
      this.currentPreviewItem.$el.removeClass('elementor-revision-current-preview');
    }
  },
  onDestroy: function onDestroy() {
    if (this.currentPreviewId && this.currentPreviewId !== elementor.config.current_revision_id) {
      this.onDiscardClick();
    }
  },
  onRenderCollection: function onRenderCollection() {
    if (!this.currentPreviewId) {
      return;
    }

    var currentPreviewModel = this.collection.findWhere({
      id: this.currentPreviewId
    }); // Ensure the model is exist and not deleted during a save.

    if (currentPreviewModel) {
      this.currentPreviewItem = this.children.findByModelCid(currentPreviewModel.cid);
      this.currentPreviewItem.$el.addClass('elementor-revision-current-preview');
    }
  },
  onChildviewDetailsAreaClick: function onChildviewDetailsAreaClick(childView) {
    var self = this,
        revisionID = childView.model.get('id');

    if (revisionID === self.currentPreviewId) {
      return;
    }

    if (self.currentPreviewItem) {
      self.currentPreviewItem.$el.removeClass('elementor-revision-current-preview elementor-revision-item-loading');
    }

    childView.$el.addClass('elementor-revision-current-preview elementor-revision-item-loading');

    if (elementor.saver.isEditorChanged() && (null === self.currentPreviewId || elementor.config.current_revision_id === self.currentPreviewId)) {
      elementor.saver.saveEditor({
        status: 'autosave',
        onSuccess: function onSuccess() {
          self.getRevisionViewData(childView);
        }
      });
    } else {
      self.getRevisionViewData(childView);
    }

    self.currentPreviewItem = childView;
    self.currentPreviewId = revisionID;
  }
});

/***/ }),
/* 382 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


module.exports = Marionette.ItemView.extend({
  template: '#tmpl-elementor-panel-revisions-revision-item',
  className: 'elementor-revision-item',
  ui: {
    detailsArea: '.elementor-revision-item__details'
  },
  triggers: {
    'click @ui.detailsArea': 'detailsArea:click'
  }
});

/***/ }),
/* 383 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


module.exports = Marionette.ItemView.extend({
  template: '#tmpl-elementor-panel-revisions-no-revisions',
  id: 'elementor-panel-revisions-no-revisions',
  className: 'elementor-nerd-box'
});

/***/ }),
/* 384 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var _interopRequireDefault = __webpack_require__(0);

__webpack_require__(244);

__webpack_require__(15);

var _itemView = _interopRequireDefault(__webpack_require__(385));

var _empty = _interopRequireDefault(__webpack_require__(386));

module.exports = Marionette.CompositeView.extend({
  id: 'elementor-panel-history',
  template: '#tmpl-elementor-panel-history-tab',
  childView: _itemView.default,
  childViewContainer: '#elementor-history-list',
  emptyView: _empty.default,
  currentItem: null,
  updateCurrentItem: function updateCurrentItem() {
    var _this = this;

    if (this.children.length <= 1) {
      return;
    }

    _.defer(function () {
      // Set current item - the first not applied item
      var currentItem = _this.collection.find(function (model) {
        return 'not_applied' === model.get('status');
      }),
          currentView = _this.children.findByModel(currentItem);

      if (!currentView) {
        return;
      }

      var currentItemClass = 'elementor-history-item-current';

      if (_this.currentItem) {
        _this.currentItem.removeClass(currentItemClass);
      }

      _this.currentItem = currentView.$el;

      _this.currentItem.addClass(currentItemClass);
    });
  },
  onRender: function onRender() {
    this.updateCurrentItem();
  },
  onRenderEmpty: function onRenderEmpty() {
    this.$el.addClass('elementor-empty');
  },
  onChildviewClick: function onChildviewClick(childView, event) {
    if (childView.$el === this.currentItem) {
      return;
    }

    var collection = event.model.collection,
        itemIndex = collection.findIndex(event.model);
    elementor.history.history.doItem(itemIndex);
  }
});

/***/ }),
/* 385 */
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

var _possibleConstructorReturn2 = _interopRequireDefault(__webpack_require__(5));

var _getPrototypeOf2 = _interopRequireDefault(__webpack_require__(4));

var _inherits2 = _interopRequireDefault(__webpack_require__(6));

var _default =
/*#__PURE__*/
function (_Marionette$ItemView) {
  (0, _inherits2.default)(_default, _Marionette$ItemView);

  function _default() {
    (0, _classCallCheck2.default)(this, _default);
    return (0, _possibleConstructorReturn2.default)(this, (0, _getPrototypeOf2.default)(_default).apply(this, arguments));
  }

  (0, _createClass2.default)(_default, [{
    key: "getTemplate",
    value: function getTemplate() {
      return '#tmpl-elementor-panel-history-item';
    }
  }, {
    key: "className",
    value: function className() {
      return 'elementor-history-item elementor-history-item-' + this.model.get('status');
    }
  }, {
    key: "triggers",
    value: function triggers() {
      return {
        click: 'click'
      };
    }
  }]);
  return _default;
}(Marionette.ItemView);

exports.default = _default;

/***/ }),
/* 386 */
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

var _possibleConstructorReturn2 = _interopRequireDefault(__webpack_require__(5));

var _getPrototypeOf2 = _interopRequireDefault(__webpack_require__(4));

var _inherits2 = _interopRequireDefault(__webpack_require__(6));

var _default =
/*#__PURE__*/
function (_Marionette$ItemView) {
  (0, _inherits2.default)(_default, _Marionette$ItemView);

  function _default() {
    (0, _classCallCheck2.default)(this, _default);
    return (0, _possibleConstructorReturn2.default)(this, (0, _getPrototypeOf2.default)(_default).apply(this, arguments));
  }

  (0, _createClass2.default)(_default, [{
    key: "getTemplate",
    value: function getTemplate() {
      return '#tmpl-elementor-panel-history-no-items';
    }
  }, {
    key: "id",
    value: function id() {
      return 'elementor-panel-history-no-items';
    }
  }, {
    key: "onDestroy",
    value: function onDestroy() {
      this._parent.$el.removeClass('elementor-empty');
    }
  }]);
  return _default;
}(Marionette.ItemView);

exports.default = _default;

/***/ }),
/* 387 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var _interopRequireDefault = __webpack_require__(0);

var _isArray = _interopRequireDefault(__webpack_require__(119));

__webpack_require__(15);

var _itemModel = _interopRequireDefault(__webpack_require__(388));

var _component = _interopRequireDefault(__webpack_require__(389));

var Manager = function Manager() {
  var self = this,
      currentItemID = null,
      items = new Backbone.Collection([], {
    model: _itemModel.default
  }),
      editorSaved = false,
      active = true;
  var translations = {
    // Alphabetical order.
    add: elementor.translate('added'),
    change: elementor.translate('edited'),
    disable: elementor.translate('disabled'),
    duplicate: elementor.translate('duplicate'),
    enable: elementor.translate('enabled'),
    move: elementor.translate('moved'),
    paste: elementor.translate('pasted'),
    paste_style: elementor.translate('style_pasted'),
    remove: elementor.translate('removed'),
    reset_style: elementor.translate('style_reset')
  };

  var getActionLabel = function getActionLabel(itemData) {
    if (translations[itemData.type]) {
      return translations[itemData.type];
    }

    return itemData.type;
  };

  this.navigate = function (isRedo) {
    var currentItem = items.find(function (model) {
      return 'not_applied' === model.get('status');
    }),
        currentItemIndex = items.indexOf(currentItem),
        requiredIndex = isRedo ? currentItemIndex - 1 : currentItemIndex + 1;

    if (!isRedo && !currentItem || requiredIndex < 0 || requiredIndex >= items.length) {
      return;
    }

    self.doItem(requiredIndex);
  };

  var updatePanelPageCurrentItem = function updatePanelPageCurrentItem() {
    if ($e.routes.is('panel/history/actions')) {
      elementor.getPanelView().getCurrentPageView().getCurrentTab().updateCurrentItem();
    }
  };

  var onPanelSave = function onPanelSave() {
    if (items.length >= 2) {
      // Check if it's a save after made changes, `items.length - 1` is the `Editing Started Item
      var firstEditItem = items.at(items.length - 2);
      editorSaved = 'not_applied' === firstEditItem.get('status');
    }
  };

  var init = function init() {
    $e.components.register(new _component.default({
      manager: self
    }));
    elementor.channels.editor.on('saved', onPanelSave);
  };

  this.setActive = function (value) {
    active = value;
  };

  this.getActive = function () {
    return active;
  };

  this.getItems = function () {
    return items;
  };

  this.startItem = function (itemData) {
    currentItemID = this.addItem(itemData);
    return currentItemID;
  };

  this.endItem = function (id) {
    if (id && currentItemID !== id) {
      return;
    }

    currentItemID = null;
  };

  this.deleteItem = function (id) {
    var item = items.findWhere({
      id: id
    });
    items.remove(item);
    currentItemID = null;
  };

  this.isItemStarted = function () {
    return null !== currentItemID;
  };

  this.getCurrentId = function () {
    return currentItemID;
  };

  this.addItem = function (itemData) {
    if (!this.getActive()) {
      return;
    }

    if (!items.length) {
      items.add({
        status: 'not_applied',
        title: elementor.translate('editing_started'),
        subTitle: '',
        action: '',
        editing_started: true
      });
    } // Remove old applied items from top of list


    while (items.length && 'applied' === items.first().get('status')) {
      items.shift();
    }

    var id = currentItemID ? currentItemID : new Date().getTime();
    var currentItem = items.findWhere({
      id: id
    });

    if (!currentItem) {
      currentItem = new _itemModel.default({
        id: id,
        title: itemData.title,
        subTitle: itemData.subTitle,
        action: getActionLabel(itemData),
        type: itemData.type
      });
      self.startItemTitle = '';
      self.startItemAction = '';
    }

    currentItem.get('items').add(itemData, {
      at: 0
    });
    items.add(currentItem, {
      at: 0
    });
    updatePanelPageCurrentItem();
    return id;
  };

  this.doItem = function (index) {
    // Don't track while restoring the item
    this.setActive(false);
    var item = items.at(index);

    if ('not_applied' === item.get('status')) {
      this.undoItem(index);
    } else {
      this.redoItem(index);
    }

    this.setActive(true);
    var panel = elementor.getPanelView(),
        panelPage = panel.getCurrentPageView(),
        editedElementView = panelPage.getOption('editedElementView'),
        viewToScroll;

    if ($e.routes.isPartOf('panel/editor') && editedElementView) {
      if (editedElementView.isDestroyed) {
        // If the the element isn't exist - show the history panel
        $e.route('panel/history/actions');
      } else {
        // If element exist - render again, maybe the settings has been changed
        viewToScroll = editedElementView;
      }
    } else if (item instanceof Backbone.Model && item.get('items').length) {
      var historyItem = item.get('items').first();

      if (historyItem.get('restore')) {
        var container = 'sub-add' === historyItem.get('type') ? historyItem.get('data').containerToRestore : historyItem.get('container') || historyItem.get('containers');

        if ((0, _isArray.default)(container)) {
          container = container[0];
        }

        if (container) {
          viewToScroll = container.lookup().view;
        }
      }
    }

    updatePanelPageCurrentItem();

    if (viewToScroll && !elementor.helpers.isInViewport(viewToScroll.$el[0], elementor.$previewContents.find('html')[0])) {
      elementor.helpers.scrollToView(viewToScroll.$el);
    }

    if (item.get('editing_started')) {
      if (!editorSaved) {
        elementor.saver.setFlagEditorChange(false);
      }
    }
  };

  this.undoItem = function (index) {
    var item;

    for (var stepNum = 0; stepNum < index; stepNum++) {
      item = items.at(stepNum);

      if ('not_applied' === item.get('status')) {
        item.get('items').each(function (subItem) {
          var restore = subItem.get('restore');

          if (restore) {
            restore(subItem);
          }
        });
        item.set('status', 'applied');
      }
    }
  };

  this.redoItem = function (index) {
    for (var stepNum = items.length - 1; stepNum >= index; stepNum--) {
      var item = items.at(stepNum);

      if ('applied' === item.get('status')) {
        var reversedSubItems = _.toArray(item.get('items').models).reverse();

        _(reversedSubItems).each(function (subItem) {
          var restore = subItem.get('restore');

          if (restore) {
            restore(subItem, true);
          }
        });

        item.set('status', 'not_applied');
      }
    }
  };

  init();
};

module.exports = new Manager();

/***/ }),
/* 388 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


module.exports = Backbone.Model.extend({
  defaults: {
    id: 0,
    type: '',
    status: 'not_applied',
    title: '',
    subTitle: '',
    action: '',
    history: {}
  },
  initialize: function initialize() {
    this.set('items', new Backbone.Collection());
  }
});

/***/ }),
/* 389 */
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

var _possibleConstructorReturn2 = _interopRequireDefault(__webpack_require__(5));

var _getPrototypeOf2 = _interopRequireDefault(__webpack_require__(4));

var _inherits2 = _interopRequireDefault(__webpack_require__(6));

var _component = _interopRequireDefault(__webpack_require__(64));

var Component =
/*#__PURE__*/
function (_BaseComponent) {
  (0, _inherits2.default)(Component, _BaseComponent);

  function Component() {
    (0, _classCallCheck2.default)(this, Component);
    return (0, _possibleConstructorReturn2.default)(this, (0, _getPrototypeOf2.default)(Component).apply(this, arguments));
  }

  (0, _createClass2.default)(Component, [{
    key: "getNamespace",
    value: function getNamespace() {
      return 'panel/history/actions';
    }
  }, {
    key: "defaultCommands",
    value: function defaultCommands() {
      return {
        undo: function undo() {
          return $e.run('document/history/undo');
        },
        redo: function redo() {
          return $e.run('document/history/redo');
        }
      };
    }
  }, {
    key: "defaultShortcuts",
    value: function defaultShortcuts() {
      return {
        undo: {
          keys: 'ctrl+z',
          exclude: ['input'],
          scopes: ['panel', 'navigator']
        },
        redo: {
          keys: 'ctrl+shift+z, ctrl+y',
          exclude: ['input'],
          scopes: ['panel', 'navigator']
        }
      };
    }
  }]);
  return Component;
}(_component.default);

exports.default = Component;

/***/ }),
/* 390 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var _interopRequireDefault = __webpack_require__(0);

var _component = _interopRequireDefault(__webpack_require__(391));

var RevisionsCollection = __webpack_require__(392),
    RevisionsManager;

RevisionsManager = function RevisionsManager() {
  var self = this;
  var revisions;

  var onEditorSaved = function onEditorSaved(data) {
    if (data.latest_revisions) {
      self.addRevisions(data.latest_revisions);
    }

    self.requestRevisions(function () {
      if (data.revisions_ids) {
        var revisionsToKeep = revisions.filter(function (revision) {
          return -1 !== data.revisions_ids.indexOf(revision.get('id'));
        });
        revisions.reset(revisionsToKeep);
      }
    });
  };

  var attachEvents = function attachEvents() {
    elementor.channels.editor.on('saved', onEditorSaved);
  };

  this.getItems = function () {
    return revisions;
  };

  this.requestRevisions = function (callback) {
    if (revisions) {
      callback(revisions);
      return;
    }

    elementorCommon.ajax.addRequest('get_revisions', {
      success: function success(data) {
        revisions = new RevisionsCollection(data);
        callback(revisions);
      }
    });
  };

  this.setEditorData = function (data) {
    var collection = elementor.getRegion('sections').currentView.collection; // Don't track in history.

    elementor.history.history.setActive(false);
    collection.reset(data);
    elementor.history.history.setActive(true);
  };

  this.getRevisionDataAsync = function (id, options) {
    _.extend(options, {
      data: {
        id: id
      }
    });

    return elementorCommon.ajax.addRequest('get_revision_data', options);
  };

  this.addRevisions = function (items) {
    this.requestRevisions(function () {
      items.forEach(function (item) {
        var existedModel = revisions.findWhere({
          id: item.id
        });

        if (existedModel) {
          revisions.remove(existedModel, {
            silent: true
          });
        }

        revisions.add(item, {
          silent: true
        });
      });
      revisions.trigger('update');
    });
  };

  this.init = function () {
    attachEvents();
    $e.components.register(new _component.default({
      manager: self
    }));
  };
};

module.exports = new RevisionsManager();

/***/ }),
/* 391 */
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

var _possibleConstructorReturn2 = _interopRequireDefault(__webpack_require__(5));

var _getPrototypeOf2 = _interopRequireDefault(__webpack_require__(4));

var _inherits2 = _interopRequireDefault(__webpack_require__(6));

var _component = _interopRequireDefault(__webpack_require__(64));

var Component =
/*#__PURE__*/
function (_BaseComponent) {
  (0, _inherits2.default)(Component, _BaseComponent);

  function Component() {
    (0, _classCallCheck2.default)(this, Component);
    return (0, _possibleConstructorReturn2.default)(this, (0, _getPrototypeOf2.default)(Component).apply(this, arguments));
  }

  (0, _createClass2.default)(Component, [{
    key: "getNamespace",
    value: function getNamespace() {
      return 'panel/history/revisions';
    }
  }, {
    key: "defaultCommands",
    value: function defaultCommands() {
      var _this = this;

      return {
        up: function up() {
          return _this.navigate(true);
        },
        down: function down() {
          return _this.navigate();
        }
      };
    }
  }, {
    key: "defaultShortcuts",
    value: function defaultShortcuts() {
      return {
        up: {
          keys: 'up',
          scopes: [this.getNamespace()]
        },
        down: {
          keys: 'down',
          scopes: [this.getNamespace()]
        }
      };
    }
  }, {
    key: "navigate",
    value: function navigate(up) {
      if (this.manager.getItems().length > 1) {
        elementor.getPanelView().getCurrentPageView().currentTab.navigate(up);
      }
    }
  }]);
  return Component;
}(_component.default);

exports.default = Component;

/***/ }),
/* 392 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var RevisionModel = __webpack_require__(393);

module.exports = Backbone.Collection.extend({
  model: RevisionModel,
  comparator: function comparator(model) {
    return -model.get('timestamp');
  }
});

/***/ }),
/* 393 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var RevisionModel;
RevisionModel = Backbone.Model.extend();

RevisionModel.prototype.sync = function () {
  return null;
};

module.exports = RevisionModel;

/***/ }),
/* 394 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


__webpack_require__(15);

module.exports = Marionette.Behavior.extend({
  previewWindow: null,
  ui: function ui() {
    return {
      buttonPreview: '#elementor-panel-footer-saver-preview',
      buttonPublish: '#elementor-panel-saver-button-publish',
      buttonSaveOptions: '#elementor-panel-saver-button-save-options',
      buttonPublishLabel: '#elementor-panel-saver-button-publish-label',
      menuSaveDraft: '#elementor-panel-footer-sub-menu-item-save-draft',
      lastEditedWrapper: '.elementor-last-edited-wrapper'
    };
  },
  events: function events() {
    return {
      'click @ui.buttonPreview': 'onClickButtonPreview',
      'click @ui.buttonPublish': 'onClickButtonPublish',
      'click @ui.menuSaveDraft': 'onClickMenuSaveDraft'
    };
  },
  initialize: function initialize() {
    elementor.saver.on('before:save', this.onBeforeSave.bind(this)).on('after:save', this.onAfterSave.bind(this)).on('after:saveError', this.onAfterSaveError.bind(this)).on('page:status:change', this.onPageStatusChange);
    elementor.settings.page.model.on('change', this.onPageSettingsChange.bind(this));
    elementor.channels.editor.on('status:change', this.activateSaveButtons.bind(this));
  },
  activateSaveButtons: function activateSaveButtons(hasChanges) {
    hasChanges = hasChanges || 'draft' === elementor.settings.page.model.get('post_status');
    this.ui.buttonPublish.add(this.ui.menuSaveDraft).toggleClass('elementor-disabled', !hasChanges);
    this.ui.buttonSaveOptions.toggleClass('elementor-disabled', !hasChanges);
  },
  onRender: function onRender() {
    this.setMenuItems(elementor.settings.page.model.get('post_status'));
    this.addTooltip();
  },
  onPageSettingsChange: function onPageSettingsChange(settings) {
    var changed = settings.changed;

    if (!_.isUndefined(changed.post_status)) {
      this.setMenuItems(changed.post_status);
      this.refreshWpPreview(); // Refresh page-settings post-status value.

      if ($e.routes.isPartOf('panel/page-settings')) {
        $e.routes.refreshContainer('panel');
      }
    }
  },
  onPageStatusChange: function onPageStatusChange(newStatus) {
    if ('publish' === newStatus) {
      elementor.notifications.showToast({
        message: elementor.config.document.panel.messages.publish_notification,
        buttons: [{
          name: 'view_page',
          text: elementor.translate('have_a_look'),
          callback: function callback() {
            open(elementor.config.document.urls.permalink);
          }
        }]
      });
    }
  },
  onBeforeSave: function onBeforeSave(options) {
    NProgress.start();

    if ('autosave' === options.status) {
      this.ui.lastEditedWrapper.addClass('elementor-state-active');
    } else {
      this.ui.buttonPublish.addClass('elementor-button-state');
    }
  },
  onAfterSave: function onAfterSave(data) {
    NProgress.done();
    this.ui.buttonPublish.removeClass('elementor-button-state');
    this.ui.lastEditedWrapper.removeClass('elementor-state-active');
    this.refreshWpPreview();
    this.setLastEdited(data);
  },
  setLastEdited: function setLastEdited(data) {
    this.ui.lastEditedWrapper.removeClass('elementor-button-state').find('.elementor-last-edited').html(data.config.document.last_edited);
  },
  onAfterSaveError: function onAfterSaveError() {
    NProgress.done();
    this.ui.buttonPublish.removeClass('elementor-button-state');
  },
  onClickButtonPreview: function onClickButtonPreview() {
    // Open immediately in order to avoid popup blockers.
    this.previewWindow = open(elementor.config.document.urls.wp_preview, 'wp-preview-' + elementor.config.document.id);

    if (elementor.saver.isEditorChanged()) {
      // Force save even if it's saving now.
      if (elementor.saver.isSaving) {
        elementor.saver.isSaving = false;
      }

      elementor.saver.doAutoSave();
    }
  },
  onClickButtonPublish: function onClickButtonPublish() {
    if (this.ui.buttonPublish.hasClass('elementor-disabled')) {
      return;
    }

    elementor.saver.defaultSave();
  },
  onClickMenuSaveDraft: function onClickMenuSaveDraft() {
    elementor.saver.saveDraft();
  },
  setMenuItems: function setMenuItems(postStatus) {
    var publishLabel = 'publish';

    switch (postStatus) {
      case 'publish':
      case 'private':
        publishLabel = 'update';

        if (elementor.config.current_revision_id !== elementor.config.document.id) {
          this.activateSaveButtons(true);
        }

        break;

      case 'draft':
        if (!elementor.config.current_user_can_publish) {
          publishLabel = 'submit';
        }

        this.activateSaveButtons(true);
        break;

      case 'pending': // User cannot change post status

      case undefined:
        // TODO: as a contributor it's undefined instead of 'pending'.
        if (!elementor.config.current_user_can_publish) {
          publishLabel = 'update';
        }

        break;
    }

    this.ui.buttonPublishLabel.html(elementor.translate(publishLabel));
  },
  addTooltip: function addTooltip() {
    // Create tooltip on controls
    this.$el.find('.tooltip-target').tipsy({
      // `n` for down, `s` for up
      gravity: 's',
      title: function title() {
        return this.getAttribute('data-tooltip');
      }
    });
  },
  refreshWpPreview: function refreshWpPreview() {
    if (this.previewWindow) {
      // Refresh URL form updated config.
      try {
        this.previewWindow.location.href = elementor.config.document.urls.wp_preview;
      } catch (e) {// If the this.previewWindow is closed or it's domain was changed.
        // Do nothing.
      }
    }
  }
});

/***/ }),
/* 395 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var ControlBaseView = __webpack_require__(191);

module.exports = ControlBaseView.extend({
  ui: function ui() {
    var ui = ControlBaseView.prototype.ui.apply(this, arguments);
    ui.button = 'button';
    return ui;
  },
  events: {
    'click @ui.button': 'onButtonClick'
  },
  onButtonClick: function onButtonClick() {
    var eventName = this.model.get('event');
    elementor.channels.editor.trigger(eventName, this);
  }
});

/***/ }),
/* 396 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


__webpack_require__(85);

var ControlBaseDataView = __webpack_require__(65),
    ControlCodeEditorItemView;

ControlCodeEditorItemView = ControlBaseDataView.extend({
  ui: function ui() {
    var ui = ControlBaseDataView.prototype.ui.apply(this, arguments);
    ui.editor = '.elementor-code-editor';
    return ui;
  },
  onReady: function onReady() {
    var self = this;

    if ('undefined' === typeof ace) {
      return;
    }

    var langTools = ace.require('ace/ext/language_tools'),
        uiTheme = elementor.settings.editorPreferences.model.get('ui_theme'),
        userPrefersDark = matchMedia('(prefers-color-scheme: dark)').matches;

    self.editor = ace.edit(this.ui.editor[0]);
    jQuery(self.editor.container).addClass('elementor-input-style elementor-code-editor');
    self.editor.setOptions({
      mode: 'ace/mode/' + self.model.attributes.language,
      minLines: 10,
      maxLines: Infinity,
      showGutter: true,
      useWorker: true,
      enableBasicAutocompletion: true,
      enableLiveAutocompletion: true
    });

    if ('dark' === uiTheme || 'auto' === uiTheme && userPrefersDark) {
      self.editor.setTheme('ace/theme/merbivore_soft');
    }

    self.editor.getSession().setUseWrapMode(true);
    elementor.panel.$el.on('resize.aceEditor', self.onResize.bind(this));

    if ('css' === self.model.attributes.language) {
      var selectorCompleter = {
        getCompletions: function getCompletions(editor, session, pos, prefix, callback) {
          var list = [],
              token = session.getTokenAt(pos.row, pos.column);

          if (0 < prefix.length && 'selector'.match(prefix) && 'constant' === token.type) {
            list = [{
              name: 'selector',
              value: 'selector',
              score: 1,
              meta: 'Elementor'
            }];
          }

          callback(null, list);
        }
      };
      langTools.addCompleter(selectorCompleter);
    }

    self.editor.setValue(self.getControlValue(), -1); // -1 =  move cursor to the start

    self.editor.on('change', function () {
      self.setValue(self.editor.getValue());
    });

    if ('html' === self.model.attributes.language) {
      // Remove the `doctype` annotation
      var session = self.editor.getSession();
      session.on('changeAnnotation', function () {
        var annotations = session.getAnnotations() || [],
            annotationsLength = annotations.length,
            index = annotations.length;

        while (index--) {
          if (/doctype first\. Expected/.test(annotations[index].text)) {
            annotations.splice(index, 1);
          }
        }

        if (annotationsLength > annotations.length) {
          session.setAnnotations(annotations);
        }
      });
    }
  },
  onResize: function onResize() {
    this.editor.resize();
  },
  onDestroy: function onDestroy() {
    elementor.panel.$el.off('resize.aceEditor');
  }
});
module.exports = ControlCodeEditorItemView;

/***/ }),
/* 397 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


__webpack_require__(398);

var ControlBaseUnitsItemView = __webpack_require__(263),
    ControlDimensionsItemView;

ControlDimensionsItemView = ControlBaseUnitsItemView.extend({
  ui: function ui() {
    var ui = ControlBaseUnitsItemView.prototype.ui.apply(this, arguments);
    ui.controls = '.elementor-control-dimension > input:enabled';
    ui.link = 'button.elementor-link-dimensions';
    return ui;
  },
  events: function events() {
    return _.extend(ControlBaseUnitsItemView.prototype.events.apply(this, arguments), {
      'click @ui.link': 'onLinkDimensionsClicked'
    });
  },
  defaultDimensionValue: 0,
  initialize: function initialize() {
    ControlBaseUnitsItemView.prototype.initialize.apply(this, arguments); // TODO: Need to be in helpers, and not in variable

    this.model.set('allowed_dimensions', this.filterDimensions(this.model.get('allowed_dimensions')));
  },
  getPossibleDimensions: function getPossibleDimensions() {
    return ['top', 'right', 'bottom', 'left'];
  },
  filterDimensions: function filterDimensions(filter) {
    filter = filter || 'all';
    var dimensions = this.getPossibleDimensions();

    if ('all' === filter) {
      return dimensions;
    }

    if (!_.isArray(filter)) {
      if ('horizontal' === filter) {
        filter = ['right', 'left'];
      } else if ('vertical' === filter) {
        filter = ['top', 'bottom'];
      }
    }

    return filter;
  },
  onReady: function onReady() {
    var self = this,
        currentValue = self.getControlValue();

    if (!self.isLinkedDimensions()) {
      self.ui.link.addClass('unlinked');
      self.ui.controls.each(function (index, element) {
        var value = currentValue[element.dataset.setting];

        if (_.isEmpty(value)) {
          value = self.defaultDimensionValue;
        }

        self.$(element).val(value);
      });
    }

    self.fillEmptyDimensions();
  },
  updateDimensionsValue: function updateDimensionsValue() {
    var currentValue = {},
        dimensions = this.getPossibleDimensions(),
        $controls = this.ui.controls,
        defaultDimensionValue = this.defaultDimensionValue;
    dimensions.forEach(function (dimension) {
      var $element = $controls.filter('[data-setting="' + dimension + '"]');
      currentValue[dimension] = $element.length ? $element.val() : defaultDimensionValue;
    });
    this.setValue(currentValue);
  },
  fillEmptyDimensions: function fillEmptyDimensions() {
    var dimensions = this.getPossibleDimensions(),
        allowedDimensions = this.model.get('allowed_dimensions'),
        $controls = this.ui.controls,
        defaultDimensionValue = this.defaultDimensionValue;

    if (this.isLinkedDimensions()) {
      return;
    }

    dimensions.forEach(function (dimension) {
      var $element = $controls.filter('[data-setting="' + dimension + '"]'),
          isAllowedDimension = -1 !== _.indexOf(allowedDimensions, dimension);

      if (isAllowedDimension && $element.length && _.isEmpty($element.val())) {
        $element.val(defaultDimensionValue);
      }
    });
  },
  updateDimensions: function updateDimensions() {
    this.fillEmptyDimensions();
    this.updateDimensionsValue();
  },
  resetDimensions: function resetDimensions() {
    this.ui.controls.val('');
    this.updateDimensionsValue();
  },
  onInputChange: function onInputChange(event) {
    var inputSetting = event.target.dataset.setting;

    if ('unit' === inputSetting) {
      this.resetDimensions();
    }

    if (!_.contains(this.getPossibleDimensions(), inputSetting)) {
      return;
    }

    if (this.isLinkedDimensions()) {
      var $thisControl = this.$(event.target);
      this.ui.controls.val($thisControl.val());
    }

    this.updateDimensions();
  },
  onLinkDimensionsClicked: function onLinkDimensionsClicked(event) {
    event.preventDefault();
    event.stopPropagation();
    this.ui.link.toggleClass('unlinked');
    this.setValue('isLinked', !this.ui.link.hasClass('unlinked'));

    if (this.isLinkedDimensions()) {
      // Set all controls value from the first control.
      this.ui.controls.val(this.ui.controls.eq(0).val());
    }

    this.updateDimensions();
  },
  isLinkedDimensions: function isLinkedDimensions() {
    return this.getControlValue('isLinked');
  }
});
module.exports = ControlDimensionsItemView;

/***/ }),
/* 398 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";

// B.2.3.10 String.prototype.link(url)
__webpack_require__(399)('link', function (createHTML) {
  return function link(url) {
    return createHTML(this, 'a', 'href', url);
  };
});


/***/ }),
/* 399 */
/***/ (function(module, exports, __webpack_require__) {

var $export = __webpack_require__(29);
var fails = __webpack_require__(22);
var defined = __webpack_require__(32);
var quot = /"/g;
// B.2.3.2.1 CreateHTML(string, tag, attribute, value)
var createHTML = function (string, tag, attribute, value) {
  var S = String(defined(string));
  var p1 = '<' + tag;
  if (attribute !== '') p1 += ' ' + attribute + '="' + String(value).replace(quot, '&quot;') + '"';
  return p1 + '>' + S + '</' + tag + '>';
};
module.exports = function (NAME, exec) {
  var O = {};
  O[NAME] = exec(createHTML);
  $export($export.P + $export.F * fails(function () {
    var test = ''[NAME]('"');
    return test !== test.toLowerCase() || test.split('"').length > 3;
  }), 'String', O);
};


/***/ }),
/* 400 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


__webpack_require__(173);

__webpack_require__(99);

__webpack_require__(15);

__webpack_require__(48);

var ControlSelect2View = __webpack_require__(185);

module.exports = ControlSelect2View.extend({
  _enqueuedFonts: [],
  $previewContainer: null,
  enqueueFont: function enqueueFont(font) {
    if (-1 !== this._enqueuedFonts.indexOf(font)) {
      return;
    }

    var fontUrl;
    var fontType = elementor.config.controls.font.options[font];

    switch (fontType) {
      case 'googlefonts':
        fontUrl = 'https://fonts.googleapis.com/css?family=' + font + '&text=' + font;
        break;

      case 'earlyaccess':
        var fontLowerString = font.replace(/\s+/g, '').toLowerCase();
        fontUrl = 'https://fonts.googleapis.com/earlyaccess/' + fontLowerString + '.css';
        break;
    }

    if (!_.isEmpty(fontUrl)) {
      jQuery('head').find('link:last').after('<link href="' + fontUrl + '" rel="stylesheet" type="text/css">');
    }

    this._enqueuedFonts.push(font);
  },
  getSelect2Options: function getSelect2Options() {
    return {
      dir: elementorCommon.config.isRTL ? 'rtl' : 'ltr',
      templateSelection: this.fontPreviewTemplate,
      templateResult: this.fontPreviewTemplate
    };
  },
  onReady: function onReady() {
    var self = this;
    this.ui.select.select2(this.getSelect2Options());
    this.ui.select.on('select2:open', function () {
      self.$previewContainer = jQuery('.select2-results__options[role="tree"]:visible'); // load initial?

      setTimeout(function () {
        self.enqueueFontsInView();
      }, 100); // On search

      jQuery('input.select2-search__field:visible').on('keyup', function () {
        self.typeStopDetection.action.apply(self);
      }); // On scroll

      self.$previewContainer.on('scroll', function () {
        self.scrollStopDetection.onScroll.apply(self);
      });
    });
  },
  typeStopDetection: {
    idle: 350,
    timeOut: null,
    action: function action() {
      var parent = this,
          self = this.typeStopDetection;
      clearTimeout(self.timeOut);
      self.timeOut = setTimeout(function () {
        parent.enqueueFontsInView();
      }, self.idle);
    }
  },
  scrollStopDetection: {
    idle: 350,
    timeOut: null,
    onScroll: function onScroll() {
      var parent = this,
          self = this.scrollStopDetection;
      clearTimeout(self.timeOut);
      self.timeOut = setTimeout(function () {
        parent.enqueueFontsInView();
      }, self.idle);
    }
  },
  enqueueFontsInView: function enqueueFontsInView() {
    var self = this,
        containerOffset = this.$previewContainer.offset(),
        top = containerOffset.top,
        bottom = top + this.$previewContainer.innerHeight(),
        fontsInView = [];
    this.$previewContainer.children().find('li:visible').each(function (index, font) {
      var $font = jQuery(font),
          offset = $font.offset();

      if (offset && offset.top > top && offset.top < bottom) {
        fontsInView.push($font);
      }
    });
    fontsInView.forEach(function (font) {
      var fontFamily = jQuery(font).find('span').html();
      self.enqueueFont(fontFamily);
    });
  },
  fontPreviewTemplate: function fontPreviewTemplate(state) {
    if (!state.id) {
      return state.text;
    }

    return jQuery('<span>', {
      text: state.text,
      css: {
        'font-family': state.element.value.toString()
      }
    });
  },
  templateHelpers: function templateHelpers() {
    var helpers = ControlSelect2View.prototype.templateHelpers.apply(this, arguments),
        fonts = this.model.get('options');

    helpers.getFontsByGroups = function (groups) {
      var filteredFonts = {};

      _.each(fonts, function (fontType, fontName) {
        if (_.isArray(groups) && _.contains(groups, fontType) || fontType === groups) {
          filteredFonts[fontName] = fontName;
        }
      });

      return filteredFonts;
    };

    return helpers;
  }
});

/***/ }),
/* 401 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var ControlBaseDataView = __webpack_require__(65),
    ControlMediaItemView;

ControlMediaItemView = ControlBaseDataView.extend({
  ui: function ui() {
    var ui = ControlBaseDataView.prototype.ui.apply(this, arguments);
    ui.addImages = '.elementor-control-gallery-add';
    ui.clearGallery = '.elementor-control-gallery-clear';
    ui.galleryThumbnails = '.elementor-control-gallery-thumbnails';
    ui.status = '.elementor-control-gallery-status-title';
    return ui;
  },
  events: function events() {
    return _.extend(ControlBaseDataView.prototype.events.apply(this, arguments), {
      'click @ui.addImages': 'onAddImagesClick',
      'click @ui.clearGallery': 'onClearGalleryClick',
      'click @ui.galleryThumbnails': 'onGalleryThumbnailsClick'
    });
  },
  onReady: function onReady() {
    this.initRemoveDialog();
  },
  applySavedValue: function applySavedValue() {
    var images = this.getControlValue(),
        imagesCount = images.length,
        hasImages = !!imagesCount;
    this.$el.toggleClass('elementor-gallery-has-images', hasImages).toggleClass('elementor-gallery-empty', !hasImages);
    var $galleryThumbnails = this.ui.galleryThumbnails;
    $galleryThumbnails.empty();
    this.ui.status.text(elementor.translate(hasImages ? 'gallery_images_selected' : 'gallery_no_images_selected', [imagesCount]));

    if (!hasImages) {
      return;
    }

    this.getControlValue().forEach(function (image) {
      var $thumbnail = jQuery('<div>', {
        class: 'elementor-control-gallery-thumbnail'
      });
      $thumbnail.css('background-image', 'url(' + image.url + ')');
      $galleryThumbnails.append($thumbnail);
    });
  },
  hasImages: function hasImages() {
    return !!this.getControlValue().length;
  },
  openFrame: function openFrame(action) {
    this.initFrame(action);
    this.frame.open();
  },
  initFrame: function initFrame(action) {
    var frameStates = {
      create: 'gallery',
      add: 'gallery-library',
      edit: 'gallery-edit'
    };
    var options = {
      frame: 'post',
      multiple: true,
      state: frameStates[action],
      button: {
        text: elementor.translate('insert_media')
      }
    };

    if (this.hasImages()) {
      options.selection = this.fetchSelection();
    }

    this.frame = wp.media(options); // When a file is selected, run a callback.

    this.frame.on({
      update: this.select,
      'menu:render:default': this.menuRender,
      'content:render:browse': this.gallerySettings
    }, this);
  },
  menuRender: function menuRender(view) {
    view.unset('insert');
    view.unset('featured-image');
  },
  gallerySettings: function gallerySettings(browser) {
    browser.sidebar.on('ready', function () {
      browser.sidebar.unset('gallery');
    });
  },
  fetchSelection: function fetchSelection() {
    var attachments = wp.media.query({
      orderby: 'post__in',
      order: 'ASC',
      type: 'image',
      perPage: -1,
      post__in: _.pluck(this.getControlValue(), 'id')
    });
    return new wp.media.model.Selection(attachments.models, {
      props: attachments.props.toJSON(),
      multiple: true
    });
  },

  /**
   * Callback handler for when an attachment is selected in the media modal.
   * Gets the selected image information, and sets it within the control.
   */
  select: function select(selection) {
    var images = [];
    selection.each(function (image) {
      images.push({
        id: image.get('id'),
        url: image.get('url')
      });
    });
    this.setValue(images);
    this.applySavedValue();
  },
  onBeforeDestroy: function onBeforeDestroy() {
    if (this.frame) {
      this.frame.off();
    }

    this.$el.remove();
  },
  resetGallery: function resetGallery() {
    this.setValue([]);
    this.applySavedValue();
  },
  initRemoveDialog: function initRemoveDialog() {
    var removeDialog;

    this.getRemoveDialog = function () {
      if (!removeDialog) {
        removeDialog = elementorCommon.dialogsManager.createWidget('confirm', {
          message: elementor.translate('dialog_confirm_gallery_delete'),
          headerMessage: elementor.translate('delete_gallery'),
          strings: {
            confirm: elementor.translate('delete'),
            cancel: elementor.translate('cancel')
          },
          defaultOption: 'confirm',
          onConfirm: this.resetGallery.bind(this)
        });
      }

      return removeDialog;
    };
  },
  onAddImagesClick: function onAddImagesClick() {
    this.openFrame(this.hasImages() ? 'add' : 'create');
  },
  onClearGalleryClick: function onClearGalleryClick() {
    this.getRemoveDialog().show();
  },
  onGalleryThumbnailsClick: function onGalleryThumbnailsClick() {
    this.openFrame('edit');
  }
});
module.exports = ControlMediaItemView;

/***/ }),
/* 402 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var _interopRequireDefault = __webpack_require__(0);

var _baseData = _interopRequireDefault(__webpack_require__(65));

module.exports = _baseData.default.extend({}, {
  onPasteStyle: function onPasteStyle() {
    return false;
  }
});

/***/ }),
/* 403 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var ControlSelect2View = __webpack_require__(185),
    ControlIconView;

ControlIconView = ControlSelect2View.extend({
  initialize: function initialize() {
    ControlSelect2View.prototype.initialize.apply(this, arguments);
    this.filterIcons();
  },
  filterIcons: function filterIcons() {
    var icons = this.model.get('options'),
        include = this.model.get('include'),
        exclude = this.model.get('exclude');

    if (include) {
      var filteredIcons = {};

      _.each(include, function (iconKey) {
        filteredIcons[iconKey] = icons[iconKey];
      });

      this.model.set('options', filteredIcons);
      return;
    }

    if (exclude) {
      _.each(exclude, function (iconKey) {
        delete icons[iconKey];
      });
    }
  },
  iconsList: function iconsList(icon) {
    if (!icon.id) {
      return icon.text;
    }

    return jQuery('<span><i class="' + icon.id + '"></i> ' + icon.text + '</span>');
  },
  getSelect2Options: function getSelect2Options() {
    return {
      allowClear: true,
      templateResult: this.iconsList.bind(this),
      templateSelection: this.iconsList.bind(this)
    };
  }
});
module.exports = ControlIconView;

/***/ }),
/* 404 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var _interopRequireDefault = __webpack_require__(0);

var _classCallCheck2 = _interopRequireDefault(__webpack_require__(2));

var _createClass2 = _interopRequireDefault(__webpack_require__(3));

var _possibleConstructorReturn2 = _interopRequireDefault(__webpack_require__(5));

var _getPrototypeOf3 = _interopRequireDefault(__webpack_require__(4));

var _get2 = _interopRequireDefault(__webpack_require__(28));

var _inherits2 = _interopRequireDefault(__webpack_require__(6));

var ControlMultipleBaseItemView = __webpack_require__(156);

var ControlIconsView =
/*#__PURE__*/
function (_ControlMultipleBaseI) {
  (0, _inherits2.default)(ControlIconsView, _ControlMultipleBaseI);

  function ControlIconsView() {
    var _getPrototypeOf2;

    var _this;

    (0, _classCallCheck2.default)(this, ControlIconsView);

    for (var _len = arguments.length, args = new Array(_len), _key = 0; _key < _len; _key++) {
      args[_key] = arguments[_key];
    }

    _this = (0, _possibleConstructorReturn2.default)(this, (_getPrototypeOf2 = (0, _getPrototypeOf3.default)(ControlIconsView)).call.apply(_getPrototypeOf2, [this].concat(args)));
    _this.cache = {
      loaded: false,
      dialog: false,
      enableClicked: false,
      fa4Mapping: false,
      migratedFlag: {}
    };
    _this.dataKeys = {
      migratedKey: '__fa4_migrated',
      fa4MigrationFlag: 'fa4compatibility'
    };
    return _this;
  }

  (0, _createClass2.default)(ControlIconsView, [{
    key: "enqueueIconFonts",
    value: function enqueueIconFonts(iconType) {
      var iconSetting = elementor.helpers.getIconLibrarySettings(iconType);

      if (false === iconSetting || !this.isMigrationAllowed()) {
        return;
      }

      if (iconSetting.enqueue) {
        iconSetting.enqueue.forEach(function (assetURL) {
          elementor.helpers.enqueueEditorStylesheet(assetURL);
          elementor.helpers.enqueuePreviewStylesheet(assetURL);
        });
      }

      if (iconSetting.url) {
        elementor.helpers.enqueueEditorStylesheet(iconSetting.url);
        elementor.helpers.enqueuePreviewStylesheet(iconSetting.url);
      }
    }
  }, {
    key: "ui",
    value: function ui() {
      var ui = (0, _get2.default)((0, _getPrototypeOf3.default)(ControlIconsView.prototype), "ui", this).call(this),
          skin = this.model.get('skin');
      ui.controlMedia = '.elementor-control-media';
      ui.svgUploader = 'media' === skin ? '.elementor-control-svg-uploader' : '.elementor-control-icons--inline__svg';
      ui.iconPickers = 'media' === skin ? '.elementor-control-icon-picker, .elementor-control-media__preview, .elementor-control-media-upload-button' : '.elementor-control-icons--inline__icon';
      ui.deleteButton = 'media' === skin ? '.elementor-control-media__remove' : '.elementor-control-icons--inline__none';
      ui.previewPlaceholder = '.elementor-control-media__preview';
      ui.previewContainer = '.elementor-control-preview-area';
      ui.inlineDisplayedIcon = '.elementor-control-icons--inline__displayed-icon';
      ui.radioInputs = '[type="radio"]';
      return ui;
    }
  }, {
    key: "events",
    value: function events() {
      return jQuery.extend(ControlMultipleBaseItemView.prototype.events.apply(this, arguments), {
        'click @ui.iconPickers': 'openPicker',
        'click @ui.svgUploader': 'openFrame',
        'click @ui.radioInputs': 'onClickInput',
        'click @ui.deleteButton': 'deleteIcon'
      });
    }
  }, {
    key: "getControlValue",
    value: function getControlValue() {
      var value = (0, _get2.default)((0, _getPrototypeOf3.default)(ControlIconsView.prototype), "getControlValue", this).call(this),
          model = this.model,
          valueToMigrate = this.getValueToMigrate();

      if (!this.isMigrationAllowed()) {
        return valueToMigrate;
      } // Bail if no migration flag or no value to migrate


      if (!valueToMigrate) {
        return value;
      }

      var didMigration = this.elementSettingsModel.get(this.dataKeys.migratedKey),
          controlName = model.get('name'); // Check if migration had been done and is stored locally

      if (this.cache.migratedFlag[controlName]) {
        return this.cache.migratedFlag[controlName];
      } // Check if already migrated


      if (didMigration && didMigration[controlName]) {
        return value;
      } // Do migration


      return this.migrateFa4toFa5(valueToMigrate);
    }
  }, {
    key: "migrateFa4toFa5",
    value: function migrateFa4toFa5(fa4Value) {
      var fa5Value = elementor.helpers.mapFa4ToFa5(fa4Value);
      this.cache.migratedFlag[this.model.get('name')] = fa5Value;
      this.enqueueIconFonts(fa5Value.library);
      return fa5Value;
    }
  }, {
    key: "setControlAsMigrated",
    value: function setControlAsMigrated(controlName) {
      var didMigration = this.elementSettingsModel.get(this.dataKeys.migratedKey) || {};
      didMigration[controlName] = true;
      this.elementSettingsModel.set(this.dataKeys.migratedKey, didMigration, {
        silent: true
      });
    }
  }, {
    key: "isMigrationAllowed",
    value: function isMigrationAllowed() {
      return !ElementorConfig['icons_update_needed'];
    }
  }, {
    key: "getValueToMigrate",
    value: function getValueToMigrate() {
      var controlToMigrate = this.model.get(this.dataKeys.fa4MigrationFlag);

      if (!controlToMigrate) {
        return false;
      } // Check if there is a value to migrate


      var valueToMigrate = this.container.settings.get(controlToMigrate);

      if (valueToMigrate) {
        return valueToMigrate;
      }

      return false;
    }
  }, {
    key: "onReady",
    value: function onReady() {
      var _this2 = this;

      // is migration allowed from fa4
      if (!this.isMigrationAllowed()) {
        this.ui.previewContainer[0].addEventListener('click', function (event) {
          event.stopPropagation();

          var onConfirm = function onConfirm() {
            window.location.href = ElementorConfig.tools_page_link + '&redirect_to=' + encodeURIComponent(document.location.href) + '#tab-fontawesome4_migration';
          };

          var enableMigrationDialog = elementor.helpers.getSimpleDialog('elementor-enable-fa5-dialog', elementor.translate('enable_fa5'), elementor.translate('dialog_confirm_enable_fa5'), elementor.translate('update'), onConfirm);
          enableMigrationDialog.show();
          return false;
        }, true);
      }

      var controlName = this.model.get('name');

      if (this.cache.migratedFlag[controlName]) {
        this.setControlAsMigrated(controlName);
        setTimeout(function () {
          _this2.setValue(_this2.cache.migratedFlag[controlName]);
        }, 10);
      }
    }
  }, {
    key: "onRender",
    value: function onRender() {
      (0, _get2.default)((0, _getPrototypeOf3.default)(ControlIconsView.prototype), "onRender", this).call(this);

      if (this.isMigrationAllowed()) {
        elementor.iconManager.loadIconLibraries();
      }
    }
  }, {
    key: "initFrame",
    value: function initFrame() {
      var _this3 = this;

      // Set current doc id to attach uploaded images.
      wp.media.view.settings.post.id = elementor.config.document.id;
      this.frame = wp.media({
        button: {
          text: elementor.translate('insert_media')
        },
        library: {
          type: ['image/svg+xml']
        },
        states: [new wp.media.controller.Library({
          title: elementor.translate('insert_media'),
          library: wp.media.query({
            type: ['image/svg+xml']
          }),
          multiple: false,
          date: false
        })]
      });

      var handleSelect = function handleSelect() {
        return _this3.selectSvg();
      }; // When a file is selected, run a callback.


      this.frame.on('insert select', handleSelect);
      this.setUploadMimeType(this.frame, 'svg');
    }
  }, {
    key: "setUploadMimeType",
    value: function setUploadMimeType(frame, ext) {
      // Set svg as only allowed upload extensions
      var oldExtensions = _wpPluploadSettings.defaults.filters.mime_types[0].extensions;
      frame.on('ready', function () {
        _wpPluploadSettings.defaults.filters.mime_types[0].extensions = ext;
      });
      this.frame.on('close', function () {
        // restore allowed upload extensions
        _wpPluploadSettings.defaults.filters.mime_types[0].extensions = oldExtensions;
      });
    }
    /**
     * Callback handler for when an attachment is selected in the media modal.
     * Gets the selected image information, and sets it within the control.
     */

  }, {
    key: "selectSvg",
    value: function selectSvg() {
      this.trigger('before:select'); // Get the attachment from the modal frame.

      var attachment = this.frame.state().get('selection').first().toJSON();

      if (attachment.url) {
        this.setValue({
          value: {
            url: attachment.url,
            id: attachment.id
          },
          library: 'svg'
        });
        this.applySavedValue();
      }

      this.trigger('after:select');
    }
  }, {
    key: "getSvgNotEnabledDialog",
    value: function getSvgNotEnabledDialog() {
      var _this4 = this;

      var onConfirm = function onConfirm() {
        elementorCommon.ajax.addRequest('enable_svg_uploads', {}, true);

        _this4.openFrame();
      };

      return elementor.helpers.getSimpleDialog('elementor-enable-svg-dialog', elementor.translate('enable_svg'), elementor.translate('dialog_confirm_enable_svg'), elementor.translate('enable'), onConfirm);
    }
  }, {
    key: "isSvgEnabled",
    value: function isSvgEnabled() {
      if (!this.cache.enableClicked) {
        return this.model.get('is_svg_enabled');
      }

      return true;
    }
  }, {
    key: "openFrame",
    value: function openFrame() {
      if (!this.isSvgEnabled() && !elementor.iconManager.cache.svgDialogShown) {
        var dialog = this.getSvgNotEnabledDialog();
        elementor.iconManager.cache.svgDialogShown = true;
        return dialog.show();
      }

      if (!this.frame) {
        this.initFrame();
      }

      this.frame.open(); // Set params to trigger sanitizer

      this.frame.uploader.uploader.param('uploadTypeCaller', 'elementor-editor-upload');
      this.frame.uploader.uploader.param('upload_type', 'svg-icon');
      var selectedId = this.getControlValue('id');

      if (!selectedId) {
        return;
      }

      var selection = this.frame.state().get('selection');
      selection.add(wp.media.attachment(selectedId));
    }
  }, {
    key: "openPicker",
    value: function openPicker() {
      elementor.iconManager.show({
        view: this
      });
    }
  }, {
    key: "applySavedValue",
    value: function applySavedValue() {
      var _this5 = this;

      var controlValue = this.getControlValue(),
          skin = this.model.get('skin'),
          iconContainer = 'inline' === skin ? this.ui.inlineDisplayedIcon : this.ui.previewPlaceholder,
          defaultIcon = this.model.get('default');
      var iconValue = controlValue.value,
          iconType = controlValue.library;

      if (!this.isMigrationAllowed() && !iconValue && this.getValueToMigrate()) {
        iconValue = this.getControlValue();
        iconType = '';
      }

      if ('media' === skin) {
        this.ui.controlMedia.toggleClass('elementor-media-empty', !iconValue);
      } else {
        this.markChecked(iconType);
      }

      if (!iconValue) {
        if ('inline' === skin) {
          this.setDefaultIconLibraryLabel(defaultIcon, iconContainer);
          return;
        }

        this.ui.previewPlaceholder.html('');
        return;
      }

      if ('svg' === iconType && 'inline' !== skin) {
        return elementor.helpers.fetchInlineSvg(iconValue.url, function (data) {
          _this5.ui.previewPlaceholder.html(data);
        });
      }

      if ('media' === skin || 'svg' !== iconType) {
        var previewHTML = '<i class="' + iconValue + '"></i>';
        iconContainer.html(previewHTML);
      }

      this.enqueueIconFonts(iconType);
    }
  }, {
    key: "setDefaultIconLibraryLabel",
    value: function setDefaultIconLibraryLabel(defaultIcon, iconContainer) {
      // Check if the control has a default icon
      if ('' !== defaultIcon.value && 'svg' !== defaultIcon.library) {
        // If the default icon is not an SVG, set the icon-library label's icon to the default icon
        iconContainer.html('<i class="' + defaultIcon.value + '"></i>');
      } else {
        // If (1) the control does NOT have a default icon,
        // OR (2) the control DOES have a default icon BUT the default icon is an SVG,
        // set the default icon-library label's icon to a simple circle
        iconContainer.html('<i class="eicon-circle"></i>');
      }
    }
  }, {
    key: "markChecked",
    value: function markChecked(iconType) {
      this.ui.radioInputs.filter(':checked').prop('checked', false);

      if (!iconType) {
        return this.ui.radioInputs.filter('[value="none"]').prop('checked', true);
      }

      if ('svg' !== iconType) {
        iconType = 'icon';
      }

      this.ui.radioInputs.filter('[value="' + iconType + '"]').prop('checked', true);
    }
  }, {
    key: "onClickInput",
    value: function onClickInput() {
      this.markChecked(this.getControlValue().library);
    }
  }, {
    key: "deleteIcon",
    value: function deleteIcon(event) {
      event.stopPropagation();
      this.setValue({
        value: '',
        library: ''
      });
      this.applySavedValue();
    }
  }, {
    key: "onBeforeDestroy",
    value: function onBeforeDestroy() {
      this.$el.remove();
    }
  }]);
  return ControlIconsView;
}(ControlMultipleBaseItemView);

module.exports = ControlIconsView;

/***/ }),
/* 405 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var ControlMultipleBaseItemView = __webpack_require__(156),
    ControlImageDimensionsItemView;

ControlImageDimensionsItemView = ControlMultipleBaseItemView.extend({
  ui: function ui() {
    return {
      inputWidth: 'input[data-setting="width"]',
      inputHeight: 'input[data-setting="height"]',
      btnApply: 'button.elementor-image-dimensions-apply-button'
    };
  },
  // Override the base events
  events: function events() {
    return {
      'click @ui.btnApply': 'onApplyClicked',
      'keyup @ui.inputWidth': 'onDimensionKeyUp',
      'keyup @ui.inputHeight': 'onDimensionKeyUp'
    };
  },
  onDimensionKeyUp: function onDimensionKeyUp(event) {
    var ENTER_KEY = 13;

    if (ENTER_KEY === event.keyCode) {
      this.onApplyClicked(event);
    }
  },
  onApplyClicked: function onApplyClicked(event) {
    event.preventDefault();
    this.setValue({
      width: this.ui.inputWidth.val(),
      height: this.ui.inputHeight.val()
    });
  }
});
module.exports = ControlImageDimensionsItemView;

/***/ }),
/* 406 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var ControlMultipleBaseItemView = __webpack_require__(156),
    ControlMediaItemView;

ControlMediaItemView = ControlMultipleBaseItemView.extend({
  ui: function ui() {
    var ui = ControlMultipleBaseItemView.prototype.ui.apply(this, arguments);
    ui.controlMedia = '.elementor-control-media';
    ui.mediaImage = '.elementor-control-media__preview';
    ui.mediaVideo = '.elementor-control-media-video';
    ui.frameOpeners = '.elementor-control-preview-area';
    ui.removeButton = '.elementor-control-media__remove';
    return ui;
  },
  events: function events() {
    return _.extend(ControlMultipleBaseItemView.prototype.events.apply(this, arguments), {
      'click @ui.frameOpeners': 'openFrame',
      'click @ui.removeButton': 'deleteImage'
    });
  },
  getMediaType: function getMediaType() {
    return this.model.get('media_type');
  },
  applySavedValue: function applySavedValue() {
    var url = this.getControlValue('url'),
        mediaType = this.getMediaType();

    if ('image' === mediaType) {
      this.ui.mediaImage.css('background-image', url ? 'url(' + url + ')' : '');
    } else if ('video' === mediaType) {
      this.ui.mediaVideo.attr('src', url);
    }

    this.ui.controlMedia.toggleClass('elementor-media-empty', !url);
  },
  openFrame: function openFrame() {
    if (!this.frame) {
      this.initFrame();
    }

    this.frame.open();
    var selectedId = this.getControlValue('id');

    if (!selectedId) {
      return;
    }

    var selection = this.frame.state().get('selection');
    selection.add(wp.media.attachment(selectedId));
  },
  deleteImage: function deleteImage(event) {
    event.stopPropagation();
    this.setValue({
      url: '',
      id: ''
    });
    this.applySavedValue();
  },

  /**
   * Create a media modal select frame, and store it so the instance can be reused when needed.
   */
  initFrame: function initFrame() {
    // Set current doc id to attach uploaded images.
    wp.media.view.settings.post.id = elementor.config.document.id;
    this.frame = wp.media({
      button: {
        text: elementor.translate('insert_media')
      },
      states: [new wp.media.controller.Library({
        title: elementor.translate('insert_media'),
        library: wp.media.query({
          type: this.getMediaType()
        }),
        multiple: false,
        date: false
      })]
    }); // When a file is selected, run a callback.

    this.frame.on('insert select', this.select.bind(this));
  },

  /**
   * Callback handler for when an attachment is selected in the media modal.
   * Gets the selected image information, and sets it within the control.
   */
  select: function select() {
    this.trigger('before:select'); // Get the attachment from the modal frame.

    var attachment = this.frame.state().get('selection').first().toJSON();

    if (attachment.url) {
      this.setValue({
        url: attachment.url,
        id: attachment.id
      });
      this.applySavedValue();
    }

    this.trigger('after:select');
  },
  onBeforeDestroy: function onBeforeDestroy() {
    this.$el.remove();
  }
});
module.exports = ControlMediaItemView;

/***/ }),
/* 407 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var ControlBaseDataView = __webpack_require__(65),
    NumberValidator = __webpack_require__(408),
    ControlNumberItemView;

ControlNumberItemView = ControlBaseDataView.extend({
  registerValidators: function registerValidators() {
    ControlBaseDataView.prototype.registerValidators.apply(this, arguments);
    var validationTerms = {},
        model = this.model;
    ['min', 'max'].forEach(function (term) {
      var termValue = model.get(term);

      if (_.isFinite(termValue)) {
        validationTerms[term] = termValue;
      }
    });

    if (!jQuery.isEmptyObject(validationTerms)) {
      this.addValidator(new NumberValidator({
        validationTerms: validationTerms
      }));
    }
  }
});
module.exports = ControlNumberItemView;

/***/ }),
/* 408 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var Validator = __webpack_require__(203);

module.exports = Validator.extend({
  validationMethod: function validationMethod(newValue) {
    var validationTerms = this.getSettings('validationTerms'),
        errors = [];

    if (_.isFinite(newValue)) {
      if (undefined !== validationTerms.min && newValue < validationTerms.min) {
        errors.push('Value is less than minimum');
      }

      if (undefined !== validationTerms.max && newValue > validationTerms.max) {
        errors.push('Value is greater than maximum');
      }
    }

    return errors;
  }
});

/***/ }),
/* 409 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var ControlMultipleBaseItemView = __webpack_require__(156),
    ControlOrderItemView;

ControlOrderItemView = ControlMultipleBaseItemView.extend({
  ui: function ui() {
    var ui = ControlMultipleBaseItemView.prototype.ui.apply(this, arguments);
    ui.reverseOrderLabel = '.elementor-control-order-label';
    return ui;
  },
  changeLabelTitle: function changeLabelTitle() {
    var reverseOrder = this.getControlValue('reverse_order');
    this.ui.reverseOrderLabel.attr('title', elementor.translate(reverseOrder ? 'asc' : 'desc'));
  },
  onRender: function onRender() {
    ControlMultipleBaseItemView.prototype.onRender.apply(this, arguments);
    this.changeLabelTitle();
  },
  onInputChange: function onInputChange() {
    this.changeLabelTitle();
  }
});
module.exports = ControlOrderItemView;

/***/ }),
/* 410 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var ControlChooseView = __webpack_require__(262),
    ControlPopoverStarterView;

ControlPopoverStarterView = ControlChooseView.extend({
  ui: function ui() {
    var ui = ControlChooseView.prototype.ui.apply(this, arguments);
    ui.popoverToggle = '.elementor-control-popover-toggle-toggle';
    return ui;
  },
  events: function events() {
    return _.extend(ControlChooseView.prototype.events.apply(this, arguments), {
      'click @ui.popoverToggle': 'onPopoverToggleClick'
    });
  },
  onPopoverToggleClick: function onPopoverToggleClick() {
    this.$el.next('.elementor-controls-popover').toggle();
  }
}, {
  onPasteStyle: function onPasteStyle(control, clipboardValue) {
    return !clipboardValue || clipboardValue === control.return_value;
  }
});
module.exports = ControlPopoverStarterView;

/***/ }),
/* 411 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


__webpack_require__(30);

__webpack_require__(161);

__webpack_require__(15);

var ControlBaseDataView = __webpack_require__(65),
    RepeaterRowView = __webpack_require__(264),
    ControlRepeaterItemView;

ControlRepeaterItemView = ControlBaseDataView.extend({
  ui: {
    btnAddRow: '.elementor-repeater-add',
    fieldContainer: '.elementor-repeater-fields-wrapper'
  },
  events: function events() {
    return {
      'click @ui.btnAddRow': 'onButtonAddRowClick',
      'sortstart @ui.fieldContainer': 'onSortStart',
      'sortupdate @ui.fieldContainer': 'onSortUpdate',
      'sortstop @ui.fieldContainer': 'onSortStop'
    };
  },
  childView: RepeaterRowView,
  childViewContainer: '.elementor-repeater-fields-wrapper',
  templateHelpers: function templateHelpers() {
    return {
      itemActions: this.model.get('item_actions'),
      data: _.extend({}, this.model.toJSON(), {
        controlValue: []
      })
    };
  },
  childViewOptions: function childViewOptions(rowModel, index) {
    var elementContainer = this.getOption('container');
    var rowId = rowModel.get('_id'); // TODO: Temp backwards compatibility. since 2.8.0.

    if (!rowId) {
      rowId = 'bc-' + elementor.helpers.getUniqueID();
      rowModel.set('_id', rowId);
    }

    elementContainer.children[index] = new elementorModules.editor.Container({
      type: 'repeater',
      id: rowId,
      model: new Backbone.Model({
        name: this.model.get('name')
      }),
      settings: rowModel,
      view: elementContainer.view,
      parent: elementContainer,
      label: elementContainer.label + ' ' + elementor.translate('Item') + "#".concat(index + 1),
      controls: rowModel.options.controls,
      renderer: elementContainer.renderer
    });
    return {
      container: elementContainer.children[index],
      controlFields: this.model.get('fields'),
      titleField: this.model.get('title_field'),
      itemActions: this.model.get('item_actions')
    };
  },
  createItemModel: function createItemModel(attrs, options, controlView) {
    options.controls = controlView.model.get('fields');
    return new elementorModules.editor.elements.models.BaseSettings(attrs, options);
  },
  fillCollection: function fillCollection() {
    // TODO: elementSettingsModel is deprecated since 2.8.0.
    var settings = this.container ? this.container.settings : this.elementSettingsModel;
    var controlName = this.model.get('name');
    this.collection = settings.get(controlName); // Hack for history redo/undo

    if (!(this.collection instanceof Backbone.Collection)) {
      this.collection = new Backbone.Collection(this.collection, {
        // Use `partial` to supply the `this` as an argument, but not as context
        // the `_` is a place holder for original arguments: `attrs` & `options`
        model: _.partial(this.createItemModel, _, _, this)
      }); // Set the value silent

      settings.set(controlName, this.collection, {
        silent: true
      });
    } // Reset children.
    // TODO: Temp backwards compatibility since 2.8.0.


    if (this.container) {
      this.container.children = [];
    }
  },
  initialize: function initialize() {
    ControlBaseDataView.prototype.initialize.apply(this, arguments);
    this.fillCollection();
  },
  editRow: function editRow(rowView) {
    if (this.currentEditableChild) {
      var currentEditable = this.currentEditableChild.getChildViewContainer(this.currentEditableChild);
      currentEditable.removeClass('editable'); // If the repeater contains TinyMCE editors, fire the `hide` trigger to hide floated toolbars

      currentEditable.find('.elementor-wp-editor').each(function () {
        tinymce.get(this.id).fire('hide');
      });
    }

    if (this.currentEditableChild === rowView) {
      delete this.currentEditableChild;
      return;
    }

    rowView.getChildViewContainer(rowView).addClass('editable');
    this.currentEditableChild = rowView;
    this.updateActiveRow();
  },
  toggleMinRowsClass: function toggleMinRowsClass() {
    if (!this.model.get('prevent_empty')) {
      return;
    }

    this.$el.toggleClass('elementor-repeater-has-minimum-rows', 1 >= this.collection.length);
  },
  updateActiveRow: function updateActiveRow() {
    var activeItemIndex = 1;

    if (this.currentEditableChild) {
      activeItemIndex = this.currentEditableChild.itemIndex;
    }

    this.setEditSetting('activeItemIndex', activeItemIndex);
  },
  updateChildIndexes: function updateChildIndexes() {
    var collection = this.collection;
    this.children.each(function (view) {
      view.updateIndex(collection.indexOf(view.model) + 1);
      view.setTitle();
    });
  },
  onRender: function onRender() {
    ControlBaseDataView.prototype.onRender.apply(this, arguments);

    if (this.model.get('item_actions').sort) {
      this.ui.fieldContainer.sortable({
        axis: 'y',
        handle: '.elementor-repeater-row-tools'
      });
    }

    this.toggleMinRowsClass();
  },
  onSortStart: function onSortStart(event, ui) {
    ui.item.data('oldIndex', ui.item.index());
  },
  onSortStop: function onSortStop(event, ui) {
    // Reload TinyMCE editors (if exist), it's a bug that TinyMCE content is missing after stop dragging
    var self = this,
        sortedIndex = ui.item.index();

    if (-1 === sortedIndex) {
      return;
    }

    var sortedRowView = self.children.findByIndex(ui.item.index()),
        rowControls = sortedRowView.children._views;
    jQuery.each(rowControls, function () {
      if ('wysiwyg' === this.model.get('type')) {
        sortedRowView.render();
        delete self.currentEditableChild;
        return false;
      }
    });
  },
  onSortUpdate: function onSortUpdate(event, ui) {
    var oldIndex = ui.item.data('oldIndex'),
        newIndex = ui.item.index();
    $e.run('document/repeater/move', {
      container: this.options.container,
      name: this.model.get('name'),
      sourceIndex: oldIndex,
      targetIndex: newIndex
    });
  },
  onAddChild: function onAddChild() {
    this.updateChildIndexes();
    this.updateActiveRow();
  },
  onButtonAddRowClick: function onButtonAddRowClick() {
    var defaults = {}; // Get default fields.

    _.each(this.model.get('fields'), function (field) {
      defaults[field.name] = field.default;
    });

    var newModel = $e.run('document/repeater/insert', {
      container: this.options.container,
      name: this.model.get('name'),
      model: defaults
    });
    this.editRow(this.children.findByModel(newModel));
    this.toggleMinRowsClass();
  },
  onChildviewClickRemove: function onChildviewClickRemove(childView) {
    if (childView === this.currentEditableChild) {
      delete this.currentEditableChild;
    }

    $e.run('document/repeater/remove', {
      container: this.options.container,
      name: this.model.get('name'),
      index: childView._index
    });
    this.updateActiveRow();
    this.updateChildIndexes();
    this.toggleMinRowsClass();
  },
  onChildviewClickDuplicate: function onChildviewClickDuplicate(childView) {
    $e.run('document/repeater/duplicate', {
      container: this.options.container,
      name: this.model.get('name'),
      index: childView._index
    });
    this.toggleMinRowsClass();
  },
  onChildviewClickEdit: function onChildviewClickEdit(childView) {
    this.editRow(childView);
  },
  onAfterExternalChange: function onAfterExternalChange() {
    // Update the collection with current value
    this.fillCollection();
    ControlBaseDataView.prototype.onAfterExternalChange.apply(this, arguments);
  }
});
module.exports = ControlRepeaterItemView;

/***/ }),
/* 412 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var ControlBaseView = __webpack_require__(191),
    ControlSectionItemView;

ControlSectionItemView = ControlBaseView.extend({
  ui: function ui() {
    var ui = ControlBaseView.prototype.ui.apply(this, arguments);
    ui.heading = '.elementor-panel-heading';
    return ui;
  },
  triggers: {
    click: 'control:section:clicked'
  }
});
module.exports = ControlSectionItemView;

/***/ }),
/* 413 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var ControlBaseDataView = __webpack_require__(65),
    ControlSelectItemView;

ControlSelectItemView = ControlBaseDataView.extend({}, {
  onPasteStyle: function onPasteStyle(control, clipboardValue) {
    if (control.groups) {
      return control.groups.some(function (group) {
        return ControlSelectItemView.onPasteStyle(group, clipboardValue);
      });
    }

    return undefined !== control.options[clipboardValue];
  }
});
module.exports = ControlSelectItemView;

/***/ }),
/* 414 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var _interopRequireDefault = __webpack_require__(0);

var _keys = _interopRequireDefault(__webpack_require__(27));

var _values = _interopRequireDefault(__webpack_require__(111));

var ControlBaseUnitsItemView = __webpack_require__(263),
    ControlSliderItemView;

ControlSliderItemView = ControlBaseUnitsItemView.extend({
  ui: function ui() {
    var ui = ControlBaseUnitsItemView.prototype.ui.apply(this, arguments);
    ui.slider = '.elementor-slider';
    return ui;
  },
  templateHelpers: function templateHelpers() {
    var templateHelpers = ControlBaseUnitsItemView.prototype.templateHelpers.apply(this, arguments);
    templateHelpers.isMultiple = this.isMultiple();
    return templateHelpers;
  },
  isMultiple: function isMultiple() {
    var sizes = this.getControlValue('sizes');
    return !jQuery.isEmptyObject(sizes);
  },
  initSlider: function initSlider() {
    // Slider does not exist in tests.
    if (!this.ui.slider[0]) {
      return;
    }

    this.destroySlider();
    var isMultiple = this.isMultiple(),
        unitRange = elementorCommon.helpers.cloneObject(this.getCurrentRange()),
        step = unitRange.step;
    var sizes = this.getSize();

    if (isMultiple) {
      sizes = (0, _values.default)(sizes);
    } else {
      sizes = [sizes];
      this.ui.input.attr(unitRange);
    }

    delete unitRange.step;
    var tooltips;
    var self = this;

    if (isMultiple) {
      tooltips = [];
      sizes.forEach(function () {
        return tooltips.push({
          to: function to(value) {
            return value + self.getControlValue('unit');
          }
        });
      });
    }

    var sliderInstance = noUiSlider.create(this.ui.slider[0], {
      start: sizes,
      range: unitRange,
      step: step,
      tooltips: tooltips,
      connect: isMultiple,
      format: {
        to: function to(value) {
          return Math.round(value * 1000) / 1000;
        },
        from: function from(value) {
          return +value;
        }
      }
    });
    sliderInstance.on('slide', this.onSlideChange.bind(this));
  },
  applySavedValue: function applySavedValue() {
    ControlBaseUnitsItemView.prototype.applySavedValue.apply(this, arguments); // Slider does not exist in tests.

    if (this.ui.slider[0] && this.ui.slider[0].noUiSlider) {
      this.ui.slider[0].noUiSlider.set(this.getSize());
    }
  },
  getSize: function getSize() {
    return this.getControlValue(this.isMultiple() ? 'sizes' : 'size');
  },
  resetSize: function resetSize() {
    if (this.isMultiple()) {
      this.setValue('sizes', {});
    } else {
      this.setValue('size', '');
    }

    this.initSlider();
  },
  destroySlider: function destroySlider() {
    // Slider does not exist in tests.
    if (this.ui.slider[0] && this.ui.slider[0].noUiSlider) {
      this.ui.slider[0].noUiSlider.destroy();
    }
  },
  onReady: function onReady() {
    if (this.isMultiple()) {
      this.$el.addClass('elementor-control-type-slider--multiple elementor-control-type-slider--handles-' + this.model.get('handles'));
    }

    this.initSlider();
  },
  onSlideChange: function onSlideChange(values, index) {
    if (this.isMultiple()) {
      var sizes = elementorCommon.helpers.cloneObject(this.getSize()),
          key = (0, _keys.default)(sizes)[index];
      sizes[key] = values[index];
      this.setValue('sizes', sizes);
    } else {
      this.setValue('size', values[0]);
      this.ui.input.val(values[0]);
    }
  },
  onInputChange: function onInputChange(event) {
    var dataChanged = event.currentTarget.dataset.setting;

    if ('size' === dataChanged) {
      this.ui.slider[0].noUiSlider.set(this.getSize());
    } else if ('unit' === dataChanged) {
      this.resetSize();
    }
  },
  onBeforeDestroy: function onBeforeDestroy() {
    this.destroySlider();
    this.$el.remove();
  }
});
module.exports = ControlSliderItemView;

/***/ }),
/* 415 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var ControlBaseDataView = __webpack_require__(65),
    ControlStructureItemView;

ControlStructureItemView = ControlBaseDataView.extend({
  ui: function ui() {
    var ui = ControlBaseDataView.prototype.ui.apply(this, arguments);
    ui.resetStructure = '.elementor-control-structure-reset';
    return ui;
  },
  events: function events() {
    return _.extend(ControlBaseDataView.prototype.events.apply(this, arguments), {
      'click @ui.resetStructure': 'onResetStructureClick'
    });
  },
  templateHelpers: function templateHelpers() {
    var helpers = ControlBaseDataView.prototype.templateHelpers.apply(this, arguments);
    helpers.getMorePresets = this.getMorePresets.bind(this);
    return helpers;
  },
  getCurrentEditedSection: function getCurrentEditedSection() {
    var editor = elementor.getPanelView().getCurrentPageView();
    return editor.getOption('editedElementView');
  },
  getMorePresets: function getMorePresets() {
    var parsedStructure = elementor.presetsFactory.getParsedStructure(this.getControlValue());
    return elementor.presetsFactory.getPresets(parsedStructure.columnsCount);
  },
  onResetStructureClick: function onResetStructureClick() {
    this.getCurrentEditedSection().resetColumnsCustomSize();
  }
});
module.exports = ControlStructureItemView;

/***/ }),
/* 416 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var ControlBaseDataView = __webpack_require__(65);

module.exports = ControlBaseDataView.extend({
  setInputValue: function setInputValue(input, value) {
    this.$(input).prop('checked', this.model.get('return_value') === value);
  }
}, {
  onPasteStyle: function onPasteStyle(control, clipboardValue) {
    return !clipboardValue || clipboardValue === control.return_value;
  }
});

/***/ }),
/* 417 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var ControlBaseView = __webpack_require__(191),
    ControlTabItemView;

ControlTabItemView = ControlBaseView.extend({
  triggers: {
    click: {
      event: 'control:tab:clicked',
      stopPropagation: false
    }
  }
});
module.exports = ControlTabItemView;

/***/ }),
/* 418 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var BaseMultiple = __webpack_require__(156);

module.exports = BaseMultiple.extend({
  onReady: function onReady() {
    var self = this,
        positionBase = elementorCommon.config.isRTL ? 'right' : 'left',
        last,
        cache; // Based on /wp-includes/js/tinymce/plugins/wplink/plugin.js.

    this.ui.input.autocomplete({
      source: function source(request, response) {
        if (!self.options.model.attributes.autocomplete) {
          return;
        }

        if (last === request.term) {
          response(cache);
          return;
        }

        if (/^https?:/.test(request.term) || request.term.indexOf('.') !== -1) {
          return response();
        } // Show Spinner.


        self.ui.input.prev().show();
        jQuery.post(window.ajaxurl, {
          editor: 'elementor',
          action: 'wp-link-ajax',
          page: 1,
          search: request.term,
          _ajax_linking_nonce: jQuery('#_ajax_linking_nonce').val()
        }, function (data) {
          cache = data;
          response(data);
        }, 'json').always(function () {
          // Hide Spinner.
          self.ui.input.prev().hide();
        });
        last = request.term;
      },
      focus: function focus(event) {
        /*
         * Don't empty the URL input field, when using the arrow keys to
         * highlight items. See api.jqueryui.com/autocomplete/#event-focus
         */
        event.preventDefault();
      },
      select: function select(event, ui) {
        self.ui.input.val(ui.item.permalink);
        self.setValue('url', ui.item.permalink);
        return false;
      },
      open: function open(event) {
        jQuery(event.target).data('uiAutocomplete').menu.activeMenu.addClass('elementor-autocomplete-menu');
      },
      minLength: 2,
      position: {
        my: positionBase + ' top+2',
        at: positionBase + ' bottom'
      }
    }) // The `_renderItem` cannot be override via the arguments.
    .autocomplete('instance')._renderItem = function (ul, item) {
      var fallbackTitle = window.wpLinkL10n ? window.wpLinkL10n.noTitle : '',
          title = item.title ? item.title : fallbackTitle;
      return jQuery('<li role="option" id="mce-wp-autocomplete-' + item.ID + '">').append('<span>' + title + '</span>&nbsp;<span class="elementor-autocomplete-item-info">' + item.info + '</span>').appendTo(ul);
    };
  },
  onBeforeDestroy: function onBeforeDestroy() {
    if (this.ui.input.data('autocomplete')) {
      this.ui.input.autocomplete('destroy');
    }

    this.$el.remove();
  }
});

/***/ }),
/* 419 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var ControlBaseDataView = __webpack_require__(65),
    ControlWPWidgetItemView;

ControlWPWidgetItemView = ControlBaseDataView.extend({
  ui: function ui() {
    var ui = ControlBaseDataView.prototype.ui.apply(this, arguments);
    ui.form = 'form';
    ui.loading = '.wp-widget-form-loading';
    return ui;
  },
  events: function events() {
    return {
      'keyup @ui.form :input': 'onFormChanged',
      'change @ui.form :input': 'onFormChanged'
    };
  },
  onFormChanged: function onFormChanged() {
    var idBase = 'widget-' + this.model.get('id_base'),
        settings = this.ui.form.elementorSerializeObject()[idBase].REPLACE_TO_ID;
    this.setValue(settings);
  },
  onReady: function onReady() {
    var self = this;
    elementorCommon.ajax.addRequest('editor_get_wp_widget_form', {
      data: {
        // Fake Widget ID
        id: self.model.cid,
        widget_type: self.model.get('widget'),
        data: self.container.settings.toJSON()
      },
      success: function success(data) {
        self.ui.form.html(data); // WP >= 4.8

        if (wp.textWidgets) {
          self.ui.form.addClass('open');
          var event = new jQuery.Event('widget-added');
          wp.textWidgets.handleWidgetAdded(event, self.ui.form);
          wp.mediaWidgets.handleWidgetAdded(event, self.ui.form); // WP >= 4.9

          if (wp.customHtmlWidgets) {
            wp.customHtmlWidgets.handleWidgetAdded(event, self.ui.form);
          }
        }

        elementor.hooks.doAction('panel/widgets/' + self.model.get('widget') + '/controls/wp_widget/loaded', self);
      }
    });
  }
});
module.exports = ControlWPWidgetItemView;

/***/ }),
/* 420 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


__webpack_require__(48);

__webpack_require__(68);

var ControlBaseDataView = __webpack_require__(65),
    ControlWysiwygItemView;

ControlWysiwygItemView = ControlBaseDataView.extend({
  editor: null,
  ui: function ui() {
    var ui = ControlBaseDataView.prototype.ui.apply(this, arguments);
    jQuery.extend(ui, {
      inputWrapper: '.elementor-control-input-wrapper'
    });
    return ui;
  },
  events: function events() {
    return _.extend(ControlBaseDataView.prototype.events.apply(this, arguments), {
      'keyup textarea.elementor-wp-editor': 'onBaseInputChange'
    });
  },
  // List of buttons to move {buttonToMove: afterButton}
  buttons: {
    addToBasic: {
      underline: 'italic'
    },
    addToAdvanced: {},
    moveToAdvanced: {
      blockquote: 'removeformat',
      alignleft: 'blockquote',
      aligncenter: 'alignleft',
      alignright: 'aligncenter'
    },
    moveToBasic: {},
    removeFromBasic: ['unlink', 'wp_more'],
    removeFromAdvanced: []
  },
  initialize: function initialize() {
    ControlBaseDataView.prototype.initialize.apply(this, arguments);
    var self = this;
    self.editorID = 'elementorwpeditor' + self.cid; // Wait a cycle before initializing the editors.

    _.defer(function () {
      if (self.isDestroyed) {
        return;
      } // Initialize QuickTags, and set as the default mode.


      quicktags({
        buttons: 'strong,em,del,link,img,close',
        id: self.editorID
      });

      if (elementor.config.rich_editing_enabled) {
        switchEditors.go(self.editorID, 'tmce');
      }

      delete QTags.instances[0];
    });

    if (!elementor.config.rich_editing_enabled) {
      self.$el.addClass('elementor-rich-editing-disabled');
      return;
    }

    var editorConfig = {
      id: self.editorID,
      selector: '#' + self.editorID,
      setup: function setup(editor) {
        self.editor = editor;
      }
    };
    tinyMCEPreInit.mceInit[self.editorID] = _.extend(_.clone(tinyMCEPreInit.mceInit.elementorwpeditor), editorConfig);

    if (!elementor.config.tinymceHasCustomConfig) {
      self.rearrangeButtons();
    }
  },
  applySavedValue: function applySavedValue() {
    if (!this.editor) {
      return;
    }

    var controlValue = this.getControlValue();
    this.editor.setContent(controlValue); // Update also the plain textarea

    jQuery('#' + this.editorID).val(controlValue);
  },
  saveEditor: function saveEditor() {
    this.setValue(this.editor.getContent());
  },
  moveButtons: function moveButtons(buttonsToMove, from, to) {
    if (!to) {
      to = from;
      from = null;
    }

    _.each(buttonsToMove, function (afterButton, button) {
      var afterButtonIndex = to.indexOf(afterButton);

      if (from) {
        var buttonIndex = from.indexOf(button);

        if (-1 === buttonIndex) {
          throw new ReferenceError('Trying to move non-existing button `' + button + '`');
        }

        from.splice(buttonIndex, 1);
      }

      if (-1 === afterButtonIndex) {
        throw new ReferenceError('Trying to move button after non-existing button `' + afterButton + '`');
      }

      to.splice(afterButtonIndex + 1, 0, button);
    });
  },
  rearrangeButtons: function rearrangeButtons() {
    var editorProps = tinyMCEPreInit.mceInit[this.editorID],
        editorBasicToolbarButtons = editorProps.toolbar1.split(','),
        editorAdvancedToolbarButtons = editorProps.toolbar2.split(',');
    editorBasicToolbarButtons = _.difference(editorBasicToolbarButtons, this.buttons.removeFromBasic);
    editorAdvancedToolbarButtons = _.difference(editorAdvancedToolbarButtons, this.buttons.removeFromAdvanced);
    this.moveButtons(this.buttons.moveToBasic, editorAdvancedToolbarButtons, editorBasicToolbarButtons);
    this.moveButtons(this.buttons.moveToAdvanced, editorBasicToolbarButtons, editorAdvancedToolbarButtons);
    this.moveButtons(this.buttons.addToBasic, editorBasicToolbarButtons);
    this.moveButtons(this.buttons.addToAdvanced, editorAdvancedToolbarButtons);
    editorProps.toolbar1 = editorBasicToolbarButtons.join(',');
    editorProps.toolbar2 = editorAdvancedToolbarButtons.join(',');
  },
  onReady: function onReady() {
    var _this = this;

    var $editor = jQuery(elementor.config.wp_editor.replace(/elementorwpeditor/g, this.editorID).replace('%%EDITORCONTENT%%', this.getControlValue()));
    this.ui.inputWrapper.html($editor);
    setTimeout(function () {
      if (!_this.isDestroyed && _this.editor) {
        _this.editor.on('keyup change undo redo', _this.saveEditor.bind(_this));
      }
    }, 100);
  },
  onBeforeDestroy: function onBeforeDestroy() {
    // Remove TinyMCE and QuickTags instances
    delete QTags.instances[this.editorID];

    if (!elementor.config.rich_editing_enabled) {
      return;
    }

    tinymce.EditorManager.execCommand('mceRemoveEditor', true, this.editorID); // Cleanup PreInit data

    delete tinyMCEPreInit.mceInit[this.editorID];
    delete tinyMCEPreInit.qtInit[this.editorID];
  }
});
module.exports = ControlWysiwygItemView;

/***/ }),
/* 421 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


module.exports = elementorModules.editor.elements.models.BaseSettings.extend({
  defaults: {
    _column_size: 100
  }
});

/***/ }),
/* 422 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var _interopRequireDefault = __webpack_require__(0);

__webpack_require__(15);

var _widgetDraggable = _interopRequireDefault(__webpack_require__(423));

var _widgetResizeable = _interopRequireDefault(__webpack_require__(424));

var BaseElementView = __webpack_require__(200),
    WidgetView;

WidgetView = BaseElementView.extend({
  _templateType: null,
  toggleEditTools: true,
  getTemplate: function getTemplate() {
    var editModel = this.getEditModel();

    if ('remote' !== this.getTemplateType()) {
      return Marionette.TemplateCache.get('#tmpl-elementor-' + editModel.get('widgetType') + '-content');
    }

    return _.template('');
  },
  className: function className() {
    var baseClasses = BaseElementView.prototype.className.apply(this, arguments);
    return baseClasses + ' elementor-widget ' + elementor.getElementData(this.getEditModel()).html_wrapper_class;
  },
  events: function events() {
    var events = BaseElementView.prototype.events.apply(this, arguments);
    events.click = 'onClickEdit';
    return events;
  },
  behaviors: function behaviors() {
    var behaviors = BaseElementView.prototype.behaviors.apply(this, arguments);

    _.extend(behaviors, {
      InlineEditing: {
        behaviorClass: __webpack_require__(425),
        inlineEditingClass: 'elementor-inline-editing'
      },
      Draggable: {
        behaviorClass: _widgetDraggable.default
      },
      Resizable: {
        behaviorClass: _widgetResizeable.default
      }
    });

    return elementor.hooks.applyFilters('elements/widget/behaviors', behaviors, this);
  },
  getEditButtons: function getEditButtons() {
    var elementData = elementor.getElementData(this.model),
        editTools = {};
    editTools.edit = {
      title: elementor.translate('edit_element', [elementData.title]),
      icon: 'edit'
    };

    if (elementor.getPreferences('edit_buttons')) {
      editTools.duplicate = {
        title: elementor.translate('duplicate_element', [elementData.title]),
        icon: 'clone'
      };
      editTools.remove = {
        title: elementor.translate('delete_element', [elementData.title]),
        icon: 'close'
      };
    }

    return editTools;
  },
  initialize: function initialize() {
    var _this = this;

    BaseElementView.prototype.initialize.apply(this, arguments);
    var editModel = this.getEditModel();
    editModel.on({
      'before:remote:render': this.onModelBeforeRemoteRender.bind(this),
      'remote:render': this.onModelRemoteRender.bind(this),
      'settings:loaded': function settingsLoaded() {
        return setTimeout(_this.render.bind(_this));
      }
    });

    if ('remote' === this.getTemplateType() && !this.getEditModel().getHtmlCache()) {
      editModel.renderRemoteServer();
    }

    var onRenderMethod = this.onRender;
    this.render = _.throttle(this.render, 300);

    this.onRender = function () {
      _.defer(onRenderMethod.bind(this));
    };
  },
  getContextMenuGroups: function getContextMenuGroups() {
    var groups = BaseElementView.prototype.getContextMenuGroups.apply(this, arguments),
        transferGroupIndex = groups.indexOf(_.findWhere(groups, {
      name: 'clipboard'
    }));
    groups.splice(transferGroupIndex + 1, 0, {
      name: 'save',
      actions: [{
        name: 'save',
        title: elementor.translate('save_as_global'),
        shortcut: jQuery('<i>', {
          class: 'eicon-pro-icon'
        })
      }]
    });
    return groups;
  },
  render: function render() {
    if (this.model.isRemoteRequestActive()) {
      this.handleEmptyWidget();
      this.$el.addClass('elementor-element');
      return;
    }

    if (elementorCommonConfig.isTesting && this.isDestroyed) {
      return;
    }

    Marionette.CompositeView.prototype.render.apply(this, arguments);
  },
  handleEmptyWidget: function handleEmptyWidget() {
    // TODO: REMOVE THIS !!
    // TEMP CODING !!
    this.$el.addClass('elementor-widget-empty').append('<i class="elementor-widget-empty-icon ' + this.getEditModel().getIcon() + '"></i>');
  },
  getTemplateType: function getTemplateType() {
    if (null === this._templateType) {
      var editModel = this.getEditModel(),
          $template = jQuery('#tmpl-elementor-' + editModel.get('widgetType') + '-content');
      this._templateType = $template.length ? 'js' : 'remote';
    }

    return this._templateType;
  },
  getHTMLContent: function getHTMLContent(html) {
    var htmlCache = this.getEditModel().getHtmlCache();
    return htmlCache || html;
  },
  attachElContent: function attachElContent(html) {
    var _this2 = this;

    _.defer(function () {
      elementorFrontend.elements.window.jQuery(_this2.el).empty().append(_this2.getHandlesOverlay(), _this2.getHTMLContent(html));

      _this2.bindUIElements(); // Build again the UI elements since the content attached just now

    });

    return this;
  },
  addInlineEditingAttributes: function addInlineEditingAttributes(key, toolbar) {
    this.addRenderAttribute(key, {
      class: 'elementor-inline-editing',
      'data-elementor-setting-key': key
    });

    if (toolbar) {
      this.addRenderAttribute(key, {
        'data-elementor-inline-editing-toolbar': toolbar
      });
    }
  },
  getRepeaterSettingKey: function getRepeaterSettingKey(settingKey, repeaterKey, repeaterItemIndex) {
    return [repeaterKey, repeaterItemIndex, settingKey].join('.');
  },
  onModelBeforeRemoteRender: function onModelBeforeRemoteRender() {
    this.$el.addClass('elementor-loading');
  },
  onBeforeDestroy: function onBeforeDestroy() {
    // Remove old style from the DOM.
    elementor.$previewContents.find('#elementor-style-' + this.model.cid).remove();
  },
  onModelRemoteRender: function onModelRemoteRender() {
    if (this.isDestroyed) {
      return;
    }

    this.$el.removeClass('elementor-loading');
    this.render();
  },
  onRender: function onRender() {
    var self = this;
    BaseElementView.prototype.onRender.apply(self, arguments);
    var editModel = self.getEditModel(),
        skinType = editModel.getSetting('_skin') || 'default';
    self.$el.attr('data-widget_type', editModel.get('widgetType') + '.' + skinType).removeClass('elementor-widget-empty').children('.elementor-widget-empty-icon').remove(); // TODO: Find a better way to detect if all the images have been loaded

    self.$el.imagesLoaded().always(function () {
      setTimeout(function () {
        if (1 > self.$el.children('.elementor-widget-container').outerHeight()) {
          self.handleEmptyWidget();
        }
      }, 200); // Is element empty?
    });
  },
  onClickEdit: function onClickEdit() {
    this.model.trigger('request:edit');
  }
});
module.exports = WidgetView;

/***/ }),
/* 423 */
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

var _possibleConstructorReturn2 = _interopRequireDefault(__webpack_require__(5));

var _getPrototypeOf2 = _interopRequireDefault(__webpack_require__(4));

var _get2 = _interopRequireDefault(__webpack_require__(28));

var _inherits2 = _interopRequireDefault(__webpack_require__(6));

var _default =
/*#__PURE__*/
function (_Marionette$Behavior) {
  (0, _inherits2.default)(_default, _Marionette$Behavior);

  function _default() {
    (0, _classCallCheck2.default)(this, _default);
    return (0, _possibleConstructorReturn2.default)(this, (0, _getPrototypeOf2.default)(_default).apply(this, arguments));
  }

  (0, _createClass2.default)(_default, [{
    key: "events",
    value: function events() {
      return {
        dragstart: 'onDragStart',
        dragstop: 'onDragStop'
      };
    }
  }, {
    key: "initialize",
    value: function initialize() {
      (0, _get2.default)((0, _getPrototypeOf2.default)(_default.prototype), "initialize", this).call(this);
      this.listenTo(elementor.channels.dataEditMode, 'switch', this.toggle); // Save this instance for external use eg: ( hooks ).

      this.view.options.draggable = this;
    }
  }, {
    key: "activate",
    value: function activate() {
      this.$el.draggable({
        addClasses: false
      });
    }
  }, {
    key: "deactivate",
    value: function deactivate() {
      if (!this.$el.draggable('instance')) {
        return;
      }

      this.$el.draggable('destroy');
    }
  }, {
    key: "toggle",
    value: function toggle() {
      var isEditMode = 'edit' === elementor.channels.dataEditMode.request('activeMode'),
          isAbsolute = this.view.getEditModel().getSetting('_position');
      this.deactivate();

      if (isEditMode && isAbsolute && elementor.userCan('design')) {
        this.activate();
      }
    }
  }, {
    key: "onRender",
    value: function onRender() {
      var _this = this;

      _.defer(function () {
        return _this.toggle();
      });
    }
  }, {
    key: "onDestroy",
    value: function onDestroy() {
      this.deactivate();
    }
  }, {
    key: "onDragStart",
    value: function onDragStart(event) {
      event.stopPropagation();
      this.view.model.trigger('request:edit');
    }
  }, {
    key: "onDragStop",
    value: function onDragStop(event, ui) {
      var _this2 = this;

      event.stopPropagation();
      var currentDeviceMode = elementorFrontend.getCurrentDeviceMode(),
          deviceSuffix = 'desktop' === currentDeviceMode ? '' : '_' + currentDeviceMode,
          editModel = this.view.getEditModel(),
          hOrientation = editModel.getSetting('_offset_orientation_h'),
          vOrientation = editModel.getSetting('_offset_orientation_v'),
          settingToChange = {},
          isRTL = elementorFrontend.config.is_rtl;
      var parentWidth = this.$el.offsetParent().width(),
          elementWidth = this.$el.outerWidth(true),
          left = ui.position.left,
          right = parentWidth - left - elementWidth;
      var xPos = isRTL ? right : left,
          yPos = ui.position.top,
          offsetX = '_offset_x',
          offsetY = '_offset_y';

      if ('end' === hOrientation) {
        xPos = parentWidth - xPos - elementWidth;
        offsetX = '_offset_x_end';
      }

      var offsetXUnit = editModel.getSetting(offsetX + deviceSuffix).unit;
      xPos = elementor.helpers.elementSizeToUnit(this.$el, xPos, offsetXUnit);
      var parentHeight = this.$el.offsetParent().height(),
          elementHeight = this.$el.outerHeight(true);

      if ('end' === vOrientation) {
        yPos = parentHeight - yPos - elementHeight;
        offsetY = '_offset_y_end';
      }

      var offsetYUnit = editModel.getSetting(offsetY + deviceSuffix).unit;
      yPos = elementor.helpers.elementSizeToUnit(this.$el, yPos, offsetYUnit);
      settingToChange[offsetX + deviceSuffix] = {
        size: xPos,
        unit: offsetXUnit
      };
      settingToChange[offsetY + deviceSuffix] = {
        size: yPos,
        unit: offsetYUnit
      };
      $e.run('document/elements/settings', {
        container: this.view.container,
        settings: settingToChange,
        options: {
          external: true
        }
      });
      setTimeout(function () {
        _this2.$el.css({
          top: '',
          left: '',
          right: '',
          bottom: '',
          width: '',
          height: ''
        });
      }, 250);
    }
  }]);
  return _default;
}(Marionette.Behavior);

exports.default = _default;

/***/ }),
/* 424 */
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

var _possibleConstructorReturn2 = _interopRequireDefault(__webpack_require__(5));

var _getPrototypeOf2 = _interopRequireDefault(__webpack_require__(4));

var _get2 = _interopRequireDefault(__webpack_require__(28));

var _inherits2 = _interopRequireDefault(__webpack_require__(6));

var _default =
/*#__PURE__*/
function (_Marionette$Behavior) {
  (0, _inherits2.default)(_default, _Marionette$Behavior);

  function _default() {
    (0, _classCallCheck2.default)(this, _default);
    return (0, _possibleConstructorReturn2.default)(this, (0, _getPrototypeOf2.default)(_default).apply(this, arguments));
  }

  (0, _createClass2.default)(_default, [{
    key: "events",
    value: function events() {
      return {
        resizestart: 'onResizeStart',
        resizestop: 'onResizeStop',
        resize: 'onResize'
      };
    }
  }, {
    key: "initialize",
    value: function initialize() {
      (0, _get2.default)((0, _getPrototypeOf2.default)(_default.prototype), "initialize", this).call(this);
      this.listenTo(elementor.channels.dataEditMode, 'switch', this.toggle); // Save this instance for external use eg: ( hooks ).

      this.view.options.resizeable = this;
    }
  }, {
    key: "activate",
    value: function activate() {
      this.$el.resizable({
        handles: 'e, w'
      });
    }
  }, {
    key: "deactivate",
    value: function deactivate() {
      if (!this.$el.resizable('instance')) {
        return;
      }

      this.$el.resizable('destroy');
    }
  }, {
    key: "toggle",
    value: function toggle() {
      var editModel = this.view.getEditModel(),
          isEditMode = 'edit' === elementor.channels.dataEditMode.request('activeMode'),
          isAbsolute = editModel.getSetting('_position'),
          isInline = 'initial' === editModel.getSetting('_element_width');
      this.deactivate();

      if (isEditMode && (isAbsolute || isInline) && elementor.userCan('design')) {
        this.activate();
      }
    }
  }, {
    key: "onRender",
    value: function onRender() {
      var _this = this;

      _.defer(function () {
        return _this.toggle();
      });
    }
  }, {
    key: "onDestroy",
    value: function onDestroy() {
      this.deactivate();
    }
  }, {
    key: "onResizeStart",
    value: function onResizeStart(event) {
      event.stopPropagation();
      this.view.model.trigger('request:edit');
    }
  }, {
    key: "onResizeStop",
    value: function onResizeStop(event, ui) {
      event.stopPropagation();
      var currentDeviceMode = elementorFrontend.getCurrentDeviceMode(),
          deviceSuffix = 'desktop' === currentDeviceMode ? '' : '_' + currentDeviceMode,
          editModel = this.view.getEditModel(),
          unit = editModel.getSetting('_element_custom_width' + deviceSuffix).unit,
          width = elementor.helpers.elementSizeToUnit(this.$el, ui.size.width, unit),
          settingToChange = {};
      settingToChange['_element_width' + deviceSuffix] = 'initial';
      settingToChange['_element_custom_width' + deviceSuffix] = {
        unit: unit,
        size: width
      };
      editModel.get('settings').setExternalChange(settingToChange);
      this.$el.css({
        width: '',
        height: ''
      });
    }
  }, {
    key: "onResize",
    value: function onResize(event) {
      event.stopPropagation();
    }
  }]);
  return _default;
}(Marionette.Behavior);

exports.default = _default;

/***/ }),
/* 425 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var _interopRequireDefault = __webpack_require__(0);

var _defineProperty2 = _interopRequireDefault(__webpack_require__(69));

__webpack_require__(68);

var InlineEditingBehavior;
InlineEditingBehavior = Marionette.Behavior.extend({
  editing: false,
  $currentEditingArea: null,
  ui: function ui() {
    return {
      inlineEditingArea: '.' + this.getOption('inlineEditingClass')
    };
  },
  events: function events() {
    return {
      'click @ui.inlineEditingArea': 'onInlineEditingClick',
      'input @ui.inlineEditingArea': 'onInlineEditingUpdate'
    };
  },
  initialize: function initialize() {
    this.onInlineEditingBlur = this.onInlineEditingBlur.bind(this);
  },
  getEditingSettingKey: function getEditingSettingKey() {
    return this.$currentEditingArea.data().elementorSettingKey;
  },
  startEditing: function startEditing($element) {
    if (this.editing || 'edit' !== elementor.channels.dataEditMode.request('activeMode') || this.view.model.isRemoteRequestActive()) {
      return;
    }

    var elementorSettingKey = $element.data().elementorSettingKey,
        settingKey = elementorSettingKey,
        keyParts = elementorSettingKey.split('.'),
        isRepeaterKey = 3 === keyParts.length,
        settingsModel = this.view.getEditModel().get('settings');

    if (isRepeaterKey) {
      settingsModel = settingsModel.get(keyParts[0]).models[keyParts[1]];
      settingKey = keyParts[2];
    }

    var dynamicSettings = settingsModel.get('__dynamic__'),
        isDynamic = dynamicSettings && dynamicSettings[settingKey];

    if (isDynamic) {
      return;
    }

    this.$currentEditingArea = $element;
    var elementData = this.$currentEditingArea.data(),
        elementDataToolbar = elementData.elementorInlineEditingToolbar,
        mode = 'advanced' === elementDataToolbar ? 'advanced' : 'basic',
        editModel = this.view.getEditModel(),
        inlineEditingConfig = elementor.config.inlineEditing,
        contentHTML = editModel.getSetting(this.getEditingSettingKey());

    if ('advanced' === mode) {
      contentHTML = wp.editor.autop(contentHTML);
    }
    /**
     *  Replace rendered content with unrendered content.
     *  This way the user can edit the original content, before shortcodes and oEmbeds are fired.
     */


    this.$currentEditingArea.html(contentHTML);
    var ElementorInlineEditor = elementorFrontend.elements.window.ElementorInlineEditor;
    this.editing = true;
    this.view.allowRender = false; // Avoid retrieving of old content (e.g. in case of sorting)

    this.view.model.setHtmlCache('');
    this.editor = new ElementorInlineEditor({
      linksInNewWindow: true,
      stay: false,
      editor: this.$currentEditingArea[0],
      mode: mode,
      list: 'none' === elementDataToolbar ? [] : inlineEditingConfig.toolbar[elementDataToolbar || 'basic'],
      cleanAttrs: ['id', 'class', 'name'],
      placeholder: elementor.translate('type_here') + '...',
      toolbarIconsPrefix: 'eicon-editor-',
      toolbarIconsDictionary: {
        externalLink: {
          className: 'eicon-editor-external-link'
        },
        list: {
          className: 'eicon-editor-list-ul'
        },
        insertOrderedList: {
          className: 'eicon-editor-list-ol'
        },
        insertUnorderedList: {
          className: 'eicon-editor-list-ul'
        },
        createlink: {
          className: 'eicon-editor-link'
        },
        unlink: {
          className: 'eicon-editor-unlink'
        },
        blockquote: {
          className: 'eicon-editor-quote'
        },
        p: {
          className: 'eicon-editor-paragraph'
        },
        pre: {
          className: 'eicon-editor-code'
        }
      }
    });
    var $menuItems = jQuery(this.editor._menu).children();
    /**
     * When the edit area is not focused (on blur) the inline editing is stopped.
     * In order to prevent blur event when the user clicks on toolbar buttons while editing the
     * content, we need the prevent their mousedown event. This also prevents the blur event.
     */

    $menuItems.on('mousedown', function (event) {
      event.preventDefault();
    });
    this.$currentEditingArea.on('blur', this.onInlineEditingBlur);
    elementorCommon.elements.$body.on('mousedown', this.onInlineEditingBlur);
  },
  stopEditing: function stopEditing() {
    this.editing = false;
    this.$currentEditingArea.off('blur', this.onInlineEditingBlur);
    elementorCommon.elements.$body.off('mousedown', this.onInlineEditingBlur);
    this.editor.destroy();
    this.view.allowRender = true;
  },
  onInlineEditingClick: function onInlineEditingClick(event) {
    var self = this,
        $targetElement = jQuery(event.currentTarget);
    /**
     * When starting inline editing we need to set timeout, this allows other inline items to finish
     * their operations before focusing new editing area.
     */

    setTimeout(function () {
      self.startEditing($targetElement);
    }, 30);
  },
  onInlineEditingBlur: function onInlineEditingBlur(event) {
    var _this = this;

    if ('mousedown' === event.type) {
      this.stopEditing();
      return;
    }
    /**
     * When exiting inline editing we need to set timeout, to make sure there is no focus on internal
     * toolbar action. This prevent the blur and allows the user to continue the inline editing.
     */


    setTimeout(function () {
      var selection = elementorFrontend.elements.window.getSelection(),
          $focusNode = jQuery(selection.focusNode);

      if ($focusNode.closest('.pen-input-wrapper').length) {
        return;
      }

      _this.stopEditing();
    }, 20);
  },
  onInlineEditingUpdate: function onInlineEditingUpdate() {
    var key = this.getEditingSettingKey(),
        container = this.view.getContainer();
    var parts = key.split('.'); // Is it repeater?

    if (3 === parts.length) {
      container = container.children[parts[1]];
      key = parts[2];
    }

    $e.run('document/elements/settings', {
      container: container,
      settings: (0, _defineProperty2.default)({}, key, this.editor.getContent()),
      options: {
        external: true
      }
    });
  }
});
module.exports = InlineEditingBehavior;

/***/ }),
/* 426 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var PanelElementsElementsView;
PanelElementsElementsView = Marionette.CollectionView.extend({
  childView: __webpack_require__(274),
  id: 'elementor-panel-elements',
  initialize: function initialize() {
    this.listenTo(elementor.channels.panelElements, 'filter:change', this.onFilterChanged);
  },
  filter: function filter(childModel) {
    var filterValue = elementor.channels.panelElements.request('filter:value');

    if (!filterValue) {
      return true;
    }

    if (-1 !== childModel.get('title').toLowerCase().indexOf(filterValue.toLowerCase())) {
      return true;
    }

    return _.any(childModel.get('keywords'), function (keyword) {
      return -1 !== keyword.toLowerCase().indexOf(filterValue.toLowerCase());
    });
  },
  onFilterChanged: function onFilterChanged() {
    var filterValue = elementor.channels.panelElements.request('filter:value');

    if (!filterValue) {
      this.onFilterEmpty();
    }

    this._renderChildren();

    this.triggerMethod('children:render');
  },
  onFilterEmpty: function onFilterEmpty() {
    $e.routes.refreshContainer('panel');
  }
});
module.exports = PanelElementsElementsView;

/***/ }),
/* 427 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var PanelMenuGroupView = __webpack_require__(428),
    PanelMenuPageView;

PanelMenuPageView = Marionette.CompositeView.extend({
  id: 'elementor-panel-page-menu',
  template: '#tmpl-elementor-panel-menu',
  childView: PanelMenuGroupView,
  childViewContainer: '#elementor-panel-page-menu-content',
  initialize: function initialize() {
    this.collection = PanelMenuPageView.getGroups();
  },
  getArrowClass: function getArrowClass() {
    return 'eicon-arrow-' + (elementorCommon.config.isRTL ? 'right' : 'left');
  },
  onRender: function onRender() {
    elementor.getPanelView().getHeaderView().ui.menuIcon.removeClass('eicon-menu-bar').addClass(this.getArrowClass());
  },
  onDestroy: function onDestroy() {
    elementor.getPanelView().getHeaderView().ui.menuIcon.removeClass(this.getArrowClass()).addClass('eicon-menu-bar');
  }
}, {
  groups: null,
  initGroups: function initGroups() {
    this.groups = new Backbone.Collection([]);
    this.groups.add({
      name: 'more',
      title: elementor.translate('more'),
      items: []
    });
    this.addItem({
      name: 'editor-preferences',
      icon: 'eicon-preferences',
      title: elementor.translate('preferences'),
      type: 'page',
      callback: function callback() {
        return $e.route('panel/editor-preferences');
      }
    }, 'more');
    this.addItem({
      name: 'view-page',
      icon: 'eicon-preview',
      title: elementor.translate('view_page'),
      type: 'link',
      link: elementor.config.document.urls.permalink
    }, 'more');
    this.addItem({
      name: 'exit-to-dashboard',
      icon: 'eicon-wordpress',
      title: elementor.translate('exit_to_dashboard'),
      type: 'link',
      link: elementor.config.document.urls.exit_to_dashboard
    }, 'more');

    if (elementor.config.user.is_administrator) {
      this.addAdminMenu();
    }
  },
  addAdminMenu: function addAdminMenu() {
    this.groups.add({
      name: 'style',
      title: elementor.translate('global_style'),
      items: []
    }, {
      at: 0
    });
    this.groups.add({
      name: 'settings',
      title: elementor.translate('settings'),
      items: []
    }, {
      at: 1
    });
    this.addItem({
      name: 'finder',
      icon: 'eicon-search-bold',
      title: elementorCommon.translate('finder', 'finder'),
      callback: function callback() {
        return $e.route('finder');
      }
    }, 'more', 'view-page');
    this.addItem({
      name: 'global-colors',
      icon: 'eicon-paint-brush',
      title: elementor.translate('global_colors'),
      type: 'page',
      callback: function callback() {
        return $e.route('panel/global-colors');
      }
    }, 'style');
    this.addItem({
      name: 'global-fonts',
      icon: 'eicon-font',
      title: elementor.translate('global_fonts'),
      type: 'page',
      callback: function callback() {
        return $e.route('panel/global-fonts');
      }
    }, 'style');
    this.addItem({
      name: 'global-settings',
      icon: 'eicon-cogs',
      title: elementor.translate('global_settings'),
      type: 'page',
      callback: function callback() {
        return $e.route('panel/general-settings/style');
      }
    }, 'settings', 'elementor-settings');
    this.addItem({
      name: 'elementor-settings',
      icon: 'eicon-editor-external-link',
      title: elementor.translate('elementor_settings'),
      type: 'link',
      link: elementor.config.settings_page_link,
      newTab: true
    }, 'settings');
    this.addItem({
      name: 'about-elementor',
      icon: 'eicon-info-circle',
      title: elementor.translate('about_elementor'),
      type: 'link',
      link: elementor.config.elementor_site,
      newTab: true
    }, 'settings');
  },
  getGroups: function getGroups() {
    if (!this.groups) {
      this.initGroups();
    }

    return this.groups;
  },
  addItem: function addItem(itemData, groupName, before) {
    var group = this.getGroups().findWhere({
      name: groupName
    });

    if (!group) {
      return;
    }

    var items = group.get('items'),
        beforeItem;

    if (before) {
      beforeItem = _.findWhere(items, {
        name: before
      });
    }

    if (beforeItem) {
      items.splice(items.indexOf(beforeItem), 0, itemData);
    } else {
      items.push(itemData);
    }
  }
});
module.exports = PanelMenuPageView;

/***/ }),
/* 428 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var PanelMenuItemView = __webpack_require__(429);

module.exports = Marionette.CompositeView.extend({
  template: '#tmpl-elementor-panel-menu-group',
  className: 'elementor-panel-menu-group',
  childView: PanelMenuItemView,
  childViewContainer: '.elementor-panel-menu-items',
  initialize: function initialize() {
    this.collection = new Backbone.Collection(this.model.get('items'));
  },
  onChildviewClick: function onChildviewClick(childView) {
    var callback = childView.model.get('callback');

    if (_.isFunction(callback)) {
      callback.call(childView);
    }
  }
});

/***/ }),
/* 429 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


module.exports = Marionette.ItemView.extend({
  template: '#tmpl-elementor-panel-menu-item',
  className: function className() {
    return 'elementor-panel-menu-item elementor-panel-menu-item-' + this.model.get('name');
  },
  triggers: {
    click: {
      event: 'click',
      preventDefault: false
    }
  }
});

/***/ }),
/* 430 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var _interopRequireDefault = __webpack_require__(0);

__webpack_require__(85);

__webpack_require__(30);

__webpack_require__(48);

var _keys = _interopRequireDefault(__webpack_require__(27));

var _stringify = _interopRequireDefault(__webpack_require__(175));

module.exports = elementorModules.Module.extend({
  CACHE_KEY_NOT_FOUND_ERROR: 'Cache key not found',
  tags: {
    Base: __webpack_require__(431)
  },
  cache: {},
  cacheRequests: {},
  cacheCallbacks: [],
  addCacheRequest: function addCacheRequest(tag) {
    this.cacheRequests[this.createCacheKey(tag)] = true;
  },
  createCacheKey: function createCacheKey(tag) {
    return btoa(tag.getOption('name')) + '-' + btoa(encodeURIComponent((0, _stringify.default)(tag.model)));
  },
  loadTagDataFromCache: function loadTagDataFromCache(tag) {
    var cacheKey = this.createCacheKey(tag);

    if (undefined !== this.cache[cacheKey]) {
      return this.cache[cacheKey];
    }

    if (!this.cacheRequests[cacheKey]) {
      this.addCacheRequest(tag);
    }
  },
  loadCacheRequests: function loadCacheRequests() {
    var cache = this.cache,
        cacheRequests = this.cacheRequests,
        cacheCallbacks = this.cacheCallbacks;
    this.cacheRequests = {};
    this.cacheCallbacks = [];
    elementorCommon.ajax.addRequest('render_tags', {
      data: {
        post_id: elementor.config.document.id,
        tags: (0, _keys.default)(cacheRequests)
      },
      success: function success(data) {
        jQuery.extend(cache, data);
        cacheCallbacks.forEach(function (callback) {
          callback();
        });
      }
    });
  },
  refreshCacheFromServer: function refreshCacheFromServer(callback) {
    this.cacheCallbacks.push(callback);
    this.loadCacheRequests();
  },
  getConfig: function getConfig(key) {
    return this.getItems(elementor.config.dynamicTags, key);
  },
  parseTagsText: function parseTagsText(text, settings, parseCallback) {
    var self = this;

    if ('object' === settings.returnType) {
      return self.parseTagText(text, settings, parseCallback);
    }

    return text.replace(/\[elementor-tag[^\]]+]/g, function (tagText) {
      return self.parseTagText(tagText, settings, parseCallback);
    });
  },
  parseTagText: function parseTagText(tagText, settings, parseCallback) {
    var tagData = this.tagTextToTagData(tagText);

    if (!tagData) {
      if ('object' === settings.returnType) {
        return {};
      }

      return '';
    }

    return parseCallback(tagData.id, tagData.name, tagData.settings);
  },
  tagTextToTagData: function tagTextToTagData(tagText) {
    var tagIDMatch = tagText.match(/id="(.*?(?="))"/),
        tagNameMatch = tagText.match(/name="(.*?(?="))"/),
        tagSettingsMatch = tagText.match(/settings="(.*?(?="]))/);

    if (!tagIDMatch || !tagNameMatch || !tagSettingsMatch) {
      return false;
    }

    return {
      id: tagIDMatch[1],
      name: tagNameMatch[1],
      settings: JSON.parse(decodeURIComponent(tagSettingsMatch[1]))
    };
  },
  createTag: function createTag(tagID, tagName, tagSettings) {
    var tagConfig = this.getConfig('tags.' + tagName);

    if (!tagConfig) {
      return;
    }

    var TagClass = this.tags[tagName] || this.tags.Base,
        model = new elementorModules.editor.elements.models.BaseSettings(tagSettings, {
      controls: tagConfig.controls
    });
    return new TagClass({
      id: tagID,
      name: tagName,
      model: model
    });
  },
  getTagDataContent: function getTagDataContent(tagID, tagName, tagSettings) {
    var tag = this.createTag(tagID, tagName, tagSettings);

    if (!tag) {
      return;
    }

    return tag.getContent();
  },
  tagDataToTagText: function tagDataToTagText(tagID, tagName, tagSettings) {
    tagSettings = encodeURIComponent((0, _stringify.default)(tagSettings && tagSettings.toJSON({
      remove: ['default']
    }) || {}));
    return '[elementor-tag id="' + tagID + '" name="' + tagName + '" settings="' + tagSettings + '"]';
  },
  tagContainerToTagText: function tagContainerToTagText(
  /**Container*/
  container) {
    return elementor.dynamicTags.tagDataToTagText(container.view.getOption('id'), container.view.getOption('name'), container.view.model);
  },
  cleanCache: function cleanCache() {
    this.cache = {};
  },
  onInit: function onInit() {
    this.loadCacheRequests = _.debounce(this.loadCacheRequests, 300);
  }
});

/***/ }),
/* 431 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


module.exports = Marionette.ItemView.extend({
  hasTemplate: true,
  tagName: 'span',
  className: function className() {
    return 'elementor-tag';
  },
  getTemplate: function getTemplate() {
    if (!this.hasTemplate) {
      return false;
    }

    return Marionette.TemplateCache.get('#tmpl-elementor-tag-' + this.getOption('name') + '-content');
  },
  initialize: function initialize() {
    try {
      this.getTemplate();
    } catch (e) {
      this.hasTemplate = false;
    }
  },
  getConfig: function getConfig(key) {
    var config = elementor.dynamicTags.getConfig('tags.' + this.getOption('name'));

    if (key) {
      return config[key];
    }

    return config;
  },
  getContent: function getContent() {
    var contentType = this.getConfig('content_type'),
        data;

    if (!this.hasTemplate) {
      data = elementor.dynamicTags.loadTagDataFromCache(this);

      if (undefined === data) {
        throw new Error(elementor.dynamicTags.CACHE_KEY_NOT_FOUND_ERROR);
      }
    }

    if ('ui' === contentType) {
      this.render();

      if (this.hasTemplate) {
        return this.el.outerHTML;
      }

      if (this.getConfig('wrapped_tag')) {
        data = jQuery(data).html();
      }

      this.$el.html(data);
    }

    return data;
  },
  onRender: function onRender() {
    this.el.id = 'elementor-tag-' + this.getOption('id');
  }
});

/***/ }),
/* 432 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var _interopRequireDefault = __webpack_require__(0);

var _manager = _interopRequireDefault(__webpack_require__(433));

module.exports = elementorModules.Module.extend({
  modules: {
    base: __webpack_require__(223),
    general: __webpack_require__(434),
    page: __webpack_require__(436),
    editorPreferences: _manager.default
  },
  panelPages: {
    base: __webpack_require__(438)
  },
  onInit: function onInit() {
    this.initSettings();
  },
  initSettings: function initSettings() {
    var self = this;

    _.each(elementor.config.settings, function (config, name) {
      var Manager = self.modules[name] || self.modules.base;
      self[name] = new Manager(config);
    });
  }
});

/***/ }),
/* 433 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var _interopRequireDefault = __webpack_require__(0);

var _Object$defineProperty = __webpack_require__(1);

_Object$defineProperty(exports, "__esModule", {
  value: true
});

exports.default = void 0;

var _classCallCheck2 = _interopRequireDefault(__webpack_require__(2));

var _possibleConstructorReturn2 = _interopRequireDefault(__webpack_require__(5));

var _getPrototypeOf3 = _interopRequireDefault(__webpack_require__(4));

var _createClass2 = _interopRequireDefault(__webpack_require__(3));

var _inherits2 = _interopRequireDefault(__webpack_require__(6));

var _manager = _interopRequireDefault(__webpack_require__(223));

var _default =
/*#__PURE__*/
function (_BaseManager) {
  (0, _inherits2.default)(_default, _BaseManager);
  (0, _createClass2.default)(_default, [{
    key: "getDefaultSettings",
    value: function getDefaultSettings() {
      return {
        darkModeLinkID: 'elementor-editor-dark-mode-css'
      };
    }
  }]);

  function _default() {
    var _getPrototypeOf2;

    var _this;

    (0, _classCallCheck2.default)(this, _default);

    for (var _len = arguments.length, args = new Array(_len), _key = 0; _key < _len; _key++) {
      args[_key] = arguments[_key];
    }

    _this = (0, _possibleConstructorReturn2.default)(this, (_getPrototypeOf2 = (0, _getPrototypeOf3.default)(_default)).call.apply(_getPrototypeOf2, [this].concat(args)));
    _this.changeCallbacks = {
      ui_theme: _this.onUIThemeChanged,
      edit_buttons: _this.onEditButtonsChanged
    };
    return _this;
  }

  (0, _createClass2.default)(_default, [{
    key: "createDarkModeStylesheetLink",
    value: function createDarkModeStylesheetLink() {
      var darkModeLinkID = this.getSettings('darkModeLinkID');
      var $darkModeLink = jQuery('#' + darkModeLinkID);

      if (!$darkModeLink.length) {
        $darkModeLink = jQuery('<link>', {
          id: darkModeLinkID,
          rel: 'stylesheet',
          href: elementor.config.ui.darkModeStylesheetURL
        });
      }

      this.$link = $darkModeLink;
    }
  }, {
    key: "getDarkModeStylesheetLink",
    value: function getDarkModeStylesheetLink() {
      if (!this.$link) {
        this.createDarkModeStylesheetLink();
      }

      return this.$link;
    }
  }, {
    key: "onUIThemeChanged",
    value: function onUIThemeChanged(newValue) {
      var $link = this.getDarkModeStylesheetLink();

      if ('light' === newValue) {
        $link.remove();
        return;
      }

      $link.attr('media', 'auto' === newValue ? '(prefers-color-scheme: dark)' : '').appendTo(elementorCommon.elements.$body);
    }
  }, {
    key: "onEditButtonsChanged",
    value: function onEditButtonsChanged() {
      // Let the button change before the high-performance action of rendering the entire page
      setTimeout(function () {
        return elementor.getPreviewView().render();
      }, 300);
    }
  }]);
  return _default;
}(_manager.default);

exports.default = _default;

/***/ }),
/* 434 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var _interopRequireDefault = __webpack_require__(0);

var _component = _interopRequireDefault(__webpack_require__(435));

var BaseSettings = __webpack_require__(223);

module.exports = BaseSettings.extend({
  onInit: function onInit() {
    BaseSettings.prototype.onInit.apply(this);
    $e.components.register(new _component.default({
      manager: this
    }));
  },
  changeCallbacks: {
    elementor_page_title_selector: function elementor_page_title_selector(newValue) {
      var newSelector = newValue || 'h1.entry-title',
          titleSelectors = elementor.settings.page.model.controls.hide_title.selectors = {};
      titleSelectors[newSelector] = 'display: none';
      elementor.settings.page.updateStylesheet();
    }
  },
  getContainerId: function getContainerId() {
    return 'general_settings';
  }
});

/***/ }),
/* 435 */
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

var _possibleConstructorReturn2 = _interopRequireDefault(__webpack_require__(5));

var _getPrototypeOf2 = _interopRequireDefault(__webpack_require__(4));

var _inherits2 = _interopRequireDefault(__webpack_require__(6));

var _component = _interopRequireDefault(__webpack_require__(64));

var Component =
/*#__PURE__*/
function (_BaseComponent) {
  (0, _inherits2.default)(Component, _BaseComponent);

  function Component() {
    (0, _classCallCheck2.default)(this, Component);
    return (0, _possibleConstructorReturn2.default)(this, (0, _getPrototypeOf2.default)(Component).apply(this, arguments));
  }

  (0, _createClass2.default)(Component, [{
    key: "getNamespace",
    value: function getNamespace() {
      return 'panel/general-settings';
    }
  }, {
    key: "defaultTabs",
    value: function defaultTabs() {
      return {
        style: {
          title: elementor.translate('style')
        },
        lightbox: {
          title: elementor.translate('lightbox')
        }
      };
    }
  }, {
    key: "renderTab",
    value: function renderTab(tab) {
      elementor.getPanelView().setPage('general_settings').activateTab(tab);
    }
  }]);
  return Component;
}(_component.default);

exports.default = Component;

/***/ }),
/* 436 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var _interopRequireDefault = __webpack_require__(0);

__webpack_require__(15);

var _component = _interopRequireDefault(__webpack_require__(437));

var BaseSettings = __webpack_require__(223);

module.exports = BaseSettings.extend({
  onInit: function onInit() {
    BaseSettings.prototype.onInit.apply(this);
    $e.components.register(new _component.default({
      manager: this
    }));
  },
  save: function save() {},
  changeCallbacks: {
    post_title: function post_title(newValue) {
      var $title = elementorFrontend.elements.$document.find(elementor.config.page_title_selector);
      $title.text(newValue);
    },
    template: function template() {
      elementor.saver.saveAutoSave({
        onSuccess: function onSuccess() {
          elementor.reloadPreview();
          elementor.once('preview:loaded', function () {
            $e.route('panel/page-settings/settings');
          });
        }
      });
    }
  },
  onModelChange: function onModelChange() {
    elementor.saver.setFlagEditorChange(true);
    BaseSettings.prototype.onModelChange.apply(this, arguments);
  },
  getDataToSave: function getDataToSave(data) {
    data.id = elementor.config.document.id;
    return data;
  },
  // Emulate an element view/model structure with the parts needed for a container.
  getEditedView: function getEditedView() {
    var id = this.getContainerId(),
        editModel = new Backbone.Model({
      id: id,
      elType: id,
      settings: this.model,
      elements: elementor.elements
    });
    var container = new elementorModules.editor.Container({
      type: id,
      id: editModel.id,
      model: editModel,
      settings: editModel.get('settings'),
      view: elementor.getPreviewView(),
      label: elementor.config.document.panel.title,
      controls: this.model.controls,
      renderer: false,
      children: elementor.elements
    });
    return {
      getContainer: function getContainer() {
        return container;
      },
      getEditModel: function getEditModel() {
        return editModel;
      },
      model: editModel
    };
  },
  getContainerId: function getContainerId() {
    return 'document';
  }
});

/***/ }),
/* 437 */
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

var _possibleConstructorReturn2 = _interopRequireDefault(__webpack_require__(5));

var _getPrototypeOf2 = _interopRequireDefault(__webpack_require__(4));

var _inherits2 = _interopRequireDefault(__webpack_require__(6));

var _component = _interopRequireDefault(__webpack_require__(64));

var Component =
/*#__PURE__*/
function (_BaseComponent) {
  (0, _inherits2.default)(Component, _BaseComponent);

  function Component() {
    (0, _classCallCheck2.default)(this, Component);
    return (0, _possibleConstructorReturn2.default)(this, (0, _getPrototypeOf2.default)(Component).apply(this, arguments));
  }

  (0, _createClass2.default)(Component, [{
    key: "getNamespace",
    value: function getNamespace() {
      return 'panel/page-settings';
    }
  }, {
    key: "defaultTabs",
    value: function defaultTabs() {
      return {
        settings: {
          title: elementor.translate('settings')
        },
        style: {
          title: elementor.translate('style')
        },
        advanced: {
          title: elementor.translate('advanced')
        }
      };
    }
  }, {
    key: "renderTab",
    value: function renderTab(tab) {
      elementor.getPanelView().setPage('page_settings').activateTab(tab);
    }
  }, {
    key: "getTabsWrapperSelector",
    value: function getTabsWrapperSelector() {
      return '.elementor-panel-navigation';
    }
  }]);
  return Component;
}(_component.default);

exports.default = Component;

/***/ }),
/* 438 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


module.exports = elementorModules.editor.views.ControlsStack.extend({
  id: function id() {
    return 'elementor-panel-' + this.getOption('name') + '-settings';
  },
  getTemplate: function getTemplate() {
    return '#tmpl-elementor-panel-' + this.getOption('name') + '-settings';
  },
  childViewContainer: function childViewContainer() {
    return '#elementor-panel-' + this.getOption('name') + '-settings-controls';
  },
  childViewOptions: function childViewOptions() {
    return {
      container: this.getOption('editedView').getContainer()
    };
  }
});

/***/ }),
/* 439 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


module.exports = elementorModules.Module.extend({
  autoSaveTimer: null,
  autosaveInterval: elementor.config.autosave_interval * 1000,
  isSaving: false,
  isChangedDuringSave: false,
  __construct: function __construct() {
    this.setWorkSaver();
  },
  startTimer: function startTimer(hasChanges) {
    clearTimeout(this.autoSaveTimer);

    if (hasChanges) {
      this.autoSaveTimer = setTimeout(_.bind(this.doAutoSave, this), this.autosaveInterval);
    }
  },
  saveDraft: function saveDraft() {
    var postStatus = elementor.settings.page.model.get('post_status');

    if (!elementor.saver.isEditorChanged() && 'draft' !== postStatus) {
      return;
    }

    switch (postStatus) {
      case 'publish':
      case 'private':
        this.doAutoSave();
        break;

      default:
        // Update and create a revision
        this.update();
    }
  },
  doAutoSave: function doAutoSave() {
    var editorMode = elementor.channels.dataEditMode.request('activeMode'); // Avoid auto save for Revisions Preview changes.

    if ('edit' !== editorMode) {
      return;
    }

    this.saveAutoSave();
  },
  saveAutoSave: function saveAutoSave(options) {
    if (!this.isEditorChanged()) {
      return;
    }

    options = _.extend({
      status: 'autosave'
    }, options);
    this.saveEditor(options);
  },
  savePending: function savePending(options) {
    options = _.extend({
      status: 'pending'
    }, options);
    this.saveEditor(options);
  },
  discard: function discard() {
    var self = this;
    elementorCommon.ajax.addRequest('discard_changes', {
      success: function success() {
        self.setFlagEditorChange(false);
        location.href = elementor.config.document.urls.exit_to_dashboard;
      }
    });
  },
  update: function update(options) {
    options = _.extend({
      status: elementor.settings.page.model.get('post_status')
    }, options);
    this.saveEditor(options);
  },
  publish: function publish(options) {
    options = _.extend({
      status: 'publish'
    }, options);
    this.saveEditor(options);
  },
  setFlagEditorChange: function setFlagEditorChange(status) {
    if (status && this.isSaving) {
      this.isChangedDuringSave = true;
    }

    this.startTimer(status);
    elementor.channels.editor.reply('status', status).trigger('status:change', status);
  },
  isEditorChanged: function isEditorChanged() {
    return true === elementor.channels.editor.request('status');
  },
  setWorkSaver: function setWorkSaver() {
    var self = this;
    elementorCommon.elements.$window.on('beforeunload', function () {
      if (self.isEditorChanged()) {
        return elementor.translate('before_unload_alert');
      }
    });
  },
  defaultSave: function defaultSave() {
    var postStatus = elementor.settings.page.model.get('post_status');

    switch (postStatus) {
      case 'publish':
      case 'future':
      case 'private':
        this.update();
        break;

      case 'draft':
        if (elementor.config.current_user_can_publish) {
          this.publish();
        } else {
          this.savePending();
        }

        break;

      case 'pending': // User cannot change post status

      case undefined:
        // TODO: as a contributor it's undefined instead of 'pending'.
        if (elementor.config.current_user_can_publish) {
          this.publish();
        } else {
          this.update();
        }

    }
  },
  saveEditor: function saveEditor(options) {
    if (this.isSaving) {
      return;
    }

    options = _.extend({
      status: 'draft',
      onSuccess: null
    }, options);
    var self = this,
        elements = elementor.elements.toJSON({
      remove: ['default', 'editSettings', 'defaultEditSettings']
    }),
        settings = elementor.settings.page.model.toJSON({
      remove: ['default']
    }),
        oldStatus = elementor.settings.page.model.get('post_status'),
        statusChanged = oldStatus !== options.status;
    self.trigger('before:save', options).trigger('before:save:' + options.status, options);
    self.isSaving = true;
    self.isChangedDuringSave = false;
    settings.post_status = options.status;
    elementorCommon.ajax.addRequest('save_builder', {
      data: {
        status: options.status,
        elements: elements,
        settings: settings
      },
      success: function success(data) {
        self.afterAjax();

        if ('autosave' !== options.status) {
          if (statusChanged) {
            elementor.settings.page.model.set('post_status', options.status);
          } // Notice: Must be after update page.model.post_status to the new status.


          if (!self.isChangedDuringSave) {
            self.setFlagEditorChange(false);
          }
        }

        if (data.config) {
          jQuery.extend(true, elementor.config, data.config);
        }

        elementor.config.data = elements;
        elementor.channels.editor.trigger('saved', data);
        self.trigger('after:save', data).trigger('after:save:' + options.status, data);

        if (statusChanged) {
          self.trigger('page:status:change', options.status, oldStatus);
        }

        if (_.isFunction(options.onSuccess)) {
          options.onSuccess.call(this, data);
        }
      },
      error: function error(data) {
        self.afterAjax();
        self.trigger('after:saveError', data).trigger('after:saveError:' + options.status, data);
        var message;

        if (_.isString(data)) {
          message = data;
        } else if (data.statusText) {
          message = elementor.createAjaxErrorMessage(data);

          if (0 === data.readyState) {
            message += ' ' + elementor.translate('saving_disabled');
          }
        } else if (data[0] && data[0].code) {
          message = elementor.translate('server_error') + ' ' + data[0].code;
        }

        elementor.notifications.showToast({
          message: message
        });
      }
    });
    this.trigger('save', options);
  },
  afterAjax: function afterAjax() {
    this.isSaving = false;
  }
});

/***/ }),
/* 440 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var _interopRequireDefault = __webpack_require__(0);

var _parseInt2 = _interopRequireDefault(__webpack_require__(174));

module.exports = elementorModules.Module.extend({
  initToast: function initToast() {
    var toast = elementorCommon.dialogsManager.createWidget('buttons', {
      id: 'elementor-toast',
      position: {
        my: 'center bottom',
        at: 'center bottom-10',
        of: '#elementor-panel-content-wrapper',
        autoRefresh: true
      },
      hide: {
        onClick: true,
        auto: true,
        autoDelay: 10000
      },
      effects: {
        show: function show() {
          var $widget = toast.getElements('widget');
          $widget.show();
          toast.refreshPosition();
          var top = (0, _parseInt2.default)($widget.css('top'), 10);
          $widget.hide().css('top', top + 100);
          $widget.animate({
            opacity: 'show',
            height: 'show',
            paddingBottom: 'show',
            paddingTop: 'show',
            top: top
          }, {
            easing: 'linear',
            duration: 300
          });
        },
        hide: function hide() {
          var $widget = toast.getElements('widget'),
              top = (0, _parseInt2.default)($widget.css('top'), 10);
          $widget.animate({
            opacity: 'hide',
            height: 'hide',
            paddingBottom: 'hide',
            paddingTop: 'hide',
            top: top + 100
          }, {
            easing: 'linear',
            duration: 300
          });
        }
      },
      button: {
        tag: 'div'
      }
    });

    this.getToast = function () {
      return toast;
    };
  },
  showToast: function showToast(options) {
    var toast = this.getToast();
    toast.setMessage(options.message);
    toast.getElements('buttonsWrapper').empty();

    if (options.buttons) {
      options.buttons.forEach(function (button) {
        toast.addButton(button);
      });
    }

    toast.show();
  },
  onInit: function onInit() {
    this.initToast();
  }
});

/***/ }),
/* 441 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var BaseRegion = __webpack_require__(248);

module.exports = BaseRegion.extend({
  el: '#elementor-panel',
  getStorageKey: function getStorageKey() {
    return 'panel';
  },
  getDefaultStorage: function getDefaultStorage() {
    return {
      size: {
        width: ''
      }
    };
  },
  constructor: function constructor() {
    BaseRegion.prototype.constructor.apply(this, arguments);

    var PanelLayoutView = __webpack_require__(442);

    this.show(new PanelLayoutView());
    this.resizable();
    this.setSize();
    this.listenTo(elementor.channels.dataEditMode, 'switch', this.onEditModeSwitched);
  },
  setSize: function setSize() {
    var width = this.storage.size.width,
        side = elementorCommon.config.isRTL ? 'right' : 'left';
    this.$el.css('width', width);
    elementor.$previewWrapper.css(side, width);
  },
  resizable: function resizable() {
    var self = this,
        side = elementorCommon.config.isRTL ? 'right' : 'left';
    self.$el.resizable({
      handles: elementorCommon.config.isRTL ? 'w' : 'e',
      minWidth: 200,
      maxWidth: 680,
      start: function start() {
        elementor.$previewWrapper.addClass('ui-resizable-resizing');
      },
      stop: function stop() {
        elementor.$previewWrapper.removeClass('ui-resizable-resizing');
        elementor.getPanelView().updateScrollbar();
        self.saveSize();
      },
      resize: function resize(event, ui) {
        elementor.$previewWrapper.css(side, ui.size.width);
      }
    });
  },
  onEditModeSwitched: function onEditModeSwitched(activeMode) {
    if ('edit' !== activeMode) {
      return;
    }

    this.setSize();
  }
});

/***/ }),
/* 442 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var _interopRequireDefault = __webpack_require__(0);

var _keys = _interopRequireDefault(__webpack_require__(27));

var _component = _interopRequireDefault(__webpack_require__(443));

var _component2 = _interopRequireDefault(__webpack_require__(444));

var _component3 = _interopRequireDefault(__webpack_require__(445));

var EditModeItemView = __webpack_require__(446),
    PanelLayoutView;

PanelLayoutView = Marionette.LayoutView.extend({
  template: '#tmpl-elementor-panel',
  id: 'elementor-panel-inner',
  regions: {
    content: '#elementor-panel-content-wrapper',
    header: '#elementor-panel-header-wrapper',
    footer: '#elementor-panel-footer',
    modeSwitcher: '#elementor-mode-switcher'
  },
  pages: {},
  childEvents: {
    'click:add': function clickAdd() {
      $e.route('panel/elements/categories');
    },
    'editor:destroy': function editorDestroy() {
      $e.route('panel/elements/categories', {
        autoFocusSearch: false
      });
    }
  },
  currentPageName: null,
  currentPageView: null,
  perfectScrollbar: null,
  initialize: function initialize() {
    $e.components.register(new _component.default({
      manager: this
    }));
    $e.components.register(new _component2.default({
      manager: this
    }));
    $e.components.register(new _component3.default({
      manager: this
    }));
    this.initPages();
  },
  buildPages: function buildPages() {
    var pages = {
      elements: {
        view: __webpack_require__(447),
        title: '<img src="' + elementorCommon.config.urls.assets + 'images/logo-panel.svg">'
      },
      editor: {
        view: __webpack_require__(452)
      },
      menu: {
        view: elementor.modules.layouts.panel.pages.menu.Menu,
        title: '<img src="' + elementorCommon.config.urls.assets + 'images/logo-panel.svg">'
      },
      colorScheme: {
        view: __webpack_require__(453)
      },
      typographyScheme: {
        view: __webpack_require__(456)
      }
    };

    var schemesTypes = (0, _keys.default)(elementor.schemes.getSchemes()),
        disabledSchemes = _.difference(schemesTypes, elementor.schemes.getEnabledSchemesTypes());

    _.each(disabledSchemes, function (schemeType) {
      var scheme = elementor.schemes.getScheme(schemeType);
      pages[schemeType + 'Scheme'].view = __webpack_require__(457).extend({
        disabledTitle: scheme.disabled_title
      });
    });

    return pages;
  },
  initPages: function initPages() {
    var pages;

    this.getPages = function (page) {
      if (!pages) {
        pages = this.buildPages();
      }

      return page ? pages[page] : pages;
    };

    this.addPage = function (pageName, pageData) {
      if (!pages) {
        pages = this.buildPages();
      }

      pages[pageName] = pageData;
    };
  },
  getHeaderView: function getHeaderView() {
    return this.getChildView('header');
  },
  getFooterView: function getFooterView() {
    return this.getChildView('footer');
  },
  getCurrentPageName: function getCurrentPageName() {
    return this.currentPageName;
  },
  getCurrentPageView: function getCurrentPageView() {
    return this.currentPageView;
  },
  setPage: function setPage(page, title, viewOptions) {
    var pages = this.getPages();

    if ('elements' === page && !elementor.userCan('design')) {
      if (pages.page_settings) {
        page = 'page_settings';
      }
    }

    var pageData = pages[page];

    if (!pageData) {
      throw new ReferenceError('Elementor panel doesn\'t have page named \'' + page + '\'');
    }

    if (pageData.options) {
      viewOptions = _.extend(pageData.options, viewOptions);
    }

    var View = pageData.view;

    if (pageData.getView) {
      View = pageData.getView();
    }

    this.currentPageName = page;
    this.currentPageView = new View(viewOptions);
    this.showChildView('content', this.currentPageView);
    this.getHeaderView().setTitle(title || pageData.title);
    this.trigger('set:page', this.currentPageView).trigger('set:page:' + page, this.currentPageView);
    return this.currentPageView;
  },
  onBeforeShow: function onBeforeShow() {
    var PanelFooterItemView = __webpack_require__(458),
        PanelHeaderItemView = __webpack_require__(459); // Edit Mode


    this.showChildView('modeSwitcher', new EditModeItemView()); // Header

    this.showChildView('header', new PanelHeaderItemView()); // Footer

    this.showChildView('footer', new PanelFooterItemView()); // Added Editor events

    this.updateScrollbar = _.throttle(this.updateScrollbar, 100);
    this.getRegion('content').on('before:show', this.onEditorBeforeShow.bind(this)).on('empty', this.onEditorEmpty.bind(this)).on('show', this.updateScrollbar.bind(this));
  },
  onEditorBeforeShow: function onEditorBeforeShow() {
    _.defer(this.updateScrollbar.bind(this));
  },
  onEditorEmpty: function onEditorEmpty() {
    this.updateScrollbar();
  },
  updateScrollbar: function updateScrollbar() {
    if (!this.perfectScrollbar) {
      this.perfectScrollbar = new PerfectScrollbar(this.content.el, {
        suppressScrollX: true
      }); // The RTL is buggy, so always keep it LTR.

      this.perfectScrollbar.isRtl = false;
      return;
    }

    this.perfectScrollbar.update();
  }
});
module.exports = PanelLayoutView;

/***/ }),
/* 443 */
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

var _possibleConstructorReturn2 = _interopRequireDefault(__webpack_require__(5));

var _getPrototypeOf2 = _interopRequireDefault(__webpack_require__(4));

var _inherits2 = _interopRequireDefault(__webpack_require__(6));

var _component = _interopRequireDefault(__webpack_require__(64));

var Component =
/*#__PURE__*/
function (_BaseComponent) {
  (0, _inherits2.default)(Component, _BaseComponent);

  function Component() {
    (0, _classCallCheck2.default)(this, Component);
    return (0, _possibleConstructorReturn2.default)(this, (0, _getPrototypeOf2.default)(Component).apply(this, arguments));
  }

  (0, _createClass2.default)(Component, [{
    key: "getNamespace",
    value: function getNamespace() {
      return 'panel';
    }
  }, {
    key: "defaultRoutes",
    value: function defaultRoutes() {
      var _this = this;

      return {
        menu: function menu() {
          return _this.manager.setPage('menu');
        },
        'global-colors': function globalColors() {
          return _this.manager.setPage('colorScheme');
        },
        'global-fonts': function globalFonts() {
          return _this.manager.setPage('typographyScheme');
        },
        'editor-preferences': function editorPreferences() {
          return _this.manager.setPage('editorPreferences_settings').activateTab('settings');
        }
      };
    }
  }, {
    key: "defaultCommands",
    value: function defaultCommands() {
      return {
        open: function open() {
          return elementor.getPanelView().modeSwitcher.currentView.setMode('edit');
        },
        close: function close() {
          return elementor.getPanelView().modeSwitcher.currentView.setMode('preview');
        },
        toggle: function toggle() {
          return elementor.getPanelView().modeSwitcher.currentView.toggleMode();
        },
        save: function save() {
          return elementor.saver.saveDraft();
        },
        publish: function publish() {
          return elementor.saver.publish();
        },
        exit: function exit() {
          return $e.route('panel/menu');
        },
        'change-device-mode': function changeDeviceMode(args) {
          var devices = ['desktop', 'tablet', 'mobile'];

          if (!args.device) {
            var currentDeviceMode = elementor.channels.deviceMode.request('currentMode');
            var modeIndex = devices.indexOf(currentDeviceMode);
            modeIndex++;

            if (modeIndex >= devices.length) {
              modeIndex = 0;
            }

            args.device = devices[modeIndex];
          }

          elementor.changeDeviceMode(args.device);
        }
      };
    }
  }, {
    key: "defaultShortcuts",
    value: function defaultShortcuts() {
      return {
        toggle: {
          keys: 'ctrl+p'
        },
        save: {
          keys: 'ctrl+s'
        },
        exit: {
          keys: 'esc',
          // TODO: replace dependency with scopes.
          dependency: function dependency() {
            return !jQuery('.dialog-widget:visible').length;
          },
          scopes: ['panel', 'preview']
        },
        'change-device-mode': {
          keys: 'ctrl+shift+m'
        }
      };
    }
  }]);
  return Component;
}(_component.default);

exports.default = Component;

/***/ }),
/* 444 */
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

var _possibleConstructorReturn2 = _interopRequireDefault(__webpack_require__(5));

var _getPrototypeOf2 = _interopRequireDefault(__webpack_require__(4));

var _inherits2 = _interopRequireDefault(__webpack_require__(6));

var _component = _interopRequireDefault(__webpack_require__(64));

var Component =
/*#__PURE__*/
function (_BaseComponent) {
  (0, _inherits2.default)(Component, _BaseComponent);

  function Component() {
    (0, _classCallCheck2.default)(this, Component);
    return (0, _possibleConstructorReturn2.default)(this, (0, _getPrototypeOf2.default)(Component).apply(this, arguments));
  }

  (0, _createClass2.default)(Component, [{
    key: "getNamespace",
    value: function getNamespace() {
      return 'panel/elements';
    }
  }, {
    key: "defaultTabs",
    value: function defaultTabs() {
      return {
        categories: {
          title: elementor.translate('elements')
        },
        global: {
          title: elementor.translate('global')
        }
      };
    }
  }, {
    key: "getTabsWrapperSelector",
    value: function getTabsWrapperSelector() {
      return '#elementor-panel-elements-navigation';
    }
  }, {
    key: "renderTab",
    value: function renderTab(tab) {
      this.manager.setPage('elements').showView(tab);
    }
  }]);
  return Component;
}(_component.default);

exports.default = Component;

/***/ }),
/* 445 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var _interopRequireDefault = __webpack_require__(0);

var _Object$defineProperty = __webpack_require__(1);

_Object$defineProperty(exports, "__esModule", {
  value: true
});

exports.default = void 0;

__webpack_require__(15);

var _classCallCheck2 = _interopRequireDefault(__webpack_require__(2));

var _createClass2 = _interopRequireDefault(__webpack_require__(3));

var _possibleConstructorReturn2 = _interopRequireDefault(__webpack_require__(5));

var _getPrototypeOf2 = _interopRequireDefault(__webpack_require__(4));

var _get2 = _interopRequireDefault(__webpack_require__(28));

var _inherits2 = _interopRequireDefault(__webpack_require__(6));

var _component = _interopRequireDefault(__webpack_require__(64));

var Component =
/*#__PURE__*/
function (_BaseComponent) {
  (0, _inherits2.default)(Component, _BaseComponent);

  function Component() {
    (0, _classCallCheck2.default)(this, Component);
    return (0, _possibleConstructorReturn2.default)(this, (0, _getPrototypeOf2.default)(Component).apply(this, arguments));
  }

  (0, _createClass2.default)(Component, [{
    key: "__construct",
    value: function __construct(args) {
      (0, _get2.default)((0, _getPrototypeOf2.default)(Component.prototype), "__construct", this).call(this, args); // Remember last used tab.

      this.activeTabs = {};
    }
  }, {
    key: "getNamespace",
    value: function getNamespace() {
      return 'panel/editor';
    }
  }, {
    key: "defaultTabs",
    value: function defaultTabs() {
      return {
        content: {
          title: elementor.translate('content')
        },
        style: {
          title: elementor.translate('style')
        },
        advanced: {
          title: elementor.translate('advanced')
        },
        layout: {
          title: elementor.translate('layout')
        }
      };
    }
  }, {
    key: "defaultCommands",
    value: function defaultCommands() {
      var _this = this;

      return {
        open: function open(args) {
          _this.openEditor(args.model, args.view);

          _this.setDefaultTab(args);

          $e.route(_this.getDefaultRoute(), args); // BC: Run hooks after the route render's the view.

          var action = 'panel/open_editor/' + args.model.get('elType'); // Example: panel/open_editor/widget

          elementor.hooks.doAction(action, _this.manager, args.model, args.view); // Example: panel/open_editor/widget/heading

          elementor.hooks.doAction(action + '/' + args.model.get('widgetType'), _this.manager, args.model, args.view);
        }
      };
    }
  }, {
    key: "getTabsWrapperSelector",
    value: function getTabsWrapperSelector() {
      return '.elementor-panel-navigation';
    }
  }, {
    key: "renderTab",
    value: function renderTab(tab) {
      this.manager.getCurrentPageView().activateTab(tab);
    }
  }, {
    key: "activateTab",
    value: function activateTab(tab) {
      this.activeTabs[this.manager.getCurrentPageView().model.id] = tab;
      (0, _get2.default)((0, _getPrototypeOf2.default)(Component.prototype), "activateTab", this).call(this, tab);
    }
  }, {
    key: "setDefaultTab",
    value: function setDefaultTab(args) {
      var defaultTab;

      if (this.activeTabs[args.model.id]) {
        defaultTab = this.activeTabs[args.model.id];
      } else {
        defaultTab = jQuery(this.getTabsWrapperSelector()).find('.elementor-component-tab').eq(0).data('tab');
      } // For unit test.


      if (!defaultTab) {
        defaultTab = 'content';
      }

      this.setDefaultRoute(defaultTab);
    }
  }, {
    key: "openEditor",
    value: function openEditor(model, view) {
      var title = elementor.translate('edit_element', [elementor.getElementData(model).title]),
          editor = elementor.getPanelView().setPage('editor', title, {
        model: model,
        controls: elementor.getElementControls(model),
        editedElementView: view
      });
      return editor;
    }
  }]);
  return Component;
}(_component.default);

exports.default = Component;

/***/ }),
/* 446 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var EditModeItemView;
EditModeItemView = Marionette.ItemView.extend({
  template: '#tmpl-elementor-mode-switcher-content',
  id: 'elementor-mode-switcher-inner',
  ui: {
    previewButton: '#elementor-mode-switcher-preview-input',
    previewLabel: '#elementor-mode-switcher-preview',
    previewLabelA11y: '#elementor-mode-switcher-preview .elementor-screen-only'
  },
  events: {
    'change @ui.previewButton': 'onPreviewButtonChange'
  },
  initialize: function initialize() {
    this.listenTo(elementor.channels.dataEditMode, 'switch', this.onEditModeChanged);
  },
  getCurrentMode: function getCurrentMode() {
    return this.ui.previewButton.is(':checked') ? 'preview' : 'edit';
  },
  setMode: function setMode(mode) {
    this.ui.previewButton.prop('checked', 'preview' === mode).trigger('change');
  },
  toggleMode: function toggleMode() {
    this.setMode(this.ui.previewButton.prop('checked') ? 'edit' : 'preview');
  },
  onRender: function onRender() {
    this.onEditModeChanged();
  },
  onPreviewButtonChange: function onPreviewButtonChange() {
    elementor.changeEditMode(this.getCurrentMode());
  },
  onEditModeChanged: function onEditModeChanged() {
    var activeMode = elementor.channels.dataEditMode.request('activeMode'),
        title = elementor.translate('preview' === activeMode ? 'back_to_editor' : 'preview');
    this.ui.previewLabel.attr('title', title);
    this.ui.previewLabelA11y.text(title);
  }
});
module.exports = EditModeItemView;

/***/ }),
/* 447 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


__webpack_require__(225);

var PanelElementsCategoriesCollection = __webpack_require__(448),
    PanelElementsElementsCollection = __webpack_require__(277),
    PanelElementsCategoriesView = __webpack_require__(449),
    PanelElementsElementsView = elementor.modules.layouts.panel.pages.elements.views.Elements,
    PanelElementsSearchView = __webpack_require__(451),
    PanelElementsGlobalView = __webpack_require__(273),
    PanelElementsLayoutView;

PanelElementsLayoutView = Marionette.LayoutView.extend({
  template: '#tmpl-elementor-panel-elements',
  id: 'elementor-panel-page-elements',
  options: {
    autoFocusSearch: true
  },
  regions: {
    elements: '#elementor-panel-elements-wrapper',
    search: '#elementor-panel-elements-search-area'
  },
  regionViews: {},
  elementsCollection: null,
  categoriesCollection: null,
  initialize: function initialize() {
    this.listenTo(elementor.channels.panelElements, 'element:selected', this.destroy);
    this.initElementsCollection();
    this.initCategoriesCollection();
    this.initRegionViews();
  },
  initRegionViews: function initRegionViews() {
    var regionViews = {
      elements: {
        region: this.elements,
        view: PanelElementsElementsView,
        options: {
          collection: this.elementsCollection
        }
      },
      categories: {
        region: this.elements,
        view: PanelElementsCategoriesView,
        options: {
          collection: this.categoriesCollection
        }
      },
      search: {
        region: this.search,
        view: PanelElementsSearchView
      },
      global: {
        region: this.elements,
        view: PanelElementsGlobalView
      }
    };
    this.regionViews = elementor.hooks.applyFilters('panel/elements/regionViews', regionViews);
  },
  initElementsCollection: function initElementsCollection() {
    var elementsCollection = new PanelElementsElementsCollection(),
        sectionConfig = elementor.config.elements.section;
    elementsCollection.add({
      title: elementor.translate('inner_section'),
      elType: 'section',
      categories: ['basic'],
      keywords: ['row', 'columns', 'nested'],
      icon: sectionConfig.icon
    }); // TODO: Change the array from server syntax, and no need each loop for initialize

    _.each(elementor.config.widgets, function (widget) {
      if (elementor.config.document.panel.widgets_settings[widget.widget_type]) {
        widget = _.extend(widget, elementor.config.document.panel.widgets_settings[widget.widget_type]);
      }

      if (!widget.show_in_panel) {
        return;
      }

      elementsCollection.add({
        title: widget.title,
        elType: widget.elType,
        categories: widget.categories,
        keywords: widget.keywords,
        icon: widget.icon,
        widgetType: widget.widget_type,
        custom: widget.custom
      });
    });

    this.elementsCollection = elementsCollection;
  },
  initCategoriesCollection: function initCategoriesCollection() {
    var categories = {};
    this.elementsCollection.each(function (element) {
      _.each(element.get('categories'), function (category) {
        if (!categories[category]) {
          categories[category] = [];
        }

        categories[category].push(element);
      });
    });
    var categoriesCollection = new PanelElementsCategoriesCollection();

    _.each(elementor.config.document.panel.elements_categories, function (categoryConfig, categoryName) {
      if (!categories[categoryName]) {
        return;
      } // Set defaults.


      if ('undefined' === typeof categoryConfig.active) {
        categoryConfig.active = true;
      }

      if ('undefined' === typeof categoryConfig.icon) {
        categoryConfig.icon = 'font';
      }

      categoriesCollection.add({
        name: categoryName,
        title: categoryConfig.title,
        icon: categoryConfig.icon,
        defaultActive: categoryConfig.active,
        items: categories[categoryName]
      });
    });

    this.categoriesCollection = categoriesCollection;
  },
  showView: function showView(viewName) {
    var viewDetails = this.regionViews[viewName],
        options = viewDetails.options || {};
    viewDetails.region.show(new viewDetails.view(options));
  },
  clearSearchInput: function clearSearchInput() {
    this.getChildView('search').clearInput();
  },
  changeFilter: function changeFilter(filterValue) {
    elementor.channels.panelElements.reply('filter:value', filterValue).trigger('filter:change');
  },
  clearFilters: function clearFilters() {
    this.changeFilter(null);
    this.clearSearchInput();
  },
  focusSearch: function focusSearch() {
    if (!elementor.userCan('design') || !this.search
    /* default panel is not elements */
    || !this.search.currentView
    /* on global elements empty */
    ) {
        return;
      }

    this.search.currentView.ui.input.focus();
  },
  onChildviewChildrenRender: function onChildviewChildrenRender() {
    elementor.getPanelView().updateScrollbar();
  },
  onChildviewSearchChangeInput: function onChildviewSearchChangeInput(child) {
    this.changeFilter(child.ui.input.val(), 'search');
  },
  onDestroy: function onDestroy() {
    elementor.channels.panelElements.reply('filter:value', null);
  },
  onShow: function onShow() {
    this.showView('search');

    if (this.options.autoFocusSearch) {
      setTimeout(this.focusSearch.bind(this));
    }
  }
});
module.exports = PanelElementsLayoutView;

/***/ }),
/* 448 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var PanelElementsCategory = __webpack_require__(276),
    PanelElementsCategoriesCollection;

PanelElementsCategoriesCollection = Backbone.Collection.extend({
  model: PanelElementsCategory
});
module.exports = PanelElementsCategoriesCollection;

/***/ }),
/* 449 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var PanelElementsCategoryView = __webpack_require__(450),
    PanelElementsCategoriesView;

PanelElementsCategoriesView = Marionette.CompositeView.extend({
  template: '#tmpl-elementor-panel-categories',
  childView: PanelElementsCategoryView,
  childViewContainer: '#elementor-panel-categories',
  id: 'elementor-panel-elements-categories',
  initialize: function initialize() {
    this.listenTo(elementor.channels.panelElements, 'filter:change', this.onPanelElementsFilterChange);
  },
  onPanelElementsFilterChange: function onPanelElementsFilterChange() {
    if (elementor.channels.panelElements.request('filter:value')) {
      elementor.getPanelView().getCurrentPageView().showView('elements');
    }
  }
});
module.exports = PanelElementsCategoriesView;

/***/ }),
/* 450 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var PanelElementsElementsCollection = __webpack_require__(277),
    PanelElementsCategoryView;

PanelElementsCategoryView = Marionette.CompositeView.extend({
  template: '#tmpl-elementor-panel-elements-category',
  className: 'elementor-panel-category',
  ui: {
    title: '.elementor-panel-category-title',
    items: '.elementor-panel-category-items'
  },
  events: {
    'click @ui.title': 'onTitleClick'
  },
  id: function id() {
    return 'elementor-panel-category-' + this.model.get('name');
  },
  childView: __webpack_require__(274),
  childViewContainer: '.elementor-panel-category-items',
  initialize: function initialize() {
    this.collection = new PanelElementsElementsCollection(this.model.get('items'));
  },
  onRender: function onRender() {
    var isActive = elementor.channels.panelElements.request('category:' + this.model.get('name') + ':active');

    if (undefined === isActive) {
      isActive = this.model.get('defaultActive');
    }

    if (isActive) {
      this.$el.addClass('elementor-active');
      this.ui.items.show();
    }
  },
  onTitleClick: function onTitleClick() {
    var $items = this.ui.items,
        activeClass = 'elementor-active',
        isActive = this.$el.hasClass(activeClass),
        slideFn = isActive ? 'slideUp' : 'slideDown';
    elementor.channels.panelElements.reply('category:' + this.model.get('name') + ':active', !isActive);
    this.$el.toggleClass(activeClass, !isActive);
    $items[slideFn](300, function () {
      elementor.getPanelView().updateScrollbar();
    });
  }
});
module.exports = PanelElementsCategoryView;

/***/ }),
/* 451 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var PanelElementsSearchView;
PanelElementsSearchView = Marionette.ItemView.extend({
  template: '#tmpl-elementor-panel-element-search',
  id: 'elementor-panel-elements-search-wrapper',
  ui: {
    input: 'input'
  },
  events: {
    'input @ui.input': 'onInputChanged'
  },
  clearInput: function clearInput() {
    this.ui.input.val('');
  },
  onInputChanged: function onInputChanged(event) {
    var ESC_KEY = 27;

    if (ESC_KEY === event.keyCode) {
      this.clearInput();
    }

    this.triggerMethod('search:change:input');
  }
});
module.exports = PanelElementsSearchView;

/***/ }),
/* 452 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var ControlsStack = elementorModules.editor.views.ControlsStack,
    EditorView;
EditorView = ControlsStack.extend({
  template: Marionette.TemplateCache.get('#tmpl-editor-content'),
  id: 'elementor-panel-page-editor',
  childViewContainer: '#elementor-controls',
  childViewOptions: function childViewOptions() {
    return {
      element: this.getOption('editedElementView'),
      container: this.getOption('editedElementView').getContainer(),
      // TODO: elementSettingsModel is deprecated since 2.8.0.
      elementSettingsModel: this.model.get('settings'),
      elementEditSettings: this.model.get('editSettings')
    };
  },
  getNamespaceArray: function getNamespaceArray() {
    var eventNamespace = elementorModules.editor.views.ControlsStack.prototype.getNamespaceArray();
    var model = this.getOption('editedElementView').getEditModel(),
        currentElementType = model.get('elType'); // Element Type: section / column / widget.

    eventNamespace.push(currentElementType);

    if ('widget' === currentElementType) {
      // Widget Type: heading / button and etc.
      eventNamespace.push(model.get('widgetType'));
    }

    return eventNamespace;
  },
  initialize: function initialize() {
    ControlsStack.prototype.initialize.apply(this, arguments);
    var panelSettings = this.model.get('editSettings').get('panel');

    if (panelSettings) {
      this.activeTab = panelSettings.activeTab;
      this.activeSection = panelSettings.activeSection;
    }
  },
  activateSection: function activateSection() {
    ControlsStack.prototype.activateSection.apply(this, arguments);
    this.model.get('editSettings').set('panel', {
      activeTab: this.activeTab,
      activeSection: this.activeSection
    });
    return this;
  },
  openActiveSection: function openActiveSection() {
    ControlsStack.prototype.openActiveSection.apply(this, arguments);
    elementor.channels.editor.trigger('section:activated', this.activeSection, this);
  },
  isVisibleSectionControl: function isVisibleSectionControl(sectionControlModel) {
    return ControlsStack.prototype.isVisibleSectionControl.apply(this, arguments) && elementor.helpers.isActiveControl(sectionControlModel, this.model.get('settings').attributes);
  },
  scrollToEditedElement: function scrollToEditedElement() {
    elementor.helpers.scrollToView(this.getOption('editedElementView').$el);
  },
  onDestroy: function onDestroy() {
    var editedElementView = this.getOption('editedElementView');

    if (editedElementView) {
      editedElementView.$el.removeClass('elementor-element-editable');
    }

    this.model.trigger('editor:close');
    this.triggerMethod('editor:destroy');
  },
  onRender: function onRender() {
    var editedElementView = this.getOption('editedElementView');

    if (editedElementView) {
      editedElementView.$el.addClass('elementor-element-editable');
    }
  },
  onDeviceModeChange: function onDeviceModeChange() {
    ControlsStack.prototype.onDeviceModeChange.apply(this, arguments);
    this.scrollToEditedElement();
  },
  onChildviewSettingsChange: function onChildviewSettingsChange(childView) {
    var editedElementView = this.getOption('editedElementView'),
        editedElementType = editedElementView.model.get('elType');

    if ('widget' === editedElementType) {
      editedElementType = editedElementView.model.get('widgetType');
    }

    elementor.channels.editor.trigger('change', childView, editedElementView).trigger('change:' + editedElementType, childView, editedElementView).trigger('change:' + editedElementType + ':' + childView.model.get('name'), childView, editedElementView);
  }
});
module.exports = EditorView;

/***/ }),
/* 453 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var PanelSchemeBaseView = __webpack_require__(278),
    PanelSchemeColorsView;

PanelSchemeColorsView = PanelSchemeBaseView.extend({
  ui: function ui() {
    var ui = PanelSchemeBaseView.prototype.ui.apply(this, arguments);
    ui.systemSchemes = '.elementor-panel-scheme-color-system-scheme';
    return ui;
  },
  events: function events() {
    var events = PanelSchemeBaseView.prototype.events.apply(this, arguments);
    events['click @ui.systemSchemes'] = 'onSystemSchemeClick';
    return events;
  },
  getType: function getType() {
    return 'color';
  },
  onSystemSchemeClick: function onSystemSchemeClick(event) {
    var $schemeClicked = jQuery(event.currentTarget),
        schemeName = $schemeClicked.data('schemeName'),
        scheme = elementor.config.system_schemes[this.getType()][schemeName].items;
    this.changeChildrenUIValues(scheme);
  }
});
module.exports = PanelSchemeColorsView;

/***/ }),
/* 454 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var _interopRequireDefault = __webpack_require__(0);

var _colorPicker = _interopRequireDefault(__webpack_require__(221));

var PanelSchemeItemView = __webpack_require__(279);

module.exports = PanelSchemeItemView.extend({
  getUIType: function getUIType() {
    return 'color';
  },
  ui: {
    pickerPlaceholder: '.elementor-panel-scheme-color-picker-placeholder'
  },
  changeUIValue: function changeUIValue(newValue) {
    this.colorPicker.picker.setColor(newValue);
  },
  onRender: function onRender() {
    var _this = this;

    this.colorPicker = new _colorPicker.default({
      picker: {
        el: this.ui.pickerPlaceholder[0],
        default: this.model.get('value')
      },
      onChange: function onChange() {
        _this.triggerMethod('value:change', _this.colorPicker.getColor());
      },
      onClear: function onClear() {
        _this.triggerMethod('value:change', '');
      }
    });
  },
  onBeforeDestroy: function onBeforeDestroy() {
    this.colorPicker.destroy();
  }
});

/***/ }),
/* 455 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var PanelSchemeItemView = __webpack_require__(279),
    PanelSchemeTypographyView;

PanelSchemeTypographyView = PanelSchemeItemView.extend({
  getUIType: function getUIType() {
    return 'typography';
  },
  className: function className() {
    var classes = PanelSchemeItemView.prototype.className.apply(this, arguments);
    return classes + ' elementor-panel-box';
  },
  ui: {
    heading: '.elementor-panel-heading',
    allFields: '.elementor-panel-scheme-typography-item-field',
    inputFields: 'input.elementor-panel-scheme-typography-item-field',
    selectFields: 'select.elementor-panel-scheme-typography-item-field',
    selectFamilyFields: 'select.elementor-panel-scheme-typography-item-field[name="font_family"]'
  },
  events: {
    'input @ui.inputFields': 'onFieldChange',
    'change @ui.selectFields': 'onFieldChange',
    'click @ui.heading': 'toggleVisibility'
  },
  onRender: function onRender() {
    var self = this;
    this.ui.inputFields.add(this.ui.selectFields).each(function () {
      var $this = jQuery(this),
          name = $this.attr('name'),
          value = self.model.get('value')[name];
      $this.val(value);
    });
    this.ui.selectFamilyFields.select2({
      dir: elementorCommon.config.isRTL ? 'rtl' : 'ltr'
    });
  },
  toggleVisibility: function toggleVisibility() {
    this.$el.toggleClass('elementor-open');
  },
  changeUIValue: function changeUIValue(newValue) {
    this.ui.allFields.each(function () {
      var $this = jQuery(this),
          thisName = $this.attr('name'),
          newFieldValue = newValue[thisName];
      $this.val(newFieldValue).trigger('change');
    });
  },
  onFieldChange: function onFieldChange(event) {
    var $select = this.$(event.currentTarget),
        currentValue = elementor.schemes.getSchemeValue('typography', this.model.get('key')).value,
        fieldKey = $select.attr('name');
    currentValue[fieldKey] = $select.val();

    if ('font_family' === fieldKey && !_.isEmpty(currentValue[fieldKey])) {
      elementor.helpers.enqueueFont(currentValue[fieldKey]);
    }

    this.triggerMethod('value:change', currentValue);
  }
});
module.exports = PanelSchemeTypographyView;

/***/ }),
/* 456 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var PanelSchemeBaseView = __webpack_require__(278),
    PanelSchemeTypographyView;

PanelSchemeTypographyView = PanelSchemeBaseView.extend({
  getType: function getType() {
    return 'typography';
  }
});
module.exports = PanelSchemeTypographyView;

/***/ }),
/* 457 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var PanelSchemeDisabledView;
PanelSchemeDisabledView = Marionette.ItemView.extend({
  template: '#tmpl-elementor-panel-schemes-disabled',
  id: 'elementor-panel-schemes-disabled',
  className: 'elementor-nerd-box',
  disabledTitle: '',
  templateHelpers: function templateHelpers() {
    return {
      disabledTitle: this.disabledTitle
    };
  }
});
module.exports = PanelSchemeDisabledView;

/***/ }),
/* 458 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


__webpack_require__(15);

__webpack_require__(30);

module.exports = Marionette.ItemView.extend({
  template: '#tmpl-elementor-panel-footer-content',
  tagName: 'nav',
  id: 'elementor-panel-footer-tools',
  possibleRotateModes: ['portrait', 'landscape'],
  ui: {
    menuButtons: '.elementor-panel-footer-tool',
    settings: '#elementor-panel-footer-settings',
    deviceModeIcon: '#elementor-panel-footer-responsive > i',
    deviceModeButtons: '#elementor-panel-footer-responsive .elementor-panel-footer-sub-menu-item',
    saveTemplate: '#elementor-panel-footer-sub-menu-item-save-template',
    history: '#elementor-panel-footer-history',
    navigator: '#elementor-panel-footer-navigator'
  },
  events: {
    'click @ui.menuButtons': 'onMenuButtonsClick',
    'click @ui.settings': 'onSettingsClick',
    'click @ui.deviceModeButtons': 'onResponsiveButtonsClick',
    'click @ui.saveTemplate': 'onSaveTemplateClick',
    'click @ui.history': 'onHistoryClick',
    'click @ui.navigator': 'onNavigatorClick'
  },
  behaviors: function behaviors() {
    var behaviors = {
      saver: {
        behaviorClass: elementor.modules.components.saver.behaviors.FooterSaver
      }
    };
    return elementor.hooks.applyFilters('panel/footer/behaviors', behaviors, this);
  },
  initialize: function initialize() {
    this.listenTo(elementor.channels.deviceMode, 'change', this.onDeviceModeChange);
  },
  getDeviceModeButton: function getDeviceModeButton(deviceMode) {
    return this.ui.deviceModeButtons.filter('[data-device-mode="' + deviceMode + '"]');
  },
  addSubMenuItem: function addSubMenuItem(subMenuName, itemData) {
    var $newItem = jQuery('<div>', {
      id: 'elementor-panel-footer-sub-menu-item-' + itemData.name,
      class: 'elementor-panel-footer-sub-menu-item'
    }),
        $itemIcon = jQuery('<i>', {
      class: 'elementor-icon ' + itemData.icon,
      'aria-hidden': true
    }),
        $itemTitle = jQuery('<div>', {
      class: 'elementor-title'
    }).text(itemData.title);
    $newItem.append($itemIcon, $itemTitle);

    if (itemData.description) {
      var $itemDescription = jQuery('<div>', {
        class: 'elementor-description'
      }).text(itemData.description);
      $newItem.append($itemDescription);
    }

    if (itemData.callback) {
      $newItem.on('click', itemData.callback);
    }

    var $menuTool = this.ui.menuButtons.filter('#elementor-panel-footer-' + subMenuName);

    if (itemData.before) {
      var $beforeItem = $menuTool.find('#elementor-panel-footer-sub-menu-item-' + itemData.before);

      if ($beforeItem.length) {
        return $newItem.insertBefore($beforeItem);
      }
    }

    var $subMenu = $menuTool.find('.elementor-panel-footer-sub-menu');
    return $newItem.appendTo($subMenu);
  },
  showSettingsPage: function showSettingsPage() {
    $e.route('panel/page-settings/settings');
  },
  onMenuButtonsClick: function onMenuButtonsClick(event) {
    var $tool = jQuery(event.currentTarget); // If the tool is not toggleable or the click is inside of a tool

    if (!$tool.hasClass('elementor-toggle-state') || jQuery(event.target).closest('.elementor-panel-footer-sub-menu-item').length) {
      return;
    }

    var isOpen = $tool.hasClass('elementor-open');
    this.ui.menuButtons.not('.elementor-leave-open').removeClass('elementor-open');

    if (!isOpen) {
      $tool.addClass('elementor-open');
    }
  },
  onSettingsClick: function onSettingsClick() {
    $e.route('panel/page-settings/settings');
  },
  onDeviceModeChange: function onDeviceModeChange() {
    var previousDeviceMode = elementor.channels.deviceMode.request('previousMode'),
        currentDeviceMode = elementor.channels.deviceMode.request('currentMode');
    this.getDeviceModeButton(previousDeviceMode).removeClass('active');
    this.getDeviceModeButton(currentDeviceMode).addClass('active'); // Change the footer icon

    this.ui.deviceModeIcon.removeClass('eicon-device-' + previousDeviceMode).addClass('eicon-device-' + currentDeviceMode);
  },
  onResponsiveButtonsClick: function onResponsiveButtonsClick(event) {
    var $clickedButton = this.$(event.currentTarget),
        newDeviceMode = $clickedButton.data('device-mode');
    elementor.changeDeviceMode(newDeviceMode);
  },
  onSaveTemplateClick: function onSaveTemplateClick() {
    $e.route('library/save-template');
  },
  onHistoryClick: function onHistoryClick() {
    $e.route('panel/history/actions');
  },
  onNavigatorClick: function onNavigatorClick() {
    $e.run('navigator/toggle');
  }
});

/***/ }),
/* 459 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var PanelHeaderItemView;
PanelHeaderItemView = Marionette.ItemView.extend({
  template: '#tmpl-elementor-panel-header',
  id: 'elementor-panel-header',
  ui: {
    menuButton: '#elementor-panel-header-menu-button',
    menuIcon: '#elementor-panel-header-menu-button i',
    title: '#elementor-panel-header-title',
    addButton: '#elementor-panel-header-add-button'
  },
  events: {
    'click @ui.addButton': 'onClickAdd',
    'click @ui.menuButton': 'onClickMenu'
  },
  setTitle: function setTitle(title) {
    this.ui.title.html(title);
  },
  onClickAdd: function onClickAdd() {
    $e.route('panel/elements/categories');
  },
  onClickMenu: function onClickMenu() {
    if ($e.routes.is('panel/menu')) {
      $e.route('panel/elements/categories');
    } else {
      $e.route('panel/menu');
    }
  }
});
module.exports = PanelHeaderItemView;

/***/ }),
/* 460 */
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

var _possibleConstructorReturn2 = _interopRequireDefault(__webpack_require__(5));

var _getPrototypeOf2 = _interopRequireDefault(__webpack_require__(4));

var _inherits2 = _interopRequireDefault(__webpack_require__(6));

var _base = _interopRequireDefault(__webpack_require__(242));

var AddSectionView =
/*#__PURE__*/
function (_BaseAddSectionView) {
  (0, _inherits2.default)(AddSectionView, _BaseAddSectionView);

  function AddSectionView() {
    (0, _classCallCheck2.default)(this, AddSectionView);
    return (0, _possibleConstructorReturn2.default)(this, (0, _getPrototypeOf2.default)(AddSectionView).apply(this, arguments));
  }

  (0, _createClass2.default)(AddSectionView, [{
    key: "onCloseButtonClick",
    value: function onCloseButtonClick() {
      this.closeSelectPresets();
    }
  }, {
    key: "id",
    get: function get() {
      return 'elementor-add-new-section';
    }
  }]);
  return AddSectionView;
}(_base.default);

var _default = AddSectionView;
exports.default = _default;

/***/ }),
/* 461 */
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

var _possibleConstructorReturn2 = _interopRequireDefault(__webpack_require__(5));

var _getPrototypeOf2 = _interopRequireDefault(__webpack_require__(4));

var _inherits2 = _interopRequireDefault(__webpack_require__(6));

var _default =
/*#__PURE__*/
function (_Marionette$Behavior) {
  (0, _inherits2.default)(_default, _Marionette$Behavior);

  function _default() {
    (0, _classCallCheck2.default)(this, _default);
    return (0, _possibleConstructorReturn2.default)(this, (0, _getPrototypeOf2.default)(_default).apply(this, arguments));
  }

  (0, _createClass2.default)(_default, [{
    key: "ui",
    value: function ui() {
      return {
        editButton: '.elementor-editor-element-edit'
      };
    }
  }, {
    key: "events",
    value: function events() {
      return {
        'click @ui.editButton': 'show'
      };
    }
  }, {
    key: "initialize",
    value: function initialize() {
      this.initIntroduction();
    }
  }, {
    key: "initIntroduction",
    value: function initIntroduction() {
      var introduction;

      this.getIntroduction = function () {
        if (!introduction) {
          introduction = new elementorModules.editor.utils.Introduction({
            introductionKey: 'rightClick',
            dialogOptions: {
              className: 'elementor-right-click-introduction',
              headerMessage: elementor.translate('meet_right_click_header'),
              message: elementor.translate('meet_right_click_message'),
              iframe: elementor.$preview,
              position: {
                my: 'center top+5',
                at: 'center bottom',
                collision: 'fit'
              }
            },
            onDialogInitCallback: function onDialogInitCallback(dialog) {
              dialog.addButton({
                name: 'learn-more',
                text: elementor.translate('learn_more'),
                tag: 'div',
                callback: function callback() {
                  open(elementor.config.help_right_click_url, '_blank');
                }
              });
              dialog.addButton({
                name: 'ok',
                text: elementor.translate('got_it'),
                callback: function callback() {
                  return introduction.setViewed();
                }
              });
              dialog.getElements('ok').addClass('elementor-button elementor-button-success');
            }
          });
        }

        return introduction;
      };
    }
  }, {
    key: "show",
    value: function show(event) {
      this.getIntroduction().show(event.currentTarget);
    }
  }]);
  return _default;
}(Marionette.Behavior);

exports.default = _default;

/***/ }),
/* 462 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


__webpack_require__(15);

var SectionView = __webpack_require__(178),
    BaseContainer = __webpack_require__(241),
    BaseSectionsContainerView;

BaseSectionsContainerView = BaseContainer.extend({
  childView: SectionView,
  behaviors: function behaviors() {
    var behaviors = {
      Sortable: {
        behaviorClass: __webpack_require__(201),
        elChildType: 'section'
      }
    };
    return elementor.hooks.applyFilters('elements/base-section-container/behaviors', behaviors, this);
  },
  getSortableOptions: function getSortableOptions() {
    return {
      handle: '> .elementor-element-overlay .elementor-editor-element-edit',
      items: '> .elementor-section'
    };
  },
  getChildType: function getChildType() {
    return ['section'];
  },
  initialize: function initialize() {
    BaseContainer.prototype.initialize.apply(this, arguments);
    this.listenTo(elementor.channels.panelElements, 'element:drag:start', this.onPanelElementDragStart).listenTo(elementor.channels.panelElements, 'element:drag:end', this.onPanelElementDragEnd);
  },
  onPanelElementDragStart: function onPanelElementDragStart() {
    // A temporary workaround in order to fix Chrome's 70+ dragging above nested iframe bug
    this.$el.find('.elementor-background-video-embed').hide();
    elementor.helpers.disableElementEvents(this.$el.find('iframe'));
  },
  onPanelElementDragEnd: function onPanelElementDragEnd() {
    this.$el.find('.elementor-background-video-embed').show();
    elementor.helpers.enableElementEvents(this.$el.find('iframe'));
  }
});
module.exports = BaseSectionsContainerView;

/***/ }),
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
/* 511 */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(512);
__webpack_require__(513);
module.exports = __webpack_require__(514);


/***/ }),
/* 512 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


__webpack_require__(30);

__webpack_require__(85);

__webpack_require__(48);

/*
 * jQuery Serialize Object v1.0.1
 */
(function ($) {
  $.fn.elementorSerializeObject = function () {
    var serializedArray = this.serializeArray(),
        data = {};

    var parseObject = function parseObject(dataContainer, key, value) {
      var isArrayKey = /^[^\[\]]+\[]/.test(key),
          isObjectKey = /^[^\[\]]+\[[^\[\]]+]/.test(key),
          keyName = key.replace(/\[.*/, '');

      if (isArrayKey) {
        if (!dataContainer[keyName]) {
          dataContainer[keyName] = [];
        }
      } else {
        if (!isObjectKey) {
          if (dataContainer.push) {
            dataContainer.push(value);
          } else {
            dataContainer[keyName] = value;
          }

          return;
        }

        if (!dataContainer[keyName]) {
          dataContainer[keyName] = {};
        }
      }

      var nextKeys = key.match(/\[[^\[\]]*]/g);
      nextKeys[0] = nextKeys[0].replace(/\[|]/g, '');
      return parseObject(dataContainer[keyName], nextKeys.join(''), value);
    };

    $.each(serializedArray, function () {
      parseObject(data, this.name, this.value);
    });
    return data;
  };
})(jQuery);

/***/ }),
/* 513 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var _interopRequireDefault = __webpack_require__(0);

__webpack_require__(85);

var _stringify = _interopRequireDefault(__webpack_require__(175));

/**
 * HTML5 - Drag and Drop
 */
(function ($) {
  var hasFullDataTransferSupport = function hasFullDataTransferSupport(event) {
    try {
      event.originalEvent.dataTransfer.setData('test', 'test');
      event.originalEvent.dataTransfer.clearData('test');
      return true;
    } catch (e) {
      return false;
    }
  };

  var Draggable = function Draggable(userSettings) {
    var self = this,
        settings = {},
        elementsCache = {},
        defaultSettings = {
      element: '',
      groups: null,
      onDragStart: null,
      onDragEnd: null
    };

    var initSettings = function initSettings() {
      $.extend(true, settings, defaultSettings, userSettings);
    };

    var initElementsCache = function initElementsCache() {
      elementsCache.$element = $(settings.element);
    };

    var buildElements = function buildElements() {
      elementsCache.$element.attr('draggable', true);
    };

    var onDragEnd = function onDragEnd(event) {
      if ($.isFunction(settings.onDragEnd)) {
        settings.onDragEnd.call(elementsCache.$element, event, self);
      }
    };

    var onDragStart = function onDragStart(event) {
      var groups = settings.groups || [],
          dataContainer = {
        groups: groups
      };

      if (hasFullDataTransferSupport(event)) {
        event.originalEvent.dataTransfer.setData((0, _stringify.default)(dataContainer), true);
      }

      if ($.isFunction(settings.onDragStart)) {
        settings.onDragStart.call(elementsCache.$element, event, self);
      }
    };

    var attachEvents = function attachEvents() {
      elementsCache.$element.on('dragstart', onDragStart).on('dragend', onDragEnd);
    };

    var init = function init() {
      initSettings();
      initElementsCache();
      buildElements();
      attachEvents();
    };

    this.destroy = function () {
      elementsCache.$element.off('dragstart', onDragStart);
      elementsCache.$element.removeAttr('draggable');
    };

    init();
  };

  var Droppable = function Droppable(userSettings) {
    var self = this,
        settings = {},
        elementsCache = {},
        currentElement,
        currentSide,
        defaultSettings = {
      element: '',
      items: '>',
      horizontalSensitivity: '10%',
      axis: ['vertical', 'horizontal'],
      placeholder: true,
      currentElementClass: 'html5dnd-current-element',
      placeholderClass: 'html5dnd-placeholder',
      hasDraggingOnChildClass: 'html5dnd-has-dragging-on-child',
      groups: null,
      isDroppingAllowed: null,
      onDragEnter: null,
      onDragging: null,
      onDropping: null,
      onDragLeave: null
    };

    var initSettings = function initSettings() {
      $.extend(settings, defaultSettings, userSettings);
    };

    var initElementsCache = function initElementsCache() {
      elementsCache.$element = $(settings.element);
      elementsCache.$placeholder = $('<div>', {
        class: settings.placeholderClass
      });
    };

    var hasHorizontalDetection = function hasHorizontalDetection() {
      return -1 !== settings.axis.indexOf('horizontal');
    };

    var hasVerticalDetection = function hasVerticalDetection() {
      return -1 !== settings.axis.indexOf('vertical');
    };

    var checkHorizontal = function checkHorizontal(offsetX, elementWidth) {
      var isPercentValue, sensitivity;

      if (!hasHorizontalDetection()) {
        return false;
      }

      if (!hasVerticalDetection()) {
        return offsetX > elementWidth / 2 ? 'right' : 'left';
      }

      sensitivity = settings.horizontalSensitivity.match(/\d+/);

      if (!sensitivity) {
        return false;
      }

      sensitivity = sensitivity[0];
      isPercentValue = /%$/.test(settings.horizontalSensitivity);

      if (isPercentValue) {
        sensitivity = elementWidth / sensitivity;
      }

      if (offsetX > elementWidth - sensitivity) {
        return 'right';
      } else if (offsetX < sensitivity) {
        return 'left';
      }

      return false;
    };

    var setSide = function setSide(event) {
      var $element = $(currentElement),
          elementHeight = $element.outerHeight() - elementsCache.$placeholder.outerHeight(),
          elementWidth = $element.outerWidth();
      event = event.originalEvent;
      currentSide = checkHorizontal(event.offsetX, elementWidth);

      if (currentSide) {
        return;
      }

      if (!hasVerticalDetection()) {
        currentSide = null;
        return;
      }

      var elementPosition = currentElement.getBoundingClientRect();
      currentSide = event.clientY > elementPosition.top + elementHeight / 2 ? 'bottom' : 'top';
    };

    var insertPlaceholder = function insertPlaceholder() {
      if (!settings.placeholder) {
        return;
      }

      var insertMethod = 'top' === currentSide ? 'prependTo' : 'appendTo';
      elementsCache.$placeholder[insertMethod](currentElement);
    };

    var isDroppingAllowed = function isDroppingAllowed(event) {
      var dataTransferTypes, draggableGroups, isGroupMatch, droppingAllowed;

      if (settings.groups && hasFullDataTransferSupport(event)) {
        dataTransferTypes = event.originalEvent.dataTransfer.types;
        isGroupMatch = false;
        dataTransferTypes = Array.prototype.slice.apply(dataTransferTypes); // Convert to array, since Firefox hold it as DOMStringList

        dataTransferTypes.forEach(function (type) {
          try {
            draggableGroups = JSON.parse(type);

            if (!draggableGroups.groups.slice) {
              return;
            }

            settings.groups.forEach(function (groupName) {
              if (-1 !== draggableGroups.groups.indexOf(groupName)) {
                isGroupMatch = true;
                return false; // stops the forEach from extra loops
              }
            });
          } catch (e) {}
        });

        if (!isGroupMatch) {
          return false;
        }
      }

      if ($.isFunction(settings.isDroppingAllowed)) {
        droppingAllowed = settings.isDroppingAllowed.call(currentElement, currentSide, event, self);

        if (!droppingAllowed) {
          return false;
        }
      }

      return true;
    };

    var onDragEnter = function onDragEnter(event) {
      event.stopPropagation();

      if (currentElement) {
        return;
      }

      currentElement = this;
      elementsCache.$element.parents().each(function () {
        var droppableInstance = $(this).data('html5Droppable');

        if (!droppableInstance) {
          return;
        }

        droppableInstance.doDragLeave();
      });
      setSide(event);

      if (!isDroppingAllowed(event)) {
        return;
      }

      insertPlaceholder();
      elementsCache.$element.addClass(settings.hasDraggingOnChildClass);
      $(currentElement).addClass(settings.currentElementClass);

      if ($.isFunction(settings.onDragEnter)) {
        settings.onDragEnter.call(currentElement, currentSide, event, self);
      }
    };

    var onDragOver = function onDragOver(event) {
      event.stopPropagation();

      if (!currentElement) {
        onDragEnter.call(this, event);
      }

      var oldSide = currentSide;
      setSide(event);

      if (!isDroppingAllowed(event)) {
        return;
      }

      event.preventDefault();

      if (oldSide !== currentSide) {
        insertPlaceholder();
      }

      if ($.isFunction(settings.onDragging)) {
        settings.onDragging.call(this, currentSide, event, self);
      }
    };

    var onDragLeave = function onDragLeave(event) {
      var elementPosition = this.getBoundingClientRect();

      if ('dragleave' === event.type && !(event.clientX < elementPosition.left || event.clientX >= elementPosition.right || event.clientY < elementPosition.top || event.clientY >= elementPosition.bottom)) {
        return;
      }

      $(currentElement).removeClass(settings.currentElementClass);
      self.doDragLeave();
    };

    var onDrop = function onDrop(event) {
      setSide(event);

      if (!isDroppingAllowed(event)) {
        return;
      }

      event.preventDefault();

      if ($.isFunction(settings.onDropping)) {
        settings.onDropping.call(this, currentSide, event, self);
      }
    };

    var attachEvents = function attachEvents() {
      elementsCache.$element.on('dragenter', settings.items, onDragEnter).on('dragover', settings.items, onDragOver).on('drop', settings.items, onDrop).on('dragleave drop', settings.items, onDragLeave);
    };

    var init = function init() {
      initSettings();
      initElementsCache();
      attachEvents();
    };

    this.doDragLeave = function () {
      if (settings.placeholder) {
        elementsCache.$placeholder.remove();
      }

      elementsCache.$element.removeClass(settings.hasDraggingOnChildClass);

      if ($.isFunction(settings.onDragLeave)) {
        settings.onDragLeave.call(currentElement, event, self);
      }

      currentElement = currentSide = null;
    };

    this.destroy = function () {
      elementsCache.$element.off('dragenter', settings.items, onDragEnter).off('dragover', settings.items, onDragOver).off('drop', settings.items, onDrop).off('dragleave drop', settings.items, onDragLeave);
    };

    init();
  };

  var plugins = {
    html5Draggable: Draggable,
    html5Droppable: Droppable
  };
  $.each(plugins, function (pluginName, Plugin) {
    $.fn[pluginName] = function (options) {
      options = options || {};
      this.each(function () {
        var instance = $.data(this, pluginName),
            hasInstance = instance instanceof Plugin;

        if (hasInstance) {
          if ('destroy' === options) {
            instance.destroy();
            $.removeData(this, pluginName);
          }

          return;
        }

        options.element = this;
        $.data(this, pluginName, new Plugin(options));
      });
      return this;
    };
  });
})(jQuery);

/***/ }),
/* 514 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var _interopRequireDefault = __webpack_require__(0);

var _Object$defineProperty = __webpack_require__(1);

_Object$defineProperty(exports, "__esModule", {
  value: true
});

exports.default = void 0;

__webpack_require__(225);

var _editorBase = _interopRequireDefault(__webpack_require__(295));

/* global ElementorConfig */
var App = _editorBase.default.extend({
  onStart: function onStart() {
    NProgress.start();
    NProgress.inc(0.2);

    _editorBase.default.prototype.onStart.apply(this, arguments);
  }
});

window.elementor = new App();

if (-1 === location.href.search('ELEMENTOR_TESTS=1')) {
  elementor.start();
}

var _default = window.elementor;
exports.default = _default;

/***/ })
/******/ ]);
//# sourceMappingURL=editor.js.map