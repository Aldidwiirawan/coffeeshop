<x-layout>
    <x-slot:title>Dashboard</x-slot:title>

    <style>
        body {
            background: #ffffff;
            color: #333;
            font-family: 'Times New Roman', serif;
        }

        .dashboard-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            text-align: center;
            animation: fadeIn 1s ease-in-out;
        }

        .dashboard-card {
            background: #ffffff;
            border-radius: 20px;
            padding: 30px;
            width: 90%;
            max-width: 600px;
            box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out;
            border: 3px solid #0f4c75;
        }

        .dashboard-card:hover {
            transform: scale(1.05);
        }

        h1 {
            font-size: 32px;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: #0f4c75;
        }

        h2 {
            font-size: 24px;
            font-family: 'Times New Roman', serif;
            font-weight: 500;
            margin-top: 10px;
            color: #3282b8;
        }

        .icon {
            font-size: 60px;
            margin-bottom: 15px;
            color: #0f4c75;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

    </style>

    <div class="dashboard-container">
        <div class="dashboard-card">
            <div class="icon">🚀</div>
            <h1>Selamat Datang, {{ $userName }}</h1>
            <h2>Anda masuk sebagai <strong>{{ $userType }}</strong></h2>
        </div>
    </div>

</x-layout>
