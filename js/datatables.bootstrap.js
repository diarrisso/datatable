/*! DataTables Bootstrap 4 integration
 * ©2011-2017 SpryMedia Ltd - datatables.net/license
 */
!(function (t) {
    "function" == typeof define && define.amd
        ? define(["jquery", "datatables.net"], function (e) {
            return t(e, window, document);
        })
        : "object" == typeof exports
            ? (module.exports = function (e, a) {
                return (e = e || window), (a = a || ("undefined" != typeof window ? require("jquery") : require("jquery")(e))).fn.dataTable || require("datatables.net")(e, a), t(a, 0, e.document);
            })
            : t(jQuery, window, document);
})(function (x, e, n, o) {
    "use strict";
    var r = x.fn.dataTable;
    return (
        x.extend(!0, r.defaults, { dom: "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>><'row'<'col-sm-12'tr>><'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>", renderer: "bootstrap" }),
            x.extend(r.ext.classes, {
                sWrapper: "dataTables_wrapper dt-bootstrap4",
                sFilterInput: "form-control form-control-sm",
                sLengthSelect: "custom-select custom-select-sm form-control form-control-sm",
                sProcessing: "dataTables_processing card",
                sPageButton: "paginate_button page-item",
            }),
            (r.ext.renderer.pageButton.bootstrap = function (i, e, d, a, l, c) {
                function u(e, a) {
                    for (
                        var t,
                            n,
                            o = function (e) {
                                e.preventDefault(), x(e.currentTarget).hasClass("disabled") || m.page() == e.data.action || m.page(e.data.action).draw("page");
                            },
                            r = 0,
                            s = a.length;
                        r < s;
                        r++
                    )
                        if (((n = a[r]), Array.isArray(n))) u(e, n);
                        else {
                            switch (((f = p = ""), n)) {
                                case "ellipsis":
                                    (p = "&#x2026;"), (f = "disabled");
                                    break;
                                case "first":
                                    (p = g.sFirst), (f = n + (0 < l ? "" : " disabled"));
                                    break;
                                case "previous":
                                    (p = g.sPrevious), (f = n + (0 < l ? "" : " disabled"));
                                    break;
                                case "next":
                                    (p = g.sNext), (f = n + (l < c - 1 ? "" : " disabled"));
                                    break;
                                case "last":
                                    (p = g.sLast), (f = n + (l < c - 1 ? "" : " disabled"));
                                    break;
                                default:
                                    (p = n + 1), (f = l === n ? "active" : "");
                            }
                            p &&
                            ((t = x("<li>", { class: b.sPageButton + " " + f, id: 0 === d && "string" == typeof n ? i.sTableId + "_" + n : null })
                                .append(x("<a>", { href: "#", "aria-controls": i.sTableId, "aria-label": w[n], "data-dt-idx": n, tabindex: i.iTabIndex, class: "page-link" }).html(p))
                                .appendTo(e)),
                                i.oApi._fnBindAction(t, { action: n }, o));
                        }
                }
                var p,
                    f,
                    t,
                    m = new r.Api(i),
                    b = i.oClasses,
                    g = i.oLanguage.oPaginate,
                    w = i.oLanguage.oAria.paginate || {};
                try {
                    t = x(e).find(n.activeElement).data("dt-idx");
                } catch (e) {}
                u(x(e).empty().html('<ul class="pagination"/>').children("ul"), a),
                t !== o &&
                x(e)
                    .find("[data-dt-idx=" + t + "]")
                    .trigger("focus");
            }),
            r
    );
});
