<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\DocTracking;
use App\Http\Controllers\DB;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $tbl_po = DocTracking::select('doc_tracking.no_po', 'purchase_orders.po_kebun', 
                'purchase_orders.total_qty', 'port_of_loading.nama_pol', 'port_of_destination.nama_pod',
                'detail_tracking.status', 'kapals.kode_kapal','kapals.nama_kapal','pt_penerima.nama_penerima',
                'gudang_muats.nama_gudang', 'barangs.nama_barang','purchase_orders.no_pl', 'detail_tracking.tgl_muat',
                'purchase_orders.po_kebun','detail_tracking_sisa.qty_tonase_sisa', 'detail_tracking.qty_timbang','detail_tracking.jml_sak',
                'detail_tracking.nopol','detail_tracking.no_container','detail_tracking.voyage','detail_tracking.td','detail_tracking.td_jkt',
                'detail_tracking.ta','customers.nama_customer','doc_tracking.status_kapal','detail_tracking_sisa.tipe')
                ->selectSub(function ($query) {
                    $query->selectRaw('SUM(qty_tonase_sisa)')
                        ->from('detail_tracking_sisa')
                        ->whereColumn('detail_tracking_sisa.id_track', 'doc_tracking.id_track')
                        ->groupBy('detail_tracking_sisa.id_track');
                }, 'qty_sisa')
                ->join('detail_tracking','detail_tracking.id_track','=','doc_tracking.id_track')
                ->join('detail_tracking_sisa','detail_tracking_sisa.id_track','=','doc_tracking.id_track')
                ->join('gudang_muats', 'gudang_muats.id_gudang', '=', 'detail_tracking.id_gudang')
                ->join('purchase_orders', 'purchase_orders.po_muat', '=', 'doc_tracking.no_po')
                ->join('port_of_loading', 'port_of_loading.id', '=', 'doc_tracking.id_pol')
                ->join('port_of_destination', 'port_of_destination.id', '=', 'doc_tracking.id_pod')
                ->join('kapals', 'kapals.id', '=', 'detail_tracking.id_kapal')
                ->join('detail_p_h_s', 'purchase_orders.id_detail_ph', '=', 'detail_p_h_s.id_detail_ph')
                ->join('penawaran_hargas', 'penawaran_hargas.id_penawaran', '=', 'detail_p_h_s.id_penawaran')
                ->join('customers', 'customers.id', '=', 'penawaran_hargas.id_customer')
                ->join('penerimas', 'detail_p_h_s.id_penerima', '=', 'penerimas.id_penerima')
                ->join('pt_penerima', 'pt_penerima.id_pt_penerima', '=', 'penerimas.id_pt_penerima')
                ->join('barangs', 'purchase_orders.id', '=', 'barangs.id')
                ->whereIn('doc_tracking.status', [1,2,3])
                ->orderBy('doc_tracking.no_po')
                ->groupBy('detail_tracking_sisa.id_track')
                ->get();
        $title = 'ABP';
        $breadcrumb = 'This Breadcrumb';
        return view('pages.dashboard.analytics', compact('title', 'breadcrumb','tbl_po'));        
    }

    public function addsisatrack(Request $request, $no_po) {
        DocTracking::where('no_po', $no_po)->update([
            'status' => '1'
        ]);
        // return redirect()->back();
        return redirect()->route('tracking.index');
    }
}
