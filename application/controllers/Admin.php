<?php
defined('BASEPATH') or exit('No direct script access allowed');



class Admin extends Authentication_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    /* email is okey lets check the password now */
    public function index()
    {
        if (is_loggedin()) {
            redirect(base_url('dashboard'));
        }
    }

    /* email is okey lets check the password now */
    public function enquiry_category()
    {
        // if (is_loggedin()) {
        //     redirect(base_url('dashboard'));
        // }

        if ($_POST) {
            if ($this->form_validation->run() !== false) {
                //save all employee information in the database
                $user_id = $this->employee_model->save($this->input->post());

                set_alert('success', translate('information_has_been_saved_successfully'));
                //send account activate email
                $this->email_model->sentStaffRegisteredAccount($post);
                redirect(base_url('employee/view/' . $post['user_role']), 'refresh');
            }
        }


        $this->data['branch_id'] = $this->application_model->get_branch_id();
        $this->data['title'] = translate('manage_category');
        $this->data['enquiry'] = $this->employee_model->getEnquiryCategory($userID);
        $this->data['sub_page'] = 'enquiry/add';
        $this->data['main_menu'] = 'enquiry';

        $this->load->view('layout/index', $this->data);
    }





}
