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
            return \Response::make('Required fields missing', 404);
        }
        $type = \Request::input('type');
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

    public function getItem($id)
    {
        $required_fields = ['type'];

        if (!$this->hasAllFields($required_fields)) {
            return \Response::make('Bad Request', 404);
        }
        $type = \Input::get('type');

        $item = $this->getItemById($type, $id);
        if ($item === false) {
            return \Response::make('Item not found', 404);
        } else {
            return $item;
        }
    }

    public function postItem()
    {
        $required_fields = ['type'];
        if (!$this->hasAllFields($required_fields)) {
            return \Response::make('Item does not have the required type.', 404);
        }

        $type =  \Input::get('type');
        \Log::debug(Input::get('name'));
        $data = $this->buildModelData($type);

        $model = $this->getModel($type);
        if ($model !== false) {
            if (method_exists($model, 'safeCreate')) {
                $item = $model::safeCreate($data);
            } else {
                $item = $model::create($data);
            }

            if (is_array($item) && array_key_exists('error', $item)) {
                return \Response::make($item['error'], 500);
            } else {
                return \Response::make("{$type} created with id: {$item->id}", 201);
            }
        }
    }

    public function updateItem()
    {
        $required_fields = ['type', 'id', 'data'];

        if (!$this->hasAllFields($this->request, $required_fields)) {
            return false; // TODO Respond with Error
        }

        $type = \Request::input('type');
        $id = \Request::input('id');
        $data = \Request::input('data');

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

    /**
     * Helper function to get item by id.
     *
     * @param string  $type Type.
     * @param integer $id   Id.
     *
     * @return bool
     */
    public function getItemById($type, $id)
    {
        try {
            switch ($type) {
                case 'user':
                    $item = User::where('id', $id)->firstOrFail();
                    break;
                case 'project':
                    $item = Project::where('id', $id)->firstOrFail();
                    break;
                default:
                    break;
            }
            return $item;
        } catch (Exception $e) {
            return false;
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
            case 'testsuite':
                $model = new TestSuite();
                break;
            default:
                $model = null;
                break;
        }
        return $model;
    }

    /**
     * [hasAllFields description]
     * @param  array   $fields  Fields to check.
     * @return boolean          If the item has all fields.
     */
    public function hasAllFields($fields)
    {
        foreach ($fields as $field) {
            if (!\Input::has($field)) {
                \Log::debug($field);
                return false;
            }
        }
        return true;
    }

    public function buildModelData($type)
    {
        switch ($type) {
            case 'user':
                $data = [
                    'name' => \Input::get('name'),
                    'password' => \Input::get('password'),
                    'email' => \Input::get('email')
                ];
                break;
            case 'project':
                $data = [
                    'name' => \Input::get('name'),
                    'description' => \Input::get('description'),
                    'base_url' => \Input::get('base_url'),
                ];
                break;
            case 'testsuite':
                $data = [
                    'name' => \Input::get('name'),
                    'description' => \Input::get('description'),
                    'project_id' => \Input::get('project_id'),
                ];
                break;
            case 'testcase':
                $data = [
                    'selector' => \Input::get('selector'),
                    'expectation' => \Input::get('expectation'),
                    'selector' => \Input::get('selector'),
                    'url' => \Input::get('url'),
                    'testsuite_id' => \Input::get('testsuite_id'),
                    'type_id' => \Input::get('type_id')
                ];
                break;
            default:
                $data = null;
                break;
        }
        return $data;
    }
}
