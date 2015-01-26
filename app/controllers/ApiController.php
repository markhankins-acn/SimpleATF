<?php

use Illuminate\Support\Facades\Response;

class ApiController extends Controller
{
    /**
     * Get Items by type
     *
     * @return bool|string
     */
    public function getItems()
    {
        $required_fields = ['type'];
        if (!$this->hasAllFields($required_fields)) {
            return false; // TODO Throw error
        }
        $type = Request::input('type');
        $model = $this->getModel($type);
        if ($model !== null) {
            try {
                return $model->all();
            } catch (Exception $e) {
                return \Response::make('Unable to retrieve results', 404);
            }
        } else {
            return \Response::make('Requested model has no results', 404);
        }
    }

    public function getItem()
    {
        $required_fields = ['type', 'id'];

        if (!$this->hasAllFields($required_fields)) {
            return \Response::make('Bad Request', 404);
        }

        $type = \Request::input('type');
        $id =  \Request::input('id');

        $model = $this->getModel($type);
        if ($model !== false) {
            try {
                $model->where('id', $id)->firstOrFail();
                return $model;
            } catch (Exception $e) {
                return ''; // TODO Respond with Error
            }
        } else {
            return ''; // TODO Respond with Error
        }
    }

    public function postItem()
    {
        $required_fields = ['type', 'data'];
        if (!$this->hasAllFields($this->request, $required_fields)) {
            return false; // TODO Respond with Error
        }

        $type =  \Request::input('type');
        $data =  \Request::input('data');
        $data = (array)json_decode($data);

        $model = $this->getModel($type);
        if ($model !== false) {
            if (method_exists($model, 'safeCreate')) {
                $model::safeCreate($data);
            } else {
                $item = $model::create($data);
                Response::make("{$type} created with id: {$item->id}", 201);
            }
        }
    }

    public function updateItem()
    {
        $required_fields = ['type', 'id', 'data'];

        if (!$this->hasAllFields($this->request, $required_fields)) {
            return false; // TODO Respond with Error
        }

        $type = Request::input('type');
        $id = Request::input('id');
        $data = Request::input('data');

        $model = $this->getModel($type);
        if ($model !== false) {
            try {
                $model::where('id', $id)->firstOrFail();
            } catch (Exception $e) {
                return false; // TODO Respond with Error
            }

        } else {
            return false; // TODO Respond with Error
        }
    }

    public function getModel($type)
    {
        switch ($type) {
            case 'user':
                $model = new User();
                break;
            case 'project':
                $model = new Project();
                break;
            default:
                $model = null;
                break;
        }
        return $model;
    }

    /**
     * [hasAllFields description]
     * @param  object  $request Illuminate request object.
     * @param  array   $fields  Fields to check.
     * @return boolean          If the item has all fields.
     */
    public function hasAllFields($fields)
    {
        foreach ($fields as $field) {
            if (!Request::has($field)) {
                return false;
            }
        }
        return true;
    }
}
