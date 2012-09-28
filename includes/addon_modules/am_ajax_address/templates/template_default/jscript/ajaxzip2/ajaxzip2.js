/* ================================================================ *
    ajaxzip2.js ---- AjaxZip2 Õπ ÿ»÷πÊ¢™ΩªΩÍ —¥π•È•§•÷•È•Í

    Copyright (c) 2006-2007 Kawasaki Yusuke <u-suke [at] kawa.net>
    http://www.kawa.net/works/ajax/ajaxzip2/ajaxzip2.html

    Permission is hereby granted, free of charge, to any person
    obtaining a copy of this software and associated documentation
    files (the "Software"), to deal in the Software without
    restriction, including without limitation the rights to use,
    copy, modify, merge, publish, distribute, sublicense, and/or sell
    copies of the Software, and to permit persons to whom the
    Software is furnished to do so, subject to the following
    conditions:

    The above copyright notice and this permission notice shall be
    included in all copies or substantial portions of the Software.

    THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
    EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES
    OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
    NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT
    HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY,
    WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
    FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR
    OTHER DEALINGS IN THE SOFTWARE.
* ================================================================ */

AjaxZip2 = function () {};
AjaxZip2.VERSION = '2.10';
AjaxZip2.JSONDATA = JSONDATA;
AjaxZip2.CACHE = [];
AjaxZip2.prev = '';
AjaxZip2.PREFMAP = [
    null,       'ÀÃ≥§∆ª',   '¿ƒøπ∏©',   '¥‰ºÍ∏©',   'µ‹æÎ∏©',
    'Ω©≈ƒ∏©',   'ª≥∑¡∏©',   ' °≈Á∏©',   '∞ÒæÎ∏©',   '∆ Ã⁄∏©',
    '∑≤«œ∏©',   '∫Î∂Ã∏©',   '¿ÈÕ’∏©',   '≈Ïµ˛≈‘',   'ø¿∆‡¿Ó∏©',
    'ø∑≥„∏©',   '…Ÿª≥∏©',   '¿–¿Ó∏©',   ' °∞Ê∏©',   'ª≥Õ¸∏©',
    'ƒπÃÓ∏©',   '¥Ù…Ï∏©',   '¿≈≤¨∏©',   '∞¶√Œ∏©',   'ª∞Ω≈∏©',
    'º¢≤Ï∏©',   'µ˛≈‘…‹',   '¬Á∫Â…‹',   ' º∏À∏©',   '∆‡Œ…∏©',
    'œ¬≤Œª≥∏©', 'ƒªºË∏©',   '≈Á∫¨∏©',   '≤¨ª≥∏©',   'π≠≈Á∏©',
    'ª≥∏˝∏©',   '∆¡≈Á∏©',   'π·¿Ó∏©',   '∞¶…≤∏©',   'π‚√Œ∏©',
    ' °≤¨∏©',   '∫¥≤Ï∏©',   'ƒπ∫Í∏©',   '∑ßÀ‹∏©',   '¬Á ¨∏©',
    'µ‹∫Í∏©',   'ºØª˘≈Á∏©', '≤≠∆Ï∏©'
];
AjaxZip2.zip2addr = function ( azip1, apref, aaddr, azip2, astrt, aarea ) {
    var fzip1 = AjaxZip2.getElementByName(azip1);
    var fzip2 = AjaxZip2.getElementByName(azip2,fzip1);
    var fpref = AjaxZip2.getElementByName(apref,fzip1);
    var faddr = AjaxZip2.getElementByName(aaddr,fzip1);
    var fstrt = AjaxZip2.getElementByName(astrt,fzip1);
    var farea = AjaxZip2.getElementByName(aarea,fzip1);
    if ( ! fzip1 ) return;
    if ( ! fpref ) return;
    if ( ! faddr ) return;

    // Õπ ÿ»÷πÊ§ÚøÙª˙§Œ§ﬂ7∑ÂºË§ÍΩ–§π
    var vzip = fzip1.value;
    if ( fzip2 && fzip2.value ) vzip += fzip2.value;
    if ( ! vzip ) return;
    var nzip = '';
    for( var i=0; i<vzip.length; i++ ) {
        var chr = vzip.charCodeAt(i);
        if ( chr < 48 ) continue;
        if ( chr > 57 ) continue;
        nzip += vzip.charAt(i);
    }
    if ( nzip.length < 7 ) return;

    // ¡∞≤Û§»∆±§∏√Õ°ı•’•©°º•‡§ §È•≠•„•Û•ª•Î
    var uniq = nzip+fzip1.name+fpref.name+faddr.name;
    if ( fzip1.form ) uniq += fzip1.form.id+fzip1.form.name+fzip1.form.action;
    if ( fzip2 ) uniq += fzip2.name;
    if ( fstrt ) uniq += fstrt.name;
    if ( uniq == AjaxZip2.prev ) return;
    AjaxZip2.prev = uniq;

    // JSONºË∆¿∏Â§Œ•≥°º•Î•–•√•Ø¥ÿøÙ
    var func1 = function ( data ) {
        var array = data[nzip];
        // Opera •–•∞¬–∫ˆ°ß0x00800000 §Úƒ∂§®§Î≈∫ª˙§œ +0xff000000 §µ§Ï§∆§∑§ﬁ§¶
        var opera = (nzip-0+0xff000000)+"";
        if ( ! array && data[opera] ) array = data[opera];
        if ( ! array ) return;
        var pref_id = array[0];                 // ≈‘∆ª…‹∏©ID
        if ( ! pref_id ) return;
        var jpref = AjaxZip2.PREFMAP[pref_id];  // ≈‘∆ª…‹∏©Ãæ
        if ( ! jpref ) return;
        var jcity = array[1];
        if ( ! jcity ) jcity = '';              // ª‘∂ËƒÆ¬ºÃæ
        var jarea = array[2];
        if ( ! jarea ) jarea = '';              // ƒÆ∞ËÃæ
        var jstrt = array[3];
        if ( ! jstrt ) jstrt = '';              // »÷√œ

        var cursor = faddr;
        var jaddr = jcity;                      // ª‘∂ËƒÆ¬ºÃæ

        if ( fpref.type == 'select-one' || fpref.type == 'select-multiple' ) {
            // ≈‘∆ª…‹∏©•◊•Î•¿•¶•Û§ŒæÏπÁ
            var opts = fpref.options;
            for( var i=0; i<opts.length; i++ ) {
                var vpref = opts[i].value;
                var tpref = opts[i].text;
                opts[i].selected = ( vpref == pref_id || vpref == jpref || tpref == jpref );
            }
        } else {
            if ( fpref.name == faddr.name ) {
                // ≈‘∆ª…‹∏©Ãæ°‹ª‘∂ËƒÆ¬ºÃæ°‹ƒÆ∞ËÃæπÁ¬Œ§ŒæÏπÁ
                jaddr = jpref + jaddr;
            } else {
                // ≈‘∆ª…‹∏©Ãæ•∆•≠•π•»∆˛Œœ§ŒæÏπÁ
                fpref.value = jpref;
            }
        }
        if ( farea ) {
            cursor = farea;
            farea.value = jarea;
        } else {
            jaddr += jarea;
        }
        if ( fstrt ) {
            cursor = fstrt;
            if ( faddr.name == fstrt.name ) {
                // ª‘∂ËƒÆ¬ºÃæ°‹ƒÆ∞ËÃæ°‹»÷√œπÁ¬Œ§ŒæÏπÁ
                jaddr = jaddr + jstrt;
            } else if ( jstrt ) {
                // »÷√œ•∆•≠•π•»∆˛ŒœÕÛ§¨§¢§ÎæÏπÁ
                fstrt.value = jstrt;
            }
        }
        faddr.value = jaddr;

        // patch from http://iwa-ya.sakura.ne.jp/blog/2006/10/20/050037
        // update http://www.kawa.net/works/ajax/ajaxzip2/ajaxzip2.html#com-2006-12-15T04:41:22Z
        if ( ! cursor ) return;
        if ( ! cursor.value ) return;
        var len = cursor.value.length;
        cursor.focus();
        if ( cursor.createTextRange ) {
            var range = cursor.createTextRange();
            range.move('character', len);
            range.select();
        } else if (cursor.setSelectionRange) {
            cursor.setSelectionRange(len,len);
        }
    };

    // Õπ ÿ»÷πÊæÂ∞Ã3∑Â§«•≠•„•√•∑•Â•«°º•ø§Ú≥Œ«ß
    var zip3 = nzip.substr(0,3);
    var data = AjaxZip2.CACHE[zip3];
    if ( data ) return func1( data );

    // JSON•’•°•§•Î§ÚºıøÆ§π§Î
    var url = AjaxZip2.JSONDATA+'/zip-'+zip3+'.json';

    if ( window.Ajax && Ajax.Request ) {
        // JSON•’•°•§•ÎºıøÆ∏Â§Œ•≥°º•Î•–•√•Ø¥ÿøÙ° Prototype.JSÕ—°À
        var func2 = function (req) {
            if ( ! req ) return;
            if ( ! req.responseText ) return;
            var json = AjaxZip2.getResponseText( req );
            data = eval('('+json+')');
            AjaxZip2.CACHE[zip3] = data;
            func1( data );
        };
        var opt = {
            method: 'GET',
            asynchronous: true,
            onComplete: func2
        };
        new Ajax.Request( url, opt );
    }
    else if ( window.jQuery ) {
        // JSON•’•°•§•ÎºıøÆ∏Â§Œ•≥°º•Î•–•√•Ø¥ÿøÙ° jQueryÕ—°À
        var func3 = function (data) {
            if ( ! data ) return;
            AjaxZip2.CACHE[zip3] = data;
            func1( data );
        };
        jQuery.getJSON( url, func3 );
    }
};

// Safari  ∏ª˙≤Ω§±¬–±˛
// http://kawa.at.webry.info/200511/article_9.html
AjaxZip2.getResponseText = function ( req ) {
    var text = req.responseText;
    if ( navigator.appVersion.indexOf('KHTML') > -1 ) {
        var esc = escape( text );
        if ( esc.indexOf('%u') < 0 && esc.indexOf('%') > -1 ) {
            text = decodeURIComponent( esc );
        }
    }
    return text;
}

// •’•©°º•‡name§´§ÈÕ◊¡«§ÚºË§ÍΩ–§π
AjaxZip2.getElementByName = function ( elem, sibling ) {
    if ( typeof(elem) == 'string' ) {
        var list = document.getElementsByName(elem);
        if ( ! list ) return null;
        if ( list.length > 1 && sibling && sibling.form ) {
            var form = sibling.form.elements;
            for( var i=0; i<form.length; i++ ) {
                if ( form[i].name == elem ) {
                    return form[i];
                }
            }
        } else {
            return list[0];
        }
    }
    return elem;
}
