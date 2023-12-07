const express = require('express');
const app = express();
const http = require('http').createServer(app);
const io = require('socket.io')(http);

app.post('/chat', (req, res) => {
    const { userId, replyType, ask, answer, message, ipAddress, groupConversation } = req.body;

    // Lakukan penyimpanan data ke database atau logika sesuai kebutuhan
    // ...

    // Kirim balasan kepada client lain yang terhubung
    io.emit('chat message', { userId, replyType, ask, answer, message, ipAddress, groupConversation });

    res.status(200).send('Pesan berhasil disimpan');
});

http.listen(3000, () => {
    console.log('Server is running on port 3000');
});
