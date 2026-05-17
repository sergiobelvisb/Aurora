#include <WiFi.h>
#include <WebServer.h>
#include <Preferences.h>
#include <WebSocketsClient.h>
#include <Brain.h>

const char* wsHost = "aurora-eeg.com";
const int   wsPort = 443;

const char* AP_SSID = "Aurora-EEG-Config";  
const char* AP_PASS = "aurora1234";

WebSocketsClient webSocket;
Brain            brain(Serial1);
Preferences      prefs;
WebServer        server(80);

String savedSSID     = "";
String savedPassword = "";
bool   wifiConnected = false;

const char CONFIG_HTML[] PROGMEM = R"rawliteral(
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Aurora EEG – Configurar WiFi</title>
  <style>
    body { font-family: Arial, sans-serif; background: #f0f0f0;
           display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
    .card { background: white; padding: 32px; border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1); width: 320px; }
    h2 { margin: 0 0 24px; text-align: center; color: #333; }
    label { display: block; margin-bottom: 4px; font-size: 14px; color: #555; }
    input { width: 100%; padding: 10px; margin-bottom: 16px; border: 1px solid #ccc;
            border-radius: 8px; font-size: 14px; box-sizing: border-box; }
    button { width: 100%; padding: 12px; background: #6366f1; color: white;
             border: none; border-radius: 8px; font-size: 15px; cursor: pointer; }
    button:hover { background: #4f46e5; }
    .msg { margin-top: 16px; text-align: center; font-size: 13px; color: #22c55e; }
  </style>
</head>
<body>
  <div class="card">
    <h2>🧠 Aurora EEG</h2>
    <form action="/save" method="POST">
      <label>Red WiFi (SSID)</label>
      <input type="text" name="ssid" placeholder="Nombre de tu red" required>
      <label>Contraseña</label>
      <input type="password" name="password" placeholder="Contraseña" required>
      <button type="submit">Guardar y conectar</button>
    </form>
    %MSG%
  </div>
</body>
</html>
)rawliteral";

void handleRoot() {
  String html = String(CONFIG_HTML);
  html.replace("%MSG%", "");
  server.send(200, "text/html", html);
}

void handleSave() {
  String newSSID = server.arg("ssid");
  String newPass = server.arg("password");

  prefs.begin("wifi", false);
  prefs.putString("ssid",     newSSID);
  prefs.putString("password", newPass);
  prefs.end();

  String html = String(CONFIG_HTML);
  html.replace("%MSG%", "<p class='msg'>✅ Guardado. Reiniciando en 3 segundos...</p>");
  server.send(200, "text/html", html);

  delay(3000);
  ESP.restart();
}

void onWebSocketEvent(WStype_t type, uint8_t* payload, size_t length) {
  switch (type) {
    case WStype_CONNECTED:    Serial.println("WebSocket conectado!");      break;
    case WStype_DISCONNECTED: Serial.println("WebSocket desconectado...");  break;
    case WStype_TEXT:         Serial.printf("Recibido: %s\n", payload);    break;
  }
}

void startAP() {
  WiFi.softAP(AP_SSID, AP_PASS);
  Serial.println("Modo AP. Conéctate a '" + String(AP_SSID) + "' → http://192.168.4.1");
  server.on("/",     HTTP_GET,  handleRoot);
  server.on("/save", HTTP_POST, handleSave);
  server.begin();
}

void setup() {
  Serial.begin(115200);
  Serial1.begin(9600, SERIAL_8N1, D4, D5);

  // ── Ventana de reset: 5 segundos para mandar 'R' por Serie ──
  Serial.println("Manda 'R' en 5 segundos para resetear WiFi...");
  unsigned long t = millis();
  while (millis() - t < 5000) {
    if (Serial.available() && Serial.read() == 'R') {
      Serial.println("Reset! Borrando credenciales...");
      prefs.begin("wifi", false);
      prefs.clear();
      prefs.end();
      break;
    }
  }

  // ── Leer credenciales ────────────────────────────────────────
  prefs.begin("wifi", true);
  savedSSID     = prefs.getString("ssid",     "");
  savedPassword = prefs.getString("password", "");
  prefs.end();

  if (savedSSID.length() > 0) {
    Serial.println("Conectando a: " + savedSSID);
    WiFi.begin(savedSSID.c_str(), savedPassword.c_str());

    unsigned long start = millis();
    while (WiFi.status() != WL_CONNECTED && millis() - start < 15000) {
      delay(500);
      Serial.print(".");
    }

    if (WiFi.status() == WL_CONNECTED) {
      Serial.println("\nConectado! IP: " + WiFi.localIP().toString());
      wifiConnected = true;
      // SSL + ruta /ws + puerto 443
      webSocket.beginSSL(wsHost, wsPort, "/ws");
      webSocket.onEvent(onWebSocketEvent);
      webSocket.setReconnectInterval(3000);
      return;
    }

    Serial.println("\nFallo al conectar. Abriendo AP...");
  }

  startAP();
}

void loop() {
  if (wifiConnected) {
    webSocket.loop();
    if (brain.update()) {
      String json = "{";
      json += "\"signal\":"     + String(brain.readSignalQuality()) + ",";
      json += "\"attention\":"  + String(brain.readAttention())     + ",";
      json += "\"meditation\":" + String(brain.readMeditation())    + ",";
      json += "\"delta\":"      + String(brain.readDelta())         + ",";
      json += "\"theta\":"      + String(brain.readTheta())         + ",";
      json += "\"lowAlpha\":"   + String(brain.readLowAlpha())      + ",";
      json += "\"highAlpha\":"  + String(brain.readHighAlpha())     + ",";
      json += "\"lowBeta\":"    + String(brain.readLowBeta())       + ",";
      json += "\"highBeta\":"   + String(brain.readHighBeta())      + ",";
      json += "\"lowGamma\":"   + String(brain.readLowGamma());
      json += "}";
      Serial.println(json);
      webSocket.sendTXT(json);
    }
  } else {
    server.handleClient();
  }
}
