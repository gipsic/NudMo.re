/*!
 *
 * NudMo.re - Bootstrap Admin App + jQuery
 *
 * Version: 3.5
 * Author: @themicon_co
 * Website: http://themicon.co
 * License: https://wrapbootstrap.com/help/licenses
 *
 */
! function(e, t, o, n) {
    if ("undefined" == typeof o) throw new Error("This application's JavaScript requires jQuery");
    o(function() {
        var e = o("body");
        (new StateToggler).restoreState(e), o("#chk-fixed").prop("checked", e.hasClass("layout-fixed")), o("#chk-collapsed").prop("checked", e.hasClass("aside-collapsed")), o("#chk-collapsed-text").prop("checked", e.hasClass("aside-collapsed-text")), o("#chk-boxed").prop("checked", e.hasClass("layout-boxed")), o("#chk-float").prop("checked", e.hasClass("aside-float")), o("#chk-hover").prop("checked", e.hasClass("aside-hover")), o(".offsidebar.hide").removeClass("hide"), o.ajaxPrefilter(function(e, t, o) {
            e.async = !0
        })
    })
}(window, document, window.jQuery),
function(e, t, o, n) {
    o(function() {
        o('[data-toggle="popover"]').popover(), o('[data-toggle="tooltip"]').tooltip({
            container: "body"
        }), o(".dropdown input").on("click focus", function(e) {
            e.stopPropagation()
        })
    })
}(window, document, window.jQuery),
function(e, t, o, n) {
    o(function() {
        function t() {
            var e = o(this),
                t = e.data();
            t && (t.triggerInView ? (r.scroll(function() {
                n(e, t)
            }), n(e, t)) : a(e, t))
        }

        function n(e, t) {
            var n = -20;
            !e.hasClass(i) && o.Utils.isInView(e, {
                topoffset: n
            }) && a(e, t)
        }

        function a(e, t) {
            e.ClassyLoader(t).addClass(i)
        }
        var r = o(e),
            i = "js-is-in-view";
        o("[data-classyloader]").each(t)
    })
}(window, document, window.jQuery),
function(e, t, o) {
    "use strict";
    var n = "[data-reset-key]";
    e(o).on("click", n, function(o) {
        o.preventDefault();
        var n = e(this).data("resetKey");
        n ? (e.localStorage.remove(n), t.location.reload()) : e.error("No storage key specified for reset.")
    })
}(jQuery, window, document),
function(e, t, o, n) {
    o(function() {
        o.fn.colorpicker && (o(".demo-colorpicker").colorpicker(), o("#demo_selectors").colorpicker({
            colorSelectors: {
                default: "#777777",
                primary: APP_COLORS.primary,
                success: APP_COLORS.success,
                info: APP_COLORS.info,
                warning: APP_COLORS.warning,
                danger: APP_COLORS.danger
            }
        }))
    })
}(window, document, window.jQuery),
function(e, t, o, n) {
    e.APP_COLORS = {
        primary: "#5d9cec",
        success: "#27c24c",
        info: "#23b7e5",
        warning: "#ff902b",
        danger: "#f05050",
        inverse: "#131e26",
        green: "#37bc9b",
        pink: "#f532e5",
        purple: "#7266ba",
        dark: "#3a3f51",
        yellow: "#fad732",
        "gray-darker": "#232735",
        "gray-dark": "#3a3f51",
        gray: "#dde6e9",
        "gray-light": "#e4eaec",
        "gray-lighter": "#edf1f2"
    }, e.APP_MEDIAQUERY = {
        desktopLG: 1200,
        desktop: 992,
        tablet: 768,
        mobile: 480
    }
}(window, document, window.jQuery),
function(e, t, o, n) {
    o(function() {
        o(".flatdoc").each(function() {
            Flatdoc.run({
                fetcher: Flatdoc.file("documentation/readme.md"),
                root: ".flatdoc",
                menu: ".flatdoc-menu",
                title: ".flatdoc-title",
                content: ".flatdoc-content"
            })
        })
    })
}(window, document, window.jQuery),
function(e, t, o, n) {
    "undefined" != typeof screenfull && o(function() {
        function n(e) {
            screenfull.isFullscreen ? e.children("em").removeClass("fa-expand").addClass("fa-compress") : e.children("em").removeClass("fa-compress").addClass("fa-expand")
        }
        var a = o(t),
            r = o("[data-toggle-fullscreen]"),
            i = e.navigator.userAgent;
        (i.indexOf("MSIE ") > 0 || i.match(/Trident.*rv\:11\./)) && r.addClass("hide"), r.is(":visible") && (r.on("click", function(e) {
            e.preventDefault(), screenfull.enabled ? (screenfull.toggle(), n(r)) : console.log("Fullscreen not enabled")
        }), screenfull.raw && screenfull.raw.fullscreenchange && a.on(screenfull.raw.fullscreenchange, function() {
            n(r)
        }))
    })
}(window, document, window.jQuery),
function(e, t, o, n) {
    function a(e) {
        var t = "autoloaded-stylesheet",
            n = o("#" + t).attr("id", t + "-old");
        return o("head").append(o("<link/>").attr({
            id: t,
            rel: "stylesheet",
            href: e
        })), n.length && n.remove(), o("#" + t)
    }
    o(function() {
        o("[data-load-css]").on("click", function(e) {
            var t = o(this);
            t.is("a") && e.preventDefault();
            var n, r = t.data("loadCss");
            r ? (n = a(r), n || o.error("Error creating stylesheet link element.")) : o.error("No stylesheet location defined.")
        })
    })
}(window, document, window.jQuery),
function(e, t, o, n) {
    o(function() {
        var e = new a,
            n = o("[data-search-open]");
        n.on("click", function(e) {
            e.stopPropagation()
        }).on("click", e.toggle);
        var r = o("[data-search-dismiss]"),
            i = '.navbar-form input[type="text"]';
        o(i).on("click", function(e) {
            e.stopPropagation()
        }).on("keyup", function(t) {
            27 == t.keyCode && e.dismiss()
        }), o(t).on("click", e.dismiss), r.on("click", function(e) {
            e.stopPropagation()
        }).on("click", e.dismiss)
    });
    var a = function() {
        var e = "form.navbar-form";
        return {
            toggle: function() {
                var t = o(e);
                t.toggleClass("open");
                var n = t.hasClass("open");
                t.find("input")[n ? "focus" : "blur"]()
            },
            dismiss: function() {
                o(e).removeClass("open").find('input[type="text"]').blur()
            }
        }
    }
}(window, document, window.jQuery),
function(e, t, o) {
    "use strict";
    var n = '[data-tool="panel-dismiss"]',
        a = "panel.remove",
        r = "panel.removed";
    e(o).on("click", n, function() {
        function t() {
            e.support.animation ? n.animo({
                animation: "bounceOut"
            }, o) : o()
        }

        function o() {
            var t = n.parent();
            e.when(n.trigger(r, [n])).done(function() {
                n.remove(), t.trigger(r).filter(function() {
                    var t = e(this);
                    return t.is('[class*="col-"]:not(.sortable)') && 0 === t.children("*").length
                }).remove()
            })
        }
        var n = e(this).closest(".panel"),
            i = new e.Deferred;
        n.trigger(a, [n, i]), i.done(t)
    })
}(jQuery, window, document),
function(e, t, o) {
    "use strict";

    function n(e) {
        e.removeClass("fa-plus").addClass("fa-minus")
    }

    function a(e) {
        e.removeClass("fa-minus").addClass("fa-plus")
    }

    function r(t, o) {
        var n = e.localStorage.get(s);
        n || (n = {}), n[t] = o, e.localStorage.set(s, n)
    }

    function i(t) {
        var o = e.localStorage.get(s);
        if (o) return o[t] || !1
    }
    var l = '[data-tool="panel-collapse"]',
        s = "jq-panelState";
    e(l).each(function() {
        var t = e(this),
            o = t.closest(".panel"),
            l = o.find(".panel-wrapper"),
            s = {
                toggle: !1
            },
            c = t.children("em"),
            d = o.attr("id");
        l.length || (l = o.children(".panel-heading").nextAll().wrapAll("<div/>").parent().addClass("panel-wrapper"), s = {}), l.collapse(s).on("hide.bs.collapse", function() {
            a(c), r(d, "hide"), l.prev(".panel-heading").addClass("panel-heading-collapsed")
        }).on("show.bs.collapse", function() {
            n(c), r(d, "show"), l.prev(".panel-heading").removeClass("panel-heading-collapsed")
        });
        var u = i(d);
        u && (setTimeout(function() {
            l.collapse(u)
        }, 0), r(d, u))
    }), e(o).on("click", l, function() {
        var t = e(this).closest(".panel"),
            o = t.find(".panel-wrapper");
        o.collapse("toggle")
    })
}(jQuery, window, document),
function(e, t, o) {
    "use strict";

    function n() {
        this.removeClass(i)
    }
    var a = '[data-tool="panel-refresh"]',
        r = "panel.refresh",
        i = "whirl",
        l = "standard";
    e(o).on("click", a, function() {
        var t = e(this),
            o = t.parents(".panel").eq(0),
            a = t.data("spinner") || l;
        o.addClass(i + " " + a), o.removeSpinner = n, t.trigger(r, [o])
    })
}(jQuery, window, document),
function(e, t, o) {
    "use strict";
    var n = "[data-animate]";
    e(function() {
        var a = e(t).add("body, .wrapper");
        e(n).each(function() {
            function t(t) {
                !t.hasClass("anim-running") && e.Utils.isInView(t, {
                    topoffset: n
                }) && (t.addClass("anim-running"), setTimeout(function() {
                    t.addClass("anim-done").animo({
                        animation: i,
                        duration: .7
                    })
                }, r))
            }
            var o = e(this),
                n = o.data("offset"),
                r = o.data("delay") || 100,
                i = o.data("play") || "bounce";
            "undefined" != typeof n && (t(o), a.scroll(function() {
                t(o)
            }))
        }), e(o).on("click", n, function() {
            var t = e(this),
                o = t.data("target"),
                n = t.data("play") || "bounce",
                a = e(o);
            a && a.length && a.animo({
                animation: n
            })
        })
    })
}(jQuery, window, document),
function(e, t, o) {
    "use strict";

    function n(t, o) {
        var n = e.localStorage.get(i);
        n || (n = {}), n[this.id] = e(this).sortable("toArray"), n && e.localStorage.set(i, n)
    }

    function a() {
        var t = e.localStorage.get(i);
        if (t) {
            var o = this.id,
                n = t[o];
            if (n) {
                var a = e("#" + o);
                e.each(n, function(t, o) {
                    e("#" + o).appendTo(a)
                })
            }
        }
    }
    if (e.fn.sortable) {
        var r = '[data-toggle="portlet"]',
            i = "jq-portletState";
        e(function() {
            e(r).sortable({
                connectWith: r,
                items: "div.panel",
                handle: ".portlet-handler",
                opacity: .7,
                placeholder: "portlet box-placeholder",
                cancel: ".portlet-cancel",
                forcePlaceholderSize: !0,
                iframeFix: !1,
                tolerance: "pointer",
                helper: "original",
                revert: 200,
                forceHelperSize: !0,
                update: n,
                create: a
            })
        })
    }
}(jQuery, window, document),
function(e, t, o, n) {
    o(function() {
        o.fn.select2 && (o("#select2-1").select2({
            theme: "bootstrap"
        }), o("#select2-2").select2({
            theme: "bootstrap"
        }), o("#select2-3").select2({
            theme: "bootstrap"
        }), o("#select2-4").select2({
            placeholder: "Select a state",
            allowClear: !0,
            theme: "bootstrap"
        }))
    })
}(window, document, window.jQuery),
function(e, t, o, n) {
    function a() {
        var e = o("<div/>", {
            class: "dropdown-backdrop"
        });
        e.insertAfter(".aside").on("click mouseenter", function() {
            l()
        })
    }

    function r(e) {
        e.siblings("li").removeClass("open").end().toggleClass("open")
    }

    function i(e) {
        l();
        var t = e.children("ul");
        if (!t.length) return o();
        if (e.hasClass("open")) return r(e), o();
        var n = o(".aside"),
            a = o(".aside-inner"),
            i = parseInt(a.css("padding-top"), 0) + parseInt(n.css("padding-top"), 0),
            s = t.clone().appendTo(n);
        r(e);
        var c = e.position().top + i - g.scrollTop(),
            u = f.height();
        return s.addClass("nav-floating").css({
            position: d() ? "fixed" : "absolute",
            top: c,
            bottom: s.outerHeight(!0) + c > u ? 0 : "auto"
        }), s.on("mouseleave", function() {
            r(e), s.remove()
        }), s
    }

    function l() {
        o(".sidebar-subnav.nav-floating").remove(), o(".dropdown-backdrop").remove(), o(".sidebar li.open").removeClass("open")
    }

    function s() {
        return p.hasClass("touch")
    }

    function c() {
        return h.hasClass("aside-collapsed") || h.hasClass("aside-collapsed-text")
    }

    function d() {
        return h.hasClass("layout-fixed")
    }

    function u() {
        return h.hasClass("aside-hover")
    }
    var f, p, h, g, m;
    o(function() {
        f = o(e), p = o("html"), h = o("body"), g = o(".sidebar"), m = APP_MEDIAQUERY;
        var t = g.find(".collapse");
        t.on("show.bs.collapse", function(e) {
            e.stopPropagation(), 0 === o(this).parents(".collapse").length && t.filter(".in").collapse("hide")
        });
        var n = o(".sidebar .active").parents("li");
        u() || n.addClass("active").children(".collapse").collapse("show"), g.find("li > a + ul").on("show.bs.collapse", function(e) {
            u() && e.preventDefault()
        });
        var r = s() ? "click" : "mouseenter",
            l = o();
        g.on(r, ".nav > li", function() {
            (c() || u()) && (l.trigger("mouseleave"), l = i(o(this)), a())
        });
        var d = g.data("sidebarAnyclickClose");
        "undefined" != typeof d && o(".wrapper").on("click.sidebar", function(e) {
            if (h.hasClass("aside-toggled")) {
                var t = o(e.target);
                t.parents(".aside").length || t.is("#user-block-toggle") || t.parent().is("#user-block-toggle") || h.removeClass("aside-toggled")
            }
        })
    })
}(window, document, window.jQuery),
function(e, t, o, n) {
    o(function() {
        o("[data-skycon]").each(function() {
            var e = o(this),
                t = new Skycons({
                    color: e.data("color") || "white"
                });
            e.html('<canvas width="' + e.data("width") + '" height="' + e.data("height") + '"></canvas>'), t.add(e.children()[0], e.data("skycon")), t.play()
        })
    })
}(window, document, window.jQuery),
function(e, t, o, n) {
    o(function() {
        o("[data-scrollable]").each(function() {
            var e = o(this),
                t = 250;
            e.slimScroll({
                height: e.data("height") || t
            })
        })
    })
}(window, document, window.jQuery),
function(e, t, o, n) {
    o(function() {
        function t() {
            var t = o(this),
                n = t.data(),
                a = n.values && n.values.split(",");
            n.type = n.type || "bar", n.disableHiddenCheck = !0, t.sparkline(a, n), n.resize && o(e).resize(function() {
                t.sparkline(a, n)
            })
        }
        o("[data-sparkline]").each(t)
    })
}(window, document, window.jQuery),
function(e, t, o, n) {
    o(function() {
        o("#swal-demo1").on("click", function(e) {
            e.preventDefault(), swal("Here's a message!")
        }), o("#swal-demo2").on("click", function(e) {
            e.preventDefault(), swal("Here's a message!", "It's pretty, isn't it?")
        }), o("#swal-demo3").on("click", function(e) {
            e.preventDefault(), swal("Good job!", "You clicked the button!", "success")
        }), o("#swal-demo4").on("click", function(e) {
            e.preventDefault(), swal({
                title: "Are you sure?",
                text: "You will not be able to recover this imaginary file!",
                type: "warning",
                showCancelButton: !0,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete it!",
                closeOnConfirm: !1
            }, function() {
                swal("Deleted!", "Your imaginary file has been deleted.", "success")
            })
        }), o("#swal-demo5").on("click", function(e) {
            e.preventDefault(), swal({
                title: "Are you sure?",
                text: "You will not be able to recover this imaginary file!",
                type: "warning",
                showCancelButton: !0,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel plx!",
                closeOnConfirm: !1,
                closeOnCancel: !1
            }, function(e) {
                e ? swal("Deleted!", "Your imaginary file has been deleted.", "success") : swal("Cancelled", "Your imaginary file is safe :)", "error")
            })
        })
    })
}(window, document, window.jQuery),
function(e, t, o, n) {
    o(function() {
        o("[data-check-all]").on("change", function() {
            var e = o(this),
                t = e.index() + 1,
                n = e.find('input[type="checkbox"]'),
                a = e.parents("table");
            a.find("tbody > tr > td:nth-child(" + t + ') input[type="checkbox"]').prop("checked", n[0].checked)
        })
    })
}(window, document, window.jQuery),
function(e, t, o, n) {
    o(function() {
        var t = o("body");
        toggle = new StateToggler, o("[data-toggle-state]").on("click", function(a) {
            a.stopPropagation();
            var r = o(this),
                i = r.data("toggleState"),
                l = r.data("target"),
                s = r.attr("data-no-persist") !== n,
                c = l ? o(l) : t;
            i && (c.hasClass(i) ? (c.removeClass(i), s || toggle.removeState(i)) : (c.addClass(i), s || toggle.addState(i))), o(e).resize()
        })
    }), e.StateToggler = function() {
        var e = "jq-toggleState",
            t = {
                hasWord: function(e, t) {
                    return new RegExp("(^|\\s)" + t + "(\\s|$)").test(e)
                },
                addWord: function(e, t) {
                    if (!this.hasWord(e, t)) return e + (e ? " " : "") + t
                },
                removeWord: function(e, t) {
                    if (this.hasWord(e, t)) return e.replace(new RegExp("(^|\\s)*" + t + "(\\s|$)*", "g"), "")
                }
            };
        return {
            addState: function(n) {
                var a = o.localStorage.get(e);
                a = a ? t.addWord(a, n) : n, o.localStorage.set(e, a)
            },
            removeState: function(n) {
                var a = o.localStorage.get(e);
                a && (a = t.removeWord(a, n), o.localStorage.set(e, a))
            },
            restoreState: function(t) {
                var n = o.localStorage.get(e);
                n && t.addClass(n)
            }
        }
    }
}(window, document, window.jQuery),
function(e, t, o, n) {
    o(function() {
        var e = [];
        if (o(".tour-step").each(function() {
                var t = o(this).data();
                t.element = "#" + this.id, e.push(t)
            }), e.length) {
            var t = new Tour({
                backdrop: !0,
                onShown: function(e) {
                    o(".wrapper > section").css({
                        position: "static"
                    })
                },
                onHide: function(e) {
                    o(".wrapper > section").css({
                        position: ""
                    })
                },
                steps: e
            });
            t.init(), o("#start-tour").on("click", function() {
                t.restart()
            })
        }
    })
}(window, document, window.jQuery),
function(e, t, o, n) {
    o(function() {
        var n = o("[data-trigger-resize]"),
            a = n.data("triggerResize");
        n.on("click", function() {
            setTimeout(function() {
                var o = t.createEvent("UIEvents");
                o.initUIEvent("resize", !0, !1, e, 0), e.dispatchEvent(o)
            }, a || 300)
        })
    })
}(window, document, window.jQuery),
function(e, t, o) {
    "use strict";
    var n = e("html"),
        a = e(t);
    e.support.transition = function() {
        var e = function() {
            var e, t = o.body || o.documentElement,
                n = {
                    WebkitTransition: "webkitTransitionEnd",
                    MozTransition: "transitionend",
                    OTransition: "oTransitionEnd otransitionend",
                    transition: "transitionend"
                };
            for (e in n)
                if (void 0 !== t.style[e]) return n[e]
        }();
        return e && {
            end: e
        }
    }(), e.support.animation = function() {
        var e = function() {
            var e, t = o.body || o.documentElement,
                n = {
                    WebkitAnimation: "webkitAnimationEnd",
                    MozAnimation: "animationend",
                    OAnimation: "oAnimationEnd oanimationend",
                    animation: "animationend"
                };
            for (e in n)
                if (void 0 !== t.style[e]) return n[e]
        }();
        return e && {
            end: e
        }
    }(), e.support.requestAnimationFrame = t.requestAnimationFrame || t.webkitRequestAnimationFrame || t.mozRequestAnimationFrame || t.msRequestAnimationFrame || t.oRequestAnimationFrame || function(e) {
        t.setTimeout(e, 1e3 / 60)
    }, e.support.touch = "ontouchstart" in t && navigator.userAgent.toLowerCase().match(/mobile|tablet/) || t.DocumentTouch && document instanceof t.DocumentTouch || t.navigator.msPointerEnabled && t.navigator.msMaxTouchPoints > 0 || t.navigator.pointerEnabled && t.navigator.maxTouchPoints > 0 || !1, e.support.mutationobserver = t.MutationObserver || t.WebKitMutationObserver || t.MozMutationObserver || null, e.Utils = {}, e.Utils.debounce = function(e, t, o) {
        var n;
        return function() {
            var a = this,
                r = arguments,
                i = function() {
                    n = null, o || e.apply(a, r)
                },
                l = o && !n;
            clearTimeout(n), n = setTimeout(i, t), l && e.apply(a, r)
        }
    }, e.Utils.removeCssRules = function(e) {
        var t, o, n, a, r, i, l, s, c, d;
        e && setTimeout(function() {
            try {
                for (d = document.styleSheets, a = 0, l = d.length; a < l; a++) {
                    for (n = d[a], o = [], n.cssRules = n.cssRules, t = r = 0, s = n.cssRules.length; r < s; t = ++r) n.cssRules[t].type === CSSRule.STYLE_RULE && e.test(n.cssRules[t].selectorText) && o.unshift(t);
                    for (i = 0, c = o.length; i < c; i++) n.deleteRule(o[i])
                }
            } catch (e) {}
        }, 0)
    }, e.Utils.isInView = function(t, o) {
        var n = e(t);
        if (!n.is(":visible")) return !1;
        var r = a.scrollLeft(),
            i = a.scrollTop(),
            l = n.offset(),
            s = l.left,
            c = l.top;
        return o = e.extend({
            topoffset: 0,
            leftoffset: 0
        }, o), c + n.height() >= i && c - o.topoffset <= i + a.height() && s + n.width() >= r && s - o.leftoffset <= r + a.width()
    }, e.Utils.options = function(t) {
        if (e.isPlainObject(t)) return t;
        var o = t ? t.indexOf("{") : -1,
            n = {};
        if (o != -1) try {
            n = new Function("", "var json = " + t.substr(o) + "; return JSON.parse(JSON.stringify(json));")()
        } catch (e) {}
        return n
    }, e.Utils.events = {}, e.Utils.events.click = e.support.touch ? "tap" : "click", e.langdirection = "rtl" == n.attr("dir") ? "right" : "left", e(function() {
        if (e.support.mutationobserver) {
            var t = new e.support.mutationobserver(e.Utils.debounce(function(t) {
                e(o).trigger("domready")
            }, 300));
            t.observe(document.body, {
                childList: !0,
                subtree: !0
            })
        }
    }), n.addClass(e.support.touch ? "touch" : "no-touch")
}(jQuery, window, document),
function(e, t, o, n) {
    o(function() {})
}(window, document, window.jQuery);