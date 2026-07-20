# 🔬 Project ShellSukaBintang01: Webshell Framework Analysis

![Category](https://img.shields.io/badge/Category-Cybersecurity%20Research-blue?style=for-the-badge)
![Target](https://img.shields.io/badge/Focus-Malware%20Analysis%20%26%20Detection-red?style=for-the-badge)
![Status](https://img.shields.io/badge/Status-Educational%20Reference-green?style=for-the-badge)

Repositori `ShellSukaBintang01` didedikasikan sebagai referensi studi kasus mengenai mekanisme kerja, teknik penyamaran (*obfuscation*), dan pola deteksi terhadap ancaman berbasis **Webshell** dan **Backdoor Shell** pada lingkungan server berbasis PHP.

> [!WARNING]
> **Tujuan Edukasi & Penelitian:** Materi dalam repositori ini disediakan murni untuk tujuan pembelajaran, pemodelan ancaman (*threat modeling*), dan pengembangan sistem pertahanan web. Penyalahgunaan kode untuk aktivitas ilegal di luar lingkungan laboratorium terisolasi sepenuhnya berada di luar tanggung jawab pengembang.

---

## 📖 Latar Belakang & Konseptual

Webshell merupakan salah satu vektor persistensi yang sering digunakan oleh aktor ancaman setelah berhasil mengeksploitasi kerentanan aplikasi web (seperti celah *File Upload* atau kerentanan komponen pihak ketiga). 

Proyek penelitian ini berfokus pada analisis perilaku struktur shell modern, termasuk:
* **Dynamic Control Flow:** Bagaimana skrip mengeksekusi instruksi jarak jauh melalui pemanggilan variabel secara modular.
* **Payload Masking:** Studi kasus mengenai teknik pengodean string (Heksadesimal, ASCII Array, Base64) yang digunakan untuk mengelabui pembacaan teks otomatis (*Signature-based Antivirus*).
* **Remote Callback Mechanisms:** Analisis terhadap arsitektur *bridge script* yang memisahkan antara modul input lokal dengan konfigurasi eksternal (seperti GitHub API atau Webhook).

---

## 🛠️ Komponen Pengujian Lab

Untuk melakukan analisis perilaku skrip di lingkungan lokal yang aman (sandbox), pastikan setup laboratorium Anda memenuhi kriteria berikut:

| Komponen | Spesifikasi Laboratorium | Fungsi Analisis |
| :--- | :--- | :--- |
| **Interpreter** | PHP 7.4 / 8.x (Local Logging Enabled) | Memantau jejak eksekusi fungsi |
| **Network Monitor** | Wireshark / Burp Suite | Menganalisis *outbound traffic* ke API eksternal |
| **Sandbox Environment** | Docker / VirtualBox (Isolated LAN) | Mencegah penyebaran payload ke host utama |

---

## 🛡️ Cetak Biru Deteksi & Remediasi (Defensive Guide)

Berdasarkan struktur artefak yang dianalisis dalam proyek ini, berikut adalah pola deteksi (*Detection Signatures*) yang direkomendasikan untuk administrator server:

### 1. Deteksi Logika Obfuscation (YARA Rule Mockup)
Aplikasi Web Application Firewall (WAF) atau scanner lokal dapat dikonfigurasi untuk mencari pola konversi karakter biner/heksadesimal berulang yang tidak wajar pada direktori publik:
```yara
rule Detect_Hex_Obfuscation {
    strings:
        $hex_pattern = /\\x[0-9a-fA-F]{2}/ repeated(10)$chr_loop = "foreach" ascii
    condition:
        $hex_pattern and$chr_loop
}
