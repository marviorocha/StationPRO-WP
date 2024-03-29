const playerOrigin = "https://example.com";
let fetchController,
  fetchSignal = null;
self.addEventListener("fetch", (a) => {
  if ((console.log(a), "audio" == a.request.destination)) {
    let b = new Headers({ "Icy-Metadata": "1" }),
      c = new ReadableStream({
        start(d) {
          function f(l) {
            let m = +l.headers.get("icy-metaint"),
              n = l.body,
              o = n.getReader();
            return o.read().then(function p(q) {
              if (!q.done) {
                let r = q.value;
                for (let s = 0; s < r.length; s++)
                  if ((g.push(r[s]), g.length > m + 4080)) {
                    let t = Uint8Array.from(g.splice(0, m)),
                      u = 16 * g.shift();
                    if (0 < u) {
                      let v = j.decode(Uint8Array.from(g.splice(0, u)));
                      self.clients.matchAll().then(function (w) {
                        w.forEach(function (x) {
                          x.postMessage({ msg: v });
                        });
                      });
                    }
                    1 == fetchSignal && fetchController.abort(), d.enqueue(t);
                  }
                return o.read().then(p);
              }
            });
          }
          let g = [];
          fetchController = new AbortController();
          let h = fetchController.signal,
            j = new TextDecoder(),
            k = fetch(a.request.url, { signal: h, headers: b });
          k.then((l) => f(l))
            .then(() => d.close())
            .catch(function () {
              console.log("Connection to stream cancelled"),
                (fetchSignal = 0),
                sendMsg("Dropped connection");
            });
        },
      });
    a.respondWith(
      new Response(c, { headers: { "Content-Type": "audio/mpeg" } })
    );
  }
}),
  self.addEventListener("install", () => {
    self.skipWaiting();
  }),
  self.addEventListener("activate", () => {
    clients.claim();
  }),
  self.addEventListener("message", (a) => {
    a.origin != playerOrigin || (fetchSignal = 1);
  });
function sendMsg(a) {
  self.clients.matchAll().then(function (b) {
    b.forEach(function (c) {
      c.postMessage({ msg: a });
    });
  });
}
