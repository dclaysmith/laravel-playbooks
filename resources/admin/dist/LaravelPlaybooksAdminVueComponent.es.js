import { resolveComponent as ue, openBlock as M, createElementBlock as z, createElementVNode as q, createVNode as fe, withCtx as he, createTextVNode as Gt, Fragment as pt, shallowRef as Wt, unref as Z, shallowReactive as Kt, nextTick as zt, defineComponent as ie, reactive as qt, inject as ne, computed as I, h as mt, provide as _e, ref as Qt, watch as gt, getCurrentInstance as vt, watchEffect as Ft, createBlock as Te, TransitionGroup as yt, renderSlot as Ie, normalizeStyle as ze, resolveDynamicComponent as Yt, renderList as Jt, normalizeClass as qe, createCommentVNode as Xt, createApp as Zt } from "vue";
const De = (e, t) => {
  const n = e.__vccOpts || e;
  for (const [o, r] of t)
    n[o] = r;
  return n;
}, en = {
  name: "LaravelPlaybooksAdminMenu"
};
function tn(e, t, n, o, r, i) {
  const a = ue("router-link");
  return M(), z("ul", null, [
    q("li", null, [
      fe(a, { to: "/playbooks" }, {
        default: he(() => [
          Gt("Playbooks")
        ]),
        _: 1
      })
    ])
  ]);
}
const nn = /* @__PURE__ */ De(en, [["render", tn]]);
const on = {
  name: "LaravelPlaybooksAdminVueComponent",
  components: {
    AdminMenu: nn
  }
}, rn = { class: "playbooks-container" }, sn = { class: "playbooks-menu" }, an = { class: "playbooks-content" };
function cn(e, t, n, o, r, i) {
  const a = ue("notifications"), d = ue("admin-menu"), l = ue("router-view");
  return M(), z(pt, null, [
    fe(a),
    q("div", rn, [
      q("div", sn, [
        fe(d)
      ]),
      q("div", an, [
        fe(l)
      ])
    ])
  ], 64);
}
const ln = /* @__PURE__ */ De(on, [["render", cn]]);
function un() {
  return Et().__VUE_DEVTOOLS_GLOBAL_HOOK__;
}
function Et() {
  return typeof navigator < "u" && typeof window < "u" ? window : typeof global < "u" ? global : {};
}
const fn = typeof Proxy == "function", dn = "devtools-plugin:setup", hn = "plugin:settings:set";
let K, Ne;
function pn() {
  var e;
  return K !== void 0 || (typeof window < "u" && window.performance ? (K = !0, Ne = window.performance) : typeof global < "u" && ((e = global.perf_hooks) === null || e === void 0 ? void 0 : e.performance) ? (K = !0, Ne = global.perf_hooks.performance) : K = !1), K;
}
function mn() {
  return pn() ? Ne.now() : Date.now();
}
class gn {
  constructor(t, n) {
    this.target = null, this.targetQueue = [], this.onQueue = [], this.plugin = t, this.hook = n;
    const o = {};
    if (t.settings)
      for (const a in t.settings) {
        const d = t.settings[a];
        o[a] = d.defaultValue;
      }
    const r = `__vue-devtools-plugin-settings__${t.id}`;
    let i = Object.assign({}, o);
    try {
      const a = localStorage.getItem(r), d = JSON.parse(a);
      Object.assign(i, d);
    } catch {
    }
    this.fallbacks = {
      getSettings() {
        return i;
      },
      setSettings(a) {
        try {
          localStorage.setItem(r, JSON.stringify(a));
        } catch {
        }
        i = a;
      },
      now() {
        return mn();
      }
    }, n && n.on(hn, (a, d) => {
      a === this.plugin.id && this.fallbacks.setSettings(d);
    }), this.proxiedOn = new Proxy({}, {
      get: (a, d) => this.target ? this.target.on[d] : (...l) => {
        this.onQueue.push({
          method: d,
          args: l
        });
      }
    }), this.proxiedTarget = new Proxy({}, {
      get: (a, d) => this.target ? this.target[d] : d === "on" ? this.proxiedOn : Object.keys(this.fallbacks).includes(d) ? (...l) => (this.targetQueue.push({
        method: d,
        args: l,
        resolve: () => {
        }
      }), this.fallbacks[d](...l)) : (...l) => new Promise((h) => {
        this.targetQueue.push({
          method: d,
          args: l,
          resolve: h
        });
      })
    });
  }
  async setRealTarget(t) {
    this.target = t;
    for (const n of this.onQueue)
      this.target.on[n.method](...n.args);
    for (const n of this.targetQueue)
      n.resolve(await this.target[n.method](...n.args));
  }
}
function vn(e, t) {
  const n = e, o = Et(), r = un(), i = fn && n.enableEarlyProxy;
  if (r && (o.__VUE_DEVTOOLS_PLUGIN_API_AVAILABLE__ || !i))
    r.emit(dn, e, t);
  else {
    const a = i ? new gn(n, r) : null;
    (o.__VUE_DEVTOOLS_PLUGINS__ = o.__VUE_DEVTOOLS_PLUGINS__ || []).push({
      pluginDescriptor: n,
      setupFn: t,
      proxy: a
    }), a && t(a.proxiedTarget);
  }
}
/*!
  * vue-router v4.2.4
  * (c) 2023 Eduardo San Martin Morote
  * @license MIT
  */
const L = typeof window < "u";
function yn(e) {
  return e.__esModule || e[Symbol.toStringTag] === "Module";
}
const R = Object.assign;
function be(e, t) {
  const n = {};
  for (const o in t) {
    const r = t[o];
    n[o] = T(r) ? r.map(e) : e(r);
  }
  return n;
}
const ee = () => {
}, T = Array.isArray;
function k(e) {
  const t = Array.from(arguments).slice(1);
  console.warn.apply(console, ["[Vue Router warn]: " + e].concat(t));
}
const En = /\/$/, _n = (e) => e.replace(En, "");
function we(e, t, n = "/") {
  let o, r = {}, i = "", a = "";
  const d = t.indexOf("#");
  let l = t.indexOf("?");
  return d < l && d >= 0 && (l = -1), l > -1 && (o = t.slice(0, l), i = t.slice(l + 1, d > -1 ? d : t.length), r = e(i)), d > -1 && (o = o || t.slice(0, d), a = t.slice(d, t.length)), o = kn(o != null ? o : t, n), {
    fullPath: o + (i && "?") + i + a,
    path: o,
    query: r,
    hash: a
  };
}
function bn(e, t) {
  const n = t.query ? e(t.query) : "";
  return t.path + (n && "?") + n + (t.hash || "");
}
function Qe(e, t) {
  return !t || !e.toLowerCase().startsWith(t.toLowerCase()) ? e : e.slice(t.length) || "/";
}
function Fe(e, t, n) {
  const o = t.matched.length - 1, r = n.matched.length - 1;
  return o > -1 && o === r && B(t.matched[o], n.matched[r]) && _t(t.params, n.params) && e(t.query) === e(n.query) && t.hash === n.hash;
}
function B(e, t) {
  return (e.aliasOf || e) === (t.aliasOf || t);
}
function _t(e, t) {
  if (Object.keys(e).length !== Object.keys(t).length)
    return !1;
  for (const n in e)
    if (!wn(e[n], t[n]))
      return !1;
  return !0;
}
function wn(e, t) {
  return T(e) ? Ye(e, t) : T(t) ? Ye(t, e) : e === t;
}
function Ye(e, t) {
  return T(t) ? e.length === t.length && e.every((n, o) => n === t[o]) : e.length === 1 && e[0] === t;
}
function kn(e, t) {
  if (e.startsWith("/"))
    return e;
  if (process.env.NODE_ENV !== "production" && !t.startsWith("/"))
    return k(`Cannot resolve a relative location without an absolute path. Trying to resolve "${e}" from "${t}". It should look like "/${t}".`), e;
  if (!e)
    return t;
  const n = t.split("/"), o = e.split("/"), r = o[o.length - 1];
  (r === ".." || r === ".") && o.push("");
  let i = n.length - 1, a, d;
  for (a = 0; a < o.length; a++)
    if (d = o[a], d !== ".")
      if (d === "..")
        i > 1 && i--;
      else
        break;
  return n.slice(0, i).join("/") + "/" + o.slice(a - (a === o.length ? 1 : 0)).join("/");
}
var oe;
(function(e) {
  e.pop = "pop", e.push = "push";
})(oe || (oe = {}));
var te;
(function(e) {
  e.back = "back", e.forward = "forward", e.unknown = "";
})(te || (te = {}));
function Sn(e) {
  if (!e)
    if (L) {
      const t = document.querySelector("base");
      e = t && t.getAttribute("href") || "/", e = e.replace(/^\w+:\/\/[^\/]+/, "");
    } else
      e = "/";
  return e[0] !== "/" && e[0] !== "#" && (e = "/" + e), _n(e);
}
const Rn = /^[^#]+#/;
function Nn(e, t) {
  return e.replace(Rn, "#") + t;
}
function On(e, t) {
  const n = document.documentElement.getBoundingClientRect(), o = e.getBoundingClientRect();
  return {
    behavior: t.behavior,
    left: o.left - n.left - (t.left || 0),
    top: o.top - n.top - (t.top || 0)
  };
}
const pe = () => ({
  left: window.pageXOffset,
  top: window.pageYOffset
});
function xn(e) {
  let t;
  if ("el" in e) {
    const n = e.el, o = typeof n == "string" && n.startsWith("#");
    if (process.env.NODE_ENV !== "production" && typeof e.el == "string" && (!o || !document.getElementById(e.el.slice(1))))
      try {
        const i = document.querySelector(e.el);
        if (o && i) {
          k(`The selector "${e.el}" should be passed as "el: document.querySelector('${e.el}')" because it starts with "#".`);
          return;
        }
      } catch {
        k(`The selector "${e.el}" is invalid. If you are using an id selector, make sure to escape it. You can find more information about escaping characters in selectors at https://mathiasbynens.be/notes/css-escapes or use CSS.escape (https://developer.mozilla.org/en-US/docs/Web/API/CSS/escape).`);
        return;
      }
    const r = typeof n == "string" ? o ? document.getElementById(n.slice(1)) : document.querySelector(n) : n;
    if (!r) {
      process.env.NODE_ENV !== "production" && k(`Couldn't find element using selector "${e.el}" returned by scrollBehavior.`);
      return;
    }
    t = On(r, e);
  } else
    t = e;
  "scrollBehavior" in document.documentElement.style ? window.scrollTo(t) : window.scrollTo(t.left != null ? t.left : window.pageXOffset, t.top != null ? t.top : window.pageYOffset);
}
function Je(e, t) {
  return (history.state ? history.state.position - t : -1) + e;
}
const Oe = /* @__PURE__ */ new Map();
function $n(e, t) {
  Oe.set(e, t);
}
function Pn(e) {
  const t = Oe.get(e);
  return Oe.delete(e), t;
}
let Cn = () => location.protocol + "//" + location.host;
function bt(e, t) {
  const { pathname: n, search: o, hash: r } = t, i = e.indexOf("#");
  if (i > -1) {
    let d = r.includes(e.slice(i)) ? e.slice(i).length : 1, l = r.slice(d);
    return l[0] !== "/" && (l = "/" + l), Qe(l, "");
  }
  return Qe(n, e) + o + r;
}
function An(e, t, n, o) {
  let r = [], i = [], a = null;
  const d = ({ state: f }) => {
    const p = bt(e, location), y = n.value, $ = t.value;
    let N = 0;
    if (f) {
      if (n.value = p, t.value = f, a && a === y) {
        a = null;
        return;
      }
      N = $ ? f.position - $.position : 0;
    } else
      o(p);
    r.forEach((E) => {
      E(n.value, y, {
        delta: N,
        type: oe.pop,
        direction: N ? N > 0 ? te.forward : te.back : te.unknown
      });
    });
  };
  function l() {
    a = n.value;
  }
  function h(f) {
    r.push(f);
    const p = () => {
      const y = r.indexOf(f);
      y > -1 && r.splice(y, 1);
    };
    return i.push(p), p;
  }
  function s() {
    const { history: f } = window;
    !f.state || f.replaceState(R({}, f.state, { scroll: pe() }), "");
  }
  function c() {
    for (const f of i)
      f();
    i = [], window.removeEventListener("popstate", d), window.removeEventListener("beforeunload", s);
  }
  return window.addEventListener("popstate", d), window.addEventListener("beforeunload", s, {
    passive: !0
  }), {
    pauseListeners: l,
    listen: h,
    destroy: c
  };
}
function Xe(e, t, n, o = !1, r = !1) {
  return {
    back: e,
    current: t,
    forward: n,
    replaced: o,
    position: window.history.length,
    scroll: r ? pe() : null
  };
}
function Tn(e) {
  const { history: t, location: n } = window, o = {
    value: bt(e, n)
  }, r = { value: t.state };
  r.value || i(o.value, {
    back: null,
    current: o.value,
    forward: null,
    position: t.length - 1,
    replaced: !0,
    scroll: null
  }, !0);
  function i(l, h, s) {
    const c = e.indexOf("#"), f = c > -1 ? (n.host && document.querySelector("base") ? e : e.slice(c)) + l : Cn() + e + l;
    try {
      t[s ? "replaceState" : "pushState"](h, "", f), r.value = h;
    } catch (p) {
      process.env.NODE_ENV !== "production" ? k("Error with push/replace State", p) : console.error(p), n[s ? "replace" : "assign"](f);
    }
  }
  function a(l, h) {
    const s = R({}, t.state, Xe(
      r.value.back,
      l,
      r.value.forward,
      !0
    ), h, { position: r.value.position });
    i(l, s, !0), o.value = l;
  }
  function d(l, h) {
    const s = R(
      {},
      r.value,
      t.state,
      {
        forward: l,
        scroll: pe()
      }
    );
    process.env.NODE_ENV !== "production" && !t.state && k(`history.state seems to have been manually replaced without preserving the necessary values. Make sure to preserve existing history state if you are manually calling history.replaceState:

history.replaceState(history.state, '', url)

You can find more information at https://next.router.vuejs.org/guide/migration/#usage-of-history-state.`), i(s.current, s, !0);
    const c = R({}, Xe(o.value, l, null), { position: s.position + 1 }, h);
    i(l, c, !1), o.value = l;
  }
  return {
    location: o,
    state: r,
    push: d,
    replace: a
  };
}
function In(e) {
  e = Sn(e);
  const t = Tn(e), n = An(e, t.state, t.location, t.replace);
  function o(i, a = !0) {
    a || n.pauseListeners(), history.go(i);
  }
  const r = R({
    location: "",
    base: e,
    go: o,
    createHref: Nn.bind(null, e)
  }, t, n);
  return Object.defineProperty(r, "location", {
    enumerable: !0,
    get: () => t.location.value
  }), Object.defineProperty(r, "state", {
    enumerable: !0,
    get: () => t.state.value
  }), r;
}
function Dn(e) {
  return e = location.host ? e || location.pathname + location.search : "", e.includes("#") || (e += "#"), process.env.NODE_ENV !== "production" && !e.endsWith("#/") && !e.endsWith("#") && k(`A hash base must end with a "#":
"${e}" should be "${e.replace(/#.*$/, "#")}".`), In(e);
}
function Vn(e) {
  return typeof e == "string" || e && typeof e == "object";
}
function wt(e) {
  return typeof e == "string" || typeof e == "symbol";
}
const j = {
  path: "/",
  name: void 0,
  params: {},
  query: {},
  hash: "",
  fullPath: "/",
  matched: [],
  meta: {},
  redirectedFrom: void 0
}, xe = Symbol(process.env.NODE_ENV !== "production" ? "navigation failure" : "");
var Ze;
(function(e) {
  e[e.aborted = 4] = "aborted", e[e.cancelled = 8] = "cancelled", e[e.duplicated = 16] = "duplicated";
})(Ze || (Ze = {}));
const Ln = {
  [1]({ location: e, currentLocation: t }) {
    return `No match for
 ${JSON.stringify(e)}${t ? `
while being at
` + JSON.stringify(t) : ""}`;
  },
  [2]({ from: e, to: t }) {
    return `Redirected from "${e.fullPath}" to "${jn(t)}" via a navigation guard.`;
  },
  [4]({ from: e, to: t }) {
    return `Navigation aborted from "${e.fullPath}" to "${t.fullPath}" via a navigation guard.`;
  },
  [8]({ from: e, to: t }) {
    return `Navigation cancelled from "${e.fullPath}" to "${t.fullPath}" with a new navigation.`;
  },
  [16]({ from: e, to: t }) {
    return `Avoided redundant navigation to current location: "${e.fullPath}".`;
  }
};
function Q(e, t) {
  return process.env.NODE_ENV !== "production" ? R(new Error(Ln[e](t)), {
    type: e,
    [xe]: !0
  }, t) : R(new Error(), {
    type: e,
    [xe]: !0
  }, t);
}
function V(e, t) {
  return e instanceof Error && xe in e && (t == null || !!(e.type & t));
}
const Mn = ["params", "query", "hash"];
function jn(e) {
  if (typeof e == "string")
    return e;
  if ("path" in e)
    return e.path;
  const t = {};
  for (const n of Mn)
    n in e && (t[n] = e[n]);
  return JSON.stringify(t, null, 2);
}
const et = "[^/]+?", Un = {
  sensitive: !1,
  strict: !1,
  start: !0,
  end: !0
}, Bn = /[.+*?^${}()[\]/\\]/g;
function Hn(e, t) {
  const n = R({}, Un, t), o = [];
  let r = n.start ? "^" : "";
  const i = [];
  for (const h of e) {
    const s = h.length ? [] : [90];
    n.strict && !h.length && (r += "/");
    for (let c = 0; c < h.length; c++) {
      const f = h[c];
      let p = 40 + (n.sensitive ? 0.25 : 0);
      if (f.type === 0)
        c || (r += "/"), r += f.value.replace(Bn, "\\$&"), p += 40;
      else if (f.type === 1) {
        const { value: y, repeatable: $, optional: N, regexp: E } = f;
        i.push({
          name: y,
          repeatable: $,
          optional: N
        });
        const b = E || et;
        if (b !== et) {
          p += 10;
          try {
            new RegExp(`(${b})`);
          } catch (A) {
            throw new Error(`Invalid custom RegExp for param "${y}" (${b}): ` + A.message);
          }
        }
        let x = $ ? `((?:${b})(?:/(?:${b}))*)` : `(${b})`;
        c || (x = N && h.length < 2 ? `(?:/${x})` : "/" + x), N && (x += "?"), r += x, p += 20, N && (p += -8), $ && (p += -20), b === ".*" && (p += -50);
      }
      s.push(p);
    }
    o.push(s);
  }
  if (n.strict && n.end) {
    const h = o.length - 1;
    o[h][o[h].length - 1] += 0.7000000000000001;
  }
  n.strict || (r += "/?"), n.end ? r += "$" : n.strict && (r += "(?:/|$)");
  const a = new RegExp(r, n.sensitive ? "" : "i");
  function d(h) {
    const s = h.match(a), c = {};
    if (!s)
      return null;
    for (let f = 1; f < s.length; f++) {
      const p = s[f] || "", y = i[f - 1];
      c[y.name] = p && y.repeatable ? p.split("/") : p;
    }
    return c;
  }
  function l(h) {
    let s = "", c = !1;
    for (const f of e) {
      (!c || !s.endsWith("/")) && (s += "/"), c = !1;
      for (const p of f)
        if (p.type === 0)
          s += p.value;
        else if (p.type === 1) {
          const { value: y, repeatable: $, optional: N } = p, E = y in h ? h[y] : "";
          if (T(E) && !$)
            throw new Error(`Provided param "${y}" is an array but it is not repeatable (* or + modifiers)`);
          const b = T(E) ? E.join("/") : E;
          if (!b)
            if (N)
              f.length < 2 && (s.endsWith("/") ? s = s.slice(0, -1) : c = !0);
            else
              throw new Error(`Missing required param "${y}"`);
          s += b;
        }
    }
    return s || "/";
  }
  return {
    re: a,
    score: o,
    keys: i,
    parse: d,
    stringify: l
  };
}
function Gn(e, t) {
  let n = 0;
  for (; n < e.length && n < t.length; ) {
    const o = t[n] - e[n];
    if (o)
      return o;
    n++;
  }
  return e.length < t.length ? e.length === 1 && e[0] === 40 + 40 ? -1 : 1 : e.length > t.length ? t.length === 1 && t[0] === 40 + 40 ? 1 : -1 : 0;
}
function Wn(e, t) {
  let n = 0;
  const o = e.score, r = t.score;
  for (; n < o.length && n < r.length; ) {
    const i = Gn(o[n], r[n]);
    if (i)
      return i;
    n++;
  }
  if (Math.abs(r.length - o.length) === 1) {
    if (tt(o))
      return 1;
    if (tt(r))
      return -1;
  }
  return r.length - o.length;
}
function tt(e) {
  const t = e[e.length - 1];
  return e.length > 0 && t[t.length - 1] < 0;
}
const Kn = {
  type: 0,
  value: ""
}, zn = /[a-zA-Z0-9_]/;
function qn(e) {
  if (!e)
    return [[]];
  if (e === "/")
    return [[Kn]];
  if (!e.startsWith("/"))
    throw new Error(process.env.NODE_ENV !== "production" ? `Route paths should start with a "/": "${e}" should be "/${e}".` : `Invalid path "${e}"`);
  function t(p) {
    throw new Error(`ERR (${n})/"${h}": ${p}`);
  }
  let n = 0, o = n;
  const r = [];
  let i;
  function a() {
    i && r.push(i), i = [];
  }
  let d = 0, l, h = "", s = "";
  function c() {
    !h || (n === 0 ? i.push({
      type: 0,
      value: h
    }) : n === 1 || n === 2 || n === 3 ? (i.length > 1 && (l === "*" || l === "+") && t(`A repeatable param (${h}) must be alone in its segment. eg: '/:ids+.`), i.push({
      type: 1,
      value: h,
      regexp: s,
      repeatable: l === "*" || l === "+",
      optional: l === "*" || l === "?"
    })) : t("Invalid state to consume buffer"), h = "");
  }
  function f() {
    h += l;
  }
  for (; d < e.length; ) {
    if (l = e[d++], l === "\\" && n !== 2) {
      o = n, n = 4;
      continue;
    }
    switch (n) {
      case 0:
        l === "/" ? (h && c(), a()) : l === ":" ? (c(), n = 1) : f();
        break;
      case 4:
        f(), n = o;
        break;
      case 1:
        l === "(" ? n = 2 : zn.test(l) ? f() : (c(), n = 0, l !== "*" && l !== "?" && l !== "+" && d--);
        break;
      case 2:
        l === ")" ? s[s.length - 1] == "\\" ? s = s.slice(0, -1) + l : n = 3 : s += l;
        break;
      case 3:
        c(), n = 0, l !== "*" && l !== "?" && l !== "+" && d--, s = "";
        break;
      default:
        t("Unknown state");
        break;
    }
  }
  return n === 2 && t(`Unfinished custom RegExp for param "${h}"`), c(), a(), r;
}
function Qn(e, t, n) {
  const o = Hn(qn(e.path), n);
  if (process.env.NODE_ENV !== "production") {
    const i = /* @__PURE__ */ new Set();
    for (const a of o.keys)
      i.has(a.name) && k(`Found duplicated params with name "${a.name}" for path "${e.path}". Only the last one will be available on "$route.params".`), i.add(a.name);
  }
  const r = R(o, {
    record: e,
    parent: t,
    children: [],
    alias: []
  });
  return t && !r.record.aliasOf == !t.record.aliasOf && t.children.push(r), r;
}
function Fn(e, t) {
  const n = [], o = /* @__PURE__ */ new Map();
  t = rt({ strict: !1, end: !0, sensitive: !1 }, t);
  function r(s) {
    return o.get(s);
  }
  function i(s, c, f) {
    const p = !f, y = Yn(s);
    process.env.NODE_ENV !== "production" && eo(y, c), y.aliasOf = f && f.record;
    const $ = rt(t, s), N = [
      y
    ];
    if ("alias" in s) {
      const x = typeof s.alias == "string" ? [s.alias] : s.alias;
      for (const A of x)
        N.push(R({}, y, {
          components: f ? f.record.components : y.components,
          path: A,
          aliasOf: f ? f.record : y
        }));
    }
    let E, b;
    for (const x of N) {
      const { path: A } = x;
      if (c && A[0] !== "/") {
        const H = c.record.path, D = H[H.length - 1] === "/" ? "" : "/";
        x.path = c.record.path + (A && D + A);
      }
      if (process.env.NODE_ENV !== "production" && x.path === "*")
        throw new Error(`Catch all routes ("*") must now be defined using a param with a custom regexp.
See more at https://next.router.vuejs.org/guide/migration/#removed-star-or-catch-all-routes.`);
      if (E = Qn(x, c, $), process.env.NODE_ENV !== "production" && c && A[0] === "/" && to(E, c), f ? (f.alias.push(E), process.env.NODE_ENV !== "production" && Zn(f, E)) : (b = b || E, b !== E && b.alias.push(E), p && s.name && !ot(E) && a(s.name)), y.children) {
        const H = y.children;
        for (let D = 0; D < H.length; D++)
          i(H[D], E, f && f.children[D]);
      }
      f = f || E, (E.record.components && Object.keys(E.record.components).length || E.record.name || E.record.redirect) && l(E);
    }
    return b ? () => {
      a(b);
    } : ee;
  }
  function a(s) {
    if (wt(s)) {
      const c = o.get(s);
      c && (o.delete(s), n.splice(n.indexOf(c), 1), c.children.forEach(a), c.alias.forEach(a));
    } else {
      const c = n.indexOf(s);
      c > -1 && (n.splice(c, 1), s.record.name && o.delete(s.record.name), s.children.forEach(a), s.alias.forEach(a));
    }
  }
  function d() {
    return n;
  }
  function l(s) {
    let c = 0;
    for (; c < n.length && Wn(s, n[c]) >= 0 && (s.record.path !== n[c].record.path || !kt(s, n[c])); )
      c++;
    n.splice(c, 0, s), s.record.name && !ot(s) && o.set(s.record.name, s);
  }
  function h(s, c) {
    let f, p = {}, y, $;
    if ("name" in s && s.name) {
      if (f = o.get(s.name), !f)
        throw Q(1, {
          location: s
        });
      if (process.env.NODE_ENV !== "production") {
        const b = Object.keys(s.params || {}).filter((x) => !f.keys.find((A) => A.name === x));
        b.length && k(`Discarded invalid param(s) "${b.join('", "')}" when navigating. See https://github.com/vuejs/router/blob/main/packages/router/CHANGELOG.md#414-2022-08-22 for more details.`);
      }
      $ = f.record.name, p = R(
        nt(
          c.params,
          f.keys.filter((b) => !b.optional).map((b) => b.name)
        ),
        s.params && nt(s.params, f.keys.map((b) => b.name))
      ), y = f.stringify(p);
    } else if ("path" in s)
      y = s.path, process.env.NODE_ENV !== "production" && !y.startsWith("/") && k(`The Matcher cannot resolve relative paths but received "${y}". Unless you directly called \`matcher.resolve("${y}")\`, this is probably a bug in vue-router. Please open an issue at https://github.com/vuejs/router/issues/new/choose.`), f = n.find((b) => b.re.test(y)), f && (p = f.parse(y), $ = f.record.name);
    else {
      if (f = c.name ? o.get(c.name) : n.find((b) => b.re.test(c.path)), !f)
        throw Q(1, {
          location: s,
          currentLocation: c
        });
      $ = f.record.name, p = R({}, c.params, s.params), y = f.stringify(p);
    }
    const N = [];
    let E = f;
    for (; E; )
      N.unshift(E.record), E = E.parent;
    return {
      name: $,
      path: y,
      params: p,
      matched: N,
      meta: Xn(N)
    };
  }
  return e.forEach((s) => i(s)), { addRoute: i, resolve: h, removeRoute: a, getRoutes: d, getRecordMatcher: r };
}
function nt(e, t) {
  const n = {};
  for (const o of t)
    o in e && (n[o] = e[o]);
  return n;
}
function Yn(e) {
  return {
    path: e.path,
    redirect: e.redirect,
    name: e.name,
    meta: e.meta || {},
    aliasOf: void 0,
    beforeEnter: e.beforeEnter,
    props: Jn(e),
    children: e.children || [],
    instances: {},
    leaveGuards: /* @__PURE__ */ new Set(),
    updateGuards: /* @__PURE__ */ new Set(),
    enterCallbacks: {},
    components: "components" in e ? e.components || null : e.component && { default: e.component }
  };
}
function Jn(e) {
  const t = {}, n = e.props || !1;
  if ("component" in e)
    t.default = n;
  else
    for (const o in e.components)
      t[o] = typeof n == "object" ? n[o] : n;
  return t;
}
function ot(e) {
  for (; e; ) {
    if (e.record.aliasOf)
      return !0;
    e = e.parent;
  }
  return !1;
}
function Xn(e) {
  return e.reduce((t, n) => R(t, n.meta), {});
}
function rt(e, t) {
  const n = {};
  for (const o in e)
    n[o] = o in t ? t[o] : e[o];
  return n;
}
function $e(e, t) {
  return e.name === t.name && e.optional === t.optional && e.repeatable === t.repeatable;
}
function Zn(e, t) {
  for (const n of e.keys)
    if (!n.optional && !t.keys.find($e.bind(null, n)))
      return k(`Alias "${t.record.path}" and the original record: "${e.record.path}" must have the exact same param named "${n.name}"`);
  for (const n of t.keys)
    if (!n.optional && !e.keys.find($e.bind(null, n)))
      return k(`Alias "${t.record.path}" and the original record: "${e.record.path}" must have the exact same param named "${n.name}"`);
}
function eo(e, t) {
  t && t.record.name && !e.name && !e.path && k(`The route named "${String(t.record.name)}" has a child without a name and an empty path. Using that name won't render the empty path child so you probably want to move the name to the child instead. If this is intentional, add a name to the child route to remove the warning.`);
}
function to(e, t) {
  for (const n of t.keys)
    if (!e.keys.find($e.bind(null, n)))
      return k(`Absolute path "${e.record.path}" must have the exact same param named "${n.name}" as its parent "${t.record.path}".`);
}
function kt(e, t) {
  return t.children.some((n) => n === e || kt(e, n));
}
const St = /#/g, no = /&/g, oo = /\//g, ro = /=/g, io = /\?/g, Rt = /\+/g, so = /%5B/g, ao = /%5D/g, Nt = /%5E/g, co = /%60/g, Ot = /%7B/g, lo = /%7C/g, xt = /%7D/g, uo = /%20/g;
function Ve(e) {
  return encodeURI("" + e).replace(lo, "|").replace(so, "[").replace(ao, "]");
}
function fo(e) {
  return Ve(e).replace(Ot, "{").replace(xt, "}").replace(Nt, "^");
}
function Pe(e) {
  return Ve(e).replace(Rt, "%2B").replace(uo, "+").replace(St, "%23").replace(no, "%26").replace(co, "`").replace(Ot, "{").replace(xt, "}").replace(Nt, "^");
}
function ho(e) {
  return Pe(e).replace(ro, "%3D");
}
function po(e) {
  return Ve(e).replace(St, "%23").replace(io, "%3F");
}
function mo(e) {
  return e == null ? "" : po(e).replace(oo, "%2F");
}
function re(e) {
  try {
    return decodeURIComponent("" + e);
  } catch {
    process.env.NODE_ENV !== "production" && k(`Error decoding "${e}". Using original value`);
  }
  return "" + e;
}
function go(e) {
  const t = {};
  if (e === "" || e === "?")
    return t;
  const o = (e[0] === "?" ? e.slice(1) : e).split("&");
  for (let r = 0; r < o.length; ++r) {
    const i = o[r].replace(Rt, " "), a = i.indexOf("="), d = re(a < 0 ? i : i.slice(0, a)), l = a < 0 ? null : re(i.slice(a + 1));
    if (d in t) {
      let h = t[d];
      T(h) || (h = t[d] = [h]), h.push(l);
    } else
      t[d] = l;
  }
  return t;
}
function it(e) {
  let t = "";
  for (let n in e) {
    const o = e[n];
    if (n = ho(n), o == null) {
      o !== void 0 && (t += (t.length ? "&" : "") + n);
      continue;
    }
    (T(o) ? o.map((i) => i && Pe(i)) : [o && Pe(o)]).forEach((i) => {
      i !== void 0 && (t += (t.length ? "&" : "") + n, i != null && (t += "=" + i));
    });
  }
  return t;
}
function vo(e) {
  const t = {};
  for (const n in e) {
    const o = e[n];
    o !== void 0 && (t[n] = T(o) ? o.map((r) => r == null ? null : "" + r) : o == null ? o : "" + o);
  }
  return t;
}
const yo = Symbol(process.env.NODE_ENV !== "production" ? "router view location matched" : ""), st = Symbol(process.env.NODE_ENV !== "production" ? "router view depth" : ""), Le = Symbol(process.env.NODE_ENV !== "production" ? "router" : ""), $t = Symbol(process.env.NODE_ENV !== "production" ? "route location" : ""), Ce = Symbol(process.env.NODE_ENV !== "production" ? "router view location" : "");
function J() {
  let e = [];
  function t(o) {
    return e.push(o), () => {
      const r = e.indexOf(o);
      r > -1 && e.splice(r, 1);
    };
  }
  function n() {
    e = [];
  }
  return {
    add: t,
    list: () => e.slice(),
    reset: n
  };
}
function U(e, t, n, o, r) {
  const i = o && (o.enterCallbacks[r] = o.enterCallbacks[r] || []);
  return () => new Promise((a, d) => {
    const l = (c) => {
      c === !1 ? d(Q(4, {
        from: n,
        to: t
      })) : c instanceof Error ? d(c) : Vn(c) ? d(Q(2, {
        from: t,
        to: c
      })) : (i && o.enterCallbacks[r] === i && typeof c == "function" && i.push(c), a());
    }, h = e.call(o && o.instances[r], t, n, process.env.NODE_ENV !== "production" ? Eo(l, t, n) : l);
    let s = Promise.resolve(h);
    if (e.length < 3 && (s = s.then(l)), process.env.NODE_ENV !== "production" && e.length > 2) {
      const c = `The "next" callback was never called inside of ${e.name ? '"' + e.name + '"' : ""}:
${e.toString()}
. If you are returning a value instead of calling "next", make sure to remove the "next" parameter from your function.`;
      if (typeof h == "object" && "then" in h)
        s = s.then((f) => l._called ? f : (k(c), Promise.reject(new Error("Invalid navigation guard"))));
      else if (h !== void 0 && !l._called) {
        k(c), d(new Error("Invalid navigation guard"));
        return;
      }
    }
    s.catch((c) => d(c));
  });
}
function Eo(e, t, n) {
  let o = 0;
  return function() {
    o++ === 1 && k(`The "next" callback was called more than once in one navigation guard when going from "${n.fullPath}" to "${t.fullPath}". It should be called exactly one time in each navigation guard. This will fail in production.`), e._called = !0, o === 1 && e.apply(null, arguments);
  };
}
function ke(e, t, n, o) {
  const r = [];
  for (const i of e) {
    process.env.NODE_ENV !== "production" && !i.components && !i.children.length && k(`Record with path "${i.path}" is either missing a "component(s)" or "children" property.`);
    for (const a in i.components) {
      let d = i.components[a];
      if (process.env.NODE_ENV !== "production") {
        if (!d || typeof d != "object" && typeof d != "function")
          throw k(`Component "${a}" in record with path "${i.path}" is not a valid component. Received "${String(d)}".`), new Error("Invalid route component");
        if ("then" in d) {
          k(`Component "${a}" in record with path "${i.path}" is a Promise instead of a function that returns a Promise. Did you write "import('./MyPage.vue')" instead of "() => import('./MyPage.vue')" ? This will break in production if not fixed.`);
          const l = d;
          d = () => l;
        } else
          d.__asyncLoader && !d.__warnedDefineAsync && (d.__warnedDefineAsync = !0, k(`Component "${a}" in record with path "${i.path}" is defined using "defineAsyncComponent()". Write "() => import('./MyPage.vue')" instead of "defineAsyncComponent(() => import('./MyPage.vue'))".`));
      }
      if (!(t !== "beforeRouteEnter" && !i.instances[a]))
        if (_o(d)) {
          const h = (d.__vccOpts || d)[t];
          h && r.push(U(h, n, o, i, a));
        } else {
          let l = d();
          process.env.NODE_ENV !== "production" && !("catch" in l) && (k(`Component "${a}" in record with path "${i.path}" is a function that does not return a Promise. If you were passing a functional component, make sure to add a "displayName" to the component. This will break in production if not fixed.`), l = Promise.resolve(l)), r.push(() => l.then((h) => {
            if (!h)
              return Promise.reject(new Error(`Couldn't resolve component "${a}" at "${i.path}"`));
            const s = yn(h) ? h.default : h;
            i.components[a] = s;
            const f = (s.__vccOpts || s)[t];
            return f && U(f, n, o, i, a)();
          }));
        }
    }
  }
  return r;
}
function _o(e) {
  return typeof e == "object" || "displayName" in e || "props" in e || "__vccOpts" in e;
}
function at(e) {
  const t = ne(Le), n = ne($t), o = I(() => t.resolve(Z(e.to))), r = I(() => {
    const { matched: l } = o.value, { length: h } = l, s = l[h - 1], c = n.matched;
    if (!s || !c.length)
      return -1;
    const f = c.findIndex(B.bind(null, s));
    if (f > -1)
      return f;
    const p = ct(l[h - 2]);
    return h > 1 && ct(s) === p && c[c.length - 1].path !== p ? c.findIndex(B.bind(null, l[h - 2])) : f;
  }), i = I(() => r.value > -1 && So(n.params, o.value.params)), a = I(() => r.value > -1 && r.value === n.matched.length - 1 && _t(n.params, o.value.params));
  function d(l = {}) {
    return ko(l) ? t[Z(e.replace) ? "replace" : "push"](
      Z(e.to)
    ).catch(ee) : Promise.resolve();
  }
  if ((process.env.NODE_ENV !== "production" || !1) && L) {
    const l = vt();
    if (l) {
      const h = {
        route: o.value,
        isActive: i.value,
        isExactActive: a.value
      };
      l.__vrl_devtools = l.__vrl_devtools || [], l.__vrl_devtools.push(h), Ft(() => {
        h.route = o.value, h.isActive = i.value, h.isExactActive = a.value;
      }, { flush: "post" });
    }
  }
  return {
    route: o,
    href: I(() => o.value.href),
    isActive: i,
    isExactActive: a,
    navigate: d
  };
}
const bo = /* @__PURE__ */ ie({
  name: "RouterLink",
  compatConfig: { MODE: 3 },
  props: {
    to: {
      type: [String, Object],
      required: !0
    },
    replace: Boolean,
    activeClass: String,
    exactActiveClass: String,
    custom: Boolean,
    ariaCurrentValue: {
      type: String,
      default: "page"
    }
  },
  useLink: at,
  setup(e, { slots: t }) {
    const n = qt(at(e)), { options: o } = ne(Le), r = I(() => ({
      [lt(e.activeClass, o.linkActiveClass, "router-link-active")]: n.isActive,
      [lt(e.exactActiveClass, o.linkExactActiveClass, "router-link-exact-active")]: n.isExactActive
    }));
    return () => {
      const i = t.default && t.default(n);
      return e.custom ? i : mt("a", {
        "aria-current": n.isExactActive ? e.ariaCurrentValue : null,
        href: n.href,
        onClick: n.navigate,
        class: r.value
      }, i);
    };
  }
}), wo = bo;
function ko(e) {
  if (!(e.metaKey || e.altKey || e.ctrlKey || e.shiftKey) && !e.defaultPrevented && !(e.button !== void 0 && e.button !== 0)) {
    if (e.currentTarget && e.currentTarget.getAttribute) {
      const t = e.currentTarget.getAttribute("target");
      if (/\b_blank\b/i.test(t))
        return;
    }
    return e.preventDefault && e.preventDefault(), !0;
  }
}
function So(e, t) {
  for (const n in t) {
    const o = t[n], r = e[n];
    if (typeof o == "string") {
      if (o !== r)
        return !1;
    } else if (!T(r) || r.length !== o.length || o.some((i, a) => i !== r[a]))
      return !1;
  }
  return !0;
}
function ct(e) {
  return e ? e.aliasOf ? e.aliasOf.path : e.path : "";
}
const lt = (e, t, n) => e != null ? e : t != null ? t : n, Ro = /* @__PURE__ */ ie({
  name: "RouterView",
  inheritAttrs: !1,
  props: {
    name: {
      type: String,
      default: "default"
    },
    route: Object
  },
  compatConfig: { MODE: 3 },
  setup(e, { attrs: t, slots: n }) {
    process.env.NODE_ENV !== "production" && Oo();
    const o = ne(Ce), r = I(() => e.route || o.value), i = ne(st, 0), a = I(() => {
      let h = Z(i);
      const { matched: s } = r.value;
      let c;
      for (; (c = s[h]) && !c.components; )
        h++;
      return h;
    }), d = I(() => r.value.matched[a.value]);
    _e(st, I(() => a.value + 1)), _e(yo, d), _e(Ce, r);
    const l = Qt();
    return gt(() => [l.value, d.value, e.name], ([h, s, c], [f, p, y]) => {
      s && (s.instances[c] = h, p && p !== s && h && h === f && (s.leaveGuards.size || (s.leaveGuards = p.leaveGuards), s.updateGuards.size || (s.updateGuards = p.updateGuards))), h && s && (!p || !B(s, p) || !f) && (s.enterCallbacks[c] || []).forEach(($) => $(h));
    }, { flush: "post" }), () => {
      const h = r.value, s = e.name, c = d.value, f = c && c.components[s];
      if (!f)
        return ut(n.default, { Component: f, route: h });
      const p = c.props[s], y = p ? p === !0 ? h.params : typeof p == "function" ? p(h) : p : null, N = mt(f, R({}, y, t, {
        onVnodeUnmounted: (E) => {
          E.component.isUnmounted && (c.instances[s] = null);
        },
        ref: l
      }));
      if ((process.env.NODE_ENV !== "production" || !1) && L && N.ref) {
        const E = {
          depth: a.value,
          name: c.name,
          path: c.path,
          meta: c.meta
        };
        (T(N.ref) ? N.ref.map((x) => x.i) : [N.ref.i]).forEach((x) => {
          x.__vrv_devtools = E;
        });
      }
      return ut(n.default, { Component: N, route: h }) || N;
    };
  }
});
function ut(e, t) {
  if (!e)
    return null;
  const n = e(t);
  return n.length === 1 ? n[0] : n;
}
const No = Ro;
function Oo() {
  const e = vt(), t = e.parent && e.parent.type.name, n = e.parent && e.parent.subTree && e.parent.subTree.type;
  if (t && (t === "KeepAlive" || t.includes("Transition")) && typeof n == "object" && n.name === "RouterView") {
    const o = t === "KeepAlive" ? "keep-alive" : "transition";
    k(`<router-view> can no longer be used directly inside <transition> or <keep-alive>.
Use slot props instead:

<router-view v-slot="{ Component }">
  <${o}>
    <component :is="Component" />
  </${o}>
</router-view>`);
  }
}
function X(e, t) {
  const n = R({}, e, {
    matched: e.matched.map((o) => Vo(o, ["instances", "children", "aliasOf"]))
  });
  return {
    _custom: {
      type: null,
      readOnly: !0,
      display: e.fullPath,
      tooltip: t,
      value: n
    }
  };
}
function ce(e) {
  return {
    _custom: {
      display: e
    }
  };
}
let xo = 0;
function $o(e, t, n) {
  if (t.__hasDevtools)
    return;
  t.__hasDevtools = !0;
  const o = xo++;
  vn({
    id: "org.vuejs.router" + (o ? "." + o : ""),
    label: "Vue Router",
    packageName: "vue-router",
    homepage: "https://router.vuejs.org",
    logo: "https://router.vuejs.org/logo.png",
    componentStateTypes: ["Routing"],
    app: e
  }, (r) => {
    typeof r.now != "function" && console.warn("[Vue Router]: You seem to be using an outdated version of Vue Devtools. Are you still using the Beta release instead of the stable one? You can find the links at https://devtools.vuejs.org/guide/installation.html."), r.on.inspectComponent((s, c) => {
      s.instanceData && s.instanceData.state.push({
        type: "Routing",
        key: "$route",
        editable: !1,
        value: X(t.currentRoute.value, "Current Route")
      });
    }), r.on.visitComponentTree(({ treeNode: s, componentInstance: c }) => {
      if (c.__vrv_devtools) {
        const f = c.__vrv_devtools;
        s.tags.push({
          label: (f.name ? `${f.name.toString()}: ` : "") + f.path,
          textColor: 0,
          tooltip: "This component is rendered by &lt;router-view&gt;",
          backgroundColor: Pt
        });
      }
      T(c.__vrl_devtools) && (c.__devtoolsApi = r, c.__vrl_devtools.forEach((f) => {
        let p = Tt, y = "";
        f.isExactActive ? (p = At, y = "This is exactly active") : f.isActive && (p = Ct, y = "This link is active"), s.tags.push({
          label: f.route.path,
          textColor: 0,
          tooltip: y,
          backgroundColor: p
        });
      }));
    }), gt(t.currentRoute, () => {
      l(), r.notifyComponentUpdate(), r.sendInspectorTree(d), r.sendInspectorState(d);
    });
    const i = "router:navigations:" + o;
    r.addTimelineLayer({
      id: i,
      label: `Router${o ? " " + o : ""} Navigations`,
      color: 4237508
    }), t.onError((s, c) => {
      r.addTimelineEvent({
        layerId: i,
        event: {
          title: "Error during Navigation",
          subtitle: c.fullPath,
          logType: "error",
          time: r.now(),
          data: { error: s },
          groupId: c.meta.__navigationId
        }
      });
    });
    let a = 0;
    t.beforeEach((s, c) => {
      const f = {
        guard: ce("beforeEach"),
        from: X(c, "Current Location during this navigation"),
        to: X(s, "Target location")
      };
      Object.defineProperty(s.meta, "__navigationId", {
        value: a++
      }), r.addTimelineEvent({
        layerId: i,
        event: {
          time: r.now(),
          title: "Start of navigation",
          subtitle: s.fullPath,
          data: f,
          groupId: s.meta.__navigationId
        }
      });
    }), t.afterEach((s, c, f) => {
      const p = {
        guard: ce("afterEach")
      };
      f ? (p.failure = {
        _custom: {
          type: Error,
          readOnly: !0,
          display: f ? f.message : "",
          tooltip: "Navigation Failure",
          value: f
        }
      }, p.status = ce("\u274C")) : p.status = ce("\u2705"), p.from = X(c, "Current Location during this navigation"), p.to = X(s, "Target location"), r.addTimelineEvent({
        layerId: i,
        event: {
          title: "End of navigation",
          subtitle: s.fullPath,
          time: r.now(),
          data: p,
          logType: f ? "warning" : "default",
          groupId: s.meta.__navigationId
        }
      });
    });
    const d = "router-inspector:" + o;
    r.addInspector({
      id: d,
      label: "Routes" + (o ? " " + o : ""),
      icon: "book",
      treeFilterPlaceholder: "Search routes"
    });
    function l() {
      if (!h)
        return;
      const s = h;
      let c = n.getRoutes().filter((f) => !f.parent);
      c.forEach(Vt), s.filter && (c = c.filter((f) => Ae(f, s.filter.toLowerCase()))), c.forEach((f) => Dt(f, t.currentRoute.value)), s.rootNodes = c.map(It);
    }
    let h;
    r.on.getInspectorTree((s) => {
      h = s, s.app === e && s.inspectorId === d && l();
    }), r.on.getInspectorState((s) => {
      if (s.app === e && s.inspectorId === d) {
        const f = n.getRoutes().find((p) => p.record.__vd_id === s.nodeId);
        f && (s.state = {
          options: Co(f)
        });
      }
    }), r.sendInspectorTree(d), r.sendInspectorState(d);
  });
}
function Po(e) {
  return e.optional ? e.repeatable ? "*" : "?" : e.repeatable ? "+" : "";
}
function Co(e) {
  const { record: t } = e, n = [
    { editable: !1, key: "path", value: t.path }
  ];
  return t.name != null && n.push({
    editable: !1,
    key: "name",
    value: t.name
  }), n.push({ editable: !1, key: "regexp", value: e.re }), e.keys.length && n.push({
    editable: !1,
    key: "keys",
    value: {
      _custom: {
        type: null,
        readOnly: !0,
        display: e.keys.map((o) => `${o.name}${Po(o)}`).join(" "),
        tooltip: "Param keys",
        value: e.keys
      }
    }
  }), t.redirect != null && n.push({
    editable: !1,
    key: "redirect",
    value: t.redirect
  }), e.alias.length && n.push({
    editable: !1,
    key: "aliases",
    value: e.alias.map((o) => o.record.path)
  }), Object.keys(e.record.meta).length && n.push({
    editable: !1,
    key: "meta",
    value: e.record.meta
  }), n.push({
    key: "score",
    editable: !1,
    value: {
      _custom: {
        type: null,
        readOnly: !0,
        display: e.score.map((o) => o.join(", ")).join(" | "),
        tooltip: "Score used to sort routes",
        value: e.score
      }
    }
  }), n;
}
const Pt = 15485081, Ct = 2450411, At = 8702998, Ao = 2282478, Tt = 16486972, To = 6710886;
function It(e) {
  const t = [], { record: n } = e;
  n.name != null && t.push({
    label: String(n.name),
    textColor: 0,
    backgroundColor: Ao
  }), n.aliasOf && t.push({
    label: "alias",
    textColor: 0,
    backgroundColor: Tt
  }), e.__vd_match && t.push({
    label: "matches",
    textColor: 0,
    backgroundColor: Pt
  }), e.__vd_exactActive && t.push({
    label: "exact",
    textColor: 0,
    backgroundColor: At
  }), e.__vd_active && t.push({
    label: "active",
    textColor: 0,
    backgroundColor: Ct
  }), n.redirect && t.push({
    label: typeof n.redirect == "string" ? `redirect: ${n.redirect}` : "redirects",
    textColor: 16777215,
    backgroundColor: To
  });
  let o = n.__vd_id;
  return o == null && (o = String(Io++), n.__vd_id = o), {
    id: o,
    label: n.path,
    tags: t,
    children: e.children.map(It)
  };
}
let Io = 0;
const Do = /^\/(.*)\/([a-z]*)$/;
function Dt(e, t) {
  const n = t.matched.length && B(t.matched[t.matched.length - 1], e.record);
  e.__vd_exactActive = e.__vd_active = n, n || (e.__vd_active = t.matched.some((o) => B(o, e.record))), e.children.forEach((o) => Dt(o, t));
}
function Vt(e) {
  e.__vd_match = !1, e.children.forEach(Vt);
}
function Ae(e, t) {
  const n = String(e.re).match(Do);
  if (e.__vd_match = !1, !n || n.length < 3)
    return !1;
  if (new RegExp(n[1].replace(/\$$/, ""), n[2]).test(t))
    return e.children.forEach((a) => Ae(a, t)), e.record.path !== "/" || t === "/" ? (e.__vd_match = e.re.test(t), !0) : !1;
  const r = e.record.path.toLowerCase(), i = re(r);
  return !t.startsWith("/") && (i.includes(t) || r.includes(t)) || i.startsWith(t) || r.startsWith(t) || e.record.name && String(e.record.name).includes(t) ? !0 : e.children.some((a) => Ae(a, t));
}
function Vo(e, t) {
  const n = {};
  for (const o in e)
    t.includes(o) || (n[o] = e[o]);
  return n;
}
function Lo(e) {
  const t = Fn(e.routes, e), n = e.parseQuery || go, o = e.stringifyQuery || it, r = e.history;
  if (process.env.NODE_ENV !== "production" && !r)
    throw new Error('Provide the "history" option when calling "createRouter()": https://next.router.vuejs.org/api/#history.');
  const i = J(), a = J(), d = J(), l = Wt(j);
  let h = j;
  L && e.scrollBehavior && "scrollRestoration" in history && (history.scrollRestoration = "manual");
  const s = be.bind(null, (u) => "" + u), c = be.bind(null, mo), f = be.bind(null, re);
  function p(u, g) {
    let m, v;
    return wt(u) ? (m = t.getRecordMatcher(u), v = g) : v = u, t.addRoute(v, m);
  }
  function y(u) {
    const g = t.getRecordMatcher(u);
    g ? t.removeRoute(g) : process.env.NODE_ENV !== "production" && k(`Cannot remove non-existent route "${String(u)}"`);
  }
  function $() {
    return t.getRoutes().map((u) => u.record);
  }
  function N(u) {
    return !!t.getRecordMatcher(u);
  }
  function E(u, g) {
    if (g = R({}, g || l.value), typeof u == "string") {
      const _ = we(n, u, g.path), O = t.resolve({ path: _.path }, g), G = r.createHref(_.fullPath);
      return process.env.NODE_ENV !== "production" && (G.startsWith("//") ? k(`Location "${u}" resolved to "${G}". A resolved location cannot start with multiple slashes.`) : O.matched.length || k(`No match found for location with path "${u}"`)), R(_, O, {
        params: f(O.params),
        hash: re(_.hash),
        redirectedFrom: void 0,
        href: G
      });
    }
    let m;
    if ("path" in u)
      process.env.NODE_ENV !== "production" && "params" in u && !("name" in u) && Object.keys(u.params).length && k(`Path "${u.path}" was passed with params but they will be ignored. Use a named route alongside params instead.`), m = R({}, u, {
        path: we(n, u.path, g.path).path
      });
    else {
      const _ = R({}, u.params);
      for (const O in _)
        _[O] == null && delete _[O];
      m = R({}, u, {
        params: c(_)
      }), g.params = c(g.params);
    }
    const v = t.resolve(m, g), S = u.hash || "";
    process.env.NODE_ENV !== "production" && S && !S.startsWith("#") && k(`A \`hash\` should always start with the character "#". Replace "${S}" with "#${S}".`), v.params = s(f(v.params));
    const P = bn(o, R({}, u, {
      hash: fo(S),
      path: v.path
    })), w = r.createHref(P);
    return process.env.NODE_ENV !== "production" && (w.startsWith("//") ? k(`Location "${u}" resolved to "${w}". A resolved location cannot start with multiple slashes.`) : v.matched.length || k(`No match found for location with path "${"path" in u ? u.path : u}"`)), R({
      fullPath: P,
      hash: S,
      query: o === it ? vo(u.query) : u.query || {}
    }, v, {
      redirectedFrom: void 0,
      href: w
    });
  }
  function b(u) {
    return typeof u == "string" ? we(n, u, l.value.path) : R({}, u);
  }
  function x(u, g) {
    if (h !== u)
      return Q(8, {
        from: g,
        to: u
      });
  }
  function A(u) {
    return F(u);
  }
  function H(u) {
    return A(R(b(u), { replace: !0 }));
  }
  function D(u) {
    const g = u.matched[u.matched.length - 1];
    if (g && g.redirect) {
      const { redirect: m } = g;
      let v = typeof m == "function" ? m(u) : m;
      if (typeof v == "string" && (v = v.includes("?") || v.includes("#") ? v = b(v) : { path: v }, v.params = {}), process.env.NODE_ENV !== "production" && !("path" in v) && !("name" in v))
        throw k(`Invalid redirect found:
${JSON.stringify(v, null, 2)}
 when navigating to "${u.fullPath}". A redirect must contain a name or path. This will break in production.`), new Error("Invalid redirect");
      return R({
        query: u.query,
        hash: u.hash,
        params: "path" in v ? {} : u.params
      }, v);
    }
  }
  function F(u, g) {
    const m = h = E(u), v = l.value, S = u.state, P = u.force, w = u.replace === !0, _ = D(m);
    if (_)
      return F(
        R(b(_), {
          state: typeof _ == "object" ? R({}, S, _.state) : S,
          force: P,
          replace: w
        }),
        g || m
      );
    const O = m;
    O.redirectedFrom = g;
    let G;
    return !P && Fe(o, v, m) && (G = Q(16, { to: O, from: v }), We(
      v,
      v,
      !0,
      !1
    )), (G ? Promise.resolve(G) : Ue(O, v)).catch((C) => V(C) ? V(C, 2) ? C : ve(C) : ge(C, O, v)).then((C) => {
      if (C) {
        if (V(C, 2))
          return process.env.NODE_ENV !== "production" && Fe(o, E(C.to), O) && g && (g._count = g._count ? g._count + 1 : 1) > 30 ? (k(`Detected a possibly infinite redirection in a navigation guard when going from "${v.fullPath}" to "${O.fullPath}". Aborting to avoid a Stack Overflow.
 Are you always returning a new location within a navigation guard? That would lead to this error. Only return when redirecting or aborting, that should fix this. This might break in production if not fixed.`), Promise.reject(new Error("Infinite redirect in navigation guard"))) : F(
            R({
              replace: w
            }, b(C.to), {
              state: typeof C.to == "object" ? R({}, S, C.to.state) : S,
              force: P
            }),
            g || O
          );
      } else
        C = He(O, v, !0, w, S);
      return Be(O, v, C), C;
    });
  }
  function Ut(u, g) {
    const m = x(u, g);
    return m ? Promise.reject(m) : Promise.resolve();
  }
  function je(u) {
    const g = ae.values().next().value;
    return g && typeof g.runWithContext == "function" ? g.runWithContext(u) : u();
  }
  function Ue(u, g) {
    let m;
    const [v, S, P] = Mo(u, g);
    m = ke(v.reverse(), "beforeRouteLeave", u, g);
    for (const _ of v)
      _.leaveGuards.forEach((O) => {
        m.push(U(O, u, g));
      });
    const w = Ut.bind(null, u, g);
    return m.push(w), W(m).then(() => {
      m = [];
      for (const _ of i.list())
        m.push(U(_, u, g));
      return m.push(w), W(m);
    }).then(() => {
      m = ke(S, "beforeRouteUpdate", u, g);
      for (const _ of S)
        _.updateGuards.forEach((O) => {
          m.push(U(O, u, g));
        });
      return m.push(w), W(m);
    }).then(() => {
      m = [];
      for (const _ of P)
        if (_.beforeEnter)
          if (T(_.beforeEnter))
            for (const O of _.beforeEnter)
              m.push(U(O, u, g));
          else
            m.push(U(_.beforeEnter, u, g));
      return m.push(w), W(m);
    }).then(() => (u.matched.forEach((_) => _.enterCallbacks = {}), m = ke(P, "beforeRouteEnter", u, g), m.push(w), W(m))).then(() => {
      m = [];
      for (const _ of a.list())
        m.push(U(_, u, g));
      return m.push(w), W(m);
    }).catch((_) => V(_, 8) ? _ : Promise.reject(_));
  }
  function Be(u, g, m) {
    d.list().forEach((v) => je(() => v(u, g, m)));
  }
  function He(u, g, m, v, S) {
    const P = x(u, g);
    if (P)
      return P;
    const w = g === j, _ = L ? history.state : {};
    m && (v || w ? r.replace(u.fullPath, R({
      scroll: w && _ && _.scroll
    }, S)) : r.push(u.fullPath, S)), l.value = u, We(u, g, m, w), ve();
  }
  let Y;
  function Bt() {
    Y || (Y = r.listen((u, g, m) => {
      if (!Ke.listening)
        return;
      const v = E(u), S = D(v);
      if (S) {
        F(R(S, { replace: !0 }), v).catch(ee);
        return;
      }
      h = v;
      const P = l.value;
      L && $n(Je(P.fullPath, m.delta), pe()), Ue(v, P).catch((w) => V(w, 12) ? w : V(w, 2) ? (F(
        w.to,
        v
      ).then((_) => {
        V(_, 20) && !m.delta && m.type === oe.pop && r.go(-1, !1);
      }).catch(ee), Promise.reject()) : (m.delta && r.go(-m.delta, !1), ge(w, v, P))).then((w) => {
        w = w || He(
          v,
          P,
          !1
        ), w && (m.delta && !V(w, 8) ? r.go(-m.delta, !1) : m.type === oe.pop && V(w, 20) && r.go(-1, !1)), Be(v, P, w);
      }).catch(ee);
    }));
  }
  let me = J(), Ge = J(), se;
  function ge(u, g, m) {
    ve(u);
    const v = Ge.list();
    return v.length ? v.forEach((S) => S(u, g, m)) : (process.env.NODE_ENV !== "production" && k("uncaught error during route navigation:"), console.error(u)), Promise.reject(u);
  }
  function Ht() {
    return se && l.value !== j ? Promise.resolve() : new Promise((u, g) => {
      me.add([u, g]);
    });
  }
  function ve(u) {
    return se || (se = !u, Bt(), me.list().forEach(([g, m]) => u ? m(u) : g()), me.reset()), u;
  }
  function We(u, g, m, v) {
    const { scrollBehavior: S } = e;
    if (!L || !S)
      return Promise.resolve();
    const P = !m && Pn(Je(u.fullPath, 0)) || (v || !m) && history.state && history.state.scroll || null;
    return zt().then(() => S(u, g, P)).then((w) => w && xn(w)).catch((w) => ge(w, u, g));
  }
  const ye = (u) => r.go(u);
  let Ee;
  const ae = /* @__PURE__ */ new Set(), Ke = {
    currentRoute: l,
    listening: !0,
    addRoute: p,
    removeRoute: y,
    hasRoute: N,
    getRoutes: $,
    resolve: E,
    options: e,
    push: A,
    replace: H,
    go: ye,
    back: () => ye(-1),
    forward: () => ye(1),
    beforeEach: i.add,
    beforeResolve: a.add,
    afterEach: d.add,
    onError: Ge.add,
    isReady: Ht,
    install(u) {
      const g = this;
      u.component("RouterLink", wo), u.component("RouterView", No), u.config.globalProperties.$router = g, Object.defineProperty(u.config.globalProperties, "$route", {
        enumerable: !0,
        get: () => Z(l)
      }), L && !Ee && l.value === j && (Ee = !0, A(r.location).catch((S) => {
        process.env.NODE_ENV !== "production" && k("Unexpected error when starting the router:", S);
      }));
      const m = {};
      for (const S in j)
        Object.defineProperty(m, S, {
          get: () => l.value[S],
          enumerable: !0
        });
      u.provide(Le, g), u.provide($t, Kt(m)), u.provide(Ce, l);
      const v = u.unmount;
      ae.add(u), u.unmount = function() {
        ae.delete(u), ae.size < 1 && (h = j, Y && Y(), Y = null, l.value = j, Ee = !1, se = !1), v();
      }, (process.env.NODE_ENV !== "production" || !1) && L && $o(u, g, t);
    }
  };
  function W(u) {
    return u.reduce((g, m) => g.then(() => je(m)), Promise.resolve());
  }
  return Ke;
}
function Mo(e, t) {
  const n = [], o = [], r = [], i = Math.max(t.matched.length, e.matched.length);
  for (let a = 0; a < i; a++) {
    const d = t.matched[a];
    d && (e.matched.find((h) => B(h, d)) ? o.push(d) : n.push(d));
    const l = e.matched[a];
    l && (t.matched.find((h) => B(h, l)) || r.push(l));
  }
  return [n, o, r];
}
const jo = {};
function Uo(e, t) {
  return "Pages";
}
const ft = /* @__PURE__ */ De(jo, [["render", Uo]]), Bo = [
  {
    path: "/",
    name: "Home",
    component: ft
  },
  {
    path: "/pages",
    name: "Pages",
    component: ft
  }
], Ho = Lo({
  history: Dn(),
  routes: Bo
});
function Go(e) {
  return { all: e = e || /* @__PURE__ */ new Map(), on: function(t, n) {
    var o = e.get(t);
    o ? o.push(n) : e.set(t, [n]);
  }, off: function(t, n) {
    var o = e.get(t);
    o && (n ? o.splice(o.indexOf(n) >>> 0, 1) : e.set(t, []));
  }, emit: function(t, n) {
    var o = e.get(t);
    o && o.slice().map(function(r) {
      r(n);
    }), (o = e.get("*")) && o.slice().map(function(r) {
      r(t, n);
    });
  } };
}
const de = Go(), Lt = /* @__PURE__ */ new Map(), dt = {
  x: ["left", "center", "right"],
  y: ["top", "bottom"]
}, Wo = ((e) => () => e++)(0), Ko = (e) => typeof e != "string" ? [] : e.split(/\s+/gi).filter((t) => t), zo = (e) => {
  typeof e == "string" && (e = Ko(e));
  let t = null, n = null;
  return e.forEach((o) => {
    dt.y.indexOf(o) !== -1 && (n = o), dt.x.indexOf(o) !== -1 && (t = o);
  }), { x: t, y: n };
};
class qo {
  constructor(t, n, o) {
    this.remaining = n, this.callback = t, this.notifyItem = o, this.resume();
  }
  pause() {
    clearTimeout(this.notifyItem.timer), this.remaining -= Date.now() - this.start;
  }
  resume() {
    this.start = Date.now(), clearTimeout(this.notifyItem.timer), this.notifyItem.timer = setTimeout(this.callback, this.remaining);
  }
}
const Se = {
  position: ["top", "right"],
  cssAnimation: "vn-fade",
  velocityAnimation: {
    enter: (e) => ({
      height: [e.clientHeight, 0],
      opacity: [1, 0]
    }),
    leave: {
      height: 0,
      opacity: [0, 1]
    }
  }
}, Qo = ie({
  name: "velocity-group",
  emits: ["after-leave", "leave", "enter"],
  methods: {
    enter(e, t) {
      this.$emit("enter", e, t);
    },
    leave(e, t) {
      this.$emit("leave", e, t);
    },
    afterLeave() {
      this.$emit("after-leave");
    }
  }
}), Me = (e, t) => {
  const n = e.__vccOpts || e;
  for (const [o, r] of t)
    n[o] = r;
  return n;
};
function Fo(e, t, n, o, r, i) {
  return M(), Te(yt, {
    tag: "span",
    css: !1,
    onEnter: e.enter,
    onLeave: e.leave,
    onAfterLeave: e.afterLeave
  }, {
    default: he(() => [
      Ie(e.$slots, "default")
    ]),
    _: 3
  }, 8, ["onEnter", "onLeave", "onAfterLeave"]);
}
const Yo = /* @__PURE__ */ Me(Qo, [["render", Fo]]), Jo = ie({
  name: "css-group",
  inheritAttrs: !1,
  props: {
    name: { type: String, required: !0 }
  }
});
function Xo(e, t, n, o, r, i) {
  return M(), Te(yt, {
    tag: "span",
    name: e.name
  }, {
    default: he(() => [
      Ie(e.$slots, "default")
    ]),
    _: 3
  }, 8, ["name"]);
}
const Zo = /* @__PURE__ */ Me(Jo, [["render", Xo]]), Re = "[-+]?[0-9]*.?[0-9]+", ht = [
  {
    name: "px",
    regexp: new RegExp(`^${Re}px$`)
  },
  {
    name: "%",
    regexp: new RegExp(`^${Re}%$`)
  },
  {
    name: "px",
    regexp: new RegExp(`^${Re}$`)
  }
], er = (e) => {
  if (e === "auto")
    return {
      type: e,
      value: 0
    };
  for (let t = 0; t < ht.length; t++) {
    const n = ht[t];
    if (n.regexp.test(e))
      return {
        type: n.name,
        value: parseFloat(e)
      };
  }
  return {
    type: "",
    value: e
  };
}, tr = (e) => {
  switch (typeof e) {
    case "number":
      return { type: "px", value: e };
    case "string":
      return er(e);
    default:
      return { type: "", value: e };
  }
}, le = {
  IDLE: 0,
  DESTROYED: 2
}, nr = ie({
  name: "notifications",
  components: {
    VelocityGroup: Yo,
    CssGroup: Zo
  },
  props: {
    group: {
      type: String,
      default: ""
    },
    width: {
      type: [Number, String],
      default: 300
    },
    reverse: {
      type: Boolean,
      default: !1
    },
    position: {
      type: [String, Array],
      default: Se.position
    },
    classes: {
      type: String,
      default: "vue-notification"
    },
    animationType: {
      type: String,
      default: "css"
    },
    animation: {
      type: Object,
      default: Se.velocityAnimation
    },
    animationName: {
      type: String,
      default: Se.cssAnimation
    },
    speed: {
      type: Number,
      default: 300
    },
    cooldown: {
      type: Number,
      default: 0
    },
    duration: {
      type: Number,
      default: 3e3
    },
    delay: {
      type: Number,
      default: 0
    },
    max: {
      type: Number,
      default: 1 / 0
    },
    ignoreDuplicates: {
      type: Boolean,
      default: !1
    },
    closeOnClick: {
      type: Boolean,
      default: !0
    },
    pauseOnHover: {
      type: Boolean,
      default: !1
    }
  },
  emits: ["click", "destroy", "start"],
  data() {
    return {
      list: [],
      velocity: Lt.get("velocity"),
      timerControl: null
    };
  },
  computed: {
    actualWidth() {
      return tr(this.width);
    },
    isVA() {
      return this.animationType === "velocity";
    },
    componentName() {
      return this.isVA ? "velocity-group" : "css-group";
    },
    styles() {
      const { x: e, y: t } = zo(this.position), n = this.actualWidth.value, o = this.actualWidth.type, r = {
        width: n + o
      };
      return t && (r[t] = "0px"), e && (e === "center" ? r.left = `calc(50% - ${+n / 2}${o})` : r[e] = "0px"), r;
    },
    active() {
      return this.list.filter((e) => e.state !== le.DESTROYED);
    },
    botToTop() {
      return this.styles.hasOwnProperty("bottom");
    }
  },
  mounted() {
    de.on("add", this.addItem), de.on("close", this.closeItem);
  },
  methods: {
    destroyIfNecessary(e) {
      this.$emit("click", e), this.closeOnClick && this.destroy(e);
    },
    pauseTimeout() {
      var e;
      this.pauseOnHover && ((e = this.timerControl) == null || e.pause());
    },
    resumeTimeout() {
      var e;
      this.pauseOnHover && ((e = this.timerControl) == null || e.resume());
    },
    addItem(e = {}) {
      if (e.group || (e.group = ""), e.data || (e.data = {}), this.group !== e.group)
        return;
      if (e.clean || e.clear) {
        this.destroyAll();
        return;
      }
      const t = typeof e.duration == "number" ? e.duration : this.duration, n = typeof e.speed == "number" ? e.speed : this.speed, o = typeof e.ignoreDuplicates == "boolean" ? e.ignoreDuplicates : this.ignoreDuplicates, { title: r, text: i, type: a, data: d, id: l } = e, h = {
        id: l || Wo(),
        title: r,
        text: i,
        type: a,
        state: le.IDLE,
        speed: n,
        length: t + 2 * n,
        data: d
      };
      t >= 0 && (this.timerControl = new qo(() => this.destroy(h), h.length, h));
      const s = this.reverse ? !this.botToTop : this.botToTop;
      let c = -1;
      const f = this.active.some((p) => p.title === e.title && p.text === e.text);
      (!o || !f) && (s ? (this.list.push(h), this.$emit("start", h), this.active.length > this.max && (c = 0)) : (this.list.unshift(h), this.$emit("start", h), this.active.length > this.max && (c = this.active.length - 1)), c !== -1 && this.destroy(this.active[c]));
    },
    closeItem(e) {
      this.destroyById(e);
    },
    notifyClass(e) {
      return [
        "vue-notification-template",
        this.classes,
        e.type || ""
      ];
    },
    notifyWrapperStyle(e) {
      return this.isVA ? void 0 : { transition: `all ${e.speed}ms` };
    },
    destroy(e) {
      clearTimeout(e.timer), e.state = le.DESTROYED, this.clean(), this.$emit("destroy", e);
    },
    destroyById(e) {
      const t = this.list.find((n) => n.id === e);
      t && this.destroy(t);
    },
    destroyAll() {
      this.active.forEach(this.destroy);
    },
    getAnimation(e, t) {
      var n;
      const o = (n = this.animation) == null ? void 0 : n[e];
      return typeof o == "function" ? o.call(this, t) : o;
    },
    enter(e, t) {
      if (!this.isVA)
        return;
      const n = this.getAnimation("enter", e);
      this.velocity(e, n, {
        duration: this.speed,
        complete: t
      });
    },
    leave(e, t) {
      if (!this.isVA)
        return;
      const n = this.getAnimation("leave", e);
      this.velocity(e, n, {
        duration: this.speed,
        complete: t
      });
    },
    clean() {
      this.list = this.list.filter((e) => e.state !== le.DESTROYED);
    }
  }
}), or = ["data-id"], rr = ["onClick"], ir = ["innerHTML"], sr = ["innerHTML"];
function ar(e, t, n, o, r, i) {
  return M(), z("div", {
    class: "vue-notification-group",
    style: ze(e.styles)
  }, [
    (M(), Te(Yt(e.componentName), {
      name: e.animationName,
      onEnter: e.enter,
      onLeave: e.leave,
      onAfterLeave: e.clean
    }, {
      default: he(() => [
        (M(!0), z(pt, null, Jt(e.active, (a) => (M(), z("div", {
          key: a.id,
          class: "vue-notification-wrapper",
          style: ze(e.notifyWrapperStyle(a)),
          "data-id": a.id,
          onMouseenter: t[0] || (t[0] = (...d) => e.pauseTimeout && e.pauseTimeout(...d)),
          onMouseleave: t[1] || (t[1] = (...d) => e.resumeTimeout && e.resumeTimeout(...d))
        }, [
          Ie(e.$slots, "body", {
            class: qe([e.classes, a.type]),
            item: a,
            close: () => e.destroy(a)
          }, () => [
            q("div", {
              class: qe(e.notifyClass(a)),
              onClick: (d) => e.destroyIfNecessary(a)
            }, [
              a.title ? (M(), z("div", {
                key: 0,
                class: "notification-title",
                innerHTML: a.title
              }, null, 8, ir)) : Xt("", !0),
              q("div", {
                class: "notification-content",
                innerHTML: a.text
              }, null, 8, sr)
            ], 10, rr)
          ])
        ], 44, or))), 128))
      ]),
      _: 3
    }, 40, ["name", "onEnter", "onLeave", "onAfterLeave"]))
  ], 4);
}
const cr = /* @__PURE__ */ Me(nr, [["render", ar]]), Mt = (e) => {
  typeof e == "string" && (e = { title: "", text: e }), typeof e == "object" && de.emit("add", e);
};
Mt.close = (e) => {
  de.emit("close", e);
};
function lr(e, t = {}) {
  Object.entries(t).forEach((o) => Lt.set(...o));
  const n = t.name || "notify";
  e.config.globalProperties["$" + n] = Mt, e.component(t.componentName || "Notifications", cr);
}
const ur = {
  install: lr
};
(function() {
  var e;
  try {
    if (typeof document < "u") {
      var t = document.createElement("style");
      t.nonce = (e = document.head.querySelector("meta[property=csp-nonce]")) == null ? void 0 : e.content, t.appendChild(document.createTextNode(".vue-notification-group{display:block;position:fixed;z-index:5000}.vue-notification-wrapper{display:block;overflow:hidden;width:100%;margin:0;padding:0}.notification-title{font-weight:600}.vue-notification-template{display:block;box-sizing:border-box;background:white;text-align:left}.vue-notification{display:block;box-sizing:border-box;text-align:left;font-size:12px;padding:10px;margin:0 5px 5px;color:#fff;background:#44A4FC;border-left:5px solid #187FE7}.vue-notification.warn{background:#ffb648;border-left-color:#f48a06}.vue-notification.error{background:#E54D42;border-left-color:#b82e24}.vue-notification.success{background:#68CD86;border-left-color:#42a85f}.vn-fade-enter-active,.vn-fade-leave-active,.vn-fade-move{transition:all .5s}.vn-fade-enter-from,.vn-fade-leave-to{opacity:0}")), document.head.appendChild(t);
    }
  } catch (n) {
    console.error("vite-plugin-css-injected-by-js", n);
  }
})();
var jt = { exports: {} };
(function(e, t) {
  (function() {
    var n = {
      expires: "1d",
      path: "; path=/",
      domain: "",
      secure: "",
      sameSite: "; SameSite=Lax"
    }, o = {
      install: function(r, i) {
        i && this.config(i.expires, i.path, i.domain, i.secure, i.sameSite), r.prototype && (r.prototype.$cookies = this), r.config && r.config.globalProperties && (r.config.globalProperties.$cookies = this, r.provide("$cookies", this)), r.$cookies = this;
      },
      config: function(r, i, a, d, l) {
        n.expires = r || "1d", n.path = i ? "; path=" + i : "; path=/", n.domain = a ? "; domain=" + a : "", n.secure = d ? "; Secure" : "", n.sameSite = l ? "; SameSite=" + l : "; SameSite=Lax";
      },
      get: function(r) {
        var i = decodeURIComponent(document.cookie.replace(new RegExp("(?:(?:^|.*;)\\s*" + encodeURIComponent(r).replace(/[\-\.\+\*]/g, "\\$&") + "\\s*\\=\\s*([^;]*).*$)|^.*$"), "$1")) || null;
        if (i && (i.substring(0, 1) === "{" && i.substring(i.length - 1, i.length) === "}" || i.substring(0, 1) === "[" && i.substring(i.length - 1, i.length) === "]"))
          try {
            i = JSON.parse(i);
          } catch {
            return i;
          }
        return i;
      },
      set: function(r, i, a, d, l, h, s) {
        if (r) {
          if (/^(?:expires|max\-age|path|domain|secure|SameSite)$/i.test(r))
            throw new Error('Cookie name illegality. Cannot be set to ["expires","max-age","path","domain","secure","SameSite"]	 current key name: ' + r);
        } else
          throw new Error("Cookie name is not found in the first argument.");
        i && typeof i == "object" && (i = JSON.stringify(i));
        var c = "";
        if (a = a == null ? n.expires : a, a && a != 0)
          switch (a.constructor) {
            case Number:
              a === 1 / 0 || a === -1 ? c = "; expires=Fri, 31 Dec 9999 23:59:59 GMT" : c = "; max-age=" + a;
              break;
            case String:
              if (/^(?:\d+(y|m|d|h|min|s))$/i.test(a)) {
                var f = a.replace(/^(\d+)(?:y|m|d|h|min|s)$/i, "$1");
                switch (a.replace(/^(?:\d+)(y|m|d|h|min|s)$/i, "$1").toLowerCase()) {
                  case "m":
                    c = "; max-age=" + +f * 2592e3;
                    break;
                  case "d":
                    c = "; max-age=" + +f * 86400;
                    break;
                  case "h":
                    c = "; max-age=" + +f * 3600;
                    break;
                  case "min":
                    c = "; max-age=" + +f * 60;
                    break;
                  case "s":
                    c = "; max-age=" + f;
                    break;
                  case "y":
                    c = "; max-age=" + +f * 31104e3;
                    break;
                }
              } else
                c = "; expires=" + a;
              break;
            case Date:
              c = "; expires=" + a.toUTCString();
              break;
          }
        return document.cookie = encodeURIComponent(r) + "=" + encodeURIComponent(i) + c + (l ? "; domain=" + l : n.domain) + (d ? "; path=" + d : n.path) + (h == null ? n.secure : h ? "; Secure" : "") + (s == null ? n.sameSite : s ? "; SameSite=" + s : ""), this;
      },
      remove: function(r, i, a) {
        return !r || !this.isKey(r) ? !1 : (document.cookie = encodeURIComponent(r) + "=; expires=Thu, 01 Jan 1970 00:00:00 GMT" + (a ? "; domain=" + a : n.domain) + (i ? "; path=" + i : n.path) + "; SameSite=Lax", !0);
      },
      isKey: function(r) {
        return new RegExp("(?:^|;\\s*)" + encodeURIComponent(r).replace(/[\-\.\+\*]/g, "\\$&") + "\\s*\\=").test(document.cookie);
      },
      keys: function() {
        if (!document.cookie)
          return [];
        for (var r = document.cookie.replace(/((?:^|\s*;)[^\=]+)(?=;|$)|^\s*|\s*(?:\=[^;]*)?(?:\1|$)/g, "").split(/\s*(?:\=[^;]*)?;\s*/), i = 0; i < r.length; i++)
          r[i] = decodeURIComponent(r[i]);
        return r;
      }
    };
    e.exports = o, typeof window < "u" && (window.$cookies = o);
  })();
})(jt);
const fr = jt.exports;
const hr = Zt(ln).use(Ho).use(ur).use(fr);
export {
  hr as default
};
