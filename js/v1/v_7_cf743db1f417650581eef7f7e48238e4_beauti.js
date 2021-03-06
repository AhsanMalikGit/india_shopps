/*! jQuery v1.11.0 | (c) 2005, 2014 jQuery Foundation, Inc. | jquery.org/license */
function formatedNumberToFloat(t, e, n) {
    return t = t.replace(n, ""), 1 === e ? parseFloat(t.replace(",", "").replace(" ", "")) : 2 === e ? parseFloat(t.replace(" ", "").replace(",", ".")) : 3 === e ? parseFloat(t.replace(".", "").replace(" ", "").replace(",", ".")) : 4 === e ? parseFloat(t.replace(",", "").replace(" ", "")) : t
}

function formatNumber(t, e, n, i) {
    t = t.toFixed(e);
    for (var o = t + "", a = o.split("."), s = 2 === a.length ? a[0] : o, r = ("0." + (2 === a.length ? a[1] : 0)).substr(2), l = s.length, c = 1; 4 > c; c++) t >= Math.pow(10, 3 * c) && (s = s.substring(0, l - 3 * c) + n + s.substring(l - 3 * c));
    return 0 === parseInt(e) ? s : s + i + (r > 0 ? r : "00")
}

function formatCurrency(t, e, n, i) {
    var o = "";
    return t = parseFloat(t.toFixed(10)), t = ps_round(t, priceDisplayPrecision), i > 0 && (o = " "), 1 == e ? n + o + formatNumber(t, priceDisplayPrecision, ",", ".") : 2 == e ? formatNumber(t, priceDisplayPrecision, " ", ",") + o + n : 3 == e ? n + o + formatNumber(t, priceDisplayPrecision, ".", ",") : 4 == e ? formatNumber(t, priceDisplayPrecision, ",", ".") + o + n : 5 == e ? n + o + formatNumber(t, priceDisplayPrecision, "'", ".") : t
}

function ps_round_helper(t, e) {
    return t >= 0 ? (tmp_value = Math.floor(t + .5), (3 == e && t == -.5 + tmp_value || 4 == e && t == .5 + 2 * Math.floor(tmp_value / 2) || 5 == e && t == .5 + 2 * Math.floor(tmp_value / 2) - 1) && (tmp_value -= 1)) : (tmp_value = Math.ceil(t - .5), (3 == e && t == .5 + tmp_value || 4 == e && t == -.5 + 2 * Math.ceil(tmp_value / 2) || 5 == e && t == -.5 + 2 * Math.ceil(tmp_value / 2) + 1) && (tmp_value += 1)), tmp_value
}

function ps_log10(t) {
    return Math.log(t) / Math.LN10
}

function ps_round_half_up(t, e) {
    var n = Math.pow(10, e),
        i = t * n,
        o = Math.floor(10 * i) - 10 * Math.floor(i);
    return i = o >= 5 ? Math.ceil(i) : Math.floor(i), i / n
}

function ps_round(t, e) {
    "undefined" == typeof roundMode && (roundMode = 2), "undefined" == typeof e && (e = 2);
    var n = roundMode;
    if (0 === n) return ceilf(t, e);
    if (1 === n) return floorf(t, e);
    if (2 === n) return ps_round_half_up(t, e);
    if (3 == n || 4 == n || 5 == n) {
        var i = 14 - Math.floor(ps_log10(Math.abs(t))),
            o = Math.pow(10, Math.abs(e));
        if (i > e && 15 > i - e) {
            var a = Math.pow(10, Math.abs(i));
            i >= 0 ? tmp_value = t * a : tmp_value = t / a, tmp_value = ps_round_helper(tmp_value, roundMode), a = Math.pow(10, Math.abs(e - i)), tmp_value /= a
        } else if (e >= 0 ? tmp_value = t * o : tmp_value = t / o, Math.abs(tmp_value) >= 1e15) return t;
        return tmp_value = ps_round_helper(tmp_value, roundMode), e > 0 ? tmp_value /= o : tmp_value *= o, tmp_value
    }
}

function autoUrl(t, e) {
    var n, i;
    i = document.getElementById(t), n = i.options[i.selectedIndex].value, 0 != n && (location.href = e + n)
}

function autoUrlNoList(t, e) {
    var n;
    n = document.getElementById(t).checked, location.href = e + (1 == n ? 1 : 0)
}

function toggle(t, e) {
    t.style.display = e ? "" : "none"
}

function toggleMultiple(t) {
    for (var e = t.length, n = 0; e > n; n++) t[n].style && toggle(t[n], "none" == t[n].style.display)
}

function showElemFromSelect(t, e) {
    for (var n = document.getElementById(t), i = 0; i < n.length; ++i) {
        var o = document.getElementById(e + n.options[i].value);
        null != o && toggle(o, i == n.selectedIndex)
    }
}

function openCloseAllDiv(t, e) {
    for (var n = $("*[name=" + t + "]"), i = 0; i < n.length; ++i) toggle(n[i], e)
}

function toggleDiv(t, e) {
    $("*[name=" + t + "]").each(function() {
        "open" == e ? ($("#buttonall").data("status", "close"), $(this).hide()) : ($("#buttonall").data("status", "open"), $(this).show())
    })
}

function toggleButtonValue(t, e, n) {
    $("#" + t).find("i").first().hasClass("process-icon-compress") ? ($("#" + t).find("i").first().removeClass("process-icon-compress").addClass("process-icon-expand"), $("#" + t).find("span").first().html(e)) : ($("#" + t).find("i").first().removeClass("process-icon-expand").addClass("process-icon-compress"), $("#" + t).find("span").first().html(n))
}

function toggleElemValue(t, e, n) {
    var i = document.getElementById(t);
    i && (i.value = i.value && i.value != n ? n : e)
}

function addBookmark(t, e) {
    return window.sidebar && window.sidebar.addPanel ? window.sidebar.addPanel(e, t, "") : window.external && "AddFavorite" in window.external ? window.external.AddFavorite(t, e) : void 0
}

function writeBookmarkLink(t, e, n, i) {
    var o = "";
    i && (o = writeBookmarkLinkObject(t, e, '<img src="' + i + '" alt="' + escape(n) + '" title="' + removeQuotes(n) + '" />') + "&nbsp"), o += writeBookmarkLinkObject(t, e, n), (window.sidebar || window.opera && window.print || window.external && "AddFavorite" in window.external) && $(".add_bookmark, #header_link_bookmark").append(o)
}

function writeBookmarkLinkObject(t, e, n) {
    return window.sidebar || window.external ? "<a href=\"javascript:addBookmark('" + escape(t) + "', '" + removeQuotes(e) + "')\">" + n + "</a>" : window.opera && window.print ? '<a rel="sidebar" href="' + escape(t) + '" title="' + removeQuotes(e) + '">' + n + "</a>" : ""
}

function checkCustomizations() {
    var t = new RegExp(" ?filled ?");
    if ("undefined" != typeof customizationFields)
        for (var e = 0; e < customizationFields.length; e++)
            if (1 == parseInt(customizationFields[e][1]) && ("" == $("#" + customizationFields[e][0]).html() || $("#" + customizationFields[e][0]).text() != $("#" + customizationFields[e][0]).val()) && !t.test($("#" + customizationFields[e][0]).attr("class"))) return !1;
    return !0
}

function emptyCustomizations() {
    if (customizationId = null, "undefined" != typeof customizationFields) {
        $(".customization_block .success").fadeOut(function() {
            $(this).remove()
        }), $(".customization_block .error").fadeOut(function() {
            $(this).remove()
        });
        for (var t = 0; t < customizationFields.length; t++) $("#" + customizationFields[t][0]).html(""), $("#" + customizationFields[t][0]).val("")
    }
}

function ceilf(t, e) {
    "undefined" == typeof e && (e = 0);
    var n = 0 === e ? 1 : Math.pow(10, e),
        i = t * n,
        o = i.toString();
    return 0 === o[o.length - 1] ? t : Math.ceil(t * n) / n
}

function floorf(t, e) {
    "undefined" == typeof e && (e = 0);
    var n = 0 === e ? 1 : Math.pow(10, e),
        i = t * n,
        o = i.toString();
    return 0 === o[o.length - 1] ? t : Math.floor(t * n) / n
}

function setCurrency(t) {
    $.ajax({
        type: "POST",
        headers: {
            "cache-control": "no-cache"
        },
        url: baseDir + "index.php?rand=" + (new Date).getTime(),
        data: "controller=change-currency&id_currency=" + parseInt(t),
        success: function(t) {
            location.reload(!0)
        }
    })
}

function isArrowKey(t) {
    var e = t.keyCode ? t.keyCode : t.charCode;
    return e >= 37 && 40 >= e ? !0 : !1
}

function removeQuotes(t) {
    return t = t.replace(/\\"/g, ""), t = t.replace(/"/g, ""), t = t.replace(/\\'/g, ""), t = t.replace(/'/g, "")
}

function sprintf(t) {
    for (var e = 1; e < arguments.length; e++) t = t.replace(/%s/, arguments[e]);
    return t
}

function fancyMsgBox(t, e) {
    e && (t = "<h2>" + e + "</h2><p>" + t + "</p>"), t += '<br/><p class="submit" style="text-align:right; padding-bottom: 0"><input class="button" type="button" value="OK" onclick="$.fancybox.close();" /></p>', $.prototype.fancybox && $.fancybox(t, {
        autoDimensions: !1,
        autoSize: !1,
        width: 500,
        height: "auto",
        openEffect: "none",
        closeEffect: "none"
    })
}

function fancyChooseBox(t, e, n, i) {
    var o, a, s;
    o = "", e && (o = "<h2>" + e + "</h2><p>" + t + "</p>"), o += '<br/><p class="submit" style="text-align:right; padding-bottom: 0">';
    var r = 0;
    for (var l in n) n.hasOwnProperty(l) && (a = n[l], "undefined" == typeof i && (i = 0), i = escape(JSON.stringify(i)), s = a ? "$.fancybox.close();window['" + a + "'](JSON.parse(unescape('" + i + "')), " + r + ")" : "$.fancybox.close()", o += '<button type="submit" class="button btn-default button-medium" style="margin-right: 5px;" value="true" onclick="' + s + '" >', o += "<span>" + l + "</span></button>", r++);
    o += "</p>", $.prototype.fancybox && $.fancybox(o, {
        autoDimensions: !1,
        width: 500,
        height: "auto",
        openEffect: "none",
        closeEffect: "none"
    })
}

function toggleLayer(t, e) {
    e ? $(t).show() : $(t).hide()
}

function openCloseLayer(t, e) {
    e ? "open" == e ? $(t).show() : "close" == e && $(t).hide() : "none" == $(t).css("display") ? $(t).show() : $(t).hide()
}

function updateTextWithEffect(t, e, n, i, o, a) {
    t.text() !== e && ("fade" === i ? t.fadeOut(n, function() {
        $(this).addClass(a), "fade" === o ? $(this).text(e).fadeIn(n) : "slide" === o ? $(this).text(e).slideDown(n) : "show" === o && $(this).text(e).show(n, function() {})
    }) : "slide" === i ? t.slideUp(n, function() {
        $(this).addClass(a), "fade" === o ? $(this).text(e).fadeIn(n) : "slide" === o ? $(this).text(e).slideDown(n) : "show" === o && $(this).text(e).show(n)
    }) : "hide" === i && t.hide(n, function() {
        $(this).addClass(a), "fade" === o ? $(this).text(e).fadeIn(n) : "slide" === o ? $(this).text(e).slideDown(n) : "show" === o && $(this).text(e).show(n)
    }))
}

function dbg(t) {
    var e = !1,
        n = !0;
    e && (n ? console.log(t) : alert(t))
}

function print_r(t, e, n) {
    n = n ? n : 0, e = e ? e : 1, returnString = "<ol>";
    for (property in t) "domConfig" != property && (returnString += "<li><strong>" + property + "</strong> <small>(" + typeof t[property] + ")</small>", ("number" == typeof t[property] || "boolean" == typeof t[property]) && (returnString += " : <em>" + t[property] + "</em>"), "string" == typeof t[property] && t[property] && (returnString += ': <div style="background:#C9C9C9;border:1px solid black; overflow:auto;"><code>' + t[property].replace(/</g, "&amp;lt;").replace(/>/g, "&amp;gt;") + "</code></div>"), "object" == typeof t[property] && e > n && (returnString += print_r(t[property], e, n + 1)), returnString += "</li>");
    return returnString += "</ol>", 0 == n && (winpop = window.open("", "", "width=800,height=600,scrollbars,resizable"), winpop.document.write("<pre>" + returnString + "</pre>"), winpop.document.close()), returnString
}

function in_array(t, e) {
    for (var n in e)
        if (e[n] + "" == t + "") return !0;
    return !1
}

function isCleanHtml(t) {
    var e = "onmousedown|onmousemove|onmmouseup|onmouseover|onmouseout|onload|onunload|onfocus|onblur|onchange";
    e += "|onsubmit|ondblclick|onclick|onkeydown|onkeyup|onkeypress|onmouseenter|onmouseleave|onerror|onselect|onreset|onabort|ondragdrop|onresize|onactivate|onafterprint|onmoveend", e += "|onafterupdate|onbeforeactivate|onbeforecopy|onbeforecut|onbeforedeactivate|onbeforeeditfocus|onbeforepaste|onbeforeprint|onbeforeunload|onbeforeupdate|onmove", e += "|onbounce|oncellchange|oncontextmenu|oncontrolselect|oncopy|oncut|ondataavailable|ondatasetchanged|ondatasetcomplete|ondeactivate|ondrag|ondragend|ondragenter|onmousewheel", e += "|ondragleave|ondragover|ondragstart|ondrop|onerrorupdate|onfilterchange|onfinish|onfocusin|onfocusout|onhashchange|onhelp|oninput|onlosecapture|onmessage|onmouseup|onmovestart", e += "|onoffline|ononline|onpaste|onpropertychange|onreadystatechange|onresizeend|onresizestart|onrowenter|onrowexit|onrowsdelete|onrowsinserted|onscroll|onsearch|onselectionchange", e += "|onselectstart|onstart|onstop";
    var n = /<[\s]*script/im,
        i = new RegExp("(" + e + ")[s]*=", "im"),
        o = /.*script\:/im,
        a = /<[\s]*(i?frame|embed|object)/im;
    return n.test(t) || i.test(t) || o.test(t) || a.test(t) ? !1 : !0
}

function sleep(t) {
    for (var e = (new Date).getTime(), n = 0; 1e7 > n && !((new Date).getTime() - e > t); n++);
}

function highdpiInit() {
    if ("1px" == $(".replace-2x").css("font-size"))
        for (var t = $("img.replace-2x").get(), e = 0; e < t.length; e++) {
            src = t[e].src, extension = src.substr(src.lastIndexOf(".") + 1), src = src.replace("." + extension, "2x." + extension);
            var n = new Image;
            n.src = src, 0 != n.height ? t[e].src = src : t[e].src = t[e].src
        }
}

function scrollCompensate() {
    var t = document.createElement("p");
    t.style.width = "100%", t.style.height = "200px";
    var e = document.createElement("div");
    e.style.position = "absolute", e.style.top = "0px", e.style.left = "0px", e.style.visibility = "hidden", e.style.width = "200px", e.style.height = "150px", e.style.overflow = "hidden", e.appendChild(t), document.body.appendChild(e);
    var n = t.offsetWidth;
    e.style.overflow = "scroll";
    var i = t.offsetWidth;
    return n == i && (i = e.clientWidth), document.body.removeChild(e), n - i
}

function responsiveResize() {
    compensante = scrollCompensate(), $(window).width() + scrollCompensate() <= 767 && 0 == responsiveflag ? (accordion("enable"), accordionFooter("enable"), responsiveflag = !0) : $(window).width() + scrollCompensate() >= 768 && (accordion("disable"), accordionFooter("disable"), responsiveflag = !1, "undefined" != typeof bindUniform && bindUniform())
}

function quick_view() {
    $(document).on("click", ".quick-view:visible, .quick-view-mobile:visible", function(t) {
        t.preventDefault();
        var e = this.href,
            n = ""; - 1 != e.indexOf("#") && (n = e.substring(e.indexOf("#"), e.length), e = e.substring(0, e.indexOf("#"))), e += -1 != e.indexOf("?") ? "&" : "?", $.prototype.fancybox && $.fancybox({
            padding: 0,
            width: 1087,
            height: 610,
            type: "iframe",
            href: e + "content_only=1" + n
        })
    })
}

function bindGrid() {
    var t = $.totalStorage("display");
    !t && "undefined" != typeof displayList && displayList && (t = "list"), t && "grid" != t ? display(t) : $(".display").find("li#grid").addClass("selected"), $(document).on("click", "#grid", function(t) {
        t.preventDefault(), display("grid")
    }), $(document).on("click", "#list", function(t) {
        t.preventDefault(), display("list")
    })
}

function display(t) {
    "list" == t ? ($("ul.product_list").removeClass("grid row_edited").addClass("list row"), $(".product_list > li").removeClass("col-xs-12 col-sm-6 col-md-4 col-lg-3").addClass("col-xs-12"), $(".product_list > li").each(function(t, e) {
        html = "", html = '<div class="product-container"><div class="row">', html += '<div class="col-xs-12 col-sm-5 col-md-4"><div class="left-block">' + $(e).find(".left-block").html() + "</div></div>", html += '<div class="col-xs-12 col-sm-7 col-md-8"><div class="right-block">', html += '<h5 itemprop="name">' + $(e).find("h5").html() + "</h5>";
        var n = $(e).find(".comments_note").html();
        null != n && (html += '<div class="comment_box"><div itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating" class="comments_note">' + n + "</div></div>");
        var i = $(e).find(".price-box").html();
        null != i && (html += '<div class="price-box">' + i + "</div>"), html += '<p itemprop="description" class="product-desc">' + $(e).find(".product-desc").html() + "</p>", html += '<div itemprop="offers" itemscope itemtype="http://schema.org/Offer" class="button-container">' + $(e).find(".button-container").html() + "</div>", html += "</div></div>", html += "</div></div>", $(e).html(html)
    }), $(".display").find("li#list").addClass("selected"), $(".display").find("li#grid").removeAttr("class"), $.totalStorage("display", "list")) : ($("ul.product_list").removeClass("list row").addClass("grid row_edited"), $(".product_list > li").removeClass("col-xs-12").addClass("col-xs-12 col-sm-6 col-md-4 col-lg-3"), $(".product_list > li").each(function(t, e) {
        html = "", html += '<div class="product-container">', html += '<div class="left-block">' + $(e).find(".left-block").html() + "</div>", html += '<div class="right-block">', html += '<h5 itemprop="name">' + $(e).find("h5").html() + "</h5>";
        var n = $(e).find(".comments_note").html();
        null != n && (html += '<div class="comment_box"><div itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating" class="comments_note">' + n + "</div></div>"), html += '<p itemprop="description" class="product-desc">' + $(e).find(".product-desc").html() + "</p>";
        var i = $(e).find(".price-box").html();
        null != i && (html += '<div class="price-box">' + i + "</div>"), html += '<div itemprop="offers" itemscope itemtype="http://schema.org/Offer" class="button-container">' + $(e).find(".button-container").html() + "</div>", html += "</div>", html += "</div>", $(e).html(html)
    }), $(".display").find("li#grid").addClass("selected"), $(".display").find("li#list").removeAttr("class"), $.totalStorage("display", "grid"))
}

function dropDown() {
    elementClick = "#header .current", elementSlide = "ul.toogle_content", activeClass = "active", $(elementClick).on("click", function(t) {
        t.stopPropagation();
        var e = $(this).next(elementSlide);
        e.is(":hidden") ? (e.slideDown(), $(this).addClass(activeClass)) : (e.slideUp(), $(this).removeClass(activeClass)), $(elementClick).not(this).next(elementSlide).slideUp(), $(elementClick).not(this).removeClass(activeClass), t.preventDefault()
    }), $(elementSlide).on("click", function(t) {
        t.stopPropagation()
    }), $(document).on("click", function(t) {
        t.stopPropagation();
        var e = $(elementClick).next(elementSlide);
        $(e).slideUp(), $(elementClick).removeClass("active")
    })
}

function accordionFooter(t) {
    "enable" == t ? ($("#footer .footer-block h4").on("click", function() {
        $(this).toggleClass("active").parent().find(".toggle-footer").stop().slideToggle("medium")
    }), $("#footer").addClass("accordion").find(".toggle-footer").slideUp("fast")) : ($(".footer-block h4").removeClass("active").off().parent().find(".toggle-footer").removeAttr("style").slideDown("fast"), $("#footer").removeClass("accordion"))
}

function accordion(t) {
    if ("enable" == t) {
        var e = "#right_column .block .title_block, #left_column .block .title_block, #left_column #newsletter_block_left h4,#left_column .shopping_cart > a:first-child, #right_column .shopping_cart > a:first-child";
        $(e).on("click", function(t) {
            $(this).toggleClass("active").parent().find(".block_content").stop().slideToggle("medium")
        }), $("#right_column, #left_column").addClass("accordion").find(".block .block_content").slideUp("fast"), "undefined" != typeof ajaxCart && ajaxCart.collapse()
    } else $("#right_column .block .title_block, #left_column .block .title_block, #left_column #newsletter_block_left h4").removeClass("active").off().parent().find(".block_content").removeAttr("style").slideDown("fast"), $("#left_column, #right_column").removeClass("accordion")
}

function bindUniform() {
    $.prototype.uniform && $("select.form-control,input[type='radio'],input[type='checkbox']").not(".not_unifrom").uniform()
}

function addToCompare(t) {
    var e, n, i = parseInt($(".bt_compare").next(".compare_product_count").val());
    e = -1 === $.inArray(parseInt(t), comparedProductsIds) ? "add" : "remove", $.ajax({
        url: "baseUri?controller=products-comparison&ajax=1&action=" + e + "&id_product=" + t,
        async: !0,
        cache: !1,
        success: function(o) {
            "add" === e && comparedProductsIds.length < comparator_max_item ? (comparedProductsIds.push(parseInt(t)), compareButtonsStatusRefresh(), n = i + 1, $(".bt_compare").next(".compare_product_count").val(n), totalValue(n)) : "remove" === e ? (comparedProductsIds.splice($.inArray(parseInt(t), comparedProductsIds), 1), compareButtonsStatusRefresh(), n = i - 1, $(".bt_compare").next(".compare_product_count").val(n), totalValue(n)) : $.prototype.fancybox ? $.fancybox.open([{
                type: "inline",
                autoScale: !0,
                minHeight: 30,
                content: '<p class="fancybox-error">' + max_item + "</p>"
            }], {
                padding: 0
            }) : alert(max_item), totalCompareButtons()
        },
        error: function() {}
    })
}

function reloadProductComparison() {
    $(document).on("click", "a.cmp_remove", function(t) {
        t.preventDefault();
        var e = parseInt($(this).data("id-product"));
        $.ajax({
            url: baseUri + "?controller=products-comparison&ajax=1&action=remove&id_product=" + e,
            async: !1,
            cache: !1
        }), $("td.product-" + e).fadeOut(600);
        var n = get("compare_product_list"),
            i = n,
            o = [];
        n = decodeURIComponent(n).split("|");
        for (var a in n) parseInt(n[a]) != e && o.push(n[a]);
        o.length && (window.location.search = window.location.search.replace(i, o.join(encodeURIComponent("|"))))
    })
}

function compareButtonsStatusRefresh() {
    $(".add_to_compare").each(function() {
        -1 !== $.inArray(parseInt($(this).data("id-product")), comparedProductsIds) ? $(this).addClass("checked") : $(this).removeClass("checked")
    })
}

function totalCompareButtons() {
    var t = parseInt($(".bt_compare .total-compare-val").html());
    "number" != typeof t || 0 === t ? $(".bt_compare").attr("disabled", !0) : $(".bt_compare").attr("disabled", !1)
}

function totalValue(t) {
    $(".bt_compare").find(".total-compare-val").html(t)
}

function get(t) {
    var e = "[\\?&]" + t + "=([^&#]*)",
        n = new RegExp(e),
        i = n.exec(window.location.search);
    return null == i ? "" : i[1]
}

function HoverWatcher(t) {
    this.hovering = !1;
    var e = this;
    this.isHoveringOver = function() {
        return e.hovering
    }, $(t).hover(function() {
        e.hovering = !0
    }, function() {
        e.hovering = !1
    })
}

function crossselling_serialScroll() {
    $.prototype.bxSlider && $("#blockcart_caroucel").bxSlider({
        minSlides: 2,
        maxSlides: 4,
        slideWidth: 178,
        slideMargin: 20,
        moveSlides: 1,
        infiniteLoop: !1,
        hideControlOnEnd: !0,
        pager: !1
    })
}

function openBranch(t, e) {
    t.addClass("OPEN").removeClass("CLOSE"), e ? t.parent().find("ul:first").show() : t.parent().find("ul:first").slideDown()
}

function closeBranch(t, e) {
    t.addClass("CLOSE").removeClass("OPEN"), e ? t.parent().find("ul:first").hide() : t.parent().find("ul:first").slideUp()
}

function toggleBranch(t, e) {
    t.hasClass("OPEN") ? closeBranch(t, e) : openBranch(t, e)
}

function WishlistCart(t, e, n, i, o, a) {
    $.ajax({
        type: "GET",
        url: baseDir + "modules/blockwishlist/cart.php?rand=" + (new Date).getTime(),
        headers: {
            "cache-control": "no-cache"
        },
        async: !0,
        cache: !1,
        data: "action=" + e + "&id_product=" + n + "&quantity=" + o + "&token=" + static_token + "&id_product_attribute=" + i + "&id_wishlist=" + a,
        success: function(i) {
            "add" == e && (1 == isLogged ? (wishlistProductsIdsAdd(n), wishlistRefreshStatus(), $.prototype.fancybox ? $.fancybox.open([{
                type: "inline",
                autoScale: !0,
                minHeight: 30,
                content: '<p class="fancybox-error">' + added_to_wishlist + "</p>"
            }], {
                padding: 0
            }) : alert(added_to_wishlist)) : $.prototype.fancybox ? $.fancybox.open([{
                type: "inline",
                autoScale: !0,
                minHeight: 30,
                content: '<p class="fancybox-error">' + loggin_required + "</p>"
            }], {
                padding: 0
            }) : alert(loggin_required)), "delete" == e && (wishlistProductsIdsRemove(n), wishlistRefreshStatus()), 0 != $("#" + t).length && ($("#" + t).slideUp("normal"), document.getElementById(t).innerHTML = i, $("#" + t).slideDown("normal"))
        }
    })
}

function WishlistChangeDefault(t, e) {
    $.ajax({
        type: "GET",
        url: baseDir + "modules/blockwishlist/cart.php?rand=" + (new Date).getTime(),
        headers: {
            "cache-control": "no-cache"
        },
        async: !0,
        data: "id_wishlist=" + e + "&token=" + static_token,
        cache: !1,
        success: function(e) {
            $("#" + t).slideUp("normal"), document.getElementById(t).innerHTML = e, $("#" + t).slideDown("normal")
        }
    })
}

function WishlistBuyProduct(t, e, n, i, o, a) {
    return a ? ajaxCart.add(e, n, !1, o, 1, [t, i]) : ($("#" + i).val(0), WishlistAddProductCart(t, e, n, i), document.forms["addtocart_" + e + "_" + n].method = "POST", document.forms["addtocart_" + e + "_" + n].action = baseUri + "?controller=cart", document.forms["addtocart_" + e + "_" + n].elements.token.value = static_token, document.forms["addtocart_" + e + "_" + n].submit()), !0
}

function WishlistAddProductCart(t, e, n, i) {
    return $("#" + i).val() <= 0 ? !1 : ($.ajax({
        type: "GET",
        url: baseDir + "modules/blockwishlist/buywishlistproduct.php?rand=" + (new Date).getTime(),
        headers: {
            "cache-control": "no-cache"
        },
        data: "token=" + t + "&static_token=" + static_token + "&id_product=" + e + "&id_product_attribute=" + n,
        async: !0,
        cache: !1,
        success: function(t) {
            t ? $.prototype.fancybox ? $.fancybox.open([{
                type: "inline",
                autoScale: !0,
                minHeight: 30,
                content: '<p class="fancybox-error">' + t + "</p>"
            }], {
                padding: 0
            }) : alert(t) : $("#" + i).val($("#" + i).val() - 1)
        }
    }), !0)
}

function WishlistManage(t, e) {
    $.ajax({
        type: "GET",
        async: !0,
        url: baseDir + "modules/blockwishlist/managewishlist.php?rand=" + (new Date).getTime(),
        headers: {
            "cache-control": "no-cache"
        },
        data: "id_wishlist=" + e + "&refresh=" + !1,
        cache: !1,
        success: function(e) {
            $("#" + t).hide(), document.getElementById(t).innerHTML = e, $("#" + t).fadeIn("slow"), $(".wishlist_change_button").each(function(t) {
                $(this).popover({
                    html: !0,
                    content: function() {
                        return $(this).next(".popover-content").html()
                    }
                })
            })
        }
    })
}

function WishlistProductManage(t, e, n, i, o, a, s) {
    $.ajax({
        type: "GET",
        async: !0,
        url: baseDir + "modules/blockwishlist/managewishlist.php?rand=" + (new Date).getTime(),
        headers: {
            "cache-control": "no-cache"
        },
        data: "action=" + e + "&id_wishlist=" + n + "&id_product=" + i + "&id_product_attribute=" + o + "&quantity=" + a + "&priority=" + s + "&refresh=" + !0,
        cache: !1,
        success: function(t) {
            "delete" == e ? $("#wlp_" + i + "_" + o).fadeOut("fast") : "update" == e && ($("#wlp_" + i + "_" + o).fadeOut("fast"), $("#wlp_" + i + "_" + o).fadeIn("fast")), nb_products = 0, $("[id^='quantity']").each(function(t, e) {
                nb_products += parseInt(e.value)
            }), $("#wishlist_" + n).children("td").eq(1).html(nb_products)
        }
    })
}

function WishlistDelete(t, e, n) {
    var i = confirm(n);
    return 0 == i ? !1 : "undefined" == typeof mywishlist_url ? !1 : void $.ajax({
        type: "GET",
        async: !0,
        dataType: "json",
        url: mywishlist_url,
        headers: {
            "cache-control": "no-cache"
        },
        cache: !1,
        data: {
            rand: (new Date).getTime(),
            deleted: 1,
            myajax: 1,
            id_wishlist: e,
            action: "deletelist"
        },
        success: function(e) {
            var n = $("#" + t).siblings().length;
            if ($("#" + t).fadeOut("slow").remove(), $("#block-order-detail").html(""), 0 == n && $("#block-history").remove(), e.id_default) {
                var i = $("#wishlist_" + e.id_default + " > .wishlist_default");
                $("#wishlist_" + e.id_default + " > .wishlist_default > a").remove(), i.append('<p class="is_wish_list_default"><i class="icon icon-check-square"></i></p>')
            }
        }
    })
}

function WishlistDefault(t, e) {
    return "undefined" == typeof mywishlist_url ? !1 : void $.ajax({
        type: "GET",
        async: !0,
        url: mywishlist_url,
        headers: {
            "cache-control": "no-cache"
        },
        cache: !1,
        data: {
            rand: (new Date).getTime(),
            "default": 1,
            id_wishlist: e,
            myajax: 1,
            action: "setdefault"
        },
        success: function(e) {
            var n = $(".is_wish_list_default").parents("tr").attr("id"),
                i = $(".is_wish_list_default").parent();
            $(".is_wish_list_default").remove(), i.append('<a href="#" onclick="javascript:event.preventDefault();(WishlistDefault(\'' + n + "', '" + n.replace("wishlist_", "") + '\'));"><i class="icon icon-square"></i></a>');
            var o = $("#" + t + " > .wishlist_default");
            $("#" + t + " > .wishlist_default > a").remove(), o.append('<p class="is_wish_list_default"><i class="icon icon-check-square"></i></p>')
        }
    })
}

function WishlistVisibility(t, e) {
    $("#hide" + e).is(":hidden") ? ($("." + t).slideDown("fast"), $("#show" + e).hide(), $("#hide" + e).css("display", "block")) : ($("." + t).slideUp("fast"), $("#hide" + e).hide(), $("#show" + e).css("display", "block"))
}

function WishlistSend(t, e, n) {
    $.post(baseDir + "modules/blockwishlist/sendwishlist.php", {
        token: static_token,
        id_wishlist: e,
        email1: $("#" + n + "1").val(),
        email2: $("#" + n + "2").val(),
        email3: $("#" + n + "3").val(),
        email4: $("#" + n + "4").val(),
        email5: $("#" + n + "5").val(),
        email6: $("#" + n + "6").val(),
        email7: $("#" + n + "7").val(),
        email8: $("#" + n + "8").val(),
        email9: $("#" + n + "9").val(),
        email10: $("#" + n + "10").val()
    }, function(e) {
        e ? $.prototype.fancybox ? $.fancybox.open([{
            type: "inline",
            autoScale: !0,
            minHeight: 30,
            content: '<p class="fancybox-error">' + e + "</p>"
        }], {
            padding: 0
        }) : alert(e) : WishlistVisibility(t, "hideSendWishlist")
    })
}

function wishlistProductsIdsAdd(t) {
    -1 == $.inArray(parseInt(t), wishlistProductsIds) && wishlistProductsIds.push(parseInt(t))
}

function wishlistProductsIdsRemove(t) {
    wishlistProductsIds.splice($.inArray(parseInt(t), wishlistProductsIds), 1)
}

function wishlistRefreshStatus() {
    $(".addToWishlist").each(function() {
        -1 != $.inArray(parseInt($(this).prop("rel")), wishlistProductsIds) ? $(this).addClass("checked") : $(this).removeClass("checked")
    })
}

function wishlistProductChange(t, e, n, i) {
    if ("undefined" == typeof mywishlist_url) return !1;
    var o = $("#quantity_" + t + "_" + e).val();
    $.ajax({
        type: "GET",
        url: mywishlist_url,
        headers: {
            "cache-control": "no-cache"
        },
        async: !0,
        cache: !1,
        dataType: "json",
        data: {
            id_product: t,
            id_product_attribute: e,
            quantity: o,
            priority: $("#priority_" + t + "_" + e).val(),
            id_old_wishlist: n,
            id_new_wishlist: i,
            myajax: 1,
            action: "productchangewishlist"
        },
        success: function(a) {
            1 == a.success ? ($("#wlp_" + t + "_" + e).fadeOut("slow"), $("#wishlist_" + n + " td:nth-child(2)").text($("#wishlist_" + n + " td:nth-child(2)").text() - o), $("#wishlist_" + i + " td:nth-child(2)").text(+$("#wishlist_" + i + " td:nth-child(2)").text() + +o)) : $.prototype.fancybox && $.fancybox.open([{
                type: "inline",
                autoScale: !0,
                minHeight: 30,
                content: '<p class="fancybox-error">' + a.error + "</p>"
            }], {
                padding: 0
            })
        }
    })
}! function(t, e) {
    "object" == typeof module && "object" == typeof module.exports ? module.exports = t.document ? e(t, !0) : function(t) {
        if (!t.document) throw new Error("jQuery requires a window with a document");
        return e(t)
    } : e(t)
}("undefined" != typeof window ? window : this, function(t, e) {
    function n(t) {
        var e = t.length,
            n = at.type(t);
        return "function" === n || at.isWindow(t) ? !1 : 1 === t.nodeType && e ? !0 : "array" === n || 0 === e || "number" == typeof e && e > 0 && e - 1 in t
    }

    function i(t, e, n) {
        if (at.isFunction(e)) return at.grep(t, function(t, i) {
            return !!e.call(t, i, t) !== n
        });
        if (e.nodeType) return at.grep(t, function(t) {
            return t === e !== n
        });
        if ("string" == typeof e) {
            if (ht.test(e)) return at.filter(e, t, n);
            e = at.filter(e, t)
        }
        return at.grep(t, function(t) {
            return at.inArray(t, e) >= 0 !== n
        })
    }

    function o(t, e) {
        do t = t[e]; while (t && 1 !== t.nodeType);
        return t
    }

    function a(t) {
        var e = wt[t] = {};
        return at.each(t.match(xt) || [], function(t, n) {
            e[n] = !0
        }), e
    }

    function s() {
        mt.addEventListener ? (mt.removeEventListener("DOMContentLoaded", r, !1), t.removeEventListener("load", r, !1)) : (mt.detachEvent("onreadystatechange", r), t.detachEvent("onload", r))
    }

    function r() {
        (mt.addEventListener || "load" === event.type || "complete" === mt.readyState) && (s(), at.ready())
    }

    function l(t, e, n) {
        if (void 0 === n && 1 === t.nodeType) {
            var i = "data-" + e.replace(St, "-$1").toLowerCase();
            if (n = t.getAttribute(i), "string" == typeof n) {
                try {
                    n = "true" === n ? !0 : "false" === n ? !1 : "null" === n ? null : +n + "" === n ? +n : kt.test(n) ? at.parseJSON(n) : n
                } catch (o) {}
                at.data(t, e, n)
            } else n = void 0
        }
        return n
    }

    function c(t) {
        var e;
        for (e in t)
            if (("data" !== e || !at.isEmptyObject(t[e])) && "toJSON" !== e) return !1;
        return !0
    }

    function d(t, e, n, i) {
        if (at.acceptData(t)) {
            var o, a, s = at.expando,
                r = t.nodeType,
                l = r ? at.cache : t,
                c = r ? t[s] : t[s] && s;
            if (c && l[c] && (i || l[c].data) || void 0 !== n || "string" != typeof e) return c || (c = r ? t[s] = X.pop() || at.guid++ : s), l[c] || (l[c] = r ? {} : {
                toJSON: at.noop
            }), ("object" == typeof e || "function" == typeof e) && (i ? l[c] = at.extend(l[c], e) : l[c].data = at.extend(l[c].data, e)), a = l[c], i || (a.data || (a.data = {}), a = a.data), void 0 !== n && (a[at.camelCase(e)] = n), "string" == typeof e ? (o = a[e], null == o && (o = a[at.camelCase(e)])) : o = a, o
        }
    }

    function u(t, e, n) {
        if (at.acceptData(t)) {
            var i, o, a = t.nodeType,
                s = a ? at.cache : t,
                r = a ? t[at.expando] : at.expando;
            if (s[r]) {
                if (e && (i = n ? s[r] : s[r].data)) {
                    at.isArray(e) ? e = e.concat(at.map(e, at.camelCase)) : e in i ? e = [e] : (e = at.camelCase(e), e = e in i ? [e] : e.split(" ")), o = e.length;
                    for (; o--;) delete i[e[o]];
                    if (n ? !c(i) : !at.isEmptyObject(i)) return
                }(n || (delete s[r].data, c(s[r]))) && (a ? at.cleanData([t], !0) : it.deleteExpando || s != s.window ? delete s[r] : s[r] = null)
            }
        }
    }

    function p() {
        return !0
    }

    function h() {
        return !1
    }

    function f() {
        try {
            return mt.activeElement
        } catch (t) {}
    }

    function m(t) {
        var e = Ot.split("|"),
            n = t.createDocumentFragment();
        if (n.createElement)
            for (; e.length;) n.createElement(e.pop());
        return n
    }

    function g(t, e) {
        var n, i, o = 0,
            a = typeof t.getElementsByTagName !== $t ? t.getElementsByTagName(e || "*") : typeof t.querySelectorAll !== $t ? t.querySelectorAll(e || "*") : void 0;
        if (!a)
            for (a = [], n = t.childNodes || t; null != (i = n[o]); o++) !e || at.nodeName(i, e) ? a.push(i) : at.merge(a, g(i, e));
        return void 0 === e || e && at.nodeName(t, e) ? at.merge([t], a) : a
    }

    function v(t) {
        jt.test(t.type) && (t.defaultChecked = t.checked)
    }

    function y(t, e) {
        return at.nodeName(t, "table") && at.nodeName(11 !== e.nodeType ? e : e.firstChild, "tr") ? t.getElementsByTagName("tbody")[0] || t.appendChild(t.ownerDocument.createElement("tbody")) : t
    }

    function b(t) {
        return t.type = (null !== at.find.attr(t, "type")) + "/" + t.type, t
    }

    function x(t) {
        var e = Xt.exec(t.type);
        return e ? t.type = e[1] : t.removeAttribute("type"), t
    }

    function w(t, e) {
        for (var n, i = 0; null != (n = t[i]); i++) at._data(n, "globalEval", !e || at._data(e[i], "globalEval"))
    }

    function _(t, e) {
        if (1 === e.nodeType && at.hasData(t)) {
            var n, i, o, a = at._data(t),
                s = at._data(e, a),
                r = a.events;
            if (r) {
                delete s.handle, s.events = {};
                for (n in r)
                    for (i = 0, o = r[n].length; o > i; i++) at.event.add(e, n, r[n][i])
            }
            s.data && (s.data = at.extend({}, s.data))
        }
    }

    function C(t, e) {
        var n, i, o;
        if (1 === e.nodeType) {
            if (n = e.nodeName.toLowerCase(), !it.noCloneEvent && e[at.expando]) {
                o = at._data(e);
                for (i in o.events) at.removeEvent(e, i, o.handle);
                e.removeAttribute(at.expando)
            }
            "script" === n && e.text !== t.text ? (b(e).text = t.text, x(e)) : "object" === n ? (e.parentNode && (e.outerHTML = t.outerHTML), it.html5Clone && t.innerHTML && !at.trim(e.innerHTML) && (e.innerHTML = t.innerHTML)) : "input" === n && jt.test(t.type) ? (e.defaultChecked = e.checked = t.checked, e.value !== t.value && (e.value = t.value)) : "option" === n ? e.defaultSelected = e.selected = t.defaultSelected : ("input" === n || "textarea" === n) && (e.defaultValue = t.defaultValue)
        }
    }

    function $(e, n) {
        var i = at(n.createElement(e)).appendTo(n.body),
            o = t.getDefaultComputedStyle ? t.getDefaultComputedStyle(i[0]).display : at.css(i[0], "display");
        return i.detach(), o
    }

    function k(t) {
        var e = mt,
            n = te[t];
        return n || (n = $(t, e), "none" !== n && n || (Zt = (Zt || at("<iframe frameborder='0' width='0' height='0'/>")).appendTo(e.documentElement), e = (Zt[0].contentWindow || Zt[0].contentDocument).document, e.write(), e.close(), n = $(t, e), Zt.detach()), te[t] = n), n
    }

    function S(t, e) {
        return {
            get: function() {
                var n = t();
                return null != n ? n ? void delete this.get : (this.get = e).apply(this, arguments) : void 0
            }
        }
    }

    function T(t, e) {
        if (e in t) return e;
        for (var n = e.charAt(0).toUpperCase() + e.slice(1), i = e, o = he.length; o--;)
            if (e = he[o] + n, e in t) return e;
        return i
    }

    function E(t, e) {
        for (var n, i, o, a = [], s = 0, r = t.length; r > s; s++) i = t[s], i.style && (a[s] = at._data(i, "olddisplay"), n = i.style.display, e ? (a[s] || "none" !== n || (i.style.display = ""), "" === i.style.display && Dt(i) && (a[s] = at._data(i, "olddisplay", k(i.nodeName)))) : a[s] || (o = Dt(i), (n && "none" !== n || !o) && at._data(i, "olddisplay", o ? n : at.css(i, "display"))));
        for (s = 0; r > s; s++) i = t[s], i.style && (e && "none" !== i.style.display && "" !== i.style.display || (i.style.display = e ? a[s] || "" : "none"));
        return t
    }

    function D(t, e, n) {
        var i = ce.exec(e);
        return i ? Math.max(0, i[1] - (n || 0)) + (i[2] || "px") : e
    }

    function A(t, e, n, i, o) {
        for (var a = n === (i ? "border" : "content") ? 4 : "width" === e ? 1 : 0, s = 0; 4 > a; a += 2) "margin" === n && (s += at.css(t, n + Et[a], !0, o)), i ? ("content" === n && (s -= at.css(t, "padding" + Et[a], !0, o)), "margin" !== n && (s -= at.css(t, "border" + Et[a] + "Width", !0, o))) : (s += at.css(t, "padding" + Et[a], !0, o), "padding" !== n && (s += at.css(t, "border" + Et[a] + "Width", !0, o)));
        return s
    }

    function j(t, e, n) {
        var i = !0,
            o = "width" === e ? t.offsetWidth : t.offsetHeight,
            a = ee(t),
            s = it.boxSizing() && "border-box" === at.css(t, "boxSizing", !1, a);
        if (0 >= o || null == o) {
            if (o = ne(t, e, a), (0 > o || null == o) && (o = t.style[e]), oe.test(o)) return o;
            i = s && (it.boxSizingReliable() || o === t.style[e]), o = parseFloat(o) || 0
        }
        return o + A(t, e, n || (s ? "border" : "content"), i, a) + "px"
    }

    function I(t, e, n, i, o) {
        return new I.prototype.init(t, e, n, i, o)
    }

    function M() {
        return setTimeout(function() {
            fe = void 0
        }), fe = at.now()
    }

    function N(t, e) {
        var n, i = {
                height: t
            },
            o = 0;
        for (e = e ? 1 : 0; 4 > o; o += 2 - e) n = Et[o], i["margin" + n] = i["padding" + n] = t;
        return e && (i.opacity = i.width = t), i
    }

    function L(t, e, n) {
        for (var i, o = (xe[e] || []).concat(xe["*"]), a = 0, s = o.length; s > a; a++)
            if (i = o[a].call(n, e, t)) return i
    }

    function P(t, e, n) {
        var i, o, a, s, r, l, c, d, u = this,
            p = {},
            h = t.style,
            f = t.nodeType && Dt(t),
            m = at._data(t, "fxshow");
        n.queue || (r = at._queueHooks(t, "fx"), null == r.unqueued && (r.unqueued = 0, l = r.empty.fire, r.empty.fire = function() {
            r.unqueued || l()
        }), r.unqueued++, u.always(function() {
            u.always(function() {
                r.unqueued--, at.queue(t, "fx").length || r.empty.fire()
            })
        })), 1 === t.nodeType && ("height" in e || "width" in e) && (n.overflow = [h.overflow, h.overflowX, h.overflowY], c = at.css(t, "display"), d = k(t.nodeName), "none" === c && (c = d), "inline" === c && "none" === at.css(t, "float") && (it.inlineBlockNeedsLayout && "inline" !== d ? h.zoom = 1 : h.display = "inline-block")), n.overflow && (h.overflow = "hidden", it.shrinkWrapBlocks() || u.always(function() {
            h.overflow = n.overflow[0], h.overflowX = n.overflow[1], h.overflowY = n.overflow[2]
        }));
        for (i in e)
            if (o = e[i], ge.exec(o)) {
                if (delete e[i], a = a || "toggle" === o, o === (f ? "hide" : "show")) {
                    if ("show" !== o || !m || void 0 === m[i]) continue;
                    f = !0
                }
                p[i] = m && m[i] || at.style(t, i)
            }
        if (!at.isEmptyObject(p)) {
            m ? "hidden" in m && (f = m.hidden) : m = at._data(t, "fxshow", {}), a && (m.hidden = !f), f ? at(t).show() : u.done(function() {
                at(t).hide()
            }), u.done(function() {
                var e;
                at._removeData(t, "fxshow");
                for (e in p) at.style(t, e, p[e])
            });
            for (i in p) s = L(f ? m[i] : 0, i, u), i in m || (m[i] = s.start, f && (s.end = s.start, s.start = "width" === i || "height" === i ? 1 : 0))
        }
    }

    function O(t, e) {
        var n, i, o, a, s;
        for (n in t)
            if (i = at.camelCase(n), o = e[i], a = t[n], at.isArray(a) && (o = a[1], a = t[n] = a[0]), n !== i && (t[i] = a, delete t[n]), s = at.cssHooks[i], s && "expand" in s) {
                a = s.expand(a), delete t[i];
                for (n in a) n in t || (t[n] = a[n], e[n] = o)
            } else e[i] = o
    }

    function H(t, e, n) {
        var i, o, a = 0,
            s = be.length,
            r = at.Deferred().always(function() {
                delete l.elem
            }),
            l = function() {
                if (o) return !1;
                for (var e = fe || M(), n = Math.max(0, c.startTime + c.duration - e), i = n / c.duration || 0, a = 1 - i, s = 0, l = c.tweens.length; l > s; s++) c.tweens[s].run(a);
                return r.notifyWith(t, [c, a, n]), 1 > a && l ? n : (r.resolveWith(t, [c]), !1)
            },
            c = r.promise({
                elem: t,
                props: at.extend({}, e),
                opts: at.extend(!0, {
                    specialEasing: {}
                }, n),
                originalProperties: e,
                originalOptions: n,
                startTime: fe || M(),
                duration: n.duration,
                tweens: [],
                createTween: function(e, n) {
                    var i = at.Tween(t, c.opts, e, n, c.opts.specialEasing[e] || c.opts.easing);
                    return c.tweens.push(i), i
                },
                stop: function(e) {
                    var n = 0,
                        i = e ? c.tweens.length : 0;
                    if (o) return this;
                    for (o = !0; i > n; n++) c.tweens[n].run(1);
                    return e ? r.resolveWith(t, [c, e]) : r.rejectWith(t, [c, e]), this
                }
            }),
            d = c.props;
        for (O(d, c.opts.specialEasing); s > a; a++)
            if (i = be[a].call(c, t, d, c.opts)) return i;
        return at.map(d, L, c), at.isFunction(c.opts.start) && c.opts.start.call(t, c), at.fx.timer(at.extend(l, {
            elem: t,
            anim: c,
            queue: c.opts.queue
        })), c.progress(c.opts.progress).done(c.opts.done, c.opts.complete).fail(c.opts.fail).always(c.opts.always)
    }

    function F(t) {
        return function(e, n) {
            "string" != typeof e && (n = e, e = "*");
            var i, o = 0,
                a = e.toLowerCase().match(xt) || [];
            if (at.isFunction(n))
                for (; i = a[o++];) "+" === i.charAt(0) ? (i = i.slice(1) || "*", (t[i] = t[i] || []).unshift(n)) : (t[i] = t[i] || []).push(n)
        }
    }

    function z(t, e, n, i) {
        function o(r) {
            var l;
            return a[r] = !0, at.each(t[r] || [], function(t, r) {
                var c = r(e, n, i);
                return "string" != typeof c || s || a[c] ? s ? !(l = c) : void 0 : (e.dataTypes.unshift(c), o(c), !1)
            }), l
        }
        var a = {},
            s = t === Be;
        return o(e.dataTypes[0]) || !a["*"] && o("*")
    }

    function q(t, e) {
        var n, i, o = at.ajaxSettings.flatOptions || {};
        for (i in e) void 0 !== e[i] && ((o[i] ? t : n || (n = {}))[i] = e[i]);
        return n && at.extend(!0, t, n), t
    }

    function R(t, e, n) {
        for (var i, o, a, s, r = t.contents, l = t.dataTypes;
            "*" === l[0];) l.shift(), void 0 === o && (o = t.mimeType || e.getResponseHeader("Content-Type"));
        if (o)
            for (s in r)
                if (r[s] && r[s].test(o)) {
                    l.unshift(s);
                    break
                }
        if (l[0] in n) a = l[0];
        else {
            for (s in n) {
                if (!l[0] || t.converters[s + " " + l[0]]) {
                    a = s;
                    break
                }
                i || (i = s)
            }
            a = a || i
        }
        return a ? (a !== l[0] && l.unshift(a), n[a]) : void 0
    }

    function W(t, e, n, i) {
        var o, a, s, r, l, c = {},
            d = t.dataTypes.slice();
        if (d[1])
            for (s in t.converters) c[s.toLowerCase()] = t.converters[s];
        for (a = d.shift(); a;)
            if (t.responseFields[a] && (n[t.responseFields[a]] = e), !l && i && t.dataFilter && (e = t.dataFilter(e, t.dataType)), l = a, a = d.shift())
                if ("*" === a) a = l;
                else if ("*" !== l && l !== a) {
            if (s = c[l + " " + a] || c["* " + a], !s)
                for (o in c)
                    if (r = o.split(" "), r[1] === a && (s = c[l + " " + r[0]] || c["* " + r[0]])) {
                        s === !0 ? s = c[o] : c[o] !== !0 && (a = r[0], d.unshift(r[1]));
                        break
                    }
            if (s !== !0)
                if (s && t["throws"]) e = s(e);
                else try {
                    e = s(e)
                } catch (u) {
                    return {
                        state: "parsererror",
                        error: s ? u : "No conversion from " + l + " to " + a
                    }
                }
        }
        return {
            state: "success",
            data: e
        }
    }

    function B(t, e, n, i) {
        var o;
        if (at.isArray(e)) at.each(e, function(e, o) {
            n || Xe.test(t) ? i(t, o) : B(t + "[" + ("object" == typeof o ? e : "") + "]", o, n, i)
        });
        else if (n || "object" !== at.type(e)) i(t, e);
        else
            for (o in e) B(t + "[" + o + "]", e[o], n, i)
    }

    function U() {
        try {
            return new t.XMLHttpRequest
        } catch (e) {}
    }

    function Q() {
        try {
            return new t.ActiveXObject("Microsoft.XMLHTTP")
        } catch (e) {}
    }

    function V(t) {
        return at.isWindow(t) ? t : 9 === t.nodeType ? t.defaultView || t.parentWindow : !1
    }
    var X = [],
        J = X.slice,
        G = X.concat,
        Y = X.push,
        K = X.indexOf,
        Z = {},
        tt = Z.toString,
        et = Z.hasOwnProperty,
        nt = "".trim,
        it = {},
        ot = "1.11.0",
        at = function(t, e) {
            return new at.fn.init(t, e)
        },
        st = /^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g,
        rt = /^-ms-/,
        lt = /-([\da-z])/gi,
        ct = function(t, e) {
            return e.toUpperCase()
        };
    at.fn = at.prototype = {
        jquery: ot,
        constructor: at,
        selector: "",
        length: 0,
        toArray: function() {
            return J.call(this)
        },
        get: function(t) {
            return null != t ? 0 > t ? this[t + this.length] : this[t] : J.call(this)
        },
        pushStack: function(t) {
            var e = at.merge(this.constructor(), t);
            return e.prevObject = this, e.context = this.context, e
        },
        each: function(t, e) {
            return at.each(this, t, e)
        },
        map: function(t) {
            return this.pushStack(at.map(this, function(e, n) {
                return t.call(e, n, e)
            }))
        },
        slice: function() {
            return this.pushStack(J.apply(this, arguments))
        },
        first: function() {
            return this.eq(0)
        },
        last: function() {
            return this.eq(-1)
        },
        eq: function(t) {
            var e = this.length,
                n = +t + (0 > t ? e : 0);
            return this.pushStack(n >= 0 && e > n ? [this[n]] : [])
        },
        end: function() {
            return this.prevObject || this.constructor(null)
        },
        push: Y,
        sort: X.sort,
        splice: X.splice
    }, at.extend = at.fn.extend = function() {
        var t, e, n, i, o, a, s = arguments[0] || {},
            r = 1,
            l = arguments.length,
            c = !1;
        for ("boolean" == typeof s && (c = s, s = arguments[r] || {}, r++), "object" == typeof s || at.isFunction(s) || (s = {}), r === l && (s = this, r--); l > r; r++)
            if (null != (o = arguments[r]))
                for (i in o) t = s[i], n = o[i], s !== n && (c && n && (at.isPlainObject(n) || (e = at.isArray(n))) ? (e ? (e = !1, a = t && at.isArray(t) ? t : []) : a = t && at.isPlainObject(t) ? t : {}, s[i] = at.extend(c, a, n)) : void 0 !== n && (s[i] = n));
        return s
    }, at.extend({
        expando: "jQuery" + (ot + Math.random()).replace(/\D/g, ""),
        isReady: !0,
        error: function(t) {
            throw new Error(t)
        },
        noop: function() {},
        isFunction: function(t) {
            return "function" === at.type(t)
        },
        isArray: Array.isArray || function(t) {
            return "array" === at.type(t)
        },
        isWindow: function(t) {
            return null != t && t == t.window
        },
        isNumeric: function(t) {
            return t - parseFloat(t) >= 0
        },
        isEmptyObject: function(t) {
            var e;
            for (e in t) return !1;
            return !0
        },
        isPlainObject: function(t) {
            var e;
            if (!t || "object" !== at.type(t) || t.nodeType || at.isWindow(t)) return !1;
            try {
                if (t.constructor && !et.call(t, "constructor") && !et.call(t.constructor.prototype, "isPrototypeOf")) return !1
            } catch (n) {
                return !1
            }
            if (it.ownLast)
                for (e in t) return et.call(t, e);
            for (e in t);
            return void 0 === e || et.call(t, e)
        },
        type: function(t) {
            return null == t ? t + "" : "object" == typeof t || "function" == typeof t ? Z[tt.call(t)] || "object" : typeof t
        },
        globalEval: function(e) {
            e && at.trim(e) && (t.execScript || function(e) {
                t.eval.call(t, e)
            })(e)
        },
        camelCase: function(t) {
            return t.replace(rt, "ms-").replace(lt, ct)
        },
        nodeName: function(t, e) {
            return t.nodeName && t.nodeName.toLowerCase() === e.toLowerCase()
        },
        each: function(t, e, i) {
            var o, a = 0,
                s = t.length,
                r = n(t);
            if (i) {
                if (r)
                    for (; s > a && (o = e.apply(t[a], i), o !== !1); a++);
                else
                    for (a in t)
                        if (o = e.apply(t[a], i), o === !1) break
            } else if (r)
                for (; s > a && (o = e.call(t[a], a, t[a]), o !== !1); a++);
            else
                for (a in t)
                    if (o = e.call(t[a], a, t[a]), o === !1) break; return t
        },
        trim: nt && !nt.call("\ufeff ") ? function(t) {
            return null == t ? "" : nt.call(t)
        } : function(t) {
            return null == t ? "" : (t + "").replace(st, "")
        },
        makeArray: function(t, e) {
            var i = e || [];
            return null != t && (n(Object(t)) ? at.merge(i, "string" == typeof t ? [t] : t) : Y.call(i, t)), i
        },
        inArray: function(t, e, n) {
            var i;
            if (e) {
                if (K) return K.call(e, t, n);
                for (i = e.length, n = n ? 0 > n ? Math.max(0, i + n) : n : 0; i > n; n++)
                    if (n in e && e[n] === t) return n
            }
            return -1
        },
        merge: function(t, e) {
            for (var n = +e.length, i = 0, o = t.length; n > i;) t[o++] = e[i++];
            if (n !== n)
                for (; void 0 !== e[i];) t[o++] = e[i++];
            return t.length = o, t
        },
        grep: function(t, e, n) {
            for (var i, o = [], a = 0, s = t.length, r = !n; s > a; a++) i = !e(t[a], a), i !== r && o.push(t[a]);
            return o
        },
        map: function(t, e, i) {
            var o, a = 0,
                s = t.length,
                r = n(t),
                l = [];
            if (r)
                for (; s > a; a++) o = e(t[a], a, i), null != o && l.push(o);
            else
                for (a in t) o = e(t[a], a, i), null != o && l.push(o);
            return G.apply([], l)
        },
        guid: 1,
        proxy: function(t, e) {
            var n, i, o;
            return "string" == typeof e && (o = t[e], e = t, t = o), at.isFunction(t) ? (n = J.call(arguments, 2), i = function() {
                return t.apply(e || this, n.concat(J.call(arguments)))
            }, i.guid = t.guid = t.guid || at.guid++, i) : void 0
        },
        now: function() {
            return +new Date
        },
        support: it
    }), at.each("Boolean Number String Function Array Date RegExp Object Error".split(" "), function(t, e) {
        Z["[object " + e + "]"] = e.toLowerCase()
    });
    var dt = function(t) {
        function e(t, e, n, i) {
            var o, a, s, r, l, c, u, f, m, g;
            if ((e ? e.ownerDocument || e : z) !== I && j(e), e = e || I, n = n || [], !t || "string" != typeof t) return n;
            if (1 !== (r = e.nodeType) && 9 !== r) return [];
            if (N && !i) {
                if (o = yt.exec(t))
                    if (s = o[1]) {
                        if (9 === r) {
                            if (a = e.getElementById(s), !a || !a.parentNode) return n;
                            if (a.id === s) return n.push(a), n
                        } else if (e.ownerDocument && (a = e.ownerDocument.getElementById(s)) && H(e, a) && a.id === s) return n.push(a), n
                    } else {
                        if (o[2]) return Z.apply(n, e.getElementsByTagName(t)), n;
                        if ((s = o[3]) && C.getElementsByClassName && e.getElementsByClassName) return Z.apply(n, e.getElementsByClassName(s)), n
                    }
                if (C.qsa && (!L || !L.test(t))) {
                    if (f = u = F, m = e, g = 9 === r && t, 1 === r && "object" !== e.nodeName.toLowerCase()) {
                        for (c = p(t), (u = e.getAttribute("id")) ? f = u.replace(xt, "\\$&") : e.setAttribute("id", f), f = "[id='" + f + "'] ", l = c.length; l--;) c[l] = f + h(c[l]);
                        m = bt.test(t) && d(e.parentNode) || e, g = c.join(",")
                    }
                    if (g) try {
                        return Z.apply(n, m.querySelectorAll(g)), n
                    } catch (v) {} finally {
                        u || e.removeAttribute("id")
                    }
                }
            }
            return w(t.replace(lt, "$1"), e, n, i)
        }

        function n() {
            function t(n, i) {
                return e.push(n + " ") > $.cacheLength && delete t[e.shift()], t[n + " "] = i
            }
            var e = [];
            return t
        }

        function i(t) {
            return t[F] = !0, t
        }

        function o(t) {
            var e = I.createElement("div");
            try {
                return !!t(e)
            } catch (n) {
                return !1
            } finally {
                e.parentNode && e.parentNode.removeChild(e), e = null
            }
        }

        function a(t, e) {
            for (var n = t.split("|"), i = t.length; i--;) $.attrHandle[n[i]] = e
        }

        function s(t, e) {
            var n = e && t,
                i = n && 1 === t.nodeType && 1 === e.nodeType && (~e.sourceIndex || X) - (~t.sourceIndex || X);
            if (i) return i;
            if (n)
                for (; n = n.nextSibling;)
                    if (n === e) return -1;
            return t ? 1 : -1
        }

        function r(t) {
            return function(e) {
                var n = e.nodeName.toLowerCase();
                return "input" === n && e.type === t
            }
        }

        function l(t) {
            return function(e) {
                var n = e.nodeName.toLowerCase();
                return ("input" === n || "button" === n) && e.type === t
            }
        }

        function c(t) {
            return i(function(e) {
                return e = +e, i(function(n, i) {
                    for (var o, a = t([], n.length, e), s = a.length; s--;) n[o = a[s]] && (n[o] = !(i[o] = n[o]))
                })
            })
        }

        function d(t) {
            return t && typeof t.getElementsByTagName !== V && t
        }

        function u() {}

        function p(t, n) {
            var i, o, a, s, r, l, c, d = B[t + " "];
            if (d) return n ? 0 : d.slice(0);
            for (r = t, l = [], c = $.preFilter; r;) {
                (!i || (o = ct.exec(r))) && (o && (r = r.slice(o[0].length) || r), l.push(a = [])), i = !1, (o = dt.exec(r)) && (i = o.shift(), a.push({
                    value: i,
                    type: o[0].replace(lt, " ")
                }), r = r.slice(i.length));
                for (s in $.filter) !(o = ft[s].exec(r)) || c[s] && !(o = c[s](o)) || (i = o.shift(), a.push({
                    value: i,
                    type: s,
                    matches: o
                }), r = r.slice(i.length));
                if (!i) break
            }
            return n ? r.length : r ? e.error(t) : B(t, l).slice(0)
        }

        function h(t) {
            for (var e = 0, n = t.length, i = ""; n > e; e++) i += t[e].value;
            return i
        }

        function f(t, e, n) {
            var i = e.dir,
                o = n && "parentNode" === i,
                a = R++;
            return e.first ? function(e, n, a) {
                for (; e = e[i];)
                    if (1 === e.nodeType || o) return t(e, n, a)
            } : function(e, n, s) {
                var r, l, c = [q, a];
                if (s) {
                    for (; e = e[i];)
                        if ((1 === e.nodeType || o) && t(e, n, s)) return !0
                } else
                    for (; e = e[i];)
                        if (1 === e.nodeType || o) {
                            if (l = e[F] || (e[F] = {}), (r = l[i]) && r[0] === q && r[1] === a) return c[2] = r[2];
                            if (l[i] = c, c[2] = t(e, n, s)) return !0
                        }
            }
        }

        function m(t) {
            return t.length > 1 ? function(e, n, i) {
                for (var o = t.length; o--;)
                    if (!t[o](e, n, i)) return !1;
                return !0
            } : t[0]
        }

        function g(t, e, n, i, o) {
            for (var a, s = [], r = 0, l = t.length, c = null != e; l > r; r++)(a = t[r]) && (!n || n(a, i, o)) && (s.push(a), c && e.push(r));
            return s
        }

        function v(t, e, n, o, a, s) {
            return o && !o[F] && (o = v(o)), a && !a[F] && (a = v(a, s)), i(function(i, s, r, l) {
                var c, d, u, p = [],
                    h = [],
                    f = s.length,
                    m = i || x(e || "*", r.nodeType ? [r] : r, []),
                    v = !t || !i && e ? m : g(m, p, t, r, l),
                    y = n ? a || (i ? t : f || o) ? [] : s : v;
                if (n && n(v, y, r, l), o)
                    for (c = g(y, h), o(c, [], r, l), d = c.length; d--;)(u = c[d]) && (y[h[d]] = !(v[h[d]] = u));
                if (i) {
                    if (a || t) {
                        if (a) {
                            for (c = [], d = y.length; d--;)(u = y[d]) && c.push(v[d] = u);
                            a(null, y = [], c, l)
                        }
                        for (d = y.length; d--;)(u = y[d]) && (c = a ? et.call(i, u) : p[d]) > -1 && (i[c] = !(s[c] = u))
                    }
                } else y = g(y === s ? y.splice(f, y.length) : y), a ? a(null, s, y, l) : Z.apply(s, y)
            })
        }

        function y(t) {
            for (var e, n, i, o = t.length, a = $.relative[t[0].type], s = a || $.relative[" "], r = a ? 1 : 0, l = f(function(t) {
                    return t === e
                }, s, !0), c = f(function(t) {
                    return et.call(e, t) > -1
                }, s, !0), d = [function(t, n, i) {
                    return !a && (i || n !== E) || ((e = n).nodeType ? l(t, n, i) : c(t, n, i))
                }]; o > r; r++)
                if (n = $.relative[t[r].type]) d = [f(m(d), n)];
                else {
                    if (n = $.filter[t[r].type].apply(null, t[r].matches), n[F]) {
                        for (i = ++r; o > i && !$.relative[t[i].type]; i++);
                        return v(r > 1 && m(d), r > 1 && h(t.slice(0, r - 1).concat({
                            value: " " === t[r - 2].type ? "*" : ""
                        })).replace(lt, "$1"), n, i > r && y(t.slice(r, i)), o > i && y(t = t.slice(i)), o > i && h(t))
                    }
                    d.push(n)
                }
            return m(d)
        }

        function b(t, n) {
            var o = n.length > 0,
                a = t.length > 0,
                s = function(i, s, r, l, c) {
                    var d, u, p, h = 0,
                        f = "0",
                        m = i && [],
                        v = [],
                        y = E,
                        b = i || a && $.find.TAG("*", c),
                        x = q += null == y ? 1 : Math.random() || .1,
                        w = b.length;
                    for (c && (E = s !== I && s); f !== w && null != (d = b[f]); f++) {
                        if (a && d) {
                            for (u = 0; p = t[u++];)
                                if (p(d, s, r)) {
                                    l.push(d);
                                    break
                                }
                            c && (q = x)
                        }
                        o && ((d = !p && d) && h--, i && m.push(d))
                    }
                    if (h += f, o && f !== h) {
                        for (u = 0; p = n[u++];) p(m, v, s, r);
                        if (i) {
                            if (h > 0)
                                for (; f--;) m[f] || v[f] || (v[f] = Y.call(l));
                            v = g(v)
                        }
                        Z.apply(l, v), c && !i && v.length > 0 && h + n.length > 1 && e.uniqueSort(l)
                    }
                    return c && (q = x, E = y), m
                };
            return o ? i(s) : s
        }

        function x(t, n, i) {
            for (var o = 0, a = n.length; a > o; o++) e(t, n[o], i);
            return i
        }

        function w(t, e, n, i) {
            var o, a, s, r, l, c = p(t);
            if (!i && 1 === c.length) {
                if (a = c[0] = c[0].slice(0), a.length > 2 && "ID" === (s = a[0]).type && C.getById && 9 === e.nodeType && N && $.relative[a[1].type]) {
                    if (e = ($.find.ID(s.matches[0].replace(wt, _t), e) || [])[0], !e) return n;
                    t = t.slice(a.shift().value.length)
                }
                for (o = ft.needsContext.test(t) ? 0 : a.length; o-- && (s = a[o], !$.relative[r = s.type]);)
                    if ((l = $.find[r]) && (i = l(s.matches[0].replace(wt, _t), bt.test(a[0].type) && d(e.parentNode) || e))) {
                        if (a.splice(o, 1), t = i.length && h(a), !t) return Z.apply(n, i), n;
                        break
                    }
            }
            return T(t, c)(i, e, !N, n, bt.test(t) && d(e.parentNode) || e), n
        }
        var _, C, $, k, S, T, E, D, A, j, I, M, N, L, P, O, H, F = "sizzle" + -new Date,
            z = t.document,
            q = 0,
            R = 0,
            W = n(),
            B = n(),
            U = n(),
            Q = function(t, e) {
                return t === e && (A = !0), 0
            },
            V = "undefined",
            X = 1 << 31,
            J = {}.hasOwnProperty,
            G = [],
            Y = G.pop,
            K = G.push,
            Z = G.push,
            tt = G.slice,
            et = G.indexOf || function(t) {
                for (var e = 0, n = this.length; n > e; e++)
                    if (this[e] === t) return e;
                return -1
            },
            nt = "checked|selected|async|autofocus|autoplay|controls|defer|disabled|hidden|ismap|loop|multiple|open|readonly|required|scoped",
            it = "[\\x20\\t\\r\\n\\f]",
            ot = "(?:\\\\.|[\\w-]|[^\\x00-\\xa0])+",
            at = ot.replace("w", "w#"),
            st = "\\[" + it + "*(" + ot + ")" + it + "*(?:([*^$|!~]?=)" + it + "*(?:(['\"])((?:\\\\.|[^\\\\])*?)\\3|(" + at + ")|)|)" + it + "*\\]",
            rt = ":(" + ot + ")(?:\\(((['\"])((?:\\\\.|[^\\\\])*?)\\3|((?:\\\\.|[^\\\\()[\\]]|" + st.replace(3, 8) + ")*)|.*)\\)|)",
            lt = new RegExp("^" + it + "+|((?:^|[^\\\\])(?:\\\\.)*)" + it + "+$", "g"),
            ct = new RegExp("^" + it + "*," + it + "*"),
            dt = new RegExp("^" + it + "*([>+~]|" + it + ")" + it + "*"),
            ut = new RegExp("=" + it + "*([^\\]'\"]*?)" + it + "*\\]", "g"),
            pt = new RegExp(rt),
            ht = new RegExp("^" + at + "$"),
            ft = {
                ID: new RegExp("^#(" + ot + ")"),
                CLASS: new RegExp("^\\.(" + ot + ")"),
                TAG: new RegExp("^(" + ot.replace("w", "w*") + ")"),
                ATTR: new RegExp("^" + st),
                PSEUDO: new RegExp("^" + rt),
                CHILD: new RegExp("^:(only|first|last|nth|nth-last)-(child|of-type)(?:\\(" + it + "*(even|odd|(([+-]|)(\\d*)n|)" + it + "*(?:([+-]|)" + it + "*(\\d+)|))" + it + "*\\)|)", "i"),
                bool: new RegExp("^(?:" + nt + ")$", "i"),
                needsContext: new RegExp("^" + it + "*[>+~]|:(even|odd|eq|gt|lt|nth|first|last)(?:\\(" + it + "*((?:-\\d)?\\d*)" + it + "*\\)|)(?=[^-]|$)", "i")
            },
            mt = /^(?:input|select|textarea|button)$/i,
            gt = /^h\d$/i,
            vt = /^[^{]+\{\s*\[native \w/,
            yt = /^(?:#([\w-]+)|(\w+)|\.([\w-]+))$/,
            bt = /[+~]/,
            xt = /'|\\/g,
            wt = new RegExp("\\\\([\\da-f]{1,6}" + it + "?|(" + it + ")|.)", "ig"),
            _t = function(t, e, n) {
                var i = "0x" + e - 65536;
                return i !== i || n ? e : 0 > i ? String.fromCharCode(i + 65536) : String.fromCharCode(i >> 10 | 55296, 1023 & i | 56320)
            };
        try {
            Z.apply(G = tt.call(z.childNodes), z.childNodes), G[z.childNodes.length].nodeType
        } catch (Ct) {
            Z = {
                apply: G.length ? function(t, e) {
                    K.apply(t, tt.call(e))
                } : function(t, e) {
                    for (var n = t.length, i = 0; t[n++] = e[i++];);
                    t.length = n - 1
                }
            }
        }
        C = e.support = {}, S = e.isXML = function(t) {
            var e = t && (t.ownerDocument || t).documentElement;
            return e ? "HTML" !== e.nodeName : !1
        }, j = e.setDocument = function(t) {
            var e, n = t ? t.ownerDocument || t : z,
                i = n.defaultView;
            return n !== I && 9 === n.nodeType && n.documentElement ? (I = n, M = n.documentElement, N = !S(n), i && i !== i.top && (i.addEventListener ? i.addEventListener("unload", function() {
                j()
            }, !1) : i.attachEvent && i.attachEvent("onunload", function() {
                j()
            })), C.attributes = o(function(t) {
                return t.className = "i", !t.getAttribute("className")
            }), C.getElementsByTagName = o(function(t) {
                return t.appendChild(n.createComment("")), !t.getElementsByTagName("*").length
            }), C.getElementsByClassName = vt.test(n.getElementsByClassName) && o(function(t) {
                return t.innerHTML = "<div class='a'></div><div class='a i'></div>", t.firstChild.className = "i", 2 === t.getElementsByClassName("i").length
            }), C.getById = o(function(t) {
                return M.appendChild(t).id = F, !n.getElementsByName || !n.getElementsByName(F).length
            }), C.getById ? ($.find.ID = function(t, e) {
                if (typeof e.getElementById !== V && N) {
                    var n = e.getElementById(t);
                    return n && n.parentNode ? [n] : []
                }
            }, $.filter.ID = function(t) {
                var e = t.replace(wt, _t);
                return function(t) {
                    return t.getAttribute("id") === e
                }
            }) : (delete $.find.ID, $.filter.ID = function(t) {
                var e = t.replace(wt, _t);
                return function(t) {
                    var n = typeof t.getAttributeNode !== V && t.getAttributeNode("id");
                    return n && n.value === e
                }
            }), $.find.TAG = C.getElementsByTagName ? function(t, e) {
                return typeof e.getElementsByTagName !== V ? e.getElementsByTagName(t) : void 0
            } : function(t, e) {
                var n, i = [],
                    o = 0,
                    a = e.getElementsByTagName(t);
                if ("*" === t) {
                    for (; n = a[o++];) 1 === n.nodeType && i.push(n);
                    return i
                }
                return a
            }, $.find.CLASS = C.getElementsByClassName && function(t, e) {
                return typeof e.getElementsByClassName !== V && N ? e.getElementsByClassName(t) : void 0
            }, P = [], L = [], (C.qsa = vt.test(n.querySelectorAll)) && (o(function(t) {
                t.innerHTML = "<select t=''><option selected=''></option></select>", t.querySelectorAll("[t^='']").length && L.push("[*^$]=" + it + "*(?:''|\"\")"), t.querySelectorAll("[selected]").length || L.push("\\[" + it + "*(?:value|" + nt + ")"), t.querySelectorAll(":checked").length || L.push(":checked")
            }), o(function(t) {
                var e = n.createElement("input");
                e.setAttribute("type", "hidden"), t.appendChild(e).setAttribute("name", "D"), t.querySelectorAll("[name=d]").length && L.push("name" + it + "*[*^$|!~]?="), t.querySelectorAll(":enabled").length || L.push(":enabled", ":disabled"), t.querySelectorAll("*,:x"), L.push(",.*:")
            })), (C.matchesSelector = vt.test(O = M.webkitMatchesSelector || M.mozMatchesSelector || M.oMatchesSelector || M.msMatchesSelector)) && o(function(t) {
                C.disconnectedMatch = O.call(t, "div"), O.call(t, "[s!='']:x"), P.push("!=", rt)
            }), L = L.length && new RegExp(L.join("|")), P = P.length && new RegExp(P.join("|")), e = vt.test(M.compareDocumentPosition), H = e || vt.test(M.contains) ? function(t, e) {
                var n = 9 === t.nodeType ? t.documentElement : t,
                    i = e && e.parentNode;
                return t === i || !(!i || 1 !== i.nodeType || !(n.contains ? n.contains(i) : t.compareDocumentPosition && 16 & t.compareDocumentPosition(i)))
            } : function(t, e) {
                if (e)
                    for (; e = e.parentNode;)
                        if (e === t) return !0;
                return !1
            }, Q = e ? function(t, e) {
                if (t === e) return A = !0, 0;
                var i = !t.compareDocumentPosition - !e.compareDocumentPosition;
                return i ? i : (i = (t.ownerDocument || t) === (e.ownerDocument || e) ? t.compareDocumentPosition(e) : 1, 1 & i || !C.sortDetached && e.compareDocumentPosition(t) === i ? t === n || t.ownerDocument === z && H(z, t) ? -1 : e === n || e.ownerDocument === z && H(z, e) ? 1 : D ? et.call(D, t) - et.call(D, e) : 0 : 4 & i ? -1 : 1)
            } : function(t, e) {
                if (t === e) return A = !0, 0;
                var i, o = 0,
                    a = t.parentNode,
                    r = e.parentNode,
                    l = [t],
                    c = [e];
                if (!a || !r) return t === n ? -1 : e === n ? 1 : a ? -1 : r ? 1 : D ? et.call(D, t) - et.call(D, e) : 0;
                if (a === r) return s(t, e);
                for (i = t; i = i.parentNode;) l.unshift(i);
                for (i = e; i = i.parentNode;) c.unshift(i);
                for (; l[o] === c[o];) o++;
                return o ? s(l[o], c[o]) : l[o] === z ? -1 : c[o] === z ? 1 : 0
            }, n) : I
        }, e.matches = function(t, n) {
            return e(t, null, null, n)
        }, e.matchesSelector = function(t, n) {
            if ((t.ownerDocument || t) !== I && j(t), n = n.replace(ut, "='$1']"), !(!C.matchesSelector || !N || P && P.test(n) || L && L.test(n))) try {
                var i = O.call(t, n);
                if (i || C.disconnectedMatch || t.document && 11 !== t.document.nodeType) return i
            } catch (o) {}
            return e(n, I, null, [t]).length > 0
        }, e.contains = function(t, e) {
            return (t.ownerDocument || t) !== I && j(t), H(t, e)
        }, e.attr = function(t, e) {
            (t.ownerDocument || t) !== I && j(t);
            var n = $.attrHandle[e.toLowerCase()],
                i = n && J.call($.attrHandle, e.toLowerCase()) ? n(t, e, !N) : void 0;
            return void 0 !== i ? i : C.attributes || !N ? t.getAttribute(e) : (i = t.getAttributeNode(e)) && i.specified ? i.value : null
        }, e.error = function(t) {
            throw new Error("Syntax error, unrecognized expression: " + t)
        }, e.uniqueSort = function(t) {
            var e, n = [],
                i = 0,
                o = 0;
            if (A = !C.detectDuplicates, D = !C.sortStable && t.slice(0), t.sort(Q), A) {
                for (; e = t[o++];) e === t[o] && (i = n.push(o));
                for (; i--;) t.splice(n[i], 1)
            }
            return D = null, t
        }, k = e.getText = function(t) {
            var e, n = "",
                i = 0,
                o = t.nodeType;
            if (o) {
                if (1 === o || 9 === o || 11 === o) {
                    if ("string" == typeof t.textContent) return t.textContent;
                    for (t = t.firstChild; t; t = t.nextSibling) n += k(t)
                } else if (3 === o || 4 === o) return t.nodeValue
            } else
                for (; e = t[i++];) n += k(e);
            return n
        }, $ = e.selectors = {
            cacheLength: 50,
            createPseudo: i,
            match: ft,
            attrHandle: {},
            find: {},
            relative: {
                ">": {
                    dir: "parentNode",
                    first: !0
                },
                " ": {
                    dir: "parentNode"
                },
                "+": {
                    dir: "previousSibling",
                    first: !0
                },
                "~": {
                    dir: "previousSibling"
                }
            },
            preFilter: {
                ATTR: function(t) {
                    return t[1] = t[1].replace(wt, _t), t[3] = (t[4] || t[5] || "").replace(wt, _t), "~=" === t[2] && (t[3] = " " + t[3] + " "), t.slice(0, 4)
                },
                CHILD: function(t) {
                    return t[1] = t[1].toLowerCase(), "nth" === t[1].slice(0, 3) ? (t[3] || e.error(t[0]), t[4] = +(t[4] ? t[5] + (t[6] || 1) : 2 * ("even" === t[3] || "odd" === t[3])), t[5] = +(t[7] + t[8] || "odd" === t[3])) : t[3] && e.error(t[0]), t
                },
                PSEUDO: function(t) {
                    var e, n = !t[5] && t[2];
                    return ft.CHILD.test(t[0]) ? null : (t[3] && void 0 !== t[4] ? t[2] = t[4] : n && pt.test(n) && (e = p(n, !0)) && (e = n.indexOf(")", n.length - e) - n.length) && (t[0] = t[0].slice(0, e), t[2] = n.slice(0, e)), t.slice(0, 3))
                }
            },
            filter: {
                TAG: function(t) {
                    var e = t.replace(wt, _t).toLowerCase();
                    return "*" === t ? function() {
                        return !0
                    } : function(t) {
                        return t.nodeName && t.nodeName.toLowerCase() === e
                    }
                },
                CLASS: function(t) {
                    var e = W[t + " "];
                    return e || (e = new RegExp("(^|" + it + ")" + t + "(" + it + "|$)")) && W(t, function(t) {
                        return e.test("string" == typeof t.className && t.className || typeof t.getAttribute !== V && t.getAttribute("class") || "")
                    })
                },
                ATTR: function(t, n, i) {
                    return function(o) {
                        var a = e.attr(o, t);
                        return null == a ? "!=" === n : n ? (a += "", "=" === n ? a === i : "!=" === n ? a !== i : "^=" === n ? i && 0 === a.indexOf(i) : "*=" === n ? i && a.indexOf(i) > -1 : "$=" === n ? i && a.slice(-i.length) === i : "~=" === n ? (" " + a + " ").indexOf(i) > -1 : "|=" === n ? a === i || a.slice(0, i.length + 1) === i + "-" : !1) : !0
                    }
                },
                CHILD: function(t, e, n, i, o) {
                    var a = "nth" !== t.slice(0, 3),
                        s = "last" !== t.slice(-4),
                        r = "of-type" === e;
                    return 1 === i && 0 === o ? function(t) {
                        return !!t.parentNode
                    } : function(e, n, l) {
                        var c, d, u, p, h, f, m = a !== s ? "nextSibling" : "previousSibling",
                            g = e.parentNode,
                            v = r && e.nodeName.toLowerCase(),
                            y = !l && !r;
                        if (g) {
                            if (a) {
                                for (; m;) {
                                    for (u = e; u = u[m];)
                                        if (r ? u.nodeName.toLowerCase() === v : 1 === u.nodeType) return !1;
                                    f = m = "only" === t && !f && "nextSibling"
                                }
                                return !0
                            }
                            if (f = [s ? g.firstChild : g.lastChild], s && y) {
                                for (d = g[F] || (g[F] = {}), c = d[t] || [], h = c[0] === q && c[1], p = c[0] === q && c[2], u = h && g.childNodes[h]; u = ++h && u && u[m] || (p = h = 0) || f.pop();)
                                    if (1 === u.nodeType && ++p && u === e) {
                                        d[t] = [q, h, p];
                                        break
                                    }
                            } else if (y && (c = (e[F] || (e[F] = {}))[t]) && c[0] === q) p = c[1];
                            else
                                for (;
                                    (u = ++h && u && u[m] || (p = h = 0) || f.pop()) && ((r ? u.nodeName.toLowerCase() !== v : 1 !== u.nodeType) || !++p || (y && ((u[F] || (u[F] = {}))[t] = [q, p]), u !== e)););
                            return p -= o, p === i || p % i === 0 && p / i >= 0
                        }
                    }
                },
                PSEUDO: function(t, n) {
                    var o, a = $.pseudos[t] || $.setFilters[t.toLowerCase()] || e.error("unsupported pseudo: " + t);
                    return a[F] ? a(n) : a.length > 1 ? (o = [t, t, "", n], $.setFilters.hasOwnProperty(t.toLowerCase()) ? i(function(t, e) {
                        for (var i, o = a(t, n), s = o.length; s--;) i = et.call(t, o[s]), t[i] = !(e[i] = o[s])
                    }) : function(t) {
                        return a(t, 0, o)
                    }) : a
                }
            },
            pseudos: {
                not: i(function(t) {
                    var e = [],
                        n = [],
                        o = T(t.replace(lt, "$1"));
                    return o[F] ? i(function(t, e, n, i) {
                        for (var a, s = o(t, null, i, []), r = t.length; r--;)(a = s[r]) && (t[r] = !(e[r] = a))
                    }) : function(t, i, a) {
                        return e[0] = t, o(e, null, a, n), !n.pop()
                    }
                }),
                has: i(function(t) {
                    return function(n) {
                        return e(t, n).length > 0
                    }
                }),
                contains: i(function(t) {
                    return function(e) {
                        return (e.textContent || e.innerText || k(e)).indexOf(t) > -1
                    }
                }),
                lang: i(function(t) {
                    return ht.test(t || "") || e.error("unsupported lang: " + t), t = t.replace(wt, _t).toLowerCase(),
                        function(e) {
                            var n;
                            do
                                if (n = N ? e.lang : e.getAttribute("xml:lang") || e.getAttribute("lang")) return n = n.toLowerCase(), n === t || 0 === n.indexOf(t + "-");
                            while ((e = e.parentNode) && 1 === e.nodeType);
                            return !1
                        }
                }),
                target: function(e) {
                    var n = t.location && t.location.hash;
                    return n && n.slice(1) === e.id
                },
                root: function(t) {
                    return t === M
                },
                focus: function(t) {
                    return t === I.activeElement && (!I.hasFocus || I.hasFocus()) && !!(t.type || t.href || ~t.tabIndex)
                },
                enabled: function(t) {
                    return t.disabled === !1
                },
                disabled: function(t) {
                    return t.disabled === !0
                },
                checked: function(t) {
                    var e = t.nodeName.toLowerCase();
                    return "input" === e && !!t.checked || "option" === e && !!t.selected
                },
                selected: function(t) {
                    return t.parentNode && t.parentNode.selectedIndex, t.selected === !0
                },
                empty: function(t) {
                    for (t = t.firstChild; t; t = t.nextSibling)
                        if (t.nodeType < 6) return !1;
                    return !0
                },
                parent: function(t) {
                    return !$.pseudos.empty(t)
                },
                header: function(t) {
                    return gt.test(t.nodeName)
                },
                input: function(t) {
                    return mt.test(t.nodeName)
                },
                button: function(t) {
                    var e = t.nodeName.toLowerCase();
                    return "input" === e && "button" === t.type || "button" === e
                },
                text: function(t) {
                    var e;
                    return "input" === t.nodeName.toLowerCase() && "text" === t.type && (null == (e = t.getAttribute("type")) || "text" === e.toLowerCase())
                },
                first: c(function() {
                    return [0]
                }),
                last: c(function(t, e) {
                    return [e - 1]
                }),
                eq: c(function(t, e, n) {
                    return [0 > n ? n + e : n]
                }),
                even: c(function(t, e) {
                    for (var n = 0; e > n; n += 2) t.push(n);
                    return t
                }),
                odd: c(function(t, e) {
                    for (var n = 1; e > n; n += 2) t.push(n);
                    return t
                }),
                lt: c(function(t, e, n) {
                    for (var i = 0 > n ? n + e : n; --i >= 0;) t.push(i);
                    return t
                }),
                gt: c(function(t, e, n) {
                    for (var i = 0 > n ? n + e : n; ++i < e;) t.push(i);
                    return t
                })
            }
        }, $.pseudos.nth = $.pseudos.eq;
        for (_ in {
                radio: !0,
                checkbox: !0,
                file: !0,
                password: !0,
                image: !0
            }) $.pseudos[_] = r(_);
        for (_ in {
                submit: !0,
                reset: !0
            }) $.pseudos[_] = l(_);
        return u.prototype = $.filters = $.pseudos, $.setFilters = new u, T = e.compile = function(t, e) {
            var n, i = [],
                o = [],
                a = U[t + " "];
            if (!a) {
                for (e || (e = p(t)), n = e.length; n--;) a = y(e[n]), a[F] ? i.push(a) : o.push(a);
                a = U(t, b(o, i))
            }
            return a
        }, C.sortStable = F.split("").sort(Q).join("") === F, C.detectDuplicates = !!A, j(), C.sortDetached = o(function(t) {
            return 1 & t.compareDocumentPosition(I.createElement("div"))
        }), o(function(t) {
            return t.innerHTML = "<a href='#'></a>", "#" === t.firstChild.getAttribute("href")
        }) || a("type|href|height|width", function(t, e, n) {
            return n ? void 0 : t.getAttribute(e, "type" === e.toLowerCase() ? 1 : 2)
        }), C.attributes && o(function(t) {
            return t.innerHTML = "<input/>", t.firstChild.setAttribute("value", ""), "" === t.firstChild.getAttribute("value")
        }) || a("value", function(t, e, n) {
            return n || "input" !== t.nodeName.toLowerCase() ? void 0 : t.defaultValue
        }), o(function(t) {
            return null == t.getAttribute("disabled")
        }) || a(nt, function(t, e, n) {
            var i;
            return n ? void 0 : t[e] === !0 ? e.toLowerCase() : (i = t.getAttributeNode(e)) && i.specified ? i.value : null
        }), e
    }(t);
    at.find = dt, at.expr = dt.selectors, at.expr[":"] = at.expr.pseudos, at.unique = dt.uniqueSort, at.text = dt.getText, at.isXMLDoc = dt.isXML, at.contains = dt.contains;
    var ut = at.expr.match.needsContext,
        pt = /^<(\w+)\s*\/?>(?:<\/\1>|)$/,
        ht = /^.[^:#\[\.,]*$/;
    at.filter = function(t, e, n) {
        var i = e[0];
        return n && (t = ":not(" + t + ")"), 1 === e.length && 1 === i.nodeType ? at.find.matchesSelector(i, t) ? [i] : [] : at.find.matches(t, at.grep(e, function(t) {
            return 1 === t.nodeType
        }))
    }, at.fn.extend({
        find: function(t) {
            var e, n = [],
                i = this,
                o = i.length;
            if ("string" != typeof t) return this.pushStack(at(t).filter(function() {
                for (e = 0; o > e; e++)
                    if (at.contains(i[e], this)) return !0
            }));
            for (e = 0; o > e; e++) at.find(t, i[e], n);
            return n = this.pushStack(o > 1 ? at.unique(n) : n), n.selector = this.selector ? this.selector + " " + t : t, n
        },
        filter: function(t) {
            return this.pushStack(i(this, t || [], !1))
        },
        not: function(t) {
            return this.pushStack(i(this, t || [], !0))
        },
        is: function(t) {
            return !!i(this, "string" == typeof t && ut.test(t) ? at(t) : t || [], !1).length
        }
    });
    var ft, mt = t.document,
        gt = /^(?:\s*(<[\w\W]+>)[^>]*|#([\w-]*))$/,
        vt = at.fn.init = function(t, e) {
            var n, i;
            if (!t) return this;
            if ("string" == typeof t) {
                if (n = "<" === t.charAt(0) && ">" === t.charAt(t.length - 1) && t.length >= 3 ? [null, t, null] : gt.exec(t), !n || !n[1] && e) return !e || e.jquery ? (e || ft).find(t) : this.constructor(e).find(t);
                if (n[1]) {
                    if (e = e instanceof at ? e[0] : e, at.merge(this, at.parseHTML(n[1], e && e.nodeType ? e.ownerDocument || e : mt, !0)), pt.test(n[1]) && at.isPlainObject(e))
                        for (n in e) at.isFunction(this[n]) ? this[n](e[n]) : this.attr(n, e[n]);
                    return this
                }
                if (i = mt.getElementById(n[2]), i && i.parentNode) {
                    if (i.id !== n[2]) return ft.find(t);
                    this.length = 1, this[0] = i
                }
                return this.context = mt, this.selector = t, this
            }
            return t.nodeType ? (this.context = this[0] = t, this.length = 1, this) : at.isFunction(t) ? "undefined" != typeof ft.ready ? ft.ready(t) : t(at) : (void 0 !== t.selector && (this.selector = t.selector, this.context = t.context), at.makeArray(t, this))
        };
    vt.prototype = at.fn, ft = at(mt);
    var yt = /^(?:parents|prev(?:Until|All))/,
        bt = {
            children: !0,
            contents: !0,
            next: !0,
            prev: !0
        };
    at.extend({
        dir: function(t, e, n) {
            for (var i = [], o = t[e]; o && 9 !== o.nodeType && (void 0 === n || 1 !== o.nodeType || !at(o).is(n));) 1 === o.nodeType && i.push(o), o = o[e];
            return i
        },
        sibling: function(t, e) {
            for (var n = []; t; t = t.nextSibling) 1 === t.nodeType && t !== e && n.push(t);
            return n
        }
    }), at.fn.extend({
        has: function(t) {
            var e, n = at(t, this),
                i = n.length;
            return this.filter(function() {
                for (e = 0; i > e; e++)
                    if (at.contains(this, n[e])) return !0
            })
        },
        closest: function(t, e) {
            for (var n, i = 0, o = this.length, a = [], s = ut.test(t) || "string" != typeof t ? at(t, e || this.context) : 0; o > i; i++)
                for (n = this[i]; n && n !== e; n = n.parentNode)
                    if (n.nodeType < 11 && (s ? s.index(n) > -1 : 1 === n.nodeType && at.find.matchesSelector(n, t))) {
                        a.push(n);
                        break
                    }
            return this.pushStack(a.length > 1 ? at.unique(a) : a)
        },
        index: function(t) {
            return t ? "string" == typeof t ? at.inArray(this[0], at(t)) : at.inArray(t.jquery ? t[0] : t, this) : this[0] && this[0].parentNode ? this.first().prevAll().length : -1
        },
        add: function(t, e) {
            return this.pushStack(at.unique(at.merge(this.get(), at(t, e))))
        },
        addBack: function(t) {
            return this.add(null == t ? this.prevObject : this.prevObject.filter(t))
        }
    }), at.each({
        parent: function(t) {
            var e = t.parentNode;
            return e && 11 !== e.nodeType ? e : null
        },
        parents: function(t) {
            return at.dir(t, "parentNode")
        },
        parentsUntil: function(t, e, n) {
            return at.dir(t, "parentNode", n)
        },
        next: function(t) {
            return o(t, "nextSibling")
        },
        prev: function(t) {
            return o(t, "previousSibling")
        },
        nextAll: function(t) {
            return at.dir(t, "nextSibling")
        },
        prevAll: function(t) {
            return at.dir(t, "previousSibling")
        },
        nextUntil: function(t, e, n) {
            return at.dir(t, "nextSibling", n)
        },
        prevUntil: function(t, e, n) {
            return at.dir(t, "previousSibling", n)
        },
        siblings: function(t) {
            return at.sibling((t.parentNode || {}).firstChild, t)
        },
        children: function(t) {
            return at.sibling(t.firstChild)
        },
        contents: function(t) {
            return at.nodeName(t, "iframe") ? t.contentDocument || t.contentWindow.document : at.merge([], t.childNodes)
        }
    }, function(t, e) {
        at.fn[t] = function(n, i) {
            var o = at.map(this, e, n);
            return "Until" !== t.slice(-5) && (i = n), i && "string" == typeof i && (o = at.filter(i, o)), this.length > 1 && (bt[t] || (o = at.unique(o)), yt.test(t) && (o = o.reverse())), this.pushStack(o)
        }
    });
    var xt = /\S+/g,
        wt = {};
    at.Callbacks = function(t) {
        t = "string" == typeof t ? wt[t] || a(t) : at.extend({}, t);
        var e, n, i, o, s, r, l = [],
            c = !t.once && [],
            d = function(a) {
                for (n = t.memory && a, i = !0, s = r || 0, r = 0, o = l.length, e = !0; l && o > s; s++)
                    if (l[s].apply(a[0], a[1]) === !1 && t.stopOnFalse) {
                        n = !1;
                        break
                    }
                e = !1, l && (c ? c.length && d(c.shift()) : n ? l = [] : u.disable())
            },
            u = {
                add: function() {
                    if (l) {
                        var i = l.length;
                        ! function a(e) {
                            at.each(e, function(e, n) {
                                var i = at.type(n);
                                "function" === i ? t.unique && u.has(n) || l.push(n) : n && n.length && "string" !== i && a(n)
                            })
                        }(arguments), e ? o = l.length : n && (r = i, d(n))
                    }
                    return this
                },
                remove: function() {
                    return l && at.each(arguments, function(t, n) {
                        for (var i;
                            (i = at.inArray(n, l, i)) > -1;) l.splice(i, 1), e && (o >= i && o--, s >= i && s--)
                    }), this
                },
                has: function(t) {
                    return t ? at.inArray(t, l) > -1 : !(!l || !l.length)
                },
                empty: function() {
                    return l = [], o = 0, this
                },
                disable: function() {
                    return l = c = n = void 0, this
                },
                disabled: function() {
                    return !l
                },
                lock: function() {
                    return c = void 0, n || u.disable(), this
                },
                locked: function() {
                    return !c
                },
                fireWith: function(t, n) {
                    return !l || i && !c || (n = n || [], n = [t, n.slice ? n.slice() : n], e ? c.push(n) : d(n)), this
                },
                fire: function() {
                    return u.fireWith(this, arguments), this
                },
                fired: function() {
                    return !!i
                }
            };
        return u
    }, at.extend({
        Deferred: function(t) {
            var e = [
                    ["resolve", "done", at.Callbacks("once memory"), "resolved"],
                    ["reject", "fail", at.Callbacks("once memory"), "rejected"],
                    ["notify", "progress", at.Callbacks("memory")]
                ],
                n = "pending",
                i = {
                    state: function() {
                        return n
                    },
                    always: function() {
                        return o.done(arguments).fail(arguments), this
                    },
                    then: function() {
                        var t = arguments;
                        return at.Deferred(function(n) {
                            at.each(e, function(e, a) {
                                var s = at.isFunction(t[e]) && t[e];
                                o[a[1]](function() {
                                    var t = s && s.apply(this, arguments);
                                    t && at.isFunction(t.promise) ? t.promise().done(n.resolve).fail(n.reject).progress(n.notify) : n[a[0] + "With"](this === i ? n.promise() : this, s ? [t] : arguments)
                                })
                            }), t = null
                        }).promise()
                    },
                    promise: function(t) {
                        return null != t ? at.extend(t, i) : i
                    }
                },
                o = {};
            return i.pipe = i.then, at.each(e, function(t, a) {
                var s = a[2],
                    r = a[3];
                i[a[1]] = s.add, r && s.add(function() {
                    n = r
                }, e[1 ^ t][2].disable, e[2][2].lock), o[a[0]] = function() {
                    return o[a[0] + "With"](this === o ? i : this, arguments), this
                }, o[a[0] + "With"] = s.fireWith
            }), i.promise(o), t && t.call(o, o), o
        },
        when: function(t) {
            var e, n, i, o = 0,
                a = J.call(arguments),
                s = a.length,
                r = 1 !== s || t && at.isFunction(t.promise) ? s : 0,
                l = 1 === r ? t : at.Deferred(),
                c = function(t, n, i) {
                    return function(o) {
                        n[t] = this, i[t] = arguments.length > 1 ? J.call(arguments) : o, i === e ? l.notifyWith(n, i) : --r || l.resolveWith(n, i)
                    }
                };
            if (s > 1)
                for (e = new Array(s), n = new Array(s), i = new Array(s); s > o; o++) a[o] && at.isFunction(a[o].promise) ? a[o].promise().done(c(o, i, a)).fail(l.reject).progress(c(o, n, e)) : --r;
            return r || l.resolveWith(i, a), l.promise()
        }
    });
    var _t;
    at.fn.ready = function(t) {
        return at.ready.promise().done(t), this
    }, at.extend({
        isReady: !1,
        readyWait: 1,
        holdReady: function(t) {
            t ? at.readyWait++ : at.ready(!0)
        },
        ready: function(t) {
            if (t === !0 ? !--at.readyWait : !at.isReady) {
                if (!mt.body) return setTimeout(at.ready);
                at.isReady = !0, t !== !0 && --at.readyWait > 0 || (_t.resolveWith(mt, [at]), at.fn.trigger && at(mt).trigger("ready").off("ready"))
            }
        }
    }), at.ready.promise = function(e) {
        if (!_t)
            if (_t = at.Deferred(), "complete" === mt.readyState) setTimeout(at.ready);
            else if (mt.addEventListener) mt.addEventListener("DOMContentLoaded", r, !1), t.addEventListener("load", r, !1);
        else {
            mt.attachEvent("onreadystatechange", r), t.attachEvent("onload", r);
            var n = !1;
            try {
                n = null == t.frameElement && mt.documentElement
            } catch (i) {}
            n && n.doScroll && ! function o() {
                if (!at.isReady) {
                    try {
                        n.doScroll("left")
                    } catch (t) {
                        return setTimeout(o, 50)
                    }
                    s(), at.ready()
                }
            }()
        }
        return _t.promise(e)
    };
    var Ct, $t = "undefined";
    for (Ct in at(it)) break;
    it.ownLast = "0" !== Ct, it.inlineBlockNeedsLayout = !1, at(function() {
            var t, e, n = mt.getElementsByTagName("body")[0];
            n && (t = mt.createElement("div"), t.style.cssText = "border:0;width:0;height:0;position:absolute;top:0;left:-9999px;margin-top:1px", e = mt.createElement("div"), n.appendChild(t).appendChild(e), typeof e.style.zoom !== $t && (e.style.cssText = "border:0;margin:0;width:1px;padding:1px;display:inline;zoom:1", (it.inlineBlockNeedsLayout = 3 === e.offsetWidth) && (n.style.zoom = 1)), n.removeChild(t), t = e = null)
        }),
        function() {
            var t = mt.createElement("div");
            if (null == it.deleteExpando) {
                it.deleteExpando = !0;
                try {
                    delete t.test
                } catch (e) {
                    it.deleteExpando = !1
                }
            }
            t = null
        }(), at.acceptData = function(t) {
            var e = at.noData[(t.nodeName + " ").toLowerCase()],
                n = +t.nodeType || 1;
            return 1 !== n && 9 !== n ? !1 : !e || e !== !0 && t.getAttribute("classid") === e
        };
    var kt = /^(?:\{[\w\W]*\}|\[[\w\W]*\])$/,
        St = /([A-Z])/g;
    at.extend({
        cache: {},
        noData: {
            "applet ": !0,
            "embed ": !0,
            "object ": "clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
        },
        hasData: function(t) {
            return t = t.nodeType ? at.cache[t[at.expando]] : t[at.expando], !!t && !c(t)
        },
        data: function(t, e, n) {
            return d(t, e, n)
        },
        removeData: function(t, e) {
            return u(t, e)
        },
        _data: function(t, e, n) {
            return d(t, e, n, !0)
        },
        _removeData: function(t, e) {
            return u(t, e, !0)
        }
    }), at.fn.extend({
        data: function(t, e) {
            var n, i, o, a = this[0],
                s = a && a.attributes;
            if (void 0 === t) {
                if (this.length && (o = at.data(a), 1 === a.nodeType && !at._data(a, "parsedAttrs"))) {
                    for (n = s.length; n--;) i = s[n].name, 0 === i.indexOf("data-") && (i = at.camelCase(i.slice(5)), l(a, i, o[i]));
                    at._data(a, "parsedAttrs", !0)
                }
                return o
            }
            return "object" == typeof t ? this.each(function() {
                at.data(this, t)
            }) : arguments.length > 1 ? this.each(function() {
                at.data(this, t, e)
            }) : a ? l(a, t, at.data(a, t)) : void 0
        },
        removeData: function(t) {
            return this.each(function() {
                at.removeData(this, t)
            })
        }
    }), at.extend({
        queue: function(t, e, n) {
            var i;
            return t ? (e = (e || "fx") + "queue", i = at._data(t, e), n && (!i || at.isArray(n) ? i = at._data(t, e, at.makeArray(n)) : i.push(n)), i || []) : void 0
        },
        dequeue: function(t, e) {
            e = e || "fx";
            var n = at.queue(t, e),
                i = n.length,
                o = n.shift(),
                a = at._queueHooks(t, e),
                s = function() {
                    at.dequeue(t, e)
                };
            "inprogress" === o && (o = n.shift(), i--), o && ("fx" === e && n.unshift("inprogress"), delete a.stop, o.call(t, s, a)), !i && a && a.empty.fire()
        },
        _queueHooks: function(t, e) {
            var n = e + "queueHooks";
            return at._data(t, n) || at._data(t, n, {
                empty: at.Callbacks("once memory").add(function() {
                    at._removeData(t, e + "queue"), at._removeData(t, n)
                })
            })
        }
    }), at.fn.extend({
        queue: function(t, e) {
            var n = 2;
            return "string" != typeof t && (e = t, t = "fx", n--), arguments.length < n ? at.queue(this[0], t) : void 0 === e ? this : this.each(function() {
                var n = at.queue(this, t, e);
                at._queueHooks(this, t), "fx" === t && "inprogress" !== n[0] && at.dequeue(this, t)
            })
        },
        dequeue: function(t) {
            return this.each(function() {
                at.dequeue(this, t)
            })
        },
        clearQueue: function(t) {
            return this.queue(t || "fx", [])
        },
        promise: function(t, e) {
            var n, i = 1,
                o = at.Deferred(),
                a = this,
                s = this.length,
                r = function() {
                    --i || o.resolveWith(a, [a])
                };
            for ("string" != typeof t && (e = t, t = void 0), t = t || "fx"; s--;) n = at._data(a[s], t + "queueHooks"), n && n.empty && (i++, n.empty.add(r));
            return r(), o.promise(e)
        }
    });
    var Tt = /[+-]?(?:\d*\.|)\d+(?:[eE][+-]?\d+|)/.source,
        Et = ["Top", "Right", "Bottom", "Left"],
        Dt = function(t, e) {
            return t = e || t, "none" === at.css(t, "display") || !at.contains(t.ownerDocument, t)
        },
        At = at.access = function(t, e, n, i, o, a, s) {
            var r = 0,
                l = t.length,
                c = null == n;
            if ("object" === at.type(n)) {
                o = !0;
                for (r in n) at.access(t, e, r, n[r], !0, a, s)
            } else if (void 0 !== i && (o = !0, at.isFunction(i) || (s = !0), c && (s ? (e.call(t, i), e = null) : (c = e, e = function(t, e, n) {
                    return c.call(at(t), n)
                })), e))
                for (; l > r; r++) e(t[r], n, s ? i : i.call(t[r], r, e(t[r], n)));
            return o ? t : c ? e.call(t) : l ? e(t[0], n) : a
        },
        jt = /^(?:checkbox|radio)$/i;
    ! function() {
        var t = mt.createDocumentFragment(),
            e = mt.createElement("div"),
            n = mt.createElement("input");
        if (e.setAttribute("className", "t"), e.innerHTML = "  <link/><table></table><a href='/a'>a</a>", it.leadingWhitespace = 3 === e.firstChild.nodeType, it.tbody = !e.getElementsByTagName("tbody").length, it.htmlSerialize = !!e.getElementsByTagName("link").length, it.html5Clone = "<:nav></:nav>" !== mt.createElement("nav").cloneNode(!0).outerHTML, n.type = "checkbox", n.checked = !0, t.appendChild(n), it.appendChecked = n.checked, e.innerHTML = "<textarea>x</textarea>", it.noCloneChecked = !!e.cloneNode(!0).lastChild.defaultValue, t.appendChild(e), e.innerHTML = "<input type='radio' checked='checked' name='t'/>", it.checkClone = e.cloneNode(!0).cloneNode(!0).lastChild.checked, it.noCloneEvent = !0, e.attachEvent && (e.attachEvent("onclick", function() {
                it.noCloneEvent = !1
            }), e.cloneNode(!0).click()), null == it.deleteExpando) {
            it.deleteExpando = !0;
            try {
                delete e.test
            } catch (i) {
                it.deleteExpando = !1
            }
        }
        t = e = n = null
    }(),
    function() {
        var e, n, i = mt.createElement("div");
        for (e in {
                submit: !0,
                change: !0,
                focusin: !0
            }) n = "on" + e, (it[e + "Bubbles"] = n in t) || (i.setAttribute(n, "t"), it[e + "Bubbles"] = i.attributes[n].expando === !1);
        i = null
    }();
    var It = /^(?:input|select|textarea)$/i,
        Mt = /^key/,
        Nt = /^(?:mouse|contextmenu)|click/,
        Lt = /^(?:focusinfocus|focusoutblur)$/,
        Pt = /^([^.]*)(?:\.(.+)|)$/;
    at.event = {
        global: {},
        add: function(t, e, n, i, o) {
            var a, s, r, l, c, d, u, p, h, f, m, g = at._data(t);
            if (g) {
                for (n.handler && (l = n, n = l.handler, o = l.selector), n.guid || (n.guid = at.guid++), (s = g.events) || (s = g.events = {}), (d = g.handle) || (d = g.handle = function(t) {
                        return typeof at === $t || t && at.event.triggered === t.type ? void 0 : at.event.dispatch.apply(d.elem, arguments)
                    }, d.elem = t), e = (e || "").match(xt) || [""], r = e.length; r--;) a = Pt.exec(e[r]) || [], h = m = a[1], f = (a[2] || "").split(".").sort(), h && (c = at.event.special[h] || {}, h = (o ? c.delegateType : c.bindType) || h, c = at.event.special[h] || {}, u = at.extend({
                    type: h,
                    origType: m,
                    data: i,
                    handler: n,
                    guid: n.guid,
                    selector: o,
                    needsContext: o && at.expr.match.needsContext.test(o),
                    namespace: f.join(".")
                }, l), (p = s[h]) || (p = s[h] = [], p.delegateCount = 0, c.setup && c.setup.call(t, i, f, d) !== !1 || (t.addEventListener ? t.addEventListener(h, d, !1) : t.attachEvent && t.attachEvent("on" + h, d))), c.add && (c.add.call(t, u), u.handler.guid || (u.handler.guid = n.guid)), o ? p.splice(p.delegateCount++, 0, u) : p.push(u), at.event.global[h] = !0);
                t = null
            }
        },
        remove: function(t, e, n, i, o) {
            var a, s, r, l, c, d, u, p, h, f, m, g = at.hasData(t) && at._data(t);
            if (g && (d = g.events)) {
                for (e = (e || "").match(xt) || [""], c = e.length; c--;)
                    if (r = Pt.exec(e[c]) || [], h = m = r[1], f = (r[2] || "").split(".").sort(), h) {
                        for (u = at.event.special[h] || {}, h = (i ? u.delegateType : u.bindType) || h, p = d[h] || [], r = r[2] && new RegExp("(^|\\.)" + f.join("\\.(?:.*\\.|)") + "(\\.|$)"), l = a = p.length; a--;) s = p[a], !o && m !== s.origType || n && n.guid !== s.guid || r && !r.test(s.namespace) || i && i !== s.selector && ("**" !== i || !s.selector) || (p.splice(a, 1), s.selector && p.delegateCount--, u.remove && u.remove.call(t, s));
                        l && !p.length && (u.teardown && u.teardown.call(t, f, g.handle) !== !1 || at.removeEvent(t, h, g.handle), delete d[h])
                    } else
                        for (h in d) at.event.remove(t, h + e[c], n, i, !0);
                at.isEmptyObject(d) && (delete g.handle, at._removeData(t, "events"))
            }
        },
        trigger: function(e, n, i, o) {
            var a, s, r, l, c, d, u, p = [i || mt],
                h = et.call(e, "type") ? e.type : e,
                f = et.call(e, "namespace") ? e.namespace.split(".") : [];
            if (r = d = i = i || mt, 3 !== i.nodeType && 8 !== i.nodeType && !Lt.test(h + at.event.triggered) && (h.indexOf(".") >= 0 && (f = h.split("."), h = f.shift(), f.sort()), s = h.indexOf(":") < 0 && "on" + h, e = e[at.expando] ? e : new at.Event(h, "object" == typeof e && e), e.isTrigger = o ? 2 : 3, e.namespace = f.join("."), e.namespace_re = e.namespace ? new RegExp("(^|\\.)" + f.join("\\.(?:.*\\.|)") + "(\\.|$)") : null, e.result = void 0, e.target || (e.target = i), n = null == n ? [e] : at.makeArray(n, [e]), c = at.event.special[h] || {}, o || !c.trigger || c.trigger.apply(i, n) !== !1)) {
                if (!o && !c.noBubble && !at.isWindow(i)) {
                    for (l = c.delegateType || h, Lt.test(l + h) || (r = r.parentNode); r; r = r.parentNode) p.push(r), d = r;
                    d === (i.ownerDocument || mt) && p.push(d.defaultView || d.parentWindow || t)
                }
                for (u = 0;
                    (r = p[u++]) && !e.isPropagationStopped();) e.type = u > 1 ? l : c.bindType || h, a = (at._data(r, "events") || {})[e.type] && at._data(r, "handle"), a && a.apply(r, n), a = s && r[s], a && a.apply && at.acceptData(r) && (e.result = a.apply(r, n), e.result === !1 && e.preventDefault());
                if (e.type = h, !o && !e.isDefaultPrevented() && (!c._default || c._default.apply(p.pop(), n) === !1) && at.acceptData(i) && s && i[h] && !at.isWindow(i)) {
                    d = i[s], d && (i[s] = null), at.event.triggered = h;
                    try {
                        i[h]()
                    } catch (m) {}
                    at.event.triggered = void 0, d && (i[s] = d)
                }
                return e.result
            }
        },
        dispatch: function(t) {
            t = at.event.fix(t);
            var e, n, i, o, a, s = [],
                r = J.call(arguments),
                l = (at._data(this, "events") || {})[t.type] || [],
                c = at.event.special[t.type] || {};
            if (r[0] = t, t.delegateTarget = this, !c.preDispatch || c.preDispatch.call(this, t) !== !1) {
                for (s = at.event.handlers.call(this, t, l), e = 0;
                    (o = s[e++]) && !t.isPropagationStopped();)
                    for (t.currentTarget = o.elem, a = 0;
                        (i = o.handlers[a++]) && !t.isImmediatePropagationStopped();)(!t.namespace_re || t.namespace_re.test(i.namespace)) && (t.handleObj = i, t.data = i.data, n = ((at.event.special[i.origType] || {}).handle || i.handler).apply(o.elem, r), void 0 !== n && (t.result = n) === !1 && (t.preventDefault(), t.stopPropagation()));
                return c.postDispatch && c.postDispatch.call(this, t), t.result
            }
        },
        handlers: function(t, e) {
            var n, i, o, a, s = [],
                r = e.delegateCount,
                l = t.target;
            if (r && l.nodeType && (!t.button || "click" !== t.type))
                for (; l != this; l = l.parentNode || this)
                    if (1 === l.nodeType && (l.disabled !== !0 || "click" !== t.type)) {
                        for (o = [], a = 0; r > a; a++) i = e[a], n = i.selector + " ", void 0 === o[n] && (o[n] = i.needsContext ? at(n, this).index(l) >= 0 : at.find(n, this, null, [l]).length), o[n] && o.push(i);
                        o.length && s.push({
                            elem: l,
                            handlers: o
                        })
                    }
            return r < e.length && s.push({
                elem: this,
                handlers: e.slice(r)
            }), s
        },
        fix: function(t) {
            if (t[at.expando]) return t;
            var e, n, i, o = t.type,
                a = t,
                s = this.fixHooks[o];
            for (s || (this.fixHooks[o] = s = Nt.test(o) ? this.mouseHooks : Mt.test(o) ? this.keyHooks : {}), i = s.props ? this.props.concat(s.props) : this.props, t = new at.Event(a), e = i.length; e--;) n = i[e], t[n] = a[n];
            return t.target || (t.target = a.srcElement || mt), 3 === t.target.nodeType && (t.target = t.target.parentNode), t.metaKey = !!t.metaKey, s.filter ? s.filter(t, a) : t
        },
        props: "altKey bubbles cancelable ctrlKey currentTarget eventPhase metaKey relatedTarget shiftKey target timeStamp view which".split(" "),
        fixHooks: {},
        keyHooks: {
            props: "char charCode key keyCode".split(" "),
            filter: function(t, e) {
                return null == t.which && (t.which = null != e.charCode ? e.charCode : e.keyCode), t
            }
        },
        mouseHooks: {
            props: "button buttons clientX clientY fromElement offsetX offsetY pageX pageY screenX screenY toElement".split(" "),
            filter: function(t, e) {
                var n, i, o, a = e.button,
                    s = e.fromElement;
                return null == t.pageX && null != e.clientX && (i = t.target.ownerDocument || mt, o = i.documentElement, n = i.body, t.pageX = e.clientX + (o && o.scrollLeft || n && n.scrollLeft || 0) - (o && o.clientLeft || n && n.clientLeft || 0), t.pageY = e.clientY + (o && o.scrollTop || n && n.scrollTop || 0) - (o && o.clientTop || n && n.clientTop || 0)), !t.relatedTarget && s && (t.relatedTarget = s === t.target ? e.toElement : s), t.which || void 0 === a || (t.which = 1 & a ? 1 : 2 & a ? 3 : 4 & a ? 2 : 0), t
            }
        },
        special: {
            load: {
                noBubble: !0
            },
            focus: {
                trigger: function() {
                    if (this !== f() && this.focus) try {
                        return this.focus(), !1
                    } catch (t) {}
                },
                delegateType: "focusin"
            },
            blur: {
                trigger: function() {
                    return this === f() && this.blur ? (this.blur(), !1) : void 0
                },
                delegateType: "focusout"
            },
            click: {
                trigger: function() {
                    return at.nodeName(this, "input") && "checkbox" === this.type && this.click ? (this.click(), !1) : void 0
                },
                _default: function(t) {
                    return at.nodeName(t.target, "a")
                }
            },
            beforeunload: {
                postDispatch: function(t) {
                    void 0 !== t.result && (t.originalEvent.returnValue = t.result)
                }
            }
        },
        simulate: function(t, e, n, i) {
            var o = at.extend(new at.Event, n, {
                type: t,
                isSimulated: !0,
                originalEvent: {}
            });
            i ? at.event.trigger(o, null, e) : at.event.dispatch.call(e, o), o.isDefaultPrevented() && n.preventDefault()
        }
    }, at.removeEvent = mt.removeEventListener ? function(t, e, n) {
        t.removeEventListener && t.removeEventListener(e, n, !1)
    } : function(t, e, n) {
        var i = "on" + e;
        t.detachEvent && (typeof t[i] === $t && (t[i] = null), t.detachEvent(i, n))
    }, at.Event = function(t, e) {
        return this instanceof at.Event ? (t && t.type ? (this.originalEvent = t, this.type = t.type, this.isDefaultPrevented = t.defaultPrevented || void 0 === t.defaultPrevented && (t.returnValue === !1 || t.getPreventDefault && t.getPreventDefault()) ? p : h) : this.type = t, e && at.extend(this, e), this.timeStamp = t && t.timeStamp || at.now(), void(this[at.expando] = !0)) : new at.Event(t, e)
    }, at.Event.prototype = {
        isDefaultPrevented: h,
        isPropagationStopped: h,
        isImmediatePropagationStopped: h,
        preventDefault: function() {
            var t = this.originalEvent;
            this.isDefaultPrevented = p, t && (t.preventDefault ? t.preventDefault() : t.returnValue = !1)
        },
        stopPropagation: function() {
            var t = this.originalEvent;
            this.isPropagationStopped = p, t && (t.stopPropagation && t.stopPropagation(), t.cancelBubble = !0)
        },
        stopImmediatePropagation: function() {
            this.isImmediatePropagationStopped = p, this.stopPropagation()
        }
    }, at.each({
        mouseenter: "mouseover",
        mouseleave: "mouseout"
    }, function(t, e) {
        at.event.special[t] = {
            delegateType: e,
            bindType: e,
            handle: function(t) {
                var n, i = this,
                    o = t.relatedTarget,
                    a = t.handleObj;
                return (!o || o !== i && !at.contains(i, o)) && (t.type = a.origType, n = a.handler.apply(this, arguments), t.type = e), n
            }
        }
    }), it.submitBubbles || (at.event.special.submit = {
        setup: function() {
            return at.nodeName(this, "form") ? !1 : void at.event.add(this, "click._submit keypress._submit", function(t) {
                var e = t.target,
                    n = at.nodeName(e, "input") || at.nodeName(e, "button") ? e.form : void 0;
                n && !at._data(n, "submitBubbles") && (at.event.add(n, "submit._submit", function(t) {
                    t._submit_bubble = !0
                }), at._data(n, "submitBubbles", !0))
            })
        },
        postDispatch: function(t) {
            t._submit_bubble && (delete t._submit_bubble, this.parentNode && !t.isTrigger && at.event.simulate("submit", this.parentNode, t, !0))
        },
        teardown: function() {
            return at.nodeName(this, "form") ? !1 : void at.event.remove(this, "._submit")
        }
    }), it.changeBubbles || (at.event.special.change = {
        setup: function() {
            return It.test(this.nodeName) ? (("checkbox" === this.type || "radio" === this.type) && (at.event.add(this, "propertychange._change", function(t) {
                "checked" === t.originalEvent.propertyName && (this._just_changed = !0)
            }), at.event.add(this, "click._change", function(t) {
                this._just_changed && !t.isTrigger && (this._just_changed = !1), at.event.simulate("change", this, t, !0)
            })), !1) : void at.event.add(this, "beforeactivate._change", function(t) {
                var e = t.target;
                It.test(e.nodeName) && !at._data(e, "changeBubbles") && (at.event.add(e, "change._change", function(t) {
                    !this.parentNode || t.isSimulated || t.isTrigger || at.event.simulate("change", this.parentNode, t, !0)
                }), at._data(e, "changeBubbles", !0))
            })
        },
        handle: function(t) {
            var e = t.target;
            return this !== e || t.isSimulated || t.isTrigger || "radio" !== e.type && "checkbox" !== e.type ? t.handleObj.handler.apply(this, arguments) : void 0
        },
        teardown: function() {
            return at.event.remove(this, "._change"), !It.test(this.nodeName)
        }
    }), it.focusinBubbles || at.each({
        focus: "focusin",
        blur: "focusout"
    }, function(t, e) {
        var n = function(t) {
            at.event.simulate(e, t.target, at.event.fix(t), !0)
        };
        at.event.special[e] = {
            setup: function() {
                var i = this.ownerDocument || this,
                    o = at._data(i, e);
                o || i.addEventListener(t, n, !0), at._data(i, e, (o || 0) + 1)
            },
            teardown: function() {
                var i = this.ownerDocument || this,
                    o = at._data(i, e) - 1;
                o ? at._data(i, e, o) : (i.removeEventListener(t, n, !0), at._removeData(i, e))
            }
        }
    }), at.fn.extend({
        on: function(t, e, n, i, o) {
            var a, s;
            if ("object" == typeof t) {
                "string" != typeof e && (n = n || e, e = void 0);
                for (a in t) this.on(a, e, n, t[a], o);
                return this
            }
            if (null == n && null == i ? (i = e, n = e = void 0) : null == i && ("string" == typeof e ? (i = n, n = void 0) : (i = n, n = e, e = void 0)), i === !1) i = h;
            else if (!i) return this;
            return 1 === o && (s = i, i = function(t) {
                return at().off(t), s.apply(this, arguments)
            }, i.guid = s.guid || (s.guid = at.guid++)), this.each(function() {
                at.event.add(this, t, i, n, e)
            })
        },
        one: function(t, e, n, i) {
            return this.on(t, e, n, i, 1)
        },
        off: function(t, e, n) {
            var i, o;
            if (t && t.preventDefault && t.handleObj) return i = t.handleObj, at(t.delegateTarget).off(i.namespace ? i.origType + "." + i.namespace : i.origType, i.selector, i.handler), this;
            if ("object" == typeof t) {
                for (o in t) this.off(o, e, t[o]);
                return this
            }
            return (e === !1 || "function" == typeof e) && (n = e, e = void 0), n === !1 && (n = h), this.each(function() {
                at.event.remove(this, t, n, e)
            })
        },
        trigger: function(t, e) {
            return this.each(function() {
                at.event.trigger(t, e, this)
            })
        },
        triggerHandler: function(t, e) {
            var n = this[0];
            return n ? at.event.trigger(t, e, n, !0) : void 0
        }
    });
    var Ot = "abbr|article|aside|audio|bdi|canvas|data|datalist|details|figcaption|figure|footer|header|hgroup|mark|meter|nav|output|progress|section|summary|time|video",
        Ht = / jQuery\d+="(?:null|\d+)"/g,
        Ft = new RegExp("<(?:" + Ot + ")[\\s/>]", "i"),
        zt = /^\s+/,
        qt = /<(?!area|br|col|embed|hr|img|input|link|meta|param)(([\w:]+)[^>]*)\/>/gi,
        Rt = /<([\w:]+)/,
        Wt = /<tbody/i,
        Bt = /<|&#?\w+;/,
        Ut = /<(?:script|style|link)/i,
        Qt = /checked\s*(?:[^=]|=\s*.checked.)/i,
        Vt = /^$|\/(?:java|ecma)script/i,
        Xt = /^true\/(.*)/,
        Jt = /^\s*<!(?:\[CDATA\[|--)|(?:\]\]|--)>\s*$/g,
        Gt = {
            option: [1, "<select multiple='multiple'>", "</select>"],
            legend: [1, "<fieldset>", "</fieldset>"],
            area: [1, "<map>", "</map>"],
            param: [1, "<object>", "</object>"],
            thead: [1, "<table>", "</table>"],
            tr: [2, "<table><tbody>", "</tbody></table>"],
            col: [2, "<table><tbody></tbody><colgroup>", "</colgroup></table>"],
            td: [3, "<table><tbody><tr>", "</tr></tbody></table>"],
            _default: it.htmlSerialize ? [0, "", ""] : [1, "X<div>", "</div>"]
        },
        Yt = m(mt),
        Kt = Yt.appendChild(mt.createElement("div"));
    Gt.optgroup = Gt.option, Gt.tbody = Gt.tfoot = Gt.colgroup = Gt.caption = Gt.thead, Gt.th = Gt.td, at.extend({
        clone: function(t, e, n) {
            var i, o, a, s, r, l = at.contains(t.ownerDocument, t);
            if (it.html5Clone || at.isXMLDoc(t) || !Ft.test("<" + t.nodeName + ">") ? a = t.cloneNode(!0) : (Kt.innerHTML = t.outerHTML, Kt.removeChild(a = Kt.firstChild)), !(it.noCloneEvent && it.noCloneChecked || 1 !== t.nodeType && 11 !== t.nodeType || at.isXMLDoc(t)))
                for (i = g(a), r = g(t), s = 0; null != (o = r[s]); ++s) i[s] && C(o, i[s]);
            if (e)
                if (n)
                    for (r = r || g(t), i = i || g(a), s = 0; null != (o = r[s]); s++) _(o, i[s]);
                else _(t, a);
            return i = g(a, "script"), i.length > 0 && w(i, !l && g(t, "script")), i = r = o = null, a
        },
        buildFragment: function(t, e, n, i) {
            for (var o, a, s, r, l, c, d, u = t.length, p = m(e), h = [], f = 0; u > f; f++)
                if (a = t[f], a || 0 === a)
                    if ("object" === at.type(a)) at.merge(h, a.nodeType ? [a] : a);
                    else if (Bt.test(a)) {
                for (r = r || p.appendChild(e.createElement("div")), l = (Rt.exec(a) || ["", ""])[1].toLowerCase(), d = Gt[l] || Gt._default, r.innerHTML = d[1] + a.replace(qt, "<$1></$2>") + d[2], o = d[0]; o--;) r = r.lastChild;
                if (!it.leadingWhitespace && zt.test(a) && h.push(e.createTextNode(zt.exec(a)[0])), !it.tbody)
                    for (a = "table" !== l || Wt.test(a) ? "<table>" !== d[1] || Wt.test(a) ? 0 : r : r.firstChild, o = a && a.childNodes.length; o--;) at.nodeName(c = a.childNodes[o], "tbody") && !c.childNodes.length && a.removeChild(c);
                for (at.merge(h, r.childNodes), r.textContent = ""; r.firstChild;) r.removeChild(r.firstChild);
                r = p.lastChild
            } else h.push(e.createTextNode(a));
            for (r && p.removeChild(r), it.appendChecked || at.grep(g(h, "input"), v), f = 0; a = h[f++];)
                if ((!i || -1 === at.inArray(a, i)) && (s = at.contains(a.ownerDocument, a), r = g(p.appendChild(a), "script"), s && w(r), n))
                    for (o = 0; a = r[o++];) Vt.test(a.type || "") && n.push(a);
            return r = null, p
        },
        cleanData: function(t, e) {
            for (var n, i, o, a, s = 0, r = at.expando, l = at.cache, c = it.deleteExpando, d = at.event.special; null != (n = t[s]); s++)
                if ((e || at.acceptData(n)) && (o = n[r], a = o && l[o])) {
                    if (a.events)
                        for (i in a.events) d[i] ? at.event.remove(n, i) : at.removeEvent(n, i, a.handle);
                    l[o] && (delete l[o], c ? delete n[r] : typeof n.removeAttribute !== $t ? n.removeAttribute(r) : n[r] = null, X.push(o))
                }
        }
    }), at.fn.extend({
        text: function(t) {
            return At(this, function(t) {
                return void 0 === t ? at.text(this) : this.empty().append((this[0] && this[0].ownerDocument || mt).createTextNode(t))
            }, null, t, arguments.length)
        },
        append: function() {
            return this.domManip(arguments, function(t) {
                if (1 === this.nodeType || 11 === this.nodeType || 9 === this.nodeType) {
                    var e = y(this, t);
                    e.appendChild(t)
                }
            })
        },
        prepend: function() {
            return this.domManip(arguments, function(t) {
                if (1 === this.nodeType || 11 === this.nodeType || 9 === this.nodeType) {
                    var e = y(this, t);
                    e.insertBefore(t, e.firstChild)
                }
            })
        },
        before: function() {
            return this.domManip(arguments, function(t) {
                this.parentNode && this.parentNode.insertBefore(t, this)
            })
        },
        after: function() {
            return this.domManip(arguments, function(t) {
                this.parentNode && this.parentNode.insertBefore(t, this.nextSibling)
            })
        },
        remove: function(t, e) {
            for (var n, i = t ? at.filter(t, this) : this, o = 0; null != (n = i[o]); o++) e || 1 !== n.nodeType || at.cleanData(g(n)), n.parentNode && (e && at.contains(n.ownerDocument, n) && w(g(n, "script")), n.parentNode.removeChild(n));
            return this
        },
        empty: function() {
            for (var t, e = 0; null != (t = this[e]); e++) {
                for (1 === t.nodeType && at.cleanData(g(t, !1)); t.firstChild;) t.removeChild(t.firstChild);
                t.options && at.nodeName(t, "select") && (t.options.length = 0)
            }
            return this
        },
        clone: function(t, e) {
            return t = null == t ? !1 : t, e = null == e ? t : e, this.map(function() {
                return at.clone(this, t, e)
            })
        },
        html: function(t) {
            return At(this, function(t) {
                var e = this[0] || {},
                    n = 0,
                    i = this.length;
                if (void 0 === t) return 1 === e.nodeType ? e.innerHTML.replace(Ht, "") : void 0;
                if (!("string" != typeof t || Ut.test(t) || !it.htmlSerialize && Ft.test(t) || !it.leadingWhitespace && zt.test(t) || Gt[(Rt.exec(t) || ["", ""])[1].toLowerCase()])) {
                    t = t.replace(qt, "<$1></$2>");
                    try {
                        for (; i > n; n++) e = this[n] || {}, 1 === e.nodeType && (at.cleanData(g(e, !1)), e.innerHTML = t);
                        e = 0
                    } catch (o) {}
                }
                e && this.empty().append(t)
            }, null, t, arguments.length)
        },
        replaceWith: function() {
            var t = arguments[0];
            return this.domManip(arguments, function(e) {
                t = this.parentNode, at.cleanData(g(this)), t && t.replaceChild(e, this)
            }), t && (t.length || t.nodeType) ? this : this.remove()
        },
        detach: function(t) {
            return this.remove(t, !0)
        },
        domManip: function(t, e) {
            t = G.apply([], t);
            var n, i, o, a, s, r, l = 0,
                c = this.length,
                d = this,
                u = c - 1,
                p = t[0],
                h = at.isFunction(p);
            if (h || c > 1 && "string" == typeof p && !it.checkClone && Qt.test(p)) return this.each(function(n) {
                var i = d.eq(n);
                h && (t[0] = p.call(this, n, i.html())), i.domManip(t, e)
            });
            if (c && (r = at.buildFragment(t, this[0].ownerDocument, !1, this), n = r.firstChild, 1 === r.childNodes.length && (r = n), n)) {
                for (a = at.map(g(r, "script"), b), o = a.length; c > l; l++) i = r, l !== u && (i = at.clone(i, !0, !0), o && at.merge(a, g(i, "script"))), e.call(this[l], i, l);
                if (o)
                    for (s = a[a.length - 1].ownerDocument, at.map(a, x), l = 0; o > l; l++) i = a[l], Vt.test(i.type || "") && !at._data(i, "globalEval") && at.contains(s, i) && (i.src ? at._evalUrl && at._evalUrl(i.src) : at.globalEval((i.text || i.textContent || i.innerHTML || "").replace(Jt, "")));
                r = n = null
            }
            return this
        }
    }), at.each({
        appendTo: "append",
        prependTo: "prepend",
        insertBefore: "before",
        insertAfter: "after",
        replaceAll: "replaceWith"
    }, function(t, e) {
        at.fn[t] = function(t) {
            for (var n, i = 0, o = [], a = at(t), s = a.length - 1; s >= i; i++) n = i === s ? this : this.clone(!0), at(a[i])[e](n), Y.apply(o, n.get());
            return this.pushStack(o)
        }
    });
    var Zt, te = {};
    ! function() {
        var t, e, n = mt.createElement("div"),
            i = "-webkit-box-sizing:content-box;-moz-box-sizing:content-box;box-sizing:content-box;display:block;padding:0;margin:0;border:0";
        n.innerHTML = "  <link/><table></table><a href='/a'>a</a><input type='checkbox'/>", t = n.getElementsByTagName("a")[0], t.style.cssText = "float:left;opacity:.5", it.opacity = /^0.5/.test(t.style.opacity), it.cssFloat = !!t.style.cssFloat, n.style.backgroundClip = "content-box", n.cloneNode(!0).style.backgroundClip = "", it.clearCloneStyle = "content-box" === n.style.backgroundClip, t = n = null, it.shrinkWrapBlocks = function() {
            var t, n, o, a;
            if (null == e) {
                if (t = mt.getElementsByTagName("body")[0], !t) return;
                a = "border:0;width:0;height:0;position:absolute;top:0;left:-9999px", n = mt.createElement("div"), o = mt.createElement("div"), t.appendChild(n).appendChild(o), e = !1, typeof o.style.zoom !== $t && (o.style.cssText = i + ";width:1px;padding:1px;zoom:1", o.innerHTML = "<div></div>", o.firstChild.style.width = "5px", e = 3 !== o.offsetWidth), t.removeChild(n), t = n = o = null
            }
            return e
        }
    }();
    var ee, ne, ie = /^margin/,
        oe = new RegExp("^(" + Tt + ")(?!px)[a-z%]+$", "i"),
        ae = /^(top|right|bottom|left)$/;
    t.getComputedStyle ? (ee = function(t) {
        return t.ownerDocument.defaultView.getComputedStyle(t, null)
    }, ne = function(t, e, n) {
        var i, o, a, s, r = t.style;
        return n = n || ee(t), s = n ? n.getPropertyValue(e) || n[e] : void 0, n && ("" !== s || at.contains(t.ownerDocument, t) || (s = at.style(t, e)), oe.test(s) && ie.test(e) && (i = r.width, o = r.minWidth, a = r.maxWidth, r.minWidth = r.maxWidth = r.width = s, s = n.width, r.width = i, r.minWidth = o, r.maxWidth = a)), void 0 === s ? s : s + ""
    }) : mt.documentElement.currentStyle && (ee = function(t) {
        return t.currentStyle
    }, ne = function(t, e, n) {
        var i, o, a, s, r = t.style;
        return n = n || ee(t), s = n ? n[e] : void 0, null == s && r && r[e] && (s = r[e]), oe.test(s) && !ae.test(e) && (i = r.left, o = t.runtimeStyle, a = o && o.left, a && (o.left = t.currentStyle.left), r.left = "fontSize" === e ? "1em" : s, s = r.pixelLeft + "px", r.left = i, a && (o.left = a)), void 0 === s ? s : s + "" || "auto"
    }), ! function() {
        function e() {
            var e, n, i = mt.getElementsByTagName("body")[0];
            i && (e = mt.createElement("div"), n = mt.createElement("div"), e.style.cssText = c, i.appendChild(e).appendChild(n), n.style.cssText = "-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;position:absolute;display:block;padding:1px;border:1px;width:4px;margin-top:1%;top:1%", at.swap(i, null != i.style.zoom ? {
                zoom: 1
            } : {}, function() {
                o = 4 === n.offsetWidth
            }), a = !0, s = !1, r = !0, t.getComputedStyle && (s = "1%" !== (t.getComputedStyle(n, null) || {}).top, a = "4px" === (t.getComputedStyle(n, null) || {
                width: "4px"
            }).width), i.removeChild(e), n = i = null)
        }
        var n, i, o, a, s, r, l = mt.createElement("div"),
            c = "border:0;width:0;height:0;position:absolute;top:0;left:-9999px",
            d = "-webkit-box-sizing:content-box;-moz-box-sizing:content-box;box-sizing:content-box;display:block;padding:0;margin:0;border:0";
        l.innerHTML = "  <link/><table></table><a href='/a'>a</a><input type='checkbox'/>", n = l.getElementsByTagName("a")[0], n.style.cssText = "float:left;opacity:.5", it.opacity = /^0.5/.test(n.style.opacity), it.cssFloat = !!n.style.cssFloat, l.style.backgroundClip = "content-box", l.cloneNode(!0).style.backgroundClip = "", it.clearCloneStyle = "content-box" === l.style.backgroundClip, n = l = null, at.extend(it, {
            reliableHiddenOffsets: function() {
                if (null != i) return i;
                var t, e, n, o = mt.createElement("div"),
                    a = mt.getElementsByTagName("body")[0];
                return a ? (o.setAttribute("className", "t"), o.innerHTML = "  <link/><table></table><a href='/a'>a</a><input type='checkbox'/>", t = mt.createElement("div"), t.style.cssText = c, a.appendChild(t).appendChild(o), o.innerHTML = "<table><tr><td></td><td>t</td></tr></table>", e = o.getElementsByTagName("td"), e[0].style.cssText = "padding:0;margin:0;border:0;display:none", n = 0 === e[0].offsetHeight, e[0].style.display = "", e[1].style.display = "none", i = n && 0 === e[0].offsetHeight, a.removeChild(t), o = a = null, i) : void 0
            },
            boxSizing: function() {
                return null == o && e(), o
            },
            boxSizingReliable: function() {
                return null == a && e(), a
            },
            pixelPosition: function() {
                return null == s && e(), s
            },
            reliableMarginRight: function() {
                var e, n, i, o;
                if (null == r && t.getComputedStyle) {
                    if (e = mt.getElementsByTagName("body")[0], !e) return;
                    n = mt.createElement("div"), i = mt.createElement("div"), n.style.cssText = c, e.appendChild(n).appendChild(i), o = i.appendChild(mt.createElement("div")), o.style.cssText = i.style.cssText = d, o.style.marginRight = o.style.width = "0", i.style.width = "1px", r = !parseFloat((t.getComputedStyle(o, null) || {}).marginRight), e.removeChild(n)
                }
                return r
            }
        })
    }(), at.swap = function(t, e, n, i) {
        var o, a, s = {};
        for (a in e) s[a] = t.style[a], t.style[a] = e[a];
        o = n.apply(t, i || []);
        for (a in e) t.style[a] = s[a];
        return o
    };
    var se = /alpha\([^)]*\)/i,
        re = /opacity\s*=\s*([^)]*)/,
        le = /^(none|table(?!-c[ea]).+)/,
        ce = new RegExp("^(" + Tt + ")(.*)$", "i"),
        de = new RegExp("^([+-])=(" + Tt + ")", "i"),
        ue = {
            position: "absolute",
            visibility: "hidden",
            display: "block"
        },
        pe = {
            letterSpacing: 0,
            fontWeight: 400
        },
        he = ["Webkit", "O", "Moz", "ms"];
    at.extend({
        cssHooks: {
            opacity: {
                get: function(t, e) {
                    if (e) {
                        var n = ne(t, "opacity");
                        return "" === n ? "1" : n
                    }
                }
            }
        },
        cssNumber: {
            columnCount: !0,
            fillOpacity: !0,
            fontWeight: !0,
            lineHeight: !0,
            opacity: !0,
            order: !0,
            orphans: !0,
            widows: !0,
            zIndex: !0,
            zoom: !0
        },
        cssProps: {
            "float": it.cssFloat ? "cssFloat" : "styleFloat"
        },
        style: function(t, e, n, i) {
            if (t && 3 !== t.nodeType && 8 !== t.nodeType && t.style) {
                var o, a, s, r = at.camelCase(e),
                    l = t.style;
                if (e = at.cssProps[r] || (at.cssProps[r] = T(l, r)), s = at.cssHooks[e] || at.cssHooks[r], void 0 === n) return s && "get" in s && void 0 !== (o = s.get(t, !1, i)) ? o : l[e];
                if (a = typeof n, "string" === a && (o = de.exec(n)) && (n = (o[1] + 1) * o[2] + parseFloat(at.css(t, e)), a = "number"), null != n && n === n && ("number" !== a || at.cssNumber[r] || (n += "px"), it.clearCloneStyle || "" !== n || 0 !== e.indexOf("background") || (l[e] = "inherit"), !(s && "set" in s && void 0 === (n = s.set(t, n, i))))) try {
                    l[e] = "", l[e] = n
                } catch (c) {}
            }
        },
        css: function(t, e, n, i) {
            var o, a, s, r = at.camelCase(e);
            return e = at.cssProps[r] || (at.cssProps[r] = T(t.style, r)), s = at.cssHooks[e] || at.cssHooks[r], s && "get" in s && (a = s.get(t, !0, n)), void 0 === a && (a = ne(t, e, i)), "normal" === a && e in pe && (a = pe[e]), "" === n || n ? (o = parseFloat(a), n === !0 || at.isNumeric(o) ? o || 0 : a) : a
        }
    }), at.each(["height", "width"], function(t, e) {
        at.cssHooks[e] = {
            get: function(t, n, i) {
                return n ? 0 === t.offsetWidth && le.test(at.css(t, "display")) ? at.swap(t, ue, function() {
                    return j(t, e, i)
                }) : j(t, e, i) : void 0
            },
            set: function(t, n, i) {
                var o = i && ee(t);
                return D(t, n, i ? A(t, e, i, it.boxSizing() && "border-box" === at.css(t, "boxSizing", !1, o), o) : 0)
            }
        }
    }), it.opacity || (at.cssHooks.opacity = {
        get: function(t, e) {
            return re.test((e && t.currentStyle ? t.currentStyle.filter : t.style.filter) || "") ? .01 * parseFloat(RegExp.$1) + "" : e ? "1" : ""
        },
        set: function(t, e) {
            var n = t.style,
                i = t.currentStyle,
                o = at.isNumeric(e) ? "alpha(opacity=" + 100 * e + ")" : "",
                a = i && i.filter || n.filter || "";
            n.zoom = 1, (e >= 1 || "" === e) && "" === at.trim(a.replace(se, "")) && n.removeAttribute && (n.removeAttribute("filter"), "" === e || i && !i.filter) || (n.filter = se.test(a) ? a.replace(se, o) : a + " " + o)
        }
    }), at.cssHooks.marginRight = S(it.reliableMarginRight, function(t, e) {
        return e ? at.swap(t, {
            display: "inline-block"
        }, ne, [t, "marginRight"]) : void 0
    }), at.each({
        margin: "",
        padding: "",
        border: "Width"
    }, function(t, e) {
        at.cssHooks[t + e] = {
            expand: function(n) {
                for (var i = 0, o = {}, a = "string" == typeof n ? n.split(" ") : [n]; 4 > i; i++) o[t + Et[i] + e] = a[i] || a[i - 2] || a[0];
                return o
            }
        }, ie.test(t) || (at.cssHooks[t + e].set = D)
    }), at.fn.extend({
        css: function(t, e) {
            return At(this, function(t, e, n) {
                var i, o, a = {},
                    s = 0;
                if (at.isArray(e)) {
                    for (i = ee(t), o = e.length; o > s; s++) a[e[s]] = at.css(t, e[s], !1, i);
                    return a
                }
                return void 0 !== n ? at.style(t, e, n) : at.css(t, e)
            }, t, e, arguments.length > 1)
        },
        show: function() {
            return E(this, !0)
        },
        hide: function() {
            return E(this)
        },
        toggle: function(t) {
            return "boolean" == typeof t ? t ? this.show() : this.hide() : this.each(function() {
                Dt(this) ? at(this).show() : at(this).hide()
            })
        }
    }), at.Tween = I, I.prototype = {
        constructor: I,
        init: function(t, e, n, i, o, a) {
            this.elem = t, this.prop = n, this.easing = o || "swing", this.options = e, this.start = this.now = this.cur(), this.end = i, this.unit = a || (at.cssNumber[n] ? "" : "px")
        },
        cur: function() {
            var t = I.propHooks[this.prop];
            return t && t.get ? t.get(this) : I.propHooks._default.get(this);
        },
        run: function(t) {
            var e, n = I.propHooks[this.prop];
            return this.pos = e = this.options.duration ? at.easing[this.easing](t, this.options.duration * t, 0, 1, this.options.duration) : t, this.now = (this.end - this.start) * e + this.start, this.options.step && this.options.step.call(this.elem, this.now, this), n && n.set ? n.set(this) : I.propHooks._default.set(this), this
        }
    }, I.prototype.init.prototype = I.prototype, I.propHooks = {
        _default: {
            get: function(t) {
                var e;
                return null == t.elem[t.prop] || t.elem.style && null != t.elem.style[t.prop] ? (e = at.css(t.elem, t.prop, ""), e && "auto" !== e ? e : 0) : t.elem[t.prop]
            },
            set: function(t) {
                at.fx.step[t.prop] ? at.fx.step[t.prop](t) : t.elem.style && (null != t.elem.style[at.cssProps[t.prop]] || at.cssHooks[t.prop]) ? at.style(t.elem, t.prop, t.now + t.unit) : t.elem[t.prop] = t.now
            }
        }
    }, I.propHooks.scrollTop = I.propHooks.scrollLeft = {
        set: function(t) {
            t.elem.nodeType && t.elem.parentNode && (t.elem[t.prop] = t.now)
        }
    }, at.easing = {
        linear: function(t) {
            return t
        },
        swing: function(t) {
            return .5 - Math.cos(t * Math.PI) / 2
        }
    }, at.fx = I.prototype.init, at.fx.step = {};
    var fe, me, ge = /^(?:toggle|show|hide)$/,
        ve = new RegExp("^(?:([+-])=|)(" + Tt + ")([a-z%]*)$", "i"),
        ye = /queueHooks$/,
        be = [P],
        xe = {
            "*": [function(t, e) {
                var n = this.createTween(t, e),
                    i = n.cur(),
                    o = ve.exec(e),
                    a = o && o[3] || (at.cssNumber[t] ? "" : "px"),
                    s = (at.cssNumber[t] || "px" !== a && +i) && ve.exec(at.css(n.elem, t)),
                    r = 1,
                    l = 20;
                if (s && s[3] !== a) {
                    a = a || s[3], o = o || [], s = +i || 1;
                    do r = r || ".5", s /= r, at.style(n.elem, t, s + a); while (r !== (r = n.cur() / i) && 1 !== r && --l)
                }
                return o && (s = n.start = +s || +i || 0, n.unit = a, n.end = o[1] ? s + (o[1] + 1) * o[2] : +o[2]), n
            }]
        };
    at.Animation = at.extend(H, {
            tweener: function(t, e) {
                at.isFunction(t) ? (e = t, t = ["*"]) : t = t.split(" ");
                for (var n, i = 0, o = t.length; o > i; i++) n = t[i], xe[n] = xe[n] || [], xe[n].unshift(e)
            },
            prefilter: function(t, e) {
                e ? be.unshift(t) : be.push(t)
            }
        }), at.speed = function(t, e, n) {
            var i = t && "object" == typeof t ? at.extend({}, t) : {
                complete: n || !n && e || at.isFunction(t) && t,
                duration: t,
                easing: n && e || e && !at.isFunction(e) && e
            };
            return i.duration = at.fx.off ? 0 : "number" == typeof i.duration ? i.duration : i.duration in at.fx.speeds ? at.fx.speeds[i.duration] : at.fx.speeds._default, (null == i.queue || i.queue === !0) && (i.queue = "fx"), i.old = i.complete, i.complete = function() {
                at.isFunction(i.old) && i.old.call(this), i.queue && at.dequeue(this, i.queue)
            }, i
        }, at.fn.extend({
            fadeTo: function(t, e, n, i) {
                return this.filter(Dt).css("opacity", 0).show().end().animate({
                    opacity: e
                }, t, n, i)
            },
            animate: function(t, e, n, i) {
                var o = at.isEmptyObject(t),
                    a = at.speed(e, n, i),
                    s = function() {
                        var e = H(this, at.extend({}, t), a);
                        (o || at._data(this, "finish")) && e.stop(!0)
                    };
                return s.finish = s, o || a.queue === !1 ? this.each(s) : this.queue(a.queue, s)
            },
            stop: function(t, e, n) {
                var i = function(t) {
                    var e = t.stop;
                    delete t.stop, e(n)
                };
                return "string" != typeof t && (n = e, e = t, t = void 0), e && t !== !1 && this.queue(t || "fx", []), this.each(function() {
                    var e = !0,
                        o = null != t && t + "queueHooks",
                        a = at.timers,
                        s = at._data(this);
                    if (o) s[o] && s[o].stop && i(s[o]);
                    else
                        for (o in s) s[o] && s[o].stop && ye.test(o) && i(s[o]);
                    for (o = a.length; o--;) a[o].elem !== this || null != t && a[o].queue !== t || (a[o].anim.stop(n), e = !1, a.splice(o, 1));
                    (e || !n) && at.dequeue(this, t)
                })
            },
            finish: function(t) {
                return t !== !1 && (t = t || "fx"), this.each(function() {
                    var e, n = at._data(this),
                        i = n[t + "queue"],
                        o = n[t + "queueHooks"],
                        a = at.timers,
                        s = i ? i.length : 0;
                    for (n.finish = !0, at.queue(this, t, []), o && o.stop && o.stop.call(this, !0), e = a.length; e--;) a[e].elem === this && a[e].queue === t && (a[e].anim.stop(!0), a.splice(e, 1));
                    for (e = 0; s > e; e++) i[e] && i[e].finish && i[e].finish.call(this);
                    delete n.finish
                })
            }
        }), at.each(["toggle", "show", "hide"], function(t, e) {
            var n = at.fn[e];
            at.fn[e] = function(t, i, o) {
                return null == t || "boolean" == typeof t ? n.apply(this, arguments) : this.animate(N(e, !0), t, i, o)
            }
        }), at.each({
            slideDown: N("show"),
            slideUp: N("hide"),
            slideToggle: N("toggle"),
            fadeIn: {
                opacity: "show"
            },
            fadeOut: {
                opacity: "hide"
            },
            fadeToggle: {
                opacity: "toggle"
            }
        }, function(t, e) {
            at.fn[t] = function(t, n, i) {
                return this.animate(e, t, n, i)
            }
        }), at.timers = [], at.fx.tick = function() {
            var t, e = at.timers,
                n = 0;
            for (fe = at.now(); n < e.length; n++) t = e[n], t() || e[n] !== t || e.splice(n--, 1);
            e.length || at.fx.stop(), fe = void 0
        }, at.fx.timer = function(t) {
            at.timers.push(t), t() ? at.fx.start() : at.timers.pop()
        }, at.fx.interval = 13, at.fx.start = function() {
            me || (me = setInterval(at.fx.tick, at.fx.interval))
        }, at.fx.stop = function() {
            clearInterval(me), me = null
        }, at.fx.speeds = {
            slow: 600,
            fast: 200,
            _default: 400
        }, at.fn.delay = function(t, e) {
            return t = at.fx ? at.fx.speeds[t] || t : t, e = e || "fx", this.queue(e, function(e, n) {
                var i = setTimeout(e, t);
                n.stop = function() {
                    clearTimeout(i)
                }
            })
        },
        function() {
            var t, e, n, i, o = mt.createElement("div");
            o.setAttribute("className", "t"), o.innerHTML = "  <link/><table></table><a href='/a'>a</a><input type='checkbox'/>", t = o.getElementsByTagName("a")[0], n = mt.createElement("select"), i = n.appendChild(mt.createElement("option")), e = o.getElementsByTagName("input")[0], t.style.cssText = "top:1px", it.getSetAttribute = "t" !== o.className, it.style = /top/.test(t.getAttribute("style")), it.hrefNormalized = "/a" === t.getAttribute("href"), it.checkOn = !!e.value, it.optSelected = i.selected, it.enctype = !!mt.createElement("form").enctype, n.disabled = !0, it.optDisabled = !i.disabled, e = mt.createElement("input"), e.setAttribute("value", ""), it.input = "" === e.getAttribute("value"), e.value = "t", e.setAttribute("type", "radio"), it.radioValue = "t" === e.value, t = e = n = i = o = null
        }();
    var we = /\r/g;
    at.fn.extend({
        val: function(t) {
            var e, n, i, o = this[0];
            return arguments.length ? (i = at.isFunction(t), this.each(function(n) {
                var o;
                1 === this.nodeType && (o = i ? t.call(this, n, at(this).val()) : t, null == o ? o = "" : "number" == typeof o ? o += "" : at.isArray(o) && (o = at.map(o, function(t) {
                    return null == t ? "" : t + ""
                })), e = at.valHooks[this.type] || at.valHooks[this.nodeName.toLowerCase()], e && "set" in e && void 0 !== e.set(this, o, "value") || (this.value = o))
            })) : o ? (e = at.valHooks[o.type] || at.valHooks[o.nodeName.toLowerCase()], e && "get" in e && void 0 !== (n = e.get(o, "value")) ? n : (n = o.value, "string" == typeof n ? n.replace(we, "") : null == n ? "" : n)) : void 0
        }
    }), at.extend({
        valHooks: {
            option: {
                get: function(t) {
                    var e = at.find.attr(t, "value");
                    return null != e ? e : at.text(t)
                }
            },
            select: {
                get: function(t) {
                    for (var e, n, i = t.options, o = t.selectedIndex, a = "select-one" === t.type || 0 > o, s = a ? null : [], r = a ? o + 1 : i.length, l = 0 > o ? r : a ? o : 0; r > l; l++)
                        if (n = i[l], !(!n.selected && l !== o || (it.optDisabled ? n.disabled : null !== n.getAttribute("disabled")) || n.parentNode.disabled && at.nodeName(n.parentNode, "optgroup"))) {
                            if (e = at(n).val(), a) return e;
                            s.push(e)
                        }
                    return s
                },
                set: function(t, e) {
                    for (var n, i, o = t.options, a = at.makeArray(e), s = o.length; s--;)
                        if (i = o[s], at.inArray(at.valHooks.option.get(i), a) >= 0) try {
                            i.selected = n = !0
                        } catch (r) {
                            i.scrollHeight
                        } else i.selected = !1;
                    return n || (t.selectedIndex = -1), o
                }
            }
        }
    }), at.each(["radio", "checkbox"], function() {
        at.valHooks[this] = {
            set: function(t, e) {
                return at.isArray(e) ? t.checked = at.inArray(at(t).val(), e) >= 0 : void 0
            }
        }, it.checkOn || (at.valHooks[this].get = function(t) {
            return null === t.getAttribute("value") ? "on" : t.value
        })
    });
    var _e, Ce, $e = at.expr.attrHandle,
        ke = /^(?:checked|selected)$/i,
        Se = it.getSetAttribute,
        Te = it.input;
    at.fn.extend({
        attr: function(t, e) {
            return At(this, at.attr, t, e, arguments.length > 1)
        },
        removeAttr: function(t) {
            return this.each(function() {
                at.removeAttr(this, t)
            })
        }
    }), at.extend({
        attr: function(t, e, n) {
            var i, o, a = t.nodeType;
            return t && 3 !== a && 8 !== a && 2 !== a ? typeof t.getAttribute === $t ? at.prop(t, e, n) : (1 === a && at.isXMLDoc(t) || (e = e.toLowerCase(), i = at.attrHooks[e] || (at.expr.match.bool.test(e) ? Ce : _e)), void 0 === n ? i && "get" in i && null !== (o = i.get(t, e)) ? o : (o = at.find.attr(t, e), null == o ? void 0 : o) : null !== n ? i && "set" in i && void 0 !== (o = i.set(t, n, e)) ? o : (t.setAttribute(e, n + ""), n) : void at.removeAttr(t, e)) : void 0
        },
        removeAttr: function(t, e) {
            var n, i, o = 0,
                a = e && e.match(xt);
            if (a && 1 === t.nodeType)
                for (; n = a[o++];) i = at.propFix[n] || n, at.expr.match.bool.test(n) ? Te && Se || !ke.test(n) ? t[i] = !1 : t[at.camelCase("default-" + n)] = t[i] = !1 : at.attr(t, n, ""), t.removeAttribute(Se ? n : i)
        },
        attrHooks: {
            type: {
                set: function(t, e) {
                    if (!it.radioValue && "radio" === e && at.nodeName(t, "input")) {
                        var n = t.value;
                        return t.setAttribute("type", e), n && (t.value = n), e
                    }
                }
            }
        }
    }), Ce = {
        set: function(t, e, n) {
            return e === !1 ? at.removeAttr(t, n) : Te && Se || !ke.test(n) ? t.setAttribute(!Se && at.propFix[n] || n, n) : t[at.camelCase("default-" + n)] = t[n] = !0, n
        }
    }, at.each(at.expr.match.bool.source.match(/\w+/g), function(t, e) {
        var n = $e[e] || at.find.attr;
        $e[e] = Te && Se || !ke.test(e) ? function(t, e, i) {
            var o, a;
            return i || (a = $e[e], $e[e] = o, o = null != n(t, e, i) ? e.toLowerCase() : null, $e[e] = a), o
        } : function(t, e, n) {
            return n ? void 0 : t[at.camelCase("default-" + e)] ? e.toLowerCase() : null
        }
    }), Te && Se || (at.attrHooks.value = {
        set: function(t, e, n) {
            return at.nodeName(t, "input") ? void(t.defaultValue = e) : _e && _e.set(t, e, n)
        }
    }), Se || (_e = {
        set: function(t, e, n) {
            var i = t.getAttributeNode(n);
            return i || t.setAttributeNode(i = t.ownerDocument.createAttribute(n)), i.value = e += "", "value" === n || e === t.getAttribute(n) ? e : void 0
        }
    }, $e.id = $e.name = $e.coords = function(t, e, n) {
        var i;
        return n ? void 0 : (i = t.getAttributeNode(e)) && "" !== i.value ? i.value : null
    }, at.valHooks.button = {
        get: function(t, e) {
            var n = t.getAttributeNode(e);
            return n && n.specified ? n.value : void 0
        },
        set: _e.set
    }, at.attrHooks.contenteditable = {
        set: function(t, e, n) {
            _e.set(t, "" === e ? !1 : e, n)
        }
    }, at.each(["width", "height"], function(t, e) {
        at.attrHooks[e] = {
            set: function(t, n) {
                return "" === n ? (t.setAttribute(e, "auto"), n) : void 0
            }
        }
    })), it.style || (at.attrHooks.style = {
        get: function(t) {
            return t.style.cssText || void 0
        },
        set: function(t, e) {
            return t.style.cssText = e + ""
        }
    });
    var Ee = /^(?:input|select|textarea|button|object)$/i,
        De = /^(?:a|area)$/i;
    at.fn.extend({
        prop: function(t, e) {
            return At(this, at.prop, t, e, arguments.length > 1)
        },
        removeProp: function(t) {
            return t = at.propFix[t] || t, this.each(function() {
                try {
                    this[t] = void 0, delete this[t]
                } catch (e) {}
            })
        }
    }), at.extend({
        propFix: {
            "for": "htmlFor",
            "class": "className"
        },
        prop: function(t, e, n) {
            var i, o, a, s = t.nodeType;
            return t && 3 !== s && 8 !== s && 2 !== s ? (a = 1 !== s || !at.isXMLDoc(t), a && (e = at.propFix[e] || e, o = at.propHooks[e]), void 0 !== n ? o && "set" in o && void 0 !== (i = o.set(t, n, e)) ? i : t[e] = n : o && "get" in o && null !== (i = o.get(t, e)) ? i : t[e]) : void 0
        },
        propHooks: {
            tabIndex: {
                get: function(t) {
                    var e = at.find.attr(t, "tabindex");
                    return e ? parseInt(e, 10) : Ee.test(t.nodeName) || De.test(t.nodeName) && t.href ? 0 : -1
                }
            }
        }
    }), it.hrefNormalized || at.each(["href", "src"], function(t, e) {
        at.propHooks[e] = {
            get: function(t) {
                return t.getAttribute(e, 4)
            }
        }
    }), it.optSelected || (at.propHooks.selected = {
        get: function(t) {
            var e = t.parentNode;
            return e && (e.selectedIndex, e.parentNode && e.parentNode.selectedIndex), null
        }
    }), at.each(["tabIndex", "readOnly", "maxLength", "cellSpacing", "cellPadding", "rowSpan", "colSpan", "useMap", "frameBorder", "contentEditable"], function() {
        at.propFix[this.toLowerCase()] = this
    }), it.enctype || (at.propFix.enctype = "encoding");
    var Ae = /[\t\r\n\f]/g;
    at.fn.extend({
        addClass: function(t) {
            var e, n, i, o, a, s, r = 0,
                l = this.length,
                c = "string" == typeof t && t;
            if (at.isFunction(t)) return this.each(function(e) {
                at(this).addClass(t.call(this, e, this.className))
            });
            if (c)
                for (e = (t || "").match(xt) || []; l > r; r++)
                    if (n = this[r], i = 1 === n.nodeType && (n.className ? (" " + n.className + " ").replace(Ae, " ") : " ")) {
                        for (a = 0; o = e[a++];) i.indexOf(" " + o + " ") < 0 && (i += o + " ");
                        s = at.trim(i), n.className !== s && (n.className = s)
                    }
            return this
        },
        removeClass: function(t) {
            var e, n, i, o, a, s, r = 0,
                l = this.length,
                c = 0 === arguments.length || "string" == typeof t && t;
            if (at.isFunction(t)) return this.each(function(e) {
                at(this).removeClass(t.call(this, e, this.className))
            });
            if (c)
                for (e = (t || "").match(xt) || []; l > r; r++)
                    if (n = this[r], i = 1 === n.nodeType && (n.className ? (" " + n.className + " ").replace(Ae, " ") : "")) {
                        for (a = 0; o = e[a++];)
                            for (; i.indexOf(" " + o + " ") >= 0;) i = i.replace(" " + o + " ", " ");
                        s = t ? at.trim(i) : "", n.className !== s && (n.className = s)
                    }
            return this
        },
        toggleClass: function(t, e) {
            var n = typeof t;
            return "boolean" == typeof e && "string" === n ? e ? this.addClass(t) : this.removeClass(t) : this.each(at.isFunction(t) ? function(n) {
                at(this).toggleClass(t.call(this, n, this.className, e), e)
            } : function() {
                if ("string" === n)
                    for (var e, i = 0, o = at(this), a = t.match(xt) || []; e = a[i++];) o.hasClass(e) ? o.removeClass(e) : o.addClass(e);
                else(n === $t || "boolean" === n) && (this.className && at._data(this, "__className__", this.className), this.className = this.className || t === !1 ? "" : at._data(this, "__className__") || "")
            })
        },
        hasClass: function(t) {
            for (var e = " " + t + " ", n = 0, i = this.length; i > n; n++)
                if (1 === this[n].nodeType && (" " + this[n].className + " ").replace(Ae, " ").indexOf(e) >= 0) return !0;
            return !1
        }
    }), at.each("blur focus focusin focusout load resize scroll unload click dblclick mousedown mouseup mousemove mouseover mouseout mouseenter mouseleave change select submit keydown keypress keyup error contextmenu".split(" "), function(t, e) {
        at.fn[e] = function(t, n) {
            return arguments.length > 0 ? this.on(e, null, t, n) : this.trigger(e)
        }
    }), at.fn.extend({
        hover: function(t, e) {
            return this.mouseenter(t).mouseleave(e || t)
        },
        bind: function(t, e, n) {
            return this.on(t, null, e, n)
        },
        unbind: function(t, e) {
            return this.off(t, null, e)
        },
        delegate: function(t, e, n, i) {
            return this.on(e, t, n, i)
        },
        undelegate: function(t, e, n) {
            return 1 === arguments.length ? this.off(t, "**") : this.off(e, t || "**", n)
        }
    });
    var je = at.now(),
        Ie = /\?/,
        Me = /(,)|(\[|{)|(}|])|"(?:[^"\\\r\n]|\\["\\\/bfnrt]|\\u[\da-fA-F]{4})*"\s*:?|true|false|null|-?(?!0\d)\d+(?:\.\d+|)(?:[eE][+-]?\d+|)/g;
    at.parseJSON = function(e) {
        if (t.JSON && t.JSON.parse) return t.JSON.parse(e + "");
        var n, i = null,
            o = at.trim(e + "");
        return o && !at.trim(o.replace(Me, function(t, e, o, a) {
            return n && e && (i = 0), 0 === i ? t : (n = o || e, i += !a - !o, "")
        })) ? Function("return " + o)() : at.error("Invalid JSON: " + e)
    }, at.parseXML = function(e) {
        var n, i;
        if (!e || "string" != typeof e) return null;
        try {
            t.DOMParser ? (i = new DOMParser, n = i.parseFromString(e, "text/xml")) : (n = new ActiveXObject("Microsoft.XMLDOM"), n.async = "false", n.loadXML(e))
        } catch (o) {
            n = void 0
        }
        return n && n.documentElement && !n.getElementsByTagName("parsererror").length || at.error("Invalid XML: " + e), n
    };
    var Ne, Le, Pe = /#.*$/,
        Oe = /([?&])_=[^&]*/,
        He = /^(.*?):[ \t]*([^\r\n]*)\r?$/gm,
        Fe = /^(?:about|app|app-storage|.+-extension|file|res|widget):$/,
        ze = /^(?:GET|HEAD)$/,
        qe = /^\/\//,
        Re = /^([\w.+-]+:)(?:\/\/(?:[^\/?#]*@|)([^\/?#:]*)(?::(\d+)|)|)/,
        We = {},
        Be = {},
        Ue = "*/".concat("*");
    try {
        Le = location.href
    } catch (Qe) {
        Le = mt.createElement("a"), Le.href = "", Le = Le.href
    }
    Ne = Re.exec(Le.toLowerCase()) || [], at.extend({
        active: 0,
        lastModified: {},
        etag: {},
        ajaxSettings: {
            url: Le,
            type: "GET",
            isLocal: Fe.test(Ne[1]),
            global: !0,
            processData: !0,
            async: !0,
            contentType: "application/x-www-form-urlencoded; charset=UTF-8",
            accepts: {
                "*": Ue,
                text: "text/plain",
                html: "text/html",
                xml: "application/xml, text/xml",
                json: "application/json, text/javascript"
            },
            contents: {
                xml: /xml/,
                html: /html/,
                json: /json/
            },
            responseFields: {
                xml: "responseXML",
                text: "responseText",
                json: "responseJSON"
            },
            converters: {
                "* text": String,
                "text html": !0,
                "text json": at.parseJSON,
                "text xml": at.parseXML
            },
            flatOptions: {
                url: !0,
                context: !0
            }
        },
        ajaxSetup: function(t, e) {
            return e ? q(q(t, at.ajaxSettings), e) : q(at.ajaxSettings, t)
        },
        ajaxPrefilter: F(We),
        ajaxTransport: F(Be),
        ajax: function(t, e) {
            function n(t, e, n, i) {
                var o, d, v, y, x, _ = e;
                2 !== b && (b = 2, r && clearTimeout(r), c = void 0, s = i || "", w.readyState = t > 0 ? 4 : 0, o = t >= 200 && 300 > t || 304 === t, n && (y = R(u, w, n)), y = W(u, y, w, o), o ? (u.ifModified && (x = w.getResponseHeader("Last-Modified"), x && (at.lastModified[a] = x), x = w.getResponseHeader("etag"), x && (at.etag[a] = x)), 204 === t || "HEAD" === u.type ? _ = "nocontent" : 304 === t ? _ = "notmodified" : (_ = y.state, d = y.data, v = y.error, o = !v)) : (v = _, (t || !_) && (_ = "error", 0 > t && (t = 0))), w.status = t, w.statusText = (e || _) + "", o ? f.resolveWith(p, [d, _, w]) : f.rejectWith(p, [w, _, v]), w.statusCode(g), g = void 0, l && h.trigger(o ? "ajaxSuccess" : "ajaxError", [w, u, o ? d : v]), m.fireWith(p, [w, _]), l && (h.trigger("ajaxComplete", [w, u]), --at.active || at.event.trigger("ajaxStop")))
            }
            "object" == typeof t && (e = t, t = void 0), e = e || {};
            var i, o, a, s, r, l, c, d, u = at.ajaxSetup({}, e),
                p = u.context || u,
                h = u.context && (p.nodeType || p.jquery) ? at(p) : at.event,
                f = at.Deferred(),
                m = at.Callbacks("once memory"),
                g = u.statusCode || {},
                v = {},
                y = {},
                b = 0,
                x = "canceled",
                w = {
                    readyState: 0,
                    getResponseHeader: function(t) {
                        var e;
                        if (2 === b) {
                            if (!d)
                                for (d = {}; e = He.exec(s);) d[e[1].toLowerCase()] = e[2];
                            e = d[t.toLowerCase()]
                        }
                        return null == e ? null : e
                    },
                    getAllResponseHeaders: function() {
                        return 2 === b ? s : null
                    },
                    setRequestHeader: function(t, e) {
                        var n = t.toLowerCase();
                        return b || (t = y[n] = y[n] || t, v[t] = e), this
                    },
                    overrideMimeType: function(t) {
                        return b || (u.mimeType = t), this
                    },
                    statusCode: function(t) {
                        var e;
                        if (t)
                            if (2 > b)
                                for (e in t) g[e] = [g[e], t[e]];
                            else w.always(t[w.status]);
                        return this
                    },
                    abort: function(t) {
                        var e = t || x;
                        return c && c.abort(e), n(0, e), this
                    }
                };
            if (f.promise(w).complete = m.add, w.success = w.done, w.error = w.fail, u.url = ((t || u.url || Le) + "").replace(Pe, "").replace(qe, Ne[1] + "//"), u.type = e.method || e.type || u.method || u.type, u.dataTypes = at.trim(u.dataType || "*").toLowerCase().match(xt) || [""], null == u.crossDomain && (i = Re.exec(u.url.toLowerCase()), u.crossDomain = !(!i || i[1] === Ne[1] && i[2] === Ne[2] && (i[3] || ("http:" === i[1] ? "80" : "443")) === (Ne[3] || ("http:" === Ne[1] ? "80" : "443")))), u.data && u.processData && "string" != typeof u.data && (u.data = at.param(u.data, u.traditional)), z(We, u, e, w), 2 === b) return w;
            l = u.global, l && 0 === at.active++ && at.event.trigger("ajaxStart"), u.type = u.type.toUpperCase(), u.hasContent = !ze.test(u.type), a = u.url, u.hasContent || (u.data && (a = u.url += (Ie.test(a) ? "&" : "?") + u.data, delete u.data), u.cache === !1 && (u.url = Oe.test(a) ? a.replace(Oe, "$1_=" + je++) : a + (Ie.test(a) ? "&" : "?") + "_=" + je++)), u.ifModified && (at.lastModified[a] && w.setRequestHeader("If-Modified-Since", at.lastModified[a]), at.etag[a] && w.setRequestHeader("If-None-Match", at.etag[a])), (u.data && u.hasContent && u.contentType !== !1 || e.contentType) && w.setRequestHeader("Content-Type", u.contentType), w.setRequestHeader("Accept", u.dataTypes[0] && u.accepts[u.dataTypes[0]] ? u.accepts[u.dataTypes[0]] + ("*" !== u.dataTypes[0] ? ", " + Ue + "; q=0.01" : "") : u.accepts["*"]);
            for (o in u.headers) w.setRequestHeader(o, u.headers[o]);
            if (u.beforeSend && (u.beforeSend.call(p, w, u) === !1 || 2 === b)) return w.abort();
            x = "abort";
            for (o in {
                    success: 1,
                    error: 1,
                    complete: 1
                }) w[o](u[o]);
            if (c = z(Be, u, e, w)) {
                w.readyState = 1, l && h.trigger("ajaxSend", [w, u]), u.async && u.timeout > 0 && (r = setTimeout(function() {
                    w.abort("timeout")
                }, u.timeout));
                try {
                    b = 1, c.send(v, n)
                } catch (_) {
                    if (!(2 > b)) throw _;
                    n(-1, _)
                }
            } else n(-1, "No Transport");
            return w
        },
        getJSON: function(t, e, n) {
            return at.get(t, e, n, "json")
        },
        getScript: function(t, e) {
            return at.get(t, void 0, e, "script")
        }
    }), at.each(["get", "post"], function(t, e) {
        at[e] = function(t, n, i, o) {
            return at.isFunction(n) && (o = o || i, i = n, n = void 0), at.ajax({
                url: t,
                type: e,
                dataType: o,
                data: n,
                success: i
            })
        }
    }), at.each(["ajaxStart", "ajaxStop", "ajaxComplete", "ajaxError", "ajaxSuccess", "ajaxSend"], function(t, e) {
        at.fn[e] = function(t) {
            return this.on(e, t)
        }
    }), at._evalUrl = function(t) {
        return at.ajax({
            url: t,
            type: "GET",
            dataType: "script",
            async: !1,
            global: !1,
            "throws": !0
        })
    }, at.fn.extend({
        wrapAll: function(t) {
            if (at.isFunction(t)) return this.each(function(e) {
                at(this).wrapAll(t.call(this, e))
            });
            if (this[0]) {
                var e = at(t, this[0].ownerDocument).eq(0).clone(!0);
                this[0].parentNode && e.insertBefore(this[0]), e.map(function() {
                    for (var t = this; t.firstChild && 1 === t.firstChild.nodeType;) t = t.firstChild;
                    return t
                }).append(this)
            }
            return this
        },
        wrapInner: function(t) {
            return this.each(at.isFunction(t) ? function(e) {
                at(this).wrapInner(t.call(this, e))
            } : function() {
                var e = at(this),
                    n = e.contents();
                n.length ? n.wrapAll(t) : e.append(t)
            })
        },
        wrap: function(t) {
            var e = at.isFunction(t);
            return this.each(function(n) {
                at(this).wrapAll(e ? t.call(this, n) : t)
            })
        },
        unwrap: function() {
            return this.parent().each(function() {
                at.nodeName(this, "body") || at(this).replaceWith(this.childNodes)
            }).end()
        }
    }), at.expr.filters.hidden = function(t) {
        return t.offsetWidth <= 0 && t.offsetHeight <= 0 || !it.reliableHiddenOffsets() && "none" === (t.style && t.style.display || at.css(t, "display"))
    }, at.expr.filters.visible = function(t) {
        return !at.expr.filters.hidden(t)
    };
    var Ve = /%20/g,
        Xe = /\[\]$/,
        Je = /\r?\n/g,
        Ge = /^(?:submit|button|image|reset|file)$/i,
        Ye = /^(?:input|select|textarea|keygen)/i;
    at.param = function(t, e) {
        var n, i = [],
            o = function(t, e) {
                e = at.isFunction(e) ? e() : null == e ? "" : e, i[i.length] = encodeURIComponent(t) + "=" + encodeURIComponent(e)
            };
        if (void 0 === e && (e = at.ajaxSettings && at.ajaxSettings.traditional), at.isArray(t) || t.jquery && !at.isPlainObject(t)) at.each(t, function() {
            o(this.name, this.value)
        });
        else
            for (n in t) B(n, t[n], e, o);
        return i.join("&").replace(Ve, "+")
    }, at.fn.extend({
        serialize: function() {
            return at.param(this.serializeArray())
        },
        serializeArray: function() {
            return this.map(function() {
                var t = at.prop(this, "elements");
                return t ? at.makeArray(t) : this
            }).filter(function() {
                var t = this.type;
                return this.name && !at(this).is(":disabled") && Ye.test(this.nodeName) && !Ge.test(t) && (this.checked || !jt.test(t))
            }).map(function(t, e) {
                var n = at(this).val();
                return null == n ? null : at.isArray(n) ? at.map(n, function(t) {
                    return {
                        name: e.name,
                        value: t.replace(Je, "\r\n")
                    }
                }) : {
                    name: e.name,
                    value: n.replace(Je, "\r\n")
                }
            }).get()
        }
    }), at.ajaxSettings.xhr = void 0 !== t.ActiveXObject ? function() {
        return !this.isLocal && /^(get|post|head|put|delete|options)$/i.test(this.type) && U() || Q()
    } : U;
    var Ke = 0,
        Ze = {},
        tn = at.ajaxSettings.xhr();
    t.ActiveXObject && at(t).on("unload", function() {
        for (var t in Ze) Ze[t](void 0, !0)
    }), it.cors = !!tn && "withCredentials" in tn, tn = it.ajax = !!tn, tn && at.ajaxTransport(function(t) {
        if (!t.crossDomain || it.cors) {
            var e;
            return {
                send: function(n, i) {
                    var o, a = t.xhr(),
                        s = ++Ke;
                    if (a.open(t.type, t.url, t.async, t.username, t.password), t.xhrFields)
                        for (o in t.xhrFields) a[o] = t.xhrFields[o];
                    t.mimeType && a.overrideMimeType && a.overrideMimeType(t.mimeType), t.crossDomain || n["X-Requested-With"] || (n["X-Requested-With"] = "XMLHttpRequest");
                    for (o in n) void 0 !== n[o] && a.setRequestHeader(o, n[o] + "");
                    a.send(t.hasContent && t.data || null), e = function(n, o) {
                        var r, l, c;
                        if (e && (o || 4 === a.readyState))
                            if (delete Ze[s], e = void 0, a.onreadystatechange = at.noop, o) 4 !== a.readyState && a.abort();
                            else {
                                c = {}, r = a.status, "string" == typeof a.responseText && (c.text = a.responseText);
                                try {
                                    l = a.statusText
                                } catch (d) {
                                    l = ""
                                }
                                r || !t.isLocal || t.crossDomain ? 1223 === r && (r = 204) : r = c.text ? 200 : 404
                            }
                        c && i(r, l, c, a.getAllResponseHeaders())
                    }, t.async ? 4 === a.readyState ? setTimeout(e) : a.onreadystatechange = Ze[s] = e : e()
                },
                abort: function() {
                    e && e(void 0, !0)
                }
            }
        }
    }), at.ajaxSetup({
        accepts: {
            script: "text/javascript, application/javascript, application/ecmascript, application/x-ecmascript"
        },
        contents: {
            script: /(?:java|ecma)script/
        },
        converters: {
            "text script": function(t) {
                return at.globalEval(t), t
            }
        }
    }), at.ajaxPrefilter("script", function(t) {
        void 0 === t.cache && (t.cache = !1), t.crossDomain && (t.type = "GET", t.global = !1)
    }), at.ajaxTransport("script", function(t) {
        if (t.crossDomain) {
            var e, n = mt.head || at("head")[0] || mt.documentElement;
            return {
                send: function(i, o) {
                    e = mt.createElement("script"), e.async = !0, t.scriptCharset && (e.charset = t.scriptCharset), e.src = t.url, e.onload = e.onreadystatechange = function(t, n) {
                        (n || !e.readyState || /loaded|complete/.test(e.readyState)) && (e.onload = e.onreadystatechange = null, e.parentNode && e.parentNode.removeChild(e), e = null, n || o(200, "success"))
                    }, n.insertBefore(e, n.firstChild)
                },
                abort: function() {
                    e && e.onload(void 0, !0)
                }
            }
        }
    });
    var en = [],
        nn = /(=)\?(?=&|$)|\?\?/;
    at.ajaxSetup({
        jsonp: "callback",
        jsonpCallback: function() {
            var t = en.pop() || at.expando + "_" + je++;
            return this[t] = !0, t
        }
    }), at.ajaxPrefilter("json jsonp", function(e, n, i) {
        var o, a, s, r = e.jsonp !== !1 && (nn.test(e.url) ? "url" : "string" == typeof e.data && !(e.contentType || "").indexOf("application/x-www-form-urlencoded") && nn.test(e.data) && "data");
        return r || "jsonp" === e.dataTypes[0] ? (o = e.jsonpCallback = at.isFunction(e.jsonpCallback) ? e.jsonpCallback() : e.jsonpCallback, r ? e[r] = e[r].replace(nn, "$1" + o) : e.jsonp !== !1 && (e.url += (Ie.test(e.url) ? "&" : "?") + e.jsonp + "=" + o), e.converters["script json"] = function() {
            return s || at.error(o + " was not called"), s[0]
        }, e.dataTypes[0] = "json", a = t[o], t[o] = function() {
            s = arguments
        }, i.always(function() {
            t[o] = a, e[o] && (e.jsonpCallback = n.jsonpCallback, en.push(o)), s && at.isFunction(a) && a(s[0]), s = a = void 0
        }), "script") : void 0
    }), at.parseHTML = function(t, e, n) {
        if (!t || "string" != typeof t) return null;
        "boolean" == typeof e && (n = e, e = !1), e = e || mt;
        var i = pt.exec(t),
            o = !n && [];
        return i ? [e.createElement(i[1])] : (i = at.buildFragment([t], e, o), o && o.length && at(o).remove(), at.merge([], i.childNodes))
    };
    var on = at.fn.load;
    at.fn.load = function(t, e, n) {
        if ("string" != typeof t && on) return on.apply(this, arguments);
        var i, o, a, s = this,
            r = t.indexOf(" ");
        return r >= 0 && (i = t.slice(r, t.length), t = t.slice(0, r)), at.isFunction(e) ? (n = e, e = void 0) : e && "object" == typeof e && (a = "POST"), s.length > 0 && at.ajax({
            url: t,
            type: a,
            dataType: "html",
            data: e
        }).done(function(t) {
            o = arguments, s.html(i ? at("<div>").append(at.parseHTML(t)).find(i) : t)
        }).complete(n && function(t, e) {
            s.each(n, o || [t.responseText, e, t])
        }), this
    }, at.expr.filters.animated = function(t) {
        return at.grep(at.timers, function(e) {
            return t === e.elem
        }).length
    };
    var an = t.document.documentElement;
    at.offset = {
        setOffset: function(t, e, n) {
            var i, o, a, s, r, l, c, d = at.css(t, "position"),
                u = at(t),
                p = {};
            "static" === d && (t.style.position = "relative"), r = u.offset(), a = at.css(t, "top"), l = at.css(t, "left"), c = ("absolute" === d || "fixed" === d) && at.inArray("auto", [a, l]) > -1, c ? (i = u.position(), s = i.top, o = i.left) : (s = parseFloat(a) || 0, o = parseFloat(l) || 0), at.isFunction(e) && (e = e.call(t, n, r)), null != e.top && (p.top = e.top - r.top + s), null != e.left && (p.left = e.left - r.left + o), "using" in e ? e.using.call(t, p) : u.css(p)
        }
    }, at.fn.extend({
        offset: function(t) {
            if (arguments.length) return void 0 === t ? this : this.each(function(e) {
                at.offset.setOffset(this, t, e)
            });
            var e, n, i = {
                    top: 0,
                    left: 0
                },
                o = this[0],
                a = o && o.ownerDocument;
            return a ? (e = a.documentElement, at.contains(e, o) ? (typeof o.getBoundingClientRect !== $t && (i = o.getBoundingClientRect()), n = V(a), {
                top: i.top + (n.pageYOffset || e.scrollTop) - (e.clientTop || 0),
                left: i.left + (n.pageXOffset || e.scrollLeft) - (e.clientLeft || 0)
            }) : i) : void 0
        },
        position: function() {
            if (this[0]) {
                var t, e, n = {
                        top: 0,
                        left: 0
                    },
                    i = this[0];
                return "fixed" === at.css(i, "position") ? e = i.getBoundingClientRect() : (t = this.offsetParent(), e = this.offset(), at.nodeName(t[0], "html") || (n = t.offset()), n.top += at.css(t[0], "borderTopWidth", !0), n.left += at.css(t[0], "borderLeftWidth", !0)), {
                    top: e.top - n.top - at.css(i, "marginTop", !0),
                    left: e.left - n.left - at.css(i, "marginLeft", !0)
                }
            }
        },
        offsetParent: function() {
            return this.map(function() {
                for (var t = this.offsetParent || an; t && !at.nodeName(t, "html") && "static" === at.css(t, "position");) t = t.offsetParent;
                return t || an
            })
        }
    }), at.each({
        scrollLeft: "pageXOffset",
        scrollTop: "pageYOffset"
    }, function(t, e) {
        var n = /Y/.test(e);
        at.fn[t] = function(i) {
            return At(this, function(t, i, o) {
                var a = V(t);
                return void 0 === o ? a ? e in a ? a[e] : a.document.documentElement[i] : t[i] : void(a ? a.scrollTo(n ? at(a).scrollLeft() : o, n ? o : at(a).scrollTop()) : t[i] = o)
            }, t, i, arguments.length, null)
        }
    }), at.each(["top", "left"], function(t, e) {
        at.cssHooks[e] = S(it.pixelPosition, function(t, n) {
            return n ? (n = ne(t, e), oe.test(n) ? at(t).position()[e] + "px" : n) : void 0
        })
    }), at.each({
        Height: "height",
        Width: "width"
    }, function(t, e) {
        at.each({
            padding: "inner" + t,
            content: e,
            "": "outer" + t
        }, function(n, i) {
            at.fn[i] = function(i, o) {
                var a = arguments.length && (n || "boolean" != typeof i),
                    s = n || (i === !0 || o === !0 ? "margin" : "border");
                return At(this, function(e, n, i) {
                    var o;
                    return at.isWindow(e) ? e.document.documentElement["client" + t] : 9 === e.nodeType ? (o = e.documentElement, Math.max(e.body["scroll" + t], o["scroll" + t], e.body["offset" + t], o["offset" + t], o["client" + t])) : void 0 === i ? at.css(e, n, s) : at.style(e, n, i, s)
                }, e, a ? i : void 0, a, null)
            }
        })
    }), at.fn.size = function() {
        return this.length
    }, at.fn.andSelf = at.fn.addBack, "function" == typeof define && define.amd && define("jquery", [], function() {
        return at
    });
    var sn = t.jQuery,
        rn = t.$;
    return at.noConflict = function(e) {
        return t.$ === at && (t.$ = rn), e && t.jQuery === at && (t.jQuery = sn), at
    }, typeof e === $t && (t.jQuery = t.$ = at), at
}), void 0 === jQuery.migrateMute && (jQuery.migrateMute = !0),
    function(t, e, n) {
        function i(n) {
            var i = e.console;
            a[n] || (a[n] = !0, t.migrateWarnings.push(n), i && i.warn && !t.migrateMute && (i.warn("JQMIGRATE: " + n), t.migrateTrace && i.trace && i.trace()))
        }

        function o(e, o, a, s) {
            if (Object.defineProperty) try {
                return Object.defineProperty(e, o, {
                    configurable: !0,
                    enumerable: !0,
                    get: function() {
                        return i(s), a
                    },
                    set: function(t) {
                        i(s), a = t
                    }
                }), n
            } catch (r) {}
            t._definePropertyBroken = !0, e[o] = a
        }
        var a = {};
        t.migrateWarnings = [], !t.migrateMute && e.console && e.console.log && e.console.log("JQMIGRATE: Logging is active"), t.migrateTrace === n && (t.migrateTrace = !0), t.migrateReset = function() {
            a = {}, t.migrateWarnings.length = 0
        }, "BackCompat" === document.compatMode && i("jQuery is not compatible with Quirks Mode");
        var s = t("<input/>", {
                size: 1
            }).attr("size") && t.attrFn,
            r = t.attr,
            l = t.attrHooks.value && t.attrHooks.value.get || function() {
                return null
            },
            c = t.attrHooks.value && t.attrHooks.value.set || function() {
                return n
            },
            d = /^(?:input|button)$/i,
            u = /^[238]$/,
            p = /^(?:autofocus|autoplay|async|checked|controls|defer|disabled|hidden|loop|multiple|open|readonly|required|scoped|selected)$/i,
            h = /^(?:checked|selected)$/i;
        o(t, "attrFn", s || {}, "jQuery.attrFn is deprecated"), t.attr = function(e, o, a, l) {
            var c = o.toLowerCase(),
                f = e && e.nodeType;
            return l && (4 > r.length && i("jQuery.fn.attr( props, pass ) is deprecated"), e && !u.test(f) && (s ? o in s : t.isFunction(t.fn[o]))) ? t(e)[o](a) : ("type" === o && a !== n && d.test(e.nodeName) && e.parentNode && i("Can't change the 'type' of an input or button in IE 6/7/8"), !t.attrHooks[c] && p.test(c) && (t.attrHooks[c] = {
                get: function(e, i) {
                    var o, a = t.prop(e, i);
                    return a === !0 || "boolean" != typeof a && (o = e.getAttributeNode(i)) && o.nodeValue !== !1 ? i.toLowerCase() : n
                },
                set: function(e, n, i) {
                    var o;
                    return n === !1 ? t.removeAttr(e, i) : (o = t.propFix[i] || i, o in e && (e[o] = !0), e.setAttribute(i, i.toLowerCase())), i
                }
            }, h.test(c) && i("jQuery.fn.attr('" + c + "') may use property instead of attribute")), r.call(t, e, o, a))
        }, t.attrHooks.value = {
            get: function(t, e) {
                var n = (t.nodeName || "").toLowerCase();
                return "button" === n ? l.apply(this, arguments) : ("input" !== n && "option" !== n && i("jQuery.fn.attr('value') no longer gets properties"), e in t ? t.value : null)
            },
            set: function(t, e) {
                var o = (t.nodeName || "").toLowerCase();
                return "button" === o ? c.apply(this, arguments) : ("input" !== o && "option" !== o && i("jQuery.fn.attr('value', val) no longer sets properties"), t.value = e, n)
            }
        };
        var f, m, g = t.fn.init,
            v = t.parseJSON,
            y = /^([^<]*)(<[\w\W]+>)([^>]*)$/;
        t.fn.init = function(e, n, o) {
            var a;
            return e && "string" == typeof e && !t.isPlainObject(n) && (a = y.exec(t.trim(e))) && a[0] && ("<" !== e.charAt(0) && i("$(html) HTML strings must start with '<' character"), a[3] && i("$(html) HTML text after last tag is ignored"), "#" === a[0].charAt(0) && (i("HTML string cannot start with a '#' character"), t.error("JQMIGRATE: Invalid selector string (XSS)")), n && n.context && (n = n.context), t.parseHTML) ? g.call(this, t.parseHTML(a[2], n, !0), n, o) : g.apply(this, arguments)
        }, t.fn.init.prototype = t.fn, t.parseJSON = function(t) {
            return t || null === t ? v.apply(this, arguments) : (i("jQuery.parseJSON requires a valid JSON string"), null)
        }, t.uaMatch = function(t) {
            t = t.toLowerCase();
            var e = /(chrome)[ \/]([\w.]+)/.exec(t) || /(webkit)[ \/]([\w.]+)/.exec(t) || /(opera)(?:.*version|)[ \/]([\w.]+)/.exec(t) || /(msie) ([\w.]+)/.exec(t) || 0 > t.indexOf("compatible") && /(mozilla)(?:.*? rv:([\w.]+)|)/.exec(t) || [];
            return {
                browser: e[1] || "",
                version: e[2] || "0"
            }
        }, t.browser || (f = t.uaMatch(navigator.userAgent), m = {}, f.browser && (m[f.browser] = !0, m.version = f.version), m.chrome ? m.webkit = !0 : m.webkit && (m.safari = !0), t.browser = m), o(t, "browser", t.browser, "jQuery.browser is deprecated"), t.sub = function() {
            function e(t, n) {
                return new e.fn.init(t, n)
            }
            t.extend(!0, e, this), e.superclass = this, e.fn = e.prototype = this(), e.fn.constructor = e, e.sub = this.sub, e.fn.init = function(i, o) {
                return o && o instanceof t && !(o instanceof e) && (o = e(o)), t.fn.init.call(this, i, o, n)
            }, e.fn.init.prototype = e.fn;
            var n = e(document);
            return i("jQuery.sub() is deprecated"), e
        }, t.ajaxSetup({
            converters: {
                "text json": t.parseJSON
            }
        });
        var b = t.fn.data;
        t.fn.data = function(e) {
            var o, a, s = this[0];
            return !s || "events" !== e || 1 !== arguments.length || (o = t.data(s, e), a = t._data(s, e), o !== n && o !== a || a === n) ? b.apply(this, arguments) : (i("Use of jQuery.fn.data('events') is deprecated"), a)
        };
        var x = /\/(java|ecma)script/i,
            w = t.fn.andSelf || t.fn.addBack;
        t.fn.andSelf = function() {
            return i("jQuery.fn.andSelf() replaced by jQuery.fn.addBack()"), w.apply(this, arguments)
        }, t.clean || (t.clean = function(e, o, a, s) {
            o = o || document, o = !o.nodeType && o[0] || o, o = o.ownerDocument || o, i("jQuery.clean() is deprecated");
            var r, l, c, d, u = [];
            if (t.merge(u, t.buildFragment(e, o).childNodes), a)
                for (c = function(t) {
                        return !t.type || x.test(t.type) ? s ? s.push(t.parentNode ? t.parentNode.removeChild(t) : t) : a.appendChild(t) : n
                    }, r = 0; null != (l = u[r]); r++) t.nodeName(l, "script") && c(l) || (a.appendChild(l), l.getElementsByTagName !== n && (d = t.grep(t.merge([], l.getElementsByTagName("script")), c), u.splice.apply(u, [r + 1, 0].concat(d)), r += d.length));
            return u
        });
        var _ = t.event.add,
            C = t.event.remove,
            $ = t.event.trigger,
            k = t.fn.toggle,
            S = t.fn.live,
            T = t.fn.die,
            E = "ajaxStart|ajaxStop|ajaxSend|ajaxComplete|ajaxError|ajaxSuccess",
            D = RegExp("\\b(?:" + E + ")\\b"),
            A = /(?:^|\s)hover(\.\S+|)\b/,
            j = function(e) {
                return "string" != typeof e || t.event.special.hover ? e : (A.test(e) && i("'hover' pseudo-event is deprecated, use 'mouseenter mouseleave'"), e && e.replace(A, "mouseenter$1 mouseleave$1"))
            };
        t.event.props && "attrChange" !== t.event.props[0] && t.event.props.unshift("attrChange", "attrName", "relatedNode", "srcElement"),
            t.event.dispatch && o(t.event, "handle", t.event.dispatch, "jQuery.event.handle is undocumented and deprecated"), t.event.add = function(t, e, n, o, a) {
                t !== document && D.test(e) && i("AJAX events should be attached to document: " + e), _.call(this, t, j(e || ""), n, o, a)
            }, t.event.remove = function(t, e, n, i, o) {
                C.call(this, t, j(e) || "", n, i, o)
            }, t.fn.error = function() {
                var t = Array.prototype.slice.call(arguments, 0);
                return i("jQuery.fn.error() is deprecated"), t.splice(0, 0, "error"), arguments.length ? this.bind.apply(this, t) : (this.triggerHandler.apply(this, t), this)
            }, t.fn.toggle = function(e, n) {
                if (!t.isFunction(e) || !t.isFunction(n)) return k.apply(this, arguments);
                i("jQuery.fn.toggle(handler, handler...) is deprecated");
                var o = arguments,
                    a = e.guid || t.guid++,
                    s = 0,
                    r = function(n) {
                        var i = (t._data(this, "lastToggle" + e.guid) || 0) % s;
                        return t._data(this, "lastToggle" + e.guid, i + 1), n.preventDefault(), o[i].apply(this, arguments) || !1
                    };
                for (r.guid = a; o.length > s;) o[s++].guid = a;
                return this.click(r)
            }, t.fn.live = function(e, n, o) {
                return i("jQuery.fn.live() is deprecated"), S ? S.apply(this, arguments) : (t(this.context).on(e, this.selector, n, o), this)
            }, t.fn.die = function(e, n) {
                return i("jQuery.fn.die() is deprecated"), T ? T.apply(this, arguments) : (t(this.context).off(e, this.selector || "**", n), this)
            }, t.event.trigger = function(t, e, n, o) {
                return n || D.test(t) || i("Global events are undocumented and deprecated"), $.call(this, t, e, n || document, o)
            }, t.each(E.split("|"), function(e, n) {
                t.event.special[n] = {
                    setup: function() {
                        var e = this;
                        return e !== document && (t.event.add(document, n + "." + t.guid, function() {
                            t.event.trigger(n, null, e, !0)
                        }), t._data(this, n, t.guid++)), !1
                    },
                    teardown: function() {
                        return this !== document && t.event.remove(document, n + "." + t._data(this, n)), !1
                    }
                }
            })
    }(jQuery, window), jQuery.easing.jswing = jQuery.easing.swing, jQuery.extend(jQuery.easing, {
        def: "easeOutQuad",
        swing: function(t, e, n, i, o) {
            return jQuery.easing[jQuery.easing.def](t, e, n, i, o)
        },
        easeInQuad: function(t, e, n, i, o) {
            return i * (e /= o) * e + n
        },
        easeOutQuad: function(t, e, n, i, o) {
            return -i * (e /= o) * (e - 2) + n
        },
        easeInOutQuad: function(t, e, n, i, o) {
            return (e /= o / 2) < 1 ? i / 2 * e * e + n : -i / 2 * (--e * (e - 2) - 1) + n
        },
        easeInCubic: function(t, e, n, i, o) {
            return i * (e /= o) * e * e + n
        },
        easeOutCubic: function(t, e, n, i, o) {
            return i * ((e = e / o - 1) * e * e + 1) + n
        },
        easeInOutCubic: function(t, e, n, i, o) {
            return (e /= o / 2) < 1 ? i / 2 * e * e * e + n : i / 2 * ((e -= 2) * e * e + 2) + n
        },
        easeInQuart: function(t, e, n, i, o) {
            return i * (e /= o) * e * e * e + n
        },
        easeOutQuart: function(t, e, n, i, o) {
            return -i * ((e = e / o - 1) * e * e * e - 1) + n
        },
        easeInOutQuart: function(t, e, n, i, o) {
            return (e /= o / 2) < 1 ? i / 2 * e * e * e * e + n : -i / 2 * ((e -= 2) * e * e * e - 2) + n
        },
        easeInQuint: function(t, e, n, i, o) {
            return i * (e /= o) * e * e * e * e + n
        },
        easeOutQuint: function(t, e, n, i, o) {
            return i * ((e = e / o - 1) * e * e * e * e + 1) + n
        },
        easeInOutQuint: function(t, e, n, i, o) {
            return (e /= o / 2) < 1 ? i / 2 * e * e * e * e * e + n : i / 2 * ((e -= 2) * e * e * e * e + 2) + n
        },
        easeInSine: function(t, e, n, i, o) {
            return -i * Math.cos(e / o * (Math.PI / 2)) + i + n
        },
        easeOutSine: function(t, e, n, i, o) {
            return i * Math.sin(e / o * (Math.PI / 2)) + n
        },
        easeInOutSine: function(t, e, n, i, o) {
            return -i / 2 * (Math.cos(Math.PI * e / o) - 1) + n
        },
        easeInExpo: function(t, e, n, i, o) {
            return 0 == e ? n : i * Math.pow(2, 10 * (e / o - 1)) + n
        },
        easeOutExpo: function(t, e, n, i, o) {
            return e == o ? n + i : i * (-Math.pow(2, -10 * e / o) + 1) + n
        },
        easeInOutExpo: function(t, e, n, i, o) {
            return 0 == e ? n : e == o ? n + i : (e /= o / 2) < 1 ? i / 2 * Math.pow(2, 10 * (e - 1)) + n : i / 2 * (-Math.pow(2, -10 * --e) + 2) + n
        },
        easeInCirc: function(t, e, n, i, o) {
            return -i * (Math.sqrt(1 - (e /= o) * e) - 1) + n
        },
        easeOutCirc: function(t, e, n, i, o) {
            return i * Math.sqrt(1 - (e = e / o - 1) * e) + n
        },
        easeInOutCirc: function(t, e, n, i, o) {
            return (e /= o / 2) < 1 ? -i / 2 * (Math.sqrt(1 - e * e) - 1) + n : i / 2 * (Math.sqrt(1 - (e -= 2) * e) + 1) + n
        },
        easeInElastic: function(t, e, n, i, o) {
            var a = 1.70158,
                s = 0,
                r = i;
            if (0 == e) return n;
            if (1 == (e /= o)) return n + i;
            if (s || (s = .3 * o), r < Math.abs(i)) {
                r = i;
                var a = s / 4
            } else var a = s / (2 * Math.PI) * Math.asin(i / r);
            return -(r * Math.pow(2, 10 * (e -= 1)) * Math.sin((e * o - a) * (2 * Math.PI) / s)) + n
        },
        easeOutElastic: function(t, e, n, i, o) {
            var a = 1.70158,
                s = 0,
                r = i;
            if (0 == e) return n;
            if (1 == (e /= o)) return n + i;
            if (s || (s = .3 * o), r < Math.abs(i)) {
                r = i;
                var a = s / 4
            } else var a = s / (2 * Math.PI) * Math.asin(i / r);
            return r * Math.pow(2, -10 * e) * Math.sin((e * o - a) * (2 * Math.PI) / s) + i + n
        },
        easeInOutElastic: function(t, e, n, i, o) {
            var a = 1.70158,
                s = 0,
                r = i;
            if (0 == e) return n;
            if (2 == (e /= o / 2)) return n + i;
            if (s || (s = o * (.3 * 1.5)), r < Math.abs(i)) {
                r = i;
                var a = s / 4
            } else var a = s / (2 * Math.PI) * Math.asin(i / r);
            return 1 > e ? -.5 * (r * Math.pow(2, 10 * (e -= 1)) * Math.sin((e * o - a) * (2 * Math.PI) / s)) + n : r * Math.pow(2, -10 * (e -= 1)) * Math.sin((e * o - a) * (2 * Math.PI) / s) * .5 + i + n
        },
        easeInBack: function(t, e, n, i, o, a) {
            return void 0 == a && (a = 1.70158), i * (e /= o) * e * ((a + 1) * e - a) + n
        },
        easeOutBack: function(t, e, n, i, o, a) {
            return void 0 == a && (a = 1.70158), i * ((e = e / o - 1) * e * ((a + 1) * e + a) + 1) + n
        },
        easeInOutBack: function(t, e, n, i, o, a) {
            return void 0 == a && (a = 1.70158), (e /= o / 2) < 1 ? i / 2 * (e * e * (((a *= 1.525) + 1) * e - a)) + n : i / 2 * ((e -= 2) * e * (((a *= 1.525) + 1) * e + a) + 2) + n
        },
        easeInBounce: function(t, e, n, i, o) {
            return i - jQuery.easing.easeOutBounce(t, o - e, 0, i, o) + n
        },
        easeOutBounce: function(t, e, n, i, o) {
            return (e /= o) < 1 / 2.75 ? i * (7.5625 * e * e) + n : 2 / 2.75 > e ? i * (7.5625 * (e -= 1.5 / 2.75) * e + .75) + n : 2.5 / 2.75 > e ? i * (7.5625 * (e -= 2.25 / 2.75) * e + .9375) + n : i * (7.5625 * (e -= 2.625 / 2.75) * e + .984375) + n
        },
        easeInOutBounce: function(t, e, n, i, o) {
            return o / 2 > e ? .5 * jQuery.easing.easeInBounce(t, 2 * e, 0, i, o) + n : .5 * jQuery.easing.easeOutBounce(t, 2 * e - o, 0, i, o) + .5 * i + n
        }
    }), $(document).ready(function() {
        $("form").submit(function() {
            $(this).find(".hideOnSubmit").hide()
        }), $.fn.checkboxChange = function(t, e) {
            $(this).prop("checked") && t ? t.call(this) : e && e.call(this), $(this).attr("eventCheckboxChange") || ($(this).on("change", function() {
                $(this).checkboxChange(t, e)
            }), $(this).attr("eventCheckboxChange", !0))
        }, $("a._blank, a.js-new-window").attr("target", "_blank")
    });
var responsiveflag = !1;
if ($(document).ready(function() {
        if (highdpiInit(), responsiveResize(), $(window).resize(responsiveResize), navigator.userAgent.match(/Android/i)) {
            var t = document.querySelector('meta[name="viewport"]');
            t.setAttribute("content", "initial-scale=1.0,maximum-scale=1.0,user-scalable=0,width=device-width,height=device-height"), window.scrollTo(0, 1)
        }
        "undefined" != typeof quickView && quickView && quick_view(), dropDown(), "undefined" == typeof page_name || in_array(page_name, ["index", "product"]) || (bindGrid(), $(document).on("change", ".selectProductSort", function(t) {
            if ("undefined" != typeof request && request) var e = request;
            var n = $(this).val().split(":"),
                i = "";
            "undefined" != typeof e && e && (i += e, "undefined" != typeof n[0] && n[0] && (i += (e.indexOf("?") < 0 ? "?" : "&") + "orderby=" + n[0] + (n[1] ? "&orderway=" + n[1] : ""), "undefined" != typeof n[1] && n[1] && (i += "&orderway=" + n[1])), document.location.href = i)
        }), $(document).on("change", 'select[name="n"]', function() {
            $(this.form).submit()
        }), $(document).on("change", 'select[name="currency_payment"]', function() {
            setCurrency($(this).val())
        })), $(document).on("change", 'select[name="manufacturer_list"], select[name="supplier_list"]', function() {
            "" != this.value && (location.href = this.value)
        }), $(document).on("click", ".back", function(t) {
            t.preventDefault(), history.back()
        }), jQuery.curCSS = jQuery.css, $.prototype.cluetip && $("a.cluetip").cluetip({
            local: !0,
            cursor: "pointer",
            dropShadow: !1,
            dropShadowSteps: 0,
            showTitle: !1,
            tracking: !0,
            sticky: !1,
            mouseOutClose: !0,
            fx: {
                open: "fadeIn",
                openSpeed: "fast"
            }
        }).css("opacity", .8), $.prototype.fancybox && $.extend($.fancybox.defaults.tpl, {
            closeBtn: '<a title="' + FancyboxI18nClose + '" class="fancybox-item fancybox-close" href="javascript:;"></a>',
            next: '<a title="' + FancyboxI18nNext + '" class="fancybox-nav fancybox-next" href="javascript:;"><span></span></a>',
            prev: '<a title="' + FancyboxI18nPrev + '" class="fancybox-nav fancybox-prev" href="javascript:;"><span></span></a>'
        }), $(".alert.alert-danger").on("click", this, function(t) {
            t.offsetX >= 16 && t.offsetX <= 39 && t.offsetY >= 16 && t.offsetY <= 34 && $(this).fadeOut()
        }), "index" == page_name && (screen.width >= 992 && $(".pt_vegamenu .pt_vegamenu_cate").css("display", "block"), setInterval(function() {
            if (screen.width >= 992) {
                var t = parseInt($(".pt_vegamenu_cate").outerHeight());
                $(".slideshow_container").css("min-height", t)
            }
        }, 100)), $(".pt_vmegamenu_title").on("click", function(t) {
            t.stopPropagation();
            var e = $(".pt_vegamenu_cate");
            e.is(":hidden") ? e.slideDown() : e.slideUp(), t.preventDefault()
        });
        var e = document.getElementById("themejs-breadcrumb");
        try {
            if (e)
                for (var n = e.getElementsByClassName("navigation-pipe"), i = 0; i < n.length; i++) n[i].innerHTML = '<i class="icon-angle-right"></i>'
        } catch (o) {}
    }), !jQuery) throw new Error("Bootstrap requires jQuery"); + function(t) {
    "use strict";

    function e() {
        var t = document.createElement("bootstrap"),
            e = {
                WebkitTransition: "webkitTransitionEnd",
                MozTransition: "transitionend",
                OTransition: "oTransitionEnd otransitionend",
                transition: "transitionend"
            };
        for (var n in e)
            if (void 0 !== t.style[n]) return {
                end: e[n]
            }
    }
    t.fn.emulateTransitionEnd = function(e) {
        var n = !1,
            i = this;
        t(this).one(t.support.transition.end, function() {
            n = !0
        });
        var o = function() {
            n || t(i).trigger(t.support.transition.end)
        };
        return setTimeout(o, e), this
    }, t(function() {
        t.support.transition = e()
    })
}(window.jQuery), + function(t) {
    "use strict";
    var e = '[data-dismiss="alert"]',
        n = function(n) {
            t(n).on("click", e, this.close)
        };
    n.prototype.close = function(e) {
        function n() {
            a.trigger("closed.bs.alert").remove()
        }
        var i = t(this),
            o = i.attr("data-target");
        o || (o = i.attr("href"), o = o && o.replace(/.*(?=#[^\s]*$)/, ""));
        var a = t(o);
        e && e.preventDefault(), a.length || (a = i.hasClass("alert") ? i : i.parent()), a.trigger(e = t.Event("close.bs.alert")), e.isDefaultPrevented() || (a.removeClass("in"), t.support.transition && a.hasClass("fade") ? a.one(t.support.transition.end, n).emulateTransitionEnd(150) : n())
    };
    var i = t.fn.alert;
    t.fn.alert = function(e) {
        return this.each(function() {
            var i = t(this),
                o = i.data("bs.alert");
            o || i.data("bs.alert", o = new n(this)), "string" == typeof e && o[e].call(i)
        })
    }, t.fn.alert.Constructor = n, t.fn.alert.noConflict = function() {
        return t.fn.alert = i, this
    }, t(document).on("click.bs.alert.data-api", e, n.prototype.close)
}(window.jQuery), + function(t) {
    "use strict";
    var e = function(n, i) {
        this.$element = t(n), this.options = t.extend({}, e.DEFAULTS, i)
    };
    e.DEFAULTS = {
        loadingText: "loading..."
    }, e.prototype.setState = function(t) {
        var e = "disabled",
            n = this.$element,
            i = n.is("input") ? "val" : "html",
            o = n.data();
        t += "Text", o.resetText || n.data("resetText", n[i]()), n[i](o[t] || this.options[t]), setTimeout(function() {
            "loadingText" == t ? n.addClass(e).attr(e, e) : n.removeClass(e).removeAttr(e)
        }, 0)
    }, e.prototype.toggle = function() {
        var t = this.$element.closest('[data-toggle="buttons"]');
        if (t.length) {
            var e = this.$element.find("input").prop("checked", !this.$element.hasClass("active")).trigger("change");
            "radio" === e.prop("type") && t.find(".active").removeClass("active")
        }
        this.$element.toggleClass("active")
    };
    var n = t.fn.button;
    t.fn.button = function(n) {
        return this.each(function() {
            var i = t(this),
                o = i.data("bs.button"),
                a = "object" == typeof n && n;
            o || i.data("bs.button", o = new e(this, a)), "toggle" == n ? o.toggle() : n && o.setState(n)
        })
    }, t.fn.button.Constructor = e, t.fn.button.noConflict = function() {
        return t.fn.button = n, this
    }, t(document).on("click.bs.button.data-api", "[data-toggle^=button]", function(e) {
        var n = t(e.target);
        n.hasClass("btn") || (n = n.closest(".btn")), n.button("toggle"), e.preventDefault()
    })
}(window.jQuery), + function(t) {
    "use strict";
    var e = function(e, n) {
        this.$element = t(e), this.$indicators = this.$element.find(".carousel-indicators"), this.options = n, this.paused = this.sliding = this.interval = this.$active = this.$items = null, "hover" == this.options.pause && this.$element.on("mouseenter", t.proxy(this.pause, this)).on("mouseleave", t.proxy(this.cycle, this))
    };
    e.DEFAULTS = {
        interval: 5e3,
        pause: "hover",
        wrap: !0
    }, e.prototype.cycle = function(e) {
        return e || (this.paused = !1), this.interval && clearInterval(this.interval), this.options.interval && !this.paused && (this.interval = setInterval(t.proxy(this.next, this), this.options.interval)), this
    }, e.prototype.getActiveIndex = function() {
        return this.$active = this.$element.find(".item.active"), this.$items = this.$active.parent().children(), this.$items.index(this.$active)
    }, e.prototype.to = function(e) {
        var n = this,
            i = this.getActiveIndex();
        return e > this.$items.length - 1 || 0 > e ? void 0 : this.sliding ? this.$element.one("slid", function() {
            n.to(e)
        }) : i == e ? this.pause().cycle() : this.slide(e > i ? "next" : "prev", t(this.$items[e]))
    }, e.prototype.pause = function(e) {
        return e || (this.paused = !0), this.$element.find(".next, .prev").length && t.support.transition.end && (this.$element.trigger(t.support.transition.end), this.cycle(!0)), this.interval = clearInterval(this.interval), this
    }, e.prototype.next = function() {
        return this.sliding ? void 0 : this.slide("next")
    }, e.prototype.prev = function() {
        return this.sliding ? void 0 : this.slide("prev")
    }, e.prototype.slide = function(e, n) {
        var i = this.$element.find(".item.active"),
            o = n || i[e](),
            a = this.interval,
            s = "next" == e ? "left" : "right",
            r = "next" == e ? "first" : "last",
            l = this;
        if (!o.length) {
            if (!this.options.wrap) return;
            o = this.$element.find(".item")[r]()
        }
        this.sliding = !0, a && this.pause();
        var c = t.Event("slide.bs.carousel", {
            relatedTarget: o[0],
            direction: s
        });
        if (!o.hasClass("active")) {
            if (this.$indicators.length && (this.$indicators.find(".active").removeClass("active"), this.$element.one("slid", function() {
                    var e = t(l.$indicators.children()[l.getActiveIndex()]);
                    e && e.addClass("active")
                })), t.support.transition && this.$element.hasClass("slide")) {
                if (this.$element.trigger(c), c.isDefaultPrevented()) return;
                o.addClass(e), o[0].offsetWidth, i.addClass(s), o.addClass(s), i.one(t.support.transition.end, function() {
                    o.removeClass([e, s].join(" ")).addClass("active"), i.removeClass(["active", s].join(" ")), l.sliding = !1, setTimeout(function() {
                        l.$element.trigger("slid")
                    }, 0)
                }).emulateTransitionEnd(600)
            } else {
                if (this.$element.trigger(c), c.isDefaultPrevented()) return;
                i.removeClass("active"), o.addClass("active"), this.sliding = !1, this.$element.trigger("slid")
            }
            return a && this.cycle(), this
        }
    };
    var n = t.fn.carousel;
    t.fn.carousel = function(n) {
        return this.each(function() {
            var i = t(this),
                o = i.data("bs.carousel"),
                a = t.extend({}, e.DEFAULTS, i.data(), "object" == typeof n && n),
                s = "string" == typeof n ? n : a.slide;
            o || i.data("bs.carousel", o = new e(this, a)), "number" == typeof n ? o.to(n) : s ? o[s]() : a.interval && o.pause().cycle()
        })
    }, t.fn.carousel.Constructor = e, t.fn.carousel.noConflict = function() {
        return t.fn.carousel = n, this
    }, t(document).on("click.bs.carousel.data-api", "[data-slide], [data-slide-to]", function(e) {
        var n, i = t(this),
            o = t(i.attr("data-target") || (n = i.attr("href")) && n.replace(/.*(?=#[^\s]+$)/, "")),
            a = t.extend({}, o.data(), i.data()),
            s = i.attr("data-slide-to");
        s && (a.interval = !1), o.carousel(a), (s = i.attr("data-slide-to")) && o.data("bs.carousel").to(s), e.preventDefault()
    }), t(window).on("load", function() {
        t('[data-ride="carousel"]').each(function() {
            var e = t(this);
            e.carousel(e.data())
        })
    })
}(window.jQuery), + function(t) {
    "use strict";
    var e = function(n, i) {
        this.$element = t(n), this.options = t.extend({}, e.DEFAULTS, i), this.transitioning = null, this.options.parent && (this.$parent = t(this.options.parent)), this.options.toggle && this.toggle()
    };
    e.DEFAULTS = {
        toggle: !0
    }, e.prototype.dimension = function() {
        var t = this.$element.hasClass("width");
        return t ? "width" : "height"
    }, e.prototype.show = function() {
        if (!this.transitioning && !this.$element.hasClass("in")) {
            var e = t.Event("show.bs.collapse");
            if (this.$element.trigger(e), !e.isDefaultPrevented()) {
                var n = this.$parent && this.$parent.find("> .panel > .in");
                if (n && n.length) {
                    var i = n.data("bs.collapse");
                    if (i && i.transitioning) return;
                    n.collapse("hide"), i || n.data("bs.collapse", null)
                }
                var o = this.dimension();
                this.$element.removeClass("collapse").addClass("collapsing")[o](0), this.transitioning = 1;
                var a = function() {
                    this.$element.removeClass("collapsing").addClass("in")[o]("auto"), this.transitioning = 0, this.$element.trigger("shown.bs.collapse")
                };
                if (!t.support.transition) return a.call(this);
                var s = t.camelCase(["scroll", o].join("-"));
                this.$element.one(t.support.transition.end, t.proxy(a, this)).emulateTransitionEnd(350)[o](this.$element[0][s])
            }
        }
    }, e.prototype.hide = function() {
        if (!this.transitioning && this.$element.hasClass("in")) {
            var e = t.Event("hide.bs.collapse");
            if (this.$element.trigger(e), !e.isDefaultPrevented()) {
                var n = this.dimension();
                this.$element[n](this.$element[n]())[0].offsetHeight, this.$element.addClass("collapsing").removeClass("collapse").removeClass("in"), this.transitioning = 1;
                var i = function() {
                    this.transitioning = 0, this.$element.trigger("hidden.bs.collapse").removeClass("collapsing").addClass("collapse")
                };
                return t.support.transition ? void this.$element[n](0).one(t.support.transition.end, t.proxy(i, this)).emulateTransitionEnd(350) : i.call(this)
            }
        }
    }, e.prototype.toggle = function() {
        this[this.$element.hasClass("in") ? "hide" : "show"]()
    };
    var n = t.fn.collapse;
    t.fn.collapse = function(n) {
        return this.each(function() {
            var i = t(this),
                o = i.data("bs.collapse"),
                a = t.extend({}, e.DEFAULTS, i.data(), "object" == typeof n && n);
            o || i.data("bs.collapse", o = new e(this, a)), "string" == typeof n && o[n]()
        })
    }, t.fn.collapse.Constructor = e, t.fn.collapse.noConflict = function() {
        return t.fn.collapse = n, this
    }, t(document).on("click.bs.collapse.data-api", "[data-toggle=collapse]", function(e) {
        var n, i = t(this),
            o = i.attr("data-target") || e.preventDefault() || (n = i.attr("href")) && n.replace(/.*(?=#[^\s]+$)/, ""),
            a = t(o),
            s = a.data("bs.collapse"),
            r = s ? "toggle" : i.data(),
            l = i.attr("data-parent"),
            c = l && t(l);
        s && s.transitioning || (c && c.find('[data-toggle=collapse][data-parent="' + l + '"]').not(i).addClass("collapsed"), i[a.hasClass("in") ? "addClass" : "removeClass"]("collapsed")), a.collapse(r)
    })
}(window.jQuery), + function(t) {
    "use strict";

    function e() {
        t(i).remove(), t(o).each(function(e) {
            var i = n(t(this));
            i.hasClass("open") && (i.trigger(e = t.Event("hide.bs.dropdown")), e.isDefaultPrevented() || i.removeClass("open").trigger("hidden.bs.dropdown"))
        })
    }

    function n(e) {
        var n = e.attr("data-target");
        n || (n = e.attr("href"), n = n && /#/.test(n) && n.replace(/.*(?=#[^\s]*$)/, ""));
        var i = n && t(n);
        return i && i.length ? i : e.parent()
    }
    var i = ".dropdown-backdrop",
        o = "[data-toggle=dropdown]",
        a = function(e) {
            t(e).on("click.bs.dropdown", this.toggle)
        };
    a.prototype.toggle = function(i) {
        var o = t(this);
        if (!o.is(".disabled, :disabled")) {
            var a = n(o),
                s = a.hasClass("open");
            if (e(), !s) {
                if ("ontouchstart" in document.documentElement && t('<div class="dropdown-backdrop"/>').insertAfter(t(this)).on("click", e), a.trigger(i = t.Event("show.bs.dropdown")), i.isDefaultPrevented()) return;
                a.toggleClass("open").trigger("shown.bs.dropdown")
            }
            return o.focus(), !1
        }
    }, a.prototype.keydown = function(e) {
        if (/(38|40|27)/.test(e.keyCode)) {
            var i = t(this);
            if (e.preventDefault(), e.stopPropagation(), !i.is(".disabled, :disabled")) {
                var a = n(i),
                    s = a.hasClass("open");
                if (!s || s && 27 == e.keyCode) return 27 == e.which && a.find(o).focus(), i.click();
                var r = t("[role=menu] li:not(.divider):visible a", a);
                if (r.length) {
                    var l = r.index(r.filter(":focus"));
                    38 == e.keyCode && l > 0 && l--, 40 == e.keyCode && l < r.length - 1 && l++, ~l || (l = 0), r.eq(l).focus()
                }
            }
        }
    };
    var s = t.fn.dropdown;
    t.fn.dropdown = function(e) {
        return this.each(function() {
            var n = t(this),
                i = n.data("dropdown");
            i || n.data("dropdown", i = new a(this)), "string" == typeof e && i[e].call(n)
        })
    }, t.fn.dropdown.Constructor = a, t.fn.dropdown.noConflict = function() {
        return t.fn.dropdown = s, this
    }, t(document).on("click.bs.dropdown.data-api", e).on("click.bs.dropdown.data-api", ".dropdown form", function(t) {
        t.stopPropagation()
    }).on("click.bs.dropdown.data-api", o, a.prototype.toggle).on("keydown.bs.dropdown.data-api", o + ", [role=menu]", a.prototype.keydown)
}(window.jQuery), + function(t) {
    "use strict";
    var e = function(e, n) {
        this.options = n, this.$element = t(e).on("click.dismiss.modal", '[data-dismiss="modal"]', t.proxy(this.hide, this)), this.$backdrop = this.isShown = null, this.options.remote && this.$element.load(this.options.remote)
    };
    e.DEFAULTS = {
        backdrop: !0,
        keyboard: !0,
        show: !0
    }, e.prototype.toggle = function(t) {
        return this[this.isShown ? "hide" : "show"](t)
    }, e.prototype.show = function(e) {
        var n = this,
            i = t.Event("show.bs.modal", {
                relatedTarget: e
            });
        this.$element.trigger(i), this.isShown || i.isDefaultPrevented() || (this.isShown = !0, this.escape(), this.backdrop(function() {
            var i = t.support.transition && n.$element.hasClass("fade");
            n.$element.parent().length || n.$element.appendTo(document.body), n.$element.show(), i && n.$element[0].offsetWidth, n.$element.addClass("in").attr("aria-hidden", !1), n.enforceFocus();
            var o = t.Event("shown.bs.modal", {
                relatedTarget: e
            });
            i ? n.$element.one(t.support.transition.end, function() {
                n.$element.focus().trigger(o)
            }).emulateTransitionEnd(300) : n.$element.focus().trigger(o)
        }))
    }, e.prototype.hide = function(e) {
        e && e.preventDefault(), e = t.Event("hide.bs.modal"), this.$element.trigger(e), this.isShown && !e.isDefaultPrevented() && (this.isShown = !1, this.escape(), t(document).off("focusin.bs.modal"), this.$element.removeClass("in").attr("aria-hidden", !0).off("click.dismiss.modal"), t.support.transition && this.$element.hasClass("fade") ? this.$element.one(t.support.transition.end, t.proxy(this.hideModal, this)).emulateTransitionEnd(300) : this.hideModal())
    }, e.prototype.enforceFocus = function() {
        t(document).off("focusin.bs.modal").on("focusin.bs.modal", t.proxy(function(t) {
            this.$element[0] === t.target || this.$element.has(t.target).length || this.$element.focus()
        }, this))
    }, e.prototype.escape = function() {
        this.isShown && this.options.keyboard ? this.$element.on("keyup.dismiss.bs.modal", t.proxy(function(t) {
            27 == t.which && this.hide()
        }, this)) : this.isShown || this.$element.off("keyup.dismiss.bs.modal")
    }, e.prototype.hideModal = function() {
        var t = this;
        this.$element.hide(), this.backdrop(function() {
            t.removeBackdrop(), t.$element.trigger("hidden.bs.modal")
        })
    }, e.prototype.removeBackdrop = function() {
        this.$backdrop && this.$backdrop.remove(), this.$backdrop = null
    }, e.prototype.backdrop = function(e) {
        var n = this.$element.hasClass("fade") ? "fade" : "";
        if (this.isShown && this.options.backdrop) {
            var i = t.support.transition && n;
            if (this.$backdrop = t('<div class="modal-backdrop ' + n + '" />').appendTo(document.body), this.$element.on("click.dismiss.modal", t.proxy(function(t) {
                    t.target === t.currentTarget && ("static" == this.options.backdrop ? this.$element[0].focus.call(this.$element[0]) : this.hide.call(this))
                }, this)), i && this.$backdrop[0].offsetWidth, this.$backdrop.addClass("in"), !e) return;
            i ? this.$backdrop.one(t.support.transition.end, e).emulateTransitionEnd(150) : e()
        } else !this.isShown && this.$backdrop ? (this.$backdrop.removeClass("in"), t.support.transition && this.$element.hasClass("fade") ? this.$backdrop.one(t.support.transition.end, e).emulateTransitionEnd(150) : e()) : e && e()
    };
    var n = t.fn.modal;
    t.fn.modal = function(n, i) {
        return this.each(function() {
            var o = t(this),
                a = o.data("bs.modal"),
                s = t.extend({}, e.DEFAULTS, o.data(), "object" == typeof n && n);
            a || o.data("bs.modal", a = new e(this, s)), "string" == typeof n ? a[n](i) : s.show && a.show(i)
        })
    }, t.fn.modal.Constructor = e, t.fn.modal.noConflict = function() {
        return t.fn.modal = n, this
    }, t(document).on("click.bs.modal.data-api", '[data-toggle="modal"]', function(e) {
        var n = t(this),
            i = n.attr("href"),
            o = t(n.attr("data-target") || i && i.replace(/.*(?=#[^\s]+$)/, "")),
            a = o.data("modal") ? "toggle" : t.extend({
                remote: !/#/.test(i) && i
            }, o.data(), n.data());
        e.preventDefault(), o.modal(a, this).one("hide", function() {
            n.is(":visible") && n.focus()
        })
    }), t(document).on("shown.bs.modal", ".modal", function() {
        t(document.body).addClass("modal-open")
    }).on("hidden.bs.modal", ".modal", function() {
        t(document.body).removeClass("modal-open")
    })
}(window.jQuery), + function(t) {
    "use strict";
    var e = function(t, e) {
        this.type = this.options = this.enabled = this.timeout = this.hoverState = this.$element = null, this.init("tooltip", t, e)
    };
    e.DEFAULTS = {
        animation: !0,
        placement: "top",
        selector: !1,
        template: '<div class="tooltip"><div class="tooltip-arrow"></div><div class="tooltip-inner"></div></div>',
        trigger: "hover focus",
        title: "",
        delay: 0,
        html: !1,
        container: !1
    }, e.prototype.init = function(e, n, i) {
        this.enabled = !0, this.type = e, this.$element = t(n), this.options = this.getOptions(i);
        for (var o = this.options.trigger.split(" "), a = o.length; a--;) {
            var s = o[a];
            if ("click" == s) this.$element.on("click." + this.type, this.options.selector, t.proxy(this.toggle, this));
            else if ("manual" != s) {
                var r = "hover" == s ? "mouseenter" : "focus",
                    l = "hover" == s ? "mouseleave" : "blur";
                this.$element.on(r + "." + this.type, this.options.selector, t.proxy(this.enter, this)), this.$element.on(l + "." + this.type, this.options.selector, t.proxy(this.leave, this))
            }
        }
        this.options.selector ? this._options = t.extend({}, this.options, {
            trigger: "manual",
            selector: ""
        }) : this.fixTitle()
    }, e.prototype.getDefaults = function() {
        return e.DEFAULTS
    }, e.prototype.getOptions = function(e) {
        return e = t.extend({}, this.getDefaults(), this.$element.data(), e), e.delay && "number" == typeof e.delay && (e.delay = {
            show: e.delay,
            hide: e.delay
        }), e
    }, e.prototype.getDelegateOptions = function() {
        var e = {},
            n = this.getDefaults();
        return this._options && t.each(this._options, function(t, i) {
            n[t] != i && (e[t] = i)
        }), e
    }, e.prototype.enter = function(e) {
        var n = e instanceof this.constructor ? e : t(e.currentTarget)[this.type](this.getDelegateOptions()).data("bs." + this.type);
        return clearTimeout(n.timeout), n.options.delay && n.options.delay.show ? (n.hoverState = "in", void(n.timeout = setTimeout(function() {
            "in" == n.hoverState && n.show()
        }, n.options.delay.show))) : n.show()
    }, e.prototype.leave = function(e) {
        var n = e instanceof this.constructor ? e : t(e.currentTarget)[this.type](this.getDelegateOptions()).data("bs." + this.type);
        return clearTimeout(n.timeout), n.options.delay && n.options.delay.hide ? (n.hoverState = "out", void(n.timeout = setTimeout(function() {
            "out" == n.hoverState && n.hide()
        }, n.options.delay.hide))) : n.hide()
    }, e.prototype.show = function() {
        var e = t.Event("show.bs." + this.type);
        if (this.hasContent() && this.enabled) {
            if (this.$element.trigger(e), e.isDefaultPrevented()) return;
            var n = this.tip();
            this.setContent(), this.options.animation && n.addClass("fade");
            var i = "function" == typeof this.options.placement ? this.options.placement.call(this, n[0], this.$element[0]) : this.options.placement,
                o = /\s?auto?\s?/i,
                a = o.test(i);
            a && (i = i.replace(o, "") || "top"), n.detach().css({
                top: 0,
                left: 0,
                display: "block"
            }).addClass(i), this.options.container ? n.appendTo(this.options.container) : n.insertAfter(this.$element);
            var s = this.getPosition(),
                r = n[0].offsetWidth,
                l = n[0].offsetHeight;
            if (a) {
                var c = this.$element.parent(),
                    d = i,
                    u = document.documentElement.scrollTop || document.body.scrollTop,
                    p = "body" == this.options.container ? window.innerWidth : c.outerWidth(),
                    h = "body" == this.options.container ? window.innerHeight : c.outerHeight(),
                    f = "body" == this.options.container ? 0 : c.offset().left;
                i = "bottom" == i && s.top + s.height + l - u > h ? "top" : "top" == i && s.top - u - l < 0 ? "bottom" : "right" == i && s.right + r > p ? "left" : "left" == i && s.left - r < f ? "right" : i, n.removeClass(d).addClass(i)
            }
            var m = this.getCalculatedOffset(i, s, r, l);
            this.applyPlacement(m, i), this.$element.trigger("shown.bs." + this.type)
        }
    }, e.prototype.applyPlacement = function(t, e) {
        var n, i = this.tip(),
            o = i[0].offsetWidth,
            a = i[0].offsetHeight,
            s = parseInt(i.css("margin-top"), 10),
            r = parseInt(i.css("margin-left"), 10);
        isNaN(s) && (s = 0), isNaN(r) && (r = 0), t.top = t.top + s, t.left = t.left + r, i.offset(t).addClass("in");
        var l = i[0].offsetWidth,
            c = i[0].offsetHeight;
        if ("top" == e && c != a && (n = !0, t.top = t.top + a - c), /bottom|top/.test(e)) {
            var d = 0;
            t.left < 0 && (d = -2 * t.left, t.left = 0, i.offset(t), l = i[0].offsetWidth, c = i[0].offsetHeight), this.replaceArrow(d - o + l, l, "left")
        } else this.replaceArrow(c - a, c, "top");
        n && i.offset(t)
    }, e.prototype.replaceArrow = function(t, e, n) {
        this.arrow().css(n, t ? 50 * (1 - t / e) + "%" : "")
    }, e.prototype.setContent = function() {
        var t = this.tip(),
            e = this.getTitle();
        t.find(".tooltip-inner")[this.options.html ? "html" : "text"](e), t.removeClass("fade in top bottom left right")
    }, e.prototype.hide = function() {
        function e() {
            n.detach()
        }
        var n = this.tip(),
            i = t.Event("hide.bs." + this.type);
        return this.$element.trigger(i), i.isDefaultPrevented() ? void 0 : (n.removeClass("in"), t.support.transition && this.$tip.hasClass("fade") ? n.one(t.support.transition.end, e).emulateTransitionEnd(150) : e(), this.$element.trigger("hidden.bs." + this.type), this)
    }, e.prototype.fixTitle = function() {
        var t = this.$element;
        (t.attr("title") || "string" != typeof t.attr("data-original-title")) && t.attr("data-original-title", t.attr("title") || "").attr("title", "")
    }, e.prototype.hasContent = function() {
        return this.getTitle()
    }, e.prototype.getPosition = function() {
        var e = this.$element[0];
        return t.extend({}, "function" == typeof e.getBoundingClientRect ? e.getBoundingClientRect() : {
            width: e.offsetWidth,
            height: e.offsetHeight
        }, this.$element.offset())
    }, e.prototype.getCalculatedOffset = function(t, e, n, i) {
        return "bottom" == t ? {
            top: e.top + e.height,
            left: e.left + e.width / 2 - n / 2
        } : "top" == t ? {
            top: e.top - i,
            left: e.left + e.width / 2 - n / 2
        } : "left" == t ? {
            top: e.top + e.height / 2 - i / 2,
            left: e.left - n
        } : {
            top: e.top + e.height / 2 - i / 2,
            left: e.left + e.width
        }
    }, e.prototype.getTitle = function() {
        var t, e = this.$element,
            n = this.options;
        return t = e.attr("data-original-title") || ("function" == typeof n.title ? n.title.call(e[0]) : n.title)
    }, e.prototype.tip = function() {
        return this.$tip = this.$tip || t(this.options.template)
    }, e.prototype.arrow = function() {
        return this.$arrow = this.$arrow || this.tip().find(".tooltip-arrow")
    }, e.prototype.validate = function() {
        this.$element[0].parentNode || (this.hide(), this.$element = null, this.options = null)
    }, e.prototype.enable = function() {
        this.enabled = !0
    }, e.prototype.disable = function() {
        this.enabled = !1
    }, e.prototype.toggleEnabled = function() {
        this.enabled = !this.enabled
    }, e.prototype.toggle = function(e) {
        var n = e ? t(e.currentTarget)[this.type](this.getDelegateOptions()).data("bs." + this.type) : this;
        n.tip().hasClass("in") ? n.leave(n) : n.enter(n)
    }, e.prototype.destroy = function() {
        this.hide().$element.off("." + this.type).removeData("bs." + this.type)
    };
    var n = t.fn.tooltip;
    t.fn.tooltip = function(n) {
        return this.each(function() {
            var i = t(this),
                o = i.data("bs.tooltip"),
                a = "object" == typeof n && n;
            o || i.data("bs.tooltip", o = new e(this, a)), "string" == typeof n && o[n]()
        })
    }, t.fn.tooltip.Constructor = e, t.fn.tooltip.noConflict = function() {
        return t.fn.tooltip = n, this
    }
}(window.jQuery), + function(t) {
    "use strict";
    var e = function(t, e) {
        this.init("popover", t, e)
    };
    if (!t.fn.tooltip) throw new Error("Popover requires tooltip.js");
    e.DEFAULTS = t.extend({}, t.fn.tooltip.Constructor.DEFAULTS, {
        placement: "right",
        trigger: "click",
        content: "",
        template: '<div class="popover"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>'
    }), e.prototype = t.extend({}, t.fn.tooltip.Constructor.prototype), e.prototype.constructor = e, e.prototype.getDefaults = function() {
        return e.DEFAULTS
    }, e.prototype.setContent = function() {
        var t = this.tip(),
            e = this.getTitle(),
            n = this.getContent();
        t.find(".popover-title")[this.options.html ? "html" : "text"](e), t.find(".popover-content")[this.options.html ? "html" : "text"](n), t.removeClass("fade top bottom left right in"), t.find(".popover-title").html() || t.find(".popover-title").hide()
    }, e.prototype.hasContent = function() {
        return this.getTitle() || this.getContent()
    }, e.prototype.getContent = function() {
        var t = this.$element,
            e = this.options;
        return t.attr("data-content") || ("function" == typeof e.content ? e.content.call(t[0]) : e.content)
    }, e.prototype.arrow = function() {
        return this.$arrow = this.$arrow || this.tip().find(".arrow")
    }, e.prototype.tip = function() {
        return this.$tip || (this.$tip = t(this.options.template)), this.$tip
    };
    var n = t.fn.popover;
    t.fn.popover = function(n) {
        return this.each(function() {
            var i = t(this),
                o = i.data("bs.popover"),
                a = "object" == typeof n && n;
            o || i.data("bs.popover", o = new e(this, a)), "string" == typeof n && o[n]()
        })
    }, t.fn.popover.Constructor = e, t.fn.popover.noConflict = function() {
        return t.fn.popover = n, this
    }
}(window.jQuery), + function(t) {
    "use strict";

    function e(n, i) {
        var o, a = t.proxy(this.process, this);
        this.$element = t(t(n).is("body") ? window : n), this.$body = t("body"), this.$scrollElement = this.$element.on("scroll.bs.scroll-spy.data-api", a), this.options = t.extend({}, e.DEFAULTS, i), this.selector = (this.options.target || (o = t(n).attr("href")) && o.replace(/.*(?=#[^\s]+$)/, "") || "") + " .nav li > a", this.offsets = t([]), this.targets = t([]), this.activeTarget = null, this.refresh(), this.process()
    }
    e.DEFAULTS = {
        offset: 10
    }, e.prototype.refresh = function() {
        var e = this.$element[0] == window ? "offset" : "position";
        this.offsets = t([]), this.targets = t([]);
        var n = this;
        this.$body.find(this.selector).map(function() {
            var i = t(this),
                o = i.data("target") || i.attr("href"),
                a = /^#\w/.test(o) && t(o);
            return a && a.length && [
                [a[e]().top + (!t.isWindow(n.$scrollElement.get(0)) && n.$scrollElement.scrollTop()), o]
            ] || null
        }).sort(function(t, e) {
            return t[0] - e[0]
        }).each(function() {
            n.offsets.push(this[0]), n.targets.push(this[1])
        })
    }, e.prototype.process = function() {
        var t, e = this.$scrollElement.scrollTop() + this.options.offset,
            n = this.$scrollElement[0].scrollHeight || this.$body[0].scrollHeight,
            i = n - this.$scrollElement.height(),
            o = this.offsets,
            a = this.targets,
            s = this.activeTarget;
        if (e >= i) return s != (t = a.last()[0]) && this.activate(t);
        for (t = o.length; t--;) s != a[t] && e >= o[t] && (!o[t + 1] || e <= o[t + 1]) && this.activate(a[t])
    }, e.prototype.activate = function(e) {
        this.activeTarget = e, t(this.selector).parents(".active").removeClass("active");
        var n = this.selector + '[data-target="' + e + '"],' + this.selector + '[href="' + e + '"]',
            i = t(n).parents("li").addClass("active");
        i.parent(".dropdown-menu").length && (i = i.closest("li.dropdown").addClass("active")),
            i.trigger("activate")
    };
    var n = t.fn.scrollspy;
    t.fn.scrollspy = function(n) {
        return this.each(function() {
            var i = t(this),
                o = i.data("bs.scrollspy"),
                a = "object" == typeof n && n;
            o || i.data("bs.scrollspy", o = new e(this, a)), "string" == typeof n && o[n]()
        })
    }, t.fn.scrollspy.Constructor = e, t.fn.scrollspy.noConflict = function() {
        return t.fn.scrollspy = n, this
    }, t(window).on("load", function() {
        t('[data-spy="scroll"]').each(function() {
            var e = t(this);
            e.scrollspy(e.data())
        })
    })
}(window.jQuery), + function(t) {
    "use strict";
    var e = function(e) {
        this.element = t(e)
    };
    e.prototype.show = function() {
        var e = this.element,
            n = e.closest("ul:not(.dropdown-menu)"),
            i = e.attr("data-target");
        if (i || (i = e.attr("href"), i = i && i.replace(/.*(?=#[^\s]*$)/, "")), !e.parent("li").hasClass("active")) {
            var o = n.find(".active:last a")[0],
                a = t.Event("show.bs.tab", {
                    relatedTarget: o
                });
            if (e.trigger(a), !a.isDefaultPrevented()) {
                var s = t(i);
                this.activate(e.parent("li"), n), this.activate(s, s.parent(), function() {
                    e.trigger({
                        type: "shown.bs.tab",
                        relatedTarget: o
                    })
                })
            }
        }
    }, e.prototype.activate = function(e, n, i) {
        function o() {
            a.removeClass("active").find("> .dropdown-menu > .active").removeClass("active"), e.addClass("active"), s ? (e[0].offsetWidth, e.addClass("in")) : e.removeClass("fade"), e.parent(".dropdown-menu") && e.closest("li.dropdown").addClass("active"), i && i()
        }
        var a = n.find("> .active"),
            s = i && t.support.transition && a.hasClass("fade");
        s ? a.one(t.support.transition.end, o).emulateTransitionEnd(150) : o(), a.removeClass("in")
    };
    var n = t.fn.tab;
    t.fn.tab = function(n) {
        return this.each(function() {
            var i = t(this),
                o = i.data("bs.tab");
            o || i.data("bs.tab", o = new e(this)), "string" == typeof n && o[n]()
        })
    }, t.fn.tab.Constructor = e, t.fn.tab.noConflict = function() {
        return t.fn.tab = n, this
    }, t(document).on("click.bs.tab.data-api", '[data-toggle="tab"], [data-toggle="pill"]', function(e) {
        e.preventDefault(), t(this).tab("show")
    })
}(window.jQuery), + function(t) {
    "use strict";
    var e = function(n, i) {
        this.options = t.extend({}, e.DEFAULTS, i), this.$window = t(window).on("scroll.bs.affix.data-api", t.proxy(this.checkPosition, this)).on("click.bs.affix.data-api", t.proxy(this.checkPositionWithEventLoop, this)), this.$element = t(n), this.affixed = this.unpin = null, this.checkPosition()
    };
    e.RESET = "affix affix-top affix-bottom", e.DEFAULTS = {
        offset: 0
    }, e.prototype.checkPositionWithEventLoop = function() {
        setTimeout(t.proxy(this.checkPosition, this), 1)
    }, e.prototype.checkPosition = function() {
        if (this.$element.is(":visible")) {
            var n = t(document).height(),
                i = this.$window.scrollTop(),
                o = this.$element.offset(),
                a = this.options.offset,
                s = a.top,
                r = a.bottom;
            "object" != typeof a && (r = s = a), "function" == typeof s && (s = a.top()), "function" == typeof r && (r = a.bottom());
            var l = null != this.unpin && i + this.unpin <= o.top ? !1 : null != r && o.top + this.$element.height() >= n - r ? "bottom" : null != s && s >= i ? "top" : !1;
            this.affixed !== l && (this.unpin && this.$element.css("top", ""), this.affixed = l, this.unpin = "bottom" == l ? o.top - i : null, this.$element.removeClass(e.RESET).addClass("affix" + (l ? "-" + l : "")), "bottom" == l && this.$element.offset({
                top: document.body.offsetHeight - r - this.$element.height()
            }))
        }
    };
    var n = t.fn.affix;
    t.fn.affix = function(n) {
        return this.each(function() {
            var i = t(this),
                o = i.data("bs.affix"),
                a = "object" == typeof n && n;
            o || i.data("bs.affix", o = new e(this, a)), "string" == typeof n && o[n]()
        })
    }, t.fn.affix.Constructor = e, t.fn.affix.noConflict = function() {
        return t.fn.affix = n, this
    }, t(window).on("load", function() {
        t('[data-spy="affix"]').each(function() {
            var e = t(this),
                n = e.data();
            n.offset = n.offset || {}, n.offsetBottom && (n.offset.bottom = n.offsetBottom), n.offsetTop && (n.offset.top = n.offsetTop), e.affix(n)
        })
    })
}(window.jQuery),
function(t) {
    var e, n = window.localStorage;
    e = "undefined" == typeof n || "undefined" == typeof window.JSON ? !1 : !0, t.totalStorage = function(e, n, i) {
        return t.totalStorage.impl.init(e, n)
    }, t.totalStorage.setItem = function(e, n) {
        return t.totalStorage.impl.setItem(e, n)
    }, t.totalStorage.getItem = function(e) {
        return t.totalStorage.impl.getItem(e)
    }, t.totalStorage.getAll = function() {
        return t.totalStorage.impl.getAll()
    }, t.totalStorage.deleteItem = function(e) {
        return t.totalStorage.impl.deleteItem(e)
    }, t.totalStorage.impl = {
        init: function(t, e) {
            return "undefined" != typeof e ? this.setItem(t, e) : this.getItem(t)
        },
        setItem: function(i, o) {
            if (!e) try {
                return t.cookie(i, o), o
            } catch (a) {
                console.log("Local Storage not supported by this browser. Install the cookie plugin on your site to take advantage of the same functionality. You can get it at https://github.com/carhartl/jquery-cookie")
            }
            var s = JSON.stringify(o);
            return n.setItem(i, s), this.parseResult(s)
        },
        getItem: function(i) {
            if (!e) try {
                return this.parseResult(t.cookie(i))
            } catch (o) {
                return null
            }
            return this.parseResult(n.getItem(i))
        },
        deleteItem: function(i) {
            if (!e) try {
                return t.cookie(i, null), !0
            } catch (o) {
                return !1
            }
            return n.removeItem(i), !0
        },
        getAll: function() {
            var i = new Array;
            if (e)
                for (var o in n) o.length && i.push({
                    key: o,
                    value: this.parseResult(n.getItem(o))
                });
            else try {
                for (var a = document.cookie.split(";"), o = 0; o < a.length; o++) {
                    var s = a[o].split("="),
                        r = s[0];
                    i.push({
                        key: r,
                        value: this.parseResult(t.cookie(r))
                    })
                }
            } catch (l) {
                return null
            }
            return i
        },
        parseResult: function(t) {
            var e;
            try {
                e = JSON.parse(t), "true" == e && (e = !0), "false" == e && (e = !1), parseFloat(e) == e && "object" != typeof e && (e = parseFloat(e))
            } catch (n) {}
            return e
        }
    }
}(jQuery),
function(t, e, n) {
    "use strict";

    function i(t) {
        var e = Array.prototype.slice.call(arguments, 1);
        return t.prop ? t.prop.apply(t, e) : t.attr.apply(t, e)
    }

    function o(t, e, n) {
        var i, o;
        for (i in n) n.hasOwnProperty(i) && (o = i.replace(/ |$/g, e.eventNamespace), t.bind(o, n[i]))
    }

    function a(t, e, n) {
        o(t, n, {
            focus: function() {
                e.addClass(n.focusClass)
            },
            blur: function() {
                e.removeClass(n.focusClass), e.removeClass(n.activeClass)
            },
            mouseenter: function() {
                e.addClass(n.hoverClass)
            },
            mouseleave: function() {
                e.removeClass(n.hoverClass), e.removeClass(n.activeClass)
            },
            "mousedown touchbegin": function() {
                t.is(":disabled") || e.addClass(n.activeClass)
            },
            "mouseup touchend": function() {
                e.removeClass(n.activeClass)
            }
        })
    }

    function s(t, e) {
        t.removeClass(e.hoverClass + " " + e.focusClass + " " + e.activeClass)
    }

    function r(t, e, n) {
        n ? t.addClass(e) : t.removeClass(e)
    }

    function l(t, e, n) {
        var i = "checked",
            o = e.is(":" + i);
        e.prop ? e.prop(i, o) : o ? e.attr(i, i) : e.removeAttr(i), r(t, n.checkedClass, o)
    }

    function c(t, e, n) {
        r(t, n.disabledClass, e.is(":disabled"))
    }

    function d(t, e, n) {
        switch (n) {
            case "after":
                return t.after(e), t.next();
            case "before":
                return t.before(e), t.prev();
            case "wrap":
                return t.wrap(e), t.parent()
        }
        return null
    }

    function u(t, n, o) {
        var a, s, r;
        return o || (o = {}), o = e.extend({
            bind: {},
            divClass: null,
            divWrap: "wrap",
            spanClass: null,
            spanHtml: null,
            spanWrap: "wrap"
        }, o), a = e("<div />"), s = e("<span />"), n.autoHide && t.is(":hidden") && "none" === t.css("display") && a.hide(), o.divClass && a.addClass(o.divClass), n.wrapperClass && a.addClass(n.wrapperClass), o.spanClass && s.addClass(o.spanClass), r = i(t, "id"), n.useID && r && i(a, "id", n.idPrefix + "-" + r), o.spanHtml && s.html(o.spanHtml), a = d(t, a, o.divWrap), s = d(t, s, o.spanWrap), c(a, t, n), {
            div: a,
            span: s
        }
    }

    function p(t, n) {
        var i;
        return n.wrapperClass ? (i = e("<span />").addClass(n.wrapperClass), i = d(t, i, "wrap")) : null
    }

    function h() {
        var n, i, o, a;
        return a = "rgb(120,2,153)", i = e('<div style="width:0;height:0;color:' + a + '">'), e("body").append(i), o = i.get(0), n = t.getComputedStyle ? t.getComputedStyle(o, "").color : (o.currentStyle || o.style || {}).color, i.remove(), n.replace(/ /g, "") !== a
    }

    function f(t) {
        return t ? e("<span />").text(t).html() : ""
    }

    function m() {
        return navigator.cpuClass && !navigator.product
    }

    function g() {
        return void 0 !== t.XMLHttpRequest ? !0 : !1
    }

    function v(t) {
        var e;
        return t[0].multiple ? !0 : (e = i(t, "size"), !e || 1 >= e ? !1 : !0)
    }

    function y() {
        return !1
    }

    function b(t, e) {
        var n = "none";
        o(t, e, {
            "selectstart dragstart mousedown": y
        }), t.css({
            MozUserSelect: n,
            msUserSelect: n,
            webkitUserSelect: n,
            userSelect: n
        })
    }

    function x(t, e, n) {
        var i = t.val();
        "" === i ? i = n.fileDefaultHtml : (i = i.split(/[\/\\]+/), i = i[i.length - 1]), e.text(i)
    }

    function w(t, e, n) {
        var i, o;
        for (i = [], t.each(function() {
                var t;
                for (t in e) Object.prototype.hasOwnProperty.call(e, t) && (i.push({
                    el: this,
                    name: t,
                    old: this.style[t]
                }), this.style[t] = e[t])
            }), n(); i.length;) o = i.pop(), o.el.style[o.name] = o.old
    }

    function _(t, e) {
        var n;
        n = t.parents(), n.push(t[0]), n = n.not(":visible"), w(n, {
            visibility: "hidden",
            display: "block",
            position: "absolute"
        }, e)
    }

    function C(t, e) {
        return function() {
            t.unwrap().unwrap().unbind(e.eventNamespace)
        }
    }
    var $ = !0,
        k = !1,
        S = [{
            match: function(t) {
                return t.is("a, button, :submit, :reset, input[type='button']")
            },
            apply: function(e, n) {
                var r, l, d, p, h;
                return l = n.submitDefaultHtml, e.is(":reset") && (l = n.resetDefaultHtml), p = e.is("a, button") ? function() {
                    return e.html() || l
                } : function() {
                    return f(i(e, "value")) || l
                }, d = u(e, n, {
                    divClass: n.buttonClass,
                    spanHtml: p()
                }), r = d.div, a(e, r, n), h = !1, o(r, n, {
                    "click touchend": function() {
                        var n, o, a, s;
                        h || e.is(":disabled") || (h = !0, e[0].dispatchEvent ? (n = document.createEvent("MouseEvents"), n.initEvent("click", !0, !0), o = e[0].dispatchEvent(n), e.is("a") && o && (a = i(e, "target"), s = i(e, "href"), a && "_self" !== a ? t.open(s, a) : document.location.href = s)) : e.click(), h = !1)
                    }
                }), b(r, n), {
                    remove: function() {
                        return r.after(e), r.remove(), e.unbind(n.eventNamespace), e
                    },
                    update: function() {
                        s(r, n), c(r, e, n), e.detach(), d.span.html(p()).append(e)
                    }
                }
            }
        }, {
            match: function(t) {
                return t.is(":checkbox")
            },
            apply: function(t, e) {
                var n, i, r;
                return n = u(t, e, {
                    divClass: e.checkboxClass
                }), i = n.div, r = n.span, a(t, i, e), o(t, e, {
                    "click touchend": function() {
                        l(r, t, e)
                    }
                }), l(r, t, e), {
                    remove: C(t, e),
                    update: function() {
                        s(i, e), r.removeClass(e.checkedClass), l(r, t, e), c(i, t, e)
                    }
                }
            }
        }, {
            match: function(t) {
                return t.is(":file")
            },
            apply: function(t, n) {
                function r() {
                    x(t, h, n)
                }
                var l, p, h, f;
                return l = u(t, n, {
                    divClass: n.fileClass,
                    spanClass: n.fileButtonClass,
                    spanHtml: n.fileButtonHtml,
                    spanWrap: "after"
                }), p = l.div, f = l.span, h = e("<span />").html(n.fileDefaultHtml), h.addClass(n.filenameClass), h = d(t, h, "after"), i(t, "size") || i(t, "size", p.width() / 10), a(t, p, n), r(), m() ? o(t, n, {
                    click: function() {
                        t.trigger("change"), setTimeout(r, 0)
                    }
                }) : o(t, n, {
                    change: r
                }), b(h, n), b(f, n), {
                    remove: function() {
                        return h.remove(), f.remove(), t.unwrap().unbind(n.eventNamespace)
                    },
                    update: function() {
                        s(p, n), x(t, h, n), c(p, t, n)
                    }
                }
            }
        }, {
            match: function(t) {
                if (t.is("input")) {
                    var e = (" " + i(t, "type") + " ").toLowerCase(),
                        n = " color date datetime datetime-local email month number password search tel text time url week ";
                    return n.indexOf(e) >= 0
                }
                return !1
            },
            apply: function(t, e) {
                var n, o;
                return n = i(t, "type"), t.addClass(e.inputClass), o = p(t, e), a(t, t, e), e.inputAddTypeAsClass && t.addClass(n), {
                    remove: function() {
                        t.removeClass(e.inputClass), e.inputAddTypeAsClass && t.removeClass(n), o && t.unwrap()
                    },
                    update: y
                }
            }
        }, {
            match: function(t) {
                return t.is(":radio")
            },
            apply: function(t, n) {
                var r, d, p;
                return r = u(t, n, {
                    divClass: n.radioClass
                }), d = r.div, p = r.span, a(t, d, n), o(t, n, {
                    "click touchend": function() {
                        e.uniform.update(e(':radio[name="' + i(t, "name") + '"]'))
                    }
                }), l(p, t, n), {
                    remove: C(t, n),
                    update: function() {
                        s(d, n), l(p, t, n), c(d, t, n)
                    }
                }
            }
        }, {
            match: function(t) {
                return t.is("select") && !v(t) ? !0 : !1
            },
            apply: function(t, n) {
                var i, r, l, d;
                return n.selectAutoWidth && _(t, function() {
                    d = t.width()
                }), i = u(t, n, {
                    divClass: n.selectClass,
                    spanHtml: (t.find(":selected:first") || t.find("option:first")).html(),
                    spanWrap: "before"
                }), r = i.div, l = i.span, n.selectAutoWidth ? _(t, function() {
                    w(e([l[0], r[0]]), {
                        display: "block"
                    }, function() {
                        var t;
                        t = l.outerWidth() - l.width(), r.width(d), l.width(d - t)
                    })
                }) : r.addClass("fixedWidth"), a(t, r, n), o(t, n, {
                    change: function() {
                        l.html(t.find(":selected").html()), r.removeClass(n.activeClass)
                    },
                    "click touchend": function() {
                        var e = t.find(":selected").html();
                        l.html() !== e && t.trigger("change")
                    },
                    keyup: function() {
                        l.html(t.find(":selected").html())
                    }
                }), b(l, n), {
                    remove: function() {
                        return l.remove(), t.unwrap().unbind(n.eventNamespace), t
                    },
                    update: function() {
                        n.selectAutoWidth ? (e.uniform.restore(t), t.uniform(n)) : (s(r, n), l.html(t.find(":selected").html()), c(r, t, n))
                    }
                }
            }
        }, {
            match: function(t) {
                return t.is("select") && v(t) ? !0 : !1
            },
            apply: function(t, e) {
                var n;
                return t.addClass(e.selectMultiClass), n = p(t, e), a(t, t, e), {
                    remove: function() {
                        t.removeClass(e.selectMultiClass), n && t.unwrap()
                    },
                    update: y
                }
            }
        }, {
            match: function(t) {
                return t.is("textarea")
            },
            apply: function(t, e) {
                var n;
                return t.addClass(e.textareaClass), n = p(t, e), a(t, t, e), {
                    remove: function() {
                        t.removeClass(e.textareaClass), n && t.unwrap()
                    },
                    update: y
                }
            }
        }];
    m() && !g() && ($ = !1), e.uniform = {
        defaults: {
            activeClass: "active",
            autoHide: !0,
            buttonClass: "button",
            checkboxClass: "checker",
            checkedClass: "checked",
            disabledClass: "disabled",
            eventNamespace: ".uniform",
            fileButtonClass: "action",
            fileButtonHtml: "Choose File",
            fileClass: "uploader",
            fileDefaultHtml: "No file selected",
            filenameClass: "filename",
            focusClass: "focus",
            hoverClass: "hover",
            idPrefix: "uniform",
            inputAddTypeAsClass: !0,
            inputClass: "uniform-input",
            radioClass: "radio",
            resetDefaultHtml: "Reset",
            resetSelector: !1,
            selectAutoWidth: !0,
            selectClass: "selector",
            selectMultiClass: "uniform-multiselect",
            submitDefaultHtml: "Submit",
            textareaClass: "uniform",
            useID: !0,
            wrapperClass: null
        },
        elements: []
    }, e.fn.uniform = function(n) {
        var i = this;
        return n = e.extend({}, e.uniform.defaults, n), k || (k = !0, h() && ($ = !1)), $ ? (n.resetSelector && e(n.resetSelector).mouseup(function() {
            t.setTimeout(function() {
                e.uniform.update(i)
            }, 10)
        }), this.each(function() {
            var t, i, o, a = e(this);
            if (a.data("uniformed")) return void e.uniform.update(a);
            for (t = 0; t < S.length; t += 1)
                if (i = S[t], i.match(a, n)) return o = i.apply(a, n), a.data("uniformed", o), void e.uniform.elements.push(a.get(0))
        })) : this
    }, e.uniform.restore = e.fn.uniform.restore = function(t) {
        t === n && (t = e.uniform.elements), e(t).each(function() {
            var t, n, i = e(this);
            n = i.data("uniformed"), n && (n.remove(), t = e.inArray(this, e.uniform.elements), t >= 0 && e.uniform.elements.splice(t, 1), i.removeData("uniformed"))
        })
    }, e.uniform.update = e.fn.uniform.update = function(t) {
        t === n && (t = e.uniform.elements), e(t).each(function() {
            var t, n = e(this);
            t = n.data("uniformed"), t && t.update(n, t.options)
        })
    }
}(this, jQuery), "undefined" == typeof isMobile || isMobile || ($(window).load(function() {
        $("select.form-control,input[type='checkbox']:not(.comparator), input[type='radio'],input#id_carrier2, input[type='file']").uniform()
    }), $(window).resize(function() {
        $.uniform.update("select.form-control, input[type='file']")
    })),
    function(t, e, n, i) {
        var o = n("html"),
            a = n(t),
            s = n(e),
            r = n.fancybox = function() {
                r.open.apply(this, arguments)
            },
            l = navigator.userAgent.match(/msie/i),
            c = null,
            d = e.createTouch !== i,
            u = function(t) {
                return t && t.hasOwnProperty && t instanceof n
            },
            p = function(t) {
                return t && "string" === n.type(t)
            },
            h = function(t) {
                return p(t) && 0 < t.indexOf("%")
            },
            f = function(t, e) {
                var n = parseInt(t, 10) || 0;
                return e && h(t) && (n *= r.getViewport()[e] / 100), Math.ceil(n)
            },
            m = function(t, e) {
                return f(t, e) + "px"
            };
        n.extend(r, {
            version: "2.1.5",
            defaults: {
                padding: 15,
                margin: 20,
                width: 800,
                height: 600,
                minWidth: 100,
                minHeight: 100,
                maxWidth: 9999,
                maxHeight: 9999,
                pixelRatio: 1,
                autoSize: !0,
                autoHeight: !1,
                autoWidth: !1,
                autoResize: !0,
                autoCenter: !d,
                fitToView: !0,
                aspectRatio: !1,
                topRatio: .5,
                leftRatio: .5,
                scrolling: "auto",
                wrapCSS: "",
                arrows: !0,
                closeBtn: !0,
                closeClick: !1,
                nextClick: !1,
                mouseWheel: !0,
                autoPlay: !1,
                playSpeed: 3e3,
                preload: 3,
                modal: !1,
                loop: !0,
                ajax: {
                    dataType: "html",
                    headers: {
                        "X-fancyBox": !0
                    }
                },
                iframe: {
                    scrolling: "auto",
                    preload: !0
                },
                swf: {
                    wmode: "transparent",
                    allowfullscreen: "true",
                    allowscriptaccess: "always"
                },
                keys: {
                    next: {
                        13: "left",
                        34: "up",
                        39: "left",
                        40: "up"
                    },
                    prev: {
                        8: "right",
                        33: "down",
                        37: "right",
                        38: "down"
                    },
                    close: [27],
                    play: [32],
                    toggle: [70]
                },
                direction: {
                    next: "left",
                    prev: "right"
                },
                scrollOutside: !0,
                index: 0,
                type: null,
                href: null,
                content: null,
                title: null,
                tpl: {
                    wrap: '<div class="fancybox-wrap" tabIndex="-1"><div class="fancybox-skin"><div class="fancybox-outer"><div class="fancybox-inner"></div></div></div></div>',
                    image: '<img class="fancybox-image" src="{href}" alt="" />',
                    iframe: '<iframe id="fancybox-frame{rnd}" name="fancybox-frame{rnd}" class="fancybox-iframe" frameborder="0" vspace="0" hspace="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen' + (l ? ' allowtransparency="true"' : "") + "></iframe>",
                    error: '<p class="fancybox-error">The requested content cannot be loaded.<br/>Please try again later.</p>',
                    closeBtn: '<a title="Close" class="fancybox-item fancybox-close" href="javascript:;"></a>',
                    next: '<a title="Next" class="fancybox-nav fancybox-next" href="javascript:;"><span></span></a>',
                    prev: '<a title="Previous" class="fancybox-nav fancybox-prev" href="javascript:;"><span></span></a>'
                },
                openEffect: "fade",
                openSpeed: 250,
                openEasing: "swing",
                openOpacity: !0,
                openMethod: "zoomIn",
                closeEffect: "fade",
                closeSpeed: 250,
                closeEasing: "swing",
                closeOpacity: !0,
                closeMethod: "zoomOut",
                nextEffect: "elastic",
                nextSpeed: 250,
                nextEasing: "swing",
                nextMethod: "changeIn",
                prevEffect: "elastic",
                prevSpeed: 250,
                prevEasing: "swing",
                prevMethod: "changeOut",
                helpers: {
                    overlay: !0,
                    title: !0
                },
                onCancel: n.noop,
                beforeLoad: n.noop,
                afterLoad: n.noop,
                beforeShow: n.noop,
                afterShow: n.noop,
                beforeChange: n.noop,
                beforeClose: n.noop,
                afterClose: n.noop
            },
            group: {},
            opts: {},
            previous: null,
            coming: null,
            current: null,
            isActive: !1,
            isOpen: !1,
            isOpened: !1,
            wrap: null,
            skin: null,
            outer: null,
            inner: null,
            player: {
                timer: null,
                isActive: !1
            },
            ajaxLoad: null,
            imgPreload: null,
            transitions: {},
            helpers: {},
            open: function(t, e) {
                return t && (n.isPlainObject(e) || (e = {}), !1 !== r.close(!0)) ? (n.isArray(t) || (t = u(t) ? n(t).get() : [t]), n.each(t, function(o, a) {
                    var s, l, c, d, h, f = {};
                    "object" === n.type(a) && (a.nodeType && (a = n(a)), u(a) ? (f = {
                        href: a.data("fancybox-href") || a.attr("href"),
                        title: a.data("fancybox-title") || a.attr("title"),
                        isDom: !0,
                        element: a
                    }, n.metadata && n.extend(!0, f, a.metadata())) : f = a), s = e.href || f.href || (p(a) ? a : null), l = e.title !== i ? e.title : f.title || "", d = (c = e.content || f.content) ? "html" : e.type || f.type, !d && f.isDom && (d = a.data("fancybox-type"), d || (d = (d = a.prop("class").match(/fancybox\.(\w+)/)) ? d[1] : null)), p(s) && (d || (r.isImage(s) ? d = "image" : r.isSWF(s) ? d = "swf" : "#" === s.charAt(0) ? d = "inline" : p(a) && (d = "html", c = a)), "ajax" === d && (h = s.split(/\s+/, 2), s = h.shift(), h = h.shift())), c || ("inline" === d ? s ? c = n(p(s) ? s.replace(/.*(?=#[^\s]+$)/, "") : s) : f.isDom && (c = a) : "html" === d ? c = s : !d && !s && f.isDom && (d = "inline", c = a)), n.extend(f, {
                        href: s,
                        type: d,
                        content: c,
                        title: l,
                        selector: h
                    }), t[o] = f
                }), r.opts = n.extend(!0, {}, r.defaults, e), e.keys !== i && (r.opts.keys = e.keys ? n.extend({}, r.defaults.keys, e.keys) : !1), r.group = t, r._start(r.opts.index)) : void 0
            },
            cancel: function() {
                var t = r.coming;
                t && !1 !== r.trigger("onCancel") && (r.hideLoading(), r.ajaxLoad && r.ajaxLoad.abort(), r.ajaxLoad = null, r.imgPreload && (r.imgPreload.onload = r.imgPreload.onerror = null), t.wrap && t.wrap.stop(!0, !0).trigger("onReset").remove(), r.coming = null, r.current || r._afterZoomOut(t))
            },
            close: function(t) {
                r.cancel(), !1 !== r.trigger("beforeClose") && (r.unbindEvents(), r.isActive && (r.isOpen && !0 !== t ? (r.isOpen = r.isOpened = !1, r.isClosing = !0, n(".fancybox-item, .fancybox-nav").remove(), r.wrap.stop(!0, !0).removeClass("fancybox-opened"), r.transitions[r.current.closeMethod]()) : (n(".fancybox-wrap").stop(!0).trigger("onReset").remove(), r._afterZoomOut())))
            },
            play: function(t) {
                var e = function() {
                        clearTimeout(r.player.timer)
                    },
                    n = function() {
                        e(), r.current && r.player.isActive && (r.player.timer = setTimeout(r.next, r.current.playSpeed))
                    },
                    i = function() {
                        e(), s.unbind(".player"), r.player.isActive = !1, r.trigger("onPlayEnd")
                    };
                !0 === t || !r.player.isActive && !1 !== t ? r.current && (r.current.loop || r.current.index < r.group.length - 1) && (r.player.isActive = !0, s.bind({
                    "onCancel.player beforeClose.player": i,
                    "onUpdate.player": n,
                    "beforeLoad.player": e
                }), n(), r.trigger("onPlayStart")) : i()
            },
            next: function(t) {
                var e = r.current;
                e && (p(t) || (t = e.direction.next), r.jumpto(e.index + 1, t, "next"))
            },
            prev: function(t) {
                var e = r.current;
                e && (p(t) || (t = e.direction.prev), r.jumpto(e.index - 1, t, "prev"))
            },
            jumpto: function(t, e, n) {
                var o = r.current;
                o && (t = f(t), r.direction = e || o.direction[t >= o.index ? "next" : "prev"], r.router = n || "jumpto", o.loop && (0 > t && (t = o.group.length + t % o.group.length), t %= o.group.length), o.group[t] !== i && (r.cancel(), r._start(t)))
            },
            reposition: function(t, e) {
                var i, o = r.current,
                    a = o ? o.wrap : null;
                a && (i = r._getPosition(e), t && "scroll" === t.type ? (delete i.position, a.stop(!0, !0).animate(i, 200)) : (a.css(i), o.pos = n.extend({}, o.dim, i)))
            },
            update: function(t) {
                var e = t && t.type,
                    n = !e || "orientationchange" === e;
                n && (clearTimeout(c), c = null), r.isOpen && !c && (c = setTimeout(function() {
                    var i = r.current;
                    i && !r.isClosing && (r.wrap.removeClass("fancybox-tmp"), (n || "load" === e || "resize" === e && i.autoResize) && r._setDimension(), "scroll" === e && i.canShrink || r.reposition(t), r.trigger("onUpdate"), c = null)
                }, n && !d ? 0 : 300))
            },
            toggle: function(t) {
                r.isOpen && (r.current.fitToView = "boolean" === n.type(t) ? t : !r.current.fitToView, d && (r.wrap.removeAttr("style").addClass("fancybox-tmp"), r.trigger("onUpdate")), r.update())
            },
            hideLoading: function() {
                s.unbind(".loading"), n("#fancybox-loading").remove()
            },
            showLoading: function() {
                var t, e;
                r.hideLoading(), t = n('<div id="fancybox-loading"><div></div></div>').click(r.cancel).appendTo("body"), s.bind("keydown.loading", function(t) {
                    27 === (t.which || t.keyCode) && (t.preventDefault(), r.cancel())
                }), r.defaults.fixed || (e = r.getViewport(), t.css({
                    position: "absolute",
                    top: .5 * e.h + e.y,
                    left: .5 * e.w + e.x
                }))
            },
            getViewport: function() {
                var e = r.current && r.current.locked || !1,
                    n = {
                        x: a.scrollLeft(),
                        y: a.scrollTop()
                    };
                return e ? (n.w = e[0].clientWidth, n.h = e[0].clientHeight) : (n.w = d && t.innerWidth ? t.innerWidth : a.width(), n.h = d && t.innerHeight ? t.innerHeight : a.height()), n
            },
            unbindEvents: function() {
                r.wrap && u(r.wrap) && r.wrap.unbind(".fb"), s.unbind(".fb"), a.unbind(".fb")
            },
            bindEvents: function() {
                var t, e = r.current;
                e && (a.bind("orientationchange.fb" + (d ? "" : " resize.fb") + (e.autoCenter && !e.locked ? " scroll.fb" : ""), r.update), (t = e.keys) && s.bind("keydown.fb", function(o) {
                    var a = o.which || o.keyCode,
                        s = o.target || o.srcElement;
                    return 27 === a && r.coming ? !1 : void(!o.ctrlKey && !o.altKey && !o.shiftKey && !o.metaKey && (!s || !s.type && !n(s).is("[contenteditable]")) && n.each(t, function(t, s) {
                        return 1 < e.group.length && s[a] !== i ? (r[t](s[a]), o.preventDefault(), !1) : -1 < n.inArray(a, s) ? (r[t](), o.preventDefault(), !1) : void 0
                    }))
                }), n.fn.mousewheel && e.mouseWheel && r.wrap.bind("mousewheel.fb", function(t, i, o, a) {
                    for (var s = n(t.target || null), l = !1; s.length && !l && !s.is(".fancybox-skin") && !s.is(".fancybox-wrap");) l = s[0] && !(s[0].style.overflow && "hidden" === s[0].style.overflow) && (s[0].clientWidth && s[0].scrollWidth > s[0].clientWidth || s[0].clientHeight && s[0].scrollHeight > s[0].clientHeight), s = n(s).parent();
                    0 !== i && !l && 1 < r.group.length && !e.canShrink && (a > 0 || o > 0 ? r.prev(a > 0 ? "down" : "left") : (0 > a || 0 > o) && r.next(0 > a ? "up" : "right"), t.preventDefault())
                }))
            },
            trigger: function(t, e) {
                var i, o = e || r.coming || r.current;
                if (o) {
                    if (n.isFunction(o[t]) && (i = o[t].apply(o, Array.prototype.slice.call(arguments, 1))), !1 === i) return !1;
                    o.helpers && n.each(o.helpers, function(e, i) {
                        i && r.helpers[e] && n.isFunction(r.helpers[e][t]) && r.helpers[e][t](n.extend(!0, {}, r.helpers[e].defaults, i), o)
                    }), s.trigger(t)
                }
            },
            isImage: function(t) {
                return p(t) && t.match(/(^data:image\/.*,)|(\.(jp(e|g|eg)|gif|png|bmp|webp|svg)((\?|#).*)?$)/i)
            },
            isSWF: function(t) {
                return p(t) && t.match(/\.(swf)((\?|#).*)?$/i)
            },
            _start: function(t) {
                var e, i, o = {};
                if (t = f(t), e = r.group[t] || null, !e) return !1;
                if (o = n.extend(!0, {}, r.opts, e), e = o.margin, i = o.padding, "number" === n.type(e) && (o.margin = [e, e, e, e]), "number" === n.type(i) && (o.padding = [i, i, i, i]), o.modal && n.extend(!0, o, {
                        closeBtn: !1,
                        closeClick: !1,
                        nextClick: !1,
                        arrows: !1,
                        mouseWheel: !1,
                        keys: null,
                        helpers: {
                            overlay: {
                                closeClick: !1
                            }
                        }
                    }), o.autoSize && (o.autoWidth = o.autoHeight = !0), "auto" === o.width && (o.autoWidth = !0), "auto" === o.height && (o.autoHeight = !0), o.group = r.group, o.index = t, r.coming = o, !1 === r.trigger("beforeLoad")) r.coming = null;
                else {
                    if (i = o.type, e = o.href, !i) return r.coming = null, r.current && r.router && "jumpto" !== r.router ? (r.current.index = t, r[r.router](r.direction)) : !1;
                    if (r.isActive = !0, ("image" === i || "swf" === i) && (o.autoHeight = o.autoWidth = !1, o.scrolling = "visible"), "image" === i && (o.aspectRatio = !0), "iframe" === i && d && (o.scrolling = "scroll"), o.wrap = n(o.tpl.wrap).addClass("fancybox-" + (d ? "mobile" : "desktop") + " fancybox-type-" + i + " fancybox-tmp " + o.wrapCSS).appendTo(o.parent || "body"), n.extend(o, {
                            skin: n(".fancybox-skin", o.wrap),
                            outer: n(".fancybox-outer", o.wrap),
                            inner: n(".fancybox-inner", o.wrap)
                        }), n.each(["Top", "Right", "Bottom", "Left"], function(t, e) {
                            o.skin.css("padding" + e, m(o.padding[t]))
                        }), r.trigger("onReady"), "inline" === i || "html" === i) {
                        if (!o.content || !o.content.length) return r._error("content")
                    } else if (!e) return r._error("href");
                    "image" === i ? r._loadImage() : "ajax" === i ? r._loadAjax() : "iframe" === i ? r._loadIframe() : r._afterLoad()
                }
            },
            _error: function(t) {
                n.extend(r.coming, {
                    type: "html",
                    autoWidth: !0,
                    autoHeight: !0,
                    minWidth: 0,
                    minHeight: 0,
                    scrolling: "no",
                    hasError: t,
                    content: r.coming.tpl.error
                }), r._afterLoad()
            },
            _loadImage: function() {
                var t = r.imgPreload = new Image;
                t.onload = function() {
                    this.onload = this.onerror = null, r.coming.width = this.width / r.opts.pixelRatio, r.coming.height = this.height / r.opts.pixelRatio, r._afterLoad()
                }, t.onerror = function() {
                    this.onload = this.onerror = null, r._error("image")
                }, t.src = r.coming.href, !0 !== t.complete && r.showLoading()
            },
            _loadAjax: function() {
                var t = r.coming;
                r.showLoading(), r.ajaxLoad = n.ajax(n.extend({}, t.ajax, {
                    url: t.href,
                    error: function(t, e) {
                        r.coming && "abort" !== e ? r._error("ajax", t) : r.hideLoading()
                    },
                    success: function(e, n) {
                        "success" === n && (t.content = e, r._afterLoad())
                    }
                }))
            },
            _loadIframe: function() {
                var t = r.coming,
                    e = n(t.tpl.iframe.replace(/\{rnd\}/g, (new Date).getTime())).attr("scrolling", d ? "auto" : t.iframe.scrolling).attr("src", t.href);
                n(t.wrap).bind("onReset", function() {
                    try {
                        n(this).find("iframe").hide().attr("src", "//about:blank").end().empty()
                    } catch (t) {}
                }), t.iframe.preload && (r.showLoading(), e.one("load", function() {
                    n(this).data("ready", 1), d || n(this).bind("load.fb", r.update), n(this).parents(".fancybox-wrap").width("100%").removeClass("fancybox-tmp").show(), r._afterLoad()
                })), t.content = e.appendTo(t.inner), t.iframe.preload || r._afterLoad()
            },
            _preloadImages: function() {
                var t, e, n = r.group,
                    i = r.current,
                    o = n.length,
                    a = i.preload ? Math.min(i.preload, o - 1) : 0;
                for (e = 1; a >= e; e += 1) t = n[(i.index + e) % o], "image" === t.type && t.href && ((new Image).src = t.href)
            },
            _afterLoad: function() {
                var t, e, i, o, a, s = r.coming,
                    l = r.current;
                if (r.hideLoading(), s && !1 !== r.isActive)
                    if (!1 === r.trigger("afterLoad", s, l)) s.wrap.stop(!0).trigger("onReset").remove(), r.coming = null;
                    else {
                        switch (l && (r.trigger("beforeChange", l), l.wrap.stop(!0).removeClass("fancybox-opened").find(".fancybox-item, .fancybox-nav").remove()), r.unbindEvents(), t = s.content, e = s.type, i = s.scrolling, n.extend(r, {
                            wrap: s.wrap,
                            skin: s.skin,
                            outer: s.outer,
                            inner: s.inner,
                            current: s,
                            previous: l
                        }), o = s.href, e) {
                            case "inline":
                            case "ajax":
                            case "html":
                                s.selector ? t = n("<div>").html(t).find(s.selector) : u(t) && (t.data("fancybox-placeholder") || t.data("fancybox-placeholder", n('<div class="fancybox-placeholder"></div>').insertAfter(t).hide()), t = t.show().detach(), s.wrap.bind("onReset", function() {
                                    n(this).find(t).length && t.hide().replaceAll(t.data("fancybox-placeholder")).data("fancybox-placeholder", !1)
                                }));
                                break;
                            case "image":
                                t = s.tpl.image.replace("{href}", o);
                                break;
                            case "swf":
                                t = '<object id="fancybox-swf" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="100%" height="100%"><param name="movie" value="' + o + '"></param>', a = "", n.each(s.swf, function(e, n) {
                                    t += '<param name="' + e + '" value="' + n + '"></param>', a += " " + e + '="' + n + '"'
                                }), t += '<embed src="' + o + '" type="application/x-shockwave-flash" width="100%" height="100%"' + a + "></embed></object>"
                        }(!u(t) || !t.parent().is(s.inner)) && s.inner.append(t), r.trigger("beforeShow"), s.inner.css("overflow", "yes" === i ? "scroll" : "no" === i ? "hidden" : i), r._setDimension(), r.reposition(), r.isOpen = !1, r.coming = null, r.bindEvents(), r.isOpened ? l.prevMethod && r.transitions[l.prevMethod]() : n(".fancybox-wrap").not(s.wrap).stop(!0).trigger("onReset").remove(), r.transitions[r.isOpened ? s.nextMethod : s.openMethod](), r._preloadImages()
                    }
            },
            _setDimension: function() {
                var t, e, i, o, a, s, l, c, d, u = r.getViewport(),
                    p = 0,
                    g = !1,
                    v = !1,
                    g = r.wrap,
                    y = r.skin,
                    b = r.inner,
                    x = r.current,
                    v = x.width,
                    w = x.height,
                    _ = x.minWidth,
                    C = x.minHeight,
                    $ = x.maxWidth,
                    k = x.maxHeight,
                    S = x.scrolling,
                    T = x.scrollOutside ? x.scrollbarWidth : 0,
                    E = x.margin,
                    D = f(E[1] + E[3]),
                    A = f(E[0] + E[2]);
                if (g.add(y).add(b).width("auto").height("auto").removeClass("fancybox-tmp"), E = f(y.outerWidth(!0) - y.width()), t = f(y.outerHeight(!0) - y.height()), e = D + E, i = A + t, o = h(v) ? (u.w - e) * f(v) / 100 : v, a = h(w) ? (u.h - i) * f(w) / 100 : w, "iframe" === x.type) {
                    if (d = x.content, x.autoHeight && 1 === d.data("ready")) try {
                        d[0].contentWindow.document.location && (b.width(o).height(9999), s = d.contents().find("body"), T && s.css("overflow-x", "hidden"), a = s.outerHeight(!0))
                    } catch (j) {}
                } else(x.autoWidth || x.autoHeight) && (b.addClass("fancybox-tmp"), x.autoWidth || b.width(o), x.autoHeight || b.height(a), x.autoWidth && (o = b.width()), x.autoHeight && (a = b.height()), b.removeClass("fancybox-tmp"));
                if (v = f(o), w = f(a), c = o / a, _ = f(h(_) ? f(_, "w") - e : _), $ = f(h($) ? f($, "w") - e : $), C = f(h(C) ? f(C, "h") - i : C), k = f(h(k) ? f(k, "h") - i : k), s = $, l = k, x.fitToView && ($ = Math.min(u.w - e, $), k = Math.min(u.h - i, k)), e = u.w - D, A = u.h - A, x.aspectRatio ? (v > $ && (v = $, w = f(v / c)), w > k && (w = k, v = f(w * c)), _ > v && (v = _, w = f(v / c)), C > w && (w = C, v = f(w * c))) : (v = Math.max(_, Math.min(v, $)), x.autoHeight && "iframe" !== x.type && (b.width(v), w = b.height()), w = Math.max(C, Math.min(w, k))), x.fitToView)
                    if (b.width(v).height(w), g.width(v + E), u = g.width(), D = g.height(), x.aspectRatio)
                        for (;
                            (u > e || D > A) && v > _ && w > C && !(19 < p++);) w = Math.max(C, Math.min(k, w - 10)), v = f(w * c), _ > v && (v = _, w = f(v / c)), v > $ && (v = $, w = f(v / c)), b.width(v).height(w), g.width(v + E), u = g.width(), D = g.height();
                    else v = Math.max(_, Math.min(v, v - (u - e))), w = Math.max(C, Math.min(w, w - (D - A)));
                T && "auto" === S && a > w && e > v + E + T && (v += T), b.width(v).height(w), g.width(v + E), u = g.width(), D = g.height(), g = (u > e || D > A) && v > _ && w > C, v = x.aspectRatio ? s > v && l > w && o > v && a > w : (s > v || l > w) && (o > v || a > w), n.extend(x, {
                    dim: {
                        width: m(u),
                        height: m(D)
                    },
                    origWidth: o,
                    origHeight: a,
                    canShrink: g,
                    canExpand: v,
                    wPadding: E,
                    hPadding: t,
                    wrapSpace: D - y.outerHeight(!0),
                    skinSpace: y.height() - w
                }), !d && x.autoHeight && w > C && k > w && !v && b.height("auto")
            },
            _getPosition: function(t) {
                var e = r.current,
                    n = r.getViewport(),
                    i = e.margin,
                    o = r.wrap.width() + i[1] + i[3],
                    a = r.wrap.height() + i[0] + i[2],
                    i = {
                        position: "absolute",
                        top: i[0],
                        left: i[3]
                    };
                return e.autoCenter && e.fixed && !t && a <= n.h && o <= n.w ? i.position = "fixed" : e.locked || (i.top += n.y, i.left += n.x), i.top = m(Math.max(i.top, i.top + (n.h - a) * e.topRatio)), i.left = m(Math.max(i.left, i.left + (n.w - o) * e.leftRatio)), i
            },
            _afterZoomIn: function() {
                var t = r.current;
                t && (r.isOpen = r.isOpened = !0, r.wrap.css("overflow", "visible").addClass("fancybox-opened"), r.update(), (t.closeClick || t.nextClick && 1 < r.group.length) && r.inner.css("cursor", "pointer").bind("click.fb", function(e) {
                    !n(e.target).is("a") && !n(e.target).parent().is("a") && (e.preventDefault(), r[t.closeClick ? "close" : "next"]())
                }), t.closeBtn && n(t.tpl.closeBtn).appendTo(r.skin).bind("click.fb", function(t) {
                    t.preventDefault(), r.close()
                }), t.arrows && 1 < r.group.length && ((t.loop || 0 < t.index) && n(t.tpl.prev).appendTo(r.outer).bind("click.fb", r.prev), (t.loop || t.index < r.group.length - 1) && n(t.tpl.next).appendTo(r.outer).bind("click.fb", r.next)), r.trigger("afterShow"), t.loop || t.index !== t.group.length - 1 ? r.opts.autoPlay && !r.player.isActive && (r.opts.autoPlay = !1, r.play()) : r.play(!1))
            },
            _afterZoomOut: function(t) {
                t = t || r.current, n(".fancybox-wrap").trigger("onReset").remove(), n.extend(r, {
                    group: {},
                    opts: {},
                    router: !1,
                    current: null,
                    isActive: !1,
                    isOpened: !1,
                    isOpen: !1,
                    isClosing: !1,
                    wrap: null,
                    skin: null,
                    outer: null,
                    inner: null
                }), r.trigger("afterClose", t)
            }
        }), r.transitions = {
            getOrigPosition: function() {
                var t = r.current,
                    e = t.element,
                    n = t.orig,
                    i = {},
                    o = 50,
                    a = 50,
                    s = t.hPadding,
                    l = t.wPadding,
                    c = r.getViewport();
                return !n && t.isDom && e.is(":visible") && (n = e.find("img:first"), n.length || (n = e)), u(n) ? (i = n.offset(), n.is("img") && (o = n.outerWidth(), a = n.outerHeight())) : (i.top = c.y + (c.h - a) * t.topRatio, i.left = c.x + (c.w - o) * t.leftRatio), ("fixed" === r.wrap.css("position") || t.locked) && (i.top -= c.y, i.left -= c.x), i = {
                    top: m(i.top - s * t.topRatio),
                    left: m(i.left - l * t.leftRatio),
                    width: m(o + l),
                    height: m(a + s)
                }
            },
            step: function(t, e) {
                var n, i, o = e.prop;
                i = r.current;
                var a = i.wrapSpace,
                    s = i.skinSpace;
                ("width" === o || "height" === o) && (n = e.end === e.start ? 1 : (t - e.start) / (e.end - e.start), r.isClosing && (n = 1 - n), i = "width" === o ? i.wPadding : i.hPadding, i = t - i, r.skin[o](f("width" === o ? i : i - a * n)), r.inner[o](f("width" === o ? i : i - a * n - s * n)))
            },
            zoomIn: function() {
                var t = r.current,
                    e = t.pos,
                    i = t.openEffect,
                    o = "elastic" === i,
                    a = n.extend({
                        opacity: 1
                    }, e);
                delete a.position, o ? (e = this.getOrigPosition(), t.openOpacity && (e.opacity = .1)) : "fade" === i && (e.opacity = .1), r.wrap.css(e).animate(a, {
                    duration: "none" === i ? 0 : t.openSpeed,
                    easing: t.openEasing,
                    step: o ? this.step : null,
                    complete: r._afterZoomIn
                })
            },
            zoomOut: function() {
                var t = r.current,
                    e = t.closeEffect,
                    n = "elastic" === e,
                    i = {
                        opacity: .1
                    };
                n && (i = this.getOrigPosition(), t.closeOpacity && (i.opacity = .1)), r.wrap.animate(i, {
                    duration: "none" === e ? 0 : t.closeSpeed,
                    easing: t.closeEasing,
                    step: n ? this.step : null,
                    complete: r._afterZoomOut
                })
            },
            changeIn: function() {
                var t, e = r.current,
                    n = e.nextEffect,
                    i = e.pos,
                    o = {
                        opacity: 1
                    },
                    a = r.direction;
                i.opacity = .1, "elastic" === n && (t = "down" === a || "up" === a ? "top" : "left", "down" === a || "right" === a ? (i[t] = m(f(i[t]) - 200), o[t] = "+=200px") : (i[t] = m(f(i[t]) + 200), o[t] = "-=200px")),
                    "none" === n ? r._afterZoomIn() : r.wrap.css(i).animate(o, {
                        duration: e.nextSpeed,
                        easing: e.nextEasing,
                        complete: r._afterZoomIn
                    })
            },
            changeOut: function() {
                var t = r.previous,
                    e = t.prevEffect,
                    i = {
                        opacity: .1
                    },
                    o = r.direction;
                "elastic" === e && (i["down" === o || "up" === o ? "top" : "left"] = ("up" === o || "left" === o ? "-" : "+") + "=200px"), t.wrap.animate(i, {
                    duration: "none" === e ? 0 : t.prevSpeed,
                    easing: t.prevEasing,
                    complete: function() {
                        n(this).trigger("onReset").remove()
                    }
                })
            }
        }, r.helpers.overlay = {
            defaults: {
                closeClick: !0,
                speedOut: 200,
                showEarly: !0,
                css: {},
                locked: !d,
                fixed: !0
            },
            overlay: null,
            fixed: !1,
            el: n("html"),
            create: function(t) {
                t = n.extend({}, this.defaults, t), this.overlay && this.close(), this.overlay = n('<div class="fancybox-overlay"></div>').appendTo(r.coming ? r.coming.parent : t.parent), this.fixed = !1, t.fixed && r.defaults.fixed && (this.overlay.addClass("fancybox-overlay-fixed"), this.fixed = !0)
            },
            open: function(t) {
                var e = this;
                t = n.extend({}, this.defaults, t), this.overlay ? this.overlay.unbind(".overlay").width("auto").height("auto") : this.create(t), this.fixed || (a.bind("resize.overlay", n.proxy(this.update, this)), this.update()), t.closeClick && this.overlay.bind("click.overlay", function(t) {
                    return n(t.target).hasClass("fancybox-overlay") ? (r.isActive ? r.close() : e.close(), !1) : void 0
                }), this.overlay.css(t.css).show()
            },
            close: function() {
                var t, e;
                a.unbind("resize.overlay"), this.el.hasClass("fancybox-lock") && (n(".fancybox-margin").removeClass("fancybox-margin"), t = a.scrollTop(), e = a.scrollLeft(), this.el.removeClass("fancybox-lock"), a.scrollTop(t).scrollLeft(e)), n(".fancybox-overlay").remove().hide(), n.extend(this, {
                    overlay: null,
                    fixed: !1
                })
            },
            update: function() {
                var t, n = "100%";
                this.overlay.width(n).height("100%"), l ? (t = Math.max(e.documentElement.offsetWidth, e.body.offsetWidth), s.width() > t && (n = s.width())) : s.width() > a.width() && (n = s.width()), this.overlay.width(n).height(s.height())
            },
            onReady: function(t, e) {
                var i = this.overlay;
                n(".fancybox-overlay").stop(!0, !0), i || this.create(t), t.locked && this.fixed && e.fixed && (i || (this.margin = s.height() > a.height() ? n("html").css("margin-right").replace("px", "") : !1), e.locked = this.overlay.append(e.wrap), e.fixed = !1), !0 === t.showEarly && this.beforeShow.apply(this, arguments)
            },
            beforeShow: function(t, e) {
                var i, o;
                e.locked && (!1 !== this.margin && (n("*").filter(function() {
                    return "fixed" === n(this).css("position") && !n(this).hasClass("fancybox-overlay") && !n(this).hasClass("fancybox-wrap")
                }).addClass("fancybox-margin"), this.el.addClass("fancybox-margin")), i = a.scrollTop(), o = a.scrollLeft(), this.el.addClass("fancybox-lock"), a.scrollTop(i).scrollLeft(o)), this.open(t)
            },
            onUpdate: function() {
                this.fixed || this.update()
            },
            afterClose: function(t) {
                this.overlay && !r.coming && this.overlay.fadeOut(t.speedOut, n.proxy(this.close, this))
            }
        }, r.helpers.title = {
            defaults: {
                type: "float",
                position: "bottom"
            },
            beforeShow: function(t) {
                var e = r.current,
                    i = e.title,
                    o = t.type;
                if (n.isFunction(i) && (i = i.call(e.element, e)), p(i) && "" !== n.trim(i)) {
                    switch (e = n('<div class="fancybox-title fancybox-title-' + o + '-wrap">' + i + "</div>"), o) {
                        case "inside":
                            o = r.skin;
                            break;
                        case "outside":
                            o = r.wrap;
                            break;
                        case "over":
                            o = r.inner;
                            break;
                        default:
                            o = r.skin, e.appendTo("body"), l && e.width(e.width()), e.wrapInner('<span class="child"></span>'), r.current.margin[2] += Math.abs(f(e.css("margin-bottom")))
                    }
                    e["top" === t.position ? "prependTo" : "appendTo"](o)
                }
            }
        }, n.fn.fancybox = function(t) {
            var e, i = n(this),
                o = this.selector || "",
                a = function(a) {
                    var s, l, c = n(this).blur(),
                        d = e;
                    !a.ctrlKey && !a.altKey && !a.shiftKey && !a.metaKey && !c.is(".fancybox-wrap") && (s = t.groupAttr || "data-fancybox-group", l = c.attr(s), l || (s = "rel", l = c.get(0)[s]), l && "" !== l && "nofollow" !== l && (c = o.length ? n(o) : i, c = c.filter("[" + s + '="' + l + '"]'), d = c.index(this)), t.index = d, !1 !== r.open(c, t) && a.preventDefault())
                };
            return t = t || {}, e = t.index || 0, o && !1 !== t.live ? s.undelegate(o, "click.fb-start").delegate(o + ":not('.fancybox-item, .fancybox-nav')", "click.fb-start", a) : i.unbind("click.fb-start").bind("click.fb-start", a), this.filter("[data-fancybox-start=1]").trigger("click"), this
        }, s.ready(function() {
            var e, a;
            if (n.scrollbarWidth === i && (n.scrollbarWidth = function() {
                    var t = n('<div style="width:50px;height:50px;overflow:auto"><div/></div>').appendTo("body"),
                        e = t.children(),
                        e = e.innerWidth() - e.height(99).innerWidth();
                    return t.remove(), e
                }), n.support.fixedPosition === i) {
                e = n.support, a = n('<div style="position:fixed;top:20px;"></div>').appendTo("body");
                var s = 20 === a[0].offsetTop || 15 === a[0].offsetTop;
                a.remove(), e.fixedPosition = s
            }
            n.extend(r.defaults, {
                scrollbarWidth: n.scrollbarWidth(),
                fixed: n.support.fixedPosition,
                parent: n("body")
            }), e = n(t).width(), o.addClass("fancybox-lock-test"), a = n(t).width(), o.removeClass("fancybox-lock-test"), n("<style type='text/css'>.fancybox-margin{margin-right:" + (a - e) + "px;}</style>").appendTo("head")
        })
    }(window, document, jQuery), $(document).ready(function() {
        $(document).on("click", ".add_to_compare", function(t) {
            t.preventDefault(), "undefined" != typeof addToCompare && addToCompare(parseInt($(this).data("id-product")))
        }), reloadProductComparison(), compareButtonsStatusRefresh(), totalCompareButtons()
    }), $(document).ready(function() {
        ajaxCart.overrideButtonsInThePage(), $(document).on("click", ".block_cart_collapse", function(t) {
            t.preventDefault(), ajaxCart.collapse()
        }), $(document).on("click", ".block_cart_expand", function(t) {
            t.preventDefault(), ajaxCart.expand()
        });
        var t = parseInt((new Date).getTime() / 1e3);
        ("undefined" == typeof $(".ajax_cart_quantity").html() || "undefined" != typeof generated_date && null != generated_date && parseInt(generated_date) + 30 < t) && ajaxCart.refresh();
        var e = new HoverWatcher("#header .cart_block"),
            n = new HoverWatcher("#header .shopping_cart"),
            i = !1;
        "ontouchstart" in document.documentElement && (i = !0), $(document).on("click", "#header .shopping_cart > a:first", function(t) {
            return t.preventDefault(), t.stopPropagation(), i ? void($(this).next(".cart_block:visible").length && !e.isHoveringOver() ? $("#header .cart_block").stop(!0, !0).slideUp(450) : (ajaxCart.nb_total_products > 0 || parseInt($(".ajax_cart_quantity").html()) > 0) && $("#header .cart_block").stop(!0, !0).slideDown(450)) : void(window.location.href = $(this).attr("href"))
        }), $("#header .shopping_cart a:first").hover(function() {
            (ajaxCart.nb_total_products > 0 || parseInt($(".ajax_cart_quantity").html()) > 0) && $("#header .cart_block").stop(!0, !0).slideDown(450)
        }, function() {
            setTimeout(function() {
                n.isHoveringOver() || e.isHoveringOver() || $("#header .cart_block").stop(!0, !0).slideUp(450)
            }, 200)
        }), $("#header .cart_block").hover(function() {}, function() {
            setTimeout(function() {
                n.isHoveringOver() || $("#header .cart_block").stop(!0, !0).slideUp(450)
            }, 200)
        }), $(document).on("click", ".delete_voucher", function(t) {
            t.preventDefault(), $.ajax({
                type: "POST",
                headers: {
                    "cache-control": "no-cache"
                },
                async: !0,
                cache: !1,
                url: $(this).attr("href") + "?rand=" + (new Date).getTime()
            }), $(this).parent().parent().remove(), ajaxCart.refresh(), ("order" == $("body").attr("id") || "order-opc" == $("body").attr("id")) && ("undefined" != typeof updateAddressSelection ? updateAddressSelection() : location.reload())
        }), $(document).on("click", "#cart_navigation input", function(t) {
            $(this).prop("disabled", "disabled").addClass("disabled"), $(this).closest("form").get(0).submit()
        }), $(document).on("click", "#layer_cart .cross, #layer_cart .continue, .layer_cart_overlay", function(t) {
            t.preventDefault(), $(".layer_cart_overlay").hide(), $("#layer_cart").fadeOut("fast")
        }), $("#columns #layer_cart, #columns .layer_cart_overlay").detach().prependTo("#columns")
    });
var ajaxCart = {
    nb_total_products: 0,
    overrideButtonsInThePage: function() {
        $(document).off("click", ".ajax_add_to_cart_button").on("click", ".ajax_add_to_cart_button", function(t) {
            t.preventDefault();
            var e = parseInt($(this).data("id-product")),
                n = parseInt($(this).data("id-product-attribute")),
                i = parseInt($(this).data("minimal_quantity"));
            i || (i = 1), "disabled" != $(this).prop("disabled") && ajaxCart.add(e, n, !1, this, i)
        }), $(".cart_block").length && $(document).off("click", "#add_to_cart button").on("click", "#add_to_cart button", function(t) {
            t.preventDefault(), ajaxCart.add($("#product_page_product_id").val(), $("#idCombination").val(), !0, null, $("#quantity_wanted").val(), null)
        }), $(document).off("click", ".cart_block_list .ajax_cart_block_remove_link").on("click", ".cart_block_list .ajax_cart_block_remove_link", function(t) {
            t.preventDefault();
            var e = 0,
                n = 0,
                i = 0,
                o = $($(this).parent().parent()).find("div[data-id^=deleteCustomizableProduct_]"),
                a = !1;
            if (o && $(o).length) {
                var s = o.data("id").split("_");
                "undefined" != typeof s[1] && (e = parseInt(s[1]), n = parseInt(s[2]), "undefined" != typeof s[3] && (i = parseInt(s[3])), "undefined" != typeof s[4] && (a = parseInt(s[4])))
            }
            if (!e) {
                var r = $(this).parent().parent().data("id").replace("cart_block_product_", "");
                r = r.replace("deleteCustomizableProduct_", ""), s = r.split("_"), n = parseInt(s[0]), "undefined" != typeof s[1] && (i = parseInt(s[1])), "undefined" != typeof s[2] && (a = parseInt(s[2]))
            }
            ajaxCart.remove(n, i, e, a)
        })
    },
    expand: function() {
        $(".cart_block_list").hasClass("collapsed") && ($(".cart_block_list.collapsed").slideDown({
            duration: 450,
            complete: function() {
                $(this).parent().show(), $(this).addClass("expanded").removeClass("collapsed")
            }
        }), $.ajax({
            type: "POST",
            headers: {
                "cache-control": "no-cache"
            },
            url: baseDir + "modules/blockcart/blockcart-set-collapse.php?rand=" + (new Date).getTime(),
            async: !0,
            cache: !1,
            data: "ajax_blockcart_display=expand",
            complete: function() {
                $(".block_cart_expand").fadeOut("fast", function() {
                    $(".block_cart_collapse").fadeIn("fast")
                })
            }
        }))
    },
    collapse: function() {
        $(".cart_block_list").hasClass("expanded") && ($(".cart_block_list.expanded").slideUp("slow", function() {
            $(this).addClass("collapsed").removeClass("expanded")
        }), $.ajax({
            type: "POST",
            headers: {
                "cache-control": "no-cache"
            },
            url: baseDir + "modules/blockcart/blockcart-set-collapse.php?rand=" + (new Date).getTime(),
            async: !0,
            cache: !1,
            data: "ajax_blockcart_display=collapse&rand=" + (new Date).getTime(),
            complete: function() {
                $(".block_cart_collapse").fadeOut("fast", function() {
                    $(".block_cart_expand").fadeIn("fast")
                })
            }
        }))
    },
    refresh: function() {},
    updateCartInformation: function(t, e) {
        ajaxCart.updateCart(t), e ? ($("#add_to_cart button").removeProp("disabled").removeClass("disabled"), t.hasError && 0 != t.hasError ? $("#add_to_cart button").removeClass("added") : $("#add_to_cart button").addClass("added")) : $(".ajax_add_to_cart_button").removeProp("disabled")
    },
    updateFancyBox: function() {},
    add: function(t, e, n, i, o, a) {
        if (n && !checkCustomizations()) {
            if (contentOnly) {
                var s = window.document.location.href + "",
                    r = s.replace("content_only=1", "");
                return void(window.parent.document.location.href = r)
            }
            return void($.prototype.fancybox ? $.fancybox.open([{
                type: "inline",
                autoScale: !0,
                minHeight: 30,
                content: '<p class="fancybox-error">' + fieldRequired + "</p>"
            }], {
                padding: 0
            }) : alert(fieldRequired))
        }
        n ? ($("#add_to_cart button").prop("disabled", "disabled").addClass("disabled"), $(".filled").removeClass("filled")) : $(i).prop("disabled", "disabled"), $(".cart_block_list").hasClass("collapsed") && this.expand(), $.ajax({
            type: "POST",
            headers: {
                "cache-control": "no-cache"
            },
            url: baseUri + "?rand=" + (new Date).getTime(),
            async: !0,
            cache: !1,
            dataType: "json",
            data: "controller=cart&add=1&ajax=true&qty=" + (o && null != o ? o : "1") + "&id_product=" + t + "&token=" + static_token + (parseInt(e) && null != e ? "&ipa=" + parseInt(e) : "&id_customization=" + ("undefined" != typeof customizationId ? customizationId : 0)),
            success: function(o, s, r) {
                a && !o.errors && WishlistAddProductCart(a[0], t, e, a[1]), o.hasError ? (contentOnly ? window.parent.ajaxCart.updateCart(o) : ajaxCart.updateCart(o), n ? $("#add_to_cart button").removeProp("disabled").removeClass("disabled") : $(i).removeProp("disabled")) : (contentOnly ? window.parent.ajaxCart.updateCartInformation(o, n) : ajaxCart.updateCartInformation(o, n), o.crossSelling && $(".crossseling").html(o.crossSelling), e ? $(o.products).each(function() {
                    void 0 != this.id && this.id == parseInt(t) && this.idCombination == parseInt(e) && (contentOnly ? window.parent.ajaxCart.updateLayer(this) : ajaxCart.updateLayer(this))
                }) : $(o.products).each(function() {
                    void 0 != this.id && this.id == parseInt(t) && (contentOnly ? window.parent.ajaxCart.updateLayer(this) : ajaxCart.updateLayer(this))
                }), contentOnly && parent.$.fancybox.close()), emptyCustomizations()
            },
            error: function(t, e, o) {
                var a = "Impossible to add the product to the cart.<br/>textStatus: '" + e + "'<br/>errorThrown: '" + o + "'<br/>responseText:<br/>" + t.responseText;
                $.prototype.fancybox ? $.fancybox.open([{
                    type: "inline",
                    autoScale: !0,
                    minHeight: 30,
                    content: '<p class="fancybox-error">' + a + "</p>"
                }], {
                    padding: 0
                }) : alert(a), n ? $("#add_to_cart button").removeProp("disabled").removeClass("disabled") : $(i).removeProp("disabled")
            }
        })
    },
    remove: function(t, e, n, i) {
        $.ajax({
            type: "POST",
            headers: {
                "cache-control": "no-cache"
            },
            url: baseUri + "?rand=" + (new Date).getTime(),
            async: !0,
            cache: !1,
            dataType: "json",
            data: "controller=cart&delete=1&id_product=" + t + "&ipa=" + (null != e && parseInt(e) ? e : "") + (n && null != n ? "&id_customization=" + n : "") + "&id_address_delivery=" + i + "&token=" + static_token + "&ajax=true",
            success: function(o) {
                ajaxCart.updateCart(o), ("order" == $("body").attr("id") || "order-opc" == $("body").attr("id")) && deleteProductFromSummary(t + "_" + e + "_" + n + "_" + i)
            },
            error: function() {
                var t = "ERROR: unable to delete the product";
                $.prototype.fancybox ? $.fancybox.open([{
                    type: "inline",
                    autoScale: !0,
                    minHeight: 30,
                    content: t
                }], {
                    padding: 0
                }) : alert(t)
            }
        })
    },
    hideOldProducts: function(t) {
        if ($(".cart_block_list:first dl.products").length > 0) {
            var e = null;
            $(".cart_block_list:first dl.products dt").each(function() {
                var n = $(this).data("id"),
                    i = n.replace("cart_block_product_", ""),
                    o = i.split("_"),
                    a = !1;
                for (aProduct in t.products) t.products[aProduct].id != o[0] || o[1] && t.products[aProduct].idCombination != o[1] || (a = !0, ajaxCart.hideOldProductCustomizations(t.products[aProduct], n));
                if (!a && (e = $(this).data("id"), null != e)) {
                    var i = e.replace("cart_block_product_", ""),
                        o = i.split("_");
                    $('dt[data-id="' + e + '"]').addClass("strike").fadeTo("slow", 0, function() {
                        $(this).slideUp("slow", function() {
                            $(this).remove(), 0 == $(".cart_block:first dl.products dt").length && ($(".ajax_cart_quantity").html("0"), $("#header .cart_block").stop(!0, !0).slideUp(200), $(".cart_block_no_products:hidden").slideDown(450), $(".cart_block dl.products").remove())
                        })
                    }), $('dd[data-id="cart_block_combination_of_' + o[0] + (o[1] ? "_" + o[1] : "") + (o[2] ? "_" + o[2] : "") + '"]').fadeTo("fast", 0, function() {
                        $(this).slideUp("fast", function() {
                            $(this).remove()
                        })
                    })
                }
            })
        }
    },
    hideOldProductCustomizations: function(t, e) {
        var n = $('ul[data-id="customization_' + t.id + "_" + t.idCombination + '"]');
        n.length > 0 && $(n).find("li").each(function() {
            $(this).find("div").each(function() {
                var e = $(this).data("id"),
                    n = e.replace("deleteCustomizableProduct_", ""),
                    i = n.split("_");
                parseInt(t.idCombination) != parseInt(i[2]) || ajaxCart.doesCustomizationStillExist(t, i[0]) || $('div[data-id="' + e + '"]').parent().addClass("strike").fadeTo("slow", 0, function() {
                    $(this).slideUp("slow"), $(this).remove()
                })
            })
        });
        var i = $('.deleteCustomizableProduct[data-id="' + e + '"]').find(".ajax_cart_block_remove_link");
        t.hasCustomizedDatas || i.length || $('div[data-id="' + e + '"] span.remove_link').html('<a class="ajax_cart_block_remove_link" rel="nofollow" href="' + baseUri + "?controller=cart&amp;delete=1&amp;id_product=" + t.id + "&amp;ipa=" + t.idCombination + "&amp;token=" + static_token + '"> </a>'), t.is_gift && $('div[data-id="' + e + '"] span.remove_link').html("")
    },
    doesCustomizationStillExist: function(t, e) {
        var n = !1;
        return $(t.customizedDatas).each(function() {
            return this.customizationId == e ? (n = !0, !1) : void 0
        }), n
    },
    refreshVouchers: function(t) {
        if ("undefined" == typeof t.discounts || 0 == t.discounts.length) $(".vouchers").hide();
        else {
            for ($(".vouchers tbody").html(""), i = 0; i < t.discounts.length; i++)
                if (parseFloat(t.discounts[i].price_float) > 0) {
                    var e = "";
                    t.discounts[i].code.length && (e = '<a class="delete_voucher" href="' + t.discounts[i].link + '" title="' + delete_txt + '"><i class="icon-remove-sign"></i></a>'), $(".vouchers tbody").append($('<tr class="bloc_cart_voucher" data-id="bloc_cart_voucher_' + t.discounts[i].id + '"> <td class="quantity">1x</td> <td class="name" title="' + t.discounts[i].description + '">' + t.discounts[i].name + '</td> <td class="price">-' + t.discounts[i].price + '</td> <td class="delete">' + e + "</td></tr>"))
                }
            $(".vouchers").show()
        }
    },
    updateProductQuantity: function(t, e) {
        $("dt[data-id=cart_block_product_" + t.id + "_" + (t.idCombination ? t.idCombination : "0") + "_" + (t.idAddressDelivery ? t.idAddressDelivery : "0") + "] .quantity").fadeTo("fast", 0, function() {
            $(this).text(e), $(this).fadeTo("fast", 1, function() {
                $(this).fadeTo("fast", 0, function() {
                    $(this).fadeTo("fast", 1, function() {
                        $(this).fadeTo("fast", 0, function() {
                            $(this).fadeTo("fast", 1)
                        })
                    })
                })
            })
        })
    },
    displayNewProducts: function(t) {
        $(t.products).each(function() {
            if (void 0 != this.id) {
                0 == $(".cart_block:first dl.products").length && ($(".cart_block_no_products").before('<dl class="products"></dl>'), $(".cart_block_no_products").hide());
                var t = this.id + "_" + (this.idCombination ? this.idCombination : "0") + "_" + (this.idAddressDelivery ? this.idAddressDelivery : "0"),
                    e = this.id + "_" + (this.idCombination ? this.idCombination : "0");
                if (0 == $('dt[data-id="cart_block_product_' + t + '"]').length) {
                    var n = parseInt(this.id),
                        i = (this.hasAttributes ? parseInt(this.attributes) : 0, '<dt class="unvisible" data-id="cart_block_product_' + t + '">'),
                        o = $.trim($("<span />").html(this.name).text());
                    o = o.length > 12 ? o.substring(0, 10) + "..." : o, i += '<a class="cart-images" href="' + this.link + '" title="' + o + '"><img  src="' + this.image_cart + '" alt="' + this.name + '"></a>', i += '<div class="cart-info"><div class="product-name"><span class="quantity-formated"><span class="quantity">' + this.quantity + '</span>&nbsp;x&nbsp;</span><a href="' + this.link + '" title="' + this.name + '" class="cart_block_product_name">' + o + "</a></div>", this.hasAttributes && (i += '<div class="product-atributes"><a href="' + this.link + '" title="' + this.name + '">' + this.attributes + "</a></div>"), "undefined" != typeof freeProductTranslation && (i += '<span class="price">' + (parseFloat(this.price_float) > 0 ? this.priceByLine : freeProductTranslation) + "</span></div>"), i += "undefined" == typeof this.is_gift || 0 == this.is_gift ? '<span class="remove_link"><a rel="nofollow" class="ajax_cart_block_remove_link" href="' + baseUri + "?controller=cart&amp;delete=1&amp;id_product=" + n + "&amp;token=" + static_token + (this.hasAttributes ? "&amp;ipa=" + parseInt(this.idCombination) : "") + '"> </a></span>' : '<span class="remove_link"></span>', i += "</dt>", this.hasAttributes && (i += '<dd data-id="cart_block_combination_of_' + t + '" class="unvisible">'), this.hasCustomizedDatas && (i += ajaxCart.displayNewCustomizedDatas(this)), this.hasAttributes && (i += "</dd>"), $(".cart_block dl.products").append(i)
                } else {
                    var a = this;
                    ($.trim($('dt[data-id="cart_block_product_' + t + '"] .quantity').html()) != a.quantity || $.trim($('dt[data-id="cart_block_product_' + t + '"] .price').html()) != a.priceByLine) && (this.is_gift ? $('dt[data-id="cart_block_product_' + t + '"] .price').html(freeProductTranslation) : $('dt[data-id="cart_block_product_' + t + '"] .price').text(a.priceByLine), ajaxCart.updateProductQuantity(a, a.quantity), a.hasCustomizedDatas && (customizationFormatedDatas = ajaxCart.displayNewCustomizedDatas(a), $('ul[data-id="customization_' + e + '"]').length ? ($('ul[data-id="customization_' + e + '"]').html(""), $('ul[data-id="customization_' + e + '"]').append(customizationFormatedDatas)) : a.hasAttributes ? $('dd[data-id="cart_block_combination_of_' + t + '"]').append(customizationFormatedDatas) : $(".cart_block dl.products").append(customizationFormatedDatas)))
                }
                $(".cart_block dl.products .unvisible").slideDown(450).removeClass("unvisible");
                var s = $('dt[data-id="cart_block_product_' + t + '"]').find("a.ajax_cart_block_remove_link");
                this.hasCustomizedDatas && s.length && $(s).each(function() {
                    $(this).remove()
                })
            }
        })
    },
    displayNewCustomizedDatas: function(t) {
        var e = "",
            n = parseInt(t.id),
            i = "undefined" == typeof t.idCombination ? 0 : parseInt(t.idCombination),
            o = $('ul[data-id="customization_' + n + "_" + i + '"]').length;
        return o || (t.hasAttributes || (e += '<dd data-id="cart_block_combination_of_' + n + '" class="unvisible">'), void 0 == $('ul[data-id="customization_' + n + "_" + i + '"]').val() && (e += '<ul class="cart_block_customizations" data-id="customization_' + n + "_" + i + '">')), $(t.customizedDatas).each(function() {
            var a = 0;
            customizationId = parseInt(this.customizationId), i = "undefined" == typeof t.idCombination ? 0 : parseInt(t.idCombination), e += '<li name="customization"><div class="deleteCustomizableProduct" data-id="deleteCustomizableProduct_' + customizationId + "_" + n + "_" + (i ? i : "0") + '"><a rel="nofollow" class="ajax_cart_block_remove_link" href="' + baseUri + "?controller=cart&amp;delete=1&amp;id_product=" + n + "&amp;ipa=" + i + "&amp;id_customization=" + customizationId + "&amp;token=" + static_token + '"></a></div>', $(this.datas).each(function() {
                this.type == CUSTOMIZE_TEXTFIELD && $(this.datas).each(function() {
                    return 0 == this.index ? (e += " " + this.truncatedValue.replace(/<br \/>/g, " "), a = 1, !1) : void 0
                })
            }), a || (e += customizationIdMessage + customizationId), o || (e += "</li>"), customizationId && ($("#uploadable_files li div.customizationUploadBrowse img").remove(), $("#text_fields input").attr("value", ""))
        }), o || (e += "</ul>", t.hasAttributes || (e += "</dd>")), e
    },
    updateLayer: function(t) {
        $("#layer_cart_product_title").text(t.name), $("#layer_cart_product_attributes").text(""), t.hasAttributes && 1 == t.hasAttributes && $("#layer_cart_product_attributes").html(t.attributes), $("#layer_cart_product_price").text(t.price), $("#layer_cart_product_quantity").text(t.quantity), $(".layer_cart_img").html('<img class="layer_cart_img img-responsive" src="' + t.image + '" alt="' + t.name + '" title="' + t.name + '" />');
        var e = parseInt($(window).scrollTop()) + "px";
        $(".layer_cart_overlay").css("width", "100%"), $(".layer_cart_overlay").css("height", "100%"), $(".layer_cart_overlay").show(), $("#layer_cart").css({
            top: e
        }).fadeIn("fast"), crossselling_serialScroll()
    },
    updateCart: function(t) {
        if (t.hasError) {
            var e = "";
            for (error in t.errors) "indexOf" != error && (e += $("<div />").html(t.errors[error]).text() + "\n");
            $.prototype.fancybox ? $.fancybox.open([{
                type: "inline",
                autoScale: !0,
                minHeight: 30,
                content: '<p class="fancybox-error">' + e + "</p>"
            }], {
                padding: 0
            }) : alert(e)
        } else ajaxCart.updateCartEverywhere(t), ajaxCart.hideOldProducts(t), ajaxCart.displayNewProducts(t), ajaxCart.refreshVouchers(t), $(".cart_block .products dt").removeClass("first_item").removeClass("last_item").removeClass("item"), $(".cart_block .products dt:first").addClass("first_item"), $(".cart_block .products dt:not(:first,:last)").addClass("item"), $(".cart_block .products dt:last").addClass("last_item")
    },
    updateCartEverywhere: function(t) {
        "undefined" == typeof hasDeliveryAddress && (hasDeliveryAddress = !1), parseFloat(t.shippingCostFloat) > 0 ? $(".ajax_cart_shipping_cost").text(t.shippingCost).parent().find(".unvisible").show() : (hasDeliveryAddress || "undefined" != typeof orderProcess && "order-opc" == orderProcess) && "undefined" != typeof freeShippingTranslation ? $(".ajax_cart_shipping_cost").html(freeShippingTranslation) : "undefined" == typeof toBeDetermined || hasDeliveryAddress || $(".ajax_cart_shipping_cost").html(toBeDetermined), t.shippingCostFloat || t.free_ship ? hasDeliveryAddress && !t.isVirtualCart && $(".ajax_cart_shipping_cost").parent().find(".unvisible").show() : $(".ajax_cart_shipping_cost").parent().find(".unvisible").hide(), $(".ajax_cart_tax_cost").text(t.taxCost), $(".cart_block_wrapping_cost").text(t.wrappingCost), $(".ajax_block_cart_total").text(t.total), $(".ajax_block_products_total").text(t.productTotal), $(".ajax_total_price_wt").text(t.total_price_wt), parseFloat(t.freeShippingFloat) > 0 ? ($(".ajax_cart_free_shipping").html(t.freeShipping), $(".freeshipping").fadeIn(0)) : 0 == parseFloat(t.freeShippingFloat) && $(".freeshipping").fadeOut(0), this.nb_total_products = t.nbTotalProducts, $(".ajax_cart_quantity").text(t.nbTotalProducts)
    }
};
! function(t) {
    "use strict";
    t(["jquery"], function(t) {
        function e(e) {
            return t.isFunction(e) || t.isPlainObject(e) ? e : {
                top: e,
                left: e
            }
        }
        var n = t.scrollTo = function(e, n, i) {
            return t(window).scrollTo(e, n, i)
        };
        return n.defaults = {
            axis: "xy",
            duration: 0,
            limit: !0
        }, n.window = function(e) {
            return t(window)._scrollable()
        }, t.fn._scrollable = function() {
            return this.map(function() {
                var e = this,
                    n = !e.nodeName || -1 != t.inArray(e.nodeName.toLowerCase(), ["iframe", "#document", "html", "body"]);
                if (!n) return e;
                var i = (e.contentWindow || e).document || e.ownerDocument || e;
                return /webkit/i.test(navigator.userAgent) || "BackCompat" == i.compatMode ? i.body : i.documentElement
            })
        }, t.fn.scrollTo = function(i, o, a) {
            return "object" == typeof o && (a = o, o = 0), "function" == typeof a && (a = {
                onAfter: a
            }), "max" == i && (i = 9e9), a = t.extend({}, n.defaults, a), o = o || a.duration, a.queue = a.queue && a.axis.length > 1, a.queue && (o /= 2), a.offset = e(a.offset), a.over = e(a.over), this._scrollable().each(function() {
                function s(t) {
                    c.animate(u, o, a.easing, t && function() {
                        t.call(this, d, a)
                    })
                }
                if (null != i) {
                    var r, l = this,
                        c = t(l),
                        d = i,
                        u = {},
                        p = c.is("html,body");
                    switch (typeof d) {
                        case "number":
                        case "string":
                            if (/^([+-]=?)?\d+(\.\d+)?(px|%)?$/.test(d)) {
                                d = e(d);
                                break
                            }
                            if (d = p ? t(d) : t(d, this), !d.length) return;
                        case "object":
                            (d.is || d.style) && (r = (d = t(d)).offset())
                    }
                    var h = t.isFunction(a.offset) && a.offset(l, d) || a.offset;
                    t.each(a.axis.split(""), function(t, e) {
                        var i = "x" == e ? "Left" : "Top",
                            o = i.toLowerCase(),
                            f = "scroll" + i,
                            m = l[f],
                            g = n.max(l, e);
                        if (r) u[f] = r[o] + (p ? 0 : m - c.offset()[o]), a.margin && (u[f] -= parseInt(d.css("margin" + i)) || 0, u[f] -= parseInt(d.css("border" + i + "Width")) || 0), u[f] += h[o] || 0, a.over[o] && (u[f] += d["x" == e ? "width" : "height"]() * a.over[o]);
                        else {
                            var v = d[o];
                            u[f] = v.slice && "%" == v.slice(-1) ? parseFloat(v) / 100 * g : v
                        }
                        a.limit && /^\d+$/.test(u[f]) && (u[f] = u[f] <= 0 ? 0 : Math.min(u[f], g)), !t && a.queue && (m != u[f] && s(a.onAfterFirst), delete u[f])
                    }), s(a.onAfter)
                }
            }).end()
        }, n.max = function(e, n) {
            var i = "x" == n ? "Width" : "Height",
                o = "scroll" + i;
            if (!t(e).is("html,body")) return e[o] - t(e)[i.toLowerCase()]();
            var a = "client" + i,
                s = e.ownerDocument.documentElement,
                r = e.ownerDocument.body;
            return Math.max(s[o], r[o]) - Math.min(s[a], r[a])
        }, n
    })
}("function" == typeof define && define.amd ? define : function(t, e) {
    "undefined" != typeof module && module.exports ? module.exports = e(require("jquery")) : e(jQuery)
}),
function(t) {
    var e = t.serialScroll = function(e) {
        return t(window).serialScroll(e)
    };
    e.defaults = {
        duration: 1e3,
        axis: "x",
        event: "click",
        start: 0,
        step: 1,
        lock: !0,
        cycle: !0,
        constant: !0
    }, t.fn.serialScroll = function(n) {
        return this.each(function() {
            function i(t) {
                t.data += y, o(t, this)
            }

            function o(t, e) {
                isNaN(e) || (t.data = e, e = g);
                var n, i = t.data,
                    o = t.type,
                    l = d.exclude ? r().slice(0, -d.exclude) : r(),
                    u = l.length,
                    h = l[i],
                    f = d.duration;
                if (o && t.preventDefault(), b && (s(), c = setTimeout(a, d.interval)), !h) {
                    if (n = 0 > i ? 0 : u - 1, y != n) i = n;
                    else {
                        if (!d.cycle) return;
                        i = u - n - 1
                    }
                    h = l[i]
                }!h || d.lock && m.is(":animated") || o && d.onBefore && d.onBefore(t, h, m, r(), i) === !1 || (d.stop && m.queue("fx", []).stop(), d.constant && (f = Math.abs(f / p * (y - i))), m.scrollTo(h, f, d).trigger("notify.serialScroll", [i]))
            }

            function a() {
                m.trigger("next.serialScroll")
            }

            function s() {
                clearTimeout(c)
            }

            function r() {
                return t(v, g)
            }

            function l(t) {
                if (!isNaN(t)) return t;
                for (var e, n = r(); - 1 == (e = n.index(t)) && t != g;) t = t.parentNode;
                return e
            }
            var c, d = t.extend({}, e.defaults, n),
                u = d.event,
                p = d.step,
                h = d.lazy,
                f = d.target ? this : document,
                m = t(d.target || this, f),
                g = m[0],
                v = d.items,
                y = d.start,
                b = d.interval,
                x = d.navigation;
            h || (v = r()), d.force && o({}, y), t(d.prev || [], f).bind(u, -p, i), t(d.next || [], f).bind(u, p, i), g.ssbound || m.bind("prev.serialScroll", -p, i).bind("next.serialScroll", p, i).bind("goto.serialScroll", o), b && m.bind("start.serialScroll", function(t) {
                b || (s(), b = !0, a())
            }).bind("stop.serialScroll", function() {
                s(), b = !1
            }), m.bind("notify.serialScroll", function(t, e) {
                var n = l(e);
                n > -1 && (y = n)
            }), g.ssbound = !0, d.jump && (h ? m : r()).bind(u, function(t) {
                o(t, l(t.target))
            }), x && (x = t(x, f).bind(u, function(t) {
                t.data = Math.round(r().length / x.length) * x.index(this), o(t, this)
            }))
        })
    }
}(jQuery), ! function(t) {
    var e = {},
        n = {
            mode: "horizontal",
            slideSelector: "",
            infiniteLoop: !0,
            hideControlOnEnd: !1,
            speed: 500,
            easing: null,
            slideMargin: 0,
            startSlide: 0,
            randomStart: !1,
            captions: !1,
            ticker: !1,
            tickerHover: !1,
            adaptiveHeight: !1,
            adaptiveHeightSpeed: 500,
            video: !1,
            useCSS: !0,
            preloadImages: "visible",
            responsive: !0,
            slideZIndex: 50,
            touchEnabled: !0,
            swipeThreshold: 50,
            oneToOneTouch: !0,
            preventDefaultSwipeX: !0,
            preventDefaultSwipeY: !1,
            pager: !0,
            pagerType: "full",
            pagerShortSeparator: " / ",
            pagerSelector: null,
            buildPager: null,
            pagerCustom: null,
            controls: !0,
            nextText: "Next",
            prevText: "Prev",
            nextSelector: null,
            prevSelector: null,
            autoControls: !1,
            startText: "Start",
            stopText: "Stop",
            autoControlsCombine: !1,
            autoControlsSelector: null,
            auto: !1,
            pause: 4e3,
            autoStart: !0,
            autoDirection: "next",
            autoHover: !1,
            autoDelay: 0,
            minSlides: 1,
            maxSlides: 1,
            moveSlides: 0,
            slideWidth: 0,
            onSliderLoad: function() {},
            onSlideBefore: function() {},
            onSlideAfter: function() {},
            onSlideNext: function() {},
            onSlidePrev: function() {},
            onSliderResize: function() {}
        };
    t.fn.bxSlider = function(o) {
        if (0 == this.length) return this;
        if (this.length > 1) return this.each(function() {
            t(this).bxSlider(o)
        }), this;
        var a = {},
            s = this;
        e.el = this;
        var r = t(window).width(),
            l = t(window).height(),
            c = function() {
                a.settings = t.extend({}, n, o), a.settings.slideWidth = parseInt(a.settings.slideWidth), a.children = s.children(a.settings.slideSelector), a.children.length < a.settings.minSlides && (a.settings.minSlides = a.children.length), a.children.length < a.settings.maxSlides && (a.settings.maxSlides = a.children.length), a.settings.randomStart && (a.settings.startSlide = Math.floor(Math.random() * a.children.length)), a.active = {
                    index: a.settings.startSlide
                }, a.carousel = a.settings.minSlides > 1 || a.settings.maxSlides > 1, a.carousel && (a.settings.preloadImages = "all"), a.minThreshold = a.settings.minSlides * a.settings.slideWidth + (a.settings.minSlides - 1) * a.settings.slideMargin, a.maxThreshold = a.settings.maxSlides * a.settings.slideWidth + (a.settings.maxSlides - 1) * a.settings.slideMargin, a.working = !1, a.controls = {}, a.interval = null, a.animProp = "vertical" == a.settings.mode ? "top" : "left", a.usingCSS = a.settings.useCSS && "fade" != a.settings.mode && function() {
                    var t = document.createElement("div"),
                        e = ["WebkitPerspective", "MozPerspective", "OPerspective", "msPerspective"];
                    for (var n in e)
                        if (void 0 !== t.style[e[n]]) return a.cssPrefix = e[n].replace("Perspective", "").toLowerCase(), a.animProp = "-" + a.cssPrefix + "-transform", !0;
                    return !1
                }(), "vertical" == a.settings.mode && (a.settings.maxSlides = a.settings.minSlides), s.data("origStyle", s.attr("style")), s.children(a.settings.slideSelector).each(function() {
                    t(this).data("origStyle", t(this).attr("style"))
                }), d()
            },
            d = function() {
                s.wrap('<div class="bx-wrapper"><div class="bx-viewport"></div></div>'), a.viewport = s.parent(), a.loader = t('<div class="bx-loading" />'), a.viewport.prepend(a.loader), s.css({
                    width: "horizontal" == a.settings.mode ? 100 * a.children.length + 215 + "%" : "auto",
                    position: "relative"
                }), a.usingCSS && a.settings.easing ? s.css("-" + a.cssPrefix + "-transition-timing-function", a.settings.easing) : a.settings.easing || (a.settings.easing = "swing"), g(), a.viewport.css({
                    width: "100%",
                    overflow: "hidden",
                    position: "relative"
                }), a.viewport.parent().css({
                    maxWidth: f()
                }), a.settings.pager || a.viewport.parent().css({
                    margin: "0 auto 0px"
                }), a.children.css({
                    "float": "horizontal" == a.settings.mode ? "left" : "none",
                    listStyle: "none",
                    position: "relative"
                }), a.children.css("width", m()), "horizontal" == a.settings.mode && a.settings.slideMargin > 0 && a.children.css("marginRight", a.settings.slideMargin), "vertical" == a.settings.mode && a.settings.slideMargin > 0 && a.children.css("marginBottom", a.settings.slideMargin), "fade" == a.settings.mode && (a.children.css({
                    position: "absolute",
                    zIndex: 0,
                    display: "none"
                }), a.children.eq(a.settings.startSlide).css({
                    zIndex: a.settings.slideZIndex,
                    display: "block"
                })), a.controls.el = t('<div class="bx-controls" />'), a.settings.captions && k(), a.active.last = a.settings.startSlide == v() - 1, a.settings.video && s.fitVids();
                var e = a.children.eq(a.settings.startSlide);
                "all" == a.settings.preloadImages && (e = a.children), a.settings.ticker ? a.settings.pager = !1 : (a.settings.pager && _(), a.settings.controls && C(), a.settings.auto && a.settings.autoControls && $(), (a.settings.controls || a.settings.autoControls || a.settings.pager) && a.viewport.after(a.controls.el)), u(e, p)
            },
            u = function(e, n) {
                var i = e.find("img, iframe").length;
                if (0 == i) return void n();
                var o = 0;
                e.find("img, iframe").each(function() {
                    t(this).one("load", function() {
                        ++o == i && n()
                    }).each(function() {
                        this.complete && t(this).load()
                    })
                })
            },
            p = function() {
                if (a.settings.infiniteLoop && "fade" != a.settings.mode && !a.settings.ticker) {
                    var e = "vertical" == a.settings.mode ? a.settings.minSlides : a.settings.maxSlides,
                        n = a.children.slice(0, e).clone().addClass("bx-clone"),
                        i = a.children.slice(-e).clone().addClass("bx-clone");
                    s.append(n).prepend(i)
                }
                a.loader.remove(), b(), "vertical" == a.settings.mode && (a.settings.adaptiveHeight = !0), a.viewport.height(h()), s.redrawSlider(), a.settings.onSliderLoad(a.active.index), a.initialized = !0, a.settings.responsive && t(window).bind("resize", R), a.settings.auto && a.settings.autoStart && L(), a.settings.ticker && P(), a.settings.pager && j(a.settings.startSlide),
                    a.settings.controls && N(), a.settings.touchEnabled && !a.settings.ticker && H()
            },
            h = function() {
                var e = 0,
                    n = t();
                if ("vertical" == a.settings.mode || a.settings.adaptiveHeight)
                    if (a.carousel) {
                        var o = 1 == a.settings.moveSlides ? a.active.index : a.active.index * y();
                        for (n = a.children.eq(o), i = 1; i <= a.settings.maxSlides - 1; i++) n = o + i >= a.children.length ? n.add(a.children.eq(i - 1)) : n.add(a.children.eq(o + i))
                    } else n = a.children.eq(a.active.index);
                else n = a.children;
                return "vertical" == a.settings.mode ? (n.each(function() {
                    e += t(this).outerHeight()
                }), a.settings.slideMargin > 0 && (e += a.settings.slideMargin * (a.settings.minSlides - 1))) : e = Math.max.apply(Math, n.map(function() {
                    return t(this).outerHeight(!1)
                }).get()), e
            },
            f = function() {
                var t = "100%";
                return a.settings.slideWidth > 0 && (t = "horizontal" == a.settings.mode ? a.settings.maxSlides * a.settings.slideWidth + (a.settings.maxSlides - 1) * a.settings.slideMargin : a.settings.slideWidth), t
            },
            m = function() {
                var t = a.settings.slideWidth,
                    e = a.viewport.width();
                return 0 == a.settings.slideWidth || a.settings.slideWidth > e && !a.carousel || "vertical" == a.settings.mode ? t = e : a.settings.maxSlides > 1 && "horizontal" == a.settings.mode && (e > a.maxThreshold || e < a.minThreshold && (t = (e - a.settings.slideMargin * (a.settings.minSlides - 1)) / a.settings.minSlides)), t
            },
            g = function() {
                var t = 1;
                if ("horizontal" == a.settings.mode && a.settings.slideWidth > 0)
                    if (a.viewport.width() < a.minThreshold) t = a.settings.minSlides;
                    else if (a.viewport.width() > a.maxThreshold) t = a.settings.maxSlides;
                else {
                    var e = a.children.first().width();
                    t = Math.floor(a.viewport.width() / e)
                } else "vertical" == a.settings.mode && (t = a.settings.minSlides);
                return t
            },
            v = function() {
                var t = 0;
                if (a.settings.moveSlides > 0)
                    if (a.settings.infiniteLoop) t = a.children.length / y();
                    else
                        for (var e = 0, n = 0; e < a.children.length;) ++t, e = n + g(), n += a.settings.moveSlides <= g() ? a.settings.moveSlides : g();
                else t = Math.ceil(a.children.length / g());
                return t
            },
            y = function() {
                return a.settings.moveSlides > 0 && a.settings.moveSlides <= g() ? a.settings.moveSlides : g()
            },
            b = function() {
                if (a.children.length > a.settings.maxSlides && a.active.last && !a.settings.infiniteLoop) {
                    if ("horizontal" == a.settings.mode) {
                        var t = a.children.last(),
                            e = t.position();
                        x(-(e.left - (a.viewport.width() - t.width())), "reset", 0)
                    } else if ("vertical" == a.settings.mode) {
                        var n = a.children.length - a.settings.minSlides,
                            e = a.children.eq(n).position();
                        x(-e.top, "reset", 0)
                    }
                } else {
                    var e = a.children.eq(a.active.index * y()).position();
                    a.active.index == v() - 1 && (a.active.last = !0), void 0 != e && ("horizontal" == a.settings.mode ? x(-e.left, "reset", 0) : "vertical" == a.settings.mode && x(-e.top, "reset", 0))
                }
            },
            x = function(t, e, n, i) {
                if (a.usingCSS) {
                    var o = "vertical" == a.settings.mode ? "translate3d(0, " + t + "px, 0)" : "translate3d(" + t + "px, 0, 0)";
                    s.css("-" + a.cssPrefix + "-transition-duration", n / 1e3 + "s"), "slide" == e ? (s.css(a.animProp, o), s.bind("transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd", function() {
                        s.unbind("transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd"), I()
                    })) : "reset" == e ? s.css(a.animProp, o) : "ticker" == e && (s.css("-" + a.cssPrefix + "-transition-timing-function", "linear"), s.css(a.animProp, o), s.bind("transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd", function() {
                        s.unbind("transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd"), x(i.resetValue, "reset", 0), O()
                    }))
                } else {
                    var r = {};
                    r[a.animProp] = t, "slide" == e ? s.animate(r, n, a.settings.easing, function() {
                        I()
                    }) : "reset" == e ? s.css(a.animProp, t) : "ticker" == e && s.animate(r, speed, "linear", function() {
                        x(i.resetValue, "reset", 0), O()
                    })
                }
            },
            w = function() {
                for (var e = "", n = v(), i = 0; n > i; i++) {
                    var o = "";
                    a.settings.buildPager && t.isFunction(a.settings.buildPager) ? (o = a.settings.buildPager(i), a.pagerEl.addClass("bx-custom-pager")) : (o = i + 1, a.pagerEl.addClass("bx-default-pager")), e += '<div class="bx-pager-item"><a href="" data-slide-index="' + i + '" class="bx-pager-link">' + o + "</a></div>"
                }
                a.pagerEl.html(e)
            },
            _ = function() {
                a.settings.pagerCustom ? a.pagerEl = t(a.settings.pagerCustom) : (a.pagerEl = t('<div class="bx-pager" />'), a.settings.pagerSelector ? t(a.settings.pagerSelector).html(a.pagerEl) : a.controls.el.addClass("bx-has-pager").append(a.pagerEl), w()), a.pagerEl.on("click", "a", A)
            },
            C = function() {
                a.controls.next = t('<a class="bx-next" href="">' + a.settings.nextText + "</a>"), a.controls.prev = t('<a class="bx-prev" href="">' + a.settings.prevText + "</a>"), a.controls.next.bind("click", S), a.controls.prev.bind("click", T), a.settings.nextSelector && t(a.settings.nextSelector).append(a.controls.next), a.settings.prevSelector && t(a.settings.prevSelector).append(a.controls.prev), a.settings.nextSelector || a.settings.prevSelector || (a.controls.directionEl = t('<div class="bx-controls-direction" />'), a.controls.directionEl.append(a.controls.prev).append(a.controls.next), a.controls.el.addClass("bx-has-controls-direction").append(a.controls.directionEl))
            },
            $ = function() {
                a.controls.start = t('<div class="bx-controls-auto-item"><a class="bx-start" href="">' + a.settings.startText + "</a></div>"), a.controls.stop = t('<div class="bx-controls-auto-item"><a class="bx-stop" href="">' + a.settings.stopText + "</a></div>"), a.controls.autoEl = t('<div class="bx-controls-auto" />'), a.controls.autoEl.on("click", ".bx-start", E), a.controls.autoEl.on("click", ".bx-stop", D), a.settings.autoControlsCombine ? a.controls.autoEl.append(a.controls.start) : a.controls.autoEl.append(a.controls.start).append(a.controls.stop), a.settings.autoControlsSelector ? t(a.settings.autoControlsSelector).html(a.controls.autoEl) : a.controls.el.addClass("bx-has-controls-auto").append(a.controls.autoEl), M(a.settings.autoStart ? "stop" : "start")
            },
            k = function() {
                a.children.each(function() {
                    var e = t(this).find("img:first").attr("title");
                    void 0 != e && ("" + e).length && t(this).append('<div class="bx-caption"><span>' + e + "</span></div>")
                })
            },
            S = function(t) {
                a.settings.auto && s.stopAuto(), s.goToNextSlide(), t.preventDefault()
            },
            T = function(t) {
                a.settings.auto && s.stopAuto(), s.goToPrevSlide(), t.preventDefault()
            },
            E = function(t) {
                s.startAuto(), t.preventDefault()
            },
            D = function(t) {
                s.stopAuto(), t.preventDefault()
            },
            A = function(e) {
                a.settings.auto && s.stopAuto();
                var n = t(e.currentTarget),
                    i = parseInt(n.attr("data-slide-index"));
                i != a.active.index && s.goToSlide(i), e.preventDefault()
            },
            j = function(e) {
                var n = a.children.length;
                return "short" == a.settings.pagerType ? (a.settings.maxSlides > 1 && (n = Math.ceil(a.children.length / a.settings.maxSlides)), void a.pagerEl.html(e + 1 + a.settings.pagerShortSeparator + n)) : (a.pagerEl.find("a").removeClass("active"), void a.pagerEl.each(function(n, i) {
                    t(i).find("a").eq(e).addClass("active")
                }))
            },
            I = function() {
                if (a.settings.infiniteLoop) {
                    var t = "";
                    0 == a.active.index ? t = a.children.eq(0).position() : a.active.index == v() - 1 && a.carousel ? t = a.children.eq((v() - 1) * y()).position() : a.active.index == a.children.length - 1 && (t = a.children.eq(a.children.length - 1).position()), t && ("horizontal" == a.settings.mode ? x(-t.left, "reset", 0) : "vertical" == a.settings.mode && x(-t.top, "reset", 0))
                }
                a.working = !1, a.settings.onSlideAfter(a.children.eq(a.active.index), a.oldIndex, a.active.index)
            },
            M = function(t) {
                a.settings.autoControlsCombine ? a.controls.autoEl.html(a.controls[t]) : (a.controls.autoEl.find("a").removeClass("active"), a.controls.autoEl.find("a:not(.bx-" + t + ")").addClass("active"))
            },
            N = function() {
                1 == v() ? (a.controls.prev.addClass("disabled"), a.controls.next.addClass("disabled")) : !a.settings.infiniteLoop && a.settings.hideControlOnEnd && (0 == a.active.index ? (a.controls.prev.addClass("disabled"), a.controls.next.removeClass("disabled")) : a.active.index == v() - 1 ? (a.controls.next.addClass("disabled"), a.controls.prev.removeClass("disabled")) : (a.controls.prev.removeClass("disabled"), a.controls.next.removeClass("disabled")))
            },
            L = function() {
                a.settings.autoDelay > 0 ? setTimeout(s.startAuto, a.settings.autoDelay) : s.startAuto(), a.settings.autoHover && s.hover(function() {
                    a.interval && (s.stopAuto(!0), a.autoPaused = !0)
                }, function() {
                    a.autoPaused && (s.startAuto(!0), a.autoPaused = null)
                })
            },
            P = function() {
                var e = 0;
                if ("next" == a.settings.autoDirection) s.append(a.children.clone().addClass("bx-clone"));
                else {
                    s.prepend(a.children.clone().addClass("bx-clone"));
                    var n = a.children.first().position();
                    e = "horizontal" == a.settings.mode ? -n.left : -n.top
                }
                x(e, "reset", 0), a.settings.pager = !1, a.settings.controls = !1, a.settings.autoControls = !1, a.settings.tickerHover && !a.usingCSS && a.viewport.hover(function() {
                    s.stop()
                }, function() {
                    var e = 0;
                    a.children.each(function() {
                        e += "horizontal" == a.settings.mode ? t(this).outerWidth(!0) : t(this).outerHeight(!0)
                    });
                    var n = a.settings.speed / e,
                        i = "horizontal" == a.settings.mode ? "left" : "top",
                        o = n * (e - Math.abs(parseInt(s.css(i))));
                    O(o)
                }), O()
            },
            O = function(t) {
                speed = t ? t : a.settings.speed;
                var e = {
                        left: 0,
                        top: 0
                    },
                    n = {
                        left: 0,
                        top: 0
                    };
                "next" == a.settings.autoDirection ? e = s.find(".bx-clone").first().position() : n = a.children.first().position();
                var i = "horizontal" == a.settings.mode ? -e.left : -e.top,
                    o = "horizontal" == a.settings.mode ? -n.left : -n.top,
                    r = {
                        resetValue: o
                    };
                x(i, "ticker", speed, r)
            },
            H = function() {
                a.touch = {
                    start: {
                        x: 0,
                        y: 0
                    },
                    end: {
                        x: 0,
                        y: 0
                    }
                }, a.viewport.bind("touchstart", F)
            },
            F = function(t) {
                if (a.working) t.preventDefault();
                else {
                    a.touch.originalPos = s.position();
                    var e = t.originalEvent;
                    a.touch.start.x = e.changedTouches[0].pageX, a.touch.start.y = e.changedTouches[0].pageY, a.viewport.bind("touchmove", z), a.viewport.bind("touchend", q)
                }
            },
            z = function(t) {
                var e = t.originalEvent,
                    n = Math.abs(e.changedTouches[0].pageX - a.touch.start.x),
                    i = Math.abs(e.changedTouches[0].pageY - a.touch.start.y);
                if (3 * n > i && a.settings.preventDefaultSwipeX ? t.preventDefault() : 3 * i > n && a.settings.preventDefaultSwipeY && t.preventDefault(), "fade" != a.settings.mode && a.settings.oneToOneTouch) {
                    var o = 0;
                    if ("horizontal" == a.settings.mode) {
                        var s = e.changedTouches[0].pageX - a.touch.start.x;
                        o = a.touch.originalPos.left + s
                    } else {
                        var s = e.changedTouches[0].pageY - a.touch.start.y;
                        o = a.touch.originalPos.top + s
                    }
                    x(o, "reset", 0)
                }
            },
            q = function(t) {
                a.viewport.unbind("touchmove", z);
                var e = t.originalEvent,
                    n = 0;
                if (a.touch.end.x = e.changedTouches[0].pageX, a.touch.end.y = e.changedTouches[0].pageY, "fade" == a.settings.mode) {
                    var i = Math.abs(a.touch.start.x - a.touch.end.x);
                    i >= a.settings.swipeThreshold && (a.touch.start.x > a.touch.end.x ? s.goToNextSlide() : s.goToPrevSlide(), s.stopAuto())
                } else {
                    var i = 0;
                    "horizontal" == a.settings.mode ? (i = a.touch.end.x - a.touch.start.x, n = a.touch.originalPos.left) : (i = a.touch.end.y - a.touch.start.y, n = a.touch.originalPos.top), !a.settings.infiniteLoop && (0 == a.active.index && i > 0 || a.active.last && 0 > i) ? x(n, "reset", 200) : Math.abs(i) >= a.settings.swipeThreshold ? (0 > i ? s.goToNextSlide() : s.goToPrevSlide(), s.stopAuto()) : x(n, "reset", 200)
                }
                a.viewport.unbind("touchend", q)
            },
            R = function() {
                var e = t(window).width(),
                    n = t(window).height();
                (r != e || l != n) && (r = e, l = n, s.redrawSlider(), a.settings.onSliderResize.call(s, a.active.index))
            };
        return s.goToSlide = function(e, n) {
            if (!a.working && a.active.index != e)
                if (a.working = !0, a.oldIndex = a.active.index, a.active.index = 0 > e ? v() - 1 : e >= v() ? 0 : e, a.settings.onSlideBefore(a.children.eq(a.active.index), a.oldIndex, a.active.index), "next" == n ? a.settings.onSlideNext(a.children.eq(a.active.index), a.oldIndex, a.active.index) : "prev" == n && a.settings.onSlidePrev(a.children.eq(a.active.index), a.oldIndex, a.active.index), a.active.last = a.active.index >= v() - 1, a.settings.pager && j(a.active.index), a.settings.controls && N(), "fade" == a.settings.mode) a.settings.adaptiveHeight && a.viewport.height() != h() && a.viewport.animate({
                    height: h()
                }, a.settings.adaptiveHeightSpeed), a.children.filter(":visible").fadeOut(a.settings.speed).css({
                    zIndex: 0
                }), a.children.eq(a.active.index).css("zIndex", a.settings.slideZIndex + 1).fadeIn(a.settings.speed, function() {
                    t(this).css("zIndex", a.settings.slideZIndex), I()
                });
                else {
                    a.settings.adaptiveHeight && a.viewport.height() != h() && a.viewport.animate({
                        height: h()
                    }, a.settings.adaptiveHeightSpeed);
                    var i = 0,
                        o = {
                            left: 0,
                            top: 0
                        };
                    if (!a.settings.infiniteLoop && a.carousel && a.active.last)
                        if ("horizontal" == a.settings.mode) {
                            var r = a.children.eq(a.children.length - 1);
                            o = r.position(), i = a.viewport.width() - r.outerWidth()
                        } else {
                            var l = a.children.length - a.settings.minSlides;
                            o = a.children.eq(l).position()
                        }
                    else if (a.carousel && a.active.last && "prev" == n) {
                        var c = 1 == a.settings.moveSlides ? a.settings.maxSlides - y() : (v() - 1) * y() - (a.children.length - a.settings.maxSlides),
                            r = s.children(".bx-clone").eq(c);
                        o = r.position()
                    } else if ("next" == n && 0 == a.active.index) o = s.find("> .bx-clone").eq(a.settings.maxSlides).position(), a.active.last = !1;
                    else if (e >= 0) {
                        var d = e * y();
                        o = a.children.eq(d).position()
                    }
                    if ("undefined" != typeof o) {
                        var u = "horizontal" == a.settings.mode ? -(o.left - i) : -o.top;
                        x(u, "slide", a.settings.speed)
                    }
                }
        }, s.goToNextSlide = function() {
            if (a.settings.infiniteLoop || !a.active.last) {
                var t = parseInt(a.active.index) + 1;
                s.goToSlide(t, "next")
            }
        }, s.goToPrevSlide = function() {
            if (a.settings.infiniteLoop || 0 != a.active.index) {
                var t = parseInt(a.active.index) - 1;
                s.goToSlide(t, "prev")
            }
        }, s.startAuto = function(t) {
            a.interval || (a.interval = setInterval(function() {
                "next" == a.settings.autoDirection ? s.goToNextSlide() : s.goToPrevSlide()
            }, a.settings.pause), a.settings.autoControls && 1 != t && M("stop"))
        }, s.stopAuto = function(t) {
            a.interval && (clearInterval(a.interval), a.interval = null, a.settings.autoControls && 1 != t && M("start"))
        }, s.getCurrentSlide = function() {
            return a.active.index
        }, s.getCurrentSlideElement = function() {
            return a.children.eq(a.active.index)
        }, s.getSlideCount = function() {
            return a.children.length
        }, s.redrawSlider = function() {
            a.children.add(s.find(".bx-clone")).outerWidth(m()), a.viewport.css("height", h()), a.settings.ticker || b(), a.active.last && (a.active.index = v() - 1), a.active.index >= v() && (a.active.last = !0), a.settings.pager && !a.settings.pagerCustom && (w(), j(a.active.index))
        }, s.destroySlider = function() {
            a.initialized && (a.initialized = !1, t(".bx-clone", this).remove(), a.children.each(function() {
                void 0 != t(this).data("origStyle") ? t(this).attr("style", t(this).data("origStyle")) : t(this).removeAttr("style")
            }), void 0 != t(this).data("origStyle") ? this.attr("style", t(this).data("origStyle")) : t(this).removeAttr("style"), t(this).unwrap().unwrap(), a.controls.el && a.controls.el.remove(), a.controls.next && a.controls.next.remove(), a.controls.prev && a.controls.prev.remove(), a.pagerEl && a.settings.controls && a.pagerEl.remove(), t(".bx-caption", this).remove(), a.controls.autoEl && a.controls.autoEl.remove(), clearInterval(a.interval), a.settings.responsive && t(window).unbind("resize", R))
        }, s.reloadSlider = function(t) {
            void 0 != t && (o = t), s.destroySlider(), c()
        }, c(), this
    }
}(jQuery), $(document).ready(function() {
    $("ul.tree.dhtml").hide(), $("ul.tree.dhtml").hasClass("dynamized") || ($("ul.tree.dhtml ul").prev().before("<span class='grower OPEN'> </span>"), $("ul.tree.dhtml ul li:last-child, ul.tree.dhtml li:last-child").addClass("last"), $("ul.tree.dhtml span.grower.OPEN").addClass("CLOSE").removeClass("OPEN").parent().find("ul:first").hide(), $("ul.tree.dhtml").show(), $("ul.tree.dhtml .selected").parents().each(function() {
        $(this).is("ul") && toggleBranch($(this).prev().prev(), !0)
    }), toggleBranch($("ul.tree.dhtml .selected").prev(), !0), $("ul.tree.dhtml span.grower").click(function() {
        toggleBranch($(this))
    }), $("ul.tree.dhtml").addClass("dynamized"), $("ul.tree.dhtml").removeClass("dhtml"))
}), $(document).ready(function() {
    $("#newsletter-input").on({
        focus: function() {
            ($(this).val() == placeholder_blocknewsletter || $(this).val() == msg_newsl) && $(this).val("")
        },
        blur: function() {
            "" == $(this).val() && $(this).val(placeholder_blocknewsletter)
        }
    });
    var t = "alert alert-danger";
    "undefined" == typeof nw_error || nw_error || (t = "alert alert-success"), "undefined" != typeof msg_newsl && msg_newsl && ($("#columns").prepend('<div class="clearfix"></div><p class="' + t + '"> ' + alert_blocknewsletter + "</p>"), $("html, body").animate({
        scrollTop: $("#columns").offset().top
    }, "slow"))
});
var wishlistProductsIds = [];
$(document).ready(function() {
        wishlistRefreshStatus(), $(document).on("change", "select[name=wishlists]", function() {
            WishlistChangeDefault("wishlist_block_list", $(this).val())
        }), $("#wishlist_button").popover({
            html: !0,
            content: function() {
                return $("#popover-content").html()
            }
        }), $(".wishlist").each(function() {
            current = $(this), $(this).children(".wishlist_button_list").popover({
                html: !0,
                content: function() {
                    return current.children(".popover-content").html()
                }
            })
        })
    }),
    function(t) {
        t.fn.extend({
            autocomplete: function(e, n) {
                var i = "string" == typeof e;
                return n = t.extend({}, t.Autocompleter.defaults, {
                    url: i ? e : null,
                    data: i ? null : e,
                    delay: i ? t.Autocompleter.defaults.delay : 10,
                    max: n && !n.scroll ? 10 : 150
                }, n), n.highlight = n.highlight || function(t) {
                    return t
                }, n.formatMatch = n.formatMatch || n.formatItem, this.each(function() {
                    new t.Autocompleter(this, n)
                })
            },
            result: function(t) {
                return this.bind("result", t)
            },
            search: function(t) {
                return this.trigger("search", [t])
            },
            flushCache: function() {
                return this.trigger("flushCache")
            },
            setOptions: function(t) {
                return this.trigger("setOptions", [t])
            },
            unautocomplete: function() {
                return this.trigger("unautocomplete")
            }
        }), t.Autocompleter = function(e, n) {
            function i() {
                var t = C.selected();
                if (!t) return !1;
                var e = t.result;
                if (b = e, n.multiple) {
                    var i = a(y.val());
                    i.length > 1 && (e = i.slice(0, i.length - 1).join(n.multipleSeparator) + n.multipleSeparator + e), e += n.multipleSeparator
                }
                return y.val(e), c(), y.trigger("result", [t.data, t.value]), !0
            }

            function o(t, e) {
                if (m == v.DEL) return void C.hide();
                var i = y.val();
                (e || i != b) && (b = i, i = s(i), i.length >= n.minChars ? (y.addClass(n.loadingClass), n.matchCase || (i = i.toLowerCase()), u(i, d, c)) : (h(), C.hide()))
            }

            function a(e) {
                if (!e) return [""];
                var i = e.split(n.multipleSeparator),
                    o = [];
                return t.each(i, function(e, n) {
                    t.trim(n) && (o[e] = t.trim(n))
                }), o
            }

            function s(t) {
                if (!n.multiple) return t;
                var e = a(t);
                return e[e.length - 1]
            }

            function r(i, o) {
                n.autoFill && s(y.val()).toLowerCase() == i.toLowerCase() && m != v.BACKSPACE && (y.val(y.val() + o.substring(s(b).length)), t.Autocompleter.Selection(e, b.length, b.length + o.length))
            }

            function l() {
                clearTimeout(f), f = setTimeout(c, 200)
            }

            function c() {
                var i = C.visible();
                C.hide(), clearTimeout(f), h(), n.mustMatch && y.search(function(t) {
                    if (!t)
                        if (n.multiple) {
                            var e = a(y.val()).slice(0, -1);
                            y.val(e.join(n.multipleSeparator) + (e.length ? n.multipleSeparator : ""))
                        } else y.val("")
                }), i && t.Autocompleter.Selection(e, e.value.length, e.value.length)
            }

            function d(t, e) {
                e && e.length && w ? (h(), C.display(e, t), r(t, e[0].value), C.show()) : c()
            }

            function u(i, o, a) {
                n.matchCase || (i = i.toLowerCase());
                var r = x.load(i);
                if (r && r.length) o(i, r);
                else if ("string" == typeof n.url && n.url.length > 0) {
                    var l = {
                        timestamp: +new Date
                    };
                    t.each(n.extraParams, function(t, e) {
                        l[t] = "function" == typeof e ? e() : e
                    }), t.ajax({
                        mode: "abort",
                        port: "autocomplete" + e.name,
                        dataType: n.dataType,
                        url: n.url,
                        data: t.extend({
                            q: s(i),
                            limit: n.max
                        }, l),
                        success: function(t) {
                            var e = n.parse && n.parse(t) || p(t);
                            x.add(i, e), o(i, e)
                        }
                    })
                } else C.emptyList(), a(i)
            }

            function p(e) {
                for (var i = [], o = e.split("\n"), a = 0; a < o.length; a++) {
                    var s = t.trim(o[a]);
                    s && (s = s.split("|"), i[i.length] = {
                        data: s,
                        value: s[0],
                        result: n.formatResult && n.formatResult(s, s[0]) || s[0]
                    })
                }
                return i
            }

            function h() {
                y.removeClass(n.loadingClass)
            }
            var f, m, g, v = {
                    UP: 38,
                    DOWN: 40,
                    DEL: 46,
                    TAB: 9,
                    RETURN: 13,
                    ESC: 27,
                    COMMA: 188,
                    PAGEUP: 33,
                    PAGEDOWN: 34,
                    BACKSPACE: 8
                },
                y = t(e).attr("autocomplete", "off").addClass(n.inputClass),
                b = "",
                x = t.Autocompleter.Cache(n),
                w = 0,
                _ = {
                    mouseDownOnSelect: !1
                },
                C = t.Autocompleter.Select(n, e, i, _);
            t.browser.opera && t(e.form).bind("submit.autocomplete", function() {
                return g ? (g = !1, !1) : void 0
            }), y.bind((t.browser.opera ? "keypress" : "keydown") + ".autocomplete", function(e) {
                switch (m = e.keyCode, e.keyCode) {
                    case v.UP:
                        e.preventDefault(), C.visible() ? C.prev() : o(0, !0);
                        break;
                    case v.DOWN:
                        e.preventDefault(), C.visible() ? C.next() : o(0, !0);
                        break;
                    case v.PAGEUP:
                        e.preventDefault(), C.visible() ? C.pageUp() : o(0, !0);
                        break;
                    case v.PAGEDOWN:
                        e.preventDefault(), C.visible() ? C.pageDown() : o(0, !0);
                        break;
                    case n.multiple && "," == t.trim(n.multipleSeparator) && v.COMMA:
                    case v.TAB:
                    case v.RETURN:
                        if (i()) return e.preventDefault(), g = !0, !1;
                        break;
                    case v.ESC:
                        C.hide();
                        break;
                    default:
                        clearTimeout(f), f = setTimeout(o, n.delay)
                }
            }).focus(function() {
                w++
            }).blur(function() {
                w = 0, _.mouseDownOnSelect || l()
            }).click(function() {
                w++ > 1 && !C.visible() && o(0, !0)
            }).bind("search", function() {
                function e(t, e) {
                    var i;
                    if (e && e.length)
                        for (var o = 0; o < e.length; o++)
                            if (e[o].result.toLowerCase() == t.toLowerCase()) {
                                i = e[o];
                                break
                            }
                            "function" == typeof n ? n(i) : y.trigger("result", i && [i.data, i.value])
                }
                var n = arguments.length > 1 ? arguments[1] : null;
                t.each(a(y.val()), function(t, n) {
                    u(n, e, e)
                })
            }).bind("flushCache", function() {
                x.flush()
            }).bind("setOptions", function() {
                t.extend(n, arguments[1]), "data" in arguments[1] && x.populate()
            }).bind("unautocomplete", function() {
                C.unbind(), y.unbind(), t(e.form).unbind(".autocomplete")
            })
        }, t.Autocompleter.defaults = {
            inputClass: "ac_input",
            resultsClass: "ac_results",
            loadingClass: "ac_loading",
            minChars: 1,
            delay: 400,
            matchCase: !1,
            matchSubset: !0,
            matchContains: !1,
            cacheLength: 10,
            max: 100,
            mustMatch: !1,
            extraParams: {},
            selectFirst: !0,
            formatItem: function(t) {
                return t[0]
            },
            formatMatch: null,
            autoFill: !1,
            width: 0,
            multiple: !1,
            multipleSeparator: ", ",
            highlight: function(t, e) {
                return t.replace(new RegExp("(?![^&;]+;)(?!<[^<>]*)(" + e.replace(/([\^\$\(\)\[\]\{\}\*\.\+\?\|\\])/gi, "\\$1") + ")(?![^<>]*>)(?![^&;]+;)", "gi"), "<strong>$1</strong>")
            },
            scroll: !0,
            scrollHeight: 180
        }, t.Autocompleter.Cache = function(e) {
            function n(t, n) {
                e.matchCase || (t = t.toLowerCase());
                var i = t.indexOf(n);
                return -1 == i ? !1 : 0 == i || e.matchContains
            }

            function i(t, n) {
                r > e.cacheLength && a(), s[t] || r++, s[t] = n
            }

            function o() {
                if (!e.data) return !1;
                var n = {},
                    o = 0;
                e.url || (e.cacheLength = 1), n[""] = [];
                for (var a = 0, s = e.data.length; s > a; a++) {
                    var r = e.data[a];
                    r = "string" == typeof r ? [r] : r;
                    var l = e.formatMatch(r, a + 1, e.data.length);
                    if (l !== !1) {
                        var c = l.charAt(0).toLowerCase();
                        n[c] || (n[c] = []);
                        var d = {
                            value: l,
                            data: r,
                            result: e.formatResult && e.formatResult(r) || l
                        };
                        n[c].push(d), o++ < e.max && n[""].push(d)
                    }
                }
                t.each(n, function(t, n) {
                    e.cacheLength++, i(t, n)
                })
            }

            function a() {
                s = {}, r = 0
            }
            var s = {},
                r = 0;
            return setTimeout(o, 25), {
                flush: a,
                add: i,
                populate: o,
                load: function(i) {
                    if (!e.cacheLength || !r) return null;
                    if (!e.url && e.matchContains) {
                        var o = [];
                        for (var a in s)
                            if (a.length > 0) {
                                var l = s[a];
                                t.each(l, function(t, e) {
                                    n(e.value, i) && o.push(e)
                                })
                            }
                        return o
                    }
                    if (s[i]) return s[i];
                    if (e.matchSubset)
                        for (var c = i.length - 1; c >= e.minChars; c--) {
                            var l = s[i.substr(0, c)];
                            if (l) {
                                var o = [];
                                return t.each(l, function(t, e) {
                                    n(e.value, i) && (o[o.length] = e)
                                }), o
                            }
                        }
                    return null
                }
            }
        }, t.Autocompleter.Select = function(e, n, i, o) {
            function a() {
                y && (h = t("<div/>").hide().addClass(e.resultsClass).css("position", "absolute").appendTo(document.body), f = t("<ul/>").appendTo(h).mouseover(function(e) {
                    s(e).nodeName && "LI" == s(e).nodeName.toUpperCase() && (g = t("li", f).removeClass(m.ACTIVE).index(s(e)), t(s(e)).addClass(m.ACTIVE))
                }).click(function(e) {
                    return t(s(e)).addClass(m.ACTIVE), i(), n.focus(), !1
                }).mousedown(function() {
                    o.mouseDownOnSelect = !0
                }).mouseup(function() {
                    o.mouseDownOnSelect = !1
                }), e.width > 0 && h.css("width", e.width), y = !1)
            }

            function s(t) {
                for (var e = t.target; e && "LI" != e.tagName;) e = e.parentNode;
                return e ? e : []
            }

            function r(t) {
                u.slice(g, g + 1).removeClass(m.ACTIVE), l(t);
                var n = u.slice(g, g + 1).addClass(m.ACTIVE);
                if (e.scroll) {
                    var i = 0;
                    u.slice(0, g).each(function() {
                        i += this.offsetHeight
                    }), i + n[0].offsetHeight - f.scrollTop() > f[0].clientHeight ? f.scrollTop(i + n[0].offsetHeight - f.innerHeight()) : i < f.scrollTop() && f.scrollTop(i)
                }
            }

            function l(t) {
                g += t, 0 > g ? g = u.size() - 1 : g >= u.size() && (g = 0)
            }

            function c(t) {
                return e.max && e.max < t ? e.max : t
            }

            function d() {
                f.empty();
                for (var n = c(p.length), i = 0; n > i; i++)
                    if (p[i]) {
                        var o = e.formatItem(p[i].data, i + 1, n, p[i].value, v);
                        if (o !== !1) {
                            var a = t("<li/>").html(e.highlight(o, v)).addClass(i % 2 == 0 ? "ac_even" : "ac_odd").appendTo(f)[0];
                            t.data(a, "ac_data", p[i])
                        }
                    }
                u = f.find("li"), e.selectFirst && (u.slice(0, 1).addClass(m.ACTIVE), g = 0), t.fn.bgiframe && f.bgiframe()
            }
            var u, p, h, f, m = {
                    ACTIVE: "ac_over"
                },
                g = -1,
                v = "",
                y = !0;
            return {
                display: function(t, e) {
                    a(), p = t, v = e, d()
                },
                next: function() {
                    r(1)
                },
                prev: function() {
                    r(-1)
                },
                pageUp: function() {
                    r(0 != g && 0 > g - 8 ? -g : -8)
                },
                pageDown: function() {
                    r(g != u.size() - 1 && g + 8 > u.size() ? u.size() - 1 - g : 8)
                },
                hide: function() {
                    h && h.hide(), u && u.removeClass(m.ACTIVE), g = -1
                },
                visible: function() {
                    return h && h.is(":visible")
                },
                current: function() {
                    return this.visible() && (u.filter("." + m.ACTIVE)[0] || e.selectFirst && u[0])
                },
                show: function() {
                    var i = t(n).offset();
                    if (h.css({
                            width: "string" == typeof e.width || e.width > 0 ? e.width : t(n).width() + parseInt(t(n).css("padding-left")) + parseInt(t(n).css("padding-right")) + parseInt(t(n).css("margin-left")) + parseInt(t(n).css("margin-right")),
                            top: i.top + n.offsetHeight,
                            left: i.left
                        }).show(), e.scroll && (f.css({
                            maxHeight: e.scrollHeight,
                            overflow: "auto"
                        }), t.browser.msie && "undefined" == typeof document.body.style.maxHeight)) {
                        var o = 0;
                        u.each(function() {
                            o += this.offsetHeight
                        });
                        var a = o > e.scrollHeight;
                        f.css("height", a ? e.scrollHeight : o), a || u.width(f.width() - parseInt(u.css("padding-left")) - parseInt(u.css("padding-right")))
                    }
                },
                selected: function() {
                    var e = u && u.filter("." + m.ACTIVE).removeClass(m.ACTIVE);
                    return e && e.length && t.data(e[0], "ac_data")
                },
                emptyList: function() {
                    f && f.empty()
                },
                unbind: function() {
                    h && h.remove()
                }
            }
        }, t.Autocompleter.Selection = function(t, e, n) {
            if (t.createTextRange) {
                var i = t.createTextRange();
                i.collapse(!0), i.moveStart("character", e), i.moveEnd("character", n), i.select()
            } else t.setSelectionRange ? t.setSelectionRange(e, n) : t.selectionStart && (t.selectionStart = e, t.selectionEnd = n);
            t.focus()
        }
    }(jQuery), ! function(t) {
        "use strict";
        t.expr[":"].icontains = function(e, n, i) {
            return t(e).text().toUpperCase().indexOf(i[3].toUpperCase()) >= 0
        };
        var e = function(n, i, o) {
            o && (o.stopPropagation(), o.preventDefault()), this.$element = t(n), this.$newElement = null, this.$button = null, this.$menu = null, this.$lis = null, this.options = t.extend({}, t.fn.selectpicker.defaults, this.$element.data(), "object" == typeof i && i), null === this.options.title && (this.options.title = this.$element.attr("title")), this.val = e.prototype.val, this.render = e.prototype.render, this.refresh = e.prototype.refresh, this.setStyle = e.prototype.setStyle, this.selectAll = e.prototype.selectAll, this.deselectAll = e.prototype.deselectAll, this.init()
        };
        e.prototype = {
            constructor: e,
            init: function() {
                var e = this,
                    n = this.$element.attr("id");
                this.$element.hide(), this.multiple = this.$element.prop("multiple"), this.autofocus = this.$element.prop("autofocus"), this.$newElement = this.createView(), this.$element.after(this.$newElement), this.$menu = this.$newElement.find("> .dropdown-menu"), this.$button = this.$newElement.find("> button"), this.$searchbox = this.$newElement.find("input"), void 0 !== n && (this.$button.attr("data-id", n), t('label[for="' + n + '"]').click(function(t) {
                    t.preventDefault(), e.$button.focus()
                })), this.checkDisabled(), this.clickListener(), this.options.liveSearch && this.liveSearchListener(), this.render(), this.liHeight(), this.setStyle(), this.setWidth(), this.options.container && this.selectPosition(), this.$menu.data("this", this), this.$newElement.data("this", this)
            },
            createDropdown: function() {
                var e = this.multiple ? " show-tick" : "",
                    n = this.$element.parent().hasClass("input-group") ? " input-group-btn" : "",
                    i = this.autofocus ? " autofocus" : "",
                    o = this.options.header ? '<div class="popover-title"><button type="button" class="close" aria-hidden="true">&times;</button>' + this.options.header + "</div>" : "",
                    a = this.options.liveSearch ? '<div class="bootstrap-select-searchbox"><input type="text" class="input-block-level form-control" autocomplete="off" /></div>' : "",
                    s = this.options.actionsBox ? '<div class="bs-actionsbox"><div class="btn-group btn-block"><button class="actions-btn bs-select-all btn btn-sm btn-default">Select All</button><button class="actions-btn bs-deselect-all btn btn-sm btn-default">Deselect All</button></div></div>' : "",
                    r = '<div class="btn-group bootstrap-select' + e + n + '"><button type="button" class="btn dropdown-toggle selectpicker" data-toggle="dropdown"' + i + '><span class="filter-option pull-left"></span>&nbsp;<span class="caret"></span></button><div class="dropdown-menu open">' + o + a + s + '<ul class="dropdown-menu inner selectpicker" role="menu"></ul></div></div>';
                return t(r)
            },
            createView: function() {
                var t = this.createDropdown(),
                    e = this.createLi();
                return t.find("ul").append(e), t
            },
            reloadLi: function() {
                this.destroyLi();
                var t = this.createLi();
                this.$menu.find("ul").append(t)
            },
            destroyLi: function() {
                this.$menu.find("li").remove()
            },
            createLi: function() {
                var e = this,
                    n = [],
                    i = "";
                return this.$element.find("option").each(function() {
                    var i = t(this),
                        o = i.attr("class") || "",
                        a = i.attr("style") || "",
                        s = i.data("content") ? i.data("content") : i.html(),
                        r = void 0 !== i.data("subtext") ? '<small class="muted text-muted">' + i.data("subtext") + "</small>" : "",
                        l = void 0 !== i.data("icon") ? '<i class="' + e.options.iconBase + " " + i.data("icon") + '"></i> ' : "";
                    if ("" !== l && (i.is(":disabled") || i.parent().is(":disabled")) && (l = "<span>" + l + "</span>"), i.data("content") || (s = l + '<span class="text">' + s + r + "</span>"), e.options.hideDisabled && (i.is(":disabled") || i.parent().is(":disabled"))) n.push('<a style="min-height: 0; padding: 0"></a>');
                    else if (i.parent().is("optgroup") && i.data("divider") !== !0)
                        if (0 === i.index()) {
                            var c = i.parent().attr("label"),
                                d = void 0 !== i.parent().data("subtext") ? '<small class="muted text-muted">' + i.parent().data("subtext") + "</small>" : "",
                                u = i.parent().data("icon") ? '<i class="' + i.parent().data("icon") + '"></i> ' : "";
                            c = u + '<span class="text">' + c + d + "</span>", 0 !== i[0].index ? n.push('<div class="div-contain"><div class="divider"></div></div><dt>' + c + "</dt>" + e.createA(s, "opt " + o, a)) : n.push("<dt>" + c + "</dt>" + e.createA(s, "opt " + o, a))
                        } else n.push(e.createA(s, "opt " + o, a));
                    else i.data("divider") === !0 ? n.push('<div class="div-contain"><div class="divider"></div></div>') : t(this).data("hidden") === !0 ? n.push("<a></a>") : n.push(e.createA(s, o, a))
                }), t.each(n, function(t, e) {
                    var n = "<a></a>" === e ? 'class="hide is-hidden"' : "";
                    i += '<li rel="' + t + '"' + n + ">" + e + "</li>"
                }), this.multiple || 0 !== this.$element.find("option:selected").length || this.options.title || this.$element.find("option").eq(0).prop("selected", !0).attr("selected", "selected"), t(i)
            },
            createA: function(t, e, n) {
                return '<a tabindex="0" class="' + e + '" style="' + n + '">' + t + '<i class="' + this.options.iconBase + " " + this.options.tickIcon + ' icon-ok check-mark"></i></a>'
            },
            render: function(e) {
                var n = this;
                e !== !1 && this.$element.find("option").each(function(e) {
                    n.setDisabled(e, t(this).is(":disabled") || t(this).parent().is(":disabled")), n.setSelected(e, t(this).is(":selected"))
                }), this.tabIndex();
                var i = this.$element.find("option:selected").map(function() {
                        var e, i = t(this),
                            o = i.data("icon") && n.options.showIcon ? '<i class="' + n.options.iconBase + " " + i.data("icon") + '"></i> ' : "";
                        return e = n.options.showSubtext && i.attr("data-subtext") && !n.multiple ? ' <small class="muted text-muted">' + i.data("subtext") + "</small>" : "", i.data("content") && n.options.showContent ? i.data("content") : void 0 !== i.attr("title") ? i.attr("title") : o + i.html() + e
                    }).toArray(),
                    o = this.multiple ? i.join(this.options.multipleSeparator) : i[0];
                if (this.multiple && this.options.selectedTextFormat.indexOf("count") > -1) {
                    var a = this.options.selectedTextFormat.split(">"),
                        s = this.options.hideDisabled ? ":not([disabled])" : "";
                    (a.length > 1 && i.length > a[1] || 1 == a.length && i.length >= 2) && (o = this.options.countSelectedText.replace("{0}", i.length).replace("{1}", this.$element.find('option:not([data-divider="true"]):not([data-hidden="true"])' + s).length))
                }
                this.options.title = this.$element.attr("title"), o || (o = void 0 !== this.options.title ? this.options.title : this.options.noneSelectedText), this.$button.attr("title", t.trim(o)), this.$newElement.find(".filter-option").html(o)
            },
            setStyle: function(t, e) {
                this.$element.attr("class") && this.$newElement.addClass(this.$element.attr("class").replace(/selectpicker|mobile-device|validate\[.*\]/gi, ""));
                var n = t ? t : this.options.style;
                "add" == e ? this.$button.addClass(n) : "remove" == e ? this.$button.removeClass(n) : (this.$button.removeClass(this.options.style), this.$button.addClass(n))
            },
            liHeight: function() {
                if (this.options.size !== !1) {
                    var t = this.$menu.parent().clone().find("> .dropdown-toggle").prop("autofocus", !1).end().appendTo("body"),
                        e = t.addClass("open").find("> .dropdown-menu"),
                        n = e.find("li > a").outerHeight(),
                        i = this.options.header ? e.find(".popover-title").outerHeight() : 0,
                        o = this.options.liveSearch ? e.find(".bootstrap-select-searchbox").outerHeight() : 0,
                        a = this.options.actionsBox ? e.find(".bs-actionsbox").outerHeight() : 0;
                    t.remove(), this.$newElement.data("liHeight", n).data("headerHeight", i).data("searchHeight", o).data("actionsHeight", a)
                }
            },
            setSize: function() {
                var e, n, i, o = this,
                    a = this.$menu,
                    s = a.find(".inner"),
                    r = this.$newElement.outerHeight(),
                    l = this.$newElement.data("liHeight"),
                    c = this.$newElement.data("headerHeight"),
                    d = this.$newElement.data("searchHeight"),
                    u = this.$newElement.data("actionsHeight"),
                    p = a.find("li .divider").outerHeight(!0),
                    h = parseInt(a.css("padding-top")) + parseInt(a.css("padding-bottom")) + parseInt(a.css("border-top-width")) + parseInt(a.css("border-bottom-width")),
                    f = this.options.hideDisabled ? ":not(.disabled)" : "",
                    m = t(window),
                    g = h + parseInt(a.css("margin-top")) + parseInt(a.css("margin-bottom")) + 2,
                    v = function() {
                        n = o.$newElement.offset().top - m.scrollTop(),
                            i = m.height() - n - r
                    };
                if (v(), this.options.header && a.css("padding-top", 0), "auto" == this.options.size) {
                    var y = function() {
                        var t, r = o.$lis.not(".hide");
                        v(), e = i - g, o.options.dropupAuto && o.$newElement.toggleClass("dropup", n > i && e - g < a.height()), o.$newElement.hasClass("dropup") && (e = n - g), t = r.length + r.find("dt").length > 3 ? 3 * l + g - 2 : 0;
                        var p;
                        a.hasClass("opened") ? (p = "none", a.removeClass("opened")) : (p = "block", a.addClass("opened")), a.css({
                            "max-height": e + "px",
                            overflow: "hidden",
                            display: p,
                            "min-height": t + c + d + u + "px"
                        }), s.css({
                            "max-height": e - c - d - u - h + "px",
                            "overflow-y": "auto",
                            "min-height": Math.max(t - h, 0) + "px"
                        })
                    };
                    y(), this.$searchbox.off("input.getSize propertychange.getSize").on("input.getSize propertychange.getSize", y), t(window).off("resize.getSize").on("resize.getSize", y), t(window).off("scroll.getSize").on("scroll.getSize", y)
                } else if (this.options.size && "auto" != this.options.size && a.find("li" + f).length > this.options.size) {
                    var b = a.find("li" + f + " > *").filter(":not(.div-contain)").slice(0, this.options.size).last().parent().index(),
                        x = a.find("li").slice(0, b + 1).find(".div-contain").length;
                    e = l * this.options.size + x * p + h, o.options.dropupAuto && this.$newElement.toggleClass("dropup", n > i && e < a.height()), a.css({
                        "max-height": e + c + d + u + "px",
                        overflow: "hidden"
                    }), s.css({
                        "max-height": e - h + "px",
                        "overflow-y": "auto"
                    })
                }
            },
            setWidth: function() {
                if ("auto" == this.options.width) {
                    this.$menu.css("min-width", "0");
                    var t = this.$newElement.clone().appendTo("body"),
                        e = t.find("> .dropdown-menu").css("width"),
                        n = t.css("width", "auto").find("> button").css("width");
                    t.remove(), this.$newElement.css("width", Math.max(parseInt(e), parseInt(n)) + "px")
                } else "fit" == this.options.width ? (this.$menu.css("min-width", ""), this.$newElement.css("width", "").addClass("fit-width")) : this.options.width ? (this.$menu.css("min-width", ""), this.$newElement.css("width", this.options.width)) : (this.$menu.css("min-width", ""), this.$newElement.css("width", ""));
                this.$newElement.hasClass("fit-width") && "fit" !== this.options.width && this.$newElement.removeClass("fit-width")
            },
            selectPosition: function() {
                var e, n, i = this,
                    o = "<div />",
                    a = t(o),
                    s = function(t) {
                        a.addClass(t.attr("class").replace(/form-control/gi, "")).toggleClass("dropup", t.hasClass("dropup")), e = t.offset(), n = t.hasClass("dropup") ? 0 : t[0].offsetHeight, a.css({
                            top: e.top + n,
                            left: e.left,
                            width: t[0].offsetWidth,
                            position: "absolute"
                        })
                    };
                this.$newElement.on("click", function() {
                    i.isDisabled() || (s(t(this)), a.appendTo(i.options.container), a.toggleClass("open", !t(this).hasClass("open")), a.append(i.$menu))
                }), t(window).resize(function() {
                    s(i.$newElement)
                }), t(window).on("scroll", function() {
                    s(i.$newElement)
                }), t("html").on("click", function(e) {
                    t(e.target).closest(i.$newElement).length < 1 && a.removeClass("open")
                })
            },
            mobile: function() {
                this.$element.addClass("mobile-device").appendTo(this.$newElement), this.options.container && this.$menu.hide()
            },
            refresh: function() {
                this.$lis = null, this.reloadLi(), this.render(), this.setWidth(), this.setStyle(), this.checkDisabled(), this.liHeight()
            },
            update: function() {
                this.reloadLi(), this.setWidth(), this.setStyle(), this.checkDisabled(), this.liHeight()
            },
            setSelected: function(e, n) {
                null == this.$lis && (this.$lis = this.$menu.find("li")), t(this.$lis[e]).toggleClass("selected", n)
            },
            setDisabled: function(e, n) {
                null == this.$lis && (this.$lis = this.$menu.find("li")), n ? t(this.$lis[e]).addClass("disabled").find("a").attr("href", "#").attr("tabindex", -1) : t(this.$lis[e]).removeClass("disabled").find("a").removeAttr("href").attr("tabindex", 0)
            },
            isDisabled: function() {
                return this.$element.is(":disabled")
            },
            checkDisabled: function() {
                var t = this;
                this.isDisabled() ? this.$button.addClass("disabled").attr("tabindex", -1) : (this.$button.hasClass("disabled") && this.$button.removeClass("disabled"), -1 == this.$button.attr("tabindex") && (this.$element.data("tabindex") || this.$button.removeAttr("tabindex"))), this.$button.click(function() {
                    return !t.isDisabled()
                })
            },
            tabIndex: function() {
                this.$element.is("[tabindex]") && (this.$element.data("tabindex", this.$element.attr("tabindex")), this.$button.attr("tabindex", this.$element.data("tabindex")))
            },
            clickListener: function() {
                var e = this;
                t("body").on("touchstart.dropdown", ".dropdown-menu", function(t) {
                    t.stopPropagation()
                }), this.$newElement.on("click", function() {
                    e.setSize(), e.options.liveSearch || e.multiple || setTimeout(function() {
                        e.$menu.find(".selected a").focus()
                    }, 10)
                }), this.$menu.on("click", "li a", function(n) {
                    var i = t(this).parent().index(),
                        o = e.$element.val(),
                        a = e.$element.prop("selectedIndex");
                    if (e.multiple && n.stopPropagation(), n.preventDefault(), !e.isDisabled() && !t(this).parent().hasClass("disabled")) {
                        var s = e.$element.find("option"),
                            r = s.eq(i),
                            l = r.prop("selected"),
                            c = r.parent("optgroup"),
                            d = e.options.maxOptions,
                            u = c.data("maxOptions") || !1;
                        if (e.multiple) {
                            if (r.prop("selected", !l), e.setSelected(i, !l), d !== !1 || u !== !1) {
                                var p = d < s.filter(":selected").length,
                                    h = u < c.find("option:selected").length,
                                    f = e.options.maxOptionsText,
                                    m = f[0].replace("{n}", d),
                                    g = f[1].replace("{n}", u),
                                    v = t('<div class="notify"></div>');
                                (d && p || u && h) && (f[2] && (m = m.replace("{var}", f[2][d > 1 ? 0 : 1]), g = g.replace("{var}", f[2][u > 1 ? 0 : 1])), r.prop("selected", !1), e.$menu.append(v), d && p && (v.append(t("<div>" + m + "</div>")), e.$element.trigger("maxReached.bs.select")), u && h && (v.append(t("<div>" + g + "</div>")), e.$element.trigger("maxReachedGrp.bs.select")), setTimeout(function() {
                                    e.setSelected(i, !1)
                                }, 10), v.delay(750).fadeOut(300, function() {
                                    t(this).remove()
                                }))
                            }
                        } else s.prop("selected", !1), r.prop("selected", !0), e.$menu.find(".selected").removeClass("selected"), e.setSelected(i, !0);
                        e.multiple ? e.options.liveSearch && e.$searchbox.focus() : e.$button.focus(), (o != e.$element.val() && e.multiple || a != e.$element.prop("selectedIndex") && !e.multiple) && e.$element.change()
                    }
                }), this.$menu.on("click", "li.disabled a, li dt, li .div-contain, .popover-title, .popover-title :not(.close)", function(t) {
                    t.target == this && (t.preventDefault(), t.stopPropagation(), e.options.liveSearch ? e.$searchbox.focus() : e.$button.focus())
                }), this.$menu.on("click", ".popover-title .close", function() {
                    e.$button.focus()
                }), this.$searchbox.on("click", function(t) {
                    t.stopPropagation()
                }), this.$menu.on("click", ".actions-btn", function(n) {
                    e.options.liveSearch ? e.$searchbox.focus() : e.$button.focus(), n.preventDefault(), n.stopPropagation(), t(this).is(".bs-select-all") ? e.selectAll() : e.deselectAll(), e.$element.change()
                }), this.$element.change(function() {
                    e.render(!1)
                })
            },
            liveSearchListener: function() {
                var e = this,
                    n = t('<li class="no-results"></li>');
                this.$newElement.on("click.dropdown.data-api", function() {
                    e.$menu.find(".active").removeClass("active"), e.$searchbox.val() && (e.$searchbox.val(""), e.$lis.not(".is-hidden").removeClass("hide"), n.parent().length && n.remove()), e.multiple || e.$menu.find(".selected").addClass("active"), setTimeout(function() {
                        e.$searchbox.focus()
                    }, 10)
                }), this.$searchbox.on("input propertychange", function() {
                    e.$searchbox.val() ? (e.$lis.not(".is-hidden").removeClass("hide").find("a").not(":icontains(" + e.$searchbox.val() + ")").parent().addClass("hide"), e.$menu.find("li").filter(":visible:not(.no-results)").length ? n.parent().length && n.remove() : (n.parent().length && n.remove(), n.html(e.options.noneResultsText + ' "' + e.$searchbox.val() + '"').show(), e.$menu.find("li").last().after(n))) : (e.$lis.not(".is-hidden").removeClass("hide"), n.parent().length && n.remove()), e.$menu.find("li.active").removeClass("active"), e.$menu.find("li").filter(":visible:not(.divider)").eq(0).addClass("active").find("a").focus(), t(this).focus()
                }), this.$menu.on("mouseenter", "a", function(n) {
                    e.$menu.find(".active").removeClass("active"), t(n.currentTarget).parent().not(".disabled").addClass("active")
                }), this.$menu.on("mouseleave", "a", function() {
                    e.$menu.find(".active").removeClass("active")
                })
            },
            val: function(t) {
                return void 0 !== t ? (this.$element.val(t), this.$element.change(), this.$element) : this.$element.val()
            },
            selectAll: function() {
                null == this.$lis && (this.$lis = this.$menu.find("li")), this.$element.find("option:enabled").prop("selected", !0), t(this.$lis).filter(":not(.disabled)").addClass("selected"), this.render(!1)
            },
            deselectAll: function() {
                null == this.$lis && (this.$lis = this.$menu.find("li")), this.$element.find("option:enabled").prop("selected", !1), t(this.$lis).filter(":not(.disabled)").removeClass("selected"), this.render(!1)
            },
            keydown: function(e) {
                var n, i, o, a, s, r, l, c, d, u, p, h, f = {
                    32: " ",
                    48: "0",
                    49: "1",
                    50: "2",
                    51: "3",
                    52: "4",
                    53: "5",
                    54: "6",
                    55: "7",
                    56: "8",
                    57: "9",
                    59: ";",
                    65: "a",
                    66: "b",
                    67: "c",
                    68: "d",
                    69: "e",
                    70: "f",
                    71: "g",
                    72: "h",
                    73: "i",
                    74: "j",
                    75: "k",
                    76: "l",
                    77: "m",
                    78: "n",
                    79: "o",
                    80: "p",
                    81: "q",
                    82: "r",
                    83: "s",
                    84: "t",
                    85: "u",
                    86: "v",
                    87: "w",
                    88: "x",
                    89: "y",
                    90: "z",
                    96: "0",
                    97: "1",
                    98: "2",
                    99: "3",
                    100: "4",
                    101: "5",
                    102: "6",
                    103: "7",
                    104: "8",
                    105: "9"
                };
                if (n = t(this), o = n.parent(), n.is("input") && (o = n.parent().parent()), u = o.data("this"), u.options.liveSearch && (o = n.parent().parent()), u.options.container && (o = u.$menu), i = t("[role=menu] li:not(.divider) a", o), h = u.$menu.parent().hasClass("open"), !h && /([0-9]|[A-z])/.test(String.fromCharCode(e.keyCode)) && (u.options.container ? u.$newElement.trigger("click") : (u.setSize(), u.$menu.parent().addClass("open"), h = u.$menu.parent().hasClass("open")), u.$searchbox.focus()), u.options.liveSearch && (/(^9$|27)/.test(e.keyCode) && h && 0 === u.$menu.find(".active").length && (e.preventDefault(), u.$menu.parent().removeClass("open"), u.$button.focus()), i = t("[role=menu] li:not(.divider):visible", o), n.val() || /(38|40)/.test(e.keyCode) || 0 === i.filter(".active").length && (i = u.$newElement.find("li").filter(":icontains(" + f[e.keyCode] + ")"))), i.length) {
                    if (/(38|40)/.test(e.keyCode)) a = i.index(i.filter(":focus")), r = i.parent(":not(.disabled):visible").first().index(), l = i.parent(":not(.disabled):visible").last().index(), s = i.eq(a).parent().nextAll(":not(.disabled):visible").eq(0).index(), c = i.eq(a).parent().prevAll(":not(.disabled):visible").eq(0).index(), d = i.eq(s).parent().prevAll(":not(.disabled):visible").eq(0).index(), u.options.liveSearch && (i.each(function(e) {
                        t(this).is(":not(.disabled)") && t(this).data("index", e)
                    }), a = i.index(i.filter(".active")), r = i.filter(":not(.disabled):visible").first().data("index"), l = i.filter(":not(.disabled):visible").last().data("index"), s = i.eq(a).nextAll(":not(.disabled):visible").eq(0).data("index"), c = i.eq(a).prevAll(":not(.disabled):visible").eq(0).data("index"), d = i.eq(s).prevAll(":not(.disabled):visible").eq(0).data("index")), p = n.data("prevIndex"), 38 == e.keyCode && (u.options.liveSearch && (a -= 1), a != d && a > c && (a = c), r > a && (a = r), a == p && (a = l)), 40 == e.keyCode && (u.options.liveSearch && (a += 1), -1 == a && (a = 0), a != d && s > a && (a = s), a > l && (a = l), a == p && (a = r)), n.data("prevIndex", a), u.options.liveSearch ? (e.preventDefault(), n.is(".dropdown-toggle") || (i.removeClass("active"), i.eq(a).addClass("active").find("a").focus(), n.focus())) : i.eq(a).focus();
                    else if (!n.is("input")) {
                        var m, g, v = [];
                        i.each(function() {
                            t(this).parent().is(":not(.disabled)") && t.trim(t(this).text().toLowerCase()).substring(0, 1) == f[e.keyCode] && v.push(t(this).parent().index())
                        }), m = t(document).data("keycount"), m++, t(document).data("keycount", m), g = t.trim(t(":focus").text().toLowerCase()).substring(0, 1), g != f[e.keyCode] ? (m = 1, t(document).data("keycount", m)) : m >= v.length && (t(document).data("keycount", 0), m > v.length && (m = 1)), i.eq(v[m - 1]).focus()
                    }
                    /(13|32|^9$)/.test(e.keyCode) && h && (/(32)/.test(e.keyCode) || e.preventDefault(), u.options.liveSearch ? /(32)/.test(e.keyCode) || (u.$menu.find(".active a").click(), n.focus()) : t(":focus").click(), t(document).data("keycount", 0)), (/(^9$|27)/.test(e.keyCode) && h && (u.multiple || u.options.liveSearch) || /(27)/.test(e.keyCode) && !h) && (u.$menu.parent().removeClass("open"), u.$button.focus())
                }
            },
            hide: function() {
                this.$newElement.hide()
            },
            show: function() {
                this.$newElement.show()
            },
            destroy: function() {
                this.$newElement.remove(), this.$element.remove()
            }
        }, t.fn.selectpicker = function(n, i) {
            var o, a = arguments,
                s = this.each(function() {
                    if (t(this).is("select")) {
                        var s = t(this),
                            r = s.data("selectpicker"),
                            l = "object" == typeof n && n;
                        if (r) {
                            if (l)
                                for (var c in l) r.options[c] = l[c]
                        } else s.data("selectpicker", r = new e(this, l, i));
                        if ("string" == typeof n) {
                            var d = n;
                            r[d] instanceof Function ? ([].shift.apply(a), o = r[d].apply(r, a)) : o = r.options[d]
                        }
                    }
                });
            return void 0 !== o ? o : s
        }, t.fn.selectpicker.defaults = {
            style: "btn-default",
            size: "auto",
            title: null,
            selectedTextFormat: "values",
            noneSelectedText: "Nothing selected",
            noneResultsText: "No results match",
            countSelectedText: "{0} of {1} selected",
            maxOptionsText: ["Limit reached ({n} {var} max)", "Group limit reached ({n} {var} max)", ["items", "item"]],
            width: !1,
            container: !1,
            hideDisabled: !1,
            showSubtext: !1,
            showIcon: !0,
            showContent: !0,
            dropupAuto: !0,
            header: !1,
            liveSearch: !1,
            actionsBox: !1,
            multipleSeparator: ", ",
            iconBase: "glyphicon",
            tickIcon: "glyphicon-ok",
            maxOptions: !1
        }, t(document).data("keycount", 0).on("keydown", ".bootstrap-select [data-toggle=dropdown], .bootstrap-select [role=menu], .bootstrap-select-searchbox input", e.prototype.keydown).on("focusin.modal", ".bootstrap-select [data-toggle=dropdown], .bootstrap-select [role=menu], .bootstrap-select-searchbox input", function(t) {
            t.stopPropagation()
        })
    }(window.jQuery), $(document).ready(function() {
        $("#pt_menu_link ul li").each(function() {
            var t = document.URL;
            $("#pt_menu_link ul li a").removeClass("act"), $('#pt_menu_link ul li a[href="' + t + '"]').addClass("act")
        }), $(".pt_menu_no_child").hover(function() {
            $(this).addClass("active")
        }, function() {
            $(this).removeClass("active")
        }), $(".pt_menu").hover(function() {
            "pt_menu_link" != $(this).attr("id") && $(this).addClass("active")
        }, function() {
            $(this).removeClass("active")
        }), $(".pt_menu").hover(function() {
            $(this).find(".popup").css("display", "inline-block");
            var t = 0,
                e = $(this).find(".popup").outerWidth(!0),
                n = $(this).find(".popup").width();
            t = e - n;
            var i = $(this).find(".popup .block1").outerWidth(!0),
                o = $(this).find(".popup .block2").outerWidth(!0),
                a = 0;
            i && !o && (a = i), !i && o && (a = o), i && o && (i >= o && (a = i), o > i && (a = o));
            var s = a + t,
                r = $(".pt_custommenu"),
                l = r.outerWidth(),
                c = r.offset(),
                d = $(this).offset(),
                u = d.top - c.top + CUSTOMMENU_POPUP_TOP_OFFSET,
                p = d.left - c.left;
            p + s > l && (p = l - s), $(this).find(".popup").css("top", u), $(this).find(".popup").css("left", p), $(this).find(".popup").css("width", a), $(this).find(".popup .block1").css("width", a), $(this).find(".popup").css("display", "none"), 0 == CUSTOMMENU_POPUP_EFFECT && $(this).find(".popup").stop(!0, !0).slideDown("slow"), 1 == CUSTOMMENU_POPUP_EFFECT && $(this).find(".popup").stop(!0, !0).fadeIn("slow"), 2 == CUSTOMMENU_POPUP_EFFECT && $(this).find(".popup").stop(!0, !0).show("slow")
        }, function() {
            0 == CUSTOMMENU_POPUP_EFFECT && $(this).find(".popup").stop(!0, !0).slideUp(), 1 == CUSTOMMENU_POPUP_EFFECT && $(this).find(".popup").stop(!0, !0).fadeOut("slow"), 2 == CUSTOMMENU_POPUP_EFFECT && $(this).find(".popup").stop(!0, !0).hide("fast")
        }), $(".popup").hover(function() {
            $(this).show()
        }, function() {
            $(this).hide()
        })
    }),
    function(t) {
        t.fn.extend({
            mobilemenu: function() {
                return this.each(function() {
                    function e(e, n) {
                        t(e).parent("li").toggleClass("active").siblings().removeClass("active").children("ul, div").slideUp("fast"), t(e).siblings("ul, div")[n || "slideToggle"](n ? null : "fast")
                    }
                    var n = t(this);
                    if (n.data("accordiated")) return !1;
                    t.each(n.find("ul, li>div"), function() {
                        t(this).data("accordiated", !0), t(this).hide()
                    }), t.each(n.find("span.head"), function() {
                        t(this).click(function(t) {
                            e(this)
                        })
                    });
                    var i = location.hash ? t(this).find("a[href=" + location.hash + "]")[0] : "";
                    i && (e(i, "toggle"), t(i).parents().show())
                })
            }
        })
    }($), $(document).ready(function() {
        $("ul.mobilemenu li span.grower").each(function() {
            $(this).append('<span class="head"><a href="javascript:void(0)"></a></span>')
        }), $("#pt_custommenu_itemmobile").css("display", "none"), $("ul.mobilemenu li.active").each(function() {
            $(this).children().next("ul").css("display", "block")
        }), $(".btn-navbar").click(function() {
            var t = 0;
            $("#navbar-inner").hasClass("navbar-inactive") && 0 == t && ($("#navbar-inner").removeClass("navbar-inactive"), $("#navbar-inner").addClass("navbar-active"), $("#pt_custommenu_itemmobile").css("display", "block"), t = 1), $("#navbar-inner").hasClass("navbar-active") && 0 == t && ($("#navbar-inner").removeClass("navbar-active"), $("#navbar-inner").addClass("navbar-inactive"), $("#pt_custommenu_itemmobile").css("display", "none"), t = 1)
        })
    }),
    function(t) {
        var e = function(e, n) {
            var i = t.extend({}, t.fn.nivoSlider.defaults, n),
                o = {
                    currentSlide: 0,
                    currentImage: "",
                    totalSlides: 0,
                    running: !1,
                    paused: !1,
                    stop: !1,
                    controlNavEl: !1
                },
                a = t(e);
            a.data("nivo:vars", o).addClass("nivoSlider");
            var s = a.children();
            s.each(function() {
                var e = t(this),
                    n = "";
                e.is("img") || (e.is("a") && (e.addClass("nivo-imageLink"), n = e), e = e.find("img:first"));
                var i = 0 === i ? e.attr("width") : e.width(),
                    a = 0 === a ? e.attr("height") : e.height();
                "" !== n && n.css("display", "none"), e.css("display", "none"), o.totalSlides++
            }), i.randomStart && (i.startSlide = Math.floor(Math.random() * o.totalSlides)), i.startSlide > 0 && (i.startSlide >= o.totalSlides && (i.startSlide = o.totalSlides - 1), o.currentSlide = i.startSlide), t(s[o.currentSlide]).is("img") ? o.currentImage = t(s[o.currentSlide]) : o.currentImage = t(s[o.currentSlide]).find("img:first"), t(s[o.currentSlide]).is("a") && t(s[o.currentSlide]).css("display", "block");
            var r = t("<img/>").addClass("nivo-main-image");
            r.attr("src", o.currentImage.attr("src")).show(), a.append(r), t(window).resize(function() {
                a.children("img").width(a.width()), r.attr("src", o.currentImage.attr("src")), r.stop().height("auto"), t(".nivo-slice").remove(), t(".nivo-box").remove()
            }), a.append(t('<div class="nivo-caption"></div>'));
            var l = function(e) {
                var n = t(".nivo-caption", a);
                if ("" != o.currentImage.attr("title") && void 0 != o.currentImage.attr("title")) {
                    var i = o.currentImage.attr("title");
                    "#" == i.substr(0, 1) && (i = t(i).html()), "block" == n.css("display") ? setTimeout(function() {
                        n.html(i)
                    }, e.animSpeed) : (n.html(i), n.stop().fadeIn(e.animSpeed))
                } else n.stop().fadeOut(e.animSpeed)
            };
            l(i);
            var c = 0;
            if (!i.manualAdvance && s.length > 1 && (c = setInterval(function() {
                    f(a, s, i, !1)
                }, i.pauseTime)), i.directionNav && (a.append('<div class="nivo-directionNav"><a class="nivo-prevNav">' + i.prevText + '</a><a class="nivo-nextNav">' + i.nextText + "</a></div>"), t(a).on("click", "a.nivo-prevNav", function() {
                    return o.running ? !1 : (clearInterval(c), c = "", o.currentSlide -= 2, void f(a, s, i, "prev"))
                }), t(a).on("click", "a.nivo-nextNav", function() {
                    return o.running ? !1 : (clearInterval(c), c = "", void f(a, s, i, "next"))
                })), i.controlNav) {
                o.controlNavEl = t('<div class="nivo-controlNav"></div>'), a.after(o.controlNavEl);
                for (var d = 0; d < s.length; d++)
                    if (i.controlNavThumbs) {
                        o.controlNavEl.addClass("nivo-thumbs-enabled");
                        var u = s.eq(d);
                        u.is("img") || (u = u.find("img:first")), u.attr("data-thumb") && o.controlNavEl.append('<a class="nivo-control" rel="' + d + '"><img src="' + u.attr("data-thumb") + '" alt="" /></a>')
                    } else o.controlNavEl.append('<a class="nivo-control" rel="' + d + '">' + (d + 1) + "</a>");
                t("a:eq(" + o.currentSlide + ")", o.controlNavEl).addClass("active"), t("a", o.controlNavEl).bind("click", function() {
                    return o.running ? !1 : t(this).hasClass("active") ? !1 : (clearInterval(c), c = "", r.attr("src", o.currentImage.attr("src")), o.currentSlide = t(this).attr("rel") - 1, void f(a, s, i, "control"))
                })
            }
            i.pauseOnHover && a.hover(function() {
                o.paused = !0, clearInterval(c), c = ""
            }, function() {
                o.paused = !1, "" !== c || i.manualAdvance || (c = setInterval(function() {
                    f(a, s, i, !1)
                }, i.pauseTime))
            }), a.bind("nivo:animFinished", function() {
                r.attr("src", o.currentImage.attr("src")), o.running = !1, t(s).each(function() {
                    t(this).is("a") && t(this).css("display", "none")
                }), t(s[o.currentSlide]).is("a") && t(s[o.currentSlide]).css("display", "block"), "" !== c || o.paused || i.manualAdvance || (c = setInterval(function() {
                    f(a, s, i, !1)
                }, i.pauseTime)), i.afterChange.call(this)
            });
            var p = function(e, n, i) {
                    t(i.currentImage).parent().is("a") && t(i.currentImage).parent().css("display", "block"), t('img[src="' + i.currentImage.attr("src") + '"]', e).not(".nivo-main-image,.nivo-control img").width(e.width()).css("visibility", "hidden").show();
                    for (var o = t('img[src="' + i.currentImage.attr("src") + '"]', e).not(".nivo-main-image,.nivo-control img").parent().is("a") ? t('img[src="' + i.currentImage.attr("src") + '"]', e).not(".nivo-main-image,.nivo-control img").parent().height() : t('img[src="' + i.currentImage.attr("src") + '"]', e).not(".nivo-main-image,.nivo-control img").height(), a = 0; a < n.slices; a++) {
                        var s = Math.round(e.width() / n.slices);
                        a === n.slices - 1 ? e.append(t('<div class="nivo-slice" name="' + a + '"><img src="' + i.currentImage.attr("src") + '" style="position:absolute; width:' + e.width() + "px; height:auto; display:block !important; top:0; left:-" + (s + a * s - s) + 'px;" /></div>').css({
                            left: s * a + "px",
                            width: e.width() - s * a + "px",
                            height: o + "px",
                            opacity: "0",
                            overflow: "hidden"
                        })) : e.append(t('<div class="nivo-slice" name="' + a + '"><img src="' + i.currentImage.attr("src") + '" style="position:absolute; width:' + e.width() + "px; height:auto; display:block !important; top:0; left:-" + (s + a * s - s) + 'px;" /></div>').css({
                            left: s * a + "px",
                            width: s + "px",
                            height: o + "px",
                            opacity: "0",
                            overflow: "hidden"
                        }))
                    }
                    t(".nivo-slice", e).height(o), r.stop().animate({
                        height: t(i.currentImage).height()
                    }, n.animSpeed)
                },
                h = function(e, n, i) {
                    t(i.currentImage).parent().is("a") && t(i.currentImage).parent().css("display", "block"), t('img[src="' + i.currentImage.attr("src") + '"]', e).not(".nivo-main-image,.nivo-control img").width(e.width()).css("visibility", "hidden").show();
                    for (var o = Math.round(e.width() / n.boxCols), a = Math.round(t('img[src="' + i.currentImage.attr("src") + '"]', e).not(".nivo-main-image,.nivo-control img").height() / n.boxRows), s = 0; s < n.boxRows; s++)
                        for (var l = 0; l < n.boxCols; l++) l === n.boxCols - 1 ? (e.append(t('<div class="nivo-box" name="' + l + '" rel="' + s + '"><img src="' + i.currentImage.attr("src") + '" style="position:absolute; width:' + e.width() + "px; height:auto; display:block; top:-" + a * s + "px; left:-" + o * l + 'px;" /></div>').css({
                            opacity: 0,
                            left: o * l + "px",
                            top: a * s + "px",
                            width: e.width() - o * l + "px"
                        })), t('.nivo-box[name="' + l + '"]', e).height(t('.nivo-box[name="' + l + '"] img', e).height() + "px")) : (e.append(t('<div class="nivo-box" name="' + l + '" rel="' + s + '"><img src="' + i.currentImage.attr("src") + '" style="position:absolute; width:' + e.width() + "px; height:auto; display:block; top:-" + a * s + "px; left:-" + o * l + 'px;" /></div>').css({
                            opacity: 0,
                            left: o * l + "px",
                            top: a * s + "px",
                            width: o + "px"
                        })), t('.nivo-box[name="' + l + '"]', e).height(t('.nivo-box[name="' + l + '"] img', e).height() + "px"));
                    r.stop().animate({
                        height: t(i.currentImage).height()
                    }, n.animSpeed)
                },
                f = function(e, n, i, o) {
                    var a = e.data("nivo:vars");
                    if (a && a.currentSlide === a.totalSlides - 1 && i.lastSlide.call(this), (!a || a.stop) && !o) return !1;
                    i.beforeChange.call(this), o ? ("prev" === o && r.attr("src", a.currentImage.attr("src")), "next" === o && r.attr("src", a.currentImage.attr("src"))) : r.attr("src", a.currentImage.attr("src")), a.currentSlide++, a.currentSlide === a.totalSlides && (a.currentSlide = 0, i.slideshowEnd.call(this)), a.currentSlide < 0 && (a.currentSlide = a.totalSlides - 1), t(n[a.currentSlide]).is("img") ? a.currentImage = t(n[a.currentSlide]) : a.currentImage = t(n[a.currentSlide]).find("img:first"), i.controlNav && (t("a", a.controlNavEl).removeClass("active"), t("a:eq(" + a.currentSlide + ")", a.controlNavEl).addClass("active")), l(i), t(".nivo-slice", e).remove(), t(".nivo-box", e).remove();
                    var s = i.effect,
                        c = "";
                    "random" === i.effect && (c = new Array("sliceDownRight", "sliceDownLeft", "sliceUpRight", "sliceUpLeft", "sliceUpDown", "sliceUpDownLeft", "fold", "fade", "boxRandom", "boxRain", "boxRainReverse", "boxRainGrow", "boxRainGrowReverse"), s = c[Math.floor(Math.random() * (c.length + 1))], void 0 === s && (s = "fade")), -1 !== i.effect.indexOf(",") && (c = i.effect.split(","), s = c[Math.floor(Math.random() * c.length)], void 0 === s && (s = "fade")), a.currentImage.attr("data-transition") && (s = a.currentImage.attr("data-transition")), a.running = !0;
                    var d = 0,
                        u = 0,
                        f = "",
                        g = "",
                        v = "",
                        y = "";
                    if ("sliceDown" === s || "sliceDownRight" === s || "sliceDownLeft" === s) p(e, i, a), d = 0, u = 0, f = t(".nivo-slice", e), "sliceDownLeft" === s && (f = t(".nivo-slice", e)._reverse()), f.each(function() {
                        var n = t(this);
                        n.css({
                            top: "0px"
                        }), u === i.slices - 1 ? setTimeout(function() {
                            n.animate({
                                opacity: "1.0"
                            }, i.animSpeed, "", function() {
                                e.trigger("nivo:animFinished")
                            })
                        }, 100 + d) : setTimeout(function() {
                            n.animate({
                                opacity: "1.0"
                            }, i.animSpeed)
                        }, 100 + d), d += 50, u++
                    });
                    else if ("sliceUp" === s || "sliceUpRight" === s || "sliceUpLeft" === s) p(e, i, a), d = 0, u = 0, f = t(".nivo-slice", e), "sliceUpLeft" === s && (f = t(".nivo-slice", e)._reverse()), f.each(function() {
                        var n = t(this);
                        n.css({
                            bottom: "0px"
                        }), u === i.slices - 1 ? setTimeout(function() {
                            n.animate({
                                opacity: "1.0"
                            }, i.animSpeed, "", function() {
                                e.trigger("nivo:animFinished")
                            })
                        }, 100 + d) : setTimeout(function() {
                            n.animate({
                                opacity: "1.0"
                            }, i.animSpeed)
                        }, 100 + d), d += 50, u++
                    });
                    else if ("sliceUpDown" === s || "sliceUpDownRight" === s || "sliceUpDownLeft" === s) {
                        p(e, i, a), d = 0, u = 0;
                        var b = 0;
                        f = t(".nivo-slice", e), "sliceUpDownLeft" === s && (f = t(".nivo-slice", e)._reverse()), f.each(function() {
                            var n = t(this);
                            0 === u ? (n.css("top", "0px"), u++) : (n.css("bottom", "0px"), u = 0), b === i.slices - 1 ? setTimeout(function() {
                                n.animate({
                                    opacity: "1.0"
                                }, i.animSpeed, "", function() {
                                    e.trigger("nivo:animFinished")
                                })
                            }, 100 + d) : setTimeout(function() {
                                n.animate({
                                    opacity: "1.0"
                                }, i.animSpeed)
                            }, 100 + d), d += 50, b++
                        })
                    } else if ("fold" === s) p(e, i, a), d = 0, u = 0, t(".nivo-slice", e).each(function() {
                        var n = t(this),
                            o = n.width();
                        n.css({
                            top: "0px",
                            width: "0px"
                        }), u === i.slices - 1 ? setTimeout(function() {
                            n.animate({
                                width: o,
                                opacity: "1.0"
                            }, i.animSpeed, "", function() {
                                e.trigger("nivo:animFinished")
                            })
                        }, 100 + d) : setTimeout(function() {
                            n.animate({
                                width: o,
                                opacity: "1.0"
                            }, i.animSpeed)
                        }, 100 + d), d += 50, u++
                    });
                    else if ("fade" === s) p(e, i, a), g = t(".nivo-slice:first", e), g.css({
                        width: e.width() + "px"
                    }), g.animate({
                        opacity: "1.0"
                    }, 2 * i.animSpeed, "", function() {
                        e.trigger("nivo:animFinished")
                    });
                    else if ("slideInRight" === s) p(e, i, a), g = t(".nivo-slice:first", e), g.css({
                        width: "0px",
                        opacity: "1"
                    }), g.animate({
                        width: e.width() + "px"
                    }, 2 * i.animSpeed, "", function() {
                        e.trigger("nivo:animFinished")
                    });
                    else if ("slideInLeft" === s) p(e, i, a), g = t(".nivo-slice:first", e), g.css({
                        width: "0px",
                        opacity: "1",
                        left: "",
                        right: "0px"
                    }), g.animate({
                        width: e.width() + "px"
                    }, 2 * i.animSpeed, "", function() {
                        g.css({
                            left: "0px",
                            right: ""
                        }), e.trigger("nivo:animFinished")
                    });
                    else if ("boxRandom" === s) h(e, i, a), v = i.boxCols * i.boxRows, u = 0, d = 0, y = m(t(".nivo-box", e)), y.each(function() {
                        var n = t(this);
                        u === v - 1 ? setTimeout(function() {
                            n.animate({
                                opacity: "1"
                            }, i.animSpeed, "", function() {
                                e.trigger("nivo:animFinished")
                            })
                        }, 100 + d) : setTimeout(function() {
                            n.animate({
                                opacity: "1"
                            }, i.animSpeed)
                        }, 100 + d), d += 20, u++
                    });
                    else if ("boxRain" === s || "boxRainReverse" === s || "boxRainGrow" === s || "boxRainGrowReverse" === s) {
                        h(e, i, a), v = i.boxCols * i.boxRows, u = 0, d = 0;
                        var x = 0,
                            w = 0,
                            _ = [];
                        _[x] = [], y = t(".nivo-box", e), ("boxRainReverse" === s || "boxRainGrowReverse" === s) && (y = t(".nivo-box", e)._reverse()), y.each(function() {
                            _[x][w] = t(this), w++, w === i.boxCols && (x++, w = 0, _[x] = [])
                        });
                        for (var C = 0; C < 2 * i.boxCols; C++) {
                            for (var $ = C, k = 0; k < i.boxRows; k++) $ >= 0 && $ < i.boxCols && (! function(n, o, a, r, l) {
                                var c = t(_[n][o]),
                                    d = c.width(),
                                    u = c.height();
                                ("boxRainGrow" === s || "boxRainGrowReverse" === s) && c.width(0).height(0), r === l - 1 ? setTimeout(function() {
                                    c.animate({
                                        opacity: "1",
                                        width: d,
                                        height: u
                                    }, i.animSpeed / 1.3, "", function() {
                                        e.trigger("nivo:animFinished")
                                    })
                                }, 100 + a) : setTimeout(function() {
                                    c.animate({
                                        opacity: "1",
                                        width: d,
                                        height: u
                                    }, i.animSpeed / 1.3)
                                }, 100 + a)
                            }(k, $, d, u, v), u++), $--;
                            d += 100
                        }
                    }
                },
                m = function(t) {
                    for (var e, n, i = t.length; i; e = parseInt(Math.random() * i, 10), n = t[--i], t[i] = t[e], t[e] = n);
                    return t
                },
                g = function(t) {
                    this.console && "undefined" != typeof console.log && console.log(t)
                };
            return this.stop = function() {
                t(e).data("nivo:vars").stop || (t(e).data("nivo:vars").stop = !0, g("Stop Slider"))
            }, this.start = function() {
                t(e).data("nivo:vars").stop && (t(e).data("nivo:vars").stop = !1, g("Start Slider"))
            }, i.afterLoad.call(this), this
        };
        t.fn.nivoSlider = function(n) {
            return this.each(function(i, o) {
                var a = t(this);
                if (a.data("nivoslider")) return a.data("nivoslider");
                var s = new e(this, n);
                a.data("nivoslider", s)
            })
        }, t.fn.nivoSlider.defaults = {
            effect: "random",
            slices: 15,
            boxCols: 8,
            boxRows: 4,
            animSpeed: 500,
            pauseTime: 3e3,
            startSlide: 0,
            directionNav: !0,
            controlNav: !0,
            controlNavThumbs: !1,
            pauseOnHover: !0,
            manualAdvance: !1,
            prevText: "Prev",
            nextText: "Next",
            randomStart: !1,
            beforeChange: function() {},
            afterChange: function() {},
            slideshowEnd: function() {},
            lastSlide: function() {},
            afterLoad: function() {}
        }, t.fn._reverse = [].reverse
    }(jQuery), $(document).ready(function() {
        $(".back-top").hide(), $(function() {
            $(window).scroll(function() {
                $(this).scrollTop() > 100 ? $(".back-top").fadeIn() : $(".back-top").fadeOut()
            }), $(".back-top").click(function() {
                return $("body,html").animate({
                    scrollTop: 0
                }, 800), !1
            })
        })
    }),
    function() {
        var t = !1;
        window.JQClass = function() {}, JQClass.classes = {}, JQClass.extend = function e(n) {
            function i() {
                !t && this._init && this._init.apply(this, arguments)
            }
            var o = this.prototype;
            t = !0;
            var a = new this;
            t = !1;
            for (var s in n) a[s] = "function" == typeof n[s] && "function" == typeof o[s] ? function(t, e) {
                return function() {
                    var n = this._super;
                    this._super = function(e) {
                        return o[t].apply(this, e)
                    };
                    var i = e.apply(this, arguments);
                    return this._super = n, i
                }
            }(s, n[s]) : n[s];
            return i.prototype = a, i.prototype.constructor = i, i.extend = e, i
        }
    }(),
    function($) {
        function camelCase(t) {
            return t.replace(/-([a-z])/g, function(t, e) {
                return e.toUpperCase()
            })
        }
        JQClass.classes.JQPlugin = JQClass.extend({
            name: "plugin",
            defaultOptions: {},
            regionalOptions: {},
            _getters: [],
            _getMarker: function() {
                return "is-" + this.name
            },
            _init: function() {
                $.extend(this.defaultOptions, this.regionalOptions && this.regionalOptions[""] || {});
                var t = camelCase(this.name);
                $[t] = this, $.fn[t] = function(e) {
                    var n = Array.prototype.slice.call(arguments, 1);
                    return $[t]._isNotChained(e, n) ? $[t][e].apply($[t], [this[0]].concat(n)) : this.each(function() {
                        if ("string" == typeof e) {
                            if ("_" === e[0] || !$[t][e]) throw "Unknown method: " + e;
                            $[t][e].apply($[t], [this].concat(n))
                        } else $[t]._attach(this, e)
                    })
                }
            },
            setDefaults: function(t) {
                $.extend(this.defaultOptions, t || {})
            },
            _isNotChained: function(t, e) {
                return "option" === t && (0 === e.length || 1 === e.length && "string" == typeof e[0]) ? !0 : $.inArray(t, this._getters) > -1
            },
            _attach: function(t, e) {
                if (t = $(t), !t.hasClass(this._getMarker())) {
                    t.addClass(this._getMarker()), e = $.extend({}, this.defaultOptions, this._getMetadata(t), e || {});
                    var n = $.extend({
                        name: this.name,
                        elem: t,
                        options: e
                    }, this._instSettings(t, e));
                    t.data(this.name, n), this._postAttach(t, n), this.option(t, e)
                }
            },
            _instSettings: function(t, e) {
                return {}
            },
            _postAttach: function(t, e) {},
            _getMetadata: function(elem) {
                try {
                    var data = elem.data(this.name.toLowerCase()) || "";
                    data = data.replace(/'/g, '"'), data = data.replace(/([a-zA-Z0-9]+):/g, function(t, e, n) {
                        var i = data.substring(0, n).match(/"/g);
                        return i && i.length % 2 !== 0 ? e + ":" : '"' + e + '":'
                    }), data = $.parseJSON("{" + data + "}");
                    for (var name in data) {
                        var value = data[name];
                        "string" == typeof value && value.match(/^new Date\((.*)\)$/) && (data[name] = eval(value))
                    }
                    return data
                } catch (e) {
                    return {}
                }
            },
            _getInst: function(t) {
                return $(t).data(this.name) || {}
            },
            option: function(t, e, n) {
                t = $(t);
                var i = t.data(this.name);
                if (!e || "string" == typeof e && null == n) {
                    var o = (i || {}).options;
                    return o && e ? o[e] : o
                }
                if (t.hasClass(this._getMarker())) {
                    var o = e || {};
                    "string" == typeof e && (o = {}, o[e] = n), this._optionsChanged(t, i, o), $.extend(i.options, o)
                }
            },
            _optionsChanged: function(t, e, n) {},
            destroy: function(t) {
                t = $(t), t.hasClass(this._getMarker()) && (this._preDestroy(t, this._getInst(t)), t.removeData(this.name).removeClass(this._getMarker()))
            },
            _preDestroy: function(t, e) {}
        }), $.JQPlugin = {
            createPlugin: function(t, e) {
                "object" == typeof t && (e = t, t = "JQPlugin"), t = camelCase(t);
                var n = camelCase(e.name);
                JQClass.classes[n] = JQClass.classes[t].extend(e), new JQClass.classes[n]
            }
        }
    }(jQuery),
    function(t) {
        var e = "countdown",
            n = 0,
            i = 1,
            o = 2,
            a = 3,
            s = 4,
            r = 5,
            l = 6;
        t.JQPlugin.createPlugin({
            name: e,
            defaultOptions: {
                until: null,
                since: null,
                timezone: null,
                serverSync: null,
                format: "dHMS",
                layout: "",
                compact: !1,
                padZeroes: !1,
                significant: 0,
                description: "",
                expiryUrl: "",
                expiryText: "",
                alwaysExpire: !1,
                onExpiry: null,
                onTick: null,
                tickInterval: 1
            },
            regionalOptions: {
                "": {
                    labels: ["Years", "Months", "Weeks", "Days", "Hours", "Minutes", "Seconds"],
                    labels1: ["Year", "Month", "Week", "Day", "Hour", "Minute", "Second"],
                    compactLabels: ["y", "m", "w", "d"],
                    whichLabels: null,
                    digits: ["0", "1", "2", "3", "4", "5", "6", "7", "8", "9"],
                    timeSeparator: ":",
                    isRTL: !1
                }
            },
            _getters: ["getTimes"],
            _rtlClass: e + "-rtl",
            _sectionClass: e + "-section",
            _amountClass: e + "-amount",
            _periodClass: e + "-period",
            _rowClass: e + "-row",
            _holdingClass: e + "-holding",
            _showClass: e + "-show",
            _descrClass: e + "-descr",
            _timerElems: [],
            _init: function() {
                function e(t) {
                    var r = 1e12 > t ? o ? performance.now() + performance.timing.navigationStart : i() : t || i();
                    r - s >= 1e3 && (n._updateElems(), s = r), a(e)
                }
                var n = this;
                this._super(), this._serverSyncs = [];
                var i = "function" == typeof Date.now ? Date.now : function() {
                        return (new Date).getTime()
                    },
                    o = window.performance && "function" == typeof window.performance.now,
                    a = window.requestAnimationFrame || window.webkitRequestAnimationFrame || window.mozRequestAnimationFrame || window.oRequestAnimationFrame || window.msRequestAnimationFrame || null,
                    s = 0;
                !a || t.noRequestAnimationFrame ? (t.noRequestAnimationFrame = null,
                    setInterval(function() {
                        n._updateElems()
                    }, 980)) : (s = window.animationStartTime || window.webkitAnimationStartTime || window.mozAnimationStartTime || window.oAnimationStartTime || window.msAnimationStartTime || i(), a(e))
            },
            UTCDate: function(t, e, n, i, o, a, s, r) {
                "object" == typeof e && e.constructor == Date && (r = e.getMilliseconds(), s = e.getSeconds(), a = e.getMinutes(), o = e.getHours(), i = e.getDate(), n = e.getMonth(), e = e.getFullYear());
                var l = new Date;
                return l.setUTCFullYear(e), l.setUTCDate(1), l.setUTCMonth(n || 0), l.setUTCDate(i || 1), l.setUTCHours(o || 0), l.setUTCMinutes((a || 0) - (Math.abs(t) < 30 ? 60 * t : t)), l.setUTCSeconds(s || 0), l.setUTCMilliseconds(r || 0), l
            },
            periodsToSeconds: function(t) {
                return 31557600 * t[0] + 2629800 * t[1] + 604800 * t[2] + 86400 * t[3] + 3600 * t[4] + 60 * t[5] + t[6]
            },
            _instSettings: function(t, e) {
                return {
                    _periods: [0, 0, 0, 0, 0, 0, 0]
                }
            },
            _addElem: function(t) {
                this._hasElem(t) || this._timerElems.push(t)
            },
            _hasElem: function(e) {
                return t.inArray(e, this._timerElems) > -1
            },
            _removeElem: function(e) {
                this._timerElems = t.map(this._timerElems, function(t) {
                    return t == e ? null : t
                })
            },
            _updateElems: function() {
                for (var t = this._timerElems.length - 1; t >= 0; t--) this._updateCountdown(this._timerElems[t])
            },
            _optionsChanged: function(e, n, i) {
                i.layout && (i.layout = i.layout.replace(/&lt;/g, "<").replace(/&gt;/g, ">")), this._resetExtraLabels(n.options, i);
                var o = n.options.timezone != i.timezone;
                t.extend(n.options, i), this._adjustSettings(e, n, null != i.until || null != i.since || o);
                var a = new Date;
                (n._since && n._since < a || n._until && n._until > a) && this._addElem(e[0]), this._updateCountdown(e, n)
            },
            _updateCountdown: function(e, n) {
                if (e = e.jquery ? e : t(e), n = n || e.data(this.name)) {
                    if (e.html(this._generateHTML(n)).toggleClass(this._rtlClass, n.options.isRTL), t.isFunction(n.options.onTick)) {
                        var i = "lap" != n._hold ? n._periods : this._calculatePeriods(n, n._show, n.options.significant, new Date);
                        (1 == n.options.tickInterval || this.periodsToSeconds(i) % n.options.tickInterval == 0) && n.options.onTick.apply(e[0], [i])
                    }
                    var o = "pause" != n._hold && (n._since ? n._now.getTime() < n._since.getTime() : n._now.getTime() >= n._until.getTime());
                    if (o && !n._expiring) {
                        if (n._expiring = !0, this._hasElem(e[0]) || n.options.alwaysExpire) {
                            if (this._removeElem(e[0]), t.isFunction(n.options.onExpiry) && n.options.onExpiry.apply(e[0], []), n.options.expiryText) {
                                var a = n.options.layout;
                                n.options.layout = n.options.expiryText, this._updateCountdown(e[0], n), n.options.layout = a
                            }
                            n.options.expiryUrl && (window.location = n.options.expiryUrl)
                        }
                        n._expiring = !1
                    } else "pause" == n._hold && this._removeElem(e[0])
                }
            },
            _resetExtraLabels: function(t, e) {
                var n = !1;
                for (var i in e)
                    if ("whichLabels" != i && i.match(/[Ll]abels/)) {
                        n = !0;
                        break
                    }
                if (n)
                    for (var i in t) i.match(/[Ll]abels[02-9]|compactLabels1/) && (t[i] = null)
            },
            _adjustSettings: function(e, n, i) {
                for (var o, a = 0, s = null, r = 0; r < this._serverSyncs.length; r++)
                    if (this._serverSyncs[r][0] == n.options.serverSync) {
                        s = this._serverSyncs[r][1];
                        break
                    }
                if (null != s) a = n.options.serverSync ? s : 0, o = new Date;
                else {
                    var l = t.isFunction(n.options.serverSync) ? n.options.serverSync.apply(e[0], []) : null;
                    o = new Date, a = l ? o.getTime() - l.getTime() : 0, this._serverSyncs.push([n.options.serverSync, a])
                }
                var c = n.options.timezone;
                c = null == c ? -o.getTimezoneOffset() : c, (i || !i && null == n._until && null == n._since) && (n._since = n.options.since, null != n._since && (n._since = this.UTCDate(c, this._determineTime(n._since, null)), n._since && a && n._since.setMilliseconds(n._since.getMilliseconds() + a)), n._until = this.UTCDate(c, this._determineTime(n.options.until, o)), a && n._until.setMilliseconds(n._until.getMilliseconds() + a)), n._show = this._determineShow(n)
            },
            _preDestroy: function(t, e) {
                this._removeElem(t[0]), t.empty()
            },
            pause: function(t) {
                this._hold(t, "pause")
            },
            lap: function(t) {
                this._hold(t, "lap")
            },
            resume: function(t) {
                this._hold(t, null)
            },
            toggle: function(e) {
                var n = t.data(e, this.name) || {};
                this[n._hold ? "resume" : "pause"](e)
            },
            toggleLap: function(e) {
                var n = t.data(e, this.name) || {};
                this[n._hold ? "resume" : "lap"](e)
            },
            _hold: function(e, n) {
                var i = t.data(e, this.name);
                if (i) {
                    if ("pause" == i._hold && !n) {
                        i._periods = i._savePeriods;
                        var o = i._since ? "-" : "+";
                        i[i._since ? "_since" : "_until"] = this._determineTime(o + i._periods[0] + "y" + o + i._periods[1] + "o" + o + i._periods[2] + "w" + o + i._periods[3] + "d" + o + i._periods[4] + "h" + o + i._periods[5] + "m" + o + i._periods[6] + "s"), this._addElem(e)
                    }
                    i._hold = n, i._savePeriods = "pause" == n ? i._periods : null, t.data(e, this.name, i), this._updateCountdown(e, i)
                }
            },
            getTimes: function(e) {
                var n = t.data(e, this.name);
                return n ? "pause" == n._hold ? n._savePeriods : n._hold ? this._calculatePeriods(n, n._show, n.options.significant, new Date) : n._periods : null
            },
            _determineTime: function(t, e) {
                var n = this,
                    i = function(t) {
                        var e = new Date;
                        return e.setTime(e.getTime() + 1e3 * t), e
                    },
                    o = function(t) {
                        t = t.toLowerCase();
                        for (var e = new Date, i = e.getFullYear(), o = e.getMonth(), a = e.getDate(), s = e.getHours(), r = e.getMinutes(), l = e.getSeconds(), c = /([+-]?[0-9]+)\s*(s|m|h|d|w|o|y)?/g, d = c.exec(t); d;) {
                            switch (d[2] || "s") {
                                case "s":
                                    l += parseInt(d[1], 10);
                                    break;
                                case "m":
                                    r += parseInt(d[1], 10);
                                    break;
                                case "h":
                                    s += parseInt(d[1], 10);
                                    break;
                                case "d":
                                    a += parseInt(d[1], 10);
                                    break;
                                case "w":
                                    a += 7 * parseInt(d[1], 10);
                                    break;
                                case "o":
                                    o += parseInt(d[1], 10), a = Math.min(a, n._getDaysInMonth(i, o));
                                    break;
                                case "y":
                                    i += parseInt(d[1], 10), a = Math.min(a, n._getDaysInMonth(i, o))
                            }
                            d = c.exec(t)
                        }
                        return new Date(i, o, a, s, r, l, 0)
                    },
                    a = null == t ? e : "string" == typeof t ? o(t) : "number" == typeof t ? i(t) : t;
                return a && a.setMilliseconds(0), a
            },
            _getDaysInMonth: function(t, e) {
                return 32 - new Date(t, e, 32).getDate()
            },
            _normalLabels: function(t) {
                return t
            },
            _generateHTML: function(e) {
                var c = this;
                e._periods = e._hold ? e._periods : this._calculatePeriods(e, e._show, e.options.significant, new Date);
                for (var d = !1, u = 0, p = e.options.significant, h = t.extend({}, e._show), f = n; l >= f; f++) d |= "?" == e._show[f] && e._periods[f] > 0, h[f] = "?" != e._show[f] || d ? e._show[f] : null, u += h[f] ? 1 : 0, p -= e._periods[f] > 0 ? 1 : 0;
                for (var m = [!1, !1, !1, !1, !1, !1, !1], f = l; f >= n; f--) e._show[f] && (e._periods[f] ? m[f] = !0 : (m[f] = p > 0, p--));
                var g = e.options.compact ? e.options.compactLabels : e.options.labels,
                    v = e.options.whichLabels || this._normalLabels,
                    y = function(t) {
                        var n = e.options["compactLabels" + v(e._periods[t])];
                        return h[t] ? c._translateDigits(e, e._periods[t]) + (n ? n[t] : g[t]) + " " : ""
                    },
                    b = e.options.padZeroes ? 2 : 1,
                    x = function(t) {
                        var n = e.options["labels" + v(e._periods[t])];
                        return !e.options.significant && h[t] || e.options.significant && m[t] ? '<span class="' + c._sectionClass + '"><span class="' + c._amountClass + '">' + c._minDigits(e, e._periods[t], b) + '</span><span class="' + c._periodClass + '">' + (n ? n[t] : g[t]) + "</span></span>" : ""
                    };
                return e.options.layout ? this._buildLayout(e, h, e.options.layout, e.options.compact, e.options.significant, m) : (e.options.compact ? '<span class="' + this._rowClass + " " + this._amountClass + (e._hold ? " " + this._holdingClass : "") + '">' + y(n) + y(i) + y(o) + y(a) + (h[s] ? this._minDigits(e, e._periods[s], 2) : "") + (h[r] ? (h[s] ? e.options.timeSeparator : "") + this._minDigits(e, e._periods[r], 2) : "") + (h[l] ? (h[s] || h[r] ? e.options.timeSeparator : "") + this._minDigits(e, e._periods[l], 2) : "") : '<span class="' + this._rowClass + " " + this._showClass + (e.options.significant || u) + (e._hold ? " " + this._holdingClass : "") + '">' + x(n) + x(i) + x(o) + x(a) + x(s) + x(r) + x(l)) + "</span>" + (e.options.description ? '<span class="' + this._rowClass + " " + this._descrClass + '">' + e.options.description + "</span>" : "")
            },
            _buildLayout: function(e, c, d, u, p, h) {
                for (var f = e.options[u ? "compactLabels" : "labels"], m = e.options.whichLabels || this._normalLabels, g = function(t) {
                        return (e.options[(u ? "compactLabels" : "labels") + m(e._periods[t])] || f)[t]
                    }, v = function(t, n) {
                        return e.options.digits[Math.floor(t / n) % 10]
                    }, y = {
                        desc: e.options.description,
                        sep: e.options.timeSeparator,
                        yl: g(n),
                        yn: this._minDigits(e, e._periods[n], 1),
                        ynn: this._minDigits(e, e._periods[n], 2),
                        ynnn: this._minDigits(e, e._periods[n], 3),
                        y1: v(e._periods[n], 1),
                        y10: v(e._periods[n], 10),
                        y100: v(e._periods[n], 100),
                        y1000: v(e._periods[n], 1e3),
                        ol: g(i),
                        on: this._minDigits(e, e._periods[i], 1),
                        onn: this._minDigits(e, e._periods[i], 2),
                        onnn: this._minDigits(e, e._periods[i], 3),
                        o1: v(e._periods[i], 1),
                        o10: v(e._periods[i], 10),
                        o100: v(e._periods[i], 100),
                        o1000: v(e._periods[i], 1e3),
                        wl: g(o),
                        wn: this._minDigits(e, e._periods[o], 1),
                        wnn: this._minDigits(e, e._periods[o], 2),
                        wnnn: this._minDigits(e, e._periods[o], 3),
                        w1: v(e._periods[o], 1),
                        w10: v(e._periods[o], 10),
                        w100: v(e._periods[o], 100),
                        w1000: v(e._periods[o], 1e3),
                        dl: g(a),
                        dn: this._minDigits(e, e._periods[a], 1),
                        dnn: this._minDigits(e, e._periods[a], 2),
                        dnnn: this._minDigits(e, e._periods[a], 3),
                        d1: v(e._periods[a], 1),
                        d10: v(e._periods[a], 10),
                        d100: v(e._periods[a], 100),
                        d1000: v(e._periods[a], 1e3),
                        hl: g(s),
                        hn: this._minDigits(e, e._periods[s], 1),
                        hnn: this._minDigits(e, e._periods[s], 2),
                        hnnn: this._minDigits(e, e._periods[s], 3),
                        h1: v(e._periods[s], 1),
                        h10: v(e._periods[s], 10),
                        h100: v(e._periods[s], 100),
                        h1000: v(e._periods[s], 1e3),
                        ml: g(r),
                        mn: this._minDigits(e, e._periods[r], 1),
                        mnn: this._minDigits(e, e._periods[r], 2),
                        mnnn: this._minDigits(e, e._periods[r], 3),
                        m1: v(e._periods[r], 1),
                        m10: v(e._periods[r], 10),
                        m100: v(e._periods[r], 100),
                        m1000: v(e._periods[r], 1e3),
                        sl: g(l),
                        sn: this._minDigits(e, e._periods[l], 1),
                        snn: this._minDigits(e, e._periods[l], 2),
                        snnn: this._minDigits(e, e._periods[l], 3),
                        s1: v(e._periods[l], 1),
                        s10: v(e._periods[l], 10),
                        s100: v(e._periods[l], 100),
                        s1000: v(e._periods[l], 1e3)
                    }, b = d, x = n; l >= x; x++) {
                    var w = "yowdhms".charAt(x),
                        _ = new RegExp("\\{" + w + "<\\}([\\s\\S]*)\\{" + w + ">\\}", "g");
                    b = b.replace(_, !p && c[x] || p && h[x] ? "$1" : "")
                }
                return t.each(y, function(t, e) {
                    var n = new RegExp("\\{" + t + "\\}", "g");
                    b = b.replace(n, e)
                }), b
            },
            _minDigits: function(t, e, n) {
                return e = "" + e, e.length >= n ? this._translateDigits(t, e) : (e = "0000000000" + e, this._translateDigits(t, e.substr(e.length - n)))
            },
            _translateDigits: function(t, e) {
                return ("" + e).replace(/[0-9]/g, function(e) {
                    return t.options.digits[e]
                })
            },
            _determineShow: function(t) {
                var e = t.options.format,
                    c = [];
                return c[n] = e.match("y") ? "?" : e.match("Y") ? "!" : null, c[i] = e.match("o") ? "?" : e.match("O") ? "!" : null, c[o] = e.match("w") ? "?" : e.match("W") ? "!" : null, c[a] = e.match("d") ? "?" : e.match("D") ? "!" : null, c[s] = e.match("h") ? "?" : e.match("H") ? "!" : null, c[r] = e.match("m") ? "?" : e.match("M") ? "!" : null, c[l] = e.match("s") ? "?" : e.match("S") ? "!" : null, c
            },
            _calculatePeriods: function(t, e, c, d) {
                t._now = d, t._now.setMilliseconds(0);
                var u = new Date(t._now.getTime());
                t._since ? d.getTime() < t._since.getTime() ? t._now = d = u : d = t._since : (u.setTime(t._until.getTime()), d.getTime() > t._until.getTime() && (t._now = d = u));
                var p = [0, 0, 0, 0, 0, 0, 0];
                if (e[n] || e[i]) {
                    var h = this._getDaysInMonth(d.getFullYear(), d.getMonth()),
                        f = this._getDaysInMonth(u.getFullYear(), u.getMonth()),
                        m = u.getDate() == d.getDate() || u.getDate() >= Math.min(h, f) && d.getDate() >= Math.min(h, f),
                        g = function(t) {
                            return 60 * (60 * t.getHours() + t.getMinutes()) + t.getSeconds()
                        },
                        v = Math.max(0, 12 * (u.getFullYear() - d.getFullYear()) + u.getMonth() - d.getMonth() + (u.getDate() < d.getDate() && !m || m && g(u) < g(d) ? -1 : 0));
                    p[n] = e[n] ? Math.floor(v / 12) : 0, p[i] = e[i] ? v - 12 * p[n] : 0, d = new Date(d.getTime());
                    var y = d.getDate() == h,
                        b = this._getDaysInMonth(d.getFullYear() + p[n], d.getMonth() + p[i]);
                    d.getDate() > b && d.setDate(b), d.setFullYear(d.getFullYear() + p[n]), d.setMonth(d.getMonth() + p[i]), y && d.setDate(b)
                }
                var x = Math.floor((u.getTime() - d.getTime()) / 1e3),
                    w = function(t, n) {
                        p[t] = e[t] ? Math.floor(x / n) : 0, x -= p[t] * n
                    };
                if (w(o, 604800), w(a, 86400), w(s, 3600), w(r, 60), w(l, 1), x > 0 && !t._since)
                    for (var _ = [1, 12, 4.3482, 7, 24, 60, 60], C = l, $ = 1, k = l; k >= n; k--) e[k] && (p[C] >= $ && (p[C] = 0, x = 1), x > 0 && (p[k]++, x = 0, C = k, $ = 1)), $ *= _[k];
                if (c)
                    for (var k = n; l >= k; k++) c && p[k] ? c-- : c || (p[k] = 0);
                return p
            }
        })
    }(jQuery), $(document).ready(function() {
        $("#home-page-tabs li:first, #index .tab-content ul:first").addClass("active")
    });