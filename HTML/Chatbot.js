document.addEventListener("DOMContentLoaded", function () {
    const chatContainer = document.getElementById("chat-container");
    const openChatButton = document.getElementById("open-chat");
    const closeChatButton = document.getElementById("close-chat");
    const sendButton = document.getElementById("send-button");
    const chatInput = document.getElementById("chat-input");
    const chatMessages = document.getElementById("chat-messages");

   
    const abogados = [
        { nombre: 'Juan Pérez', servicio: 'Asesoría Jurídica en Siniestros Viales', telefono: '3001234567', correo: 'juan.perez@abogados.com', fechaIngreso: '2020-06-15' },
        { nombre: 'Ana Gómez', servicio: 'Implementación y Manejo del PESV', telefono: '3002345678', correo: 'ana.gomez@abogados.com', fechaIngreso: '2019-05-10' },
        { nombre: 'Carlos Martínez', servicio: 'Reconstrucción Técnica y Analítica de Siniestros Viales', telefono: '3003456789', correo: 'carlos.martinez@abogados.com', fechaIngreso: '2018-07-20' },
        { nombre: 'Luisa Fernández', servicio: 'Servicios Funerarios en Siniestros Viales', telefono: '3004567890', correo: 'luisa.fernandez@abogados.com', fechaIngreso: '2021-01-12' },
        { nombre: 'Pedro Rodríguez', servicio: 'Reclamaciones Ante las Aseguradoras', telefono: '3005678901', correo: 'pedro.rodriguez@abogados.com', fechaIngreso: '2022-11-05' }
    ];

    const horariosAtencion = {
        lunesViernes: 'Lunes a Viernes: 7:00 AM - 6:00 PM',
        sabado: 'Sábado: 7:00 AM - 12:00 PM',
        domingosFestivos: 'Domingos y festivos: No hay atención'
    };

    
    openChatButton.addEventListener("click", function () {
        chatContainer.style.display = "block";
        openChatButton.style.display = "none"; 
    });


    closeChatButton.addEventListener("click", function () {
        chatContainer.style.display = "none";
        openChatButton.style.display = "block"; 
    });

    sendButton.addEventListener("click", function () {
        const message = chatInput.value.trim();
        if (message !== "") {
          
            const newMessage = document.createElement("div");
            newMessage.classList.add("chat-message", "user");
            newMessage.textContent = "Tú: " + message;
            chatMessages.appendChild(newMessage);

            
            const botMessage = document.createElement("div");
            botMessage.classList.add("chat-message", "bot");
            let responseMessage = "Bot: ";

           
            if (message.toLowerCase().includes("hola") || message.toLowerCase().includes("cómo estás")) {
                responseMessage = "¡Hola! Soy tu asistente virtual. ¿En qué puedo ayudarte hoy?";
            } 
         
            else if (message.toLowerCase().includes("ayuda")) {
                responseMessage = "¿En qué te puedo ayudar? Por favor elige una opción:\n\n" +
                    "1. Servicios\n" +
                    "2. Horario de atención\n" +
                    "3. Especialistas\n" +
                    "4. Agendar cita";
                    "5. Salir";
            }
           
            else if (message.toLowerCase().includes("info")) {
                responseMessage = "Por favor elige una opción:\n\n" +
                    "1. Servicios\n" +
                    "2. Horario de atención\n" +
                    "3. Especialistas\n" +
                    "4. Agendar cita\n" +
                    "5. Salir";
            }
            
            else if (message === "1") {
                responseMessage = "Estos son los servicios que ofrecemos:\n\n" +
                    "• Asesoría Jurídica en Siniestros Viales\n" +
                    "• Implementación y Manejo del PESV\n" +
                    "• Reconstrucción Técnica y Analítica de Siniestros Viales\n" +
                    "• Servicios Funerarios en Siniestros Viales\n" +
                    "• Reclamaciones Ante las Aseguradoras";
            } else if (message === "2") {
                responseMessage = `Nuestros horarios de atención son:\n\n` +
                    `• Lunes a Viernes: 7:00 AM - 6:00 PM\n\n` +
                    `• Sábado: 7:00 AM - 12:00 PM\n\n` +
                    `• Domingos y festivos: No se trabaja`;
            } else if (message === "3") {
                responseMessage = "Nuestros especialistas son:\n\n" +
                    "• Juan Pérez: Asesoría Jurídica en Siniestros Viales\n\n" +
                    "• Ana Gómez: Implementación y Manejo del PESV\n\n" +
                    "• Carlos Martínez: Reconstrucción Técnica y Analítica de Siniestros Viales\n\n" +
                    "• Luisa Fernández: Servicios Funerarios en Siniestros Viales\n\n" +
                    "• Pedro Rodríguez: Reclamaciones Ante las Aseguradoras";
            } else if (message === "4") {
                responseMessage = "Para agendar una cita, sigue estos pasos:\n\n" +
                    "• Dirígete a la pestaña de servicios o agendar citas.\n\n" +
                    "• Coloca tus datos y la especialidad que necesitas.\n\n" +
                    "• Finalmente, programa la cita.";
            } 
             else if (message === "") {
            responseMessage = "Espero haberte ayudado ";
        } 
            
            else {
                responseMessage = "Gracias por tu mensaje, ¿en qué más puedo ayudarte?";
            }

            botMessage.textContent = responseMessage;
            chatMessages.appendChild(botMessage);

            
            chatInput.value = "";
            chatMessages.scrollTop = chatMessages.scrollHeight;
        }
    });
});






