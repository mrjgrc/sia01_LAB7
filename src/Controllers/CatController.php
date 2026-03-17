<?php
namespace App\Controllers;
use App\Models\CatModel;

class CatController {
    private $model;

    public function __construct(CatModel $model) {
        $this->model = $model;
    }

    public function index() {
        $this->jsonResponse($this->model->getAll());
    }

    public function show($id) {
        $cat = $this->model->getById($id);
        if (!$cat) return $this->jsonResponse(["error" => "Cat not found"], 404);
        $this->jsonResponse($cat);
    }

    public function store() {
        $data = json_decode(file_get_contents("php://input"), true);
        $this->model->create($data['name'], $data['owner'], $data['birth'], $data['gender']);
        $this->jsonResponse(["message" => "Cat created"], 201);
    }

    public function update($id) {
        $data = json_decode(file_get_contents("php://input"), true);
        $this->model->update($id, $data['name'], $data['owner'], $data['birth'], $data['gender']);
        $this->jsonResponse(["message" => "Cat updated"]);
    }

    public function destroy($id) {
        $this->model->delete($id);
        $this->jsonResponse(["message" => "Cat deleted"]);
    }

    private function jsonResponse($data, $status = 200) {
        http_response_code($status);
        header("Content-Type: application/json");
        echo json_encode($data);
    }
}