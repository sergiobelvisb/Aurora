const express = require('express');
const http    = require('http');
const WebSocket = require('ws');

const app    = express();
const server = http.createServer(app);

app.use(express.json());

// ── WebSocket en /ws ──────────────────────────────────────────
const wss = new WebSocket.Server({ server, path: "/ws" });
console.log("WebSocket listo en /ws");

let clients = [];

function enviarAlApache(datos) {
  const jsonStr = JSON.stringify(datos);
  const options = {
    hostname: 'aurora-eeg.com',
    port: 443,
    path: '/panel/guardarSesion',
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'Content-Length': Buffer.byteLength(jsonStr)
    }
  };

  const req = require('https').request(options, (res) => {
    console.log("Laravel respondió:", res.statusCode);
  });

  req.on('error', (e) => console.error("Error enviando a Laravel:", e.message));
  req.write(jsonStr);
  req.end();
}

wss.on('connection', (ws) => {
  console.log("Cliente conectado");
  clients.push(ws);

  ws.on('message', (message) => {
    console.log("Mensaje recibido:", message.toString());
    try {
      const datos = JSON.parse(message.toString());

      enviarAlApache(datos);

      clients.forEach(client => {
        if (client.readyState === WebSocket.OPEN) {
          client.send(JSON.stringify(datos));
        }
      });
    } catch (e) {
      console.error("JSON inválido:", e.message);
    }
  });

  ws.on('close', () => {
    console.log("Cliente desconectado");
    clients = clients.filter(c => c !== ws);
  });
});

// ── Healthcheck para ECS ──────────────────────────────────────
app.get('/health', (req, res) => {
  res.json({ ok: true });
});

// ── Arranque ──────────────────────────────────────────────────
server.listen(3000, () => {
  console.log("Servidor escuchando en puerto 3000");
});