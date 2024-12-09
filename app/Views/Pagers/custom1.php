<?php

use CodeIgniter\Pager\PagerRenderer;

/**
 * @var PagerRenderer $pager
 */

$totalPages = $pager->getPageCount();
$currentPage = $pager->getCurrentPageNumber();

$surroundCount = 2;

$maxLinks = 5;

if ($totalPages <= $maxLinks) {
    $start = 1;
    $end = $totalPages;
} elseif ($currentPage <= $surroundCount) {
    $start = 1;
    $end = min($totalPages, $maxLinks);
} elseif ($currentPage + $surroundCount > $totalPages) {
    $start = max(1, $totalPages - $maxLinks + 1);
    $end = $totalPages;
} else {
    $start = $currentPage - $surroundCount;
    $end = $currentPage + $surroundCount;
}
?>

<div class='pagination_'>
    <div class="customer-center-page">
        <div class="pagination">
            <a class='page-link' href="<?= $pager->hasPreviousPage() ? $pager->getFirst() : 'javascript:void(0);' ?>"
                aria-label="<?= lang('Pager.first') ?>"><img src='/images/community/pagination_prev.png' alt='pagination_prev'>
            </a>
            <a class='page-link' href="<?= $pager->hasPreviousPage() ? $pager->getPreviousPage() : 'javascript:void(0)' ?>"
                aria-label="<?= lang('Pager.previous') ?>"> 
                <img src="/images/community/pagination_prev_s.png" alt="pagination_prev">
            </a>
            <?php for ($i = $start; $i <= $end; $i++): ?>
                <a class='page-link <?= $i === $currentPage ? 'active' : '' ?>' href="<?=$pager->links()[$i-1]['uri']?>">
                    <?= $i ?>
                </a>
            <?php endfor ?>
            <?php
            if (!count($pager->links())):
                ?>
                    <a class='page-link' href="javascript:void(0);">1</a>
            <?php endif ?>
            <a class='page-link' href="<?= $pager->hasNextPage() ? $pager->getNextPage() : 'javascript:void(0);' ?>"
                aria-label="<?= lang('Pager.next') ?>"><img src='/images/community/pagination_next_s.png' alt='pagination_next'>
            </a>
            <a class='page-link' href="<?= $pager->hasNextPage() ? $pager->getLast() : 'javascript:void(0);' ?>"
                aria-label="<?= lang('Pager.last') ?>">
                <img src='/images/community/pagination_next.png' alt='pagination_next'>
            </a>
        </div>
    </div>
</div>