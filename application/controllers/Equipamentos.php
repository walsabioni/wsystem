<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Equipamentos extends MY_Controller
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
        $this->load->model('equipamentos_model');
        $this->data['menuEquipamentos'] = 'Equipamentos';
    }

    public function index()
    {
        $this->gerenciar();
    }

    public function gerenciar()
    {
        if (!$this->permission->checkPermission($this->session->userdata('permissao'), 'vEquipamento')) {
            $this->session->set_flashdata('error', 'Você não tem permissão para visualizar equipamentos.');
            redirect(base_url());
        }

        $this->load->library('pagination');

        $this->data['configuration']['base_url'] = site_url('equipamentos/gerenciar/');
        $this->data['configuration']['total_rows'] = $this->equipamentos_model->count('equipamentos');

        $this->pagination->initialize($this->data['configuration']);

        $this->data['results'] = $this->equipamentos_model->get('equipamentos', '*', '', $this->data['configuration']['per_page'], $this->uri->segment(3));

        $this->data['view'] = 'equipamentos/equipamentos';
        return $this->layout();
    }


    public function adicionar()
    {
        if (!$this->permission->checkPermission($this->session->userdata('permissao'), 'aEquipamento')) {
            $this->session->set_flashdata('error', 'Você não tem permissão para adicionar equipamentos.');
            redirect(base_url());
        }

        $this->load->library('form_validation');
        $this->data['custom_error'] = '';

        if ($this->form_validation->run('equipamentos') == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {
           
            $data = [
                'equipamento' => set_value('equipamento'),
                'num_serie' => set_value('num_serie'),
                'modelo' => set_value('modelo'),
                'cor' => set_value('cor'),
                'descricao' => set_value('descricao'),
                'tensao' => set_value('tensao'),
                'potencia' => set_value('potencia'),
                'voltagem' => set_value('voltagem'),
                'data_fabricao' => set_value('data_fabricao'),
                'marca_id' => set_value('marca_id')
            ];

            if ($this->equipamentos_model->add('equipamentos', $data) == true) {
                $this->session->set_flashdata('success', 'Equipamento adicionado com sucesso!');
                log_info('Adicionou uma Equipamento');
                redirect(site_url('equipamentos/adicionar/'));
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>Ocorreu um erro.</p></div>';
            }
        }
        $this->data['view'] = 'equipamentos/adicionarEquipamento';
        return $this->layout();
    }

    public function editar()
    {
        if (!$this->permission->checkPermission($this->session->userdata('permissao'), 'eEquipamento')) {
            $this->session->set_flashdata('error', 'Você não tem permissão para editar equipamento.');
            redirect(base_url());
        }
        $this->load->library('form_validation');
        $this->data['custom_error'] = '';

        if ($this->form_validation->run('equipamentos') == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {
            $data = [
                'equipamento' => set_value('equipamento'),
                'num_serie' => set_value('num_serie'),
                'modelo' => set_value('modelo'),
                'cor' => set_value('cor'),
                'descricao' => set_value('descricao'),
                'tensao' => set_value('tensao'),
                'potencia' => set_value('potencia'),
                'voltagem' => set_value('voltagem'),
                'data_fabricao' => set_value('data_fabricao'),
                'marca_id' => set_value('marca_id')
            ];

            if ($this->equipamentos_model->edit('equipamentos', $data, 'idEquipamentos', $this->input->post('idEquipamentos')) == true) {
                $this->session->set_flashdata('success', 'Equipamentos editado com sucesso!');
                log_info('Alterou um equipamentos. ID: ' . $this->input->post('idEquipamentos'));
                redirect(site_url('equipamentos/editar/') . $this->input->post('idEquipamentos'));
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>Ocorreu um errro.</p></div>';
            }
        }

        $this->data['result'] = $this->equipamentos_model->getById($this->uri->segment(3));

        $this->data['view'] = 'equipamentos/editarEquipamento';
        return $this->layout();
    }

    public function excluir()
    {
        if (!$this->permission->checkPermission($this->session->userdata('permissao'), 'dEquipamento')) {
            $this->session->set_flashdata('error', 'Você não tem permissão para excluir equipamentos.');
            redirect(base_url());
        }

        $id = $this->input->post('id');
        if ($id == null) {
            $this->session->set_flashdata('error', 'Erro ao tentar excluir equipamento.');
            redirect(site_url('equipamentos/gerenciar/'));
        }

        $this->equipamentos_model->delete('marcas_os', 'marcas_id', $id);
        $this->marcas_model->delete('marcas', 'idMarcas', $id);

        log_info('Removeu um equipamento. ID: ' . $id);

        $this->session->set_flashdata('success', 'Equipamento excluido com sucesso!');
        redirect(site_url('equipamentos/gerenciar/'));
    }
}
