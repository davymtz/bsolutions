<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employee extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->helper("form");
        $this->load->model(["Position_model"=>"position","Employee_model"=>"employee"]);
    }

    private function btn_edit($id) {
        return "<a href=\"{$id}/edit_employee\"><button class=\"btn btn-warning\">Editar</button></a>";
    }

    private function btn_delete($id) {
        return "<form method=\"post\" action=".base_url("deleteEmployee").">
        <input type=\"hidden\" name=\"id_employee\" value=\"{$id}\" />
        <input value=\"Eliminar\" class=\"btn btn-danger\" type=\"submit\" onclick=\"javascript:return confirm('¿Seguro de eliminar este registro?');\" />
        </form>";
    }

	public function index()
	{
		$this->load->view('employee_table');
	}

    public function create_view() {
        $positions = $this->position->get_all_select();
        $this->load->view("createEmployee", compact("positions"));
    }
    
    public function edit_view($id) {
        $positions = $this->position->get_all_select();
        $employee = $this->employee->get_edit((int)$id);
        $this->load->view("editEmployee", compact("positions","employee"));
    }

    public function get_employees() {
        $output = [];
        $employees = $this->employee->get_all($this->input->post("search"),$this->input->post("length"),$this->input->post("start"));
        $output["draw"] = $this->input->post("draw");
        $output["recordsTotal"] = $this->employee->count_all_data();
        $output["recordsFiltered"] = $employees->num_rows();
        foreach($employees->result() as $row) {
            $output["data"][] = [
                $row->id,
                $row->name,
                $row->edad,
                $row->monthly_salary,
                $row->rfc,
                $row->position,
                "<div class=\"d-flex justify-content-around\">{$this->btn_edit($row->id)}{$this->btn_delete($row->id)}</div>",
            ];
        }
        echo json_encode($output);
    }

    public function store() {
        $employee = new Employee_model();
        $employee->name = $this->input->post("name");
        $employee->edad = $this->input->post("age");
        $employee->monthly_salary = $this->input->post("monthly_salary");
        $employee->rfc = $this->input->post("rfc");
        $employee->id_position = $this->input->post("position");

        $this->employee->create($employee);
        redirect(base_url("employee"));
    } 

    public function update() {
        $employee = new Employee_model();
        $employee->id = $this->input->post("id");
        $employee->name = $this->input->post("name");
        $employee->edad = $this->input->post("age");
        $employee->monthly_salary = $this->input->post("monthly_salary");
        $employee->rfc = $this->input->post("rfc");
        $employee->id_position = $this->input->post("position");

        $this->employee->update($employee);
        redirect(base_url("employee"));
    }

    public function delete() {
        $id = $this->input->post("id_employee");
        $this->employee->delete($id);
        redirect(base_url("employee"));
    }
}