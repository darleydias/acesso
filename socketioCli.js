import { io } from "socket.io-client";

const socket = io("ws://localhost:3000");

// Envia uma messagem para o servidor
socket.emit("hello", 5, "6", { 7: Uint8Array.from([8]) });

// recebe uma mensagem do servidor
socket.on("hello from server", (...args) => {
  // ...
});

