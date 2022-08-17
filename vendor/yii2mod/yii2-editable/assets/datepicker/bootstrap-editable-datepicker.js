/**
 Bootstrap-datepicker.
 Description and examples: https://github.com/eternicode/bootstrap-datepicker.
 For **i18n** you should include js file from here: https://github.com/eternicode/bootstrap-datepicker/tree/master/js/locales
 and set `language` option.
 Since 1.4.0 date has different appearance in **popup** and **inline** modes.

 @class date
 @extends abstractinput
 @final
 @example
 <a href="#" id="dob" data-type="date" data-pk="1" data-url="/post" data-title="Select date">15/05/1984</a>
 <script>
 $(function(){
    $('#dob').editable({
        format: 'yyyy-mm-dd',    
        viewformat: 'dd/mm/yyyy',    
        datepicker: {
                weekStart: 1
           }
        }
    });
 });
 </script>
 **/
(function ($) {
    "use strict";

    //store bootstrap-datepicker as bdateicker to exclude conflict with jQuery UI one
    $.fn.bdatepicker = $.fn.datepicker.noConflict();
    if (!$.fn.datepicker) { //if there were no other datepickers, keep also original name
        $.fn.datepicker = $.fn.bdatepicker;
    }

    var Date = function (options) {
        this.init('date', options, Date.defaults);
        this.initPicker(options, Date.defaults);
    };

    $.fn.editableutils.inherit(Date, $.fn.editabletypes.abstractinput);

    $.extend(Date.prototype, {
        dateValue: null,
        initPicker: function (options, defaults) {
            //'format' is set directly from settings or data-* attributes

            //by default viewformat equals to format
            if (!this.options.viewformat) {
                this.options.viewformat = this.options.format;
            }

            //try parse datepicker config defined as json string in data-datepicker
            options.datepicker = $.fn.editableutils.tryParseJson(options.datepicker, true);

            //overriding datepicker config (as by default jQuery extend() is not recursive)
            //since 1.4 datepicker internally uses viewformat instead of format. Format is for submit only
            this.options.datepicker = $.extend({}, defaults.datepicker, options.datepicker, {
                format: this.options.viewformat
            });

            //language
            this.options.datepicker.language = this.options.datepicker.language || 'en';

            //store DPglobal
            this.dpg = $.fn.bdatepicker.DPGlobal;

            //store parsed formats
            this.parsedFormat = this.dpg.parseFormat(this.options.format);
            this.parsedViewFormat = this.dpg.parseFormat(this.options.viewformat);
        },

        render: function () {
            var self = this;
            this.$input.bdatepicker(this.options.datepicker).off('changeDate').on('changeDate', function (e) {
                self.dateValue = e.format(0);
            });

            //"clear" link
            if (this.options.clear) {
                this.$clear = $('<a href="#"></a>').html(this.options.clear).click($.proxy(function (e) {
                    e.preventDefault();
                    e.stopPropagation();
                    this.clear();
                }, this));

                this.$tpl.parent().append($('<div class="editable-clear">').append(this.$clear));
            }
        },

        value2html: function (value, element) {
            var text = value ? this.dpg.formatDate(value, this.parsedViewFormat, this.options.datepicker.language) : '';
            Date.superclass.value2html.call(this, text, element);
        },

        html2value: function (html) {
            return this.parseDate(html, this.parsedViewFormat);
        },

        value2str: function (value) {
            return value ? this.dpg.formatDate(value, this.parsedFormat, this.options.datepicker.language) : '';
        },

        str2value: function (str) {
            return this.parseDate(str, this.parsedFormat);
        },

        value2submit: function (value) {
            return this.value2str(value);
        },

        value2input: function (value) {
            this.$input.bdatepicker('update', value);
        },

        input2value: function () {
            return this.$input.bdatepicker('getDates')[0];
        },

        activate: function () {
        },

        clear: function () {
            this.$input.data('datepicker').date = null;
            this.$input.find('.active').removeClass('active');
            if (!this.options.showbuttons) {
                this.$input.closest('form').submit();
            }
        },

        autosubmit: function () {
            this.$input.on('mouseup', '.day', function (e) {
                if ($(e.currentTarget).is('.old') || $(e.currentTarget).is('.new')) {
                    return;
                }
                var $form = $(this).closest('form');
                setTimeout(function () {
                    $form.submit();
                }, 200);
            });
            //changedate is not suitable as it triggered when showing datepicker. see #149
            /*
             this.$input.on('changeDate', function(e){
             var $form = $(this).closest('form');
             setTimeout(function() {
             $form.submit();
             }, 200);
             });
             */
        },

        /*
         For incorrect date bootstrap-datepicker returns current date that is not suitable
         for datefield.
         This function returns null for incorrect date.
         */
        parseDate: function (str, format) {
            var date = null, formattedBack;
            if (str) {
                date = this.dpg.parseDate(str, format, this.options.datepicker.language);
                if (typeof str === 'string') {
                    formattedBack = this.dpg.formatDate(date, format, this.options.datepicker.language);
                    if (str !== formattedBack) {
                        date = null;
                    }
                }
            }
            return date;
        }

    });

    Date.defaults = $.extend({}, $.fn.editabletypes.abstractinput.defaults, {
        /**
         @property tpl
         @default <div></div>
         **/
        tpl: '<div class="editable-date well"></div>',
        /**
         @property inputclass
         @default null
         **/
        inputclass: null,
        /**
         Format used for sending value to server. Also applied when converting date from <code>data-value</code> attribute.<br>
         Possible tokens are: <code>d, dd, m, mm, yy, yyyy</code>

         @property format
         @type string
         @default yyyy-mm-dd
         **/
        format: 'yyyy-mm-dd',
        /**
         Format used for displaying date. Also applied when converting date from element's text on init.
         If not specified equals to <code>format</code>

         @property viewformat
         @type string
         @default null
         **/
        viewformat: null,
        /**
         Configuration of datepicker.
         Full list of options: http://bootstrap-datepicker.readthedocs.org/en/latest/options.html

         @property datepicker
         @type object
         @default {
            weekStart: 0,
            startView: 0,
            minViewMode: 0,
            autoclose: false
        }
         **/
        datepicker: {
            weekStart: 0,
            startView: 0,
            minViewMode: 0,
            autoclose: false
        },
        /**
         Text shown as clear date button.
         If <code>false</code> clear button will not be rendered.

         @property clear
         @type boolean|string
         @default 'x clear'
         **/
        clear: '&times; clear'
    });

    $.fn.editabletypes.date = Date;

}(window.jQuery));

/**
 Bootstrap datefield input - modification for inline mode.
 Shows normal <input type="text"> and binds popup datepicker.
 Automatically shown in inline mode.

 @class datefield
 @extends date

 @since 1.4.0
 **/
(function ($) {
    "use strict";

    var DateField = function (options) {
        this.init('datefield', options, DateField.defaults);
        this.initPicker(options, DateField.defaults);
    };

    $.fn.editableutils.inherit(DateField, $.fn.editabletypes.date);

    $.extend(DateField.prototype, {
        render: function () {

            this.$input = this.$tpl.find('input');
            this.setClass();
            this.setAttr('placeholder');

            //bootstrap-datepicker is set `bdateicker` to exclude conflict with jQuery UI one. (in date.js)        
            this.$tpl.bdatepicker(this.options.datepicker);

            //need to disable original event handlers
            this.$input.off('focus keydown');

            //update value of datepicker
            this.$input.keyup($.proxy(function () {
                this.$tpl.removeData('date');
                this.$tpl.bdatepicker('update');
            }, this));

        },

        value2input: function (value) {
            this.$input.val(value ? this.dpg.formatDate(value, this.parsedViewFormat, this.options.datepicker.language) : '');
            this.$tpl.bdatepicker('update');
        },

        input2value: function () {
            return this.html2value(this.$input.val());
        },

        activate: function () {
            $.fn.editabletypes.text.prototype.activate.call(this);
        },

        autosubmit: function () {
            //reset autosubmit to empty
        }
    });

    DateField.defaults = $.extend({}, $.fn.editabletypes.date.defaults, {
        /**
         @property tpl
         **/
        tpl: '<div class="input-group date"><input type="text" class="form-control" readonly><span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span></div>',
        /**
         @property inputclass
         @default 'input-small'
         **/
        inputclass: 'input-small',

        /* datepicker config */
        datepicker: {
            weekStart: 0,
            startView: 0,
            minViewMode: 0,
            autoclose: true
        }
    });

    $.fn.editabletypes.datefield = DateField;

}(window.jQuery));