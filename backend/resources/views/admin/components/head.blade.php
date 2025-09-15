<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="/images/favicon.png">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#d2b48c', // lúa mì
                        secondary: '#f5deb3', // đậu nành
                        accent: '#3e2723', // nâu chocolate
                        textDark: '#2c2c2c', // than xám đậm
                        highlight: '#10b981' // xanh lá nhẹ
                    }
                }
            }
        }
    </script>

    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8fafc;
            color: #2c2c2c;
            /* màu chữ dễ đọc */
        }

        .sidebar {
            width: 16rem;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background: linear-gradient(135deg, #1f1f1f 0%, #3a3a3a 100%);
            color: #1f1f1f;
            transition: all 0.3s ease;
            z-index: 1000;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        .sidebar-header {
            padding: 1.5rem 1rem;
            border-bottom: 1px solid rgba(44, 44, 44, 0.2);
        }

        .sidebar-menu {
            padding: 1rem 0;
        }

        .sidebar-menu a {
            display: flex;
            align-items: center;
            padding: 0.75rem 1.5rem;
            color: #1f1f1f;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.2s ease-in-out;
            border-left: 4px solid transparent;
        }

        .sidebar-menu a:hover,
        .sidebar-menu a.active {
            background-color: rgba(0, 0, 0, 0.05);
            color: #000000;
            border-left: 4px solid #10b981;
        }

        .sidebar-menu i {
            margin-right: 0.75rem;
            width: 1.5rem;
            text-align: center;
            color: #1f1f1f;
        }

        @media (max-width: 768px) {
            .sidebar {
                left: -16rem;
            }

            .sidebar.active {
                left: 0;
            }

            .header,
            .main-content {
                left: 0;
                margin-left: 0;
            }

            .sidebar.active~.header,
            .sidebar.active~.main-content {
                left: 16rem;
                margin-left: 16rem;
            }
        }

        /* Scrollbar nhỏ và màu đồng bộ với sidebar */
        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: #d2b48c;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background-color: rgba(44, 44, 44, 0.3);
            border-radius: 3px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background-color: rgba(44, 44, 44, 0.5);
        }
    </style>
</head>
