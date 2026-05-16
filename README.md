# Aurora – EEG Real-Time Monitoring System

Aurora es una aplicación web orientada al ámbito médico que permite la monitorización en tiempo real de la actividad cerebral mediante dispositivos EEG conectados a un sistema distribuido. El sistema está diseñado para ayudar a profesionales sanitarios a observar la actividad cerebral de pacientes en tiempo real, con el objetivo de explorar cómo la tecnología puede facilitar el análisis de señales cerebrales y apoyar procesos de diagnóstico o seguimiento clínico.

La aplicación permite gestionar pacientes, iniciar sesiones de monitorización y visualizar la evolución de las ondas cerebrales en directo, sin necesidad de recargar la página. Todo el sistema está diseñado para funcionar de forma continua y con baja latencia, simulando un entorno lo más cercano posible a una herramienta real de monitorización médica.

El objetivo del proyecto es proporcionar una plataforma que permita a profesionales sanitarios visualizar, almacenar y analizar datos neurofisiológicos de pacientes en tiempo real. Aurora no busca sustituir sistemas médicos profesionales, sino demostrar cómo una arquitectura basada en tecnologías web, comunicación en tiempo real y dispositivos embebidos puede integrarse en una solución funcional orientada al ámbito sanitario.

---

## Arquitectura del sistema

El sistema Aurora está compuesto por una arquitectura distribuida basada en tres capas principales:

### 1. Dispositivo de adquisición (Arduino Nano ESP32)

- Captura señales EEG mediante sensores MindFlex
- Procesa las ondas cerebrales (delta, theta, alpha, beta, gamma)
- Envía los datos en formato JSON
- Conexión WiFi directa o mediante modo Access Point (AP)
- Comunicación con el servidor mediante WebSockets

---

### 2. Servidor en tiempo real (Node.js + WebSockets)

- Implementa un servidor WebSocket persistente
- Recibe datos del dispositivo EEG en tiempo real
- Reenvía la información a los clientes web conectados
- Permite transmisión de baja latencia

Tecnologías:
- Node.js
- Librería ws (WebSockets)

---

### 3. Backend (Laravel API REST)

- Gestión de usuarios y autenticación
- Gestión de pacientes y sesiones clínicas
- Almacenamiento estructurado de datos médicos
- Control de permisos mediante tokens

Tecnologías:
- PHP 8+
- Laravel Framework
- MySQL (Amazon RDS)

---

### 4. Frontend (JavaScript Vanilla)

- Interfaz web para profesionales médicos
- Visualización de datos EEG en tiempo real
- Gráficas dinámicas actualizadas mediante WebSockets
- Panel de gestión de pacientes

Tecnologías:
- HTML5
- CSS3
- JavaScript Vanilla

---

### 5. Infraestructura (AWS)

El sistema está desplegado en Amazon Web Services:

- EC2 (Ubuntu con Docker) para backend y servidor Node.js
- RDS (MySQL) en red privada
- VPC para segmentación de red
- Subred pública para servicios accesibles
- Subred privada para base de datos

---

## Flujo de datos

EEG Device (ESP32)
→ WebSocket Server (Node.js)
→ Frontend (visualización en tiempo real)
→ API REST (Laravel)
→ Base de datos (MySQL en AWS RDS)

---

## Funcionalidades principales

- Monitorización cerebral en tiempo real
- Visualización de ondas EEG en vivo
- Gestión de pacientes y sesiones
- Autenticación mediante tokens
- Configuración automática de red WiFi en el dispositivo
- Arquitectura distribuida en la nube

---

## Seguridad

- Autenticación basada en tokens
- Base de datos en red privada (AWS RDS)
- Separación entre API REST y comunicación en tiempo real
- Control de acceso por roles

---

## Problemas técnicos resueltos

- Implementación de comunicación en tiempo real con WebSockets
- Configuración automática de WiFi en ESP32 mediante Access Point
- Sincronización de datos entre hardware, servidor y frontend
- Despliegue en entorno cloud con Docker
- Integración de múltiples tecnologías heterogéneas

---

## Futuras mejoras

- Incorporación de inteligencia artificial para análisis de señales EEG
- Uso de dispositivos EEG profesionales multicanal
- Automatización de pruebas (unit testing e integration testing)
- Sistema de generación automática de informes médicos
- Mejora de visualización avanzada de datos neurológicos

---

## Autores

- Sergio Belvís  
- Brian Camba  
- Damiem Rave  

---

## Tecnologías utilizadas

- Arduino Nano ESP32
- Node.js + WebSockets
- Laravel (PHP)
- MySQL (AWS RDS)
- JavaScript Vanilla
- Docker
- Amazon Web Services (EC2, VPC, RDS)

---

## Nota

Este proyecto forma parte del Trabajo de Fin de Grado del ciclo de Desarrollo de Aplicaciones Web (DAW).
