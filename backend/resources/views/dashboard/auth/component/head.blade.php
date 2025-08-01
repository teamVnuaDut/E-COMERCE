<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>@yield('title', 'E-Commerce Dashboard')</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
<style>
    body {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .auth-card {
        background: white;
        border-radius: 20px;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        max-width: 400px;
        width: 100%;
    }
    .auth-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 2rem;
        text-align: center;
    }
    .auth-body {
        padding: 2rem;
    }
    .form-control {
        border-radius: 10px;
        border: 2px solid #e9ecef;
        padding: 12px 15px;
        transition: all 0.3s ease;
    }
    .form-control:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
    }
    .btn-auth {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        border-radius: 10px;
        padding: 12px;
        font-weight: 600;
        transition: all 0.3s ease;
    }
    .btn-auth:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
    }
    .input-group-text {
        background: transparent;
        border: 2px solid #e9ecef;
        border-right: none;
    }
    .input-group .form-control {
        border-left: none;
    }
    .alert {
        border-radius: 10px;
        border: none;
    }
    .password-toggle {
        border: 2px solid #e9ecef;
        border-left: none;
        background: transparent;
    }
    .password-toggle:hover {
        background: #f8f9fa;
    }
</style> 