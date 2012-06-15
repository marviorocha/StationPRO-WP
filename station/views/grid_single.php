<h1>Basic usage</h1>
<p>
    This example is a simple use case of Carbogrid.
</p>
<p>
    It selects the entries from the <i>`user`</i> table, and joins the <i>`city`</i> table to display the city name.
    The delete and edit actions are filtered by IP address (you can edit and delete only those rows which have the IP address of your machine).
</p>

<?php if (isset($page_grid)) echo $page_grid; ?>
