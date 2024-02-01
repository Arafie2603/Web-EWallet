<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Table Styling</title>
<style>
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin: 20px;
    background-color: #fff;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

th, td {
    padding: 12px;
    text-align: left;
}

th {
    background-color: #3498db;
    color: #fff;
}

tr:nth-child(even) {
    background-color: #f2f2f2;
}

tr:hover {
    background-color: #e5e5e5;
}
</style>
</head>
<body>

<table>
    <thead>
        <tr>
            <th>Nama Produk</th>
            <th>Tanggal Pembayaran</th>
            <th>Nomor Telepon</th>
            <th>Pengeluaran</th>
            <th>Poin</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        <!-- Isi tabel dapat ditambahkan di sini -->
        @foreach ($transaAll as $index => $td)
        <tr>
            <td>{{ $td->nama_produk }}</td>
            <td>{{ $date[$index] }}</td>
            <td>{{ $td->noTelp }}</td>
            <td>-Rp{{ number_format($td->total_harga, 0, ',', '.') }}</td>
            <td>+{{ $td->reward_poin }}</td>
            <td>{{ $td->status }}</td>
        </tr>
        @endforeach
        <!-- Tambahkan baris lain sesuai kebutuhan -->
    </tbody>
</table>

</body>
</html>
