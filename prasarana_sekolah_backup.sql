-- =========================================
-- BACKUP DATABASE PRASARANA SEKOLAH
-- =========================================

-- Hapus database jika sudah ada
DROP DATABASE IF EXISTS prasarana_sekolah;

-- Buat database
CREATE DATABASE prasarana_sekolah;
USE prasarana_sekolah;

-- =========================================
-- TABLE: users
-- =========================================
CREATE TABLE users (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    nama_lengkap VARCHAR(100) NOT NULL,
    role ENUM('admin','siswa') NOT NULL,
    nis VARCHAR(20),
    kelas VARCHAR(20),
    email VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- =========================================
-- TABLE: kategori
-- =========================================
CREATE TABLE kategori (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    nama_kategori VARCHAR(100) NOT NULL,
    deskripsi TEXT
) ENGINE=InnoDB;

-- =========================================
-- TABLE: pengaduan
-- =========================================
CREATE TABLE pengaduan (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    user_id INT(11) NOT NULL,
    kategori_id INT(11) NOT NULL,
    judul VARCHAR(200) NOT NULL,
    deskripsi TEXT NOT NULL,
    lokasi VARCHAR(100),
    foto VARCHAR(255),
    status ENUM('pending','proses','selesai','ditolak') DEFAULT 'pending',
    tanggal_lapor TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    tanggal_selesai DATETIME NULL,

    -- Foreign Key
    CONSTRAINT fk_pengaduan_user
        FOREIGN KEY (user_id)
        REFERENCES users(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE,

    CONSTRAINT fk_pengaduan_kategori
        FOREIGN KEY (kategori_id)
        REFERENCES kategori(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE

) ENGINE=InnoDB;

-- =========================================
-- TABLE: feedback
-- =========================================
CREATE TABLE feedback (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    pengaduan_id INT(11) NOT NULL,
    pesan TEXT NOT NULL,
    tanggal_feedback TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    -- Foreign Key
    CONSTRAINT fk_feedback_pengaduan
        FOREIGN KEY (pengaduan_id)
        REFERENCES pengaduan(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE

) ENGINE=InnoDB;

-- =========================================
-- INDEX TAMBAHAN (Optional Performance)
-- =========================================
CREATE INDEX idx_pengaduan_user ON pengaduan(user_id);
CREATE INDEX idx_pengaduan_kategori ON pengaduan(kategori_id);
CREATE INDEX idx_feedback_pengaduan ON feedback(pengaduan_id);

-- =========================================
-- SELESAI
-- =========================================