/*!
 * @package   yii2-dialog
 * @author    Kartik Visweswaran <kartikv2@gmail.com>
 * @copyright Copyright &copy; Kartik Visweswaran, Krajee.com, 2014 - 2021
 * @version   1.0.6
 *
 * Provides a polyfill for javascript native alert, confirm, and prompt boxes. The BootstrapDialog 
 * will be used if available or needed, else the javascript native dialogs will be rendered.
 *
 * For more JQuery plugins visit http://plugins.krajee.com
 * For more Yii related demos visit http://demos.krajee.com
 */
var KrajeeDialog;
(function () {
    "use strict";
    var nativeDialog, parseOptions;

    nativeDialog = function (type, message) {
        try {
            return window[type](message);
        }
        catch (err) {
            return type === 'confirm' ? true : null;
        }
    };

    parseOptions = function (options) {
        return typeof(options) === 'object' ? options : {};
    };

    KrajeeDialog = function (useBsDialog, options, defaults) {
        var self = this;
        defaults = defaults || {};
        self.useBsDialog = useBsDialog;
        self.options = parseOptions(options);
        self.defaults = parseOptions(defaults);
    };

    KrajeeDialog.prototype = {
        constructor: KrajeeDialog,
        usePlugin: function () {
            return this.useBsDialog && !!window.BootstrapDialog;
        },
        getOpts: function (type) {
            var self = this;
            return window.jQuery.extend(true, {}, self.defaults[type], self.options);
        },
        _dialog: function (type, message, callback) {
            var self = this, opts, out;
            if (typeof callback !== "function") {
                throw "Invalid callback passed for KrajeeDialog." + type;
            }
            if (!self.usePlugin()) {
                out = nativeDialog(type, message);
                if (out) {
                    callback(out);
                }
                return;
            }
            if (type === 'prompt') {
                self.bdPrompt(message, callback);
                return;
            }
            opts = self.getOpts(type);
            opts.message = message;
            if (type === 'confirm') {
                opts.callback = callback;
                window.BootstrapDialog.confirm(opts);
            } else {
                window.BootstrapDialog.show(opts);
            }
        },
        alert: function (message, callback) {
            var self = this, opts = self.getOpts('alert');
            if (self.usePlugin()) {
                opts.message = message;
                opts.callback = callback;
                window.BootstrapDialog.alert(opts);
            } else {
                window.alert(message);
            }
        },
        confirm: function (message, callback) {
            this._dialog('confirm', message, callback);
        },
        prompt: function (message, callback) {
            this._dialog('prompt', message, callback);
        },
        dialog: function (message, callback) {
            this._dialog('dialog', message, callback);
        },
        bdPrompt: function (input, callback) {
            var self = this, msg = '', opts = self.getOpts('prompt'), cbOk, cbCancel, defaultButtons,
                buttons, $inputDiv, $input, attr = '', i;
            cbOk = function (dialog) {
                var data, $body = dialog.getModalBody();
                data = $body.find("input")[0].value || '';
                callback(data);
                dialog.close();
            };
            cbCancel = function (dialog) {
                dialog.close();
                callback(null);
            };
            defaultButtons = [
                {id: 'btn-cancel', label: 'Cancel', cssClass: 'btn btn-default', action: cbCancel},
                {id: 'btn-ok', label: 'Ok', cssClass: 'btn btn-primary', action: cbOk}
            ];
            buttons = opts.buttons || [];
            if (typeof input === "object") {
                $inputDiv = $(document.createElement('div'));
                $input = $(document.createElement('input'));
                if (input['name'] === undefined) {
                    $input.attr('name', 'krajee-dialog-prompt');
                }
                if (input['type'] === undefined) {
                    $input.attr('type', 'text');
                }
                if (input['class'] === undefined) {
                    $input.addClass('form-control');
                }
                $.each(input, function(key, val) {
                    if (key !== 'label') {
                        $input.attr(key, val);
                    }
                });
                if (input.label !== undefined) {
                    msg = '<label for="' + $input.attr('name') + '" class="control-label">' + input.label + '</label>';
                }
                $inputDiv.append($input);
                msg += $inputDiv.html();
                $input.remove();
                $inputDiv.remove();
            } else {
                msg = input;
            }
            opts.message = msg;
            for (i = 0; i < defaultButtons.length; i++) {
                buttons[i] = window.jQuery.extend(true, {}, defaultButtons[i], buttons[i]);
            }
            opts.buttons = buttons;
            window.BootstrapDialog.show(opts);
        }
    };
})();