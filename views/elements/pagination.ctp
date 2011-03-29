<table class="paging clearfix">
    <tbody>
        <tr>
            <td class="prev">
                <?php
                    if (!$first = $this->Paginator->first('&#8592; First', array('escape' => false))) {
                        $first = $this->Html->tag('span', '&#8592; First', array('class' => 'disabled'));
                    }
                    echo $first . '&nbsp;&nbsp;&nbsp;';
                    echo $this->Paginator->prev(
                        '&lsaquo;', array('escape' => false), null, array('class' => 'disabled', 'escape' => false)
                    );
                ?>
            </td>
            <td class="numbers">
                <?php echo $this->Paginator->numbers(array('separator' => '&nbsp;&nbsp;&nbsp;')); ?>
            </td>
            <td class="next">
                <?php
                    echo $this->Paginator->next(
                        '&rsaquo;', array('escape' => false), null, array('class' => 'disabled', 'escape' => false)
                    );
                    if (!$last = $this->Paginator->last('Last &#8594;', array('escape' => false))) {
                        $last = $this->Html->tag('span', 'Last &#8594;', array('class' => 'disabled'));
                    }
                    echo '&nbsp;&nbsp;&nbsp;' . $last;
                ?>
            </td>
        </tr>
    </tbody>
</table>
