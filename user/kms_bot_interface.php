<?php
// Simulasi basis pengetahuan KMS
$faq = [
    "Apa itu UNYCraft?" => "UNYCraft adalah platform e-commerce untuk produk kerajinan tangan.",
    "Apa itu unycraft" => "UNYCraft adalah platform e-commerce untuk produk kerajinan tangan.",
    "apa itu unycraft" => "UNYCraft adalah platform e-commerce untuk produk kerajinan tangan.",
    "apa itu unycraft?" => "UNYCraft adalah platform e-commerce untuk produk kerajinan tangan.",
    "Cara menambah produk?" => "Masuk ke dashboard admin, lalu pilih menu 'Tambah Produk'.",
    "Cara menghubungi support?" => "Anda dapat menghubungi kami melalui email support@unycraft.com.",
    "Metode pembayaran yang tersedia?" => "Kami mendukung pembayaran melalui transfer bank dan e-wallet."
];

// Mendapatkan pertanyaan dari input pengguna
$pertanyaan = isset($_POST['pertanyaan']) ? trim($_POST['pertanyaan']) : "";

// Mencari jawaban
$jawaban = "Maaf, saya tidak menemukan jawaban untuk pertanyaan Anda.";
if (array_key_exists($pertanyaan, $faq)) {
    $jawaban = $faq[$pertanyaan];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KMS Bot</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
    }

    .chat-container {
        width: 30%;
        /* Lebar lebih kecil */
        max-width: 400px;
        /* Maksimal 400px untuk responsivitas */
        height: 40%;
        /* Tinggi lebih kecil */
        min-height: 300px;
        /* Minimal 300px untuk kenyamanan */
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        padding: 8px;
        /* Padding lebih kecil */
        border: 1px solid #ccc;
        /* Tambahkan border jika ingin kontainer terlihat */
        border-radius: 8px;
        background-color: #fff;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        /* Efek bayangan ringan */
    }

    .chat-box {
        flex-grow: 1;
        overflow-y: auto;
        border: 1px solid #ccc;
        border-radius: 5px;
        padding: 8px;
        /* Padding lebih kecil */
        background-color: #f9f9f9;
        font-size: 14px;
        /* Ukuran font lebih kecil */
        line-height: 1.4;
        /* Jarak antar baris optimal */
    }

    .input-box {
        display: flex;
        margin-top: 8px;
        /* Margin lebih kecil */
    }

    .input-box input {
        flex-grow: 1;
        padding: 8px;
        /* Padding lebih kecil */
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 14px;
        /* Ukuran font lebih kecil */
    }

    .input-box button {
        margin-left: 8px;
        /* Margin antar elemen lebih kecil */
        padding: 8px 12px;
        /* Padding lebih kecil */
        border: none;
        border-radius: 5px;
        background-color: #007bff;
        color: white;
        cursor: pointer;
        font-size: 14px;
        /* Ukuran font lebih kecil */
        transition: background-color 0.3s ease;
    }

    .input-box button:hover {
        background-color: #0056b3;
        /* Warna lebih gelap saat hover */
    }

    /* Tambahkan gaya responsif */
    @media (max-width: 768px) {
        .chat-container {
            width: 90%;
            /* Lebar penuh pada layar kecil */
            height: auto;
            /* Tinggi otomatis */
            max-height: 70%;
            /* Maksimal 70% tinggi layar */
        }

        .chat-box {
            font-size: 12px;
            /* Ukuran font lebih kecil pada layar kecil */
        }

        .input-box input,
        .input-box button {
            font-size: 12px;
            /* Font lebih kecil */
        }
    }
    </style>
</head>

<body>
    <div class="chat-container">
        <div class="chat-box" id="chat-box">
            <p><strong>Bot:</strong> Selamat datang di UNYCraft! Ada yang bisa saya bantu?</p>
            <?php if ($pertanyaan): ?>
            <p><strong>Anda:</strong> <?= htmlspecialchars($pertanyaan) ?></p>
            <p><strong>Bot:</strong> <?= htmlspecialchars($jawaban) ?></p>
            <?php endif; ?>
        </div>
        <form class="input-box" method="post">
            <input type="text" name="pertanyaan" placeholder="Ketik pertanyaan Anda..." required>
            <button type="submit">Kirim</button>
        </form>
    </div>
</body>

</html>