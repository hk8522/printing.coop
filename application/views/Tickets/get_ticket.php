                                <table id="example1">
                                    <thead>
                                        <tr>
                                            <th width="5%">Ticket No.</th>
                                            <th width="20%">Subject</th>
                                            <th width="30%">Message</th>
                                            <th width="10%">Created On</th>
                                            <th width="10%">Updated On</th>
                                            <th width="5%">Status</th>
                                            <th width="20%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                if (count($lists) >0) {
                                    foreach ($lists as $list) {
                                ?>

                                        <tr>
                                            <td>
                                                <?= "#".$list['id'] ?>
                                            </td>
                                            <td>
                                                <?= $list['subject'] ?>
                                            </td>
                                            <td>
                                                <?= $list['message'] ?>
                                            </td>

                                            <td>
                                                <?= dateFormate($list['created']) ?>
                                            </td>
                                            <td>
                                                <?= dateFormate($list['updated']) ?>
                                            </td>
                                            <td>

                                                <?php if ($list['status']==1) { ?>

                                                <button type="submit" class="custon-active btn-success">Resolved
                                                </button>

                                                <?php
                                                } else{?>
                                                <button type="submit"
                                                    class="custon-delete btn-danger">Unresolved</button>
                                                <?php } ?>
                                            </td>
                                            <td>

                                                <div class="action-btns">
                                                    <?php if ($list['status']==0) { ?>
                                                    <a href="javascript:void(0)" class="comments-counts"
                                                        style="color:green; padding: 5px;" title="Message"
                                                        onclick="getChats('<?= base64_encode($list['id']) ?>')">
                                                        <i class="fa fas fa-comment-dots fa-lg"></i>
                                                        <span>
                                                            <?php
            echo $this->Ticket_Model->getMessageCount($list['id']);
                                                    ?>
                                                        </span>
                                                    </a>
                                                    <?php } ?>
                                                    <a href="<?= $BASE_URL ?>/Tickets/deleteTicket/<?= base64_encode($list['id']) ?>"
                                                        style="color:#d71b23; padding: 5px;" title="delete"
                                                        onclick="return confirm('Are you sure you want to delete this ticket?');">
                                                        <i class="fa fa-trash fa-lg"></i>
                                                    </a>
                                                </div>

                                            </td>
                                        </tr>
                                        <?php
                                }
                                } else{?>
                                        <tr>
                                            <td colspan="6">Ticket list empty</td>
                                        </tr>
                                        <?php
                               } ?>
                                    </tbody>
                                </table>