/**
 * Created by bface007 on 07/09/2015.
 */
var css3Supports = (function (document) {
    'use strict';
    var div = document.createElement('div'),
        vendors = ['Khtml', 'Ms', 'O', 'Webkit'],
        len = vendors.length;

    return function (prop) {
        if (div.style.hasOwnProperty(prop)) {return true; }

        prop = prop.replace(/^[a-z]/, function (val) {
            return val.toUpperCase();
        });

        while (len--) {
            if (div.style.hasOwnProperty(vendors[len] + prop)) {
                // browser supports box-shadow. Do what you need.
                // Or use a bang (!) to test if the browser doesn't.
                return true;
            }
        }
        return false;
    };
}(document));

if (css3Supports('columnCount')) {
    document.documentElement.className += ' columnCount';
}