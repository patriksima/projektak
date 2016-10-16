/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};

/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {

/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId])
/******/ 			return installedModules[moduleId].exports;

/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};

/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);

/******/ 		// Flag the module as loaded
/******/ 		module.l = true;

/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}


/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;

/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;

/******/ 	// identity function for calling harmory imports with the correct context
/******/ 	__webpack_require__.i = function(value) { return value; };

/******/ 	// define getter function for harmory exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		Object.defineProperty(exports, name, {
/******/ 			configurable: false,
/******/ 			enumerable: true,
/******/ 			get: getter
/******/ 		});
/******/ 	};

/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};

/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };

/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";

/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ([
/* 0 */
/***/ function(module, exports) {

"use strict";
eval("'use strict';\n\nvar dialog = document.querySelector('dialog');\nvar button = document.querySelector('#worker__add');\n\nif (!dialog.showModal) {\n\tdialogPolyfill.registerDialog(dialog);\n}\n\nbutton.addEventListener('click', function () {\n\tdialog.showModal();\n});\n\ndialog.querySelector('.close').addEventListener('click', function () {\n\tdialog.close();\n});\n\ndialog.querySelector('.add').addEventListener('click', function () {\n\tvar requiredFields = dialog.querySelectorAll(\"input[required]:not(:disabled):not([readonly]):not([type=hidden])\" + \",select[required]:not(:disabled):not([readonly])\" + \",textarea[required]:not(:disabled):not([readonly])\");\n\n\tfor (var i = 0; i < requiredFields.length; i++) {\n\t\tif (requiredFields[i].checkValidity() == false) {\n\t\t\treturn;\n\t\t}\n\t}\n\tdialog.querySelector('#worker-form__add').submit();\n});\n\ndocument.querySelectorAll('th.sortable').forEach(function (entry) {\n\tvar asc = entry.outerHTML.indexOf('sorted-asc');\n\tvar desc = entry.outerHTML.indexOf('sorted-desc');\n\n\tentry.addEventListener('click', function () {\n\t\tlocation.href = '/workers?' + this.getAttribute('data-orderby') + '=' + this.getAttribute('data-orderdir');\n\t});\n});//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiMC5qcyIsInNvdXJjZXMiOlsid2VicGFjazovLy9yZXNvdXJjZXMvYXNzZXRzL2pzL3dvcmtlcnMuanM/MDczNyJdLCJzb3VyY2VzQ29udGVudCI6WyIndXNlIHN0cmljdCc7XG5cbnZhciBkaWFsb2cgPSBkb2N1bWVudC5xdWVyeVNlbGVjdG9yKCdkaWFsb2cnKTtcbnZhciBidXR0b24gPSBkb2N1bWVudC5xdWVyeVNlbGVjdG9yKCcjd29ya2VyX19hZGQnKTtcblxuaWYgKCFkaWFsb2cuc2hvd01vZGFsKSB7XG5cdGRpYWxvZ1BvbHlmaWxsLnJlZ2lzdGVyRGlhbG9nKGRpYWxvZyk7XG59XG5cbmJ1dHRvbi5hZGRFdmVudExpc3RlbmVyKCdjbGljaycsIGZ1bmN0aW9uICgpIHtcblx0ZGlhbG9nLnNob3dNb2RhbCgpO1xufSk7XG5cbmRpYWxvZy5xdWVyeVNlbGVjdG9yKCcuY2xvc2UnKS5hZGRFdmVudExpc3RlbmVyKCdjbGljaycsIGZ1bmN0aW9uICgpIHtcblx0ZGlhbG9nLmNsb3NlKCk7XG59KTtcblxuZGlhbG9nLnF1ZXJ5U2VsZWN0b3IoJy5hZGQnKS5hZGRFdmVudExpc3RlbmVyKCdjbGljaycsIGZ1bmN0aW9uICgpIHtcblx0dmFyIHJlcXVpcmVkRmllbGRzID0gZGlhbG9nLnF1ZXJ5U2VsZWN0b3JBbGwoXCJpbnB1dFtyZXF1aXJlZF06bm90KDpkaXNhYmxlZCk6bm90KFtyZWFkb25seV0pOm5vdChbdHlwZT1oaWRkZW5dKVwiICsgXCIsc2VsZWN0W3JlcXVpcmVkXTpub3QoOmRpc2FibGVkKTpub3QoW3JlYWRvbmx5XSlcIiArIFwiLHRleHRhcmVhW3JlcXVpcmVkXTpub3QoOmRpc2FibGVkKTpub3QoW3JlYWRvbmx5XSlcIik7XG5cblx0Zm9yICh2YXIgaSA9IDA7IGkgPCByZXF1aXJlZEZpZWxkcy5sZW5ndGg7IGkrKykge1xuXHRcdGlmIChyZXF1aXJlZEZpZWxkc1tpXS5jaGVja1ZhbGlkaXR5KCkgPT0gZmFsc2UpIHtcblx0XHRcdHJldHVybjtcblx0XHR9XG5cdH1cblx0ZGlhbG9nLnF1ZXJ5U2VsZWN0b3IoJyN3b3JrZXItZm9ybV9fYWRkJykuc3VibWl0KCk7XG59KTtcblxuZG9jdW1lbnQucXVlcnlTZWxlY3RvckFsbCgndGguc29ydGFibGUnKS5mb3JFYWNoKGZ1bmN0aW9uIChlbnRyeSkge1xuXHR2YXIgYXNjID0gZW50cnkub3V0ZXJIVE1MLmluZGV4T2YoJ3NvcnRlZC1hc2MnKTtcblx0dmFyIGRlc2MgPSBlbnRyeS5vdXRlckhUTUwuaW5kZXhPZignc29ydGVkLWRlc2MnKTtcblxuXHRlbnRyeS5hZGRFdmVudExpc3RlbmVyKCdjbGljaycsIGZ1bmN0aW9uICgpIHtcblx0XHRsb2NhdGlvbi5ocmVmID0gJy93b3JrZXJzPycgKyB0aGlzLmdldEF0dHJpYnV0ZSgnZGF0YS1vcmRlcmJ5JykgKyAnPScgKyB0aGlzLmdldEF0dHJpYnV0ZSgnZGF0YS1vcmRlcmRpcicpO1xuXHR9KTtcbn0pO1xuXG5cbi8vIFdFQlBBQ0sgRk9PVEVSIC8vXG4vLyByZXNvdXJjZXMvYXNzZXRzL2pzL3dvcmtlcnMuanMiXSwibWFwcGluZ3MiOiJBQUFBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQSIsInNvdXJjZVJvb3QiOiIifQ==");

/***/ }
/******/ ]);