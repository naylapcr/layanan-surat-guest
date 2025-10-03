<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Layanan Surat - Tracking Permohonan</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        body { font-family: sans-serif; margin: 2rem; }
        .container { max-width: 800px; margin: auto; }
        .form-group { margin-bottom: 1rem; }
        label { display: block; margin-bottom: 0.5rem; }
        input[type="text"] {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        button {
            padding: 0.75rem 1.5rem;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
            transition: background-color 0.3s ease;
        }
        button:hover {
            background-color: #0056b3;
        }
        button:disabled {
            background-color: #cccccc;
            cursor: not-allowed;
        }
        .result-box {
            margin-top: 2rem;
            padding: 1.5rem;
            border: 1px solid #eee;
            background-color: #f9f9f9;
            border-radius: 8px;
            display: none;
        }
        .result-box h2 {
            border-bottom: 2px solid #007bff;
            padding-bottom: 0.5rem;
        }
        .loading-spinner {
            display: inline-block;
            width: 1rem;
            height: 1rem;
            border: 2px solid #fff;
            border-top: 2px solid transparent;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            vertical-align: middle;
            margin-left: 0.5rem;
        }
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Layanan Mandiri & Surat</h1>
        <p>Lacak Status Permohonan Surat Anda</p>

        <form id="trackingForm">
            @csrf
            <div class="form-group">
                <label for="nomor_permohonan">Nomor Permohonan:</label>
                <input type="text" id="nomor_permohonan" name="nomor_permohonan" required>
            </div>
            <button type="submit" id="submitBtn">
                Lacak
                <span id="loadingIcon" style="display: none;" class="loading-spinner"></span>
            </button>
        </form>

        <div id="resultBox" class="result-box">
            </div>
    </div>

    <script>
    document.getElementById('trackingForm').addEventListener('submit', function(event) {
        event.preventDefault();

        const form = event.target;
        const formData = new FormData(form);
        const submitBtn = document.getElementById('submitBtn');
        const loadingIcon = document.getElementById('loadingIcon');
        const resultBox = document.getElementById('resultBox');


        submitBtn.disabled = true;
        submitBtn.childNodes[0].nodeValue = 'Mencari...';
        loadingIcon.style.display = 'inline-block';
        resultBox.style.display = 'none';

        fetch('{{ route('surat.guest.track') }}', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => {
            if (!response.ok) {
                return response.json().then(error => { throw new Error(error.message); });
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                const permohonan = data.data;
                const riwayatHTML = permohonan.riwayat_status.map(riwayat => `
                    <li>
                        <strong>Status:</strong> ${riwayat.status} -
                        <strong>Waktu:</strong> ${new Date(riwayat.waktu).toLocaleDateString('id-ID', {day: 'numeric', month: 'long', year: 'numeric', hour: 'numeric', minute: 'numeric'})}
                    </li>
                `).join('');

                resultBox.innerHTML = `
                    <h2>Detail Permohonan Surat</h2>
                    <p><strong>Nomor Permohonan:</strong> ${permohonan.nomor_permohonan}</p>
                    <p><strong>Jenis Surat:</strong> ${permohonan.jenis_surat ? permohonan.jenis_surat.nama_jenis : 'N/A'}</p>
                    <p><strong>Tanggal Pengajuan:</strong> ${new Date(permohonan.tanggal_pengajuan).toLocaleDateString('id-ID', {day: 'numeric', month: 'long', year: 'numeric'})}</p>
                    <p><strong>Status Terkini:</strong> ${permohonan.status}</p>
                    <h3>Riwayat Status</h3>
                    <ul>${riwayatHTML}</ul>
                `;
            } else {
                resultBox.innerHTML = `<p style="color: red;">${data.message}</p>`;
            }
        })
        .catch(error => {
            resultBox.innerHTML = `<p style="color: red;">Terjadi kesalahan: ${error.message}</p>`;
        })
        .finally(() => {
            submitBtn.disabled = false;
            submitBtn.childNodes[0].nodeValue = 'Lacak';
            loadingIcon.style.display = 'none';
            resultBox.style.display = 'block';
        });
    });
    </script>
</body>
</html>
