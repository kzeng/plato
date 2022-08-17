/*!
 * @package   yii2-dialog
 * @author    Kartik Visweswaran <kartikv2@gmail.com>
 * @copyright Copyright &copy; Kartik Visweswaran, Krajee.com, 2014 - 2021
 * @version   1.0.6
 *
 * Override Yii confirmation dialog with Krajee Dialog.
 *
 * For more JQuery plugins visit http://plugins.krajee.com
 * For more Yii related demos visit http://demos.krajee.com
 */
var krajeeYiiConfirm;
(function () {
    "use strict";
    krajeeYiiConfirm = function(dialog) {
        dialog = dialog || 'krajeeDialog';
        var krajeeDialog = window[dialog] || '';
        if (!krajeeDialog) {
            return;
        }
        yii.confirm = function (message, ok, cancel) {
            krajeeDialog.confirm(message, function(result) {
                if (result) {
                    !ok || ok();
                } else {
                    !cancel || cancel();
                }
            });
        };
    };
})();