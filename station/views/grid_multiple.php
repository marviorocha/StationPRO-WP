<h1>Advanced usage</h1>
<p>
    This example demonstrates more advanced features, like how to place multiple grids on one page (with ajax history tracking of course),
    and how to implement interactions between grids.
</p>

<h2>Grid interaction</h2>
<p>
    By default Carbogrid renders a separate html form for each grid. But if you want to implement interaction between grids,
    or post grid values with an external custom submit button (e.g. access selected values of the grid), you have to create the form manually,
    render the grids and other content you want between the form tags and set the <i>'nested'</i> option of the grids to <b>FALSE</b>.
</p>
<p>
    The below example demonstrates this behaviour. The left grid filters the <i>`user`</i> table for inactive users (<i>`active`</i> = FALSE),
    the right grid filters the <i>`user`</i> table for active users (<i>`active`</i> = TRUE). The 'Activate' button sets the <i>`active`</i>
    field TRUE for all selected users in the left grid, and the 'Unactivate' button sets the <i>`active`</i>
    field FALSE for all selected users in the right grid.
</p>
<p>
    For both grids add/edit/delete, filtering, changing page size and show/hide columns is disabled, and the left grid has an initial ordering
    on the <i>`username`</i> column.
</p>

<?php echo form_open(); ?>

<table width="100%">
    <tr>
        <td style="vertical-align:top;"><?php echo $grid1; ?></td>
        <td style="text-align:center;">
            <input style="width:100px;" type="submit" name="activate" value="Activate &gt;" /><br/>
            <input style="width:100px;" type="submit" name="unactivate" value="&lt; Unactivate" />
        </td>
        <td style="vertical-align:top;"><?php echo $grid2; ?></td>
    </tr>
</table>
<?php echo form_close(); ?>

<h2>Grid for the<i>`city`</i> table</h2>

<p>
    Delete is disabled, edit is allowed for everyone.
    On the form City name is validated for a min length of 3 and a max length of 50 characters, and the name must be unique.
</p>

<?php echo $grid4; ?>

<h2>Grid with no ajax history</h2>

<p>
    This grid has ajax history disabled, and has an initial filter on the <i>`username`</i> column.
</p>

<?php echo $grid3; ?>
