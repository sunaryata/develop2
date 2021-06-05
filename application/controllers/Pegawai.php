 
<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Pegawai extends CI_Controller {
    private $filename = "import_data";

    function __construct(){
        parent::__construct();
        
    }
    
    public function index(){
        $ip = $_SERVER['HTTP_HOST'];;
        
        $arrayData = array(
            "ip" => $ip,
        );
        $this->load->view('v_pegawai', $arrayData);
    }


    public function form(){
        $data = array(); // Buat variabel $data sebagai array
        
        if(isset($_POST['preview'])){ // Jika user menekan tombol Preview pada form
            // lakukan upload file dengan memanggil function upload yang ada di SiswaModel.php
            $upload = $this->SiswaModel->upload_file($this->filename);
            
            if($upload['result'] == "success"){ // Jika proses upload sukses
                // Load plugin PHPExcel nya
                include APPPATH.'third_party/PHPExcel/PHPExcel.php';
                
                $excelreader = new PHPExcel_Reader_Excel2007();
                $loadexcel = $excelreader->load('excel/'.$this->filename.'.xlsx'); // Load file yang tadi diupload ke folder excel
                $sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);
                
                // Masukan variabel $sheet ke dalam array data yang nantinya akan di kirim ke file form.php
                // Variabel $sheet tersebut berisi data-data yang sudah diinput di dalam excel yang sudha di upload sebelumnya
                $data['sheet'] = $sheet; 
            }else{ // Jika proses upload gagal
                $data['upload_error'] = $upload['error']; // Ambil pesan error uploadnya untuk dikirim ke file form dan ditampilkan
            }
        }
        
        $this->load->view('form', $data);
    }
    
    public function list_pegawai(){
        header('Content-Type: application/json');
        $query = $this->db->get('pegawai');
        if ($query){
            $response = array(
                "data" => $query->result(),
                "message" => "OK",
            );
        }else{
            $response = array(
                "data" => array(),
                "message" => "Table Empty"
            );
        }
        
        echo json_encode($response);
    }


    public function get_kd1(){
        header('Content-Type: application/json');
        $this->db->where('id', $id);
        $query = $this->db->get('pegawai');
        if ($query){
            $response = array(
                "data" => $query->result(),
                "message" => "OK",
            );
        }else{
            $response = array(
                "data" => array(),
                "message" => "Table Empty"
            );
        }
        
        echo json_encode($response);
    }

    
    public function add_pegawai(){
        header('Content-Type: application/json');
        $input = file_get_contents("php://input");
        if (!empty($input) && isset($input)){
            $json = json_decode($input);
            if (!empty($json->pegawai_name)){
                $data = array(
                    'name' => $json->pegawai_name,
                    'status' => $json->pegawai_status,
                );
                $query = $this->db->insert('pegawai', $data);
                if ($query){
                    $response = array(
                        "data" => array(),
                        "message" => "Success Adding new Pegawai",
                    );
                }else{
                    $response = array(
                        "data" => array(),
                        "message" => "Failed Adding new Pegawai",
                    );
                }
                
            }else{
                $response = array(
                    "data" => array(),
                    "message" => "Pegawai Name Cannot be null",
                );
            }
        }else{
            $response = array(
                "data" => array(),
                "message" => "Body cannot be empty",
            );
        }
        echo json_encode($response);
    }


    public function delete(){
     header('Content-Type: application/json');
     $id=$this->input->post('id');
     $this->db->where('id', $id);
     $Q = $this->db->delete('pegawai');

     if ($Q){
        $response = array(
            "data" => array(),

            "message" => "Deleted",
        );
    }

    echo json_encode($response);

}

public function ubah_status(){
 header('Content-Type: application/json');
 $id=$this->input->post('id');
 $status=$this->input->post('status');

 if($status == '1'){
    $user_status = '0';
}
else{
    $user_status = '1';
}

$data = array('status' => $user_status );
$this->db->where('id', $id);
    $Q = $this->db->update('pegawai', $data); //Update status here

    if ($Q){
        $response = array(
            "data" => array(),

            "message" => "Changed",
        );
    }

    echo json_encode($response);

}



function get_kd(){
  $q = $this->db->query("SELECT MAX(RIGHT(id,4)) AS kd_max FROM pegawai WHERE DATE(created_at)=CURDATE()");
  $kd = "";
  $kode="JBT";
  if($q->num_rows()>0){
    foreach($q->result() as $k){
      $tmp = ((int)$k->kd_max)+1;
      $kd = sprintf("%04s", $tmp,$kode);
  }
}else{
    $kd = "0001";
}
date_default_timezone_set('Asia/Jakarta');
return $kode.date('dmy').$kd;
}




public function backup_delete(){
 header('Content-Type: application/json');
 $id=$this->input->post('id');
 $this->db->where('id', $id);
 $Q = $this->db->delete('pegawai');



 if ($Q){
    $response = array(
        "data" => array(),
        "haha" => $id,
        "message" => "Deleted",
    );
}

echo json_encode($response);

}




}