<div>
    <style>
        /* Reset default margin dan padding */
        body, html {
            margin: 0;
            padding: 0;
            height: 100%;
            width: 100%;
            overflow-x: hidden;
        }

        /* Container untuk background */
        .login-container {
            min-height: 100vh;
            width: 100vw;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 20px;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Pastikan container konten mengambil full width */
        .container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
        }

        .login-card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            transform: translateY(0);
            transition: all 0.3s ease;
            width: 100%;
            max-width: 500px;
            margin: auto;
        }

        .login-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
        }

        .login-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 30px 20px;
            margin-bottom: 30px;
            border-bottom: 5px solid rgba(255, 255, 255, 0.2);
        }

        .login-title {
            color: white;
            font-size: 28px;
            font-weight: 600;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
            margin: 0;
        }

        .login-subtitle {
            color: rgba(255, 255, 255, 0.9);
            font-size: 16px;
            margin-top: 5px;
            margin-bottom: 0;
        }

        .form-floating {
            margin-bottom: 20px;
        }

        .form-floating input {
            border-radius: 10px;
            border: 2px solid #e1e1e1;
            padding: 15px;
            height: 55px;
            transition: all 0.3s ease;
            font-size: 16px;
        }

        .form-floating input:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.25rem rgba(102, 126, 234, 0.25);
        }

        .form-floating label {
            padding: 15px;
            color: #666;
        }

        .login-btn {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 10px;
            padding: 15px;
            font-size: 18px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            width: 100%;
        }

        .login-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }

        .login-btn:active {
            transform: translateY(0);
        }

        .alert {
            border-radius: 10px;
            border: none;
            padding: 15px;
            margin-bottom: 20px;
            position: relative;
            animation: slideIn 0.3s ease-out;
        }

        @keyframes slideIn {
            from {
                transform: translateY(-20px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .alert-danger {
            background: linear-gradient(135deg, #ff9a9e 0%, #fad0c4 100%);
            color: #721c24;
        }

        .alert-success {
            background: linear-gradient(135deg, #84fab0 0%, #8fd3f4 100%);
            color: #155724;
        }

        /* Responsivitas untuk layar kecil */
        @media (max-width: 768px) {
            .login-container {
                padding: 10px;
            }

            .login-card {
                margin: 10px;
            }
        }
    </style>

    <div class="login-container">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="login-card">
                        <div class="login-header text-center">
                            <h4 class="login-title">PPDB SMK GAMA</h4>
                            <p class="login-subtitle">Sistem Informasi Penerimaan Peserta Didik Baru</p>
                        </div>

                        <div class="card-body px-4 py-4">
                            @if (session()->has('error'))
                                <div class="alert alert-danger d-flex align-items-center" role="alert">
                                    <ion-icon name="alert-circle" class="me-2" style="font-size: 1.5rem;"></ion-icon>
                                    <div>{{ session('error') }}</div>
                                </div>
                            @endif

                            @if (session()->has('success'))
                                <div class="alert alert-success d-flex align-items-center" role="alert">
                                    <ion-icon name="checkmark-circle" class="me-2" style="font-size: 1.5rem;"></ion-icon>
                                    <div>{{ session('success') }}</div>
                                </div>
                            @endif

                            <form wire:submit="login">
                                <div class="form-floating mb-4">
                                    <input type="email" 
                                           class="form-control @error('email') is-invalid @enderror" 
                                           wire:model.lazy="email" 
                                           id="email" 
                                           placeholder="name@example.com">
                                    <label for="email">
                                        <ion-icon name="mail" class="me-2"></ion-icon>
                                        Email Address
                                    </label>
                                    @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-floating mb-4">
                                    <input type="password" 
                                           class="form-control @error('password') is-invalid @enderror" 
                                           wire:model.lazy="password" 
                                           id="password" 
                                           placeholder="Password">
                                    <label for="password">
                                        <ion-icon name="lock-closed" class="me-2"></ion-icon>
                                        Password
                                    </label>
                                    @error('password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="d-grid">
                                    <button type="submit" class="btn login-btn text-white">
                                        <ion-icon name="log-in" class="me-2"></ion-icon>
                                        Masuk
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>