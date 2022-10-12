<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Position extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->helper("form");
        $this->load->model("Position_model","position");
    }

	public function index()
	{
		redirect(base_url("employee"));
	}

    public function create_view() {
        $this->load->view("createPosition");
    }
    
    public function edit_view($id) {
        $position = $this->position->get_edit((int)$id);
        $this->load->view("editPosition", compact("position"));
    }

    public function get_positions() {
        $output = [];
        $positions = $this->position->get_all($this->input->post("search"),$this->input->post("length"),$this->input->post("start"));
        $output["draw"] = $this->input->post("draw");
        $output["recordsTotal"] = $this->position->count_all_data();
        $output["recordsFiltered"] = $positions->num_rows();
        foreach($positions->result() as $row) {
            $output["data"][] = [
                $row->id,
                $row->name,
                "<div class=\"d-flex justify-content-around\">{$this->btn_edit($row->id)}{$this->btn_delete($row->id)}</div>",
            ];
        }
        echo json_encode($output);
    }

    public function store() {
        $position = new Position_model();
        $position->name = $this->input->post("name");

        $this->position->create($position);
        redirect(base_url("employee#positions"));
    } 

    public function update() {
        $position = new Position_model();
        $position->id = $this->input->post("id");
        $position->name = $this->input->post("name");

        $this->position->update($position);
        redirect(base_url("employee"));
    }

    public function delete() {
        $id = $this->input->post("id_position");
        $this->position->delete($id);
        redirect(base_url("employee"));
    }

    private function btn_edit($id) {
        return "<a href=\"{$id}/edit_position\"><button class=\"btn btn-warning\">Editar</button></a>";
    }

    private function btn_delete($id) {
        return "<form method=\"post\" action=".base_url("deletePosition").">
        <input type=\"hidden\" name=\"id_position\" value=\"{$id}\" />
        <input value=\"Eliminar\" class=\"btn btn-danger\" type=\"submit\" onclick=\"javascript:return confirm('¿Seguro de eliminar este registro?');\" />
        </form>";
    }
}