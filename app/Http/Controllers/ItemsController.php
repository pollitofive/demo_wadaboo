<?php

namespace App\Http\Controllers;

use App\Models\Calificacion;
use App\Models\OfertaXItem;
use App\Repositories\RepoItem;
use App\Repositories\RepoProceso;
use Illuminate\Http\Request;
use App\Models\Item;

class ItemsController extends Controller {

    private $repoProceso;
    private $repoItem;

    public function __construct(RepoProceso $repoProceso,RepoItem $repoItem)
    {
        $this->repoProceso = $repoProceso;
        $this->repoItem = $repoItem;
    }

    public function store(Request $request)
    {
        $proceso = $this->getProcesoExistingtOrNew($request);
        abort_if($proceso->estaFinalizado(),403,__('offers.not-vailable-for-bidding-because-it-is-finalised'));

        $item = $this->repoItem->setDataToSave($request);
        $proceso->items()->save($item);

        return $item->id;
    }

    function delete(Request $request)
    {
        $item = Item::where('id',$request->get('item_id'))->first();
        $item->delete();
        return 1;
    }

    public function getDataComprador(Request $request)
    {
        $item_id = $request->get("item_id");

        $relations = ['user','ofertas'];
        $item = $this->repoItem->getModelWithRelationsById($item_id,$relations);

        $mejor_oferta = $item->mejorOfertaObject();

        if($mejor_oferta->user_id == auth()->user()->id)
        {
            return response()->json(['user' => $item->user->getDataOferta()],200);
        }

        return response()->json(['user' => null],404);


    }

    public function getDataVendedor(Request $request)
    {
        $item_id = $request->get("item_id");

        $relations = ['user','ofertas'];
        $item = $this->repoItem->getModelWithRelationsById($item_id,$relations);

        if($item->user_id == auth()->user()->id)
        {
            $mejor_oferta = $item->mejorOfertaObject();
            return response()->json(['user' => $mejor_oferta->user->getDataOferta()],200);
        }

        return response()->json(['user' => null],404);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    private function getProcesoExistingtOrNew(Request $request)
    {
        if ($request->get('proceso_id') != "")
            $proceso_id = $request->get('proceso_id');
        else
            $proceso_id = $this->repoProceso->getProcesoIdBorrador();

        $proceso = $this->repoProceso->getModelById($proceso_id);
        return $proceso;
    }


}
