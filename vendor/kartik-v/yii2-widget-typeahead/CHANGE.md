Change Log: `yii2-widget-typeahead`
===================================

## Version 1.0.5

**Date:** 21-Dec-2021

- (enh #47): Update handlebars JS to latest release.
- (enh #46): Correct CSS styling for input readonly.

## Version 1.0.4

**Date:** 29-May-2019

- (enh #37): Allow empty local array.
- (enh #32): Remove enforcement on empty arrays for widget.
- Implement stale bot

## Version 1.0.3

**Date:** 09-Oct-2018

- Bump composer dependencies.

## Version 1.0.2

**Date:** 05-Aug-2018

- (enh #26): Update composer dependency for `yii2-krajee-base`.
- Update Handlebars js assets to latest release v4.1.1.
- (enh #21): Update typeahead js assets to latest release from fork `corejavascript/typeahead`.
- Better initialization of JS for PJAX scenario.
- Reorganize source code in `src` directory.
- (enh #20): Allow configuration of input type with new property `TypeAheadBasic::inputType`.
- Add composer branch alias for latest dev-master release.
- Add github contribution and PR log templates.
- (enh #9): Fix documentation typo.

## Version 1.0.1

**Date:** 28-Jun-2015

- (enh #8): Fix plugin for typeahead hints.
- (enh #7): Feature enhancements for plugin v0.11.1.
    - Simplify the list suggestions data to a linear array
    - Enhance dataset configuration for `TypeaheadBasic` and `Typeahead` to distinctly capture Bloodhound properties.
    - Added `defaultSuggestions` property.
    - Bootstrap styling enhancements
    - New enhanced custom javascript methods in `typeahead-kv.js` - (`kvInitTA` and `kvSubstringMatcher`).
    - Include ability to show loading indicator for ajax / remote requests.
- (enh #6): Update to latest release v0.11.1 of typeahead.js plugin.
- (enh #5): Implement default suggestions feature.

## Version 1.0.0

**Date:** 08-Nov-2014

- Initial release 
- Sub repo split from [yii2-widgets](https://github.com/kartik-v/yii2-widgets)