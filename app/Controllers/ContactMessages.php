<?php

namespace App\Controllers;

use CodeIgniter\HTTP\ResponseInterface;

/**
 * Semua fitur pesan kontak dalam satu file:
 * - tabel `messages` dibuat otomatis (tanpa migrasi)
 * - send()   : menerima pesan dari form kontak (publik)
 * - index()  : halaman admin pesan masuk
 * - action() : tandai dibaca / hapus
 */
class ContactMessages extends BaseController
{
    private const PER_PAGE = 10;

    // ===================== PUBLIK =====================

    public function send(): ResponseInterface
    {
        if (! $this->request->isAJAX()) {
            return redirect()->to(base_url('pages/contact'));
        }

        // Honeypot: bot mengisi kolom tersembunyi, pura-pura sukses
        if ($this->request->getPost('website')) {
            return $this->json(['status' => 'ok', 'message' => 'Pesan Anda berhasil dikirim!']);
        }

        // Maksimal 3 pesan per menit per IP
        if (service('throttler')->check(md5($this->request->getIPAddress()), 3, MINUTE) === false) {
            return $this->json(['status' => 'error', 'message' => 'Terlalu banyak percobaan. Coba lagi sebentar lagi.'], 429);
        }

        $rules = [
            'nama'  => 'required|min_length[2]|max_length[80]',
            'email' => 'required|valid_email|max_length[120]',
            'pesan' => 'required|min_length[10]|max_length[1000]',
        ];
        $errors = [
            'nama'  => ['required' => 'Nama wajib diisi.', 'min_length' => 'Nama minimal 2 karakter.', 'max_length' => 'Nama maksimal 80 karakter.'],
            'email' => ['required' => 'Email wajib diisi.', 'valid_email' => 'Masukkan alamat email yang valid.', 'max_length' => 'Email maksimal 120 karakter.'],
            'pesan' => ['required' => 'Pesan wajib diisi.', 'min_length' => 'Pesan minimal 10 karakter.', 'max_length' => 'Pesan maksimal 1000 karakter.'],
        ];

        if (! $this->validate($rules, $errors)) {
            return $this->json(['status' => 'error', 'message' => array_values($this->validator->getErrors())[0] ?? 'Data tidak valid.'], 422);
        }

        $this->ensureTable();
        $now = date('Y-m-d H:i:s');
        db_connect()->table('messages')->insert([
            'nama'       => trim((string) $this->request->getPost('nama')),
            'email'      => trim((string) $this->request->getPost('email')),
            'pesan'      => trim((string) $this->request->getPost('pesan')),
            'is_read'    => 0,
            'ip_address' => $this->request->getIPAddress(),
            'user_agent' => mb_substr((string) $this->request->getUserAgent(), 0, 255),
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        return $this->json(['status' => 'ok', 'message' => 'Pesan Anda berhasil dikirim!']);
    }

    // ===================== ADMIN (pasang filter login di route) =====================

    public function index(): string
    {
        $this->ensureTable();
        $db    = db_connect();
        $page  = max(1, (int) $this->request->getGet('page'));
        $total = $db->table('messages')->countAllResults();
        $pages = max(1, (int) ceil($total / self::PER_PAGE));
        $page  = min($page, $pages);
        $unread = $db->table('messages')->where('is_read', 0)->countAllResults();

        $rows = $db->table('messages')->orderBy('id', 'DESC')
            ->limit(self::PER_PAGE, ($page - 1) * self::PER_PAGE)->get()->getResultArray();

        return $this->renderInbox($rows, $unread, $page, $pages);
    }

    public function action(string $do, int $id)
    {
        $builder = db_connect()->table('messages')->where('id', $id);

        if ($do === 'read') {
            $builder->update(['is_read' => 1, 'updated_at' => date('Y-m-d H:i:s')]);
        } elseif ($do === 'delete') {
            $builder->delete();
            session()->setFlashdata('msg', 'Pesan berhasil dihapus.');
        }

        return redirect()->back();
    }

    // ===================== INTERNAL =====================

    private function json(array $data, int $status = 200): ResponseInterface
    {
        // Token CSRF CodeIgniter berganti tiap request, kirim yang terbaru
        $data['csrfName'] = csrf_token();
        $data['csrfHash'] = csrf_hash();

        return $this->response->setStatusCode($status)->setJSON($data);
    }

    private function ensureTable(): void
    {
        $db = db_connect();
        if ($db->tableExists('messages')) {
            return;
        }

        $db->query("CREATE TABLE IF NOT EXISTS `{$db->prefixTable('messages')}` (
            `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
            `nama` VARCHAR(80) NOT NULL,
            `email` VARCHAR(120) NOT NULL,
            `pesan` TEXT NOT NULL,
            `is_read` TINYINT(1) NOT NULL DEFAULT 0,
            `ip_address` VARCHAR(45) NULL,
            `user_agent` VARCHAR(255) NULL,
            `created_at` DATETIME NULL,
            `updated_at` DATETIME NULL,
            PRIMARY KEY (`id`),
            KEY `is_read` (`is_read`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");
    }

    private function renderInbox(array $rows, int $unread, int $page, int $pages): string
    {
        $bulan = ['Jan' => 'Jan', 'Feb' => 'Feb', 'Mar' => 'Mar', 'Apr' => 'Apr', 'May' => 'Mei', 'Jun' => 'Jun', 'Jul' => 'Jul', 'Aug' => 'Agu', 'Sep' => 'Sep', 'Oct' => 'Okt', 'Nov' => 'Nov', 'Dec' => 'Des'];
        $tgl   = static fn($t) => date('d', strtotime($t)) . ' ' . ($bulan[date('M', strtotime($t))] ?? date('M', strtotime($t))) . ' ' . date('Y, H:i', strtotime($t));
        $warna = ['bg-indigo-500', 'bg-sky-500', 'bg-emerald-500', 'bg-amber-500', 'bg-rose-500', 'bg-violet-500', 'bg-teal-500'];
        $csrf  = csrf_field();
        $flash = session()->getFlashdata('msg');

        $cards = '';
        foreach ($rows as $m) {
            $baru     = (int) $m['is_read'] === 0;
            $inisial  = esc(mb_strtoupper(mb_substr($m['nama'], 0, 1)) ?: '?');
            $bg       = $warna[crc32($m['nama']) % count($warna)];
            $border   = $baru ? 'border-indigo-200 shadow-md' : 'border-slate-100 shadow-sm';
            $badge    = $baru ? '<span class="px-2 py-0.5 text-[10px] font-bold uppercase rounded-full bg-indigo-600 text-white">Baru</span>' : '';
            $mail     = esc($m['email'], 'attr');
            $id       = (int) $m['id'];
            $btnRead  = $baru ? "<form action=\"" . base_url("admin/messages/read/{$id}") . "\" method=\"post\">{$csrf}<button class=\"px-3.5 py-1.5 text-xs font-semibold rounded-lg bg-emerald-50 text-emerald-700 hover:bg-emerald-100\">Tandai dibaca</button></form>" : '';

            $cards .= '<article class="bg-white rounded-2xl border ' . $border . ' p-5 sm:p-6"><div class="flex items-start gap-4">'
                . '<span class="w-11 h-11 shrink-0 rounded-full flex items-center justify-center text-sm font-bold text-white ' . $bg . '">' . $inisial . '</span>'
                . '<div class="min-w-0 flex-1">'
                . '<div class="flex flex-wrap items-center gap-x-3 gap-y-1"><h3 class="font-bold text-slate-900">' . esc($m['nama']) . '</h3>' . $badge
                . '<span class="text-xs text-slate-400">' . esc($tgl($m['created_at'])) . '</span></div>'
                . '<a href="mailto:' . $mail . '" class="text-sm text-indigo-600 hover:underline break-all">' . esc($m['email']) . '</a>'
                . '<p class="mt-3 text-sm text-slate-700 leading-relaxed whitespace-pre-line break-words">' . esc($m['pesan']) . '</p>'
                . '<div class="mt-4 flex flex-wrap items-center gap-2">'
                . '<a href="mailto:' . $mail . '?subject=' . rawurlencode('Re: Pesan dari website') . '" class="px-3.5 py-1.5 text-xs font-semibold rounded-lg bg-indigo-50 text-indigo-700 hover:bg-indigo-100">Balas via Email</a>'
                . $btnRead
                . '<form action="' . base_url("admin/messages/delete/{$id}") . '" method="post" onsubmit="return confirm(\'Hapus pesan ini?\');">' . $csrf
                . '<button class="px-3.5 py-1.5 text-xs font-semibold rounded-lg bg-rose-50 text-rose-700 hover:bg-rose-100">Hapus</button></form>'
                . '</div></div></div></article>';
        }

        if ($cards === '') {
            $cards = '<div class="bg-white rounded-3xl border border-slate-100 py-16 text-center text-sm text-slate-400">Belum ada pesan masuk.</div>';
        }

        $nav = '';
        if ($pages > 1) {
            for ($i = 1; $i <= $pages; $i++) {
                $cls  = $i === $page ? 'bg-indigo-600 text-white' : 'bg-white text-slate-600 hover:bg-slate-100 border border-slate-200';
                $nav .= '<a href="?page=' . $i . '" class="w-9 h-9 flex items-center justify-center rounded-lg text-xs font-semibold ' . $cls . '">' . $i . '</a>';
            }
            $nav = '<div class="flex justify-center gap-2 flex-wrap">' . $nav . '</div>';
        }

        $alert = $flash ? '<div class="px-4 py-3 text-sm text-emerald-700 bg-emerald-50 border border-emerald-200 rounded-2xl">' . esc($flash) . '</div>' : '';
        $dot   = $unread > 0 ? 'bg-amber-300' : 'bg-emerald-300';

        return '<!DOCTYPE html><html lang="id"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">'
            . '<title>Pesan Masuk | Albu Project</title><meta name="robots" content="noindex">'
            . '<script src="https://cdn.tailwindcss.com"></script></head>'
            . '<body class="bg-slate-100 text-slate-700 antialiased"><div class="max-w-3xl mx-auto px-4 py-8 space-y-6">'
            . '<a href="' . base_url('dashboard') . '" class="inline-flex items-center gap-1.5 text-xs font-semibold text-indigo-600 hover:underline">&larr; Kembali ke Dashboard</a>'
            . '<div class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-indigo-600 via-blue-600 to-sky-500 px-6 sm:px-10 py-8 text-white shadow-xl">'
            . '<div class="flex flex-wrap items-center justify-between gap-4"><div><h1 class="text-2xl sm:text-3xl font-extrabold">Pesan Masuk</h1>'
            . '<p class="mt-1 text-sm text-white/90">Pesan dari form kontak di website kamu.</p></div>'
            . '<span class="inline-flex items-center gap-2 px-4 py-2 text-xs font-semibold rounded-full bg-white/15 ring-1 ring-inset ring-white/30"><span class="w-2 h-2 rounded-full ' . $dot . '"></span>' . $unread . ' belum dibaca</span></div></div>'
            . $alert . '<div class="space-y-4">' . $cards . '</div>' . $nav
            . '</div></body></html>';
    }
}
