<?php
defined('BASEPATH') or exit("No direct script access allowed");

class Employee_model extends CI_Model {
    public ?int $id;
    public string $name;
    public int $edad;
    public float $monthly_salary;
    public string $rfc;
    public int $id_position;

    private string $table = "employees";

    public function get_all($search,$length,$start) {
        try {
            $this->db->select(["e.id","e.name","e.edad","e.monthly_salary","e.rfc","p.name as position"]);
            $this->db->from("{$this->table} e");
            $this->db->join('positions p','p.id=e.id_position','inner');
            if(!empty($search["value"])) {
                $this->db->like("e.name",$search["value"]);
                $this->db->or_like("e.edad",$search["value"]);
                $this->db->or_like("e.monthly_salary",$search["value"]);
                $this->db->or_like("e.rfc",$search["value"]);
                $this->db->or_like("p.name",$search["value"]);
            }
            $this->db->order_by("1");
            $this->db->limit($length,$start);
            $query = $this->db->get();
            return $query;
        } catch (\Exception $e) {
            var_dump($e->getMessage());
            echo $this->db->error();
        } finally {
            $this->db->close();
        }
    }

    public function get_edit($id) {
        try {
            $query = $this->db->query("SELECT * FROM {$this->table} WHERE id = ?",[$id]);
            return $query->row();
        } catch (\Exception $e) {
            var_dump($e->getMessage());
            echo $this->db->error();
        } finally {
            $this->db->close();
        }
    }

    public function count_all_data() {
        return $this->db->count_all($this->table);
    }

    public function create($employee) {
        try {
            $this->db->trans_begin();
            $this->db->insert($this->table,$employee);
            $this->db->trans_commit();
        } catch (\Exception $e) {
            $this->db->trans_rollback();
            var_dump($e->getMessage());
            echo $this->db->error();
        } finally {
            $this->db->close();
        }
    }

    public function update($employee) {
        try {
            $this->db->trans_begin();
            $this->db->update($this->table,$employee,["id"=>$employee->id]);
            $this->db->trans_commit();
        } catch (\Exception $e) {
            $this->db->trans_rollback();
            var_dump($e->getMessage());
            echo $this->db->error();
        } finally {
            $this->db->close();
        }
    }

    public function delete($id) {
        try {
            $this->db->trans_begin();
            $this->db->delete($this->table,["id"=>$id]);
            $this->db->trans_commit();
        } catch (\Exception $e) {
            $this->db->trans_rollback();
            var_dump($e->getMessage());
            echo $this->db->error();
        } finally {
            $this->db->close();
        }
    }
}