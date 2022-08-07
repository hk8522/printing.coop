<?php
                                if (count($lists) > 0) {
                                    foreach ($lists as $key => $list) {
                                    ?>
                                        <tr id="row-<?= $list['id'] ?>">
                                            <td>
                                             <?= ucfirst($list['order_id']) ?>
                                            </td>
                                            <td>
                                              <?= ucwords($list['name']) ?>
                                             </td>
                                             <td><?= CURREBCY_SYMBOL.number_format($list['total_amount'],2) ?></td>
                                            <td><?= ucfirst($list['total_items']) ?></td>
                                            <td>
                                              <?= dateFormate($list['created']) ?>
                                            </td>
                                        </tr>
                                <?php
                                    }
                                } else{?>
                                    <tr>
                                    <td colspan="5" class="text-center">List Empty.</td>
                                    </tr>
                                <?php
                               } ?>
