<?php

use Illuminate\Http\Request;

class ApiController extends Controller
{
    /**
     * Get Items by type
     *
     * @param Request $request
     *
     * @return bool|string
     */
    public function getItems(Request $request)
    {
        $required_fields = ['type'];
        if (!$this->hasAllFields($request, $required_fields)) {
            return false; // TODO Throw error
        }
        $type = $request->input('type');
        $model = $this->getModel($type);
        if ($model !== null) {
            try {
                return $model->all();
            } catch (Exception $e) {
                return ''; // TODO Respond with Error
            }
        } else {
            return 'Model is null'; // TODO Respond with Error
        }
    }

    public function getItem(Request $request)
    {
        $required_fields = ['type', 'id'];

        if (!$this->hasAllFields($request, $required_fields)) {
            return false; // TODO Respond with Error
        }

        $type = $request->input('type');
        $id = $request->input('id');

        $model = $this->getModel($type);
        if ($model !== false) {
            try {
                $model->where('id', $id)->firstOrFail();
                return $model;
            } catch (Exception $e) {
                return false; // TODO Respond with Error
            }
        } else {
            return false; // TODO Respond with Error
        }
    }

    public function postItem(Request $request)
    {
        $required_fields = ['type', 'data'];
        if (!$this->hasAllFields($request, $required_fields)) {
            return false; // TODO Respond with Error
        }

        $type = $request->input('type');
        $data = $request->input('data');
        $data = (array)json_decode($data);

        $model = $this->getModel($type);
        if ($model !== false) {
            if (method_exists($model, 'safeCreate')) {
                $model::safeCreate($data);
            } else {
                $model::create($data);
            }
        }
    }

    public function updateItem(Request $request)
    {
        $required_fields = ['type', 'id', 'data'];

        if (!$this->hasAllFields($request, $required_fields)) {
            return false; // TODO Respond with Error
        }

        $type = $request->input('type');
        $id = $request->input('id');
        $data = $request->input('data');

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
    public function hasAllFields($request, $fields)
    {
        foreach ($fields as $field) {
            if (!$request->has($field)) {
                return false;
            }
        }
        return true;
    }
}
