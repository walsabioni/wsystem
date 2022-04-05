<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Marcas extends MY_Controller
{

    /**
     * author: Ramon Silva
     * email: silva018-mg@yahoo.com.br
     *
     */

    public function __construct()
    {
        parent::__construct();

        $this->load->helper('form');
        $this->load->model('marcas_model');
        $this->data['menuMarcas'] = 'Marcas';
    }

    public function index()
    {
        $this->gerenciar();
    }

    public function gerenciar()
    {
        if (!$this->permission->checkPermission($this->session->userdata('permissao'), 'vMarca')) {
            $this->session->set_flashdata('error', 'Você não tem permissão para visualizar marcas.');
            redirect(base_url());
        }

        $this->load->library('pagination');

        $this->data['configuration']['base_url'] = site_url('marcas/gerenciar/');
        $this->data['configuration']['total_rows'] = $this->marcas_model->count('marcas');

        $this->pagination->initialize($this->data['configuration']);

        $this->data['results'] = $this->marcas_model->get('marcas', '*', '', $this->data['configuration']['per_page'], $this->uri->segment(3));

        $this->data['view'] = 'marcas/marcas';
        return $this->layout();
    }


    public function adicionar()
    {
        if (!$this->permission->checkPermission($this->session->userdata('permissao'), 'aMarca')) {
            $this->session->set_flashdata('error', 'Você não tem permissão para adicionar marcas.');
            redirect(base_url());
        }

        $this->load->library('form_validation');
        $this->data['custom_error'] = '';

        if ($this->form_validation->run('marcas') == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {
           
            $data = [
                'marca' => set_value('marca'),
                'cadastro' => set_value('cadastro'),
                'situacao' => set_value('situacao'),
            ];

            if ($this->marcas_model->add('marcas', $data) == true) {
                $this->session->set_flashdata('success', 'Marca adicionado com sucesso!');
                log_info('Adicionou uma Marca');
                redirect(site_url('marcas/adicionar/'));
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>Ocorreu um erro.</p></div>';
            }
        }
        $this->data['view'] = 'marcas/adicionarMarca';
        return $this->layout();
    }

    public function editar()
    {
        if (!$this->permission->checkPermission($this->session->userdata('permissao'), 'eMarca')) {
            $this->session->set_flashdata('error', 'Você não tem permissão para editar marca.');
            redirect(base_url());
        }
        $this->load->library('form_validation');
        $this->data['custom_error'] = '';

        if ($this->form_validation->run('marcas') == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {
            $data = [
                'marca' => set_value('marca'),
                'cadastro' => set_value('cadastro'),
                'situacao' => set_value('situacao')
            ];

            if ($this->marcas_model->edit('marcas', $data, 'idMarcas', $this->input->post('idMarcas')) == true) {
                $this->session->set_flashdata('success', 'Marcas editado com sucesso!');
                log_info('Alterou um marcas. ID: ' . $this->input->post('idMarcas'));
                redirect(site_url('marcas/editar/') . $this->input->post('idMarcas'));
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>Ocorreu um errro.</p></div>';
            }
        }

        $this->data['result'] = $this->marcas_model->getById($this->uri->segment(3));

        $this->data['view'] = 'marcas/editarMarca';
        return $this->layout();
    }

    public function excluir()
    {
        if (!$this->permission->checkPermission($this->session->userdata('permissao'), 'dMarca')) {
            $this->session->set_flashdata('error', 'Você não tem permissão para excluir marcas.');
            redirect(base_url());
        }

        $id = $this->input->post('id');
        if ($id == null) {
            $this->session->set_flashdata('error', 'Erro ao tentar excluir marca.');
            redirect(site_url('marcas/gerenciar/'));
        }

        $this->marcas_model->delete('marcas_os', 'marcas_id', $id);
        $this->marcas_model->delete('marcas', 'idMarcas', $id);

        log_info('Removeu um marca. ID: ' . $id);

        $this->session->set_flashdata('success', 'Marca excluido com sucesso!');
        redirect(site_url('marcas/gerenciar/'));
    }
}
