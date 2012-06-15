<div id="header">
    <div class="container_12">
        <div class="grid_12">
            <?php $this->load->view('grid_logo'); ?>
            <div id="slogan">
                Light as a Feather.<br/> Solid as Steel.
            </div>
        </div>
        <div class="clear"></div>
    </div>
</div>

<div id="menu">
    <div class="container_12">
        <div class="grid_12">
            <ul>
                <li><?php echo anchor('sample/home', 'Home', preg_match('/(^\/sample\/home)|(^$)/i', $this->uri->uri_string()) ? 'class="active"' : ''); ?></li>
                <li><?php echo anchor('sample/single', 'Single grid', preg_match('/(^\/sample\/single)/i', $this->uri->uri_string()) ? 'class="active"' : ''); ?></li>
                <li><?php echo anchor('sample/multiple', 'Multiple grids', preg_match('/(^\/sample\/multiple)/i', $this->uri->uri_string()) ? 'class="active"' : ''); ?></li>
                <li><?php echo anchor('http://code.google.com/p/carbogrid/wiki/Documentation', 'Documentation', preg_match('/(^\/sample\/docs)/i', $this->uri->uri_string()) ? 'class="active"' : ''); ?></li>
            </ul>
        </div>
        <div class="clear"></div>
    </div>
</div>
