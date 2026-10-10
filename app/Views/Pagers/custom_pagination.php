<?php $pager->setSurroundCount(2); ?>

<div class="flex flex-col sm:flex-row items-center justify-between gap-4 px-4 py-3 bg-white border-t border-gray-100">
    <nav class="flex items-center justify-center w-full" aria-label="Pagination">
        <ul class="inline-flex items-center gap-1.5 text-sm font-medium">

            <?php if ($pager->hasPreviousPage()) : ?>
                <li>
                    <a href="<?= $pager->getFirst() ?>"
                        title="Halaman Pertama"
                        class="inline-flex items-center justify-center w-9 h-9 text-gray-500 bg-gray-50 border border-gray-200 rounded-lg hover:bg-gray-100 hover:text-blue-600 transition-colors duration-150 shadow-xs">
                        <span class="text-base">&laquo;</span>
                    </a>
                </li>
                <li>
                    <a href="<?= $pager->getPreviousPage() ?>"
                        title="Halaman Sebelumnya"
                        class="inline-flex items-center justify-center w-9 h-9 text-gray-500 bg-gray-50 border border-gray-200 rounded-lg hover:bg-gray-100 hover:text-blue-600 transition-colors duration-150 shadow-xs">
                        <span class="text-base">&lsaquo;</span>
                    </a>
                </li>
            <?php endif ?>

            <?php foreach ($pager->links() as $link) : ?>
                <li>
                    <a href="<?= $link['uri'] ?>"
                        class="inline-flex items-center justify-center min-w-[36px] h-9 px-3.5 rounded-lg text-sm font-semibold transition-all duration-150 <?= $link['active'] ? 'bg-blue-600 text-white shadow-md shadow-blue-500/20 scale-105' : 'bg-white text-gray-700 border border-gray-200 hover:bg-gray-50 hover:text-blue-600 hover:border-gray-300 shadow-xs' ?>">
                        <?= $link['title'] ?>
                    </a>
                </li>
            <?php endforeach ?>

            <?php if ($pager->hasNextPage()) : ?>
                <li>
                    <a href="<?= $pager->getNextPage() ?>"
                        title="Halaman Selanjutnya"
                        class="inline-flex items-center justify-center w-9 h-9 text-gray-500 bg-gray-50 border border-gray-200 rounded-lg hover:bg-gray-100 hover:text-blue-600 transition-colors duration-150 shadow-xs">
                        <span class="text-base">&rsaquo;</span>
                    </a>
                </li>
                <li>
                    <a href="<?= $pager->getLast() ?>"
                        title="Halaman Terakhir"
                        class="inline-flex items-center justify-center w-9 h-9 text-gray-500 bg-gray-50 border border-gray-200 rounded-lg hover:bg-gray-100 hover:text-blue-600 transition-colors duration-150 shadow-xs">
                        <span class="text-base">&raquo;</span>
                    </a>
                </li>
            <?php endif ?>

        </ul>
    </nav>
</div>