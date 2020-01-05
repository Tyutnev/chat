/**
 * Подключение к сокет серверу
 */
let socket = new WebSocket('ws://127.0.0.1:8080');

/**
 * Соединение установлено
 */
socket.onopen = (event) => {
    console.log('Connect');
}

/**
 * Получение данных
 */
socket.onmessage = (event) => {
    console.log('Got data');
}

/**
 * Соединение закрыто
 */
socket.close = (event) => {
    console.log('Close');
}