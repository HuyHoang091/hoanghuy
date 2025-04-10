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
server.listen(PORT, () => {
    console.log(`Server is running on port ${PORT}`);
});
