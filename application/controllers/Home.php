<?php
class Home extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(['ModelBuku', 'ModelUser']);
    }

    public function index()
    {
        $data = [
            'judul' => "Katalog Buku",
            'buku' => $this->ModelBuku->getBuku()->result(),

            
        ];

        if ($this->session->userdata('email')) {
            $user = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
            $data['user'] = $user['nama'];

            $this->load->view('templates/templates-user/header', $data);
            $this->load->view('buku/daftarbuku', $data);
            $this->load->view('templates/templates-user/modal');
            $this->load->view('templates/templates-user/footer', $data);

        } else {
            $data['user'] = 'Pengunjung';
            $this->load->view('templates/templates-user/header', $data);
            $this->load->view('buku/daftarbuku', $data);
            $this->load->view('templates/templates-user/modal');
            $this->load->view('templates/templates-user/footer', $data);



        }

        $this->load->view('templates/templates-user/header', $data);
        $this->load->view('buku/daftarbuku', $data);
        $this->load->view('templates/templates-user/modal');
        $this->load->view('templates/templates-user/footer');
    
        $data['user'] = 'Pengunjung';
        
        $this->load->view('buku/daftarbuku', $data);
        $this->load->view('templates/templates-user/modal');
        $this->load->view('templates/templates-user/footer');
    
    }

    public function detailBuku()
{
    $id = $this->uri->segment(3);
    $buku = $this->ModelBuku->joinKategoriBuku(['buku.id' => $id])->result();

    $data['user'] = "Pengunjung";
    $data['title'] = "Detail Buku";

    foreach ($buku as $fields) {	
        $data['judul'] = isset($fields->judul_buku) ? $fields->judul_buku : '';
        $data['pengarang'] = isset($fields->pengarang) ? $fields->pengarang : '';
        $data['penerbit'] = isset($fields->penerbit) ? $fields->penerbit : '';
        $data['kategori'] = isset($fields->kategori) ? $fields->kategori : '';
        $data['tahun'] = isset($fields->tahun_terbit) ? $fields->tahun_terbit : '';
        $data['isbn'] = isset($fields->isbn) ? $fields->isbn : '';
        $data['gambar'] = isset($fields->image) ? $fields->image : '';
        $data['dipinjam'] = isset($fields->dipinjam) ? $fields->dipinjam : '';
        $data['dibooking'] = isset($fields->dibooking) ? $fields->dibooking : '';
        $data['stok'] = isset($fields->stok) ? $fields->stok : '';
        $data['id'] = $id;
    }

    $this->load->view('templates/templates-user/header', $data);
    $this->load->view('buku/detail-buku', $data);
    $this->load->view('templates/templates-user/modal');
    $this->load->view('templates/templates-user/footer');
}
}

?>
