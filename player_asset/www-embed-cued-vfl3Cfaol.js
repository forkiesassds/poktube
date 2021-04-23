/*
     FILE ARCHIVED ON 4:28:46 Apr 16, 2013 AND RETRIEVED FROM THE
     INTERNET ARCHIVE ON 23:02:40 Apr 23, 2021.
     JAVASCRIPT APPENDED BY WAYBACK MACHINE, COPYRIGHT INTERNET ARCHIVE.

     ALL OTHER CONTENT MAY ALSO BE PROTECTED BY COPYRIGHT (17 U.S.C.
     SECTION 108(a)(3)).
*/
(function() {
    var f = void 0,
        h = !0,
        k = null,
        m = !1,
        p, q = this;

    function r(a) {
        a = a.split(".");
        for (var b = q, c; c = a.shift();)
            if (b[c] != k) b = b[c];
            else return k;
        return b
    }

    function s(a) {
        var b = typeof a;
        if ("object" == b)
            if (a) {
                if (a instanceof Array) return "array";
                if (a instanceof Object) return b;
                var c = Object.prototype.toString.call(a);
                if ("[object Window]" == c) return "object";
                if ("[object Array]" == c || "number" == typeof a.length && "undefined" != typeof a.splice && "undefined" != typeof a.propertyIsEnumerable && !a.propertyIsEnumerable("splice")) return "array";
                if ("[object Function]" == c || "undefined" != typeof a.call && "undefined" != typeof a.propertyIsEnumerable && !a.propertyIsEnumerable("call")) return "function"
            } else return "null";
        else if ("function" == b && "undefined" == typeof a.call) return "object";
        return b
    }

    function aa(a) {
        var b = s(a);
        return "array" == b || "object" == b && "number" == typeof a.length
    }

    function t(a) {
        return "string" == typeof a
    }
    var ba = "closure_uid_" + (1E9 * Math.random() >>> 0),
        ca = 0;

    function da(a, b, c) {
        return a.call.apply(a.bind, arguments)
    }

    function ea(a, b, c) {
        if (!a) throw Error();
        if (2 < arguments.length) {
            var d = Array.prototype.slice.call(arguments, 2);
            return function() {
                var c = Array.prototype.slice.call(arguments);
                Array.prototype.unshift.apply(c, d);
                return a.apply(b, c)
            }
        }
        return function() {
            return a.apply(b, arguments)
        }
    }

    function u(a, b, c) {
        u = Function.prototype.bind && -1 != Function.prototype.bind.toString().indexOf("native code") ? da : ea;
        return u.apply(k, arguments)
    }

    function fa(a, b) {
        var c = Array.prototype.slice.call(arguments, 1);
        return function() {
            var b = Array.prototype.slice.call(arguments);
            b.unshift.apply(b, c);
            return a.apply(this, b)
        }
    }
    var ga = Date.now || function() {
        return +new Date
    };

    function v(a, b) {
        var c = a.split("."),
            d = q;
        !(c[0] in d) && d.execScript && d.execScript("var " + c[0]);
        for (var e; c.length && (e = c.shift());) !c.length && b !== f ? d[e] = b : d = d[e] ? d[e] : d[e] = {}
    }

    function w(a, b) {
        function c() {}
        c.prototype = b.prototype;
        a.A = b.prototype;
        a.prototype = new c
    }
    Function.prototype.bind = Function.prototype.bind || function(a, b) {
        if (1 < arguments.length) {
            var c = Array.prototype.slice.call(arguments, 1);
            c.unshift(this, a);
            return u.apply(k, c)
        }
        return u(this, a)
    };

    function ha(a) {
        return decodeURIComponent(a.replace(/\+/g, " "))
    }
    var ia = /&/g,
        ja = /</g,
        ka = />/g,
        la = /\"/g,
        ma = /[&<>\"]/;

    function na(a) {
        var b = Number(a);
        return 0 == b && /^[\s\xa0]*$/.test(a) ? NaN : b
    };
    var x = Array.prototype,
        oa = x.indexOf ? function(a, b, c) {
            return x.indexOf.call(a, b, c)
        } : function(a, b, c) {
            c = c == k ? 0 : 0 > c ? Math.max(0, a.length + c) : c;
            if (t(a)) return !t(b) || 1 != b.length ? -1 : a.indexOf(b, c);
            for (; c < a.length; c++)
                if (c in a && a[c] === b) return c;
            return -1
        },
        y = x.forEach ? function(a, b, c) {
            x.forEach.call(a, b, c)
        } : function(a, b, c) {
            for (var d = a.length, e = t(a) ? a.split("") : a, g = 0; g < d; g++) g in e && b.call(c, e[g], g, a)
        },
        pa = x.filter ? function(a, b, c) {
            return x.filter.call(a, b, c)
        } : function(a, b, c) {
            for (var d = a.length, e = [], g = 0, l = t(a) ? a.split("") :
                    a, n = 0; n < d; n++)
                if (n in l) {
                    var H = l[n];
                    b.call(c, H, n, a) && (e[g++] = H)
                } return e
        },
        qa = x.some ? function(a, b, c) {
            return x.some.call(a, b, c)
        } : function(a, b, c) {
            for (var d = a.length, e = t(a) ? a.split("") : a, g = 0; g < d; g++)
                if (g in e && b.call(c, e[g], g, a)) return h;
            return m
        };

    function z(a, b) {
        return 0 <= oa(a, b)
    }

    function ra(a) {
        return x.concat.apply(x, arguments)
    }

    function sa(a) {
        var b = a.length;
        if (0 < b) {
            for (var c = Array(b), d = 0; d < b; d++) c[d] = a[d];
            return c
        }
        return []
    }

    function ta(a, b) {
        for (var c = 1; c < arguments.length; c++) {
            var d = arguments[c],
                e;
            if ("array" == s(d) || (e = aa(d)) && Object.prototype.hasOwnProperty.call(d, "callee")) a.push.apply(a, d);
            else if (e)
                for (var g = a.length, l = d.length, n = 0; n < l; n++) a[g + n] = d[n];
            else a.push(d)
        }
    }

    function ua(a, b, c) {
        return 2 >= arguments.length ? x.slice.call(a, b) : x.slice.call(a, b, c)
    }

    function va(a) {
        for (var b = [], c = 0; c < arguments.length; c++) {
            var d = arguments[c];
            "array" == s(d) ? b.push.apply(b, va.apply(k, d)) : b.push(d)
        }
        return b
    };

    function wa(a, b) {
        this.width = a;
        this.height = b
    }
    wa.prototype.R = function() {
        return new wa(this.width, this.height)
    };
    wa.prototype.floor = function() {
        this.width = Math.floor(this.width);
        this.height = Math.floor(this.height);
        return this
    };
    wa.prototype.scale = function(a, b) {
        this.width *= a;
        this.height *= "number" == typeof b ? b : a;
        return this
    };

    function xa(a) {
        var b = [],
            c = 0,
            d;
        for (d in a) b[c++] = a[d];
        return b
    }

    function ya(a) {
        var b = [],
            c = 0,
            d;
        for (d in a) b[c++] = d;
        return b
    }

    function za(a) {
        var b = A,
            c;
        for (c in b)
            if (a.call(f, b[c], c, b)) return c
    }

    function Aa(a) {
        var b = {},
            c;
        for (c in a) b[c] = a[c];
        return b
    }
    var Ba = "constructor hasOwnProperty isPrototypeOf propertyIsEnumerable toLocaleString toString valueOf".split(" ");

    function Ca(a, b) {
        for (var c, d, e = 1; e < arguments.length; e++) {
            d = arguments[e];
            for (c in d) a[c] = d[c];
            for (var g = 0; g < Ba.length; g++) c = Ba[g], Object.prototype.hasOwnProperty.call(d, c) && (a[c] = d[c])
        }
    };
    var B, Da, Ea, Fa;

    function Ga() {
        return q.navigator ? q.navigator.userAgent : k
    }
    Fa = Ea = Da = B = m;
    var Ha;
    if (Ha = Ga()) {
        var Ia = q.navigator;
        B = 0 == Ha.indexOf("Opera");
        Da = !B && -1 != Ha.indexOf("MSIE");
        Ea = !B && -1 != Ha.indexOf("WebKit");
        Fa = !B && !Ea && "Gecko" == Ia.product
    }
    var C = Da,
        Ja = Fa,
        Ka = Ea;

    function La() {
        var a = q.document;
        return a ? a.documentMode : f
    }
    var Ma;
    a: {
        var Na = "",
            Oa;
        if (B && q.opera) var Pa = q.opera.version,
            Na = "function" == typeof Pa ? Pa() : Pa;
        else if (Ja ? Oa = /rv\:([^\);]+)(\)|;)/ : C ? Oa = /MSIE\s+([^\);]+)(\)|;)/ : Ka && (Oa = /WebKit\/(\S+)/), Oa) var Qa = Oa.exec(Ga()),
            Na = Qa ? Qa[1] : "";
        if (C) {
            var Ra = La();
            if (Ra > parseFloat(Na)) {
                Ma = String(Ra);
                break a
            }
        }
        Ma = Na
    }
    var Sa = Ma,
        Ta = {};

    function Ua(a) {
        if (!Ta[a]) {
            for (var b = 0, c = String(Sa).replace(/^[\s\xa0]+|[\s\xa0]+$/g, "").split("."), d = String(a).replace(/^[\s\xa0]+|[\s\xa0]+$/g, "").split("."), e = Math.max(c.length, d.length), g = 0; 0 == b && g < e; g++) {
                var l = c[g] || "",
                    n = d[g] || "",
                    H = RegExp("(\\d*)(\\D*)", "g"),
                    zc = RegExp("(\\d*)(\\D*)", "g");
                do {
                    var D = H.exec(l) || ["", "", ""],
                        E = zc.exec(n) || ["", "", ""];
                    if (0 == D[0].length && 0 == E[0].length) break;
                    b = ((0 == D[1].length ? 0 : parseInt(D[1], 10)) < (0 == E[1].length ? 0 : parseInt(E[1], 10)) ? -1 : (0 == D[1].length ? 0 : parseInt(D[1],
                        10)) > (0 == E[1].length ? 0 : parseInt(E[1], 10)) ? 1 : 0) || ((0 == D[2].length) < (0 == E[2].length) ? -1 : (0 == D[2].length) > (0 == E[2].length) ? 1 : 0) || (D[2] < E[2] ? -1 : D[2] > E[2] ? 1 : 0)
                } while (0 == b)
            }
            Ta[a] = 0 <= b
        }
    }
    var Va = q.document,
        Wa = !Va || !C ? f : La() || ("CSS1Compat" == Va.compatMode ? parseInt(Sa, 10) : 5);
    !Ja && !C || C && C && 9 <= Wa || Ja && Ua("1.9.1");
    C && Ua("9");

    function F(a) {
        a = a.className;
        return t(a) && a.match(/\S+/g) || []
    }

    function Xa(a, b) {
        for (var c = F(a), d = ua(arguments, 1), e = c, g = 0; g < d.length; g++) z(e, d[g]) || e.push(d[g]);
        a.className = c.join(" ")
    }

    function Ya(a, b) {
        var c = F(a),
            d = ua(arguments, 1),
            c = Za(c, d);
        a.className = c.join(" ")
    }

    function Za(a, b) {
        return pa(a, function(a) {
            return !z(b, a)
        })
    }

    function $a(a, b) {
        var c = !z(F(a), b);
        c ? Xa(a, b) : Ya(a, b);
        return c
    };

    function G(a, b) {
        var c = b || document;
        c.querySelectorAll && c.querySelector ? c = c.querySelector("." + a) : (c = b || document, c = (c.querySelectorAll && c.querySelector ? c.querySelectorAll("." + a) : c.getElementsByClassName ? c.getElementsByClassName(a) : ab(a, b))[0]);
        return c || k
    }

    function ab(a, b) {
        var c, d, e, g;
        c = document;
        c = b || c;
        if (c.querySelectorAll && c.querySelector && a) return c.querySelectorAll("" + (a ? "." + a : ""));
        if (a && c.getElementsByClassName) {
            var l = c.getElementsByClassName(a);
            return l
        }
        l = c.getElementsByTagName("*");
        if (a) {
            g = {};
            for (d = e = 0; c = l[d]; d++) {
                var n = c.className;
                "function" == typeof n.split && z(n.split(/\s+/), a) && (g[e++] = c)
            }
            g.length = e;
            return g
        }
        return l
    }

    function bb(a) {
        var b;
        b = cb.a;
        if (b.contains && 1 == a.nodeType) return b == a || b.contains(a);
        if ("undefined" != typeof b.compareDocumentPosition) return b == a || Boolean(b.compareDocumentPosition(a) & 16);
        for (; a && b != a;) a = a.parentNode;
        return a == b
    }

    function db(a, b) {
        if ("textContent" in a) a.textContent = b;
        else if (a.firstChild && 3 == a.firstChild.nodeType) {
            for (; a.lastChild != a.firstChild;) a.removeChild(a.lastChild);
            a.firstChild.data = b
        } else {
            for (var c; c = a.firstChild;) a.removeChild(c);
            a.appendChild((9 == a.nodeType ? a : a.ownerDocument || a.document).createTextNode(String(b)))
        }
    }

    function eb(a, b, c) {
        for (var d = c == k, e = 0; a && (d || e <= c);) {
            if (b(a)) return a;
            a = a.parentNode;
            e++
        }
        return k
    };
    var fb = r("yt.dom.getNextId_");
    if (!fb) {
        fb = function() {
            return ++gb
        };
        v("yt.dom.getNextId_", fb);
        var gb = 0
    }

    function hb(a, b) {
        if (a in b) return b[a];
        var c = a.charAt(0).toUpperCase() + a.substr(1);
        if ("moz" + c in b) return b["moz" + c];
        if ("ms" + c in b) return b["ms" + c];
        if ("o" + c in b) return b["o" + c];
        if ("webkit" + c in b) return b["webkit" + c]
    }

    function ib() {
        var a = document,
            b;
        qa(["fullscreenEnabled", "fullScreenEnabled"], function(c) {
            b = hb(c, a);
            return !!b
        });
        return b
    };

    function jb(a) {
        if (a = a || window.event) {
            for (var b in a) b in kb || (this[b] = a[b]);
            this.scale = a.scale;
            this.rotation = a.rotation;
            if ((b = a.target || a.srcElement) && 3 == b.nodeType) b = b.parentNode;
            this.target = b;
            if (b = a.relatedTarget) try {
                b = b.nodeName && b
            } catch (c) {
                b = k
            } else "mouseover" == this.type ? b = a.fromElement : "mouseout" == this.type && (b = a.toElement);
            this.relatedTarget = b;
            this.clientX = a.clientX != f ? a.clientX : a.pageX;
            this.clientY = a.clientY != f ? a.clientY : a.pageY;
            if (document.body && document.documentElement) {
                b = document.body.scrollLeft +
                    document.documentElement.scrollLeft;
                var d = document.body.scrollTop + document.documentElement.scrollTop;
                this.pageX = a.pageX != f ? a.pageX : a.clientX + b;
                this.pageY = a.pageY != f ? a.pageY : a.clientY + d
            }
            this.keyCode = a.keyCode ? a.keyCode : a.which;
            this.charCode = a.charCode || ("keypress" == this.type ? this.keyCode : 0);
            this.altKey = a.altKey;
            this.ctrlKey = a.ctrlKey;
            this.shiftKey = a.shiftKey;
            "MozMousePixelScroll" == this.type ? (this.wheelDeltaX = a.axis == a.HORIZONTAL_AXIS ? a.detail : 0, this.wheelDeltaY = a.axis == a.HORIZONTAL_AXIS ? 0 : a.detail) :
                window.opera ? (this.wheelDeltaX = 0, this.wheelDeltaY = a.detail) : 0 == a.wheelDelta % 120 ? "WebkitTransform" in document.documentElement.style ? window.a && 0 == navigator.platform.indexOf("Mac") ? (this.wheelDeltaX = a.wheelDeltaX / -30, this.wheelDeltaY = a.wheelDeltaY / -30) : (this.wheelDeltaX = a.wheelDeltaX / -1.2, this.wheelDeltaY = a.wheelDeltaY / -1.2) : (this.wheelDeltaX = 0, this.wheelDeltaY = a.wheelDelta / -1.6) : (this.wheelDeltaX = a.wheelDeltaX / -3, this.wheelDeltaY = a.wheelDeltaY / -3)
        }
    }
    p = jb.prototype;
    p.type = "";
    p.target = k;
    p.relatedTarget = k;
    p.currentTarget = k;
    p.data = k;
    p.keyCode = 0;
    p.charCode = 0;
    p.altKey = m;
    p.ctrlKey = m;
    p.shiftKey = m;
    p.clientX = 0;
    p.clientY = 0;
    p.pageX = 0;
    p.pageY = 0;
    p.wheelDeltaX = 0;
    p.wheelDeltaY = 0;
    p.rotation = 0;
    p.scale = 1;
    var kb = {
        stopPropagation: 1,
        preventMouseEvent: 1,
        preventManipulation: 1,
        preventDefault: 1,
        layerX: 1,
        layerY: 1,
        scale: 1,
        rotation: 1
    };
    var A = r("yt.events.listeners_") || {};
    v("yt.events.listeners_", A);
    var lb = r("yt.events.counter_") || {
        count: 0
    };
    v("yt.events.counter_", lb);

    function mb(a, b, c, d) {
        return za(function(e) {
            return e[0] == a && e[1] == b && e[2] == c && e[4] == !!d
        })
    }

    function I(a, b, c, d) {
        if (!a || !a.addEventListener && !a.attachEvent) return "";
        d = !!d;
        var e = mb(a, b, c, d);
        if (e) return e;
        var e = ++lb.count + "",
            g = !(!("mouseenter" == b || "mouseleave" == b) || !a.addEventListener || "onmouseenter" in document),
            l;
        l = g ? function(d) {
            d = new jb(d);
            if (!eb(d.relatedTarget, function(c) {
                    return c == a
                })) return d.currentTarget = a, d.type = b, c.call(a, d)
        } : function(b) {
            b = new jb(b);
            b.currentTarget = a;
            return c.call(a, b)
        };
        A[e] = [a, b, c, l, d];
        a.addEventListener ? "mouseenter" == b && g ? a.addEventListener("mouseover", l, d) : "mouseleave" ==
            b && g ? a.addEventListener("mouseout", l, d) : "mousewheel" == b && "MozBoxSizing" in document.documentElement.style ? a.addEventListener("MozMousePixelScroll", l, d) : a.addEventListener(b, l, d) : a.attachEvent("on" + b, l);
        return e
    }

    function nb(a) {
        "string" == typeof a && (a = [a]);
        y(a, function(a) {
            if (a in A) {
                var c = A[a],
                    d = c[0],
                    e = c[1],
                    g = c[3],
                    c = c[4];
                d.removeEventListener ? d.removeEventListener(e, g, c) : d.detachEvent("on" + e, g);
                delete A[a]
            }
        })
    };

    function ob(a) {
        a = a || {};
        this.url = a.url || "";
        this.urlV8 = a.url_v8 || "";
        this.urlV9As2 = a.url_v9as2 || "";
        this.args = a.args || Aa(pb);
        this.assets = a.assets || {};
        this.attrs = a.attrs || Aa(qb);
        this.params = a.params || Aa(rb);
        this.minVersion = a.min_version || "8.0.0";
        this.fallback = a.fallback || k;
        this.fallbackMessage = a.fallbackMessage || k;
        this.html5 = !!a.html5;
        this.disable = a.disable || {}
    }
    var pb = {
            enablejsapi: 1
        },
        qb = {},
        rb = {
            allowscriptaccess: "always",
            allowfullscreen: "true",
            bgcolor: "#000000"
        };
    ob.prototype.R = function() {
        var a = new ob,
            b;
        for (b in this) {
            var c = this[b];
            "object" == s(c) ? a[b] = Aa(c) : a[b] = c
        }
        return a
    };

    function sb(a) {
        return a.dataset ? a.dataset.loaded : a.getAttribute("data-" + tb())
    };

    function ub(a, b) {
        a in J || (J[a] = []);
        J[a].push([b, f])
    }

    function vb(a, b) {
        if (a in J)
            for (var c = J[a], d = Array.prototype.slice.call(arguments, 1), e = 0, g = c.length; e < g; e++) c[e] && c[e][0].apply(c[e][1], d)
    }
    var J = {};

    function wb(a) {
        for (var b = 0, c = 0, d = a.length; c < d; ++c) b = 31 * b + a.charCodeAt(c), b %= 4294967296;
        return b
    }

    function tb() {
        return "loaded".replace(/([A-Z])/g, "-$1").toLowerCase()
    };

    function xb(a) {
        var b = yb,
            c = "js-" + wb(a),
            d = document.getElementById(c),
            e = d && sb(d),
            d = d && !e;
        if (e) b && b();
        else if (b && ub(c, b), !d) var g = zb(a, c, function() {
            if (!sb(g)) {
                var a = g;
                a.dataset ? a.dataset.loaded = "true" : a.setAttribute("data-" + tb(), "true");
                vb(c);
                c ? c in J && delete J[c] : J = {}
            }
        })
    }

    function zb(a, b, c) {
        var d = document.createElement("script");
        d.id = b;
        d.onload = function() {
            setTimeout(c, 0)
        };
        d.onreadystatechange = function() {
            switch (d.readyState) {
                case "loaded":
                case "complete":
                    d.onload()
            }
        };
        d.src = a;
        a = document.getElementsByTagName("head")[0] || document.body;
        a.insertBefore(d, a.firstChild);
        return d
    };

    function Ab(a) {
        this.b = a || window;
        this.a = []
    }
    Ab.prototype.b = k;
    Ab.prototype.a = k;

    function Bb(a, b, c) {
        c = u(c, a.b);
        b = I(b, "click", c);
        a.a.push(b)
    }
    Ab.prototype.removeAll = function() {
        for (var a = 0; a < this.a.length; a++) nb(this.a[a]);
        this.a = []
    };
    var Cb = "StopIteration" in q ? q.StopIteration : Error("StopIteration");

    function Db() {}
    Db.prototype.a = function() {
        throw Cb;
    };
    Db.prototype.Xb = function() {
        return this
    };

    function Eb(a) {
        if ("function" == typeof a.C) return a.C();
        if (t(a)) return a.split("");
        if (aa(a)) {
            for (var b = [], c = a.length, d = 0; d < c; d++) b.push(a[d]);
            return b
        }
        return xa(a)
    }

    function Fb(a, b, c) {
        if ("function" == typeof a.forEach) a.forEach(b, c);
        else if (aa(a) || t(a)) y(a, b, c);
        else {
            var d;
            if ("function" == typeof a.Q) d = a.Q();
            else if ("function" != typeof a.C)
                if (aa(a) || t(a)) {
                    d = [];
                    for (var e = a.length, g = 0; g < e; g++) d.push(g)
                } else d = ya(a);
            else d = f;
            for (var e = Eb(a), g = e.length, l = 0; l < g; l++) b.call(c, e[l], d && d[l], a)
        }
    };

    function Gb(a, b) {
        this.b = {};
        this.a = [];
        var c = arguments.length;
        if (1 < c) {
            if (c % 2) throw Error("Uneven number of arguments");
            for (var d = 0; d < c; d += 2) this.set(arguments[d], arguments[d + 1])
        } else if (a) {
            a instanceof Gb ? (c = a.Q(), d = a.C()) : (c = ya(a), d = xa(a));
            for (var e = 0; e < c.length; e++) this.set(c[e], d[e])
        }
    }
    p = Gb.prototype;
    p.S = 0;
    p.ca = 0;
    p.C = function() {
        Hb(this);
        for (var a = [], b = 0; b < this.a.length; b++) a.push(this.b[this.a[b]]);
        return a
    };
    p.Q = function() {
        Hb(this);
        return this.a.concat()
    };
    p.clear = function() {
        this.b = {};
        this.ca = this.S = this.a.length = 0
    };
    p.remove = function(a) {
        return K(this.b, a) ? (delete this.b[a], this.S--, this.ca++, this.a.length > 2 * this.S && Hb(this), h) : m
    };

    function Hb(a) {
        if (a.S != a.a.length) {
            for (var b = 0, c = 0; b < a.a.length;) {
                var d = a.a[b];
                K(a.b, d) && (a.a[c++] = d);
                b++
            }
            a.a.length = c
        }
        if (a.S != a.a.length) {
            for (var e = {}, c = b = 0; b < a.a.length;) d = a.a[b], K(e, d) || (a.a[c++] = d, e[d] = 1), b++;
            a.a.length = c
        }
    }
    p.get = function(a, b) {
        return K(this.b, a) ? this.b[a] : b
    };
    p.set = function(a, b) {
        K(this.b, a) || (this.S++, this.a.push(a), this.ca++);
        this.b[a] = b
    };
    p.R = function() {
        return new Gb(this)
    };
    p.Xb = function(a) {
        Hb(this);
        var b = 0,
            c = this.a,
            d = this.b,
            e = this.ca,
            g = this,
            l = new Db;
        l.a = function() {
            for (;;) {
                if (e != g.ca) throw Error("The map has changed since the iterator was created");
                if (b >= c.length) throw Cb;
                var l = c[b++];
                return a ? l : d[l]
            }
        };
        return l
    };

    function K(a, b) {
        return Object.prototype.hasOwnProperty.call(a, b)
    };

    function Ib(a) {
        return eval("(" + a + ")")
    };

    function Jb() {
        this.a = ga()
    }
    new Jb;
    Jb.prototype.set = function(a) {
        this.a = a
    };
    Jb.prototype.get = function() {
        return this.a
    };
    var Kb = RegExp("^(?:([^:/?#.]+):)?(?://(?:([^/?#]*)@)?([^/#?]*?)(?::([0-9]+))?(?=[/#?]|$))?([^?#]+)?(?:\\?([^#]*))?(?:#(.*))?$");

    function Lb(a) {
        if (Mb) {
            Mb = m;
            var b = q.location;
            if (b) {
                var c = b.href;
                if (c && (c = (c = Lb(c)[3] || k) && decodeURIComponent(c)) && c != b.hostname) throw Mb = h, Error();
            }
        }
        return a.match(Kb)
    }
    var Mb = Ka;

    function L(a) {
        if (a[1]) {
            var b = a[0],
                c = b.indexOf("#");
            0 <= c && (a.push(b.substr(c)), a[0] = b = b.substr(0, c));
            c = b.indexOf("?");
            0 > c ? a[1] = "?" : c == b.length - 1 && (a[1] = f)
        }
        return a.join("")
    }

    function Nb(a, b, c) {
        if ("array" == s(b))
            for (var d = 0; d < b.length; d++) Nb(a, String(b[d]), c);
        else b != k && c.push("&", a, "" === b ? "" : "=", encodeURIComponent(String(b)))
    }

    function M(a, b) {
        for (var c in b) Nb(c, b[c], a);
        return a
    };

    function Ob(a) {
        "?" == a.charAt(0) && (a = a.substr(1));
        a = a.split("&");
        for (var b = {}, c = 0, d = a.length; c < d; c++) {
            var e = a[c].split("=");
            if (1 == e.length && e[0] || 2 == e.length) {
                var g = ha(e[0] || ""),
                    e = ha(e[1] || "");
                g in b ? "array" == s(b[g]) ? ta(b[g], e) : b[g] = [b[g], e] : b[g] = e
            }
        }
        return b
    }

    function Pb(a) {
        a = M([], a);
        a[0] = "";
        return a.join("")
    }

    function Qb(a, b) {
        var c = a.split("?", 2);
        a = c[0];
        var c = Ob(c[1] || ""),
            d;
        for (d in b) c[d] = b[d];
        return L(M([a], c))
    };
    var Rb = window.yt && window.yt.config_ || {};
    v("yt.config_", Rb);
    var Sb = window.yt && window.yt.tokens_ || {};
    v("yt.tokens_", Sb);
    v("yt.globals_", window.yt && window.yt.globals_ || {});
    var Tb = window.yt && window.yt.msgs_ || {};
    v("yt.msgs_", Tb);
    var Ub = window.yt && window.yt.timeouts_ || [];
    v("yt.timeouts_", Ub);
    v("yt.intervals_", window.yt && window.yt.intervals_ || []);

    function Vb(a) {
        Wb(Rb, arguments)
    }

    function Xb(a) {
        Wb(Sb, arguments)
    }

    function Yb(a, b) {
        var c = window.setTimeout(a, b);
        Ub.push(c);
        return c
    }

    function Wb(a, b) {
        if (1 < b.length) {
            var c = b[0];
            a[c] = b[1]
        } else {
            var d = b[0];
            for (c in d) a[c] = d[c]
        }
    };
    var Zb = k;
    "undefined" != typeof XMLHttpRequest ? Zb = function() {
        return new XMLHttpRequest
    } : "undefined" != typeof ActiveXObject && (Zb = function() {
        return new ActiveXObject("Microsoft.XMLHTTP")
    });

    function $b(a, b, c, d, e, g, l) {
        var n = Zb && Zb();
        if ("open" in n) {
            n.onreadystatechange = function() {
                4 == (n && "readyState" in n ? n.readyState : 0) && b && b(n)
            };
            c = (c || "GET").toUpperCase();
            d = d || "";
            n.open(c, a, h);
            g && (n.responseType = g);
            l && (n.withCredentials = h);
            a = "POST" == c;
            if (e)
                for (var H in e) n.setRequestHeader(H, e[H]), "content-type" == H.toLowerCase() && (a = m);
            a && n.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            n.send(d);
            return n
        }
    }

    function ac(a, b) {
        var c = b.format || "JSON";
        b.$b && (a = document.location.protocol + "//" + document.location.hostname + (document.location.port ? ":" + document.location.port : "") + a);
        var d = b.nb;
        d && (a = Qb(a, d));
        var e = b.ac || "";
        if (d = b.bc) e = Ob(e), Ca(e, d), e = Pb(e);
        var g = m,
            l, n = $b(a, function(a) {
                if (!g) {
                    g = h;
                    l && window.clearTimeout(l);
                    var d;
                    a: switch (a && "status" in a ? a.status : -1) {
                        case 0:
                        case 200:
                        case 204:
                        case 304:
                            d = h;
                            break a;
                        default:
                            d = m
                    }
                    var e = k;
                    if (d || 400 <= a.status && 500 > a.status) e = bc(c, a);
                    if (d) a: {
                        switch (c) {
                            case "XML":
                                d = 0 == parseInt(e &&
                                    e.return_code, 10);
                                break a;
                            case "RAW":
                                d = h;
                                break a
                        }
                        d = !!e
                    }
                    var e = e || {},
                        n = b.h || q;
                    d ? b.ja && b.ja.call(n, a, e) : b.onError && b.onError.call(n, a, e);
                    b.Ub && b.Ub.call(n, a, e)
                }
            }, b.method, e, b.headers, b.responseType, b.withCredentials);
        b.Vb && 0 < b.timeout && (l = Yb(function() {
            g || (g = h, n.abort(), window.clearTimeout(l), b.Vb.call(b.h || q, n))
        }, b.timeout))
    }

    function bc(a, b) {
        var c = k;
        switch (a) {
            case "JSON":
                var d = b.responseText,
                    e = b.getResponseHeader("Content-Type") || "";
                d && 0 <= e.indexOf("json") && (c = Ib(d));
                break;
            case "XML":
                if (d = (d = b.responseXML) ? cc(d) : k) c = {}, y(d.getElementsByTagName("*"), function(a) {
                    c[a.tagName] = dc(a)
                })
        }
        return c
    }

    function cc(a) {
        return !a ? k : (a = ("responseXML" in a ? a.responseXML : a).getElementsByTagName("root")) && 0 < a.length ? a[0] : k
    }

    function dc(a) {
        var b = "";
        y(a.childNodes, function(a) {
            b += a.nodeValue
        });
        return b
    };

    function N() {}
    N.prototype.P = m;
    N.prototype.I = function() {
        return this.P
    };
    N.prototype.qa = function() {
        this.P || (this.P = h, this.B())
    };

    function ec(a, b) {
        a.s || (a.s = []);
        a.s.push(u(b, f))
    }
    N.prototype.B = function() {
        if (this.s)
            for (; this.s.length;) this.s.shift()()
    };

    function fc(a) {
        a && "function" == typeof a.qa && a.qa()
    };

    function O() {
        this.a = [];
        this.t = {}
    }
    w(O, N);
    p = O.prototype;
    p.ub = 1;
    p.la = 0;
    p.Wa = function(a, b, c) {
        var d = this.t[a];
        d || (d = this.t[a] = []);
        var e = this.ub;
        this.a[e] = a;
        this.a[e + 1] = b;
        this.a[e + 2] = c;
        this.ub = e + 3;
        d.push(e);
        return e
    };
    p.Ua = function(a) {
        if (0 != this.la) return this.b || (this.b = []), this.b.push(a), m;
        var b = this.a[a];
        if (b) {
            var c = this.t[b];
            if (c) {
                var d = oa(c, a);
                0 <= d && x.splice.call(c, d, 1)
            }
            delete this.a[a];
            delete this.a[a + 1];
            delete this.a[a + 2]
        }
        return !!b
    };
    p.V = function(a, b) {
        var c = this.t[a];
        if (c) {
            this.la++;
            for (var d = ua(arguments, 1), e = 0, g = c.length; e < g; e++) {
                var l = c[e];
                this.a[l + 1].apply(this.a[l + 2], d)
            }
            this.la--;
            if (this.b && 0 == this.la)
                for (; c = this.b.pop();) this.Ua(c);
            return 0 != e
        }
        return m
    };
    p.clear = function(a) {
        if (a) {
            var b = this.t[a];
            b && (y(b, this.Ua, this), delete this.t[a])
        } else this.a.length = 0, this.t = {}
    };
    p.B = function() {
        O.A.B.call(this);
        delete this.a;
        delete this.t;
        delete this.b
    };

    function P() {
        this.g = new O;
        ec(this, fa(fc, this.g))
    }
    w(P, N);
    P.prototype.Wa = function(a, b, c) {
        this.I() || this.g.Wa(a, b, c)
    };
    P.prototype.V = function(a, b) {
        this.I() || this.g.V.apply(this.g, arguments)
    };

    function gc(a, b) {
        if ((a = t(a) ? document.getElementById(a) : a) && a.style) {
            a.style.display = b ? "" : "none";
            var c = a;
            !b ? Xa(c, "hid") : Ya(c, "hid")
        }
    }

    function hc(a) {
        y(arguments, function(a) {
            gc(a, h)
        })
    }

    function ic(a) {
        y(arguments, function(a) {
            gc(a, m)
        })
    }

    function jc() {
        var a;
        a: if (a = document.body, a.style.backgroundSize != f) a = "backgroundSize";
            else {
                for (var b = ["Moz", "Webkit", "ms", "O"], c = 0; c < b.length; c++)
                    if (a.style[b[c] + "BackgroundSize"] != f) {
                        a = b[c] + "BackgroundSize";
                        break a
                    } a = f
            }
        return a != f
    };
    var kc = r("yt.pubsub.instance_") || new O;
    O.prototype.subscribe = O.prototype.Wa;
    O.prototype.unsubscribeByKey = O.prototype.Ua;
    O.prototype.publish = O.prototype.V;
    O.prototype.clear = O.prototype.clear;
    v("yt.pubsub.instance_", kc);
    v("yt.pubsub.publish", function(a, b) {
        var c = r("yt.pubsub.instance_");
        return c ? c.publish.apply(c, arguments) : m
    });
    var lc = {},
        mc = "ontouchstart" in document;

    function nc(a, b, c) {
        var d;
        switch (a) {
            case "mouseover":
            case "mouseout":
                d = 3;
                break;
            case "mouseenter":
            case "mouseleave":
                d = 9
        }
        return eb(c, function(a) {
            return z(F(a), b)
        }, d)
    }

    function Q(a) {
        var b = "mouseover" == a.type && "mouseenter" in lc || "mouseout" == a.type && "mouseleave" in lc,
            c = a.type in lc || b;
        if ("HTML" != a.target.tagName && c) {
            if (b) {
                var b = "mouseover" == a.type ? "mouseenter" : "mouseleave",
                    c = lc[b],
                    d;
                for (d in c.t) {
                    var e = nc(b, d, a.target);
                    e && !eb(a.relatedTarget, function(a) {
                        return a == e
                    }) && c.V(d, e, b, a)
                }
            }
            if (b = lc[a.type])
                for (d in b.t)(e = nc(a.type, d, a.target)) && b.V(d, e, a.type, a)
        }
    }
    I(document, "blur", Q, h);
    I(document, "change", Q, h);
    I(document, "click", Q);
    I(document, "focus", Q, h);
    I(document, "mouseover", Q);
    I(document, "mouseout", Q);
    I(document, "mousedown", Q);
    I(document, "keydown", Q);
    I(document, "keyup", Q);
    I(document, "keypress", Q);
    I(document, "cut", Q);
    I(document, "paste", Q);
    mc && (I(document, "touchstart", Q), I(document, "touchend", Q), I(document, "touchcancel", Q));
    v("yt.uix.widgets_", window.yt && window.yt.uix && window.yt.uix.widgets_ || {});

    function oc() {};

    function R() {}
    w(R, oc);
    R.getInstance = function() {
        return R.a ? R.a : R.a = new R
    };

    function pc(a) {
        var b;
        b || (b = {});
        var c = window,
            d = "undefined" != typeof a.href ? a.href : String(a);
        a = b.target || a.target;
        var e = [],
            g;
        for (g in b) switch (g) {
            case "width":
            case "height":
            case "top":
            case "left":
                e.push(g + "=" + b[g]);
                break;
            case "target":
            case "noreferrer":
                break;
            default:
                e.push(g + "=" + (b[g] ? 1 : 0))
        }
        g = e.join(",");
        if (b.noreferrer) {
            if (b = c.open("", a, g)) C && -1 != d.indexOf(";") && (d = "'" + d.replace(/'/g, "%27") + "'"), b.opener = k, ma.test(d) && (-1 != d.indexOf("&") && (d = d.replace(ia, "&amp;")), -1 != d.indexOf("<") && (d = d.replace(ja,
                "&lt;")), -1 != d.indexOf(">") && (d = d.replace(ka, "&gt;")), -1 != d.indexOf('"') && (d = d.replace(la, "&quot;"))), b.document.write('<META HTTP-EQUIV="refresh" content="0; url=' + d + '">'), b.document.close()
        } else c.open(d, a, g)
    };

    function qc(a) {
        this.a = document.createElement(a || "div")
    }
    w(qc, N);
    p = qc.prototype;
    p.ba = function() {};
    p.Va = function() {
        var a = this.a;
        a && a.parentNode && a.parentNode.removeChild(a);
        this.a = k
    };
    p.show = function() {
        var a = this.a;
        a && (a.style.display = "block")
    };
    p.hide = function() {
        var a = this.a;
        a && (a.style.display = "none")
    };
    p.addEventListener = function(a, b, c) {
        this.a.addEventListener(a, b, c)
    };
    p.removeEventListener = function(a, b, c) {
        this.a.removeEventListener(a, b, c)
    };
    p.B = function() {
        this.Va();
        qc.A.B.call(this)
    };

    function S(a, b) {
        qc.call(this, "canvas");
        this.width = a;
        this.height = b;
        this.h = k;
        this.b = 0
    }
    w(S, qc);
    S.prototype.ba = function() {
        S.A.ba.call(this);
        this.a.width = this.width;
        this.a.height = this.height;
        this.h = this.a.getContext("2d")
    };
    S.prototype.Va = function() {
        window.clearTimeout(this.b);
        this.h = k;
        S.A.Va.call(this)
    };
    S.prototype.e = function(a, b) {
        a.call(this);
        this.b = Yb(u(this.e, this, a, b), b)
    };

    function T() {
        S.call(this, 30, 30);
        this.o = this.width / 2;
        this.g = this.height / 2
    }
    w(T, S);
    T.prototype.ba = function() {
        T.A.ba.call(this);
        this.h.translate(this.o, this.g)
    };
    T.prototype.show = function() {
        T.A.show.call(this);
        this.e(this.D, 125)
    };
    T.prototype.D = function() {
        this.h.clearRect(-this.o, -this.g, this.width, this.height);
        this.h.rotate(Math.PI / 4);
        U(this, 0, -11, 1);
        U(this, 8, -8, 0.2);
        U(this, 11, 0, 0.2);
        U(this, 8, 8, 0.2);
        U(this, 0, 11, 0.25);
        U(this, -8, 8, 0.35);
        U(this, -11, 0, 0.5);
        U(this, -8, -8, 0.7)
    };

    function U(a, b, c, d) {
        a.h.beginPath();
        a.h.arc(b, c, 4, 0, 2 * Math.PI, m);
        a.h.fillStyle = "rgba(189, 189, 189, " + d + ")";
        a.h.fill()
    }
    T.prototype.hide = function() {
        window.clearTimeout(this.b);
        T.A.hide.call(this)
    };

    function rc(a, b, c, d, e, g, l, n) {
        this.g = [];
        y(va(b), function(c) {
            this.g.push(I(a, c, u(this.Mb, this)))
        }, this);
        y(va(d), function(c) {
            this.g.push(I(a, c, u(this.Lb, this)))
        }, this);
        this.P = g || k;
        this.L = c;
        this.M = l || 0;
        this.s = 0;
        this.e = m;
        this.D = e;
        this.o = n || 0;
        this.a = 0;
        this.b = m
    }
    p = rc.prototype;
    p.Mb = function(a) {
        window.clearTimeout(this.a);
        this.a = 0;
        this.s = Yb(u(this.Sb, this, a), this.M)
    };
    p.Lb = function(a) {
        window.clearTimeout(this.s);
        this.s = 0;
        this.a = Yb(u(this.Rb, this, a), this.o)
    };
    p.Sb = function(a) {
        !this.b && !this.e && (this.e = h, this.L.call(this.P || q, a))
    };
    p.Rb = function(a) {
        !this.b && this.e && (this.e = m, this.D.call(this.P || q, a))
    };
    p.qa = function() {
        this.b = h;
        window.clearTimeout(this.s);
        window.clearTimeout(this.a);
        nb(this.g)
    };
    p.I = function() {
        return this.b
    };

    function sc(a) {
        var b;
        new rc(a, "mouseover", function() {
            b = k
        }, ["mouseout", "mousedown"], function() {
            b && (b.hide(), b.qa(), b = k)
        }, k, 10, 50);
        a[ba] || (a[ba] = ++ca)
    };

    function tc(a, b) {
        P.call(this);
        this.a = a;
        this.e = b;
        this.b = new Ab(this)
    }
    w(tc, P);
    p = tc.prototype;
    p.k = k;
    p.ka = k;
    p.Ra = k;
    p.Ta = k;
    p.J = k;
    p.tb = m;
    p.rb = m;
    p.update = function(a) {
        this.k = a;
        db(this.ka, a.ga || "");
        hc(this.a)
    };
    p.Ob = function() {
        var a;
        if (!(a = this.k.Ea)) {
            a = this.e;
            var b = this.k,
                b = {
                    v: b.G,
                    list: b.da
                };
            a.F && (b.feature = "player_" + a.F);
            a = L(M([a.Ab + "://" + ("www.youtube-nocookie.com" == window.location.host ? "www.youtube.com" : window.location.host) + "/watch"], b))
        }
        pc(a)
    };
    p.Nb = function() {
        if (!this.tb) {
            this.tb = h;
            ac("/get_video_metadata", {
                method: "GET",
                onError: this.pb,
                ja: this.Qb,
                nb: {
                    video_id: this.k ? this.k.G : f,
                    html5: 1
                },
                h: this
            });
            if (!this.J) {
                var a = G("html5-info-panel-loading-icon", this.a);
                this.J = new T;
                Xa(this.J.a, "html5-info-panel-loader");
                var b = this.J;
                b.ba();
                a.appendChild(b.a);
                ec(this, fa(fc, this.J))
            }
            this.J.show()
        }
        Ya(this.a, "show-share");
        return $a(this.a, "show-more-info")
    };
    p.ob = function() {
        Ya(this.a, "show-more-info");
        "detailpage" != this.e.F && (this.rb || (this.rb = h, ac("/share_ajax", {
            method: "GET",
            onError: this.pb,
            ja: this.Pb,
            nb: {
                action_get_share_box: 1,
                feature: "player_embedded",
                video_id: this.k ? this.k.G : f,
                panel_type: "share_bar"
            },
            h: this
        })), $a(this.a, "show-share"))
    };
    p.Qb = function(a, b) {
        if (!this.I()) {
            var c = G("html5-info-panel", this.a),
                d = b.user_info;
            this.k && (this.k.M = d.external_id);
            var e = G("html5-author-img", c).getElementsByTagName("img")[0];
            e.src = d.image_url;
            Bb(this.b, e, this.qb);
            e = G("html5-author-name", c);
            db(e, d.username);
            Bb(this.b, e, this.qb);
            e = b.video_info;
            e.subscription_ajax_token && Xb("subscription_ajax", e.subscription_ajax_token);
            var g = G("html5-subscribe-button-container", c);
            g.innerHTML = d.subscription_button_html ? d.subscription_button_html : "";
            R.getInstance();
            d = G("yt-uix-subscription-button", g);
            sc(d);
            G("html5-view-count", c).innerHTML = e.view_count_string;
            var d = parseInt(e.likes_count_unformatted, 10),
                g = parseInt(e.dislikes_count_unformatted, 10),
                l = 0,
                n = 0;
            0 < d + g && (l = 100 * (d / (d + g)), n = 100 * (g / (d + g)));
            G("video-extras-sparkbar-likes", c).style.width = l + "%";
            G("video-extras-sparkbar-dislikes", c).style.width = n + "%";
            d = G("video-extras-likes-dislikes", c);
            db(d, e.likes_dislikes_string);
            d = G("html5-description-text", c);
            db(d, e.description);
            this.J.hide();
            c = G("html5-info-panel-content",
                c);
            hc(c)
        }
    };
    p.Pb = function(a, b) {
        if (!this.I()) {
            G("share-bar").innerHTML = b.share_html;
            var c = G("share-bar-close", this.a);
            Bb(this.b, c, this.ob);
            c = G("share-panel-url", this.a);
            z(F(this.a), "show-share") && (c && !z(F(c), "focused")) && (c.focus(), c.select())
        }
    };
    p.pb = function() {};
    p.qb = function() {
        var a = this.e,
            b = this.k,
            c = "",
            c = b.M ? a.Fa + "channel/UC" + b.M : a.Fa + "user/" + b.ha;
        pc(c)
    };
    p.B = function() {
        this.b.removeAll();
        this.k = this.Ra = this.ka = this.e = this.a = k;
        tc.A.B.call(this)
    };
    var uc = window.location.protocol + "//i.ytimg.com/",
        vc = 4 / 3;

    function wc(a, b, c) {
        var d;
        switch (b.Kb) {
            case 30:
                d = xc;
                break;
            default:
                d = yc
        }
        return d(a, b, c)
    }

    function yc(a, b, c) {
        if (!c) {
            c = a.clientHeight;
            a = a.clientWidth;
            if ((900 < a || 600 < c) && b.Oa) return b.Oa;
            if ((430 < a || 320 < c) && b.Pa) return b.Pa
        }
        b.aa ? b = b.aa : b.G ? (b = b.G, b = (uc + "vi/" + escape(b) + "/" + escape("hqdefault.jpg")).replace("i.", "i" + (b.charCodeAt(0) % 4 + 1) + ".")) : b = "";
        return b
    }

    function xc(a, b) {
        return b.aa ? b.aa : b.G ? L(M(["//docs.google.com/vt"], {
            id: b.G,
            authuser: b.Jb,
            authkey: b.Ib
        })) : "//docs.google.com/images/doclist/cleardot.gif"
    }

    function Ac(a, b) {
        b.clientWidth / b.clientHeight < vc ? (a.style.height = "100%", a.style.width = "auto") : (a.style.height = "auto", a.style.width = "100%")
    };
    var Bc, Cc;
    Cc = Bc = m;
    var V = Ga();
    V && (-1 != V.indexOf("Firefox") || -1 != V.indexOf("Camino") || -1 != V.indexOf("iPhone") || -1 != V.indexOf("iPod") || (-1 != V.indexOf("iPad") ? Bc = h : -1 != V.indexOf("Android") || -1 != V.indexOf("Chrome") || -1 != V.indexOf("Safari") && (Cc = h)));
    var Dc = Bc,
        Ec = Cc;
    var Fc = {
        kc: 1,
        lc: 2,
        mc: 3
    };

    function Gc() {
        var a = r("yt.player.utils.videoElement_");
        a || (a = document.createElement("video"), v("yt.player.utils.videoElement_", a));
        return a
    }
    var Hc = f;

    function Ic(a, b) {
        var c;
        if (a instanceof Ic) this.K = b !== f ? b : a.K, Jc(this, a.U), this.pa = a.pa, this.T = a.T, Kc(this, a.oa), this.na = a.na, Lc(this, a.a.R()), this.ma = a.ma;
        else if (a && (c = Lb(String(a)))) {
            this.K = !!b;
            Jc(this, c[1] || "", h);
            this.pa = c[2] ? decodeURIComponent(c[2] || "") : "";
            var d = c[3] || "";
            this.T = d ? decodeURIComponent(d) : "";
            Kc(this, c[4]);
            this.na = c[5] ? decodeURIComponent(c[5] || "") : "";
            Lc(this, c[6] || "", h);
            this.ma = c[7] ? decodeURIComponent(c[7] || "") : ""
        } else this.K = !!b, this.a = new Mc(k, 0, this.K)
    }
    p = Ic.prototype;
    p.U = "";
    p.pa = "";
    p.T = "";
    p.oa = k;
    p.na = "";
    p.ma = "";
    p.K = m;
    p.toString = function() {
        var a = [],
            b = this.U;
        b && a.push(Nc(b, Oc), ":");
        if (b = this.T) {
            a.push("//");
            var c = this.pa;
            c && a.push(Nc(c, Oc), "@");
            a.push(encodeURIComponent(String(b)));
            b = this.oa;
            b != k && a.push(":", String(b))
        }
        if (b = this.na) this.T && "/" != b.charAt(0) && a.push("/"), a.push(Nc(b, "/" == b.charAt(0) ? Pc : Qc));
        (b = this.a.toString()) && a.push("?", b);
        (b = this.ma) && a.push("#", Nc(b, Rc));
        return a.join("")
    };
    p.R = function() {
        return new Ic(this)
    };

    function Jc(a, b, c) {
        a.U = c ? b ? decodeURIComponent(b) : "" : b;
        a.U && (a.U = a.U.replace(/:$/, ""))
    }

    function Kc(a, b) {
        if (b) {
            b = Number(b);
            if (isNaN(b) || 0 > b) throw Error("Bad port number " + b);
            a.oa = b
        } else a.oa = k
    }

    function Lc(a, b, c) {
        b instanceof Mc ? (a.a = b, Sc(a.a, a.K)) : (c || (b = Nc(b, Tc)), a.a = new Mc(b, 0, a.K))
    }

    function Nc(a, b) {
        return t(a) ? encodeURI(a).replace(b, Uc) : k
    }

    function Uc(a) {
        a = a.charCodeAt(0);
        return "%" + (a >> 4 & 15).toString(16) + (a & 15).toString(16)
    }
    var Oc = /[#\/\?@]/g,
        Qc = /[\#\?:]/g,
        Pc = /[\#\?]/g,
        Tc = /[\#\?@]/g,
        Rc = /#/g;

    function Mc(a, b, c) {
        this.a = a || k;
        this.b = !!c
    }

    function W(a) {
        if (!a.d && (a.d = new Gb, a.i = 0, a.a))
            for (var b = a.a.split("&"), c = 0; c < b.length; c++) {
                var d = b[c].indexOf("="),
                    e = k,
                    g = k;
                0 <= d ? (e = b[c].substring(0, d), g = b[c].substring(d + 1)) : e = b[c];
                e = ha(e);
                e = X(a, e);
                d = a;
                g = g ? ha(g) : "";
                W(d);
                d.a = k;
                var e = X(d, e),
                    l = d.d.get(e);
                l || d.d.set(e, l = []);
                l.push(g);
                d.i++
            }
    }
    p = Mc.prototype;
    p.d = k;
    p.i = k;
    p.remove = function(a) {
        W(this);
        a = X(this, a);
        return K(this.d.b, a) ? (this.a = k, this.i -= this.d.get(a).length, this.d.remove(a)) : m
    };
    p.clear = function() {
        this.d = this.a = k;
        this.i = 0
    };

    function Vc(a, b) {
        W(a);
        b = X(a, b);
        return K(a.d.b, b)
    }
    p.Q = function() {
        W(this);
        for (var a = this.d.C(), b = this.d.Q(), c = [], d = 0; d < b.length; d++)
            for (var e = a[d], g = 0; g < e.length; g++) c.push(b[d]);
        return c
    };
    p.C = function(a) {
        W(this);
        var b = [];
        if (a) Vc(this, a) && (b = ra(b, this.d.get(X(this, a))));
        else {
            a = this.d.C();
            for (var c = 0; c < a.length; c++) b = ra(b, a[c])
        }
        return b
    };
    p.set = function(a, b) {
        W(this);
        this.a = k;
        a = X(this, a);
        Vc(this, a) && (this.i -= this.d.get(a).length);
        this.d.set(a, [b]);
        this.i++;
        return this
    };
    p.get = function(a, b) {
        var c = a ? this.C(a) : [];
        return 0 < c.length ? String(c[0]) : b
    };
    p.toString = function() {
        if (this.a) return this.a;
        if (!this.d) return "";
        for (var a = [], b = this.d.Q(), c = 0; c < b.length; c++)
            for (var d = b[c], e = encodeURIComponent(String(d)), d = this.C(d), g = 0; g < d.length; g++) {
                var l = e;
                "" !== d[g] && (l += "=" + encodeURIComponent(String(d[g])));
                a.push(l)
            }
        return this.a = a.join("&")
    };
    p.R = function() {
        var a = new Mc;
        a.a = this.a;
        this.d && (a.d = this.d.R(), a.i = this.i);
        return a
    };

    function X(a, b) {
        var c = String(b);
        a.b && (c = c.toLowerCase());
        return c
    }

    function Sc(a, b) {
        b && !a.b && (W(a), a.a = k, Fb(a.d, function(a, b) {
            var e = b.toLowerCase();
            b != e && (this.remove(b), this.remove(e), 0 < a.length && (this.a = k, this.d.set(X(this, e), sa(a)), this.i += a.length))
        }, a));
        a.b = b
    };
    var Wc = "corp.google.com youtube.com youtube-nocookie.com prod.google.com sandbox.google.com docs.google.com drive.google.com play.google.com".split(" "),
        Xc = "www.google.com/aclk www.google.com/pagead/conversion googleadservices.com/aclk googleadservices.com/pagead/conversion googleads.g.doubleclick.net/aclk googleads.g.doubleclick.net/pagead/conversion".split(" ");

    function Yc(a, b) {
        return RegExp("^https?://([a-z0-9-]{1,63}\\.)*(" + b.join("|").replace(/\./g, ".") + ")(:[0-9]+)?([/?#]|$)", "i").test(a)
    }

    function Zc(a) {
        a = new Ic(a);
        Jc(a, document.location.protocol);
        a.T = document.location.hostname;
        document.location.port && Kc(a, document.location.port);
        return a.toString()
    };

    function Y(a, b) {
        return b == f ? a : "1" == b ? h : m
    }

    function $c(a, b, c) {
        for (var d in c)
            if (c[d] == b) return c[d];
        return a
    }

    function Z(a, b) {
        return b == f ? a : b
    }

    function ad(a, b) {
        var c = Z(a, b);
        c && (c = Zc(c));
        return c
    };
    var bd = {
        oc: "0",
        qc: "1",
        ec: "2",
        Wb: "3",
        cc: "4",
        tc: "5"
    };
    var cd = {
        sc: "red",
        wc: "white"
    };
    var dd = {
        hc: "0",
        uc: "1",
        dc: "2"
    };
    var ed = {
        Wb: "auto",
        vc: "tiny",
        jc: "light",
        SMALL: "small",
        nc: "medium",
        LARGE: "large",
        gc: "hd720",
        fc: "hd1080",
        ic: "highres"
    };

    function fd(a, b) {
        this.a = a;
        this.b = b
    };

    function gd(a, b) {
        this.start = a;
        this.end = b;
        this.length = b - a + 1
    }

    function hd(a) {
        a = a.split("-");
        2 == a.length && new gd(parseInt(a[0], 10), parseInt(a[1], 10))
    }
    gd.prototype.toString = function() {
        return this.start + "-" + (this.end == k ? "" : this.end)
    };

    function id() {
        new Float64Array(128);
        new Float32Array(128)
    };

    function jd(a, b) {
        L(M([a], {
            mime: b.b.split(";")[0]
        }));
        this.info = b;
        this.index = new id
    };

    function kd() {
        this.b = 0;
        this.a = {}
    }
    var ld = /PT(([0-9]*)H)?(([0-9]*)M)?(([0-9.]*)S)?/;

    function md(a) {
        var b = new kd;
        y(a, function(a) {
            var d = a.itag,
                e = new fd(d, a.type);
            hd(a.init);
            hd(a.index);
            (a = nd(a.url)) && (b.a[d] = new jd(a, e))
        });
        return b
    }

    function od(a, b) {
        for (var c = a; c; c = c.parentNode)
            if (c.attributes) {
                var d = c.attributes[b];
                if (d) return d.value
            } return ""
    }

    function pd(a, b) {
        for (var c = a; c; c = c.parentNode) {
            var d = c.getElementsByTagName(b);
            if (0 < d.length) return d[0]
        }
        return k
    }

    function nd(a) {
        return !Yc(a, Wc) ? "" : a = L(M([a], {
            alr: "yes",
            keepalive: "yes"
        }))
    };

    function qd(a) {
        P.call(this);
        this.L = [];
        this.ea = [];
        this.e = {};
        this.a = {};
        rd(this, a)
    }
    w(qd, P);
    var sd = "author cc_asr cc_load_policy iv_allow_external_links iv_disallow_trusted_links iv_new_window iv_load_policy keywords subscribed rvs title ttsurl ypc_buy_url ypc_full_video_length ypc_item_thumbnail ypc_item_title ypc_item_url ypc_offer_button_text ypc_offer_description ypc_offer_headline ypc_offer_id ypc_price_string ypc_preview ypc_video_rental_bar_text".split(" ");
    p = qd.prototype;
    p.vb = m;
    p.wb = m;
    p.xb = h;
    p.yb = m;
    p.zb = "";
    p.H = "";
    p.lb = 0;
    p.Qa = 0;
    p.mb = 0;

    function td(a, b) {
        var c = b || {};
        c.iv_read_url && Zc(c.iv_read_url);
        c.iv_invideo_url && Zc(c.iv_invideo_url);
        a.vb = Y(a.vb, c.iv_allow_external_links);
        a.wb = Y(a.wb, c.iv_disallow_external_links);
        a.xb = Y(a.xb, c.iv_new_window);
        a.ha = Z(a.ha, c.author);
        a.yb = Y(a.yb, c.cc_asr);
        a.zb = ad(a.zb, c.ttsurl);
        a.H = Z(a.H, c.cpn);
        a.Ca = Z(a.Ca, c.subscribed);
        a.ga = Z(a.ga, c.title);
        a.Da = Z(a.Da, c.ypc_preview);
        c.keywords && ud(c.keywords);
        if (c.rvs) {
            var d = vd(c.rvs);
            pa(d, function(a) {
                return !!a.id
            })
        }
        y(sd, function(a) {
            a in c && (this.e[a] = c[a])
        }, a)
    }

    function rd(a, b) {
        var c = b || {};
        "1" == c.hlsdvr && (Ec || Dc && Ga().match(/CPU OS (\d+)_/));
        a.Ib = c.authkey;
        a.Jb = c.authuser;
        a.H || (a.H = c.cpn || wd());
        a.lb = (c.end || c.endSeconds) == f ? a.lb : Number(c.end || c.endSeconds);
        a.Oa = c.iurlmaxres;
        a.wa = Z(a.wa, c.oauth_token);
        a.Aa = Z(a.Aa, c.video_verification_token);
        a.da = Z(a.da, c.list);
        a.xa = Z(a.xa, c.feature);
        a.va = 1 == (c.is_fling == f ? a.va ? 1 : 0 : Number(c.is_fling));
        a.ua = Z(a.ua, c.ytr);
        a.Pa = c.iurlsd;
        a.ya = a.ya || c.vq || c.suggestedQuality;
        a.aa = c.iurl;
        a.mb = (c.start || c.startSeconds) == f ? a.mb : Number(c.start ||
            c.startSeconds);
        a.G = c.docid || c.video_id || c.videoId;
        xd(a, c.watermark);
        (c.ad3_module || c.ad_module) && "1" == c.allow_html5_ads && "1" == c.ad_preroll && a.ea.push("ad");
        c.adaptive_fmts && (a.o = yd(a, c.adaptive_fmts));
        c.iv_load_policy && (a.Ba = zd(c.iv_load_policy, a.Ba));
        c.dash && a.fa === f && (a.fa = "1" == c.dash);
        c.dashmpd && (a.D = L(M([c.dashmpd], {
            cpn: a.H
        })));
        c.url_encoded_fmt_stream_map && (a.L = yd(a, c.url_encoded_fmt_stream_map));
        if (c.hlsvp) {
            var d = {
                url: c.hlsvp,
                type: "application/x-mpegURL",
                quality: "auto",
                itag: "93"
            };
            d.cpn = a.H;
            a.L.push(d)
        }
        c.length_seconds && (a.Qa = na(c.length_seconds));
        c.partnerid && (a.Kb = na(c.partnerid));
        c.pyv_billable_url && Yc(c.pyv_billable_url, Xc);
        c.pyv_conv_url && Yc(c.pyv_conv_url, Xc);
        c.watch_ajax_token && Xb("watch_actions_ajax", c.watch_ajax_token);
        c.fresca_preroll && a.ea.push("fresca");
        a.za = Z(a.za, c.ucid);
        y(["baseUrl", "uid", "oeid", "ieid", "ppe"], function(a) {
            this.a[a] = c[a]
        }, a);
        a.a.focEnabled = "1" == c.focEnabled;
        a.a.rmktEnabled = "1" == c.rmktEnabled;
        Ad(c.rmktPingThreshold, c.length_seconds);
        a.e = c;
        td(a, c);
        a.fa && Bd(a)
    }

    function wd() {
        var a;
        if (Hc == f && (Hc = m, window.crypto && window.crypto.Zb)) try {
            a = new Uint8Array(1), window.crypto.Zb(a), Hc = h
        } catch (b) {}
        if (Hc) {
            a = Array(16);
            var c = new Uint8Array(16);
            window.crypto.getRandomValues(c);
            for (var d = 0; d < a.length; d++) a[d] = c[d]
        } else {
            a = Array(16);
            for (c = 0; 16 > c; c++) {
                for (var d = ga(), e = 0; e < d % 23; e++) a[c] = Math.random();
                a[c] = Math.floor(64 * Math.random())
            }
        }
        c = [];
        for (d = 0; d < a.length; d++) c.push("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789-_" [a[d] & 63]);
        return c.join("")
    }

    function Bd(a) {
        if (window.MediaSource || window.WebKitMediaSource || HTMLMediaElement.prototype.webkitSourceAddId)
            if (a.o) a.b = md(a.o), a.Sa();
            else if (a.D) {
            var b = {
                format: "RAW",
                method: "GET",
                h: a,
                ja: a.Tb,
                onError: a.Sa
            };
            a = Zc(a.D);
            ac(a, b)
        }
    }
    p.Tb = function(a) {
        if (!this.I()) {
            if (200 <= a.status && 400 > a.status) {
                var b = new kd;
                a: {
                    a = a.responseText;a = (new DOMParser).parseFromString(a, "text/xml").getElementsByTagName("MPD")[0];
                    var c;
                    if (c = od(a, "mediaPresentationDuration")) {
                        var d = ld.exec(c);
                        c = !d ? parseFloat(c) : 3600 * parseFloat(d[2] || 0) + 60 * parseFloat(d[4] || 0) + parseFloat(d[6] || 0)
                    } else c = 0;b.b = c;a = a.getElementsByTagName("Representation");
                    for (c = 0; c < a.length; c++) {
                        var d = a[c],
                            e = od(d, "id"),
                            g = od(d, "mimeType"),
                            l = od(d, "codecs"),
                            g = l ? g + '; codecs="' + l + '"' : g;
                        if (l = pd(d,
                                "ContentProtection")) {
                            var n = l.attributes.schemeIdUri;
                            if (n && "/web/20130416042846/http://youtube.com/drm/2012/10/10" == n.textContent)
                                for (l = l.firstChild; l != k; l = l.nextSibling) "yt:SystemURL" == l.nodeName && Zc(l.textContent)
                        }
                        e = new fd(e, g);
                        g = nd(pd(d, "BaseURL").textContent);
                        d = pd(d, "SegmentBase");
                        hd(d.attributes.indexRange.value);
                        hd(d.getElementsByTagName("Initialization")[0].attributes.range.value);
                        d = new jd(g, e);
                        if (!d) {
                            a = m;
                            break a
                        }
                        b.a[d.info.a] = d
                    }
                    a = h
                }
                if (this.b = a ? b : k) this.Qa = this.b.b || this.Qa
            }
            this.Sa()
        }
    };
    p.Sa = function() {
        this.I() || this.V("dataloaded", this.e)
    };

    function zd(a, b) {
        var c = parseInt(a, 10),
            d;
        a: {
            for (d in Fc)
                if (Fc[d] == c) {
                    d = h;
                    break a
                } d = m
        }
        return d ? c : b
    }

    function vd(a) {
        a = a.split(",");
        return a = a.map(function(a) {
            return Ob(a)
        })
    }

    function yd(a, b) {
        var c = vd(b);
        y(c, function(a) {
            a.url && (a.url = L(M([a.url], {
                cpn: this.H
            })))
        }, a);
        return c
    }

    function ud(a) {
        y(a.split(","), function() {})
    }

    function xd(a, b) {
        if (b) {
            var c = b.split(",");
            2 <= c.length && (a.Ea = c[0])
        }
    }

    function Ad(a, b) {
        var c = na(b),
            d = na(a);
        isNaN(d) || isNaN(c) || Math.min(d, c)
    };
    var Cd = {
        detailpage: {
            u: h
        }
    };
    Cd.embedded = {
        Ga: !!ib(),
        Ha: "4",
        w: h
    };
    var Dd = "ad blogger books docs google-live picasaweb".split(" "),
        Ed = {
            ad: {
                X: m,
                W: m,
                p: m,
                j: m,
                u: m,
                w: m,
                Y: "adt"
            },
            blazer: {
                xc: "youtube_mobile",
                Ma: m,
                Yb: m,
                ra: m,
                ta: m,
                Ja: h,
                N: m,
                ia: m,
                O: h
            },
            blogger: {
                X: m,
                W: m,
                p: m,
                j: m,
                u: m,
                w: m,
                Y: "bl"
            },
            books: {
                X: m,
                W: m,
                p: m,
                j: m,
                u: h,
                w: m,
                Y: "gb"
            },
            docs: {
                X: m,
                W: m,
                p: m,
                j: m,
                u: m,
                w: m,
                Y: "gd"
            },
            "google-live": {
                X: m,
                W: m,
                p: m,
                j: m,
                u: m,
                w: m,
                Y: "gl"
            },
            "native": {
                ra: m,
                ta: m,
                N: h
            },
            olympics: {
                ra: m,
                ta: m,
                Ka: h,
                O: h
            },
            picasaweb: {
                X: m,
                W: m,
                p: m,
                j: m,
                u: m,
                w: m,
                Y: "pw"
            },
            touch: {
                ra: m,
                ta: m,
                O: h
            }
        };

    function Fd(a) {
        this.b = [];
        Gd(this, a.fexp);
        this.o = Z(this.o, a.origin);
        this.F = a.el || this.F;
        var b = Cd[this.F];
        if (b)
            for (var c in b) this[c] = b[c];
        c = a.ps || this.$;
        if (this.Ca && Dc || 0 < navigator.msMaxTouchPoints) c = "touch";
        this.$ = c;
        if (b = Ed[this.$]) {
            c = b;
            for (var d in c) this[d] = c[d]
        }
        Hd(this) && z(Dd, this.$);
        Gc();
        d = Gc();
        d.muted = !d.muted;
        d = Y(this.Ga, a.fs);
        this.Ga = "detailpage" == this.F || "olympics" == this.$ ? d : d && !!ib();
        this.Ha = $c(this.Ha, a.autohide, bd);
        this.Ma = Y(this.Ma, a.autoplay);
        this.Xa = Y(this.Xa, a.autoplayoverride);
        this.Na =
            $c(this.Na, a.color, cd);
        this.D = Z(this.D, a.content_v);
        this.Ia = $c(this.Ia, a.controls, dd);
        this.M = Z(this.M, a.cbrand);
        this.L = Z(this.L, a.cbr);
        this.fa = Z(this.fa, a.cbrver);
        this.da = Z(this.da, a.c);
        this.ea = Z(this.ea, a.cver);
        this.ha = Z(this.ha, a.cmodel);
        this.ga = Z(this.ga, a.cnetwork);
        this.va = Z(this.va, a.cos);
        this.wa = Z(this.wa, a.cosver);
        this.xa = Z(this.xa, a.cplatform);
        this.a = Z(this.a, a.eurl);
        this.ya = Z(this.ya, a.framer);
        this.g = $c(this.g, a.iv_load_policy, Fc);
        this.za = Z(this.za, a.hl);
        this.Ya = Y(this.Ya, a.bwlogging);
        this.Ja =
            Y(this.Ja, a.is_html5_mobile_device);
        this.Za = Y(this.Za, a.player_wide);
        this.$a = Y(this.$a, a.is_playground);
        this.kb = Y(this.kb, a.loop);
        this.Z = Y(this.Z, a.modestbranding);
        "red" != this.Na && (this.Z = m);
        this.ab = Y(this.ab, a.on3g);
        this.Aa = $c(this.Aa, a.vq, ed);
        this.bb = Z(this.bb, a.playerapiid);
        this.cb = Y(this.cb, a.playsinline);
        this.eb = Y(this.eb, a.altf) && Hd(this);
        this.Gb = Z(this.Gb, a.referrer);
        this.Ea = Z(this.Ea, a.feature);
        this.Hb = Z(this.Hb, a.cr);
        this.Da = Z(this.Da, a.q);
        this.p = Y(this.p, a.logwatch);
        this.fb = Y(this.fb, a.canplaylive);
        this.j = Y(this.j, a.showinfo);
        this.hb = Y(this.hb, a.rel);
        this.u = Y(this.u, a.enablesizebutton);
        this.ib = Y(this.ib, a.ss);
        this.e = Z(this.e, a.theme);
        this.Ka = Y(this.Ka, a.nologo) && Hd(this);
        this.N = Y(this.N, a.use_native_controls);
        this.ia = Y(this.ia, a.svt);
        this.N && (this.Z = h, this.g = 3);
        this.La = Y(this.La, a.ssl);
        if (this.O = Y(this.O, a.use_tablet_controls)) this.e = "dark";
        d = this.jb;
        if (c = a.video_container_override) b = c.split("x"), 2 == b.length && (c = parseInt(b[0], 10), b = parseInt(b[1], 10), d = isNaN(c) || isNaN(b) || 0 >= c * b ? d : new wa(c, b));
        this.jb = d;
        this.Eb = Z(this.Eb, a.attrib);
        this.Fb = Z(this.Fb, a.sk);
        this.Ab = this.La ? "https" : "http";
        this.gb = "0" != this.Ia;
        if (d = a.BASE_YT_URL) Yc(d, Wc) && (this.Fa = d);
        this.p = Y(this.p, a.logwatch);
        this.Ba = a.user_age == f ? this.Ba : Number(a.user_age);
        this.Bb = Z(this.Bb, a.user_display_image);
        this.Cb = Z(this.Cb, a.user_display_name);
        this.Db = Z(this.Db, a.user_gender);
        this.ua && (this.ia = h);
        "detailpage" == this.F && delete this.a;
        this.w = this.Z && !this.N ? !this.j : !this.j && !this.gb ? this.w : m
    }
    w(Fd, N);
    p = Fd.prototype;
    p.Ga = h;
    p.Ha = "2";
    p.Ma = m;
    p.Xa = m;
    p.Fa = "/";
    p.Yb = h;
    p.Na = "red";
    p.Ia = "1";
    p.ra = h;
    p.ta = h;
    p.F = "detailpage";
    p.Ya = m;
    p.Ja = m;
    p.Za = m;
    p.X = h;
    p.$a = m;
    p.W = h;
    p.kb = m;
    p.Z = m;
    p.bb = "";
    p.ab = m;
    p.$ = k;
    p.cb = m;
    p.eb = m;
    p.p = m;
    p.fb = h;
    p.gb = h;
    p.j = h;
    p.hb = h;
    p.u = m;
    p.w = m;
    p.ib = m;
    p.Ka = m;
    p.N = m;
    p.ia = m;
    p.La = m;
    p.O = m;
    p.jb = k;
    p.Y = "yt";

    function Gd(a, b) {
        if (b) {
            a.b = b.split(",");
            var c = {};
            y(a.b, function(a) {
                c[a] = h
            });
            a.ua = !!c["918113"] || !!c["918114"];
            a.Ca = !!c["918112"]
        }
    }

    function Hd(a) {
        a = Yc(a.o, Wc) && -1 != document.location.toString().indexOf("/embed/");
        var b = Yc(document.location.toString(), Wc) && -1 == document.location.toString().indexOf("/embed/");
        return a || b
    }
    p.B = function() {
        Fd.A.B.call(this)
    };
    var $ = k,
        cb = k,
        Id = k,
        Jd = {};

    function Kd(a) {
        if (!cb || !bb(a.target))(a = "EMBED_BINARY_URL" in Rb ? Rb.EMBED_BINARY_URL : f) && xb(a)
    }

    function Ld() {
        jc() || Ac(Id, $)
    }

    function yb() {
        Vb("CUED_AUTOPLAY", h);
        r("yt.embed.writeEmbed")();
        ic($)
    };
    v("yt.embed.cued.writeCuedEmbed", function() {
        $ = t("cued-embed") ? document.getElementById("cued-embed") : "cued-embed";
        var a = new ob("PLAYER_CONFIG" in Rb ? Rb.PLAYER_CONFIG : f),
            b = new qd(a.args),
            c = new Fd(a.args || {});
        if (c.j) {
            var d = G("html5-info-bar", $),
                c = cb = new tc(d, c);
            c.ka = G("html5-title", c.a);
            Bb(c.b, c.ka, c.Ob);
            c.Ra = G("html5-more-info-button", c.a);
            Bb(c.b, c.Ra, c.Nb);
            c.Ta = G("html5-share-button", c.a);
            Bb(c.b, c.Ta, c.ob);
            hc(c.Ta);
            cb.update(b);
            d.style.display = "block"
        }
        b = a.args || {};
        d = {};
        b.video_id && (d.G = b.video_id);
        b.iurl && (d.aa = b.iurl);
        b.iurlsd && (d.Pa = b.iurlsd);
        b.iurlmaxres && (d.Oa = b.iurlmaxres);
        Jd = d;
        a = a.args.is_html5_mobile_device ? h : m;
        b = $;
        d = Jd;
        jc() ? (c = document.createElement("div"), c.style.backgroundImage = "url(" + wc(b, d, a) + ")") : (c = document.createElement("img"), c.src = wc(b, d, a), Ac(c, b));
        Xa(c, "video-thumbnail");
        Id = c;
        $.appendChild(Id);
        I($, "click", Kd);
        I(window, "resize", Ld)
    });
    v("yt.setAjaxToken", Xb);
    v("yt.setConfig", Vb);
    v("yt.setMsg", function(a) {
        Wb(Tb, arguments)
    });
})();