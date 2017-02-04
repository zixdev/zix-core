<?php

namespace Zix\Core\Http\Controllers\Menu;

use Illuminate\Http\Request;
use Zix\Core\Entities\Menu;
use Zix\Core\Events\Site\CreateSiteRelation;
use Zix\Core\Http\Requests\Menu\CreateMenuRequest;
use Zix\Core\Support\Traits\ApiResponses;
use Zix\Core\Support\Traits\CrudControllerTrait;

class ManageMenuController
{
    use ApiResponses, CrudControllerTrait;

    /**
     * ManageMenuController constructor.
     * @param Menu $model
     */
    public function __construct(Menu $model)
    {
        $this->model = $model;
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        return $this->respondWithData($this->model->with(['sites'])->find($id));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateMenuRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateMenuRequest $request)
    {
        $model = $this->model->create([
            'name' => $request->get('name'),
            'items' => json_encode([])
        ]);
        event(new CreateSiteRelation($model, $request));
        return $this->respondDataCreated($model);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CreateMenuRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateMenuRequest $request, $id)
    {
        $model = $this->model->find($id);
        event(new CreateSiteRelation($model, $request));
        return $this->respondRequestAccepted($model->update($request->input()));
    }

    public function addLink(Request $request, $id)
    {
        $this->model->find($id)->links()->create($request->input());
        return $this->respondWithData($this->model->with(['sites', 'links'])->find($id));
    }

    public function updateLinksOrder(Request $request, $id)
    {
        $model = $this->model->find($id);
        $items = collect(json_decode($request->get('menu')));
        $order = 0;
        foreach ($items as $item) {
            $model->links->find($item->id)->update([
                'parent_id' => null,
                'order' => $order
            ]);
            if (isset($item->children) && count($item->children)) {
                foreach ($item->children as $child) {
                    $model->links->find($child->id)->update([
                        'parent_id' => $item->id,
                        'order' => $order
                    ]);
                    $order++;
                }
            }
            $order++;
        }

        return $request->all();
    }

}