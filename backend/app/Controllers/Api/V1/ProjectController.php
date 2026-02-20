<?php

namespace App\Controllers\Api\V1;

use CodeIgniter\RESTful\ResourceController;
use App\Models\ProjectModel;

class ProjectController extends ResourceController
{
    protected $modelName = ProjectModel::class;
    protected $format = 'json';

    public function index()
    {
        return $this->respond($this->model->findAll());
    }

    public function show($id = null)
    {
        $project = $this->model->find($id);

        if (!$project) {
            return $this->failNotFound('Project not found');
        }

        return $this->respond($project);
    }

    public function create()
    {
        $data = $this->request->getJSON(true);

        $this->model->insert($data);

        return $this->respondCreated($data);
    }

    public function update($id = null)
    {
        $data = $this->request->getJSON(true);

        $this->model->update($id, $data);

        return $this->respond(['message' => 'Updated']);
    }

    public function delete($id = null)
    {
        $this->model->delete($id);

        return $this->respondDeleted(['message' => 'Deleted']);
    }
}
