<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <!-- <link rel="icon" href="../../public/assets/favicon.ico" /> -->
    <link rel="icon" href="{{ asset('assets/favicon.ico') }}" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <meta name="theme-color" content="#000000" />
    <meta name="description" content="Web site created using create-react-app" />
    <link rel="apple-touch-icon" href="{{ asset('assets/logo192.png') }}" />
    <link rel="manifest" href="{{ asset('assets/manifest.json') }}" />
    <link href="{{ asset('assets/static/css/main.df6c69e3.chunk.css') }}" rel="stylesheet">
    <title>Yummi Pizza</title>
</head>

<body><noscript>You need to enable JavaScript to run this app.</noscript>
    <div id="root"></div>
    <script>
        ! function(e) {
            function r(r) {
                for (var n, i, f = r[0], l = r[1], a = r[2], c = 0, s = []; c < f.length; c++) i = f[c], Object.prototype.hasOwnProperty.call(o, i) && o[i] && s.push(o[i][0]), o[i] = 0;
                for (n in l) Object.prototype.hasOwnProperty.call(l, n) && (e[n] = l[n]);
                for (p && p(r); s.length;) s.shift()();
                return u.push.apply(u, a || []), t()
            }

            function t() {
                for (var e, r = 0; r < u.length; r++) {
                    for (var t = u[r], n = !0, f = 1; f < t.length; f++) {
                        var l = t[f];
                        0 !== o[l] && (n = !1)
                    }
                    n && (u.splice(r--, 1), e = i(i.s = t[0]))
                }
                return e
            }
            var n = {},
                o = {
                    1: 0
                },
                u = [];

            function i(r) {
                if (n[r]) return n[r].exports;
                var t = n[r] = {
                    i: r,
                    l: !1,
                    exports: {}
                };
                return e[r].call(t.exports, t, t.exports, i), t.l = !0, t.exports
            }
            i.m = e, i.c = n, i.d = function(e, r, t) {
                i.o(e, r) || Object.defineProperty(e, r, {
                    enumerable: !0,
                    get: t
                })
            }, i.r = function(e) {
                "undefined" != typeof Symbol && Symbol.toStringTag && Object.defineProperty(e, Symbol.toStringTag, {
                    value: "Module"
                }), Object.defineProperty(e, "__esModule", {
                    value: !0
                })
            }, i.t = function(e, r) {
                if (1 & r && (e = i(e)), 8 & r) return e;
                if (4 & r && "object" == typeof e && e && e.__esModule) return e;
                var t = Object.create(null);
                if (i.r(t), Object.defineProperty(t, "default", {
                        enumerable: !0,
                        value: e
                    }), 2 & r && "string" != typeof e)
                    for (var n in e) i.d(t, n, function(r) {
                        return e[r]
                    }.bind(null, n));
                return t
            }, i.n = function(e) {
                var r = e && e.__esModule ? function() {
                    return e.default
                } : function() {
                    return e
                };
                return i.d(r, "a", r), r
            }, i.o = function(e, r) {
                return Object.prototype.hasOwnProperty.call(e, r)
            }, i.p = "/";
            var f = this["webpackJsonpyummi-pizza-front"] = this["webpackJsonpyummi-pizza-front"] || [],
                l = f.push.bind(f);
            f.push = r, f = f.slice();
            for (var a = 0; a < f.length; a++) r(f[a]);
            var p = l;
            t()
        }([])
    </script>
    <script src="{{ asset('assets/static/js/2.f9fe54d2.chunk.js') }}"></script>
    <script src="{{ asset('assets/static/js/main.eb9f807d.chunk.js') }}"></script>
</body>

</html>
