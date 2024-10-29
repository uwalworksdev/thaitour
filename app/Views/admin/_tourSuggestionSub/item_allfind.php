<?php foreach ($list as $row) { ?>
    <tr>
        <?php if ($row['cnt'] > 0) { ?>
            <td></td>
        <?php } else { ?>
            <td><input type="checkbox" name="idx[]" class="idx" value="<?= $row['product_idx'] ?>"></td>
        <?php } ?>
        <td><?= viewSQ($row['product_name']) ?></td>
        <td><?= $row['product_code'] ?></td>
    </tr>
<?php } ?>