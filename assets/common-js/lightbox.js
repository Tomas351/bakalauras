function pureJSLightBox(e) {
	function t(e, t, n) {
		var a, r, i, l, s, o, d, c = e;
		c.addEventListener("touchstart", function(e) {
			var t = e.changedTouches[0];
			a = "none", dist = 0, r = t.pageX, i = t.pageY, d = (new Date).getTime()
		}, !1), c.addEventListener("touchend", function(e) {
			var c = e.changedTouches[0];
			l = c.pageX - r, s = c.pageY - i, (o = (new Date).getTime() - d) <= 400 && Math.abs(l) >= 40 ? (a = l < 0 ? "left" : "right", e.preventDefault(), t(a)) : "function" == typeof n && n()
		}, !1)
	}

	function n() {
		y.hasClass(c), f.hidden && (y.removeClass(c, f.hidden), y.addClass(document.getElementsByTagName("body")[0], f.noScroll))
	}

	function a() {
		var e = y.getCurrentItemInView();
		y.removeClass(e, f.currImgInView), y.addClass(e, f.hidden), y.addClass(c, f.hidden), y.removeClass(document.getElementsByTagName("body")[0], f.noScroll)
	}

	function r() {
		var e = document.createElement("div");
		if (e.setAttribute("class", f.overlay), h.hasOwnProperty("overlay") && !1 === h.overlay && y.addClass(e, f.transparent), c.appendChild(e), h.hasOwnProperty("swipe") && !1 === h.swipe || t(document.getElementsByTagName("body")[0], l, null), !h.hasOwnProperty("navigation") || !1 !== h.navigation) {
			var n = document.createElement("div");
			n.setAttribute("class", f.navigationButton), n.setAttribute("id", f.leftArrow);
			var r = document.createElement("div");
			r.setAttribute("class", f.navigationButton), r.setAttribute("id", f.rightArrow), c.appendChild(n), c.appendChild(r), u = n, g = r, n.addEventListener("click", s.bind(null, "forward")), r.addEventListener("click", s.bind(null, "backward"))
		}
		var i = document.createElement("div");
		i.setAttribute("class", f.navigationButton), i.setAttribute("id", f.closeButton), c.appendChild(i), (m = i).addEventListener("click", a)
	}

	function i(e) {
		var t = document.createElement("ul");
		t.setAttribute("class", f.galleryList), c.appendChild(t), d = t.getElementsByTagName("li");
		for (var n = 0; n < e.length; n++) {
			var a = document.createElement("li");
			a.setAttribute("class", f.galleryListItem), y.addClass(a, f.hidden), t.appendChild(a);
			var r = document.createElement("img");
			r.src = y.getIinitialListElementSrc(e[n]), r.setAttribute("data-index", n), a.appendChild(r), e[n].addEventListener("click", function(e) {
				e.preventDefault(), o(y.getIinitialListElementSrc(this))
			})
		}
	}

	function l(e) {
		s(e = "left" == e ? "forward" : "backward")
	}

	function s(e) {
		var t = y.getCurrentVisibleItemIndex();
		e === v.forward ? (t += 1) === d.length && (t = 0) : (t -= 1) < 0 && (t = d.length - 1), o(y.getGalleryElementSrcByIndex(t))
	}

	function o(e) {
		n();
		for (var t, a = 0; a < d.length; ++a) y.addClass(d[a], f.hidden), y.removeClass(d[a], f.currImgInView), d[a].firstChild.src === e && (t = d[a], y.removeClass(t, f.hidden), y.addClass(t, f.currImgInView))
	}
	var d, c, u, g, m, h = e || {},
		f = {
			visible: "visible",
			transparent: "transparent",
			hidden: "hidden",
			noScroll: "no-scroll",
			galleryList: "gallery-list",
			galleryListItem: "gallery-list-item",
			selector: "pure-js-lightbox-container",
			lightboxContainer: "lightbox-main-container",
			currImgInView: "fadeIn",
			overlay: "overlay",
			navigationButton: "navigation-button",
			leftArrow: "left-arrow",
			rightArrow: "right-arrow",
			closeButton: "close-button"
		},
		v = {
			forward: "forward",
			backward: "backward"
		},
		y = {
			addClass: function(e, t) {
				this.hasClass(e, t) || (e instanceof Array || e instanceof NodeList || (e = [e]), [].forEach.call(e, function(e) {
					e.className += " " + t
				}))
			},
			hasClass: function(e, t) {
				return void 0 != e && e.className && new RegExp("(^|\\s)" + t + "(\\s|$)").test(e.className)
			},
			removeClass: function(e, t) {
				if (this.hasClass(e, t)) {
					var n = new RegExp(t, "g");
					e instanceof Array || e instanceof NodeList || (e = [e]), [].forEach.call(e, function(e) {
						e.className = e.className.replace(n, "")
					})
				}
			},
			getIinitialListElementSrc: function(e) {
				return e = e.getElementsByTagName("a"), e && e[0] && e[0].href ? e[0].href : null
			},
			getGalleryElementSrc: function(e) {
				return e && e.children && e.children[0] && e.children[0].src ? e.children[0].src : null
			},
			getGalleryImgIndex: function(e) {
				return e.children && e.children[0] ? e.children[0].getAttribute("data-index") : null
			},
			getGalleryElementSrcByIndex: function(e) {
				return d[e] ? this.getGalleryElementSrc(d[e]) : null
			},
			getCurrentItemInView: function() {
				for (var e = 0; e < d.length; ++e)
					if (y.hasClass(d[e], f.currImgInView)) return d[e]
			},
			getCurrentVisibleItemIndex: function() {
				for (var e = 0; e < d.length; ++e)
					if (y.hasClass(d[e], f.currImgInView)) return e
			}
		};
	! function() {
		var e = document.getElementsByClassName(f.selector);
		if (!(e = e && e[0] ? e[0].getElementsByTagName("li") : null)) return console.log("Pure js lightbox | Please provide a list of gallery elements"), !1;
		(c = document.createElement("div")).setAttribute("id", f.lightboxContainer), y.addClass(c, f.hidden), window.document.body.insertBefore(c, window.document.body.firstChild), r(), i(e)
	}()
}