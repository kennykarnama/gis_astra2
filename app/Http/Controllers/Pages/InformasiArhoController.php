<?php

namespace App\Http\Controllers\Pages;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use DB;
use App\Models\Arho;

class InformasiArhoController extends Controller
{
    //
    public function __construct()
    {
    	# code...
    	$this->middleware('auth:admin');
    }

    public function index()
    {
    	# code...
    	return view('pages.informasi_arho',[]);
    }

      public function simpan_arho(Request $request)
    {
        # code...
        $nama_lengkap = $request['nama_arho'];

       
        $arho = new arho;

        $arho->nama_lengkap = $nama_lengkap;

        $arho->is_aktif = 1;

      

        $status_insert = $arho->save();


        if($status_insert)
            return 1;
        else
            return 0;
    }

    public function hapus_arho(Request $request)
    {
        # code...
        $id_arho = $request['id_arho'];

        $arho = arho::find($id_arho);

        $arho->is_aktif = 0;

        $status = $arho->save();

        if($status)
            return 1;
        else
            return 0;

    }

    public function update_arho(Request $request)
    {
        # code...
        $id_arho = $request['id_arho'];

         $nama_lengkap = $request['nama_arho'];


        $arho = arho::find($id_arho);

        $arho->nama_lengkap = $nama_lengkap;

      

        $status_insert = $arho->save();


        if($status_insert)
            return 1;
        else
            return 0;

    }

    public function fetch_arho_by_id(Request $request)
    {
        # code...
        $id_arho = $request['id_arho'];

        $arho = arho::find($id_arho);

        return response()->json($arho);
    }

    public function all_arho(Request $request)
    {
        # code...
          $columns = array(
            1=>'nama_lengkap'
            );


        $jumlah_data = $this->hitungDataArho();

        $totalFiltered = $jumlah_data;

         // get data table request

        $limit = $request->input('length');
        
        $start = $request->input('start');

        if(($request->input('order.0.column'))!==NULL){
              $order = $columns[$request->input('order.0.column')];
              
              $dir = $request->input('order.0.dir');

        }

        // check search value

        if(empty($request->input('search.value'))){

            if(isset($order)&&isset($dir)){
                $list_Arho = $this->fetchDataArhoOrdered($start,$limit,$order,$dir);
            }

            else{

                $list_Arho = $this->fetchDataArho($start,$limit);


            }
        }

        else{

            $search_value = $request->input('search.value');

            if(isset($order)&&isset($dir)){
                $list_Arho = $this->fetchDataArhoFilteredOrdered($start,$limit,$search_value,$order,$dir);
            }

            else{
              $list_Arho = $this->fetchDataArhoFiltered($start,$limit,$search_value);
            }

             $totalFiltered = $this->hitungDataArhoFiltered($search_value);
        }

        $data = array();

        $puter = $start+1;

        foreach ($list_Arho as $Arho) {
            # code...
            $nested_array['no'] = $puter++;

            $nested_array['nama_arho'] = $Arho->nama_lengkap;

          

           

            $nested_array['actions'] =  '<div class="btn-group" style="width:100%">
                                          <button class="btn btn-primary btn-edit-arho" style="width:50%"'.
                                          ' data-idarho='.$Arho->id_arho.
                                          '>Edit</button>
                                          <button class="btn btn-danger btn-hapus-arho" style="width:50%"'.
                                          ' data-idarho='.$Arho->id_arho.
                                          ' >Delete</button>
                                        </div>';

            array_push($data, $nested_array);
        }

        $json_data = array(
                    "draw"            => intval($request->input('draw')),  
                    "recordsTotal"    => intval($jumlah_data),  
                    "recordsFiltered" => intval($totalFiltered), 
                    "data"            => $data   
                    );

        return response()->json($json_data);
    }

       private function hitungDataArho()
    {
        # code...

        $jumlah_arho = DB::table('arho')->where('arho.is_aktif','=',1)->count();

        return $jumlah_arho;

    }

    private function hitungDataArhoFiltered($search_value)
    {
        # code...

        $list_arho = DB::table('arho')

                            ->where('arho.nama_lengkap','LIKE','%'.$search_value.'%')
                            ->get();

        $final_list_arho = array();

        foreach ($list_arho as $arho) {
            # code...
            if($arho->is_aktif == 1){
                array_push($final_list_arho, $arho);
            }
        }

        return count($final_list_arho);

    }

    private function fetchDataArho($start,$limit){

        $query = DB::table('arho')
                ->where('arho.is_aktif','=',1)
                ->offset($start)
                ->limit($limit)
                ->get();

        return $query;

    }

    private function fetchDataArhoOrdered($start,$limit,$order,$dir){
         $query = DB::table('arho')
                ->where('arho.is_aktif','=',1)
                ->offset($start)
                ->limit($limit)
                ->orderBy($order,$dir)
                ->get();

        return $query;
    }

    private function fetchDataArhoFiltered($start,$limit,$search_value){
        $query = DB::table('arho')
                 ->where('arho.nama_lengkap','LIKE','%'.$search_value.'%')
                 ->offset($start)
                 ->limit($limit)
                 ->get();

        $final_query = array();

        foreach ($query as $item) {
            # code...
            if($item->is_aktif == 1){
                array_push($final_query,$item);
            }
        }

        return $final_query;
    }

    private function fetchDataArhoFilteredOrdered($start,$limit,$search_value,$order,$dir){
        
         $query = DB::table('arho')
                 ->where('arho.nama_lengkap','LIKE','%'.$search_value.'%')
                 ->offset($start)
                 ->limit($limit)
                 ->orderBy($order,$dir)
                 ->get();

        $final_query = array();

        foreach ($query as $item) {
            # code...
            if($item->is_aktif == 1){
                array_push($final_query,$item);
            }
        }

        return $final_query;
    }

}
