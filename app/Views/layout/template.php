<!DOCTYPE html>
<html lang="id" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title><?= esc($title ?? 'Albu Project'); ?> | Albu Project</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="h-full bg-slate-100 text-slate-800 antialiased">
    <div class="flex h-full">

        <?= $this->include('layout/sidebar') ?>

        <div class="flex-1 flex flex-col min-w-0 lg:ml-64">

            <?= $this->include('layout/navbar') ?>

            <!-- Main content view -->
            <main class="flex-1 p-4 sm:p-10 pb-36 lg:pb-10">
                <?= $this->renderSection('content'); ?>
            </main>

            <!-- Footer -->
            <footer class="px-4 sm:px-10 pt-4 pb-28 lg:pb-4 text-xs text-slate-400 text-center border-t border-slate-200 bg-white">
                &copy; <?= date('Y'); ?> Albu Project. All rights reserved.
            </footer>
        </div>
    </div>

    <?= $this->include('layout/bottomnav') ?>

</body>

</html>