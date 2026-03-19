# Aurora - Aplicación Web para Monitorización EEG

Aurora es una aplicación web diseñada para médicos en clínicas u hospitales, desarrollada por Damiem Rave Grizales, Brian Camba Hipólito y Sergio Belvís Barba. El proyecto permite monitorizar ondas cerebrales de pacientes en tiempo real mediante el uso de bandas con sensores EEG conectadas a un Arduino y transmitiendo datos vía Bluetooth.  

La aplicación ofrece a los médicos un panel de control desde el cual pueden:  
- Crear perfiles de pacientes.  
- Iniciar la monitorización de las ondas cerebrales en tiempo real.  
- Obtener, tras un tiempo determinado, un prediagnóstico basado en los datos recibidos, mostrando información clave para apoyar la interpretación clínica.  

El proyecto combina varias tecnologías para cubrir tanto la parte de adquisición de datos como la interfaz web:  
- **PHP, HTML, CSS y JavaScript**: Desarrollo de la aplicación web y del panel de control.  
- **C++**: Recepción y envío de los datos EEG desde el Arduino.  
- **Java (en estudio)**: Posible implementación de gráficos en tiempo real en la web mediante WebSocket.  

Aurora integra hardware y software de manera que los médicos puedan acceder de forma sencilla y segura a la información del paciente, facilitando la toma de decisiones clínicas basadas en datos objetivos y en tiempo real.
