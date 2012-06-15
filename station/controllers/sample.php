<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Sample extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

        //$this->output->enable_profiler(TRUE);
    }

    function home()
    {
        $data->page = 'grid_home';
        $this->load->view('container', $data);
    }

    //function index($limit = 10, $offset = 0, $cols = 'all', $order = 'none', $filter_string = 'all')
    function single($grid = 'none')
    {
        $columns = array(
            0 => array(
                'name' => 'Username',
                'db_name' => 'username',
                'header' => 'Username',
                'group' => 'User',
                'required' => TRUE,
                'unique' => TRUE,
                'validation' => 'alpha_dash',
                'form_control' => 'text_long',
                'type' => 'string'),
            1 => array(
                'name' => 'Age',
                'db_name' => 'age',
                'header' => 'Age',
                'group' => 'User',
                'required' => TRUE,
                'visible' => FALSE,
                'form_control' => 'text_short',
                'type' => 'integer'),
            2 => array(
                'name' => 'Active',
                'db_name' => 'active',
                'header' => 'Active',
                'group' => 'User',
                //'allow_filter' => FALSE,
                'form_control' => 'checkbox',
                'type' => 'boolean'),
            3 => array(
                'name' => 'Start Time',
                'db_name' => 'start_time',
                'header' => 'Start Time',
                'group' => 'Range',
                'date_format' => 'Y. M d.',
                'time_format' => 'h:i A',
                'form_default' => date('Y. M d. h:i A'),
                'form_control' => 'datetimepicker',
                'type' => 'datetime'),
            4 => array(
                'name' => 'End Time',
                'db_name' => 'end_time',
                'header' => 'End Time',
                'group' => 'Range',
                'date_format' => 'Y.m.d',
                'form_control' => 'datetimepicker',
                'type' => 'datetime'),
            5 => array(
                'name' => 'City',
                'db_name' => 'city',
                'header' => 'City',
                'group' => 'User',
                'ref_table_db_name' => 'city',
                'ref_field_db_name' => 'name',
                'ref_field_type' => 'string',
                'form_control' => 'dropdown',
                'required' => TRUE,
                'type' => '1-n'),
            6 => array(
                'name' => 'Comment',
                'db_name' => 'opinion',
                'header' => 'Comment',
                'group' => 'Comment',
                'form_control' => 'textarea',
                'type' => 'text'),
            7 => array(
                'name' => 'IP',
                'db_name' => 'ip_address',
                'header' => 'IP',
                'visible' => FALSE,
                'form_default' => $this->input->ip_address(),
                'form_visible' => FALSE,
                'type' => 'string'),
            8 => array(
                'name' => 'Time',
                'db_name' => 'time',
                'header' => 'Time',
                'group' => 'Comment',
                'form_control' => 'timepicker',
                'type' => 'time'),
            9 => array(
                'name' => 'Picture',
                'db_name' => 'pic',
                'header' => 'Picture',
                'group' => 'Comment',
                'form_control' => 'file',
                'type' => 'file')
        );

        // Allow edit/delete only for items with the current IP address
        $commands['delete']['filters'] = array(7 => array('value' => $this->input->ip_address()));
        $commands['edit']['filters'] = array(7 => array('value' => $this->input->ip_address()));
        // Don't show multiple delete button
        $commands['delete']['toolbar'] = FALSE;

        $params = array(
            'id' => 'users',
            'table' => 'user',
            'url' => 'sample/single',
            'uri_param' => $grid,
            'columns' => $columns,
            //'columns_visible' => array(0,2,3,4),
            'commands' => $commands,
            'ajax' => TRUE
        );

        $this->load->library('carbogrid', $params);

        if ($this->carbogrid->is_ajax)
        {
            $this->carbogrid->render();
            return FALSE;
        }

        // Pass grid to the view
        $data->page = 'grid_single';
        $data->page_grid = $this->carbogrid->render();

        $this->load->view('container', $data);
    }

    function multiple($grid1 = 'none', $grid2 = 'none', $grid3 = 'none', $grid4 = 'none')
    {
        if ($this->input->post('activate'))
        {
            $ids = $this->input->post('cg_users1_item_ids');

            if (count($ids))
            {
                // This should be in a model of course
                $this->db->set('active', 1)->where_in('id', $ids)->update('user');
            }
        }
        if ($this->input->post('unactivate'))
        {
            $ids = $this->input->post('cg_users2_item_ids');

            if (count($ids))
            {
                // This should be in a model of course
                $this->db->set('active', 0)->where_in('id', $ids)->update('user');
            }
        }

        // Grid 1
        $columns = array(
            0 => array(
                'name' => 'Username',
                'db_name' => 'username',
                'header' => 'Username',
                'group' => 'User',
                'form_control' => 'text_long',
                'type' => 'string'),
            1 => array(
                'name' => 'Active',
                'db_name' => 'active',
                'header' => 'Active',
                'group' => 'User',
                'allow_filter' => FALSE,
                'form_visible' => FALSE,
                'form_control' => 'checkbox',
                'type' => 'boolean'),
            2 => array(
                'name' => 'Start Time',
                'db_name' => 'start_time',
                'header' => 'Start Time',
                'group' => 'Period',
                'date_format' => 'm/d/Y',
                'form_default' => date('m/d/Y H:i'),
                'form_control' => 'datetimepicker',
                'type' => 'date'),
            3 => array(
                'name' => 'End Time',
                'db_name' => 'end_time',
                'header' => 'End Time',
                'group' => 'Period',
                'date_format' => 'm/d/Y',
                'form_control' => 'datetimepicker',
                'type' => 'date')
        );

        $params = array(
            'id' => 'users1',
            'table' => 'user',
            'url' => 'sample/multiple',
            'uri_param' => $grid1,
            'params_after' => $grid2 . '/' . $grid3,
            'columns' => $columns,
            'order' => array(0 => 'desc'),
            'hard_filters' => array(
                1 => array('value' => FALSE)
            ),
            'allow_add' => FALSE,
            'allow_edit' => FALSE,
            'allow_delete' => FALSE,
            'allow_filter' => FALSE,
            'allow_columns' => FALSE,
            'allow_page_size' => FALSE,
            'nested' => TRUE,
            'ajax' => TRUE
        );

        $this->load->library('carbogrid', $params, 'grid1');

        if ($this->grid1->is_ajax)
        {
            $this->grid1->render();
            return FALSE;
        }

        // Grid 2
        $columns = array(
            0 => array(
                'name' => 'Username',
                'db_name' => 'username',
                'header' => 'Username',
                'group' => 'User',
                'form_control' => 'text_long',
                'type' => 'string'),
            1 => array(
                'name' => 'Age',
                'db_name' => 'age',
                'header' => 'Age',
                'group' => 'User',
                'form_control' => 'text_short',
                'type' => 'integer'),
            2 => array(
                'name' => 'Active',
                'db_name' => 'active',
                'header' => 'Active',
                'group' => 'User',
                'allow_filter' => FALSE,
                'form_control' => 'checkbox',
                'type' => 'boolean')
        );

        $params = array(
            'id' => 'users2',
            'table' => 'user',
            'url' => 'sample/multiple',
            'uri_param' => $grid2,
            'params_before' => $grid1,
            'params_after' => $grid3,
            'columns' => $columns,
            'hard_filters' => array(
                2 => array('value' => TRUE)
            ),
            'allow_add' => FALSE,
            'allow_edit' => FALSE,
            'allow_delete' => FALSE,
            'allow_filter' => FALSE,
            'allow_columns' => FALSE,
            'allow_page_size' => FALSE,
            'nested' => TRUE,
            'ajax' => TRUE
        );

        $this->load->library('carbogrid', $params, 'grid2');

        if ($this->grid2->is_ajax)
        {
            $this->grid2->render();
            return FALSE;
        }

        // Grid 3
        $columns = array(
            0 => array(
                'name' => 'Username',
                'db_name' => 'username',
                'header' => 'Username',
                'group' => 'User',
                'form_control' => 'text_long',
                'required' => TRUE,
                'unique' => TRUE,
                'validation' => 'alpha_dash',
                'type' => 'string'),
            1 => array(
                'name' => 'Active',
                'db_name' => 'active',
                'header' => 'Active',
                'group' => 'User',
                'allow_filter' => FALSE,
                'form_control' => 'checkbox',
                'type' => 'boolean'),
            2 => array(
                'name' => 'City',
                'db_name' => 'city',
                'header' => 'City',
                'group' => 'User',
                'allow_filter' => FALSE,
                'ref_table_db_name' => 'city',
                'ref_field_db_name' => 'name',
                'ref_field_type' => 'string',
                'form_control' => 'dropdown',
                'required' => TRUE,
                'type' => '1-n'),
            3 => array(
                'name' => 'Comment',
                'db_name' => 'opinion',
                'header' => 'Comment',
                'group' => 'Comment',
                'form_control' => 'textarea',
                'type' => 'text'),
            4 => array(
                'name' => 'IP',
                'db_name' => 'ip_address',
                'header' => 'IP',
                'visible' => FALSE,
                'form_default' => $this->input->ip_address(),
                'form_visible' => FALSE,
                'type' => 'string')
        );

        // Allow edit/delete only for items with the current IP address
        $commands['delete']['filters'] = array(4 => array('value' => $this->input->ip_address()));
        $commands['edit']['filters'] = array(4 => array('value' => $this->input->ip_address()));
        // Don't show multiple delete button
        $commands['delete']['toolbar'] = FALSE;

        $params = array(
            'id' => 'users',
            'table' => 'user',
            'url' => 'sample/multiple',
            'uri_param' => $grid3,
            'params_before' => $grid1 . '/' . $grid2,
            'columns' => $columns,
            'commands' => $commands,
            'filters' => array(0 => array('value' => 'la', 'operator' => 'like')),
            'ajax' => TRUE,
            'ajax_history' => FALSE
        );

        $this->load->library('carbogrid', $params, 'grid3');

        if ($this->grid3->is_ajax)
        {
            $this->grid3->render();
            return FALSE;
        }

        // Grid 4
        $columns = array(
            0 => array(
                'name' => 'City',
                'db_name' => 'name',
                'header' => 'City Name',
                'group' => 'City Data',
                'required' => TRUE,
                'unique' => TRUE,
                'form_control' => 'text_long',
                'min_length' => 3,
                'max_length' => 50,
                'type' => 'string')
        );

        $params = array(
            'id' => 'cities',
            'table' => 'city',
            'url' => 'sample/multiple',
            'uri_param' => $grid4,
            'params_before' => $grid1 . '/' . $grid2 . '/' . $grid3,
            'columns' => $columns,
            'allow_delete' => FALSE,
            'show_empty_rows' => FALSE
        );

        $this->load->library('carbogrid', $params, 'grid4');

        if ($this->grid4->is_ajax)
        {
            $this->grid4->render();
            return FALSE;
        }

        // Pass grid to the view
        $data->page = 'grid_multiple';
        $data->grid1 = $this->grid1->render();
        $data->grid2 = $this->grid2->render();
        $data->grid3 = $this->grid3->render();
        $data->grid4 = $this->grid4->render();

        $this->load->view('container', $data);
    }

}

/* End of file sample.php */
/* Location: ./application/controllers/admin/sample.php */
