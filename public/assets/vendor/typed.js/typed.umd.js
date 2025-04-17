(function(f){if(typeof exports==="object"&&typeof module!=="undefined"){module.exports=f()}else if(typeof define==="function"&&define.amd){define([],f)}else{var g;if(typeof window!=="undefined"){g=window}else if(typeof global!=="undefined"){g=global}else if(typeof self!=="undefined"){g=self}else{g=this}g.Typed = f()}})(function(){var define,module,exports;return (function e(t,n,r){function s(o,u){if(!n[o]){if(!t[o]){var a=typeof require=="function"&&require;if(!u&&a)return a(o,!0);if(i)return i(o,!0);var f=new Error("Cannot find module '"+o+"'");throw f.code="MODULE_NOT_FOUND",f}var l=n[o]={exports:{}};t[o][0].call(l.exports,function(e){var n=t[o][1][e];return s(n?n:e)},l,l.exports,e,t,n,r)}return n[o].exports}var i=typeof require=="function"&&require;for(var o=0;o<r.length;o++)s(r[o]);return s})({1:[function(require,module,exports){
(function (global, factory) {
    if (typeof define === 'function' && define.amd) {
        define(['module', 'exports'], factory);
    } else if (typeof exports !== 'undefined') {
        factory(module, exports);
    } else {
        var mod = {
            exports: {}
        };
        factory(mod, mod.exports);
        global.Typed = mod.exports;
    }
})(this, function (module, exports) {
    'use strict';

    Object.defineProperty(exports, "__esModule", {
        value: true
    });

    var _createClass = function () {
        function defineProperties(target, props) {
            for (var i = 0; i < props.length; i++) {
                var descriptor = props[i];
                descriptor.enumerable = descriptor.enumerable || false;
                descriptor.configurable = true;
                if ("value" in descriptor) descriptor.writable = true;
                Object.defineProperty(target, descriptor.key, descriptor);
            }
        }
        return function (Constructor, protoProps, staticProps) {
            if (protoProps) defineProperties(Constructor.prototype, protoProps);
            if (staticProps) defineProperties(Constructor, staticProps);
            return Constructor;
        };
    }();

    function _classCallCheck(instance, Constructor) {
        if (!(instance instanceof Constructor)) {
            throw new TypeError("Cannot call a class as a function");
        }
    }

    var Typed = function () {
        function Typed(element, options) {
            _classCallCheck(this, Typed);

            // Initialize it up
            this.element = element;
            this.options = options;
            this.isInput = this.element.tagName === 'INPUT';
            this.attr = this.options.attr;
            this.showCursor = this.isInput ? false : this.options.showCursor;
            this.elContent = this.attr ? this.element.getAttribute(this.attr) : this.element.textContent;
            this.contentType = this.options.contentType;
            this.typeSpeed = this.options.typeSpeed;
            this.startDelay = this.options.startDelay;
            this.backSpeed = this.options.backSpeed;
            this.backDelay = this.options.backDelay;
            this.strings = this.options.strings;
            this.stringsElement = this.options.stringsElement;
            this.strPos = 0;
            this.arrayPos = 0;
            this.stopNum = 0;
            this.loop = this.options.loop;
            this.loopCount = this.options.loopCount;
            this.curLoop = 0;
            this.stop = false;
            this.pause = false;
            this.currentElContent = this.elContent;
            this.autoInsertCss = this.options.autoInsertCss;
            this.shuffle = this.options.shuffle;
            this.sequence = [];

            // Put the cursor in its starting position
            this.cursor = document.createElement('span');
            this.cursor.className = 'typed-cursor';
            this.cursor.innerHTML = this.options.cursorChar;
            this.element.parentNode && this.element.parentNode.insertBefore(this.cursor, this.element.nextSibling);

            // Start the typing
            this.timeout = setTimeout(function () {
                this.typewrite(this.strings[this.arrayPos], this.strPos);
            }.bind(this), this.startDelay);
        }

        _createClass(Typed, [{
            key: 'typewrite',
            value: function typewrite(curString, curStrPos) {
                if (this.fadeOut && this.element.classList.contains(this.fadeOutClass)) {
                    this.element.classList.remove(this.fadeOutClass);
                    if (this.cursor.parentNode) {
                        this.cursor.parentNode.removeChild(this.cursor);
                    }
                    return;
                }

                if (this.pause === true) {
                    setTimeout(function () {
                        this.typewrite(curString, curStrPos);
                    }.bind(this), 100);
                    return;
                }

                if (this.stop === true) {
                    return;
                }

                var humanize = this.humanizer(this.typeSpeed);
                var timeout = 0;

                if (curStrPos === 0) {
                    this.timeout = setTimeout(function () {
                        this.typewrite(curString, curStrPos);
                    }.bind(this), this.startDelay);
                    return;
                }

                if (this.stopNum > 0) {
                    this.stopNum--;
                    return;
                }

                if (curStrPos < curString.length) {
                    var nextString = curString.substr(0, curStrPos + 1);
                    this.replaceText(nextString);
                    curStrPos++;
                    timeout = humanize;
                } else if (this.arrayPos < this.strings.length - 1) {
                    this.timeout = setTimeout(function () {
                        this.backspace(curString, curStrPos);
                    }.bind(this), this.backDelay);
                    return;
                } else if (this.loop && this.curLoop < this.loopCount || this.loopCount === 0) {
                    this.timeout = setTimeout(function () {
                        this.backspace(curString, curStrPos);
                    }.bind(this), this.backDelay);
                    return;
                }

                this.timeout = setTimeout(function () {
                    this.typewrite(curString, curStrPos);
                }.bind(this), timeout);
            }
        }, {
            key: 'backspace',
            value: function backspace(curString, curStrPos) {
                if (this.stop === true) {
                    return;
                }

                var humanize = this.humanizer(this.backSpeed);
                var timeout = 0;

                if (curStrPos > 0) {
                    var nextString = curString.substr(0, curStrPos - 1);
                    this.replaceText(nextString);
                    curStrPos--;
                    timeout = humanize;
                } else {
                    if (this.arrayPos < this.strings.length - 1) {
                        this.arrayPos++;
                        curStrPos = 0;
                    } else {
                        this.curLoop++;
                        if (this.loop === false || this.curLoop === this.loopCount) {
                            return;
                        }
                        this.arrayPos = 0;
                        curStrPos = 0;
                    }
                    timeout = this.startDelay;
                }

                this.timeout = setTimeout(function () {
                    this.backspace(curString, curStrPos);
                }.bind(this), timeout);
            }
        }, {
            key: 'replaceText',
            value: function replaceText(str) {
                if (this.attr) {
                    this.element.setAttribute(this.attr, str);
                } else {
                    if (this.isInput) {
                        this.element.value = str;
                    } else if (this.contentType === 'html') {
                        this.element.innerHTML = str;
                    } else {
                        this.element.textContent = str;
                    }
                }
            }
        }, {
            key: 'humanizer',
            value: function humanizer(speed) {
                return Math.round(Math.random() * speed / 2) + speed / 2;
            }
        }, {
            key: 'destroy',
            value: function destroy() {
                this.reset();
                this.element.parentNode && this.element.parentNode.removeChild(this.cursor);
            }
        }, {
            key: 'reset',
            value: function reset() {
                clearTimeout(this.timeout);
                this.replaceText('');
                this.strPos = 0;
                this.arrayPos = 0;
                this.curLoop = 0;
                this.pause = false;
                this.stop = false;
            }
        }, {
            key: 'start',
            value: function start() {
                this.reset();
                this.typewrite(this.strings[this.arrayPos], this.strPos);
            }
        }, {
            key: 'stop',
            value: function stop() {
                this.stop = true;
            }
        }, {
            key: 'pause',
            value: function pause() {
                this.pause = true;
            }
        }, {
            key: 'resume',
            value: function resume() {
                this.pause = false;
            }
        }, {
            key: 'toggle',
            value: function toggle() {
                this.pause = !this.pause;
            }
        }, {
            key: 'reset',
            value: function reset() {
                this.reset();
            }
        }]);

        return Typed;
    }();

    exports.default = Typed;
    module.exports = exports['default'];
});
},{}]},{},[1])(1)
});
