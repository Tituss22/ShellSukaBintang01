# 💀 ShellSukaBintang01: Web Persistence & Remote Access Archive

![Category](https://img.shields.io/badge/Category-Cybersecurity%20Research-blue?style=for-the-badge)
![Language](https://img.shields.io/badge/Language-PHP%20%7C%20Bash%20%7C%20.htaccess-777bb4?style=for-the-badge)
![Scope](https://img.shields.io/badge/Focus-Backdoor%20%26%20Reverse%20Shell%20Analysis-red?style=for-the-badge)

Repositori ini merupakan pustaka referensi dan arsip studi kasus mengenai berbagai varian **Webshell**, **Reverse Shell**, **Symlink Tool**, dan mekanisme **Bypass Server Security**. Proyek ini ditujukan untuk memetakan arsitektur kendali jarak jauh (remote access) dan taktik persistensi malware pada server web.

> [!WARNING]
> **DISCLAIMER & KETENTUAN HUKUM:** Semua file di dalam repositori ini disediakan eksklusif untuk tujuan edukasi, penelitian forensik digital, analisis malware, dan pengujian penetrasi resmi (*authorized pentesting*). Penyalahgunaan aset kode ini untuk aktivitas ilegal tanpa izin tertulis dari pemilik sistem adalah pelanggaran hukum berat dan sepenuhnya di luar tanggung jawab pengembang.

---

## 📂 Struktur Arsip & Komponen Analisis

Berdasarkan modul-modul yang tersedia di dalam repositori ini, berikut adalah pemetaan fungsionalitas komponen untuk keperluan analisis keamanan:

### 1. Web Core & Execution Interfaces
* **`SukaBintang01.php` / `original.php`**: Core interface webshell yang menyediakan kendali panel, manajemen file system, dan eksekusi perintah OS secara interaktif.
* **`cyberpunk.php` / `gray.php`**: Varian antarmuka shell grafis untuk pengujian kontrol taktis jarak jauh.
* **`index.php` / `indexxx.php`**: Modul entri utama yang digunakan sebagai *landing gateway*.

### 2. Privileges Escalation & Bypass Tools
* **`SymlinkcPanel.php`**: Skrip analisis kerentanan symlink untuk memetakan konfigurasi akun dan file konfigurasi sensitif di lingkungan shared hosting.
* **`bypallser.php` / `antidel.php`**: Modul pengujian untuk melewati pembatasan keamanan lokal, *safe mode*, atau fungsi pemblokiran sistem operasi.
* **`.htaccess`**: Aturan konfigurasi tingkat server yang digunakan untuk memanipulasi *handler* PHP, menyembunyikan file, atau membelokkan akses URL.

### 3. Connection Hooks & Utilities
* **`call.php` / `code.php`**: Skrip callback eksternal untuk inisialisasi koneksi data.
* **`obfuscator.php`**: Utilitas untuk menganalisis teknik penyamaran string guna menguji sensitivitas *Signature-based Antivirus* server.

---

## 🔬 Metodologi Analisis Lab (Sandbox Setup)

Untuk menjalankan dan meneliti file-file di dalam repositori ini tanpa risiko kebocoran data atau infeksi jaringan:

1. **Isolasi Total:** Gunakan lingkungan virtual (Docker Containers, VirtualBox, atau VMware) dengan kartu jaringan yang diatur ke mode **Host-Only** atau **Internal Network** (tanpa koneksi internet publik).
2. **Audit Lalu Lintas (Traffic Auditing):** Pasang peralatan monitor seperti *Wireshark* atau *Burp Suite* pada host pengeksekusi untuk menganalisis payload keluar (*outbound telemetry*) yang dikirim melalui fungsi stream jaringan.
3. **Runtime Monitor:** Aktifkan sistem audit log PHP (`error_log` dan `syslog`) untuk melihat bagaimana fungsi sistem seperti `system()`, `exec()`, atau `proc_open()` berinteraksi dengan kernel OS.

---

## 🛡️ Panduan Pertahanan (Defensive Blueprint)

Bagi administrator jaringan dan *Blue Team*, berikut adalah langkah mitigasi taktis untuk mencegah dan mendeteksi keberadaan skrip pintu belakang sejenis di server produksi:

* **Inisialisasi Proaktif (PHP Hardening):**
  Matikan fungsi eksekusi berbahaya di dalam file `php.ini` sistem:
  ```ini
  disable_functions = exec, passthru, shell_exec, system, proc_open, popen, eval, symlink
