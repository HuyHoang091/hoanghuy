const express = require('express');
const http = require('http');
const socketIo = require('socket.io');

const app = express();
const server = http.createServer(app);
const io = socketIo(server);

// Để phục vụ tệp tĩnh
app.use(express.static('public'));

// Endpoint để xác nhận mã QR
app.get('/confirm', (req, res) => {
    io.emit('confirmed'); // Phát sự kiện 'confirmed' tới tất cả client
    res.send('QR code has been scanned and confirmed!');
});

const PORT = process.env.PORT || 3000;
server.listen(PORT, '0.0.0.0', () => {
    console.log(`Server is running on port ${PORT}`);
});

const os = require('os');

// Hàm lấy IP LAN
function getLocalIp() {
    const interfaces = os.networkInterfaces();
    for (const name of Object.keys(interfaces)) {
        for (const iface of interfaces[name]) {
            if (iface.family === 'IPv4' && !iface.internal && iface.address.startsWith('192.168.')) {
                return iface.address;
            }
        }
    }
    return 'localhost';
}

// Trả file config.js động
app.get('/config.js', (req, res) => {
    const ip = getLocalIp();
    res.type('application/javascript');
    res.send(`const QR_SERVER_IP = "${ip}";`);
});

