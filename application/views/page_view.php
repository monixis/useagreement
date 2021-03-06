
<table class="table table-striped table-bordered">
    <thead>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Attachments(if any)</th>
        <th>Status</th>
        <th>Date</th>
    </tr>
    </thead>
    <tbody>
    <?php $offset = $this->uri->segment(3, 0) + 1; ?>
    <?php foreach ($query->result() as $row): ?>
        <tr>
            <td><a target="_blank" href="<?php echo base_url("?c=usragr&m=reviewRequest&userId=").$row ->userId?>"><?php echo $row ->userId ?></a></td>
            <td><?php echo $row->userName; ?></td>
            <td><?php echo $row->attachment ?></td>
            <td><?php if($row->status == 1){ ?>
                    Returned
                <?php } else if($row->status == 2){ ?>

                    Submitted
                <?php } else if($row->status == 3){ ?>
                    Approved
                <?php } else if($row->status == 0){ ?>
                    Initiated

                <?php } else if($row->status == 4) {?>
                    Completed
                <?php } ?>
            </td>
            <td><?php echo $row->date; ?></td>

        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<div align="right" id="NumRecords">
    <label class="label" for="collection">Total:<?php echo $total_rows?></label>
</div>
<nav class='text-center'>
    <?php echo $pagination_links; ?>

</nav>
