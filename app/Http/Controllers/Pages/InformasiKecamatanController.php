<?php

namespace App\Http\Controllers\Pages;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Models\Kecamatan;
use DB;

class InformasiKecamatanController extends Controller
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
    	return view('pages.informasi_kecamatan',[]);
    }

    public function simpan_kecamatan(Request $request)
    {
        # code...
        $nama_kecamatan = $request['nama_kecamatan'];

        $luas_wilayah_km2 = $request['luas_wilayah'];

        $lat = $request['lat'];

        $lng = $request['lng'];

        $kecamatan = new Kecamatan;

        $kecamatan->nama_kecamatan = $nama_kecamatan;

        $kecamatan->lat = $lat;

        $kecamatan->lng = $lng;

        $kecamatan->luas_wilayah_km2 = $luas_wilayah_km2;

        $status_insert = $kecamatan->save();


        if($status_insert)
            return 1;
        else
            return 0;
    }

    public function hapus_kecamatan(Request $request)
    {
        # code...
        $id_kecamatan = $request['id_kecamatan'];

        $kecamatan = Kecamatan::find($id_kecamatan);

        $kecamatan->is_aktif = 0;

        $status = $kecamatan->save();

        if($status)
            return 1;
        else
            return 0;

    }

    public function update_kecamatan(Request $request)
    {
        # code...
        $id_kecamatan = $request['id_kecamatan'];

         $nama_kecamatan = $request['nama_kecamatan'];

        $luas_wilayah_km2 = $request['luas_wilayah'];

        $lat = $request['lat'];

        $lng = $request['lng'];

        $kecamatan = Kecamatan::find($id_kecamatan);

        $kecamatan->nama_kecamatan = $nama_kecamatan;

        $kecamatan->lat = $lat;

        $kecamatan->lng = $lng;

        $kecamatan->luas_wilayah_km2 = $luas_wilayah_km2;

        $status_insert = $kecamatan->save();


        if($status_insert)
            return 1;
        else
            return 0;

    }

    public function fetch_kecamatan_by_id(Request $request)
    {
        # code...
        $id_kecamatan = $request['id_kecamatan'];

        $kecamatan = Kecamatan::find($id_kecamatan);

        return response()->json($kecamatan);
    }

    public function all_kecamatan(Request $request)
    {
        # code...

        // define sortable columns

        $columns = array(
            1=>'nama_kecamatan',
            2=>'luas_wilayah_km2',
            3=>'lng',
            4=>'lat'
            );


        $jumlah_data = $this->hitungDataKecamatan();

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
                $list_kecamatan = $this->fetchDataKecamatanOrdered($start,$limit,$order,$dir);
            }

            else{

                $list_kecamatan = $this->fetchDataKecamatan($start,$limit);


            }
        }

        else{

            $search_value = $request->input('search.value');

            if(isset($order)&&isset($dir)){
                $list_kecamatan = $this->fetchDataKecamatanFilteredOrdered($start,$limit,$search_value,$order,$dir);
            }

            else{
              $list_kecamatan = $this->fetchDataKecamatanFiltered($start,$limit,$search_value);
            }

             $totalFiltered = $this->hitungDataKecamatanFiltered($search_value);
        }

        $data = array();

        $puter = $start+1;

        foreach ($list_kecamatan as $kecamatan) {
            # code...
            $nested_array['no'] = $puter++;

            $nested_array['nama_kecamatan'] = $kecamatan->nama_kecamatan;

            $nested_array['luas_wilayah'] = $kecamatan->luas_wilayah_km2;

            $nested_array['lat'] = $kecamatan->lat;

            $nested_array['lng'] = $kecamatan->lng;

           

            $nested_array['actions'] =  '<div class="btn-group" style="width:100%">
                                          <button class="btn btn-primary btn-edit-kecamatan" style="width:50%"'.
                                          ' data-idkecamatan='.$kecamatan->id_kecamatan.
                                          '>Edit</button>
                                          <button class="btn btn-danger btn-hapus-kecamatan" style="width:50%"'.
                                          ' data-idkecamatan='.$kecamatan->id_kecamatan.
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

    private function hitungDataKecamatan()
    {
        # code...

        $jumlah_kecamatan = DB::table('kecamatan')->where('kecamatan.is_aktif','=',1)->count();

        return $jumlah_kecamatan;

    }

    private function hitungDataKecamatanFiltered($search_value)
    {
        # code...

        $list_kecamatan = DB::table('kecamatan')

                            ->where('kecamatan.nama_kecamatan','LIKE','%'.$search_value.'%')
                            ->get();

        $final_list_kecamatan = array();

        foreach ($list_kecamatan as $kecamatan) {
            # code...
            if($kecamatan->is_aktif == 1){
                array_push($final_list_kecamatan, $kecamatan);
            }
        }

        return count($final_list_kecamatan);

    }

    private function fetchDataKecamatan($start,$limit){

        $query = DB::table('kecamatan')
                ->where('kecamatan.is_aktif','=',1)
                ->offset($start)
                ->limit($limit)
                ->get();

        return $query;

    }

    private function fetchDataKecamatanOrdered($start,$limit,$order,$dir){
         $query = DB::table('kecamatan')
                ->where('kecamatan.is_aktif','=',1)
                ->offset($start)
                ->limit($limit)
                ->orderBy($order,$dir)
                ->get();

        return $query;
    }

    private function fetchDataKecamatanFiltered($start,$limit,$search_value){
        $query = DB::table('kecamatan')
                 ->where('kecamatan.nama_kecamatan','LIKE','%'.$search_value.'%')
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

    private function fetchDataKecamatanFilteredOrdered($start,$limit,$search_value,$order,$dir){
        
         $query = DB::table('kecamatan')
                 ->where('kecamatan.nama_kecamatan','LIKE','%'.$search_value.'%')
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
