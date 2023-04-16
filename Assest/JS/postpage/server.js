const express = require('express');
const app = express();
const multer = require('multer');

// Konfigurasi multer untuk meng-handle upload file
const upload = multer({
  dest: 'public/upload/' // Folder penyimpanan gambar
});

// Endpoint untuk meng-handle upload gambar
//
app.post('/upload', upload.single('upload'), (req, res) => {
  res.json({
    url: `/upload/${req.file.filename}` // URL gambar yang diupload untuk ditampilkan di CKEditor
  });
});

// Konfigurasi folder statis untuk menyajikan gambar yang telah diupload
app.use(express.static('public'));

// Start server
app.listen(3000, () => {
  console.log('Server berjalan pada http://localhost:3000');
});
