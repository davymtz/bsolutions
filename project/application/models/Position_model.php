<?php
defined('BASEPATH') or exit("No direct script access allowed");

class Position_model extends CI_Model {
    public ?int $id;
    public string $name;

    private string $table = "positions";

    public function get_all_select() {
        try {
            $query = $this->db->query("SELECT id, name FROM {$this->table}");
            return $query->result();
        } catch (\Exception $e) {
            var_dump($e->getMessage());
            echo $this->db->error();
        } finally {
            $this->db->close();
        }
    }

    public function get_all($search,$length,$start) {
        try {
            $this->db->select(["id","name"]);
            $this->db->from($this->table);
            if(!empty($search["value"])) {
                $this->db->like("name",$search["value"]);
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

    public function create($position) {
        try {
            $this->db->trans_begin();
            $this->db->insert($this->table,$position);
            $this->db->trans_commit();
        } catch (\Exception $e) {
            $this->db->trans_rollback();
            var_dump($e->getMessage());
            echo $this->db->error();
        } finally {
            $this->db->close();
        }
    }

    public function update($position) {
        try {
            $this->db->trans_begin();
            $this->db->update($this->table,$position,["id"=>$position->id]);
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