<?php

foreach ($list as $row) {
    ?>
    <tr>
        <td><input type="checkbox" name="idx[]" class="idx" value="'<?= $row['p_idx'] ?>'"></td>
        <td>
            <?= $row['product_name'] ?>
        </td>
        <td>
            <?= $row['product_idx'] ?>
        </td>
    </tr>
    <?php
}