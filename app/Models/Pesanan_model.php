<?php namespace App\Models;
use CodeIgniter\Model;
  
class Pesanan_model extends Model
{
    protected $table = 'pesanan';
      
    public function getPesanan($id = false)
    {
        if($id === false){
            return $this->table('pesanan')
                        ->join('kecamatan', 'kecamatan.kecamatan_id = pesanan.kecamatan_id')
                        ->orderBy('pesanan.created_at', 'DESC')
                        ->get()
                        ->getResultArray();
        } else {
            return $this->table('pesanan')
                        ->join('kecamatan', 'kecamatan.kecamatan_id = pesanan.kecamatan_id')
                        ->where('pesanan.pesanan_id', $id)
                        ->get()
                        ->getRowArray();
        }   
    }
    public function insertPesanan($data)
    {
        return $this->db->table($this->table)->insert($data);
    }
    public function updatePesanan($data, $id)
    {
        return $this->db->table($this->table)->update($data, ['pesanan_id' => $id]);
    }
    public function deletePesanan($id)
    {
        return $this->db->table($this->table)->delete(['pesanan_id' => $id]);
    }
    public function getGrafik($bstart = false, $bend = false)
    {
        // $query = $this->table('pesanan')
        //                 ->join('kecamatan', 'kecamatan.kecamatan_id = pesanan.kecamatan_id')
        //                 ->orderBy('pesanan.created_at', 'DESC')
        //                 ->get()
        //                 ->getResultArray();
        if($bstart === false){
            $sql = "SELECT MONTHNAME(created_at) as month, COUNT(pesanan_id) as total FROM pesanan GROUP BY MONTHNAME(created_at) ORDER BY MONTH(created_at)";
            $query = $this->db->query($sql)->getResultArray();
            return $query;
        } else{
            $sql = "SELECT MONTHNAME(created_at) as month, COUNT(pesanan_id) as total FROM pesanan WHERE created_at BETWEEN ? AND ? GROUP BY MONTHNAME(created_at) ORDER BY MONTH(created_at)";
            $query = $this->db->query($sql, [$bstart, $bend])->getResultArray();
            // $hasil = [];
            // if(!empty($query)){
            //     foreach($query->getResultArray() as $data) {
            //         $hasil[] = $data;
            //     }
            // }
            // return $hasil;
            return $query;
        }
    }
    public function getKecamatan($start = false, $end = false)
    {
        if($start === false){
            $query = $this->db->query("SELECT kecamatan.kecamatan_name as kecamatan, COUNT(pesanan.pesanan_id) as total FROM pesanan RIGHT JOIN kecamatan ON pesanan.kecamatan_id=kecamatan.kecamatan_id GROUP BY kecamatan.kecamatan_name ORDER BY kecamatan.kecamatan_name");
            $hasil = [];
            if(!empty($query)){
                foreach($query->getResultArray() as $data) {
                    $hasil[] = $data;
                }
            }
            return $hasil;
        } else{
            $sql = "SELECT kecamatan.kecamatan_name as kecamatan, COUNT(pesanan.pesanan_id) as total FROM pesanan RIGHT JOIN kecamatan ON pesanan.kecamatan_id=kecamatan.kecamatan_id AND pesanan.created_at BETWEEN ? AND ? GROUP BY kecamatan.kecamatan_name ORDER BY kecamatan.kecamatan_name";
            $query = $this->db->query($sql, [$start, $end])->getResultArray();
            return $query;
        }
    }
}
?>