<?php

namespace App\Http\Controllers\Pages;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Auth;
use App\Models\Kelurahan;
use App\Models\Kecamatan;

class InformasiKelurahanController extends Controller
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
        $list_kecamatan = DB::table('kecamatan')->where('kecamatan.is_aktif','=',1)->get();

    	return view('pages.informasi_kelurahan',['list_kecamatan'=>$list_kecamatan]);
    }

     public function simpan_kelurahan(Request $request)
    {
        # code...
        $nama_kelurahan = $request['nama_kelurahan'];

        $id_kecamatan = $request['kecamatan'];

        $lat = $request['lat'];

        $lng = $request['lng'];

        $kelurahan = new Kelurahan;

        $kelurahan->nama_kelurahan = $nama_kelurahan;

        $kelurahan->lat = $lat;

        $kelurahan->lng = $lng;

        $kelurahan->id_kecamatan = $id_kecamatan;

        $status_insert = $kelurahan->save();


        if($status_insert)
            return 1;
        else
            return 0;
    }

     public function hapus_kelurahan(Request $request)
    {
        # code...
        $id_kelurahan = $request['id_kelurahan'];

        $kelurahan = Kelurahan::find($id_kelurahan);

        $kelurahan->is_aktif = 0;

        $status = $kelurahan->save();

        if($status)
            return 1;
        else
            return 0;

    }

     public function update_kelurahan(Request $request)
    {
        # code...
        $id_kelurahan = $request['id_kelurahan'];

         $nama_kelurahan = $request['nama_kelurahan'];

        
        $lat = $request['lat'];

        $lng = $request['lng'];

        $id_kecamatan = $request['kecamatan'];

        $kelurahan = Kelurahan::find($id_kelurahan);

        $kelurahan->nama_kelurahan = $nama_kelurahan;

        $kelurahan->lat = $lat;

        $kelurahan->lng = $lng;

        $kelurahan->id_kecamatan = $id_kecamatan;

        $status_insert = $kelurahan->save();


        if($status_insert)
            return 1;
        else
            return 0;

    }

    public function fetch_kelurahan_by_id(Request $request)
    {
        # code...
        $id_kelurahan = $request['id_kelurahan'];

        $kelurahan = Kelurahan::find($id_kelurahan);

        return response()->json($kelurahan);
    }

     public function all_kelurahan(Request $request)
    {
        # code...

        // define sortable columns

        $columns = array(
            1=>'nama_kelurahan',
            2=>'lng',
            3=>'lat'
            );


        $jumlah_data = $this->hitungDatakelurahan();

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
                $list_kelurahan = $this->fetchDatakelurahanOrdered($start,$limit,$order,$dir);
            }

            else{

                $list_kelurahan = $this->fetchDatakelurahan($start,$limit);


            }
        }

        else{

            $search_value = $request->input('search.value');

            if(isset($order)&&isset($dir)){
                $list_kelurahan = $this->fetchDatakelurahanFilteredOrdered($start,$limit,$search_value,$order,$dir);
            }

            else{
              $list_kelurahan = $this->fetchDatakelurahanFiltered($start,$limit,$search_value);
            }

             $totalFiltered = $this->hitungDatakelurahanFiltered($search_value);
        }

        $data = array();

        $puter = $start+1;

        foreach ($list_kelurahan as $kelurahan) {
            # code...
            $nested_array['no'] = $puter++;

            $nested_array['nama_kelurahan'] = $kelurahan->nama_kelurahan;


            $nested_array['lat'] = $kelurahan->lat;

            $nested_array['lng'] = $kelurahan->lng;

           

            $nested_array['actions'] =  '<div class="btn-group" style="width:100%">
                                          <button class="btn btn-primary btn-edit-kelurahan" style="width:50%"'.
                                          ' data-idkelurahan='.$kelurahan->id_kelurahan.
                                          '>Edit</button>
                                          <button class="btn btn-danger btn-hapus-kelurahan" style="width:50%"'.
                                          ' data-idkelurahan='.$kelurahan->id_kelurahan.
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

       private function hitungDatakelurahan()
    {
        # code...

        $jumlah_kelurahan = DB::table('kelurahan')->where('kelurahan.is_aktif','=',1)->count();

        return $jumlah_kelurahan;

    }

    private function hitungDatakelurahanFiltered($search_value)
    {
        # code...

        $list_kelurahan = DB::table('kelurahan')

                            ->where('kelurahan.nama_kelurahan','LIKE','%'.$search_value.'%')
                            ->get();

        $final_list_kelurahan = array();

        foreach ($list_kelurahan as $kelurahan) {
            # code...
            if($kelurahan->is_aktif == 1){
                array_push($final_list_kelurahan, $kelurahan);
            }
        }

        return count($final_list_kelurahan);

    }

    private function fetchDatakelurahan($start,$limit){

        $query = DB::table('kelurahan')
                ->where('kelurahan.is_aktif','=',1)
                ->offset($start)
                ->limit($limit)
                ->get();

        return $query;

    }

    private function fetchDatakelurahanOrdered($start,$limit,$order,$dir){
         $query = DB::table('kelurahan')
                ->where('kelurahan.is_aktif','=',1)
                ->offset($start)
                ->limit($limit)
                ->orderBy($order,$dir)
                ->get();

        return $query;
    }

    private function fetchDatakelurahanFiltered($start,$limit,$search_value){
        $query = DB::table('kelurahan')
                 ->where('kelurahan.nama_kelurahan','LIKE','%'.$search_value.'%')
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

    private function fetchDatakelurahanFilteredOrdered($start,$limit,$search_value,$order,$dir){
        
         $query = DB::table('kelurahan')
                 ->where('kelurahan.nama_kelurahan','LIKE','%'.$search_value.'%')
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
