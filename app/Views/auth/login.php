<!DOCTYPE html>
<html lang="id" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk | Albu Project</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="h-full bg-white antialiased font-['Raleway',sans-serif]">
    <div class="min-h-full flex items-center justify-center lg:p-10">

        <!-- Kartu Utama -->
        <div class="relative w-full min-h-screen lg:min-h-0 lg:h-[34rem] lg:max-w-5xl bg-white lg:rounded-3xl overflow-hidden flex flex-col lg:flex-row shadow-2xl lg:border lg:border-slate-100">

            <!-- Sudut Biru Kanan Atas (Desktop) -->
            <div class="hidden lg:block absolute top-0 right-0 w-48 h-48 bg-gradient-to-br from-blue-500 via-blue-600 to-blue-700 rounded-bl-[100%] pointer-events-none"></div>

            <!-- Sudut Biru Kiri Bawah (Mobile) -->
            <div class="lg:hidden absolute bottom-0 left-0 w-24 h-24 bg-gradient-to-br from-blue-500 via-blue-600 to-blue-700 rounded-tr-[100%] pointer-events-none"></div>

            <!-- Panel Biru: Brand (Di Mobile jadi Header) -->
            <div class="bg-gradient-to-br from-blue-500 via-blue-600 to-blue-700 [border-radius:0_0_50%_50%/0_0_40%_40%] lg:[border-radius:0_50%_50%_0/0_50%_50%_0] text-white relative z-10 lg:w-[54%] shrink-0 flex flex-col items-center justify-center text-center px-8 pt-12 pb-16 lg:py-12 shadow-lg lg:shadow-none">

                <!-- Logo Circle -->
                <div class="w-16 h-16 rounded-full bg-white flex items-center justify-center shadow-lg">
                    <span class="text-3xl font-black text-blue-600">A</span>
                </div>
                <p class="mt-3 text-lg font-bold tracking-wide">Albu Project</p>

                <!-- Konten Khusus Desktop -->
                <div class="hidden lg:block mt-8">
                    <h2 class="text-4xl font-extrabold tracking-tight">Selamat Datang!</h2>
                    <p class="mt-3 text-sm text-blue-100 leading-relaxed max-w-xs mx-auto">
                        Tetap terhubung dengan kami,<br>silakan masuk dengan akun Anda.
                    </p>
                    <a href="#username"
                        class="mt-8 inline-block w-64 py-2.5 text-xs font-bold tracking-widest uppercase border-2 border-white rounded-full hover:bg-white hover:text-blue-600 transition duration-300 focus:outline-none focus-visible:ring-2 focus-visible:ring-white">
                        MASUK
                    </a>
                </div>

                <p class="hidden lg:block absolute bottom-6 text-xs text-blue-200">&copy; <?= date('Y'); ?> Albu Project</p>
            </div>

            <!-- Panel Form Login -->
            <div class="relative z-10 flex-1 flex items-center justify-center px-8 pb-16 pt-8 lg:py-12 lg:pr-16 lg:pl-8">
                <div class="w-full max-w-sm text-center">

                    <h1 class="text-3xl lg:text-4xl font-extrabold text-blue-900 tracking-tight">Selamat Datang</h1>
                    <p class="mt-1 text-xs text-slate-500">Masuk ke akun Anda untuk melanjutkan</p>

                    <!-- Alert Flashdata -->
                    <?php if (session()->getFlashdata('msg')) : ?>
                        <div class="mt-4 flex items-start gap-2 px-4 py-3 text-xs text-left text-rose-700 bg-rose-50 border border-rose-200 rounded-2xl" role="alert">
                            <svg class="w-4 h-4 shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v4m0 4h.01M10.3 3.9L2.4 18a2 2 0 001.7 3h15.8a2 2 0 001.7-3L13.7 3.9a2 2 0 0-3.4 0z" />
                            </svg>
                            <span><?= esc(session()->getFlashdata('msg')) ?></span>
                        </div>
                    <?php endif; ?>

                    <!-- Form -->
                    <form action="/loginProcess" method="post" class="mt-6 space-y-4">
                        <?= csrf_field() ?>
                        <?php $input = 'w-full py-3 text-xs text-center font-medium text-slate-700 placeholder-slate-400 bg-blue-100/60 border border-transparent rounded-full focus:outline-none focus:bg-white focus:border-blue-600 focus:ring-2 focus:ring-blue-600/30 transition duration-200'; ?>

                        <div>
                            <label for="username" class="sr-only">Username / Email</label>
                            <input type="text" name="username" id="username" required autofocus
                                value="<?= esc(old('username')); ?>"
                                class="<?= $input; ?> px-5" placeholder="Username / Email">
                        </div>

                        <div>
                            <label for="password" class="sr-only">Password</label>
                            <div class="relative">
                                <input type="password" name="password" id="password" required
                                    class="<?= $input; ?> pl-10 pr-10" placeholder="Password">

                                <button type="button" id="togglePassword" aria-label="Tampilkan password"
                                    class="absolute inset-y-0 right-0 pr-4 flex items-center text-slate-400 hover:text-blue-600 focus:outline-none">
                                    <svg id="eyeIcon" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    <svg id="eyeOffIcon" class="w-4 h-4 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858-5.908a8.959 8.959 0 013.682-.813c4.478 0 8.268 2.943 9.542 7a9.97 9.97 0 01-4.168 5.488M9.88 9.88a3 3 0 104.243 4.243M9.88 9.88L3 3m18 18l-6.88-6.88" />
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <div>
                            <a href="#" class="text-xs text-slate-500 hover:text-blue-600 hover:underline">Lupa password?</a>
                        </div>

                        <div class="pt-2">
                            <button type="submit"
                                class="w-36 py-2.5 text-xs bg-blue-600 hover:bg-blue-700 text-white font-bold tracking-wider rounded-full shadow-md hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-offset-2 transition duration-200 uppercase">
                                MASUK
                            </button>
                        </div>

                        <p class="pt-2 text-xs text-slate-500">
                            Belum punya akun?
                            <a href="/register" class="font-bold text-blue-600 hover:underline">Daftar</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        const togglePassword = document.getElementById('togglePassword');
        const password = document.getElementById('password');
        const eyeIcon = document.getElementById('eyeIcon');
        const eyeOffIcon = document.getElementById('eyeOffIcon');

        togglePassword.addEventListener('click', function() {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            eyeIcon.classList.toggle('hidden');
            eyeOffIcon.classList.toggle('hidden');
        });
    </script>
</body>

</html>